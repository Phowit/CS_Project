//ESP32_ARUWiFi_InputSystem_V1.0 ---> ผ่านการตรวจสอบแล้ว รอทดสอบ
// อย่าต่อแรงดันเกิน 3.3V เข้าขา 34–39 เด็ดขาดเพราะมันไม่มีวงจร protection เหมือนพวกขา I/O ปกติ
#include <WiFi.h>                 // ใช้สำหรับการเชื่อมต่อ WiFi
#include <HTTPClient.h>           // ใช้สำหรับส่ง/รับ HTTP Request (ดึงตารางเวลา)
#include <WiFiClientSecure.h>     // แทน <WiFiClientSecureBearSSL.h>
#include <Ultrasonic.h>           // แทน <NewPing.h>


// ===== WiFi มหาวิทยาลัย =====
const char* studentUser = "16432048";   // 👈 ใส่รหัสนักศึกษา
const char* studentPass = "26062545"; // 👈 ใส่รหัสผ่าน

const char* aruSSIDs[] = { "ARU_WiFi", "ARU_WIFI", "Zyxel", "ARU-WiFi2" };
const size_t aruSSIDsCount = sizeof(aruSSIDs) / sizeof(aruSSIDs[0]);
const char* aruLoginUrl = "https://login1.aru.ac.th/index.jsp?action=login";

const unsigned long WIFI_CONNECT_TIMEOUT = 15000UL;

// ===== ส่วนการค้นหา WiFi มหาวิทยาลัย =====
bool scanAndConnectARU() {
  int n = WiFi.scanNetworks();
  //WiFi.scanNetworks() คำสั่งใน Arduino (โดยเฉพาะใน ESP8266 / ESP32) ที่ใช้สแกนหาเครือข่าย WiFi รอบ ๆ
  //ฟังก์ชันนี้จะ “บล็อก” (คือหยุดรอชั่วคราว) จนกว่าการสแกนทั้งหมดเสร็จ ปกติจะใช้เวลาประมาณ 2–4 วินาที
  //ผลลัพธ์ที่ได้จากฟังก์ชันนี้คือ จำนวนเครือข่าย WiFi ที่เจอ ค่าเก็บไว้ในตัวแปร n

  if (n <= 0) return false;   // ถ้า n <= 0 คือ ไม่มี WiFi ไหนถูกสแกนเจอเลย
  for (int i = 0; i < n; ++i) {   //วนลูปตรวจสอบ WiFi ที่เจอทั้งหมด
    String s = WiFi.SSID(i);  //ดึงชื่อ SSID (ชื่อ WiFi) ของแต่ละเครือข่ายที่เจอมาเก็บไว้ในตัวแปร s
    Serial.print("Found WiFi: ");
    Serial.println(s);

    for (size_t j = 0; j < aruSSIDsCount; ++j) {  //วนตรวจสอบชื่อ WiFi ที่เจอ (s) กับรายชื่อ WiFi ของมหาวิทยาลัย ที่เรากำหนดไว้
      if (s == String(aruSSIDs[j])) {  //ถ้าชื่อที่เจอตรงกับชื่อในลิสต์ → แสดงว่าเป็น WiFi ของมหาวิทยาลัยจริง
        Serial.print("Connecting to ");
        Serial.println(s);
        WiFi.begin(s.c_str());  //เริ่มพยายามเชื่อมต่อกับ WiFi นั้น (โดยไม่ใช้รหัสผ่าน เพราะ WiFi ของมหาลัยมักจะเป็น open network + login ผ่านหน้าเว็บภายหลัง)

        //รอจนกว่าจะเชื่อมสำเร็จ ถ้าเชื่อมต่อสำเร็จ (WL_CONNECTED) → คืนค่า true
        unsigned long start = millis();
        while (millis() - start < WIFI_CONNECT_TIMEOUT) {
          if (WiFi.status() == WL_CONNECTED) return true;
          delay(200);
        }
      }
    }
  }
  return false;
}

// ===== ส่วนการ login WiFi มหาวิทยาลัย =====
bool loginARU(const String &user, const String &pass) {
  WiFiClientSecure client;  // ESP32 ใช้ตัวนี้
  client.setInsecure();     // ง่าย ๆ ตามตัวอย่าง

  HTTPClient http;
  http.begin(client, aruLoginUrl);
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");

  String body = "username=" + user +
                "&password=" + pass +
                "&mac=&ipv4=" + WiFi.localIP().toString() +
                "&ipv6=&loginType=specific&loginMethod=ldap&hash&hashc=3c5303974f350074442ed0e33a8da8e4&submit=Log+In";

  int code = http.POST(body);
  Serial.print("Login response code: ");
  Serial.println(code);
  http.end();

  return (code == 200 || code == 302);
}
// ===== จบส่วนของ WiFi มหาวิทยาลัย =====


// เริ่ม ส่วนการจัดการเวลา ---------------------------------------
unsigned long previousSensorMillis = 0;
unsigned long previousSendMillis = 0;

const unsigned long sensorInterval = 60000;   // รอบอ่าน sensor
const unsigned long sendInterval   = 900000;  // รอบส่งข้อมูล
// 10 second = 10000
// 30 second = 30000
// 1 minute = 60000 millisecond
// 5 minute = 300000 millisecond
// 15 minute = 900000 millisecond
// จบ ส่วนการจัดการเวลา ---------------------------------------


// ===== เริ่มส่วนของ Temperature sensor =====
#define TEMP_PIN 35
const int R0 = 100000; // R0 = 100k
const int B = 4275; // B value of the thermistor
// ===== จบส่วนของ Temperature sensor =====


// ===== เริ่มส่วนของ Ultrasonic sensor =====
#define TRIG_PIN 33
#define ECHO_PIN 32

Ultrasonic ultrasonic(TRIG_PIN, ECHO_PIN);
// ===== จบส่วนของ Ultrasonic sensor =====


// ===== เริ่มส่วนของ Water sensor =====
const int WaterSensorHigh = 25;
const int WaterSensorLow = 26;
// ===== จบส่วนของ Water sensor =====


// ===== เริ่มส่วนของ การส่งข้อมูลขึ้นเว็บ =====
const char* serverName = "http://192.168.1.55/CS_Project/CS_Project_Phowit-Chuachan_Code_16432048/data.php"; 

float latestTemperature = 0;
int latestWaterHigh = 0;
int latestWaterLow = 0;
long FoodLevel = 0;
// ===== เริ่มส่วนของ การส่งข้อมูลขึ้นเว็บ =====


// ====== การเริ่มต้น ======
void setup() {
  pinMode(WaterSensorHigh, INPUT);
  pinMode(WaterSensorLow, INPUT);

  Serial.begin(115200);
  WiFi.mode(WIFI_STA);
  WiFi.disconnect();
  delay(1000); // รอสัก 1 วิให้ระบบ WiFi พร้อมก่อนสแกน

  Serial.println("Trying ARU WiFi...");
  if (scanAndConnectARU()) {
    Serial.print("Connected to ARU, IP: ");
    Serial.println(WiFi.localIP());
    delay(500);
    Serial.println("Logging into ARU...");
    if (loginARU(studentUser, studentPass)) {
      Serial.println("ARU login success (or request sent).");
    } else {
      Serial.println("ARU login failed -> reboot");
      delay(1000);
      ESP.restart();
    }
  } else {
    Serial.println("No ARU SSID found -> reboot");
    delay(1000);
    ESP.restart();
  }
}

// ====== ลูปหลัก ======
void loop() {
    unsigned long currentMillis = millis();

  // ------- เริ่ม ส่วนการอ่าน sensor ทุก 1 นาที -------
  if (currentMillis - previousSensorMillis >= sensorInterval) {
      previousSensorMillis = currentMillis;

      // อ่าน temperature
      int Temperature_Value = analogRead(TEMP_PIN);
      if (Temperature_Value != 0) {
        float Resistance = 4095.0 / Temperature_Value - 1.0;
        Resistance = R0 * Resistance;
        latestTemperature = 1.0 / (log(Resistance / R0) / B + 1 / 298.15) - 273.15;
      }

      // อ่าน ultrasonic
      FoodLevel = ultrasonic.read();

      // อ่าน water sensor
      latestWaterHigh = digitalRead(WaterSensorHigh);
      latestWaterLow = digitalRead(WaterSensorLow);

      // log ทุกๆ 1 นาที
      Serial.print("LOG: TEMP="); Serial.print(latestTemperature);
      Serial.print(", S1="); Serial.print(FoodLevel);
      Serial.print(", W1="); Serial.print(latestWaterHigh);
      Serial.print(", W2="); Serial.println(latestWaterLow);
  }
  // ------- จบ ส่วนการอ่าน sensor ทุก 1 นาที -------

  // ------- เริ่ม ส่วนการส่งข้อมูลทุก 15 นาที -------
  if (currentMillis - previousSendMillis >= sendInterval) {
    previousSendMillis = currentMillis;

    if (WiFi.status() == WL_CONNECTED) {
      String url =  String(serverName) + 
                    "?temp=" + String(latestTemperature) + 
                    "&ultra=" + String(FoodLevel) + 
                    "&waterh=" + String(latestWaterHigh) +
                    "&waterl=" + String(latestWaterLow);
      Serial.println("Request: " + url);

      HTTPClient http;
      http.begin(url);
      int httpCode = http.GET(); // ส่ง request

        if (httpCode > 0) {
          Serial.print("Response code: ");
          Serial.println(httpCode);
          String payload = http.getString();
          Serial.println("Server response: " + payload);
        } else {
          Serial.println("Error on sending request");
        }

      http.end();
    } else {
      Serial.println("WiFi disconnected!");
    }
  }
}
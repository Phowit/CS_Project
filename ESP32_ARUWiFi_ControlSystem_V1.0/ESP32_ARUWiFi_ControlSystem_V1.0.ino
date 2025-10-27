//ESP32_ARUWiFi_InputSystem_V1.0 ---> ผ่านการตรวจสอบแล้ว รอทดสอบ
// อย่าต่อแรงดันเกิน 3.3V เข้าขา 34–39 เด็ดขาดเพราะมันไม่มีวงจร protection เหมือนพวกขา I/O ปกติ
#include <WiFi.h>                 // ใช้สำหรับการเชื่อมต่อ WiFi
#include <HTTPClient.h>           // ใช้สำหรับส่ง/รับ HTTP Request (ดึงตารางเวลา)
#include <WiFiClientSecure.h>     // แทน <WiFiClientSecureBearSSL.h>
#include <WebServer.h>
#include <Ultrasonic.h>           // แทน <NewPing.h>
#include <ESP32Servo.h>  // ใช้แทน Servo.h

WebServer server(80); // 👈 เพิ่มบรรทัดนี้ไว้หลัง include

// เริ่ม กำหนดขาที่ใช้ต่อ Relay ---------------------------------------
const int relay_motor = 25;
const int relay_BVtem = 26;
const int relay_BVwater = 27;
const int relay_BVfoodS = 14;
// เริ่ม กำหนดขาที่ใช้ต่อ Relay ---------------------------------------

// ===== WiFi มหาวิทยาลัย =====
const char* studentUser = "16432048";   // 👈 ใส่รหัสนักศึกษา
const char* studentPass = "26062545"; // 👈 ใส่รหัสผ่าน

const char* aruSSIDs[] = { "Zyxel"};  //"ARU_WiFi", "ARU_WIFI", , "ARU-WiFi2" 
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

// ฟังก์ชันจัดการ request /data
void handleData() {
  if (server.hasArg("value")) {
    String value = server.arg("value");  // ดึงค่าจาก URL
    Serial.println("Received value: " + value);

    if (value == "11") {
      // ----- เปิดรีเลย์ช่อง 1 -----
      digitalWrite(relay_motor, HIGH);  // ถ้ารีเลย์ Active LOW → LOW = ON
      Serial.println("Relay 1 ON");
      server.send(200, "text/plain", "OK: Relay 1 ON");
    }
    else if (value == "10") {
      // ----- ปิดรีเลย์ช่อง 1 -----
      digitalWrite(relay_motor, LOW);  // HIGH = OFF
      Serial.println("Relay 1 OFF");
      server.send(200, "text/plain", "OK: Relay 1 OFF");
    }
    else if (value == "21") {
      // ----- เปิดรีเลย์ช่อง 2 -----
      digitalWrite(relay_BVtem, HIGH);  // LOW = ON
      Serial.println("Relay 2 ON");
      server.send(200, "text/plain", "OK: Relay 2 ON");
    }
    else if (value == "20") {
      // ----- ปิดรีเลย์ช่อง 2 -----
      digitalWrite(relay_BVtem, LOW);  // HIGH = OFF
      Serial.println("Relay 2 OFF");
      server.send(200, "text/plain", "OK: Relay 2 OFF");
    }
    else if (value == "31") {
      // ----- เปิดรีเลย์ช่อง 3 -----
      digitalWrite(relay_BVwater, HIGH);  // LOW = ON
      Serial.println("Relay 3 ON");
      server.send(200, "text/plain", "OK: Relay 3 ON");
    }
    else if (value == "30") {
      // ----- ปิดรีเลย์ช่อง 3 -----
      digitalWrite(relay_BVwater, LOW);  // HIGH = OFF
      Serial.println("Relay 3 OFF");
      server.send(200, "text/plain", "OK: Relay 3 OFF");
    }
    else if (value == "41") {
      // ----- เปิดรีเลย์ช่อง 4 -----
      digitalWrite(relay_BVfoodS, HIGH);  // LOW = ON
      Serial.println("Relay 4 ON");
      server.send(200, "text/plain", "OK: Relay 4 ON");
    }
    else if (value == "40") {
      // ----- ปิดรีเลย์ช่อง 4 -----
      digitalWrite(relay_BVfoodS, LOW);  // HIGH = OFF
      Serial.println("Relay 4 OFF");
      server.send(200, "text/plain", "OK: Relay 4 OFF");
    }
    else {
      // ----- ถ้าค่าไม่ตรง -----
      server.send(400, "text/plain", "ERROR: Unknown value");
    }
  } 
  else {
    // ----- ถ้าไม่มีค่า value ส่งมา -----
    server.send(400, "text/plain", "ERROR: No value received");
  }
}

// ===== จบส่วนของ WiFi มหาวิทยาลัย =====


// เริ่ม ส่วนการจัดการเวลา ---------------------------------------
unsigned long previousSensorMillis = 0;
unsigned long previousServoMillis = 0;
unsigned long previousSendMillis = 0;

const unsigned long sensorInterval = 60000;   // รอบอ่าน sensor
const unsigned long servoInterval = 60000;   // รอบอ่าน sensor
const unsigned long sendInterval   = 900000;  // รอบส่งข้อมูล
// 1 minute = 60000 millisecond
// 5 minute = 300000 millisecond
// 15 minute = 900000 millisecond
// จบ ส่วนการจัดการเวลา ---------------------------------------

// ===== เริ่มส่วนของ Ultrasonic sensor =====
#define TRIG_PIN_TRAY1 32 //ห้ามใช้ 34-39 เป็น Output (trig)
#define ECHO_PIN_TRAY1 35

#define TRIG_PIN_TRAY2 33 //ห้ามใช้ 34-39 เป็น Output (trig)
#define ECHO_PIN_TRAY2 34

Ultrasonic ultrasonic1(TRIG_PIN_TRAY1, ECHO_PIN_TRAY1);
Ultrasonic ultrasonic2(TRIG_PIN_TRAY2, ECHO_PIN_TRAY2);
// ===== จบส่วนของ Ultrasonic sensor =====


// สร้างออบเจ็กต์ servo ---------------------------------------
Servo servo1;
// สร้างออบเจ็กต์ servo ---------------------------------------


// ===== เริ่มส่วนของ การส่งข้อมูลขึ้นเว็บ =====
const char* serverName = "http://192.168.1.55/CS_Project/CS_Project_Phowit-Chuachan_Code_16432048/data.php"; 

long FoodTrayLevel1 = 0;
long FoodTrayLevel2 = 0;
// ===== เริ่มส่วนของ การส่งข้อมูลขึ้นเว็บ =====


// ====== การเริ่มต้น ======
void setup() {
  // ตั้งค่า relay เป็น Output
  pinMode(relay_motor, OUTPUT);
  pinMode(relay_BVtem, OUTPUT);
  pinMode(relay_BVwater, OUTPUT);
  pinMode(relay_BVfoodS, OUTPUT);
  
  // เริ่มต้น ปิดทุก Relay
  digitalWrite(relay_motor, LOW);
  digitalWrite(relay_BVtem, LOW);
  digitalWrite(relay_BVwater, LOW);
  digitalWrite(relay_BVfoodS, LOW);

  // Attach Servo
  servo1.attach(12);

  servo1.write(90);
  // servo.write(0)	--> หมุนซ้ายเร็วสุด
  // servo.write(90)	--> หยุดหมุน
  // servo.write(180)	--> หมุนขวาเร็วสุด

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

  // ตั้งค่า route /data
  server.on("/data", handleData);

  // เริ่ม server
  server.begin();
  Serial.println("HTTP server started");
}

// ====== ลูปหลัก ======
void loop() {
  unsigned long currentMillis = millis();

  server.handleClient(); // ตรวจสอบ client request

  // ------- เริ่ม ส่วนการอ่าน sensor ทุก 1 นาที -------
  if (currentMillis - previousSensorMillis >= sensorInterval) {
      previousSensorMillis = currentMillis;

      // อ่าน ultrasonic
      //FoodTrayLevel1 = ultrasonic1.read();
      //delay(50);
      //FoodTrayLevel2 = ultrasonic2.read();

      // log ทุกๆ 1 นาที
      Serial.print("LOG: FTL1="); Serial.print(FoodTrayLevel1);
      Serial.print(", FTL2="); Serial.println(FoodTrayLevel2);
  }
  // ------- จบ ส่วนการอ่าน sensor ทุก 1 นาที -------

  // ------- เริ่ม ส่วนการทดสอบ servo ทุก 1 นาที (ใช้งานจริงไม่มีส่วนนี้) -------
  if (currentMillis - previousServoMillis >= servoInterval) {
      previousServoMillis = currentMillis;

      Serial.println("Servo rotate left");
      servo1.write(0);  //	--> หมุนซ้ายเร็วสุด
      delay(500);

      Serial.println("Servo stop");
      servo1.write(90); //--> หยุดหมุน
      delay(500);

      Serial.println("Servo rotate right");
      servo1.write(180); //	--> หมุนขวาเร็วสุด
      delay(500);

      Serial.println("Servo stop");
      servo1.write(90); //--> หยุดหมุน
  }
  // ------- จบ ส่วนการทดสอบ servo ทุก 1 นาที (ใช้งานจริงไม่มีส่วนนี้) -------

  // ------- เริ่ม ส่วนการส่งข้อมูลทุก 15 นาที -------
  if (currentMillis - previousSendMillis >= sendInterval) {
    previousSendMillis = currentMillis;

    if (WiFi.status() == WL_CONNECTED) {
      String url =  String(serverName) + "?board=2" +
                    "&FTL1=" + String(FoodTrayLevel1) + 
                    "&FTL2=" + String(FoodTrayLevel2);
      Serial.println("Request: " + url);

      HTTPClient http;
      http.setReuse(false);
      http.begin(url);
      http.setTimeout(10000);
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
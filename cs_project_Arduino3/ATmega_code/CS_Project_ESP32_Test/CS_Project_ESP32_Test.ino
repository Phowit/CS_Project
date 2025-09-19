#include <WiFi.h>                 // ใช้สำหรับการเชื่อมต่อ WiFi
#include <HTTPClient.h>           // ใช้สำหรับส่ง/รับ HTTP Request (ดึงตารางเวลา)
#include <ArduinoJson.h>          // ใช้สำหรับจัดการ JSON
#include <FS.h>                   // ใช้งาน File System
#include <LittleFS.h>             // ใช้ LittleFS เป็นระบบไฟล์ใน ESP32
#include <NTPClient.h>            // ใช้ดึงเวลาจริงจาก NTP Server
#include <WiFiUdp.h>              // ใช้กับ NTPClient (UDP โปรโตคอล)
#include <ESP32Servo.h>           // ไลบรารีควบคุม Servo

const char* ssid = "Phowit_2.4g";
const char* password = "0638967226";
// Phowit_2.4g --> 0638967226 --> 192.168.1.55
// ARU_WIFI --> 1234567890
// A --> 1234567890 --> 10.166.224.111

const char* host = "192.168.1.55";
const String endpoint = "/CS_Project/CS_Project_Phowit-Chuachan_Code_16432048/data.php";

IPAddress local_IP(192, 168, 1, 155);
IPAddress gateway(192, 168, 1, 1);
IPAddress subnet(255, 255, 255, 0);
IPAddress primaryDNS(8, 8, 8, 8);
IPAddress secondaryDNS(8, 8, 4, 4);

ESP8266WebServer server(80);

// ===== Servo =====
Servo servo1;                     // สร้างออบเจกต์ Servo
const int servoPin = 5;           // กำหนดขาที่ใช้ต่อ Servo

// ===== NTP Time =====
WiFiUDP ntpUDP;                   // สร้างออบเจกต์ UDP สำหรับใช้กับ NTPClient
NTPClient timeClient(ntpUDP, "pool.ntp.org", 7 * 3600); // ใช้ pool.ntp.org ดึงเวลา + ตั้งเป็นโซน GMT+7 (ไทย)

// ===== ดึงตารางจากเว็บแล้วบันทึกไว้ใน LittleFS =====
void fetchSchedule() {
  if (WiFi.status() == WL_CONNECTED) {   // เช็คว่าเชื่อมต่อ WiFi อยู่ไหม
    HTTPClient http;                     // สร้างออบเจกต์ HTTP
    http.begin(scheduleURL);             // กำหนด URL ของ request
    int httpCode = http.GET();           // ส่ง GET request

    if (httpCode == 200) {               // ถ้าสถานะ 200 = สำเร็จ
      String payload = http.getString(); // ดึงข้อมูล JSON ที่ได้จากเว็บ
      Serial.println("Schedule received:"); // แสดงข้อความว่าได้ตารางแล้ว
      Serial.println(payload);           // แสดงข้อมูล JSON

      File file = LittleFS.open("/schedule.json", "w"); // เปิดไฟล์เพื่อเขียน (เขียนทับไฟล์เก่า)
      if (file) {                        // ถ้าเปิดไฟล์ได้
        file.print(payload);             // เขียนข้อมูล JSON ลงไฟล์
        file.close();                    // ปิดไฟล์
        Serial.println("Schedule saved."); // แสดงข้อความว่าเซฟเรียบร้อย
      }
    } else {
      Serial.printf("HTTP Error: %d\n", httpCode); // ถ้า error แสดงรหัส HTTP เช่น 404, 500
    }
    http.end();                          // ปิดการเชื่อมต่อ HTTP
  }
}

// ===== โหลดตารางจาก LittleFS =====
DynamicJsonDocument loadSchedule() {
  DynamicJsonDocument doc(1024);         // สร้างเอกสาร JSON ขนาด 1024 bytes
  if (LittleFS.exists("/schedule.json")) { // เช็คว่ามีไฟล์ตารางอยู่ไหม
    File file = LittleFS.open("/schedule.json", "r"); // เปิดไฟล์แบบอ่าน
    DeserializationError err = deserializeJson(doc, file); // แปลงไฟล์ JSON -> doc
    file.close();                        // ปิดไฟล์
    if (err) {                           // ถ้าแปลงไม่สำเร็จ
      Serial.println("Failed to parse schedule.json"); // แจ้งเตือน
    }
  }
  return doc;                            // คืนค่า JSON Document ที่ได้
}

// ===== ให้อาหาร =====
void feedChicken() {
  Serial.println("Feeding chickens..."); // แสดงข้อความให้อาหาร
  servo1.write(90);   // หมุน servo ไป 90 องศา (เปิดถังอาหาร)
  delay(2000);        // รอ 2 วินาที
  servo1.write(0);    // หมุน servo กลับไปที่ 0 องศา (ปิดถังอาหาร)
}

void setup() {
  Serial.begin(115200);                  // เริ่ม Serial Monitor ที่ baud 115200

  // Servo
  servo1.attach(servoPin);               // กำหนดขาที่ต่อ Servo
  servo1.write(0);                       // ตั้งค่าเริ่มต้นให้ servo อยู่ที่ 0 องศา

  // File system
  if (!LittleFS.begin()) {               // เริ่มต้นใช้งาน LittleFS
    Serial.println("LittleFS mount failed"); // ถ้า mount ไม่สำเร็จ แจ้งเตือน
    return;                              // หยุด setup
  }

  // WiFi
  WiFi.begin(ssid, password);            // เริ่มเชื่อมต่อ WiFi
  while (WiFi.status() != WL_CONNECTED) { // รอจนกว่าจะเชื่อมต่อสำเร็จ
    delay(500);                          // หน่วง 0.5 วินาที
    Serial.print(".");                   // แสดงจุดระหว่างรอ
  }
  Serial.println("\nWiFi connected!");   // แสดงข้อความเมื่อเชื่อมต่อสำเร็จ

  // NTP
  timeClient.begin();                    // เริ่มต้นใช้งาน NTP

  // โหลดตารางครั้งแรก
  fetchSchedule();                       // ดึงตารางจาก server และบันทึกไว้
}

void loop() {
  timeClient.update();                   // อัปเดตเวลาปัจจุบันจาก NTP

  int currentHour = timeClient.getHours();   // ดึงชั่วโมงปัจจุบัน
  int currentMinute = timeClient.getMinutes(); // ดึงนาทีปัจจุบัน

  // โหลดตารางมาเช็ค
  DynamicJsonDocument doc = loadSchedule();  // โหลดตาราง JSON จากไฟล์
  for (JsonObject t : doc.as<JsonArray>()) { // วนลูปเช็คทุกเวลาในตาราง
    int h = t["h"];                          // ชั่วโมงจากตาราง
    int m = t["m"];                          // นาทีจากตาราง
    if (currentHour == h && currentMinute == m) { // ถ้าเวลาปัจจุบันตรงกับตาราง
      feedChicken();                         // สั่งให้อาหาร
      delay(60000);                          // รอ 1 นาที กันไม่ให้สั่งซ้ำ
    }
  }

  // Sync ตารางใหม่ทุก 10 นาที
  static unsigned long lastSync = 0;         // เก็บเวลา sync ล่าสุด
  if (millis() - lastSync > 600000) {        // ถ้าเวลาผ่านไปเกิน 600000 ms (10 นาที)
    fetchSchedule();                         // ดึงตารางใหม่จาก server
    lastSync = millis();                     // บันทึกเวลาปัจจุบันไว้เป็นครั้งล่าสุด
  }
}

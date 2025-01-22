#include <WiFi.h> // ไลบรารี WiFi สำหรับ ESP32 หรือ ESP8266

// ข้อมูลสำหรับเชื่อมต่อ WiFi
const char* ssid = "OPPO A94";         // ชื่อ WiFi ที่ต้องการเชื่อมต่อ
const char* password = "26062545"; // รหัสผ่าน WiFi

// ข้อมูลเซิร์ฟเวอร์ปลายทาง
const char* server = "192.168.1.1";    // IP ของเซิร์ฟเวอร์ (แทน localhost)
const char* path = "/CS_Project/Arduino_Test.php"; // ไฟล์ปลายทางที่ต้องการส่งข้อมูล
const int port = 80;                    // พอร์ตสำหรับ HTTP (ปกติคือ 80)

// ตัวแปรสำหรับส่งข้อมูล (ตัวอย่างค่า)
String sensorValue = "25"; // ตัวอย่างค่าที่ต้องการส่ง เช่น ค่าจากเซ็นเซอร์

WiFiClient client; // สร้างอ็อบเจ็กต์สำหรับจัดการการเชื่อมต่อ WiFi

void setup() {
  Serial.begin(9600); // เริ่มต้น Serial Monitor สำหรับดูผลลัพธ์
  Serial.println("Starting WiFi connection...");

  // เชื่อมต่อกับ WiFi
  WiFi.begin(ssid, password); // เริ่มต้นการเชื่อมต่อ WiFi
  while (WiFi.status() != WL_CONNECTED) { // ตรวจสอบสถานะการเชื่อมต่อ
    delay(1000); // รอ 1 วินาที
    Serial.print("."); // แสดงผลจุดใน Serial Monitor เพื่อบอกว่ากำลังเชื่อมต่อ
  }

  Serial.println("\nConnected to WiFi!"); // แสดงข้อความเมื่อเชื่อมต่อสำเร็จ
  Serial.print("IP Address: ");
  Serial.println(WiFi.localIP()); // แสดง IP Address ของบอร์ด
}

void loop() {
  // ตรวจสอบว่ายังคงเชื่อมต่อ WiFi อยู่หรือไม่
  if (WiFi.status() == WL_CONNECTED) {
    // พยายามเชื่อมต่อกับเซิร์ฟเวอร์
    if (client.connect(server, port)) { // เริ่มการเชื่อมต่อกับเซิร์ฟเวอร์ที่กำหนด
      Serial.println("Connected to server!");

      // สร้างข้อมูลสำหรับส่งผ่าน HTTP POST
      String postData = "sensor=" + sensorValue; // ข้อมูลที่ต้องการส่งในรูปแบบ key=value

      // เริ่มต้น HTTP POST Request
      client.println("POST " + String(path) + " HTTP/1.1"); // ระบุชนิดของคำขอและไฟล์ปลายทาง
      client.println("Host: " + String(server)); // ระบุชื่อเซิร์ฟเวอร์
      client.println("Content-Type: application/x-www-form-urlencoded"); // กำหนดชนิดของข้อมูลที่ส่ง
      client.print("Content-Length: ");
      client.println(postData.length()); // ระบุความยาวของข้อมูลที่ส่ง
      client.println(); // เว้นบรรทัดเพื่อสิ้นสุดส่วนหัว HTTP
      client.print(postData); // ส่งข้อมูลจริงไปยังเซิร์ฟเวอร์

      // อ่านการตอบกลับจากเซิร์ฟเวอร์
      while (client.connected()) { // ตรวจสอบว่ายังคงเชื่อมต่อกับเซิร์ฟเวอร์อยู่หรือไม่
        if (client.available()) { // ตรวจสอบว่ามีข้อมูลจากเซิร์ฟเวอร์หรือไม่
          String line = client.readStringUntil('\n'); // อ่านข้อมูลทีละบรรทัด
          Serial.println(line); // แสดงผลใน Serial Monitor
        }
      }

      // ปิดการเชื่อมต่อ
      client.stop();
      Serial.println("Disconnected from server.");
    } else {
      Serial.println("Connection to server failed."); // แสดงข้อความเมื่อเชื่อมต่อเซิร์ฟเวอร์ล้มเหลว
    }
  } else {
    Serial.println("WiFi not connected."); // แสดงข้อความเมื่อ WiFi หลุดการเชื่อมต่อ
  }

  delay(10000); // รอ 10 วินาทีก่อนส่งข้อมูลครั้งถัดไป
}

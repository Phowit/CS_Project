#include <ESP8266WiFi.h>  // ไลบรารีสำหรับเชื่อมต่อ Wi-Fi

const char* server = "192.168.1.1"; // IP หรือโดเมนของเซิร์ฟเวอร์ (ควรตรงกับเครื่องที่รัน PHP)
const int port = 80;                 // พอร์ตสำหรับ HTTP (ค่าเริ่มต้นคือ 80)

String rfid = ""; // ตัวแปรประเภท String เพื่อเก็บข้อมูล UID ของแท็ก RFID
const char* ssid = "Khomsan_2.4G"; // ชื่อ Wi-Fi ที่จะเชื่อมต่อ
const char* password = "Khomtap13281011"; // รหัสผ่าน Wi-Fi

// [Khomsan_2.4G , Khomtap13281011] 
// [Phowit_5g , 0638967226]

const char* server_ip = "192.168.1.1"; // IP Address ของเซิร์ฟเวอร์ที่ต้องการเชื่อมต่อ C:\xampp\htdocs
String server_url = "GET http://192.168.1.1/project_iot/CS_Project/CS_Project_Phowit-Chuachan_Code_16432048/Arduino_Test.php?"; // URL ที่ใช้ส่งคำขอ HTTP ไปยังเซิร์ฟเวอร์
const int httpPort = 80; // พอร์ตที่ใช้สำหรับ HTTP (พอร์ตมาตรฐานคือ 80)

// URL สำหรับส่งข้อมูลไปยังเซิร์ฟเวอร์ (ไฟล์ PHP)
String serverName = "http://CS_Project/Arduino_Test.php"; 

unsigned long timeout = millis();

void setup() {
  Serial.begin(9600); // Serial สำหรับ Debug

  Serial.println("Setup complete!");
  WiFi.begin(ssid, password);       // เริ่มเชื่อมต่อ WiFi

  while (WiFi.status() != WL_CONNECTED) {
        delay(500);
        Serial.print(".");
  }
  
  Serial.println("");
  Serial.println("WiFi connected");
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());
}

void loop() {
  // เชื่อมต่อ server
  Serial.print("connecting to: ");
  Serial.println(server_ip);
  WiFiClient client;

  if (!client.connect(server_ip, httpPort)) { // เชื่อมต่อไปยังเซิร์ฟเวอร์ หากไม่สำเร็จให้แจ้ง
    Serial.println("connection failed"); // แจ้งว่าเชื่อมต่อไม่สำเร็จ
    return; // ออกจากฟังก์ชัน
  }

  // ส่ง GET request ไปที่ server พร้อมกับข้อมูล "1"
  client.print(server_url + "A=1\r\n" + "Connection: close\r\n\r\n");
  Serial.println("ส่งข้อมูลแล้ว");
/*
  while (client.available() == 0) { // รอจนกว่ามีข้อมูลตอบกลับจากเซิร์ฟเวอร์
    if (millis() - timeout > 1000) { // หากรอนานเกิน 1 วินาที ให้หยุดรอ
      Serial.println(">>> Client Timeout !"); // แจ้งว่าเกิด Timeout
      client.stop(); // ปิดการเชื่อมต่อ
      return; // ออกจากฟังก์ชัน
    }
  }*/

  client.stop(); // ปิดการเชื่อมต่อกับเซิร์ฟเวอร์
    Serial.println("closing connection"); // แจ้งว่ากำลังปิดการเชื่อมต่อ
    delay(10000); // รอ 5 วินาที
}

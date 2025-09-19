#include <WiFi.h>
#include <WebServer.h>
#include <ESPmDNS.h>

const char* ssid = "Phowit_2.4g";
const char* password = "0638967226";
// Phowit_2.4g --> 0638967226 --> 192.168.1.55
// ARU_WIFI --> 1234567890
// A --> 1234567890 --> 10.166.224.111

// ---- ตั้งค่า Static IP ----
// เลือก IP ในวงเดียวกับ Router ของคุณ แต่ไม่ชนกับอุปกรณ์อื่น
IPAddress local_IP(192, 168, 1, 150);   // ✅ IP ที่จะให้ ESP32 ใช้
IPAddress gateway(192, 168, 1, 1);     // Gateway ปกติคือ IP ของ Router เช่น 192.168.1.1
IPAddress subnet(255, 255, 255, 0);    // Subnet ปกติใช้ 255.255.255.0
IPAddress primaryDNS(8, 8, 8, 8);      // DNS (Google)
IPAddress secondaryDNS(8, 8, 4, 4);    // DNS (Google)

WebServer server(80);

// เริ่ม กำหนดขาที่ใช้ต่อ Relay ---------------------------------------
const int relay1 = 4;  
const int relay2 = 16;  
const int relay3 = 17;  
// เริ่ม กำหนดขาที่ใช้ต่อ Relay ---------------------------------------

int val = 0; // ค่าเริ่มต้น 0

void handleData() {
  if (server.hasArg("value")) {
    val = server.arg("value").toInt(); // แปลง String เป็น int
    Serial.print("ได้รับค่า: ");
    Serial.println(val);
    server.send(200, "text/plain", "OK ได้รับค่า: " + String(val));
  } else {
    server.send(400, "text/plain", "ไม่พบค่า");
  }
}

void setup() {
  Serial.begin(115200);
  pinMode(2, OUTPUT);

  // ---- ตั้งค่า Static IP ----
  if (!WiFi.config(local_IP, gateway, subnet, primaryDNS, secondaryDNS)) {
    Serial.println("⚠️ Failed to configure Static IP");
  }

  WiFi.begin(ssid, password);

  Serial.print("กำลังเชื่อมต่อ WiFi");
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("\nเชื่อมต่อแล้ว!");
  Serial.print("IP Address: ");
  Serial.println(WiFi.localIP());

  server.on("/data", handleData);
  server.begin();
  Serial.println("HTTP server started");

  // ตั้งค่า relay เป็น Output
  pinMode(relay1, OUTPUT);
  pinMode(relay2, OUTPUT);
  pinMode(relay3, OUTPUT);

  // เริ่มต้น ปิดทุก Relay
  digitalWrite(relay1, HIGH);
  digitalWrite(relay2, HIGH);
  digitalWrite(relay3, HIGH);
  // HIGH = ปิด (บางโมดูลเป็น Active LOW)
}

void loop() {
  server.handleClient();

  if(val == 1) {
    digitalWrite(relay1, LOW);
    digitalWrite(relay2, HIGH);
    digitalWrite(relay3, HIGH);
  }
  else if ( val == 2 ) {
    digitalWrite(relay1, LOW);
    digitalWrite(relay2, LOW);
    digitalWrite(relay3, HIGH);
  }
  else if ( val == 3 ) {
    digitalWrite(relay1, LOW);
    digitalWrite(relay2, LOW);
    digitalWrite(relay3, LOW);
  }
  else {
    digitalWrite(relay1, HIGH);
    digitalWrite(relay2, HIGH);
    digitalWrite(relay3, HIGH);
  }
  delay(5000);
}

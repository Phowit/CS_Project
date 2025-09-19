#include <ESP8266WebServer.h>

const char* ssid = "Phowit_2.4g";
const char* password = "0638967226";
// Phowit_2.4g --> 0638967226 --> 192.168.1.55
// ARU_WIFI --> 1234567890
// A --> 1234567890 --> 10.166.224.111

IPAddress local_IP(192, 168, 1, 155);
IPAddress gateway(192, 168, 1, 1);
IPAddress subnet(255, 255, 255, 0);
IPAddress primaryDNS(8, 8, 8, 8);
IPAddress secondaryDNS(8, 8, 4, 4);

ESP8266WebServer server(80);

int val = 0; // ค่าเริ่มต้น 0 รับมาจากเว็บ

void handleData() {
  if (server.hasArg("value")) {
    val = server.arg("value").toInt();
    Serial.print("ได้รับค่า: ");
    Serial.println(val);
    server.send(200, "text/plain", "OK ได้รับค่า: " + String(val));
  } else {
    server.send(400, "text/plain", "ไม่พบค่า");
  }
}

void setup() {
  Serial.begin(115200); // เริ่ม Serial
  Serial.println();
  Serial.print("Connecting to WiFi");

  if (!WiFi.config(local_IP, gateway, subnet)) {
    Serial.println("⚠️ Failed to configure Static IP");
  }

  WiFi.begin(ssid, password);

  // รอการเชื่อมต่อ WiFi
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("\nConnected to WiFi!");
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());

  server.on("/data", handleData);
  server.begin();
  Serial.println("HTTP server started");
}

void loop() {
  server.handleClient();
}
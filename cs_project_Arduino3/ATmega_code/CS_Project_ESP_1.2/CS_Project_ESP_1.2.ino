#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <ESP8266WebServer.h>

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

int val = 0; // ค่าเริ่มต้น 0 รับมาจากเว็บ

String inputData = "";  //แพ็คข้อมูล

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
  
  if (Serial.available()) {
    String line = Serial.readStringUntil('\n');
    line.trim();

    if (line.startsWith("PACK=")) {
      String data = line.substring(5);  // ตัด "PACK=" ออก

      if (WiFi.status() == WL_CONNECTED) {
        WiFiClient client;
        HTTPClient http;

        String url = "http://" + String(host) + endpoint + "?pack=" + data;
        Serial.println("Requesting: " + url);

        http.begin(client, url);
        int httpCode = http.GET();

        if (httpCode > 0) {
          String payload = http.getString();
          Serial.println("HTTP Response Code: " + String(httpCode));
          Serial.println("Server Response: " + payload);
          Serial.println("Data sent successfully ✅"); // ข้อความแจ้งส่งสำเร็จ
        } else {
          Serial.println("HTTP request failed ❌, error: " + http.errorToString(httpCode));
        }
        http.end();
      } else {
        Serial.println("WiFi not connected ❌");
      }
    }
  }
}


void sendToServer(String data) {
  if (WiFi.status() == WL_CONNECTED) {
    WiFiClient client;
    HTTPClient http;

    String url = "http://" + String(host) + endpoint + "?packet=" + data;
    Serial.println("Requesting URL: " + url);

    http.begin(client, url);
    int httpCode = http.GET();

    if (httpCode > 0) {
      String payload = http.getString();
      Serial.println("Response: " + payload);
    } else {
      Serial.println("HTTP request failed, error: " + http.errorToString(httpCode));
    }
    http.end();
  } else {
    Serial.println("WiFi not connected!");
  }
}

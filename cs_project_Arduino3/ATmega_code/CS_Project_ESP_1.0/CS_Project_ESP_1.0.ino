#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>

const char* ssid = "Phowit_2.4g";
const char* password = "0638967226";
// Phowit_2.4g --> 0638967226 --> 192.168.1.55
// ARU_WIFI --> 1234567890
// A --> 1234567890 --> 10.166.224.111

const char* host = "192.168.1.55";
const String endpoint = "/CS_Project/CS_Project_Phowit-Chuachan_Code_16432048/data.php";

String inputData = "";  //แพ็คข้อมูล

void setup() {
  Serial.begin(115200); // เริ่ม Serial
  Serial.println();
  Serial.print("Connecting to WiFi");

  WiFi.begin(ssid, password);

  // รอการเชื่อมต่อ WiFi
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("\nConnected to WiFi!");
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());
}

void loop() {
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

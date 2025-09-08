#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>

const char* ssid = "Phowit_2.4g";
const char* password = "0638967226";
// Phowit_2.4g --> 0638967226 --> 192.168.1.55
// ARU_WIFI --> 1234567890
// A --> 1234567890 --> 10.166.224.111

const char* host = "192.168.1.55";
const String endpoint = "/CS_Project/CS_Project_Phowit-Chuachan_Code_16432048/data.php";

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
  // ตรวจสอบว่ามีข้อมูลใน Serial หรือไม่
  if (Serial.available() > 0) {
    float temperature = Serial.parseFloat();

    if (temperature != 0.0) {
      if (WiFi.status() == WL_CONNECTED) {
        WiFiClient client;
        HTTPClient http;

        // สร้าง URL
        String url = "http://" + String(host) + endpoint + "?value=" + String(temperature);
        Serial.println("Requesting URL: " + url);

        http.begin(client, url);
        int httpCode = http.GET();

        if (httpCode > 0) {
          Serial.println("HTTP Response code: " + String(httpCode));
          String payload = http.getString();
          Serial.println("Response: " + payload);
        } else {
          Serial.println("HTTP request failed, error: " + String(http.errorToString(httpCode)));
        }

        http.end();
      } else {
        Serial.println("WiFi not connected!");
      }

      // delay เพื่อไม่ให้ส่งบ่อยเกินไป
      delay(1000);
    }
  }
}

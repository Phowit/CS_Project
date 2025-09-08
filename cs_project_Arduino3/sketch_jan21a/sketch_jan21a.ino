#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>

const char* ssid = "A";              // SSID Wi-Fi
const char* password = "1234567890"; // Password Wi-Fi

// Server (ต้องเป็น IP/Domain เท่านั้น ไม่ใส่ path)
const char* host = "10.166.224.111";

// Path ของไฟล์ PHP
const String endpoint = "/CS_Project/CS_Project_Phowit-Chuachan_Code_16432048/data.php";

void setup() {
  Serial.begin(115200);
  delay(100);

  Serial.println();
  Serial.println("Connecting to WiFi...");
  WiFi.begin(ssid, password);

  // รอจนกว่า Wi-Fi จะเชื่อมต่อ
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println();
  Serial.println("WiFi connected!");
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());
}

void loop() {
  if (WiFi.status() == WL_CONNECTED) {
    float temperature = 1.0; // ค่าที่จะส่ง Serial.parseFloat();

    WiFiClient client;
    HTTPClient http;

    // ประกอบ URL แบบถูกต้อง
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

  delay(5000); // ส่งข้อมูลทุก 5 วินาที
}

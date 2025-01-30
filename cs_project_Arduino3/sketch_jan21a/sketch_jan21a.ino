#include <ESP8266WiFi.h> // ไลบรารีสำหรับเชื่อมต่อ Wi-Fi บน ESP8266
#define LED 13
const char* ssid = "Phowit_5g";
const char* password = "0638967226";
unsigned char status_led = 0;
WiFiServer server(80);
void setup() {
  Serial.begin(9600);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED)
  {
    delay(500);
  }
  server.begin();
  Serial.println("Server started");
  Serial.println(WiFi.localIP());
}
void loop() {
  WiFiClient client = server.available();
  if (!client) {
    return;
  }

  while (!client.available())
  {
    delay(1);
  }
  String req = client.readStringUntil('\r');
  client.flush();
  if (req.indexOf("/ledoff") != -1)
  {
    status_led = 0;
    Serial.print("0");
  }
  else if (req.indexOf("/ledon") != -1)
  {
    status_led = 1;
    Serial.print("1");
  }
  String web = "HTTP/1.1 200 OK\r\nContent-Type: text/html\r \n\r\n";
  web += "<html>\r\n";
  web += "<body>\r\n";
  web += "<h1>MY Arduino</h1>\r\n";
  web += "<h2>Arduino ATmega328ESP8266</h2>\r\n";
  web += "<p>\r\n";
  if (status_led == 1)
    web += "LED On\r\n";
  else
    web += "LED Off\r\n";
  web += "</p>\r\n";
  web += "<p>\r\n";
  web += "<a href=\"/ledon\">\r\n";
  web += "<button>LED On</button>\r\n";
  web += "</a>\r\n";
  web += "</p>\r\n";
  web += "<a href=\"/ledoff\">\r\n";
  web += "<button>LED Off</button>\r\n";
  web += "</a>\r\n";
  web += "</body>\r\n";
  web += "</html>\r\n";

  web += "<html>\r\n";
  web += "<body>\r\n";
  web += "<h4>www.myarduino.net</h4>\r\n";
  web += "<p>\r\n";
  client.print(web);
}
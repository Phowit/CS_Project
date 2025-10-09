#include "WiFi_Setup.h"

WiFiSetup wifiSetup;

void setup() {
  Serial.begin(115200);
  delay(1000);
  wifiSetup.connectWiFi();
}

void loop() {
  // รันโปรแกรมปกติที่นี่ เช่น ส่งข้อมูล ฯลฯ
}

// CSP_Adurino_SI_1.0
// CS = Computer science
// P = Project
// S = Sensor
// I = Input
#include "UltrasonicSensors.h"
#include "WaterSensors.h"
#include "TemperatureSensor.h"
#include "ServoControl.h"
#include "WiFiSetup.h"
#include "WebClient.h"

void setup() {
  Serial.begin(115200);

  // เชื่อมต่อ WiFi
  WiFiSetup::connectWiFi();

  // เริ่มต้นอุปกรณ์ทั้งหมด
  UltrasonicSensors::init();
  WaterSensors::init();
  TemperatureSensor::init();
  ServoControl::init();
  WebClient::init();
}

void loop() {
  // อ่านค่าจากอุปกรณ์
  UltrasonicSensors::readAll();
  WaterSensors::readAll();
  TemperatureSensor::read();

  // ส่งข้อมูลทุก ๆ 15 นาที
  WebClient::sendData();

  // รับคำสั่งจากเว็บ
  WebClient::receiveCommand();

  // ตัวอย่างเชื่อม Ultrasonic + Servo
  if (UltrasonicSensors::getLevel(2) < 10) {  // ถ้า sensor ตัวที่ 2 < 10cm
    ServoControl::stop();
  }
}

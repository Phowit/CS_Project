//ส่วนของการนำเข้าไฟล์ต่างๆ และ library ที่จำเป็น
#include <Arduino.h>
#include "UltrasonicSensors.h"
#include "WaterSensors.h"
#include "TemperatureSensor.h"
#include "ServoControl.h"
#include "RelayControl.h"


// ตัวแปรเวลา เวลาจะถูกนับการทำงานในนี้ ดังนั้นจึงอยู่ไฟล์นี้
unsigned long previousSensorMillis = 0;
unsigned long previousSendMillis   = 0;

const unsigned long sensorInterval = 60000;    // 1 นาที
const unsigned long sendInterval   = 900000;   // 15 นาที


// put function declarations here:
int myFunction(int, int);

void setup() {
  Serial.begin(115200);
  Serial.println("Connect success");

  UltrasonicSensors::init();
  WaterSensors::init();
  TemperatureSensor::init();
  //ServoControl::init();
}

void loop() {
  unsigned long currentMillis = millis(); //เริ่มนับเวลา

  // อ่าน sensor ทุก 1 นาที โดยใช้การเรียก class 
  if (currentMillis - previousSensorMillis >= sensorInterval) {
    previousSensorMillis = currentMillis;

    TemperatureSensor::read();
    UltrasonicSensors::readAll();
    WaterSensors::read();

    TemperatureSensor::log();
    UltrasonicSensors::log();
    WaterSensors::log();
  }

  // ส่งข้อมูลทุก 15 นาที
  if (currentMillis - previousSendMillis >= sendInterval) {
    previousSendMillis = currentMillis;

    Serial.print("PACK=");
    Serial.print(TemperatureSensor::get_TemperatureLevel());
    Serial.print(";");
    Serial.print(UltrasonicSensors::get_FoodLevel());
    Serial.print(";");
    Serial.print(UltrasonicSensors::get_FoodTray1());
    Serial.print(";");
    Serial.print(UltrasonicSensors::get_FoodTray2());
    Serial.print(";");
    Serial.print(WaterSensors::get_WaterHigh());
    Serial.print(";");
    Serial.print(WaterSensors::get_WaterLow());
    Serial.println();
  }
}

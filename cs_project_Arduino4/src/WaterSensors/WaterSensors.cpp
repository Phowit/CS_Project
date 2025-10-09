#include <Arduino.h>
#include "WaterSensors.h"

const int WaterSensorPin1 = 6;  // ต่อที่ขา 6

const int WaterSensorPin2 = 5;  // ต่อที่ขา 5

static unsigned int WaterLevel_High, WaterLevel_Low;
// d = distant

void WaterSensors::init() {
  pinMode(WaterSensorPin1, INPUT);
  pinMode(WaterSensorPin2, INPUT);
}

void WaterSensors::read() {
  WaterLevel_High = digitalRead(WaterSensorPin1);
  WaterLevel_Low = digitalRead(WaterSensorPin2);
}

void WaterSensors::log() {
  Serial.print(", W1="); Serial.print(WaterLevel_High);
  Serial.print(", W2="); Serial.print(WaterLevel_Low);
}

unsigned int WaterSensors::get_WaterHigh() { return WaterLevel_High; }
unsigned int WaterSensors::get_WaterLow() { return WaterLevel_Low; }
//เขียนแบบแยกไฟล์/มืออาชีพ → ใช้ get() + return เพื่อซ่อนตัวแปร (Encapsulation) ปลอดภัยกว่าและทำให้โค้ดดูเป็นระบบ

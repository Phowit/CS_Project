#include <Arduino.h>
#include <NewPing.h>
#include "UltrasonicSensors.h"

#define TRIG1 8
#define ECHO1 7
#define TRIG2 10
#define ECHO2 9
#define TRIG3 12
#define ECHO3 11
#define MAX_DISTANCE 100

NewPing sonar1(TRIG1, ECHO1, MAX_DISTANCE);
NewPing sonar2(TRIG2, ECHO2, MAX_DISTANCE);
NewPing sonar3(TRIG3, ECHO3, MAX_DISTANCE);

static unsigned int d1_FoodLevel, d2_FoodTray1, d3_FoodTray2;
// d = distant

void UltrasonicSensors::init() {
  // ไม่มีอะไรพิเศษ แต่แยกไว้เผื่ออนาคต
}

void UltrasonicSensors::readAll() {
  d1_FoodLevel = sonar1.ping_cm();
  d2_FoodTray1 = sonar2.ping_cm();
  d3_FoodTray2 = sonar3.ping_cm();
}

void UltrasonicSensors::log() {
  Serial.print(", S1="); Serial.print(d1_FoodLevel);
  Serial.print(", S2="); Serial.print(d2_FoodTray1);
  Serial.print(", S3="); Serial.print(d3_FoodTray2);
}

unsigned int UltrasonicSensors::get_FoodLevel() { return d1_FoodLevel; }
unsigned int UltrasonicSensors::get_FoodTray1() { return d2_FoodTray1; }
unsigned int UltrasonicSensors::get_FoodTray2() { return d3_FoodTray2; }
//เขียนแบบแยกไฟล์/มืออาชีพ → ใช้ get() + return เพื่อซ่อนตัวแปร (Encapsulation) ปลอดภัยกว่าและทำให้โค้ดดูเป็นระบบ

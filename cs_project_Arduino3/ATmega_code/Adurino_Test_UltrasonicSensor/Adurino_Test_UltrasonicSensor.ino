#include <NewPing.h>

// กำหนดขาพินดิจิตอลสำหรับ ultrasonic 3 ตัว
#define TRIG1 6
#define ECHO1 5

#define TRIG2 8
#define ECHO2 7

#define TRIG3 10
#define ECHO3 9

#define MAX_DISTANCE 300  // ระยะสูงสุด cm

NewPing sonar1(TRIG1, ECHO1, MAX_DISTANCE);
NewPing sonar2(TRIG2, ECHO2, MAX_DISTANCE);
NewPing sonar3(TRIG3, ECHO3, MAX_DISTANCE);

void setup() {
  Serial.begin(115200);

  Serial.println("Connect success");
}

void loop() {
  // เริ่ม ส่วนกำหนดตัวแปรหลัก
  delay(100); // หน่วงเล็กน้อยเพื่อความเสถียร
  unsigned int distance1 = sonar1.ping_cm(); // อ่านค่าระยะ (cm)

  delay(100); // หน่วงเล็กน้อยเพื่อความเสถียร
  unsigned int distance2 = sonar2.ping_cm(); // อ่านค่าระยะ (cm)

  delay(100); // หน่วงเล็กน้อยเพื่อความเสถียร
  unsigned int distance3 = sonar3.ping_cm(); // อ่านค่าระยะ (cm)
  // int levelA = map(RangeInCentimeters,0 ,22 ,16 ,0 ); //สูงสุดของบรรจุภันฑ์ ที่ใช้ในงานนี้ คือ 22 cm
  // จบ ส่วนกำหนดตัวแปรหลัก

  //แสดงผล บนจอมอนิเตอร์
  // ตัวที่ 1
  if (distance1 == 0) {
    Serial.println("Sensor 1: Out of range"); 
  }
  else {
    Serial.print("Sensor 1: "); Serial.print(distance1); Serial.println(" cm");
  }

  // ตัวที่ 2
  if (distance2 == 0) {
    Serial.println("Sensor 2: Out of range");
  }
  else {
    Serial.print("Sensor 2: "); Serial.print(distance2); Serial.println(" cm");
  }

  // ตัวที่ 3
  if (distance3 == 0) {
    Serial.println("Sensor 3: Out of range");
  }
  else {
    Serial.print("Sensor 3: "); Serial.print(distance3); Serial.println(" cm");
  }

  Serial.println("-------------------------");
  delay(5000);
      //จบ การแสดงผล บนจอมอนิเตอร์
}
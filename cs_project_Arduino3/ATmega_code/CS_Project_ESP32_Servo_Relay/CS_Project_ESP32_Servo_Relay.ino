#include <ESP32Servo.h>  // ใช้แทน Servo.h

// สร้างออบเจ็กต์ servo
Servo servo1;
Servo servo2;

// เริ่ม กำหนดขาที่ใช้ต่อ Relay ---------------------------------------
const int relay1 = 25;
const int relay2 = 26;
const int relay3 = 27;
// เริ่ม กำหนดขาที่ใช้ต่อ Relay ---------------------------------------

void setup() {
  Serial.begin(115200); // เริ่ม Serial
  
  Serial.println("Connect success");

  // ตั้งค่า relay เป็น Output
  pinMode(relay1, OUTPUT);
  pinMode(relay2, OUTPUT);
  pinMode(relay3, OUTPUT);

  // เริ่มต้น ปิดทุก Relay
  digitalWrite(relay1, HIGH);
  digitalWrite(relay2, HIGH);
  digitalWrite(relay3, HIGH);

  // Attach Servo
  servo1.attach(18);
  servo2.attach(19);

  servo1.write(90);
  servo2.write(90);
}

void loop() {
  // เปิด-ปิด Relay
  Serial.println("เปิด Relay 1");
  digitalWrite(relay1, LOW); // ถ้า Active LOW
  Serial.println("เปิด servo1");
  servo1.attach(18);
  servo1.write(180);
  delay(5000);

  Serial.println("ปิด Relay 1");
  digitalWrite(relay1, HIGH);
  Serial.println("ปิด servo1");
  servo1.detach();
  delay(5000);
  Serial.println("");

  // เปิด-ปิด Relay
  Serial.println("เปิด Relay 2");
  digitalWrite(relay2, LOW); // ถ้า Active LOW
  Serial.println("เปิด servo2");
  servo2.attach(19);
  servo2.write(180);
  delay(5000);

  Serial.println("ปิด Relay 2");
  digitalWrite(relay2, HIGH);
  Serial.println("ปิด servo2");
  servo2.detach();
  delay(5000);
  Serial.println("");

  // เปิด-ปิด Relay
  Serial.println("เปิด Relay 3");
  digitalWrite(relay3, LOW); // ถ้า Active LOW
  servo1.attach(18);
  servo2.attach(19);
  servo1.write(180);
  servo2.write(180);
  delay(5000);
  Serial.println("ปิด Relay 3");
  digitalWrite(relay3, HIGH);
  servo1.detach();
  servo2.detach();
  delay(5000);
  Serial.println("");

  Serial.println("-------------- จบการทำงาน 1 รอบ ---------------");
  delay(5000);
}

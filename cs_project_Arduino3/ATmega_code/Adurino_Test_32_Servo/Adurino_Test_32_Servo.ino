#include <ESP32Servo.h>  // ใช้แทน Servo.h


// สร้างออบเจ็กต์ servo
Servo servo1;
Servo servo2;


void setup() {
  Serial.begin(115200);

  Serial.println("Connect success");

  // Attach Servo
  servo1.attach(18);
  servo2.attach(19);

  servo1.write(90);
  servo2.write(90);
}

void loop() {
  // เปิด-ปิด Relay
  Serial.println("เปิด servo1");
  servo1.attach(18);
  servo1.write(180);
  delay(5000);

  Serial.println("ปิด servo1");
  servo1.detach();
  delay(5000);
  Serial.println("");

  Serial.println("-------------- จบการทำงาน 1 รอบ ---------------");
  delay(5000);
}
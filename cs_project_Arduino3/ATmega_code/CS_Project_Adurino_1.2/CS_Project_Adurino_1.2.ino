// 1. ปรับ DIP switch 5 , 6 , 7 on แล้วกด upload
// 2. ปรับ DIP switch 7 off , 5 and 6 on แล้วกดปุ่มสีแดงบนบอร์ด (reset) แล้วกด upload อีกครั้ง

// เริ่ม ส่วนการ include ---------------------------------------
#include <NewPing.h>  //ultrasonic sensor
#include <math.h>     //คำนวน
#include <Servo.h> //เรียกใช้ไลบารี่Servo.h
// จบ ส่วนการ include ---------------------------------------


// เริ่ม ส่วนการจัดการเวลา ---------------------------------------
unsigned long previousSensorMillis = 0;
unsigned long previousSendMillis = 0;

const unsigned long sensorInterval = 60000;   // อ่าน sensor ทุก 1 นาที
const unsigned long sendInterval   = 900000;  // ส่งข้อมูลทุก 15 นาที
// จบ ส่วนการจัดการเวลา ---------------------------------------


// เริ่ม ส่วนการคำนวนค่าองศา c 1 ---------------------------------------
const int R0 = 100000; // R0 = 100k
const int B = 4275; // B value of the thermistor
// จบ ส่วนการคำนวนค่าองศา c 1 ---------------------------------------


// เริ่ม กำหนดขาพินดิจิตอลสำหรับ ultrasonic 3 ตัว ---------------------------------------
#define TRIG3 12
#define ECHO3 11

#define TRIG2 10
#define ECHO2 9

#define TRIG1 8
#define ECHO1 7

#define MAX_DISTANCE 100  // ระยะสูงสุด cm

NewPing sonar1(TRIG1, ECHO1, MAX_DISTANCE);
NewPing sonar2(TRIG2, ECHO2, MAX_DISTANCE);
NewPing sonar3(TRIG3, ECHO3, MAX_DISTANCE);
// จบ กำหนดขาพินดิจิตอลสำหรับ ultrasonic 3 ตัว ---------------------------------------


// เริ่ม กำหนดขาพินและค่าสำหรับ water level sensor ---------------------------------------
const int WaterSensorPin1 = 6;  // ต่อที่ขา 6
int WaterSensorState1 = 0;

const int WaterSensorPin2 = 5;  // ต่อที่ขา 5
int WaterSensorState2 = 0;
// จบ กำหนดขาพินและค่าสำหรับ water level sensor ---------------------------------------


// เริ่ม กำหนดขาที่ใช้ต่อ Relay ---------------------------------------
const int relay1 = A1;  
const int relay2 = A2;  
const int relay3 = A3;  
// เริ่ม กำหนดขาที่ใช้ต่อ Relay ---------------------------------------


// เริ่ม ส่วนการประกาศ seivo
Servo ServoFoodLevel;
Servo ServoFoodTrayLevel;
// จบ ส่วนการประกาศ seivo


// เริ่ม ส่วนการเก็บค่าล่าสุดของ sensor
float latestTemperature = 0;
unsigned int latestDistance1 = 0;
unsigned int latestDistance2 = 0;
unsigned int latestDistance3 = 0;
int latestWater1 = 0;
int latestWater2 = 0;
// จบ เก็บค่าล่าสุดของ sensor


void setup() {
  Serial.begin(115200);

  Serial.println("Connect success");

  pinMode(A0,INPUT);  // temperature sensor

  // ตั้งค่า relay เป็น Output
  pinMode(relay1, OUTPUT);
  pinMode(relay2, OUTPUT);
  pinMode(relay3, OUTPUT);

  // เริ่มต้น ปิดทุก Relay
  digitalWrite(relay1, LOW);
  digitalWrite(relay2, LOW);
  digitalWrite(relay3, LOW);
  // HIGH = ปิด (บางโมดูลเป็น Active LOW)

  ServoFoodLevel.attach(3); // กำหนดขา 3 ควบคุม Servo   myservo.write(-360);
  ServoFoodTrayLevel.attach(4); // กำหนดขา 4 ควบคุม Servo   myservo.write(-360);
}

void loop() {
  ServoFoodLevel.write(-360);
  ServoFoodTrayLevel.write(-360);
  unsigned long currentMillis = millis();

  // ------- เริ่ม ส่วนการอ่าน sensor ทุก 1 นาที -------
  if (currentMillis - previousSensorMillis >= sensorInterval) {
      previousSensorMillis = currentMillis;

      // อ่าน temperature
      int a = analogRead(A0);
      if (a != 0) {
        float R = 1023.0 / a - 1.0;
        R = R0 * R;
        latestTemperature = 1.0 / (log(R / R0) / B + 1 / 298.15) - 273.15;
      }

      // อ่าน ultrasonic
      latestDistance1 = sonar1.ping_cm();
      latestDistance2 = sonar2.ping_cm();
      latestDistance3 = sonar3.ping_cm();

      // อ่าน water sensor
      latestWater1 = digitalRead(WaterSensorPin1);
      latestWater2 = digitalRead(WaterSensorPin2);

      // log ทุกๆ 1 นาที
      Serial.print("LOG: TEMP="); Serial.print(latestTemperature);
      Serial.print(", S1="); Serial.print(latestDistance1);
      Serial.print(", S2="); Serial.print(latestDistance2);
      Serial.print(", S3="); Serial.print(latestDistance3);
      Serial.print(", W1="); Serial.print(latestWater1);
      Serial.print(", W2="); Serial.println(latestWater2);
    }
  // ------- จบ ส่วนการอ่าน sensor ทุก 1 นาที -------


  // ------- เริ่ม ส่วนการส่งข้อมูลทุก 15 นาที -------
    if (currentMillis - previousSendMillis >= sendInterval) {
    previousSendMillis = currentMillis;

    Serial.print("PACK=");
    Serial.print(latestTemperature);
    Serial.print(";");
    Serial.print(latestDistance1);
    Serial.print(";");
    Serial.print(latestDistance2);
    Serial.print(";");
    Serial.print(latestDistance3);
    Serial.print(";");
    Serial.print(latestWater1);
    Serial.print(";");
    Serial.print(latestWater2);
    Serial.println(); // <-- สำคัญ! ให้ ESP รู้ว่าจบแพ็กแล้ว
  }
  // ------- จบ ส่วนการส่งข้อมูลทุก 15 นาที -------

}
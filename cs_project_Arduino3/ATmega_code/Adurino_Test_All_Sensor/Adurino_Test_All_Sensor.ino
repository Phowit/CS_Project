// เริ่ม ส่วนการ include ---------------------------------------
#include <NewPing.h>
#include <math.h>
// จบ ส่วนการ include ---------------------------------------


// เริ่ม ส่วนการจัดการเวลา ---------------------------------------
unsigned long previousMillis = 0;
const unsigned long interval = 900000; // 15 นาที = 900,000 ms
// จบ ส่วนการจัดการเวลา ---------------------------------------


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
const int WaterSensorPin1 = 6;  // ต่อที่ขา D3
int WaterSensorState1 = 0;

const int WaterSensorPin2 = 5;  // ต่อที่ขา D2
int WaterSensorState2 = 0;
// จบ กำหนดขาพินและค่าสำหรับ water level sensor ---------------------------------------


// เริ่ม ส่วนการคำนวนค่าองศา c 1 ---------------------------------------
const int R0 = 100000; // R0 = 100k
const int B = 4275000; // B value of the thermistor
// จบ ส่วนการคำนวนค่าองศา c 1 ---------------------------------------


// เริ่ม กำหนดขาที่ใช้ต่อ Relay ---------------------------------------
const int relay1 = 2;  
const int relay2 = 3;  
const int relay3 = 4;  
// เริ่ม กำหนดขาที่ใช้ต่อ Relay ---------------------------------------

void setup() {
  Serial.begin(115200);

  Serial.println("Connect success");

  pinMode(A0,INPUT); // temperature sensor

  // ตั้งค่า relay เป็น Output
  pinMode(relay1, OUTPUT);
  pinMode(relay2, OUTPUT);
  pinMode(relay3, OUTPUT);

  // เริ่มต้น ปิดทุก Relay
  digitalWrite(relay1, HIGH);
  digitalWrite(relay2, HIGH);
  digitalWrite(relay3, HIGH);
  // HIGH = ปิด (บางโมดูลเป็น Active LOW)
}

void loop() {
  unsigned long currentMillis = millis();

    // เริ่ม ส่วนการคำนวนค่าจาก F เป็น C ---------------------------------------
    float a = analogRead(A0);
    float R = 1023.0/a-1.0;
      R = R0*R;
    float temperature = 1.0/(log(R/R0)/B+1/298.15)-273.15;
    //สูตรในการเปลี่ยนค่าจาก F เป็น C จะต่างจากปกติ เนื่องจากส่วนใหญ่แล้วจะ input C or K แต่บางรุ่นก็ input F 
    // จบ ส่วนการคำนวนค่าจาก F เป็น C ---------------------------------------


    // เริ่ม ส่วนกำหนดตัวแปรหลัก ---------------------------------------
    unsigned int distance1 = sonar1.ping_cm(); // อ่านค่าระยะ (cm)

    delay(50); // หน่วงเล็กน้อยเพื่อความเสถียร
    unsigned int distance2 = sonar2.ping_cm(); // อ่านค่าระยะ (cm)

    delay(50); // หน่วงเล็กน้อยเพื่อความเสถียร
    unsigned int distance3 = sonar3.ping_cm(); // อ่านค่าระยะ (cm)
    // int levelA = map(RangeInCentimeters,0 ,22 ,16 ,0 ); //สูงสุดของบรรจุภันฑ์ ที่ใช้ในงานนี้ คือ 22 cm

    WaterSensorState1 = digitalRead(WaterSensorPin1);
    WaterSensorState2 = digitalRead(WaterSensorPin2);
    // จบ ส่วนกำหนดตัวแปรหลัก ---------------------------------------


    // เริ่ม แสดงผล บนจอมอนิเตอร์ ---------------------------------------
    // องศา temperature sensor
    Serial.print("องศา = ");
    Serial.print(temperature);
    Serial.println(" เซลเซียส");

    // ค่าดิบ temperature sensor
    Serial.print("a = ");
    Serial.println(a);
    Serial.println("");

    // ultrasonic ตัวที่ 1
    if (distance1 == 0) {
      Serial.println("Sensor 1: Out of range"); 
    }
    else {
      Serial.print("Sensor 1: "); Serial.print(distance1); Serial.println(" cm");
    }

    // ultrasonic ตัวที่ 2
    if (distance2 == 0) {
      Serial.println("Sensor 2: Out of range");
    }
    else {
      Serial.print("Sensor 2: "); Serial.print(distance2); Serial.println(" cm");
    }

    // ultrasonic ตัวที่ 3
    if (distance3 == 0) {
      Serial.println("Sensor 3: Out of range");
    }
    else {
      Serial.print("Sensor 3: "); Serial.print(distance3); Serial.println(" cm");
    }

    // water sensor ตัวที่ 1
    if (WaterSensorState1 == HIGH) {
      Serial.println("น้ำถึงระดับที่ตรวจจับแล้ว");
    } else {
      Serial.println("ไม่มีน้ำถึงเซนเซอร์");
    }

    // water sensor ตัวที่ 2
    if (WaterSensorState2 == HIGH) {
      Serial.println("น้ำถึงระดับที่ตรวจจับแล้ว");
    } else {
      Serial.println("ไม่มีน้ำถึงเซนเซอร์");
    }
    Serial.println("-------------------------");
  //จบ การแสดงผล บนจอมอนิเตอร์ ---------------------------------------

  // เริ่ม ตรวจสอบเวลาที่ผ่านไป #################################################################################
  if (currentMillis - previousMillis >= interval) {
    previousMillis = currentMillis; // อัปเดตเวลาล่าสุด

    
  }
  // เริ่ม ตรวจสอบเวลาที่ผ่านไป #################################################################################

}
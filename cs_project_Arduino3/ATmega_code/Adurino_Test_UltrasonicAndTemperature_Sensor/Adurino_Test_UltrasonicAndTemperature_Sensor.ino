#include <NewPing.h>

// เริ่ม กำหนดขาพินดิจิตอลสำหรับ ultrasonic 3 ตัว ---------------------------------------
#define TRIG1 6
#define ECHO1 5

#define TRIG2 8
#define ECHO2 7

#define TRIG3 10
#define ECHO3 9

#define MAX_DISTANCE 100  // ระยะสูงสุด cm

NewPing sonar1(TRIG1, ECHO1, MAX_DISTANCE);
NewPing sonar2(TRIG2, ECHO2, MAX_DISTANCE);
NewPing sonar3(TRIG3, ECHO3, MAX_DISTANCE);
// จบ กำหนดขาพินดิจิตอลสำหรับ ultrasonic 3 ตัว ---------------------------------------

// เริ่ม ส่วนการคำนวนค่าองศา c 1 ---------------------------------------
const int R0 = 100000; // R0 = 100k
const int B = 4275000; // B value of the thermistor
// จบ ส่วนการคำนวนค่าองศา c 1 ---------------------------------------

void setup() {
  Serial.begin(115200);

  Serial.println("Connect success");

  pinMode(A0,INPUT); // temperature sensor
}

void loop() {
  delay(7000);

  // เริ่ม ส่วนการคำนวนค่าจาก F เป็น C ---------------------------------------
  float a = analogRead(A0);
  float R = 1023.0/a-1.0;
    R = R0*R;
  float temperature = 1.0/(log(R/R0)/B+1/298.15)-273.15;
  //สูตรในการเปลี่ยนค่าจาก F เป็น C จะต่างจากปกติ เนื่องจากส่วนใหญ่แล้วจะ input C or K แต่บางรุ่นก็ input F 
  // จบ ส่วนการคำนวนค่าจาก F เป็น C ---------------------------------------


  // เริ่ม ส่วนกำหนดตัวแปรหลัก ---------------------------------------
  delay(1000); // หน่วงเล็กน้อยเพื่อความเสถียร
  unsigned int distance1 = sonar1.ping_cm(); // อ่านค่าระยะ (cm)

  delay(1000); // หน่วงเล็กน้อยเพื่อความเสถียร
  unsigned int distance2 = sonar2.ping_cm(); // อ่านค่าระยะ (cm)

  delay(1000); // หน่วงเล็กน้อยเพื่อความเสถียร
  unsigned int distance3 = sonar3.ping_cm(); // อ่านค่าระยะ (cm)
  // int levelA = map(RangeInCentimeters,0 ,22 ,16 ,0 ); //สูงสุดของบรรจุภันฑ์ ที่ใช้ในงานนี้ คือ 22 cm
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

  Serial.println("-------------------------");
  delay(10000);
  //จบ การแสดงผล บนจอมอนิเตอร์ ---------------------------------------
}
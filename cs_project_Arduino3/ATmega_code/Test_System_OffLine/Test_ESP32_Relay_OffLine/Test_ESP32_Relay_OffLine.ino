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
}

void loop() {
  // เปิด-ปิด Relay
  Serial.println("เปิด Relay 1");
  digitalWrite(relay1, LOW); // ถ้า Active LOW
  delay(5000);

  Serial.println("ปิด Relay 1");
  digitalWrite(relay1, HIGH);
  delay(5000);

  // เปิด-ปิด Relay
  Serial.println("เปิด Relay 2");
  digitalWrite(relay2, LOW); // ถ้า Active LOW
  delay(5000);

  Serial.println("ปิด Relay 2");
  digitalWrite(relay2, HIGH);
  delay(5000);

  // เปิด-ปิด Relay
  Serial.println("เปิด Relay 3");
  digitalWrite(relay3, LOW); // ถ้า Active LOW
  delay(5000);

  Serial.println("ปิด Relay 3");
  digitalWrite(relay3, HIGH);
  delay(5000);

  Serial.println("-------------- จบการทำงาน 1 รอบ ---------------");
  delay(5000);
}

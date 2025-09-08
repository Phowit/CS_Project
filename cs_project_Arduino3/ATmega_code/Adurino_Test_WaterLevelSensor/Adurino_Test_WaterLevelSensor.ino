const int sensorPin = 3;  // ต่อที่ขา D3
int sensorState = 0;

void setup() {
  Serial.begin(115200);
  pinMode(sensorPin, INPUT);
}

void loop() {
  sensorState = digitalRead(sensorPin);
  
  if (sensorState == HIGH) {
    Serial.println("น้ำถึงระดับที่ตรวจจับแล้ว");
  } else {
    Serial.println("ไม่มีน้ำถึงเซนเซอร์");
  }

  delay(500);
}

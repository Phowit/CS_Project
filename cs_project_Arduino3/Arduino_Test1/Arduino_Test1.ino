// ส่วนการคำนวณอุณหภูมิ
const int R0 = 100000;
const int B = 4275;

void setup() {
  Serial.begin(115200); // ตั้งค่า Serial เพื่อส่งข้อมูลไปยัง ESP8266
  pinMode(A0, INPUT);
}

void loop() {
  // อ่านค่าจากเซนเซอร์และคำนวณอุณหภูมิ
  float a = analogRead(A0);
  float R = 1023.0 / a - 1.0;
  R = R0 * R;
  float temperature = 1.0 / (log(R / R0) / B + 1 / 298.15) - 273.15;

  // ส่งค่าอุณหภูมิผ่าน Serial ไปยัง ESP8266
  Serial.println(temperature);
  delay(5000);
}
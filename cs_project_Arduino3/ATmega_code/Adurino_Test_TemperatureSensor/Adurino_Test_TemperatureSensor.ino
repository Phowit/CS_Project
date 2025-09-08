// 1. ปรับ DIP switch 5 , 6 , 7 on แล้วกด upload
// 2. ปรับ DIP switch 7 off , 5 and 6 on แล้วกดปุ่มสีแดงบนบอร์ด (reset) แล้วกด upload อีกครั้ง

// เริ่ม ส่วนการคำนวนค่าองศา c 1 ---------------------------------------
const int R0 = 100000; // R0 = 100k
const int B = 4275000; // B value of the thermistor
// จบ ส่วนการคำนวนค่าองศา c 1 ---------------------------------------

void setup() {
  Serial.begin(115200);

  Serial.println("Connect success");

  pinMode(A0,INPUT);
}

void loop() {

  // เริ่ม ส่วนการคำนวนค่าจาก F เป็น C
  float a = analogRead(A0);
  float R = 1023.0/a-1.0;
    R = R0*R;
  float temperature = 1.0/(log(R/R0)/B+1/298.15)-273.15;
  //สูตรในการเปลี่ยนค่าจาก F เป็น C จะต่างจากปกติ เนื่องจากส่วนใหญ่แล้วจะ input C or K แต่บางรุ่นก็ input F 
  // จบ ส่วนการคำนวนค่าจาก F เป็น C


  // เริ่ม ส่วนการแสดงค่า
  Serial.print("องศา = ");
  Serial.print(temperature);
  Serial.println(" เซลเซียส");
  Serial.print("a = ");
  Serial.println(a);
  Serial.println("");
  delay(5000);
  // จบ ส่วนการแสดงค่า
}
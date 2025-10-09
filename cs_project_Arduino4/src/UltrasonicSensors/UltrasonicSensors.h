#ifndef ULTRASONIC_SENSORS_H  // #ifndef ชื่อมาโคร  --> ย่อมาจาก "if not defined" (ถ้าไม่ได้ถูกกำหนดไว้)
#define ULTRASONIC_SENSORS_H  // พรีโปรเซสเซอร์จะดำเนินการตามโค้ดต่อไป: #define ชื่อมาโคร (กำหนดมาโครนั้นขึ้นมา)
// และรวมโค้ดที่อยู่ระหว่าง #define กับ #endif เข้าไปในการคอมไพล์ ทำให้มั่นใจได้ว่าโค้ดในไฟล์ header นั้นจะถูกรวมเข้ากับการคอมไพล์เพียงครั้งเดียวเท่านั้น

namespace UltrasonicSensors {
  void init();
  void readAll();
  void log();
  unsigned int get_FoodLevel();
  unsigned int get_FoodTray1();
  unsigned int get_FoodTray2();
}

#endif

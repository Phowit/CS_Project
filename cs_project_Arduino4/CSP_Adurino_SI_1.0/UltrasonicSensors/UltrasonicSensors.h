#ifndef ULTRASONIC_SENSORS_H
#define ULTRASONIC_SENSORS_H


// เริ่ม ส่วนการ include ---------------------------------------
#include <NewPing.h>  //ultrasonic sensor
// จบ ส่วนการ include ---------------------------------------


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


class UltrasonicSensors {
public:
    static void init();               // ตั้งค่า (จริง ๆ NewPing ไม่ต้อง init มาก)
    static void readAll();            // อ่าน ultrasonic ทั้งหมด
    static int getLevel(int index);   // คืนค่าระยะจาก sensor ที่เลือก
};

#endif
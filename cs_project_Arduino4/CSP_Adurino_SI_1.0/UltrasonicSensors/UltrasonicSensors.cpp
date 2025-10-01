#include "UltrasonicSensors.h"

// สร้าง object ของ NewPing
static NewPing sonar1(TRIG1, ECHO1, MAX_DISTANCE);
static NewPing sonar2(TRIG2, ECHO2, MAX_DISTANCE);
static NewPing sonar3(TRIG3, ECHO3, MAX_DISTANCE);

// เก็บค่าที่อ่านได้ล่าสุด
static unsigned int latestDistance1 = 0;
static unsigned int latestDistance2 = 0;
static unsigned int latestDistance3 = 0;

void UltrasonicSensors::init() {
    // ไม่ต้องทำอะไรมากสำหรับ NewPing (ถ้าใช้ library มันพร้อมทำงานเลย)
}

void UltrasonicSensors::readAll() {
    latestDistance1 = sonar1.ping_cm();
    latestDistance2 = sonar2.ping_cm();
    latestDistance3 = sonar3.ping_cm();
}

int UltrasonicSensors::getLevel(int index) {
    if (index == 1) return latestDistance1;
    if (index == 2) return latestDistance2;
    if (index == 3) return latestDistance3;
    return -1; // ถ้า index ไม่ถูกต้อง
}

#ifndef Water_SENSORS_H
#define Water_SENSORS_H

#include <Arduino.h>

namespace WaterSensors {
  void init();
  void read();
  void log();
  unsigned int get_WaterHigh();
  unsigned int get_WaterLow();
}

#endif

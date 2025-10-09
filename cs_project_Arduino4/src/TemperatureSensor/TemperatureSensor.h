#ifndef Temperature_SENSORS_H
#define Temperature_SENSORS_H

namespace TemperatureSensor {
    void init();
    void read();
    void log();
    int get_TemperatureLevel();
}
#endif
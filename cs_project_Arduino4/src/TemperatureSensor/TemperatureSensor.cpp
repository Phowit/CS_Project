#include <Arduino.h>
#include "TemperatureSensor.h"

const int TemperatureSensorPin = A0;

static int TemperatureLevel;

void TemperatureSensor::init() {
    pinMode(TemperatureSensorPin, INPUT);
}

void TemperatureSensor::read() {
    TemperatureLevel = digitalRead(TemperatureSensorPin);
}

void TemperatureSensor::log() {
    Serial.print(", T="); Serial.print(TemperatureLevel);
}

int TemperatureSensor::get_TemperatureLevel() { return TemperatureLevel; }
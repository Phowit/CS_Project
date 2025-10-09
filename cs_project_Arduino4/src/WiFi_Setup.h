#ifndef WIFI_SETUP_H
#define WIFI_SETUP_H

#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClientSecure.h>
#include <WiFiManager.h>

class WiFiSetup {
public:
    bool connectWiFi();
    void resetWiFi();
    bool isInternetConnected();

private:
    WiFiManager wm;
    WiFiClientSecure clientObj;
};

#endif

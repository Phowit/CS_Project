#include "WiFi_Setup.h"

const String username = "16432048";
const String password = "26062545";

const char *defaultSSID = "A";
const char *defaultPassword = "1234567890";
// Phowit_2.4g --> 0638967226 --> 192.168.1.55
// ARU_WIFI --> 1234567890
// A --> 1234567890 --> 10.166.224.111

int maxRetries = 5;
int retryCount = 0;
bool connected = false;

bool WiFiSetup::connectWiFi() {
    Serial.println("Starting WiFiManager...");
    WiFi.mode(WIFI_STA);

    // ส่วนที่ 1: พยายามเชื่อมต่อ SSID เริ่มต้นก่อน
    while (retryCount < maxRetries && !connected) {
        Serial.printf("Trying to connect to WiFi: %s\n", defaultSSID);
        WiFi.begin(defaultSSID, defaultPassword);

        unsigned long startAttemptTime = millis();
        while (WiFi.status() != WL_CONNECTED && millis() - startAttemptTime < 5000) {
            delay(500);
            Serial.print(".");
        }

        if (WiFi.status() == WL_CONNECTED) {
            connected = true;
            Serial.printf("\nConnected to WiFi: %s\n", defaultSSID);
        } else {
            Serial.println("\nFailed to connect. Retrying...");
            retryCount++;
        }
    }

    // ส่วนที่ 2: เปิด Portal ถ้ายังไม่เชื่อมต่อ
    if (!connected) {
        Serial.println("Opening WiFi Config Portal...");
        if (!wm.autoConnect("@WiFi to IoT Smart Garden")) {
            Serial.println("Failed to Connect WiFi!");
            delay(1000);
            Serial.println("Restarting...");
            ESP.restart();
            return false;
        }
    }

    // ถ้ามาถึงตรงนี้ แสดงว่าเชื่อมต่อสำเร็จ
    Serial.printf("\nConnected to WiFi: %s\n", WiFi.SSID().c_str());
    Serial.print("IP Address: ");
    Serial.println(WiFi.localIP());

    // ตรวจว่าเป็น WiFi ARU ไหม
    String currentSSID = WiFi.SSID();
    if (currentSSID == "ARU_WiFi" || currentSSID == "ARU_WIFI" ||
        currentSSID == "Zyxel" || currentSSID == "ARU-WiFi2") {

        Serial.println("Detected ARU WiFi, logging in...");

        clientObj.setInsecure();

        HTTPClient login;
        login.setFollowRedirects(HTTPC_STRICT_FOLLOW_REDIRECTS);
        login.begin(clientObj, "https://login1.aru.ac.th/index.jsp?action=login");
        login.addHeader("Content-Type", "application/x-www-form-urlencoded");

        String body =
            "username=" + username +
            "&password=" + password +
            "&mac=" +
            "&ipv4=" + WiFi.localIP().toString() +
            "&ipv6=" +
            "&loginType=specific" +
            "&loginMethod=ldap" +
            "&hash" +
            "&hashc=3c5303974f350074442ed0e33a8da8e4" +
            "&submit=Log+In";

        int res = login.POST(body);

        Serial.printf("Login Response: %d\n", res);

        if (res == 200 || res == 302) {
            Serial.println("Authentication ARU successful");
            if (isInternetConnected()) {
                Serial.println("Internet connected!");
            } else {
                Serial.println("No internet connection!");
                wm.resetSettings();
                ESP.restart();
                return false;
            }
        } else {
            Serial.println("Authentication failed!");
            wm.resetSettings();
            ESP.restart();
            return false;
        }

        login.end();
    } else {
        Serial.println("Not connected to ARU WiFi, skipping portal login.");
    }

    return true;
}

void WiFiSetup::resetWiFi() {
    Serial.println("Resetting WiFi...");
    wm.resetSettings();
    delay(1000);
    ESP.restart();
}

bool WiFiSetup::isInternetConnected() {
    HTTPClient http;
    http.setFollowRedirects(HTTPC_STRICT_FOLLOW_REDIRECTS);
    http.begin("http://clients3.google.com/generate_204");
    int httpCode = http.GET();
    http.end();

    Serial.printf("HTTP Code: %d\n", httpCode);
    return (httpCode == 204);
}

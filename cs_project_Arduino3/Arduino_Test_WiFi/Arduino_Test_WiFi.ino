#include "WiFiSetup.h"

//ข้อมูลบัญชีที่จะส่งไปล็อกอินกับ portal (ในที่นี้เป็นของ ARU)
// เก็บเป็น String แบบ hard-coded
const String username = "16432048";
const String password = "26062545";

//ชื่อและรหัสของเรา (router/point ที่ต้องการให้เชื่อมอัตโนมัติ)
const char *defaultSSID = "Phowit_2.4g";
const char *defaultPassword = "0638967226";
// Phowit_2.4g --> 0638967226 --> 192.168.1.55
// ARU_WIFI --> 1234567890
// A --> 1234567890 --> 10.166.224.111


// ตัวนับรอบการลองเชื่อม และสถานะว่าได้เชื่อมแล้วหรือยัง
int maxRetries = 5;
int retryCount = 0;
bool connected = false;

bool WiFiSetup::connectWiFi()
{
    // ข้อความเริ่มต้นบน Serial
    Serial.println("Starting WiFiManager...");
    WiFi.mode(WIFI_STA);  // ตั้ง ESP เป็น Station mode (เชื่อมกับ AP)
    // ถ้าโปรเจกต์อื่นอยากให้ ESP เปิด hotspot ด้วย → ใช้ WiFi.mode(WIFI_AP_STA); แล้วตามด้วย WiFi.softAP("ชื่อAP","รหัส")

    // ลองเชื่อมด้วยค่า default — เข้า loop
    while (retryCount < maxRetries && !connected)
    {
        // เริ่มพยายามเชื่อม
        Serial.print("Trying to connect to WiFi: ");
        Serial.println(defaultSSID);
        WiFi.begin(defaultSSID, defaultPassword);

        unsigned long startAttemptTime = millis();

        // วนรอสูงสุด 5 วินาที โดยพิมพ์ . ทุก 500 ms
        while (WiFi.status() != WL_CONNECTED && millis() - startAttemptTime < 5000)
        {
            delay(500);
            Serial.print(".");
        }

        // ถ้าเชื่อม (WiFi.status() == WL_CONNECTED) จะตั้ง connected = true และพิมพ์ว่าเชื่อมแล้ว
        if (WiFi.status() == WL_CONNECTED)
        {
            connected = true;
            Serial.print("\nConnected to WiFi: ");
            Serial.println(defaultSSID);
        }
        else
        {
            Serial.println("\nFailed to connect. Retrying...");
            retryCount++;
        }
        // ถ้าไม่สำเร็จ จะพิมพ์ Failed to connect. Retrying... แล้วเพิ่ม retryCount แล้ววนเชื่อมใหม่จนเกิน maxRetries หรือสำเร็จ
        // เหตุผล: พยายามเชื่อมอัตโนมัติก่อน เพื่อให้ถ้า router ของเราพร้อมอยู่แล้วไม่ต้องเปิด portal
    }

    // เรียก WiFiManager ให้พยายามเชื่อมจากค่าเก่า
    // ถ้าไม่ได้จะเปิด AP ชื่อ (parameter) เพื่อให้ผู้ใช้เชื่อมและกรอก SSID/Password ผ่านหน้าเว็บของอุปกรณ์
    // ถ้า autoConnect() คืนค่า true (เชื่อมได้หรือผู้ใช้ป้อนสำเร็จ) — โค้ดจะพิมพ์ SSID และ IP แล้วเก็บ currentSSID = WiFi.SSID()
    if (wm.autoConnect("@WiFi to Smart Egg Chicken Farm Management System Using Internet of Things "))
    {
        Serial.println("");
        Serial.print("Connected to WiFi : ");
        Serial.println(WiFi.SSID());
        Serial.print("IP Address : ");
        Serial.println(WiFi.localIP());
        Serial.println("");
        String currentSSID = WiFi.SSID();

        // ตรวจสอบถ้า currentSSID เป็นเครือข่ายแบบ ARU (list: "ARU_WiFi", "ARU_WIFI", "Zyxel", "ARU-WiFi2") — ถ้าใช่
        if (currentSSID == "ARU_WiFi" || currentSSID == "ARU_WIFI" || currentSSID == "Zyxel" || currentSSID == "ARU-WiFi2")
        {
            Serial.println("Detected ARU WiFi, logging in...");

            // ปิดการตรวจสอบใบรับรอง TLS (จำเป็นเมื่อใช้ WiFiClientSecure แต่ไม่แนะนำเพราะเสี่ยง MITM)
            client->setInsecure();

            //สร้าง HTTPClient login; และ login.begin(*client, "https://login1.aru.ac.th/index.jsp?action=login"); — เตรียม POST ไปที่ URL ของ portal
            HTTPClient login;
            login.setFollowRedirects(HTTPC_STRICT_FOLLOW_REDIRECTS);
            login.begin(*client, "https://login1.aru.ac.th/index.jsp?action=login");
            // ตั้ง header Content-Type: application/x-www-form-urlencoded
            login.addHeader("Content-Type", "application/x-www-form-urlencoded");

            // IPAddress currentIP = WiFi.localIP();
            // byte desiredLastOctet = 249; // random(1, 255);
            // IPAddress modifiedIP(currentIP[0], currentIP[1], currentIP[2], desiredLastOctet);
            // Serial.print("Modified IP Address : ");
            // Serial.println(modifiedIP);

            // สร้าง body เป็นฟอร์มที่มี username, password, ipv4 
            // (ใช้ WiFi.localIP().toString()), พารามิเตอร์อื่น ๆ (เช่น hashc ถูกตั้งค่าสตริงคงที่)
            String body = "username=" + String(username) +
                          "&password=" + String(password) +
                          "&mac=" +
                          "&ipv4=" + WiFi.localIP().toString() +
                          "&ipv6=" +
                          "&loginType=specific" +
                          "&loginMethod=ldap" +
                          "&hash" +
                          "&hashc=3c5303974f350074442ed0e33a8da8e4" +
                          "&submit=Log+In";

            // ส่ง POST แล้วอ่าน res (HTTP status code)
            int res = login.POST(body);

            Serial.print("Login Response: ");
            Serial.println(res);

            // หาก res == 200 หรือ res == 302 — ถือว่า Authentication ARU successful
            if (res == 200 || res == 302)
            {
                Serial.println("Authentication ARU successful");

                // ต่อไปเรียก isInternetConnected() เพื่อเช็คว่าออกอินเทอร์เน็ตได้จริง (เช็คกับ clients3.google.com/generate_204)
                if (isInternetConnected())
                {
                    Serial.println("Internet connected!");
                }
                // ถ้าไม่มีอินเทอร์เน็ตจริง จะรีเซ็ตการตั้งค่า (comment มี // wm.resetSettings(); แต่โค้ดจะ delay แล้ว ESP.restart() และคืน false)
                else
                {
                    Serial.println("No internet connection!");
                    // wm.resetSettings();
                    delay(500);
                    ESP.restart();
                    return false;
                }
            }
            // ถ้า res ไม่เท่ากับ 200 หรือ 302 — ถือว่า authentication ล้มเหลว -> wm.resetSettings(); -> restart -> return false
            else
            {
                Serial.println("Authentication failed!");
                wm.resetSettings();
                // ล้างค่า SSID/Password ที่เคยบันทึกไว้ใน Flash
                // ใช้กรณีผู้ใช้เปลี่ยน WiFi ใหม่ แล้วต้องการบังคับให้กรอกใหม่
                // ใช้ได้ทุกโปรเจกต์ที่มี WiFiManager
                
                delay(500);
                ESP.restart();
                return false;
            }

            // login.end(); delete client; — ปิด HTTP client และลบ pointer client
            login.end();
            delete client;
        }
        // ถ้า currentSSID ไม่ใช่ ARU — ข้ามขั้นตอนล็อกอิน portal (ปกติถ้าเป็น router ธรรมดาไม่ต้องล็อกอินเพิ่มเติม)
        else
        {
            Serial.println("Not connected to ARU WiFi, skipping portal login.");
        }
        return true;
    }

    // ถ้า wm.autoConnect() คืนค่า false — แสดงว่าเชื่อมแบบอัตโนมัติ/portal ไม่สำเร็จ -> พิมพ์ข้อความ -> restart -> return false
    else
    {
        Serial.println("Failed to Connect WiFi!");
        delay(1000);
        Serial.println("Restarting...");
        delay(1000);
        ESP.restart();
        return false;
    }
}

// ทำ wm.resetSettings(); (ล้าง Wi-Fi ที่บันทึกใน flash) แล้ว ESP.restart() (รีบูต)
void WiFiSetup::resetWiFi()
{
    Serial.println("Resetting WiFi...");
    wm.resetSettings();
    delay(1000);
    ESP.restart();
    // ใช้รีสตาร์ทบอร์ด ESP ใหม่ทั้งหมด
    // เวลาแก้: ถ้าอยากให้ retry แบบไม่ restart → ใช้ loop + delay แทน
    // ถ้าอยากให้ fallback ไปทำงาน offline → เขียนโค้ดเพิ่มก่อน restart
}

// ใช้ HTTPClient http; http.begin("http://clients3.google.com/generate_204"); int httpCode = http.GET(); — คืน true เมื่อได้ httpCode == 204
// (ลักษณะการเช็คว่ามีอินเทอร์เน็ตจริง ไม่ใช่แค่เชื่อม AP อยู่)
bool WiFiSetup::isInternetConnected()
{
    HTTPClient http;
    http.setFollowRedirects(HTTPC_STRICT_FOLLOW_REDIRECTS);
    http.begin("http://clients3.google.com/generate_204");  
    // หลักการ: Google จะตอบกลับด้วย HTTP 204 ถ้ามีอินเทอร์เน็ตจริง
    // ใช้ได้กับโปรเจกต์อื่น เวลาอยากเช็คว่า “ต่อ WiFi ได้แล้ว ออกอินเทอร์เน็ตได้จริงหรือยัง”
    int httpCode = http.GET();
    http.end();

    Serial.print("HTTP Code: ");
    Serial.println(httpCode);

    return (httpCode == 204);
}

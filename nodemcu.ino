#include <ESP8266WiFi.h>
#include <WiFiClient.h>
#include <ESP8266HTTPClient.h>
#include <Wire.h>
#include <LiquidCrystal_I2C.h>
#include <math.h>

// LCD ekran adresi ve boyutu
LiquidCrystal_I2C lcd(0x27, 16, 2);

// WiFi bağlantı bilgileri
const char* ssid = "Patates";
const char* password = "patates123";
// Sunucu URL'si
const char* serverUrl = "http://vedategunduz.com.tr/greenhouse-controller/nodemcu.php";

double temperature;  // Sıcaklık değişkeni

double readThermistor(int analogValue) {
  temperature = log(((10240000 / analogValue) - 10000));
  temperature = 1 / (0.001129148 + (0.000234125 + (0.0000000876741 * temperature * temperature)) * temperature);
  temperature = temperature - 273.15;
  return temperature;
}

void sendPostRequest(String postData) {
  WiFiClient client;
  HTTPClient http;
  http.begin(client, serverUrl);  // Yeni API kullanımı

  http.addHeader("Content-Type", "application/x-www-form-urlencoded");

  int analogValue = analogRead(A0);
  temperature = readThermistor(analogValue);

  String text = "datas=" + String(postData);
  text += String(temperature, 2);
  text += ",";

  int httpResponseCode = http.POST(text);

  if (httpResponseCode > 0) {
    String response = http.getString();
    //Serial.println(httpResponseCode);
    Serial.println(response);  // Sunucudan gelen cevabı seri portta göster
  } else {
    Serial.print("Error on sending POST: ");
    Serial.println(httpResponseCode);
  }

  http.end();
}

void connectToWiFi() {
  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED)
    delay(1000);

  Serial.println("Connected to WiFi");
}

void setup() {
  lcd.init();
  lcd.backlight();
  Serial.begin(9600);
  connectToWiFi();
}

String inputString = "";

void loop() {
  if (WiFi.status() != WL_CONNECTED)
    connectToWiFi();

  if (Serial.available() > 0) {
    //sendPostRequest(Serial.readStringUntil('\n'));
    inputString = Serial.readStringUntil('\n');  // Seri porttan string oku
    inputString.trim();                          // Boşlukları temizle
    sendPostRequest(inputString);
  }
  // Su Durumu
  int firstCommaIndex = inputString.indexOf(',');            // İlk virgülün index'i
  String data1 = inputString.substring(0, firstCommaIndex);  // İlk parça alınır
  inputString.remove(0, firstCommaIndex + 1);                // İlk parçayı stringten çıkar

  // Toprak Nemi
  int secondCommaIndex = inputString.indexOf(',');            // İkinci virgülün index'i
  String data2 = inputString.substring(0, secondCommaIndex);  // İkinci parça alınır
  inputString.remove(0, secondCommaIndex + 1);                // İkinci parçayı stringten çıkar

  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print((data1 != "0") ? "Su var." : "Su yok.");
  lcd.setCursor(8, 0);
  lcd.print(data2);
  lcd.print("%");
  lcd.setCursor(0, 1);
  // SICAKLIK
  int analogValue = analogRead(A0);
  temperature = readThermistor(analogValue);
  lcd.print(temperature);
  lcd.print("\337C");

  delay(7500);
}

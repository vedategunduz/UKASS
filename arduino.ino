// ANALOG PIN
#define SOIL_MOISTURE_SENSOR_ANALOG_SIGNAL_PIN A0
#define WATER_SENSOR_ANALOG_SIGNAL_PIN A1

// DIGITAL PIN
#define SOIL_MOISTURE_SENSOR_POWER_PIN 7
#define WATER_SENSOR_POWER_PIN 6
#define FAN_POWER_PIN 5
#define LED_POWER_PIN 0
#define ROLE_COMMAND_PIN 4

void setup() {
  Serial.begin(9600);
  // PIN MODS
  pinMode(SOIL_MOISTURE_SENSOR_POWER_PIN, OUTPUT);
  pinMode(WATER_SENSOR_POWER_PIN, OUTPUT);
  pinMode(FAN_POWER_PIN, OUTPUT);
  pinMode(ROLE_COMMAND_PIN, OUTPUT);

  digitalWrite(SOIL_MOISTURE_SENSOR_POWER_PIN, HIGH);
  digitalWrite(WATER_SENSOR_POWER_PIN, HIGH);
  digitalWrite(FAN_POWER_PIN, LOW);
  digitalWrite(ROLE_COMMAND_PIN, HIGH);
}

void loop() {
  String datas = "";

  // su durumu, toprak nemi,
  datas += ((getValueOfWaterSensor() > 0) ? true : false);
  datas += ",";
  datas += String(getValueOfSoilMoistureSensor());
  datas += ",";

  Serial.println(datas);
  if (Serial.available() > 0) {
    //sendPostRequest(Serial.readStringUntil('\n'));
    String inputString = Serial.readStringUntil('\n');  // Seri porttan string oku
    inputString.trim();                                 // Boşlukları temizle

    // Su Durumu
    int firstCommaIndex = inputString.indexOf(',');            // İlk virgülün index'i
    String data1 = inputString.substring(0, firstCommaIndex);  // İlk parça alınır
    inputString.remove(0, firstCommaIndex + 1);                // İlk parçayı stringten çıkar

    // Toprak Nemi
    int secondCommaIndex = inputString.indexOf(',');            // İkinci virgülün index'i
    String data2 = inputString.substring(0, secondCommaIndex);  // İkinci parça alınır
    inputString.remove(0, secondCommaIndex + 1);                // İkinci parçayı stringten çıkar


    if (data1 == "1")
      digitalWrite(FAN_POWER_PIN, 1);
    else
      digitalWrite(FAN_POWER_PIN, 0);

    if (data2 == "1") {
      digitalWrite(ROLE_COMMAND_PIN, 0);
      delay(2000);
      digitalWrite(ROLE_COMMAND_PIN, 1);
    }
  }
  delay(3250);
}

// WATER SENSOR FUNCTION
int getValueOfWaterSensor() {
  int waterSensorValue = analogRead(WATER_SENSOR_ANALOG_SIGNAL_PIN);
  return waterSensorValue;
}

// SOIL MOISTURE SENSOR FUNCTION
int getValueOfSoilMoistureSensor() {
  int soilMoistureSensorValue = analogRead(SOIL_MOISTURE_SENSOR_ANALOG_SIGNAL_PIN);
  soilMoistureSensorValue = map(soilMoistureSensorValue, 550, 0, 0, 100);

  // Negatif değer kontrolü
  if (soilMoistureSensorValue < 0) {
    soilMoistureSensorValue = 0;
  }

  return soilMoistureSensorValue;
}

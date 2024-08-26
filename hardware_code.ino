
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>

const char* ssid = "Herbez"; // Wi-Fi name
const char* password = "123456777"; // Wi-fi password

const int xpin = A0;  // x-axis of the accelerometer
const int vibrationSensor = D5; // Digital pin connected to the vibration sensor
const int buzzer = D7;  // Buzzer

WiFiClient client; // Initialize the WiFiClient object

void setup() {
  Serial.begin(115200);
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);

  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("WiFi connected");

  pinMode(vibrationSensor, INPUT); // Set the vibration sensor pin as input
  pinMode(buzzer, OUTPUT); // Set the buzzer pin as output
  digitalWrite(buzzer, LOW); // Ensure the buzzer is off at the start
}

void sendGPSData() {
  if (WiFi.status() == WL_CONNECTED) {
    // Prepare the data to send
    String latitude = "-1.984446"; // Replace with actual GPS data
    String longitude = "30.092817"; // Replace with actual GPS data
    String impactDetected = "1"; // Accident detected

    if (client.connect("192.168.80.252", 80)) {  // Replace with your server's IP address
      String postData = "latitude=" + latitude + "&longitude=" + longitude + "&impact_detected=" + impactDetected;

      delay(2000);
      // Send GPS data to the server
      client.println("POST /accid/insert_data.php HTTP/1.1");
      client.println("Host: 192.168.80.252");  // Replace with your server's IP address
      client.println("Content-Type: application/x-www-form-urlencoded");
      client.print("Content-Length: ");
      client.println(postData.length());
      client.println();
      client.print(postData);
      client.stop();

      Serial.println("Location sent to server successfully.");

      // Trigger the sendsms.php file using POST
      if (client.connect("192.168.80.252", 80)) {  // Reuse client to connect to the server again
        String smsData = "";  // Add any data you need to send to sendsms.php, if necessary
        client.println("GET /accid/sendsms.php HTTP/1.1");
        client.println("Host: 192.168.217.252");  // Replace with your server's IP address
        client.println("Content-Type: application/x-www-form-urlencoded");
        client.print("Content-Length: ");
        client.println(smsData.length());
        client.println();
        client.print(smsData);
        client.stop();

        Serial.println("SMS sent successfully.");
      } else {
        Serial.println("Failed to send SMS");
      }
    } else {
      Serial.println("Failed to send location to server");
    }
  }
}

void loop() {
  int x = analogRead(xpin); // Read the x-axis value of the accelerometer
  long measurement = vibration(); // Measure the vibration
  delay(1000); // Wait for 1 second

  // Print the measurement and x-axis values
  Serial.print("Vibration Measurement: ");
  Serial.println(measurement);
  Serial.print("X-Axis: ");
  Serial.println(x);

  // Check if an accident is detected
  if (measurement > 1000) {
    Serial.println("Accident Detected.");
    // Buzzer sound intervals
    for (int i = 0; i < 5; i++) { // Repeat the buzzer sound 5 times
      digitalWrite(buzzer, HIGH); // Turn on the buzzer
      delay(500); // Buzzer stays on for 500ms
      digitalWrite(buzzer, LOW); // Turn off the buzzer
      delay(500); // Buzzer stays off for 500ms
    }
    sendGPSData();  

  } else {
    Serial.println("No Accident.");
  }
}

long vibration() {
  long measurement = pulseIn(vibrationSensor, HIGH); // Measure the duration of the HIGH pulse on the vibration sensor
  return measurement;
}
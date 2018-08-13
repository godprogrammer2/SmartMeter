#include <ESP8266WiFi.h>
#define relayPin D7
void setup(){
    Serial.begin(9600);
    pinMode(relayPin,OUTPUT);
    WiFi.mode(WIFI_STA);
    WiFi.begin( "wifi name","password");//Function to connect to wifi hotspot
    while (WiFi.status() != WL_CONNECTED)  
    {
        delay(500);
        Serial.print(".");
        Serial.println(F("Connected to wifi succeed"));
        Serial.print(F("SSID:"));
        Serial.println(WiFi.SSID());
    }
}
void loop(){
    WiFiClient upserv; //Object For Connect To Server
    upserv.flush();
    Serial.println(F("Connecting to:vrsim4learning.com"));
    int counterTime = 0;
    while (!upserv.connect("vrsim4learning.com", 80)) //Function Connect To Server
    {
      Serial.print(".");
      delay(100);
      counterTime++;
      if (counterTime > 50)
      {
        Serial.println(F("\r\n connected failed"));
        return;
      }
    }
    Serial.println(F("Connect to server success"));

    String uri = "/smartmeter/relaySwitch.php?query=getSwitchState";
    Serial.print(F("uri:"));
    Serial.println(uri);
    upserv.print(String("GET ") + uri + " HTTP/1.1\r\n" +   //Function sent request to server
                 "Host: vrsim4learning.com\r\n" +
                 "Connection: close\r\n\r\n");
    int timeout = millis();
    while (upserv.available() == 0) //wait for server respond
    {
      if (millis() - timeout > 5000)
      {
        Serial.println(F(" >>> Client Timeout !"));
        upserv.stop();
        return;
      }

    }
    String respond ="";
    while(upserv.available())            //-------------------Function get respond from server
    {
       respond+=upserv.readStringUntil('\r');
    }
    int indexOfSwitchState = respond.indexOf("swtichState=");
    char switchState = respond[indexOfSwitchState+12];
    if(switchState == '1')
    {
        digitalWrite(relayPin,HIGH);
    }
    else
    {
        digitalWrite(relayPin,LOW);
    }
    delay(100);
}

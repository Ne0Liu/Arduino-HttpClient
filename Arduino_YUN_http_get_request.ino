#include <Bridge.h>
#include <HttpClient.h>

String data;
int commaPosition;
int i =0;

void setup() {
  pinMode(13, OUTPUT);
  digitalWrite(13, LOW);
  Bridge.begin();
  Serial.begin(9600);
  while(!Serial);
}

void loop() {
  /*HTTP Get Request to Server*/
  HttpClient client;
  client.get("http://54.64.82.126/egao/get_data_get.php?id=1");

  /*Get response from php*/
  while (client.available()) {
    char c = client.read();
    data+=c; //conver char to string
  }
  Serial.println(data);
  String datafinal = data.substring(1,data.length()-1); //remove first and last '"'
  String charBuf[50];
  
  /*Seperate string by space and insert into the array*/
  while(datafinal.indexOf(" ")!= (-1)){
    charBuf[i]=datafinal.substring(0,datafinal.indexOf(" "));
    datafinal=datafinal.substring(datafinal.indexOf(" ")+1,datafinal.length());
    i++;
  }
  /*For the last value*/
  charBuf[i]=datafinal;
  int j;
  
  /*Print the results*/
  for(j=0;j<i+1;j++){
    Serial.println(charBuf[j]+"index="+j);
  }
  
  /*Reset*/
  i=0;
  data="";
  
  delay(5000);
}


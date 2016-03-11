int reed = 2;

// the setup routine runs once when you press reset:
void setup() {
  // initialize serial communication at 9600 bits per second:
  Serial.begin(9600);
  // make the pushbutton's pin an input:
  pinMode(reed, INPUT);
}

// the loop routine runs over and over again forever:
void loop() {
  // read the input pin:
  int sensorState = digitalRead(reed);
  // print out the state of the button:
  Serial.println(sensorState);
  delay(1);        // delay in between reads for stability
}

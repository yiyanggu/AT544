import serial
from graphics import *
def main():
    ard = serial.Serial('COM3', 9600, timeout=.1)#text input
    win=GraphWin('Window',250,250)
    while True:
        data = ard.readline().strip()
        print(data)
        #the last bit gets rid of the new-line chars
        if data==b'0':
            cir.setFill("red")
        else:
            cir.setFill("green")
main()
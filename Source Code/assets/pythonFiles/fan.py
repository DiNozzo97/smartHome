import RPi.GPIO as GPIO
import sys


FAN_PIN = 17

GPIO.setmode(GPIO.BCM)
GPIO.setup(FAN_PIN, GPIO.OUT)


if (sys.argv[1] == "o"):
	GPIO.output(FAN_PIN, True)
else:
	GPIO.output(FAN_PIN,False)


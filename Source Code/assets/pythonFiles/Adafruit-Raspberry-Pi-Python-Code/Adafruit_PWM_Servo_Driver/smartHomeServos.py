#!/usr/bin/python

from Adafruit_PWM_Servo_Driver import PWM
import time
import sys


servoMin = 200  # Min pulse length out of 4096
servoMax = 500  # Max pulse length out of 4096

servoNumber = int(sys.argv[1])
position = sys.argv[2]
if ((position == "u") and (servoNumber == 1)) :
	position = servoMin
elif ((position == "u") and (servoNumber == 0)) :
  position = 410
elif ((position == "l") and (servoNumber == 0)) :
	position = servoMin
elif ((position == "l") and (servoNumber == 1)) :
  position = 410
elif (position == "o") :
	position = 350
elif (position == "c"):
	position = 590
# ===========================================================================
# Example Code
# ===========================================================================

# Initialise the PWM device using the default address
pwm = PWM(0x40)
# Note if you'd like more debug output you can instead run:
#pwm = PWM(0x40, debug=True)


def setServoPulse(channel, pulse):
  pulseLength = 1000000                   # 1,000,000 us per second
  pulseLength /= 60                       # 60 Hz
  pulseLength /= 4096                     # 12 bits of resolution
  pulse *= 1000
  pulse /= pulseLength
  pwm.setPWM(channel, 0, pulse)

pwm.setPWMFreq(60)                        # Set frequency to 60 Hz

# Change speed of continuous servo on channel O
pwm.setPWM(servoNumber, 0, position)


import time
import sys
from neopixel import *


# LED strip configuration:
LED_COUNT      = 6       # Number of LED pixels.
LED_PIN        = 18      # GPIO pin connected to the pixels (must support PWM!).
LED_FREQ_HZ    = 800000  # LED signal frequency in hertz (usually 800khz)
LED_DMA        = 5       # DMA channel to use for generating signal (try 5)
LED_BRIGHTNESS = 255     # Set to 0 for darkest and 255 for brightest
LED_INVERT     = False   # True to invert the signal (when using NPN transistor level shift)

red0 = int(sys.argv[1])
green0 = int(sys.argv[2])
blue0 = int(sys.argv[3])

red1 = int(sys.argv[4])
green1 = int(sys.argv[5])
blue1 = int(sys.argv[6])

red2 = int(sys.argv[7])
green2 = int(sys.argv[8])
blue2 = int(sys.argv[9])

red3 = int(sys.argv[10])
green3 = int(sys.argv[11])
blue3 = int(sys.argv[12])

# Create NeoPixel object with appropriate configuration.
strip = Adafruit_NeoPixel(LED_COUNT, LED_PIN, LED_FREQ_HZ, LED_DMA, LED_INVERT, LED_BRIGHTNESS)
# Intialize the library (must be called once before other functions).
strip.begin()
print "Setting Pixel 0 to:"
print ["red", "green", "blue"]
print [red0, green0, blue0]
strip.setPixelColorRGB(0, red0, green0, blue0)

print "Setting Pixel 1 to:"
print ["red", "green", "blue"]
print [red1, green1, blue1]
strip.setPixelColorRGB(1, red1, green1, blue1)

print "Setting Pixel 2 to:"
print ["red", "green", "blue"]
print [red2, green2, blue2]
strip.setPixelColorRGB(2, red2, green2, blue2)

print "Setting Pixel 3 to:"
print ["red", "green", "blue"]
print [red3, green3, blue3]
strip.setPixelColorRGB(3, red3, green3, blue3)

strip.show()

sys.exit()

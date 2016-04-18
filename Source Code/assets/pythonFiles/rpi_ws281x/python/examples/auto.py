
import time
import sys
import MySQLdb
from neopixel import *


# LED strip configuration:
LED_COUNT      = 60      # Number of LED pixels.
LED_PIN        = 18      # GPIO pin connected to the pixels (must support PWM!).
LED_FREQ_HZ    = 800000  # LED signal frequency in hertz (usually 800khz)
LED_DMA        = 5       # DMA channel to use for generating signal (try 5)
LED_BRIGHTNESS = 255     # Set to 0 for darkest and 255 for brightest
LED_INVERT     = False   # True to invert the signal (when using NPN transistor level shift)

brightnessPercentage = int(sys.argv[1])

# Create NeoPixel object with appropriate configuration.
strip = Adafruit_NeoPixel(LED_COUNT, LED_PIN, LED_FREQ_HZ, LED_DMA, LED_INVERT, LED_BRIGHTNESS)
# Intialize the library (must be called once before other functions).
strip.begin()
while True:
	print "Checking DB"
	db = MySQLdb.connect("127.0.0.1", "root", "", "smartHouse")
	cursor = db.cursor()
	cursor.execute("SELECT photoSensor FROM sensorReadings ORDER BY timestamp DESC LIMIT 1")
	data = cursor.fetchone()
	lightValue = int(data[0])
	print lightValue
	lightValue = (lightValue * 100) / 1023
	if lightValue >= brightnessPercentage:
		colorValue = 0
	else:
		colorValue = brightnessPercentage - lightValue + 50
	
	if colorValue > 255:
		colorValue = 255

	colorValue = int(colorValue)
	print "Color Value"
	print colorValue
	strip.setPixelColorRGB(0, colorValue, colorValue, colorValue)
	strip.setPixelColorRGB(1, colorValue, colorValue, colorValue)
	strip.setPixelColorRGB(2, colorValue, colorValue, colorValue)
	strip.setPixelColorRGB(3, colorValue, colorValue, colorValue)
	strip.setPixelColorRGB(4, colorValue, colorValue, colorValue)
	strip.setPixelColorRGB(5, colorValue, colorValue, colorValue)
	strip.show()
	time.sleep(5)

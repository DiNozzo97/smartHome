from serial_board import SerialBoard
import sys
import time
import math
import MySQLdb
import RPi.GPIO as GPIO

fanPin = 17
GPIO.setmode(GPIO.BCM)
GPIO.setup(fanPin, GPIO.OUT)
GPIO.output(fanPin, 1)

db = MySQLdb.connect("127.0.0.1","root","","smartHouse" )

cursor = db.cursor()

class Datalogger(SerialBoard):

    def __init__(self):
        SerialBoard.__init__(self)
        self.ther0Pin = 0 
        self.ther0Value = 0
	self.ther0Res = 0 
	self.ther0Temp = 0
        self.ther1Pin = 1 
        self.ther1Value = 0 
	self.ther1Res = 0
	self.ther1Temp = 0
        self.ther2Pin = 2 
        self.ther2Value = 0 
	self.ther2Res = 0
	self.ther2Temp = 0
	
	self.photoPin = 3
	self.photoVal = 0

	self.dataList = []
        self.init_conn()

    def init_conn(self):
        try:
            time.sleep(0.1)
            self.asip.set_auto_report_interval(50)
            time.sleep(0.1) 
            self.asip.set_pin_mode(self.ther0Pin+14, self.asip.ANALOG)
            time.sleep(0.1)
            self.asip.set_pin_mode(self.ther1Pin+14, self.asip.ANALOG)
            time.sleep(0.1)
            self.asip.set_pin_mode(self.ther2Pin+14, self.asip.ANALOG)
            time.sleep(0.1)
	    self.asip.set_pin_mode(self.photoPin+14, self.asip.ANALOG)
	    time.sleep(0.1)
        except Exception as e:
            sys.stdout.write("Exception caught while setting pin mode: {}\n".format(e))
            self.thread_killer()
            sys.exit(1)

    def main(self):
        while True:
            try:
                self.ther0Value = self.asip.analog_read(self.ther0Pin)
		self.ther1Value = self.asip.analog_read(self.ther1Pin)
		self.ther2Value = self.asip.analog_read(self.ther2Pin)

		self.photoVal = self.asip.analog_read(self.photoPin)

		self.ther0Res = 10000.0/((1023.0/self.ther0Value) - 1)
		self.ther1Res = 10000.0/((1023.0/self.ther1Value) - 1)
		self.ther2Res = 10000.0/((1023.0/self.ther2Value) - 1)

		self.ther0Temp = self.ther0Res/10000.0
		self.ther0Temp = math.log(self.ther0Temp)
		self.ther0Temp = self.ther0Temp/3950.0
		self.ther0Temp = self.ther0Temp + (1.0 / (25 + 273.15))
		self.ther0Temp = 1.0/self.ther0Temp
		self.ther0Temp = self.ther0Temp - 273.15
		self.ther0Temp = self.ther0Temp + 40
		
		ther0Temp = self.ther0Temp

		self.ther1Temp = self.ther1Res/10000.0
		self.ther1Temp = math.log(self.ther1Temp)
		self.ther1Temp = self.ther1Temp/3950.0
		self.ther1Temp = self.ther1Temp + (1.0 / (25 + 273.15))
		self.ther1Temp = 1.0/self.ther1Temp
		self.ther1Temp = self.ther1Temp - 273.15
		self.ther1Temp = self.ther1Temp + 40

		self.ther2Temp = self.ther2Res/10000.0
		self.ther2Temp = math.log(self.ther2Temp)
		self.ther2Temp = self.ther2Temp/3950.0
		self.ther2Temp = self.ther2Temp + (1.0 / (25 + 273.15))
		self.ther2Temp = 1.0/self.ther2Temp
		self.ther2Temp = self.ther2Temp - 273.15
		self.ther2Temp = self.ther2Temp + 40
		
		self.pretty0Temp = round(self.ther0Temp, 2)
		self.pretty1Temp = round(self.ther1Temp, 2)
		self.pretty2Temp = round(self.ther2Temp, 2)		
		
		prettyTherm0 = self.pretty0Temp
		prettyTherm1 = self.pretty1Temp
		prettyTherm2 = self.pretty2Temp	
		photo = self.photoVal
		
		average = (prettyTherm0 + prettyTherm1 + prettyTherm2) / 3
		
		print "Average:"
		print average
		
		if average > 21 :
			GPIO.output(fanPin, 0)
			print "\033[1;32mFan On\033[1;m"
		else :
			GPIO.output(fanPin, 1)
			print "\033[1;32mFan Off\033[1;m"
		
		self.dataList = [self.pretty0Temp, self.pretty1Temp, self.pretty2Temp, self.photoVal]
		print "Writing to DB..."
		print ['KitchenTemp', 'LivingTemp', 'UtilityTemp', 'PhotoLevel'] 
		print self.dataList
		time.sleep(2)
		# Prepare SQL query to INSERT a record into the database.
		sql = "INSERT INTO sensorReadings(kitchenTemp, livingRoomTemp, utilityRoomTemp, photoSensor) VALUES ('%s', '%s', '%s', '%s')" % \
		(prettyTherm0, prettyTherm1, prettyTherm2, photo)
		try:
		   # Execute the SQL command
		   cursor.execute(sql)
		   # Commit your changes in the database
		   db.commit()
		   print '\033[1;32mWriting to DB...COMPLETE\033[1;m'
		   time.sleep(2)
		except:
		   # Rollback in case there is any error
		   print '\033[1;31mWriting to DB...FAILED!\033[1;m'
		   db.rollback()
            except (KeyboardInterrupt, Exception) as e:
                sys.stdout.write("Caught exception in main loop: {}\n".format(e))
                self.thread_killer()
                sys.exit()

if __name__ == "__main__":
    Datalogger().main()

from twilio.rest import TwilioRestClient
import os
from time import sleep
import RPi.GPIO as GPIO

 
# Your Account Sid and Auth Token from twilio.com/user/account
account_sid = "## YOUR TWILLIO SID"
auth_token  = "## YOUR TWILLIO TOKEN"
recipient_phoneNo = ""
twilio_phoneNo =""

client = TwilioRestClient(account_sid, auth_token)

GPIO.setmode(GPIO.BCM)
GPIO.setup(22, GPIO.IN)

while True:
	if (GPIO.input(22) == True):
		print "DOORBELL"
		message = client.messages.create(body="There is a visitor at your door, reply \"OK\" to unlock",
   		to=recipient_phoneNo,    # Replace with your phone number
    		from_=twilio_phoneNo) # Replace with your Twilio number
		sleep(20)
	sleep(0.1)

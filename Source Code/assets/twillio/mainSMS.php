<?php
include('twilio-php/Services/Twilio.php');
include("../credentials.php");

$conn = new mysqli($host, $username, $password, $database);

$client = new Services_Twilio($twilioSID, $twilioToken);

$content = $_REQUEST['Body'];
$content = strtolower($content);

if (strpos($content, 'ok') !== false) {
	exec("sudo -u root python /var/www/assets/pythonFiles/Adafruit-Raspberry-Pi-Python-Code/Adafruit_PWM_Servo_Driver/textUnlock.py");
	exit();
}

?> 









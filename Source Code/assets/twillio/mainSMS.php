<?php
include('twilio-php/Services/Twilio.php');
 

$client = new Services_Twilio("## YOUR TWILLIO SID", "## YOUR TWILLIO TOKEN");

$content = $_REQUEST['Body'];
$content = strtolower($content);

if (strpos($content, 'ok') !== false) {
	exec("sudo -u root python /var/www/assets/pythonFiles/Adafruit-Raspberry-Pi-Python-Code/Adafruit_PWM_Servo_Driver/textUnlock.py");
	exit();
}

?> 









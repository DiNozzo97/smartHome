<?php

$servoNumber = $_GET["servoNumber"];
$position = $_GET["position"];

exec("sudo -u root python /var/www/assets/pythonFiles/Adafruit-Raspberry-Pi-Python-Code/Adafruit_PWM_Servo_Driver/smartHomeServos.py $servoNumber $position");
die();
?>

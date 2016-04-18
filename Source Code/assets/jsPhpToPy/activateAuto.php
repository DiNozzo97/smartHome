<?php

$brightnessLevel = $_GET["sliderVal"];

exec("sudo -u root pkill -f auto.py");
exec("sudo -u root python /var/www/assets/pythonFiles/rpi_ws281x/python/examples/auto.py $brightnessLevel");
die();
?>

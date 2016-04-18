<?php

$utility = $_GET['utility'];
if ($utility == "true") {
	$utility = True ;
} else {
	$utility = False;
} 

$kitchen = $_GET['kitchen'];
if ($kitchen == "true") {
	$kitchen = True ;
} else {
	$kitchen = False;
} 

$living = $_GET['living'];
if ($living == "true") {
	$living = True ;
} else {
	$living = False;
} 

$garage = $_GET['garage'];
if ($garage == "true") {
	$garage = True ;
} else {
	$garage = False;
} 

$utilityHex = $_GET['utilityColor'];
$livingHex = $_GET['livingColor'];

$kitchenHex = $_GET['kitchenColor'];

$garageHex = $_GET['garageColor'];

function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);
   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return $rgb; // returns an array with the rgb values
}

$utilityRGB = hex2rgb($utilityHex);
$utilityR = $utilityRGB[0];
$utilityG = $utilityRGB[1];
$utilityB = $utilityRGB[2];

$kitchenRGB = hex2rgb($kitchenHex);
$kitchenR = $kitchenRGB[0];
$kitchenG = $kitchenRGB[1];
$kitchenB = $kitchenRGB[2];

$livingRGB = hex2rgb($livingHex);
$livingR = $livingRGB[0];
$livingG = $livingRGB[1];
$livingB = $livingRGB[2];

$garageRGB = hex2rgb($garageHex);
$garageR = $garageRGB[0];
$garageG = $garageRGB[1];
$garageB = $garageRGB[2];

if ($utility == False) {
	$utilityR = "0";
	$utilityG = "0";
	$utilityB = "0";
}

if ($kitchen == False) {
	$kitchenR = "0";
	$kitchenG = "0";
	$kitchenB = "0";
}

if ($living == False) {
	$livingR = "0";
	$livingG = "0";
	$livingB = "0";
}

if ($garage == False) {
	$garageR = "0";
	$garageG = "0";
	$garageB = "0";
}

echo "Kitchen on/off = $kitchen";
echo "kitchenHex = $kitchenHex";
echo "kitchenR = $kitchenR";
echo "kitchenG = $kitchenG";
echo "kitchenB = $kitchenB";
echo "<br>";

echo "Living on/off = $living";
echo "Living Hex = $livingHex";
echo "livingR = $livingR";
echo "livingG = $livingG";
echo "livingB = $livingB";
echo "<br>";

echo "Utility on/off = $utility";
echo "utilityHex = $utilityHex";
echo "utilityR = $utilityR";
echo "utilityG = $utilityG";
echo "utilityB = $utilityB";
echo "<br>";

echo "Garage on/off = $garage";
echo "garageHex = $garageHex";
echo "garageR = $garageR";
echo "garageG = $garageG";
echo "garageB = $garageB";
echo "<br>";


exec("sudo -u root pkill -f auto.py");
exec("sudo -u root python /var/www/assets/pythonFiles/rpi_ws281x/python/examples/turnPixelsOn.py $utilityR $utilityG $utilityB $kitchenR $kitchenG $kitchenB $livingR $livingG $livingB $garageR $garageG $garageB");
die();
?>

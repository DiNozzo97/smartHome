<?php

session_start();

$attemptUsername = $_POST["inputEmail"];
$attemptPassword = $_POST["inputPassword"];
$attemptPasswordHash = MD5($attemptPassword);

include("credentials.php");

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} 

if (mysqli_connect_error()) {
	die("Database connection failed: " . mysqli_connect_error());
}
$sql = "SELECT * FROM Users WHERE emailAddress = '$attemptUsername' AND passwordHash = '$attemptPasswordHash' AND active = 1";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
	$row=$result->fetch_assoc();
	$_SESSION['signedIn'] = true;
	$_SESSION['userFirstName'] = $row['firstName'];
	$_SESSION['userLastName'] = $row['lastName'];
	$_SESSION['userEmail'] = $row['emailAddress'];

	header("location:../Controller.php");

}
else {

	header("location:../login.php?msg=1");
}
$conn->close();
?>

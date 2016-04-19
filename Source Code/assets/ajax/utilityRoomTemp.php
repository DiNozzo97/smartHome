<?php 
// Create connection to SQL Database

include("../dbCredentials.php");

$conn = new mysqli($host, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);

    }


if ($stmt = $conn->prepare("SELECT utilityRoomTemp FROM sensorReadings ORDER BY timestamp DESC LIMIT 1")) {
    
    /* execute query */
    $stmt->execute();
    $stmt->bind_result($utilityRoomTemp);
    $stmt->fetch();

    /* store result */

}
$stmt->close();
$conn->close();
echo "$utilityRoomTemp";
?>

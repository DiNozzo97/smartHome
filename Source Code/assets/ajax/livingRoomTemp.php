<?php 
// Create connection to SQL Database

$conn = new mysqli("127.0.0.1", "root", "", "smartHouse");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);

    }


if ($stmt = $conn->prepare("SELECT livingRoomTemp FROM sensorReadings ORDER BY timestamp DESC LIMIT 1")) {
    
    /* execute query */
    $stmt->execute();
    $stmt->bind_result($livingRoomTemp);
    $stmt->fetch();

    /* store result */

}
$stmt->close();
$conn->close();
echo "$livingRoomTemp";
?>
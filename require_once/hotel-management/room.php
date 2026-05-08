<?php

require_once "db.php";

$sql = "SELECT * FROM rooms WHERE status = 'Available'";
$result = mysqli_query($conn, $sql);

while ($room = mysqli_fetch_assoc($result)) 

{    echo "Room No: " . $room['room_no'] . "<br>";}

?>
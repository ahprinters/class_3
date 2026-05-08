<?php

require_once 'db.php';

$guestName = "Rahim Ahmed";
$roomNo = 205;
$checkInDate = "2026-05-10";
$sql = "INSERT INTO bookings (guest_name, room_no, check_in_date)        VALUES ('$guestName', '$roomNo', '$checkInDate')";

if (mysqli_query($conn, $sql)) 
{    
    echo "Booking added successfully.";
    } else {   
    echo "Booking failed.";

  
    }
    ?>
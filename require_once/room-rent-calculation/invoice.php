<?php

require_once "functions.php";

$roomRent = 3000;
$totalDays = 3;
$serviceCharge = 500;
$bill = calculateRoomBill($roomRent, $totalDays, $serviceCharge);

echo "Total Invoice Amount: " . $bill . " BDT";
?>
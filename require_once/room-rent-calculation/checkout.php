<?php

require_once "functions.php";

$roomRent = 4500;
$totalDays = 2;
$serviceCharge = 800;
$finalPayment = calculateRoomBill($roomRent, $totalDays, $serviceCharge);

echo "Final Checkout Bill: " . $finalPayment . " BDT";

?>
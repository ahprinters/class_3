<?php
require 'database.php';
require 'payment-config.php';
require 'order-functions.php';

echo createOrder("Laptop", 75000);

echo "<br>Payment Gateway: " . $payment_gateway;
?>

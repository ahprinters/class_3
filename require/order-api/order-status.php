<?php

require __DIR__ . '/core/response.php';
require __DIR__ . '/core/database.php';
require __DIR__ . '/middleware/auth.php';
require __DIR__ . '/models/Order.php';

if (!isset($_GET['order_id'])) {
    jsonResponse(false, "Order ID is required.");
}

$orderId = $_GET['order_id'];

$order = getOrderStatus($conn, $orderId);

if (!$order) {
    jsonResponse(false, "Order not found.");
}
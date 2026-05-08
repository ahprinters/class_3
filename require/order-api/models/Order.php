<?php

function getOrderStatus($conn, $orderId) {
    $orderId = mysqli_real_escape_string($conn, $orderId);

    $sql = "SELECT id, customer_name, status, total_amount 
            FROM orders 
            WHERE id = '$orderId'";

    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }

    return null;
}
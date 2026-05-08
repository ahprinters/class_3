Example 2: Secure API System — Token Authentication ছাড়া Data Access করা যাবে না

ধরুন আপনি একটি API বানাচ্ছেন। User order status দেখতে চাইবে। কিন্তু API access করার আগে token verify করতে হবে।

এখানে authentication file missing হলে API চালানো dangerous। তাই require ব্যবহার করা হয়েছে।

Project Structure
order-api/
│
├── order-status.php
│
├── config/
│   └── app.php
│
├── core/
│   ├── database.php
│   └── response.php
│
├── middleware/
│   └── auth.php
│
└── models/
    └── Order.php
config/app.php
<?php

return [
    'api_token' => '123456SECRET',
    'db_host' => 'localhost',
    'db_user' => 'root',
    'db_pass' => '',
    'db_name' => 'shop_db'
];
core/database.php
<?php

$app = require __DIR__ . '/../config/app.php';

$conn = mysqli_connect(
    $app['db_host'],
    $app['db_user'],
    $app['db_pass'],
    $app['db_name']
);

if (!$conn) {
    die("Database connection failed.");
}

core/response.php
<?php

function jsonResponse($status, $message, $data = []) {
    header('Content-Type: application/json');

    echo json_encode([
        'status' => $status,
        'message' => $message,
        'data' => $data
    ]);

    exit();
}

middleware/auth.php
<?php

$app = require __DIR__ . '/../config/app.php';

$headers = getallheaders();

if (!isset($headers['Authorization'])) {
    jsonResponse(false, "Authorization token missing.");
}

$token = str_replace("Bearer ", "", $headers['Authorization']);

if ($token !== $app['api_token']) {
    jsonResponse(false, "Invalid API token.");
}

এখানে auth.php file API security handle করছে। এই file ছাড়া API চালানো উচিত নয়।

models/Order.php
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
order-status.php
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

jsonResponse(true, "Order found successfully.", $order);
Browser/Test URL
http://localhost:8080/order-api/order-status.php?order_id=1

তবে এই API access করার সময় header-এ token দিতে হবে:

Authorization: Bearer 123456SECRET
এখানে require কেন ব্যবহার করা হয়েছে?

কারণ order-status.php চালানোর জন্য এই file গুলো must-have:

require __DIR__ . '/core/response.php';
require __DIR__ . '/core/database.php';
require __DIR__ . '/middleware/auth.php';
require __DIR__ . '/models/Order.php';

যদি auth.php missing থাকে, তাহলে security check হবে না।
যদি database.php missing থাকে, তাহলে order data পাওয়া যাবে না।
যদি response.php missing থাকে, তাহলে proper JSON response দেওয়া যাবে না।
যদি Order.php missing থাকে, তাহলে getOrderStatus() function পাওয়া যাবে না।

তাই এই system-এ require ব্যবহার করা সঠিক।

Important Professional Note

Large project-এ অনেক সময় একই file একাধিকবার load হওয়ার possibility থাকে। তখন সাধারণত require_once ব্যবহার করা হয়।

require_once __DIR__ . '/config.php';

কিন্তু basic learning-এর জন্য আগে require ভালোভাবে বুঝুন।

সহজ rule:

Important file missing হলে application বন্ধ হওয়া উচিত = require

Same file বারবার load হওয়ার risk থাকলে = require_once
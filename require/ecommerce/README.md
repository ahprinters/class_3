উদাহরণ ১: E-commerce Website-এ Database Connection ছাড়া Checkout চলবে না

ধরুন আপনি একটি e-commerce website বানাচ্ছেন। সেখানে user product cart-এ add করে checkout করতে যাবে।

Checkout page চালাতে অবশ্যই দরকার:

database.php
payment-config.php
order-functions.php

কারণ এগুলো ছাড়া order save হবে না, payment process হবে না, invoice তৈরি হবে না।

তাই এখানে require() ব্যবহার করা উচিত।

Project Structure
ecommerce/
│
├── checkout.php
├── database.php
├── payment-config.php
└── order-functions.php
database.php
<?php
$conn = mysqli_connect("localhost", "root", "", "shop_db");

if (!$conn) {
    die("Database connection failed.");
}
?>
payment-config.php
<?php
$payment_gateway = "SSLCommerz";
$merchant_id = "MERCHANT_12345";
?>
order-functions.php
<?php
function createOrder($product, $amount) {
    return "Order created for $product. Total amount: $amount";
}
?>
checkout.php
<?php
require 'database.php';
require 'payment-config.php';
require 'order-functions.php';

echo createOrder("Laptop", 75000);

echo "<br>Payment Gateway: " . $payment_gateway;
?>
Output
Order created for Laptop. Total amount: 75000
Payment Gateway: SSLCommerz
এখানে require() কেন ব্যবহার করা হলো?

কারণ checkout.php page চালানোর জন্য database connection, payment configuration এবং order function বাধ্যতামূলক।

যদি database.php না থাকে, তাহলে checkout চালানো বিপজ্জনক। কারণ user payment করতে পারে, কিন্তু order database-এ save নাও হতে পারে।

তাই এখানে include না দিয়ে require ব্যবহার করা হয়েছে।

সহজভাবে:

require 'database.php';

মানে:

“এই file ছাড়া page চলতেই পারবে না।”
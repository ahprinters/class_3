require_once 

মূলত require-এর মতোই কাজ করে, কিন্তু বড় সুবিধা হলো—একই file একাধিকবার load হতে দেয় না।

মানে, কোনো file যদি আগে একবার load হয়ে থাকে, তাহলে require_once আবার সেটিকে load করবে না।

এটি বিশেষভাবে দরকার হয় যখন file-এর ভিতরে function, class, database connection, configuration থাকে।

Example 1: Function file বারবার load হলে error এড়াতে require_once

ধরুন আপনার একটি helper file আছে যেখানে common function রাখা হয়েছে।

Project Structure
project/
│
├── index.php
├── header.php
└── helpers.php
helpers.php
<?php

function formatPrice($amount) {
    return "৳" . number_format($amount, 2);
}
header.php
<?php

require_once 'helpers.php';

echo "<h2>Welcome to My Shop</h2>";
echo "Product Price: " . formatPrice(1500);
index.php
<?php

require_once 'helpers.php';
require_once 'header.php';

echo "<br>";
echo "Cart Total: " . formatPrice(3500);
এখানে কী হচ্ছে?

index.php file-এ প্রথমে helpers.php load হচ্ছে:

require_once 'helpers.php';

তারপর header.php load হচ্ছে:

require_once 'header.php';

কিন্তু header.php-এর ভিতরেও আবার আছে:

require_once 'helpers.php';

যদি এখানে শুধু require ব্যবহার করা হতো, তাহলে helpers.php দুইবার load হতে পারত। ফলে একই function দুইবার declare হওয়ার কারণে error হতে পারত:

Fatal error: Cannot redeclare formatPrice()

কিন্তু require_once ব্যবহার করায় PHP বুঝে নেয়—helpers.php আগে load হয়েছে। তাই দ্বিতীয়বার আর load করে না।

Output
Welcome to My Shop
Product Price: ৳1,500.00
Cart Total: ৳3,500.00
কেন require_once ভালো?

কারণ function file, helper file, common library file একাধিক জায়গায় দরকার হতে পারে। কিন্তু একই function বারবার declare করা যাবে না। তাই এখানে require_once best practice।
require দিয়ে value return করা যায়

Required file-এর ভিতরে return ব্যবহার করলে সেই value main file-এ পাওয়া যায়। PHP documentation-এ include/require successful হলে return value পাওয়া যায়—successful include সাধারণত 1 return করে, আর included file নিজে return করলে সেই value return হয়।

config.php

<?php
return [
    'db_name' => 'my_database',
    'host' => 'localhost'
];

index.php

<?php
$config = require 'config.php';

echo $config['db_name'];

Output:

my_database
Practical rule

সহজ নিয়ম:

ফাইলটি না থাকলে application বন্ধ হয়ে যাওয়া উচিত → require ব্যবহার করুন।

ফাইলটি optional হলে → include ব্যবহার করুন।

Example:

<?php
require __DIR__ . '/config.php';      // must-have
require __DIR__ . '/database.php';    // must-have

include __DIR__ . '/sidebar.php';     // optional
include __DIR__ . '/footer.php';      // optional
?>
সংক্ষেপে

require হলো PHP-এর একটি language construct, যা বাইরের PHP file বর্তমান file-এ যুক্ত করে। এটি include-এর মতোই কাজ করে, কিন্তু failure হলে include শুধু warning দেয়, আর require serious error/exception তৈরি করে। তাই configuration, database connection, authentication, common functions—এসব গুরুত্বপূর্ণ ফাইলের জন্য require সবচেয়ে উপযুক্ত।
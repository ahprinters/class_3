উদাহরণ ২: Admin Dashboard-এ Login Authentication ছাড়া Access দেওয়া যাবে না

ধরুন আপনার website-এ একটি admin panel আছে। সেখানে শুধু logged-in admin ঢুকতে পারবে।

Admin panel চালানোর জন্য দরকার:

auth.php
config.php
admin-functions.php

auth.php না থাকলে security system কাজ করবে না। তখন যে কেউ admin panel access করতে পারে।

তাই এখানে অবশ্যই require() ব্যবহার করা উচিত।

Project Structure
admin-panel/
│
├── dashboard.php
├── auth.php
├── config.php
└── admin-functions.php
auth.php
<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
?>
config.php
<?php
$site_name = "My Admin Panel";
?>
admin-functions.php
<?php
function showAdminWelcomeMessage($name) {
    return "Welcome back, " . $name;
}
?>
dashboard.php
<?php
require 'auth.php';
require 'config.php';
require 'admin-functions.php';

echo "<h1>" . $site_name . "</h1>";
echo showAdminWelcomeMessage("Admin");
?>
Output
My Admin Panel
Welcome back, Admin
এখানে require() কেন জরুরি?

কারণ auth.php file ছাড়া admin panel secure থাকবে না।

যদি এইভাবে লেখা হতো:

include 'auth.php';

আর কোনো কারণে auth.php file missing থাকত, তাহলে PHP warning দেখিয়ে page-এর বাকি অংশ চালিয়ে দিতে পারত।

এটা security risk।

কিন্তু যদি লেখা হয়:

require 'auth.php';

তাহলে auth.php file missing হলে পুরো script থেমে যাবে। ফলে unauthorized access হওয়ার chance কমে যায়।

সহজ তুলনা
E-commerce Checkout
require 'database.php';
require 'payment-config.php';
require 'order-functions.php';

কারণ এগুলো ছাড়া checkout চলা উচিত নয়।

Admin Dashboard
require 'auth.php';
require 'config.php';
require 'admin-functions.php';

কারণ এগুলো ছাড়া admin panel চালানো unsafe।

Real-life Rule

যে file ছাড়া system-এর main কাজ চলবে না, সেখানে require() ব্যবহার করুন।

যেমন:

require 'database.php';      // must needed
require 'auth.php';          // must needed
require 'config.php';        // must needed
require 'functions.php';     // must needed

আর যেগুলো optional, সেগুলোতে include() ব্যবহার করা যায়।

যেমন:

include 'sidebar.php';
include 'advertisement.php';
include 'footer-banner.php';
মনে রাখার সহজ formula
Must-have file  = require()
Optional file   = include()

অর্থাৎ,

ফাইলটি না থাকলে website/application বন্ধ হয়ে যাওয়া উচিত হলে require() ব্যবহার করবেন।

ফাইলটি না থাকলেও page কিছুটা চলতে পারলে include() ব্যবহার করবেন।
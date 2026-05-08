অসাধারণ। তাহলে শেষ উদাহরণটা একটু Premium Real-Life SaaS Dashboard টাইপ করি, যেখানে একসাথে কয়েকটা advanced concept থাকবে:

include দিয়ে layout load
user role অনুযায়ী module load
subscription plan অনুযায়ী premium feature load
security-এর জন্য whitelist/map ব্যবহার
missing file হলে error handling
Premium Example: Travel Booking SaaS Dashboard

ধরো তুমি mybooking.bd টাইপ একটি travel booking platform বানাচ্ছো।

এখানে ৩ ধরনের user আছে:

customer — tour search করবে, booking দেখবে
hotel_owner — hotel room manage করবে, booking request দেখবে
admin — users, payments, reports manage করবে

আবার subscription plan আছে:

free
pro
enterprise

Plan অনুযায়ী extra feature load হবে।

Folder Structure
premium-booking-dashboard/
│
├── index.php
├── auth.php
├── subscription.php
│
├── layouts/
│   ├── header.php
│   └── footer.php
│
└── modules/
    ├── search-tour.php
    ├── my-bookings.php
    ├── manage-rooms.php
    ├── booking-requests.php
    ├── user-management.php
    ├── payment-report.php
    ├── premium-analytics.php
    └── audit-logs.php
১. auth.php

এখানে logged-in user-এর information থাকবে।

<?php

$current_user = [
    "name" => "Rahim Hotel Manager",
    "role" => "hotel_owner",
    "plan" => "pro"
];

?>

এখানে user হলো:

Role: hotel_owner
Plan: pro

তাই সে hotel owner dashboard পাবে, সাথে Pro plan-এর extra feature পাবে।

২. subscription.php

এখানে role ও plan অনুযায়ী কোন module load হবে সেটা define করা হয়েছে।

<?php

$role_modules = [
    "customer" => [
        "search-tour",
        "my-bookings"
    ],

    "hotel_owner" => [
        "manage-rooms",
        "booking-requests"
    ],

    "admin" => [
        "user-management",
        "payment-report"
    ]
];

$plan_modules = [
    "free" => [],

    "pro" => [
        "premium-analytics"
    ],

    "enterprise" => [
        "premium-analytics",
        "audit-logs"
    ]
];

?>
৩. layouts/header.php
<!DOCTYPE html>
<html>
<head>
    <title>Premium Booking Dashboard</title>
</head>
<body>

<h1>mybooking.bd Dashboard</h1>
<hr>
৪. layouts/footer.php
<hr>
<p>Copyright © 2026 mybooking.bd</p>

</body>
</html>

৫. modules/search-tour.php
<h3>Search Tour Packages</h3>
<p>Customer can search Cox’s Bazar, Sajek, Bandarban and other tour packages.</p>

৬. modules/my-bookings.php
<h3>My Bookings</h3>
<p>Customer can see all confirmed and pending bookings.</p>

৭. modules/manage-rooms.php
<h3>Manage Hotel Rooms</h3>
<p>Hotel owner can add, update and remove hotel rooms.</p>

৮. modules/booking-requests.php
<h3>Booking Requests</h3>
<p>Hotel owner can approve or reject customer booking requests.</p>

৯. modules/user-management.php
<h3>User Management</h3>
<p>Admin can manage customers, hotel owners and staff accounts.</p>

১০. modules/payment-report.php
<h3>Payment Report</h3>
<p>Admin can monitor payment history, commissions and refunds.</p>

১১. modules/premium-analytics.php
<h3>Premium Analytics</h3>
<p>Pro and Enterprise users can see booking trends, revenue charts and customer insights.</p>

১২. modules/audit-logs.php
<h3>Audit Logs</h3>
<p>Enterprise users can track who changed what and when.</p>


১৩. index.php

এটাই main file। এখানে সবকিছু include দিয়ে control করা হচ্ছে।

<?php

include __DIR__ . "/auth.php";
include __DIR__ . "/subscription.php";

include __DIR__ . "/layouts/header.php";

echo "<h2>Welcome, " . $current_user['name'] . "</h2>";
echo "<p>Role: " . $current_user['role'] . "</p>";
echo "<p>Plan: " . $current_user['plan'] . "</p>";
echo "<hr>";

$user_role = $current_user['role'];
$user_plan = $current_user['plan'];

if (isset($role_modules[$user_role]) && isset($plan_modules[$user_plan])) {

    $modules_to_load = array_merge(
        $role_modules[$user_role],
        $plan_modules[$user_plan]
    );

    $modules_to_load = array_unique($modules_to_load);

    foreach ($modules_to_load as $module) {

        $module_file = __DIR__ . "/modules/$module.php";

        if (file_exists($module_file)) {
            include $module_file;
            echo "<hr>";
        } else {
            echo "<p style='color:red;'>Module file missing: $module</p>";
        }
    }

} else {
    echo "<h3>Invalid user role or subscription plan.</h3>";
}

include __DIR__ . "/layouts/footer.php";

?>
Output কী হবে?

কারণ auth.php-এ আছে:

"role" => "hotel_owner",
"plan" => "pro"

তাই output হবে:

mybooking.bd Dashboard

Welcome, Rahim Hotel Manager
Role: hotel_owner
Plan: pro

Manage Hotel Rooms
Hotel owner can add, update and remove hotel rooms.

Booking Requests
Hotel owner can approve or reject customer booking requests.

Premium Analytics
Pro and Enterprise users can see booking trends, revenue charts and customer insights.

Copyright © 2026 mybooking.bd
এখানে include কীভাবে কাজ করছে?

এই line দিয়ে user information load হচ্ছে:

include __DIR__ . "/auth.php";

এই line দিয়ে role-plan configuration load হচ্ছে:

include __DIR__ . "/subscription.php";

এই line দিয়ে website layout load হচ্ছে:

include __DIR__ . "/layouts/header.php";

এই অংশে dynamically module load হচ্ছে:

include $module_file;

মানে user-এর role এবং subscription plan অনুযায়ী আলাদা আলাদা file include হচ্ছে।

কেন এটা Premium Level Example?

কারণ এখানে শুধু simple header/footer include না, বরং real software-এর মতো:

User Role + Subscription Plan + Dynamic Module Loading + Layout System

একসাথে ব্যবহার করা হয়েছে।

এটা real-life system-এ ব্যবহার হতে পারে:

Travel booking platform
Hotel booking system
LMS platform
SaaS dashboard
CRM software
ERP system
Admin panel
Important Security Note

এই code-এ আমরা user input থেকে সরাসরি file include করিনি।

ভুল পদ্ধতি:

include "modules/" . $_GET['module'] . ".php";

ভালো পদ্ধতি:

$role_modules = [
    "customer" => ["search-tour", "my-bookings"],
    "hotel_owner" => ["manage-rooms", "booking-requests"],
    "admin" => ["user-management", "payment-report"]
];

কারণ allowed module আগে থেকেই define করা আছে। তাই hacker ইচ্ছেমতো file include করতে পারবে না।

Final Learning

এই ১০টি উদাহরণ থেকে include method-এর মূল ব্যবহারগুলো তুমি শিখেছো:

1. Header/Footer reuse
2. Menu reuse
3. Config file loading
4. Dynamic page loading
5. Template layout system
6. Plugin system
7. Role-based dashboard
8. Multi-user application
9. Subscription-based features
10. Premium SaaS modular dashboard

এখন তুমি include দিয়ে ছোট থেকে মাঝারি level PHP project structure বানাতে পারবে।
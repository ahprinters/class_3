Online Learning Platform Subscription System

ধরো তুমি Udemy, Coursera, Skillshare টাইপ একটি online learning platform বানাচ্ছো।

এখানে subscription plan অনুযায়ী student আলাদা সুবিধা পাবে।

Plan	Features
Basic	Recorded courses
Premium	Recorded courses + live classes + certificate
Mentor Plan	Everything + mentor support + assignment review
Project Structure
learning-platform/
│
├── index.php
├── user-plan.php
└── modules/
    ├── recorded-courses.php
    ├── live-classes.php
    ├── certificate.php
    ├── mentor-support.php
    └── assignment-review.php

modules/recorded-courses.php
<h3>Recorded Courses</h3>
<p>You can watch pre-recorded course videos.</p>

modules/live-classes.php
<h3>Live Classes</h3>
<p>You can join live classes with instructors.</p>

modules/certificate.php
<h3>Certificate</h3>
<p>You can download a certificate after course completion.</p>

modules/mentor-support.php
<h3>Mentor Support</h3>
<p>You can ask questions directly to your assigned mentor.</p>

modules/assignment-review.php
<h3>Assignment Review</h3>
<p>Your submitted assignments will be reviewed by experts.</p>

user-plan.php
<?php

$current_user = [
    "name" => "Rahim",
    "subscription" => "mentor"
];

$subscription_modules = [
    "basic" => [
        "recorded-courses"
    ],

    "premium" => [
        "recorded-courses",
        "live-classes",
        "certificate"
    ],

    "mentor" => [
        "recorded-courses",
        "live-classes",
        "certificate",
        "mentor-support",
        "assignment-review"
    ]
];

?>
index.php
<?php

include __DIR__ . "/user-plan.php";

echo "<h2>Welcome, " . $current_user['name'] . "</h2>";

$user_subscription = $current_user['subscription'];

if (isset($subscription_modules[$user_subscription])) {

    foreach ($subscription_modules[$user_subscription] as $module) {

        $module_file = __DIR__ . "/modules/$module.php";

        if (file_exists($module_file)) {
            include $module_file;
        } else {
            echo "<p>Module not found: $module</p>";
        }
    }

} else {
    echo "No valid subscription found.";
}

?>
Output যদি subscription "mentor" হয়
Welcome, Rahim

Recorded Courses
You can watch pre-recorded course videos.

Live Classes
You can join live classes with instructors.

Certificate
You can download a certificate after course completion.

Mentor Support
You can ask questions directly to your assigned mentor.

Assignment Review
Your submitted assignments will be reviewed by experts.
এখানে Advanced Concept কী?

এখানে একজন student-এর subscription অনুযায়ী platform-এর feature load হচ্ছে।

Basic student শুধু recorded course দেখতে পারবে।

Premium student পাবে:

recorded course + live class + certificate

Mentor plan student পাবে:

সবকিছু + mentor support + assignment review
Real Life Analogy

ধরো একটি coaching center আছে।

Package	Facilities
Basic	Recorded lecture
Premium	Recorded lecture + live class
Mentor	Recorded lecture + live class + personal mentor + copy checking

Online learning platform-এ subscription feature ঠিক এভাবেই কাজ করে।

Professional Security Tip

Subscription feature system বানানোর সময় কখনো user input থেকে সরাসরি file include করা উচিত না।

ভুল পদ্ধতি:

include "modules/" . $_GET['module'] . ".php";

ভালো পদ্ধতি:

$allowed_modules = [
    "recorded-courses",
    "live-classes",
    "certificate"
];

তারপর শুধু allowed module include করা উচিত।

কারণ direct user input দিয়ে include করলে security risk হতে পারে।
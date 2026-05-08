Example 2: Database connection এবং class file একবার load করার জন্য require_once

ধরুন আপনি একটি ছোট user management system বানাচ্ছেন।

Project Structure
user-system/
│
├── index.php
├── database.php
├── User.php
└── Profile.php
database.php
<?php

$conn = mysqli_connect("localhost", "root", "", "user_db");

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
User.php
<?php

require_once 'database.php';

class User {
    public function getUserName() {
        return "Mohammad Ali Khan";
    }
}
Profile.php
<?php

require_once 'database.php';
require_once 'User.php';

class Profile {
    public function showProfile() {
        $user = new User();

        return "Profile Name: " . $user->getUserName();
    }
}
index.php
<?php

require_once 'database.php';
require_once 'User.php';
require_once 'Profile.php';

$profile = new Profile();

echo $profile->showProfile();
এখানে কী হচ্ছে?

database.php file তিন জায়গায় ব্যবহার হয়েছে:

require_once 'database.php';

User.php, Profile.php, এবং index.php—তিন জায়গায় database file দরকার হতে পারে।

কিন্তু require_once ব্যবহার করায় database.php শুধু একবার load হবে।

একইভাবে User.php file-ও একবারই load হবে। এতে class redeclare error হবে না।

যদি require ব্যবহার করা হতো, তাহলে একই class আবার declare হওয়ার কারণে error হতে পারত:

Fatal error: Cannot declare class User, because the name is already in use
Output
Profile Name: Mohammad Ali Khan
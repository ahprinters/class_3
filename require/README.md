require() বলতে আমরা অনেক সময় “মেথড” বলি, কিন্তু PHP ডকুমেন্টেশন অনুযায়ী এটি আসলে function নয়, language construct। তাই require 'file.php'; এভাবে লেখা যায়; parentheses বাধ্যতামূলক নয়। PHP manual-এ বলা হয়েছে, require মূলত include-এর মতোই কাজ করে, কিন্তু ফাইল লোড করতে ব্যর্থ হলে require বেশি কঠোরভাবে error দেয়। 
require কী করে?

require কোনো নির্দিষ্ট PHP ফাইলকে বর্তমান ফাইলে এনে include এবং evaluate করে। অর্থাৎ, যে ফাইলে require করা হয়েছে, সেই ফাইলের কোড main file-এর অংশের মতো execute হয়। 


ধরুন আপনার project structure এমন:
project/│
├── index.php
└── config.php

config.php

<?php

$site_name = "My Website";?>

index.php

<?php

require 'config.php';
echo $site_name;?>

Output হবে:
My Website

এখানে config.php ফাইলটি index.php-এর ভিতরে যুক্ত হয়ে গেছে।


PHP ডকুমেন্টেশনের মূল কথা
PHP manual অনুযায়ী:

require is identical to include except upon failure it will also produce an Error exception, whereas include will only produce a warning.

সহজ বাংলায় এর অর্থ:

require এবং include দুটোই বাইরের ফাইল যুক্ত করার জন্য ব্যবহৃত হয়। কিন্তু ফাইল না পাওয়া গেলে বা লোড করতে না পারলে include শুধু warning দেয়, আর require গুরুতর error তৈরি করে এবং script থেমে যেতে পারে। PHP 8.0.0-এর আগে এটি E_COMPILE_ERROR level error দিত; PHP 8.0.0 থেকে failure হলে Error exception তৈরি করে। 


include বনাম require


বিষয়includerequireকাজ

ফাইল যুক্ত করেফাইল যুক্ত করেফাইল না পেলেWarning দেয়Error দেয়

Script চালু থাকে?

সাধারণত চালু থাকেসাধারণত বন্ধ হয়ে যায়ব্যবহারOptional fileEssential/mandatory file
include failure example
<?phpinclude 'missing-file.php';echo "This line may still run.";?>
এখানে missing-file.php না থাকলে PHP warning দেখাবে, কিন্তু পরের echo line execute হতে পারে। include ফাইল না পেলে E_WARNING দেয়। 
require failure example
<?phprequire 'missing-file.php';echo "This line will not run.";?>
এখানে missing-file.php না থাকলে require error তৈরি করবে। ফলে পরের line execute হবে না।
কখন require ব্যবহার করবেন?
যে ফাইল ছাড়া আপনার application চলতেই পারবে না, সেখানে require ব্যবহার করা উচিত।
যেমন:
require 'config.php';require 'database.php';require 'functions.php';
কারণ database connection, configuration, authentication system—এসব না থাকলে পুরো application ঠিকমতো কাজ করবে না।
কখন include ব্যবহার করবেন?
যে ফাইল না থাকলেও page আংশিকভাবে চলতে পারে, সেখানে include ব্যবহার করা যায়।
যেমন:
include 'sidebar.php';include 'advertisement.php';include 'optional-banner.php';
sidebar বা banner না থাকলেও main page হয়তো চলতে পারবে।
Path কীভাবে কাজ করে?
PHP প্রথমে দেওয়া file path অনুযায়ী ফাইল খোঁজে। path না পেলে include_path, calling script-এর directory এবং current working directory check করে। absolute path বা ./, ../ দিয়ে relative path দিলে include_path ignore করা হয়। 
ভালো practice:
require __DIR__ . '/config.php';
এতে current file-এর directory ধরে path তৈরি হয়। ফলে অন্য জায়গা থেকে script run করলেও path confusion কম হয়।
Variable scope
যে জায়গায় require করা হয়, included file সেই জায়গার variable scope পায়। অর্থাৎ main file-এর variable required file-এর ভিতরে ব্যবহার করা যেতে পারে, এবং required file-এর variable main file-এ পাওয়া যেতে পারে। তবে included file-এর functions এবং classes global scope-এ থাকে। 
Example:
vars.php
<?php$color = "green";$fruit = "apple";?>
index.php
<?phprequire 'vars.php';echo "A $color $fruit";?>
Output:
A green apple
require দিয়ে value return করা যায়
Required file-এর ভিতরে return ব্যবহার করলে সেই value main file-এ পাওয়া যায়। PHP documentation-এ include/require successful হলে return value পাওয়া যায়—successful include সাধারণত 1 return করে, আর included file নিজে return করলে সেই value return হয়। 
config.php
<?phpreturn [    'db_name' => 'my_database',    'host' => 'localhost'];
index.php
<?php$config = require 'config.php';echo $config['db_name'];
Output:
my_database
Practical rule
সহজ নিয়ম:
ফাইলটি না থাকলে application বন্ধ হয়ে যাওয়া উচিত → require ব্যবহার করুন।
ফাইলটি optional হলে → include ব্যবহার করুন।
Example:
<?phprequire __DIR__ . '/config.php';      // must-haverequire __DIR__ . '/database.php';    // must-haveinclude __DIR__ . '/sidebar.php';     // optionalinclude __DIR__ . '/footer.php';      // optional?>
সংক্ষেপে
require হলো PHP-এর একটি language construct, যা বাইরের PHP file বর্তমান file-এ যুক্ত করে। এটি include-এর মতোই কাজ করে, কিন্তু failure হলে include শুধু warning দেয়, আর require serious error/exception তৈরি করে। তাই configuration, database connection, authentication, common functions—এসব গুরুত্বপূর্ণ ফাইলের জন্য require সবচেয়ে উপযুক্ত।

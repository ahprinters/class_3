এখানে PHP-এর []= syntax বোঝানো হয়েছে।

PHP-তে array-এর শেষে নতুন element যোগ করার খুব সহজ উপায় হলো:

$array[] = "new value";

এটা প্রায় array_push()-এর মতো কাজ করে।

ধরি কোডটি:

<?php
$array = array(0 => "Amir", 1 => "needs");

$array[] = "job";

print_r($array);
?>

প্রথমে array ছিল:

$array = array(
    0 => "Amir",
    1 => "needs"
);

এখানে key/value হলো:

0 => "Amir"
1 => "needs"

এরপর লেখা হয়েছে:

$array[] = "job";

এটার মানে:

$array-এর শেষে "job" value টি যোগ করো।

PHP তখন automatically পরের numeric index বের করে। যেহেতু সর্বশেষ numeric key ছিল 1, তাই নতুন value-এর key হবে 2।

Final array হবে:

Array
(
    [0] => Amir
    [1] => needs
    [2] => job
)
[]= আসলে কী করছে?
$array[] = "job";

এটা shorthand বা short syntax। এর equivalent হলো:

array_push($array, "job");

অথবা conceptually:

$array[2] = "job";

কিন্তু এখানে 2 আপনাকে manually লিখতে হচ্ছে না। PHP নিজেই next available numeric index দিয়ে দিচ্ছে।



কেন বলা হয়েছে []= could be considered an Array Operator?

যেমন string-এর ক্ষেত্রে আছে:

$name .= " Khan";

এখানে .= string-এর শেষে নতুন text যোগ করে।

উদাহরণ:

$name = "Amir";
$name .= " Khan";

echo $name;

Output:

Amir Khan

ঠিক একইভাবে array-এর ক্ষেত্রে:

$array[] = "job";

array-এর শেষে নতুন value যোগ করে।


তাই লেখক বলছেন, 

[]=-কে unofficially Array Operator হিসেবে ভাবা যায়, যেভাবে .= হলো String Operator।

array_push() বনাম []=

দুটোই array-এর শেষে value যোগ করতে পারে।

[]=
$array[] = "job";
array_push()
array_push($array, "job");

দুটোর result একই:

Array
(
    [0] => Amir
    [1] => needs
    [2] => job
)

কিন্তু practical development-এ single element যোগ করতে []= বেশি clean এবং common:

$users[] = "Rahim";
$users[] = "Karim";
$users[] = "Salam";
Multiple value যোগ করতে চাইলে

array_push() দিয়ে একসাথে multiple value push করা যায়:

$array = ["Amir", "needs"];

array_push($array, "job", "badly");

Result:

Array
(
    [0] => Amir
    [1] => needs
    [2] => job
    [3] => badly
)

[]= দিয়ে করতে হলে আলাদা আলাদা লিখতে হবে:

$array[] = "job";
$array[] = "badly";
গুরুত্বপূর্ণ বিষয়

[]= শুধু numeric indexed array-তে নয়, associative array-তেও কাজ করে। তবে নতুন item-এর জন্য PHP numeric key assign করবে।

Example:

$user = [
    "name" => "Amir",
    "status" => "needs"
];

$user[] = "job";

print_r($user);

Output:

Array
(
    [name] => Amir
    [status] => needs
    [0] => job
)

কারণ "job"-এর জন্য কোনো key দেওয়া হয়নি, তাই PHP numeric key 0 দিয়েছে।

সহজভাবে মনে রাখবেন
$array[] = "job";

মানে:

array-এর শেষে "job" ঢুকিয়ে দাও।

এটা সবচেয়ে বেশি ব্যবহার হয় যখন loop-এর মধ্যে নতুন নতুন data array-তে জমা করতে হয়:

$names = [];

$names[] = "Amir";
$names[] = "Rahim";
$names[] = "Karim";

print_r($names);

Output:

Array
(
    [0] => Amir
    [1] => Rahim
    [2] => Karim
)

Developer হিসেবে rule:

একটি value push করতে চাইলে []= ব্যবহার করুন।
একাধিক value একসাথে push করতে চাইলে array_push() ব্যবহার করতে পারেন।
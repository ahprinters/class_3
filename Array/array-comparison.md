এখানে মূল বিষয় হলো PHP array-এর identical operator === এবং array key conversion।

PHP documentation অনুযায়ী, array-এর ক্ষেত্রে === তখনই true হয় যখন দুই array-এর same key/value pairs, same order, এবং same types থাকে।

আপনার কোড:

$a = array (0 => "apple", 1 => "banana");
$b = array (1 => "banana", 0 => "apple");

var_dump($a === $b);

এখানে $a হলো:

Array
(
    [0] => apple
    [1] => banana
)

আর $b হলো:

Array
(
    [1] => banana
    [0] => apple
)

দেখতে মনে হতে পারে দুই array-তেই একই data আছে:

0 => apple
1 => banana

কিন্তু order একই না।

$a-তে order:

0 first
1 second

$b-তে order:

1 first
0 second

তাই:

var_dump($a === $b);

Output:

bool(false)

কারণ === শুধু value দেখে না, key/value pair-এর order-ও দেখে।

এবার দ্বিতীয় অংশ:

$b = array ("0" => "apple", "1" => "banana");

var_dump($a === $b);

এখানে অনেকের মনে হতে পারে $a-এর key integer:

0 => "apple"
1 => "banana"

আর $b-এর key string:

"0" => "apple"
"1" => "banana"

তাহলে === false হওয়া উচিত।

কিন্তু PHP-তে array key হিসেবে numeric string দিলে, যেমন "0", "1", এগুলো automatic integer key হয়ে যায়। PHP manual-এ বলা আছে valid decimal integer ধরনের string key integer হিসেবে cast হয়।

তাই এই array:

$b = array ("0" => "apple", "1" => "banana");

PHP আসলে এটাকে ধরে:

$b = array (0 => "apple", 1 => "banana");

অর্থাৎ $a এবং $b একই হয়ে যায়।

$a:

Array
(
    [0] => apple
    [1] => banana
)

$b:

Array
(
    [0] => apple
    [1] => banana
)

তাই:

var_dump($a === $b);

Output:

bool(true)
সহজ ভাষায় মূল কথা

=== array comparison-এ তিনটা জিনিস দেখে:

১. key একই কি না
২. value একই কি না
৩. order একই কি না

আর numeric string key যেমন "0", "1" PHP-তে automatic integer key হয়ে যায়।

তাই:

"0" => "apple"

আসলে হয়ে যায়:

0 => "apple"
Full example with expected output
<?php
$a = array(0 => "apple", 1 => "banana");

$b = array(1 => "banana", 0 => "apple");

var_dump($a === $b); 
// bool(false)

$b = array("0" => "apple", "1" => "banana");

var_dump($a === $b); 
// bool(true)
?>
সবচেয়ে গুরুত্বপূর্ণ line
$b = array(1 => "banana", 0 => "apple");

এখানে data same হলেও order different, তাই false.

কিন্তু:

$b = array("0" => "apple", "1" => "banana");

এখানে "0" এবং "1" integer key হয়ে যায়, order-ও same থাকে, তাই true.
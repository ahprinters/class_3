তাহলে value দিয়ে union করতে চাইলে কী করতে হবে?

Value দিয়ে union করতে চাইলে আগে array merge করতে হবে, তারপর duplicate value বাদ দিতে হবে।

$result = array_unique(array_merge($a, $b));
print_r($result);

এখানে:
array_merge($a, $b)

দুই array-এর values একসাথে করবে:

one two three four five


তারপর:
array_unique()
duplicate value থাকলে সরিয়ে দেবে।


Final output:

Array(    
    [0] => one    
    [1] => two    
    [2] => three    
    [3] => four    
    [4] => five
    )

গুরুত্বপূর্ণ পার্থক্য

Code কাজ $a + $b key অনুযায়ী union করে 
array_merge($a, $b)values একসাথে merge করে
array_unique(array_merge($a, $b))
values merge করে duplicate বাদ দেয়

আপনার কোডের একটু corrected version


আপনার এই লাইনে সমস্যা হতে পারে:
echo "array_unique(array_merge($a,$b)):";

কারণ double quotation-এর ভিতরে $a এবং $b variable হিসেবে ধরতে পারে। তাই ভালোভাবে লিখবেন:
echo 'array_unique(array_merge($a, $b)): ';

Full code:
<?php

$a = array('one', 'two');

$b = array('three', 'four', 'five');

echo '$a + $b : ';


echo '<pre>';

print_r($a + $b);

echo '</pre>';

echo 'array_unique(array_merge($a, $b)): ';

echo '<pre>';

print_r(array_unique(array_merge($a, $b)));

echo '</pre>';

?>


সহজ ভাষায় মূল কথা
+ operator দেখে মনে হতে পারে দুইটা array-এর সব value যোগ করবে।


 কিন্তু PHP-তে array-এর ক্ষেত্রে + operator key দেখে কাজ করে, value দেখে না। তাই same key থাকলে বাম পাশের array-এর value থাকবে, ডান পাশের array-এর value বাদ যাবে।
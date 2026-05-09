PHP-তে + operator দিয়ে array যোগ করলে সেটি value দিয়ে union করে না, বরং key দিয়ে union করে।

আপনার কোড:

$a = array('one', 'two');
$b = array('three', 'four', 'five');

এই দুইটা array আসলে PHP-এর চোখে এমন:

$a = array(
    0 => 'one',
    1 => 'two'
);

$b = array(
    0 => 'three',
    1 => 'four',
    2 => 'five'
);

এখন যখন লিখলেন:

$a + $b

PHP এখানে আগে $a-এর key গুলো রাখবে। এরপর $b থেকে শুধু সেই element গুলো নেবে যাদের key $a-তে নেই।

ধাপে ধাপে বুঝি

$a-তে আছে:

0 => one
1 => two

$b-তে আছে:

0 => three
1 => four
2 => five

এখন $a + $b করলে:

0 => one     // $a থেকে এসেছে
1 => two     // $a থেকে এসেছে
2 => five    // $b থেকে এসেছে, কারণ key 2 $a-তে ছিল না

তাই output হবে:

Array
(
    [0] => one
    [1] => two
    [2] => five
)

খেয়াল করুন, $b-এর three এবং four নেয়নি। কারণ এগুলোর key হলো 0 এবং 1, আর এই key দুইটা আগে থেকেই $a-তে ছিল।

তাহলে $a + $b কী করে?
$a + $b

এর অর্থ:

$a array রাখো, তারপর $b থেকে শুধু নতুন key থাকলে যোগ করো।

এটি left-hand array-কে priority দেয়।
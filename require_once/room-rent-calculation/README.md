উদাহরণ ২: Room Rent Calculation Function একবারই Load করা
ধরুন, হোটেলে room rent calculate করার জন্য আলাদা function আছে। এই function booking, invoice, checkout—সব জায়গায় লাগতে পারে।

Project Structure
room-rent-calculation/
│
├── functions.php
├── invoice.php
└── checkout.php

functions.php
<?php
function calculateRoomBill($roomRent, $totalDays, $serviceCharge)

{    $totalRent = $roomRent * $totalDays;    

$finalBill = $totalRent + $serviceCharge;    

return $finalBill;}
?>

invoice.php

<?php

require_once "functions.php";
$roomRent = 3000;
$totalDays = 3;
$serviceCharge = 500;
$bill = calculateRoomBill($roomRent, $totalDays, $serviceCharge);

echo "Total Invoice Amount: " . $bill . " BDT";
?>

checkout.php

<?php

require_once "functions.php";

$roomRent = 4500;
$totalDays = 2;
$serviceCharge = 800;
$finalPayment = calculateRoomBill($roomRent, $totalDays, $serviceCharge);

echo "Final Checkout Bill: " . $finalPayment . " BDT";

?>

ব্যাখ্যা
এখানে functions.php ফাইলে calculateRoomBill() function রাখা হয়েছে। এই function দিয়ে guest-এর total bill calculate করা হচ্ছে।

invoice.php এবং checkout.php—দুই জায়গায় একই function দরকার। তাই প্রতিবার নতুন করে function লেখার দরকার নেই। শুধু লিখতে হবে:
require_once "functions.php";

যদি functions.php একাধিকবার load হয়, তাহলে PHP error দিতে পারে:
Cannot redeclare calculateRoomBill()

কিন্তু require_once ব্যবহার করলে এই সমস্যা হবে না, কারণ ফাইলটি একবারের বেশি load হবে না।


সহজভাবে মনে রাখার নিয়ম


Hotel Management Software-এ যেসব ফাইল বারবার লাগে, যেমন:
db.php
functions.php
auth.php
config.php
room-functions.php
billing-functions.php

এসব ফাইল include করার জন্য require_once ব্যবহার করা সবচেয়ে নিরাপদ।

require_once "db.php";
require_once "functions.php";
require_once "auth.php";

মানে:
ফাইলটি অবশ্যই দরকার, কিন্তু একবারের বেশি load করার দরকার নেই।
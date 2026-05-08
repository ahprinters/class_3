উদাহরণ ১: Database Connection একবারই Load করা
ধরুন, Hotel Management Software-এ booking, room, customer—সব জায়গায় database connection লাগে। এজন্য আমরা db.php ফাইল বানাবো।
Project Structure
hotel-management/
│
├── db.php
├── booking.php
└── room.php
db.php
<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "hotel_management";

$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) {    die("Database connection failed: " . mysqli_connect_error());}
?>

booking.php

<?php

require_once "db.php";

$guestName = "Rahim Ahmed";
$roomNo = 205;
$checkInDate = "2026-05-10";
$sql = "INSERT INTO bookings (guest_name, room_no, check_in_date)        VALUES ('$guestName', '$roomNo', '$checkInDate')";

if (mysqli_query($conn, $sql)) 
{    
    echo "Booking added successfully.";
    } else {   
    echo "Booking failed.";}
    ?>


room.php
<?php

require_once "db.php";

$sql = "SELECT * FROM rooms WHERE status = 'Available'";
$result = mysqli_query($conn, $sql);

while ($room = mysqli_fetch_assoc($result)) 

{    echo "Room No: " . $room['room_no'] . "<br>";}

?>

ব্যাখ্যা
এখানে db.php ফাইলটি database connection তৈরি করছে। booking.php এবং room.php—দুই জায়গাতেই database দরকার, তাই require_once "db.php"; ব্যবহার করা হয়েছে।

যদি একই পেজে ভুল করে db.php দুইবার call হয়, তারপরও require_once সেটাকে একবারই load করবে। এতে duplicate connection বা error হওয়ার ঝুঁকি কমে যায়।


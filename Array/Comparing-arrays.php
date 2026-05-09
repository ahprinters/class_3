<?php
$a = array("apple", "banana");
// echo "<pre>";

// var_dump($a); // array(2) { [0]=> string(5) "apple" [1]=> string(6) "banana" }
// echo "</pre>";

$b = array(1 => "banana", "0" => "apple");
// echo "<pre>";
// var_dump($b); // array(2) { [1]=> string(6) "banana" [0]=> string(5) "apple" }
// echo "</pre>";

// var_dump($a == $b); // bool(true)

var_dump($a === $b); // bool(false)
?>
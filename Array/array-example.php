<?php
$a = array("a" => "apple", "b" => "banana");

// echo "Array \$a: \n";//output array $a
// var_dump($a); //output = array(2) { ["a"]=> string(5) "apple" ["b"]=> string(6) "banana" }  
// echo $a["a"]; //output = apple
// echo "<br>"; //output = new line
// echo $a["b"]; //output = banana


$b = array("a" => "pear", "b" => "strawberry", "c" => "cherry");

// echo "<pre>";
// var_dump($b);
// echo "</pre>";


$c = $a + $b; // Union of $a and $b
// echo "Union of \$a and \$b: \n";

// echo "<pre>";
// var_dump($c);
// echo "</pre>";

$c = $b + $a; // Union of $b and $a
// echo "Union of \$b and \$a: \n";

// echo "<pre>";
// var_dump($c);
// echo "</pre>";


$a += $b; // Union of $a += $b is $a and $b
echo "Union of \$a += \$b: \n";
echo "<pre>";
var_dump($a);
echo "</pre>";
?>
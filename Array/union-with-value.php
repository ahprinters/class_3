<?php
$a = array('one','two');
$b=array('three','four','five');



//a union of arrays' values
// echo 'array_unique(array_merge($a,$b)):';
// cribbed from http://oreilly.com/catalog/progphp/chapter/ch05.html

echo "<pre>";
print_r (array_unique(array_merge($a,$b)));
echo "</pre>";
?>

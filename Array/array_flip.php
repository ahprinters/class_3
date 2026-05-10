<?php

$array1 = [    0 => 'apple',    1 => 'orange',    2 => 'pear',];
$array2 = [    0 => 'melon',    1 => 'orange',    2 => 'banana',];

$result = array_keys(array_flip($array1) + array_flip($array2));
echo "<pre>";
print_r($result);
echo "</pre>";

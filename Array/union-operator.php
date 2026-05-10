<?php
// $a = array('one', 'two');
// $b = array('three', 'four', 'five');
// $c = $a + $b;
// echo "<pre>";
// var_dump($c);
// echo "</pre>";


    $a = array('red', 'orange');
    $b = array('yellow', 'green', 'blue');

    // $both = $a + $b;// output will be red, orange, yellow, green, blue 
    $both = array_merge($a, $b);//all values will be added to the end of the first array and the keys will be reindexed starting from 0
    echo "<pre>";
    var_dump($both);
    echo "</pre>";
?>
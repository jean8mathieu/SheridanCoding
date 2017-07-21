<?php
/**
 * Created by PhpStorm.
 * User: Jean-Mathieu
 * Date: 12/18/14
 * Time: 5:11 AM
 */

//Creating the array
$arrays = array();

//Creating variable $x
$x = 0;

//Adding the value into the array $arrays
for($i = 0; $i<10;$i++){
    $x++;
    $arrays[$i] = ($x * $i);
}

//Printing the array
for($i = 0; $i<10;$i++){
    echo ($i+1) . ". " . $arrays[$i] . "<br>";
}

//Looking at the size of the array
echo "<br> Size of the array: " . sizeof($arrays);

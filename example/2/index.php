<?php
/**
 * Created by PhpStorm.
 * User: Jean-Mathieu
 * Date: 12/19/14
 * Time: 2:20 PM
 */

//Assign the value;
$value = 0;


//If statement
if($value == 0){
    echo 0;
}elseif($value == 1){
    echo 1;
}elseif($value == 2){
    echo 2;
}elseif($value == 3){
    echo 3;
}elseif($value == 4){
    echo 4;
}else{
    echo "You didn't assign a number between 0 and 4";
}

echo "<br>";

//Switch Case Statement
switch($value){
    case 0:
        echo 0;
        break;
    case 1:
        echo 1;
        break;
    case 2:
        echo 2;
        break;
    case 3:
        echo 3;
        break;
    case 4:
        echo 4;
        break;
    default:
        echo "You didn't assign a number between 0 and 4";
}
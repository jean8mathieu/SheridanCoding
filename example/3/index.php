<?php
/**
 * Created by PhpStorm.
 * User: Jean-Mathieu
 * Date: 12/20/14
 * Time: 9:38 AM
 */


//Include the class intor your PHP script
require("calculation.php");

$calc = new calculation();

//Add 1 + 2 (Echo the result)
echo $calc->add(1,2) . "<br>";

//Sub 2 - 1 (Echo the result)
echo $calc->sub(2,1) . "<br>";

//Mul 2 x 2 (Echo the result)
echo $calc->mul(2,2) . "<br>";

//Div 2 / 2 (Echo the result)
echo $calc->div(2,2) . "<br>";

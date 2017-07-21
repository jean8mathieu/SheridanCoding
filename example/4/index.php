<?php
/**
 * Created by PhpStorm.
 * User: Jean-Mathieu
 * Date: 1/11/15
 * Time: 5:58 PM
 */

$content = file_get_contents('http://www.jmdev.ca/sheridan/api/picture/');
$array = json_decode($content, TRUE);

//** To read the array: **
//print_r($array);

echo "ID, Image Location, Uploaded Date and Image Size <br>";
for($i = 0; $i <= sizeof($array); $i++){
    echo $array[$i]['albumId'] . ": [" . $array[$i]['imageLocation'] . "] [" . $array[$i]['uploadedDate'] . "] [" . $array[$i]['imageSize'] . "]<br>";
}
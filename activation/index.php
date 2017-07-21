<?php
/**
 * Created by PhpStorm.
 * User: Jean-Mathieu
 * Date: 5/15/14
 * Time: 1:35 AM
 */

$key = @$_GET['key'];

include("../connection.php");

// Connect to server and select database.
mysql_connect("$host", "$username", "$password") or die("cannot connect");
mysql_select_db("$db_name") or die("cannot select DB");

$sql = "UPDATE  `account` SET  `active` = '1' WHERE  `activation`='$key'";
$result = mysql_query($sql);
if ($result) {
    echo("Your account is now activated!");
    header("refresh: 2; http://www.jmdev.ca/sheridan/");
} else {
    echo("You key isn't valid! Make sure you check your email and you click on the link.");
}
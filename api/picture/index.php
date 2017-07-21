<?php
/**
 * Created by PhpStorm.
 * User: Jean-Mathieu
 * Date: 12/13/14
 * Time: 1:46 PM
 */



include("../../connection.php");
mysql_connect("$host", "$username", "$password") or die("Cannot connect. Contact the admin!");
mysql_select_db("$db_name") or die("cannot select DB. Contact the admin!");

$query = mysql_query("SELECT albumId,imageLocation,uploadedDate,imageSize FROM album WHERE allow='1'");
$rows = array();
while($r = mysql_fetch_assoc($query)) {
    $rows[] = $r;
}
print json_encode($rows);
<?php
/**
 * Created by PhpStorm.
 * User: Jean-Mathieu
 * Date: 12/13/14
 * Time: 1:45 PM
 */

include("../../connection.php");
mysql_connect("$host", "$username", "$password") or die("Cannot connect. Contact the admin!");
mysql_select_db("$db_name") or die("cannot select DB. Contact the admin!");

$query = mysql_query("SELECT id,code,dateCreated,section,title,dateUpdated,attachment,tags FROM article WHERE approved='1' AND section<>'text'");
$rows = array();
while($r = mysql_fetch_assoc($query)) {
    $rows[] = $r;
}
print json_encode($rows);
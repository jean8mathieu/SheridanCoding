<?php
/**
 * Created by PhpStorm.
 * User: Jean-Mathieu
 * Date: 9/1/14
 * Time: 6:00 PM
 */

include("../head.php");
include ("../label.php");
include ("../connection.php");
mysql_connect("$host", "$username", "$password") or die("cannot connect");
mysql_select_db("$db_name") or die("cannot select DB");

$sql1 = "SELECT * FROM article WHERE (section='avrasm' OR section='java' OR section='bash' OR section='objectivec') AND approved='1'";
$result1 = mysql_query($sql1);
?>
<?php while ($rows = mysql_fetch_array($result1)) {
    $label = getLabel($rows['section'])
    ?>
    <h3><a href="/sheridan/page?p=<?php echo($rows['id']); ?>" style="text-decoration: none"><?php echo($rows['title']) . " " . $label; ?></a></h3>
<?php } ?>

<?php include("../bottom.php"); ?>
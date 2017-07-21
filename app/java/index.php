<?php
/**
 * Created by PhpStorm.
 * User: Jean-Mathieu
 * Date: 9/1/14
 * Time: 6:00 PM
 */

include("../../head.php");
include ("../../label.php");
include ("../../connection.php");
mysql_connect("$host", "$username", "$password") or die("cannot connect");
mysql_select_db("$db_name") or die("cannot select DB");

$sql1 = "SELECT * FROM article WHERE section='java' AND approved='1'";
$result1 = mysql_query($sql1);

//echo '<h3><a href="/sheridan/java_book.php" target="_blank">Java Book</a></h3>'
?>
    
<?php while ($rows = mysql_fetch_array($result1)) {
    $label = getLabel($rows['section'])
    ?>
    <h3><a href="/sheridan/page?p=<?php echo($rows['id']); ?>" style="text-decoration: none"><?php echo($rows['title']) . " " . $label; ?></a></h3>
<?php } ?>

<?php include("../../bottom.php"); ?>
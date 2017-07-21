<?php
/**
 * Created by PhpStorm.
 * User: Jean-Mathieu
 * Date: 11/30/14
 * Time: 2:13 PM
 */

session_start();

include("../connection.php");
if (!@isset($_GET['p'])) {
    $page = 1;
} else {
    $page = @$_GET['p'];
}

mysql_connect("$host", "$username", "$password") or die("Cannot connect. Contact the admin!");
mysql_select_db("$db_name") or die("cannot select DB. Contact the admin!");
$pageTotal = $page * 5;

$sqlCount = "SELECT * FROM album WHERE allow='1'";
$resultCount = mysql_query($sqlCount);
$cnt = mysql_num_rows($resultCount);

$numberPage = ($cnt / 5);

$sql = "SELECT *
FROM album al, account ac
WHERE al.allow = '1'
AND al.userId = ac.id
ORDER BY al.albumId DESC LIMIT " . ($pageTotal - 5) . ", " . (5);
$result = mysql_query($sql);


include("../head.php");
require_once("../script/mypagin.php");
require("../script/picture.php");



$pagin = new simplepagin();


$pagin->total_records = $cnt;
$pagin->noperpage = 5;
//this would give example.php?page=1 url type
$pagin->url = 'http://www.jmdev.ca/sheridan/picture/';
$pagin->val = 'p';

if ($detect->isMobile()) {
    $pagin->size = 'sm';
} else {
    $pagin->size = 'lg';
}
if($_SESSION['website'] == false){
    echo($message);
}else{
//call the pagin function
?>
<center>
    <?php $pagin->pagin(); ?>
</center>
<?php

$counter = 0;
?>

<hr>
<?php while ($rows = mysql_fetch_array($result)) {
        $picture = new picture($rows[0],$rows[1],$rows[7],$rows[2],$rows[4]);
        if(!$detect->isMobile()){
            if ($counter == 0 || $counter == 2 || $counter == 4) {
                echo $page->getAdsComputer() . "<hr>";
            }
        }else{
            if ($counter == 0 || $counter == 2 || $counter == 4) {
                echo $page->getAdsMobile() . "<hr>";
            }
        }
    $counter++;
    ?>


    <h1><?php
        //GetImageTitle
        echo $picture->getImageDisplayTitle();
        if(!empty($_SESSION['username']) && !empty($_SESSION['userId'])){
        if ($auth->getRole() < 2 || $auth->getPictureProfileId($picture->getImageId()) == $auth->getUsernameID()) {
            //ImagePower
            echo $picture->getImagePower();
         }}
        ?>
    </h1>
        <?php //Facebook Like/Share
            echo $picture->getImageFacebookLikeShare()
        ?>
    <br>
        <?php //Display Image
            echo $picture->getDisplayImage();
        ?>
    <h3>
        <?php //Display Image Info
            echo $picture->getImageInfo();
        ?>
    </h3>
        <?php //Facebook Comment
            echo $picture->getImageFacebookComment();
        ?>
    <hr>
<?php
}

?>
<center>
    <?php $pagin->pagin(); ?>
</center>
<?php

}

include("../bottom.php");

if(@$_GET['action'] == "deleted"){ ?>
    <script>alert("Picture Deleted!");</script>
<?php }elseif(@$_GET['action'] == "failed"){ ?>
    <script>alert("Picture Could Not Deleted...");</script>
<?php }
?>

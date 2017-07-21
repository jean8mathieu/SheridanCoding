<?php
/**
 * Created by PhpStorm.
 * User: Jean-Mathieu
 * Date: 11/30/14
 * Time: 6:21 PM
 */


include("../../head.php");
include("../../connection.php");
require("../../script/picture.php");
if($_SESSION)

mysql_connect("$host", "$username", "$password") or die("cannot connect");
mysql_select_db("$db_name") or die("cannot select DB");

$id = @$_GET['id'];

$sql = "SELECT * FROM album al,account ac WHERE al.allow='1' AND al.userId = ac.id AND al.albumId='$id'";
$result = mysql_query($sql);
$num = mysql_num_rows($result);

if($_SESSION['website'] == false){
    echo($message);
}else{
if($num == 1){
while ($rows = mysql_fetch_array($result)) {
    $picture = new picture($rows[0],$rows[1],$rows[7],$rows[2],$rows[4]);
    if(!$detect->isMobile()){
        echo $page->getAdsComputer() . "<hr>";
    }else{
        echo $page->getAdsMobile() . "<hr>";
    }
    ?>
<hr>
<h1>
    <?php // Image Title
    echo $picture->getImageDisplayTitleNoRedirect();
    if(!empty($_SESSION['username']) && !empty($_SESSION['userId'])){
        if ($auth->getRole() < 2 || $auth->getPictureProfileId($picture->getImageId()) == $auth->getUsernameID()){
            //Picture Power
            echo $picture->getImagePower();
        }} ?>
</h1>
    <?php //Facebook Like Share
        echo $picture->getImageFacebookLikeShare();
    ?>
<br>
        <?php //Display Image
        echo $picture->getDisplayImageNoRedirect();
    ?>
<br>
<h3>
    <?php // Image Info
        echo $picture->getImageInfo();
    ?>
</h3>
<?php // Facebook Comment
    echo $picture->getImageFacebookComment();
}}else{ ?>
    <h3 style="color: red;text-align: center">We could not find the picture you're looking for.</h3>
    <?php } ?>
<hr>
    <?php
    if(!$detect->isMobile()){
        echo $page->getAdsComputer() . "<hr>";
    }else{
        echo $page->getAdsMobile() . "<hr>";
    } ?>

<?php
}
    include("../../bottom.php");

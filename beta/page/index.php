<?php
/**
 * Created by PhpStorm.
 * User: Jean-Mathieu
 * Date: 9/1/14
 * Time: 5:44 PM
 */

$id = @$_GET['p'];

include("../connection.php");
require("../script/article.php");
mysql_connect("$host", "$username", "$password") or die("cannot connect");
mysql_select_db("$db_name") or die("cannot select DB");

$sql = "SELECT * FROM article ar,account ac WHERE ar.approved='1' AND ar.author = ac.id AND ar.id='$id'";
$result = mysql_query($sql);


include("../head.php");
?>
<?php
if(!$detect->isMobile()){
    echo $page->getAdsComputer() . "<hr>";
}else{
    echo $page->getAdsMobile() . "<hr>";
} ?>


<?php

if($_SESSION['article'] == false || $_SESSION['website'] == false){
    echo($message);
}else{

$num = mysql_num_rows($result);
if($num == 1){
while ($rows = mysql_fetch_array($result)) {
    $article = new article($rows[0],$rows['title'],$rows['author'],$rows['description'],$rows['code'],$rows['section'],$rows['updatedBy'],$rows['username'],$rows['dateUpdated'],$rows['dateCreated'],$rows['attachment']);
    ?>

    <h1><?php echo $article->getArticleDisplayTitleNoRedirect();
    if(!empty($_SESSION['username']) && !empty($_SESSION['userId'])){
        if ($auth->getRole() < 2 || $auth->getArticleProfileId($article->getArticleId()) == $auth->getUsernameID()){
           //Article Power
            echo $article->getArticlePower();
        }} ?>
    </h1>
    <?php //Facebook Like Share
    echo $article->getFacebookShareLike(); ?>

    <h3>Description: </h3>
    <?php echo $article->getDescription(); ?>
    <?php
    if($article->getArticleCode() != null){?>
    <h3>Code: </h3>
    <?php //Get Code
        echo $article->getCode(); ?>
        <?php } ?>
    <h5>
    <?php //Get Attachment
        echo $article->getAttachment(); ?>
    </h5>
    <h3>
        <?php //Get Article Info
        echo $article->getArticleInfo();
        ?>
    </h3>

    <?php //Facebook Comment
    echo $article->getFacebookComment(); ?>

<?php
    }
    }else{ ?>
    <h3 style="color: red;text-align: center">We could not find the article you're looking for.</h3>
<?php }
} ?>
<hr>
<?php
    if(!$detect->isMobile()){
        echo $page->getAdsComputer() . "<hr>";
    }else{
        echo $page->getAdsMobile() . "<hr>";
    }
 ?>

<?php

include("../bottom.php"); ?>

<?php
/**
 * Created by PhpStorm.
 * User: Jean-Mathieu
 * Date: 12/6/14
 * Time: 7:48 PM
 */




session_start();

include("head.php");

include("connection.php");

//Article Class
//require("script/article.php");

require("script/mypagin.php");
$pagin = new simplepagin();




if($detect->isMobile()){
    $pagin->size = 'sm';
}else{
    $pagin->size = 'lg';
}

if (!@isset($_GET['p'])) {
    $pageN = 1;
} else {
    $pageN = @$_GET['p'];
}

mysql_connect("$host", "$username", "$password") or die("Cannot connect. Contact the admin!");
mysql_select_db("$db_name") or die("cannot select DB. Contact the admin!");

$pageTotal = $pageN * 5;
$sql = "SELECT * FROM article ar,account ac WHERE ar.approved='1' AND ar.author = ac.id ORDER BY ar.id DESC LIMIT " . ($pageTotal - 5) . ", " . (5);
$result = mysql_query($sql);

$sqlCount = "SELECT * FROM article WHERE approved='1'";
$resultCount = mysql_query($sqlCount);
$cnt = mysql_num_rows($resultCount);


$pagin->total_records = $cnt;
$pagin->noperpage = 5;
//this would give example.php?page=1 url type
$pagin->url = 'http://www.jmdev.ca/sheridan/';
$pagin->val = 'p';

if(!$result){
    echo("We could not get the article.");
}

$counter = 0;
?><center>
<?php $pagin->pagin(); ?>
</center><hr>
<?php
while ($rows = mysql_fetch_array($result)) {
    $article = new article($rows[0],$rows['title'],$rows['author'],$rows['description'],$rows['code'],$rows['section'],$rows['updatedBy'],$rows['username'],$rows['dateUpdated'],$rows['dateCreated'],$rows['attachment'],$rows['tags'],$rows['picture'],$rows['biblio']);
    if(!$detect->isMobile()){
        if ($counter == 0 || $counter == 2 || $counter == 4) {
            echo $page->getAdsComputerA() . "";
        }
        if ($counter == 1 || $counter == 3 || $counter == 5) {
            echo $page->getAdsComputerB() . "";
        }
    }else{
        if ($counter == 0 || $counter == 2 || $counter == 4) {
            echo $page->getAdsMobile() . "";
        }
    }
    $counter++;
    ?>
    <h1><?php //Display Title
        echo $article->getArticleDisplayTitle();
        if(!empty($_SESSION['username']) && !empty($_SESSION['userId'])){
            if ($auth->getRole() < 2 || $auth->getArticleProfileId($article->getArticleId()) == $auth->getUsernameId()){
                echo $article->getArticlePower();
            }
        } ?>
    </h1>
    <?php //Facebook Share/Like Plugin
    echo $article->getFacebookShareLike();

    if ($article->getDescription() != null) { ?>
        <div style="font-style: oblique">Description:</div>
        <?php echo $article->getDescription();
    } else {
        if (!$article->getCodePreview() == null) {
            $article->setView();
            ?>
            <div style="font-style: oblique">Code Preview:</div>
            <?php echo $article->getCodePreview();
        }
    } ?>
    <h5>
        <?php echo $article->getAttachment() . "<br>";
         $article->getArticleTags();
        ?>
    </h5>
    <p>
        <?php echo "Total views: " .  $article->getView(); ?>
    </p>
    <h3>
        <?php //Article Info
            echo $article->getArticleInfo();
        ?>
    </h3>

    <?php // FACEBOOK Comment Plugin
    echo $article->getFacebookComment();
    ?>

    <hr>
<?php
} ?>

<center>
    <?php $pagin->pagin(); ?>
</center>
<?php
include("bottom.php");
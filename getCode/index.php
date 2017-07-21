<?php
/**
 * Created by PhpStorm.
 * User: Jean-Mathieu
 * Date: 9/6/14
 * Time: 6:17 AM
 */


session_start();
include("../connection.php");

/*if ($_SESSION['role'] ) {
    header('Location: ../');
    exit;
}*/

if (!@isset($_GET['p'])) {
    $page = 1;
} else {
    $page = @$_GET['p'];
}

include("../head.php");

mysql_connect("$host", "$username", "$password") or die("Cannot connect. Contact the admin!");
mysql_select_db("$db_name") or die("cannot select DB. Contact the admin!");
$pageTotal = $page * 5;

if($auth->getRole() < 2){
    $sql = "SELECT * FROM article WHERE approved='0' ORDER BY id DESC ";
}else{
    $name = $auth->getUsernameID();
    $sql = "SELECT * FROM article WHERE approved='0' AND author='$name' ORDER BY id DESC";
}
$result = mysql_query($sql);

include("../label.php");
$count = mysql_num_rows($result);
if ($count == 0) {
    echo "<h3 style='color: red;text-align: center'>There's no article to be approved / review.</h3>";
}
while ($rows = mysql_fetch_array($result)) {
    $article = new article($rows[0], $rows['title'], $rows['author'], $rows['description'], $rows['code'], $rows['section'], $rows['updatedBy'], $rows['username'], $rows['dateUpdated'], $rows['dateCreated'], $rows['attachment'], $rows['tags'], $rows['picture'], $rows['biblio']);


    if(!empty($_SESSION['username']) && !empty($_SESSION['userId'])){
        if ($auth->getRole() < 2) {
            echo $article->getApprovalPower();
        }
    }else{
        echo "<h1>" . $article->getArticleTitle() . "</h1>";
    }
    //Facebook Like Share
    echo $article->getFacebookShareLike(); ?>

    <h3>Description: </h3>
    <?php echo $article->getDescription(); ?>

    <h3>Audio (Alpha): </h3>
    <?php
    $arrays  = $article->getArticleDescriptionAudio();
    for($i = 0; $i < sizeof($arrays);$i++){
        if(sizeof($arrays) > 1){
            echo "<h4>Part: " . ($i + 1) ."</h4>";
        } ?>
        <audio controls="controls">
            <source src='<?php echo $arrays[$i]; ?>' type="audio/mp3"/>
        </audio>
        <br>
    <?php
    }
    if($article->getArticleCode() != null){?>
        <h3>Code: </h3>
        <?php //Get Code
        echo $article->getCode(); ?>
    <?php } ?>
    <h5>
        <?php //Get Attachment
        echo $article->getAttachment() . "<br>";
        $article->getArticleTags();
        ?>
    </h5>
    <?php echo("<h3>Total Views: " . $article->getView() ."</h3>") ?>
    <h3>
        <?php //Get Article Info
        echo $article->getArticleInfo();
        ?>
    </h3>

    <?php //Facebook Comment
    echo $article->getFacebookComment();


    ?>

<?php
}

include("../bottom.php");
?>

<?php
/**
 * Created by PhpStorm.
 * User: Jean-Mathieu
 * Date: 8/16/14
 * Time: 7:08 AM
 */

session_start();
include("connection.php");
include("label.php");

if (!isset($_GET['p'])) {
    $page = 1;
} else {
    $page = $_GET['p'];
}

mysql_connect("$host", "$username", "$password") or die("Cannot connect. Contact the admin!");
mysql_select_db("$db_name") or die("cannot select DB. Contact the admin!");


$sqlCount = "SELECT * FROM article WHERE approved='1'";
$resultCount = mysql_query($sqlCount);
$cnt = mysql_num_rows($resultCount);

//$numberPage = ($cnt / 5);
$pageTotal = $page * 5;
$sql = "SELECT * FROM article ar,account ac WHERE ar.approved='1' AND ar.author = ac.id ORDER BY ar.id DESC LIMIT " . ($pageTotal - 5) . ", " . (5);
$result = mysql_query($sql);


include("index1.php");
require_once("mypagin.php");
$pagin = new simplepagin();


$pagin->total_records = $cnt;
$pagin->noperpage = 5;
//this would give example.php?page=1 url type
$pagin->url = 'https://www.jmdev.ca/sheridan/';
$pagin->val = 'p';
//pagin size (sm or lg )
//for default pagination size leave value empty like this $pagin->size=''
if($detect->isMobile()){
    $pagin->size = 'sm';
}else{
    $pagin->size = 'lg';
}


if($_SESSION['article'] == false || $_SESSION['website'] == false){
    echo($message);
}else{
//call the pagin function
?>
<center>
<?php $pagin->pagin(); ?>
</center>
<?php $counter = 0;

//echo "Total Max: " . $pageTotal . " | Total Min: " . ($pageTotal - 5);
?>

<hr>
<?php

while ($rows = mysql_fetch_array($result)) {
    if(!$detect->isMobile()){
    if ($counter == 0 || $counter == 2 || $counter == 4) {
        ?>
        <center>
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- JMDevSheridan -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:728px;height:90px"
                 data-ad-client="ca-pub-5923775871016604"
                 data-ad-slot="7527625965"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </center>
        <hr>
    <?php
    }
    }
    $counter++;
    ?>


    <h1><a href="<?php echo "https://www.jmdev.ca/sheridan/page/?p=" . $rows[0]; ?>"
           style="text-decoration: none"><?php echo($rows['title'] . " " . getLabel($rows['section'])) ?></a>
        <?php
        if(!empty($_SESSION['username']) && !empty($_SESSION['userId'])){
            if ($auth->getAccountRole($_SESSION['username']) < 2 || $auth->getArticleProfileId($rows[0]) == $_SESSION['userId']){ ?>
                <small>
                <a href="/sheridan/edit/?id=<?php echo($rows[0] . "&a=" . md5($rows['author'])); ?>"><span
                    class="glyphicon glyphicon-pencil" style="text-decoration: none"></span></a>
                <a href="/sheridan/delete/?id=<?php echo($rows[0] . "&a=" . md5($rows['author'])); ?>"><span
                    class="glyphicon glyphicon-trash" style="text-decoration: none"></span></a>
                </small>
            <?php }} ?>
    </h1>
    <div class="fb-like" data-href="<?php echo 'https://www.jmdev.ca/sheridan/page/?p=' . $rows[0]; ?>"
         data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>


    <?php if ($rows['description'] != null) { ?>
        <div style="font-style: oblique">Description:</div>
        <?php echo($rows['description']); ?>

    <?php
    } else {
        if (!$rows['code'] == null) {
            ?>
            <div style="font-style: oblique">Code Preview:</div>
            <pre>
        <?php if ($rows['section'] == "text") {
            echo mb_strimwidth($rows['code'], 0, 1000, '<h3 style="color: red">**Click on the title to see the full article.**</h3>');
        } else {
            ?>
            <code
                class="<?php echo($rows['section']) ?>"><?php echo mb_strimwidth($rows['code'], 0, 1000, '<h3 style="color: red">**Click on the title to see the full article.**</h3>'); ?></code>
        <?php } ?>
    </pre>
        <?php
        }
    } ?>
    <h5>
        <small>Attachments:
            <?php if ($rows['attachment'] != null) {
                $links = explode("-", $rows['attachment']);
                $link = $links[count($links) - 1];
                echo '<a href="' . $rows['attachment'] . '">' . $link . '</a>';
            } else {
                echo "None";
            } ?>
        </small>
    </h5>
    <h3>
        <small>Created by: <a href="profile/<?php echo($rows['username']); ?>"><?php echo($rows['username']); ?></a>
            on <?php echo date("m/d/y", $rows['dateCreated']); ?><?php if ($rows['dateUpdated'] != 0){ ?> and updated
            on <?php echo date("m/d/y", $rows['dateUpdated']) . " by " . '<a href="profile/' . updatedBy($rows['updatedBy']) . '">' . updatedBy($rows['updatedBy']);
            } ?></a></small>
    </h3>

    <div class="fb-comments" data-href="<?php echo 'https://www.jmdev.ca/sheridan/page/?p=' . $rows[0]; ?>"
         data-width="700px" data-numposts="2"
         data-colorscheme="light">
    </div>
    <hr>
<?php
}

?>
<center>
    <?php $pagin->pagin(); ?>
</center>
<?php }
?>


<?php
function updatedBy($id)
{
    include("connection.php");
    mysql_connect("$host", "$username", "$password") or die("Cannot connect. Contact the admin!");
    mysql_select_db("$db_name") or die("cannot select DB. Contact the admin!");
    $sqlBy = "SELECT * FROM account Where id='$id'";
    $resultBy = mysql_query($sqlBy);
    $rowsBy = mysql_fetch_array($resultBy);
    $id = $rowsBy['username'];
    return $id;
}

?>

<?php
include("index2.php");
?>

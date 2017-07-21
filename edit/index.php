<?php
/**
 * Created by PhpStorm.
 * User: Jean-Mathieu
 * Date: 9/3/14
 * Time: 3:54 AM
 */
$id = @$_GET['id'];
$author = @$_GET['a'];

session_start();
/*if (!$author == md5($_SESSION['username']) || !$_SESSION['role'] == 0) {
    //echo $author . " != " . md5($_SESSION['username']) . " || " . $_SESSION['role'] . " != 0";
     header('Location: http://www.jmdev.ca/sheridan/');
    exit;
}*/
include("../connection.php");
include("../head.php");


mysql_connect("$host", "$username", "$password") or die("Cannot connect. Contact the admin!");
mysql_select_db("$db_name") or die("cannot select DB. Contact the admin!");
$sql = "SELECT * FROM article WHERE `id`='$id' LIMIT 1";
$result = mysql_query($sql);

if ($auth->getConnected() && $auth->getRole() < 7) {

while ($rows = mysql_fetch_array($result)) {
?>
<form method="post" action="../script/editArticle.php?id=<?php echo $id //. "&a=" . $author ?>" enctype="multipart/form-data">
    <div class="form-group">
        <label for="article">Title:</label>
        <input class="form-control" type="text" placeholder="Title of the article" name="article" id="article"
               maxlength="70" required value="<?php echo $rows['title']; ?>"><br>
    </div>

    <div class="form-group">
        <label for="visible">Private:</label>
        <input type="checkbox" name="visible" id="visible" style="margin-top: 4px" ><br>
    </div>

    <div class="form-group">
        <label for="category">Choose a category:</label>
        <select class="form-control" name="category" id="category" required>
            <option></option>
            <?php  if ($rows['section'] == "news"){ ?>
                <option value="9" selected>News</option>
            <?php }else{ ?>
                <option value="9">News</option>
            <?php } ?>

            <option disabled class="separator"></option>


            <?php if ($rows['section'] == "avrasm"){ ?>
                <option value="6" selected>Assembly</option>
            <?php }else{ ?>
                <option value="6">Assembly</option>

            <?php } if ($rows['section'] == "c"){ ?>
                <option value="7" selected>C</option>
            <?php }else{ ?>
                <option value="7">C</option>

                <?php  if ($rows['section'] == "java"){ ?>
                    <option value="1" selected>Java</option>
                <?php }else{ ?>
                    <option value="1">Java</option>
                <?php } ?>

            <?php } if ($rows['section'] == "bash"){ ?>
                <option value="13" selected>Linux</option>
            <?php }else{ ?>
            <option value="13">Linux</option>
            <?php } ?>



            <option disabled class="separator"></option>

            <?php  if ($rows['section'] == "html"){?>
                <option value="2" selected>HTML/CSS</option>
            <?php }else{ ?>
                <option value="2">HTML</option>

            <?php } if ($rows['section'] == "js"){ ?>
                <option value="3" selected>Javascript</option>
            <?php }else{ ?>
            <option value="3">Javascript</option>
            <?php } ?>

            <?php if ($rows['section'] == "php"){ ?>
                <option value="4" selected>PHP/MySQL</option>
            <?php }else{ ?>
                <option value="4">PHP/MySQL</option>
            <?php } ?>

            <?php if ($rows['section'] == "javaweb"){ ?>
                <option value="15" selected>Java Web</option>
            <?php }else{ ?>
                <option value="15">Java Web</option>
            <?php } ?>

            <option disabled class="separator"></option>

            <?php  if ($rows['section'] == "calculus"){ ?>
                <option value="8" selected>Calculus</option>
            <?php }else{ ?>
                <option value="8">Calculus</option>

            <?php } if ($rows['section'] == "discrete"){ ?>
                <option value="10" selected>Discrete Math</option>
            <?php }else{ ?>
            <option value="10">Discrete Math</option>

            <?php } if ($rows['section'] == "r"){ ?>
                <option value="12" selected>R</option>
            <?php }else{ ?>
                <option value="12">R</option>

            <?php } if ($rows['section'] == "statistic"){ ?>
                <option value="11" selected>Statistic</option>
            <?php }else{ ?>
            <option value="11">Statistic</option>
            <?php } ?>

            <option disabled class="separator"></option>

            <?php  if ($rows['section'] == "text"){ ?>
                <option value="5" selected>Other</option>
            <?php }else{ ?>
                <option value="5">Other</option>
            <?php } ?>

            <option disabled class="separator"></option>

            <?php  if ($rows['section'] == "sql"){ ?>
                <option value="14" selected>SQL</option>
            <?php }else{ ?>
                <option value="14">SQL</option>
            <?php } ?>

        </select>
    </div>

    <div class="form-group">
        <label for="description">Write your description here:</label>
        <textarea class="ckeditor" name="description" id="description" cols="50" rows="10" maxlength="65535"
                  placeholder="Write your description here (HTML Code is accepted)" required><?php echo $rows['description']; ?></textarea>
    </div>

    <div class="form-group">
        <label for="paragraph">Write your code here:</label>
        <textarea class="form-control" name="paragraph" id="paragraph" cols="50" rows="30" maxlength="65535"
                  placeholder="Write your code here"><?php echo $rows['code']; ?></textarea>
    </div>

    <div class="form-group">
        <label>Tags (Separate it with ,):</label>
        <input type="text" id="tags" name="tags" placeholder="Ex:Netbeans,While loop" value="<?php echo($rows['tags']); ?>" class="form-control">
    </div>

    <div class="form-group">
        <label for="file">Upload File (.zip):</label>
        <input type="file" id="file" name="file" class="form-control">
    </div>
    <div class="alert alert-danger" role="alert">
            <strong>Don't forget to re upload your file again.</strong>
    </div>
    <div class="form-group">
        <button type="submit" class="form-control" style="width: 100%">Update your code</button>
    </div>
</form>


<?php }
include("../bottom.php"); ?>

<script src="/sheridan/js/ckeditor.js"></script>

<?php } else {
    include("../getUrl.php");
    $_SESSION['url'] = curPageURL();
    include("../");
    exit;
}

<?php
/**
 * Created by PhpStorm.
 * User: Jean-Mathieu
 * Date: 9/1/14
 * Time: 1:56 AM
 */

session_start();

error_reporting(0);
require_once("authentication.php");

$auth = new authentication();

//True to open the website
$_SESSION['article'] = true;
$_SESSION['website'] = true;


$_SESSION['site'] = "Sheridan Coding";
$message = '<div style="text-align: center"><h1 style="color: red">This part of this website have been disabled. (Website Security Issue)</h1>
<h3 style="color: red">If you have any question you can email me at <a href="mailto:jean-mathieu.emond@jmdev.ca">jean-mathieu.emond@jmdev.ca</a>.</h3></div>';

function getImageUrl($id){
    include("connection.php");
    mysql_connect("$host", "$username", "$password") or die("Cannot connect. Contact the admin!");
    mysql_select_db("$db_name") or die("cannot select DB. Contact the admin!");
    $sql = "SELECT * FROM album WHERE albumId='$id'";
    $result = mysql_query($sql);
    $rows = mysql_fetch_array($result);
    return "https://www.jmdev.ca/sheridan/picture/img/" . $rows[2];
}

function getUserId($user){
    include("connection.php");
    mysql_connect("$host", "$username", "$password") or die("Cannot connect. Contact the admin!");
    mysql_select_db("$db_name") or die("cannot select DB. Contact the admin!");
    $sql = "SELECT * FROM account WHERE username='$user'";
    $result = mysql_query($sql);
    $rows = mysql_fetch_array($result);
    return $rows['id'];
}

include("script/Mobile_Detect.php");
$detect = new Mobile_Detect();

if (isset($_COOKIE['username'])){
    $_SESSION['login'] = true;
    $_SESSION['role'] = getRole($_COOKIE['username']);
    $_SESSION['userId'] = getUserId($_COOKIE['username']);
}

if ( $_SESSION['username'] == ""){
    unset($_SESSION['username']);
    unset($_SESSION['role']);
}

if ($_SESSION['login'] != true) {
    $_SESSION['login'] = false;
    $_SESSION['role'] = 9;
    //include("main_login.php");
    //exit;
}

if (isset($_SESSION['username'])){
}else{
    //echo "Username is FALSE";
    unset($_SESSION['role']);

}
include("getUrl.php");
include("connection.php");
mysql_connect("$host", "$username", "$password") or die("cannot connect");
mysql_select_db("$db_name") or die("cannot select DB");

$sql1 = "SELECT * FROM article WHERE section='java'";
$result1 = mysql_query($sql1);

$sql2 = "SELECT * FROM article WHERE section='html' OR section ='js'";
$result2 = mysql_query($sql2);

?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/sheridan/img/favicon.ico">
    <link href="/sheridan/picture/upload/css/uploadfilemulti.css" rel="stylesheet">
    <script src="/sheridan/picture/upload/js/jquery-1.8.0.min.js"></script>
    <script src="/sheridan/picture/upload/js/jquery.fileuploadmulti.min.js"></script>
    <script src="/sheridan/js/bootstrap.js"></script>

    <?php
    $title = false;

    $domain = $_SERVER['SCRIPT_URI'];//$_SERVER['HTTP_HOST'];
    $positionTotal = strlen($domain);
    $position = strpos($domain,"https://www.jmdev.ca/sheridan/profile/") + 38;
    $name = substr($domain,$position,$positionTotal);
    if(strpos($domain,'https://www.jmdev.ca/sheridan/profile')!== false){
    $title = true;?>
    <meta property="og:title" content="<?php echo $_SESSION['site'] . " - " . $name ."'s profile" ?>">
    <title><?php echo $_SESSION['site'] . " - " . $name ."'s profile" ?></title>
    <?php }
    ?>

    <?php if (isset($_GET['p'])) {
        $title = true;
        $id = $_GET['p'];
        $sqlTotal = "SELECT * FROM `article` WHERE `id`='$id' LIMIT 1";
        $resultTitle = mysql_query($sqlTotal);
        while ($rows = mysql_fetch_array($resultTitle)) {
            if ($rows['section'] == "java") {
                $category = "Java";
            } elseif ($rows['section'] == "html") {
                $category = "HTML";
            } elseif ($rows['section'] == "js") {
                $category = "Javascript";
            } elseif ($rows['section'] == "php") {
                $category = "PHP/MySQL";
            } elseif ($rows['section'] == "text"){
                $category = "Other";
            } elseif ($rows['section'] == "avrasm"){
                $category = "Assembly";
            } elseif ($rows['section'] == "objectivec"){
                $category = "C";
            }

            ?>
            <meta property="og:title" content="<?php echo $_SESSION['site'] . " - " . $rows['title'] . ' in ' . $category ?>">

            <title><?php echo $_SESSION['site'] . " - " . $rows['title'] . " in " . $category ?></title>
        <?php } ?>
        <title><?php echo ($_SESSION['site']); ?> - Computer Group</title>
    <?php } if($title == false){?>
        <title><?php echo ($_SESSION['site']); ?> - Computer Group</title>
    <?php }


    if(strpos($domain,'https://www.jmdev.ca/sheridan/picture')!== false){
        if($_GET['id'] > 0){?>
            <meta property="og:title" content="<?php echo ($_SESSION['site']); ?> - Picture #<?php echo($_GET['id']); ?>">
            <meta property="og:image" content="<?php echo getImageUrl($_GET['id']); ?>">
        <?php }else{ ?>
        <meta property="og:title" content="<?php echo ($_SESSION['site']); ?> - Pictures">
     <?php }}else{ ?>
    <meta property="og:image" content="https://www.jmdev.ca/img/sheridan.png">
    <?php } ?>
    <!-- Sementic -->


    <!-- Bootstrap core CSS -->
    <link href="/sheridan/css/bootstrap.min.css" rel="stylesheet">
    <link href="/sheridan/css/simple-sidebar.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/sheridan/css/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/8.2/styles/default.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/8.2/highlight.min.js"></script>

    <link rel="stylesheet" href="/sheridan/css/default.css">
    <script src="/sheridan/js/highlight.pack.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]>
    <script src="/sheridan/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="/sheridan/js/ie-emulation-modes-warning.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/sheridan/js/ie10-viewport-bug-workaround.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=570294056368460&version=v2.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/sheridan/"><?php echo ($_SESSION['site']); ?></a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <form class="navbar-form navbar-left" role="search" action="/sheridan/script/search.php" method="get">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search" name="search" <?php if (isset($_GET['search'])){ echo 'value="' . $_GET['search'] . '"';} ?>>
                    </div>
                </form>
                <!--<li><a href="#">Profile</a></li>-->
                <?php if ($_SESSION['login'] == true) { ?>
                    <li><a data-toggle="modal" data-target="#myPicture"><span class="glyphicon glyphicon-picture" title="Upload an Image"></span></a></li>
                    <?php if ($_SESSION['login'] == true && $_SESSION['role'] < 8) { ?>
                    <li><a href="/sheridan/submit/"><span class="glyphicon glyphicon-edit" title="Create an Article"></span></a> </li>
                <?php }} ?>
                <?php if ($detect->isMobile()) { ?>
                    <li><a href="/sheridan/java/">Java</a></li>
                    <li><a href="/sheridan/web/">Web Development</a></li>
                    <li><a href="/sheridan/assembler/">Assembly</a></li>
                    <li><a href="/sheridan/other/">Other</a></li>
                    <li><a href="/sheridan/c/">C</a></li>
                    <li><a href="/sheridan/picture/">Picture</a></li>
                <?php } ?>
                <?php if ($_SESSION['login'] == true) { ?>
                    <li><a href="/sheridan/logout"><span class="glyphicon glyphicon-log-out" title="Log out"></span></a></li>
                <?php } else { ?>
                    <li><a data-toggle="modal" data-target="#myLogin"><span class="glyphicon glyphicon-log-in" title="Log in"></span></a></li>
                    <li></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div id="wrapper">
        <div class="row">
            <!-- Sidebar -->

            <?php
            $sqlCount1 = "SELECT * FROM article WHERE approved='1'";
            $resultCount1 = mysql_query($sqlCount1);
            $cnt1 = mysql_num_rows($resultCount1);

            $sqlCount2 = "SELECT * FROM article WHERE section='html' OR section='js' OR section='php' AND approved='1'";
            $resultCount2 = mysql_query($sqlCount2);
            $cnt2 = mysql_num_rows($resultCount2);

            $sqlCount3 = "SELECT * FROM article WHERE section='java' AND approved='1'";
            $resultCount3 = mysql_query($sqlCount3);
            $cnt3 = mysql_num_rows($resultCount3);

            $sqlCount4 = "SELECT * FROM request WHERE approved='0'";
            $resultCount4 = mysql_query($sqlCount4);
            $cnt4 = mysql_num_rows($resultCount4);

            $sqlCount5 = "SELECT * FROM article WHERE approved='0'";
            $resultCount5 = mysql_query($sqlCount5);
            $cnt5 = mysql_num_rows($resultCount5);

            $sqlCount6 = "SELECT * FROM article WHERE section='text' AND approved='1'";
            $resultCount6 = mysql_query($sqlCount6);
            $cnt6 = mysql_num_rows($resultCount6);

            $sqlCount7 = "SELECT * FROM article WHERE section='avrasm' AND approved='1'";
            $resultCount7 = mysql_query($sqlCount7);
            $cnt7 = mysql_num_rows($resultCount7);

            $sqlCount8 = "SELECT * FROM article WHERE section='objectivec' AND approved='1'";
            $resultCount8 = mysql_query($sqlCount8);
            $cnt8 = mysql_num_rows($resultCount8);

            $sqlCount9 = "SELECT * FROM album WHERE allow='1'";
            $resultCount9 = mysql_query($sqlCount9);
            $cnt9 = mysql_num_rows($resultCount9);

            $sqlCount10 = "SELECT * FROM album WHERE allow='0'";
            $resultCount10 = mysql_query($sqlCount10);
            $cnt10 = mysql_num_rows($resultCount10);
            ?>
            <div id="sidebar-wrapper">
                <ul class="nav nav-pills nav-stacked">

                    <?php if ($_SESSION['login'] == true) { ?>
                        <li>
                            <h5 style="padding-left: 15px;padding-top: 10px; font-weight: bold">
                                Welcome <?php if(isset($_SESSION['username'])){ echo($_SESSION['username']);}elseif(isset($_COOKIE['username'])){echo($_COOKIE['username']);}else{echo("Guest");} ?></h5>
                        </li>
                        <hr>
                        <li>
                            <a href="/sheridan/changePassword">Change Your Password</a>
                        </li>
                        <hr>

                    <?php } ?>
                    <li>
                        <a href="/sheridan/"><span class="badge pull-right"><?php echo $cnt1; ?></span>Home</a>
                    </li>
                    <li>
                        <a href="/sheridan/picture"><span class="badge pull-right"><?php echo $cnt9; ?></span>Picture</a>
                    </li>
                    <li>
                        <a href="/sheridan/java"><span class="badge pull-right"><?php echo $cnt3; ?></span>Java</a>
                    </li>
                    <li>
                        <a href="/sheridan/web"><span class="badge pull-right"><?php echo $cnt2; ?></span>Web
                            Development</a>
                    </li>
                    <li>
                        <a href="/sheridan/assembler"><span class="badge pull-right"><?php echo $cnt7; ?></span>Assembly</a>
                    </li>
                    <li>
                        <a href="/sheridan/other"><span class="badge pull-right"><?php echo $cnt6; ?></span>Other</a>
                    </li>
                    <li>
                        <a href="/sheridan/c"><span class="badge pull-right"><?php echo $cnt8; ?></span>C</a>
                    </li>
                    <hr>
                    <li>
                        <a href="/sheridan/getRequest"><span class="badge pull-right"><?php echo $cnt4 ?></span>See all
                            Request</a>
                    </li>
                    <?php if ($_SESSION['login'] == true) { ?>
                        <li>
                            <a href="/sheridan/request"><span class="badge pull-right"></span>Request an Example</a>
                        </li>
                    <?php } ?>
                    <hr>
                    <? if ($_SESSION['role'] == 0) { ?>
                        <li>
                            <a href="/sheridan/getCode"><span class="badge pull-right"><?php echo $cnt5 ?></span>Article
                                Waiting for Approval</a>
                        </li>
                    <?php } ?>
                    <?php if ($_SESSION['login'] && $_SESSION['role'] < 8){ ?>
                    <li>
                        <a href="/sheridan/submit"><span class="badge pull-right"></span>Create an Article</a>
                    </li>
                    <hr>
                        <? if ($_SESSION['role'] == 0) { ?>
                            <li>
                                <a href="/sheridan/picture/approval"><span class="badge pull-right"><?php echo $cnt10 ?></span>Picture Waiting for Approval</a>
                            </li>
                            <hr>
                        <?php } ?>
                    <?php } ?>
                    <li style="text-align: center">
                        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                            <input type="hidden" name="cmd" value="_s-xclick">
                            <input type="hidden" name="hosted_button_id" value="9TDZHYB7UCDJW">
                            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif"
                                   border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                            <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1"
                                 height="1">
                        </form>
                    </li>
                    <hr>

                </ul>
            </div>


            <!-- Modal Login -->
            <div class="modal fade" id="myLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel" style="text-align: center">Log in / Register To <?php echo $_SESSION['site']; ?></h4>
                        </div>
                        <form class="form-signin" role="form" action="/sheridan/script/checklogin.php" method="post">
                        <div class="modal-body">
                            <h2 class="form-signin-heading">Please sign in</h2>

                            <input type="text" class="form-control" placeholder="Username" name="username" required autofocus >
                            <br>
                            <input type="password" class="form-control" placeholder="Password" name="password" required>
                            <br>
                            <input type="checkbox" name="stay" value="true">Remember Me?<br>
                            <a href="/sheridan/resetPassword">Forgot Password?</a>

                        </div>
                        <div class="modal-footer" style="text-align: center">
                            <button class="btn btn-primary" type="submit">Sign in</button>
                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#myRegister">Register</button></a>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Register -->
            <div class="modal fade" id="myRegister" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel" style="text-align: center">Log in / Register To <?php echo $_SESSION['site']; ?></h4>
                        </div>
                        <form class="form-signin" role="form" action="/sheridan/script/checklogin.php" method="post">
                            <div class="modal-body">
                                <h2 class="form-signin-heading">Please register</h2>

                                <input type="text" class="form-control" placeholder="Username" name="username" required autofocus >
                                <br>
                                <input type="password" class="form-control" placeholder="Password" name="password" required>
                                <br>
                                <input type="password" class="form-control" placeholder="Confirm Password" name="password2" required>
                                <br>
                                <label for="campus">Campus</label>
                                <select class="form-control" name="campus" id="campus" required>
                                    <option>Davis</option>
                                    <option>Trafalgar</option>
                                    <option>Hazel McCallion</option>
                                    <option>N/A</option>
                                </select>
                                <br>
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
                            </div>
                            <div class="modal-footer" style="text-align: center">
                                <button type="button" class="btn btn-primary">Confirm Register</button></a>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php if ($_SESSION['login'] == true) { ?>
            <!-- Modal Upload Image -->
            <div class="modal fade" id="myPicture" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel" style="text-align: center">Upload a Picture to <?php echo $_SESSION['site']; ?></h4>
                        </div>
                        <form method="post" action="/sheridan/picture/img/upload.php" enctype="multipart/form-data" role="form">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input name='myfile[]' type="file" multiple>
                                    <br>
                                </div>
                            </div>
                            <div class="modal-footer" style="text-align: center">
                                <input type="submit" value="Upload" class="btn btn-default">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <? } ?>
            <!-- /#sidebar-wrapper -->
            <?php if (!($detect->isMobile())) { ?>
                <a href="#menu-toggle" class="btn btn-default" id="menu-toggle"
                   style="position: fixed;z-index: 4;top: 45%">
                    <!--<span class="glyphicon glyphicon-list"></span>--><span
                        class="glyphicon glyphicon-resize-horizontal"></span><br><b>M<br>E<br>N<br>U</b><br><span
                        class="glyphicon glyphicon-resize-horizontal"></span> </a>
            <?php } ?>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" style="margin-left: 4px;width: 99%">

                <div class="alert alert-warning" role="alert">
                    <a href="mailto:jean-mathieu.emond@jmdev.ca" class="alert-link">Please report any bug that you see
                        by
                        clicking here or emailing jean-mathieu.emond@jmdev.ca</a>
                </div>

                <div class="alert alert-info" role="alert">
                    <a href="https://www.facebook.com/groups/1472824716299460/" class="alert-info" target="_blank">Are
                        you taking a computer class at Sheridan? Join our group now by clicking here!</a>
                </div>

                <div class="alert alert-danger" role="alert">
                    <strong>We are not responsible for any kind of plagiarism. This website have been created for learning purpose only.</strong>
                </div>
            <hr>




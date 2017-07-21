<?php
/**
 * Created by PhpStorm.
 * User: Jean-Mathieu
 * Date: 9/1/14
 * Time: 1:56 AM
 */



session_start();

//error_reporting(0);

//Page in class

//Authentication System
require("script/auth.php");
$auth = new auth();

//Looking if it's a phone
require("script/Mobile_Detect.php");
$detect = new Mobile_Detect();

//Data for the page
require("script/pageFrame.php");
$page = new pageFrame();

//Set Website
$page->settings();

//Client Banned
if($auth->clientBanned() >=1){ ?>
    <script type="text/javascript">
        alert("You have been Banned from this website!");
    </script>
    <?php exit;
}



//True to open the website
$_SESSION['article'] = true;
$_SESSION['website'] = true;



$message = '<div style="text-align: center"><h1 style="color: red">This part of this website have been disabled. (Website Security Issue)</h1>
<h3 style="color: red">If you have any question you can email me at <a href="mailto:jean-mathieu.emond@jmdev.ca">jean-mathieu.emond@jmdev.ca</a>.</h3></div>';

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
    $position = strpos($domain, $page->getSiteAddress() . "profile/") + 38;
    $name = substr($domain,$position,$positionTotal);
    if(strpos($domain, $page->getSiteName() .'profile')!== false){
        $title = true;?>
        <meta property="og:title" content="<?php echo $page->getSiteName() . " - " . $name ."'s profile" ?>">
        <title><?php echo $page->getSiteName() . " - " . $name ."'s profile" ?></title>
    <?php }
    ?>

    <?php if (@isset($_GET['p'])) {
        $title = true;
        $id = @$_GET['p'];
        $sqlTotal = "SELECT * FROM `article` WHERE `id`='$id' LIMIT 1";
        $resultTitle = mysql_query($sqlTotal);
        while ($rows = mysql_fetch_array($resultTitle)) {


            ?>
            <meta property="og:title" content="<?php echo $page->getSiteName() . " - " . $rows['title'] . ' in ' . $category ?>">

            <title><?php echo $_SESSION['site'] . " - " . $rows['title'] . " in " . $category ?></title>
        <?php } ?>
        <title><?php echo $page->getSiteName(); ?> - Computer Group</title>
    <?php } if($title == false){?>
        <title><?php echo $page->getSiteName(); ?> - Computer Group</title>
    <?php }


    if(strpos($domain,$page->getSiteAddress() .'picture')!== false){
        if(@$_GET['id'] > 0){?>
            <meta property="og:title" content="<?php echo $page->getSiteName(); ?> - Picture #<?php echo(@$_GET['id']); ?>">
            <meta property="og:image" content="<?php echo $page->getImageURL(@$_GET['id']); ?>">
        <?php }else{ ?>
            <meta property="og:title" content="<?php echo $page->getSiteName(); ?> - Pictures">
        <?php }}else{ ?>
        <meta property="og:image" content="<?php echo $page->getSiteAddress(); ?>img/sheridan.png">
    <?php } ?>
    <!-- Sementic -->


    <!-- Bootstrap core CSS -->
    <link href="/sheridan/css/bootstrap.min.css" rel="stylesheet">
    <link href="/sheridan/css/simple-sidebar.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/sheridan/css/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/highlight.js/8.2/styles/default.min.css">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/highlight.js/8.2/highlight.min.js"></script>

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
    <script src="http://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
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
            <a class="navbar-brand" href="/sheridan/"><?php echo $page->getSiteName(); ?></a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <form class="navbar-form navbar-left" role="search" action="/sheridan/script/search.php" method="get">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search" name="search" <?php if (@isset($_GET['search'])){ echo 'value="' . @$_GET['search'] . '"';} ?>>
                    </div>
                </form>
                <!--<li><a href="#">Profile</a></li>-->
                <?php if ($auth->getConnected()) { ?>
                    <li><a data-toggle="modal" data-target="#myPicture"><span class="glyphicon glyphicon-picture" title="Upload an Image"></span></a></li>
                    <li><a href="/sheridan/submit/"><span class="glyphicon glyphicon-edit" title="Create an Article"></span></a> </li>
                    <?php } ?>
                <?php if ($detect->isMobile()) { ?>
                    <li><a href="/sheridan/java/">Java</a></li>
                    <li><a href="/sheridan/web/">Web Development</a></li>
                    <li><a href="/sheridan/assembly/">Assembly</a></li>
                    <li><a href="/sheridan/other/">Other</a></li>
                    <li><a href="/sheridan/c/">C</a></li>
                    <li><a href="/sheridan/picture/">Picture</a></li>
                <?php } ?>
                <?php if ($auth->getConnected()) { ?>
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

<div id="sidebar-wrapper">
    <ul class="nav nav-pills nav-stacked">

        <?php if ($auth->getConnected()) { ?>
            <li>
                <h5 style="padding-left: 15px;padding-top: 10px; font-weight: bold">
                    Welcome <?php echo($auth->getUsername()); ?></h5>
            </li>
            <hr>
            <li>
                <a href="/sheridan/changePassword">Change Your Password</a>
            </li>
            <hr>

        <?php } ?>
        <li>
            <a href="/sheridan/"><span class="badge pull-right"><?php echo $page->getTotalArticle();  ?></span>Home</a>
        </li>
        <li>
            <a href="/sheridan/picture"><span class="badge pull-right"><?php echo $page->getTotalPicture();  ?></span>Picture</a>
        </li>
        <li>
            <a href="/sheridan/java"><span class="badge pull-right"><?php echo $page->getTotalJava(); ?></span>Java</a>
        </li>
        <li>
            <a href="/sheridan/web"><span class="badge pull-right"><?php echo $page->getTotalWeb(); ?></span>Web
                Development</a>
        </li>
        <li>
            <a href="/sheridan/assembly"><span class="badge pull-right"><?php echo $page->getTotalAssembly(); ?></span>Assembly</a>
        </li>
        <li>
            <a href="/sheridan/other"><span class="badge pull-right"><?php echo $page->getTotalOther(); ?></span>Other</a>
        </li>
        <li>
            <a href="/sheridan/c"><span class="badge pull-right"><?php echo $page->getTotalC(); ?></span>C</a>
        </li>
        <hr>
        <li>
            <a href="/sheridan/getRequest"><span class="badge pull-right"><?php echo $page->getRequest(); ?></span>See all
                Request</a>
        </li>
        <?php if ($auth->getConnected()) { ?>
            <li>
                <a href="/sheridan/request"><span class="badge pull-right"></span>Request an Example</a>
            </li>
        <?php } ?>
        <hr>
        <? if ($auth->getRole() == 0) { ?>
            <li>
                <a href="/sheridan/getCode"><span class="badge pull-right"><?php echo $page->getCode();  ?></span>Article
                    Waiting for Approval</a>
            </li>
        <?php } ?>
        <?php if ($auth->getConnected() && $auth->getRole() < 8){ ?>
            <li>
                <a href="/sheridan/submit"><span class="badge pull-right"></span>Create an Article</a>
            </li>
            <hr>
            <? if ($auth->getRole() == 0) { ?>
                <li>
                    <a href="/sheridan/picture/approval"><span class="badge pull-right"><?php echo $page->getPictureApproval(); ?></span>Picture Waiting for Approval</a>
                </li>
                <hr>
            <?php } ?>
        <?php } ?>
        <li style="text-align: center">
            <form action="http://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                <input type="hidden" name="cmd" value="_s-xclick">
                <input type="hidden" name="hosted_button_id" value="9TDZHYB7UCDJW">
                <input type="image" src="http://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif"
                       border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                <img alt="" border="0" src="http://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1"
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
                <h4 class="modal-title" id="myModalLabel" style="text-align: center">Log in / Register To <?php echo $page->getSiteName(); ?></h4>
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
                <h4 class="modal-title" id="myModalLabel" style="text-align: center">Log in / Register To <?php echo $page->getSiteName(); ?></h4>
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
<?php if ($auth->getConnected()) { ?>
    <!-- Modal Upload Image -->
    <div class="modal fade" id="myPicture" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center">Upload a Picture to <?php echo $page->getSiteName(); ?></h4>
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
        <a href="http://www.facebook.com/groups/SheridanCodingJM/" class="alert-info" target="_blank">Are
            you taking a computer class at Sheridan? Join our group now by clicking here!</a>
    </div>

    <div class="alert alert-danger" role="alert">
        <strong>We are not responsible for any kind of plagiarism. This website have been created for learning purpose only.</strong>
    </div>
    <hr>




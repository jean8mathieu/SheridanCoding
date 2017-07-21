<?php
/**
 * Created by PhpStorm.
 * User: Jean-Mathieu
 * Date: 9/1/14
 * Time: 1:56 AM
 */



session_start();

error_reporting(0);

//Page in class

//Authentication System
require("script/auth.php");
$auth = new auth();

require("script/article.php");

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
$my_file = '/hermes/bosnaweb05a/b1615/ipg.jmdev/jmdev/sheridan/script/website.txt';
$handle = fopen($my_file, 'r');
$data = fread($handle,filesize($my_file));
if($data == "false"){
    $website = false;
}else{
    $website = true;
}

$message = '<div style="text-align: center"><h1 style="color: red">The website have been disabled. It should come back shortly.</h1>
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
    <script src="/sheridan/js/jquery/jquery.min.js"></script>
    <script src="/sheridan/js/jquery/jquery.widget.min.js"></script>
    <script src="/sheridan/js/metro/metro.min.js"></script>

    <!--<script src="/sheridan/picture/upload/js/jquery-1.8.0.min.js"></script>-->
    <!--<script src="/sheridan/js/bootstrap.js"></script>-->

    <link rel="stylesheet" href="/sheridan/css/metro-bootstrap.css">
    <link href="/sheridan/css/metro-bootstrap-responsive.css" rel="stylesheet">

    <link rel="stylesheet" href="/sheridan/css/iconFont.css">
    <link href="/sheridan/css/prettify.css" rel="stylesheet">



    <!--<script src="/sheridan/js/snowstorm.js"></script>
    <script>snowStorm.excludeMobile = false;
        snowStorm.flakesMaxActive = 96;
    </script>-->


    <!-- bonus christmas light stuff, not required for snowstorm -->
    <!--<script src="/sheridan/lights/soundmanager2-nodebug-jsmin.js"></script>
    <script src="/sheridan/lights/animation-min.js"></script>
    <script src="/sheridan/lights/christmaslights.js"></script>
    <script type="text/javascript">
        var urlBase = './';
        soundManager.url = './';
    </script>-->

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
            $article = new article($rows[0],$rows['title'],$rows['author'],$rows['description'],$rows['code'],$rows['section'],$rows['updatedBy'],$rows['username'],$rows['dateUpdated'],$rows['dateCreated'],$rows['attachment'],$rows['tags'],$rows['picture'],$rows['biblio']);
            ?>
            <meta property="og:title" content="<?php echo $page->getSiteName() . " - " . $article->getArticleTitle() . ' in ' . $article->getArticleCategoryDisplay() ?>">
            <meta property="og:description" content="<?php echo $article->getArticleDescriptionNoHTML() ?>">
            <title><?php echo $page->getSiteName() . " - " . $article->getArticleTitle() . " in " . $article->getArticleCategoryDisplay() ?></title>
        <?php } ?>
        <title><?php echo $page->getSiteName(); ?> - Computer Group</title>
    <?php } if($title == false){?>
        <title><?php echo $page->getSiteName(); ?> - Computer Group</title>
    <?php }


    if(strpos($domain,$page->getSiteAddress() .'picture')!== false){
        if(@$_GET['id'] > 0){?>
            <meta property="og:title" content="<?php echo $page->getSiteName(); ?> - Picture #<?php echo(@$_GET['id']); ?>">
            <meta property="og:image" content="<?php echo $page->getImageURL(@$_GET['id']); ?>">
            <meta property="og:description" content="We have tons of funny picture! Come check them!">
        <?php }else{ ?>
            <meta property="og:title" content="<?php echo $page->getSiteName(); ?> - Pictures">
            <meta property="og:description" content="We have tons of funny picture! Come check them!">
        <?php }}else{ ?>
        <meta property="og:image" content="<?php echo $page->getSiteAddress(); ?>img/sheridan1.png">
    <?php } ?>
    <link href="/sheridan/css/search.css" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="/sheridan/css/bootstrap.min.css" rel="stylesheet">
    <link href="/sheridan/css/simple-sidebar.css" rel="stylesheet">
    <link href="/sheridan/css/image.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/sheridan/css/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/highlight.js/8.2/styles/default.min.css">
    <!--<script src="http://cdnjs.cloudflare.com/ajax/libs/highlight.js/8.2/highlight.min.js"></script>-->

    <link rel="stylesheet" href="/sheridan/css/default.css">
    <script src="/sheridan/js/highlight.pack.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]>
    <script src="/sheridan/js/ie8-responsive-file-warning.js"></script>
    <![endif]-->
    <script src="/sheridan/js/ie-emulation-modes-warning.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/sheridan/js/ie10-viewport-bug-workaround.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="http://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">
        ${demo.css}
    </style>

</head>

<body>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=570294056368460&version=v2.0";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

    <script type="text/javascript">
        $(function(){
            $(".search").keyup(function()
            {
                var searchid = $(this).val();
                var dataString = 'search='+ searchid;
                if(searchid!='')
                {
                    $.ajax({
                        type: "GET",
                        url: "/sheridan/search/index.php",
                        data: dataString,
                        cache: false,
                        success: function(html)
                        {
                            $("#result").html(html).show();
                        }

                    });
                }//return false;

                if($(this).val()==""){
                    $("#result").hide();
                }
            });

            jQuery("#result").live("click",function(e){
                var $clicked = $(e.target);
                var $name = $clicked.find('.name').html();
                var decoded = $("<div/>").html($name).text();
                $('#searchid').val(decoded);
            });
            jQuery(document).live("click", function(e) {
                var $clicked = $(e.target);
                if (! $clicked.hasClass("search")){
                    jQuery("#result").fadeOut();
                }
            });
            $('#searchid').click(function(){
                jQuery("#result").fadeIn();
            });
        });
    </script>
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
            <a class="navbar-brand" href="/sheridan"><?php echo $page->getSiteName(); ?></a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <!--<form class="navbar-form navbar-left" role="search" action="/sheridan/script/search.php" method="get">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search" name="search" <?php if (@isset($_GET['search'])){ echo 'value="' . @$_GET['search'] . '"';} ?>>
                    </div>
                </form>-->

                <!--<li><a href="#">Profile</a></li>-->
                <?php if(!$detect->isMobile()){ ?>
                <li>
                    <div class="content" style="padding-top: 4px">
                        <input type="text" class="search" id="searchid" placeholder="Search"/>
                        <div id="result"></div>
                    </div>
                </li>
                <?php } if ($auth->getConnected()) { ?>
                    <li><a href="/sheridan/picture/upload"><span class="glyphicon glyphicon-picture" title="Upload an Image"></span></a></li>
                    <li><a href="/sheridan/submit"><span class="glyphicon glyphicon-edit" title="Create an Article"></span></a> </li>
                    <?php } ?>
                <?php if ($detect->isMobile()) { ?>
                    <li><a href="/sheridan/app/java">Java</a></li>
                    <li><a href="/sheridan/web">Web Development</a></li>
                    <li><a href="/sheridan/app/assembly">Assembly</a></li>
                    <li><a href="/sheridan/math">Math</a></li>
                    <li><a href="/sheridan/news">News</a></li>
                    <li><a href="/sheridan/other">Other</a></li>
                    <li><a href="/sheridan/app/c">C</a></li>
                    <li><a href="/sheridan/picture">Picture</a></li>
                <?php } ?>
                <?php if ($auth->getConnected()) { ?>
                    <li><a href="/sheridan/logout"><span class="glyphicon glyphicon-log-out" title="Log out"></span></a></li>
                <?php } else { ?>
                    <li><a href="/sheridan/login"><span class="glyphicon glyphicon-log-in" title="Log in"></span></a></li>
                <?php } ?>

            </ul>
        </div>
    </div>
</div>

<div class="container-fluid">
<div id="wrapper">
<div class="row">
<!-- Sidebar -->

    <div class="metro" >
        <nav class="sidebar">
            <ul><?php if($auth->getConnected()){ ?>
                <li><a class="dropdown-toggle" href="#">Welcome <?php echo $auth->getUsername(); ?>!</a>
                    <ul class="dropdown-menu" data-role="dropdown">
                        <li><a href="">Profile Settings</a></li>
                        <li><a href="">Change Password</a></li>
                        <?php if($auth->getRole() <= 2){ ?>
                        <li><a href="">Tracking Log</a></li>
                        <?php } ?>
                    </ul>
                </li>
                <?php } ?>

                <li><a href="/sheridan">Home</a></li>
                <li><a href="/sheridan/news">News</a></li>

                <li><a href="/sheridan/memberlist">Members List</a></li>

                <li>
                    <a class="dropdown-toggle" href="#">Application Development</a>
                    <ul class="dropdown-menu" data-role="dropdown">
                        <li><a href="/sheridan/app/assembly">Assembly</a></li>
                        <li><a href="/sheridan/app/c">C,C#,C++</a></li>
                        <li><a href="/sheridan/app/java">Java</a></li>
                        <li class="divider"></li>
                        <li><a href="/sheridan/app/linux">Linux</a></li>
                    </ul>
                </li>

                <li>
                    <a class="dropdown-toggle" href="#">Web Development</a>
                    <ul class="dropdown-menu" data-role="dropdown">
                        <li><a href="/sheridan/web/html">HTML/CSS</a></li>
                        <li><a href="/sheridan/web/js">Javascript</a></li>
                        <li><a href="/sheridan/web/php">PHP/MySQL</a></li>
                    </ul>
                </li>

                <li>
                    <a class="dropdown-toggle" href="#">Math</a>
                    <ul class="dropdown-menu" data-role="dropdown">
                        <li><a href="/sheridan/math/calculus">Calculus</a></li>
                        <li><a href="/sheridan/math/discrete">Discrete Math</a></li>
                        <li><a href="/sheridan/math/statistic">Statistic</a></li>
                        <li class="divider"></li>
                        <li><a href="">R</a></li>
                    </ul>
                </li>
                <?php if($auth->getConnected()){ ?>
                <li>
                    <a class="dropdown-toggle" href="#">Article</a>
                    <ul class="dropdown-menu" data-role="dropdown">

                        <li><a href="/sheridan/submit">Create An Article</a></li>
                        <?php if($auth->getRole() <=2){ ?>
                        <li><a href="/sheridan/getCode">Article Approval</a></li>
                        <?php } ?>
                    </ul>
                </li>
                <?php } ?>

                <li>
                    <a class="dropdown-toggle" href="#">Picture</a>
                    <ul class="dropdown-menu" data-role="dropdown">
                        <li><a href="/sheridan/picture">View Picture</a></li>
                        <?php if($auth->getConnected()){ ?>
                        <li><a href="">Upload A Picture</a></li>
                        <?php if($auth->getRole() <=2){ ?>
                        <li><a href="/sheridan/picture/approval">Picture Approval</a></li>
                        <?php }} ?>
                    </ul>
                </li>

                <li>
                    <div style="padding-left: 5px">
                    <div class="fb-like-box" data-href="http://www.facebook.com/pages/Sheridan-Coding/390554731127098" data-width="275" data-colorscheme="dark" data-show-faces="true" data-header="true" data-stream="false" data-show-border="false"></div>
                    </div>
                </li>

                <li style="text-align: center">
                    <div style="padding-top: 10px">
                    <form action="http://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                        <input type="hidden" name="cmd" value="_s-xclick">
                        <input type="hidden" name="hosted_button_id" value="9TDZHYB7UCDJW">
                        <input type="image" src="http://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif"
                               border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                        <img alt="" border="0" src="http://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1"
                             height="1">
                    </form>
                    </div>
                </li>
            </ul>
        </nav>
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
            <form class="form-signin" role="form" action="/sheridan/script/register.php" method="post">
                <div class="modal-body">
                    <h2 class="form-signin-heading">Please register</h2>

                    <input type="text" class="form-control" placeholder="Username" name="username" required autofocus >
                    <br>
                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                    <br>
                    <input type="password" class="form-control" placeholder="Confirm Password" name="password2" required>
                    <br>
                    <p id="validate-status"></p>
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
                    <button type="submit" class="btn btn-primary">Confirm Register</button></a>
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
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" style="margin-left: 4px;width: 99%">

    <div class="alert alert-warning" role="alert">
        <a href="mailto:jean-mathieu.emond@jmdev.ca" class="alert-link">Please report any bug that you see
            by
            clicking here or emailing jean-mathieu.emond@jmdev.ca</a>
    </div>

    <div class="alert alert-info" role="alert">
        <a href="http://www.facebook.com/groups/1472824716299460/" class="alert-info" target="_blank">Are
            you taking a computer class at Sheridan? Join our group now by clicking here!</a>
    </div>

    <div class="alert alert-danger" role="alert">
        <strong>We are not responsible for any kind of plagiarism. This website have been created for learning purpose only.</strong>
    </div>
    <hr>

    <?php
    require ("weather/api/weather.php");
    $weather = new \api\weather();
    ?>
    <marquee><?php echo "WEATHER NEWS: " . $weather->getOakvilleDescription()  . " | " . $weather->getBramptonDescription()?></marquee>
    <hr>
    <?php
    if($detect->isMobile()){ ?>

    <?php }else{ ?>
        <center>
            <iframe src="http://rcm-na.amazon-adsystem.com/e/cm?t=j015d-20&o=1&p=48&l=ur1&category=amazon_student&banner=0ESXEJBAB9P423EBDR82&f=ifr&linkID=SAG2K72ML7JJR2XZ" width="728" height="90" scrolling="no" border="0" marginwidth="0" style="border:none;" frameborder="0"></iframe>
        </center>
    <?php }

    ?>

    <hr>

<?php if($data == "false" && $auth->getRole() > 2){
    echo $message;
    include("bottom.php");
    exit;
}
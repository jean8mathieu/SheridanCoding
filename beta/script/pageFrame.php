<?php

/**
 * Created by PhpStorm.
 * User: Jean-Mathieu
 * Date: 12/6/14
 * Time: 7:27 PM
 */
class pageFrame
{

    function settings()
    {
        if( $this->setSiteName("Sheridan Coding")){
            if($this->setSiteAddress("http://www.jmdev.ca/sheridan/")){
                return true;
            }else{
                return false;
            }
        }
        require("auth.php");
        $auth = new auth();
        $auth->clientBanned();
    }

    function getSiteAddress(){
        session_start();
        return $_SESSION['siteAddress'];
    }

    function setSiteAddress($site){
        session_start();
        if(!empty($site)){
            $_SESSION['siteAddress'] = $site;
            return true;
        }else{
            return false;
        }
    }

    function getSiteName(){
        session_start();
        return $_SESSION['siteName'];
    }

    function setSiteName($siteName){
        session_start();
        if(!empty($siteName)){
            $_SESSION['siteName'] = $siteName;
            return true;
        }else{
            return false;
        }
    }

    function getTotalArticle()
    {
        require("connection.php");
        mysql_connect("$host", "$username", "$password") or die("cannot connect");
        mysql_select_db("$db_name") or die("cannot select DB");
        $sql = "SELECT * FROM article WHERE approved='1'";
        $result = mysql_query($sql);
        $cnt = mysql_num_rows($result);
        mysql_close();
        return $cnt;
    }

    function getTotalWeb()
    {
        require("connection.php");
        mysql_connect("$host", "$username", "$password") or die("cannot connect");
        mysql_select_db("$db_name") or die("cannot select DB");
        $sql = "SELECT * FROM article WHERE approved='1' AND (section='html' OR section='js' OR section='php')";
        $result = mysql_query($sql);
        $cnt = mysql_num_rows($result);
        mysql_close();
        return $cnt;
    }

    function getTotalJava()
    {
        require("connection.php");
        mysql_connect("$host", "$username", "$password") or die("cannot connect");
        mysql_select_db("$db_name") or die("cannot select DB");
        $sql = "SELECT * FROM article WHERE approved='1' AND section='java'";
        $result = mysql_query($sql);
        $cnt = mysql_num_rows($result);
        mysql_close();
        return $cnt;
    }

    function getTotalAssembly()
    {
        require("connection.php");
        mysql_connect("$host", "$username", "$password") or die("cannot connect");
        mysql_select_db("$db_name") or die("cannot select DB");
        $sql = "SELECT * FROM article WHERE approved='1' AND section='avrasm'";
        $result = mysql_query($sql);
        $cnt = mysql_num_rows($result);
        mysql_close();
        return $cnt;
    }

    function getTotalC()
    {
        require("connection.php");
        mysql_connect("$host", "$username", "$password") or die("cannot connect");
        mysql_select_db("$db_name") or die("cannot select DB");
        $sql = "SELECT * FROM article WHERE approved='1' AND section='objectivec'";
        $result = mysql_query($sql);
        $cnt = mysql_num_rows($result);
        mysql_close();
        return $cnt;
    }

    function getTotalPicture()
    {
        require("connection.php");
        mysql_connect("$host", "$username", "$password") or die("cannot connect");
        mysql_select_db("$db_name") or die("cannot select DB");
        $sql = "SELECT * FROM album WHERE allow='1'";
        $result = mysql_query($sql);
        $cnt = mysql_num_rows($result);
        mysql_close();
        return $cnt;
    }

    function getTotalOther(){
        require("connection.php");
        mysql_connect("$host", "$username", "$password") or die("cannot connect");
        mysql_select_db("$db_name") or die("cannot select DB");
        $sql = "SELECT * FROM article WHERE approved='1' AND section='text'";
        $result = mysql_query($sql);
        $cnt = mysql_num_rows($result);
        mysql_close();
        return $cnt;
    }

    function getRequest()
    {
        require("connection.php");
        mysql_connect("$host", "$username", "$password") or die("cannot connect");
        mysql_select_db("$db_name") or die("cannot select DB");
        $sql = "SELECT * FROM request WHERE approved='0'";
        $result = mysql_query($sql);
        $cnt = mysql_num_rows($result);
        mysql_close();
        return $cnt;
    }

    function getCode()
    {
        require("connection.php");
        mysql_connect("$host", "$username", "$password") or die("cannot connect");
        mysql_select_db("$db_name") or die("cannot select DB");
        $sql = "SELECT * FROM article WHERE approved='0'";
        $result = mysql_query($sql);
        $cnt = mysql_num_rows($result);
        mysql_close();
        return $cnt;
    }

    function getPictureApproval()
    {
        require("connection.php");
        mysql_connect("$host", "$username", "$password") or die("cannot connect");
        mysql_select_db("$db_name") or die("cannot select DB");
        $sql = "SELECT * FROM album WHERE allow='0'";
        $result = mysql_query($sql);
        $cnt = mysql_num_rows($result);
        mysql_close();
        return $cnt;
    }

    function getImageURL(){
        include("connection.php");
        mysql_connect("$host", "$username", "$password") or die("Cannot connect. Contact the admin!");
        mysql_select_db("$db_name") or die("cannot select DB. Contact the admin!");
        $sql = "SELECT * FROM album WHERE albumId='$id'";
        $result = mysql_query($sql);
        $rows = mysql_fetch_array($result);
        return $this->getSiteAddress() . "picture/img/" . $rows[2];
    }

    function getAdsComputer(){
        return '
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
            ';
    }

    function getAdsMobile(){
        return '<center>
                    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                        <!-- JMDevSheridanMobile -->
                        <ins class="adsbygoogle"
                             style="display:inline-block;width:320px;height:100px"
                             data-ad-client="ca-pub-5923775871016604"
                             data-ad-slot="7343679164"></ins>
                        <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </center>';
    }

    function getCurrentAddress(){
        $pageURL = 'http';
        if ($_SERVER["http"] == "on") {$pageURL .= "s";}
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }
        return $pageURL;
    }

} 
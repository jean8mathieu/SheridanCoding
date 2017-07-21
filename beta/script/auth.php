<?php
/**
 * Created by PhpStorm.
 * User: Jean-Mathieu
 * Date: 12/6/14
 * Time: 8:12 PM
 */

class auth {

    public $username,$role;

    function setUsername($user){
       session_start();
        $_SESSION['username'] = $user;
        if(!empty($_SESSION['username'])){
            return true;
        }else{
            return false;
        }
    }

    function setUsernameID($id){
        session_start();
        $_SESSION['userId'] = $id;
        if(!empty($_SESSION['userId'])){
            return true;
        }else{
            return false;
        }
    }

    function setRole($role){
        session_start();
        $_SESSION['role'] = $role;
        if(!empty($_SESSION['role'])){
            return true;
        }else{
            return false;
        }
    }

    function getUsername(){
        session_start();
        return $_SESSION['username'];
    }

    function getUsernameID(){
        session_start();
        if(empty($_SESSION['userId'])){
            return 0;
        }else{
            return $_SESSION['userId'];
        }
    }

    function getRole(){
        session_start();
        if(empty($_SESSION['role'])){
            return 10;
        }else{
            return $_SESSION['role'];
        }
    }

    function getConnected(){
        session_start();
        return $_SESSION['connected'];
    }

    function setConnected($login){
        session_start();
        if($login == true){
            $_SESSION['connected'] = true;
            return true;
        }elseif ($login == false){
            $_SESSION['connected'] = false;
            return true;
        }else{
            return false;
        }

    }

    function checkAccount($user,$pass){
        require("../connection.php");
        mysql_connect("$host", "$username", "$password") or die("cannot connect");
        mysql_select_db("$db_name") or die("cannot select DB");
        $sql = "SELECT * FROM account WHERE username='$user' AND password='$pass'";
        $result = mysql_query($sql);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    function getArticleProfileId($id){
        include("../connection.php");
        mysql_connect("$host", "$username", "$password") or die("Cannot connect. Contact the admin!");
        mysql_select_db("$db_name") or die("cannot select DB. Contact the admin!");
        $sql = "SELECT * FROM article WHERE id='$id'";
        $result = mysql_query($sql);
        $rows = mysql_fetch_array($result);
        //Return userId
        if(is_numeric($rows['author'])){
            return $rows['author'];
        }else{
            return 0;
        }
    }

    function getPictureProfileId($id){
        include("../connection.php");
        mysql_connect("$host", "$username", "$password") or die("Cannot connect. Contact the admin!");
        mysql_select_db("$db_name") or die("cannot select DB. Contact the admin!");
        $sql = "SELECT * FROM album WHERE albumId='$id'";
        $result = mysql_query($sql);
        $rows = mysql_fetch_array($result);
        //Return userId
        if(is_numeric($rows[1])){
            return $rows[1];
        }else{
            return 0;
        }
    }

    function clientBanned(){
        include("connection.php");
        mysql_connect("$host", "$username", "$password") or die("Cannot connect. Contact the admin!");
        mysql_select_db("$db_name") or die("cannot select DB. Contact the admin!");
        $ip = $this->getIP();
        $sql = "SELECT * FROM banned WHERE ip='$ip'";
        $result = mysql_query($sql);
        $rows = mysql_fetch_array($result);
        $count = mysql_num_rows($result);
        if($count >=1){
            return true;
        }else{
            return false;
        }
    }

    function getIP(){
        if (getenv('HTTP_CLIENT_IP'))
            $ip = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ip = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ip = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            $ip = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ip = getenv('REMOTE_ADDR');
        else
            $ip = 'UNKNOWN';
        return $ip;
    }
} 
<?php
/**
 * Created by PhpStorm.
 * User: Jean-Mathieu
 * Date: 12/7/14
 * Time: 6:38 PM
 */


require("script/auth.php");

$auth = new auth();


echo("IP: " . $auth->clientBanned());


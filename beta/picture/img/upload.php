<?php
/**
 * Created by PhpStorm.
 * User: Jean-Mathieu
 * Date: 5/26/14
 * Time: 11:44 PM
 */

$output_dir = "";

include("../../connection.php");
session_start();
if ($_SESSION['login']) {

    session_start();
    $userID = $_SESSION['userId'];
    $role = $_SESSION['role'];
    $errorSQL = false;
    $time = time();
    //echo "Role: " . $role;
    if ($role < 6) {
        $allow = 1;
    } else {
        $allow = 0;
    }

    if (isset($_FILES["myfile"])) {

        $ret = array();

        $error = $_FILES["myfile"]["error"];
        {

            if (!is_array($_FILES["myfile"]['name'])) //single file
            {
                $RandomNum = time();

                $ImageName = str_replace(' ', '-', strtolower($_FILES['myfile']['name']));
                $ImageType = $_FILES['myfile']['type']; //"image/png", image/jpeg etc.

                $size = $_FILES['myfile']['size'] / 100;

                $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
                $ImageExt = str_replace('.', '', $ImageExt);
                $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
                $NewImageName = $ImageName . '-' . $RandomNum . '.' . $ImageExt;
                move_uploaded_file($_FILES["myfile"]["tmp_name"], $output_dir . $NewImageName);
                $ret[$fileName] = $output_dir . $NewImageName;

                $fileName = $output_dir . $NewImageName;
                mysql_connect("$host", "$username", "$password") or die("cannot connect");
                mysql_select_db("$db_name") or die("cannot select DB");
                $sql = "INSERT INTO `album`(imageLocation,userid,imageSize,allow,uploadedDate) VALUES ('$fileName','$userID','$size','$allow','$time')";
                $result = mysql_query($sql);

                if ($result) {
                    $errorSQL = false;
                } else {
                    $errorSQL = true;
                }

            } else {
                $fileCount = count($_FILES["myfile"]['name']);
                for ($i = 0; $i < $fileCount; $i++) {
                    $RandomNum = time();
                    $ImageName = str_replace(' ', '-', strtolower($_FILES['myfile']['name'][$i]));
                    $ImageType = $_FILES['myfile']['type'][$i]; //"image/png", image/jpeg etc.
                    $size = $_FILES['myfile']['size'][$i] / 100;
                    $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
                    $ImageExt = str_replace('.', '', $ImageExt);
                    $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
                    $NewImageName = $ImageName . '-' . $RandomNum . '.' . $ImageExt;

                    $ret[$NewImageName] = $output_dir . $NewImageName;
                    move_uploaded_file($_FILES["myfile"]["tmp_name"][$i], $output_dir . $NewImageName);

                    $fileName = $output_dir . $NewImageName;
                    mysql_connect("$host", "$username", "$password") or die("cannot connect");
                    mysql_select_db("$db_name") or die("cannot select DB");
                    $sql = "INSERT INTO `album`(imageLocation,userid,imageSize,allow,uploadedDate) VALUES ('$fileName','$userID','$size','$allow','$time')";
                    $result = mysql_query($sql);

                    if ($result) {
                        $errorSQL = false;
                    } else {
                        $errorSQL = true;
                    }
                }
            }
        }
        if ($errorSQL) {
            header("location: ../upload/?Error=true");
        } else {
            require_once("../../script/tracking.php");
            $track = new tracking();
            $track->addTrack(4,0);
            header("location: ../");

        }
        //echo json_encode($ret);

    }
}
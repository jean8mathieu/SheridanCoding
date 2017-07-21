<?php
/**
 * Created by PhpStorm.
 * User: Jean-Mathieu
 * Date: 9/5/14
 * Time: 11:43 PM
 */

session_start();

$id = @$_GET['id'];
$role = $_SESSION['role'];
$login = $_SESSION['login'];
$author = @$_GET['a'];

if (!$author == md5($_SESSION['username']) && !$role == 0){
        header('Location: http://www.jmdev.ca/sheridan/');
        exit;
}
?>


<script type="text/javascript">
   var x = confirm("Do you really want to delete this article?");

    if (x === true){
        window.location.href = "http://www.jmdev.ca/sheridan/script/checkDelete.php?id=<?php echo ($id . "&a=" . $author); ?>";
    }else{
        window.location.href = "http://www.jmdev.ca/sheridan/";
    }
</script>
<?php
/**
 * Created by IntelliJ IDEA.
 * User: Jean-Mathieu
 * Date: 3/9/2015
 * Time: 11:29 AM
 */

include ("../head.php");
session_start();?>
<h3 style="text-align: center">You tried to access a page that could not be found. Please try again. Go back to the last working page: <a href="<?php echo $_SESSION['URL'] ?>"><?php echo $_SESSION['URL'] ?></a></h3>
<?php include ("../bottom.php");
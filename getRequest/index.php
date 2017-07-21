<?php
/**
 * Created by PhpStorm.
 * User: Jean-Mathieu
 * Date: 9/6/14
 * Time: 4:52 AM
 */

include("../connection.php");

mysql_connect("$host", "$username", "$password") or die("Cannot connect. Contact the admin!");
mysql_select_db("$db_name") or die("cannot select DB. Contact the admin!");

$sql = "SELECT * FROM request";
$result = mysql_query($sql);

include("../head.php"); ?>

    <div class="panel panel-default">
        <!-- Table -->
        <table class="table" >
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Section</th>
                <th>Request By</th>
                <th>Status</th>
                <!--<th>By</th>-->
                <th>Reason</th>
                <?php if($_SESSION['role'] == 0){ ?>
                <th>Option</th>
                <?php } ?>
            </tr>
            <?php while ($rows = mysql_fetch_array($result)) { ?>
            <tr>
                <td><?php echo $rows['title']; ?></td>
                <td><?php echo $rows['description']; ?></td>
                <td><?php echo $rows['section']; ?></td>
                <td><?php echo $rows['author']; ?></td>
                <td><?php  if($rows['approved'] == 0){
                        echo '<span class="label label-info">Pending</span>';
                    }elseif($rows['approved'] == 1){
                        echo '<span class="label label-success">Approved</span>';
                    }else{
                        echo '<span class="label label-danger">Declined</span>';
                    } ?></td>
                <!--<td><?php echo $rows['approvedBy']; ?></td>-->
                <td></td>
                <?php if($_SESSION['role'] == 0){ ?>
                <td>
                    <a href="/sheridan/script/requestUpdate.php?id=<?php echo $rows['id']; ?>=&status=1"><span class="glyphicon glyphicon-ok"></span></a>
                    <a href="/sheridan/script/requestUpdate.php?id=<?php echo $rows['id']; ?>=&status=2"><span class="glyphicon glyphicon-remove" style="padding-left: 5px"></span></a>
                </td>
                <?php } ?>
            </tr>
            <?php } ?>
        </table>
    </div>

<?php include("../bottom.php"); ?>
<?php
/**
 * Created by PhpStorm.
 * User: Jean-Mathieu
 * Date: 12/19/14
 * Time: 5:01 PM
 */
include("../connection.php");
require("../script/track.php");
include("../head.php");
if($auth->getRole() < 2){
    $my_file = '../script/website.txt';
    $handle = fopen($my_file, 'r');
    $data = fread($handle,filesize($my_file));
    if($data == "true"){    ?>
    <a href="../script/alive.php?action=false"><button type="button" class="btn btn-danger">Disabled Website</button></a>
    <?php }else{ ?>
        <a href="../script/alive.php?action=true"><button type="button" class="btn btn-success">Activate Website</button></a>
    <?php } ?>
    <br>
    <h1 class="text-center">Tracking Log</h1>
    <table class="table table-striped">
        <tr>
            <th style="text-align: center">#</th>
            <th style="text-align: center">Users</th>
            <th style="text-align: center">Action</th>
            <th style="text-align: center">Action ID</th>
            <th style="text-align: center">Time / Date</th>
            <th style="text-align: center">IP</th>
            <th style="text-align: center">Ban</th>
        </tr>
        <?php
        mysql_connect("$host", "$username", "$password") or die("Cannot connect. Contact the admin!");
        mysql_select_db("$db_name") or die("cannot select DB. Contact the admin!");
        $sql = "SELECT * FROM `tracking` ORDER BY trackId DESC";
        $result = mysql_query($sql);
        while ($rows = mysql_fetch_array($result)) {
            $track = new track($rows[0],$rows[1],$rows[2],$rows[3],$rows[4],$rows[5]);
            ?>
        <tr style="text-align: center">
            <td><?php echo $track->getTrackId(); ?></td>
            <td><?php echo $track->getUsername(); ?></td>
            <td><?php echo $track->getAction(); ?></td>
            <td><?php echo $track->getActionId(); ?></td>
            <td><?php echo $track->getDateTime(); ?></td>
            <td><?php echo $track->getIp(); ?></td>
            <td>
                <?php if($track->accountBanned()){ ?>
                    <a href="../script/banUser.php?ip=<?php echo $track->getIp() ?>&action=unban"><button type="button" class="btn btn-danger  btn-xs">Unban</button></a>
                <?php }else{ ?>
                    <a href="../script/banUser.php?ip=<?php echo $track->getIp() ?>&action=ban"><button type="button" class="btn btn-danger  btn-xs">Ban</button></a>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>

    </table>
<?php
}else{
    header("Location: ../");
}
    include("../bottom.php");

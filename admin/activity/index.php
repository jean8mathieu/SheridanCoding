<?php
/**
 * Created by PhpStorm.
 * User: Jean-Mathieu
 * Date: 12/19/14
 * Time: 5:01 PM
 */
include("../../connection.php");
//require("../../script/activity.php");
include("../../head.php");
require_once("../../script/mypagin.php");


if (!@isset($_GET['p'])) {
    $page = 1;
} else {
    $page = @$_GET['p'];
}
//http://freegeoip.net/json/162.243.192.244
if($auth->getRole() < 2){

    mysql_connect("$host", "$username", "$password") or die("Cannot connect. Contact the admin!");
    mysql_select_db("$db_name") or die("cannot select DB. Contact the admin!");
    $page = mysql_real_escape_string($page);
    $pageTotal = $page * 200;

    $sqlByIP = "SELECT idActivity,ipActivity,count(*) FROM Activity GROUP BY ipActivity ORDER BY count(*) DESC LIMIT 50";
    $resultByIP = mysql_query($sqlByIP);

    $sqlCount = "SELECT * FROM Activity";
    $resultCount = mysql_query($sqlCount);
    $cnt = mysql_num_rows($resultCount);

    $numberPage = ($cnt / 5);
    $page = mysql_real_escape_string($page);
    $sql = "SELECT * FROM `Activity` ORDER BY idActivity DESC LIMIT " . ($pageTotal - 200) . ", " . (200);
    $result = mysql_query($sql);
    ?>
    <h1 class="text-center">IP Log</h1>
    <table class="table table-striped">
        <tr>
            <th style="text-align: center">IP</th>
            <th style="text-align: center">Hits</th>
            <th style="text-align: center">Ban</th>
        </tr>
        <?php
        while ($rows = mysql_fetch_array($resultByIP)) {
            $activity = new activity();
            $activity->activityCountConstructor($rows[0],$rows[1],$rows[2]);
        ?>
        <tr>
            <td style="text-align: center"><?php echo $activity->getActivityIP() ?></td>
            <td style="text-align: center"><?php echo $activity->getActivityCount() ?></td>
            <td style="text-align: center">
                <?php if($activity->accountBanned()){ ?>
                    <a href="../../script/banUser.php?ip=<?php echo $activity->getActivityIP() ?>&action=unban"><button type="button" class="btn btn-success  btn-xs">Unban</button></a>
                <?php }else{ ?>
                    <a href="../../script/banUser.php?ip=<?php echo $activity->getActivityIP() ?>&action=ban"><button type="button" class="btn btn-danger  btn-xs">Ban</button></a>
                <?php } ?>
            </td>
        </tr>
            <?php } ?>
    </table>


    <h1 class="text-center">Activity Log</h1>
    <?php $pagin = new simplepagin();


    $pagin->total_records = $cnt;
    $pagin->noperpage = 5;
    //this would give example.php?page=1 url type
    $pagin->url = 'http://www.jmdev.ca/sheridan/admin/activity/';
    $pagin->val = 'p';

    if ($detect->isMobile()) {
        $pagin->size = 'sm';
    } else {
        $pagin->size = 'lg';
    }

    //call the pagin function
    ?>
    <center>
        <?php $pagin->pagin(); ?>
    </center>

    <table class="table table-striped">
        <tr>
            <th style="text-align: center">#</th>
            <th style="text-align: center">URL</th>
            <th style="text-align: center">Session ID</th>
            <th style="text-align: center">IP</th>
            <th style="text-align: center">Time / Date</th>
            <th style="text-align: center">Ban</th>
        </tr>
        <?php


        //$sql = "SELECT * FROM `Activity` ORDER BY idActivity DESC LIMIT " . ($pageTotal - 5) . ", " . (200);

        while ($rows = mysql_fetch_array($result)) {
            $activity = new activity();
            $activity->activityConstructor($rows[0],$rows[1],$rows[2],$rows[3],$rows[4]);
            ?>
        <tr style="text-align: center">
            <td><?php echo $activity->getActivityId(); ?></td>
            <td><?php echo $activity->getActivityURL() ?></td>
            <td><?php echo $activity->getActivitySession() ?></td>
            <td><?php echo $activity->getActivityIP() ?></td>
            <td><?php echo $activity->getActivityTime() ?></td>
            <td>
                <?php if($activity->accountBanned()){ ?>
                    <a href="../../script/banUser.php?ip=<?php echo $activity->getActivityIP() ?>&action=unban"><button type="button" class="btn btn-success  btn-xs">Unban</button></a>
                <?php }else{ ?>
                    <a href="../../script/banUser.php?ip=<?php echo $activity->getActivityIP() ?>&action=ban"><button type="button" class="btn btn-danger  btn-xs">Ban</button></a>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>

    </table>
    <center>
        <?php $pagin->pagin(); ?>
    </center>
<?php
}else{
    header("Location: ../../");
}
    include("../../bottom.php");

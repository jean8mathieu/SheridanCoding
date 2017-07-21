<?php
/**
 * Created by PhpStorm.
 * User: Jean-Mathieu
 * Date: 9/7/14
 * Time: 4:48 PM
 */

include("../head.php"); ?>

    <form role="form" action="../script/changePassword.php" method="post">
        <div class="form-group">
            <label for="password1">Password</label>
            <input type="password" class="form-control" id="password1" placeholder="Old Password" name="old" required>
        </div>
        <div class="form-group">
            <label for="password2">New Password</label>
            <input type="password" class="form-control" id="password2" placeholder="Password" name="password" required>
        </div>
        <div class="form-group">
            <label for="password3">Repeat New Password</label>
            <input type="password" class="form-control" id="password3" placeholder="Repeat Password" name="confirm" required>

            <div id="validate-status"></div>
        </div>

        <button type="submit" class="btn btn-default" style="width: 100%">Change Password</button>
    </form>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#password3").keyup(validate);
        });


        function validate() {
            var password2 = $("#password2").val();
            var password3 = $("#password3").val();

            if(password2 == password3) {
                $("#validate-status").html ('<p style="color: #008000">Correct<p>');
            }
            else {
                $("#validate-status").html ('<p style="color: red">Password doesn\'t match</p>');
            }

        }

    </script>
<?php include("../bottom.php"); ?>
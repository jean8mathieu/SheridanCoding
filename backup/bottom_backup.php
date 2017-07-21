<?php
/**
 * Created by PhpStorm.
 * User: Jean-Mathieu
 * Date: 9/6/14
 * Time: 10:09 PM
 */
?>
<hr>
<?php
if($detect->isMobile()){ ?>

<?php }else{ ?>
    <center>
        <iframe src="http://rcm-na.amazon-adsystem.com/e/cm?t=j015d-20&o=1&p=48&l=ur1&category=amazon_student&banner=0ESXEJBAB9P423EBDR82&f=ifr&linkID=SAG2K72ML7JJR2XZ" width="728" height="90" scrolling="no" border="0" marginwidth="0" style="border:none;" frameborder="0"></iframe>
    </center>
<?php }

?>
<hr>
                    <p style="text-align: center"><a href="/sheridan/terms">Terms & Conditions</a> | This website isn't affiliate with <a href="http://www.sheridancollege.ca/" target="_blank">Sheridan College</a> | <a href="mailto:jean-mathieu.emond@jmdev.ca">Contact us</a> | <a href="/">JMDev</a> © 2014</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="/sheridan/js/bootstrap.min.js"></script>-->
        <!-- Menu Toggle Script -->
        <script>
            $("#menu-toggle").click(function(e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });
        </script>
    <?php if(@$_GET['login'] == "Error"){ ?>
        <script>alert("Make sure your account is activated and you are using the correct login information!");</script>
    <?php } ?>
    <?php if(@$_GET['login'] == "bad"){ ?>
        <script>alert("Bad login information or you need to activate your account. Please try again.");</script>
    <?php } ?>
    <?php if(@$_GET['do'] == "error"){ ?>
        <script>alert("We could not update or make changes. Please try again.");</script>
    <?php } ?>
    <?php if(@$_GET['do'] == "successful"){ ?>
        <script>alert("Information Updated / Added!");</script>
    <?php } ?>


        <script type="text/javascript">
            $(document).ready(function() {
                $("#password2").keyup(validate);
            });


            function validate() {
                var password1 = $("#password").val();
                var password2 = $("#password2").val();

                if(password1 == password2) {
                    $("#validate-status").html ('<p style="color: #008000">Correct<p>');
                }
                else {
                    $("#validate-status").html ('<p style="color: red">Password doesn\'t match</p>');
                }

            }

        </script>
    </body>
</html>


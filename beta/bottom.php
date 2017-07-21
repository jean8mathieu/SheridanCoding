<?php
/**
 * Created by PhpStorm.
 * User: Jean-Mathieu
 * Date: 9/6/14
 * Time: 10:09 PM
 */
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
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="/sheridan/js/bootstrap.min.js"></script>
        <!-- Menu Toggle Script -->
        <script>
            $("#menu-toggle").click(function(e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });
        </script>
    </body>
</html>
    <?php if(@$_GET['login'] == "bad"){ ?>
        <script>alert("Bad login information or you need to activate your account. Please try again.");</script>
    <?php } ?>

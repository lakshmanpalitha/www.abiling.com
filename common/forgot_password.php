<?php
include("../include/include.php");
if ($read->get("login", "POST")) {
    $pr->login();
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]--><head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
 <?php include ("../include/header_css.php"); ?>
        
        <link rel="stylesheet" type="text/css" href="../css/login.css">
       
        <?php include ("../include/header_js.php"); ?>
    </head>
    <body>
       

        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <div id="main-header-wrapper">
            <?php include ("../include/site_header.php"); ?>
        </div>

        <div id="main-containt-wrapper">
            <div id="main-containt">
                <div class="page-title">
                    <div class="views float-l"><p>User Login</p></div>
                </div>
                
                <div id="messages">
				<?php
					$ob = $er->displayerror();
			
					if (($ob->error_code == 0 || $ob->error_code == 1) && $ob->error) {
						echo ($ob->error_code == 1 ? "<div class='mws-form-message error'>
											
											<ul>
												<li>" . $ob->error . "</li>
											   
											</ul>
										</div>" : "<div class='mws-form-message success'>
											
											<ol>
												<li>" . $ob->error . "</li>
											   
											</ol>
										</div>");
					}
					$fromValue = $er->getFromValue();
                ?>
               </div> 
                <div id="left-col">
                    <div class="containt-block">

                        <form method="post" action="login.php" id="login_form" >
                            <div class="containt">
                                <div class="input-block">
                                    <label>Your E-mail*:</label>
                                    <input  class="validate[required[mail]]" name="fields_req" type="text">
                                </div>
                                <div class="submit-block">
                                    <input class="green fpass" name="login" type="submit" value="Recover a Forgotten Ppassword / User name">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div id="main-footer-wrapper">
            <div id="main-footer">
                <div class="copyright float-l"><p>&copy; 2008-2013 Panora Advertising Pvt ltd. All rights reserved.</p></div>


                <div class="c-cards float-r">
                    <a href="#"><img src="../images/visa-icon.jpg" width="42" height="25"></a>
                    <a href="#"><img src="../images/master-icon.jpg" width="40" height="24"></a>
                    <a href="#"><img src="../images/paypal-icon.jpg" width="67" height="24"></a>
                </div>

                <div class="footer-menu float-r">
                    <a href="#">Terms of Services </a>
                    <a href="#">Privacy Policy </a>
                    <a href="#">Help</a> 
                </div>



                <div class="microsola"><a href="http://www.microsola.com">Web Solution by <span>Microsola</span> </a></div>
            </div>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.0.min.js"><\/script>')</script>

        <script src="../js/jquery.validationEngine.js"></script>
        <script src="../js/jquery.validationEngine-en.js"></script>

        <script src="../js/plugins.js"></script>
        <script src="../js/main.js"></script>


        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
                g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
                s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
    </body>
</html>

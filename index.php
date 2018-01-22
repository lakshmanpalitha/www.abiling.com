<?php
include("include/rinclude.php");
$pageName = basename($_SERVER['PHP_SELF']);
if ($read->get("id1", "GET") == 'logout') {
    $adt->logout();
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <!--[if IE 7]>
         	<link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css">
        <![endif]-->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/grids-min.css">
        <link rel="stylesheet" href="css/layout.css">
        <link rel="stylesheet" href="css/text.css">
        <link rel="stylesheet" href="css/forms.css">
        <link rel="stylesheet" href="css/home.css">
        <link href='http://fonts.googleapis.com/css?family=Lato:400,900,700,300italic,300,400italic,700italic' rel='stylesheet' type='text/css'>
        <!--<link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />-->
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <div id="main-header-wrapper">
            <?php include("include/site_header.php"); ?>
        </div>
        <div id="main-banner-wrapper">
            <div id="main-banner">
                <div id="slider" class="nivoSlider">
                    <img src="images/banner1.jpg" width="980" height="416" alt="" />
                    <img src="images/banner2.jpg" width="980" height="416" alt="" />
                    <img src="images/banner3.jpg" width="980" height="416" alt="" />
                </div>

            </div>
        </div>

        <div id="main-nav-wrapper">
            <div id="main-nav">
            </div>
        </div>

        <div id="main-containt-wrapper">
            <div id="main-containt">
                <div class="page-title">
                    <div class="views float-l"><p>Our Services</p></div>
                </div>


                <div class="advertising-wrapper">

                    <div class="left-col float-l">
                        <div class="text-block">
                            <img src="images/user-icon.png" width="150" height="150">
                            <h2>Member</h2>
                            <p>Panora Advertising is the greatest platform for make money. As a member you can earn money simply by viewing all the advertisements we display and we got have many ways for make money and always more! We are always ready to take any advice into consideration.</p>
                        </div>




                        <h2 class="bullet-title"> Main Benefits:</h2>

                        <div class="benifits">
                            <a href="#">Earn from home</a>
                            <a href="#">Effortless income</a>
                            <a href="#">Detailed statistics</a>
                            <a href="#">Guaranteed ads</a>
                            <a href="#">Upgrade opportunities</a>
                            <a href="#">Actions and offers</a>
                            <a href="#">Payment via Payza, Pay Pal, Skrill</a>
                        </div>
                        <div class="submit-block">
                            <form action="members/register.php" method="post">
                                <input type="submit" value="Register" name="memReg" class="green">
                            </form>
                        </div>
                    </div>




                    <div class="mid-col float-l">
                        <div class="text-block">
                            <img src="images/add-icon.png" width="150" height="150">
                            <h2>Advertiser</h2>
                            <p>If you are looking to promote your product or services. This is the right place for you to advertise your products, services or your website to help increase your sales and traffic with competitive prices and the ability to reach thousands of potential customers, you always wanted!</p>
                        </div>



                        <h2 class="bullet-title"> Main Benefits:</h2>
                        <div class="benifits">
                            <a href="#">Millions of potential clients</a>
                            <a href="#"> Demographic filter</a>
                            <a href="#">Your need, your choice</a>
                            <a href="#">Detailed statistics</a>
                            <a href="#">Choice of multiple advertisement packs</a>
                            <a href="#">Detailed statistics of your advertisement</a>
                            <a href="#">Strong Anti-cheat protection</a>
                            <a href="#">Ad-prize Credits</a>
                        </div>

                        <div class="submit-block">
                            <form action="advertiser/register.php" method="post">
                                <input type="submit" value="Registor" name="adtReg" class="green">
                            </form>
                        </div>

                    </div>


                    <div class="right-col float-l">
                        <div class="text-block">
                            <img src="images/abbout.png" width="150" height="150">
                            <h2>About us</h2>
                            <p>We are advertising company that shares its advertising revenue with its members by providing excellent business solutions in an easy going win-win environment</p>
                        </div>



                        <h2 class="bullet-title">Our Vition</h2>
                        <p>You can advertise your website to help increase your sales and traffic. <a class="more" href="#">More</a></p>

                        <h2 class="bullet-title">Our Mition</h2>
                        <p>You can advertise your website to help increase your sales and traffic. <a class="more" href="#">More</a></p>

                    
                    <div class="submit-block">
                        <form action="common/aboutus.php" method="post">
                            <input type="submit" value="Read more >>" name="" class="green">
                        </form>
                    </div>
                    
                    </div>
                    
                </div>


            </div>
        </div>

        <div id="main-footer-wrapper">
            <div id="main-footer">
                <div class="copyright float-l"><p>&copy; 2008-2013 Panora Advertising Pvt ltd. All rights reserved.</p></div>


                <div class="c-cards float-r">
                    <img src="images/visa-icon.jpg" width="42" height="25">
                    <img src="images/master-icon.jpg" width="40" height="24">
                    <img src="images/paypal-icon.jpg" width="67" height="24">
                </div>

                <div class="footer-menu float-r">
                    <a href="common/terms.php">Terms of Services </a>
                    <a href="common/privacypolicy.php">Privacy Policy </a>
                    <a href="common/help.php">Help</a> 
                </div>
                <div class="microsola"><a href="http://www.microsola.com">Web Solution by <span>Microsola</span> </a></div>
            </div>
        </div>

       <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.0.min.js"><\/script>')</script>-->
        <script src="js/jquery-1.7.1.min.js"></script>

        <script src="js/plugins.js"></script>
        <script src="js/jquery.cycle.all.js"></script>
                <!--<script type="text/javascript" src="js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
        <script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>-->

        <script src="js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
                g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
                s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
    </body>
</html>

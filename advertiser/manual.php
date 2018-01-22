<?php
include("../include/include.php");
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
        <link rel="stylesheet" type="text/css" href="../css/creat_paymens.css">
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
                    <div class="views float-l"><p>Ads Submit payment</p></div>
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
                        <div class="sub-title"><h3>Ad successfully submit. Please contact panora admin for manual payment</h3></div>

                        <div class="price"></div>
                    </div>
                </div>
                <form action="dashbord.php" method="post">
                    <div class="submit-block">

                        <input class="green" name="Back" type="submit" value="Finish">
                    </div>
                </form>

            </div>
        </div>

        <div id="main-footer-wrapper">
            <div id="main-footer">
                <?php include ("../include/main_footer.php"); ?>
            </div>
        </div>

        <?php include ("../include/footer_js.php"); ?>
    </body>
</html>

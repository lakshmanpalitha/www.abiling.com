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

        <link rel="stylesheet" type="text/css" href="../css/update_account.css">

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
                    <div class="views float-l"><p>Advertiser Registration </p></div>
                </div>
                <div id="left-col">
                    <div class="containt-block">
                        <div class="sub-title"><h3>Select Payment Methods</h3></div>

                        <div class="price"> : <span></span></div>
                        <form method="post" action="payment.php?id1=<?php echo $id ?>" id="user_registration_form" >
                            <div class="containt">
                                <div class="input-block">
                                    <label>Manual :</label>
                                    <input type="radio" name="pay" value="1" id="payment_methord_1" />
                                </div>

                                <div class="input-block">
                                    <label>Paypal :</label>
                                    <input type="radio" name="pay" value="2" id="payment_methord_2" />
                                </div>

                                <div class="input-block">
                                    <label>Creadit Card :</label>
                                    <input type="radio" name="pay" value="3" id="payment_methord_3" />
                                </div>



                                <div class="submit-block">
                                    <input type="hidden" name="trid" value="" id="payment_methord_2" />
                                    <input type="hidden" name="amount" value="" id="payment_methord_2" />
                                    <input class="green" name="crPayment" type="submit" value="Pay">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


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

<?php
include("../include/include.php");
$transactionAmount = false;
$transactionId = false;
$description = false;
if (!$read->get("id1") && !$read->get("id2") && !$read->get("id3")) {
    $pr->redirect("../index.php");
    exit();
}
$refId = (int) $en->decode($read->get("id1"));

if ((int) $en->decode($read->get("id2")) == 198853) {
    $amount = $en->decode($read->get("id3"));
    $description = "Registration Fee";
    $item_name = "Reg";
    $user = $con->queryUniqueObject("SELECT first_name,email,last_name FROM account WHERE account_id='" . $en->decode($read->get("id1")) . "'");
    if (!$user) {
        echo "Invalid Parameters";
        exit();
    }
} else if ((int) $en->decode($read->get("id2")) == 198953) {
    $amount = $en->decode($read->get("id3"));
    $description = "Registration Fee";
    $item_name = "Sub_Reg";
    $user = $con->queryUniqueObject("SELECT first_name,email,last_name FROM account WHERE account_id='" . $en->decode($read->get("id1")) . "'");
    if (!$user) {
        echo "Invalid Parameters";
        exit();
    }
} else if ((int) $en->decode($read->get("id2")) == 199053) {
    $amount = $en->decode($read->get("id4"));
    $description = "Upgrade Fee";
    $item_name = "Up_fee";
    $user = $con->queryUniqueObject("SELECT first_name,email,last_name FROM account WHERE account_id='" . $en->decode($read->get("id1")) . "'");
    if (!$user) {
        echo "Invalid Parameters";
        exit();
    }
} else if ((int) $en->decode($read->get("id2")) == 199153) {
    $amount = $en->decode($read->get("id3"));
    $description = "Initial Fee";
    $item_name = "In_fee";
    $user = $con->queryUniqueObject("SELECT ac.first_name,ac.email,ac.last_name FROM account ac,submit_ads_info sa WHERE ac.account_id=sa.account_id AND sa.ads_id='" . $en->decode($read->get("id1")) . "'");
    if (!$user) {
        echo "Invalid Parameters";
        exit();
    }
} else if ((int) $en->decode($read->get("id2")) == 199253) {
    
} else if ((int) $en->decode($read->get("id2")) == 199353) {
    
} else {
    echo "Invalid Parameters";
    exit();
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
                    <div class="views float-l"><p>Member Registration </p></div>
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
                        <div class="sub-title"><h3>Select Payment Methods</h3></div>

                        <div class="price"><p><?php echo $description ?></p></div>
                        <div id="amount">Your fee for registering : $ <?php echo $amount; ?></div>
                        <form method="post" action="verify.php" id="user_registration_form" >
                            <div class="containt">
                                <div class="input-block">
                                    <label>Manual :</label>
                                    <input type="radio" name="pay" value="1" id="payment_methord_1" />
                                </div>

                                <div class="input-block">
                                    <label>Paypal :</label>
                                    <input type="radio" name="pay" value="2" id="payment_methord_2" />
                                </div>

<!--                                <div class="input-block">
                                    <label>Creadit Card :</label>
                                    <input type="radio" name="pay" value="3" id="payment_methord_3" />
                                </div>-->



                                <div class="submit-block">
                                    <!--paypal-->

                                    <input type="hidden" name="cmd" value="_xclick" /> 
                                    <input type="hidden" name="no_note" value="1" />
                                    <input type="hidden" name="lc" value="LK" />
                                    <input type="hidden" name="currency_code" value="USD" />
                                    <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
                                    <input type="hidden" name="first_name" value="<?php echo $user->first_name; ?>"  />
                                    <input type="hidden" name="last_name" value="<?php echo $user->last_name; ?>"  />
                                    <input type="hidden" name="payer_email" value="<?php echo $user->email; ?>"  />
                                    <input type="hidden" name="item_number" value="<?php echo $refId; ?>" / >
                                    <input type="hidden" name="userid" value="<?php echo $en->decode($read->get("id2")); ?>"/>
                                           <input type="hidden" name="item_name" value="<?php echo $item_name; ?>" / >
                                           <input type="hidden" name="amount" value="<?php echo $amount; ?>" / >
                                           <input type="hidden" name="payfor" value="<?php echo $en->decode($read->get("id2")); ?>" / >
                                           <?php if ((int) $en->decode($read->get("id2")) == 199053) { ?><input type="hidden" name="pak" value="<?php echo $en->decode($read->get("id3")); ?>" / ><?php } ?>

                                           <!---------->

                                           <!--sampath paymet-->

                                           <!---------->
                                           <input class="green" name="checkout" type="submit" value="Pay">
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

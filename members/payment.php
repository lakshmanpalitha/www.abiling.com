<?php
include("../include/include.php");
//pay for member register
if ($read->get("mem_reg_form", "POST")) {
    $accountType = 1;
    if (!$val = $adv->setUser($accountType)) {
        $pr->redirect("../members/register.php");
    }
    $item_name = "account registration";
    $identify = "You must pay following fee for one year registration..";
    $item_number = $val[0] . "P" . $val[1];
    $user = $pr->getRegistrationInfo($val[0]);
    if (!$user) {
        $pr->redirect("../members/register.php");
    }
} else if ($id1 = $read->get("id1", "GET") && $id2 = $read->get("id2", "GET") && $id3 = $read->get("id3", "GET")) {
    $val = array();
    $item_name = "account upgrade";
    $identify = "You must pay following fee for account upgrade..";
    array_push($val, $en->decode($read->get("id1", "GET")));
    array_push($val, $en->decode($read->get("id2", "GET")));
    array_push($val, $en->decode($read->get("id3", "GET")));
    $item_number = $val[0] . "P" . $val[1];
    $user = $pr->getRegistrationInfo($val[0]);
    if (!$user) {
        $pr->redirect("upgrade.php");
    }
} else if (!$read->get("checkout", "POST")) {
    $pr->redirect("upgrade.php");
}



if ($read->get("checkout", "POST")) {
    $acid = $read->get("trid", "POST");
    $pak = $read->get("pak", "POST");
    $amount = $read->get("amount", "POST");
    if ($acid && $pak >= 0 && $amount) {
        if ($read->get("pay", "POST") == 1) {

            $html = $pay->createmanual($acid, $pak, $amount);
        } else if ($read->get("pay", "POST") == 2) {

            if ($pay->createpaypal($acid, $pak, $amount)) {
                include("../payment/paypal/payments.php");
                //$pr->redirect("../payment/paypal/payments.php");
            } else {
                $html = "Unexpected error!";
            }
        } else if ($read->get("pay", "POST") == 3) {

            $html = $pay->createonline($acid, $pak, $amount);
        }
    } else {
        $html = false;
    }
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
                    <?php if (!$read->get("pay", "POST")) { ?>
                        <div class="containt-block">
                            <div class="sub-title"><h3>Select Payment Methods</h3></div>

                            <div class="price"><p><?php $identify ?></p></div>
                            <span>Your fee for registering : <?php echo $val[2]; ?>$</span>
                            <form method="post" action="payment.php" id="user_registration_form" >
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
                                        <!--paypal-->

                                        <input type="hidden" name="cmd" value="_xclick" /> 
                                        <input type="hidden" name="no_note" value="1" />
                                        <input type="hidden" name="lc" value="UK" />
                                        <input type="hidden" name="currency_code" value="GBP" />
                                        <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
                                        <input type="hidden" name="first_name" value="<?php echo $user->first_name; ?>"  />
                                        <input type="hidden" name="last_name" value="<?php echo $user->last_name; ?>"  />
                                        <input type="hidden" name="payer_email" value="<?php echo $user->email; ?>"  />
                                        <input type="hidden" name="item_number" value="<?php echo $item_number; ?>" / >
                                               <input type="hidden" name="item_name" value="<?php echo $item_name; ?>" / >
                                               <input type="hidden" name="amount" value="<?php echo $val[2]; ?>" / >
                                               <!---------->

                                               <!--sampath paymet-->

                                               <!---------->
                                               <input type="hidden" name="trid" value="<?php echo $val[0] ?>" id="payment_methord_2" />
                                        <input type="hidden" name="pak" value="<?php echo $val[1] ?>" id="payment_methord_2" />
                                        <input type="hidden" name="amount" value="<?php echo $val[2] ?>" id="payment_methord_2" />
                                        <input class="green" name="checkout" type="submit" value="Pay">
                                    </div>


                                </div>
                            </form>

                        </div>
                    <?php } else { ?>
                        <div id="left-col">
                            <div class="containt-block">
                                <?php if (!$html)
                                    "Something wrong try again"; ?>
                                <div class="sub-title"><h3><?php if ($html)
                                echo $html['title'] ?></h3></div>

                                <div class="price"><?php if ($html)
                                    echo $html['msg'] ?></div>
                            </div>
                        </div>

                    <?php } ?>
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

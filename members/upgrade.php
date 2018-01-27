<?php
include("../include/include.php");
if (!$pr->getSession("adv")) {
    $pr->redirect("../index.php");
    exit();
}
$id = $pr->getSession("advac");
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
        <link rel="stylesheet" type="text/css" href="../css/upgrade.css">

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
                <div id="upgrade-wrapper">
                    <div class="info-block">
                        <h3>Upgrade your Account </h3>
                        <?php
                        $newDate = $advsum->getRegisterDate();
                        $date = new DateTime($newDate);

                        $date->modify('+365 day');
                        $user=$advsum->getMemberDetail();
                        ?>

                        <div class="date"><span>Account Expoir Date: <font class="red"><?php echo $date->format('Y-m-d'); ?></font></span>     <span>Last Log date: <font class=""><?php echo $user->l_log_date  ?></font></span></div>
                    </div>

                    <div class="submit-block">

<!--                        <input class="green" name="upgrade" type="submit" value="Upgrade">-->
                    </div>
                    <div class="info-block mt">
                        <h3>Upgrade your Package</h3>
                        <div class="date"><span>Current Package: <font class="red"><?php
                        echo $set->getPakageName($advsum->getCurruntPakage());
                        ?></font></span> 

                        </div>

                        <div class="packagebox_wrapper">

                            <?php
                            if (!$advsum->checkRequestForUpgrade()) {
                                $paks = $set->getPakageSettings();
                                foreach ($paks as $p) {
                                    ?>


                                    <?php if ($advsum->getCurruntPakage() < $p->id) { ?>
                                        <a href="../payment/payment.php?id1=<?php echo $en->encode($id) ?>&id2=<?php echo $en->encode(199053) ?>&id3=<?php echo $en->encode($p->id) ?>&id4=<?php echo $en->encode(($set->getPakageValue($p->id) - $set->getPakageValue(($p->id - 1)))) ?>"class="package-box silver">
                                            <span><?php echo $p->name ?></span>
                                            <span>$ <?php echo ($set->getPakageValue($p->id) - $set->getPakageValue(($p->id - 1))); ?></span>
                                            <span class="smal">Upgrade Package Now</span>
                                        </a>
                                    <?php } ?>

                                    <?php
                                }
                            } else {
                                echo "You allredy request for upgrade account";
                            }
                            ?>
                        </div>
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

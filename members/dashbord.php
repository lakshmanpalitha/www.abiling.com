<?php
include("../include/include.php");
if (!$pr->getSession("adv")) {
    $pr->redirect("../index.php");
    exit();
}
if ($read->get("id1", "GET") == 'logout') {
    $adv->logout();
}
$adv->setLastLoginDate();
$dblog = $advsum->getCurruntLogSession();
$clog = session_id();
if ($dblog != $clog) {
    $er->createerror("Unauthorized login!, you loged in more than one browser.So your ads click is not valid.", 1);
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
        <?php include ("../include/header_css.php"); ?>
        <link rel="stylesheet" type="text/css" href="../css/user_dashboard.css">
        <?php include ("../include/header_js.php"); ?>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <div id="main-header-wrapper">
            <?php include("../include/site_header.php"); ?>
        </div>

        <div id="main-containt-wrapper">
            <div id="main-containt">
                <div class="page-title">
<!--                    <div class="views float-l"><p>Lastest Ad Views  <span><?php echo $advsum->getLatestClickAds(); ?></span></p></div>
                    <div class="c-run float-r"><p>Currently Runing Ads  <span><?php echo $advsum->getCurruntAds(); ?></span></p></div>-->
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

                    <div class="menu-block">
                        <h3>Account History</h3>
                        <div class="containt">
                            <div class="block">
                                <?php
                                $history = $his->getHistory();
                                if ($history) {
                                    foreach ($history as $h) {
                                        ?>
                                        <div class="sub-body">
                                            <span class="left"><?php echo $h->date ?></span>
                                            <span class="right"><?php echo $h->discription ?></span>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <!--                    <div class="menu-block">
                                            <h3>Latest News</h3>
                                            <div class="containt">
                                                <a href="#" class="">Ads Summary</a>
                                                <a href="#" class="">Ads Summary</a>
                                                <a href="#" class="">Ads Summary</a>
                                            </div>
                                        </div>-->

                </div>

                <div id="mid-col">
                    <div class="containt-block">
                        <h3>Your Profile</h3>
                        <div class="containt">
                            <div class="block">
                                <h4>Membership</h4>
                                <div class="sub-body">
                                    <span class="left"> <a class="btn"><?php
                                echo $set->getPakageName($advsum->getCurruntPakage());
                                ?></a> </span>
                                    <span class="right">Since: <font class="date"><?php echo $advsum->getRegisterDate(); ?></font>  <a href="upgrade.php" class="btn">+</a></span>
                                </div>
                            </div>

                            <div class="block">
                                <h4>Seen advertisements</h4>
                                <div class="sub-body">
                                    <span class="left">Total Clicks</span>
                                    <span class="right"><?php echo ($advsum->getTotalClicksAds() ? $advsum->getTotalClicksAds() : "0"); ?></span>
                                </div>
                                <div class="sub-body">
                                    <span class="left">Verified Clicks</span>
                                    <span class="right"><?php echo ($advsum->getTotalValidClicksAds() ? $advsum->getTotalValidClicksAds() : "0"); ?></span>
                                </div>
                               

                            </div>
                            <!--                            <div class="block">
                            
                                                            <h4>Click referal link</h4>
                                                            <div class="sub-body">
                                                                <span class="left">Your Reffarals</span>
                                                                <span class="right"><?php echo ($advsum->getCurruntReferalClick() > 0 ? $advsum->getCurruntReferalClick() : "0"); ?></span>
                                                            </div>
                                                        </div>-->

                            <div class="block">
                                <h4>Ads Account</h4>
                                <div class="sub-body">
                                    <?php
                                    $tot = $advsum->getTotEarn();
                                    $adref = $advsum->getCurruntReferalamount();
                                    $adc = $advsum->getCurruntReferalClickamount();
                                    $yac = ($tot - ($adref + $adc));
                                    ?>
                                    <span class="left">Your Ads Clicks:</span>
                                    <span class="right">$ <?php echo sprintf("%01.2f", ($yac)); ?></span>
                                </div>
                                <div class="sub-body">
                                    <span class="left">Refer Members Register :</span>
                                    <span class="right">$ <?php echo sprintf("%01.2f", ($advsum->getCurruntReferalamount())); ?></span>
                                </div>
                                <div class="sub-body">
                                    <span class="left">Refer Member Ads Clicks :</span>
                                    <span class="right">$ <?php echo sprintf("%01.2f", ($advsum->getCurruntReferalClickamount())); ?></span>
                                </div>
                                <div style=" border-bottom: 1px dotted;margin: 14px 0 0;"></div>
                                <div class="sub-body">
                                    <span class="left">Main Balance:</span>
                                    <span class="right">$ <?php echo sprintf("%01.2f", ($advsum->getTotEarn())); ?></span>
                                </div>

                                <div class="sub-body">
                                    <span class="left">Rental Balance:</span>
                                    <span class="right">$ <?php echo sprintf("%01.2f", ($advsum->getAvailableWithdraw())); ?></span>
                                </div>

                            </div>

                            <div class="block">
                                <h4>Main Account</h4>
                                <div class="sub-body">
                                    <span class="left">Register Fee:</span>
                                    <span class="right">$ <?php echo sprintf("%01.2f", ($advsum->getRegFee())); ?></span>
                                </div>

                                <div class="sub-body">
                                    <span class="left">Panora Service Charge:</span>
                                    <span class="right">$ <?php echo sprintf("%01.2f", ($set->getUserHoldLimit($advsum->getCurruntPakage()))); ?></span>
                                </div>
                                <div class="sub-body">
                                    <span class="left">Available Fee:</span>
                                    <span class="right">$ <?php echo sprintf("%01.2f", ($advsum->getRegFee() - $set->getUserHoldLimit($advsum->getCurruntPakage()))); ?></span>
                                </div>

                            </div>

                            <div class="block">
                                <h4>Other</h4>
                                <div class="sub-body">
                                    <span class="left">Panora Points:</span>
                                    <span class="right"><?php echo ($advsum->getCurruntPoints() > 0 ? $advsum->getCurruntPoints() : "0"); ?></span>
                                </div>
                            </div>
                            <?php $prof=$advsum->getUserDetail(); ?>
                             <div class="block">
                                <h4>Profile</h4>
                                <div class="sub-body">
                                    <span class="left">Full Name</span>
                                    <span class="right"><?php echo $prof->first_name." ".$prof->last_name  ?></span>
                                </div>
                                 <div class="sub-body">
                                    <span class="left">Email</span>
                                    <span class="right"><?php echo $prof->email?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--                    <div class="containt-block">
                                            <h3>Account History</h3>
                                            <div class="containt">
                                                <div class="block">
                                                    <div class="sub-body">
                                                        <span class="left">2010/10/10</span>
                                                        <span class="right"><a href="">You'll only notice if there is a color</a></span>
                                                    </div>
                    
                                                    <div class="sub-body">
                                                        <span class="left">2010/10/10</span>
                                                        <span class="right"><a href="">You'll only notice if there is a color</a></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>-->

                </div>

                <div id="right-col">
                    <div class="main-link-btn">
                        <a href="upgrade.php" class="btn upgrade">Upgrade</a>
                        <a href="withdraw.php" class="btn manage-payment">Your Withdraw</a>
                        <a href="ref_ads.php" class="btn advertise">Referal Link</a>

                    </div>

                    <div class="containt-block">
                        <div class="containt">
                            <div class="block">
                                <h4>Your advertisement clicks</h4>
                                <div class="sub-body">
                                    <div class="chart">
                                        <div id="chart_div" style="width: 320px; height: 150px;"></div>
                                    </div>
                                </div>

                            </div>
                        </div>



                        <!--                        <div class="containt-block">
                                                    <h3>Latest News</h3>
                                                    <div class="containt">
                                                        <div class="block">
                                                            <div class="sub-body">
                                                                <span class="left">2010/10/10</span>
                                                                <span class="right"><a href="">You'll only notice if there is a color</a></span>
                                                            </div>
                        
                                                            <div class="sub-body">
                                                                <span class="left">2010/10/10</span>
                                                                <span class="right"><a href="">You'll only notice if there is a color</a></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>-->

                    </div>
                </div>
            </div>

            <div id="main-footer-wrapper">
                <div id="main-footer">
                    <?php include ("../include/main_footer.php"); ?> 
                </div>
            </div>

            <?php include ("../include/footer_js.php"); ?>
            <?php
            $ndate = date("Y");
            $value = false;
            $rads = false;
            $nvalue = false;
            $rads = $con->queryMultipleObjects("SELECT COUNT(ads_id) AS ad,MONTH( l_view_date ) AS m FROM adviewer_view_ads WHERE YEAR( l_view_date )='" . $ndate . "' AND account_id='" . $pr->getSession("advac") . "' GROUP BY MONTH( l_view_date )");
            if ($rads) {
                $value = "['Month', 'Ads'],";
                foreach ($rads as $ad) {
                    if ($ad->m == 1) {
                        $mo = "Jan";
                    } else if ($ad->m == 2) {
                        $mo = "Feb";
                    } else if ($ad->m == 3) {
                        $mo = "Mar";
                    } else if ($ad->m == 4) {
                        $mo = "Apr";
                    } else if ($ad->m == 5) {
                        $mo = "May";
                    } else if ($ad->m == 6) {
                        $mo = "Jun";
                    } else if ($ad->m == 7) {
                        $mo = "Jul";
                    } else if ($ad->m == 8) {
                        $mo = "Aug";
                    } else if ($ad->m == 9) {
                        $mo = "Sep";
                    } else if ($ad->m == 10) {
                        $mo = "Oct";
                    } else if ($ad->m == 11) {
                        $mo = "Nov";
                    } else if ($ad->m == 12) {
                        $mo = "Dec";
                    } else {
                        $mo = "default";
                    }
                    $value.= "['" . $mo . "', " . (int) $ad->ad . "],";
                }
                $nvalue = substr_replace($value, "", -1);
            }
            ?>
            <?php if ($nvalue) { ?>
                <script type="text/javascript" src="https://www.google.com/jsapi"></script>
                <script type="text/javascript">
                    google.load("visualization", "1", {packages:["corechart"]});
                    google.setOnLoadCallback(drawChart);
                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                                                   
    <?php echo $nvalue; ?>
            ]);

            var options = {
                title: 'Ads Clicks Report - <?php echo $ndate ?>'
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
                </script>
            <?php } ?>
    </body>
</html>

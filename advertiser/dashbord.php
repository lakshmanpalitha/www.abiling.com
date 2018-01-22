<?php
include("../include/include.php");
if (!$pr->getSession("adt")) {
    $pr->redirect("../index.php");
    exit();
}
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
        <title>Advertiser Dashbord</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <?php include ("../include/header_css.php"); ?>
        <link rel="stylesheet" type="text/css" href="../css/advetiser_dashboard.css">

        <?php include ("../include/header_js.php"); ?>

    </head>
    <body>

        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <div id="main-header-wrapper">
            <div id="main-header" >
                <?php include ("../include/site_header.php"); ?>
            </div>
        </div>

        <div id="main-containt-wrapper">
            <div id="main-containt">
                <div class="page-title">
                    <div class="views float-l"><p>All Ads :<span> <?php echo $adtsum->getAllAds(); ?></span></p></div>
                    <div class="c-run float-r"><p>Currently Runing Ads : <span><?php echo $adtsum->getAllRunAds(); ?></span></p></div>
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
                    <!--                    <div class="containt-block">
                                            <h3>Title Gos Here</h3>
                                            <div class="containt">
                                                <a href="adinfo.php" class="gray-btn">Ads Summary</a>
                                            </div>
                                        </div>
                    
                    -->
                </div>

                <div id="right-col">
                    <div class="main-link-btn">
                        <a href="createads.php" class="btn submit-add">Submit Ad</a>
                        <a href="manageads.php" class="btn manage-add">Manage Ads</a>
                        <a href="payments.php" class="btn manage-payment">Payments</a>
                    </div>

                    <div class="containt-block">
                        <h3>Your Advetisements Clicks</h3>
                        <div class="containt">
                            <div class="chart">
                                <div id="chart_div" style="width: 620px; height: 200px;"></div>
                            </div> 
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
        <?php
        $ndate = date("Y");
        $value = false;
        $rads = false;
        $rads = $con->queryMultipleObjects("SELECT SUM(p.view_time) AS ad,MONTH(p.l_view_date ) AS m FROM adviewer_view_ads p,submit_ads_info s WHERE s.ads_id=p.ads_id AND YEAR(p.l_view_date )='" . $ndate . "' AND s.account_id='" . $pr->getSession("adtac") . "' GROUP BY MONTH(p.l_view_date )");

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

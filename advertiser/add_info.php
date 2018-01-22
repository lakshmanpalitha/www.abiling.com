<?php
include("../include/include.php");
/*if (!$pr->getSession("adt")) {
    $pr->redirect("../index.php");
    exit();
}*/
if ($read->get("action", "GET") == 'logout') {
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
        <?php
        $ob = $er->displayerror();

        if (($ob->error_code == 0 || $ob->error_code == 1) && $ob->error) {
            echo ($ob->error_code == 1 ? "<div class='mws-form-message error'>
                            	This is an error message
                                <ul>
                                	<li>" . $ob->error . "</li>
                                   
                                </ul>
                            </div>" : "<div class='mws-form-message success'>
                            	This is a success message
                                <ol>
                                	<li>" . $ob->error . "</li>
                                   
                                </ol>
                            </div>");
        }
        ?>
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
                    <div class="views float-l"><p>Lastest Ad Views  <span>245</span></p></div>
                    <div class="c-run float-r"><p>Currently Runing Ads  <span>02</span></p></div>
                </div>
                <div id="left-col">
                    <div class="containt-block">
                        <h3>Title Gos Here</h3>
                        <div class="containt">
                            <a href="#" class="gray-btn">Ads Summary</a>
                        </div>
                    </div>

                    <div class="containt-block">
                        <h3>Title Gos Here</h3>
                        <div class="containt">
                            <a href="#" class="gray-btn">Ads Summary</a>
                        </div>
                    </div>
                </div>

                <div id="right-col">
                    <div class="main-link-btn">
                        <a href="createads.php" class="btn submit-add">Submit Ad</a>
                        <a href="manageads.php" class="btn manage-add">Manage Ads</a>
                        <a href="#" class="btn manage-payment">Manage Payments</a>
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
    </body>
</html>

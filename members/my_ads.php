<?php
include("../include/include.php");
if (!$pr->getSession("adv")) {
    $pr->redirect("../index.php");
    exit();
}
if ($read->get("action", "GET") == 'logout') {
    $adv->logout();
}
if (!$user = $adv->getUser()) {
    
}
$advad->checkAdsRound();
//$advad = new advadloadclass(25);
$advad->setAd(0)
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
        <link rel="stylesheet" type="text/css" href="../css/myads.css">
        <?php include ("../include/header_js.php"); ?>
    </head>
    <body>
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
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <div id="main-header-wrapper">
            <?php include ("../include/site_header.php"); ?>
        </div>

        <div id="main-containt-wrapper">
            <div id="main-containt">
                <div class="page-title">
                    <div class="views float-l"><p>Lastest Ad Views  <span><?php echo $advsum->getLatestClickAds(); ?></span></p></div>
                    <div class="c-run float-r"><p>Currently Runing Ads  <span><?php echo $advsum->getCurruntAds(); ?></span></p></div>
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
                    <?php
                    $ads = $advad->loadAds();
                    if ($ads) {
                        foreach ($ads as $a) {
                            //encrypt ad id

                            $en_id = $en->encode($a->ads_id);
                            if ($a->temp_block == 1) {
                                $class = "ad-block xp_add_block";
                            } else {
                                $class = "ad-block";
                            }
                            ?>

                            <div class="<?php echo $class ?>">
                                <h3><?php echo substr($a->title, 0, 25) ?></h3>
                                <div class="containt">
                                    <a href="viewad.php?id1=<?php echo $en_id; ?>" target="_blank" class=""><?php echo substr($a->description, 0, 50) ?></a>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>

                    <h2 class="xp_ads">Expired Advertisements</h2>     
                    <?php
                    $oads = $advad->loadOldAds();
                    if ($oads) {
                        foreach ($oads as $a) {
                            $en_id = $en->encode($a->ads_id);
                            ?>
                            <div class="ad-block xp_add_block">
                                <h3><?php echo substr($a->title, 0, 25) ?></h3>
                                <div class="containt">
                                    <a href="viewad.php?id1=<?php echo $en_id; ?>" target="_blank" class=""><?php echo substr($a->description, 0, 50) ?></a>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo "No ads";
                    }
                    ?>





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

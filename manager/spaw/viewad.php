<?php
include("../include/include.php");
$anyAdIsRun = false;
$setAdRun = false;
$isAdBlock = false;

if (!$pr->getSession("admin")) {
    $pr->redirect("../index.php");
    exit();
}
$de_id = $en->decode($read->get("id1", "GET"));
if (!$de_id) {
    $pr->redirect("blasted_ad.php");
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
        <link rel="stylesheet" type="text/css" href="../css/viewads.css">
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
        $fromValue = $er->getFromValue();
        ?>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <div id="main-header-wrapper">
            <div id="main-header" >
                <div id="logo" class="float-l">
                    <a href="#"><img src="../images/logo.png" width="197" height="70" alt="LOGO"></a>
                    
                </div>



            </div>
        </div>

        <div id="main-containt-wrapper">
            <div id="main-containt">
                <?php
                $type = $con->queryUniqueObject("SELECT * FROM ads_fool WHERE ads_id='" . $de_id . "'");
                
                if (!$type) {
                   $pr->redirect("blasted_ad.php");
                }
                if ($type->adstype == 2) {
                    ?>
                    <iframe src="<?php echo $type->url ?>" width="100%" scrolling="no" frameborder="0"></iframe> 
                <?php } else { ?>
                    <iframe src="ad.php?id1=<?php echo $read->get("id1", "GET"); ?>" width="100%" height="1000px" scrolling="no" frameborder="0"></iframe> 
                    <?php
                }
                ?>

            </div>

            <div id="main-footer-wrapper">
                <div id="main-footer">
                    <?php include ("../include/main_footer.php"); ?> 
                </div>
            </div>

            <?php include ("../include/footer_js.php"); ?>
    </body>
</html>

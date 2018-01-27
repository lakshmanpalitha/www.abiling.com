<?php
include("../include/include.php");
$adtype = false;
$id = false;

if (!$pr->getSession("adt")) {
    $pr->redirect("login.php");
    exit();
}
if (!$id = $read->get("id1", "GET", "int")) {
    $pr->redirect("createads.php");
    exit();
}

if ($read->get("pay", "POST")) {
    $id3 = $set->getFeeForAdSettings();
    if ($adsid = $ads->setAdsPrivacy($id)) {
        $pr->redirect("../payment/payment.php?id1=" . $en->encode($adsid) . "&id2=" . $en->encode(199153) . "&id3=" . $en->encode($id3));
    }
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
        <title>Submit Ad Info</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <?php include ("../include/header_css.php"); ?>
        <link rel="stylesheet" type="text/css" href="../css/submit_ads.css">
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
                    <div class="views float-l"><p>Ads Settings</p></div>

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

                        <form method="post" action="createads2.php?id1=<?php echo $id ?>" enctype='multipart/form-data' >
                            <div class="containt">

                                <div class="input-block">

                                    <dl class="accordion">

                                        <dt><a href=""> <h3>Country</h3></a></dt>
                                        <dd id="p1">

                                            <?php
                                            $all = $con->queryMultipleObjects("SELECT * FROM country");

                                            if ($all) {
                                                ?>
                                                <b><label class="cadd"><input id="coun_all" value="0" type="checkbox" name="coun[]" />All</label></b>
                                                <?php
                                                foreach ($all as $a) {
                                                    ?>

                                                    <label class="cadd"><input class="coun"  value="<?php echo $a->code ?>"type="checkbox" name="coun[]" /><?php echo $a->name ?></label>
                                                    <?php
                                                }
                                            }
                                            ?>



                                        </dd>

                                        <dt><a href="lpro"><h3>Province/State</h3></a></dt>
                                        <dd id="p2"><?php
                                            $sates = $con->queryMultipleObjects("SELECT * FROM state");
                                            if ($sates) {
                                                ?>
                                                <b><label class="cadd"><input id="pro_all" value="0" type="checkbox" name="pro[]"  />All</label></b>
                                                <?php
                                                foreach ($sates as $st) {
                                                    ?>
                                                    <label class="cadd"><input class="pro" value="<?php echo $st->stid ?>"type="checkbox" name="pro[]"  /><?php echo $st->name ?></label>


                                                    <?php
                                                }
                                            }
                                            ?></dd>

                                        <dt><a href=""><h3>District</h3></a></dt>
                                        <dd id="p3"><?php
                                            $dis = $con->queryMultipleObjects("SELECT * FROM districts");
                                            if ($dis) {
                                                ?>
                                                <b><label class="cadd"><input id="dis_all" value="0" type="checkbox" name="dis[]"  />All</label></b>
                                                <?php
                                                foreach ($dis as $d) {
                                                    ?>
                                                    <label class="cadd"><input class="dis" value="<?php echo $d->id ?>"type="checkbox" name="dis[]"  /><?php echo $d->name ?></label>

                                                    <?php
                                                }
                                            }
                                            ?></dd>
                                        <dt><a href=""><h3>User Settings</h3></a></dt>
                                        <dd id="p3">
                                            <ul id="u-settings">
                                                 <li><label><input type="radio" name="pakage" value="100"/>All</label></li>
                                                <?php
                                                $pak = $set->getPakageSettings();
                                                if ($pak) {

                                                    foreach ($pak as $p) {
                                                        ?>
                                                        <li><label><input type="radio" name="pakage" value="<?php echo $p->id ?>" /><?php echo $p->name ?></label></li>  


                                                    <?php }
                                                } ?>
                                            </ul>
                                            <ul id="u-settings">
                                                <li><label><input type="radio" name="gender" value="MF"/>All</label></li>
                                                <li><label><input type="radio" name="gender" value="M"/>Male</label></li>
                                                <li><label><input type="radio" name="gender" value="F" />Female</label></li>  

                                            </ul>
                                            <ul id="u-settings">
                                                <li><label><input  type="radio" name="_18" value="100"/>All</label></li>
                                                <li><label><input  type="radio" name="_18" value="1"/>18+</label></li>
                                                <li><label><input  type="radio" name="_18" value="2" />18-</label></li>  

                                            </ul>
                                            <ul id="ujobs">
                                                <?php
                                                $all = $con->queryMultipleObjects("SELECT * FROM jobs");

                                                if ($all) {
                                                    ?>
                                                    <b><label class="cadd"><input id="job_all" value="0"type="checkbox" name="job[]" />All</label></b>
                                                    <?php
                                                    foreach ($all as $a) {
                                                        ?>
                                                        <label class="cadd"><input class="job" value="<?php echo $a->id ?>"type="checkbox" name="job[]" /><?php echo $a->name ?></label>

                                                    <?php }
                                                } ?>
                                            </ul>
                                        </dd>

                                    </dl>

                                </div>
                                <div class="submit_block">
                                    <input name="pay" class="next-btn" value="Next" type="submit">
                                </div>
                            </div>
                        </form>
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

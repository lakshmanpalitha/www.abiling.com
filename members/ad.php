<?php
include("../include/include.php");
if (!$pr->getSession("adv")) {
    $pr->redirect("../index.php");
    exit();
}
if (!$read->get("id1", "GET")) {
    //$pr->redirect("my_ads.php");
    exit();
}

$de_id = $en->decode($read->get("id1", "GET"));
if (!$de_id) {
    echo "Ad Failed To Load";
}

$html = $con->queryUniqueObject("SELECT html FROM ads_fool WHERE ads_id='" . $de_id . "'");
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>

    </head>
    <body>
        <?php
        if (!$html) {
            echo "Ad failed";
        } else {
            echo $html->html;
        }
        ?>
    </body>
</html>

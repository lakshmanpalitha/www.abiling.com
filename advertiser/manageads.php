<?php
include("../include/include.php");
if (!$pr->getSession("adt")) {
    $pr->redirect("../index.php");
    exit();
}
$searchQuery = false;
$where = false;
if ($read->get("search", "POST")) {
    if ($from = $read->get("from", "POST") && $to = $read->get("to", "POST") && $id = $read->get("id", "POST")) {
        $where = "WHERE sai.submit_date >='" . $from . "' AND sai.submit_date <='" . $to . "' AND sai.account_id='" . $pr->getSession("adtac") . "'";
        $where.= "AND ads_id='" . $id . "'";
    } else if ($from = $read->get("from", "POST") && $to = $read->get("to", "POST")) {
        $where = "WHERE sai.submit_date >='" . $from . "' AND sai.submit_date <='" . $to . "' AND sai.account_id='" . $pr->getSession("adtac") . "'";
    } else if ($id = $read->get("id", "POST")) {
        $where = "WHERE sai.ads_id='" . $id . "' AND sai.account_id='" . $pr->getSession("adtac") . "'";
    } else {
        $where = "WHERE sai.account_id='" . $pr->getSession("adtac") . "'";
    }

    $searchQuery = "SELECT * FROM submit_ads_info sai " . ($where ? $where : "") . "";
    if ($ispub = $read->get("ispub", "POST")) {
        if ($ispub == 1) {
            $searchQuery = "SELECT * FROM submit_ads_info sai,ads_fool af " . ($where ? $where . " AND sai.ads_id=af.ads_id " : "WHERE sai.ads_id=af.ads_id") . "";
        } else if ($ispub == 2) {
            
        $searchQuery="SELECT * FROM submit_ads_info
  WHERE NOT EXISTS (SELECT ads_id FROM ads_fool
                    WHERE ads_fool.ads_id = submit_ads_info.ads_id) AND submit_ads_info.account_id='" . $pr->getSession("adtac") . "'";
            
        }
    }
} else {
    $searchQuery = "SELECT * FROM submit_ads_info sai WHERE sai.account_id='".$pr->getSession("adtac")."'";
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
        <title>Register</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <?php include ("../include/header_css.php"); ?>
        <link rel="stylesheet" type="text/css" href="../css/manageads.css">
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
                    <div class="views float-l"><p>Your Ads </p></div>

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

                        <form method="post" action="manageads.php" >
                            <div class="containt">

                                <h3>Ads Filter By : Time Period</h3>
                                <div class="input-block">
                                    <div class="sub_block"><label>Frome Date</label><input id="from" value="" name="from" type="text"></div>
                                    <div class="sub_block"><label>To Date</label><input  id="to" value="" name="to" type="text"></div>
                                </div>

                                <h3>Ads Filter By : Ad Id</h3>
                                <div class="input-block">
                                    <label>ID</label>
                                    <input value="" name="id" type="text">
                                </div>

                                <h3>Ads Filter By : Published & Unpublished</h3>
                                <div class="input-block">
                                    <div class="sub_block radio"><label>Published</label><input name="ispub" type="radio" value="1"></div>
                                    <div class="sub_block radio"><label>Unpublished</label><input name="ispub" type="radio" value="2"></div>
                                </div>
                                <div class="submit_block">
                                    <input name="search" class="next-btn" value="Search" type="submit">
                                </div>  


                        </form>
                        <h3>Result </h3>


                        <div class="grid_table">

                            <?php $all_ads = $con->queryMultipleObjects($searchQuery); ?>
                            <table id="grid_table">
                                <tbody>
                                    <tr>
                                        <th>Ad Id</th>
                                        <th>Ad Title</th>
                                        <th>Ad Type</th>
                                        <th>Status</th>
                                        <th>Time Period</th>
                                        <th>Submit Date</th>
                                        <th>Clicks Report</th>
                                    </tr>
                                    <?php
                                    if ($all_ads) {
                                        foreach ($all_ads as $ad) {
                                            $isblast = false;
                                            $isblast = $con->queryUniqueValue("SELECT ads_id  FROM ads_fool WHERE ads_id='" . $ad->ads_id . "'");
                                            ?>

                                            <tr>
                                                <td><?php echo $ad->ads_id ?></td>
                                                <td><?php echo $ad->title ?></td>
                                                <td><?php echo ($ad->ads_type == 1 ? "Url" : "info") ?></td>
                                                <td align="center" valign="top"><a href="#"><?php echo ($isblast ? "<img src='../images/published.png' width='23' height='23'>" : "<img src='../images/unpublished.png' width='23' height='23'>") ?></a></td>
                                                <td><?php echo $ad->from ?> - <?php echo $ad->to ?></td>
                                                <td><?php echo $ad->submit_date ?></td>
                                                <td align="center" valign="top"><a href="adinfo.php?id1=<?php echo $ad->ads_id ?>"><img src="../images/preview.png" width="23" height="23"><img src="../images/preview.png" alt="" width="23" height="23"></a></td>
                                            </tr>
                                        <?php }
                                    } ?>
                                </tbody></table>

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

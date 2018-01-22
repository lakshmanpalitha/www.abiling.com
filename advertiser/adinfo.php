<?php
include("../include/include.php");
if (!$pr->getSession("adt")) {
    $pr->redirect("../index.php");
    exit();
}
if ($read->get("action", "GET") == 'logout') {
    $adt->logout();
}
if (!$id = $read->get("id1", "GET")) {
    $pr->redirect("manageads.php");
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
        <link rel="stylesheet" type="text/css" href="../css/adinfo.css">
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
                    <!--<div class="views float-l">
                      <p>Lastest Ad Views <span>245</span></p>
                    </div>-->
                    <div class="c-run float-r">
                        <p>Total Views : <span><?php echo $adsinfo->totOfViewAds($id); ?></span></p>
                    </div>
                </div>
                <div id="add-info-wrapper">

<!--                    <div class="timeperiod"> <h3>Time Period</h3> <span>Start Date <font><input id="from" value="" name="from" type="text"></font></span> <span>End Date <font><input  id="to" value="" name="to" type="text"></font></span> </div>-->


                    <div class="ad-info-block">
                        <?php
                        $ads = $adsinfo->adClicksJobWise("", $id);
                        $full_tot = 0;
                        if ($ads > 0) {
                            foreach ($ads as $nad) {
                                $full_tot+=$nad->tot;
                            }
                        }
                        ?>
                        <h3>Title / Job  <span>Views:<?php echo $full_tot; ?></span></h3>
                        <ul>
                            <?php
                            if ($ads > 0) {
                                foreach ($ads as $ad) {
                                    ?>
                                    <li><?php echo $con->queryUniqueValue("SELECT name FROM jobs WHERE id='" . $ad->job . "'") ?><span><?php echo $ad->tot ?></span></li>

                                    <?php
                                }
                            } else {
                                echo "No cliks";
                            }
                            ?>
                        </ul>
                    </div>


                    <?php
                    $list = $adsinfo->adClicksCountryWise("", $id);
                    $co_tot = 0;
                    if ($list > 0) {

                        foreach ($list as $nl) {
                            $co_tot+=$nl->tot;
                        }
                    }
                    ?>
                    <div class='ad-info-block'>
                        <h3>Member Locations<span>Views:<?php echo $co_tot; ?></h3></span>
                        <?php
                        if ($list > 0) {
                            echo "<ul>";
                            foreach ($list as $l) {
                                ?>
                                <li><font color="#FF0000" size="4px"><?php echo $con->queryUniqueValue("SELECT name FROM country WHERE code='" . $l->coun . "'"); ?><span><?php echo $l->tot; ?></span></font></li>
                                <?php
                                $slist = $adsinfo->adClicksStateWise("", $id, $l->coun);
                                if ($slist > 0) {
                                    echo " <ul>";
                                    foreach ($slist as $sl) {
                                        ?>
                                        <li><font color="#66CC33" size="3px"><?php echo $con->queryUniqueValue("SELECT name FROM state WHERE stid='" . $sl->st . "'"); ?><span><?php echo $sl->tot ?></span></font></li>
                                        <?php
                                        $dlist = $adsinfo->adClicksDisWise("", $id, $sl->st);
                                        if ($dlist > 0) {
                                            echo " <ul>";
                                            foreach ($dlist as $dl) {
                                                ?>
                                                <li><?php echo $con->queryUniqueValue("SELECT name FROM districts WHERE id='" . $dl->dis . "'") ?><span><?php echo $dl->tot ?></span></li>
                                                <?php
                                            }
                                            echo " </ul>";
                                        }
                                        ?>
                                        <?php
                                    }
                                    echo " </ul>";
                                }
                                ?>


                                <?php
                            }
                            echo " </ul>";
                        } else {
                            echo "No cliks";
                        }
                        ?>
                    </div>                       
                    <div class="ad-info-block">
                        <?php
                        $pak_list = $adsinfo->adClicksPakageWise("", $id);
                        $pak_tot = 0;
                        if ($pak_list > 0) {

                            foreach ($pak_list as $pl) {
                                $pak_tot+=$pl->tot;
                            }
                        }
                        ?>
                        <h3>Packages<span>Views:<?php echo $pak_tot; ?></span></h3>
                        <?php
                        if ($pak_list > 0) {
                            foreach ($pak_list as $pl) {
                                ?>
                                <ul>
                                    <li><?php echo $con->queryUniqueValue("SELECT name FROM settings_pakage WHERE id='" . $pl->pak . "'") ?><span><?php echo $pl->tot ?></span></li>                            
                                </ul>
                                <?php
                            }
                        } else {
                            echo "No cliks";
                        }
                        ?>

                    </div>

                    <div class="ad-info-block">
                        <?php $u_set = $adsinfo->adClickUser($id); ?>
                        <h3>User Settings</h3>
                        <?php if ($u_set) { ?>
                            <ul>
                                <li>Male<span><?php echo $u_set['M'] ?></span></li>
                                <li>Female<span><?php echo $u_set['F'] ?></span></li>
                                <li>18><span><?php echo $u_set['U'] ?></span></li>
                                <li>18<<span><?php echo $u_set['L'] ?></span></li>
                            </ul>
                            <?php
                        } else {
                            echo "No cliks";
                        }
                        ?>
                    </div>
                    <div style="clear:both;">&nbsp;</div>
                    <div class="viewchart-wrapper">
                        <h3>Chart view</h3>
                        <div id="chart_div" style="width: 900px; height: 400px;"></div>
                    </div>
                </div>
            </div>

        </div>
        <div id="main-footer-wrapper">
            <div id="main-footer">
                <?php include ("../include/main_footer.php"); ?>
            </div>
        </div>
        <?php
        $ndate = date("Y");
        $value = false;
        $rads = false;
         $rads = $con->queryMultipleObjects("SELECT SUM(p.view_time) AS ad,MONTH(p.l_view_date ) AS m FROM adviewer_view_ads p,submit_ads_info s WHERE s.ads_id=p.ads_id AND YEAR(p.l_view_date )='" . $ndate . "' AND s.account_id='" . $pr->getSession("adtac") . "' AND s.ads_id='".$id."' GROUP BY MONTH(p.l_view_date )");
        

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

        <?php include ("../include/footer_js.php"); ?>
    </body>
</html>
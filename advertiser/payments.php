<?php
include("../include/include.php");
if (!$pr->getSession("adt")) {
    $pr->redirect("../index.php");
    exit();
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
                    <div class="views float-l"><p>Your Payments </p></div>

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


                        <h3>Result </h3>


                        <div class="grid_table">

                            <?php $payments = $con->queryMultipleObjects("SELECT * FROM advertiser_cashbook ac,submit_ads_info sai WHERE sai.ads_id=ac.ads_id AND sai.account_id='" . $pr->getSession("adtac") . "' ORDER BY sai.ads_id ASC"); ?>
                            <table id="grid_table">
                                <tbody>
                                    <tr>
                                        <th>Ads Id</th>
                                        <th>Date</th>
                                        <th>Pay Method</th>
                                        <th>Pay For What</th>
                                        <th>Amount</th>
                                    </tr>
                                    <?php
                                    if ($payments) {
                                        $ref_ads_id = 0;
                                        $full_tot = 0;
                                        $ads_tot = 0;
                                        $count = count($payments);
                                        $i = 1;
                                        foreach ($payments as $c) {
                                            $full_tot+=$c->amount;
                                            if ($ref_ads_id != $c->ads_id) {
                                                if ($ref_ads_id != 0) {
                                                    ?>
                                                    <tr style="background-color: #dff0d8;">
                                                        <td>Ads Total</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td style="text-align:right;"><b><font color="#FF0000" size="3px">$ <?php echo sprintf("%01.2f", ($ads_tot)) ?></font></td>
                                                    </tr>
                                                    <?php
                                                }
                                                $ref_ads_id = $c->ads_id;
                                                $ads_tot = $c->amount;
                                            } else {
                                                $ads_tot+=$c->amount;
                                            }
                                            ?>

                                            <tr>
                                                <td><?php echo $c->ads_id ?></td>
                                                <td><?php echo $c->date ?></td>
                                                <td><?php
                                    if ($c->pay_method == 1) {
                                        echo "Manual";
                                    } else if ($c->pay_method == 2) {
                                        echo "PayPal";
                                    } else if ($c->pay_method == 3) {
                                        echo "Credit Card";
                                    }
                                            ?></td>
                                                <td><?php
                                            if ($c->initial_payment == 1) {
                                                echo "initial_payment";
                                            } else if ($c->balence_payment == 2) {
                                                echo "balence_payment";
                                            } else if ($c->advnce_payment == 3) {
                                                echo "advnce_payment";
                                            }
                                            ?></td>
                                                <td style="text-align:right;">$ <?php echo sprintf("%01.2f", ($c->amount)) ?></td>
                                            </tr>
                                            <?php
                                            if ($count == $i) {
                                                ?>
                                                <tr style="background-color: #dff0d8;">
                                                    <td>Ads Total</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td style="text-align:right;"><b><font color="#FF0000" size="3px">$ <?php echo sprintf("%01.2f", ($ads_tot)) ?></font></td>
                                                </tr>
                                                <?php
                                            }
                                            $i++;
                                        }
                                        ?>
                                        <tr style="background-color: #FCC;">
                                            <td>Full Total</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td style="text-align:right;"><b><font color="#FF0000" size="3px">$ <?php echo sprintf("%01.2f", ($full_tot)) ?></font></td>
                                        </tr>
                                    <?php } ?>
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

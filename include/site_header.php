<?php
$pageName = basename($_SERVER['PHP_SELF']);
define('HOME', "http://localhost/www.abiling.com/");
//define('HOME', "http://www.panoraadvertising.com");
//define('HOME', "http://microsola.com/preview/panoraadvertising/web");
$adv = false;
$adt = false;
$adm = false;
//echo $pageName;
?>
<div id="main-header" >
    <div id="logo" class="float-l">
        <a href="http://www.panoraadvertising.com"><img src="<?php echo HOME ?>/images/logo.png" width="197" height="70" alt="LOGO"></a>
    </div>
    <?php
    $adv = $pr->getSession("advac");
    $adt = $pr->getSession("adtac");
    $adm = $pr->getSession("admin");
    if ($adv) {
        $lout = HOME . "/members/dashbord.php?id1=logout";
    } else if ($adt) {
        $lout = HOME . "/advertiser/dashbord.php?id1=logout";
    } else if ($adm) {
        $lout = HOME;
    }
    ?>
    <div id="top-statas-bar" class="float-l">
        <div class="top-links">

            <a href="#" class="states-link flag">
                <?php
                if ($adv) {
                    $coun = $advsum->getCountryCode();
                    if ($coun) {
                        $coun = strtolower($coun);
                        $filename = HOME . '/images/coun/' . $coun . '.png';
                        echo "<img src='" . $filename . "' width='20px'>";
                    }
                }
                ?>
            </a>

            <?php echo ($pr->checkSession() ? "<a href='" . $lout . "' class='states-link log-out btn'>Logout</a>" : "<a href='" . HOME . "/common/login.php' class='states-link log-out btn'>Login</a>"); ?>
            <?php if ($adv) { ?>

                <a href="<?php echo HOME ?>/members/upgrade.php" class="states-link upgrade">Upgrade&nbsp; +</a>
                <a href="" class="states-link mony">$ <?php echo sprintf("%01.2f", ($advsum->getTotEarn())); ?></a>
                <a href="<?php echo HOME ?>/members/dashbord.php" class="states-link user-name user-icon"><span class="icon user-name"><?php echo $pr->getSession("loginusername") ?></span></a>
                <a href="<?php echo HOME ?>">Home</a>
            <?php } ?>
            <?php if ($adt) { ?>

                <a href="<?php echo HOME ?>/advertiser/dashbord.php" class="states-link user-name user-icon"><span class="icon user-name"><?php echo $pr->getSession("loginusername") ?></span></a>
                <a href="<?php echo HOME ?>">Home</a>
            <?php } ?>
            <!-- Change icon add (user-icon, admin-icon, advertiser-icon)-->
        </div>
    </div>
    <?php if ($pageName == "index.php" || $pageName == "services.php" || $pageName == "offers.php" || $pageName == "contactus.php" || $pageName == "faq.php" || $pageName == "aboutus.php" || $pageName == "login.php" || $pageName == "register.php" || $pageName == "ads.php" || $pageName == "success.php" || $pageName == "payment.php") { ?>
        <div id="main-top-menu" class="float-l">
            <ul class="float-r">
                <li <?php
    if ($pageName == "index.php") {
        echo "class='active'";
    }
        ?>><a href="<?php echo HOME ?>">Home</a></li>
    <!--                <li <?php //if($pageName == "index.php"){echo "class='active'";}         ?>><a href="<?php echo HOME ?>/common/ads.php">View Advertising </a></li>-->
                <li <?php
                if ($pageName == "services.php") {
                    echo "class='active'";
                }
        ?>><a href="<?php echo HOME ?>/common/services.php">Services</a></li>
                <li <?php
                if ($pageName == "offers.php") {
                    echo "class='active'";
                }
        ?>><a href="<?php echo HOME ?>/common/aboutus.php">About us</a></li>
                <li <?php
                if ($pageName == "contactus.php") {
                    echo "class='active'";
                }
        ?>><a href="<?php echo HOME ?>/common/contactus.php">Contact us</a></li>
                <!--                <li <?php
                if ($pageName == "faq.php") {
                    echo "class='active'";
                }
        ?>><a href="<?php echo HOME ?>/common/faq.php">FAQ</a></li>-->
            </ul>
        </div>
    <?php } else if ($adv) { ?>
        <div id="main-top-menu" class="float-l">
            <ul class="float-r">
                <li <?php
    if ($pageName == "dashbord.php") {
        echo "class='active'";
    }
        ?>><a href="<?php echo HOME ?>/members/dashbord.php">Dashboard</a></li>
                <li <?php
                if ($pageName == "my_ads.php") {
                    echo "class='active'";
                }
        ?>><a href="<?php echo HOME ?>/members/my_ads.php">View Advertising </a></li>
                <li <?php
                if ($pageName == "3.php") {
                    echo "class='active'";
                }
        ?>><a href="#">Offers</a></li>
                <!--                <li <?php
                if ($pageName == "3.php") {
                    echo "class='active'";
                }
        ?>><a href="#">FAQ</a></li>-->
            </ul>
        </div>
    <?php } else if ($adt) { ?>
        <div id="main-top-menu" class="float-l">
            <ul class="float-r">
                <li <?php
    if ($pageName == "dashbord.php") {
        echo "class='active'";
    }
        ?>><a href="<?php echo HOME ?>/advertiser/dashbord.php">Dashboard</a></li>
                <li <?php
                if ($pageName == "manageads.php") {
                    echo "class='active'";
                }
        ?>><a href="<?php echo HOME ?>/advertiser/manageads.php">Manage Ads</a></li>
                <!--<li <?php
                if ($pageName == "") {
                    echo "class='active'";
                }
        ?>><a href="">Manage Payment</a></li>-->
                <li  <?php
            if ($pageName == "createads.php") {
                echo "class='active'";
            }
        ?>><a href="<?php echo HOME ?>/advertiser/createads.php">Submit Ads</a></li>
                <li><a href="#">Offers</a></li>
                <!--                <li><a href="#">FAQ</a></li>-->
            </ul>
        </div>
    <?php } ?>
</div>
<?php
include("../include/include.php");
if (!$pr->getSession("admin")) {
    $pr->redirect("../index.php");
    exit();
}
if (!$adid = $read->get("id1", "GET")) {
    $pr->redirect("blasted_ad.php");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("includes/header.php"); ?>
    </head>
    <body>

        <!--Header-part-->
        <div id="header">
            <h1>Panora Admin</h1>
        </div>
        <!--close-Header-part--> 

        <!--top-Header-messaages-->
        <div class="btn-group rightzero"> <a class="top_message tip-left" title="Manage Files"><i class="icon-file"></i></a> <a class="top_message tip-bottom" title="Manage Users"><i class="icon-user"></i></a> <a class="top_message tip-bottom" title="Manage Comments"><i class="icon-comment"></i><span class="label label-important">5</span></a> <a class="top_message tip-bottom" title="Manage Orders"><i class="icon-shopping-cart"></i></a> </div>
        <!--close-top-Header-messaages--> 

        <!--top-Header-menu-->
        <div id="user-nav" class="navbar navbar-inverse">
            <ul class="nav">
                <li class="" ><a title="" href="#"><i class="icon icon-user"></i> <span class="text">Profile</span></a></li>
                <li class=""><a title="" href="index.php?id1=logout"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
            </ul>
        </div>
        <div id="search">
            <input type="text" placeholder="Search here..."/>
            <button type="submit" class="tip-left" title="Search"><i class="icon-search icon-white"></i></button>
        </div>
         <?php include("includes/sidebar.php");?>

        <div id="content">
            <div id="content-header">
                <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Members</a> </div>
                <h1>Ad Clicks Info</h1>
            </div>
            <div class="container-fluid">
                <div class="widget-box">
                    <div class="widget-title">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab1">Members Locations</a></li>
                            <li><a data-toggle="tab" href="#tab2">Members Jobs/Title</a></li>
                            <li><a data-toggle="tab" href="#tab3">Member Settings</a></li>
                        </ul>
                    </div>
                    <?php $list = $adsinfo->adClicksCountryWise("", $adid); ?>
                    <div class="widget-content tab-content">
                        <div id="tab1" class="tab-pane active">
                            <?php if ($list > 0) {
                                foreach ($list as $l) { ?>
                                    <div class="span4">
                                        <div class="widget-box">
                                            <div class="widget-title">
                                                <span class="icon">
                                                    <i class="icon-eye-open"></i>
                                                </span>
                                                <h5><?php echo $con->queryUniqueValue("SELECT name FROM country WHERE code='" . $l->coun . "'") . "-" . $l->tot ?></h5>
                                            </div>
                                            <?php
                                            $slist = $adsinfo->adClicksStateWise("", $adid, $l->coun);

                                            if ($slist > 0) {
                                             
                                                foreach ($slist as $sl) {
                                                    ?>

                                                    <div class="widget-content nopadding">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th><?php echo $con->queryUniqueValue("SELECT name FROM state WHERE stid='" . $sl->st . "'"); ?></th>
                                                                    <th><?php echo $sl->tot ?></th>
                                                                </tr>
                                                            </thead>
                                                            <?php
                                                            $dlist = $adsinfo->adClicksDisWise("", $adid, $sl->st);
                                                            if ($dlist > 0) {
                                                                foreach ($dlist as $dl) {
                                                                    ?>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td><?php echo $con->queryUniqueValue("SELECT name FROM districts WHERE id='" . $dl->dis . "'") ?></td>
                                                                            <td><?php echo $dl->tot ?></td>
                                                                        </tr>

                                                                    </tbody>
                                                                <?php }
                                                            } ?> 
                                                        </table>
                                                    </div>
                                                <?php }
                                            } ?>
                                        </div>
                                    </div>
                                <?php }
                            } ?>
                        </div>
                        <div id="tab2" class="tab-pane">
                            <div class="span4">
                                <div class="widget-box">
                                    <div class="widget-title">
                                        <span class="icon">
                                            <i class="icon-eye-open"></i>
                                        </span>
                                        <h5>job</h5>
                                    </div>
                                    <div class="widget-content nopadding">
                                        <table class="table table-bordered">
<!--                                            <thead>
                                                <tr>
                                                    <th><?php echo $con->queryUniqueValue("SELECT name FROM state WHERE stid='" . $sl->st . "'"); ?></th>
                                                    <th><?php echo $sl->tot ?></th>
                                                </tr>
                                            </thead>-->
                                            <?php
                                            $jlist = $adsinfo->adClicksJobWise("", $adid);
                                            if ($jlist > 0) {
                                                foreach ($jlist as $jl) {
                                                    ?>
                                                    <tbody>
                                                        <tr>
                                                            <td><?php echo $con->queryUniqueValue("SELECT name FROM jobs WHERE id='" . $jl->job . "'") ?></td>
                                                            <td><?php echo $jl->tot ?></td>
                                                        </tr>

                                                    </tbody>
                                                <?php }
                                            } ?> 
                                        </table>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div id="tab3" class="tab-pane">
                            <div class="span4">
                                <div class="widget-box">
                                    <div class="widget-title">
                                        <span class="icon">
                                            <i class="icon-eye-open"></i>
                                        </span>
                                        <h5>Pakage</h5>
                                    </div>
                                    <div class="widget-content nopadding">
                                        <table class="table table-bordered">
<!--                                            <thead>
                                                <tr>
                                                    <th><?php echo $con->queryUniqueValue("SELECT name FROM state WHERE stid='" . $sl->st . "'"); ?></th>
                                                    <th><?php echo $sl->tot ?></th>
                                                </tr>
                                            </thead>-->
                                            <?php
                                            $plist = $adsinfo->adClicksPakageWise("", $adid);
                                            if ($jlist > 0) {
                                                foreach ($plist as $pl) {
                                                    ?>
                                                    <tbody>
                                                        <tr>
                                                            <td><?php echo $con->queryUniqueValue("SELECT name FROM settings_pakage WHERE id='" . $pl->pak . "'") ?></td>
                                                            <td><?php echo $pl->tot ?></td>
                                                        </tr>

                                                    </tbody>
                                                <?php }
                                            } ?> 
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <div class="span4">
                                <div class="widget-box">
                                    <div class="widget-title">
                                        <span class="icon">
                                            <i class="icon-eye-open"></i>
                                        </span>
                                        <h5>User settings</h5>
                                    </div>
                                    <div class="widget-content nopadding">
                                        <table class="table table-bordered">
<!--                                            <thead>
                                                <tr>
                                                    <th><?php echo $con->queryUniqueValue("SELECT name FROM state WHERE stid='" . $sl->st . "'"); ?></th>
                                                    <th><?php echo $sl->tot ?></th>
                                                </tr>
                                            </thead>-->
                                            <?php  $uset = $adsinfo->adClickUser($adid); ?>
                                            <tbody>
                                                <tr>
                                                    <td>Male</td>
                                                    <td><?php echo $uset['M'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Female</td>
                                                    <td><?php echo $uset['F'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>18 ></td>
                                                    <td><?php echo $uset['U'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>18 <</td>
                                                    <td><?php echo $uset['L'] ?></td>
                                                </tr>

                                            </tbody>

                                        </table>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>                            
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div id="footer" class="span12"> 2012 &copy;<a href="http://www.microsola.com">www.microsola.com</a> </div>
        </div>
        <?php include("includes/footerjs.php"); ?>
        <script src="js/jquery.uniform.js"></script> 
        <script src="js/select2.min.js"></script> 
        <script src="js/jquery.dataTables.min.js"></script> 
        <script src="js/maruti.js"></script> 
        <script src="js/maruti.tables.js"></script>
    </body>
</html>

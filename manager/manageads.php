<?php
include("../include/include.php");
if (!$pr->getSession("admin")) {
    $pr->redirect("../index.php");
    exit();
}
if ($read->get("del", "GET") == 'y' && $id = $read->get("adid", "GET")) {
    $adsmanage->delAd($id);
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
            <h1>Panora Admin</a></h1>
        </div>
        <!--close-Header-part--> 

        <!--top-Header-messaages-->
        <div class="btn-group rightzero"> <a class="top_message tip-left" title="Manage Files"><i class="icon-file"></i></a> <a class="top_message tip-bottom" title="Manage Users"><i class="icon-user"></i></a> <a class="top_message tip-bottom" title="Manage Comments"><i class="icon-comment"></i><span class="label label-important">5</span></a> <a class="top_message tip-bottom" title="Manage Orders"><i class="icon-shopping-cart"></i></a> </div>
        <!--close-top-Header-messaages--> 

        <!--top-Header-menu-->
        <div id="user-nav" class="navbar navbar-inverse">
            <ul class="nav">
<!--                <li class="" ><a title="" href="#"><i class="icon icon-user"></i> <span class="text">Profile</span></a></li>-->
<!--                <li class=" dropdown" id="menu-messages"><a href="#" data-toggle="dropdown" data-target="#menu-messages" class="dropdown-toggle"><i class="icon icon-envelope"></i> <span class="text">Messages</span> <span class="label label-important">5</span> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a class="sAdd" title="" href="#">new message</a></li>
                        <li><a class="sInbox" title="" href="#">inbox</a></li>
                        <li><a class="sOutbox" title="" href="#">outbox</a></li>
                        <li><a class="sTrash" title="" href="#">trash</a></li>
                    </ul>
                </li>-->
<!--                <li class=""><a title="" href="#"><i class="icon icon-cog"></i> <span class="text">Settings</span></a></li>-->
                <li class=""><a title="" href="index.php?id1=logout"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
            </ul>
        </div>
        <div id="search">
            <input type="text" placeholder="Search here..."/>
            <button type="submit" class="tip-left" title="Search"><i class="icon-search icon-white"></i></button>
        </div>
        <?php include("includes/sidebar.php"); ?>
        <!--close-top-Header-menu-->

<!--        <div id="sidebar"> <a href="#" class="visible-phone"><i class="icon icon-th-list"></i> Tables</a>
            <ul>
                <li class="active"><a href="index.html"><i class="icon icon-home"></i> <span>Dashboard</span></a></li>
                <li> <a href="charts.html"><i class="icon icon-signal"></i> <span>Charts &amp; graphs</span></a> </li>
                <li> <a href="widgets.html"><i class="icon icon-inbox"></i> <span>Widgets</span></a> </li>
                <li><a href="tables.html"><i class="icon icon-th"></i> <span>Tables</span></a></li>
                <li><a href="grid.html"><i class="icon icon-fullscreen"></i> <span>Full width</span></a></li>
                <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Forms</span> <span class="label">3</span></a>
                    <ul>
                        <li><a href="form-common.html">Basic Form</a></li>
                        <li><a href="form-validation.html">Form with Validation</a></li>
                        <li><a href="form-wizard.html">Form with Wizard</a></li>
                    </ul>
                </li>
                <li><a href="buttons.html"><i class="icon icon-tint"></i> <span>Buttons &amp; icons</span></a></li>
                <li><a href="interface.html"><i class="icon icon-pencil"></i> <span>Eelements</span></a></li>

                <li class="submenu"> <a href="#"><i class="icon icon-file"></i> <span>Addons</span> <span class="label">3</span></a>
                    <ul>
                        <li><a href="gallery.html">Gallery</a></li>
                        <li><a href="calendar.html">Calendar</a></li>
                        <li><a href="chat.html">Chat option</a></li>
                    </ul>
                </li>

            </ul>
        </div>-->
        <div id="content">
            <div id="content-header">
                <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Manage Ads</a> </div>
                <h1>Pending Ads</h1>
            </div>
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon">
                            <i class="icon-align-justify"></i>									
                        </span>
                        <h5>Search Ads</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="manageads.php" method="post" class="form-horizontal">

                            <div class="control-group">
                                <label class="control-label">Company :</label>
                                <div class="controls">
                                    <select style="width:150px;" name="com">
                                         <option selected="selected" value="">All</option>
                                        <?php
                                        $adt = $con->queryMultipleObjects("SELECT * FROM account WHERE account_type=3");
                                        if ($adt) {
                                            foreach ($adt as $a) {
                                                ?>
                                                <option  value="<?php echo $a->account_id ?>"><?php echo $a->first_name ?></option>
                                            <?php }
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="submit" name="Search" value="Search" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                </div>						
            </div>
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-box">
                            <div class="widget-title">
                                <span class="icon"><i class="icon-th"></i></span> 
                                <h5>Ads Table</h5>
                            </div>
                            <div class="widget-content nopadding">
                                <table class="table table-bordered data-table">
                                    <thead>
                                        <tr>
                                            <th>Ad ID</th>
                                            <th>Ad Title</th>
                                            <th>Advertiser</th>
                                            <th>Ads Type</th>
                                            <th>Initial Payment</th>
                                            <th>Submit On</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($read->get("Search", "POST") && $read->get("com", "POST")  ) {
                                            $ads = $con->queryMultipleObjects("SELECT * FROM submit_ads_info ads_i,account ac WHERE ads_i.account_id='" . $read->get("com", "POST") . "' AND ac.account_id=ads_i.account_id AND ads_i.isblast=0  ORDER BY ads_i.submit_date DESC ");
                                        } else {
                                            $ads = $con->queryMultipleObjects("SELECT * FROM submit_ads_info ads_i,account ac WHERE ac.account_id=ads_i.account_id AND ads_i.isblast=0  ORDER BY ads_i.submit_date DESC ");
                                        }
                                        if ($ads) {
                                            foreach ($ads as $a) {
                                                $ispay = false;
                                                $ispay = $con->queryUniqueValue("SELECT initial_payment FROM advertiser_cashbook WHERE initial_payment=1 AND ads_id='" . $a->ads_id . "'");
                                                ?>
                                                <tr class="gradeX">
                                                    <td><?php echo $a->ads_id ?></td>
                                                    <td><?php echo $a->title ?></td>
                                                    <td><?php echo $a->first_name ?></td>
                                                    <td><?php echo ($a->ads_type == 1 ? "Url" : "Information") ?></td>
                                                    <td><?php echo ($ispay == 1 ? "<span class='done'>done</span>" : "<span class='pending'>pending</span>") ?></td>
                                                    <td><?php echo $a->submit_date ?></td>
                                                    <td class="center">

                                                        <?php if ($ispay) { ?><a class="tip-top" data-original-title="Blast Ad" href="blast_ad.php?adid=<?php echo $a->ads_id ?>"><i class="icon-road"></i></a>&nbsp &nbsp<?php } ?>

                                                        <a class="tip-top" data-original-title="Payment" href="confirm.php?id1=<?php echo $a->ads_id ?>" target="_self"><i class="icon-shopping-cart"></i></a>&nbsp &nbsp
                                                        <a class="tip-top" data-original-title="Delete Ad" onclick='return getConfirmation();' href="manageads.php?del=y&adid=<?php echo $a->ads_id ?>"><i class="icon-remove"></i></a>

                                                    </td>
                                                </tr>
                                            <?php }
                                        } else { ?>
                                            <tr class="gradeX">
                                                <td>No Ads</td>

                                            </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>
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

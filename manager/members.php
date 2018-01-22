<?php
include("../include/include.php");
if (!$pr->getSession("admin")) {
    $pr->redirect("../index.php");
    exit();
}
if ($read->get("id2", "GET") == 'del' && $id = $read->get("id1", "GET")) {
    $adv = new advclass($id);
    $adv->deleteAccount();
}
if ($read->get("id2", "GET") == 'block' && $id = $read->get("id1", "GET")) {
    $adv = new advclass($id);
    $adv->blockAccount();
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
                <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Members</a> </div>
                <h1>Members</h1>
            </div>
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-box">
                            <div class="widget-title">
                                <span class="icon"><i class="icon-th"></i></span> 
                                <h5>Members Table</h5>
                            </div>
                            <div class="widget-content nopadding">
                                <table class="table table-bordered data-table">
                                    <thead>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>user Name</th>
                                            <th>Password</th>
                                            <th>Phone</th>
                                            <th>Country</th>
                                            <th>Payment</th>
                                            <th>Account</th>
                                            <th>Account Type</th>
                                            <th>Register Date</th>
                                            <th>Action</th>
                                            <th>Requests</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $mem = $con->queryMultipleObjects("SELECT * FROM account ac,adviewer_register ar WHERE ac.del_ad=0 AND ac.account_id=ar.account_id AND ac.account_type=2 ORDER BY ac.register_date DESC");
                                        if ($mem) {
                                            foreach ($mem as $m) {
                                                ($m->isblock == 1 ? $style = "style='background-color: #FF9999;'" : $style = "");
                                                ?>
                                                <tr <?php echo $style ?> class="gradeX">
                                                    <td><?php echo $m->first_name ?></td>
                                                    <td><?php echo $m->last_name ?></td>
                                                    <td><?php echo $m->email ?></td>
                                                    <td><?php echo $m->user_name ?></td>
                                                    <td><?php echo $en->decode($m->password) ?></td>
                                                    <td><?php echo $m->phone ?></td>
                                                    <td><?php echo $con->queryUniqueValue("SELECT name FROM country WHERE code='" . $m->country . "'"); ?></td>
                                                    <td><?php echo ($m->ispay ? "<i class='icon-ok'></i>" : "<i class='icon-ban-circle'></i>") ?></td>
                                                    <td><?php echo ($m->account_type == 1 ? "Main" : "Sub") ?></td>
                                                    <td><?php
                                        if ($m->pakage == 1) {
                                            echo "Sliver";
                                        } else
                                        if ($m->pakage == 2) {
                                            echo "Gold";
                                        } else {
                                            echo "Platinum";
                                        }
                                                ?></td>
                                                    <td><?php echo $m->register_date ?></td>
                                                    <td class="center">
                                                        <a class="tip-top" data-original-title="Clicks Report" href=""><i class="icon-comment"></i></a>&nbsp &nbsp
                                                        <a class="tip-top" data-original-title="Payment" href="mpayments.php?id1=<?php echo $m->account_id ?>"><i class="icon-shopping-cart"></i></a>&nbsp &nbsp
                                                        <a class="tip-top" data-original-title="More Detail" href="member_info.php?acid=<?php echo $m->account_id ?>"><i class="icon-search"></i></a>&nbsp &nbsp
                                                        <a class="tip-top" data-original-title="Block Ad" href="members.php?id2=block&id1=<?php echo $m->account_id ?>"><i class="icon-off"></i></a>&nbsp &nbsp                                           
                                                        <a class="tip-top" data-original-title="Delete Ad" onclick='return getConfirmation();' href="members.php?id2=del&id1=<?php echo $m->account_id ?>"><i class="icon-remove"></i></a>

                                                    </td>
                                                    <td> <?php $advsum = new advsummary($m->account_id);
                                                if ($advsum->checkRequestForUpgrade()) { ?><a href="upgrade.php?id1=<?php echo $m->account_id ?>"><i class="icon-user"></i></a>&nbsp &nbsp<?php } ?>
                                                        <?php if ($advsum->checkRequestForWithdraw()) { ?><a href="mpayments.php?id1=<?php echo $m->account_id ?>"><i class="icon-briefcase"></i></a><?php } ?>
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

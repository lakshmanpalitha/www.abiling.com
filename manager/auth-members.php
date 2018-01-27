<?php
include("../include/include.php");
/*if (!$pr->getSession("admin")) {
    $pr->redirect("../index.php");
    exit();
}*/
if ($read->get("id2", "GET") == 'del' && $id = $read->get("id1", "GET")) {
    $adv = new advclass($id);
    $adv->deleteAccount();
}
if ($read->get("id2", "GET") == 'block' && $id = $read->get("id1", "GET")) {
    $adv = new advclass($id);
    $adv->blockAccount();
}
if ($read->get("p", "GET") == "Y") {
    $pr->unsetSession("SEARCH");
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
                <!--<li class=""><a title="" href="index.php?id1=logout"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>-->
            </ul>
        </div>
        <!--        <div id="search">
                    <form action="members.php" method="post">
                    <input type="text" placeholder="Search here..."/>
                    <input type="submit" name="fee_ad" value="S" class="btn btn-success" /> 
                    </form>
                </div>-->
        <?php //include("includes/sidebar.php"); ?>
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
               <!--<div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Members</a> </div>-->
                <h1>Members</h1>
            </div>
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-box">

                            <ul id="r-li">
                                <li> <h5>Total Members-<span id="tot"><?php echo $mgt->totalUsers(); ?></span></h5></li>
                                <li> <h5>Register Members-<span id="tot"><?php echo $mgt->totalRegUsers(); ?></span></h5></li>
                                <li> <h5>Pending Members-<span id="tot"><?php echo $mgt->totalPendinUsers(); ?></span></h5></li>
                                <?php
                                $pak = $set->getPakageSettings();
                                if ($pak) {
                                    foreach ($pak as $p) {
                                        ?> 
                                        <li> <h5><?php echo $p->name ?>-<span id="tot"><?php echo $mgt->totalAccountUsers($p->id); ?></span></h5></li>
                                    <?php }
                                } ?>
                            </ul>


                        </div>
                        <div class="widget-box">
                            <div class="widget-content nopadding">
                                <form action="auth-members.php" method="post" class="form-horizontal">
                                    <div class="form-actions">
                                        <div class="control-group srh-box">
                                            <label class="control-label">Keyword :</label>
                                            <div class="controls"><input name="keyword" type="text"class="span20" id="title" placeholder="Keyword" /></div>
                                        </div>
                                        <div class="control-group srh-box">
                                            <label class="control-label">Account Type :</label>
                                            <div class="controls">
                                                <select style="width:150px;" name="ac">
                                                    <option  value="0" >All</option>
                                                    <?php
                                                    $pak = $set->getPakageSettings();
                                                    if ($pak) {
                                                        foreach ($pak as $p) {
                                                            ?>
                                                            <option  value="<?php echo $p->id ?>"><?php echo $p->name ?></option>
                                                        <?php }
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group srh-box">
                                            <label class="control-label">Actions :</label>
                                            <div class="controls">
                                                <select style="width:150px;" name="act">
                                                    <option  value="0" >All</option>
                                                    <option  value="1" >Pending Members</option>
                                                    <option  value="2" >Registered Members</option>
                                                    <option  value="3" >Request Members</option>

                                                </select>
                                            </div>
                                        </div>
                                        <input type="submit" name="Search" value="Search" class="btn btn-success" /> 

                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php
                        $query1 = "";
                        $query2 = "";
                        $query3 = "";
                        $ac = 0;
                        $act = 0;

                        if ($read->get("Search", "POST")) {
                            $pr->unsetSession("SEARCH");
                            $ac = $read->get("ac", "POST");
                            $act = $read->get("act", "POST");
                            $query1 = "AND ar.pakage=" . $read->get("ac", "POST");
                            $query2 = "AND ar.ispay=0";
                            $query3 = "AND ar.ispay=1";
                            if ($read->get("keyword", "POST")) {

                                $query = "SELECT * FROM account ac,adviewer_register ar WHERE (ac.first_name 
                                LIKE '%" . $read->get("keyword", "POST") . "%' OR ac.email LIKE '%" . $read->get("keyword", "POST") . "%' 
                                OR ac.last_name LIKE '%" . $read->get("keyword", "POST") . "%' OR ac.account_id LIKE '%" . $read->get("keyword", "POST") . "%') 
                                AND ac.del_ad=0 " . ($ac != 0 && $query1 ? $query1 : "") . " " . ($act == 1 && $query2 ? $query2 : "") . " " . ($act == 2 && $query3 ? $query3 : "") . " 
                                AND ac.account_id=ar.account_id AND ac.account_type=2 ORDER BY ac.register_date DESC";
                            } else {
                                $query = "SELECT * FROM account ac,adviewer_register ar WHERE ac.del_ad=0 " . ($ac != 0 && $query1 ? $query1 : "") . " " . ($act == 1 && $query2 ? $query2 : "") . " " . ($act == 2 && $query3 ? $query3 : "") . " AND ac.account_id=ar.account_id AND ac.account_type=2 ORDER BY ac.register_date DESC";
                            }

                            /*                             * * STORE SERACH QUERY FOR PAGINATION * * */
                            $pr->craeteSession("SEARCH", $query);
                        } else if ($pr->getSession("SEARCH")) {
                            $query = $pr->getSession("SEARCH");
                        } else {
                            $query = "SELECT * FROM account ac,adviewer_register ar WHERE ac.del_ad=0 AND ac.account_id=ar.account_id AND ac.account_type=2 ORDER BY ac.register_date DESC";
                        }
                        //var_dump($query);
                        //$mem = $con->queryMultipleObjects($query);

                        /*                         * * PAGINATION CALL * * */
                        $mem = $pg->setpagination($query, $num_results_per_page, $num_page_links_per_page, $pg_param);

                        /*                         * * PAGINATION LINK * * */
                        $link = $pg->Create_Links($rid, $key);
                        echo $link;
                        ?>
                        <div class="widget-box">
                            <div class="widget-title">
                                <span class="icon"><i class="icon-th"></i></span> 
                                <h5>Members Table</h5>
                            </div>


                            <div class="widget-content nopadding">
                                <table class="table table-bordered data-table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
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
                                            <th>Last Log Date</th>
                                            <th>Action</th>
                                            <th>Requests</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($mem) {
                                            foreach ($mem as $m) {
                                                ($m->isblock == 1 ? $style = "style='background-color: #FF9999;'" : $style = "");
                                                ?>
                                                <tr <?php echo $style ?> class="gradeX">
                                                    <td><?php echo $m->account_id ?></td>
                                                    <td><?php echo $m->first_name ?></td>
                                                    <td><?php echo $m->last_name ?></td>
                                                    <td><?php echo $m->email ?></td>
                                                    <td><?php echo $m->user_name ?></td>
                                                    <td><?php echo $en->decode($m->password) ?></td>
                                                    <td><?php echo $m->phone ?></td>
                                                    <td><?php echo $con->queryUniqueValue("SELECT name FROM country WHERE code='" . $m->country . "'"); ?></td>
                                                    <td><?php echo ($m->ispay ? "<i class='icon-ok'></i>" : "<i class='icon-ban-circle'></i>") ?></td>
                                                    <td><?php echo ($m->account_type == 1 ? "Main" : "Sub") ?></td>
                                                    <td><?php echo $set->getPakageName($m->pakage); ?></td>
                                                    <td><?php echo $m->register_date ?></td>
                                                    <td><?php echo $m->l_log_date ?></td>
                                                    <td class="center">
                                                        <a class="tip-top" data-original-title="Clicks Report" href=""><i class="icon-comment"></i></a>&nbsp &nbsp
                                                        <a class="tip-top" data-original-title="Payment" href="auth-mpayments.php?id1=<?php echo $m->account_id ?>"><i class="icon-shopping-cart"></i></a>&nbsp &nbsp
                                                        <a class="tip-top" data-original-title="More Detail" href="auth-member_info.php?acid=<?php echo $m->account_id ?>"><i class="icon-search"></i></a>&nbsp &nbsp
                                                        <a class="tip-top" data-original-title="Block Ad" href="auth-members.php?id2=block&id1=<?php echo $m->account_id ?>"><i class="icon-off"></i></a>&nbsp &nbsp                                           
                                                        <a class="tip-top" data-original-title="Delete Ad" onclick='return getConfirmation();' href="auth-members.php?id2=del&id1=<?php echo $m->account_id ?>"><i class="icon-remove"></i></a>

                                                    </td>
                                                    <td> <?php $advsum = new advsummary($m->account_id);
                                                if ($advsum->checkRequestForUpgrade()) { ?><a href="upgrade.php?id1=<?php echo $m->account_id ?>"><i class="icon-user"></i></a>&nbsp &nbsp<?php } ?>
        <?php if ($advsum->checkRequestForWithdraw()) { ?><a href="auth-mpayments.php?id1=<?php echo $m->account_id ?>"><i class="icon-briefcase"></i></a><?php } ?>
                                                    </td>
                                                </tr>
                                            <?php }
                                        } else { ?>
                                            <tr class="gradeX">
                                                <td>No members</td>

                                            </tr>
<?php } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php
                        echo $link;
                        ?>
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

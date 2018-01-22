<?php
include("../include/include.php");
if (!$pr->getSession("admin")) {
    $pr->redirect("../index.php");
    exit();
}
if (!$read->get('acid')) {
    $pr->redirect("members.php");
}
$acid = $read->get('acid');
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
         <?php include("includes/sidebar.php");?>
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
                <h1>Detail Of Member</h1>
            </div>
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-box">
                            <div class="widget-title">
                                <span class="icon"><i class="icon-th"></i></span> 
                                <h5>Detail Of Member</h5>
                            </div>
                            <div class="widget-content nopadding">
                                <table class="table table-bordered data-table">
                                    <thead>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $member = $con->queryUniqueObject("SELECT * FROM account ac,adviewer_register ar WHERE ac.account_id=ar.account_id AND ac.account_type=2 AND ac.account_id='" . $acid . "'");
                                        if ($member) {
                                            ?>
                                            <tr class="gradeX"> 
                                                <td>First Name</td>
                                                <td><?php echo $member->first_name ?></td>
                                            </tr>
                                            <tr class="gradeX"> 
                                                <td>Last Name</td>
                                                <td><?php echo $member->last_name ?></td>
                                            </tr>
                                            <tr class="gradeX"> 
                                                <td>Gender</td>
                                                <td><?php echo $member->gender ?></td>
                                            </tr>
                                            <tr class="gradeX"> 
                                                <td>Birthday</td>
                                                <td><?php echo $member->bday ?></td>
                                            </tr>
                                            <tr class="gradeX"> 
                                                <td>Address</td>
                                                <td><?php echo $member->address ?></td>
                                            </tr>
                                            <tr class="gradeX"> 
                                                <td>Email</td>
                                                <td><?php echo $member->email ?></td>
                                            </tr>
                                            <tr class="gradeX"> 
                                                <td>Phone</td>
                                                <td><?php echo $member->phone ?></td>
                                            </tr>
                                            <tr class="gradeX"> 
                                                <td>Job</td>
                                                <td><?php echo $con->queryUniqueValue("SELECT name FROM jobs WHERE id='" . $member->job . "'") ?></td>
                                            </tr>
                                            <tr class="gradeX"> 
                                                <td>Country</td>
                                                <td><?php echo $con->queryUniqueValue("SELECT name FROM country WHERE code='" . $member->country . "'") ?></td>
                                            </tr>
                                            <tr class="gradeX"> 
                                                <td>Province/State</td>
                                                <td><?php echo $con->queryUniqueValue("SELECT name FROM state WHERE stid='" . $member->state . "'") ?></td>
                                            </tr>
                                            <tr class="gradeX"> 
                                                <td>District</td>
                                                <td><?php echo $con->queryUniqueValue("SELECT name FROM districts WHERE id='" . $member->district . "'") ?></td>
                                            </tr>
                                            <tr class="gradeX"> 
                                                <td>Register Date</td>
                                                <td><?php echo $member->register_date ?></td>
                                            </tr>
                                            <tr class="gradeX"> 
                                                <td>Account Type</td>
                                                <td><?php echo ($member->account_type == 1 ? "Main" : "Sub") ?></td>
                                            </tr>
                                            <tr class="gradeX"> 
                                                <td>Pakage</td>
                                                <td><?php
                                        if ($member->pakage == 1) {
                                            echo "Sliver";
                                        } else
                                        if ($member->pakage == 2) {
                                            echo "Gold";
                                        } else {
                                            echo "Platinum";
                                        }
                                            ?></td>
                                            </tr>


                                        <?php } else { ?>
                                            <tr class="gradeX">
                                                <td>No Member</td>

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

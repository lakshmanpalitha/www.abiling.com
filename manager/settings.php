<?php
include("../include/include.php");
if (!$pr->getSession("admin")) {
    $pr->redirect("../index.php");
    exit();
}
if ($read->get("edit_set_fee", "POST")) {

    $set->updateAdSubmitFee($read->get("fee", "POST"));
}
if ($read->get("edit_set_withdraw", "POST")) {

    $set->updateWithdrawLimit($read->get("fee", "POST"));
}
if ($read->get("edit_set_ad", "POST")) {
    $set->updateAdsRoundUser();
}
if ($read->get("edit_set_pak", "POST")) {

    $set->updatePakage();
}
if ($read->get("edit_set_referal", "POST")) {

    $set->updateReferal();
}
if ($read->get("edit_set_point", "POST")) {

    $set->updatePoints();
}
if ($read->get("edit_hold_limit", "POST")) {

    $set->updateHoldLimit();
}
if ($read->get("add_job", "POST")) {

    $set->addjob();
}
if ($read->get("edit_refer_fee", "POST")) {

    $set->addReferFee();
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
                <div id="breadcrumb">
                    <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Pay for ad</a> </div>

                </div>
                <h1>Settings</h1>

            </div>

            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-box">
                            <div class="widget-content nopadding">
                                <form action="settings.php" method="post" class="form-horizontal">
                                    <div class="form-actions">

                                        <input type="submit" name="fee_ad" value="Fee For Ad Submit" class="btn btn-success" /> 
                                        <input type="submit" name="set_ad" value="Settings Member Ads" class="btn btn-success" /> 
                                        <input type="submit" name="set_pak" value="Settings Account Type" class="btn btn-success" /> 
                                        <input type="submit" name="limit_withdraw" value="Settings Withdraw Limit" class="btn btn-success" /> 
                                        <input type="submit" name="Referal_Link" value="Settings Leferal Link" class="btn btn-success" />
                                        <input type="submit" name="panora_points" value="Settings Panora Points" class="btn btn-success" />
                                        <input type="submit" name="hold_limit" value="Account Hold Limit" class="btn btn-success" /> 
                                        <input type="submit" name="job" value="Manage Job Table" class="btn btn-success" /> 
                                          <input type="submit" name="refer_fee" value="Manage Fee For Refer Ads" class="btn btn-success" /> 
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php if ($read->get("fee_ad", "POST")) { ?>
                            <div class="span4">
                                <div class="widget-box">
                                    <div class="widget-title">
                                        <span class="icon">
                                            <i class="icon-align-justify"></i>									
                                        </span>
                                        <h5>Fee Ad Submit</h5>
                                    </div>
                                    <form action="settings.php" method="post">
                                        <div class="widget-content nopadding">
                                            <table class="table table-bordered data-table">
                                                <thead>
                                                    <tr>
                                                        <th>Fee</th>


                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <td>$ <input type="text" name="fee" value="<?php if ($fee = $set->getFeeForAdSettings())
                            echo $fee ?>" class="span6" /> </td>
                                                </tbody>
                                            </table>
                                            <div class="form-actions"> 
                                                <input type="submit" name="edit_set_fee" value="EDIT" class="btn btn-success" /> 
                                                <input type="submit" name="cancel" value="Cancel" class="btn btn-success" /> 

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($read->get("set_ad", "POST")) { ?>
                            <div class="span4">
                                <div class="widget-box">
                                    <div class="widget-title">
                                        <span class="icon">
                                            <i class="icon-align-justify"></i>									
                                        </span>
                                        <h5>Settings Member Ads</h5>
                                    </div>
                                    <?php $set_ad = $set->getAdsPerRoundSettings(); ?>
                                    <form action="settings.php" method="post">
                                        <div class="widget-content nopadding">
                                            <table class="table table-bordered data-table">
                                                <thead>
                                                    <tr>
                                                        <th>User Type</th>
                                                        <th>Number of ads per round</th>
                                                        <th>Number of days per round</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if ($set_ad) {
                                                        $i = 1;
                                                        foreach ($set_ad as $c) {
                                                            ?>
                                                            <tr class="gradeX">
                                                                <td> <input type="hidden" name="set[<?php echo $i ?>][pakage]" value="<?php echo $c->pakage; ?>" class="span6" /><?php echo $con->queryUniqueValue("SELECT name FROM settings_pakage WHERE id='" . $c->pakage . "'"); ?> member</td>
                                                                <td> <input type="text" name="set[<?php echo $i ?>][ads]" value="<?php echo $c->no_ads; ?>" class="span6" /> </td>
                                                                <td> <input type="text" name="set[<?php echo $i ?>][days]" value="<?php echo $c->no_days ?>" class="span6" /> </td>
                                                            </tr>
                                                            <?php
                                                            $i++;
                                                        }
                                                    } else {
                                                        echo"<tr class='gradeX'><td>No Settings</td></tr>";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                            <div class="form-actions"> 
                                                <input type="submit" name="edit_set_ad" value="EDIT" class="btn btn-success" /> 
                                                <input type="submit" name="cancel" value="Cancel" class="btn btn-success" /> 

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($read->get("set_pak", "POST")) { ?>
                            <div class="span4">
                                <div class="widget-box">
                                    <div class="widget-title">
                                        <span class="icon">
                                            <i class="icon-align-justify"></i>									
                                        </span>
                                        <h5>Settings User Type</h5>
                                    </div>
                                    <?php $set_pak = $set->getPakageSettings(); ?>
                                    <form action="settings.php" method="post">
                                        <div class="widget-content nopadding">
                                            <table class="table table-bordered data-table">
                                                <thead>
                                                    <tr>
                                                        <th>User Type Name</th>
                                                        <th>Fee For Register</th>


                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if ($set_pak) {
                                                        $i = 1;
                                                        foreach ($set_pak as $c) {
                                                            ?>
                                                            <tr class="gradeX">
                                                                <td> <input type="hidden" name="set[<?php echo $i ?>][pakage]" value="<?php echo $c->id; ?>" class="span6" /><input type="text" name="set[<?php echo $i ?>][name]" value="<?php echo $c->name; ?>" class="span6" /></td>
                                                                <td> $ <input type="text" name="set[<?php echo $i ?>][fee]" value="<?php echo $c->value; ?>" class="span6" /> </td>

                                                            </tr>
                                                            <?php
                                                            $i++;
                                                        }
                                                    } else {
                                                        echo"<tr class='gradeX'><td>No Settings</td></tr>";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                            <div class="form-actions"> 
                                                <input type="submit" name="edit_set_pak" value="EDIT" class="btn btn-success" /> 
                                                <input type="submit" name="cancel" value="Cancel" class="btn btn-success" /> 

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($read->get("limit_withdraw", "POST")) { ?>
                            <div class="span4">
                                <div class="widget-box">
                                    <div class="widget-title">
                                        <span class="icon">
                                            <i class="icon-align-justify"></i>									
                                        </span>
                                        <h5>Settings Withdraw</h5>
                                    </div>
                                    <?php $set_ad = $set->getWithdrawSettings(); ?>
                                    <form action="settings.php" method="post">
                                        <div class="widget-content nopadding">
                                            <table class="table table-bordered data-table">
                                                <thead>
                                                    <tr>
                                                        <th>User Type</th>
                                                        <th>Amount Limit</th>


                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if ($set_ad) {
                                                        $i = 1;
                                                        foreach ($set_ad as $c) {
                                                            ?>
                                                            <tr class="gradeX">
                                                                <td> <input type="hidden" name="set[<?php echo $i ?>][pakage]" value="<?php echo $c->id; ?>" class="span6" /><?php echo $c->name; ?> member</td>
                                                                <td> <input type="text" name="set[<?php echo $i ?>][limit]" value="<?php echo $c->w_limit; ?>" class="span6" /> </td>
                                                            </tr>
                                                            <?php
                                                            $i++;
                                                        }
                                                    } else {
                                                        echo"<tr class='gradeX'><td>No Settings</td></tr>";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                            <div class="form-actions"> 
                                                <input type="submit" name="edit_set_withdraw" value="EDIT" class="btn btn-success" /> 
                                                <input type="submit" name="cancel" value="Cancel" class="btn btn-success" /> 

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($read->get("Referal_Link", "POST")) { ?>
                            <div class="span4">
                                <div class="widget-box">
                                    <div class="widget-title">
                                        <span class="icon">
                                            <i class="icon-align-justify"></i>									
                                        </span>
                                        <h5>Settings Referal</h5>
                                    </div>
                                    <?php $set_ad = $set->getWithdrawSettings(); ?>
                                    <form action="settings.php" method="post">
                                        <div class="widget-content nopadding">
                                            <table class="table table-bordered data-table">
                                                <thead>
                                                    <tr>
                                                        <th>User Type</th>
                                                        <th>Fee per Referal</th>


                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if ($set_ad) {
                                                        $i = 1;
                                                        foreach ($set_ad as $c) {
                                                            ?>
                                                            <tr class="gradeX">
                                                                <td> <input type="hidden" name="set[<?php echo $i ?>][pakage]" value="<?php echo $c->id; ?>" class="span6" /><?php echo $c->name; ?> member</td>
                                                                <td> <input type="text" name="set[<?php echo $i ?>][limit]" value="<?php echo $c->r_amount; ?>" class="span6" /> </td>
                                                            </tr>
                                                            <?php
                                                            $i++;
                                                        }
                                                    } else {
                                                        echo"<tr class='gradeX'><td>No Settings</td></tr>";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                            <div class="form-actions"> 
                                                <input type="submit" name="edit_set_referal" value="EDIT" class="btn btn-success" /> 
                                                <input type="submit" name="cancel" value="Cancel" class="btn btn-success" /> 

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($read->get("panora_points", "POST")) { ?>
                            <div class="span4">
                                <div class="widget-box">
                                    <div class="widget-title">
                                        <span class="icon">
                                            <i class="icon-align-justify"></i>									
                                        </span>
                                        <h5>Settings Points</h5>
                                    </div>
                                    <?php $set_ad = $set->getWithdrawSettings(); ?>
                                    <form action="settings.php" method="post">
                                        <div class="widget-content nopadding">
                                            <table class="table table-bordered data-table">
                                                <thead>
                                                    <tr>
                                                        <th>User Type</th>
                                                        <th>How many ads may be click?(for one point)</th>


                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if ($set_ad) {
                                                        $i = 1;
                                                        foreach ($set_ad as $c) {
                                                            ?>
                                                            <tr class="gradeX">
                                                                <td> <input type="hidden" name="set[<?php echo $i ?>][pakage]" value="<?php echo $c->id; ?>" class="span6" /><?php echo $c->name; ?> member</td>
                                                                <td> <input type="text" name="set[<?php echo $i ?>][limit]" value="<?php echo $c->ads_p_point; ?>" class="span6" /> </td>
                                                            </tr>
                                                            <?php
                                                            $i++;
                                                        }
                                                    } else {
                                                        echo"<tr class='gradeX'><td>No Settings</td></tr>";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                            <div class="form-actions"> 
                                                <input type="submit" name="edit_set_point" value="EDIT" class="btn btn-success" /> 
                                                <input type="submit" name="cancel" value="Cancel" class="btn btn-success" /> 

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($read->get("hold_limit", "POST")) { ?>
                            <div class="span4">
                                <div class="widget-box">
                                    <div class="widget-title">
                                        <span class="icon">
                                            <i class="icon-align-justify"></i>									
                                        </span>
                                        <h5>Settings Account Hold Limit</h5>
                                    </div>
                                    <?php $set_pak = $set->getPakageSettings(); ?>
                                    <form action="settings.php" method="post">
                                        <div class="widget-content nopadding">
                                            <table class="table table-bordered data-table">
                                                <thead>
                                                    <tr>
                                                        <th>User Type Name</th>
                                                        <th>Limit($)</th>


                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if ($set_pak) {
                                                        $i = 1;
                                                        foreach ($set_pak as $c) {
                                                            ?>
                                                            <tr class="gradeX">
                                                                <td> <input type="hidden" name="set[<?php echo $i ?>][pakage]" value="<?php echo $c->id; ?>" class="span6" /><input type="text" name="set[<?php echo $i ?>][name]" value="<?php echo $c->name; ?>" class="span6" /></td>
                                                                <td> $ <input type="text" name="set[<?php echo $i ?>][hlimit]" value="<?php echo $c->hold_limit; ?>" class="span6" /> </td>

                                                            </tr>
                                                            <?php
                                                            $i++;
                                                        }
                                                    } else {
                                                        echo"<tr class='gradeX'><td>No Settings</td></tr>";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                            <div class="form-actions"> 
                                                <input type="submit" name="edit_hold_limit" value="EDIT" class="btn btn-success" /> 
                                                <input type="submit" name="cancel" value="Cancel" class="btn btn-success" /> 

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($read->get("job", "POST")) { ?>
                            <div class="span4">
                                <div class="widget-box">
                                    <div class="widget-title">
                                        <span class="icon">
                                            <i class="icon-align-justify"></i>									
                                        </span>
                                        <h5>Currunt Job</h5>
                                    </div>
                                    <?php $set_pak = $set->getPakageSettings(); ?>
                                    <form action="settings.php" method="post">
<!--                                        <div class="span12">
                                            <div class="widget-box">
                                                <div class="widget-title">
                                                    <span class="icon"><i class="icon-th"></i></span> 
                                                    <h5>Members Table</h5>
                                                </div>
                                                <div class="widget-content nopadding">
                                                    <table class="table table-bordered data-table">
                                                        <thead>
                                                            <tr>

                                                                <th>Job Name</th>
                                                                <th>Action</th>


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
                                                                        <td>sdsdsd</td>
                                                                        <td class="center">
                                                                            <a class="tip-top" data-original-title="Delete Ad" onclick='return getConfirmation();' href="settings.php?id2=del&id1=<?php echo $m->account_id ?>"><i class="icon-remove"></i></a>

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
                                        </div>-->
                                        <div class="widget-content nopadding">
                                            <table class="table table-bordered data-table">
                                                <thead>
                                                    <tr>
                                                        <th>Job Name</th>



                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <tr class="gradeX">
                                                        <td> <input type="text" name="job" value="" class="span6" /></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="form-actions"> 
                                                <input type="submit" name="add_job" value="ADD" class="btn btn-success" /> 
                                                <input type="submit" name="cancel" value="Cancel" class="btn btn-success" /> 

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php } ?>
                           <?php if ($read->get("refer_fee", "POST")) { ?>
                            <div class="span4">
                                <div class="widget-box">
                                    <div class="widget-title">
                                        <span class="icon">
                                            <i class="icon-align-justify"></i>									
                                        </span>
                                        <h5>Settings fee for ad refer member</h5>
                                    </div>
                                    <?php $set_pak = $set->getPakageSettings(); ?>
                                    <form action="settings.php" method="post">
                                        <div class="widget-content nopadding">
                                            <table class="table table-bordered data-table">
                                                <thead>
                                                    <tr>
                                                        <th>User Type Name</th>
                                                        <th>fee($)</th>


                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if ($set_pak) {
                                                        $i = 1;
                                                        foreach ($set_pak as $c) {
                                                            ?>
                                                            <tr class="gradeX">
                                                                <td> <input type="hidden" name="set[<?php echo $i ?>][pakage]" value="<?php echo $i ?>" class="span6" /><?php echo $c->name; ?> member</td>
                                                                <td> $ <input type="text" name="set[<?php echo $i ?>][fee]" value="<?php echo $c->referal_fee; ?>" class="span6" /> </td>

                                                            </tr>
                                                            <?php
                                                            $i++;
                                                        }
                                                    } else {
                                                        echo"<tr class='gradeX'><td>No Settings</td></tr>";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                            <div class="form-actions"> 
                                                <input type="submit" name="edit_refer_fee" value="EDIT" class="btn btn-success" /> 
                                                <input type="submit" name="cancel" value="Cancel" class="btn btn-success" /> 

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php } ?>


                    </div>
                </div>
                <!--				<div class="row-fluid">
					<div class="span12">
						<div class="widget-box">
							<div class="widget-title">
                                                                                <span class="icon">
                                                                                        <i class="icon-align-justify"></i>									
								</span>
								<h5>Form Elements</h5>
							</div>
							<div class="widget-content nopadding">
								<form action="#" method="get" class="form-horizontal">
									<div class="control-group">
										<label class="control-label">Basic info :</label>
										<div class="controls"><input type="text" class="span3" placeholder="First name (span3)" /> <input type="text" class="span3" placeholder="Middle name (span3)"/> <input type="text" class="span3" placeholder="Last name (span3)"/> <input type="text" class="span3" placeholder="Email ID (span3)"/></div>
									</div>
									<div class="control-group">
										<label class="control-label">Password input</label>
										<div class="controls">
                                                                                                        <input type="password"  class="span6" placeholder="Enter Password (span6)"  /> <input type="password"  class="span6" placeholder="Confirm Password (span6)"  />
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Description field:</label>
										<div class="controls">
                                                                                                        <input type="text" class="span20" placeholder="Enter Description (span20)"/>
                                                                                                        <span class="help-block">Description field</span>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Normal textarea</label>
										<div class="controls">
                                                                                                        <textarea class="span20"  placeholder="textarea (span20)" ></textarea>
										</div>
									</div>
                                                    
                                                    <div class="control-group">
										<label class="control-label">Select input</label>
										<div class="controls ">
                                                                                                        <select>
												<option>First option</option>
												<option>Second option</option>
												<option>Third option</option>
												<option>Fourth option</option>
												<option>Fifth option</option>
												<option>Sixth option</option>
												<option>Seventh option</option>
												<option>Eighth option</option>
											</select>
										</div>
									</div>
                                                    
                                                    <div class="control-group">
										<label class="control-label">Multiple Select input</label>
										<div class="controls">
                                                                                                        <select multiple>
												<option>First option</option>
												<option selected>Second option</option>
												<option>Third option</option>
												<option>Fourth option</option>
												<option>Fifth option</option>
												<option>Sixth option</option>
												<option>Seventh option</option>
												<option>Eighth option</option>
											</select>
                                                             
										</div>
									</div>
                                                    <div class="control-group">
										<label class="control-label">Radio inputs</label>
										<div class="controls">
											<label><input type="radio" name="radios" /> First One</label>
											<label><input type="radio" name="radios" /> Second One</label>
											<label><input type="radio" name="radios" /> Third One</label>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Checkboxes</label>
										<div class="controls">
											<label><input type="checkbox" name="radios" /> First One</label>
											<label><input type="checkbox" name="radios" /> Second One</label>
											<label><input type="checkbox" name="radios" /> Third One</label>
										</div>
									</div>	
                                                   <div class="control-group">
										<label class="control-label">File upload input</label>
										<div class="controls">
                                                                                                        <input type="file" />
										</div>
									</div>
                                                    <div class="control-group">
                                                        <label class="control-label">Color picker (hex)</label>
                                                        <div class="controls">
                                                            <input type="text" data-color="#ffffff" value="#ffffff" class="colorpicker input-small" />
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label">Color picker (rgba)</label>
                                                        <div class="controls">
                                                            <input type="text" data-color="rgba(344,232,53,0.5)" value="rgba(344,232,53,0.5)" data-color-format="rgba" class="colorpicker" />
                                                        </div>
                                                    </div>                                        
                                                    <div class="control-group">
                                                        <label class="control-label">Date picker</label>
                                                        <div class="controls">
                                                            <input type="text" data-date="01-02-2013" data-date-format="dd-mm-yyyy" value="01-02-2013" class="datepicker" />
                                                        </div>
                                                    </div>
                                                                                        
                                                                                        
                                                    
									<div class="form-actions">
										<button type="submit" class="btn btn-success">Save</button>
									</div>
								</form>
							</div>
						</div>						
					</div>
				</div>-->

            </div>
        </div>
    </div>
    <div class="row-fluid">
        <div id="footer" class="span12"> 2012 &copy; Marutii Admin. Brought to you by <a href="http://themedesigner.in">Themedesigner.in</a> </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.ui.custom.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-colorpicker.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/jquery.uniform.js"></script>
    <script src="js/select2.min.js"></script>
    <script src="js/maruti.js"></script>
    <script src="js/maruti.form_common.js"></script>
</body>

</html>

<?php
include("../include/include.php");
if (!$pr->getSession("admin")) {
    $pr->redirect("../index.php");
    exit();
}
if (!$id = $read->get("id1", "GET")) {

    $pr->redirect("members.php");
}
$advsum = new advsummary($id);


if ($read->get("set_upgrade", "POST")) {
    $advpay = new advpaymentclass($id);
    var_dump($advpay->updatePakage($read->get("comment", "POST"), $read->get("amount", "POST"), 1, $read->get("req", "POST")));
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
                                <form action="upgrade.php?id1=<?php echo $id ?>" method="post" class="form-horizontal">
                                    <div class="form-actions">

                                        <input type="submit" name="upgrade" value="Upgrade User Account" class="btn btn-success" /> 

                                    </div>
                                </form>
                            </div>
                        </div>

                        <?php if ($read->get("upgrade", "POST")) { ?>
                            <div class="span4">
                                <div class="widget-box">
                                    <div class="widget-title">
                                        <span class="icon">
                                            <i class="icon-align-justify"></i>									
                                        </span>
                                        <h5>Upgrade</h5>
                                    </div>
                                    <?php $upgrade = $advsum->getRequestUpgradeDetail(); ?>
                                    <form action="upgrade.php?id1=<?php echo $id ?>" method="post">
                                        <div class="widget-content nopadding">
                                            <table class="table table-bordered data-table">
                                                <thead>
                                                    <tr>






                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if ($upgrade) {
                                                        ?>
                                                        <tr class="gradeX">
                                                            <td>Currunt Pakage</th></td>
                                                            <td> <input disabled="disabled" type="text" name="a" value="<?php echo $advsum->getPakageName($advsum->getCurruntPakage()); ?>" class="span6" /></td> </tr>
                                                        <tr class="gradeX">
                                                            <td>Request Pakage</td>
                                                            <td> <input disabled="disabled" type="text" name="b" value="<?php echo $advsum->getPakageName($upgrade->req_pakage);
                                                ; ?>" class="span6" /> </td> </tr>
                                                        <tr class="gradeX">
                                                            <td>Amount</td>
                                                            <td> <input disabled="disabled" type="text" name="amount" value="<?php echo $upgrade->amount ?>" class="span6" /> </td> </tr>
                                                        <tr class="gradeX">
                                                            <td>Comment</td>      
                                                            <td> <input type="text" name="comment" value="" class="span6" /> </td>
                                                        </tr>
                                                        <?php
                                                    } else {
                                                        echo"<tr class='gradeX'><td>No request</td></tr>";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                            <div class="form-actions">

                                                <input type="hidden" name="req" value="<?php echo $upgrade->req_pakage ?>" class="span6" />
                                                <input type="hidden" name="amount" value="<?php echo $upgrade->amount ?>" class="span6" />
                                                <input type="submit" name="set_upgrade" value="Upgrade" class="btn btn-success" /> 
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

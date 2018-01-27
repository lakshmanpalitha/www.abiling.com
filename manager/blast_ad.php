<?php
error_reporting(-1);
$adtype = false;
$account_id = false;
include("../config.php");
include("../include/include.php");
if (!$pr->getSession("admin")) {
    $pr->redirect("../index.php");
    exit();
}
$ad = false;
if ($read->get("adid") || $read->get("id1")) {
    $ad = $con->queryUniqueObject("SELECT * FROM submit_ads_info ads_i,account ac WHERE ac.account_id=ads_i.account_id AND ads_id='" . $read->get("adid") . "'");
    if($ad){
    $account_id = $ad->account_id;
    }
} else {
    $pr->redirect("index.php");
}


include("spaw/spaw.inc.php");
$spaw1 = new SpawEditor("spaw1", $template);
if ($read->get("pub_info", "POST")) {
    if ($read->get("spaw1", "POST")) {
        $nads = new blastAdsclass($read->get("adid"));
        if ($nads->addToFoolInfo($read->get("spaw1", "POST"))) {
            $pr->redirect("blasted_ad.php");
        }
    }
}
if ($read->get("pub_url", "POST")) {
    $nads = new blastAdsclass($read->get("adid"));
    if ($nads->addToFoolUrl()) {
        $pr->redirect("blasted_ad.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <?php include("includes/header.php"); ?>
        <!--style for forms-->

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

        <!--Header-part-->
        <div id="header">
            <h1>Panora Admin</a></h1>
        </div>
        <!--close-Header-part--> 

        <!--top-Header-messaages-->
        <div class="btn-group rightzero"> <a class="top_message tip-left" title="Manage Files"><i class="icon-file"></i></a> <a class="top_message tip-bottom" title="Manage Users"><i class="icon-user"></i></a> <a class="top_message tip-bottom" title="Manage Comments"><i class="icon-comment"></i><span class="label label-important">5</span></a> <a class="top_message tip-bottom" title="Manage Orders"><i class="icon-shopping-cart"></i></a> </div>
        <!--close-top-Header-messaages--> 

        <!--top-Header-menu-->
        <div id="user-nav" class="navbar navbar-inverse"><ul class="nav">
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
        <!--left-menu-stats-sidebar-->    
        <!--        <div id="sidebar">
                    <div id="search">
                                   <input type="text" placeholder="Search here..."/><button type="submit" class="tip-bottom" title="Search"><i class="icon-search icon-white"></i></button>
                           </div>
                    <a href="#" class="visible-phone"><i class="icon icon-th-list"></i> Common Elements</a>
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
        <!--close-left-menu-stats-sidebar-->    
        <div id="content">
            <div id="content-header">
                <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a> <a href="#" class="current">Blast Ads</a> </div>
                <h1>Blast Ads</h1>

            </div>

            <div class="container-fluid">
                <form action="blast_ad.php" method="POST" class="form-horizontal">
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="widget-box">
                                <div class="widget-title">
                                    <span class="icon">
                                        <i class="icon-align-justify"></i>									
                                    </span>
                                    <h5>Personal-info</h5>
                                </div>
                                <div class="widget-content nopadding">

                                    <div class="control-group">
                                        <label class="control-label">Title :</label>
                                        <div class="controls"><input name="fields_req[title]" type="text" value="<?php if ($ad)
            echo $ad->title ?>" class="span20" id="title" placeholder="Title" /></div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Description :</label>
                                        <div class="controls"><input name="fields_req[description]" type="text" value="<?php if ($ad)
            echo $ad->description ?>" class="span20" id="title" placeholder="Title" /></div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Company :</label>
                                        <div class="controls">
                                            <select <?php if ($ad)
            echo "disabled='disabled'" ?> name="select">
                                                <?php
                                                $adt = $con->queryMultipleObjects("SELECT * FROM account WHERE account_type=3");
                                                if ($adt) {
                                                    foreach ($adt as $a) {
                                                        ?>
                                                        <option <?php if ($ad && $ad->account_id == $a->account_id)
                                                        echo "selected='selected'" ?> value="<?php echo $a->account_id ?>"><?php echo $a->first_name ?></option>
                                                        <?php }
                                                    } ?>
                                            </select>
                                        </div>
                                    </div>
<!--                                    <div class="control-group">
                                        <label class="control-label">No of view time :</label>
                                        <div class="controls"><input name="field_int[view_time]" type="text" value="<?php if ($ad)
                                                        echo $ad->dis_time ?>" class="span20" id="title" />
                                        </div>
                                    </div>-->
                                    <div class="control-group">
                                        <label class="control-label">Ad running period(seconds) :</label>
                                        <div class="controls"><input name="field_int[ad_run_time]" type="text" value="" class="span20" id="title" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Ad Value for <?php echo $con->queryUniqueValue("SELECT name FROM settings_pakage WHERE id=1") ?> ($) :</label>
                                        <div class="controls"><input name="field_int[rate1]" type="text" value="" class="span20" id="title" />
                                        </div>

                                        <label class="control-label">Ad Value for <?php echo $con->queryUniqueValue("SELECT name FROM settings_pakage WHERE id=2") ?>($) :</label>
                                        <div class="controls"><input name="field_int[rate2]" type="text"value="" class="span20" id="title" />
                                        </div>

                                        <label class="control-label">Ad Value for <?php echo $con->queryUniqueValue("SELECT name FROM settings_pakage WHERE id=3") ?>($) :</label>
                                        <div class="controls"><input name="field_int[rate3]" type="text"  value="" class="span20" id="title"/>
                                        </div>
                                    </div>
<!--                                    <div class="control-group">
                                        <label class="control-label">If special Display Time Shedule</label>
                                        <div id="spnp" class="controls">

                                            <label>Not Prefer</label><input type="checkbox" id="np" name="np" value="1" />

                                        </div>
                                        <div class="controls">
                                            From : <input type="text" data-date="2013-01-01" data-date-format="yyyy-mm-dd" name="fields_req[from]" value="<?php if ($ad)
                                                        echo $ad->from ?>" class="datepicker" />
                                            &nbsp;&nbsp;To : <input type="text" data-date="2013-01-01" data-date-format="yyyy-mm-dd" name="fields_req[to]" value="<?php if ($ad)
                                                        echo $ad->to ?>" class="datepicker" />
                                        </div>
                                    </div>-->
                                    <?php if ($ad->ads_type) { ?>
                                        <div class="control-group">
                                            <label class="control-label">Ad <?php echo ($ad->ads_type == 1 ? "Url" : "Designing") ?></label>
                                            <div class="controls">
                                                <?php if ($ad->ads_type == 2) { ?>
                                                    <div class="editor span20">
                                                        <?php
                                                        $spaw1->show();
                                                        ?>
                                                    </div>

                                                <?php } else { ?>
                                                    <input name="fields_req[url]" type="text" value="<?php if ($ad->url)
                                                        echo $ad->url ?>" class="span20" id="title" />
                                                       <?php } ?>

                                            </div>
                                        </div>
                                    <?php }else { ?>

                                        <div class="control-group">
                                            <label class="control-label">Ad <?php echo ($read->get("id1") == 'url' ? "Url" : "Designing") ?></label>
                                            <div class="controls">
                                                <?php if ($read->get("id1") == 'info') {
                                                    $adtype = 2; ?>
                                                    <div class="editor span20">
                                                        <?php
                                                        $spaw1->show();
                                                        ?>
                                                    </div>

                                                <?php } else {
                                                    $adtype = 1; ?>
                                                    <input name="fields_req[url]" type="text" value="<?php if ($ad->url)
                                                echo $ad->url ?>" class="span20" id="title" />
                                                       <?php } ?>

                                            </div>
                                        </div>
                                    <?php } ?>


                                </div>
                            </div>						
                        </div>
                    </div>


                    <div class="row-fluid">
                        <div class="span12">
                            <div class="widget-box">
                                <div class="widget-title">
                                    <span class="icon">
                                        <i class="icon-align-justify"></i>									
                                    </span>
                                    <h5>Set Ads Privacy</h5>
                                </div>
                                <div class="widget-content nopadding">

                                    <div class="widget-box collapsible">


                                        <div class="widget-title">
                                            <a href="#collapseOne" data-toggle="collapse">
                                                <span class="icon"><i class="icon-arrow-right"></i></span>
                                                <h5>Country</h5>
                                            </a>
                                        </div>
                                        <div class="collapse in" id="collapseOne">
                                            <div class="widget-content">
                                                <label><input id="coun_all"   value="0" type="checkbox" name="coun[]" />All</label>
                                                <?php
                                                $adsid = ($read->get("adid") ? $read->get("adid") : 'n');
                                                $adtc = $con->queryUniqueObject("SELECT * FROM submit_ads_select_crytaria WHERE ads_id='" . $ad->ads_id . "'");
                                                $all = $con->queryMultipleObjects("SELECT * FROM country");

                                                if ($all) {
                                                    foreach ($all as $a) {

                                                        $is_exist = false;
                                                        if ($adtc) {
                                                            $exsist_country = explode(",", $adtc->country);


                                                            foreach ($exsist_country as $adt) {
                                                                if (!$is_exist) {
                                                                    $is_exist = ($adt == $a->code ? "checked='checked'" : false);
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                        <label><input class="coun" <?php echo ($is_exist ? $is_exist : "") ?> value="<?php echo $a->code . "/" . $adsid ?>"type="checkbox" name="coun[]" /><?php echo $a->name ?></label>
                                                    <?php }
                                                } ?>
                                            </div>
                                        </div>
                                        <div class="widget-title">
                                            <a href="#collapseTwo" data-toggle="collapse">
                                                <span class="icon"><i class="icon-arrow-right"></i></span>
                                                <h5>Province/States</h5>
                                            </a>
                                        </div>
                                        <div class="collapse" id="collapseTwo">
                                            <div class="widget-content">
                                                <label><input id="pro_all"  value="0" type="checkbox" name="pro[]"  />All</label>
                                                <?php
                                                if ($adtc) {
                                                    $exsist_country = explode(",", $adtc->country);
                                                    $exsist_state = explode(",", $adtc->pro);

                                                    foreach ($exsist_country as $adt) {
                                                        $sates = $con->queryMultipleObjects("SELECT * FROM state  WHERE coun_code='" . $adt . "'");
                                                        foreach ($sates as $st) {
                                                            $is_exist = false;
                                                            foreach ($exsist_state as $pro) {
                                                                if (!$is_exist) {
                                                                    $is_exist = ($pro == $st->stid ? "checked='checked'" : false);
                                                                }
                                                            }
                                                            ?>
                                                            <label><input class="pro"  <?php echo ($is_exist ? $is_exist : "") ?> value="<?php echo $st->stid . "/" . $adsid ?>"type="checkbox" name="pro[]"  /><?php echo $st->name ?></label>

                                                            <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="widget-title">
                                            <a href="#collapseFore" data-toggle="collapse">
                                                <span class="icon"><i class="icon-arrow-right"></i></span>
                                                <h5>District(Only for srilanka)</h5>
                                            </a>
                                        </div>
                                        <div class="collapse" id="collapseFore">
                                            <div class="widget-content">
                                                <label><input   value="0" id="dis_all" type="checkbox" name="dis[]"  />All</label>
                                                <?php
                                                if ($adtc) {
                                                    $exsist_pro = explode(",", $adtc->pro);
                                                    $exsist_dis = explode(",", $adtc->dis);

                                                    foreach ($exsist_pro as $adt) {
                                                        $dis = $con->queryMultipleObjects("SELECT * FROM districts  WHERE pro_id='" . $adt . "'");
                                                        foreach ($dis as $d) {
                                                            $is_exist = false;
                                                            foreach ($exsist_dis as $pro) {
                                                                if (!$is_exist) {
                                                                    $is_exist = ($pro == $d->id ? "checked='checked'" : false);
                                                                }
                                                            }
                                                            ?>
                                                            <label><input  <?php echo ($is_exist ? $is_exist : "") ?> value="<?php echo $d->id ?>"type="checkbox" name="dis[]"  /><?php echo $d->name ?></label>

                                                            <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="widget-title">
                                            <a href="#collapseThree" data-toggle="collapse">
                                                <span class="icon"><i class="icon-arrow-right"></i></span>
                                                <h5>User Settings</h5>
                                            </a>
                                        </div>
                                        <div class="collapse" id="collapseThree">
                                            <div class="widget-content">
                                                <ul id="u-settings">
                                                    <li><label><input <?php echo ($adtc->account == 100 ? "checked='checked'" : "") ?> type="radio" name="pakage" value="100"/>All</label></li>
                                                    <li><label><input <?php echo ($adtc->account == 1 ? "checked='checked'" : "") ?> type="radio" name="pakage" value="1" />Silver</label></li>  
                                                    <li><label><input <?php echo ($adtc->account == 2 ? "checked='checked'" : "") ?> type="radio" name="pakage" value="2" />Gold</label></li>  
                                                    <li><label><input <?php echo ($adtc->account == 3 ? "checked='checked'" : "") ?> type="radio" name="pakage" value="3" />Platinum</label></li>  
                                                </ul>
                                                <ul id="u-settings">
                                                    <li><label><input <?php echo ($adtc->sex == 'MF' ? "checked='checked'" : "") ?> type="radio" name="gender" value="MF"/>All</label></li>
                                                    <li><label><input <?php echo ($adtc->sex == 'M' ? "checked='checked'" : "") ?> type="radio" name="gender" value="M"/>Male</label></li>
                                                    <li><label><input <?php echo ($adtc->sex == 'F' ? "checked='checked'" : "") ?> type="radio" name="gender" value="F" />Female</label></li>  

                                                </ul>
                                                <ul id="u-settings">
                                                    <li><label><input <?php echo ($adtc->grade == 100 ? "checked='checked'" : "") ?> type="radio" name="_18" value="100"/>All</label></li>
                                                    <li><label><input <?php echo ($adtc->grade == 1 ? "checked='checked'" : "") ?> type="radio" name="_18" value="1"/>18+</label></li>
                                                    <li><label><input <?php echo ($adtc->grade == 2 ? "checked='checked'" : "") ?> type="radio" name="_18" value="2" />18-</label></li>  

                                                </ul>
                                                <ul id="ujobs">
                                                    <label><input id="job_all" value="0" type="checkbox" name="job[]" />All</label>
                                                    <?php
                                                    $all = $con->queryMultipleObjects("SELECT * FROM jobs");

                                                    if ($all) {
                                                        foreach ($all as $a) {

                                                            $is_exist = false;
                                                            if ($adtc) {
                                                                $exsist_jobs = explode(",", $adtc->job);


                                                                foreach ($exsist_jobs as $adt) {
                                                                    if (!$is_exist) {
                                                                        $is_exist = ($adt == $a->id ? "checked='checked'" : false);
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                            <label><input class="job" <?php echo ($is_exist ? $is_exist : "") ?> value="<?php echo $a->id ?>"type="checkbox" name="job[]" /><?php echo $a->name ?></label>

                                                        <?php }
                                                    } ?>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                </div>     
                            </div>
                        </div>						
                    </div>

                    <div class="row-fluid">
                        <div class="span12">
                            <div class="form-actions">
                                <?php
                                if ($ad->ads_type) {
                                    $post = $ad->ads_type;
                                } else if ($adtype) {
                                    $post = $adtype;
                                }
                                ?>
                                <input name="adid" type="hidden" value="<?php echo ($read->get("adid") ? $read->get("adid") : "") ?>" class="span20" id="title" />
                                <input type="submit" value="Publish" name="<?php echo ($post == 1 ? "pub_url" : "pub_info"); ?>" class="btn btn-success"/>
                            </div>
                        </div>
                    </div>





                    <div class="row-fluid">
                        <?php if ($read->get("adid")) { ?>
                            <div class="span12">
                                <div class="widget-box">
                                    <div class="widget-title">
                                        <span class="icon">
                                            <i class="icon-align-justify"></i>									
                                        </span>
                                        <h5>Reference Ads</h5>
                                    </div>
                                    <div class="widget-content">
                                        <div class="control-group">
                                            <label class="control-label">Title :</label>
                                            <div class="controls"><h5><?php echo $ad->title; ?></h5></div>
                                        </div>
                                    </div>


                                    <div class="widget-content">
                                        <div class="control-group">
                                            <label class="control-label">description :</label>
                                            <div class="controls"><p><?php echo $ad->description; ?></p></div>                                </div>
                                    </div>

                                    <div class="widget-content">
                                        <div class="control-group">
                                            <label class="control-label">Attachment :</label>
                                            <div class="controls">
                                                <?php
                                                $file = $con->queryMultipleObjects("SELECT * FROM submit_ads_file WHERE ads_id='" . $ad->ads_id . "'");
                                                if ($file) {
                                                    foreach ($file as $f) {
                                                        ?>
                                                        <div><?php echo $f->file ?>&nbsp &nbsp <a href="<?php echo HOME ?>/uploads/<?php echo $account_id ?>/<?php echo $f->file ?>">Dowunload</a></div>

                                                        <?php
                                                    }
                                                } else {
                                                    echo "No files";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>						
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <div class="row-fluid">
        <div id="footer" class="span12"> 2012 &copy;<a href="http://www.microsola.com">www.microsola.com</a> </div>
    </div>
    <?php include "includes/footerjs.php"; ?> 
    <!--scripts for forms-->
    <script src="js/bootstrap-colorpicker.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/jquery.uniform.js"></script>
    <script src="js/select2.min.js"></script>
    <script src="js/maruti.js"></script>
    <script src="js/maruti.form_common.js"></script>
    <script src="../js/sitescripts.js"></script>
    <script src="../js/main.js"></script>
</body>

</html>

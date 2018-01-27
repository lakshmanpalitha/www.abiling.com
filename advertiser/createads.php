<?php
include("../include/include.php");
if (!$pr->getSession("adt")) {
    $pr->redirect("../index.php");
    exit();
}
if ($read->get("next_stp2", "POST")) {
    if ($id = $ads->addAds()) {

        $pr->redirect("createads2.php?id1=" . $id);
    }
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
        <title>Submit Ad</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <?php include ("../include/header_css.php"); ?>
        <link rel="stylesheet" type="text/css" href="../css/submit_ads.css">
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
                    <div class="views float-l"><p>Submit Ad Information </p></div>
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
                        <form method="post" action="createads.php" enctype='multipart/form-data' >
                            <div class="containt">
                                <h3>Basic Information</h3>
                                <div class="input-block">
                                    <label>Add Title</label>
                                    <input value="" name="fields_req[title]" type="text" maxlength="25" >(25 characters only)
                                </div>
                                <div class="input-block">
                                    <label>Dicription</label>
                                    <textarea name="fields_req[description]" cols="5" rows="2" maxlength="50"></textarea>(50 characters only)
                                </div>
                                <div class="input-block">
                                    <label>Ads Type</label>
                                    <label>Url</label><input checked="checked" type="radio" name="ads_type" value="1" class="ad_type" />
                                    <label>Info</label><input type="radio" name="ads_type" value="2" class="ad_type" />
                                </div>
                                <h3>Add Your Ad Info</h3>
                                <div class="input-block">
                                    <div id="url"  class="input-block">
                                        <label>Add Url</label>
                                        <input value="" name="url" type="text" placeholder="Ex : http://www.example.com">(Ex: YouTube ,Website)
                                        <input type="hidden" value="1" name="ad_type"/>
                                    </div>

                                    <div id="info" style="display: none;" class="input-block file-upload">
                                        <input type='button' class="add-remove-bouuon" value='Add +' id='addButton'>
                                        <input type='button' class="add-remove-bouuon" value='Remove -' id='removeButton'>
                                        <div style="clear:both;"></div>
                                        <div id='TextBoxesGroup'>
                                            <div id="TextBoxDiv1" class="TextBoxDiv">
                                                <label>File #1 : </label> <input name="file[]" type="file" id='textbox1'>
                                            </div>
                                        </div>
                                    </div>
                                </div>
<!--                                <h3>Select  Your Ads Display Durations</h3>
                                <div id="spf_t" class="input-block">

                                    <label>Not Specify</label><input type="checkbox" id="np" name="np" value="1" />

                                </div>
                                <div class="input-block">
                                    <div class="sub_block"><label>Frome Date</label><input placeholder="2013-01-01" id="from" value="" class="datepicker" name="fields_req[from]" type="text"></div>
                                    <div class="sub_block"><label>To Date</label><input  placeholder="2013-02-01" id="to" value="" class="datepicker" name="fields_req[to]" type="text"></div>
                                </div>

                                <h3>No of time ad view for single user</h3>
                                <div class="input-block">
                                    <div class="sub_block"><label>No of time</label>
                                        <select name="field_int_req[dis_time]" id="gender">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>

                                    </div>
                                </div>-->




                                <div class="submit_block">
                                    <input name="next_stp2" class="next-btn" value="Next" type="submit">
                                </div>
                        </form>

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

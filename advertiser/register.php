<?php
include("../include/include.php");
if ($read->get("loginFormSubmit", "POST")) {
    $adt->register();
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
        <title>Register</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <?php include ("../include/header_css.php"); ?>
        <link rel="stylesheet" type="text/css" href="../css/advertiser_regisstor.css">
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
                    <div class="views float-l"><p>Advertiser Registration </p></div>

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
                    if ($read->get("isin", "POST")) {

                        $fromValue = $er->getFromValue();
                    } else {
                        $fromValue = false;
                    }
                    ?>
                </div> 
                <div id="left-col">
                    <div class="containt-block">

                        <form method="post" action="" >
                            <div class="containt">
                                <div class="input-block">
                                    <label>Company Name</label>
                                    <input tabindex="1" value="<?php if ($fromValue)
                        echo $fromValue['first_name']; ?>" name="fields_req[first_name]" type="text">
                                </div>

                                <div class="input-block">
                                    <label>Address</label>
                                    <input tabindex="2" value="<?php if ($fromValue)
                                               echo $fromValue['address']; ?>" class="mid_size left" name="fields_req[address]" type="text">

                                    <input tabindex="3" value="<?php if ($fromValue)
                                               echo $fromValue['address2']; ?>" class="mid_size Right" name="fields[address2]" type="text">


                                </div>
                                <div class="input-block">
                                    <label>eMail Address</label>
                                    <input tabindex="4" value="<?php if ($fromValue)
                                               echo $fromValue['email']; ?>" name="field_email_req[email]" type="text">
                                </div>
                                <div class="input-block">
                                    <label>Phone</label>
                                    <input  tabindex="5" value="<?php if ($fromValue)
                                               echo $fromValue['phone']; ?>"  placeholder="+94112000000" name="fields_req[phone]" type="text">
                                </div>
                                <div class="input-block">
                                    <label>User Name</label>
                                    <input tabindex="6" value="<?php if ($fromValue)
                                                echo $fromValue['user_name']; ?>" name="fields_req[user_name]" type="text">
                                </div>
                                <div class="input-block">
                                    <label>password</label>
                                    <input  tabindex="7" name="fields_req[password]" type="password">
                                </div>
                                <div class="input-block">
                                    <label>Retype password</label>
                                    <input tabindex="8" name="repassword" type="password">
                                </div>
                                <div class="submit-block">
                                    <input  tabindex="9" class="green" name="loginFormSubmit" type="submit" value="Registor">
                                    <input type="hidden" tabindex="8" value="1" class="validate[required] mid_size Right" name="isin" type="text"/>
                                </div>


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

<?php
include("../include/include.php");
if ($read->get("mem_reg_form", "POST")) {
    $accountType = 1;
    if (!$val = $adv->setUser($accountType)) {
        $pr->redirect("../members/register.php");
    }
    $id1 = $en->encode($val[0]);
    $id2 = $en->encode(198853);
    $id3 = $en->encode($val[1]);
    //$pr->redirect("../payment/payment.php?id1=" . $id1 . "&id2=" . $id2 . "&id3=" . $id3);
}

if ($id = $read->get("id1", "GET")) {
    $advsum = new advsummary($en->decode($id));

    if ($advsum->getMemberDetail()) {
        $pr->craeteSession("referal", $en->decode($id));
    }
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]--><head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <?php include ("../include/header_css.php"); ?>
        <link rel="stylesheet" type="text/css" href="../css/user_registration.css">

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
                    <div class="views float-l"><p>Member Registration </p></div>

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
                    if ($read->get("isin", "POST")) {

                        $fromValue = $er->getFromValue();
                    } else {
                        $fromValue = false;
                    }
                    ?>
                </div> 
                <div id="left-col">
                    <div class="containt-block">

                        <form method="post" action="register.php" id="user_registration_form" >
                            <div class="containt">
                                <div class="input-block">
                                    <label>First Name*:</label>
                                    <input tabindex="1"  value="<?php if ($fromValue)
                        echo $fromValue['first_name'];
                    ?>" class="validate[required]" name="fields_req[first_name]" type="text">
                                </div>

                                <div class="input-block">
                                    <label>Last Name*:</label>
                                    <input tabindex="2" value="<?php if ($fromValue)
                                               echo $fromValue['last_name'];
                    ?>" class="validate[required]" name="fields_req[last_name]" type="text">
                                </div>

                                <div class="input-block">
                                    <label>User Name*:</label>
                                    <input tabindex="3" value="<?php if ($fromValue)
                                               echo $fromValue['user_name'];
                    ?>" class="validate[required]" name="fields_req[user_name]" type="text">
                                </div>

                                <div class="input-block">
                                    <label>eMail Address*:</label>
                                    <input tabindex="4" value="<?php if ($fromValue)
                                               echo $fromValue['email'];
                    ?>" class="validate[required,custom[email]]" name="field_email_req[email]" type="text">
                                </div>


                                <div class="input-block">
                                    <label>password*:</label>
                                    <input tabindex="5" class="validate[required]" name="fields_req[password]" id="password" type="password">
                                </div>

                                <div class="input-block">
                                    <label>Confirm Password*:</label>
                                    <input tabindex="6" class="validate[required,equals[password]]" name="fields_req[repassword]" type="password">
                                </div>

                                <div class="input-block">
                                    <label>Mobile*:</label>
                                    <input tabindex="7" value="<?php if ($fromValue)
                                               echo $fromValue['phone'];
                    ?>" class="validate[required]" placeholder="+94112000000" name="fields_req[phone]" type="text">
                                </div>



                                <div class="input-block">
                                    <label>Address*:</label>
                                    <input tabindex="7" value="<?php if ($fromValue)
                                               echo $fromValue['address'];
                    ?>" class="validate[required] mid_size left" name="fields_req[address]" type="text">

                                    <input tabindex="8" value="<?php if ($fromValue)
                                               echo $fromValue['address2'];
                    ?>" class="validate[required] mid_size Right" name="fields[address2]" type="text">
                                </div>

                                <div class="input-block">
                                    <label>Job/Title <span>*</span>:</label>

                                    <select tabindex="9" name="field_int_req[job]" id="title">
                                        <option value="">-Select Job-</option>
                                        <?php
                                        $jobs = $con->queryMultipleObjects("SELECT * FROM jobs");
                                        if ($jobs) {
                                            foreach ($jobs as $j) {
                                                ?>
                                                <option value="<?php echo $j->id ?>"><?php echo $j->name ?></option>
    <?php }
}
?>
                                    </select>
                                </div>



                                <div class="input-block">
                                    <label>Country <span>*</span>:</label>
                                    <select tabindex="10" name="fields_req[country]" id="cuntry">
                                        <option value="">-Select Country-</option>
<?php
$country = $con->queryMultipleObjects("SELECT * FROM country");
if ($country) {
    foreach ($country as $c) {
        ?>
                                                <option value="<?php echo $c->code ?>"><?php echo $c->name ?></option>
    <?php }
}
?>
                                    </select>
                                </div>



                                <div class="input-block">
                                    <label>Province / Status:</label>
                                    <select tabindex="11" name="fields_req[state]" id="sta">
                                        <option value="">-Select Province/State-</option>
<?php
$state = $con->queryMultipleObjects("SELECT * FROM state");
if ($state) {
    foreach ($state as $s) {
        ?>
                                                <option value="<?php echo $s->stid ?>"><?php echo $s->name ?></option>
                                            <?php }
                                        }
                                        ?>

                                    </select>
                                </div>

                                <div class="input-block">
                                    <label>District:</label>
                                    <select tabindex="12" name="fields_req[district]" id="dis">
                                        <option value="">-Select District-</option>
<?php
$districts = $con->queryMultipleObjects("SELECT * FROM districts");
if ($districts) {
    foreach ($districts as $d) {
        ?>
                                                <option value="<?php echo $d->id ?>"><?php echo $d->name ?></option>
                                               <?php }
                                           }
                                           ?>
                                        <option value="0">-Other-</option>
                                    </select>
                                </div>


                                <div class="input-block">
                                    <label>Birthday:</label>
                                    <input tabindex="13" value="<?php if ($fromValue)
                                               echo $fromValue['bday'];
                                           ?>" class="validate[required] datepicker" name="fields_req[bday]" type="text">
                                </div>

                                <div class="input-block">
                                    <label>Gender:</label>
                                    <select tabindex="14" name="fields_req[gender]" id="gender">
                                        <option value="">-Select Gender-</option>
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                    </select>
                                </div>

                                <div class="input-block">
                                    <label>Select User Type :</label>
                                    <select tabindex="15" name="field_int_req[pakage]" id="user-type">
                                        <option value="">-Select User Type-</option>
<?php
$pak = $set->getPakageSettings();
if ($pak) {

    foreach ($pak as $p) {
        ?>

                                                <option value="<?php echo $p->id ?>"><?php echo $p->name ?> ($ <?php echo $p->value ?>  Per Year)</option>

    <?php }
}
?>
                                    </select>
                                </div>
                                <div class="submit-block">
                                    <input tabindex="16" class="green" name="mem_reg_form" type="submit" value="Registor">
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

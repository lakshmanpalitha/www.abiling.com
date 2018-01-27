<?php
include("../include/include.php");
/*if (!$pr->getSession("adv")) {
    $pr->redirect("../index.php");
    exit();
}*/
if ($read->get("action", "GET") == 'logout') {
    $adv->logout();
}
if (!$user = $adv->getUser()) {
    
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

<head>
 <?php include ("meta.php"); ?>
<?php include ("../include/header_css.php"); ?>
<link rel="stylesheet" type="text/css" href="../css/privacypolicy.css">
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
    <div class="views float-l">
      <p>Privacy Policy</p>
    </div>
    
  </div>
  <div id="mid-col">
    <div class="containt-block">
      <div class="containt">
        <div class="privacypolicy-wrapper">
        <p>This privacy policy regards how we store and deal with your user information.</p>
       <p> As a registered user at Panora Advertising, you have agreed to have read, understood, and accepted the following terms and conditions of this Privacy Policy.</p>
        	<ul class="privacypolicylist">
            	<li>Your browser must accept cookies.</li>
                <li>Cookies will only be used to store your preferences.</li>
                </ul>
                
                <ul class="privacypolicylist">
                <li>Your email addresses will not be shown, given or sold.</li>
                <li>Your personal email address will only be used for Panora Advertising to communicate with you and to send you a new password in case you request it.</li>
                <li>Your payment processor email addresses will only be used for us to send you your requested payments and to confirm what you purchase.</li>
                </ul>
                <ul class="privacypolicylist">
                <li>Your user password will be stored in an irreversible format.</li>
                <li>Your user password will never be shown, sold or given.</li>
                </ul>
                <ul class="privacypolicylist">
                <li>Your username will be kept hidden by default from other users if you sign up without a referrer.</li>
                <li>Your username will be shown by default to other users if you sign up under a referrer.</li>
                <li>Regardless of the default setting, you will still be able to override the display status at any time.</li>
                <li>Regardless of the setting you have, your username will always be displayed in the Forum.</li>
                </ul>
                <ul class="privacypolicylist">
                <li>Panora Advertising is not responsible for any of the contents in advertisements shown at it's website. This applies to all advertisement information we may display.</li>
                <li>It's your responsibility when you click an advertisement link, click a link inside the advertisement page or browse its contents.</li>
                <li>All advertisements are the responsibility of its advertiser and you must comply to their own Terms of Service and Privacy Policies.</li>
                </ul>
           
        
        
        
        </div>
      </div>
    </div>
  </div>
</div>
<div id="main-footer-wrapper">
  <div id="main-footer">
    <?php include ("../include/main_footer.php");?>
  </div>
</div>
<?php include ("../include/footer_js.php"); ?>
</body>
</html>
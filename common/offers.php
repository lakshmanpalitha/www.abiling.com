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
<link rel="stylesheet" type="text/css" href="../css/offers.css">
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
      <p>Offers</p>
    </div>
    
  </div>
  <div id="mid-col">
    <div class="containt-block">
      <div class="containt">
        <div class="offers-wrapper">
        
        offers will update soon.
         
        
        
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
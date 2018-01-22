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
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title></title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width">
<?php include ("../include/header_css.php"); ?>
<link rel="stylesheet" type="text/css" href="../css/contactus.css">
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
      <p>Contact us</p>
    </div>
    
    
  </div>
  <div id="mid-col">
    <div class="containt-block">
      <div class="containt">
        <div class="contact-wrapper">
 
<p>Please contact us for further information and you can order your products by contacting </p>

<div id="main-content">
  <h2>&nbsp;</h2>
  <div id="adres">
    <table border="0" align="left" cellpadding="0" cellspacing="0">
      <tr>
        <td width="650" align="left" valign="top"><img src="../images/rads/ad1.jpg" width="650" height="100"></td>
        <td width="28" align="left" valign="top">&nbsp;</td>
        <td width="262" align="left" valign="top">&nbsp;</td>
        </tr>
     
    </table>
    
    <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
      <tr>
        <td width="100" align="left" valign="top"><img src="../images/rads/ad3.jpg" width="100" height="650"></td>
        <td width="40" align="left" valign="top">&nbsp;</td>
        <td width="800" align="left" valign="top">&nbsp;</td>
        </tr>
     
    </table>
    
    <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
      <tr>
        <td width="250" align="left" valign="top"><img src="../images/rads/ad2.jpg" alt="" width="250" height="250"></td>
        <td width="428" align="left" valign="top">&nbsp;</td>
        <td width="262" align="left" valign="top">&nbsp;</td>
        </tr>
     
    </table>
    
    <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
      <tr>
        <td width="120" align="left" valign="top"><img src="../images/rads/ad4.jpg" width="120" height="120"></td>
        <td width="23" align="left" valign="top">&nbsp;</td>
        <td width="797" align="left" valign="top">&nbsp;</td>
        </tr>
     
    </table>
    
    






  </div>
  <div></div>
</div>


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
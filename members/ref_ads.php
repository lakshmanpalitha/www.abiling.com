<?php
include("../include/include.php");
if (!$pr->getSession("adv")) {
    $pr->redirect("../index.php");
    exit();
}
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
      <p>Referal Links</p>
    </div>
    
    
  </div>
  <div id="mid-col">
    <div class="containt-block">
      <div class="containt">
        <div class="contact-wrapper">
 


<div id="main-content">

  <div id="adres">
  <table width="94%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="28%" align="center" valign="top"><img src="../images/rads/ad2.jpg" alt="" width="250" height="250" /></td>
    <td width="1%" align="center" valign="top">&nbsp;</td>
    <td width="71%" align="left" valign="top"><textarea name="textarea" id="textarea" cols="45" rows="5"><a href="<?php echo $path?>/members/register.php?id1?<?php echo $en->encode($pr->getSession("advac")) ?>"><img src="<?php echo $path?>/images/rads/ad2.jpg" alt="" width="250" height="250" /></a></textarea></td>
    </tr>
  <tr>
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" valign="top"><img src="../images/rads/ad4.jpg" alt="" width="120" height="120" /></td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="left" valign="top"><textarea name="textarea2" id="textarea2" cols="45" rows="5"><a href="<?php echo $path?>/members/register.php?id1?<?php echo $en->encode($pr->getSession("advac")) ?>"><img src="<?php echo $path?>/images/rads/ad4.jpg" alt="" width="120" height="120" /></a></textarea></td>
  </tr>
  <tr>
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" valign="top"><img src="../images/rads/ad3.jpg" alt="" width="100" height="650" /></td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="left" valign="top"><textarea name="textarea3" id="textarea3" cols="45" rows="5"><a href="<?php echo $path?>/members/register.php?id1?<?php echo $en->encode($pr->getSession("advac")) ?>"><img src="<?php echo $path?>/images/rads/ad3.jpg" alt="" width="100" height="650" /></a></textarea></td>
  </tr>
  <tr>
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
</table>

  
  </div>

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
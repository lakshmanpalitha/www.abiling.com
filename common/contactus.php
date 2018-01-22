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

<?php


if(isset($_POST['rq_bt']))
{
	$to = "lakshmanpalitha@gmail.com";
$subject = "Panora advertising Contact us page mail.";
$message = $_POST['comment'];

$headers = "From: ".$_POST['mail']."\r\n";
$headers .= "Reply-To: ".$_POST['mail']."\r\n";
//$headers .= "Return-Path: myplace@here.com\r\n";

$headers .= "Name:-  ".$_POST['name']."\r\n";
$headers .= "Phone:-   ".$_POST['phone']."\r\n";

	
	
	
	
	if (mail($to,$subject,$message,$headers))
	{
	   $msg =  "The request has been sent!";
	}
	else
	{
		$error =  "The request has failed!  Please try again.";
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
    <table border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="34%" align="left" valign="top">
        <address>
        	Panora Advertising (pvt) LTD.<br>

            Walawa<br>
Ambalantota
        </address>
        <address>
        Sri Lanka
        </address></td>
        <td width="66%" align="left" valign="top"><table width="300" border="0" cellpadding="2" cellspacing="0">
          <tr>
            <td width="89" align="left" valign="top"><strong>Tel</strong></td>
            <td width="249" align="left" valign="top">phone : +94 47-2225662  <br />
              mobile : +94 77-1059210 </td>
           
            </tr>
          <tr>
            <td align="left" valign="top"><strong>email</strong></td>
            <td align="left" valign="top">info@panoraadvertising.com</td>
          </tr>
          <tr>

            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>

           
          </tr>
          <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table>
    <?php if(!empty($msg))
{
	echo '<br /><div style="; text-align: center; color:#104B18; padding:10px; background-color: #D0EED1; border: 1px solid #208832; font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif;">'.$msg.'</div>';
}
else if(!empty($error))
{
	echo '<br /><div style=" text-align: center; padding:10px; color:#F00; background-color: #FDE8E8; border: 1px solid #EA0000; font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif;">'.$error.'</div>';
}
?>
    <table border="0" align="left" cellpadding="0" cellspacing="0">
      <tr>
        <td width="442"><form id="vehiclelead" action="" method="post"><table width="442" border="0" cellpadding="3" cellspacing="3">
          <tr>
            <td align="left" valign="top" class="text2">Name</td>
            <td align="left" valign="top" class="text7"><label for="name"></label>
              <input name="name" type="text" class="test_box validate[required]" id="name" size="50" /></td>
          </tr>
          <tr>
            <td width="82" align="left" valign="top" class="text2"><span class="test_6"> Email</span></td>
            <td width="343" align="left" valign="top" class="text7"><input name="mail" type="text" class="test_box validate[required,custom[email]]"<?php if(!empty($rmail)){echo "value='".$rmail."'"; } ?> id="mail2" size="50" /></td>
          </tr>
          <tr>
            <td align="left" valign="top" class="text2"><span class="test_6">Phone Number</span></td>
            <td align="left" valign="top" class="text7"><input name="phone" type="text" class="test_box" id="phone2" size="50" /></td>
          </tr>
          <tr>
            <td align="left" valign="top" class="text2"><span class="test_6">Comment</span></td>
            <td align="left" valign="top" class="text7"><textarea name="comment" cols="45" rows="5" class="test_box" id="comment"></textarea>
              <br /></td>
          </tr>
          <tr>
            <td class="text2">&nbsp;</td>
            <td align="right"><input type="submit" name="rq_bt" id="rq_bt" value="Send" /></td>
          </tr>
        </table></form></td>
        <td width="38" align="left" valign="top">&nbsp;</td>
        <td width="720" align="left" valign="top"><iframe width="500" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps/ms?msid=216709232734775906943.0004dbe34922a273cde5e&amp;msa=0&amp;ie=UTF8&amp;t=m&amp;ll=6.148918,81.047859&amp;spn=0.083801,0.169086&amp;output=embed"></iframe><br /><small>View <a href="https://maps.google.com/maps/ms?msid=216709232734775906943.0004dbe34922a273cde5e&amp;msa=0&amp;ie=UTF8&amp;t=m&amp;ll=6.148918,81.047859&amp;spn=0.083801,0.169086&amp;source=embed"></iframe></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td></td>
        <td>
        </td>
  </tr>
    </table>
</div>
  <div>
    <table width="531" border="0" align="left" cellpadding="0" cellspacing="0">
      <tr>
        <td>
          <table width="400" border="0" cellpadding="3" cellspacing="3">
            <tr> </tr>
            <tr> </tr>
            <tr> </tr>
            <tr> </tr>
          </table>
        </td>
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
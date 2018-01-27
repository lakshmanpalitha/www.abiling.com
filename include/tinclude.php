<?php

session_start();
error_reporting(0);
include('../../classes/utiliti/db.class.php');
include('../../classes/utiliti/process.class.php');
include('../../classes/utiliti/read.class.php');
include('../../classes/utiliti/sessionManager.class.php');
include('../../classes/utiliti/query.class.php');
include('../../classes/utiliti/validation.class.php');
include('../../classes/utiliti/error.class.php');
include('../../classes/utiliti/encrypt.class.php');
include('../../classes/utiliti/email.class.php');
include('../../classes/account/adtaccount.class.php');
include('../../classes/account/advaccount.class.php');
include('../../classes/account/advadload.class.php');
include('../../classes/account/advclickads.class.php');
include('../../classes/account/advsummary.class.php');
include('../../classes/account/mgtaccount.class.php');
include('../../classes/account/adtsummary.class.php');
include('../../classes/account/advpayment.class.php');
include('../../classes/adsmanage/ads.class.php');
include('../../classes/adsmanage/adsmanage.class.php');
include('../../classes/adsmanage/adsinfo.class.php');
include('../../classes/payment/payment.class.php');
include('../../classes/adsmanage/blastAds.class.php');
include('../../classes/settings/settings.class.php');
include('../../classes/history/history.class.php');

$con = new DB();
$read = new read();
$pr = new process();
$se = new sessionManager();
$er = new errormsg();
$qu = new query();
$val = new validation();
$adt = new adtclass();
$adv = new advclass();
$advad = new advadloadclass();
$advcad = new advclickads();
$mgt = new mgtclass();
$ads = new adsclass();
$pay = new paymentclass();
$bads = new blastAdsclass();
$en = new Encryption();
$advsum = new advsummary();
$adsmanage = new adsmanageclass();
$adsinfo = new adsinfoclass();
$set=new settings();
$adtsum=new adtsummary();
$his=new history();
$advpay=new advpaymentclass();
$email = new email();
?>
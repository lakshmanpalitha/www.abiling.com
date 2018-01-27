<?php
//error_reporting(-1);
include("../include/include.php");
$massage = "<html><body>";
$massage.="<p>Add Loading Capture Email-start</p></br>";
$massage.="<p>Crone Job Start</p></br>";
$massage.= "</body></html>";
$email->setEmail('lakmalwimaladasa@gmail.com,panoraads@gmail.com,itmicrosola@gmail.com', "Add Blast", $massage);
$email->send();


date_default_timezone_set('Asia/Calcutta');
$date = date('Y-m-d', strtotime('-7 days'));
//var_dump($date);
$acid = $con->queryMultipleObjects("SELECT account_id FROM adviewer_register WHERE round_date <= '" . $date . "'");
//var_dump($acid);
if ($acid) {
    $i = 1;
    foreach ($acid as $id) {
        $advad = new advadloadclass($id->account_id);
        $advad->checkAdsRound();
        //avar_dump($id->account_id);
        $i++;
    }
} else {
    $i = 0;
}

$massage = "<html><body>";
$massage.="<p>Add Loading Capture Email-end</p></br>";
$massage.="<p>Add Load Time:" . date('Y-m-d h:m:s') . "</p></br>";
$massage.="<p>Check Date:" . $date . "</p></br>";
$massage.="<p>Affected No Of Users :" . $i . "</p></br>";
$massage.= "</body></html>";
$email->setEmail('lakmalwimaladasa@gmail.com,panoraads@gmail.com,itmicrosola@gmail.com', "Add Blast", $massage);
$email->send();
?>
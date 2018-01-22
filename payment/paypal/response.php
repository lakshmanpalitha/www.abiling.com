<?php

include("../../include/tinclude.php");
// Response from Paypal
// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';
foreach ($_POST as $key => $value) {
    $value = urlencode(stripslashes($value));
    $value = preg_replace('/(.*[^%^0^D])(%0A)(.*)/i', '${1}%0D%0A${3}', $value); // IPN fix
    $req .= "&$key=$value";
}

// assign posted variables to local variables
if (!$_POST['item_name'] && !$_POST['item_number']) {
    $pr->redirect("payment-cancel.php");
}
$data['item_name'] = $_POST['item_name'];
$data['item_number'] = $_POST['item_number'];
$data['payment_status'] = $_POST['payment_status'];
$data['payment_amount'] = $_POST['mc_gross'];
$data['payment_currency'] = $_POST['mc_currency'];
$data['txn_id'] = $_POST['txn_id'];
$data['receiver_email'] = $_POST['receiver_email'];
$data['payer_email'] = $_POST['payer_email'];
$data['custom'] = $_POST['custom'];

// post back to PayPal system to validate
$header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Host: www.sandbox.paypal.com\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";

$fp = fsockopen('https://www.sandbox.paypal.com', 80, $errno, $errstr, 30);

if (!$fp) {
    echo "ftp ERROR";
} else {

    sfputs($fp, $header . $req);
    while (!feof($fp)) {
        $res = fgets($fp, 1024);
        if (strcmp($res, "VERIFIED") == 0) {
            if ($data['item_name'] = "Reg") {
                $advpay = new advpaymentclass($data['item_number']);
                $advpay->insertAdviewerCashbook("Successfyl PayPal Payment", $data['payment_amount'], 2, $data['txn_id']);
                $advpay->updateReg();
            } else if ($data['item_name'] = "Sub_Reg") {
                $advpay = new advpaymentclass($data['item_number']);
                $advpay->insertAdviewerCashbook("Successfyl PayPal Payment", $data['payment_amount'], 2, $data['txn_id']);
                $advpay->updateReg();
            } else if ($data['item_name'] = "Up_fee") {
                $advpay = new advpaymentclass($data['item_number']);
                $advpay->updatePakage("Successfyl PayPal Payment", $data['payment_amount'], 2, $data['txn_id']);
            } else if ($data['item_name'] = "In_fee") {
                $ads->setAdvertiserCashbook($data['item_number'], 1, $data['payment_amount'], 2, "Successful PayPal Payment", $data['txn_id']);
            }

            $pr->redirect("../success.php?id1=" . $en->encode(2));
        } else if (strcmp($res, "INVALID") == 0) {

            $pr->redirect("payment-cancel.php");
        }
    }
    fclose($fp);
}
?>


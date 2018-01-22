<?php

$pr = new process();
// Database variables
$querystring = false;

// PayPal settings
$paypal_email = 'panoraads@gmail.com';
$return_url = 'http://localhost/MICROSOLA/www.panora.com/payment/paypal/response.php';
$cancel_url = 'http://localhost/MICROSOLA/www.panora.com/payment/paypal/payment-cancel.php';
$notify_url = 'http://localhost/MICROSOLA/www.panora.com/payment/paypal/payments.php';

//$return_url = 'http://microsola.com/preview/panoraadvertising/web/payment/paypal/response.php';
//$cancel_url = 'http://microsola.com/preview/panoraadvertising/web/payment/paypal/payment-cancel.php';
//$notify_url = 'http://microsola.com/preview/panoraadvertising/web/payment/paypal/payments.php';

$item_name = $_POST["item_name"];
$item_amount = $_POST["amount"];

// Include Functions
include("functions.php");

//Database Connection
// Check if paypal request or response
if (!isset($_POST["txn_id"]) && !isset($_POST["txn_type"])) {

    // Firstly Append paypal account to querystring
    $querystring .= "?business=" . urlencode($paypal_email) . "&";

    // Append amount& currency (£) to quersytring so it cannot be edited in html
    //The item name and amount can be brought in dynamically by querying the $_POST['item_number'] variable.
    $querystring .= "item_name=" . urlencode($item_name) . "&";
    $querystring .= "amount=" . urlencode($item_amount) . "&";

    //loop for posted values and append to querystring
    foreach ($_POST as $key => $value) {
        $value = urlencode(stripslashes($value));
        $querystring .= "$key=$value&";
    }

    // Append paypal return addresses
    $querystring .= "return=" . urlencode(stripslashes($return_url)) . "&";
    $querystring .= "cancel_return=" . urlencode(stripslashes($cancel_url)) . "&";
    $querystring .= "notify_url=" . urlencode($notify_url);

    // Append querystring with custom field
    //$querystring .= "&custom=".USERID;
    // Redirect to paypal IPN
    $pr->redirect('https://www.sandbox.paypal.com/cgi-bin/webscr' . $querystring);
    exit();
} else {

    // Response from Paypal
    // read the post from PayPal system and add 'cmd'
    $req = 'cmd=_notify-validate';
    foreach ($_POST as $key => $value) {
        $value = urlencode(stripslashes($value));
        $value = preg_replace('/(.*[^%^0^D])(%0A)(.*)/i', '${1}%0D%0A${3}', $value); // IPN fix
        $req .= "&$key=$value";
    }

    // assign posted variables to local variables
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
    $header .= "Content-Length: " . strlen($req) . "\r\n\r\n";

    $fp = fsockopen('http://www.sandbox.paypal.com', 80, $errno, $errstr, 30);

    if (!$fp) {
        // HTTP ERROR
    } else {

        fputs($fp, $header . $req);
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

                $pr->redirect("../success.php?id1=" . $en->encode($read->get("id1")));
            } else if (strcmp($res, "INVALID") == 0) {
                $pr->redirect("payment-cancel.php");
            }
        }
    }
}
?>
<?php

include("../include/include.php");
if ($read->get("checkout", "POST")) {
    $amount = $read->get("amount", "POST");
    $refid = $read->get("item_number", "POST");
    $pafor = $read->get("payfor", "POST");
    $pay_type = $read->get("pay", "POST");

    if ($pay_type == 1) {
        if ($pafor == 199053) {
            $pay->upgradeAccount($refid, $read->get("pak", "POST"), $amount);
            $this->er->createerror("Register Successfully", 0);
            $mem = $advsum->getMemberDetail();
            $message = '<html><body>';
            $massage.= "<p>Hello! Welcome to the best advertising provider panoraadvertising.com!</p></br>";
            $massage.= "<p>We 've received your request. You can expect a response within 24 hours.</p></br>";
            $massage.= "<p>If you have got any doubt you can send a mail to info@panoraadvertising.com</p></br>";
            $massage.= "<p>Thanks and Regards,</p></br>";
            $massage.= "<p>http://www.panoraadvertising.com</p></br>";
            $massage.= "</body></html>";
            $email->setEmail($mem->email, "Verification Mail", $massage);
            $email->send();
            $message=false;

            $nmessage = '<html><body>';
            $nmassage.='<p>Account ID:' . $mem->account_id . "</p></br>";
            $nmassage.='<p>Name: ' . $mem->first_name . "</p></br>";
            $nmassage.='<p>Email: ' . $mem->email . "</p></br>";
            $nmassage.='<p>Requet Account Type: ' . $set->getPakageName($read->get("pak ", "POST")) . "</p></br>";
            $nmassage.= "</body></html>";
            $email->setEmail("", "Requet For Account Upgrade", $nmassage);
            $email->send();
        } else if ($pafor == 199153) {
            $message = '<html><body>';
            $massage.= "<p>Hello! Welcome to the best advertising provider panoraadvertising.com!</p></br>";
            $massage.= "<p>We 've received your request. You can expect a response within 24 hours.</p></br>";
            $massage.= "<p>If you have got any doubt you can send a mail to info@panoraadvertising.com</p></br>";
            $massage.= "<p>Thanks and Regards,</p></br>";
            $massage.= "<p>http://www.panoraadvertising.com</p></br>";
            $massage.= "</body></html>";
            $email->setEmail($mem->email, "Verification Mail", $massage);
            $email->send();
             $message=false;

            
            $nmessage = "<html><body>";
            $nmassage = "<p>Account ID:" . $mem->account_id . "</p></br>";
            $nmassage.="<p>Name: " . $mem->first_name . "</p></br>";
            $nmassage.="<p>Email: " . $mem->email . "</p></br>";
            $nmassage.="<p>Ad id: " . $refid . "</p></br>";
            $nmassage.= "</body></html>";
            $email->setEmail("", "New ad", $nmassage);
            $email->send();
        } else if ($pafor == 199153 || $pafor == 198953) {
            $message = '<html><body>';
            $massage.= "<p>Hello! Welcome to the best advertising provider panoraadvertising.com!</p></br>";
            $massage.= "<p>We 've received your request. You can expect a response within 24 hours.</p></br>";
            $massage.= "<p>If you have got any doubt you can send a mail to info@panoraadvertising.com</p></br>";
            $massage.= "<p>Thanks and Regards,</p></br>";
            $massage.= "<p>http://www.panoraadvertising.com</p></br>";
            $massage.= "</body></html>";
            $email->setEmail($mem->email, "Verification Mail", $massage);
            $email->send();
             $message=false;

            $nmessage ="<p><html><body>";
            $nmassage ="<p>Account ID:" . $mem->account_id . "</p></br>";
            $nmassage.="<p>Name: " . $mem->first_name . "</p></br>";
            $nmassage.="<p>Email: " . $mem->email . "</p></br>";
            $nmassage.= "</body></html>";
            $email->setEmail("", "Request for register", $nmassage);
            $email->send();
        }
        $pr->redirect("success.php?id1=" . $en->encode(1));
    } else if ($pay_type == 2) {
        if ($pafor == 199053) {
            $pay->upgradeAccount($refid, $read->get("pak", "POST"), $amount);
        }
        require_once("paypal/payments.php");
    } else if ($pay_type == 3) {
        if ($pafor == 199053) {
            $pay->upgradeAccount($refid, $read->get("pak", "POST"), $amount);
        }
        $pr->redirect("success.php?id1=" . $en->encode(3));
    } else {
        $pr->redirect("success.php?id1=" . $en->encode(4));
    }
}
?>

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
        }
        $pr->redirect("success.php?id1=".$en->encode(1));
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

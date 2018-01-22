<?php

class advpaymentclass {

    private $qu;
    private $con;
    private $er;
    private $pro;
    private $userId;
    private $date;

    public function __construct($id=false) {
        date_default_timezone_set('Australia/Melbourne');
        $this->date = date('Y-m-d');
        $this->qu = new query();
        $this->con = new DB();
        $this->er = new errormsg();
        $this->pro = new process();
        $this->his = new history();

        $this->email = new email();
        $this->en = new Encryption();
        if ($id) {
            $this->userId = $id;
        } else {
            $this->userId = $this->pro->getSession("advac");
        }
        $this->his = new history($this->userId);
    }

    public function updateReg() {

        $updateAc = "UPDATE adviewer_register SET ispay=1 WHERE account_id='" . $this->userId . "'";
        if (!$this->con->execute($updateAc)) {

            $this->er->createerror("payment application Error(payment.class.php line:53)", 1);
            return false;
        }
        $advsum = new advsummary($this->userId);
        $mem = $advsum->getMemberDetail();
        $massage = "<html><body>";
        $massage.= "<p>Welcome to the best advertising provider panoraadvertising.com!</p></br>";

        $massage.="<p>You can access members area at:</p></br>";
        $massage.="<p>http://www.panoraadvertising.com/common/login.php</p></br>";

        $massage.="<p>Login user name: " . $mem->user_name . "</p></br>";
        $massage.="<p>Password:" . $this->en->decode($mem->password) . "</p></br>";

        $massage.="<p>Our members area allows you to see ads and other account details of your account.</p></br>";

        $massage.="<p>If you have any questions, please contact us and we will be more than happy to assist you.</p></br>";

        $massage.="<p>Thanks and Regards,</p></br>";

        $massage.="<p>www.panoraadvertising.com</p></br>";

        $massage.="<p>+++</p></br>";
        $massage.="<p>Do not reply to this email, this is automatically generated message.</p></br>";
        $massage.="<p>+++</p></br>";
        $message .= "</body></html>";
        $this->email->setEmail($mem->email, "Activated account", $massage);
        $this->email->send();
        $message = false;

        $nmassage = "<html><body>";
        $nmassage.="<p>Member account id:" . $mem->account_id . "</p></br>";
        $nmassage.="<p>Name: " . $mem->first_name . "</p></br>";
        $nmassage.="<p>Email: " . $mem->email . "</p></br>";
        $nmassage.="<p>Date: " . $this->date . "</p></br>";
        $nmessage .= "</body></html>";
        $this->email->setEmail("", "confirm account", $nmassage);
        $this->email->send();
        return true;
    }

    public function updatePakage($comment, $payment, $method, $pak, $txn_id=false) {
        if (!$payment && !$pak) {
            return false;
        }
        $wht_pak = $this->con->queryUniqueValue("SELECT req_pakage FROM adviewer_upgrade WHERE isdone=0 AND account_id='" . $this->userId . "'");
        if (!$wht_pak) {
            return false;
        }
        $updateUp = "UPDATE adviewer_upgrade SET isdone=1 WHERE account_id='" . $this->userId . "'";
        $updateAc = "UPDATE adviewer_register SET pakage='" . $wht_pak . "' WHERE account_id='" . $this->userId . "'";
        if ($this->con->execute($updateAc)) {
            if (!$this->con->execute($updateUp)) {
                $this->er->createerror("payment application Error(payment.class.php line:53)", 1);
                return false;
            }
        } else {
            $this->er->createerror("payment application Error(payment.class.php line:53)", 1);
            return false;
        }
        $this->his->addToHistory("You pakage upgrade to " . $this->advsum->getPakageName($pak));
        $this->insertAdviewerCashbook($comment, $payment, $method, $txn_id);
        $mem = $this->advsum->getMemberDetail();
        $set = new settings();
        $message = '<html><body>';
        $massage.= "<p>Hello! Welcome to the best advertising provider panoraadvertising.com!</p></br>";
        $massage.= "<p>We 've received your request. You can expect a response within 24 hours.</p></br>";
        $massage.= "<p>If you have got any doubt you can send a mail to info@panoraadvertising.com</p></br>";
        $massage.= "<p>Thanks and Regards,</p></br>";
        $massage.= "<p>http://www.panoraadvertising.com</p></br>";
        $massage.= "</body></html>";
        $this->email->setEmail($mem->email, "Verfication Email", $massage);
        $this->email->send();
         $message=false;



        return true;
    }

    public function insertAdviewerCashbook($comment, $payment, $method, $txn_id=false) {
        $cashBook = "INSERT INTO adviewer_cashbook(account_id,transaction_id,credit,comment,pay_method,date) VALUES('" . $this->userId . "','" . $txn_id . "','" . $payment . "','" . $comment . "','" . $method . "','" . $this->date . "')";
        if (!$this->con->execute($cashBook)) {

            $this->er->createerror("payment application Error(payment.class.php line:41)", 1);
            return false;
        }
//        $mem = $this->advsum->getMemberDetail();
//        $massage = 'Member account id:' . $mem->account_id . "\r\n";
//        $massage.='Amount: ' . $amount . "\r\n";
//        $massage.='Date: ' . $this->date . "\r\n";
//        $this->email->setEmail($mem->email, "Payment verification email for regiter in panora", $massage);
//        $this->email->send();
//
//        $massage = 'Member account id:' . $mem->account_id . "\r\n";
//        $massage.='Name: ' . $mem->first_name . "\r\n";
//        $massage.='Email: ' . $mem->email . "\r\n";
//        $massage.='Amount: ' . $amount . "\r\n";
//        $massage.='Date: ' . $this->date . "\r\n";
//        $this->email->setEmail(null, "Payment verification for account regiter in panora", $massage);
//        $this->email->send();
        return true;
    }

    public function insertDebitAdviewerCashbook($comment, $payment, $method, $txn_id=false) {
        $cashBook = "INSERT INTO adviewer_cashbook(account_id,transaction_id,debit,comment,pay_method,date) VALUES('" . $this->userId . "','" . $txn_id . "','" . $payment . "','" . $comment . "','" . $method . "','" . $this->date . "')";
        if (!$this->con->execute($cashBook)) {

            $this->er->createerror("payment application Error(payment.class.php line:41)", 1);
            return false;
        }
        return true;
    }

    public function maualRequestForWithdraw() {
        $updateAc = "UPDATE adviewer_account SET isrequest=1 WHERE account_id='" . $this->userId . "'";
        if (!$this->con->execute($updateAc)) {

            $this->er->createerror("payment application Error(payment.class.php line:51)", 1);
            return false;
        }
        $this->his->addToHistory("You requested for withdraw mony");
        return true;
    }

    public function manualWithdraw($comment=false, $amount=false) {
        if ($amount <= 0) {
            return false;
        }
        $updateAc = "UPDATE adviewer_account SET amount=amount-" . $amount . ",isrequest=0 WHERE account_id='" . $this->userId . "'";
        if (!$this->con->execute($updateAc)) {

            $this->er->createerror("payment application Error(payment.class.php line:63)", 1);
            return false;
        }
        $this->insertDebitAdviewerCashbook($comment, $amount, 1);

//        $this->his->addToHistory("You withdraw $ " . $amount);
//        $mem = $this->advsum->getMemberDetail();
//        $massage = "Your withdrawel success .\r\n";
//        $massage.='Amount: ' . $amount . "\r\n";
//        $massage.='Withdrawel Date: ' . $this->date . "\r\n";
//        $this->email->setEmail($mem->email, "Money withdra alert", $massage);
//        $this->email->send();
//
//        $massage = 'Member account id:' . $mem->account_id . "\r\n";
//        $massage.='Name: ' . $mem->first_name . "\r\n";
//        $massage.='Email: ' . $mem->email . "\r\n";
//        $massage.='Amount: ' . $amount . "\r\n";
//        $massage.='Withdrawel Date: ' . $this->date . "\r\n";
//        $this->email->setEmail(null, "Money withdrawel by admin", $massage);
//        $this->email->send();
        return true;
    }

    public function withdraw($comment=false, $amount=false, $method, $txn_id=false) {
        if ($amount <= 0) {
            return false;
        }
        $updateAc = "UPDATE adviewer_account SET amount=amount-" . $amount . ",isrequest=0 WHERE account_id='" . $this->userId . "'";
        if (!$this->con->execute($updateAc)) {

            $this->er->createerror("payment application Error(payment.class.php line:113)", 1);
            return false;
        }
        $this->insertDebitAdviewerCashbook($comment, $amount, $method, $txn_id);

//        $this->his->addToHistory("You withdraw $ " . $amount);
//        $mem = $this->advsum->getMemberDetail();
//        $massage = "Your withdrawel success .\r\n";
//        $massage.='Amount: ' . $amount . "\r\n";
//        $massage.='Withdrawel Date: ' . $this->date . "\r\n";
//        $this->email->setEmail($mem->email, "Money withdra alert", $massage);
//        $this->email->send();
//
//        $massage = 'Member account id:' . $mem->account_id . "\r\n";
//        $massage.='Name: ' . $mem->first_name . "\r\n";
//        $massage.='Email: ' . $mem->email . "\r\n";
//        $massage.='Amount: ' . $amount . "\r\n";
//        $massage.='Withdrawel Date: ' . $this->date . "\r\n";
//        $this->email->setEmail(null, "Money withdrawel by online", $massage);
//        $this->email->send();
        return true;
    }

    public function logout() {
        $this->pro->unsetSession("adv");
        $this->pro->unsetSession("advac");
        $this->pro->redirect("../index.php");
    }

}

?>
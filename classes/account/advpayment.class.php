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
        $this->advsum = new advsummary();
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
        return true;
    }

    public function insertAdviewerCashbook($comment, $payment, $method, $txn_id=false) {
        $cashBook = "INSERT INTO adviewer_cashbook(account_id,transaction_id,credit,comment,pay_method,date) VALUES('" . $this->userId . "','" . $txn_id . "','" . $payment . "','" . $comment . "','" . $method . "','" . $this->date . "')";
        if (!$this->con->execute($cashBook)) {

            $this->er->createerror("payment application Error(payment.class.php line:41)", 1);
            return false;
        }
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

        $this->his->addToHistory("You withdraw $ " . $amount);
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

        $this->his->addToHistory("You withdraw $ " . $amount);
        return true;
    }

    public function logout() {
        $this->pro->unsetSession("adv");
        $this->pro->unsetSession("advac");
        $this->pro->redirect("../index.php");
    }

}

?>
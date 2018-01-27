<?php

class mgtclass {

    public function __construct() {
        date_default_timezone_set('Asia/Calcutta');
        $this->date = date('Y-m-d');
        $this->qu = new query();
        $this->con = new DB();
        $this->er = new errormsg();
        $this->pro = new process();
        $this->read = new read();
    }

    public function totalUsers() {
        $tot = $this->con->queryUniqueValue("SELECT COUNT(account_id) FROM adviewer_register");
        return($tot ? $tot : false);
    }

    public function totalRegUsers() {
        $tot = $this->con->queryUniqueValue("SELECT COUNT(account_id) FROM adviewer_register WHERE ispay=1");
        return($tot ? $tot : false);
    }

    public function totalPendinUsers() {
        $tot = $this->con->queryUniqueValue("SELECT COUNT(account_id) FROM adviewer_register WHERE ispay=0");
        return($tot ? $tot : false);
    }

    public function totalAccountUsers($actypeid) {
        $tot = $this->con->queryUniqueValue("SELECT COUNT(account_id) FROM adviewer_register WHERE ispay=1 AND pakage='" . $actypeid . "'");
        return($tot ? $tot : false);
    }

    public function totalRegAmount() {
        $tot = $this->con->queryUniqueValue("SELECT SUM(reg_amount) FROM adviewer_register WHERE ispay=1");
        return($tot ? $tot : false);
    }

    public function totalRegAmountPakage($actypeid) {
        $tot = $this->con->queryUniqueValue("SELECT SUM(reg_amount) FROM adviewer_register WHERE ispay=1 AND pakage='" . $actypeid . "'");
        return($tot ? $tot : false);
    }

    public function totalMemberEarn() {
        $tot = $this->con->queryUniqueValue("SELECT SUM(amount) FROM pay_ads_cashbook");
        return($tot ? $tot : false);
    }

}

?>
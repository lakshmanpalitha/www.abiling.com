<?php

class paymentclass {

    private $dateTime;

    public function __construct() {
        date_default_timezone_set('Asia/Calcutta');
        $this->dateTime = date('Y-m-d');
        $this->read = new read();
        $this->con = new DB();
        $this->advsum = new advsummary();
        $this->his = new history();
    }

    public function upgradeAccount($acid, $pak, $amount) {

        if (!$this->con->execute("INSERT INTO adviewer_upgrade(account_id,req_pakage,amount) VALUES('" . $acid . "','" . $pak . "','" . $amount . "')")) {
            return false;
        }
        $name = $this->advsum->getPakageName($pak);
        $this->his->addToHistory("Your request account upgrade for a " . $name);


        return true;
    }

    public function msgmanual() {
        $html = array();
        $html['title'] = "Request successfuly submited for manual payment";
        $html['msg'] = "Panora will contact you soon for your request. Thnak you for registered in panora..";
        return $html;
    }
    public function msgonline() {
        $html = array();
        $html['title'] = "Request successfuly submited for manual payment";
        $html['msg'] = "Panora will contact you soon for your request. Thnak you for registered in panora..";
        return $html;
    }
    public function msgpaypal() {
        $html = array();
        $html['title'] = "Your payment was successful";
        $html['msg'] = "Thnak you!";
        return $html;
    }

    public function msgfail() {
        $html = array();
        $html['title'] ="Invalid transaction process";
        $html['msg'] = "Please try again later....";
        return $html;
    }

}

?>
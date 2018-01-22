<?php

class settings {

    private $dateTime;
    private $date;
    private $second;

    public function __construct() {
        date_default_timezone_set('Australia/Melbourne');
        $this->dateTime = date('Y-m-d H:i:s');
        $this->date = date('Y-m-d');
        $this->second = date('Hs');
        $this->con = new DB();
        $this->read = new read();
        $this->pr = new process();
        $this->er = new errormsg();
        $this->qu = new query();
    }

    public function getPakageValue($pak) {
        $aTot = $this->con->queryUniqueObject("SELECT value AS tot FROM  settings_pakage WHERE id='" . $pak . "'");
        if (!$aTot) {
            return 0;
        }
        return $aTot->tot;
    }

    public function getAdsPerRoundSettings() {
        $set_ad = $this->con->queryMultipleObjects("SELECT * FROM settings_adviewer_ads");
        if (!$set_ad) {
            return false;
        }
        return $set_ad;
    }

    public function getPakageSettings() {
        $set_pak = $this->con->queryMultipleObjects("SELECT * FROM settings_pakage");
        if (!$set_pak) {
            return false;
        }
        return $set_pak;
    }

    public function getPakageName($pak=false) {
        if (!$pak) {
            return false;
        }
        $name = $this->con->queryUniqueValue("SELECT name FROM settings_pakage WHERE id='" . $pak . "'");
        if (!$name) {
            return false;
        }
        return $name;
    }

    public function getFeeForAdSettings() {
        $fee = $this->con->queryUniqueValue("SELECT amount FROM  settings_ads");
        if (!$fee) {
            return false;
        }
        return $fee;
    }

    public function getWithdrawSettings() {
        $fee = $this->con->queryMultipleObjects("SELECT * FROM settings_pakage");
        if (!$fee) {
            return false;
        }

        return $fee;
    }

    public function getUserWithdrawValue($pak=false) {
        if (!$pak) {
            return false;
        }
        $fee = $this->con->queryUniqueValue("SELECT w_limit FROM settings_pakage WHERE id='".$pak."'");
        if (!$fee) {
            return false;
        }

        return $fee;
    }
    public function getUserPointsLimit($pak=false) {
        if (!$pak) {
            return false;
        }
        $p = $this->con->queryUniqueValue("SELECT ads_p_point FROM settings_pakage WHERE id='".$pak."'");
        if (!$p) {
            return false;
        }

        return $fee;
    }
    public function getUserReferalLimit($pak=false) {
        if (!$pak) {
            return false;
        }
        $fee = $this->con->queryUniqueValue("SELECT r_amount FROM settings_pakage WHERE id='".$pak."'");
        if (!$fee) {
            return false;
        }

        return $fee;
    }

    public function updateAdSubmitFee($fee=false) {
        if (!$fee) {
            return false;
        }
        if (!$this->con->execute("UPDATE settings_ads SET amount='" . $fee . "'")) {
            return false;
        }
        return true;
    }

    public function updateWithdrawLimit($fee=false) {
        if (!$set = $this->read->get("set", "POST")) {
            return false;
        }

        foreach ($set as $s) {

            $this->con->execute("UPDATE settings_pakage SET w_limit='" . $s['limit'] . "' WHERE id='" . $s['pakage'] . "'");
        }
        return true;
    }
    public function updateReferal($fee=false) {
        if (!$set = $this->read->get("set", "POST")) {
            return false;
        }

        foreach ($set as $s) {

            $this->con->execute("UPDATE settings_pakage SET r_amount='" . $s['limit'] . "' WHERE id='" . $s['pakage'] . "'");
        }
        return true;
    }
    public function updatePoints($fee=false) {
        if (!$set = $this->read->get("set", "POST")) {
            return false;
        }

        foreach ($set as $s) {

            $this->con->execute("UPDATE settings_pakage SET ads_p_point='" . $s['limit'] . "' WHERE id='" . $s['pakage'] . "'");
        }
        return true;
    }

    public function updateAdsRoundUser() {

        if (!$set = $this->read->get("set", "POST")) {
            return false;
        }

        foreach ($set as $s) {

            $this->con->execute("UPDATE settings_adviewer_ads SET no_ads='" . $s['ads'] . "',no_days='" . $s['days'] . "' WHERE pakage='" . $s['pakage'] . "'");
        }
        return true;
    }

    public function updatePakage() {

        if (!$set = $this->read->get("set", "POST")) {
            return false;
        }

        foreach ($set as $s) {

            $this->con->execute("UPDATE settings_pakage SET name='" . $s['name'] . "',value='" . $s['fee'] . "' WHERE id='" . $s['pakage'] . "'");
        }
        return true;
    }

    public function addNews() {
        
    }

    public function getNews() {
        
    }

}

?>
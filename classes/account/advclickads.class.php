<?php

class advclickads {

    private $qu;
    private $con;
    private $er;
    private $pro;
    private $date;
    private $userId;

    public function __construct() {
        date_default_timezone_set('Australia/Melbourne');
        $this->date = date('Y-m-d');
        $this->qu = new query();
        $this->con = new DB();
        $this->er = new errormsg();
        $this->pro = new process();
        $this->en = new Encryption();
        $this->userId = $this->pro->getSession("advac");
    }

    public function checkAdBlock($adid=false) {
        if (!$adid) {
            return false;
        }
        $en_id = (int) $this->en->decode($adid);
        $id = $this->con->queryUniqueObject("SELECT ads_id FROM adviewer_view_ads WHERE (temp_block=1 OR isblock=1) AND account_id='" . $this->userId . "' AND ads_id ='" . $en_id . "' ");
        if ($id) {
            $this->unsetAdIsRunning($adid);
            return true;
        }
        return false;
    }

    public function checkAnyAdIsRunning($adid=false) {
        if (!$adid) {
            return false;
        }
        $en_id = (int) $this->en->decode($adid);
        $id = $this->con->queryUniqueValue("SELECT is_runing FROM adviewer_view_ads WHERE is_runing=1 AND account_id='" . $this->userId . "' AND ads_id !='" . $en_id . "' ");
        if (!$id) {
            return false;
        }
        return true;
    }

    public function setAdIsRunning($adid=false) {
        if (!$adid) {
            return false;
        }
        $en_id = (int) $this->en->decode($adid);
        if (!$this->con->execute("UPDATE adviewer_view_ads SET is_runing=1 WHERE ads_id='" . $en_id . "' AND account_id='" . $this->userId . "'")) {
            return false;
        }
        return true;
    }

    public function unsetAdIsRunning($adid=false) {

        if (!$adid) {
            return false;
        }

        $en_id = (int) $this->en->decode($adid);
        if (!$this->con->execute("UPDATE adviewer_view_ads SET is_runing=0 WHERE ads_id='" . $en_id . "' AND account_id='" . $this->userId . "'")) {
            return false;
        }
        return true;
    }

    public function tempblockAd($adid=false) {
        if (!$adid) {
            return false;
        }
        $en_id = (int) $this->en->decode($adid);
        if (!$this->con->execute("UPDATE adviewer_view_ads SET temp_block=1,view_time=view_time+1  WHERE ads_id='" . $en_id . "' AND account_id='" . $this->userId . "'")) {
            return false;
        }
        // $this->unsetAdIsRunning($adid);
        return true;
    }

    public function verifyAdclick($adid=false) {
        if (!$adid) {
            return false;
        }

        $en_id = (int) $this->en->decode($adid);
        $pakage = $this->con->queryUniqueValue("SELECT pakage FROM adviewer_register WHERE account_id='" . $this->userId . "'");
        if ($pakage == 1) {
            $whr_pak = "rate1";
        } else if ($pakage == 2) {
            $whr_pak = "rate2";
        } else if ($pakage == 3) {
            $whr_pak = "rate3";
        } else {
            return false;
        }
        $amountAd = $this->con->queryUniqueValue("SELECT " . $whr_pak . " FROM ads_fool WHERE ads_id ='" . $en_id . "' ");
        if (!$amountAd) {
            return false;
        }
        if (!$this->con->execute("INSERT INTO pay_ads_cashbook(ads_id,amount,account_id,credit_date) VALUES('" . $en_id . "','" . $amountAd . "','" . $this->userId . "','" . $this->date . "')")) {
            return false;
        }
        if (!$this->con->queryUniqueValue("SELECT account_id FROM adviewer_account WHERE account_id ='" . $this->userId . "' ")) {
            if (!$this->con->execute("INSERT INTO adviewer_account(account_id,amount) VALUES('" . $this->userId . "','" . $amountAd . "')")) {
                return false;
            }
        } else {
            if (!$this->con->execute("UPDATE SET no_ads=no_ads+1,amount=amount+" . $amountAd . " WHERE account_id='" . $this->userId . "'")) {
                return false;
            }
            $ads_point = $this->con->queryUniqueValue("SELECT no_ads FROM adviewer_account WHERE account_id ='" . $this->userId . "' ");
            $advsum = new advsummary($this->userId);
            $set = new settings();
            if ($ads_point && $ads_point > $set->getUserPointsLimit($this->advsum->getCurruntPakage())) {
                if (!$this->con->execute("UPDATE SET no_ads=0,points=points+1 WHERE account_id='" . $this->userId . "'")) {
                    return false;
                }
            }
        }
        // $this->unsetAdIsRunning($adid);
        $this->tempblockAd($adid);
        return $amountAd;
    }

}

?>
<?php

class advclickads {

    private $qu;
    private $con;
    private $er;
    private $pro;
    private $date;
    private $userId;

    public function __construct() {
        date_default_timezone_set('Asia/Calcutta');
        $this->date = date('Y-m-d');
        $this->qu = new query();
        $this->con = new DB();
        $this->er = new errormsg();
        $this->pro = new process();
        $this->en = new Encryption();
        $this->advsum = new advsummary();
        $this->userId = $this->pro->getSession("advac");
        if (!$this->userId) {
            return false;
        }
    }

    public function checkAdBlock($adid=false) {
        if (!$adid) {
            return false;
        }
        $en_id = (int) $this->en->decode($adid);
        $id = $this->con->queryUniqueObject("SELECT view_id FROM adviewer_view_ads WHERE (temp_block=1 OR isblock=1) AND account_id='" . $this->userId . "' AND view_id ='" . $en_id . "' ");
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
        if (!$this->con->execute("UPDATE adviewer_view_ads SET is_runing=1 WHERE view_id='" . $en_id . "' AND account_id='" . $this->userId . "'")) {
            return false;
        }
        return true;
    }

    public function unsetAdIsRunning($adid=false) {

        if (!$adid) {
            return false;
        }

        $en_id = (int) $this->en->decode($adid);
        if (!$this->con->execute("UPDATE adviewer_view_ads SET is_runing=0 WHERE view_id='" . $en_id . "' AND account_id='" . $this->userId . "'")) {
            return false;
        }
        return true;
    }

    public function tempblockAd($adid=false) {
        if (!$adid) {
            return false;
        }
        $en_id = (int) $this->en->decode($adid);

        if (!$this->con->execute("UPDATE adviewer_view_ads SET temp_block=1,view_time=view_time+1,l_view_date='" . $this->date . "'  WHERE view_id='" . $en_id . "' AND account_id='" . $this->userId . "'")) {
            return false;
        }
        // $this->unsetAdIsRunning($adid);
        return true;
    }

    public function verifyAdclick($view_id=false,$vkey=false) {
        if (!$view_id) {
            return false;
        }
        if(!$vkey){
          return false;  
        }

        if (!$log = $this->con->queryUniqueValue("SELECT log_session FROM account WHERE account_id='" . $this->userId . "'")) {
            return false;
        }
        if ($log != session_id()) {
            return false;
        }
        $en_id = (int) $this->en->decode($view_id);
        $ad_id = $this->con->queryUniqueValue("SELECT ads_id FROM adviewer_view_ads WHERE view_id ='" . $en_id . "' ");
        if($this->con->queryUniqueValue("SELECT ads_id FROM pay_ads_cashbook WHERE account_id='" . $this->userId . "' AND ads_id='".$ad_id."' AND verify='".$vkey ."'")){
           return 99999999;
        }

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
        $amountAd = $this->con->queryUniqueValue("SELECT " . $whr_pak . " FROM ads_fool WHERE ads_id ='" . $ad_id . "' ");
        if (!$amountAd) {

            return false;
        }
        if (!$this->con->execute("INSERT INTO pay_ads_cashbook(ads_id,amount,account_id,credit_date,verify) VALUES('" . $ad_id . "','" . $amountAd . "','" . $this->userId . "','" . $this->date . "','" . $vkey . "')")) {

            return false;
        }
        if (!$this->con->queryUniqueValue("SELECT account_id FROM adviewer_account WHERE account_id ='" . $this->userId . "' ")) {
            if (!$this->con->execute("INSERT INTO adviewer_account(account_id,amount) VALUES('" . $this->userId . "','" . $amountAd . "')")) {

                return false;
            }
        } else {
            if (!$this->con->execute("UPDATE adviewer_account SET no_ads=no_ads+1,amount=amount+" . $amountAd . " WHERE account_id='" . $this->userId . "'")) {

                return false;
            }

            $ads_point = $this->con->queryUniqueValue("SELECT no_ads FROM adviewer_account WHERE account_id ='" . $this->userId . "' ");
            $advsum = new advsummary($this->userId);
            $set = new settings();
            if ($ads_point && $ads_point >= $set->getUserPointsLimit($this->advsum->getCurruntPakage())) {
                if (!$this->con->execute("UPDATE adviewer_account SET no_ads=0,points=points+1 WHERE account_id='" . $this->userId . "'")) {

                    return false;
                }
            }
        }
        //add referal amount
        $myReferalUser = false;
        $myReferalUser = $this->advsum->getReferUser();
        //var_dump($myReferalUser);
        if ($myReferalUser) {
            $nadvsum = new advsummary($myReferalUser);
            $refPak = $nadvsum->getCurruntPakage();
           // var_dump($refPak);
            if ($refPak) {
                $set = new settings();
                $refFee = $set->getReferMemFee($refPak);
            }

            if (!$this->con->queryUniqueValue("SELECT account_id FROM adviewer_account WHERE account_id ='" . $myReferalUser . "' ")) {
                if (!$this->con->execute("INSERT INTO adviewer_account(account_id,amount,ref_click_amount) VALUES('" . $myReferalUser . "','" . $refFee . "','" . $refFee . "')")) {

                    return false;
                }
            } else {
                if (!$this->con->execute("UPDATE adviewer_account SET ref_click_amount=ref_click_amount+" . $refFee . ",amount=amount+" . $refFee . " WHERE account_id='" . $myReferalUser . "'")) {

                    return false;
                }
            }
        }
        // $this->unsetAdIsRunning($adid);

        $this->tempblockAd($this->en->encode($en_id));
        return $amountAd;
    }

}

?>
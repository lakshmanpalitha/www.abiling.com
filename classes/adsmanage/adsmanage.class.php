<?php

class adsmanageclass {

    private $dateTime;
    private $date;
    private $second;
    private $acid;

    public function __construct() {
        date_default_timezone_set('Asia/Calcutta');
        $this->dateTime = date('Y-m-d H:i:s');
        $this->date = date('Y-m-d');
        $this->second = date('Hs');
        $this->con = new DB();
        $this->read = new read();
        $this->pr = new process();
        $this->er = new errormsg();
        $this->qu = new query();

        $this->acid = $this->pr->getSession("adtac");
    }

    public function blockAd($adid=false) {
        if (!$adid) {
            return false;
        }
        if (!$this->con->execute("UPDATE ads_fool SET isblock=IF(isblock = 0, 1, IF(isblock = 1, 0, 0))  WHERE ads_id='" . $adid . "'")) {
            return false;
        }
        return true;
    }

    public function temprelyDelAd($adid=false) {
        if (!$adid) {
            return false;
        }
        if (!$this->con->execute("UPDATE ads_fool SET del_ad=1 WHERE ads_id='" . $adid . "'")) {
            return false;
        }
        return true;
    }

    public function delAd($adid=false) {
        if (!$adid) {
            return false;
        }
        if (!$this->con->execute("DELETE FROM submit_ads_info WHERE ads_id='" . $adid . "'")) {
            return false;
        }
        if (!$this->con->execute("DELETE FROM submit_ads_file WHERE ads_id='" . $adid . "'")) {
            return false;
        }
        if (!$this->con->execute("DELETE FROM submit_ads_select_crytaria WHERE ads_id='" . $adid . "'")) {
            return false;
        }
        return true;
    }
     

}

?>
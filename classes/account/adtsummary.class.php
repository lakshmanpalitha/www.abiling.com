<?php

class adtsummary {

    private $qu;
    private $con;
    private $er;
    private $pro;
    private $date;
    private $userId;

    public function __construct($id=false) {
        date_default_timezone_set('Australia/Melbourne');
        $this->date = date('Y-m-d');
        $this->qu = new query();
        $this->con = new DB();
        $this->er = new errormsg();
        $this->pro = new process();
        if ($id) {
            $this->userId = $id;
        } else {
            $this->userId = $this->pro->getSession("adtac");
        }
    }

    public function getAllAds() {
        $tot = $this->con->queryUniqueValue("SELECT COUNT(af.ads_id) AS tot  FROM submit_ads_info si,ads_fool af WHERE si.ads_id=af.ads_id AND si.account_id='" . $this->userId . "'");
        if (!$tot) {
            return 0;
        }
        return $tot;
    }

    public function getAllRunAds() {
        $tot = $this->con->queryUniqueValue("SELECT COUNT(af.ads_id) AS tot  FROM submit_ads_info si,ads_fool af WHERE si.ads_id=af.ads_id AND (af.isblock=0 AND af.del_ad=0) AND  si.account_id='" . $this->userId . "'");
        if (!$tot) {
            return 0;
        }
        return $tot;
    }
    public function getAllPayments() {
        $tot = $this->con->queryMultipleObjects("SELECT * FROM advertiser_cashbook ac,submit_ads_info sa WHERE ac.ads_id=sa.ads_id AND sa.account_id='".$this->userId."' ");
        if (!$tot) {
            return 0;
        }
        return $tot;
    }

    //load click ads for each member
}

?>
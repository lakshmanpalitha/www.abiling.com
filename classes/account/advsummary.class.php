<?php

class advsummary {

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
        $this->set = new settings();
        if ($id) {
            $this->userId = $id;
        } else {
            $this->userId = $this->pro->getSession("advac");
        }
    }

    public function getCurruntPakage() {
        $pakage = $this->con->queryUniqueObject("SELECT pakage AS pak FROM  adviewer_register  WHERE account_id='" . $this->userId . "'");
        if (!$pakage) {
            return false;
        }
        return $pakage->pak;
    }

    public function getPakageName($pak) {
        $pakage = $this->con->queryUniqueObject("SELECT name AS pak FROM  settings_pakage WHERE id='" . $pak . "'");
        if (!$pakage) {
            return false;
        }
        return $pakage->pak;
    }
    public function getCurruntPoints() {
        $pakage = $this->con->queryUniqueObject("SELECT points AS p FROM  adviewer_account WHERE account_id='" . $this->userId . "'");
        if (!$pakage) {
            return false;
        }
        return $pakage->p;
    }
    public function getCurruntReferalamount() {
        $rpakage = $this->con->queryUniqueObject("SELECT ref_amount AS ra FROM  adviewer_account WHERE account_id='" . $this->userId . "'");
        if (!$rpakage) {
            return false;
        }
        return $rpakage->ra;
    }
    public function getCurruntReferalClick() {
        $cpakage = $this->con->queryUniqueObject("SELECT ref_click AS rc FROM  adviewer_account WHERE account_id='" . $this->userId . "'");
        if (!$cpakage) {
            return false;
        }
        return $cpakage->rc;
    }

    public function getRegisterDate() {
        $regDate = $this->con->queryUniqueObject("SELECT register_date AS reg FROM  account  WHERE account_id='" . $this->userId . "'");
        if (!$regDate) {
            return false;
        }
        return $regDate->reg;
    }

    public function getLatestClickAds() {

        $latestAds = $this->con->queryUniqueObject("SELECT COUNT(ads_id) AS tot FROM  adviewer_view_ads  WHERE temp_block=1 AND account_id='" . $this->userId . "'");
        if (!$latestAds) {
            return 0;
        }
        return $latestAds->tot;
    }

    public function getTotalClicksAds() {

        $totClickAds = $this->con->queryUniqueObject("SELECT SUM(view_time) AS tot FROM  adviewer_view_ads WHERE (temp_block=1 OR isblock=1) AND account_id='" . $this->userId . "'");
        if (!$totClickAds) {
            return 0;
        }
        return $totClickAds->tot;
    }

    public function getCurruntAds() {
        $cuad = $this->con->queryUniqueObject("SELECT COUNT(ads_id) AS tot FROM  adviewer_view_ads WHERE (temp_block=1 OR isblock=0) AND account_id='" . $this->userId . "'");
        if (!$cuad) {
            return 0;
        }
        return $cuad->tot;
    }

    public function getMainEarn() {
        $mTot = $this->con->queryUniqueObject("SELECT SUM(amount) AS tot FROM  pay_ads_cashbook WHERE account_id='" . $this->userId . "'");
        if (!$mTot) {
            return 0;
        }
        return $mTot->tot;
    }

    public function getTotEarn() {
        $aTot = $this->con->queryUniqueValue("SELECT amount FROM adviewer_account WHERE account_id='" . $this->userId . "'");
        if (!$aTot) {
            return 0;
        }
        return $aTot;
    }

    public function getLastWithDrawDate() {
        $date = $this->con->queryUniqueValue("SELECT date FROM adviewer_cashbook WHERE account_id='" . $this->userId . "' AND debit>0 ORDER BY date DESC  ");
        if (!$date) {
            return false;
        }
        return $date;
    }

    public function getAvailableWithdraw() {
        $aTot = $this->con->queryUniqueValue("SELECT amount FROM adviewer_account WHERE account_id='" . $this->userId . "'");
        if (!$aTot) {
            return 0;
        }

        $limit = $this->set->getUserWithdrawValue($this->getCurruntPakage());
        if ($aTot > $limit) {
            return ($aTot - $limit);
        } else {
            return 0;
        }
    }

    public function getRequestUpgradeDetail() {
        $ugrade = $this->con->queryUniqueObject("SELECT * FROM adviewer_upgrade WHERE account_id='" . $this->userId . "' AND isdone=0");
        if (!$ugrade) {
            return false;
        }
        return $ugrade;
    }

    public function checkRequestForUpgrade() {

        $id = $this->con->queryUniqueValue("SELECT id  FROM  adviewer_upgrade  WHERE isdone=0 AND account_id='" . $this->userId . "'");
        if ($id) {
            return true;
        }

        return false;
    }

    public function checkRequestForWithdraw() {

        $id = $this->con->queryUniqueValue("SELECT account_id  FROM  adviewer_account  WHERE isrequest=1 AND account_id='" . $this->userId . "'");
        if ($id) {
            return true;
        }

        return false;
    }

//memeber pay to panora
    public function getCredit() {
        $credit = $this->con->queryMultipleObjects("SELECT credit,comment,date FROM adviewer_cashbook WHERE credit >0 AND account_id='" . $this->userId . "' ORDER BY date  DESC");
        if (!$credit) {
            return 0;
        }
        return $credit;
    }

//memeber withdraw from panora
    public function getDebit() {

        $debit = $this->con->queryMultipleObjects("SELECT debit,comment,date FROM adviewer_cashbook WHERE debit>0 AND account_id='" . $this->userId . "' ORDER BY date  DESC");
        if (!$debit) {
            return 0;
        }
        return $debit;
    }

//memeber earn by ads clicks
    public function getAdsCredit() {

        $ads_credit = $this->con->queryMultipleObjects("SELECT SUM(amount) AS amount ,credit_date FROM pay_ads_cashbook WHERE account_id='" . $this->userId . "' GROUP BY credit_date ORDER BY credit_date DESC");
        if (!$ads_credit) {
            return 0;
        }
        return $ads_credit;
    }

    public function checkIsPay() {

        $id = $this->con->queryUniqueValue("SELECT account_id  FROM  adviewer_register  WHERE ispay=1 AND account_id='" . $this->userId . "'");
        if ($id) {
            return true;
        }

        return false;
    }

    public function getCountryCode() {
        $coun_code = $this->con->queryUniqueValue("SELECT country FROM  account  WHERE account_id='" . $this->userId . "'");
        if ($coun_code) {
            return $coun_code;
        }

        return false;
    }
 public function getMemberDetail() {
        $mem = $this->con->queryUniqueObject("SELECT * FROM  account  WHERE account_id='" . $this->userId . "'");
        if ($mem) {
            return $mem;
        }

        return false;
    }
    //load click ads for each member
}

?>
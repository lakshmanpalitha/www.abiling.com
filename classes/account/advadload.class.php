<?php

class advadloadclass {

    private $qu;
    private $con;
    private $er;
    private $pro;
    private $date;
    private $userId;
    private $no_of_ads_per_round;
    private $no_of_days_per_round;

    public function __construct($id=false) {
        date_default_timezone_set('Australia/Melbourne');
        $this->date = date('Y-m-d');
        $this->qu = new query();
        $this->con = new DB();
        $this->er = new errormsg();
        $this->pro = new process();
        $this->advsum = new advsummary();
        if ($this->pro->getSession("advac")) {
            $this->userId = $this->pro->getSession("advac");
        } else {
            $this->userId = $id;
        }
        $this->userId = $this->pro->getSession("advac");
        //get how many ads amd days for round define by admin
        $pak = $this->advsum->getCurruntPakage();
        $view_privacy = false;
        if ($pak)
            $view_privacy = $this->con->queryUniqueObject("SELECT * FROM settings_adviewer_ads WHERE pakage='" . $pak . "'");

        if (!$view_privacy) {
            return false;
        }
        $this->no_of_ads_per_round = $view_privacy->no_ads;
        $this->no_of_days_per_round = $view_privacy->no_days;
    }

    //load click ads for each member
    public function loadAds() {
        $available_ads = $this->con->queryMultipleObjects("SELECT * FROM adviewer_view_ads a_v_a,ads_fool af WHERE a_v_a.isblock=0 AND a_v_a.account_id='" . $this->userId . "' AND a_v_a.ads_id=af.ads_id LIMIT " . $this->no_of_ads_per_round . "");
        if (!$available_ads) {
            return false;
        }
        return $available_ads;
    }

    public function loadOldAds() {
        $available_oads = $this->con->queryMultipleObjects("SELECT * FROM adviewer_view_ads a_v_a,ads_fool af WHERE a_v_a.isblock=1 AND a_v_a.account_id='" . $this->userId . "' AND  a_v_a.ads_id=af.ads_id ORDER BY RAND() LIMIT 25 ");
        if (!$available_oads) {

            return false;
        }
        return $available_oads;
    }

    public function checkAdsRound() {

        $no_of_currunt_available_ads = 0;

        //get last ads round date
        $currunt_round_date = $this->con->queryUniqueValue("SELECT round_date FROM adviewer_register WHERE account_id='" . $this->userId . "'");

        if (!$currunt_round_date) {
            return false;
        }
        //count how many days spend for rount till today
        $start = strtotime($currunt_round_date);
        $end = strtotime($this->date);
        try {
            $days_between = ceil(abs($end - $start) / 86400);
        } catch (Exception $e) {
            throw new Exception('Something really gone wrong', 0, $e);
        }


        //if count days exceeds define days then block currunt ads if complete no of view time
        if ($days_between >= $this->no_of_days_per_round) {

            $this->con->execute("UPDATE adviewer_view_ads a_v_a 
                                            JOIN ads_fool a_f  ON a_v_a.ads_id = a_f.ads_id 
                                            SET a_v_a.isblock = 1,a_v_a.temp_block = 0
                                            WHERE (a_f.view_time =a_v_a.view_time OR a_v_a.view_time=0) AND a_v_a.account_id='" . $this->userId . "'");

            //update new round date
            //
          $this->con->execute("UPDATE adviewer_register SET round_date='" . $this->date . "' WHERE account_id='" . $this->userId . "' ");
            //
            //if still avilable ads on table 
            //then available add equal define no of ads per round
            //then again view this all ads to member
            //if available ads not equal define no of ads per round then get new sutable ads from ads fool
            //when select ads from ads fool get piority to time periode

            $no_of_currunt_available_ads = $this->con->queryUniqueValue("SELECT COUNT(ads_id) FROM adviewer_view_ads WHERE account_id='" . $this->userId . "' AND isblock=0");

            if ($no_of_currunt_available_ads < $this->no_of_ads_per_round) {

                $available_ads_defrent = ($this->no_of_ads_per_round - $no_of_currunt_available_ads);
//                $adsPrv = $this->con->queryMultipleObjects("SELECT ap.ads_id AS id FROM ads_privacy ap,account ac,adviewer_register ar WHERE (FIND_IN_SET(ac.country, ap.coun_id) > 0 OR ap.coun_id=0 ) AND (FIND_IN_SET(ac.province, ap.stid) > 0 OR ap.stid=0 )
//           AND (FIND_IN_SET(ac.district, ap.dis_id) > 0 OR ap.dis_id=0 ) AND (FIND_IN_SET(ac.job, ap.job_id) > 0 OR ap.job_id=0 ) AND (ac.gender=ap.gender OR ap.gender='MF' ) AND (ac._18=ap._18 OR ap._18=100 ) AND  ((ar.pakage=ap.pakage OR ap.pakage=100 ) AND ar.account_id=ac.account_id) AND ac.account_id='" . $this->userId . "'");
//  
                $this->setAd($available_ads_defrent);
            }
        }
        return true;
    }

    public function setAd($available_ads_defrent) {

        $adsPrv = $this->con->queryMultipleObjects("SELECT ap.ads_id AS id FROM ads_privacy ap,account ac WHERE (FIND_IN_SET(ac.country, ap.coun_id) > 0 OR ap.coun_id=0 ) AND (FIND_IN_SET(ac.state, ap.stid) > 0 OR ap.stid=0 )
           AND (FIND_IN_SET(ac.district,ap.dis_id) > 0 OR ap.dis_id=0 ) AND (FIND_IN_SET(ac.job, ap.job_id) > 0 OR ap.job_id=0 ) AND (ac.gender=ap.gender OR ap.gender='MF' ) AND (ac._18=ap._18 OR ap._18=100 ) AND  (((SELECT pakage FROM adviewer_register WHERE account_id='" . $this->userId . "')=ap.pakage) OR ap.pakage=100 ) AND ac.account_id='" . $this->userId . "'");

        $pads = array();

        if ($adsPrv) {
            foreach ($adsPrv as $a) {

                array_push($pads, $a->id);
            }
        }


        //$intersect1 = array_intersect($ads1, $ads2, $ads3, $ads4, $ads5);
        //load new ads from ads_fool  if not view user ealier
        $adsFool = $this->con->queryMultipleObjects("SELECT ads_id AS id FROM ads_fool
  WHERE NOT EXISTS (SELECT ads_id FROM adviewer_view_ads
                    WHERE adviewer_view_ads.ads_id = ads_fool.ads_id AND ads_fool.isblock=0 AND ads_fool.del_ad=0 AND adviewer_view_ads.account_id='" . $this->userId . "')");
        $fads = array();
        if ($adsFool) {
            foreach ($adsFool as $ad) {
                array_push($fads, $ad->id);
            }
        }
        $no_of_val = 0;
        if (!$adsPrv && !$adsFool) {

            return false;
        }

        //select coomon ads where privacy and new ads mach
        $commonAds = array_intersect($pads, $fads);

        if (!$commonAds) {

            return false;
        }

        $no_of_val = count($commonAds);
        $rand_keys = false;
        if ($available_ads_defrent > 0 && $no_of_val > $available_ads_defrent) {

            $rand_keys = array_rand($commonAds, $available_ads_defrent);
        } else {
            $rand_keys = $commonAds;
        }

        if (!$rand_keys) {
            $this->er->createerror("Application error(advadload.class: line no 120", 1);
            return false;
        }

        foreach ($rand_keys as $r) {

            if (!$this->con->execute("INSERT INTO adviewer_view_ads(account_id,ads_id) VALUES('" . $this->userId . "','" . $r . "')")) {
                return false;
            }
        }
    }

    public function loadDefaultsAds() {
        $dAds = $this->con->queryMultipleObjects("SELECT * FROM adviewer_view_ads a_v_a,ads_fool af WHERE a_v_a.isblock=0 AND  a_v_a.ads_id=af.ads_id ORDER BY RAND() LIMIT 25 ");
        if (!$dAds) {
            return false;
        }
        return $dAds;
    }

    public function loadExpireDefaultsAds() {
        $dEAds = $this->con->queryMultipleObjects("SELECT * FROM adviewer_view_ads a_v_a,ads_fool af WHERE a_v_a.isblock=1 AND  a_v_a.ads_id=af.ads_id ORDER BY RAND() LIMIT 25 ");
        if (!$dEAds) {
            return false;
        }
        return $dEAds;
    }

}

?>
<?php

class blastAdsclass {

    private $dateTime;
    private $date;
    private $second;
    private $adsId;
    private $acid;
    private $adinfo;

    public function __construct($adsId=false) {
        date_default_timezone_set('Australia/Melbourne');
        $this->dateTime = date('Y-m-d H:i:s');
        $this->date = date('Y-m-d');
        $this->second = date('Hs');
        $this->con = new DB();
        $this->read = new read();
        $this->pr = new process();
        $this->er = new errormsg();
        $this->qu = new query();
        $this->adsId = $adsId;
        $this->email = new email();
        $this->acid = $this->pr->getSession("adtac");
    }

    private function setAdInfo() {

        if (!$data = $this->qu->getFormPost()) {
            return false;
        }
        $data['ads_id'] = $this->adsId;
        $data['ads_add_date'] = $this->date;

        $this->adinfo = $data;
        return true;
    }

//add to add adsfool
//this function only ads info
    public function addToFoolInfo($html) {
        if (!$this->setAdInfo()) {
            return false;
        }

        $data = $this->adinfo;
        $data['html'] = $html;
        $data['adstype'] = 1;

        if ($this->read->get("np", "POST") && $this->read->get("np", "POST") == 1) {
            $data['from'] = "";
            $data['to'] = "";
        }
        if (!$InsertQuery = $this->qu->insertQuery($data, "ads_fool")) {
            $this->er->createerror("Application Error(adtaccount line:19)", 1);
            return false;
        }
        if (!$this->con->execute($InsertQuery)) {

            return false;
        }
        $this->con->execute("UPDATE submit_ads_info SET isblast=1 WHERE ads_id='" . $data['ads_id'] . "'");
        if (!$this->addAdsprivacy()) {
            return false;
        }
        return true;
    }

//add to add adsfool
//this function only ads url
    public function addToFoolUrl() {

        if (!$this->setAdInfo()) {
            return false;
        }
        $data = $this->adinfo;
        $data['adstype'] = 2;
        if ($this->read->get("np", "POST") && $this->read->get("np", "POST") == 1) {
            $data['from'] = "";
            $data['to'] = "";
        }
        if (!$InsertQuery = $this->qu->insertQuery($data, "ads_fool")) {
            $this->er->createerror("Application Error(adtaccount line:19)", 1);
            return false;
        }
        if (!$this->con->execute($InsertQuery)) {

            return false;
        }
        if (!$this->addAdsprivacy()) {
            return false;
        }
        $this->con->execute("UPDATE submit_ads_info SET isblast=1 WHERE ads_id='" . $data['ads_id'] . "'");
        $adtsum = new adtsummary();
        $massage = "Hello! Welcome to the best advertising provider panoraadvertising.com!\r\n";
        $massage.= "We 've blasted your ad. You can expect a response within 24 hours.\r\n";
        $massage.= "If you have got any doubt you can send a mail to info@panoraadvertising.com\r\n";
        $massage.= "Thanks and Regards,";
        $massage.= "http://www.panoraadvertising.com";
        $this->email->setEmail($mem->email, "Verfication Email", $massage);
        $this->email->send();

        $massage="Account id:" . $mem->account_id . "\r\n";
        $massage.="Company Name: " . $mem->first_name . "\r\n";
        $massage.="Email: " . $mem->email . "\r\n";
        $massage.="Ad ID:" . $data['ads_id'] . "\r\n";
        $massage.="Date:" . $this->date . "\r\n";
        $this->email->setEmail(null, "Ad go online", $massage);
        $this->email->send();
        return true;
    }

//settings to whome ads can show
    private function addAdsprivacy() {

        $co = false;
        if ($coun = $this->read->get("coun", "POST")) {

            foreach ($coun as $c) {
                $cou = explode("/", $c);
                //$this->con->execute("INSERT INTO privacy_country(ads_id,coun_id) VALUES('" . $this->adsId . "','" . $cou[0] . "')");
                $co.=$cou[0] . ",";
            }
            $co = substr_replace($co, "", -1);
        } else {
            //$this->con->execute("INSERT INTO privacy_country(ads_id,coun_id) VALUES('" . $this->adsId . "','0')");
            $co = 0;
        }

        $prov = false;
        if ($pro = $this->read->get("pro", "POST")) {
            foreach ($pro as $p) {
                $pr = explode("/", $p);
                //$this->con->execute("INSERT INTO privacy_state(ads_id,stid) VALUES('" . $this->adsId . "','" . $p . "')");
                $prov.=$pr[0] . ",";
            }
            $prov = substr_replace($prov, "", -1);
        } else {
            //$this->con->execute("INSERT INTO privacy_state(ads_id,stid) VALUES('" . $this->adsId . "','0')");
            $prov = 0;
        }


        $dist = false;
        if ($dis = $this->read->get("dis", "POST")) {
            foreach ($dis as $d) {
                //$this->con->execute("INSERT INTO privacy_district(ads_id,dis_id) VALUES('" . $this->adsId . "','" . $d . "')");
                $dist.=$d . ",";
            }
            $dist = substr_replace($dist, "", -1);
        } else {
            //$this->con->execute("INSERT INTO privacy_district(ads_id,dis_id) VALUES('" . $this->adsId . "','0')");
            $dist = 0;
        }
        $jobs = false;
        if ($job = $this->read->get("job", "POST")) {
            foreach ($job as $j) {
                //$this->con->execute("INSERT INTO privacy_job(ads_id,job_id) VALUES('" . $this->adsId . "','" . $j . "')");
                $jobs.=$j . ",";
            }
            $jobs = substr_replace($jobs, "", -1);
        } else {
            //$this->con->execute("INSERT INTO privacy_job(ads_id,job_id) VALUES('" . $this->adsId . "','0')");
            $jobs = 0;
        }


        if (!$pakage = $this->read->get("pakage", "POST")) {
            $pakage = 100;
        }
        if (!$gender = $this->read->get("gender", "POST")) {
            $gender = "MF";
        }
        if (!$_18 = $this->read->get("_18", "POST")) {
            $_18 = 100;
        }
        //$this->con->execute("INSERT INTO privacy_user(ads_id,gender,_18,pakage) VALUES('" . $this->adsId . "','" . $gender . "','" . $_18 . "','" . $pakage . "')");
        if (!$this->con->execute("INSERT INTO ads_privacy(ads_id,coun_id,dis_id,job_id,stid,gender,_18,pakage) VALUES('" . $this->adsId . "','" . $co . "','" . $dist . "',
            '" . $jobs . "','" . $prov . "','" . $gender . "','" . $_18 . "','" . $pakage . "')")) {
            return false;
        }
        return true;
    }

    public function setAdvertiserCashbook($payment=false, $amount=false, $paymethode=false) {
        if (!$payment && !$amount && !$paymethode) {
            return false;
        }
        if ($payment == 1) {
            $pq = "initial_payment";
        } else if ($payment == 2) {
            $pq = "balence_payment";
        } else if ($payment == 3) {
            $pq = "advnce_payment";
        }
        $query = "INSERT INTO advertiser_cashbook(ads_id,amount,date,pay_method,comment," . $pq . ") VALUES('" . $this->adsId . "','" . $amount . "','" . $this->dateTime . "','" . $paymethode . "','pay for ads','" . $payment . "')";
        if (!$this->con->execute($query)) {

            return false;
        }
    }

}

?>
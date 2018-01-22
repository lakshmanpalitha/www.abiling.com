<?php

class adsclass {

    private $dateTime;
    private $date;
    private $second;
    private $adsId;
    private $acid;

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
        $this->email = new email();

        $this->acid = $this->pr->getSession("adtac");
    }

    public function addAds() {

        if (!$data = $this->qu->getFormPost()) {
            return false;
        }
        $data['account_id'] = $this->acid;
        $data['submit_date'] = $this->dateTime;
        $data['ads_type'] = $this->read->get("ads_type", "post");
        if ($data['ads_type'] == 1) {
            if (!$this->read->get("url", "post")) {
                $this->er->createerror("Url Missing", 1);
                return false;
            }
            if ($curl = $this->read->get("url", "post")) {
                $c1 = explode(":", $curl);

                if (!$c1[0]) {
                    $this->er->createerror("Invalid Url", 1);
                    return false;
                }
                if ($c1[0] != "http") {
                    $this->er->createerror("Invalid Url(Missing - http://)", 1);
                    return false;
                }
            }
            $data['url'] = $this->read->get("url", "post");
        }
        if ($this->read->get("np", "POST") && $this->read->get("np", "POST") == 1) {
            $data['from'] = "";
            $data['to'] = "";
        }
        if (!$InsertQuery = $this->qu->insertQuery($data, "submit_ads_info")) {
            $this->er->createerror("Application Error(adtaccount line:19)", 1);
            return false;
        }
        if (!$this->con->execute($InsertQuery)) {

            return false;
        }
        $this->adsId = $this->con->queryUniqueValue("SELECT ads_id FROM submit_ads_info ORDER BY ads_id DESC ");

        if ($data['ads_type'] == 2) {
            if (!$this->upTempAdsFile()) {
                return false;
            }
        }
        $this->pr->redirect("createads2.php?id1=" . $this->adsId);
    }

    public function setAdsPrivacy($id) {
        if (!$id) {
            return false;
        }
        $this->adsId = $id;
        $loc = array();
        $country = false;
        $loc['coun'] = false;
        if ($coun = $this->read->get("coun", "POST")) {
            foreach ($coun as $c) {
                $country.=$c . ",";
            }
            $loc['coun'] = substr_replace($country, "", -1);
        } else {
            $this->er->createerror("Please Select Country", 1);
            return false;
        }
        $province = false;
        $loc['pro'] = false;
        if ($pro = $this->read->get("pro", "POST")) {
            foreach ($pro as $p) {
                $province.=$p . ",";
            }
            $loc['pro'] = substr_replace($province, "", -1);
        } else {
            $this->er->createerror("Please Select Province/State", 1);
            return false;
        }
        $district = false;
        $loc['dis'] = false;
        if ($dis = $this->read->get("dis", "POST")) {
            foreach ($dis as $d) {
                $district.=$d . ",";
            }
            $loc['dis'] = substr_replace($district, "", -1);
        }

        $loc['job'] = false;
        $jobs = false;
        if ($job = $this->read->get("job", "POST")) {

            foreach ($job as $j) {
                $jobs.=$j . ",";
            }
            $loc['job'] = substr_replace($jobs, "", -1);
        } else {
            $this->er->createerror("Please Select Jobs", 1);
            return false;
        }
        $loc['cat'] = false;
        if ($accat = $this->read->get("pakage", "POST")) {

            $loc['cat'] = $accat;
        } else {
            $this->er->createerror("Please Select Account", 1);
            return false;
        }
        $loc['sex'] = false;
        if ($sex = $this->read->get("gender", "POST")) {

            $loc['sex'] = $sex;
        } else {
            $this->er->createerror("Please Select Gender", 1);
            return false;
        }
        $loc['_18'] = false;
        if ($_18 = $this->read->get("_18", "POST")) {

            $loc['_18'] = $_18;
        } else {
            $this->er->createerror("Please Select Age", 1);
            return false;
        }
        $query = "INSERT INTO submit_ads_select_crytaria(ads_id,country,pro,dis,job,account,sex,grade) VALUES('" . $this->adsId . "','" . $loc['coun'] . "'
                ,'" . $loc['pro'] . "','" . $loc['dis'] . "','" . $loc['job'] . "','" . $loc['cat'] . "','" . $loc['sex'] . "','" . $loc['_18'] . "')";



        if (!$this->con->execute($query)) {

            return false;
        }



        return $this->adsId;
    }

//uploads images,mp3,video related to info ads
    private function upTempAdsFile() {
        $uploadPath = "../uploads/" . $this->acid . "/";
        if (!is_dir($uploadPath)) {
            if (!mkdir($uploadPath, 0777)) {
                $this->er->createerror("folder create action failed!", 1);
                return false;
                exit;
            }
        }

        if ($_FILES["file"]["name"]) {
            $i = 0;
            foreach ($_FILES["file"]["name"] as $file) {

                $file_size = filesize($_FILES['file']['tmp_name'][$i]);
                $file_name = stripslashes($_FILES['file']['name'][$i]);
                $boss = explode(".", strtolower($file_name));
                $extension = strtolower(end($boss));

                $array = array('jpg', 'jpeg', 'png', 'gif', 'wma', 'mp3'); # store all allowed file type in array

                if (!in_array($extension, $array)) {
                    #see if file type is in array else stop execution
                    $this->er->createerror($file_name . " invalid file type", 1);
                    return false;
                    exit;
                }

                if ($file_size > 10000000) {
                    $this->er->createerror($file_name . " exceed upload size", 1);
                    return false;
                    exit;
                }
                $i++;
            }
            $i = 0;
            foreach ($_FILES["file"]["name"] as $file) {
                $upfilename = $this->acid . "_" . $this->adsId . "_" . rand(100, 100000) . "_" . $_FILES['file']['name'][$i];
                $uploadPath.=$upfilename;
                if (!move_uploaded_file($_FILES['file']['tmp_name'][$i], $uploadPath)) {
                    $this->er->createerror($_FILES['file']['name'][$i] . " upload failed", 1);
                } else {
                    $this->con->execute("INSERT INTO submit_ads_file(ads_id,file) VALUES('" . $this->adsId . "','" . $upfilename . "')");
                }
                $i++;
            }
        }

        return true;
    }

    public function setAdvertiserCashbook($adid=false, $payment=false, $amount=false, $paymethode=false, $comment=false, $txn_id=false) {
        if ($adid) {
            $this->adsId = $adid;
        }
        if (!$payment && !$amount && !$paymethode) {

            // return false;
        }
        if ($payment == 1) {
            $pq = "initial_payment";
        } else if ($payment == 2) {
            $pq = "balence_payment";
        } else if ($payment == 3) {
            $pq = "advnce_payment";
        }

        if ($comment) {
            $msg = $comment;
        } else {
            $msg = "Pay by advertiser";
        }

        $query = "INSERT INTO advertiser_cashbook(transaction_id,ads_id,amount,date,pay_method,comment," . $pq . ") VALUES('" . $txn_id . "','" . $this->adsId . "','" . $amount . "','" . $this->dateTime . "','" . $paymethode . "','" . $msg . "','" . $payment . "')";
        if (!$this->con->execute($query)) {

            return false;
        }
        if ($paymethode == 1) {
            $me = "Manual";
        } else if ($paymethode == 2) {
            $me = "PayPal";
        } else if ($paymethode == 3) {
            $me = "online";
        }
        $adtsum = new adtsummary();
        $mem = $adtsum->getAdvertiserDetail();
        $massage= "Hello! Welcome to the best advertising provider panoraadvertising.com!\r\n";
        $massage.= "We 've received your request. You can expect a response within 24 hours.\r\n";
        $massage.= "If you have got any doubt you can send a mail to info@panoraadvertising.com\r\n";
        $massage.= "Thanks and Regards,";
        $massage.= "http://www.panoraadvertising.com";
        $email->setEmail($mem->email, "Verification Mail", $massage);
        $email->send();

        $massage = "Member account id:" . $mem->account_id . "\r\n";
        $massage.="Name: " . $mem->first_name . "\r\n";
        $massage.="Email: " . $mem->email . "\r\n";
        $massage.="Ad ID: " . $mem->email . "\r\n";
        $massage.="Amount: " . $amount . "\r\n";
        $massage.="Pay Date: " . $this->dateTime . "\r\n";
        $massage.="Pay Method: " . $me . "\r\n";
        $this->email->setEmail(null, $pq . "payment done", $massage);
        $this->email->send();
        return true;
    }

}

?>
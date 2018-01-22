<?php

class advclass {

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
        $this->en = new Encryption();
        if ($id) {
            $this->userId = $id;
        } else {
            $this->userId = $this->pro->getSession("advac");
        }
    }

    public function setUser($accountType=false) {

        if (!$accountType) {
            return false;
        }
        if (!$data = $this->qu->getFormPost()) {
            return false;
        }
        $mobile=$data['phone'];
        if ($mobile[0]!="+") {
            $this->er->createerror("Invalid mobile no (Ex : +94112000000)", 1);
            return false;
        }
        $data['address'] = $data['address'] . " " . $data['address2'];
        unset($data['address2']);
        $isuser = $this->con->queryUniqueObject("SELECT email,first_name FROM account WHERE first_name='" . $data['first_name'] . "' OR email='" . $data['email'] . "'");
        if ($isuser) {
            if ($isuser->email == $data['email']) {
                $this->er->createerror("Email " . $data['email'] . " allredy registerd", 1);
                return false;
            }
            if ($isuser->first_name == $data['first_name']) {
                $this->er->createerror("First_name " . $data['first_name'] . " is allredy registerd", 1);
                return false;
            }
        }

        $pakage = $data['pakage'];
        unset($data['pakage']);
        if ($data['password'] != $data['repassword']) {
            $this->er->createerror("Password not macth", 1);
            return false;
        }
        $start = strtotime($data['bday']);
        $end = strtotime($this->date);
        try {
            $days_between = ceil(abs($end - $start) / 86400);
            if ($days_between > 6573) {
                $_18 = 1;
            } else {
                $_18 = 2;
            }
        } catch (Exception $e) {
            throw new Exception('Something really gone wrong', 0, $e);
        }
        unset($data['repassword']);
        $data['password'] = $this->en->encode($data['password']);
        $data['account_type'] = 2;
        $data['register_date'] = $this->date;
        $data['_18'] = $_18;

        if (!$InsertQuery = $this->qu->insertQuery($data, "account")) {
            $this->er->createerror("Application Error(adtaccount line:19)", 1);
            return false;
        }
        if (!$this->con->execute($InsertQuery)) {

            return false;
        }
        $accountId = $this->con->queryUniqueValue("SELECT account_id FROM account ORDER BY account_id DESC ");
        $regPrice = $this->con->queryUniqueValue("SELECT value FROM settings_pakage WHERE id='" . $pakage . "'");


        if (!$accountId && !$regPrice) {
            return false;
        }

        $query = "INSERT INTO adviewer_register(account_id,pakage,account_type,round_date) VALUES('" . $accountId . "','" . $pakage . "','" . $accountType . "','" . $this->date . "')";
        if (!$this->con->execute($query)) {

            return false;
        }
        $advad = new advadloadclass($accountId);
        $advad->setAd(0);
        $his = new history($accountId);
        $his->addToHistory("Your account registered");

        $this->er->clearFromvalue();

        $value = array();
        array_push($value, $accountId);
        array_push($value, $regPrice);

        return $value;
    }

    public function logout() {
        $this->pro->unsetSession("adv");
        $this->pro->unsetSession("advac");
        $this->pro->unsetSession("loginusername");
        $this->pro->redirect("../index.php");
    }

    public function getUser() {
        $user = $this->con->queryUniqueObject("SELECT * FROM account ac,adviewer_register ar WHERE ac.account_id=ar.account_id AND ac.account_id='" . $this->userId . "'");
        if (!$user) {
            return false;
        }
        return $user;
    }

    public function blockAccount() {
        if (!$this->con->execute("UPDATE account SET isblock=IF(isblock = 0, 1, IF(isblock = 1, 0, 0))  WHERE account_id='" . $this->userId . "'")) {
            return false;
        }
        return true;
    }

    public function deleteAccount() {
        if (!$this->con->execute("UPDATE account SET del_ad=1 WHERE account_id='" . $this->userId . "'")) {
            return false;
        }
        return true;
    }

    //load click ads for each member
}

?>
<?php

class adtclass {

    private $qu;
    private $date;

    public function __construct($id=false) {
        date_default_timezone_set('Australia/Melbourne');
        $this->date = date('Y-m-d');
        $this->qu = new query();
        $this->con = new DB();
        $this->er = new errormsg();
        $this->pro = new process();
        $this->read = new read();
        if ($id) {
            $this->userId = $id;
        } else {
            $this->userId = $this->pro->getSession("adtac");
        }
    }

    public function register() {

        if (!$data = $this->qu->getFormPost()) {
            return false;
        }
        $mobile = $data['phone'];
        if ($mobile[0] != "+") {
            $this->er->createerror("Invalid mobile no (Ex : +94112000000)", 1);
            return false;
        }
        $data['address'] = $data['address'] . " " . $data['address2'];
        unset($data['address2']);
        if (!$this->read->get("repassword", "POST")) {

            $this->er->createerror("enter required fields", 1);
            return false;
        }
        if ($data['password'] != $this->read->get("repassword", "POST")) {
            $this->er->createerror("Password mismatch", 1);
            return false;
        }
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
        $this->er->clearFromvalue();
        $data['password'] = md5($data['password']);
        $data['register_date'] = $this->date;
        $data['account_type'] = 3;
        if (!$InsertQuery = $this->qu->insertQuery($data, "account")) {
            $this->er->createerror("Application Error(adtaccount line:19)", 1);
            return false;
        }


        if (!$this->con->execute($InsertQuery)) {

            return false;
        }



        $this->er->createerror("Register Successfully", 0);
        return true;
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

    public function logout() {
        $this->pro->unsetSession("adt");
        $this->pro->unsetSession("adtac");
        $this->pro->redirect("../index.php");
    }

}

?>
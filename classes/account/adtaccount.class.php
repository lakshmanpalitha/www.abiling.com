<?php

class adtclass {

    private $qu;
    private $date;

    public function __construct($id=false) {
        date_default_timezone_set('Asia/Calcutta');
        $this->date = date('Y-m-d');
        $this->qu = new query();
        $this->con = new DB();
        $this->er = new errormsg();
        $this->pro = new process();
        $this->read = new read();
        $this->email = new email();
        $this->en = new Encryption();
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
        $isuser = $this->con->queryUniqueObject("SELECT email,first_name FROM account WHERE email='" . $data['email'] . "') AND del_ad=0");
        if ($isuser) {
            if ($isuser->email == $data['email']) {
                $this->er->createerror("Email " . $data['email'] . " allredy registerd", 1);
                return false;
            }
//            if ($isuser->first_name == $data['first_name']) {
//                $this->er->createerror("First_name " . $data['first_name'] . " is allredy registerd", 1);
//                return false;
//            }
        }
        $this->er->clearFromvalue();
        $pass = $data['password'];
        $data['password'] = $this->en->encode($data['password']);
        $data['register_date'] = $this->date;
        $data['account_type'] = 3;
        if (!$InsertQuery = $this->qu->insertQuery($data, "account")) {
            $this->er->createerror("Application Error(adtaccount line:19)", 1);
            return false;
        }


        if (!$this->con->execute($InsertQuery)) {

            return false;
        }



        $massage = "<html><body>";

        $massage.="<p>Welcome to the best advertising provider panoraadvertising</p></br>";

        $massage.="<p>You can access members area at:</p></br>";
        $massage.="<p>http://www.panoraadvertising.com/common/login.php</p></br>";

        $massage.="<p>Login user name: " . $data['user_name'] . "</p></br>";
        $massage.="<p>Password:" . $pass . "\n";

        $massage.="<p>Our members area allows you to see ads and other account details of your account.</p></br>";

        $massage.="<p>If you have any questions, please contact us and we will be more than happy to assist you.</p></br>";

        $massage.="<p>Thanks and Regards,</p></br>";

        $massage.="<p>www.panoraadvertising.com</p></br>";

        $massage.="<p>+++</p></br>";
        $massage.="<p>Do not reply to this email, this is automatically generated message.</p></br>";
        $massage.="<p>+++</p></br>";
        $massage .= "</body></html>";
        $this->email->setEmail($data['email'], "Activated Account", $massage);
        $this->email->send();
        $massage = false;

        $nmassage = "<html><body>";
        $nmassage.="<p>New advertier was regitered.</p></br>";
        $nmassage.="<p>Name:" . $data['first_name'] . "</p></br>";
        $nmassage.="<p>Address: " . $data['address'] . "</p></br>";
        $nmassage.="<p>Phone: " . $data['phone'] . "</p></br>";
        $nmassage.="</body></html>";
        $this->email->setEmail("", "New Advertier Registered", $nmassage);
        $this->email->send();
        $this->er->createerror("Successfully Register!", 1);

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
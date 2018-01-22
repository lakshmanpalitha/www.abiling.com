<?php

class process {

    public function process() {
        $this->read = new read();
        $this->con = new DB();
        $this->er = new errormsg();
        $this->qu = new query();
    }

    public function sessionCheck() {
        if ($this->session->logedin)
            return true;
        return false;
    }

    public function redirect($url) {
        echo '<meta http-equiv="refresh" content="0;url=' . $url . '">';
        exit;
    }

    public function craeteSession($sessionName, $value=true) {
        if (isset($_SESSION[$sessionName])) {
            unset($_SESSION[$sessionName]);
        }
        $_SESSION[$sessionName] = $value;
    }

    public function checkSession() {
        if (isset($_SESSION['adv']) || isset($_SESSION['adt'])) {
            return true;
        }
        return false;
    }

    public function getSession($sessionName) {
        if (!isset($_SESSION[$sessionName]) && empty($_SESSION[$sessionName])) {
            return false;
        }
        return $_SESSION[$sessionName];
    }

    public function unsetSession($sessionName) {
        if (!isset($_SESSION[$sessionName])) {
            return false;
        }
        unset($_SESSION[$sessionName]);
        return true;
    }

    public function login() {
        if (!$data = $this->qu->getFormPost()) {
            return false;
        }
        
        $adt = $this->con->queryUniqueObject("SELECT * FROM account WHERE del_ad=0 AND user_name='" . $data['user_name'] . "' AND password='" . $this->en->encode($data['password']) . "'");
        if (!$adt) {
            $this->er->createerror("Invalid username or password", 1);
            return false;
        }
        if ($adt == "db_error") {

            return false;
        }



        $this->unsetSession("adv");
        $this->unsetSession("adt");
        $this->unsetSession("admin");

        if ($adt->account_type == 1) {
            $this->craeteSession("admin", true);
            $this->craeteSession("adid", $adt->account_id);
            $this->craeteSession("user", $this->con->queryUniqueValue("SELECT first_name FROM account WHERE account_id='" . $adt->account_id . "'"));
            $this->redirect("../manager/index.php");
        }
        if ($adt->account_type == 2) {
            if (!$this->con->queryUniqueValue("SELECT account_id FROM adviewer_register WHERE ispay=1 AND account_id='" . $adt->account_id . "'")) {
                $this->er->createerror("Your account not activated", 1);
                return false;
            }
            if($adt->isblock==1){
                $this->er->createerror("Your account temprely blocked!. Please contact panora admin furthermore detail", 1);
                return false; 
            }
            $this->craeteSession("adv", true);
            $this->craeteSession("advac", $adt->account_id);
            $this->craeteSession("user", $this->con->queryUniqueValue("SELECT first_name FROM account WHERE account_id='" . $adt->account_id . "'"));
            $this->redirect("../members/dashbord.php");
        }
        if ($adt->account_type == 3) {
            if($adt->isblock==1){
                $this->er->createerror("Your account temprely blocked!. Please contact panora admin furthermore detail", 1);
                return false; 
            }
            $this->craeteSession("adt", true);
            $this->craeteSession("adtac", $adt->account_id);
            $this->craeteSession("user", $this->con->queryUniqueValue("SELECT first_name FROM account WHERE account_id='" . $adt->account_id . "'"));
            $this->redirect("../advertiser/dashbord.php");
        } else {
            $this->er->createerror("Application errror(process.class.php-line:74)", 1);
            return false;
        }
    }

    public function createVerifyIcons() {
        $no = rand(1, 5);
        $ico = array();
        $html = "";
        $html.= "<ul id='icon' style='display:none;'>";

        for ($i = $no; $i >= 1; $i--) {
            $html.="<li><a href='#'><img onclick='verifyimg(" . $i . ")' src='../images/icons/" . $i . ".jpg'/></a></li>";
        }
        for ($i = $no + 1; $i <= 5; $i++) {
            $html.="<li><a href='#'><img onclick='verifyimg(" . $i . ")' src='../images/icons/" . $i . ".jpg'/></a></li>";
        }
        $html.="</ul>";
        $newHtml = "<ul style='display:none;' id='sel_icon'><li>click on  match image from image list</li><li><img src='../images/icons/2.jpg'/></li></ul>";
        array_push($ico, $no);
        array_push($ico, $html);
        array_push($ico, $newHtml);

    }

    public function getRegistrationInfo($id) {
        if (!$id) {
            return false;
        }
        $reg = $this->con->queryUniqueObject("SELECT *  FROM  account  WHERE account_id='" . $id . "'");
        if (!$reg) {
            return false;
        }

        return $reg;
    }

}

?>
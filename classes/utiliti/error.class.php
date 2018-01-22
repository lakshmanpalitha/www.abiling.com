<?php

class errormsg {

    private $err = "";

    public function errormsg() {
        $this->ob = new stdClass;
    }

    public function createerror($e, $errorcode) {

        $this->err.="<li>" . $e . "</li>";
        $_SESSION['error'] = $this->err;
        $_SESSION['error_code'] = $errorcode;
        return true;
    }

    public function displayerror() {
        if (!empty($_SESSION['error'])) {
            $this->ob->error = "<ul class='error_dis'>" . $_SESSION['error'] . "</ul>";
            $this->ob->error_code = $_SESSION['error_code'];
        } else {
            $this->ob->error = false;
            $this->ob->error_code = false;
        }
        $this->err = "";
        $_SESSION['error'] = "";
        $_SESSION['error_code'] = "";
        return $this->ob;
    }

    public function setFromValue($key, $value) {
        $fromValue = array();
        if (isset($_SESSION['fromValue']) && !empty($_SESSION['fromValue'])) {
            $fromValue = $_SESSION['fromValue'];
            $fromValue[$key] = $value;
            $_SESSION['fromValue'] = $fromValue;
        } else {
            $fromValue[$key] = $value;
            $_SESSION['fromValue'] = $fromValue;
        }
    }

    public function getFromValue() {
        if (isset($_SESSION['fromValue']) && !empty($_SESSION['fromValue'])) {
            $fromValue = $_SESSION['fromValue'];
            unset($_SESSION['fromValue']);
            return $fromValue;
        }
    }

    public function clearFromvalue() {
        if (isset($_SESSION['fromValue'])) {
            unset($_SESSION['fromValue']);
        }
    }

}
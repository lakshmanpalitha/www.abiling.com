<?php

class sessionManager {

    public $userid;
    public $logedin;
    private $con;

    public function sessionManager() {
        if (isset($_SESSION['userid'])) {
            $this->userid = &$_SESSION['userid'];
            $this->logedin = &$_SESSION['logedin'];
            $this->uip = $_SERVER['REMOTE_ADDR'];
        }
        $this->con = new DB();
    }

    public function setUser($username=false, $password=false) {
        $cn = $this->con;
        $this->reset();
        $this->con = $cn;

        if ($username && $password) {
            $user = $this->con->queryUniqueObject("SELECT * FROM `user` WHERE `uname`='" . mysql_real_escape_string($username) . "' AND `pass`='" . mysql_real_escape_string(md5($password)) . "'");

            if ($user) {
                if ($user->pass == md5($password)) {
                    $_SESSION['userid'] = $user->uid;
                    $_SESSION['logedin'] = true;




                    $this->userid = &$_SESSION['userid'];
                    $this->logedin = &$_SESSION['logedin'];



                    return true;
                } else {
                    //$this->messages->add(WRONG_USERNAME_PASSWORD,'ERROR');					
                }
            } else {
                //$this->messages->add(WRONG_USERNAME_PASSWORD,'ERROR');
            }
        } else {
            //$this->messages->add(WRONG_USERNAME_PASSWORD,'ERROR');
        }
        return false;
    }

    //reset function to reset all variables
    private function reset() {
        foreach (get_class_vars('sessionManager') as $var => $val) {//looping throug all the variables
            $this->$var = NULL; //setting variable to null
        }
        $_SESSION['userid'] = NULL;
        $_SESSION['logedin'] = NULL;
        ;
    }

    private function check() {
        if ($this->userid) {
            return true;
        }

        if (!$this->invalid) {
            //$this->messages=new messages();
            //$this->messages->add(INVALID_USER,'ERROR');
            $this->invalid = true;
        }
        return false;
    }

    public function logOut() {
        //$this->messages->add(LOGGED_OUT,'SUCCESS');
        $this->reset();
        return true;
    }

}

?>
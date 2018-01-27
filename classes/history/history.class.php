<?php

class history {

    private $dateTime;
    private $date;
    private $second;
    private $acid;

    public function __construct($id=false, $ref='N') {
        date_default_timezone_set('Asia/Calcutta');
        $this->dateTime = date('Y-m-d H:i:s');
        $this->date = date('Y-m-d');
        $this->second = date('Hs');
        $this->con = new DB();
        $this->read = new read();
        $this->pr = new process();
        $this->er = new errormsg();
        $this->qu = new query();
        
        if ($ref == "Y") {
            $this->acid = $id;
        } else if ($this->pr->getSession("advac")) {
            $this->acid = $this->pr->getSession("advac");
        } else if ($this->pr->getSession("adtac")) {
            $this->acid = $this->pr->getSession("adtac");
        } else {
            $this->acid = $id;
        }
    }

    public function addToHistory($msg) {

        if (!$this->con->execute("INSERT history(account_id,discription,date) VALUES('" . $this->acid . "','" . $msg . "','" . $this->date . "')")) {
            return false;
        }
        return false;
    }

    public function getHistory() {
        if (!$his = $this->con->queryMultipleObjects("SELECT * FROM history WHERE account_id='" . $this->acid . "' ORDER BY date DESC LIMIT 10")) {
            return false;
        }
        return $his;
    }

}

?>
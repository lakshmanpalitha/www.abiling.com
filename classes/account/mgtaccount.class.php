<?php

class mgtclass {

    private $qu;
    private $date;

    public function __construct() {
        date_default_timezone_set('Australia/Melbourne');
        $this->date = date('Y-m-d');
        $this->qu = new query();
        $this->con = new DB();
        $this->er = new errormsg();
        $this->pro = new process();
        $this->read = new read();
    }
    

}

?>
<?php

class query {

    public $fields = null;
    public $fields_req = null;
    public $field_email = null;
    public $field_int = null;
    public $field_email_req = null;
    public $field_int_req = null;
    public $table = null;
    public $task = null;
    public $isfFieldSet = false;
    public $read = false;
    public $er = false;
    public $val = false;
    public $arr = false;

    function query() {
        $this->read = new read();
        $this->er = new errormsg();
        $this->obj = new stdClass;
        $this->fobj = new stdClass;
        $this->val = new validation();
    }

    public function getFormPost() {


        ($this->read->get('fields', POST) ? $this->createFromValue($this->read->get('fields', POST)) : "");
        ($this->read->get('fields_req', POST) ? $this->createFromValue($this->read->get('fields_req', POST)) : "");
        ($this->read->get('field_email_req', POST) ? $this->createFromValue($this->read->get('field_email_req', POST)) : "");
        ($this->read->get('field_int', POST) ? $this->createFromValue($this->read->get('field_int', POST)) : "");
        ($this->read->get('field_int_req', POST) ? $this->createFromValue($this->read->get('field_int_req', POST)) : "");


        if ($this->read->get('fields', POST)) {

            $isfFieldSet = true;
            $values = $this->val->setArray($this->read->get('fields', POST), $methode = false, $validate = false);

            if (!$values) {
                return false;
                exit();
            } else {
                $this->collectFieldSet($values);
                $values = false;
            }
        }

        if ($this->read->get('fields_req', POST)) {

            $isfFieldSet = true;
            $values = $this->val->setArray($this->read->get('fields_req', POST), $methode = 'req', $validate = false);

            if (!$values) {
                return false;
                exit();
            } else {
                $this->collectFieldSet($values);
                $values = false;
            }
        }

        if ($this->read->get('field_email_req', POST)) {
            $isfFieldSet = true;

            $values = $this->val->setArray($this->read->get('field_email_req', POST), $methode = 'req', $validate = 'email');
            if (!$values) {
                return false;
                exit();
            } else {
                $this->collectFieldSet($values);
                $values = false;
            }
        }

        if ($this->read->get('field_int', POST)) {
            $isfFieldSet = true;
            $values = $this->val->setArray($this->read->get('field_int', POST), $methode = false, $validate = 'int');

            if (!$values) {
                return false;
                exit();
            } else {
                $this->collectFieldSet($values);
                $values = false;
            }
        }

        if ($this->read->get('field_int_req', POST)) {
            $isfFieldSet = true;
            $values = $this->val->setArray($this->read->get('field_int_req', POST), $methode = 'req', $validate = 'int');
            if (!$values) {
                return false;
                exit();
            } else {
                $this->collectFieldSet($values);
                $values = false;
            }
        }
        
        return $this->arr;
    }

    private function createFromValue($index) {
        foreach ($index as $gkey => $gvalue) {
            //$this->obj->$gkey = $gvalue;
            $this->er->setFromValue($gkey, $gvalue);
        }
    }

    private function collectFieldSet($index) {
        foreach ($index as $fkey => $fvalue) {
            $this->arr[$fkey] = $fvalue;
        }
    }

    public function insertQuery($setOfFields=false, $table=false) {
        $fields = false;
        $values = false;
        if ($setOfFields && $table) {
            $sql = "INSERT INTO " . $table;

            foreach ($setOfFields as $key => $value) {
                $fields.="`".$key . "`,";
                $values.="'" . $value . "',";
            }
            $nfields = substr($fields, 0, -1);
            $nvalues = substr($values, 0, -1);
            $sql.="(" . $nfields . ") VALUES(" . $nvalues . ")";

            return $sql;
        }
    }

    private function updateQuery() {
        
    }

}

?>
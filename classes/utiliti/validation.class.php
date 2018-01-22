<?php

class validation{
    
    var $valueSet;
    
    public function validation(){
         $this->read = new read();
         $this->er=new errormsg();
         $this->obj = new stdClass;                          
    }
    
    public function setValidaton($index,$method=false,$validation=false){
        
       
       if ($index) {
                $isfFieldSet = true;
                $this->valueSet = $this->setArray($index,$method,$validation);

                if (!$this->valueSet) { 
                    return false;
                    exit();
                }else{
                    return $this->valueSet;
                }
            } 
    }
    
    public function setArray($index, $methode = false, $validate = false) {

        $i = 0;
        $data = false;
        $dd = false;
        foreach ($index as $key => $value) {


            (!$value ? $value = null : $value = $value);

            if ($methode == 'req' && !$value) {
                $this->er->createerror("enter required fields!",1);
                return false;
                exit();
            }

            if ($validate == 'int') {
                $intVal = $this->isInt($value);
                if (!$intVal) {
                    $this->er->createerror($key." must be a numeric!",1);
                    return false;
                    exit();
                }
            }

            if ($validate == 'email') {
                $emilVal = $this->isEmail($value);
                if (!$emilVal) {
                    $this->er->createerror($key." not valid email!",1);
                    return false;
                    exit();
                }
            }

//            $dd[$i]->index = $key;
//            $dd[$i]->value = $value;
             $dd[$key] = $value;
            $i++;
        }
        $data = $dd;
        return $data;
    }
    
     private function isInt($value) {
        if ($value == 0) {
            return 0;
        } else if (intval($value > 0)) {
            return intval($value);
        } else {
            return false;
        }
    }

    private function isEmail($value) {

        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }
    
}


?>
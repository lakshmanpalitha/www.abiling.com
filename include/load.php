<?php

header('Access-Control-Allow-Origin: *');
require_once('include.php');

$key = $read->get('key', "GET");
$id = $read->get('id', "GET");

switch ($key) {
    case 'gState' :
        $stList = $con->queryMultipleObjects("SELECT * FROM state WHERE coun_code='" . $id . "'");


        if ($stList) {

            $json = '{"result":{';
            $json.='"response":"true",';
            $json.='"state":[';


            $drows = count($stList);
            $n = 1;
            foreach ($stList as $dis) {
                $json.='{"name":"' . $dis->name . '",';
                $json.='"id":"' . $dis->stid . '"}' . ($n != $drows ? "," : "");
                $n++;
            }


            $json.=']}}';

            echo $json;
        }

        break;


    case 'gDis' :

        $disList = $con->queryMultipleObjects("SELECT * FROM districts WHERE pro_id='" . $id . "'");

        if ($disList) {
            $json = '{"result":{';
            $json.='"response":"true",';
            $json.='"district":[';


            $crows = count($disList);
            $n = 1;
            foreach ($disList as $cit) {
                $json.='{"name":"' . $cit->name . '",';
                $json.='"id":"' . $cit->id . '"}' . ($n != $crows ? "," : "");
                $n++;
            }



            $json.=']}}';

            echo $json;
        }

        break;

    case 'gMulStats' :

        if ($read->get("query", "POST") && $read->get("adsid", "GET")) {




            $json = '{"result":{';
            $json.='"response":"true",';
            $json.='"state":[';
            $x = 1;
            $y = 0;
            foreach ($read->get("query", "POST") as $q) {
                $stList = $con->queryMultipleObjects("SELECT * FROM state WHERE coun_code='" . $q . "'");
                $chooseStList = $con->queryUniqueObject("SELECT * FROM submit_ads_select_crytaria WHERE ads_id='" . $read->get("adsid", "GET") . "'");
                $exsist_state = false;
                if ($chooseStList)
                    $exsist_state = explode(",", $chooseStList->pro);
                if ($stList) {
                    $drows = count($stList);
                    $n = 1;
                    foreach ($stList as $dis) {
                        $ischeck = false;
                        if ($exsist_state) {
                            foreach ($exsist_state as $a) {
                                if (!$ischeck) {
                                    $ischeck = ( $dis->stid == $a ? 1 : 0);
                                }
                            }
                        }
                        $json.= ( $x != $y && $y != 0 ? "," : "") . '{"name":"' . $dis->name . '",';
                        $json.='"isin":"' . $ischeck . '",';
                        $json.='"id":"' . $dis->stid . '"}' . ($n != $drows ? "," : "");
                        $n++;
                        if ($y != $x) {
                            $y = $x;
                        }
                    }
                }
                $x++;
            }



            $json.=']}}';

            echo $json;
        }

        break;

    case 'gMulDis' :

        if ($read->get("query", "POST") && $read->get("adsid", "GET")) {

            $json = '{"result":{';
            $json.='"response":"true",';
            $json.='"district":[';
            $ndrows = count($read->get("query", "POST"));
            $x = 1;
            $y = 0;
            foreach ($read->get("query", "POST") as $q) {
                $stList = $con->queryMultipleObjects("SELECT * FROM districts WHERE pro_id='" . $q . "'");
                $chooseStList = $con->queryUniqueObject("SELECT * FROM submit_ads_select_crytaria WHERE ads_id='" . $read->get("adsid", "GET") . "'");
                $exsist_state = false;
                if ($exsist_state)
                    $exsist_state = explode(",", $chooseStList->dis);
                if ($stList) {
                    $drows = count($stList);
                    $n = 1;

                    foreach ($stList as $dis) {


                        $ischeck = false;
                        if ($exsist_state) {
                            foreach ($exsist_state as $a) {
                                if (!$ischeck) {
                                    $ischeck = ( $dis->id == $a ? 1 : 0);
                                }
                            }
                        }
                        $json.= ( $x != $y && $y != 0 ? "," : "") . '{"name":"' . $dis->name . '",';
                        $json.='"isin":"' . $ischeck . '",';
                        $json.='"id":"' . $dis->id . '"}' . ($n != $drows ? "," : "");
                        $n++;
                        if ($y != $x) {
                            $y = $x;
                        }
                    }
                }
                $x++;
            }



            $json.=']}}';

            echo $json;
        }

        break;

    case 'agMulStats' :

        if ($read->get("query", "POST")) {
            $json = '{"result":{';
            $json.='"response":"true",';
            $json.='"state":[';
            foreach ($read->get("query", "POST") as $q) {
                if ($q == 0) {
                    $stList = $con->queryMultipleObjects("SELECT * FROM state");
                } else {
                    $stList = $con->queryMultipleObjects("SELECT * FROM state WHERE coun_code='" . $q . "'");
                }




                if ($stList) {
                    $drows = count($stList);
                    $n = 1;
                    foreach ($stList as $dis) {
                        $json.='{"name":"' . $dis->name . '",';
                        $json.='"id":"' . $dis->stid . '"},';
                        $n++;
                    }
                }
            }


            $json = substr_replace($json, "", -1);
            $json.=']}}';

            echo $json;
        }

        break;

    case 'agMulDis' :

        if ($read->get("query", "POST")) {
            $json = '{"result":{';
            $json.='"response":"true",';
            $json.='"district":[';
            $ndrows = count($read->get("query", "POST"));
            $x = 1;
            foreach ($read->get("query", "POST") as $q) {

                if ($q == 0) {
                    $stList = $con->queryMultipleObjects("SELECT * FROM districts");
                } else {
                    $stList = $con->queryMultipleObjects("SELECT * FROM districts WHERE pro_id='" . $q . "'");
                }


                if ($stList) {
                    $drows = count($stList);
                    $n = 1;

                    foreach ($stList as $dis) {
                        $json.= '{"name":"' . $dis->name . '",';
                        $json.='"id":"' . $dis->id . '"},';
                        $n++;
                    }
                }
                $x++;
            }


            $json = substr_replace($json, "", -1);
            $json.=']}}';

            echo $json;
        }

        break;

    case 'anyrun' :
        $anyad = $advcad->checkAnyAdIsRunning($id);
        if ($anyad) {
            $json = '{"result":{';
            $json.='"response":"true"';
            $json.='}}';
        } else {
            $json = '{"result":{';
            $json.='"response":"false"';
            $json.='}}';
        }

        echo $json;

        break;


    case 'unset' :
        $unset = $advcad->unsetAdIsRunning($id);
        if ($unset) {
            $json = '{"result":{';
            $json.='"response":"true"';
            $json.='}}';
        } else {
            $json = '{"result":{';
            $json.='"response":"false"';
            $json.='}}';
        }

        echo $json;
        break;


    case 'tmp' :
        $temp = $advcad->tempblockAd($id);
        if ($temp) {
            $json = '{"result":{';
            $json.='"response":"true"';
            $json.='}}';
        } else {
            $json = '{"result":{';
            $json.='"response":"false"';
            $json.='}}';
        }
        echo $json;
        break;
    case 'block' :
        $block = $advcad->checkAdBlock($id);
        if ($block) {
            $json = '{"result":{';
            $json.='"response":"true"';
            $json.='}}';
        } else {
            $json = '{"result":{';
            $json.='"response":"false"';
            $json.='}}';
        }
        echo $json;
        break;

    case 'verifyAd' :
        $am = $advcad->verifyAdclick($id);
        if ($am) {
            $json = '{"result":{';
            $json.='"response":"' . $am . '"';
            $json.='}}';
        } else {
            $json = '{"result":{';
            $json.='"response":"false"';
            $json.='}}';
        }
        echo $json;
        break;
}
?>

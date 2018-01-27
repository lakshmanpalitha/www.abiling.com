<?php

class adsinfoclass {

    private $dateTime;
    private $date;
    private $second;
    private $acid;

    public function __construct() {
        date_default_timezone_set('Asia/Calcutta');
        $this->dateTime = date('Y-m-d H:i:s');
        $this->date = date('Y-m-d');
        $this->second = date('Hs');
        $this->con = new DB();
        $this->read = new read();
        $this->pr = new process();
        $this->er = new errormsg();
        $this->qu = new query();

        $this->acid = $this->pr->getSession("adtac");
    }

    public function totOfViewAds($ads_id=false) {
        if (!$ads_id) {
            return false;
        }
        $tot = $this->con->queryUniqueValue("SELECT COUNT(ads_id) AS tot FROM adviewer_view_ads WHERE (temp_block=1 OR isblock=1) AND ads_id='" . $ads_id . "'");
        if (!$tot) {
            return 0;
        }
        return $tot;
    }

    public function adClicksCountryWise($coun_id=false, $ads_id=false) {
        if (!$coun_id && !$ads_id) {
            $list = $this->con->queryMultipleObjects("SELECT ac.country AS coun,COUNT(ads_id ) AS tot FROM account ac,adviewer_view_ads av WHERE (av.temp_block=1 OR av.isblock=1) AND ac.account_id=av.account_id GROUP BY ac.country");
            if (!$list) {
                return 0;
            }
            return $list;
        } else if ($ads_id) {
            $list = $this->con->queryMultipleObjects("SELECT ac.country AS coun,COUNT(ads_id ) AS tot FROM account ac,adviewer_view_ads av WHERE (av.temp_block=1 OR av.isblock=1) AND ac.account_id=av.account_id AND av.ads_id='" . $ads_id . "' GROUP BY ac.country");
            if (!$list) {
                return 0;
            }
            return $list;
        } else if ($ads_id && $coun_id) {
            $list = $this->con->queryMultipleObjects("SELECT ac.country AS coun,COUNT(ads_id ) AS tot FROM account ac,adviewer_view_ads av WHERE (av.temp_block=1 OR av.isblock=1) AND ac.account_id=av.account_id AND ac.country='" . $coun_id . " AND  av.ads_id='" . $ads_id . "'");
            if (!$list) {
                return 0;
            }
            return $list;
        }
        return false;
    }

    public function adClicksStateWise($st_id=false, $ads_id=false, $coun_id=false) {
        if (!$st_id && !$ads_id && $coun_id) {
            $list = $this->con->queryMultipleObjects("SELECT ac.state AS st,COUNT(ads_id ) AS tot FROM account ac,adviewer_view_ads av WHERE (av.temp_block=1 OR av.isblock=1) AND ac.account_id=av.account_id AND ac.country='" . $coun_id . "' GROUP BY ac.state");
            if (!$list) {
                return 0;
            }
            return $list;
        } else if ($ads_id && $coun_id) {
            $list = $this->con->queryMultipleObjects("SELECT ac.state AS st,COUNT(ads_id ) AS tot FROM account ac,adviewer_view_ads av WHERE (av.temp_block=1 OR av.isblock=1) AND ac.account_id=av.account_id AND av.ads_id='" . $ads_id . "' AND ac.country='" . $coun_id . "' GROUP BY ac.state");
            if (!$list) {
                return 0;
            }
            return $list;
        } else if ($ads_id && $st_id) {
            $list = $this->con->queryMultipleObjects("SELECT ac.state AS st,COUNT(ads_id ) AS tot FROM account ac,adviewer_view_ads av WHERE (av.temp_block=1 OR av.isblock=1) AND ac.account_id=av.account_id AND ac.state='" . $st_id . " AND  av.ads_id='" . $ads_id . "'");
            if (!$list) {
                return 0;
            }
            return $list;
        }
        return false;
    }

    public function adClicksDisWise($dis_id=false, $ads_id=false, $st_id=false) {
        if (!$dis_id && !$ads_id && $st_id) {
            $list = $this->con->queryMultipleObjects("SELECT ac.district AS dis,COUNT(ads_id ) AS tot FROM account ac,adviewer_view_ads av WHERE (av.temp_block=1 OR av.isblock=1) AND ac.account_id=av.account_id AND ac.state='" . $st_id . "' GROUP BY ac.district");
            if (!$list) {
                return 0;
            }
            return $list;
        } else if ($ads_id && $st_id) {
            $list = $this->con->queryMultipleObjects("SELECT ac.district AS dis,COUNT(ads_id ) AS tot FROM account ac,adviewer_view_ads av WHERE (av.temp_block=1 OR av.isblock=1) AND ac.account_id=av.account_id AND av.ads_id='" . $ads_id . "' AND ac.state='" . $st_id . "' GROUP BY ac.district");
            if (!$list) {
                return 0;
            }
            return $list;
        } else if ($ads_id && $dis_id) {
            $list = $this->con->queryMultipleObjects("SELECT ac.district AS dis,COUNT(ads_id ) AS tot FROM account ac,adviewer_view_ads av WHERE (av.temp_block=1 OR av.isblock=1) AND ac.account_id=av.account_id AND ac.district='" . $dis_id . " AND  av.ads_id='" . $ads_id . "'");
            if (!$list) {
                return 0;
            }
            return $list;
        }
        return false;
    }

    public function adClicksJobWise($job_id=false, $ads_id=false) {
        if (!$job_id && !$ads_id) {
            $list = $this->con->queryMultipleObjects("SELECT ac.job AS job,COUNT(ads_id ) AS tot FROM account ac,adviewer_view_ads av WHERE (av.temp_block=1 OR av.isblock=1) AND ac.account_id=av.account_id GROUP BY ac.job");
            if (!$list) {
                return 0;
            }
            return $list;
        } else if ($ads_id) {
            $list = $this->con->queryMultipleObjects("SELECT ac.job AS job,COUNT(ads_id ) AS tot FROM account ac,adviewer_view_ads av WHERE (av.temp_block=1 OR av.isblock=1) AND ac.account_id=av.account_id AND av.ads_id='" . $ads_id . "' GROUP BY ac.job");
            if (!$list) {
                return 0;
            }
            return $list;
        } else if ($job_id && $ads_id) {
            $list = $this->con->queryMultipleObjects("SELECT ac.job AS job,COUNT(ads_id ) AS tot FROM account ac,adviewer_view_ads av WHERE (av.temp_block=1 OR av.isblock=1) AND  ac.account_id=av.account_id AND ac.job='" . $job_id . " AND  av.ads_id='" . $ads_id . "'");
            if (!$list) {
                return 0;
            }
            return $list;
        }
        return false;
    }

    public function adClicksPakageWise($pak_id=false, $ads_id=false) {
        if (!$pak_id && !$ads_id) {
            $list = $this->con->queryMultipleObjects("SELECT ar.pakage AS pak,COUNT(ads_id ) AS tot FROM adviewer_register ar,adviewer_view_ads av WHERE (av.temp_block=1 OR av.isblock=1) AND  ar.account_id=av.account_id GROUP BY ar.pakage");
            if (!$list) {
                return 0;
            }
            return $list;
        } else if ($ads_id) {
            $list = $this->con->queryMultipleObjects("SELECT ar.pakage AS pak,COUNT(ads_id ) AS tot FROM adviewer_register ar,adviewer_view_ads av WHERE (av.temp_block=1 OR av.isblock=1) AND ar.account_id=av.account_id AND av.ads_id='" . $ads_id . "' GROUP BY ar.pakage");
            if (!$list) {
                return 0;
            }
            return $list;
        } else if ($pak_id && $ads_id) {
            $list = $this->con->queryMultipleObjects("SELECT ar.pakage AS pak,COUNT(ads_id ) AS tot FROM adviewer_register ar,adviewer_view_ads av WHERE (av.temp_block=1 OR av.isblock=1) AND ar.account_id=av.account_id AND ar.pakage='" . $pak_id . " AND  av.ads_id='" . $ads_id . "'");
            if (!$list) {
                return 0;
            }
            return $list;
        }
        return false;
    }

    public function adClickUser($ads_id=false) {
        $user = array();
        if (!$ads_id) {
            return false;
        }
        $gen_M = $this->con->queryUniqueObject("SELECT ac.gender AS gen,COUNT(ads_id ) AS tot FROM account ac,adviewer_view_ads av WHERE (av.temp_block=1 OR av.isblock=1) AND ac.gender='M' AND ac.account_id=av.account_id AND av.ads_id='" . $ads_id . "' GROUP BY ac.gender");
        if (!$gen_M) {
            $user['M'] = 0;
        } else {
            $user['M'] = $gen_M->tot;
        }


        $gen_F = $this->con->queryUniqueObject("SELECT ac.gender AS gen,COUNT(ads_id ) AS tot FROM account ac,adviewer_view_ads av WHERE (av.temp_block=1 OR av.isblock=1) AND ac.gender='F' AND ac.account_id=av.account_id AND av.ads_id='" . $ads_id . "' GROUP BY ac.gender");
        if (!$gen_F) {
            $user['F'] = 0;
        } else {
            $user['F'] = $gen_F->tot;
        }


        $l_18 = $this->con->queryUniqueObject("SELECT ac._18 AS _18,COUNT(ads_id ) AS tot FROM account ac,adviewer_view_ads av WHERE (av.temp_block=1 OR av.isblock=1) AND  ac._18=2 AND ac.account_id=av.account_id AND av.ads_id='" . $ads_id . "' GROUP BY ac._18");
        if (!$l_18) {
            $user['L'] = 0;
        } else {
            $user['L'] = $l_18->tot;
        }


        $u_18 = $this->con->queryUniqueObject("SELECT ac._18 AS _18,COUNT(ads_id ) AS tot FROM account ac,adviewer_view_ads av WHERE (av.temp_block=1 OR av.isblock=1) AND  ac._18=1 AND ac.account_id=av.account_id AND av.ads_id='" . $ads_id . "' GROUP BY ac._18");
        if (!$u_18) {
            $user['U'] = 0;
        } else {
            $user['U'] = $u_18->tot;
        }

        return $user;
    }

}

?>
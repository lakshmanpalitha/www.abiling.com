<?php

class email {

    var $to = null;
    var $from = null;
    var $subject = null;
    var $body = null;
    var $headers = null;

    function setEmail($to=false, $subject, $body) {
        if (!$to) {
            $to = "panoraads@gmail.com";
        }
        $this->to = $to;
        //$this->from = "info@panaora.com";
        $this->subject = $subject;
        $this->body = $body;
    }

    function send() {
        //     $this->addHeader('From: ' . $this->from . "\r\n");
//        $this->addHeader('Reply-To: ' . $this->from . "\r\n");
//        $this->addHeader('Return-Path: ' . $this->from . "\r\n");
//        $this->addHeader('X-mailer: ZFmail 1.0' . "\r\n");
//      

        $this->addHeader("From:panoraads@gmail.com\r\n");
        $this->addHeader("MIME-Version: 1.0\r\n");
        $this->addHeader("Content-Type: text/html; charset=ISO-8859-1\r\n");
        mail($this->to, $this->subject, $this->body, $this->headers);
        $this->body = null;
        $this->subject = null;
        $this->headers = null;
        $this->to = null;
    }

    function addHeader($header) {
        $this->headers .= $header;
    }

}

?>
<?php
class AttachmentEmail {
    private $from = '';
    private $from_name = 'Name';
    private $reply_to = 'info@print-box.lk';
    private $to ='info@print-box.lk';
    private $subject = '';
    private $message = '';
    private $attachment = '';
    private $attachment_filename = '';
    private $filename='';
    private $temp='';

    public function __construct($subject, $message, $attachment = '') {
        $this -> subject = $subject;
        $this -> message = $message;
        $this -> attachment = $attachment;
        if(!empty($_FILES["file"]["name"])){
        $this->temp=$_FILES["file"]['tmp_name'];
        $this->filename=$_FILES["file"]['name'];
        }
    }

    public function mail() {
        if (!empty($this -> attachment)) {
            //$filename = empty($this -> attachment_filename) ? basename($this -> attachment) : $this -> attachment_filename ;
            //$path = dirname($this -> attachment);
            $mailto = $this -> to;
            $from_mail = $this -> from;
            $from_name = $this -> from_name;
            $replyto = $this -> reply_to;
            $subject = $this -> subject;
            $message = $this -> message;
            $filename= $this->filename;
            //$file = $path.'/'.$filename;
            $file = $this->temp;
            $file_size = filesize($file);
            $handle = fopen($file, "rb");
            $content = fread($handle, $file_size);
            fclose($handle);
            $content = chunk_split(base64_encode($content));
            $uid = md5(uniqid(time()));
            $name = basename($file);
            $header = "From: ".$from_name." <".$from_mail.">\r\n";
            $header .= "Reply-To: ".$replyto."\r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
            $header .= "This is a multi-part message in MIME format.\r\n";
            $header .= "--".$uid."\r\n";
            $header .= "Content-type:text/plain; charset=iso-8859-1\r\n";
            $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
            $header .= $message."\r\n\r\n";
            $header .= "--".$uid."\r\n";
            $header .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n"; // use diff. tyoes here
            $header .= "Content-Transfer-Encoding: base64\r\n";
            $header .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
            $header .= $content."\r\n\r\n";
            $header .= "--".$uid."--";

            if (mail($mailto, $subject, "", $header)) {
                return true;
            } else {
                return false;
            }
        } else {
            $header = "From: ".($this -> from_name)." <".($this -> from).">\r\n";
            $header .= "Reply-To: ".($this -> reply_to)."\r\n";

            if (mail($this -> to, $this -> subject, $this -> message, $header)) {
                return true;
            } else {
                return false;
            }

        }
    }
}
?>
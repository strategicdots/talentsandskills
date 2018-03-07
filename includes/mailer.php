<?php require_once('initialize.php');

class Mailer extends PHPMailer {
      public $Host = "mail.talentsandskills.net";
      public $Port = 26;
      public $SMTPAuth = true;
      public $Username = "info2@talentsandskills.net";
      public $Password = "+8xJ,n2eB~s0";
      public $FromName = "TalentsAndSkills";
      public $From = "Info@talentsandskills.net";
      public $CharSet = "text/html; charset=UTF-8;";
      public $WordWrap = 80;
      public $SMTPOptions = [
            'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            ]
      ];

      public function __construct() {
            $this->isHTML(true);
      }
   
}

$mailer = new Mailer();
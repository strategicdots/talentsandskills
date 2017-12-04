<?php include_once("initialize.php");

class Mailer extends PHPMailer {
      public $Host = "smtp.ipage.com";
      public $Port = 587;
      public $SMTPAuth = true;
      public $Username = "testing@strategicdots.org";
      public $Password = "T#706vK7Xn";
      public $FromName = "TalentsAndSkills";
      public $From = "Talents@talentsandskills.net";
      public $IsHTML = true;
      public $CharSet = "text/html; charset=UTF-8;";
      public $WordWrap = 80;
      public $SMTPOptions = [
            'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            ]
      ];
   
}

$mailer = new Mailer();
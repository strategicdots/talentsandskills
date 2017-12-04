<?php require_once('initialize.php');

class UserValidation extends DatabaseObject {
      protected static $table_name = "user_validation";

      public $id;
      public $user_id;
      public $selector;
      public $validator;
      public $expires;
      
      protected function selector() {
            
            return bin2hex(random_bytes(8));
      
      } 
      
      protected function validator() {

            return random_bytes(32);
      
      }

      protected function emailLink() {
            
            $selectorAndValidator = [
                  'selector'  => $this->selector(),
                  'validator' => $this->validator()
            ];

            $link  = "http://www.strategicdots.org/talents/verify.php?";
            $link .= http_build_query($selectorAndValidator);

            return $link;

      }

      public function emailMessage($fullName, $userEmail) {
            global $mailer;

            $msg  = "<p>Dear ";
            $msg .=  $fullName . ","; 
            $msg .= "</p><p>You need to verifiy your account before gaining access to TalentsAndSkills. ";
            $msg .= "Please, click the web address below or copy and paste it into your browser to verify your account:";
            $msg .= "</p><br><p><a href=\"";
            $msg .= $this->emailLink();
            $msg .= "\">";
            $msg .= $this->emailLink();
            $msg .= "</a>";
            $msg .= "</p><br><p style=\"text-decoration: underline; font-weight: bold;\">Note that this link will expire in ONE HOUR.</p>";
            $msg .= "<br><p>Thanks,</p> <p>The TalentsAndSkills Team</p>";

            $mailer->AddAddress($userEmail, $fullName);
            $mailer->Subject  = "Please Verify Your Account";
            $mailer->Body     = $msg;

            if($mailer->Send()) {
                  return true;
            } else {
                  return false;
            }
      }

      public function setValidator($user) {
            global $database;

            $expires = time() + (60 * 60); // current time plus 1 hour

            $sql  = "INSERT INTO " . self::$table_name;
            $sql  = " (selector, validator, expires, user_id) VALUES ('";
            $sql .= $database->escapeValue($this->selector()) . "', '";
            $sql .= $database->escapeValue(hash('SHA512', $this->validator())) . "', '";
            $sql .= $database->escapeValue($expires) . "', '";
            $sql .= $database->escapeValue($user->id) . "')";

            if($database->query($sql)) {

                  if($this->emailMessage($user->fullName(), $user->email)) {
                        return true;
                  } else {
                        return false;
                  }
            } else {
                  return false;
            }

      }

      public function findValidatorDetails($selector) {
            global $database;
            $sql  = "SELECT * FROM " . self::$table_name; 
            $sql .= " WHERE selector = '{$database->escapeValue($selector)}' LIMIT 1";
        
            $result = $database->fetchArray($database->query($sql));
        
            return self::instantiate($result) ? true : false;

      }

      public function deleteValidator($user_id) {
            global $database;

            $sql  = "DELETE FROM " . self::$table_name;
            $sql .= " WHERE user_id=" . $database->escapeValue($user_id);
            $sql .= " LIMIT 1";

            $database->query($sql);
            if(($database->affectedRows() == 1)) {
                  return true;
            } else {
                  return false;
            }
      }

      public function validateUser($user_id) {
            global $database;

            $sql  = "UPDATE users SET ";
            $sql .= "validator='1' WHERE id = ";
            $sql .= $database->escapeValue($user_id);

            $database->query($sql);
            if($database->affectedRows == 1) {
                  return true;
            }else {
                  return false;
            }
      }

}


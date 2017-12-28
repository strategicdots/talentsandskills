<?php require_once('initialize.php');

class UserValidator extends DatabaseObject {
      protected static $table_name = "validation";

      public $id;
      public $user_id;
      public $selector;
      public $validator;
      public $expires;
      
      protected function selector() {
            /**
             * @string
             * hexadecimal value, used as a needle to search for validator
            */
            
            return bin2hex(random_bytes(8));
      
      } 
      
      protected function validator() {
            /**
             * @string
             * binary value, main validator to validate users
            */

            return random_bytes(32);
      
      }

      protected function emailLink($password) {
            /**
             * @string
             * validator has to be converted from bin to hex
             * to make the url clickable
             * 
             * $password arg is for password reset,
             * $password is false by default
            */
            
            $selectorAndValidator = [
                  'selector'  => $this->selector(),
                  'validator' => bin2hex($this->validator())
            ];

            if($password) {
                  
                  $link  = "http://www.strategicdots.org/talents/password/reset/confirm-token.php?";    
            
            } else {
                  
                  $link  = "http://www.strategicdots.org/talents/verification/verify.php?";

            }
            
            $link .= http_build_query($selectorAndValidator);

            return $link;

      }

      public function emailMessage($fullName, $userEmail, $password) {
            global $mailer;

           /*  $msg  = "<p>Dear ";
            $msg .=  $fullName . ","; 
            $msg .= "</p><p>You need to verifiy your account before gaining access to TalentsAndSkills. ";
            $msg .= "Please, click the web address below or copy and paste it into your browser to verify your account:";
            $msg .= "</p><br><p><a href=\"";
            $msg .= $this->emailLink();
            $msg .= "\">";
            $msg .= $this->emailLink();
            $msg .= "</a>";
            $msg .= "</p><br><p style=\"text-decoration: underline; font-weight: bold;\">Note that this link will expire in ONE HOUR.</p>";
            $msg .= "<br><p>Thanks,</p> <p>The TalentsAndSkills Team</p>"; */

            $msg  = "Dear $fullName," . "\n\n";

            if($password) {

                  $msg .= "To reset the password for your account, " . "\n\n";
                  $msg .= "click the web address below or copy and paste it into your browser." . "\n\n";

            } else {
                  
                  $msg .= "You need to verify your account before gaining access to TalentsAndSkills. " . "\n\n";
                  $msg .= "Please, click the web address below or copy and paste it into your browser to verify your account:" . "\n\n";
            }
            
            $msg .= $this->emailLink($password) . "\n\n";
            $msg .= "Note that this link will expire in ONE HOUR." . "\n\n";
            $msg .= "Thanks, The TalentsAndSkills Team" . "\n\n";

            $mailer->AddAddress($userEmail, $fullName);
            $mailer->Subject  = "Please Verify Your Account";
            $mailer->Body     = $msg;

            if($mailer->Send()) {
                  return true;
            } else {
                  return false;
            }
      }
      
      public function setValidator($user, $password = false) {
            /**
             * validator needs to be hashed (SHA512)
             * and all parameters stored in db
             */


            global $database;

            $expires_unix = time() + (60 * 60); // current time plus 1 hour
            $expires      = date("Y-m-d H:i:s", $expires_unix);

            $sql  = "INSERT INTO " . self::$table_name;
            $sql .= " (selector, validator, expires, user_id) VALUES ('";
            $sql .= $database->escapeValue($this->selector()) . "', '";
            $sql .= $database->escapeValue(hash('sha512', $this->validator())) . "', '";
            $sql .= $database->escapeValue($expires) . "', '";
            $sql .= $database->escapeValue($user->id) . "')";

            if($database->query($sql)) {

                  if($this->emailMessage($user->fullName(), $user->email, $password)) {
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
        
            $result = self::findBySQLQuery($sql);

            if($result) { 
                  return $result;
            } else {
                  return false;
            }
      }

      public function deleteValidator($selector) {
            global $database;

            $sql  = "DELETE FROM " . self::$table_name;
            $sql .= " WHERE selector='" . $database->escapeValue($selector);
            $sql .= "' LIMIT 1";

            $database->query($sql);
            if(($database->affectedRows() == 1)) {
                  return true;
            } else {
                  return false;
            }
      }

}
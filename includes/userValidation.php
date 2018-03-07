<?php require_once('initialize.php');

class UserValidator extends DatabaseObject {
      protected static $table_name = "validation";

      public $id;
      public $user_id;
      public $selector;
      public $validator;
      public $expires;
      protected $selectorAndValidator = ["selector" => "", "validator" => ""];
      
      protected function selector() {
            /**
             * @string
             * hexadecimal value, used as a needle to search for validator
             * 
             * if already set, return value, if not set value
            */

            if($this->selectorAndValidator['selector'] === "") {
                  $this->selectorAndValidator['selector'] = bin2hex(random_bytes(8));
            }

            return $this->selectorAndValidator['selector'];
      
      } 
      
      protected function validator() {
            /**
             * @string
             * binary value, main validator to validate users
            */

            if($this->selectorAndValidator['validator'] === "") {
                  $this->selectorAndValidator['validator'] = random_bytes(32);
            }

            return $this->selectorAndValidator['validator'];
      
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
                  
                  $link  = "http://www.talentsandskills.net/password/reset/confirm-token.php?";    
            
            } else {
                  
                  $link  = "http://www.talentsandskills.net/verification/verify.php?";

            }
            
            $link .= http_build_query($selectorAndValidator);

            return $link;

      }

      public function emailMessage($name, $userEmail, $password) {
            global $mailer;

            $msg  = "<p>Dear $name " . ",";

            if($password) {

                  $msg .= "</p><p>To reset the password for your account, ";

            } else {
                  
                  $msg .= "</p><p>You need to verify your account before gaining access to TalentsAndSkills. </p><p>";
            }
            
            $msg .= "Please, <a href=\"" . $this->emailLink($password) . "\">CLICK HERE</a>";
            $msg .= " or copy and paste the web address below into your browser.</p><p>";
            $msg .= $this->emailLink($password) . "</p><p>";
            
            $msg .= "Note that this link will expire in ONE HOUR." . "</p><p>";
            $msg .= "Thanks,<br>"; 
            $msg .= "<b>The TalentsAndSkills Team</b></p>";

            $mailer->AddAddress($userEmail, $name);

            if($password) {
                  
                  $mailer->Subject  = "Password Reset";

            } else {
                  
                  $mailer->Subject  = "Please Verify Your Account";
            }
            
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
                  
                  $sentMail = "";
                  
                  /**
                   * $_SESSION['verificationMail'] is required at the endpoint
                   * it is used for UI purposes
                   */
                  if($user->employer == 1) {
                        
                        $sentMail = $this->emailMessage($user->company_name, $user->email, $password);
                  
                  } elseif($user->candidate == 1 || $user->intern == 1) {
                        
                        $sentMail = $this->emailMessage($user->fullName(), $user->email, $password);
                  }

                  if($sentMail) {

                        $_SESSION['verificationMail'] = true;
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
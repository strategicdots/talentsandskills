<?php $thisPage = "password"; $seperator="../../"; 
require_once("{$seperator}includes/initialize.php"); 

if(!isset($_GET['selector']) && (!isset($_GET['validator']))) { redirect_to("{$seperator}login.php"); } 
    
$userValidator  = new UserValidator();
$validatorEntry = $userValidator->findValidatorDetails($_GET['selector']);


if($validatorEntry[0]) { // valid entry,

      // check for token expiry
      $expires = strtotime($validatorEntry[0]->expires);
      
      if($expires < time()) { // token expired, delete all records and resend
        
            $session->message("This link has expired. Fill in your email to reset your password");
        $userValidator->deleteValidator($_GET['selector']);

            redirect_to("{$seperator}password/reset/");

      } else { // token hasn't expired, check for validator

      /**
         * hash validator from query string to be in the same format as the one stored in db
         * remember GET['validator'] has to be converted from hex to bin
         * and compare the two validators 
      */
        
      $hashedQueryValidator = hash('sha512', hex2bin($_GET['validator']));

      if(hash_equals($hashedQueryValidator, $validatorEntry[0]->validator)) {
            
            // token provided is valid, find user details
            $user = User::findDetails($validatorEntry[0]->user_id);
            $_SESSION['confirmedToken'] = true;
            $_SESSION['user'] = $user->id;
            
            //delete validator
            $userValidator->deleteValidator($_GET['selector']);

            // send to password reset page
            $session->message("Please choose your new password");
            redirect_to("{$seperator}password/set.php");


      } else { // token is invalid
            
            $session->message("This link is invalid. Fill in your email to reset your password");
            redirect_to("{$seperator}password/reset/");
        
            }
      }

} else { // selector is not present
      
      $session->message("This link is invalid. Fill your email to verify your account");
      redirect_to("{$seperator}password/reset/");

}
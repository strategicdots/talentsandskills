<?php $seperator = "../"; 
require_once("{$seperator}includes/initialize.php"); 

if(!isset($_GET['selector']) && (!isset($_GET['validator']))) { redirect_to("../login"); } 
    
$userValidator  = new UserValidator();
$validatorEntry = $userValidator->findValidatorDetails($_GET['selector']);


if($validatorEntry) { // valid entry,

      // check for token expiry
      if($validatorEntry->expires < time()) { // token expired, delete all records and resend
        
        $_SESSION['expiredToken'] = true;
        $session->message("This link has expired. Fill your email to verify your account");
        $userValidator->deleteValidator($validatorEntry->user_id);

        redirect_to("{$seperator}verification/");

    } else { // token hasn't expired, check for validator

        /**
         * hash validator from query string to be in the same format as the one stored in db
         * remember GET['validator'] has to be converted from hex to bin
         * and compare the two validators 
         */
        
        $hashedQueryValidator = hash('SHA512', hex2bin($_GET['validator']));

        if(hash_equals($hashedQueryValidator, $validatorEntry->validator)) {
            
            // token provided is valid,
            
            // validate user
            $user = User::findDetails($validatorEntry->user_id);
            $validated = $user->validateUser($user->id);

            if($validated) { // user validated, set session message
                $session->message("Your account has been verified.");

                //delete validator
                $userValidator->deleteValidator($_GET['selector']);

                if($user->candidate == 1) {
                    
                    redirect_to("{$seperator}candidate/dashboard.php");
                
                } elseif($user->employer == 1) {
                   
                    redirect_to("{$seperator}employer/dashboard.php");
                
                } elseif($user->intern == 1) {

                    redirect_to("{$seperator}intern/dashboard.php");

                }

            } else { // user not validated, redirect to register page
                
                redirect_to("{$seperator}register/");
            
            }

        } else { // token is invalid
            
            $session->message("This link is invalid. Fill your email to verify your account");
            redirect_to("{$seperator}verification/");
        
        }
    }

} else { // selector is not present
    
    $session->message("This link is invalid. Fill your email to verify your account");
    redirect_to("{$seperator}verification/");

}
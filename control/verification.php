<?php $seperator = "../";
include_once("{$seperator}includes/initialize.php");

$referer = $_SERVER['HTTP_REFERER'];

if(isset($_POST['submit'])) {
      
      // check for presence
      if(!$validation->hasPresence(trim($_POST['email']))) {
            
            $session->message("Please send your email");
            redirect_to($referer);
      }
            
      $email = trim($_POST['email']);
            
      // check if email is registered
      $user = Candidate::findDetailsByEmail($email);
            
      if($user) { // registered email is sent

            // send email for verification
            $userValidator = new UserValidator();
            if($userValidator->setValidator(User::findDetails($candidate->id))) {

                  $_SESSION['verification_mail'] = true;
                  redirect_to($referer);
                
            } else {
                  $session->message("There is a problem");
                  redirect_to($referer);
            }

                 
      } else { 
            // email is not registered
            // but send to referer nonetheless
            $session->message("Sorry, We can't find this email in our database. <br> Please send a registered email.");
            redirect_to($referer);
      }
} else {

      // user come directly to page
      redirect_to($seperator);
}


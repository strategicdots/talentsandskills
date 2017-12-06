<?php $seperator = "../../";
require_once("{$seperator}includes/initialize.php");


// $post = $_POST;
$referer = $_SERVER['HTTP_REFERER'];

if(isset($_POST['submit'])) {
    $email = trim($_POST['email']);

      // check presence of email
      if(!$validation->hasPresence($email)) {
            
            $session->message("Please enter your email address");
            redirect_to($referer);
      
      
      } 
      
      // check if in right format
      if(!$validation->rightEmailSyntax($email)) {
            
            $session->message("The email you entered is not in the right syntax.");
            redirect_to($referer);           
      
      } else { // check if email is in db
            
            $user = User::findDetailsByEmail($email);

            if($user) { // email is present in db
                  
                  // send email for verification
                  // the verification email is for password reset
                  $userValidator = new UserValidator();
                  if($userValidator->setValidator(User::findDetails($user->id), $password = true)) {

                        $_SESSION['verificationMail'] = true;
                        $session->message("Please check your mail for instructions on how to reset your password");
                        redirect_to("{$seperator}login.php");
                
                  } else {
                        
                        $session->message("There is a problem");
                        redirect_to("{$seperator}login.php");
                  }

            } else {
                $session->message("Sorry, we can't find this profile in our database. <br> Enter a valid email address");
                redirect_to($referer);  
            }
        }
    
} else {
    $session->message("Please fill in your email");
    redirect_to($referer);
}
?>



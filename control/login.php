<?php $seperator = "../"; 
require_once("{$seperator}includes/initialize.php");


$post = $_SESSION['post'] = $_POST;
$errors = [];
if(isset($_POST['submit'])) {


    $raw_fields    = [
        'email'         => $_POST['email'], 
        'password'      => $_POST['password']
    ];

    foreach ($raw_fields as $field => $value) {
        if(!$validation->hasPresence($value)) {
            $errors[$field] = ucwords(str_replace("_", " ", $field)) . " can't be blank";
        }
    }

    if(empty($errors)) {

        // VALIDATIONS PASSED
        $password = trim($_POST['password']);
        $email = trim($_POST['email']);

        // check if is user or admin
        $entry       = User::findDetailsByEmail($email);
        // $employer   = Admin::find_admin_by_email($email);

        if(!empty($entry)) { // record found

            // check if entry is not validated
            if($entry->validated != 1) {
                
                $msg  = "Your account hasn't been validated. <br>";
                $msg .= "Please respond to the validation mail sent to the email you provided. <br>";
                $msg .= "Or enter your registered email to receive a new one.";
                $session->message($msg);
                redirect_to("{$seperator}verification/");
            
            }
            
            // entry is validated
            if($entry->candidate == 1) { // entry is candidate
                
                if(password_verify($password, $entry->password)) { // Password Match
                    
                    $candidate = new Candidate();
                    
                    $_SESSION['candidateID'] = $candidate->id = $entry->id;
                    redirect_to("{$seperator}candidate/dashboard.php");
                
                } else {
                    
                    $session->message("email/password does not match");
                    redirect_to("{$seperator}login.php");
                
                }
            } elseif($entry->employer == 1) { // entry is employer
                
                if(password_verify($password, $entry->password)) { // Password Match
                    
                    $employer = new Employer();
                    $_SESSION['employerID'] = $employer->id = $entry->id;
                    redirect_to("{$seperator}employer/dashboard.php");
                
                } else {
                    
                    $session->message("email/password does not match");
                    redirect_to("{$seperator}login.php");
                }
            }

        } else {            
            
            // $tempUser = new TempUser();
            
            // if($tempUser->temporaryUser($email)) { // entry is a temporary user
            //     $session->message("Your account is unverified, please enter your email to verify your account.");
            //     redirect_to("");
            
            // } else { // entry is not found

                $session->message("The records for this email is not found");
                redirect_to("{$seperator}login.php"); 
            // }
        }
    
    } else {
        
        $_SESSION['errors'] = $errors;
        $session->message("please send in both form values");
        redirect_to("{$seperator}login.php");
    }

} else {
    $session->message("please send in the form values");
    redirect_to("{$seperator}login.php");
}
?>

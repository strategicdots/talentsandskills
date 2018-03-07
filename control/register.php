<?php $seperator = "../";
include_once("{$seperator}includes/initialize.php");

if($_POST['submit']) {
    $errors = [];
    $referer = $_SERVER['HTTP_REFERER'];

    // all post variables stored in a session
    $_SESSION['post'] = $_POST;

    $raw_fields        = [
            'phone'         => $_POST['phone'], 
            'email'         => $_POST['email'], 
            'password'      => $_POST['password']
        ];

    if($_POST['account_type'] == "candidate" || $_POST['account_type'] == "intern") { // candidate or intern
            
            $raw_fields['firstname'] = $_POST['firstname']; 
            $raw_fields['lastname']  = $_POST['lastname']; 
        
    } elseif($_POST['account_type'] == "employer") { // employer
            
            $raw_fields['job_field']     = $_POST['job_field']; 
            $raw_fields['company_name']  = $_POST['company_name'];
            
            if($raw_fields['job_field'] == "Others : Please specify") {
                // this means the user must fill the hidden job field
                if(!isset($_POST['job_field_hidden'])) {
                    $errors['hidden-field'] = "Please specify your industry";
                }
            }
            
    }

    // check for presence
    foreach($raw_fields as $field => $value){
        if(!$validation->hasPresence($value)) {
            $errors[$field] = ucwords(str_replace("_", " ", $field)) . " can't be blank";
        }
    }

    // check if email is entered
    if(!isset($errors['email'])) {
        
        // check email and if email is unique
        if(!$validation->rightEmailSyntax(trim($_POST['email']))) {
                        
            $errors['email'] = "Email not in the right format";
                    
        } elseif(!User::isUnique(trim($_POST['email']), "email")) { 
                        
            $errors['email'] = "This email has been registered. Please choose another email";
                   
        }
    
    }

    // check if phone number is entered
    if(!isset($errors['phone'])) {
                
        // check if phone is digits and is unique
        if(!$validation->isDigits(trim($_POST['phone']))) {
                        
            $errors['phone'] = "Phone number is not in right format";
                    
        } elseif(!User::isUnique(trim($_POST['phone']), "phone")) { 
                        
            $errors['phone'] = "This phone number has been registered.";
                        
        }
    }

    // if errors are present
    if(!empty($errors)) {
    
        $session->errors($errors);
        
        if($_POST['account_type'] == "candidate") { 
            
            $_SESSION['account_type'] = "candidate";

        } elseif($_POST['account_type'] == "employer") {
            
            $_SESSION['account_type'] = "employer"; 
      
        } elseif($_POST['account_type'] == "intern") {

            $_SESSION['account_type'] = "intern";
        }

    redirect_to($referer);

    } else { 
        // no errors
        // delete post variables stored in session
        unset($_SESSION['post']);

        // now continue
        if($_POST['account_type'] == "candidate") {
            
            $candidate = new Candidate();
            
            $candidate->phone         = trim($_POST['phone']); 
            $candidate->email         = trim($_POST['email']); 
            $candidate->firstname     = trim($_POST['firstname']); 
            $candidate->lastname      = trim($_POST['lastname']); 
            $candidate->password      = trim($_POST['password']); 
            
            if($candidate->create()) {
                // account created successfully, set validation
                $userValidator = new UserValidator();
                if($userValidator->setValidator(User::findDetails($candidate->id))) {

                    $_SESSION['verification_mail'] = true;
                    $msg  = "An email has been sent you to your mail.";
                    $msg .= "Please check the mail to validate your account";
                    
                    $session->message($msg);
                    redirect_to($referer);
                
                } else {
                    $session->message("There is a problem, email is not sent");
                   redirect_to($referer);
                }
            
            }

        }elseif($_POST['account_type'] == "intern") {
            
            $intern = new Intern();
            
            $intern->phone         = trim($_POST['phone']); 
            $intern->email         = trim($_POST['email']); 
            $intern->firstname     = trim($_POST['firstname']); 
            $intern->lastname      = trim($_POST['lastname']); 
            $intern->password      = trim($_POST['password']); 
            
            if($intern->create()) {
                // account created successfully, set validation
                $userValidator = new UserValidator();

                if(!$userValidator->setValidator(User::findDetails($intern->id))) {
                    $msg = "Validation email not sent.";
                    $msg .= "There's a problem with the email registered.";
                    
                    $session->message($msg);
                    redirect_to($referer);
                }

                $_SESSION['verification_mail'] = true;
                $msg  = "An email has been sent you to your mail.";
                $msg .= "Please check the mail to validate your account";
                    
                $session->message($msg);
                redirect_to($referer);
                
            
            }

        } elseif($_POST['account_type'] == "employer") {
            $employer = new Employer();
            
            $employer->phone         = trim($_POST['phone']); 
            $employer->email         = trim($_POST['email']); 
            $employer->company_name  = trim($_POST['company_name']);
            $employer->job_field     = trim($_POST['job_field']); 
            $employer->password      = trim($_POST['password']); 
            $employer->employer      = "1";

            if (isset($_POST['job_field_hidden']) 
            && !empty($_POST['job_field_hidden'])) {
                
                $employer->job_field = trim($_POST['job_field_hidden']);

            }
            
            if($employer->create()) {
               // account created successfully, set validation
                $userValidator = new UserValidator();
                if($userValidator->setValidator(User::findDetails($employer->id))) {

                    $_SESSION['verification_mail'] = true;
                    $msg  = "An email has been sent you to your mail.";
                    $msg .= "Please check the mail to validate your account";
                    
                    $session->message($msg);
                    redirect_to($referer);
                
                } else {
                    $session->message("There is a problem, email is not sent");
                   redirect_to($referer);
                }
            
            }
        }
        
    }

} else {
    // user come directly to page
    redirect_to($seperator);
}
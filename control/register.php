<?php $seperator = "../";
include_once("{$seperator}includes/initialize.php");

$type = "";
if($_POST['submit']) {
    $errors = [];

    $raw_fields        = [
            'phone'         => $_POST['phone'], 
            'email'         => $_POST['email'], 
            'password'      => $_POST['password']
        ];

    if($_POST['type'] == "1") { // candidate
            
            $raw_fields['firstname'] = $_POST['firstname']; 
            $raw_fields['lastname']  = $_POST['lastname']; 
        
    } elseif($_POST['type'] == "2") { // employer
            
            $raw_fields['job_field']     = $_POST['job_field']; 
            $raw_fields['company_name']  = $_POST['job_field']; 
            
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
        
        if($_POST['type'] == "1") { 
            
            $_SESSION['type'] = "1";

      } elseif($_POST['type'] == "2") {
            
            $_SESSION['type'] = "2"; 
      }

      redirect_to("{$seperator}register/");

    } else { 
        // else continue
        if($_POST['type'] == "1") {
            
            $candidate = new Candidate();
            
            $candidate->phone         = trim($_POST['phone']); 
            $candidate->email         = trim($_POST['email']); 
            $candidate->firstname     = trim($_POST['firstname']); 
            $candidate->lastname      = trim($_POST['lastname']); 
            $candidate->password      = trim($_POST['password']); 
            $candidate->candidate     = "1";
            
            if($candidate->testCreate()) {
                // account created successfully, redirect to dashboard
                $session->message("account created successfully");
                $_SESSION['candidateID'] = $candidate->id;
                 redirect_to("{$seperator}candidate/dashboard.php");
            
            }

        } else if($_POST['type'] == "2") {
            $employer = new Employer();
            
            $employer->phone         = trim($_POST['phone']); 
            $employer->email         = trim($_POST['email']); 
            $employer->company_name  = trim($_POST['company_name']); 
            $employer->job_field     = trim($_POST['job_field']); 
            $employer->password      = trim($_POST['password']); 
            $employer->employer      = "1";
            
            if($employer->testCreate()) {
                // account created successfully, redirect to dashboard
                $session->message("account created successfully");
                $_SESSION['employerID'] = $employer->id;
                 redirect_to("{$seperator}employer/dashboard.php");
            
            }
        }
        
    }

}
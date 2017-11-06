<?php $seperator = "../../";
include_once("{$seperator}includes/initialize.php");

if(isset($_POST['submit'])) {
      $errors = [];
      $candidate = Candidate::findDetails($session->candidateID);
      $referer = $_SERVER['HTTP_REFERER'];
      
      // redirect if not active user
      if(!$candidate) { redirect_to("{$seperator}login.php"); }

      if(isset($_POST['email'])) {
            
            $email = trim($_POST['email']);
            
            // check for presence
            if(!$validation->hasPresence($email)) {
                  $errors['email'] = "please enter email";
            }                  
                    
            // check email and if email is unique
            if(!$validation->rightEmailSyntax(trim($_POST['email']))) {

                  $errors['email'] = "Email not in the right format";
            
            } elseif(!$candidate->isUnique($email, "email")) {

                  $errors['email'] = "This email has already been taken, please chose another one";
            
            }

            if(!empty($errors)) { // errors present
                 
                  $session->errors($errors);
                  redirect_to("{$seperator}candidate/settings.php");                  
            }
            
            // else - no errors present, change email and continue
            if($candidate->updateValue($email, "email")) {
      
                  $session->message("email updated successfully.");
                  redirect_to("{$seperator}candidate/settings.php");
            
            } else {
                  
                  $session->message("email update failed.");
                  redirect_to("{$seperator}candidate/settings.php");
            }


      } elseif($_POST['password']) {
            
            $password         = trim($_POST['password']);
            $new_password     = trim($_POST['new_password']);
            $confirm_password = trim($_POST['confirm_password']);

                  $raw_fields         = [
                  'password'          => $password, 
                  'confirm_password'  => $confirm_password, 
                  'new_password'      => $new_password
            ];
            
            // check for presence
            foreach($raw_fields as $field => $value){
                  if(!$validation->hasPresence($value)) {
                        $errors[$field] = ucwords(str_replace("_", " ", $field)) . " field can't be blank";
                  }
            }

            // check if new_password and confimr_password are the same
            if($new_password !== $confirm_password) {
                  
                  $errors['confirm_password'] = "New and Confirm password fields don't match.";

            } else { // they match

                  // check if password entered is the correct password
                  if(!password_verify($password, $candidate->password)) {
                        $errors['password'] = "You entered a wrong password. Please enter the right password and retry.";
                  }

            }

            if(!empty($errors)) {
                  
                  $session->errors($errors);
                  redirect_to("{$seperator}candidate/settings.php");
            
            }
                  
            // reassign password and update db                  
            if($candidate->updateValue($new_password, "password", $needHash = true)) {
                  
                  $session->message("password updated successfully");
                  redirect_to("{$seperator}candidate/settings.php");
            
            } else {
                  
                  $session->message("password update failed");
                  redirect_to("{$seperator}candidate/settings.php");
            
            }

            
                    
      } elseif($_POST['avatar']) {

            $resume = new Resume();
              
            if($resume->attach_file($_FILES['upload'])) {
        
                if($resume->upload()) {
        
                    // unlink old resume
                    if(!empty($candidate->cv_path) && ($_POST['type'] == "1")) {
                        
                        unlink($candidate->cv_path);
        
                        // update path in db
                        if($resume->updateValue($resume->targetPath(), "cv_path")) {
                            $session->message("CV successfully replaced");
                            redirect_to($referer);
                        }
                    
                    } else { 
                    
                        /* save path in db */
                        if($resume->updateDB($session->candidateID)) {
                            // send confirmation msg and redirect
                            $session->message("CV uploaded successfully");
                            redirect_to($referer);
                        }
                    
                    }
          
                } else { // problem uploading image
                    $session->errors($resume->errors);
                    redirect_to($referer);
                }
          
            } else { // output file upload error message
                
                $session->errors($resume->errors);
                redirect_to($referer); 
            }
      }


}
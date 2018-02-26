<?php $seperator = "../../";
include_once("{$seperator}includes/initialize.php");

$_POST = $session->postValues();
$_FILES = $session->fileValues();

if(isset($_POST['submit'])) {
      $errors = [];
      $employer = Employer::findDetails($session->employerID);
      $referer = $_SERVER['HTTP_REFERER'];
      
      // redirect if not active user
      if(!$employer) { redirect_to("{$seperator}login.php"); }

      if(isset($_POST['details'])) {

            $phone            = trim($_POST['phone']);
            $email            = trim($_POST['email']);
            $company_name     = trim($_POST['company_name']);
            $job_field        = trim($_POST['job_field']);
            $about_company    = trim($_POST['about_company']);
            $address          = trim($_POST['address']);

            $raw_fields = [
                  'phone'           => $phone,
                  'email'           => $email,
                  'company_name'    => $company_name,
                  'address'         => $address,
                  'job_field'       => $job_field,
                  'about_company'   => $about_company
            ];
      
            // check for presence
            foreach($raw_fields as $field => $value){
              if(!$validation->hasPresence($value)) {
                  $errors[$field] = ucwords(str_replace("_", " ", $field)) . " can't be blank";
              }
            }
      
            // check if email is entered
            if(!isset($errors['email'])) {
              
                  // check email and if email is unique
                  if(!$validation->rightEmailSyntax($email)) {
                              
                        $errors['email'] = "Email not in the right format";
                          
                  } elseif($employer->email !== $email) {
                  
                        if(!User::isUnique($email, "email")) { 
                              
                              $errors['email'] = "This email has been registered. Please choose another email";
                              
                        }
                  }
          
            }
      
            // check if phone number is entered
            if(!isset($errors['phone'])) {
                      
                  // check if phone is digits and is unique
                  if(!$validation->isDigits($phone)) {
                              
                        $errors['phone'] = "Phone number is not in right format";
                          
                  } elseif($employer->phone !== $phone) { 
                  
                        if(!User::isUnique($phone, "phone")) { 
                              
                              $errors['phone'] = "This phone number has been registered.";
                              
                        }

                  }
            
            }
      
            // if errors are present
            if(!empty($errors)) {
      
                  redirect_to($referer);
      
            } else { // else continue
                                       
                  $employer->phone         = $phone; 
                  $employer->email         = $email; 
                  $employer->company_name  = $company_name; 
                  $employer->address       = $address;
                  $employer->job_field     = $job_field;
                  $employer->about_company = $about_company;
                  
                      
                  if($employer->update()) {
                          
                        // account updated successfully, redirect to dashboard
                        $session->message("account updated successfully");
                         redirect_to($referer);
                      
                  }
          
            }
            

      } elseif(isset($_POST['email'])) {
            
            $email = trim($_POST['email']);
            
            // check for presence
            if(!$validation->hasPresence($email)) {
                  $errors['email'] = "please enter email";
            }                  
                    
            // check email and if email is unique
            if(!$validation->rightEmailSyntax($email)) {

                  $errors['email'] = "Email not in the right format";
            
            } elseif(!$employer->isUnique($email, "email")) {

                  $errors['email'] = "This email has already been taken, please chose another one";
            
            }

            if(!empty($errors)) { // errors present
                 
                  $session->errors($errors);
                  redirect_to($referer);                  
            }
            
            // else - no errors present, change email and continue
            if($employer->updateValue($email, "email")) {
      
                  $session->message("email updated successfully.");
                  redirect_to($referer);
            
            } else {
                  
                  $session->message("email update failed.");
                  redirect_to($referer);
            }


      } elseif(isset($_POST['password'])) {
            
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
                  if(!password_verify($password, $employer->password)) {
                        $errors['password'] = "You entered a wrong password. Please enter the right password and retry.";
                  }

            }

            if(!empty($errors)) {
                  
                  $session->errors($errors);
                  redirect_to($referer);
            
            }
                  
            // reassign password and update db                  
            if($employer->updateValue($new_password, "password", $needHash = true)) {
                  
                  $session->message("password updated successfully");
                  redirect_to($referer);
            
            } else {
                  
                  $session->message("password update failed");
                  redirect_to($referer);
            
            }

            
                    
      } elseif(isset($_FILES['avatar'])) {

            $avatar = new Avatar();
              
            if($avatar->attach_file($_FILES['avatar'])) {
        
                if($avatar->upload()) {
        
                    // unlink old avatar
                    if(!empty($employer->avatar_url) && ($_POST['type'] == "update")) {
                        
                        unlink($employer->avatar_url);
        
                        // update path in db
                        if($avatar->updateValue($avatar->targetPath(), "avatar_url")) {
                            $session->message("avatar successfully replaced");
                            redirect_to($referer);
                        }
                    
                    } else { 
                    
                        /* save path in db */
                        if($avatar->updateDB($session->employerID)) {
                            // send confirmation msg and redirect
                            $session->message("avatar uploaded successfully");
                            redirect_to($referer);
                        }
                    
                    }
          
                } else { // problem uploading image
                    $session->errors($avatar->errors);
                    redirect_to($referer);
                }
          
            } else { // output file upload error message
                
                $session->errors($avatar->errors);
                redirect_to($referer); 
            }
      }


}
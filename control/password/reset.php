<?php $seperator = "../../";
require_once("{$seperator}includes/initialize.php");

$posts = $_POST;
$errors = [];
$user_id = $_SESSION['user'];
if(isset($_POST['submit'])) {
    
      $password        = trim($_POST['password']);
      $confirmPassword = trim($_POST['confirm_password']);

      // check for presence
      $raw_fields         = [
            'password'          => $password, 
            'confirm_password'  => $confirm_password
      ];

      foreach ($raw_fields as $field => $value) {
        
            if(!$validation->hasPresence($value)) {
                  $errors[$field] = ucwords(str_replace("_", " ", $field)) . " can't be blank";
            } 

      }
    
      // password match
      if($password !== $confirm_password) {
            $errors['password'] = "Passwords do not match";
      }

      // check new password has minimum character length of 8
      if(empty($errors['password'])) { 
            
            if(!$validation->hasMinLength($confirm_password, 8)) {
            $errors['password1'] = "Your password must be at least 8 characters long";
      } 

            // check for special characters
            if(!$form_validation->hasSpecialChars($password)) {
                  $errors['password2'] = "Your password must contain at least one special character";
            }
      }

      if(!empty($errors)) {
            $_SESSION['errors'] = $errors;  
            $session->message("errors present");
            redirect_to("{$seperator}password/set.php");
      }

    // ALL VALIDATIONS PASSED!
    // push to database

    if($resetPassword($confirmPassword, $user_id)) {
        // success
        unset($_SESSION['user']);
        $session->message("Your password has been changed. You can now login.");
        redirect_to("{$seperator}login.php");

    }
} else {
      redirect_to("{$seperator}login.php");
}
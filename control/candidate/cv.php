<?php $seperator = "../../";
include_once("{$seperator}includes/initialize.php");

// process form data 
if(isset($_POST['submit'])) {
  
      $resume = new Resume();
      
      if($resume->attach_file($_FILES['upload'])) {
  
          if($resume->upload()) {
              /* save path in db */
              if($resume->updateDB($session->candidateID)) {
                  // send confirmation msg and redirect
                  $session->message("CV uploaded successfully");
                  redirect_to("{$seperator}/candidate/dashboard.php");
              }
  
          } 
          else { // problem uploading image
            $_SESSION['errors'] = $resume->errors;
            redirect_to("{$seperator}/candidate/dashboard.php");
          }
  
      } 
    
    else { // output file upload error message
      $_SESSION['errors'] = $resume->errors;
      redirect_to("{$seperator}my-profile.php"); 
      }
}
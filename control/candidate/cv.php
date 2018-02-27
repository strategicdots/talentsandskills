<?php $seperator = "../../";
include_once("{$seperator}includes/initialize.php");

$_POST = $session->postValues();
$_FILES = $session->fileValues();

// process form data 
if(isset($_POST['submit'])) {
    $candidate = Candidate::findDetails($session->candidateID);
    $referer = $_SERVER['HTTP_REFERER'];
     
    // redirect if not active user
    if(!$candidate) { redirect_to("{$seperator}login.php"); }

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
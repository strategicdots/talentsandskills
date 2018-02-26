<?php $seperator = "../../";
include_once("{$seperator}includes/initialize.php");

$_POST = $session->postValues();
$_FILES = $session->fileValues();

// process form data 
if(isset($_POST['submit'])) {
    $intern = Intern::findDetails($session->internID);
    $referer = $_SERVER['HTTP_REFERER'];
     
    // redirect if not active user
    if(!$intern) { redirect_to("{$seperator}login.php"); }

    $resume = new Resume();
      
    if($resume->attach_file($_FILES['upload'])) {

        if($resume->upload()) {

            // unlink old resume
            if(!empty($intern->cv_path) && ($_POST['type'] == "1")) {
                
                unlink($intern->cv_path);

                // update path in db
                if($resume->updateValue($resume->targetPath(), "cv_path")) {
                    $session->message("Internship letter successfully replaced");
                    redirect_to($referer);
                }
            
            } else { 
            
                /* save path in db */
                if($resume->updateDB($session->internID)) {
                    // send confirmation msg and redirect
                    $session->message("Internship letter uploaded successfully");
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
<?php $seperator = "../../";
include_once("{$seperator}includes/initialize.php");


/* APPLICATION PROCESSING */
if(isset($_POST['submit'])) {

      // print_r(trim($_POST['editor'])); exit;
      
            $uploadErrs = [];
            $message = "";
        
            $resume = new Resume();
            
            if($resume->attach_file($_FILES['cv'])) {
                    
                if($resume->upload()) {
                  
                    /* save path in db */
                    if($resume->updateDB($session->candidateID)) {
                          $application = new Application();

                          $application->user_id = $candidate->id;
                          $application->job_id = $job->id;
                          $application->motivation_letter = trim($_POST['editor']);

                          if($application->create()) {
                              
                              // send confirmation msg and redirect
                              $session->message("Application submitted successfully");
                              redirect_to("{$seperator}candidate/job-search.php");
                          }
                          
                    }
        
                } 
                else { // problem uploading cv
                    foreach($resume->errors as $error => $msg) {
                        $message .= "{$msg} \n";
                        redirect_to("{$seperator}candidate/job-search.php");
                        
                    }
                }
        
            } 
          
          else { // output file upload error message
                foreach($resume->errors as $error => $msg) {
                    $message .= "{$msg} \n";
                }  
            }
        
}

<?php $seperator = "../../";
include_once("{$seperator}includes/initialize.php");

$candidate = Candidate::findDetails($session->candidateID); 

// if(!isAjaxRequest()) { redirect_to($seperator); }
if(!$_POST['submit']) {redirect_to("$seperator"); }

switch($_POST['update_type']) {
        //  PERSONAL DETAILS SECTION

    case "pd" :
        $type = "personal_details";
        $errors = [];

        $raw_fields                 = [
            'phone'                 => $_POST['phone'], 
            'email'                 => $_POST['email'], 
            'address'               => $_POST['address'], 
            'location'              => $_POST['location'], 
            'day'                   => $_POST['dob_d'], 
            'month'                 => $_POST['dob_m'], 
            'year'                  => $_POST['dob_y'] 
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
            if(!$validation->rightEmailSyntax(trim($_POST['email']))) {
                        
                $errors['email'] = "Email not in the right format";
                
            // it skips if email sent corresponds to user's email
            } elseif($candidate->email !== trim($_POST['email'])) { 
            
                if(!User::isUnique(trim($_POST['email']), "email")) { 
                        
                    $errors['email'] = "This email has been registered. Please choose another email";
                   
                }
            }
    
        }

        // check if phone number is entered
        if(!isset($errors['phone'])) {
                
            // check if phone is digits and is unique
            if(!$validation->isDigits(trim($_POST['phone']))) {
                        
                $errors['phone'] = "Phone number is not in right format";
                    
            
            } elseif($candidate->phone !== trim($_POST['phone'])) { 
                
                if(!User::isUnique(trim($_POST['phone']), "phone")) { 
                        
                    $errors['phone'] = "This phone number has been registered.";
                        
                }
            }
        }

        // if errors are present
        if(!empty($errors)) {
            $session->errors($errors);
            redirect_to("{$seperator}candidate/update-profile.php?type={$type}");

        }

        // else continue
        $candidate->phone                   = trim($_POST['phone']); 
        $candidate->email                   = trim($_POST['email']); 
        $candidate->address                 = nl2br(trim($_POST['address'])); 
        $candidate->personal_statement      = trim($_POST['personal_statement']); 
        $candidate->location                = trim($_POST['location']); 
        $candidate->gender                = trim($_POST['gender']); 
        $candidate->dob                     = trim($_POST['dob_d']) . "/" . trim($_POST['dob_m']) . "/" . trim($_POST['dob_y']); 

        if($candidate->update()) {
            $session->message("personal details updated successfully");
            redirect_to("{$seperator}candidate/my-profile.php");

        } else {
            $session->message("no changes made to details");            
            redirect_to("{$seperator}candidate/my-profile.php");            
            
        }

        break;

    
    // CAREER SUMMARY SECTION
    case "cs" :
        $type = "career_summary";
        $errors = [];

        $raw_fields             = [
            'job_title'         => $_POST['job_title'], 
            'job_field'         => $_POST['job_field'], 
            'job_type'          => $_POST['job_type'], 
            'location'          => $_POST['location'] 
        ];

        foreach($raw_fields as $field => $value){
            if(!$validation->hasPresence($value)) {
                $errors[$field] = ucwords(str_replace("_", " ", $field)) . " can't be blank";
            }
        }

        if(!empty($errors)) {
            $session->errors($errors);
            redirect_to("{$seperator}candidate/update-profile.php?type={$type}");

        }

        $desiredJob = DesiredJob::findAllUnderParent($candidate->id, "user_id");

        if(!empty($desiredJob) && count($desiredJob) == 1) {

            $desiredJob[0]->job_title    = trim($_POST['job_title']); 
            $desiredJob[0]->user_id      = $candidate->id; 
            $desiredJob[0]->job_field    = trim($_POST['job_field']); 
            $desiredJob[0]->job_type     = trim($_POST['job_type']); 
            $desiredJob[0]->salary_range = trim($_POST['salary_range']); 
            $desiredJob[0]->location     = trim($_POST['location']); 

            if($desiredJob[0]->update()) {
            
                $session->message("career summary updated successfully");
                redirect_to("{$seperator}candidate/my-profile.php");
        
            } else {
           
                $session->message("no changes made to career summary");
                redirect_to("{$seperator}candidate/my-profile.php");            
            
            }
        
        } else { // new input

            $desiredJob = new DesiredJob();

            $desiredJob->job_title    = trim($_POST['job_title']); 
            $desiredJob->user_id      = $candidate->id; 
            $desiredJob->job_field    = trim($_POST['job_field']); 
            $desiredJob->job_type     = trim($_POST['job_type']); 
            $desiredJob->salary_range = trim($_POST['salary_range']); 
            $desiredJob->location     = trim($_POST['location']); 

            if($desiredJob->create()) {
                
                    $session->message("career summary updated successfully");
                    redirect_to("{$seperator}candidate/my-profile.php");
            
                } else {
               
                    $session->message("no changes made to career summary");
                    redirect_to("{$seperator}candidate/my-profile.php");            
                
                }

        }
        break;


        // EDUCATION SECTION

    case "edu" :
        $type = "education";
        $errors = [];


        $raw_fields         = [
            'course'        => $_POST['course'], 
            'degree'        => $_POST['degree'], 
            'school'        => $_POST['school'], 
            'location'      => $_POST['location'], 
            'grade'         => $_POST['grade'], 
            'year'          => $_POST['year'] 
        ];

        foreach($raw_fields as $field => $value){
            if(!$validation->hasPresence($value)) {
                $errors[$field] = ucwords(str_replace("_", " ", $field)) . " can't be blank";
            }
        }

        if(!empty($errors)) {
            $session->errors($errors);

            // new entry
            if(isset($_POST['action']) && $_POST['action'] == "add") {
                redirect_to("{$seperator}candidate/update-profile.php?type={$type}&action=add");
            }

            // update entry
            redirect_to("{$seperator}candidate/update-profile.php?type={$type}");
        }

        // new entry
        if(isset($_POST['action']) && $_POST['action'] == "add") {
            $school = new School();
            $school->course     = trim($_POST['course']); 
            $school->degree     = trim($_POST['degree']); 
            $school->school     = trim($_POST['school']); 
            $school->grade      = trim($_POST['grade']); 
            $school->year       = trim($_POST['year']); 
            $school->location   = trim($_POST['location']);
            $school->user_id    = $session->candidateID;

            if($school->create()) {
                $session->message("new education entry added successfully");
                redirect_to("{$seperator}candidate/my-profile.php");
            }


        } else { // update entry 

            $school = School::findAllUnderParent($session->candidateID, "user_id");

            $school[0]->course     = trim($_POST['course']); 
            $school[0]->degree     = trim($_POST['degree']); 
            $school[0]->school     = trim($_POST['school']); 
            $school[0]->grade      = trim($_POST['grade']); 
            $school[0]->year       = trim($_POST['year']); 
            $school[0]->location   = trim($_POST['location']); 

            if($school[0]->update()) {
                $session->message("career summary updated successfully");
                redirect_to("{$seperator}candidate/my-profile.php");
            }

        }

        break;

    // SKILL SECTION
    case "sk" :

    $type = "skills";
    $errors = [];

        if(!$validation->hasPresence(trim($_POST['skill_name']))) {
            $errors['skill_name'] = ucwords(str_replace("_", " ", 'skill_name')) . " can't be blank";
        }

    if(!empty($errors)) {
        $session->errors($errors);

        // new entry
        if(isset($_POST['action']) && $_POST['action'] == "add") {
            redirect_to("{$seperator}candidate/update-profile.php?type={$type}&action=add");
        }

        // update entry
        redirect_to("{$seperator}candidate/update-profile.php?type={$type}");
    }

    // new entry
    if(isset($_POST['action']) && $_POST['action'] == "add") {
        
        $skill = new Skills();
        
        $skill->skill_name   = trim($_POST['skill_name']);
        $skill->user_id      = $session->candidateID;

        if($skill->create()) {
            
            $session->message("new skill entry added successfully");
            redirect_to("{$seperator}candidate/my-profile.php");
        }


    } else { // update entry 

        $skill = Skills::findAllUnderParent($session->candidateID, "user_id");

        $skill[0]->skill_name   = trim($_POST['skill_name']); 

        if($skill[0]->update()) {
            $session->message("skill updated successfully");
            redirect_to("{$seperator}candidate/my-profile.php");
        }

    }

    break;

    // MEMBERSHIP SECTION
    case "mem" :
    
        $type = "memberships";
        $errors = [];
    
        $raw_fields         = [
            'organization'  => $_POST['organization'],  
            'year'          => $_POST['year'] 
        ];

        foreach($raw_fields as $field => $value){
            if(!$validation->hasPresence($value)) {
                $errors[$field] = ucwords(str_replace("_", " ", $field)) . " can't be blank";
            }
        }
    
        if(!empty($errors)) {
            $session->errors($errors);
    
            // new entry
            if(isset($_POST['action']) && $_POST['action'] == "add") {
                redirect_to("{$seperator}candidate/update-profile.php?type={$type}&action=add");
            }
    
            // update entry
            redirect_to("{$seperator}candidate/update-profile.php?type={$type}");
        }
    
        // new entry
        if(isset($_POST['action']) && $_POST['action'] == "add") {
            
            $membership = new Membership();
            
            $membership->organization   = trim($_POST['organization']);
            $membership->year           = trim($_POST['year']);
            $membership->user_id        = $session->candidateID;
    
            if($membership->create()) {
                
                $session->message("new membership entry added successfully");
                redirect_to("{$seperator}candidate/my-profile.php");
            }
    
    
        } else { // update entry 
    
            $membership = Membership::findAllUnderParent($session->candidateID, "user_id");
    
            $membership[0]->organization   = trim($_POST['organization']); 
            $membership[0]->year           = trim($_POST['year']); 
            
            if($membership[0]->update()) {
                $session->message("membership updated successfully");
                redirect_to("{$seperator}candidate/my-profile.php");
            }
    
        }
    
        break;
}
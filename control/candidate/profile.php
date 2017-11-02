<?php $seperator = "../../";
include_once("{$seperator}includes/initialize.php");

// if(!isAjaxRequest()) { redirect_to($seperator); }
if(!$_POST['submit']) {redirect_to("$seperator"); }

switch($_POST['update_type']) {

        //  PERSONAL DETAILS SECTION

    case "pd" :
        $type = "personal_details";
        $errors = [];

        $raw_fields        = [
            'phone'         => $_POST['phone'], 
            'email'         => $_POST['email'], 
            'address'       => $_POST['address'], 
            'personal_statement'       => $_POST['personal_statement'], 
            'location'      => $_POST['location'], 
            'day'           => $_POST['dob_d'], 
            'month'         => $_POST['dob_m'], 
            'year'          => $_POST['dob_y'] 
        ];

        // check for presence
        foreach($raw_fields as $field => $value){
            if(!$validation->hasPresence($value)) {
                $errors[$field] = ucwords(str_replace("_", " ", $field)) . " can't be blank";
            }
        }

        // check for email format
        if(!isset($errors['email'])) {

            // check email
            if(!$validation->rightEmailSyntax(trim($_POST['email']))) {
                $errors['email'] = "Email not in the right format";
            }
        }

        // if errors are present
        if(!empty($errors)) {
            $session->errors($errors);
            redirect_to("{$seperator}candidate/update-profile.php?type={$type}");

        }

        // else continue
        $candidate = Candidate::findDetails($session->candidateID);

        $candidate->phone         = trim($_POST['phone']); 
        $candidate->email         = trim($_POST['email']); 
        $candidate->employer      = trim($_POST['employer']); 
        $candidate->address       = trim($_POST['address']); 
        $candidate->personal_statement       = trim($_POST['personal_statement']); 
        $candidate->location      = trim($_POST['location']); 
        $candidate->dob           = trim($_POST['dob_d']) . "/" . trim($_POST['dob_m']) . "/" . trim($_POST['dob_y']); 

        if($candidate->update()) {
            $session->message("personal details updated successfully");
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
            'salary_range'      => $_POST['salary_range'], 
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

        $desiredJob = DesiredJob::findAllUnderParent($session->candidateID, "user_id");

        $desiredJob[0]->job_title  = $_POST['job_title']; 
        $desiredJob[0]->user_id    = $session->candidateID; 
        $desiredJob[0]->job_field  = $_POST['job_field']; 
        $desiredJob[0]->job_type   = $_POST['job_type']; 
        $desiredJob[0]->salary_range = $_POST['salary_range']; 
        $desiredJob[0]->location     = $_POST['location']; 

        if($desiredJob[0]->update()) {
            $session->message("career summary updated successfully");
            redirect_to("{$seperator}candidate/my-profile.php");

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
            $_SESSION['errors'] = $errors;

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
            $school->course     = $_POST['course']; 
            $school->degree    = $_POST['degree']; 
            $school->school     = $_POST['school']; 
            $school->grade      = $_POST['grade']; 
            $school->year       = $_POST['year']; 
            $school->location   = $_POST['location'];
            $school->user_id   = $session->candidateID;

            if($school->create()) {
                $session->message("new education entry added successfully");
                redirect_to("{$seperator}candidate/my-profile.php");
            }


        } else { // update entry 

            $school = School::findAllUnderParent($session->candidateID, "user_id");

            $school[0]->course     = $_POST['course']; 
            $school[0]->degree    = $_POST['degree']; 
            $school[0]->school     = $_POST['school']; 
            $school[0]->grade      = $_POST['grade']; 
            $school[0]->year       = $_POST['year']; 
            $school[0]->location   = $_POST['location']; 

            if($school[0]->update()) {
                $session->message("career summary updated successfully");
                redirect_to("{$seperator}candidate/my-profile.php");
            }

        }

        break;
}
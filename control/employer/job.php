<?php $seperator = "../../";
include_once("{$seperator}includes/initialize.php");

if(!$_POST['submit']) {redirect_to($seperator); }

// convert text to lists
function convertToList($text) {
    $output  = "<ul><li>";
    $output .= str_replace("<br />", "</li><li>", nl2br(trim($_POST['requirements'])));
    $output .= "</li></ul>";

    return $output;
    
}

switch($_POST['type']) {

        //  CREATE NEW JOB

    case "post" :
        $errors = [];

        $raw_fields             = [
            'title'                 => $_POST['title'], 
            'job_field'             => $_POST['job_field'], 
            'qualification'         => $_POST['qualification'], 
            'job_experience'        => $_POST['job_experience'], 
            'job_type'              => $_POST['job_type'], 
            'location'              => $_POST['location'], 
            'keywords'              => $_POST['keywords'], 
            'day'                   => $_POST['d'], 
            'month'                 => $_POST['m'], 
            'year'                  => $_POST['y'], 
            'description'           => $_POST['description'], 
            'requirements'          => $_POST['requirements'],             
            'responsibilities'      => $_POST['responsibilities']             
        ];

        // check for presence
        foreach($raw_fields as $field => $value){
            if(!$validation->hasPresence($value)) {
                $errors[$field] = ucwords(str_replace("_", " ", $field)) . " can't be blank";
            }
        }

        // if errors are present
        if(!empty($errors)) {
            $_SESSION['errors'] = $errors;
            redirect_to("{$seperator}employer/create-job.php");

        }

        // else continue
        
        // converting requirements and responsibilities to list items
        // and reassigning
        $_POST['responsibilities'] = convertToList($_POST['responsibilities']);
        $_POST['requirements']     = convertToList($_POST['requirements']);

        // converting deadline to timestamp
        $timestamp = strtotime("{$_POST['d']}-{$_POST['m']}-{$_POST['y']}");
        $deadline  = date('Y-m-d G:i:s', $timestamp);
        
        // instantiate and continue
        $job = new Jobs();

        $job->deadline          = $deadline; 
        $job->title             = trim($_POST['title']); 
        $job->job_field         = trim($_POST['job_field']); 
        $job->qualification     = trim($_POST['qualification']); 
        $job->job_experience    = trim($_POST['job_experience']); 
        $job->job_type          = trim($_POST['job_type']); 
        $job->keywords          = trim($_POST['keywords']); 
        $job->description       = trim($_POST['description']); 
        $job->requirements      = trim($_POST['requirements']); 
        $job->responsibilities  = trim($_POST['responsibilities']); 
        $job->location          = trim($_POST['location']); 
        $job->salary_range      = ($_POST['salary_range']); 
        $job->employer_id       = $session->employerID; 
        
        if($job->create()) {
            $session->message("job posted successfully");
            redirect_to("{$seperator}employer/dashboard.php");
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

        $desiredJob = DesiredJob::findAllUnderParent($session->id, "user_id");

        $desiredJob[0]->job_title  = $_POST['job_title']; 
        $desiredJob[0]->user_id    = $session->id; 
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
            $school->user_id   = $session->id;

            if($school->create()) {
                $session->message("new education entry added successfully");
                redirect_to("{$seperator}candidate/my-profile.php");
            }


        } else { // update entry 

            $school = School::findAllUnderParent($session->id, "user_id");

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
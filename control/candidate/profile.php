<?php $seperator = "../../";
include_once("{$seperator}includes/initialize.php");

// if(!isAjaxRequest()) { redirect_to($seperator); }
switch($_POST['profile_type']) {

    case "pd" : // personal details section

        $errors = [];
        $raw_fields        = [
            'phone'         => $_POST['phone'], 
            'email'         => $_POST['email'], 
            'employer'      => $_POST['employer'], 
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
            $errors = array('errors' => $errors);
            echo json_encode($errors); 
            exit;
        }

        // else continue
        $id         = trim($_POST['id']); 
        $user = User::findDetails($id);

        $user->phone     = trim($_POST['phone']); 
        $user->email         = trim($_POST['email']); 
        $user->employer      = trim($_POST['employer']); 
        $user->address       = trim($_POST['address']); 
        $user->personal_statement       = trim($_POST['personal_statement']); 
        $user->location      = trim($_POST['location']); 
        $user->dob           = trim($_POST['dob_d']) . "/" . trim($_POST['dob_m']) . "/" . trim($_POST['dob_y']); 

        if($user->update()) {
            echo json_encode($user); 
            exit;

        }

        break;

    case "cs" : // career summary section

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
            $errors = array('errors' => $errors);
            echo json_encode($errors); 
            exit;
        }

        $user_id    = trim($_POST['id']); 
        $desiredJob = DesiredJob::findAllUnderParent($user_id, "user_id");

        $desiredJob[0]->job_title  = $_POST['job_title']; 
        $desiredJob[0]->user_id    = $_POST['id']; 
        $desiredJob[0]->job_field  = $_POST['job_field']; 
        $desiredJob[0]->job_type   = $_POST['job_type']; 
        $desiredJob[0]->salary_range = $_POST['salary_range']; 
        $desiredJob[0]->location     = $_POST['location']; 

        if($desiredJob[0]->update()) {
            echo json_encode($desiredJob); 
            exit;

        }


        break;
}
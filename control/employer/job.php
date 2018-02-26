<?php $seperator = "../../";
include_once("{$seperator}includes/initialize.php");

$_POST = $session->postValues();

if(!$_POST['submit']) {redirect_to($seperator); }

// convert text to lists
// function convertToList($text) {
//     $output  = "<ul><li>";
//     $output .= str_replace("<br />", "</li><li>", nl2br(trim($_POST['requirements'])));
//     $output .= "</li></ul>";

//     return $output;
    
// }

switch($_POST['type']) {

        //  CREATE NEW JOB

    case "post" :
        $errors = [];
        $allowedTags = '<ul><li><br><p><strong>';

        // assigning $_POST variables
        $title              = trim($_POST['title']);
        $job_field          = trim($_POST['job_field']);
        $qualification      = trim($_POST['qualification']);
        $job_experience     = trim($_POST['job_experience']);
        $job_type           = trim($_POST['job_type']);
        $location           = trim($_POST['location']);
        $keywords           = trim($_POST['keywords']);
        $day                = trim($_POST['day']);
        $month              = trim($_POST['month']);
        $year               = trim($_POST['year']);
        $description        = trim($_POST['description']);
        $salary_range       = trim($_POST['salary_range']);
        
        $raw_fields             = [
            'title'                 => $title, 
            'job_field'             => $job_field, 
            'qualification'         => $qualification, 
            'job_experience'        => $job_experience, 
            'job_type'              => $job_type, 
            'location'              => $location, 
            'keywords'              => $keywords, 
            'day'                   => $day, 
            'month'                 => $month, 
            'year'                  => $year, 
            'description'           => $description 
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
        // $_POST['responsibilities'] = convertToList($_POST['responsibilities']);
        // $_POST['requirements']     = convertToList($_POST['requirements']);

        // converting deadline to timestamp
        $timestamp = strtotime("{$day}-{$month}-{$year}");
        $deadline  = date('Y-m-d G:i:s', $timestamp);
        
        // instantiate and continue
        $job = new Jobs();

        $job->deadline          = $deadline; 
        $job->title             = $title; 
        $job->job_field         = $job_field; 
        $job->qualification     = $qualification; 
        $job->job_experience    = $job_experience; 
        $job->job_type          = $job_type; 
        $job->keywords          = $keywords; 
        $job->description       = htmlentities(strip_tags($description, $allowedTags)); 
        $job->location          = $location; 
        $job->salary_range      = $salary_range; 
        $job->employer_id       = $session->employerID; 
        
        if($job->create()) {
            $session->message("job posted successfully");
            redirect_to("{$seperator}employer/dashboard.php");
        }

        break;

}
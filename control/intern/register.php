<?php $seperator = "../../";
include_once("{$seperator}includes/initialize.php");

$_POST = $session->postValues();
$_FILES = $session->fileValues();

$referer = $_SERVER['HTTP_REFERER'];
$errors = [];

if(!isset($_POST['submit'])) { redirect_to($referer); }

if (isset($_FILES['intern-letter']) || isset($_FILES['update-letter'])) {
    
    $internLetter = new Resume();
    
    if(isset($_FILES['update-letter'])) {
        
        $fileName = $_FILES['update-letter'];
        
        // delete previous file
        // $intern = Intern::findDetails($session->internID);      
    
    }

    elseif(isset($_FILES['intern-letter'])) {
        
        $fileName = $_FILES['intern-letter'];

    }

    if (!$internLetter->attach_file($fileName)) { // output file upload error message

        foreach ($internLetter->errors as $errorIndex => $error) {
            $errors[] = $error;
        }

        $session->errors($errors);
        redirect_to($referer);
    }

    if (!$internLetter->upload()) { // problem uploading cv

        foreach ($internLetter->errors as $errorIndex => $error) {
            $errors[] = $error;
        }
        
        $session->errors($errors);
        redirect_to($referer);

    }

    /* no errors, save path in db */
    $internLetter->updateDB($session->internID);
                  
}

$duration   = strip_tags(trim($_POST['duration']));
$course     = strip_tags(trim($_POST['course']));
$state      = strip_tags(trim($_POST['state']));
$school     = strip_tags(trim($_POST['school']));
$day        = strip_tags(trim($_POST['startDate_d']));
$month      = strip_tags(trim($_POST['startDate_m']));
$year       = strip_tags(trim($_POST['startDate_y']));
$state      = strip_tags(trim($_POST['state']));


$raw_fields = [
    'duration'  => $duration,
    'course'    => $course,
    'state'     => $state,
    'state'     => $state,
    'school'    => $school,
    'day'       => $day,
    'month'     => $month,
    'year'      => $year
];


// check for presence
foreach ($raw_fields as $field => $value) {
    if (!$validation->hasPresence($value)) {
        $errors[$field] = ucwords(str_replace("_", " ", $field)) . " can't be blank";
    }
}


// if errors are present
if (!empty($errors)) {

    $session->errors($errors);
    redirect_to($referer);

}

// else continue
$regDetails = new InternshipDetails();

$regDetails->intern_id  = $session->internID;
$regDetails->duration   = $duration;
$regDetails->course     = $course;
$regDetails->state      = $state;
$regDetails->state      = $state;
$regDetails->school     = $school;
$regDetails->start_date = $day . "/" . $month . "/" . $year;

if ($regDetails->create()) {
                              
    // send confirmation msg and redirect
    $session->message("Internship registered successfully");
    redirect_to($referer);
}
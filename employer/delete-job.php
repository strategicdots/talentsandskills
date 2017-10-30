<?php $thisPage = "create-job"; $seperator="../"; 
include_once("{$seperator}includes/initialize.php");

/* check user status */
if (!$session->isEmployerLoggedIn()) {redirect_to("{$seperator}login.php"); } 
$employer = Employer::findDetails($session->employerID);

$job = Jobs::findDetails($_GET['id']);

// check if job is from employer
if($job->employer_id === $employer->id) {
      $jobTitle = $job->title;
      if($job->delete()) {
            $session->message("'{$jobTitle}' deleted successfully");
            redirect_to("dashboard.php");
      }
}

?>
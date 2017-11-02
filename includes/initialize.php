<?php
// session_start();
# SESSION TIMEOUT FUNCTION
/*if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
    redirect_to("public/login.php"); //redirect to login page for new login activity
} else { 
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
}
*/

// load composer autoload
// require_once("../vendor/autoload.php");

// load basic functions next so that everything after can use them
require_once("functions.php");
require_once("validations.php");

// load core objects



// load database-related classes
require_once("DatabaseObject.php");
require_once("MySQLDatabase.php");
require_once("Session.php");
require_once("users.php");
require_once("candidate.php");
require_once("employers.php");
require_once("admin.php");
require_once("jobFields.php");
require_once("desiredJob.php");
require_once("schools.php");
require_once("skills.php");
require_once("professionalMemberships.php");
require_once("employmentHistory.php");
require_once("interests.php");
require_once("states.php");
require_once("jobType.php");
require_once("jobExperience.php");
require_once("jobLevel.php");
require_once("jobDescription.php");
require_once("jobs.php");
require_once("interfaces.php");
require_once("salaryRange.php");
require_once("fileUpload.php");
require_once("resumeUpload.php");
require_once("applicants.php");

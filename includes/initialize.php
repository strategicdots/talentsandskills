<?php
session_start();
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

define('DS', '/');
define('SITE_ROOT', $_SERVER['DOCUMENT_ROOT'] .DS. "Talentandskills");

// load config file first
// require_once("config.php");

// load basic functions next so that everything after can use them
require_once("functions.php");
require_once("validations.php");

// load core objects



// load database-related classes
require_once("DatabaseObject.php");
require_once("MySQLDatabase.php");



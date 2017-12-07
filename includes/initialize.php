<?php

defined('DS') ? null : define('DS', "/");
defined('SITE_ROOT') ? null : define('SITE_ROOT', $_SERVER['DOCUMENT_ROOT'].DS.'talents');
defined('LIB_PATH') ? null  : define('LIB_PATH', SITE_ROOT.DS.'includes');

// COMPOSER AUTOLOAD
require_once(SITE_ROOT.DS."vendor/autoload.php");

// FUNCTIONS AND FORM VALIDATIONS
require_once("functions.php");
require_once("validations.php");

// CORE OBJECT
// require_once(LIB_PATH.DS."config.php");

// DATABASE RELATED OBJECTS
require_once(LIB_PATH.DS."DatabaseObject.php");
require_once(LIB_PATH.DS."MySQLDatabase.php");
require_once(LIB_PATH.DS."Session.php");

// FILE RELATED OBJECTS
require_once(LIB_PATH.DS."fileUpload.php");
require_once(LIB_PATH.DS."resumeUpload.php");
require_once(LIB_PATH.DS."avatarUpload.php");

// USER LOGIN OBJECTS
require_once(LIB_PATH.DS."users.php");
require_once(LIB_PATH.DS."userValidation.php");
require_once(LIB_PATH.DS."candidate.php");
require_once(LIB_PATH.DS."intern.php");
require_once(LIB_PATH.DS."employers.php");
require_once(LIB_PATH.DS."admin.php");

// USER ACTIVITY RELATED OBJECTS
require_once(LIB_PATH.DS."desiredJob.php");
require_once(LIB_PATH.DS."schools.php");
require_once(LIB_PATH.DS."skills.php");
require_once(LIB_PATH.DS."professionalMemberships.php");
require_once(LIB_PATH.DS."employmentHistory.php");
require_once(LIB_PATH.DS."interests.php");
require_once(LIB_PATH.DS."states.php");
require_once(LIB_PATH.DS."pagination.php");

// JOB RELATED OBJECTS
require_once(LIB_PATH.DS."jobs.php");
require_once(LIB_PATH.DS."jobType.php");
require_once(LIB_PATH.DS."jobFields.php");
require_once(LIB_PATH.DS."jobExperience.php");
require_once(LIB_PATH.DS."jobLevelAndQualification.php");
require_once(LIB_PATH.DS."jobDescription.php");
require_once(LIB_PATH.DS."interfaces.php");
require_once(LIB_PATH.DS."salaryRange.php");
require_once(LIB_PATH.DS."application.php");

// PHPMAILER OBJECTS
require_once(LIB_PATH.DS."phpmailer/class.phpmailer.php");
require_once(LIB_PATH.DS."phpmailer/class.smtp.php");
require_once(LIB_PATH.DS."phpmailer/language/phpmailer.lang-en.php");
require_once(LIB_PATH.DS."mailer.php");
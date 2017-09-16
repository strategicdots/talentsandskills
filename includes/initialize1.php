<?php 
session_start();

define('DS', '/');
define('SITE_ROOT', $_SERVER['DOCUMENT_ROOT'] .DS. "EpisodeInteriors");

/* session */
include_once("Session.php");

/* core objects */
include_once("MySQLDatabase.php");
include_once("DatabaseObject.php");
require_once("random_compat/lib/random.php");
require_once("phpmailer/class.phpmailer.php");
require_once("phpmailer/class.smtp.php");
require_once("phpmailer/language/phpmailer.lang-en.php");
include_once("Mailer.php");

/* user related */
include_once("Admin.php");
include_once("Images.php");
include_once("ProductCategories.php");
include_once("CustomerMessages.php");
include_once("CustomerIntent.php");
include_once("ProductItems.php");

/* others */
include_once("functions.php");
include_once("validations.php");

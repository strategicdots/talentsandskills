<?php $seperator = "../../";
include_once("{$seperator}includes/initialize.php");

$referer = $_SERVER['HTTP_REFERER'];

$_POST = $session->postValues();

if (!isset($_POST['submit']) && !isset($_GET['employer'])) {
      redirect_to("{$seperator}intern/dashboard.php");
}

// 1) find if user has registered an intern spot 
$userInternSpot = InternshipDetails::findByInternID($session->internID);

// 2) redirect if spot is not found or ids don't match
if (!$userInternSpot || $userInternSpot[0]->id != trim($_GET['id'])) {
      redirect_to($referer);
}

// 3) delete spot
if (InternshipDetails::delete(trim($_GET['id']))) {
      $session->message("Internship spot deleted successfully. \n You can now register a new one.");
      redirect_to($referer);
}
<?php $seperator="../";
require_once("{$seperator}includes/initialize.php"); ?>
<?php if (!$session->isCandidateLoggedIn()) {redirect_to("{$seperator}login.php"); } ?>
<?php
$session->candidateLogout();
$session->message("You've been successfully logged out");
redirect_to("{$seperator}login.php");

?>
<?php if(isset($database)) { $database->closeConn(); } ?>
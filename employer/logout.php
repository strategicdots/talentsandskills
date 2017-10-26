<?php $seperator="../";
require_once("{$seperator}includes/initialize.php"); ?>
<?php if (!$session->isEmployerLoggedIn()) {redirect_to("{$seperator}login.php"); } ?>
<?php
$session->employerLogout();
$session->message("You've been successfully logged out");
redirect_to("{$seperator}login.php");

?>
<?php if(isset($database)) { $database->closeConn(); } ?>
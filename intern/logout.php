<?php $seperator="../";
require_once("{$seperator}includes/initialize.php"); ?>
<?php if (!$session->isInternLoggedIn()) {redirect_to("{$seperator}login.php"); } ?>
<?php
$session->internLogout();
$session->message("You've been successfully logged out");
redirect_to("{$seperator}login.php");

?>
<?php if(isset($database)) { $database->closeConn(); } ?>
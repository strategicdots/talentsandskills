<?php $seperator = "../";
include_once("{$seperator}includes/initialize.php");


if (isset($_SESSION['socialProfile'])) {

      echo $_SESSION['socialProfile'];
      exit;
}
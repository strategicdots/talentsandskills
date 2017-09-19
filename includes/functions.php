<?php include_once("initialize.php");

function redirect_to( $location = NULL ) {
    if($location != NULL) {
        header("location: {$location}");
        exit;
    }
}

function output_message($message="") {
    if (!empty($message)) {
        return "<p class=\"message\">{$message} </p>";
    } else {
        return "";
    }
}

function currentPage() {
    $output = "class=\"current\""; 
    return $output;
}
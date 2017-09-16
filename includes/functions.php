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

function seperator($layer = NULL) {
    
    $output = "";
    switch($layer) {
        case "1st" :
            continue;
        case "2nd" :
            $output .= "../";
            break;
        case "3rd" :
            $output .= "../../";
            break;
        case "4th" :
            $output .= "../../../";
            break;
        case "5th" :
            $output .= "../../../../";
            break;
        case "6th" :
            $output .= "../../../../../";
            break;
    }

    return $output;

}
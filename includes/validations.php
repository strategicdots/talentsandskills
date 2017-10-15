<?php require_once("initialize.php");

class FormValidation {

    public function hasPresence($value) {
        $trimmed_value = trim($value);
        if (isset($trimmed_value) && ($trimmed_value !== "")) {
            return true;
        }
    }

    public function isDigits($value) {
        $trimmed_value = trim($value);
        if(ctype_digit($trimmed_value)) { 
            return true;
        } else {
            return false;
        }
    }

    public function hasMaxLength($value, $max) {
        if(strlen($value) <= (int)$max) {
            return true;
        }
    }

    public function hasMinLength($value, $min) {
        if(strlen($value) >= (int) $min) {
            return true;
        }
    }
    
    public function hasFormatMatching($value, $regex='//') {
	return preg_match($regex, $value);
}
    
    public function rightEmailSyntax($email) {
        if(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", $email)){
            return true; // email syntax is right
        } else { 
            return false;
        }
    }

    public function isUnique($value, $table, $column) {
        global $database;
        $escaped_value = $database->escape_value($value);
        $sql = "SELECT COUNT(*) as count FROM {$table} WHERE {$column} = '{$escaped_value}'";
        /* $result = mysqli_query($open_conn, $sql);
        if($result <= 0) {
            return true;*/
    }

    public function formErrors($errors = []) {
        $output = "";
        if (!empty($errors)) {
            $output .= "<div class=\"error m-light-bottom-breather m-light-top-breather \">";
            $output .= "<p>Please fix the following errors: </p>";
            $output .= "<ul>";
            foreach ($errors as $key => $error) {
                $output .= "<li>{$error}</li>";
            }
            $output .= "</ul>";
            $output .= "</div>";
        }
        return $output;
    }

    public function cleanHTMLOutput($value) {
        $clean_value = htmlentities($value);
        return $clean_value;
    }

    public function cleanUrl($value) {
        $clean_value = urlencode($value);
        return $clean_value;
    }
}

$validation = new FormValidation();
?>

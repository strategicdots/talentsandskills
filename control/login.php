<?php $seperator = "../"; 
require_once("{$seperator}includes/initialize.php");


$post = $_SESSION['post'] = $_POST;
$errors = [];
if(isset($_POST['submit'])) {


    $raw_fields    = [
        'email'         => $_POST['email'], 
        'password'      => $_POST['password']
    ];

    foreach ($raw_fields as $field => $value) {
        if(!$validation->hasPresence($value)) {
            $errors[$field] = ucwords(str_replace("_", " ", $field)) . " can't be blank";
        }
    }

    if(empty($errors)) {

        // VALIDATIONS PASSED
        $password = trim($_POST['password']);
        $email = trim($_POST['email']);

        // check if is user or admin
        $entry       = User::findDetailsByEmail($email);
        // $employer   = Admin::find_admin_by_email($email);

        if(!empty($entry)) { 
            if($entry->candidate == 1) {
                if(password_verify($password, $entry->password)) { // Password Match
                    $user = new User();
                    $_SESSION['candidateID'] = $user->id = $entry->id;
                    redirect_to("{$seperator}candidate/dashboard.php");
                } else {
                    $session->message("email/password does not match");
                    redirect_to("{$seperator}login.php");
                }
            } elseif($entry->employer == 1) {
                if(password_verify($password, $entry->password)) { // Password Match
                    $user = new Employer();
                    $_SESSION['employerID'] = $employer->id = $entry->id;
                    redirect_to("{$seperator}employer/dashboard.php");
                } else {
                    $session->message("email/password does not match");
                    redirect_to("{$seperator}login.php");
                }
            }

        } else {
            // check if it's a temporary user
            /* $temp_user = new TempUser();
            if($temp_user->temporary_user($email)) {
                $session->message("Your account is unverified, please enter your email to verify your account.");
                redirect_to("../verification/");
            } else {
                $session->message("The records for this email is not found");
                redirect_to("{$seperator}login.php"); 
            } */
        }
    } else {
        $_SESSION['errors'] = $errors;
        $session->message("please send in both form values");
        redirect_to("{$seperator}login.php");
    }
} else {
    $session->message("please send in the form values");
    redirect_to("{$seperator}login.php");
}
?>

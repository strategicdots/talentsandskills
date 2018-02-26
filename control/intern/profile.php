<?php $seperator = "../../";
include_once("{$seperator}includes/initialize.php");

$intern = Intern::findDetails($session->internID);

$_POST = $session->postValues();

if(!$_POST['submit']) {redirect_to("$seperator"); }

$referer = $_SERVER['HTTP_REFERER'];
        
$errors = [];

$phone              = strip_tags(trim($_POST['phone'])); 
$email              = strip_tags(trim($_POST['email'])); 
$address            = strip_tags(trim($_POST['address'])); 
$location           = strip_tags(trim($_POST['location'])); 
$day                = strip_tags(trim($_POST['dob_d'])); 
$month              = strip_tags(trim($_POST['dob_m'])); 
$year               = strip_tags(trim($_POST['dob_y'])); 
$gender             = strip_tags(trim($_POST['gender']));


$raw_fields                 = [
    'phone'                 => $phone, 
    'email'                 => $email, 
    'address'               => $address, 
    'location'              => $location, 
    'day'                   => $day, 
    'month'                 => $month, 
    'year'                  => $year 
];

// check for presence
foreach($raw_fields as $field => $value){
    if(!$validation->hasPresence($value)) {
        $errors[$field] = ucwords(str_replace("_", " ", $field)) . " can't be blank";
    }
}

// check if dob is in the right syntax
if(!$validation->isDigits($day) || !$validation->isDigits($month) || !$validation->isDigits($year)) {
            
    $errors['dob'] = "Please send in your date of birth";            
        
}

// check if email is entered
if(!isset($errors['email'])) {
        
    // check email and if email is unique
    if(!$validation->rightEmailSyntax($email)) {
                        
        $errors['email'] = "Email not in the right format";
                
    // it skips if email sent corresponds to user's email
    } elseif($intern->email !== $email) { 
            
        if(!User::isUnique($email, "email")) { 
                        
            $errors['email'] = "This email has been registered. Please choose another email";
                   
        }
    }
    
}

// check if phone number is entered
if(!isset($errors['phone'])) {
                
    // check if phone is digits and is unique
    if(!$validation->isDigits($phone)) {
                        
        $errors['phone'] = "Phone number is not in right format";
                    
            
    } elseif($intern->phone !== $phone) { 
                
        if(!User::isUnique($phone, "phone")) { 
                        
            $errors['phone'] = "This phone number has been registered.";
                        
        }
    }
}

// if errors are present
if(!empty($errors)) {
            
    $session->errors($errors);
    redirect_to($referer);

}

// else continue
$intern->phone                   = $phone; 
$intern->email                   = $email; 
$intern->address                 = nl2br($address); 
$intern->location                = $location; 
$intern->gender                  = $gender; 
$intern->dob                     = $day . "/" . $month . "/" . $year; 

if(!$intern->update()) {
        
    $session->message("no changes made to details");
    redirect_to("{$seperator}intern/my-profile.php");
    
}

$session->message("personal details updated successfully");
redirect_to("{$seperator}intern/my-profile.php");
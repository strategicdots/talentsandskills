<?php include_once("initialize.php");

function redirect_to( $location = NULL ) {
    if($location != NULL) {
        // flush();
        header("location: {$location}");
        exit;
    }
}

function inline_message() {
    global $session;
    if($session->message == true) {
        $output  = "<div style=\"background-color:#fff; padding: 10px 20px; margin: 20px; \">";
        $output .= "<p style=\"color:red\" class=\"capitalize\">{$session->message}</p></div>";

        return $output;

    } else {
        return "";
    }
}

function displayErrors() {
    global $session;
    $output = "";
    if($session->errors == true) {
        $output .= "<div class=\"errors\">";
        $output .= "<ul class=\"\">";
        foreach($session->errors as $error => $value) {
            $output .= "<li>" . $value . "</li>";
        }
        $output .="</ul></div>";

        return $output;

    } else {
        return "";
    }
}

function password_encrypt($password) {
    $options = [
        'cost' => 11,
        'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
    ];

    return password_hash($password, PASSWORD_BCRYPT, $options);
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

function isAjaxRequest() {
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
        return true; 
    } else { return false; }
}

function formatField($field) {

    return str_replace(" ", "-", (str_replace("/ ", "",$field)));
}

function pDForm($user = null) {
    global $states; 

    $dobArray = explode('/', $user->dob);
    $dob_d = $dobArray[0];
    $dob_m = $dobArray[1];
    $dob_y = $dobArray[2];

    $output = "<form action=\"../control/candidate/profile.php\" method=\"post\" id=\"pd-form\" class=\"sm\">";
    $output .= "<input type=\"hidden\" value=\"pd\" name=\"update_type\">";
    $output .= "<p class=\"capitalize small-font-size txt-bold\">fill in the details</p>";
    $output .= "<div class=\"row\">";
    $output .= "<div class=\"col-sm-6\">";
    $output .= "<div class=\"form-group\">";
    $output .= "<label class=\"txt-bold small-font-size capitalize\">email</label>";
    $output .= "<input type=\"text\" class=\"form-control\" value=\"{$user->email}\" name=\"email\" placeholder=\"your email\"></div>";


    $output .= "<div class=\"form-group\">";
    $output .= "<label class=\"txt-bold small-font-size capitalize\">phone</label>";
    $output .= "<input type=\"tel\" class=\"form-control\" name=\"phone\" value=\"{$user->phone}\" placeholder=\"your phone number\"></div>";
    $output .= "<div class=\"form-group\">";
    $output .= "<label class=\"txt-bold small-font-size capitalize\">Choose your location </label>";
    $output .= "<select class=\"form-control\" id=\"location\" name=\"location\">";

    foreach($states as $state) {
        $output .= "<option value=\"";
        $output .= $state->name . "\""; 
        if($state == $user->location) {
            $output .= " selected>"; 
        } else {
            $output .= " >";
        }

        $output .= $state->name . "</option>";
    }
    $output .= "</select></div>";
    $output .= "<div class=\"form-group\">";
    $output .= "<label class=\"txt-bold small-font-size capitalize\">Date of Birth</label>";
    $output .= "<div class=\"row\">";
    $output .= "<div class=\"col-sm-4\">";
    $output .= "<select name=\"dob_d\" class=\"form-control\" id=\"dob_d\">";
    $output .= "<option selected>DD</option>";

    for($i = 1; $i<=31; $i++) {
        if($i<=9) { 
            if(!empty($dob_d) && $dob_d == $i) {
                $output .= "<option value= \"{$i}\" selected>0{$i}</option>";
            } else { 
                $output .= "<option value= \"{$i}\">0{$i}</option>";
            }
        } else {
            if(!empty($dob_d) && $dob_d == $i) {
                $output .= "<option value= \"{$i}\" selected>0{$i}</option>";
            } else { 
                $output .= "<option value= \"{$i}\">{$i}</option>"; 
            }
        }
    } 

    $output .= "</select></div>";
    $output .= "<div class=\"col-sm-4\">";
    $output .= "<select name=\"dob_m\" class=\"form-control\" id=\"dob_m\">";
    $output .= "<option selected>MM</option>";

    for($i = 1; $i<=12; $i++) {
        if($i<=9) {
            if(!empty($dob_m) && $dob_m == $i) {
                $output .= "<option value= \"{$i}\" selected>0{$i}</option>";
            } else { 
                $output .= "<option value= \"{$i}\">0{$i}</option>"; 
            }
        } else {

            if(!empty($dob_m) && $dob_m == $i) {
                $output .= "<option value= \"{$i}\" selected>0{$i}</option>";
            } else { 
                $output .= "<option value= \"{$i}\">{$i}</option>"; 
            }
        }

    } 

    $output .= "</select></div><div class=\"col-sm-4\">";
    $output .= "<select name=\"dob_y\" class=\"form-control\" id=\"dob_y\">";
    $output .= "<option selected>YYYY</option>";
    for($i = 1900; $i<=2017; $i++) {
        if(!empty($dob_y) && $dob_y == $i) {
            $output .= "<option value= \"{$i}\" selected>{$i}</option>";
        } else { 
            $output .= "<option value= \"{$i}\">{$i}</option>"; 
        }
    }                                 
    $output .= "</select></div></div></div></div>";


    $output .= "<div class=\"col-sm-6\">";
    $output .= "<div class=\"form-group\">";
    $output .= "<label class=\"txt-bold small-font-size capitalize\">personal statement</label>";
    $output .= "<textarea class=\"form-control\" name=\"personal_statement\" rows=\"6\">";
    if(!empty($user->personal_statement)) {
        $output .= $user->personal_statement;
    } else {
        $output .= "current address";
    }
    $output .= "</textarea></div>";

    $output .= "<div class=\"form-group\">";
    $output .= "<label class=\"txt-bold small-font-size capitalize\">address</label>";
    $output .= "<textarea class=\"form-control\" name=\"address\" rows=\"4\">";
    if(!empty($user->address)) {
        $output .= $user->address;
    } else {
        $output .= "current address";
    }
    $output .= "</textarea></div>";

    $output .= "</div></div>";
    $output .= "<div class=\"sm-container m-vlight-breather\">";
    $output .= "<div class=\"row\">";
    $output .= "<div class=\"col-sm-8\">";
    $output .= "<input type=\"submit\" value=\"Confirm Changes\" name=\"submit\" class=\"form-control btn sec-btn capitalize\"></div>";
    $output .= "<div class=\"col-sm-4\">";
    $output .= "<a href=\"my-profile.php\" class=\"form-control capitalize btn main-btn\" >cancel</a>";
    $output .= "</div></div></div></form>";

    return $output;
}

function CSForm($desiredJob = null) {
    global $states, $jobFields, $jobType, $salaryRange;


    $output = "<form action=\"../control/candidate/profile.php\" method=\"post\" class=\"sm\">";
    $output .= "<input type=\"hidden\" value=\"cs\" name=\"update_type\">";
    $output .= "<div class=\"row\">";
    $output .= "<div class=\"col-sm-6\">";
    $output .= "<div class=\"form-group\">";
    $output .= "<label class=\"txt-bold small-font-size capitalize\">desired job title</label>";
    $output .= "<input type=\"text\" class=\"form-control\" value=\"";

    if(isset($desiredJob->job_title)) {
        $output .=  $desiredJob->job_title; 

    } else {

        $output .=  ""; 
    } 

    $output .= "\" name=\"job_title\" placeholder=\"enter your desired job title\"></div>";
    $output .= "<div class=\"form-group\">";
    $output .= "<label class=\"txt-bold small-font-size capitalize\">job field</label>";
    $output .= "<select name=\"job_field\" class=\"form-control\">";
    $output .= "<option value=\"\">choose your field</option>";

    foreach($jobFields as $job_field) {  

        if($job_field->name == $desiredJob->job_field ) { 
            $output .= "<option value=\""; 
            $output .=  $job_field->name; 
            $output .= "\" selected>"; 
            $output .=  ucwords($job_field->name); 
            $output .= "</option>";

        } else { 
            $output .= "<option value=\""; 
            $output .=  $job_field->name; 
            $output .= "\">"; 
            $output .=  ucwords($job_field->name); 
            $output .= "</option>";

        }

    }

    $output .= "</select></div>";
    $output .= "<div class=\"form-group\">";
    $output .= "<label class=\"txt-bold small-font-size capitalize\">job type</label>";
    $output .= "<select name=\"job_type\" class=\"form-control capitalize\">";

    foreach($jobType as $type) {  
        if($type->type == $desiredJob->job_type) { 
            $output .= "<option value=\""; 
            $output .=  $type->type; 
            $output .= "\" selected>"; 
            $output .=  $type->type; 
            $output .= "</option>";

        } else { 
            $output .= "<option value=\""; 
            $output .=  $type->type; 
            $output .= "\">"; 
            $output .=  $type->type; 
            $output .= "</option>";
        }
    }

    $output .= "</select></div></div>";
    $output .= "<div class=\"col-sm-6 m-light-bottom-breather\">";
    $output .= "<div class=\"form-group\">";
    $output .= "<label class=\"txt-bold small-font-size capitalize\">preferred salary</label>";
    $output .= "<select name=\"salary_range\" class=\"form-control capitalize\">";

    foreach($salaryRange as $range) {
        if($range->salary_range == $desiredJob->salary_range) { 
            $output .= "<option value=\""; 
            $output .=  $range->salary_range; 
            $output .= "\" selected>"; 
            $output .=  formatSalaryRange($range->salary_range); 
            $output .= "</option>";

        } else { 
            $output .= "<option value=\""; 
            $output .=  $range->salary_range; 
            $output .= "\">"; 
            $output .=  formatSalaryRange($range->salary_range); 
            $output .= "</option>";

        }
    }
    $output .= "</select></div>";

    $output .= "<div class=\"form-group\">";
    $output .= "<label class=\"txt-bold small-font-size capitalize\">desired job location</label>";
    $output .= "<select name=\"location\" id=\"\" class=\"form-control\">";
    $output .= "<option>desired job location</option>";

    foreach($states as $state) { 
        if($state->name == $desiredJob->location) { 
            $output .= "<option value=\""; 
            $output .=  $state->name; 
            $output .= "\" selected>"; 
            $output .=  $state->name; 
            $output .= "</option>";
        } else {  
            $output .= "<option value=\""; 
            $output .=  $state->name; 
            $output .= "\">"; 
            $output .=  $state->name; 
            $output .= "</option>";
        }
    }
    $output .= "</select></div></div><div class=\"sm-container m-vlight-breather\">";
    $output .= "<div class=\"row\">";
    $output .= "<div class=\"col-sm-8\">";
    $output .= "<input type=\"submit\" value=\"Confirm Changes\" name=\"submit\" class=\"form-control btn sec-btn capitalize\"></div>";
    $output .= " <div class=\"col-sm-4\">";
    $output .= "<a href=\"my-profile.php\" class=\"form-control capitalize btn main-btn\">cancel</a>";
    $output .= "</div></div></div></div></form>";

    return $output;
}

function eduForm($schools = null, $newEntry = false) {
    $n = 0;
    $output = "";

    if(!$newEntry) { 

        foreach($schools as $school) { 
            $output .= "<form method=\"post\" action=\"../control/candidate/profile.php\" class=\"sm p-light-bottom-breather\">";
            $output .= "<input type=\"hidden\" value=\"edu\" name=\"update_type\">";
            $output .= "<div class=\"row\">";
            $output .= "<p class=\"uppercase txt-bold text-center\">Entry: <span class=\"secbrandtxt-color\">";
            $output .= ++$n;
            $output .= "</span></p>";
            $output .= "<div class=\"col-sm-6\">";
            $output .= "<div class=\"form-group\">";
            $output .= "<label class=\"txt-bold small-font-size capitalize\">course</label>";
            $output .= "<input type=\"text\" class=\"form-control\" value=\"";

            if(isset($school->course)) {
                $output .= $school->course; 
            } else { 
                $output .= ""; 
            } 

            $output .= "\" name=\"course\" placeholder=\"enter your course title\"></div>";
            $output .= "<div class=\"form-group\">";
            $output .= "<label class=\"txt-bold small-font-size capitalize\">degree</label>";
            $output .= "<input type=\"text\" class=\"form-control\" value=\"";

            if(isset($school->degree)) {
                $output  .= $school->degree; 
            } else {
                $output  .= ""; 
            } 

            $output .= "\" name=\"degree\" placeholder=\"enter your degree\"></div>";
            $output .= "<div class=\"form-group\">";
            $output .= "<label class=\"txt-bold small-font-size capitalize\">school</label>";
            $output .= "<input type=\"text\" class=\"form-control\" value=\"";

            if(isset($school->school)) {
                $output  .= $school->school; 
            } else {
                $output  .= ""; 
            } 

            $output .= "\" name=\"school\" placeholder=\"enter your school\"> </div></div>";
            $output .= "<div class=\"col-sm-6\">";
            $output .= "<div class=\"form-group\">";
            $output .= "<label class=\"txt-bold small-font-size capitalize\"> location</label>";
            $output .= "<input type=\"text\" class=\"form-control\" value=\"";

            if(isset($school->location)) {
                $output  .= $school->location; 
            } else {
                $output  .= ""; 
            } 

            $output .= "\" name=\"location\" placeholder=\"example: Nigeria\"></div>";
            $output .= "<div class=\"form-group\">";
            $output .= "<label class=\"txt-bold small-font-size capitalize\">grade</label>";
            $output .= "<input type=\"text\" class=\"form-control\" value=\"";

            if(isset($school->grade)) {
                $output  .= $school->grade; 
            } else {
                $output  .= ""; 
            } 

            $output .= "\" name=\"grade\" placeholder=\"example: 2nd Class Upper(2.1)\"></div>";
            $output .= "<div class=\"form-group\">";
            $output .= "<label class=\"txt-bold small-font-size capitalize\">year</label>";
            $output  .= inputYear("year", $school->year);
            $output .= "</div></div></div>";
            $output .= "<div class=\"m-vlight-breather\">";
            $output .= "<div class=\"row\">";
            $output .= "<div class=\"col-sm-8\">";
            $output .= "<input type=\"submit\" value=\"Update entry\" name=\"submit\" class=\"form-control btn sec-btn capitalize\"></div>";
            $output .= "<div class=\"col-sm-4\">";
            $output .= "<a href=\"del.php?id=";
            $output  .= $school->id;
            $output .= "\" class=\"form-control capitalize btn main-btn\">delete entry</a>";
            $output .= "</div></div></div></form>";
        }

        $output .= "<hr><div class=\"m-light-breather\">";
        $output .= "<a href=\"?type=education&action=add\" class=\"form-control btn main-btn capitalize\">+ add a new entry</a></div>";

    } else {

        $output .= "<form method=\"post\" action=\"../control/candidate/profile.php\" class=\"sm p-light-bottom-breather\">";
        $output .= "<input type=\"hidden\" value=\"edu\" name=\"update_type\">";
        $output .= "<input type=\"hidden\" value=\"add\" name=\"action\">";
        $output .= "<div class=\"row\">";

        // 1st col
        $output .= "<div class=\"col-sm-6\">";

        // input: course
        $output .= "<div class=\"form-group\">";
        $output .= "<label class=\"txt-bold small-font-size capitalize\">course</label>";
        $output .= "<input type=\"text\" class=\"form-control\" value=\"";
        $output .= "\" name=\"course\" placeholder=\"enter the course title\"></div>";

        // input: degree
        $output .= "<div class=\"form-group\">";
        $output .= "<label class=\"txt-bold small-font-size capitalize\">degree</label>";
        $output .= "<input type=\"text\" class=\"form-control\" value=\"";
        $output .= "\" name=\"degree\" placeholder=\"enter your degree\"></div>";

        // input: school
        $output .= "<div class=\"form-group\">";
        $output .= "<label class=\"txt-bold small-font-size capitalize\">school</label>";
        $output .= "<input type=\"text\" class=\"form-control\" value=\"";
        $output .= "\" name=\"school\" placeholder=\"enter the school\"> </div>";
        
        // end 1st col
        $output .= "</div>";
        
        // 2nd col
        $output .= "<div class=\"col-sm-6\">";
        
        // input: location
        $output .= "<div class=\"form-group\">";
        $output .= "<label class=\"txt-bold small-font-size capitalize\"> location</label>";
        $output .= "<input type=\"text\" class=\"form-control\" value=\""; 
        $output .= "\" name=\"location\" placeholder=\"example: Nigeria\"></div>";
        
        // input: grade
        $output .= "<div class=\"form-group\">";
        $output .= "<label class=\"txt-bold small-font-size capitalize\">grade</label>";
        $output .= "<input type=\"text\" class=\"form-control\" value=\""; 
        $output .= "\" name=\"grade\" placeholder=\"example: 2nd Class Upper(2.1)\"></div>";
        
        // input: year
        $output .= "<div class=\"form-group\">";
        $output .= "<label class=\"txt-bold small-font-size capitalize\">year</label>";
        $output  .= inputYear("year");
        $output .= "</div>";
        
        // end 2nd col
        $output .= "</div>";
        
        // end row
        $output .= "</div>";
        
        // submit & cancel buttons
        $output .= "<div class=\"m-vlight-breather\">";
        $output .= "<div class=\"row\">";
        
        // submit btn
        $output .= "<div class=\"col-sm-8\">";
        $output .= "<input type=\"submit\" value=\"Add entry\" name=\"submit\" class=\"form-control btn sec-btn capitalize\"></div>";
        
        // cancel btn
        $output .= "<div class=\"col-sm-4\">";
        $output .= "<a href=\"my-profile.php\"";
        $output .= "class=\"form-control capitalize btn main-btn\">cancel</a>";
        
        // end form
        $output .= "</div></div></div></form>";
    }


    return $output;
}

function skillForm($skills = null) {
    $n = 0;
    $output = "";
    foreach($skills as $skill){
        $output .= "<form method=\"post\" action=\"\" class=\"sm p-light-bottom-breather\">";
        $output .= "<p class=\"uppercase txt-bold text-center\">Entry: <span class=\"secbrandtxt-color\">"; 
        $output .=  ++$n; 
        $output .= "</span></p><div class=\"form-group\">";
        $output .= "<label>Skill: </label>";
        $output .= "<input class=\"form-control\" type=\"text\" name=\"skill_name\" value=\""; 
        if(isset($skill->skill_name)) {
            $output .=  $skill->skill_name;
        } else {
            $output .=  ""; 
        } 
        $output .= "\" placeholder=\"Enter a skill name\">";
        $output .= "</div><div class=\"row\">";
        $output .= "<div class=\"col-sm-6\">";
        $output .= "<div class=\"form-group\">";
        $output .= "<input type=\"submit\" value=\"Update entry\" name=\"submit\" class=\"form-control btn sec-btn capitalize\">";
        $output .= "</div></div><div class=\"col-sm-6\">";
        $output .= "<div class=\"form-group\">";
        $output .= "<a href=\"del.php?id="; 
        $output .=  $skill->id; 
        $output .= "\" class=\"form-control btn main-btn capitalize\">delete entry</a>";
        $output .= "</div></div></div></form>";
    }

    $output .= "<hr><div class=\"m-light-breather\">";
    $output .= "<a href=\"?type=skills&action=add\" class=\"form-control btn main-btn capitalize\">+ add a new entry</a></div>";

    return $output;
}

function memForm($memberships = null) {
    $n = 0;
    $output = "";
    foreach($memberships as $membership) {  
        $output .= "<form method=\"post\" action=\"\" class=\"sm p-light-bottom-breather\">";
        $output .= "<p class=\"uppercase txt-bold text-center\">Entry: <span class=\"secbrandtxt-color\">"; 
        $output .=  ++$n; 
        $output .= "</span></p><div class=\"row\">";
        $output .= "<div class=\"col-sm-6\">";
        $output .= "<div class=\"form-group\">";
        $output .= "<label>Organization: </label>";
        $output .= "<input class=\"form-control\" type=\"text\" name=\"organization\" value=\""; 
        if(isset($membership->organization)) {
            $output .=  $membership->organization;
        } else {$output .=  ""; 
               } 
        $output .= "\" placeholder=\"Enter the organization of your membership\">";
        $output .= "</div></div><div class=\"col-sm-6\">";
        $output .= "<div class=\"form-group\">";
        $output .= "<label class=\"txt-bold small-font-size capitalize\">year</label>";
        $output .=  inputYear("year", $membership->year); 

        $output .= "</div></div></div>";

        $output .= "<div class=\"m-vlight-breather\">";
        $output .= "<div class=\"row\">";
        $output .= "<div class=\"col-sm-8\">";
        $output .= "<input type=\"submit\" value=\"Update entry\" name=\"submit\" class=\"form-control btn sec-btn capitalize\"></div>";
        $output .= "<div class=\"col-sm-4\">";
        $output .= "<a href=\"del.php?id= $output .=  $membership->id; \" class=\"form-control capitalize btn main-btn\">delete entry</a>";
        $output .= "</div></div></div></form>";
    }

    $output .= "<hr><div class=\"m-light-breather\">";
    $output .= "<a href=\"?type=skills&action=add\" class=\"form-control btn main-btn capitalize\">+ add a new entry</a></div>";

    return $output; 
}

function EHForm($employmentHistory = null) {
    $n = 0; 
    $output = "";
    foreach($employmentHistory as $item) { 
        $output .= "<form method=\"post\" action=\"\" class=\"sm p-light-bottom-breather\">";
        $output .= "<p class=\"uppercase txt-bold text-center\">Entry: <span class=\"secbrandtxt-color\"> $output .=  ++$n; </span></p>";
        $output .= "<div class=\"row\"><div class=\"col-sm-6\">";
        $output .= "<div class=\"form-group\">";
        $output .= "<label class=\"txt-bold small-font-size capitalize\">Job title </label>";
        $output .= "<input class=\"form-control\" type=\"text\" name=\"job_title\" value=\""; 

        if(isset($item->job_title)) {
            $output .=  $item->job_title;
        } else {
            $output .= ""; 
        }

        $output .= "\" placeholder=\"Enter your job position\"></div>";
        $output .= "<div class=\"form-group\">";
        $output .= "<label class=\"txt-bold small-font-size capitalize\">employer </label>";
        $output .= "<input class=\"form-control\" type=\"text\" name=\"employer\" value=\"";

        if(isset($item->employer)) {
            $output .=  $item->employer;
        } else {
            $output .=  ""; 
        }

        $output .= "\" placeholder=\"Enter the name of your employer\"></div>";
        $output .= "<div class=\"form-group\">";
        $output .= "<label class=\"txt-bold small-font-size capitalize\">time in organization </label>";
        $output .= "<input class=\"form-control\" type=\"text\" name=\"organization\" value=\""; 

        if(isset($item->time_span)) {
            $output .=  $item->time_span;
        } else {
            $output .=  ""; 
        } 

        $output .= "\" placeholder=\"Example: 2012 - 2014\"></div>";
        $output .= "</div><div class=\"col-sm-6\">";
        $output .= "<div class=\"form-group\">";
        $output .= "<label class=\"txt-bold small-font-size capitalize\">responsibilities</label>";
        $output .= "<textarea name=\"responsibilities\" class=\"form-control\" rows=\"10\">";  

        if(isset($item->responsibilities)) {
            $output .=  $item->responsibilities;
        } else { 
            $output .=  "Describe your responsibilites in the organization"; 
        }

        $output .= "</textarea></div></div></div>";
        $output .= "<div class=\"m-vlight-breather\">";
        $output .= "<div class=\"row\">";
        $output .= "<div class=\"col-sm-8\">";
        $output .= "<input type=\"submit\" value=\"Update entry\" name=\"submit\" class=\"form-control btn sec-btn capitalize\"></div>";
        $output .= "<div class=\"col-sm-4\">";
        $output .= "<a href=\"del.php?id="; 
        $output .=  $membership->id; 
        $output .= "\" class=\"form-control capitalize btn main-btn\">delete entry</a>";
        $output .= "</div></div></div></form>";
    }

    $output .= "<hr><div class=\"m-light-breather\">";
    $output .= "<a href=\"?type=skills&action=add\" class=\"form-control btn main-btn capitalize\">+ add a new entry</a></div>";

    return $output;
}

function intForm($interests = null) {
    $output = "";
    foreach($interests as $interest) {  
        $output .= "<form method=\"post\" action=\"\" class=\"sm p-light-bottom-breather\">";
        $output .= "<div class=\"form-group\">";
        $output .= "<label class=\"txt-bold small-font-size capitalize\">interests</label>";
        $output .= "<textarea name=\"responsibilities\" class=\"form-control\" rows=\"5\">";  

        if(isset($interest->interest)) {
            $output .=  $interest->interest;
        } else { 
            $output .=  "Describe your responsibilites in the organization"; 
        } 

        $output .= "</textarea></div>";
        $output .= "<div class=\"m-vlight-breather\">";
        $output .= "<div class=\"row\">";
        $output .= "<div class=\"col-sm-8\">";
        $output .= "<input type=\"submit\" value=\"Update entry\" name=\"submit\" class=\"form-control btn sec-btn capitalize\">";
        $output .= "</div><div class=\"col-sm-4\">";
        $output .= "<a href=\"my-profile.php\" class=\"form-control capitalize btn main-btn\">cancel</a>";
        $output .= "</div></div></div></form>";
    }

    return $output;


}

function openDiv($attr= null) {
    $output = "<div " . $attr . ">";

    return $output;
}

function closeDiv($n = 1) {
    $output = "";

    for($i=0; $i=$n; $i++) {
        $output .= "</div>";
    }

    return $output;
}

function trimContent($content, $count = 10) { // count is the number of words required before content is trimmed
    preg_match("/(?:[^\s,\.;\?\!]+(?:[\s,\.;\?\!]+|$)){0,$count}/", $content, $matches);
    return $matches[0];
}

function topJobSearch($states, $seperator=null) {

    $output  = "<div class=\"container\">";
    $output .= "<div class=\"white-bg p-mid-breather lg-br\">";
    $output .= "<div class=\"mid-container \">";
    $output .= "<form class=\"\" action=\"{$seperator}/job/search.php\" method=\"get\">";
    $output .= "<div class=\"row\">";
    $output .= "<div class=\"col-sm-5\">";
    $output .= "<input type=\"text\" name=\"keyword\" class=\"form-control\" placeholder=\"job title, skills or company\">";
    $output .= "</div>";
    $output .= "<div class=\"col-sm-5\">";
    $output .= "<select class=\"form-control\" name=\"location\">";
    foreach($states as $state){  
        $output .= "<option value=\"" . $state->name . "\">" . $state->name . "</option>";
    }
    $output .= "</select>";
    $output .= "</div>";
    $output .= "<div class=\"col-sm-2\">";
    $output .= "<input type=\"submit\" class=\"btn main-btn form-control\" name=\"submit\" value=\"find jobs\">";
    $output .= "</div></div></form></div></div></div>";

    return $output;
}

function sideSearch($states, $seperator=null) {

    $output  = "<div class=\"light-bx-shadow m-mid-bottom-breather\">";
    $output .= "<div class=\"p-vlight-breather sec-bg p-mid-side-breather\">";
    $output .= "<p class=\"headfont uppercase no-margin text-center\">browse jobs</p>";
    $output .= "</div>";
    $output .= "<div class=\"p-mid-side-breather p-light-breather\">";
    $output .= "<form method=\"get\" action=\"{$seperator}/job/search.php\">";
    $output .= "<div class=\"form-group\">";
    $output .= "<input type=\"text\" name=\"keyword\" class=\"form-control\" placeholder=\"job title, skills or company\">";
    $output .= "</div>";
    $output .= "<div class=\"form-group\">";
    $output .= "<select class=\"form-control\" name=\"location\">";
    $output .= "<option>location</option>";
    foreach($states as $state){  
        $output .= "<option value=\"" . $state->name . "\">" . $state->name . "</option>";
    }
    $output .= "</select>";
    $output .= "</div>";
    $output .= "<div class=\"form-group\">";
    $output .= "<input type=\"submit\" value=\"find jobs\" class=\"form-control btn sec-btn uppercase\">";
    $output .= "</div>";
    $output .= "</form>";
    $output .= "</div>";
    $output .= "</div>"; 

    return $output;
}

function maxCVSize() {
    // IMB = 1048576
    $file_size = 1048576 * 0.5;
    return $file_size;
}

function maxFileSize() {
    // IMB = 1048576
    $file_size = 1048576 * 1.5;
    return $file_size;
}

function cvFormat($type) { 
    if($type == "application/pdf" ||
       $type == "application/msword" ||
       $type == "application/vnd.openxmlformats-officedocument.wordprocessingml.document" ||
       $type == "application/vnd.openxmlformats-officedocument.wordprocessingml.template" ||
       $type == "application/vnd.ms-word.document.macroEnabled.12" ||
       $type == "application/vnd.ms-word.template.macroEnabled.12" )    
    { return true; } 

    else { return false; }
}

function filePath($dir=NULL, $filename) {

    return $dir . "/" . $filename;
}

function inputYear($inputName, $selectedYear = null) {
    $output = "<select name=\"{$inputName}\" class=\"form-control\">";

    for($i = 1900; $i<=2017; $i++) { 
        if(!empty($selectedYear) && $selectedYear == $i) {
            $output .= "<option value=\"{$i}\" selected>{$i}</option>";
        } else { 
            $output .= "<option value=\"{$i}\">{$i}</option>"; 
        }
    }

    $output .= "</select>";

    return $output;
}

function formatSalaryRange($range) {
    return str_replace("#", "&#x20A6;", $range);
}
// EMPLOYER FUNCTIONS

function jobPosted($jobsPosted) {
    $i = 0;
    $currentTime = strtotime("now"); // convert current time to unix timestamp
    
    $output  = "";
    $output  = "<div class=\"table-responsive\"><table><tbody>";

    // table head
    $output .= "<tr class=\"capitalize\">";
    $output .= "<td>S/N</td>";
    $output .= "<td>job title</td>";
    $output .= "<td>current status</td>";
    $output .= "<td>action</td>";
    $output .= "</tr>";

    // table data
    foreach($jobsPosted as $job) {
        $i++;
        $deadline = strtotime($job->deadline); // convert deadline to unix timestamp      

        $output .= "<tr>";

        // serial number
        $output .= "<td>" . $i . "</td>";

        // job title
        $output .= "<td class=\"capitalize\"><a href=\"\">";
        $output .= $job->title . "</a></td>";

        // current status
        if ($currentTime <= $deadline) {
            $output .= "<td class=\"capitalize\"> live </td>"; 
        } else {
            $output .= "<td class=\"capitalize\"> expired </td>"; 

        }
        
        // action
        $output .= "<td class=\"small-font-size\"> <a href=\"\">edit</a><br>";
        $output .= "<a href=\"\">delete</a></td>";

    }
    $output .= "</tbody></table></div>";
    
    return $output;
}
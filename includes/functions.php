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
        $output = "<p style=\"color:red\" class=\"capitalize\">{$session->message}</p>";

        return $output;

    } else {
        return "";
    }
}

function inline_errors() {
    global $session;
    $output  = "";

    if(!empty($session->errors)) {
        $output .= "<div class=\"errors\">";
        $output .= "<ul>";
        foreach($session->errors as $value) {
            $output.= "<li>" . $value . "</li>";
        }
        $output .= "</ul></div>";
    } else {
        $output  = "";
    }

    return $output;
}

function includeLayoutTemplate($template="") {
    include(SITE_ROOT.DS.'layouts'.DS.$template);
}

function passwordEncrypt($password) {
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

function break2NewLine($text) {

    $text = str_replace("<br />", "\n", $text);

    return $text;
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

// CANDIDATE VIEW FUNCTIONS
function candidateSidebar($user) {
    global $states;

    $output = "";

    //about me 
    $output .= "<div class=\"light-bx-shadow m-mid-bottom-breather\">";
    $output .= "<div class=\"p-vlight-breather sec-bg p-mid-side-breather\">";
    $output .= "<p class=\"headfont uppercase no-margin text-center\">about me</p></div>";
    $output .= "<div class=\"p-mid-side-breather p-light-breather\">";

    $output .= "<div class=\"row m-mid-bottom-breather\">";

    $output .= "<div class=\"col-sm-4 bioimage\">";
    $output .= "<img class=\"img-center img-circle img-responsive\" src=\"../img/candidate-placeholder.jpg\" alt=\"\">";
    $output .= "</div>";

    $output .= "<div class=\"col-sm-8 bio-details\">";
    $output .= "<p class=\"headfont lead no-margin\">";
    $output .= $user->fullName() . "</p>"; 

    $output .= "<p class=\"mid-font-size\">";
    $output .= $user->email . "</p>"; 

    $output .= "<p class=\"mid-font-size no-margin\"><span class=\"txt-bold\">Mobile:</span>";
    $output .= $user->phone . "</p>"; 

    $output .= "<p class=\"mid-font-size\"><span class=\"txt-bold\">D.O.B: </span>";
    $output .= $user->dob ."</p>"; 

    $output .= "</div></div>";

    // progress-bar
    $output .= "<p class=\"no-margin small-font-size secheadfont capitalize\">profile strength: ";
    $output .= profileBar($user) . "%";
    $output .= "</p>";
    $output .= "<progress max=\"100\" value=\"";
    $output .= profileBar($user);
    $output .= "\" class=\" m-vlight-bottom-breather\">";

    // Browsers that support HTML5 progress element will ignore the html inside `progress` element. 
    // Whereas older browsers will ignore the `progress` element and instead render the html inside it.
    $output .= "<div class=\"progress-bar\">";
    $output .= "<span style=\"width:";
    $output .= profileBar($user);
    $output .= " ; height: inherit;\"></span> </div>";
    $output .= "</progress>";
    // end .progress-bar

    $output .= "</div></div>";

    // sidebar form
    $output .= "<div class=\"light-bx-shadow m-mid-bottom-breather\">";

    $output .= sideSearch($states) ."</div>"; 

    // shortlisted jobs
    /* 
    $output .= "<div class=\"light-bx-shadow m-mid-bottom-breather\">";
    $output .= "<div class=\"p-vlight-breather sec-bg p-mid-side-breather\">";
    $output .= "<p class=\"headfont uppercase no-margin text-center\">shortlisted jobs</p>";
    $output .= "</div>";
    $output .= "<div class=\"p-mid-side-breather p-light-breather\">";
    $output .= "<p class=\"\">You haven't shortlisted any jobs</p>";
    $output .= "</div></div>"; */

    // applied jobs
    $output .= "<div class=\"light-bx-shadow m-mid-bottom-breather\">";
    $output .= "<div class=\"p-vlight-breather sec-bg p-mid-side-breather\">";
    $output .= "<p class=\"headfont uppercase no-margin text-center\">applied jobs</p>";
    $output .= "</div>";
    $output .= "<div class=\"p-mid-side-breather p-light-breather\">";
    $output .= "<p class=\"\">You haven't applied for any job</p>";
    $output .= "</div></div>";

    return $output;
}

function sideSearch($states) {
    global $states;

    $output  = "<div class=\"light-bx-shadow m-mid-bottom-breather\">";
    $output .= "<div class=\"p-vlight-breather sec-bg p-mid-side-breather\">";
    $output .= "<p class=\"headfont uppercase no-margin text-center\">browse jobs</p>";
    $output .= "</div>";
    $output .= "<div class=\"p-mid-side-breather p-light-breather\">";
    $output .= "<form method=\"get\" action=\"job-search.php\">";
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

function jobSearchFilter() {
    global $jobExperience;
    global $salaryRange;
    global $jobType;
    global $states;

    $output  = "<div class=\"light-bx-shadow m-mid-bottom-breather\">";
    $output .= "<div class=\"p-vlight-breather sec-bg p-mid-side-breather\">";
    $output .= "<p class=\"headfont uppercase no-margin text-center\">filter search results</p>";
    $output .= "</div>";

    $output .= "<div class=\"p-mid-side-breather p-light-breather\">";
    $output .= "<div class=\"panel-group capitalize\" id=\"accordion\">";
    $output .= "<form id='search_filter' method=\"post\" action=\"#\">";

    // experience 
    $output .= "<div class=\"panel panel-default\">";
    $output .= "<div class=\"panel-heading\" data-toggle=\"collapse\" data-parent=\"#accordion\" data-target=\"#accordion-1\">";
    $output .= "<p class=\"panel-title\">";
    $output .= "<span class=\"glyphicon glyphicon-chevron-down pull-right\"></span>";
    $output .= "<a class=\"accordion-toggle\">Experience</a>";
    $output .= "</p></div>";
    $output .= "<div id=\"accordion-1\" class=\"panel-collapse collapse\">";

    $output .= "<div class=\"panel-body\">";
    foreach($jobExperience as $exp) { 
        $output .= "<div class=\"p-mid-side-breather\">";
        $output .= "<label class=\"radio\">";
        $output .= "<input type=\"radio\" name=\"job_experience\" id=\"\" value=\""; 
        $output .= $exp->years; 
        $output .= "\">";
        $output .= $exp->years; 
        if($exp->id != 1) { 
            $output .= " years"; 
        } 
        $output .= "</label></div>";
    } 
    $output .= "</div></div></div>";

    //  salary range 
    $output .= "<div class=\"panel panel-default\">";
    $output .= "<div class=\"panel-heading\" data-toggle=\"collapse\" data-parent=\"#accordion\" data-target=\"#accordion-3\">";
    $output .= "<p class=\"panel-title\">";
    $output .= "<span class=\"glyphicon glyphicon-chevron-down pull-right\"></span>";
    $output .= "<a class=\"accordion-toggle\">salary range</a>";
    $output .= "</p></div>";
    $output .= "<div id=\"accordion-3\" class=\"panel-collapse collapse\">";
    $output .= "<div class=\"panel-body\">";
    foreach($salaryRange as $range){ 
        $output .= "<div class=\"p-mid-side-breather\">";
        $output .= "<label class=\"radio\">";
        $output .= "<input type=\"radio\" name=\"salary_range\" value=\"";
        $output .= $range->salary_range; 
        $output .= "\">";
        $output .= formatSalaryRange($range->salary_range); 
        $output .= "</label></div>";
    }
    $output .= "</div></div></div>";

    // work type 
    $output .= "<div class=\"panel panel-default\">";
    $output .= "<div class=\"panel-heading\" data-toggle=\"collapse\" data-parent=\"#accordion\" data-target=\"#accordion-4\">";
    $output .= "<p class=\"panel-title\">";
    $output .= "<span class=\"glyphicon glyphicon-chevron-down pull-right\"></span>";
    $output .= "<a class=\"accordion-toggle\">work type</a>";
    $output .= "</p></div>";
    $output .= "<div id=\"accordion-4\" class=\"panel-collapse collapse\">";
    $output .= "<div class=\"panel-body\">";
    foreach($jobType as $type){ 
        $output .= "<div class=\"p-mid-side-breather\">";
        $output .= "<label class=\"radio\">";
        $output .= "<input type=\"radio\" name=\"job_type\" value=\""; 
        $output .= $type->type; 
        $output .= "\">";
        $output .= $type->type;  
        $output .= "</label></div>";
    } 

    $output .= "</div></div></div>";

    // location 
    $output .= "<div class=\"panel panel-default\">";
    $output .= "<div class=\"panel-heading\" data-toggle=\"collapse\" data-parent=\"#accordion\" data-target=\"#accordion-5\">";
    $output .= "<p class=\"panel-title\">";
    $output .= "<span class=\"glyphicon glyphicon-chevron-down pull-right\"></span>";
    $output .= "<a class=\"accordion-toggle\">location</a>";
    $output .= "</p></div>";
    $output .= "<div id=\"accordion-5\" class=\"panel-collapse collapse\">";
    $output .= "<div class=\"panel-body\">";
    $output .= "<div class=\"\" id=\"top-states\">";
    $output .= "<div class=\"p-mid-side-breather\">";
    $output .= "<label class=\"radio\">";
    $output .= "<input type=\"radio\" name=\"location\" value=\"\">";
    $output .= "</label></div></div>";

    $i=0; foreach($states as $state) { 
        $output .= "<div class=\"p-mid-side-breather\">";
        $output .= "<label class=\"radio\">";
        $output .= "<input type=\"radio\" name=\"location\" id=\"\" value=\""; 
        $output .= $state->name; 
        $output .= "\">";
        $output .= $state->name; $i++; 
        $output .= "</label></div>";
    }
    $output .= "</div></div></div>";
    $output .= "<input type=\"submit\" name=\"submit\" value=\"filter\" class=\"btn sec-btn form-control uppercase\">";
    $output .= "</form></div></div></div>";

    return $output;
}

function topJobSearch($states) {

    $output  = "<div class=\"container\">";
    $output .= "<div class=\"white-bg p-mid-breather lg-br\">";
    $output .= "<div class=\"mid-container \">";
    $output .= "<form class=\"\" action=\"job-search.php\" method=\"get\">";
    $output .= "<div class=\"row\">";
    $output .= "<div class=\"col-sm-5\">";
    $output .= "<input type=\"text\" name=\"keyword\" class=\"form-control capitalize\" placeholder=\"job title, skills or company\">";
    $output .= "</div>";
    $output .= "<div class=\"col-sm-5\">";
    $output .= "<select class=\"form-control\" name=\"location\">";
    foreach($states as $state){  
        $output .= "<option value=\"" . $state->name . "\">" . $state->name . "</option>";
    }
    $output .= "</select>";
    $output .= "</div>";
    $output .= "<div class=\"col-sm-2\">";
    $output .= "<input type=\"submit\" class=\"btn main-btn capitalize form-control\" name=\"submit\" value=\"find jobs\">";
    $output .= "</div></div></form></div></div></div>";

    return $output;
}

function profileBar($user) {
    $bar = 0;
    $schools = School::findAllUnderParent($user->id, "user_id");
    $skills  = Skills::findAllUnderParent($user->id, "user_id");
    $members = Membership::findAllUnderParent($user->id, "user_id");
    $employments  = EmploymentHistory::findAllUnderParent($user->id, "user_id");
    $desiredJob   = DesiredJob::findAllUnderParent($user->id, "user_id");  

    // check for CV/Resume
    if(isset($user->cv_path)) {
        $bar += 20;
    }

    // check for profile picture
    if(isset($user->avatar_url)) {
        $bar += 10;
    }

    // check for personal statement
    if(isset($user->personal_statement)) {
        $bar += 10;
    }

    // check for education
    if(count($schools) == 1) {
        $bar += 10;
    } elseif(count($schools) > 1) {
        $bar += 15;
    }

    // check for professional skills
    if(count($skills) >= 1) {
        $bar += 10;
    }

    // check for professional memberships
    if(count($members) >= 1) {
        $bar += 10;
    }

    // check for employment history
    if(count($employments) >= 1) {
        $bar += 10;
    }

    // check for desired job section
    if(count($desiredJob) >= 1) {
        $bar += 5;
    }

    return $bar;

}

function pDForm($candidate = null) {
    global $states; 

    if(isset($candidate->dob)) { 
        $dobArray = explode('/', $candidate->dob);
        $dob_d = $dobArray[0];
        $dob_m = $dobArray[1];
        $dob_y = $dobArray[2];
    }
    $output = "<form action=\"../control/candidate/profile.php\" method=\"post\" id=\"pd-form\" class=\"sm\">";
    $output .= "<input type=\"hidden\" value=\"pd\" name=\"update_type\">";
    $output .= "<p class=\"capitalize small-font-size txt-bold\">fill in the details</p>";
    $output .= "<div class=\"row\">";

    // first column
    $output .= "<div class=\"col-sm-6\">";

    // input: EMAIL
    $output .= "<div class=\"form-group\">";
    $output .= "<label class=\"txt-bold small-font-size capitalize\">email</label>";
    $output .= "<input type=\"text\" class=\"form-control\" value=\"{$candidate->email}\" name=\"email\" placeholder=\"your email\"></div>";

    // input: PHONE
    $output .= "<div class=\"form-group\">";
    $output .= "<label class=\"txt-bold small-font-size capitalize\">phone</label>";
    $output .= "<input type=\"tel\" class=\"form-control\" name=\"phone\" value=\"{$candidate->phone}\" placeholder=\"your phone number\"></div>";

    // input: LOCATION
    $output .= "<div class=\"form-group\">";
    $output .= "<label class=\"txt-bold small-font-size capitalize\">Choose your location </label>";
    $output .= "<select class=\"form-control\" id=\"location\" name=\"location\">";

    foreach($states as $state) {
        $output .= "<option value=\"";
        $output .= $state->name . "\""; 
        if($state == $candidate->location) {
            $output .= " selected>"; 
        } else {
            $output .= " >";
        }

        $output .= $state->name . "</option>";
    }
    $output .= "</select></div>";

    // input: DOB
    $output .= "<div class=\"form-group\">";
    $output .= "<label class=\"txt-bold small-font-size capitalize\">Date of Birth</label>";
    $output .= "<div class=\"row\">";

    // day
    $output .= "<div class=\"col-sm-4\">";
    $output .= "<select name=\"dob_d\" class=\"form-control\" id=\"dob_d\">";
    $output .= "<option>DD</option>";

    for($i = 1; $i<=31; $i++) {
        if($i<=9) { 
            if(!empty($dob_d) && $dob_d == $i) {
                $output .= "<option value= \"{$i}\" selected>0{$i}</option>";
            } else { 
                $output .= "<option value= \"{$i}\">0{$i}</option>";
            }
        } else {
            if(!empty($dob_d) && $dob_d == $i) {
                $output .= "<option value= \"{$i}\" selected>{$i}</option>";
            } else { 
                $output .= "<option value= \"{$i}\">{$i}</option>"; 
            }
        }
    } 

    $output .= "</select></div>";

    // month
    $output .= "<div class=\"col-sm-4\">";
    $output .= "<select name=\"dob_m\" class=\"form-control\" id=\"dob_m\">";
    $output .= "<option>MM</option>";

    for($i = 1; $i<=12; $i++) {
        if($i<=9) {
            if(!empty($dob_m) && $dob_m == $i) {
                $output .= "<option value= \"{$i}\" selected>0{$i}</option>";
            } else { 
                $output .= "<option value= \"{$i}\">0{$i}</option>"; 
            }
        } else {

            if(!empty($dob_m) && $dob_m == $i) {
                $output .= "<option value= \"{$i}\" selected>{$i}</option>";
            } else { 
                $output .= "<option value= \"{$i}\">{$i}</option>"; 
            }
        }

    } 

    $output .= "</select></div>";

    // year
    $output .= "<div class=\"col-sm-4\">";
    $output .= "<select name=\"dob_y\" class=\"form-control\" id=\"dob_y\">";
    $output .= "<option>YYYY</option>";
    for($i = 1900; $i<=2017; $i++) {
        if(!empty($dob_y) && $dob_y == $i) {
            $output .= "<option value= \"{$i}\" selected>{$i}</option>";
        } else { 
            $output .= "<option value= \"{$i}\">{$i}</option>"; 
        }
    }                                 
    $output .= "</select></div></div></div>";

    // input: GENDER
    $output .= "<div class=\"form-group\">";
    $output .= "<label class=\"txt-bold small-font-size capitalize\">Gender</label>";
    $output .= "<select name=\"gender\" class=\"form-control\">";

    if($candidate->gender == "M") {
        $output .= "<option value=\"M\" selected>Male</option>";   
    } else {
        $output .= "<option value=\"M\">Male</option>";        
    }

    if($candidate->gender == "F") {
        $output .= "<option value=\"F\" selected>Female</option>";   
    } else {
        $output .= "<option value=\"F\">Female</option>";        
    }
    $output .= "</select></div></div>";

    // second column
    $output .= "<div class=\"col-sm-6\">";

    // input: PERSONAL STATEMENT
    $output .= "<div class=\"form-group\">";
    $output .= "<label class=\"txt-bold small-font-size capitalize\">personal statement</label>";
    $output .= "<textarea class=\"form-control\" name=\"personal_statement\" rows=\"7\">";
    if(!empty($candidate->personal_statement)) {
        $output .= $candidate->personal_statement;
    } else {
        $output .= "Enter your personal statement here";
    }
    $output .= "</textarea></div>";

    // input: ADDRESS
    $output .= "<div class=\"form-group\">";
    $output .= "<label class=\"txt-bold small-font-size capitalize\">address</label>";
    $output .= "<textarea class=\"form-control\" name=\"address\" rows=\"7\">";
    if(!empty($candidate->address)) {
        $output .= break2NewLine($candidate->address);
    } else {
        $output .= "current address";
    }
    $output .= "</textarea></div>";

    $output .= "</div></div>";

    // input: SUBMIT BUTTON
    $output .= "<div class=\"sm-container m-vlight-breather\">";
    $output .= "<div class=\"row\">";
    $output .= "<div class=\"col-sm-8\">";
    $output .= "<input type=\"submit\" value=\"Confirm Changes\" name=\"submit\" class=\"form-control btn sec-btn capitalize\"></div>";

    // input: CANCEL BUTTON
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

        if(isset($desiredJob->job_field) && $job_field->name == $desiredJob->job_field ) { 
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
        if(isset($desiredJob->job_type) && $type->type == $desiredJob->job_type) { 
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
        if(isset($desiredJob->salary_range) && $range->salary_range == $desiredJob->salary_range) { 
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
        if(isset($desiredJob->location) && $state->name == $desiredJob->location) { 
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
    global $jobQualification;

    if(!$newEntry) { 

        if(isset($schools)) {
            foreach($schools as $school) { 
                $output .= "<form method=\"post\" action=\"../control/user/profile.php\" class=\"sm p-light-bottom-breather\">";
                $output .= "<input type=\"hidden\" value=\"edu\" name=\"update_type\">";
                $output .= "<div class=\"row\">";
                $output .= "<p class=\"uppercase txt-bold text-center\">Entry: <span class=\"secbrandtxt-color\">";
                $output .= ++$n;
                $output .= "</span></p>";

                // first column
                $output .= "<div class=\"col-sm-6\">";

                // input: COURSE
                $output .= "<div class=\"form-group\">";
                $output .= "<label class=\"txt-bold small-font-size capitalize\">course</label>";
                $output .= "<input type=\"text\" class=\"form-control\" value=\"";

                if(isset($school->course)) {
                    $output .= $school->course; 
                } else { 
                    $output .= ""; 
                } 

                $output .= "\" name=\"course\" placeholder=\"enter your course title\"></div>";

                // input: DEGREE
                $output .= "<div class=\"form-group\">";
                $output .= "<label class=\"txt-bold small-font-size capitalize\">Degree</label>";
                $output .= "<select class=\"form-control\" name=\"degree\">";

                foreach($jobQualification as $qualification) {

                    $output .= "<option value=\"";
                    if(isset($school->degree) && $school->degree == $qualification->qualification) {
                        $output .= formatField($school->degree);
                        $output .= "\">";
                        $output .= $school->degree; 

                    } else { 

                        $output .= formatField($qualification->qualification);
                        $output .= "\">";
                        $output .= $qualification->qualification;
                    }

                    $output .= "</option>";                    
                }

                $output .= "</select></div>";


                // input: SCHOOL NAME
                $output .= "<div class=\"form-group\">";
                $output .= "<label class=\"txt-bold small-font-size capitalize\">school</label>";
                $output .= "<input type=\"text\" class=\"form-control\" value=\"";

                if(isset($school->school)) {
                    $output  .= $school->school; 
                } else {
                    $output  .= ""; 
                } 

                $output .= "\" name=\"school\" placeholder=\"enter your school\"> </div></div>";

                // 2nd column
                $output .= "<div class=\"col-sm-6\">";

                // input: SCHOOL LOCATION
                $output .= "<div class=\"form-group\">";
                $output .= "<label class=\"txt-bold small-font-size capitalize\"> location</label>";
                $output .= "<input type=\"text\" class=\"form-control\" value=\"";

                if(isset($school->location)) {
                    $output  .= $school->location; 
                } else {
                    $output  .= ""; 
                } 

                $output .= "\" name=\"location\" placeholder=\"example: Nigeria\"></div>";

                // input: GRADE
                $output .= "<div class=\"form-group\">";
                $output .= "<label class=\"txt-bold small-font-size capitalize\">grade</label>";
                $output .= "<input type=\"text\" class=\"form-control\" value=\"";

                if(isset($school->grade)) {
                    $output  .= $school->grade; 
                } else {
                    $output  .= ""; 
                } 

                $output .= "\" name=\"grade\" placeholder=\"example: 2nd Class Upper(2.1)\"></div>";

                // input: YEAR
                $output .= "<div class=\"form-group\">";
                $output .= "<label class=\"txt-bold small-font-size capitalize\">year</label>";
                $output  .= inputYear("year", $school->year);
                $output .= "</div></div></div>";

                // SUBMIT & CANCEL BTNS 
                $output .= "<div class=\"m-vlight-breather\">";
                $output .= "<div class=\"row\">";

                // input: SUBMIT BTN
                $output .= "<div class=\"col-sm-8\">";
                $output .= "<input type=\"submit\" value=\"Update entry\" name=\"submit\" class=\"form-control btn sec-btn capitalize\"></div>";

                // input: CANCEL BTN
                $output .= "<div class=\"col-sm-4\">";
                $output .= "<a href=\"delete.php?type=edu&id=";
                $output  .= $school->id;
                $output .= "\" class=\"form-control capitalize btn main-btn\">delete entry</a>";
                $output .= "</div></div></div></form>";
            }
        } else {
            $output .= "<p>You don't have any educational records. Click on the button below to add one</p>";
        }
        $output .= "<hr><div class=\"m-light-breather\">";
        $output .= "<a href=\"?type=education&action=add\" class=\"form-control btn main-btn capitalize\">+ add a new entry</a></div>";


    } else { // this is a new entry

        $output .= "<form method=\"post\" action=\"../control/candidate/profile.php\" class=\"sm p-light-bottom-breather\">";
        $output .= "<input type=\"hidden\" value=\"edu\" name=\"update_type\">";
        $output .= "<input type=\"hidden\" value=\"add\" name=\"action\">";
        $output .= "<div class=\"row\">";

        // 1st column
        $output .= "<div class=\"col-sm-6\">";

        // input: COURSE
        $output .= "<div class=\"form-group\">";
        $output .= "<label class=\"txt-bold small-font-size capitalize\">course</label>";
        $output .= "<input type=\"text\" class=\"form-control\" value=\"";
        $output .= "\" name=\"course\" placeholder=\"enter the course title\"></div>";

        // input: DEGREE
        $output .= "<div class=\"form-group\">";
        $output .= "<label class=\"txt-bold small-font-size capitalize\">degree</label>";
        $output .= "<select class=\"form-control\" name=\"degree\">";

        foreach($jobQualification as $qualification) {
            $output .= "<option value=\"";
            $output .= formatField($qualification->qualification);
            $output .= "\">";
            $output .= $qualification->qualification;
            $output .= "</option>";                    
        }
        $output .= "</select></div>";


        // input: SCHOOL
        $output .= "<div class=\"form-group\">";
        $output .= "<label class=\"txt-bold small-font-size capitalize\">school</label>";
        $output .= "<input type=\"text\" class=\"form-control\" value=\"";
        $output .= "\" name=\"school\" placeholder=\"enter the school\"> </div>";

        // end 1st column
        $output .= "</div>";

        // 2nd column
        $output .= "<div class=\"col-sm-6\">";

        // input: LOCATION
        $output .= "<div class=\"form-group\">";
        $output .= "<label class=\"txt-bold small-font-size capitalize\"> location</label>";
        $output .= "<input type=\"text\" class=\"form-control\" value=\""; 
        $output .= "\" name=\"location\" placeholder=\"example: Nigeria\"></div>";

        // input: GRADE
        $output .= "<div class=\"form-group\">";
        $output .= "<label class=\"txt-bold small-font-size capitalize\">grade</label>";
        $output .= "<input type=\"text\" class=\"form-control\" value=\""; 
        $output .= "\" name=\"grade\" placeholder=\"example: 2nd Class Upper(2.1)\"></div>";

        // input: YEAR
        $output .= "<div class=\"form-group\">";
        $output .= "<label class=\"txt-bold small-font-size capitalize\">year</label>";
        $output  .= inputYear("year");
        $output .= "</div>";

        // end 2nd column
        $output .= "</div>";

        // end row
        $output .= "</div>";

        // inputs: SUBMIT & CANCEL BUTTONS
        $output .= "<div class=\"m-vlight-breather\">";
        $output .= "<div class=\"row\">";

        // input: SUBMIT BTN
        $output .= "<div class=\"col-sm-8\">";
        $output .= "<input type=\"submit\" value=\"Add entry\" name=\"submit\" class=\"form-control btn sec-btn capitalize\"></div>";

        // input: CANCEL BTN
        $output .= "<div class=\"col-sm-4\">";
        $output .= "<a href=\"my-profile.php\"";
        $output .= "class=\"form-control capitalize btn main-btn\">cancel</a>";

        // end form
        $output .= "</div></div></div></form>";
    }


    return $output;
}

function skillForm($skills = null, $newEntry = false) {
    $n = 0;
    $output = "";
    $x = count($skills);

    if(!$newEntry) {
        if(isset($skills)) {
            foreach($skills as $skill) {
                $output .= "<form method=\"post\" action=\"../control/candidate/profile.php\" class=\"sm p-light-bottom-breather\">";

                // input: HIDDEN TYPE FIELD
                $output .= "<input type=\"hidden\" name=\"update_type\" value=\"sk\">";

                $output .= "<p class=\"uppercase txt-bold text-center\">Entry: <span class=\"secbrandtxt-color\">"; 
                $output .=  ++$n; 
                $output .= "</span></p>";

                // input: SKILL NAME
                $output .= "<div class=\"form-group\">";
                $output .= "<label>Skill: </label>";
                $output .= "<input class=\"form-control\" type=\"text\" name=\"skill_name\" value=\""; 
                if(isset($skill->skill_name)) {
                    $output .=  $skill->skill_name;
                } else {
                    $output .=  ""; 
                } 
                $output .= "\" placeholder=\"Enter a skill name\">";

                // UPDATE AND DELETE BTNS
                $output .= "</div><div class=\"row\">";
                $output .= "<div class=\"col-sm-6\">";

                // input: UPDATE
                $output .= "<div class=\"form-group\">";
                $output .= "<input type=\"submit\" value=\"Update entry\" name=\"submit\" class=\"form-control btn sec-btn capitalize\">";
                $output .= "</div></div>";

                // input: DELETE
                $output .= "<div class=\"col-sm-6\">";
                $output .= "<div class=\"form-group\">";
                $output .= "<a href=\"delete.php?type=skill&id="; 
                $output .=  $skill->id; 
                $output .= "\" class=\"form-control btn main-btn capitalize\">delete entry</a>";
                $output .= "</div></div></div></form>";

            }

        } else {
            $output .= "<p>You don't have any professional skill yet. Click on the button below to add one</p>";

        }

        $output .= "<hr><div class=\"m-light-breather\">";
        $output .= "<a href=\"?type=skills&action=add\" class=\"form-control btn main-btn capitalize\">+ add a new entry</a></div>";


    } else { // this is a new entry

        $output .= "<form method=\"post\" action=\"../control/candidate/profile.php\" class=\"sm p-light-bottom-breather\">";

        // input: HIDDEN TYPE and ACTION FIELD
        $output .= "<input type=\"hidden\" name=\"update_type\" value=\"sk\">";
        $output .= "<input type=\"hidden\" value=\"add\" name=\"action\">";


        $output .= "<p class=\"uppercase txt-bold text-center\">Entry: <span class=\"secbrandtxt-color\">"; 
        // $output .=  $x+1; 
        $output .= "</span></p>";

        // input: SKILL NAME
        $output .= "<div class=\"form-group\">";
        $output .= "<label>Skill: </label>";
        $output .= "<input class=\"form-control\" type=\"text\" name=\"skill_name\" value=\"";  
        $output .= "\" placeholder=\"Enter a skill name\">";
        $output .= "</div>"; 

        // input: SUBMIT BTN
        $output .= "<input type=\"submit\" value=\"Add entry\" name=\"submit\" class=\"form-control btn sec-btn capitalize\">";

        $output .= "</form>";
    }

    return $output;
}

function memForm($memberships = null, $newEntry = false) {
    $n = 0;
    $output = "";

    if(!$newEntry) { 

        if(isset($memberships)) { 

            foreach($memberships as $membership) {  
                $output .= "<form method=\"post\" action=\"../control/candidate/profile.php\" class=\"sm p-light-bottom-breather\">";

                // input: HIDDEN TYPE FIELD
                $output .= "<input type=\"hidden\" name=\"update_type\" value=\"mem\">";

                $output .= "<p class=\"uppercase txt-bold text-center\">Entry: <span class=\"secbrandtxt-color\">"; 
                $output .=  ++$n; 
                $output .= "</span></p>";

                $output .= "<div class=\"row\">";
                $output .= "<div class=\"col-sm-6\">";

                // input: ORGANIZATION
                $output .= "<div class=\"form-group\">";
                $output .= "<label>Organization: </label>";
                $output .= "<input class=\"form-control\" type=\"text\" name=\"organization\" value=\""; 

                if(isset($membership->organization)) {
                    $output .=  $membership->organization;
                } else {$output .=  ""; } 

                $output .= "\" placeholder=\"Enter the organization of your membership\">";
                $output .= "</div></div><div class=\"col-sm-6\">";

                // input: YEAR
                $output .= "<div class=\"form-group\">";
                $output .= "<label class=\"txt-bold small-font-size capitalize\">year</label>";
                $output .=  inputYear("year", $membership->year); 

                $output .= "</div></div></div>";

                $output .= "<div class=\"m-vlight-breather\">";

                // SUBMIT & CANCEL BTNS
                $output .= "<div class=\"row\">";
                $output .= "<div class=\"col-sm-8\">";
                $output .= "<input type=\"submit\" value=\"Update entry\" name=\"submit\" class=\"form-control btn sec-btn capitalize\"></div>";
                $output .= "<div class=\"col-sm-4\">";
                $output .= "<a href=\"delete.php?type=membership&id=";
                $output .=  $membership->id; 
                $output .= "\" class=\"form-control capitalize btn main-btn\">delete entry</a>";
                $output .= "</div></div></div></form>";
            }

        } else {

            $output .= "<p>You are not a member of any organization yet. Click on the button below to add one</p>";
        }

        $output .= "<hr><div class=\"m-light-breather\">";
        $output .= "<a href=\"?type=memberships&action=add\" class=\"form-control btn main-btn capitalize\">+ add a new entry</a></div>";


    } else { // new entry

        $output .= "<form method=\"post\" action=\"../control/candidate/profile.php\" class=\"sm p-light-bottom-breather\">";

        // input: HIDDEN TYPE and ACTION FIELD
        $output .= "<input type=\"hidden\" name=\"update_type\" value=\"mem\">";
        $output .= "<input type=\"hidden\" value=\"add\" name=\"action\">";

        $output .= "<div class=\"row m-light-top-breather\">";
        $output .= "<div class=\"col-sm-6\">";

        // input: ORGANIZATION
        $output .= "<div class=\"form-group\">";
        $output .= "<label class=\"capitalize\">Organization: </label>";
        $output .= "<input class=\"form-control\" type=\"text\" name=\"organization\" value=\""; 
        $output .= "\" placeholder=\"Enter the organization of your membership\">";
        $output .= "</div></div><div class=\"col-sm-6\">";

        // input: YEAR
        $output .= "<div class=\"form-group\">";
        $output .= "<label class=\"capitalize\">year</label>";
        $output .=  inputYear("year"); 
        $output .= "</div></div></div>";
        $output .= "<div class=\"m-vlight-breather\">";

        // input: ADD ENTRY
        $output .= "<input type=\"submit\" value=\"add entry\" name=\"submit\" class=\"form-control btn sec-btn capitalize\"></div>";
        $output .= "</form>";

    }

    return $output; 
}

function EHForm($employmentHistory = null, $newEntry = false) {
    $n = 0; 
    $output = "";

    if(!$newEntry) { 

        if(isset($employmentHistory)) { 

            foreach($employmentHistory as $item) { 
                $output .= "<form method=\"post\" action=\"../control/candidate/profile.php\" class=\"sm p-light-bottom-breather\">";
                
                // input: HIDDEN TYPE FIELD
                $output .= "<input type=\"hidden\" name=\"update_type\" value=\"empl\">";

                // entry number
                $output .= "<p class=\"uppercase txt-bold text-center\">Entry: <span class=\"secbrandtxt-color\">";
                $output .= ++$n; 
                $output .= "</span></p>";

                // 1st col
                $output .= "<div class=\"row\">";

                // input: JOB TITLE
                $output .= "<div class=\"col-sm-6\">";
                $output .= "<div class=\"form-group\">";
                $output .= "<label class=\"txt-bold small-font-size capitalize\">Job title </label>";
                $output .= "<input class=\"form-control\" type=\"text\" name=\"job_title\" value=\""; 

                if(isset($item->job_title)) {
                    $output .=  $item->job_title;
                } else {
                    $output .= ""; 
                }

                $output .= "\" placeholder=\"Enter your job position\"></div>";

                // input: EMPLOYER
                $output .= "<div class=\"form-group\">";
                $output .= "<label class=\"txt-bold small-font-size capitalize\">employer </label>";
                $output .= "<input class=\"form-control\" type=\"text\" name=\"employer\" value=\"";

                if(isset($item->employer)) {
                    $output .=  $item->employer;
                } else {
                    $output .=  ""; 
                }

                $output .= "\" placeholder=\"Enter the name of your employer\"></div>";

                // input: DURATION IN ORGANIZATION
                $output .= "<div class=\"form-group\">";
                $output .= "<label class=\"txt-bold small-font-size capitalize\">duration in organization </label>";
                $output .= "<input class=\"form-control\" type=\"text\" name=\"time_span\" value=\""; 

                if(isset($item->time_span)) {
                    $output .=  $item->time_span;
                } else {
                    $output .=  ""; 
                } 

                $output .= "\" placeholder=\"Example: 2012 - 2014\"></div>";

                // 2nd col
                $output .= "</div><div class=\"col-sm-6\">";

                // input: RESPONSIBILITIES
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

                // SUBMIT & CANCEL BTNS
                $output .= "<div class=\"row\">";
                $output .= "<div class=\"col-sm-8\">";
                $output .= "<input type=\"submit\" value=\"Update entry\" name=\"submit\" class=\"form-control btn sec-btn capitalize\"></div>";
                $output .= "<div class=\"col-sm-4\">";
                $output .= "<a href=\"delete.php?id="; 
                $output .=  $item->id; 
                $output .= "\" class=\"form-control capitalize btn main-btn\">delete entry</a>";
                $output .= "</div></div></div></form>";
            }
        } else {
            $output .= "<p>You haven't update your employment history. Click on the button below to add one</p>";
        }

        $output .= "<hr><div class=\"m-light-breather\">";
        $output .= "<a href=\"?type=employment_history&action=add\" class=\"form-control btn main-btn capitalize\">+ add a new entry</a></div>";

    } else {


        $output .= "<form method=\"post\" action=\"../control/candidate/profile.php\" class=\"sm p-light-bottom-breather\">";

        // input: HIDDEN TYPE and ACTION FIELD
        $output .= "<input type=\"hidden\" name=\"update_type\" value=\"empl\">";
        $output .= "<input type=\"hidden\" value=\"add\" name=\"action\">";

        // 1st column starts
        $output .= "<div class=\"row\"><div class=\"col-sm-6\">";

        // input: JOB TITLE
        $output .= "<div class=\"form-group\">";
        $output .= "<label class=\"txt-bold small-font-size capitalize\">Job title </label>";
        $output .= "<input class=\"form-control\" type=\"text\" name=\"job_title\" value=\""; 
        $output .= "\" placeholder=\"Enter your job position\"></div>";

        // input: EMPLOYER
        $output .= "<div class=\"form-group\">";
        $output .= "<label class=\"txt-bold small-font-size capitalize\">employer </label>";
        $output .= "<input class=\"form-control\" type=\"text\" name=\"employer\" value=\"";
        $output .= "\" placeholder=\"Enter the name of your employer\"></div>";

        // input: DURATION
        $output .= "<div class=\"form-group\">";
        $output .= "<label class=\"txt-bold small-font-size capitalize\">duration in organization </label>";
        $output .= "<input class=\"form-control\" type=\"text\" name=\"time_span\" value=\""; 
        $output .= "\" placeholder=\"Example: 2012 - 2014\"></div>";

        // end: 1st column
        $output .= "</div>";

        // 2nd column starts
        $output .= "<div class=\"col-sm-6\">";

        //input: JOB RESPONSIBILITIES
        $output .= "<div class=\"form-group\">";
        $output .= "<label class=\"txt-bold small-font-size capitalize\">responsibilities</label>";
        $output .= "<textarea name=\"responsibilities\" class=\"form-control\" rows=\"10\">";  
        $output .=  "Describe your responsibilites in the organization"; 
        $output .= "</textarea></div>";

        // end: 2nd column
        $output .= "</div></div>";

        // input: SUBMIT
        $output .= "<div class=\"m-vlight-breather\">";
        $output .= "<input type=\"submit\" value=\"Update entry\" name=\"submit\" class=\"form-control btn sec-btn capitalize\"></div>"; 
        
        // end: FORM
        $output .= "</form>";

    }

    return $output;
}

function intForm($interests = null) {
    $output = "";
    if(isset($interests)) { 
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
    }else {
        $output .= "<p>You haven't updated this section. Click on the button below to add one</p>";
    }

    return $output;


}

function candidateApplications($applications) {
    $i = 0;

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
    foreach($applications as $application) {
        $i++;

        // find job details
        $job = Jobs::findDetails($application->job_id);

        // start appending output
        $output .= "<tr>";

        // serial number
        $output .= "<td>" . $i . "</td>";

        // job title
        $output .= "<td class=\"capitalize\"><a href=\"job.php?id={$job->id}\">";
        $output .= $job->title . "</a></td>";

        // current status
        if (time() >= $job->deadline) {
            $output .= "<td class=\"capitalize\"> expired </td>"; 
        } else {
            $output .= "<td class=\"capitalize\"> live </td>"; 

        }

        // action
        $output .= "<td class=\"small-font-size\">";
        $output .= "<a href=\"delete.php?type=job-applied&id={$application->id}\">Delete</a></td>";

    }
    $output .= "</tbody></table></div>";

    return $output;
}


// EMPLOYER VIEW FUNCTIONS
function jobPosted($jobsPosted) {
    $i = 0;

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

        $output .= "<tr>";

        // serial number
        $output .= "<td>" . $i . "</td>";

        // job title
        $output .= "<td class=\"capitalize\"><a href=\"jobs.php?id={$job->id}\">";
        $output .= $job->title . "</a></td>";

        // current status
        if (time() >= $job->deadline) {
            $output .= "<td class=\"capitalize\"> expired </td>"; 
        } else {
            $output .= "<td class=\"capitalize\"> live </td>"; 

        }

        // action
        $output .= "<td class=\"small-font-size\"> <a href=\"\">edit</a><br>";
        $output .= "<a href=\"delete-job.php?id={$job->id}\">delete</a></td>";

    }
    $output .= "</tbody></table></div>";

    return $output;
}

function employerSidebar($employer) { 
    global $jobFields;

    // company profile
    $output  = "<div class=\"light-bx-shadow m-mid-bottom-breather\">";
    $output .= "<div class=\"p-vlight-breather sec-bg p-mid-side-breather\">";
    $output .= "<p class=\"headfont uppercase no-margin text-center\">company profile</p></div>";


    $output .= "<div class=\"p-mid-side-breather p-light-breather\">";

    if(!is_null($employer->avatar_url)) { 

        $output .= "<img class=\"img-center\" src=\"";
        $output .= $employer->avatar_url; 
        $output .= "\" alt=\"\">";

    } else { 
        $output .= "<img class=\"img-center img-responsive\" src=\"../img/company.png\" alt=\"\">";
    } 

    $output .= "<p class=\"lead headfont text-center no-margin\">";
    $output .= $employer->company_name; 
    $output .= "</p>";
    $output .= "<p class=\"secheadfont capitalize\">";
    $output .= $employer->job_field;  
    $output .= " firm</p>";

    $output .= "</div></div>";

    // create a job posting
    $output .= "<div class=\"light-bx-shadow m-mid-bottom-breather\">";
    $output .= "<div class=\"p-vlight-breather sec-bg p-mid-side-breather\">";
    $output .= "<p class=\"headfont uppercase no-margin text-center\">create a job posting</p>";
    $output .= "</div>";

    $output .= "<div class=\"p-mid-side-breather p-light-breather\">";
    $output .= "<form method=\"post\" action=\"create-job.php\">";
    $output .= "<div class=\"form-group\">";
    $output .= "<label class=\"capitalize\">job title</label>";
    $output .= "<input type=\"text\" name=\"title\" class=\"form-control\" placeholder=\"Enter Your Job Title\">";
    $output .= "</div>";

    $output .= "<div class=\"form-group\">";
    $output .= "<label class=\"capitalize\">field</label>";
    $output .= "<select name=\"job_field\" class=\"form-control\">";
    foreach($jobFields as $field){ 
        $output .= "<option value=\"";
        $output .= $field->name; 
        $output .= "\">"; 
        $output .= $field->name; 
        $output .= "</option>";
    } 
    $output .= "</select></div>";
    $output .= "<input type=\"submit\" value=\"Start\" class=\"btn sec-btn heavy-font-size form-control\">";
    $output .= "</form></div></div>";

    return $output;
}
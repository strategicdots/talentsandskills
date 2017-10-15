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

function isAjaxRequest() {
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
        return true; 
    } else { return false; }
}

function formatField($field) {

    return str_replace(" ", "-", (str_replace("/ ", "",$field)));
}

function pDForm($user = null) {
    $states = State::findAll();
    $dobArray = explode('/', $user->dob);
    $dob_d = $dobArray[0];
    $dob_m = $dobArray[1];
    $dob_y = $dobArray[2];

    $output = "<form action=\"../control/candidate/profile.php\" post=\"\" id=\"pd-form\" class=\"sm\">";
    $output .= "<input type=\"hidden\" value=\"{$user->id}\" name=\"id\">";
    $output .= "<input type=\"hidden\" value=\"pd\" name=\"profile_type\">";
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
    $output .= "<label class=\"txt-bold small-font-size capitalize\">current employer </label>";
    $output .= "<input type=\"text\" class=\"form-control\" name=\"employer\" value=\"{$user->employer}\" placeholder=\"your current employer\"></div>";


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
    $output .= "<textarea class=\"form-control\" name=\"personal_statement\" rows=\"2\">";
    if(!empty($user->personal_statement)) {
        $output .= $user->personal_statement;
    } else {
        $output .= "current address";
    }
    $output .= "</textarea></div>";

    $output .= "<div class=\"form-group\">";
    $output .= "<label class=\"txt-bold small-font-size capitalize\">address</label>";
    $output .= "<textarea class=\"form-control\" name=\"address\" rows=\"2\">";
    if(!empty($user->address)) {
        $output .= $user->address;
    } else {
        $output .= "current address";
    }
    $output .= "</textarea></div>";

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
    $output .= "</select></div></div></div>";
    $output .= "<div class=\"sm-container m-vlight-breather\">";
    $output .= "<div class=\"row\">";
    $output .= "<div class=\"col-sm-8\">";
    $output .= "<input type=\"submit\" value=\"Confirm Changes\" name=\"submit\" id=\"su-pd\" class=\"form-control btn sec-btn capitalize\"></div>";
    $output .= "<div class=\"col-sm-4\">";
    $output .= "<button name=\"submit\" class=\"form-control capitalize btn main-btn\" id=\"ca-pd-f\">cancel</button>";
    $output .= "</div></div></div></form>";

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

function trimContent($content, $count = 10) {
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
    $output .= "<input type=\"submit\" name=\"submit\" value=\"find jobs\" class=\"form-control btn sec-btn uppercase\">";
    $output .= "</div>";
    $output .= "</form>";
    $output .= "</div>";
    $output .= "</div>"; 

    return $output;
}
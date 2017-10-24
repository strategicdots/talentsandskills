<?php
$output = "<form action=\"../control/candidate/profile.php\" method=\"post\" class=\"sm\">";
$output .= "<input type=\"hidden\" value=\"cs\" name=\"update_type\">";
$output .= "<div class=\"row\">";
$output .= "<div class=\"col-sm-6\">";
$output .= "<div class=\"form-group\">";
$output .= "<label class=\"txt-bold small-font-size capitalize\">desired job title</label>";
$output .= "<input type=\"text\" class=\"form-control\" value=\"";

if(isset($desiredJob[0]->job_title)) {
    $output .=  $desiredJob[0]->job_title; 

} else {
 
    $output .=  ""; 
} 

$output .= "\" name=\"job_title\" placeholder=\"enter your desired job title\"></div>";
$output .= "<div class=\"form-group\">";
$output .= "<label class=\"txt-bold small-font-size capitalize\">job field</label>";
$output .= "<select name=\"job_field\" class=\"form-control\">";
$output .= "<option value=\"\">choose your field</option>";
 
foreach($jobFields as $job_field) {  

    if($job_field->name == $desiredJob[0]->job_field ) { 
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
    if($type->time_span == $desiredJob[0]->job_type) { 
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
    if($range->salary_range == $desiredJob[0]->salary_range) { 
        $output .= "<option value=\""; 
        $output .=  $range->salary_range; 
        $output .= "\" selected>"; 
        $output .=  $range->salary_range; 
        $output .= "</option>";

    } else { 
        $output .= "<option value=\""; 
        $output .=  $range->salary_range; 
        $output .= "\">"; 
        $output .=  $range->salary_range; 
        $output .= "</option>";

    }
}
$output .= "</select></div>";

$output .= "<div class=\"form-group\">";
$output .= "<label class=\"txt-bold small-font-size capitalize\">desired job location</label>";
$output .= "<select name=\"location\" id=\"\" class=\"form-control\">";
$output .= "<option>desired job location</option>";

foreach($states as $state) { 
    if($state->name == $desiredJob[0]->location) { 
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
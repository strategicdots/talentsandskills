<?php
// company profile
$output .= "<div class=\"light-bx-shadow m-mid-bottom-breather\">";
$output .= "<div class=\"p-vlight-breather sec-bg p-mid-side-breather\">";
$output .= "<p class=\"headfont uppercase no-margin text-center\">company profile</p></div>";


$output .= "<div class=\"p-mid-side-breather p-light-breather\">";
if(!is_null($employer->avatar_url)) { 
    $output .= "<img class=\"img-center\" src=\"";
    $output .= $employer->avatar_url; 
    $output .= "\" alt=\"\">";

    else { 
        $output .= "<img class=\"img-center\" src=\"../img/candidate-placeholder.jpg\" alt=\"\">";
    } 

    $output .= "<p class=\"lead headfont text-center no-margin\">";
    $output .= $employer->company_name; 
    $output .= "</p>";
    $output .= "<p class=\"secheadfont capitalize\">";
    $output .= $employer->job_field;  
    $output .= "firm</p>";

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

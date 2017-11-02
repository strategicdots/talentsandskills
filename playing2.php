<?php
$output .= "<div class=\"light-bx-shadow m-mid-bottom-breather\">";
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
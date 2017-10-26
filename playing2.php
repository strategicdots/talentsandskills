<?php
function jobPosted($jobPosted) {
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
        $output .= "<td>" . $job->title . "</td>";

        // current status
        if ($currentTime > $deadline) {
            $output .= "<td> live </td>"; 
        } else {
            $output .= "<td> expired </td>"; 

        }
        
        // action
        $output .= "<td class\"small-font-size\"> <a href=\"\">Edit</a><br>";
        $output .= "<a href=\"\">delete</a></td>";

    }
    $output .= "</tbody></table></div>";
    
    return $output;

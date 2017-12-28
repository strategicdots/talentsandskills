<!DOCTYPE html>
<html lang="en">

<head>
      <title>Talent and Skills </title>
      <meta name="viewport" content="width=device-width">
      <meta http-equiv="content-type" content="text/html; charset=utf-8">
      <meta name="description" content="">
      <link rel="stylesheet" href="<?php echo $seperator; ?>css/bootstrap.min.css">
      <link href="http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
      <link rel="stylesheet" href="<?php echo $seperator; ?>css/main.css">
</head>

<body class="">

      <!--navbar -->
      <div class="white-bg">
            <div class="container">
                  <div class="navbar navbar-default navbar-right navbar-fixed-top">
                        <div class="container">
                              <div class="navbar-header">
                                    <a href="<?php if(empty($seperator)) {echo " . "; } else { echo $seperator; } ?>" class="pull-left logo block"></a>
                                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                                          <span class="icon-bar"></span>
                                          <span class="icon-bar"></span>
                                          <span class="icon-bar"></span>
                                    </button>
                              </div>
                              <div class="collapse navbar-collapse">

                                    <?php 
                        if($navbarType == "candidate") {
                              echo candidate($thisPage);
                        } elseif($navbarType == "employer") {
                              echo employer($thisPage);
                        } elseif($navbarType == "intern") {
                              echo intern($thisPage);
                        } elseif($navbarType == "admin") {
                              echo admin($thisPage);
                        }
                        ?>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
      <!-- end .navbar -->

      <?php

// candidate
function candidate($thisPage) { 
      $output  = "<ul class=\"nav navbar-nav navbar-right\">";
      
      // dashboard
      $output .= "<li> <a href=\"dashboard.php\"";
      if($thisPage=="dashboard" ) { 
            $output .= currentPage(); 
      }
      $output .= "> dashboard </a></li>";
      
      // profile
      $output .= "<li> <a href=\"my-profile.php\"";  
      if($thisPage=="my-profile") { 
            $output .= currentPage(); 
      }
      $output .= "> my profile </a></li>";
      
      // job search
      $output .= "<li> <a href=\"job-search.php\"";
      if($thisPage=="search-jobs" || $thisPage=="apply-job") { 
            $output .= currentPage(); 
      } 
      $output .= "> search jobs </a> </li>";
      
      // my jobs
      $output .= "<li> <a href=\"my-jobs.php\"";  
      if($thisPage=="my-jobs" ) { 
            $output .= currentPage(); 
      } 
      $output .= "> my jobs </a></li>";
      
      // settings
      $output .= "<li> <a href=\"settings.php\"";  
      if($thisPage=="settings" ) { 
            $output .= currentPage(); 
      } 
      $output .= "> settings </a></li>";
      
      // logout
      $output .= "<li> <a href=\"logout.php\" class=\"last\"> logout </a> </li>";
      $output .= "</ul>";

      return $output;
}

// intern
function intern($thisPage) {
      $output = "<ul class=\"nav navbar-nav navbar-right\">";

      // dashboard
      $output .= "<li> <a href=\"dashboard.php\"";
      if ($thisPage == "dashboard") {
            $output .= currentPage();
      }
      $output .= "> dashboard </a></li>";

      // my profile
      $output .= "<li> <a href=\"my-profile.php\"";
      if ($thisPage == "my-profile") {
            $output .= currentPage();
      }
      $output .= "> my profile </a></li>";
            
      // register
      $output .= "<li> <a href=\"register.php\"";
      if ($thisPage == "internship registration") {
            $output .= currentPage();
      }
      $output .= "> register your spot </a> </li>";
            
      // settings
      $output .= "<li> <a href=\"settings.php\"";
      if ($thisPage == "settings") {
            $output .= currentPage();
      }
      $output .= "> settings </a></li>";

      // logout
      $output .= "<li> <a href=\"logout.php\" class=\"last\"> logout </a> </li>";
      $output .= "</ul>";

      return $output;
}

// employer
function employer($thisPage) { 
    $output .= "<ul class=\"nav navbar-nav navbar-right\">";
    
    // dashboard
    $output .= "<li> <a href=\"dashboard.php\"";
    if($thisPage=="dashboard" ) { 
        $output .= currentPage(); 
    } 
    $output .= "> dashboard </a></li>";
    
    // post a job
    $output .= "<li> <a href=\"create-job.php\"";
    if($thisPage=="create-job" ) { 
        $output .= currentPage(); 
    } 
    $output .= "> post a job </a></li>";
    
    // job posts
    $output .= "<li> <a href=\"jobs.php\"";  
    if($thisPage=="jobs" ) { 
        $output .= currentPage(); 
    } 
    $output .= "> job posts </a></li>";     
    
    // profile
    $output .= "<li> <a href=\"profile.php\""; 
    if($thisPage=="employer_profile" ) { 
        $output .= currentPage(); 
    }
    $output .= "> profile </a> </li>";
    
    // subscription
    $output .= "<li> <a href=\"subscription.php\"";
    if($thisPage=="subscription" ) { 
        $output .= currentPage(); 
    }
    $output .= "> my subscription </a></li>";
    
    // logout
    $output .= "<li> <a href=\"logout.php\" class=\"last\"> logout </a> </li>";
    $output .= "</ul>";
    
    return $output;
}
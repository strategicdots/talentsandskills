<?php  $seperator="../"; 
include_once("{$seperator}includes/initialize.php");

// check user status
if (!$session->isCandidateLoggedIn()) {redirect_to("{$seperator}login.php"); } 

 if(!$_GET['id'] && !$_GET['type']) { redirect_to("{$seperator}"); }

switch($_GET['type']) {

      // EDUCATION 
      
      // deleting a school (education) entry
      case "edu" :
      
      // check if entry is coming from user before deleting
      $school = School::findDetails(trim($_GET['id']));
      
      if( (int) $school->user_id !== (int) $session->candidateID) {
            
            redirect_to("{$seperator}candidate/dashboard.php"); 
      
      } else {

            if(School::delete($school->id)) {
                  
                  $session->message("Entry deleted successfully"); 
                  redirect_to("update-profile.php?type=education");
            }
      }

      break;

      // SKILL

      // deleting a skill entry
      case "skill" :

      // check if entry is coming from user before deleting
      $skill = Skills::findDetails(trim($_GET['id']));
      
      if( (int) $skill->user_id !== (int) $session->candidateID) {
            
            redirect_to("{$seperator}candidate/dashboard.php"); 
      
      } else {

            if(Skills::delete($skill->id)) {
                  
                  $session->message("Entry deleted successfully"); 
                  redirect_to("update-profile.php?type=skills");
            }
      }

      break;


      // MEMBERSHIP

      // deleting a membership entry
      case "membership" :
      
            // check if entry is coming from user before deleting
            $membership = Membership::findDetails(trim($_GET['id']));
            
            if( (int) $membership->user_id !== (int) $session->candidateID) {
                  
                  redirect_to("{$seperator}candidate/dashboard.php"); 
            
            } else {
      
                  if(Membership::delete($membership->id)) {
                        
                        $session->message("Entry deleted successfully"); 
                        redirect_to("update-profile.php?type=memberships");
                  }
            }
      
            break;


}


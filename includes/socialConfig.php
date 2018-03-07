<?php


 class SocialConfig {


}

class LinkedInObject extends SocialConfig {

            
      public $clientID = "78lze60mgpurl5";
      public $clientSecret = "uJCineweyzpxAZdf";
      public $redirectURI = "http://talentsandskills.net/talents/talents/callback.php";
      public $scopes = "r_basicprofile%20r_emailaddress";
      
      public function csrfToken() {
            return random_int(1111111, 9999999);
      }

      
      


}
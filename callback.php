<?php
$seperator = "";
include_once("includes/initialize.php");


function curl($url, $parameters) {

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
      curl_setopt($ch, CURLOPT_POST, 1);

      $headers = [];
      $headers[] = "Content-Type: application/x-www-form-urlencoded";
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

      return curl_exec($ch);

}

function getCallback() {

      $linkedInObj = new LinkedInObject();

      if(isset($_REQUEST['code'])) {
            
            $code = $_REQUEST['code'];
            $url = "https://www.linkedin.com/oauth/v2/accessToken";
            
            $params = [
                  'client_id' => $linkedInObj->clientID,
                  'client_secret' => $linkedInObj->clientSecret,
                  'redirect_uri' => $linkedInObj->redirectURI,
                  'code' => $code,
                  'grant_type' =>'authorization_code',
            ];

            $accessToken = curl($url, http_build_query($params));
            $accessToken = json_decode($accessToken)->access_token;

            $url = "https://api.linkedin.com/v1/people/~:";
            $url .= "(id,firstName,lastName,pictureUrls::(original),headline,publicProfileUrl,";
            $url .= "location,industry,positions,email-address)?format=json&oauth2_access_token=";
            $url .= $accessToken;

            return  json_decode(file_get_contents($url, false));
            
      }

}

$profile = getCallback();

$_SESSION['socialProfile'] = $profile;

redirect_to("control/socialLoginProfile.php");
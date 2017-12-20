<?php $thisPage = "register"; $seperator="../"; 
include_once("{$seperator}includes/initialize.php");
include_once("{$seperator}vendor/hybridauth/hybridauth/hybridauth/Hybrid/Auth.php");
include_once("{$seperator}vendor/hybridauth/hybridauth/hybridauth/Hybrid/Endpoint.php");

// Social Media Registration
/**
 * including $config file,
 * this is where all social media authentication are stored
 * needed for access
 */

// echo $config; exit;


// facebook registration
if(isset($_POST['fb_auth'])) {

      $config = [
            "base_url" => "http://localhost/talents/register/index.php",
            "providers" => [
                  "Facebook" => [
                        "enabled" => true,
                        "keys" => ["id" => "1782052178495689", "secret" => "44ebff15be92eda57114778627d7cf66"],
                        "scope" => ['email', 'user_about_me', 'user_birthday'],
                        "photo_size" => 200
                  ]
            ]
      ];
      $hybridauth = new Hybrid_Auth($config);

      if (isset($_REQUEST['hauth.start']) || isset($_REQUEST['hauth.done'])) {
            echo "1"; exit;
            Hybrid_Endpoint::process();
      } else {
            echo "2"; exit;
      }

      try {
            $hybridauth = new Hybrid_Auth($config);
            $adapter = $hybridauth->authenticate("Facebook");
            $userProfile = $adapter->getUserProfile();

      } catch(Exception $e) {
            die("<p>got an error</p>") . $e->getMessage();
      }

      if(isset($userProfile)) {
            var_dump($userProfile);
      }

}

// twitter registration
if (isset($_POST['twt_auth'])) {

}

// LinkedIn registration
if (isset($_POST['lnkdin_auth'])) {

}

$errors = "";
// process form data from email type registratioin
if(isset($_POST['submit'])) {
    $errors = [];

      $firstName         = trim($_POST['firstname']);
      $email            = trim($_POST['email']);
      $accountType      = trim($_POST['account_type']);

      $raw_fields     = [
            'first_name'      => $firstName, 
            'email'           => $email, 
            'account_type'    => $accountType
      ];

      foreach ($raw_fields as $field => $value) {
            if(!$validation->hasPresence($value)) {
                  $errors[$field] = ucwords(str_replace("_", " ", $field)) . " can't be blank";
            } 
      }

      if(empty($errors)) {
            
            // validations passed
            // redirect to the appropriate section for registration
            $_SESSION['PART_REG'] = $_POST;
            if($accountType == "candidate") {
                  
                  redirect_to("candidate.php");
        
            } elseif($accountType == "employer") {
              
                  redirect_to("employer.php");
        
            } elseif($accountType == "intern") {
                  
                  redirect_to("intern.php");
            }
         
      } else {
           $session->message("Please fill all fields");
      }
}

// header 
include_once("{$seperator}layout/header.php"); 
?>

<div class="container inner-top p-heavy-top-breather registration">
      <div class="row">
            <!-- signup with social network -->
            <div class="col-sm-6 rgstrtn-col">
                  <div class="heavy-container light-bx-shadow p-light-breather p-mid-side-breather sm-br">
                        <p class="text-center capitalize headfont">Sign up with a social network</p>
                        <div class="m-light-breather mid-container">
                              <div class="m-light-bottom-breather">
                                    <form method="post" action="#">
                                          <input type="hidden" name="fb_auth" value="true">
                                          <input type="submit" class="btn rgstrtn-social fb" value="Register With Facebook">
                                          <!-- <a class="rgstrtn-social fb" href="">Facebook</a> -->
                                    </form>
                              </div>
                              <div class="m-light-bottom-breather">
                                    <a class="rgstrtn-social twt" href="">Twitter</a>
                              </div>
                              <div class="m-light-bottom-breather">
                                    <a class="rgstrtn-social lnkdin" href="">LinkedIN</a>
                              </div>
                        </div>
                  </div>
            </div>

            <!-- signup with email address -->
            <div class="col-sm-6 rgstrtn-col">
                  <div class="heavy-container light-bx-shadow p-light-breather p-mid-side-breather sm-br">
                        <p class="text-center capitalize headfont">Sign up with your email address</p>


                        <div class="m-light-breather mid-container">
                              <?php echo inline_message(); ?>
                              <form action="#" method="post">

                                    <div class="form-group">
                                          <label for="name" class="sr-only">Enter Your First Name</label>
                                          <input class="form-control" placeholder="Enter Your First Name" name="firstname" type="text" value="<?php if(!empty($firstName)) {echo $name; } ?>">
                                    </div>

                                    <div class="form-group">
                                          <label for="email" class="sr-only">Enter Your Email</label>
                                          <input class="form-control" placeholder="Enter Your email" name="email" type="text" value="<?php if(!empty($email)) {echo $email; } ?>">
                                    </div>

                                    <div class="form-group">
                                          <label for="name" class="sr-only">Select One</label>
                                          <select name="account_type" class="form-control">
                                                <option>Choose your account type</option>
                                                <option value="candidate">Candidate</option>
                                                <option value="intern">Intern</option>
                                                <option value="employer">Employer</option>
                                          </select>
                                    </div>

                                    <input type="submit" name="submit" class="btn capitalize main-btn form-control" value="Register">
                              </form>
                        </div>
                  </div>
            </div>
      </div>
</div>

<!-- footer -->
<?php include_once("{$seperator}layout/footer.php"); ?>
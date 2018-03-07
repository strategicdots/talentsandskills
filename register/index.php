<?php $thisPage = "register"; $seperator="../"; 
include_once("{$seperator}includes/initialize.php");
include_once("{$seperator}socialConfig.php");

// SOCIAL MEDIA REGISTERATION

// facebook registration

// twitter 

// LinkedIn registration
$linkedInObj = new LinkedInObject();

$linkedInURL = "https://www.linkedin.com/oauth/v2/authorization?";
$linkedInURL .= "response_type=code&client_id=" . $linkedInObj->clientID;
$linkedInURL .= "&redirect_uri=" . $linkedInObj->redirectURI;
$linkedInURL .= "&state=" . $linkedInObj->csrfToken();
$linkedInURL .= "&scope=" . $linkedInObj->scopes;


// EMAIL TYPE REGISTERATION

// process form data
$errors = "";
if(isset($_POST['submit'])) {
      $errors = [];
      $raw_fields = [];

      if(isset($_POST['firstname'])) {
          
            $raw_fields['firstname'] = trim($_POST['firstname']);
    
      } elseif(isset($_POST['company_name'])) {
            
            $raw_fields['company_name'] = trim($_POST['company_name']);
      }

      $raw_fields ['email'] = trim($_POST['email']);
      $raw_fields['account_type'] = trim($_POST['account_type']); 

      foreach ($raw_fields as $field => $value) {
            if(!$validation->hasPresence($value)) {
                  $errors[$field] = ucwords(str_replace("_", " ", $field)) . " can't be blank";
            } 
      }

      if(empty($errors)) {
            
            // validations passed
            // redirect to the appropriate section for registration
            $_SESSION['PART_REG'] = $_POST;
            if($_POST['account_type'] == "candidate") {
                  
                  redirect_to("candidate.php");
        
            } elseif($_POST['account_type'] == "employer") {
              
                  redirect_to("employer.php");
        
            } elseif($_POST['account_type'] == "intern") {
                  
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
                                    <a class="rgstrtn-social lnkdin" href="<?php echo $linkedInURL; ?>">LinkedIN</a>
                              </div>

                              <div class="m-light-bottom-breather">
                                    <form method="post" action="#">
                                          <!-- <input type="hidden" name="fb_auth" value="true"> -->
                                          <input type="button" onclick="window.location = '<?php echo $loginURL; ?>';" class="btn rgstrtn-social fb" value="Facebook">
                                    </form>
                              </div>

                              <div class="m-light-bottom-breather">
                                    <a class="rgstrtn-social twt" href="">Twitter</a>
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
                                          <label for="name" class="sr-only">Select One</label>
                                          <select name="account_type" class="form-control" id="accountType">
                                                <option>Choose your account type</option>
                                                <option value="candidate">Candidate</option>
                                                <option value="intern">Intern</option>
                                                <option value="employer">Employer</option>
                                          </select>
                                    </div>

                                    <div class="form-group" id="userName">
                                          <label for="name" class="sr-only">Enter Your First Name</label>
                                          <input class="form-control" placeholder="Enter Your First Name" name="firstname" type="text" value="<?php if(!empty($firstName)) {echo $name; } ?>">
                                    </div>

                                    <div class="form-group">
                                          <label for="email" class="sr-only">Enter Your Email</label>
                                          <input class="form-control" placeholder="Enter Your email" name="email" type="text" value="<?php if(!empty($email)) {echo $email; } ?>">
                                    </div>



                                    <input type="submit" name="submit" class="btn capitalize main-btn form-control" value="Register">
                              </form>
                        </div>
                  </div>
            </div>
      </div>
</div>
<script>
      const accountType = document.getElementById("accountType");
      const userName = document.getElementById('userName');


      let employerHTML = `<label for="name" class="sr-only">Enter Your Company's Name</label>`;
      employerHTML +=
            `<input class="form-control" placeholder="Enter Your Company's Name" name="company_name" type="text" value="">`;

      let otherHTML = `<label for="name" class="sr-only">Enter Your First Name</label>`;
      otherHTML +=
            `<input class="form-control" placeholder="Enter Your First Name" name="firstname" type="text" value="">`;
      accountType.onchange = changeEventHandler;


      function changeEventHandler(e) {
            if (e.target.value == "employer") {
                  userName.innerHTML = employerHTML;
            } else if (e.target.value == "intern" || e.target.value == "candidate") {
                  userName.innerHTML = otherHTML;
            }
      }
</script>
<!-- footer -->
<?php include_once("{$seperator}layout/footer.php"); ?>
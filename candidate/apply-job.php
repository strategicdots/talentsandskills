<?php $thisPage = "apply-job"; $seperator="../"; 
include_once("{$seperator}includes/initialize.php");

/* check user status */
if (!$session->isCandidateLoggedIn()) {redirect_to("{$seperator}login.php"); } 

/* candidate details */
$user = User::findDetails($session->candidateID);

/* check ID of job */
if(!$_GET && !isset($_GET['id'])) { redirect_to("job-search.php"); }

$job = Jobs::findDetails($_GET['id']);
$employer = Employer::findDetails($job->employer_id); 

// calculating deadline
$deadline = "";
if($job->deadline > strtotime("now")) {
    $timestamp = strtotime($job->deadline);
    $deadline = date('D jS  F\, Y', $timestamp);
} else { $deadline = "appication closed"; }

/* APPLICATION PROCESSING */
if(isset($_POST['submit'])) {

      // print_r(trim($_POST['editor'])); exit;
      
            $uploadErrs = [];
            $message = "";
        
            $resume = new Resume();
            
            if($resume->attach_file($_FILES['cv'])) {
                    
                if($resume->upload()) {
                  
                    /* save path in db */
                    if($resume->updateDB($session->candidateID)) {
                          $application = new Application();

                          $application->user_id = $user->id;
                          $application->job_id = $job->id;
                          $application->motivation_letter = htmlentities(trim($_POST['editor']));

                          if($application->create()) {
                              
                              // send confirmation msg and redirect
                              $session->message("Application submitted successfully");
                              redirect_to("my-profile.php");
                          }
                          
                    }
        
                } 
                else { // problem uploading cv
                    foreach($resume->errors as $error => $msg) {
                        $message .= "{$msg} \n";
                    }
                }
        
            } 
          
          else { // output file upload error message
                foreach($resume->errors as $error => $msg) {
                    $message .= "{$msg} \n";
                }  
            }
        
}

?>

<!-- header -->
<?php include_once("{$seperator}layout/dashboard-header.php"); ?>

<!--  main content  -->
<div class="inner-top dashboard">
      <div class=" p-light-breather">

            <!-- top job search form -->
            <?php echo topJobSearch($states, $seperator); ?>

            <div class="container m-heavy-top-breather">
                  <div class="row">

                        <!-- user details -->
                        <div class="col-sm-9 white-bg m-heavy-side-breather p-light-breather">
                              <div class="">
                                    <h2 class="headfont txt-bold headline-font-size text-center small-line-height capitalize">Application for
                                          <i class="secbrandtxt-color">
                                                <?php echo $job->title; ?>
                                          </i> at
                                          <?php echo $employer->company_name; ?>
                                    </h2>
                              </div>
                              <form method="post" action="#" class="" enctype="multipart/form-data">
                                    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo maxCVSize(); ?>">

                                    <div class="m-mid-breather">

                                          <div class="form-group m-light-bottom-breather">
                                                <div class="p-vlight-breather gray-bg p-mid-side-breather">
                                                      <p class="secheadfont uppercase no-margin">resume / cv</p>
                                                </div>

                                                <div class="p-mid-side-breather small-font-size m-light-top-breather">

                                                      <?php if(!$user->cv_path): ?>
                                                      <p class="no-margin txt-bold">You haven't uploaded a resume to your account</p>
                                                      <p class="">Upload from your computer now.</p>
                                                      <input type="file" name="cv">

                                                      <?php else: ?>
                                                      <p class="no-margin txt-bold">You've already uploaded a resume to your account</p>
                                                      <p class="">Need to upload a new one? Select from your computer below.</p>
                                                      <input type="file" name="update-cv">
                                                      <?php endif; ?>
                                                </div>

                                          </div>

                                          <div class="form-group m-light-bottom-breather">

                                                <div class="p-vlight-breather gray-bg p-mid-side-breather">
                                                      <p class="secheadfont uppercase no-margin">letter of motivation</p>
                                                </div>

                                                <div class="p-mid-side-breather small-font-size m-light-top-breather">
                                                      <p class="no-margin">Why are you the best candidate for the job?</p>
                                                </div>

                                                <textarea name="editor" id="" class="ckeditor form-control"></textarea>
                                          </div>

                                          <!-- submit form -->
                                          <div class="sm-container m-mid-top-breather">
                                                <input type="submit" name="submit" value="apply now" class="form-control capitalize btn sec-btn">
                                          </div>
                                    </div>
                              </form>
                        </div>

                        <!-- job summary -->
                        <div class="sidebar col-sm-3">
                              <div class="p-vlight-breather sec-bg p-mid-side-breather">
                                    <p class="headfont uppercase no-margin text-center">job summary</p>
                              </div>
                              <div class="p-mid-side-breather p-light-breather white-bg small-font-size">

                                    <!-- company name -->
                                    <div class="capitalize">
                                          <p class="txt-bold no-margin">company</p>
                                          <p class="">
                                                <?php echo $employer->company_name; ?> </p>
                                    </div>

                                    <!-- job field -->
                                    <div class="capitalize">
                                          <p class="txt-bold no-margin">field</p>
                                          <p class="">
                                                <?php echo $job->job_field; ?>
                                          </p>
                                    </div>

                                    <!-- job type -->
                                    <div class="capitalize">
                                          <p class="txt-bold no-margin">job type</p>
                                          <p class="">
                                                <?php echo $job->job_type; ?>
                                          </p>
                                    </div>

                                    <!-- location -->
                                    <div class="capitalize">
                                          <p class="txt-bold no-margin">location</p>
                                          <p class="">
                                                <?php echo $job->location; ?>
                                          </p>
                                    </div>

                                    <!-- job experience -->
                                    <div class="capitalize">
                                          <p class="txt-bold no-margin">experience</p>
                                          <p class="">
                                                <?php echo $job->job_experience; ?>
                                          </p>
                                    </div>

                                    <!-- job qualification -->
                                    <div class="capitalize">
                                          <p class="txt-bold no-margin">minimum qualification</p>
                                          <p class="">
                                                <?php echo $job->qualification; ?>
                                          </p>
                                    </div>

                                    <!-- job deadline -->
                                    <div class="capitalize">
                                          <p class="txt-bold no-margin">deadline</p>
                                          <p class="">
                                                <?php echo $deadline; ?>
                                          </p>
                                    </div>

                              </div>
                        </div>

                  </div>

            </div>

      </div>

</div>

<!-- footer -->
<?php include_once("{$seperator}layout/footer.php"); ?>
<?php $thisPage = "dashboard"; $seperator="../"; $navbarType = "candidate";
include_once("{$seperator}includes/initialize.php");

/* check user status */
 if (!$session->isCandidateLoggedIn()) {redirect_to("{$seperator}login.php"); } 
 $candidate = Candidate::findDetails($session->candidateID);

// process form data 
if(isset($_POST['submit'])) {

      $uploadErrs = [];
      $message = "";
  
      $resume = new Resume();
      
      if($resume->attach_file($_FILES['upload'])) {
  
          if($resume->upload()) {
              /* save path in db */
              if($resume->updateDB($session->candidateID)) {
                  // send confirmation msg and redirect
                  $session->message("CV uploaded successfully");
                  
                  redirect_to("my-profile.php");
              }
  
          } 
          else { // problem uploading image
            
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
  
$desiredJob         = DesiredJob::findAllUnderParent($candidate->id, "user_id");
$schools            = School::findAllUnderParent($candidate->id, "user_id");
$skills             = Skills::findAllUnderParent($candidate->id, "user_id");
$memberships        = Membership::findAllUnderParent($candidate->id, "user_id");
$employmentHistory  = EmploymentHistory::findAllUnderParent($candidate->id, "user_id");
$interests          = Interest::findAllUnderParent($candidate->id, "user_id");
?>

<!-- header -->
<?php include_once("{$seperator}layout/dashboard-header.php"); ?>
<!--  end header -->

<!--  main content  -->
<div class="inner-top dashboard">
      <div class=" p-heavy-breather">
            <div class="container">
                  <div class="row">

                        <!-- sidebar -->
                        <div class="sidebar col-sm-4">
                              <?php echo candidateSidebar($candidate); ?>
                        </div>
                        <!-- mainbar -->
                        <div class="col-sm-8 mainbar">

                              <!--  upload cv -->
                              <div class="light-bx-shadow">
                                    <div class="p-vlight-breather sec-bg p-mid-side-breather m-vlight-bottom-breather">
                                          <p class="headfont uppercase no-margin">upload your cv </p>
                                    </div>

                                    <div class="p-light-bottom-breather p-mid-side-breather">
                                          <?php 
                                          if(isset($message)) { 
                                                echo "<p style=\"color: red\">{$message}</p>";
                                                $message = ""; 
                                          } 
                                          ?>

                                          <!-- cv form -->
                                          <form method="post" action="" enctype="multipart/form-data">
                                                <div class="m-light-bottom-breather">
                                                      <ul class="no-list-style no-left-padding">
                                                            <li>The file size must not be more than
                                                                  <span class="txt-bold">500KB</span>
                                                            </li>
                                                            <li>File format must be any of these:
                                                                  <span class="txt-bold">.pdf, .docx, .doc </span>
                                                            </li>
                                                      </ul>
                                                </div>

                                                <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo maxCVSize(); ?>">

                                                <div class="form-group">
                                                      <input type="file" name="upload" style="padding-left: 0;">
                                                </div>

                                                <input type="submit" name="submit" value="upload cv / resume" class="btn uppercase m-vlight-top-breather sec-btn mid-font-size">
                                          </form>

                                    </div>

                              </div>
                              <!--  end upload cv -->


                        </div>
                        <!-- end .mainbar -->

                  </div>
                  <!-- end .sidebar -->
            </div>
      </div>

</div>
</div>
<!-- end main content -->

<!-- footer -->
<?php include_once("{$seperator}layout/footer.php"); ?>
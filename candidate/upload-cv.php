<?php $thisPage = "dashboard"; $seperator="../"; 
include_once("{$seperator}includes/initialize.php");

/* check user status */
// if (!$session->isLoggedIn()) {redirect_to("{$seperator}login.php"); } 

// process form data 
if(isset($_POST['submit'])) {

      $uploadErrs = [];
      $message = "";
  
      $resume = new Resume();
      
      if($resume->attach_file($_FILES['upload'])) {
  
          if($resume->upload()) {
              /* save path in db */
              if($resume->updateDB(1)) {
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
  
 
$user               = User::findDetails('1');
$desiredJob         = DesiredJob::findAllUnderParent($user->id, "user_id");
$schools            = School::findAllUnderParent($user->id, "user_id");
$skills             = Skills::findAllUnderParent($user->id, "user_id");
$memberships        = Membership::findAllUnderParent($user->id, "user_id");
$employmentHistory  = EmploymentHistory::findAllUnderParent($user->id, "user_id");
$interests          = Interest::findAllUnderParent($user->id, "user_id");
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

                              <!-- about me -->
                              <div class="light-bx-shadow m-mid-bottom-breather">
                                    <div class="p-vlight-breather sec-bg p-mid-side-breather">
                                          <p class="headfont uppercase no-margin text-center">about me</p>
                                    </div>
                                    <div class="p-mid-side-breather p-light-breather">

                                          <div class="row m-mid-bottom-breather">

                                                <div class="col-sm-4 bioimage">
                                                      <img class="img-center img-circle" src="../img/candidate-placeholder.jpg" alt="">
                                                </div>

                                                <div class="col-sm-8 bio-details">
                                                      <p class="headfont lead no-margin">
                                                            <?php echo $user->fullName(); ?>
                                                      </p>
                                                      <!-- <p class="mid-font-size no-margin">PHP Developer | Lagos</p> -->
                                                      <p class="mid-font-size">
                                                            <?php echo $user->email; ?>
                                                      </p>
                                                      <p class="mid-font-size no-margin"><span class="txt-bold">Mobile:</span>
                                                            <?php echo $user->phone; ?>
                                                      </p>
                                                      <p class="mid-font-size"><span class="txt-bold">D.O.B: </span>
                                                            <?php echo $user->dob; ?>
                                                      </p>

                                                </div>
                                          </div>

                                          <!-- progress-bar -->
                                          <p class="no-margin small-font-size secheadfont capitalize">profile strength: 65%</p>
                                          <progress max="100" value="65" class=" m-vlight-bottom-breather">
                                                <!-- Browsers that support HTML5 progress element will ignore the html inside `progress` element. Whereas older browsers will ignore the `progress` element and instead render the html inside it. -->
                                                <div class="progress-bar">
                                                      <span style="width: 65%; height: inherit;"></span>
                                                </div>
                                          </progress>
                                          <!-- end .progress-bar -->

                                    </div>
                              </div>

                              <!-- shortlisted jobs -->
                              <div class="light-bx-shadow m-mid-bottom-breather">
                                    <div class="p-vlight-breather sec-bg p-mid-side-breather">
                                          <p class="headfont uppercase no-margin text-center">shortlisted jobs</p>
                                    </div>
                                    <div class="p-mid-side-breather p-light-breather">
                                          <p class="">You haven't shortlisted any jobs</p>
                                    </div>
                              </div>

                              <!-- applied jobs -->
                              <div class="light-bx-shadow m-mid-bottom-breather">
                                    <div class="p-vlight-breather sec-bg p-mid-side-breather">
                                          <p class="headfont uppercase no-margin text-center">applied jobs</p>
                                    </div>
                                    <div class="p-mid-side-breather p-light-breather">
                                          <p class="">You haven't applied for any job</p>
                                    </div>
                              </div>


                              <!-- sidebar form-->
                              <div class="light-bx-shadow m-mid-bottom-breather">

                                    <?php echo sideSearch($states, $seperator); ?>

                              </div>
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
                                          <form method="post" action="#" enctype="multipart/form-data">
                                                <div class="m-light-bottom-breather">
                                                      <ul class="no-list-style no-left-padding">
                                                            <li>The file size must not be more than <span class="txt-bold">500KB</span></li>
                                                            <li>File format must be any of these: <span class="txt-bold">.pdf, .docx, .doc </span></li>
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
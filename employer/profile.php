<?php $thisPage = "employer_profile"; $seperator="../"; $navbarType = "employer";
include_once("{$seperator}includes/initialize.php");

/* check user status */
if (!$session->isEmployerLoggedIn()) {redirect_to("{$seperator}login.php"); } 

$employer = Employer::findDetails($session->employerID);
// print_r($employer); exit;

// header
include_once("{$seperator}layout/dashboard-header.php"); ?>

<!--  main content  -->
<div class="inner-top my-profile">
      <div class=" p-heavy-breather">
            <div class="container">
                  <?php echo inline_message(); ?>

                  <div class="row">

                        <!-- sidebar -->
                        <div class="sidebar col-sm-4">
                              <?php echo employerSidebar($employer); ?>
                        </div>

                        <!-- mainbar -->
                        <div class="col-sm-8 mainbar">

                              <!-- employer details -->
                              <div class="employer_details">
                                    <div class="light-bx-shadow">
                                          <div class="p-vlight-breather sec-bg p-mid-side-breather m-vlight-bottom-breather">
                                                <p class="headfont uppercase no-margin">details </p>
                                          </div>

                                          <div class="p-light-bottom-breather p-mid-side-breather">
                                                <?php echo inline_message(); ?>
                                                <?php echo inline_errors(); ?>
                                          
                                                <div class="row">

                                                      <div class="col-sm-6">
                                                            <form action="<?php echo $seperator; ?>control/employer/settings.php" method="post" class="sm">
                                                                  <input type="hidden" name="details" value="details">

                                                                  <div class="form-group">
                                                                        <p class="mid-font-size capitalize no-margin txt-bold">company name</p>
                                                                        <input type="text" class="form-control" name="company_name" value="<?php if(!is_null($employer->company_name)){ echo $employer->company_name; } ?>">
                                                                  </div>

                                                                  <div class="form-group">
                                                                        <p class="mid-font-size capitalize no-margin txt-bold">Email</p>
                                                                        <input type="email" class="form-control" name="email" value="<?php if(!is_null($employer->email)){ echo $employer->email; } ?>">
                                                                  </div>

                                                                  <div class="form-group">
                                                                        <p class="mid-font-size capitalize no-margin txt-bold">phone number</p>
                                                                        <input type="tel" class="form-control" name="phone" value="<?php if(!is_null($employer->phone)){ echo $employer->phone; } ?>">
                                                                  </div>

                                                                  <div class="form-group">
                                                                        <p class="mid-font-size capitalize no-margin txt-bold">field</p>
                                                                        <select name="job_field" class="form-control">
                                                                              <?php echo jobFieldsAsInput($employer->job_field); ?>
                                                                        </select>
                                                                  </div>

                                                                  <div class="form-group">
                                                                        <p class="mid-font-size capitalize no-margin txt-bold">about company</p>
                                                                        <textarea class="form-control" name="about_company" rows="6">
                                                                              <?php if(!is_null($employer->about_company)){ echo (html_entity_decode($employer->about_company)); } ?>
                                                                        </textarea>
                                                                  </div>

                                                                  <div class="form-group">
                                                                        <p class="mid-font-size capitalize no-margin txt-bold">address</p>
                                                                        <textarea class="form-control" name="address" rows="6">
                                                                              <?php if(!is_null($employer->address)){ echo (html_entity_decode($employer->address)); } ?>
                                                                        </textarea>
                                                                  </div>

                                                                  <input class="btn sec-btn form-control" type="submit" name="submit" value="Update Profile">

                                                            </form>
                                                      </div>

                                                      <div class="col-sm-6">

                                                            <!-- password -->
                                                            <div class="m-light-bottom-breather">

                                                                  <p class="capitalize no-margin txt-bold">Password</p>
                                                                  <p class="mid-font-size">
                                                                        <a href="" class="" id="chng-pwd">Change Password</a>
                                                                  </p>

                                                                  <!-- password form -->
                                                                  <div class="hide-el" id="pswd-div">

                                                                        <form action="<?php echo $seperator; ?>control/employer/settings.php" method="post" class="sm">

                                                                              <div class="form-group">
                                                                                    <label class="capitalize small-font-size">Enter your old password</label>
                                                                                    <input class="form-control" type="password" name="password" placeholder="Enter your old password">
                                                                              </div>

                                                                              <div class="form-group">
                                                                                    <label class="capitalize small-font-size">Enter your new password</label>
                                                                                    <input class="form-control" type="password" name="new_password" placeholder="Enter your new password">
                                                                              </div>

                                                                              <div class="form-group">
                                                                                    <label class="capitalize small-font-size">confirm your new password</label>
                                                                                    <input class="form-control" type="password" name="confirm_password" placeholder="Confirm your new password">
                                                                              </div>

                                                                              <div class="row">
                                                                                    <div class="col-sm-8">
                                                                                          <input type="submit" name="submit" value="submit" class="capitalize btn sec-btn form-control">
                                                                                    </div>

                                                                                    <div class="col-sm-4">
                                                                                          <a href="" class="btn main-btn capitalize form-control" id="cx-pswd">cancel</a>
                                                                                    </div>
                                                                              </div>
                                                                        </form>
                                                                  </div>

                                                            </div>

                                                            <!-- avatar -->
                                                                  <div class="m-light-bottom-breather">
                                                                        <p class="capitalize no-margin txt-bold m-vlight-bottom-breather">profile avatar </p>
                                                                        <p class="mid-font-size capitalize">
                                                                              <?php if($employer->avatar_url): ?>
                                                                              <img src="<?php echo $employer->avatar_url; ?>" class="img-responsive" style="width: 100px;">
                                                                              <?php else: ?>
                                                                              <img src="<?php echo $seperator; ?>img/company.png" class="img-responsive" style="width: 100px;">
                                                                              <?php endif; ?>
                                                                              <a href="" class="" id="chng-avtr">change avatar </a>
                                                                        </p>

                                                                        <!-- avatar form -->
                                                                        <div class="hide-el" id="avtr-div">
                                                                              <form method="post" class="sm" action="<?php echo $seperator; ?>control/employer/settings.php" enctype="multipart/form-data">
                                                                                    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo maxFileSize(); ?>">

                                                                                    <?php if(!empty($employer->avatar)): ?>
                                                                                    <input type="hidden" name="type" value="1">
                                                                                    <?php endif; ?>

                                                                                    <div class="form-group">
                                                                                          <label class="capitalize small-font-size">browse to select a new avatar </label>
                                                                                          <input class="" type="file" name="avatar">
                                                                                    </div>
                                                                                    <div class="row">
                                                                                          <div class="col-sm-8">
                                                                                                <input type="submit" name="submit" value="submit" class="btn sec-btn form-control capitalize">
                                                                                          </div>
                                                                                          <div class="col-sm-4">
                                                                                                <a href="" class="form-control capitalize btn main-btn" id="cx-avtr">cancel</a>
                                                                                          </div>
                                                                                    </div>

                                                                              </form>
                                                                        </div>

                                                                  </div>
                                                            




                                                      </div>




                                                </div>

                                          </div>

                                    </div>

                              </div> <!-- end employer details -->

                        </div>
                        <!-- end .mainbar -->

                  </div>

            </div>
      </div>
</div>
<!-- end main content -->

<script>
</script>

<!-- footer -->
<?php include_once("{$seperator}layout/footer.php"); ?>
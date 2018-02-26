<?php $thisPage = "registration";
$seperator = "../";
$navbarType = "intern";
include_once("{$seperator}includes/initialize.php");

/* check user status */
if (!$session->isInternLoggedIn()) {
      redirect_to("{$seperator}login.php");
}

// Form Submission and redirection to control file
if ($_POST['submit']) {

      $session->postValues($_POST);
      $session->fileValues($_FILES);
      
      $action = "{$seperator}control/intern/register.php";
      redirect_to($action);

}


$intern = Intern::findDetails($session->internID);
$internRegistration = InternshipDetails::findByInternID($intern->id);

// header
include_once("{$seperator}layout/dashboard-header.php"); ?>

<!--  main content  -->
<div class="inner-top my-profile">
      <div class=" p-heavy-breather">
            <div class="container">

                  <div class="row">

                        <!-- sidebar -->
                        <div class="sidebar col-sm-4">
                              <?php echo internSidebar($intern); ?>
                        </div>

                        <!-- mainbar -->
                        <div class="col-sm-8 mainbar">


                              <?php if(!$internRegistration): ?>
                              <div class="light-bx-shadow">
                                    <div class="p-vlight-breather sec-bg p-mid-side-breather m-vlight-bottom-breather">
                                          <p class="headfont uppercase no-margin">Register an internship spot here. </p>
                                    </div>

                                    <div class="p-light-bottom-breather p-mid-side-breather">
                                          <?php echo inline_errors(); ?>
                                          <?php echo inline_message(); ?>
                                          <?php echo internReg(); ?>
                                    </div>

                              </div>

                              <?php else : ?>
                              <div class="light-bx-shadow">
                                    <div class="p-vlight-breather sec-bg p-mid-side-breather m-vlight-bottom-breather">
                                          <p class="headfont uppercase no-margin">You've already registered a spot. </p>
                                    </div>

                                    <div class="p-light-bottom-breather p-mid-side-breather">
                                          <?php echo inline_message(); ?>
                                          <?php echo internRegDetails($internRegistration); ?>
                                    </div>

                              </div>

                              <?php endif; ?>

                              <!-- end personal details -->

                        </div>
                        <!-- end .mainbar -->

                  </div>

            </div>
      </div>
</div>
<!-- end main content -->

<!-- footer -->
<?php include_once("{$seperator}layout/footer.php"); ?>
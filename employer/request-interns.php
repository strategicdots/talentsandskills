<?php $thisPage = "employer_profile"; $seperator = "../"; $navbarType = "employer";
include_once("{$seperator}includes/initialize.php");

/* check user status */
if (!$session->isEmployerLoggedIn()) {
      $session->message("First, you have to login.");
      redirect_to("{$seperator}login.php");
}

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

                              

                        </div>
                        <!-- end .mainbar -->

                  </div>

            </div>
      </div>
</div>
<!-- end main content -->

<!-- footer -->
<?php include_once("{$seperator}layout/footer.php"); ?>
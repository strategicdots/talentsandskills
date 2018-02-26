<?php $thisPage = "dashboard"; $seperator = "../../"; $navbarType = "intern";
include_once("{$seperator}includes/initialize.php");

// Form Submission and redirection to control file
if ($_POST['submit']) {

      $session->postValues($_POST);
      $action = "{$seperator}control/intern/accept-request.php?employer={$_POST['id']}";
      redirect_to($action);

}

$intern = Intern::findDetails($session->internID);

/* check user status */
if (!$session->isInternLoggedIn()) {
      $session->message("First, you have to login.");
      redirect_to("{$seperator}login.php");

} 

/* check ID of employer */
if (!$_GET && !isset($_GET['id'])) {
      redirect_to("{$seperator}intern/dashboard.php");
}

$employer = Employer::findDetails($_GET['id']);
?>

<!-- header -->
<?php include_once("{$seperator}layout/dashboard-header.php"); ?>

<!--  main content  -->
<div class="inner-top dashboard">
      <div class=" p-light-breather">

            <div class="container m-heavy-top-breather">

                  <!-- sidebar -->
                  <div class="sidebar col-sm-4">
                        <?php echo internSidebar($intern); ?>
                  </div>

                  <!-- mainbar -->
                  <div class="col-sm-8 mainbar">
                        <div class="">
                              <!-- employer details -->
                              <div class="light-bx-shadow">
                                    <div class="p-vlight-breather sec-bg p-mid-side-breather m-vlight-bottom-breather">
                                          <p class="headfont uppercase no-margin">about employer</p>
                                    </div>
                                    <div class="p-light-bottom-breather p-mid-side-breather">
                                          <?php echo inline_message(); ?>

                                          <!-- about employer -->
                                          <?php if (!empty($employer->about_company)) : ?>
                                          <div class="m-mid-bottom-breather">
                                                <p class="lead no-margin txt-bold capitalize">
                                                      <?php echo $employer->company_name; ?>
                                                </p>
                                                <p>
                                                      <?php echo nl2br($employer->about_company); ?> </p>
                                          </div>
                                          <?php endif; ?>

                                          <!-- acceptance btn -->
                                          <div class="m-mid-breather">
                                                <button data-toggle="modal" data-target="#infoPrompt" class="btn main-btn capitalize">accept the request</button>

                                          </div>
                                    </div>
                              </div>
                        </div>
                  </div>

            </div>

      </div>

</div>



<!-- modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="infoPrompt">
      <div class="modal-dialog" role="document">
            <div class="modal-content">

                  <!-- header -->
                  <div class="modal-header sec-bg">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title capitalize">confirm your request</h4>
                  </div>

                  <!-- body -->
                  <div class="modal-body">
                        <p>You've been selected by
                              <span class="secbrandtxt-color txt-bold capitalize">
                                    <?php echo $employer->company_name; ?>
                              </span> for internship in it's company. Here are some things you need to understand once you've
                              accepted this request</p>
                        <ul class="">
                              <li>Your profile (including your contact details) will be visible to the employer</li>
                              <li>The employer is obliged to contact you as regards placement and other details</li>
                              <li>Your internship application will be deleted, this is to give room for other interns</li>
                              <li>Should you require to fill another application, just go the application page.</li>
                        </ul>

                  </div>

                  <!-- footer -->
                  <div class="modal-footer">
                        <form method="post" action="">
                              <input type="submit" name="submit" class="btn capitalize main-btn" value="accept request">
                              <input type="hidden" name="id" value="<?php echo $employer->id; ?>">
                              <button type="button" class="btn del-btn" data-dismiss="modal">Close</button>
                        </form>
                  </div>
            </div>
      </div>
</div>

<!-- footer -->
<?php include_once("{$seperator}layout/footer.php"); ?>
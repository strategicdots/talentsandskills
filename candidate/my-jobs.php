<?php $thisPage = "my-jobs"; $seperator="../"; 
include_once("{$seperator}includes/initialize.php");

/* check user status */
if (!$session->isCandidateLoggedIn()) {redirect_to("{$seperator}login.php"); } 

$candidate        = Candidate::findDetails($session->candidateID);
$applications     = Application::findAllUnderParent($candidate->id, "user_id", $order = true);

// header
include_once("{$seperator}layout/dashboard-header.php"); ?>

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
                
                <div class="jobs m-mid-bottom-breather">
                    <div class="light-bx-shadow">
                        <div class="p-vlight-breather sec-bg p-mid-side-breather m-vlight-bottom-breather">
                            <p class="headfont uppercase no-margin">recently applied jobs </p>
                        </div>
                        <div class="p-light-bottom-breather p-mid-side-breather">
                              <?php echo inline_message(); ?>

                                <?php if(!$applications): ?>
                                <p>You haven't applied for any job yet. <a href="job-search.php">Click Here</a> to search for jobs</p>

                                <?php else: ?>

                                <?php echo candidateApplications($applications); ?>
                                
                                <?php endif; ?>
                        </div>

                    </div>

                </div> <!-- end .new jobs-->

            </div> <!-- end .mainbar -->
            </div>
           
        </div>
    </div>

</div>
<!-- end main content -->

<!-- footer -->
<?php include_once("{$seperator}layout/footer.php"); ?>
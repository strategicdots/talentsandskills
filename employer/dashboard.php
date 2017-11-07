<?php $thisPage = "dashboard"; $seperator="../"; 
include_once("{$seperator}includes/initialize.php");

/* check user status */
if (!$session->isEmployerLoggedIn()) {redirect_to("{$seperator}login.php"); } 
 
$employer = Employer::findDetails($session->employerID);
$jobsPosted = Jobs::findAllUnderParent($employer->id, "employer_id", $order = true);

?>

<!-- header -->
<?php include_once("{$seperator}layout/em-dashboard-header.php"); ?>
<!--  end header -->

<!--  main content  -->
<div class="inner-top dashboard">
    <div class=" p-heavy-breather">
        <div class="container">

            <div class="row">
                
                <!-- sidebar -->
                <div class="sidebar col-sm-4">
                   <?php echo employerSidebar($employer); ?>
                </div>

                <!-- mainbar -->
                <div class="col-sm-8 mainbar">

                    <div class="jobs m-mid-bottom-breather">
                        <div class="light-bx-shadow">
                            <div class="p-vlight-breather sec-bg p-mid-side-breather m-vlight-bottom-breather">
                                <p class="headfont uppercase no-margin">your job postings</p>
                            </div>
                            <div class="p-light-bottom-breather p-mid-side-breather">

                                <?php echo inline_message(); ?>

                                <?php if(!$jobsPosted): ?>
                                <p>You don't have any job postings yet. <a href="create-job.php">Click Here</a> to create one</p>

                                <?php else: ?>

                                <?php echo jobPosted($jobsPosted); ?>
                                
                                <?php endif; ?>
                            </div>

                        </div>

                    </div> <!-- end jobs-->
                    
                    <!-- orders -->
                    <div class="orders m-mid-bottom-breather">
                        <div class="light-bx-shadow">
                            <div class="p-vlight-breather sec-bg p-mid-side-breather m-vlight-bottom-breather">
                                <p class="headfont uppercase no-margin">my orders</p>
                            </div>
                            <div class="p-light-bottom-breather p-mid-side-breather">
                                <p>You don't have any order.</p>
                            </div>

                        </div>

                    </div> <!-- end orders-->

                    <!-- settings -->
                    <div class="orders m-mid-bottom-breather">
                        <div class="light-bx-shadow">
                            <div class="p-vlight-breather sec-bg p-mid-side-breather m-vlight-bottom-breather">
                                <p class="headfont uppercase no-margin">settings</p>
                            </div>
                            <div class="p-light-bottom-breather p-mid-side-breather">
                                <p></p>
                            </div>

                        </div>

                    </div> <!-- end orders-->

                </div>
                <!-- end .mainbar -->

            </div>
            <!-- end .sidebar -->
        </div>
    </div>

</div>
<!-- end main content -->

<!-- footer -->
<?php include_once("{$seperator}layout/footer.php"); ?>
<?php $thisPage = "jobs"; $seperator="../"; 
include_once("{$seperator}includes/initialize.php");

$referer = $_SERVER['HTTP_REFERER'];

/* check employer status */
if (!$session->isEmployerLoggedIn()) { redirect_to("{$seperator}login.php"); } 
$employer = Employer::findDetails($session->employerID);

// $_GET['id'] must be set
if(!isset($_GET['id']) || empty($_GET['id'])) { redirect_to($referer); }

/***
 * find applicant and make sure applicant applied for job from employer
 * if not, redirect to referer 
*/

// 1. find candidate and redirect to referer if not found
$candidate = Candidate::findDetails(trim($_GET['id']));
if(!$candidate) { redirect_to($referer); }

// 2. find if candidate applied for job, if not redirect to referer
$applicant = Application::findAllUnderParent($candidate->id, "user_id");

// 3. find job details, if not redirect to referer
$job = Jobs::findDetails($applicant[0]->job_id);
if(!$job) {redirect_to($referer); }

// 4. check if $job->employer_id == $employer->id, if not redirect to referer
if($job->employer_id !== $employer->id) { redirect_to($referer); }


// header
 include_once("{$seperator}layout/em-dashboard-header.php"); ?>

<!--  main content  -->
<div class="inner-top dashboard">
    <div class=" p-heavy-breather">
        <div class="container">

            <div class="row">

                <!-- sidebar -->
                <div class="sidebar col-sm-4">
                    <?php echo employerSidebar($employer); ?>
                </div>
                <!-- end .sidebar -->

                <!-- mainbar -->
                <div class="jobs col-sm-8">
                    <div class="light-bx-shadow m-mid-bottom-breather">
                        <div class="p-vlight-breather sec-bg p-mid-side-breather m-vlight-bottom-breather">
                            <p class="headfont uppercase no-margin">applicant summary</p>
                        </div>

                        <div class="p-light-bottom-breather p-mid-side-breather">

                            <!-- job details -->
                            <div class="row m-vlight-bottom-breather">
                                <div class="col-sm-3">
                                    <p class="mid-font-size capitalize no-margin txt-bold"> job title:</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="mid-font-size no-margin">
                                        <?php echo $job->title; ?>
                                    </p>
                                </div>
                            </div>

                            <div class="row m-vlight-bottom-breather">
                                <div class="col-sm-3">
                                    <p class="mid-font-size capitalize no-margin txt-bold"> deadline:</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="mid-font-size no-margin">
                                        <?php echo jobDeadline($job->deadline, "Expired"); ?>
                                    </p>
                                </div>
                            </div>

                            <div class="row m-vlight-bottom-breather">
                                <div class="col-sm-3">
                                    <p class="mid-font-size capitalize no-margin txt-bold"> no. of applicants</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="mid-font-size no-margin">
                                        <?php echo $applicationNumber; ?>
                                    </p>
                                </div>
                            </div>

                            <?php if($applicationNumber > 0): 

                                echo jobApplicants($applications, $employer->subscription);
                                
                                // check if employer is an active subscriber
                                if(empty($employer->subscription)): ?>
                                <p>Please <a href="subscription.php">subscribe to one of our packages</a> to have access to the remaining applicants</p>
                                
                                <?php endif; endif; ?>

                            <!-- edit and delete btns -->
                            <div class="small-font-size m-vlight-bottom-breather m-mid-top-breather">
                                <a class="btn sec-btn" href="create-job.php?id=<?php echo $job->id; ?>">Edit Job</a>
                                <a class="btn del-btn" href="delete-job.php?id=<?php echo $job->id; ?>">Delete Job</a>
                            </div>

                        </div>

                    </div>

                </div>
                <!-- end .featured-jobs-->

            </div>
            <!-- end .mainbar -->

        </div>

    </div>
    <!-- end main content -->

    <!-- footer -->
    <?php include_once("{$seperator}layout/footer.php"); ?>
<?php $thisPage = "dashboard"; $seperator="../"; $navbarType = "candidate"; 
include_once("{$seperator}includes/initialize.php");

/* check user status */
if (!$session->isCandidateLoggedIn()) {redirect_to("{$seperator}login.php"); } 

// Form Submission and redirection to control file
if ($_POST['submit']) {

    $session->postValues($_POST);
    $session->fileValues($_FILES);

    $action = "{$seperator}control/candidate/cv.php";
    redirect_to($action);

}

// pagination
$newJobs = Jobs::newJobs();
$per_page = (int) 5;
$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
$total_count = count($newJobs);

$pagination = new Pagination($page, $per_page, $total_count);
$pagination->load($newJobs);
$jobsPerPage = $pagination->pageItems();

$candidate          = Candidate::findDetails($session->candidateID);
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
                    <?php echo inline_message(); ?>
                    
                    <?php if(empty($candidate->cv_path)) : ?>
                    <div class="m-mid-bottom-breather">
                        <div class="light-bx-shadow">
                            <div class="p-vlight-breather sec-bg p-mid-side-breather m-vlight-bottom-breather">
                                <p class="headfont uppercase no-margin">upload your resume / cv here</p>
                            </div>


                            <div class="p-light-bottom-breather p-mid-side-breather">
                                <!-- cv form -->
                                <?php echo inline_errors(); ?>
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

                    </div>
                    <?php endif; ?>

                    <div class="jobs m-mid-bottom-breather">
                        <div class="light-bx-shadow">
                            <div class="p-vlight-breather sec-bg p-mid-side-breather m-vlight-bottom-breather">
                                <p class="headfont uppercase no-margin">recent jobs on talents and skills </p>
                            </div>
                            
                            <div class="p-light-bottom-breather p-mid-side-breather">
                                <ul class="no-list-style no-left-padding">
                                    <?php foreach($jobsPerPage as $job): ?>
                                    <li>
                                        <a href="job.php?id=<?php echo $job->id; ?>">
                                            <?php echo ucwords($job->title); ?>
                                        </a>
                                    </li>

                                    <?php endforeach; ?>
                                </ul>

                                <!-- pagination buttons -->
                                <?php echo paginationNavigation($pagination, $page); ?>
                            </div>

                        </div>

                    </div> <!-- end .new jobs-->

                    <div class="blog m-mid-top-breather">
                        <div class="light-bx-shadow">
                            <div class="p-vlight-breather sec-bg p-mid-side-breather m-vlight-bottom-breather">
                                <p class="headfont uppercase no-margin">profile settings</p>
                            </div>
                            <div class="p-light-bottom-breather p-mid-side-breather">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="">
                                            <p class="mid-font-size capitalize no-margin txt-bold">Email</p>
                                            <p class="small-font-size">
                                                <?php 
                                                    if(isset($candidate->email)) {echo $candidate->email; } 
                                                    else { echo "You don't have any email in our records"; }
                                                ?>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="">
                                            <p class="mid-font-size capitalize no-margin txt-bold">Phone Number</p>
                                            <p class="small-font-size">
                                                <?php 
                                            if(isset($candidate->phone)) {echo $candidate->phone; } 
                                            else { echo "You don't have any phone number in our records"; }
                                        ?>
                                            </p>

                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="">
                                            <p class="mid-font-size capitalize no-margin txt-bold">Date of Birth</p>
                                            <p class="small-font-size">
                                                <?php 
                                            if(isset($candidate->dob)) {echo $candidate->dob; } 
                                            else { echo "You haven't updated your date of birth"; }
                                        ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row m-light-top-breather">

                                    <div class="col-sm-4">
                                        <div class="">
                                            <p class="mid-font-size capitalize no-margin txt-bold">Gender</p>
                                            <p class="small-font-size">
                                                <?php 
                                                    if(isset($candidate->gender)) {echo $candidate->gender; } 
                                                    else { echo "You haven't updated your gender status"; }
                                                ?>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="">
                                            <p class="mid-font-size capitalize no-margin txt-bold">Location</p>
                                            <p class="small-font-size">
                                                <?php 
                                                    if(isset($candidate->location)) {echo $candidate->location; } 
                                                    else { echo "You haven't updated your current location"; }
                                                ?>
                                            </p>
                                        </div>
                                    </div>

                                </div>

                                <div class="clearfix m-mid-top-breather sm-container">
                                    <a href="my-profile.php" class="btn sec-btn capitalize form-control">update your profile</a>
                                </div>
                            </div>

                        </div>



                    </div>
                    <!-- end .featured-jobs-->


                </div> <!-- end .mainbar -->

            </div> <!-- end .row -->
        </div><!-- end .container -->
    </div>

</div>
<!-- end main content -->

<!-- footer -->
<?php include_once("{$seperator}layout/footer.php"); ?>
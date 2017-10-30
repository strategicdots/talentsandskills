<?php $thisPage = "dashboard"; $seperator="../"; 
include_once("{$seperator}includes/initialize.php");

/* check user status */
if (!$session->isCandidateLoggedIn()) {redirect_to("{$seperator}login.php"); } 
 
$user               = User::findDetails($session->candidateID);
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
                    <?php echo candidateSidebar($user); ?>
                </div>

                <!-- mainbar -->
                <div class="col-sm-8 mainbar">
                    <?php echo inline_message(); ?>
                    <!-- <div class=" biodata p-heavy-side-breather light-bx-shadow white-bg p-heavy-breather">
                        <div class="row"> -->
                    <!-- <div class="col-sm-2 bioimage">
                                <img class="img-center img-circle" src="../img/candidate-placeholder.jpg" alt="">
                            </div> -->

                    <!-- <div class="col-sm-10 bio-details">
                                <div class="row">
                                    <div class="col-sm-7">
                                        <h1 class="bio-name">Yusuf Rafiu</h1>
                                        <h3 class="discpln secheadfont">PHP Developer
                                            <span class="">|</span> Lagos</h3>
                                    </div>
                                    <div class="col-sm-5">
                                    </div>
                                </div>

                                <p class="no-margin small-font-size secheadfont capitalize">profile strength: 65%</p>
                                <progress max="100" value="65" class="no-margin">

                                    <div class="progress-bar">
                                        <span style="width: 65%; height: inherit;"></span>
                                    </div>
                                </progress>

                            </div> -->
                    <!-- </div>
                    </div> -->
                    <!-- end .biodata -->

                    <?php if(empty($user->cv_path)) : ?>
                    <div class="m-mid-bottom-breather">
                        <div class="light-bx-shadow">
                            <div class="p-vlight-breather sec-bg p-mid-side-breather m-vlight-bottom-breather">
                                <p class="headfont uppercase no-margin">upload your resume / cv here</p>
                            </div>


                            <div class="p-light-bottom-breather p-mid-side-breather">
                                <!-- cv form -->
                                <?php echo inline_errors(); ?>
                                <form method="post" action="<?php echo $seperator; ?>control/candidate/cv.php" enctype="multipart/form-data">
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
                                <p class="headfont uppercase no-margin">new jobs on talents and skills </p>
                            </div>
                            <?php $newJobs = Jobs::newJobs(); ?>
                            <div class="p-light-bottom-breather p-mid-side-breather">
                                <ul class="no-list-style no-left-padding">
                                    <?php foreach($newJobs as $job): ?>
                                    <li>
                                        <a href="">
                                            <?php echo ucwords($job->title); ?>
                                        </a>
                                    </li>

                                    <?php endforeach; ?>
                                </ul>
                            </div>

                        </div>

                    </div>
                    <!-- end .new jobs-->

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
                                                    if(isset($user->email)) {echo $user->email; } 
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
                                            if(isset($user->phone)) {echo $user->phone; } 
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
                                            if(isset($user->dob)) {echo $user->dob; } 
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
                                                    if(isset($user->gender)) {echo $user->gender; } 
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
                                                    if(isset($user->location)) {echo $user->location; } 
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
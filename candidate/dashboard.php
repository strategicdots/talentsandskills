<?php $thisPage = "dashboard"; $seperator="../"; 
include_once("{$seperator}includes/initialize.php");

/* check user status */
if (!$session->isLoggedIn()) {redirect_to("{$seperator}login.php"); } 
 
$user               = User::findDetails($session->id);
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

                            <!-- upload cv button -->
                            <?php if(!$user->cv_path): ?>
                            <div class=""><a href="upload-cv.php" class="uppercase btn sec-btn btn-max">upload your cv</a></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- sidebar form-->
                    <div class="light-bx-shadow m-mid-bottom-breather">

                        <?php echo sideSearch($states, $seperator); ?>

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

                </div>

                <!-- mainbar -->
                <div class="col-sm-8 mainbar">
                    <div class=" biodata p-heavy-side-breather light-bx-shadow white-bg p-heavy-breather">
                        <div class="row">
                            <div class="col-sm-2 bioimage">
                                <img class="img-center img-circle" src="../img/candidate-placeholder.jpg" alt="">
                            </div>
                            <div class="col-sm-10 bio-details">
                                <div class="row">
                                    <div class="col-sm-7">
                                        <h1 class="bio-name">Yusuf Rafiu</h1>
                                        <h3 class="discpln secheadfont">PHP Developer <span class="">|</span> Lagos</h3>
                                    </div>
                                    <div class="col-sm-5">
                                        <!--<p class="">Your profile is 65% complete. </p>-->
                                    </div>
                                </div>

                                <!-- progress-bar -->
                                <p class="no-margin small-font-size secheadfont capitalize">profile strength: 65%</p>
                                <progress max="100" value="65" class="no-margin">
                                    <!-- Browsers that support HTML5 progress element will ignore the html inside `progress` element. Whereas older browsers will ignore the `progress` element and instead render the html inside it. -->
                                    <div class="progress-bar">
                                        <span style="width: 65%; height: inherit;"></span>
                                    </div>
                                </progress>

                                <!-- end .progress-bar -->

                            </div>
                        </div>
                    </div>
                    <!-- end .biodata -->

                    <div class="jobs m-mid-top-breather">
                        <div class="light-bx-shadow">
                            <div class="p-vlight-breather gray-bg p-mid-side-breather m-vlight-bottom-breather">
                                <p class="headfont uppercase no-margin">Featured jobs</p>
                            </div>
                            <?php $featuredJobs = Jobs::featuredJobs(); ?>
                            <div class="p-light-bottom-breather p-mid-side-breather">
                                <ul class="no-list-style no-left-padding">
                                    <?php foreach($featuredJobs as $job): ?>
                                    <li><a href=""><?php echo ucwords($job->title); ?></a></li>

                                    <?php endforeach; ?>
                                </ul>
                            </div>

                        </div>



                    </div>
                    <!-- end .featured-jobs-->

                    <div class="blog m-mid-top-breather">
                        <div class="light-bx-shadow">
                            <div class="p-vlight-breather gray-bg p-mid-side-breather m-vlight-bottom-breather">
                                <p class="headfont uppercase no-margin">talentandskills career advice and articles</p>
                            </div>
                            <div class="p-light-bottom-breather p-mid-side-breather">
                                <ul class="no-list-style no-left-padding">
                                    <li><a href="">acountant manager at JUMIA Nigeria</a></li>
                                    <li><a href="">senior marketing manager at GE</a></li>
                                    <li><a href="">Graduate Trainee at Stanbic IBTC</a></li>
                                    <li><a href="">trained accountant at FARGO Nigeria</a></li>
                                    <li><a href=""> manager at KONGA Nigeria</a></li>
                                </ul>
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
</div>
<!-- end main content -->

<!-- footer -->
<?php include_once("{$seperator}layout/footer.php"); ?>
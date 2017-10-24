<?php $thisPage = "settings"; $seperator="../"; 
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

                            <?php if(!$user->cv_path): ?>
                            <!-- upload cv button -->
                            <div class=""><a href="upload-cv.php" class="uppercase btn sec-btn btn-max">upload your cv</a></div>
                            <?php endif; ?>
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


                    <!-- sidebar form-->
                    <?php echo sideSearch($states, $seperator); ?>

                </div>

                <!-- mainbar -->
                <div class="col-sm-8 mainbar">

                    <!-- account settings -->
                    <div class="">
                        <div class="light-bx-shadow">
                            <div class="p-vlight-breather sec-bg p-mid-side-breather m-vlight-bottom-breather">
                                <p class="headfont uppercase no-margin">account settings </p>
                            </div>

                            
                            <div class="p-light-bottom-breather p-mid-side-breather">
                                
                                   <div class=" m-light-bottom-breather">
                                    
                                    <p>This is the settings page</p>
                                </div>
                                
                            </div>

                        </div>

                    </div> <!-- account settings -->

                    
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
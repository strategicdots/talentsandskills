<?php $thisPage = "my-profile"; $seperator="../"; 
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

                    <!-- personal details -->
                    <div class="pd">
                        <div class="light-bx-shadow">
                            <div class="p-vlight-breather sec-bg p-mid-side-breather m-vlight-bottom-breather">
                                <p class="headfont uppercase no-margin">personal details </p>
                            </div>

                            <div class="p-light-bottom-breather p-mid-side-breather">
                                <div class=" m-light-bottom-breather">
                                    <?php if(!is_null($user->personal_statement)): ?>
                                    <p class="capitalize"><span class="txt-bold">Personal Statement:</span>
                                        <?php echo $user->personal_statement; ?> </p>

                                    <?php else: ?>
                                    <p class="capitalize">You don't have any personal statement. <a href="update-profile.php?type=personal_details">click here</a> to add one</p>
                                    <?php endif; ?>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="">
                                            <p class="mid-font-size capitalize no-margin txt-bold">Email</p>
                                            <p class="small-font-size capitalize" data-post="email">
                                                <?php echo $user->email; ?>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="">
                                            <p class="mid-font-size capitalize no-margin txt-bold">Phone Number</p>
                                            <p class="small-font-size capitalize" data-post="phone">
                                                <?php echo $user->phone; ?> </p>

                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="">
                                            <p class="mid-font-size capitalize no-margin txt-bold">Date of Birth</p>
                                            <p class="small-font-size capitalize" data-post="dob">
                                                <?php echo $user->dob; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row m-light-top-breather">

                                    <div class="col-sm-4">
                                        <div class="">
                                            <p class="mid-font-size capitalize no-margin txt-bold">Gender</p>
                                            <p class="small-font-size capitalize" data-post="gender">
                                                <?php echo $user->gender; ?>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="">
                                            <p class="mid-font-size capitalize no-margin txt-bold">Location</p>
                                            <p class="small-font-size capitalize" data-post="location">
                                                <?php echo $user->location; ?>
                                            </p>
                                        </div>
                                    </div>

                                </div>

                                <div class="clearfix small-font-size">
                                    <a href="update-profile.php?type=personal_details" id="" class="btn sec-btn capitalize pull-right">edit</a>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- personal details -->

                    <!-- career summary-->
                    <div class="m-mid-top-breather cs">
                        <div class="light-bx-shadow">
                            <div class="p-vlight-breather sec-bg p-mid-side-breather m-vlight-bottom-breather">
                                <p class="headfont uppercase no-margin">career summary</p>
                            </div>

                            <div class="errors hide-el" id="">
                                <ul id="cs-errors">
                                </ul>
                            </div>
                            <div class="p-light-bottom-breather p-mid-side-breather" id="di-cs">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="">
                                            <p class="mid-font-size capitalize no-margin txt-bold">desired job type</p>
                                            <p class="small-font-size capitalize" data-post="job_title">
                                                <?php echo $desiredJob[0]->job_title; ?>
                                            </p>
                                            <p class="mid-font-size"></p>
                                        </div>

                                        <div class="m-vlight-top-breather">
                                            <p class="mid-font-size capitalize no-margin txt-bold">field</p>
                                            <p class="small-font-size capitalize" data-post="job_field">
                                                <?php echo $desiredJob[0]->job_field; ?>
                                            </p>
                                            <p class="mid-font-size"></p>
                                        </div>

                                        <div class="m-vlight-top-breather">
                                            <p class="mid-font-size capitalize no-margin txt-bold">avaliability</p>
                                            <p class="small-font-size capitalize" data-post="job_type">
                                                <?php echo $desiredJob[0]->job_type; ?>
                                            </p>
                                            <p class="mid-font-size"></p>
                                        </div>

                                    </div>

                                    <div class="col-sm-6">
                                        <div class="">
                                            <p class="mid-font-size capitalize no-margin txt-bold">prefered salary</p>
                                            <p class="small-font-size capitalize" data-post="salary_range">
                                                <?php echo $desiredJob[0]->salary_range; ?> (Monthly)</p>
                                            <p class="mid-font-size"></p>
                                        </div>

                                        <div class="m-vlight-top-breather">
                                            <p class="mid-font-size capitalize no-margin txt-bold">desired location</p>
                                            <p class="small-font-size capitalize" data-post="location">
                                                <?php echo $desiredJob[0]->location; ?>
                                            </p>
                                            <p class="mid-font-size"></p>
                                        </div>

                                    </div>

                                </div>

                                <div class="clearfix small-font-size">
                                    <a href="update-profile.php?type=career_summary" id="" class="btn sec-btn capitalize pull-right">edit</a>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- end career summary -->

                    <!-- education -->
                    <div class="m-mid-top-breather edu">
                        <div class="light-bx-shadow">
                            <div class="p-vlight-breather sec-bg p-mid-side-breather m-vlight-bottom-breather">
                                <p class="headfont uppercase no-margin">education</p>
                            </div>

                            <div class="errors hide-el" id="edu-errors">
                                <ul id="cs-errors">
                                </ul>
                            </div>

                            <div id="di-edu" class="p-light-bottom-breather p-mid-side-breather">
                                <?php foreach($schools as $school): ?>

                                <div class="row m-vlight-breather">
                                    <div class="col-sm-4">
                                        <div class="">
                                            <p class="mid-font-size capitalize no-margin txt-bold">
                                                <?php echo $school->course; ?>
                                            </p>
                                            <p class="small-font-size capitalize">
                                                <?php echo $school->degree; ?>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="">
                                            <p class="mid-font-size capitalize no-margin txt-bold">
                                                <?php echo $school->school; ?>
                                            </p>
                                            <p class="small-font-size capitalize">
                                                <?php echo $school->location; ?>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="">
                                            <p class="mid-font-size capitalize no-margin txt-bold">
                                                <?php echo $school->grade; ?>
                                            </p>
                                            <p class="small-font-size capitalize">Finished:
                                                <?php echo $school->year; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <?php endforeach; ?>
                                <div class="clearfix small-font-size">
                                    <a href="update-profile.php?type=education" id="" class="btn sec-btn capitalize pull-right">edit</a>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- end education -->

                    <!-- skills -->
                    <div class="m-mid-top-breather">
                        <div class="light-bx-shadow">
                            <div class="p-vlight-breather sec-bg p-mid-side-breather m-vlight-bottom-breather">
                                <p class="headfont uppercase no-margin">Professional skills</p>
                            </div>

                            <div class="p-light-bottom-breather p-mid-side-breather">

                                <?php foreach ($skills as $skill) : ?>
                                <p class="capitalize">
                                    <?php echo $skill->skill_name; ?> </p>
                                <?php endforeach; ?>

                                <div class="clearfix small-font-size">
                                <a href="update-profile.php?type=skills" id="" class="btn sec-btn capitalize pull-right">edit</a>
                            </div>

                            </div>

                        </div>



                    </div>
                    <!-- end skills -->

                    <!-- professional memberships -->
                    <div class="m-mid-top-breather">
                        <div class="light-bx-shadow">
                            <div class="p-vlight-breather sec-bg p-mid-side-breather m-vlight-bottom-breather">
                                <p class="headfont uppercase no-margin">professional memberships / certifications</p>
                            </div>
                            <div class="p-light-bottom-breather p-mid-side-breather">

                                <?php foreach($memberships as $member) : ?>
                                <div class="m-light-top-breather">
                                    <p class="mid-font-size capitalize no-margin txt-bold">
                                        <?php echo $member->organization; ?> </p>
                                    <p class="small-font-size capitalize">
                                        <?php echo $member->year; ?>
                                    </p>
                                </div>
                                <?php endforeach; ?>

                                <div class="clearfix small-font-size">
                                    <a href="update-profile.php?type=memberships" id="" class="btn sec-btn capitalize pull-right">edit</a>
                                </div>
                            </div>

                        </div>



                    </div>
                    <!-- end professional memberships -->

                    <!-- employment history -->
                    <div class="m-mid-top-breather">
                        <div class="light-bx-shadow">
                            <div class="p-vlight-breather sec-bg p-mid-side-breather m-vlight-bottom-breather">
                                <p class="headfont uppercase no-margin">employment history</p>
                            </div>
                            <div class="p-light-bottom-breather p-mid-side-breather">

                                <?php foreach($employmentHistory as $employment): ?>

                                <div class="row m-vlight-breather">
                                    <div class="col-sm-4">
                                        <div class="">
                                            <p class="mid-font-size capitalize no-margin txt-bold">employer</p>
                                            <p class="small-font-size capitalize">
                                                <?php echo $employment->employer; ?>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="">
                                            <p class="mid-font-size capitalize no-margin txt-bold">job title</p>
                                            <p class="small-font-size capitalize">
                                                <?php echo $employment->job_title; ?>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="">
                                            <p class="mid-font-size capitalize no-margin txt-bold">time span</p>
                                            <p class="small-font-size capitalize">
                                                <?php echo $employment->time_span; ?>
                                            </p>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <p class="mid-font-size capitalize no-margin txt-bold">Responsibilities</p>
                                        <p class="small-font-size capitalize">
                                            <?php echo $employment->responsibilities; ?>
                                        </p>
                                    </div>

                                </div>
                                <hr>

                                <?php endforeach; ?>
                                <div class="clearfix small-font-size">
                                    <a href="update-profile.php?type=employment_history" id="" class="btn sec-btn capitalize pull-right">edit</a>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- end employment history -->

                    <!-- interests -->
                    <div class="m-mid-top-breather">
                        <div class="light-bx-shadow">
                            <div class="p-vlight-breather sec-bg p-mid-side-breather m-vlight-bottom-breather">
                                <p class="headfont uppercase no-margin">interests</p>
                            </div>
                            <div class="p-light-bottom-breather p-mid-side-breather">

                                <p class="capitalize">
                                    <?php foreach($interests as $interest){ echo $interest->interest . ", "; } ?>
                                </p>

                                <div class="clearfix small-font-size">
                                    <a href="update-profile.php?type=interests" id="" class="btn sec-btn capitalize pull-right">edit</a>
                                </div>

                            </div>

                        </div>

                    </div>
                    <!-- end interests -->

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
<?php $thisPage = "my-profile"; $seperator="../"; 
include_once("{$seperator}includes/initialize.php");

/* check user status */
// if (!$session->isLoggedIn()) {redirect_to("{$seperator}login.php"); } 
$states = State::findAll();
$jobType = JobType::findAll();
$salaryRange = SalaryRange::findAll();

$user               = User::findDetails('1');
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
                                    <p class="headfont lead no-margin"><?php echo $user->fullName(); ?></p>
                                    <p class="mid-font-size no-margin">PHP Developer | Lagos</p>
                                    <p class="mid-font-size"><?php echo $user->email; ?></p>
                                    <p class="mid-font-size no-margin"><span class="txt-bold">Mobile:</span> <?php echo $user->phone; ?></p>
                                    <p class="mid-font-size"><span class="txt-bold">D.O.B: </span><?php echo $user->dob; ?></p>

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
                            <div class=""><a href="" class="uppercase btn sec-btn btn-max">upload your cv</a></div>
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

                            <div class="errors hide-el" id="">
                                <ul id="pd-errors">
                                </ul>
                            </div>

                            <div class="p-light-bottom-breather p-mid-side-breather" id="di-pd">
                                <div class=" m-light-bottom-breather">
                                    <?php if(!is_null($user->personal_statement)): ?>
                                    <p class="capitalize" data-post="personal_statement"><span class="txt-bold">Personal Statement:</span> <?php echo $user->personal_statement; ?> </p>

                                    <?php else: ?>
                                    <p class="capitalize">You don't have any personal statement. <a href="">click here</a> to add one</p>
                                    <?php endif; ?>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="">
                                            <p class="mid-font-size capitalize no-margin txt-bold">Email</p>
                                            <p class="small-font-size capitalize" data-post="email"><?php echo $user->email; ?></p>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="">
                                            <p class="mid-font-size capitalize no-margin txt-bold">Phone Number</p>
                                            <p class="small-font-size capitalize" data-post="phone"><?php echo $user->phone; ?> </p>

                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="">
                                            <p class="mid-font-size capitalize no-margin txt-bold">Date of Birth</p>
                                            <p class="small-font-size capitalize" data-post="dob"><?php echo $user->dob; ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row m-light-top-breather">

                                    <div class="col-sm-4">
                                        <div class="">
                                            <p class="mid-font-size capitalize no-margin txt-bold">Gender</p>
                                            <p class="small-font-size capitalize" data-post="gender"><?php echo $user->gender; ?></p>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="">
                                            <p class="mid-font-size capitalize no-margin txt-bold">Location</p>
                                            <p class="small-font-size capitalize" data-post="location"><?php echo $user->location; ?></p>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="">
                                            <p class="mid-font-size capitalize no-margin txt-bold">Current Employer</p>
                                            <p class="small-font-size capitalize" data-post="employer"> <?php echo $user->employer; ?></p>
                                        </div>
                                    </div>

                                </div>

                                <div  class="clearfix small-font-size">
                                    <button id="ed-pd" class="btn sec-btn capitalize pull-right">edit</button>
                                </div>
                            </div>

                            <!-- personal details edit form -->
                            <div class="p-light-bottom-breather p-mid-side-breather hide-el" id="di-pd-f">
                                <?php echo pDForm($user); ?>
                            </div>
                        </div>

                    </div> <!-- personal details -->

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
                                            <p class="small-font-size capitalize" data-post="job_title"><?php echo $desiredJob[0]->job_title; ?></p>
                                            <p class="mid-font-size"></p>
                                        </div>

                                        <div class="m-vlight-top-breather">
                                            <p class="mid-font-size capitalize no-margin txt-bold">field</p>
                                            <p class="small-font-size capitalize" data-post="job_field"><?php echo $desiredJob[0]->job_field; ?></p>
                                            <p class="mid-font-size"></p>
                                        </div>

                                        <div class="m-vlight-top-breather">
                                            <p class="mid-font-size capitalize no-margin txt-bold">avaliability</p>
                                            <p class="small-font-size capitalize" data-post="job_type"><?php echo $desiredJob[0]->job_type; ?></p>
                                            <p class="mid-font-size"></p>
                                        </div>

                                    </div>

                                    <div class="col-sm-6">
                                        <div class="">
                                            <p class="mid-font-size capitalize no-margin txt-bold">prefered salary</p>
                                            <p class="small-font-size capitalize" data-post="salary_range"><?php echo $desiredJob[0]->salary_range; ?> (Monthly)</p>
                                            <p class="mid-font-size"></p>
                                        </div>

                                        <div class="m-vlight-top-breather">
                                            <p class="mid-font-size capitalize no-margin txt-bold">desired location</p>
                                            <p class="small-font-size capitalize" data-post="location"><?php echo $desiredJob[0]->location; ?></p>
                                            <p class="mid-font-size"></p>
                                        </div>

                                    </div>

                                </div>

                                <div  class="clearfix small-font-size">
                                    <button id="ed-cs" class="btn sec-btn capitalize pull-right">edit</button>
                                </div>
                            </div>

                            <!-- hidden-career summary edit form -->
                            <div class="p-light-bottom-breather p-mid-side-breather hide-el" id="di-cs-f">
                                <p class="capitalize small-font-size txt-bold">Edit the space as required</p>
                                <form action="../control/candidate/profile.php" method="post" class="sm" id="cs-form">
                                    <input type="hidden" value="<?php echo $user->id; ?>" name="id">
                                    <input type="hidden" value="cs" name="profile_type">
                                    <div class="row">
                                        <div class="col-sm-6">

                                            <div class="form-group">
                                                <label class="txt-bold small-font-size capitalize">desired job title</label>
                                                <input type="text" class="form-control" value="<?php if(isset($desiredJob[0]->job_title)) {echo $desiredJob[0]->job_title; } else {echo ""; } ?>" name="job_title" placeholder="enter your desired job title">
                                            </div>

                                            <div class="form-group">
                                                <label class="txt-bold small-font-size capitalize">job field</label>
                                                <select name="job_field" class="form-control">
                                                    <option value="">choose your field</option>
                                                    <?php $jobFields = JobFields::findAll(); 
                                                    foreach($jobFields as $job_field): ?>

                                                    <?php if($job_field->name == $desiredJob[0]->job_field ): ?>
                                                    <option value="<?php echo $job_field->name; ?>" selected><?php echo ucwords($job_field->name); ?></option>
                                                    <?php else : ?>
                                                    <option value="<?php echo $job_field->name; ?>"><?php echo ucwords($job_field->name); ?></option>
                                                    <?php endif; endforeach; ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="txt-bold small-font-size capitalize">job type</label>
                                                <select name="job_type" class="form-control capitalize">
                                                    <?php foreach($jobType as $type) : 
                                                    if($type->time_span == $desiredJob[0]->job_type) : ?>
                                                    <option value="<?php echo $type->type; ?>" selected><?php echo $type->type; ?></option>

                                                    <?php else: ?>
                                                    <option value="<?php echo $type->type; ?>"><?php echo $type->type; ?></option>
                                                    <?php endif; endforeach; ?>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-sm-6 m-light-bottom-breather">

                                            <div class="form-group">
                                                <label class="txt-bold small-font-size capitalize">preferred salary</label>
                                                <select name="salary_range" class="form-control capitalize">

                                                    <?php foreach($salaryRange as $range):
                                                    if($range->salary_range == $desiredJob[0]->salary_range): ?>

                                                    <option value="<?php echo $range->salary_range; ?>" selected><?php echo $range->salary_range; ?></option>

                                                    <?php else: ?>
                                                    <option value="<?php echo $range->salary_range; ?>"><?php echo $range->salary_range; ?></option>

                                                    <?php endif; endforeach; ?>                                                    
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="txt-bold small-font-size capitalize">desired job location</label>
                                                <select name="location" id="" class="form-control">
                                                    <option>desired job location</option>
                                                    <?php foreach($states as $state):

                                                    if($state->name == $desiredJob[0]->location): ?>
                                                    <option value="<?php echo $state->name; ?>" selected><?php echo $state->name; ?></option>
                                                    <?php else: ?>
                                                    <option value="<?php echo $state->name; ?>"><?php echo $state->name; ?></option>
                                                    <?php endif; endforeach; ?>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="sm-container m-vlight-breather">
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <input type="submit" value="Confirm Changes" name="submit" id="CS-pd" class="form-control btn sec-btn capitalize"></div>
                                                <div class="col-sm-4">
                                                    <button name="submit" class="form-control capitalize btn main-btn" id="ca-cs-f">cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>


                        </div>

                    </div> <!-- end career summary -->

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
                                            <p class="mid-font-size capitalize no-margin txt-bold"><?php echo $school->course; ?></p>
                                            <p class="small-font-size capitalize"><?php echo $school->degree; ?></p>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="">
                                            <p class="mid-font-size capitalize no-margin txt-bold"><?php echo $school->school; ?></p>
                                            <p class="small-font-size capitalize"><?php echo $school->location; ?></p>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="">
                                            <p class="mid-font-size capitalize no-margin txt-bold"><?php echo $school->grade; ?></p>
                                            <p class="small-font-size capitalize">Finished: <?php echo $school->year; ?></p>
                                        </div>
                                    </div>
                                </div>

                                <?php endforeach; ?>
                                <div  class="clearfix small-font-size">
                                    <a href="" id="ed-edu" class="btn sec-btn capitalize pull-right">edit</a>
                                </div>
                            </div>

                            <!-- hidden-education modify form -->
                            <div class="p-light-bottom-breather p-mid-side-breather hide-el" id="di-edu-f">

                                <?php $n = 0; foreach($schools as $school): ?>
                                <div class="m-vlight-breather">
                                    <div class="" data-id="<?php echo $school->id; ?>">
                                        <div class="row">
                                            <div class="col-sm-9">
                                                <p class="heavy-font-size txt-bold no-margin capitalize"><?php echo $school->course; ?></p>
                                                <p class="mid-font-size capitalize no-margin txt-bold"><?php echo $school->degree; ?></p>
                                                <p class="mid-font-size capitalize no-margin"><?php echo $school->grade; ?></p>
                                                <p class="small-font-size capitalize no-margin"><?php echo $school->school; ?></p>
                                                <p class="small-font-size capitalize no-margin"><?php echo $school->location; ?></p>
                                                <p class="small-font-size capitalize"><?php echo $school->year; ?></p>
                                            </div>
                                            <div  class="col-sm-3 small-font-size m-mid-top-breather">
                                                <a href="" class="btn sec-btn capitalize">delete</a>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <?php endforeach; ?>
                                </div>

                                <div class="sm-container m-vlight-breather">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <button type="submit" name="submit" id="add-n-edu" class="form-control btn sec-btn capitalize">+ add a new degree</button></div>
                                        <div class="col-sm-4">
                                            <button name="submit" class="form-control capitalize btn main-btn" id="ca-edu-f">cancel</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div> <!-- end education -->

                    <!-- skills -->
                    <div class="m-mid-top-breather">
                        <div class="light-bx-shadow">
                            <div class="p-vlight-breather sec-bg p-mid-side-breather m-vlight-bottom-breather">
                                <p class="headfont uppercase no-margin">Professional skills</p>
                            </div>

                            <div class="p-light-bottom-breather p-mid-side-breather">

                                <?php foreach ($skills as $skill) : ?>
                                <p class="capitalize"><?php echo $skill->skill_name; ?> </p>
                                <?php endforeach; ?>

                                <div  class="clearfix small-font-size">
                                    <a href="" class="btn sec-btn capitalize pull-right">edit</a>
                                </div>

                            </div>

                        </div>



                    </div> <!-- end skills -->

                    <!-- professional memberships -->
                    <div class="m-mid-top-breather">
                        <div class="light-bx-shadow">
                            <div class="p-vlight-breather sec-bg p-mid-side-breather m-vlight-bottom-breather">
                                <p class="headfont uppercase no-margin">professional memberships / certifications</p>
                            </div>
                            <div class="p-light-bottom-breather p-mid-side-breather">

                                <?php foreach($memberships as $member) : ?>
                                <div class="m-light-top-breather">
                                    <p class="mid-font-size capitalize no-margin txt-bold"><?php echo $member->organization; ?> </p>
                                    <p class="small-font-size capitalize"><?php echo $member->year; ?></p>
                                </div>
                                <?php endforeach; ?>

                                <div  class="clearfix small-font-size">
                                    <a href="" class="btn sec-btn capitalize pull-right">edit</a>
                                </div>
                            </div>

                        </div>



                    </div> <!-- end professional memberships -->

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
                                            <p class="small-font-size capitalize"><?php echo $employment->employer; ?></p>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="">
                                            <p class="mid-font-size capitalize no-margin txt-bold">job title</p>
                                            <p class="small-font-size capitalize"><?php echo $employment->job_title; ?></p>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="">
                                            <p class="mid-font-size capitalize no-margin txt-bold">time span</p>
                                            <p class="small-font-size capitalize"><?php echo $employment->time_span; ?></p>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <p class="mid-font-size capitalize no-margin txt-bold">Responsibilities</p>
                                        <p class="small-font-size capitalize"><?php echo $employment->responsibilities; ?></p>
                                    </div>

                                </div>
                                <hr>

                                <?php endforeach; ?>
                                <div  class="clearfix small-font-size">
                                    <a href="" class="btn sec-btn capitalize pull-right">edit</a>
                                </div>
                            </div>

                        </div>

                    </div> <!-- end employment history -->

                    <!-- interests -->
                    <div class="m-mid-top-breather">
                        <div class="light-bx-shadow">
                            <div class="p-vlight-breather sec-bg p-mid-side-breather m-vlight-bottom-breather">
                                <p class="headfont uppercase no-margin">interests</p>
                            </div>
                            <div class="p-light-bottom-breather p-mid-side-breather">

                                <p class="capitalize"><?php foreach($interests as $interest){ echo $interest->interest . ", "; } ?></p>

                                <div  class="clearfix small-font-size">
                                    <a href="" class="btn sec-btn capitalize pull-right">edit</a>
                                </div>

                            </div>

                        </div>

                    </div> <!-- end interests -->


                </div> <!-- end .mainbar -->

            </div>

        </div> 
    </div>
</div>
<!-- end main content -->

<script>
</script>

<!-- footer -->
<?php include_once("{$seperator}layout/footer.php"); ?>
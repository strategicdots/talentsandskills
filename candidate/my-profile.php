<?php $thisPage = "my-profile"; $seperator="../"; 
include_once("{$seperator}includes/initialize.php");

/* check user status */
if (!$session->isCandidateLoggedIn()) {redirect_to("{$seperator}login.php"); } 

$candidate          = Candidate::findDetails($session->candidateID);
$desiredJob         = DesiredJob::findAllUnderParent($candidate->id, "user_id");
$schools            = School::findAllUnderParent($candidate->id, "user_id");
$skills             = Skills::findAllUnderParent($candidate->id, "user_id");
$memberships        = Membership::findAllUnderParent($candidate->id, "user_id");
$employmentHistory  = EmploymentHistory::findAllUnderParent($candidate->id, "user_id");
$interests          = Interest::findAllUnderParent($candidate->id, "user_id");

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
                    <?php echo candidateSidebar($candidate); ?>
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
                                    <?php if(!is_null($candidate->personal_statement)): ?>
                                    <p class="capitalize">
                                        <span class="txt-bold">Personal Statement:</span>
                                        <?php echo $candidate->personal_statement; ?> </p>

                                    <?php else: ?>
                                    <p class="capitalize">You don't have any personal statement.
                                        <a href="update-profile.php?type=personal_details">click here</a> to add one</p>
                                    <?php endif; ?>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="">
                                            <p class="mid-font-size capitalize no-margin txt-bold">Email</p>
                                            <p class="small-font-size">
                                                <?php 
                                                    if(isset($candidate->email)) {echo $candidate->email; } 
                                                    else { echo "You haven't updated your email address"; }
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

                                <div class="clearfix small-font-size">
                                    <a href="update-profile.php?type=personal_details" class="btn sec-btn capitalize pull-right">edit</a>
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

                            <div class="p-light-bottom-breather p-mid-side-breather">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="">
                                            <p class="mid-font-size capitalize no-margin txt-bold">desired job type</p>
                                            <p class="small-font-size">
                                                <?php 
                                                    if(isset($desiredJob[0]->job_title)) {echo $desiredJob[0]->job_title; } 
                                                    else { echo "Nothing is on this field"; }
                                                ?>
                                            </p>
                                            
                                        </div>

                                        <div class="m-vlight-top-breather">
                                            <p class="mid-font-size capitalize no-margin txt-bold">field</p>
                                            <p class="small-font-size">
                                                <?php 
                                                    if(isset($desiredJob[0]->job_field)) {echo $desiredJob[0]->job_field; } 
                                                    else { echo "Nothing is on this field"; }
                                                ?>
                                            </p>
                                            
                                        </div>

                                        <div class="m-vlight-top-breather">
                                            <p class="mid-font-size capitalize no-margin txt-bold">job avaliability</p>
                                            <p class="small-font-size">
                                                <?php 
                                                    if(isset($desiredJob[0]->job_type)) {echo ucwords($desiredJob[0]->job_type); } 
                                                    else { echo "Nothing is on this field"; }
                                                ?>
                                            </p>
                                            
                                        </div>

                                    </div>

                                    <div class="col-sm-6">
                                        <div class="">
                                            <p class="mid-font-size capitalize no-margin txt-bold">prefered salary</p>
                                            <p class="small-font-size capitalize">
                                                <?php 
                                                    if(isset($desiredJob[0]->salary_range)) {echo formatSalaryRange($desiredJob[0]->salary_range); } 
                                                    else { echo "Nothing is on this field"; }
                                                ?>
                                                
                                        </div>

                                        <div class="m-vlight-top-breather">
                                            <p class="mid-font-size capitalize no-margin txt-bold">desired location</p>
                                            <p class="small-font-size">
                                                <?php 
                                                    if(isset($desiredJob[0]->location)) {echo $desiredJob[0]->location; } 
                                                    else { echo "Nothing is on this field"; }
                                                ?>
                                            </p>
                                            
                                        </div>

                                    </div>

                                </div>

                                <div class="clearfix small-font-size">
                                    <a href="update-profile.php?type=career_summary" class="btn sec-btn capitalize pull-right">edit</a>
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

                            <div class="p-light-bottom-breather p-mid-side-breather">
                                <?php if(!empty($schools)) : foreach($schools as $school): ?>

                                <div class="row m-vlight-breather">
                                    <div class="col-sm-4">
                                        <div class="">
                                            <p class="mid-font-size capitalize no-margin txt-bold">
                                                <?php 
                                                    if(isset($school->course)) {echo $school->course; } 
                                                    else { echo "Nothing is on this field"; }
                                                ?>
                                            </p>
                                            <p class="small-font-size capitalize">
                                                <?php 
                                                    if(isset($school->degree)) {echo $school->degree; } 
                                                    else { echo "Nothing is on this field"; }
                                                ?>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="">
                                            <p class="mid-font-size capitalize no-margin txt-bold">
                                                <?php 
                                                    if(isset($school->school)) {echo $school->school; } 
                                                    else { echo "Nothing is on this field"; }
                                                ?>
                                            </p>
                                            <p class="small-font-size capitalize">
                                                
                                                <?php 
                                                    if(isset($school->location)) {echo $school->location; } 
                                                    else { echo "Nothing is on this field"; }
                                                ?>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="">
                                            <p class="mid-font-size capitalize no-margin txt-bold">
                                                
                                                <?php 
                                                    if(isset($school->grade)) {echo $school->grade; } 
                                                    else { echo "Nothing is on this field"; }
                                                ?>
                                            </p>
                                            <p class="small-font-size capitalize">Finished:
                                                
                                                <?php 
                                                    if(isset($school->year)) {echo $school->year; } 
                                                    else { echo "Nothing is on this field"; }
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <?php endforeach; ?>
                                <?php else: ?>
                                <div class="row m-vlight-breather p-mid-side-breather">
                                    
                                    <p class="mid-font-size no-margin">
                                        You haven't updated your educational details
                                    </p>
                                       
                                </div>
                                <?php endif; ?>

                                <div class="clearfix small-font-size">
                                    <a href="update-profile.php?type=education" class="btn sec-btn capitalize pull-right">edit</a>
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

                                <?php if(isset($skills)): foreach ($skills as $skill) : ?>
                                <p class="capitalize">
                                    <?php echo $skill->skill_name; ?> </p>
                                <?php endforeach; else: ?>

                                <p class=""> You haven't updated your professional skill set </p>
                                <?php endif; ?>
                                
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

                                <?php if(isset($memberships)): foreach($memberships as $member) : ?>
                                <div class="m-light-top-breather">
                                    <p class="mid-font-size capitalize no-margin txt-bold">
                                        <?php 
                                            if(isset($member->organization)) {echo $member->organization; } 
                                            else { echo "Nothing is on this field"; }
                                        ?>
                                    <p class="small-font-size capitalize">
                                        <?php 
                                            if(isset($member->year)) {echo $member->year; } 
                                            else { echo "Nothing is on this field"; }
                                        ?>
                                    </p>
                                </div>
                                <?php endforeach; else: ?>
                                <p>You are not a member of any organization yet.</p>
                                <?php endif; ?>

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

                                <?php if(isset($employmentHistory)): foreach($employmentHistory as $employment): ?>

                                <div class="row m-vlight-breather">
                                    <div class="col-sm-4">
                                        <div class="">
                                            <p class="mid-font-size capitalize no-margin txt-bold">employer</p>
                                            <p class="small-font-size capitalize">
                                                <?php 
                                                    if(isset($employmentHistory->employer)) {echo $employmentHistory->employer; } 
                                                    else { echo "Nothing is on this field"; }
                                                ?>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="">
                                            <p class="mid-font-size capitalize no-margin txt-bold">job title</p>
                                            <p class="small-font-size capitalize">
                                                <?php 
                                                    if(isset($employmentHistory->job_title)) {echo $employmentHistory->job_title; } 
                                                    else { echo "Nothing is on this field"; }
                                                ?>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="">
                                            <p class="mid-font-size capitalize no-margin txt-bold">time span</p>
                                            <p class="small-font-size capitalize">
                                                <?php 
                                                    if(isset($employmentHistory->time_span)) {echo $employmentHistory->time_span; } 
                                                    else { echo "Nothing is on this field"; }
                                                ?>
                                            </p>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <p class="mid-font-size capitalize no-margin txt-bold">Responsibilities</p>
                                        <p class="small-font-size capitalize">
                                            <?php echo $employment->responsibilities; ?>
                                                <?php 
                                                    if(isset($employmentHistory->responsibilities)) {echo $employmentHistory->responsibilities; } 
                                                    else { echo "Nothing is on this field"; }
                                                ?>
                                        </p>
                                    </div>

                                </div>
                                <hr>

                                <?php endforeach; else: ?>
                                <p>You haven't added any employment history yet.</p>
                                <?php endif; ?>

                                <div class="clearfix small-font-size">
                                    <a href="update-profile.php?type=employment_history" class="btn sec-btn capitalize pull-right">edit</a>
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

                                <p class="capitalize">
                                    <?php if(isset($interests)) {
                                         foreach($interests as $interest){ echo $interest->interest . ", "; }
                                         
                                    } else {
                                        echo "You haven't updated this section.";
                                    }
                                    ?>
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
<?php $thisPage = "my-profile"; $seperator="../"; 
include_once("{$seperator}includes/initialize.php");
if(!isset($_GET['type'])) {redirect_to("my-profile.php"); }

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
                    <?php switch($_GET['type']): case "personal_details" : ?>
                    <div class="">
                        <div class="light-bx-shadow">
                            <div class="p-vlight-breather sec-bg p-mid-side-breather m-vlight-bottom-breather">
                                <p class="headfont uppercase no-margin">personal details </p>
                            </div>

                            <div class="p-light-bottom-breather p-mid-side-breather">
                                <?php echo inline_errors(); ?>
                                <?php echo pDForm($candidate); ?>
                            </div>

                        </div>
                    </div> <!-- end personal details -->

                    <!-- career summary-->
                    <?php break; case "career_summary" : ?>
                    <div class="">
                        <div class="light-bx-shadow">
                            <div class="p-vlight-breather sec-bg p-mid-side-breather m-vlight-bottom-breather">
                                <p class="headfont uppercase no-margin">career summary </p>
                            </div>

                            <div class="p-light-bottom-breather p-mid-side-breather" id="di-pd">
                                <?php echo CSForm($desiredJob[0]); ?>
                            </div>

                        </div>
                    </div>
                    <!-- end career summary -->

                    <!-- education -->
                    <?php break; case "education" : ?>
                    <div class="">
                        <div class="light-bx-shadow">
                            <div class="p-vlight-breather sec-bg p-mid-side-breather m-vlight-bottom-breather">
                                <p class="headfont uppercase no-margin">education</p>
                            </div>

                            <div class="p-light-bottom-breather p-mid-side-breather">
                            <?php echo inline_errors(); ?>

                                <!--  add new entry -->
                                <?php if(isset($_GET['action']) && ($_GET['action']) == "add") : ?>
                                <?php echo  eduForm($schools = null, $newEntry = true); ?>

                                <!-- update entry -->
                                <?php else: ?>
                                <?php echo  eduForm($schools); ?>

                            </div>
                            <?php endif; ?>

                        </div>

                    </div>
                    <!-- end education -->

                    <!-- skills -->
                    <?php break; case "skills" : ?>

                    <div class="">
                        <div class="light-bx-shadow">
                            <div class="p-vlight-breather sec-bg p-mid-side-breather m-vlight-bottom-breather">
                                <p class="headfont uppercase no-margin">Professional skills</p>
                            </div>

                            <div class="p-light-bottom-breather p-mid-side-breather">
                            <?php echo inline_errors(); ?>

                                <!--  add new entry -->
                                <?php if(isset($_GET['action']) && ($_GET['action']) == "add") : ?>
                                <?php echo  skillForm($skills = null, $newEntry = true); ?>

                                <!-- update entry -->
                                <?php else: ?>
                                <?php echo skillForm($skills); ?>
                            </div> <?php endif; ?>

                        </div>

                    </div> <!-- end skills -->

                    <!-- professional memberships -->
                    <?php break; case "memberships" : ?>

                    <div class="">
                        <div class="light-bx-shadow">
                            <div class="p-vlight-breather sec-bg p-mid-side-breather m-vlight-bottom-breather">
                                <p class="headfont uppercase no-margin">professional memberships / certifications</p>
                            </div>

                            <div class="p-light-bottom-breather p-mid-side-breather" id="">
                                <?php echo inline_errors(); ?>

                                <!--  add new entry -->
                                <?php if(isset($_GET['action']) && ($_GET['action']) == "add") : ?>
                                <?php echo  memForm($memberships = null, $newEntry = true); ?>

                                <!-- update entry -->
                                <?php else: ?>
                                <?php echo memForm($memberships); ?>
                            </div> <?php endif; ?>
                            

                        </div>

                    </div> <!-- end professional memberships -->

                    <!-- employment history -->
                    <?php break; case "employment_history" : ?>
                    <div class="">
                        <div class="light-bx-shadow">

                            <div class="p-vlight-breather sec-bg p-mid-side-breather m-vlight-bottom-breather">
                                <p class="headfont uppercase no-margin">employment history</p>
                            </div>

                            <div class="p-light-bottom-breather p-mid-side-breather" id="">
                                <?php echo EHForm($employmentHistory); ?>
                            </div>

                        </div>

                    </div> <!-- end employment history -->

                    <!-- interests -->
                    <?php break; case "interests" : ?>
                    <div class="">
                        <div class="light-bx-shadow">
                            <div class="p-vlight-breather sec-bg p-mid-side-breather m-vlight-bottom-breather">
                                <p class="headfont uppercase no-margin">interests</p>
                            </div>

                            <div class="p-light-bottom-breather p-mid-side-breather">
                                <?php echo intForm($interests); ?>
                            </div>

                        </div>

                    </div>
                    <!-- end interests -->
                    <?php break; endswitch; ?>
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
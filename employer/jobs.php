<?php $thisPage = "jobs"; $seperator="../"; 
include_once("{$seperator}includes/initialize.php");

/* check user status */
if (!$session->isEmployerLoggedIn()) {redirect_to("{$seperator}login.php"); } 
$employer = Employer::findDetails($session->employerID);

// $_GET['id'] must be set
if(!isset($_GET['id']) || empty($_GET['id'])) { redirect_to("dashboard.php"); }

$job = Jobs::findDetails(trim($_GET['id']));

//check if job is from employer
if($job->employer_id !== $employer->id) { redirect_to("dashboard.php"); }

// find application for job
$application = Application::findAllUnderParent($job->id, "job_id");
if(!empty($application)) { $applicationNumber = count($application); };

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

                    <!-- company profile -->
                    <div class="light-bx-shadow m-mid-bottom-breather">
                        <div class="p-vlight-breather sec-bg p-mid-side-breather">
                            <p class="headfont uppercase no-margin text-center">company profile</p>
                        </div>

                        <div class="p-mid-side-breather p-light-breather">
                            <?php if(!is_null($employer->avatar_url)) : ?>
                            <img class="img-center" src="<?php echo $employer->avatar_url; ?>" alt="">

                            <?php else : ?>
                            <img class="img-center" src="../img/candidate-placeholder.jpg" alt="">
                            <?php endif; ?>

                            <p class="lead headfont text-center no-margin">
                                <?php echo $employer->company_name; ?>
                            </p>
                            <p class="secheadfont capitalize">
                                <?php echo $employer->job_field; ?> firm</p>

                        </div>

                    </div>

                    <!-- create a job posting -->
                    <div class="light-bx-shadow m-mid-bottom-breather">
                        <div class="p-vlight-breather sec-bg p-mid-side-breather">
                            <p class="headfont uppercase no-margin text-center">create a job posting</p>
                        </div>

                        <div class="p-mid-side-breather p-light-breather">
                            <form method="post" action="../control/employer/create-job.php">
                                <div class="form-group">
                                    <label class="capitalize">job title</label>
                                    <input type="text" name="job_title" class="form-control" placeholder="Enter Your Job Title">
                                </div>

                                <div class="form-group">
                                    <label class="capitalize">field</label>
                                    <select name="job_field" class="form-control">
                                        <?php foreach($jobFields as $field): ?>
                                        <option value="<?php echo $field->name; ?>">
                                            <?php echo $field->name; ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <input type="submit" value="Start" class="btn sec-btn heavy-font-size form-control">
                            </form>


                        </div>


                    </div>

                </div>
                <!-- end .sidebar -->

                <!-- mainbar -->
                <div class="jobs m-mid-top-breather col-sm-8">
                    <div class="light-bx-shadow m-mid-bottom-breather">
                        <div class="p-vlight-breather sec-bg p-mid-side-breather m-vlight-bottom-breather">
                            <p class="headfont uppercase no-margin text-center">job title: <?php echo $job->title; ?></p>
                        </div>

                        <?php if(!$application): ?>
                        <div class="text-center">
                            <p class="lead capitalize"> No application has been received for this job</p>
                        </div>

                        <?php else: ?>
                        <div class="text-center">
                            <p class="lead capitalize">
                                <?php echo $applicationNumber; ?> 
                                <?php if($applicationNumber > 1) { echo "applications"; } else { echo "application"; } ?>
                                received</p>
                        </div>
                    </div>

                    <?php foreach($application as $applicant):  
                    $candidate = User::findDetails($applicant->user_id); 
                    ?> 

                    <?php endforeach; endif; ?>

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
<?php $thisPage = "search-jobs"; $seperator="../"; $navbarType = "candidate"; 
include_once("{$seperator}includes/initialize.php");

/* check user status */
if (!$session->isCandidateLoggedIn()) {
    $session->message("First, you have to login.");
    redirect_to("{$seperator}login.php"); 

} 

/* check ID of job */
if(!$_GET && !isset($_GET['id'])) { redirect_to("job-search.php"); }

$job = Jobs::findDetails($_GET['id']);
$employer = Employer::findDetails($job->employer_id); 

// calculating deadline
$deadline = jobDeadline($job->deadline);
?>

<!-- header -->
<?php include_once("{$seperator}layout/dashboard-header.php"); ?>

<!--  main content  -->
<div class="inner-top dashboard">
    <div class=" p-light-breather">

        <!-- top job search form -->
        <?php echo topJobSearch($states, $seperator); ?>

        <div class="container m-heavy-top-breather">
            <div class="row">

                <!-- jobs details -->
                <div class="col-sm-9 white-bg m-heavy-side-breather">

                    <!-- title -->
                    <div class="m-mid-breather">
                        <h2 class="capitalize no-margin">
                            <?php echo $job->title; ?>
                        </h2>
                        <p class="secheadfont uppercase">
                            <?php echo $employer->company_name; ?>
                        </p>
                        <a href="apply-job.php?id=<?php echo $job->id;?>" class="btn main-btn capitalize">apply for this job</a>

                        <?php if(!empty($employer->about_company)): ?>
                        <!-- about company -->
                        <div class="m-mid-top-breather">
                            <p class="lead no-margin txt-bold capitalize">about
                                <?php echo $employer->company_name; ?>
                            </p>
                            <p>
                                <?php echo nl2br($employer->about_company); ?> </p>
                        </div>
                        <?php endif; ?>

                        <!-- job description -->
                        <?php if(!empty($job->description)): ?>
                        <div class="m-mid-top-breather">
                            <p class="lead no-margin txt-bold capitalize">job description</p>
                                <?php echo nl2br(htmlspecialchars_decode($job->description)); ?> 
                        </div>
                        <?php endif; ?>
                        
                        <!-- apply btn -->
                        <div class="m-mid-breather">
                            <a href="apply-job.php?id=<?php echo $job->id;?>" class="btn main-btn capitalize">apply for this job</a>
                        </div>

                    </div>

                </div>

                <!-- job summary -->
                <div class="sidebar col-sm-3">
                    <div class="p-vlight-breather sec-bg p-mid-side-breather">
                        <p class="headfont uppercase no-margin text-center">job summary</p>
                    </div>
                    <div class="p-mid-side-breather p-light-breather white-bg small-font-size">

                        <!-- company name -->
                        <div class="capitalize">
                            <p class="txt-bold no-margin">company</p>
                            <p class=""> <?php echo $employer->company_name; ?> </p>
                        </div>

                        <!-- job field -->
                        <div class="capitalize">
                            <p class="txt-bold no-margin">field</p>
                            <p class=""><?php echo $job->job_field; ?></p>
                        </div>

                        <!-- job type -->
                        <div class="capitalize">
                            <p class="txt-bold no-margin">job type</p>
                            <p class=""><?php echo $job->job_type; ?></p>
                        </div>

                        <!-- location -->
                        <div class="capitalize">
                            <p class="txt-bold no-margin">location</p>
                            <p class=""><?php echo $job->location; ?></p>
                        </div>

                        <!-- job experience -->
                        <div class="capitalize">
                            <p class="txt-bold no-margin">experience</p>
                            <p class=""><?php echo $job->job_experience; ?></p>
                        </div>

                        <!-- job qualification -->
                        <div class="capitalize">
                            <p class="txt-bold no-margin">minimum qualification</p>
                            <p class=""><?php echo $job->qualification; ?></p>
                        </div>

                        <!-- job deadline -->
                        <div class="capitalize">
                            <p class="txt-bold no-margin">deadline</p>
                            <p class=""><?php echo $deadline; ?></p>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>

</div>



<!-- footer -->
<?php include_once("{$seperator}layout/footer.php"); ?>
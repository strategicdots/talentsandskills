<?php $thisPage = "jobsPage"; $seperator="../"; 
include_once("{$seperator}includes/initialize.php");

// find all jobs
$jobs = Jobs::findAll(); 

?>

<!-- header -->
<?php include_once("{$seperator}layout/header.php"); ?>

<!--  main content  -->
<div class="inner-top dashboard">
    <div class=" p-light-breather">

        <!-- search form-->
        <?php echo topJobSearch($states); ?>

        <div class="container m-heavy-top-breather">
            <div class="row">

                <!-- sidebar -->
                <div class="sidebar col-sm-4">
                    <!-- job search filter  -->
                    <?php echo jobSearchFilter(); ?>
                </div>

                <!-- jobs section -->
                <div class="col-sm-8 featured-jobs p-light-top-breather white-bg">

                    <?php if (!$jobs) : ?>
                    <div class="text-center">
                        <p class="lead capitalize"> No current job listings</p>
                    </div>

                    <?php else : ?>
                    <div class="text-center">
                        <p class="lead capitalize">
                            There are currently <?php echo count($jobs); ?> job listings available</p>
                    </div>

                    <?php foreach ($jobs as $job) :
                        $employer = Employer::findDetails($job->employer_id);
                    ?>

                    <div class="item">
                        <div class="btm m-mid-top-breather">
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="emplyr-img-bx">
                                        <?php if ($employer->avatar_url) : ?>
                                        <img src="<?php echo $employer->avatar_url; ?>" class="img-responsive">
                                        <?php else : ?>
                                        <img src="<?php echo $seperator; ?>img/company.png" class="img-responsive">
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <h2 class="mid-font-size capitalize no-margin">
                                        <?php echo $job->title; ?>
                                    </h2>
                                    <p class="small-font-size secheadfont uppercase">
                                        <?php echo $employer->company_name; ?>
                                    </p>
                                    <div class="small-font-size">
                                        <p class="no-margin txt-bold capitalize">
                                            <?php echo $job->location; ?>
                                        </p>
                                        <p class="no-top-margin txt-bold capitalize">
                                            <?php echo formatSalaryRange($job->salary_range); ?> / per month</p>
                                    </div>
                                    <div class="">
                                        <?php echo trimContent(htmlspecialchars_decode($job->description, 40)); ?>
                                    </div>
                                    <div class="m-vlight-breather">
                                        <a href="job.php?id=<?php echo $job->id; ?>" class="btn main-btn btn-lg capitalize">apply</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <?php endforeach;
                    endif; ?>

                </div>

            </div>

        </div>

    </div>

</div>
<!-- footer -->
<?php include_once("{$seperator}layout/footer.php"); ?>
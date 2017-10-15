<?php $thisPage = "job-search"; $seperator="../"; 
include_once("{$seperator}includes/initialize.php");
$jobExperience = JobExperience::findAll(); $jobLevel = JobLevel::findAll(); $jobType = JobType::findAll(); 
$states = State::findAll(); $jobField = JobFields::findAll(); $jobs = Jobs::findAll(); 
?>

<!-- header -->
<?php include_once("{$seperator}layout/dashboard-header.php"); ?>

<!--  main content  -->
<div class="inner-top dashboard">
    <div class=" p-light-breather">

        <!-- search form-->
        <?php echo topJobSearch($states); ?>

        <div class="container m-heavy-top-breather">
            <div class="row">

                <!-- jobs section -->
                <div class="col-sm-8 featured-jobs p-light-top-breather white-bg">
                    <?php $job = Jobs::findAll(); ?>

                    <div class="text-center">
                        <p class="lead capitalize"> Jobs matching your search criteria</p>
                    </div>
                </div>

                <!-- sidebar -->
                <div class="sidebar col-sm-4">
                    <div class="light-bx-shadow m-mid-bottom-breather">
                        <div class="p-vlight-breather sec-bg p-mid-side-breather">
                            <p class="headfont uppercase no-margin text-center">job summary</p>
                        </div>

                        <div class="p-mid-side-breather p-light-breather">

                            <div class=" capitalize">

                            </div> 
                        </div>
                    </div>                    
                </div> 


            </div> 

        </div>

    </div>

</div>
<!-- footer -->
<?php include_once("{$seperator}layout/footer.php"); ?>
<?php $thisPage = "jobsPage"; $seperator="../"; 
include_once("{$seperator}includes/initialize.php");

/* check if active user */
if ($session->isCandidateLoggedIn()) {
    $_SESSION['job_query'] = $_GET;
    redirect_to("{$seperator}candidate/job-search.php"); 
} 

// initializing location and keyword
$location = "";
$keyword = "";

if(isset($_GET['location']) || isset($_GET['keyword'])) {
    
    if(isset($_GET['location'])) { $location = trim($_GET['location']); }
    if(isset($_GET['keyword'])) { $keyword  = trim($_GET['keyword']); }

}



$jobs = Jobs::topSearch($keyword, $location);

if((isset($_POST['submit']) && ($_POST['submit'] == "filter"))) { // filter search results
    
    // unseting submit 
    unset($_POST['submit']);
    
    //appending the GET variables to POST to filter along
    if(!empty($_GET['location'])) { $_POST['location'] = trim($_GET['location']); }
    if(!empty($_GET['keyword'])) { $_POST['keyword'] = trim($_GET['keyword']); }

    $jobs = Jobs::jobFilter($_POST);
}

// get and append pagination properties
$per_page = (int) 5;
$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
$total_count = count($jobs);

// initialize pagination
$pagination = new Pagination($page, $per_page, $total_count);

// load $jobs to get total job items
$pagination->load($jobs);


// get the job posted per page
$jobsPerPage = $pagination->pageItems();

?>

<!-- header -->
<?php include_once("{$seperator}layout/header.php"); ?>

<!--  main content  -->
<div class="inner-top dashboard">
    <div class=" p-light-breather">

        <!-- top job search form -->
        <?php echo topJobSearch($states, $seperator); ?>

        <div class="container m-heavy-top-breather">
            <div class="row">

                <!-- sidebar -->
                <div class="sidebar col-sm-4">
                    <!-- job search filter  -->
                    <?php echo jobSearchFilter(); ?>
                </div>

                <?php if (isset($_GET['location']) || isset($_GET['keyword'])) : 
                // SECTION FOR JOB LISTINGS FROM GET VARIABLES ?>

                <!-- jobs section -->
                <div class="col-sm-8 featured-jobs p-light-top-breather white-bg">

                    <?php if(!$jobs): ?>
                    <div class="text-center">
                        <p class="lead capitalize"> No result march your search criteria</p>
                    </div>

                    <?php else: ?>
                    <div class="text-center">
                        <p class="lead capitalize">
                            <?php echo count($jobs); if(count($jobs)==1){echo " Job"; }else{echo " Jobs"; } ?> matching your search criteria</p>
                    </div>

                    <?php foreach($jobsPerPage as $job):  
                    $employer = Employer::findDetails($job->employer_id); 
                    ?>

                    <div class="item">
                        <div class="btm m-mid-top-breather">
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="emplyr-img-bx">
                                        <?php if($employer->avatar_url): ?>
                                        <img src="<?php echo $employer->avatar_url; ?>" class="img-responsive">
                                        <?php else: ?>
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
                                        <a href="<?php echo $seperator; ?>candidate/job.php?id=<?php echo $job->id; ?>" class="btn main-btn btn-lg capitalize">apply</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <!--pagination buttons -->
                    <?php echo paginationNavigation($pagination, $page); ?>
                
                <?php endif; ?>

                </div>

                <?php else : 
                // NO GET VARIABLE SUPPLIED, USER COMING DIRECTLY TO PAGE ?>

                <!-- sidebar -->
                <div class="sidebar col-sm-4">
                    <?php // echo candidateSidebar($candidate); ?>
                </div>


                <!-- mainbar -->
                <div class="col-sm-8 mainbar">
                <div class="jobs m-mid-bottom-breather">
                        <div class="light-bx-shadow">
                            <div class="p-vlight-breather sec-bg p-mid-side-breather m-vlight-bottom-breather">
                                <p class="headfont uppercase no-margin">recent jobs on talents and skills </p>
                            </div>
                            <?php $newJobs = Jobs::newJobs(); ?>
                            <div class="p-light-bottom-breather p-mid-side-breather">
                                <ul class="no-list-style no-left-padding">
                                    <?php foreach($newJobs as $job): ?>
                                    <li>
                                        <a href="job.php?id=<?php echo $job->id; ?>">
                                            <?php echo ucwords($job->title); ?>
                                        </a>
                                    </li>

                                    <?php endforeach; ?>
                                </ul>
                            </div>

                        </div>

                    </div> <!-- end .new jobs-->
                    
                </div>

                <?php endif; ?>

            </div>

        </div>

    </div>

</div>



<!-- footer -->
<?php include_once("{$seperator}layout/footer.php"); ?>
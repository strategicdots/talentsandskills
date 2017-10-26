<?php $thisPage = "job-search"; $seperator="../"; 
include_once("{$seperator}includes/initialize.php");

/* if(isset($session->candidateID)) {
    $user = User::findDetails($session->candidateID);
} */

if(!$_GET){ redirect_to($seperator); }

$location = trim($_GET['location']);
$keyword  = trim($_GET['keyword']);

$jobs = Jobs::topSearch($keyword, $location);

 if((isset($_POST['submit']) && ($_POST['submit'] == "filter"))) { // filter search results
    
    // unseting submit 
    unset($_POST['submit']);
    
    //appending the GET variables to POST to filter along
    if(!empty($_GET['location'])) { $_POST['location'] = trim($_GET['location']); }
    if(!empty($_GET['keyword'])) { $_POST['keyword'] = trim($_GET['keyword']); }

    //print_r($_POST); exit;
    $jobs = Jobs::jobFilter($_POST);
}
?>

<!-- header -->
<?php 
if(isset($session->candidateID)) { 
    include_once("{$seperator}layout/dashboard-header.php"); 
} elseif(isset($session->employerID)) {
    include_once("{$seperator}layout/em-dashboard-header.php");     
} else {
    include_once("{$seperator}layout/header.php");         
}
?>

<style>

    .panel-default {
        border-color: #c4c4c4;
    }

    .panel-group .panel {
        border-radius: inherit;
    }

    .panel-group .panel {
        border-radius: inherit;
        margin-bottom: 10px;
    }

    .panel-heading {
        border-top-left-radius: inherit;
        border-top-right-radius: inherit;
    }

    .panel-default > .panel-heading {
        background-color: #fff;
        cursor: pointer;
    }

    .panel-body {
        padding: 10px;
    }

    label {
        font-weight: 400;
        font-size: 16px;
    }



</style>

<!--  main content  -->
<div class="inner-top dashboard">
    <div class=" p-light-breather">

        <!-- search form-->
        <?php echo topJobSearch($states, $seperator); ?>

        <div class="container m-heavy-top-breather">
            <div class="row">

                <!-- sidebar -->
                <div class="sidebar col-sm-4">
                    <div class="light-bx-shadow m-mid-bottom-breather">
                        <div class="p-vlight-breather sec-bg p-mid-side-breather">
                            <p class="headfont uppercase no-margin text-center">filter search results</p>
                        </div>

                        <div class="p-mid-side-breather p-light-breather">

                            <div class="panel-group capitalize" id="accordion">

                                <form id='search_filter' method="post" action="#">

                                    <!-- experience -->
                                    <div class="panel panel-default">
                                        <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" data-target="#accordion-1">
                                            <p class="panel-title"> <span class="glyphicon glyphicon-chevron-down pull-right"></span>
                                                <a class="accordion-toggle">Experience</a>
                                            </p></div>
                                        <div id="accordion-1" class="panel-collapse collapse">

                                            <div class="panel-body">
                                                <?php foreach($jobExperience as $exp): ?>
                                                <div class="p-mid-side-breather">
                                                    <label class="radio"> <input type="radio" name="job_experience" id="" value="<?php echo $exp->years; ?>"> <?php echo $exp->years; if($exp->id != 1) {echo " years"; } ?></label>
                                                </div>
                                                <?php endforeach; ?>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- job level -->
                                    <div class="panel panel-default">
                                        <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" data-target="#accordion-2">
                                            <p class="panel-title"> <span class="glyphicon glyphicon-chevron-down pull-right"></span>
                                                <a class="accordion-toggle">job level</a>
                                            </p></div>
                                        <div id="accordion-2" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <?php foreach($jobLevel as $level): ?>
                                                <div class="p-mid-side-breather">
                                                    <label class="radio"> <input type="radio" name="job_level" id="" value="<?php echo $level->level; ?>"> <?php echo $level->level; ?></label>
                                                </div>
                                                <?php endforeach; ?>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- salary range -->
                                    <div class="panel panel-default">
                                        <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" data-target="#accordion-3">
                                            <p class="panel-title"> <span class="glyphicon glyphicon-chevron-down pull-right"></span>
                                                <a class="accordion-toggle">salary range</a>
                                            </p></div>
                                        <div id="accordion-3" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <?php foreach($salaryRange as $range): ?>
                                                <div class="p-mid-side-breather">
                                                    <label class="radio"> <input type="radio" name="salary_range" id="" value="<?php echo $range->salary_range; ?>"> <?php echo formatSalaryRange($range->salary_range); ?></label>
                                                </div>
                                                <?php endforeach; ?>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- work type -->
                                    <div class="panel panel-default">
                                        <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" data-target="#accordion-4">
                                            <p class="panel-title"> <span class="glyphicon glyphicon-chevron-down pull-right"></span>
                                                <a class="accordion-toggle">work type</a>
                                            </p></div>
                                        <div id="accordion-4" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <?php foreach($jobType as $type): ?>
                                                <div class="p-mid-side-breather">
                                                    <label class="radio"> <input type="radio" name="job_type" id="" value="<?php echo $type->type; ?>"> <?php echo $type->type; ?> only </label>
                                                </div>
                                                <?php endforeach; ?>                                               
                                            </div>
                                        </div>

                                    </div>

                                    <!-- location -->
                                    <div class="panel panel-default">
                                        <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" data-target="#accordion-5">
                                            <p class="panel-title"> <span class="glyphicon glyphicon-chevron-down pull-right"></span>
                                                <a class="accordion-toggle">location</a>
                                            </p></div>
                                        <div id="accordion-5" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="" id="top-states">
                                                    <div class="p-mid-side-breather">
                                                        <label class="radio"> <input type="radio" name="location" id="" value=""></label>
                                                    </div>
                                                </div>
                                                <?php $i=0; foreach($states as $state): ?> 
                                                <div class="p-mid-side-breather">
                                                    <label class="radio"> <input type="radio" name="location" id="" value="<?php echo $state->name; ?>"><?php echo $state->name; $i++;?> </label>
                                                </div>
                                                <?php endforeach; ?>  
                                            </div>
                                        </div>

                                    </div>                                    

                                    <!-- industry -->
                                    <div class="panel panel-default">
                                        <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" data-target="#accordion-6">
                                            <p class="panel-title"> <span class="glyphicon glyphicon-chevron-down pull-right"></span>
                                                <a class="accordion-toggle">Industry / Sector / Field </a>
                                            </p></div>
                                        <div id="accordion-6" class="panel-collapse collapse">
                                            <div class="panel-body">

                                                <?php foreach($jobField as $field): ?>
                                                <div class="p-mid-side-breather">
                                                    <label class="radio"> <input type="radio" name="job_field" id="" value="<?php echo $field->name; ?>"><?php echo $field->name; ?> </label>
                                                </div>
                                                <?php endforeach; ?> 
                                            </div>
                                        </div>
                                    </div>
                                    <input type="submit" name="submit" value="filter" class="btn sec-btn form-control uppercase">
                                </form>
                            </div> 
                        </div>
                    </div>                    
                </div> 

                <!-- jobs section -->
                <div class="col-sm-8 featured-jobs p-light-top-breather white-bg">

                    <?php if(!$jobs): ?>
                    <div class="text-center">
                        <p class="lead capitalize"> No result march your search criteria</p>
                    </div>
                    
                    <?php else: ?>
                    <div class="text-center">
                        <p class="lead capitalize"> <?php echo count($jobs); ?> Jobs matching your search criteria</p>
                    </div>

                    <?php foreach($jobs as $job):  
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
                                    <h2 class="mid-font-size capitalize no-margin"><?php echo $job->title; ?></h2>
                                    <p class="small-font-size secheadfont uppercase"><?php echo $employer->company_name; ?></p>
                                    <div class="small-font-size">
                                        <p class="no-margin txt-bold capitalize"><?php echo $job->location; ?></p>
                                        <p class="no-top-margin txt-bold capitalize"><?php echo formatSalaryRange($job->salary_range); ?> / per month</p>
                                    </div>
                                    <div class="">
                                        <p class="mid-font-size"><?php echo trimContent($job->description, 40); ?></p>
                                    </div>
                                    <div class="m-vlight-breather">
                                        <a href="./?id=<?php echo $job->id; ?>" class="btn main-btn btn-lg capitalize">apply</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; endif; ?>

                </div>

            </div> 

        </div>

    </div>

</div>



<!-- footer -->
<?php include_once("{$seperator}layout/footer.php"); ?>
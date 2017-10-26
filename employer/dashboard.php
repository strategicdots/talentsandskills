<?php $thisPage = "dashboard"; $seperator="../"; 
include_once("{$seperator}includes/initialize.php");

/* check user status */
if (!$session->isEmployerLoggedIn()) {redirect_to("{$seperator}login.php"); } 
 
$employer = Employer::findDetails($session->employerID);
$jobsPosted = Jobs::findAllUnderParent($employer->id, "employer_id", $order = true);
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
                            <form method="post" action="create-job.php">
                                <div class="form-group">
                                    <label class="capitalize">job title</label>
                                    <input type="text" name="title" class="form-control" placeholder="Enter Your Job Title">
                                </div>

                                <div class="form-group">
                                    <label class="capitalize">field</label>
                                    <select name="job_field" class="form-control">
                                        <?php foreach($jobFields as $field): ?>
                                        <option value="<?php echo $field->name; ?>"><?php echo $field->name; ?></option>
                                        <?php endforeach; ?>
                                        </select>
                                </div>
                                <input type="submit" value="Start" class="btn sec-btn heavy-font-size form-control">
                            </form>


                        </div>


                    </div>

                </div>

                <!-- mainbar -->
                <div class="col-sm-8 mainbar">

                    <div class="jobs">
                        <div class="light-bx-shadow">
                            <div class="p-vlight-breather sec-bg p-mid-side-breather m-vlight-bottom-breather">
                                <p class="headfont uppercase no-margin">job postings</p>
                            </div>
                            <div class="p-light-bottom-breather p-mid-side-breather">

                                <?php echo inline_message(); ?>

                                <?php if(!$jobsPosted): ?>
                                <p>You don't have any job postings yet. <a href="create-job.php">Click Here</a> to create one</p>

                                <?php else: ?>

                                <?php echo jobPosted($jobsPosted); ?>
                                
                                <!-- <ul>
                                    <?php foreach($jobsPosted as $job): ?>
                                    <li>
                                        <?php echo $job->title; ?>
                                    </li>
                                    <?php endforeach; ?>
                                </ul> -->
                                <?php endif; ?>
                            </div>

                        </div>

                    </div>
                    <!-- end .featured-jobs-->

                </div>
                <!-- end .mainbar -->

            </div>
            <!-- end .sidebar -->
        </div>
    </div>

</div>
<!-- end main content -->

<!-- footer -->
<?php include_once("{$seperator}layout/footer.php"); ?>
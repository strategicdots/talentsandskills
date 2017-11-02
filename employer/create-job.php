<?php $thisPage = "create-job"; $seperator="../"; 
include_once("{$seperator}includes/initialize.php");

/* check user status */
if (!$session->isEmployerLoggedIn()) {redirect_to("{$seperator}login.php"); } 
$employer = Employer::findDetails($session->employerID);

// deadline calculation
$time = strtotime("now"); 
$day = date('d', $time);  $month = date('m', $time);  $year = date('Y', $time);
?>

<!-- header -->
<?php include_once("{$seperator}layout/em-dashboard-header.php"); ?>
<!--  end header -->

<!--  main content  -->
<div class="inner-top dashboard">
    <div class=" p-heavy-breather">
        <div class="container">

            <div class="row">

                <!-- mainbar -->
                <div class="col-sm-9 mainbar">

                    <div class="jobs">
                        <div class="light-bx-shadow">
                            <div class="p-vlight-breather sec-bg p-mid-side-breather m-vlight-bottom-breather">
                                <p class="headfont uppercase no-margin">create a job posting</p>
                            </div>
                            <div class="p-mid-bottom-breather p-mid-side-breather">
                                <?php echo inline_errors(); ?>
                                <form method="post" action="../control/employer/job.php">
                                    <input type="hidden" name="type" value="post">
                                    <p class="headfont brandtxt-color capitalize">job prerequisites</p>
                                    <div class="row">
                                        <div class="col-sm-6">

                                            <!-- job title -->
                                            <div class="form-group">
                                                <label class="capitalize small-font-size">Job title </label>
                                                <input class="form-control" name="title" placeholder="Enter your job title" value="">
                                            </div>

                                            <!-- job field -->
                                            <div class="form-group">
                                                <label class="capitalize small-font-size">field </label>
                                                <select name="job_field" class="form-control">
                                                    <?php foreach($jobFields as $field): ?>
                                                    <option value="<?php echo ($field->name); ?>">
                                                        <?php echo ucwords($field->name); ?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <!-- candidate qualification -->
                                            <div class="form-group">
                                                <label class="capitalize small-font-size">candidate qualification </label>
                                                <select name="qualification" class="form-control">
                                                    <?php foreach($jobQualification as $name): ?>
                                                    <option value="<?php echo $name->qualification; ?>">
                                                        <?php echo ucwords($name->qualification); ?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <!-- candidate experience -->
                                            <div class="form-group">
                                                <label class="capitalize small-font-size">Candidate experience </label>
                                                <select name="job_experience" class="form-control">
                                                    <?php $n = 0; foreach($jobExperience as $experience): ?>
                                                    <option value="<?php echo $experience->years; ?>">

                                                        <?php if($n>0) {echo $experience->years . "years";}
                                                        else{ echo $experience->years; } $n++;
                                                        ?>

                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <!-- job deadline -->
                                            <div class="form-group">
                                                <label class="capitalize small-font-size">Job deadline </label>
                                                <div class="row">

                                                    <!-- deadline day -->
                                                    <div class="col-sm-4">
                                                        <select name="d" class="form-control">

                                                            <?php for($i = 1; $i<=31; $i++): if($i > $day): if($i<=9): ?>
                                                            <option value="<?php echo $i; ?>">0
                                                                <?php echo $i; ?>
                                                            </option>

                                                            <?php else : ?>
                                                            <option value="<?php echo $i; ?>">
                                                                <?php echo $i; ?>
                                                            </option>
                                                            <?php endif; endif; endfor; ?> ?>

                                                        </select>
                                                    </div>

                                                    <!-- deadline month -->
                                                    <div class="col-sm-4">
                                                        <select name="m" class="form-control">

                                                            <?php for($i = 1; $i<=12; $i++): if($i >= $month): if($i<=9): ?>
                                                            <option value="<?php echo $i; ?>">0
                                                                <?php echo $i; ?>
                                                            </option>

                                                            <?php else : ?>
                                                            <option value="<?php echo $i; ?>">
                                                                <?php echo $i; ?>
                                                            </option>
                                                            <?php endif; endif; endfor; ?> ?>

                                                        </select>
                                                    </div>

                                                    <!-- deadline year -->
                                                    <div class="col-sm-4">
                                                        <select name="y" class="form-control">

                                                            <?php for($i = $year; $i<=($year+1); $i++): if($i >= $year): if($i<=9): ?>
                                                            <option value="<?php echo $i; ?>">0
                                                                <?php echo $i; ?>
                                                            </option>

                                                            <?php else : ?>
                                                            <option value="<?php echo $i; ?>">
                                                                <?php echo $i; ?>
                                                            </option>
                                                            <?php endif; endif; endfor; ?> ?>

                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                    <div class='input-group date' id='datetimepicker1'>
                                                        <input type='text' class="form-control" />
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                        </span>
                                                    </div>
                                                </div>

                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-sm-6">

                                            <!-- job type -->
                                            <div class="form-group">
                                                <label class="capitalize small-font-size">Job Type </label>
                                                <select name="job_type" class="form-control">
                                                    <?php foreach($jobType as $type): ?>
                                                    <option value="<?php echo $type->type; ?>">
                                                        <?php echo ucwords($type->type); ?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <!-- job location -->
                                            <div class="form-group">
                                                <label class="capitalize small-font-size">Job Location </label>
                                                <select name="location" class="form-control">
                                                    <?php foreach($states as $state): ?>
                                                    <option value="<?php echo $state->name; ?>">
                                                        <?php echo ucwords($state->name); ?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <!-- salary range -->
                                            <div class="form-group">
                                                <label class="capitalize small-font-size">salary range </label>
                                                <select name="salary_range" class="form-control">
                                                    <?php foreach($salaryRange as $range): ?>
                                                    <option value="<?php echo $range->salary_range; ?>">
                                                        <?php echo formatSalaryRange($range->salary_range); ?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <!-- keywords -->
                                            <div class="form-group">
                                                <label class="capitalize small-font-size">job keywords </label>
                                                <input type="text" class="form-control" name="keywords" placeholder="seperate each keyword with a comma(,)">
                                            </div>

                                        </div>
                                    </div>
                                    <hr>

                                    <!-- job description -->
                                    <div classs="">
                                        <p class="headfont brandtxt-color capitalize">job description</p>
                                        <div class="form-group">
                                            <p class="small-font-size">
                                                <span class="txt-bold brandtxt-color">NB: </span>Describe the nature of the job in details.
                                                <br> Remember to list out
                                                <span class="txt-bold uppercase">responsibities of candidates and job requirements. </span>
                                            </p>
                                            <textarea name="description" id="" class="form-control m-mid-bottom-breather ckeditor"></textarea>
                                        </div>
                                    </div>

                                    <div class="m-mid-top-breather sm-container">
                                        <input class="btn sec-btn form-control" type="submit" name="submit" value="Confirm and Post Job">
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- sidebar -->
                <div class="sidebar col-sm-3">

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

            </div>
            <!-- end .featured-jobs-->

        </div>
        <!-- end .mainbar -->

    </div>

</div>
<!-- end main content -->

<!-- footer -->
<?php include_once("{$seperator}layout/footer.php"); ?>
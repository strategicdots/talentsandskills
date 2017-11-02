<?php $thisPage = "settings"; $seperator="../"; 
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

                    <!-- account settings -->
                    <div class="">
                        <div class="light-bx-shadow">
                            <div class="p-vlight-breather sec-bg p-mid-side-breather m-light-bottom-breather">
                                <p class="headfont uppercase no-margin">account settings </p>
                            </div>


                            <div class="p-light-bottom-breather p-heavy-side-breather">

                                <div class=" m-light-bottom-breather">
                                    <!--<p class="capitalize txt-bold">change your account settings</p>-->

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <!-- password -->
                                            <div class="m-light-bottom-breather">
                                                <p class="capitalize no-margin txt-bold">Password</p>
                                                <p class="mid-font-size capitalize">
                                                    <a href="" class="" id="">change password</a>
                                                </p>
                                                <div class="hide-el">
                                                    <form action="" method="post">
                                                        <div class="form-group">
                                                            <label class="capitalize small-font-size">Enter your old password</label>
                                                            <input class="form-control" type="password" name="old_password" placeholder="Enter your old password">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="capitalize small-font-size">Enter your new password</label>
                                                            <input class="form-control" type="password" name="password" placeholder="Enter your new password">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="capitalize small-font-size">confirm your new password</label>
                                                            <input class="form-control" type="password" name="confirm_password" placeholder="Confirm your new password">
                                                        </div>
                                                        <input type="submit" value="submit" class="btn sec-btn form-control">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <!-- email -->
                                            <div class="m-light-bottom-breather">
                                                <p class=" capitalize no-margin txt-bold">Email</p>
                                                <p class="mid-font-size capitalize">
                                                    <?php echo $candidate->email; ?>
                                                    <br>
                                                    <a href="" class="" id="">change email</a>
                                                </p>
                                                <div class="hide-el">
                                                    <form method="post" action="">
                                                        <div class="form-group">
                                                            <label class="capitalize small-font-size">enter your new email</label>
                                                            <input class="form-control" type="email" name="email" placeholder="enter your new email">
                                                        </div>
                                                        <input type="submit" value="submit" class="btn sec-btn form-control">

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <!-- avatar -->
                                            <div class="m-light-bottom-breather">
                                                <p class="capitalize no-margin txt-bold m-vlight-bottom-breather">profile avatar </p>
                                                <p class="mid-font-size capitalize">
                                                    <?php if($candidate->avatar_url): ?>
                                                    <img src="<?php echo $candidate->avatar_url; ?>" class="img-responsive" style="width: 100px;">
                                                    <?php else: ?>
                                                    <img src="../img/candidate-placeholder.jpg" class="img-responsive" style="width: 100px;">
                                                    <?php endif; ?>
                                                    <a href="" class="" id="">change avatar </a>
                                                </p>

                                                <div class="hide-el">
                                                    <form method="post" action="" enctype="multipart/form-data">
                                                        <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo maxFileSize(); ?>">

                                                        <div class="form-group">
                                                            <label class="capitalize small-font-size">browse to select a new avatar </label>
                                                            <input class="" type="file" name="upload">
                                                        </div>
                                                        <input type="submit" value="submit" class="btn sec-btn form-control">

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                    <!-- account settings -->

                </div>
                <!-- end .mainbar -->

            </div>

        </div>
    </div>
</div>
<!-- end main content -->

<!-- footer -->
<?php include_once("{$seperator}layout/footer.php"); ?>
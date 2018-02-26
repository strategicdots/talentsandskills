<?php $thisPage = "settings"; $seperator="../"; $navbarType = "candidate";
include_once("{$seperator}includes/initialize.php");

/* check user status */
if (!$session->isCandidateLoggedIn()) {redirect_to("{$seperator}login.php"); } 

// Form Submission and redirection to control file
if ($_POST['submit']) {

    $session->postValues($_POST);
    $session->fileValues($_FILES);

    $action = "{$seperator}control/candidate/settings.php";
    redirect_to($action);

}

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
                                <?php echo inline_errors();?>
                                <?php echo inline_message(); ?>


                                    <div class="row">
                                        <!-- password -->
                                        <div class="col-sm-6">
                                            <div class="m-light-bottom-breather">
                                                <p class="capitalize no-margin txt-bold">Password</p>
                                                <p class="mid-font-size">
                                                    <a href="" class="" id="chng-pwd">Change Password</a>
                                                </p>

                                                <!-- password form -->
                                                <div class="hide-el" id="pswd-div">
                                                    <form action="" method="post" class="sm">
                                                        <div class="form-group">
                                                            <label class="capitalize small-font-size">Enter your old password</label>
                                                            <input class="form-control" type="password" name="password" placeholder="Enter your old password">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="capitalize small-font-size">Enter your new password</label>
                                                            <input class="form-control" type="password" name="new_password" placeholder="Enter your new password">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="capitalize small-font-size">confirm your new password</label>
                                                            <input class="form-control" type="password" name="confirm_password" placeholder="Confirm your new password">
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-8">
                                                                <input type="submit" name="submit" value="submit" class="capitalize btn sec-btn form-control">
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <a href="" class="btn main-btn capitalize form-control" id="cx-pswd">cancel</a>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- email -->
                                        <div class="col-sm-6">
                                            <div class="m-light-bottom-breather">
                                                <p class=" capitalize no-margin txt-bold">Email</p>
                                                <p class="mid-font-size">
                                                    <?php echo $candidate->email; ?>
                                                    <br>
                                                    <a href="" class="" id="chng-email">Change Email</a>
                                                </p>

                                                <!-- email form -->
                                                <div class="hide-el" id="email-div">
                                                    <form method="post" action="" class="sm">
                                                        <div class="form-group">
                                                            <label class="capitalize small-font-size">enter your new email</label>
                                                            <input class="form-control" type="email" name="email" placeholder="enter your new email">
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-8">
                                                                <input type="submit" name="submit" value="submit" class="btn sec-btn form-control capitalize">
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <a href="" class="form-control capitalize btn main-btn" id="cx-email">cancel</a>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    
                                    </div>

                                    <div class="row">
                                        
                                        <!-- avatar -->
                                        <div class="col-sm-6">
                                            <div class="m-light-bottom-breather">
                                                <p class="capitalize no-margin txt-bold m-vlight-bottom-breather">profile avatar </p>
                                                <p class="mid-font-size capitalize">
                                                    <?php if($candidate->avatar_url): ?>
                                                    <img src="<?php echo $candidate->avatar_url; ?>" class="img-responsive" style="width: 100px;">
                                                    <?php else: ?>
                                                    <img src="../img/candidate-placeholder.jpg" class="img-responsive" style="width: 100px;">
                                                    <?php endif; ?>
                                                    <a href="" class="" id="chng-avtr">change avatar </a>
                                                </p>

                                                <!-- avatar form -->
                                                <div class="hide-el" id="avtr-div">
                                                    <form method="post" class="sm" action="" enctype="multipart/form-data">
                                                        <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo maxFileSize(); ?>">

                                                        <?php if(!empty($candidate->avatar_url)): ?>
                                                        <input type="hidden" name="type" value="update">
                                                        <?php endif; ?>

                                                        <div class="form-group">
                                                            <label class="capitalize small-font-size">browse to select a new avatar </label>
                                                            <input class="" type="file" name="avatar">
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-8">
                                                                <input type="submit" name="submit" value="submit" class="btn sec-btn form-control capitalize">
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <a href="" class="form-control capitalize btn main-btn" id="cx-avtr">cancel</a>
                                                            </div>
                                                        </div>

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
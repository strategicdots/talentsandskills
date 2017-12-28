<?php $thisPage = "dashboard";
$seperator = "../";
$navbarType = "intern";
include_once("{$seperator}includes/initialize.php");

/* check user status */
if (!$session->isInternLoggedIn()) { redirect_to("{$seperator}login.php"); }
$intern = Intern::findDetails($session->internID);

?>

<!-- header -->
<?php include_once("{$seperator}layout/dashboard-header.php"); ?>
<!--  end header -->

<!--  main content  -->
<div class="inner-top dashboard">
    <div class=" p-heavy-breather">
        <div class="container">
            <div class="row">

                <!-- sidebar -->
                <div class="sidebar col-sm-4">
                    <?php echo internSidebar($intern); ?>
                </div>

                <!-- mainbar -->
                <div class="col-sm-8 mainbar">
                    <?php echo inline_message(); ?>
                    
                    <?php if (empty($intern->cv_path)) : ?>
                    <div class="m-mid-bottom-breather">
                        <div class="light-bx-shadow">
                            <div class="p-vlight-breather sec-bg p-mid-side-breather m-vlight-bottom-breather">
                                <p class="headfont uppercase no-margin">upload your resume / cv here</p>
                            </div>


                            <div class="p-light-bottom-breather p-mid-side-breather">
                                <!-- cv form -->
                                <?php echo inline_errors(); ?>
                                <form method="post" action="<?php echo $seperator; ?>control/intern/cv.php" enctype="multipart/form-data">
                                    <div class="m-light-bottom-breather">
                                        <ul class="no-list-style no-left-padding">
                                            <li>The file size must not be more than
                                                <span class="txt-bold">500KB</span>
                                            </li>
                                            <li>File format must be any of these:
                                                <span class="txt-bold">.pdf, .docx, .doc </span>
                                            </li>
                                        </ul>
                                    </div>

                                    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo maxCVSize(); ?>">

                                    <div class="form-group">
                                        <input type="file" name="upload" style="padding-left: 0;">
                                    </div>

                                    <input type="submit" name="submit" value="upload cv / resume" class="btn uppercase m-vlight-top-breather sec-btn mid-font-size">
                                </form>
                            </div>

                        </div>

                    </div>
                    <?php endif; ?>

                    <div class="blog m-mid-top-breather">
                        <div class="light-bx-shadow">
                            <div class="p-vlight-breather sec-bg p-mid-side-breather m-vlight-bottom-breather">
                                <p class="headfont uppercase no-margin">profile settings</p>
                            </div>
                            <div class="p-light-bottom-breather p-mid-side-breather">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="">
                                            <p class="mid-font-size capitalize no-margin txt-bold">Email</p>
                                            <p class="small-font-size">
                                                <?php 
                                                if (!isset($intern->email)) {
                                                      echo "You don't have any email in our records";
                                                }

                                                echo $intern->email;
                                                ?>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="">
                                            <p class="mid-font-size capitalize no-margin txt-bold">Phone Number</p>
                                            <p class="small-font-size">
                                                <?php
                                                if (!isset($intern->phone)) {
                                                      echo "You don't have any phone number in our records";
                                                } 
                                                
                                                echo $intern->phone;
                                                
                                                ?>
                                            </p>

                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="">
                                            <p class="mid-font-size capitalize no-margin txt-bold">Date of Birth</p>
                                            <p class="small-font-size">
                                                <?php
                                                if (!isset($intern->dob)) {
                                                      echo "You haven't updated your date of birth";
                                                } 
                                                
                                                echo $intern->dob;
                                                
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row m-light-top-breather">

                                    <div class="col-sm-4">
                                        <div class="">
                                            <p class="mid-font-size capitalize no-margin txt-bold">Gender</p>
                                            <p class="small-font-size">
                                                <?php
                                                if (!isset($intern->gender)) {
                                                      echo "You haven't updated your gender status";
                                                } 
                                                      
                                                echo $intern->gender;
                                                
                                                ?>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="">
                                            <p class="mid-font-size capitalize no-margin txt-bold">Location</p>
                                            <p class="small-font-size">
                                                <?php
                                                if (!isset($intern->location)) {
                                                      echo "You haven't updated your current location";
                                                } 
                                                      
                                                echo $intern->location;
                                                
                                                ?>
                                            </p>
                                        </div>
                                    </div>

                                </div>

                                <div class="clearfix m-mid-top-breather sm-container">
                                    <a href="my-profile.php" class="btn sec-btn capitalize form-control">update your profile</a>
                                </div>
                            </div>

                        </div>



                    </div>
                    <!-- end .featured-jobs-->


                </div> <!-- end .mainbar -->

            </div> <!-- end .row -->
        </div><!-- end .container -->
    </div>

</div>
<!-- end main content -->

<!-- footer -->
<?php include_once("{$seperator}layout/footer.php"); ?>
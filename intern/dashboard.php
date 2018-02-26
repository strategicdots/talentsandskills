<?php $thisPage = "dashboard";
$seperator = "../";
$navbarType = "intern";
include_once("{$seperator}includes/initialize.php");

// Form Submission and redirection to control file
if ($_POST['submit']) {

    $session->postValues($_POST);
    $session->fileValues($_FILES);

    $action = "{$seperator}control/intern/intern-letter.php";
    redirect_to($action);

}

/* check user status */
if (!$session->isInternLoggedIn()) { redirect_to("{$seperator}login.php"); }
$intern = Intern::findDetails($session->internID);

// check if intern has registered for internship spot
$internRegistration = InternshipDetails::findByInternID($intern->id);

if($internRegistration) {
    $intershipRequests = Internships::findAllUnderParent($internRegistration[0]->id, "details_id");
    
    // get and append pagination properties
    $per_page = (int) 2;
    $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
    $total_count = count($intershipRequests);

    // initialize pagination
    $pagination = new Pagination($page, $per_page, $total_count);

    // load $jobs to get total job items
    $pagination->load($intershipRequests);

    // get the job posted per page
    $internshipsPerPage = $pagination->pageItems();

}
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
                                <p class="headfont uppercase no-margin">upload your internship letter here</p>
                            </div>


                            <div class="p-light-bottom-breather p-mid-side-breather">
                                <!-- cv form -->
                                <?php echo inline_errors(); ?>
                                <form method="post" action="" enctype="multipart/form-data">
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

                                    <input type="submit" name="submit" value="upload letter" class="btn uppercase m-vlight-top-breather sec-btn mid-font-size">
                                </form>
                            </div>

                        </div>

                    </div>
                    <?php endif; ?>

                    <div class="m-mid-bottom-breather">
                        
                        <!-- internship requests -->
                        <div class="light-bx-shadow">
                            <div class="p-vlight-breather sec-bg p-mid-side-breather m-vlight-bottom-breather">
                                <p class="headfont uppercase no-margin">companies that want to employ you</p>
                            </div>
                            
                            <div class="p-light-bottom-breather p-mid-side-breather">
                                <?php echo inline_message(); ?>

                                <?php if (!$internRegistration) : ?>
                                <p>You haven't registered for an internship spot.
                                    <a href="register.php">Click Here</a> to register</p>
                                
                                <?php elseif(empty($internshipsPerPage)) : ?>
                                <p>You haven't been invited by any companies yet.</p>
                                
                                <?php else : 

                                    // calculating last item on the last page
                                    // this is total number of items on previous pages
                                $n = $per_page * ($page - 1);

                                echo internshipRequests($internshipsPerPage, $n);
                                ?>

                                <!-- pagination buttons -->
                                <?php echo paginationNavigation($pagination, $page); ?>

                                <?php endif; ?>
                            </div>

                        </div>
                        <!-- end job posted -->

                    </div>

                    <div class="">
                        <div class="light-bx-shadow">
                            <div class="p-vlight-breather sec-bg p-mid-side-breather m-vlight-bottom-breather">
                                <p class="headfont uppercase no-margin">profile settings</p>
                            </div>

                            <div class="p-light-bottom-breather p-mid-side-breather">
                                <?php echo internDashboardProfile($intern); ?>
                            </div>

                        </div>

                    </div>
                    <!-- end .featured-jobs-->

                </div>
                <!-- end .mainbar -->

            </div>
            <!-- end .row -->
        </div>
        <!-- end .container -->
    </div>

</div>
<!-- end main content -->

<!-- footer -->
<?php include_once("{$seperator}layout/footer.php"); ?>
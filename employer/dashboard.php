<?php $thisPage = "dashboard"; $seperator="../"; 
include_once("{$seperator}includes/initialize.php");

/* check user status */
if (!$session->isEmployerLoggedIn()) {redirect_to("{$seperator}login.php"); } 
$employer   = Employer::findDetails($session->employerID);

// get and append pagination properties
$per_page = (int) 5;
$page = !empty($_GET['page']) ? (int) $_GET['page'] : 1;
$total_count = count(Jobs::findAllUnderParent($employer->id, "employer_id"));

// initialize pagination
$pagination = new Pagination($page, $per_page, $total_count);

// get the job posted per page
$jobsPerPage = Jobs::findAllUnderParent($employer->id, "employer_id", $order = true, $pagination);

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
                   <?php echo employerSidebar($employer); ?>
                </div>

                <!-- mainbar -->
                <div class="col-sm-8 mainbar">

                    <div class="jobs m-mid-bottom-breather">
                        
                        <!-- job posted -->
                        <div class="light-bx-shadow">
                            <div class="p-vlight-breather sec-bg p-mid-side-breather m-vlight-bottom-breather">
                                <p class="headfont uppercase no-margin">your job postings</p>
                            </div>
                            <div class="p-light-bottom-breather p-mid-side-breather">

                                <?php echo inline_message(); ?>

                                <?php if(!$jobsPerPage): ?>
                                <p>You don't have any job postings yet. <a href="create-job.php">Click Here</a> to create one</p>

                                <?php else: 

                                    // calculating last item on the last page
                                    // this is total number of items on previous pages
                                    $n = $per_page * ($page - 1);
                                    
                                    echo jobPosted($jobsPerPage, $n);
                                ?>

                                <!-- pagination buttons -->
                                <?php echo paginationNavigation($pagination, $page); ?>
                                
                                <?php endif; ?>
                            </div>

                        </div> <!-- end job posted -->

                    </div>
                    
                    <!-- orders -->
                    <div class="orders m-mid-bottom-breather">
                        <div class="light-bx-shadow">
                            <div class="p-vlight-breather sec-bg p-mid-side-breather m-vlight-bottom-breather">
                                <p class="headfont uppercase no-margin">my subscription</p>
                            </div>
                            <div class="p-light-bottom-breather p-mid-side-breather">

                                <?php if(empty($employer->subscription)): ?>
                                    
                                    <p>You have not yet subscribed to any package. <a href="subscription.php">Click here to subscribe</a></p>
                                
                                <?php else: ?>
                                
                                    <p>This is it</p>

                                <?php endif; ?>
                            </div>

                        </div>

                    </div> <!-- end orders-->

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
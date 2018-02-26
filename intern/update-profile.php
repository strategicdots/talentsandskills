<?php $thisPage = "my-profile"; $seperator="../"; $navbarType = "intern";
include_once("{$seperator}includes/initialize.php");

/* check user status */
if (!$session->isInternLoggedIn()) {
    redirect_to("{$seperator}login.php");
}

$intern = Intern::findDetails($session->internID);

// Form Submission and redirection to control file
$action = "{$seperator}control/intern/profile.php";
if ($_POST['submit']) {
    $session->postValues($_POST);
    redirect_to($action);
}


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
                    <?php echo internSidebar($intern); ?>
                </div>

                <!-- mainbar -->
                <div class="col-sm-8 mainbar">

                    <div class="">
                        <div class="light-bx-shadow">
                            <div class="p-vlight-breather sec-bg p-mid-side-breather m-vlight-bottom-breather">
                                <p class="headfont uppercase no-margin">personal details </p>
                            </div>

                            <div class="p-light-bottom-breather p-mid-side-breather">
                                <?php echo inline_errors(); ?>
                                <?php echo pdFormIntern($intern); ?>
                            </div>

                        </div>
                    </div>
                    <!-- end personal details -->

                </div>
                <!-- end .mainbar -->

            </div>

        </div>
    </div>
</div>
<!-- end main content -->

<!-- footer -->
<?php include_once("{$seperator}layout/footer.php"); ?>
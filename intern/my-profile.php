<?php $thisPage = "my-profile"; $seperator="../"; $navbarType = "intern";
include_once("{$seperator}includes/initialize.php");

/* check user status */
if (!$session->isInternLoggedIn()) {
    redirect_to("{$seperator}login.php");
}
$intern = Intern::findDetails($session->internID);

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

                    <!-- personal details -->
                    <div class="pd">
                        <div class="light-bx-shadow">
                            <div class="p-vlight-breather sec-bg p-mid-side-breather m-vlight-bottom-breather">
                                <p class="headfont uppercase no-margin">personal details </p>
                            </div>

                            <div class="p-light-bottom-breather p-mid-side-breather">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="">
                                            <p class="mid-font-size capitalize no-margin txt-bold">Email</p>
                                            <p class="small-font-size">
                                                <?php 
                                                
                                                if (!isset($intern->email)) {
                                                    echo "You haven't updated your email address";
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
                                                if (!isset($intern->gender))  {
                                                    
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

                                <div class="clearfix small-font-size">
                                    <a href="update-profile.php?type=personal_details" class="btn sec-btn capitalize pull-right">edit</a>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- personal details -->

                </div>
                <!-- end .mainbar -->

            </div>

        </div>
    </div>
</div>
<!-- end main content -->

<script>
</script>

<!-- footer -->
<?php include_once("{$seperator}layout/footer.php"); ?>
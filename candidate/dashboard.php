<?php $thisPage = "dashboard"; $seperator="../"; 
include_once("{$seperator}includes/initialize.php"); ?>

<!-- header -->
<?php include_once("{$seperator}layout/dashboard-header.php"); ?>
<!--  end header -->

<!--  main content  -->
<div class="inner-top dashboard">
    <div class=" p-heavy-breather">
        <div class="container">
            <div class="row">

                <!-- mainbar -->
                <div class="col-sm-8 mainbar">
                    <div class=" biodata p-heavy-side-breather light-bx-shadow white-bg p-heavy-breather">
                        <div class="row">
                            <div class="col-sm-2 bioimage">
                                <img class="img-center img-circle" src="../img/candidate-placeholder.jpg" alt="">
                            </div>
                            <div class="col-sm-10 bio-details">
                                <div class="row">
                                    <div class="col-sm-7">
                                        <h1 class="bio-name">Yusuf Rafiu</h1>
                                        <h3 class="discpln secheadfont">PHP Developer <span class="">|</span> Lagos</h3>
                                    </div>
                                    <div class="col-sm-5">
                                        <!--<p class="">Your profile is 65% complete. </p>-->
                                    </div>
                                </div>

                                <!-- progress-bar -->
                                <p class="no-margin small-font-size secheadfont capitalize">profile strength: 65%</p>
                                <div class="progress-bar">
                                    <progress max="100" value="65" class="">
                                        <!-- Browsers that support HTML5 progress element will ignore the html inside `progress` element. Whereas older browsers will ignore the `progress` element and instead render the html inside it. -->
                                        <div class="progress-bar">
                                            <span style="width: 65%; height: inherit;"></span>
                                        </div>
                                    </progress>

                                </div> <!-- end .progress-bar -->

                            </div>
                        </div>
                    </div> <!-- end .biodata -->

                    <div class="jobs m-mid-top-breather">
                        <div class="light-bx-shadow">
                            <div class="p-vlight-breather gray-bg p-mid-side-breather m-vlight-bottom-breather">
                                <p class="headfont uppercase no-margin">Featured jobs</p>
                            </div>
                            <div class="p-light-bottom-breather p-mid-side-breather">
                                <ul class="no-list-style no-left-padding">
                                    <li><a href="">acountant manager at JUMIA Nigeria</a></li>
                                    <li><a href="">senior marketing manager at GE</a></li>
                                    <li><a href="">Graduate Trainee at Stanbic IBTC</a></li>
                                    <li><a href="">trained accountant at FARGO Nigeria</a></li>
                                    <li><a href=""> manager at KONGA Nigeria</a></li>
                                </ul>
                            </div>

                        </div>



                    </div> <!-- end .featured-jobs-->

                    <div class="blog m-mid-top-breather">
                        <div class="light-bx-shadow">
                            <div class="p-vlight-breather gray-bg p-mid-side-breather m-vlight-bottom-breather">
                                <p class="headfont uppercase no-margin">talentandskills career advice and articles</p>
                            </div>
                            <div class="p-light-bottom-breather p-mid-side-breather">
                                <ul class="no-list-style no-left-padding">
                                    <li><a href="">acountant manager at JUMIA Nigeria</a></li>
                                    <li><a href="">senior marketing manager at GE</a></li>
                                    <li><a href="">Graduate Trainee at Stanbic IBTC</a></li>
                                    <li><a href="">trained accountant at FARGO Nigeria</a></li>
                                    <li><a href=""> manager at KONGA Nigeria</a></li>
                                </ul>
                            </div>

                        </div>



                    </div> <!-- end .featured-jobs-->


                </div> <!-- end .mainbar -->

                <div class="sidebar col-sm-4">

                    <!-- shortlisted jobs -->
                    <div class="light-bx-shadow m-mid-bottom-breather">
                        <div class="p-vlight-breather sec-bg p-mid-side-breather">
                            <p class="headfont uppercase no-margin text-center">shortlisted jobs</p>
                        </div>
                        <div class="p-mid-side-breather p-light-breather">
                            <p class="">You haven't shortlisted any jobs</p>
                        </div>
                    </div>

                    <!-- applied jobs -->
                    <div class="light-bx-shadow m-mid-bottom-breather">
                        <div class="p-vlight-breather sec-bg p-mid-side-breather">
                            <p class="headfont uppercase no-margin text-center">applied jobs</p>
                        </div>
                        <div class="p-mid-side-breather p-light-breather">
                            <p class="">You haven't applied for any job</p>
                        </div>
                    </div>


                    <!-- sidebar form-->
                    <div class="light-bx-shadow m-mid-bottom-breather">
                        <div class="p-vlight-breather sec-bg p-mid-side-breather">
                            <p class="headfont uppercase no-margin text-center">browse jobs</p>
                        </div>
                        <div class="p-mid-side-breather p-light-breather">
                            <form method="post" action="">
                                <div class="form-group">
                                    <input type="text" name="keyword" class="form-control" placeholder="job title, skills or company">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="location" class="form-control" placeholder="location">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="submit" value="submit" class="form-control btn sec-btn uppercase">
                                </div>
                            </form>
                        </div>
                    </div> 


                    <!-- profile -->
                    <!--<div class="profile">
<ul class="">
<li class="active"><a href="">My Profile</a></li>
<li><a>My Resume</a>
<div id="">
<ul>
<li><a href="#education">Education</a></li>
<li><a href="#experience">Experience</a></li>
<li><a href="#portfolio">Portfolio</a></li>
<li><a href="#skills">Skills</a></li>
<li><a href="#awards">Honors Award</a></li>
</ul>
</div>
</li>
<li><a href="">Shortlisted jobs</a></li>
<li><a href=""> Applied jobs</a></li>
<li><a href=""> Job Alerts</a></li>
<li><a href="">CV &amp; Cover Letter</a></li>
<li><a href="">Change Password</a></li>
<li><a href="">Logout</a></li>
</ul>
</div>
--><!-- end .profile -->

                </div> <!-- end .sidebar -->
            </div>
        </div> 

        <!-- .sidebar -->

    </div>
</div>
<!-- end .topbar -->

<!-- footer -->
<?php include_once("{$seperator}layout/footer.php"); ?>
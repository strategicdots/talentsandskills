<?php $thisPage = "register"; $seperator="../"; 
include_once("{$seperator}includes/initialize.php"); ?>

<!-- header -->
<?php include_once("{$seperator}layout/header.php"); ?>
<!--  end header -->

<!--  main content  -->
<div class="container inner-top p-heavy-top-breather">

    <section class="dashboard">

        <div class="row" id="">

            <!-- .mainbar -->
            <div class="mainbar col-sm-9" id="">
            </div> <!--  end .mainbar -->

            <!-- .sidebar -->
            <div class="sidebar col-sm-3">

                <!-- profile -->
                <ul class="profile">
                    <li id="" class="active">
                        <a href=""><i class="icon-user9"></i>My Profile</a>
                    </li>

                    <li id="">
                        <a id=""><i class="icon-newspaper4"></i>My Resume</a>
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
                    <li id="">
                        <a id=""><i class="icon-heart6"></i>Shortlisted jobs</a>
                    </li>
                    <li id="">
                        <a id=""><i class="icon-briefcase2"></i> Applied jobs</a>
                    </li>

                    <li id="" class="">
                        <a id="">
                            <i class="icon-bell-o"></i>Job Alerts
                        </a>
                    </li>
                    <li id="">
                        <a id=""><i class="icon-vcard"></i>CV &amp; Cover Letter</a>
                    </li>
                    <li id="">
                        <a id=""><i class="icon-key4"></i>Change Password</a>
                    </li>
                    <li><a href=""><i class="icon-logout"></i>Logout</a></li>
                </ul>

                <!-- .skill-percent -->
                <div class="skill-percent">
                    <div class="skills-percentage-bar">
                        <h6>Skills Percentage:</h6>
                        <div class="skill-process"><span>0%</span></div>
                    </div>
                </div>

            </div>
            <!-- end .sidebar -->

        </div>
    </section>
</div>

<!-- footer -->
<?php include_once("{$seperator}layout/footer.php"); ?>
<footer id="footer" class="white-bg m-heavy-top-breather p-heavy-breather">
    <div class="">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="footer-bx nwslttr">
                            <h4 class="hdln">Newsletter</h4>
                            <div class="">
                                <p>Subscribe to TalentsandSkills  newsletter to be the first to know about current recruitment solution, Latest articles,  Jobs / Vacancies updates.</p>
                                <form action="" method="post" class="m-light-top-breather ">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="email" placeholder="Enter Your Email Address">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn main-btn form-control" name="submit" value="Submit">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> 
                    <div class="col-sm-4">
                        <div class="footer-bx">
                            <h4 class="hdln">Important Pages</h4>
                            <ul class="no-left-padding">
                                <li class=""><a href="<?php echo $seperator; ?>about-us.php">About Us</a></li>
                                <li class=""><a href="">Recruiting  Services</a></li>
                                <li class=""><a href="<?php echo $seperator; ?>cv-packages.php"">CV Packages</a></li>
                                <li class=""><a href="">Terms and Conditions</a></li>
                                <li class=""><a href="">Contact Us</a></li>
                                <li class=""><a href="">Employer</a></li>
                                <li class=""><a href="">Candidate</a></li>
                                <li class=""><a href="">Coporate Training</a></li>
                                <li class=""><a href="">Register</a></li>
                                <li class=""><a href="">Employer Resume Access Packages</a></li>
                            </ul>
                        </div> 
                    </div> 
                    <div class="col-sm-4">
                        <div class="footer-bx">
                            <h4 class="hdln">Contact Us</h4>
                            <div class="">
                                <address>
                                    <span> 
                                        Our Address <br />167c 332 Ikorodu Road, Anthony Village/Maryland, Lagos<br />+234 8125771958, +234 8058805444,          +234 8058805333,<br>
                                        admin@talentsandskills.net                            
                                    </span>

                                </address>
                                <div id="social">
                                    <ul class="social-links clearfix">             
                                        <li class="facebook"><a href="" title="Facebook" target="_blank"><i class="icon-facebook"></i></a></li>
                                        <li class="googleplus"><a href="" title="Google+" target="_blank"><i class="icon-google-plus"></i></a></li>
                                        <li class="twitter"><a href="" title="Twitter" target="_blank"><i class="icon-twitter"></i></a></li>
                                        <li class="youtube"><a href="" title="YouTube" target="_blank"><i class="icon-youtube"></i></a></li>
                                        <li class="linkedin"><a href="" title="LinkedIN" target="_blank"><i class="icon-linkedin"></i></a></li>
                                    </ul>
                                </div><br />

                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</footer> 

<script type="text/javascript" src="<?php echo $seperator; ?>js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="<?php echo $seperator; ?>js/bootstrap.min.js"></script>
<?php if($thisPage == "my-profile"): ?> 
<script type="text/javascript" src="<?php echo $seperator;?>js/profile.js"></script>

<?php elseif($thisPage == "apply-job" || $thisPage == "create-job"): ?>
<script type="text/javascript" src="<?php echo $seperator;?>ckeditor/ckeditor.js"></script>

<?php elseif($thisPage == "settings" || $thisPage == "employer_profile"): ?>
<script type="text/javascript" src="<?php echo $seperator;?>js/settings.js"></script>

<?php endif; ?>
<?php // if($thisPage == "create-job"): ?>

<?php // endif; ?>

</body>
</html>
<?php $thisPage = "login"; $seperator=""; 
include_once("includes/initialize.php"); 
if($session->isLoggedIn()) {
    redirect_to("candidate/dashboard.php"); 
}
?>

<!-- header -->
<?php include_once("layout/header.php"); ?>

<!-- login form -->
<div class="inner-top login">
    <div class="sm-container margin-auto m-mid-breather p-heavy-breather p-heavy-side-breather">
        <form method="post" action="control/login.php" class=" p-heavy-side-breather m-mid-breather p-mid-breather white-bg">
            <h2 class="text-center">Login</h2>

            <div class="sm-container m-mid-top-breather">
                <?php echo inline_message(); ?>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="text" name="email" class="form-control" placeholder="Enter Your Email Address">
                </div>

                <div class="form-group">
                    <label for="email">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter Your Email Address">
                </div>

                <input type="submit" name="submit" class="btn capitalize main-btn form-control" value="login">
            </div>
            <p class="lead capitalize text-center m-light-top-breather"><a href="" class="brandtxt-color">forgot your password?</a></p>


        </form>
    </div>


</div>

<!-- footer -->
<?php include_once("layout/footer.php"); ?>
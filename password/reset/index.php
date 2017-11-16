<?php $thisPage = ""; $seperator="../../"; 
include_once("{$seperator}includes/initialize.php"); 
?>

<!-- header -->
<?php include_once("{$seperator}layout/header.php"); ?>

<!-- password reset form -->
<div class="inner-top login">
    <div class="sm-container margin-auto m-mid-breather p-heavy-breather p-heavy-side-breather">
        <form method="post" action="" class=" p-heavy-side-breather m-mid-breather p-mid-breather white-bg">
            <h2 class="text-center">Forgot Your Password?</h2>
            <p class="text-center small-font-size">Enter your email address below and we'll get back to you with instructions for resetting your password.</p>

            <div class="sm-container m-mid-top-breather">
                <?php echo inline_message(); ?>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="text" name="email" class="form-control" placeholder="Enter Your Email Address">
                </div>

                <input type="submit" name="submit" class="btn capitalize main-btn form-control" value="reset your password">
            </div>

        </form>
    </div>


</div>

<!-- footer -->
<?php include_once("{$seperator}layout/footer.php"); ?>
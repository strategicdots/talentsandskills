<?php $thisPage = "verification"; $seperator = "../";
require_once("{$seperator}includes/initialize.php");

// confirm if token has expired
/* if((!isset($_SESSION['expiredToken']) || ($_SESSION['expiredToken'] == false))) {
    redirect_to("{$seperator}login.php");
} */

//  header 
 include_once("{$seperator}layout/header.php");
?>

<div class="inner-top verification">
      <div class="sm-container margin-auto m-mid-breather p-heavy-breather p-heavy-side-breather">
            <form action="<?php echo $seperator; ?>control/verification.php" method="post" class="p-heavy-side-breather m-mid-breather p-mid-breather white-bg">
                  <h2 class="text-center">Verify Your Account</h2>
                  <p class="text-center small-font-size">Enter your email address below to verify your TalentsAndSkills account.</p>
                  <div class="sm-container m-mid-top-breather">

                        <?php if(isset($_SESSION['verificationMail']) && $_SESSION['verificationMail']): 
                              // session message will be echoed.
                              // and it's enough
                              ?>

                        <?php else: ?>
                        <div class="form-group">
                              <label for="email">Enter Your Email</label>
                              <input class="form-control" placeholder="Enter your registered email address" name="email" type="text" value="">
                        </div>

                        <input type="submit" name="submit" class="btn capitalize main-btn form-control" value="send verification email">
                  </div>
            </form>
            <?php endif; ?>
      </div>
</div>

<!-- footer -->
<?php include_once("{$seperator}layout/footer.php"); ?>
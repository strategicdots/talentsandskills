<?php $thisPage = "verification"; $seperator = "../";
require_once("{$seperator}includes/initialize.php");

/* if((!isset($_SESSION['expiredToken']) || ($_SESSION['expiredToken'] == false))) {
    redirect_to("{$seperator}login.php");
} */

//  header 
 include_once("{$seperator}layout/dashboard-header.php");

?>



<div class="container">
      <div class="row m-heavy-top-breather">
            <div class="m-heavy-top-breather col-sm-6 col-sm-offset-3">
                  <h3 class="capitalize text-center m-mid-bottom-breather">verification email request</h3>
                  <?php echo inline_message(); ?>
                  <form action="<?php echo $seperator; ?>control/verification.php" method="post">

                        <div class="form-group">
                              <label for="email">Enter Your Email</label>
                              <input class="form-control" placeholder="Enter your registered email address" name="email" type="text" value="">
                        </div>

                        <input type="submit" name="submit" class="btn capitalize main-btn form-control" value="send verification email">
                  </form>
            </div>
      </div>
</div>

<!-- footer -->
<?php include_once("{$seperator}layout/footer.php"); ?>
<?php $thisPage = "password"; $seperator = "../";
require_once("{$seperator}includes/initialize.php");

// check if token has been confirmed
if(!isset($_SESSION['confirmedToken']) || ($_SESSION['confirmedToken'] == false)) {
    redirect_to("{$seperator}login.php");
}
 
if(isset($_SESSION['errors']) && ($_SESSION['errors'] != "")) {
    $errors = $_SESSION['errors']; 
} else { 
    $errors = "";
}

//  header 
 include_once("{$seperator}layout/header.php");
?>
<div class="inner-top password">
      <div class="sm-container margin-auto m-mid-breather p-heavy-breather p-heavy-side-breather">
            <form action="<?php echo $seperator; ?>control/password/reset.php" method="post" class=" p-heavy-side-breather m-mid-breather p-mid-breather white-bg">
                  <h2 class="text-center">Reset Your Password</h2>

                  <div class="sm-container m-mid-top-breather">
                  <?php echo inline_message(); ?>
                        <div class="form-group">
                              <label for="password">Password</label>
                              <input class="form-control" placeholder="Enter your new password" name="password" type="password" value="">
                        </div>

                        <div class="form-group">
                              <label for="password">Confirm Password</label>
                              <input class="form-control" placeholder="confirm your new password" name="confirm_password" type="password" value="">
                        </div>

                        <input type="submit" name="submit" class="btn capitalize main-btn form-control" value="send verification email">

                  </div>
            </form>
      </div>
</div>
</div>

<!-- footer -->
<?php include_once("{$seperator}layout/footer.php"); ?>
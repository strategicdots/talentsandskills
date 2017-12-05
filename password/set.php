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
<div class="container">
      <div class="row m-heavy-top-breather">
            <div class="m-heavy-top-breather col-sm-6 col-sm-offset-3">
                  <h3 class="capitalize">You can now change your password</h3>

                  <?php echo inline_message(); ?>
                  <form action="<?php echo $seperator; ?>control/password/reset.php" method="post">
                        <p class="m-light-bottom-breather">Enter and Confirm your new password</p>

                        <div class="form-group">
                              <label for="password">Password</label>
                              <input class="form-control" placeholder="Enter your new password" name="password" type="password" value="">
                        </div>

                        <div class="form-group">
                              <label for="password">Confirm Password</label>
                              <input class="form-control" placeholder="confirm your new password" name="confirm_password" type="password" value="">
                        </div>

                        <input type="submit" name="submit" class="btn capitalize main-btn form-control" value="send verification email">

                  </form>
            </div>
      </div>
</div>

<!-- footer -->
<?php include_once("{$seperator}layout/footer.php"); ?>
<?php $thisPage = "register"; $seperator="../"; 
include_once("{$seperator}includes/initialize.php");

// form action
$action = "../control/register.php";

// reassign post variables stored in session and unset
$_POST = $_SESSION['post'];
unset($_SESSION['post']);

// header 
include_once("{$seperator}layout/header.php");

/**
 * This part is to set the previously filled fields from
 * register/index.php to be echoed here where it's needed
 */
if(!empty($_SESSION['PART_REG'])) {
    $_POST = $_SESSION['PART_REG'];
    unset($_SESSION['PART_REG']);
}

?>

<div class="inner-top register">
    <div class="sm-container margin-auto m-mid-breather p-mid-breather p-heavy-side-breather">
        <form action="<?php echo $action; ?>" method="post" class="p-heavy-side-breather m-mid-breather p-mid-breather white-bg">

            <h2 class="text-center">I'm an Intern</h2>
            <p class="text-center">Get headhunted by leading employers</p>

            <div class="sm-container m-mid-top-breather">
                
                <?php echo inline_message(); ?>
                <?php echo inline_errors(); ?>

                <input type="hidden" name="account_type" value="intern">
                <div class="form-group">
                    <input type="text" name="firstname" placeholder="Enter your first Name" value="<?php if(!empty($_POST['firstname'])) {echo $_POST['firstname']; }?>"
                        class="form-control" required>
                </div>

                <div class="form-group">
                    <input type="text" name="lastname" placeholder="Enter your Last Name" value="<?php if(!empty($_POST['lastname'])) {echo $_POST['lastname']; }?>"
                        class="form-control" required>
                </div>

                <div class="form-group">
                    <input type="email" name="email" placeholder="Enter Your Email" value="<?php if(!empty($_POST['email'])) {echo $_POST['email']; }?>"
                        class="form-control" required>
                </div>

                <div class="form-group">
                    <input type="tel" name="phone" placeholder="Phone Number" value="<?php if(!empty($_POST['phone'])) {echo $_POST['phone']; }?>"
                        class="form-control" required>
                </div>

                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" value="<?php if(!empty($_POST['password'])) {echo $_POST['password']; }?>"
                        class="form-control" required>
                </div>

                <div class="form-group">
                    <input class="btn main-btn form-control" name="submit" type="submit" value="Register as a Intern">
                </div>
            </div>
        </form>

    </div>
</div>

<!-- footer -->
<?php include_once("{$seperator}layout/footer.php"); ?>
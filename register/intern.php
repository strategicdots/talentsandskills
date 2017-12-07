<?php $thisPage = "register"; $seperator="../"; 
include_once("{$seperator}includes/initialize.php");

// form action
$action = "../control/register.php";
// header 
include_once("{$seperator}layout/header.php"); 
?>

<div class="inner-top register">
    <div class="sm-container margin-auto m-mid-breather p-mid-breather p-heavy-side-breather">
        <?php if(!empty($_SESSION['type']) &&($_SESSION['type'] == "1")) { 
                    echo inline_errors(); 
                    unset($_SESSION['type']); 
                    unset($session->errors); 
                } 
                    ?>
        <form action="<?php echo $action; ?>" method="post" class="p-heavy-side-breather m-mid-breather p-mid-breather white-bg">
            
            <?php echo inline_message(); ?>

            <h2 class="text-center">I'm a Candidate</h2>
            <p class="text-center">Get headhunted by leading employers</p>
            
            <div class="sm-container m-mid-top-breather">
                <input type="hidden" name="type" value="1">
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
                    <input class="btn main-btn form-control" name="submit" type="submit" value="Register as a Candidate">
                </div>
            </div>
        </form>

    </div>
</div>

<!-- footer -->
<?php include_once("{$seperator}layout/footer.php"); ?>
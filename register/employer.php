<?php $thisPage = "register"; $seperator="../"; 
include_once("{$seperator}includes/initialize.php");

// form action
$action = "../control/register.php";
// header 
include_once("{$seperator}layout/header.php"); 
?>

<div class="inner-top register">
    <div class="sm-container margin-auto m-mid-breather p-mid-breather p-heavy-side-breather">
        <?php if(!empty($_SESSION['type']) &&($_SESSION['type'] == "2")) { 
                    echo inline_errors(); 
                    unset($_SESSION['type']); 
                    unset($session->errors); 
                } 
                    ?>
        <form action="<?php echo $action; ?>" method="post" class="p-heavy-side-breather m-mid-breather p-mid-breather white-bg">
            <?php echo inline_message(); ?>
            <h2 class="text-center">I'm an Employer</h2>
            <p class="text-center">Get instant access to great candidates</p>

            <div class="sm-container m-mid-top-breather">
                <input type="hidden" name="type" value="2">
                <div class="form-group">
                    <input type="email" name="email" value="<?php if(!empty($_POST['email'])) {echo $_POST['email']; }?>" placeholder="Company Email Address"
                        class="form-control" required>
                </div>

                <div class="form-group">
                    <input type="text" name="company_name" value="<?php if(!empty($_POST['company_name'])) {echo $_POST['company_name']; }?>"
                        placeholder="Company Name" class="form-control" required>
                </div>

                <div class="form-group">
                    <select class="form-control" name="job_field" required>
                        <option class="capitalize">Please select your field</option>

                        <?php foreach($jobFields as $field): ?>

                        <?php if(!empty($_POST['job_field']) && ($_POST['job_field'] == $field->name)): ?>

                        <option value="<?php echo $field->name; ?>" selected>
                            <?php echo ucwords($field->name); ?>
                        </option>

                        <?php else: ?>

                        <option value="<?php echo $field->name; ?>">
                            <?php echo ucwords($field->name); ?>
                        </option>

                        <?php endif; endforeach; ?>

                    </select>
                </div>

                <div class="form-group">
                    <input type="tel" name="phone" value="<?php if(!empty($_POST['phone'])) {echo $_POST['phone']; }?>" placeholder="Phone Number"
                        class="form-control" required>
                </div>

                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" value="" class="form-control" required>
                </div>

                <div class="form-group">
                    <input class="btn main-btn form-control" name="submit" type="submit" value="Register as an Employer">
                </div>
            </div>
        </form>

    </div>
</div>

<!-- footer -->
<?php include_once("{$seperator}layout/footer.php"); ?>
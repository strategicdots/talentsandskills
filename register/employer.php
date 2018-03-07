<?php $thisPage = "register"; $seperator="../"; 
include_once("{$seperator}includes/initialize.php");

// form action
$action = "../control/register.php";
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

            <h2 class="text-center">I'm an Employer</h2>
            <p class="text-center">Get instant access to great candidates</p>

            <div class="sm-container m-mid-top-breather">

                <?php echo inline_message(); ?>
                <?php echo inline_errors(); ?>

                <input type="hidden" name="account_type" value="employer">
                <div class="form-group">
                    <input type="email" name="email" value="<?php if(!empty($_POST['email'])) {echo $_POST['email']; }?>" placeholder="Company Email Address"
                        class="form-control" required>
                </div>

                <div class="form-group">
                    <input type="text" name="company_name" value="<?php if(!empty($_POST['company_name'])) {echo $_POST['company_name']; }?>"
                        placeholder="Company Name" class="form-control" required>
                </div>

                <div class="form-group">
                    <select class="form-control" name="job_field" id="jobField" required>
                        <option class="capitalize">Please select your industry</option>

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

                <!-- if user selects "Others: Please Specify", this input pops up -->
                <div class="form-group hide-el" id="hiddenJobField">
                    <input type="text" name="job_field_hidden" value="" placeholder="Please, enter your Industry here" class="form-control" required>
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
<script>
    const jobField = document.getElementById('jobField');
    const hiddenJobField = document.getElementById('hiddenJobField');


    function selectChangeHandler(e) {
        if (e.target.value == "Others : Please specify") {
            hiddenJobField.classList.remove('hide-el');
        } else {
            hiddenJobField.classList.add('hide-el');
        }
    }

    jobField.onchange = selectChangeHandler;
</script>
<!-- footer -->
<?php include_once("{$seperator}layout/footer.php"); ?>
<?php $thisPage = "register"; $seperator="../"; 
include_once("{$seperator}includes/initialize.php");

if($_POST['submit']) {
    $errors = [];

    if($_POST['type'] == "c") { 
        $type = "candidate";
        //  CANDIDATE SECTION

        $raw_fields        = [
            'phone'         => $_POST['phone'], 
            'email'         => $_POST['email'], 
            'firstname'     => $_POST['firstname'], 
            'lastname'      => $_POST['lastname'], 
            'password'      => $_POST['password']
        ];

        // check for presence
        foreach($raw_fields as $field => $value){
            if(!$validation->hasPresence($value)) {
                $errors[$field] = ucwords(str_replace("_", " ", $field)) . " can't be blank";
            }
        }

        // check for email format
        if(!isset($errors['email'])) {

            // check email
            if(!$validation->rightEmailSyntax(trim($_POST['email']))) {
                $errors['email'] = "Email not in the right format";
            }

            // check phone number
            if(!$validation->isDigits(trim($_POST['phone']))) {
                $errors['phone'] = "Phone number not in digits";
            }
        }

        // if errors are present
        if(!empty($errors)) {
            $session->errors($errors);

        } else { 
            // else continue
            $user = new User();

            $user->phone         = trim($_POST['phone']); 
            $user->email         = trim($_POST['email']); 
            $user->firstname     = trim($_POST['firstname']); 
            $user->lastname      = trim($_POST['lastname']); 
            $user->password      = trim($_POST['password']); 
            $user->candidate     = "1"; 
            
            if($user->testCreate()) {
                // account created successfully, redirect to dashboard
                $session->message("account created successfully");
                $_SESSION['candidateID'] = $user->id;
                redirect_to("{$seperator}candidate/dashboard.php");

            }

        }

    }

}

// header 
include_once("{$seperator}layout/header.php"); 
?>

<div class="container inner-top p-heavy-top-breather">
    <div class="row">
        <!-- candidate form -->
        <div class="col-sm-6">
            <div class="heavy-container">
                <h2 class="text-center">I'm a Candidate</h2>
                <p class="text-center">Get headhunted by leading employers</p>
                <?php if($type="candidate"){ echo inline_errors(); } unset($type); ?>
                <form action="#" method="post">
                    <input type="hidden" name="type" value="c">
                    <div class="form-group">
                        <input type="text" name="firstname" placeholder="Enter your first Name" value="" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <input type="text" name="lastname" placeholder="Enter your Last Name" value="" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <input type="email" name="email" placeholder="Enter Your Email" value="" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <input type="tel" name="phone" placeholder="Phone Number" value="" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <input type="password" name="password" placeholder="Password" value="" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <input class="btn main-btn form-control" name="submit" type="submit" value="Register as a Candidate">
                    </div>
                </form>

            </div>
        </div>

        <!-- employer form -->
        <div class="col-sm-6">
            <div class="heavy-container">
                <h2 class="text-center">I'm an Employer</h2>
                <p class="text-center">Get instant access to great candidates</p>
                <?php if($type="employer"){ echo inline_errors(); } unset($type); ?>
                <?php echo inline_errors(); ?>
                <form action="#" method="post">
                    <input type="hidden" name="type" value="em">
                    <div class="form-group">
                        <input type="email" name="email" value="" placeholder="Company Email Address" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <input type="text" name="company_name" value="" placeholder="Company Name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <select class="form-control" name="job_field" required>
                            <option class="capitalize">Please select your field</option>
                            <?php foreach($jobFields as $field): ?>
                            <option value="<?php echo $field->name; ?>">
                                <?php echo ucwords($field->name); ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="tel" name="phone" value="" placeholder="Phone Number" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <input type="password" name="password" placeholder="Password" value="" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <input class="btn sec-btn form-control" name="submit" type="submit" value="Register as an Employer">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- footer -->
<?php include_once("{$seperator}layout/footer.php"); ?>
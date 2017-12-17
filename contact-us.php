<?php $thisPage = "contactUs";
$seperator = "";
include_once("includes/initialize.php");

// form submission
if (isset($_POST['submit'])) {
      $errors = [];

      $name       = trim(strip_tags(htmlspecialchars($_POST['name'])));
      $email      = trim(strip_tags(htmlspecialchars($_POST['email'])));
      $phone      = trim(strip_tags(htmlspecialchars($_POST['phone'])));
      $message    = trim(strip_tags(htmlspecialchars($_POST['messsage'])));

      $raw_fields = [
            'first_name' => $name,
            'email'     => $email,
            'phone'     => $phone,
            'message'   => $message
      ];

      foreach ($raw_fields as $field => $value) {
            if (!$validation->hasPresence($value)) {
                  $errors[$field] = ucwords(str_replace("_", " ", $field)) . " can't be blank";
            }
      }

      if (empty($errors)) {
            
            // check if email is in right syntax
            if($validation->rightEmailSyntax($email)) {
            
                  // validations passed
                  // Create the email and send the message
                  $to = 'admin@talentsandskills.net'; // message will be sent here
                  $subject = "Website Contact Form:  $name";
                  $body = "You have received a new message from your website contact form.\n\n" . "Here are the details:\n\nName: $name\n\nEmail: $email\n\nPhone: $phone\n\nMessage:\n$message";
                  $headers  = "From: admin@talentsandskills.net\n"; // The generated message will be from here
                  $headers .= "Reply-To: $email";
                  mail($to, $subject, $body, $headers);
                  


            } else {

                  $session->message("Please, check your email, it's not in the right format");
            }

      } else {
            $session->message("Please, fill all fields");
      }

} else {
      echo "";
}


// header
include_once("layout/header.php"); ?> // .top
<div class="inner-top other-pages abt">
      <div class="sm-container text-center">
            <h1 class="sectxt-color uppercase">contact us
            </h1>
      </div>
</div>

<!-- content starts -->
<div>
      <!-- Contact -->
      <section id="contact">
            <div class="container m-mid-top-breather">
                  <div class="row">
                        <div class="col-lg-12 text-center">
                              <h3 class="section-subheading text-muted">Please fill the form below and we'll get back to you shortly</h3>
                              <?php echo inline_message(); ?>
                        </div>
                  </div>
                  <div class="row">
                        <div class="col-lg-12">
                              <form id="contactForm" name="" action="#" method="post">
                                    <div class="row">
                                          <div class="col-md-6">
                                                <div class="form-group">
                                                      <input class="form-control" name="name" type="text" placeholder="Your Name *" required data-validation-required-message="Please enter your name.">
                                                      <p class="help-block text-danger"></p>
                                                </div>
                                                <div class="form-group">
                                                      <input class="form-control" type="email" name="email" placeholder="Your Email *" required data-validation-required-message="Please enter your email address.">
                                                      <p class="help-block text-danger"></p>
                                                </div>
                                                <div class="form-group">
                                                      <input class="form-control" type="tel" name="phone" placeholder="Your Phone *" required data-validation-required-message="Please enter your phone number.">
                                                      <p class="help-block text-danger"></p>
                                                </div>
                                          </div>
                                          <div class="col-md-6">
                                                <div class="form-group">
                                                      <textarea class="form-control" rows="10" name="message" placeholder="Your Message *" required data-validation-required-message="Please enter a message."></textarea>
                                                      <p class="help-block text-danger"></p>
                                                </div>
                                          </div>
                                          <div class="clearfix"></div>
                                          <div class="sm-container text-center">
                                                <div class="sm-container">
                                                      <input type="submit" name="submit" class="btn capitalize sec-btn form-control" value="Send Message">
                                                </div>
                                          </div>
                                    </div>
                              </form>
                        </div>
                  </div>
            </div>
      </section>

</div>
<!-- end contents -->


<!-- footer -->
<?php include_once("layout/footer.php"); ?>
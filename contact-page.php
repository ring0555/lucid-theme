<?php
/*
Template Name: Contact Page
*/
?>

<?php
if (isset($_POST['submit'])) {

  $contactname = trim($_POST['contactName']);
  $emailaddress = trim($_POST['emailAddress']);
  $phonenumber = trim($_POST['phoneNumber']);
  $companyname = trim($_POST['companyName']);
  $visitormessage = trim($_POST['visitorMessage']);

  if ($contactname == '') {
    $formerror = 'Please Enter Name';
  } else if ($emailaddress == '') {
    $formerror = 'Please Enter Email';
  } else if ($visitormessage == '') {
    $formerror = 'Please Enter Message';
  } else {
    if (empty($_POST)) {
      $formerror = 'Error Submiting Form';
    } else {
      $to = get_option('admin_email');
      $subject = 'Lucid Studios Visitor Message';
      $headers = 'From: '.$emailaddress;
      $body = 'Name: '.$contactname."\r\n";
      $body .= 'Phone: '.$phonenumber."\r\n";
      $body .= 'Company: '.$companyname."\r\n";
      $body .= "\r\n";
      $body .= $visitormessage;

      $sent = wp_mail($to, $subject, $body, $headers);

      if ($sent) {
        $success = 'Your Message Has Been Sent! We Will Contact You Shortly';
      } else {
        $formerror = 'An Error Has Occured. Please Try Again.';
      }
    }
  }
}
?>

<?php get_header(); ?>

<div class="container">
  <div class="contact">
    <h1 class="text-center">Let's Work Together</h1>

    <?php if (isset($formerror)) { ?>
      <div class="alert alert-danger"><?php echo $formerror; ?></div>
    <?php } else if ($success != '') { ?>
      <div class="alert alert-success"><?php echo $success; ?></div>
    <?php } ?>

    <div class="row">
      <div class="col-lg-8 col-lg-offset-2">
        <form class="contact-form" role="form" action="<?php the_permalink(); ?>" method="post">
          <div class="form-group">
            <label for="contactName">Name*:</label>
            <input type="text" class="form-control" id="contactName" name="contactName"
              value="<?php echo $contactname; ?>">
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="emailAddress">Email Address*:</label>
                <input type="email" class="form-control" id="emailAddress" name="emailAddress"
                  value="<?php echo $emailaddress; ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="phoneNumber">Phone Number:</label>
                <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber"
                  value="<?php echo $phonenumber; ?>">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="companyName">Company:</label>
            <input type="text" class="form-control" id="companyName" name="companyName"
              value="<?php echo $companyname; ?>">
          </div>
          <div class="form-group">
            <label for="visitorMessage">Message*:</label>
            <textarea id="visitorMessage" name="visitorMessage" class="form-control" rows="3"><?php echo $visitormessage; ?></textarea>
          </div>
          <button class="btn btn-default btn-lg" name="submit" type="submit">Send Message</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>

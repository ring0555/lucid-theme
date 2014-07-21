<?php
/*
Template Name: Contact Page
*/
?>

<?php
if (isset($_POST['submit'])) {

  $contactname = trim($_POST['contactName']);
  $emailaddress = trim($_POST['emailAddress']);
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

  <div class="page-heading">
    <h1>Contact Us</h1>
    <h4>We'd love to work with you.</h4>
  </div>

  <div id="contact">

    <?php if (isset($formerror)) { ?>
      <div class="alert alert-error"><?php echo $formerror; ?></div>
    <?php } else if ($success != '') { ?>
      <div class="alert alert-success"><?php echo $success; ?></div>
    <?php } ?>

    <form class="contact-form" role="form" action="<?php the_permalink(); ?>" method="post">
      <input type="text" class="sm" id="contactName" name="contactName"
        placeholder="Name" value="<?php echo $contactname; ?>">
      <input type="email" class="sm last" id="emailAddress" name="emailAddress"
        placeholder="Email Address" value="<?php echo $emailaddress; ?>">
      <input type="text" class="form-control" id="companyName" name="companyName"
        placeholder="Company Name" value="<?php echo $companyname; ?>">
      <textarea id="visitorMessage" name="visitorMessage" class="form-control"
        rows="3" placeholder="Message"><?php echo $visitormessage; ?></textarea>
      <button name="submit" type="submit">Send Message</button>
    </form>

  </div>

<?php get_footer(); ?>

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
      $body = 'Name: '.$contactname.'\n';
      $body .= 'Phone: '.$phonenumber.'\n';
      $body .= 'Company: '.$companyname.'\n';
      $body .= 'Type: '.$_POST['projectType'].'\n';
      $body .= 'Budget: '.$_POST['budget'].'\n';
      $body .= 'Timeline: '.$_POST['timeline'].'\n';
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

  <h1 class="heading text-center">Let's Work Together</h1>

  <?php if (isset($formerror)) { ?>
    <div class="alert alert-danger"><?php echo $formerror; ?></div>
  <?php } else if ($success != '') { ?>
    <div class="alert alert-success"><?php echo $success; ?></div>
  <?php } ?>

  <form class="contact-form" role="form" action="<?php the_permalink(); ?>" method="post">
    <div class="form-group">
      <label for="contactName">Name*:</label>
      <input type="text" class="form-control" id="contactName" name="contactName"
        value="<?php echo $contactname; ?>">
    </div>
    <div class="form-group">
      <label for="emailAddress">Email Address*:</label>
      <input type="email" class="form-control" id="emailAddress" name="emailAddress"
        value="<?php echo $emailaddress; ?>">
    </div>
    <div class="form-group">
      <label for="phoneNumber">Phone Number:</label>
      <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber"
        value="<?php echo $phonenumber; ?>">
    </div>
    <div class="form-group">
      <label for="companyName">Company:</label>
      <input type="text" class="form-control" id="companyName" name="companyName"
        value="<?php echo $companyname; ?>">
    </div>
    <div class="form-group">
      <label for="projectType">Project Type*:</label>
      <select id="projectType" name="projectType" class="form-control">
        <option>Web Design</option>
        <option>Web Development</option>
        <option>Android Development</option>
        <option>Scalability and Performance</option>
        <option>Code Review</option>
        <option>Software Package</option>
      </select>
    </div>
    <div class="form-group">
      <label for="budget">Budget*:</label>
      <select id="budget" name="budget" class="form-control">
        <option>$5,000 - $15,000</option>
        <option>$15,000 - $25,000</option>
        <option>$25,000 - $50,000</option>
        <option>$50,000+</option>
      </select>
    </div>
    <div class="form-group">
      <label for="timeline">Timeline*:</label>
      <select id="timeline" name="timeline" class="form-control">
        <option>2-4 Months</option>
        <option>4-6 Months</option>
        <option>None</option>
        <option>Anytime</option>
      </select>
    </div>
    <div class="form-group">
      <label for="visitorMessage">Message*:</label>
      <textarea id="visitorMessage" name="visitorMessage" class="form-control" rows="3"><?php echo $visitormessage; ?></textarea>
    </div>
    <button class="btn btn-default btn-lg" name="submit" type="submit">Send Message</button>
</div>

<?php get_footer(); ?>

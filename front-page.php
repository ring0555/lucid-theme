<?php get_header(); ?>

<section class="section section__home">
  <div class="overlay"></div>
  <div class="section__inner">
    <h1>Digital Design and Development</h1>
    <p>We Craft Digital Experiences For The Web and Mobile.</p>
  </div>
  <a href="#about"><i class="icon ion-chevron-down"></i></a>
</section>

<section id="about" class="section section__about">
  <h1>Welcome to Lucid Studios</h1>
  <p>At Lucid Studios, we work with a wide variety of clientelle including non-profits,
    enterprises, and start-ups to develop digital products to improve their business. We focus
    on creating simple, clear, and intuitive interfaces and fast, scalable, and reliable backend
    applications. We walk you through every step of the development process, from idea stage to
    deployment and maintenance, meticulously tailoring every detail of the project to your
    individual needs.</p>
</section>

<section id="services" class="section section__services">
  <h1>Our Services</h1>
  <figure class="service">
    <i class="icon ion-monitor"></i>
    <figcaption>
      <h3>Web Design</h3>
    </figcaption>
  </figure>
  <figure class="service">
    <i class="icon ion-code"></i>
    <figcaption>
      <h3>Web Applications</h3>
    </figcaption>
  </figure>
  <figure class="service">
    <i class="icon ion-ipad"></i>
    <figcaption>
      <h3>Mobile Applications</h3>
    </figcaption>
  </figure>
  <figure class="service">
    <i class="icon ion-bag"></i>
    <figcaption>
      <h3>E-Commerce</h3>
    </figcaption>
  </figure>
  <figure class="service">
    <i class="icon ion-clipboard"></i>
    <figcaption>
      <h3>Digital Strategy</h3>
    </figcaption>
  </figure>
  <figure class="service">
    <i class="icon ion-connection-bars"></i>
    <figcaption>
      <h3>Analytics</h3>
    </figcaption>
  </figure>
</section>

<section class="section section__work">
  <h1>Recent Work</h1>
  <?php
    if (have_posts()) :
      query_posts('post_type=work');
      while ( have_posts() ) : the_post();
  ?>
  <figure class="figure figure__work">
    <?php $image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID, 'thumbnail' ) ); ?>
    <img src="<?php echo $image; ?>">
    <figcaption>
      <h2><?php the_title(); ?></h2>
      <!--<a href="<?php the_permalink(); ?>"></a>-->
      <a href="<?php echo get_post_meta( $post->ID, "work_url", true ); ?>" target="_blank"></a>
    </figcaption>
  </figure>
  <?php
    endwhile;
    endif;
    wp_reset_query();
  ?>
</section>

<?php
  if (isset($_POST['submit'])) {

    $contactname = trim($_POST['full_name']);
    $emailaddress = trim($_POST['email_address']);
    $companyname = trim($_POST['company_name']);
    $service = trim($_POST['service']);
    $budget = trim($_POST['budget']);
    $description = trim($_POST['description']);

    if ($contactname == '') {
      $formerror = 'Please Enter Name';
    } else if ($emailaddress == '') {
      $formerror = 'Please Enter Email';
    } else if ($description == '') {
      $formerror = 'Please Enter Project Description';
    } else {
      if (empty($_POST)) {
        $formerror = 'Error Submiting Form';
      } else {
        $to = "nathan@lucidstudios.co";
        $subject = 'Lucid Studios Visitor Message';
        $body = 'Name: '.$contactname."\r\n";
        $body .= 'Email: '.$emailaddress."\r\n";
        $body .= 'Company: '.$companyname."\r\n";
        $body .= 'Service: '.$service."\r\n";
        $body .= 'Budget: '.$budget."\r\n";
        $body .= "\r\n";
        $body .= $description;

        $sent = wp_mail($to, $subject, $body, $headers);

        if ($sent) {
          $success = 'Your Message Has Been Sent! We Will Contact You Shortly';
        } else {
          $formerror = 'An Error Has Occured. Please Try Again.';
        }
      }
    }
  } else {
    $contactname = '';
    $emailaddress = '';
    $companyname = '';
    $service = '';
    $budget = '';
    $description = '';
  }
?>

<section id="contact" class="section section__contact">
  <h1>Contact Us</h1>
  <p>Please Fill Out The Form Below and We Will Get Back To You Within 48 Hours!</p>
  <?php if (isset($formerror)) { ?>
    <div class="alert alert__error"><?php echo $formerror; ?></div>
  <?php } else if (isset($success)) { ?>
    <div class="alert alert__success"><?php echo $success; ?></div>
  <?php } ?>
  <form class="form" method="post" action="#contact">
    <div class="input-group">
      <label>Full Name:</label>
      <input type="text" name="full_name" placeholder="Richard Hendriks">
    </div>
    <div class="input-group">
      <label>Email Address:</label>
      <input type="text" name="email_address" placeholder="richard@piedpiper.com">
    </div>
    <div class="input-group">
      <label>Company Name:</label>
      <input type="text" name="company_name" placeholder="Pied Piper, Inc.">
    </div>
    <div class="input-group">
      <label>Services Required:</label>
      <select name="service">
        <option value="Web Design">Web Design</option>
        <option value="Web Application">Web Application</option>
        <option value="Mobile Application">Mobile Application</option>
        <option value="E-Commerce">E-Commerce</option>
        <option value="Digital Strategy">Digital Strategy</option>
        <option value="Analytics">Analytics</option>
      </select>
    </div>
    <div class="input-group">
      <label>Budget:</label>
      <select name="budget">
        <option value="$3,000-$5,000">$3,000 - $5,000</option>
        <option value="$5,000-$7,500">$5,000 - $7,500</option>
        <option value="$7,500-$10,000" selected>$7,500 - $10,000</option>
        <option value="$10,000-$15,000">$10,000 - $15,000</option>
        <option value="$15,000-$30,000">$15,000 - $30,000</option>
        <option value="$30,000+">$30,000+</option>
      </select>
    </div>
    <div class="input-group">
      <label>Project Description:</label>
      <textarea name="description" rows="5" placeholder="Pied Piper is a multi-platform technology based on a proprietary universal compression algorithm that has consistently fielded high Weisman Scores."></textarea>
    </div>
    <button type="submit" name="submit">Send Message</button>
  </form>
</section>

<?php get_footer(); ?>

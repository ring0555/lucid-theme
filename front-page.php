<?php get_header(); ?>

<section class="section section__home">
  <div class="overlay"></div>
  <div class="section__inner">
    <h1>Digital Design and Development</h1>
    <p>We Craft Amazing Digital Experiences For The Web and Mobile.</p>
  </div>
  <a href="#about"><i class="icon ion-chevron-down"></i></a>
</section>

<section id="about" class="section section__about">
  <h1>Welcome to Lucid Studios</h1>
  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam maximus sapien
  eu mattis viverra. Aenean at ultrices nibh, id elementum ipsum. Morbi tristique
  elit tortor, sed venenatis nisi pretium ac. Nulla et nisi dictum, vulputate justo
  sed, feugiat diam. Donec et consectetur tellus, quis iaculis libero. Cras orci mi,
  cursus ac odio pharetra, tristique tincidunt mauris. Ut elit ligula, ullamcorper
  a malesuada non, venenatis luctus ante. Quisque suscipit leo vitae aliquam consequat.</p>

  <p>Nam varius ipsum eu urna pharetra, eu interdum sapien lobortis. Duis ac sagittis libero.
  Cras imperdiet, nisl placerat sodales facilisis, arcu libero feugiat ipsum, at viverra
  velit nibh sit amet neque. Morbi vestibulum, turpis vitae mollis interdum, libero dolor
  pulvinar dui, vitae elementum dolor nibh at sapien. Cras vel eros id quam blandit
  fermentum. Donec cursus justo sit amet lacus finibus ullamcorper.</p>
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
      <?php the_excerpt(); ?>
      <a href="<?php the_permalink(); ?>"></a>
    </figcaption>
  </figure>
  <?php
    endwhile;
    endif;
    wp_reset_query();
  ?>
</section>

<section class="section section__journal">
  <h1>The Journal</h1>
  <?php
    $args = array(
      'numberposts' => 3
    );
    $recent_posts = get_posts($args);
  ?>
  <?php foreach( $recent_posts as $recent ) { ?>
  <div class="post">
    <h2 class="title"><a href="<?php echo get_permalink($recent->ID); ?>"><?php echo $recent->post_title; ?></a></h2>
    <h5 class="date"><?php echo get_post_time('F jS, Y', $recent->ID); ?></h5>
    <p class="summary"><?php echo $recent->post_excerpt; ?></p>
  </div>
  <?php } ?>
  <a class="view-more" href="<?php echo bloginfo( 'url' ); ?>/journal/">View More Posts</a>
</section>

<section id="contact" class="section section__contact">
  <h1>Contact Us</h1>
  <p>Please Fill Out The Form Below and We Will Get Back To You Within 48 Hours!</p>
  <form class="form" method="post" action="">
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
        <option value="$7,500-$10,000">$7,500 - $10,000</option>
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

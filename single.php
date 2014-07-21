<?php get_header(); ?>
  <div id="single-post">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <div class="page-heading">
      <h1><?php the_title(); ?></h1>
      <h4>By: <?php the_author(); ?></h4>
      <h4><?php the_time('F jS, Y'); ?></h4>
    </div>
    <div class="post">
      <div class="post-content"><?php the_content(); ?></div>
    <?php endwhile; else: ?>
      <?php _e('Sorry, this page does not exist'); ?>
    <?php endif; ?>
  </div>
<?php get_footer(); ?>

<?php get_header(); ?>

  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

  <section class="page__heading">
    <h1><?php the_title(); ?></h1>
    <h4>By: <?php the_author(); ?></h4>
    <h4><?php the_time('F jS, Y'); ?></h4>
  </section>

  <section class="single-post">
    <div class="post">
      <div class="post-content">
        <?php the_content(); ?>
      </div>
    </div>
  </section>

  <?php endwhile; else: ?>

  <section class="single-post">
    <?php _e('Sorry, this page does not exist'); ?>
  </section>

  <?php endif; ?>

<?php get_footer(); ?>

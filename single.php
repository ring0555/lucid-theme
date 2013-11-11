<?php get_header(); ?>

<div class="container">

  <div class="single-post post">

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

      <h1 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

      <h5 class="date"><?php the_time('l, F jS, Y'); ?></h5>

      <div class="post-content"><?php the_content(); ?></div>

    <?php endwhile; else: ?>

      <?php _e('Sorry, this page does not exist'); ?>

    <?php endif; ?>

  </div>

</div>

<?php get_footer(); ?>

<?php get_header(); ?>

<div class="container">

  <div class="row">

    <div class="col-lg-9">

      <div class="single-post">

      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <h1 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

        <h5 class="date text-muted"><?php the_time('l, F jS, Y'); ?></h5>

        <?php the_content(); ?>

      <?php endwhile; else: ?>

        <?php _e('Sorry, this page does not exist'); ?>

      <?php endif; ?>

      </div>

    </div>

    <div class="col-lg-3">

      <?php get_sidebar(); ?>

    </div>

  </div>

</div>

<?php get_footer(); ?>

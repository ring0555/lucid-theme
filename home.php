<?php get_header(); ?>

<div class="container">

  <div class="posts">

  <?php if (have_posts()) : ?>
  <?php query_posts('category_name=Journal'); ?>
  <?php while ( have_posts() ) : the_post(); ?>

    <div class="post">

      <h1 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

      <h5><span class="date"><?php the_time('l, F jS, Y'); ?></span>&loz;<span class="author">
        By: <?php the_author(); ?></h5>

      <div class="summary"><?php the_content('Read More'); ?></div>

    </div>

  <?php endwhile; ?>
  <?php endif; ?>

  </div>

</div>

<?php get_footer(); ?>

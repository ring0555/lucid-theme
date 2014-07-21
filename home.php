<?php get_header(); ?>

<div class="page-heading">
  <h1>Journal</h1>
  <h4>Read what we're writing about.</h4>
</div>

<div id="journal">

  <div class="posts">

  <?php if (have_posts()) : ?>
    <?php while ( have_posts() ) : the_post(); ?>

    <div class="post">
      <div class="image">
        <?php if ( has_post_thumbnail() ) { ?>
        <a href="<?php the_permalink(); ?>">
        <?php the_post_thumbnail( array('200','200') ); } ?>
        </a>
      </div>
      <div class="description">
        <div class="top">
          <h1 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
          <h5 class="date"><?php the_time('F jS, Y'); ?></h5>
        </div>
        <div class="summary"><?php the_content(''); ?></div>
      </div>
    </div>

    <?php endwhile; ?>
  <?php endif; ?>

  </div>

</div>

<?php get_footer(); ?>

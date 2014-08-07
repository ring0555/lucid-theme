<?php get_header(); ?>
<div id="single-work">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <?php
    $url = get_post_meta( $post->ID, "project_url", true );
  ?>
  <div class="page-heading">
    <h1><?php the_title(); ?></h1>
    <h4><a href="http://<?php echo $url; ?>" target="_blank"><?php echo $url; ?></a></h4>
  </div>
  <div class="post">
    <div class="post-content"><?php the_content(); ?></div>
  </div>
<?php endwhile; endif; ?>
</div>
<?php get_footer(); ?>

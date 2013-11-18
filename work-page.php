<?php
/*
* Template Name: Work Page
 */
?>

<?php get_header(); ?>

<div class="container">

  <div class="row">

    <div class="col-lg-10 col-lg-offset-1">

      <?php if (have_posts()) : ?>
        <?php query_posts('category_name=Work'); ?>
        <?php while ( have_posts() ) : the_post(); ?>

        <?php $url = get_post_meta($post->ID, "work_url", true); ?>

        <div class="row work">

          <div class="col-sm-6">

            <?php $image = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'thumbnail') ); ?>
            <img src="<?php echo $image; ?>">

          </div>

          <div class="col-sm-6">

            <h1 class="title"><a href="http://<?php echo $url; ?>"><?php the_title(); ?></a></h1>

            <div class="summary"><?php the_content(); ?></div>

            <a class="btn btn-default btn-sm url" href="http://<?php echo $url; ?>" target="_blank">
              View Project</a>

          </div>

        </div>

        <?php endwhile; ?>
      <?php endif; ?>

    </div>

  </div>

</div>

<?php get_footer(); ?>

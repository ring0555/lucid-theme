<?php
/*
* Template Name: Projects Page
 */
?>

<?php get_header(); ?>

<div class="container">
  <div class="row">
    <div class="col-lg-10 col-lg-offset-1">

      <?php if (have_posts()) : ?>
        <?php query_posts('post_type=project'); ?>
        <?php while ( have_posts() ) : the_post(); ?>

        <?php
          $url = get_post_meta($post->ID, "project_url", true);
          $type = get_post_meta($post->ID, "project_type", true);
          $categories = get_categories(array('taxonomy' => 'project_category'));
          $categories_len = count($categories);
        ?>

        <div class="row project">
          <div class="col-md-6">
            <?php $image = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'thumbnail') ); ?>
            <img src="<?php echo $image; ?>">
          </div>
          <div class="col-md-6">
            <div class="top">
              <h1 class="title"><?php the_title(); ?></h1>
              <div class="categories">
                <?php foreach ($categories as $key=>$category) {
                  if ($key == $categories_len - 1) {
                    echo $category->name;
                  } else {
                    echo $category->name.', ';
                  }
                } ?>
              </div>
            </div>
            <h4 class="type"><?php echo ucfirst($type); ?> Project</h4>
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

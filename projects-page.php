<?php
/* Template Name: Projects Page */
?>

<?php get_header(); ?>

  <div class="page-heading">
    <h1>Our Projects</h1>
    <h4>View some of our recent works.</h4>
  </div>

  <div id="projects">

    <ul class="sort">
      <li>Web Design</li>
      <li>Web Dev</li>
      <li>Mobile Dev</li>
      <li>Software Dev</li>
    </ul>

    <?php if (have_posts()) : ?>
      <?php query_posts('post_type=project'); ?>
      <?php while ( have_posts() ) : the_post(); ?>

      <?php
        $url = get_post_meta($post->ID, "project_url", true);
        $type = get_post_meta($post->ID, "project_type", true);
        $categories = get_categories(array('taxonomy' => 'project_category'));
        $categories_len = count($categories);
        $categories_str = "";
        foreach ($categories as $key=>$category) {
          $category_comma = $category->$name.',';
          $categories_str .= $category_comma;
        }
      ?>

      <div class="project" data-categories="<?php echo $categories_str; ?>">
        <div class="image">
          <?php $image = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'thumbnail') ); ?>
          <img src="<?php echo $image; ?>">
        </div>
        <div class="details">
          <div class="top">
            <h1 class="title"><?php the_title(); ?></h1>
            <div class="categories">
              <?php $index = 0; ?>
              <?php foreach ($categories as $key=>$category) {
                if ($index == $categories_len - 1) {
                  echo $category->name;
                } else {
                  echo $category->name.', ';
                }
                $index++;
              } ?>
            </div>
          </div>
          <h4 class="type"><?php echo ucfirst($type); ?> Project</h4>
          <div class="summary"><?php the_content(); ?></div>
          <?php if (empty($url)) { ?>
            <a class="btn btn-default btn-sm url disabled" href="#" target="_blank">
              Coming Soon</a>
          <?php } else { ?>
            <a class="" href="http://<?php echo $url; ?>" target="_blank">
              View Project</a>
          <?php } ?>
        </div>
      </div>

      <?php endwhile; ?>
    <?php endif; ?>

  </div>

<?php get_footer(); ?>

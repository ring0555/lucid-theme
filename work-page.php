<?php
/* Template Name: Work Page */
?>

<?php get_header(); ?>

  <div class="page-heading">
    <h1>Our Work</h1>
    <ul class="sort">
      <li data-sort='all'>All</li>
      <?php
        $project_post_categories = get_categories( array( 'taxonomy' => 'project_category',
                                                          'hide_empty' => '0' ) );
        foreach ( $project_post_categories as $project_category ) {
          echo '<li data-sort="'.$project_category->slug.'">'.$project_category->name.'</li>';
        }
      ?>
    </ul>
  </div>

  <div id="projects">

    <?php if (have_posts()) : ?>
      <?php query_posts('post_type=project'); ?>
      <?php while ( have_posts() ) : the_post(); ?>

      <?php
        $url = get_post_meta( $post->ID, "project_url", true );
        $type = get_post_meta( $post->ID, "project_type", true );
        $categories = wp_get_post_terms( $post->ID, 'project_category', array( "fields" => "all" ) );
        $categories_len = count( $categories );
        $categories_str = "[";
        $index = 0;
        foreach ( $categories as $key=>$category ) {
          if ( $index == $categories_len - 1 ) {
            $category_comma = '"'.$category->slug.'"]';
          } else {
            $category_comma = '"'.$category->slug.'", ';
          }
          $categories_str .= $category_comma;
          $index++;
        }
      ?>

      <div class="project" data-categories='<?php echo $categories_str; ?>'>
        <div class="image">
          <?php $image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID, 'thumbnail' ) ); ?>
          <img src="<?php echo $image; ?>">
        </div>
        <div class="details">
          <div class="top">
            <h1 class="title"><?php the_title(); ?></h1>
            <div class="categories">
              <?php $index = 0; ?>
              <?php foreach ( $categories as $key=>$category ) {
                if ( $index == $categories_len - 1 ) {
                  echo $category->name;
                } else {
                  echo $category->name.', ';
                }
                $index++;
              } ?>
            </div>
          </div>
          <h4 class="type"><?php echo ucfirst( $type ); ?> Project</h4>
          <div class="summary"><?php the_content(); ?></div>
          <?php if ( empty( $url ) ) { ?>
            <a class="link disabled project-url" href="#" target="_blank">
              Coming Soon</a>
          <?php } else { ?>
            <a class="link project-url" href="http://<?php echo $url; ?>" target="_blank">
              View Project</a>
          <?php } ?>
          <a href="<?php the_permalink(); ?>" class="link case-study">Case Study</a>
        </div>
      </div>

      <?php endwhile; ?>
    <?php endif; ?>

  </div>

  <script>
  jQuery(document).ready(function($) {
    $('ul.sort li').click(function() {
      var sort = $(this).data('sort');
      $('.project').each(function() {
        var categories = $(this).data('categories');
        if ( $.inArray(sort, categories) === -1 ) {
          $(this).hide('slow');
        } else {
          $(this).show('slow');
        }
      });
    });
  });
  </script>

<?php get_footer(); ?>

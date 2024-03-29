<?php
/* Template Name: Work Page */
?>

<?php get_header(); ?>

  <div class="page-heading">
    <h1>Our Work</h1>
    <ul class="sort">
      <li data-sort='all'>All</li>
      <?php
        $work_post_categories = get_categories( array( 'taxonomy' => 'work_category',
                                                          'hide_empty' => '0' ) );
        foreach ( $work_post_categories as $work_category ) {
          echo '<li data-sort="'.$work_category->slug.'">'.$work_category->name.'</li>';
        }
      ?>
    </ul>
  </div>

  <div id="projects">

    <?php if (have_posts()) : ?>
      <?php query_posts('post_type=work'); ?>
      <?php while ( have_posts() ) : the_post(); ?>

      <?php
        $url = get_post_meta( $post->ID, "work_url", true );
        $categories = wp_get_post_terms( $post->ID, 'work_category', array( "fields" => "all" ) );
        $categories_len = count( $categories );
        $categories_str = "[";
        $index = 0;
        foreach ( $categories as $key=>$category ) {
          if ( $index == $categories_len - 1 ) {
            $category_comma = '"'.$category->slug.'", "all"]';
          } else {
            $category_comma = '"'.$category->slug.'", ';
          }
          $categories_str .= $category_comma;
          $index++;
        }
      ?>

      <div class="project sortable" data-categories='<?php echo $categories_str; ?>'>
        <div class="image">
          <?php $image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID, 'thumbnail' ) ); ?>
          <img src="<?php echo $image; ?>">
        </div>
        <div class="details">
          <div class="top">
            <h1 class="title"><?php the_title(); ?></h1>
            <!--
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
            </div> -->
          </div>
          <div class="summary"><?php the_excerpt(); ?></div>
          <div class="links">
          <?php if ( empty( $url ) ) { ?>
            <a class="link disabled project-url" href="#">Coming Soon</a>
          <?php } else { ?>
            <a class="link project-url" href="http://<?php echo $url; ?>" target="_blank">
              View Work</a>
          <?php } ?>
            <a href="<?php the_permalink(); ?>" class="link case-study">Case Study</a>
          </div>
        </div>
      </div>

      <?php endwhile; ?>
    <?php endif; ?>

  </div>

<?php get_footer(); ?>

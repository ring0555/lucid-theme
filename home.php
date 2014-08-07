<?php get_header(); ?>

<div class="page-heading">
  <h1>Journal</h1>
  <ul class="sort">
    <li data-sort='all'>All</li>
    <?php
      $post_categories = get_categories( array( 'hide_empty' => '0' ) );
      foreach ( $post_categories as $post_category ) {
        echo '<li data-sort="'.$post_category->slug.'">'.$post_category->name.'</li>';
      }
    ?>
  </ul>
</div>

<div id="journal">

  <div class="posts">

  <?php if (have_posts()) : ?>
    <?php while ( have_posts() ) : the_post(); ?>

    <?php
      $categories = wp_get_post_categories( $post->ID );
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

    <div class="post sortable" data-categories='<?php echo $categories_str; ?>'>
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

<?php

/******************************/
/* VARIOUS UTILITY FUNCTIONS **/
/******************************/

function get_ID_by_slug($page_slug) {
  $page = get_page_by_path($page_slug);
  if ($page) {
    return $page->ID;
  } else {
    return null;
  }
}

/**************************
** Custom Work Functions **
***************************/

function my_custom_post_work() {
  $labels = array(
    'name'                => _x( 'Work', 'post type general name' ),
    'singular_name'       => _x( 'Work', 'post type singular name' ),
    'add_new'             => _x( 'Add New', 'works' ),
    'add_new_item'        => __( 'Add New Work' ),
    'edit_item'           => __( 'Edit Work' ),
    'new_item'            => __( 'New Work' ),
    'all_items'           => __( 'All Works' ),
    'view_item'           => __( 'View Work' ),
    'search_items'        => __( 'Search Works' ),
    'not_found'           => __( 'No works found' ),
    'not_found_in_trash'  => __( 'No works found in the Trash' ),
    'parent_item_colon'   => '',
    'menu_name'           => 'Work',
  );
  $args = array(
    'labels'        => $labels,
    'description'   => 'Holds our works and work specific data',
    'public'        => true,
    'menu_position' => 5,
    'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt'),
    'has_archive'   => true,
  );
  register_post_type( 'work', $args );
}

add_action( 'init', 'my_custom_post_work' );

// Update Messages

function my_updated_messages( $messages ) {
  global $post, $post_ID;
  $messages['work'] = array(
    0 => '',
    1 => sprintf( __('Work updated. <a href="%s">View work</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Work updated.'),
    5 => isset($_GET['revision']) ? sprintf( __('Work restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Work published. <a href="%s">View work</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Work saved.'),
    8 => sprintf( __('Work submitted. <a target="_blank" href="%s">Preview work</a>'),
                     esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Work scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview work</a>'),
                     date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    0 => sprintf( __('Work draft updated. <a target="_blank" href="%s">Preview work</a>'),
                     esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );
  return $messages;
}
add_filter( 'post_updated_messages', 'my_updated_messages' );

// Work Price Meta Box

add_action( 'add_meta_boxes', 'work_url_box');

function work_url_box() {
  add_meta_box(
    'work_url_box',
    __( 'Work URL', 'myplugin_textdomain' ),
    'work_url_box_content',
    'work',
    'side',
    'high'
  );
}

function work_url_box_content( $post ) {
  wp_nonce_field( plugin_basename( __FILE__ ), 'work_url_box_content_nonce' );
  echo '<label for="work_url"></label>';
  $curr_val = get_post_meta($post->ID, 'work_url', true);
  if (empty($curr_val)) {
    echo '<input type="text" id="work_url" name="work_url" placeholder="Enter URL" />';
  } else {
    echo '<input type="text" id="work_url" name="work_url" value="'.$curr_val.'" />';
  }
}

add_action( 'save_post', 'work_url_box_save' );

function work_url_box_save( $post_id ) {

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
    return;

  if ( !wp_verify_nonce( $_POST['work_url_box_content_nonce'], plugin_basename( __FILE__ ) ) )
    return;

  if ( 'page' == $_POST['post_type'] ) {
    if ( !current_user_can( 'edit_page', $post_id ) )
    return;
  } else {
    if ( !current_user_can( 'edit_post', $post_id ) )
    return;
  }

  $work_url = $_POST['work_url'];
  update_post_meta( $post_id, 'work_url', $work_url );

}


// Work Status Meta Box

add_action( 'add_meta_boxes', 'work_status_box');

function work_status_box() {
  add_meta_box(
    'work_status_box',
    __( 'Work Status', 'myplugin_textdomain' ),
    'work_status_box_content',
    'work',
    'side',
    'high'
  );
}

function work_status_box_content( $post ) {
  wp_nonce_field( plugin_basename( __FILE__ ), 'work_status_box_content_nonce' );
  echo '<label for="work_status"></label>';
  echo '<select id="work_status" name="work_status">';
  $curr_val = get_post_meta($post->ID, 'work_status', true);
  if (empty($curr_val)) {
    echo '<option value="published">Published</option>';
    echo '<option value="comingsoon">Coming Soon</option>';
  } else if ($curr_val == 'published') {
    echo '<option selected="selected" value="published">Published</option>';
    echo '<option value="comingsoon">Coming Soon</option>';
  } else {
    echo '<option value="published">Published</option>';
    echo '<option selected="selected" value="comingsoon">Coming Soon</option>';
  }
  echo '</select>';
}

add_action( 'save_post', 'work_status_box_save' );

function work_status_box_save( $post_id ) {

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
    return;

  if ( !wp_verify_nonce( $_POST['work_status_box_content_nonce'], plugin_basename( __FILE__ ) ) )
    return;

  if ( 'page' == $_POST['post_type'] ) {
    if ( !current_user_can( 'edit_page', $post_id ) )
    return;
  } else {
    if ( !current_user_can( 'edit_post', $post_id ) )
    return;
  }

  $work_status = $_POST['work_status'];
  $cleaned_work_status = str_replace( "<br>", "", $work_status);
  update_post_meta( $post_id, 'work_status', $cleaned_work_status );

}


// Work Categories

function my_taxonomies_work() {
  $labels = array(
    'name'              => _x( 'Work Categories', 'taxonomy general name' ),
    'singular_name'     => _x( 'Work Category', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Work Categories' ),
    'all_items'         => __( 'All Work Categories' ),
    'parent_item'       => __( 'Parent Work Category' ),
    'parent_item_colon' => __( 'Parent Work Category:' ),
    'edit_item'         => __( 'Edit Work Category' ),
    'update_item'       => __( 'Update Work Category' ),
    'add_new_item'      => __( 'Add New Work Category' ),
    'new_item_name'     => __( 'New Work Category' ),
    'menu_name'         => __( 'Work Categories' )
  );

  $args = array(
    'labels' => $labels,
    'hierarchical' => true
  );

  register_taxonomy( 'work_category', 'work', $args );
}

// Adding support for featured images

add_theme_support('post-thumbnails');

?>

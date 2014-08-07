<?php

/******************************/
/********* Theme Setup ********/
/******************************/

// Add support for featured images
add_theme_support('post-thumbnails');

// Add support for menus
add_theme_support( 'menus' );

function register_main_menu() {
  register_nav_menu('main-menu',__( 'Main Menu' ));
}
add_action( 'init', 'register_main_menu' );

// Remove theme and plugin editor
function remove_theme_plugin_editor() {
  remove_submenu_page( 'themes.php', 'theme-editor.php' );
  remove_submenu_page( 'plugins.php', 'plugin-editor.php' );
}
add_action( 'admin_init', 'remove_theme_plugin_editor', 102 );

// Don't show admin bar
add_filter( 'show_admin_bar', '__return_false' );

// Customize Login
function custom_login_css() { ?>
  <style>
    body.login #login h1 a {
      background: url(<?php echo get_stylesheet_directory_uri(); ?>/dist/img/login.png);
      background-size: auto auto;
      background-repeat: no-repeat;
      width: auto;
      margin: 0;
    }
  </style>
<?php
}
add_action( 'login_head', 'custom_login_css' );

function login_logo_url() {
  return home_url();
}
add_filter( 'login_headerurl', 'login_logo_url' );

function login_logo_url_title() {
  return 'WordPress Jumpstart';
}
add_filter( 'login_headertitle', 'login_logo_url_title' );

/******************************/
/******* Theme Security *******/
/******************************/

function remove_header_info() {
  remove_action( 'wp_head', 'feed_links_extra', 3 );
  remove_action( 'wp_head', 'rsd_link' );
  remove_action( 'wp_head', 'wlwmanifest_link' );
  remove_action( 'wp_head', 'wp_generator' );
  remove_action( 'wp_head', 'start_post_rel_link' );
  remove_action( 'wp_head', 'index_rel_link' );
  remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
  remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
}
add_action('init', 'remove_header_info');

function remove_wp_ver_css_js( $src ) {
  if ( strpos( $src, 'ver=' ) ) {
    $src = remove_query_arg( 'ver', $src );
  }
  return $src;
}
add_filter( 'style_loader_src', 'remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'remove_wp_ver_css_js', 9999 );

/****************************/
/** Theme Styles & Scripts **/
/****************************/

function load_styles_scripts() {
  wp_enqueue_style( 'main-css', get_template_directory_uri() . '/dist/css/main.css' );
  wp_enqueue_style( 'ionicons-css', get_template_directory_uri() . '/dist/css/ionicons.min.css' );
  wp_enqueue_script( 'main-js', get_template_directory_uri() . '/dist/js/main.min.js' );
}
add_action( 'wp_enqueue_scripts', 'load_styles_scripts' );

/*******************************/
/****** Utility Functions ******/
/*******************************/

function get_ID_by_slug( $page_slug ) {
  $page = get_page_by_path( $page_slug );
  if ( $page ) {
    return $page->ID;
  } else {
    return null;
  }
}

/******************************/
/** Custom Project Functions **/
/******************************/

function my_custom_post_project() {
  $labels = array(
    'name'                => _x( 'Projects', 'post type general name' ),
    'singular_name'       => _x( 'Project', 'post type singular name' ),
    'add_new'             => _x( 'Add New', 'Projects' ),
    'add_new_item'        => __( 'Add New Project' ),
    'edit_item'           => __( 'Edit Project' ),
    'new_item'            => __( 'New Project' ),
    'all_items'           => __( 'All Projects' ),
    'view_item'           => __( 'View Project' ),
    'search_items'        => __( 'Search Projects' ),
    'not_found'           => __( 'No projects found' ),
    'not_found_in_trash'  => __( 'No projects found in the Trash' ),
    'parent_item_colon'   => '',
    'menu_name'           => 'Projects',
  );
  $args = array(
    'labels'        => $labels,
    'description'   => 'Holds our projects and project specific data',
    'public'        => true,
    'menu_position' => 5,
    'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt'),
    'has_archive'   => true,
  );
  register_post_type( 'Project', $args );
}

add_action( 'init', 'my_custom_post_project' );

// Update Messages

function my_updated_messages( $messages ) {
  global $post, $post_ID;
  $messages['Project'] = array(
    0 => '',
    1 => sprintf( __('Project updated. <a href="%s">View Project</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Project updated.'),
    5 => isset($_GET['revision']) ? sprintf( __('Project restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Project published. <a href="%s">View Project</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Project saved.'),
    8 => sprintf( __('Project submitted. <a target="_blank" href="%s">Preview Project</a>'),
                     esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Project scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Project</a>'),
                     date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    0 => sprintf( __('Project draft updated. <a target="_blank" href="%s">Preview Project</a>'),
                     esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );
  return $messages;
}
add_filter( 'post_updated_messages', 'my_updated_messages' );

// Project URL Meta Box

add_action( 'add_meta_boxes', 'project_url_box');

function project_url_box() {
  add_meta_box(
    'project_url_box',
    __( 'Project URL', 'myplugin_textdomain' ),
    'project_url_box_content',
    'Project',
    'side',
    'high'
  );
}

function project_url_box_content( $post ) {
  wp_nonce_field( plugin_basename( __FILE__ ), 'project_url_box_content_nonce' );
  echo '<label for="project_url"></label>';
  $curr_val = get_post_meta($post->ID, 'project_url', true);
  if (empty($curr_val)) {
    echo '<input type="text" id="project_url" name="project_url" placeholder="Enter URL" />';
  } else {
    echo '<input type="text" id="project_url" name="project_url" value="'.$curr_val.'" />';
  }
}

add_action( 'save_post', 'project_url_box_save' );

function Project_url_box_save( $post_id ) {

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
    return;

  if ( !wp_verify_nonce( $_POST['project_url_box_content_nonce'], plugin_basename( __FILE__ ) ) )
    return;

  if ( 'page' == $_POST['post_type'] ) {
    if ( !current_user_can( 'edit_page', $post_id ) )
    return;
  } else {
    if ( !current_user_can( 'edit_post', $post_id ) )
    return;
  }

  $project_url = $_POST['project_url'];
  update_post_meta( $post_id, 'project_url', $project_url );

}

// Project Type Meta Box

add_action( 'add_meta_boxes', 'project_type_box');

function project_type_box() {
  add_meta_box(
    'project_type_box',
    __( 'Project Type', 'myplugin_textdomain' ),
    'project_type_box_content',
    'Project',
    'side',
    'high'
  );
}

function project_type_box_content( $post ) {
  wp_nonce_field( plugin_basename( __FILE__ ), 'project_type_box_content_nonce' );
  echo '<label for="project_type"></label>';
  echo '<select id="project_type" name="project_type">';
  $curr_val = get_post_meta($post->ID, 'project_type', true);
  if (empty($curr_val)) {
    echo '<option value="client">Client</option>';
    echo '<option value="company">Company</option>';
  } else if ($curr_val == 'client') {
    echo '<option selected="selected" value="client">Client</option>';
    echo '<option value="company">Company</option>';
  } else {
    echo '<option value="client">Client</option>';
    echo '<option selected="selected" value="company">Company</option>';
  }
  echo '</select>';
}

add_action( 'save_post', 'project_type_box_save' );

function project_type_box_save( $post_id ) {

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
    return;

  if ( !wp_verify_nonce( $_POST['project_type_box_content_nonce'], plugin_basename( __FILE__ ) ) )
    return;

  if ( 'page' == $_POST['post_type'] ) {
    if ( !current_user_can( 'edit_page', $post_id ) )
    return;
  } else {
    if ( !current_user_can( 'edit_post', $post_id ) )
    return;
  }

  $project_type = $_POST['project_type'];
  $cleaned_project_type = str_replace( "<br>", "", $project_type);
  update_post_meta( $post_id, 'project_type', $cleaned_project_type );

}

// Project Categories

function my_taxonomies_project() {
  $labels = array(
    'name'              => _x( 'Project Categories', 'taxonomy general name' ),
    'singular_name'     => _x( 'Project Category', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Project Categories' ),
    'all_items'         => __( 'All Project Categories' ),
    'parent_item'       => __( 'Parent Project Category' ),
    'parent_item_colon' => __( 'Parent Project Category:' ),
    'edit_item'         => __( 'Edit Project Category' ),
    'update_item'       => __( 'Update Project Category' ),
    'add_new_item'      => __( 'Add New Project Category' ),
    'new_item_name'     => __( 'New Project Category' ),
    'menu_name'         => __( 'Project Categories' )
  );

  $args = array(
    'labels' => $labels,
    'hierarchical' => true
  );

  register_taxonomy( 'project_category', 'project', $args );
}

add_action( 'init', 'my_taxonomies_project', 0 );

/*******************************/
/*** Custom Testimonial Post ***/
/*******************************/

function my_custom_post_testimonial() {
  $labels = array(
    'name'                => _x( 'Testimonials', 'post type general name' ),
    'singular_name'       => _x( 'Testimonial', 'post type singular name' ),
    'add_new'             => _x( 'Add New', 'Testimonials' ),
    'add_new_item'        => __( 'Add New Testimonial' ),
    'edit_item'           => __( 'Edit Testimonial' ),
    'new_item'            => __( 'New Testimonial' ),
    'all_items'           => __( 'All Testimonials' ),
    'view_item'           => __( 'View Testimonial' ),
    'search_items'        => __( 'Search Testimonials' ),
    'not_found'           => __( 'No Testimonials found' ),
    'not_found_in_trash'  => __( 'No Testimonials found in the Trash' ),
    'parent_item_colon'   => '',
    'menu_name'           => 'Testimonials',
  );
  $args = array(
    'labels'        => $labels,
    'description'   => 'Holds our testimonials and testimonial specific data',
    'public'        => true,
    'menu_position' => 5,
    'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt'),
    'has_archive'   => true,
  );
  register_post_type( 'Testimonial', $args );
}

add_action( 'init', 'my_custom_post_testimonial' );

// Company Box

add_action( 'add_meta_boxes', 'company_box');

function company_box() {
  add_meta_box(
    'company_box',
    __( 'Company Name', 'myplugin_textdomain' ),
    'company_box_content',
    'Testimonial',
    'side',
    'high'
  );
}

function company_box_content( $post ) {
  wp_nonce_field( plugin_basename( __FILE__ ), 'company_box_content_nonce' );
  echo '<label for="company"></label>';
  $curr_val = get_post_meta($post->ID, 'company', true);
  if (empty($curr_val)) {
    echo '<input type="text" id="company" name="company" placeholder="Enter Company Name">';
  } else {
    echo '<input type="text" id="company" name="company" value="'.$curr_val.'">';
  }
}

add_action( 'save_post', 'company_box_save' );

function company_box_save( $post_id ) {
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    return;
  }
  if ( !wp_verify_nonce( $_POST['company_box_content_nonce'], plugin_basename( __FILE__ ) ) ) {
    return;
  }
  if ( 'page' == $_POST['post_type'] ) {
    if ( !current_user_can( 'edit_page', $post_id ) ) {
      return;
    }
  } else if ( !current_user_can( 'edit_post', $post_id ) ) {
    return;
  }

  $company = $_POST['company'];
  update_post_meta( $post_id, 'company', $company );
}

// Title Box

add_action( 'add_meta_boxes', 'title_box');

function title_box() {
  add_meta_box(
    'title_box',
    __( 'Title Name', 'myplugin_textdomain' ),
    'title_box_content',
    'Testimonial',
    'side',
    'high'
  );
}

function title_box_content( $post ) {
  wp_nonce_field( plugin_basename( __FILE__ ), 'title_box_content_nonce' );
  echo '<label for="title"></label>';
  $curr_val = get_post_meta($post->ID, 'title', true);
  if (empty($curr_val)) {
    echo '<input type="text" id="title" name="title" placeholder="Enter Title">';
  } else {
    echo '<input type="text" id="title" name="title" value="'.$curr_val.'">';
  }
}

add_action( 'save_post', 'title_box_save' );

function title_box_save( $post_id ) {
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    return;
  }
  if ( !wp_verify_nonce( $_POST['title_box_content_nonce'], plugin_basename( __FILE__ ) ) ) {
    return;
  }
  if ( 'page' == $_POST['post_type'] ) {
    if ( !current_user_can( 'edit_page', $post_id ) ) {
      return;
    }
  } else if ( !current_user_can( 'edit_post', $post_id ) ) {
    return;
  }
  $title = $_POST['title'];
  update_post_meta( $post_id, 'title', $title );
}

/*****************************/
/*** Custom User Functions ***/
/*****************************/

function modify_contact_methods( $profile_fields ) {

  // Add new fields
  $profile_fields['companytitle'] = 'Company Title';
  $profile_fields['phonenumber'] = 'Phone Number';
  $profile_fields['twitter'] = 'Twitter URL';
  $profile_fields['linkedin'] = 'LinkedIn URL';
  $profile_fields['github'] = 'GitHub URL';
  $profile_fields['dribbble'] = 'Dribbble URL';

  return $profile_fields;
}
add_filter('user_contactmethods', 'modify_contact_methods');

?>

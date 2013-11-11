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

/******************************/
/**** CUSTOM WORK URL META ****/
/******************************/

function add_work_url_box() {
  add_meta_box(
    'work_url',
    'URL',
    'show_work_url_box',
    'post',
    'normal',
    'high');
}
add_action('add_meta_boxes', 'add_work_url_box');

function show_work_url_box() {
  global $post;
    $meta = get_post_meta($post->ID, 'work_url', true);

  echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';

  echo '<table class="form-table">';
  echo '<tr>
        <th><label for="work_url">Work URL</label></th>
        <td><input type="text" name="work_url" id="work_url" value="'.$meta.'">
        </tr>';
  echo '</table>';
}

function save_work_url_meta($post_id) {
  if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))
      return $post_id;

  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
      return $post_id;

  if ('page' == $_POST['post_type']) {
      if (!current_user_can('edit_page', $post_id))
          return $post_id;
  } elseif (!current_user_canw('edit_post', $post_id)) {
      return $post_id;
  }

  $old = get_post_meta($post_id, "work_url", true);
  $new = $_POST["work_url"];

  if ($new && $new != $old) {
      update_post_meta($post_id, "work_url", $new);
  } elseif ('' == $new && $old) {
      delete_post_meta($post_id, "work_url", $old);
  }
}

add_action('save_post', 'save_work_url_meta');

add_theme_support('post-thumbnails');

?>

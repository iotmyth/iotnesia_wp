<?php
/**
 * Vikinger BLOG AJAX
 * 
 * @since 1.0.0
 */

/**
 * Get filtered posts
 */
function vikinger_get_posts_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  // get posts
  $posts = vikinger_get_posts($_POST['post_data']);

  header('Content-Type: application/json');
  
  // return posts
  echo json_encode($posts);

  wp_die();
}

add_action('wp_ajax_vikinger_get_posts_ajax', 'vikinger_get_posts_ajax');
add_action('wp_ajax_nopriv_vikinger_get_posts_ajax', 'vikinger_get_posts_ajax');

/**
 * Delete post comment
 */
function vikinger_post_comment_delete_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $result = vikinger_post_comment_delete($_POST['args']['comment_id']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_post_comment_delete_ajax', 'vikinger_post_comment_delete_ajax');

/**
 * Get filtered pages
 */
function vikinger_get_pages_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  // get pages
  $pages = vikinger_get_pages($_POST['args']);

  header('Content-Type: application/json');
  
  // return pages
  echo json_encode($pages);

  wp_die();
}

add_action('wp_ajax_vikinger_get_pages_ajax', 'vikinger_get_pages_ajax');
add_action('wp_ajax_nopriv_vikinger_get_pages_ajax', 'vikinger_get_pages_ajax');

/**
 * Get filtered posts count
 */
function vikinger_get_post_count_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  // get posts
  $posts = get_posts($_POST['post_data']);

  $post_count = count($posts);

  header('Content-Type: application/json');
  
  // return post count
  echo json_encode($post_count);

  wp_die();
}

add_action('wp_ajax_vikinger_get_post_count_ajax', 'vikinger_get_post_count_ajax');
add_action('wp_ajax_nopriv_vikinger_get_post_count_ajax', 'vikinger_get_post_count_ajax');

/**
 * Get all post categories
 */
function vikinger_get_categories_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  // get categories
  $categories = get_categories();

  $my_categories = [];

  foreach ($categories as $category) {
    $cat = [];
    $cat['id'] = $category->cat_ID;
    $cat['name'] = $category->cat_name;

    $my_categories[] = $cat;
  }

  header('Content-Type: application/json');
  
  // return categories
  echo json_encode($my_categories);

  wp_die();
}

add_action('wp_ajax_vikinger_get_categories_ajax', 'vikinger_get_categories_ajax');
add_action('wp_ajax_nopriv_vikinger_get_categories_ajax', 'vikinger_get_categories_ajax');

?>
<?php
/**
 * Vikinger COMMENT AJAX
 * 
 * @since 1.0.0
 */

/**
 * Creates a new comment
 *
 */
function vikinger_create_comment_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $comment_data = isset($_POST['comment_data']) ? $_POST['comment_data'] : [];

  // comment ID on success, false on error
  $result = vikinger_create_comment($comment_data);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_create_comment_ajax', 'vikinger_create_comment_ajax');
add_action('wp_ajax_nopriv_vikinger_create_comment_ajax', 'vikinger_create_comment_ajax');

/**
 * Get filtered comments with children
 */
function vikinger_get_comments_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $args = isset($_POST['args']) ? $_POST['args'] : [];

  $comments = vikinger_get_comments($args);

  header('Content-Type: application/json');
  echo json_encode($comments);

  wp_die();
}

add_action('wp_ajax_vikinger_get_comments_ajax', 'vikinger_get_comments_ajax');
add_action('wp_ajax_nopriv_vikinger_get_comments_ajax', 'vikinger_get_comments_ajax');

/**
 * Get a post top level comments count (comments with no parent)
 */
function vikinger_get_post_top_level_comment_count_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');
  
  // get comment count for postID
  $comment_count = vikinger_get_post_top_level_comment_count($_POST['postID']);

  header('Content-Type: application/json');
  
  // return comment count
  echo json_encode($comment_count);

  wp_die();
}

add_action('wp_ajax_vikinger_get_post_top_level_comment_count_ajax', 'vikinger_get_post_top_level_comment_count_ajax');
add_action('wp_ajax_nopriv_vikinger_get_post_top_level_comment_count_ajax', 'vikinger_get_post_top_level_comment_count_ajax');

?>
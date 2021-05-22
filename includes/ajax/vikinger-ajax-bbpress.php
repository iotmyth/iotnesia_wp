<?php
/**
 * Vikinger BBPRESS AJAX
 * 
 * @since 1.3.0
 */

/**
 * Creates group forum
 */
function vikinger_bbpress_group_forum_create_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $args = isset($_POST['args']) ? $_POST['args'] : [];
  $group_id = isset($_POST['group_id']) ? $_POST['group_id'] : false;

  $result = vikinger_bbpress_group_forum_create($args, (int) $group_id);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_bbpress_group_forum_create_ajax', 'vikinger_bbpress_group_forum_create_ajax');

/**
 * Deletes a forum
 */
function vikinger_bbpress_group_forum_delete_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $args = isset($_POST['args']) ? $_POST['args'] : [];

  $result = vikinger_bbpress_group_forum_delete($args['forum_id'], $args['group_id']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_bbpress_group_forum_delete_ajax', 'vikinger_bbpress_group_forum_delete_ajax');

/**
 * Associates a group with a forum
 */
function vikinger_bbpress_group_forum_associate_update_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $args = isset($_POST['args']) ? $_POST['args'] : [];

  $result = vikinger_bbpress_group_forum_associate_update($args['group_id'], $args['forum_id']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_bbpress_group_forum_associate_update_ajax', 'vikinger_bbpress_group_forum_associate_update_ajax');

/**
 * Returns id of forum associated with a group
 */
function vikinger_bbpress_group_forum_associate_get_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $args = isset($_POST['args']) ? $_POST['args'] : [];

  $result = vikinger_bbpress_group_forum_associate_get($args['group_id']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_bbpress_group_forum_associate_get_ajax', 'vikinger_bbpress_group_forum_associate_get_ajax');

?>

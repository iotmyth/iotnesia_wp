<?php
/**
 * Vikinger NOTIFICATION AJAX
 * 
 * @since 1.0.0
 */

/**
 * Get filtered notifications
 */
function vikinger_get_notifications_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $args = (isset($_POST['args']) && is_array($_POST['args'])) ? $_POST['args'] : [];
  $notifications = vikinger_get_notifications($args);

  header('Content-Type: application/json');
  echo json_encode($notifications);

  wp_die();
}

add_action('wp_ajax_vikinger_get_notifications_ajax', 'vikinger_get_notifications_ajax');
add_action('wp_ajax_nopriv_vikinger_get_notifications_ajax', 'vikinger_get_notifications_ajax');

/**
 * Get filtered notifications count
 */
function vikinger_get_unread_notifications_count_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $args = (isset($_POST['args']) && is_array($_POST['args'])) ? $_POST['args'] : [];
  $count = vikinger_get_unread_notifications_count($args);

  header('Content-Type: application/json');
  echo json_encode($count);

  wp_die();
}

add_action('wp_ajax_vikinger_get_unread_notifications_count_ajax', 'vikinger_get_unread_notifications_count_ajax');
add_action('wp_ajax_nopriv_vikinger_get_unread_notifications_count_ajax', 'vikinger_get_unread_notifications_count_ajax');

/**
 * Mark multiple notifications as read
 */
function vikinger_mark_notifications_as_read_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $result = vikinger_mark_notifications_as_read($_POST['args']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_mark_notifications_as_read_ajax', 'vikinger_mark_notifications_as_read_ajax');

/**
 * Mark a notification as read
 */
function vikinger_mark_notification_as_read_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');
  
  $result = vikinger_mark_notification_as_read($_POST['args']['id']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_mark_notification_as_read_ajax', 'vikinger_mark_notification_as_read_ajax');

/**
 * Delete a notification
 */
function vikinger_delete_notifications_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');
  
  $result = vikinger_delete_notifications($_POST['args']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_delete_notifications_ajax', 'vikinger_delete_notifications_ajax');

?>
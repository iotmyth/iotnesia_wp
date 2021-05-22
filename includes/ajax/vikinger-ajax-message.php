<?php
/**
 * Vikinger MESSAGE AJAX
 * 
 * @since 1.0.0
 */

/**
 * Get filtered messages
 */
function vikinger_get_messages_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $args = (isset($_POST['args']) && is_array($_POST['args'])) ? $_POST['args'] : [];
  $messages = vikinger_get_messages($args);

  header('Content-Type: application/json');
  echo json_encode($messages);

  wp_die();
}

add_action('wp_ajax_vikinger_get_messages_ajax', 'vikinger_get_messages_ajax');
add_action('wp_ajax_nopriv_vikinger_get_messages_ajax', 'vikinger_get_messages_ajax');

/**
 * Get a message thread
 */
function vikinger_get_message_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $message = vikinger_get_message($_POST['args']);

  header('Content-Type: application/json');
  echo json_encode($message);

  wp_die();
}

add_action('wp_ajax_vikinger_get_message_ajax', 'vikinger_get_message_ajax');
add_action('wp_ajax_nopriv_vikinger_get_message_ajax', 'vikinger_get_message_ajax');

/**
 * Send a message or start a new thread
 */
function vikinger_send_message_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $result = vikinger_send_message($_POST['args']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_send_message_ajax', 'vikinger_send_message_ajax');

/**
 * Star a message
 */
function vikinger_star_message_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $result = vikinger_star_message($_POST['args']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_star_message_ajax', 'vikinger_star_message_ajax');

/**
 * Unstar a message
 */
function vikinger_unstar_message_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $result = vikinger_unstar_message($_POST['args']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_unstar_message_ajax', 'vikinger_unstar_message_ajax');

/**
 * Mark a message thread as read
 */
function vikinger_message_mark_thread_as_read_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $result = vikinger_message_mark_thread_as_read($_POST['args']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_message_mark_thread_as_read_ajax', 'vikinger_message_mark_thread_as_read_ajax');

/**
 * Delete a message thread
 */
function vikinger_delete_message_thread_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');
  
  $result = vikinger_delete_message_thread($_POST['args']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_delete_message_thread_ajax', 'vikinger_delete_message_thread_ajax');



?>
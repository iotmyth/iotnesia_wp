<?php
/**
 * Vikinger FRIEND AJAX
 * 
 * @since 1.0.0
 */

/**
 * Add a friend
 */
function vikinger_friend_add_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $result = vikinger_friend_add($_POST['args']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_friend_add_ajax', 'vikinger_friend_add_ajax');

/**
 * Remove a friend
 */
function vikinger_friend_remove_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $result = vikinger_friend_remove($_POST['args']['friendship_id']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_friend_remove_ajax', 'vikinger_friend_remove_ajax');

/**
 * Withdraw a friend request
 */
function vikinger_friend_withdraw_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $result = vikinger_friend_withdraw($_POST['args']['initiator_userid'], $_POST['args']['friend_userid']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_friend_withdraw_ajax', 'vikinger_friend_withdraw_ajax');

/**
 * Reject a friend request
 */
function vikinger_friend_reject_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $result = vikinger_friend_reject($_POST['args']['friendship_id']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_friend_reject_ajax', 'vikinger_friend_reject_ajax');

/**
 * Accept a friend request
 */
function vikinger_friend_accept_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');
  
  $result = vikinger_friend_accept($_POST['args']['friendship_id']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_friend_accept_ajax', 'vikinger_friend_accept_ajax');

?>
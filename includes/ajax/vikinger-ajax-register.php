<?php
/**
 * Vikinger REGISTER AJAX
 * 
 * @since 1.0.0
 */


/**
 * Registers a new user
 */
function vikinger_register_user_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');
  
  $result = vikinger_register_user($_POST['args']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_nopriv_vikinger_register_user_ajax', 'vikinger_register_user_ajax');

?>
<?php
/**
 * Vikinger LOGIN AJAX
 * 
 * @since 1.0.0
 */

 /**
 * Login with provided username and password
 */
function vikinger_login() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $args = $_POST['args'];

  $creds = [
    'user_login'    => $args['username'],
    'user_password' => $args['password'],
    'remember'      => $args['remember']
  ];

  $user = wp_signon($creds, false);
  
  $login_data = [
    'result'        => $user,
    'redirect_uri'  => esc_url(home_url('/'))
  ];

  header('Content-Type: application/json');
  echo json_encode($login_data);

  wp_die();
}

add_action('wp_ajax_nopriv_vikinger_login', 'vikinger_login');

/**
 * Check if a password plain text can be used to generated the password hash
 */
function vikinger_check_password_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $result = wp_check_password($_POST['args']['password_plain'], $_POST['args']['password_hash'], $_POST['args']['user_id']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_check_password_ajax', 'vikinger_check_password_ajax');

/**
 * Update user password
 */
function vikinger_update_password_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');
  
  wp_set_password($_POST['args']['password'], $_POST['args']['user_id']);

  // wp_set_password logs user out, so we have to log user in again
  $user = get_userdata($_POST['args']['user_id']);

  $creds = array(
    'user_login'    => $user->user_login,
    'user_password' => $_POST['args']['password'],
    'remember'      => true
  );

  $result = wp_signon($creds, false);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_update_password_ajax', 'vikinger_update_password_ajax');

?>
<?php
/**
 * Vikinger LOGOUT AJAX
 * 
 * @since 1.0.0
 */

/**
 * Logout
 */
function vikinger_logout() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');
  
  wp_logout();
  
  $logout_data = array(
    'redirect_uri' => esc_url(home_url('/'))
  );

  header('Content-Type: application/json');
  echo json_encode($logout_data);

  wp_die();
}

add_action('wp_ajax_vikinger_logout', 'vikinger_logout');

 ?>
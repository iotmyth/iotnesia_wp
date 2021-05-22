<?php
/**
 * Vikinger USER AJAX
 * 
 * @since 1.0.0
 */

/**
 * Update user metadata
 */
function vikinger_user_meta_update_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');
  
  $result = vikinger_user_meta_update($_POST['args']['user_id'], $_POST['args']['metadata']);

  header('Content-Type: application/json');
  
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_user_meta_update_ajax', 'vikinger_user_meta_update_ajax');

/**
 * Toggle logged user color theme
 */
function vikinger_logged_user_color_theme_toggle_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');
  
  $result = vikinger_logged_user_color_theme_toggle();

  header('Content-Type: application/json');
  
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_logged_user_color_theme_toggle_ajax', 'vikinger_logged_user_color_theme_toggle_ajax');

/**
 * Delete logged user account
 */
function vikinger_logged_user_delete_account_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');
  
  $result = vikinger_logged_user_delete_account();

  header('Content-Type: application/json');
  
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_logged_user_delete_account_ajax', 'vikinger_logged_user_delete_account_ajax');

/**
 * Update logged user posts grid type
 */
function vikinger_logged_user_grid_type_update_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');
  
  $result = vikinger_logged_user_grid_type_update($_POST['args']['grid_component'], $_POST['args']['grid_type']);

  header('Content-Type: application/json');
  
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_logged_user_grid_type_update_ajax', 'vikinger_logged_user_grid_type_update_ajax');

/**
 * Update logged user sidemenu status
 */
function vikinger_logged_user_sidemenu_status_update_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');
  
  $result = vikinger_logged_user_sidemenu_status_update($_POST['args']['sidemenu_status']);

  header('Content-Type: application/json');
  
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_logged_user_sidemenu_status_update_ajax', 'vikinger_logged_user_sidemenu_status_update_ajax');
add_action('wp_ajax_nopriv_vikinger_logged_user_sidemenu_status_update_ajax', 'vikinger_logged_user_sidemenu_status_update_ajax');

?>
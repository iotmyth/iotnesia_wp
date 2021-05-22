<?php
/**
 * Vikinger MEMBER AJAX
 * 
 * @since 1.0.0
 */

/**
 * Get logged in user member data, or false if no user is logged in
 */
function vikinger_get_logged_user_member_data_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');
  
  $data_scope = isset($_POST['data_scope']) ? $_POST['data_scope'] : 'user-status';

  if (vikinger_plugin_buddypress_is_active()) {
    $user = vikinger_get_logged_user_member_data($data_scope);
  } else {
    $user = vikinger_get_logged_user_data();
  }

  header('Content-Type: application/json');
  echo json_encode($user);

  wp_die();
}

add_action('wp_ajax_vikinger_get_logged_user_member_data_ajax', 'vikinger_get_logged_user_member_data_ajax');
add_action('wp_ajax_nopriv_vikinger_get_logged_user_member_data_ajax', 'vikinger_get_logged_user_member_data_ajax');

/**
 * Get filtered members
 */
function vikinger_members_get_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $filters = isset($_POST['filters']) ? $_POST['filters'] : [];

  $members = vikinger_members_get($filters);

  header('Content-Type: application/json');
  
  // return members
  echo json_encode($members);

  wp_die();
}

add_action('wp_ajax_vikinger_members_get_ajax', 'vikinger_members_get_ajax');
add_action('wp_ajax_nopriv_vikinger_members_get_ajax', 'vikinger_members_get_ajax');

/**
 * Get filtered members count
 */
function vikinger_members_get_count_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $filters = isset($_POST['filters']) ? $_POST['filters'] : [];

  $members_count = vikinger_members_get_count($filters);

  header('Content-Type: application/json');
  
  // return members count
  echo json_encode($members_count);

  wp_die();
}

add_action('wp_ajax_vikinger_members_get_count_ajax', 'vikinger_members_get_count_ajax');
add_action('wp_ajax_nopriv_vikinger_members_get_count_ajax', 'vikinger_members_get_count_ajax');

/**
 * Update member xprofile data
 */
function vikinger_member_update_xprofile_data_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');
  
  $result = vikinger_member_update_xprofile_data($_POST['args']['fields'], $_POST['args']['member_id']);

  do_action('gamipress_bp_update_profile', $_POST['args']['member_id']);

  header('Content-Type: application/json');
  
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_member_update_xprofile_data_ajax', 'vikinger_member_update_xprofile_data_ajax');

/**
 * Call avatar upload triggers
 */
function vikinger_member_avatar_upload_triggers_call_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  do_action_deprecated('xprofile_avatar_uploaded', [(int) $_POST['user_id']], '6.0.0', 'bp_members_avatar_uploaded');
  
  do_action('bp_members_avatar_uploaded', (int) $_POST['user_id']);

  header('Content-Type: application/json');
  
  echo json_encode(true);

  wp_die();
}

add_action('wp_ajax_vikinger_member_avatar_upload_triggers_call_ajax', 'vikinger_member_avatar_upload_triggers_call_ajax');

/**
 * Call cover upload triggers
 */
function vikinger_member_cover_upload_triggers_call_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  do_action_deprecated('xprofile_cover_image_uploaded', [(int) $_POST['user_id']], '6.0.0', 'members_cover_image_uploaded');
  
  do_action('members_cover_image_uploaded', (int) $_POST['user_id']);

  header('Content-Type: application/json');
  
  echo json_encode(true);

  wp_die();
}

add_action('wp_ajax_vikinger_member_cover_upload_triggers_call_ajax', 'vikinger_member_cover_upload_triggers_call_ajax');

/**
 * Delete member avatar
 */
function vikinger_member_avatar_delete_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $result = vikinger_member_avatar_delete($_POST['user_id']);

  header('Content-Type: application/json');
  
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_member_avatar_delete_ajax', 'vikinger_member_avatar_delete_ajax');

/**
 * Delete member cover
 */
function vikinger_member_cover_delete_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $result = vikinger_member_cover_delete($_POST['user_id']);

  header('Content-Type: application/json');
  
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_member_cover_delete_ajax', 'vikinger_member_cover_delete_ajax');

?>
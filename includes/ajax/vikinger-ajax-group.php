<?php
/**
 * Vikinger GROUP AJAX
 * 
 * @since 1.0.0
 */

/**
 * Get filtered groups
 */
function vikinger_groups_get_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $args = isset($_POST['args']) ? $_POST['args'] : [];
  $groups = vikinger_groups_get($_POST['args']);

  header('Content-Type: application/json');
  echo json_encode($groups);

  wp_die();
}

add_action('wp_ajax_vikinger_groups_get_ajax', 'vikinger_groups_get_ajax');
add_action('wp_ajax_nopriv_vikinger_groups_get_ajax', 'vikinger_groups_get_ajax');

/**
 * Get groups count
 */
function vikinger_groups_get_count_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $args = isset($_POST['args']) ? $_POST['args'] : [];
  $groups_count = vikinger_groups_get_count($args);

  header('Content-Type: application/json');
  echo json_encode($groups_count);

  wp_die();
}

add_action('wp_ajax_vikinger_groups_get_count_ajax', 'vikinger_groups_get_count_ajax');
add_action('wp_ajax_nopriv_vikinger_groups_get_count_ajax', 'vikinger_groups_get_count_ajax');

/**
 * Get filtered group members
 */
function vikinger_groups_get_members_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $args = isset($_POST['args']) ? $_POST['args'] : [];
  $group_members = vikinger_groups_get_members($_POST['args']);

  header('Content-Type: application/json');
  echo json_encode($group_members);

  wp_die();
}

add_action('wp_ajax_vikinger_groups_get_members_ajax', 'vikinger_groups_get_members_ajax');
add_action('wp_ajax_nopriv_vikinger_groups_get_members_ajax', 'vikinger_groups_get_members_ajax');

/**
 * Get filtered group members
 */
function vikinger_groups_get_members_count_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $args = isset($_POST['args']) ? $_POST['args'] : [];
  $group_members = vikinger_groups_get_members_count($_POST['args']);

  header('Content-Type: application/json');
  echo json_encode($group_members);

  wp_die();
}

add_action('wp_ajax_vikinger_groups_get_members_count_ajax', 'vikinger_groups_get_members_count_ajax');
add_action('wp_ajax_nopriv_vikinger_groups_get_members_count_ajax', 'vikinger_groups_get_members_count_ajax');

/**
 * Creates a group
 */
function vikinger_group_create_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $result = vikinger_group_create($_POST['args']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_group_create_ajax', 'vikinger_group_create_ajax');

/**
 * Updates a group
 */
function vikinger_group_update_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $result = vikinger_group_update($_POST['args']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_group_update_ajax', 'vikinger_group_update_ajax');

/**
 * Deletes a group
 */
function vikinger_group_delete_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $result = vikinger_group_delete($_POST['args']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_group_delete_ajax', 'vikinger_group_delete_ajax');

/**
 * Request a group membership
 */
function vikinger_group_membership_requests_send_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $result = vikinger_group_membership_requests_send($_POST['args']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_group_membership_requests_send_ajax', 'vikinger_group_membership_requests_send_ajax');

/**
 * Remove a group membership
 */
function vikinger_group_membership_requests_remove_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $result = vikinger_group_membership_requests_remove($_POST['args']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_group_membership_requests_remove_ajax', 'vikinger_group_membership_requests_remove_ajax');

/**
 * Accept a group membership
 */
function vikinger_group_membership_requests_accept_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $result = vikinger_group_membership_requests_accept($_POST['args']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_group_membership_requests_accept_ajax', 'vikinger_group_membership_requests_accept_ajax');

/**
 * Adds a member to a group
 */
function vikinger_group_join_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $result = vikinger_group_join($_POST['args']['group_id'], $_POST['args']['user_id']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_group_join_ajax', 'vikinger_group_join_ajax');

/**
 * Removes a member from a group
 */
function vikinger_group_leave_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $result = vikinger_group_leave($_POST['args']['group_id'], $_POST['args']['user_id']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_group_leave_ajax', 'vikinger_group_leave_ajax');

/**
 * Remove a group member
 */
function vikinger_group_member_remove_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $result = vikinger_group_member_remove($_POST['args']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_group_member_remove_ajax', 'vikinger_group_member_remove_ajax');

/**
 * Send a group invitation
 */
function vikinger_group_send_invite_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $result = vikinger_group_send_invite($_POST['args']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_group_send_invite_ajax', 'vikinger_group_send_invite_ajax');

/**
 * Accept a group invitation
 */
function vikinger_group_accept_invite_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $result = vikinger_group_accept_invite($_POST['args']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_group_accept_invite_ajax', 'vikinger_group_accept_invite_ajax');

/**
 * Remove or reject a group invitation
 */
function vikinger_group_remove_invite_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $result = vikinger_group_remove_invite($_POST['args']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_group_remove_invite_ajax', 'vikinger_group_remove_invite_ajax');

/**
 * Promote a group member to admin
 */
function vikinger_group_member_promote_to_admin_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $result = vikinger_group_member_promote_to_admin($_POST['args']);

  do_action('groups_promote_member', $_POST['args']['group_id'], $_POST['args']['member_id'], 'admin');
  do_action('groups_promoted_member', $_POST['args']['member_id'], $_POST['args']['group_id']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_group_member_promote_to_admin_ajax', 'vikinger_group_member_promote_to_admin_ajax');

/**
 * Promote a group member to mod
 */
function vikinger_group_member_promote_to_mod_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $result = vikinger_group_member_promote_to_mod($_POST['args']);

  do_action('groups_promote_member', $_POST['args']['group_id'], $_POST['args']['member_id'], 'mod');
  do_action('groups_promoted_member', $_POST['args']['member_id'], $_POST['args']['group_id']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_group_member_promote_to_mod_ajax', 'vikinger_group_member_promote_to_mod_ajax');

/**
 * Demote a group member to member
 */
function vikinger_group_member_demote_to_member_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $result = vikinger_group_member_demote_to_member($_POST['args']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_group_member_demote_to_member_ajax', 'vikinger_group_member_demote_to_member_ajax');

/**
 * Demote a group member to mod
 */
function vikinger_group_member_demote_to_mod_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $result = vikinger_group_member_demote_to_mod($_POST['args']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_group_member_demote_to_mod_ajax', 'vikinger_group_member_demote_to_mod_ajax');

/**
 * Ban a group member
 */
function vikinger_group_member_ban_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $result = vikinger_group_member_ban($_POST['args']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_group_member_ban_ajax', 'vikinger_group_member_ban_ajax');

/**
 * Unban a group member
 */
function vikinger_group_member_unban_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $result = vikinger_group_member_unban($_POST['args']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_group_member_unban_ajax', 'vikinger_group_member_unban_ajax');

/**
 * Update group metadata fields
 */
function vikinger_group_update_meta_fields_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $result = vikinger_group_update_meta_fields($_POST['args']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_group_update_meta_fields_ajax', 'vikinger_group_update_meta_fields_ajax');

/**
 * Delete group metadata fields
 */
function vikinger_group_delete_meta_fields_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');
  
  $result = vikinger_group_delete_meta_fields($_POST['args']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_group_delete_meta_fields_ajax', 'vikinger_group_delete_meta_fields_ajax');

?>
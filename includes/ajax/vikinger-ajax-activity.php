<?php
/**
 * Vikinger ACTIVITY AJAX
 * 
 * @since 1.0.0
 */

/**
 * Get filtered activities
 */
function vikinger_get_activities_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $filters = isset($_POST['filters']) ? $_POST['filters'] : [];

  if (array_key_exists('show_hidden', $filters)) {
    $filters['show_hidden'] = $filters['show_hidden'] === 'true';
  }

  $activities = vikinger_get_activities($filters);

  header('Content-Type: application/json');
  echo json_encode($activities);

  wp_die();
}

add_action('wp_ajax_vikinger_get_activities_ajax', 'vikinger_get_activities_ajax');
add_action('wp_ajax_nopriv_vikinger_get_activities_ajax', 'vikinger_get_activities_ajax');

/**
 * Create activity comment
 */
function vikinger_create_activity_comment() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $args = isset($_POST['args']) ? $_POST['args'] : [];

  $result = bp_activity_new_comment($args);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_create_activity_comment', 'vikinger_create_activity_comment');

/**
 * Create activity
 */
function vikinger_create_activity_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  // check for uploadable media
  $uploadable_media = false;

  if (isset($_POST['uploadable_media']) && isset($_FILES['uploadable_media'])) {
    $uploadable_media = $_POST['uploadable_media'];
    $uploadable_media['files'] = vikinger_php_files_to_array($_FILES['uploadable_media']);
  }

  // assemble ajax args
  $args = [
    'creation_config'       => $_POST['creation_config'],
    'attached_media'        => isset($_POST['attached_media']) ? $_POST['attached_media'] : false,
    'uploadable_media'      => $uploadable_media,
    'uploadable_media_type' => isset($_POST['uploadable_media_type']) ? $_POST['uploadable_media_type'] : false,
    'share_config'          => isset($_POST['share_config']) ? $_POST['share_config'] : false
  ];

  // convert hide_sitewide to boolean
  if (array_key_exists('hide_sitewide', $args['creation_config'])) {
    $args['creation_config']['hide_sitewide'] = $args['creation_config']['hide_sitewide'] === 'true';
  }

  // create activity, $activity_id is activity id on success, or false on error
  $activity_id = vikinger_create_activity($args['creation_config']);

  // if activity created succesfully
  if ($activity_id) {
    // create task scheduler
    $create_activity_scheduler = new Vikinger_Scheduler();

    // activity has attached media
    if ($args['attached_media']) {
      $attached_media_args = $args['attached_media'];
      $attached_media_args['activity_id'] = $activity_id;

      // create attached media type meta task
      $create_attachedmedia_type_meta_task = vikinger_activity_create_meta_attachedmedia_type_task($attached_media_args);
      // add task to scheduler
      $create_activity_scheduler->addTask($create_attachedmedia_type_meta_task);

      // create attached media id meta task
      $create_attachedmedia_id_meta_task = vikinger_activity_create_meta_attachedmedia_id_task($attached_media_args);
      // add task to scheduler
      $create_activity_scheduler->addTask($create_attachedmedia_id_meta_task);
    }

    // activity has uploadable media
    if ($args['uploadable_media']) {
      // create upload file task for each file
      foreach ($args['uploadable_media']['files'] as $file) {
        $file_args = [
          'file_data'       => $file,
          'component'       => $args['uploadable_media']['component'],
          'file_data_type'  => $args['uploadable_media_type']
        ];

        // create upload file task
        $upload_file_task = vikinger_file_create_task($file_args);
        
        // add task to scheduler
        $create_activity_scheduler->addTask($upload_file_task);

        // create media entry in database for uploaded file
        $file_create_media_entry_task = vikinger_file_create_media_entry_task();

        // add task to scheduler
        $create_activity_scheduler->addTask($file_create_media_entry_task);

        // create uploaded media id meta task
        $create_uploadedmedia_id_meta_task = vikinger_activity_create_meta_uploadedmedia_id_task($activity_id);

        // add task to scheduler
        $create_activity_scheduler->addTask($create_uploadedmedia_id_meta_task);

        // set activity type based on uploaded media type
        if ($args['uploadable_media_type'] === 'image') {
          $activity_type = 'activity_media';
        } else if ($args['uploadable_media_type'] === 'video') {
          $activity_type = 'activity_video';
        }

        // create media individual activity
        $activity_media_args = [
          'component'     => $args['creation_config']['component'],
          'item_id'       => $args['uploadable_media']['component']['id'],
          'hide_sitewide' => $args['creation_config']['hide_sitewide'],
          'type'          => $activity_type,
          'content'       => ''
        ];

        // if there is only 1 media to upload, set media activity content to the same as the activity
        if (count($args['uploadable_media']['files']) === 1) {
          $activity_media_args['content'] = $args['creation_config']['content'];
        }

        $create_media_activity_task = vikinger_activity_media_create_task($activity_media_args);

        // add task to scheduler
        $create_activity_scheduler->addTask($create_media_activity_task);
      }
    }

    // activity is a share
    if ($args['share_config']) {
      // sharing an activity
      if ($args['share_config']['type'] === 'activity') {
        // create activity share count meta task
        $create_activity_share_count_meta_task = vikinger_activity_create_meta_share_count_task($args['share_config']);
        // add task to scheduler
        $create_activity_scheduler->addTask($create_activity_share_count_meta_task);
      // sharing a post
      } else if ($args['share_config']['type'] === 'post') {
        // create post share count meta task
        $create_post_share_count_meta_task = vikinger_post_create_meta_share_count_task($args['share_config']);
        // add task to scheduler
        $create_activity_scheduler->addTask($create_post_share_count_meta_task);
      }
    }
    
    // run scheduler
    $result = $create_activity_scheduler->run();

    // if a task failed, remove created activity
    if (!$result) {
      vikinger_delete_activity($activity_id);
      $activity_id = $result;
    }
  }

  header('Content-Type: application/json');
  echo json_encode($activity_id);

  wp_die();
}

add_action('wp_ajax_vikinger_create_activity_ajax', 'vikinger_create_activity_ajax');

/**
 * Delete activity
 */
function vikinger_delete_activity_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $result = vikinger_delete_activity($_POST['activity_id']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_delete_activity_ajax', 'vikinger_delete_activity_ajax');

/**
 * Delete activity comment
 */
function vikinger_activity_comment_delete_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $result = vikinger_activity_comment_delete($_POST['args']['activity_id'], $_POST['args']['comment_id']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_activity_comment_delete_ajax', 'vikinger_activity_comment_delete_ajax');

/**
 * Delete activity media
 */
function vikinger_delete_activity_media_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $items = $_POST['args'];

  $deleted_ids = [];

  foreach ($items as $item) {
    $media_data = $item['media'];
    
    // decide if we only are going to delete activity media, or main activity
    $main_activity_id = vikinger_activity_meta_activity_id_get((int) $media_data['id']);

    $main_activity_media_count = false;

    // if main activity exists
    if ($main_activity_id) {
      // get remaining media count for main activity
      $main_activity_media_count = vikinger_activity_meta_media_count_get($main_activity_id);
    }
    
    // only one media remaining, delete activity
    if ($main_activity_media_count === 1) {

      $main_activity_delete_result = vikinger_delete_activity($main_activity_id);

      if ($main_activity_delete_result) {
        $deleted_ids[] = $item['activity_id'];
      }
    // more than one media remaining, only delete media
    } else {
      $result = bp_activity_delete_by_activity_id((int) $item['activity_id']);

      if ($result) {
        // delete media "uploaded_media_id" meta asociated to main activity
        $activity_meta_delete_result = bp_activity_delete_meta($main_activity_id, 'uploaded_media_id', (int) $media_data['id']);

        vkmedia_delete_media((int) $media_data['id']);

        $file_path = vikinger_get_component_upload_path($item['component']) . '/' . $media_data['name'] . '.' . $media_data['type'];

        vikinger_delete_file($file_path);

        $deleted_ids[] = $item['activity_id'];
      }
    }
  }

  header('Content-Type: application/json');
  echo json_encode($deleted_ids);

  wp_die();
}

add_action('wp_ajax_vikinger_delete_activity_media_ajax', 'vikinger_delete_activity_media_ajax');

/**
 * Add favorite activity
 */
function vikinger_add_favorite_activity_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $result = vikinger_add_favorite_activity($_POST['activityID'], $_POST['userID']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_add_favorite_activity_ajax', 'vikinger_add_favorite_activity_ajax');

/**
 * Remove favorite activity
 */
function vikinger_remove_favorite_activity_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $result = vikinger_remove_favorite_activity($_POST['activityID'], $_POST['userID']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_remove_favorite_activity_ajax', 'vikinger_remove_favorite_activity_ajax');

/**
 * Pin activity by user
 */
function vikinger_pin_activity_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $result = vikinger_pin_activity($_POST['activityID'], $_POST['userID']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_pin_activity_ajax', 'vikinger_pin_activity_ajax');

/**
 * Unpin activity by user
 */
function vikinger_unpin_activity_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');

  $result = vikinger_unpin_activity($_POST['userID']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_unpin_activity_ajax', 'vikinger_unpin_activity_ajax');

/**
 * Get user pinned activity
 */
function vikinger_get_pinned_activity_ajax() {
  // nonce check, dies early if the nonce cannot be verified
  check_ajax_referer('vikinger_ajax');
  
  $result = vikinger_get_pinned_activity($_POST['userID']);

  header('Content-Type: application/json');
  echo json_encode($result);

  wp_die();
}

add_action('wp_ajax_vikinger_get_pinned_activity_ajax', 'vikinger_get_pinned_activity_ajax');
add_action('wp_ajax_nopriv_vikinger_get_pinned_activity_ajax', 'vikinger_get_pinned_activity_ajax');

?>
<?php
/**
 * Vikinger SETTINGS functions
 * 
 * @since 1.3.3
 */

/**
 * Returns vikinger theme settings.
 * 
 * @return array $settings      All settings.
 */
function vikinger_settings_get() {
  $upload_max_size = vikinger_upload_max_size_get();

  $settings = [
    /**
     * WordPress
     */
    'users_can_register'          => is_multisite() ? in_array(get_site_option('registration', false), ['all', 'user']) : get_option('users_can_register') === '1',
    'posts_per_page'              => get_option('posts_per_page'),
    'current_user_is_admin'       => current_user_can('administrator'),
    
    /**
     * Vikinger
     */

    /**
     * Sidemenu
     */
    'sidemenu_status' => get_theme_mod('vikinger_sidemenu_setting_display', 'display'),
    'sidemenu_active' => vikinger_logged_user_sidemenu_status_get() === 'open',

    /**
     * Search
     */
    'search_status'           => get_theme_mod('vikinger_search_setting_status', 'display'),

    'search_blog_enabled'     => get_theme_mod('vikinger_search_setting_blog_enabled', true),
    'search_members_enabled'  => get_theme_mod('vikinger_search_setting_members_enabled', true),
    'search_groups_enabled'   => get_theme_mod('vikinger_search_setting_groups_enabled', true),

    /**
     * Playback
     */
    'newsfeed_yt_playback_limit'  => get_theme_mod('vikinger_newsfeed_setting_yt_playback_limit', 'no'),

    /**
     * Activity
     */
    'activity_show_more_status'        => get_theme_mod('vikinger_activity_setting_show_more_status', 'enabled'),
    'activity_show_more_height'        => get_theme_mod('vikinger_activity_setting_show_more_height', 1000),

    'activity_character_limit'         => get_theme_mod('vikinger_activity_setting_character_limit', 1000),
    'activity_comment_character_limit' => get_theme_mod('vikinger_activity_setting_comment_character_limit', 500),

    /**
     * Media
     */
    'media_photo_upload_enabled'      => vikinger_settings_media_file_upload_is_enabled('image'),
    'media_photo_upload_maximum_size' => get_theme_mod('vikinger_media_setting_photo_upload_maximum_size', $upload_max_size),
    'media_photo_allowed_extensions'  => vikinger_settings_media_allowed_extensions_get('image'),

    'media_video_upload_enabled'      => vikinger_settings_media_file_upload_is_enabled('video'),
    'media_video_upload_maximum_size' => get_theme_mod('vikinger_media_setting_video_upload_maximum_size', $upload_max_size),
    'media_video_allowed_extensions'  => vikinger_settings_media_allowed_extensions_get('video'),

    /**
     * Avatar
     */
    'avatar_type' => get_theme_mod('vikinger_avatar_setting_type', 'hexagon'),

    /**
     * Footer
     */
    'footer_status' => get_theme_mod('vikinger_footer_setting_display', 'display')
  ];

  // add BuddyPress related options if BuddyPress plugin is active
  if (vikinger_plugin_buddypress_is_active()) {
    $settings['bp_restrict_group_creation'] = (bool) bp_get_option('bp_restrict_group_creation', false);

    // add bbPress related options if both BuddyPress and bbPress are active
    if (vikinger_plugin_bbpress_is_active()) {
      $settings['bbp_is_group_forums_active'] = bbp_is_group_forums_active();
    }
  }

  // add Verified Member for BuddyPress related options if plugin is active
  if (vikinger_plugin_bpverifiedmember_is_active()) {
    $settings['bp_verified_member_badge'] = vikinger_bpverifiedmember_badge_get();

    $settings = array_merge($settings, vikinger_bpverifiedmember_settings_get());
  }

  return $settings;
}

/**
 * Check if a members profile page is enabled
 * 
 * @param string $page      Page name.
 * @return bool True if members profile about page is enabled, false otherwise.
 */
function vikinger_settings_members_profile_page_is_enabled($page) {
  return get_theme_mod('vikinger_members_setting_profile_' . $page . '_page_status', 'enabled') === 'enabled';
}

/**
 * Check if file type upload is enabled
 * 
 * @return bool True if file type upload is enabled, false otherwise.
 */
function vikinger_settings_media_file_upload_is_enabled($file_type) {
  $file_type_option = [
    'image' => 'photo',
    'video' => 'video'
  ];

  return get_theme_mod('vikinger_media_setting_' . $file_type_option[$file_type] . '_upload_status', 'enabled') === 'enabled';
}

/**
 * Get media type allowed extensions
 * 
 * @param string  $file_type                      File type. One of: 'image', 'video'.
 * @param string  $format                         Format of the returned extensions: One of: 'array', 'string'.
 * @return array  $allowed_file_type_extensions   File extensions allowed for provided file type.
 */
function vikinger_settings_media_allowed_extensions_get($file_type, $format = 'array') {
  $allowed_file_type_extensions = [];

  $allowed_file_extensions = [
    'image' => get_theme_mod('vikinger_media_setting_photo_allowed_extensions', vikinger_file_default_allowed_extensions_get('image')),
    'video' => get_theme_mod('vikinger_media_setting_video_allowed_extensions', vikinger_file_default_allowed_extensions_get('video'))
  ];

  $allowed_file_type_extensions = array_key_exists($file_type, $allowed_file_extensions) ? $allowed_file_extensions[$file_type] : [];

  if ($format === 'array') {
    $allowed_file_type_extensions = explode(',', $allowed_file_type_extensions);
  }

  return $allowed_file_type_extensions;
}

/**
 * Get xProfile group Social_Links new name
 */
function vikinger_settings_xprofile_group_social_links_name_get() {
  return 'Social_' . get_theme_mod('vikinger_xprofile_setting_group_name_social_links', 'Links');
}

/**
 * Get xProfile group Profile_Bio new name
 */
function vikinger_settings_xprofile_group_profile_bio_name_get() {
  return 'Profile_' . get_theme_mod('vikinger_xprofile_setting_group_name_profile_bio', 'Bio');
}

/**
 * Get xProfile group Profile_Personal new name
 */
function vikinger_settings_xprofile_group_profile_personal_name_get() {
  return 'Profile_' . get_theme_mod('vikinger_xprofile_setting_group_name_profile_personal', 'Personal');
}

/**
 * Get xProfile group Profile_Interests new name
 */
function vikinger_settings_xprofile_group_profile_interests_name_get() {
  return 'Profile_' . get_theme_mod('vikinger_xprofile_setting_group_name_profile_interests', 'Interests');
}

/**
 * Get xProfile group Profile_Bio About field new name
 */
function vikinger_settings_xprofile_field_profile_bio_about_name_get() {
  return get_theme_mod('vikinger_xprofile_setting_field_name_profile_bio_about', 'About');
}

?>
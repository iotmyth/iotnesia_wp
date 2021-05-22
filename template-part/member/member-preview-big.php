<?php
/**
 * Vikinger Template Part - Member Preview Big
 * 
 * @package Vikinger
 * @since 1.0.0
 * @author Odin Design Themes (https://odindesignthemes.com/)
 * 
 * @see vikinger_members_get
 * 
 * @param array $args {
 *   @type array   $user        User data.
 * }
 */

  $post_count     = $args['user']['stats']['post_count'];
  $friend_count   = $args['user']['stats']['friend_count'];
  $comment_count  = $args['user']['stats']['comment_count'];

  global $vikinger_settings;

  $display_verified = vikinger_plugin_bpverifiedmember_is_active();

  $display_verified_in_fullname = $display_verified && $vikinger_settings['bp_verified_member_display_badge_in_profile_fullname'];
  $display_verified_in_username = $display_verified && $vikinger_settings['bp_verified_member_display_badge_in_profile_username'];

  $verified_user = $args['user']['verified'];

?>

<!-- USER PREVIEW -->
<div class="user-preview">
  <!-- USER PREVIEW COVER -->
  <div class="user-preview-cover" style="background: url(<?php echo esc_url($args['user']['cover_url']); ?>) center center / cover no-repeat"></div>
  <!-- /USER PREVIEW COVER -->

  <!-- USER PREVIEW INFO -->
  <div class="user-preview-info">
    <!-- USER SHORT DESCRIPTION -->
    <div class="user-short-description">
    <?php

      /**
       * Avatar Medium
       */
      get_template_part('template-part/avatar/avatar', 'medium', [
        'user'      => $args['user'],
        'modifiers' => 'user-short-description-avatar',
        'linked'    => true
      ]);

    ?>

      <!-- USER SHORT DESCRIPTION TITLE -->
      <p class="user-short-description-title">
        <a href="<?php echo esc_url($args['user']['link']); ?>">
        <?php
        
          echo esc_html($args['user']['name']);

          if ($display_verified_in_fullname && $verified_user) {
            echo $vikinger_settings['bp_verified_member_badge'];
          }

        ?>
        </a>
      </p>
      <!-- /USER SHORT DESCRIPTION TITLE -->

      <!-- USER SHORT DESCRIPTION TEXT -->
      <p class="user-short-description-text">
        <a href="<?php echo esc_url($args['user']['link']); ?>">
        <?php

          echo '&#64;' . esc_html($args['user']['mention_name']);

          if ($display_verified_in_username && $verified_user) {
            echo $vikinger_settings['bp_verified_member_badge'];
          }

        ?>
        </a>
      </p>
      <!-- /USER SHORT DESCRIPTION TEXT -->
    </div>
    <!-- /USER SHORT DESCRIPTION -->

  <?php

    // only show GamiPress badges data if plugin is active
    if (vikinger_plugin_gamipress_is_active()) :
      if ((array_key_exists('badges', $args['user'])) && (count($args['user']['badges']) > 0)) :
        $badges_to_display = array_slice($args['user']['badges'], 0, 4);

        /**
         * Badge List
         */
        get_template_part('template-part/badge/badge', 'list', [
          'badges'      => $badges_to_display,
          'modifiers'   => 'small',
          'more_count'  => count($args['user']['badges']) - 4,
          'more_link'   => $args['user']['badges_link']
        ]);
      else :

  ?>
    <!-- NO RESULTS TEXT -->
    <p class="no-results-text"><?php esc_html_e('No badges unlocked', 'vikinger'); ?></p>
    <!-- /NO RESULTS TEXT -->
  <?php

      endif;
    endif;
    
    $bio_about = array_key_exists('Profile_Bio_About', $args['user']['profile_data']['field']) ? $args['user']['profile_data']['field']['Profile_Bio_About']['value'] : '';

    $user_preview_stats_slides_classes = $bio_about !== '' ? 'member-preview-big-slides swiper-container' : '';
    $user_preview_stats_slide_classes = $bio_about !== '' ? 'swiper-wrapper' : '';
    $user_stats_classes = $bio_about !== '' ? 'swiper-slide' : '';

  ?>

    <!-- USER PREVIEW STATS SLIDES -->
    <div class="user-preview-stats-slides <?php echo esc_attr($user_preview_stats_slides_classes); ?>">
      <!-- USER PREVIEW STATS SLIDE -->
      <div class="user-preview-stats-slide <?php echo esc_attr($user_preview_stats_slide_classes); ?>">
        <!-- USER STATS -->
        <div class="user-stats <?php echo esc_attr($user_stats_classes); ?>">
          <!-- USER STAT -->
          <div class="user-stat">
            <p class="user-stat-title"><?php echo esc_html($post_count); ?></p>
            <p class="user-stat-text">
            <?php

              echo esc_html(
                _n(
                  'post',
                  'posts',
                  $post_count,
                  'vikinger'
                )
              );

            ?>
            </p>
          </div>
          <!-- /USER STAT -->
        <?php

          // add friend stat only if BuddyPress friend component is active
          if (bp_is_active('friends')) :

        ?>
          <!-- USER STAT -->
          <div class="user-stat">
            <p class="user-stat-title"><?php echo esc_html($friend_count); ?></p>
            <p class="user-stat-text">
            <?php

              echo esc_html(
                _n(
                  'friend',
                  'friends',
                  $friend_count,
                  'vikinger'
                )
              );
            
            ?>
            </p>
          </div>
          <!-- /USER STAT -->
        <?php

          endif;
          
        ?>

          <!-- USER STAT -->
          <div class="user-stat">
            <p class="user-stat-title"><?php echo esc_html($comment_count); ?></p>
            <p class="user-stat-text">
            <?php

              echo esc_html(
                _n(
                  'comment',
                  'comments',
                  $comment_count,
                  'vikinger'
                )
              );

            ?>
            </p>
          </div>
          <!-- /USER STAT -->
        </div>
        <!-- /USER STATS -->

      <?php if ($bio_about !== '') : ?>
        <div class="user-preview-stats-slide swiper-slide">
          <p class="user-preview-text"><?php echo esc_html(substr($bio_about, 0, 120) . '...'); ?></p>
        </div>
      <?php endif; ?>
      </div>
      <!-- /USER PREVIEW STATS SLIDE -->
    </div>
    <!-- /USER PREVIEW STATS SLIDES -->
  
  <?php if ($bio_about !== '') : ?>
    <!-- USER PREVIEW STATS ROSTER -->
    <div class="user-preview-stats-roster slider-roster">
    </div>
    <!-- /USER PREVIEW STATS ROSTER -->
  <?php endif; ?>

  <?php

    $social_links = vikinger_members_get_xprofile_social_links($args['user']);

    $social_links_count = count($social_links);

    if ($social_links_count > 0) :
      if ($social_links_count < 5) :
      /**
       * Social Links
       */
      get_template_part('template-part/social/social-links', null, [
        'social_links'  => $social_links,
        'modifiers'     => 'small'
      ]);
      else :
  ?>
    <!-- USER PREVIEW SOCIAL LINKS WRAP -->
    <div class="user-preview-social-links-wrap">
      <!-- USER PREVIEW SOCIAL LINKS SLIDER -->
      <div class="user-preview-social-links-slider member-preview-big-social-links-slides swiper-container">
        <!-- USER PREVIEW SOCIAL LINKS -->
        <div class="user-preview-social-links swiper-wrapper">
        <?php foreach ($social_links as $social_link) : ?>
          <div class="user-preview-social-link swiper-slide">
          <?php

            /**
             * Social Link
             */
            get_template_part('template-part/social/social-link', null, [
              'name'      => $social_link['name'],
              'link'      => $social_link['link'],
              'modifiers' => 'small'
            ]);

          ?>
          </div>
        <?php endforeach; ?>
        </div>
        <!-- /USER PREVIEW SOCIAL LINKS -->
      </div>
      <!-- /USER PREVIEW SOCIAL LINKS SLIDER -->

      <!-- SLIDER CONTROLS -->
      <div class="slider-controls">
        <!-- SLIDER CONTROL -->
        <div class="slider-control left">
        <?php

          /**
           * Icon SVG
           */
          get_template_part('template-part/icon/icon', 'svg', [
            'icon'      => 'small-arrow',
            'modifiers' => 'slider-control-icon'
          ]);

        ?>
        </div>
        <!-- /SLIDER CONTROL -->

        <!-- SLIDER CONTROL -->
        <div class="slider-control right">
        <?php

          /**
           * Icon SVG
           */
          get_template_part('template-part/icon/icon', 'svg', [
            'icon'      => 'small-arrow',
            'modifiers' => 'slider-control-icon'
          ]);

        ?>
        </div>
        <!-- /SLIDER CONTROL -->
      </div>
      <!-- /SLIDER CONTROLS -->
    </div>
    <!-- /USER PREVIEW SOCIAL LINKS WRAP -->
  <?php

      endif;
    else :

  ?>
    <p class="no-results-text no-results-social"><?php esc_html_e('No social networks linked', 'vikinger'); ?></p>
  <?php

    endif;

  ?>

    <!-- USER PREVIEW ACTIONS -->
    <div class="user-preview-actions">
      <!-- BUTTON -->
      <a class="button secondary" href="<?php echo esc_url(wp_logout_url()); ?>"><?php esc_html_e('Logout', 'vikinger'); ?></a>
      <!-- /BUTTON -->

      <!-- BUTTON -->
      <a href="<?php echo esc_url($args['user']['link']); ?>" class="button primary"><?php esc_html_e('Go to Profile', 'vikinger'); ?></a>
      <!-- /BUTTON -->
    </div>
    <!-- /USER PREVIEW ACTIONS -->
  </div>
  <!-- /USER PREVIEW INFO -->
</div>
<!-- /USER PREVIEW -->
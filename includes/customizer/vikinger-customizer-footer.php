<?php
/**
 * Vikinger Customizer - Footer
 * 
 * @since 1.0.0
 */

function vikinger_customizer_footer($wp_customize) {
  /**
   * Footer Promo section
   */
  $wp_customize->add_section('vikinger_footer', [
    'title'       => esc_html_x('Footer', '(Customizer) Footer Options - Title', 'vikinger'),
    'description' => esc_html_x('From here, you can choose what\'s displayed on the left and bottom parts of the footer of the site. Please refer to the "Menus" section of this customizer if you want to edit the footer links.', '(Customizer) Footer Options - Description', 'vikinger'),
    'priority'    => 300,
    'panel'       => 'vikinger_customizer'
  ]);

  /**
   * Footer Display
   */
  $wp_customize->add_setting('vikinger_footer_setting_display', [
    'sanitize_callback' => 'sanitize_text_field',
    'default'           => 'display'
  ]);

  $wp_customize->add_control('vikinger_footer_control_display', [
    'label'       => esc_html_x('Display / Hide', '(Customizer) Footer Option - Display / Hide - Title', 'vikinger'),
    'description' => esc_html_x('You can choose to display or hide the footer.', '(Customizer) Footer Option - Display / Hide - Description', 'vikinger'),
    'type'        => 'radio',
    'choices'     => [
      'display' => esc_html__('Display', 'vikinger'),
      'hide'    => esc_html__('Hide', 'vikinger')
    ],
    'section'     => 'vikinger_footer',
    'settings'    => 'vikinger_footer_setting_display',
  ]);

  /**
   * Navigation - Mobile Status
   */
  $wp_customize->add_setting('vikinger_footer_setting_navigation_mobile_status', [
    'sanitize_callback' => 'sanitize_text_field',
    'default'           => 'none'
  ]);

  $wp_customize->add_control('vikinger_footer_control_navigation_mobile_status', [
    'label'       => esc_html_x('Navigation - Mobile Status', '(Customizer) Footer Option - Navigation - Mobile Status - Title', 'vikinger'),
    'description' => esc_html_x('You can choose to display or hide the footer navigation on mobile resolutions.', '(Customizer) Footer Option - Navigation - Mobile Status - Description', 'vikinger'),
    'type'        => 'radio',
    'choices'     => [
      'flex' => esc_html__('Display', 'vikinger'),
      'none' => esc_html__('Hide', 'vikinger')
    ],
    'section'     => 'vikinger_footer',
    'settings'    => 'vikinger_footer_setting_navigation_mobile_status',
  ]);

  /**
   * Promo Logo
   */
  $wp_customize->add_setting('vikinger_footer_setting_promo_logo', [
    'sanitize_callback' => 'absint'
  ]);

  $wp_customize->add_control(new WP_Customize_Media_Control( $wp_customize, 'vikinger_footer_control_promo_logo', [
    'label'     => esc_html_x('Promo - Logo', '(Customizer) Footer Option - Logo - Title', 'vikinger'),
    'section'   => 'vikinger_footer',
    'settings'  => 'vikinger_footer_setting_promo_logo',
    'mime_type' => 'image'
  ]));

  /**
   * Promo Text
   */
  $wp_customize->add_setting('vikinger_footer_setting_promo_text', [
    'sanitize_callback' => 'sanitize_text_field'
  ]);

  $wp_customize->add_control('vikinger_footer_control_promo_text', [
    'label'     => esc_html_x('Promo - Text', '(Customizer) Footer Option - Text - Title', 'vikinger'),
    'type'      => 'textarea',
    'section'   => 'vikinger_footer',
    'settings'  => 'vikinger_footer_setting_promo_text'
  ]);

  /**
   * Promo Facebook Link
   */
  $wp_customize->add_setting('vikinger_footer_setting_social_links[facebook]', [
    'sanitize_callback' => 'esc_url_raw'
  ]);

  $wp_customize->add_control('vikinger_footer_control_social_links_facebook', [
    'label'     => esc_html_x('Social - Facebook Link', '(Customizer) Footer Option - Facebook Link - Title', 'vikinger'),
    'type'      => 'text',
    'section'   => 'vikinger_footer',
    'settings'  => 'vikinger_footer_setting_social_links[facebook]'
  ]);

  /**
   * Promo Twitter Link
   */
  $wp_customize->add_setting('vikinger_footer_setting_social_links[twitter]', [
    'sanitize_callback' => 'esc_url_raw'
  ]);

  $wp_customize->add_control('vikinger_footer_control_social_links_twitter', [
    'label'     => esc_html_x('Social - Twitter Link', '(Customizer) Footer Option - Twitter Link - Title', 'vikinger'),
    'type'      => 'text',
    'section'   => 'vikinger_footer',
    'settings'  => 'vikinger_footer_setting_social_links[twitter]'
  ]);

  /**
   * Promo Instagram Link
   */
  $wp_customize->add_setting('vikinger_footer_setting_social_links[instagram]', [
    'sanitize_callback' => 'esc_url_raw'
  ]);

  $wp_customize->add_control('vikinger_footer_control_social_links_instagram', [
    'label'     => esc_html_x('Social - Instagram Link', '(Customizer) Footer Option - Instagram Link - Title', 'vikinger'),
    'type'      => 'text',
    'section'   => 'vikinger_footer',
    'settings'  => 'vikinger_footer_setting_social_links[instagram]'
  ]);

  /**
   * Promo Youtube Link
   */
  $wp_customize->add_setting('vikinger_footer_setting_social_links[youtube]', [
    'sanitize_callback' => 'esc_url_raw'
  ]);

  $wp_customize->add_control('vikinger_footer_control_social_links_youtube', [
    'label'     => esc_html_x('Social - Youtube Link', '(Customizer) Footer Option - Youtube Link - Title', 'vikinger'),
    'type'      => 'text',
    'section'   => 'vikinger_footer',
    'settings'  => 'vikinger_footer_setting_social_links[youtube]'
  ]);

  /**
   * Promo Twitch Link
   */
  $wp_customize->add_setting('vikinger_footer_setting_social_links[twitch]', [
    'sanitize_callback' => 'esc_url_raw'
  ]);

  $wp_customize->add_control('vikinger_footer_control_social_links_twitch', [
    'label'     => esc_html_x('Social - Twitch Link', '(Customizer) Footer Option - Twitch Link - Title', 'vikinger'),
    'type'      => 'text',
    'section'   => 'vikinger_footer',
    'settings'  => 'vikinger_footer_setting_social_links[twitch]'
  ]);

  /**
   * Bottom Left Text
   */
  $wp_customize->add_setting('vikinger_footer_setting_bottom_left_text', [
    'sanitize_callback' => 'vikinger_customizer_sanitize_text'
  ]);

  $wp_customize->add_control('vikinger_footer_control_bottom_left_text', [
    'label'     => esc_html_x('Bottom Left - Text', '(Customizer) Footer Option - Bottom Left Text - Title', 'vikinger'),
    'type'      => 'text',
    'section'   => 'vikinger_footer',
    'settings'  => 'vikinger_footer_setting_bottom_left_text'
  ]);

  /**
   * Bottom Right Text
   */
  $wp_customize->add_setting('vikinger_footer_setting_bottom_right_text', [
    'sanitize_callback' => 'vikinger_customizer_sanitize_text'
  ]);

  $wp_customize->add_control('vikinger_footer_control_bottom_right_text', [
    'label'     => esc_html_x('Bottom Right - Text','(Customizer) Footer Option - Bottom Right Text - Title', 'vikinger'),
    'type'      => 'text',
    'section'   => 'vikinger_footer',
    'settings'  => 'vikinger_footer_setting_bottom_right_text'
  ]);
}

add_action('customize_register', 'vikinger_customizer_footer');
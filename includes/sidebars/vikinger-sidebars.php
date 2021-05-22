<?php
/**
 * Vikinger Sidebars
 * 
 * @since 1.0.0
 */

/**
 * Register sidebars
 */
function vikinger_register_sidebars() {
  register_sidebar(
    array(
      'id'            => 'blog',
      'name'          => esc_html_x( '(Vikinger) Blog Post Sidebar', '(Backend) Blog Post Sidebar - Title', 'vikinger' ),
      'description'   => esc_html_x('A sidebar for blog posts', '(Backend) Blog Post Sidebar - Description', 'vikinger'),
      'before_widget' => '<div id="%1$s" class="widget-box %2$s">',
      'after_widget'  => '</div>',
      'before_title'  => '<p class="widget-box-title">',
      'after_title'   => '</p>',
    )
  );

  register_sidebar(
    array(
      'id'            => 'blog_bottom',
      'name'          => esc_html_x( '(Vikinger) Blog Post Bottom Sidebar', '(Backend) Blog Post Bottom Sidebar - Title', 'vikinger' ),
      'description'   => esc_html_x('A bottom sidebar for blog posts', '(Backend) Blog Post Bottom Sidebar - Description', 'vikinger'),
      'before_widget' => '<div id="%1$s" class="widget-box %2$s">',
      'after_widget'  => '</div>',
      'before_title'  => '<p class="widget-box-title">',
      'after_title'   => '</p>',
    )
  );
}

add_action('widgets_init', 'vikinger_register_sidebars');

?>
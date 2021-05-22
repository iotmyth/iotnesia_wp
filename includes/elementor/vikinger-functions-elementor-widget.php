<?php
/**
 * Vikinger Elementor - Widget functions
 * 
 * @since 1.0.0
 */

/**
 * Register custom elementor widgets
 */
function vikinger_elementor_widgets_register() {
  /**
   * Login and Register Widget
   */
  class Vikinger_Login_Register_Widget extends \Elementor\Widget_Base {

    public function get_name() {
      return 'vk-login-register';
    }

    public function get_title() {
      return esc_html_x('Login and Register', '(Elementor) Login and Register Widget - Title', 'vikinger');
    }

    public function get_icon() {
      return 'fa fa-power-off';
    }

    public function get_categories() {
      return ['vikinger'];
    }

    public function render() {
      $vikinger_settings = vikinger_settings_get();

      $form_type = $vikinger_settings['users_can_register'] ? 'login-register' : 'login';

      if (!is_user_logged_in()) {
        /**
         * Login Register Form
         */
        get_template_part('template-part/login/login-register-form', null, [
          'type'  => $form_type
        ]);
      } else {
        /**
         * Member Preview Big
         */
        get_template_part('template-part/member/member-preview', 'big', [
          'user'  => vikinger_get_logged_user_member_data('user-preview')
        ]);
      }
    }

  }

  $vk_login_widget = new Vikinger_Login_Register_Widget();

	// Let Elementor know about our widget
	Elementor\Plugin::instance()->widgets_manager->register_widget_type( $vk_login_widget );
}

add_action('elementor/widgets/widgets_registered', 'vikinger_elementor_widgets_register');

/**
 * Create new elementor categories
 */
function vikinger_elementor_widget_categories_register($elements_manager) {
	$elements_manager->add_category(
		'vikinger',
		[
			'title' => esc_html_x('Vikinger', '(Elementor) Vikinger Category - Title', 'vikinger'),
			'icon'  => 'fa fa-plug',
		]
	);
}

add_action('elementor/elements/categories_registered', 'vikinger_elementor_widget_categories_register');

?>
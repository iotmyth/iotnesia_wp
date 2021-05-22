<?php
/**
 * Vikinger Template Part - Login and Register Form
 * 
 * @package Vikinger
 * @since 1.0.0
 * @author Odin Design Themes (https://odindesignthemes.com/)
 * 
 * @param array $args {
 *   @type string $type         Form type, determines if it should include login form or register form or both.
 *                              Default 'login-register'. Accepts 'login', 'register' and 'login-register'.
 *   @type string $id           ID to give the form container.
 * }
 */

  $form_type  = isset($args['type']) ? $args['type'] : 'login-register';
  $form_id    = isset($args['id']) ? $args['id'] : false;

  $form_box_classes         = $form_type === 'login-register' ? 'tab-container no-padding' : '';
  $form_box_content_classes = $form_type === 'login-register' ? 'tab-item' : '';

?>

<!-- FORM BOX -->
<div class="form-box <?php echo esc_attr($form_box_classes); ?>">
<?php if ($form_type === 'login-register') : ?>
  <!-- FORM BOX TABS -->
  <div class="form-box-tabs">
    <!-- FORM BOX TAB -->
    <p class="form-box-tab tab-option"><?php esc_html_e('Login', 'vikinger'); ?></p>
    <!-- /FORM BOX TAB -->

    <!-- FORM BOX TAB -->
    <p class="form-box-tab tab-option"><?php esc_html_e('Register', 'vikinger'); ?></p>
    <!-- /FORM BOX TAB -->
  </div>
  <!-- /FORM BOX TABS -->
<?php endif; ?>
  <!-- FORM BOX TAB ITEMS -->
  <div class="form-box-tab-items">
  <?php if (($form_type === 'login-register') || ($form_type === 'login')) : ?>
    <!-- FORM BOX CONTENT -->
    <div class="form-box-content <?php echo esc_attr($form_box_content_classes); ?>">
      <h2 class="form-box-title"><?php esc_html_e('Account Login', 'vikinger'); ?></h2>

      <!-- FORM -->
      <form class="form vk-login-form">
        <!-- FORM ROW -->
        <div class="form-row">
          <!-- FORM ITEM -->
          <div class="form-item">
            <!-- FORM INPUT -->
            <div class="form-input">
              <label for="login_username"><?php esc_html_e('Username or Email', 'vikinger'); ?></label>
              <input type="text" id="login_username" name="login_username">
            </div>
            <!-- /FORM INPUT -->
          </div>
          <!-- /FORM ITEM -->
        </div>
        <!-- /FORM ROW -->

        <!-- FORM ROW -->
        <div class="form-row">
          <!-- FORM ITEM -->
          <div class="form-item">
            <!-- FORM INPUT -->
            <div class="form-input">
              <label for="login_password"><?php esc_html_e('Password', 'vikinger'); ?></label>
              <input type="password" id="login_password" name="login_password">
            </div>
            <!-- /FORM INPUT -->
          </div>
          <!-- /FORM ITEM -->
        </div>
        <!-- /FORM ROW -->

        <!-- FORM ROW -->
        <div class="form-row">
          <!-- FORM ITEM -->
          <div class="form-item">
            <!-- CHECKBOX WRAP -->
            <div class="checkbox-wrap">
              <input type="checkbox" id="login_remember" name="login_remember" checked>

              <!-- CHECKBOX BOX -->
              <div class="checkbox-box">
              <?php

                /**
                 * Icon SVG
                 */
                get_template_part('template-part/icon/icon', 'svg', [
                  'icon'  => 'cross'
                ]);

              ?>
              </div>
              <!-- /CHECKBOX BOX -->
              <label for="login_remember"><?php esc_html_e('Remember Me', 'vikinger'); ?></label>
            </div>
            <!-- /CHECKBOX WRAP -->
          </div>
          <!-- /FORM ITEM -->
        </div>
        <!-- /FORM ROW -->

        <!-- FORM ROW -->
        <div class="form-row">
          <!-- FORM ITEM -->
          <div class="form-item">
            <!-- BUTTON -->
            <button class="form-submit-button button medium secondary" name="login_submit">
              <span class="form-submit-text"><?php esc_html_e('Login to your Account', 'vikinger'); ?></span>
              <span class="form-submitting-text"><?php esc_html_e('Authenticating...', 'vikinger'); ?></span>
            <?php

              /**
               * Loader Spinner
               */
              get_template_part('template-part/loader/loader', 'spinner', [
                'modifiers' => 'small'
              ]);

            ?>
            </button>
            <!-- /BUTTON -->
          </div>
          <!-- /FORM ITEM -->
        </div>
        <!-- /FORM ROW -->
      </form>
      <!-- /FORM -->
    </div>
    <!-- /FORM BOX CONTENT -->
  <?php endif; ?>

  <?php if (($form_type === 'login-register') || ($form_type === 'register')) : ?>
    <!-- FORM BOX CONTENT -->
    <div class="form-box-content <?php echo esc_attr($form_box_content_classes); ?>">
      <h2 class="form-box-title"><?php esc_html_e('Create Your Account', 'vikinger'); ?></h2>

      <!-- FORM -->
      <form class="form vk-register-form">
        <!-- FORM ROW -->
        <div class="form-row">
          <!-- FORM ITEM -->
          <div class="form-item">
            <!-- FORM INPUT -->
            <div class="form-input">
              <label for="register_email"><?php esc_html_e('Your Email', 'vikinger'); ?></label>
              <input type="text" id="register_email" name="register_email">
            </div>
            <!-- /FORM INPUT -->
          </div>
          <!-- /FORM ITEM -->
        </div>
        <!-- /FORM ROW -->

        <!-- FORM ROW -->
        <div class="form-row">
          <!-- FORM ITEM -->
          <div class="form-item">
            <!-- FORM INPUT -->
            <div class="form-input">
              <label for="register_username"><?php esc_html_e('Username', 'vikinger'); ?></label>
              <input type="text" id="register_username" name="register_username">
            </div>
            <!-- /FORM INPUT -->
          </div>
          <!-- /FORM ITEM -->
        </div>
        <!-- /FORM ROW -->

        <!-- FORM ROW -->
        <div class="form-row">
          <!-- FORM ITEM -->
          <div class="form-item">
            <!-- FORM INPUT -->
            <div class="form-input">
              <label for="register_password"><?php esc_html_e('Password', 'vikinger'); ?></label>
              <input type="password" id="register_password" name="register_password">
            </div>
            <!-- /FORM INPUT -->
          </div>
          <!-- /FORM ITEM -->
        </div>
        <!-- /FORM ROW -->

        <!-- FORM ROW -->
        <div class="form-row">
          <!-- FORM ITEM -->
          <div class="form-item">
            <!-- FORM INPUT -->
            <div class="form-input">
              <label for="register_password_repeat"><?php esc_html_e('Repeat Password', 'vikinger'); ?></label>
              <input type="password" id="register_password_repeat" name="register_password_repeat">
            </div>
            <!-- /FORM INPUT -->
          </div>
          <!-- /FORM ITEM -->
        </div>
        <!-- /FORM ROW -->

        <!-- FORM ROW -->
        <div class="form-row">
          <!-- FORM ITEM -->
          <div class="form-item">
            <!-- BUTTON -->
            <button class="form-submit-button button medium primary" name="register_submit">
              <span class="form-submit-text"><?php esc_html_e('Register Now!', 'vikinger'); ?></span>
              <span class="form-submitting-text"><?php esc_html_e('Registering...', 'vikinger'); ?></span>
              <span class="form-submitted-text"><?php esc_html_e('Registration Complete!', 'vikinger'); ?></span>
            <?php

              /**
               * Loader Spinner
               */
              get_template_part('template-part/loader/loader', 'spinner', [
                'modifiers' => 'small'
              ]);

            ?>
            </button>
            <!-- /BUTTON -->
          </div>
          <!-- /FORM ITEM -->
        </div>
        <!-- /FORM ROW -->
      </form>
      <!-- /FORM -->
    </div>
    <!-- /FORM BOX CONTENT -->
  <?php endif; ?>
  </div>
  <!-- FORM BOX TAB ITEMS -->
</div>
<!-- /FORM BOX -->
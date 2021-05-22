<?php
/**
 * Vikinger Elementor - Utils functions
 * 
 * @since 1.0.0
 */

/**
 * Checks if the current page is an elementor page
 * 
 * @return bool $elementor_page      True if elementor page, false otherwise.
 */
function vikinger_is_elementor_page(){
  global $post;

  return \Elementor\Plugin::$instance->db->is_built_with_elementor($post->ID);
}

?>
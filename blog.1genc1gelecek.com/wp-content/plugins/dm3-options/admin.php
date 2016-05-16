<?php
/**
 * Initialize admin panel
 *
 * @package Dm3Options
 * @since Dm3Options 1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {exit();}

add_action('admin_init', 'dm3_admin_init');
add_action('admin_menu', 'dm3_add_theme_menu');

/**
 * Wordpress uploader
 */
function dm3_uploader_enqueue() {
  wp_enqueue_media();
  wp_enqueue_script('dm3-select-media', DM3_FRAMEWORK_URL . '/js/dm3-select-media.js', array('media'), '', true);
}

/**
 * Admin menu
 */
function dm3_add_theme_menu() {
  // Hook menu
  add_theme_page(
    __('Theme Options', 'dm3-options'),
    __('Theme Options', 'dm3-options'),
    'edit_themes',
    'dm3_theme_options_default',
    'dm3_theme_options_default'
  );
}

/**
 * Admin javascripts and stylesheets
 */
function dm3_admin_init() {
  if ( isset( $_GET['page'] ) && ( isset($_GET['page'] ) && $_GET['page'] == 'dm3_theme_options_default' ) ) {
    dm3_uploader_enqueue();
  }
  
  wp_enqueue_style('color-picker', DM3_FRAMEWORK_URL . '/css/colorpicker.css');
  wp_enqueue_style('dm3-functions', DM3_FRAMEWORK_URL . '/css/functions.css');
  
  wp_enqueue_script('color-picker', DM3_FRAMEWORK_URL . '/js/colorpicker.js', array('jquery'), '', true);
  wp_enqueue_script('dm3-functions', DM3_FRAMEWORK_URL . '/js/functions.js', array('jquery'), '', true);
  
  add_action('admin_head', 'dm3_wp_head', 9999);
}

/**
 * Setup framework constants for javascripts
 */
function dm3_wp_head() {
  ?>
  <script>
  dm3Framework = {
    themeUrl: "<?php echo get_template_directory_uri(); ?>",
    frameworkUrl: "<?php echo DM3_FRAMEWORK_URL; ?>"
  };
  </script>
  <?php
}

/**
 * Default options page
 */
function dm3_theme_options_default() {
  if ( ! current_user_can( 'edit_themes' ) ) {
    return;
  }

  $options_file = get_template_directory() . '/dm3-options/options.php';

  if ( file_exists( $options_file ) ) {
    include $options_file;
    include DM3_FRAMEWORK_DIR . '/options-view.php';
  }
}

/**
 * Code below is processed after theme activation
 */
if (is_admin() && isset($_GET['activated']) && $pagenow == 'themes.php') {
  // Redirect to theme's options panel
  wp_redirect(admin_url('themes.php?page=dm3_theme_options_default'));
}
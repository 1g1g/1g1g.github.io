<?php
/**
 * Plugin Name: Dm3Options
 * Author: Dmytro Danylov
 * Description: Theme options panel
 * Version: 1.0
 *
 * @package Dm3Options
 */
if ( ! defined( 'ABSPATH' ) ) {exit();}

define( 'DM3_FRAMEWORK_DIR', plugin_dir_path( __FILE__ ) );
define( 'DM3_FRAMEWORK_URL', plugins_url( '', __FILE__ ) );

function dm3options_init() {
  if ( is_admin() ) {
    // Allow translations
    load_plugin_textdomain( 'dm3-options', false, 'dm3-options/languages' );

    // Includes
    require_once DM3_FRAMEWORK_DIR . '/admin.php';
    require_once DM3_FRAMEWORK_DIR . '/dm3-custom-fields.php';
  }
}

add_action( 'init', 'dm3options_init' );

if ( ! function_exists( 'dm3_option' ) ) {
  /**
   * Get theme option
   *
   * @param $key Option key
   * @param $default Return value if option doesn't exist
   *
   * @return mixed
   */
  function dm3_option( $key = null , $default = null ) {
    static $opt = null;

    if ( $opt === null ) {
      $opt = get_option( 'dm3_fwk', array() );
    }

    if ( ! $key ) {
      return $opt;
    }

    $value = null;

    if ( isset( $opt[$key] ) ) {
      $value = $opt[$key];
    } else {
      $value = $default;
    }

    return apply_filters( 'dm3_option_filter', $value, $key );
  }
}
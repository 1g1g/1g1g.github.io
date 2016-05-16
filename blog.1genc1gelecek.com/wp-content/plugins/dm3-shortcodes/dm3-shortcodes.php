<?php
/**
 * Plugin Name: Dm3Shortcodes
 * Author: Dmytro Danylov
 * Description: Adds shortcodes generator to rich editor mode
 * Version: 1.0
 * 
 * @package Dm3Shortcodes
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

define( 'DM3SC_URL', plugins_url( '/', __FILE__ ) );
define( 'DM3SC_PATH', plugin_dir_path( __FILE__ ) );

/**
 * Initialize
 */
function dm3sc_init() {
  // Allow translations
  load_plugin_textdomain( 'dm3-shortcodes', false, 'dm3-shortcodes/languages' );

  if ( is_admin() ) {
    if ( ( current_user_can( 'edit_posts' ) || current_user_can( 'edit_pages' ) ) && get_user_option( 'rich_editing' ) ) {
      add_filter( 'mce_external_plugins', 'dm3sc_mce_plugins' );
      add_filter( 'mce_buttons', 'dm3sc_mce_buttons' );
    }
  }

  require_once( DM3SC_PATH . 'front-end/shortcodes.php' );
}

/**
 * Get taxonomies (ajax)
 */
function dm3sc_get_taxonomies() {
  $post_type = isset( $_POST['post_type'] ) ? $_POST['post_type'] : '';

  if ( $post_type ) {
    $post_type_object = get_post_type_object( $post_type );

    if ( $post_type_object ) {
      if ( is_array( $post_type_object->taxonomies ) && count( $post_type_object->taxonomies ) ) {
        $categories = get_terms(
          $post_type_object->taxonomies,
          'objects'
        );
      } else {
        $categories = get_categories(
          array(
            'type' => $post_type
          )
        );
      }

      if ( $categories ) {
        $response_categories = array();

        foreach( $categories as $cat ) {
          $response_categories[] = array(
            'label' => $cat->name,
            'value' => $cat->term_id
          );
        }

        echo json_encode( $response_categories );

        exit();
      }
    }
  }

  echo '';
  exit();
}

/**
 * Enqueue scripts - front end
 */
function dm3sc_enqueue_scripts() {
  wp_enqueue_style( 'font-awesome', DM3SC_URL . 'front-end/font-awesome.css' );
  wp_enqueue_style( 'dm3-shortcodes-front', DM3SC_URL . 'front-end/shortcodes.css' );
  wp_enqueue_script( 'dm3-shortcodes-front', DM3SC_URL . 'front-end/shortcodes.js', array( 'jquery' ) );
}

/**
 * Enqueue scripts - admin panel
 */
function dm3sc_admin_enqueue_scripts() {
  if ( ( current_user_can( 'edit_posts' ) || current_user_can( 'edit_pages' ) ) && get_user_option( 'rich_editing' ) ) {
    wp_enqueue_style( 'dm3-content-box', DM3SC_URL . 'css/dm3-content-box.css' );
    wp_enqueue_style( 'dm3-shortcodes', DM3SC_URL . 'css/dm3-shortcodes.css' );
    wp_enqueue_style( 'font-awesome', DM3SC_URL . 'front-end/font-awesome.css' );
    wp_enqueue_script( 'dm3-appendo', DM3SC_URL . 'js/dm3-appendo.js', array( 'jquery' ) );
    wp_enqueue_script( 'dm3-content-box', DM3SC_URL . 'js/dm3-content-box.js', array( 'jquery' ) );
    wp_enqueue_script( 'dm3-js-form', DM3SC_URL . 'js/dm3-js-form.js', array( 'jquery' ) );
    wp_localize_script( 'jquery', 'dm3scTr',
      array(
        'pluginUrl' => DM3SC_URL,
        'labelInsertButton' => __( 'Insert', 'dm3-shortcodes' )
      )
    );
    require_once( DM3SC_PATH . 'front-end/config.php' );
    // Apply filters, so other plugins and themes can add shortcodes to the menu
    $shortcodes = apply_filters( 'dm3_shortcodes', $shortcodes );
    wp_localize_script( 'jquery', 'dm3sc', $shortcodes );
  }
}

/**
 * TinyMCE plugins
 */
function dm3sc_mce_plugins( $plugins ) {
  $plugins['dm3Shortcodes'] = DM3SC_URL . 'js/dm3-shortcodes.js';
  return $plugins;
}

/**
 * TinyMCE buttons
 */
function dm3sc_mce_buttons( $buttons ) {
  array_push( $buttons, 'separator', 'dm3Shortcodes' );
  return $buttons;
}

add_action( 'init', 'dm3sc_init' );
add_action( 'wp_enqueue_scripts', 'dm3sc_enqueue_scripts' );
add_action( 'admin_enqueue_scripts', 'dm3sc_admin_enqueue_scripts' );
add_action( 'wp_ajax_dm3sc_get_taxonomies', 'dm3sc_get_taxonomies' );
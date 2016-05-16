<?php
/**
 * Plugin Name: Dm3Sidebars
 * Author: Dmytro Danylov
 * Description: Adds ability to add custom sidebars (your theme has to support it)
 * Version: 1.0
 *
 * @package Dm3Sidebars
 */

if ( is_admin() ) {
  /**
   * Add admin menu option
   */
  function dm3sb_add_theme_menu() {
    // Hook menu
    add_theme_page(
      __( 'Custom Sidebars', 'dm3-sidebars' ),
      __( 'Custom Sidebars', 'dm3-sidebars' ),
      'edit_themes',
      'dm3sb_options_page',
      'dm3sb_options_page'
    );
  }

  add_action( 'admin_menu', 'dm3sb_add_theme_menu' );

  /**
   * Render admin options page
   */
  function dm3sb_options_page() {
    if ( ! current_user_can( 'edit_themes' ) ) {
      return;
    }

    $post_types = dm3sb_get_post_types();
    $sidebars = get_option( 'dm3sb_sidebars', array() );

    require_once 'options-view.php';
  }

  /**
   * Process ajax calls
   */
  function dm3sb_ajax() {
    $action = isset( $_POST['action'] ) ? $_POST['action'] : '';
    $name = isset( $_POST['name'] ) ? trim( $_POST['name'] ) : '';
    $response = array(
      'status' => 'error'
    );

    if ( ! preg_match( '/^[a-zA-Z0-9\s]+$/i', $name ) ) {
      $name = '';
    }

    if ( $name ) {
      // Get custom sidebars
      $sidebars = get_option( 'dm3sb_sidebars', array() );

      switch( $action ) {
        // Add sidebar
        case 'dm3sb_add_sidebar':
          if ( ! in_array( $name, $sidebars ) ) {
            // Sidebar does not exist
            $sidebars[] = $name;

            if ( update_option( 'dm3sb_sidebars', $sidebars ) ) {
              $response['status'] = 'success';
            }
          } else {
            $response['message'] = __( 'Sidebar already exists', 'dm3-sidebars' );
          }
          break;

        // Delete sidebar
        case 'dm3sb_delete_sidebar':
          $array_key = array_search( $name, $sidebars );

          if ( $array_key !== false ) {
            // Delete sidebar
            unset( $sidebars[$array_key] );

            if ( update_option( 'dm3sb_sidebars', $sidebars ) ) {
              $response['status'] = 'success';
            }
          }
          break;
      }
    } else {
      $response['message'] = __( 'Sidebar name contains invalid characters', 'dm3-sidebars' );
    }

    echo json_encode($response);
    exit();
  }

  /**
   * Get supported post types
   */
  function dm3sb_get_post_types() {
    return apply_filters( 'dm3sb_post_types', array( 'post', 'page' ) );
  }

  /**
   * Add meta box
   */
  function dm3sb_add_meta_box() {
    $post_types = dm3sb_get_post_types();

    foreach ( $post_types as $post_type ) {
      add_meta_box(
        'dm3sb_meta_box',
        __('Custom sidebar', 'dm3-options'),
        'dm3sb_show_meta_box',
        $post_type,
        'normal',
        'high'
      );
    }
  }

  /**
   * Show meta box
   */
  function dm3sb_show_meta_box() {
    global $post;

    // Get custom sidebars
    $sidebars = get_option( 'dm3sb_sidebars', array() );

    // Get current sidebar
    $current_sidebar = get_post_meta( $post->ID, 'dm3sb_custom_sidebar', true );

    // Show form
    require_once 'meta-box-view.php';
  }

  /**
   * Save meta box options
   */
  function dm3sb_save_meta_box( $post_id ) {
    // Check nonce
    if ( ! isset( $_POST['dm3sb_meta_box_nonce'] ) ) {
      return $post_id;
    }

    $nonce = $_POST['dm3sb_meta_box_nonce'];

    if ( ! wp_verify_nonce( $nonce, 'dm3sb_meta_box' ) ) {
      return $post_id;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
      return $post_id;
    }

    // Check user permissions
    if ( 'page' == $_POST['post_type'] ) {
      if ( ! current_user_can( 'edit_page', $post_id ) ) {
        return $post_id;
      }
    } else {
      if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
      }
    }

    // Sanitize user input
    $custom_sidebar = sanitize_text_field( $_POST['dm3sb_custom_sidebar'] );

    // Update the meta field in the database
    update_post_meta( $post_id, 'dm3sb_custom_sidebar', $custom_sidebar );
  }

  add_action( 'add_meta_boxes', 'dm3sb_add_meta_box' );
  add_action( 'save_post', 'dm3sb_save_meta_box' );
  add_action( 'wp_ajax_dm3sb_add_sidebar', 'dm3sb_ajax' );
  add_action( 'wp_ajax_dm3sb_delete_sidebar', 'dm3sb_ajax' );
}

/**
 * Register sidebars
 */
function dm3sb_register_sidebars() {
  $sidebars = get_option( 'dm3sb_sidebars', array() );

  foreach ( $sidebars as $sidebar ) {
    $args = apply_filters( 'dm3sb_sidebar_args', array(
      'name' => $sidebar,
      'description' => __( 'Dm3Sidebars plugin custom sidebar', 'dm3-sidebars' ),
      'before_widget' => '<div class="widget">',
      'after_widget' => '</div>',
      'before_title' => '<h3 class="widget-title">',
      'after_title' => '</h3>'
    ) );

    register_sidebar( $args );
  }
}

add_action( 'widgets_init', 'dm3sb_register_sidebars', 100 );

/**
 * Show dynamic sidebar for the post
 */
function dm3sb_dynamic_sidebar( $default_sidebar ) {
  global $post;

  if ( $post ) {
    $custom_sidebar = get_post_meta( $post->ID, 'dm3sb_custom_sidebar', true );

    if ( $custom_sidebar ) {
      dynamic_sidebar( $custom_sidebar );
      return false;
    }
  }

  dynamic_sidebar( $default_sidebar );
}
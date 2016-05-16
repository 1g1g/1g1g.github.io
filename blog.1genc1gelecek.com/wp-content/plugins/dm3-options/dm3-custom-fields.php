<?php
/**
 * Custom fields for posts
 * Custom field data structure:
 * array(
 *   'name' => "Field short name",
 *   'title' => 'Field name to show to user',
 *   'description' => 'Field description',
 *   'scope' => array('post', 'page', 'post_type3', ...) // What post types will allow this field?
 *   'capability' => 'user\'s capability required to see the option',
 *   'type' => 'Field type', // e.g. textarea, text, upload, select
 *   'options' => array('key' => 'value') // Only if "select" type is chosen
 *   'templates' => array()
 * )
 *
 * @package Dm3Options
 * @since Dm3Options 1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {exit();}

require_once DM3_FRAMEWORK_DIR . '/dm3-admin-form.php';

class Dm3CustomFields {
  public $postTypes;
  public $customFields;
  
  /**
   * Constructor
   */
  function __construct() {
    $fields_file = get_template_directory() . '/dm3-options/custom-fields.php';
    
    if ( file_exists( $fields_file ) ) {
      include_once $fields_file;
      add_action( 'add_meta_boxes', array( $this, 'createCustomFields' ) );
      add_action( 'save_post', array( $this, 'saveCustomFields' ), 1, 2 );
    }
  }
  
  /**
   * Setup custom fields dialog
   */
  function createCustomFields() {
    foreach ( $this->postTypes as $postType ) {
      add_meta_box(
        'dm3-fwk-custom-fields',
        __( 'Theme Options', 'dm3-options' ),
        array( $this, 'showCustomFields' ),
        $postType,
        'normal',
        'high'
      );
    }
  }

  /**
   * Output custom fields HTML code
   */
  function showCustomFields() {
    global $post;
    $num_fields = 0;
    
    wp_nonce_field('dm3-fwk-custom-fields', 'dm3_fwk-custom-fields-wpnonce', false, true);
    
    echo '<div id="dm3-fwk-custom-fields">';
    
    foreach ( $this->customFields as $field ) {
      $tpl = isset( $post->page_template ) ? $post->page_template : 'default';
      
      // Check if to output the field to post with current template
      if ( isset( $field['templates'] ) && ! in_array( $tpl, $field['templates'] ) ) {
        continue;
      }
            
      // Check if to output field to the current post type
      if ( ! in_array( $post->post_type, $field['scope'] ) ) {
        continue;
      }
      
      // Check access
      if ( ! current_user_can( $field['capability'], $post->ID ) ) {
        continue;
      }
      
      $value = htmlspecialchars( get_post_meta( $post->ID, $field['name'], true ) );
      
      if ( $value === '' && isset( $field['value'] ) && ! in_array( $field['type'], array( 'checkbox' ) ) ) {
        $value = $field['value'];
      }

      $field_method = 'field' . ucfirst( $field['type'] );

      if ( method_exists( 'Dm3AdminForm', $field_method ) ) {
        $field['id'] = $field['name'];
        echo call_user_func( array( 'Dm3AdminForm', $field_method ), $field['name'], $value, $field );
      }
      
      $num_fields++;
    }
    
    echo '</div>';
    
    if ( ! $num_fields ) {
      echo '<script>jQuery("#dm3-fwk-custom-fields").hide();</script>';
    }
  }
  
  /**
   * Save custom fields to database
   */
  function saveCustomFields( $postID, $post ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
      return;
    }
      
    // Check nonce
    if ( ! isset( $_POST['dm3_fwk-custom-fields-wpnonce'] ) || ! wp_verify_nonce( $_POST['dm3_fwk-custom-fields-wpnonce'], 'dm3-fwk-custom-fields' ) ) {
      return;
    }
    
    // Check access
    if ( ! current_user_can( 'edit_post', $postID ) ) {
      return;
    }
      
    // Check if current post belongs to defined post types
    if ( ! in_array( $post->post_type, $this->postTypes ) ) {
      return;
    }

    foreach ( $this->customFields as $field ) {
      // Check access
      if ( ! current_user_can( $field['capability'], $postID ) ) {
        continue;
      }
      
      if ( ! isset( $_POST[$field['name']] ) || trim( $_POST[$field['name']] ) == '' ) {
        // Delete post field if user did not specify its value
        delete_post_meta( $postID, $field['name'] );
      } else {
        update_post_meta( $postID, $field['name'], strip_tags( $_POST[$field['name']] ) );
      }
    }
  }
}

$dm3_custom_fields = new Dm3CustomFields();
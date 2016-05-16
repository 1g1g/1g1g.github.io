<?php
/**
 * Post's custom fields
 */

if ( ! defined( 'TEMPLATEPATH' ) ) {exit();}


$this->postTypes = array( 'post', 'page', 'gallery' );
$this->customFields = array(
  array(
    'name' => 'dm3_fwk_slideshow',
    'label' => __( 'Slideshow', 'dm3_fwk' ),
    'scope' => array( 'page', 'post', 'gallery' ),
    'capability' => 'manage_options',
    'type' => 'select',
    'options' => array(
      'none' => __( 'None', 'dm3_fwk' ),
      'slider-1' => __( 'Slider 1 (at least 1 slide)', 'dm3_fwk' ),
      'slider-2' => __( 'Slider 2 (at least 2 slides)', 'dm3_fwk' )
    )
  ),
  
  array(
    'name' => 'dm3_fwk_slideshow_interval',
    'label' => __( 'Slideshow autoscroll interval', 'dm3_fwk' ),
    'scope' => array( 'page', 'post', 'gallery' ),
    'capability' => 'manage_options',
    'type' => 'text',
    'value' => 0,
    'description' => __( 'Please enter a number in seconds', 'dm3_fwk' )
  ),
  
  array(
    'name' => 'dm3_fwk_page_subtitle',
    'label' => __( 'Page subtitle', 'dm3_fwk' ),
    'scope' => array( 'page', 'post' ),
    'capability' => 'manage_options',
    'type' => 'text'
  ),

  array(
    'name' => 'dm3_fwk_hide_page_title',
    'label' => __( 'Hide page title', 'dm3_fwk' ),
    'scope' => array( 'page' ),
    'capability' => 'manage_options',
    'type' => 'select',
    'options' => array(
      '0' => __( 'No', 'dm3_fwk' ),
      '1' => __( 'Yes', 'dm3_fwk' )
    )
  ),
  
  array(
    'name' => 'dm3_fwk_columns',
    'label' => __( 'Number of columns', 'dm3_fwk' ),
    'scope' => array( 'page' ),
    'templates' => array( 'gallery.php' ),
    'capability' => 'manage_options',
    'type' => 'select',
    'options' => array(
      '2' => __( 'Two', 'dm3_fwk' ),
      '3' => __( 'Three', 'dm3_fwk' ),
      '4' => __( 'Four', 'dm3_fwk' )
    )
  ),
  
  array(
    'name' => 'dm3_fwk_video',
    'label' => __( 'Featured Video URL', 'dm3_fwk' ),
    'scope' => array( 'gallery' ),
    'capability' => 'manage_options',
    'type' => 'text',
    'size' => 50,
    'description' => __( 'Youtube or Vimeo', 'dm3_fwk' )
  ),

  array(
    'name' => 'dm3_fwk_open_in_lightbox',
    'label' => __( 'Open featured image in lightbox', 'dm3_fwk' ),
    'scope' => array( 'gallery' ),
    'capability' => 'manage_options',
    'type' => 'select',
    'options' => array(
      '0' => __( 'No', 'dm3_fwk' ),
      '1' => __( 'Yes', 'dm3_fwk' )
    ),
    'description' => __( 'In the gallery page, open featured image in lightbox', 'dm3_fwk' )
  ),

  array(
    'name' => 'dm3_fwk_gallery_layout',
    'label' => __( 'Layout', 'dm3_fwk' ),
    'scope' => array( 'gallery' ),
    'capability' => 'manage_options',
    'type' => 'select',
    'options' => array(
      'gallery_top' => __( 'Gallery top aligned', 'dm3_fwk' ),
      'gallery_left' => __( 'Gallery left aligned', 'dm3_fwk' )
    )
  )
);
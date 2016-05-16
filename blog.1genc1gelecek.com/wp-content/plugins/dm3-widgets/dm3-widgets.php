<?php
/**
 * Plugin Name: Dm3Widgets
 * Author: Dmytro Danylov
 * Description: Adds custom widgets
 * Version: 1.0
 * 
 * @package Dm3Widgets
 */
if ( ! defined( 'ABSPATH' ) ) {exit;}

define( 'DM3WIDGETS_PATH', plugin_dir_path( __FILE__ ) );

// Include widgets
require_once 'widgets/flickr.php';
require_once 'widgets/posts.php';
require_once 'widgets/twitter.php';
require_once 'widgets/contacts.php';

/**
 * Register widgets ("widgets_init" hook)
 */
function dm3widgets_register() {
  register_widget( 'Dm3WidgetsFlickr' );
  register_widget( 'Dm3WidgetsPosts' );
  register_widget( 'Dm3WidgetsTwitter' );
  register_widget( 'Dm3WidgetsContacts' );
}

add_action( 'widgets_init', 'dm3widgets_register' );
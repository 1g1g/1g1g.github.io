<?php
/**
 * Plugin Name: Dm3Media
 * Author: Dmytro Danylov
 * Description: Adds ability to add various media (images, video, audio) to pages and posts
 * Version: 1.0
 * 
 * @package Dm3Media
 */
if ( ! defined( 'ABSPATH' ) ) {exit();}

define( 'DM3MEDIA_URL', plugins_url( '', __FILE__ ) );
define( 'DM3MEDIA_PATH', plugin_dir_path( __FILE__ ) );

class Dm3Media {
	/**
	 * Determine the type of the media, given url
   *
	 * @param string $src
   *
	 * @return string | null
	 */
	static function getMediaType( $src ) {
		if ( preg_match( '#^http(s)?://(www\.)?(youtube.com|youtu.be|vimeo.com){1}#i', $src ) ) {
			return 'video';
		}
		
		$parts = explode( '.', $src );
		$ext = $parts[ count( $parts ) - 1 ];
		
		switch ( $ext ) {
			case 'jpg':
			case 'jpeg':
			case 'png':
			case 'gif':
			case 'tiff':
				return 'image';
				break;
				
			case 'mp4':
            case 'm4v':
				return 'video';
				break;
			
			case 'mp3':	
			case 'ogg':
            case 'm4a':
				return 'audio';
				break;
			
			default:
				return null;
		}
	}
    
	
	/**
	 * Get the media items of a post
   * 
	 * @param int $postID
   * 
	 * @return array
	 */
	static function getPostMedia( $postID ) {
		$media = get_post_meta( $postID, 'dm3-media', true );
    
		if ( ! is_array($media ) ) {
			return array();
    }
    
		return $media;
	}
}

function dm3media_init() {
	if ( is_admin() ) {
		// Allow translations
  	load_plugin_textdomain( 'dm3-media', false, 'dm3-media/languages' );

		require_once DM3MEDIA_PATH . '/dm3-media-admin.php';
		$dm3_media_admin = new Dm3MediaAdmin();
	}
}

add_action( 'init', 'dm3media_init' );
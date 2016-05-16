<?php
/**
 * Dm3Media admin functionality
 *
 * @package Dm3Media
 * @since Dm3Media 1.0
 * @version 1.0
 */
if ( ! defined( 'ABSPATH' ) ) exit();

class Dm3MediaAdmin {
  /**
   * Array of post types which will include media module
   */
  protected $postTypes;
  
  /**
   * Setup the module
   */
  public function __construct() {
    global $pagenow;
    if ( in_array( $pagenow, array( 'post.php', 'post-new.php' ) ) ) {
      // Prepare metabox on post.php
      $this->postTypes = apply_filters( 'dm3media_post_types', array( 'post', 'page' ) );
      add_action( 'admin_enqueue_scripts', array( $this, 'enqueueResources' ) );
      add_action( 'admin_menu', array( $this, 'addMetaBox' ) );
      add_action( 'save_post', array( $this, 'saveMeta' ), 1, 2 );
    }
  }
  
  /**
   * Include js/css resources required by the media module
   */
  public function enqueueResources() {
    // scripts
    wp_enqueue_script( 'jquery-ui-core' );
    wp_enqueue_script( 'jquery-ui-sortable' );
    wp_enqueue_script( 'dm3-select-media', DM3MEDIA_URL . '/js/dm3-select-media.js', array( 'media' ), '1.0', true );
    wp_enqueue_script( 'dm3-media', DM3MEDIA_URL . '/js/dm3-media.js', array( 'jquery' ), '1.0', false );
    
    // styles
    wp_enqueue_style( 'dm3-media', DM3MEDIA_URL . '/css/dm3-media.css', false, '1.0', 'all' );

    wp_localize_script( 'dm3-media', 'dm3MediaVars',
      array(
        'pluginUrl' => DM3MEDIA_URL
      )
    );
  }

  /**
   * Sanitize html input
   *
   * @param $input
   *
   * @return string
   */
  public function filterInput( $input ) {
    if ( current_user_can( 'unfiltered_html' ) ) {
      return $input;
    }

    return strip_tags( $input );
  }
  
  /**
   * Save the media items in the meta of a post
   * 
   * @param int $postID
   * @param object $post
   */
  public function saveMeta( $postID, $post ) {
    // Check access
    if ( ! current_user_can( 'edit_post', $postID ) ) {
      return;
    }
    
    if ( isset( $_POST['dm3m_src'] ) && is_array( $_POST['dm3m_src'] ) && count( $_POST['dm3m_src'] ) > 0 && $_POST['dm3m_src'][0] != '' ) {
      $slides = array();
      
      foreach ( $_POST['dm3m_src'] as $k => $v ) {
        $attachment_id = intval( $_POST['dm3m_attachment_id'][$k] );
        
        $slides[] = array(
          'src' => strip_tags( $v ),
          'preview_image' => strip_tags( $_POST['dm3m_preview_image'][$k] ),
          'link' => strip_tags( $_POST['dm3m_link'][$k] ),
          'title' => $this->filterInput( $_POST['dm3m_title'][$k] ),
          'description' => $this->filterInput( $_POST['dm3m_description'][$k] ),
          'attachment_id' => intval( $attachment_id )
        );
      }
      
      update_post_meta( $postID, 'dm3-media', $slides );
    } else {
      delete_post_meta( $postID, 'dm3-media' );
    }
  }
  
  /**
   * The preview image of a media item
   * 
   * @param string $src
   * @param string $type
   * 
   * @return string
   */
  public function getSlidePreview( $src, $type = null ) {
    if ( ! $type ) {
      $type = Dm3Media::getMediaType( $src );
    }
    
    switch ( $type ) {
      case 'video': return DM3MEDIA_URL . '/images/video.jpg';
      case 'audio': return DM3MEDIA_URL . '/images/audio.jpg';
      case 'image': return $src;
      default: return DM3MEDIA_URL . '/images/image.jpg';
    }
  }
  
  /**
   * Output the media items
   * 
   * @param array $slides
   */
  public function showSlides( $slides ) {
    ?>
    <ul id="dm3m_slides">
    <?php if ( $slides ): ?>
      <?php
      foreach ( $slides as $slide ):
        $type = Dm3Media::getMediaType( $slide['src'] );
        if ( $type == 'image' ) {
          $preview_src = $slide['src'];
        } else {
          $preview_src = htmlspecialchars( $this->getSlidePreview( $slide['src'], $type ) );
        }
      ?>
      <li class="slide<?php if ( $type === 'video' ) echo ' slide-video'; ?>">
        <div class="dm3m_menu">
          <a class="dm3m-add" href="#">+</a>
          <a class="dm3m-delete" href="#">&times;</a>
        </div>
        
        <input type="hidden" name="dm3m_attachment_id[]" value="<?php echo intval( $slide['attachment_id'] ); ?>" />
        
        <div class="dm3m_image">
          <img src="<?php echo $preview_src; ?>" alt="" />
          <input type="hidden" name="dm3m_src[]" class="slide_src" value="<?php echo htmlspecialchars( $slide['src'] ); ?>" />
          <a class="button-secondary dm3m_upload" href="#" title="<?php _e('Select', 'dm3-media'); ?>" data-insertlabel="<?php _e( 'Insert', 'dm3-media' ); ?>"><?php echo __( 'Select', 'dm3-media' ); ?></a>
        </div>
        
        <div class="dm3m-preview-image">
          <label><?php _e( 'Preview image', 'dm3-media' ); ?></label>
          <input type="text" name="dm3m_preview_image[]" class="dm3-textinput" value="<?php echo htmlspecialchars( $slide['preview_image'] ); ?>" />
          <a class="button-secondary upload-image-button" href="#" title="<?php _e( 'Select', 'dm3-media' ); ?>" data-insertlabel="<?php _e( 'Insert', 'dm3-media' ); ?>"><?php echo __( 'Select', 'dm3-media' ); ?></a>
        </div>
        
        <label><?php _e( 'Link', 'dm3-media' ); ?></label>
        <input type="text" name="dm3m_link[]" class="dm3-textinput" value="<?php echo htmlspecialchars( $slide['link'] ); ?>" />
        
        <label><?php _e( 'Title', 'dm3-media' ); ?></label>
        <input type="text" name="dm3m_title[]" class="dm3-textinput" value="<?php echo htmlspecialchars( $slide['title'] ); ?>" />
        
        <label><?php _e( 'Description', 'dm3-media' ); ?></label>
        <textarea name="dm3m_description[]" cols="20" rows="2" class="dm3-textarea"><?php echo htmlspecialchars( $slide['description'] ); ?></textarea>
      </li>
      <?php endforeach; ?>
    <?php else: ?>
      <li class="slide">
        <div class="dm3m_menu">
          <a class="dm3m-add" href="#">+</a>
          <a class="dm3m-delete" href="#">&times;</a>
        </div>
        
        <input type="hidden" name="dm3m_attachment_id[]" value="0" />
        
        <div class="dm3m_image">
          <img src="<?php echo DM3MEDIA_URL; ?>/images/image.jpg" alt="" />
          <input type="hidden" name="dm3m_src[]" class="slide_src" />
          <a class="button-secondary dm3m_upload" href="#" title="<?php _e( 'Select', 'dm3-media' ); ?>" data-insertlabel="<?php _e( 'Insert', 'dm3-media' ); ?>"><?php echo __( 'Select', 'dm3-media' ); ?></a>
        </div>
        
        <div class="dm3m-preview-image">
          <label><?php _e( 'Preview image', 'dm3-media' ); ?></label>
          <input type="text" name="dm3m_preview_image[]" class="dm3-textinput" />
          <a class="button-secondary upload-image-button" href="#" title="<?php _e( 'Select', 'dm3-media' ); ?>" data-insertlabel="<?php _e( 'Insert', 'dm3-media' ); ?>"><?php echo __( 'Select', 'dm3-media' ); ?></a>
        </div>
        
        <label><?php _e( 'Link', 'dm3-media' ); ?></label>
        <input type="text" name="dm3m_link[]" class="dm3-textinput" />
        
        <label><?php _e( 'Title', 'dm3-media' ); ?></label>
        <input type="text" name="dm3m_title[]" class="dm3-textinput" />
        
        <label><?php _e( 'Description', 'dm3-media' ); ?></label>
        <textarea name="dm3m_description[]" cols="20" rows="2" class="dm3-textarea"></textarea>
      </li>
    <?php endif; ?>
    </ul>
    <?php
  }

  /**
   * Add the meta box to edit the media items in a post
   */
  public function addMetaBox() {
    foreach ( $this->postTypes as $post_type ) {
      add_meta_box(
        'dm3-post-media',
        __( 'Media', 'dm3-media' ),
        array( $this, 'showMetaBox' ),
        $post_type,
        'normal',
        'high'
      );
    }
  }
  
  /**
   * Show the media meta box
   */
  public function showMetaBox() {
    global $post;
    
    $slides = get_post_meta( $post->ID, 'dm3-media', true );
    ?>
    <form action="" id="dm3m_form" method="post">
      <?php $this->showSlides( $slides ); ?>
    </form>
    <?php
  }
}
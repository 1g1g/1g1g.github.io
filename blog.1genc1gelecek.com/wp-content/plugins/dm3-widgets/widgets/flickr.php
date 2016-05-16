<?php
/**
 * Flickr widget
 * 
 * @package Dm3Widgets
 * @since Dm3Widgets 1.0
 * @version 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {exit;}

class Dm3WidgetsFlickr extends WP_Widget {
  protected $_enable_cache = true;

  /**
   * Register widget with WordPress
   */
  function __construct() {
    parent::__construct(
      'Dm3WidgetsFlickr', // ID
      'Flickr (Dm3Widgets)', // Name
      array(
        'classname' => 'dm3-widgets-flickr-widget',
        'description' => __( 'Latest flickr photos', 'dm3-widgets' )
      )
    );
  }

  /**
   * Front-end display of widget.
   *
   * @see WP_Widget::widget()
   *
   * @param array $args Widget arguments.
   * @param array $instance Saved values from database.
   */
  public function widget( $args, $instance ) {
    extract( $args );
    $instance = wp_parse_args( $instance, array( 'title' => '', 'username' => '', 'amount' => 0 ) );
    $instance['title'] = apply_filters( 'widget_title', $instance['title'] );
    
    echo $before_widget;
    echo $before_title . $instance['title'] . $after_title;
    
    // Content
    $tr_key= 'Dm3WidgetsFlickr_' . $instance['username'] . '_' . $instance['amount'];
    
    if ( ! ( $items = get_transient( $tr_key, 300 ) ) || ! $this->_enable_cache ) {
      $ch = curl_init();
      curl_setopt( $ch, CURLOPT_URL, 'http://api.flickr.com/services/feeds/photos_public.gne?id=' . urlencode( $instance['username'] ) . '&format=php_serial' );
      curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
      curl_setopt( $ch, CURLOPT_HEADER, 0 );
      $items = curl_exec( $ch );
      curl_close( $ch );
      set_transient( $tr_key, $items );
    }
    
    $items = unserialize( $items );
    
    if ( isset( $items['items'] ) ) {
      $output = '<ul class="dm3-widgets-flickr">';
      $i = 1;
      foreach ( $items['items'] as $item ) {
        if ( $i > $instance['amount'] ) {
          break;
        }

        $output .= '<li><a href="' . htmlspecialchars( $item['url'] ) . '" target="_blank"><img src="' . htmlspecialchars( $item['t_url'] ) .
          '" width="75" height="75" alt="" /></a></li>';

        $i++;
      }
      $output .= '</ul>';
      echo $output;
    } else {
      echo '<p>' . __( 'No photos found', 'dm3-widgets' ) . '</p>';
    }
    
    echo $after_widget;
  }
 
  /**
   * Sanitize widget form values as they are saved.
   *
   * @see WP_Widget::update()
   *
   * @param array $new_instance Values just sent to be saved.
   * @param array $old_instance Previously saved values from database.
   *
   * @return array Updated safe values to be saved.
   */
  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['title'] = htmlspecialchars( $new_instance['title'] );
    $instance['username'] = htmlspecialchars( $new_instance['username'] );
    $instance['amount'] = intval( $new_instance['amount'] );

    // Delete transient
    delete_transient( 'Dm3WidgetsFlickr_' . $old_instance['username'] . '_' . $old_instance['amount'] );

    return $instance;
  }

  /**
   * Back-end widget form.
   *
   * @see WP_Widget::form()
   *
   * @param array $instance Previously saved values from database.
   */
  public function form( $instance ) {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'username' => '', 'amount' => 0, 'w' => 60, 'h' => 60 ) );
    $title = htmlspecialchars( $instance['title'] );
    $username = htmlspecialchars( $instance['username'] );
    $amount = intval( $instance['amount'] );
    ?>
    <p>
      <label><?php _e( 'Title', 'dm3-widgets' ); ?></label>
      <input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
    </p>
    
    <p>
      <label><?php _e( 'Flickr ID', 'dm3-widgets' ); ?> (<a target="_blank" href="http://idgettr.com/"><?php _e( 'Find Your Flickr ID', 'dm3-widgets' ); ?></a>)</label>
      <input type="text" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $username; ?>">
    </p>
    
    <p>
      <label><?php _e( 'Number of photos', 'dm3-widgets' ); ?></label>
      <select name="<?php echo $this->get_field_name( 'amount' ); ?>">
      <?php
      for ( $i = 1; $i < 21; $i++ ) {
        echo '<option value="' . $i;
        if ( $i == $amount ) {
          echo '" selected="selected';
        }
        echo '">' . $i . '</option>';
      }
      ?>
      </select>
    </p>
    <?php
  }
}
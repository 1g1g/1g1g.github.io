<?php
/**
 * Twitter widget
 * 
 * @package Dm3Widgets
 * @since Dm3Widgets 1.0
 * @version 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {exit;}

class Dm3WidgetsTwitter extends WP_Widget {
  protected $_enable_cache = true;

  /**
   * Register widget with WordPress
   */
  function __construct() {
    parent::__construct(
      'Dm3WidgetsTwitter', // ID
      'Twitter (Dm3Widgets)', // Name
      array(
        'classname' => 'dm3-widgets-twitter-widget',
        'description' => __( 'Latest tweets', 'dm3-widgets' )
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
    $instance = wp_parse_args( $instance,
      array(
        'title' => '',
        'username' => '',
        'amount' => 0,
        'consumer_key' => '',
        'consumer_secret' => '',
        'access_token' => '',
        'access_token_secret' => ''
      )
    );
    $instance['title'] = apply_filters( 'widget_title', $instance['title'] );
    extract( $args );
    
    echo $before_widget;
    echo $before_title , $instance['title'] , $after_title;
    
    $tr_key = 'Dm3WidgetsTwitter_' . $instance['username'] . '_' . $instance['amount'];
    
    if ( ! ( $output = get_transient( $tr_key ) ) || ! $this->_enable_cache ) {
      require_once DM3WIDGETS_PATH . 'tmhOauth.php';

      $tmhOauth = new tmhOauth(
        array(
          'consumer_key' => $instance['consumer_key'],
          'consumer_secret' => $instance['consumer_secret'],
          'token' => $instance['access_token'],
          'secret' => $instance['access_token_secret'],
          'user_agent' => 'tmhOAuth',
          'use_ssl' => false
        )
      );

      $code = $tmhOauth->request( 'GET', $tmhOauth->url( '1.1/statuses/user_timeline' ), array( 'screen_name' => $instance['username'], 'count' => intval( $instance['amount'] ) ) );

      if ( $code == 200 ) {
        $tweets = json_decode($tmhOauth->response['response']);
        $num_tweets = count( $tweets );

        if ( $num_tweets < $instance['amount'] ) {
          $instance['amount'] = $num_tweets;
        }
        
        $output = '';

        if ( $num_tweets > 0 ) {
          $output = '<ul class="dm3-widgets-twitter">';
          $text = '';
          $date = '';

          for ( $i = 0; $i < $instance['amount']; $i++ ) {
            $text = preg_replace( '/(@[^\s]+)/i', '<a href="http://twitter.com/$1" target="_blank">$1</a>', htmlspecialchars( $tweets[$i]->text ) );
            $date = date( "F d, Y H:i", strtotime( $tweets[$i]->created_at ) );
            $output .= '<li>';
            $output .= '<div class="text">' . $text . '</div>';
            $output .= '<div class="created-at">' . $date . '</div>';
            $output .= '</li>';
          }
          
          $output .= '</ul>';
        }

        set_transient( $tr_key, $output, 60 * 20 );
      }
    }
    
    if ( ! empty($output ) ) {
      echo $output;
    } else {
      echo '<p>' . __( 'No tweets found', 'dm3-widgets' ) . '</p>';
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
    $instance['consumer_key'] = htmlspecialchars( $new_instance['consumer_key'] );
    $instance['consumer_secret'] = htmlspecialchars( $new_instance['consumer_secret'] );
    $instance['access_token'] = htmlspecialchars( $new_instance['access_token'] );
    $instance['access_token_secret'] = htmlspecialchars( $new_instance['access_token_secret'] );

    // Delete transient
    delete_transient( 'Dm3WidgetsTwitter_' . $old_instance['username'] . '_' . $old_instance['amount'] );

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
    // Get widget options
    $instance = wp_parse_args( $instance,
      array(
        'title' => '',
        'username' => '',
        'amount' => 0,
        'consumer_key' => '',
        'consumer_secret' => '',
        'access_token' => '',
        'access_token_secret' => ''
      )
    );

    extract( $instance );
    ?>
    <p>
      <label><?php _e( 'Title', 'dm3-widgets' ); ?></label>
      <input type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $title; ?>" />
    </p>
    
    <p>
      <label><?php _e( 'Username', 'dm3-widgets' ); ?></label>
      <input type="text" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $username; ?>" />
    </p>
    
    <p>
      <label><?php _e( 'Number of tweets', 'dm3-widgets' ); ?></label>
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

    <p>
      <label><?php _e( 'Consumer key', 'dm3-widgets' ); ?></label>
      <input type="password" name="<?php echo $this->get_field_name( 'consumer_key' ); ?>" value="<?php echo $consumer_key; ?>" />
    </p>

    <p>
      <label><?php _e( 'Consumer secret', 'dm3-widgets' ); ?></label>
      <input type="password" name="<?php echo $this->get_field_name( 'consumer_secret' ); ?>" value="<?php echo $consumer_secret; ?>" />
    </p>

    <p>
      <label><?php _e( 'Access token', 'dm3-widgets' ); ?></label>
      <input type="password" name="<?php echo $this->get_field_name( 'access_token' ); ?>" value="<?php echo $access_token; ?>" />
    </p>

    <p>
      <label><?php _e( 'Access token secret', 'dm3-widgets' ); ?></label>
      <input type="password" name="<?php echo $this->get_field_name( 'access_token_secret' ); ?>" value="<?php echo $access_token_secret; ?>" />
    </p>
    <?php
  }
}
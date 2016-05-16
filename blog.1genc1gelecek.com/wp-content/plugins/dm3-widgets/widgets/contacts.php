<?php
/**
 * Posts widget
 * 
 * @package Dm3Widgets
 * @since Dm3Widgets 1.0
 * @version 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {exit;}

class Dm3WidgetsContacts extends WP_Widget {
  protected $_enable_cache = true;

  /**
   * Register widget with WordPress
   */
  function __construct() {
    parent::__construct(
      'Dm3WidgetsContacts', // ID
      'Contacts (Dm3Widgets)', // Name
      array(
        'classname' => 'dm3-widgets-contacts-widget',
        'description' => __( 'Contacts block', 'dm3-widgets' )
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
    // Widget options
    $instance = wp_parse_args( $instance, array( 'title' => '', 'email' => '', 'phone' => '', 'address' => '' ) );

    echo $args['before_widget'];
    echo $args['before_title'] , apply_filters( 'widget_title', $instance['title'] ) , $args['after_title'];

    $output = '<table class="dm3-widgets-contacts">';

    if ( $instance['email'] ) {
      // Encode email
      $output .= apply_filters( 'Dm3WidgetsContacts_tr', '<tr><td class="icon"></td><td class="value">' . $instance['email'] . '</td></tr>', 'email' );
    }

    if ( $instance['phone'] ) {
      $output .= apply_filters( 'Dm3WidgetsContacts_tr', '<tr><td class="icon"></td><td class="value">' . $instance['phone'] . '</td></tr>', 'phone' );
    }

    if ( $instance['address'] ) {
      $output .= apply_filters( 'Dm3WidgetsContacts_tr', '<tr><td class="icon"></td><td class="value">' . $instance['address'] . '</td></tr>', 'address' );
    }

    $output .= '</table>';

    echo $output;
    echo $args['after_widget'];
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
    $instance['title'] = $this->dm3wc_filter_input( $new_instance['title'] );
    $instance['email'] = $this->dm3wc_filter_input( $new_instance['email'] );
    $instance['phone'] = $this->dm3wc_filter_input( $new_instance['phone'] );
    $instance['address'] = $this->dm3wc_filter_input( $new_instance['address'] );

    return $instance;
  }

  /**
   * Sanitize input
   *
   * @param $input
   *
   * @return string
   */
  public function dm3wc_filter_input( $input ) {
    if ( current_user_can( 'unfiltered_html' ) ) {
      return $input;
    }

    return strip_tags( $input );
  }
  
  /**
   * Back-end widget form.
   *
   * @see WP_Widget::form()
   *
   * @param array $instance Previously saved values from database.
   *
   * @return void
   */
  public function form( $instance ) {
    // Get widget options
    $instance = wp_parse_args(
      ( array ) $instance,
      array(
        'title' => '',
        'email' => '',
        'phone' => '',
        'address' => ''
      )
    );
    
    extract( $instance );
    ?>
    <p>
      <label><?php _e( 'Title:', 'dm3-widgets' ); ?></label>
      <input type="text" class="widefat" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $title; ?>" />
    </p>

    <p>
      <label><?php _e( 'Email:', 'dm3-widgets' ); ?></label>
      <textarea class="widefat" name="<?php echo $this->get_field_name( 'email' ); ?>"><?php echo $email; ?></textarea>
    </p>

    <p>
      <label><?php _e( 'Phone:', 'dm3-widgets' ); ?></label>
      <textarea class="widefat" name="<?php echo $this->get_field_name( 'phone' ); ?>"><?php echo $phone; ?></textarea>
    </p>

    <p>
      <label><?php _e( 'Address:', 'dm3-widgets' ); ?></label>
      <textarea class="widefat" name="<?php echo $this->get_field_name( 'address' ); ?>"><?php echo $address; ?></textarea>
    </p>
    <?php
  }
}
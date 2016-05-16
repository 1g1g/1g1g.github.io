<?php
/**
 * Posts widget
 * 
 * @package Dm3Widgets
 * @since Dm3Widgets 1.0
 * @version 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {exit;}

class Dm3WidgetsPosts extends WP_Widget {
  protected $_enable_cache = true;

  /**
   * Register widget with WordPress
   */
  function __construct() {
    parent::__construct(
      'Dm3WidgetsPosts', // ID
      'Posts (Dm3Widgets)', // Name
      array(
        'classname' => 'dm3-widgets-posts-widget',
        'description' => __( 'Latest posts', 'dm3-widgets' )
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
    $instance = wp_parse_args( $instance, array( 'title' => '', 'category' => '', 'amount' => '', 'date' => 0, 'images' => 1, 'excerpt' => 0, 'excerpt_length' => 80 ) );
    $instance['title'] = apply_filters( 'widget_title', $instance['title'] );
    
    echo $args['before_widget'];
    echo $args['before_title'] , $instance['title'] , $args['after_title'];
    echo '<ul class="dm3-widgets-posts">';
    
    $tr_key = 'Dm3WidgetsPosts_' . $instance['category'] . '_' . $instance['amount'];
    
    if ( ! ( $output = get_transient( $tr_key ) ) || ! $this->_enable_cache ) {
      global $post;
      
      $params = array(
        'showposts' => $instance['amount'],
        'orderby' => 'id',
        'order' => 'DESC'
      );
      
      if ( is_numeric( $instance['category'] ) ) {
        $params['post_type'] = 'post';
        $params['cat'] = $instance['category'];
      }
      
      $output = '';
      $query = new WP_Query( $params );

      while ( $query->have_posts() ) {
        $query->the_post();
        $has_image = $instance['images'] && current_theme_supports( 'post-thumbnails' ) && has_post_thumbnail();
        $permalink = get_permalink();
        $title = get_the_title();

        $output .= '<li>';

        // Post image
        if ( $has_image ) {
          $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' );

          if ( is_array( $thumb ) && isset( $thumb[0] ) ) {
            $thumb = $thumb[0];
          }

          $output .= '<div class="dm3-widgets-post-image"><a href="' . $permalink . '" title="' . $title . '"><img src="' . $thumb . '" alt=""></a></div>';
        }

        // Post description
        $output .= '<div class="dm3-widgets-post-description">';
        $output .= '<a href="' . $permalink . '">' . $title . '</a>';

        if ( $instance['date'] ) {
          $date = get_the_date();
          $output .= '<span class="dm3-widgets-post-date">' . $date . '</span>';
        }

        if ( $instance['excerpt'] ) {
          $excerpt = substr( get_the_excerpt(), 0, intval($instance['excerpt_length']) );

          // Fix sliced last word problem
          $pos = strrpos( $excerpt, ' ' );

          if ( $pos > 0 ) {
            $excerpt = substr( $excerpt, 0, $pos );
          }

          $output .= $excerpt . '&hellip;';
        }

        $output .= '</div>';
        $output .= '</li>';
      }

      wp_reset_query();
      set_transient( $tr_key, $output, 60 * 20 );
    }
    
    echo $output;
    echo '</ul>';
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

    foreach ( $new_instance as $key => $val ) {
      $instance[$key] = htmlspecialchars( $val );
    }

    // Delete transient
    delete_transient( 'Dm3WidgetsPosts_' . $old_instance['category'] . '_' . $old_instance['amount'] );

    return $instance;
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
        'category' => '',
        'amount' => '',
        'date' => '',
        'images' => 1,
        'excerpt' => 1,
        'excerpt_length' => 80
      )
    );
    
    foreach ( $instance as $key => $val ) {
      $$key = htmlspecialchars( $val );
    }
    ?>
    <p>
      <label><?php _e( 'Title', 'dm3-widgets' ); ?></label>
      <input type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $title; ?>" />
    </p>

    <p>
      <label><?php _e('Category', 'dm3-widgets' ); ?></label>
      <select name="<?php echo $this->get_field_name( 'category' ); ?>">
        <option value=""><?php _e( 'All Categories', 'dm3-widgets' ); ?></option>
        <?php
        $categories = get_categories(); 
        foreach ( $categories as $c ) {
          $selected = '';
          if ( $c->term_id == $category ) {
            $selected = ' selected="selected"';
          }
          $option = '<option value="' . $c->term_id . '"' . $selected . '>';
          $option .= $c->cat_name;
          $option .= ' (' . $c->category_count . ')';
          $option .= '</option>';
          echo $option;
        }
        ?>
      </select>
    </p>

    <p>
      <label><?php _e( 'Amount', 'dm3-widgets' ); ?></label>
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
      <label><?php _e( 'Show Date', 'dm3-widgets' ); ?></label>
      <select name="<?php echo $this->get_field_name( 'date' ); ?>">
        <option value="1"<?php if ( $date == 1 ) echo ' selected="selected"'; ?>><?php _e( 'Yes', 'dm3-widgets' ); ?></option>
        <option value="0"<?php if ( $date == 0 ) echo ' selected="selected"'; ?>><?php _e( 'No', 'dm3-widgets' ); ?></option>
      </select>
    </p>

    <p>
      <label><?php _e( 'Show Images', 'dm3-widgets' ); ?></label>
      <select name="<?php echo $this->get_field_name( 'images' ); ?>">
        <option value="1"<?php if ( $images == 1 ) echo ' selected="selected"'; ?>><?php _e( 'Yes', 'dm3-widgets' ); ?></option>
        <option value="0"<?php if ( $images == 0 ) echo ' selected="selected"'; ?>><?php _e( 'No', 'dm3-widgets' ); ?></option>
      </select>
    </p>

    <p>
      <label><?php _e( 'Show Excerpts', 'dm3-widgets' ); ?></label>
      <select name="<?php echo $this->get_field_name( 'excerpt' ); ?>">
        <option value="1"<?php if ( $excerpt == 1 ) echo ' selected="selected"'; ?>><?php _e( 'Yes', 'dm3-widgets' ); ?></option>
        <option value="0"<?php if ( $excerpt == 0 ) echo ' selected="selected"'; ?>><?php _e( 'No', 'dm3-widgets' ); ?></option>
      </select>
    </p>

    <p>
      <label><?php _e( 'Excerpt length', 'dm3-widgets' ); ?></label>
      <input type="text" name="<?php echo $this->get_field_name( 'excerpt_length' ); ?>" value="<?php echo $excerpt_length; ?>" size="3" maxlength="4" />
    </p>
    <?php
  }
}
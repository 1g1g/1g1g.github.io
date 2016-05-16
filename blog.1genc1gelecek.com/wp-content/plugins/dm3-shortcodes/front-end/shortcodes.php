<?php
/**
 * Shortcodes definitions
 * 
 * @package Dm3Shortcodes
 * @since Dm3Shortcodes 1.0
 * @version 1.0
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Strips extra p tags from shortcode content
 *
 * @param string $content
 *
 * @return string
 */
function dm3sc_content( $content ) {
  $content = do_shortcode( shortcode_unautop( $content ) );
  $content = preg_replace( '#^<\/p>|^<br\s?\/?>|<p>$|<p>\s*(&nbsp;)?\s*<\/p>#', '', $content );
  return $content;
}

/**
 * Columns
 */
if ( ! function_exists( 'dm3sc_shortcode_column' ) ) {
  function dm3sc_shortcode_column( $atts, $content = null, $tag = null ) {
    $output = '';

    switch( $tag ) {
      case 'dm3_one_half':
        $output = '<div class="dm3-one-half">' . dm3sc_content( $content ) . '</div>';
        break;

      case 'dm3_one_half_last':
        $output = '<div class="dm3-one-half dm3-column-last">' . dm3sc_content( $content ) . '</div><div class="clear"></div>';
        break;

      case 'dm3_one_third':
        $output = '<div class="dm3-one-third">' . dm3sc_content( $content ) . '</div>';
        break;

      case 'dm3_one_third_last':
        $output = '<div class="dm3-one-third dm3-column-last">' . dm3sc_content( $content ) . '</div><div class="clear"></div>';
        break;

      case 'dm3_one_fourth':
        $output = '<div class="dm3-one-fourth">' . dm3sc_content( $content ) . '</div>';
        break;

      case 'dm3_one_fourth_last':
        $output = '<div class="dm3-one-fourth dm3-column-last">' . dm3sc_content( $content ) . '</div><div class="clear"></div>';
        break;

      case 'dm3_one_fifth':
        $output = '<div class="dm3-one-fifth">' . dm3sc_content( $content ) . '</div>';
        break;

      case 'dm3_one_fifth_last':
        $output = '<div class="dm3-one-fifth dm3-column-last">' . dm3sc_content( $content ) . '</div><div class="clear"></div>';
        break;

      case 'dm3_one_sixth':
        $output = '<div class="dm3-one-sixth">' . dm3sc_content( $content ) . '</div>';
        break;

      case 'dm3_one_sixth_last':
        $output = '<div class="dm3-one-sixth dm3-column-last">' . dm3sc_content( $content ) . '</div><div class="clear"></div>';
        break;

      case 'dm3_two_third':
        $output = '<div class="dm3-two-third">' . dm3sc_content( $content ) . '</div>';
        break;

      case 'dm3_two_third_last':
        $output = '<div class="dm3-two-third dm3-column-last">' . dm3sc_content( $content ) . '</div><div class="clear"></div>';
        break;

      case 'dm3_three_fourth':
        $output = '<div class="dm3-three-fourth">' . dm3sc_content( $content ) . '</div>';
        break;

      case 'dm3_three_fourth_last':
        $output = '<div class="dm3-three-fourth dm3-column-last">' . dm3sc_content( $content ) . '</div><div class="clear"></div>';
        break;

      case 'dm3_two_fifth':
        $output = '<div class="dm3-two-fifth">' . dm3sc_content( $content ) . '</div>';
        break;

      case 'dm3_two_fifth_last':
        $output = '<div class="dm3-two-fifth dm3-column-last">' . dm3sc_content( $content ) . '</div><div class="clear"></div>';
        break;

      case 'dm3_three_fifth':
        $output = '<div class="dm3-three-fifth">' . dm3sc_content( $content ) . '</div>';
        break;

      case 'dm3_three_fifth_last':
        $output = '<div class="dm3-three-fifth dm3-column-last">' . dm3sc_content( $content ) . '</div><div class="clear"></div>';
        break;

      case 'dm3_four_fifth':
        $output = '<div class="dm3-four-fifth">' . dm3sc_content( $content ) . '</div>';
        break;

      case 'dm3_four_fifth_last':
        $output = '<div class="dm3-four-fifth dm3-column-last">' . dm3sc_content( $content ) . '</div><div class="clear"></div>';
        break;

      case 'dm3_five_sixth':
        $output = '<div class="dm3-five-sixth">' . dm3sc_content( $content ) . '</div>';
        break;

      case 'dm3_five_sixth_last':
        $output = '<div class="dm3-five-sixth dm3-column-last">' . dm3sc_content( $content ) . '</div><div class="clear"></div>';
        break;
    }

    return $output;
  }

  add_shortcode( 'dm3_one_half', 'dm3sc_shortcode_column' );
  add_shortcode( 'dm3_one_half_last', 'dm3sc_shortcode_column' );
  add_shortcode( 'dm3_one_third', 'dm3sc_shortcode_column' );
  add_shortcode( 'dm3_one_third_last', 'dm3sc_shortcode_column' );
  add_shortcode( 'dm3_one_fourth', 'dm3sc_shortcode_column' );
  add_shortcode( 'dm3_one_fourth_last', 'dm3sc_shortcode_column' );
  add_shortcode( 'dm3_one_fifth', 'dm3sc_shortcode_column' );
  add_shortcode( 'dm3_one_fifth_last', 'dm3sc_shortcode_column' );
  add_shortcode( 'dm3_one_sixth', 'dm3sc_shortcode_column' );
  add_shortcode( 'dm3_one_sixth_last', 'dm3sc_shortcode_column' );
  add_shortcode( 'dm3_two_third', 'dm3sc_shortcode_column' );
  add_shortcode( 'dm3_two_third_last', 'dm3sc_shortcode_column' );
  add_shortcode( 'dm3_three_fourth', 'dm3sc_shortcode_column' );
  add_shortcode( 'dm3_three_fourth_last', 'dm3sc_shortcode_column' );
  add_shortcode( 'dm3_two_fifth', 'dm3sc_shortcode_column' );
  add_shortcode( 'dm3_two_fifth_last', 'dm3sc_shortcode_column' );
  add_shortcode( 'dm3_three_fifth', 'dm3sc_shortcode_column' );
  add_shortcode( 'dm3_three_fifth_last', 'dm3sc_shortcode_column' );
  add_shortcode( 'dm3_four_fifth', 'dm3sc_shortcode_column' );
  add_shortcode( 'dm3_four_fifth_last', 'dm3sc_shortcode_column' );
  add_shortcode( 'dm3_five_sixth', 'dm3sc_shortcode_column' );
  add_shortcode( 'dm3_five_sixth_last', 'dm3sc_shortcode_column' );
}

/**
 * Button
 */
if ( ! function_exists( 'dm3sc_shortcode_button' ) ) {
  function dm3sc_shortcode_button( $atts, $content = null ) {
    $atts = shortcode_atts( array(
      'url' => '',
      'size' => 'medium',
      'target' => '_self',
      'color' => 'default'
    ), $atts );

    $class = 'dm3-btn';

    if ( in_array( $atts['size'], array( 'small', 'medium', 'large' ) ) ) {
      $class .= ' dm3-btn-' . $atts['size'];
    }

    if ( in_array( $atts['color'], array( 'blue', 'light-blue', 'red', 'orange', 'gold', 'green', 'purple' ) ) ) {
      $class .= ' dm3-btn-' . $atts['color'];
    }

    $target = '';
    if ( in_array( $atts['target'], array( '_self', '_blank' ) ) ) {
      $target = ' target="' . $atts['target'] . '"';
    }

    $output = '<a class="' . $class . '" href="' . $atts['url'] . '"' . $target . '>' . $content . '</a>';
    return $output;
  }

  add_shortcode( 'dm3_button', 'dm3sc_shortcode_button' );
}

/**
 * Tabs
 */
if ( ! function_exists( 'dm3sc_shortcode_tabs' ) ) {
  function dm3sc_shortcode_tabs( $atts, $content = null ) {
    $atts = shortcode_atts( array(
      'type' => 'horizontal'
    ), $atts );

    preg_match_all( '/label="([^"]+)"/i', $content, $matches );

    $nav = '<ul class="dm3-tabs-nav">';
    if ( is_array( $matches ) && isset( $matches[1] ) ) {
      foreach( $matches[1] as $nav_item ) {
        $nav .= '<li><a href="#">' . $nav_item . '</a></li>';
      }
    }
    $nav .= '</ul>';

    if ( $atts['type'] == 'vertical_left' ) {
      $tabs_class = 'dm3-tabs-vertical';
    } else if ( $atts['type'] == 'vertical_right' ) {
      $tabs_class = 'dm3-tabs-vertical dm3-tabs-vertical-right';
    } else {
      $tabs_class = 'dm3-tabs-default';
    }

    return '<div class="' . $tabs_class . '">' . $nav . '<div class="dm3-tabs">' . dm3sc_content( $content ) . '</div></div>';
  }

  add_shortcode( 'dm3_tabs', 'dm3sc_shortcode_tabs' );
}

if ( ! function_exists( 'dm3sc_shortcode_tab' ) ) {
  function dm3sc_shortcode_tab( $atts, $content = null ) {
    return '<div class="dm3-tab"><div class="dm3-tab-inner">' . dm3sc_content( $content ) . '</div></div>';
  }

  add_shortcode( 'dm3_tab', 'dm3sc_shortcode_tab' );
}

/**
 * Accordion
 */
if ( ! function_exists( 'dm3sc_shortcode_accordion' ) ) {
  function dm3sc_shortcode_accordion( $atts, $content = null ) {
    return '<div class="dm3-accordion">' . dm3sc_content( $content ) . '</div>';
  }

  add_shortcode( 'dm3_accordion', 'dm3sc_shortcode_accordion' );
}

if ( ! function_exists( 'dm3sc_shortcode_collapse' ) ) {
  function dm3sc_shortcode_collapse( $atts, $content = null ) {
    $atts = shortcode_atts( array(
      'label' => '',
      'state' => 'closed'
    ), $atts );

    $output = '<div class="dm3-collapse-item">
      <div class="dm3-collapse-trigger"><a href="#">' . $atts['label'] . '</a></div>
      <div class="dm3-collapse-body dm3-collapse' . ( $atts['state'] == 'open' ? ' dm3-in' : '' ) . '">
        <div class="dm3-collapse-inner">' . dm3sc_content( $content ) . '</div>
      </div>
    </div>';

    return $output;
  }

  add_shortcode( 'dm3_collapse', 'dm3sc_shortcode_collapse' );
}

/**
 * Alerts
 */
if ( ! function_exists( 'dm3sc_shortcode_alert' ) ) {
  function dm3sc_shortcode_alert( $atts, $content = null ) {
    $atts = shortcode_atts( array(
      'type' => 'warning'
    ), $atts );

    $class = 'dm3-alert';

    if ( in_array( $atts['type'], array( 'warning', 'info', 'success', 'error' ) ) ) {
      $class .= ' dm3-alert-' . $atts['type'];
    }

    $output = '<div class="' . $class . '">' . $content . '</div>';
    return $output;
  }

  add_shortcode( 'dm3_alert', 'dm3sc_shortcode_alert' );
}

/**
 * Price table
 */
if ( ! function_exists( 'dm3sc_shortcode_price_table' ) ) {
  function dm3sc_shortcode_price_table( $atts, $content = null ) {
    $classes = 'dm3-pricing';
    $num_columns = intval(substr_count($content, '[dm3_price_column'));
    $classes .= ' dm3-pricing-' . $num_columns;

    return '<div class="' . $classes . '">' . dm3sc_content( $content ) . '</div>';
  }

  add_shortcode( 'dm3_price_table', 'dm3sc_shortcode_price_table' );
}

if ( ! function_exists( 'dm3sc_shortcode_price_column' ) ) {
  function dm3sc_shortcode_price_column( $atts, $content = null ) {
    $atts = shortcode_atts( array(
      'title' => '',
      'price' => '',
      'per' => '',
      'url' => '',
      'buttontext' => '',
      'buttonclass' => '',
      'style' => 'default'
    ), $atts );

    $output = '<div class="dm3-pricing-column' . ($atts['style'] == 'featured' ? ' dm3-pricing-featured' : '') . '">';
    $output .= '<div class="dm3-pricing-header"><h2>' . $atts['title'] . '</h2></div>';
    $output .= '<div class="dm3-pricing-price"><span>' . $atts['price'] . '</span> <i>' . $atts['per'] . '</i></div>';
    $output .= '<div class="dm3-pricing-options">' . dm3sc_content( $content ) . '</div>';
    $buttonclass = ! empty( $atts['buttonclass'] ) ? $atts['buttonclass'] : 'dm3-pricing-button';
    $output .= '<div class="dm3-pricing-actions"><a' . ' class="' . $buttonclass . '" href="' . $atts['url'] . '">' . $atts['buttontext'] . '</a></div>';
    $output .= '</div>';

    return $output;
  }

  add_shortcode( 'dm3_price_column', 'dm3sc_shortcode_price_column' );
}

/**
 * Divider
 */
if ( ! function_exists( 'dm3sc_shortcode_divider' ) ) {
  function dm3sc_shortcode_divider( $atts, $content = null ) {
    $atts = shortcode_atts( array(
      'style' => ''
    ), $atts );

    $class = 'dm3-divider';

    if ( in_array( $atts['style'], array( 'normal', 'dotted', 'space' ) ) ) {
      $class .= '-' . $atts['style'];
    }

    return '<div class="' . $class . '"></div>';
  }

  add_shortcode( 'dm3_divider', 'dm3sc_shortcode_divider' );
}

/**
 * Inline icon
 */
if ( ! function_exists( 'dm3sc_shortcode_icon' ) ) {
  function dm3sc_shortcode_icon( $atts, $content = null ) {
    $atts = shortcode_atts( array(
      'icon' => ''
    ), $atts );

    $class = '';

    if ( $atts['icon'] ) {
      $class .= 'font-icon-' . $atts['icon'];
    }

    return '<span class="' . $class . '"></span>';
  }

  add_shortcode( 'dm3_icon', 'dm3sc_shortcode_icon' );
}

/**
 * Box icon
 */
if ( ! function_exists( 'dm3sc_shortcode_box_icon' ) ) {
  function dm3sc_shortcode_box_icon( $atts, $content = null ) {
    $atts = shortcode_atts( array(
      'icon' => '',
      'style' => 'center'
    ), $atts );

    $class = '';
    $icon_class = '';

    if ( $atts['icon'] ) {
      $icon_class .= ' font-icon-' . $atts['icon'];
    }

    if ( $atts['style'] == 'center' ) {
      $class .= ' dm3-box-icon-center';
    } else {
      $class .= ' dm3-box-icon-left';
    }

    return '<div class="dm3-box-icon' . $class . '"><div class="dm3-box-icon-icon"><span class="' . $icon_class . '"></span></div><div class="dm3-box-icon-content">' . dm3sc_content( $content ) . '</div></div>';
  }

  add_shortcode( 'dm3_box_icon', 'dm3sc_shortcode_box_icon' );
}

/**
 * Team member
 */
if ( ! function_exists( 'dm3sc_shortcode_team_member' ) ) {
  function dm3sc_shortcode_team_member( $atts, $content = null ) {
    $atts = shortcode_atts( array(
      'image' => '',
      'name' => '',
      'title' => '',
      'twitter' => '',
      'facebook' => '',
      'skype' => '',
      'email' => ''
    ), $atts );

    $output = '<div class="dm3-member-block">';
    
    // Image
    if ( $atts['image'] ) {
      $output .= '<div class="dm3-member-image"><img src="' . $atts['image'] . '" alt=""></div>';
    }

    // Name and title
    $output .= '<div class="dm3-member-title">';
    $output .= '<h2>' . $atts['name'] . '</h2>';
    if ( $atts['title'] ) {
      $output .= '<p>' . $atts['title'] . '</p>';
    }
    $output .= '</div>';

    // Description
    $output .= '<div class="dm3-member-description">' . $content . '</div>';

    // Social
    if ( $atts['twitter'] || $atts['facebook'] || $atts['skype'] || $atts['email'] ) {
      $output .= '<div class="dm3-member-social">';

      if ( $atts['twitter'] ) {
        $output .= '<a href="' . $atts['twitter'] . '" title="' . __( 'Twitter', 'dm3-shortcodes' ) . '"><span class="font-icon-twitter"></span></a>';
      }

      if ( $atts['facebook'] ) {
        $output .= '<a href="' . $atts['facebook'] . '" title="' . __( 'Facebook', 'dm3-shortcodes' ) . '"><span class="font-icon-facebook"></span></a>';
      }

      if ( $atts['skype'] ) {
        $output .= '<a href="' . $atts['skype'] . '" title="' . __( 'Skype', 'dm3-shortcodes' ) . '"><span class="font-icon-skype"></span></a>'; 
      }

      if ( $atts['email'] ) {
        $output .= '<a href="' . $atts['email'] . '" title="' . __( 'Email', 'dm3-shortcodes' ) . '"><span class="font-icon-envelope"></span></a>'; 
      }

      $output .= '</div>';
    }

    $output .= '</div>';

    return $output;
  }

  add_shortcode( 'dm3_team_member', 'dm3sc_shortcode_team_member' );
}

/**
 * Testimonials
 */
if ( ! function_exists( 'dm3sc_shortcode_testimonials' ) ) {
  function dm3sc_shortcode_testimonials( $atts, $content = null ) {
    $atts = shortcode_atts( array(
      'autoscroll' => 0
    ), $atts );

    preg_match_all( '/\[dm3_testimonial/i', $content, $matches );

    $nav = '<ul class="dm3-tabs-nav">';
    if ( is_array( $matches ) && isset( $matches[0] ) ) {
      $i = 1;
      foreach( $matches[0] as $nav_item ) {
        $nav .= '<li><a href="#">' . $i++ . '</a></li>';
      }
    }
    $nav .= '</ul>';

    $autoscroll = '';
    if (is_numeric($atts['autoscroll'])) {
      $autoscroll = ' data-autoscroll="' . $atts['autoscroll'] . '"';
    }

    return '<div class="dm3-tabs-testimonials"' . $autoscroll . '><div class="dm3-tabs">' . dm3sc_content( $content ) . '</div>' . $nav . '</div>';
  }

  add_shortcode( 'dm3_testimonials', 'dm3sc_shortcode_testimonials' );
}

if ( ! function_exists( 'dm3sc_shortcode_testimonial' ) ) {
  function dm3sc_shortcode_testimonial( $atts, $content = null ) {
    $atts = shortcode_atts( array(
      'authorname' => '',
      'authordescription' => '',
      'authorwebsite' => ''
    ), $atts );

    $output = '<div class="dm3-tab"><div class="dm3-tab-inner">';
    $output .= '<blockquote>' . dm3sc_content( $content ) . '</blockquote>';

    if ( $atts['authorname'] ) {
      $output .= '<div class="dm3-testimonial-name">';
      if ( $atts['authorwebsite'] ) {
        $output .= '<a href="' . $atts['authorwebsite'] . '" target="_blank">' . $atts['authorname'] . '</a>';
      } else {
        $output .= $atts['authorname'];
      }
      $output .= '</div>';
    }

    if ( $atts['authordescription'] ) {
      $output .= '<div class="dm3-testimonial-description">' . $atts['authordescription'] . '</div>';
    }

    $output .= '</div></div>';

    return $output;
  }

  add_shortcode( 'dm3_testimonial', 'dm3sc_shortcode_testimonial' );
}

/**
 * POSTS CAROUSEL
 */
if ( ! function_exists( 'dm3sc_shortcode_posts_carousel' ) ) {
  function dm3sc_shortcode_posts_carousel( $atts, $content = null ) {
    $atts = shortcode_atts( array(
      'posttype' => '',
      'category' => '',
      'amount' => 1,
      'excerptlength' => 55
    ), $atts );

    // Get posts
    global $post;

    $params = array(
      'post_type' => $atts['posttype'],
      'showposts' => $atts['amount'],
      'orderby' => 'id',
      'order' => 'DESC'
    );

    if ( is_numeric( $atts['category'] ) ) {
      $params['cat'] = $atts['category'];
    }

    $query = new WP_Query( $params );

    $output = apply_filters( 'dm3sc_posts_carousel', '<ul>', 'before posts' );

    while ( $query->have_posts() ) {
      $query->the_post();
      $has_image = current_theme_supports( 'post-thumbnails' ) && has_post_thumbnail();
      $permalink = get_permalink();
      $title = get_the_title();

      $output .= apply_filters( 'dm3sc_posts_carousel', '<li>', 'before post' );

      // Post image
      if ( $has_image ) {
        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'gallery' );

        if ( is_array( $thumb ) && isset( $thumb[0] ) ) {
          $thumb = $thumb[0];
        }

        $output .= '<a class="image" href="' . $permalink . '" title="' . $title . '"><img src="' . $thumb . '" alt=""></a>';
      }

      // Post description
      $output .= '<div class="description">';

      // Title
      $output .= '<h2><a href="' . $permalink . '">' . $title . '</a></h2>';

      // Excerpt
      $excerpt = substr( get_the_excerpt(), 0, intval( $atts['excerptlength'] ) );

      // Fix sliced last word problem
      $pos = strrpos( $excerpt, ' ' );

      if ( $pos > 0 ) {
        $excerpt = substr( $excerpt, 0, $pos );
      }

      if ( $excerpt ) {
        $output .= '<p>' . $excerpt . '&hellip;</p>';
      }

      $output .= '</div>';
      $output .= apply_filters( 'dm3sc_posts_carousel', '</li>', 'after post' );
    }

    wp_reset_query();

    $output .= apply_filters( 'dm3sc_posts_carousel', '</ul>', 'after posts' );

    return $output;
  }

  add_shortcode( 'dm3_posts_carousel', 'dm3sc_shortcode_posts_carousel' );
}

/**
 * CLIENTS CAROUSEL
 */
if ( ! function_exists( 'dm3_shortcode_clients' ) ) {
  function dm3_shortcode_clients( $atts, $content = null ) {
    $output = apply_filters( 'dm3sc_clients_carousel', '</ul>', 'before' );
    $output .= dm3sc_content( $content );
    $output .= apply_filters( 'dm3sc_clients_carousel', '</ul>', 'after' );

    return $output;
  }

  add_shortcode( 'dm3_clients', 'dm3_shortcode_clients' );
}

if ( ! function_exists( 'dm3_shortcode_client' ) ) {
  function dm3_shortcode_client( $atts, $content = null ) {
    $atts = shortcode_atts( array(
      'clienturl' => '',
      'title' => ''
    ), $atts );

    $output = '<li>';

    if ( $atts['clienturl'] ) {
      $output .= '<a href="' . $atts['clienturl'] . '"';

      if ( $atts['title'] ) {
        $output .= ' title="' . $atts['title'] . '"';
      }

      $output .= ' target="_blank">';
    }

    $output .= '<img src="' . $content . '" alt="">';

    if ( $atts['clienturl'] ) {
      $output .= '</a>';
    }

    $output .= '</li>';

    return $output;
  }

  add_shortcode( 'dm3_client', 'dm3_shortcode_client' );
}

/**
 * GOOGLE MAP
 */
if ( ! function_exists( 'dm3sc_shortcode_google_map' ) ) {
  function dm3sc_shortcode_google_map( $atts, $content = null ) {
    static $map_id = 0;

    $map_id += 1;

    $atts = shortcode_atts( array(
      'address' => '',
      'height' => ''
    ), $atts );

    if ( ! $atts['height'] ) {
      $atts['height'] = 300;
    } else {
      $atts['height'] = intval( $atts['height'] );
    }

    $output = '
      <div id="dm3-google-map-' . $map_id . '" class="dm3-google-map"></div>
      <script type="text/javascript">
      if (!window.google || !window.google.maps) {
        document.write(\'<\' + \'script src="http://maps.google.com/maps/api/js?sensor=false"\' + \' type="text/javascript"><\' + \'/script>\');
      }
      </script>
      <script type="text/javascript">
      (function($) {
        "use strict";

        var map = $("#dm3-google-map-' . $map_id . '");

        map.css({
          height: "' . $atts['height'] . 'px"
        });

        var address = "' . strip_tags( $atts['address'] ) . '";
        var geocoder = new google.maps.Geocoder();

        geocoder.geocode({address: address}, function(results, status) {
          if (status === google.maps.GeocoderStatus.OK) {
            var lat_lng = results[0].geometry.location;
            var google_map = new google.maps.Map(map.get(0), {
              zoom: 12,
              scrollwheel: false,
              mapTypeControl: true,
              mapTypeId: google.maps.MapTypeId.ROADMAP,
              mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
              navigationControl: true,
              navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
              center: lat_lng
            });

            new google.maps.Marker({
              position: lat_lng,
              map: google_map
            });
          } else {
            alert("Geocode was not successful for the following reason: " + status);
          }
        });
      })(jQuery);
      </script>
    ';

    return $output;
  }

  add_shortcode( 'dm3_google_map', 'dm3sc_shortcode_google_map' );
}

/**
 * BOX
 */
if ( ! function_exists( 'dm3sc_shortcode_box' ) ) {
  function dm3sc_shortcode_box( $atts, $content = null ) {
    return '<div class="dm3-box">' . dm3sc_content( $content ) . '</div>';
  }

  add_shortcode( 'dm3_box', 'dm3sc_shortcode_box' );
}
<?php
if ( ! defined( 'TEMPLATEPATH' ) ) {exit();}

define( 'DM3THEME', 'business-idea' );
define( 'DM3THEME_NAME', 'Business Idea' );
define( 'DM3THEME_VER', '1.1' );

/**
 * Include base functions (common for all themes)
 */
require_once get_template_directory() . '/functions-base.php';

/**
 * If Dm3Options plugin is not included
 */
if ( ! function_exists( 'dm3_option' ) ) {
  function dm3_option( $key, $default_value = null ) {
    return $default_value;
  }
}

/**
 * Get color schemes
 */
function dm3_get_colors() {
  return array(
    'blue' => array(
      'primary' => '#4381DE',
      'link_hover' => '#3566B0',
      'btn_bg' => '#4381DE',
      'btn_grad_top' => '#71AAFF',
      'btn_grad_btm' => '#4381DE',
      'btn_border' => '#3465AD',
      'btn_border_top' => '#3E78CF',
      'btn_color' => '#fff',
      'btn_text_shadow' => '#305DA1',
      'btn_box_shadow_in' => '#B0CFFF',
      'btn_box_shadow_out' => '#ddd',
      'btn_hover_border' => '#3465AD',
      'btn_hover_box_shadow_in' => '#4381DE',
      'btn_hover_box_shadow_out' => '#ddd',
      'btn_hover_color' => '#fff'
    ),

    'blue2' => array(
      'primary' => '#0689C0',
      'link_hover' => '#056F9C',
      'btn_bg' => '#0689C0',
      'btn_grad_top' => '#08B6FF',
      'btn_grad_btm' => '#0689C0',
      'btn_border' => '#056D99',
      'btn_border_top' => '#0689C0',
      'btn_color' => '#fff',
      'btn_text_shadow' => '#056D99',
      'btn_box_shadow_in' => '#69E1FF',
      'btn_box_shadow_out' => '#eee',
      'btn_hover_border' => '#056D99',
      'btn_hover_box_shadow_in' => '#056D99',
      'btn_hover_box_shadow_out' => '#eee',
      'btn_hover_color' => '#fff'
    ),

    'gold' => array(
      'primary' => '#ffb501',
      'link_hover' => '#C98F01',
      'btn_bg' => '#ffb501',
      'btn_grad_top' => '#ffdf30',
      'btn_grad_btm' => '#ffb501',
      'btn_border' => '#d2b700',
      'btn_border_top' => '#e4c600',
      'btn_color' => '#fff',
      'btn_text_shadow' => '#d1b601',
      'btn_box_shadow_in' => '#fff7cd',
      'btn_box_shadow_out' => '#ddd',
      'btn_hover_border' => '#d2b700',
      'btn_hover_box_shadow_in' => '#ffb501',
      'btn_hover_box_shadow_out' => '#ddd',
      'btn_hover_color' => '#fff'
    ),

    'green' => array(
      'primary' => '#00C770',
      'link_hover' => '#00AB60',
      'btn_bg' => '#00C770',
      'btn_grad_top' => '#00FF8F',
      'btn_grad_btm' => '#00C770',
      'btn_border' => '#00B566',
      'btn_border_top' => '#00C770',
      'btn_color' => '#fff',
      'btn_text_shadow' => '#00B566',
      'btn_box_shadow_in' => '#B6FFDE',
      'btn_box_shadow_out' => '#ddd',
      'btn_hover_border' => '#00B566',
      'btn_hover_box_shadow_in' => '#00B566',
      'btn_hover_box_shadow_out' => '#ddd',
      'btn_hover_color' => '#fff'
    ),

    'green2' => array(
      'primary' => '#8dc90e',
      'link_hover' => '#74A60C',
      'btn_bg' => '#8dc90e',
      'btn_grad_top' => '#bcec58',
      'btn_grad_btm' => '#8dc90e',
      'btn_border' => '#7fb60b',
      'btn_border_top' => '#8cc80d',
      'btn_color' => '#fff',
      'btn_text_shadow' => '#7aae0c',
      'btn_box_shadow_in' => '#d4ff79',
      'btn_box_shadow_out' => '#ddd',
      'btn_hover_border' => '#7fb60b',
      'btn_hover_box_shadow_in' => '#8dc90e',
      'btn_hover_box_shadow_out' => '#ddd',
      'btn_hover_color' => '#fff'
    ),

    'orange' => array(
      'primary' => '#e46e05',
      'link_hover' => '#B55704',
      'btn_bg' => '#e46e05',
      'btn_grad_top' => '#ffb68a',
      'btn_grad_btm' => '#e46e05',
      'btn_border' => '#e46e05',
      'btn_border_top' => '#ff8e32',
      'btn_color' => '#fff',
      'btn_text_shadow' => '#e46e05',
      'btn_box_shadow_in' => '#ffd5ba',
      'btn_box_shadow_out' => '#ddd',
      'btn_hover_border' => '#e46e05',
      'btn_hover_box_shadow_in' => '#e46e05',
      'btn_hover_box_shadow_out' => '#ddd',
      'btn_hover_color' => '#fff'
    ),

    'purple' => array(
      'primary' => '#d16bd2',
      'link_hover' => '#A756A8',
      'btn_bg' => '#d16bd2',
      'btn_grad_top' => '#f7a4ff',
      'btn_grad_btm' => '#d16bd2',
      'btn_border' => '#d16bd2',
      'btn_border_top' => '#ea7deb',
      'btn_color' => '#fff',
      'btn_text_shadow' => '#d16bd2',
      'btn_box_shadow_in' => '#fcd0ff',
      'btn_box_shadow_out' => '#ddd',
      'btn_hover_border' => '#d16bd2',
      'btn_hover_box_shadow_in' => '#d16bd2',
      'btn_hover_box_shadow_out' => '#ddd',
      'btn_hover_color' => '#fff'
    ),

    'red' => array(
      'primary' => '#cf332a',
      'link_hover' => '#a12821',
      'btn_bg' => '#CF332A',
      'btn_grad_top' => '#FA685F',
      'btn_grad_btm' => '#CF332A',
      'btn_border' => '#AB2A23',
      'btn_border_top' => '#CF332A',
      'btn_color' => '#fff',
      'btn_text_shadow' => '#85201B',
      'btn_box_shadow_in' => '#F2ADA8',
      'btn_box_shadow_out' => '#ddd',
      'btn_hover_border' => '#9E2720',
      'btn_hover_box_shadow_in' => '#CF332A',
      'btn_hover_box_shadow_out' => '#ddd',
      'btn_hover_color' => '#fff'
    )
  );
}

/**
 * Sets up the content width value based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
  $content_width = 940;
}

/**
 * Get theme images sizes
 */
function dm3_get_img_sizes() {
  $dm3_img_size = array();
  $dm3_img_size['slider1'] = array( 'w' => 940, 'h' => 380, 'name' => __( 'Slider 1', 'dm3_fwk' ) );
  $dm3_img_size['slider2'] = array( 'w' => 640, 'h' => 320, 'name' => __( 'Slider 2', 'dm3_fwk' ) );
  $dm3_img_size['gallery'] = array( 'w' => 470, 'h' => 320, 'name' => __( 'Gallery items', 'dm3_fwk' ) );
  $dm3_img_size['gallery_single'] = array( 'w' => 614, 'h' => 420, 'name' => __( 'Gallery single', 'dm3_fwk' ) );
  $dm3_img_size['blog'] = array( 'w' => 640, 'h' => 320, 'name' => __( 'Blog', 'dm3_fwk' ) );
  $dm3_img_size['widget'] = array( 'w' => 50, 'h' => 50, 'name' => __( 'Widget', 'dm3_fwk' ) );

  return $dm3_img_size;
}

/**
 * Setup theme features
 */
function dm3_theme_setup() {
  if ( is_admin() ) {
    add_editor_style();
  }
  
  // Localization
  load_theme_textdomain( 'dm3_fwk', get_template_directory() . '/languages' );
  $locale = get_locale();
  $locale_file = get_template_directory() . '/languages/' . $locale . '.php';
  if ( file_exists( $locale_file ) ) {
    require_once $locale_file;
  }
  
  // Custom menus
  register_nav_menus(
    array(
      'primary' => __( 'Main Menu', 'dm3_fwk' )
    )
  );
  
  // Adds support for posts thumbnails
  add_theme_support( 'post-thumbnails' );
  
  // Adds RSS feed links to <head> for posts and comments
  add_theme_support( 'automatic-feed-links' );
  
  // Adds support for excerpts in pages
  add_post_type_support( 'page', 'excerpt' );
  
  // Allow shortcodes in widgets
  add_filter( 'widget_text', 'shortcode_unautop' );
  add_filter( 'widget_text', 'do_shortcode' );
}

add_action( 'after_setup_theme', 'dm3_theme_setup' );

/**
 * Register custom post types and taxonomies
 */
function dm3_register_post_types() {
  // Custom post type: gallery
  register_post_type(
    'gallery',
    array(
      'label' => __( 'Gallery', 'dm3_fwk' ),
      'singular_label' => __( 'Gallery Item', 'dm3_fwk' ),
      'capability_type' => 'post',
      'publicly_queryable' => true,
      'has_archive' => false,
      'show_ui' => true,
      'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
      'taxonomies' => array( 'gallery_cat' )
    )
  );

  // Register taxonomy for gallery posts
  register_taxonomy(
    'gallery_cat',
    'gallery',
    array(
      'label' => __( 'Gallery categories', 'dm3_fwk' ),
      'public' => false,
      'show_ui' => true
    )
  );
}

add_action( 'init', 'dm3_register_post_types' );

/**
 * Add slideshow to custom post types
 */
function dm3_slideshow_post_types( $post_types ) {
  $post_types[] = 'gallery';

  return $post_types;
}

add_filter( 'dm3media_post_types', 'dm3_slideshow_post_types' );

/**
 * Enqueue scripts and styles
 */
function dm3_enqueue_scripts_styles() {
  $template_url = get_template_directory_uri();

  // Scripts
  wp_enqueue_script( 'jquery' );
  wp_enqueue_script( 'dm3-easing', $template_url . '/js/jquery.easing.js', array( 'jquery' ), false );
  wp_enqueue_script( 'dm3-flexslider', $template_url . '/js/jquery.flexslider.js', array( 'jquery' ), false, true );
  wp_enqueue_script( 'dm3-dm3Rs', $template_url . '/js/jquery.dm3Rs.js', array( 'jquery' ), false, true );
  wp_enqueue_script( 'dm3-isotope', $template_url . '/js/isotope.min.js', array( 'jquery' ), false, true );
  wp_enqueue_script( 'dm3-magnificPopup', $template_url . '/js/jquery.magnificPopup.js', array( 'jquery' ), false, true );
  wp_enqueue_script( 'dm3-website', $template_url . '/js/website.js', array( 'jquery' ), false, true );
  wp_enqueue_script( 'dm3-page', $template_url . '/js/page.js', array( 'jquery' ), false, true );

  if ( is_singular() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }

  wp_localize_script( 'dm3-website', 'dm3Theme',
    array(
      'baseUrl' => home_url()
    )
  );
  
  // Styles
  wp_enqueue_style( 'dm3-reset', $template_url . '/css/reset.css' );
  wp_enqueue_style( 'dm3-skeleton', $template_url . '/css/skeleton.css' );
  wp_enqueue_style( 'dm3-fonts', $template_url . '/css/fonts.css' );
  wp_enqueue_style( 'dm3-flexslider', $template_url . '/css/flexslider.css' );
  wp_enqueue_style( 'dm3-magnificPopup', $template_url . '/css/magnificPopup.css' );
  wp_enqueue_style( 'style', $template_url . '/style.css' );

  require_once get_template_directory() . '/css/color.php';
}

add_action( 'wp_enqueue_scripts', 'dm3_enqueue_scripts_styles' );

/**
 * Custom image sizes in media library
 */
function dm3_custom_image_sizes_choose( $sizes ) {
  $img_size = dm3_get_img_sizes();
  
  foreach ( $img_size as $key => $data ) {
    $sizes[$key] = $data['name'];
  }
  
  return $sizes;
}

add_filter( 'image_size_names_choose', 'dm3_custom_image_sizes_choose' );

// Set image sizes
$dm3_img_size = dm3_get_img_sizes();

foreach ( $dm3_img_size as $name => $size ) {
  add_image_size( $name, $size['w'], $size['h'], true );
}

/**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 */
function dm3_wp_title( $title, $sep ) {
  global $paged, $page;

  if ( is_feed() ) {
    return $title;
  }

  // Add the site name.
  $title .= get_bloginfo( 'name' );

  // Add the site description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );

  if ( $site_description && ( is_home() || is_front_page() ) ) {
    $title = "$title $sep $site_description";
  }

  // Add a page number if necessary.
  if ( $paged >= 2 || $page >= 2 ) {
    $title = "$title $sep " . sprintf( __( 'Page %s', 'dm3_fwk' ), max( $paged, $page ) );
  }

  return $title;
}

add_filter( 'wp_title', 'dm3_wp_title', 10, 2 );

/**
 * Sidebars and widgets
 */
function dm3_widgets_init() {
  // Register sidebar: default
  register_sidebar(
    array(
      'name' => __( 'Default Theme Sidebar', 'dm3_fwk' ),
      'id' => 'default-theme-sidebar',
      'description' => null,
      'before_widget' => '<div class="widget">',
      'after_widget' => '</div>',
      'before_title' => '<h3 class="widget-title">',
      'after_title' => '</h3>'
    )
  );
 
  // Register sidebar: footer
  $i = 1;

  for ( ; $i < 5; $i++ ) {
    register_sidebar(
      array(
        'name' => sprintf( __( 'Footer %d', 'dm3_fwk' ), $i ),
        'id' => 'theme-footer-' . $i,
        'description' => null,
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>'
      )
    );
  }
}

add_action( 'widgets_init', 'dm3_widgets_init' );

/**
 * Dm3Sidebars plugin configuration
 */
function dm3_custom_sidebar_args( $args ) {
  return $args;
}

add_filter( 'dm3sb_sidebar_args', 'dm3_custom_sidebar_args' );

function dm3_custom_sidebar_post_types( $post_types ) {
  return $post_types;
}

add_filter( 'dm3sb_post_types', 'dm3_custom_sidebar_post_types' );

/**
 * Continue reading link
 */
function dm3_continue_reading_link( $class = null ) {
  if ( $class !== null ) {
    $class = ' class="' . $class . '"';
  }
  
  return ' <a href="'. get_permalink() . '"' . $class . '>'.__('Read more', 'dm3_fwk') . '</a>';
}

/**
 * Excerpt length filter
 */
function dm3_excerpt_length( $length ) {
  return 15;
}

add_filter( 'excerpt_length', 'dm3_excerpt_length' );

/**
 * Excerpt more text filter
 */

function dm3_excerpt_more( $more ) {
  return '&hellip;';
}

add_filter( 'excerpt_more', 'dm3_excerpt_more' );

/**
 * Nav menu link attributes filter
 */
function dm3_add_submenu_link_class( $atts, $item, $args ) {
  if ( $args->theme_location == 'primary' ) {
    if ( ! isset( $atts['class'] ) ) {
      $atts['class'] = 'ajax-link';
    } else {
      $atts['class'] .= ' ajax-link';
    }
  }

  return $atts;
}

add_filter( 'nav_menu_link_attributes', 'dm3_add_submenu_link_class', 10, 3 );

/**
 * Include slideshow
 */
if ( ! function_exists( 'dm3_include_slideshow' ) ) {
  function dm3_include_slideshow( $post_id, $custom, $args = array() ) {
    $args = array_merge( array(
      'before' => '',
      'after' => '',
      'w' => null,
      'h' => null
    ), $args );

    if ( isset( $custom['dm3_fwk_slideshow'] ) ) {
      switch ( $custom['dm3_fwk_slideshow'][0] ) {
        case 'none':
          break;

        case 'slider-1':
          include get_template_directory() . '/include/slider-1.php';
          break;

        case 'slider-2':
          include get_template_directory() . '/include/slider-2.php';
          break;
      }
    }
  }
}

/**
 * Contacts widget filter
 */
function dm3_contacts_widget_tr( $tr, $type ) {
  if ( $type == 'email' ) {
    $icon = '<span class="font-icon-envelope"></span>';
  } else if ( $type == 'phone' ) {
    $icon = '<span class="font-icon-phone"></span>';
  } else {
    $icon = '<span class="font-icon-map-marker"></span>';
  }

  return str_replace( 'icon">', 'icon"><div>' . $icon . '</div>', $tr );
}

add_filter( 'Dm3WidgetsContacts_tr', 'dm3_contacts_widget_tr', 10, 2 );

/**
 * Posts carousel shortcode filter
 */
function dm3_posts_carousel_filter( $value, $filter ) {
  switch ( $filter ) {
    case 'before posts':
      return '<div class="flexslider flexslider-carousel flexslider-posts"><ul class="slides">';

    case 'after posts':
      return '</ul></div>';
  }

  return $value;
}

add_filter( 'dm3sc_posts_carousel', 'dm3_posts_carousel_filter', 10, 2 );

/**
 * Clients carousel shortcode filter
 */
function dm3_clients_carousel_filter( $value, $filter ) {
  switch ( $filter ) {
    case 'before':
      return '<div class="flexslider flexslider-carousel flexslider-logos"><ul class="slides">';

    case 'after':
      return '</ul></div>';
  }

  return $value;
}

add_filter( 'dm3sc_clients_carousel', 'dm3_clients_carousel_filter', 10, 2 );

/**
 * Output a comment (for wp_list_comments function)
 */
if ( ! function_exists( 'dm3_comment' ) ) {
  function dm3_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;

    $output = '';

    $edit_comment_link = get_edit_comment_link();
    if ( $edit_comment_link ) {
      $edit_comment_link = '<a class="comment-edit-link" href="' . $edit_comment_link . '" title="' . __( 'Edit comment', 'dm3_fwk' ) . '">' . __( 'Edit', 'dm3_fwk' ) . '</a>';
    }

    switch ( $comment->comment_type ) {
      case '':
        $comment_classes = implode( ' ', get_comment_class() );
        $output .= '<li class="' . $comment_classes . '" id="li-comment-' . get_comment_ID() . '">';
        $output .= '<div class="comment-wrap clearfix" id="comment-' . get_comment_ID() . '">';

        // Avatar
        $output .= get_avatar( $comment, 40 );

        // Comment meta
        $output .= '<div class="comment-meta">';
        $output .= '<span class="comment-author"><i>' . __( 'by', 'dm3_fwk' ) . '</i> ' . get_comment_author_link() . '</span>';
        $output .= ' <span class="comment-date"><i>' . __( 'on', 'dm3_fwk' ) . '</i> ';
        /* translators: 1: date, 2: time */
        $output .= sprintf( __( '%1$s at %2$s', 'dm3_fwk' ), get_comment_date(), get_comment_time() );
        $output .= '</span>';

        if ( $edit_comment_link ) {
          $output .= ' <span> | ' . $edit_comment_link . '</span>';
        }

        $output .= '</div>';

        $output .= '<div class="comment-body">';

        // Approved
        if ( $comment->comment_approved == '0' ) {
          $output .= '<p><em class="comment-awaiting-moderation">' . __( 'Your comment is awaiting moderation.', 'dm3_fwk' ) . '</em></p>';
        }

        // Comment text
        $output .= get_comment_text();

        // Reply link
        $output .= '<p class="comment-reply">' . get_comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) . '</p>';

        $output .= '</div></div>';
        break;

      case 'pingback':
      case 'trackback':
        $output .= '<li class="post pingback">';
        $output .= '<p>' . __( 'Pingback:', 'dm3_fwk' ) . ' ' . get_comment_author_link() . ' ' . $edit_comment_link . '</p>';
      break;
    }

    echo $output;
  }
}

/**
 * Output page sub title
 */
if ( ! function_exists( 'dm3_page_subtitle' ) ) {
  function dm3_page_subtitle( $custom = array() ) {
    $subtitle = isset( $custom['dm3_fwk_page_subtitle'] ) ? $custom['dm3_fwk_page_subtitle'][0] : '';

    if ( ! $subtitle ) {
      $subtitle = dm3_option( 'page_subtitle', '' );
    }

    if ( $subtitle ) {
      $subtitle = '<div class="page-description">' . $subtitle . '</div>';
    }

    return $subtitle;
  }
}

/**
 * Output post meta
 */
if ( ! function_exists( 'dm3_post_meta' ) ) {
  function dm3_post_meta() {
    $output = '<div class="post-meta"><ul>';

    $output .= '<li><span class="post-meta-label">' . __( 'Posted on', 'dm3_fwk' ) . '</span> ';
    $posted_on = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
      esc_url( get_permalink() ), esc_attr( get_the_time() ), esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ) );
    $output .= '<span class="post-meta-value">' . $posted_on . '</span></li>';

    $output .= '<li><span class="post-meta-label">' . __( 'Author', 'dm3_fwk' ) . '</span> ';
    $output .= '<span class="post-meta-value">';
    $output .= '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . __( 'View all posts by this author', 'dm3_fwk' ) . '" rel="author">' . esc_attr( get_the_author() ) . '</a></span>';
    $output .= '</span></li> ';

    $categories = get_the_category_list( __( ', ', 'dm3_fwk' ) );

    if ( $categories ) {
      $output .= '<li><span class="post-meta-label">' . __( 'Categories', 'dm3_fwk' ) . '</span> ';
      $output .= '<span class="post-meta-value">' . $categories . '</span></li> ';
    }

    $tags = get_the_tag_list( '', __( ', ', 'dm3_fwk' ) );

    if ( $tags ) {
      $output .= '<li><span class="post-meta-label">' . __( 'Tags', 'dm3_fwk' ) . '</span> ';
      $output .= '<span class="post-meta-value">' . $tags . '</span></li> ';
    }

    if ( comments_open() && ! post_password_required() ) {
      $output .= '<li><span class="post-meta-label">' . __( 'Comments', 'dm3_fwk' ) . '</span> ';
      $output .= '<span class="post-meta-value post-reply-link">';
      ob_start();
      comments_popup_link( __( 'Reply', 'dm3_fwk' ), __( '1 comment', 'dm3_fwk' ), __( '% comments', 'dm3_fwk' ) );
      $output .= ob_get_contents();
      ob_end_clean();
      $output .= '</span></li> ';
    }

    $edit_post_link = get_edit_post_link();

    if ( $edit_post_link ) {
      $output .= '<li><a href="' . $edit_post_link . '">' . __( 'Edit', 'dm3_fwk' ) . '</a></li>';
    }

    $output .= '</ul></div>';

    return $output;
  }
}

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

function dm3_register_required_plugins() {
  $plugins = array(
    array(
      'name' => 'Dm3Options',
      'slug' => 'dm3-options',
      'source' => get_stylesheet_directory() . '/plugins/dm3-options.zip',
      'required' => true
    ),

    array(
      'name' => 'Dm3Shortcodes',
      'slug' => 'dm3-shortcodes',
      'source' => get_stylesheet_directory() . '/plugins/dm3-shortcodes.zip',
      'required' => true
    ),

    array(
      'name' => 'Dm3Media',
      'slug' => 'dm3-media',
      'source' => get_stylesheet_directory() . '/plugins/dm3-media.zip',
      'required' => true
    ),

    array(
      'name' => 'Dm3Sidebars',
      'slug' => 'dm3-sidebars',
      'source' => get_stylesheet_directory() . '/plugins/dm3-sidebars.zip',
      'required' => true
    ),

    array(
      'name' => 'Dm3Widgets',
      'slug' => 'dm3-widgets',
      'source' => get_stylesheet_directory() . '/plugins/dm3-widgets.zip',
      'required' => true
    )
  );

  // Change this to your theme text domain, used for internationalising strings
  $theme_text_domain = 'dm3_fwk';

  $config = array(
    'domain' => $theme_text_domain,
    'default_path' => '', // Default absolute path to pre-packaged plugins
    'parent_menu_slug' => 'themes.php',
    'parent_url_slug' => 'themes.php',
    'menu' => 'install-required-plugins', // Menu slug
    'has_notices' => true, // Show admin notices or not
    'is_automatic' => false, // Automatically activate plugins after installation or not
    'message' => '', // Message to output right before the plugins table
    'strings' => array(
      'page_title' => __( 'Install Required Plugins', $theme_text_domain ),
      'menu_title' => __( 'Install Plugins', $theme_text_domain ),
      'installing' => __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
      'oops' => __( 'Something went wrong with the plugin API.', $theme_text_domain ),
      'notice_can_install_required' => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
      'notice_can_install_recommended' => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
      'notice_cannot_install' => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
      'notice_can_activate_required' => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
      'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
      'notice_cannot_activate' => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
      'notice_ask_to_update' => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
      'notice_cannot_update' => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
      'install_link' => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
      'activate_link' => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
      'return' => __( 'Return to Required Plugins Installer', $theme_text_domain ),
      'plugin_activated' => __( 'Plugin activated successfully.', $theme_text_domain ),
      'complete' => __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
      'nag_type' => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
    )
  );

  tgmpa( $plugins, $config );
}

add_action( 'tgmpa_register', 'dm3_register_required_plugins' );

/**
 * Add google maps if ajax enabled
 */
function dm3_ajax_enabled_init() {
  // Only for ajax enabled
  if ( ! dm3_option( 'enable_ajax', 0 ) ) {
    return;
  }

  wp_enqueue_script( 'google-maps', '//maps.google.com/maps/api/js?sensor=false' );
}

add_action( 'init', 'dm3_ajax_enabled_init' );
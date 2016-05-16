<?php
/**
 * Theme options definitions
 */
if ( ! defined( 'TEMPLATEPATH' ) ) {exit();}

$pages = array(
  '' => __( 'Select homepage', 'dm3_fwk' )
);
$pages_tmp = get_pages();
foreach ( $pages_tmp as $page ) {
  $pages[$page->ID] = $page->post_title;
}
unset( $pages_tmp );

$fields = array(
  // Enable AJAX
  'enable_ajax' => array(
    'label' => __( 'Enable AJAX', 'dm3_fwk' ),
    'type' => 'select',
    'options' => array(
      0 => __( 'No', 'dm3_fwk' ),
      1 => __( 'Yes', 'dm3_fwk' )
    ),
    'description' => __( 'This feature is tested with Wordpress core functionality. Many plugins may not work with this feature enabled.', 'dm3_fwk' )
  ),

  // Posts layout
  'posts_layout' => array(
    'label' => __( 'Layout of blog posts list', 'dm3_fwk' ),
    'type' => 'select',
    'options' => array(
      'layout1' => __( 'Post meta floated to the left', 'dm3_fwk' ),
      'layout2' => __( 'Post meta displayed below the title', 'dm3_fwk' )
    ),
    'description' => __( 'This option controls how the post looks in blog, search, category pages', 'dm3_fwk' )
  ),

  // Default page subtitle
  'page_subtitle' => array(
    'label' => __( 'Default page subtitle', 'dm3_fwk' ),
    'type' => 'text',
    'value' => __( 'Default page subtitle', 'dm3_fwk' )
  ),

  // Show header toolbar
  'show_header_toolbar' => array(
    'label' => __( 'Show header toolbar', 'dm3_fwk' ),
    'type' => 'select',
    'options' => array(
      0 => __( 'No', 'dm3_fwk' ),
      1 => __( 'Yes', 'dm3_fwk' )
    )
  ),

  // Email
  'email' => array(
    'label' => __( 'Email', 'dm3_fwk' ),
    'type' => 'text'
  ),

  // Phone
  'phone' => array(
    'label' => __( 'Phone', 'dm3_fwk' ),
    'type' => 'text'
  ),

  // Address
  'address' => array(
    'label' => __( 'Address', 'dm3_fwk' ),
    'type' => 'text'
  ),
  
  // Logo
  'header_logo' => array(
    'label' => __( 'Logo', 'dm3_fwk' ),
    'type' => 'upload'
  ),

  // Show footer widgets
  'show_footer_widgets' => array(
    'label' => __( 'Show footer widgets', 'dm3_fwk' ),
    'type' => 'select',
    'options' => array(
      0 => __( 'No', 'dm3_fwk' ),
      1 => __( 'Yes', 'dm3_fwk' )
    ),
    'value' => 1
  ),
  
  // Footer: copyright
  'copyright' => array(
    'label' => __( 'Copyright', 'dm3_fwk' ),
    'type' => 'text',
    'maxlength' => 400,
    'filter' => 'none',
    'value' => 'Footer copyright'
  ),

  // Social networks
  'facebook' => array( 'label' => __( 'Facebook URL', 'dm3_fwk' ), 'type' => 'text' ),
  'facebook_title' => array( 'label' => __( 'Facebook Title', 'dm3_fwk' ), 'type' => 'text' ),
  'gplus' => array( 'label' => __( 'Google Plus URL', 'dm3_fwk' ), 'type' => 'text' ),
  'gplus_title' => array( 'label' => __( 'Google Plus Title', 'dm3_fwk' ), 'type' => 'text' ),
  'twitter' => array( 'label' => __( 'Twitter URL', 'dm3_fwk' ), 'type' => 'text' ),
  'twitter_title' => array( 'label' => __( 'Twitter Title', 'dm3_fwk' ), 'type' => 'text' ),
  'linkedin' => array( 'label' => __( 'Linked In URL', 'dm3_fwk' ), 'type' => 'text' ),
  'linkedin_title' => array( 'label' => __( 'Linked In Title', 'dm3_fwk' ), 'type' => 'text' ),
  'skype' => array( 'label' => __( 'Skype URL', 'dm3_fwk' ), 'type' => 'text' ),
  'skype_title' => array( 'label' => __( 'Skype Title', 'dm3_fwk' ), 'type' => 'text' ),
  'youtube' => array( 'label' => __( 'Youtube URL', 'dm3_fwk' ), 'type' => 'text' ),
  'youtube_title' => array( 'label' => __( 'Youtube Title', 'dm3_fwk' ), 'type' => 'text' ),
  'vimeo' => array( 'label' => __( 'Vimeo URL', 'dm3_fwk' ), 'type' => 'text' ),
  'vimeo_title' => array( 'label' => __( 'Vimeo Title', 'dm3_fwk' ), 'type' => 'text' ),
  'rss' => array( 'label' => __( 'RSS URL', 'dm3_fwk' ), 'type' => 'text' ),
  'rss_title' => array( 'label' => __( 'RSS Title', 'dm3_fwk' ), 'type' => 'text' ),
  
  // Page background image
  'page_bg' => array(
    'label' => __( 'Page background image', 'dm3_fwk' ),
    'type' => 'upload',
    'value' => get_template_directory_uri() . '/images/bg/sky.jpg'
  ),

  // Select color scheme
  'color_scheme' => array(
    'label' => __( 'Color scheme', 'dm3_fwk' ),
    'type' => 'select',
    'options' => array(
      '' => __( 'Select color scheme', 'dm3_fwk' ),
      'blue' => __( 'Blue', 'dm3_fwk' ),
      'blue2' => __( 'Blue 2', 'dm3_fwk' ),
      'gold' => __( 'Gold', 'dm3_fwk' ),
      'green' => __( 'Green', 'dm3_fwk' ),
      'green2' => __( 'Green 2', 'dm3_fwk' ),
      'orange' => __( 'Orange', 'dm3_fwk' ),
      'purple' => __( 'Purple', 'dm3_fwk' ),
      'red' => __( 'Red', 'dm3_fwk' )
    )
  ),
);

$style_fields = array();
$style_fields[] = 'page_bg';
$style_fields[] = 'color_scheme';

// Colors
$color_options = array(
  'primary' => __( 'Primary color', 'dm3_fwk' ),
  'link_hover' => __( 'Links hover', 'dm3_fwk' ),
  'btn_bg' => __( 'Button background', 'dm3_fwk' ),
  'btn_grad_top' => __( 'Button gradient top', 'dm3_fwk' ),
  'btn_grad_btm' => __( 'Button gradient bottom', 'dm3_fwk' ),
  'btn_border' => __( 'Button border', 'dm3_fwk' ),
  'btn_border_top' => __( 'Button border top', 'dm3_fwk' ),
  'btn_color' => __( 'Button text color', 'dm3_fwk' ),
  'btn_text_shadow' => __( 'Button text shadow', 'dm3_fwk' ),
  'btn_box_shadow_in' => __( 'Button box shadow inset', 'dm3_fwk' ),
  'btn_box_shadow_out' => __( 'Button box shadow outset', 'dm3_fwk' ),
  'btn_hover_border' => __( 'Button on hover border', 'dm3_fwk' ),
  'btn_hover_box_shadow_in' => __( 'Button on hover box shadow inset', 'dm3_fwk' ),
  'btn_hover_box_shadow_out' => __( 'Button on hover box shadow outset', 'dm3_fwk' ),
  'btn_hover_color' => __( 'Button on hover text color', 'dm3_fwk' )
);

foreach ( $color_options as $c_option => $c_label ) {
  $fields['c_' . $c_option] = array(
    'label' => $c_label,
    'type' => 'colorpicker',
    'classes' => array( 'dm3-color-option' )
  );

  $style_fields[] = 'c_' . $c_option;
}

require_once DM3_FRAMEWORK_DIR . '/dm3-options-form.php';
$dm3_options = new Dm3OptionsForm( $fields, 'dm3_fwk' );

$options = $dm3_options->getOptions();

if ( isset( $_POST['color_scheme'] ) && $_POST['color_scheme'] ) {
  $colors = dm3_get_colors();

  if ( array_key_exists( $_POST['color_scheme'], $colors ) ) {
    $color = $colors[$_POST['color_scheme']];

    foreach ( $color as $c_option => $c_value ) {
      if ( isset ( $_POST['c_' . $c_option] ) && empty( $_POST['c_' . $c_option] ) ) {
        $_POST['c_' . $c_option] = $c_value;
      }
    }
  }
}

$clear_colors_label  = __( 'Clear colors', 'dm3_fwk' );
$styles_footer = <<<TEXT
<p>
  <a id="dm3-clear-colors" href="#">$clear_colors_label</a>
</p>
<script>
(function($) {
  var a_clear_colors = $('#dm3-clear-colors');

  a_clear_colors.on('click', function(e) {
    e.preventDefault();
    $('input.dm3-color-option').each(function() {
      var input = $(this);
      input.val('');
      input.parent().find('.pickcolor > div').css({backgroundColor: '#fff'});
    });
  });
})(jQuery);
</script>
TEXT;

$dm3_options->addCategory(
  __( 'Global settings', 'dm3_fwk' ),
  array(
    'enable_ajax',
    'page_subtitle',
    'posts_layout'
  )
);

$dm3_options->addCategory(
  __( 'Header', 'dm3_fwk' ),
  array(
    'header_logo',
    'show_header_toolbar',
    'email',
    'phone',
    'address'
  )
);

$dm3_options->addCategory(
  __( 'Styles', 'dm3_fwk' ),
  $style_fields,
  $styles_footer
);

$dm3_options->addCategory(
  __( 'Footer', 'dm3_fwk' ),
  array(
    'show_footer_widgets',
    'copyright'
  )
);

$dm3_options->addCategory(
  __( 'Social networks', 'dm3_fwk' ),
  array(
    'facebook',
    'facebook_title',
    'gplus',
    'gplus_title',
    'twitter',
    'twitter_title',
    'linkedin',
    'linkedin_title',
    'skype',
    'skype_title',
    'vimeo',
    'vimeo_title',
    'youtube',
    'youtube_title',
    'rss',
    'rss_title'
  )
);

$dm3_options->save( 'dm3_fwk' );
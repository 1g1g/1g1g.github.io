<?php
/**
 * Shortcodes configuration
 * 
 * @package Dm3Shortcodes
 * @since Dm3Shortcodes 1.0
 * @version 1.0
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Post types
$post_types = array();
$post_types[] = array(
  'label' => __( 'Select post type', 'dm3_fwk' ),
  'value' => ''
);
$post_types[] = array(
  'label' => __( 'Posts', 'dm3_fwk' ),
  'value' => 'post'
);

$tmp_types = get_post_types(
  array(
    '_builtin' => false
  ),
  'object'
);

foreach( $tmp_types as $type ) {
  $post_types[] = array(
    'label' => $type->labels->name,
    'value' => $type->name
  );
}

include_once 'font-icons.php';

// Register shortcodes
$shortcodes = array(
  // COLUMNS
  array(
    'label' => __( 'Columns' ),
    'child_shortcode' => array(
      'options' => array(
        'size' => array(
          'type' => 'select',
          'label' => __( 'Size' ),
          'options' => array(
            array( 'label' => __( 'One half', 'dm3-shortcodes' ), 'value' => 'one_half' ),
            array( 'label' => __( 'One half last', 'dm3-shortcodes' ), 'value' => 'one_half_last' ),
            array( 'label' => __( 'One third', 'dm3-shortcodes' ), 'value' => 'one_third' ),
            array( 'label' => __( 'One third last', 'dm3-shortcodes' ), 'value' => 'one_third_last' ),
            array( 'label' => __( 'One fourth', 'dm3-shortcodes' ), 'value' => 'one_fourth' ),
            array( 'label' => __( 'One fourth last', 'dm3-shortcodes' ), 'value' => 'one_fourth_last' ),
            array( 'label' => __( 'One fifth', 'dm3-shortcodes' ), 'value' => 'one_fifth' ),
            array( 'label' => __( 'One fifth last', 'dm3-shortcodes' ), 'value' => 'one_fifth_last' ),
            array( 'label' => __( 'One sixth', 'dm3-shortcodes' ), 'value' => 'one_sixth' ),
            array( 'label' => __( 'One sixth last', 'dm3-shortcodes' ), 'value' => 'one_sixth_last' ),
            array( 'label' => __( 'Two third', 'dm3-shortcodes' ), 'value' => 'two_third' ),
            array( 'label' => __( 'Two third last', 'dm3-shortcodes' ), 'value' => 'two_third_last' ),
            array( 'label' => __( 'Three fourth', 'dm3-shortcodes' ), 'value' => 'three_fourth' ),
            array( 'label' => __( 'Three fourth last', 'dm3-shortcodes' ), 'value' => 'three_fourth_last' ),
            array( 'label' => __( 'Two fifth', 'dm3-shortcodes' ), 'value' => 'two_fifth' ),
            array( 'label' => __( 'Two fifth last', 'dm3-shortcodes' ), 'value' => 'two_fifth_last' ),
            array( 'label' => __( 'Three fifth', 'dm3-shortcodes' ), 'value' => 'three_fifth' ),
            array( 'label' => __( 'Three fifth last', 'dm3-shortcodes' ), 'value' => 'three_fifth_last' ),
            array( 'label' => __( 'Four fifth', 'dm3-shortcodes' ), 'value' => 'four_fifth' ),
            array( 'label' => __( 'Four fifth last', 'dm3-shortcodes' ), 'value' => 'four_fifth_last' ),
            array( 'label' => __( 'Five sixth', 'dm3-shortcodes' ), 'value' => 'five_sixth' ),
            array( 'label' => __( 'Five sixth last', 'dm3-shortcodes' ), 'value' => 'five_sixth_last' )
          )
        ),
        'content' => array(
          'type' => 'textarea',
          'label' => __( 'Content', 'dm3-shortcodes' )
        )
      ),
      'shortcode' => '[dm3_@size]@content[/dm3_@size]',
      'addButtonLabel' => __( 'Add another column', 'dm3-shortcodes' )
    ),
    'shortcode' => '@child_shortcode'
  ),

  // BUTTON
  array(
    'label' => __( 'Button', 'dm3-shortcodes' ),
    'options' => array(
      'url' => array(
        'type' => 'text',
        'label' => __( 'URL', 'dm3-shortcodes' )
      ),
      'label' => array(
        'type' => 'text',
        'label' => __( 'Label', 'dm3-shortcodes' )
      ),
      'size' => array(
        'type' => 'select',
        'label' => __( 'Size', 'dm3-shortcodes' ),
        'options' => array(
          array( 'label' => __( 'Small', 'dm3-shortcodes' ), 'value' => 'small' ),
          array( 'label' => __( 'Medium', 'dm3-shortcodes' ), 'value' => 'medium', 'selected' => true ),
          array( 'label' => __( 'Large', 'dm3-shortcodes' ), 'value' => 'large' )
        )
      ),
      'target' => array(
        'type' => 'select',
        'label' => __( 'Target', 'dm3-shortcodes' ),
        'options' => array(
          array( 'label' => __( '_self', 'dm3-shortcodes' ), 'value' => '_self' ),
          array( 'label' => __( '_blank', 'dm3-shortcodes' ), 'value' => '_blank' )
        )
      ),
      'color' => array(
        'type' => 'select',
        'label' => __( 'Color', 'dm3-shortcodes' ),
        'options' => array(
          array( 'label' => __( 'Default', 'dm3-shortcodes' ), 'value' => 'default' ),
          array( 'label' => __( 'Blue', 'dm3-shortcodes' ), 'value' => 'blue' ),
          array( 'label' => __( 'Light blue', 'dm3-shortcodes' ), 'value' => 'light-blue' ),
          array( 'label' => __( 'Red', 'dm3-shortcodes' ), 'value' => 'red' ),
          array( 'label' => __( 'Orange', 'dm3-shortcodes' ), 'value' => 'orange' ),
          array( 'label' => __( 'Gold', 'dm3-shortcodes' ), 'value' => 'gold' ),
          array( 'label' => __( 'Purple', 'dm3-shortcodes' ), 'value' => 'purple' )
        )
      )
    ),
    'shortcode' => '[dm3_button url="@url" color="@color" size="@size" target="@target"]@label[/dm3_button]'
  ),

  // TABS
  array(
    'label' => __( 'Tabs', 'dm3-shortcodes' ),
    'options' => array(
      'type' => array(
        'type' => 'select',
        'label' => __( 'Type', 'dm3-shortcodes' ),
        'options' => array(
          array( 'label' => __( 'Horizontal', 'dm3-shortcodes' ), 'value' => 'horizontal' ),
          array( 'label' => __( 'Vertical (nav left)', 'dm3-shortcodes' ), 'value' => 'vertical_left' ),
          array( 'label' => __( 'Vertical (nav right)', 'dm3-shortcodes' ), 'value' => 'vertical_right' )
        )
      )
    ),
    'child_shortcode' => array(
      'options' => array(
        'label' => array(
          'type' => 'text',
          'label' => __( 'Label', 'dm3-shortcodes' )
        ),
        'content' => array(
          'type' => 'textarea',
          'label' => __( 'Content', 'dm3-shortcodes' )
        )
      ),
      'shortcode' => '[dm3_tab label="@label"]@content[/dm3_tab]',
      'addButtonLabel' => __( 'Add another tab', 'dm3-shortcodes' )
    ),
    'shortcode' => '[dm3_tabs type="@type"]@child_shortcode[/dm3_tabs]'
  ),

  // TOGGLE
  array(
    'label' => __( 'Toggle', 'dm3-shortcodes' ),
    'options' => array(
      'label' => array(
        'type' => 'text',
        'label' => __( 'Label', 'dm3-shortcodes' )
      ),
      'content' => array(
        'type' => 'textarea',
        'label' => __( 'Content', 'dm3-shortcodes' )
      ),
      'state' => array(
        'type' => 'select',
        'label' => __( 'State', 'dm3-shortcodes' ),
        'options' => array(
          array( 'label' => __( 'Closed', 'dm3-shortcodes' ), 'value' => 'closed' ),
          array( 'label' => __( 'Open', 'dm3-shortcodes' ), 'value' => 'open' )
        )
      )
    ),
    'shortcode' => '[dm3_collapse label="@label" state="@state"]@content[/dm3_collapse]'
  ),

  // ACCORDION
  array(
    'label' => __( 'Accordion', 'dm3-shortcodes' ),
    'child_shortcode' => array(
      'options' => array(
        'label' => array(
          'type' => 'text',
          'label' => __( 'Label', 'dm3-shortcodes' )
        ),
        'content' => array(
          'type' => 'textarea',
          'label' => __( 'Content', 'dm3-shortcodes' )
        ),
        'state' => array(
          'type' => 'select',
          'label' => __( 'State', 'dm3-shortcodes' ),
          'options' => array(
            array( 'label' => __( 'Closed', 'dm3-shortcodes' ), 'value' => 'closed' ),
            array( 'label' => __( 'Open', 'dm3-shortcodes' ), 'value' => 'open' )
          )
        )
      ),
      'shortcode' => '[dm3_collapse label="@label" state="@state"]@content[/dm3_collapse]',
      'addButtonLabel' => __( 'Add another item', 'dm3-shortcodes' )
    ),
    'shortcode' => '[dm3_accordion]@child_shortcode[/dm3_accordion]'
  ),

  // ALERTS
  array(
    'label' => __( 'Alert box', 'dm3-shortcodes' ),
    'options' => array(
      'type' => array(
        'type' => 'select',
        'label' => __( 'Type', 'dm3-shortcodes' ),
        'options' => array(
          array( 'label' => __( 'Warning', 'dm3-shortcodes' ), 'value' => 'warning' ),
          array( 'label' => __( 'Info', 'dm3-shortcodes' ), 'value' => 'info' ),
          array( 'label' => __( 'Success', 'dm3-shortcodes' ), 'value' => 'success' ),
          array( 'label' => __( 'Error', 'dm3-shortcodes' ), 'value' => 'error' )
        )
      ),
      'content' => array(
        'type' => 'textarea',
        'label' => __( 'Content', 'dm3-shortcodes' )
      )
    ),
    'shortcode' => '[dm3_alert type="@type"]@content[/dm3_alert]'
  ),

  // DIVIDER
  array(
    'label' => __( 'Divider', 'dm3-shortcodes' ),
    'options' => array(
      'style' => array(
        'type' => 'select',
        'label' => __( 'Style', 'dm3-shortcodes' ),
        'options' => array(
          array( 'label' => __( 'Normal', 'dm3-shortcodes' ), 'value' => 'normal' ),
          array( 'label' => __( 'Dotted', 'dm3-shortcodes' ), 'value' => 'dotted' ),
          array( 'label' => __( 'Space', 'dm3-shortcodes' ), 'value' => 'space' )
        )
      )
    ),
    'shortcode' => '[dm3_divider style="@style"/]'
  ),

  // TEAM MEMBER
  array(
    'label' => __( 'Team member', 'dm3-shortcodes' ),
    'options' => array(
      'image' => array(
        'type' => 'text',
        'label' => __( 'Image', 'dm3-shortcodes' )
      ),
      'name' => array(
        'type' => 'text',
        'label' => __( 'Name', 'dm3-shortcodes' )
      ),
      'title' => array(
        'type' => 'text',
        'label' => __( 'Title', 'dm3-shortcodes' )
      ),
      'description' => array(
        'type' => 'textarea',
        'label' => __( 'Description', 'dm3-shortcodes' )
      ),
      'twitter' => array(
        'type' => 'text',
        'label' => __( 'Twitter URL', 'dm3-shortcodes' )
      ),
      'facebook' => array(
        'type' => 'text',
        'label' => __( 'Facebook URL', 'dm3-shortcodes' )
      ),
      'skype' => array(
        'type' => 'text',
        'label' => __( 'Skype', 'dm3-shortcodes' )
      ),
      'email' => array(
        'type' => 'text',
        'label' => __( 'Email', 'dm3-shortcodes' )
      )
    ),
    'shortcode' => '[dm3_team_member image="@image" name="@name" title="@title" twitter="@twitter" facebook="@facebook" skype="@skype" email="@email"]@description[/dm3_team_member]'
  ),

  // ICONS
  array(
    'label' => __( 'Icons', 'dm3-shortcodes' ),
    'shortcodes' => array(
      // Inline icon
      array(
        'label' => __( 'Inline icon', 'dm3-shortcodes' ),
        'options' => array(
          'icon' => array(
            'type' => 'boxes',
            'label' => __( 'Icon', 'dm3-shortcodes' ),
            'defaultCss' => array(
              'display' => 'inline-block',
              'margin' => '0 0 5px 5px',
              'width' => '30px',
              'height' => '30px',
              'backgroundColor' => '#eee',
              'fontFamily' => 'fontAwesome',
              'textAlign' => 'center',
              'lineHeight' => '30px',
              'textDecoration' => 'none',
              'color' => '#555'
            ),
            'activeCss' => array(
              'backgroundColor' => '#ddd'
            ),
            'options' => $font_icons
          )
        ),
        'shortcode' => '[dm3_icon icon="@icon"/]'
      ),
      // Box icon
      array(
        'label' => __( 'Box icon', 'dm3-shortcodes' ),
        'options' => array(
          'icon' => array(
            'type' => 'boxes',
            'label' => __( 'Icon', 'dm3-shortcodes' ),
            'defaultCss' => array(
              'display' => 'inline-block',
              'margin' => '0 0 5px 5px',
              'width' => '30px',
              'height' => '30px',
              'backgroundColor' => '#eee',
              'fontFamily' => 'fontAwesome',
              'textAlign' => 'center',
              'lineHeight' => '30px',
              'textDecoration' => 'none',
              'color' => '#555'
            ),
            'activeCss' => array(
              'backgroundColor' => '#ddd'
            ),
            'options' => $font_icons
          ),
          'style' => array(
            'type' => 'select',
            'label' => __( 'Style', 'dm3-shortcodes' ),
            'options' => array(
              array( 'label' => __( 'Center', 'dm3-shortcodes' ), 'value' => 'center' ),
              array( 'label' => __( 'Left', 'dm3-shortcodes' ), 'value' => 'left' )
            )
          ),
          'content' => array(
            'type' => 'textarea',
            'label' => __( 'Content', 'dm3-shortcodes' )
          ),
        ),
        'shortcode' => '[dm3_box_icon icon="@icon" style="@style"]@content[/dm3_box_icon]'
      )
    )
  ),

  // PRICE TABLE
  array(
    'label' => __( 'Price table', 'dm3-shortcodes' ),
    'max' => 5,
    'child_shortcode' => array(
      'options' => array(
        'title' => array(
          'type' => 'text',
          'label' => __( 'Title', 'dm3-shortcodes' )
        ),
        'price' => array(
          'type' => 'text',
          'label' => __( 'Price', 'dm3-shortcodes' )
        ),
        'per' => array(
          'type' => 'text',
          'label' => __( 'Per', 'dm3-shortcodes' )
        ),
        'options' => array(
          'type' => 'textarea',
          'label' => __( 'Options', 'dm3-shortcodes' )
        ),
        'url' => array(
          'type' => 'text',
          'label' => __( 'URL', 'dm3-shortcodes' )
        ),
        'buttontext' => array(
          'type' => 'text',
          'label' => __( 'Button text', 'dm3-shortcodes' )
        ),
        'buttonclass' => array(
          'type' => 'text',
          'label' => __( 'Custom CSS class for the button', 'dm3-shortcodes' )
        ),
        'style' => array(
          'type' => 'select',
          'label' => __( 'Style', 'dm3-shortcodes' ),
          'options' => array(
            array( 'label' => __( 'Default', 'dm3-shortcodes' ), 'value' => 'default' ),
            array( 'label' => __( 'Featured', 'dm3-shortcodes' ), 'value' => 'featured' )
          )
        )
      ),
      'shortcode' => '[dm3_price_column title="@title" price="@price" per="@per" url="@url" style="@style" buttontext="@buttontext" buttonclass="@buttonclass"]@options[/dm3_price_column]',
      'addButtonLabel' => __( 'Add another column', 'dm3-shortcodes' )
    ),
    'shortcode' => '[dm3_price_table]@child_shortcode[/dm3_price_table]'
  ),

  // TESTIMONIALS
  array(
    'label' => __( 'Testimonials', 'dm3-shortcodes' ),
    'options' => array(
      'autoscroll' => array(
        'type' => 'text',
        'label' => __( 'Autoscroll in seconds', 'dm3-shortcodes' ),
        'value' => 0
      )
    ),
    'child_shortcode' => array(
      'options' => array(
        'testimonial' => array(
          'type' => 'textarea',
          'label' => __( 'Testimonial', 'dm3-shortcodes' )
        ),
        'authorname' => array(
          'type' => 'text',
          'label' => __( 'Author name', 'dm3-shortcodes' )
        ),
        'authordescription' => array(
          'type' => 'text',
          'label' => __( 'Author description', 'dm3-shortcodes' )
        ),
        'authorwebsite' => array(
          'type' => 'text',
          'label' => __( 'Author website', 'dm3-shortcodes' )
        )
      ),
      'shortcode' => '[dm3_testimonial authorname="@authorname" authordescription="@authordescription" authorwebsite="@authorwebsite"]@testimonial[/dm3_testimonial]',
      'addButtonLabel' => __( 'Add another testimonial', 'dm3-shortcodes' )
    ),
    'shortcode' => '[dm3_testimonials autoscroll="@autoscroll"]@child_shortcode[/dm3_testimonials]'
  ),

  // CAROUSEL
  array(
    'label' => __( 'Carousel', 'dm3-shortcodes' ),
    'shortcodes' => array(
      // POSTS CAROUSEL
      array(
        'label' => __( 'Posts carousel', 'dm3-shortcodes' ),
        'options' => array(
          'post_type' => array(
            'type' => 'select',
            'label' => __( 'Post type', 'dm3-shortcodes' ),
            'options' => $post_types
          ),
          'category' => array(
            'type' => 'select',
            'label' => __( 'Category', 'dm3-shortcodes' ),
            'options' => array()
          ),
          'amount' => array(
            'type' => 'text',
            'label' => __( 'Number of posts', 'dm3-shortcodes' ),
            'value' => 8
          ),
          'excerptlength' => array(
            'type' => 'text',
            'label' => __( 'Excerpt length', 'dm3-shortcodes' ),
            'value' => 55
          )
        ),
        'shortcode' => '[dm3_posts_carousel posttype="@post_type" category="@category" amount="@amount" excerptlength="@excerptlength" /]',
        'callback' => '
          var select_post_type = form_el.find("select[name=post_type]");

          select_post_type.on("change", function() {
            jQuery.ajax({
              type: "post",
              url: ajaxurl,
              cache: false,
              dataType: "json",
              data: {
                action: "dm3sc_get_taxonomies",
                post_type: select_post_type.val()
              },
              success: function(response) {
                var select_category = form_el.find("select[name=category]").html("");

                select_category.append("<option value=\"\">' . __( 'Any category', 'dm3-shortcodes' ) . '</option>");

                $.each(response, function() {
                  select_category.append("<option value=\"" + this.value + "\">" + this.label + "</option>");
                });
              }
            });
          });
        '
      ),

      // CLIENTS CAROUSEL
      array(
        'label' => __( 'Clients carousel', 'dm3-shortcodes' ),
        'child_shortcode' => array(
          'options' => array(
            'imageurl' => array(
              'type' => 'text',
              'label' => __( 'Image URL', 'dm3-shortcodes' )
            ),
            'clienturl' => array(
              'type' => 'text',
              'label' => __( 'Client URL', 'dm3-shortcodes' )
            ),
            'title' => array(
              'type' => 'text',
              'label' => __( 'Title', 'dm3-shortcodes' )
            )
          ),
          'shortcode' => '[dm3_client clienturl="@clienturl" title="@title"]@imageurl[/dm3_client]',
          'addButtonLabel' => __( 'Add client', 'dm3-shortcodes' )
        ),
        'shortcode' => '[dm3_clients]@child_shortcode[/dm3_clients]'
      )
    )
  ),

  // GOOGLE MAP
  array(
    'label' => __( 'Google map', 'dm3-shortcodes' ),
    'options' => array(
      'address' => array(
        'type' => 'text',
        'label' => __( 'Address', 'dm3-shortcodes' )
      ),
      'height' => array(
        'type' => 'text',
        'label' => __( 'Height (in pixels)', 'dm3-shortcodes' )
      )
    ),
    'shortcode' => '[dm3_google_map address="@address" height="@height" /]'
  ),

  // BOX
  array(
    'label' => __( 'Box', 'dm3-shortcodes' ),
    'options' => array(
      'content' => array(
        'type' => 'textarea',
        'label' => __( 'Content', 'dm3-shortcodes' )
      )
    ),
    'shortcode' => '[dm3_box]@content[/dm3_box]'
  )
);

$shortcodes = apply_filters( 'dm3sc_shortcodes_config', $shortcodes );
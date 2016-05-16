<?php
if ( ! defined( 'TEMPLATEPATH' ) ) {exit();}

$page_bg = dm3_option( 'page_bg' );
$colors = dm3_get_colors();
$default_color = 'blue2';
$selected_color = dm3_option( 'color_scheme', $default_color );

if ( isset( $colors[$selected_color] ) ) {
  $color = $colors[$selected_color];
} else {
  $color = $colors[$default_color];
}

foreach ( $color as $c_name => $c_value ) {
  $replace_color = dm3_option( 'c_' . $c_name, '' );

  if ( $replace_color ) {
    $color[$c_name] = $replace_color;
  }
}

$custom_css = '
#site-bg {
  background-image: url("' . esc_url( $page_bg ) . '");
}

a {
  color: ' . $color['primary'] . ';
  -webkit-transition: color 0.2s;
  transition: color 0.2s;
}

a:hover {
  color: ' . $color['link_hover'] . ';
}

.nav-desktop .current-menu-item > a,
.nav-desktop .current-menu-ancestor > a,
#search-trigger.active span,
.dm3-member-social a:hover,
.post-meta a:hover,
.post-short .post-header a:hover,
.sidebar li a:hover,
.comment-meta a:hover,
.comment-reply-link:hover,
.dm3-box-icon-left .dm3-box-icon-icon span,
.flexslider-posts .description h2 a:hover,
.dm3-box-icon-center .dm3-box-icon-icon span {
  color: ' . $color['primary'] . ';
}

#site-nav,
.nav-desktop ul {
  border-top-color: ' . $color['primary'] . ';
}

#nav-pointer {
  border-color: ' . $color['primary'] . ' transparent transparent transparent;
}

.flex-prev span {
  border-color: transparent ' . $color['primary'] . ' transparent transparent;
}

.flex-next span {
  border-color: transparent transparent transparent ' . $color['primary'] . ';
}

#header-toolbar,
body .flex-control-nav .flex-active,
.dm3-gallery-popover .icon,
.dm3-tabs-testimonials .dm3-tabs-nav .active a,
.dm3-widgets-contacts .icon > div,
#header-search button {
  background-color: ' . $color['primary'] . ';
}

.dm3-gallery-terms a:hover,
.dm3-gallery-terms .active a,
.posts-navigation a:hover,
.pager > a:hover,
.pager > span,
.page-links a:hover {
  color: ' . $color['primary'] . ';
  border-color: ' . $color['primary'] . ';
}

/* Buttons */
.dm3-btn-primary,
input#submit,
.wpcf7-submit {
  background-color: ' . $color['btn_bg'] . ';
  background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, ' . $color['btn_grad_top'] . '), color-stop(100%, ' . $color['btn_grad_btm'] . '));
  background-image: -moz-linear-gradient(top, ' . $color['btn_grad_top'] . ' 0%, ' . $color['btn_grad_btm'] . ' 100%);
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="' . $color['btn_grad_top'] . '", endColorstr="' . $color['btn_grad_btm'] . '",GradientType=0);
  border: 1px solid ' . $color['btn_border'] . ';
  border-top: 1px solid ' . $color['btn_border_top'] . ';
  color: ' . $color['btn_color'] . ';
  text-shadow: 0 -1px 1px ' . $color['btn_text_shadow'] . ';
  box-shadow: inset 0 1px 0 0 ' . $color['btn_box_shadow_in'] . ', 0 1px 5px ' . $color['btn_box_shadow_out'] . ';
}

.dm3-btn-primary:active,
input#submit:active,
.wpcf7-submit:active {
  border: 1px solid ' . $color['btn_hover_border'] . ';
  box-shadow: inset 0 0 8px 2px ' . $color['btn_hover_box_shadow_in'] . ', 0 1px 0 0 ' . $color['btn_hover_box_shadow_out'] . ';
}

.dm3-btn-primary:hover {
  color: ' . $color['btn_hover_color'] . ';
}
';

wp_add_inline_style( 'style', $custom_css );
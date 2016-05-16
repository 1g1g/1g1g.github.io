<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title><?php wp_title( '|', true, 'right' ); ?></title>
  <link rel="profile" href="http://gmpg.org/xfn/11" />
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
  <!--[if lt IE 9]>
  <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
  <![endif]-->
  <?php wp_head(); ?>
</head>
<?php
$body_class = '';

if ( dm3_option( 'enable_ajax', 0 ) ) {
  $body_class = 'ajax-enabled';
}
?>
<body <?php body_class( $body_class ); ?>>
<div id="site-bg"></div>
<div id="site-bg-overlay"></div>

<?php if ( dm3_option( 'show_header_toolbar', 0 ) ) { ?>
<!-- Header toolbar -->
<section id="header-toolbar">
  <div id="header-toolbar-inner">
    <?php
    $email = dm3_option( 'email', '' );
    $phone = dm3_option( 'phone', '' );
    $address = dm3_option( 'address', '' );

    if ( $email || $phone || $address ) {
    ?>
    <ul class="header-contact">
      <?php if ( $address ) { ?>
      <li class="contact-address">
        <div class="icon"><span class="font-icon-home"></span></div>
        <div class="contact-value">
          <?php echo $address; ?>
        </div>
      </li>
      <?php } ?>

      <?php if ( $phone ) { ?>
      <li class="dm3-contact-phone">
        <div class="icon"><span class="font-icon-phone"></span></div>
        <div class="contact-value">
          <?php echo $phone; ?>
        </div>
      </li>
      <?php } ?>

      <?php if ( $email ) { ?>
      <li class="contact-web">
        <div class="icon"><span class="font-icon-envelope"></span></div>
        <div class="contact-value">
          <?php echo '<a href="mailto:' . $email . '">' . $email . '</a>'; ?>
        </div>
      </li>
      <?php } ?>
    </ul>
    <?php } ?>

    <?php
    $social_nets_html = '';
    $social_nets = array(
      'facebook' => 'facebook',
      'twitter' => 'twitter',
      'gplus' => 'google-plus',
      'linkedin' => 'linkedin',
      'skype' => 'skype',
      'youtube' => 'youtube',
      'vimeo' => 'vimeo',
      'rss' => 'rss'
    );

    foreach ( $social_nets as $sn => $icon ) {
      $sn_url = dm3_option( $sn );

      if ( $sn_url ) {
        $sn_title = dm3_option( $sn . '_title', '' );

        if ( $sn_title ) {
          $sn_title = ' title="' . esc_attr( $sn_title ) . '"';
        }

        $social_nets_html .= '<li><a href="' . esc_url( $sn_url ) . '"' . $sn_title . ' target="_blank"><span class="font-icon-' . esc_attr( $icon ) . '"></span></a></li>';
      }
    }

    if ( $social_nets_html ) {
      echo '<ul class="header-social">' . $social_nets_html . '</ul>';
    }
    ?>
  </div>
</section>
<?php } ?>

<!-- Logo and nav -->
<section id="site-nav">
  <div id="header-inner">
    <?php
    $logo_url = dm3_option( 'header_logo', '' );
    ?>
    <div id="logo">
      <a class="ajax-link" href="<?php echo home_url(); ?>"><img src="<?php echo esc_url( $logo_url ); ?>" alt=""></a>
      <div id="ajax-preloader"></div>
    </div>

    <a id="search-trigger" href="#"><span class="font-icon-search"></span></a>

    <nav id="nav-container">
      <a id="mobile-nav-trigger" href="#"><span class="font-icon-reorder"></span></a>
      <?php if ( has_nav_menu( 'primary' ) ) { ?>
        <?php
        wp_nav_menu(
          array(
            'container' => false,
            'theme_location' => 'primary',
            'menu_id' => 'nav',
            'menu_class' => 'nav-desktop'
          )
        );
        ?>
      <?php } ?>
    </nav>

    <div id="nav-pointer"></div>
  </div>
</section>

<section class="dm3-scroller">
  <div class="dm3-scroller-inner">
    <div class="content">
      <div class="content-inner">
        <?php
        $is_search = is_search();
        ?>
        <section id="header-search" class="with-separator<?php echo ( ! $is_search ) ? ' hidden' : ''; ?>">
          <form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <div><input type="text" name="s" placeholder="<?php _e( 'Search...', 'dm3_fwk' ); ?>" value="<?php if ( $is_search ) {echo get_search_query();} ?>"></div>
            <div><button type="submit" title="Search"><span class="font-icon-search"></span></button></div>
          </form>
        </section>
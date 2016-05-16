<?php

if ( isset( $post_id ) && is_numeric( $post_id ) && $post_id > 0 ) {
  $media_items = Dm3Media::getPostMedia( $post_id );
}

if ( count( $media_items ) < 2 ) {return;}

$autoscroll = isset( $custom['dm3_fwk_slideshow_interval'] ) ? intval( $custom['dm3_fwk_slideshow_interval'][0] ) : 0;

$slider_args = '';

if ( $args['w'] && $args['h'] ) {
  $slider_args = 'data-slideWidth="' . $args['w'] . '" data-slideHeight="' . $args['h'] . '"';
}

echo $args['before'];
?>

<div id="dm3-rs" class="dm3-rs"<?php echo $slider_args; ?> data-autoscroll="<?php echo $autoscroll; ?>">
  <div class="dm3-rs-slides">
    <ul>
    <?php
    foreach( $media_items as $media_item ) {
      $media_type = Dm3Media::getMediaType( $media_item['src'] );
      $description = '';

      if ( $media_item['title'] != '' ) {
        $description .= '<div class="slide-title">' . htmlspecialchars( $media_item['title'] ) . '</div>';
      }

      if ( $media_item['description'] != '' ) {
        $description .= '<div class="slide-description">' . htmlspecialchars( $media_item['description'] ) . '</div>';
      }

      if ( $media_item['link'] != '' ) {
        $description .= '<div class="slide-link"><a href="' . esc_url( $media_item['link'] ) . '" target="_blank">' . __( 'Learn More &raquo;', 'dm3_fwk' ) . '</a></div>';
      }

      if ( $description != '' ) {
        $description = '<div class="slide-caption">' . $description . '</div>';
      }

      switch ( $media_type ) {
        case 'image':
          if ( $media_item['attachment_id'] ) {
            $src = wp_get_attachment_image_src( $media_item['attachment_id'], 'slider2' );

            if ( is_array( $src ) ) {
              $src = $src[0];
            }
          } else {
            $src = esc_url( $media_item['src'] );
          }
          ?>
          <li class="slide">
            <div class="slide-media">
              <?php
              echo '<img src="' . $src . '" alt="">';
              ?>
            </div>
            <?php echo $description; ?>
          </li>
          <?php
          break;
      }
    }
    ?>
    </ul>
  </div>

  <div class="shade-left"></div>
  <div class="shade-right"></div>
</div>
<?php
echo $args['after'];
?>
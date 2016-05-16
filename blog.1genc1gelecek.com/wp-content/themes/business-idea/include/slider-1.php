<?php

if ( isset( $post_id ) && is_numeric( $post_id ) && $post_id > 0 ) {
  $media_items = Dm3Media::getPostMedia( $post_id );
}

if ( count( $media_items ) < 1 ) {
  return;
}

$autoscroll = isset( $custom['dm3_fwk_slideshow_interval'] ) ? intval( $custom['dm3_fwk_slideshow_interval'][0] ) : 0;

echo $args['before'];
?>
<div class="flexslider loading" data-autoscroll="<?php echo $autoscroll; ?>">
  <ul class="slides">
    <?php
    foreach( $media_items as $media_item ) {
      $media_type = Dm3Media::getMediaType( $media_item['src'] );
      $description = '';

      if ( $media_item['title'] != '' ) {
        $description .= '<h2>' . htmlspecialchars( $media_item['title'] ) . '</h2>';
      }

      if ( $media_item['description'] != '' ) {
        $description .= '<p>' . htmlspecialchars( $media_item['description'] ) . '</p>';
      }

      if ( $media_item['link'] != '' ) {
        $description .= '<a class="ajax-link" href="' . esc_url( $media_item['link'] ) . '" target="_blank">' . __( 'Learn More &raquo;', 'dm3_fwk' ) . '</a>';
      }

      if ( $description != '' ) {
        $description = '<div class="flexslider-caption">' . $description . '</div>';
      }

      switch ( $media_type ) {
        case 'image':
          $src = esc_url( $media_item['src'] );
          ?>
          <li>
            <img src="<?php echo $src; ?>" alt="">
            <?php echo $description; ?>
          </li>
          <?php
          break;

        case 'video':
          if ( $media_item['preview_image'] ) {
            ?>
            <li>
              <div class="media-popover">
                <img src="<?php echo esc_url( $media_item['preview_image'] ); ?>" alt="">
                <a class="dm3-gallery-popover popup-video" href="<?php echo esc_url( $media_item['src'] ); ?>">
                  <span class="icon"><i class="font-icon-play"></i></span>
                  <span class="bg"></span>
                </a>
              </div>

              <?php
              if ( $description ) {
                echo $description;
              }
              ?>
            </li>
            <?php
          } else {
            $video_html = '<div class="video-container">' . dm3_get_video( $media_item['src'] ) . '</div>';
            ?>
            <li>
              <?php
              echo $video_html;

              if ( $description ) {
                echo $description;
              }
              ?>
            </li>
            <?php
          }
          break;
      }
    }
    ?>
  </ul>
</div>
<?php
echo $args['after'];
?>
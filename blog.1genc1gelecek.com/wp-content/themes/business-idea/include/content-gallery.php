<?php
global $post;
$custom = get_post_custom( $post->ID );
$categories = wp_get_post_terms( $post->ID, 'gallery_cat', array( 'fields' => 'ids' ) );
$item_classes = 'portfolio-item';

if ( $categories ) {
  foreach ( $categories as $cat_id ) {
    $item_classes .= ' term-' . $cat_id;
  }
}
?>
<li class="<?php echo $item_classes; ?>">
  <div class="image">
    <?php
    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );

    if ( is_array( $image ) && isset( $image[0] ) ) {
      $image = $image[0];
    }

    $resized_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'gallery' );

    if ( is_array( $resized_image ) && isset( $resized_image[0] ) ) {
      $resized_image = $resized_image[0];
    }

    $video = '';

    if ( isset( $custom['dm3_fwk_video'] ) ) {
      $video = $custom['dm3_fwk_video'][0];
    }

    $featured_image_in_lightbox = 0;

    if ( isset( $custom['dm3_fwk_open_in_lightbox'] ) ) {
      $featured_image_in_lightbox = $custom['dm3_fwk_open_in_lightbox'][0];
    }
    ?>

    <?php if ( $image ) { ?>
      <img src="<?php echo esc_url( $resized_image ); ?>" width="470" height="320" alt="">

      <?php if ( $video ) { ?>
        <a class="dm3-gallery-popover mfp-iframe" href="<?php echo esc_url( $video ); ?>" title="<?php the_title(); ?>">
          <span class="icon"><i class="font-icon-play"></i></span>
          <span class="bg"></span>
        </a>
      <?php } else if ( $featured_image_in_lightbox == 1 ) { ?>
        <a class="dm3-gallery-popover mfp-image" href="<?php echo esc_url( $image ); ?>">
          <span class="icon"><i class="font-icon-picture"></i></span>
          <span class="bg"></span>
        </a>
      <?php } else { ?>
        <a class="dm3-gallery-popover dm3-gallery-popover-link" href="<?php the_permalink(); ?>">
          <span class="icon"><i class="font-icon-external-link"></i></span>
          <span class="bg"></span>
        </a>
      <?php } ?>
    <?php } else { ?>
      <div class="video-container">
        <?php echo dm3_get_video( $video ); ?>
      </div>
    <?php } ?>
  </div>

  <div class="description">
    <h2 class="title"><?php the_title(); ?></h2>
    <?php the_excerpt(); ?>
    <a class="read-more" href="<?php the_permalink(); ?>"><?php _e( 'Learn more &raquo;', 'dm3_fwk' ); ?></a>
  </div>
</li>
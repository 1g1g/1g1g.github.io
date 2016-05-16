<?php
global $post;
$custom = get_post_custom( $post->ID );
$layout = isset( $custom['dm3_fwk_gallery_layout'] ) ? $custom['dm3_fwk_gallery_layout'][0] : 'gallery_top';
$has_slideshow = false;
$post_image = '';

if ( isset( $custom['dm3_fwk_slideshow'] ) && $custom['dm3_fwk_slideshow'][0] != 'none' ) {
  $has_slideshow = true;
}

if ( ! $has_slideshow ) {
  $video = '';

  if ( isset( $custom['dm3_fwk_video'] ) ) {
    $video = $custom['dm3_fwk_video'][0];
  }

  if ( has_post_thumbnail() ) {
    $post_image = '<img src="' . esc_url( wp_get_attachment_url( get_post_thumbnail_id() ) ) . '" alt="">';

    if ( $video ) {
      $post_image = '<div class="media-popover">' . $post_image . '<a class="dm3-gallery-popover popup-video" href="' . esc_url( $video ) . '"><span class="icon"><i class="font-icon-play"></i></span><span class="bg"></span></a></div>';
    }
  } else if ( $video ) {
    $post_image = '<div class="video-container">' . dm3_get_video( $video ) . '</div>';
  }
}

$terms = get_the_terms( $post->ID, 'gallery_cat' );
?>

<?php get_header(); ?>

<section id="content-header">
  <div class="container clearfix">
    <div class="sixteen columns">
      <h1><?php the_title(); ?></h1>
      <?php echo dm3_page_subtitle( $custom ); ?>
    </div>
  </div>
</section>

<?php if ( $terms ) { ?>
<section id="header-page-meta">
  <div class="container clearfix">
    <div class="sixteen columns">
      <?php
      echo '<span>' . __( 'Tags: ', 'dm3_fwk' ) . '</span>';

      foreach ( $terms as $term ) {
        echo '<strong>' . $term->name . '</strong>';
      }
      ?>
    </div>
  </div>
</section>
<?php } ?>

<?php
if ( $layout == 'gallery_top' ) {
  if ( $has_slideshow ) {
    dm3_include_slideshow( $post->ID, $custom, array(
      'before' => '<section class="section section-bg"><div class="container clearfix"><div class="sixteen columns">',
      'after' => '</div></div></section>'
    ) );
  } else if ( $post_image ) {
    echo '<section class="section section-bg"><div class="container clearfix"><div class="sixteen columns"><div class="post-media">' . $post_image . '</div></div></div></section>';
  }
}
?>

<section class="section">
  <div class="container clearfix">
    <?php if ( $layout == 'gallery_top' ) { ?>
    <div class="sixteen columns">
      <?php if ( have_posts() ): ?>
        <?php while ( have_posts() ): the_post(); ?>
          <article id="post-<?php the_ID(); ?>" <?php post_class( 'portfolio-post' ); ?>>
          <?php get_template_part( 'include/content', 'single-gallery' ); ?>
          </article>
        <?php endwhile; ?>
      <?php endif; ?>
    </div>
    <?php } else { ?>
      <div class="sixteen columns">
        <article id="post-<?php the_ID(); ?>" <?php post_class( 'portfolio-post' ); ?>>
          <div class="dm3-two-third">
          <?php
          if ( $has_slideshow ) {
            dm3_include_slideshow( $post->ID, $custom );
          } else {
            echo $post_image;
          }
          ?>
          </div>

          <div class="dm3-one-third dm3-column-last">
            <?php if ( have_posts() ): ?>
              <?php while ( have_posts() ): the_post(); ?>
                <?php get_template_part( 'include/content', 'single-gallery' ); ?>
              <?php endwhile; ?>
            <?php endif; ?>
          </div>

          <div class="clear"></div>
        </article>
      </div>
    <?php } ?>

    <div class="posts-navigation sixteen columns">
      <?php previous_post_link( '%link', '&laquo; %title' ); ?>
      <?php next_post_link( '%link', '%title &raquo;' ); ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>
<?php
global $post;
$custom = get_post_custom( $post->ID );
$is_single = is_single();
$class = '';

if ( ! $is_single ) {
  $class = 'post-short';
} else {
  $class = 'post-full';
}

if ( ! $is_single ) {
  if ( dm3_option( 'posts_layout', 'layout1' ) == 'layout1' ) {
    $class .= ' post-layout1';
  } else {
    $class .= ' post-layout2';
  }
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $class ); ?>>
  <?php
  if ( ! $is_single ) {
    echo dm3_post_meta();
  }
  ?>
	
	<?php if ( ! $is_single && has_post_thumbnail() ) { ?>
  <section class="post-media">
    <a class="ajax-link" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'blog' ); ?></a>
  </section>
  <?php } ?>
	
	<?php if ( $is_single ) { ?>
    <header class="post-header">
      <h1><?php the_title(); ?></h1>
    </header>
    <?php echo dm3_post_meta(); ?>
    <?php if ( ! ( isset( $custom['dm3_fwk_slideshow'] ) && $custom['dm3_fwk_slideshow'][0] != 'none' ) && has_post_thumbnail() ) { ?>
      <section class="post-media">
        <?php the_post_thumbnail( 'slider1' ); ?>
      </section>
    <?php } ?>
	<?php } else { ?>
    <header class="post-header">
      <h2>
        <a class="ajax-link" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'dm3_fwk' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
      </h2>
    </header>
	<?php } ?>

  <section class="post-content">
  	<?php if ( is_search() ) { ?>
  	<div class="entry-summary">
  		<?php the_excerpt(); ?>
  	</div>
  	<?php } else { ?>
  		<?php
  		if ( ! $is_single ) {
    		if ( is_page_template( 'blog.php' ) ) {
          global $more;
          $more = 0;
        }
        
    		the_content( __( 'Read more &raquo;', 'dm3_fwk' ) );
      } else {
        the_content( '', true );
      }

      wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'dm3_fwk' ), 'after' => '</div>' ) );
  		?>
  	<?php } ?>
	</section>
</article>
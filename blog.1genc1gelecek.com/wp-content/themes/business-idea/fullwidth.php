<?php
/**
 * Template Name: Full width
 */
?>

<?php
global $post;
$custom = get_post_custom( $post->ID );
?>

<?php get_header(); ?>

<?php if ( ! isset( $custom['dm3_fwk_hide_page_title'] ) || $custom['dm3_fwk_hide_page_title'][0] != 1 ) { ?>
<section id="content-header">
  <div class="container clearfix">
    <div class="sixteen columns">
      <h1><?php the_title(); ?></h1>
      <?php echo dm3_page_subtitle( $custom ); ?>
    </div>
  </div>
</section>
<?php } ?>

<?php
dm3_include_slideshow( $post->ID, $custom, array(
  'before' => '<section class="section section-bg"><div class="container clearfix"><div class="sixteen columns">',
  'after' => '</div></div></section>'
) );
?>

<section class="section">
  <div class="container clearfix">
    <div class="sixteen columns">
      <?php if ( have_posts() ): ?>
        <?php while ( have_posts() ): the_post(); ?>
          <?php get_template_part( 'include/content', 'page' ); ?>
        <?php endwhile; ?>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>
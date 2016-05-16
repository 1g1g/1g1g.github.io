<?php
global $post;
$custom = get_post_custom( $post->ID );
?>

<?php get_header(); ?>

<section id="content-header">
  <div class="container clearfix">
    <div class="sixteen columns">
      <h1><?php _e( 'Blog', 'dm3_fwk' ); ?></h1>
      <?php echo dm3_page_subtitle( $custom ); ?>
    </div>
  </div>
</section>

<?php
dm3_include_slideshow( $post->ID, $custom, array(
  'before' => '<section class="section section-bg"><div class="container clearfix"><div class="sixteen columns">',
  'after' => '</div></div></section>'
) );
?>

<section class="section">
  <div class="container clearfix">
    <!-- Main content -->
    <div class="eleven columns">
      <?php if ( have_posts() ): ?>
        <?php while ( have_posts() ): the_post(); ?>
          <?php get_template_part( 'include/content', get_post_format() ); ?>
          <?php comments_template( '', true ); ?>
        <?php endwhile; ?>
      <?php endif; ?>
    </div>

    <!-- Sidebar -->
    <aside class="sidebar five columns">
      <div class="sidebar-inner">
        <?php get_sidebar(); ?>
      </div>
    </aside>
  </div>
</section>

<?php get_footer(); ?>
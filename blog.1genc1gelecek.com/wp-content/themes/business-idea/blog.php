<?php
/**
 * Template Name: Blog
 */
?>

<?php
global $post;
$custom = get_post_custom( $post->ID );
$args = array();
$args['posts_per_page'] = get_option( 'posts_per_page' );
$args['paged'] = get_query_var( 'paged' );
$loop = new WP_Query( $args );
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

  <section class="section">
    <div class="container clearfix">
      <!-- Main content -->
      <div class="eleven columns">
        <?php if ( $loop->have_posts() ): ?>
          <?php while ( $loop->have_posts() ): $loop->the_post(); ?>
            <?php get_template_part( 'include/content', get_post_format() ); ?>
          <?php endwhile; ?>

          <div class="pager">
          <?php
          $big = 999999999; // need an unlikely integer

          echo paginate_links( array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => max( 1, get_query_var('paged') ),
            'total' => $loop->max_num_pages
          ) );
          ?>
          </div>
        <?php endif; ?>
        <?php wp_reset_query(); ?>
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
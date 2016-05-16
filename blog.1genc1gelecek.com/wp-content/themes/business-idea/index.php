<?php get_header(); ?>

<section id="content-header">
  <div class="container clearfix">
    <div class="sixteen columns">
      <h1><?php
        if ( is_archive() ) {
          _e( 'Archive', 'dm3_fwk' );
        } else if ( is_search() ) {
          _e( 'Search', 'dm3_fwk' );
        } else {
          _e( 'Blog', 'dm3_fwk' );
        }
      ?></h1>
      <?php echo dm3_page_subtitle(); ?>
    </div>
  </div>
</section>

<section class="section">
  <div class="container clearfix">
    <!-- Main content -->
    <div class="eleven columns">
      <?php if ( have_posts() ): ?>
        <?php while ( have_posts() ): the_post(); ?>
          <?php get_template_part( 'include/content', get_post_format() ); ?>
        <?php endwhile; ?>
      <?php else: ?>
        <?php get_template_part( 'include/content', 'none' ); ?>
      <?php endif; ?>

      <div class="pager">
        <?php
        global $wp_query;

        $big = 999999999; // need an unlikely integer

        echo paginate_links( array(
          'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
          'format' => '?paged=%#%',
          'current' => max( 1, get_query_var('paged') ),
          'total' => $wp_query->max_num_pages
        ) );
        ?>
      </div>
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
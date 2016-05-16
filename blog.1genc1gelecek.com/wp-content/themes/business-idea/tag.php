<?php get_header(); ?>

<section id="content-header">
  <div class="container clearfix">
    <div class="sixteen columns">
      <h1><?php printf( __( 'Tag Archives: %s', 'dm3_fwk' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?></h1>

      <?php if ( tag_description() ): ?>
        <div class="page-description"><?php echo tag_description(); ?></div>
      <?php else: ?>
        <?php echo dm3_page_subtitle(); ?>
      <?php endif; ?>
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
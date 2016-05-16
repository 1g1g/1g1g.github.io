<?php get_header(); ?>

<?php
if ( get_option( 'show_on_front' ) === 'page' ) {
  global $post;
  $custom = get_post_custom( $post->ID );
  ?>

  <?php
  dm3_include_slideshow( $post->ID, $custom, array(
    'before' => '<section class="section section-bg"><div class="container clearfix"><div class="sixteen columns">',
    'after' => '</div></div></section>'
  ) );
  ?>

  <section class="section">
    <div class="container clearfix">
      <!-- Main content -->
      <div class="sixteen columns">
        <?php echo apply_filters( 'the_content', $post->post_content ); ?>
        <?php edit_post_link( __( 'Edit', 'dm3_fwk' ), '<span class="edit-link">', '</span>' ); ?>
      </div>
    </div>
  </section>
<?php } else { ?>
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
<?php } ?>

<?php get_footer(); ?>
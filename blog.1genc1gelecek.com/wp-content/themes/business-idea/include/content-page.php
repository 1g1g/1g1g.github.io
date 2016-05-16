<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php the_content(); ?>
</article>
<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __('Pages:', 'dm3_fwk'), 'after' => '</div>' ) ); ?>
<?php edit_post_link( __( 'Edit', 'dm3_fwk' ), '<span class="edit-link">', '</span>' ); ?>
<article id="post-0" class="entry post no-results not-found">
  <h2><?php _e( 'Nothing Found', 'dm3_fwk' ); ?></h2>

  <div class="entry-content">
    <p><?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'dm3_fwk' ); ?></p>
    <?php if ( ! is_search() ) {get_search_form();} ?>
  </div>
</article>
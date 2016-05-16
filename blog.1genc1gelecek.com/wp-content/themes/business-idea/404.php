<?php get_header(); ?>

<section id="content-header">
  <div class="container clearfix">
    <div class="sixteen columns">
      <h1><?php _e( 'Page Not Found', 'dm3_fwk' ); ?></h1>
    </div>
  </div>
</section>

<section class="section">
  <div class="container clearfix">
    <div class="post error404 no-results not-found sixteen columns">
      <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'dm3_fwk' ); ?></p>
    </div>

    <div class="nine columns">
      <?php get_search_form(); ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>
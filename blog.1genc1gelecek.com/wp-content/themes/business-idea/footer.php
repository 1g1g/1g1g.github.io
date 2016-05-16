        <!-- Footer -->
        <section id="footer">
          <div class="container clearfix">
            <?php if ( dm3_option( 'show_footer_widgets', 1 ) ) { ?>
            <div id="footer-widgets" class="clearfix">
              <div class="three columns">
                <?php dynamic_sidebar( 'theme-footer-1' ); ?>
              </div>

              <div class="three columns">
                <?php dynamic_sidebar( 'theme-footer-2' ); ?>
              </div>

              <div class="three columns">
                <?php dynamic_sidebar( 'theme-footer-3' ); ?>
              </div>

              <div class="five columns offset-by-two">
                <?php dynamic_sidebar( 'theme-footer-4' ); ?>
              </div>
            </div>
            <?php } ?>

            <div id="footer-bottom" class="clearfix">
              <div id="footer-copy">
                <?php echo dm3_option( 'copyright', 'Footer copyright notice' ); ?>
              </div>

              <a id="footer-back-to-top" href="#">&uarr; <?php _e( 'Top', 'dm3_fwk' ); ?></a>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</section>

<?php wp_footer(); ?>
</body>
</html>
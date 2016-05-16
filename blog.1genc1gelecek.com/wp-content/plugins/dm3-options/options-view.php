<?php
/**
 * Admin options template
 *
 * @package Dm3Options
 * @since Dm3Options 1.0
 * @version 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {exit();}
?>

<div class="wrap dm3-wrap">
  <?php if ( $dm3_options->isSaved() === true ): ?>
  <div id="dm3-message" class="updated"><p><?php _e( 'Changes have been saved.', 'dm3-options' ); ?></p></div>
  <?php endif; ?>

  <h2><?php echo __( 'Theme Options', 'dm3-options' ); ?></h2>

  <?php $dm3_options->showForm(); ?>

  <p id="dm3-form-footer">
    <input type="submit" class="button button-primary button-large dm3-options-save" value="<?php _e( 'Save changes', 'dm3-options' ); ?>" />
  </p>
</div>

<script type="text/javascript">
(function($) {
  $(document).ready(function() {
    $('input.dm3-options-save').click(function(e) {
      e.preventDefault();
      $('#dm3_form').submit();
    });
  });
}(jQuery));
</script>
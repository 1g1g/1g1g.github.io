<?php if ( count( $sidebars ) ) { ?>

<?php
// Add nonce field
wp_nonce_field( 'dm3sb_meta_box', 'dm3sb_meta_box_nonce' );
?>

<p>
  <label for="dm3sb_custom_sidebar"><strong><?php _e( 'Custom sidebar', 'dm3-sidebars' ); ?></strong></label>
</p>

<select name="dm3sb_custom_sidebar">
<option value=""><?php _e( 'Default', 'dm3-sidebars' ); ?></option>
<?php
foreach ( $sidebars as $sidebar ) {
  echo '<option value="' . htmlspecialchars( $sidebar ) . '"';

  if ( $sidebar == $current_sidebar ) {
    echo ' selected="selected"';
  }

  echo '>' . htmlspecialchars( $sidebar ) . '</option>';
}
?>
</select>
<?php } else { ?>
<p><?php echo sprintf( __( 'Please create custom sidebar in %s and refresh this page', 'dm3-sidebars' ), '<a href="themes.php?page=dm3sb_options_page" target="_blank">' . __( 'Appearance &raquo; Custom sidebars', 'dm3-sidebars' ) . '</a>' ); ?></p>
<?php } ?>
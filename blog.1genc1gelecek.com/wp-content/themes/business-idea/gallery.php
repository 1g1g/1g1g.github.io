<?php
/**
 * Template Name: Gallery
 */
?>

<?php
global $post;

// Get post custom fields
$custom = get_post_custom( $post->ID );
$gallery_columns = isset( $custom['dm3_fwk_columns'] ) ? intval( $custom['dm3_fwk_columns'][0] ) : 3;
$gallery_class = 'dm3-gallery dm3-gallery-' . $gallery_columns;

// Get posts
$args = array();
$args['post_type'] = 'gallery';
$args['posts_per_page'] = -1;

$loop = new WP_Query( $args );
?>

<?php get_header(); ?>

<?php if ( ! isset( $custom['dm3_fwk_hide_page_title'] ) || $custom['dm3_fwk_hide_page_title'][0] != 1 ) { ?>
<section id="content-header">
  <div class="container clearfix">
    <div class="sixteen columns">
      <h1><?php the_title(); ?></h1>
      <?php echo dm3_page_subtitle( $custom ); ?>
    </div>
  </div>
</section>
<?php } ?>

<section class="section">
  <div class="container clearfix">
    <div class="sixteen columns">
      <?php
      $categories = get_terms(
        array(
          'gallery_cat'
        ),
        'objects'
      );

      if ( $categories ) {
      ?>
      <ul class="dm3-gallery-terms">
        <li class="active"><a href="#" data-filter="*"><?php _e( 'All', 'dm3_fwk' ); ?></a></li>

        <?php
        foreach ( $categories as $c ) {
        ?>
        <li><a href="#" data-filter=".term-<?php echo esc_attr( $c->term_id ); ?>"><?php echo $c->name; ?></a></li>
        <?php
        }
        ?>
      </ul>
      <?php } ?>

      <?php
      if ( $loop->have_posts() ) {
        echo '<ul class="' . $gallery_class . '">';

        while ( $loop->have_posts() ) {
          $loop->the_post();
          get_template_part( 'include/content', 'gallery' );
        }

        echo '</ul>';
      } else {
        echo '<p>' . __( 'There are no posts in gallery', 'dm3_fwk' ) . '</p>';
      }

      wp_reset_query();

      edit_post_link( __( 'Edit', 'dm3_fwk' ), '<p class="edit-link">', '</p>' );
      ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>
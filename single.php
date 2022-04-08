<?php
/**
 * The Template for displaying all single posts.
 */

get_header();
?>
<?php while ( have_posts() ) : the_post();
$post_id = get_the_ID();
$thumb_id = get_post_thumbnail_id();
global $image_gallery_system;
if ( $image_gallery_system === 'one-page-one-picture' ) {
  include( locate_template ( 'template-parts/gallery-one-page-one-picture.php' ) );
}
else if ( $image_gallery_system === 'scrollpage' ) {
  include( locate_template ( 'template-parts/gallery-scrollpage.php' ) );
}
else if ( $image_gallery_system === 'slider' ) {
  include( locate_template ( 'template-parts/gallery-slider.php' ) );
}

?>

<?php endwhile; ?>
<?php get_footer(); ?>

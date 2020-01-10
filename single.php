<?php
/**
 * The Template for displaying all single posts.
 */

get_header();
?>
<?php while ( have_posts() ) : the_post();
$post_id = get_the_ID();
$thumb_id = get_post_thumbnail_id();


$picturecaption = get_post(get_post_thumbnail_id())->post_excerpt; //The Caption
$attachment_title = get_the_title($thumb_id);
$attachment_alt = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true);
$thumb_url_5k = wp_get_attachment_image_src($thumb_id, '5k_image', true);
$thumb_url_desktop = wp_get_attachment_image_src($thumb_id, 'full_desk', true);
$thumb_url_tablet = wp_get_attachment_image_src($thumb_id, 'tablet_image', true);
$thumb_url_mobile = wp_get_attachment_image_src($thumb_id, 'mobile_image', true);
$thumb_url_micro = wp_get_attachment_image_src($thumb_id, 'micro', true);

$next_post_url = get_permalink( get_adjacent_post(true,'',false)->ID );
$previous_post_url = get_permalink( get_adjacent_post(true,'',true)->ID );
$current_post_url = get_permalink();

// Conto le immagini
$attachments = get_children( array(
   'post_type' => 'attachment',
   'numberposts' => -1,
   'post_status' => null,
   'post_mime_type' => 'image',
   'post_parent' => $post->ID
) );
$count = count ($attachments);

// link alla prima immagine
$images = get_posts(
array(
  'post_parent' => $post->ID,
  'exclude' => $thumb_id,
  'post_type' => 'attachment',
  'post_mime_type' => 'image',
  'orderby' => 'menu_order',
  'order' => 'ASC',
  'numberposts' => -1,
  'post_status' => null

)
);
$next_url = get_permalink( $images[0]->ID);
wp_reset_query();

// seconda immagine
$args_next = array(
  'post_parent' => $post->ID,
  'exclude' => $thumb_id,
  'post_type' => 'attachment',
  'post_mime_type' => 'image',
  'orderby' => 'menu_order',
  'order' => 'ASC',
  'numberposts' => -1,
  'post_status' => null
);

$attachments_next = get_posts( $args_next );
if ( $attachments_next ) {
  foreach ( $attachments_next as $attachment_next ) {
    $img_link_next = wp_get_attachment_url( $attachment_next->ID, 'full_desk', true );
    $img_link_source_next = wp_get_attachment_link( $attachment_next->ID, '', true );
  }
}
wp_reset_query();

// ultima immagine
$args_last = array(
  'post_parent' => $post->ID,
  'exclude' => $thumb_id,
  'post_type' => 'attachment',
  'post_mime_type' => 'image',
  'orderby' => 'menu_order',
  'order' => 'DESC',
  'numberposts' => -1,
  'post_status' => null,
  'title'	=> trim( strip_tags( $attachment->post_title ) )
);

$attachments_last = get_posts( $args_last );
if ( $attachments_last ) {
  foreach ( $attachments_last as $attachment_last ) {
    $img_link_last = wp_get_attachment_url( $attachment_last->ID, 'full_desk', true );
    $img_link_source_last = get_permalink( $attachment_last->ID, '', true );
  }
}
wp_reset_query();
?>

<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "ImageObject",
  "author": "Allegra Martin",
  "contentUrl": "<?php echo $thumb_url[0]; ?>",
  "datePublished": "<?php echo get_the_date('Y-m-d'); ?>",
  "description": "<?php the_content(); ?>",
  "name": "<?php the_title(); ?>"
}
</script>


<?php
global $elenco_foto;
if ( $elenco_foto === 'si' ) {
  include( locate_template ( 'template-parts/gallery-thumbs.php' ) );
}
?>


<div id="delight-approved" class="photo-frame">
  <div class="photo-hold">
    <div class="sk-folding-cube">
      <div class="sk-cube1 sk-cube"></div>
      <div class="sk-cube2 sk-cube"></div>
      <div class="sk-cube4 sk-cube"></div>
      <div class="sk-cube3 sk-cube"></div>
    </div>
    <div class="lazy-bg lazy only-explorer" data-src="<?php echo $thumb_url_desktop[0]; ?>"></div>
    <picture>
      <source media="(max-width: 767px)" data-srcset="<?php echo $thumb_url_mobile[0]; ?>">
        <source media="(max-width: 1024px)" data-srcset="<?php echo $thumb_url_tablet[0]; ?>">
          <source media="(max-width: 1920px)" data-srcset="<?php echo $thumb_url_desktop[0]; ?>">
            <source media="(min-width: 1921px)" data-srcset="<?php echo $thumb_url_5k[0]; ?>">
              <img src="<?php echo $thumb_url_micro[0]; ?>" data-src="<?php echo $thumb_url_desktop[0]; ?>" title="<?php echo $attachment_title; ?>" alt="<?php echo $attachment_alt; ?>" class="lazy no-explorer" />
    </picture>
  </div>
  <?php if ( $count > 1 ) : ?>
    <div class="absl_swipe"></div>
    <div class="navi-click navi-click-left delight-area"><a href="<?php echo $img_link_source_last; ?>" aria-label="Previous image"></a></div>
    <div class="navi-click navi-click-right delight-area"><a href="<?php echo $next_url; ?>" aria-label="Next image"></a></div>
  <?php endif; ?>
</div>

<div class="wrapper delight-area">
  <div class="wrapper-padded">
    <div class="photo-navi bg-5 txt-2 navi-text aligncenter">
      <?php
      global $contatore_foto;
      if ( $contatore_foto === 'si' ) {
        if ( $count > 0 )  { echo '1 / ' .$count;
        }
      }
      ?>
    </div>
    <div class="wrapper-padded-more-650 delight-area">
      <div class="content-styled aligncenter">
        <h1><?php the_title(); ?></h1>
        <!--
        <?php if ( $attachment_alt != '' ) : ?>
          <h2><?php echo $attachment_alt; ?></h2>
        <?php endif; ?>
        -->
        <?php the_content(); ?>
      </div>
    </div>
  </div>
</div>
<?php endwhile; ?>
<?php get_footer(); ?>

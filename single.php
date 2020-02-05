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
$thumb_url_desktop = wp_get_attachment_image_src($thumb_id, 'full_desk', true);

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
    <?php
    if ( get_field( 'video_embed' ) ) {
      $iframe = get_field('video_embed');
      $iframe = preg_replace('~<iframe[^>]*\K(?=src)~i','data-',$iframe);
      $iframe = str_replace( '<iframe ', '<iframe class="lazy" ', $iframe );
      echo '<div class="embed-container">';
      echo $iframe;
      echo '</div>';
    }
    else {
      echo '<div class="lazy-bg lazy only-explorer" data-src="'.$thumb_url_desktop[0].'"></div>';
      $image_data = array(
          'image_type' => 'post_thumbnail', // options: post_thumbnail, acf_field, acf_sub_field
          'image_value' => '', // se utilizzi un custom field indica qui il nome del campo
          'size_fallback' => 'full_desk'
      );
      $image_sizes = array( // qui sono definiti i ritagli o dimensioni. Devono corrispondere per numero a quanto dedinfito nella funzione nei parametri data-srcset o srcset
          'retina' => '5k_image',
          'desktop' => 'full_desk',
          'mobile' => 'mobile_image',
          'micro' => 'micro'
      );
      print_theme_single_image( $image_data, $image_sizes );
      if ( $count > 1 ) {
        echo '<div class="absl_swipe"></div>';
        echo '<div class="navi-click navi-click-left delight-area"><a href="'.$img_link_source_last.'" aria-label="Previous image"></a></div>';
        echo '<div class="navi-click navi-click-right delight-area"><a href="'.$next_url.'" aria-label="Next image"></a></div>';
      }
    }
    ?>
  </div>
</div>

<div class="wrapper delight-area">
  <div class="wrapper-padded">
    <?php if ( get_field( 'video_embed' ) ) : ?>
      <div class="photo-navi txt-2 navi-text aligncenter">

      </div>
    <?php else : ?>
      <div class="photo-navi bg-5 txt-2 navi-text aligncenter">
        <?php
        global $contatore_foto;
        if ( $contatore_foto === 'si' && $count > 1 ) {
          if ( $count > 0 )  { echo '1 / ' .$count;
          }
        }
        ?>
      </div>
    <?php endif; ?>
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

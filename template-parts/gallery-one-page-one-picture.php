<?php


$picturecaption = get_post(get_post_thumbnail_id())->post_excerpt; //The Caption
$attachment_alt = get_post_meta($thumb_id,'_wp_attachment_image_alt', true);
$attachment_description = get_post(get_post_thumbnail_id())->post_content; //Long description
$thumb_url_desktop = wp_get_attachment_image_src($thumb_id, 'full_desk', true);
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
if ( $images ) {
  $next_url = get_permalink( $images[0]->ID);
}

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
  //'title'	=> trim( strip_tags( $attachment->post_title ) )
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
  "author": "<?php echo get_bloginfo( 'name' ); ?>",
  "contentUrl": "<?php echo $thumb_url_desktop[0]; ?>",
  "datePublished": "<?php echo get_the_date('Y-m-d'); ?>",
  "description": "<?php echo strip_tags(get_the_content()); ?>",
  "name": "<?php the_title(); ?>"
}
</script>


<?php
global $elenco_foto;
if ( $elenco_foto === 'si' ) {
  include( locate_template ( 'template-parts/gallery-thumbs-one-page-one-picture.php' ) );
}
?>

<div id="delight-approved" class="photo-frame" data-picture-id="<?php echo $thumb_id; ?>">
  <div class="photo-hold">
    <div class="sk-folding-cube">
      <div class="sk-cube1 sk-cube"></div>
      <div class="sk-cube2 sk-cube"></div>
      <div class="sk-cube4 sk-cube"></div>
      <div class="sk-cube3 sk-cube"></div>
    </div>
    <?php
    $image_data = array(
        'image_type' => 'post_thumbnail', // options: post_thumbnail, acf_field, acf_sub_field
        'image_value' => '', // se utilizzi un custom field indica qui il nome del campo
        'size_fallback' => 'full'
    );
    $image_sizes = array( // qui sono definiti i ritagli o dimensioni. Devono corrispondere per numero a quanto dedinfito nella funzione nei parametri data-srcset o srcset
      'desktop_retina' => 'single_image_retina',
      'desktop' => 'single_image',
      'mobile' => 'single_image',
      'mobile_retina' => 'single_image_retina',
      'micro' => 'micro'
    );
    print_theme_single_image( $image_data, $image_sizes );
    if ( $count > 1 ) {
      echo '<div class="absl_swipe"></div>';
      echo '<div class="navi-click navi-click-left delight-area data-swup-preload"><a href="'.$img_link_source_last.'" aria-label="Previous image"></a></div>';
      echo '<div class="navi-click navi-click-right delight-area data-swup-preload"><a href="'.$next_url.'" aria-label="Next image"></a></div>';
    }
    ?>
  </div>
</div>

<div class="wrapper delight-area">
  <div class="wrapper-padded">
    <?php if ( get_field( 'video_embed' ) ) : ?>
      <div class="photo-navi navi-text aligncenter">

      </div>
    <?php else : ?>
      <div class="photo-navi navi-text aligncenter">
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
        <?php if ( $attachment_description != '' ) : ?>
          <div class="picture-info lined">
            <div class="content-styled">
              <p>
                <?php echo $attachment_description; ?>
              </p>
            </div>
          </div>
        <?php endif; ?>
        <div class="alignleft">
          <h1><?php the_title(); ?></h1>
          <?php the_content(); ?>
        </div>
      </div>
    </div>
  </div>
</div>

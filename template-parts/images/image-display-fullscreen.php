<?php
$thumb_id = get_post_thumbnail_id();
$attachment_title = get_the_title($thumb_id);
$attachment_alt = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true);
$thumb_url_desktop = wp_get_attachment_image_src($thumb_id, 'desktop_image', true);
$thumb_url_tablet = wp_get_attachment_image_src($thumb_id, 'tablet_image', true);
$thumb_url_mobile = wp_get_attachment_image_src($thumb_id, 'mobile_image', true);
$thumb_url_micro = wp_get_attachment_image_src($thumb_id, 'micro', true);
if ( $thumb_id != '' ) :
 ?>
   <picture>
      <source media="(max-width: 767px)" data-srcset="<?php echo $thumb_url_mobile[0]; ?>">
      <source media="(max-width: 1024px)" data-srcset="<?php echo $thumb_url_tablet[0]; ?>">
      <source media="(min-width: 1025px)" data-srcset="<?php echo $thumb_url_desktop[0]; ?>">
      <img src="<?php echo $thumb_url_micro[0]; ?>" data-src="<?php echo $thumb_url_desktop[0]; ?>" title="<?php echo $attachment_title; ?>" alt="<?php echo $attachment_alt; ?>"  class="lazy covered" />
    </picture>
<?php endif; ?>

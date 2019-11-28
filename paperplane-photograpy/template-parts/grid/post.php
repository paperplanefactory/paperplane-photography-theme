<div class="flex-hold-child grid-item-infinite">
  <?php
$thumb_id = get_post_thumbnail_id();
$attachment_title = get_the_title($thumb_id);
$attachment_alt = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true);
$thumb_url_desktop = wp_get_attachment_image_src($thumb_id, 'grid_large_image', true);
$thumb_url_desktop_3 = wp_get_attachment_image_src($thumb_id, 'tablet_image', true);
$thumb_url_mobile = wp_get_attachment_image_src($thumb_id, 'mobile_image', true);
$thumb_url_micro = wp_get_attachment_image_src($thumb_id, 'micro', true);
if ( $thumb_id != '' ) :
 ?>
 <a href="<?php the_permalink(); ?>">
   <div class="no-the-100">
     <picture>
        <source media="(max-width: 1024px)" data-srcset="<?php echo $thumb_url_mobile[0]; ?>">
          <source media="(max-width: 1920px)" data-srcset="<?php echo $thumb_url_desktop[0]; ?>">
        <source media="(min-width: 1921px)" data-srcset="<?php echo $thumb_url_desktop_3[0]; ?>">
        <img src="<?php echo $thumb_url_micro[0]; ?>" data-src="<?php echo $thumb_url_desktop_3[0]; ?>" title="<?php echo $attachment_title; ?>" alt="<?php echo $attachment_alt; ?>" class="lazy" />
      </picture>
   </div>
  </a>
<?php endif; ?>
<div class="flex-hold-title">
  <a href="<?php the_permalink(); ?>" class="absl" aria-label="View project: <?php the_title(); ?>"></a>
  <div>
    <h2 class="as-h4"><?php the_title(); ?></h2>
  </div>
</div>
</div>

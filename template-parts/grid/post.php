<div class="flex-hold-child grid-item-infinite <?php echo $zoomed_class; ?>">
<a href="<?php the_permalink(); ?>" class="data-swup-preload"  title="<?php _e( 'View project:', 'paperplane-photography-theme' );?> <?php the_title(); ?>" aria-label="<?php _e( 'View project:', 'paperplane-photography-theme' );?> <?php the_title(); ?>">
 <div class="no-the-100">
   <?php if ( get_field( 'items_per_row', 'options' ) === 'three-items' ) : ?>
     <?php if ( get_field('image_grid', 'options') === 'no-crop-picture' ) : ?>
       <?php
       $image_data = array(
           'image_type' => 'post_thumbnail', // options: post_thumbnail, acf_field, acf_sub_field
           'image_value' => '', // se utilizzi un custom field indica qui il nome del campo
           'size_fallback' => 'grid_image_nocrop'
       );
       $image_sizes = array( // qui sono definiti i ritagli o dimensioni. Devono corrispondere per numero a quanto dedinfito nella funzione nei parametri data-srcset o srcset
           'desktop_retina' => 'grid_image_retina_nocrop',
           'desktop' => 'grid_image_nocrop',
           'mobile' => 'grid_image_mobile_nocrop',
           'mobile_retina' => 'grid_image_mobile_retina_nocrop',
           'micro' => 'micro'
       );
       print_theme_single_image( $image_data, $image_sizes );
       ?>
     <?php else : ?>
       <?php
       $image_data = array(
           'image_type' => 'post_thumbnail', // options: post_thumbnail, acf_field, acf_sub_field
           'image_value' => '', // se utilizzi un custom field indica qui il nome del campo
           'size_fallback' => 'grid_image_crop'
       );
       $image_sizes = array( // qui sono definiti i ritagli o dimensioni. Devono corrispondere per numero a quanto dedinfito nella funzione nei parametri data-srcset o srcset
           'desktop_retina' => 'grid_image_retina_crop',
           'desktop' => 'grid_image_crop',
           'mobile' => 'grid_image_mobile_crop',
           'mobile_retina' => 'grid_image_mobile_retina_crop',
           'micro' => 'micro_crop'
       );
       print_theme_single_image( $image_data, $image_sizes );
       ?>
     <?php endif; ?>
   <?php elseif ( get_field( 'items_per_row', 'options' ) === 'two-items' ) : ?>
     <?php if ( get_field('image_grid', 'options') === 'no-crop-picture' ) : ?>
       <?php
       $image_data = array(
           'image_type' => 'post_thumbnail', // options: post_thumbnail, acf_field, acf_sub_field
           'image_value' => '', // se utilizzi un custom field indica qui il nome del campo
           'size_fallback' => 'grid_image_nocrop_2cols'
       );
       $image_sizes = array( // qui sono definiti i ritagli o dimensioni. Devono corrispondere per numero a quanto dedinfito nella funzione nei parametri data-srcset o srcset
           'desktop_retina' => 'grid_image_retina_nocrop_2cols',
           'desktop' => 'grid_image_nocrop_2cols',
           'mobile' => 'grid_image_mobile_nocrop',
           'mobile_retina' => 'grid_image_mobile_retina_nocrop',
           'micro' => 'micro'
       );
       print_theme_single_image( $image_data, $image_sizes );
       ?>
     <?php else : ?>
       <?php
       $image_data = array(
           'image_type' => 'post_thumbnail', // options: post_thumbnail, acf_field, acf_sub_field
           'image_value' => '', // se utilizzi un custom field indica qui il nome del campo
           'size_fallback' => 'grid_image_mobile_crop'
       );
       $image_sizes = array( // qui sono definiti i ritagli o dimensioni. Devono corrispondere per numero a quanto dedinfito nella funzione nei parametri data-srcset o srcset
           'desktop_retina' => 'grid_image_retina_crop_2cols',
           'desktop' => 'grid_image_crop_2cols',
           'mobile' => 'grid_image_mobile_crop',
           'mobile_retina' => 'grid_image_mobile_retina_crop',
           'micro' => 'micro_crop'
       );
       print_theme_single_image( $image_data, $image_sizes );
       ?>
     <?php endif; ?>
   <?php endif; ?>
 </div>
</a>
<div class="flex-hold-title">
  <a href="<?php the_permalink(); ?>" class="absl data-swup-preload" title="<?php _e( 'View project:', 'paperplane-photography-theme' );?> <?php the_title(); ?>" aria-label="<?php _e( 'View project:', 'paperplane-photography-theme' );?> <?php the_title(); ?>"></a>
  <div>
    <h2 class="as-h4"><?php the_title(); ?></h2>
    <?php
    if ( $show_cats === 'yes' ) {
      echo '<div class="category-list">';
        if (function_exists('call_categories')) { call_categories(); }
      echo '</div>';
    }
    ?>
  </div>
</div>
</div>

<div class="flex-hold-child grid-item-infinite">
<a href="<?php the_permalink(); ?>">
 <div class="no-the-100">
   <?php
   $image_data = array(
       'image_type' => 'post_thumbnail', // options: post_thumbnail, acf_field, acf_sub_field
       'image_value' => '', // se utilizzi un custom field indica qui il nome del campo
       'size_fallback' => 'grid_large_image'
   );
   $image_sizes = array( // qui sono definiti i ritagli o dimensioni. Devono corrispondere per numero a quanto dedinfito nella funzione nei parametri data-srcset o srcset
       'retina' => 'grid_large_image',
       'desktop' => 'tablet_image',
       'mobile' => 'mobile_image',
       'micro' => 'micro'
   );
   print_theme_single_image( $image_data, $image_sizes );
   ?>
 </div>
</a>
<div class="flex-hold-title">
  <a href="<?php the_permalink(); ?>" class="absl" aria-label="View project: <?php the_title(); ?>"></a>
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

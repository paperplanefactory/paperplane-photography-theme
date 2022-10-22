<div class="news-item grid-item-infinite">
  <div class="books-listing-cover">
    <a href="<?php the_permalink(); ?>">
      <div class="no-the-100">
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
      </div>
    </a>
  </div>
  <h2 class="as-h4"><a href="<?php the_permalink(); ?>" class="data-swup-preload"><?php the_title(); ?></a></h2>
  <div class="cta-1"><?php $postType = get_post_type_object(get_post_type());
if ($postType) {
    echo esc_html($postType->labels->singular_name);
} ?></div>
</div>

<div class="news-item grid-item-infinite">
  <?php if ( get_post_type( get_the_ID() ) == 'book' ) : ?>
    <div class="books-listing-cover">
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
    </div>
    <h2 class="as-h4"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
  <?php else : ?>
    <h2 class="as-h4"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <div class="cta-1"><?php the_time( get_option( 'date_format' ) ); ?></div>
    <?php if ( $show_abstract === 'yes' ) : ?>
      <?php the_excerpt(); ?>
      <h6><a href="<?php the_permalink(); ?>">Read more</a></h6>
    <?php endif; ?>
  <?php endif; ?>
</div>

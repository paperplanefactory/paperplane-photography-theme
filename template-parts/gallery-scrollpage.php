<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "ImageObject",
  "author": "<?php echo get_bloginfo( 'name' ); ?>",
  "contentUrl": "<?php echo $thumb_url[0]; ?>",
  "datePublished": "<?php echo get_the_date('Y-m-d'); ?>",
  "description": "<?php echo strip_tags(get_the_content()); ?>",
  "name": "<?php the_title(); ?>"
}
</script>

<div class="wrapper">
  <div class="wrapper-padded">
    <div class="wrapper-padded-more-840">
      <div class="content-styled plain-page news-post">
        <h1><?php the_title(); ?></h1>
        <?php the_content(); ?>
      </div>
    </div>
  </div>
</div>

<?php if ( have_rows( 'slides_manager_repeater' ) ) : ?>
  <div class="scroll-image-hold">
    <?php
    $slide_counter = 0;
    while ( have_rows( 'slides_manager_repeater' ) ) : the_row();
    $slide_counter ++;
    $slides_manager_repeater_content_type = get_sub_field( 'slides_manager_repeater_content_type' );
    if ( $slides_manager_repeater_content_type === 'picture' ) {
      $slide_type = 'pic';
      $slides_manager_repeater_picture = get_sub_field('slides_manager_repeater_picture');
      $picture_id = $slides_manager_repeater_picture['ID'];
      $picture_description = $slides_manager_repeater_picture['description'];
    }
    else {
      $check_video_source = get_sub_field('slides_manager_repeater_embed_video');
      if (strpos($check_video_source, 'youtube') !== false) {
        $slide_type = 'youtube';
      }
      elseif (strpos($check_video_source, 'vimeo') !== false) {
        $slide_type = 'vimeo';
      }
      $picture_id = '';
    }
    $abilitare_la_vendita = get_field( 'abilitare_la_vendita', $picture_id );
    ?>
    <div class="wrapper lined">
      <div class="wrapper-padded">
        <div class="wrapper-padded-more-840">
          <div class="scroll-image">
            <?php if ( $slides_manager_repeater_content_type === 'picture' ) : ?>
              <?php
              $image_data = array(
                  'image_type' => 'acf_sub_field', // options: post_thumbnail, acf_field, acf_sub_field
                  'image_value' => 'slides_manager_repeater_picture', // se utilizzi un custom field indica qui il nome del campo
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
               ?>

            <?php if ( $slides_manager_repeater_picture['description'] != '' ) : ?>
              <div class="picture-info">
                <div class="content-styled">
                  <p>
                    <?php echo $picture_description; ?>
                  </p>
                </div>
              </div>
            <?php endif; ?>
            <?php if ( $abilitare_la_vendita === 'si' ) : ?>
              <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank" class="delight-area pay-picture-list">
                <input type="hidden" name="cmd" value="_xclick">
                <input type="hidden" name="business" value="<?php the_field( 'indirizzo_email_paypal', 'option' ); ?>">
                <input type="hidden" name="lc" value="US">
                <input type="hidden" name="item_name" value="<?php the_permalink(); ?>">
                <input type="hidden" name="item_number" value="<?php echo $picture_id; ?>">
                <input type="hidden" name="amount" value="<?php the_field( 'prezzo', $picture_id ); ?>">
                <input type="hidden" name="currency_code" value="<?php the_field( 'tipo_di_valuta', 'option' ); ?>">
                <input type="hidden" name="button_subtype" value="services">
                <input type="hidden" name="no_note" value="0">
                <input type="hidden" name="tax_rate" value="0">
                <input type="hidden" name="shipping" value="<?php the_field( 'costi_di_spedizione', 'option' ); ?>">
                <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">
                <button type="submit" title="Buy this picture" aria-label="<?php _e( 'Buy this picture', 'paperplane-photography-theme' );?>">Buy this picture</button>
              </form>
              <?php endif; ?>
            <?php elseif ( $slides_manager_repeater_content_type === 'video-embed' ) : ?>
              <div class="video-frame">
                <?php
                // get iframe HTML
                $iframe = get_sub_field('slides_manager_repeater_embed_video');
                // use preg_match to find iframe src
                preg_match('/src="(.+?)"/', $iframe, $matches);
                $src = $matches[1];
                // add extra params to iframe src
                $params = array(
                  'enablejsapi' => 1,
                  'controls'    => 1,
                  'hd'        => 1,
                  'autohide'    => 1
                );
                $new_src = add_query_arg($params, $src);
                $iframe = str_replace($src, $new_src, $iframe);
                // add extra attributes to iframe html
                $attributes = 'frameborder="0" class="lazy"';
                // use preg_replace to change iframe src to data-src
                $iframe = preg_replace('~<iframe[^>]*\K(?=src)~i','data-',$iframe);
                $iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);
                echo $iframe;
                 ?>
              </div>
              <?php if ( get_sub_field( 'slides_manager_repeater_embed_video_description' ) ) : ?>
                <div class="picture-info">
                  <div class="content-styled">
                    <p>
                      <?php the_sub_field( 'slides_manager_repeater_embed_video_description' ); ?>
                    </p>
                  </div>
                </div>
              <?php endif; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
    <?php endwhile; ?>
  </div>
<?php endif; ?>

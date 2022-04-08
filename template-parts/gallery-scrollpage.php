<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "ImageObject",
  "author": "<?php echo get_bloginfo( 'name' ); ?>",
  "contentUrl": "<?php echo $thumb_url[0]; ?>",
  "datePublished": "<?php echo get_the_date('Y-m-d'); ?>",
  "description": "<?php the_content(); ?>",
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

<div class="scroll-image-hold">
  <?php
  $attachments = get_children(array(
    'post_parent' => $post->ID,
    'post_status' => 'inherit',
    'post_type' => 'attachment',
    'post_mime_type' => 'image',
    'order' => 'DESC',
    'orderby' => 'menu_order ID')
  );
  foreach($attachments as $att_id => $attachment) :
    $abilitare_la_vendita = get_field( 'abilitare_la_vendita', $attachment->ID );
    $attachment_description = get_post( $attachment->ID )->post_content; //Long description
    ?>
    <div class="wrapper lined">
      <div class="wrapper-padded">
        <div class="wrapper-padded-more-840">
          <div class="scroll-image">
            <?php
            $image_data = array(
                'image_type' => 'post_thumbnail', // options: post_thumbnail, acf_field, acf_sub_field
                'image_value' => $attachment->ID, // se utilizzi un custom field indica qui il nome del campo
                'size_fallback' => 'full'
            );
            $image_sizes = array( // qui sono definiti i ritagli o dimensioni. Devono corrispondere per numero a quanto dedinfito nella funzione nei parametri data-srcset o srcset
              'desktop_retina' => 'single_image_retina',
              'desktop' => 'single_image',
              'mobile' => 'single_image',
              'mobile_retina' => 'single_image_retina',
              'micro' => 'micro'
            );
            print_theme_scroll_image( $image_data, $image_sizes );

            ?>
            <?php if ( $attachment_description != '' ) : ?>
              <div class="picture-info">
                <div class="content-styled">
                  <p>
                    <?php echo $attachment_description; ?>
                  </p>
                </div>
              </div>
            <?php endif; ?>
            <?php if ( $abilitare_la_vendita=== 'si' ) : ?>
              <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank" class="delight-area pay-picture-list">
                <input type="hidden" name="cmd" value="_xclick">
                <input type="hidden" name="business" value="<?php the_field( 'indirizzo_email_paypal', 'option' ); ?>">
                <input type="hidden" name="lc" value="US">
                <input type="hidden" name="item_name" value="<?php the_permalink(); ?>">
                <input type="hidden" name="item_number" value="<?php $attachment->ID; ?>">
                <input type="hidden" name="amount" value="<?php the_field( 'prezzo', $attachment->ID ); ?>">
                <input type="hidden" name="currency_code" value="<?php the_field( 'tipo_di_valuta', 'option' ); ?>">
                <input type="hidden" name="button_subtype" value="services">
                <input type="hidden" name="no_note" value="0">
                <input type="hidden" name="tax_rate" value="0">
                <input type="hidden" name="shipping" value="<?php the_field( 'costi_di_spedizione', 'option' ); ?>">
                <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">
                <button type="submit" title="Buy this picture" aria-label="<?php _e( 'Buy this picture', 'paperplane-photography-theme' );?>">Buy this picture</button>
              </form>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>

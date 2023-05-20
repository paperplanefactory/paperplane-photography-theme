<?php
global $elenco_foto;
if ($elenco_foto === 'si'): ?>
  <div class="thumbs-gallery">
    <div class="wrapper bg-5 lined">
      <div class="wrapper-padded">
        <div class="wrapper-padded-more-650">
          <div class="gallery-slider-nav gallery-slider-nav-js">
            <?php
            $slide_counter = 0;
            if (have_rows('slides_manager_repeater')):
              while (have_rows('slides_manager_repeater')):
                the_row();
                $slides_manager_repeater_content_type = get_sub_field('slides_manager_repeater_content_type');
                $slide_counter++;
                ?>
                <div class="slide-thumb" data-slide="<?php echo $slide_counter; ?>">
                  <?php if ($slides_manager_repeater_content_type === 'picture') {
                    $slides_manager_repeater_picture = get_sub_field('slides_manager_repeater_picture');
                    $image_data = array(
                      'image_type' => 'acf_sub_field',
                      // options: post_thumbnail, acf_field, acf_sub_field
                      'image_value' => 'slides_manager_repeater_picture',
                      // se utilizzi un custom field indica qui il nome del campo
                      'size_fallback' => 'thumb_gallery'
                    );
                    $image_sizes = array(
                      // qui sono definiti i ritagli o dimensioni. Devono corrispondere per numero a quanto dedinfito nella funzione nei parametri data-srcset o srcset
                      'desktop_retina' => 'thumb_gallery',
                      'desktop' => 'thumb_gallery',
                      'mobile' => 'thumb_gallery',
                      'mobile_retina' => 'thumb_gallery',
                      'micro' => 'micro'
                    );
                    print_theme_single_image_slider($image_data, $image_sizes);
                  } else {

                    if (get_sub_field('slides_manager_repeater_embed_video_cover')) {
                      $image_data = array(
                        'image_type' => 'acf_sub_field',
                        // options: post_thumbnail, acf_field, acf_sub_field
                        'image_value' => 'slides_manager_repeater_embed_video_cover',
                        // se utilizzi un custom field indica qui il nome del campo
                        'size_fallback' => 'thumb_gallery'
                      );
                      $image_sizes = array(
                        // qui sono definiti i ritagli o dimensioni. Devono corrispondere per numero a quanto dedinfito nella funzione nei parametri data-srcset o srcset
                        'desktop_retina' => 'thumb_gallery',
                        'desktop' => 'thumb_gallery',
                        'mobile' => 'thumb_gallery',
                        'mobile_retina' => 'thumb_gallery',
                        'micro' => 'micro'
                      );
                      print_theme_single_image_slider($image_data, $image_sizes);
                    } else {
                      echo '<img src="' . get_stylesheet_directory_uri() . '/assets/images/video-icon.svg" />';
                    }

                  }
                  ?>
                </div>
              <?php endwhile; endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<div class="gallery-slider gallery-slider-js"
  data-slick='{"autoplaySpeed": <?php the_field('set_image_duration', 'options'); ?>}'>
  <?php
  if (have_rows('slides_manager_repeater')):
    while (have_rows('slides_manager_repeater')):
      the_row();
      $slides_manager_repeater_content_type = get_sub_field('slides_manager_repeater_content_type');
      if ($slides_manager_repeater_content_type === 'picture') {
        $slide_type = 'pic';
        $slides_manager_repeater_picture = get_sub_field('slides_manager_repeater_picture');
        $picture_id = $slides_manager_repeater_picture['ID'];
        $picture_description = $slides_manager_repeater_picture['description'];
      } else {
        $check_video_source = get_sub_field('slides_manager_repeater_embed_video');
        if (strpos($check_video_source, 'youtube') !== false) {
          $slide_type = 'youtube';
        } elseif (strpos($check_video_source, 'vimeo') !== false) {
          $slide_type = 'vimeo';
        }
        $picture_id = '';
      }
      $abilitare_la_vendita = get_field('abilitare_la_vendita', $picture_id);
      if ($abilitare_la_vendita === 'si') {
        $buy_button_status = 'show-buy-button';
      } else {
        $buy_button_status = '';
      }
      ?>
      <div class="slide-picture-contaniner" data-content="<?php echo $slide_type; ?>"
        data-sale="<?php echo $buy_button_status; ?>">
        <div class="slide-picture">
          <?php if ($slides_manager_repeater_content_type === 'picture') {
            $image_data = array(
              'image_type' => 'acf_sub_field',
              // options: post_thumbnail, acf_field, acf_sub_field
              'image_value' => 'slides_manager_repeater_picture',
              // se utilizzi un custom field indica qui il nome del campo
              'size_fallback' => 'full'
            );
            $image_sizes = array(
              // qui sono definiti i ritagli o dimensioni. Devono corrispondere per numero a quanto dedinfito nella funzione nei parametri data-srcset o srcset
              'desktop_retina' => 'single_image_retina',
              'desktop' => 'single_image',
              'mobile' => 'single_image',
              'mobile_retina' => 'single_image_retina',
              'micro' => 'micro'
            );
            print_theme_single_image_slider($image_data, $image_sizes);
          } else {
            // get iframe HTML
            $iframe = get_sub_field('slides_manager_repeater_embed_video');
            // use preg_match to find iframe src
            preg_match('/src="(.+?)"/', $iframe, $matches);
            $src = $matches[1];
            // add extra params to iframe src
            $params = array(
              'enablejsapi' => 1,
              'controls' => 1,
              'hd' => 1,
              'autohide' => 1
            );
            $new_src = add_query_arg($params, $src);
            $iframe = str_replace($src, $new_src, $iframe);
            // add extra attributes to iframe html
            $attributes = 'frameborder="0" class="lazy"';
            // use preg_replace to change iframe src to data-src
            $iframe = preg_replace('~<iframe[^>]*\K(?=src)~i', 'data-', $iframe);
            $iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);
            echo $iframe;
          }
          ?>
        </div>
        <?php if ($slides_manager_repeater_content_type === 'picture'): ?>
          <?php if ($slides_manager_repeater_picture['description'] != ''): ?>
            <div class="wrapper-padded-more-650 delight-area">
              <div class="content-styled aligncenter">
                <div class="picture-info lined">
                  <div class="content-styled">
                    <p>
                      <?php echo $picture_description; ?>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>
        <?php else: ?>
          <?php if (get_sub_field('slides_manager_repeater_embed_video_description')): ?>
            <div class="wrapper-padded-more-650 delight-area">
              <div class="content-styled aligncenter">
                <div class="picture-info lined">
                  <div class="content-styled">
                    <p>
                      <?php the_sub_field('slides_manager_repeater_embed_video_description'); ?>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>
        <?php endif; ?>
      </div>
    <?php endwhile; endif; ?>
</div>

<div class="photo-navi navi-text aligncenter">
  <?php
  global $contatore_foto;
  if ($contatore_foto === 'si') {
    echo '1 / 1';
  }
  ?>
</div>


<div class="wrapper-padded-more-650 delight-area">
  <div class="content-styled alignleft">
    <h1 class="aligncenter">
      <?php the_title(); ?>
    </h1>
    <h1>
      <?php the_title(); ?>
    </h1>
    <?php the_content(); ?>
  </div>
</div>
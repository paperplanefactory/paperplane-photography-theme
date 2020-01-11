<?php
// custom image size for featured images
add_theme_support( 'post-thumbnails' );
add_image_size( '5k_image', 99999, 2160);
add_image_size( 'full_desk', 99999, 1080);
add_image_size( 'content_picture', 768, 9999);
add_image_size( 'tablet_image', 1024, 9999);
add_image_size( 'mobile_image', 768, 9999);
add_image_size( 'grid_image', 388, 9999);
add_image_size( 'grid_large_image', 768, 9999);
add_image_size( 'thumb_gallery', 120, 120, true);
add_image_size( 'micro', 10, 9999);


function wpb_imagelink_setup() {
    $image_set = get_option( 'image_default_link_type' );
    if ($image_set !== 'none') {
        update_option('image_default_link_type', 'none');
    }
}
add_action('admin_init', 'wpb_imagelink_setup', 10);

// limito il numero di scelte per le immagini "in content"
add_filter('image_size_names_choose', 'my_image_sizes');
function my_image_sizes($sizes) {
$addsizes = array(
"content_picture" => __( "Content picture")
);
$newsizes = array_merge($sizes, $addsizes);
return $newsizes;
}


function print_theme_single_image( $image_data, $image_sizes ) {
  if( count( $image_data ) > 0 ) {
    $image_data_select = $image_data['image_type']; // post_thumbnail, acf_field or acf_sub_field
    $size_fallback = $image_data['size_fallback']; // crop to use as fallback
    if ( $image_data_select === 'acf_field' ) { // ACF FIELD - be sure to set "image -> image array in ACF options"
      $thumb_id_pre = get_field( $image_data['image_value'] ); // retrieve the image data array
      $thumb_id = $thumb_id_pre['ID']; // retrieve the image ID
    }
    elseif ( $image_data_select === 'acf_sub_field' ) { // ACF SUB FIELD - be sure to set "image -> image array in ACF options"
      $thumb_id_pre = get_sub_field( $image_data['image_value'] );
      $thumb_id = $thumb_id_pre['ID']; // retrieve the image ID
    }
    elseif ( $image_data_select === 'post_thumbnail' ) { // nomrmal featured image
      if ( is_attachment() ) {
        $thumb_id = get_the_ID(); // retrieve image ID
      }
      else {
        $post_id = get_the_ID(); // retrieve post/page ID
        $thumb_id = get_post_thumbnail_id( $post_id ); // retrieve the image ID
      }

    }
    if ( $thumb_id != '' ) {
      $attachment_title = get_the_title( $thumb_id ); // image title
      $attachment_alt = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true ); // image alt text
      if( count( $image_sizes ) > 0 ) {
        $print_theme_image_cache_key = 'print_theme_image_cache_'.$thumb_id;
        $sharped_images = wp_cache_get( $print_theme_image_cache_key ); // check if array of images URL is set as cache
        if ( false === $sharped_images ) {
          $sharped_images = array(); // declare arry to use later in data-srcset
          foreach( $image_sizes as $image_size) {
            $thumb_url[$image_size] = wp_get_attachment_image_src( $thumb_id, $image_size, true ); // retrive array for desired size
            if ( $thumb_url[$image_size][3] == true ) { // check if cropped image exists
              $sharped_images[] = $thumb_url[$image_size][0]; // retrive image URL
            }
            else { // if cropped image does not exist
              $thumb_url[$image_size] = wp_get_attachment_image_src( $thumb_id, $size_fallback, true ); // retrive array for fallback size
              $sharped_images[] = $thumb_url[$image_size][0]; // retrive fallback image URL
            }
          }
        	wp_cache_set( $print_theme_image_cache_key, $sharped_images, 300 ); // set array of images URL as cache
        }
        // this is simple HTML - remember to use lazyload (https://github.com/verlok/lazyload) for better performance
        $html_image_output = '';
        $html_image_output .= '<picture>';
        $html_image_output .= '<source media="(max-width: 767px)" data-srcset="'.$sharped_images[2].'">';
        $html_image_output .= '<source media="(max-width: 1920px)" data-srcset="'.$sharped_images[1].'">';
        $html_image_output .= '<source media="(min-width: 1921px)" data-srcset="'.$sharped_images[0].'">';
        $html_image_output .= '<img data-src="'.$sharped_images[1].'" src="'.$sharped_images[3].'" title="'.$attachment_title.'" alt="'.$attachment_alt.'" class="autoplay-loaded lazy" />';
        $html_image_output .= '</picture>';
        echo $html_image_output;
      }
    }
  }
}

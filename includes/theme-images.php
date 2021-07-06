<?php
// checks if requested URL is an attachment of a post - if not it redirects to home page
// useful to avoid news and books attachments view
add_action('template_redirect', 'redirect_if_not_post_attachment');
function redirect_if_not_post_attachment() {
  global $post;
  if ( $post ) {
    $parent = get_post_field( 'post_parent', $post->ID);
    $parent_family = get_post_type( $parent );
    $image_gallery_system = get_field( 'image_gallery_system', $parent );
    if ( !isset( $image_gallery_system ) ) {
      $image_gallery_system = 'one-page-one-picture';
    }
    else {
      $image_gallery_system = get_field( 'image_gallery_system', $parent );
    }

    if ( $parent_family != 'post' && is_attachment() ) {
      if ( $parent != 0 ) {
        $parent_url = get_permalink( $parent );
        wp_redirect( $parent_url, 301 );
      }
      else {
        wp_redirect( home_url(), 301 );
      }
      exit;
    }
    if ( $image_gallery_system === 'slider' && is_attachment() ) {
      $parent_url = get_permalink( $parent );
      wp_redirect( $parent_url, 301 );
      exit;
    }
  }

}

// custom image size for images
// many sizes to fit standard and 4K displays
add_theme_support( 'post-thumbnails' );

add_image_size( 'content_picture', 768, 9999);
add_image_size( 'thumb_gallery', 120, 120, true);
add_image_size( 'micro', 10, 9999);
add_image_size( 'micro_crop', 10, 10, true);

add_image_size( 'full_desk', 1920, 9999);
// single piture view image sizes
add_image_size( 'single_image', 9999, 1080, false);
add_image_size( 'single_image_retina', 99999, 2048, false);
// grid image sizes - no crop 3 cols
add_image_size( 'grid_image_nocrop', 640, 9999);
add_image_size( 'grid_image_retina_nocrop', 1280, 9999);
add_image_size( 'grid_image_mobile_nocrop', 420, 9999);
add_image_size( 'grid_image_mobile_retina_nocrop', 840, 9999);
// grid image sizes - crop 3 cols
add_image_size( 'grid_image_crop', 640, 640, true);
add_image_size( 'grid_image_retina_crop', 1280, 1280, true);
add_image_size( 'grid_image_mobile_crop', 420, 420, true);
add_image_size( 'grid_image_mobile_retina_crop', 840, 840, true);
// grid image sizes - no crop 2 cols
add_image_size( 'grid_image_nocrop_2cols', 960, 9999);
add_image_size( 'grid_image_retina_nocrop_2cols', 1920, 9999);
// grid image sizes - crop 2 cols
add_image_size( 'grid_image_crop_2cols', 960, 960, true);
add_image_size( 'grid_image_retina_crop_2cols', 1920, 1920, true);

function wpb_imagelink_setup() {
    $image_set = get_option( 'image_default_link_type' );
    if ($image_set !== 'none') {
        update_option('image_default_link_type', 'none');
    }
}
add_action('admin_init', 'wpb_imagelink_setup', 10);

// allowing only one size when inserting images into content
add_filter('image_size_names_choose', 'my_image_sizes');
function my_image_sizes($sizes) {
$addsizes = array(
"content_picture" => __( "Content picture")
);
$newsizes = array_merge($sizes, $addsizes);
return $newsizes;
}

// function used to print images all around the pages
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
        $html_image_output .= '<source media="(max-width: 1024px)" data-srcset="'.$sharped_images[2].', '.$sharped_images[3].' 2x">';
        $html_image_output .= '<source media="(min-width: 1025px)" data-srcset="'.$sharped_images[1].', '.$sharped_images[0].' 2x">';
        $html_image_output .= '<img data-src="'.$sharped_images[1].'" src="'.$sharped_images[4].'" title="'.$attachment_title.'" alt="'.$attachment_alt.'" class="autoplay-loaded lazy" />';
        $html_image_output .= '</picture>';
        echo $html_image_output;
      }
    }
  }
}














function print_theme_single_image_slider( $image_data, $image_sizes ) {
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
        $html_image_output .= '<source media="(max-width: 1024px)" data-srcset="'.$sharped_images[2].', '.$sharped_images[3].' 2x">';
        $html_image_output .= '<source media="(min-width: 1025px)" data-srcset="'.$sharped_images[1].', '.$sharped_images[0].' 2x">';
        $html_image_output .= '<img data-lazy="'.$sharped_images[1].'" src="'.$sharped_images[4].'" title="'.$attachment_title.'" alt="'.$attachment_alt.'" class="autoplay-loaded" />';
        $html_image_output .= '</picture>';
        echo $html_image_output;
      }
    }
  }
}

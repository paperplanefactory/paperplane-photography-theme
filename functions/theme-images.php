<?php
// custom image size for featured images
add_theme_support( 'post-thumbnails' );
add_image_size( '5k_image', 4096, 99999);
add_image_size( 'full_desk', 1920, 9999);
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

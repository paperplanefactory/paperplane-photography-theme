<?php
// Async load
function theme_async_scripts( $url ) {
  if ( strpos( $url, '#asyncload' ) === false )
  return $url;
  else if ( is_admin() )
  return str_replace( '#asyncload', '', $url );
  else
  return str_replace( '#asyncload', '', $url )."' async='async";
}
add_filter( 'clean_url', 'theme_async_scripts', 11, 1 );
// Defer load
function theme_defer_scripts( $url ) {
  if ( strpos( $url, '#deferload' ) === false )
  return $url;
  else if ( is_admin() )
  return str_replace( '#deferload', '', $url );
  else
  return str_replace( '#deferload', '', $url )."' defer='defer";
}
add_filter( 'clean_url', 'theme_defer_scripts', 11, 1 );
// All scripts
add_action( 'wp_enqueue_scripts', 'all_scripts' );
function all_scripts(){
  // theme version
	global $theme_version;
  // smart jquery inclusion
  if (!is_admin()) {
  	wp_deregister_script('jquery');
  	wp_register_script('jquery', get_template_directory_uri() . '/assets/js/libs/jquery-3.6.0.min.js', '', '3.6.0', false);
  	wp_enqueue_script('jquery');
  }
  // Swup
  // docs: https://github.com/swup/swup
  wp_register_script( 'js-swup', get_template_directory_uri() . '/assets/js/libs/swup.min.js#deferload', '', $theme_version, false);
  wp_enqueue_script( 'js-swup' );
  wp_register_script( 'js-swup-head', get_template_directory_uri() . '/assets/js/libs/SwupHeadPlugin.min.js#deferload', '', $theme_version, false);
  wp_enqueue_script( 'js-swup-head' );
  wp_register_script( 'js-swup-preload', get_template_directory_uri() . '/assets/js/libs/SwupPreloadPlugin.min.js#deferload', '', $theme_version, false);
  wp_enqueue_script( 'js-swup-preload' );
  //wp_register_script( 'js-swup-ga', get_template_directory_uri() . '/assets/js/libs/SwupGaPlugin.min.js#deferload', '', $theme_version, true);
  //wp_enqueue_script( 'js-swup-ga' );
  // Infinite Scroll
  // docs: https://infinite-scroll.com/
  wp_register_script( 'custom-infinitescroll', get_template_directory_uri() . '/assets/js/libs/infinite-scroll.pkgd.min.js#deferload', '', '3.0.6', false);
  wp_enqueue_script( 'custom-infinitescroll' );
  // Lazy load
  // docs: http://www.andreaverlicchi.eu/lazyload/
  wp_register_script( 'vanilla-lazyload', get_template_directory_uri() . '/assets/js/libs/lazyload.min.js#deferload', '', '16.1.0', false);
  wp_enqueue_script( 'vanilla-lazyload' );
  // Masonry
  // docs: https://masonry.desandro.com/
  $load_masonry = get_field( 'boxes_grid', 'options' );
  if ( $load_masonry === 'grid-masonry' ) {
    wp_register_script( 'theme-masonry', get_template_directory_uri() . '/assets/js/libs/masonry.pkgd.js#deferload', '', $theme_version, false);
    wp_enqueue_script( 'theme-masonry' );
  }
	// Recurring behaviors
  $ua = htmlentities($_SERVER['HTTP_USER_AGENT'], ENT_QUOTES, 'UTF-8');
  if (preg_match('~MSIE|Internet Explorer~i', $ua) || (strpos($ua, 'Trident/7.0') !== false && strpos($ua, 'rv:11.0') !== false)) {
    wp_register_script( 'theme-general-explorer', get_template_directory_uri() . '/assets/js/theme-general-explorer.min.js#deferload', '', $theme_version, true);
    wp_enqueue_script( 'theme-general-explorer' );
  }
	else {
    wp_register_script( 'theme-general', get_template_directory_uri() . '/assets/js/theme-general.min.js#deferload', '', $theme_version, true);
  	wp_enqueue_script( 'theme-general' );
  }
  // tocca
  wp_register_script( 'theme-tocca', get_template_directory_uri() . '/assets/js/libs/tocca.min.js#asyncload', '', $theme_version, true);
	wp_enqueue_script( 'theme-tocca' );
  // FontAwesome
  // docs: https://fontawesome.com/
	//wp_register_script( 'theme-fontawesome', 'https://kit.fontawesome.com/2ab89a2041.js#deferload', '', $theme_version, true);
	//wp_enqueue_script( 'theme-fontawesome' );
	}

<?php
if ( !is_admin() ) {
// load common css
//Disable Gutenberg style in Front
	function wps_deregister_styles() {
		wp_dequeue_style( 'wp-block-library' );
	}
	add_action( 'wp_print_styles', 'wps_deregister_styles', 100 );
function theme_css() {
	// versione del tema
	global $theme_version;

	// stili comuni
	wp_enqueue_style( 'theme-commnon', get_template_directory_uri() . '/style.min.css', '', $theme_version, 'all' );
	wp_enqueue_style( 'theme-font', 'https://fonts.googleapis.com/css?family=Dosis:400,600', '', $theme_version, 'all' );
	}
add_action( 'wp_enqueue_scripts', 'theme_css' );
}

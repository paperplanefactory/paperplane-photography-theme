<?php
if ( !is_admin() ) {
	// load common css
	// Disable Gutenberg style in Front
	function wps_deregister_styles() {
		wp_dequeue_style( 'wp-block-library' );
	}
	add_action( 'wp_print_styles', 'wps_deregister_styles', 100 );
	function paperplane_photograpy_theme_css() {
		// theme version
		global $theme_version;
		$font_loader = get_field( 'link_google_font', 'option' );
		// stili comuni
		wp_enqueue_style( 'theme-commnon', get_template_directory_uri() . '/style.min.css', '', $theme_version, 'all' );
		wp_enqueue_style( 'theme-font', $font_loader, '', $theme_version, 'all' );
	}
	add_action( 'wp_enqueue_scripts', 'paperplane_photograpy_theme_css' );
}

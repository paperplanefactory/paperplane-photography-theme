<?php
// register menus used by theme
function register_theme_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
      'header-overlay-menu' => __( 'Header Overlay Menu' ),
      'header-overlay-menu-mobile' => __( 'Header Overlay Menu Mobile' )
    )
  );
}
add_action( 'init', 'register_theme_menus' );

// setup options pages - ACF PRO required
if( function_exists('acf_add_options_page') ) {
  // gestione tema per admin
  $option_page = acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title' 	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability' 	=> 'update_core',
		'redirect' 	=> false
	));
  $parent = acf_add_options_page(array(
    'page_title' 	=> 'Site settings',
		'menu_title'	=> 'Site settings',
		'capability'	=> 'edit_posts',
		//'menu_slug' 	=> 'impostazioni-sito',
		//'redirect'		=> false
	));
  // tipografia
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Color & Typo options',
		'menu_title' 	=> 'Color & Typo options',
		'parent_slug' 	=> $parent['menu_slug'],
	));
  // gallery
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Image gallery options',
		'menu_title' 	=> 'Image gallery options',
		'parent_slug' 	=> $parent['menu_slug'],
	));
  // archivi
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Archives',
		'menu_title' 	=> 'Archives',
		'parent_slug' 	=> $parent['menu_slug'],
	));
}

// show flamingo to editors
add_filter( 'flamingo_map_meta_cap', 'for_editors_flamingo_map_meta_cap' );
function for_editors_flamingo_map_meta_cap( $meta_caps ) {
	$meta_caps = array_merge( $meta_caps, array(
		'flamingo_edit_contacts' => 'edit_pages',
		'flamingo_edit_inbound_messages' => 'edit_pages',
	) );

	return $meta_caps;
}

// WP Fastest Cache cleared also when saving an options page
function clear_option_pages_cache() {
	$screen = get_current_screen();
	if ( ( strpos($screen->id, 'acf-options-archives') == true ) || (strpos($screen->id, 'acf-options-color-typo-options') == true) || (strpos($screen->id, 'acf-options-image-gallery-options') == true) ) {
    if ( function_exists( 'wpfc_clear_all_cache' ) ) {
    wpfc_clear_all_cache(true);
  }
	}
}
add_action('acf/save_post', 'clear_option_pages_cache', 20);

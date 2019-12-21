<?php
function cptui_register_my_cpts() {

	/**
	 * Post Type: News.
	 */

	$labels = [
		"name" => __( "News", "custom-post-type-ui" ),
		"singular_name" => __( "News", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "News", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"delete_with_user" => false,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "news", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail" ],
	];

	register_post_type( "news", $args );

	/**
	 * Post Type: Books.
	 */

	$labels = [
		"name" => __( "Books", "custom-post-type-ui" ),
		"singular_name" => __( "Book", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "Books", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"delete_with_user" => false,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "book", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail" ],
	];

	register_post_type( "book", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );

<?php
// admin footer
function remove_footer_admin () {
echo 'Fueled by <a href="http://www.wordpress.org" target="_blank">WordPress</a> | Designed by <a href="http://www.paperplanefactory.com" target="_blank">PaperPlane Factory</a></p>';
}
add_filter('admin_footer_text', 'remove_footer_admin');

// admin help box
add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
function my_custom_dashboard_widgets() {
global $wp_meta_boxes;
wp_add_dashboard_widget('custom_help_widget', 'Info about this WordPress theme', 'custom_dashboard_help');
}
function custom_dashboard_help() {
echo '<a href="http://www.paperplanefactory.com" target="_blank"><img src="' . get_template_directory_uri() . '/assets/images/admin-images/logo-paper.jpg" width="200" /></a><h2>Welcome to your site dashboard!</h2><p>Your site - <strong>' . get_bloginfo('name') . '</strong> - is based on <a href="https://wordpress.org/" target="_blank">WordPress</a> and uses a theme designed and written by <a href="http://www.paperplanefactory.com" target="_blank">Paper Plane Factory.</a><br />
<strong>Need more info? <a href="mailto:info@paperplanefactory.com">Contact us</a>!!</strong></p>';
}

// remove junk from head
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

// kill the admin nag
if (!current_user_can('edit_users')) {
	add_action('init', create_function('$a', "remove_action('init', 'wp_version_check');"), 2);
	add_filter('pre_option_update_core', create_function('$a', "return null;"));
}

// custom login
add_filter( 'login_headerurl', 'namespace_login_headerurl' );

// rimuovo emoji
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

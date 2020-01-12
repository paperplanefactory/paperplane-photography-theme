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
echo '<a href="https://www.paperplanefactory.com"><img src="' . get_template_directory_uri() . '/assets/images/admin-images/logo-paper.jpg" width="200" /></a><h2>Welcome to your site dashboard!</h2><p>Your site - <strong>' . get_bloginfo('name') . '</strong> - is based on <a href="https://wordpress.org/">WordPress</a> and uses a theme designed and written by <a href="https://www.paperplanefactory.com">Paper Plane Factory.</a><br />
<strong>For more info please read <a href="https://github.com/paperplanefactory/paperplane-photography-theme/blob/master/README.md">documentation</a> on GitHub.</strong></p>';
}

// rimuovo emoji
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

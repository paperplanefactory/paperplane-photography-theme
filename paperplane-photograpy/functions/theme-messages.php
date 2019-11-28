<?php
// Ricordarsi di abilitare il plugin paperplane-custom-welcome-email per la gestione delle e-mail di iscrizione al sito che non possono essere modificate da qui.

//no messaggi di errore in login
function no_errors_please(){
  return '<strong>Login errato!</strong><br />Per motivi di sicurezza non ti diremo se l&rsquo;username che ha provato ad inserire è giusto o sbagliato.<br />Puoi provare a reimpostare la password con il link che trovi qui sotto oppure, se sei disperato, contatta Paper Plane Factory.';
}
add_filter( 'login_errors', 'no_errors_please' );

// remove version
function wpbeginner_remove_version() {
return '';
}
add_filter('the_generator', 'wpbeginner_remove_version');

// admin footer
function remove_footer_admin () {
echo 'Fueled by <a href="http://www.wordpress.org" target="_blank">WordPress</a> | Designed by <a href="http://www.paperplanefactory.com" target="_blank">PaperPlane Factory</a></p>';
}
add_filter('admin_footer_text', 'remove_footer_admin');

// admin help box
add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
function my_custom_dashboard_widgets() {
global $wp_meta_boxes;
wp_add_dashboard_widget('custom_help_widget', 'Supporto per il tuo sito', 'custom_dashboard_help');
}
function custom_dashboard_help() {
echo '<a href="http://www.paperplanefactory.com" target="_blank"><img src="' . get_template_directory_uri() . '/images/admin-images/logo-paper.jpg" width="200" /></a><h2>Benvenuto nelll&rsquo;area di amministrazione del tuo sito!</h2><p>Il sito <strong>' . get_bloginfo('name') . '</strong> è basato su <a href="https://wordpress.org/" target="_blank">WordPress</a> e utilizza un tema appositamente creato da <a href="http://www.paperplanefactory.com" target="_blank">Paper Plane Factory.</a><br />
<strong>Hai bisogno di aiuto? <a href="mailto:info@paperplanefactory.com">Contattaci</a>!!</strong></p>';
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

// login custom logo
function namespace_login_style() {
    echo '<style>.login h1 a { background-image: url( ' . get_template_directory_uri() . '/images/admin-images/logo-login.png ) !important; }</style>';
}
add_action( 'login_head', 'namespace_login_style' );

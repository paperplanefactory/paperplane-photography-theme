<?php
add_action( 'after_switch_theme', 'check_theme_dependencies', 10, 2 );
function check_theme_dependencies( $oldtheme_name, $oldtheme ) {
  include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
  if ( !is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ) {
    // Update default admin notice: Theme not activated.
    add_filter( 'gettext', 'update_activation_admin_notice', 10, 3 );
    // Custom styling for default admin notice.
    add_action( 'admin_head', 'error_activation_admin_notice' );
    // Switch back to previous theme.
    switch_theme( $oldtheme->stylesheet );
    return false;
  }
}

function update_activation_admin_notice( $translated, $original, $domain ) {
  // Strings to translate.
  $strings = array(
    'New theme activated.' => 'Theme not activated. Before activating this theme please install and activate Advanced Custom Fields PRO.'
  );
  if ( isset( $strings[$original] ) ) {
    // Translate but without running all the filters again.
    $translations = get_translations_for_domain( $domain );
    $translated = $translations->translate( $strings[$original] );
  }
  return $translated;
}

function error_activation_admin_notice() {
  echo '<style>#message2{border-left-color:#dc3232;}</style>';
}


// set theme version
global $theme_version;
if( class_exists('acf') ) {
  $theme_version = get_field( 'theme_version', 'option' );
}
// CSS loading management
include_once "functions/theme-stylesloader.php";
// scrips loading management
include_once "functions/theme-scriptsloader.php";
// images loading
include_once "functions/theme-images.php";
// lazy load
include_once "functions/theme-lazyload.php";
// gestione trim testi
include_once "functions/theme-txts.php";
// WordPress admin stuff
include_once "functions/theme-messages.php";
// custom menus
include_once "functions/theme-menus.php";
// ACF theme options fields
include_once "functions/theme-acf-options-fields.php";
// custom post types
include_once "functions/theme-cpts.php";

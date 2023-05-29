<?php
add_action('after_switch_theme', 'check_theme_dependencies', 10, 2);
function check_theme_dependencies($oldtheme_name, $oldtheme)
{
  include_once(ABSPATH . 'wp-admin/includes/plugin.php');
  function my_activation_settings($theme)
  {
    if ('Paperplane Photography Theme' != $theme) {
      if (!is_plugin_active('advanced-custom-fields-pro/acf.php')) {
        // Update default admin notice: Theme not activated.
        add_filter('gettext', 'update_activation_admin_notice', 10, 3);
        // Custom styling for default admin notice.
        add_action('admin_head', 'error_activation_admin_notice');
        // Switch back to previous theme.
        switch_theme($oldtheme->stylesheet);
        return false;
      }
    }
    return;
  }
}

function update_activation_admin_notice($translated, $original, $domain)
{
  // Strings to translate.
  $strings = array(
    'New theme activated.' => 'Theme not activated. Before activating this theme please install and activate Advanced Custom Fields PRO.'
  );
  if (isset($strings[$original])) {
    // Translate but without running all the filters again.
    $translations = get_translations_for_domain($domain);
    $translated = $translations->translate($strings[$original]);
  }
  return $translated;
}

function error_activation_admin_notice()
{
  echo '<style>#message2{border-left-color:#dc3232;}</style>';
}


// set theme version
global $theme_version;
if (class_exists('acf')) {
  $theme_version = get_field('theme_version', 'option');
}
// CSS loading management
include_once "includes/theme-stylesloader.php";
// scrips loading management
include_once "includes/theme-scriptsloader.php";
// images loading
include_once "includes/theme-images.php";
// lazy load
include_once "includes/theme-lazyload.php";
// WordPress admin stuff
include_once "includes/theme-messages.php";
// custom menus
include_once "includes/theme-menus.php";
// custom post types
include_once "includes/theme-cpts.php";
// PWA
include_once "includes/theme-pwa.php";
// taxonomies listing
include_once "includes/theme-taxonomies-listing.php";
// taxonomies listing
include_once "includes/theme-updater.php";




require 'includes/plugin-update-checker/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$myUpdateChecker = PucFactory::buildUpdateChecker(
  'hhttps://github.com/paperplanefactory/paperplane-photography-theme/',
  __FILE__,
  'paperplane-photography-theme'
);

//Set the branch that contains the stable release.
$myUpdateChecker->setBranch('master');

//Optional: If you're using a private repository, specify the access token like this:
//$myUpdateChecker->setAuthentication('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');
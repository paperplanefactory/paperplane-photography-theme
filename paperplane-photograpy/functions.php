<?php
// imposto la versione del tema
global $theme_version;
if( class_exists('acf') ) {
  $theme_version = get_field( 'theme_version', 'option' );
}
// gestione caricamento css
include_once "functions/theme-stylesloader.php";
// gestione caricamento script
include_once "functions/theme-scriptsloader.php";
// gestione immagini
include_once "functions/theme-images.php";
// lazy load
include_once "functions/theme-lazyload.php";
// gestione trim testi
include_once "functions/theme-txts.php";
// gestione core WordPress
include_once "functions/theme-messages.php";
// custom menus
include_once "functions/theme-menus.php";
// ACF theme options fields
include_once "functions/theme-acf-options-fields.php";
// custom post types
include_once "functions/theme-cpts.php";

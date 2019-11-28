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
// slides
//include_once "functions/theme-slides.php";
// gestione tassonomie
include_once "functions/theme-taxonomies.php";

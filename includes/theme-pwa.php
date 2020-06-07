<?php
function set_pwa_data() {
  // check if using default or custom favicon
  $favicons_path = get_field( 'favicons_path', 'options' );
  if ( $favicons_path === 'default-path' ) {
    $favicons_folder = get_stylesheet_directory_uri().'/assets/images/favicons/';
  }
  else {
    $favicons_folder = get_home_url().'/favicons/';
  }
  $manifest_data = array(
    'short_name' => get_bloginfo( 'name' ),
  	'name' => get_bloginfo( 'name' ),
    'start_url' => '/?utm_source=pwa-homescreen',
    'icons' => array(
      array(
        'src' => $favicons_folder.'android-icon-48x48.png',
        'type' => 'image\/png',
        'sizes' => '48x48'
      ),
      array(
        'src' => $favicons_folder.'android-icon-96x96.png',
        'type' => 'image\/png',
        'sizes' => '96x96'
      ),
      array(
        'src' => $favicons_folder.'android-icon-144x144.png',
        'type' => 'image\/png',
        'sizes' => '144x144',
      ),
      array(
        'src' => $favicons_folder.'android-icon-192x192.png',
        'type' => 'image\/png',
        'sizes' => '192x192',
      ),
      array(
        'src' => $favicons_folder.'android-icon-512x512.png',
        'type' => 'image\/png',
        'sizes' => '512x512',
      ),
    ),
    'display' => 'fullscreen',
    'lang' => 'en-EN',
    'background_color' => '#303030',
    'theme_color' => '#303030',
    'orientation' => 'portrait-primary'
  );

  $manifest_data = stripslashes( json_encode( $manifest_data ) );

  $file = '/../../../../manifest.json';
  file_put_contents( __DIR__ . $file, $manifest_data );


  copy( __DIR__ . '/../assets//pwa/sw.js', __DIR__ . '/../../../../sw.js');
}

add_action('acf/save_post', 'set_pwa_data', 20);

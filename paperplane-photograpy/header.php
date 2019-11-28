<?php
// Paperplane _blankTheme - template per header.
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Chrome, Firefox OS and Opera -->
<meta name="theme-color" content="#FFFFFF">
<!-- Windows Phone -->
<meta name="msapplication-navbutton-color" content="#FFFFFF">
<!-- iOS Safari -->
<meta name="apple-mobile-web-app-status-bar-style" content="#FFFFFF">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head();
// stabilisco il device
$module_count = 0;
global $module_count;
?>
<link rel="apple-touch-icon" sizes="57x57" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicons/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicons/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicons/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicons/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicons/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicons/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicons/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicons/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicons/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="<?php bloginfo('stylesheet_directory'); ?>/images/favicons/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicons/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicons/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicons/favicon-16x16.png">
<link rel="manifest" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicons/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="<?php bloginfo('stylesheet_directory'); ?>/images/favicons/ms-icon-144x144.png">
<?php
global $contatore_foto;
$contatore_foto = get_field( 'contatore_foto', 'options' );
global $elenco_foto;
$elenco_foto = get_field( 'elenco_foto', 'options' );
$evidenziatore_foto = get_field( 'evidenziatore_foto', 'options' );
$torna_elenco = get_field( 'torna_elenco', 'options' );

$theme_color_scheme = get_field( 'theme_color_scheme', 'options' );
if( empty( $theme_color_scheme ) ) {
  $theme_color_scheme = 'clear-theme';
}
 ?>
</head>

<body class="<?php echo $theme_color_scheme; ?>">
<div id="preheader"></div>
<header id="header" class="bg-5">
  <div class="wrapper-padded">
    <div id="header-structure">
      <div class="logo delight-area">
        <a href="<?php echo home_url(); ?>" rel="bookmark" title="homepage - <?php echo get_bloginfo( 'name' ); ?>">
          <?php echo get_bloginfo( 'name' ); ?>
        </a>
      </div>
      <nav class="swupped menu">
        <?php if ( is_singular( 'post' ) || is_attachment() ) : ?>
          <ul class="navi-info swupped-link">
            <?php if ( $torna_elenco === 'si' ) : ?>
              <li>
                <?php
                $parent = get_post_field( 'post_parent', $id);
                if ( $parent != '' ) {
                  $category = get_the_category($parent);
                }
                else {
                  $category = get_the_category($post->ID);
                }
                $first_category = $category[0];
                $first_category_url = get_category_link( $first_category ); ?>
                <a href="<?php echo $first_category_url; ?>" title="back to list"><i class="fas fa-step-backward delight-area"></i></a>
              </li>
            <?php endif; ?>
            <?php if ( $evidenziatore_foto === 'si' ) : ?>
              <li>
                <span class="highlight all-pointer-events pointered"><i class="fas fa-eye"></i></span>
              </li>
            <?php endif; ?>
            <?php if ( $elenco_foto === 'si' ) : ?>
              <li>
                <span class="list thumb-list delight-area pointered" title="view images list"><i class="fas fa-list"></i></i></span>
              </li>
            <?php endif; ?>
          </ul>
        <?php endif; ?>
        <?php if ( is_singular( 'news' ) ) : ?>
          <ul class="navi-info swupped-link">
            <li>
              <a href="/news-archive/" class="delight-area" title="back to list"><i class="fas fa-step-backward"></i></a>
            </li>
          </ul>
        <?php endif; ?>
        <?php if ( is_singular( 'book' ) ) : ?>
          <ul class="navi-info swupped-link">
            <li>
              <a href="/books-page/" class="delight-area" title="back to list"><i class="fas fa-step-backward"></i></a>
            </li>
          </ul>
        <?php endif; ?>
        <?php if ( has_nav_menu( 'header-menu' ) ) {
          wp_nav_menu( array( 'theme_location' => 'header-menu', 'container' => 'ul', 'menu_class' => 'top-menu delight-area' ) );
        } ?>
      </nav>
      <div class="hamburger delight-area">
        <div type="button" aria-haspopup="true" aria-expanded="false" aria-controls="menu" aria-label="Navigation" class="hambuger-element ham-activator">
          <span></span>
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
    </div>
  </div>
</header>


<div id="head-overlay" class="bg-5 blurred">
  <div class="scroll-opportunity">
    <div class="overlay-content">
      <nav class="swupped menu-overlay">
        <?php if ( has_nav_menu( 'header-overlay-menu' ) ) {
          wp_nav_menu( array( 'theme_location' => 'header-overlay-menu', 'container' => 'ul', 'menu_class' => 'voices' ) );
        } ?>
      </nav>
    </div>
  </div>
</div>

<div class="swupped">

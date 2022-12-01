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
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head();
$posts_per_page = get_option('posts_per_page');
// check if using default or custom favicon
$favicons_path = get_field( 'favicons_path', 'options' );
if ( $favicons_path === 'default-path' ) {
  $favicons_folder = get_stylesheet_directory_uri().'/assets/images/favicons/';
}
else {
  $favicons_folder = get_home_url().'/favicons/';
}
global $image_gallery_system;
global $contatore_foto;
global $show_abstract;
global $elenco_foto;
global $show_cats;
global $image_gallery_system;
global $show_navigation_between_portfolio_items;
$show_hamburger_button_desktop = get_field( 'show_hamburger_button_desktop', 'options' );
if ( $show_hamburger_button_desktop === 'yes' ) {
  $show_hamburger_button_desktop_class = '';
  $fullwidth_menu_class = '';
}
else {
  $show_hamburger_button_desktop_class = 'only-mobile';
  $fullwidth_menu_class = 'full-width-navi';
}
$show_search_form = get_field( 'show_search_form', 'options' );
$contatore_foto = get_field( 'contatore_foto', 'options' );
$elenco_foto = get_field( 'elenco_foto', 'options' );
$evidenziatore_foto = get_field( 'evidenziatore_foto', 'options' );
$show_play_pause_button = get_field( 'show_play_pause_button', 'options' );
if ( $show_play_pause_button === 'si' ) {
  $show_play_pause_button_localstorage = 'pause';
  $play_pause_timer = get_field( 'set_image_duration', 'options' );
}
else {
  $show_play_pause_button_localstorage = 'notnow';
  $play_pause_timer = 3000;
}
$torna_elenco = get_field( 'torna_elenco', 'options' );
$custom_logo = get_field( 'custom_logo', 'options' );
$custom_logo_dark = get_field( 'custom_logo_dark', 'options' );
$start_color_scheme = get_field( 'start_color_scheme', 'options' );
$show_abstract = get_field( 'show_abstract', 'options' );
$show_cats = get_field( 'show_cats', 'options' );
if ( get_field( 'custom_colors', 'options' ) ) {
  $custom_colors = get_field( 'custom_colors', 'options' );
}
else {
  $custom_colors = 0;
}

$image_gallery_system = get_field( 'image_gallery_system' );
if ( !isset( $image_gallery_system ) ) {
  $image_gallery_system = 'one-page-one-picture';
}
else {
  $image_gallery_system = get_field( 'image_gallery_system' );
}

$show_navigation_between_portfolio_items = get_field( 'show_navigation_between_portfolio_items', 'options' );
?>
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="<?php echo $favicons_folder; ?>ms-icon-144x144.png">
<link rel="apple-touch-icon" sizes="57x57" href="<?php echo $favicons_folder; ?>apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="<?php echo $favicons_folder; ?>apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $favicons_folder; ?>apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="<?php echo $favicons_folder; ?>apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $favicons_folder; ?>apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="<?php echo $favicons_folder; ?>apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo $favicons_folder; ?>apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?php echo $favicons_folder; ?>apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo $favicons_folder; ?>apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo $favicons_folder; ?>android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo $favicons_folder; ?>favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="<?php echo $favicons_folder; ?>favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo $favicons_folder; ?>favicon-16x16.png">
<link rel="manifest" href="<?php echo get_home_url(); ?>/manifest.json">
<?php if ( get_field('enable_pwa', 'options' ) === 'yes' ) : ?>
  <script type="text/javascript">
  // If service workers are supported, and one isn't already registered
  if ('serviceWorker' in navigator && !navigator.serviceWorker.controller) {
    navigator.serviceWorker.register('/sw.js');
    //console.log("sw.js loaded...");
  }
  </script>
<?php endif; ?>

<style>
body {
  font-family: <?php the_field( 'body_font_family', 'options' ); ?>;
  font-weight: <?php the_field( 'body_font_weight', 'options' ); ?>;
}
h1, h2, h3, h4, h5, h6, .as-h4 {
  font-family: <?php the_field( 'titles_font_family', 'options' ); ?>;
  font-weight: <?php the_field( 'titles_font_weight', 'options' ); ?>;
}
p, .content-styled ul, .content-styled ol {
  font-family: <?php the_field( 'paragraphs_font_family', 'options' ); ?>;
  font-weight: <?php the_field( 'paragraphs_font_weight', 'options' ); ?>;
}

.menu-overlay,
.menu-overlay p,
.menu,
.menu p {
  font-family: <?php the_field( 'menu_font_family', 'options' ); ?>;
  font-weight: <?php the_field( 'menu_font_weight', 'options' ); ?>;
}
.navi-text {
  font-family: <?php the_field( 'navitext_font_family', 'options' ); ?>;
  font-weight: <?php the_field( 'navitext_font_weight', 'options' ); ?>;
}
.cta-1 {
  font-family: <?php the_field( 'cta_font_family', 'options' ); ?>;
  font-weight: <?php the_field( 'cta_font_weight', 'options' ); ?>;
}
.pay-picture-list button {
  font-family: <?php the_field( 'paragraphs_font_family', 'options' ); ?>;
  font-weight: <?php the_field( 'titles_font_weight', 'options' ); ?>;
}
label,
input[type=text],
input[type=email],
input[type=number],
input[type=tel],
textarea,
select,
input[type=submit],
.form-hold,
.form-hold p,
.wpcf7-not-valid-tip,
.wpcf7-validation-errors,
.wpcf7-mail-sent-ng,
.wpcf7-mail-sent-ok,
.wp-caption.alignnone .wp-caption-text,
.wp-caption.aligncenter .wp-caption-text,
.wp-caption.alignleft .wp-caption-text,
.wp-caption.alignright .wp-caption-text,
.wp-caption-text {
  font-family: <?php the_field( 'inputs_font_family', 'options' ); ?>;
  font-weight: <?php the_field( 'inputs_font_weight', 'options' ); ?>;
}
a:link, a:visited, a:hover, a:active, .video-slide .slick-next, .video-slide .prev-next {
  color: #191919;
}

<?php
if ( $custom_colors == 1 ) :
  $hex = get_field( 'custom_color_1', 'options' );
  list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
  //echo "$hex -> $r $g $b";
  ?>
body.clear-theme {
  color: <?php the_field( 'custom_color_5', 'options' ); ?>;
  background-color: <?php the_field( 'custom_color_1', 'options' ); ?>;
}

body.clear-theme .eye i {
  background-color: <?php the_field( 'custom_color_1', 'options' ); ?>;
}

.clear-theme div,
.clear-theme footer,
.clear-theme header,
.clear-theme li,
.clear-theme nav,
.clear-theme ul {
  border-color: <?php the_field( 'custom_color_2', 'options' ); ?> !important;
}

.clear-theme .logo-dark {
  display: none;
}

.clear-theme input[type],
.clear-theme textarea {
  border-color: <?php the_field( 'custom_color_3', 'options' ); ?> !important;
}

.clear-theme ::-moz-selection {
  background: <?php the_field( 'custom_color_5', 'options' ); ?>;
  color: <?php the_field( 'custom_color_1', 'options' ); ?>;
}

.clear-theme ::selection {
  background: <?php the_field( 'custom_color_5', 'options' ); ?>;
  color: <?php the_field( 'custom_color_1', 'options' ); ?>;
}

.clear-theme ::-moz-selection {
  background: <?php the_field( 'custom_color_5', 'options' ); ?>;
  color: <?php the_field( 'custom_color_1', 'options' ); ?>;
}

.clear-theme ::-webkit-selection {
  background: <?php the_field( 'custom_color_5', 'options' ); ?>;
  color: <?php the_field( 'custom_color_1', 'options' ); ?>;
}

.clear-theme ::-webkit-input-placeholder {
  color: <?php the_field( 'custom_color_5', 'options' ); ?>;
}

.clear-theme :-moz-placeholder {
  color: <?php the_field( 'custom_color_5', 'options' ); ?>;
}

.clear-theme ::-moz-placeholder {
  color: <?php the_field( 'custom_color_5', 'options' ); ?>;
}

.clear-theme #paperplane-cookie-notice {
  background-color: <?php the_field( 'custom_color_1', 'options' ); ?> !important;
  color: <?php the_field( 'custom_color_4', 'options' ); ?> !important;
}

.clear-theme #paperplane-cookie-notice a {
  background-color: <?php the_field( 'custom_color_4', 'options' ); ?>;
  color: <?php the_field( 'custom_color_1', 'options' ); ?> !important;
}

.clear-theme .paperplane-gdpr-content-message {
  background-color: <?php the_field( 'custom_color_5', 'options' ); ?>;
  color: <?php the_field( 'custom_color_1', 'options' ); ?>;
}

.clear-theme .open_head .hambuger-element span {
  background-color: <?php the_field( 'custom_color_5', 'options' ); ?> !important;
}

.clear-theme .hambuger-element span {
  background: <?php the_field( 'custom_color_5', 'options' ); ?>;
}

.clear-theme .hambuger-element:hover span {
  background: <?php the_field( 'custom_color_3', 'options' ); ?>;
}

.clear-theme .txt-1 {
  color: <?php the_field( 'custom_color_5', 'options' ); ?>;
}

.clear-theme .menu ul li .sub-menu {
  background-color: <?php the_field( 'custom_color_1', 'options' ); ?>;
}

.clear-theme .menu ul li .sub-menu li {
  border-bottom-color: <?php the_field( 'custom_color_2', 'options' ); ?>;
}

.clear-theme .txt-2 {
  color: <?php the_field( 'custom_color_5', 'options' ); ?>;
}

.clear-theme .txt-3 {
  color: <?php the_field( 'custom_color_3', 'options' ); ?>;
}

.clear-theme .txt-4 {
  color: <?php the_field( 'custom_color_2', 'options' ); ?>;
}

.clear-theme .txt-5 {
  color: <?php the_field( 'custom_color_1', 'options' ); ?>;
}

.clear-theme .category-list:before {
  background-color: <?php the_field( 'custom_color_5', 'options' ); ?>;
}

.clear-theme .content-styled ul li:before {
  color: <?php the_field( 'custom_color_5', 'options' ); ?>;
}

.clear-theme ol > li:before {
  color: <?php the_field( 'custom_color_5', 'options' ); ?>;
}

.clear-theme .bg-1 {
  background-color: <?php the_field( 'custom_color_5', 'options' ); ?>;
}

.clear-theme .bg-2 {
  background-color: <?php the_field( 'custom_color_5', 'options' ); ?>;
}

.clear-theme .bg-3 {
  background-color: <?php the_field( 'custom_color_3', 'options' ); ?>;
}

.clear-theme .bg-4 {
  background-color: <?php the_field( 'custom_color_2', 'options' ); ?>;
}

.clear-theme .bg-5 {
  background-color: <?php the_field( 'custom_color_1', 'options' ); ?>;
}

.clear-theme a:link,
.clear-theme a:visited {
  color: <?php the_field( 'custom_color_5', 'options' ); ?>;
}

.clear-theme a:hover {
  color: <?php the_field( 'custom_color_3', 'options' ); ?>;
}

.clear-theme .current-menu-item a,
.clear-theme .current-page-ancestor a {
  color: <?php the_field( 'custom_color_3', 'options' ); ?> !important;
}

.clear-theme .navi-info, .clear-theme .pay-picture button {
  color: <?php the_field( 'custom_color_3', 'options' ); ?>;
}

.clear-theme .navi-info a:link,
.clear-theme .navi-info a:visited {
  color: <?php the_field( 'custom_color_3', 'options' ); ?>;
}

.clear-theme .navi-info a:hover {
  color: <?php the_field( 'custom_color_4', 'options' ); ?>;
}

.clear-theme .highlight:hover,
.clear-theme .list:hover {
  color: <?php the_field( 'custom_color_5', 'options' ); ?>;
}

.clear-theme .txt-4:link, .clear-theme .txt-4:visited, .clear-theme .video-slide .slick-next, .clear-theme .video-slide .prev-next {
  color: <?php the_field( 'custom_color_4', 'options' ); ?>;
}

.clear-theme .txt-4:hover {
  color: <?php the_field( 'custom_color_5', 'options' ); ?>;
}

.clear-theme .flex-hold-title {
  background-color: rgba(<?php echo $r; ?>, <?php echo $g; ?>, <?php echo $b; ?>, 0.85);
}

.clear-theme .sk-folding-cube .sk-cube:before {
  background-color: <?php the_field( 'custom_color_5', 'options' ); ?>;
}

.clear-theme .form-hold label {
  color: <?php the_field( 'custom_color_5', 'options' ); ?>;
}

.clear-theme .form-hold input[type=email],
.clear-theme .form-hold input[type=number],
.clear-theme .form-hold input[type=tel],
.clear-theme .form-hold input[type=text],
.clear-theme .form-hold button {
  color: <?php the_field( 'custom_color_5', 'options' ); ?>;
}

.clear-theme .form-hold textarea {
  color: <?php the_field( 'custom_color_5', 'options' ); ?>;
}

.clear-theme .form-hold select {
  color: <?php the_field( 'custom_color_2', 'options' ); ?>;
}

.clear-theme .form-hold input[type=submit] {
  color: <?php the_field( 'custom_color_1', 'options' ); ?>;
  background-color: <?php the_field( 'custom_color_5', 'options' ); ?>;
}

.clear-theme .form-hold input[type=submit]:hover {
  color: <?php the_field( 'custom_color_5', 'options' ); ?>;
  background-color: <?php the_field( 'custom_color_2', 'options' ); ?>;
}

.view-more-button {
  color: <?php the_field( 'custom_color_1', 'options' ); ?>;
  background-color: <?php the_field( 'custom_color_5', 'options' ); ?>;
  border-color: <?php the_field( 'custom_color_1', 'options' ); ?>;
}

.view-more-button:hover {
  color: <?php the_field( 'custom_color_5', 'options' ); ?>;
  background-color: <?php the_field( 'custom_color_1', 'options' ); ?>;
}

.pay-picture-list button {
  color: <?php the_field( 'custom_color_1', 'options' ); ?>;
  background-color: <?php the_field( 'custom_color_5', 'options' ); ?>;
  border-color: <?php the_field( 'custom_color_5', 'options' ); ?>;
}

.pay-picture-list button:hover {
  color: <?php the_field( 'custom_color_5', 'options' ); ?>;
  background-color: <?php the_field( 'custom_color_1', 'options' ); ?>;
}
<?php else : ?>
body.clear-theme {
  color: #303030;
  background-color: #FFFFFF;
}

body.clear-theme .eye i {
  background-color: #FFFFFF;
}

.clear-theme div,
.clear-theme footer,
.clear-theme header,
.clear-theme li,
.clear-theme nav,
.clear-theme ul {
  border-color: #F9F9F9 !important;
}

.clear-theme .logo-dark {
  display: none;
}

.clear-theme input[type],
.clear-theme textarea {
  border-color: #AFAFAF !important;
}

.clear-theme ::-moz-selection {
  background: #303030;
  color: #FFFFFF;
}

.clear-theme ::selection {
  background: #303030;
  color: #FFFFFF;
}

.clear-theme ::-moz-selection {
  background: #303030;
  color: #FFFFFF;
}

.clear-theme ::-webkit-selection {
  background: #303030;
  color: #FFFFFF;
}

.clear-theme ::-webkit-input-placeholder {
  color: #303030;
}

.clear-theme :-moz-placeholder {
  color: #303030;
}

.clear-theme ::-moz-placeholder {
  color: #303030;
}

.clear-theme #paperplane-cookie-notice {
  background-color: #FFFFFF !important;
  color: #4D4D4D !important;
}

.clear-theme #paperplane-cookie-notice a {
  background-color: #4D4D4D;
  color: #FFFFFF !important;
}

.clear-theme .paperplane-gdpr-content-message {
  background-color: #303030;
  color: #FFFFFF;
}

.clear-theme .open_head .hambuger-element span {
  background-color: #303030 !important;
}

.clear-theme .hambuger-element span {
  background: #303030;
}

.clear-theme .hambuger-element:hover span {
  background: #AFAFAF;
}

.menu ul li .sub-menu {
  background-color: #FFFFFF;
}

.menu ul li .sub-menu li {
  border-bottom-color: #F9F9F9;
}

.clear-theme .txt-1 {
  color: #303030;
}

.clear-theme .txt-2 {
  color: #303030;
}

.clear-theme .txt-3 {
  color: #AFAFAF;
}

.clear-theme .txt-4 {
  color: #F9F9F9;
}

.clear-theme .txt-5 {
  color: #FFFFFF;
}

.clear-theme .category-list:before {
  background-color: #303030;
}

.clear-theme .content-styled ul li:before {
  color: #303030;
}

.clear-theme ol > li:before {
  color: #303030;
}

.clear-theme .bg-1 {
  background-color: #303030;
}

.clear-theme .bg-2 {
  background-color: #303030;
}

.clear-theme .bg-3 {
  background-color: #AFAFAF;
}

.clear-theme .bg-4 {
  background-color: #F9F9F9;
}

.clear-theme .bg-5 {
  background-color: #FFFFFF;
}

.clear-theme a:link,
.clear-theme a:visited {
  color: #303030;
}

.clear-theme a:hover {
  color: #AFAFAF;
}

.clear-theme .current-menu-item a,
.clear-theme .current-page-ancestor a {
  color: #AFAFAF !important;
}

.clear-theme .navi-info {
  color: #AFAFAF;
}

.clear-theme .navi-info a:link,
.clear-theme .navi-info a:visited {
  color: #AFAFAF;
}

.clear-theme .navi-info a:hover {
  color: #4D4D4D;
}

.clear-theme .highlight:hover,
.clear-theme .list:hover {
  color: #303030;
}

.clear-theme .txt-4:link, .clear-theme .txt-4:visited {
  color: #4D4D4D;
}

.clear-theme .txt-4:hover {
  color: #303030;
}

.clear-theme .pay-picture button {
  color: #64D31C;
}

.clear-theme .flex-hold-title {
  background-color: rgba(255, 255, 255, 0.85);
}

.clear-theme .sk-folding-cube .sk-cube:before {
  background-color: #303030;
}

.clear-theme .form-hold label {
  color: #303030;
}

.clear-theme .form-hold input[type=email],
.clear-theme .form-hold input[type=number],
.clear-theme .form-hold input[type=tel],
.clear-theme .form-hold input[type=text] {
  color: #303030;
}

.clear-theme .form-hold textarea {
  color: #303030;
}

.clear-theme .form-hold select {
  color: #F9F9F9;
}

.clear-theme .form-hold input[type=submit] {
  color: #FFFFFF;
  background-color: #303030;
}

.clear-theme .form-hold input[type=submit]:hover {
  color: #303030;
  background-color: #F9F9F9;
}

.view-more-button {
  color: #F9F9F9;
  background-color: #303030;
  border-color: #F9F9F9;
}

.view-more-button:hover {
  color: #303030;
  background-color: #AFAFAF;
}
.pay-picture-list button {
  color: #F9F9F9;
  background-color: #303030;
  border-color: #F9F9F9;
}

.pay-picture-list button:hover {
  color: #303030;
  background-color: #F9F9F9;
}

<?php endif; ?>
</style>
<?php
if ( $custom_colors == 1 ) {
  $tile_color = get_field( 'custom_color_1', 'options' );
}
else {
  $tile_color = '#FFFFFF';
}
?>
<!-- Chrome, Firefox OS and Opera -->
<meta name="theme-color" content="#DCDCDC" class="get-custom-tile-color-js" data-custom-color="<?php echo $tile_color; ?>">
<!-- Windows Phone -->
<meta name="msapplication-navbutton-color" content="#DCDCDC">
<!-- iOS Safari -->
<meta name="apple-mobile-web-app-status-bar-style" content="#DCDCDC">
<script type="text/javascript">
var show_play_pause_button_localstorage = "<?php echo $show_play_pause_button_localstorage ?>";
var play_pause_timer = "<?php echo $play_pause_timer ?>";
var start_color_scheme = "<?php echo $start_color_scheme ?>";
</script>
</head>
<body class="">
  <div class="eye de-highlight only-desktop">
    <span class="highlight all-pointer-events pointered" title="highlight this picture"><i class="icon-eye"></i></span>
  </div>
<div id="preheader"></div>
<header id="header" class="bg-5">
  <div class="wrapper-padded">
    <div id="header-structure">
      <?php if ( $custom_logo != '' ) : ?>
        <div class="logo pictured delight-area">
          <a href="<?php echo home_url(); ?>" rel="bookmark" title="homepage - <?php echo get_bloginfo( 'name' ); ?>" class="absl"></a>
          <div class="imaged logo-clear" style="background-image: url(<?php echo $custom_logo; ?>)"></div>
          <div class="imaged logo-dark" style="background-image: url(<?php echo $custom_logo_dark; ?>)"></div>
        </div>
      <?php else : ?>
        <div class="logo delight-area">
          <a href="<?php echo home_url(); ?>" rel="bookmark" title="homepage - <?php echo get_bloginfo( 'name' ); ?>">
            <?php the_field( 'header_custom_text', 'options' ); ?>
          </a>
        </div>
      <?php endif; ?>
      <nav class="swupped menu <?php echo $fullwidth_menu_class; ?>">
        <?php if ( has_nav_menu( 'header-menu' ) ) {
          wp_nav_menu( array( 'theme_location' => 'header-menu', 'container' => 'ul', 'menu_class' => 'top-menu delight-area' ) );
        } ?>
        <?php if ( is_singular( 'post' ) || is_attachment() ) : ?>
          <ul class="navi-info swupped-link">
            <?php
            if ( is_singular( 'post' ) ) {
              $picture_id = get_post_thumbnail_id();
            }
            elseif ( is_attachment() ) {
              $picture_id = get_the_ID();
            }
            $abilitare_la_vendita = get_field( 'abilitare_la_vendita', $picture_id );
            if ( $abilitare_la_vendita === 'si' && $image_gallery_system === 'one-page-one-picture' ) {
              $buy_button_status = 'shown';
            }
            else {
              $buy_button_status = '';
            }
              ?>
              <li class="buy-button <?php echo $buy_button_status; ?>">
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank" class="delight-area pay-picture">
                  <input type="hidden" name="cmd" value="_xclick">
                  <input type="hidden" name="business" value="<?php the_field( 'indirizzo_email_paypal', 'option' ); ?>">
                  <input type="hidden" name="lc" value="US">
                  <input type="hidden" name="item_name" value="<?php the_permalink(); ?>">
                  <input type="hidden" name="item_number" value="<?php $picture_id; ?>">
                  <input type="hidden" name="amount" value="<?php the_field( 'prezzo', $picture_id ); ?>">
                  <input type="hidden" name="currency_code" value="<?php the_field( 'tipo_di_valuta', 'option' ); ?>">
                  <input type="hidden" name="button_subtype" value="services">
                  <input type="hidden" name="no_note" value="0">
                  <input type="hidden" name="tax_rate" value="0">
                  <input type="hidden" name="shipping" value="<?php the_field( 'costi_di_spedizione', 'option' ); ?>">
                  <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">
                  <button type="submit" title="Buy this picture" aria-label="<?php _e( 'Buy this picture', 'paperplane-photography-theme' );?>"><i class="icon-credit-card-alt"></i></button>
                </form>
              </li>
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
                <a href="<?php echo $first_category_url; ?>" title="<?php _e( 'back to list', 'paperplane-photography-theme' );?>"><i class="icon-back delight-area"></i></a>
              </li>
            <?php endif; ?>
            <?php if ( $evidenziatore_foto === 'si' ) : ?>
              <li>
                <span class="highlight all-pointer-events pointered" title="<?php _e( 'highlight this picture', 'paperplane-photography-theme' );?>"><i class="icon-eye"></i></span>
              </li>
            <?php endif; ?>
            <?php if ( $show_play_pause_button === 'si' && $image_gallery_system != 'scrollpage' ) : ?>
              <li>
                <span class="play-pause delight-area pointered" title="<?php _e( 'play/pause gallery', 'paperplane-photography-theme' );?>" player-attribute="pause"><i class="play-pauser icon-play"></i></span>
              </li>
            <?php endif; ?>
            <?php if ( $elenco_foto === 'si' && $image_gallery_system != 'scrollpage' ) : ?>
              <li>
                <span class="list thumb-list delight-area pointered" title="<?php _e( 'view images list', 'paperplane-photography-theme' );?>"><i class="icon-th-large-outline"></i></span>
              </li>
            <?php endif; ?>
          </ul>
        <?php endif; ?>
        <?php if ( is_singular( 'news' ) ) : ?>
          <ul class="navi-info swupped-link">
            <li>
              <a href="<?php the_field( 'news_archive', 'option' ) ?>" class="delight-area" title="<?php _e( 'back to list', 'paperplane-photography-theme' );?>"><i class="icon-back"></i></a>
            </li>
          </ul>
        <?php endif; ?>
        <?php if ( is_singular( 'book' ) ) : ?>
          <ul class="navi-info swupped-link">
            <li>
              <a href="<?php the_field( 'books_archive', 'option' ) ?>" class="delight-area" title="<?php _e( 'back to list', 'paperplane-photography-theme' );?>"><i class="icon-back"></i></a>
            </li>
          </ul>
        <?php endif; ?>
      </nav>
      <div class="hamburger delight-area <?php echo $show_hamburger_button_desktop_class; ?>">
        <div type="button" aria-haspopup="true" aria-expanded="false" aria-controls="menu" aria-label="menu" class="hambuger-element ham-activator">
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
        <div class="only-desktop">
          <?php if ( has_nav_menu( 'header-overlay-menu' ) ) {
            wp_nav_menu( array( 'theme_location' => 'header-overlay-menu', 'container' => 'ul', 'menu_class' => 'voices' ) );
          } ?>
        </div>
        <div class="only-mobile">
          <?php if ( has_nav_menu( 'header-overlay-menu-mobile' ) ) {
            wp_nav_menu( array( 'theme_location' => 'header-overlay-menu-mobile', 'container' => 'ul', 'menu_class' => 'voices' ) );
          } ?>
        </div>
        <?php if ( $show_search_form === 'yes' ) : ?>
          <div class="form-hold search-hold">
            <form action="<?php echo home_url(); ?>/?" method="get" id="sbk-search">
              <input type="text" class="search-kw" name="s" id="keyword" placeholder="Cosa stai cercando?" />
              <button type="submit" class="submitter" aria-label="cerca sul sito"><i class="icon-search"></i></button>
            </form>
          </div>
        <?php endif; ?>
      </nav>
    </div>
  </div>
</div>
<div class="swupped">
  <div class="mouse-trap">
    <div class="body-shaper">

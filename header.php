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
<meta name="theme-color" content="#DCDCDC">
<!-- Windows Phone -->
<meta name="msapplication-navbutton-color" content="#DCDCDC">
<!-- iOS Safari -->
<meta name="apple-mobile-web-app-status-bar-style" content="#DCDCDC">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head();
// stabilisco il device
$module_count = 0;
global $module_count;
$favicons_folder = get_stylesheet_directory_uri().'/assets/images/favicons/';
global $contatore_foto;
global $show_abstract;
global $elenco_foto;
global $show_cats;
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
?>

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
<link rel="manifest" href="<?php echo $favicons_folder; ?>manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="<?php echo $favicons_folder; ?>ms-icon-144x144.png">
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
a:link, a:visited, a:hover, a:active {
  color: #191919;
}


</style>
<script type="text/javascript">
var show_play_pause_button_localstorage = "<?php echo $show_play_pause_button_localstorage ?>";
var play_pause_timer = "<?php echo $play_pause_timer ?>";
var start_color_scheme = "<?php echo $start_color_scheme ?>";
</script>
</head>
<body class="">
  <div class="eye de-highlight only-desktop">
    <span class="highlight all-pointer-events pointered" title="highlight this picture"><i class="icon-fas-fa-eye"></i></span>
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
      <nav class="swupped menu">
        <?php if ( has_nav_menu( 'header-menu' ) ) {
          wp_nav_menu( array( 'theme_location' => 'header-menu', 'container' => 'ul', 'menu_class' => 'top-menu delight-area' ) );
        } ?>
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
                <a href="<?php echo $first_category_url; ?>" title="back to list"><i class="icon-fas-fa-step-backward delight-area"></i></a>
              </li>
            <?php endif; ?>
            <?php if ( $evidenziatore_foto === 'si' ) : ?>
              <li>
                <span class="highlight all-pointer-events pointered" title="highlight this picture"><i class="icon-fas-fa-eye"></i></span>
              </li>
            <?php endif; ?>
            <?php if ( $show_play_pause_button === 'si' ) : ?>
              <li>
                <span class="play-pause delight-area pointered" title="play/pause gallery" player-attribute="pause"><i class="play-pauser icon-fas-fa-play"></i></span>
              </li>
            <?php endif; ?>
            <?php if ( $elenco_foto === 'si' ) : ?>
              <li>
                <span class="list thumb-list delight-area pointered" title="view images list"><i class="icon-fas-fa-list"></i></span>
              </li>
            <?php endif; ?>
            <?php
            if ( is_singular( 'post' ) ) {
              $picture_id = get_post_thumbnail_id();
            }
            elseif ( is_attachment() ) {
              $picture_id = get_the_ID();
            }
            $abilitare_la_vendita = get_field( 'abilitare_la_vendita', $picture_id );
            if ( $abilitare_la_vendita === 'si' ) :
              ?>
              <li>
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
                  <button type="submit" title="Buy this picture" aria-label="Buy this picture"><i class="icon-fas-fa-credit-card"></i></button>
                </form>
              </li>
            <?php endif; ?>


          </ul>
        <?php endif; ?>
        <?php if ( is_singular( 'news' ) ) : ?>
          <ul class="navi-info swupped-link">
            <li>
              <a href="<?php the_field( 'news_archive', 'option' ) ?>" class="delight-area" title="back to list"><i class="icon-fas-fa-step-backward"></i></a>
            </li>
          </ul>
        <?php endif; ?>
        <?php if ( is_singular( 'book' ) ) : ?>
          <ul class="navi-info swupped-link">
            <li>
              <a href="<?php the_field( 'books_archive', 'option' ) ?>" class="delight-area" title="back to list"><i class="icon-fas-fa-step-backward"></i></a>
            </li>
          </ul>
        <?php endif; ?>
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
      </nav>
    </div>
  </div>
</div>

<div class="swupped">
  <div class="mouse-trap">
    <div class="body-shaper">

<?php
/**
*  Paperplane _blankTheme
 * Template Name: Home
*/
get_header();
?>
<?php while ( have_posts() ) : the_post();
$scegli_cosa_mostrare = get_field( 'scegli_cosa_mostrare' );
$scegli_categoria = get_field( 'scegli_categoria' );
 endwhile; wp_reset_postdata();  ?>
<?php if ( $scegli_cosa_mostrare === 'one-random' ) :
$mostrare_titolo = get_field( 'mostrare_titolo' );
   ?>
<?php
$args_topworks = array(
  'post_type' => 'post',
  'posts_per_page' => 1,
  'orderby' => 'rand',
  'tax_query' => array(
    array(
      'taxonomy' => 'category',
      'field' => 'term_id',
      'terms' => $scegli_categoria
    )
  )
);
$my_topworks = get_posts( $args_topworks );

?>
<div class="photo-frame">
  <div class="photo-hold">
    <div class="sk-folding-cube">
      <div class="sk-cube1 sk-cube"></div>
      <div class="sk-cube2 sk-cube"></div>
      <div class="sk-cube4 sk-cube"></div>
      <div class="sk-cube3 sk-cube"></div>
    </div>
    <?php foreach ( $my_topworks as $post ) : setup_postdata ($post );
    $args = array(
      'post_type' => 'attachment',
      'numberposts' => 1,
      'post_status' => null,
      'post_parent' => $post->ID,
      'orderby' => 'rand',
      );
      $attachments = get_posts( $args );
      if ( $attachments ) {
        foreach ( $attachments as $attachment ) {
          $attachment_title = get_the_title($attachment->ID);
          $attachment_alt = get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true);
          $thumb_url_5k = wp_get_attachment_image_src($attachment->ID, '5k_image', true);
          $thumb_url_desktop = wp_get_attachment_image_src($attachment->ID, 'full_desk', true);
          $thumb_url_tablet = wp_get_attachment_image_src($attachment->ID, 'tablet_image', true);
          $thumb_url_mobile = wp_get_attachment_image_src($attachment->ID, 'mobile_image', true);
          $thumb_url_micro = wp_get_attachment_image_src($attachment->ID, 'micro', true);

          ?>
          <a href="<?php the_permalink(); ?>" class="absl" aria-label="View project: <?php the_title(); ?>"></a>
          <div class="lazy only-explorer" data-src="<?php echo $thumb_url_desktop[0]; ?>"></div>
          <picture>
            <source media="(max-width: 767px)" data-srcset="<?php echo $thumb_url_mobile[0]; ?>">
              <source media="(max-width: 1024px)" data-srcset="<?php echo $thumb_url_tablet[0]; ?>">
                <source media="(max-width: 1920px)" data-srcset="<?php echo $thumb_url_desktop[0]; ?>">
                  <source media="(min-width: 1921px)" data-srcset="<?php echo $thumb_url_5k[0]; ?>">
                    <img src="<?php echo $thumb_url_micro[0]; ?>" data-src="<?php echo $thumb_url_desktop[0]; ?>" title="<?php echo $attachment_title; ?>" alt="<?php echo $attachment_alt; ?>" class="lazy no-explorer" />
          </picture>
        <?php
      }
    }
    ?>
  </div>
</div>

<div class="wrapper delight-area">
  <div class="wrapper-padded">
    <div class="photo-navi allupper bg-5 txt-2 navi-text aligncenter">

    </div>
    <div class="wrapper-padded-more-840">
      <div class="content-styled">
        <?php if ( $mostrare_titolo === 'si' ) : ?>
          <h1 class="aligncenter"><a href="<?php the_permalink(); ?>" class="l333"><?php the_title(); ?></a></h1>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<?php endforeach; wp_reset_postdata(); ?>
<?php else : ?>
  <div class="wrapper">
    <div class="wrapper-padded">
      <div class="flex-hold flex-hold-3 margins-wide verticalize grid-infinite">
        <?php
        if ( get_query_var('paged') ) {

        	$paged = get_query_var('paged');

        } elseif ( get_query_var('page') ) {

        	$paged = get_query_var('page');

        } else {

        	$paged = 1;

        }
        $args_topworks = array(
          'post_type' => 'post',
          //'posts_per_page' => 9,
          'paged' => $paged,
          'tax_query' => array(
            array(
              'taxonomy' => 'category',
              'field' => 'term_id',
              'terms' => $scegli_categoria
            )
          )
        );
        query_posts( $args_topworks );
        if (have_posts()) : while (have_posts()) : the_post();
        get_template_part( 'template-parts/grid/post' );
      endwhile; endif; wp_reset_postdata(); ?>
      </div>
      <?php get_template_part( 'template-parts/grid/infinite-message' ); ?>
    </div>
  </div>



<?php endif; ?>

<?php
$today = date('Y-m-d');
$args_news_month = array(
  'post_type' => 'news',
  'posts_per_page' => 20,
  'date_query' => array(
        array(
            'column' => 'post_date_gmt',
            'after'  => '90 days ago',
        )
)
);
$my_news_month = get_posts( $args_news_month );
if ( $my_news_month ) : ?>
<div class="wrapper topline">
  <div class="wrapper-padded">
    <div class="wrapper-padded-more-650">
      <h6 class="aligncenter">Latest News</h6>
      <div class="news-grid grid-infinite">
      <?php
      foreach ( $my_news_month as $post ) {
        setup_postdata ($post );
        get_template_part( 'template-parts/grid/news' );
      }
      ?>
    </div>
  </div>
</div>
</div>
<?php endif; ?>
<?php get_footer(); ?>

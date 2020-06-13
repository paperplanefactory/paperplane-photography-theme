<?php
/**
*  Paperplane Photography Theme
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
    if ( get_field( 'video_embed' ) ) {
      $iframe = get_field('video_embed');
      $iframe = preg_replace('~<iframe[^>]*\K(?=src)~i','data-',$iframe);
      $iframe = str_replace( '<iframe ', '<iframe class="lazy" ', $iframe );
      echo '<div class="embed-container">';
      echo $iframe;
      echo '</div>';
    }
    else {
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
            $thumb_url_desktop = wp_get_attachment_image_src($attachment->ID, 'full_desk', true);

            ?>
            <a href="<?php the_permalink(); ?>" class="absl data-swup-preload" aria-label="View project: <?php the_title(); ?>"></a>
            <div class="only-explorer" style="background-image: url('<?php echo $thumb_url_desktop[0]; ?>')"></div>
            <?php
            $image_data = array(
                'image_type' => 'post_thumbnail', // options: post_thumbnail, acf_field, acf_sub_field
                'image_value' => '', // se utilizzi un custom field indica qui il nome del campo
                'size_fallback' => 'full'
            );
            $image_sizes = array( // qui sono definiti i ritagli o dimensioni. Devono corrispondere per numero a quanto dedinfito nella funzione nei parametri data-srcset o srcset
              'desktop_retina' => 'single_image_retina',
              'desktop' => 'single_image',
              'mobile' => 'single_image',
              'mobile_retina' => 'single_image_retina',
              'micro' => 'micro'
            );
            print_theme_single_image( $image_data, $image_sizes );
            ?>
          <?php
        }
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
          <h1 class="aligncenter"><a href="<?php the_permalink(); ?>" class="data-swup-preload"><?php the_title(); ?></a></h1>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<?php endforeach; wp_reset_postdata(); ?>
<?php else : ?>
  <div class="wrapper">
    <div class="wrapper-padded">
      <?php
      $boxes_grid = get_field( 'boxes_grid', 'options' );
      $items_per_row = get_field( 'items_per_row', 'options' );
      if ( $boxes_grid === 'grid-flexbox' ) :
        if ( $items_per_row === 'three-items' ) {
          $grid_blocks = 'flex-hold-3';
        }
        if ( $items_per_row === 'two-items' ) {
          $grid_blocks = 'flex-hold-2';
        }
       ?>
       <div class="flex-hold <?php echo $grid_blocks; ?> margins-wide verticalize grid-infinite">
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
         include( locate_template ( 'template-parts/grid/post.php' ) );
       endwhile; endif; wp_reset_postdata(); ?>
       </div>
     <?php
     else :
       if ( $items_per_row === 'three-items' ) {
         $grid_blocks = 'masonry-three';
       }
       if ( $items_per_row === 'two-items' ) {
         $grid_blocks = 'masonry-two';
       }
       ?>
       <div class="masonry-grid <?php echo $grid_blocks; ?> grid-infinite">
         <div class="grid-sizer"></div>
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
         include( locate_template ( 'template-parts/grid/post.php' ) );
       endwhile; endif; wp_reset_postdata(); ?>
       </div>
     <?php endif; ?>

      <?php include( locate_template ( 'template-parts/grid/infinite-message.php' ) ); ?>
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
      <div class="news-grid">
      <?php
      foreach ( $my_news_month as $post ) {
        setup_postdata ( $post );
        include( locate_template ( 'template-parts/grid/news-no-infinite.php' ) );
      }
      ?>
    </div>
  </div>
</div>
</div>
<?php endif; ?>
<?php get_footer(); ?>

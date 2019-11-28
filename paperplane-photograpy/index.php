<?php
// Paperplane _blankTheme - template per index.
get_header();
?>
<?php
$args_topworks = array(
  'post_type' => 'post',
  'posts_per_page' => 1,
  'orderby' => 'rand',
  'tax_query' => array(
    array(
      'taxonomy' => 'category',
      'field' => 'slug',
      'terms' => 'projects'
    )
  )
);
$my_topworks = get_posts( $args_topworks );

?>
<div class="photo-frame">
  <div class="photo-hold">
    <a href="<?php the_permalink(); ?>" class="absl" aria-label="View project: <?php the_title(); ?>"></a>
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
          $thumb_url_desktop = wp_get_attachment_image_src($attachment->ID, 'full_desk', true);
          $thumb_url_tablet = wp_get_attachment_image_src($attachment->ID, 'full_desk', true);
          $thumb_url_mobile = wp_get_attachment_image_src($attachment->ID, 'full_desk', true);
          $thumb_url_micro = wp_get_attachment_image_src($attachment->ID, 'micro', true);
          ?>
          <div class="lazy only-explorer" data-src="<?php echo $thumb_url_desktop[0]; ?>"></div>
           <picture>
              <source media="(max-width: 767px)" data-srcset="<?php echo $thumb_url_mobile[0]; ?>">
              <source media="(max-width: 1024px)" data-srcset="<?php echo $thumb_url_tablet[0]; ?>">
              <source media="(min-width: 1025px)" data-srcset="<?php echo $thumb_url_desktop[0]; ?>">
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
    <?php if ( $count > 0 )  { echo '1 / ' .$count; } ?>
    </div>


    <div class="wrapper-padded-more-840">
      <div class="content-styled">
        <h1 class="aligncenter"><a href="<?php the_permalink(); ?>" class="l333"><?php the_title(); ?></a></h1>
      </div>
    </div>
  </div>
</div>





<?php endforeach; wp_reset_postdata(); ?>


<?php get_footer(); ?>

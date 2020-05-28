<?php
get_header();
?>
<div class="wrapper">
  <div class="wrapper-padded">
    <div class="wrapper-padded-more-650">
      <div class="content-styled plain-page aligncenter">
        <h1><?php single_term_title(); ?></h1>
      </div>
    </div>
  </div>
</div>

<div class="wrapper">
  <div class="wrapper-padded">
    <div class="flex-hold <?php the_field( 'items_per_row', 'options' ); ?> margins-wide verticalize grid-infinite">
      <?php
      if (have_posts()) : while (have_posts()) : the_post();
      include( locate_template ( 'template-parts/grid/post.php' ) );
    endwhile; endif; wp_reset_postdata(); ?>
    </div>
    <?php include( locate_template ( 'template-parts/grid/infinite-message.php' ) ); ?>
  </div>
</div>
<?php get_footer(); ?>

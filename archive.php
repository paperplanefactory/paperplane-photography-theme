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
    <div class="flex-hold flex-hold-3 margins-wide verticalize grid-infinite">
      <?php
      if (have_posts()) : while (have_posts()) : the_post();
      get_template_part( 'template-parts/grid/post' );
    endwhile; endif; wp_reset_postdata(); ?>
    </div>
    <?php get_template_part( 'template-parts/grid/infinite-message' ); ?>
  </div>
</div>
<?php get_footer(); ?>

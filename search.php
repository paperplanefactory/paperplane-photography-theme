<?php
/**
 * The template for displaying search results pages
 */

get_header();
?>
<div class="wrapper">
  <div class="wrapper-padded">
    <div class="wrapper-padded-more-650">
      <div class="content-styled plain-page aligncenter">
        <h1 class="allupper"><?php _e( 'You searched:', 'paperplane-photography-theme' );?> <?php echo get_search_query(); ?></h1>
      </div>
    </div>
  </div>
</div>



<?php if ( have_posts() ) : ?>
  <div class="wrapper">
    <div class="wrapper-padded">
      <div class="wrapper-padded-more-650">
        <div class="news-grid grid-infinite">
          <?php
          while (have_posts()) : the_post();
          include( locate_template ( 'template-parts/grid/search-result.php' ) );
          endwhile; wp_reset_postdata();
          ?>
        </div>
      </div>
    </div>
  </div>
  <?php include( locate_template ( 'template-parts/grid/infinite-message.php' ) ); ?>

<?php else : ?>
  <div class="wrapper">
    <div class="wrapper-padded">
      <div class="wrapper-padded-more-650">
        <h4 class="allupper"><?php _e( 'No results for:', 'paperplane-photography-theme' );?> <?php echo get_search_query(); ?></h4>
      </div>
    </div>
  </div>

<?php endif; ?>


<?php get_footer(); ?>

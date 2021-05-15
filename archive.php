<?php
get_header();
$category_query_info = get_queried_object();
$found_posts =  $category_query_info->count;
?>
<div class="wrapper">
  <div class="wrapper-padded">
    <div class="wrapper-padded-more-650">
      <div class="content-styled plain-page aligncenter">
        <h1><?php single_term_title(); ?></h1>
        <?php
        if ( term_description() ) {
          echo term_description();
        }
        ?>
      </div>
    </div>
  </div>
</div>

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
       if (have_posts()) : while (have_posts()) : the_post();
       include( locate_template ( 'template-parts/grid/post.php' ) );
     endwhile; endif; wp_reset_postdata(); ?>
     </div>
  <?php endif; ?>
    <?php include( locate_template ( 'template-parts/grid/infinite-message.php' ) ); ?>
  </div>
</div>
<?php if ( $found_posts > $posts_per_page ) : ?>
  <div class="wrapper aligncenter">
    <div class="view-more-button view-more-button-js">
      <?php _e( 'View more', 'paperplane-photography-theme' );?>
    </div>
  </div>
<?php endif; ?>
<?php get_footer(); ?>

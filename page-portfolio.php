<?php
/**
 *  Paperplane Photography Theme
 * Template Name: Portfolio
 */
get_header();
?>
<?php while (have_posts()):
  the_post(); ?>
  <div class="wrapper">
    <div class="wrapper-padded">
      <div class="wrapper-padded-more-650">
        <div class="content-styled plain-page">
          <h1 class="aligncenter">
            <?php the_title(); ?>
          </h1>
          <?php the_content(); ?>
        </div>
      </div>
    </div>
  </div>
<?php endwhile;
wp_reset_postdata(); ?>

<?php
$page = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args_posts_paginati = array(
  'post_type' => 'post',
  'posts_per_page' => 20,
  'paged' => $page
);
query_posts($args_posts_paginati);
?>

<div class="wrapper">
  <div class="wrapper-padded">
    <?php
    $boxes_grid = get_field('boxes_grid', 'options');
    $items_per_row = get_field('items_per_row', 'options');
    if ($boxes_grid === 'grid-flexbox'):
      if ($items_per_row === 'three-items') {
        $grid_blocks = 'flex-hold-3';
      }
      if ($items_per_row === 'two-items') {
        $grid_blocks = 'flex-hold-2';
      }
      ?>
      <div class="flex-hold <?php echo $grid_blocks; ?> margins-wide verticalize grid-infinite">
        <?php
        if (have_posts()):
          while (have_posts()):
            the_post();
            include(locate_template('template-parts/grid/post.php'));
          endwhile;
        endif;
        wp_reset_postdata();
        ?>
      </div>
    <?php
    else:
      if ($items_per_row === 'three-items') {
        $grid_blocks = 'masonry-three';
      }
      if ($items_per_row === 'two-items') {
        $grid_blocks = 'masonry-two';
      }
      ?>
      <div class="masonry-grid <?php echo $grid_blocks; ?> grid-infinite">
        <div class="grid-sizer"></div>
        <?php
        if (have_posts()):
          while (have_posts()):
            the_post();
            include(locate_template('template-parts/grid/post.php'));
          endwhile;
        endif;
        wp_reset_postdata(); ?>
      </div>
    <?php endif; ?>
    <?php include(locate_template('template-parts/grid/infinite-message.php')); ?>
  </div>
</div>

<?php get_footer(); ?>
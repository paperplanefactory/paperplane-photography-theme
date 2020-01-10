<?php
/**
*  Paperplane _blankTheme
 * Template Name: Books
*/
get_header();
?>
<?php while ( have_posts() ) : the_post(); ?>
  <div class="wrapper">
    <div class="wrapper-padded">
      <div class="wrapper-padded-more-650">
        <div class="content-styled plain-page aligncenter">
          <h1><?php the_title(); ?></h1>
          <?php the_content(); ?>
        </div>
      </div>
    </div>
  </div>
<?php endwhile; wp_reset_postdata(); ?>

<?php
$page = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args_posts_paginati = array(
  'post_type' => 'book',
  'posts_per_page' => 15,
  'paged' => $page
);
query_posts( $args_posts_paginati );
 ?>

 <div class="wrapper">
   <div class="wrapper-padded">
     <div class="flex-hold flex-hold-5 margins-wide verticalize grid-infinite">
        <?php
        if (have_posts()) : while (have_posts()) : the_post();
        get_template_part( 'template-parts/grid/post' );
        endwhile; endif; wp_reset_postdata();
        ?>
      </div>
      <?php get_template_part( 'template-parts/grid/infinite-message' ); ?>
    </div>
  </div>

<?php get_footer(); ?>

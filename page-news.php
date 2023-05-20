<?php
/**
 *  Paperplane Photography Theme
 * Template Name: News
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
  'post_type' => 'news',
  //'posts_per_page' => 20,
  'paged' => $page
);
query_posts($args_posts_paginati);
$found_posts = $wp_query->found_posts;
?>

<div class="wrapper">
  <div class="wrapper-padded">
    <div class="wrapper-padded-more-650">

      <div class="news-grid grid-infinite">
        <?php
        if (have_posts()):
          while (have_posts()):
            the_post();
            include(locate_template('template-parts/grid/news.php'));
          endwhile;
        endif;
        wp_reset_postdata();
        ?>
      </div>

    </div>
  </div>
</div>
<?php include(locate_template('template-parts/grid/infinite-message.php')); ?>
<?php if ($found_posts > $posts_per_page): ?>
  <div class="wrapper aligncenter">
    <div class="view-more-button view-more-button-js">
      <?php _e('View more', 'paperplane-photography-theme'); ?>
    </div>
  </div>
<?php endif; ?>
<?php get_footer(); ?>
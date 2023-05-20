<?php
/**
 * The Template for displaying all single posts.
 */

get_header();
?>
<?php while (have_posts()):
  the_post(); ?>
  <div class="wrapper">
    <div class="wrapper-padded">
      <div class="wrapper-padded-more-650">
        <div class="content-styled plain-page news-post min-height-footers">
          <h1 class="aligncenter">
            <?php the_title(); ?>
          </h1>
          <div class="cta-1">
            <?php the_time(get_option('date_format')); ?>
          </div>
          <?php the_content(); ?>
        </div>
      </div>
    </div>
  </div>
<?php endwhile; ?>
<?php get_footer(); ?>
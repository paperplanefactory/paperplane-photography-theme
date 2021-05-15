<?php
/**
 * The template for displaying 404 pages (Not Found).
 */

get_header();
?>
<div class="wrapper">
  <div class="wrapper-padded">
    <div class="wrapper-padded-more-650">
      <div class="content-styled plain-page aligncenter">
        <h1><a href="<?php echo home_url(); ?>"><?php _e( '404 - Page non found', 'paperplane-photography-theme' );?></a>.</h1>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>

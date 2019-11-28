<?php
get_header();
?>

<div class="wrapper half-space-top">
  <div class="wrapper-padded">
    <div class="wrapper-padded-more">
      <h1><a href="<?php the_field( 'link_alla_pagina_mostre', 'option' ); ?>"><?php pll_e('mostre_eventi_output'); ?></a> - <?php echo single_term_title(); ?></h1>
      <?php echo term_description(); ?>
    </div>
  </div>
</div>




<div class="wrapper half-space-top">
  <div class="wrapper-padded">
    <div class="wrapper-padded-more">
      <div class="flex-hold flex-hold-4 def-margin-top">
				<?php
				if ( have_posts() ) : while ( have_posts() ) : the_post();
				// fai qualcosa tipo stampare il titolo
				endwhile;
				endif;
				?>
      </div>
    </div>
  </div>
</div>
<?php get_footer(); ?>

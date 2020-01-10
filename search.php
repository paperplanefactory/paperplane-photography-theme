<?php
/**
 * The template for displaying search results pages
 */

get_header();
?>

<h1 class="allupper">Hai cercato: <?php echo get_search_query(); ?></h1>


<?php if ( have_posts() ) : ?>

<?php while ( have_posts() ) : the_post();
// fai qualcosa tipo stampare il titolo
endwhile; ?>

<?php else : ?>
<h2 class="allupper">Nessun risultato per: <?php echo get_search_query(); ?></h2>
<?php endif; ?>


<?php get_footer(); ?>

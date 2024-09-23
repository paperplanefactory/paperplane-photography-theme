<?php
/**
 *  Paperplane Photography Theme
 * Template Name: Books
 */
get_header();
$books_page_layout = 'books-list';
$books_page_layout = get_field( 'books_page_layout' );
if ( $books_page_layout === 'books-list' ) :
	?>

	<?php while ( have_posts() ) :
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
	$page = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$args_posts_paginati = array(
		'post_type' => 'book',
		//'posts_per_page' => 15,
		'paged' => $page
	);
	query_posts( $args_posts_paginati );
	$found_posts = $wp_query->found_posts;
	?>

	<div class="wrapper">
		<div class="wrapper-padded">
			<div class="wrapper-padded-more-650">
				<div class="news-grid grid-infinite">
					<?php
					if ( have_posts() ) :
						while ( have_posts() ) :
							the_post();
							include( locate_template( 'template-parts/grid/news.php' ) );
						endwhile;
					endif;
					wp_reset_postdata();
					?>
				</div>
				<?php include( locate_template( 'template-parts/grid/infinite-message.php' ) ); ?>
			</div>

		</div>
	</div>
	<?php if ( $found_posts > $posts_per_page ) : ?>
		<div class="wrapper aligncenter">
			<div class="view-more-button view-more-button-js">
				<?php _e( 'View more', 'paperplane-photography-theme' ); ?>
			</div>
		</div>
	<?php endif; ?>
<?php else : ?>
	<?php while ( have_posts() ) :
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
	$page = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$args_posts_paginati = array(
		'post_type' => 'book',
		//'posts_per_page' => 15,
		'paged' => $page
	);
	query_posts( $args_posts_paginati );
	$found_posts = $wp_query->found_posts;
	?>
	<div class="wrapper">
		<div class="wrapper-padded">
			<div class="flex-hold flex-hold-3 margins-wide books-listing verticalize grid-infinite">
				<?php
				if ( have_posts() ) :
					while ( have_posts() ) :
						the_post();
						include( locate_template( 'template-parts/grid/book-mosaic.php' ) );
					endwhile;
				endif;
				wp_reset_postdata();
				?>
			</div>
			<?php include( locate_template( 'template-parts/grid/infinite-message.php' ) ); ?>
		</div>
	</div>
<?php endif; ?>
<?php get_footer(); ?>
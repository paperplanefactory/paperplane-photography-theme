<?php
// Polylang strings
// pll_register_string("Suggerimenti", "suggerimenti_output");

//conto le parole del content - call in template: echo word_count();
function word_count() {
    $content = get_post_field( 'post_content', $post->ID );
    $word_count = str_word_count( strip_tags( $content ) );
    return $word_count;
}

function excerpt($limit) {
      $excerpt = explode(' ', get_the_excerpt(), $limit);

      if (count($excerpt) >= $limit) {
          array_pop($excerpt);
          $excerpt = implode(" ", $excerpt) . '...';
      } else {
          $excerpt = implode(" ", $excerpt);
      }

      $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);

      return $excerpt;
}

// page title generator
function twentytwelve_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentytwelve' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'twentytwelve_wp_title', 10, 2 );

/**
 * Replaces the login header logo URL
 *
 * @param $url
 */
function namespace_login_headerurl( $url ) {
    $url = home_url( '/' );
    return $url;
}

add_filter( 'login_headertitle', 'namespace_login_headertitle' );
/**
 * Replaces the login header logo title
 *
 * @param $title
 */
function namespace_login_headertitle( $title ) {
    $title = get_bloginfo( 'name' );
    return $title;
}

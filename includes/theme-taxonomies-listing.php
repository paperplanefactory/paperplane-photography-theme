<?php
function call_categories() {
  global $post;
  $terms_activity = get_the_terms( $post->ID , 'category' );
  // Loop over each item since it's an array
  if ( $terms_activity != null ) {
  foreach ( $terms_activity as $term_activity ) {
  // Print the name method from $term which is an OBJECT
  $term_link = get_term_link( $term_activity );
  $activity_name = $term_activity->name;
  echo '<span>' . $activity_name . '</span>';
  unset( $term_activity );
  } }
}

// usage: "if (function_exists('call_categories')) { call_categories(); }

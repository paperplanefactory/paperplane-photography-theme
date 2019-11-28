<?php
// genero un elenco di link che rimandano alla pagina di archivio della tassonomia
function call_all_cat_nome_tassonomia() {
  $terms_activity = get_the_terms( $post->ID , 'nome_tassonomia' );
  // Loop over each item since it's an array
  if ( $terms_activity != null ){
  foreach( $terms_activity as $term_activity ) {
  // Print the name method from $term which is an OBJECT
  $term_link = get_term_link( $term_activity );
  $activity_name = $term_activity->name;
  echo '<a href="' . $term_link . '">' . $activity_name . '</a>';
  unset($term_activity);
  } }
}

// la richiamo in pagina con "if (function_exists('call_all_cat_nome_tassonomia')) { call_all_cat_nome_tassonomia(); }

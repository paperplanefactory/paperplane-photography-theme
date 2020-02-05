<?php
/**
 * The Template for displaying all single images.
 */

get_header(); ?>
<?php while ( have_posts() ) : the_post();
$excerpt = get_the_excerpt();
$parent = get_post_field( 'post_parent', $id);

if ( $parent != 0 ) {
  $parent_family = get_post_type( $parent );
  $args_original = array(
   'post_type' => 'post',
   'include' => $parent
   );
  $original_post = get_posts( $args_original );
  foreach ($original_post as $post) : setup_postdata($post);
  $i_am_number = $post->ID;
  $original_title = get_the_title();
  $original_content = get_the_content();
  $current_post_url = get_permalink();
  endforeach;
  wp_reset_query();
  if ( $parent_family != 'post' ) {
    wp_redirect($current_post_url, 301);
    remove_action('template_redirect', 'wp_old_slug_redirect');
    exit;
  }
}
else {
  wp_redirect('https://www.allegramartin.it/', 301);
  remove_action('template_redirect', 'wp_old_slug_redirect');
  exit;
}

//function to get next or previous keys in an array
function array_navigate($array, $key){
  $keys = array_keys($array);
  $index = array_flip($keys);
  $return = array();
  $return['prev'] = (isset($keys[$index[$key]-1])) ? $keys[$index[$key]-1] : end($keys);
  $return['next'] = (isset($keys[$index[$key]+1])) ? $keys[$index[$key]+1] : current($keys);
  return $return;
}

function previous_attachment_ID( $att_post ) {
  //get the attachments which share the same post parent
  $images =& get_children( array(
    'post_parent' => $att_post->post_parent,
    'post_type' => 'attachment',
    'post_mime_type' => 'image',
    'output' => 'ARRAY_N',
    'orderby' => 'menu_order',
    'order' => 'ASC'
  ) );

  if($images) {
    //get the id of the previous attachment
    $ppid_arr = array_navigate($images, $att_post->ID);
    $ppid = $ppid_arr['prev'];
    return $ppid;
  }
  return false;
}

//previous attachment link function
function prev_att_link( $att_post=null ) {
    if($att_post == null){
        global $post;
        $att_post = get_post( $post );
    }
    $ppid = previous_attachment_ID( $att_post );
    if($ppid != false){
        return '<a href="' . get_attachment_link( $ppid ) . '" class="previous-attachment-link" aria-label="Previous image"></a>';
    } else {
        //there is no previous link
        return false;
    }
}

function next_attachment_ID( $att_post ) {
  //get the attachments which share the same post parent
  $images =& get_children( array(
    'post_parent' => $att_post->post_parent,
    'post_type' => 'attachment',
    'post_mime_type' => 'image',
    'output' => 'ARRAY_N',
    'orderby' => 'menu_order',
    'order' => 'ASC'
  ) );
  if( $images ) {
    //get the id of the next attachment
    $ppid_arr = array_navigate($images, $att_post->ID);
    $ppid = $ppid_arr['next'];
    return $ppid;
  }
  return false;
}

//next attachment link function
function next_att_link( $att_post=null ){
  if($att_post == null) {
    global $post;
    $att_post = get_post( $post );
    }
    $ppid = next_attachment_ID( $att_post );
    if( $ppid != false ) {
      return '<a href="' . get_attachment_link($ppid) . '" class="next-attachment-link" aria-label="Next image"></a>';
    }
    else {
      return false;
    }
  }

$attachments = array_values( get_children( array(
  'post_parent' => $post->post_parent,
   'post_status' => 'inherit',
   'post_type' => 'attachment',
   'post_mime_type' => 'image',
   'order' => 'ASC',
   'orderby' => 'menu_order ID',
   'exclude' => $thumb_ID )
   ) );
   foreach ( $attachments as $k => $attachment ) :
     if ( $attachment->ID == $post->ID )
     break;
   endforeach;
   $k++;
   $total_attachments = count( $attachments );
   // If there is more than 1 attachment in a gallery
   if ( count( $attachments ) > 1 ) :
     if ( isset( $attachments[ $k ] ) ) :
       // get the URL of the next image attachment
       $next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
       else :
         // or get the URL of the first image attachment
         $next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
       endif;
       else :
         // or, if there's only 1 image, get the URL of the image
         $next_attachment_url = wp_get_attachment_url();
       endif;



$attachment_id = get_the_ID();
$picturecaption = get_post(get_post_thumbnail_id())->post_excerpt; //The Caption
$attachment_title = get_the_title($attachment_id);
$attachment_alt = get_post_meta($attachment_id,'_wp_attachment_image_alt', true);
$thumb_url_5k = wp_get_attachment_image_src($attachment_id, '5k_image', true);
$thumb_url_desktop = wp_get_attachment_image_src($attachment_id, 'full_desk', true);
$thumb_url_tablet = wp_get_attachment_image_src($attachment_id, 'tablet_image', true);
$thumb_url_mobile = wp_get_attachment_image_src($attachment_id, 'mobile_image', true);
$thumb_url_micro = wp_get_attachment_image_src($attachment_id, 'micro', true);
?>
<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "ImageObject",
  "author": "Allegra Martin",
  "contentUrl": "<?php echo $thumb_url_desktop[0]; ?>",
  "datePublished": "<?php echo get_the_date('Y-m-d'); ?>",
  "description": "<?php echo $attachment_alt; ?>",
  "name": "<?php echo $original_title; ?>"
}
</script>


<?php
global $elenco_foto;
if ( $elenco_foto === 'si' ) {
  include( locate_template ( 'template-parts/gallery-thumbs.php' ) );
}
?>
<div id="delight-approved" class="photo-frame">
  <div class="photo-hold">
    <div class="sk-folding-cube">
      <div class="sk-cube1 sk-cube"></div>
      <div class="sk-cube2 sk-cube"></div>
      <div class="sk-cube4 sk-cube"></div>
      <div class="sk-cube3 sk-cube"></div>
    </div>
    <div class="lazy only-explorer" data-src="<?php echo $thumb_url_desktop[0]; ?>"></div>
    <?php
    $image_data = array(
        'image_type' => 'post_thumbnail', // options: post_thumbnail, acf_field, acf_sub_field
        'image_value' => '', // se utilizzi un custom field indica qui il nome del campo
        'size_fallback' => 'full_desk'
    );
    $image_sizes = array( // qui sono definiti i ritagli o dimensioni. Devono corrispondere per numero a quanto dedinfito nella funzione nei parametri data-srcset o srcset
        'retina' => '5k_image',
        'desktop' => 'full_desk',
        'mobile' => 'mobile_image',
        'micro' => 'micro'
    );
    print_theme_single_image( $image_data, $image_sizes );
    ?>
  </div>
  <div class="absl_swipe"></div>
  <div class="navi-click navi-click-left delight-area"><?php echo prev_att_link(); ?></div>
  <div class="navi-click navi-click-right delight-area"><?php echo next_att_link(); ?></div>
</div>

<div class="wrapper delight-area">
  <div class="wrapper-padded">
    <div class="photo-navi txt-2 navi-text aligncenter">
      <?php
      global $contatore_foto;
      if ( $contatore_foto === 'si' && $count > 1 ) {
        echo $k . ' / ' . $total_attachments;
      }
      ?>
    </div>

    <div class="wrapper-padded-more-650 delight-area">
      <div class="content-styled aligncenter">
        <h1><?php echo $original_title; ?></h1>
        <!--
        <?php if ( $attachment_alt != '' ) : ?>
          <h2><?php echo $attachment_alt; ?></h2>
        <?php endif; ?>
        -->
        <?php foreach ($original_post as $post) : setup_postdata($post); ?>
          <?php the_content(); ?>
        <?php endforeach; wp_reset_query(); ?>
      </div>
    </div>
  </div>
</div>

<?php endwhile; ?>
<?php get_footer(); ?>

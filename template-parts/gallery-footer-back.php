<?php
$parent = get_post_field( 'post_parent', $id);
if ( $parent != '' ) {
  $category = get_the_category($parent);
}
else {
  $category = get_the_category($post->ID);
}
$first_category = $category[0];
if ( $first_category != '' ) :
?>
<div class="flex-hold gallery-footer allupper">
  <div class="full">
      <h6>
        <a href="<?php echo get_category_link( $first_category ); ?>" title="<?php _e( 'back to list', 'paperplane-photography-theme' );?>"><i class="icon-back delight-area"></i> <?php _e( 'Back to', 'paperplane-photography-theme' );?> <?php echo $first_category->name; ?></a>
      </h6>
  </div>
</div>
<?php endif; ?>

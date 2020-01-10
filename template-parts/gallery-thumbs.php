<div class="thumbs-gallery">
  <div class="wrapper bg-5 lined">
    <div class="wrapper-padded">
      <div class="wrapper-padded-more-840">
        <?php
        if ( is_attachment() ) {
          $mycurrent = $attachment->ID;
          $parent_attach = get_post_field( 'post_parent', $id);
          $attachments = get_children( array(
            'post_parent' => $parent_attach,
            'numberposts' => -1,
            'post_type' => 'attachment',
            'post_mime_type' => 'image',
            'output' => 'ARRAY_N',
            'order' => 'ASC',
            'orderby' => 'menu_order'
          ) );
        }
        else {
          $mycurrent = $attachment->ID;
          $attachments = get_children( array(
             'post_type' => 'attachment',
             'numberposts' => -1,
             'post_status' => null,
             'post_mime_type' => 'image',
             'post_parent' => $post->ID,
             'order' => 'ASC',
             'orderby' => 'menu_order'
          ) );
        }

        // link alla prima immagine
        echo "<div class='gallery-thumb-box'>";
        foreach ( $attachments as $attachment_id => $attachment ) {
          $post_thumb_url = wp_get_attachment_image_src($attachment_id,'micro');
          $post_thumbsuper_url = wp_get_attachment_image_src($attachment_id,'thumb_gallery');
          echo "<div class='gallery-thumb current_thumb_" . $attachment_id . "'>";

          echo "<a href='" . get_attachment_link($attachment_id) . "'>";
          echo "<div class='no-the-100'>";
          echo "<img src'" . $post_thumbsuper_url[0] . "' data-src='" . $post_thumbsuper_url[0] . "' class='lazy' />";
          echo "</div>";
          echo "</a>";

          echo "</div>";
        }
        echo "</div>";
        ?>
        <script>
        $(document).ready(function() {
          $('.current_thumb_<?php echo $mycurrent; ?>').addClass('current_thumb_hilight');
          });
        </script>
      </div>

    </div>
  </div>
</div>

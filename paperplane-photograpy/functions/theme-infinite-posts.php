<?php
// tutorial di riferimento: http://blog.centil.co/2016/04/30/how-to-add-infinite-scroll-on-single-posts-in-wordpress/
function paperplane_single_post_infinite_scroll( $pid ) {
  if ( is_single() ) { ?>
    <script type="text/javascript" >
      jQuery(document).ready(function($) {
				var stop = false;

        $(window).scroll(function() {
          var footerPos = $('#footer').last().position().top;
          var pos = $(window).scrollTop();
          // Load next article
          if (pos+(screen.height*4) > footerPos) {
            if ($(".centil-infinite-scroll").first().hasClass('working')) {

              return false;
            } else {
              $(".centil-infinite-scroll").first().addClass('working');
            }
            var centilNextPostId = $(".centil-infinite-scroll").first().text();
            var data = {
              'action': 'centil_is',
              'centilNextPostId': centilNextPostId
            };


            // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
            jQuery.post('<?php echo admin_url("admin-ajax.php"); ?>', data, function(response) {
              $(".centil-infinite-scroll").first().replaceWith(response);
							(function() {
						    new LazyLoad({
						      elements_selector: ".lazy",
						      class_loading: "lazy-loading",
						      class_loaded: "lazy-loaded"
						    });
						  }());
            });
          }

          // Update new URL
          var currUrl = $(".centil-post-header").first().attr("url");
          var currTitle = $(".centil-post-header").first().attr("title");

          if ($(".centil-post-header").length > 1 && history.pushState) {

            for (var i=0; i<$(".centil-post-header").length; i++) {
              if (pos+(screen.height/2) >= $(".centil-post-header").eq(i).next().position().top) {
                currUrl = $(".centil-post-header").eq(i).attr("url");
                currTitle = $(".centil-post-header").eq(i).attr("title");
              }
            }
          }
          if (location.href != currUrl) {
            history.pushState({}, currTitle, currUrl);
						document.title = currTitle;
						// if you use async GA
						_gaq.push(['_setAccount', 'UA-12345-1']);
						_gaq.push(['_trackPageview', post_url])

						// if you use traditional GA
						var pageTracker = _gat._getTracker("UA-12345-1");
						pageTracker._trackPageview( currUrl );
          }
        });
      });
    </script>

  <?php }
}
add_action( 'wp_head', 'paperplane_single_post_infinite_scroll' );

function paperplane_single_post_infinite_scroll_callback() {
	?>
	<script type="text/javascript" >
		$(document).ready(function($) {
			$(".bottom-message").fadeIn(300).delay(1000).fadeOut(300);
		});
	</script>
	<?php
  if (isset($_POST['centilNextPostId']) && $_POST['centilNextPostId']) {
    // The Query
    $the_query = new WP_Query(array('p'=>$_POST['centilNextPostId']));

    // The Loop
    if ( $the_query->have_posts() ) {
      while ( $the_query->have_posts() ) {
        $the_query->the_post();
        get_template_part( 'template-parts/infinite-post' );
      }
    }
    /* Restore original Post Data */
    wp_reset_postdata();
  }

  wp_die();

}
add_action( 'wp_ajax_centil_is', 'paperplane_single_post_infinite_scroll_callback' );
add_action( 'wp_ajax_nopriv_centil_is', 'paperplane_single_post_infinite_scroll_callback' );

<?php
add_action( 'wp_footer', 'activate_slideshows');
function activate_slideshows() {
?>
<script>
// gestione slideshow
var apiNum_regular = 0;
var apiNum_full = 0;
var lazyCounter = 0;

$(document).ready(function() {
	$("a.bx-prev, a.bx-next").bind("click", function() {
    myLazyLoad.update();
});


  $( '.regular-slideshow-selector' ).each(function( index ) {
    var setSlideId_regular = $( this ).val();
    var apiName = 'api_regular';
    apiNum_regular++;
    var apiSelect_regular = apiName+apiNum_regular;
    var apiSelect_regular = $(setSlideId_regular).bxSlider({
      slideWidth: 4000,
  		speed: 800,
      minSlides: 1,
      maxSlides: 1,
      slideMargin: 0,
  		touchEnabled: true,
  		controls: true,
      pager: true,
      //pagerType: 'short',
      mode: 'horizontal',
      infiniteLoop: true,
      auto: false,
      nextText: 'next',
      prevText: 'prev'
    });
   resetSlide = function() {
     apiSelect_regular.reloadSlider();
     };

  });

	$( '.fullscreen-slideshow-selector' ).each(function( index ) {
    var setSlideId_full = $( this ).val();
    var apiName = 'api_full';
    apiNum_full++;
    var apiSelect_full = apiName+apiNum_full;
    var apiSelect_full = $(setSlideId_full).bxSlider({
      slideWidth: 4000,
  		speed: 800,
      minSlides: 1,
      maxSlides: 1,
      slideMargin: 0,
  		touchEnabled: true,
  		controls: true,
      pager: true,
      pagerType: 'short',
      mode: 'horizontal',
      infiniteLoop: true,
      auto: false,
      nextText: 'aa',
      prevText: 'bb',
    });
   resetSlide = function() {
     apiNum_full.reloadSlider();
     };

  });
});

</script>
<?php }

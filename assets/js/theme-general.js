localStorage.setItem('playOrPause', show_play_pause_button_localstorage);
navColorPattern = localStorage.getItem('colorScheme');
if (navColorPattern == null) {
  //navColorPattern = 'clear';
  navColorPattern = start_color_scheme;
  localStorage.setItem('playOrPause', start_color_scheme);
  document.querySelector('meta[name="theme-color"]').setAttribute('content', '#FFFFFF');
  document.querySelector('meta[name="msapplication-navbutton-color"]').setAttribute('content', '#FFFFFF');
  document.querySelector('meta[name="apple-mobile-web-app-status-bar-style"]').setAttribute('content', '#FFFFFF');
}
setInitialBrightness();

function masonrySetup() {
  if (jQuery('.masonry-grid')[0]) {
    var container = document.querySelector('.masonry-grid');
    var msnry = new Masonry(container, {
      // set itemSelector so .grid-sizer is not used in layout
      itemSelector: '.flex-hold-child',
      // use element for option
      columnWidth: '.grid-sizer',
      transitionDuration: '0.3s',
      stagger: 30,
      initLayout: false
    });
    msnry.on('layoutComplete', function(items) {
      console.log(items.length);
    });
    // trigger initial layout
    msnry.layout();
  }
}

var paperPlaneLazyLoad = new LazyLoad({
  elements_selector: ".lazy",
  class_loading: "lazy-loading",
  class_loaded: "lazy-loaded",
  callback_loaded: (el) => {
    masonrySetup();
    el.classList.remove('lazy-loading');
    el.classList.add('lazy-loaded');
  },
});


const options = {
  containers: [".swupped"],
  cache: true,
  animateHistoryBrowsing: true,
  //plugins: [new SwupHeadPlugin(), new SwupGaPlugin(), new SwupPreloadPlugin()],
  plugins: [new SwupHeadPlugin(), new SwupPreloadPlugin()],
  skipPopStateHandling: function skipPopStateHandling(event) {
    return !(event.state && event.state.source === 'swup');
  }
};



const swup = new Swup(options);

// run once
init();
// this event runs for every page view after initial load
swup.on('contentReplaced', init);
swup.on('willReplaceContent', unload);
swup.on('animationInStart', animationIn);

swup.on('contentReplaced', function() {
  contactForm();
});

function init() {
  paperPlaneLazyLoad.update();
  refreshPrevNext();
  approveDelight();
  wrapPostMedia();
  masonrySetup();
  sliderSetup();
  playOrPause = localStorage.getItem('playOrPause');
  myMutant();
  highlightCurrentThumb();
  blockArrowKeys = true;
}

function unload() {
  scrollTo(0, 0);
  blockArrowKeys = false;
}

function animationIn() {
  closeOverlay();
}


document.addEventListener('swup:contentReplaced', event => {
  initInfiniteScroll();
  jQuery(".mouse-trap").mouseover(function() {
    closeOverlay();
  });
  setInitialBrightness();


});

// infinite scroll
function initInfiniteScroll() {
  if (jQuery(".nav-next a")[0]) {
    // inifinite scroll
    jQuery('.grid-infinite').infiniteScroll({
      // options
      path: '.nav-next a',
      append: '.grid-item-infinite',
      status: '#infscr-loading',
      prefill: true,
      loadOnScroll: false,
      history: false,
      button: '.view-more-button-js',
      scrollThreshold: false,
      checkLastPage: true,
    });

    jQuery('.grid-infinite').on('append.infiniteScroll', function(event, response, path, items) {
      paperPlaneLazyLoad.update();
      masonrySetup();
    });
    window.setInterval(function() {
      if (jQuery('.infinite-scroll-last').is(":visible")) {
        jQuery('#infscr-loading').fadeOut(300);
      }
    }, 2000);
  }
}
initInfiniteScroll();



function handleOverlay() {
  jQuery('.hambuger-element').toggleClass('open');
  if (jQuery('.hambuger-element').hasClass('open')) {
    jQuery('#header-overlay').focus();
    jQuery('#head-overlay').removeClass('blurred').delay(700).queue(function(next) {
      jQuery(this).delay(1500).addClass('ok-autoclose');
      next();
    });
    jQuery(this).attr('aria-expanded', true);
  } else {
    jQuery('#header').focus();
    jQuery('#head-overlay').addClass('blurred').delay(1).queue(function(next) {
      jQuery(this).removeClass('ok-autoclose');
      next();
    });
    jQuery(this).attr('aria-expanded', false);
  }
  jQuery('#head-overlay').toggleClass('overlay-in');
  jQuery('#search-box').fadeOut(300);
}

function closeOverlay() {
  if (jQuery('#head-overlay').hasClass('ok-autoclose')) {
    jQuery('.hambuger-element').removeClass('open');
    jQuery('#header').focus();
    jQuery(this).attr('aria-expanded', false);
    jQuery('#head-overlay').removeClass('overlay-in ok-autoclose');
  }
}

function hideNavi() {
  jQuery('body').toggleClass('delighted');
}

function approveDelight() {
  if (jQuery('#delight-approved').length) {} else {
    jQuery('body').removeClass('delighted');
  }
}

function setBrightness() {
  if (jQuery('body').hasClass('clear-theme')) {
    navColorPattern = 'dark';
    localStorage.setItem("colorScheme", navColorPattern);
    jQuery('body').removeClass('clear-theme').addClass('dark-theme');
    document.querySelector('meta[name="theme-color"]').setAttribute('content', '#303030');
    document.querySelector('meta[name="msapplication-navbutton-color"]').setAttribute('content', '#303030');
    document.querySelector('meta[name="apple-mobile-web-app-status-bar-style"]').setAttribute('content', '#303030');
  } else {
    navColorPattern = 'clear';
    localStorage.setItem("colorScheme", navColorPattern);
    jQuery('body').removeClass('dark-theme').addClass('clear-theme');
    var custom_tile_color = jQuery('.get-custom-tile-color-js').attr("data-custom-color");
    document.querySelector('meta[name="theme-color"]').setAttribute('content', custom_tile_color);
    document.querySelector('meta[name="msapplication-navbutton-color"]').setAttribute('content', custom_tile_color);
    document.querySelector('meta[name="apple-mobile-web-app-status-bar-style"]').setAttribute('content', custom_tile_color);
  }
}

function setInitialBrightness() {
  if (navColorPattern === 'dark') {
    jQuery('body').removeClass('clear-theme').addClass('dark-theme');
    document.querySelector('meta[name="theme-color"]').setAttribute('content', '#303030');
    document.querySelector('meta[name="msapplication-navbutton-color"]').setAttribute('content', '#303030');
    document.querySelector('meta[name="apple-mobile-web-app-status-bar-style"]').setAttribute('content', '#303030');
  } else if (navColorPattern === 'clear') {
    jQuery('body').removeClass('dark-theme').addClass('clear-theme');
    var custom_tile_color = jQuery('.get-custom-tile-color-js').attr("data-custom-color");
    document.querySelector('meta[name="theme-color"]').setAttribute('content', custom_tile_color);
    document.querySelector('meta[name="msapplication-navbutton-color"]').setAttribute('content', custom_tile_color);
    document.querySelector('meta[name="apple-mobile-web-app-status-bar-style"]').setAttribute('content', custom_tile_color);
  }
}

function wrapPostMedia() {
  // Wrappo i video player in una div per dimensionarli responsive
  jQuery('.content-styled iframe, .wp-video').wrap('<div class="video-frame"></div>');
  // Controllo se l'immagine ha la didascalia e se manca la wrappo per allinearla
  if (!jQuery('img.alignnone').closest('.wp-caption').length) {
    jQuery('img.alignnone').wrap('<div class="wp-caption alignnone"></div>');
  }
  if (!jQuery('img.aligncenter').closest('.wp-caption').length) {
    jQuery('img.aligncenter').wrap('<div class="wp-caption aligncenter"></div>');
  }
  if (jQuery('img.alignleft')) {
    jQuery('img.alignleft').wrap('<div class="wp-caption alignleft"></div>');
  }
  if (jQuery('img.alignright')) {
    jQuery('img.alignright').wrap('<div class="wp-caption alignright"></div>');
  }
}

function refreshPrevNext() {
  if (jQuery(".navi-click-left a")[0] || jQuery(".navi-click-right a")[0]) {
    prevLink = jQuery('.navi-click-left a').attr('href');
    nextLink = jQuery('.navi-click-right a').attr('href');
    prevLinkData = swup.preloadPage(prevLink);
    nextLinkData = swup.preloadPage(nextLink);
  }
}

function nextNaviAction() {
  if (jQuery(".navi-click-left a")[0] || jQuery(".navi-click-right a")[0]) {
    swup.loadPage({
      url: nextLink, // route of request (defaults to current url)
      method: 'GET', // method of request (defaults to "GET")
      data: nextLinkData, // data passed into XMLHttpRequest send method
    });
  }
}

function prevNaviAction() {
  if (jQuery(".navi-click-left a")[0] || jQuery(".navi-click-right a")[0]) {
    swup.loadPage({
      url: prevLink, // route of request (defaults to current url)
      method: 'GET', // method of request (defaults to "GET")
      data: prevLinkData, // data passed into XMLHttpRequest send method
    });
  }
}
var timerSlider;

function autoNaviGallery() {
  playOrPause = localStorage.getItem('playOrPause');
  clearTimeout(timerSlider);
  if (playOrPause === 'pause') {
    jQuery('.play-pauser').removeClass('icon-fas-fa-pause').addClass('icon-fas-fa-play');
  }
  if (playOrPause === 'play') {
    timerSlider = window.setTimeout(function() {
      nextNaviAction();
    }, play_pause_timer);
    jQuery('.play-pauser').removeClass('icon-fas-fa-play').addClass('icon-fas-fa-pause');
  }
}


function myMutant() {
  if (jQuery(".autoplay-loaded")[0]) {
    var $div = jQuery(".autoplay-loaded");
    var observer = new MutationObserver(function(mutations) {
      mutations.forEach(function(mutation) {
        if (mutation.attributeName === "class") {
          var attributeValue = jQuery(mutation.target).prop(mutation.attributeName);
          if (jQuery(".autoplay-loaded").hasClass('lazy-loaded')) {
            autoNaviGallery();
          } else {}
        }
      });
    });
    observer.observe($div[0], {
      attributes: true
    });
  }

}

myMutant();

function showThumbsBox() {
  jQuery('.thumbs-gallery').toggleClass('shown');
  paperPlaneLazyLoad.update();
}

function highlightCurrentThumb() {
  current_thumb_id = jQuery('.photo-frame').attr("data-picture-id");
  jQuery('.current_thumb_' + current_thumb_id).addClass('current_thumb_hilight');
}

highlightCurrentThumb();

// clicks

// close overlay on mouse leave
jQuery(".mouse-trap").mouseover(function() {
  closeOverlay();
});

// hide-navi call
jQuery(document).on('click', '.highlight:not(.initialized)', function(e) {
  hideNavi();
  closeOverlay();
  jQuery('.thumbs-gallery').slideUp(300);
});

// theme switch
jQuery(document).on('click', '.bright-switch a:not(.initialized)', function(e) {
  setBrightness();
});
// hamburger
jQuery('.ham-activator').click(function() {
  handleOverlay();
});

jQuery(document).on('click', '.thumb-list:not(.initialized)', function(e) {
  showThumbsBox();
});


jQuery(document).on('click', '.play-pause:not(.initialized)', function(e) {
  playOrPause = localStorage.getItem('playOrPause');
  if (playOrPause === 'pause') {
    if (jQuery(".gallery-slider-js")[0]) {
      jQuery(".gallery-slider-js").slick('slickPlay');
      localStorage.setItem('playOrPause', 'play');
    } else {
      localStorage.setItem('playOrPause', 'play');
    }

    jQuery('.play-pauser').removeClass('icon-fas-fa-play').addClass('icon-fas-fa-pause');
  }
  if (playOrPause === 'play') {
    if (jQuery(".gallery-slider-js")[0]) {
      jQuery(".gallery-slider-js").slick('slickPause');
      localStorage.setItem('playOrPause', 'pause');
    } else {
      localStorage.setItem('playOrPause', 'pause');
    }

    jQuery('.play-pauser').removeClass('icon-fas-fa-pause').addClass('icon-fas-fa-play');
  }
  autoNaviGallery();
});

jQuery(document).on('swipeleft', '.absl_swipe:not(.initialized)', function(e) {
  nextNaviAction();
});

jQuery(document).on('swiperight', '.absl_swipe:not(.initialized)', function(e) {
  prevNaviAction();
});

jQuery(document).on('touchstart', '.absl_swipe:not(.initialized)', function(e) {
  jQuery('.absl_swipe').addClass('swipe-info');
});

jQuery(document).on('touchend', '.absl_swipe:not(.initialized)', function(e) {
  jQuery('.absl_swipe').removeClass('swipe-info');
});

jQuery(document).keydown(function(e) {
  switch (e.which) {
    case 37: // left
      prevNaviAction();
      break;
    case 39: // right
      nextNaviAction();
      break;
    default:
      return; // exit this handler for other keys
  }
  e.preventDefault(); // prevent the default action (scroll / move caret)
});






function sliderSetup() {
  if (jQuery(".gallery-slider-js")[0]) {
    jQuery(".gallery-slider-js").on("init reInit afterChange", function(event, slick, currentSlide, nextSlide) {
      var i = (currentSlide ? currentSlide : 0) + 1;
      var total_slides = slick.slideCount;
      counter_number = i;
      jQuery('.navi-text').text(counter_number + '/' + total_slides);
      var currentSlide, slideType, player, command;
      //find the current slide element and decide which player API we need to use.
      currentSlide = $(slick.$slider).find(".slick-current");
      //determine which type of slide this, via a class on the slide container. This reads the second class, you could change this to get a data attribute or something similar if you don't want to use classes.
      slideSale = currentSlide.find(".slide-picture-contaniner").attr("data-sale");
      if (slideSale === 'show-buy-button') {
        jQuery('.buy-button').addClass('shown');
      } else {
        jQuery('.buy-button').removeClass('shown');
      }
      var currentSlide, slideType, player, command;
      //find the current slide element and decide which player API we need to use.
      currentSlide = $(slick.$slider).find(".slick-current");
      //determine which type of slide this, via a class on the slide container. This reads the second class, you could change this to get a data attribute or something similar if you don't want to use classes.
      slideType = currentSlide.find(".slide-picture-contaniner").attr("data-content");
      //get the iframe inside this slide.
      if (slideType != 'pic') {
        jQuery(".gallery-slider-js").addClass('video-slide');
      } else {
        jQuery(".gallery-slider-js").removeClass('video-slide');
      }
    });
    jQuery('.gallery-slider-js').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      lazyLoad: 'ondemand',
      prevArrow: '<div class="slick-prev"></div>',
      nextArrow: '<div class="slick-next"></div>',
      accessibility: true,
      asNavFor: '.gallery-slider-nav-js',
      speed: 600,
      responsive: [{
        breakpoint: 1024,
        settings: {
          prevArrow: '<div class="slick-prev">←</div>',
          nextArrow: '<div class="slick-next">→</div>',
        }
      }]
    });
  }

  if (jQuery(".gallery-slider-nav-js")[0]) {
    jQuery('.gallery-slider-nav-js').slick({
      //centerMode: true,
      slidesToShow: 7,
      slidesToScroll: 1,
      lazyLoad: 'progressive',
      arrows: true,
      nextArrow: '<div class="slick-next"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-right" class="svg-inline--fa fa-arrow-right fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M190.5 66.9l22.2-22.2c9.4-9.4 24.6-9.4 33.9 0L441 239c9.4 9.4 9.4 24.6 0 33.9L246.6 467.3c-9.4 9.4-24.6 9.4-33.9 0l-22.2-22.2c-9.5-9.5-9.3-25 .4-34.3L311.4 296H24c-13.3 0-24-10.7-24-24v-32c0-13.3 10.7-24 24-24h287.4L190.9 101.2c-9.8-9.3-10-24.8-.4-34.3z"></path></svg></div>',
      prevArrow: '<div class="slick-prev"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-left" class="svg-inline--fa fa-arrow-left fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M257.5 445.1l-22.2 22.2c-9.4 9.4-24.6 9.4-33.9 0L7 273c-9.4-9.4-9.4-24.6 0-33.9L201.4 44.7c9.4-9.4 24.6-9.4 33.9 0l22.2 22.2c9.5 9.5 9.3 25-.4 34.3L136.6 216H424c13.3 0 24 10.7 24 24v32c0 13.3-10.7 24-24 24H136.6l120.5 114.8c9.8 9.3 10 24.8.4 34.3z"></path></svg></div>',
      accessibility: true,
      asNavFor: '.gallery-slider-js',
      speed: 600,
      responsive: [{
        breakpoint: 1024,
        settings: {
          arrows: false,
          slidesToShow: 5,
          slidesToScroll: 5,
        }
      }]
    });
    jQuery('div[data-slide]').click(function(e) {
      e.preventDefault();
      var slideno = jQuery(this).data('slide');
      jQuery('.gallery-slider-nav-js').slick('slickGoTo', slideno - 1);
    });
    jQuery(document).on('keydown', function(e) {
      if (e.keyCode == 37) {
        $('.gallery-slider-js').slick('slickPrev');
      }
      if (e.keyCode == 39) {
        $('.gallery-slider-js').slick('slickNext');
      }
    });
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const color = urlParams.get('slideGo');
    if (color != null) {
      jQuery('.gallery-slider-nav-js').slick('slickGoTo', color - 1);
    }



    jQuery(".gallery-slider-js").on("beforeChange", function(event, slick) {
      var currentSlide, slideType, player, command;
      //find the current slide element and decide which player API we need to use.
      currentSlide = $(slick.$slider).find(".slick-current");
      //determine which type of slide this, via a class on the slide container. This reads the second class, you could change this to get a data attribute or something similar if you don't want to use classes.
      slideType = currentSlide.find(".slide-picture-contaniner").attr("data-content");

      //get the iframe inside this slide.
      if (slideType != 'pic') {
        player = currentSlide.find("iframe").get(0);
        if (slideType == "vimeo") {
          command = {
            "method": "pause",
            "value": "true"
          };
        } else {
          command = {
            "event": "command",
            "func": "pauseVideo"
          };
        }
      }


      //check if the player exists.
      if (player != undefined) {
        //post our command to the iframe.
        player.contentWindow.postMessage(JSON.stringify(command), "*");
      }
    });
  }

  if (jQuery(".gallery-slider-nav-single-js")[0]) {
    jQuery('.gallery-slider-nav-single-js').slick({
      //centerMode: true,
      slidesToShow: 7,
      slidesToScroll: 1,
      lazyLoad: 'progressive',
      arrows: true,
      nextArrow: '<div class="slick-next"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-right" class="svg-inline--fa fa-arrow-right fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M190.5 66.9l22.2-22.2c9.4-9.4 24.6-9.4 33.9 0L441 239c9.4 9.4 9.4 24.6 0 33.9L246.6 467.3c-9.4 9.4-24.6 9.4-33.9 0l-22.2-22.2c-9.5-9.5-9.3-25 .4-34.3L311.4 296H24c-13.3 0-24-10.7-24-24v-32c0-13.3 10.7-24 24-24h287.4L190.9 101.2c-9.8-9.3-10-24.8-.4-34.3z"></path></svg></div>',
      prevArrow: '<div class="slick-prev"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-left" class="svg-inline--fa fa-arrow-left fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M257.5 445.1l-22.2 22.2c-9.4 9.4-24.6 9.4-33.9 0L7 273c-9.4-9.4-9.4-24.6 0-33.9L201.4 44.7c9.4-9.4 24.6-9.4 33.9 0l22.2 22.2c9.5 9.5 9.3 25-.4 34.3L136.6 216H424c13.3 0 24 10.7 24 24v32c0 13.3-10.7 24-24 24H136.6l120.5 114.8c9.8 9.3 10 24.8.4 34.3z"></path></svg></div>',
      accessibility: true,
      speed: 300,
      responsive: [{
        breakpoint: 1024,
        settings: {
          arrows: false,
          slidesToShow: 3,
          slidesToScroll: 3,
        }
      }]
    });
  }
}

function contactForm() {
  const forms = document.querySelectorAll('.wpcf7 > form');
  forms.forEach(form => wpcf7.init(form));
}
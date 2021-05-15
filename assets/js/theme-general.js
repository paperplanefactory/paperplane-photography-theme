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
  if (jQuery(".masonry-grid")[0]) {
    var container = document.querySelector('.masonry-grid');
    var msnry = new Masonry(container, {
      // set itemSelector so .grid-sizer is not used in layout
      itemSelector: '.flex-hold-child',
      // use element for option
      columnWidth: '.grid-sizer',
      percentPosition: true,
      transitionDuration: '0.2s'
    });
  }
}
//masonrySetup();

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

function init() {
  paperPlaneLazyLoad.update();
  refreshPrevNext();
  approveDelight();
  wrapPostMedia();
  masonrySetup();
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
  $(".mouse-trap").mouseover(function() {
    closeOverlay();
  });
  setInitialBrightness();
  if ($('div.wpcf7 > form').length) {
    var $form = $('div.wpcf7 > form');
    wpcf7.initForm($form);
    if (wpcf7.cached) {
      wpcf7.refill($form);
    }
  }

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
      checkLastPage: true
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
  $('.hambuger-element').toggleClass('open');
  if ($('.hambuger-element').hasClass('open')) {
    $('#header-overlay').focus();
    $('#head-overlay').removeClass('blurred').delay(700).queue(function(next) {
      $(this).delay(1500).addClass('ok-autoclose');
      next();
    });
    $(this).attr('aria-expanded', true);
  } else {
    $('#header').focus();
    $('#head-overlay').addClass('blurred').delay(1).queue(function(next) {
      $(this).removeClass('ok-autoclose');
      next();
    });
    $(this).attr('aria-expanded', false);
  }
  $('#head-overlay').toggleClass('overlay-in');
  $('#search-box').fadeOut(300);
}

function closeOverlay() {
  if ($('#head-overlay').hasClass('ok-autoclose')) {
    $('.hambuger-element').removeClass('open');
    $('#header').focus();
    $(this).attr('aria-expanded', false);
    $('#head-overlay').removeClass('overlay-in ok-autoclose');
  }
}

function hideNavi() {
  $('body').toggleClass('delighted');
}

function approveDelight() {
  if ($('#delight-approved').length) {} else {
    $('body').removeClass('delighted');
  }
}

function setBrightness() {
  if ($('body').hasClass('clear-theme')) {
    navColorPattern = 'dark';
    localStorage.setItem("colorScheme", navColorPattern);
    $('body').removeClass('clear-theme').addClass('dark-theme');
    document.querySelector('meta[name="theme-color"]').setAttribute('content', '#303030');
    document.querySelector('meta[name="msapplication-navbutton-color"]').setAttribute('content', '#303030');
    document.querySelector('meta[name="apple-mobile-web-app-status-bar-style"]').setAttribute('content', '#303030');
  } else {
    navColorPattern = 'clear';
    localStorage.setItem("colorScheme", navColorPattern);
    $('body').removeClass('dark-theme').addClass('clear-theme');
    document.querySelector('meta[name="theme-color"]').setAttribute('content', '#FFFFFF');
    document.querySelector('meta[name="msapplication-navbutton-color"]').setAttribute('content', '#FFFFFF');
    document.querySelector('meta[name="apple-mobile-web-app-status-bar-style"]').setAttribute('content', '#FFFFFF');
  }
  //console.log(localStorage.getItem('colorScheme'));
}

function setInitialBrightness() {
  if (navColorPattern === 'dark') {
    $('body').removeClass('clear-theme').addClass('dark-theme');
    document.querySelector('meta[name="theme-color"]').setAttribute('content', '#303030');
    document.querySelector('meta[name="msapplication-navbutton-color"]').setAttribute('content', '#303030');
    document.querySelector('meta[name="apple-mobile-web-app-status-bar-style"]').setAttribute('content', '#303030');
  } else if (navColorPattern === 'clear') {
    $('body').removeClass('dark-theme').addClass('clear-theme');
    document.querySelector('meta[name="theme-color"]').setAttribute('content', '#FFFFFF');
    document.querySelector('meta[name="msapplication-navbutton-color"]').setAttribute('content', '#FFFFFF');
    document.querySelector('meta[name="apple-mobile-web-app-status-bar-style"]').setAttribute('content', '#FFFFFF');
  }
}

function wrapPostMedia() {
  // Wrappo i video player in una div per dimensionarli responsive
  $('.content-styled iframe').wrap('<div class="video_frame"></div>');
  // Controllo se l'immagine ha la didascalia e se manca la wrappo per allinearla
  if (!$('img.alignnone').closest('.wp-caption').length) {
    $('img.alignnone').wrap('<div class="wp-caption alignnone"></div>');
  }
  if (!$('img.aligncenter').closest('.wp-caption').length) {
    $('img.aligncenter').wrap('<div class="wp-caption aligncenter"></div>');
  }
  if ($('img.alignleft')) {
    $('img.alignleft').wrap('<div class="wp-caption alignleft"></div>');
  }
  if ($('img.alignright')) {
    $('img.alignright').wrap('<div class="wp-caption alignright"></div>');
  }
}

function refreshPrevNext() {
  if (jQuery(".navi-click-left a")[0] || jQuery(".navi-click-right a")[0]) {
    prevLink = $('.navi-click-left a').attr('href');
    nextLink = $('.navi-click-right a').attr('href');
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
  //console.log(play_pause_timer);
  playOrPause = localStorage.getItem('playOrPause');
  clearTimeout(timerSlider);
  //console.log(playOrPause);
  if (playOrPause === 'pause') {
    $('.play-pauser').removeClass('icon-fas-fa-pause').addClass('icon-fas-fa-play');
  }
  if (playOrPause === 'play') {
    timerSlider = window.setTimeout(function() {
      nextNaviAction();
    }, play_pause_timer);
    $('.play-pauser').removeClass('icon-fas-fa-play').addClass('icon-fas-fa-pause');
  }
}


function myMutant() {
  //console.log('fd');
  if ($(".autoplay-loaded")[0]) {
    var $div = $(".autoplay-loaded");
    var observer = new MutationObserver(function(mutations) {
      mutations.forEach(function(mutation) {
        if (mutation.attributeName === "class") {
          var attributeValue = $(mutation.target).prop(mutation.attributeName);
          //console.log("Class attribute changed to:", attributeValue);
          if ($(".autoplay-loaded").hasClass('lazy-loaded')) {
            //console.log('now go!');
            autoNaviGallery();
          } else {
            //console.log('wait!');
          }
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
  $('.thumbs-gallery').slideToggle(300);
  paperPlaneLazyLoad.update();
}

function highlightCurrentThumb() {
  current_thumb_id = $('.photo-frame').attr("data-picture-id");
  //console.log(current_thumb_id);
  $('.current_thumb_' + current_thumb_id).addClass('current_thumb_hilight');
}

highlightCurrentThumb();

// clicks

// close overlay on mouse leave
$(".mouse-trap").mouseover(function() {
  closeOverlay();
});

// hide-navi call
$(document).on('click', '.highlight:not(.initialized)', function(e) {
  hideNavi();
  closeOverlay();
  $('.thumbs-gallery').slideUp(300);
});

// theme switch
$(document).on('click', '.bright-switch a:not(.initialized)', function(e) {
  setBrightness();
});
// hamburger
$('.ham-activator').click(function() {
  handleOverlay();
});

$(document).on('click', '.thumb-list:not(.initialized)', function(e) {
  showThumbsBox();
});

$(document).on('click', '.play-pause:not(.initialized)', function(e) {
  playOrPause = localStorage.getItem('playOrPause');
  if (playOrPause === 'pause') {
    localStorage.setItem('playOrPause', 'play');
    $('.play-pauser').removeClass('icon-fas-fa-play').addClass('icon-fas-fa-pause');
  }
  if (playOrPause === 'play') {
    localStorage.setItem('playOrPause', 'pause');
    $('.play-pauser').removeClass('icon-fas-fa-pause').addClass('icon-fas-fa-play');
  }
  autoNaviGallery();
});

$(document).on('swipeleft', '.absl_swipe:not(.initialized)', function(e) {
  nextNaviAction();
});

$(document).on('swiperight', '.absl_swipe:not(.initialized)', function(e) {
  prevNaviAction();
});

$(document).on('touchstart', '.absl_swipe:not(.initialized)', function(e) {
  $('.absl_swipe').addClass('swipe-info');
});

$(document).on('touchend', '.absl_swipe:not(.initialized)', function(e) {
  $('.absl_swipe').removeClass('swipe-info');
});

$(document).keydown(function(e) {
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
jQuery(document).ready(function($){
  
/* $( "[class*='container__col-']:has([class*='container__col-'])" ).addClass( "no-padding" ); */

/* push menu left */
$('.button-play-video').click(function(ev){
    $(this).addClass('fade-out');
    $(this).parent().addClass('hide-bgimage');
    $(this).siblings('.intro-details').addClass('fade-out');
    $("iframe")[0].src += "&autoplay=1"; ev.preventDefault();
    $("iframe").css( "z-index", "0" );
});
  
/*----- HASH SMOOTH SCROLL -----*/
// Select all links with hashes
$('a[href*="#"]')
  // Remove links that don't actually link to anything
  .not('[href="#"]')
  .not('[href="#0"]')
  .click(function(event) {
    // On-page links
    if (
      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
      && 
      location.hostname == this.hostname
    ) {
      // Figure out element to scroll to
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      // Does a scroll target exist?
      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 1000, function() {
          // Callback after animation
          // Must change focus!
          var $target = $(target);
          $target.focus();
          if ($target.is(":focus")) { // Checking if the target was focused
            return false;
          } else {
            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
            $target.focus(); // Set focus again
          };
        });
      }
    }
  });
  
/*----- MOBILE RECIPES SCROLL FUNCTION -----*/
$(window).on('scroll', function() {
  $(".more-recipes section, .author-page--recipes section").each(function() {
    if (isScrolledIntoView($(this))) {
      $(this).find("figure").removeClass("grayscale");
    } else {
      $(this).find("figure").addClass("grayscale");
    }
  });
});

function isScrolledIntoView(elem) {
  var docViewTop = $(window).scrollTop();
  var docViewBottom = docViewTop + $(window).height();

  var elemTop = $(elem).offset().top;
  var elemBottom = elemTop + $(elem).height();

  return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
}
  
/*----- FLOWTYPE -----*/
$('main').flowtype({
  minFont : 16,
  maxFont : 24,
  fontRatio : 82
});

/*----- SCROLLING MENU -----*/
function fade_header() {

  window_scroll = $(document).scrollTop();

  if ( window_scroll > 60) {
    $('.global-header').addClass('small-header');
  } else {
    $('.global-header').removeClass('small-header');
  }
}

$(window).scroll(function() { fade_header() });

/*----- IE FIXES -----*/
var ms_ie = false;
var ua = window.navigator.userAgent;
var old_ie = ua.indexOf('MSIE ');
var new_ie = ua.indexOf('Trident/');

if ((old_ie > -1) || (new_ie > -1)) {
    ms_ie = true;
}

if ( ms_ie ) {

  $('body').addClass('ie');

} else {

}
/*----- CONTENT LOADING ANIMATION -----*/

$(window).load(function() {
    // start up after 1sec no matter what
    window.setTimeout(function(){
        $('body').removeClass("loading").addClass('loaded');
    }, 500);
});

/*----- NAVIGATION ANIMATION -----*/
    var body = document.body,
        mask = document.createElement("div"),
        togglePush = $(".toggle-push-right"),
        pushMenu = document.querySelector( ".push-menu-right" ),
        menuClose = $(".close"),
        activeNav
    ;

    /* push menu left */
    $(togglePush).click(function(){
        $(body).toggleClass('pml-open');
        activeNav = 'pml-open';
        $("button").toggleClass("close");
    });

});
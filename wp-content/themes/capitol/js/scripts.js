jQuery(document).ready(function($){
  
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
  fontRatio : 70
});

/*----- PARALLAX -----*/  
$('.intro-image').stellar({
  // Set scrolling to be in either one or both directions
  verticalScrolling: true,
  horizontalScrolling: false,

  // Set the global alignment offsets
  horizontalOffset: 0,
  verticalOffset: 100,

  // Refreshes parallax content on window load and resize
  responsive: true,

  // Select which property is used to calculate scroll.
  // Choose 'scroll', 'position', 'margin' or 'transform',
  // or write your own 'scrollProperty' plugin.
  scrollProperty: 'transform',

  // Select which property is used to position elements.
  // Choose between 'position' or 'transform',
  // or write your own 'positionProperty' plugin.
  positionProperty: 'transform',

  // Enable or disable the two types of parallax
  parallaxBackgrounds: true,
  parallaxElements: false,

  // Hide parallax elements that move outside the viewport
  hideDistantElements: false,

  // Customise how elements are shown and hidden
  hideElement: function($elem) { $elem.hide(); },
  showElement: function($elem) { $elem.show(); }
});

/*----- SCROLLING MENU -----*/
function fade_header() {

  window_scroll = $(document).scrollTop();

  if ( window_scroll > 200) {
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

/*----- DESKTOP VIDEO AUTOPLAY -----*/
$(function() {
    // onload
    if(document.body.clientWidth >= 300) {
        $('video').attr('autoplay', true);
      $('#bgvid').css('display','block');
    }

    // If you want to autoplay when the window resized wider than 780px
    // after load, you can add this:

    $(window).resize(function() {
        if(document.body.clientWidth >= 870) {
            $('video').attr('autoplay', true);
        }
    });
});

/*----- ACTIVE NAVIGATION -----*/
var str=location.href.toLowerCase();

$(function () {
    setNavigation();
});

function setNavigation() {
    var path = window.location.pathname;
    path = path.replace(/\/$/, "");
    path = decodeURIComponent(path);

    $("body > nav ul li a").each(function () {
        var href = $(this).attr('href');
        if (path.substring(0, href.length) === href) {
            $(this).addClass('active');
        }
    });
}

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

// Cache selectors
var lastId,
    topMenu = $("body > nav"),
    topMenuHeight = topMenu.outerHeight(),
    // All list items
    menuItems = topMenu.find("a"),
    // Anchors corresponding to menu items
    scrollItems = menuItems.map(function(){
      var item = $($(this).attr("href"));
      if (item.length) { return item; }
    });

// Bind click handler to menu items
// so we can get a fancy scroll animation
menuItems.click(function(e){
  var href = $(this).attr("href"),
      offsetTop = href === "#" ? 0 : $(href).offset().top;
  $('html, body').stop().animate({
      scrollTop: offsetTop
  }, 500);
  e.preventDefault();
});

// Bind to scroll
$(window).scroll(function(){
   // Get container scroll position
   var fromTop = $(this).scrollTop()+topMenuHeight;

   // Get id of current scroll item
   var cur = scrollItems.map(function(){
     if ($(this).offset().top < fromTop)
       return this;
   });
   // Get the id of the current element
   cur = cur[cur.length-1];
   var id = cur && cur.length ? cur[0].id : "";

   if (lastId !== id) {
       lastId = id;
       // Set/remove active class
       menuItems
         .parent().removeClass("active")
         .end().filter("[href=#"+id+"]").parent().addClass("active");
   }
});

/*MENUCONTROLLER*/
// Hide Header on on scroll down
var didScroll;
var lastScrollTop = 0;
var delta = 5;
var navbarHeight = $('body > nav, header h2, .hamburger').outerHeight();

$(window).scroll(function(event){
    didScroll = true;
});

setInterval(function() {
    if (didScroll) {
        hasScrolled();
        didScroll = false;
    }
}, 250);

function hasScrolled() {
    var st = $(this).scrollTop();

    // Make sure they scroll more than delta
    if(Math.abs(lastScrollTop - st) <= delta)
        return;

    // If they scrolled down and are past the navbar, add class .nav-up.
    // This is necessary so you never see what is "behind" the navbar.
    if (st > lastScrollTop && st > navbarHeight){
        // Scroll Down
        $('body > nav, header h2').removeClass('nav-down').addClass('nav-up');
    } else if ($(window).width() < 800 && st > lastScrollTop && st > navbarHeight) {
		$('body > nav, header h2, .hamburger').removeClass('nav-down').addClass('nav-up');
	} else {
        // Scroll Up
        if(st + $(window).height() < $(document).height()) {
            $('body > nav, header h2').removeClass('nav-up').addClass('nav-down');
        }
    }

    lastScrollTop = st;
}

/*----- SAME PAGE SMOOTH SCROLL -----*/
$('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
        || location.hostname == this.hostname) {

        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
           if (target.length) {
             $('html,body').animate({
                 scrollTop: target.offset().top
            }, 1000);
            return false;
        }
    }
});

});

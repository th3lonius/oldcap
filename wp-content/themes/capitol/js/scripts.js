jQuery(document).ready(function($){

/*----- PARALLAX -----*/
var $window = $(window);

$('[data-type="background"]').each(function(){
    var $bgobj = $(this); // assigning the object


    $bgobj.css('background-image', 'url(' + $bgobj.data('background') + ')');

     $(window).scroll(function() {
         var yPos = -($window.scrollTop() / $bgobj.data('speed'));

         // Put together our final background position
         var coords = '50% '+ yPos + 'px';

         // Move the background
         $bgobj.css({ backgroundPosition: coords });
     });
});

/*----- POPULATE ADDTL MENU ITEMS -----*/

$('.nav-secondary').append('<li class="nav-item"><a class="nav-membership" href="/become-a-member">Become a Member</a></li><li class="nav-item"><div class="nav-signin agile_widget_signin"></div></li><li class="nav-item"><div class="agile_widget_cart"></div></li>');

$('.nav-primary').append('<li class="nav-item"><form action="index.html" method="post" class="subscribe"><input type="email" name="email" class="subscribe-input" placeholder="Email address" autofocus><button type="submit" class="subscribe-submit">Subscribe</button></form></li>');

/*----- SCROLLING MENU -----*/
function fade_header() {

  window_scroll = $(document).scrollTop();

  if ( window_scroll > 300) {
    $('.global-header').addClass('small-header');
    $('.slick-prev').addClass('scroll-slick');
    $('.slick-next').addClass('scroll-slick');
  } else {
    $('.global-header').removeClass('small-header');
    $('.slick-prev').removeClass('scroll-slick');
    $('.slick-next').removeClass('scroll-slick');
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


/*----- SUPERSLIDES INIT -----*/
$('#slider').superslides({
  animation: 'fade',
  slide_speed: 'normal',
  slide_easing: 'linear',
  play: 10000
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

/*----- REMODAL YOUTUBE TRAILER EMBED -----*/
$('.trailer').click(function(){
    var $trailerobj = $(this);
    $('#youtube').attr('src', 'http://www.youtube.com/embed/' + $trailerobj.data('video') + '?autoplay=1');
});

/*----- REMODAL YOUTUBE TRAILER KILL -----*/
$(document).on('closing', '.remodal', function (e) {
  $('#youtube').attr('src', '');
});

/*----- SLICK INITIALIZATION -> NEW RELEASES -----*/
$('.new-releases .container').slick({
  dots: false,
  infinite: true,
  autoplay: true,
  autoplaySpeed: 5000,
  speed: 500,
  slidesToShow: 4,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        infinite: true,
        dots: false
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 320,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});

$('.new-releases .container').on('reInit', function(event, slick){
  $('.trailer').click(function(){
    var $trailerobj = $(this);
    $('#youtube').attr('src', 'http://www.youtube.com/embed/' + $trailerobj.data('video') + '?autoplay=1');
  });
});

/*----- SLICK INITIALIZATION -> CALENDAR -----*/

$('.calendar-full').slick({
  dots: false,
  infinite: false,
  autoplay: false,
  speed: 500,
  slidesToShow: 7,
  slidesToScroll: 7,
  responsive: [
    {
      breakpoint: 2000,
      settings: {
        slidesToShow: 7,
        slidesToScroll: 7,
        infinite: true,
        dots: false
      }
    },
    {
      breakpoint: 1300,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 4
      }
    },
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});

/*----- AGILE SIGN OUT MESSAGE REPLACEMENT -----*/
$('.nav-signin').css('display', 'none');


/*----- HEXADECIMAL TO RGBA CONVERSION -----*/
function convertHex(hex,opacity){
    hex = hex.replace('#','');
    r = parseInt(hex.substring(0,2), 16);
    g = parseInt(hex.substring(2,4), 16);
    b = parseInt(hex.substring(4,6), 16);

    result = 'rgba('+r+','+g+','+b+','+opacity/100+')';
    return result;
}

$('.series-title').each(function( index, element ) {
    var $hex = $(this).css('backgroundColor');
    $hex = $hex.replace('rgb(', '');
    $hex = $hex.replace(')', '');
    $(this).parents('header').siblings('.overlay').css('backgroundImage', 'linear-gradient(180deg, rgba('+$hex+', 0.14), rgba('+$hex+', 0.2) 50%, rgba('+$hex+', 0.9) 100%)');//.children('.overlay'));
    //$(this).parents('header').siblings('.overlay').css('background', 'rgba('+$hex+', 0.3)');
  });

/*----- HOME LOGO CLICK ACTION -----*/
$('.logotype').click(function(){
  window.location.href = '/';
});

/*----- ANNOUNCEMENT BAR SHOW MORE SCROLLOUT FUNCTIONALITY -----*/
$('.announcement').click(function() {
  if(!$(this).hasClass('open')) {
    $(this).children('section').slideDown("slow");
    $(this).children('p').first().css({
      "font-size": "3.906rem",
      "padding": "1.5rem 0 0"
    });
  } else {
    $(this).children('p').first().css({
      "font-size": "1.6rem",
      "padding": "0"
    });
    $(this).children('section').slideUp("slow");
  }
  $(this).toggleClass('open');
});



/*----- ANNOUNCEMENT BAR DISABLED SESSION HANDLING -----*/
$('#ann-exit').click(function(){
  $('.announcement').fadeOut();
  $.ajax({
    method: "POST",
    url: "wp-content/themes/filmscene/ann-off.php",
    data: { annID: $('.announcement').attr('rel') },
  });
});

/*----- ANNOUNCEMENT BAR MOBILE MENU POSITIONING -----*/
if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
  $('.nav-main').css('top', ($('.announcement').height()+110) + 'px');
}


});

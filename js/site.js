/**
 *
 * Handles toggling the navigation menu for small screens.
 */
( function() {
  var container, button, menu;

  container = document.getElementById( 'site-navigation' );
  if ( ! container )
    return;

  button = container.getElementsByTagName( 'button' )[0];
  if ( 'undefined' === typeof button )
    return;

  menu = container.getElementsByTagName( 'ul' )[0];

  // Hide menu toggle button if menu is empty and return early.
  if ( 'undefined' === typeof menu ) {
    button.style.display = 'none';
    return;
  }

  if ( -1 === menu.className.indexOf( 'nav-menu' ) )
    menu.className += ' nav-menu';

  button.onclick = function() {
    if ( -1 !== container.className.indexOf( 'toggled' ) )
      container.className = container.className.replace( ' toggled', '' );
    else
      container.className += ' toggled';
  };
} )();


/**
 *
 * Skip focus link.
 *
 */

( function() {
  var is_webkit = navigator.userAgent.toLowerCase().indexOf( 'webkit' ) > -1,
      is_opera  = navigator.userAgent.toLowerCase().indexOf( 'opera' )  > -1,
      is_ie     = navigator.userAgent.toLowerCase().indexOf( 'msie' )   > -1;

  if ( ( is_webkit || is_opera || is_ie ) && document.getElementById && window.addEventListener ) {
    window.addEventListener( 'hashchange', function() {
      var element = document.getElementById( location.hash.substring( 1 ) );

      if ( element ) {
        if ( ! /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) )
          element.tabIndex = -1;

        element.focus();
      }
    }, false );
  }
})();


/**
 *
 * Theme Sliders
 *
 */

// Full width slider
jQuery(document).ready(function($) { 
//FULL width Slider
//  var FW_Slider = $('.fw_slider__container').swiper({
//    wrapperClass : 'fw_slider__wrapper',
//    slideClass : 'fw_slider__slide',
//    pagination: '.fw_slider__pagination',
//    autoplay: 4000,
//    loop:true,
//    grabCursor: true,
//    paginationClickable: true,
//    calculateHeight: true
//  })
//
//  $('.fw_slider__arrow-left').on('click', function(e){
//    e.preventDefault()
//    FW_Slider.swipePrev()
//  })
//
//  $('.fw_slider__arrow-right').on('click', function(e){
//    e.preventDefault()
//    FW_Slider.swipeNext()
//  })


//var mySwiper = new Swiper ('.swiper-container');
  var mySwiper = new Swiper ('.swiper-container', {
    // Optional parameters
    loop: true,
    autoplayDisableOnInteraction:false,
    autoplay: 3000,
    slidesPerView: 1,
    
    // If we need pagination
    pagination: '.swiper-pagination',
    
    // Navigation arrows
    nextButton: '.swiper-button-next',
    prevButton: '.swiper-button-prev',
    
    // And if we need scrollbar
    scrollbar: '.swiper-scrollbar',
    // /effect: 'cube',
    // /    grabCursor: true,
    // /    cube: {
    // /        shadow: true,
    // /        slideShadows: true,
    // /        shadowOffset: 20,
    // /        shadowScale: 0.94
    // /    }
   })  
});

// http://scottjehl.github.io/picturefill/#getting-started
// Picture element HTML5 shiv
document.createElement( "picture" );
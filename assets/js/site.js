
/**
 * Makes "skip to content" link work correctly in IE9, Chrome, and Opera
 * for better accessibility.
 *
 * @link http://www.nczonline.net/blog/2013/01/15/fixing-skip-to-content-links/
 */

 ( function() {
  var isWebkit = navigator.userAgent.toLowerCase().indexOf( 'webkit' ) > -1,
    isOpera  = navigator.userAgent.toLowerCase().indexOf( 'opera' )  > -1,
    isIE     = navigator.userAgent.toLowerCase().indexOf( 'msie' )   > -1;

  if ( ( isWebkit || isOpera || isIE ) && document.getElementById && window.addEventListener ) {
    window.addEventListener( 'hashchange', function() {
      var id = location.hash.substring( 1 ),
        element;

      if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
        return;
      }

      element = document.getElementById( id );

      if ( element ) {
        if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
          element.tabIndex = -1;
        }

        element.focus();

        // Repositions the window on jump-to-anchor to account for admin bar and border height.
        window.scrollBy( 0, -53 );
      }
    }, false );
  }
} )();


/**
 *
 * Theme Sliders
 *
 */

// Full width slider
jQuery(document).ready(function($) { 

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
    scrollbar: '.swiper-scrollbar'   
   })  
});

// http://scottjehl.github.io/picturefill/#getting-started
// Picture element HTML5 shiv
document.createElement( "picture" );
/**
 * File skip-link-focus-fix.js.
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
( function() {
  var isWebkit = navigator.userAgent.toLowerCase().indexOf( 'webkit' ) > -1,
      isOpera  = navigator.userAgent.toLowerCase().indexOf( 'opera' )  > -1,
      isIe     = navigator.userAgent.toLowerCase().indexOf( 'msie' )   > -1;

  if ( ( isWebkit || isOpera || isIe ) && document.getElementById && window.addEventListener ) {
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
      }
    }, false );
  }
})();



jQuery(document).ready(function($) { 

  if (typeof Swiper != "undefined") {

  // Full width slider
  var mySwiper = new Swiper ('.swiper-container', {
    // Optional parameters
    loop: true,
    autoplayDisableOnInteraction:false,
    autoplay: 4000,
    slidesPerView: 1,    
    // Navigation arrows
    nextButton: '.swiper-button-next',
    prevButton: '.swiper-button-prev',

    // If we need pagination
    pagination: '.swiper-pagination',
    paginationClickable:true,    
    // And if we need scrollbar
    scrollbar: '.swiper-scrollbar'   
   }) ;
  
  // Anything Slider
  var wpsAnySwiper = new Swiper ('.wps-anything-swiper-container', {
    // Optional parameters
    loop: true,
    autoplayDisableOnInteraction:false,
    autoplay: 4000,
    slidesPerView: 1,    
    // Navigation arrows
    nextButton: '.wps-anything-swiper-button-next',
    prevButton: '.wps-anything-swiper-button-prev',
  
    // If we need pagination
    pagination: '.swiper-pagination',
    paginationClickable:true,
    // And if we need scrollbar
    scrollbar: '.swiper-scrollbar'   
   });
 }


  //Youtube Video
  // ref: https://github.com/rochestb/jQuery.YoutubeBackground
  $('.wps-ytube-video').each(function() {
      var videoID = $(this).data('video-bg-id');
    $(this).YTPlayer({
      fitToBackground: true,
      videoId: videoID,
      pauseOnScroll: true,
      repeat: true,
      playerVars: {
          autoplay: 1,
          //enablejsapi: 1,
          modestbranding: 1,
          autoplay: 1,
          controls: 0,
          showinfo: 0,
          wmode: 'transparent',
          //playsinline: 1,
          //branding: 0,
          rel: 0,
          origin: window.location.origin
      }
    });
  });


  // Fancybox
  /* Create gallery items alt data */
  jQuery('.gallery').each(function () {
    var id = jQuery(this).attr('id');
    
      jQuery('.gallery-icon a', this).attr('data-fancybox', function (i, attr) {
           return id;
      });
  });


  // Fancybox wp galery
  $(".gallery-icon a").fancybox({
    beforeShow : function() {
        var alt = this.element.find('img').attr('alt');
        
        this.inner.find('img').attr('alt', alt);
        
        this.title = alt;
    }
  });

  // Initialize the Lightbox automatically for any links to images with extensions .jpg, .jpeg, .png or .gif
    $("a[href$='.jpg'], a[href$='.png'], a[href$='.jpeg'], a[href$='.gif']").fancybox();
});
/*nav bar js start*/

/*jQuery('#nav').affix({
      offset: {
        top: jQuery('header').height()
      }
});	*/


/*nav bar js end*/
// ===== Scroll to Top ==== 
jQuery(window).scroll(function() {
    if (jQuery(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
        jQuery('#return-to-top').fadeIn(200);    // Fade in the arrow
    } else {
        jQuery('#return-to-top').fadeOut(200);   // Else fade out the arrow
    }
});
jQuery('#return-to-top').click(function() {      // When arrow is clicked
    jQuery('body,html').animate({
        scrollTop : 0                       // Scroll to top of body
    }, 1500);
});



   jQuery(document).ready(function() {
      var owl = jQuery('.owl-carousel');
      owl.owlCarousel({
         loop: true,
         nav: false,
         navSpeed: 1500,
         slideSpeed : 1500,
         dots: false,
         dotsSpeed: 1500,
         lazyLoad: false,
         autoplay: true,
         autoplayHoverPause: true,
         autoplayTimeout: 3000,
         autoplaySpeed:  1500,
         margin: 0,
         stagePadding: 0,
         freeDrag: false,
         mouseDrag: true,
         touchDrag: true,
         slideBy: 1,
         fallbackEasing: "linear",
         responsiveClass: true,
         navText: [ "previous", "next" ],
         responsive: {
            0: {
               items: 1,
               nav: false
            },
            600: {
               items: 2,
               nav: false
            },
            1000: {
               items: 2,
               nav: false,
               margin: 20
            }
          }
       });
       /*owl.on('mousewheel', '.owl-stage', function (e) {
         if (e.deltaY>0) {
            owl.trigger('next.owl');
         } else {
            owl.trigger('prev.owl');
         }
         e.preventDefault();
      });*/
   })



/*


    tjq(document).ready(function() {
            tjq("#price-range").slider({
                range: true,
                min: 0,
                max: 1000,
                values: [ 100, 800 ],
                slide: function( event, ui ) {
                    tjq(".min-price-label").html( "jQuery" + ui.values[ 0 ]);
                    tjq(".max-price-label").html( "jQuery" + ui.values[ 1 ]);
                }
            });
            tjq(".min-price-label").html( "jQuery" + tjq("#price-range").slider( "values", 0 ));
            tjq(".max-price-label").html( "jQuery" + tjq("#price-range").slider( "values", 1 ));
            
            tjq("#rating").slider({
                range: "min",
                value: 40,
                min: 0,
                max: 50,
                slide: function( event, ui ) {
                    
                }
            });
        });*/
// Slick version 1.5.8
//$(document).ready(function() {
jQuery(document).ready(function($) {
    $('.carousel').slick({
        autoplay:true,
        slidesToShow: 4,
        slidesToScroll: 1,
        dots:false,
        infinite: true,
        speed: 300,
        responsive: [ {
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
            }
            },
            {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2
            }
            },
            {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
            }
            ]
        });
    });
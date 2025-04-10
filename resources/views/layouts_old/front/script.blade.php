<!-- Javascript -->
<script type="text/javascript" src='{{ asset ("/resources/assets/admin-lte/plugins/jQuery/jquery-2.2.3.min.js") }}'></script>
@yield("custom_second_page_js")

<!-- <script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/jquery.noconflict.js") }}'></script> -->
<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/modernizr.2.7.1.min.js") }}'></script>
<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/jquery-migrate-1.2.1.min.js") }}'></script>
<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/jquery.placeholder.js") }}'></script>
<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/jquery-ui.1.10.4.min.js") }}'></script>

<script src='{{ asset("/resources/assets/slick/js/slick.js") }}'></script>
<!-- Twitter Bootstrap -->
<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/bootstrap.js") }}'></script>

<!-- load revolution slider scripts -->
<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/components/revolution_slider/js/jquery.themepunch.tools.min.js") }}'></script>
<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/components/revolution_slider/js/jquery.themepunch.revolution.min.js") }}'></script>

<!-- Flex Slider -->
<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/components/flexslider/jquery.flexslider.js") }}'></script>

<!-- load BXSlider scripts -->
<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/components/jquery.bxslider/jquery.bxslider.min.js") }}'></script>

<!-- parallax -->
<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/jquery.stellar.min.js") }}'></script>

<!-- waypoint -->
<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/waypoints.min.js") }}'></script>

<!-- load page Javascript -->
<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/theme-scripts.js") }}'></script>
<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/scripts.js") }}'></script>
<!--<script src="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/owl.carousel.js"></script>-->
<script type="text/javascript" src='{{ asset ("/resources/assets/js/owl.carousel.js") }}'></script>
<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/npm.js") }}'></script>
<!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnT6ewhJpccffkJRlbAPyCQeQKJxJfLQ8&libraries=places"></script>-->
<script src='{{ asset ("/resources/assets/frontend/js/bootstrap-formhelpers.min.js") }}'></script>
<script src='{{ asset ("/resources/assets/frontend/js/bootstrap-validator.js") }}'></script>
<!--<script src='{{ asset ("/resources/assets/js/profile/profile.js") }}'></script>-->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js' type="text/javascript"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.js"></script>
<!--<script src='{{ asset ("/resources/assets/js/search.js") }}'></script>-->
<!--<script src="http://maps.googleapis.com/maps/api/js?sensor=false&libraries=places" type="text/javascript"></script>-->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
  $('.carousel').slick({
     autoplay:true,
  slidesToShow: 4,
  slidesToScroll: 1,
  dots:false,
   infinite: true,
  speed: 300,
 
   responsive: [
    {
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

// Slick version 1.5.8
</script>

@yield("custom_js")

<script type="text/javascript">
//
document.login_customer.onsubmit=function(e) {
    e.preventDefault()
    var form_data = new FormData($("#login_customer")[0]);
    var APP_URL=jQuery("#base_url").val();

    $.ajax({
        url: APP_URL+'/login-customer',
        data: form_data,
        type: 'post',
        contentType: false,
        processData: false,
        success: function (data) {
            // if (data =='success') {
                // $("#queryHandler").modal('hide');
                // $('#login_box').modal('toggle');
            //  setTimeout(function () {
            //      location.reload();
            //      }, 100)
            //  }
            // else {
                // tjq("#travelo-login").modal('hide');
                // tjq("#error_box").html("").html(data)
                // setTimeout(function () {
                    //   location.reload();
                    // }, 4999)
                // }
                setTimeout(function () {
                    location.reload();
                    }, 4999)
            },
        error: function (xhr, status, error) {
            //alert(xhr.responseText);
            //console.log('Error : '+data);
            }
        });
    }
//
jQuery(document).ready(function(){
    jQuery(".chaser").css("display","none")
    /*function initialize() {
        var input = document.getElementById('autocomplete');
        var opts = {
            types: ['(cities)']
            };
            var autocomplete = new google.maps.places.Autocomplete(input,opts);
            }
            google.maps.event.addDomListener(window, 'load', initialize);
            jQuery('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
            localStorage.setItem('activeTab', jQuery(e.target).attr('href'));
        });
        var activeTab = localStorage.getItem('activeTab');
        if(activeTab){
        jQuery('a[href="' + activeTab + '"]').tab('show');
        }
         jQuery('#hotelcheckin table').mouseleave(function(){
           jQuery('#input-hotel-checkin').val(jQuery('#hotelcheckin input').val());
       });
       jQuery('#hotelcheckout table').mouseleave(function(){
           jQuery('#input-hotel-checkout').val(jQuery('#hotelcheckout input').val());
       });*/

        jQuery('#myaccount').click(function(e){
            e.preventDefault();
          
            jQuery('.account').toggle();
            })
            jQuery('.checkAvailableRoom').click(function(){
                var base_url = jQuery("#base_url").val();
                var form_data = jQuery(this).prev().serializeArray();
                jQuery.ajax({
                    type: "POST",
                    url: base_url + "/check_availability",
                    // contentType: "application/json",
                    // dataType: "json",
                    data:{
                        form_data: form_data,
                        },
                        success: function(response) {
                            console.log(response);
                            },
                            error: function(response) {
                                console.log(response);
                                }
                    });
                });
        // var myDropzone = new Dropzone("#add-image", { url: "/file/post"});
        //  jQuery("#add-image").dropzone({ url: "/file/post" });
    });
        /*jQuery(".custom_value").click(function(){        
        var theme_value=jQuery(this).siblings(":input").val();
      jQuery("#theme_search").val(theme_value);
      document.getElementById('theme_call').submit()
        })*/ //packages_dest
       /*jQuery(".dest_search").click(function(){          
        var dest_value=jQuery(this).siblings(":input").val();
      jQuery("#destination_search2").val(dest_value);
      document.getElementById('packages_dest').submit()
        })*/
        //
jQuery("#sub").submit(function(e) {
    e.preventDefault();
    var sub_email=jQuery("#sub_email").val();
    var APP_URL=jQuery("#testvalue_footer").val();
    var url=APP_URL+'/newsletter';
    var data={sub_email:sub_email,_token:"{{ csrf_token() }}"};
    jQuery.post(url,data,function(rdata) {
        console.log(rdata)
        alert(rdata);
        })
    })
//mobile sticky       
</script>

<script type="text/javascript">
         tjq(document).ready(function() {
             tjq("#price-range").slider({
                 range: true,
                 min: 5000,
                 max: 400000,
                 values: [ 5000, 400000 ],
                 slide: function( event, ui ) {
                     tjq(".min-price-label").html( "&#8377;" + ui.values[ 0 ]);
                     tjq(".max-price-label").html( "&#8377;" + ui.values[ 1 ]);
                 }
             });
              tjq("#price-ranges").slider({
                 range: true,
                 min: 5000,
                 max: 400000,
                 values: [ 5000, 400000 ],
                 slide: function( event, ui ) {
                     tjq(".min-price-label").html( "&#8377;" + ui.values[ 0 ]);
                     tjq(".max-price-label").html( "&#8377;" + ui.values[ 1 ]);

                    return  drop_function();
                 }
             });
               tjq("#price-ranges_mobile").slider({
                 range: true,
                 min: 5000,
                 max: 400000,
                 values: [ 5000, 400000 ],
                 slide: function( event, ui ) {
                     tjq(".min-price-label").html( "&#8377;" + ui.values[ 0 ]);
                     tjq(".max-price-label").html( "&#8377;" + ui.values[ 1 ]);

                    return  drop_function();
                 }
             });
             tjq(".min-price-label").html( "&#8377;" + tjq("#price-range").slider( "values", 0 ));
             tjq(".max-price-label").html( "&#8377;" + tjq("#price-range").slider( "values", 1 ));

             tjq(".min-price-label").html( "&#8377;" + tjq("#price-ranges").slider( "values", 0 ));
             tjq(".max-price-label").html( "&#8377;" + tjq("#price-ranges").slider( "values", 1 ));
             
             tjq("#rating").slider({
                 range: "min",
                 value: 40,
                 min: 0,
                 max: 50,
                 slide: function( event, ui ) {  
                 }
             });

              function convertTimeToHHMM(t) {
                 var minutes = t % 60;
                 var hour = (t - minutes) / 60;
                 var timeStr = (hour + "").lpad("0", 2) + ":" + (minutes + "").lpad("0", 2);
                 var date = new Date("2014/01/01 " + timeStr + ":00");
                 var hhmm = date.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit'});
                 return hhmm;
             }
             tjq("#flight-times").slider({
                 range: true,
                 min: 0,
                 max: 1440,
                 step: 5,
                 values: [ 360, 1200 ],
                 slide: function( event, ui ) {
                     
                     tjq(".start-time-label").html( convertTimeToHHMM(ui.values[0]) );
                     tjq(".end-time-label").html( convertTimeToHHMM(ui.values[1]) );
                 }
             });
             tjq(".start-time-label").html( convertTimeToHHMM(tjq("#flight-times").slider( "values", 0 )) );
             tjq(".end-time-label").html( convertTimeToHHMM(tjq("#flight-times").slider( "values", 1 )) );
         });
</script>

<script type="text/javascript">
        tjq(document).ready(function() {
            tjq("#profile .edit-profile-btn").click(function(e) {
                e.preventDefault();
                tjq(".view-profile").fadeOut();
                 tjq(".edit-image").fadeOut();
                tjq(".edit-profile").fadeIn();
            });
             tjq("#profile .edit-image-btn").click(function(e) {
                e.preventDefault();
                tjq(".view-profile").fadeOut();
                tjq(".edit-image").fadeIn();
            });

            setTimeout(function() {
                tjq(".notification-area").append('<div class="info-box block"><span class="close"></span><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus ab quis a dolorem, placeat eos doloribus esse repellendus quasi libero illum dolore. Esse minima voluptas magni impedit, iusto, obcaecati dignissimos.</p></div>');
            }, 10000);
        });
        tjq('a[href="#profile"]').on('shown.bs.tab', function (e) {
            tjq(".view-profile").show();
            tjq(".edit-profile").hide();
        });
        //

  // var myVar = setInterval(myTimer, 1000);

var slideIndex_second = 0;
showSlides_second();

function showSlides_second() {
  var i;
  var slides = document.getElementsByClassName("theSlides");

  // var dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "block";  
  }
  slideIndex_second++;

  if (slideIndex_second > slides.length) {slideIndex_second = 1}    
  // for (i = 0; i < dots.length; i++) {
  //   dots[i].className = dots[i].className.replace(" active", "");
  // }
  slides[slideIndex_second-1].style.display = "none"; 
  // slides[slideIndex_second-1].style.display = "block";  
  // dots[slideIndex_second-1].className += " active";
  setTimeout(showSlides_second, 2000); // Change image every 2 seconds
}

</script>
</body>
</html>
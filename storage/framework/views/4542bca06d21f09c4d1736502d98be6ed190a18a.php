    <!-- script. -->
    <!-- Javascript -->
    <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/admin-lte/plugins/jQuery/jquery-2.2.3.min.js")); ?>'></script>
    <!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->

    <!-- Lazy-loading-images (working) -->
    <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/frontend/js/lazy-loading.js")); ?>'></script>

    <!-- desktop-mobile-width -->
    <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/frontend/js/desktop-mobile-width.js")); ?>'></script>

    <!-- yield('home-page-js')

    yield("custom_second_page_js") -->

    <!-- Search -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/frontend/js/modernizr.2.7.1.min.js")); ?>'></script>
    <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/frontend/js/jquery-migrate-1.2.1.min.js")); ?>'></script>

    <!-- date picker search panel home-->
    <!-- yield('header_datepicker_js') -->

    <!-- datepicker -->
    <!--<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>-->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    

    <!-- my-booking redirect -->
    <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/frontend/js/my-booking-redirect.js")); ?>'></script>

    <!-- gateway -->
    <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/frontend/js/gateway.js")); ?>'></script>

    <!-- user login-->
    <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/frontend/js/user-login.js")); ?>'></script>

    <!-- web header (added in home) -->
    <!-- <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/frontend/js/web-header.js")); ?>'></script> -->

    <!-- insurance guest box -->
    <!-- <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/frontend/js/insurance-guest-input.js")); ?>'></script> -->

    <!-- Testimonial slider -->
    <script src='<?php echo e(asset("/resources/assets/slick/js/slick.js")); ?>'></script>
    <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/frontend/js/slick-itemcard.js")); ?>'></script>

    <!-- flex slider -->
    <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/frontend/components/flexslider/jquery.flexslider.js")); ?>'></script>

    <!-- Third page - Image -->
    <!-- <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/frontend/js/theme-scripts.js")); ?>'></script> -->

    <!-- slidershow -->
    <!-- <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/frontend/js/slideshow.js")); ?>'></script> -->

    <!-- swal -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- news letter -->
    <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/frontend/js/newsletter.js")); ?>'></script>

    <!--second page (load content on scroll)--
    <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/frontend/js/jquery-ui.1.10.4.min.js")); ?>'></script>-->

    <!-- Twitter Bootstrap -->
    <!-- <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/frontend/js/bootstrap.js")); ?>'></script> -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

    <script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js'></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.js"></script>

    <?php echo $__env->yieldContent("custom_js"); ?>

    <?php echo $__env->yieldContent('home-page-js'); ?>

    <?php echo $__env->yieldContent("custom_second_page_js"); ?>

    <!-- --------------------------------- -->

    <!-- Header (added in web-header.js-->
    <!-- <script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
        var header = document.querySelector(".navHeaderWrapper");
        var fixedHeader = document.querySelector(".dNavCont");
        var stickyPosition = 87;

        window.onscroll = function() {
            if (window.pageYOffset > stickyPosition) {
                header.style.display = "block";
                header.classList.remove("navClass");
                header.classList.add("makeStickyHeader");
                fixedHeader.classList.add("stickyHeaderAdded");
            } else {
                header.classList.remove("makeStickyHeader");
                header.classList.add("navClass");
                fixedHeader.classList.remove("stickyHeaderAdded");
            }
        };
    });
    </script> -->

    <!-- --------------------------------- -->

    <!-- Travel Date Style-Search Panel (date-picker-search-panel.js-->
    <!-- <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/frontend/js/date-picker-search-panel.js")); ?>'></script> -->

    <!-- --------------------------------- -->

    <!-- login and signup -->
    <script type="text/javascript">
    //
    jQuery(document).ready(function(){
        jQuery(".chaser").css("display","none")
       
            jQuery('#myaccount').click(function(e) {

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

    //Newsletter.js
    /*$(document).ready(function() {
        jQuery("#sub").submit(function(e) {

                e.preventDefault();

                var sub_email=jQuery("#sub_email").val();
                var APP_URL=jQuery("#testvalue_footer").val();
                var url=APP_URL+'/newsletter';
                var data={sub_email:sub_email,_token:"<?php echo e(csrf_token()); ?>"};

                jQuery.post(url,data,function(rdata) {
                    console.log(rdata)
                    alert(rdata);
                    })
                })
        });*/
    //mobile sticky
    </script>

    <!--Filter Second Page, placed in second page-->
    <!-- <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/frontend/js/filter.js")); ?>'></script> -->


    <!-- slideshow.js -->
    <script type="text/javascript">
    /*document.addEventListener("DOMContentLoaded", function() {
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
            if (slideIndex_second > slides.length) {
                slideIndex_second = 1 // Reset index if it exceeds the number of slides
                }
            // for (i = 0; i < dots.length; i++) {
            //   dots[i].className = dots[i].className.replace(" active", "");
            // }
            slides[slideIndex_second-1].style.display = "none";
            // slides[slideIndex_second-1].style.display = "block"; // Show the current slide
            // dots[slideIndex_second-1].className += " active";
            setTimeout(showSlides_second, 2000); // Change image every 2 seconds
            }
        });*/
    </script>

</body>

</html>
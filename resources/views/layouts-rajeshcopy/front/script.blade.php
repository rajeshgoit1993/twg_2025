<!-- Javascript -->

<script type="text/javascript" src='{{ asset ("/resources/assets/admin-lte/plugins/jQuery/jquery-2.2.3.min.js") }}'></script>

<!--Lazy-loading-images-->
<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/lazy-loading.js") }}'></script>

@yield("custom_second_page_js")
<!--Search-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/modernizr.2.7.1.min.js") }}'></script>
<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/jquery-migrate-1.2.1.min.js") }}'></script>

<!--Testimonial slider-->
<script src='{{ asset("/resources/assets/slick/js/slick.js") }}'></script>
<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/slick-itemcard.js") }}'></script>


<!--second page (load content on scroll)--
<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/jquery-ui.1.10.4.min.js") }}'></script>-->

<!-- Twitter Bootstrap -->
<!-- <script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/bootstrap.js") }}'></script> -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
<!-- Third page - Image -->
<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/theme-scripts.js") }}'></script>

<!-- Flex Slider -->
<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/components/flexslider/jquery.flexslider.js") }}'></script>

<script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js'></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!--Swal-->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 <script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/gateway.js") }}'></script>

@yield("custom_js")


<script type="text/javascript">

   

let timerOn = true;

function timer(remaining) {
  var m = Math.floor(remaining / 60);
  var s = remaining % 60;
  
  m = m < 10 ? '0' + m : m;
  s = s < 10 ? '0' + s : s;
  document.getElementById('timer').innerHTML = m + ':' + s;
  remaining -= 1;
  
  if(remaining >= 0 && timerOn) {
    setTimeout(function() {
        timer(remaining);
    }, 1000);
    return;
  }

  if(!timerOn) {
    // Do validate stuff here
    return;
  }
  
  // Do timeout stuff here
  // alert('Timeout for otp');
    document.getElementById('timer').innerHTML = '<span class="login_resend fontSize12 color008">Resend OTP</span>';

}
$(document).on("click",".login_resend",function(e){
e.preventDefault();
var login_email=$("#login_email").val()
if(login_email=='')
{
swal("Error", 'Enter Email ID', "error");
}
else
{
   
var APP_URL=$("#APP_URL").val()
 // $('#under_processing').modal('toggle');
// $('#otp_login_modal').modal('toggle');
timer(120);

   var url=APP_URL+'/send_login_otp';
var data={_token:"{{ csrf_token() }}",login_email:login_email};
 $.get(url,data,function(rdata) {
    if(rdata=='success')
    {
// $('#under_processing').modal('hide');
// $('#otp_login_modal').modal('toggle');
// swal("Done !", 'OTP successfully sended to your Email & Mobile No.', "success");
    }
    else
    {
       swal("Error", rdata, "error"); 
    }
}) 

 
}

   })


   $(document).on("click","#login_with_otp",function(e){
e.preventDefault();
var login_email=$("#login_email").val()
if(login_email=='')
{
swal("Error", 'Enter Email ID', "error");
}
else
{
    $('#user-login').modal('hide');
var APP_URL=$("#APP_URL").val()
 // $('#under_processing').modal('toggle');
$('#otp_login_modal').modal('toggle');
timer(120);
   var url=APP_URL+'/send_login_otp';
var data={_token:"{{ csrf_token() }}",login_email:login_email};
 $.get(url,data,function(rdata) {
    if(rdata=='success')
    {
// $('#under_processing').modal('hide');

// swal("Done !", 'OTP successfully sended to your Email & Mobile No.', "success");

    }
    else
    {
       swal("Error", rdata, "error"); 
    }
}) 

 
}

   })
//otp_login

  $(document).on("click","#otp_login",function(){
 var APP_URL=$("#APP_URL").val()
 var otp_value=$("#login_otp_value").val()
 if(otp_value=='')
 {
 swal("Error", 'Enter OTP', "error"); 
 }
 else
 {
  var url=APP_URL+'/login_with_otp';
var data={_token:"{{ csrf_token() }}",otp_value:otp_value};
 $.get(url,data,function(rdata) {
    if(rdata=='success')
    {
swal("Done !", 'successfully login', "success");
location.reload("/")
    }
    else
    {
       swal("Error", rdata, "error");   
    }
})
 }
 

  

 })

  $(document).on("submit", "#register-customer", function (event) {

  event.preventDefault();
 $('#under_processing').modal('show');  
   

   var form_data = new FormData($("#register-customer")[0]);
 var APP_URL=$("#APP_URL").val();
    $.ajax({
        url:APP_URL+'/register-customer',
        data:form_data,
        type:'post',
        contentType: false,
        processData: false,
        
        success:function(data)
        {
            
        if(data=='success')
        {
            $('#under_processing').modal('hide');  
         $('#user-signup').modal('hide');
          $('#otp_signup_modal').modal('show');  
        // $('#edit_modal').modal('hide');
       // swal("Done !", 'Successfully Updated', "success");
       
        // var url=APP_URL+'/Utensil-List';
        // window.location.href = url;
     
       }
       else
      {
          $('#under_processing').modal('hide');  
        swal("Error", data, "error"); 
        
       }

        },
        error:function(data)
        {

        }
    })
});

  $(document).on("click","#otp_signup",function(){
 var APP_URL=$("#APP_URL").val()
 var otp_value=$("#signup_otp_value").val()
 if(otp_value=='')
 {
 swal("Error", 'Enter OTP', "error"); 
 }
 else
 {
  var url=APP_URL+'/signup_with_otp';
var data={_token:"{{ csrf_token() }}",otp_value:otp_value};
 $.post(url,data,function(rdata) {
    if(rdata=='success')
    {
swal("Done !", 'successfully Registered', "success");
location.reload("/")
    }
    else
    {
       swal("Error", rdata, "error");   
    }
})
 }
 

  

 })

// document.login_customer.onsubmit=function(e) {
//     e.preventDefault()
//     var form_data = new FormData($("#login_customer")[0]);
//     var APP_URL=jQuery("#base_url").val();

//     $.ajax({
//         url: APP_URL+'/login-customer',
//         data: form_data,
//         type: 'post',
//         contentType: false,
//         processData: false,
//         success: function (data) {
          
//                 setTimeout(function () {
//                     location.reload();
//                     }, 4999)
//             },
//         error: function (xhr, status, error) {
//             //alert(xhr.responseText);
//             //console.log('Error : '+data);
//             }
//         });
//     }
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

<!--Filter-->
<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/filter.js") }}'></script>

<script type="text/javascript">
// tjq(document).ready(function() {
//     tjq("#profile .edit-profile-btn").click(function(e) {
//         e.preventDefault();
//         tjq(".view-profile").fadeOut();
//         tjq(".edit-image").fadeOut();
//         tjq(".edit-profile").fadeIn();
//         });
//     tjq("#profile .edit-image-btn").click(function(e) {
//         e.preventDefault();
//         tjq(".view-profile").fadeOut();
//         tjq(".edit-image").fadeIn();
//         });
//     setTimeout(function() {
//         tjq(".notification-area").append('<div class="info-box block"><span class="close"></span><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus ab quis a dolorem, placeat eos doloribus esse repellendus quasi libero illum dolore. Esse minima voluptas magni impedit, iusto, obcaecati dignissimos.</p></div>');
//         }, 10000);
//     });

// tjq('a[href="#profile"]').on('shown.bs.tab', function (e) {
//     tjq(".view-profile").show();
//     tjq(".edit-profile").hide();
//     });
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
@extends('layouts.front.master')
	@if(env("WEBSITENAME")==1)
		@section('keywords','India travel, travel in India, cheap air tickets, cheap flights, flight, hotels, hotel, holidays, air travel, air tickets, holiday packages, travel packages, tour packages, International travel, Theworldgateway')
		@section('desc',' Find best deals at TheWorldGateway for Flight Tickets, Hotels, Holiday Packages for India &amp; International travel. Book cheap air tickets online for Domestic &amp; International airlines, customized Tour packages and special deals on Hotel Bookings. ')
		@section("title", 'TheWorldGateway - Travel Website 50% OFF on Holidays, Flights & Hotels')
	@elseif(env("WEBSITENAME")==0)
		@section('keywords','India travel, travel in India, cheap air tickets, cheap flights, flight, hotels, hotel, holidays, air travel, air tickets, holiday packages, travel packages, tour packages, International travel, RapidexTravels')
		@section('desc','Find best deals at RapidexTravels for Flight Tickets, Hotels, Holiday Packages for India &amp; International travel. Book cheap air tickets online for Domestic &amp; International airlines, customized Tour packages and special deals on Hotel Bookings.')
		@section("title", 'RapidexTravels - Travel Website 50% OFF on Holidays, Flights & Hotels')
	@endif

@section('content')

<!--holidays css-->
<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/holidays.css') }}" />

<!--Mobile-->
<style type="text/css">
/*mobile Section Pro-*/
.mpromotionBG {
	/*background-image: linear-gradient(to right, #0257ed, #012daa);*/
	background-image: url("public/uploads/promotion_img/goa-pic-2.jpg");
    background-color: #000;
    margin-top: 10px;
    /*background-attachment: fixed;*/
    background-repeat: no-repeat;
    background-size: cover;
    padding: 20px 0;
    background-position: top;
	}
/*mobile Section Pro-Goa*/
.mProBGGoa {
	/*background-image: linear-gradient(to right, #0257ed, #012daa);*/
	background-image: url("resources/assets/frontend/img/love-travel.jpg");
    background-color: #000;
    margin-top: 10px;
    background-repeat: no-repeat;
    background-size: cover;
    padding: 20px 0;
    background-position: top;
	}
</style>

<!--Desktop-->
<style type="text/css">
select {
	opacity: 0;
	}
/*Desktop Section Pro-Goa*/
#dpromotionBG.lazy {
   background-image: none;
   background-color: #F1F1FA;
}
#dpromotionBG {
	/*background-image: linear-gradient(to right, #0257ed, #012daa);*/
	background-image: url("public/uploads/promotion_img/goa-pic-2.jpg");
    margin-top: 0;
    background-attachment: fixed;
    background-repeat: no-repeat;
    padding: 40px 0;
    background-size: cover;
    background-position: top;
	}
/*Carousel*/
.carousel .slick-next:before {
    content: "";
    color: #130f26;
    font-size: 20px;
    background: url({{ url('/resources/assets/frontend/slider_nav_right.svg') }});
    width: 30px;
    height: 30px;
    display: block;
    position: absolute;
    right: -25px;
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
    top: 0px;
	}
.carousel .slick-prev:before {
    content: ""!important;
    color: #130f26!important;
    font-size: 20px!important;
    background: url({{ url('/resources/assets/frontend/slider_nav_left.svg') }});
    width: 30px;
    height: 30px;
    display: block;
    background-size: contain;
    background-repeat: no-repeat;
    left: -25px;
    position: absolute;
    top: 0px;
	}
</style>

<section>
<div class="mobile_test_exp">
	@include('home.mobile.mobileSearchPanel')
	@include('home.mobile.mobileSubscription')
	@include('home.mobile.mobileSectionGoa')
	@include('home.mobile.mobilePackages')
	@include('home.mobile.mobileSectionGoaPro')
	@include('home.mobile.mobileMidimage')
	@include('home.mobile.mobileTestimonials')
</div>

<div class="destop_test_exp">
	@include('home.desktop.desktopSearchPanel')
	@include('home.desktop.desktopPackages')
	@include('home.desktop.desktopSectionGoa')
	@include('home.desktop.desktopMidimage')
	@include('home.desktop.desktopTestimonials')
	<!--<div class="mid_img"></div>-->
</div>

<!--Load on Page Scroll Test Starts--
<!--Lazy-loading-content--
<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/lazy-loading-content.js") }}'></script>
<!--Load on Page Scroll Test Ends-->

<div class="testing">
	<input type="hidden" value="{{url('/')}}" name="" id="testvalue">
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>



<script>
	
 jQuery( function() {
    jQuery( "#datepicker" ).datepicker( { dateFormat: "d M y",

     })
  } );
 
//Mid-Image function load on scroll
 jQuery(document).scroll(function(){
 var height=window.pageYOffset;
 if(height>=2000)
 {
 var APP_URL=$("#APP_URL").val();
 var url=APP_URL+'/mid_image';

 var data={_token:"{{ csrf_token() }}"};
          $.get(url,data,function(rdata)
          {
          if(jQuery(".mid_img").is(':empty'))
          {
             jQuery(".mid_img").html("").html(rdata);        
          }
          })
 } 
})
//
if(jQuery(window).width()>=992) {
	jQuery(".mobile_test_exp").html("")
	}
	else {
		jQuery(".destop_test_exp").html("")
	}
//
$(document).ready(function() {

	jQuery('.select2').select2();
	//
	jQuery('.select3').select2({
		placeholder: "To",
		allowClear: true,
		ajax:{
			url: jQuery("#APP_URL").val()+'/search-destination',
			type: "get",
			dataType: 'json',
			delay: 250,
			data: function (params) {

				return {

					searchTerm: params.term //search term
					};
				},
				processResults: function (response) {

					return {
						results: response
						};
					},
					cache: true
			},
       
        templateSelection: formatSelection,

		});

	

    // Function to format the selected option
    function formatSelection(selection) {
        if (!selection.id) {
            return selection.text;
        }

        return $('<span>' + selection.id + '</span>');
    }

	//
	jQuery(document).on('change.select2','.package_service', function(e) {
		var data_value=jQuery(this).val();
		
	

		// jQuery("#destination_search").val(data_value);

		// jQuery("#response").html("");
		var APP_URL=$("#APP_URL").val();
		var url=APP_URL+'/search_theme';
		var data={search_theme:data_value,_token:"{{ csrf_token() }}"};
		$.get(url,data,function(rdata) {
			// console.log(rdata)
			$("#select_theme").html(rdata);
			})
		});
	})

$(".add_more_pkg").click(function (e) {
    var $this = $(this);
    var content_type=$(this).attr("content_type")
  
    if ($this.hasClass('clicked')){
        $this.removeClass('clicked'); 
       return add_packages(content_type)
        //here is your code for double click
    }else
     {
         $this.addClass('clicked');
         setTimeout(function() { 
             if ($this.hasClass('clicked')){
                 $this.removeClass('clicked'); 
                return add_packages(content_type)
                 //your code for single click               
             }
         }, 500);          
    }
});

function add_packages(content_type) {
	if(content_type=='demostic') {
		var custom_length=$(".custom_length_demostic").length;
		var id =$("input[name='pack_id_list_demostic[]']")
		.map(function(){return $(this).val();}).get();
		var dynamic_pkg_add="dynamic_pkg_add_domestic";
		var packages_button='demostic_button';
		}
	else if(content_type=='international') {
		var custom_length=$(".custom_length").length;
		var id =$("input[name='pack_id_list[]']")
		.map(function(){return $(this).val();}).get();
		var dynamic_pkg_add="dynamic_pkg_add";
		var packages_button='internation_button';
		}
	else if(content_type=='demostic_mobile') {
		var custom_length=$(".custom_length_demostic").length;
		var id =$("input[name='pack_id_list_demostic[]']")
		.map(function(){return $(this).val();}).get();
		var dynamic_pkg_add="dynamic_pkg_add_domestic";
		var packages_button='demostic_button';
		}
	else if(content_type=='international_mobile') {
		var custom_length=$(".custom_length").length;
		var id =$("input[name='pack_id_list[]']")
		.map(function(){return $(this).val();}).get();
		var dynamic_pkg_add="dynamic_pkg_add";
		var packages_button='internation_button';
		}
	//$(location).attr('href', ''+custom_length)row_add
	var APP_URL=$("#APP_URL").val();
	var url=APP_URL+'/add_package';
	var data={id:id,custom_length:custom_length,content_type:content_type,_token:"{{ csrf_token() }}"};
	$.post(url,data,function(rdata) {
		//console.log(rdata)
		if(rdata!="0" && rdata!="" && custom_length<"12") {
			$("."+packages_button).css("display","none")
			}
			$("#"+dynamic_pkg_add).append(rdata)
			})
	}
var slug = function(str) {
	str = str.replace(/^\s+|\s+$/g, ''); // trim
	str = str.toLowerCase();
	// remove accents, swap ñ for n, etc
	var from = "ãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;";
	var to   = "aaaaaeeeeeiiiiooooouuuunc------";
	for (var i=0, l=from.length ; i<l ; i++) {
		str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
		}
		str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
		.replace(/\s+/g, '-') // collapse whitespace and replace by -
		.replace(/-+/g, '-'); // collapse dashes
		return str;
	};

 $("#search_mobile").submit(function(){
	  var destination_search=slug($(".destination_search_mobile").val());
	  document.search_mobile.action = 'Holidays/'+destination_search+'-tour-packages'
	  })
  $("#search2").submit(function() {
	  var destination_search=slug($("#destination_search").val());
	  if(jQuery(window).width()>=992) {
		  var select_theme=slug($("#select_theme").val());
		  if(destination_search!="" && select_theme=="") {
		  	document.search2.action = 'Holidays/'+destination_search+'-tour-packages'
			  // $(location).attr('href', 'Holidays/'+destination_search+'-tour-packages')
			  }
			else {
				document.search2.action = 'Holidays/'+destination_search+'/Theme/'+select_theme
				// $(location).attr('href', 'Holidays/'+destination_search+'/Theme/'+select_theme)
				}
			}
			else {
				if(destination_search!="") {
					document.search2.action = 'Holidays/'+destination_search+'-tour-packages'
					// $(location).attr('href', 'Holidays/'+destination_search+'-tour-packages')
					}
				}
	})
if($(document).width()<"768") {
	$(".card a").click(function() {
		var attr=$(this).attr("href")
		var attr_height=$(attr).height()-70;
		$(".hadding").css("padding-top",attr_height+"px")
		})
	}



</script>
</section>
@endsection
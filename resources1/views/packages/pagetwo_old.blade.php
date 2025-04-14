@extends('layouts.front.master')
@if(count($data1)=="0")
	@if(env("WEBSITENAME")==1)
		@section('keywords','The world Gateway, Holiday Packages, Hotel Booking, Flight Booking, Tour Activities, Car Rental, Visa Assistance, Forex Exchange, Travel Insurances')
		@section('desc','The world Gateway, Holiday Packages, Hotel Booking, Flight Booking, Tour Activities, Car Rental, Visa Assistance, Forex Exchange, Travel Insurances')
		@section("title", 'The World Gateway')
		@elseif(env("WEBSITENAME")==0)
		@section('keywords','RapidexTravels, Holiday Packages, Hotel Booking, Flight Booking, Tour Activities, Car Rental, Visa Assistance, Forex Exchange, Travel Insurances')
		@section('desc','RapidexTravels Holiday Packages, Hotel Booking, Flight Booking, Tour Activities, Car Rental, Visa Assistance, Forex Exchange, Travel Insurances')
		@section("title", 'RapidexTravels')
	@endif
@else
	@foreach($data1 as $seo)
		@section('keywords',$seo->keywords)
		@section('desc',$seo->description)
		@section("title", $seo->title)
	@endforeach
@endif

@section('custom_second_page_js')
<!-- <script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/jquery.noconflict.js") }}'></script> -->
<!--second page (load content on scroll)-->
<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/jquery-ui.1.10.4.min.js") }}'></script>
@endsection

@section('content')
<?php 
use App\Icons;
use App\Gtags;
use App\Suitable;
$icons    =Icons::all();
$generals    =Gtags::all();
$suitables    =Suitable::all();

?>
<!--pagetwo css-->
<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/pagetwo.css') }}" />

<div id="overlay"></div>
<div class="destop_test_exp">
	@include('packages.secondpage.desktop.dModifyPanel')
	@include('packages.secondpage.desktop.dTourName')
	@include('packages.secondpage.desktop.dFilterSorting')
	@include('packages.secondpage.desktop.dTourItemCard')
</div>

<div class="mobile_test_exp">
	<div class="mBG">
	@include('packages.secondpage.mobile.mSorting')
	@include('packages.secondpage.mobile.mtourItemCard')
	</div>
</div>
<!--Mobile Filter starts-->
@include('packages.secondpage.mobile.mfilter')
<!--Mobile ends-->
<div class="testing">
	<input type="hidden" value="{{url('/')}}" name="" id="testvalue">
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
	 jQuery( function() {
    jQuery( "#datepicker" ).datepicker( { dateFormat: "d M y",

     })
  } );

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
			}
		});
	//
	jQuery(document).on('change.select2','.package_service', function(e) {
		var data_value=jQuery(this).val();
		$("#destination_search").val(data_value);
		$("#response").html("");
		var APP_URL=$("#APP_URL").val();
		var url=APP_URL+'/search_theme';
		var data={search_theme:data_value,_token:"{{ csrf_token() }}"};
		$.post(url,data,function(rdata) {
			console.log(rdata)
			$("#select_theme").html(rdata);
			})
		});
	})
$(document).ready(function() {
	//Desktop & Mobile View
	if($(window).width()>=992) {
		$(".mobile_test_exp").each(function( index ) {
			$(this).remove()
			});
		}
	else {
		$(".destop_test_exp").each(function( index ) {
			$(this).remove()
			});
		}
	
	//Old Modify button for search panel
	$("#modify").show();
	$("#modify_search").click(function(){
		$("#modify").toggle();
		})
	
	//
	$(".mobile_filter").click(function() {
		$(".sorting_content").toggle();
		})
	})
		
	// Close the dropdown menu if the user clicks outside of it
	window.onclick = function(event) {
if (!event.target.matches('.dropbtn1')) {
var dropdowns = document.getElementsByClassName("dropdown1");
var i;
for (i = 0; i < dropdowns.length; i++) {
var openDropdown = dropdowns[i];
if (openDropdown.classList.contains('show')) {
openDropdown.classList.remove('show');
}
}
}
if (!event.target.matches('.dropbtn2')) {
var dropdowns = document.getElementsByClassName("dropdown2");
var i;
for (i = 0; i < dropdowns.length; i++) {
var openDropdown = dropdowns[i];
if (openDropdown.classList.contains('show')) {
openDropdown.classList.remove('show');
}
}
}
if (!event.target.matches('.dropbtn3')) {
var dropdowns = document.getElementsByClassName("dropdown3");
var i;
for (i = 0; i < dropdowns.length; i++) {
var openDropdown = dropdowns[i];
if (openDropdown.classList.contains('show')) {
openDropdown.classList.remove('show');
}
}
}
if (!event.target.matches('.dropbtn4')) {
var dropdowns = document.getElementsByClassName("dropdown4");
var i;
for (i = 0; i < dropdowns.length; i++) {
var openDropdown = dropdowns[i];
if (openDropdown.classList.contains('show')) {
openDropdown.classList.remove('show');
}
}
}
if (!event.target.matches('.dropbtn5')) {
var dropdowns = document.getElementsByClassName("dropdown5");
var i;
for (i = 0; i < dropdowns.length; i++) {
var openDropdown = dropdowns[i];
if (openDropdown.classList.contains('show')) {
openDropdown.classList.remove('show');
}
}
}
if (!event.target.matches('.dropbtn6')) {
var dropdowns = document.getElementsByClassName("dropdown6");
var i;
for (i = 0; i < dropdowns.length; i++) {
var openDropdown = dropdowns[i];
if (openDropdown.classList.contains('show')) {
openDropdown.classList.remove('show');
}
}
}
//
if (!event.target.matches('.dropbtn_1')) {
var dropdowns = document.getElementsByClassName("dropdown_1");
var i;
for (i = 0; i < dropdowns.length; i++) {
var openDropdown = dropdowns[i];
if (openDropdown.classList.contains('show')) {
openDropdown.classList.remove('show');
}
}
}
//
if (!event.target.matches('.dropbtn_2')) {
var dropdowns = document.getElementsByClassName("dropdown_2");
var i;
for (i = 0; i < dropdowns.length; i++) {
var openDropdown = dropdowns[i];
if (openDropdown.classList.contains('show')) {
openDropdown.classList.remove('show');
}
}
}
//
if (!event.target.matches('.dropbtn_3')) {
var dropdowns = document.getElementsByClassName("dropdown_3");
var i;
for (i = 0; i < dropdowns.length; i++) {
var openDropdown = dropdowns[i];
if (openDropdown.classList.contains('show')) {
openDropdown.classList.remove('show');
}
}
}
//
}
		
//chk_value
$(".sort_filter").change(function(){
	return drop_function();
	})
$("#sort_filter").change(function(){
	return drop_function();
	})
//
$(document).on('click', '.dropdown-content .drop ', function(e){
	e.stopPropagation();
	})

$(document).on('click', '.btnFilterApply', function(){
	return drop_function();
	})
$(document).on('change', '.dropCheckBox', function(e){
	e.stopPropagation();
	return drop_function();
	})

	if($(window).width()>=992) {
$(document).on('click', '.dropdown-content .drop ', function(e){
e.stopPropagation();
return drop_function();
})
}
else {
$(document).on("click",".mobile_apply",function(e){
e.stopPropagation();

return drop_function();

})
}
function drop_function(){
$("#refine_search").html("").html("<a href='' id='reset' style='color: #008cff'>Clear filter</a>")
$("#refine_mobsearch").html("").html("<a href='' id='mobreset' style='color: #008cff;'>Reset</a>")
var destination=$("#destination").val();
var places=[];
$('input[name="chk_value"]:checked').each(function() {
places.push($(this).val());
});
var duration=new Array();
$('input[name="duration"]:checked').each(function() {
duration.push($(this).val());
});
var travel_type=new Array();
$('input[name="chk_travel"]:checked').each(function() {
travel_type.push($(this).val());
});
var theme_type=new Array();
$('input[name="chk_more"]:checked').each(function() {
theme_type.push($(this).val());
});
var guest_rating=new Array();
$('input[name="chk_gest"]:checked').each(function() {
guest_rating.push($(this).val());
});
//
var services_includes=new Array();
$('input[name="services_includes"]:checked').each(function() {
services_includes.push($(this).val());
});
//
var sut_for=new Array();
$('input[name="sut_for"]:checked').each(function() {
sut_for.push($(this).val());
});
//
var gen_tags=new Array();
$('input[name="gen_tags"]:checked').each(function() {
gen_tags.push($(this).val());
});
//
var search_date=$("#search_date").val()

//
var window_width= $(window).width();
var sort_filter=$("#sort_filter").val()
var min_price=$(".min-price-label").html();
var max_price=$(".max-price-label").html();
var APP_URL=$("#testvalue").val();
var url=APP_URL+'/mid_package_data';
var packages_id =$("input[name='pack_id_list[]']")
.map(function(){return $(this).val();}).get();
var limit="3"; 
var event_type="0";             
var img_href=APP_URL+'/public/uploads/loder.gif';
$(".dynamic_data").html("").append("<span style='margin-left: 40%;text-align: center;color: #008cff;font-weight: bold;font-size: 20px;padding 10px 20px;background-color: #ffffff;border-radius: 5px;'>Loading packages... <img style='width: 50px;height: 50px' src='"+img_href+"'>")

document.getElementById("overlay").style.display = "none";
var data={window_width:window_width,event_type:event_type,limit:limit,packages_id:packages_id,destination:destination, places:places,duration:duration,travel_type:travel_type,theme_type:theme_type,guest_rating:guest_rating,min_price:min_price,max_price:max_price,services_includes:services_includes,sut_for:sut_for,gen_tags:gen_tags,search_date:search_date,sort_filter:sort_filter,_token:"{{ csrf_token() }}"};
$.get(url,data,function(rdata) {
$(".dynamic_data").html("").html(rdata)
document.getElementById("overlay").style.display = "none";
//console.log(rdata)
//alert(places)
//$("#select_theme").html(rdata);
})
};

	/* When the user clicks on the button,toggle between hiding and showing the dropdown content */
function myFunction() {
document.getElementById("myDropdown").classList.toggle("show");
}
//travel type
/* When the user clicks on the button,toggle between hiding and showing the dropdown content */
function travel_type() {
document.getElementById("travel_type").classList.toggle("show");
}
//more 
function more() {
document.getElementById("more").classList.toggle("show");
}
//guest_rate
function guest_rate() {
document.getElementById("guest_rate").classList.toggle("show");
}
//duration
function duration() {
document.getElementById("duration").classList.toggle("show");
}
//price
function price() {
document.getElementById("price").classList.toggle("show");
}
//service_included 
function service_included() {
document.getElementById("service_included").classList.toggle("show");
}
//sutible_for 
function sutible_for() {
document.getElementById("sutible_for").classList.toggle("show");
}
//general_tags 
function general_tags() {
document.getElementById("general_tags").classList.toggle("show");
}
		
		//
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


	$("#search3").submit(function(){

var destination_search=slug($("#destination_search").val());
var select_theme=slug($("#select_theme").val());

var APP_URL=$("#testvalue").val();

if(destination_search!="" && select_theme=="") {
//$(APP_URL).attr('href', ''+destination_search)
document.search3.action = APP_URL+'/Holidays'+"/"+destination_search+'-tour-packages';
// window.location.href = APP_URL+'/Holidays'+"/"+destination_search+'-tour-packages';
}
else {
//$(location).attr('href', 'Packages/'+destination_search+'/Theme/'+select_theme)
document.search3.action = APP_URL+'/Holidays'+"/"+destination_search+"/Theme"+"/"+select_theme;
// window.location.href = APP_URL+'/Holidays'+"/"+destination_search+"/Theme"+"/"+select_theme;
}
})
		
	window.onbeforeunload = function () {
		window.scrollTo(0, 0);
		}
		
	$(document).ready(function() {
		$(".dropdown").click(function(){
			$(".caret").css({"color": "#333"})
			$(this).children().first().children().css({"color": "#b51319"});
			})
		})

	//
	jQuery(document).scroll(function() {
		var height=window.pageYOffset;
		var window_height=jQuery(window).height();
		var position = jQuery(window).scrollTop();
		var action="active";
		var bottom = jQuery(document).height() - jQuery(window).height() -$("footer").height();
	
		//
		function Utils() {
			
		}

		Utils.prototype = {
			constructor: Utils,
			isElementInView: function (element, fullyInView) {
				var pageTop = $(window).scrollTop();
				var pageBottom = pageTop + $(window).height();
				var elementTop = $(element).offset().top;
				var elementBottom = elementTop + $(element).height();
				if (fullyInView === true) {
					return ((pageTop < elementTop) && (pageBottom > elementBottom));
					}
				else {
					return ((elementTop <= pageBottom) && (elementBottom >= pageTop));
					}
				}
			};
			
		var Utils = new Utils();
		var isElementInView = Utils.isElementInView($('footer'), false);
		clearTimeout( $.data(this, "scrollCheck" ) );
		
		$.data( this, "scrollCheck", setTimeout(function() {
if (isElementInView) {
var APP_URL=$("#testvalue").val();
var loader_src= APP_URL+'/public/uploads/loder.gif';
if($(".loader_scroll").is(':empty')) {
$(".loader_scroll").html("").html("<span style='color: #008cff;font-weight: bold;font-size: 20px;padding 10px 20px;background-color: white;border-radius: 5px;'>Loading more packages... <img style='width: 50px;height: 50px' src='"+loader_src+"'>")
}
var destination=$("#destination").val();
var action="inactive";
var places=[];
$('input[name="chk_value"]:checked').each(function() {
places.push($(this).val());
});
var duration=new Array();
$('input[name="duration"]:checked').each(function() {
duration.push($(this).val());
});
var travel_type=new Array();
$('input[name="chk_travel"]:checked').each(function() {
travel_type.push($(this).val());
});
var theme_type=new Array();
$('input[name="chk_more"]:checked').each(function() {
theme_type.push($(this).val());
});
var guest_rating=new Array();
$('input[name="chk_gest"]:checked').each(function() {
guest_rating.push($(this).val());
});
//
var services_includes=new Array();
$('input[name="services_includes"]:checked').each(function() {
services_includes.push($(this).val());
});
//
var sut_for=new Array();
$('input[name="sut_for"]:checked').each(function() {
sut_for.push($(this).val());
});
//
var gen_tags=new Array();
$('input[name="gen_tags"]:checked').each(function() {
gen_tags.push($(this).val());
});
//

var search_date=$("#datepicker").val()

 var window_width= $(window).width();
var sort_filter=$("#sort_filter").val()
var min_price=$(".min-price-label").html();
var max_price=$(".max-price-label").html();
var APP_URL=$("#testvalue").val();
var url=APP_URL+'/mid_package_data';
var packages_id =$("input[name='pack_id_list[]']")
.map(function(){return $(this).val();}).get();
var limit="3";
var event_type="1";
var data={window_width:window_width,event_type:event_type,limit:limit,packages_id:packages_id,destination:destination, places:places,duration:duration,travel_type:travel_type,theme_type:theme_type,guest_rating:guest_rating,min_price:min_price,max_price:max_price,services_includes:services_includes,sut_for:sut_for,gen_tags:gen_tags,search_date:search_date,sort_filter:sort_filter,_token:"{{ csrf_token() }}"};
$.get(url,data,function(rdata) {
if(rdata!="<br>") {
$(".loader_scroll").html("")
$(".dynamic_data").append(rdata)
}
else {
$(".loader_scroll").html("").html("<p style='text-align:center;font-size: 20px;'>That's all the option that we have</p>")
}
})
}
}, 350))
		})
</script>
@endsection
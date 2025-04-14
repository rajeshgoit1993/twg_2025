@extends('layouts.front.master')
@if(env("WEBSITENAME")==1)
@section('keywords','The world Gateway, Holiday Packages, Hotel Booking, Flight Booking, Tour Activities, Car Rental, Visa Assistance, Forex Exchange, Travel Insurances')
@section('desc','The world Gateway, Holiday Packages, Hotel Booking, Flight Booking, Tour Activities, Car Rental, Visa Assistance, Forex Exchange, Travel Insurances')
@section("title", 'The World Gateway')
@elseif(env("WEBSITENAME")==0)
@section('keywords','RapidexTravels, Holiday Packages, Hotel Booking, Flight Booking, Tour Activities, Car Rental, Visa Assistance, Forex Exchange, Travel Insurances')
@section('desc','RapidexTravels Holiday Packages, Hotel Booking, Flight Booking, Tour Activities, Car Rental, Visa Assistance, Forex Exchange, Travel Insurances')
@section("title", 'RapidexTravels')
@endif
@section('content')

@include("query.quotation_webpage.commonstyle")
<div class="destop_test_exp">
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="tourQuoteRefCont">
				<h3 style="">Reference ID #{{ $data1->quo_ref }}</h3>
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#menu3">Tour Quote</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div>
		<div class="row">
			<div class="col-md-12">
				<div class="tab-content">
					<div id="menu3" class="tab-pane fade in active">
					@include("query.quotation_webpage.desktop.quote1-desktop")
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<div class="mobile_test_exp">
<div class="mBGF9 paddingTop3">
	<div class="mtourQuoteRefCont">
		<h3 class="mtourQuoteRefHeading">Reference ID #{{ $data1->quo_ref }}</h3>
	</div>
	<div class="mtourQuoteTabCont">
		<ul class="flexCenter">
			<li class="active"><a data-toggle="tab" href="#menu33">Tour Quote</a></li>
		</ul>
	</div>
	<div class="tab-content">
		<div id="menu33" class="tab-pane fade in active">
			@include("query.quotation_webpage.mobile.quote1-mobile")
		</div>
	</div>
</div>
</div>
@endsection
@section("custom_js")
<!--foldable button script-->
<script type="text/javascript">
var fold = document.getElementsByClassName("foldable");
var i;

for (i = 0; i < fold.length; i++) {
	fold[i].addEventListener("click", function() {
		this.classList.toggle("active");
		var content = this.nextElementSibling;
		if (content.style.maxHeight){
			content.style.maxHeight = null;
			}
		else {
			content.style.maxHeight = content.scrollHeight + "px";
			}
		});
	}
</script>
<script type="text/javascript">
//
$(document).ready(function(){

// $(".quote_no").prop( "disabled", true );
$(".quote_no").attr("disabled",true);

$(document).on("click",".pay_now",function(){

var quote_no=$(this).siblings(".quote_no").val();
var token =  jQuery('input[name="_token"]').val()

var content_action=jQuery(this).attr("content_action");
var form = document.createElement("form");
form.setAttribute("method", "post");
form.setAttribute("action", content_action);
form.setAttribute("target", "");
var hiddenField = document.createElement("input");
hiddenField.setAttribute("type", "hidden");
hiddenField.setAttribute("name", "_token");
hiddenField.setAttribute("value", token);
form.appendChild(hiddenField);
var second_field = document.createElement("input");
second_field.setAttribute("type", "hidden");
second_field.setAttribute("name", "quote_no");
second_field.setAttribute("value", quote_no);
form.appendChild(second_field);
document.body.appendChild(form);
//window.open('', 'view');
//window.open('','view' );
form.submit();

})
})

	//
if(jQuery(window).width()>=992) {
	jQuery(".mobile_test_exp").html("")
	}
	else {
		jQuery(".destop_test_exp").html("")
		}
		
jQuery(document).ready(function(){
jQuery(document).on("click",".user_quote_accept",function(e){
e.preventDefault()
var token =  jQuery('input[name="_token"]').val()
var content_id=jQuery(this).attr("content_id");
var content_action=jQuery(this).attr("content_action");
var form = document.createElement("form");
form.setAttribute("method", "post");
form.setAttribute("action", content_action);
form.setAttribute("target", "");
var hiddenField = document.createElement("input");
hiddenField.setAttribute("type", "hidden");
hiddenField.setAttribute("name", "_token");
hiddenField.setAttribute("value", token);
form.appendChild(hiddenField);
var second_field = document.createElement("input");
second_field.setAttribute("type", "hidden");
second_field.setAttribute("name", "quote_id");
second_field.setAttribute("value", content_id);
form.appendChild(second_field);
document.body.appendChild(form);
//window.open('', 'view');
//window.open('','view' );
form.submit();
})
})
</script>
@endsection
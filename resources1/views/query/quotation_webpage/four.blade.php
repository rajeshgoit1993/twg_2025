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

<style type="text/css">
.pfwmt {
	font-weight: 600;
	margin: 0px;
	text-align: left;
	}
.makeflex {
	display: flex;
	}
.flex110 {
	flex-grow: 1;
    flex-shrink: 1;
    flex-basis: 0%;
	}
.flexcenter {
	display: flex;
	align-items: center;
	}
.flexcenter > li.active, .flexcenter > li.active >a:focus, .flexcenter > li.active > a:hover {
	color: #008cff !important;
	border-bottom-color:#008cff !important;
	}
.flexcenter > li > a.hover {
	color: #008cff !important;
	padding-bottom: 15px;
	border-bottom:2px solid #008cff !important;
	}
.flex-column {
	display: flex;
	flex-direction: column;
	}
.priceitemlist {
	font-size: 15px;
	font-weight: 600;
	margin: 0px;
	color: #000001;
	}
.content {
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.2s ease-out;
  }
 .content > ul {
  margin-left: 5px;
  padding-left: 15px;
  }
 .content > ul > li {
  list-style-type: disc;	
  }
</style>

@include("query.quotation_webpage.commonstyle")

<section style="background-color: #F9F9F9">
	<div class="destop_test_exp">
		<div style="padding-top: 10px;margin: 0px 4%;">
			<div class="quotation_red" style="background-color: #fff;border: 1px solid #CED0D4;border-bottom: none;border-radius: 10px 10px 0px 0px;padding: 20px 0px 0px 25px;margin: 0px">
				<h3 style="font-size: 20px;line-height: 20px;color: #4A4A4A;font-weight: 600;margin-bottom: 45px">Reference ID #{{ $data1->quo_ref }}</h3>
				<ul class="flexcenter">
					<li style="padding-bottom: 15px;font-size: 18px;font-weight: 600;color: #CED0D4;border-bottom: 2px solid #CED0D4;margin-right: 2%"><a data-toggle="tab" href="#menu3">Quote 1</a></li>
					<li style="padding-bottom: 15px;font-size: 18px;font-weight: 600;color: #CED0D4;border-bottom: 2px solid #CED0D4;margin-right: 2%"><a data-toggle="tab" href="#menu2">Quote 2</a></li>
					<li style="padding-bottom: 15px;font-size: 18px;font-weight: 600;color: #CED0D4;border-bottom: 2px solid #CED0D4;margin-right: 2%"><a data-toggle="tab" href="#menu1">Quote 3</a></li>
					<li class="active" style="padding-bottom: 15px;font-size: 18px;font-weight: 600;color: #CED0D4;border-bottom: 2px solid #CED0D4"><a data-toggle="tab" href="#home">Quote 4</a></li>
				</ul>
			</div>
		</div>
		<div style="margin: 0px 4%;">
			<div class="" style="padding: 0px;">
				<div class="tab-content">
					<div id="home" class="tab-pane fade in active" style="padding: 0px;">
						@include("query.quotation_webpage.desktop.quote4-desktop")
					</div>
					<div id="menu1" class="tab-pane fade" style="padding: 0px;">
						@include("query.quotation_webpage.desktop.quote3-desktop")
					</div>
					<div id="menu2" class="tab-pane fade" style="padding: 0px;">
						@include("query.quotation_webpage.desktop.quote2-desktop")
					</div>
					<div id="menu3" class="tab-pane fade" style="padding: 0px;">
						@include("query.quotation_webpage.desktop.quote1-desktop")
					</div>
				</div>
			</div>
		</div>		
	</div>
	<div class="mobile_test_exp">
		<div style="padding-top: 3px;margin: 0px 0%;">
			<div class="" style="background-color: #fff;border-bottom: 1px solid #CED0D4;padding: 15px 0px 15px 25px;margin: 0px">
				<h3 class="pfwmt" style="font-size: 20px;line-height: 20px;color: #4A4A4A;">Reference ID #{{ $data1->quo_ref }}</h3>
			</div>
			<div class="" style="background-color: #fff;border-bottom: 1px solid #CED0D4;padding: 20px 0px 0px 25px;margin: 0px">
				<ul class="flexcenter">
					<li style="padding-bottom: 15px;font-size: 18px;font-weight: 600;color: #CED0D4;border-bottom: 2px solid #CED0D4;margin-right: 25px"><a data-toggle="tab" href="#menu3">Quote 1</a></li>
					<li style="padding-bottom: 15px;font-size: 18px;font-weight: 600;color: #CED0D4;border-bottom: 2px solid #CED0D4;margin-right: 25px"><a data-toggle="tab" href="#menu2">Quote 2</a></li>
					<li style="padding-bottom: 15px;font-size: 18px;font-weight: 600;color: #CED0D4;border-bottom: 2px solid #CED0D4;margin-right: 25px"><a data-toggle="tab" href="#menu1">Quote 3</a></li>
					<li class="active" style="padding-bottom: 15px;font-size: 18px;font-weight: 600;color: #CED0D4;border-bottom: 2px solid #CED0D4"><a data-toggle="tab" href="#home">Quote 4</a></li>
				</ul>
			</div>
		</div>
		<div style="margin: 0px 0%;">
			<div class="" style="padding: 0px;">
				<div class="tab-content">
					<div id="home" class="tab-pane fade in active" style="padding: 0px;">
						@include("query.quotation_webpage.mobile.quote4-mobile")
					</div>
					<div id="menu1" class="tab-pane fade" style="padding: 0px;">
						@include("query.quotation_webpage.mobile.quote3-mobile")
					</div>
					<div id="menu2" class="tab-pane fade" style="padding: 0px;">
						@include("query.quotation_webpage.mobile.quote2-mobile")
					</div>
					<div id="menu3" class="tab-pane fade" style="padding: 0px;">
						@include("query.quotation_webpage.mobile.quote1-mobile")
					</div>
				</div>
			</div>
		</div>		
	</div>
</section>
@endsection

@section("custom_js")
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery(document).on("click",".user_quote_accept",function(e) {
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
		//window.open('','view');
		form.submit();
		})
	})
</script>

<!--collapsible button script-->
<script type="text/javascript">
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
	coll[i].addEventListener("click", function() {
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

@endsection
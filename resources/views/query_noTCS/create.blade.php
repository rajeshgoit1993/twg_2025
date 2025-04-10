@extends('layouts.master')
@section('content')
<style type="text/css">
.panel-default>.panel-heading {
color: #333;
background-color: #fff;
border-color: #e4e5e7;
padding: 0;
-webkit-user-select: none;
-moz-user-select: none;
-ms-user-select: none;
user-select: none;
}
.panel-default>.panel-heading a {
display: block;
padding: 10px 15px;
}
.panel-default>.panel-heading a:after {
content: "";
position: relative;
top: 1px;
display: inline-block;
font-family: 'Glyphicons Halflings';
font-style: normal;
font-weight: 400;
line-height: 1;
-webkit-font-smoothing: antialiased;
-moz-osx-font-smoothing: grayscale;
float: right;
transition: transform .25s linear;
-webkit-transition: -webkit-transform .25s linear;
}
.panel-default>.panel-heading a[aria-expanded="true"] {
background-color: #eee;
}
.panel-default>.panel-heading a[aria-expanded="true"]:after {
content: "\2212";
-webkit-transform: rotate(180deg);
transform: rotate(180deg);
}
.panel-default>.panel-heading a[aria-expanded="false"]:after {
content: "\002b";
-webkit-transform: rotate(90deg);
transform: rotate(90deg);
}
.accordion-option {
width: 100%;
float: left;
clear: both;
margin: 15px 0;
}
.accordion-option .title {
font-size: 20px;
font-weight: bold;
float: left;
padding: 0;
margin: 0;
}
.accordion-option .toggle-accordion {
float: right;
font-size: 16px;
color: #6a6c6f;
}
.dayItinerary{
border-bottom: 1px solid darkgray;
margin-bottom: 14px;
border-radius: 23px;
}
span.select2.select2-container {
width: 100% !important;
}
.flight
{
display: none;
}
.nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover
{
background: #08b2ed;
border:1px solid #08b2ed;
color: #fff
}
</style>
<!--New Tour Pricing CSS-->
<style>
label {
	display: inline-block;
	max-width: 100%;
	margin-bottom: 5px;
	font-weight: 700;
	color: #4a4a4a;
	}
.backgroundColorF2 {
	background-color: #f2f2f2;
	}
.backgroundColorF9F {
	background-color: #F9F9F9;
	}
.textCenter {
	text-align: center;
	}
.height80 {
	height: 80px
	}
.itemTopHeading {
	font-size: 13px;
	line-height: 13px;
	color: #4a4a4a;
	font-weight: 600;
	text-align: center;
	margin-bottom: 1px;
	}
.itemTopSubHeading {
	font-size: 12px;
	line-height: 12px;
	color: #4a4a4a;
	font-weight: 600;
	text-align: center;
	margin-bottom: 0px;
	}
.roomGuests, .addRooms {
	display: flex;
	align-items: center;
	justify-content: space-between;
	margin-bottom: 0px;
	}
.roomGuests {
	padding: 20px 20px 0px;
	}
.roomGuests label, .roomGuests select, .roomGuests input[type=text], .addRooms input[type=text] {
	font-size: 14px;
	line-height: 14px;
	color: #4a4a4a;
	padding: 6px 0px;
	min-width: 75px;
	height: 34px;
	}
.roomGuests input[type=text], .addRooms input[type=text] {
	width: 250px !important;
	background: #f9f9f9;
	}
.roomGuests select, .roomGuests input[type=text], .addRooms input[type=text] {
	border: 1px solid #CED0D4;
	border-radius: 3px;
	padding: 6px 12px;
	height: 34px;
	width: 130px;
	}
.modalBody {
	position: relative;
	padding: 20px;
	font-size: 14px;
	line-height: 14px;
	}
.totalDisplay, .grossTotalDisplay, .grossGroupTotalDisplay, .discountGroupTotalDisplay, .gstGroupTotalDisplay, .gstTotalDisplay, .tcsGroupTotalDisplay, .tcsTotalDisplay, .pgGrouptTotalDisplay, .grandGroupTotal {
	/*display: block;*/
	}
.btnGreen, .btnBack {
	display: inline-block;
	padding: 6px 12px;
	font-size: 14px;
	line-height: 20px;
	color: #fff;
	text-align: center;
	vertical-align: middle;
	cursor: pointer;
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	border: none;
	border-radius: 4px;
	background-color: #00a65a;
	border-color: #00a65a;
	}
.quoteCurrency {
	font-size: 20px;
	line-height: 20px;
	color: #4a4a4a;
	background: #f9f9f9;
	border: 1px solid #ccc;
	border-radius: 3px;
	padding: 15px 10px;
	text-align: center;
	margin-bottom: 3px;
	}
.itemBottomHeading {
	font-size: 12px;
	line-height: 12px;
	color: #4a4a4a;
	background: #f2f2f2;
	border-radius: 3px;
	padding: 6px 3px;
	text-align: center;
	margin-top: 5px;
	margin-bottom: 10px;
	}
.backend_custom_height select {
	height: 25px;
	padding: 0px;
	width: 100%;
	}
.currencyConversion {
	display: flex;
	}
.currencyConversion input[type=text], .currencyConversion select {
	width: 100%;
	color: #4a4a4a;
	font-size: 13px;
	line-height: 13px;
	border: 1px solid #ccc;
	border-radius: 3px;
	padding: 2px 5px;
	font-weight: 500;
	height: 25px;
	}
.currencyBox {
	font-size: 14px;
	line-height: 14px;
	font-weight: 600;
	margin: 0px;
	text-align: center;
	padding: 5px;
	color: #4a4a4a;
	border: 1px solid #ccc;
	border-radius: 3px;
	height: 25px;
	}
.travellersMinus {
	font-size: 26px;
	line-height: 5px;
	color: #9B9B9B;
	padding: 12px;
	font-weight: 900;
	cursor: pointer
	}
.travellersValue {
	font-size: 20px;
	line-height: 20px;
	/*color: #01b7f2;*/
	color: #008cff;
	font-weight: 900;
	padding: 12px
	}
.travellersPlus {
	font-size: 26px;
	line-height: 5px;
	color: #9B9B9B;
	padding: 12px;
	font-weight: 900;
	cursor: pointer
	}
.addTravellerValue {
	display: flex;
	align-items: center;
	justify-content: center;
	}
.tourPriceItem {
	font-weight: 600;
	font-size: 13px;
	line-height: 18px;
	}
.fixedValue, .percentageValue {
	padding: 2px;
	color: #4a4a4a;
	font-size: 14px;
	line-height: 14px;
	font-weight: 500;
	margin: 0px;
	text-align: left;
	color: #4a4a4a;
	border: 1px solid #ccc;
	border-radius: 3px;
	height: 25px;
	}
.pricetoPay {
	font-weight: 600;
	}
.anyError {
	color: red;
	}
</style>
<div class="content-wrapper">
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Create Quote</h3>
				</div>
				<div class="box-body">
					<div class="add">
						<a href="{{URL::to('/query')}}" class="btn btn-success"><i class="glyphicon glyphicon-arrow-left"></i> Back</a>
					</div>
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#option1">Quote 1</a></li>
					</ul>
					<br>
					<div class="tab-content">
						@include('query.quotation.option1')
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
</div>
<div class="testing">
<input type="hidden" value="{{url('/')}}" name="" id="test">
</div>
<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src='{{ url("resources/assets/js/packages/quote1.js") }}'></script>
<script type="text/javascript">
//
$(".payment_days").change(function(){
	var days=$(this).val()
	var date = new Date();
	date.setDate(date.getDate() + parseInt(days));
	var dd = date.getDate();
	var mm = date.getMonth() + 1;
	var y = date.getFullYear();
	var someFormattedDate =  dd+ '/' + mm + '/' + y;
	$(this).parent().siblings('.payment_date_parent').children('.payment_date').datepicker({dateFormat:"dd/mm/yy"}).datepicker("setDate",someFormattedDate);
	})


$(document).on("change",".adayplus", function(){
	alert('Kindly check duration')
	})
//
$(document).on("change",".dhours , .dmins, .ahours, .amins", function(){
	var dhours=$(".dhours").val()
	var dmins=$(".dmins").val()
	var ahours=$(".ahours").val()
	var amins=$(".amins").val()
	var adayplus=$(".adayplus").val()
	var departure_in_min=parseInt(dhours)*60+parseInt(dmins)
	var arrival_in_min=parseInt(ahours)*60+parseInt(amins)
	if(arrival_in_min<=departure_in_min)
	{
	var arrival_in_min=parseInt(arrival_in_min)+parseInt(24)*60
	$('.adayplus').val('').val(1);
	}
	else
	{
	$('.adayplus').val('').val(0);
	}
	var duration_in_min=parseInt(arrival_in_min)-parseInt(departure_in_min)
	var hours = Math.floor(duration_in_min / 60);
	var minutes = duration_in_min % 60;
	var duration_min=parseInt(amins)-parseInt(dmins)
	$('.duration_hours').val('').val(hours);
	$('.duration_min').val('').val(minutes);
	})
//return flight
$(document).on("change",".dadayplus", function(){
	alert('Kindly check duration')
	})
//
$(document).on("change",".ddhours , .ddmins, .dahours, .damins", function(){
	var dhours=$(".ddhours").val()
	var dmins=$(".ddmins").val()
	var ahours=$(".dahours").val()
	var amins=$(".damins").val()
	var adayplus=$(".dadayplus").val()
	var departure_in_min=parseInt(dhours)*60+parseInt(dmins)
	var arrival_in_min=parseInt(ahours)*60+parseInt(amins)
	if(arrival_in_min<=departure_in_min)
	{
	var arrival_in_min=parseInt(arrival_in_min)+parseInt(24)*60
	$('.dadayplus').val('').val(1);
	}
	else
	{
	$('.dadayplus').val('').val(0);
	}
	var duration_in_min=parseInt(arrival_in_min)-parseInt(departure_in_min)
	var hours = Math.floor(duration_in_min / 60);
	var minutes = duration_in_min % 60;
	var duration_min=parseInt(amins)-parseInt(dmins)
	$('.return_duration_hours').val('').val(hours);
	$('.return_duration_min').val('').val(minutes);
	})
	//
$(document).on("change",".flight_name",function(){
	var flight_name=$(this).val()
	$(".down_filght").val('').val(flight_name)
	})
	$(document).on("change",".origin",function(){
	var origin=$(this).val()
	$(".down_dest").val('').val(origin)
	})
	$(document).on("change",".dest",function(){
	var dest=$(this).val()
	$(".down_origin").val('').val(dest)
	})
//
</script>
@endsection
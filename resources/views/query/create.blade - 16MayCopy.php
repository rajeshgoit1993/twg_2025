@extends('layouts.master')
@section('content')

<style type="text/css">
span.select2.select2-container {
	width: 100% !important;
	}
.btnblue {
	display: inline-block;
	background: #008cff;
    padding: 4px 12px;
    font-size: 16px;
    line-height: 18px;
    color: #fff;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    border: 1px solid #008cff;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
	}
.requiredcolor {
	color: #E12D2D;
}
.fontWeight500 {
	font-weight: 500;
	}
.fontWeight600 {
	font-weight: 600;
	}
.textCapitalize {
	text-transform: capitalize;
	}
.textLowercase {
	text-transform: lowercase;
	}
.textUppercase {
	text-transform: uppercase;
	}
.lineHeight14 {
	line-height: 14px;
	}
.lineHeight15 {
	line-height: 15px;
	}
.paddingTop10 {
	padding-top: 10px;
	}
paddingBottom10 {
	padding-bottom: 10px;
	}
.appendTop5 {
	margin-top: 5px;
	}
.appendTop10 {
	margin-top: 10px;
	}
.appendTop15 {
	margin-top: 15px;
	}
.appendTop20 {
	margin-top: 20px;
	}
.appendBottom5 {
	margin-bottom: 5px;
	}
.appendBottom10 {
	margin-bottom: 10px;
	}
.appendBottom15 {
	margin-bottom: 15px;
	}
.appendBottom20 {
	margin-bottom: 20px;
	}
.borderTopCCC {
	border-top: 1px solid #ccc;
	}
.borderBottomCCC {
	border-bottom: 1px solid #ccc;
	}
.borderradius2 {
	border-radius: 2px;
	}
.borderradius3 {
	border-radius: 3px;
	}
.borderradius4 {
	border-radius: 4px;
	}
.borderradius5 {
	border-radius: 5px;
	}
.borderradius10 {
	border-radius: 10px;
	}
.makeflex {
	display: flex;
	}
.flexCenter {
	display: flex;
	align-items: center;
	}
#touraccommodation .dropdown-menu {
	margin: -1px !important;
}
.dropdown-menu li a {
	margin: -3px 0px !important;
}
.part_payment, .direct_part {
	display: none;
}
.backgroundColorEEE {
	background-color: #eee;
	}
.fullWidth {
	width: 100%;
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
    /*margin-bottom: 2px;
	border: 1px solid #008d4c;
	border: 1px solid #bbbbbb;
    border-color: #e6e6e6 #e6e6e6 #bfbfbf;
    border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
    border-bottom-color: #a2a2a2;*/
	}
.btnBack:before {
	content: "\e091";
	position: relative;
    top: 1px;
    display: inline-block;
    font-family: 'Glyphicons Halflings';
    font-style: normal;
    font-weight: 400;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
	}
.btnBack:hover, .btnBack:focus {
	color: #fff;
	}
.navQuoteBar {
    /*display: flex;
	align-items: center;
    justify-content: center;
    left: 0;
    position: absolute;
    right: 0;*/
    z-index: 11;
	padding-bottom: 15px;
	}
.quoteType {
	display: flex;
	align-items: center;
	border-bottom: 1px solid #ddd;
	}
.quoteTab {
	display: flex;
	justify-content: space-evenly;
	align-items: center;
	/*width: 150px;*/
	background: #fff;
	font-size: 18px;
	line-height: 18px;
	font-weight: 600;
	color: #A1A1A1;
	text-transform: capitalize;
	padding: 20px 25px;
	/*border-bottom: 4px solid #A1A1A1;*/
	cursor: pointer;
	flex-shrink: 0;
	outline: 0;
	}
.navQuoteBar > ul > li.active {
  /*color: #01b7f2;
  border-bottom: 2px solid #01b7f2;*/
  color: #008cff;
  border-bottom: 2px solid #008cff;
  }
.navQuoteBar > ul > li:hover, ul > li:focus {
  color: #008cff;
  }
.itemBox {
	margin-bottom: 10px;
	}
.panelBox {
	margin-top: 0px;
	/*padding: 0px 20px 0px 20px;*/
	border: 1px solid #ccc;
	border-top: 0;
	border-bottom: 0;
	border-radius: 0px 0px 5px 5px;
	max-height: 0;
	overflow: hidden;
	transition: max-height 0.2s ease-out;
	}
.accordion.active .panelBox {
	border-bottom: 1px solid #ccc;
	}
.panelContent {
	padding: 15px 20px;
	background-color: white;
	}
.accordion { 
	cursor: pointer;
	padding: 0px 15px;
	display: flex;
	align-items: center;
	justify-content: space-between;
	border:1px solid #e4e5e7;
    border-radius: 4px;
	}
.accordion:hover, .panelHeading:hover {
    cursor:pointer;
	background: #f2f2f2;
	color: #008cff;
	}
.accordion.active {
  background: #f2f2f2;
  border-radius: 5px 5px 0px 0px;
  }
.accordion:after {
  font-family: FontAwesome;
  content: '\f106';
  color: #008cff;
  float: right;
  margin-left: 20px;
  cursor: pointer;
  font-size: 28px;
  }
.accordion.active:after {
  content: "\f107";
  background: #f2f2f2;
  }
.panelHeading {
    color: #4a4a4a;
	font-size: 16px;
	line-height: 16px;
    font-weight: 500;
    text-align: left;
    margin: 0px;
	}
.panelHeading:active {
	color: #008cff;
	}
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
.flightBoxHeading {
	font-size: 14px;
	line-height: 14px;
	color: #4a4a4a;
	background: #ccc;
	padding: 10px;
	border-radius: 3px;
	font-weight: 600;
	text-align: left;
	margin-bottom: 0px;
	}
.partPayment, .directPayment, .flightOption, .visaOption {
	display: flex;
	align-items: center;
	font-size: 14px;
	line-height: 14px;
	color: #4a4a4a;
	background: #f9f9f9;
	padding: 10px;
	border-radius: 3px;
	font-weight: 600;
	text-align: left;
	margin-bottom: 15px;
	}
.partPayment, .directPayment {
	margin-bottom: -15px;
	}
.partPayment label, .directPayment label, .flightOption label, .visaOption label, .quoteValidity label {
	margin: 0px;
	}
.partPayment input[type=checkbox], .directPayment input[type=checkbox], .flightOption input[type=checkbox], .visaOption input[type=checkbox], .quoteValidity input[type=text] {
	margin: 0px 10px;
	padding: 5px 10px;
	border-radius: 3px;
	border: 1px solid #ccc;
	}
.quoteValidity {
	display: flex;
	align-items: center;
	margin-bottom: 15px;
	}
.emailHeader, .webHeader, .emailFooter, .webFooter {
	color: #4a4a4a
	}
.morePlus {
	color: #008cff;
	font-weight: 600;
	}
.saveOptions, .saveQuote {
	display: flex;
	justify-content: center;
	margin-bottom: 20px;
	}
.savePreview, .saveSend {
	text-align: center;
	border-radius: 5px;
	background: #f9f9f9;
	}
.savePreview label, .saveSend label {
	padding: 10px 30px 10px 40px;
	font-weight: 500;
	font-size: 15px;
	line-height: 20px;
	}
.btnQuoteSave {
	font-size: 20px;
	line-height: 20px;
	width: 330px;
	height: 40px;
	font-weight: 600;
	}
.dayTitle {
	margin-bottom: 15px;
	font-weight: 600;
	font-size: 13px;
	line-height: 20px;
	text-transform: capitalize;
	}
.dayTitle input[type=text] {
	border: 1px solid #ccc;
	border-radius: 3px;
	padding: 5px 10px;
	width: 100%;
	margin-top: 5px;
	}
.dayPlanSeparator {
	border-bottom: 1px solid #ccc;
	margin: 10px 0px;
	}
.fontItalic {
	font-style: italic;
	}
.roomGuestsHeading {
	font-size: 20px;
	line-height: 20px;
	color: #000001;
	text-align: left;
	margin-bottom: 10px;
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
	display: block;
	}
	.cke_chrome
{
    display: none;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<!-- Main content -->

<?php 
                                $dept_date = str_replace(' ', '',$data->date_arrival);
                                 
                                $dept_date = str_replace('/', '-', $dept_date);
                                $condition_data=date('m/d/Y' ,strtotime($dept_date));
                                $dept_date=strtotime($dept_date);
                                $now=strtotime("now");
                                $difference=($dept_date-$now)/ (60 * 60 * 24);
                                $difference=(int)$difference;
                                if($dept_date<=$now)
                                {
                                $difference=0;
                                }

                                ?>
<input type="hidden" id="condition_data" name="" value="{{$condition_data}}">
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="makeflex aligncenter paddingAllTen">
					<a href="{{ URL::to('/query') }}" class="btnBack appendRight20"> Back</a>
					<span class="pfwmt font18">Create Quote</span>
				</div>
				<div style="padding: 0px 25px">
				<div class="navQuoteBar">
					<ul class="quoteType">
						<li class="tablinks quoteTab" id="defaultOpen" onclick="openTab(event, 'quote1')">
							<span>Quote 1</span>
						</li>
						<li class="tablinks quoteTab" onclick="openTab(event, 'quote2')">		
							<span>Quote 2</span>
						</li>
						<!--<li class="tablinks quoteTab" onclick="openTab(event, 'quote3')">
							<span>Quote 3</span>
						</li>
						<li class="tablinks quoteTab" onclick="openTab(event, 'quote4')">
							<span>Quote 4</span>
						</li>-->
					</ul>
				</div>
				<!--Quote Tab Content-->
				<div class="tabcontent" id="quote1">
					@include('query.quotation.quote1')
					<!-- accordion (start) --
					<div class="col-md-12 paddingZero">
							<div class="form-group makeflex alignitemsCenter accordion">
								<h4>Payment Information <span class="requiredcolor">*</span></h4>
							</div>
							<div class="panelContent">
								<div class="col-md-4">
									<div class="form-group">
										<label for="basefare">Base Fare <span class="requiredcolor">*</span></label>
											<input type="text" class="form-control text-capitalize" id="basefare" name="basefare" placeholder="Enter Base Fare">
									</div>
								</div>
								
							</div>
						</div>
				 accordion (end) -->
				</div>
				
				<div class="tabcontent" id="quote2">
				<!-- 	@include('query.quotation.option1') -->
				</div>
				</div>
			</div>
		</div>
		<!-- Modal -->
		<div class="modal fade" id="addBookDialog" role="dialog">
			<div class="modal-dialog">
			<!-- Modal content-->
				<div class="modal-content borderRadius5">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<input type="hidden" name="" value="" id="bookId">
						<h4 class="modal-title roomGuestsHeading">ROOMS & GUEST DETAILS</h4>
					</div>
					<form action="#" method="post" id="enq_data" name="enq_data">
					<div class="roomGuests">
						<label for="roomnumber fontWeight600">No of Rooms <span class="requiredcolor">*</span></label>
						<select class="form-control select_room" name="remarks">
							<option value="">Select Room</option>
							@for($i=1;$i<=10;$i++)
							<option value="{{$i}}">{{$i}}</option>
							@endfor
						</select>
						<input type="text" value="2 Rooms (4 Adults,2 Child,1 Infant)" id="" readonly>
					</div>
					<div class="modal-body modalBody custom_border" id="modal-body"></div>
					</form>
					<div class="modal-footer">
						<button type="button" class="btn btn-success" id="enq_update">Update</button>
						<button type="button" class="btn btn-default color4a" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="supplier" role="dialog">
			<div class="modal-dialog">
			<!-- Modal content-->
				<div class="modal-content borderRadius5">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<input type="hidden" name="" value="" id="bookId">
							<h4 class="modal-title">Supplier Remarks</h4>
					</div>
					<form action="#" method="post" id="enq_data" name="enq_data">
						<div class="modal-body custom_border" id="supplier_body"></div>
					</form>
					<div class="modal-footer">
						<button type="button" class="btn btn-success supplier_remarks" supplier_remarks_id="" supplier_attr="">Apply</button>
						<button type="button" class="btn btn-default color4a" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
</section>
<!-- /.content -->
</div>
<div class="testing">
	<input type="hidden" value="{{url('/')}}" name="" id="test">
</div>
<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src='{{ url("resources/assets/js/packages/quote1.js") }}'></script>
<script>



</script>
<script>

</script>
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
    //
//      var new_val = $("#condition_data").val().split('/');
         
       
// var new_start_date=parseInt(new_val[1])-parseInt(days)+'/'+parseInt(new_val[0])+'/'+parseInt(new_val[2])



    // $(this).parent().siblings('.payment_date_parent').children('.payment_date').val('').val(someFormattedDate);
   
  $(this).parent().siblings('.payment_date_parent').children('.payment_date').datepicker({dateFormat:"dd/mm/yy"}).datepicker("setDate",someFormattedDate);
})

// function get_set_payment_days_date()
// {


// }

$(document).ready(function(){
 var start_date=<?php echo "$difference"; ?>-2;
	$('.departure_date').datepicker({
     format: 'dd/mm/yyyy',
    autoclose: true,
    todayHighlight: true,
    startDate: "+"+start_date+"d",
    endDate: "+<?php echo "$difference"; ?>d"
    
});

 var start_date_return=<?php echo "$difference"; ?>+2;
	$('.return_date').datepicker({
     format: 'dd/mm/yyyy',
    autoclose: true,
    todayHighlight: true,
    startDate: "+"+start_date_return+"d"
});

	$('.datepicker_new').datepicker({
     format: 'dd/mm/yyyy',
    autoclose: true,
    todayHighlight: true,
    startDate: '+1d',
    endDate: "+<?php echo "$difference"; ?>d"
    
});
	//
	$(".datepicker_new").on("change", function(){

// $(this).val()


// var end = $("#condition_data").val()
  var end = new Date(); 

   end.setDate(end.getDate()); 
    var dd = end.getDate();
    var mm = end.getMonth() + 1;
    var y = end.getFullYear();

    var someFormattedDate =  mm+ '/' + dd + '/' + y;
   // var someFormattedDate = $("#condition_data").val();

  var new_val = $(this).val().split('/')

var new_start_date=parseInt(new_val[1])+'/'+parseInt(new_val[0])+'/'+parseInt(new_val[2])

// Add two dates to two variables   
  var startDay = new Date(new_start_date);  
    var endDay = new Date(someFormattedDate);  
  
// Determine the time difference between two dates     
    var millisBetween = endDay.getTime()-startDay.getTime();  
  
// Determine the number of days between two dates  
    var days = millisBetween / (1000 * 3600 * 24);  
  
// Show the final number of days between dates     
    var day=Math.round(Math.abs(days)); 

// $('.payment_days option[value="4"]').attr("selected", "selected");
$(this).parent().siblings('.payment_days_parent').children('.payment_days').val('').val(day);
// $('.payment_days').val('').val(day);
// console.log(day);  

});
})
//
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


// if(adayplus==1)
// {
	
// var hours=parseInt(hours)+parseInt(24)
// }
// else if(adayplus==2)
// {
// var hours=parseInt(hours)+parseInt(48)
// }
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


// if(adayplus==1)
// {
	
// var hours=parseInt(hours)+parseInt(24)
// }
// else if(adayplus==2)
// {
// var hours=parseInt(hours)+parseInt(48)
// }
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
<!-- /.content-wrapper -->
@endsection

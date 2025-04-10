@extends('layouts.front.masternoindex')
@section("title", 'Booking Review')
@section('content')
<!--payment review page css-->
<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/paymentreview.css') }}" />
<style type="text/css">
#loader {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  width: 100%;
  background: rgba(0,0,0,0.75) url({{url('resources/assets/Processing.gif')}}) no-repeat center center;
  z-index: 10000;
}
.tourQuoteServiceTitle {
    color: #4A4A4A;
    font-size: 12px;
    line-height: 12px;
    font-weight: 600;
    margin-bottom: 11px;
    text-align: left;
}
.appendTop10 {
	margin-top: 10px;
}
.serviceIcons {
    margin-right: 35px;
    display: flex;
    flex-direction: column;
    align-items: center;
}
.serviceIconsImage {
    margin-bottom: 5px;
    flex-shrink: 0;
}
.serviceImage {
    width: 28px;
    height: 28px;
    flex-shrink: 0;
    vertical-align: middle;
    border: 0;
    pointer-events: none !important;
}
</style>
<section>
	<div id="loader"></div>
<div class="reviewCont">
<div class="reviewbox">
	<div class="pageContainer">
		<h3 class="fa-arrow-left reviewTitle">Review Package</h3>
	</div>
</div>
<form action="#" id="save_booking_details" name="save_booking_details">
	{{csrf_field()}}
<div class="pageContainer">
	<div class="reviewTourDtlsCont">
		<div class="reviewTourBox">
			<h2>{{CustomHelpers::get_package_name($query->packageId)}}</h2>
			<h3><?php $day_night=(int)filter_var($query->duration, FILTER_SANITIZE_NUMBER_INT); ?> {{$day_night-1}} Nights & {{$day_night}} Days</h3>
			<h5>Included in this package</h5>
			<?php
			$package_service=unserialize($data->package_service);
			?>
				@if(empty($package_service))
				@else
				<div class="flexCenter">
				@foreach($package_service as $icon)
					<div class="serviceIcons appendTop10">
						<div class="serviceIconsImage">
							<img class="serviceImage" src="{{ url('/public/uploads/icons/'.CustomHelpers::getimagename($icon,'rt_icons','icon')) }}" title="{{ CustomHelpers::getimagename($icon,'rt_icons','icon_title') }}" >
						</div>
						<div class="serviceIconsTitle">{{ CustomHelpers::getimagename($icon,'rt_icons','icon_title') }}</div>
					</div>
					@endforeach
				</div>
				@endif
		</div>
		<div class="tourDepartureBox">
			<h4>DEPARTURE CITY</h4>
			<h5>{{ $data->source }}</h5>
		</div>
		<div class="tourTravelDateBox">
			<?php
					$originalDate = CustomHelpers::get_query_field($data->query_reference,'date_arrival');
					if($originalDate=="N" || $originalDate==""):
					$originalDate=date("Y-m-d");
					endif;
					$datefrom = str_replace(' ', '', $originalDate);
					$datefrom=explode("-", $datefrom);
					$datefrom_year=$datefrom["2"];
					$datefrom_day=$datefrom["1"];
					$datefrom_month=$datefrom["0"];
					$datefrom=$datefrom_year."-".$datefrom_month."-".$datefrom_day;
					$datefrom = "$datefrom_year-$datefrom_day-$datefrom_month";
					$stop_date = $datefrom;
					$date_to=$datefrom;
					$datefrom_print = date("d M Y", strtotime($datefrom));
					$day_from = strtotime($datefrom);
					$day_from = date('D', $day_from);
					$to_days=$data->duration-1;
					$stop_date = date('Y-m-d', strtotime($stop_date . ' +'.$to_days.' days'));
					$stop_date_print= date("d M Y", strtotime($stop_date));
					$day_to = strtotime($stop_date);
					$day_to = date('D', $day_to);
				?>
			<h4>TOUR DATE</h4>
			<h5><?php echo "$day_from"; ?>, {{$datefrom_print}}</h5>
			<h4>TO</h4>
			<h5><?php echo "$day_to"; ?>, {{ $stop_date_print}}</h5>
		</div>
	</div>
	<div class="reviewTourSeparator"></div>
	<!--Traveller Information-->
	<div class="mtourContBox">
		<div class="leftContainer">
			<!--Traveller information starts-->
			<div>
				<h3>Traveller Information</h3>
				<div class="travellerGuestDtls">
					<div class="appendRight40">
						<h5>{{$query->span_value_adult}} Adults, {{$query->span_value_child}} Child, {{$query->span_value_infant}} Infant</h5>
					</div>
					<div>
						<h5>No of Rooms:&nbsp;<span>2</span></h5>
					</div>
				</div>
				<!--Rooming None-->
				<div style="display: none">
					<div class="roomCountCont">
						<span class="roomCount">Room - 1</span>
						<span class="flexOne line"></span>
					</div>
					<div class="guestDtlsCont">
						<div class="guestCountBox">
							<h4>Adult - 1</h4>
							<h5>(age >18yrs)</h5>
						</div>
						<div class="guestNameBox">
							<input type="text" value="" placeholder="Enter full name as per id card" />
						</div>
						<div class="addNewGuest" id="addModal"><span class="fa-user"></span><span class="appendLeft10">Add New</span></div>
					</div>
					<div class="guestDtlsCont">
						<div class="guestCountBox">
							<h4>Adult - 2</h4>
							<h5>(age >18yrs)</h5>
						</div>
						<div class="guestNameBox">
							<input type="text" value="" placeholder="Enter full name as per id card" />
						</div>
						<div class="addNewGuest"><span class="fa-user"></span><span class="appendLeft10">Add New</span></div>
					</div>
					<div class="guestDtlsCont">
						<div class="guestCountBox">
							<h4>Child - 1</h4>
							<h5>(age 2 to 12yrs)</h5>
						</div>
						<div class="guestNameBox">
							<input type="text" value="" placeholder="Enter full name as per id card" />
						</div>
						<div class="addNewGuest"><span class="fa-user"></span><span class="appendLeft10">Add New</span></div>
					</div>
				</div>
				<!--Rooming None-->
				<div style="display: none">
					<div class="roomCountCont">
						<span class="roomCount">Room - 2</span>
						<span class="flexOne line"></span>
					</div>
					<div class="guestDtlsCont">
						<div class="guestCountBox">
							<h4>Adult - 1</h4>
							<h5>(age >18yrs)</h5>
						</div>
						<div class="guestNameBox">
							<input type="text" value="" placeholder="Enter full name as per id card" />
						</div>
						<div class="addNewGuest"><span class="fa-user"></span><span class="appendLeft10">Add New</span></div>
					</div>
					<div class="guestDtlsCont">
						<div class="guestCountBox">
							<h4>Adult - 2</h4>
							<h5>(age >18yrs)</h5>
						</div>
						<div class="guestNameBox">
							<input type="text" value="" placeholder="Enter full name as per id card" />
						</div>
						<div class="addNewGuest"><span class="fa-user"></span><span class="appendLeft10">Add New</span></div>
					</div>
					<div class="guestDtlsCont">
						<div class="guestCountBox">
							<h4>Child - 1</h4>
							<h5>(age 2 to 12yrs)</h5>
						</div>
						<div class="guestNameBox">
							<input type="text" value="" placeholder="Enter full name as per id card" />
						</div>
						<div class="addNewGuest"><span class="fa-user"></span><span class="appendLeft10">Add New</span></div>
					</div>
					<div class="guestDtlsCont">
						<div class="guestCountBox">
							<h4>Infant - 1</h4>
							<h5>(age 0 to 2yrs)</h5>
						</div>
						<div class="guestNameBox">
							<input type="text" value="" placeholder="Enter full name as per id card" />
						</div>
						<div class="addNewGuest"><span class="fa-user"></span><span class="appendLeft10">Add New</span></div>
					</div>
				</div>
			</div>
			<!--Traveller information ends-->
			<!--Traveller contact information starts-->
			<div class="guestContactDtlsBox">
				<!--<h2>Contact Details</h2>
				<div class="flex-col-md-12">
					<div class="formGroup">
						<div class="font16 fontWeight600 blackText">Please enter details</div>
					</div>
				</div>-->
				<!--Email Id, Mobile No, City, State, Address, Spl Requests-->
				<div class="flex-row-multicolum appendTop10">
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="guestcontact_name">Leading Guest Name</label>
							<input type="text" id="guestcontact_name" name="name" placeholder="Enter full name as per id card" required
                            value="{{CustomHelpers::get_run_time_passenger_details($quote_ref_no,'name')}}"
							/>
							<span class="error" id="guestcontact_name_error"></span>
						</div>
					</div>
					<div class="flex-col-md-6"></div>
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="guestcontact_email">Email ID</label>
							<input type="text" id="guestcontact_email" name="guestcontact_email" placeholder="Enter Your Email Id" value="{{CustomHelpers::get_run_time_passenger_details($quote_ref_no,'guestcontact_email')}}" required />
							<span class="error" id="guestcontact_email_error"></span>
						</div>
					</div>
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="guestcontact_mobile">Mobile No</label>
							<div class="makeflex">
								<select style="width: 40%;margin-right: 5px;" id="country_code" name="country_code">
								</select>
								<input type="text" name="guestcontact_mobile" id="guestcontact_mobile" placeholder="Enter Your Mobile No" required value="{{CustomHelpers::get_run_time_passenger_details($quote_ref_no,'guestcontact_mobile')}}" />
							</div>
							<span class="error" id="guestcontact_mobile_error"></span>
						</div>
					</div>
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="guestcontact_city">City</label>
							<input type="text" id="guestcontact_city" name="guestcontact_city" placeholder="Enter Your City" required value="{{CustomHelpers::get_run_time_passenger_details($quote_ref_no,'guestcontact_city')}}" />
							<span class="error" id="guestcontact_city_error"></span>
						</div>
					</div>
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="guestcontact_state">State</label>
							<input type="text" name="guestcontact_state" id="guestcontact_state" placeholder="Enter Your State" required value="{{CustomHelpers::get_run_time_passenger_details($quote_ref_no,'guestcontact_state')}}" />
							<span class="error" id="guestcontact_state_error"></span>
						</div>
					</div>
					<div class="flex-col-md-12">
						<div class="guestInputCont">
							<label for="guestcontact_address">Address</label>
							<input type="text" name="guestcontact_address" id="guestcontact_address" placeholder="Enter your address" value="{{CustomHelpers::get_run_time_passenger_details($quote_ref_no,'guestcontact_address')}}" required />
							<span class="error" id="guestcontact_address_error"></span>
						</div>
					</div>
					<div class="flex-col-md-12">
						<div class="guestInputCont appendTop5">
								<label for="guest_additionaletails">Special Request&nbsp;<span class="colorA1">(subject to availability)</span></label>
							<?php
                        $special_request=CustomHelpers::get_run_time_passenger_details($quote_ref_no,'special_request')
							 ?>
						@if($special_request!='')
						<?php
                        $special_request=unserialize($special_request);
						?>
							<div class="addOnDtlsCont mobscroll">
								<label for="earlycheckin"><input type="checkbox" id="earlycheckin" name="special_request[]" value="Early Check-in" @if(in_array('Early Check-in',$special_request)) checked @endif>Early Check-in</label>
								<label for="latecheckout"><input type="checkbox" id="latecheckout" name="special_request[]" @if(in_array('Late Checkout',$special_request)) checked @endif value="Late Checkout">Late Checkout</label>
								<label for="honeymoonfreebies"><input type="checkbox" id="honeymoonfreebies" name="special_request[]" @if(in_array('Honeymoon Freebies',$special_request)) checked @endif value="Honeymoon Freebies">Honeymoon Freebies</label>
							</div>
                         @else
                         <div class="addOnDtlsCont mobscroll">
								<label for="earlycheckin"><input type="checkbox" id="earlycheckin" name="special_request[]" value="Early Check-in">Early Check-in</label>
								<label for="latecheckout"><input type="checkbox" id="latecheckout" name="special_request[]" value="Late Checkout">Late Checkout</label>
								<label for="honeymoonfreebies"><input type="checkbox" id="honeymoonfreebies" name="special_request[]" value="Honeymoon Freebies">Honeymoon Freebies</label>
							</div>
                         @endif
							<textarea class="formTextarea" type="text" id="guest_additionaletails" name="guest_additionaletails" placeholder="Enter additional requests (if any)">{{CustomHelpers::get_run_time_passenger_details($quote_ref_no,'guest_additionaletails')}}</textarea>
						</div>
					</div>
				</div>
			</div>
			<!--Traveller contact information ends-->
			<!--Business Traveller GST information starts-->
			<div class="guestGSTDtlsBox">
				<div class="flex-col-md-12">
					<div class="formGroup">
						<h2>Enter GST details (optional)</h2>
					</div>
				</div>
				<!--GSTIN Details-->
				<div class="flex-row-multicolum appendTop20">
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="guestGST_no">GSTIN</label>
							<input type="text" id="guestGST_no" name="guestGST_no" onkeyup="gstDetails(this)" placeholder="Enter GST Number" value="{{CustomHelpers::get_run_time_passenger_details($quote_ref_no,'guestGST_no')}}" />
							<span class="error" id="guestGST_no_error"></span>
						</div>
					</div>
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="guestGST_name">GST Name</label>
							<input type="text" name="guestGST_name" id="guestGST_name" placeholder="Enter GST Name" value="{{CustomHelpers::get_run_time_passenger_details($quote_ref_no,'guestGST_name')}}" />
							<span class="error" id="guestGST_name_error"></span>
						</div>
					</div>
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="guestGST_email">GST Email ID</label>
							<input type="text" id="guestGST_email" name="guestGST_email" placeholder="Enter GST Email" value="{{CustomHelpers::get_run_time_passenger_details($quote_ref_no,'guestGST_email')}}" />
							<span class="error" id="guestGST_email_error"></span>
						</div>
					</div>
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="guestGST_mobile">GST Mobile</label>
							<input type="text" name="guestGST_mobile" id="guestGST_mobile" placeholder="Enter GST Mobile No" value="{{CustomHelpers::get_run_time_passenger_details($quote_ref_no,'guestGST_mobile')}}" />
							<span class="error" id="guestGST_mobile_error"></span>
						</div>
					</div>
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="guestGST_state">GST State</label>
							<input type="text" name="guestGST_state" id="guestGST_state" placeholder="Enter GST State" value="{{CustomHelpers::get_run_time_passenger_details($quote_ref_no,'guestGST_state')}}" />
							<span class="error" id="guestGST_state_error"></span>
						</div>
					</div>
					<div class="flex-col-md-6"></div>
					<div class="flex-col-md-12">
						<div class="guestInputCont">
							<label for="guestGST_address">GST Address</label>
							<input type="text" name="guestGST_address" id="guestGST_address" placeholder="Enter GST address" value="{{CustomHelpers::get_run_time_passenger_details($quote_ref_no,'guestGST_address')}}" />
							<span class="error" id="guestGST_address_error"></span>
						</div>
					</div>
				</div>
				<!--Business Traveller GST information ends-->
			</div>
			<!--Traveller contact information ends-->
			<!--Traveller Pan Card information starts-->
			<div class="panInfoCont">
				<div class="d-flex-baseline">
				<div class="panCardImageBox">
					<img class="panCardImage" src="" title="Pan card">
				</div>
				<div class="panInfo">
					<h4>Please keep your PAN card hand, for the next steps</h4>
					<p>"As per Income Tax Act, 1961, the TCS@5% has been added to the amount payable for booking overseas package. In case PAN is not provided TCS@10% will be applicable. You will be able to take the credit of such TCS against Income Tax payable or by claimaint refund at the time of filing Income tax return."
					<br>
					<br>
					Howeever as per RBI guidelines, collection of PAN card details has been mandatory for all international bookings. So, please share your PAN card details in next steps to proceed with the booking.
					</p>
				</div>
				</div>
			</div>
			<!--Traveller Pan Card information ends-->
			<div class="impInfoBox">
				<h5>Please make sure you read all the Terms & Conditions, Booking and Cancellation Policy for this booking.</h5>
			</div>
		</div>
		<!--Sidebar starts-->
		<div class="rightContainer">
			<div class="priceValueBox">
				<h4>GRAND TOTAL</h4>
				<h3><span class="defaultCurencyPay"></span>&nbsp;<?php CustomHelpers::get_indian_currency($amount); ?></h3>
				<h5>(inclusive of all taxes)</h5>
			</div>
			<div class="paymentDetails">
			<!-- 	<div class="PaxWiseBox">
					<div class="paxValueBox">
						<div><span class="defaultCurencyPay"></span>&nbsp;4,698 x 4 <span class="fontSize14 colorA1">adults</span></div>
						<div><span class="defaultCurencyPay"></span>&nbsp;18,792</div>
					</div>
					<div class="paxValueBox">
						<div><span class="defaultCurencyPay"></span>&nbsp;2,698 x 2 <span class="fontSize14 colorA1">children</span></div>
						<div><span class="defaultCurencyPay"></span>&nbsp;5,396</div>
					</div>
					<div class="paxValueBox">
						<div><span class="defaultCurencyPay"></span>&nbsp;1,698 x 1 <span class="fontSize14 colorA1">infant</span></div>
						<div><span class="defaultCurencyPay"></span>&nbsp;1,698</div>
					</div>
				</div> -->
				<div class="totalCostBox">
					<div class="totalBasicCostBox">
						<div class="fontBold">Total Cost</div>
						<div class="fontBold"><span class="defaultCurencyPay"></span>&nbsp;<?php CustomHelpers::get_indian_currency($amount); ?></div>
					</div>
					<!-- <div class="totalBasicCostBox">
						<div>Discount (-)</div>
						<div><span class="defaultCurencyPay"></span>&nbsp;18,792</div>
					</div> -->
				</div>
			</div>
			<div class="grandTotalCostBox">
				<div class="grTtlCostBox">
					<div class="fontBold">Grand Total</div>
					<div class="fontBold"><span class="defaultCurencyPay"></span>&nbsp;<?php CustomHelpers::get_indian_currency($amount); ?></div>
				</div>
			</div>
			<div class="payFullCostBox">
				<label>
					<div class="flexCenter">
						<input type="radio" id="" checked name="amount" value="fullamt">Pay Full Amount</div>
					<div class="payFullItem fontBold"><span class="defaultCurencyPay"></span>&nbsp;<?php CustomHelpers::get_indian_currency($remaining_amount); ?></div>
				</label>
			</div>
			<!--Enter part payment-->
			<div class="payPartBox" style="display: ;">
				<div class="mPayPartBoxInner">
				<label>
					<div class="flexCenter"><input type="radio" id="" name="amount" value="part_amount">Enter Amount</div>
					<div class="payFullItem"><span class="defaultCurencyPay"></span> <input type="text" name="custom_pay" id="custom_pay" class="form-control" style="width: 50% !important;display: inline-block !important;background: white !important;color: black !important;" value="0">
					</div>
				</label>
				</div>
			</div>
			<!--part payment-->
			<div class="payPartBox" style="display: none;">
				<label>
					<div class="flexCenter"><input type="radio" id="" name="amount" value="fullamt">Book now pay later</div>
					<div class="payFullItem"><span class="defaultCurencyPay"></span>&nbsp;18,792</div>
				</label>
				<!--<label>
					<div class="flexCenter" style="width: 200px"><input type="radio" id="" name="partamt" value="partamt">Balance 45 days before departure</div>
					<div class="payFullItem"><span class="defaultCurencyPay"></span>&nbsp;18,792</div>
				</label>-->
				<div class="payPartFlow"></div>
				<div class="payPartBalanceBox">
					<div class="flexCenter">
						<div class="payPartBalance">1</div>
						<div class="payPartBalanceInfo">Before 15 June 2022</div>
					</div>
					<div class="payPartBalanceItem"><span class="defaultCurencyPay"></span>&nbsp;18,792</div>
				</div>
				<div class="payPartFlow"></div>
				<div class="payPartBalanceBox">
					<div class="flexCenter">
						<div class="payPartBalance">2</div>
						<div class="payPartBalanceInfo">Before 28 June 2022</div>
					</div>
					<div class="payPartBalanceItem"><span class="defaultCurencyPay"></span>&nbsp;18,792</div>
				</div>
			</div>
			<div class="guestPayCont">
				<div class="guestPayBox">
					<div>
						<p class="guestPayItem">You Pay</p>
					</div>
					<div class="guestPayItem"><span class="defaultCurencyPay"></span>&nbsp;<span id="you_pay"><?php CustomHelpers::get_indian_currency($remaining_amount); ?></span></div>
				</div>
				<div class="guestPayBox">
					<div>
						<p class="guestDueItem">Amount Due Later</p>
					</div>
					<div class="guestDueItem"><span class="defaultCurencyPay"></span>&nbsp;<span id="due_amount">0</span></div>
				</div>
				<div class="guestConfBox">
					<h3>Acknowledgement</h3>
					<div class="makeflex">
						<input type="checkbox" name="acknowledgement" id="acknowledgement" value="1">
						<p>By proceeding, I confirm that I have read the <a>User Agreement, Terms of Service</a> and <a>Privacy Policy</a> of TheWorldGateway</p>
					</div>
				</div>
			<div class="payBtn">
				<button type="submit" class="btnMain btnProceed" id="btnProceed">Proceed to Payments</button>
			</div>
			</div>
		</div>
		<!--Sidebar ends-->
	</div>
	<!--Mobile Pricebar starts-->
	<div class="mReivewPriceBarCont">
		<div class="mReivewPriceBarBox">
			<div class="mReviewPriceBox">
				<p class="mPayblPrcVal"><span class="defaultCurencyPay">&nbsp;18,792</span></p>
				<p class="mPayblPrcValTag">Total Payable</p>
			</div>
			<div>
				<div class="mLineSeprtr">|</div>
				<button type="submit" class="btnMain btnProceedMob">Proceed</button>
			</div>
		</div>
	</div>
	<!--Mobile Pricebar ends-->
</div>
</form>
</div>
</section>
@endsection
@section("custom_js")
<script type="text/javascript">
$(document).on("keyup change","#custom_pay",function(){
    this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
})
$(document).ready(function(){
//
   var APP_URL=jQuery("#base_url").val();
var url=APP_URL+'/country_code';
		var data={_token:"{{ csrf_token() }}"};
		$.post(url,data,function(rdata) {
			$("#country_code").html("").html(rdata);
			})
//
 $('#acknowledgement').change(function() {
        if($(this).is(":checked")) {
            $("#btnProceed").css("background", "green");
        }
        else
        {
        	$("#btnProceed").css("background", "#CED0D4");
        }
    });
    //
	$("#custom_pay").prop('disabled', true);
	$('input[type=radio][name=amount]').change(function() {
    if (this.value == 'fullamt') {
    	$("#custom_pay").val('').val(0)
    	$("#custom_pay").prop('disabled', true);
   var APP_URL=jQuery("#base_url").val();
    $.ajax({
        url: APP_URL+'/get_full_pay_calculation',
        data: {amount:'NA'},
        type: 'get',
        // contentType: false,
        // processData: false,
        success: function (data) {
        	$("#you_pay").html('').html(Number(data).toString())
            $("#due_amount").html('').html(0)
            },
        error: function (xhr, status, error) {
            }
        });
    }
    else if (this.value == 'part_amount') {
    	$("#custom_pay").prop('disabled', false);
    }
});
//
$(document).on("keyup","#custom_pay",function(){
var amount=$(this).val()
   var APP_URL=jQuery("#base_url").val();
    $.ajax({
        url: APP_URL+'/get_custom_pay_calculation',
        data: {amount:amount},
        type: 'get',
        // contentType: false,
        // processData: false,
        success: function (data) {
        	if(data<0)
        	{
        		alert('Please Check your amount cannot be greater than total amount')
          $("#you_pay").html('').html(Number(amount).toString())
          $("#due_amount").html('').html(data)
        	}
        	else
        	{
        	$("#you_pay").html('').html(Number(amount).toString())
            $("#due_amount").html('').html(data)
        	}
            },
        error: function (xhr, status, error) {
            }
        });
})
})
// save_booking_details
$(document).on("submit", "#save_booking_details", function (e) {
	e.preventDefault()
	if($('#acknowledgement').is(':checked'))
	{
		var form = $('#save_booking_details')[0];
   var data = new FormData(form);
         var APP_URL=jQuery("#base_url").val();
    var spinner = $('#loader');
	spinner.show();
    $.ajax({
        url: APP_URL+'/save_booking_details',
        data: data,
        type: 'post',
        contentType: false,
        processData: false,
        success: function (data) {
        	  console.log(data)
          spinner.hide();
       var token =  jQuery('input[name="_token"]').val()
		var content_action=APP_URL+'/payment-option';
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
		second_field.setAttribute("name", "amount");
		second_field.setAttribute("value", data);
		form.appendChild(second_field);
		document.body.appendChild(form);
		document.body.appendChild(form);
		//window.open('', 'view');
		//window.open('','view' );
		form.submit();
		},
		error: function (xhr, status, error) {
		}
		});
		}
	else
	{
		alert('Pls Check Acknowledgement')
	}
})
//Add GSTIN Validation
function gstDetails(guestGST_no) {
	var gstnumber = document.getElementById("guestGST_no");
	var gstname = document.getElementById("guestGST_name");
	var gstemail = document.getElementById("guestGST_email");
	var gstmobile = document.getElementById("guestGST_mobile");
	var gststate = document.getElementById('guestGST_state');
	var gstaddress = document.getElementById('guestGST_address');
	var gstnumber_error = document.getElementById('guestGST_no_error');
	if (gstnumber.value.trim() != "") {
		//Enable the TextBox when TextBox has value.
		gstname.disabled = false;
		gstemail.disabled = false;
		gstmobile.disabled = false;
		gststate.disabled = false;
		gstaddress.disabled = false;
		gstname.style.borderColor = 'red';
		gstemail.style.borderColor = 'red';
		gstmobile.style.borderColor = 'red';
		gststate.style.borderColor = 'red';
		gstaddress.style.borderColor = 'red';
		<!--ADD VALIDATION: IF DATA LENGTH LESS THAN 2 CHARACTERS THEN ONLY MESSAGE APPEARED AND VICE VERSA-->
		gstnumber_error.innerHTML = 'Please enter a valid GST number';
		gstnumber_error.style.color = 'red';
		} else {
			//Disable the TextBox when TextBox is empty.
			gstname.disabled = true;
			gstemail.disabled = true;
			gstmobile.disabled = true;
			gststate.disabled = true;
			gstaddress.disabled = true;
			gstname.style.borderColor = '#9b9b9b';
			gstemail.style.borderColor = '#9b9b9b';
			gstmobile.style.borderColor = '#9b9b9b';
			gststate.style.borderColor = '#9b9b9b';
			gstaddress.style.borderColor = '#9b9b9b';
			gstnumber_error.innerHTML = '';
			}
    };
</script>
<script type="text/javascript">
// Get the modal
var modal = document.getElementById("myModal");
// Get the button that opens the modal
var btn = document.getElementById("addModal");
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("btnCloseModal")[0];
var span = document.getElementsByClassName("btnCancel")[0];
// When the user clicks the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}
// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
<script type="text/javascript">
//Add Passport No Validation-Pop up
function EnableDisable(passportnumber) {
	var psptnumber = document.getElementById("passportnumber");
	var psptcountry = document.getElementById("passportcountry");
	var psptexpirydate = document.getElementById("passportexpirydate");
	var validpsptmsg = document.getElementById('validpassport');
	if (psptnumber.value.trim() != "") {
		//Enable the TextBox when TextBox has value.
		psptcountry.disabled = false;
		psptexpirydate.disabled = false;
		psptcountry.style.borderColor = 'red';
		psptexpirydate.style.borderColor = 'red';
		<!--ADD VALIDATION: IF DATA LENGTH LESS THAN 2 CHARACTERS THEN ONLY MESSAGE APPEARED AND VICE VERSA-->
		validpsptmsg.innerHTML = 'Please enter a valid passport number';
		validpsptmsg.style.color = 'red';
		} else {
			//Disable the TextBox when TextBox is empty.
			psptcountry.disabled = true;
			psptexpirydate.disabled = true;
			psptcountry.style.borderColor = '#9b9b9b';
			psptexpirydate.style.borderColor = '#9b9b9b';
			validpsptmsg.innerHTML = '';
			}
    };
</script>
@endsection
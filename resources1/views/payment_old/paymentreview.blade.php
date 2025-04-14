@extends('layouts.front.masternoindex')
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
<!--payment option page css-->
<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/paymentoption.css') }}" />

<section>
<div class="reviewCont">
<div class="reviewbox">
	<div class="pageContainer">
		<h3 class="fa-arrow-left reviewTitle">Payment</h3>
	</div>
</div>
<div class="paymentWrapperBG">
<div class="pageContainer">
	<form action="#" id="save_booking_details" name="save_booking_details">
	{{csrf_field()}}
	<!--Traveller Information-->
	<div class="paymentWrapper">
		<div class="leftContainer">
  <?php  
 $package_id=$query->packageId;
 $package=DB::table('rt_packages')->where('id',(int)$package_id)->first();
 $country=unserialize($package->country);

  ?>
        @if(in_array('India',$country) || in_array('Nepal',$country) || in_array('Bhutan',$country))

        @else
			<div class="PanCardCont">
			<!--Traveller Pan Card Details starts-->
			<div>
				<h2>PAN Details</h2>
				<p>As per Income Tax Act 1961, the TCS @5% has been added to amount payable for booking overseas tour package. You will be able to claim credit of such TCS amount against Income Tax payable at time of filing return against the PAN shared.</p>
			</div>
			<div class="PanCardVerifyBox">
				<div class="flexCenter">
					<div class="panCardLogoBox">
						<img class="panCardLogo" src="" title="Pan card">
					</div>
					<!--<div>
						<img width="34" height="20" src="" title="Pan Card"style="border-radius: 3px;margin-top: 18px;margin-right: 15px">
					</div>-->
					<div>
						<div class="flex-row-multicolum fullWidth">
							<div class="flex-col-md-6">
								<div class="guestInputCont">
									<label for="pancardnumber">Enter PAN Card Number</label>
									<input type="text" name="pancardnumber" minlength="10" id="pancardnumber" maxlength="10" placeholder="Enter your PAN No" required value="{{CustomHelpers::get_run_time_passenger_details($quote_ref_no,'pancardnumber')}}" />
									<span class="error" id="pannumber_error"></span>
								</div>
							</div>
							<div class="flex-col-md-6">
								<div class="guestInputCont">
									<label for="pancardname">Enter Name on PAN CARD</label>
									<input type="text" name="pancardname" placeholder="Enter name on PAN Card" required value="{{CustomHelpers::get_run_time_passenger_details($quote_ref_no,'pancardname')}}" />
									<span class="error" id="panname_error"></span>
								</div>
							</div>
						</div>
						<div class="flex-col-md-12">
							<div class="panCheckCont">
								<input type="checkbox" id="panacceptance" name="panacceptance" value="1" >
								<label for="panacceptance">Confirm that the PAN Card provided here belongs to the lead passenger of this booking, Incorrect PAN details will delay service confirmation, so please recheck the PAN Number before submission</label>
								<span class="error" id="panacceptance_error"></span>
							</div>
						</div>
					</div>
				</div>
			</div>
			</div>
			@endif
			</form>
			<!--Payment gateway options starts-->
			<div class="paymentModeCont">
				<div>
					<h2>Payment Options</h2>
					<h3>Select your payment options</h3>
				</div>
				<div class="slectPayModeCont">
					<div class="paymentBox">
						<div class="flexCenter">
							<div class="payModeLogoBox">
								<img class="payModeLogo" src="" title="">
							</div>
							<div class="paymentoption">UPI</div>
						</div>
						<div class="selectPay pay">Select & PAY</div>
					</div>
					<div class="paymentBox">
						<div class="flexCenter">
							<div class="payModeLogoBox">
								<img class="payModeLogo" src="" title="">
							</div>
							<div class="paymentoption">Credit Card</div>
						</div>
						<div class="selectPay pay">Select & PAY</div>
					</div>
					<div class="paymentBox">
						<div class="flexCenter">
							<div class="payModeLogoBox">
								<img class="payModeLogo" src="" title="">
							</div>
							<div class="paymentoption">Debit Card</div>
						</div>
						<div class="selectPay pay">Select & PAY</div>
					</div>
					<div class="paymentBox">
						<div class="flexCenter">
							<div class="payModeLogoBox">
								<img class="payModeLogo" src="" title="">
							</div>
							<div class="paymentoption">Net Banking</div>
						</div>
						<div class="selectPay pay">Select & PAY</div>
					</div>
				</div>
			</div>
			<!--Payment gateway options ends-->
		</div>
		<!--Sidebar starts-->
		<div class="rightContainer">
			<div class="mBkngContTtl">BOOKING SUMMARY</div>
			<div class="bkngSumryCont">
				<div class="bkngSumryContTtl">Booking details</div>
				<div class="bkngSumryBox">
					<div>
						<h3>{{CustomHelpers::get_package_name($query->packageId)}}</h3>
					</div>
					<div class="flex-column">
						<div class="bkngSumryOrigin">From {{ $data->source }}</div>
						<div class="bkngSumryDate">
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
			<?php echo "$day_from"; ?>, {{$datefrom_print}} - <?php echo "$day_to"; ?>, {{ $stop_date_print}}</div>
						<div class="bkngSumryDays" style=""><?php
 $day_night=(int)filter_var($query->duration, FILTER_SANITIZE_NUMBER_INT);
       
?> {{$day_night-1}} Nights & {{$day_night}} Days</div>
					</div>
				</div>
				<div class="bkngSumryTrvlrsBox">
					<div>
						<h3>Traveler(s)</h3>
					</div>
					<div>
						<h5>{{$query->span_value_adult}} Adults, {{$query->span_value_child}} Children, {{$query->span_value_infant}} Infant</h5>
						<h4>2 Rooms</h4>
					</div>
					<div class="appendTop20">
						<!--<h4>Contact Details</h4>-->
						<h6><i class="fa fa-envelope" aria-hidden="true"></i>&ensp; {{CustomHelpers::get_run_time_passenger_details($quote_ref_no,'guestcontact_email')}}</h6>
						<h6><i class="fa fa-phone" aria-hidden="true"></i>&emsp;{{CustomHelpers::get_run_time_passenger_details($quote_ref_no,'guestcontact_mobile')}}</h6>
					</div>
				</div>
			</div>
			<!--Fare summary-->
			<div class="fareSumryCont">
				<div class="fareSumryContTtl">Fare details</div>
				<!--<p class="pkgdetails" style="margin: 0px 0px 3px 0px;">FARE SUMMARY</p>-->
				<div class="fareSumryBox">
					<div>
						<h3>Total Basic Cost</h3>
						<h5>{{$query->span_value_adult}} Adults, {{$query->span_value_child}} Children, {{$query->span_value_infant}} Infant</h5>
					</div>
					<div>
						<h3><span class="defaultCurencyPay">&nbsp;{{CustomHelpers::get_indian_currency($totalamount)}}</span></h3>
					</div>
				</div>
			<!-- 	<div class="fareSumryBox">
					<div>
						<h3>Discount (-)</h3>
						
					</div>
					<div>
						<h3><span class="defaultCurencyPay">&nbsp;0</span></h3>
					</div>
				</div> -->
				<div class="fareSumryBox">
					<div>
						<h2>Total Due</h2>
					</div>
					<div>
						<h2><span class="defaultCurencyPay">&nbsp;{{CustomHelpers::get_indian_currency($total_quote_amount)}}</span></h2>
					</div>
				</div>
			</div>
			<div class="amountPayBox">
				<div>
					<h2>Amount Payable Now</h2>
				</div>
				<div>
					<h2><span class="defaultCurencyPay">&nbsp;{{CustomHelpers::get_indian_currency($amount)}}</span></h2>
				</div>
			</div>
			<div class="amountDueBox">
				<div>
					<h2>Amount Payable Later</h2>
				</div>
				<div>
					<h2><span class="defaultCurencyPay">&nbsp;{{CustomHelpers::get_indian_currency($total_quote_amount-$amount)}}</span></h2>
				</div>
			</div>
			<div class="amountPaidBox">
				<div>
					<h2>Amount Paid</h2>
				</div>
				<div>
					<h2><span class="defaultCurencyPay">&nbsp;{{CustomHelpers::get_indian_currency($totalamount-$total_quote_amount)}} </span></h2>
				</div>
			</div>
		</div>
		<!--Sidebar ends-->
	</div>
</div>
</div>
<!--Mobile Pricebar starts-->
	<div class="mReivewPriceBarCont">
		<div class="mReivewPriceBarBox">
			<div class="mReviewPriceBox">
				<p class="mPayblPrcVal"><span class="defaultCurencyPay">&nbsp;{{CustomHelpers::get_indian_currency($amount)}}</span></p>
				<p class="mPayblPrcValTag">Payable Now</p>				
			</div>
			<div>
				<div class="mLineSeprtr">|</div>
				<button type="button" class="btnMain btnProceedMob pay">PAY</button>
			</div>
		</div>
	</div>
	<!--Mobile Pricebar ends-->
</div>
</section>

@endsection
@section("custom_js")
<script type="text/javascript">
	
$(document).on("click",".pay",function(){

	var form = $('#save_booking_details');

// Trigger HTML5 validity.
var reportValidity = form[0].reportValidity();

// Then submit if form is OK.
if(reportValidity){
    form.submit();
}

	
})
// save_booking_details
// save_booking_details
$(document).on("submit", "#save_booking_details", function (e) {
	e.preventDefault()

	if($('#panacceptance').length>0)
	{
		if($('#panacceptance').is(':checked'))
		{


		var form = $('#save_booking_details')[0];
   var data = new FormData(form);
         var APP_URL=jQuery("#base_url").val();
 
    $.ajax({
        url: APP_URL+'/save_pan_details',
        data: data,
        type: 'post',
        contentType: false,
        processData: false,
        success: function (data) {
        	  console.log(data) 

       
       var token =  jQuery('input[name="_token"]').val()

var content_action=APP_URL+'/Payment-Store';
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
second_field.setAttribute("value", 12);
form.appendChild(second_field);
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
	}
	else
	{
	var form = $('#save_booking_details')[0];
   var data = new FormData(form);
         var APP_URL=jQuery("#base_url").val();
 
    $.ajax({
        url: APP_URL+'/save_pan_details',
        data: data,
        type: 'post',
        contentType: false,
        processData: false,
        success: function (data) {
        	  console.log(data) 

       
       var token =  jQuery('input[name="_token"]').val()

var content_action=APP_URL+'/Payment-Store';
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
second_field.setAttribute("value", 12);
form.appendChild(second_field);
document.body.appendChild(form);


//window.open('', 'view');
//window.open('','view' );
form.submit();

      
            },
        error: function (xhr, status, error) {
          
            }
        });	
	}
    
     
})
</script>
@endsection

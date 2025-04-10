@extends('layouts.front.masternoindex')
@section("title", 'Payment Review')

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
					<input type="hidden" name="unique_code" id="unique_code" value="{{$unique_code}}">
					{{csrf_field()}}
					<input type="hidden" name="gateway" id="gateway" value="">
					<input type="hidden" name="mdr" id="mdr" value="">
					<input type="hidden" name="mdr_gst" id="mdr_gst" value="">
					<input type="hidden" name="mode_id" id="mode_id" value="">
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
												    <!-- PAN Card Number Input -->
												    <div class="flex-col-md-6">
												        <div class="guestInputCont">
												            <label for="pancardnumber">Enter PAN Card Number</label>
												            <input type="text" name="pancardnumber" minlength="10" id="pancardnumber" maxlength="10" placeholder="Enter your PAN No" required value="{{CustomHelpers::get_run_time_passenger_details($quote_ref_no, 'pancardnumber')}}" />
												            <span class="error" id="pannumber_error"></span>
												        </div>
												    </div>
												    <!-- Name on PAN Card Input -->
												    <div class="flex-col-md-6">
												        <div class="guestInputCont">
												            <label for="pancardname">Enter Name on PAN CARD</label>
												            <input type="text" name="pancardname" placeholder="Enter name on PAN Card" required value="{{CustomHelpers::get_run_time_passenger_details($quote_ref_no, 'pancardname')}}" />
												            <span class="error" id="panname_error"></span>
												        </div>
												    </div>
												</div>
												<div class="flex-col-md-12">
												    <!-- PAN Card Confirmation Checkbox -->
												    <div class="panCheckCont">
												        <input type="checkbox" id="panacceptance" name="panacceptance" value="1">
												        <label for="panacceptance">
												            Confirm that the PAN Card provided here belongs to the lead passenger of this booking. Incorrect PAN details will delay service confirmation, so please recheck the PAN Number before submission.
												        </label>
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
									@foreach($payment_modes as $payment_mode)
						    		<div class="paymentBox">
											<div class="flexCenter">
												<div class="payModeLogoBox">
													<img class="payModeLogo" src="" title="">
												</div>
												<?php 
													$mdr=$payment_mode->mdr;
													$mdr_gst=$payment_mode->gst_on_mdr;
													$mdr_amount=round((float)$amount*(float)$mdr/100);
													$mdr_gst_amount=round((float)$mdr_amount*(float)$mdr_gst/100);
													$total_charge=(int)$mdr_amount+(int)$mdr_gst_amount;
												?>
												<div class="paymentoption">{{$payment_mode->mode}} (Fee {{CustomHelpers::get_indian_currency($total_charge)}}) </div>
											</div>
											<div class="selectPay pay" id="{{CustomHelpers::custom_encrypt($payment_mode->id)}}">Select & PAY</div>
										</div>
									@endforeach
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
										<div class="bkngSumryDays" style="">
											<?php $day_night=(int)filter_var($query->duration, FILTER_SANITIZE_NUMBER_INT); ?>
											{{$day_night-1}} Nights & {{$day_night}} Days</div>
									</div>
								</div>
								<div class="bkngSumryTrvlrsBox">
									<div>
										<h3>Traveler(s)</h3>
									</div>
									<div>
										<h5>{{CustomHelpers::get_seperate_pass_payment_view($data->id,1,'na')}}</h5>
										<h4>{{CustomHelpers::get_seperate_pass_payment_view($data->id,1,'room')}} Rooms</h4>
									</div>
									<div class="appendTop20">
										<!--<h4>Contact Details</h4>-->
										<h6><i class="fa fa-envelope" aria-hidden="true"></i>&ensp; {{$query_lead_traveller->email}}</h6>
										<h6><i class="fa fa-phone" aria-hidden="true"></i>&emsp;{{$query_lead_traveller_info->mobile_no}}</h6>
									</div>
								</div>
							</div>
							<!--Fare summary-->
							<div class="fareSumryCont">
								<div class="fareSumryContTtl">Fare details</div>
								<div class="fareSumryBox">
									<div>
										<h3>Total Basic Cost</h3>
										<h5>{{CustomHelpers::get_seperate_pass_payment_view($data->id,1,'na')}}</h5>
									</div>
									<div>
										<?php 
				               //  $price_data_first=CustomHelpers::get_price_part_seperate($data->option1_price,$data->quote1_number_of_adult,$data->extra_adult,$data->child_with_bed,$data->child_without_bed,$data->infant,$data->solo_traveller);
				               // $adult=$data->quote1_number_of_adult;
				               // $extra_adult=$data->extra_adult;
				               // $child_with_bed=$data->child_with_bed;
				               // $child_without_bed=$data->child_without_bed;
				               // $infant=$data->infant;
				               // $solo_traveller=$data->solo_traveller;
				            ?>
										<h3><span class="defaultCurencyPay">&nbsp;<?php CustomHelpers::get_indian_currency($price_data_first['query_total_group']); ?></span></h3>
									</div>
								</div>
								@if (($price_data_first['query_total_gst_group'] + $price_data_first['query_total_tcs_group'] + $price_data_first['query_total_pg_group']) > 0)
							    <div class="fareSumryBox">
							        <table class="table">
							            <tr>
							                <td style="border-top: none;"><b>Fees & Taxes</b></td>
							                <td style="border-top: none; text-align: right;">
							                    + <span class="defaultCurencyPay"></span>&nbsp;
							                    <?php CustomHelpers::get_indian_currency($price_data_first['query_total_gst_group'] + $price_data_first['query_total_tcs_group'] + $price_data_first['query_total_pg_group']); ?>
							                </td>
							            </tr>

							            @if ($price_data_first['query_total_gst_group'] > 0)
							                <tr style="background-color: #f5f5f5;">
							                    <td style="border-top: none; padding: 5px;">
							                        GST
							                        @if ($price_data_first['query_gst_curr'] == 2)
							                            ({{$price_data_first['gst_percentage']}}%)
							                        @endif
							                    </td>
							                    <td style="border-top: none; text-align: right; padding: 5px;">
							                        <span class="defaultCurencyPay"></span>&nbsp;
							                        <?php CustomHelpers::get_indian_currency($price_data_first['query_total_gst_group']); ?>
							                    </td>
							                </tr>
							            @endif

							            @if ($price_data_first['query_total_tcs_group'] > 0)
							                <tr style="background-color: #f5f5f5;">
							                    <td style="border-top: none; padding: 5px;">
							                        TCS
							                        @if ($price_data_first['query_tcs_curr'] == 2)
							                            ({{$price_data_first['tcs_percentage']}}%)
							                        @endif
							                    </td>
							                    <td style="border-top: none; text-align: right; padding: 5px;">
							                        <span class="defaultCurencyPay"></span>&nbsp;
							                        <?php CustomHelpers::get_indian_currency($price_data_first['query_total_tcs_group']); ?>
							                    </td>
							                </tr>
							            @endif

							            @if ($price_data_first['pg_charges'] > 0)
							                <tr style="background-color: #f5f5f5;">
							                    <td style="border-top: none; padding: 5px;">
							                        Booking fees
							                        @if ($price_data_first['pg_charges'] == 2)
							                            ({{$price_data_first['pgcharges_percentage']}}%)
							                        @endif
							                    </td>
							                    <td style="border-top: none; text-align: right; padding: 5px;">
							                        <span class="defaultCurencyPay"></span>&nbsp;
							                        <?php CustomHelpers::get_indian_currency($price_data_first['query_total_pg_group']); ?>
							                    </td>
							                </tr>
							            @endif
							        </table>
							    </div>
								@endif
							 	<div class="fareSumryBox">
										<div>
											<h3>Discount (-)</h3>
											<?php 
												if(Session::has($unique_code.'coupon_id') && CustomHelpers::get_check_payment_status($quote_ref_no)==0)
											    {
												    $coupon_id=Session::get($unique_code.'coupon_id'); 
												    $coupon_data=DB::table('quote_coupon')->where('id',$coupon_id)->first();
												   
												    echo "<p>(Coupon: ".$coupon_data->coupon_name.")</p>";
											  	}
											?>
										</div>
										<div>
											<h3>
												<span class="defaultCurencyPay">&nbsp; <?php CustomHelpers::get_indian_currency($price_data_first['query_total_discount_group']); ?> </span>
											</h3>
										</div>
								</div> 
								<div class="fareSumryBox">
									<div>
										<h2>Total Due</h2>
									</div>
									<div>
										<!-- <h2><span class="defaultCurencyPay">&nbsp;<?php CustomHelpers::get_indian_currency($price_data_first['query_pricetopay_adult']-CustomHelpers::get_paid_amount($unique_code)); ?></span></h2> -->
										<h2><span class="defaultCurencyPay">&nbsp;{{CustomHelpers::get_indian_currency($custom_remaining)}}</span></h2>
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
									<h2>
										<span class="defaultCurencyPay">&nbsp;
										<?php
											$pay_letter=($custom_remaining-$amount);
										?>
										@if($pay_letter<=1)
											0
											@else
											{{CustomHelpers::get_indian_currency($custom_remaining-$amount)}}
										@endif
										</span>
									</h2>
								</div>
							</div>

							@include('payment.paid_amount')

							@include('payment.pay_at_hotel')

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
$(document).on("click", ".pay", function() {
    var form = $('#save_booking_details');
    // Trigger HTML5 validity check.
    var reportValidity = form[0].reportValidity();
    // If form is valid, proceed with AJAX request.
    if (reportValidity) {
        var mode = $(this).attr('id');
        var APP_URL = jQuery("#base_url").val();

        $.ajax({
            url: APP_URL + '/check_mode',
            data: { mode: mode },
            type: 'get',
            // contentType: false,  // These options are commented out
            // processData: false,  // and can be removed if not needed.
            success: function(data) {
                if (data == 'error') {
                    alert('Something went wrong!!!');
                } else {
                    // Set form fields with data from the server.
                    $("#gateway").val('').val(data.mode);
                    $("#mdr").val('').val(data.mdr);
                    $("#mdr_gst").val('').val(data.mdr_gst);
                    $("#mode_id").val('').val(data.mode_id);
                    // Submit the form.
                    form.submit();
                }
            },
            error: function(xhr, status, error) {
                // Handle errors here.
            }
        });
    }
});

/*****************/

$(document).on("submit", "#save_booking_details", function (e) {
    e.preventDefault();
    var unique_code = $("#unique_code").val();

    if ($('#panacceptance').length > 0) {
        if ($('#panacceptance').is(':checked')) {
            var form = $('#save_booking_details')[0];
            var data = new FormData(form);
            var APP_URL = jQuery("#base_url").val();

            $.ajax({
                url: APP_URL + '/save_pan_details',
                data: data,
                type: 'post',
                contentType: false,
                processData: false,
                success: function (data) {
                    console.log(data);
                    var token = jQuery('input[name="_token"]').val();
                    var content_action = APP_URL + '/' + data.mode;
                    var form = document.createElement("form");
                    form.setAttribute("method", "post");
                    form.setAttribute("action", content_action);
                    form.setAttribute("target", "");

                    // Create hidden input fields
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

                    var third_field = document.createElement("input");
                    third_field.setAttribute("type", "hidden");
                    third_field.setAttribute("name", "unique_code");
                    third_field.setAttribute("value", unique_code);
                    form.appendChild(third_field);

                    var fourth_field = document.createElement("input");
                    fourth_field.setAttribute("type", "hidden");
                    fourth_field.setAttribute("name", "mode_id");
                    fourth_field.setAttribute("value", data.mode_id);
                    form.appendChild(fourth_field);

                    document.body.appendChild(form);
                    form.submit();
                },
                error: function (xhr, status, error) {
                    // Handle error
                }
            });
        } else {
            alert('Check Acknowledgement');
        }
    } else {
        var form = $('#save_booking_details')[0];
        var data = new FormData(form);
        var APP_URL = jQuery("#base_url").val();

        $.ajax({
            url: APP_URL + '/save_pan_details',
            data: data,
            type: 'post',
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data);
                var token = jQuery('input[name="_token"]').val();
                var content_action = APP_URL + '/' + data.mode;
                var form = document.createElement("form");
                form.setAttribute("method", "post");
                form.setAttribute("action", content_action);
                form.setAttribute("target", "");

                // Create hidden input fields
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

                var third_field = document.createElement("input");
                third_field.setAttribute("type", "hidden");
                third_field.setAttribute("name", "unique_code");
                third_field.setAttribute("value", unique_code);
                form.appendChild(third_field);

                var fourth_field = document.createElement("input");
                fourth_field.setAttribute("type", "hidden");
                fourth_field.setAttribute("name", "mode_id");
                fourth_field.setAttribute("value", data.mode_id);
                form.appendChild(fourth_field);

                document.body.appendChild(form);
                form.submit();
            },
            error: function (xhr, status, error) {
                // Handle error
            }
        });
    }
});
</script>
@endsection
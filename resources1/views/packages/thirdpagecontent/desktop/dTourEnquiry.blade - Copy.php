<style type="text/css">
/*Enquiry Main*/
.dAcceptTerms {
	display: flex;
    align-items: center;
	margin-bottom: 2px;
	}
.dAcceptTerms input[type=checkbox] {
	margin-top: 0;
	}
.dAcceptTerms h5 {
	font-size: 13px;
    line-height: 16px;
    color: #000001;
    font-weight: 500;
    margin-left: 5px;
	margin-bottom: 0;
	}
.enqTourImageBox {
	background-color: #f2f2f2;
    width: 100%;
    height: 300px;
    overflow: hidden;
    border-radius: 5px;
	position: relative;
	top: 20px;
	}
.enqTourImageBox img {
    width: 100%;
    height: 300px;
	}
.enqTourTitleBox {
	padding: 15px 0;
	background-color: #000001;
	opacity: .75;
	border-top: none;
	border-radius: 0px 0px 5px 5px;
	width: 100%;
	bottom: 0;
	position: absolute;
	}
.enqTourTitleBox h5 {
	font-size: 16px;
	line-height: 18px;
	color: #fff;
	font-weight: 900;
	text-align: center;
	margin-bottom: 0;
	}




.modalHeader_enq {
	padding: 15px 25px;
	background-color: #fff;
	color: #fff;
	border-bottom: 1px solid #e5e5e5;
	border-radius: 5px 5px 0 0;
	display: flex;
	align-items: baseline;
	justify-content: space-between;
	}
.modalHeader_enq h3, .ModalTitle {
    font-size: 24px;
	line-height: 26px;
    font-weight: 500;
    color: #000001;
	text-align: left;
	margin-bottom: 5px;
	}
.modalHeader_enq h4, .ModalTitleDaysBadge {
	font-size: 13px;
    line-height: 15px;
	font-weight: 400;
    color: #000001;
	text-align: left;
	margin-bottom: 0;
	display: inline-block;
    padding: 5px 7px;
    border-radius: 5px;
    background-color: #f2f2f2;
	}
.btnCloseModal, .btnCloseModal_destop, .btnCloseModal_desktop_cal {
    flex-shrink: 0;
    outline: 0;
    text-transform: uppercase;
    background: #fff;
    border: 0;
    padding: 0;
    font-size: 12px;
    line-height: 12px;
    color: #848889;
    font-weight: 700;
    cursor: pointer;
    text-align: center;
	text-shadow: 0 1px 0 #fff;
    filter: alpha(opacity=20);
    opacity: .2;
	-webkit-appearance: none;
	height: auto;
	}
.btnCloseModal:hover, .btnCloseModal_destop:hover, .btnCloseModal_desktop_cal:hover {
	background-color: #fff;
	color: #4a4a4a;
	opacity: .4;
	}
.modalBody_enq {
	position: relative;
	padding: 15px 15px 0;
	}
.modalBody_enq {
	/*padding: 15px 25px;*/
	}
.modalFooter_enq {
	padding: 0 0 30px;
	background-color: #fff;
	display: flex;
	justify-content: center;
	}
</style>

<div class="testing">
	<input type="hidden" value="{{ url('/') }}" name="" id="test">
</div>          
	<!-- Modal -->
	<div id="myModal_destop" class="modal">
		<!-- Modal content-->
		<div class="modalContent">
			<div class="modalHeader_enq flexBetween">
				<!--<h4 class="ModalTitle">Send your Enquiry & Get the Holiday planned by our experts{{ $details->title }}</h4>-->
				<div>
					<h3>{{ $details->title }}</h3>
					<h4>{{ $details->duration }} Nights / {{ $details->duration + 1 }} Days</h4>
				</div>
				<button type="button" class="btnMain btnCloseModal_destop">CLOSE &#10006;</button>
			</div>
			<!--Modal body-->
			<div class="modalBody_enq">
				<form action="#" method="Post" id="enquiry_form" name="enquiry_form">
				{{ csrf_field() }}
					<div class="alert alert-success" id="success-contaier" style="display: none">
					   <p>Thank You! Enquiry has been submitted, our experts will contact you shortly</p>
					</div>
					<input type="hidden" name="packageId" value="{{ $details->id }}" />
					<input type="hidden" name="package_name" value="{{ $details->title }}" />
					<!--Enq Fields-->
					<div class="row makeflex">
						<div class="col-md-8">
							<!--Service & Channel Type-->
							<div class="row d-none">
								<div class="col-md-6">
									<div class="form-group">
										<label for="name" class="formLabel">Service Type</label>
										<select class="formSelect" id="service_type" name="service_type">
											<option value="Tour Package" selected>Tour Package</option>
											<option value="Accommodation">Accommodation</option>
											<option value="Flight">Flight</option>
											<option value="Visa">Visa</option>
											<option value="Meals">Meals</option>
											<option value="Forex">Forex</option>
											<option value="Cruise">Cruise</option>
											<option value="Transfers">Transfers</option>
											<option value="Activity">Activity</option>
											<option value="Travel Insurance">Travel Insurance</option>
											<option value="Miscellaneous">Miscellaneous</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="email" class="formLabel">Channel Type</label>
										<select class="formSelect" id="channel_type" name="channel_type">
											<option value="B2C" selected>B2C</option>
											<option value="B2B">B2B</option>
											<option value="Corporate">Corporate</option>
										</select>
									</div>
								</div>
							</div>
							<!--Name & Email Id-->
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="name" class="formLabel">Full Name</label>
										<input class="formInput" type="text"  value="" name="name" id="name" placeholder="Enter Your Full Name" />
										<span class="error" id="name_error"></span>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="email" class="formLabel">Email ID</label>
										<input class="formInput" type="email"  value="" id="email" name="email" placeholder="Enter Your Email Id" />
										<span class="error" id="email_error"></span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12"></div>
							</div>
							<!--Mobile & Best Time to Call-->
							<div class="row">
								<!--<div class="col-md-6">
									<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="country_code" class="formLabel">Country Code</label>
											<select class="formSelect" value="" id="country_code" name="country_code"></select>
											<span class="error" id="country_code_error"></span>
										</div>
									</div>
									</div>
									<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="mobile" class="formLabel">Mobile No</label>
											<input class="formInput" type="text"  value="" name="mobile" id="mobile" placeholder="Enter Your Mobile No" />
											<span class="error" id="mobile_error"></span>
										</div>
									</div>
									</div>
								</div>-->
								<div class="col-md-6">
									<div class="form-group">
										<label for="mobile" class="formLabel">Mobile No</label>
										<div class="row">
											<div class="col-md-4">
												<select class="formSelect" value="" id="country_code" name="country_code"></select>
												<span class="error" id="country_code_error"></span>
											</div>
											<div class="col-md-8">
												<input class="formInput" type="text" value="" name="mobile" id="mobile" minlength="10" maxlength="10" placeholder="Enter Your Mobile No" />
												<span class="error" id="mobile_error"></span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="time_call" class="formLabel">Connect Time</label>
										<select class="formSelect" id="time_call" name="time_call">
											<option value="0">Select Time To Call</option>
											<option value="09 - 11 AM">Between 09 - 11 AM</option>
											<option value="11 - 01 PM">Between 11 - 01 PM</option>
											<option value="01 - 03 PM">Between 01 - 03 PM</option>
											<option value="03 - 05 PM">Between 03 - 05 PM</option>
											<option value="05 - 07 PM">Between 05 - 07 PM</option>
											<option value="07 - 09 PM">Between 07 - 09 PM</option>
										</select>
										<span class="error" id="time_call_error"></span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12"></div>
							</div>
							<!--Select Residence/Departure City & Nationality-->
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="city_of_residence" class="formLabel">Departure City</label>
										<input class="formInput" type="text" name="city_of_residence" id="city_of_residence" placeholder="Enter Departure City" />
										<span class="error" id="city_of_residence_error"></span>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="country_of_residence" class="formLabel">Nationality</label>
										<select class="formSelect" id="country_of_residence" name="country_of_residence"></select>
										<span class="error" id="country_of_residence_error"></span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12"></div>
							</div>
							<!--Arrival Date & Budget-->
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="date_arrival" class="formLabel">Travel Date</label>
										<input class="formInput" type="date" name="date_arrival" id="date_arrival" placeholder="Select Your Travel Date" />
										<!--<div class="formDate bfh-datepicker date_arrival" id="date_arrival" data-format="d/ m/ y" data-name="date_arrival" data-placeholder="Select Your Travel Date" data-date=""></div>-->
										<span class="error" id="date_arrival_error"></span>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="budget" class="formLabel">Budget <span class="font12 fontItalic">per person</span></label>
										<div style="position: relative">
										<div class="budgetBox">
											<!--<div class="" style="padding: 7px 15px;background-color: #ffffff">&#8377;</div>-->
											<div class="fmCurrencyBox defaultCurency"></div>
											<input class="formInput_budget" type="text" id="budget" value="" name="exp_budget" placeholder="Enter Your Expected Budget"
											@if($details->onrequest == 1)
											@else
												@if(CustomHelpers::get_price($details->id)=="On Request")
												@else
													value="Rs {{ CustomHelpers::get_price($details->id) }}"
												@endif
											@endif />
										</div>
										<div class="budgetPriceBarBox" style="position: absolute;z-index: 1;background: #fff;padding: 20px 20px 10px;width: 100%;display: none;">
											<div id="price-ranges" class="budgetSlider"></div>
											<div class="rangeSection" style="display: flex;justify-content: space-between;margin-top: 10px;">
												<span class="min-price-label defaulCurrency_slider"></span>
												<span>&#8212;</span>
												<span class="max-price-label defaulCurrency_slider"></span>
											</div>
										</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12"></div>
							</div>
							<!--Your Destination & Duration (Hidden)-->
							<div class="row d-none">
								<div class="col-md-6">
									<div class="form-group">
										<label for="destinations" class="formLabel">Destination</label>
										<input class="formInput" type="text" value="{{ $details->title }}" id="destinations" name="destinations" placeholder="Enter Your Destination" style="background: #f2f2f2;" readonly />
										<span class="error" id="destinations_error"></span>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="duration" class="formLabel">Duration</label>
										<input class="formInput" type="text" value="{{ $details->duration + 1 }} Days" name="duration" id="duration" placeholder="Enter Duration" style="background: #f2f2f2;" readonly />
									</div>
								</div>
							</div>
							<!--Preferred Category-->
							<div class="row">
								<div class="col-md-12 guestCont">
								<div class="travellerLabelBox">
									<label for="travellers" class="formLabel">Hotel Preference</label>
								</div>
								<div class="hotelPref">
									<label class=""><input type="radio" value="3" name="hotel_pre">3 Star</label>
									<label class=""><input type="radio" value="4" name="hotel_pre" checked="checked">4 Star</label>
									<label class=""><input type="radio" value="5" name="hotel_pre">5 Star</label>
								</div>
								</div>
							</div>
							<!--No of Traveller-->
							<div class="row">
								<div class="col-md-12 guestCont">
									<div class="travellerLabelBox">
										<label for="travellers" class="formLabel">No of Travellers</label>
									</div>
									<div class="flexCenter">
										<div class="flex-column appendRight20">
											<input type="hidden" id="travellers" name="span_value_adult" class="span_value_adult1" value="2" />
											<div class="flexCenter">
												<span class="guestMinus span_des_adult">&#8722;</span>
												<span class="guestValue span_value_adult">2</span>
												<span class="guestPlus span_inc_adult">&#43;</span>
											</div>
											<div class="guestType">Adult (+12yrs)</div>
										</div>
										<div class="flex-column appendRight20">
											<input type="hidden" id="travellers" name="span_value_child" class="span_value_child1" value="0" />
											<div class="flexCenter">
												<span class="guestMinus span_des_child">&#8722;</span>
												<span class="guestValue span_value_child">0</span>
												<span class="guestPlus span_inc_child">&#43;</span>
											</div>
											<div class="guestType">Child (2-12yrs)</div>
										</div>
										<div class="flex-column">
											<input type="hidden" id="travellers" name="span_value_infant" class="span_value_infant1" value="0" />
											<div class="flexCenter">
												<span class="guestMinus span_des_infant">&#8722;</span>
												<span class="guestValue span_value_infant">0</span>
												<span class="guestPlus span_inc_infant">&#43;</span>
											</div>
											<div class="guestType">Infant (0-2yrs)</div>
										</div>
									</div>
								</div>
							</div>
							<!--Child Extra Bed-->
							<div class="row childExtraBed" style="display: none;">
								<div class="col-md-12 guestCont">
									<div class="travellerLabelBox">
										<label for="travellers" class="formLabel">Child Extra Bed</label>
									</div>
									<div class="flexCenter">
										<div class="flex-column">
											<input type="hidden" id="travellers" name="span_value_infant" class="span_value_infant1" value="0" />
											<div class="flexCenter">
												<span class="guestMinus span_des_infant">&#8722;</span>
												<span class="guestValue span_value_infant">0</span>
												<span class="guestPlus span_inc_infant">&#43;</span>
											</div>
											<div class="guestType">Extra Bed</div>
										</div>
									</div>
								</div>
							</div>
							<!--Remarks-->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="additionaletails" class="formLabel">Additional details</label>
										<div class="addOnDtlsCont">
											<label for="flightbooked"><input type="checkbox" id="flightbooked" name="flightbooked" class="additional_details" value="Flight Ticket Booked">Flights Booked</label>
											<label for="addontours"><input type="checkbox" class="additional_details" id="addontours" name="addontours" value="Add-on Tours Required">Add-on Tours</label>
											<label for="earlycheckin"><input type="checkbox" class="additional_details" id="earlycheckin" name="earlycheckin" value="Early Check-in (subject to availability)">Early Check-in</label>
											<label for="childbed"><input type="checkbox" class="additional_details" id="childbed" name="childbed" value="1 Extra Bed Required for Child">Child Extra Bed</label>
											<label for="honeymoonfreebies"><input type="checkbox" class="additional_details" id="honeymoonfreebies" name="honeymoonfreebies" value="Honeymoon Freebies">Honeymoon Freebies</label>
										</div>
										<textarea class="formTextarea" type="text" id="additionaletails" name="message" placeholder="Provide us additional details, like multiple destinations, add-on tours, any other preferences, etc."></textarea>
									</div>
								</div>
							</div>
							<!--Accept Privacy Policy-->
							<div class="row">
								<div class="col-md-12">
									<div class="dAcceptTerms">
										<input type="checkbox" value="0" id="accept_value" name="accept_value" />
										<h5>I here by accept the <a href="{{ URL::to('/Privacy-Policy') }}" target="_blank">
										<span class="color008 fontWeight600">Privacy Policy</span></a> and authorize @if(env("WEBSITENAME")==1)The World Gateway @elseif(env("WEBSITENAME")==0)Rapidex Travels @endif team to contact me.</h5>
									</div>
									<span class="error" id="accept_value_error"></span>
								</div>
							</div>
							</div>
						<!--Sidebar Tour Image-->
						<div class="col-md-4">
							<div class="enqTourImageBox">
								@if(count($images)>0)
									@php
										$img_data=$images->first()->image_path;
									@endphp
								@else
									@php
										$img_data="/uploads/default_profile_image.png";
									@endphp
								@endif
								<?php $gallery_id=CustomHelpers::get_first_galleryid($id); ?>
								@if(CustomHelpers::get_imgpath_gallery($gallery_id,'image_path')!="0")
									<img src="{{ URL::to('/').'/public/'.CustomHelpers::get_imgpath_gallery($gallery_id,'image_path') }}">
								@elseif(CustomHelpers::get_imgpath_gallery($gallery_id,'image_path')=="0")
									<img src="{{ URL::to('/').'/public/uploads/default_profile_image.png' }}">
								@endif
								<div class="enqTourTitleBox">
									<h5>{{ $details->title }}</h5>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modalFooter_enq">
					<input type="submit" class="btnMain btnSubmitEnq" name="submit" value="Get a Callback" />
				</div>
				</form>
		</div>
	</div>
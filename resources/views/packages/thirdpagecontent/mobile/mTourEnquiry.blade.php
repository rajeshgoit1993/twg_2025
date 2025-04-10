		<!--Mobile Tour Enquiry Starts-->
		<!-- Modal -->
		<div id="enquiryModal_mobile" class="modal">
			<!-- Modal content-->
			<div class="m_enq_modalContent m_enq_modalContent_size">
				<div class="m_enq_modalHeader flexBetween">
					<!--<h4 class="ModalTitle">Send your Enquiry & Get the Holiday planned by our experts{{ $details->title }}</h4>-->
					<div>
						<h3>{{ $details->title }}</h3>
						<h4>{{ $details->duration }} Nights / {{ $details->duration + 1 }} Days</h4>
					</div>
					<button type="button" class="btnMain btnCloseModal">CLOSE &#10006;</button>
				</div>
				<!--Modal body-->
				<div class="m_enq_modalBody">
					<form action="#" method="Post" id="enquiry_form_mob" name="enquiry_form_mob">
						{{ csrf_field() }}
						<!--<div class="alert alert-success" id="success-contaier" style="display: none">
						   <p>Thank You! Enquiry has been submitted, our experts will contact you shortly</p>
						</div>-->
						<input type="hidden" name="packageId" value="{{ $details->id }}" />
						<input type="hidden" name="package_name" value="{{ $details->title }}" />
						<!--Enq Fields-->
						<div class="makeflex">
							<div class="enq_leftSection">

								<div class="row">
									<div class="d-none">
										<!-- service type -->
										<div class="col-md-6">
											<div class="form-group">
												<label for="service_type" class="formLabel selectArrow">Service Type</label>
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

										<!-- channel type -->
										<div class="col-md-6">
											<div class="form-group">
												<label for="channel_type" class="formLabel selectArrow">Channel Type</label>
												<select class="formSelect" id="channel_type" name="channel_type">
													<option value="B2C" selected>B2C</option>
													<option value="B2B">B2B</option>
													<option value="Corporate">Corporate</option>
												</select>
											</div>
										</div>
									</div>								

									<!--Name-->
									<div class="col-md-6">
										<div class="form-group">
											<label for="name" class="formLabel">Full Name</label>
											<input class="formInput" type="text"  value="" name="name" id="name" placeholder="Enter Your Full Name" />
											<span class="error" id="name_error"></span>
										</div>
									</div>

									<!--Email Id-->
									<div class="col-md-6">
										<div class="form-group">
											<label for="email" class="formLabel">Email ID</label>
											<input class="formInput" type="email"  value="" id="email" name="email" placeholder="Enter Your Email Id" />
											<span class="error" id="email_error"></span>
										</div>
									</div>

									<div class="col-md-12"></div>

									<!--Mobile-->
									<div class="col-md-6">
										<div class="form-group">
											<!--<label for="mobile" class="formLabel">Mobile No</label>-->
											<div class="makeflex">
												<div class="col-md-4 col-sm-4" style="padding: 0;">
													<label for="country_code" class="formLabel selectArrow">Country Code</label>
													<select class="formSelect" value="" id="country_code_mobile" name="country_code"></select>
													<span class="error" id="country_code_error"></span>
												</div>
												<div class="col-md-8 col-sm-8  fullWidth" style="padding-right: 0;">
													<label for="mobile" class="formLabel">Mobile No</label>
													<input class="formInput" type="text" value="" name="mobile" id="mobile" minlength="10" maxlength="10" placeholder="Enter Your Mobile No" />
													<span class="error" id="mobile_error"></span>
												</div>
											</div>
										</div>
									</div>

									<!--Best Time to Call-->
									<div class="col-md-6">
										<div class="form-group">
											<label for="time_call" class="formLabel selectArrow">Connect Time</label>
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

									<div class="col-md-12"></div>

									<!--Departure City-->
									<div class="col-md-6">
										<div class="form-group">
											<label for="city_of_residence" class="formLabel">Departure City</label>
											<input class="formInput" type="text" name="city_of_residence" id="city_of_residence" placeholder="Enter Departure City" />
											<span class="error" id="city_of_residence_error"></span>
										</div>
									</div>

									<!--Nationality-->
									<div class="col-md-6">
										<div class="form-group">
											<label for="country_of_residence" class="formLabel selectArrow">Nationality</label>
											<select class="formSelect" id="country_of_residence_mobile" name="country_of_residence"></select>
											<span class="error" id="country_of_residence_error"></span>
										</div>
									</div>

									<div class="col-md-12"></div>

									<!--Arrival Date-->
									<div class="col-md-6">
										<div class="form-group">
											<label for="travel_date_modal_mobile_enquiry" class="formLabel selectArrow">Travel Date</label>
											<input class="formInput" type="text" name="date_arrival" id="travel_date_modal_mobile_enquiry" placeholder="Select Your Travel Date" />
											<!--<div class="formDate bfh-datepicker date_arrival" id="date_arrival" data-format="d/ m/ y" data-name="date_arrival" data-placeholder="Select Your Travel Date" data-date=""></div>-->
											<span class="error" id="date_arrival_error"></span>
										</div>
									</div>

									<!--Budget-->
									<div class="col-md-6">
										<div class="form-group">
											<!-- <label for="budget" class="formLabel">Budget <span class="font12 fontItalic">per person</span></label> -->
											<label for="exp_budget" class="formLabel selectArrow">Budget&nbsp;<span class="font12 fontItalic">per person</span></label>
											<div class="relativeCont appendBottom20">
												<!-- <div class="budgetBox">
													<div class="defaultCurrency fmCurrencyBox"></div>
													<input class="formInput_budget" type="text" id="budget" value="" name="exp_budget" placeholder="Enter Your Budget"
													@if($details->onrequest == 1)
													@else
														@if(CustomHelpers::get_price($details->id)=="On Request")
														@else
															value="Rs {{ CustomHelpers::get_price($details->id) }}"
														@endif
													@endif />
												</div>
												<div class="budgetPriceBarBox" style="display: none">
													<div id="price-ranges" class="budgetSlider"></div>
													<div class="rangeSection">
														<span class="min-price-label defaulCurrency_slider"></span>
														<span>&#8212;</span>
														<span class="max-price-label defaulCurrency_slider"></span>
													</div>
												</div> -->
												<div class="budgetBox icon-input-group" tabindex="0">
													<div class="icon-input-group-addon">
														<span class="rupee-container" aria-hidden="true"></span>
													</div>
													<!-- <div class="defaultCurrency fmCurrencyBox"></div> -->
													<input class="formInput_budget" type="text" id="exp_budget" name="exp_budget" placeholder="Select your budget" style="border: none;" readonly 
													@if($details->onrequest == 1)
													@else
														@if(CustomHelpers::get_price($details->id)=="On Request")
														@else
															value="Rs {{ CustomHelpers::get_price($details->id) }}"
														@endif
													@endif />
												</div>
												<div class="budgetPriceBarBox" id="budgetSliderContainer" style="display: none;">
													<input type="range" min="3000" max="300000" value="3000" class="budgetSlider" id="budgetSlider">
													<div class="rangeSection">
														<span class="min-price-label defaulCurrency_slider">&nbsp;3,000</span>
														<span class="max-price-label defaulCurrency_slider">&nbsp;300,000</span>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="col-md-12"></div>

									<!--Your Destination & Duration (Hidden)-->
									<div class="d-none">
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

									<!-- --------- -->

									<!-- Flight Booking Preference -->
									<div class="col-md-12">
										<div class="guestInputCont">
											<label for="flightbookingpreference">Have you booked the flight tickets?</label>
											<div class="flightPref">
												<label class="preference-selection" tabindex="0">
												<input type="radio" value="0" name="flight_booking" tabindex="0">Yes
											</label>
											<label class="preference-selection" tabindex="0">
												<input type="radio" value="1" name="flight_booking" tabindex="0">No
											</label>
											</div>
										</div>
									</div>	

									<div class="col-md-12"></div>
									
									<!-- --------- -->

									<!--Preferred Category-->
									<!-- <div class="">
										<div class="col-md-12 mGuestCont">
										<div class="travellerLabelBox">
												<label for="travellers" class="formLabel">Hotel Preference</label>
											</div>
										<div class="hotelPref">
											<label><input type="radio" value="3" name="hotel_pre">3 Star</label>
											<label><input type="radio" value="4" name="hotel_pre" checked="checked">4 Star</label>
											<label><input type="radio" value="5" name="hotel_pre">5 Star</label>
										</div>
										</div>
									</div> -->

									<!--Preferred Category-->
										<div class="col-md-12">
											<div class="guestInputCont">
												<label for="hotelpreference">Hotel Preference</label>
												<div class="hotelPref">
													<label class="hotel-selection" tabindex="0">
														<input type="radio" value="3" name="hotel_pre" tabindex="0">3 Star
													</label>
													<label class="hotel-selection selected-item" tabindex="0">
														<input type="radio" value="4" name="hotel_pre" tabindex="0">4 Star
													</label>
													<label class="hotel-selection" tabindex="0">
														<input type="radio" value="5" name="hotel_pre" tabindex="0">5 Star
													</label>
												</div>
												<span class="inputError" id="hotelpreference_error"></span>
											</div>
										</div>

									<!--No of Traveller-->
									<div class="col-md-12">
										<label for="travellers" class="formLabel apndTop20">No of Travellers</label>
										<div class="mGuestCont mobscroll scrollX" style="overflow: auto;">
										<div class="makeflex">
											<div class="flex-column appendRight20">
												<input type="hidden" id="travellers" name="span_value_adult" class="span_value_adult1" value="2" />
												<div class="flexCenter">
													<span class="guestMinus span_des_adult m_cursor">&#8722;</span>
													<span class="guestValue span_value_adult ">2</span>
													<span class="guestPlus span_inc_adult m_cursor">&#43;</span>
												</div>
												<div class="guestType">Adults<div>(+12yrs)</div></div>
											</div>
											<div class="flex-column appendRight20">
												<input type="hidden" id="travellers" name="span_value_child" class="span_value_child1" value="0" />
												<div class="flexCenter">
													<span class="guestMinus span_des_child m_cursor">&#8722;</span>
													<span class="guestValue span_value_child">0</span>
													<span class="guestPlus span_inc_child m_cursor">&#43;</span>
												</div>
												<div class="guestType">Child with bed<div>(2-12yrs)</div></div>
											</div>
											<div class="flex-column appendRight20">
												<input type="hidden" id="travellers" name="span_value_child_without_bed" class="span_value_child1_without_bed" value="0" />
												<div class="flexCenter">
													<span class="guestMinus span_des_child_without_bed m_cursor">&#8722;</span>
													<span class="guestValue span_value_child_without_bed">0</span>
													<span class="guestPlus span_inc_child_without_bed m_cursor">&#43;</span>
												</div>
												<div class="guestType">Child without bed<div>(2-12yrs)</div></div>
											</div>
											<div class="flex-column">
												<input type="hidden" id="travellers" name="span_value_infant" class="span_value_infant1" value="0" />
												<div class="flexCenter">
													<span class="guestMinus span_des_infant m_cursor">&#8722;</span>
													<span class="guestValue span_value_infant m_cursor">0</span>
													<span class="guestPlus span_inc_infant m_cursor">&#43;</span>
												</div>
												<div class="guestType">Infant<div>(0-2yrs)</div></div>
											</div>
										</div>
										</div>
									</div>

									<!--Remarks-->
									<!-- <div class="">
										<div class="col-md-12">
											<div class="form-group">
												<label for="additionaletails" class="formLabel">Additional details</label>
												<div class="addOnDtlsCont mobscroll scrollX" style="overflow: auto;">
													<label for="mflightbooked"><input type="checkbox" id="mflightbooked" name="mflightbooked" class="additional_details" value="Flight Ticket Booked">Flights Booked</label>
													
													<label for="maddontours"><input type="checkbox" class="additional_details" id="maddontours" name="maddontours" value="Add-on Tours Required">Add-on Tours</label>
													
													<label for="mearlycheckin"><input type="checkbox" class="additional_details" id="mearlycheckin" name="mearlycheckin" value="Early Check-in (subject to availability)">Early Check-in</label>
													
													!--<label for="mchildbed"><input type="checkbox" class="additional_details" id="mchildbed" name="mchildbed" value="1 Extra Bed Required for Child">Child Extra Bed</label>--
													
													<label for="mhoneymoonfreebies"><input type="checkbox" class="additional_details" id="mhoneymoonfreebies" name="mhoneymoonfreebies" value="Honeymoon Freebies">Honeymoon Freebies</label>
												</div>
												<textarea class="formTextarea" type="text" id="additionaletails_mobile" name="message" placeholder="Provide us additional details, like multiple destinations, add-on tours, any other preferences, etc."></textarea>
											</div>
										</div>
									</div> -->

									<!--Remarks-->
									<div class="col-md-12">
										<div class="guestInputCont appendTop5 appendBtm20">
											<label for="additionaldetails_mobile">Additional Request&nbsp;
												<span class="colorA1 d-none">(subject to availability)</span>
											</label>
											<div id="tourAdtnlDtls">
												<div class="addOnDtlsCont mobscroll scrollX">
													<label class="checkmarkCont">
														<input type="checkbox" class="additional_details" value="Family Tour">
														<span class="checkmark addOn-services"></span>
														<span class="addOn-services-text">Family Tour</span>
													</label>
													<label class="checkmarkCont">
														<input type="checkbox" class="additional_details" value="Leisure Tour">
														<span class="checkmark addOn-services"></span>
														<span class="addOn-services-text">Leisure Tour</span>
													</label>
													<label class="checkmarkCont">
														<input type="checkbox" class="additional_details" value="Honeymoon Tour">
														<span class="checkmark addOn-services"></span>
														<span class="addOn-services-text">Honeymoon Tour</span>
													</label>
													<label class="checkmarkCont">
														<input type="checkbox" class="additional_details" value="Business Tour">
														<span class="checkmark addOn-services"></span>
														<span class="addOn-services-text">Business Tour</span>
													</label>
												</div>
											</div>
											<textarea class="formTextarea" type="text" id="additionaldetails_mobile" name="message" placeholder="Enter additional requests (if any)"></textarea>
										</div>
									</div>

									<!--Accept Privacy Policy-->
									<!-- <div class="">
										<div class="col-md-12">
											<div class="mAcceptTerms">
												<input type="checkbox" value="0" id="accept_value_mob" name="accept_value" />
												<span class="mAcceptTermsStatement">I here by accept the <a href="{{ URL::to('/Privacy-Policy') }}" target="_blank">
												<span class="color008 fontWeight600">Privacy Policy</span></a> and authorize @if(env("WEBSITENAME")==1)The World Gateway @elseif(env("WEBSITENAME")==0)Rapidex Travels @endif team to contact me.</span>
											</div>
											<span class="error" id="accept_value_error"></span>
										</div>
									</div> -->

									<!--Accept Privacy Policy-->
									<div class="col-md-12">
										<div class="mAcceptTerms">
											<label class="checkmarkCont wrapper">
												<input type="checkbox" value="0" id="accept_value_mob" name="accept_value" />
												<span class="checkmark signup-acceptance"></span>
												@php
													$websiteData = getWebsiteData();
												@endphp
												<h5>I here by accept the 
													<a href="{{ route('privacyPolicy') }}" target="_blank" class="link-color">
														<b>Privacy Policy</b>
													</a> 
														and authorize {{ getWebsiteData('name') }} team to contact me.
												</h5>
											</label>
										</div>
										<div>
											<span class="error" id="accept_value_error"></span>
										</div>
									</div>

								</div>
							</div>
						</div>
				
					<div class="m_enq_modalFooter">
						<input type="submit" class="mBtnSubmitEnq" name="submit" value="Get a Callback" />
					</div>
					</div>
				</form>
			</div>
		</div>
		<!--Mobile Tour Enquiry Ends-->
	<!-- Calendar Enquiry Starts -->
	<!-- Modal -->
	<div id="queryHandler_cal" class="modal">
		<div class="">
			<!-- Modal content-->
			<div class="modalContent">
				<div class="modalHeader_enq flexBetween">
					<h4 class="ModalTitle">{{ $details->title }} <span class="ModalTitleDaysBadge">({{ $details->duration }} Nights / {{ $details->duration + 1 }} Days)</span></h4>
					<button type="button" class="btnMain btnCloseModal btnCloseModal_mobile_cal">CLOSE &#10006;</button>
				</div>
				<!--Modal body-->
				<div class="modalBody_enq">
				<form action="#" method="Post" id="enquiry_form_cal" name="enquiry_form_cal">
				{{csrf_field()}}
					<div class="alert alert-success" id="success-contaier" style="display:none">
						<p>Thank You! Your query has been submitted.</p>
					</div>
				<input type="hidden" name="packageId" value="{{$details->id}}">
				<input type="hidden" name="package_name" value="{{$details->title}}">
				<!--Enq Fields-->
				<div class="fmRow makeflex">
					<div class="fm-md-8">
						<!--Service & Channel Type-->
						<div class="fmRow" style="display: ">
							<div class="fm-md-6">
								<div class="formGroup">
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
							<div class="fm-md-6">
								<div class="formGroup">
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
						<div class="fmRow">
							<div class="fm-md-6">
								<div class="formGroup">
									<label for="name" class="formLabel">Full Name</label>
									<input class="formInput" type="text"  value="" name="name" id="name_cal" placeholder="Enter Your Full Name" />
									<span class="error" id="name_error_cal"></span>
								</div>
							</div>
							<div class="fm-md-6">
								<div class="formGroup">
									<label for="email" class="formLabel">Email ID</label>
									<input class="formInput" type="email"  value="" id="email_cal" name="email" placeholder="Enter Your Email Id" />
									<span class="error" id="email_error_cal"></span>
								</div>
							</div>
							</div>
							<div class="fmRow">
								<div class="fm-md-12"></div>
							</div>
							<!--Mobile & Best Time to Call-->
							<div class="fmRow">
								<div class="fm-md-6">
									<div class="fmRow">
									<div class="fm-md-6">
										<div class="formGroup">
											<label for="country_code" class="formLabel">Country Code</label>
											<select class="formSelect" value="" id="country_code_cal" name="country_code"></select>
											<span class="error" id="country_code_error"></span>
										</div>
									</div>
									</div>
									<div class="fmRow">
										<div class="fm-md-6">
										<div class="formGroup">
											<label for="mobile" class="formLabel">Mobile No</label>
												<input class="formInput" type="text"  value="" name="mobile" id="mobile_cal" placeholder="Enter Your Mobile No" />
											<span class="error" id="mobile_error_cal"></span>
										</div>
									</div>
										</div>
									</div>
								<div class="fm-md-6">
									<div class="formGroup">
										<label for="time_call" class="formLabel">Connect Time</label>
										<select class="formSelect" id="time_call_cal" name="time_call">
											<option value="0">Select Time To Call</option>
											<option value="09 - 11 AM">Between 09 - 11 AM</option>
											<option value="11 - 01 PM">Between 11 - 01 PM</option>
											<option value="01 - 03 PM">Between 01 - 03 PM</option>
											<option value="03 - 05 PM">Between 03 - 05 PM</option>
											<option value="05 - 07 PM">Between 05 - 07 PM</option>
											<option value="07 - 09 PM">Between 07 - 09 PM</option>
										</select>
										<span class="error" id="time_call_error_cal"></span>
									</div>
								</div>
							</div>
							<div class="fmRow">
								<div class="fm-md-12"></div>
							</div>
							<!--Select Residence/Departure City & Nationality-->
							<div class="fmRow">
								<div class="fm-md-6">
									<div class="formGroup">
										<label for="city_of_residence" class="formLabel">Departure City</label>
										<input class="formInput" type="text" name="city_of_residence" id="city_of_residence_cal" placeholder="Enter Departure City" />
										<span class="error" id="city_of_residence_error_cal"></span>
									</div>
								</div>
								<div class="fm-md-6">
									<div class="formGroup">
										<label for="country_of_residence" class="formLabel">Nationality</label>
										<select class="formSelect" id="country_of_residence_cal" name="country_of_residence"></select>
										<span class="error" id="country_of_residence_error_cal"></span>
									</div>
								</div>
							</div>
							<div class="fmRow">
								<div class="fm-md-12"></div>
							</div>
							<!--Arrival Date & Budget-->
							<div class="fmRow">
								<div class="fm-md-6">
									<div class="formGroup">
										<label for="date_arrival" class="formLabel">Travel Date</label>
										<input class="formInput" type="text" name="date_arrival" id="date_arrival_cal" placeholder="Select Your Travel Date" />
										<!--<div class="formDate bfh-datepicker date_arrival" id="date_arrival" data-format="d/ m/ y" data-name="date_arrival" data-placeholder="Select our Travel Date" data-date=""></div>-->
										<span class="error" id="date_arrival_error_cal"></span>
									</div>
								</div>
								<div class="fm-md-6">
									<div class="formGroup">
										<label for="budget" class="formLabel">Budget <span class="font12 fontItalic">per person</span></label>
										<div style="position: relative">
										<div class="budgetBox">
											<!--<div class="" style="padding: 7px 15px;background-color: #ffffff">&#8377;</div>-->
											<div class="fmCurrencyBox defaultCurency"></div>
											<input class="formInput_budget" type="text" id="exp_budget_cal" value="" name="exp_budget" placeholder="Enter Your Expected Budget"
											@if($details->onrequest == 1)
											@else
												@if(CustomHelpers::get_price($details->id)=="On Request")
												@else
													value="Rs {{ CustomHelpers::get_price($details->id) }}"
												@endif
											@endif readonly />
										</div>
										<!--<div class="budgetPriceBarBox" style="position: absolute;z-index: 1;background: #fff;padding: 20px 20px 10px;width: 100%;display: none;">
											<div id="price-ranges" class="budgetSlider"></div>
											<div class="rangeSection" style="display: flex;justify-content: space-between;margin-top: 10px;">
												<span class="min-price-label defaulCurrency_slider"></span>
												<span>&#8212;</span>
												<span class="max-price-label defaulCurrency_slider"></span>
											</div>
										</div>-->
										</div>
									</div>
								</div>
							</div>
							<div class="fmRow">
								<div class="fm-md-12"></div>
							</div>
							<!--Your Destination & Duration (Hidden)-->
							<div class="fmRow">
								<div class="fm-md-6">
									<div class="formGroup">
										<label for="destination" class="formLabel">Destination</label>
										<input class="formInput" type="text" value="{{ $details->title }}" id="destinations" name="destinations" placeholder="Enter Your Destination" style="background: #f2f2f2;" readonly />
										<span class="error" id="destinations_error_cal"></span>
									</div>
								</div>
								<div class="col-md-6">
									<div class="formGroup">
										<label for="duration" class="formLabel">Duration</label>
										<input class="formInput" type="text" value="{{ $details->duration + 1 }} Days" name="duration" id="duration" placeholder="Enter Duration" style="background: #f2f2f2;" readonly />
									</div>
								</div>
							</div>
							<!--Preferred Category-->
							<div class="fmRow">
								<div class="fm-md-12 guestCont">
								<div class="travellerLabelBox">
									<label for="travellers" class="formLabel">Preference</label>
								</div>
									<div class="hotelPref">
									<input class="formInput" type="text" value="" id="hotel_pre" name="hotel_pre" placeholder="Select your hotel preference" style="background: #f2f2f2;" readonly />
								</div>
								</div>
							</div>
							<!--No of Traveller-->
							<div class="fmRow">
								<div class="fm-md-12 guestCont">
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
							<!--Remarks-->
							<div class="fmRow">
								<div class="fm-md-12">
									<div class="formGroup">
										<label for="additionaletails" class="formLabel">Additional details</label>
									<div class="addOnDtlsCont">
											<label for="flightbooked_cal"><input type="checkbox" id="flightbooked_cal" name="flightbooked" class="additional_details" value="Flight Ticket Booked">Flights Booked</label>
											<label for="addontours_cal"><input type="checkbox" class="additional_details" id="addontours_cal" name="addontours" value="Add-on Tours Required">Add-on Tours</label>
											<label for="earlycheckin_cal"><input type="checkbox" class="additional_details" id="earlycheckin_cal" name="earlycheckin" value="Early Check-in (subject to availability)">Early Check-in</label>
											<!--<label for="childbed_cal"><input type="checkbox" class="additional_details" id="childbed_cal" name="childbed" value="1 Extra Bed Required for Child">Child Extra Bed</label>-->
											<label for="honeymoonfreebies_cal"><input type="checkbox" class="additional_details" id="honeymoonfreebies_cal" name="honeymoonfreebies" value="Honeymoon Freebies">Honeymoon Freebies</label>
										</div>
										<textarea class="formTextarea" type="text" id="additionaletails_cal" name="message" placeholder="Provide us additional details, like multiple destinations, add-on tours, any other preferences, etc."></textarea>
									</div>
								</div>
							</div>
							<!--Accept Privacy Policy-->
							<div class="fmRow">
								<div class="fm-md-12">
									<div class="dAcceptTerms">
										<input type="checkbox" value="0" id="accept_value_cal" name="accept_value">
										<h5>I here by accept the <a href="{{ URL::to('/Privacy-Policy') }}" target="_blank">
										<span class="color008 fontWeight600">Privacy Policy</span></a> and authorize @if(env("WEBSITENAME")==1)The World Gateway @elseif(env("WEBSITENAME")==0)Rapidex Travels @endif team to contact me.</h5>
									</div>
									<span class="error" id="accept_value_error_cal"></span>
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
	</div>
	<!-- Calendar Enquiry Ends -->
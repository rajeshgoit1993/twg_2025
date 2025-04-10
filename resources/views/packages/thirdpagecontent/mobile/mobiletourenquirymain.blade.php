<div class="testing">
	<input type="hidden" value="{{ url('/') }}" name="" id="test">
</div>          
<!-- Modal -->
	<div id="myModal" class="modal mobscroll">
		<!-- Modal content-->
		<div class="modalContent">
			<div class="modalHeader_enq flexBetween">
				<!--<h4 class="ModalTitle">Send your Enquiry & Get the Holiday planned by our experts{{ $details->title }}</h4>-->
				<div>
					<h3>{{ $details->title }}</h3>
					<h4>({{ $details->duration }} Nights / {{ $details->duration + 1 }} Days)</h4>
				</div>
				<button type="button" class="btnMain btnCloseModal">CLOSE &#10006;</button>
			</div>
			<!--Modal body-->
			<div class="modalBody_enq">
				<form action="#" method="Post" id="enquiry_form_mob" name="enquiry_form_mob">
				{{ csrf_field() }}
					<div class="alert alert-success" id="success-contaier" style="display: none">
					   <p>Thank You! Enquiry has been submitted, our experts will contact you shortly</p>
					</div>
					<input type="hidden" name="packageId" value="{{ $details->id }}" />
					<input type="hidden" name="package_name" value="{{ $details->title }}" />
					<!--Enq Fields-->
					<div class="row">
						<div class="col-md-12">
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
								<div class="col-md-6">
									<div class="form-group">
										<label for="mobile" class="formLabel">Mobile No</label>
										<div class="makeflex">
											<div class="col-md-4 col-sm-4" style="padding: 0;">
												<select class="formSelect" value="" id="country_code_mobile" name="country_code"></select>
												<span class="error" id="country_code_error"></span>
											</div>
											<div class="col-md-8 col-sm-8  fullWidth" style="padding-right: 0;">
												<input class="formInput" type="text" value="" name="mobile" id="mobile" minlength="10" maxlength="10" placeholder="Enter Your Mobile No" />
												<span class="error" id="mobile_error"></span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
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
										<select class="formSelect" id="country_of_residence_mobile" name="country_of_residence"></select>
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
										<div class="budgetBox">
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
										<div class="budgetPriceBarBox" style="display: none">
											<div id="price-ranges" class="budgetSlider"></div>
											<div class="rangeSection">
												<span class="min-price-label defaulCurrency_slider"></span>
												<span>&#8212;</span>
												<span class="max-price-label defaulCurrency_slider"></span>
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
								<div class="col-md-12 mGuestCont">
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
								<div class="col-md-12">
										<label for="travellers" class="formLabel">No of Travellers</label>
									</div>
								<div class="col-md-12 mGuestCont mobscroll" style="overflow: auto;">
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
										<div class="addOnDtlsCont mobscroll" style="overflow: auto;">
											<label for="mflightbooked"><input type="checkbox" id="mflightbooked" name="mflightbooked" class="additional_details" value="Flight Ticket Booked">Flights Booked</label>
											<label for="maddontours"><input type="checkbox" class="additional_details" id="maddontours" name="maddontours" value="Add-on Tours Required">Add-on Tours</label>
											<label for="mearlycheckin"><input type="checkbox" class="additional_details" id="mearlycheckin" name="mearlycheckin" value="Early Check-in (subject to availability)">Early Check-in</label>
											<label for="mchildbed"><input type="checkbox" class="additional_details" id="mchildbed" name="mchildbed" value="1 Extra Bed Required for Child">Child Extra Bed</label>
											<label for="mhoneymoonfreebies"><input type="checkbox" class="additional_details" id="mhoneymoonfreebies" name="mhoneymoonfreebies" value="Honeymoon Freebies">Honeymoon Freebies</label>
										</div>
										<textarea class="formTextarea" type="text" id="additionaletails_mobile" name="message" placeholder="Provide us additional details, like multiple destinations, add-on tours, any other preferences, etc."></textarea>
									</div>
								</div>
							</div>
							<!--Accept Privacy Policy-->
							<div class="row">
								<div class="col-md-12">
									<div class="mAcceptTerms">
										<input type="checkbox" value="0" id="accept_value_mob" name="accept_value" />
										<span class="mAcceptTermsStatement">I here by accept the <a href="{{ URL::to('/Privacy-Policy') }}" target="_blank">
										<span class="color008 fontWeight600">Privacy Policy</span></a> and authorize @if(env("WEBSITENAME")==1)The World Gateway @elseif(env("WEBSITENAME")==0)Rapidex Travels @endif team to contact me.</span>
									</div>
									<span class="error" id="accept_value_error"></span>
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
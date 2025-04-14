<!-- Quick Enquiry -->
<section class="mWhiteBG">
	<div class="pageContainer">
		<div class="quickEnqCon">
			<div class="col-md-9 noFloat centerBlock dEnqFormCont">
			<div class="enqryTtlCont">
				<h2>Start Planning Your Trip</h2>
				<h3>Get The Best Quote, Guranteed!</h3>
			</div>
			<form action="#" method="Post" id="enquiry_form" name="enquiry_form">
				<div class="flex-row-multicolum appendTop10">
					<!-- service type -->
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="service_type">Service</label>
							<!-- HTML structure for custom select options -->
							<input type="hidden" id="service_type" name="service_type" value="Tour Package" required>
							<div class="select-arrow down custom-select" id="service_type_select" data-hidden-input="service_type">
							    <div class="selected">Select Service</div>
							    <div class="options">
							        <div class="option" data-value="Tour Package">Tour Package</div>
							        <div class="option" data-value="Accommodation">Hotels, Resorts & Villa</div>
							        <div class="option" data-value="Visa">Visa</div>
							        <div class="option" data-value="Cruise">Cruise</div>
							        <div class="option" data-value="Travel_Insurance">Travel Insurance</div>
							    </div>
							</div>
							<span class="inputError" id="service_type_error"></span>
						</div>
					</div>
					<!-- channel type -->
					<div class="flex-col-md-6">
					    <div class="guestInputCont">
					        <label for="channel_type_select">Channel</label>
					        <div class="select-arrow down custom-select" id="channel_type_select" data-hidden-input="service_type">
					            <div class="selected">Select channel type</div>
					            <div class="options">
					                <div class="option" data-value="B2C">B2C</div>
					                <div class="option" data-value="B2B">B2B</div>
					                <div class="option" data-value="Corporate">Corporate</div>
					            </div>
					        </div>
					        <input type="hidden" id="channel_type" name="channel_type" value="B2C">
					        <span class="inputError" id="channel_type_error"></span>
					    </div>
					</div>
					<!--Name-->
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="name">Name</label>
							<input type="text" id="name" name="name" placeholder="Enter your full name" tabindex="0" />
							<span class="inputError" id="name_error"></span>
						</div>
					</div>
					<!--Email-->
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="email">Email ID</label>
							<input type="text" id="email" name="email" placeholder="Enter your email id" tabindex="0"/>
							<span class="inputError" id="email_error"></span>
						</div>
					</div>
					<!--Mobile-->
					<div class="flex-col-md-6">
					    <div class="guestInputCont">
					        <label for="mobile">Mobile No</label>
					        <div class="makeflex">
					            <div class="select-arrow down" id="country_code_select_container" style="width: 40%; margin-right: 5px; position: relative;">
					                <select id="country_code" name="country_code"></select>
					            </div>
					            <input type="text" name="mobile" id="mobile" placeholder="Enter Your Mobile No" maxlength="10" style="width: 55%;" />
					        </div>
					        <span class="inputError" id="mobile_error"></span>
					    </div>
					</div>
					<!-- connect time -->
					<div class="flex-col-md-6">
					    <div class="guestInputCont">
					        <label for="time_call_select">Connect Time</label>
					        <div id="time_call_select" class="select-arrow down custom-select" tabindex="0">
					            <div class="selected">Select time to call</div>
					            <div class="options">
					                <div class="option" data-value="09 - 11 AM">Between 09 - 11 AM</div>
									<div class="option" data-value="11 - 01 PM">Between 11 - 01 PM</div>
									<div class="option" data-value="01 - 03 PM">Between 01 - 03 PM</div>
									<div class="option" data-value="03 - 05 PM">Between 03 - 05 PM</div>
									<div class="option" data-value="05 - 07 PM">Between 05 - 07 PM</div>
									<div class="option" data-value="07 - 09 PM">Between 07 - 09 PM</div>
					            </div>
					        </div>
					        <input type="hidden" id="time_call" name="time_call" value="">
					        <span class="inputError" id="time_call_error"></span>
					    </div>
					</div>
					<!-- Nationality -->
					<div class="flex-col-md-6">
					    <div class="guestInputCont">
					        <label for="country_of_residence">Nationality</label>
					        <div class="select-arrow down custom-select" id="country_of_residence_select" tabindex="0">
					            <div class="selected">Select nationality</div>
					            <div class="options">
					                <!-- Options will be dynamically populated here -->
					            </div>
					        </div>
					        <!-- Original select element -->
					        <select class="formSelect" id="country_of_residence" name="country_of_residence" style="display: none;"></select>
					        <span class="inputError" id="country_of_residence_error"></span>
					    </div>
					</div>
					<!--Destination-->
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="destinations">Destination</label>
							<input type="text" id="destinations" name="destinations" placeholder="Enter destination" />
							<span class="inputError" id="destinations_error"></span>
						</div>
					</div>
					<!--Travel Date-->
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="date_arrival">Travel Date</label>
							<input type="date" id="date_arrival" name="date_arrival" placeholder="Enter Travel Date" />
							<span class="inputError" id="date_arrival_error"></span>
						</div>
					</div>
					<!--Departure From-->
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="city_of_residence">Starting City</label>
							<input type="text" id="city_of_residence" name="city_of_residence" placeholder="Enter departure city" />
							<span class="inputError" id="city_of_residence_error"></span>
						</div>
					</div>
					<!--Duration-->
					<div class="flex-col-md-6 appendBottom20" id="displayDuration">
					    <div class="guestInputCont" style="margin: 0;">
					        <label for="duration">Duration</label>
					        <input type="hidden" id="duration" name="duration">
					        	<div class="select-arrow down custom-select" id="service_type_select" data-hidden-input="service_type" required tabindex="0">
					            <div class="selected">Select Duration</div>
					            <div class="options" id="durationOptions">
					                <!-- Options will be added dynamically using JavaScript -->
					            </div>
					        </div>
					        <span class="inputError" id="duration_error"></span>
					    </div>
					</div>
					<!-- expected budget -->
					<div class="flex-col-md-6" id="displayBudget">
					    <div class="relativeCont appendBottom20">
					        <div class="guestInputCont" style="margin-bottom: 0;">
					            <label for="exp_budget">Budget&nbsp;<span class="font12 fontItalic">per person</span></label>
					            <div class="select-arrow down" tabindex="0">
					            	<div class="icon-input-group">
										<span class="icon-input-group-addon rupee-container" aria-hidden="true"></span>
										<input type="text" id="exp_budget" name="exp_budget" placeholder="Select your budget" style="border: none;" readonly/>
									</div>
					        	</div>
					        </div>
					        <span class="inputError" id="budget_error"></span>
					        <div class="budgetPriceBarBox" id="budgetSliderContainer" style="display: none;">
					            <input type="range" min="3000" max="300000" value="3000" class="budgetSlider" id="budgetSlider">
					            <div class="rangeSection">
                					<span class="min-price-label defaulCurrency_slider">&nbsp;3,000</span>
                					<span class="max-price-label defaulCurrency_slider">&nbsp;300,000</span>
					            </div>
					        </div>
					    </div>
					</div>

					<!-- Cruise Lines -->
					<div class="flex-col-md-6 d-none" id="displayCruiseLine">
					    <div class="guestInputCont">
					        <label for="cruiseline_select">Cruise Lines</label>
					        <div id="cruiseline_select" class="select-arrow down custom-select">
					            <div class="selected">Select Cruise Lines</div>
					            <div class="options">
					                <div class="option" data-value="">Select Cruise Lines</div>
					                <div class="option" data-value="Any">Any</div>
					                <div class="option" data-value="Cordeila">Cordeila Cruises</div>
					                <div class="option" data-value="Resort World">Resort World Cruises</div>
					                <div class="option" data-value="Royal Caribbean">Royal Caribbean Cruises</div>
					                <div class="option" data-value="Celebrity">Celebrity Cruises</div>
					                <div class="option" data-value="Azamara Club">Azamara Club Cruises</div>
					                <div class="option" data-value="Norwegian">Norwegian Cruise Line</div>
					            </div>
					        </div>
					        <input type="hidden" id="cruiseline" name="cruiseline" value="">
					        <span class="inputError" id="cruiseline_error"></span>
					    </div>
					</div>
					<!-- Cruise Cabin Type -->
					<div class="flex-col-md-6 d-none" id="displayCruiseCabin">
					    <div class="guestInputCont">
					        <label for="cruisecabin_select">Cruise Cabin</label>
					        <div id="cruisecabin_select" class="select-arrow down custom-select">
					            <div class="selected">Select Cabin Type</div>
					            <div class="options">
					                <div class="option" data-value="">Select Cabin Type</div>
					                <div class="option" data-value="Any">Any</div>
					                <div class="option" data-value="Interior">Interior</div>
					                <div class="option" data-value="Oceanview">Oceanview</div>
					                <div class="option" data-value="Balcony">Balcony</div>
					                <div class="option" data-value="Suite">Suite</div>
					            </div>
					        </div>
					        <input type="hidden" id="cruisecabin" name="cruisecabin" value="">
					        <span class="inputError" id="cruisecabin_error"></span>
					    </div>
					</div>

					<!-- Visa Type -->
					<div class="flex-col-md-6 d-none" id="displayVisaType">
					    <div class="guestInputCont">
					        <label for="visatype_select">Visa Type</label>
					        <div id="visatype_select" class="select-arrow down custom-select">
					            <div class="selected">Select Visa</div>
					            <div class="options">
					                <div class="option" data-value="">Select Visa</div>
					                <div class="option" data-value="Tourist">Tourist</div>
					                <div class="option" data-value="Business">Business</div>
					                <div class="option" data-value="Student" disabled>Student</div>
					                <div class="option" data-value="Transit">Transit</div>
					            </div>
					        </div>
					        <input type="hidden" id="visatype" name="visatype" value="">
					        <span class="inputError" id="visatype_error"></span>
					    </div>
					</div>
					<!-- Visa Entry -->
					<div class="flex-col-md-6 d-none" id="displayVisaEntry">
					    <div class="guestInputCont">
					        <label for="visaentry_select">Visa Entry</label>
					        <div id="visaentry_select" class="select-arrow down custom-select">
					            <div class="selected">Select Entry Type</div>
					            <div class="options">
					                <div class="option" data-value="">Select Entry Type</div>
					                <div class="option" data-value="Single Entry">Single Entry</div>
					                <div class="option" data-value="Multiple Entry">Multiple Entry</div>
					            </div>
					        </div>
					        <input type="hidden" id="visaentry" name="visaentry" value="">
					        <span class="inputError" id="visaentry_error"></span>
					    </div>
					</div>
					<!-- Visa Express Service -->
					<div class="flex-col-md-6 d-none" id="displayVisaService">
					    <div class="guestInputCont">
					        <label for="visaservice_select">Visa Service</label>
					        <div id="visaservice_select" class="select-arrow down custom-select">
					            <div class="selected">Select Service</div>
					            <div class="options">
					                <div class="option" data-value="">Select Service</div>
					                <div class="option" data-value="Normal">Normal Service</div>
					                <div class="option" data-value="Express">Express Service</div>
					            </div>
					        </div>
					        <input type="hidden" id="visaservice" name="visaservice" value="">
					        <span class="inputError" id="visaservice_error"></span>
					    </div>
					</div>

					<!--hotel preference-->
					<div class="flex-col-md-6 d-none" id="displayhtlpref">
						<div class="guestInputCont">
							<label for="hotelpreference">Hotel Preference</label>
							<div class="hotelPref">
								<label class="hotel-selection" tabindex="0">
									<input type="radio" value="3" name="hotel_pre" tabindex="0">3 Star
								</label>
								<label class="hotel-selection" tabindex="0">
									<input type="radio" value="4" name="hotel_pre" tabindex="0">4 Star
								</label>
								<label class="hotel-selection" tabindex="0">
									<input type="radio" value="5" name="hotel_pre" tabindex="0">5 Star
								</label>
							</div>
							<span class="inputError" id="hotelpreference_error"></span>
						</div>
					</div>
					<div class="flex-col-md-6"></div>

					<!-- Flight Booking Preference -->
					<div class="flex-col-md-6" id="displayfltbkngpref">
						<div class="guestInputCont">
							<label for="flightbookingpreference">Have you booked the flight tickets?</label>
							<div class="flightPref">
								<label class="flight-booking-selection" tabindex="0">
									<input type="radio" value="0" name="flight_booking" tabindex="0">Yes
								</label>
								<label class="flight-booking-selection" tabindex="0">
									<input type="radio" value="1" name="flight_booking" tabindex="0">No
								</label>
							</div>
						</div>
					</div>
					<div class="flex-col-md-6"></div>
					<!-- No of Traveller -->
					<div class="flex-col-md-12">
					    <div class="guestInputCont">
					        <label for="travellers">No of Traveller(s)</label>
					        <div class="flexCenter mobscroll" style="overflow-x: auto;" tabindex="0">
					            <div class="flex-column-center appendRight20" id="adlt_traveller">
					                <input type="hidden" name="span_value_adult" class="span_value_adult1" value="2" tabindex="0" />
					                <div class="flexCenter">
					                    <span class="guestMinus span_des_adult">&#8722;</span>
					                    <span class="guestValue span_value_adult">2</span>
					                    <span class="guestPlus span_inc_adult">&#43;</span>
					                </div>
					                <div class="guestType textCenter" id="adult">Adult<br>(+12yrs)</div>
					            </div>
					            <div class="flex-column-center appendRight20" id="cwb_traveller">
					                <input type="hidden" name="span_value_child" class="span_value_child1" value="0" tabindex="0" />
					                <div class="flexCenter">
					                    <span class="guestMinus span_des_child">&#8722;</span>
					                    <span class="guestValue span_value_child">0</span>
					                    <span class="guestPlus span_inc_child">&#43;</span>
					                </div>
					                <div class="guestType textCenter" id="childwithbed">Child with bed<br>(2-12yrs)</div>
					            </div>
					            <div class="flex-column-center appendRight20" id="cwob_traveller">
					                <input type="hidden" name="span_value_child_without_bed" class="span_value_child2" value="0" tabindex="0" />
					                <div class="flexCenter">
					                    <span class="guestMinus span_des_child_without_bed">&#8722;</span>
					                    <span class="guestValue span_value_child_without_bed">0</span>
					                    <span class="guestPlus span_inc_child_without_bed">&#43;</span>
					                </div>
					                <div class="guestType textCenter" id="childwithoutbed">Child without bed<br>(2-12yrs)</div>
					            </div>
					            <div class="flex-column-center" id="infnt_traveller">
					                <input type="hidden" name="span_value_infant" class="span_value_infant1" value="0" tabindex="0" />
					                <div class="flexCenter">
					                    <span class="guestMinus span_des_infant">&#8722;</span>
					                    <span class="guestValue span_value_infant">0</span>
					                    <span class="guestPlus span_inc_infant">&#43;</span>
					                </div>
					                <div class="guestType textCenter" id="infant">Infant<br>(0-2yrs)</div>
					            </div>
					        </div>
					        <span class="inputError" id="travellers_error"></span>
					    </div>
					</div>
					<!--additional Requests-->
					<div class="flex-col-md-12">
						<div class="guestInputCont appendTop5 appendBtm20">
							<label for="additionaldetails">Additional Request&nbsp;<span class="colorA1 d-none">(subject to availability)</span></label>
							<div id="tourAdtnlDtls">
								<div class="addOnDtlsCont mobscroll scrollX">
									<label class="checkmarkCont">
										<input type="checkbox" class="additional_details" value="Business Tour">
										<span class="checkmark addOn-services"></span>
										<span class="addOn-services-text">Business Tour</span>
									</label>
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
								</div>
							</div>
							<textarea class="formTextarea" type="text" id="additionaldetails" name="message" placeholder="Enter additional requests (if any)"></textarea>
						</div>
					</div>
					<!--Accept Privacy Policy-->
					<div class="flex-col-md-12">
						<div class="dAcceptTerms">
							<label class="checkmarkCont">
								<input type="checkbox" value="0" id="accept_value" name="accept_value" />
								<span class="checkmark signup-acceptance"></span>
								<h5>I here by accept the <a href="{{ URL::to('/Privacy-Policy') }}" target="_blank"><span style="color: #08B2ED;"><b>Privacy Policy</b></span></a> and authorize @if(env("WEBSITENAME")==1)The World Gateway @elseif(env("WEBSITENAME")==0)Rapidex Travels @endif team to contact me.</h5>
							</label>
						</div>
						<div>
							<span class="inputError" id="accept_value_error"></span>
						</div>
					</div>
					<div class="flex-col-md-12">
						<div class="btnCont">
							<button type="submit" name="submit" id="form_submit" class="btnSubmitEnq">Get a Free Quote</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@section('custom_js')

<script src="https://code.jquery.com/jquery-2.2.4.js"></script>

<!-- contact-us-enquiry js -->
<script type="text/javascript" src='{{ asset("/resources/assets/frontend/js/contact-us-enquiry.js") }}'></script>
@endsection
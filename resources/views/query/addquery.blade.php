@extends('layouts.master')
@section('content')

<!-- Contact us enquiry CSS -->
<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/contact-us-enquiry.css') }}" />

<!-- UI Datepicker CSS -->
<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/ui-datepicker-new-contact-us.css') }}" />

<!-- Inline styles for form errors and traveller counters -->

<style>
  .error{color: red}
   .bor_cen
         {
         border-top:1px solid lightgray;
         border-bottom:1px solid lightgray;
         padding: 5px 10px

         }
    .bor
         {
          border:1px solid lightgray;
          padding: 5px 10px;
          cursor: pointer;

         }
     .checkbox_spn
         {
          margin-right: 10px;
          position: relative;
          top: -1px;
          margin-left: 4px;

         }   
        
</style>


<!-- Quick Service Enquiry -->
<section class="mWhiteBG">
    <div class="pageContainer">
        <div class="quickEnqCon">
            <div class="col-md-9 noFloat centerBlock dEnqFormCont">
                <div class="enqryTtlCont">
                    <h2>Start Planning Your Trip</h2>
                    <h3>Get The Best Quote, Guaranteed!</h3>
                </div>
                <form action="{{ URL::to('/saveQuery1') }}" method="POST" id="enquiry_form" name="enquiry_form">
                    {{ csrf_field() }}
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <div class="flex-row-multicolum appendTop10">
                        <!-- Service Type -->
                        <div class="flex-col-md-6">
                            <div class="guestInputCont">
                                <label for="service_type">Service</label>
                                <input type="hidden" id="service_type" name="service_type" value="Tour Package" required>
                                <div class="select-arrow down custom-select outline" id="service_type_select" data-hidden-input="service_type">
                                    <div class="selected">Select Service</div>
                                    <div class="options">
                                        <div class="option" data-value="Tour Package">Tour Package</div>
                                        <div class="option" data-value="Accommodation">Hotels, Resorts & Villa</div>
                                        <div class="option" data-value="Visa">Visa</div>
                                        <div class="option" data-value="Cruise">Cruise</div>
                                        <div class="option" data-value="Travel_Insurance">Travel Insurance</div>
                                        <div class="option" data-value="Activity">Activity</div>
                                    </div>
                                </div>
                                <span class="inputError" id="service_type_error"></span>
                            </div>
                        </div>

                        <!-- Channel Type -->
                        <div class="flex-col-md-6">
                            <div class="guestInputCont">
                                <label for="channel_type_select">Channel</label>
                                <div class="select-arrow down custom-select outline" id="channel_type_select" data-hidden-input="channel_type">
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

                        <!-- Name -->
                        <div class="flex-col-md-6">
                            <div class="guestInputCont">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" placeholder="Enter your full name" tabindex="0" />
                                <span class="inputError" id="name_error"></span>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="flex-col-md-6">
                            <div class="guestInputCont">
                                <label for="email">Email ID</label>
                                <input type="text" id="email" name="email" placeholder="Enter your email id" tabindex="0"/>
                                <span class="inputError" id="email_error"></span>
                            </div>
                        </div>

                        <!-- Mobile -->
                        <div class="flex-col-md-6">
                            <div class="guestInputCont">
                                <div class="makeflex">
                                    <div style="width: 55%; margin-right: 5px;">
                                        <label for="country_code">Country Code</label>
                                        <div class="select-arrow down" id="country_code_select_container">
                                            <select id="country_code" name="country_code"></select>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="mobile">Mobile No</label>
                                        <input type="text" name="mobile" id="mobile" placeholder="Enter Your Mobile No" maxlength="10" />
                                    </div>
                                </div>
                                <span class="inputError" id="mobile_error"></span>
                            </div>
                        </div>

                        <!-- Connect Time -->
                        <div class="flex-col-md-6">
                            <div class="guestInputCont">
                                <label for="time_call_select">Connect Time</label>
                                <div id="time_call_select" class="select-arrow down custom-select outline" tabindex="0">
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
                                <div class="select-arrow down custom-select outline" id="country_of_residence_select" tabindex="0">
                                    <div class="selected">Select nationality</div>
                                    <div class="options"></div>
                                </div>
                                <select class="formSelect" id="country_of_residence" name="country_of_residence" style="display: none;"></select>
                                <span class="inputError" id="country_of_residence_error"></span>
                            </div>
                        </div>

                        <!-- Destination -->
                        <div class="flex-col-md-6">
                            <div class="guestInputCont">
                                <label for="destinations">Destination</label>
                                <input type="text" id="destinations" name="destinations" placeholder="Enter destination" />
                                <span class="inputError" id="destinations_error"></span>
                            </div>
                        </div>

                        <!-- Travel Date -->
                        <div class="flex-col-md-6">
                            <div class="guestInputCont">
                                <label for="tripTravelDate">Travel Date</label>
                                <input type="text" id="tripTravelDate" name="date_arrival" placeholder="Enter Travel Date" />
                                <span class="inputError" id="date_arrival_error"></span>
                            </div>
                        </div>

                        <!-- Departure From -->
                        <div class="flex-col-md-6" id="displayDepartureCity">
                            <div class="guestInputCont">
                                <label for="city_of_residence">Starting City</label>
                                <input type="text" id="city_of_residence" name="city_of_residence" placeholder="Enter departure city" />
                                <span class="inputError" id="city_of_residence_error"></span>
                            </div>
                        </div>

                        <!-- Duration -->
                        <div class="flex-col-md-6 appendBottom20" id="displayDuration">
                            <div class="guestInputCont">
                                <label for="duration">Duration</label>
                                <input type="hidden" id="duration" name="duration">
                                <div class="select-arrow down custom-select outline" id="duration_select" data-hidden-input="duration" required tabindex="0">
                                    <div class="selectedKILL">Select Duration</div>
                                    <div class="options" id="durationOptions"></div>
                                </div>
                                <span class="inputError" id="duration_error"></span>
                            </div>
                        </div>

                        <!-- Expected Budget -->
                        <div class="flex-col-md-6" id="displayBudget">
                            <div class="relativeCont appendBottom20">
                                <div class="guestInputCont" style="margin-bottom: 0;">
                                    <label for="exp_budget">Budget <span class="font12 fontItalic">per person</span></label>
                                    <div class="select-arrow down outline" tabindex="0">
                                        <div class="icon-input-group">
                                            <div class="icon-input-group-addon">
                                                <span class="rupee-container" aria-hidden="true"></span>
                                            </div>
                                            <input type="text" id="exp_budget" name="exp_budget" placeholder="Select your budget" style="border: none;" readonly/>
                                        </div>
                                    </div>
                                </div>
                                <span class="inputError" id="budget_error"></span>
                                <div class="budgetPriceBarBox" id="budgetSliderContainer" style="display: none;">
                                    <input type="range" min="3000" max="300000" value="3000" class="budgetSlider" id="budgetSlider">
                                    <div class="rangeSection">
                                        <span class="min-price-label defaulCurrency_slider">3,000</span>
                                        <span class="max-price-label defaulCurrency_slider">300,000</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Cruise Lines -->
                        <div class="flex-col-md-6" id="displayCruiseLine" style="display: none;">
                            <div class="guestInputCont">
                                <label for="cruiseline_select">Cruise Lines</label>
                                <div class="select-arrow down custom-select outline" id="cruiseline_select">
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
                        <div class="flex-col-md-6" id="displayCruiseCabin" style="display: none;">
                            <div class="guestInputCont">
                                <label for="cruisecabin_select">Cruise Cabin</label>
                                <div class="select-arrow down custom-select outline" id="cruisecabin_select">
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
                        <div class="flex-col-md-6" id="displayVisaType" style="display: none;">
                            <div class="guestInputCont">
                                <label for="visatype_select">Visa Type</label>
                                <div class="select-arrow down custom-select outline" id="visatype_select">
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
                        <div class="flex-col-md-6" id="displayVisaEntry" style="display: none;">
                            <div class="guestInputCont">
                                <label for="visaentry_select">Visa Entry</label>
                                <div class="select-arrow down custom-select outline" id="visaentry_select">
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
                        <div class="flex-col-md-6" id="displayVisaService" style="display: none;">
                            <div class="guestInputCont">
                                <label for="visaservice_select">Visa Service</label>
                                <div class="select-arrow down custom-select outline" id="visaservice_select">
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

                        <!-- Hotel Star Category -->
                        <div class="flex-col-md-6" id="displayhtlpref">
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

                        <!-- Flight Booking Preference -->
                        <div class="flex-col-md-6" id="displayfltbkngpref">
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

                        <!-- Hotel Booking Preference -->
                        <div class="flex-col-md-6" id="displayHtlBkng">
                            <div class="guestInputCont">
                                <label for="hotelbookingpreference">Have you booked the hotel?</label>
                                <div class="flightPref">
                                    <label class="preference-selection" tabindex="0">
                                        <input type="radio" value="0" name="hotel_booking" tabindex="0">Yes
                                    </label>
                                    <label class="preference-selection" tabindex="0">
                                        <input type="radio" value="1" name="hotel_booking" tabindex="0">No
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- No of Traveller -->
                        <div class="flex-col-md-12">
                            <div class="guestInputCont">
                                <label for="travellers">No of Traveller(s)</label>
                                <div class="flexCenter mobscroll" style="overflow-x: auto;" tabindex="0">
                                    <div class="flex-column-center appendRight20" id="adlt_traveller">
                                        <input type="hidden" name="span_value_adult" class="span_value_adult1" value="2" tabindex="0" />
                                        <div class="flexCenter">
                                            <span class="guestMinus span_des_adult">−</span>
                                            <span class="guestValue span_value_adult">2</span>
                                            <span class="guestPlus span_inc_adult">+</span>
                                        </div>
                                        <div class="guestType textCenter" id="adult">Adult<br>(+12yrs)</div>
                                    </div>
                                    <div class="flex-column-center appendRight20" id="cwb_traveller">
                                        <input type="hidden" name="span_value_child" class="span_value_child1" value="0" tabindex="0" />
                                        <div class="flexCenter">
                                            <span class="guestMinus span_des_child">−</span>
                                            <span class="guestValue span_value_child">0</span>
                                            <span class="guestPlus span_inc_child">+</span>
                                        </div>
                                        <div class="guestType textCenter" id="childwithbed">Child with bed<br>(2-12yrs)</div>
                                    </div>
                                    <div class="flex-column-center appendRight20" id="cwob_traveller">
                                        <input type="hidden" name="span_value_child_without_bed" class="span_value_child2" value="0" tabindex="0" />
                                        <div class="flexCenter">
                                            <span class="guestMinus span_des_child_without_bed">−</span>
                                            <span class="guestValue span_value_child_without_bed">0</span>
                                            <span class="guestPlus span_inc_child_without_bed">+</span>
                                        </div>
                                        <div class="guestType textCenter" id="childwithoutbed">Child without bed<br>(2-12yrs)</div>
                                    </div>
                                    <div class="flex-column-center" id="infnt_traveller">
                                        <input type="hidden" name="span_value_infant" class="span_value_infant1" value="0" tabindex="0" />
                                        <div class="flexCenter">
                                            <span class="guestMinus span_des_infant">−</span>
                                            <span class="guestValue span_value_infant">0</span>
                                            <span class="guestPlus span_inc_infant">+</span>
                                        </div>
                                        <div class="guestType textCenter" id="infant">Infant<br>(0-2yrs)</div>
                                    </div>
                                </div>
                                <span class="inputError" id="travellers_error"></span>
                            </div>
                        </div>

                        <!-- Additional Requests -->
                        <div class="flex-col-md-12">
                            <div class="guestInputCont appendTop5 appendBtm20">
                                <label for="additionaldetails">Additional Request <span class="colorA1 d-none">(subject to availability)</span></label>
                                <div id="tourAdtnlDtls">
                                    <div class="addOnDtlsCont">
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
                                <textarea class="formTextarea" id="additionaldetails" name="message" placeholder="Enter additional requests (if any)"></textarea>
                            </div>
                        </div>

                        <!-- Accept Privacy Policy -->
                        <div class="flex-col-md-12">
                            <div class="dAcceptTerms">
                                <label class="checkmarkCont wrapper">
                                    <input type="checkbox" value="0" id="accept_value" name="accept_value" />
                                    <span class="checkmark signup-acceptance"></span>
                                    @php
                                        $websiteData = getWebsiteData();
                                    @endphp
                                    <h5>I hereby accept the 
                                        <a href="{{ route('privacyPolicy') }}" target="_blank" class="link-color">
                                            <b>Privacy Policy</b>
                                        </a> 
                                        and authorize {{ $websiteData['name'] ?? 'Our Team' }} team to contact me.
                                    </h5>
                                </label>
                            </div>
                            <span class="inputError" id="accept_value_error"></span>
                        </div>

                        <!-- Submit -->
                        <div class="flex-col-md-12">
                            <div class="btnCont">
                                <button type="submit" name="submit" id="form_submit" class="btnSubmitEnq">Get a Free Quote</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('custom_js')
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="{{ asset('/resources/assets/frontend/js/contact-us-enquiry.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        // Datepicker for travel date
        $("#tripTravelDate").datepicker({
            dateFormat: "yy-mm-dd",
            minDate: 0
        });

        // Fetch country list
        var url = "{{ url('/country_query') }}";
        var data = { _token: "{{ csrf_token() }}" };
        $.post(url, data, function(rdata) {
            $("#country_of_residence").html("").html(rdata);
        });

        // Traveller count handlers
        $(".span_inc_adult").click(function() {
            var span_value_adult = parseInt($(".span_value_adult").text());
            $(".span_value_adult").text(span_value_adult + 1);
            $(".span_value_adult1").val(span_value_adult + 1);
        });

        $(".span_des_adult").click(function() {
            var span_value_adult = parseInt($(".span_value_adult").text());
            if (span_value_adult >= 2) {
                $(".span_value_adult").text(span_value_adult - 1);
                $(".span_value_adult1").val(span_value_adult - 1);
            }
        });

        $(".span_inc_child").click(function() {
            var span_value_child = parseInt($(".span_value_child").text());
            $(".span_value_child").text(span_value_child + 1);
            $(".span_value_child1").val(span_value_child + 1);
        });

        $(".span_des_child").click(function() {
            var span_value_child = parseInt($(".span_value_child").text());
            if (span_value_child >= 1) {
                $(".span_value_child").text(span_value_child - 1);
                $(".span_value_child1").val(span_value_child - 1);
            }
        });

        $(".span_inc_child_without_bed").click(function() {
            var span_value_child_without_bed = parseInt($(".span_value_child_without_bed").text());
            $(".span_value_child_without_bed").text(span_value_child_without_bed + 1);
            $(".span_value_child2").val(span_value_child_without_bed + 1);
        });

        $(".span_des_child_without_bed").click(function() {
            var span_value_child_without_bed = parseInt($(".span_value_child_without_bed").text());
            if (span_value_child_without_bed >= 1) {
                $(".span_value_child_without_bed").text(span_value_child_without_bed - 1);
                $(".span_value_child2").val(span_value_child_without_bed - 1);
            }
        });

        $(".span_inc_infant").click(function() {
            var span_value_infant = parseInt($(".span_value_infant").text());
            $(".span_value_infant").text(span_value_infant + 1);
            $(".span_value_infant1").val(span_value_infant + 1);
        });

        $(".span_des_infant").click(function() {
            var span_value_infant = parseInt($(".span_value_infant").text());
            if (span_value_infant >= 1) {
                $(".span_value_infant").text(span_value_infant - 1);
                $(".span_value_infant1").val(span_value_infant - 1);
            }
        });

        // Accept checkbox toggle
        $("#accept_value").click(function() {
            $(this).val($(this).val() == "0" ? "1" : "0");
        });

        // Service type toggle
        $("#service_type_select").on("click", ".option", function() {
            var value = $(this).data("value");
            $("#service_type").val(value); // Update hidden input
            $("#displayCruiseLine, #displayCruiseCabin, #displayVisaType, #displayVisaEntry, #displayVisaService").hide();
            if (value === "Cruise") {
                $("#displayCruiseLine, #displayCruiseCabin").show();
            } else if (value === "Visa") {
                $("#displayVisaType, #displayVisaEntry, #displayVisaService").show();
            }
        });

        // Channel type selection
        $("#channel_type_select").on("click", ".option", function() {
            var value = $(this).data("value");
            $("#channel_type").val(value); // Update hidden input
        });

        // Populate duration options
        var durations = ["3 Days", "5 Days", "7 Days", "10 Days", "14 Days"];
        durations.forEach(function(d) {
            $("#durationOptions").append(`<div class="option" data-value="${d}">${d}</div>`);
        });

        // Duration selection
        $("#duration_select").on("click", ".option", function() {
            var value = $(this).data("value");
            $("#duration").val(value); // Update hidden input
        });

        // Budget slider
        $("#budgetSlider").on("input", function() {
            var value = $(this).val();
            $("#exp_budget").val(value);
        });
    });

    // Form validation
    document.enquiry_form.onsubmit = function() {
        var name = document.enquiry_form.name.value.trim();
        var email = document.enquiry_form.email.value.trim();
        var mobile = document.enquiry_form.mobile.value.trim();
        var city_of_residence = document.enquiry_form.city_of_residence.value.trim();
        var destinations = document.enquiry_form.destinations.value.trim();
        var accept_value = document.enquiry_form.accept_value.value;
        var patt_name = /^[A-Za-z][A-Za-z .]{2,}$/;
        var patt_mail = /^[A-Za-z0-9][A-Za-z0-9_.]*@[A-Za-z0-9][A-Za-z0-9.-]*\.[A-Za-z]{2,}$/;

        document.querySelectorAll(".inputError").forEach(el => el.innerHTML = "");

        if (!name) {
            document.querySelector("#name_error").innerHTML = "Enter Full Name";
            document.enquiry_form.name.focus();
            return false;
        } else if (!patt_name.test(name)) {
            document.querySelector("#name_error").innerHTML = "Enter valid Name";
            document.enquiry_form.name.focus();
            return false;
        }

        if (!email) {
            document.querySelector("#email_error").innerHTML = "Enter Email ID";
            document.enquiry_form.email.focus();
            return false;
        } else if (!patt_mail.test(email)) {
            document.querySelector("#email_error").innerHTML = "Enter valid Email ID";
            document.enquiry_form.email.focus();
            return false;
        }

        if (!mobile || isNaN(mobile) || mobile.length !== 10) {
            document.querySelector("#mobile_error").innerHTML = "Enter valid 10-digit Mobile Number";
            document.enquiry_form.mobile.focus();
            return false;
        }

        if (!city_of_residence || !patt_name.test(city_of_residence)) {
            document.querySelector("#city_of_residence_error").innerHTML = "Enter valid Starting City";
            document.enquiry_form.city_of_residence.focus();
            return false;
        }

        if (!destinations || !patt_name.test(destinations)) {
            document.querySelector("#destinations_error").innerHTML = "Enter valid Destination";
            document.enquiry_form.destinations.focus();
            return false;
        }

        if (accept_value === "0") {
            document.querySelector("#accept_value_error").innerHTML = "Please accept the Terms & Conditions";
            document.enquiry_form.accept_value.focus();
            return false;
        }

        return true;
    };
</script>
@endsection
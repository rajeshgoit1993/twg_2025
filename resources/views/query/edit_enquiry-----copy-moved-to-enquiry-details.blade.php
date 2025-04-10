<!-- web-leads & lead-verfication -->
<style type="text/css">
.icon-input-group {
    position: relative;
    display: flex;
    border-collapse: separate;
    height: 36px;
    border: 1px solid #c8c8c8;
    border-radius: 4px;
    overflow: hidden;
    width: 100%;
}
.icon-input-group:focus {
    border-color: var(--border-theme-color);
}
.icon-input-group-addon {
    padding: 6px 15px;
    font-size: 14px;
    font-weight: 400;
    line-height: 1;
    color: #555;
    text-align: center;
    background-color: #f9f9f9;
    width: 35px;
    white-space: nowrap;
    vertical-align: middle;
    display: table-cell;
    height: auto;
    border-right: 1px solid #c8c8c8;
}
.rupee-container::before {
    content: "₹";
    font-family: Arial, sans-serif;
    font-size: 18px;
    color: black;
    position: absolute;
    top: 9px;
    left: 13px;
}

/*Budget*/
.budgetPriceBarBox {
  border: 1px solid #c8c8c8;
  border-radius: 4px;
  background: #fff;
  padding: 10px 15px 10px;
  width: 100%;
  position: absolute;
  z-index: 1;
  margin-top: 1px;
}
.budgetSlider {
  margin: 20px 15px 15px;
}
.rangeSection {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 6px;
  margin-top: 10px;
}
.defaulCurrency_slider:before {
  content: '\0020B9';
  font-size: 15px;
  line-height: 15px;
  font-weight: 500;
}

/*budget-slider*/
.selected-budget {
  width: 80px;
  text-align: center;
  margin-top: 5px;
}
/* Styles for the slider track */
.budgetSlider {
  -webkit-appearance: none;
  appearance: none;
  width: 100%;
  height: 6px;
  border-radius: 5px;
  background: #d3d3d3;
  outline: none;
  opacity: 0.7;
  -webkit-transition: .2s;
  transition: opacity .2s;
  padding: 0;
  margin: 0;
  margin-top: 10px;
  border: none;
  /*background-color: #08B2ED;*/
}
/* Styles for the slider thumb */
.budgetSlider::-webkit-slider-thumb {
  -webkit-appearance: none;
  appearance: none;
  width: 20px;
  height: 20px;
  border-radius: 50%;
  background: #08B2ED;
  cursor: grab;
  box-shadow: 0 0 6px 0 rgba(0, 0, 0, .2) !important;
  border-width: 0 !important;
}
.budgetSlider::-moz-range-thumb {
  width: 20px;
  height: 20px;
  border-radius: 50%;
  background: #08B2ED;
  cursor: grab;
  box-shadow: 0 0 6px 0 rgba(0, 0, 0, .2) !important;
  border-width: 0 !important;
}
</style>

<?php
    $package_name = CustomHelpers::get_package_name($data->packageId);
    $day_s = (int) filter_var($data->duration, FILTER_SANITIZE_NUMBER_INT);

    if (is_numeric((int)$data->packageId)) {
        $cities = CustomHelpers::get_master_table_data('rt_packages', 'id', (int)$data->packageId, 'city');

        if ($cities !== 'NA') {
            $cities = unserialize($cities);

            if ($cities !== false) {
                $output = '';
                $a = 1;

                foreach ($cities as $c) {
                    if ($a > 1) {
                        $output .= ',';
                    }
                    $output .= $c;

                    $a++;
                }
            } else {
                // Handle unserialize failure
                $output = $data->destinations; // Fallback to destinations value from $data object
            }
        } else {
            // Handle 'NA' return value
            $output = 'Cities not available';
        }
    } else {
        $output = $data->destinations;
    }
?>
<input type="hidden" value="{{ $id }}" name='query_id' id='package_id' />
<input type="hidden" value="{{ (int)$data->packageId }}" name='package_id' id='package_id' />

<!-- <div class='row'> -->
    <!-- enquiry no -->
    <div class="col-md-12">
        <div class="form-group">
            <label>Enquiry Ref No: #{{$data->enquiry_ref_no}}</label>
        </div>
    </div>

    <!-- service type -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="service_type">Service Type</label>
            <select class="lead-input-text fullWidth" id="service_type" name="service_type" required>
                <option disabled>Select Service</option>
                <option value="Tour Package" @if($data->service_type=='Tour Package') selected @endif>Tour Package</option>
                <option value="Accommodation" @if($data->service_type=='Accommodation') selected @endif>Hotels, Resorts & Villa</option>
                <option value="Visa" @if($data->service_type=='Visa') selected @endif>Visa</option>
                <option value="Cruise" @if($data->service_type=='Cruise') selected @endif>Cruise</option>
                <option value="Travel_Insurance" @if($data->service_type=='Travel_Insurance') selected @endif>Travel Insurance</option>
                <option value="Activity" @if($data->service_type=='Activity') selected @endif>Activity</option>
            </select>
        </div>
    </div>

    <!-- channel type -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="channel_type">Channel Type</label>
            <!-- <input type="text" class="lead-input-text fullWidth" id="channel_type" name="channel_type" value="{{$data->channel_type}}" placeholder="Enter channel type" required /> -->
            <select class="lead-input-text fullWidth" id="channel_type" name="channel_type" required>
                <option disabled>Select Service</option>
                <option value="B2C" @if($data->channel_type=='B2C') selected @endif>B2C</option>
                <option value="B2B" @if($data->channel_type=='B2B') selected @endif>B2B</option>
                <option value="Corporate" @if($data->channel_type=='Corporate') selected @endif>Corporate</option>
            </select>
        </div>
    </div>

    <!-- traveller name -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="lead-input-text fullWidth" id="name" name="name" value="{{$data->name}}" placeholder="Enter name" required />
        </div>
    </div>
    
    <?php 
        $loged_user=Sentinel::getUser();
    ?>
    @if($loged_user->lock_before_quote_send=='')

        <!-- email id -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Email ID</label>
                <input type="text" class="lead-input-text fullWidth" id="email" name="email" value="{{$data->email}}" placeholder="Enter email id" />
            </div>
        </div>

        <!-- mobile number -->
        <div class="col-md-6">
            <div class="form-group">
                <div class="makeflex">
                    <div style="margin-right: 5px;">
                        <label for="country_code">Country Code</label>
                        <select class="lead-input-text fullWidth" id="country_code" name="country_code" value="{{$data->country_code}}"></select>
                    </div>
                    <div class="fullWidth">
                        <label for="mobile">Mobile Number</label>
                        <input type="text" class="lead-input-text fullWidth" id="mobile" name="mobile" value="{{$data->mobile}}" placeholder="Enter mobile number" />
                    </div>
                </div>
            </div>
        </div>

        @else

        <!-- contact email id -->
        <div class="col-md-6">
            <div class="form-group">
                <label>Email ID</label>
                <input type="text" class="lead-input-text fullWidth" id="email" name="email" value="{{CustomHelpers::partiallyHideEmail($data->email)}}" placeholder="Enter email id" />
            </div>
        </div>

        <!-- mobile number -->
        <div class="col-md-6">
            <div class="form-group">
                <div class="makeflex">
                    <div style="margin-right: 5px;">
                        <label for="country_code">Country Code</label>
                        <select class="lead-input-text fullWidth" id="country_code" name="country_code" value="{{$data->country_code}}"></select>
                    </div>
                    <div class="fullWidth">
                        <label for="mobile">Mobile Number</label>
                        <input type="text" class="lead-input-text fullWidth" id="mobile" name="mobile" value="{{CustomHelpers::mask_mobile_no($data->mobile)}}" placeholder="Enter mobile number" />
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- --------------- -->

    <!-- connect time -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="time_call">Connect Time</label>
            <select class="lead-input-text fullWidth" id="time_call" name="time_call" required>
                <option value="0" selected disabled>Select Time To Call</option>
                <option value="09 - 11 AM" @if($data->time_call=='09 - 11 AM') selected @endif>Between 09 - 11 AM</option>
                <option value="11 - 01 PM" @if($data->time_call=='11 - 01 PM') selected @endif>Between 11 - 01 PM</option>
                <option value="01 - 03 PM" @if($data->time_call=='01 - 03 PM') selected @endif>Between 01 - 03 PM</option>
                <option value="03 - 05 PM" @if($data->time_call=='03 - 05 PM') selected @endif>Between 03 - 05 PM</option>
                <option value="05 - 07 PM" @if($data->time_call=='05 - 07 PM') selected @endif>Between 05 - 07 PM</option>
                <option value="07 - 09 PM" @if($data->time_call=='07 - 09 PM') selected @endif>Between 07 - 09 PM</option>
            </select>
        </div>
    </div>

    <!-- --------------- -->

    <!-- nationality -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="country_of_residence">Nationality</label>
            <!-- <input type="text" class="lead-input-text fullWidth" id="country_of_residence" name="country_of_residence" value="{{$data->country_of_residence}}" placeholder="Enter nationality" required /> -->
            <select class="lead-input-text fullWidth" id="country_of_residence" name="country_of_residence" value="{{$data->country_of_residence}}"></select>
        </div>
    </div>

    <!-- --------------- -->

    <!-- destination -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="destinations">Destination</label>
            <input type="text" class="lead-input-text fullWidth" id="destinations" name="destinations" value="{{$output}}" placeholder="Enter destination" required />
        </div>
    </div>

    <!-- --------------- -->

    <!-- travel date -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="date_arrival">Travel Date</label>
            <input type="date" class="lead-input-text fullWidth" id="date_arrival" name="date_arrival" value="{{$data->date_arrival}}" placeholder="Enter starting city" required />
        </div>
    </div>

    <!-- --------------- -->

    <!-- starting city -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="city_of_residence">Starting City</label>
            <input type="text" class="lead-input-text fullWidth" id="city_of_residence" name="city_of_residence" value="{{$data->city_of_residence}}" placeholder="Enter starting city" required />
        </div>
    </div>    

    <!-- --------------- -->

    <!-- duration -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="duration">Duration</label>
            <select class="lead-input-text fullWidth" name="duration" id="duration" placeholder="Enter duration" required>
                @for($i=2;$i<=180;$i++) 
                    <option value="{{ $i }}" @if($i==$day_s) selected @endif>{{ $i-1 }} Nights / {{ $i }} Days</option>
                @endfor
            </select>
        </div>
    </div>

    <!-- --------------- -->

    <!-- cruise lines -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="cruiseline">Cruise Lines</label>
            <select class="lead-input-text fullWidth" name="cruiseline" id="cruiseline">
                <option value="">Select Cruise Lines</option>
                <option value="Any">Any</option>
                <option value="Cordeila">Cordeila Cruises</option>
                <option value="Resort World">Resort World Cruises</option>
                <option value="Royal Caribbean">Royal Caribbean Cruises</option>
                <option value="Celebrity">Celebrity Cruises</option>
                <option value="Azamara Club">Azamara Club Cruises</option>
                <option value="Norwegian">Norwegian Cruise Line</option>
            </select>
        </div>
    </div>

    <!-- cruise cabin type -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="cruisecabin">Cruise Cabin</label>
            <select class="lead-input-text fullWidth" name="cruisecabin" id="cruisecabin">
                <option value="">Select Cabin Type</option>
                <option value="Any">Any</option>
                <option value="Interior">Interior</option>
                <option value="Oceanview">Oceanview</option>
                <option value="Balcony">Balcony</option>
                <option value="Suite">Suite</option>
            </select>
        </div>
    </div>

    <!-- --------- -->

    <!-- visa type -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="visatype">Visa Type</label>
            <select class="lead-input-text fullWidth" name="visatype" id="visatype">
                <option value="">Select Visa</option>
                <option value="Tourist">Tourist</option>
                <option value="Business">Business</option>
                <option value="Student">Student</option>
                <option value="Transit">Transit</option>
            </select>
        </div>
    </div>

    <!-- visa entry -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="visaentry">Visa Entry</label>
            <select class="lead-input-text fullWidth" name="visaentry" id="visaentry">
                <option value="">Select Entry Type</option>
                <option value="Single Entry">Single Entry</option>
                <option value="Multiple Entry">Multiple Entry</option>
            </select>
        </div>
    </div>

    <!-- visa express service -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="visaservice">Visa Service</label>
            <select class="lead-input-text fullWidth" name="visaservice" id="visaservice">
                <option value="">Select Entry Type</option>
                <option value="Single Entry">Single Entry</option>
                <option value="Multiple Entry">Multiple Entry</option>
            </select>
        </div>
    </div>

    <!-- --------- -->

    <!-- hotel preference -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="hotel_pre">Hotel Preference</label>
            <select class="lead-input-text fullWidth" name="hotel_pre" id="hotel_pre" required>
                <option value="">Select</option>
                @for($i=2;$i<=5;$i++) 
                    <option value="{{ $i }}" @if($i==$data->hotel_pre) selected @endif>{{ $i }} Star</option>
                @endfor
            </select>
        </div>
    </div>

    <!-- --------------- -->

    <!-- package name -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="package_name">Enquiry Source</label>
            <input type="text" class="lead-input-text disabled fullWidth" id="package_name" name="package_name" value="{{ isset($data->package_name) && !empty($data->package_name) ? $data->package_name : 'Quick Enquiry' }}" placeholder="Enter package name" disabled />

        </div>
    </div>

    <!-- --------------- -->

    <!-- expected budget -->
    <div class="col-md-6">
        <div class="form-group">
            <div class="relativeCont">
                <label for="exp_budget">Budget&nbsp;<span class="font12 fontItalic">(per person)</span></label>
                <div class="icon-input-group">
                    <span class="icon-input-group-addon rupee-container" aria-hidden="true"></span>
                    <input type="text" class="lead-input-text fullWidth" id="exp_budget" name="exp_budget" value="{{$data->exp_budget}}" placeholder="Enter budget" style="border: none;" readonly />
                </div>
                <!-- budget slider -->
                <div class="budgetPriceBarBox" id="budgetSliderContainer" style="display: none;">
                    <input type="range" min="3000" max="800000" value="3000" class="budgetSlider" id="budgetSlider">
                    <div class="rangeSection">
                        <span class="min-price-label defaulCurrency_slider">&nbsp;3,000</span>
                        <span class="max-price-label defaulCurrency_slider">&nbsp;800,000</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12"></div>

    <!-- --------------- -->

    <!-- adult travellers -->
    <div class="col-md-3">
        <div class="form-group">
            <label for="span_value_adult" id="adult">Adult (+12 yrs)</label>
            <select class="lead-input-text fullWidth" id="span_value_adult" name="span_value_adult" required>
                @for($i=1;$i<=10;$i++)
                    <option value="{{ $i }}" @if($i == $data->span_value_adult) selected @endif>
                        {{ $i }} {{ $i == 1 ? 'Adult' : 'Adults' }}
                    </option>
                @endfor
            </select>
        </div>
    </div>

    <!-- --------------- -->

    <!-- child traveller -->
    <div class="col-md-3">
        <div class="form-group">
            <label for="span_value_child" id="childwithbed">Child(with bed) (2-12 yrs)</label>
            <select class="lead-input-text fullWidth" id="span_value_child" name="span_value_child">
                <option selected disabled>Select</option>
                @for($i=1;$i<=10;$i++)
                <option value="{{ $i }}" @if($i == $data->span_value_child) selected @endif>
                        {{ $i }} {{ $i == 1 ? 'Child' : 'Children' }}
                    </option>
                @endfor
            </select>
        </div>
    </div>

    <!-- --------------- -->

    <!-- child without bed traveller -->
    <div class='col-md-3' id="childwithoutbedContainer">
        <div class="form-group">
            <label for="span_value_child_without_bed" id="childwithoutbed">Child(without bed) (2-12 yrs)</label>
            <select class="lead-input-text fullWidth" id="span_value_child_without_bed" name="span_value_child_without_bed">
                <option selected disabled>Select</option>
                @for($i=1;$i<=10;$i++)
                <option value="{{ $i }}" @if($i == $data->span_value_child_without_bed) selected @endif>
                        {{ $i }} {{ $i == 1 ? 'Child' : 'Children' }}
                    </option>
                @endfor
            </select>
        </div>
    </div>

    <!-- --------------- -->

    <!-- infant traveller -->
    <div class="col-md-3">
        <div class="form-group">
            <label for="span_value_infant" id="infant">Infant (0-2 yrs)</label>
            <select class="lead-input-text fullWidth" id="span_value_infant" name="span_value_infant">
                <option selected disabled>Select</option>
                @for($i=1;$i<=10;$i++)
                <option value="{{ $i }}" @if($i == $data->span_value_child_without_bed) selected @endif>
                        {{ $i }} {{ $i == 1 ? 'Infant' : 'Infants' }}
                    </option>
                @endfor
            </select>
        </div>
    </div>

    <!-- --------------- -->

    <!-- remarks -->
    <div class="col-md-12">
        <div class="form-group">
            <label for="message">Additional Message / Requests</label>
            <input type="text" class="lead-input-text fullWidth" id="message" name="message" value="{{$data->message}}" placeholder="Enter remarks (if any)" />
        </div>
    </div>

<script type="text/javascript">
var APP_URL = document.querySelector("#APP_URL").value;
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    var data = {
        _token: csrfToken
    };

    // Function to handle fetch requests
    function fetchCountryData(endpoint, elementId) {
        var url = `${APP_URL}/${endpoint}`;
        
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(rdata => {
            document.querySelector(elementId).innerHTML = rdata;
        })
        .catch(error => {
            console.error(`Error fetching data from ${endpoint}:`, error);
        });
    }

    // Fetch Country Code
    fetchCountryData('country_code', '#country_code');

    // Fetch Country of Residence
    fetchCountryData('country_query_s', '#country_of_residence');
</script>

<!-- <script type="text/javascript">
$('#editEnquiryModal').on('shown.bs.modal', function () {
    const serviceTypeSelect = document.getElementById('service_type');
    const cruiseLine = document.getElementById('cruiseline').parentElement.parentElement;
    const cruiseCabin = document.getElementById('cruisecabin').parentElement.parentElement;
    const visaType = document.getElementById('visatype').parentElement.parentElement;
    const visaEntry = document.getElementById('visaentry').parentElement.parentElement;
    const visaService = document.getElementById('visaservice').parentElement.parentElement;
    const expBudget = document.getElementById('exp_budget').parentElement.parentElement;
    const hotelPref = document.getElementById('hotel_pre').parentElement.parentElement;

    function showhideservicetype() {
        const serviceType = serviceTypeSelect.value;

        cruiseLine.style.display = 'block';
        cruiseCabin.style.display = 'block';
        visaType.style.display = 'block';
        visaEntry.style.display = 'block';
        visaService.style.display = 'block';
        expBudget.style.display = 'block';
        hotelPref.style.display = 'block';

        if (serviceType === 'Tour Package' || serviceType === 'Accommodation') {
            cruiseLine.style.display = 'none';
            cruiseCabin.style.display = 'none';
            visaType.style.display = 'none';
            visaEntry.style.display = 'none';
            visaService.style.display = 'none';
        } else if (serviceType === 'Cruise') {
            visaType.style.display = 'none';
            visaEntry.style.display = 'none';
            visaService.style.display = 'none';
        } else if (serviceType === 'Visa') {
            cruiseLine.style.display = 'none';
            cruiseCabin.style.display = 'none';
        }
    }

    serviceTypeSelect.addEventListener('change', showhideservicetype);

    // Initial call to set the correct visibility when the modal is shown
    showhideservicetype();
});
</script> -->
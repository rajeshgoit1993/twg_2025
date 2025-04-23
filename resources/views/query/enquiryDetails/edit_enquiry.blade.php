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

        if ($cities !== 'NA' && !is_null($cities)) {
            // Only unserialize if $cities is a string
            if (is_string($cities)) {
                $cities = unserialize($cities);
            }

            if (is_array($cities) && !empty($cities)) {
                $output = '';
                $a = 1;

                foreach ($cities as $c) {
                    // If $c is an ID, fetch city name; otherwise, use $c directly
                    $cityName = is_numeric($c) && class_exists('CustomHelpers')
                        ? CustomHelpers::get_master_table_data('city', 'id', $c, 'name')
                        : $c;

                    if ($a > 1) {
                        $output .= ', ';
                    }
                    $output .= $cityName ?? 'Unknown City';
                    $a++;
                }
            } else {
                $output = $data->destinations ?? 'No destinations specified';
            }
        } else {
            $output = $data->destinations ?? 'Cities not available';
        }
    } else {
        $output = $data->destinations ?? 'No destinations specified';
    }
?>

<input type="hidden" value="{{ $id }}" name="query_id" id="query_id" />
<input type="hidden" value="{{ (int)$data->packageId }}" name="package_id" id="package_id" />

<div class="col-md-12">
    <div class="form-group">
        <label>Enquiry Ref No: #{{ $data->enquiry_ref_no }}</label>
    </div>
</div>

<!-- service type -->
<div class="col-md-6">
    <div class="form-group">
        <label for="service_type">Service Type</label>
        <select class="lead-input-text fullWidth" id="service_type" name="service_type" required>
            <option value="" disabled {{ old('service_type', $data->service_type) ? '' : 'selected' }}>Select Service</option>
            @foreach ([
                'Tour Package' => 'Tour Package',
                'Accommodation' => 'Hotels, Resorts & Villa',
                'Visa' => 'Visa',
                'Cruise' => 'Cruise',
                'Travel_Insurance' => 'Travel Insurance',
                'Activity' => 'Activity'
            ] as $value => $label)
                <option value="{{ $value }}" {{ old('service_type', $data->service_type) == $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<!-- channel type -->
<div class="col-md-6">
    <div class="form-group">
        <label for="channel_type">Channel Type</label>
        <select class="lead-input-text fullWidth" id="channel_type" name="channel_type" required>
            <option value="" disabled {{ old('channel_type', $data->channel_type) ? '' : 'selected' }}>Select Service</option>
            @foreach (['B2C' => 'B2C', 'B2B' => 'B2B', 'Corporate' => 'Corporate'] as $value => $label)
                <option value="{{ $value }}" {{ old('channel_type', $data->channel_type) == $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<!-- traveller name -->
<div class="col-md-6">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="lead-input-text fullWidth" id="name" name="name" value="{{ old('name', $data->name) }}" placeholder="Enter name" required />
    </div>
</div>

<?php 
    $loged_user = Sentinel::getUser();
?>
@if($loged_user->lock_before_quote_send == '')
    <!-- email id -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="email">Email ID</label>
            <input type="text" class="lead-input-text fullWidth" id="email" name="email" value="{{ old('email', $data->email) }}" placeholder="Enter email id" />
        </div>
    </div>

    <!-- mobile number -->
    <div class="col-md-6">
        <div class="form-group">
            <div class="makeflex">
                <div style="margin-right: 5px;">
                    <label for="country_code">Country Code</label>
                    <select class="lead-input-text fullWidth" id="country_code" name="country_code"></select>
                </div>
                <div class="fullWidth">
                    <label for="mobile">Mobile Number</label>
                    <input type="text" class="lead-input-text fullWidth" id="mobile" name="mobile" value="{{ old('mobile', $data->mobile) }}" placeholder="Enter mobile number" />
                </div>
            </div>
        </div>
    </div>
@else
    <!-- contact email id -->
    <div class="col-md-6">
        <div class="form-group">
            <label>Email ID</label>
            <input type="text" class="lead-input-text fullWidth" id="email" name="email" value="{{ old('email', CustomHelpers::partiallyHideEmail($data->email)) }}" placeholder="Enter email id" />
        </div>
    </div>

    <!-- mobile number -->
    <div class="col-md-6">
        <div class="form-group">
            <div class="makeflex">
                <div style="margin-right: 5px;">
                    <label for="country_code">Country Code</label>
                    <select class="lead-input-text fullWidth" id="country_code" name="country_code"></select>
                </div>
                <div class="fullWidth">
                    <label for="mobile">Mobile Number</label>
                    <input type="text" class="lead-input-text fullWidth" id="mobile" name="mobile" value="{{ old('mobile', CustomHelpers::mask_mobile_no($data->mobile)) }}" placeholder="Enter mobile number" />
                </div>
            </div>
        </div>
    </div>
@endif

<!-- connect time -->
<div class="col-md-6">
    <div class="form-group">
        <label for="time_call">Connect Time</label>
        <select class="lead-input-text fullWidth" id="time_call" name="time_call" required>
            <option value="0" disabled {{ old('time_call', $data->time_call) ? '' : 'selected' }}>Select Time To Call</option>
            @foreach ([
                '09 - 11 AM' => 'Between 09 - 11 AM',
                '11 - 01 PM' => 'Between 11 - 01 PM',
                '01 - 03 PM' => 'Between 01 - 03 PM',
                '03 - 05 PM' => 'Between 03 - 05 PM',
                '05 - 07 PM' => 'Between 05 - 07 PM',
                '07 - 09 PM' => 'Between 07 - 09 PM'
            ] as $value => $label)
                <option value="{{ $value }}" {{ old('time_call', $data->time_call) == $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<!-- nationality -->
<div class="col-md-6">
    <div class="form-group">
        <label for="country_of_residence">Nationality</label>
        <select class="lead-input-text fullWidth" id="country_of_residence" name="country_of_residence"></select>
    </div>
</div>

<!-- destination -->
<div class="col-md-6">
    <div class="form-group">
        <label for="destinations">Destination</label>
        <input type="text" class="lead-input-text fullWidth" id="destinations" name="destinations" value="{{ old('destinations', $output) }}" placeholder="Enter destination" required />
    </div>
</div>

<!-- travel date -->
<div class="col-md-6">
    <div class="form-group">
        <label for="date_arrival">Travel Date</label>
        <input type="text" class="lead-input-text fullWidth" id="date_arrival" name="date_arrival" value="{{ date('d M Y', strtotime($data->date_arrival)) }}" required />
    </div>
</div>

<!-- starting city -->
<div class="col-md-6">
    <div class="form-group">
        <label for="city_of_residence">Starting City</label>
        <input type="text" class="lead-input-text fullWidth" id="city_of_residence" name="city_of_residence" value="{{ old('city_of_residence', $data->city_of_residence) }}" placeholder="Enter starting city" required />
    </div>
</div>    

<!-- duration -->
<div class="col-md-6">
    <div class="form-group">
        <label for="duration">Duration</label>
        <select class="lead-input-text fullWidth" name="duration" id="duration" required>
            <option value="" disabled selected>Select Duration</option>
            @for ($i = 2; $i <= 180; $i++)
                <option value="{{ $i }}" @if(old('duration', $day_s) == $i) selected @endif>{{ $i - 1 }} Nights / {{ $i }} Days</option>
            @endfor
        </select>
    </div>
</div>

<!-- cruise lines -->
<div class="col-md-6">
    <div class="form-group">
        <label for="cruiseline">Cruise Lines</label>
        @php
            $cruiseLines = [
                'Any' => 'Any',
                'Cordeila' => 'Cordeila Cruises',
                'Resort World' => 'Resort World Cruises',
                'Royal Caribbean' => 'Royal Caribbean Cruises',
                'Celebrity' => 'Celebrity Cruises',
                'Azamara Club' => 'Azamara Club Cruises',
                'Norwegian' => 'Norwegian Cruise Line',
            ];
        @endphp
        <select class="lead-input-text fullWidth" name="cruiseline" id="cruiseline">
            <option value="">Select Cruise Lines</option>
            @foreach($cruiseLines as $value => $label)
                <option value="{{ $value }}" {{ old('cruiseline', $data->cruiseline ?? '') == $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<!-- cruise cabin type -->
<div class="col-md-6">
    <div class="form-group">
        <label for="cruisecabin">Cruise Cabin</label>
        @php
            $cabinTypes = ['Any', 'Interior', 'Oceanview', 'Balcony', 'Suite'];
        @endphp
        <select class="lead-input-text fullWidth" name="cruisecabin" id="cruisecabin">
            <option value="">Select Cabin Type</option>
            @foreach($cabinTypes as $cabin)
                <option value="{{ $cabin }}" {{ old('cruisecabin', $data->cruisecabin ?? '') == $cabin ? 'selected' : '' }}>
                    {{ $cabin }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<!-- visa type -->
<div class="col-md-6">
    <div class="form-group">
        <label for="visatype">Visa Type</label>
        @php
            $visaTypes = [
                'Tourist' => 'Tourist',
                'Business' => 'Business',
                'Student' => 'Student',
                'Transit' => 'Transit',
            ];
        @endphp
        <select class="lead-input-text fullWidth" name="visatype" id="visatype">
            <option value="">Select Visa</option>
            @foreach($visaTypes as $value => $label)
                <option value="{{ $value }}" {{ old('visatype', $data->visatype ?? '') == $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<!-- visa entry -->
<div class="col-md-6">
    <div class="form-group">
        <label for="visaentry">Visa Entry</label>
        @php
            $visaEntries = [
                'Single Entry' => 'Single Entry',
                'Multiple Entry' => 'Multiple Entry',
            ];
        @endphp
        <select class="lead-input-text fullWidth" name="visaentry" id="visaentry">
            <option value="">Select Entry Type</option>
            @foreach($visaEntries as $value => $label)
                <option value="{{ $value }}" {{ old('visaentry', $data->visaentry ?? '') == $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<!-- visa express service -->
<div class="col-md-6">
    <div class="form-group">
        <label for="visaservice">Visa Service</label>
        @php
            $visaServices = [
                'Single Entry' => 'Single Entry',
                'Multiple Entry' => 'Multiple Entry',
            ];
        @endphp
        <select class="lead-input-text fullWidth" name="visaservice" id="visaservice">
            <option value="">Select Visa Service</option>
            @foreach($visaServices as $value => $label)
                <option value="{{ $value }}" {{ old('visaservice', $data->visaservice ?? '') == $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<!-- hotel preference -->
<div class="col-md-6">
    <div class="form-group">
        <label for="hotel_pre">Hotel Preference</label>
        <select class="lead-input-text fullWidth" name="hotel_pre" id="hotel_pre" required>
            <option value="">Select</option>
            @foreach(range(2, 5) as $star)
                <option value="{{ $star }}" {{ old('hotel_pre', $data->hotel_pre ?? '') == $star ? 'selected' : '' }}>
                    {{ $star }} Star
                </option>
            @endforeach
        </select>
    </div>
</div>

<!-- package name -->
<div class="col-md-6">
    <div class="form-group">
        <label for="package_name">Enquiry Source</label>
        <input type="text" class="lead-input-text disabled fullWidth" id="package_name" name="package_name" value="{{ old('package_name', !empty($data->package_name) ? $data->package_name : 'Quick Enquiry') }}" placeholder="Enter package name" disabled>
    </div>
</div>

<!-- expected budget -->
<div class="col-md-6">
    <div class="form-group">
        <div class="relativeCont">
            <label for="exp_budget">Budget <span class="font12 fontItalic">(per person)</span></label>
            <div class="icon-input-group">
                <span class="icon-input-group-addon rupee-container" aria-hidden="true"></span>
                <input type="text" class="lead-input-text fullWidth" id="exp_budget" name="exp_budget" value="{{ old('exp_budget', $data->exp_budget ?? '') }}" placeholder="Enter budget" style="border: none;" readonly />
            </div>
            <!-- budget slider -->
            <div class="budgetPriceBarBox" id="budgetSliderContainer" style="display: none;">
                <input type="range" min="3000" max="800000" value="3000" class="budgetSlider" id="budgetSlider">
                <div class="rangeSection">
                    <span class="min-price-label defaulCurrency_slider"> 3,000</span>
                    <span class="max-price-label defaulCurrency_slider"> 800,000</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12"></div>

<!-- adult travellers -->
<div class="col-md-3">
    <div class="form-group">
        <label for="span_value_adult" id="adult">Adult (+12 yrs)</label>
        <select class="lead-input-text fullWidth" id="span_value_adult" name="span_value_adult" required>
            @foreach(range(1, 10) as $i)
                <option value="{{ $i }}" {{ old('span_value_adult', $data->span_value_adult ?? '') == $i ? 'selected' : '' }}>
                    {{ $i }} {{ $i == 1 ? 'Adult' : 'Adults' }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<!-- child traveller -->
<div class="col-md-3">
    <div class="form-group">
        <label for="span_value_child" id="childwithbed">Child (with bed) (2-12 yrs)</label>
        <select class="lead-input-text fullWidth" id="span_value_child" name="span_value_child">
            <option value="" selected>Select</option>
            @foreach(range(1, 10) as $i)
                <option value="{{ $i }}" {{ old('span_value_child', $data->span_value_child ?? '') == $i ? 'selected' : '' }}>
                    {{ $i }} {{ $i == 1 ? 'Child' : 'Children' }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<!-- child without bed traveller -->
<div class="col-md-3" id="childwithoutbedContainer">
    <div class="form-group">
        <label for="span_value_child_without_bed" id="childwithoutbed">Child (without bed) (2-12 yrs)</label>
        <select class="lead-input-text fullWidth" id="span_value_child_without_bed" name="span_value_child_without_bed">
            <option value="" selected>Select</option>
            @foreach(range(1, 10) as $i)
                <option value="{{ $i }}" {{ old('span_value_child_without_bed', $data->span_value_child_without_bed ?? '') == $i ? 'selected' : '' }}>
                    {{ $i }} {{ $i == 1 ? 'Child' : 'Children' }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<!-- infant traveller -->
<div class="col-md-3">
    <div class="form-group">
        <label for="span_value_infant" id="infant">Infant (0-2 yrs)</label>
        <select class="lead-input-text fullWidth" id="span_value_infant" name="span_value_infant">
            <option value="" selected>Select</option>
            @foreach(range(1, 10) as $i)
                <option value="{{ $i }}" {{ old('span_value_infant', $data->span_value_infant ?? '') == $i ? 'selected' : '' }}>
                    {{ $i }} {{ $i == 1 ? 'Infant' : 'Infants' }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<!-- remarks -->
<div class="col-md-12">
    <div class="form-group">
        <label for="message">Additional Message / Requests</label>
        <input type="text" class="lead-input-text fullWidth" id="message" name="message" value="{{ old('message', $data->message ?? '') }}" placeholder="Enter remarks (if any)" />
    </div>
</div>

<script type="text/javascript">
$('#editEnquiryModal, #enquiryModal').on('shown.bs.modal', function () {
    var APP_URL = document.querySelector("#APP_URL").value;

    function fetchCountryData(endpoint, elementId) {
        var url = `${APP_URL}/${endpoint}`;

        fetch(url, {
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP Error! Status: ${response.status}`);
            }
            return response.text();
        })
        .then(rdata => {
            var element = document.querySelector(elementId);
            if (element) {
                element.innerHTML = rdata;
            } else {
                console.error(`Error: Element '${elementId}' not found in the DOM.`);
            }
        })
        .catch(error => {
            console.error(`Error fetching data from ${endpoint}:`, error);
        });
    }

    // Fetch Country Code
    fetchCountryData('country_code', '#country_code');

    // Fetch Country of Residence
    fetchCountryData('country_query_s', '#country_of_residence');
});
</script>
<!-- query/view-lead-details -->
<form action="#" method="post" id="enq_data" name="enq_data">
	<div class="modal-body custom_border" id="modal-body" >
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
		<input type='hidden' value="{{ $id }}" name='query_id' id='package_id' />
		<input type='hidden' value="{{ (int)$data->packageId }}" name='package_id' id='package_id' />

		<div class="col-md-12">
		    <div class="form-group">
		        <label>Enquiry Ref No: #{{ $data->enquiry_ref_no }}</label>
		        <br>
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
    
		<div class="" style="padding: 0px 20px; margin-bottom: 10px; display: flex; align-items: center">
		    <div class="col-md-3 col-xs-4" style="padding: 0px; margin-right: 20px"><strong>Name</strong></div>
		    <div class="col-md-9 col-xs-8" style="padding: 5px 10px; height: 35px; border-radius: 3px; border: 1px solid #ccc; text-transform: capitalize">{{ $data->name }}</div>
		</div>
		@php
		    $loged_user = Sentinel::getUser();
		@endphp
		@if($loged_user->lock_before_quote_send == '')
		    <div class="" style="padding: 0px 20px; margin-bottom: 10px; display: flex; align-items: center">
		        <div class="col-md-3 col-xs-4" style="padding: 0px; margin-right: 20px"><strong>Contact Number</strong></div>
		        <div class="col-md-9 col-xs-8" style="padding: 5px 10px; height: 35px; border-radius: 3px; border: 1px solid #ccc; text-transform: capitalize">{{ $data->mobile }}</div>
		    </div>
		    <div class="" style="padding: 0px 20px; margin-bottom: 10px; display: flex; align-items: center">
		        <div class="col-md-3 col-xs-4" style="padding: 0px; margin-right: 20px"><strong>Email Id</strong></div>
		        <div class="col-md-9 col-xs-8" style="padding: 5px 10px; height: 35px; border-radius: 3px; border: 1px solid #ccc; text-transform: lowercase">{{ $data->email }}</div>
		    </div>
		@else
		    <div class="" style="padding: 0px 20px; margin-bottom: 10px; display: flex; align-items: center">
		        <div class="col-md-3 col-xs-4" style="padding: 0px; margin-right: 20px"><strong>Contact Number</strong></div>
		        <div class="col-md-9 col-xs-8" style="padding: 5px 10px; height: 35px; border-radius: 3px; border: 1px solid #ccc; text-transform: capitalize">{{ CustomHelpers::mask_mobile_no($data->mobile) }}</div>
		    </div>
		    <div class="" style="padding: 0px 20px; margin-bottom: 10px; display: flex; align-items: center">
		        <div class="col-md-3 col-xs-4" style="padding: 0px; margin-right: 20px"><strong>Email Id</strong></div>
		        <div class="col-md-9 col-xs-8" style="padding: 5px 10px; height: 35px; border-radius: 3px; border: 1px solid #ccc; text-transform: lowercase">{{ CustomHelpers::partiallyHideEmail($data->email) }}</div>
		    </div>
		@endif
		<div class="" style="padding: 0px 20px; margin-bottom: 10px; display: flex; align-items: center">
		    <div class="col-md-3 col-xs-4" style="padding: 0px; margin-right: 20px"><strong>Residence City</strong></div>
		    <div class="col-md-9 col-xs-8" style="padding: 5px 10px; height: 35px; border-radius: 3px; border: 1px solid #ccc; text-transform: capitalize">{{ $data->city_of_residence }}</div>
		</div>
		<div class="" style="padding: 0px 20px; margin-bottom: 10px; display: flex; align-items: center">
		    <div class="col-md-3 col-xs-4" style="padding: 0px; margin-right: 20px"><strong>Country</strong></div>
		    <div class="col-md-9 col-xs-8" style="padding: 5px 10px; height: 35px; border-radius: 3px; border: 1px solid #ccc; text-transform: capitalize">{{ $data->country_of_residence }}</div>
		</div>
		<div class="" style="padding: 0px 20px; margin-bottom: 10px; display: flex; align-items: center">
		    <div class="col-md-3 col-xs-4" style="padding: 0px; margin-right: 20px"><strong>Destination</strong></div>
		    <div class="col-md-9 col-xs-8" style="padding: 5px 10px; height: 35px; border-radius: 3px; border: 1px solid #ccc; text-transform: capitalize">{{ implode(', ', $cities) }}</div>
		</div>
		<div class="" style="padding: 0px 20px; margin-bottom: 10px; display: flex; align-items: center">
		    <div class="col-md-3 col-xs-4" style="padding: 0px; margin-right: 20px"><strong>Arrival Date</strong></div>
		    <div class="col-md-9 col-xs-8" style="padding: 5px 10px; height: 35px; border-radius: 3px; border: 1px solid #ccc; text-transform: capitalize">{{ date('d-m-Y', strtotime($data->date_arrival)) }}</div>
		</div>
		@php
		    $day_s = (int)filter_var($data->duration, FILTER_SANITIZE_NUMBER_INT);
		    $nights = $day_s - 1;
		    $duration = "$nights Nights / $day_s Days";
		@endphp
		<div class="" style="padding: 0px 20px; margin-bottom: 10px; display: flex; align-items: center">
		    <div class="col-md-3 col-xs-4" style="padding: 0px; margin-right: 20px"><strong>Duration</strong></div>
		    <div class="col-md-9 col-xs-8" style="padding: 5px 10px; height: 35px; border-radius: 3px; border: 1px solid #ccc; text-transform: capitalize">{{ $duration }}</div>
		</div>
		<div class="" style="padding: 0px 20px; margin-bottom: 10px; display: flex; align-items: center">
		    <div class="col-md-3 col-xs-4" style="padding: 0px; margin-right: 20px"><strong>Travellers</strong></div>
		    <div class="col-md-9 col-xs-8" style="padding: 5px 10px; height: 35px; border-radius: 3px; border: 1px solid #ccc; text-transform: capitalize">{{ $travellers }}</div>
		</div>
		<div class="" style="padding: 0px 20px; margin-bottom: 10px; display: flex; align-items: center">
		    <div class="col-md-3 col-xs-4" style="padding: 0px; margin-right: 20px"><strong>Hotel Preference</strong></div>
		    <div class="col-md-9 col-xs-8" style="padding: 5px 10px; height: 35px; border-radius: 3px; border: 1px solid #ccc; text-transform: capitalize">{{ $data->hotel_pre }} Star</div>
		</div>
		<div class="" style="padding: 0px 20px; margin-bottom: 10px; display: flex; align-items: center">
		    <div class="col-md-3 col-xs-4" style="padding: 0px; margin-right: 20px"><strong>Expected Budget</strong></div>
		    <div class="col-md-9 col-xs-8" style="padding: 5px 10px; height: 35px; border-radius: 3px; border: 1px solid #ccc; text-transform: capitalize">{{ $data->exp_budget }}</div>
		</div>
		<div class="" style="padding: 0px 20px; margin-bottom: 10px; display: flex; align-items: center">
		    <div class="col-md-3 col-xs-4" style="padding: 0px; margin-right: 20px"><strong>Best Time To Call</strong></div>
		    <div class="col-md-9 col-xs-8" style="padding: 5px 10px; height: 35px; border-radius: 3px; border: 1px solid #ccc; text-transform: capitalize">{{ $data->time_call }}</div>
		</div>
		<div class="" style="padding: 0px 20px; margin-bottom: 10px; display: flex; align-items: center">
		    <div class="col-md-3 col-xs-4" style="padding: 0px; margin-right: 20px"><strong>Message</strong></div>
		    <div class="col-md-9 col-xs-8" style="padding: 5px 10px; height: 35px; border-radius: 3px; border: 1px solid #ccc; text-transform: capitalize">{{ $data->message }}</div>
		</div>
		<div class="" style="padding: 0px 20px; margin-bottom: 10px; display: flex; align-items: center">
		    <div class="col-md-3 col-xs-4" style="padding: 0px; margin-right: 20px"><strong>Package Name</strong></div>
		    <div class="col-md-9 col-xs-8" style="padding: 5px 10px; height: 35px; border-radius: 3px; border: 1px solid #ccc; text-transform: capitalize">{{ $package_name }}</div>
		</div>
	</div>
</form>
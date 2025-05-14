<style type="text/css">
.item-container {
	box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.2);
	border: 1px solid #e9e9e9;
	border-radius: 10px;
	padding: 30px;
	margin-bottom: 20px;
	display: -webkit-box;
	display: inline-block;
	width: 100%;
}
#cke_inclusions, #cke_exclusions{
	display: none;
}
</style>

		<div class="quoteDtlsCont">

			<!-- left section -->
			<div class="left-section">
				<form action="{{ URL::to('/save_quote') }}" method="post" id="quo1" name="quo1">
					<input type="hidden" name="type" value=""/>
					<input type="hidden" name="query_id" value="{{ $data->id }}"/>
					<input type="hidden" name="action_type" value="{{ $action_type }}"/>

					@if($action_type == 'quote_edit')
						<input type="hidden" name="quote_id" value="{{$packagesData->id}}"/>
					@endif
					{{csrf_field()}}

					<!--Trip Details-->
					<div class="panel-item-cont">
						<div class="accordion panelHeading down-arrow">
							<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Trip Details <span class="requiredcolor">*</span></h4>
						</div>
						<div class="panelBox">
							<div class="panelContent">
								@include('manage_packages.packages-blocks.package-info')
							</div>
						</div>
					</div>

					<!--Trip Guest Room-->
					<div class="panel-item-cont">
						<div class="accordion panelHeading down-arrow">
							<i class="fa fa-user-o" aria-hidden="true"></i> Guest Room <span class="requiredcolor">*</span></h4>
						</div>
						<div class="panelBox">
						    <div class="panelContent">
						    	@if($action_type=='quote')
						  @include('query.quotation.guest_room_create')      
						       @else
						  @include('query.quotation.guest_room_edit')    

						       @endif
						    </div> <!-- panelContent end -->
						</div> <!-- panelBox end -->
					</div>

					<!--Trip Pricing-->
					<div class="panel-item-cont">
						<div class="accordion panelHeading down-arrow">
							<i class="fa fa-money" aria-hidden="true"></i> Trip Pricing <span class="requiredcolor">*</span></h4>
						</div>
						<div class="panelBox mobScroll scrollX">
							<div class="panelContent">
								@if($action_type=='quote')
							  		@include('query.quotation.price_create')
							  	@else
							  		@include('query.quotation.price_edit')
							  	@endif
								<!-- Price type selection section -->
							</div>
						</div>
					</div>
					
					<!--Trip Accommodation-->
					<div class="panel-item-cont">
						<div class="accordion panelHeading down-arrow">
							<i class="fa fa-bed" aria-hidden="true"></i> Trip Accommodation <span class="requiredcolor">*</span></h4>
						</div>
						<div class="panelBox">
							<div class="panelContent">
								@include('manage_packages.packages-blocks.accommodation')
							</div>
						</div>
					</div>

					<!--Trip Flight-->
					<div class="panel-item-cont">
						<div class="accordion panelHeading down-arrow">
							<i class="fa fa-plane" aria-hidden="true"></i> Flight <span class="requiredcolor">*</span></h4>
						</div>
						<div class="panelBox">
							<div class="panelContent">
								@include('manage_packages.packages-blocks.flights')
							</div>
						</div>
					</div>

					<!--Trip Transfers-->
					<div class="panel-item-cont">
						<div class="accordion panelHeading down-arrow">
							<i class="fa fa-bus" aria-hidden="true"></i> Transfers (Car, Bus, Train) <span class="requiredcolor">*</span></h4>
						</div>
						<div class="panelBox">
							<div class="panelContent">
								@include('manage_packages.packages-blocks.transfers')
							</div>
						</div>
					</div>

					<!--Trip Overview-->
					<div class="panel-item-cont">
						<div class="accordion panelHeading down-arrow">
							<i class="fa fa-sticky-note-o" aria-hidden="true"></i> Trip Overview (Add-on Service & Highlights) <span class="requiredcolor">*</span></h4>
						</div>
						<div class="panelBox">
							<div class="panelContent">
								@include('manage_packages.packages-blocks.description')
							</div>
						</div>
					</div>

					<!--Trip Inclusions & Exclusions-->
					<div class="panel-item-cont">
						<div class="accordion panelHeading down-arrow">
							<i class="fa fa-plus-circle" aria-hidden="true"></i> Inclusions & Exclusions <span class="requiredcolor">*</span></h4>
						</div>
						<div class="panelBox">
							<div class="panelContent">
								@include('manage_packages.packages-blocks.inclusions')
							</div>
						</div>
					</div>

					<!--Trip Itinerary-->
					<div class="panel-item-cont">
						<div class="accordion panelHeading down-arrow">
							<i class="fa fa-map-marker" aria-hidden="true"></i> Trip Itinerary <span class="requiredcolor">*</span></h4>
						</div>
						<div class="panelBox">
							<div class="panelContent">
								@include('manage_packages.packages-blocks.itinerary')
							</div>
						</div>
					</div>

					<!--Trip Policy-->
					<div class="panel-item-cont">
						<div class="accordion panelHeading down-arrow">
							<i class="fa fa-info-circle" aria-hidden="true"></i> Trip Policies (Visa, Payment, Cancellation & Important Notes) <span class="requiredcolor">*</span></h4>
						</div>

						<div class="panelBox">
							<div class="panelContent">
								@include('manage_packages.packages-blocks.policies')
							</div>
						</div>
					</div>

					<!--Trip Quote Validity-->
					<div class="panel-item-cont">
						<div class="accordion panelHeading down-arrow">
							<i class="fa fa-calendar-times-o" aria-hidden="true"></i> Quote Validity <span class="requiredcolor">*</span></h4>
						</div>
						@if($action_type=='quote')
							@include('query.quotation.quote_validity_create')
						@else
							@include('query.quotation.quote_validity_edit')
						@endif
					</div>

					<!--Greetings & Signature-->
					<div class="panel-item-cont">
						<div class="accordion panelHeading down-arrow">
							<i class="fa fa-user" aria-hidden="true"></i> Greetings & Signature <span class="requiredcolor">*</span>
						</div>
						@if($action_type=='quote')
							@include('query.quotation.quote_signatire_create')
						@else
							@include('query.quotation.quote_signatire_edit')
						@endif
					</div>
					
					<!-- save or send quote -->
					<div class="col-md-12">
						<div class="saveOptions">
							<!-- select save quote -->
							<div class="savePreview">
								<label class="radio-inline">
								<input type="radio" value="1" name="send_option" checked>Save & Preview</label>
							</div>

							<!-- select send quote -->
							<div class="saveSend" style="display: none;">
								<label class="radio-inline">
								<input type="radio" value="0" name="send_option">Save & Send</label>
							</div>
						</div>
					</div>

					<!-- continue -->
					<div class="col-md-12">
						<div class="saveQuote">
							<button type="submit" name="add" id="remove" class="btnblue btnQuoteSave">Continue</button>
						</div>
					</div>
				</form>
			</div>

			<!-- right section -->
			<div class="right-section sidebar">
				<!--Enquiry Details-->
				<div class="panel-item-cont">
					<div class="panelHeading">
						<i class="fa fa-file-o" aria-hidden="true"></i> Enquiry Details <span class="requiredcolor">*</span>
					</div>
					
					<div class="panelBox" style="display: block; max-height: inherit;">
						<div class="panelContent">
							<!-- lead details -->
							@include('query.enquiryDetails.edit_enquiry')
						</div>
					</div>
				</div>
			</div>
		</div>

@section("custom_js_code")

<script type="text/javascript">
	// disabled/readonly all enquiry fields and field display based on service type
	//$('#enquiryModal').on('shown.bs.modal', function () {
	document.addEventListener('DOMContentLoaded', function () {
	    // Wait for the modal to be shown before attaching event listeners
	    const serviceTypeSelect = document.getElementById('service_type');
	    const cruiseLine = document.getElementById('cruiseline').parentElement.parentElement;
	    const cruiseCabin = document.getElementById('cruisecabin').parentElement.parentElement;
	    const visaType = document.getElementById('visatype').parentElement.parentElement;
	    const visaEntry = document.getElementById('visaentry').parentElement.parentElement;
	    const visaService = document.getElementById('visaservice').parentElement.parentElement;
	    const expBudget = document.getElementById('exp_budget').parentElement.parentElement;
	    const hotelPref = document.getElementById('hotel_pre').parentElement.parentElement;
	    const budgetInput = document.getElementById("exp_budget");
	    const budgetSliderContainer = document.getElementById("budgetSliderContainer");
	    const budgetSliderElement = document.getElementById("budgetSlider");
	    const durationSelect = document.getElementById('duration');
	    const childWithoutBed = document.getElementById("childwithoutbed");
	    const childwithoutbedContainer = document.getElementById("childwithoutbedContainer");
	    
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
	            /*defaultDurationSetup(); // Update duration options for Tour Package, Accommodation, and Activity*/
	            resetAgeLabels();
	            dateRangePicker();
	        } else if (serviceType === 'Activity') {
	            hotelPref.style.display = 'none';
	            cruiseLine.style.display = 'none';
	            cruiseCabin.style.display = 'none';
	            visaType.style.display = 'none';
	            visaEntry.style.display = 'none';
	            visaService.style.display = 'none';
	            /*defaultDurationSetup(); // Update duration options for Tour Package, Accommodation, and Activity*/
	            resetAgeLabels();
	            dateRangePicker();
	        } else if (serviceType === 'Cruise') {
	            visaType.style.display = 'none';
	            visaEntry.style.display = 'none';
	            visaService.style.display = 'none';
	            hotelPref.style.display = 'none';
	            /*updateCruiseDurationOptions(); // Update duration options for Cruise*/
	            resetAgeLabels();
	            cruiseDateRangePicker();
	        } else if (serviceType === 'Visa') {
	            cruiseLine.style.display = 'none';
	            cruiseCabin.style.display = 'none';
	            expBudget.style.display = 'none';
	            hotelPref.style.display = 'none';
	            childWithoutBed.style.display = 'none';
	            childwithoutbedContainer.style.display = 'none';
	            /*updateVisaDurationOptions(); // Update duration options for Visa*/
	            updateVisaAgeLabels();
	            dateRangePicker();
	        } else if (serviceType === 'Travel_Insurance') {
	            cruiseLine.style.display = 'none';
	            cruiseCabin.style.display = 'none';
	            visaType.style.display = 'none';
	            visaEntry.style.display = 'none';
	            visaService.style.display = 'none';
	            expBudget.style.display = 'none';
	            hotelPref.style.display = 'none';
	            /*updateTravelInsuranceDurationOptions(); // Update duration options for Travel Insurance*/
	            updateInsuranceAgeLabels();
	            dateRangePicker();
	        }
	    }

	    function dateRangePicker() {
	        var today = new Date();

	        // Set the minimum date to 2 days from today
	        today.setDate(today.getDate() + 0);
	        var minDate = today.toISOString().split('T')[0];

	        // Set the maximum date to 180 days from today
	        today.setDate(today.getDate() + 240); // Already added 0 days, so 240 - 0 = 240 days
	        var maxDate = today.toISOString().split('T')[0];

	        // Apply the min and max attributes
	        var dateInput = document.getElementById('date_arrival');
	        dateInput.setAttribute('min', minDate);
	        dateInput.setAttribute('max', maxDate);
	    }

	    function cruiseDateRangePicker() {
	        var today = new Date();

	        // Set the minimum date to 2 days from today
	        today.setDate(today.getDate() + 0);
	        var minDate = today.toISOString().split('T')[0];

	        // Set the maximum date to 180 days from today
	        today.setDate(today.getDate() + 1095); // Already added 0 days, so 1095 - 0 = 1095 days
	        var maxDate = today.toISOString().split('T')[0];

	        // Apply the min and max attributes
	        var dateInput = document.getElementById('date_arrival');
	        dateInput.setAttribute('min', minDate);
	        dateInput.setAttribute('max', maxDate);
	    }

	    /*--------*/

	    function updateVisaAgeLabels() {
	        document.getElementById("adult").innerHTML = "Adult (+18yrs)";
	        document.getElementById("childwithbed").innerHTML = "Child (2-18yrs)";
	        document.getElementById("childwithoutbed").innerHTML = "Traveller (61-70yrs)"; // disabled in visa through showhideservice
	        document.getElementById("infant").innerHTML = "Infant (0-2yrs)";
	    }

	    function updateInsuranceAgeLabels() {
	        document.getElementById("adult").innerHTML = "Traveller (0-40yrs)";
	        document.getElementById("childwithbed").innerHTML = "Traveller (41-60yrs)";
	        document.getElementById("childwithoutbed").innerHTML = "Traveller (61-70yrs)";
	        document.getElementById("infant").innerHTML = "Traveller (+71yrs)";
	    }

	    function resetAgeLabels() {
	        document.getElementById("adult").innerHTML = "Adult (+12yrs)";
	        document.getElementById("childwithbed").innerHTML = "Child with bed (2-12yrs)";
	        document.getElementById("childwithoutbed").innerHTML = "Child without bed (2-12yrs)";
	        document.getElementById("infant").innerHTML = "Infant (0-2yrs)";
	    }

	    function budgetSlider() {
	        // Function to round the budget value to the nearest 2500
	        function roundToNearestValue(x) {
	            return Math.round(x / 2500) * 2500;
	        }

	        // Function to add commas to the budget value for better readability
	        function numberWithCommas(x) {
	            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	        }

	        // Function to update slider track color dynamically based on thumb position
	        function updateSliderTrackColor() {
	            var percentage = (budgetSliderElement.value - budgetSliderElement.min) / (budgetSliderElement.max - budgetSliderElement.min);
	            var color = 'linear-gradient(90deg, #08B2ED ' + percentage * 100 + '%, #d3d3d3 ' + percentage * 100 + '%)';
	            budgetSliderElement.style.background = color;
	        }

	        // Hide the budget slider container initially
	        budgetSliderContainer.style.display = "none";

	        // Add click event listener to the budget input
	        budgetInput.addEventListener("click", function(event) {
	            budgetSliderContainer.style.display = budgetSliderContainer.style.display === "none" ? "block" : "none";
	            event.stopPropagation(); // Prevent the click event from propagating to the document body
	        });

	        // Add input event listener to the budget slider
	        budgetSliderElement.addEventListener("input", function() {
	            // Round the slider value to the nearest 2500
	            var roundedValue = roundToNearestValue(budgetSliderElement.value);
	            // Update the slider value
	            budgetSliderElement.value = roundedValue;
	            // Update the input value with commas
	            budgetInput.value = numberWithCommas(roundedValue);
	            // Update slider track color
	            updateSliderTrackColor();
	        });

	        // Add click event listener to the document body
	        document.body.addEventListener("click", function() {
	            budgetSliderContainer.style.display = "none";
	        });

	        // Prevent the budget slider container from closing when clicking inside of it
	        budgetSliderContainer.addEventListener("click", function(event) {
	            event.stopPropagation(); // Prevent the click event from propagating to the document body
	        });

	        // Update slider track color initially
	        updateSliderTrackColor();
	    }

	    serviceTypeSelect.addEventListener('change', function() {
	        showhideservicetype();
	    });

	    // Initial call to set the correct visibility and initialize budget slider when the modal is shown
	    showhideservicetype();
	    budgetSlider();


	    // *********************
	    

	    // disabled enquiry details field to readonly
	    const displayArea = document.getElementById('enquiryDisplay');

	    if (displayArea.classList.contains('readonly-mode')) {
	    	displayArea.querySelectorAll('input, select, textarea').forEach(function(element) {
	    		if (element.tagName.toLowerCase() === 'select' || 
	    			element.type === 'checkbox' || 
	    			element.type === 'radio') {
	    			element.disabled = true;
		    	} else {
		    		element.readOnly = true;
		    	}
		    	// Set background color for all elements
		    	element.style.backgroundColor = '#f2f2f2';
		    	element.style.pointerEvents = 'none'; // Optional: prevent even cursor focus
	    	});
	    }
	});
</script>

@endsection
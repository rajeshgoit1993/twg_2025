@extends('layouts.master')

@section('custom_css_code')

<!-- ready only mode for edit_enquiry.blade -->
<style>
.readonly-mode input,
.readonly-mode select,
.readonly-mode textarea {
    background-color: #f2f2f2;
    pointer-events: none; /* Optional: fully block clicks */
}
</style>

@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="makeflex aligncenter padding10">
                        <a href="{{ URL::to('/quote-pending') }}">
                            <button type="button" class="btn btn-success apndRt20">
                                <i class="glyphicon glyphicon-arrow-left"></i> Back
                            </button>
                        </a>
                        <div class="box-header">
                            <!-- query -> quo_first -->
                            <h3 class="box-title">Create Quotation</h3>
                        </div>
                    </div>
                    
                    <div class="box-body" style="padding-top: 0px">
                        <div class="panel-body">
                            <?php 
                                $id = $data->id;
                            ?>
                            <!-- enquiry details -->
                            @include('query.enquiryDetails.edit_enquiry')

                            <div class="apndTop20">
                                <div class="col-md-12">
                                    @if($allowCreateQuotation)
                                        <!-- Create Quotation -->
                                        <a href="{{ URL::to('quo_new/'.$data->id) }}">
                                            <button type="button" name="add" class="btn btn-success">Create Quotation</button>
                                        </a>
                                    @endif

                                    <!-- Import Quotation -->
                                    <a href="{{ URL::to('quo_copy/'.$data->id) }}">
                                        <button type="button" name="add" class="btn btn-success">Import Quotation</button>
                                    </a>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<!-- Hidden Base URL for JS -->
<div class="testing">
    <input type="hidden" value="{{url('/')}}" id="test">
</div>

<!-- JS Scripts -->
<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

@endsection

@section("custom_js_code")

<script type="text/javascript">
    // edit enquiry (now only view enquiry-copied from edit-lead.js)
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


        // disabled/readonly all enquiry fields (no edit required here)    
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
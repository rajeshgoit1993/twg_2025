// edit-lead
$(document).ready(function () {
    // Event handler for opening the editEnquiryModal
    $(document).on('click', '.open-editEnquiryModal', function() {
        // Set the bookId input value to the data-id attribute of the clicked element
        $('#bookId').val($(this).data('id'));

        // Remove the 'btn-warning' class and add the 'btn-success' class to the clicked element
        $(this).removeClass('btn-view-quote').addClass('btn-viewed-lead');

        // Get the data-id attribute value
        var id = $(this).data('id');

        // Perform an AJAX GET request to fetch data
        $.ajax({
            type: 'get',
            url: APP_URL + '/enq_datas',
            data: {id: id},
            success: function(data) {
                console.log('Success: ' + data);

                // Clear the modal body and append the fetched data
                $("#modal-body").empty().append(data);

$('#date_arrival').datepicker({
    format: 'dd M yyyy', 
    autoclose: true,
    todayHighlight: true,
    startDate: '0d',
});
                // Show the modal
                $('#editEnquiryModal').modal('show');
            },
            error: function(data) {
                // console.log('Error: ' + data);
                // Log detailed error response
                console.log('Error Status: ' + data.status);
                console.log('Error Response: ' + data.responseText);
            }
        });
    });

    // Event handler for updating enquiry data
    $(document).on("click", "#enq_update", function() {
        // Create a FormData object from the form with id "enq_data"
        var form_data = new FormData($("#enq_data")[0]);

        // Perform an AJAX POST request to update data
        $.ajax({
            url: APP_URL + '/enq_update_data',
            data: form_data,
            type: 'post',
            contentType: false,
            processData: false,
            success: function(data) {
                if(data === "success") {
                    setTimeout(function() {
                        location.reload();
                    }, 300);
                } else {
                    alert(data);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error: ' + error);
            }
        });
    });

    // edit enquiry
	$('#editEnquiryModal').on('shown.bs.modal', function () {
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

	    /*function defaultDurationSetup() {

	        // Check if the duration select already has options populated by the server
	        if (durationSelect.options.length > 0) {
	            return; // Do nothing if options are already populated
	        }

	        // Clear existing options
	        durationSelect.innerHTML = "";

	        for (let i = 1; i <= 20; i++) {
	            const optionDiv = document.createElement('option');
	            optionDiv.value = `${i + 1} days`;
	            optionDiv.textContent = (i === 1) ? `${i} Night / ${i + 1} Days` : `${i} Nights / ${i + 1} Days`;
	            durationSelect.appendChild(optionDiv);
	        }

	        // Set the first option as selected
	        durationSelect.value = "2 days";
	    }

	    function updateVisaDurationOptions() {
	        // Check if the duration select already has options populated by the server
	        if (durationSelect.options.length > 0) {
	            return; // Do nothing if options are already populated
	        }

	        const visaDurations = [
	            { value: "15 days", text: "15 days" },
	            { value: "30 days", text: "30 days" },
	            { value: "60 days", text: "60 days" },
	            { value: "90 days", text: "3 months" },
	            { value: "180 days", text: "6 months" },
	            { value: "365 days", text: "1 year" },
	            { value: "730 days", text: "2 years" },
	            { value: "1825 days", text: "5 years" },
	            { value: "3650 days", text: "10 years" }
	        ];

	        // Clear existing options
	        durationSelect.innerHTML = "";

	        // Add new options for Visa duration
	        visaDurations.forEach(function(duration) {
	            const option = document.createElement('option');
	            option.value = duration.value;
	            option.textContent = duration.text;
	            durationSelect.appendChild(option);
	        });

	        // Set the first option as selected
	        if (visaDurations.length > 0) {
	            durationSelect.value = visaDurations[0].value;
	        }
	    }

	    function updateCruiseDurationOptions() {
	        // Check if the duration select already has options populated by the server
	        if (durationSelect.options.length > 0) {
	            return; // Do nothing if options are already populated
	        }

	        // Clear existing options
	        durationSelect.innerHTML = "";

	        for (let i = 1; i <= 30; i++) {
	            const optionDiv = document.createElement('option');
	            optionDiv.value = `${i + 1} days`;
	            optionDiv.textContent = (i === 1) ? `${i} Night / ${i + 1} Days` : `${i} Nights / ${i + 1} Days`;
	            durationSelect.appendChild(optionDiv);
	        }

	        // Set the first option as selected
	        durationSelect.value = "2 days";
	    }

	    function updateTravelInsuranceDurationOptions() {
	        // Check if the duration select already has options populated by the server
	        if (durationSelect.options.length > 0) {
	            return; // Do nothing if options are already populated
	        }

	        // Clear existing options
	        durationSelect.innerHTML = "";

	        for (let i = 2; i <= 179; i++) {
	            const option = document.createElement('option');
	            option.value = `${i} days`;
	            option.textContent = `${i} Days`;
	            durationSelect.appendChild(option);
	        }

	        durationSelect.value = `${2} days`;
	    }*/

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
	});
});
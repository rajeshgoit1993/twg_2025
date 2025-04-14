document.addEventListener("DOMContentLoaded", function () {
    const customSelectIds = [
        { selectId: "service_type_select", hiddenInputId: "service_type" },
        { selectId: "channel_type_select", hiddenInputId: "channel_type" },
        { selectId: "time_call_select", hiddenInputId: "time_call" },
        { selectId: "cruiseline_select", hiddenInputId: "cruiseline" },
        { selectId: "cruisecabin_select", hiddenInputId: "cruisecabin" },
        { selectId: "visatype_select", hiddenInputId: "visatype" },
        { selectId: "visaentry_select", hiddenInputId: "visaentry" },
        { selectId: "visaservice_select", hiddenInputId: "visaservice" }
    ];

    customSelectIds.forEach(({ selectId, hiddenInputId }) => {
        initCustomSelect(selectId, hiddenInputId);
    });

    // Initialize the event listeners and reset functions
    const preferenceSelectionHandler = handlePreferenceSelection();
    const additionalDetailsHandlers = handleAdditionalDetailsChange();

    capitalizeInput('name');
    capitalizeInput('destinations');
    capitalizeInput('city_of_residence')
    lowercaseInput('email');

    setupCountryCodeSelect();
    setupCountryOfResidenceSelect();
    setupDurationSelect();
    dateValidity();
    addTravellers();
    budgetSlider();
    handleServiceTypeFieldChange();

    showHideService();
    
    setDefaultOption("channel_type_select", "B2C"); // keep this first
    setDefaultOption("service_type_select", "Tour Package"); // keep this second

	function initCustomSelect(selectId, hiddenInputId) {
	    const select = document.getElementById(selectId);
	    const selectedOption = select.querySelector(".selected");
	    const optionsContainer = select.querySelector(".options");
	    const hiddenInput = document.getElementById(hiddenInputId);

	    // Function to close all select options
	    function closeAllSelects() {
	        document.querySelectorAll('.custom-select .options.active').forEach(container => {
	            container.classList.remove('active');
	        });
	    }

	    // Function to toggle the options container
	    function toggleOptions() {
	        closeAllSelects();
	        optionsContainer.classList.toggle("active");
	    }

	    selectedOption.addEventListener("click", (e) => {
	        e.stopPropagation();
	        toggleOptions();
	    });

	    optionsContainer.addEventListener("click", (e) => {
	        const option = e.target.closest(".option");
	        if (option) {
	            const value = option.dataset.value;
	            const displayText = option.textContent;
	            selectedOption.textContent = displayText;
	            hiddenInput.value = value;

	            const previouslySelected = optionsContainer.querySelector(".option.selected");
	            if (previouslySelected) {
	                previouslySelected.classList.remove("selected");
	            }
	            option.classList.add("selected");
	            optionsContainer.classList.remove("active");

	            // Clear error message
	            const errorId = hiddenInput.id + "_error";
	            const errorElement = document.getElementById(errorId);
	            if (errorElement) {
	            	errorElement.innerHTML = ""; // Clear error message
	        	}
	        }
	    });

	    window.addEventListener("click", (e) => {
	        if (!select.contains(e.target)) {
	            closeAllSelects();
	        }
	    });

	    window.addEventListener("keydown", (e) => {
	        if (e.key === "Escape") {
	            closeAllSelects();
	        }
	    });

	    select.addEventListener("keydown", (e) => {
	        const activeOption = optionsContainer.querySelector(".option:focus");
	        if (e.key === "ArrowDown") {
	            e.preventDefault();
	            if (e.altKey) {
	                // Alt + Down Arrow to open the options container
	                toggleOptions();
	            } else {
	                // Navigate options
	                if (activeOption && activeOption.nextElementSibling) {
	                    activeOption.nextElementSibling.focus();
	                } else {
	                    optionsContainer.querySelector(".option").focus();
	                }
	            }
	        } else if (e.key === "ArrowUp") {
	            e.preventDefault();
	            if (activeOption && activeOption.previousElementSibling) {
	                activeOption.previousElementSibling.focus();
	            } else {
	                optionsContainer.querySelector(".option:last-child").focus();
	            }
	        } else if (e.key === "Enter" && activeOption) {
	            e.preventDefault();
	            activeOption.click();
	        } else if (e.key === " ") {
	            e.preventDefault();
	            toggleOptions();
	        }
	    });

	    // Add tabindex for focusability
	    select.setAttribute('tabindex', '0');

	    // Handle focus and blur events for accessibility
	    select.addEventListener('focus', () => {
	        select.classList.add('focus');
	    });

	    select.addEventListener('blur', () => {
	        select.classList.remove('focus');
	        const errorId = hiddenInput.id + "_error";
	        const errorElement = document.getElementById(errorId);
	        if (errorElement) {
	        	errorElement.innerHTML = ""; // Clear error message
	        }
	    });
	}

	function setDefaultOption(selectId, defaultOptionText) {
	    const selectElement = document.getElementById(selectId);
	    const hiddenInputId = selectElement.getAttribute("data-hidden-input");
	    const hiddenInput = document.getElementById(hiddenInputId);
	    const options = selectElement.querySelectorAll(".option");

	    options.forEach(option => {
	        if (option.textContent.trim() === defaultOptionText) {
	            option.classList.add("selected");
	            hiddenInput.value = option.dataset.value;  // Ensure value is set correctly
	        } else {
	            option.classList.remove("selected");
	        }
	    });

	    // Update the selected option text even if it's not found (for cases like page load)
	    selectElement.querySelector(".selected").textContent = defaultOptionText;
	}

	/***********************************************/

	// The showHideService function
	function showHideService() {
	    // Get the selected service type from the hidden input
	    const serviceType = document.getElementById("service_type").value;

	    // Elements to show/hide
	    const displayhtlpref = document.getElementById("displayhtlpref");
	    const displayfltbkngpref = document.getElementById("displayfltbkngpref");
	    const displayHtlBkng = document.getElementById("displayHtlBkng");
	    const hideBlankSpace = document.getElementById("hideBlankSpace");
	    const displayBlankSpace = document.getElementById("displayBlankSpace");
	    /*const displayfamilytrip = document.getElementById("displayfamilytrip");
	    const displayleisuretrip = document.getElementById("displayleisuretrip");
	    const displayhoneymoontrip = document.getElementById("displayhoneymoontrip");
	    const displaybusinesstrip = document.getElementById("displaybusinesstrip");*/
	    const displayDepartureCity = document.getElementById("displayDepartureCity");

	    const tourAdtnlDtls = document.getElementById("tourAdtnlDtls");

	    const displayBudget = document.getElementById("displayBudget");
	    const displayVisaType = document.getElementById("displayVisaType");
	    const displayVisaEntry = document.getElementById("displayVisaEntry");
	    const displayVisaService = document.getElementById("displayVisaService");
	    const displayCruiseLine = document.getElementById("displayCruiseLine");
	    const displayCruiseCabin = document.getElementById("displayCruiseCabin");
	    const cwobTraveller = document.getElementById("cwob_traveller");

	    // Conditions for specific services
	    const isTourPackage = (serviceType === "Tour Package");
	    const isAccommodation = (serviceType === "Accommodation");
	    const isCruise = (serviceType === "Cruise");
	    const isVisa = (serviceType === "Visa");
	    const isActivity = (serviceType === "Activity");

	    /*----------*/

	    // Handle Tour Package
	    if (isTourPackage) {
	    	displayfltbkngpref.classList.remove("d-none");
	        displayDepartureCity.classList.remove("d-none");
	        displayBudget.classList.remove("d-none");
	        displayBlankSpace.classList.remove("d-none");
	        tourAdtnlDtls.classList.remove("d-none");
	        displayHtlBkng.classList.add("d-none");
	        hideBlankSpace.classList.add("d-none");
	    } else {
	    	displayfltbkngpref.classList.add("d-none");
	        tourAdtnlDtls.classList.add("d-none");
	        displayDepartureCity.classList.add("d-none");
	        displayHtlBkng.classList.add("d-none");
	        displayBlankSpace.classList.add("d-none");
	    }

	    /*----------*/

	    // Handle Accommodation
	    if (isAccommodation) {
	        tourAdtnlDtls.classList.add("d-none")
	        hideBlankSpace.classList.remove("d-none");
	    }

	    /*----------*/

	    // Show/Hide fields based on service type
	    if (isTourPackage || isAccommodation) {
	        displayhtlpref.classList.remove("d-none");
	    } else {
	        displayhtlpref.classList.add("d-none");
	    }

	    /*----------*/

	    // Handle Visa
	    if (isVisa) {
	        displayVisaType.classList.remove("d-none");
	        displayVisaEntry.classList.remove("d-none");
	        displayVisaService.classList.remove("d-none");
	        cwobTraveller.classList.add("d-none");
	    } else {
	        displayVisaType.classList.add("d-none");
	        displayVisaEntry.classList.add("d-none");
	        displayVisaService.classList.add("d-none");
	        cwobTraveller.classList.remove("d-none");
	    }

	    /*----------*/

	    // Handle Cruise
	    if (isCruise) {
	    	displayDepartureCity.classList.remove("d-none");
	        displayBudget.classList.remove("d-none"); // Ensure displayBudget is shown
	        displayCruiseLine.classList.remove("d-none");
	        displayCruiseCabin.classList.remove("d-none");
	    } else {
	        displayCruiseLine.classList.add("d-none");
	        displayCruiseCabin.classList.add("d-none");
	    }

	    /*----------*/

	    // Handle Activity
	    if (isActivity) {
	        displayDepartureCity.classList.remove("d-none");
	        displayfltbkngpref.classList.remove("d-none");	 
	        displayHtlBkng.classList.remove("d-none");
	        cwobTraveller.classList.add("d-none");
	        hideBlankSpace.classList.add("d-none");
	        displayBlankSpace.classList.add("d-none");
	    }

	    /*----------*/

	    // Handle Budget for all relevant service types
	    if (isTourPackage || isAccommodation || isCruise || isActivity) {
	        displayBudget.classList.remove("d-none");
	    } else {
	        displayBudget.classList.add("d-none");
	    }

	    /*----------*/

	    // Call the hotel preference handler
    	handleHotelCategorySelection();
    	preferenceSelectionHandler.reset();
        additionalDetailsHandlers.reset();

    	/*// Reset the Connect Time custom select input (also in form validation, both are mandatory if two different dom)
    	resetConnectTime();

    	// Reset travellers
    	resetTravellers();*/

    	resetFields();

	    /*----------*/
	}

	/***********************************************/

    function capitalizeInput(inputId) {
    	const input = document.getElementById(inputId);
    	input.addEventListener('input', function() {
    		this.value = this.value.replace(/\b\w/g, function(char) {
    			return char.toUpperCase();
    		});
    	});
    }

    function lowercaseInput(inputId) {
    	const input = document.getElementById(inputId);
    	input.addEventListener('input', function() {
    		this.value = this.value.toLowerCase();
    	});
    }

    function setupCountryCodeSelect() {
        const selectElement = document.getElementById("country_code");

        function createCustomSelect() {
            const container = document.getElementById("country_code_select_container");
            const customSelect = document.createElement("div");
            customSelect.id = "country_code_select";
            customSelect.classList.add("custom-select");
            customSelect.classList.add("outline");

            const selectedOption = document.createElement("div");
            selectedOption.classList.add("selected");
            selectedOption.textContent = selectElement.options[selectElement.selectedIndex].textContent;

            const optionsContainer = document.createElement("div");
            optionsContainer.classList.add("options");

            Array.from(selectElement.options).forEach(option => {
                const customOption = document.createElement("div");
                customOption.classList.add("option");
                customOption.dataset.value = option.value;
                customOption.textContent = option.textContent;

                if (option.value === "0") {
                    customOption.classList.add("disabled");
                    customOption.setAttribute("disabled", "disabled");
                }

                optionsContainer.appendChild(customOption);

                if (option.selected) {
                    customOption.classList.add("selected");
                }
            });

            customSelect.appendChild(selectedOption);
            customSelect.appendChild(optionsContainer);
            container.appendChild(customSelect);
            selectElement.style.display = "none";

            initCustomSelect("country_code_select", "country_code");

            customSelect.addEventListener("click", () => {
                const selected = optionsContainer.querySelector(".option.selected");
                if (selected) {
                    selected.scrollIntoView({ behavior: "smooth", block: "nearest", inline: "start" });
                }
            });

            optionsContainer.addEventListener("click", (e) => {
                const option = e.target.closest(".option");
                if (option && option.classList.contains("disabled")) {
                    alert("Please select a valid country code.");
                }
            });
        }

        if (selectElement.options.length > 0) {
            createCustomSelect();
        } else {
            const observer = new MutationObserver(() => {
                if (selectElement.options.length > 0) {
                    observer.disconnect();
                    createCustomSelect();
                }
            });
            observer.observe(selectElement, { childList: true });
        }
    }

    function setupCountryOfResidenceSelect() {
        const selectElement = document.getElementById("country_of_residence");

        if (!selectElement) {
            console.error("Country of residence select element not found.");
            return;
        }

        function createCustomSelect() {
            const customSelectContainer = document.getElementById("country_of_residence_select");
            const selectedOption = customSelectContainer.querySelector(".selected");
            const optionsContainer = customSelectContainer.querySelector(".options");

            optionsContainer.innerHTML = '';

            Array.from(selectElement.options).forEach(option => {
                const customOption = document.createElement("div");
                customOption.classList.add("option");
                customOption.dataset.value = option.value;
                customOption.textContent = option.textContent;

                optionsContainer.appendChild(customOption);

                if (option.selected) {
                    selectedOption.textContent = option.textContent;
                    customOption.classList.add("selected");
                    setTimeout(() => customOption.scrollIntoView({ behavior: "smooth", block: "nearest", inline: "start" }), 100);
                }
            });

            initCustomSelect("country_of_residence_select", "country_of_residence");

            optionsContainer.addEventListener("click", (e) => {
                const option = e.target.closest(".option");
                if (option) {
                    const selectedOption = optionsContainer.querySelector(".option.selected");
                    if (selectedOption) {
                        selectedOption.classList.remove("selected");
                    }
                    option.classList.add("selected");
                    setTimeout(() => option.scrollIntoView({ behavior: "smooth", block: "nearest", inline: "start" }), 100);
                }
            });
	    }

        if (selectElement.options.length > 0) {
            createCustomSelect();
        } else {
            const observer = new MutationObserver(() => {
                if (selectElement.options.length > 0) {
                    observer.disconnect();
                    createCustomSelect();
                }
            });
            observer.observe(selectElement, { childList: true });
        }
    }

    /*function dateValidity() { // if using input type=text
	    var today = new Date();

	    // Set the minimum date to 2 days from today
	    today.setDate(today.getDate() + 2);
	    var minDate = today.toISOString().split('T')[0];

	    // Set the maximum date to 180 days from today
	    today.setDate(today.getDate() + 238); // Already added 2 days, so 240 - 2 = 238 days
	    var maxDate = today.toISOString().split('T')[0];

	    // Apply the min and max attributes
	    var dateInput = document.getElementById('date_arrival');
	    dateInput.setAttribute('min', minDate);
	    dateInput.setAttribute('max', maxDate);
	}*/

    function dateValidity() {
	    var commonOptions = {
	        dateFormat: "d M yy", // Format for date picker (can also use "D, d M yy" for day name)
	        minDate: 0,           // Prevents selecting dates before today
	        maxDate: "+12M",      // Limits selection to 12 months ahead
	        numberOfMonths: 1,    // Always show 1 month
	        onSelect: function (selectedDate) {
	            updateDateComponents(selectedDate); // Update UI on date select

	            // Close the calendar after a date is selected
	            $("#tripTravelDate").datepicker("hide").blur();
	        }
	    };

	    // Adjust the number of months displayed based on screen width
	    if (window.innerWidth >= 992) {
	        commonOptions.numberOfMonths = 2; // One month side by side for desktop
	    } else {
	        commonOptions.numberOfMonths = 1; // One month for mobile
	    }

	    // Destroy and reinitialize the datepicker for #tripTravelDate
	    if ($("#tripTravelDate").data("datepicker")) {
	        $("#tripTravelDate").datepicker("destroy");
	    }

	    $("#tripTravelDate").datepicker(commonOptions);
	}

	function cruiseDateValidity() {
	    var today = new Date();

	    // Set the minimum date to 2 days from today
	    today.setDate(today.getDate() + 2);
	    var minDate = today.toISOString().split('T')[0];

	    // Set the maximum date to 180 days from today
	    today.setDate(today.getDate() + 908); // Already added 2 days, so 910 - 2 = 908 days
	    var maxDate = today.toISOString().split('T')[0];

	    // Apply the min and max attributes
	    var dateInput = document.getElementById('date_arrival');
	    dateInput.setAttribute('min', minDate);
	    dateInput.setAttribute('max', maxDate);
	}

	function addTravellers() {
	    // Remove existing event listeners
	    $(".span_inc_adult, .span_des_adult, .span_inc_child, .span_des_child, .span_inc_child_without_bed, .span_des_child_without_bed, .span_inc_infant, .span_des_infant").off();

	    // Adult
	    $(".span_inc_adult").click(function() {
	        var span_value_adult = $(".span_value_adult").html();
	        $(".span_value_adult").html(parseInt(span_value_adult) + 1);
	        $(".span_value_adult1").val(parseInt(span_value_adult) + 1);
	    });
	    $(".span_des_adult").click(function() {
	        var span_value_adult = $(".span_value_adult").html();
	        if (span_value_adult >= 2) {
	            $(".span_value_adult").html(parseInt(span_value_adult) - 1);
	            $(".span_value_adult1").val(parseInt(span_value_adult) - 1);
	        }
	    });

	    // Child with bed
	    $(".span_inc_child").click(function() {
	        var span_value_child = $(".span_value_child").html();
	        $(".span_value_child").html(parseInt(span_value_child) + 1);
	        $(".span_value_child1").val(parseInt(span_value_child) + 1);
	    });
	    $(".span_des_child").click(function() {
	        var span_value_child = $(".span_value_child").html();
	        if (span_value_child >= 1) {
	            $(".span_value_child").html(parseInt(span_value_child) - 1);
	            $(".span_value_child1").val(parseInt(span_value_child) - 1);
	        }
	    });

	    // Child without bed
	    $(".span_inc_child_without_bed").click(function() {
	        var span_value_child_without_bed = $(".span_value_child_without_bed").html();
	        $(".span_value_child_without_bed").html(parseInt(span_value_child_without_bed) + 1);
	        $(".span_value_child2").val(parseInt(span_value_child_without_bed) + 1);
	    });
	    $(".span_des_child_without_bed").click(function() {
	        var span_value_child_without_bed = $(".span_value_child_without_bed").html();
	        if (span_value_child_without_bed >= 1) {
	            $(".span_value_child_without_bed").html(parseInt(span_value_child_without_bed) - 1);
	            $(".span_value_child2").val(parseInt(span_value_child_without_bed) - 1);
	        }
	    });

	    // Infant
	    $(".span_inc_infant").click(function() {
	        var span_value_infant = $(".span_value_infant").html();
	        $(".span_value_infant").html(parseInt(span_value_infant) + 1);
	        $(".span_value_infant1").val(parseInt(span_value_infant) + 1);
	    });
	    $(".span_des_infant").click(function() {
	        var span_value_infant = $(".span_value_infant").html();
	        if (span_value_infant >= 1) {
	            $(".span_value_infant").html(parseInt(span_value_infant) - 1);
	            $(".span_value_infant1").val(parseInt(span_value_infant) - 1);
	        }
	    });
	}

	function budgetSlider() {
	    var budgetInput = document.getElementById("exp_budget");
	    var budgetSliderContainer = document.getElementById("budgetSliderContainer");
	    var budgetSlider = document.getElementById("budgetSlider");
	    var budgetError = document.getElementById("budget_error");

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
	        var percentage = (budgetSlider.value - budgetSlider.min) / (budgetSlider.max - budgetSlider.min);
	        var color = 'linear-gradient(90deg, #08B2ED ' + percentage * 100 + '%, #d3d3d3 ' + percentage * 100 + '%)';
	        budgetSlider.style.background = color;
	    }

	    // Hide the budget slider container initially
	    budgetSliderContainer.style.display = "none";

	    // Add click event listener to the budget input
	    budgetInput.addEventListener("click", function(event) {
	        budgetSliderContainer.style.display = budgetSliderContainer.style.display === "none" ? "block" : "none";
	        event.stopPropagation(); // Prevent the click event from propagating to the document body
	    });

	    // Add input event listener to the budget slider
	    budgetSlider.addEventListener("input", function() {
	        // Round the slider value to the nearest 50
	        var roundedValue = roundToNearestValue(budgetSlider.value);
	        // Update the slider value
	        budgetSlider.value = roundedValue;
	        // Update the input value with commas
	        budgetInput.value = numberWithCommas(roundedValue);
	        // Update slider track color
	        updateSliderTrackColor();

	        // Clear budget error message
	        budgetError.innerHTML = "";
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

	// update duration and age
    function handleServiceTypeFieldChange() {
	    const serviceTypeSelect = document.getElementById("service_type_select");
	    const selectedOption = serviceTypeSelect.querySelector(".selected");

	    serviceTypeSelect.addEventListener("click", () => {
	        const selectedServiceType = selectedOption.textContent.trim();

	        if (selectedServiceType === "Visa") {
	            updateVisaDurationOptions();
	            updateVisaAgeLabels();
	            dateValidity();
	        } else if (selectedServiceType === "Cruise") {
	            updateCruiseDurationOptions();
	            resetAgeLabels(); // Reset age labels for other service types
	            cruiseDateValidity();
	        } else if (selectedServiceType === "Travel Insurance") {
	            updateInsuranceAgeLabels();
	            dateValidity();
	        } else if (selectedServiceType === "Activity") {
	            updateActivityAgeLabels();
	            dateValidity();
	        } else {
	            revertToDefaultDurationOptions();
	            resetAgeLabels(); // Reset age labels for other service types
	            dateValidity();
	        }
	        // Reset duration options on service type change
	        setDefaultOption("displayDuration", "Select Duration");
	        showHideService();  // Call the function to show/hide fields based on service type
	    });
	}

	/***********************************************/

	function setupDurationSelect() {
        const durationSelectContainer = document.getElementById("displayDuration");
        const durationOptions = durationSelectContainer.querySelector(".options");
        const hiddenDurationInput = document.getElementById("duration");
        const selectedDuration = durationSelectContainer.querySelector(".selected");
        const durationError = document.getElementById("duration_error"); // Reference to the duration error element

        function selectDuration(value, text) {
            selectedDuration.innerText = text;
            hiddenDurationInput.value = value;
            durationOptions.classList.remove("active");

            // Clear the duration error message
            if (durationError) {
            	durationError.innerHTML = "";
            }
        }

        function populateDurationOptions() {
	        durationOptions.innerHTML = '';
	        for (let i = 1; i <= 20; i++) {
	            const optionDiv = document.createElement('div');
	            optionDiv.className = 'option';
	            optionDiv.dataset.value = `${i + 1}`;
	            optionDiv.innerText = (i === 1) ? `${i} Night / ${i + 1} Days` : `${i} Nights / ${i + 1} Days`;
	            optionDiv.addEventListener("click", () => selectDuration(optionDiv.dataset.value, optionDiv.innerText));
	            durationOptions.appendChild(optionDiv);
	        }
	    }

        selectedDuration.addEventListener("click", (e) => {
            e.stopPropagation();
            durationOptions.classList.add("active");
        });

        window.addEventListener("click", (e) => {
            if (!durationSelectContainer.contains(e.target)) {
                durationOptions.classList.remove("active");
            }
        });

        window.addEventListener("keydown", (e) => {
            if (e.key === "Escape") {
                durationOptions.classList.remove("active");
            }
        });

        durationSelectContainer.addEventListener("keydown", (e) => {
            const activeOption = durationOptions.querySelector(".option:focus");
            if (e.key === "ArrowDown") {
                e.preventDefault();
                if (activeOption && activeOption.nextElementSibling) {
                    activeOption.nextElementSibling.focus();
                } else {
                    durationOptions.querySelector(".option").focus();
                }
            } else if (e.key === "ArrowUp") {
                e.preventDefault();
                if (activeOption && activeOption.previousElementSibling) {
                    activeOption.previousElementSibling.focus();
                } else {
                    durationOptions.querySelector(".option:last-child").focus();
                }
            } else if (e.key === "Enter" && activeOption) {
                e.preventDefault();
                activeOption.click();
            }
        });

        // Populate the duration options initially
        populateDurationOptions();
    }

    /*function resetDurationSelect() {
    	const selectedDuration = document.getElementById("displayDuration").querySelector(".selected");
    	const hiddenDurationInput = document.getElementById("duration");
    	selectedDuration.innerText = "Select Duration";
    	hiddenDurationInput.value = "";
    }*/

    function updateVisaDurationOptions() {
        const durationSelectContainer = document.getElementById("displayDuration");
        const durationOptions = durationSelectContainer.querySelector(".options");
        const selectedDuration = durationSelectContainer.querySelector(".selected");
        const hiddenDurationInput = document.getElementById("duration");

        function selectDuration(value, text) {
            selectedDuration.innerText = text;
            hiddenDurationInput.value = value;
            durationOptions.classList.remove("active");
        }

        durationOptions.innerHTML = "";

        const visaDurations = [
            { value: "14", text: "15 days" },
            { value: "29", text: "30 days" },
            { value: "59", text: "60 days" },
            { value: "89", text: "3 months" },
            { value: "179", text: "6 months" },
            { value: "364", text: "1 year" },
            { value: "729", text: "2 years" },
            { value: "1824", text: "5 years" },
            { value: "3649", text: "10 years" }
        ];

        visaDurations.forEach(duration => {
            const optionDiv = document.createElement("div");
            optionDiv.className = "option";
            optionDiv.dataset.value = duration.value;
            optionDiv.textContent = duration.text;
            optionDiv.addEventListener("click", () => selectDuration(duration.value, duration.text));
            durationOptions.appendChild(optionDiv);
        });

        selectedDuration.addEventListener("click", (e) => {
            e.stopPropagation();
            durationOptions.classList.add("active");
        });

        window.addEventListener("click", (e) => {
            if (!durationSelectContainer.contains(e.target)) {
                durationOptions.classList.remove("active");
            }
        });

        window.addEventListener("keydown", (e) => {
            if (e.key === "Escape") {
                durationOptions.classList.remove("active");
            }
        });

        durationSelectContainer.addEventListener("keydown", (e) => {
            const activeOption = durationOptions.querySelector(".option:focus");
            if (e.key === "ArrowDown") {
                e.preventDefault();
                if (activeOption && activeOption.nextElementSibling) {
                    activeOption.nextElementSibling.focus();
                } else {
                    durationOptions.querySelector(".option").focus();
                }
            } else if (e.key === "ArrowUp") {
                e.preventDefault();
                if (activeOption && activeOption.previousElementSibling) {
                    activeOption.previousElementSibling.focus();
                } else {
                    durationOptions.querySelector(".option:last-child").focus();
                }
            } else if (e.key === "Enter" && activeOption) {
                e.preventDefault();
                activeOption.click();
            }
        });
    }

    function updateCruiseDurationOptions() {
	    const durationSelectContainer = document.getElementById("displayDuration");
	    const durationOptions = durationSelectContainer.querySelector(".options");
	    const selectedDuration = durationSelectContainer.querySelector(".selected");
	    const hiddenDurationInput = document.getElementById("duration");

	    function selectDuration(value, text) {
	        selectedDuration.innerText = text;
	        hiddenDurationInput.value = value;
	        durationOptions.classList.remove("active");
	    }

	    durationOptions.innerHTML = "";

	    for (let i = 2; i <= 30; i++) {
	        const optionDiv = document.createElement('div');
	        optionDiv.className = 'option';
	        optionDiv.dataset.value = `${i + 1}`;
	        optionDiv.innerText = (i === 1) ? `${i} Night / ${i + 1} Days` : `${i} Nights / ${i + 1} Days`;
	        optionDiv.onclick = () => selectDuration(optionDiv.dataset.value, optionDiv.innerText);
	        durationOptions.appendChild(optionDiv);
	    }

	    selectedDuration.addEventListener("click", (e) => {
	        e.stopPropagation();
	        durationOptions.classList.add("active");
	    });

	    window.addEventListener("click", (e) => {
	        if (!durationSelectContainer.contains(e.target)) {
	            durationOptions.classList.remove("active");
	        }
	    });

	    window.addEventListener("keydown", (e) => {
	        if (e.key === "Escape") {
	            durationOptions.classList.remove("active");
	        }
	    });

	    durationSelectContainer.addEventListener("keydown", (e) => {
	        const activeOption = durationOptions.querySelector(".option:focus");
	        if (e.key === "ArrowDown") {
	            e.preventDefault();
	            if (activeOption && activeOption.nextElementSibling) {
	                activeOption.nextElementSibling.focus();
	            } else {
	                durationOptions.querySelector(".option").focus();
	            }
	        } else if (e.key === "ArrowUp") {
	            e.preventDefault();
	            if (activeOption && activeOption.previousElementSibling) {
	                activeOption.previousElementSibling.focus();
	            } else {
	                durationOptions.querySelector(".option:last-child").focus();
	            }
	        } else if (e.key === "Enter" && activeOption) {
	            e.preventDefault();
	            activeOption.click();
	        }
	    });
	}

	function revertToDefaultDurationOptions() {
		setupDurationSelect();
	}

	/***********************************************/

	function updateVisaAgeLabels() {
	    document.getElementById("adult").innerHTML = "Adult<br>(+18yrs)";
	    document.getElementById("childwithbed").innerHTML = "Child<br>(2-18yrs)";
	    document.getElementById("childwithoutbed").innerHTML = "Traveller<br>(61-70yrs)"; // disabled in visa through showhideservice
	    document.getElementById("infant").innerHTML = "Infant<br>(0-2yrs)";
	}

	function updateInsuranceAgeLabels() {
	    document.getElementById("adult").innerHTML = "Traveller<br>(0-40yrs)";
	    document.getElementById("childwithbed").innerHTML = "Traveller<br>(41-60yrs)";
	    document.getElementById("childwithoutbed").innerHTML = "Traveller<br>(61-70yrs)";
	    document.getElementById("infant").innerHTML = "Traveller<br>(+71yrs)";
	}

	function updateActivityAgeLabels() {
	    document.getElementById("adult").innerHTML = "Adult<br>(+12yrs)";
	    document.getElementById("childwithbed").innerHTML = "Child<br>(2-12yrs)";
	    document.getElementById("childwithoutbed").innerHTML = "Traveller<br>(61-70yrs)"; // disabled in visa through showhideservice
	    document.getElementById("infant").innerHTML = "Infant<br>(0-2yrs)";
	}

	function resetAgeLabels() {
	    document.getElementById("adult").innerHTML = "Adult<br>(+12yrs)";
	    document.getElementById("childwithbed").innerHTML = "Child with bed<br>(2-12yrs)";
	    document.getElementById("childwithoutbed").innerHTML = "Child without bed<br>(2-12yrs)";
	    document.getElementById("infant").innerHTML = "Infant<br>(0-2yrs)";
	}

	/***********************************************/

	// Function to handle hotel star category selction radio buttons
	function handleHotelCategorySelection() {
	    const radioButtons = document.querySelectorAll('.hotel-selection input[type="radio"]');
	    const defaultHotelPreference = 4; // Default hotel preference value

	    // Function to handle change event for radio buttons
	    function handleRadioChange() {
	        // Remove the selected-item class from all labels
	        radioButtons.forEach(r => r.parentElement.classList.remove('selected-item'));

	        // Add the selected-item class to the selected label
	        if (this.checked) {
	            this.parentElement.classList.add('selected-item');
	        }
	    }

	    // Function to handle keypress event for radio buttons
	    function handleRadioKeypress(event) {
	        if (event.key === "Enter") {
	            this.click(); // Simulate click when Enter key is pressed
	        }
	    }

	    // Add event listeners for change and keypress events to each radio button
	    radioButtons.forEach(radio => {
	        radio.addEventListener('change', handleRadioChange);
	        radio.addEventListener('keypress', handleRadioKeypress);
	    });

	    // Initialize hotel preference radio buttons based on service type
	    const serviceType = document.getElementById("service_type").value;
	    const isTourPackage = (serviceType === "Tour Package");
	    const isAccommodation = (serviceType === "Accommodation");

	    if (isTourPackage || isAccommodation) {
	        // Reset radio buttons
	        radioButtons.forEach(radio => {
	            radio.checked = false;
	            radio.parentElement.classList.remove('selected-item');
	        });

	        // Check the radio button with value 4 by default
	        const defaultRadioButton = document.querySelector(`.hotel-selection input[type="radio"][value="${defaultHotelPreference}"]`);
	        if (defaultRadioButton) {
	            defaultRadioButton.checked = true;
	            defaultRadioButton.dispatchEvent(new Event('change'));
	        }
	        /*// Check the first radio button by default
	        const firstRadioButton = document.querySelector('.hotel-selection input[type="radio"]');
	        if (firstRadioButton) {
	            firstRadioButton.checked = true;
	            firstRadioButton.dispatchEvent(new Event('change'));
	        }*/
	    } else {
	        // Uncheck all radio buttons if not Tour Package or Accommodation
	        radioButtons.forEach(radio => {
	            radio.checked = false;
	            radio.parentElement.classList.remove('selected-item');
	        });
	    }
	}

	// Function to automatically resize a textarea based on its content
	function autoResize(textarea) {
	    textarea.style.height = 'auto';  // Reset the height first to measure the scrollHeight correctly
	    textarea.style.height = textarea.scrollHeight + 'px';  // Set the height based on the scrollHeight
	}

	function handlePreferenceSelection() {
	    const radioGroups = document.querySelectorAll('.flightPref');
	    const additionalDetailsTextarea = document.getElementById("additionaldetails");

	    // Function to handle change event for radio buttons
	    function handleRadioChange() {
	        const radioButtons = this.closest('.flightPref').querySelectorAll('input[type="radio"]');

	        // Remove the selected-item class from all labels in the same group
	        radioButtons.forEach(r => r.parentElement.classList.remove('selected-item'));

	        // Add the selected-item class to the selected label
	        if (this.checked) {
	            this.parentElement.classList.add('selected-item');
	        }

	        // Update the additional requests textarea
	        updateAdditionalDetails();
	        autoResize(additionalDetailsTextarea);  // Automatically resize textarea after updating
	    }

	    // Add event listeners for change events to each radio button in each group
	    radioGroups.forEach(group => {
	        const radioButtons = group.querySelectorAll('input[type="radio"]');
	        radioButtons.forEach(radio => {
	            radio.addEventListener('change', handleRadioChange);
	        });
	    });

	    // Function to reset all preference selections
	    function resetPreferenceSelection() {
	        radioGroups.forEach(group => {
	            const radioButtons = group.querySelectorAll('input[type="radio"]');
	            radioButtons.forEach(radio => {
	                radio.checked = false;
	                radio.parentElement.classList.remove('selected-item');
	            });
	        });
	        additionalDetailsTextarea.value = '';  // Clear the textarea when preferences are reset
	        autoResize(additionalDetailsTextarea);  // Reset the textarea size
	    }

	    // Resize the textarea on page load
	    autoResize(additionalDetailsTextarea);

	    return {
	        reset: resetPreferenceSelection
	    };
	}

	// Function to handle checkbox changes for additional details
	function handleAdditionalDetailsChange() {
	    const checkboxes = document.querySelectorAll('.additional_details');
	    const additionalDetailsTextarea = document.getElementById("additionaldetails");

	    // Function to update and resize the additional details textarea
	    function handleCheckboxChange() {
	        updateAdditionalDetails();
	        autoResize(additionalDetailsTextarea);  // Automatically resize textarea after updating
	    }

	    // Add event listeners for change events to each checkbox
	    checkboxes.forEach(checkbox => {
	        checkbox.addEventListener('change', handleCheckboxChange);
	    });

	    // Function to reset additional details checkboxes
	    function resetAdditionalDetails() {
	        checkboxes.forEach(checkbox => {
	            checkbox.checked = false;
	        });
	        updateAdditionalDetails();  // Update textarea to reflect reset state
	        autoResize(additionalDetailsTextarea);  // Resize textarea after resetting
	    }

	    // Resize the textarea on page load
	    autoResize(additionalDetailsTextarea);

	    return {
	        reset: resetAdditionalDetails
	    };
	}

	// Function to update the additional requests textarea
	function updateAdditionalDetails() {
	    const radioButtons = document.querySelectorAll('.preference-selection input[type="radio"]');
	    const checkboxes = document.querySelectorAll('.additional_details');
	    const additionalDetailsTextarea = document.getElementById("additionaldetails");
	    let details = [];

	    // Add flight and hotel booking preferences to the details array
	    radioButtons.forEach(radio => {
	        if (radio.checked) {
	            const name = radio.name; // Get the name attribute to distinguish between flight and hotel
	            if (name === 'flight_booking') {
	                details.push(`Flight ticket booked: ${radio.value === "0" ? "Yes" : "No"}`);
	            } else if (name === 'hotel_booking') {
	                details.push(`Hotel booked: ${radio.value === "0" ? "Yes" : "No"}`);
	            }
	        }
	    });

	    // Add additional details from checkboxes to the details array
	    checkboxes.forEach(checkbox => {
	        if (checkbox.checked) {
	            details.push(checkbox.value);
	        }
	    });

	    // Join the details array into a string with each item on a new line and update the textarea
	    additionalDetailsTextarea.value = details.join(',\n');
	}

	/***********************************************/

	function resetFields() {
	    const fields = [
	    	{ selectId: "visatype_select", hiddenInputId: "visatype", defaultText: "Select Visa Type" },
	        { selectId: "visaentry_select", hiddenInputId: "visaentry", defaultText: "Select Visa Entry" },
	        { selectId: "visaservice_select", hiddenInputId: "visaservice", defaultText: "Select Visa Service" },
	        { selectId: "cruiseline_select", hiddenInputId: "cruiseline", defaultText: "Select Cruise Lines" },
	        { selectId: "cruisecabin_select", hiddenInputId: "cruisecabin", defaultText: "Select Cruise Cabins" },
	        { selectId: "time_call_select", hiddenInputId: "time_call", defaultText: "Select time to call" },
	        { selectId: "displayDuration", hiddenInputId: "duration", defaultText: "Select Duration" }
	    ];

	    fields.forEach(field => {
	        const selectElement = document.getElementById(field.selectId);
	        const hiddenInputElement = document.getElementById(field.hiddenInputId);
	        if (selectElement && hiddenInputElement) {
	            selectElement.querySelector(".selected").innerText = field.defaultText;
	            hiddenInputElement.value = "";
	        }
	    });

	    // Reset traveller counts
	    $(".span_value_adult").html(1);
	    $(".span_value_adult1").val(1);

	    $(".span_value_child").html(0);
	    $(".span_value_child1").val(0);

	    $(".span_value_child_without_bed").html(0);
	    $(".span_value_child2").val(0);

	    $(".span_value_infant").html(0);
	    $(".span_value_infant1").val(0);
	}

	/***********************************************/

	/*form validation*/
    var form = document.getElementById("enquiry_form");
    var submitButton = document.getElementById("form_submit");

    // Function to handle form submission
    function handleSubmit(event) {
        event.preventDefault(); // Prevent default form submission behavior

        // Your validation logic here
        var service_type = document.enquiry_form.service_type.value;
        var channel_type = document.enquiry_form.channel_type.value;
        var name = document.enquiry_form.name.value;
        var email = document.enquiry_form.email.value;
        var mobile = document.enquiry_form.mobile.value;
        var time_call = document.enquiry_form.time_call.value;
        var country_of_residence = document.enquiry_form.country_of_residence.value;
        var destinations = document.enquiry_form.destinations.value;
        var date_arrival = document.enquiry_form.date_arrival.value;
        var city_of_residence = document.enquiry_form.city_of_residence.value;
        /*var duration = document.enquiry_form.duration.value;*/
        var accept_value = document.enquiry_form.accept_value.checked;
        var patt_name = /^[A-Za-z]{1,}[A-Za-z .]{2,}$/;
        var patt_mail = /^[A-Za-z0-9]{1}[A-Za-z0-9_.]{0,}\@[A-Za-z0-9]{1,}[A-Za-z0-9.-]{1,}\.[A-Za-z]{1,}[A-Za-z.]{1,}$/;

        // Validate name
        if (name.trim() === "") {
            document.querySelector("#name_error").innerHTML = "Enter full name";
            document.enquiry_form.name.focus();
            return false;
        } else if (!patt_name.test(name)) {
            document.querySelector("#name_error").innerHTML = "Enter valid name";
            document.enquiry_form.name.focus();
            return false;
        } else {
            document.querySelector("#name_error").innerHTML = "";
        }

        // Validate email
        if (email.trim() === "" || !patt_mail.test(email)) {
            document.querySelector("#email_error").innerHTML = "Enter valid email id";
            document.enquiry_form.email.focus();
            return false;
        } else {
            document.querySelector("#email_error").innerHTML = "";
        }

        // Validate mobile
        if (mobile.trim() === "" || isNaN(mobile)) {
            document.querySelector("#mobile_error").innerHTML = "Enter valid Contact Number";
            document.enquiry_form.mobile.focus();
            return false;
        } else {
            document.querySelector("#mobile_error").innerHTML = "";
        }

        // Validate time_call
        /*if (time_call == "0") {
            document.querySelector("#time_call_error").innerHTML = "Select best time to call";
            document.enquiry_form.time_call.focus();
            return false;
        } else {
            document.querySelector("#time_call_error").innerHTML = "";
        }*/

        // Validate time_call
        if (time_call.trim() === "") {
	        document.querySelector("#time_call_error").innerHTML = "Select best time to call";
	        document.getElementById("time_call_select").focus();
	        return false;
	    } else {
	        document.querySelector("#time_call_error").innerHTML = "";
	    }

        /*// Validate country_of_residence
        if (country_of_residence == "0") {
            document.querySelector("#country_of_residence_error").innerHTML = "Select country of residence";
            document.enquiry_form.country_of_residence.focus();
            return false;
        } else {
            document.querySelector("#country_of_residence_error").innerHTML = "";
        }*/

        // Validate destinations
        if (destinations.trim() === "" || !patt_name.test(destinations)) {
            document.querySelector("#destinations_error").innerHTML = "Enter Destination";
            document.enquiry_form.destinations.focus();
            return false;
        } else {
            document.querySelector("#destinations_error").innerHTML = "";
        }

        // Validate date_arrival
        if (date_arrival.trim() === "") {
            document.querySelector("#date_arrival_error").innerHTML = "Select Date of Travel";
            document.enquiry_form.date_arrival.focus();
            return false;
        } else {
            document.querySelector("#date_arrival_error").innerHTML = "";
        }

        // Validate city_of_residence (starting city)
        if (city_of_residence.trim() === "" || !patt_name.test(city_of_residence)) {
            document.querySelector("#city_of_residence_error").innerHTML = "Enter City of Residence";
            document.enquiry_form.city_of_residence.focus();
            return false;
        } else {
            document.querySelector("#city_of_residence_error").innerHTML = "";
        }

        /*---------*/

        // Validate duration
		// Since you're using a custom select element, we need to check the selected option
		var selectedDuration = document.querySelector("#displayDuration .selected").innerText.trim();
		if (selectedDuration === "Select Duration") {
		    document.querySelector("#duration_error").innerHTML = "Select service duration";
		    /*document.querySelector("#displayDuration .selected").style.borderColor = "red";*/
		    return false;
		} else {
		    document.querySelector("#duration_error").innerHTML = "";
		    /*document.querySelector("#displayDuration .selected").style.borderColor = ""; // Reset border color*/
		}

		/*---------*/

        var budget = document.getElementById("exp_budget").value;
        var budgetError = document.getElementById("budget_error");

        // Validate budget for "Tour Package," "Accommodation," and "Cruise"
        if (service_type === "Tour Package" || service_type === "Accommodation" || service_type === "Cruise") {
            if (!budget || budget.trim() === "") {
                budgetError.innerHTML = "Please select your budget";
                document.getElementById("exp_budget").focus();
                return false;
            } else {
                budgetError.innerHTML = "";
            }
        }

        /*---------*/

		// Validate cruise fields only if service type is "Cruise"
		/*var service_type = document.getElementById("service_type").value;*/
        if (service_type === "Cruise") {
            var cruiseFieldsValid = validateCruiseFields();
            if (!cruiseFieldsValid) {
                // Validation failed, do not submit the form
                return;
            }
        }

	    // Function to handle validation for cruise-related fields
	    function validateCruiseFields() {
	        var cruiseline = document.getElementById("cruiseline").value;
	        var cruisecabin = document.getElementById("cruisecabin").value;

	        if (cruiseline === null || cruiseline === "") {
	            document.getElementById("cruiseline_error").innerHTML = "Select Cruise Lines";
	            document.getElementById("cruiseline").focus();
	            return false;
	        } else {
	            document.getElementById("cruiseline_error").innerHTML = "";
	        }

	        if (cruisecabin === null || cruisecabin === "") {
	            document.getElementById("cruisecabin_error").innerHTML = "Select Cabin Type";
	            document.getElementById("cruisecabin").focus();
	            return false;
	        } else {
	            document.getElementById("cruisecabin_error").innerHTML = "";
	        }

	        return true; // Validation passed
	    }

	    // Add event listeners to trigger validation on change for cruise-related fields
	    document.getElementById("cruiseline").addEventListener("change", validateCruiseFields);
	    document.getElementById("cruisecabin").addEventListener("change", validateCruiseFields);

	    /*---------*/

        // Validate visa fields only if service type is "Visa"
        if (service_type === "Visa") {
            var visaFieldsValid = validateVisaFields();
            if (!visaFieldsValid) {
                // Validation failed, do not submit the form
                return;
            }
        }

	    // Function to handle validation for visa-related fields
	    function validateVisaFields() {
	        var visatype = document.getElementById("visatype").value;
	        var visaentry = document.getElementById("visaentry").value;
	        var visaservice = document.getElementById("visaservice").value;

	        if (visatype === null || visatype === "") {
	            document.getElementById("visatype_error").innerHTML = "Select Visa Type";
	            document.getElementById("visatype").focus();
	            return false;
	        } else {
	            document.getElementById("visatype_error").innerHTML = "";
	        }

	        if (visaentry === null || visaentry === "") {
	            document.getElementById("visaentry_error").innerHTML = "Select Visa Entry";
	            document.getElementById("visaentry").focus();
	            return false;
	        } else {
	            document.getElementById("visaentry_error").innerHTML = "";
	        }

	        if (visaservice === null || visaservice === "") {
	            document.getElementById("visaservice_error").innerHTML = "Select Visa Service";
	            document.getElementById("visaservice").focus();
	            return false;
	        } else {
	            document.getElementById("visaservice_error").innerHTML = "";
	        }

	        return true; // Validation passed
	    }

	    // Add event listeners to trigger validation on change for visa-related fields
	    document.getElementById("visatype").addEventListener("change", validateVisaFields);
	    document.getElementById("visaentry").addEventListener("change", validateVisaFields);
	    document.getElementById("visaservice").addEventListener("change", validateVisaFields);

        /***********************************************/

        // Validate accept_value
        if (!accept_value) {
            document.querySelector("#accept_value_error").innerHTML = "Please accept Terms and Conditions!";
            document.enquiry_form.accept_value.focus();
            return false;
        } else {
            document.querySelector("#accept_value_error").innerHTML = "";
        }

        // Ensure the submit button is disabled and shows "Please wait..." text
        submitButton.disabled = true;
        submitButton.innerText = "Please wait...";

        // Once all validations pass, proceed with form submission
        var app_url_custom = $("#APP_URL").val();
        var form_data = new FormData($('#enquiry_form')[0]);
        $.ajax({
            url: app_url_custom + '/saveQuery',
            data: form_data,
            type: 'post',
            contentType: false,
            processData: false,

            success: function(data) {
		    $("#overlay").fadeOut(300);

		    // Log the raw response data for debugging
		    console.log("Success response data:", data);

		    // Check if data is an object and extract message
		    var responseMessage = typeof data === 'object' && data.message ? data.message : 'An unknown success message';
		    
		    if (responseMessage === 'Success') {
		        swal("Thank you!", 'One of our travel experts will contact you shortly', "success");

		        // Reset the form
		        form.reset();
		        
		        // Reset the form fields
		        resetFields();
		        handleHotelCategorySelection();
		        preferenceSelectionHandler.reset();
		        additionalDetailsHandlers.reset();
		    } else {
		        // Log error message and show in SweetAlert
		        console.log("Error response message:", responseMessage);
		        swal("Error", responseMessage, "error");
		    }

		    // Re-enable the submit button and change its text back to the original text
		    submitButton.disabled = false;
		    submitButton.innerText = "Get a Free Quote";
		},
		error: function(jqXHR) {
		    // Log the raw response object for debugging
		    console.log("Error response object:", jqXHR);

		    // Extract error message if available
		    var errorMessage = jqXHR.responseJSON && jqXHR.responseJSON.message ? jqXHR.responseJSON.message : 'An unknown error occurred';
		    console.log("Error response message:", errorMessage);

		    swal("Error", errorMessage, "error");

		    // Re-enable the submit button and change its text back to the original text
		    submitButton.disabled = false;
		    submitButton.innerText = "Get a Free Quote";
		}
        });
    }

    // Add event listener for form submission
    form.addEventListener("submit", handleSubmit);

    /***********************************************/

    // Add event listeners to input fields to clear error messages when they lose focus
    var inputFields = form.querySelectorAll("input");
    inputFields.forEach(function(input) {
        input.addEventListener("blur", function() {
            var errorId = input.id + "_error";
            var errorElement = document.getElementById(errorId);
	        if (errorElement) {
	            errorElement.innerHTML = ""; // Clear error message
	        }
        });
    });

    /***********************************************/

	var acceptValue = document.getElementById("accept_value");

    if (acceptValue) {
        acceptValue.addEventListener("click", function() {
            var acceptValue1 = this.value;
            if (acceptValue1 === "0") {
                this.value = "1";
            } else if (acceptValue1 === "1") {
                this.value = "0";
            }
        });
    }
});


    /***********************************************/


    /*var APP_URL = document.querySelector("#APP_URL").value;
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    var data = {
        _token: csrfToken
    };

    // Function to handle fetch requests
    function fetchCountryData(endpoint, elementId) {
    	// Use backticks (`) for string interpolation
        var url = `${APP_URL}/${endpoint}`;
        
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify(data) // Send data in body
        })
        .then(response => {
        	// Check if response is ok (status code 2xx)
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text(); // Assuming response is text; adjust if JSON
        })
        .then(rdata => {
        	// Populate the options in the HTML
            document.querySelector(elementId).innerHTML = rdata;
        })
        .catch(error => {
        	// Corrected template literal usage for logging
            console.error(`Error fetching data from ${endpoint}:`, error);
        });
    }

    // Fetch Country Code
    fetchCountryData('country_code', '#country_code');

    // Fetch Country of Residence
    fetchCountryData('country_query_s', '#country_of_residence');*/


	/*var APP_URL = document.querySelector("#APP_URL").value;

	function fetchCountryData(endpoint, elementId) {
	    var url = `${APP_URL}/${endpoint}`;

	    fetch(url, {
	        method: 'GET', // Change from 'POST' to 'GET'
	        headers: {
	            'Accept': 'application/json'
	        }
	    })
	    .then(response => {
	        if (!response.ok) {
	            throw new Error(`HTTP Error! Status: ${response.status}`);
	        }
	        return response.text(); // Expecting HTML response
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
    fetchCountryData('country_query_s', '#country_of_residence');*/

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
	        if (element) { // ✅ Check if element exists before updating
	            element.innerHTML = rdata;
	        } else {
	            console.error(`Error: Element '${elementId}' not found in the DOM.`);
	        }
	    })
	    .catch(error => {
	        console.error(`Error fetching data from ${endpoint}:`, error);
	    });
	}

	// Fetch Country of Residence
	document.addEventListener("DOMContentLoaded", function () {

		// Fetch Country Code
	    fetchCountryData('country_code', '#country_code');

	    fetchCountryData('country_query_s', '#country_of_residence');
	});

/***********************************************/
// open tab
document.addEventListener("DOMContentLoaded", function() {
    // Function to open a specific tab
    function openTab(evt, contentName) {
        var i, tabcontent, tablinks;

        // Get all elements with the class name "tabcontent"
        tabcontent = document.getElementsByClassName("tabcontent");

        // Hide all tab content
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        // Get all elements with the class name "tablinks"
        tablinks = document.getElementsByClassName("tablinks");

        // Remove the "active" class from all tab links
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        // Show the tab content that matches the clicked tab
        document.getElementById(contentName).style.display = "block";

        // Add the "active" class to the clicked tab link
        evt.currentTarget.className += " active";
    }

    // Attach the openTab function to all elements with the class name "tablinks"
    var tablinks = document.getElementsByClassName("tablinks");
    for (var i = 0; i < tablinks.length; i++) {
        tablinks[i].addEventListener("click", function(evt) {
            openTab(evt, this.getAttribute("data-tab"));
        });
    }

    // Trigger the click on the element with id="defaultOpen"
    document.getElementById("defaultOpen").click();
});

/*----------*//*----------*/

// Get all elements with the class name "accordion (collapsible)"
document.addEventListener("DOMContentLoaded", function() {
    // Get all elements with the class name "accordion (collapsible)"
    var coll = document.getElementsByClassName("accordion");

    // Iterate over each accordion element
    for (var i = 0; i < coll.length; i++) {
        // Add a click event listener to each accordion element
        coll[i].addEventListener("click", function() {
            // Toggle the "active" class on the clicked accordion
            this.classList.toggle("active");

            // Get the next sibling element (the panel) of the clicked accordion
            var panelBox = this.nextElementSibling;

            // Check if the panel is currently open
            if (panelBox.style.maxHeight) {
                // If open, close it by setting maxHeight to null
                panelBox.style.maxHeight = null;
            } else {
                // If closed, open it by setting maxHeight to its scroll height
                panelBox.style.maxHeight = 'inherit';
            }
        });
    }
});

/*----------*//*----------*/

// Prevent form submission on Enter key press
$(document).ready(function() {
  $(window).keydown(function(event) {
    if (event.keyCode === 13) { // Check if the pressed key is Enter
    	event.preventDefault(); // Prevent the default action (form submission)
    	return false; // Return false to stop propagation
    }
  });
});

/*----------*//*----------*/

// Function to restrict input to numbers and a single decimal point
$(document).ready(function() {
	function restrictToNumbersAndDecimal(inputElement) {
		inputElement.value = inputElement.value
		.replace(/[^0-9.]/g, '') // Remove any character that is not a number or a decimal point
		.replace(/(\..*?)\..*/g, '$1'); // Allow only one decimal point
	}

	// Event handler for input restriction on keyup and change events
	$(document).on("keyup change", ".number_test", function() {
		restrictToNumbersAndDecimal(this);
	});
});

/*----------*//*----------*/

// percentage value box display, based on input
$(document).ready(function() {
    // Function to show or hide elements based on the selected value
    function toggleElementBasedOnValue(element, valueToShow, targetElement) {
        if ($(element).val() === valueToShow) {
            $(targetElement).css("display", "block");
        } else {
            $(targetElement).css("display", "none");
        }
    }

    // Function to initialize the display settings of elements based on current values
    function initializeDisplaySettings() {
        // Show markup percentage field when pricemarkup is '2'
        toggleElementBasedOnValue('.pricemarkup', '2', '.markup_percentage');

        // Show discount positive percentage field when pricediscountpositive is '2'
        toggleElementBasedOnValue('.pricediscountpositive', '2', '.discountpositive_percentage');

        // Show discount negative percentage field when pricediscountnegative is '2'
        toggleElementBasedOnValue('.pricediscountnegative', '2', '.discountnegative_percentage');

        // Show coupon percentage field when pricediscountnegative is '3'
        toggleElementBasedOnValue('.pricediscountnegative', '3', '.coupon_percentage');

        // Show GST percentage field when pricegst is '2'
        toggleElementBasedOnValue('.pricegst', '2', '.gst_percentage');

        // Show TCS percentage field when pricetcs is '2'
        toggleElementBasedOnValue('.pricetcs', '2', '.tcs_percentage');

        // Show PG charges percentage field when pricepgcharges is '2'
        toggleElementBasedOnValue('.pricepgcharges', '2', '.pgcharges_percentage');

        // Show advance payment percentage field when advance_payment is '2'
        toggleElementBasedOnValue('.advance_payment', '2', '.advance_payment_percentage');

        // Show first part payment percentage field when first_part_payment is '2'
        toggleElementBasedOnValue('.first_part_payment', '2', '.first_part_percentage');

        // Show second part payment percentage field when second_part_payment is '2'
        toggleElementBasedOnValue('.second_part_payment', '2', '.second_part_percentage');
    }

    // Function to handle change events for different input fields
    function handleChangeEvents() {
        // Handle changes for pricemarkup field
        $(".pricemarkup").change(function() {
            toggleElementBasedOnValue(this, '2', '.markup_percentage');
            recalculateQuote(); // Recalculate the quote when value changes
        });

        // Handle changes for pricediscountpositive field
        $(".pricediscountpositive").change(function() {
            toggleElementBasedOnValue(this, '2', '.discountpositive_percentage');
            recalculateQuote(); // Recalculate the quote when value changes
        });

        // Handle changes for pricediscountnegative field
        $(".pricediscountnegative").change(function() {
            toggleElementBasedOnValue(this, '2', '.discountnegative_percentage');
            toggleElementBasedOnValue(this, '3', '.coupon_percentage');
            recalculateQuote(); // Recalculate the quote when value changes
        });

        // Handle changes for pricegst field
        $(".pricegst").change(function() {
            toggleElementBasedOnValue(this, '2', '.gst_percentage');
            recalculateQuote(); // Recalculate the quote when value changes
        });

        // Handle changes for pricetcs field
        $(".pricetcs").change(function() {
            toggleElementBasedOnValue(this, '2', '.tcs_percentage');
            recalculateQuote(); // Recalculate the quote when value changes
        });

        // Handle changes for pricepgcharges field
        $(".pricepgcharges").change(function() {
            toggleElementBasedOnValue(this, '2', '.pgcharges_percentage');
            recalculateQuote(); // Recalculate the quote when value changes
        });

        // Handle changes for advance_payment field
        $(".advance_payment").change(function() {
            toggleElementBasedOnValue(this, '2', '.advance_payment_percentage');
            recalculateQuote(); // Recalculate the quote when value changes
        });

        // Handle changes for first_part_payment field
        $(".first_part_payment").change(function() {
            toggleElementBasedOnValue(this, '2', '.first_part_percentage');
            recalculateQuote(); // Recalculate the quote when value changes
        });

        // Handle changes for second_part_payment field
        $(".second_part_payment").change(function() {
            toggleElementBasedOnValue(this, '2', '.second_part_percentage');
            recalculateQuote(); // Recalculate the quote when value changes
        });
    }

    // Function to recalculate the quote (placeholder for actual implementation)
    function recalculateQuote() {
        // Call the function with all the necessary parameters.
        quote1_price(
            'quote1_air_adult', 'quote1_cruise_adult', 'quote1_cruiseport_adult', 'quote1_cruisegratuity_adult',
            'quote1_cruisegst_adult', 'quote1_hotel_adult', 'quote1_tours_adult', 'quote1_transfer_adult',
            'quote1_visa_adult', 'quote1_inc_adult', 'quote1_meals_adult', 'quote1_additionalservice_adult',
            'quote1_tourtotal_adult', 'quote1_tourtotal_exadult', 'quote1_tourtotal_childbed', 'quote1_tourtotal_childwbed',
            'quote1_tourtotal_infant', 'quote1_tourtotal_single', 'pricemarkup', 'markup_percentage', 'quote1_markup_adult',
            'quote1_markup_exadult', 'quote1_markup_childbed', 'quote1_markup_childwbed', 'quote1_markup_infant',
            'quote1_markup_single', 'quote1_total_adult', 'quote1_discount_adult_plus', 'quote1_gross_total_adult',
            'quote1_gross_total_exadult', 'quote1_gross_total_childbed', 'quote1_gross_total_childwbed',
            'quote1_gross_total_infant', 'quote1_gross_total_single', 'quote1_gross_total_group', 'quote1_discount_adult_minus',
            'quote1_discount_exadult_minus', 'quote1_discount_childbed_minus', 'quote1_discount_childwbed_minus',
            'quote1_discount_infant_minus', 'quote1_discount_single_minus', 'pricegst', 'gst_percentage', 'quote1_gst_adult',
            'quote1_gst_adult', 'quote1_gst_exadult', 'quote1_gst_childbed', 'quote1_gst_childwbed', 'quote1_gst_infant',
            'quote1_gst_single', 'quote1_gst_group', 'quote1_gsttotal_adult', 'pricetcs', 'tcs_percentage', 'quote1_tcs_adult',
            'quote1_tcs_exadult', 'quote1_tcs_childbed', 'quote1_tcs_childwbed', 'quote1_tcs_infant', 'quote1_tcs_single',
            'quote1_tcs_group', 'quote1_tcstotal_adult', 'pricepgcharges', 'pgcharges_percentage', 'quote1_pgcharges_adult',
            'quote1_pgcharges_exadult', 'quote1_pgcharges_childbed', 'quote1_pgcharges_childwbed', 'quote1_pgcharges_infant',
            'quote1_pgcharges_single', 'quote1_pg_group', 'quote1_grand_adult', 'quote1_grand_adult_with_person', 'query_pricetopay',
            'quote1_number_of_adult', 'quote1_number_of_extra_adult', 'quote1_number_of_child_with_bed', 'quote1_number_of_child_without_bed',
            'quote1_number_of_infant', 'quote1_number_solo_traveller', 'quote1_grand_exadult_with_person', 'quote1_grand_childbed_with_person',
            'quote1_grand_childwbed_with_person', 'quote1_grand_infant_with_person', 'quote1_grand_single_with_person',
            'quote1_discount_group', 'quote1_gsttotal_exadult', 'quote1_gsttotal_childbed', 'quote1_gsttotal_childwbed',
            'quote1_gsttotal_infant', 'quote1_gsttotal_single', 'quote1_tcstotal_exadult', 'quote1_tcstotal_childbed',
            'quote1_tcstotal_childwbed', 'quote1_tcstotal_infant', 'quote1_tcstotal_single', 'quote1_air_exadult',
            'quote1_cruise_exadult', 'quote1_cruiseport_exadult', 'quote1_cruisegratuity_exadult', 'quote1_cruisegst_exadult',
            'quote1_hotel_exadult', 'quote1_tours_exadult', 'quote1_transfer_exadult', 'quote1_visa_exadult', 'quote1_inc_exadult',
            'quote1_meals_exadult', 'quote1_additionalservice_exadult', 'quote1_discount_exadult_plus', 'quote1_grand_exadult',
            'quote1_grand_childbed', 'quote1_grand_childwbed', 'quote1_grand_infant', 'quote1_grand_single', 'quote1_air_childbed',
            'quote1_cruise_childbed', 'quote1_cruiseport_childbed', 'quote1_cruisegratuity_childbed', 'quote1_cruisegst_childbed',
            'quote1_hotel_childbed', 'quote1_tours_childbed', 'quote1_transfer_childbed', 'quote1_visa_childbed', 'quote1_inc_childbed',
            'quote1_meals_childbed', 'quote1_additionalservice_childbed', 'quote1_discount_childbed_plus', 'quote1_air_childwbed',
            'quote1_cruise_childwbed', 'quote1_cruiseport_childwbed', 'quote1_cruisegratuity_childwbed', 'quote1_cruisegst_childwbed',
            'quote1_hotel_childwbed', 'quote1_tours_childwbed', 'quote1_transfer_childwbed', 'quote1_visa_childwbed', 'quote1_inc_childwbed',
            'quote1_meals_childwbed', 'quote1_additionalservice_childwbed', 'quote1_discount_childwbed_plus', 'quote1_air_infant',
            'quote1_cruise_infant', 'quote1_cruiseport_infant', 'quote1_cruisegratuity_infant', 'quote1_cruisegst_infant', 'quote1_hotel_infant',
            'quote1_tours_infant', 'quote1_transfer_infant', 'quote1_visa_infant', 'quote1_inc_infant', 'quote1_meals_infant',
            'quote1_additionalservice_infant', 'quote1_discount_infant_plus', 'quote1_air_single', 'quote1_cruise_single', 'quote1_cruiseport_single',
            'quote1_cruisegratuity_single', 'quote1_cruisegst_single', 'quote1_hotel_single', 'quote1_tours_single', 'quote1_transfer_single',
            'quote1_visa_single', 'quote1_inc_single', 'quote1_meals_single', 'quote1_additionalservice_single', 'quote1_discount_single_plus',
            'quote1_pricetopay', 'pricediscountpositive', 'discountpositive_percentage', 'pricediscountnegative', 'discountnegative_percentage',
            'advance_payment', 'advance_payment_percentage', 'quote1_advance_payment', 'first_part_payment', 'first_part_percentage',
            'quote1_first_part', 'second_part_payment', 'second_part_percentage', 'quote1_second_part', 'quote1_total_payment',
            'show_part_payment', 'advance_payment_percentage', 'quote1_advance_payment', 'first_part_percentage', 'quote1_first_part',
            'second_part_percentage', 'quote1_second_part', 'quote1_total_payment', 'coupon_percentage'
        );
    }

    // Initialize display settings on page load
    initializeDisplaySettings();

    // Attach change event handlers
    handleChangeEvents();
});

/*----------*//*----------*/

// disable the price field based upon the guest value
$(document).ready(function() {

    // Function to call price calculation
    function callPriceCalculation() {
        // Call the price calculation function
    		quote1_price(
            'quote1_air_adult', 'quote1_cruise_adult', 'quote1_cruiseport_adult', 'quote1_cruisegratuity_adult',
            'quote1_cruisegst_adult', 'quote1_hotel_adult', 'quote1_tours_adult', 'quote1_transfer_adult',
            'quote1_visa_adult', 'quote1_inc_adult', 'quote1_meals_adult', 'quote1_additionalservice_adult',
            'quote1_tourtotal_adult', 'quote1_tourtotal_exadult', 'quote1_tourtotal_childbed', 'quote1_tourtotal_childwbed',
            'quote1_tourtotal_infant', 'quote1_tourtotal_single', 'pricemarkup', 'markup_percentage', 'quote1_markup_adult',
            'quote1_markup_exadult', 'quote1_markup_childbed', 'quote1_markup_childwbed', 'quote1_markup_infant',
            'quote1_markup_single', 'quote1_total_adult', 'quote1_discount_adult_plus', 'quote1_gross_total_adult',
            'quote1_gross_total_exadult', 'quote1_gross_total_childbed', 'quote1_gross_total_childwbed',
            'quote1_gross_total_infant', 'quote1_gross_total_single', 'quote1_gross_total_group', 'quote1_discount_adult_minus',
            'quote1_discount_exadult_minus', 'quote1_discount_childbed_minus', 'quote1_discount_childwbed_minus',
            'quote1_discount_infant_minus', 'quote1_discount_single_minus', 'pricegst', 'gst_percentage', 'quote1_gst_adult',
            'quote1_gst_adult', 'quote1_gst_exadult', 'quote1_gst_childbed', 'quote1_gst_childwbed', 'quote1_gst_infant',
            'quote1_gst_single', 'quote1_gst_group', 'quote1_gsttotal_adult', 'pricetcs', 'tcs_percentage', 'quote1_tcs_adult',
            'quote1_tcs_exadult', 'quote1_tcs_childbed', 'quote1_tcs_childwbed', 'quote1_tcs_infant', 'quote1_tcs_single',
            'quote1_tcs_group', 'quote1_tcstotal_adult', 'pricepgcharges', 'pgcharges_percentage', 'quote1_pgcharges_adult',
            'quote1_pgcharges_exadult', 'quote1_pgcharges_childbed', 'quote1_pgcharges_childwbed', 'quote1_pgcharges_infant',
            'quote1_pgcharges_single', 'quote1_pg_group', 'quote1_grand_adult', 'quote1_grand_adult_with_person', 'query_pricetopay',
            'quote1_number_of_adult', 'quote1_number_of_extra_adult', 'quote1_number_of_child_with_bed', 'quote1_number_of_child_without_bed',
            'quote1_number_of_infant', 'quote1_number_solo_traveller', 'quote1_grand_exadult_with_person', 'quote1_grand_childbed_with_person',
            'quote1_grand_childwbed_with_person', 'quote1_grand_infant_with_person', 'quote1_grand_single_with_person',
            'quote1_discount_group', 'quote1_gsttotal_exadult', 'quote1_gsttotal_childbed', 'quote1_gsttotal_childwbed',
            'quote1_gsttotal_infant', 'quote1_gsttotal_single', 'quote1_tcstotal_exadult', 'quote1_tcstotal_childbed',
            'quote1_tcstotal_childwbed', 'quote1_tcstotal_infant', 'quote1_tcstotal_single', 'quote1_air_exadult',
            'quote1_cruise_exadult', 'quote1_cruiseport_exadult', 'quote1_cruisegratuity_exadult', 'quote1_cruisegst_exadult',
            'quote1_hotel_exadult', 'quote1_tours_exadult', 'quote1_transfer_exadult', 'quote1_visa_exadult', 'quote1_inc_exadult',
            'quote1_meals_exadult', 'quote1_additionalservice_exadult', 'quote1_discount_exadult_plus', 'quote1_grand_exadult',
            'quote1_grand_childbed', 'quote1_grand_childwbed', 'quote1_grand_infant', 'quote1_grand_single', 'quote1_air_childbed',
            'quote1_cruise_childbed', 'quote1_cruiseport_childbed', 'quote1_cruisegratuity_childbed', 'quote1_cruisegst_childbed',
            'quote1_hotel_childbed', 'quote1_tours_childbed', 'quote1_transfer_childbed', 'quote1_visa_childbed', 'quote1_inc_childbed',
            'quote1_meals_childbed', 'quote1_additionalservice_childbed', 'quote1_discount_childbed_plus', 'quote1_air_childwbed',
            'quote1_cruise_childwbed', 'quote1_cruiseport_childwbed', 'quote1_cruisegratuity_childwbed', 'quote1_cruisegst_childwbed',
            'quote1_hotel_childwbed', 'quote1_tours_childwbed', 'quote1_transfer_childwbed', 'quote1_visa_childwbed', 'quote1_inc_childwbed',
            'quote1_meals_childwbed', 'quote1_additionalservice_childwbed', 'quote1_discount_childwbed_plus', 'quote1_air_infant',
            'quote1_cruise_infant', 'quote1_cruiseport_infant', 'quote1_cruisegratuity_infant', 'quote1_cruisegst_infant', 'quote1_hotel_infant',
            'quote1_tours_infant', 'quote1_transfer_infant', 'quote1_visa_infant', 'quote1_inc_infant', 'quote1_meals_infant',
            'quote1_additionalservice_infant', 'quote1_discount_infant_plus', 'quote1_air_single', 'quote1_cruise_single', 'quote1_cruiseport_single',
            'quote1_cruisegratuity_single', 'quote1_cruisegst_single', 'quote1_hotel_single', 'quote1_tours_single', 'quote1_transfer_single',
            'quote1_visa_single', 'quote1_inc_single', 'quote1_meals_single', 'quote1_additionalservice_single', 'quote1_discount_single_plus',
            'quote1_pricetopay', 'pricediscountpositive', 'discountpositive_percentage', 'pricediscountnegative', 'discountnegative_percentage',
            'advance_payment', 'advance_payment_percentage', 'quote1_advance_payment', 'first_part_payment', 'first_part_percentage',
            'quote1_first_part', 'second_part_payment', 'second_part_percentage', 'quote1_second_part', 'quote1_total_payment',
            'show_part_payment', 'advance_payment_percentage', 'quote1_advance_payment', 'first_part_percentage', 'quote1_first_part',
            'second_part_percentage', 'quote1_second_part', 'quote1_total_payment', 'coupon_percentage'
        );
    }

    // Function to handle increment and decrement
    function updateValue(selector, increment) {
        var $valueField = $(selector).siblings(".quote1_value");
        var currentValue = parseInt($valueField.val(), 10);
        var newValue = increment ? currentValue + 1 : currentValue - 1;

        if (newValue < 0) {
            alert('This cannot be negative');
            return false;
        }
        if (newValue === 0) {
            $(selector).siblings(".quote1_value").attr('readonly', '');
        } else {
            $(selector).siblings(".quote1_value").removeAttr('readonly');
        }
        $(selector).siblings(".quote1_result").html(Math.round(newValue));
        $valueField.val(newValue);

        callPriceCalculation();
    }

    // Increment and Decrement event handlers
    $(document).on("click", ".quote1_adult_room_inc", function() {
        updateValue(this, true);
    });

    $(document).on("click", ".quote1_adult_room_dec", function() {
        var span_value_solo_adult = $(this).parent().parent().siblings(":last").children().children(".quote1_solo_value").val();
        if (span_value_solo_adult >= 1 || $(this).siblings(".quote1_adult_room_value").val() > 1) {
            updateValue(this, false);
        } else {
            alert('This cannot be 0');
            return false;
        }
    });

    $(document).on("click", ".quote1_child_extra_adult_inc", function() {
        updateValue(this, true);
    });

    $(document).on("click", ".quote1_child_extra_adult_dec", function() {
        updateValue(this, false);
    });

    $(document).on("click", ".quote1_child_with_bed_inc", function() {
        updateValue(this, true);
    });

    $(document).on("click", ".quote1_child_with_bed_dec", function() {
        updateValue(this, false);
    });

    $(document).on("click", ".quote1_childwithoutbed_inc", function() {
        updateValue(this, true);
    });

    $(document).on("click", ".quote1_childwithoutbed_dec", function() {
        updateValue(this, false);
    });

    $(document).on("click", ".quote1_infant_inc", function() {
        updateValue(this, true);
    });

    $(document).on("click", ".quote1_infant_dec", function() {
        updateValue(this, false);
    });

    $(document).on("click", ".quote1_solo_inc", function() {
        updateValue(this, true);
    });

    $(document).on("click", ".quote1_solo_dec", function() {
        var span_value_twin_adult = $(this).parent().parent().siblings('.minwidth135').children().children('.quote1_adult_room_value').val();
        if (span_value_twin_adult >= 1 || $(this).siblings(".quote1_solo_value").val() > 1) {
            updateValue(this, false);
        } else {
            alert('This cannot be 0');
            return false;
        }
    });

    // Initialize readonly fields based on initial values
    function initializeReadOnlyFields() {
        var fields = [
            { selector: '.quote1_number_of_child_without_bed', disableClass: 'childwbed_disable' },
            { selector: '.quote1_number_of_extra_adult', disableClass: 'exadult_disable' },
            { selector: '.quote1_number_of_child_with_bed', disableClass: 'childbed_disable' },
            { selector: '.quote1_number_of_infant', disableClass: 'infant_disable' },
            { selector: '.quote1_number_solo_traveller', disableClass: 'single_disable' }
        ];

        fields.forEach(function(field) {
            var $field = $(field.selector);
            var value = parseInt($field.val(), 10);
            if (value === 0) {
                $("." + field.disableClass).val('').attr('readonly', '');
            }
        });
    }

    // Call initialization function on page load
    initializeReadOnlyFields();
});

/*----------*//*----------*/

// supplier details
$(document).ready(function() {
    // Event listener for when a supplier dropdown is changed or clicked
    $(document).on("change click", ".supplier", function() {
        var id = $(this).attr("id"); // Get the ID of the clicked supplier element
        var supplierId = $(this).val(); // Get the selected supplier ID
        var selectName = $('option:selected', this).attr('select_name'); // Get the 'select_name' attribute of the selected option
        var inputValue = $(this).siblings('input').val(); // Get the value of the adjacent input field

        // If a valid supplier is selected (not '0'), display the modal for supplier remarks
        if (supplierId !== '0') {
            displaySupplierModal(id, selectName, inputValue);
        }
    });

    // Event listener for when the "Save" button in the supplier remarks modal is clicked
    $(document).on("click", ".supplier_remarks", function() {
        var supplierRemarksId = $(this).attr('supplier_remarks_id'); // Get the ID of the remarks input field
        var supplierAttr = $(this).attr('supplier_attr'); // Get the associated supplier attribute
        var remarksValue = $("#" + supplierRemarksId).val(); // Get the value entered in the remarks input field

        // Update the original remarks input field with the new value and hide the modal
        updateRemarks(supplierAttr, remarksValue);
    });

    // Function to display the supplier remarks modal
    function displaySupplierModal(id, selectName, inputValue) {
        // Create the HTML content for the modal, including a label and input field
        var html = `
            <label for="">${selectName} Remarks</label>
            <input type="text" id="supplier_remarks${id}" class="form-control" placeholder="Enter Remarks" value="${inputValue}">
        `;
        // Set custom attributes on the "Save" button in the modal to store the remarks input field ID and supplier attribute
        $(".supplier_remarks").attr({
            'supplier_remarks_id': 'supplier_remarks' + id,
            'supplier_attr': id
        });
        // Update the modal body with the newly created HTML content and show the modal
        $("#supplier_body").html(html);
        $('#supplier').modal('show');
    }

    // Function to update the original remarks input field and hide the modal
    function updateRemarks(supplierAttr, remarksValue) {
        // Update the value of the input field associated with the supplier attribute
        $("#remarks_" + supplierAttr).val(remarksValue);
        // Hide the modal after updating the input field
        $('#supplier').modal('hide');
    }
});

/*----------*//*----------*/

//update group total
$(document).ready(function() {
	// Initialize update quote total on document ready
  updateQuoteTotal();

  // Event listener for keyup and change events on the rate input field
  $(document).on("keyup change", ".quote1_rate", function() {
    updateQuoteTotal(); // Update the total when the rate changes
  });

  // Event listener for keyup and change events on the value input field
  $(document).on("keyup change", ".quote1_value", function() {
  	updateQuoteTotal(); // Update the total when the value changes
  });

  // Function to calculate and update the quote total
  function updateQuoteTotal() {
    var quote1Rate = $(".quote1_rate").val(); // Get the value from the rate input field
    var quote1Value = $(".quote1_value").val(); // Get the value from the quantity input field
    var total = quote1Rate * quote1Value; // Calculate the total

    $(".quote1_total").val(total); // Update the total input field with the calculated value
  }
});

/*----------*//*----------*/

// add more rooms
$(document).ready(function() {

	// Function to enable/disable the Add more rooms button based on the number of rooms
	function toggleAddRoomButton() {
		var select_room = $(".select_room").val();

		// Enable the button if more than 1 room is selected, otherwise disable it
		if (select_room > 1) {
			$("#add_certification").prop("disabled", false);
		} else {
			$("#add_certification").prop("disabled", true);
		}
	}

	// Initial check when the page loads
	toggleAddRoomButton();

	// Event listener for room selection dropdown changes
	$(".select_room").on("change", function() {
		toggleAddRoomButton();  // Recheck the room selection whenever it changes
	});

	// Event listener for adding a new certification (room) on click
  $(document).on("click", "#add_certification", function(e) {
  	e.preventDefault();

    var select_room = $(".select_room").val();
    var name_count1 = $(".dynamic_four").children("div:last").attr("id").slice(7);
    var name_count = Math.round(name_count1) - 1;
    name_count1++;
    name_count++;

    var total_div = $(".dynamic_four").children("div").length;

    if (total_div < select_room) {
    	// Append a new room block to the container with dynamic IDs and names
			$(".dynamic_four").append(
				'<div id="fourrow' + name_count1 + '">' +
		        '<div class="room-container">' +
		            '<label for="room" class="label textUppercase">Room ' + name_count1 + ' </label>' +
		            '<div class="makeflex align-center">' +
		                '<div class="label">Maximum guest allowed <span class="requiredcolor">*</span></div>' +
		                '<select class="form-control max_passenger" name="room[' + name_count + '][max_passenger]" style="max-width: 90px; border-radius: 3px;">' +
		                    '<option value="1">1</option>' +
		                    '<option value="2" selected>2</option>' +
		                    '<option value="3">3</option>' +
		                    '<option value="4">4</option>' +
		                    '<option value="5">5</option>' +
		                    '<option value="6">6</option>' +
		                    '<option value="7">7</option>' +
		                    '<option value="8">8</option>' +
		                    '<option value="9">9</option>' +
		                    '<option value="10">10</option>' +
		                '</select>' +
		            '</div>' +
		            '<div class="guest-room-wrapper mobScroll scrollX">' +
		                '<div>' +
		                    '<div class="addTravellerValue">' +
		                        '<input type="hidden" id="travellers" name="room[' + name_count + '][twin_adult_room]" class="twin_adult_room_value" value="2" />' +
		                        '<span class="travellersMinus twin_adult_room_dec">&#8722;</span>' +
		                        '<span class="travellersValue twin_adult_room_result">2</span>' +
		                        '<span class="travellersPlus twin_adult_room_inc">&#43;</span>' +
		                    '</div>' +
		                    '<p class="itemBottomHeading">Adult (Twin Sharing +12yrs)</p>' +
		                '</div>' +
		                '<div>' +
		                    '<div class="addTravellerValue">' +
		                        '<input type="hidden" id="travellers" name="room[' + name_count + '][extra_adult_room]" class="extra_adult_room_value" value="0" />' +
		                        '<span class="travellersMinus extra_adult_room_dec">&#8722;</span>' +
		                        '<span class="travellersValue extra_adult_room_result">0</span>' +
		                        '<span class="travellersPlus extra_adult_room_inc">&#43;</span>' +
		                    '</div>' +
		                    '<p class="itemBottomHeading">Extra Adult (+12yrs)</p>' +
		                '</div>' +
		                '<div>' +
		                    '<div class="addTravellerValue">' +
		                        '<input type="hidden" id="travellers" name="room[' + name_count + '][child_with_bed_room]" class="child_with_bed_room_value" value="0" />' +
		                        '<span class="travellersMinus child_with_bed_room_dec">&#8722;</span>' +
		                        '<span class="travellersValue child_with_bed_room_result">0</span>' +
		                        '<span class="travellersPlus child_with_bed_room_inc">&#43;</span>' +
		                    '</div>' +
		                    '<p class="itemBottomHeading">Child (With Bed 2-12yrs)</p>' +
		                '</div>' +
		                '<div>' +
		                    '<div class="addTravellerValue">' +
		                        '<input type="hidden" id="travellers" name="room[' + name_count + '][child_without_bed_room]" class="child_without_bed_room_value" value="0" />' +
		                        '<span class="travellersMinus child_without_bed_room_dec">&#8722;</span>' +
		                        '<span class="travellersValue child_without_bed_room_result">0</span>' +
		                        '<span class="travellersPlus child_without_bed_room_inc">&#43;</span>' +
		                    '</div>' +
		                    '<p class="itemBottomHeading">Child (without bed 2-12yrs)</p>' +
		                '</div>' +
		                '<div>' +
		                    '<div class="addTravellerValue">' +
		                        '<input type="hidden" id="travellers" name="room[' + name_count + '][infant_room]" class="infant_room_value" value="0" />' +
		                        '<span class="travellersMinus infant_room_dec">&#8722;</span>' +
		                        '<span class="travellersValue infant_room_result">0</span>' +
		                        '<span class="travellersPlus infant_room_inc">&#43;</span>' +
		                    '</div>' +
		                    '<p class="itemBottomHeading">Infant (0-2yrs)</p>' +
		                '</div>' +
		                '<div>' +
		                    '<div class="addTravellerValue">' +
		                        '<input type="hidden" id="travellers" name="room[' + name_count + '][single_room]" class="single_room_value" value="0" />' +
		                        '<span class="travellersMinus single_room_dec">&#8722;</span>' +
		                        '<span class="travellersValue single_room_result">0</span>' +
		                        '<span class="travellersPlus single_room_inc">&#43;</span>' +
		                    '</div>' +
		                    '<p class="itemBottomHeading">Single (+12yrs)</p>' +
		                '</div>' +
		                '<div class="text-center">' +
		                    '<button type="button" name="remove" id="' + name_count1 + '" class="btn btn-danger btn_remove_four">' +
		                        '<span class="fa fa-minus"></span> Remove room' +
		                    '</button>' +
		                '</div>' +
		            '</div>' +
		        '</div>' +
		    '</div>'
			);

		} else {
			alert('Increase the number of rooms to add more rooms.');
		}
		get_sum_passenger();
		get_seperate_passenger();
	});

	// remove room
	$(document).on('click', '.btn_remove_four', function() {
	    // Get the ID of the clicked remove button
	    var button_id = $(this).attr("id");
	    
	    // Remove the corresponding room row based on the button ID
	    $('#fourrow' + button_id).remove();
	    
	    // Update the total number of passengers after removing the room
	    get_sum_passenger();
	    
	    // Recalculate and update the separate passenger counts
	    get_seperate_passenger();
	});
});

/*----------*//*----------*/

// room container
$(document).ready(function() {
  // Function to handle the calculation of passengers for a specific room container
  function no_of_traveller_check(roomContainer) {
  	var twinAdult = parseInt(roomContainer.find(".twin_adult_room_value").val(), 10) || 0;
  	var extraAdult = parseInt(roomContainer.find(".extra_adult_room_value").val(), 10) || 0;
  	var childWithBed = parseInt(roomContainer.find(".child_with_bed_room_value").val(), 10) || 0;
  	var childWithoutBed = parseInt(roomContainer.find(".child_without_bed_room_value").val(), 10) || 0;
  	var infant = parseInt(roomContainer.find(".infant_room_value").val(), 10) || 0;
  	var single = parseInt(roomContainer.find(".single_room_value").val(), 10) || 0;

  	// Calculate the total passengers for this specific room container
  	return twinAdult + extraAdult + childWithBed + childWithoutBed + infant + single;
  }

  // Function to handle room value increment or decrement
  function handleRoomValueChange(button, type, action) {
  	// Get the current room container
  	var $roomContainer = $(button).closest(".room-container");

  	// Get the current value of the room input
  	var $valueElement = $roomContainer.find("." + type + "_room_value");
  	var $resultElement = $roomContainer.find("." + type + "_room_result");
  	var span_value = parseInt($valueElement.val(), 10);

		// Get the specific room's total allowed passengers
		var total_allowed = parseInt($roomContainer.find(".max_passenger").val(), 10);

    // Get the current number of passengers in this room
    var passenger = no_of_traveller_check($roomContainer);

    // Determine the new value
    var newValue = (action === 'inc') ? span_value + 1 : span_value - 1;

    // Handle incrementing
    if (action === 'inc') {
    	if (passenger < total_allowed) {
    		$resultElement.html(newValue);
    		$valueElement.val(newValue);
    	} else {
    		alert('Please note that the maximum occupancy for this room is ' + total_allowed + ' guests. Kindly make the necessary adjustments to comply with this limit.');
    	}
    }
    // Handle decrementing
    else if (action === 'dec') {
    	var twinAdultValue = parseInt($roomContainer.find(".twin_adult_room_value").val(), 10) || 0;
    	var singleValue = parseInt($roomContainer.find(".single_room_value").val(), 10) || 0;

    	// Check if decrement action will result in both values being 0
    	if (type === 'twin_adult' && singleValue === 0 && newValue <= 0) {
    		alert('At least one of Twin Adult or Single Adult values must be greater than 0.');
    		return false;
    	} else if (type === 'single' && twinAdultValue === 0 && newValue <= 0) {
    		alert('At least one of Twin Adult or Single Adult values must be greater than 0.');
    		return false;
    	}

    	if (newValue >= 0) {
    		$resultElement.html(newValue);
    		$valueElement.val(newValue);
    	} else {
    		alert('This cannot be negative');
    	}
    }

    // Update overall passenger sum and separate passenger details
    get_sum_passenger();
    get_seperate_passenger();
  }

  // Event handler for incrementing room values
  $(document).on("click", ".twin_adult_room_inc, .extra_adult_room_inc, .child_with_bed_room_inc, .child_without_bed_room_inc, .infant_room_inc, .single_room_inc", function() {
        var type;
        if ($(this).hasClass('twin_adult_room_inc')) {
            type = 'twin_adult';
        } else if ($(this).hasClass('extra_adult_room_inc')) {
            type = 'extra_adult';
        } else if ($(this).hasClass('child_with_bed_room_inc')) {
            type = 'child_with_bed';
        } else if ($(this).hasClass('child_without_bed_room_inc')) {
            type = 'child_without_bed';
        } else if ($(this).hasClass('infant_room_inc')) {
            type = 'infant';
        } else if ($(this).hasClass('single_room_inc')) {
            type = 'single';
        }
        handleRoomValueChange(this, type, 'inc');
  });

  // Event handler for decrementing room values
  $(document).on("click", ".twin_adult_room_dec, .extra_adult_room_dec, .child_with_bed_room_dec, .child_without_bed_room_dec, .infant_room_dec, .single_room_dec", function() {
        var type;
        if ($(this).hasClass('twin_adult_room_dec')) {
            type = 'twin_adult';
        } else if ($(this).hasClass('extra_adult_room_dec')) {
            type = 'extra_adult';
        } else if ($(this).hasClass('child_with_bed_room_dec')) {
            type = 'child_with_bed';
        } else if ($(this).hasClass('child_without_bed_room_dec')) {
            type = 'child_without_bed';
        } else if ($(this).hasClass('infant_room_dec')) {
            type = 'infant';
        } else if ($(this).hasClass('single_room_dec')) {
            type = 'single';
        }
        handleRoomValueChange(this, type, 'dec');
  });
});

	/*----------*//*----------*/

	function get_sum_passenger() {
	    // Initialize variables to hold the total count for each passenger category
	    var twin_adult = 0;
	    var extra_adult = 0;
	    var child_with_bed = 0;
	    var child_without_bed = 0;
	    var infant_room = 0;
	    var single_room = 0;

	    // Calculate the total number of twin adults
	    $(".twin_adult_room_value").each(function() {
	        var val = $(this).val();
	        if (val != '' && val != 0) {
	            twin_adult = Math.round(twin_adult) + Math.round(val);
	        }
	    });

	    // Enable or disable fields based on twin_adult count
	    if (twin_adult == 0) {
	        $(".adult_disable").each(function() {
	            $(this).val('');
	            $(this).attr('readonly', '');
	        });
	    } else {
	        $(".adult_disable").each(function() {
	            $(this).removeAttr('readonly');
	        });
	    }

	    // Calculate the total number of extra adults
	    $(".extra_adult_room_value").each(function() {
	        var val = $(this).val();
	        if (val != '' && val != 0) {
	            extra_adult = Math.round(extra_adult) + Math.round(val);
	        }
	    });

	    // Enable or disable fields based on extra_adult count
	    if (extra_adult == 0) {
	        $(".exadult_disable").each(function() {
	            $(this).val('');
	            $(this).attr('readonly', '');
	        });
	    } else {
	        $(".exadult_disable").each(function() {
	            $(this).removeAttr('readonly');
	        });
	    }

	    // Calculate the total number of single rooms
	    $(".single_room_value").each(function() {
	        var val = $(this).val();
	        if (val != '' && val != 0) {
	            single_room = Math.round(single_room) + Math.round(val);
	        }
	    });

	    // Enable or disable fields based on single_room count
	    if (single_room == 0) {
	        $(".single_disable").each(function() {
	            $(this).val('');
	            $(this).attr('readonly', '');
	        });
	    } else {
	        $(".single_disable").each(function() {
	            $(this).removeAttr('readonly');
	        });
	    }

	    // Calculate the total number of children with bed
	    $(".child_with_bed_room_value").each(function() {
	        var val = $(this).val();
	        if (val != '' && val != 0) {
	            child_with_bed = Math.round(child_with_bed) + Math.round(val);
	        }
	    });

	    // Enable or disable fields based on child_with_bed count
	    if (child_with_bed == 0) {
	        $(".childbed_disable").each(function() {
	            $(this).val('');
	            $(this).attr('readonly', '');
	        });
	    } else {
	        $(".childbed_disable").each(function() {
	            $(this).removeAttr('readonly');
	        });
	    }

	    // Calculate the total number of children without bed
	    $(".child_without_bed_room_value").each(function() {
	        var val = $(this).val();
	        if (val != '' && val != 0) {
	            child_without_bed = Math.round(child_without_bed) + Math.round(val);
	        }
	    });

	    // Enable or disable fields based on child_without_bed count
	    if (child_without_bed == 0) {
	        $(".childwbed_disable").each(function() {
	            $(this).val('');
	            $(this).attr('readonly', '');
	        });
	    } else {
	        $(".childwbed_disable").each(function() {
	            $(this).removeAttr('readonly');
	        });
	    }

	    // Calculate the total number of infants
	    $(".infant_room_value").each(function() {
	        var val = $(this).val();
	        if (val != '' && val != 0) {
	            infant_room = Math.round(infant_room) + Math.round(val);
	        }
	    });

	    // Enable or disable fields based on infant_room count
	    if (infant_room == 0) {
	        $(".infant_disable").each(function() {
	            $(this).val('');
	            $(this).attr('readonly', '');
	        });
	    } else {
	        $(".infant_disable").each(function() {
	            $(this).removeAttr('readonly');
	        });
	    }

	    // Update the UI with the calculated values for each category
	    $(".quote1_adult_room_value").val("").val(twin_adult);
	    $(".quote1_adult_room_result").html("").html(twin_adult);

	    $(".quote1_number_of_extra_adult").val("").val(extra_adult);
	    $(".quote1_child_extra_adult_result").html("").html(extra_adult);

	    $(".quote1_number_of_child_with_bed").val("").val(child_with_bed);
	    $(".quote1_child_with_bed_result").html("").html(child_with_bed);

	    $(".quote1_number_of_child_without_bed").val("").val(child_without_bed);
	    $(".quote1_span_value_childwithoutbed_result").html("").html(child_without_bed);

	    $(".quote1_number_of_infant").val("").val(infant_room);
	    $(".quote1_infant_result").html("").html(infant_room);

	    $(".quote1_number_solo_traveller").val("").val(single_room);
	    $(".quote1_solo_result").html("").html(single_room);

	    // Call the price calculation function with all required parameters
	    
			quote1_price('quote1_air_adult','quote1_cruise_adult','quote1_cruiseport_adult','quote1_cruisegratuity_adult','quote1_cruisegst_adult','quote1_hotel_adult','quote1_tours_adult','quote1_transfer_adult','quote1_visa_adult','quote1_inc_adult','quote1_meals_adult','quote1_additionalservice_adult','quote1_tourtotal_adult','quote1_tourtotal_exadult','quote1_tourtotal_childbed','quote1_tourtotal_childwbed','quote1_tourtotal_infant','quote1_tourtotal_single','pricemarkup','markup_percentage','quote1_markup_adult','quote1_markup_exadult','quote1_markup_childbed','quote1_markup_childwbed','quote1_markup_infant','quote1_markup_single','quote1_total_adult','quote1_discount_adult_plus','quote1_gross_total_adult','quote1_gross_total_exadult','quote1_gross_total_childbed','quote1_gross_total_childwbed','quote1_gross_total_infant','quote1_gross_total_single','quote1_gross_total_group','quote1_discount_adult_minus','quote1_discount_exadult_minus','quote1_discount_childbed_minus','quote1_discount_childwbed_minus','quote1_discount_infant_minus','quote1_discount_single_minus','pricegst','gst_percentage','quote1_gst_adult','quote1_gst_adult','quote1_gst_exadult','quote1_gst_childbed','quote1_gst_childwbed','quote1_gst_infant','quote1_gst_single','quote1_gst_group','quote1_gsttotal_adult','pricetcs','tcs_percentage','quote1_tcs_adult','quote1_tcs_exadult','quote1_tcs_childbed','quote1_tcs_childwbed','quote1_tcs_infant','quote1_tcs_single','quote1_tcs_group','quote1_tcstotal_adult','pricepgcharges','pgcharges_percentage','quote1_pgcharges_adult','quote1_pgcharges_exadult','quote1_pgcharges_childbed','quote1_pgcharges_childwbed','quote1_pgcharges_infant','quote1_pgcharges_single','quote1_pg_group','quote1_grand_adult','quote1_grand_adult_with_person','query_pricetopay','quote1_number_of_adult','quote1_number_of_extra_adult','quote1_number_of_child_with_bed','quote1_number_of_child_without_bed','quote1_number_of_infant','quote1_number_solo_traveller','quote1_grand_exadult_with_person','quote1_grand_childbed_with_person','quote1_grand_childwbed_with_person','quote1_grand_infant_with_person','quote1_grand_single_with_person','quote1_discount_group','quote1_gsttotal_exadult','quote1_gsttotal_childbed','quote1_gsttotal_childwbed','quote1_gsttotal_infant','quote1_gsttotal_single','quote1_tcstotal_exadult','quote1_tcstotal_childbed','quote1_tcstotal_childwbed','quote1_tcstotal_infant','quote1_tcstotal_single','quote1_air_exadult','quote1_cruise_exadult','quote1_cruiseport_exadult','quote1_cruisegratuity_exadult','quote1_cruisegst_exadult','quote1_hotel_exadult','quote1_tours_exadult','quote1_transfer_exadult','quote1_visa_exadult','quote1_inc_exadult','quote1_meals_exadult','quote1_additionalservice_exadult','quote1_discount_exadult_plus','quote1_grand_exadult','quote1_grand_childbed','quote1_grand_childwbed','quote1_grand_infant','quote1_grand_single','quote1_air_childbed','quote1_cruise_childbed','quote1_cruiseport_childbed','quote1_cruisegratuity_childbed','quote1_cruisegst_childbed','quote1_hotel_childbed','quote1_tours_childbed','quote1_transfer_childbed','quote1_visa_childbed','quote1_inc_childbed','quote1_meals_childbed','quote1_additionalservice_childbed','quote1_discount_childbed_plus','quote1_air_childwbed','quote1_cruise_childwbed','quote1_cruiseport_childwbed','quote1_cruisegratuity_childwbed','quote1_cruisegst_childwbed','quote1_hotel_childwbed','quote1_tours_childwbed','quote1_transfer_childwbed','quote1_visa_childwbed','quote1_inc_childwbed','quote1_meals_childwbed','quote1_additionalservice_childwbed','quote1_discount_childwbed_plus','quote1_air_infant','quote1_cruise_infant','quote1_cruiseport_infant','quote1_cruisegratuity_infant','quote1_cruisegst_infant','quote1_hotel_infant','quote1_tours_infant','quote1_transfer_infant','quote1_visa_infant','quote1_inc_infant','quote1_meals_infant','quote1_additionalservice_infant','quote1_discount_infant_plus','quote1_air_single','quote1_cruise_single','quote1_cruiseport_single','quote1_cruisegratuity_single','quote1_cruisegst_single','quote1_hotel_single','quote1_tours_single','quote1_transfer_single','quote1_visa_single','quote1_inc_single','quote1_meals_single','quote1_additionalservice_single','quote1_discount_single_plus','quote1_pricetopay','pricediscountpositive','discountpositive_percentage','pricediscountnegative','discountnegative_percentage','advance_payment','advance_payment_percentage','quote1_advance_payment','first_part_payment','first_part_percentage','quote1_first_part','second_part_payment','second_part_percentage','quote1_second_part','quote1_total_payment','show_part_payment','advance_payment_percentage','quote1_advance_payment','first_part_percentage','quote1_first_part','second_part_percentage','quote1_second_part','quote1_total_payment','coupon_percentage');
	}

	/*----------*//*----------*/

	function get_seperate_passenger() {
	    // Initialize counters for different types of passengers
	    var adult = 0;
	    var child = 0;
	    var infant = 0;

	    // Sum up the total number of adults from different room types
	    $(".twin_adult_room_value").each(function() {
	        var val = $(this).val();
	        if (val != '' && val != 0) {
	            adult = Math.round(adult) + Math.round(val);
	        }
	    });

	    $(".extra_adult_room_value").each(function() {
	        var val = $(this).val();
	        if (val != '' && val != 0) {
	            adult = Math.round(adult) + Math.round(val);
	        }
	    });

	    $(".single_room_value").each(function() {
	        var val = $(this).val();
	        if (val != '' && val != 0) {
	            adult = Math.round(adult) + Math.round(val);
	        }
	    });

	    // Sum up the total number of children from different room types
	    $(".child_with_bed_room_value").each(function() {
	        var val = $(this).val();
	        if (val != '' && val != 0) {
	            child = Math.round(child) + Math.round(val);
	        }
	    });

	    $(".child_without_bed_room_value").each(function() {
	        var val = $(this).val();
	        if (val != '' && val != 0) {
	            child = Math.round(child) + Math.round(val);
	        }
	    });

	    // Sum up the total number of infants
	    $(".infant_room_value").each(function() {
	        var val = $(this).val();
	        if (val != '' && val != 0) {
	            infant = Math.round(infant) + Math.round(val);
	        }
	    });

	    // Get the number of rooms selected
	    var select_room = $(".dynamic_four").children("div").length;

	    // Construct the passenger information string
	    var pass = select_room + ' Rooms (' + adult + ' Adults ' + child + ' Child ' + infant + ' Infant' + ')';

	    // Set the constructed string to the input field
	    $(".quote1_pop_passenger_value").val('').val(pass);
	}

	/*----------*//*----------*/

	function no_of_traveller_check(thisObj) {
	    // Get the value of the sibling input (the current number of passengers)
	    var passenger = thisObj.siblings('input').val();

	    // Iterate over each sibling element of the parent's parent
	    thisObj.parent().parent().siblings().each(function() {
	        // Check if the current element has more than 2 children inside the '.addTravellerValue' div
	        if ($(this).children('.addTravellerValue').children().length > 2) {
	            // Get the value of the input inside '.addTravellerValue'
	            var val = $(this).children('.addTravellerValue').children('input').val();

	            // If the value is not empty and not zero, add it to the total number of passengers
	            if (val !== '' && val != 0) {
	                passenger = Math.round(passenger) + Math.round(val);
	            }
	        }
	    });

	    // Return the total number of passengers
	    return passenger;
	}


/*----------*//*----------*/

// automatically set the priceremarks
$(document).ready(function() {
	$('.price_type').change(function() {
		var selectedPriceType = $(this).val();

		// Automatically set the priceremarks (anything) based on selected price type
		if (selectedPriceType === '1') {
			$('select[name="priceremarks"]').val('1');
		} else if (selectedPriceType === '2') {
			$('select[name="priceremarks"]').val('2');
		}
	});
	
	// Disable priceremarks field on page load
	$('select[name="priceremarks"]').prop('disabled', true);
});

/*----------*//*----------*/

// Event handler for the "Update" button click
$(document).on("click", "#enq_update", function() {
  // Hide the modal dialog
  $('#addBookDialog').modal('hide');
});

// Event handler for showing the booking dialog when the "get_room" button is clicked
$(document).on('click', '.get_room', function(e) {
  
  e.preventDefault(); // Prevent default link behavior

  // Show the modal dialog
  $('#addBookDialog').modal('show');
});

// Event handler for changes in the "max_passenger" select field
$(document).on('change', '.max_passenger', function(event) {
  var max_passenger = $(this).val(); // Get the selected maximum passenger value
  var passenger = 0;

  // Calculate total number of passengers from the input fields
  $(this).siblings('.guest-room-wrapper').children().each(function() {
    if ($(this).children('.addTravellerValue').children().length > 2) {
      var val = $(this).children('.addTravellerValue').children('input').val();
      if (val !== '' && val !== 0) {
        passenger += Math.round(val);
      }
    }
  });

  // Check if total passengers exceed the maximum allowed
  if (max_passenger < passenger) {
  	// Set the option corresponding to the current passenger count as selected
    $(this).find('option:contains("' + passenger + '")').prop('selected', true);
    alert('Maximum passenger should be greater than or equal to the number of passengers');
    return false; // Prevent form submission or further action
  }
});

// On document ready, set certain fields to readonly
$(document).ready(function() {
  // Set fields to readonly
  $(".quote1_first_part").attr('readonly', '');
  $(".quote1_second_part").attr('readonly', '');
});

/*----------*//*----------*/

// direct payment
$(document).ready(function() {
	/*// Event handler for the "show_part_payment" checkbox change event
		$("#show_part_payment").change(function() {
		    var isChecked = $(this).is(':checked'); // Check if the checkbox is checked
		    var quote1_pricetopay = parseInt($('.quote1_pricetopay').val()) || 0; // Get the total price to pay

		    if (isChecked) {
		        // When the checkbox is checked, make the advance payment field readonly
		        $(".quote1_advance_payment").attr('readonly', '');

		        // Show all elements with the "part_payment" class and set their related fields
		        jQuery('.part_payment').each(function() {
		            $(this).css('display', 'block');
		            $('.advance_payment_percentage').val(100); // Set advance payment percentage to 100%
		            $('.quote1_advance_payment').val(quote1_pricetopay); // Set advance payment to the total price
		            $('.first_part_percentage').val(''); // Clear first part percentage
		            $('.quote1_first_part').val(''); // Clear first part value
		            $('.second_part_percentage').val(''); // Clear second part percentage
		            $('.quote1_second_part').val(''); // Clear second part value
		            $('.quote1_total_payment').val(quote1_pricetopay); // Set total payment to the total price
		            $(".first_part_percentage").attr('disabled', ''); // Make first part percentage readonly
		            $(".second_part_percentage").attr('disabled', ''); // Make second part percentage readonly
		        });
		    } else {
		        // Hide part payment fields if the checkbox is unchecked
		        jQuery('.part_payment').each(function() {
		            $(this).css('display', 'none');
		        });
		    }
		});

		// Event handler for change event on #show_direct_part
		$("#show_direct_part").change(function() {
		    var isChecked = $(this).is(':checked'); // Check if the checkbox is checked
		    if (isChecked) {
		        $(".direct_part").css('display', 'block'); // Show the direct part section
		    } else {
		        $(".direct_part").css('display', 'none'); // Hide the direct part section
		    }
		});

		// Event handler for changes in advance payment percentage
		$(document).on("change", ".advance_payment_percentage", function() {
		    var advance_payment_percentage = parseInt($(this).val()) || 0;
		    var quote1_pricetopay = parseInt($('.quote1_pricetopay').val()) || 0;

		    // Update the quote1_advance_payment value
		    var advance_payment_value = Math.round(advance_payment_percentage * quote1_pricetopay / 100);
		    $('.quote1_advance_payment').val(advance_payment_value);

		    // Calculate remaining percentage
		    var remaining_percentage = 100 - advance_payment_percentage;

		    // Update first part payment percentage and value
		    $('.first_part_percentage').val(remaining_percentage);
		    var first_part_value = Math.round(remaining_percentage * quote1_pricetopay / 100);
		    $('.quote1_first_part').val(first_part_value);

		    // Clear the second part payment fields
		    $('.second_part_percentage').val('');
		    $('.quote1_second_part').val('');
		});

		// Event handler for changes in first part payment percentage
		$(document).on("change", ".first_part_percentage", function() {
		    var advance_payment_percentage = parseInt($('.advance_payment_percentage').val()) || 0;
		    var first_part_percentage = parseInt($(this).val()) || 0;
		    var quote1_pricetopay = parseInt($('.quote1_pricetopay').val()) || 0;

		    // Calculate remaining percentage for the second part
		    var remaining_percentage = 100 - advance_payment_percentage - first_part_percentage;

		    // Check if total percentage exceeds 100%
		    if (remaining_percentage < 0) {
		        alert("Total percentage cannot exceed 100%");
		        $(this).val(''); // Clear the input
		        $('.first_part_percentage').val(100 - advance_payment_percentage); // Reset to valid value
		        $('.quote1_first_part').val(Math.round((100 - advance_payment_percentage) * quote1_pricetopay / 100)); // Reset first part value
		        $('.second_part_percentage').val('');
		        $('.quote1_second_part').val('');
		    } else {
		        // Update second part payment percentage and value
		        $('.second_part_percentage').val(remaining_percentage);
		        var second_part_value = Math.round(remaining_percentage * quote1_pricetopay / 100);
		        $('.quote1_second_part').val(second_part_value);

		        // Update first part payment value
		        var first_part_value = Math.round(first_part_percentage * quote1_pricetopay / 100);
		        $('.quote1_first_part').val(first_part_value);
		    }
		});

		// Event handler for changes in second part payment percentage
		$(document).on("change", ".second_part_percentage", function() {
		    var advance_payment_percentage = parseInt($('.advance_payment_percentage').val()) || 0;
		    var first_part_percentage = parseInt($('.first_part_percentage').val()) || 0;
		    var second_part_percentage = parseInt($(this).val()) || 0;
		    var quote1_pricetopay = parseInt($('.quote1_pricetopay').val()) || 0;

		    // Calculate the total percentage
		    var total_percentage = advance_payment_percentage + first_part_percentage + second_part_percentage;

		    // Check if total percentage exceeds 100%
		    if (total_percentage > 100) {
		        alert("Total percentage cannot exceed 100%");
		        $(this).val(''); // Clear the input
		        $('.quote1_second_part').val('');
		    } else {
		        var second_part_value = Math.round(second_part_percentage * quote1_pricetopay / 100);
		        $('.quote1_second_part').val(second_part_value);
		    }
		});*/

	//
	/*// Event handler for the "show_part_payment" checkbox change event
	$("#show_part_payment").change(function() {
	    var isChecked = $(this).is(':checked'); // Check if the checkbox is checked
	    var quote1_pricetopay = parseInt($('.quote1_pricetopay').val()) || 0; // Get the total price to pay

	    if (isChecked) {
	        // When the checkbox is checked, make the advance payment field readonly
	        $(".quote1_advance_payment").attr('readonly', '');

	        // Show all elements with the "part_payment" class and set their related fields
	        jQuery('.part_payment').each(function() {
	            $(this).css('display', 'block');
	            $('.advance_payment_percentage').val(100); // Set advance payment percentage to 100%
	            $('.quote1_advance_payment').val(quote1_pricetopay); // Set advance payment to the total price
	            $('.first_part_percentage').val('').attr('disabled', 'disabled'); // Clear and disable first part percentage
	            $('.quote1_first_part').val(''); // Clear first part value
	            $('.second_part_percentage').val('').attr('disabled', 'disabled'); // Clear and disable second part percentage
	            $('.quote1_second_part').val(''); // Clear second part value
	            $('.quote1_total_payment').val(quote1_pricetopay); // Set total payment to the total price
	        });
	    } else {
	        // Hide part payment fields if the checkbox is unchecked
	        jQuery('.part_payment').each(function() {
	            $(this).css('display', 'none');
	        });
	    }
	});

	// Event handler for change event on #show_direct_part
	$("#show_direct_part").change(function() {
	    var isChecked = $(this).is(':checked'); // Check if the checkbox is checked
	    if (isChecked) {
	        $(".direct_part").css('display', 'block'); // Show the direct part section
	    } else {
	        $(".direct_part").css('display', 'none'); // Hide the direct part section
	    }
	});

	// Event handler for changes in advance payment percentage
	$(document).on("change", ".advance_payment_percentage", function() {
	    var advance_payment_percentage = parseInt($(this).val()) || 0;
	    var quote1_pricetopay = parseInt($('.quote1_pricetopay').val()) || 0;

	    // Update the quote1_advance_payment value
	    var advance_payment_value = Math.round(advance_payment_percentage * quote1_pricetopay / 100);
	    $('.quote1_advance_payment').val(advance_payment_value);

	    // Calculate remaining percentage
	    var remaining_percentage = 100 - advance_payment_percentage;

	    if (remaining_percentage > 0) {
	        $('.first_part_percentage').removeAttr('disabled'); // Enable first part percentage
	        $('.first_part_percentage').val(remaining_percentage); // Update first part percentage
	        var first_part_value = Math.round(remaining_percentage * quote1_pricetopay / 100);
	        $('.quote1_first_part').val(first_part_value); // Update first part value
	    } else {
	        $('.first_part_percentage').val('').attr('disabled', 'disabled'); // Disable and clear first part percentage
	        $('.quote1_first_part').val(''); // Clear first part value
	        $('.second_part_percentage').val('').attr('disabled', 'disabled'); // Disable and clear second part percentage
	        $('.quote1_second_part').val(''); // Clear second part value
	    }
	});

	// Event handler for changes in first part payment percentage
	$(document).on("change", ".first_part_percentage", function() {
	    var advance_payment_percentage = parseInt($('.advance_payment_percentage').val()) || 0;
	    var first_part_percentage = parseInt($(this).val()) || 0;
	    var quote1_pricetopay = parseInt($('.quote1_pricetopay').val()) || 0;

	    // Calculate remaining percentage for the second part
	    var remaining_percentage = 100 - advance_payment_percentage - first_part_percentage;

	    // Check if total percentage exceeds 100%
	    if (remaining_percentage < 0) {
	        alert("Total percentage cannot exceed 100%");
	        $(this).val(''); // Clear the input
	        $('.first_part_percentage').val(100 - advance_payment_percentage); // Reset to valid value
	        $('.quote1_first_part').val(Math.round((100 - advance_payment_percentage) * quote1_pricetopay / 100)); // Reset first part value
	        $('.second_part_percentage').val('').attr('disabled', 'disabled'); // Disable and clear second part percentage
	        $('.quote1_second_part').val(''); // Clear second part value
	    } else {
	        //$('.second_part_percentage').removeAttr('disabled'); // Enable second part percentage
	        $('.second_part_percentage').val(remaining_percentage); // Update second part percentage
	        var second_part_value = Math.round(remaining_percentage * quote1_pricetopay / 100);
	        $('.quote1_second_part').val(second_part_value); // Update second part value

	        // Update first part payment value
	        var first_part_value = Math.round(first_part_percentage * quote1_pricetopay / 100);
	        $('.quote1_first_part').val(first_part_value);
	    }
	});

	// Event handler for changes in second part payment percentage
	$(document).on("change", ".second_part_percentage", function() {
	    var advance_payment_percentage = parseInt($('.advance_payment_percentage').val()) || 0;
	    var first_part_percentage = parseInt($('.first_part_percentage').val()) || 0;
	    var second_part_percentage = parseInt($(this).val()) || 0;
	    var quote1_pricetopay = parseInt($('.quote1_pricetopay').val()) || 0;

	    // Calculate the total percentage
	    var total_percentage = advance_payment_percentage + first_part_percentage + second_part_percentage;

	    // Check if total percentage exceeds 100%
	    if (total_percentage > 100) {
	        alert("Total percentage cannot exceed 100%");
	        $(this).val(''); // Clear the input
	        $('.quote1_second_part').val(''); // Clear second part value
	    } else {
	        var second_part_value = Math.round(second_part_percentage * quote1_pricetopay / 100);
	        $('.quote1_second_part').val(second_part_value); // Update second part value
	    }
	});*/

	//

	/*// Event handler for the "show_part_payment" checkbox change event
	$("#show_part_payment").change(function() {
	    var isChecked = $(this).is(':checked'); // Check if the checkbox is checked
	    var quote1_pricetopay = parseInt($('.quote1_pricetopay').val()) || 0; // Get the total price to pay

	    if (isChecked) {
	        // When the checkbox is checked, make the advance payment field readonly
	        $(".quote1_advance_payment").attr('readonly', '');

	        // Show all elements with the "part_payment" class and set their related fields
	        jQuery('.part_payment').each(function() {
	            $(this).css('display', 'block');
	            $('.advance_payment_percentage').val(100); // Set advance payment percentage to 100%
	            $('.quote1_advance_payment').val(quote1_pricetopay); // Set advance payment to the total price

	            $('.first_part_percentage').val('').attr('disabled', 'disabled'); // Clear and disable first part percentage
	            $('.quote1_first_part').val(0).attr('disabled', 'disabled'); // Set first part value to 0 and disable

	            $('.second_part_percentage').val(0).attr('disabled', 'disabled'); // Keep second part percentage disabled
	            $('.quote1_second_part').val(0); // Clear second part value

	            $('.quote1_total_payment').val(quote1_pricetopay); // Set total payment to the total price
	        });
	    } else {
	        // Hide part payment fields if the checkbox is unchecked
	        jQuery('.part_payment').each(function() {
	            $(this).css('display', 'none');
	        });
	    }
	});

	// Event handler for change event on #show_direct_part
	$("#show_direct_part").change(function() {
	    var isChecked = $(this).is(':checked'); // Check if the checkbox is checked
	    if (isChecked) {
	        $(".direct_part").css('display', 'block'); // Show the direct part section
	    } else {
	        $(".direct_part").css('display', 'none'); // Hide the direct part section
	    }
	});

	// Event handler for changes in advance payment percentage
	$(document).on("change", ".advance_payment_percentage", function() {
	    var advance_payment_percentage = parseInt($(this).val()) || 0;
	    var quote1_pricetopay = parseInt($('.quote1_pricetopay').val()) || 0;

	    // Update the quote1_advance_payment value
	    var advance_payment_value = Math.round(advance_payment_percentage * quote1_pricetopay / 100);
	    $('.quote1_advance_payment').val(advance_payment_value);

	    // Calculate remaining percentage
	    var remaining_percentage = 100 - advance_payment_percentage;

	    if (remaining_percentage > 0) {
	        $('.first_part_percentage').removeAttr('disabled'); // Enable first part percentage
	        $('.first_part_percentage').val(remaining_percentage); // Update first part percentage
	        var first_part_value = Math.round(remaining_percentage * quote1_pricetopay / 100);
	        $('.quote1_first_part').val(first_part_value); // Update first part value
	    } else {
	        $('.first_part_percentage').val('').attr('disabled', 'disabled'); // Reset to 0% and disable
	        $('.quote1_first_part').val(0).attr('disabled', 'disabled'); // Reset to 0 and disable

	        $('.second_part_percentage').val(0).attr('disabled', 'disabled'); // Keep second part percentage disabled
	        $('.quote1_second_part').val(0).attr('disabled', 'disabled'); // Reset to 0 and disable
	    }
	    // Automatically calculate second part
	    calculateSecondPart();
	});

	// Event handler for changes in first part payment percentage
	$(document).on("change", ".first_part_percentage", function() {
	    var advance_payment_percentage = parseInt($('.advance_payment_percentage').val()) || 0;
	    var first_part_percentage = parseInt($(this).val()) || 0;
	    var quote1_pricetopay = parseInt($('.quote1_pricetopay').val()) || 0;

	    // Calculate remaining percentage for the second part
	    var remaining_percentage = 100 - advance_payment_percentage - first_part_percentage;

	    // Check if total percentage exceeds 100%
	    if (remaining_percentage < 0) {
	        alert("Total percentage cannot exceed 100%");
	        $(this).val(''); // Clear the input
	        $('.first_part_percentage').val(100 - advance_payment_percentage); // Reset to valid value
	        $('.quote1_first_part').val(Math.round((100 - advance_payment_percentage) * quote1_pricetopay / 100)); // Reset first part value
	    } else {
	        // Update first part payment value
	        var first_part_value = Math.round(first_part_percentage * quote1_pricetopay / 100);
	        $('.quote1_first_part').val(first_part_value);
	    }

	    // Automatically calculate second part
	    calculateSecondPart();
	});

	// Function to calculate and update the second part percentage and value
	function calculateSecondPart() {
	    var advance_payment_percentage = parseInt($('.advance_payment_percentage').val()) || 0;
	    var first_part_percentage = parseInt($('.first_part_percentage').val()) || 0;
	    var quote1_pricetopay = parseInt($('.quote1_pricetopay').val()) || 0;

	    // Calculate remaining percentage for the second part
	    var second_part_percentage = 100 - advance_payment_percentage - first_part_percentage;

	    // Update the second part fields
	    $('.second_part_percentage').val(second_part_percentage);
	    var second_part_value = Math.round(second_part_percentage * quote1_pricetopay / 100);
	    $('.quote1_second_part').val(second_part_value);
	}*/

	//

	/*// Event handler for the "show_part_payment" checkbox change event
	$("#show_part_payment").change(function() {
	    var isChecked = $(this).is(':checked'); // Check if the checkbox is checked
	    var quote1_pricetopay = parseInt($('.quote1_pricetopay').val()) || 0; // Get the total price to pay

	    if (isChecked) {
	        $(".quote1_advance_payment").attr('readonly', ''); // Make the advance payment field readonly

	        // Show all elements with the "part_payment" class and set their related fields
	        jQuery('.part_payment').each(function() {
	            $(this).css('display', 'block');
	            $('.advance_payment_percentage').val(100); // Set advance payment percentage to 100%
	            $('.quote1_advance_payment').val(quote1_pricetopay); // Set advance payment to the total price

	            $('.first_part_percentage').val('').attr('disabled', 'disabled'); // Clear and disable first part percentage
	            $('.quote1_first_part').val(0).attr('disabled', 'disabled'); // Set first part value to 0 and disable
	            $('.datepicker_first_payment').val('').attr('disabled', 'disabled'); // Set first part value to 0 and disable

	            $('.second_part_percentage').val(0).attr('disabled', 'disabled'); // Keep second part percentage disabled
	            $('.quote1_second_part').val(0); // Clear second part value
	            $('.datepicker_second_payment').val('').attr('disabled', 'disabled'); // Set first part value to 0 and disable

	            $('.quote1_total_payment').val(quote1_pricetopay); // Set total payment to the total price
	        });
	    } else {
	        // Hide part payment fields if the checkbox is unchecked
	        jQuery('.part_payment').each(function() {
	            $(this).css('display', 'none');
	        });
	    }
	});

	// Event handler for change event on advance payment percentage
	$(document).on("change", ".advance_payment_percentage", function() {
	    var advance_payment_percentage = parseInt($(this).val()) || 0;
	    var quote1_pricetopay = parseInt($('.quote1_pricetopay').val()) || 0;

	    // Update the quote1_advance_payment value
	    var advance_payment_value = Math.round(advance_payment_percentage * quote1_pricetopay / 100);
	    $('.quote1_advance_payment').val(advance_payment_value);

	    // Calculate remaining percentage
	    var remaining_percentage = 100 - advance_payment_percentage;

	    if (remaining_percentage > 0) {
	        $('.first_part_percentage').removeAttr('disabled').val(remaining_percentage); // Enable first part percentage
	        var first_part_value = Math.round(remaining_percentage * quote1_pricetopay / 100);
	        $('.quote1_first_part').val(first_part_value); // Update first part value
	        $('.datepicker_first_payment').removeAttr('disabled'); // Enable datepicker first payment
	    } else {
	        $('.first_part_percentage').val('').attr('disabled', 'disabled'); // Reset to 0% and disable
	        $('.quote1_first_part').val(0).attr('disabled', 'disabled'); // Reset to 0 and disable
	        $('.datepicker_first_payment').removeAttr('disabled'); // Enable datepicker first payment
	    }

	    // Automatically calculate second part
	    calculateSecondPart();
	});

	// Event handler for changes in first part payment percentage
	$(document).on("change", ".first_part_percentage", function() {
	    var advance_payment_percentage = parseInt($('.advance_payment_percentage').val()) || 0;
	    var first_part_percentage = parseInt($(this).val()) || 0;
	    var quote1_pricetopay = parseInt($('.quote1_pricetopay').val()) || 0;

	    // Calculate remaining percentage for the second part
	    var remaining_percentage = 100 - advance_payment_percentage - first_part_percentage;

	    if (remaining_percentage < 0) {
	        alert("Total percentage cannot exceed 100%");

	        $(this).val(''); // Clear the input

	        $('.quote1_first_part').val(0); // Reset first part value to 0

	        // Update first part percentage to valid value
	        var valid_first_part_percentage = 100 - advance_payment_percentage;
	        $('.first_part_percentage').val(valid_first_part_percentage);
	        $('.quote1_first_part').val(Math.round(valid_first_part_percentage * quote1_pricetopay / 100));
	    } else {
	        // Update first part payment value
	        var first_part_value = Math.round(first_part_percentage * quote1_pricetopay / 100);
	        $('.quote1_first_part').val(first_part_value);
	    }

	    // Automatically calculate second part
	    calculateSecondPart();
	});

	// Function to calculate and update the second part percentage and value
	function calculateSecondPart() {
	    var advance_payment_percentage = parseInt($('.advance_payment_percentage').val()) || 0;
	    var first_part_percentage = parseInt($('.first_part_percentage').val()) || 0;
	    var quote1_pricetopay = parseInt($('.quote1_pricetopay').val()) || 0;

	    // Calculate remaining percentage for the second part
	    var second_part_percentage = 100 - advance_payment_percentage - first_part_percentage;

	    if (second_part_percentage >= 0) {
	        $('.second_part_percentage').val(second_part_percentage); // Set percentage
	        var second_part_value = Math.round(second_part_percentage * quote1_pricetopay / 100); // Calculate value
	        $('.quote1_second_part').val(second_part_value); // Set value
	    } else {
	        $('.second_part_percentage').val(0); // Set to 0% if negative
	        $('.quote1_second_part').val(0); // Set value to 0 if negative
	    }
	    $('.quote1_second_part').attr('disabled', 'disabled'); // Ensure the second part is always disabled
	}*/



	// Event handler for "show_part_payment" checkbox change event
	$("#show_part_payment").change(function() {
    var isChecked = $(this).is(':checked'); // Check if the checkbox is checked
    var quote1_pricetopay = parseInt($('.quote1_pricetopay').val()) || 0; // Get the total price to pay

    if (isChecked) {
        $(".quote1_advance_payment").attr('readonly', ''); // Make the advance payment field readonly

        // Show all elements with the "part_payment" class and set their related fields
        jQuery('.part_payment').each(function() {
            $(this).css('display', 'block');
            $('.advance_payment_percentage').val(100); // Set advance payment percentage to 100%
            $('.quote1_advance_payment').val(quote1_pricetopay); // Set advance payment to the total price

            $('.first_part_percentage').val('').attr('disabled', 'disabled'); // Clear and disable first part percentage
            $('.quote1_first_part').val(0).attr('disabled', 'disabled'); // Set first part value to 0 and disable
            disableFirstPartFields(); // Disable first part date and days fields

            $('.second_part_percentage').val(0).attr('disabled', 'disabled'); // Keep second part percentage disabled
            $('.quote1_second_part').val(0); // Clear second part value
            disableSecondPartFields(); // Disable second part date and days fields

            $('.quote1_total_payment').val(quote1_pricetopay); // Set total payment to the total price
        });
    } else {
        // Hide part payment fields if the checkbox is unchecked
        jQuery('.part_payment').each(function() {
            $(this).css('display', 'none');
        });
    }
	});

	// Event handler for change event on advance payment percentage
	$(document).on("change", ".advance_payment_percentage", function() {
    var advance_payment_percentage = parseInt($(this).val()) || 0;
    var quote1_pricetopay = parseInt($('.quote1_pricetopay').val()) || 0;

    // Update the quote1_advance_payment value
    var advance_payment_value = Math.round(advance_payment_percentage * quote1_pricetopay / 100);
    $('.quote1_advance_payment').val(advance_payment_value);

    // Calculate remaining percentage
    var remaining_percentage = 100 - advance_payment_percentage;

    if (remaining_percentage > 0) {
        $('.first_part_percentage').removeAttr('disabled').val(remaining_percentage); // Enable first part percentage
        var first_part_value = Math.round(remaining_percentage * quote1_pricetopay / 100);
        $('.quote1_first_part').val(first_part_value); // Update first part value
        enableFirstPartFields(); // Enable first part fields (date and days)
    } else {
        $('.first_part_percentage').val('').attr('disabled', 'disabled'); // Reset to 0% and disable
        $('.quote1_first_part').val(0).attr('disabled', 'disabled'); // Reset to 0 and disable
        disableFirstPartFields(); // Disable first part fields (date and days)
    }

    // Automatically calculate second part
    calculateSecondPart();
	});

	// Event handler for changes in first part payment percentage
	$(document).on("change", ".first_part_percentage", function() {
    var advance_payment_percentage = parseInt($('.advance_payment_percentage').val()) || 0;
    var first_part_percentage = parseInt($(this).val()) || 0;
    var quote1_pricetopay = parseInt($('.quote1_pricetopay').val()) || 0;

    // Calculate remaining percentage for the second part
    var remaining_percentage = 100 - advance_payment_percentage - first_part_percentage;

    if (remaining_percentage < 0) {
        alert("Total percentage cannot exceed 100%");

        $(this).val(''); // Clear the input
        $('.quote1_first_part').val(0); // Reset first part value to 0
        
        // Update first part percentage to valid value
        var valid_first_part_percentage = 100 - advance_payment_percentage;
        $('.first_part_percentage').val(valid_first_part_percentage);
        $('.quote1_first_part').val(Math.round(valid_first_part_percentage * quote1_pricetopay / 100));
    } else {
        // Update first part payment value
        var first_part_value = Math.round(first_part_percentage * quote1_pricetopay / 100);
        $('.quote1_first_part').val(first_part_value);
    }

    // Automatically calculate and update second part
    calculateSecondPart();
	});

	function calculateSecondPart() {
    var advance_payment_percentage = parseInt($('.advance_payment_percentage').val()) || 0;
    var first_part_percentage = parseInt($('.first_part_percentage').val()) || 0;
    var quote1_pricetopay = parseInt($('.quote1_pricetopay').val()) || 0;

    var second_part_percentage = 100 - advance_payment_percentage - first_part_percentage;

    // Disable second_part_percentage input (always disabled)
    $('.second_part_percentage').attr('disabled', 'disabled');

    if (second_part_percentage > 0) {
        // If second part percentage is valid
        $('.second_part_percentage').val(second_part_percentage);

        var second_part_value = Math.round(second_part_percentage * quote1_pricetopay / 100);
        $('.quote1_second_part').val(second_part_value).removeAttr('disabled');
        
        $('.datepicker_second_payment').removeAttr('disabled');
    } else {
        // If second part percentage is invalid or 0
        $('.second_part_percentage').val(0);
        $('.quote1_second_part').val(0).attr('disabled', 'disabled');
        $('.datepicker_second_payment').val('').attr('disabled', 'disabled');
    }

    // Now check the reset condition for the first percentage
		if (first_part_percentage === 0) {
		    // Reset first payment days when the first percentage is reset
		    resetFirstPaymentDays();
		} else
		// Now check the reset condition for the second percentage
		if (second_part_percentage === 0) {
		    // Reset both payment days when the second percentage is reset
		    resetSecondPaymentDays();
		}
		// Or check the reset condition for both percentages
		if (first_part_percentage === 0 && second_part_percentage === 0) {
		    // Reset payment days only when both percentages are reset
		    resetFirstPaymentDays();
		    resetSecondPaymentDays();
		}
	}

	// Function to reset the payment days and hidden inputs
	function resetFirstPaymentDays() {
    // Reset the dropdown and hidden inputs to default state
    $('#first_part_days').val('');  // Reset the dropdown to "Pay within"
    $('#first_payment_days').val(''); // Clear the hidden input value
	}

	// Function to reset the payment days and hidden inputs
	function resetSecondPaymentDays() {
    // Reset the dropdown and hidden inputs to default state
    $('#second_part_days').val('');  // Reset the dropdown to "Pay within"
    $('#second_payment_days').val('');  // Clear the hidden input value
	}

	//--------

	// Functions to enable/disable first and second part fields
	function enableFirstPartFields() {
    $('#first_part_days').removeAttr('disabled'); // Enable days input
    $('.datepicker_first_payment').removeAttr('disabled'); // Enable datepicker
	}

	function disableFirstPartFields() {
    $('#first_part_days').val('').attr('disabled', 'disabled'); // Disable days input
    $('.datepicker_first_payment').val('').attr('disabled', 'disabled'); // Disable datepicker
	}

	function enableSecondPartFields() {
    $('#second_part_days').removeAttr('disabled'); // Enable days input
    $('.datepicker_second_payment').removeAttr('disabled'); // Enable datepicker
	}

	function disableSecondPartFields() {
    $('#second_part_days').val('').attr('disabled', 'disabled'); // Disable days input
    $('.datepicker_second_payment').val('').attr('disabled', 'disabled'); // Disable datepicker
	}

	//--------
	
	// pay at hotel
	jQuery("#show_direct_part").change(function () {
	    var ischecked = $(this).is(':checked');
	    if (ischecked) {
	       $(".direct_part").css('display', 'block');
	    } else {
	    	$(".direct_part").css('display', 'none');
	    }
	});
});

/*----------*//*----------*/

$(document).ready(function(){
// 	$('.datepicker_s').datepicker({
//      format: 'dd/mm/yyyy',
//     autoclose: true,
//     todayHighlight: true,
//     startDate: '0d'
// });
})

/*----------*//*----------*/

// fetch hotel details from package hotel database
$(document).ready(function() {
  // Event handler for change event on elements with class .propertysource
  $(document).on("change", ".propertysource", function() {
    var propertysource = $(this).val();
    var propertyname = $(this).parent().siblings(".propertyname");
    var selectproperty = $(this).parent().siblings(".selectproperty");

    if (propertysource == 'manual') {
    	$(this).parent().siblings(".selectpropertystar").css('display', 'none');
    	$(this).parent().siblings(".selectproperty").css('display', 'none');
    	$(this).parent().siblings(".propertyname").css('display', 'block');
    	$(this).parent().siblings(".selectpropertynamestar").css('display', 'block');
    } else if (propertysource == 'packagehoteldatabase') {
    	var city_name = $(this).parent().siblings(".quote_city_class").children(".quote_city").val();
    	var propertytype = $(this).parent().siblings(".propertytype_class").children(".form-group").children(".propertytype").val();
    	var hotel_class = $(this).parent().siblings().children(".quote_hotel");

    	// Fetch hotel name if the property source is 'packagehoteldatabase'
    	fetch_hotel_name(city_name, propertytype, hotel_class);

    	$(this).parent().siblings(".selectpropertystar").css('display', 'block');
    	$(this).parent().siblings(".selectproperty").css('display', 'block');
    	$(this).parent().siblings(".propertyname").css('display', 'none');
    	$(this).parent().siblings(".selectpropertynamestar").css('display', 'none');
    } else {
    	$(this).parent().siblings(".selectpropertystar").css('display', 'none');
    	$(this).parent().siblings(".selectproperty").css('display', 'none');
    	$(this).parent().siblings(".propertyname").css('display', 'none');
    	$(this).parent().siblings(".selectpropertynamestar").css('display', 'none');
    }
  });

  // Event handler for when the property type changes
  $(document).on("change", ".propertytype", function() {
  	// Retrieve the city name from the corresponding .quote_city input
  	var city_name = $(this).closest('.propertytype_class').siblings(".quote_city_class").children(".quote_city").val();

  	// Get the selected property type from the current dropdown
  	var propertytype = $(this).val();

  	// Find the corresponding .quote_hotel element within the same group
  	var hotel_class = $(this).closest('.propertytype_class').siblings().find(".quote_hotel");

  	// Get the selected property source from the corresponding .propertysource dropdown
  	var propertysource = $(this).closest('.propertytype_class').siblings(".propertysource_class").children(".propertysource").val();

  	// If the property source is 'packagehoteldatabase', fetch the hotel names
  	if (propertysource === 'packagehoteldatabase') {
  		fetch_hotel_name(city_name, propertytype, hotel_class);
  	}
  });

  // Initialize the .quote_city select2 dropdown with placeholder and AJAX settings
  $('.quote_city').select2({
  	placeholder: "To",
  	allowClear: true,
  	ajax: {
  		url: $("#APP_URL").val() + '/search_quote_destination', // URL to fetch destinations
  		type: "get", // HTTP method
  		dataType: 'json', // Data type expected from the server
  		delay: 250, // Delay in ms before making the AJAX call
  		data: function(params) {
  			return {
  				searchTerm: params.term // Pass the search term to the server
  			};
  		},

  		processResults: function(response) {
  			return {
  				results: response // Process and return the server response
  			};
  		},
  		cache: true // Cache the results
  	}
  });

    // Event handler for when the selected city changes
    $(document).on('change', '.quote_city', function() {
        // Retrieve the selected city name
        var city_name = $(this).val();

        // Get the selected property type from the corresponding dropdown
        var propertytype = $(this).closest('.quote_city_class').siblings(".propertytype_class")
            .find(".propertytype").val();

        // Find the corresponding .quote_hotel element within the same group
        var hotel_class = $(this).closest('.quote_city_class').siblings().find(".quote_hotel");

        // Get the selected property source from the corresponding .propertysource dropdown
        var propertysource = $(this).closest('.quote_city_class').siblings(".propertysource_class")
            .find(".propertysource").val();

        // If the property source is 'packagehoteldatabase', fetch the hotel names
        if (propertysource === 'packagehoteldatabase') {
            fetch_hotel_name(city_name, propertytype, hotel_class);
        }
    });

    // Function to fetch hotel names based on city name and property type
    function fetch_hotel_name(city_name, propertytype, hotel_class) {
        $.ajax({
            type: 'POST',
            data: { 
                city_name: city_name, 
                propertytype: propertytype 
            },
            url: APP_URL + "/quote_hotel_name", // URL to fetch hotel names
            success: function(data) {
                // Clear the hotel dropdown and populate it with the fetched data
                hotel_class.html("<option value='0' selected='true' disabled='disabled'>--Choose Hotel--</option>" + data);
            },
            error: function(xhr, status, error) {
                // Handle error if the AJAX request fails
                console.error("Error fetching hotel names:", status, error);
            }
        });
    }

    // Event handler for when the city selection changes
    $(document).on('change', '.quote_city', function() {
        var city_name = $(this).val();
        var propertytype = $(this).parent().siblings(".propertytype_class").children(".form-group").children(".propertytype").val();
        var hotel_class = $(this).parent().siblings().children(".quote_hotel");
        var propertysource = $(this).parent().siblings(".propertysource_class").children(".propertysource").val();

        if (propertysource === 'packagehoteldatabase') {
            fetch_hotel_name(city_name, propertytype, hotel_class);
        }
    });

    // Event handler for when the hotel selection changes
    $(document).on('change', '.quote_hotel', function() {
        var hotel_id = $(this).val();
        var button = $(this);

        $.ajax({
            type: 'POST',
            data: { 
                hotel_id: hotel_id 
            },
            url: APP_URL + "/quote_hotel_data", // URL to fetch hotel data
            success: function(data) {
                // Update the hotel link, contact, and star rating fields with the fetched data
                button.parent().siblings(".hotel_link_class").children(".hotel_link").val(data.link);
                button.parent().siblings(".hotel_contact_class").children(".hotel_contact").val(data.propertymobile);
                button.parent().siblings(".selectpropertystar").children(".selectpropertystar_value")
                    .html("<option selected='true'>" + data.star_rating + " Star</option>");
                
                // Optional: log the fetched data for debugging purposes
                console.log("Hotel data:", data);
            },
            error: function(xhr, status, error) {
                // Handle error if the AJAX request fails
                console.error("Error fetching hotel data:", status, error);
            }
        });
    });
});

/*----------*//*----------*/

// flight date and part payment date
$(document).ready(function() {
    // Initialize flight date calculations on document ready
    flight_date();

    // Handle changes to payment days dropdown
    $(".payment_days").change(function() {
        var days = $(this).val();
        var date = new Date();
        date.setDate(date.getDate() + parseInt(days));

        // Format the date to dd/mm/yyyy
        var dd = date.getDate();
        var mm = date.getMonth() + 1;
        var y = date.getFullYear();
        var formattedDate = dd + '/' + mm + '/' + y;

        // Update the payment date picker with the calculated date
        $(this).parent().siblings('.payment_date_parent')
            .children('.payment_date')
            .datepicker({ dateFormat: "dd/mm/yy" })
            .datepicker("setDate", formattedDate);
    });

    // Recalculate flight date on tour date change
    $(document).on("change", ".tour_date", function() {
        flight_date();
    });

    // Function to calculate and set flight dates and payment options
    function flight_date() {
        var tour_date = $(".tour_date").val();

        // Get today's date in yyyy-mm-dd format
        const today = new Date();
        const yyyy = today.getFullYear();
        let mm = today.getMonth() + 1; // Months start at 0
        let dd = today.getDate();

        if (dd < 10) dd = '0' + dd;
        if (mm < 10) mm = '0' + mm;

        const formattedToday = yyyy + '-' + mm + '-' + dd;

        // Calculate the difference in days between the tour date and today
        var date1 = new Date(formattedToday);
        var date2 = new Date(tour_date);
        var diffDays;

        if (date2 >= date1) {
            var diffTime = Math.abs(date2 - date1);
            diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            var start_date = parseInt(diffDays) - 2;
        } else {
            start_date = 0;
            diffDays = 0;
        }

        // Debugging output
        console.log('Tour Date:', tour_date);
        console.log('Difference in Days:', diffDays);

        // Set up the date pickers with the calculated ranges
        $('.datepicker_s').datepicker("destroy").datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            todayHighlight: true,
            startDate: '0d',
            endDate: "+" + diffDays + "d"
        });

        $('.departure_date').datepicker("destroy").datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            todayHighlight: true,
            startDate: "+" + start_date + "d",
            endDate: "+" + diffDays + "d"
        });

        var duration = $("input[name=duration]").val();
        var start_date_return = parseInt(diffDays) + 2;
        var end_date_return = parseInt(diffDays) + parseInt(duration);

        $('.return_date').datepicker("destroy").datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            todayHighlight: true,
            startDate: "+" + start_date_return + "d",
            endDate: "+" + end_date_return + "d"
        });

        /*// Populate the payment days dropdown with options
        var output = '<option value="">Pay within</option>';
        for (var i = 1; i <= diffDays; i++) {
            output += '<option value="' + i + '">' + i + ' Days</option>';
        }

        $(".payment_days").html(output);*/

        // Function to populate the payment days dropdown with options
				function populatePaymentDays(diffDays) {
			    var output = '<option value="">Pay within</option>';
			    for (var i = 1; i <= diffDays; i++) {
			        output += '<option value="' + i + '">' + i + ' Days</option>';
			    }
			    $('.payment_days').html(output);
			    
			    // Set up change event to update hidden input
			    $('.payment_days').on('change', function() {
			        var selectedValue = $(this).val();
			        $(this).closest('.payment_days_parent').find('.days_data').val(selectedValue);
			    });
				}

				// Example call to populate with a certain number of days
				populatePaymentDays(180); // Assuming 180 days difference


        // Set up new date pickers with the calculated ranges
        $('.datepicker_new').datepicker("destroy").datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            todayHighlight: true,
            startDate: '+1d',
            endDate: "+" + diffDays + "d"
        });

        $('.datepicker_adv').datepicker("destroy").datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            todayHighlight: true,
            startDate: '+1d',
            endDate: "+" + diffDays + "d"
        });

        // Function to calculate days between two dates for payment date pickers
        function return_days(class_name) {
            var end = new Date();
            end.setDate(end.getDate());

            var dd = end.getDate();
            var mm = end.getMonth() + 1;
            var y = end.getFullYear();
            var formattedEndDate = mm + '/' + dd + '/' + y;

            var new_val = $('.' + class_name).val().split('/');
            var new_start_date = parseInt(new_val[1]) + '/' + parseInt(new_val[0]) + '/' + parseInt(new_val[2]);

            var startDay = new Date(new_start_date);
            var endDay = new Date(formattedEndDate);

            var millisBetween = endDay.getTime() - startDay.getTime();
            var days = millisBetween / (1000 * 3600 * 24);
            return Math.round(Math.abs(days));
        }

        // Disable payment days dropdown by default
        $('.payment_days').prop('disabled', true);

        // Set up event listeners for payment date changes
        $(document).on("change", ".datepicker_adv", function() {
            datepicker_part_payment('datepicker_adv');
        });

        $(document).on("change", ".datepicker_first_payment", function() {
            datepicker_part_payment('datepicker_first_payment');
        });

        $(document).on("change", ".datepicker_second_payment", function() {
            datepicker_part_payment('datepicker_second_payment');
        });

        var datepicker_adv_val = $('.datepicker_adv').val();
        var datepicker_first_payment_val = $('.datepicker_first_payment').val();
        var datepicker_second_payment_val = $('.datepicker_second_payment').val();

        if (datepicker_adv_val != '' && datepicker_first_payment_val == '' && datepicker_second_payment_val == '') {
            // Only advance payment set
        } else if (datepicker_adv_val != '' && datepicker_first_payment_val != '' && datepicker_second_payment_val == '') {
            var first_payment_day = return_days('datepicker_first_payment');
            $('.datepicker_first_payment').datepicker("destroy").datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true,
                todayHighlight: true,
                startDate: "+" + first_payment_day + "d",
                endDate: "+" + diffDays + "d",
            });
        } else if (datepicker_adv_val != '' && datepicker_first_payment_val != '' && datepicker_second_payment_val != '') {
            var advance_day = return_days('datepicker_adv');
            var first_payment_day = return_days('datepicker_first_payment');
            var second_payment_day = return_days('datepicker_second_payment');

            $('.datepicker_first_payment').datepicker("destroy").datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true,
                todayHighlight: true,
                startDate: "+" + first_payment_day + "d",
                endDate: "+" + diffDays + "d",
            });

            $('.datepicker_second_payment').datepicker("destroy").datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true,
                todayHighlight: true,
                startDate: "+" + second_payment_day + "d",
                endDate: "+" + diffDays + "d",
            });
        }

        // Handle part payment date calculations
        function datepicker_part_payment(class_name) {
            var day = return_days(class_name);

            // Update payment days with calculated value
            $('.' + class_name).parent().siblings('.payment_days_parent')
                .children('.payment_days').val(day);
            $('.' + class_name).parent().siblings('.payment_days_parent')
                .children('.days_data').val(day);

            var cal_start_date = parseInt(day + 1);

            // Handle date picker settings based on the current part payment stage
            if (class_name == 'datepicker_adv') {
                var datepicker_first_payment = $(".datepicker_first_payment").val();
                if (datepicker_first_payment != '') {
                    var first_payment_day = return_days('datepicker_first_payment');
                    if (first_payment_day <= day) {
                        $(".datepicker_first_payment").val('');
                        $('.datepicker_first_payment').parent().siblings('.payment_days_parent')
                            .children('.payment_days').val('');
                        $(".datepicker_second_payment").val('');
                        $('.datepicker_second_payment').parent().siblings('.payment_days_parent')
                            .children('.payment_days').val('');
                    }
                }
                $('.datepicker_first_payment').datepicker("destroy").datepicker({
                    format: 'dd/mm/yyyy',
                    autoclose: true,
                    todayHighlight: true,
                    startDate: "+" + cal_start_date + "d",
                    endDate: "+" + diffDays + "d",
                });

                $('.datepicker_second_payment').datepicker("destroy");
            } else if (class_name == 'datepicker_first_payment') {
                var datepicker_second_payment = $(".datepicker_second_payment").val();
                if (datepicker_second_payment != '') {
                    var second_payment_day = return_days('datepicker_second_payment');
                    if (second_payment_day <= day) {
                        $(".datepicker_second_payment").val('');
                        $('.datepicker_second_payment').parent().siblings('.payment_days_parent')
                            .children('.payment_days').val('');
                    }
                }
                $('.datepicker_second_payment').datepicker("destroy").datepicker({
                    format: 'dd/mm/yyyy',
                    autoclose: true,
                    todayHighlight: true,
                    startDate: "+" + cal_start_date + "d",
                    endDate: "+" + diffDays + "d",
                });
            }
        }
    }
});

// flight section
$(document).ready(function() {
    // Alert the user to check the duration if the day plus field is changed for the departure flight
    $(document).on("change", ".adayplus", function() {
        alert('Kindly check duration');
    });

    // Calculate and update the flight duration when any of the departure or arrival time fields are changed
    $(document).on("change", ".dhours, .dmins, .ahours, .amins", function() {
        var dhours = $(".dhours").val();
        var dmins = $(".dmins").val();
        var ahours = $(".ahours").val();
        var amins = $(".amins").val();
        var adayplus = $(".adayplus").val();

        var departure_in_min = parseInt(dhours) * 60 + parseInt(dmins);
        var arrival_in_min = parseInt(ahours) * 60 + parseInt(amins);

        // Adjust arrival time if it is less than or equal to the departure time
        if (arrival_in_min <= departure_in_min) {
            arrival_in_min += parseInt(24) * 60; // Add 24 hours in minutes
            $('.adayplus').val('').val(1); // Set day plus to 1
        } else {
            $('.adayplus').val('').val(0); // Set day plus to 0
        }

        var duration_in_min = arrival_in_min - departure_in_min;
        var hours = Math.floor(duration_in_min / 60);
        var minutes = duration_in_min % 60;

        $('.duration_hours').val('').val(hours); // Update duration hours
        $('.duration_min').val('').val(minutes); // Update duration minutes
    });

    // Alert the user to check the duration if the day plus field is changed for the return flight
    $(document).on("change", ".dadayplus", function() {
        alert('Kindly check duration');
    });

    // Calculate and update the return flight duration when any of the departure or arrival time fields are changed
    $(document).on("change", ".ddhours, .ddmins, .dahours, .damins", function() {
        var dhours = $(".ddhours").val();
        var dmins = $(".ddmins").val();
        var ahours = $(".dahours").val();
        var amins = $(".damins").val();
        var adayplus = $(".dadayplus").val();

        var departure_in_min = parseInt(dhours) * 60 + parseInt(dmins);
        var arrival_in_min = parseInt(ahours) * 60 + parseInt(amins);

        // Adjust arrival time if it is less than or equal to the departure time
        if (arrival_in_min <= departure_in_min) {
            arrival_in_min += parseInt(24) * 60; // Add 24 hours in minutes
            $('.dadayplus').val('').val(1); // Set day plus to 1
        } else {
            $('.dadayplus').val('').val(0); // Set day plus to 0
        }

        var duration_in_min = arrival_in_min - departure_in_min;
        var hours = Math.floor(duration_in_min / 60);
        var minutes = duration_in_min % 60;

        $('.return_duration_hours').val('').val(hours); // Update return duration hours
        $('.return_duration_min').val('').val(minutes); // Update return duration minutes
    });

    // Synchronize flight name with the return flight name
    $(document).on("change", ".flight_name", function() {
        var flight_name = $(this).val();
        $(".down_filght").val('').val(flight_name); // Update return flight name
    });

    // Synchronize flight origin with the return flight destination
    $(document).on("change", ".origin", function() {
        var origin = $(this).val();
        $(".down_dest").val('').val(origin); // Update return flight destination
    });

    // Synchronize flight destination with the return flight origin
    $(document).on("change", ".dest", function() {
        var dest = $(this).val();
        $(".down_origin").val('').val(dest); // Update return flight origin
    });
});

// reset quote validity
$(document).ready(function(){
	// Function to validate time input in hh:mm:ss format (24-hour)
    function validateTime() {
        var timeInput = document.getElementById('timeInput');
        var pattern = /^(?:[01]\d|2[0-3]):[0-5]\d:[0-5]\d$/;

        if (!pattern.test(timeInput.value)) {
            alert('Please enter a valid time in the format hh:mm:ss (24-hour).');
            return false;
        }

        return true;
    }

    /*// Handle click event on reset button
    $(document).on("click", ".reset", function() {
        $(".validity_time").val('').val('23:59:59'); // Reset the validity time to '23:59:59'
        $(".reset_class").html(''); // Clear the reset button container
    });

    // Handle keyup or change event on validity_time input
    $(document).on("keyup change", ".validity_time", function() {
        var time = $(this).val();

        // Show or hide the reset button based on the validity time value
        if (time !== '23:59:59') {
            $(".reset_class").html('<button type="button" class="btn-time-reset">Reset</button>');
        } else {
            $(".reset_class").html('');
        }
    });*/

    // Handle click event on reset button
		$(document).on("click", ".btn-time-reset", function() {
		    // Reset the validity time to '23:59:59'
		    $(".validity_time").val('23:59:59');
		    
		    // Clear the reset button container
		    $(".btn-time-reset-cont").html('');
		});

		// Handle keyup or change event on validity_time input
		$(document).on("keyup change", ".validity_time", function() {
		    var time = $(this).val();

		    // Show or hide the reset button based on the validity time value
		    if (time !== '23:59:59') {
		        // If not default time, show the reset button
		        $(".btn-time-reset-cont").html('<button type="button" class="btn-time-reset">Reset</button>');
		    } else {
		        // If default time, remove the reset button
		        $(".btn-time-reset-cont").html('');
		    }
		});

});

/*----------*//*----------*/
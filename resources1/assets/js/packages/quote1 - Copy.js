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

//$(document).on("keyup change",".number_test",function() {
  //this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
//});

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
/*$(document).ready(function() {

	var pricemarkup=$(".pricemarkup").val();
	if(pricemarkup=='2') {
		$(".markup_percentage").css("display","block")
	} else {
		$(".markup_percentage").css("display","none")
	}
	$(".pricemarkup").change(function() {
		var pricemarkup=$(this).val();
		if(pricemarkup=='2') {
			$(".markup_percentage").css("display","block")
		} else {
			$(".markup_percentage").css("display","none")
		}
	})
	
	//
	var pricediscountpositive=$(".pricediscountpositive").val();
	if(pricediscountpositive=='2') {
		$(".discountpositive_percentage").css("display","block")
		} else {
			$(".discountpositive_percentage").css("display","none")
		}
		$(".pricediscountpositive").change(function() {
			var pricediscountpositive=$(this).val();
			if(pricediscountpositive=='2') {
				$(".discountpositive_percentage").css("display","block")
			} else {
				$(".discountpositive_percentage").css("display","none")
			}
			quote1_price('quote1_air_adult','quote1_cruise_adult','quote1_cruiseport_adult','quote1_cruisegratuity_adult','quote1_cruisegst_adult','quote1_hotel_adult','quote1_tours_adult','quote1_transfer_adult','quote1_visa_adult','quote1_inc_adult','quote1_meals_adult','quote1_additionalservice_adult','quote1_tourtotal_adult','quote1_tourtotal_exadult','quote1_tourtotal_childbed','quote1_tourtotal_childwbed','quote1_tourtotal_infant','quote1_tourtotal_single','pricemarkup','markup_percentage','quote1_markup_adult','quote1_markup_exadult','quote1_markup_childbed','quote1_markup_childwbed','quote1_markup_infant','quote1_markup_single','quote1_total_adult','quote1_discount_adult_plus','quote1_gross_total_adult','quote1_gross_total_exadult','quote1_gross_total_childbed','quote1_gross_total_childwbed','quote1_gross_total_infant','quote1_gross_total_single','quote1_gross_total_group','quote1_discount_adult_minus','quote1_discount_exadult_minus','quote1_discount_childbed_minus','quote1_discount_childwbed_minus','quote1_discount_infant_minus','quote1_discount_single_minus','pricegst','gst_percentage','quote1_gst_adult','quote1_gst_adult','quote1_gst_exadult','quote1_gst_childbed','quote1_gst_childwbed','quote1_gst_infant','quote1_gst_single','quote1_gst_group','quote1_gsttotal_adult','pricetcs','tcs_percentage','quote1_tcs_adult','quote1_tcs_exadult','quote1_tcs_childbed','quote1_tcs_childwbed','quote1_tcs_infant','quote1_tcs_single','quote1_tcs_group','quote1_tcstotal_adult','pricepgcharges','pgcharges_percentage','quote1_pgcharges_adult','quote1_pgcharges_exadult','quote1_pgcharges_childbed','quote1_pgcharges_childwbed','quote1_pgcharges_infant','quote1_pgcharges_single','quote1_pg_group','quote1_grand_adult','quote1_grand_adult_with_person','query_pricetopay','quote1_number_of_adult','quote1_number_of_extra_adult','quote1_number_of_child_with_bed','quote1_number_of_child_without_bed','quote1_number_of_infant','quote1_number_solo_traveller','quote1_grand_exadult_with_person','quote1_grand_childbed_with_person','quote1_grand_childwbed_with_person','quote1_grand_infant_with_person','quote1_grand_single_with_person','quote1_discount_group','quote1_gsttotal_exadult','quote1_gsttotal_childbed','quote1_gsttotal_childwbed','quote1_gsttotal_infant','quote1_gsttotal_single','quote1_tcstotal_exadult','quote1_tcstotal_childbed','quote1_tcstotal_childwbed','quote1_tcstotal_infant','quote1_tcstotal_single','quote1_air_exadult','quote1_cruise_exadult','quote1_cruiseport_exadult','quote1_cruisegratuity_exadult','quote1_cruisegst_exadult','quote1_hotel_exadult','quote1_tours_exadult','quote1_transfer_exadult','quote1_visa_exadult','quote1_inc_exadult','quote1_meals_exadult','quote1_additionalservice_exadult','quote1_discount_exadult_plus','quote1_grand_exadult','quote1_grand_childbed','quote1_grand_childwbed','quote1_grand_infant','quote1_grand_single','quote1_air_childbed','quote1_cruise_childbed','quote1_cruiseport_childbed','quote1_cruisegratuity_childbed','quote1_cruisegst_childbed','quote1_hotel_childbed','quote1_tours_childbed','quote1_transfer_childbed','quote1_visa_childbed','quote1_inc_childbed','quote1_meals_childbed','quote1_additionalservice_childbed','quote1_discount_childbed_plus','quote1_air_childwbed','quote1_cruise_childwbed','quote1_cruiseport_childwbed','quote1_cruisegratuity_childwbed','quote1_cruisegst_childwbed','quote1_hotel_childwbed','quote1_tours_childwbed','quote1_transfer_childwbed','quote1_visa_childwbed','quote1_inc_childwbed','quote1_meals_childwbed','quote1_additionalservice_childwbed','quote1_discount_childwbed_plus','quote1_air_infant','quote1_cruise_infant','quote1_cruiseport_infant','quote1_cruisegratuity_infant','quote1_cruisegst_infant','quote1_hotel_infant','quote1_tours_infant','quote1_transfer_infant','quote1_visa_infant','quote1_inc_infant','quote1_meals_infant','quote1_additionalservice_infant','quote1_discount_infant_plus','quote1_air_single','quote1_cruise_single','quote1_cruiseport_single','quote1_cruisegratuity_single','quote1_cruisegst_single','quote1_hotel_single','quote1_tours_single','quote1_transfer_single','quote1_visa_single','quote1_inc_single','quote1_meals_single','quote1_additionalservice_single','quote1_discount_single_plus','quote1_pricetopay','pricediscountpositive','discountpositive_percentage','pricediscountnegative','discountnegative_percentage','advance_payment','advance_payment_percentage','quote1_advance_payment','first_part_payment','first_part_percentage','quote1_first_part','second_part_payment','second_part_percentage','quote1_second_part','quote1_total_payment','show_part_payment','advance_payment_percentage','quote1_advance_payment','first_part_percentage','quote1_first_part','second_part_percentage','quote1_second_part','quote1_total_payment','coupon_percentage')
	})
	
	//
	var pricediscountnegative=$(".pricediscountnegative").val();
	if(pricediscountnegative=='2') {
		$(".discountnegative_percentage").css("display","block")
		$(".coupon_percentage").css("display","none")
	} else if(pricediscountnegative=='3') {
		$(".discountnegative_percentage").css("display","none")
		$(".coupon_percentage").css("display","block")
	} else {
			$(".discountnegative_percentage").css("display","none")
			$(".coupon_percentage").css("display","none")
		}

	$(".pricediscountnegative").change(function() {
		var pricediscountnegative=$(this).val();
		if(pricediscountnegative=='2') {
			$(".discountnegative_percentage").css("display","block")
			$(".coupon_percentage").css("display","none")
		} else if(pricediscountnegative=='3') {
	    $(".discountnegative_percentage").css("display","none")
			$(".coupon_percentage").css("display","block")
		} else {
			$(".discountnegative_percentage").css("display","none")
			$(".coupon_percentage").css("display","none")
		}
		quote1_price('quote1_air_adult','quote1_cruise_adult','quote1_cruiseport_adult','quote1_cruisegratuity_adult','quote1_cruisegst_adult','quote1_hotel_adult','quote1_tours_adult','quote1_transfer_adult','quote1_visa_adult','quote1_inc_adult','quote1_meals_adult','quote1_additionalservice_adult','quote1_tourtotal_adult','quote1_tourtotal_exadult','quote1_tourtotal_childbed','quote1_tourtotal_childwbed','quote1_tourtotal_infant','quote1_tourtotal_single','pricemarkup','markup_percentage','quote1_markup_adult','quote1_markup_exadult','quote1_markup_childbed','quote1_markup_childwbed','quote1_markup_infant','quote1_markup_single','quote1_total_adult','quote1_discount_adult_plus','quote1_gross_total_adult','quote1_gross_total_exadult','quote1_gross_total_childbed','quote1_gross_total_childwbed','quote1_gross_total_infant','quote1_gross_total_single','quote1_gross_total_group','quote1_discount_adult_minus','quote1_discount_exadult_minus','quote1_discount_childbed_minus','quote1_discount_childwbed_minus','quote1_discount_infant_minus','quote1_discount_single_minus','pricegst','gst_percentage','quote1_gst_adult','quote1_gst_adult','quote1_gst_exadult','quote1_gst_childbed','quote1_gst_childwbed','quote1_gst_infant','quote1_gst_single','quote1_gst_group','quote1_gsttotal_adult','pricetcs','tcs_percentage','quote1_tcs_adult','quote1_tcs_exadult','quote1_tcs_childbed','quote1_tcs_childwbed','quote1_tcs_infant','quote1_tcs_single','quote1_tcs_group','quote1_tcstotal_adult','pricepgcharges','pgcharges_percentage','quote1_pgcharges_adult','quote1_pgcharges_exadult','quote1_pgcharges_childbed','quote1_pgcharges_childwbed','quote1_pgcharges_infant','quote1_pgcharges_single','quote1_pg_group','quote1_grand_adult','quote1_grand_adult_with_person','query_pricetopay','quote1_number_of_adult','quote1_number_of_extra_adult','quote1_number_of_child_with_bed','quote1_number_of_child_without_bed','quote1_number_of_infant','quote1_number_solo_traveller','quote1_grand_exadult_with_person','quote1_grand_childbed_with_person','quote1_grand_childwbed_with_person','quote1_grand_infant_with_person','quote1_grand_single_with_person','quote1_discount_group','quote1_gsttotal_exadult','quote1_gsttotal_childbed','quote1_gsttotal_childwbed','quote1_gsttotal_infant','quote1_gsttotal_single','quote1_tcstotal_exadult','quote1_tcstotal_childbed','quote1_tcstotal_childwbed','quote1_tcstotal_infant','quote1_tcstotal_single','quote1_air_exadult','quote1_cruise_exadult','quote1_cruiseport_exadult','quote1_cruisegratuity_exadult','quote1_cruisegst_exadult','quote1_hotel_exadult','quote1_tours_exadult','quote1_transfer_exadult','quote1_visa_exadult','quote1_inc_exadult','quote1_meals_exadult','quote1_additionalservice_exadult','quote1_discount_exadult_plus','quote1_grand_exadult','quote1_grand_childbed','quote1_grand_childwbed','quote1_grand_infant','quote1_grand_single','quote1_air_childbed','quote1_cruise_childbed','quote1_cruiseport_childbed','quote1_cruisegratuity_childbed','quote1_cruisegst_childbed','quote1_hotel_childbed','quote1_tours_childbed','quote1_transfer_childbed','quote1_visa_childbed','quote1_inc_childbed','quote1_meals_childbed','quote1_additionalservice_childbed','quote1_discount_childbed_plus','quote1_air_childwbed','quote1_cruise_childwbed','quote1_cruiseport_childwbed','quote1_cruisegratuity_childwbed','quote1_cruisegst_childwbed','quote1_hotel_childwbed','quote1_tours_childwbed','quote1_transfer_childwbed','quote1_visa_childwbed','quote1_inc_childwbed','quote1_meals_childwbed','quote1_additionalservice_childwbed','quote1_discount_childwbed_plus','quote1_air_infant','quote1_cruise_infant','quote1_cruiseport_infant','quote1_cruisegratuity_infant','quote1_cruisegst_infant','quote1_hotel_infant','quote1_tours_infant','quote1_transfer_infant','quote1_visa_infant','quote1_inc_infant','quote1_meals_infant','quote1_additionalservice_infant','quote1_discount_infant_plus','quote1_air_single','quote1_cruise_single','quote1_cruiseport_single','quote1_cruisegratuity_single','quote1_cruisegst_single','quote1_hotel_single','quote1_tours_single','quote1_transfer_single','quote1_visa_single','quote1_inc_single','quote1_meals_single','quote1_additionalservice_single','quote1_discount_single_plus','quote1_pricetopay','pricediscountpositive','discountpositive_percentage','pricediscountnegative','discountnegative_percentage','advance_payment','advance_payment_percentage','quote1_advance_payment','first_part_payment','first_part_percentage','quote1_first_part','second_part_payment','second_part_percentage','quote1_second_part','quote1_total_payment','show_part_payment','advance_payment_percentage','quote1_advance_payment','first_part_percentage','quote1_first_part','second_part_percentage','quote1_second_part','quote1_total_payment','coupon_percentage')
	})

	//
	var pricegst=$(".pricegst").val();
	if(pricegst=='2') {
		$(".gst_percentage").css("display","block")
	} else {
		$(".gst_percentage").css("display","none")
	}
	
	$(".pricegst").change(function() {
		var pricegst=$(this).val();
		if(pricegst=='2') {
			$(".gst_percentage").css("display","block")
		} else {
			$(".gst_percentage").css("display","none")
		}
	})

	//
	var pricetcs=$(".pricetcs").val();
	if(pricetcs=='2') {
		$(".tcs_percentage").css("display","block")
	} else {
		$(".tcs_percentage").css("display","none")
	}

	$(".pricetcs").change(function() {
		var pricetcs=$(this).val();
		if(pricetcs=='2') {
			$(".tcs_percentage").css("display","block")
		} else {
			$(".tcs_percentage").css("display","none")
		}
	})

	//
	var pricepgcharges=$(".pricepgcharges").val();
	if(pricepgcharges=='2') {
		$(".pgcharges_percentage").css("display","block")
		} else {
			$(".pgcharges_percentage").css("display","none")
		}

	$(".pricepgcharges").change(function() {
		var pricepgcharges=$(this).val();
		if(pricepgcharges=='2') {
		$(".pgcharges_percentage").css("display","block")
		} else {
			$(".pgcharges_percentage").css("display","none")
		}
	})

	//
	var advance_payment=$(".advance_payment").val();
	if(advance_payment=='2') {
		$(".advance_payment_percentage").css("display","block")
	} else {
		$(".advance_payment_percentage").css("display","none")
	}

	$(".advance_payment").change(function() {
		var advance_payment=$(this).val();
		if(advance_payment=='2') {
		$(".advance_payment_percentage").css("display","block")
		} else {
			$(".advance_payment_percentage").css("display","none")
		}
	})

	//
	var first_part_payment=$(".first_part_payment").val();
	if(first_part_payment=='2') {
		$(".first_part_percentage").css("display","block")
		} else {
			$(".first_part_percentage").css("display","none")
		}

	$(".first_part_payment").change(function(){
		var first_part_payment=$(this).val();
		if(first_part_payment=='2') {
		$(".first_part_percentage").css("display","block")
		} else {
			$(".first_part_percentage").css("display","none")
		}
	})

	//
	var second_part_payment=$(".second_part_payment").val();
	if(second_part_payment=='2') {
		$(".second_part_percentage").css("display","block")
	} else {
		$(".second_part_percentage").css("display","none")
	}

	$(".second_part_payment").change(function(){
		var second_part_payment=$(this).val();
		if(second_part_payment=='2') {
		$(".second_part_percentage").css("display","block")
		} else {
			$(".second_part_percentage").css("display","none")
		}
	})

	//
});*/

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

/*// disable the price field based upon the guest value
$(document).ready(function() {

		// Function to call price calculation
    function callPriceCalculation() {
        quote1_price('quote1_air_adult','quote1_cruise_adult','quote1_cruiseport_adult','quote1_cruisegratuity_adult','quote1_cruisegst_adult','quote1_hotel_adult','quote1_tours_adult','quote1_transfer_adult','quote1_visa_adult','quote1_inc_adult','quote1_meals_adult','quote1_additionalservice_adult','quote1_tourtotal_adult','quote1_tourtotal_exadult','quote1_tourtotal_childbed','quote1_tourtotal_childwbed','quote1_tourtotal_infant','quote1_tourtotal_single','pricemarkup','markup_percentage','quote1_markup_adult','quote1_markup_exadult','quote1_markup_childbed','quote1_markup_childwbed','quote1_markup_infant','quote1_markup_single','quote1_total_adult','quote1_discount_adult_plus','quote1_gross_total_adult','quote1_gross_total_exadult','quote1_gross_total_childbed','quote1_gross_total_childwbed','quote1_gross_total_infant','quote1_gross_total_single','quote1_gross_total_group','quote1_discount_adult_minus','quote1_discount_exadult_minus','quote1_discount_childbed_minus','quote1_discount_childwbed_minus','quote1_discount_infant_minus','quote1_discount_single_minus','pricegst','gst_percentage','quote1_gst_adult','quote1_gst_adult','quote1_gst_exadult','quote1_gst_childbed','quote1_gst_childwbed','quote1_gst_infant','quote1_gst_single','quote1_gst_group','quote1_gsttotal_adult','pricetcs','tcs_percentage','quote1_tcs_adult','quote1_tcs_exadult','quote1_tcs_childbed','quote1_tcs_childwbed','quote1_tcs_infant','quote1_tcs_single','quote1_tcs_group','quote1_tcstotal_adult','pricepgcharges','pgcharges_percentage','quote1_pgcharges_adult','quote1_pgcharges_exadult','quote1_pgcharges_childbed','quote1_pgcharges_childwbed','quote1_pgcharges_infant','quote1_pgcharges_single','quote1_pg_group','quote1_grand_adult','quote1_grand_adult_with_person','query_pricetopay','quote1_number_of_adult','quote1_number_of_extra_adult','quote1_number_of_child_with_bed','quote1_number_of_child_without_bed','quote1_number_of_infant','quote1_number_solo_traveller','quote1_grand_exadult_with_person','quote1_grand_childbed_with_person','quote1_grand_childwbed_with_person','quote1_grand_infant_with_person','quote1_grand_single_with_person','quote1_discount_group','quote1_gsttotal_exadult','quote1_gsttotal_childbed','quote1_gsttotal_childwbed','quote1_gsttotal_infant','quote1_gsttotal_single','quote1_tcstotal_exadult','quote1_tcstotal_childbed','quote1_tcstotal_childwbed','quote1_tcstotal_infant','quote1_tcstotal_single','quote1_air_exadult','quote1_cruise_exadult','quote1_cruiseport_exadult','quote1_cruisegratuity_exadult','quote1_cruisegst_exadult','quote1_hotel_exadult','quote1_tours_exadult','quote1_transfer_exadult','quote1_visa_exadult','quote1_inc_exadult','quote1_meals_exadult','quote1_additionalservice_exadult','quote1_discount_exadult_plus','quote1_grand_exadult','quote1_grand_childbed','quote1_grand_childwbed','quote1_grand_infant','quote1_grand_single','quote1_air_childbed','quote1_cruise_childbed','quote1_cruiseport_childbed','quote1_cruisegratuity_childbed','quote1_cruisegst_childbed','quote1_hotel_childbed','quote1_tours_childbed','quote1_transfer_childbed','quote1_visa_childbed','quote1_inc_childbed','quote1_meals_childbed','quote1_additionalservice_childbed','quote1_discount_childbed_plus','quote1_air_childwbed','quote1_cruise_childwbed','quote1_cruiseport_childwbed','quote1_cruisegratuity_childwbed','quote1_cruisegst_childwbed','quote1_hotel_childwbed','quote1_tours_childwbed','quote1_transfer_childwbed','quote1_visa_childwbed','quote1_inc_childwbed','quote1_meals_childwbed','quote1_additionalservice_childwbed','quote1_discount_childwbed_plus','quote1_air_infant','quote1_cruise_infant','quote1_cruiseport_infant','quote1_cruisegratuity_infant','quote1_cruisegst_infant','quote1_hotel_infant','quote1_tours_infant','quote1_transfer_infant','quote1_visa_infant','quote1_inc_infant','quote1_meals_infant','quote1_additionalservice_infant','quote1_discount_infant_plus','quote1_air_single','quote1_cruise_single','quote1_cruiseport_single','quote1_cruisegratuity_single','quote1_cruisegst_single','quote1_hotel_single','quote1_tours_single','quote1_transfer_single','quote1_visa_single','quote1_inc_single','quote1_meals_single','quote1_additionalservice_single','quote1_discount_single_plus','quote1_pricetopay','pricediscountpositive','discountpositive_percentage','pricediscountnegative','discountnegative_percentage','advance_payment','advance_payment_percentage','quote1_advance_payment','first_part_payment','first_part_percentage','quote1_first_part','second_part_payment','second_part_percentage','quote1_second_part','quote1_total_payment','show_part_payment','advance_payment_percentage','quote1_advance_payment','first_part_percentage','quote1_first_part','second_part_percentage','quote1_second_part','quote1_total_payment','coupon_percentage')
    }


		$(document).on("click",".quote1_adult_room_inc",function() {
		var span_value_adult=$(this).siblings(".quote1_adult_room_value").val();
		$(this).siblings(".quote1_adult_room_result").html("").html(Math.round(span_value_adult) + 1)
		$(this).siblings(".quote1_adult_room_value").val("").val(Math.round(span_value_adult) + 1)

		//
		callPriceCalculation();
		
		//
		$(".adult_disable").each(function() {
			$(this).removeAttr('readonly','')
		});
	})

	$(document).on("click",".quote1_adult_room_dec",function() {
		var span_value_adult=$(this).siblings(".quote1_adult_room_value").val();
		var span_value_solo_adult=$(this).parent().parent().siblings(":last").children().children(".quote1_solo_value").val()
		if(span_value_solo_adult>=1) {
			if(span_value_adult>0) {
				$(this).siblings(".quote1_adult_room_result").html("").html(Math.round(span_value_adult) - 1)
				$(this).siblings(".quote1_adult_room_value").val("").val(Math.round(span_value_adult) - 1)
				//
				callPriceCalculation();
				//
				if($(this).siblings(".quote1_adult_room_value").val()==0) {
					$(".adult_disable").each(function() {
						$(this).val('')
						$(this).attr('readonly','')
						});
					}
			} else {
				alert('This cannot be negative')
				return false
				}
			} else {
				if(span_value_adult>1) {
					$(this).siblings(".quote1_adult_room_result").html("").html(Math.round(span_value_adult) - 1)
					$(this).siblings(".quote1_adult_room_value").val("").val(Math.round(span_value_adult) - 1)
					//
					callPriceCalculation();
					//
					if($(this).siblings(".quote1_adult_room_value").val()==0) {
						$(".adult_disable").each(function() {
							$(this).val('')
							$(this).attr('readonly','')
							});
						}
					} else {
						alert('This cannot be 0')
						return false
					}
				}
	})

	$(document).on("click",".quote1_child_extra_adult_inc",function() {
		var span_value_adult=$(this).siblings(".quote1_child_extra_adult_value").val();
	  $(this).siblings(".quote1_child_extra_adult_result").html("").html(Math.round(span_value_adult) + 1)
	    $(this).siblings(".quote1_child_extra_adult_value").val("").val(Math.round(span_value_adult) + 1)
	    $(".exadult_disable").each(function() {
	    	$(this).removeAttr('readonly','')
	    });
	         //
	callPriceCalculation();
	})

	$(document).on("click",".quote1_child_extra_adult_dec",function() {
		var span_value_adult=$(this).siblings(".quote1_child_extra_adult_value").val();
		if(span_value_adult>0) {
			$(this).siblings(".quote1_child_extra_adult_result").html("").html(Math.round(span_value_adult) - 1)
	    $(this).siblings(".quote1_child_extra_adult_value").val("").val(Math.round(span_value_adult) - 1)
		  if($(this).siblings(".quote1_child_extra_adult_value").val()==0) {
				$(".exadult_disable").each(function() {
			  $(this).val('')
		    $(this).attr('readonly','')
		    });
			}
	    //
	    callPriceCalculation();
			} else {
				alert('This cannot be negative')
				return false
			}
		})

	$(document).on("click",".quote1_child_with_bed_inc",function() {
		var span_value_adult=$(this).siblings(".quote1_child_with_bed_value").val();
	  $(this).siblings(".quote1_child_with_bed_result").html("").html(Math.round(span_value_adult) + 1)
	    $(this).siblings(".quote1_child_with_bed_value").val("").val(Math.round(span_value_adult) + 1)
	    $(".childbed_disable").each(function() {
	  $(this).removeAttr('readonly','')
	});
	//
	callPriceCalculation();
	})

	$(document).on("click",".quote1_child_with_bed_dec",function() {
		var span_value_adult=$(this).siblings(".quote1_child_with_bed_value").val();
		if(span_value_adult>0) {
			$(this).siblings(".quote1_child_with_bed_result").html("").html(Math.round(span_value_adult) - 1)
	    $(this).siblings(".quote1_child_with_bed_value").val("").val(Math.round(span_value_adult) - 1)
	    if($(this).siblings(".quote1_child_with_bed_value").val()==0) {
				$(".childbed_disable").each(function() {
			  $(this).val('')
		    $(this).attr('readonly','')
		    });
			}
			//
			callPriceCalculation();
			} else {
				alert('This cannot be negative')
				return false
			}
	})

	$(document).on("click",".quote1_childwithoutbed_inc",function() {
		var span_value_adult=$(this).siblings(".quote1_childwithoutbed_value").val();
	  $(this).siblings(".quote1_span_value_childwithoutbed_result").html("").html(Math.round(span_value_adult) + 1)
	    $(this).siblings(".quote1_childwithoutbed_value").val("").val(Math.round(span_value_adult) + 1)
	    $(".childwbed_disable").each(function() {
	  $(this).removeAttr('readonly','')
	});
	//
	callPriceCalculation();
	})

	$(document).on("click",".quote1_childwithoutbed_dec",function() {
		var span_value_adult=$(this).siblings(".quote1_childwithoutbed_value").val();
		if(span_value_adult>0) {
			$(this).siblings(".quote1_span_value_childwithoutbed_result").html("").html(Math.round(span_value_adult) - 1)
	    $(this).siblings(".quote1_childwithoutbed_value").val("").val(Math.round(span_value_adult) - 1)
	    if($(this).siblings(".quote1_childwithoutbed_value").val()==0) {
				$(".childwbed_disable").each(function() {
			  $(this).val('')
		    $(this).attr('readonly','')
	    });
		}
		//
	callPriceCalculation();
		} else {
			alert('This cannot be negative')
			return false
		}
	})

	$(document).on("click",".quote1_infant_inc",function() {
		var span_value_adult=$(this).siblings(".quote1_infant_value").val();
	  $(this).siblings(".quote1_infant_result").html("").html(Math.round(span_value_adult) + 1)
	  $(this).siblings(".quote1_infant_value").val("").val(Math.round(span_value_adult) + 1)
	  $(".infant_disable").each(function() {
	  	$(this).removeAttr('readonly','')
	  });
	  //
	  callPriceCalculation();
	})

	$(document).on("click",".quote1_infant_dec",function() {
		var span_value_adult=$(this).siblings(".quote1_infant_value").val();
		if(span_value_adult>0) {
			$(this).siblings(".quote1_infant_result").html("").html(Math.round(span_value_adult) - 1)
	    $(this).siblings(".quote1_infant_value").val("").val(Math.round(span_value_adult) - 1)
	    if($(this).siblings(".quote1_infant_value").val()==0) {
				$(".infant_disable").each(function() {
			  $(this).val('')
		    $(this).attr('readonly','')
	    });
		}
		//
		callPriceCalculation();
		} else {
			alert('This cannot be negative')
			return false
		}
	})

	$(document).on("click",".quote1_solo_inc",function() {
		var span_value_adult=$(this).siblings(".quote1_solo_value").val();
	  $(this).siblings(".quote1_solo_result").html("").html(Math.round(span_value_adult) + 1)
	  $(this).siblings(".quote1_solo_value").val("").val(Math.round(span_value_adult) + 1)
	  $(".single_disable").each(function() {
	  	$(this).removeAttr('readonly','')
	});
	//
	callPriceCalculation();
	})

	$(document).on("click",".quote1_solo_dec",function() {
		var span_value_adult=$(this).siblings(".quote1_solo_value").val();
		var span_value_twin_adult=$(this).parent().parent().siblings('.minwidth135').children().children('.quote1_adult_room_value').val()
		if(span_value_twin_adult>=1) {
			if(span_value_adult>0) {
			$(this).siblings(".quote1_solo_result").html("").html(Math.round(span_value_adult) - 1)
	    $(this).siblings(".quote1_solo_value").val("").val(Math.round(span_value_adult) - 1)
	    if($(this).siblings(".quote1_solo_value").val()==0) {
	    	$(".single_disable").each(function() {
		  	$(this).val('')
	    	$(this).attr('readonly','')
	    });
		}

	callPriceCalculation();
	} else {
		alert('This cannot be negative')
		return false
	}
	} else {
		if(span_value_adult>1) {
			$(this).siblings(".quote1_solo_result").html("").html(Math.round(span_value_adult) - 1)
	    $(this).siblings(".quote1_solo_value").val("").val(Math.round(span_value_adult) - 1)
	    if($(this).siblings(".quote1_solo_value").val()==0) {
				$(".single_disable").each(function() {
				  $(this).val('')
			    $(this).attr('readonly','')
		    });
			}
			//
			callPriceCalculation();
			} else {
				alert('This cannot be 0')
				return false
			}
		}
	})

		//quote1_number_of_child_without_bed 
		var quote1_number_of_child_without_bed=$(".quote1_number_of_child_without_bed").val()
		if(quote1_number_of_child_without_bed==0) {
			$(".childwbed_disable").each(function() {
			$(this).val('')
		  $(this).attr('readonly','')
		});
		} else {
		}

		// extra adult disable
		var quote1_number_of_extra_adult=$(".quote1_number_of_extra_adult").val()
		if(quote1_number_of_extra_adult==0) {
			$(".exadult_disable").each(function() {
			$(this).val('')
		  $(this).attr('readonly','')
		});
		} else {
		}

		//childbed_disable
		var quote1_number_of_child_with_bed=$(".quote1_number_of_child_with_bed").val()
		if(quote1_number_of_child_with_bed==0) {
			$(".childbed_disable").each(function() {
				$(this).val('')
				$(this).attr('readonly','')
			});
		} else {
		}

		//childbed_disable
		var quote1_number_of_infant=$(".quote1_number_of_infant").val()
		if(quote1_number_of_infant==0) {
			$(".infant_disable").each(function() {
				$(this).val('')
				$(this).attr('readonly','')
			});
		} else {
		}

		// solo traveller disable
		var quote1_number_solo_traveller=$(".quote1_number_solo_traveller").val()
		if(quote1_number_solo_traveller==0) {
			$(".single_disable").each(function() {
				$(this).val('')
				$(this).attr('readonly','')
			});
		} else {
		}
})*/

// disable the price field based upon the guest value
$(document).ready(function() {

    // Function to call price calculation
    function callPriceCalculation() {
        // Call the price calculation function        
    		//quote1_price(/*pass the relevant data*/);
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
/*$(document).on("change click",".supplier",function(){
	var id=$(this).attr("id")
	var supplier_id=$(this).val()
	var inner_html=$('option:selected', this).attr('select_name')
  var input_val=$(this).siblings('input').val()
	// console.log(inner_html)
	if(supplier_id!='0') {
		var html = '<label for="">'+inner_html+' Remarks</label><input type="text" id="supplier_remarks'+id+'"  class="form-control" placeholder="Enter Remarks" value="'+input_val+'">';
		$(".supplier_remarks").attr('supplier_remarks_id','supplier_remarks'+id)
		$(".supplier_remarks").attr('supplier_attr',id)
		$("#supplier_body").html("").html(html)
		$('#supplier').modal('show');
	}
})

$(document).on("click",".supplier_remarks",function(){
	var supplier_remarks_id=$(this).attr('supplier_remarks_id')
	var supplier_attr=$(this).attr('supplier_attr')
	var remarks_value=$("#"+supplier_remarks_id).val()
	$("#remarks_"+supplier_attr).val("").val(remarks_value)
	$('#supplier').modal('hide');
})*/

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
/*$(document).on("keyup change",".quote1_rate",function(){
   var quote1_rate=$(".quote1_rate").val()
   var quote1_value=$(".quote1_value").val()
   $(".quote1_total").val("").val(quote1_rate*quote1_value)
})
$(document).on("keyup change",".quote1_value",function(){
   var quote1_rate=$(".quote1_rate").val()
   var quote1_value=$(".quote1_value").val()
   $(".quote1_total").val("").val(quote1_rate*quote1_value)
})*/

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

/*$(document).on("click","#add_certification",function(e){
	e.preventDefault()
  var select_room=$(".select_room").val()
	var name_count1=$(".dynamic_four").children("div:last").attr("id").slice(7)
	console.log(name_count1)
	var name_count=Math.round(name_count1)-"1";
	name_count1++
	name_count++
	var total_div=$(".dynamic_four").children("div").length
	if(total_div<select_room) {
		$(".dynamic_four").append('<div id="fourrow'+name_count1+'"><div class="row"><div class="appendBottom5"><div class="border-bottom1 padding-top10"><label for="room" class="pfwmt appendBottom5 font-size14" style="color: #000001 !important">Room '+name_count1+' </label><label for="roomnumber fontWeight600">(Max No of passenger) <span class="requiredcolor">*</span></label><select class="max_passenger" name="room['+name_count+'][max_passenger]"><option value="1" >1</option><option value="2" >2</option><option value="3" >3</option><option value="4" >4</option><option value="5" >5</option><option value="6" >6</option><option value="7" selected>7</option><option value="8" >8</option><option value="9" >9</option><option value="10" >10</option></select><div class="flexBetween"><div><div class="addTravellerValue"><input type="hidden" id="travellers" name="room['+name_count+'][twin_adult_room]" class="twin_adult_room_value" value="2" /><span class="travellersMinus twin_adult_room_dec">&#8722;</span><span class="travellersValue twin_adult_room_result">2</span><span class="travellersPlus twin_adult_room_inc">&#43;</span></div><p class="itemBottomHeading">Adult (Twin Sharing +12yrs)</p></div><div><div class="addTravellerValue"><input type="hidden" id="travellers" name="room['+name_count+'][extra_adult_room]" class="extra_adult_room_value" value="0" /><span class="travellersMinus extra_adult_room_dec">&#8722;</span><span class="travellersValue extra_adult_room_result">0</span><span class="travellersPlus extra_adult_room_inc">&#43;</span></div><p class="itemBottomHeading">Extra Adult (+12yrs)</p></div><div><div class="addTravellerValue"><input type="hidden" id="travellers" name="room['+name_count+'][child_with_bed_room]" class="child_with_bed_room_value" value="0" /><span class="travellersMinus child_with_bed_room_dec">&#8722;</span><span class="travellersValue child_with_bed_room_result">0</span><span class="travellersPlus child_with_bed_room_inc">&#43;</span></div><p class="itemBottomHeading">Child (With Bed 2-12yrs)</p></div><div><div class="addTravellerValue"><input type="hidden" id="travellers" name="room['+name_count+'][child_without_bed_room]" class="child_without_bed_room_value" value="0" /><span class="travellersMinus child_without_bed_room_dec">&#8722;</span><span class="travellersValue child_without_bed_room_result">0</span><span class="travellersPlus child_without_bed_room_inc">&#43;</span></div><p class="itemBottomHeading">Child (without bed 2-12yrs)</p></div><div><div class="addTravellerValue"><input type="hidden" id="travellers" name="room['+name_count+'][infant_room]" class="span_value_child_with_bed infant_room_value" value="0"><span class="travellersMinus infant_room_dec">&#8722;</span><span class="travellersValue infant_room_result">0</span><span class="travellersPlus infant_room_inc">&#43;</span></div><p class="itemBottomHeading">Infant (0-2yrs)</p></div><div><div class="addTravellerValue"><input type="hidden" id="travellers" name="room['+name_count+'][single_room]" class="single_room_value" value="0"><span class="travellersMinus single_room_dec">&#8722;</span><span class="travellersValue single_room_result">0</span><span class="travellersPlus single_room_inc">&#43;</span></div><p class="itemBottomHeading">Single (+12yrs)</p></div><div class="text-center"><p style="visibility: hidden;">Test</p><button type="button" name="remove" id="'+name_count1+'" class="btn btn-danger btn_remove_four"><span class="fa fa-minus"></span> x Remove</button></div> </div></div></div></div></div>');
		} else {
		alert('Increase no of rooms to add rooms further')
		}
	get_sum_passenger()
	get_seperate_passenger()
})*/

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
		            '<div class="guest-room-wrapper">' +
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

/*// adult (incrementing)
$(document).on("click",".twin_adult_room_inc",function(){
	var span_value_adult=$(this).siblings(".twin_adult_room_value").val();
	var passenger=no_of_traveller_check($(this));
	var total_allowed=$(this).parent().parent().parent().siblings(".max_passenger").val();
  if(passenger<total_allowed)
  {
  	$(this).siblings(".twin_adult_room_result").html("").html(Math.round(span_value_adult) + 1)
    $(this).siblings(".twin_adult_room_value").val("").val(Math.round(span_value_adult) + 1)
  }
  else
  {
  	alert('passenger cannot be greater that '+total_allowed)
  }
 get_sum_passenger()
 get_seperate_passenger()
})

// adult (decrementing)
$(document).on("click",".twin_adult_room_dec",function(){
	var span_value_adult=$(this).siblings(".twin_adult_room_value").val();
	var span_value_solo_adult=$(this).parent().parent().siblings(":nth-child(6)").children().children(".single_room_value").val()
	if(span_value_solo_adult>=1) 
	{
		if(span_value_adult>0)
	{
		$(this).siblings(".twin_adult_room_result").html("").html(Math.round(span_value_adult) - 1)
    $(this).siblings(".twin_adult_room_value").val("").val(Math.round(span_value_adult) - 1)
	}
	else
	{
		alert('This cannot be negative')
		return false
	}

	}
		else
		{
	if(span_value_adult>1)
	{
		$(this).siblings(".twin_adult_room_result").html("").html(Math.round(span_value_adult) - 1)
    $(this).siblings(".twin_adult_room_value").val("").val(Math.round(span_value_adult) - 1)
	}
	else
	{
		alert('This cannot be 0')
		return false
	}
		}
	
	get_sum_passenger()
  get_seperate_passenger()
})

// extra adult (incrementing)
$(document).on("click",".extra_adult_room_inc",function(){
		var passenger=no_of_traveller_check($(this));
		var total_allowed=$(this).parent().parent().parent().siblings(".max_passenger").val();
  if(passenger<total_allowed)
  {
	var span_value_adult=$(this).siblings(".extra_adult_room_value").val();
  $(this).siblings(".extra_adult_room_result").html("").html(Math.round(span_value_adult) + 1)
    $(this).siblings(".extra_adult_room_value").val("").val(Math.round(span_value_adult) + 1)
    }
  else
  {
  	alert('passenger cannot be greater that '+total_allowed)
  }
  get_sum_passenger()
  get_seperate_passenger()
})

// extra adult (decrementing)
$(document).on("click",".extra_adult_room_dec",function(){
	var span_value_adult=$(this).siblings(".extra_adult_room_value").val();
	if(span_value_adult>0)
	{
		$(this).siblings(".extra_adult_room_result").html("").html(Math.round(span_value_adult) - 1)
    $(this).siblings(".extra_adult_room_value").val("").val(Math.round(span_value_adult) - 1)
	}
	else
	{
		alert('This cannot be negative')
		return false
	}
	get_sum_passenger()
  get_seperate_passenger()
})

// child with bed (incrementing)
$(document).on("click",".child_with_bed_room_inc",function(){
		var passenger=no_of_traveller_check($(this));
		var total_allowed=$(this).parent().parent().parent().siblings(".max_passenger").val();
  if(passenger<total_allowed)
  {
	var span_value_adult=$(this).siblings(".child_with_bed_room_value").val();
  $(this).siblings(".child_with_bed_room_result").html("").html(Math.round(span_value_adult) + 1)
    $(this).siblings(".child_with_bed_room_value").val("").val(Math.round(span_value_adult) + 1)
    }
  else
  {
  	alert('passenger cannot be greater that '+total_allowed)
  }
  get_sum_passenger()
  get_seperate_passenger()
})

// child wiht bed (decrementing)
$(document).on("click",".child_with_bed_room_dec",function(){
	var span_value_adult=$(this).siblings(".child_with_bed_room_value").val();
	if(span_value_adult>0)
	{
		$(this).siblings(".child_with_bed_room_result").html("").html(Math.round(span_value_adult) - 1)
    $(this).siblings(".child_with_bed_room_value").val("").val(Math.round(span_value_adult) - 1)
	}
	else
	{
		alert('This cannot be negative')
		return false
	}
	get_sum_passenger()
  get_seperate_passenger()
})

// child without bed (incrementing)
$(document).on("click",".child_without_bed_room_inc",function(){
		var passenger=no_of_traveller_check($(this));
		var total_allowed=$(this).parent().parent().parent().siblings(".max_passenger").val();
  if(passenger<total_allowed)
  {
	var span_value_adult=$(this).siblings(".child_without_bed_room_value").val();
  $(this).siblings(".child_without_bed_room_result").html("").html(Math.round(span_value_adult) + 1)
    $(this).siblings(".child_without_bed_room_value").val("").val(Math.round(span_value_adult) + 1)
    }
  else
  {
  	alert('passenger cannot be greater that '+total_allowed)
  }
  get_sum_passenger()
  get_seperate_passenger()
})

// child without bed (decrementing)
$(document).on("click",".child_without_bed_room_dec",function(){
	var span_value_adult=$(this).siblings(".child_without_bed_room_value").val();
	if(span_value_adult>0)
	{
		$(this).siblings(".child_without_bed_room_result").html("").html(Math.round(span_value_adult) - 1)
    $(this).siblings(".child_without_bed_room_value").val("").val(Math.round(span_value_adult) - 1)
	}
	else
	{
		alert('This cannot be negative')
		return false
	}
	get_sum_passenger()
  get_seperate_passenger()
})

// infant (incrementing)
$(document).on("click",".infant_room_inc",function(){
		var passenger=no_of_traveller_check($(this));
		var total_allowed=$(this).parent().parent().parent().siblings(".max_passenger").val();
  if(passenger<total_allowed)
  {
	var span_value_adult=$(this).siblings(".infant_room_value").val();
  $(this).siblings(".infant_room_result").html("").html(Math.round(span_value_adult) + 1)
    $(this).siblings(".infant_room_value").val("").val(Math.round(span_value_adult) + 1)
    }
  else
  {
  	alert('passenger cannot be greater that '+total_allowed)
  }
  get_sum_passenger()
  get_seperate_passenger()
})

// infant (decrementing)
$(document).on("click",".infant_room_dec",function(){
	var span_value_adult=$(this).siblings(".infant_room_value").val();
	if(span_value_adult>0)
	{
		$(this).siblings(".infant_room_result").html("").html(Math.round(span_value_adult) - 1)
    $(this).siblings(".infant_room_value").val("").val(Math.round(span_value_adult) - 1)
	}
	else
	{
		alert('This cannot be negative')
		return false
	}
	get_sum_passenger()
  get_seperate_passenger()
})

// single adult (incrementing)
$(document).on("click",".single_room_inc",function(){
		var passenger=no_of_traveller_check($(this));
		var total_allowed=$(this).parent().parent().parent().siblings(".max_passenger").val();
  if(passenger<total_allowed)
  {
	var span_value_adult=$(this).siblings(".single_room_value").val();
  $(this).siblings(".single_room_result").html("").html(Math.round(span_value_adult) + 1)
    $(this).siblings(".single_room_value").val("").val(Math.round(span_value_adult) + 1)
    }
  else
  {
  	alert('passenger cannot be greater that '+total_allowed)
  }
  get_sum_passenger()
  get_seperate_passenger()
})

// single adult (decrementing)
$(document).on("click",".single_room_dec",function(){
	var span_value_adult=$(this).siblings(".single_room_value").val();
	var span_value_twin_adult=$(this).parent().parent().siblings(":nth-child(1)").children().children(".twin_adult_room_value").val()
	if(span_value_twin_adult>=1)
	{
		if(span_value_adult>0)
	{
		$(this).siblings(".single_room_result").html("").html(Math.round(span_value_adult) - 1)
    $(this).siblings(".single_room_value").val("").val(Math.round(span_value_adult) - 1)
	}
	else
	{
		alert('This cannot be negative')
		return false
	}
	}
	else
	{
  if(span_value_adult>1)
	{
		$(this).siblings(".single_room_result").html("").html(Math.round(span_value_adult) - 1)
    $(this).siblings(".single_room_value").val("").val(Math.round(span_value_adult) - 1)
	}
	else
	{
		alert('This cannot be 0')
		return false
	}
	}

	
	get_sum_passenger()
  get_seperate_passenger()
})*/

/*----------*/

/*// Handle click event for incrementing twin adult room value
$(document).on("click", ".twin_adult_room_inc", function() {
    // Get the current value of the twin_adult_room_value
    var span_value_adult = $(this).siblings(".twin_adult_room_value").val();
    
    // Log value for debugging
    console.log("Current span value adult: " + span_value_adult);
    
    // Check if no_of_traveller_check function works as expected
    var passenger = no_of_traveller_check($(this));
    console.log("Number of travellers: " + passenger);

    // Find the max_passenger element relative to the new HTML structure
    var total_allowed = $(this).closest(".makeflex").find(".max_passenger").val();
    
    // Log value for debugging
    console.log("Total allowed: " + total_allowed);
    
    // Check if passenger is less than total_allowed
    if (passenger < total_allowed) {
        $(this).siblings(".twin_adult_room_result").html(Math.round(span_value_adult) + 1);
        $(this).siblings(".twin_adult_room_value").val(Math.round(span_value_adult) + 1);
    } else {
        alert('Please note that the maximum occupancy for this room is ' + total_allowed + ' guests. Kindly make the necessary adjustments to comply with this limit.');
    }
    
    // Update passenger sum and separate passenger details
    get_sum_passenger();
    get_seperate_passenger();
});

// Handle click event for decrementing twin adult room value
$(document).on("click", ".twin_adult_room_dec", function() {
    // Get the current value of the twin adult room input
    var span_value_adult = $(this).siblings(".twin_adult_room_value").val();
    
    // Get the value of the single room input from a sibling element
    var span_value_solo_adult = $(this).parent().parent().siblings(":nth-child(6)").children().children(".single_room_value").val();
    
    // Check if there is at least one solo adult in the room
    if (span_value_solo_adult >= 1) {
        // Check if the current value of the twin adult room input is greater than 0
        if (span_value_adult > 0) {
            // Decrement the value and update the display
            $(this).siblings(".twin_adult_room_result").html(Math.round(span_value_adult) - 1);
            $(this).siblings(".twin_adult_room_value").val(Math.round(span_value_adult) - 1);
        } else {
            // Alert if the value is already 0
            alert('This cannot be negative');
            return false; // Exit the function
        }
    } else {
        // Check if the current value is greater than 1 (to avoid setting it to 0)
        if (span_value_adult > 1) {
            // Decrement the value and update the display
            $(this).siblings(".twin_adult_room_result").html(Math.round(span_value_adult) - 1);
            $(this).siblings(".twin_adult_room_value").val(Math.round(span_value_adult) - 1);
        } else {
            // Alert if the value is 0 or less
            alert('This cannot be 0');
            return false; // Exit the function
        }
    }
    
    // Update the total number of passengers and separate passenger counts
    get_sum_passenger();
    get_seperate_passenger();
});

//----------

// Handle click event for incrementing extra adult room value
$(document).on("click", ".extra_adult_room_inc", function() {
    // Get the number of travellers from a custom function
    var passenger = no_of_traveller_check($(this));
    
    // Get the maximum allowed number of passengers from the related element
    // var total_allowed = $(this).parent().parent().parent().siblings(".max_passenger").val();
    var total_allowed = $(this).closest(".makeflex").find(".max_passenger").val();
    
    // Check if the current number of passengers is less than the total allowed
    if (passenger < total_allowed) {
        // Get the current value of the extra adult room input
        var span_value_adult = $(this).siblings(".extra_adult_room_value").val();
        
        // Increment the value and update the display
        $(this).siblings(".extra_adult_room_result").html(Math.round(span_value_adult) + 1);
        $(this).siblings(".extra_adult_room_value").val(Math.round(span_value_adult) + 1);
    } else {
        // Alert if the number of passengers exceeds the allowed limit
        alert('Please note that the maximum occupancy for this room is ' + total_allowed + ' guests. Kindly make the necessary adjustments to comply with this limit.');
    }
    
    // Update the total number of passengers and separate passenger counts
    get_sum_passenger();
    get_seperate_passenger();
});

// Handle click event for decrementing extra adult room value
$(document).on("click", ".extra_adult_room_dec", function() {
    // Get the current value of the extra adult room input
    var span_value_adult = $(this).siblings(".extra_adult_room_value").val();
    
    // Check if the current value is greater than 0
    if (span_value_adult > 0) {
        // Decrement the value and update the display
        $(this).siblings(".extra_adult_room_result").html(Math.round(span_value_adult) - 1);
        $(this).siblings(".extra_adult_room_value").val(Math.round(span_value_adult) - 1);
    } else {
        // Alert if the value is 0 or negative
        alert('This cannot be negative');
        return false; // Prevent further execution
    }
    
    // Update the total number of passengers and separate passenger counts
    get_sum_passenger();
    get_seperate_passenger();
});

//

// Handle click event for incrementing child with bed room value
$(document).on("click", ".child_with_bed_room_inc", function() {
    // Get the total number of passengers currently booked
    var passenger = no_of_traveller_check($(this));
    
    // Get the maximum number of passengers allowed for the room
    var total_allowed = $(this).closest(".makeflex").find(".max_passenger").val();
    
    // Check if the current number of passengers is less than the allowed maximum
    if (passenger < total_allowed) {
        // Get the current value from the child with bed room input
        var span_value_adult = $(this).siblings(".child_with_bed_room_value").val();
        
        // Increment the value and update the display
        $(this).siblings(".child_with_bed_room_result").html(Math.round(span_value_adult) + 1);
        $(this).siblings(".child_with_bed_room_value").val(Math.round(span_value_adult) + 1);
    } else {
        // Alert if the passenger count exceeds the maximum allowed
        alert('Please note that the maximum occupancy for this room is ' + total_allowed + ' guests. Kindly make the necessary adjustments to comply with this limit.');
    }
    
    // Update the total number of passengers and separate passenger counts
    get_sum_passenger();
    get_seperate_passenger();
});

// Handle click event for decrementing child with bed room value
$(document).on("click", ".child_with_bed_room_dec", function() {
    // Get the current value from the child with bed room input
    var span_value_adult = $(this).siblings(".child_with_bed_room_value").val();
    
    // Check if the current value is greater than 0
    if (span_value_adult > 0) {
        // Decrement the value and update the display
        $(this).siblings(".child_with_bed_room_result").html(Math.round(span_value_adult) - 1);
        $(this).siblings(".child_with_bed_room_value").val(Math.round(span_value_adult) - 1);
    } else {
        // Alert if the value is already 0 or negative
        alert('This cannot be negative');
        return false;
    }
    
    // Update the total number of passengers and separate passenger counts
    get_sum_passenger();
    get_seperate_passenger();
});

//

// Handle click event for incrementing child without bed room value
$(document).on("click", ".child_without_bed_room_inc", function() {
    // Get the number of current passengers from the custom function
    var passenger = no_of_traveller_check($(this));
    
    // Get the maximum number of passengers allowed from the sibling element
    var total_allowed = $(this).closest(".makeflex").find(".max_passenger").val();
    
    // Check if the number of current passengers is less than the total allowed
    if (passenger < total_allowed) {
        // Get the current value from the child without bed room input
        var span_value_adult = $(this).siblings(".child_without_bed_room_value").val();
        
        // Increment the value and update the display
        $(this).siblings(".child_without_bed_room_result").html(Math.round(span_value_adult) + 1);
        $(this).siblings(".child_without_bed_room_value").val(Math.round(span_value_adult) + 1);
    } else {
        // Alert if the passenger count exceeds the allowed maximum
        alert('Please note that the maximum occupancy for this room is ' + total_allowed + ' guests. Kindly make the necessary adjustments to comply with this limit.');
    }
    
    // Update the total number of passengers and separate passenger counts
    get_sum_passenger();
    get_seperate_passenger();
});

// Handle click event for decrementing child without bed room value
$(document).on("click", ".child_without_bed_room_dec", function() {
    // Get the current value from the child without bed room input
    var span_value_adult = $(this).siblings(".child_without_bed_room_value").val();
    
    // Check if the current value is greater than 0
    if (span_value_adult > 0) {
        // Decrement the value and update the display
        $(this).siblings(".child_without_bed_room_result").html(Math.round(span_value_adult) - 1);
        $(this).siblings(".child_without_bed_room_value").val(Math.round(span_value_adult) - 1);
    } else {
        // Alert if the value is 0 or negative
        alert('This cannot be negative');
        return false; // Exit the function to prevent further actions
    }
    
    // Update the total number of passengers and separate passenger counts
    get_sum_passenger();
    get_seperate_passenger();
});

//

// Handle click event for incrementing infant room value
$(document).on("click", ".infant_room_inc", function() {
    // Get the number of current travellers
    var passenger = no_of_traveller_check($(this));
    
    // Get the maximum number of passengers allowed from the sibling element
    var total_allowed = $(this).closest(".makeflex").find(".max_passenger").val();
    
    // Check if the number of current travellers is less than the total allowed
    if (passenger < total_allowed) {
        // Get the current value from the infant room input
        var span_value_adult = $(this).siblings(".infant_room_value").val();
        
        // Increment the value and update the display
        $(this).siblings(".infant_room_result").html(Math.round(span_value_adult) + 1);
        $(this).siblings(".infant_room_value").val(Math.round(span_value_adult) + 1);
    } else {
        // Alert if the passenger count exceeds the allowed limit
        alert('Please note that the maximum occupancy for this room is ' + total_allowed + ' guests. Kindly make the necessary adjustments to comply with this limit.');
    }
    
    // Update the total number of passengers and separate passenger counts
    get_sum_passenger();
    get_seperate_passenger();
});

// Handle click event for decrementing infant room value
$(document).on("click", ".infant_room_dec", function() {
    // Get the current value from the infant room input
    var span_value_adult = $(this).siblings(".infant_room_value").val();
    
    // Check if the current value is greater than 0
    if (span_value_adult > 0) {
        // Decrement the value and update the display
        $(this).siblings(".infant_room_result").html(Math.round(span_value_adult) - 1);
        $(this).siblings(".infant_room_value").val(Math.round(span_value_adult) - 1);
    } else {
        // Alert if the value is already 0 or negative
        alert('This cannot be negative');
        return false;
    }
    
    // Update the total number of passengers and separate passenger counts
    get_sum_passenger();
    get_seperate_passenger();
});

//

// Handle click event for incrementing single room value
$(document).on("click", ".single_room_inc", function() {
    // Get the number of travellers from the current context
    var passenger = no_of_traveller_check($(this));
    
    // Get the maximum number of passengers allowed from the sibling element
    var total_allowed = $(this).closest(".makeflex").find(".max_passenger").val();
    
    // Check if the current number of passengers is less than the allowed maximum
    if (passenger < total_allowed) {
        // Get the current value from the single room input
        var span_value_adult = $(this).siblings(".single_room_value").val();
        
        // Increment the value and update the display
        $(this).siblings(".single_room_result").html(Math.round(span_value_adult) + 1);
        $(this).siblings(".single_room_value").val(Math.round(span_value_adult) + 1);
    } else {
        // Alert if the passenger count exceeds the allowed maximum
        alert('Please note that the maximum occupancy for this room is ' + total_allowed + ' guests. Kindly make the necessary adjustments to comply with this limit.');
    }
    
    // Update the total number of passengers and separate passenger counts
    get_sum_passenger();
    get_seperate_passenger();
});

// Handle click event for decrementing single room value
$(document).on("click", ".single_room_dec", function() {
    // Get the current value from the single room input
    var span_value_adult = $(this).siblings(".single_room_value").val();
    
    // Get the value from the twin adult room input
    var span_value_twin_adult = $(this).parent().parent().siblings(":nth-child(1)").children().children(".twin_adult_room_value").val();
    
    // Check if there is at least one twin adult room
    if (span_value_twin_adult >= 1) {
        // Check if the current value is greater than 0
        if (span_value_adult > 0) {
            // Decrement the value and update the display
            $(this).siblings(".single_room_result").html(Math.round(span_value_adult) - 1);
            $(this).siblings(".single_room_value").val(Math.round(span_value_adult) - 1);
        } else {
            // Alert if the value cannot be negative
            alert('This cannot be negative');
            return false;
        }
    } else {
        // Check if the value is greater than 1
        if (span_value_adult > 1) {
            // Decrement the value and update the display
            $(this).siblings(".single_room_result").html(Math.round(span_value_adult) - 1);
            $(this).siblings(".single_room_value").val(Math.round(span_value_adult) - 1);
        } else {
            // Alert if the value cannot be 0
            alert('This cannot be 0');
            return false;
        }
    }

    // Update the total number of passengers and separate passenger counts
    get_sum_passenger();
    get_seperate_passenger();
});*/

/*----------*/

/*$(document).ready(function() {
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
            if (newValue >= 0) {
                $resultElement.html(newValue);
                $valueElement.val(newValue);
            } else {
                alert('This cannot be negative');
            }
        }

        // update overall passenger sum and separate passenger details
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

	function get_sum_passenger() {
		var twin_adult=0;
	 	var extra_adult=0;
	 	var child_with_bed=0;
	 	var child_without_bed=0;
	 	var infant_room=0;
	 	var single_room=0;
	 	$(".twin_adult_room_value").each(function() {
	 		var val=$(this).val();
	 		if(val!='' && val!=0) {
	 			twin_adult=Math.round(twin_adult)+Math.round(val)
	 		}
	 	});
	 	 	
		if(twin_adult==0) {
			$(".adult_disable").each(function() {
	     $(this).val('')
	    $(this).attr('readonly','')
	    });
		} else {
			$(".adult_disable").each(function() {
	    $(this).removeAttr('readonly','')
	    });
		}

		$(".extra_adult_room_value").each(function() {
			var val=$(this).val();
	 		if(val!='' && val!=0) {
	 			extra_adult=Math.round(extra_adult)+Math.round(val)
	 		}
	  });

	  if(extra_adult==0) {
	  	$(".exadult_disable").each(function() {
	  		$(this).val('')
	  		$(this).attr('readonly','')
	    });
	  } else {
	  	$(".exadult_disable").each(function() {
	  		$(this).removeAttr('readonly','')
	    });
	  }

	  $(".single_room_value").each(function() {
	  	var val=$(this).val();
	 		if(val!='' && val!=0) {
	 			single_room=Math.round(single_room)+Math.round(val)
	 		}
	  });

	 	if(single_room==0) {
	 		$(".single_disable").each(function() {
	     $(this).val('')
	    $(this).attr('readonly','')
	    });
	 	} else {
	 		$(".single_disable").each(function() {
	    $(this).removeAttr('readonly','')
	    });
	 	}

	 	//
	 	var child=0;
	 	$(".child_with_bed_room_value").each(function() {
	 		var val=$(this).val();
	 		if(val!='' && val!=0) {
	 			child_with_bed=Math.round(child_with_bed)+Math.round(val)
	 		}
	  });

	  if(child_with_bed==0) {
	  	$(".childbed_disable").each(function() {
		    $(this).val('')
		    $(this).attr('readonly','')
		  });
	  } else {
	  	$(".childbed_disable").each(function() {
	    	$(this).removeAttr('readonly','')
	    });
	  }

	  //
	  $(".child_without_bed_room_value").each(function() {
	  	var val=$(this).val();
	  	if(val!='' && val!=0) {
	  		child_without_bed=Math.round(child_without_bed)+Math.round(val)
	 		}
	  });
	  if(child_without_bed==0) {
	  	$(".childwbed_disable").each(function() {
	    	$(this).val('')
	    	$(this).attr('readonly','')
	    });
	  } else {
	  	$(".childwbed_disable").each(function() {
		    $(this).removeAttr('readonly','')
		  });
	  }

	  //
	  var infant=0;
	  $(".infant_room_value").each(function() {
	  	var val=$(this).val();
	  	if(val!='' && val!=0) {
	  		infant_room=Math.round(infant_room)+Math.round(val)
	  	}
	  });

	  if(infant_room==0) {
	  	$(".infant_disable").each(function() {
	  		$(this).val('')
	  		$(this).attr('readonly','')
	  	});
	  } else {
	  	$(".infant_disable").each(function() {
	  		$(this).removeAttr('readonly','')
	  	});
	  }
	 	 	 
	 	//
		$(".quote1_adult_room_value").val("").val(twin_adult)
		$(".quote1_adult_room_result").html("").html(twin_adult)

		$(".quote1_number_of_extra_adult").val("").val(extra_adult)
		$(".quote1_child_extra_adult_result").html("").html(extra_adult)

		$(".quote1_number_of_child_with_bed").val("").val(child_with_bed)
		$(".quote1_child_with_bed_result").html("").html(child_with_bed)

		$(".quote1_number_of_child_without_bed").val("").val(child_without_bed)
		$(".quote1_span_value_childwithoutbed_result").html("").html(child_without_bed)

		$(".quote1_number_of_infant").val("").val(infant_room)
		$(".quote1_infant_result").html("").html(infant_room)

		$(".quote1_number_solo_traveller").val("").val(single_room)
		$(".quote1_solo_result").html("").html(single_room)

		quote1_price('quote1_air_adult','quote1_cruise_adult','quote1_cruiseport_adult','quote1_cruisegratuity_adult','quote1_cruisegst_adult','quote1_hotel_adult','quote1_tours_adult','quote1_transfer_adult','quote1_visa_adult','quote1_inc_adult','quote1_meals_adult','quote1_additionalservice_adult','quote1_tourtotal_adult','quote1_tourtotal_exadult','quote1_tourtotal_childbed','quote1_tourtotal_childwbed','quote1_tourtotal_infant','quote1_tourtotal_single','pricemarkup','markup_percentage','quote1_markup_adult','quote1_markup_exadult','quote1_markup_childbed','quote1_markup_childwbed','quote1_markup_infant','quote1_markup_single','quote1_total_adult','quote1_discount_adult_plus','quote1_gross_total_adult','quote1_gross_total_exadult','quote1_gross_total_childbed','quote1_gross_total_childwbed','quote1_gross_total_infant','quote1_gross_total_single','quote1_gross_total_group','quote1_discount_adult_minus','quote1_discount_exadult_minus','quote1_discount_childbed_minus','quote1_discount_childwbed_minus','quote1_discount_infant_minus','quote1_discount_single_minus','pricegst','gst_percentage','quote1_gst_adult','quote1_gst_adult','quote1_gst_exadult','quote1_gst_childbed','quote1_gst_childwbed','quote1_gst_infant','quote1_gst_single','quote1_gst_group','quote1_gsttotal_adult','pricetcs','tcs_percentage','quote1_tcs_adult','quote1_tcs_exadult','quote1_tcs_childbed','quote1_tcs_childwbed','quote1_tcs_infant','quote1_tcs_single','quote1_tcs_group','quote1_tcstotal_adult','pricepgcharges','pgcharges_percentage','quote1_pgcharges_adult','quote1_pgcharges_exadult','quote1_pgcharges_childbed','quote1_pgcharges_childwbed','quote1_pgcharges_infant','quote1_pgcharges_single','quote1_pg_group','quote1_grand_adult','quote1_grand_adult_with_person','query_pricetopay','quote1_number_of_adult','quote1_number_of_extra_adult','quote1_number_of_child_with_bed','quote1_number_of_child_without_bed','quote1_number_of_infant','quote1_number_solo_traveller','quote1_grand_exadult_with_person','quote1_grand_childbed_with_person','quote1_grand_childwbed_with_person','quote1_grand_infant_with_person','quote1_grand_single_with_person','quote1_discount_group','quote1_gsttotal_exadult','quote1_gsttotal_childbed','quote1_gsttotal_childwbed','quote1_gsttotal_infant','quote1_gsttotal_single','quote1_tcstotal_exadult','quote1_tcstotal_childbed','quote1_tcstotal_childwbed','quote1_tcstotal_infant','quote1_tcstotal_single','quote1_air_exadult','quote1_cruise_exadult','quote1_cruiseport_exadult','quote1_cruisegratuity_exadult','quote1_cruisegst_exadult','quote1_hotel_exadult','quote1_tours_exadult','quote1_transfer_exadult','quote1_visa_exadult','quote1_inc_exadult','quote1_meals_exadult','quote1_additionalservice_exadult','quote1_discount_exadult_plus','quote1_grand_exadult','quote1_grand_childbed','quote1_grand_childwbed','quote1_grand_infant','quote1_grand_single','quote1_air_childbed','quote1_cruise_childbed','quote1_cruiseport_childbed','quote1_cruisegratuity_childbed','quote1_cruisegst_childbed','quote1_hotel_childbed','quote1_tours_childbed','quote1_transfer_childbed','quote1_visa_childbed','quote1_inc_childbed','quote1_meals_childbed','quote1_additionalservice_childbed','quote1_discount_childbed_plus','quote1_air_childwbed','quote1_cruise_childwbed','quote1_cruiseport_childwbed','quote1_cruisegratuity_childwbed','quote1_cruisegst_childwbed','quote1_hotel_childwbed','quote1_tours_childwbed','quote1_transfer_childwbed','quote1_visa_childwbed','quote1_inc_childwbed','quote1_meals_childwbed','quote1_additionalservice_childwbed','quote1_discount_childwbed_plus','quote1_air_infant','quote1_cruise_infant','quote1_cruiseport_infant','quote1_cruisegratuity_infant','quote1_cruisegst_infant','quote1_hotel_infant','quote1_tours_infant','quote1_transfer_infant','quote1_visa_infant','quote1_inc_infant','quote1_meals_infant','quote1_additionalservice_infant','quote1_discount_infant_plus','quote1_air_single','quote1_cruise_single','quote1_cruiseport_single','quote1_cruisegratuity_single','quote1_cruisegst_single','quote1_hotel_single','quote1_tours_single','quote1_transfer_single','quote1_visa_single','quote1_inc_single','quote1_meals_single','quote1_additionalservice_single','quote1_discount_single_plus','quote1_pricetopay','pricediscountpositive','discountpositive_percentage','pricediscountnegative','discountnegative_percentage','advance_payment','advance_payment_percentage','quote1_advance_payment','first_part_payment','first_part_percentage','quote1_first_part','second_part_payment','second_part_percentage','quote1_second_part','quote1_total_payment','show_part_payment','advance_payment_percentage','quote1_advance_payment','first_part_percentage','quote1_first_part','second_part_percentage','quote1_second_part','quote1_total_payment','coupon_percentage')
	}

	function get_seperate_passenger() {

	 	var adult=0;
	 	 	$(".twin_adult_room_value").each(function() {
	 				var val=$(this).val();
	 		if(val!='' && val!=0)
	 		{
		adult=Math.round(adult)+Math.round(val)
	 		}
	  });

	 	 	 	$(".extra_adult_room_value").each(function() {
	 				var val=$(this).val();
	 		if(val!='' && val!=0)
	 		{
		adult=Math.round(adult)+Math.round(val)
		 		}
		  });

		$(".single_room_value").each(function() {
			var val=$(this).val();
		 		if(val!='' && val!=0)
		 		{
		adult=Math.round(adult)+Math.round(val)
		 		}
		  });
		 //
		 	var child=0;
		 	 	$(".child_with_bed_room_value").each(function() {
		 				var val=$(this).val();
		 		if(val!='' && val!=0)
		 		{
		child=Math.round(child)+Math.round(val)
		 		}
		  });
		 	 		$(".child_without_bed_room_value").each(function() {
		 				var val=$(this).val();
		 		if(val!='' && val!=0)
		 		{
		child=Math.round(child)+Math.round(val)
		 		}
		  });
		 	 	//
		 	 		var infant=0;
		 	 	$(".infant_room_value").each(function() {
		 				var val=$(this).val();
		 		if(val!='' && val!=0)
		 		{
		infant=Math.round(infant)+Math.round(val)
		 		}
		  });
		 	 		
		 	//
		 	var select_room=$(".dynamic_four").children("div").length
		 	var pass=select_room+ ' Rooms ' +'('+ adult+ ' Adults '+child+' Child '+infant+' infant'+')'
		$(".quote1_pop_passenger_value").val('').val(pass)
	}

	function no_of_traveller_check(thisObj) {
		var passenger=thisObj.siblings('input').val()
		thisObj.parent().parent().siblings().each(function() {
			if($(this).children('.addTravellerValue').children().length>2) {
	 			var val=$(this).children('.addTravellerValue').children('input').val();
	 		if(val!='' && val!=0) {
	 			passenger=Math.round(passenger)+Math.round(val)
	 		}
	 	}
	 });
		return passenger;
	}*/

/*----------*/

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

	/*function get_sum_passenger() {
		var twin_adult=0;
	 	var extra_adult=0;
	 	var child_with_bed=0;
	 	var child_without_bed=0;
	 	var infant_room=0;
	 	var single_room=0;
	 	$(".twin_adult_room_value").each(function() {
	 		var val=$(this).val();
	 		if(val!='' && val!=0) {
	 			twin_adult=Math.round(twin_adult)+Math.round(val)
	 		}
	 	});
	 	 	
		if(twin_adult==0) {
			$(".adult_disable").each(function() {
	     $(this).val('')
	    $(this).attr('readonly','')
	    });
		} else {
			$(".adult_disable").each(function() {
	    $(this).removeAttr('readonly','')
	    });
		}

		$(".extra_adult_room_value").each(function() {
			var val=$(this).val();
	 		if(val!='' && val!=0) {
	 			extra_adult=Math.round(extra_adult)+Math.round(val)
	 		}
	  });

	  if(extra_adult==0) {
	  	$(".exadult_disable").each(function() {
	  		$(this).val('')
	  		$(this).attr('readonly','')
	    });
	  } else {
	  	$(".exadult_disable").each(function() {
	  		$(this).removeAttr('readonly','')
	    });
	  }

	  $(".single_room_value").each(function() {
	  	var val=$(this).val();
	 		if(val!='' && val!=0) {
	 			single_room=Math.round(single_room)+Math.round(val)
	 		}
	  });

	 	if(single_room==0) {
	 		$(".single_disable").each(function() {
	     $(this).val('')
	    $(this).attr('readonly','')
	    });
	 	} else {
	 		$(".single_disable").each(function() {
	    $(this).removeAttr('readonly','')
	    });
	 	}

	 	//
	 	var child=0;
	 	$(".child_with_bed_room_value").each(function() {
	 		var val=$(this).val();
	 		if(val!='' && val!=0) {
	 			child_with_bed=Math.round(child_with_bed)+Math.round(val)
	 		}
	  });

	  if(child_with_bed==0) {
	  	$(".childbed_disable").each(function() {
		    $(this).val('')
		    $(this).attr('readonly','')
		  });
	  } else {
	  	$(".childbed_disable").each(function() {
	    	$(this).removeAttr('readonly','')
	    });
	  }

	  //
	  $(".child_without_bed_room_value").each(function() {
	  	var val=$(this).val();
	  	if(val!='' && val!=0) {
	  		child_without_bed=Math.round(child_without_bed)+Math.round(val)
	 		}
	  });
	  if(child_without_bed==0) {
	  	$(".childwbed_disable").each(function() {
	    	$(this).val('')
	    	$(this).attr('readonly','')
	    });
	  } else {
	  	$(".childwbed_disable").each(function() {
		    $(this).removeAttr('readonly','')
		  });
	  }

	  //
	  var infant=0;
	  $(".infant_room_value").each(function() {
	  	var val=$(this).val();
	  	if(val!='' && val!=0) {
	  		infant_room=Math.round(infant_room)+Math.round(val)
	  	}
	  });

	  if(infant_room==0) {
	  	$(".infant_disable").each(function() {
	  		$(this).val('')
	  		$(this).attr('readonly','')
	  	});
	  } else {
	  	$(".infant_disable").each(function() {
	  		$(this).removeAttr('readonly','')
	  	});
	  }
	 	 	 
	 	//
		$(".quote1_adult_room_value").val("").val(twin_adult)
		$(".quote1_adult_room_result").html("").html(twin_adult)

		$(".quote1_number_of_extra_adult").val("").val(extra_adult)
		$(".quote1_child_extra_adult_result").html("").html(extra_adult)

		$(".quote1_number_of_child_with_bed").val("").val(child_with_bed)
		$(".quote1_child_with_bed_result").html("").html(child_with_bed)

		$(".quote1_number_of_child_without_bed").val("").val(child_without_bed)
		$(".quote1_span_value_childwithoutbed_result").html("").html(child_without_bed)

		$(".quote1_number_of_infant").val("").val(infant_room)
		$(".quote1_infant_result").html("").html(infant_room)

		$(".quote1_number_solo_traveller").val("").val(single_room)
		$(".quote1_solo_result").html("").html(single_room)

		quote1_price('quote1_air_adult','quote1_cruise_adult','quote1_cruiseport_adult','quote1_cruisegratuity_adult','quote1_cruisegst_adult','quote1_hotel_adult','quote1_tours_adult','quote1_transfer_adult','quote1_visa_adult','quote1_inc_adult','quote1_meals_adult','quote1_additionalservice_adult','quote1_tourtotal_adult','quote1_tourtotal_exadult','quote1_tourtotal_childbed','quote1_tourtotal_childwbed','quote1_tourtotal_infant','quote1_tourtotal_single','pricemarkup','markup_percentage','quote1_markup_adult','quote1_markup_exadult','quote1_markup_childbed','quote1_markup_childwbed','quote1_markup_infant','quote1_markup_single','quote1_total_adult','quote1_discount_adult_plus','quote1_gross_total_adult','quote1_gross_total_exadult','quote1_gross_total_childbed','quote1_gross_total_childwbed','quote1_gross_total_infant','quote1_gross_total_single','quote1_gross_total_group','quote1_discount_adult_minus','quote1_discount_exadult_minus','quote1_discount_childbed_minus','quote1_discount_childwbed_minus','quote1_discount_infant_minus','quote1_discount_single_minus','pricegst','gst_percentage','quote1_gst_adult','quote1_gst_adult','quote1_gst_exadult','quote1_gst_childbed','quote1_gst_childwbed','quote1_gst_infant','quote1_gst_single','quote1_gst_group','quote1_gsttotal_adult','pricetcs','tcs_percentage','quote1_tcs_adult','quote1_tcs_exadult','quote1_tcs_childbed','quote1_tcs_childwbed','quote1_tcs_infant','quote1_tcs_single','quote1_tcs_group','quote1_tcstotal_adult','pricepgcharges','pgcharges_percentage','quote1_pgcharges_adult','quote1_pgcharges_exadult','quote1_pgcharges_childbed','quote1_pgcharges_childwbed','quote1_pgcharges_infant','quote1_pgcharges_single','quote1_pg_group','quote1_grand_adult','quote1_grand_adult_with_person','query_pricetopay','quote1_number_of_adult','quote1_number_of_extra_adult','quote1_number_of_child_with_bed','quote1_number_of_child_without_bed','quote1_number_of_infant','quote1_number_solo_traveller','quote1_grand_exadult_with_person','quote1_grand_childbed_with_person','quote1_grand_childwbed_with_person','quote1_grand_infant_with_person','quote1_grand_single_with_person','quote1_discount_group','quote1_gsttotal_exadult','quote1_gsttotal_childbed','quote1_gsttotal_childwbed','quote1_gsttotal_infant','quote1_gsttotal_single','quote1_tcstotal_exadult','quote1_tcstotal_childbed','quote1_tcstotal_childwbed','quote1_tcstotal_infant','quote1_tcstotal_single','quote1_air_exadult','quote1_cruise_exadult','quote1_cruiseport_exadult','quote1_cruisegratuity_exadult','quote1_cruisegst_exadult','quote1_hotel_exadult','quote1_tours_exadult','quote1_transfer_exadult','quote1_visa_exadult','quote1_inc_exadult','quote1_meals_exadult','quote1_additionalservice_exadult','quote1_discount_exadult_plus','quote1_grand_exadult','quote1_grand_childbed','quote1_grand_childwbed','quote1_grand_infant','quote1_grand_single','quote1_air_childbed','quote1_cruise_childbed','quote1_cruiseport_childbed','quote1_cruisegratuity_childbed','quote1_cruisegst_childbed','quote1_hotel_childbed','quote1_tours_childbed','quote1_transfer_childbed','quote1_visa_childbed','quote1_inc_childbed','quote1_meals_childbed','quote1_additionalservice_childbed','quote1_discount_childbed_plus','quote1_air_childwbed','quote1_cruise_childwbed','quote1_cruiseport_childwbed','quote1_cruisegratuity_childwbed','quote1_cruisegst_childwbed','quote1_hotel_childwbed','quote1_tours_childwbed','quote1_transfer_childwbed','quote1_visa_childwbed','quote1_inc_childwbed','quote1_meals_childwbed','quote1_additionalservice_childwbed','quote1_discount_childwbed_plus','quote1_air_infant','quote1_cruise_infant','quote1_cruiseport_infant','quote1_cruisegratuity_infant','quote1_cruisegst_infant','quote1_hotel_infant','quote1_tours_infant','quote1_transfer_infant','quote1_visa_infant','quote1_inc_infant','quote1_meals_infant','quote1_additionalservice_infant','quote1_discount_infant_plus','quote1_air_single','quote1_cruise_single','quote1_cruiseport_single','quote1_cruisegratuity_single','quote1_cruisegst_single','quote1_hotel_single','quote1_tours_single','quote1_transfer_single','quote1_visa_single','quote1_inc_single','quote1_meals_single','quote1_additionalservice_single','quote1_discount_single_plus','quote1_pricetopay','pricediscountpositive','discountpositive_percentage','pricediscountnegative','discountnegative_percentage','advance_payment','advance_payment_percentage','quote1_advance_payment','first_part_payment','first_part_percentage','quote1_first_part','second_part_payment','second_part_percentage','quote1_second_part','quote1_total_payment','show_part_payment','advance_payment_percentage','quote1_advance_payment','first_part_percentage','quote1_first_part','second_part_percentage','quote1_second_part','quote1_total_payment','coupon_percentage')
	}*/

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

	/*function get_seperate_passenger() {

	 	var adult=0;
	 	 	$(".twin_adult_room_value").each(function() {
	 				var val=$(this).val();
	 		if(val!='' && val!=0)
	 		{
		adult=Math.round(adult)+Math.round(val)
	 		}
	  });

	 	 	 	$(".extra_adult_room_value").each(function() {
	 				var val=$(this).val();
	 		if(val!='' && val!=0)
	 		{
		adult=Math.round(adult)+Math.round(val)
		 		}
		  });

		 	 	 		$(".single_room_value").each(function() {
		 				var val=$(this).val();
		 		if(val!='' && val!=0)
		 		{
		adult=Math.round(adult)+Math.round(val)
		 		}
		  });
		 //
		 	var child=0;
		 	 	$(".child_with_bed_room_value").each(function() {
		 				var val=$(this).val();
		 		if(val!='' && val!=0)
		 		{
		child=Math.round(child)+Math.round(val)
		 		}
		  });
		 	 		$(".child_without_bed_room_value").each(function() {
		 				var val=$(this).val();
		 		if(val!='' && val!=0)
		 		{
		child=Math.round(child)+Math.round(val)
		 		}
		  });
		 	 	//
		 	 		var infant=0;
		 	 	$(".infant_room_value").each(function() {
		 				var val=$(this).val();
		 		if(val!='' && val!=0)
		 		{
		infant=Math.round(infant)+Math.round(val)
		 		}
		  });
		 	 		
		 	//
		 	var select_room=$(".dynamic_four").children("div").length
		 	var pass=select_room+ ' Rooms ' +'('+ adult+ ' Adults '+child+' Child '+infant+' infant'+')'
		$(".quote1_pop_passenger_value").val('').val(pass)
	}*/

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

	/*function no_of_traveller_check(thisObj) {
		var passenger=thisObj.siblings('input').val()
		thisObj.parent().parent().siblings().each(function() {
			if($(this).children('.addTravellerValue').children().length>2) {
	 			var val=$(this).children('.addTravellerValue').children('input').val();
	 		if(val!='' && val!=0) {
	 			passenger=Math.round(passenger)+Math.round(val)
	 		}
	 	}
	 });
		return passenger;
	}*/

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

/*$(document).on("click","#enq_update",function(){
// var form_data=$("#enq_data").html();
// $(".quote1_room_data").html('').html(form_data)
$('#addBookDialog').modal('hide');
})

$(document).on('click','.get_room',function(e){
	// var quote1_room_data=$(".quote1_room_data").html()
	// console.log(quote1_room_data)
	// if(quote1_room_data!='')
	// {
	// 	$("#enq_data").html('').html(quote1_room_data)
	// }
 	e.preventDefault()
	$('#addBookDialog').modal('show');
})

$(document).on('change','.max_passenger',function(event){
	var max_passenger=$(this).val();
	var passenger=0;
 	$(this).siblings('.guest-room-wrapper').children().each(function() { 		
 		if($(this).children('.addTravellerValue').children().length>2)
 		{
 			var val=$(this).children('.addTravellerValue').children('input').val();
 		if(val!='' && val!=0)
 		{
			passenger=Math.round(passenger)+Math.round(val)
 		}
 		}
  });

  if(max_passenger<passenger)
  {
  	$(this).find('option:contains("'+passenger+'")').prop('selected', true)
  	alert('Maximum passenger should be greater than equal to passenger')
  	return false;
  }
})

$(document).ready(function(){
	// $(".quote1_first_part").val('')
	$(".quote1_first_part").attr('readonly','')
	// $(".quote1_second_part").val('')
	$(".quote1_second_part").attr('readonly','')
})*/

/*----------*/

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

/*$(document).on("keyup change",".quote1_air_adult , .quote1_cruise_adult , .quote1_cruiseport_adult , .quote1_cruisegratuity_adult , .quote1_cruisegst_adult , .quote1_hotel_adult , .quote1_tours_adult , .quote1_transfer_adult , .quote1_visa_adult , .quote1_inc_adult , .quote1_meals_adult , .quote1_additionalservice_adult ,.pricemarkup , .markup_percentage,.quote1_markup_adult,.quote1_markup_adult, .quote1_markup_exadult, .quote1_markup_childbed, .quote1_markup_childwbed,.quote1_markup_infant,.quote1_markup_single ,.pricegst ,.gst_percentage ,.quote1_gst_adult,.quote1_gst_exadult,.quote1_gst_childbed,.quote1_gst_childwbed,.quote1_gst_infant,.quote1_gst_single ,.pricetcs ,.tcs_percentage ,.quote1_tcs_adult ,.quote1_tcs_exadult,.quote1_tcs_childbed,.quote1_tcs_childwbed,.quote1_tcs_infant,.quote1_tcs_single,.pricepgcharges ,.pgcharges_percentage , .quote1_pgcharges_adult,.quote1_pgcharges_exadult,.quote1_pgcharges_childbed,.quote1_pgcharges_childwbed,.quote1_pgcharges_infant,.quote1_pgcharges_single,.quote1_discount_adult_plus,.quote1_discount_exadult_minus,.quote1_discount_childbed_minus,.quote1_discount_childwbed_minus,.quote1_discount_infant_minus,.quote1_discount_single_minus ,.quote1_discount_adult_minus,.quote1_air_exadult,.quote1_cruise_exadult,.quote1_cruiseport_exadult,.quote1_cruisegratuity_exadult,.quote1_cruisegst_exadult,.quote1_hotel_exadult,.quote1_tours_exadult,.quote1_transfer_exadult,.quote1_visa_exadult,.quote1_inc_exadult,.quote1_meals_exadult,.quote1_additionalservice_exadult,.quote1_discount_exadult_plus,.quote1_air_childbed,.quote1_cruise_childbed,.quote1_cruiseport_childbed,.quote1_cruisegratuity_childbed,.quote1_cruisegst_childbed,.quote1_hotel_childbed,.quote1_tours_childbed,.quote1_transfer_childbed,.quote1_visa_childbed,.quote1_inc_childbed,.quote1_meals_childbed,.quote1_additionalservice_childbed,.quote1_discount_childbed_plus,.quote1_air_childwbed,.quote1_cruise_childwbed,.quote1_cruiseport_childwbed,.quote1_cruisegratuity_childwbed,.quote1_cruisegst_childwbed,.quote1_hotel_childwbed,.quote1_tours_childwbed,.quote1_transfer_childwbed,.quote1_visa_childwbed,.quote1_inc_childwbed,.quote1_meals_childwbed,.quote1_additionalservice_childwbed,.quote1_discount_childwbed_plus,.quote1_air_infant,.quote1_cruise_infant,.quote1_cruiseport_infant,.quote1_cruisegratuity_infant,.quote1_cruisegst_infant,.quote1_hotel_infant,.quote1_tours_infant,.quote1_transfer_infant,.quote1_visa_infant,.quote1_inc_infant,.quote1_meals_infant,.quote1_additionalservice_infant,.quote1_discount_infant_plus,.quote1_air_single,.quote1_cruise_single,.quote1_cruiseport_single,.quote1_cruisegratuity_single,.quote1_cruisegst_single,.quote1_hotel_single,.quote1_tours_single,.quote1_transfer_single,.quote1_visa_single,.quote1_inc_single,.quote1_meals_single,.quote1_additionalservice_single,.quote1_discount_single_plus,.pricediscountpositive,.discountpositive_percentage,.pricediscountnegative,.discountnegative_percentage,.coupon_percentage", function() {
		quote1_price('quote1_air_adult','quote1_cruise_adult','quote1_cruiseport_adult','quote1_cruisegratuity_adult','quote1_cruisegst_adult','quote1_hotel_adult','quote1_tours_adult','quote1_transfer_adult','quote1_visa_adult','quote1_inc_adult','quote1_meals_adult','quote1_additionalservice_adult','quote1_tourtotal_adult','quote1_tourtotal_exadult','quote1_tourtotal_childbed','quote1_tourtotal_childwbed','quote1_tourtotal_infant','quote1_tourtotal_single','pricemarkup','markup_percentage','quote1_markup_adult','quote1_markup_exadult','quote1_markup_childbed','quote1_markup_childwbed','quote1_markup_infant','quote1_markup_single','quote1_total_adult','quote1_discount_adult_plus','quote1_gross_total_adult','quote1_gross_total_exadult','quote1_gross_total_childbed','quote1_gross_total_childwbed','quote1_gross_total_infant','quote1_gross_total_single','quote1_gross_total_group','quote1_discount_adult_minus','quote1_discount_exadult_minus','quote1_discount_childbed_minus','quote1_discount_childwbed_minus','quote1_discount_infant_minus','quote1_discount_single_minus','pricegst','gst_percentage','quote1_gst_adult','quote1_gst_adult','quote1_gst_exadult','quote1_gst_childbed','quote1_gst_childwbed','quote1_gst_infant','quote1_gst_single','quote1_gst_group','quote1_gsttotal_adult','pricetcs','tcs_percentage','quote1_tcs_adult','quote1_tcs_exadult','quote1_tcs_childbed','quote1_tcs_childwbed','quote1_tcs_infant','quote1_tcs_single','quote1_tcs_group','quote1_tcstotal_adult','pricepgcharges','pgcharges_percentage','quote1_pgcharges_adult','quote1_pgcharges_exadult','quote1_pgcharges_childbed','quote1_pgcharges_childwbed','quote1_pgcharges_infant','quote1_pgcharges_single','quote1_pg_group','quote1_grand_adult','quote1_grand_adult_with_person','query_pricetopay','quote1_number_of_adult','quote1_number_of_extra_adult','quote1_number_of_child_with_bed','quote1_number_of_child_without_bed','quote1_number_of_infant','quote1_number_solo_traveller','quote1_grand_exadult_with_person','quote1_grand_childbed_with_person','quote1_grand_childwbed_with_person','quote1_grand_infant_with_person','quote1_grand_single_with_person','quote1_discount_group','quote1_gsttotal_exadult','quote1_gsttotal_childbed','quote1_gsttotal_childwbed','quote1_gsttotal_infant','quote1_gsttotal_single','quote1_tcstotal_exadult','quote1_tcstotal_childbed','quote1_tcstotal_childwbed','quote1_tcstotal_infant','quote1_tcstotal_single','quote1_air_exadult','quote1_cruise_exadult','quote1_cruiseport_exadult','quote1_cruisegratuity_exadult','quote1_cruisegst_exadult','quote1_hotel_exadult','quote1_tours_exadult','quote1_transfer_exadult','quote1_visa_exadult','quote1_inc_exadult','quote1_meals_exadult','quote1_additionalservice_exadult','quote1_discount_exadult_plus','quote1_grand_exadult','quote1_grand_childbed','quote1_grand_childwbed','quote1_grand_infant','quote1_grand_single','quote1_air_childbed','quote1_cruise_childbed','quote1_cruiseport_childbed','quote1_cruisegratuity_childbed','quote1_cruisegst_childbed','quote1_hotel_childbed','quote1_tours_childbed','quote1_transfer_childbed','quote1_visa_childbed','quote1_inc_childbed','quote1_meals_childbed','quote1_additionalservice_childbed','quote1_discount_childbed_plus','quote1_air_childwbed','quote1_cruise_childwbed','quote1_cruiseport_childwbed','quote1_cruisegratuity_childwbed','quote1_cruisegst_childwbed','quote1_hotel_childwbed','quote1_tours_childwbed','quote1_transfer_childwbed','quote1_visa_childwbed','quote1_inc_childwbed','quote1_meals_childwbed','quote1_additionalservice_childwbed','quote1_discount_childwbed_plus','quote1_air_infant','quote1_cruise_infant','quote1_cruiseport_infant','quote1_cruisegratuity_infant','quote1_cruisegst_infant','quote1_hotel_infant','quote1_tours_infant','quote1_transfer_infant','quote1_visa_infant','quote1_inc_infant','quote1_meals_infant','quote1_additionalservice_infant','quote1_discount_infant_plus','quote1_air_single','quote1_cruise_single','quote1_cruiseport_single','quote1_cruisegratuity_single','quote1_cruisegst_single','quote1_hotel_single','quote1_tours_single','quote1_transfer_single','quote1_visa_single','quote1_inc_single','quote1_meals_single','quote1_additionalservice_single','quote1_discount_single_plus','quote1_pricetopay','pricediscountpositive','discountpositive_percentage','pricediscountnegative','discountnegative_percentage','advance_payment','advance_payment_percentage','quote1_advance_payment','first_part_payment','first_part_percentage','quote1_first_part','second_part_payment','second_part_percentage','quote1_second_part','quote1_total_payment','show_part_payment','advance_payment_percentage','quote1_advance_payment','first_part_percentage','quote1_first_part','second_part_percentage','quote1_second_part','quote1_total_payment','coupon_percentage')
})*/

//$(document).ready(function() {
  // Define the event handler for specified fields
	$(document).on("keyup change",".quote1_air_adult , .quote1_cruise_adult , .quote1_cruiseport_adult , .quote1_cruisegratuity_adult , .quote1_cruisegst_adult , .quote1_hotel_adult , .quote1_tours_adult , .quote1_transfer_adult , .quote1_visa_adult , .quote1_inc_adult , .quote1_meals_adult , .quote1_additionalservice_adult ,.pricemarkup , .markup_percentage,.quote1_markup_adult,.quote1_markup_adult, .quote1_markup_exadult, .quote1_markup_childbed, .quote1_markup_childwbed,.quote1_markup_infant,.quote1_markup_single ,.pricegst ,.gst_percentage ,.quote1_gst_adult,.quote1_gst_exadult,.quote1_gst_childbed,.quote1_gst_childwbed,.quote1_gst_infant,.quote1_gst_single ,.pricetcs ,.tcs_percentage ,.quote1_tcs_adult ,.quote1_tcs_exadult,.quote1_tcs_childbed,.quote1_tcs_childwbed,.quote1_tcs_infant,.quote1_tcs_single,.pricepgcharges ,.pgcharges_percentage , .quote1_pgcharges_adult,.quote1_pgcharges_exadult,.quote1_pgcharges_childbed,.quote1_pgcharges_childwbed,.quote1_pgcharges_infant,.quote1_pgcharges_single,.quote1_discount_adult_plus,.quote1_discount_exadult_minus,.quote1_discount_childbed_minus,.quote1_discount_childwbed_minus,.quote1_discount_infant_minus,.quote1_discount_single_minus ,.quote1_discount_adult_minus,.quote1_air_exadult,.quote1_cruise_exadult,.quote1_cruiseport_exadult,.quote1_cruisegratuity_exadult,.quote1_cruisegst_exadult,.quote1_hotel_exadult,.quote1_tours_exadult,.quote1_transfer_exadult,.quote1_visa_exadult,.quote1_inc_exadult,.quote1_meals_exadult,.quote1_additionalservice_exadult,.quote1_discount_exadult_plus,.quote1_air_childbed,.quote1_cruise_childbed,.quote1_cruiseport_childbed,.quote1_cruisegratuity_childbed,.quote1_cruisegst_childbed,.quote1_hotel_childbed,.quote1_tours_childbed,.quote1_transfer_childbed,.quote1_visa_childbed,.quote1_inc_childbed,.quote1_meals_childbed,.quote1_additionalservice_childbed,.quote1_discount_childbed_plus,.quote1_air_childwbed,.quote1_cruise_childwbed,.quote1_cruiseport_childwbed,.quote1_cruisegratuity_childwbed,.quote1_cruisegst_childwbed,.quote1_hotel_childwbed,.quote1_tours_childwbed,.quote1_transfer_childwbed,.quote1_visa_childwbed,.quote1_inc_childwbed,.quote1_meals_childwbed,.quote1_additionalservice_childwbed,.quote1_discount_childwbed_plus,.quote1_air_infant,.quote1_cruise_infant,.quote1_cruiseport_infant,.quote1_cruisegratuity_infant,.quote1_cruisegst_infant,.quote1_hotel_infant,.quote1_tours_infant,.quote1_transfer_infant,.quote1_visa_infant,.quote1_inc_infant,.quote1_meals_infant,.quote1_additionalservice_infant,.quote1_discount_infant_plus,.quote1_air_single,.quote1_cruise_single,.quote1_cruiseport_single,.quote1_cruisegratuity_single,.quote1_cruisegst_single,.quote1_hotel_single,.quote1_tours_single,.quote1_transfer_single,.quote1_visa_single,.quote1_inc_single,.quote1_meals_single,.quote1_additionalservice_single,.quote1_discount_single_plus,.pricediscountpositive,.discountpositive_percentage,.pricediscountnegative,.discountnegative_percentage,.coupon_percentage", function() {
		// Call the quote1_price function
		quote1_price('quote1_air_adult','quote1_cruise_adult','quote1_cruiseport_adult','quote1_cruisegratuity_adult','quote1_cruisegst_adult','quote1_hotel_adult','quote1_tours_adult','quote1_transfer_adult','quote1_visa_adult','quote1_inc_adult','quote1_meals_adult','quote1_additionalservice_adult','quote1_tourtotal_adult','quote1_tourtotal_exadult','quote1_tourtotal_childbed','quote1_tourtotal_childwbed','quote1_tourtotal_infant','quote1_tourtotal_single','pricemarkup','markup_percentage','quote1_markup_adult','quote1_markup_exadult','quote1_markup_childbed','quote1_markup_childwbed','quote1_markup_infant','quote1_markup_single','quote1_total_adult','quote1_discount_adult_plus','quote1_gross_total_adult','quote1_gross_total_exadult','quote1_gross_total_childbed','quote1_gross_total_childwbed','quote1_gross_total_infant','quote1_gross_total_single','quote1_gross_total_group','quote1_discount_adult_minus','quote1_discount_exadult_minus','quote1_discount_childbed_minus','quote1_discount_childwbed_minus','quote1_discount_infant_minus','quote1_discount_single_minus','pricegst','gst_percentage','quote1_gst_adult','quote1_gst_adult','quote1_gst_exadult','quote1_gst_childbed','quote1_gst_childwbed','quote1_gst_infant','quote1_gst_single','quote1_gst_group','quote1_gsttotal_adult','pricetcs','tcs_percentage','quote1_tcs_adult','quote1_tcs_exadult','quote1_tcs_childbed','quote1_tcs_childwbed','quote1_tcs_infant','quote1_tcs_single','quote1_tcs_group','quote1_tcstotal_adult','pricepgcharges','pgcharges_percentage','quote1_pgcharges_adult','quote1_pgcharges_exadult','quote1_pgcharges_childbed','quote1_pgcharges_childwbed','quote1_pgcharges_infant','quote1_pgcharges_single','quote1_pg_group','quote1_grand_adult','quote1_grand_adult_with_person','query_pricetopay','quote1_number_of_adult','quote1_number_of_extra_adult','quote1_number_of_child_with_bed','quote1_number_of_child_without_bed','quote1_number_of_infant','quote1_number_solo_traveller','quote1_grand_exadult_with_person','quote1_grand_childbed_with_person','quote1_grand_childwbed_with_person','quote1_grand_infant_with_person','quote1_grand_single_with_person','quote1_discount_group','quote1_gsttotal_exadult','quote1_gsttotal_childbed','quote1_gsttotal_childwbed','quote1_gsttotal_infant','quote1_gsttotal_single','quote1_tcstotal_exadult','quote1_tcstotal_childbed','quote1_tcstotal_childwbed','quote1_tcstotal_infant','quote1_tcstotal_single','quote1_air_exadult','quote1_cruise_exadult','quote1_cruiseport_exadult','quote1_cruisegratuity_exadult','quote1_cruisegst_exadult','quote1_hotel_exadult','quote1_tours_exadult','quote1_transfer_exadult','quote1_visa_exadult','quote1_inc_exadult','quote1_meals_exadult','quote1_additionalservice_exadult','quote1_discount_exadult_plus','quote1_grand_exadult','quote1_grand_childbed','quote1_grand_childwbed','quote1_grand_infant','quote1_grand_single','quote1_air_childbed','quote1_cruise_childbed','quote1_cruiseport_childbed','quote1_cruisegratuity_childbed','quote1_cruisegst_childbed','quote1_hotel_childbed','quote1_tours_childbed','quote1_transfer_childbed','quote1_visa_childbed','quote1_inc_childbed','quote1_meals_childbed','quote1_additionalservice_childbed','quote1_discount_childbed_plus','quote1_air_childwbed','quote1_cruise_childwbed','quote1_cruiseport_childwbed','quote1_cruisegratuity_childwbed','quote1_cruisegst_childwbed','quote1_hotel_childwbed','quote1_tours_childwbed','quote1_transfer_childwbed','quote1_visa_childwbed','quote1_inc_childwbed','quote1_meals_childwbed','quote1_additionalservice_childwbed','quote1_discount_childwbed_plus','quote1_air_infant','quote1_cruise_infant','quote1_cruiseport_infant','quote1_cruisegratuity_infant','quote1_cruisegst_infant','quote1_hotel_infant','quote1_tours_infant','quote1_transfer_infant','quote1_visa_infant','quote1_inc_infant','quote1_meals_infant','quote1_additionalservice_infant','quote1_discount_infant_plus','quote1_air_single','quote1_cruise_single','quote1_cruiseport_single','quote1_cruisegratuity_single','quote1_cruisegst_single','quote1_hotel_single','quote1_tours_single','quote1_transfer_single','quote1_visa_single','quote1_inc_single','quote1_meals_single','quote1_additionalservice_single','quote1_discount_single_plus','quote1_pricetopay','pricediscountpositive','discountpositive_percentage','pricediscountnegative','discountnegative_percentage','advance_payment','advance_payment_percentage','quote1_advance_payment','first_part_payment','first_part_percentage','quote1_first_part','second_part_payment','second_part_percentage','quote1_second_part','quote1_total_payment','show_part_payment','advance_payment_percentage','quote1_advance_payment','first_part_percentage','quote1_first_part','second_part_percentage','quote1_second_part','quote1_total_payment','coupon_percentage');
	});
	
	// quote1_price calculation
	function quote1_price(a1,a2,a3,a4,a5,a6,a7,a8,a9,a10,a11,a12,a13,a14,a15,a16,a17,a18,a19,a20,a21,a22,a23,a24,a25,a26,a27,a28,a29,a30,a31,a32,a33,a34,a35,a36,a37,a38,a39,a40,a41,a42,a43,a44,a45,a46,a47,a48,a49,a50,a51,a52,a53,a54,a55,a56,a57,a58,a59,a60,a61,a62,a63,a64,a65,a66,a67,a68,a69,a70,a71,a72,a73,a74,a75,a76,a77,a78,a79,a80,a81,a82,a83,a84,a85,a86,a87,a88,a89,a90,a91,a92,a93,a94,a95,a96,a97,a98,a99,a100,a101,a102,a103,a104,a105,a106,a107,a108,a109,a110,a111,a112,a113,a114,a115,a116,a117,a118,a119,a120,a121,a122,a123,a124,a125,a126,a127,a128,a129,a130,a131,a132,a133,a134,a135,a136,a137,a138,a139,a140,a141,a142,a143,a144,a145,a146,a147,a148,a149,a150,a151,a152,a153,a154,a155,a156,a157,a158,a159,a160,a161,a162,a163,a164,a165,a166,a167,a168,a169,a170,a171,a172,a173,a174,a175,a176,a177,a178,a179,a180,a181,a182,a183,a184,a185,a186,a187,a188,a189,a190) {
		var air=$("."+a1).val();
			if(air=='')
			{
				air=0;
			}
			var cruise =$("."+a2).val();
			if(cruise=='')
			{
				cruise=0;
			}
			var port=$("."+a3).val();
			if(port=='')
			{
				port=0;
			}
			var gratuity=$("."+a4).val();
			if(gratuity=='')
			{
				gratuity=0;
			}
			var cruisegst=$("."+a5).val();
			if(cruisegst=='')
			{
				cruisegst=0;
			}
			var accommodation=$("."+a6).val();
			if(accommodation=='')
			{
				accommodation=0;
			}
			var sightseeing=$("."+a7).val();
			if(sightseeing=='')
			{
				sightseeing=0;
			}
			var transfer=$("."+a8).val();
			if(transfer=='')
			{
				transfer=0;
			}
			var visa=$("."+a9).val();
			if(visa=='')
			{
				visa=0;
			}
			var inc=$("."+a10).val();
			if(inc=='')
			{
				inc=0;
			}
			var meals=$("."+a11).val();
			if(meals=='')
			{
				meals=0;
			}
			var additionalservice=$("."+a12).val();
			if(additionalservice=='')
			{
				additionalservice=0;
			}
			//total 13
			$("."+a13).val('').val(Math.round(air)+Math.round(cruise)+Math.round(port)+Math.round(gratuity)+Math.round(cruisegst)+Math.round(additionalservice)+Math.round(accommodation)+Math.round(sightseeing)+Math.round(transfer)+Math.round(visa)+Math.round(inc)+Math.round(meals))
	      //
	      var air_exadult=$("."+a97).val();
			if(air_exadult=='')
			{
				air_exadult=0;
			}
			var cruise_exadult =$("."+a98).val();
			if(cruise_exadult=='')
			{
				cruise_exadult=0;
			}
			var port_exadult=$("."+a99).val();
			if(port_exadult=='')
			{
				port_exadult=0;
			}
			var gratuity_exadult=$("."+a100).val();
			if(gratuity_exadult=='')
			{
				gratuity_exadult=0;
			}
			var cruisegst_exadult=$("."+a101).val();
			if(cruisegst_exadult=='')
			{
				cruisegst_exadult=0;
			}
			var accommodation_exadult=$("."+a102).val();
			if(accommodation_exadult=='')
			{
				accommodation_exadult=0;
			}
			var sightseeing_exadult=$("."+a103).val();
			if(sightseeing_exadult=='')
			{
				sightseeing_exadult=0;
			}
			var transfer_exadult=$("."+a104).val();
			if(transfer_exadult=='')
			{
				transfer_exadult=0;
			}
			var visa_exadult=$("."+a105).val();
			if(visa_exadult=='')
			{
				visa_exadult=0;
			}
			var inc_exadult=$("."+a106).val();
			if(inc_exadult=='')
			{
				inc_exadult=0;
			}
			var meals_exadult=$("."+a107).val();
			if(meals_exadult=='')
			{
				meals_exadult=0;
			}
			var additionalservice_exadult=$("."+a108).val();
			if(additionalservice_exadult=='')
			{
				additionalservice_exadult=0;
			}
			//total 14
			$("."+a14).val('').val(Math.round(air_exadult)+Math.round(cruise_exadult)+Math.round(port_exadult)+Math.round(gratuity_exadult)+Math.round(cruisegst_exadult)+Math.round(additionalservice_exadult)+Math.round(accommodation_exadult)+Math.round(sightseeing_exadult)+Math.round(transfer_exadult)+Math.round(visa_exadult)+Math.round(inc_exadult)+Math.round(meals_exadult))
	      //
	      var air_childbed=$("."+a115).val();
			if(air_childbed=='')
			{
				air_childbed=0;
			}
			var cruise_childbed =$("."+a116).val();
			if(cruise_childbed=='')
			{
				cruise_childbed=0;
			}
			var port_childbed=$("."+a117).val();
			if(port_childbed=='')
			{
				port_childbed=0;
			}
			var gratuity_childbed=$("."+a118).val();
			if(gratuity_childbed=='')
			{
				gratuity_childbed=0;
			}
			var cruisegst_childbed=$("."+a119).val();
			if(cruisegst_childbed=='')
			{
				cruisegst_childbed=0;
			}
			var accommodation_childbed=$("."+a120).val();
			if(accommodation_childbed=='')
			{
				accommodation_childbed=0;
			}
			var sightseeing_childbed=$("."+a121).val();
			if(sightseeing_childbed=='')
			{
				sightseeing_childbed=0;
			}
			var transfer_childbed=$("."+a122).val();
			if(transfer_childbed=='')
			{
				transfer_childbed=0;
			}
			var visa_childbed=$("."+a123).val();
			if(visa_childbed=='')
			{
				visa_childbed=0;
			}
			var inc_childbed=$("."+a124).val();
			if(inc_childbed=='')
			{
				inc_childbed=0;
			}
			var meals_childbed=$("."+a125).val();
			if(meals_childbed=='')
			{
				meals_childbed=0;
			}
			var additionalservice_childbed=$("."+a126).val();
			if(additionalservice_childbed=='')
			{
				additionalservice_childbed=0;
			}
			//total 15
			$("."+a15).val('').val(Math.round(air_childbed)+Math.round(cruise_childbed)+Math.round(port_childbed)+Math.round(gratuity_childbed)+Math.round(cruisegst_childbed)+Math.round(additionalservice_childbed)+Math.round(accommodation_childbed)+Math.round(sightseeing_childbed)+Math.round(transfer_childbed)+Math.round(visa_childbed)+Math.round(inc_childbed)+Math.round(meals_childbed))
			  //
	      var air_childwbed=$("."+a128).val();
			if(air_childwbed=='')
			{
				air_childwbed=0;
			}
			var cruise_childwbed =$("."+a129).val();
			if(cruise_childwbed=='')
			{
				cruise_childwbed=0;
			}
			var port_childwbed=$("."+a130).val();
			if(port_childwbed=='')
			{
				port_childwbed=0;
			}
			var gratuity_childwbed=$("."+a131).val();
			if(gratuity_childwbed=='')
			{
				gratuity_childwbed=0;
			}
			var cruisegst_childwbed=$("."+a132).val();
			if(cruisegst_childwbed=='')
			{
				cruisegst_childwbed=0;
			}
			var accommodation_childwbed=$("."+a133).val();
			if(accommodation_childwbed=='')
			{
				accommodation_childwbed=0;
			}
			var sightseeing_childwbed=$("."+a134).val();
			if(sightseeing_childwbed=='')
			{
				sightseeing_childwbed=0;
			}
			var transfer_childwbed=$("."+a135).val();
			if(transfer_childwbed=='')
			{
				transfer_childwbed=0;
			}
			var visa_childwbed=$("."+a136).val();
			if(visa_childwbed=='')
			{
				visa_childwbed=0;
			}
			var inc_childwbed=$("."+a137).val();
			if(inc_childwbed=='')
			{
				inc_childwbed=0;
			}
			var meals_childwbed=$("."+a138).val();
			if(meals_childwbed=='')
			{
				meals_childwbed=0;
			}
			var additionalservice_childwbed=$("."+a139).val();
			if(additionalservice_childwbed=='')
			{
				additionalservice_childwbed=0;
			}
			//total 16
			$("."+a16).val('').val(Math.round(air_childwbed)+Math.round(cruise_childwbed)+Math.round(port_childwbed)+Math.round(gratuity_childwbed)+Math.round(cruisegst_childwbed)+Math.round(additionalservice_childwbed)+Math.round(accommodation_childwbed)+Math.round(sightseeing_childwbed)+Math.round(transfer_childwbed)+Math.round(visa_childwbed)+Math.round(inc_childwbed)+Math.round(meals_childwbed))
	       //
	      var air_infant=$("."+a141).val();
			if(air_infant=='')
			{
				air_infant=0;
			}
			var cruise_infant =$("."+a142).val();
			if(cruise_infant=='')
			{
				cruise_infant=0;
			}
			var port_infant=$("."+a143).val();
			if(port_infant=='')
			{
				port_infant=0;
			}
			var gratuity_infant=$("."+a144).val();
			if(gratuity_infant=='')
			{
				gratuity_infant=0;
			}
			var cruisegst_infant=$("."+a145).val();
			if(cruisegst_infant=='')
			{
				cruisegst_infant=0;
			}
			var accommodation_infant=$("."+a146).val();
			if(accommodation_infant=='')
			{
				accommodation_infant=0;
			}
			var sightseeing_infant=$("."+a147).val();
			if(sightseeing_infant=='')
			{
				sightseeing_infant=0;
			}
			var transfer_infant=$("."+a148).val();
			if(transfer_infant=='')
			{
				transfer_infant=0;
			}
			var visa_infant=$("."+a149).val();
			if(visa_infant=='')
			{
				visa_infant=0;
			}
			var inc_infant=$("."+a150).val();
			if(inc_infant=='')
			{
				inc_infant=0;
			}
			var meals_infant=$("."+a151).val();
			if(meals_infant=='')
			{
				meals_infant=0;
			}
			var additionalservice_infant=$("."+a152).val();
			if(additionalservice_infant=='')
			{
				additionalservice_infant=0;
			}
			//total 17
			$("."+a17).val('').val(Math.round(air_infant)+Math.round(cruise_infant)+Math.round(port_infant)+Math.round(gratuity_infant)+Math.round(cruisegst_infant)+Math.round(additionalservice_infant)+Math.round(accommodation_infant)+Math.round(sightseeing_infant)+Math.round(transfer_infant)+Math.round(visa_infant)+Math.round(inc_infant)+Math.round(meals_infant))
			 //
	      var air_single=$("."+a154).val();
			if(air_single=='')
			{
				air_single=0;
			}
			var cruise_single =$("."+a155).val();
			if(cruise_single=='')
			{
				cruise_single=0;
			}
			var port_single=$("."+a156).val();
			if(port_single=='')
			{
				port_single=0;
			}
			var gratuity_single=$("."+a157).val();
			if(gratuity_single=='')
			{
				gratuity_single=0;
			}
			var cruisegst_single=$("."+a158).val();
			if(cruisegst_single=='')
			{
				cruisegst_single=0;
			}
			var accommodation_single=$("."+a159).val();
			if(accommodation_single=='')
			{
				accommodation_single=0;
			}
			var sightseeing_single=$("."+a160).val();
			if(sightseeing_single=='')
			{
				sightseeing_single=0;
			}
			var transfer_single=$("."+a161).val();
			if(transfer_single=='')
			{
				transfer_single=0;
			}
			var visa_single=$("."+a162).val();
			if(visa_single=='')
			{
				visa_single=0;
			}
			var inc_single=$("."+a163).val();
			if(inc_single=='')
			{
				inc_single=0;
			}
			var meals_single=$("."+a164).val();
			if(meals_single=='')
			{
				meals_single=0;
			}
			var additionalservice_single=$("."+a165).val();
			if(additionalservice_single=='')
			{
				additionalservice_single=0;
			}
			//total 17
			$("."+a18).val('').val(Math.round(air_single)+Math.round(cruise_single)+Math.round(port_single)+Math.round(gratuity_single)+Math.round(cruisegst_single)+Math.round(additionalservice_single)+Math.round(accommodation_single)+Math.round(sightseeing_single)+Math.round(transfer_single)+Math.round(visa_single)+Math.round(inc_single)+Math.round(meals_single))
			var markup=$("."+a19).val();
			if(markup==1)
			{
			}
			else if(markup==2)
			{
		var percentage_markup=$("."+a20).val();
		if(percentage_markup!='') {
		var tourtotal_adult=$("."+a13).val();
		var tourtotal_exadult=$("."+a14).val();
		var tourtotal_childbed=$("."+a15).val();
		var tourtotal_childwbed=$("."+a16).val();
		var tourtotal_infant=$("."+a17).val();
		var tourtotal_single=$("."+a18).val();
	  if(tourtotal_adult!='')
	   {
	   	var markup_percentage_into_total_adult=tourtotal_adult*percentage_markup/100;
	   		$("."+a21).val('').val(Math.round(markup_percentage_into_total_adult))
	   }
	   if(tourtotal_exadult!='')
	   {
	   	var markup_percentage_into_total_exadult=tourtotal_exadult*percentage_markup/100;
	   		$("."+a22).val('').val(Math.round(markup_percentage_into_total_exadult))
	   }
	   if(tourtotal_childbed!='')
	   {
	   	var markup_percentage_into_total_childbed=tourtotal_childbed*percentage_markup/100;
	   		$("."+a23).val('').val(Math.round(markup_percentage_into_total_childbed))
	   }
	   if(tourtotal_childwbed!='')
	   {
	   	var markup_percentage_into_total_childwbed=tourtotal_childwbed*percentage_markup/100;
	   		$("."+a24).val('').val(Math.round(markup_percentage_into_total_childwbed))
	   }
	   if(tourtotal_infant!='')
	   {
	   	var markup_percentage_into_total_infant=tourtotal_infant*percentage_markup/100;
	   		$("."+a25).val('').val(Math.round(markup_percentage_into_total_infant))
	   }
	   if(tourtotal_single!='')
	   {
	   	var markup_percentage_into_total_single=tourtotal_single*percentage_markup/100;
	   		$("."+a26).val('').val(Math.round(markup_percentage_into_total_single))
	   }
	   }
		}
		//for discount plus
		var pricediscountpositive=$("."+a168).val();
			if(pricediscountpositive==1)
			{
			}
			else if(pricediscountpositive==0)
			{
			$("."+a28).val('').val(0)
	   	$("."+a109).val('').val(0)
	   	$("."+a127).val('').val(0)
	   	$("."+a140).val('').val(0)
	   	$("."+a153).val('').val(0)
	   	$("."+a166).val('').val(0)	
			}
			else if(pricediscountpositive==2)
			{
		var discountpositive_percentage=$("."+a169).val();
		if(discountpositive_percentage!='') {
	   var tourtotal_adult=$("."+a13).val();
		var tourtotal_exadult=$("."+a14).val();
		var tourtotal_childbed=$("."+a15).val();
		var tourtotal_childwbed=$("."+a16).val();
		var tourtotal_infant=$("."+a17).val();
		var tourtotal_single=$("."+a18).val();
		//
	  var markuptotal_adult=$("."+a21).val();
		var markuptotal_exadult=$("."+a22).val();
		var markuptotal_childbed=$("."+a23).val();
		var markuptotal_childwbed=$("."+a24).val();
		var markuptotal_infant=$("."+a25).val();
		var markuptotal_single=$("."+a26).val();
		//
		var total_tour_with_markup_adult=0;
		var total_tour_with_markup_exadult=0;
		var total_tour_with_markup_childbed=0;
		var total_tour_with_markup_childwbed=0;
		var total_tour_with_markup_infant=0;
		var total_tour_with_markup_single=0;
		if(tourtotal_adult!='')
		{
		var total_tour_with_markup_adult=Math.round(total_tour_with_markup_adult)+Math.round(tourtotal_adult)
		}
		if(markuptotal_adult!='')
		{
		var total_tour_with_markup_adult=Math.round(total_tour_with_markup_adult)+Math.round(markuptotal_adult)
		}
		if(tourtotal_exadult!='')
		{
		var total_tour_with_markup_exadult=Math.round(total_tour_with_markup_exadult)+Math.round(tourtotal_exadult)
		}
		if(markuptotal_exadult!='')
		{
		var total_tour_with_markup_exadult=Math.round(total_tour_with_markup_exadult)+Math.round(markuptotal_exadult)
		}
		if(tourtotal_childbed!='')
		{
		var total_tour_with_markup_childbed=Math.round(total_tour_with_markup_childbed)+Math.round(tourtotal_childbed)
		}
		if(markuptotal_childbed!='')
		{
		var total_tour_with_markup_childbed=Math.round(total_tour_with_markup_childbed)+Math.round(markuptotal_childbed)
		}
		if(tourtotal_childwbed!='')
		{
		var total_tour_with_markup_childwbed=Math.round(total_tour_with_markup_childwbed)+Math.round(tourtotal_childwbed)
		}
		if(markuptotal_childwbed!='')
		{
		var total_tour_with_markup_childwbed=Math.round(total_tour_with_markup_childwbed)+Math.round(markuptotal_childwbed)
		}
		if(tourtotal_infant!='')
		{
		var total_tour_with_markup_infant=Math.round(total_tour_with_markup_infant)+Math.round(tourtotal_infant)
		}
		if(markuptotal_infant!='')
		{
		var total_tour_with_markup_infant=Math.round(total_tour_with_markup_infant)+Math.round(markuptotal_infant)
		}
		if(tourtotal_single!='')
		{
		var total_tour_with_markup_single=Math.round(total_tour_with_markup_single)+Math.round(tourtotal_single)
		}
		if(markuptotal_single!='')
		{
		var total_tour_with_markup_single=Math.round(total_tour_with_markup_single)+Math.round(markuptotal_single)
		}
		var discount_plus_total_adult=total_tour_with_markup_adult*discountpositive_percentage/100;
	   	$("."+a28).val('').val(Math.round(discount_plus_total_adult))
	   	var discount_plus_total_exadult=total_tour_with_markup_exadult*discountpositive_percentage/100;
	   	$("."+a109).val('').val(Math.round(discount_plus_total_exadult))
	   	var discount_plus_total_childbed=total_tour_with_markup_childbed*discountpositive_percentage/100;
	   	$("."+a127).val('').val(Math.round(discount_plus_total_childbed))
	   	var discount_plus_total_childwbed=total_tour_with_markup_childwbed*discountpositive_percentage/100;
	   	$("."+a140).val('').val(Math.round(discount_plus_total_childwbed))
	   	var discount_plus_total_infant=total_tour_with_markup_infant*discountpositive_percentage/100;
	   	$("."+a153).val('').val(Math.round(discount_plus_total_infant))
	   	var discount_plus_total_single=total_tour_with_markup_single*discountpositive_percentage/100;
	   	$("."+a166).val('').val(Math.round(discount_plus_total_single))
		//
	   }
		} else if(pricediscountpositive==3) {
			$("."+a28).val('').val(0)
	   	$("."+a109).val('').val(0)
	   	$("."+a127).val('').val(0)
	   	$("."+a140).val('').val(0)
	   	$("."+a153).val('').val(0)
	   	$("."+a166).val('').val(0)
	  }

		//for gross total
		var gross_total=0;
	  var tourtotal_adult=$("."+a13).val();
		if(tourtotal_adult!='') {
			var gross_total=Math.round(gross_total)+Math.round(tourtotal_adult)
		}

		var markup_profit_adult=$("."+a21).val();
	  if(markup_profit_adult!='') {
	  	var gross_total=Math.round(gross_total)+Math.round(markup_profit_adult)
	  }
	  
	  var discount_adult_plus=$("."+a28).val();
	  if(discount_adult_plus!='') {
	  	var gross_total=Math.round(gross_total)+Math.round(discount_adult_plus)
	  }
	  
	  $("."+a29).val('').val(Math.round(gross_total))
	  var gross_total_exa=0;
	  var tourtotal_exadult=$("."+a14).val();
		if(tourtotal_exadult!='') {
		var gross_total_exa=Math.round(gross_total_exa)+Math.round(tourtotal_exadult)
		}

		var markup_profit_exadult=$("."+a22).val();
	  if(markup_profit_exadult!='') {
	   	var gross_total_exa=Math.round(gross_total_exa)+Math.round(markup_profit_exadult)
	  }

	  var discount_exadult_plus=$("."+a109).val();
	  if(discount_exadult_plus!='') {
	  	var gross_total_exa=Math.round(gross_total_exa)+Math.round(discount_exadult_plus)
	  }

	  $("."+a30).val('').val(Math.round(gross_total_exa))
	  var gross_total_childbed=0;
	  var tourtotal_childbed=$("."+a15).val();
		if(tourtotal_childbed!='') {
		var gross_total_childbed=Math.round(gross_total_childbed)+Math.round(tourtotal_childbed)
		}

		var markup_profit_childbed=$("."+a23).val();
	  if(markup_profit_childbed!='') {
	   	var gross_total_childbed=Math.round(gross_total_childbed)+Math.round(markup_profit_childbed)
	  }

	  var discount_childbed_plus=$("."+a127).val();
	  if(discount_childbed_plus!='') {
	  	var gross_total_childbed=Math.round(gross_total_childbed)+Math.round(discount_childbed_plus)
	  }
	  
	  $("."+a31).val('').val(Math.round(gross_total_childbed))
	  var gross_total_childwbed=0;
	  var tourtotal_childwbed=$("."+a16).val();
		if(tourtotal_childwbed!='') {
		var gross_total_childwbed=Math.round(gross_total_childwbed)+Math.round(tourtotal_childwbed)
		}
		
		var markup_profit_childwbed=$("."+a24).val();
	  if(markup_profit_childwbed!='') {
	  	var gross_total_childwbed=Math.round(gross_total_childwbed)+Math.round(markup_profit_childwbed)
	  }

	  var discount_childwbed_plus=$("."+a140).val();
	  if(discount_childwbed_plus!='') {
	  	var gross_total_childwbed=Math.round(gross_total_childwbed)+Math.round(discount_childwbed_plus)
	  }

	  $("."+a32).val('').val(Math.round(gross_total_childwbed))
	  var gross_total_infant=0;
	  var tourtotal_infant=$("."+a17).val();
		if(tourtotal_infant!='') {
		var gross_total_infant=Math.round(gross_total_infant)+Math.round(tourtotal_infant)
		}
		
		var markup_profit_infant=$("."+a25).val();
	  if(markup_profit_infant!='') {
	  	var gross_total_infant=Math.round(gross_total_infant)+Math.round(markup_profit_infant)
	  }

	  var discount_infant_plus=$("."+a153).val();
	  if(discount_infant_plus!='') {
	  	var gross_total_infant=Math.round(gross_total_infant)+Math.round(discount_infant_plus)
	  }

	  $("."+a33).val('').val(Math.round(gross_total_infant))
	  var gross_total_single=0;
	  var tourtotal_single=$("."+a18).val();
		if(tourtotal_single!='') {
		var gross_total_single=Math.round(gross_total_single)+Math.round(tourtotal_single)
		}

		var markup_profit_single=$("."+a26).val();
	  if(markup_profit_single!='') {
	  	var gross_total_single=Math.round(gross_total_single)+Math.round(markup_profit_single)
	  }

	  var discount_single_plus=$("."+a166).val();
	  if(discount_single_plus!='') {
	  	var gross_total_single=Math.round(gross_total_single)+Math.round(discount_single_plus)
	  }

	  $("."+a34).val('').val(Math.round(gross_total_single))
		
		//for gross group
	  var number_of_adult=$("."+a75).val();
	  var number_of_extra_adult=$("."+a76).val();
	  var number_of_child_with_bed=$("."+a77).val();
	  var number_of_child_without_bed=$("."+a78).val();
	  var number_of_infant=$("."+a79).val();
	  var number_solo_traveller=$("."+a80).val();
	  var gross_total_adult=$("."+a29).val();
	  var gross_total_exadult=$("."+a30).val();
	  var gross_total_childbed=$("."+a31).val();
	  var gross_total_childwbed=$("."+a32).val();
	  var gross_total_infant=$("."+a33).val();
	  var gross_total_single=$("."+a34).val();
	  var gross_group=0;
	  if(gross_total_adult!='' && number_of_adult!='') {
	  	var gross_group=Math.round(gross_group)+Math.round(gross_total_adult*number_of_adult)
	  }

	  if(gross_total_exadult!='' && number_of_extra_adult!='') {
	  	 var gross_group=Math.round(gross_group)+Math.round(gross_total_exadult*number_of_extra_adult)
	  }

	  if(gross_total_childbed!='' && number_of_child_with_bed!='') {
	   	 var gross_group=Math.round(gross_group)+Math.round(gross_total_childbed*number_of_child_with_bed)
	  }
	  
	  if(gross_total_childwbed!='' && number_of_child_without_bed!='') {
	   	 var gross_group=Math.round(gross_group)+Math.round(gross_total_childwbed*number_of_child_without_bed)
	  }
	  
	  if(gross_total_infant!='' && number_of_infant!='') {
	   	 var gross_group=Math.round(gross_group)+Math.round(gross_total_infant*number_of_infant)
	  }
	  
	  if(gross_total_single!='' && number_solo_traveller!='') {
	   	 var gross_group=Math.round(gross_group)+Math.round(gross_total_single*number_solo_traveller)
	  }
	  
	  $("."+a35).val('').val(Math.round(gross_group))
	  
	  //for discount minus
	  var pricediscountnegative=$("."+a170).val();
			if(pricediscountnegative==1)
			{
			}
			else if(pricediscountnegative==0)
			{
		$("."+a36).val('').val(0)
	   	$("."+a37).val('').val(0)
	   	$("."+a38).val('').val(0)
	   	$("."+a39).val('').val(0)
	   	$("."+a40).val('').val(0)
	   	$("."+a41).val('').val(0) 
			}
			else if(pricediscountnegative==2 || pricediscountnegative==3)
			{
		if(pricediscountnegative==2)
		{
		var discountnegative_percentage=$("."+a171).val();
		}
		else
		{
		var coupon_id=$('option:selected', "."+a190).attr('coupon_id')
		$(".coupon_id").val('').val(coupon_id);

		var discountnegative_percentage=$("."+a190).val();	
		}

		if(discountnegative_percentage!='') {
			var grosstotal_adult=$("."+a29).val();
			var grosstotal_exadult=$("."+a30).val();
			var grosstotal_childbed=$("."+a31).val();
			var grosstotal_childwbed=$("."+a32).val();
			var grosstotal_infant=$("."+a33).val();
			var grosstotal_single=$("."+a34).val();
			//
			var total_discount_with_gross_adult=0;
			var total_discount_with_gross_exadult=0;
			var total_discount_with_gross_childbed=0;
			var total_discount_with_gross_childwbed=0;
			var total_discount_with_gross_infant=0;
			var total_discount_with_gross_single=0;
			if(grosstotal_adult!='')
			{
			var total_discount_with_gross_adult=Math.round(total_discount_with_gross_adult)+Math.round(grosstotal_adult)
			}
			if(grosstotal_exadult!='')
			{
			var total_discount_with_gross_exadult=Math.round(total_discount_with_gross_exadult)+Math.round(grosstotal_exadult)
			}
			if(grosstotal_childbed!='')
			{
			var total_discount_with_gross_childbed=Math.round(total_discount_with_gross_childbed)+Math.round(grosstotal_childbed)
			}
			if(grosstotal_childwbed!='')
			{
			var total_discount_with_gross_childwbed=Math.round(total_discount_with_gross_childwbed)+Math.round(grosstotal_childwbed)
			}
			if(grosstotal_infant!='')
			{
			var total_discount_with_gross_infant=Math.round(total_discount_with_gross_infant)+Math.round(grosstotal_infant)
			}
			if(grosstotal_single!='')
			{
			var total_discount_with_gross_single=Math.round(total_discount_with_gross_single)+Math.round(grosstotal_single)
			}
			var divide_val=Math.round(discountnegative_percentage)+Math.round(100);	
		   
			var discount_minus_total_adult=total_discount_with_gross_adult*discountnegative_percentage/divide_val;
		   	$("."+a36).val('').val(Math.round(discount_minus_total_adult))
		   	var discount_minus_total_exadult=total_discount_with_gross_exadult*discountnegative_percentage/divide_val;
		   	$("."+a37).val('').val(Math.round(discount_minus_total_exadult))
		   	var discount_minus_total_childbed=total_discount_with_gross_childbed*discountnegative_percentage/divide_val;
		   	$("."+a38).val('').val(Math.round(discount_minus_total_childbed))
		   	var discount_minus_total_childwbed=total_discount_with_gross_childwbed*discountnegative_percentage/divide_val;
		   	$("."+a39).val('').val(Math.round(discount_minus_total_childwbed))
		   	var discount_minus_total_infant=total_discount_with_gross_infant*discountnegative_percentage/divide_val;
		   	$("."+a40).val('').val(Math.round(discount_minus_total_infant))
		   	var discount_minus_total_single=total_discount_with_gross_single*discountnegative_percentage/divide_val;
		   	$("."+a41).val('').val(Math.round(discount_minus_total_single))
		  }
		}

		//	for discount group
		 var discount_adult_minus=$("."+a36).val();
	   var discount_exadult_minus=$("."+a37).val();
	   var discount_childbed_minus=$("."+a38).val();
	   var discount_childwbed_minus=$("."+a39).val();
	   var discount_infant_minus=$("."+a40).val();
	   var discount_single_minus=$("."+a41).val();
	   var number_of_adult=$("."+a75).val();
	   var number_of_extra_adult=$("."+a76).val();
	   var number_of_child_with_bed=$("."+a77).val();
	   var number_of_child_without_bed=$("."+a78).val();
	   var number_of_infant=$("."+a79).val();
	   var number_solo_traveller=$("."+a80).val();
	   var discount_group=0;
	   if(discount_adult_minus!='' && number_of_adult!='')
	   {
	   	 var discount_group=Math.round(discount_group)+Math.round(discount_adult_minus*number_of_adult)
	   }
	   if(discount_exadult_minus!='' && number_of_extra_adult!='')
	   {
	   	 var discount_group=Math.round(discount_group)+Math.round(discount_exadult_minus*number_of_extra_adult)
	   }
	   if(discount_childbed_minus!='' && number_of_child_with_bed!='')
	   {
	   	 var discount_group=Math.round(discount_group)+Math.round(discount_childbed_minus*number_of_child_with_bed)
	   }
	   if(discount_childwbed_minus!='' && number_of_child_without_bed!='')
	   {
	   	 var discount_group=Math.round(discount_group)+Math.round(discount_childwbed_minus*number_of_child_without_bed)
	   }
	   if(discount_infant_minus!='' && number_of_infant!='')
	   {
	   	 var discount_group=Math.round(discount_group)+Math.round(discount_infant_minus*number_of_infant)
	   }
	   if(discount_single_minus!='' && number_solo_traveller!='')
	   {
	   	 var discount_group=Math.round(discount_group)+Math.round(discount_single_minus*number_solo_traveller)
	   }
	    $("."+a86).val('').val(Math.round(discount_group))
		//for gst claculation
		var gst=$("."+a42).val();
			if(gst==1)
			{
			}
			else if(gst==2)
			{
		var percentage_gst=$("."+a43).val();
		if(percentage_gst!='') {
	   var gross_total_adult=$("."+a29).val();
	   var gross_total_exadult=$("."+a30).val();
	   var gross_total_childbed=$("."+a31).val();
	   var gross_total_childwbed=$("."+a32).val();
	   var gross_total_infant=$("."+a33).val();
	   var gross_total_single=$("."+a34).val();
	  	var discount_adult_minus=$("."+a36).val();
	   var discount_exadult_minus=$("."+a37).val();
	   var discount_childbed_minus=$("."+a38).val();
	   var discount_childwbed_minus=$("."+a39).val();
	   var discount_infant_minus=$("."+a40).val();
	   var discount_single_minus=$("."+a41).val()
	   if(gross_total_adult!='')
	   {
	   	if(discount_adult_minus!='')
	   	{
	   		var amount_after_minus_adult=Math.round(gross_total_adult)-Math.round(discount_adult_minus)
	   	}
	   	else
	   	{
	    var amount_after_minus_adult=Math.round(gross_total_adult)
	   	}
	   	var gst_percentage_into_total_adult=amount_after_minus_adult*percentage_gst/100;
	   		$("."+a44).val('').val(Math.round(gst_percentage_into_total_adult))
	   }
	  	if(gross_total_exadult!='')
	   {
	   	if(discount_exadult_minus!='')
	   	{
	   		var amount_after_minus_exadult=Math.round(gross_total_exadult)-Math.round(discount_exadult_minus)
	   	}
	   	else
	   	{
	    var amount_after_minus_exadult=Math.round(gross_total_exadult)
	   	}
	   	var gst_percentage_into_total_exadult=amount_after_minus_exadult*percentage_gst/100;
	   		$("."+a46).val('').val(Math.round(gst_percentage_into_total_exadult))
	   }
	   if(gross_total_childbed!='')
	   {
	   	if(discount_childbed_minus!='')
	   	{
	   		var amount_after_minus_childbed=Math.round(gross_total_childbed)-Math.round(discount_childbed_minus)
	   	}
	   	else
	   	{
	    var amount_after_minus_childbed=Math.round(gross_total_childbed)
	   	}
	   	var gst_percentage_into_total_childbed=amount_after_minus_childbed*percentage_gst/100;
	   		$("."+a47).val('').val(Math.round(gst_percentage_into_total_childbed))
	   }
	   if(gross_total_childwbed!='')
	   {
	   	if(discount_childwbed_minus!='')
	   	{
	   		var amount_after_minus_childwbed=Math.round(gross_total_childwbed)-Math.round(discount_childwbed_minus)
	   	}
	   	else
	   	{
	    var amount_after_minus_childwbed=Math.round(gross_total_childwbed)
	   	}
	   	var gst_percentage_into_total_childwbed=amount_after_minus_childwbed*percentage_gst/100;
	   		$("."+a48).val('').val(Math.round(gst_percentage_into_total_childwbed))
	   }
	   if(gross_total_infant!='')
	   {
	   	if(discount_infant_minus!='')
	   	{
	   		var amount_after_minus_infant=Math.round(gross_total_infant)-Math.round(discount_infant_minus)
	   	}
	   	else
	   	{
	    var amount_after_minus_infant=Math.round(gross_total_infant)
	   	}
	   	var gst_percentage_into_total_infant=amount_after_minus_infant*percentage_gst/100;
	   		$("."+a49).val('').val(Math.round(gst_percentage_into_total_infant))
	   }
	    if(gross_total_single!='')
	   {
	   	if(discount_single_minus!='')
	   	{
	   		var amount_after_minus_single=Math.round(gross_total_single)-Math.round(discount_single_minus)
	   	}
	   	else
	   	{
	    var amount_after_minus_single=Math.round(gross_total_single)
	   	}
	   	var gst_percentage_into_total_single=amount_after_minus_single*percentage_gst/100;
	   		$("."+a50).val('').val(Math.round(gst_percentage_into_total_single))
	   }
	   }
	  }
	  
	  //for gst group
	  var gst_adult=$("."+a44).val();
	  var gst_exadult=$("."+a46).val();
	  var gst_childbed=$("."+a47).val();
	  var gst_childwbed=$("."+a48).val();
	  var gst_infant=$("."+a49).val();
	  var gst_single=$("."+a50).val();
	    var number_of_adult=$("."+a75).val();
	  var number_of_extra_adult=$("."+a76).val();
	  var number_of_child_with_bed=$("."+a77).val();
	  var number_of_child_without_bed=$("."+a78).val();
	  var number_of_infant=$("."+a79).val();
	  var number_solo_traveller=$("."+a80).val();
	  var gst_group=0;
	  if(gst_adult!='' && number_of_adult!='') {
	   	 var gst_group=Math.round(gst_group)+Math.round(gst_adult*number_of_adult)
	  }
	  
	  if(gst_exadult!='' && number_of_extra_adult!='') {
	   	 var gst_group=Math.round(gst_group)+Math.round(gst_exadult*number_of_extra_adult)
	  }
	  
	  if(gst_childbed!='' && number_of_child_with_bed!='') {
	   	 var gst_group=Math.round(gst_group)+Math.round(gst_childbed*number_of_child_with_bed)
	  }
	  
	  if(gst_childwbed!='' && number_of_child_without_bed!='') {
	   	 var gst_group=Math.round(gst_group)+Math.round(gst_childwbed*number_of_child_without_bed)
	  }
	  
	  if(gst_infant!='' && number_of_infant!='') {
	   	 var gst_group=Math.round(gst_group)+Math.round(gst_infant*number_of_infant)
	  }
	  
	  if(gst_single!='' && number_solo_traveller!='') {
	   	 var gst_group=Math.round(gst_group)+Math.round(gst_single*number_solo_traveller)
	  }
	    $("."+a51).val('').val(Math.round(gst_group))
	  
	  //for gst total
		var gst_total_adult=0;
	   var gross_adult=$("."+a29).val();
		if(gross_adult!='') {
		var gst_total_adult=Math.round(gst_total_adult)+Math.round(gross_adult)
		}

		var discount_minius_adult=$("."+a36).val();
	   if(discount_minius_adult!='')
	   {
	   	var gst_total_adult=Math.round(gst_total_adult)-Math.round(discount_minius_adult)
	   }
	    var gst_adult=$("."+a44).val();
	   if(gst_adult!='')
	   {
	   	var gst_total_adult=Math.round(gst_total_adult)+Math.round(gst_adult)
	   }
	  $("."+a52).val('').val(Math.round(gst_total_adult))
	  var gst_total_exadult=0;
	   var gross_exadult=$("."+a30).val();
		if(gross_exadult!='') {
		var gst_total_exadult=Math.round(gst_total_exadult)+Math.round(gross_exadult)
		}

		var discount_minius_exadult=$("."+a37).val();
	   if(discount_minius_exadult!='')
	   {
	   	var gst_total_exadult=Math.round(gst_total_exadult)-Math.round(discount_minius_exadult)
	   }
	    var gst_exadult=$("."+a46).val();
	   if(gst_exadult!='')
	   {
	   	var gst_total_exadult=Math.round(gst_total_exadult)+Math.round(gst_exadult)
	   }
	  $("."+a87).val('').val(Math.round(gst_total_exadult))
	  
	  //
	   var gst_total_childbed=0;
	   var gross_childbed=$("."+a31).val();
		if(gross_childbed!='') {
		var gst_total_childbed=Math.round(gst_total_childbed)+Math.round(gross_childbed)
		}

		var discount_minius_childbed=$("."+a38).val();
	   if(discount_minius_childbed!='')
	   {
	   	var gst_total_childbed=Math.round(gst_total_childbed)-Math.round(discount_minius_childbed)
	   }
	    var gst_childbed=$("."+a47).val();
	   if(gst_childbed!='')
	   {
	   	var gst_total_childbed=Math.round(gst_total_childbed)+Math.round(gst_childbed)
	   }
	  $("."+a88).val('').val(Math.round(gst_total_childbed))
	   var gst_total_childwbed=0;
	   var gross_childwbed=$("."+a32).val();
		if(gross_childwbed!='') {
		var gst_total_childwbed=Math.round(gst_total_childwbed)+Math.round(gross_childwbed)
		}

		var discount_minius_childwbed=$("."+a39).val();
	   if(discount_minius_childwbed!='')
	   {
	   	var gst_total_childwbed=Math.round(gst_total_childwbed)-Math.round(discount_minius_childwbed)
	   }
	    var gst_childwbed=$("."+a48).val();
	   if(gst_childwbed!='')
	   {
	   	var gst_total_childwbed=Math.round(gst_total_childwbed)+Math.round(gst_childwbed)
	   }
	  $("."+a89).val('').val(Math.round(gst_total_childwbed))
	    var gst_total_infant=0;
	   var gross_infant=$("."+a33).val();
		if(gross_infant!='') {
		var gst_total_infant=Math.round(gst_total_infant)+Math.round(gross_infant)
		}

		var discount_minius_infant=$("."+a40).val();
	   if(discount_minius_infant!='')
	   {
	   	var gst_total_infant=Math.round(gst_total_infant)-Math.round(discount_minius_infant)
	   }
	    var gst_infant=$("."+a49).val();
	   if(gst_infant!='')
	   {
	   	var gst_total_infant=Math.round(gst_total_infant)+Math.round(gst_infant)
	   }
	  $("."+a90).val('').val(Math.round(gst_total_infant))
	    var gst_total_single=0;
	   var gross_single=$("."+a34).val();
		if(gross_single!='') {
		var gst_total_single=Math.round(gst_total_single)+Math.round(gross_single)
		}

		var discount_minius_single=$("."+a41).val();
	   if(discount_minius_single!='')
	   {
	   	var gst_total_single=Math.round(gst_total_single)-Math.round(discount_minius_single)
	   }
	    var gst_single=$("."+a50).val();
	   if(gst_single!='')
	   {
	   	var gst_total_single=Math.round(gst_total_single)+Math.round(gst_single)
	   }
	  $("."+a91).val('').val(Math.round(gst_total_single))
	  
	  //for tcs claculation
		var tcs=$("."+a53).val();
		if(tcs==1) {
		} else if(tcs==2) {
				var tcs_percentage=$("."+a54).val();
				if(tcs_percentage!='') {
			  var gst_total_adult=$("."+a52).val();
			  var gst_total_exadult=$("."+a87).val();
			  var gst_total_childbed=$("."+a88).val();
			  var gst_total_childwbed=$("."+a89).val();
			  var gst_total_infant=$("."+a90).val();
			  var gst_total_single=$("."+a91).val();
			  if(gst_total_adult!='')
		   {
		   	var tcs_percentage_into_total_adult=gst_total_adult*tcs_percentage/100;
		   	$("."+a55).val('').val(Math.round(tcs_percentage_into_total_adult))
		   }
		  if(gst_total_exadult!='')
		   {
		   	var tcs_percentage_into_total_exadult=gst_total_exadult*tcs_percentage/100;
		   	$("."+a56).val('').val(Math.round(tcs_percentage_into_total_exadult))
		   }
		   if(gst_total_childbed!='')
		   {
		   	var tcs_percentage_into_total_childbed=gst_total_childbed*tcs_percentage/100;
		   	$("."+a57).val('').val(Math.round(tcs_percentage_into_total_childbed))
		   }
		   if(gst_total_childwbed!='')
		   {
		   	var tcs_percentage_into_total_childwbed=gst_total_childwbed*tcs_percentage/100;
		   	$("."+a58).val('').val(Math.round(tcs_percentage_into_total_childwbed))
		   }
		   if(gst_total_infant!='')
		   {
		   	var tcs_percentage_into_total_infant=gst_total_infant*tcs_percentage/100;
		   	$("."+a59).val('').val(Math.round(tcs_percentage_into_total_infant))
		   }
		    if(gst_total_single!='')
		   {
		   	var tcs_percentage_into_total_single=gst_total_single*tcs_percentage/100;
		   	$("."+a60).val('').val(Math.round(tcs_percentage_into_total_single))
		   }
		   }
	  }
	  
	  //for tcs group
	  var tcs_adult=$("."+a55).val();
	  var tcs_exadult=$("."+a56).val();
	  var tcs_childbed=$("."+a57).val();
	  var tcs_childwbed=$("."+a58).val();
	  var tcs_infant=$("."+a59).val();
	  var tcs_single=$("."+a60).val();
	  var number_of_adult=$("."+a75).val();
	  var number_of_extra_adult=$("."+a76).val();
	  var number_of_child_with_bed=$("."+a77).val();
	  var number_of_child_without_bed=$("."+a78).val();
	  var number_of_infant=$("."+a79).val();
	  var number_solo_traveller=$("."+a80).val();
	  var tcs_group=0;
	  if(tcs_adult!='' && number_of_adult!='') {
	  	var tcs_group=Math.round(tcs_group)+Math.round(tcs_adult*number_of_adult)
	  }
	  if(tcs_exadult!='' && number_of_extra_adult!='')
	  {
	  	var tcs_group=Math.round(tcs_group)+Math.round(tcs_exadult*number_of_extra_adult)
	  }
	  if(tcs_childbed!='' && number_of_child_with_bed!='')
	  {
	  	var tcs_group=Math.round(tcs_group)+Math.round(tcs_childbed*number_of_child_with_bed)
	  }
	  if(tcs_childwbed!='' && number_of_child_without_bed!='')
	  {
	  	var tcs_group=Math.round(tcs_group)+Math.round(tcs_childwbed*number_of_child_without_bed)
	  }
	  if(tcs_infant!='' && number_of_infant!='')
	  {
	  	var tcs_group=Math.round(tcs_group)+Math.round(tcs_infant*number_of_infant)
	  }
	  if(tcs_single!='' && number_solo_traveller!='')
	  {
	  	var tcs_group=Math.round(tcs_group)+Math.round(tcs_single*number_solo_traveller)
	  }
	  $("."+a61).val('').val(Math.round(tcs_group))
		
		//for tcs total
		var tcs_total_adult=0;
	   var gst_adult=$("."+a52).val();
		if(gst_adult!='') {
		var tcs_total_adult=Math.round(tcs_total_adult)+Math.round(gst_adult)
		}
	    var tcs_adult=$("."+a55).val();
	   if(tcs_adult!='')
	   {
	   	var tcs_total_adult=Math.round(tcs_total_adult)+Math.round(tcs_adult)
	   }
	  $("."+a62).val('').val(Math.round(tcs_total_adult))
	  
	  var tcs_total_exadult=0;
	   var gst_exadult=$("."+a87).val();
		if(gst_exadult!='') {
		var tcs_total_exadult=Math.round(tcs_total_exadult)+Math.round(gst_exadult)
		}
	    var tcs_exadult=$("."+a56).val();
	   if(tcs_exadult!='')
	   {
	   	var tcs_total_exadult=Math.round(tcs_total_exadult)+Math.round(tcs_exadult)
	   }
	  $("."+a92).val('').val(Math.round(tcs_total_exadult))
	   var tcs_total_childbed=0;
	   var gst_childbed=$("."+a88).val();
		
		if(gst_childbed!='') {
		var tcs_total_childbed=Math.round(tcs_total_childbed)+Math.round(gst_childbed)
		}
	    var tcs_childbed=$("."+a57).val();
	   if(tcs_childbed!='')
	   {
	   	var tcs_total_childbed=Math.round(tcs_total_childbed)+Math.round(tcs_childbed)
	   }
	  $("."+a93).val('').val(Math.round(tcs_total_childbed))
	   var tcs_total_childwbed=0;
	   var gst_childwbed=$("."+a89).val();
		
		if(gst_childwbed!='') {
		var tcs_total_childwbed=Math.round(tcs_total_childwbed)+Math.round(gst_childwbed)
		}
	    var tcs_childwbed=$("."+a58).val();
	   if(tcs_childwbed!='')
	   {
	   	var tcs_total_childwbed=Math.round(tcs_total_childwbed)+Math.round(tcs_childwbed)
	   }
	  $("."+a94).val('').val(Math.round(tcs_total_childwbed))
	   var tcs_total_infant=0;
	   var gst_infant=$("."+a90).val();
		
		if(gst_infant!='') {
		var tcs_total_infant=Math.round(tcs_total_infant)+Math.round(gst_infant)
		}
	    var tcs_infant=$("."+a59).val();
	   if(tcs_infant!='')
	   {
	   	var tcs_total_infant=Math.round(tcs_total_infant)+Math.round(tcs_infant)
	   }
	  $("."+a95).val('').val(Math.round(tcs_total_infant))
	  
	  var tcs_total_single=0;
	   var gst_single=$("."+a91).val();
		if(gst_single!='') {
		var tcs_total_single=Math.round(tcs_total_single)+Math.round(gst_single)
		}
	    var tcs_single=$("."+a60).val();
	   if(tcs_single!='')
	   {
	   	var tcs_total_single=Math.round(tcs_total_single)+Math.round(tcs_single)
	   }
	  $("."+a96).val('').val(Math.round(tcs_total_single))
	  
	  //for pg charge claculation
		var pricepgcharges=$("."+a63).val();
		if(pricepgcharges==1) {
		} else if(pricepgcharges==2) {
			var pg_percentage=$("."+a64).val();
			if(pg_percentage!='') {
		  var tcs_total_adult=$("."+a62).val();
		  var tcs_total_exadult=$("."+a92).val();
		  var tcs_total_childbed=$("."+a93).val();
		  var tcs_total_childwbed=$("."+a94).val();
		  var tcs_total_infant=$("."+a95).val();
		  var tcs_total_single=$("."+a96).val();
		  if(tcs_total_adult!='') {
		  	var pg_percentage_into_total_adult=tcs_total_adult*pg_percentage/100;
		   	$("."+a65).val('').val(Math.round(pg_percentage_into_total_adult))
		  }
		  if(tcs_total_exadult!='') {
		   	var pg_percentage_into_total_exadult=tcs_total_exadult*pg_percentage/100;
		   	$("."+a66).val('').val(Math.round(pg_percentage_into_total_exadult))
		  }
		  if(tcs_total_childbed!='')  {
		   	var pg_percentage_into_total_childbed=tcs_total_childbed*pg_percentage/100;
		   	$("."+a67).val('').val(Math.round(pg_percentage_into_total_childbed))
		  }
		  if(tcs_total_childwbed!='') {
		   	var pg_percentage_into_total_childwbed=tcs_total_childwbed*pg_percentage/100;
		   	$("."+a68).val('').val(Math.round(pg_percentage_into_total_childwbed))
		  }
		  if(tcs_total_infant!='') {
		   	var pg_percentage_into_total_infant=tcs_total_infant*pg_percentage/100;
		   	$("."+a69).val('').val(Math.round(pg_percentage_into_total_infant))
		  }
		  if(tcs_total_single!='') {
		   	var pg_percentage_into_total_single=tcs_total_single*pg_percentage/100;
		   	$("."+a70).val('').val(Math.round(pg_percentage_into_total_single))
		  }
		  }
	  }

	  //for pg group
	  var pg_adult=$("."+a65).val();
	  var pg_exadult=$("."+a66).val();
	  var pg_childbed=$("."+a67).val();
	  var pg_childwbed=$("."+a68).val();
	  var pg_infant=$("."+a69).val();
	  var pg_single=$("."+a70).val();
	  var number_of_adult=$("."+a75).val();
	  var number_of_extra_adult=$("."+a76).val();
	  var number_of_child_with_bed=$("."+a77).val();
	  var number_of_child_without_bed=$("."+a78).val();
	  var number_of_infant=$("."+a79).val();
	  var number_solo_traveller=$("."+a80).val();
	  var pg_group=0;
	  if(pg_adult!='' && number_of_adult!='') {
	   	 var pg_group=Math.round(pg_group)+Math.round(pg_adult*number_of_adult)
	   }
	   if(pg_exadult!='' && number_of_extra_adult!='')
	   {
	   	 var pg_group=Math.round(pg_group)+Math.round(pg_exadult*number_of_extra_adult)
	   }
	   if(pg_childbed!='' && number_of_child_with_bed!='')
	   {
	   	 var pg_group=Math.round(pg_group)+Math.round(pg_childbed*number_of_child_with_bed)
	   }
	   if(pg_childwbed!='' && number_of_child_without_bed!='')
	   {
	   	 var pg_group=Math.round(pg_group)+Math.round(pg_childwbed*number_of_child_without_bed)
	   }
	   if(pg_infant!='' && number_of_infant!='')
	   {
	   	 var pg_group=Math.round(pg_group)+Math.round(pg_infant*number_of_infant)
	   }
	   if(pg_single!='' && number_solo_traveller!='')
	   {
	   	 var pg_group=Math.round(pg_group)+Math.round(pg_single*number_solo_traveller)
	   }
	    $("."+a71).val('').val(Math.round(pg_group))

	  //for grand total
		var grand_total_adult=0;
	  var total_tcs_adult=$("."+a62).val();
		if(total_tcs_adult!='') {
		var grand_total_adult=Math.round(grand_total_adult)+Math.round(total_tcs_adult)
		}

	  var pg_total_adult=$("."+a65).val();
	  if(pg_total_adult!='') {
	   	var grand_total_adult=Math.round(grand_total_adult)+Math.round(pg_total_adult)
	  }

	  $("."+a72).val('').val(Math.round(grand_total_adult))
	  var grand_total_exadult=0;
	  var total_tcs_exadult=$("."+a92).val();
	  if(total_tcs_exadult!='') {
		var grand_total_exadult=Math.round(grand_total_exadult)+Math.round(total_tcs_exadult)
		}

	  var pg_total_exadult=$("."+a66).val();
	   if(pg_total_exadult!='')
	   {
	   	var grand_total_exadult=Math.round(grand_total_exadult)+Math.round(pg_total_exadult)
	   }
		$("."+a110).val('').val(Math.round(grand_total_exadult))
	 	var grand_total_childbed=0;
	  var total_tcs_childbed=$("."+a93).val();
	  if(total_tcs_childbed!='') {
		var grand_total_childbed=Math.round(grand_total_childbed)+Math.round(total_tcs_childbed)
		}

	  var pg_total_childbed=$("."+a67).val();
	   if(pg_total_childbed!='')
	   {
	   	var grand_total_childbed=Math.round(grand_total_childbed)+Math.round(pg_total_childbed)
	   }
		$("."+a111).val('').val(Math.round(grand_total_childbed))
	 	var grand_total_childwbed=0;
	  var total_tcs_childwbed=$("."+a94).val();
	  if(total_tcs_childwbed!='') {
		var grand_total_childwbed=Math.round(grand_total_childwbed)+Math.round(total_tcs_childwbed)
		}

	  var pg_total_childwbed=$("."+a68).val();
	   if(pg_total_childwbed!='')
	   {
	   	var grand_total_childwbed=Math.round(grand_total_childwbed)+Math.round(pg_total_childwbed)
	   }
		$("."+a112).val('').val(Math.round(grand_total_childwbed))
	 	var grand_total_infant=0;
	  var total_tcs_infant=$("."+a95).val();
	  if(total_tcs_infant!='') {
		var grand_total_infant=Math.round(grand_total_infant)+Math.round(total_tcs_infant)
		}

	  var pg_total_infant=$("."+a69).val();
	   if(pg_total_infant!='')
	   {
	   	var grand_total_infant=Math.round(grand_total_infant)+Math.round(pg_total_infant)
	   }
		$("."+a113).val('').val(Math.round(grand_total_infant))
		var grand_total_single=0;
	  var total_tcs_single=$("."+a96).val();
	  if(total_tcs_single!='') {
		var grand_total_single=Math.round(grand_total_single)+Math.round(total_tcs_single)
		}

	  var pg_total_single=$("."+a70).val();
	   if(pg_total_single!='')
	   {
	   	var grand_total_single=Math.round(grand_total_single)+Math.round(pg_total_single)
	   }
		$("."+a114).val('').val(Math.round(grand_total_single))

	   //for total per number of guest
		var total_number_of_guest_according_adult=0;
		var total_number_of_guest_according_exadult=0;
		var total_number_of_guest_according_childbed=0;
		var total_number_of_guest_according_childwbed=0;
		var total_number_of_guest_according_infant=0;
		var total_number_of_guest_according_single=0;
	   var grand_total_adult=$("."+a72).val();
	   var grand_total_exadult=$("."+a110).val();
	   var grand_total_childbed=$("."+a111).val();
	   var grand_total_childwbed=$("."+a112).val();
	   var grand_total_infant=$("."+a113).val();
	    var grand_total_single=$("."+a114).val();
	   var number_of_adult=$("."+a75).val();
	   var number_of_extra_adult=$("."+a76).val();
	   var number_of_child_with_bed=$("."+a77).val();
	   var number_of_child_without_bed=$("."+a78).val();
	   var number_of_infant=$("."+a79).val();
	   var number_solo_traveller=$("."+a80).val();
		if(grand_total_adult!='' && number_of_adult!='') {
		var total_number_of_guest_according_adult=Math.round(total_number_of_guest_according_adult)+Math.round(grand_total_adult*number_of_adult)
		}

	  $("."+a73).val('').val(Math.round(total_number_of_guest_according_adult))
	  if(grand_total_exadult!='' && number_of_extra_adult!='') {
		var total_number_of_guest_according_exadult=Math.round(total_number_of_guest_according_exadult)+Math.round(grand_total_exadult*number_of_extra_adult)
		}

		$("."+a81).val('').val(Math.round(total_number_of_guest_according_exadult))
		if(grand_total_childbed!='' && number_of_child_with_bed!='') {
		var total_number_of_guest_according_childbed=Math.round(total_number_of_guest_according_childbed)+Math.round(grand_total_childbed*number_of_child_with_bed)
		}

		$("."+a82).val('').val(Math.round(total_number_of_guest_according_childbed))
	  if(grand_total_childwbed!='' && number_of_child_without_bed!='') {
		var total_number_of_guest_according_childwbed=Math.round(total_number_of_guest_according_childwbed)+Math.round(grand_total_childwbed*number_of_child_without_bed)
		}

		$("."+a83).val('').val(Math.round(total_number_of_guest_according_childwbed))
		if(grand_total_infant!='' && number_of_infant!='') {
		var total_number_of_guest_according_infant=Math.round(total_number_of_guest_according_infant)+Math.round(grand_total_infant*number_of_infant)
		}

		$("."+a84).val('').val(Math.round(total_number_of_guest_according_infant))
		if(grand_total_single!='' && number_solo_traveller!='') {
		var total_number_of_guest_according_single=Math.round(total_number_of_guest_according_single)+Math.round(grand_total_single*number_solo_traveller)
		}

		$("."+a85).val('').val(Math.round(total_number_of_guest_according_single))

		//for price to pay
		var price_to_pay=0;
		if($("."+a73).val()!='') {
		var price_to_pay=Math.round(price_to_pay)+Math.round($("."+a73).val())
		}
		if($("."+a81).val()!='') {
		var price_to_pay=Math.round(price_to_pay)+Math.round($("."+a81).val())
		}
		if($("."+a82).val()!='') {
		var price_to_pay=Math.round(price_to_pay)+Math.round($("."+a82).val())
		}
		if($("."+a83).val()!='') {
		var price_to_pay=Math.round(price_to_pay)+Math.round($("."+a83).val())
		}
		if($("."+a84).val()!='') {
		var price_to_pay=Math.round(price_to_pay)+Math.round($("."+a84).val())
		}
		if($("."+a85).val()!='') {
		var price_to_pay=Math.round(price_to_pay)+Math.round($("."+a85).val())
		}
		$("."+a167).val('').val(Math.round(price_to_pay))
		$("."+a189).val('').val(Math.round(price_to_pay))

		var ischecked = $("."+a182).is(':checked');
		// if(ischecked)
		// {

		if(price_to_pay=='') {
			price_to_pay=0;
		}
		var advance_payment_percentage=$("."+a183).val();

		if(advance_payment_percentage=='') {

	  $("."+a183).val('').val(100)
	  $("."+a184).val('').val(price_to_pay)
		} else {
		var advance_into_total=price_to_pay*advance_payment_percentage/100;
	  $("."+a184).val('').val(Math.round(advance_into_total))
		}
		var first_part_percentage=$("."+a185).val();

		if(first_part_percentage!='') {
	 	var first_payment_bal=price_to_pay*first_part_percentage/100;
	  $("."+a186).val('').val(Math.round(first_payment_bal))
		}
	  var second_part_percentage=$("."+a187).val();

		if(second_part_percentage!='') {
	 	var second_payment_bal=price_to_pay*second_part_percentage/100;
	  $("."+a188).val('').val(Math.round(second_payment_bal))
		}
	}
//});

/*----------*//*----------*/

/*$("#show_part_payment").change(function () {
    var ischecked = $(this).is(':checked');
    var quote1_pricetopay=$('.quote1_pricetopay').val();
    if(quote1_pricetopay=='')
    {
    	quote1_pricetopay=0;
    }
    if (ischecked) {
    	$(".quote1_advance_payment").attr('readonly','')
        jQuery('.part_payment').each(function(){
       $(this).css('display', 'block');
        $('.advance_payment_percentage').val('').val(100)
        $('.quote1_advance_payment').val('').val(quote1_pricetopay)
        $('.first_part_percentage').val('')
        $('.quote1_first_part').val('')
        $('.second_part_percentage').val('')
        $('.quote1_second_part').val('')
         $('.quote1_total_payment').val('').val(quote1_pricetopay)
        $(".first_part_percentage").attr('readonly','')
        $(".second_part_percentage").attr('readonly','')
        })
    } else {
    	 jQuery('.part_payment').each(function(){
       $(this).css('display', 'none');
        })
    }
});

$(document).on("focusout change",".advance_payment_percentage",function(){
	var quote1_pricetopay=$('.quote1_pricetopay').val();
	if(quote1_pricetopay=='')
	{
		quote1_pricetopay=0
	}
	var advance_payment_percentage=$('.advance_payment_percentage').val();
	var first_part_percentage=$('.first_part_percentage').val();
	var second_part_percentage=$('.second_part_percentage').val();
	var total_percentage=0
	var first_last_percentage=0
	if(advance_payment_percentage!='')
	{
		
	total_percentage=Math.round(total_percentage)+Math.round(advance_payment_percentage)
	}
	if(first_part_percentage!='')
	{
		total_percentage=Math.round(total_percentage)+Math.round(first_part_percentage)
	}
	if(second_part_percentage!='')
	{
		total_percentage=Math.round(total_percentage)+Math.round(second_part_percentage)
	}
	if(total_percentage>100)
	{
	$("#quote1_advance_payment_percentage").html('').html('Percentage Cannot be greater than 100%')
	setTimeout(function() {
	  $('#quote1_advance_payment_percentage').html('');
	}, 1000);

	$('.advance_payment_percentage').val('').val(100)
	$('.first_part_percentage').val('')
	$('.second_part_percentage').val('')
	$('.quote1_advance_payment').val('').val(quote1_pricetopay)
	$('.quote1_first_part').val('')
	$('.quote1_second_part').val('')

	}
	else
	{
	 $(".first_part_percentage").attr('readonly','')	
	if(advance_payment_percentage!='' && advance_payment_percentage<100)
	{

	$('.quote1_advance_payment').val('').val(Math.round(advance_payment_percentage*quote1_pricetopay/100))

		var first_part_percentage=100-advance_payment_percentage;
	 $(".first_part_percentage").removeAttr('readonly','')
	 $('.first_part_percentage').val('').val(first_part_percentage)
	 $('.quote1_first_part').val('').val(Math.round(first_part_percentage*quote1_pricetopay/100))
	 $('.second_part_percentage').val('')
	 $('.quote1_second_part').val('')
	}
	else if(advance_payment_percentage=='' || advance_payment_percentage==0)
	{
	$('.advance_payment_percentage').val('').val(100)
	$('.first_part_percentage').val('')
	$('.second_part_percentage').val('')
	$('.quote1_advance_payment').val('').val(quote1_pricetopay)
	$('.quote1_first_part').val('')
	$('.quote1_second_part').val('')
	}

	}
})

$(document).on("focusout change",".first_part_percentage",function(){
	var quote1_pricetopay=$('.quote1_pricetopay').val();
	if(quote1_pricetopay=='')
	{
		quote1_pricetopay=0
	}
	var advance_payment_percentage=$('.advance_payment_percentage').val();
	var first_part_percentage=$('.first_part_percentage').val();
	var second_part_percentage=$('.second_part_percentage').val();
	var total_percentage=0
	var first_last_percentage=0
	if(advance_payment_percentage!='')
	{
		
	total_percentage=Math.round(total_percentage)+Math.round(advance_payment_percentage)
	}
	if(first_part_percentage!='')
	{
		total_percentage=Math.round(total_percentage)+Math.round(first_part_percentage)
	}
	if(second_part_percentage!='')
	{
		total_percentage=Math.round(total_percentage)+Math.round(second_part_percentage)
	}
	if(total_percentage>100)
	{


	$("#first_part_percentage").html('').html('Percentage Cannot be greater than 100%')
	setTimeout(function() {
	  $('#first_part_percentage').html('');
	}, 1000);

	var first_part_percentage_custom=100-advance_payment_percentage;

	$('.first_part_percentage').val('').val(100-advance_payment_percentage)
	$('.second_part_percentage').val('')

	$('.quote1_first_part').val('').val(Math.round(quote1_pricetopay*first_part_percentage_custom/100))
	$('.quote1_second_part').val('')

	}
	else
	{

	if(first_part_percentage!='')
	{


	 var second_part_percentage=100-advance_payment_percentage-first_part_percentage;
	 $(".first_part_percentage").removeAttr('readonly','')
	 $('.first_part_percentage').val('').val(first_part_percentage)
	 $('.quote1_first_part').val('').val(Math.round(first_part_percentage*quote1_pricetopay/100))
	 $('.second_part_percentage').val('').val(second_part_percentage)
	 $('.quote1_second_part').val('').val(Math.round(second_part_percentage*quote1_pricetopay/100))
	}
	else if(advance_payment_percentage=='' || advance_payment_percentage==0)
	{
	var first_part_percentage_custom=100-advance_payment_percentag;
	$('.first_part_percentage').val('').val(100-advance_payment_percentage)
	$('.second_part_percentage').val('')

	$('.quote1_first_part').val('').val(Math.round(quote1_pricetopay*first_part_percentage_custom/100))
	$('.quote1_second_part').val('')
	}

	}
})

//direct payment
jQuery("#show_direct_part").change(function () {
    var ischecked = $(this).is(':checked');
    if (ischecked) {
       $(".direct_part").css('display', 'block');
    } else {
    	$(".direct_part").css('display', 'none');
    }
});*/

/*$(document).ready(function() {
	// Event handler for the "show_part_payment" checkbox change event
	$("#show_part_payment").change(function() {
	    var ischecked = $(this).is(':checked'); // Check if the checkbox is checked
	    var quote1_pricetopay = $('.quote1_pricetopay').val(); // Get the value of "quote1_pricetopay"

	    // If "quote1_pricetopay" is empty, set it to 0
	    if (quote1_pricetopay === '') {
	        quote1_pricetopay = 0;
	    }

	    if (ischecked) {
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
	            $(".first_part_percentage").attr('readonly', ''); // Make first part percentage readonly
	            $(".second_part_percentage").attr('readonly', ''); // Make second part percentage readonly
	        });
	    } else {
	        // When the checkbox is unchecked, hide all elements with the "part_payment" class
	        jQuery('.part_payment').each(function() {
	            $(this).css('display', 'none');
	        });
	    }
	});

  // Event handler for focusout and change events on .advance_payment_percentage
  $(document).on("focusout change", ".advance_payment_percentage", function() {
        var quote1_pricetopay = $('.quote1_pricetopay').val(); // Get the total price to pay
        if (quote1_pricetopay === '') {
            quote1_pricetopay = 0;
        }

        var advance_payment_percentage = $('.advance_payment_percentage').val(); // Get advance payment percentage
        var first_part_percentage = $('.first_part_percentage').val(); // Get first part percentage
        var second_part_percentage = $('.second_part_percentage').val(); // Get second part percentage
        var total_percentage = 0; // Initialize total percentage

        // Calculate total percentage from the entered values
        if (advance_payment_percentage !== '') {
            total_percentage += Math.round(advance_payment_percentage);
        }
        if (first_part_percentage !== '') {
            total_percentage += Math.round(first_part_percentage);
        }
        if (second_part_percentage !== '') {
            total_percentage += Math.round(second_part_percentage);
        }

        // Check if the total percentage exceeds 100%
        if (total_percentage > 100) {
            $("#quote1_advance_payment_percentage").html('').html('Percentage Cannot be greater than 100%');
            setTimeout(function() {
                $('#quote1_advance_payment_percentage').html(''); // Clear the warning message after 1 second
            }, 1000);

            // Reset fields if the total percentage exceeds 100%
            $('.advance_payment_percentage').val(100);
            $('.first_part_percentage').val('');
            $('.second_part_percentage').val('');
            $('.quote1_advance_payment').val(quote1_pricetopay);
            $('.quote1_first_part').val('');
            $('.quote1_second_part').val('');

        } else {
            $(".first_part_percentage").attr('readonly', ''); // Make first part percentage editable

            // If advance payment percentage is set and less than 100%, calculate the rest
            if (advance_payment_percentage !== '' && advance_payment_percentage < 100) {
                $('.quote1_advance_payment').val(Math.round(advance_payment_percentage * quote1_pricetopay / 100));

                var remaining_percentage = 100 - advance_payment_percentage;
                $(".first_part_percentage").removeAttr('readonly'); // Allow editing of the first part percentage
                $('.first_part_percentage').val(remaining_percentage);
                $('.quote1_first_part').val(Math.round(remaining_percentage * quote1_pricetopay / 100));
                $('.second_part_percentage').val('');
                $('.quote1_second_part').val('');

            } else if (advance_payment_percentage === '' || advance_payment_percentage == 0) {
                // If advance payment percentage is not set or is 0, reset the values
                $('.advance_payment_percentage').val(100);
                $('.first_part_percentage').val('');
                $('.second_part_percentage').val('');
                $('.quote1_advance_payment').val(quote1_pricetopay);
                $('.quote1_first_part').val('');
                $('.quote1_second_part').val('');
            }
        }
  });

  // Event handler for focusout and change events on .first_part_percentage
  $(document).on("focusout change", ".first_part_percentage", function() {
        var quote1_pricetopay = $('.quote1_pricetopay').val(); // Get the total price to pay
        if (quote1_pricetopay === '') {
            quote1_pricetopay = 0;
        }

        var advance_payment_percentage = $('.advance_payment_percentage').val(); // Get advance payment percentage
        var first_part_percentage = $('.first_part_percentage').val(); // Get first part percentage
        var second_part_percentage = $('.second_part_percentage').val(); // Get second part percentage
        var total_percentage = 0; // Initialize total percentage

        // Calculate total percentage from the entered values
        if (advance_payment_percentage !== '') {
            total_percentage += Math.round(advance_payment_percentage);
        }
        if (first_part_percentage !== '') {
            total_percentage += Math.round(first_part_percentage);
        }
        if (second_part_percentage !== '') {
            total_percentage += Math.round(second_part_percentage);
        }

        // Check if the total percentage exceeds 100%
        if (total_percentage > 100) {
            $("#first_part_percentage").html('').html('Percentage Cannot be greater than 100%');
            setTimeout(function() {
                $('#first_part_percentage').html(''); // Clear the warning message after 1 second
            }, 1000);

            var first_part_percentage_custom = 100 - advance_payment_percentage;

            // Reset fields if the total percentage exceeds 100%
            $('.first_part_percentage').val(first_part_percentage_custom);
            $('.second_part_percentage').val('');

            $('.quote1_first_part').val(Math.round(quote1_pricetopay * first_part_percentage_custom / 100));
            $('.quote1_second_part').val('');

        } else {
            if (first_part_percentage !== '') {
                var remaining_percentage = 100 - advance_payment_percentage - first_part_percentage;

                $(".first_part_percentage").removeAttr('readonly'); // Allow editing of the first part percentage
                $('.first_part_percentage').val(first_part_percentage);
                $('.quote1_first_part').val(Math.round(first_part_percentage * quote1_pricetopay / 100));
                $('.second_part_percentage').val(remaining_percentage);
                $('.quote1_second_part').val(Math.round(remaining_percentage * quote1_pricetopay / 100));

            } else if (advance_payment_percentage === '' || advance_payment_percentage == 0) {
                var first_part_percentage_custom = 100 - advance_payment_percentage;
                $('.first_part_percentage').val(first_part_percentage_custom);
                $('.second_part_percentage').val('');

                $('.quote1_first_part').val(Math.round(quote1_pricetopay * first_part_percentage_custom / 100));
                $('.quote1_second_part').val('');
            }
        }
  });

  // Event handler for change event on #show_direct_part
  jQuery("#show_direct_part").change(function() {
        var ischecked = $(this).is(':checked'); // Check if the checkbox is checked
        if (ischecked) {
            $(".direct_part").css('display', 'block'); // Show the direct part section
        } else {
            $(".direct_part").css('display', 'none'); // Hide the direct part section
        }
  });
});*/

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

/*fetch hotel name*/
/*$(document).on("change",".propertysource",function(){
	var propertysource = $(this).val();
	var propertyname = $(this).parent().siblings(".propertyname");
	var selectproperty = $(this).parent().siblings(".selectproperty");
	if(propertysource=='manual')
	{
	$(this).parent().siblings(".selectpropertystar").css('display','none')
	$(this).parent().siblings(".selectproperty").css('display','none')
	 $(this).parent().siblings(".propertyname").css('display','block')
	 $(this).parent().siblings(".selectpropertynamestar").css('display','block')
	}
	else if(propertysource=='packagehoteldatabase')
	{
	var city_name =$(this).parent().siblings(".quote_city_class").children(".quote_city").val()
	var propertytype= $(this).parent().siblings(".propertytype_class").children(".form-group").children(".propertytype").val()
	var hotel_class = $(this).parent().siblings().children(".quote_hotel")
	  if(propertysource=='packagehoteldatabase')
	    {
	    	
	    	fetch_hotel_name(city_name,propertytype,hotel_class)
	    }
	$(this).parent().siblings(".selectpropertystar").css('display','block')
	$(this).parent().siblings(".selectproperty").css('display','block')
	 $(this).parent().siblings(".propertyname").css('display','none')
	 $(this).parent().siblings(".selectpropertynamestar").css('display','none')
	}
	else
	{
	$(this).parent().siblings(".selectpropertystar").css('display','none')
	$(this).parent().siblings(".selectproperty").css('display','none')
	 $(this).parent().siblings(".propertyname").css('display','none')
	 $(this).parent().siblings(".selectpropertynamestar").css('display','none')
	}
})*/

/*$(document).on("change",".propertytype",function(){
	var city_name =$(this).parent().parent().siblings(".quote_city_class").children(".quote_city").val()
	var propertytype= $(this).val()
	var hotel_class = $(this).parent().parent().siblings().children(".quote_hotel")
	var propertysource= $(this).parent().parent().siblings(".propertysource_class").children(".propertysource").val()
	  if(propertysource=='packagehoteldatabase')
	    {
	    	fetch_hotel_name(city_name,propertytype,hotel_class)
	    }
})*/

/*$(document).ready(function(){ 	
 	$('.quote_city').select2({
		placeholder: "To",
		allowClear: true,
		ajax:{
			url: $("#APP_URL").val()+'/search_quote_destination',
			type: "get",
			dataType: 'json',
			delay: 250,
			data: function (params) {
				return {
					searchTerm: params.term // search term
					};
				},
			processResults: function (response) {
				return {
					results: response
					};
			},
			cache: true
		}
	});

 	$(document).on('change', '.quote_city', function () {
	var city_name = $(this).val()
	var propertytype= $(this).parent().siblings(".propertytype_class").children(".form-group").children(".propertytype").val()
  var hotel_class = $(this).parent().siblings().children(".quote_hotel")

	var propertysource= $(this).parent().siblings(".propertysource_class").children(".propertysource").val()
    if(propertysource=='packagehoteldatabase')
    {
    	fetch_hotel_name(city_name,propertytype,hotel_class)
    }   
	})
});*/

/*function fetch_hotel_name(city_name,propertytype,hotel_class) {
 	 $.ajax({
            type: 'POST',
            data: { city_name: city_name,propertytype:propertytype},
            url: APP_URL + "/quote_hotel_name",
            success: function (data) {
                hotel_class.html("").html("<option value='0' selected='true' disabled='disabled'>--Choose Hotel--</option>" + data)
            },
            error: function (data) {
            }
        });
 }

$(document).on("change",".quote_hotel",function(){
 	var hotel_id=$(this).val()
 	var button=$(this)
 	$.ajax({
            type: 'POST',
            data: { hotel_id: hotel_id},
            url: APP_URL + "/quote_hotel_data",
            success: function (data) {
      button.parent().siblings(".hotel_link_class").children(".hotel_link").val("").val(data.link)
      button.parent().siblings(".hotel_contact_class").children(".hotel_contact").val("").val(data.propertymobile)
      button.parent().siblings(".selectpropertystar").children(".selectpropertystar_value").html("").html("<option  selected='true'>"+data.star_rating+" Star</option>")
         console.log(data)
            },
            error: function (data) {
            }
        });
})*/

/*----------*/

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
				populatePaymentDays(30); // Assuming 30 days difference


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


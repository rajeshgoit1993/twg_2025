//$(document).on("keyup change",".number_test",function(){
//	this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
//});

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

/*$(document).ready(function() {

	var packages_number_of_extra_adult =$('.packages_number_of_extra_adult').val()
	if(packages_number_of_extra_adult>0)
	{
	$(".exadult_disable").each(function() {
	$(this).removeAttr('readonly','')
	});
	}
	else
	{
	$(".exadult_disable").each(function() {
	$(this).val('')
	$(this).attr('readonly','')
	});
	}
	var packages_number_of_child_with_bed =$('.packages_number_of_child_with_bed').val()
	if(packages_number_of_child_with_bed>0)
	{
	$(".childbed_disable").each(function() {
	$(this).removeAttr('readonly','')
	});
	}
	else
	{
	$(".childbed_disable").each(function() {
	$(this).val('')
	$(this).attr('readonly','')
	});
	}
	var packages_number_of_child_without_bed =$('.packages_number_of_child_without_bed').val()
	if(packages_number_of_child_without_bed>0)
	{
	$(".childwbed_disable").each(function() {
	$(this).removeAttr('readonly','')
	});
	}
	else
	{
	$(".childwbed_disable").each(function() {
	$(this).val('')
	$(this).attr('readonly','')
	});
	}
	var packages_number_of_infant =$('.packages_number_of_infant').val()
	if(packages_number_of_infant>0)
	{
	$(".infant_disable").each(function() {
	$(this).removeAttr('readonly','')
	});
	}
	else
	{
	$(".infant_disable").each(function() {
	$(this).val('')
	$(this).attr('readonly','')
	});
	}
	var packages_number_solo_traveller =$('.packages_number_solo_traveller').val()
	if(packages_number_solo_traveller>0)
	{
	$(".single_disable").each(function() {
	$(this).removeAttr('readonly','')
	});
	}
	else
	{
	$(".single_disable").each(function() {
	$(this).val('')
	$(this).attr('readonly','')
	});
	}
	var pricemarkup=$(".pricemarkup").val();
	if(pricemarkup=='2')
	{
	$(".markup_percentage").css("display","block")
	$(".markupcurrency").css("display","none")
	}
	else
	{
	$(".markupcurrency").css("display","block")
	$(".markup_percentage").css("display","none")
	}
	
	//
	$(".pricemarkup").change(function(){
	var pricemarkup=$(this).val();
	if(pricemarkup=='2')
	{
	$(".markupcurrency").css("display","none")
	$(".markup_percentage").css("display","block")
	}
	else
	{
	$(".markup_percentage").css("display","none")
	$(".markupcurrency").css("display","block")
	}
	});
	
	// discount plus
	var pricediscountpositive=$(".pricediscountpositive").val();
	if(pricediscountpositive=='2')
	{
	$(".discountpositive_percentage").css("display","block")
	$(".discount_positive_currency").css("display","none")
	}
	else if(pricediscountpositive=='1')
	{
	$(".discountpositive_percentage").css("display","none")
	$(".discount_positive_currency").css("display","block")
	}
	else
	{
	$(".discountpositive_percentage").css("display","none")
	$(".discount_positive_currency").css("display","none")
	}	
	// 
	$(".pricediscountpositive").change(function(){
	var pricediscountpositive=$(this).val();
	if(pricediscountpositive=='2')
	{
	$(".discountpositive_percentage").css("display","block")
	$(".discount_positive_currency").css("display","none")
	}
	else
	{
	$(".discountpositive_percentage").css("display","none")
	$(".discount_positive_currency").css("display","block")
	}
	packages_price('packages_air_adult','packages_cruise_adult','packages_cruiseport_adult','packages_cruisegratuity_adult','packages_cruisegst_adult','packages_hotel_adult','packages_tours_adult','packages_transfer_adult','packages_visa_adult','packages_inc_adult','packages_meals_adult','packages_additionalservice_adult','packages_tourtotal_adult','packages_tourtotal_exadult','packages_tourtotal_childbed','packages_tourtotal_childwbed','packages_tourtotal_infant','packages_tourtotal_single','pricemarkup','markup_percentage','packages_markup_adult','packages_markup_exadult','packages_markup_childbed','packages_markup_childwbed','packages_markup_infant','packages_markup_single','packages_total_adult','packages_discount_adult_plus','packages_gross_total_adult','packages_gross_total_exadult','packages_gross_total_childbed','packages_gross_total_childwbed','packages_gross_total_infant','packages_gross_total_single','packages_gross_total_group','packages_discount_adult_minus','packages_discount_exadult_minus','packages_discount_childbed_minus','packages_discount_childwbed_minus','packages_discount_infant_minus','packages_discount_single_minus','pricegst','gst_percentage','packages_gst_adult','packages_gst_adult','packages_gst_exadult','packages_gst_childbed','packages_gst_childwbed','packages_gst_infant','packages_gst_single','packages_gst_group','packages_gsttotal_adult','pricetcs','tcs_percentage','packages_tcs_adult','packages_tcs_exadult','packages_tcs_childbed','packages_tcs_childwbed','packages_tcs_infant','packages_tcs_single','packages_tcs_group','packages_tcstotal_adult','pricepgcharges','pgcharges_percentage','packages_pgcharges_adult','packages_pgcharges_exadult','packages_pgcharges_childbed','packages_pgcharges_childwbed','packages_pgcharges_infant','packages_pgcharges_single','packages_pg_group','packages_grand_adult','packages_grand_adult_with_person','query_pricetopay','packages_number_of_adult','packages_number_of_extra_adult','packages_number_of_child_with_bed','packages_number_of_child_without_bed','packages_number_of_infant','packages_number_solo_traveller','packages_grand_exadult_with_person','packages_grand_childbed_with_person','packages_grand_childwbed_with_person','packages_grand_infant_with_person','packages_grand_single_with_person','packages_discount_group','packages_gsttotal_exadult','packages_gsttotal_childbed','packages_gsttotal_childwbed','packages_gsttotal_infant','packages_gsttotal_single','packages_tcstotal_exadult','packages_tcstotal_childbed','packages_tcstotal_childwbed','packages_tcstotal_infant','packages_tcstotal_single','packages_air_exadult','packages_cruise_exadult','packages_cruiseport_exadult','packages_cruisegratuity_exadult','packages_cruisegst_exadult','packages_hotel_exadult','packages_tours_exadult','packages_transfer_exadult','packages_visa_exadult','packages_inc_exadult','packages_meals_exadult','packages_additionalservice_exadult','packages_discount_exadult_plus','packages_grand_exadult','packages_grand_childbed','packages_grand_childwbed','packages_grand_infant','packages_grand_single','packages_air_childbed','packages_cruise_childbed','packages_cruiseport_childbed','packages_cruisegratuity_childbed','packages_cruisegst_childbed','packages_hotel_childbed','packages_tours_childbed','packages_transfer_childbed','packages_visa_childbed','packages_inc_childbed','packages_meals_childbed','packages_additionalservice_childbed','packages_discount_childbed_plus','packages_air_childwbed','packages_cruise_childwbed','packages_cruiseport_childwbed','packages_cruisegratuity_childwbed','packages_cruisegst_childwbed','packages_hotel_childwbed','packages_tours_childwbed','packages_transfer_childwbed','packages_visa_childwbed','packages_inc_childwbed','packages_meals_childwbed','packages_additionalservice_childwbed','packages_discount_childwbed_plus','packages_air_infant','packages_cruise_infant','packages_cruiseport_infant','packages_cruisegratuity_infant','packages_cruisegst_infant','packages_hotel_infant','packages_tours_infant','packages_transfer_infant','packages_visa_infant','packages_inc_infant','packages_meals_infant','packages_additionalservice_infant','packages_discount_infant_plus','packages_air_single','packages_cruise_single','packages_cruiseport_single','packages_cruisegratuity_single','packages_cruisegst_single','packages_hotel_single','packages_tours_single','packages_transfer_single','packages_visa_single','packages_inc_single','packages_meals_single','packages_additionalservice_single','packages_discount_single_plus','packages_pricetopay','pricediscountpositive','discountpositive_percentage','pricediscountnegative','discountnegative_percentage','aircurrency','cruisecurrency','portchargecurrency','gratuitycurrency','cruise_gstcurrency','accommodationcurrency','sightseeingcurrency','transferscurrency','visacurrency','travelcurrency','mealscurrency','addon_servicecurrency','markupcurrency','discount_positive_currency','discount_negative_currency','gst_currency','tcs_currency','pgcharges_currency','coupon_percentage')
	})
	
	// discount minus
	var pricediscountnegative=$(".pricediscountnegative").val();
	if(pricediscountnegative=='2')
	{
	$(".discountnegative_percentage").css("display","block")
	$(".discount_negative_currency").css("display","none")
	}
	else if(pricediscountnegative=='1')
	{
	$(".discountnegative_percentage").css("display","none")
	$(".discount_negative_currency").css("display","block")
	}
	else
	{
	$(".discountnegative_percentage").css("display","none")
	$(".discount_negative_currency").css("display","none")
	}	
	// 
	$(".pricediscountnegative").change(function(){
	var pricediscountnegative=$(this).val();
	if(pricediscountnegative=='2')
	{
	$(".discountnegative_percentage").css("display","block")
	$(".discount_negative_currency").css("display","none")
	}
	else if(pricediscountnegative=='1')
	{
	$(".discountnegative_percentage").css("display","none")
	$(".discount_negative_currency").css("display","block")
	}
	else
	{
	$(".discountnegative_percentage").css("display","none")
	$(".discount_negative_currency").css("display","none")
	}
	packages_price('packages_air_adult','packages_cruise_adult','packages_cruiseport_adult','packages_cruisegratuity_adult','packages_cruisegst_adult','packages_hotel_adult','packages_tours_adult','packages_transfer_adult','packages_visa_adult','packages_inc_adult','packages_meals_adult','packages_additionalservice_adult','packages_tourtotal_adult','packages_tourtotal_exadult','packages_tourtotal_childbed','packages_tourtotal_childwbed','packages_tourtotal_infant','packages_tourtotal_single','pricemarkup','markup_percentage','packages_markup_adult','packages_markup_exadult','packages_markup_childbed','packages_markup_childwbed','packages_markup_infant','packages_markup_single','packages_total_adult','packages_discount_adult_plus','packages_gross_total_adult','packages_gross_total_exadult','packages_gross_total_childbed','packages_gross_total_childwbed','packages_gross_total_infant','packages_gross_total_single','packages_gross_total_group','packages_discount_adult_minus','packages_discount_exadult_minus','packages_discount_childbed_minus','packages_discount_childwbed_minus','packages_discount_infant_minus','packages_discount_single_minus','pricegst','gst_percentage','packages_gst_adult','packages_gst_adult','packages_gst_exadult','packages_gst_childbed','packages_gst_childwbed','packages_gst_infant','packages_gst_single','packages_gst_group','packages_gsttotal_adult','pricetcs','tcs_percentage','packages_tcs_adult','packages_tcs_exadult','packages_tcs_childbed','packages_tcs_childwbed','packages_tcs_infant','packages_tcs_single','packages_tcs_group','packages_tcstotal_adult','pricepgcharges','pgcharges_percentage','packages_pgcharges_adult','packages_pgcharges_exadult','packages_pgcharges_childbed','packages_pgcharges_childwbed','packages_pgcharges_infant','packages_pgcharges_single','packages_pg_group','packages_grand_adult','packages_grand_adult_with_person','query_pricetopay','packages_number_of_adult','packages_number_of_extra_adult','packages_number_of_child_with_bed','packages_number_of_child_without_bed','packages_number_of_infant','packages_number_solo_traveller','packages_grand_exadult_with_person','packages_grand_childbed_with_person','packages_grand_childwbed_with_person','packages_grand_infant_with_person','packages_grand_single_with_person','packages_discount_group','packages_gsttotal_exadult','packages_gsttotal_childbed','packages_gsttotal_childwbed','packages_gsttotal_infant','packages_gsttotal_single','packages_tcstotal_exadult','packages_tcstotal_childbed','packages_tcstotal_childwbed','packages_tcstotal_infant','packages_tcstotal_single','packages_air_exadult','packages_cruise_exadult','packages_cruiseport_exadult','packages_cruisegratuity_exadult','packages_cruisegst_exadult','packages_hotel_exadult','packages_tours_exadult','packages_transfer_exadult','packages_visa_exadult','packages_inc_exadult','packages_meals_exadult','packages_additionalservice_exadult','packages_discount_exadult_plus','packages_grand_exadult','packages_grand_childbed','packages_grand_childwbed','packages_grand_infant','packages_grand_single','packages_air_childbed','packages_cruise_childbed','packages_cruiseport_childbed','packages_cruisegratuity_childbed','packages_cruisegst_childbed','packages_hotel_childbed','packages_tours_childbed','packages_transfer_childbed','packages_visa_childbed','packages_inc_childbed','packages_meals_childbed','packages_additionalservice_childbed','packages_discount_childbed_plus','packages_air_childwbed','packages_cruise_childwbed','packages_cruiseport_childwbed','packages_cruisegratuity_childwbed','packages_cruisegst_childwbed','packages_hotel_childwbed','packages_tours_childwbed','packages_transfer_childwbed','packages_visa_childwbed','packages_inc_childwbed','packages_meals_childwbed','packages_additionalservice_childwbed','packages_discount_childwbed_plus','packages_air_infant','packages_cruise_infant','packages_cruiseport_infant','packages_cruisegratuity_infant','packages_cruisegst_infant','packages_hotel_infant','packages_tours_infant','packages_transfer_infant','packages_visa_infant','packages_inc_infant','packages_meals_infant','packages_additionalservice_infant','packages_discount_infant_plus','packages_air_single','packages_cruise_single','packages_cruiseport_single','packages_cruisegratuity_single','packages_cruisegst_single','packages_hotel_single','packages_tours_single','packages_transfer_single','packages_visa_single','packages_inc_single','packages_meals_single','packages_additionalservice_single','packages_discount_single_plus','packages_pricetopay','pricediscountpositive','discountpositive_percentage','pricediscountnegative','discountnegative_percentage','aircurrency','cruisecurrency','portchargecurrency','gratuitycurrency','cruise_gstcurrency','accommodationcurrency','sightseeingcurrency','transferscurrency','visacurrency','travelcurrency','mealscurrency','addon_servicecurrency','markupcurrency','discount_positive_currency','discount_negative_currency','gst_currency','tcs_currency','pgcharges_currency','coupon_percentage')
	})
	
	//
	var pricegst=$(".pricegst").val();
	if(pricegst=='2')
	{
	$(".gst_percentage").css("display","block")
	$(".gst_currency").css("display","none")
	}
	else if(pricegst=='1')
	{
	$(".gst_percentage").css("display","none")
	$(".gst_currency").css("display","block")
	}
	else
	{
	$(".gst_percentage").css("display","none")
	$(".gst_currency").css("display","none")
	}
	$(".pricegst").change(function(){
	var pricegst=$(this).val();
	if(pricegst=='2')
	{
	$(".gst_percentage").css("display","block")
	$(".gst_currency").css("display","none")
	}
	else if(pricegst=='1')
	{
	$(".gst_percentage").css("display","none")
	$(".gst_currency").css("display","block")
	}
	else
	{
	$(".gst_percentage").css("display","none")
	$(".gst_currency").css("display","none")
	}
	})
	
	//
	var pricetcs=$(".pricetcs").val();
	if(pricetcs=='2')
	{
	$(".tcs_percentage").css("display","block")
	$(".tcs_currency").css("display","none")
	}
	else if(pricetcs=='1')
	{
	$(".tcs_percentage").css("display","none")
	$(".tcs_currency").css("display","block")
	}
	else
	{
	$(".tcs_percentage").css("display","none")
	$(".tcs_currency").css("display","none")
	}
	$(".pricetcs").change(function(){
	var pricetcs=$(this).val();
	if(pricetcs=='2')
	{
	$(".tcs_percentage").css("display","block")
	$(".tcs_currency").css("display","none")
	}
	else if(pricetcs=='1')
	{
	$(".tcs_percentage").css("display","none")
	$(".tcs_currency").css("display","block")
	}
	else
	{
	$(".tcs_percentage").css("display","none")
	$(".tcs_currency").css("display","block")
	}
	})
	
	//
	var pricepgcharges=$(".pricepgcharges").val();
	if(pricepgcharges=='2')
	{
	$(".pgcharges_percentage").css("display","block")
	$(".pgcharges_currency").css("display","none")
	}
	else if(pricepgcharges=='1')
	{
	$(".pgcharges_percentage").css("display","none")
	$(".pgcharges_currency").css("display","block")
	}
	else
	{
	$(".pgcharges_percentage").css("display","none")
	$(".pgcharges_currency").css("display","none")
	}
	$(".pricepgcharges").change(function(){
	var pricepgcharges=$(this).val();
	if(pricepgcharges=='2')
	{
	$(".pgcharges_percentage").css("display","block")
	$(".pgcharges_currency").css("display","none")
	}
	else if(pricepgcharges=='1')
	{
	$(".pgcharges_percentage").css("display","none")
	$(".pgcharges_currency").css("display","block")
	}
	else
	{
	$(".pgcharges_percentage").css("display","none")
	$(".pgcharges_currency").css("display","block")
	}
	})
	//
	//
	//
});*/

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
        //toggleElementBasedOnValue('.advance_payment', '2', '.advance_payment_percentage');

        // Show first part payment percentage field when first_part_payment is '2'
        //toggleElementBasedOnValue('.first_part_payment', '2', '.first_part_percentage');

        // Show second part payment percentage field when second_part_payment is '2'
        //toggleElementBasedOnValue('.second_part_payment', '2', '.second_part_percentage');
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

        /*// Handle changes for advance_payment field
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
        });*/
    }

    // Function to recalculate the quote (placeholder for actual implementation)
    function recalculateQuote() {
        // Call the function with all the necessary parameters.
		//packages_price('packages_air_adult','packages_cruise_adult','packages_cruiseport_adult','packages_cruisegratuity_adult','packages_cruisegst_adult','packages_hotel_adult','packages_tours_adult','packages_transfer_adult','packages_visa_adult','packages_inc_adult','packages_meals_adult','packages_additionalservice_adult','packages_tourtotal_adult','packages_tourtotal_exadult','packages_tourtotal_childbed','packages_tourtotal_childwbed','packages_tourtotal_infant','packages_tourtotal_single','pricemarkup','markup_percentage','packages_markup_adult','packages_markup_exadult','packages_markup_childbed','packages_markup_childwbed','packages_markup_infant','packages_markup_single','packages_total_adult','packages_discount_adult_plus','packages_gross_total_adult','packages_gross_total_exadult','packages_gross_total_childbed','packages_gross_total_childwbed','packages_gross_total_infant','packages_gross_total_single','packages_gross_total_group','packages_discount_adult_minus','packages_discount_exadult_minus','packages_discount_childbed_minus','packages_discount_childwbed_minus','packages_discount_infant_minus','packages_discount_single_minus','pricegst','gst_percentage','packages_gst_adult','packages_gst_adult','packages_gst_exadult','packages_gst_childbed','packages_gst_childwbed','packages_gst_infant','packages_gst_single','packages_gst_group','packages_gsttotal_adult','pricetcs','tcs_percentage','packages_tcs_adult','packages_tcs_exadult','packages_tcs_childbed','packages_tcs_childwbed','packages_tcs_infant','packages_tcs_single','packages_tcs_group','packages_tcstotal_adult','pricepgcharges','pgcharges_percentage','packages_pgcharges_adult','packages_pgcharges_exadult','packages_pgcharges_childbed','packages_pgcharges_childwbed','packages_pgcharges_infant','packages_pgcharges_single','packages_pg_group','packages_grand_adult','packages_grand_adult_with_person','query_pricetopay','packages_number_of_adult','packages_number_of_extra_adult','packages_number_of_child_with_bed','packages_number_of_child_without_bed','packages_number_of_infant','packages_number_solo_traveller','packages_grand_exadult_with_person','packages_grand_childbed_with_person','packages_grand_childwbed_with_person','packages_grand_infant_with_person','packages_grand_single_with_person','packages_discount_group','packages_gsttotal_exadult','packages_gsttotal_childbed','packages_gsttotal_childwbed','packages_gsttotal_infant','packages_gsttotal_single','packages_tcstotal_exadult','packages_tcstotal_childbed','packages_tcstotal_childwbed','packages_tcstotal_infant','packages_tcstotal_single','packages_air_exadult','packages_cruise_exadult','packages_cruiseport_exadult','packages_cruisegratuity_exadult','packages_cruisegst_exadult','packages_hotel_exadult','packages_tours_exadult','packages_transfer_exadult','packages_visa_exadult','packages_inc_exadult','packages_meals_exadult','packages_additionalservice_exadult','packages_discount_exadult_plus','packages_grand_exadult','packages_grand_childbed','packages_grand_childwbed','packages_grand_infant','packages_grand_single','packages_air_childbed','packages_cruise_childbed','packages_cruiseport_childbed','packages_cruisegratuity_childbed','packages_cruisegst_childbed','packages_hotel_childbed','packages_tours_childbed','packages_transfer_childbed','packages_visa_childbed','packages_inc_childbed','packages_meals_childbed','packages_additionalservice_childbed','packages_discount_childbed_plus','packages_air_childwbed','packages_cruise_childwbed','packages_cruiseport_childwbed','packages_cruisegratuity_childwbed','packages_cruisegst_childwbed','packages_hotel_childwbed','packages_tours_childwbed','packages_transfer_childwbed','packages_visa_childwbed','packages_inc_childwbed','packages_meals_childwbed','packages_additionalservice_childwbed','packages_discount_childwbed_plus','packages_air_infant','packages_cruise_infant','packages_cruiseport_infant','packages_cruisegratuity_infant','packages_cruisegst_infant','packages_hotel_infant','packages_tours_infant','packages_transfer_infant','packages_visa_infant','packages_inc_infant','packages_meals_infant','packages_additionalservice_infant','packages_discount_infant_plus','packages_air_single','packages_cruise_single','packages_cruiseport_single','packages_cruisegratuity_single','packages_cruisegst_single','packages_hotel_single','packages_tours_single','packages_transfer_single','packages_visa_single','packages_inc_single','packages_meals_single','packages_additionalservice_single','packages_discount_single_plus','packages_pricetopay','pricediscountpositive','discountpositive_percentage','pricediscountnegative','discountnegative_percentage','aircurrency','cruisecurrency','portchargecurrency','gratuitycurrency','cruise_gstcurrency','accommodationcurrency','sightseeingcurrency','transferscurrency','visacurrency','travelcurrency','mealscurrency','addon_servicecurrency','markupcurrency','discount_positive_currency','discount_negative_currency','gst_currency','tcs_currency','pgcharges_currency','coupon_percentage');
		packages_price(
		    'packages_air_adult', 'packages_cruise_adult', 'packages_cruiseport_adult', 'packages_cruisegratuity_adult', 
		    'packages_cruisegst_adult', 'packages_hotel_adult', 'packages_tours_adult', 'packages_transfer_adult', 
		    'packages_visa_adult', 'packages_inc_adult', 'packages_meals_adult', 'packages_additionalservice_adult', 
		    'packages_tourtotal_adult', 'packages_tourtotal_exadult', 'packages_tourtotal_childbed', 'packages_tourtotal_childwbed', 
		    'packages_tourtotal_infant', 'packages_tourtotal_single', 'pricemarkup', 'markup_percentage', 
		    'packages_markup_adult', 'packages_markup_exadult', 'packages_markup_childbed', 'packages_markup_childwbed', 
		    'packages_markup_infant', 'packages_markup_single', 'packages_total_adult', 'packages_discount_adult_plus', 
		    'packages_gross_total_adult', 'packages_gross_total_exadult', 'packages_gross_total_childbed', 
		    'packages_gross_total_childwbed', 'packages_gross_total_infant', 'packages_gross_total_single', 
		    'packages_gross_total_group', 'packages_discount_adult_minus', 'packages_discount_exadult_minus', 
		    'packages_discount_childbed_minus', 'packages_discount_childwbed_minus', 'packages_discount_infant_minus', 
		    'packages_discount_single_minus', 'pricegst', 'gst_percentage', 'packages_gst_adult', 'packages_gst_adult', 
		    'packages_gst_exadult', 'packages_gst_childbed', 'packages_gst_childwbed', 'packages_gst_infant', 
		    'packages_gst_single', 'packages_gst_group', 'packages_gsttotal_adult', 'pricetcs', 'tcs_percentage', 
		    'packages_tcs_adult', 'packages_tcs_exadult', 'packages_tcs_childbed', 'packages_tcs_childwbed', 
		    'packages_tcs_infant', 'packages_tcs_single', 'packages_tcs_group', 'packages_tcstotal_adult', 'pricepgcharges', 
		    'pgcharges_percentage', 'packages_pgcharges_adult', 'packages_pgcharges_exadult', 'packages_pgcharges_childbed', 
		    'packages_pgcharges_childwbed', 'packages_pgcharges_infant', 'packages_pgcharges_single', 'packages_pg_group', 
		    'packages_grand_adult', 'packages_grand_adult_with_person', 'query_pricetopay', 'packages_number_of_adult', 
		    'packages_number_of_extra_adult', 'packages_number_of_child_with_bed', 'packages_number_of_child_without_bed', 
		    'packages_number_of_infant', 'packages_number_solo_traveller', 'packages_grand_exadult_with_person', 
		    'packages_grand_childbed_with_person', 'packages_grand_childwbed_with_person', 'packages_grand_infant_with_person', 
		    'packages_grand_single_with_person', 'packages_discount_group', 'packages_gsttotal_exadult', 
		    'packages_gsttotal_childbed', 'packages_gsttotal_childwbed', 'packages_gsttotal_infant', 'packages_gsttotal_single', 
		    'packages_tcstotal_exadult', 'packages_tcstotal_childbed', 'packages_tcstotal_childwbed', 'packages_tcstotal_infant', 
		    'packages_tcstotal_single', 'packages_air_exadult', 'packages_cruise_exadult', 'packages_cruiseport_exadult', 
		    'packages_cruisegratuity_exadult', 'packages_cruisegst_exadult', 'packages_hotel_exadult', 'packages_tours_exadult', 
		    'packages_transfer_exadult', 'packages_visa_exadult', 'packages_inc_exadult', 'packages_meals_exadult', 
		    'packages_additionalservice_exadult', 'packages_discount_exadult_plus', 'packages_grand_exadult', 
		    'packages_grand_childbed', 'packages_grand_childwbed', 'packages_grand_infant', 'packages_grand_single', 
		    'packages_air_childbed', 'packages_cruise_childbed', 'packages_cruiseport_childbed', 'packages_cruisegratuity_childbed', 
		    'packages_cruisegst_childbed', 'packages_hotel_childbed', 'packages_tours_childbed', 'packages_transfer_childbed', 
		    'packages_visa_childbed', 'packages_inc_childbed', 'packages_meals_childbed', 'packages_additionalservice_childbed', 
		    'packages_discount_childbed_plus', 'packages_air_childwbed', 'packages_cruise_childwbed', 'packages_cruiseport_childwbed', 
		    'packages_cruisegratuity_childwbed', 'packages_cruisegst_childwbed', 'packages_hotel_childwbed', 
		    'packages_tours_childwbed', 'packages_transfer_childwbed', 'packages_visa_childwbed', 'packages_inc_childwbed', 
		    'packages_meals_childwbed', 'packages_additionalservice_childwbed', 'packages_discount_childwbed_plus', 
		    'packages_air_infant', 'packages_cruise_infant', 'packages_cruiseport_infant', 'packages_cruisegratuity_infant', 
		    'packages_cruisegst_infant', 'packages_hotel_infant', 'packages_tours_infant', 'packages_transfer_infant', 
		    'packages_visa_infant', 'packages_inc_infant', 'packages_meals_infant', 'packages_additionalservice_infant', 
		    'packages_discount_infant_plus', 'packages_air_single', 'packages_cruise_single', 'packages_cruiseport_single', 
		    'packages_cruisegratuity_single', 'packages_cruisegst_single', 'packages_hotel_single', 'packages_tours_single', 
		    'packages_transfer_single', 'packages_visa_single', 'packages_inc_single', 'packages_meals_single', 
		    'packages_additionalservice_single', 'packages_discount_single_plus', 'packages_pricetopay', 'pricediscountpositive', 
		    'discountpositive_percentage', 'pricediscountnegative', 'discountnegative_percentage', 'aircurrency', 'cruisecurrency', 
		    'portchargecurrency', 'gratuitycurrency', 'cruise_gstcurrency', 'accommodationcurrency', 'sightseeingcurrency', 
		    'transferscurrency', 'visacurrency', 'travelcurrency', 'mealscurrency', 'addon_servicecurrency', 'markupcurrency', 
		    'discount_positive_currency', 'discount_negative_currency', 'gst_currency', 'tcs_currency', 'pgcharges_currency', 
		    'coupon_percentage'
		);
    }

    // Initialize display settings on page load
    initializeDisplaySettings();

    // Attach change event handlers
    handleChangeEvents();
});

/*----------*//*----------*/

/*//add certifications
$(document).on("click","#add_certification",function(e){
	e.preventDefault()
	var select_room=$(".select_room").val()
	var name_count1=$(".dynamic_four").children("div:last").attr("id").slice(7)
	console.log(name_count1)
	var name_count=Math.round(name_count1)-"1";
	name_count1++
	name_count++
	var total_div=$(".dynamic_four").children("div").length
	if(total_div<select_room) {
	//$(".dynamic_four").append('<div id="fourrow'+name_count1+'"><div class="row"><div class="appendBottom5"><div class="border-bottom1 padding-top10"><label for="room" class="pfwmt appendBottom5 font-size14" style="color: #000001 !important">Room '+name_count1+' </label><label for="roomnumber fontWeight600">(Max No of passenger) <span class="requiredcolor">*</span></label><select class="max_passenger" name="room['+name_count+'][max_passenger]"><option value="1" >1</option><option value="2" >2</option><option value="3" >3</option><option value="4" >4</option><option value="5" >5</option><option value="6" >6</option><option value="7" selected>7</option><option value="8" >8</option><option value="9" >9</option><option value="10" >10</option></select><div class="flexBetween"><div><div class="addTravellerValue"><input type="hidden" id="travellers" name="room['+name_count+'][twin_adult_room]" class="twin_adult_room_value" value="2" /><span class="travellersMinus twin_adult_room_dec">&#8722;</span><span class="travellersValue twin_adult_room_result">2</span><span class="travellersPlus twin_adult_room_inc">&#43;</span></div><p class="itemBottomHeading">Adult (Twin Sharing +12yrs)</p></div><div><div class="addTravellerValue"><input type="hidden" id="travellers" name="room['+name_count+'][extra_adult_room]" class="extra_adult_room_value" value="0" /><span class="travellersMinus extra_adult_room_dec">&#8722;</span><span class="travellersValue extra_adult_room_result">0</span><span class="travellersPlus extra_adult_room_inc">&#43;</span></div><p class="itemBottomHeading">Extra Adult (+12yrs)</p></div><div><div class="addTravellerValue"><input type="hidden" id="travellers" name="room['+name_count+'][child_with_bed_room]" class="child_with_bed_room_value" value="0" /><span class="travellersMinus child_with_bed_room_dec">&#8722;</span><span class="travellersValue child_with_bed_room_result">0</span><span class="travellersPlus child_with_bed_room_inc">&#43;</span></div><p class="itemBottomHeading">Child (With Bed 2-12yrs)</p></div><div><div class="addTravellerValue"><input type="hidden" id="travellers" name="room['+name_count+'][child_without_bed_room]" class="child_without_bed_room_value" value="0" /><span class="travellersMinus child_without_bed_room_dec">&#8722;</span><span class="travellersValue child_without_bed_room_result">0</span><span class="travellersPlus child_without_bed_room_inc">&#43;</span></div><p class="itemBottomHeading">Child (without bed 2-12yrs)</p></div><div><div class="addTravellerValue"><input type="hidden" id="travellers" name="room['+name_count+'][infant_room]" class="span_value_child_with_bed infant_room_value" value="0"><span class="travellersMinus infant_room_dec">&#8722;</span><span class="travellersValue infant_room_result">0</span><span class="travellersPlus infant_room_inc">&#43;</span></div><p class="itemBottomHeading">Infant (0-2yrs)</p></div><div><div class="addTravellerValue"><input type="hidden" id="travellers" name="room['+name_count+'][single_room]" class="single_room_value" value="0"><span class="travellersMinus single_room_dec">&#8722;</span><span class="travellersValue single_room_result">0</span><span class="travellersPlus single_room_inc">&#43;</span></div><p class="itemBottomHeading">Single (+12yrs)</p></div><div class="text-center"><p style="visibility: hidden;">Test</p><button type="button" name="remove" id="'+name_count1+'" class="btn btn-danger btn_remove_four"><span class="fa fa-minus"></span> x Remove</button></div> </div></div></div></div></div>');
	// Append a new room block with various options for travelers
	$(".dynamic_four").append(
	    '<div id="fourrow' + name_count1 + '">' +
	        '<div class="col-md-12">' +
	            // Container for room details with bottom padding
	            '<div class="room-container">' +
	                '<div class="border-bottom1 padding-top10">' +
	                    // Label for the room number
	                    '<div for="room" class="title">' +
	                        'Room ' + name_count1 + 
	                    '</div>' +
	                    //<!-- guest allowed in a room -->
	                    '<div class="makeflex align-center">' +
		                    // Label for max number of passengers
		                    '<label class="field-required">' +
		                        'Max. guests allowed' +
		                    '</label>' +
		                    // Dropdown for selecting max passengers
		                    '<select class="form-control apndLft5 max_passenger" name="room[' + name_count + '][max_passenger]" style="max-width: 90px;border-radius: 3px;">' +
		                        '<option value="1">1</option>' +
		                        '<option value="2">2</option>' +
		                        '<option value="3">3</option>' +
		                        '<option value="4">4</option>' +
		                        '<option value="5">5</option>' +
		                        '<option value="6">6</option>' +
		                        '<option value="7" selected>7</option>' +
		                        '<option value="8">8</option>' +
		                        '<option value="9">9</option>' +
		                        '<option value="10">10</option>' +
		                    '</select>' +
	                    '</div>' +
	                    // Section for different traveler types within the room
	                    '<div class="guest-in-room guest-room-wrapper mobscroll scrollX">' +
	                        // Adult (Twin Sharing +12yrs) section
	                        '<div>' +
	                            '<div class="addTravellerValue">' +
	                                '<input type="hidden" id="travellers" name="room[' + name_count + '][twin_adult_room]" class="twin_adult_room_value" value="2" />' +
	                                '<span class="travellersMinus twin_adult_room_dec">&#8722;</span>' +
	                                '<span class="travellersValue twin_adult_room_result">2</span>' +
	                                '<span class="travellersPlus twin_adult_room_inc">&#43;</span>' +
	                            '</div>' +
	                            '<p class="itemBottomHeading">Adult<br>(+12yrs)</p>' +
	                        '</div>' +
	                        // Extra Adult (+12yrs) section
	                        '<div>' +
	                            '<div class="addTravellerValue">' +
	                                '<input type="hidden" id="travellers" name="room[' + name_count + '][extra_adult_room]" class="extra_adult_room_value" value="0" />' +
	                                '<span class="travellersMinus extra_adult_room_dec">&#8722;</span>' +
	                                '<span class="travellersValue extra_adult_room_result">0</span>' +
	                                '<span class="travellersPlus extra_adult_room_inc">&#43;</span>' +
	                            '</div>' +
	                            '<p class="itemBottomHeading">Extra Adult<br>(+12yrs)</p>' +
	                        '</div>' +
	                        // Child (With Bed 2-12yrs) section
	                        '<div>' +
	                            '<div class="addTravellerValue">' +
	                                '<input type="hidden" id="travellers" name="room[' + name_count + '][child_with_bed_room]" class="child_with_bed_room_value" value="0" />' +
	                                '<span class="travellersMinus child_with_bed_room_dec">&#8722;</span>' +
	                                '<span class="travellersValue child_with_bed_room_result">0</span>' +
	                                '<span class="travellersPlus child_with_bed_room_inc">&#43;</span>' +
	                            '</div>' +
	                            '<p class="itemBottomHeading">Child (with bed)<br>(2-12yrs)</p>' +
	                        '</div>' +
	                        // Child (Without Bed 2-12yrs) section
	                        '<div>' +
	                            '<div class="addTravellerValue">' +
	                                '<input type="hidden" id="travellers" name="room[' + name_count + '][child_without_bed_room]" class="child_without_bed_room_value" value="0" />' +
	                                '<span class="travellersMinus child_without_bed_room_dec">&#8722;</span>' +
	                                '<span class="travellersValue child_without_bed_room_result">0</span>' +
	                                '<span class="travellersPlus child_without_bed_room_inc">&#43;</span>' +
	                            '</div>' +
	                            '<p class="itemBottomHeading">Child (without bed)<br>2-12yrs)</p>' +
	                        '</div>' +
	                        // Infant (0-2yrs) section
	                        '<div>' +
	                            '<div class="addTravellerValue">' +
	                                '<input type="hidden" id="travellers" name="room[' + name_count + '][infant_room]" class="span_value_child_with_bed infant_room_value" value="0" />' +
	                                '<span class="travellersMinus infant_room_dec">&#8722;</span>' +
	                                '<span class="travellersValue infant_room_result">0</span>' +
	                                '<span class="travellersPlus infant_room_inc">&#43;</span>' +
	                            '</div>' +
	                            '<p class="itemBottomHeading">Infant<br>(0-2yrs)</p>' +
	                        '</div>' +
	                        // Single (+12yrs) section
	                        '<div>' +
	                            '<div class="addTravellerValue">' +
	                                '<input type="hidden" id="travellers" name="room[' + name_count + '][single_room]" class="single_room_value" value="0" />' +
	                                '<span class="travellersMinus single_room_dec">&#8722;</span>' +
	                                '<span class="travellersValue single_room_result">0</span>' +
	                                '<span class="travellersPlus single_room_inc">&#43;</span>' +
	                            '</div>' +
	                            '<p class="itemBottomHeading">Single<br>(+12yrs)</p>' +
	                        '</div>' +
	                        // Button to remove the room
	                        '<div class="text-center">' +
	                            '<button type="button" name="remove" id="' + name_count1 + '" class="btn btn-danger btn_remove_four">' +
	                                'Remove room' +
	                            '</button>' +
	                        '</div>' +
	                    '</div>' + // End of flexBetween
	                '</div>' + // End of border-bottom1 padding-top10
	            '</div>' + // End of appendBottom5
	        '</div>' + // End of col-md-12
	    '</div>' // End of dynamic_four div
	);
	} else {
		alert('Increase no of rooms to add rooms further')
	}
	get_sum_passenger()
	get_seperate_passenger()
});

//
$(document).on('click', '.btn_remove_four', function() {
	var button_id = $(this).attr("id");
	$('#fourrow'+button_id+'').remove();
	get_sum_passenger()
	get_seperate_passenger()
});*/


/*----------*/

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
		        '<div class="col-md-12">' +
		            // Container for room details with bottom padding
		            '<div class="room-container">' +
		                '<div class="border-bottom1 padding-top10">' +
		                    // Label for the room number
		                    '<div for="room" class="title">' +
		                        'Room ' + name_count1 + 
		                    '</div>' +
		                    //<!-- guest allowed in a room -->
		                    '<div class="makeflex align-center">' +
			                    // Label for max number of passengers
			                    '<label class="field-required">' +
			                        'Max. guests allowed' +
			                    '</label>' +
			                    // Dropdown for selecting max passengers
			                    '<select class="form-control apndLft5 max_passenger" name="room[' + name_count + '][max_passenger]" style="max-width: 90px;border-radius: 3px;">' +
			                        '<option value="1">1</option>' +
			                        '<option value="2">2</option>' +
			                        '<option value="3">3</option>' +
			                        '<option value="4">4</option>' +
			                        '<option value="5">5</option>' +
			                        '<option value="6">6</option>' +
			                        '<option value="7" selected>7</option>' +
			                        '<option value="8">8</option>' +
			                        '<option value="9">9</option>' +
			                        '<option value="10">10</option>' +
			                    '</select>' +
		                    '</div>' +
		                    // Section for different traveler types within the room
		                    '<div class="guest-in-room guest-room-wrapper mobscroll scrollX">' +
		                        // Adult (Twin Sharing +12yrs) section
		                        '<div>' +
		                            '<div class="addTravellerValue">' +
		                                '<input type="hidden" id="travellers" name="room[' + name_count + '][twin_adult_room]" class="twin_adult_room_value" value="2" />' +
		                                '<span class="travellersMinus twin_adult_room_dec">&#8722;</span>' +
		                                '<span class="travellersValue twin_adult_room_result">2</span>' +
		                                '<span class="travellersPlus twin_adult_room_inc">&#43;</span>' +
		                            '</div>' +
		                            '<p class="itemBottomHeading">Adult<br>(+12yrs)</p>' +
		                        '</div>' +
		                        // Extra Adult (+12yrs) section
		                        '<div>' +
		                            '<div class="addTravellerValue">' +
		                                '<input type="hidden" id="travellers" name="room[' + name_count + '][extra_adult_room]" class="extra_adult_room_value" value="0" />' +
		                                '<span class="travellersMinus extra_adult_room_dec">&#8722;</span>' +
		                                '<span class="travellersValue extra_adult_room_result">0</span>' +
		                                '<span class="travellersPlus extra_adult_room_inc">&#43;</span>' +
		                            '</div>' +
		                            '<p class="itemBottomHeading">Extra Adult<br>(+12yrs)</p>' +
		                        '</div>' +
		                        // Child (With Bed 2-12yrs) section
		                        '<div>' +
		                            '<div class="addTravellerValue">' +
		                                '<input type="hidden" id="travellers" name="room[' + name_count + '][child_with_bed_room]" class="child_with_bed_room_value" value="0" />' +
		                                '<span class="travellersMinus child_with_bed_room_dec">&#8722;</span>' +
		                                '<span class="travellersValue child_with_bed_room_result">0</span>' +
		                                '<span class="travellersPlus child_with_bed_room_inc">&#43;</span>' +
		                            '</div>' +
		                            '<p class="itemBottomHeading">Child (with bed)<br>(2-12yrs)</p>' +
		                        '</div>' +
		                        // Child (Without Bed 2-12yrs) section
		                        '<div>' +
		                            '<div class="addTravellerValue">' +
		                                '<input type="hidden" id="travellers" name="room[' + name_count + '][child_without_bed_room]" class="child_without_bed_room_value" value="0" />' +
		                                '<span class="travellersMinus child_without_bed_room_dec">&#8722;</span>' +
		                                '<span class="travellersValue child_without_bed_room_result">0</span>' +
		                                '<span class="travellersPlus child_without_bed_room_inc">&#43;</span>' +
		                            '</div>' +
		                            '<p class="itemBottomHeading">Child (without bed)<br>2-12yrs)</p>' +
		                        '</div>' +
		                        // Infant (0-2yrs) section
		                        '<div>' +
		                            '<div class="addTravellerValue">' +
		                                '<input type="hidden" id="travellers" name="room[' + name_count + '][infant_room]" class="span_value_child_with_bed infant_room_value" value="0" />' +
		                                '<span class="travellersMinus infant_room_dec">&#8722;</span>' +
		                                '<span class="travellersValue infant_room_result">0</span>' +
		                                '<span class="travellersPlus infant_room_inc">&#43;</span>' +
		                            '</div>' +
		                            '<p class="itemBottomHeading">Infant<br>(0-2yrs)</p>' +
		                        '</div>' +
		                        // Single (+12yrs) section
		                        '<div>' +
		                            '<div class="addTravellerValue">' +
		                                '<input type="hidden" id="travellers" name="room[' + name_count + '][single_room]" class="single_room_value" value="0" />' +
		                                '<span class="travellersMinus single_room_dec">&#8722;</span>' +
		                                '<span class="travellersValue single_room_result">0</span>' +
		                                '<span class="travellersPlus single_room_inc">&#43;</span>' +
		                            '</div>' +
		                            '<p class="itemBottomHeading">Single<br>(+12yrs)</p>' +
		                        '</div>' +
		                        // Button to remove the room
		                        '<div class="text-center">' +
		                            '<button type="button" name="remove" id="' + name_count1 + '" class="btn btn-danger btn_remove_four">' +
		                                'Remove room' +
		                            '</button>' +
		                        '</div>' +
		                    '</div>' + // End of flexBetween
		                '</div>' + // End of border-bottom1 padding-top10
		            '</div>' + // End of appendBottom5
		        '</div>' + // End of col-md-12
		    '</div>' // End of dynamic_four div
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

// Handle changes in the Price Type dropdown (price tag changes)
$('.price_type').change(function () {
	var selectedPriceType = $(this).val();

	// Automatically set the priceremarks value based on the selected price type
	if (selectedPriceType === 'Per Person') {
		// Set to "Price Per Person" if "Per Person" is selected
		$('select[name="priceremarks"]').val('Price Per Person');
	} else if (selectedPriceType === 'Group Price') {
		// Set to "Price Group" if "Group Price" is selected
		$('select[name="priceremarks"]').val('Price Group');
	}

	// Keep the priceremarks field disabled
	$('select[name="priceremarks"]').prop('disabled', true);
});

// Initially disable the priceremarks field on page load
$('select[name="priceremarks"]').prop('disabled', true);

/*----------*//*----------*/

// no of traveller (old function)
/*function no_of_traveller_check(thisObj) {
	var passenger=thisObj.siblings('input').val()
	thisObj.parent().parent().siblings().each(function() {
	if($(this).children('.addTravellerValue').children().length>2)
	{
	var val=$(this).children('.addTravellerValue').children('input').val();
	if(val!='' && val!=0)
	{
	passenger=Math.round(passenger)+Math.round(val)
	}
	}
	});
	return passenger;
}

//
function get_sum_passenger() {
	var twin_adult=0;
	var extra_adult=0;
	var child_with_bed=0;
	var child_without_bed=0;
	var infant_room=0;
	var single_room=0;
	$(".twin_adult_room_value").each(function() {
	var val=$(this).val();
	if(val!='' && val!=0)
	{
	twin_adult=Math.round(twin_adult)+Math.round(val)
	}
	});
	if(twin_adult==0)
	{
	$(".adult_disable").each(function() {
	$(this).val('')
	$(this).attr('readonly','')
	});
	}
	else
	{
	$(".adult_disable").each(function() {
	$(this).removeAttr('readonly','')
	});
	}
	$(".extra_adult_room_value").each(function() {
	var val=$(this).val();
	if(val!='' && val!=0)
	{
	extra_adult=Math.round(extra_adult)+Math.round(val)
	}
	});
	if(extra_adult==0)
	{
	$(".exadult_disable").each(function() {
	$(this).val('')
	$(this).attr('readonly','')
	});
	}
	else
	{
	$(".exadult_disable").each(function() {
	$(this).removeAttr('readonly','')
	});
	}
	$(".single_room_value").each(function() {
	var val=$(this).val();
	if(val!='' && val!=0)
	{
	single_room=Math.round(single_room)+Math.round(val)
	}
	});
	if(single_room==0)
	{
	$(".single_disable").each(function() {
	$(this).val('')
	$(this).attr('readonly','')
	});
	}
	else
	{
	$(".single_disable").each(function() {
	$(this).removeAttr('readonly','')
	});
	}
	//
	var child=0;
	$(".child_with_bed_room_value").each(function() {
	var val=$(this).val();
	if(val!='' && val!=0)
	{
	child_with_bed=Math.round(child_with_bed)+Math.round(val)
	}
	});
	if(child_with_bed==0)
	{
	$(".childbed_disable").each(function() {
	$(this).val('')
	$(this).attr('readonly','')
	});
	}
	else
	{
	$(".childbed_disable").each(function() {
	$(this).removeAttr('readonly','')
	});
	}
	//
	$(".child_without_bed_room_value").each(function() {
	var val=$(this).val();
	if(val!='' && val!=0)
	{
	child_without_bed=Math.round(child_without_bed)+Math.round(val)
	}
	});
	if(child_without_bed==0)
	{
	$(".childwbed_disable").each(function() {
	$(this).val('')
	$(this).attr('readonly','')
	});
	}
	else
	{
	$(".childwbed_disable").each(function() {
	$(this).removeAttr('readonly','')
	});
	}
	//
	var infant=0;
	$(".infant_room_value").each(function() {
	var val=$(this).val();
	if(val!='' && val!=0)
	{
	infant_room=Math.round(infant_room)+Math.round(val)
	}
	});
	if(infant_room==0)
	{
	$(".infant_disable").each(function() {
	$(this).val('')
	$(this).attr('readonly','')
	});
	}
	else
	{
	$(".infant_disable").each(function() {
	$(this).removeAttr('readonly','')
	});
	}
	//
	$(".packages_adult_room_value").val("").val(twin_adult)
	$(".packages_adult_room_result").html("").html(twin_adult)
	$(".packages_number_of_extra_adult").val("").val(extra_adult)
	$(".packages_child_extra_adult_result").html("").html(extra_adult)
	$(".packages_number_of_child_with_bed").val("").val(child_with_bed)
	$(".packages_child_with_bed_result").html("").html(child_with_bed)
	$(".packages_number_of_child_without_bed").val("").val(child_without_bed)
	$(".packages_span_value_childwithoutbed_result").html("").html(child_without_bed)
	$(".packages_number_of_infant").val("").val(infant_room)
	$(".packages_infant_result").html("").html(infant_room)
	$(".packages_number_solo_traveller").val("").val(single_room)
	$(".packages_solo_result").html("").html(single_room)

	//packages_price('packages_air_adult','packages_cruise_adult','packages_cruiseport_adult','packages_cruisegratuity_adult','packages_cruisegst_adult','packages_hotel_adult','packages_tours_adult','packages_transfer_adult','packages_visa_adult','packages_inc_adult','packages_meals_adult','packages_additionalservice_adult','packages_tourtotal_adult','packages_tourtotal_exadult','packages_tourtotal_childbed','packages_tourtotal_childwbed','packages_tourtotal_infant','packages_tourtotal_single','pricemarkup','markup_percentage','packages_markup_adult','packages_markup_exadult','packages_markup_childbed','packages_markup_childwbed','packages_markup_infant','packages_markup_single','packages_total_adult','packages_discount_adult_plus','packages_gross_total_adult','packages_gross_total_exadult','packages_gross_total_childbed','packages_gross_total_childwbed','packages_gross_total_infant','packages_gross_total_single','packages_gross_total_group','packages_discount_adult_minus','packages_discount_exadult_minus','packages_discount_childbed_minus','packages_discount_childwbed_minus','packages_discount_infant_minus','packages_discount_single_minus','pricegst','gst_percentage','packages_gst_adult','packages_gst_adult','packages_gst_exadult','packages_gst_childbed','packages_gst_childwbed','packages_gst_infant','packages_gst_single','packages_gst_group','packages_gsttotal_adult','pricetcs','tcs_percentage','packages_tcs_adult','packages_tcs_exadult','packages_tcs_childbed','packages_tcs_childwbed','packages_tcs_infant','packages_tcs_single','packages_tcs_group','packages_tcstotal_adult','pricepgcharges','pgcharges_percentage','packages_pgcharges_adult','packages_pgcharges_exadult','packages_pgcharges_childbed','packages_pgcharges_childwbed','packages_pgcharges_infant','packages_pgcharges_single','packages_pg_group','packages_grand_adult','packages_grand_adult_with_person','query_pricetopay','packages_number_of_adult','packages_number_of_extra_adult','packages_number_of_child_with_bed','packages_number_of_child_without_bed','packages_number_of_infant','packages_number_solo_traveller','packages_grand_exadult_with_person','packages_grand_childbed_with_person','packages_grand_childwbed_with_person','packages_grand_infant_with_person','packages_grand_single_with_person','packages_discount_group','packages_gsttotal_exadult','packages_gsttotal_childbed','packages_gsttotal_childwbed','packages_gsttotal_infant','packages_gsttotal_single','packages_tcstotal_exadult','packages_tcstotal_childbed','packages_tcstotal_childwbed','packages_tcstotal_infant','packages_tcstotal_single','packages_air_exadult','packages_cruise_exadult','packages_cruiseport_exadult','packages_cruisegratuity_exadult','packages_cruisegst_exadult','packages_hotel_exadult','packages_tours_exadult','packages_transfer_exadult','packages_visa_exadult','packages_inc_exadult','packages_meals_exadult','packages_additionalservice_exadult','packages_discount_exadult_plus','packages_grand_exadult','packages_grand_childbed','packages_grand_childwbed','packages_grand_infant','packages_grand_single','packages_air_childbed','packages_cruise_childbed','packages_cruiseport_childbed','packages_cruisegratuity_childbed','packages_cruisegst_childbed','packages_hotel_childbed','packages_tours_childbed','packages_transfer_childbed','packages_visa_childbed','packages_inc_childbed','packages_meals_childbed','packages_additionalservice_childbed','packages_discount_childbed_plus','packages_air_childwbed','packages_cruise_childwbed','packages_cruiseport_childwbed','packages_cruisegratuity_childwbed','packages_cruisegst_childwbed','packages_hotel_childwbed','packages_tours_childwbed','packages_transfer_childwbed','packages_visa_childwbed','packages_inc_childwbed','packages_meals_childwbed','packages_additionalservice_childwbed','packages_discount_childwbed_plus','packages_air_infant','packages_cruise_infant','packages_cruiseport_infant','packages_cruisegratuity_infant','packages_cruisegst_infant','packages_hotel_infant','packages_tours_infant','packages_transfer_infant','packages_visa_infant','packages_inc_infant','packages_meals_infant','packages_additionalservice_infant','packages_discount_infant_plus','packages_air_single','packages_cruise_single','packages_cruiseport_single','packages_cruisegratuity_single','packages_cruisegst_single','packages_hotel_single','packages_tours_single','packages_transfer_single','packages_visa_single','packages_inc_single','packages_meals_single','packages_additionalservice_single','packages_discount_single_plus','packages_pricetopay','pricediscountpositive','discountpositive_percentage','pricediscountnegative','discountnegative_percentage','aircurrency','cruisecurrency','portchargecurrency','gratuitycurrency','cruise_gstcurrency','accommodationcurrency','sightseeingcurrency','transferscurrency','visacurrency','travelcurrency','mealscurrency','addon_servicecurrency','markupcurrency','discount_positive_currency','discount_negative_currency','gst_currency','tcs_currency','pgcharges_currency','coupon_percentage')
	packages_price(
    'packages_air_adult', 'packages_cruise_adult', 'packages_cruiseport_adult', 'packages_cruisegratuity_adult', 
    'packages_cruisegst_adult', 'packages_hotel_adult', 'packages_tours_adult', 'packages_transfer_adult', 
    'packages_visa_adult', 'packages_inc_adult', 'packages_meals_adult', 'packages_additionalservice_adult', 
    'packages_tourtotal_adult', 'packages_tourtotal_exadult', 'packages_tourtotal_childbed', 
    'packages_tourtotal_childwbed', 'packages_tourtotal_infant', 'packages_tourtotal_single', 'pricemarkup', 
    'markup_percentage', 'packages_markup_adult', 'packages_markup_exadult', 'packages_markup_childbed', 
    'packages_markup_childwbed', 'packages_markup_infant', 'packages_markup_single', 'packages_total_adult', 
    'packages_discount_adult_plus', 'packages_gross_total_adult', 'packages_gross_total_exadult', 
    'packages_gross_total_childbed', 'packages_gross_total_childwbed', 'packages_gross_total_infant', 
    'packages_gross_total_single', 'packages_gross_total_group', 'packages_discount_adult_minus', 
    'packages_discount_exadult_minus', 'packages_discount_childbed_minus', 'packages_discount_childwbed_minus', 
    'packages_discount_infant_minus', 'packages_discount_single_minus', 'pricegst', 'gst_percentage', 
    'packages_gst_adult', 'packages_gst_adult', 'packages_gst_exadult', 'packages_gst_childbed', 
    'packages_gst_childwbed', 'packages_gst_infant', 'packages_gst_single', 'packages_gst_group', 
    'packages_gsttotal_adult', 'pricetcs', 'tcs_percentage', 'packages_tcs_adult', 'packages_tcs_exadult', 
    'packages_tcs_childbed', 'packages_tcs_childwbed', 'packages_tcs_infant', 'packages_tcs_single', 
    'packages_tcs_group', 'packages_tcstotal_adult', 'pricepgcharges', 'pgcharges_percentage', 
    'packages_pgcharges_adult', 'packages_pgcharges_exadult', 'packages_pgcharges_childbed', 
    'packages_pgcharges_childwbed', 'packages_pgcharges_infant', 'packages_pgcharges_single', 
    'packages_pg_group', 'packages_grand_adult', 'packages_grand_adult_with_person', 'query_pricetopay', 
    'packages_number_of_adult', 'packages_number_of_extra_adult', 'packages_number_of_child_with_bed', 
    'packages_number_of_child_without_bed', 'packages_number_of_infant', 'packages_number_solo_traveller', 
    'packages_grand_exadult_with_person', 'packages_grand_childbed_with_person', 'packages_grand_childwbed_with_person', 
    'packages_grand_infant_with_person', 'packages_grand_single_with_person', 'packages_discount_group', 
    'packages_gsttotal_exadult', 'packages_gsttotal_childbed', 'packages_gsttotal_childwbed', 
    'packages_gsttotal_infant', 'packages_gsttotal_single', 'packages_tcstotal_exadult', 
    'packages_tcstotal_childbed', 'packages_tcstotal_childwbed', 'packages_tcstotal_infant', 
    'packages_tcstotal_single', 'packages_air_exadult', 'packages_cruise_exadult', 'packages_cruiseport_exadult', 
    'packages_cruisegratuity_exadult', 'packages_cruisegst_exadult', 'packages_hotel_exadult', 
    'packages_tours_exadult', 'packages_transfer_exadult', 'packages_visa_exadult', 'packages_inc_exadult', 
    'packages_meals_exadult', 'packages_additionalservice_exadult', 'packages_discount_exadult_plus', 
    'packages_grand_exadult', 'packages_grand_childbed', 'packages_grand_childwbed', 'packages_grand_infant', 
    'packages_grand_single', 'packages_air_childbed', 'packages_cruise_childbed', 'packages_cruiseport_childbed', 
    'packages_cruisegratuity_childbed', 'packages_cruisegst_childbed', 'packages_hotel_childbed', 
    'packages_tours_childbed', 'packages_transfer_childbed', 'packages_visa_childbed', 'packages_inc_childbed', 
    'packages_meals_childbed', 'packages_additionalservice_childbed', 'packages_discount_childbed_plus', 
    'packages_air_childwbed', 'packages_cruise_childwbed', 'packages_cruiseport_childwbed', 
    'packages_cruisegratuity_childwbed', 'packages_cruisegst_childwbed', 'packages_hotel_childwbed', 
    'packages_tours_childwbed', 'packages_transfer_childwbed', 'packages_visa_childwbed', 'packages_inc_childwbed', 
    'packages_meals_childwbed', 'packages_additionalservice_childwbed', 'packages_discount_childwbed_plus', 
    'packages_air_infant', 'packages_cruise_infant', 'packages_cruiseport_infant', 'packages_cruisegratuity_infant', 
    'packages_cruisegst_infant', 'packages_hotel_infant', 'packages_tours_infant', 'packages_transfer_infant', 
    'packages_visa_infant', 'packages_inc_infant', 'packages_meals_infant', 'packages_additionalservice_infant', 
    'packages_discount_infant_plus', 'packages_air_single', 'packages_cruise_single', 'packages_cruiseport_single', 
    'packages_cruisegratuity_single', 'packages_cruisegst_single', 'packages_hotel_single', 'packages_tours_single', 
    'packages_transfer_single', 'packages_visa_single', 'packages_inc_single', 'packages_meals_single', 
    'packages_additionalservice_single', 'packages_discount_single_plus', 'packages_pricetopay', 
    'pricediscountpositive', 'discountpositive_percentage', 'pricediscountnegative', 'discountnegative_percentage', 
    'aircurrency', 'cruisecurrency', 'portchargecurrency', 'gratuitycurrency', 'cruise_gstcurrency', 
    'accommodationcurrency', 'sightseeingcurrency', 'transferscurrency', 'visacurrency', 'travelcurrency', 
    'mealscurrency', 'addon_servicecurrency', 'markupcurrency', 'discount_positive_currency', 
    'discount_negative_currency', 'gst_currency', 'tcs_currency', 'pgcharges_currency', 'coupon_percentage'
	);
}

//
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
	$(".packages_pop_passenger_value").val('').val(pass)
}

$(document).on("click",".twin_adult_room_inc",function() {
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
});

$(document).on("click",".twin_adult_room_dec",function() {
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
});

$(document).on("click",".extra_adult_room_inc",function() {
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
});

$(document).on("click",".extra_adult_room_dec",function() {
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
});

$(document).on("click",".child_with_bed_room_inc",function() {
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
});

$(document).on("click",".child_with_bed_room_dec",function() {
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
});

$(document).on("click",".child_without_bed_room_inc",function() {
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
});

$(document).on("click",".child_without_bed_room_dec",function() {
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
});

$(document).on("click",".infant_room_inc",function() {
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
});

$(document).on("click",".infant_room_dec",function() {
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
});

$(document).on("click",".single_room_inc",function() {
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
});

$(document).on("click",".single_room_dec",function() {
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
});

$(document).on('change','.max_passenger',function(event) {
	var max_passenger=$(this).val();
	var passenger=0;
	$(this).siblings('.flexBetween').children().each(function() {
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
});*/


/*----------*/

// no of traveller
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
        $(".packages_adult_room_value").val("").val(twin_adult);
        $(".packages_adult_room_result").html("").html(twin_adult);

        $(".packages_number_of_extra_adult").val("").val(extra_adult);
        $(".packages_child_extra_adult_result").html("").html(extra_adult);

        $(".packages_number_of_child_with_bed").val("").val(child_with_bed);
        $(".packages_child_with_bed_result").html("").html(child_with_bed);

        $(".packages_number_of_child_without_bed").val("").val(child_without_bed);
        $(".packages_span_value_childwithoutbed_result").html("").html(child_without_bed);

        $(".packages_number_of_infant").val("").val(infant_room);
        $(".packages_infant_result").html("").html(infant_room);

        $(".packages_number_solo_traveller").val("").val(single_room);
        $(".packages_solo_result").html("").html(single_room);

        // Call the price calculation function with all required parameters
        //packages_price('packages_air_adult','packages_cruise_adult','packages_cruiseport_adult','packages_cruisegratuity_adult','packages_cruisegst_adult','packages_hotel_adult','packages_tours_adult','packages_transfer_adult','packages_visa_adult','packages_inc_adult','packages_meals_adult','packages_additionalservice_adult','packages_tourtotal_adult','packages_tourtotal_exadult','packages_tourtotal_childbed','packages_tourtotal_childwbed','packages_tourtotal_infant','packages_tourtotal_single','pricemarkup','markup_percentage','packages_markup_adult','packages_markup_exadult','packages_markup_childbed','packages_markup_childwbed','packages_markup_infant','packages_markup_single','packages_total_adult','packages_discount_adult_plus','packages_gross_total_adult','packages_gross_total_exadult','packages_gross_total_childbed','packages_gross_total_childwbed','packages_gross_total_infant','packages_gross_total_single','packages_gross_total_group','packages_discount_adult_minus','packages_discount_exadult_minus','packages_discount_childbed_minus','packages_discount_childwbed_minus','packages_discount_infant_minus','packages_discount_single_minus','pricegst','gst_percentage','packages_gst_adult','packages_gst_adult','packages_gst_exadult','packages_gst_childbed','packages_gst_childwbed','packages_gst_infant','packages_gst_single','packages_gst_group','packages_gsttotal_adult','pricetcs','tcs_percentage','packages_tcs_adult','packages_tcs_exadult','packages_tcs_childbed','packages_tcs_childwbed','packages_tcs_infant','packages_tcs_single','packages_tcs_group','packages_tcstotal_adult','pricepgcharges','pgcharges_percentage','packages_pgcharges_adult','packages_pgcharges_exadult','packages_pgcharges_childbed','packages_pgcharges_childwbed','packages_pgcharges_infant','packages_pgcharges_single','packages_pg_group','packages_grand_adult','packages_grand_adult_with_person','query_pricetopay','packages_number_of_adult','packages_number_of_extra_adult','packages_number_of_child_with_bed','packages_number_of_child_without_bed','packages_number_of_infant','packages_number_solo_traveller','packages_grand_exadult_with_person','packages_grand_childbed_with_person','packages_grand_childwbed_with_person','packages_grand_infant_with_person','packages_grand_single_with_person','packages_discount_group','packages_gsttotal_exadult','packages_gsttotal_childbed','packages_gsttotal_childwbed','packages_gsttotal_infant','packages_gsttotal_single','packages_tcstotal_exadult','packages_tcstotal_childbed','packages_tcstotal_childwbed','packages_tcstotal_infant','packages_tcstotal_single','packages_air_exadult','packages_cruise_exadult','packages_cruiseport_exadult','packages_cruisegratuity_exadult','packages_cruisegst_exadult','packages_hotel_exadult','packages_tours_exadult','packages_transfer_exadult','packages_visa_exadult','packages_inc_exadult','packages_meals_exadult','packages_additionalservice_exadult','packages_discount_exadult_plus','packages_grand_exadult','packages_grand_childbed','packages_grand_childwbed','packages_grand_infant','packages_grand_single','packages_air_childbed','packages_cruise_childbed','packages_cruiseport_childbed','packages_cruisegratuity_childbed','packages_cruisegst_childbed','packages_hotel_childbed','packages_tours_childbed','packages_transfer_childbed','packages_visa_childbed','packages_inc_childbed','packages_meals_childbed','packages_additionalservice_childbed','packages_discount_childbed_plus','packages_air_childwbed','packages_cruise_childwbed','packages_cruiseport_childwbed','packages_cruisegratuity_childwbed','packages_cruisegst_childwbed','packages_hotel_childwbed','packages_tours_childwbed','packages_transfer_childwbed','packages_visa_childwbed','packages_inc_childwbed','packages_meals_childwbed','packages_additionalservice_childwbed','packages_discount_childwbed_plus','packages_air_infant','packages_cruise_infant','packages_cruiseport_infant','packages_cruisegratuity_infant','packages_cruisegst_infant','packages_hotel_infant','packages_tours_infant','packages_transfer_infant','packages_visa_infant','packages_inc_infant','packages_meals_infant','packages_additionalservice_infant','packages_discount_infant_plus','packages_air_single','packages_cruise_single','packages_cruiseport_single','packages_cruisegratuity_single','packages_cruisegst_single','packages_hotel_single','packages_tours_single','packages_transfer_single','packages_visa_single','packages_inc_single','packages_meals_single','packages_additionalservice_single','packages_discount_single_plus','packages_pricetopay','pricediscountpositive','discountpositive_percentage','pricediscountnegative','discountnegative_percentage','advance_payment','advance_payment_percentage','packages_advance_payment','first_part_payment','first_part_percentage','packages_first_part','second_part_payment','second_part_percentage','packages_second_part','packages_total_payment','show_part_payment','advance_payment_percentage','packages_advance_payment','first_part_percentage','packages_first_part','second_part_percentage','packages_second_part','packages_total_payment','coupon_percentage');
    	packages_price(
    'packages_air_adult', 'packages_cruise_adult', 'packages_cruiseport_adult', 'packages_cruisegratuity_adult', 
    'packages_cruisegst_adult', 'packages_hotel_adult', 'packages_tours_adult', 'packages_transfer_adult', 
    'packages_visa_adult', 'packages_inc_adult', 'packages_meals_adult', 'packages_additionalservice_adult', 
    'packages_tourtotal_adult', 'packages_tourtotal_exadult', 'packages_tourtotal_childbed', 
    'packages_tourtotal_childwbed', 'packages_tourtotal_infant', 'packages_tourtotal_single', 'pricemarkup', 
    'markup_percentage', 'packages_markup_adult', 'packages_markup_exadult', 'packages_markup_childbed', 
    'packages_markup_childwbed', 'packages_markup_infant', 'packages_markup_single', 'packages_total_adult', 
    'packages_discount_adult_plus', 'packages_gross_total_adult', 'packages_gross_total_exadult', 
    'packages_gross_total_childbed', 'packages_gross_total_childwbed', 'packages_gross_total_infant', 
    'packages_gross_total_single', 'packages_gross_total_group', 'packages_discount_adult_minus', 
    'packages_discount_exadult_minus', 'packages_discount_childbed_minus', 'packages_discount_childwbed_minus', 
    'packages_discount_infant_minus', 'packages_discount_single_minus', 'pricegst', 'gst_percentage', 
    'packages_gst_adult', 'packages_gst_adult', 'packages_gst_exadult', 'packages_gst_childbed', 
    'packages_gst_childwbed', 'packages_gst_infant', 'packages_gst_single', 'packages_gst_group', 
    'packages_gsttotal_adult', 'pricetcs', 'tcs_percentage', 'packages_tcs_adult', 'packages_tcs_exadult', 
    'packages_tcs_childbed', 'packages_tcs_childwbed', 'packages_tcs_infant', 'packages_tcs_single', 
    'packages_tcs_group', 'packages_tcstotal_adult', 'pricepgcharges', 'pgcharges_percentage', 
    'packages_pgcharges_adult', 'packages_pgcharges_exadult', 'packages_pgcharges_childbed', 
    'packages_pgcharges_childwbed', 'packages_pgcharges_infant', 'packages_pgcharges_single', 
    'packages_pg_group', 'packages_grand_adult', 'packages_grand_adult_with_person', 'query_pricetopay', 
    'packages_number_of_adult', 'packages_number_of_extra_adult', 'packages_number_of_child_with_bed', 
    'packages_number_of_child_without_bed', 'packages_number_of_infant', 'packages_number_solo_traveller', 
    'packages_grand_exadult_with_person', 'packages_grand_childbed_with_person', 'packages_grand_childwbed_with_person', 
    'packages_grand_infant_with_person', 'packages_grand_single_with_person', 'packages_discount_group', 
    'packages_gsttotal_exadult', 'packages_gsttotal_childbed', 'packages_gsttotal_childwbed', 
    'packages_gsttotal_infant', 'packages_gsttotal_single', 'packages_tcstotal_exadult', 
    'packages_tcstotal_childbed', 'packages_tcstotal_childwbed', 'packages_tcstotal_infant', 
    'packages_tcstotal_single', 'packages_air_exadult', 'packages_cruise_exadult', 'packages_cruiseport_exadult', 
    'packages_cruisegratuity_exadult', 'packages_cruisegst_exadult', 'packages_hotel_exadult', 
    'packages_tours_exadult', 'packages_transfer_exadult', 'packages_visa_exadult', 'packages_inc_exadult', 
    'packages_meals_exadult', 'packages_additionalservice_exadult', 'packages_discount_exadult_plus', 
    'packages_grand_exadult', 'packages_grand_childbed', 'packages_grand_childwbed', 'packages_grand_infant', 
    'packages_grand_single', 'packages_air_childbed', 'packages_cruise_childbed', 'packages_cruiseport_childbed', 
    'packages_cruisegratuity_childbed', 'packages_cruisegst_childbed', 'packages_hotel_childbed', 
    'packages_tours_childbed', 'packages_transfer_childbed', 'packages_visa_childbed', 'packages_inc_childbed', 
    'packages_meals_childbed', 'packages_additionalservice_childbed', 'packages_discount_childbed_plus', 
    'packages_air_childwbed', 'packages_cruise_childwbed', 'packages_cruiseport_childwbed', 
    'packages_cruisegratuity_childwbed', 'packages_cruisegst_childwbed', 'packages_hotel_childwbed', 
    'packages_tours_childwbed', 'packages_transfer_childwbed', 'packages_visa_childwbed', 'packages_inc_childwbed', 
    'packages_meals_childwbed', 'packages_additionalservice_childwbed', 'packages_discount_childwbed_plus', 
    'packages_air_infant', 'packages_cruise_infant', 'packages_cruiseport_infant', 'packages_cruisegratuity_infant', 
    'packages_cruisegst_infant', 'packages_hotel_infant', 'packages_tours_infant', 'packages_transfer_infant', 
    'packages_visa_infant', 'packages_inc_infant', 'packages_meals_infant', 'packages_additionalservice_infant', 
    'packages_discount_infant_plus', 'packages_air_single', 'packages_cruise_single', 'packages_cruiseport_single', 
    'packages_cruisegratuity_single', 'packages_cruisegst_single', 'packages_hotel_single', 'packages_tours_single', 
    'packages_transfer_single', 'packages_visa_single', 'packages_inc_single', 'packages_meals_single', 
    'packages_additionalservice_single', 'packages_discount_single_plus', 'packages_pricetopay', 
    'pricediscountpositive', 'discountpositive_percentage', 'pricediscountnegative', 'discountnegative_percentage', 
    'aircurrency', 'cruisecurrency', 'portchargecurrency', 'gratuitycurrency', 'cruise_gstcurrency', 
    'accommodationcurrency', 'sightseeingcurrency', 'transferscurrency', 'visacurrency', 'travelcurrency', 
    'mealscurrency', 'addon_servicecurrency', 'markupcurrency', 'discount_positive_currency', 
    'discount_negative_currency', 'gst_currency', 'tcs_currency', 'pgcharges_currency', 'coupon_percentage'
		);
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

        // Determine the correct pluralization for room, adult, child, and infant
        var roomText = select_room === 1 ? '1 Room' : select_room + ' Rooms';
        var adultText = adult === 1 ? '1 Adult' : adult > 1 ? adult + ' Adults' : '';
        var childText = child === 1 ? '1 Child' : child > 1 ? child + ' Children' : '';
        var infantText = infant === 1 ? '1 Infant' : infant > 1 ? infant + ' Infants' : '';

        // Construct the passenger information string, only adding non-zero values
        var pass = roomText + ' (';
        var passengerDetails = [];

        if (adultText) passengerDetails.push(adultText);
        if (childText) passengerDetails.push(childText);
        if (infantText) passengerDetails.push(infantText);

        pass += passengerDetails.join(', ') + ')';

        // Set the constructed string to the input field
        $(".packages_pop_passenger_value").val('').val(pass);
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

// update price total on changes in pricing
$(document).on("keyup change",".packages_air_adult , .packages_cruise_adult , .packages_cruiseport_adult , .packages_cruisegratuity_adult , .packages_cruisegst_adult , .packages_hotel_adult , .packages_tours_adult , .packages_transfer_adult , .packages_visa_adult , .packages_inc_adult , .packages_meals_adult , .packages_additionalservice_adult ,.pricemarkup , .markup_percentage,.packages_markup_adult,.packages_markup_adult, .packages_markup_exadult, .packages_markup_childbed, .packages_markup_childwbed,.packages_markup_infant,.packages_markup_single ,.pricegst ,.gst_percentage ,.packages_gst_adult,.packages_gst_exadult,.packages_gst_childbed,.packages_gst_childwbed,.packages_gst_infant,.packages_gst_single ,.pricetcs ,.tcs_percentage ,.packages_tcs_adult ,.packages_tcs_exadult,.packages_tcs_childbed,.packages_tcs_childwbed,.packages_tcs_infant,.packages_tcs_single,.pricepgcharges ,.pgcharges_percentage , .packages_pgcharges_adult,.packages_pgcharges_exadult,.packages_pgcharges_childbed,.packages_pgcharges_childwbed,.packages_pgcharges_infant,.packages_pgcharges_single,.packages_discount_adult_plus,.packages_discount_exadult_minus,.packages_discount_childbed_minus,.packages_discount_childwbed_minus,.packages_discount_infant_minus,.packages_discount_single_minus ,.packages_discount_adult_minus,.packages_air_exadult,.packages_cruise_exadult,.packages_cruiseport_exadult,.packages_cruisegratuity_exadult,.packages_cruisegst_exadult,.packages_hotel_exadult,.packages_tours_exadult,.packages_transfer_exadult,.packages_visa_exadult,.packages_inc_exadult,.packages_meals_exadult,.packages_additionalservice_exadult,.packages_discount_exadult_plus,.packages_air_childbed,.packages_cruise_childbed,.packages_cruiseport_childbed,.packages_cruisegratuity_childbed,.packages_cruisegst_childbed,.packages_hotel_childbed,.packages_tours_childbed,.packages_transfer_childbed,.packages_visa_childbed,.packages_inc_childbed,.packages_meals_childbed,.packages_additionalservice_childbed,.packages_discount_childbed_plus,.packages_air_childwbed,.packages_cruise_childwbed,.packages_cruiseport_childwbed,.packages_cruisegratuity_childwbed,.packages_cruisegst_childwbed,.packages_hotel_childwbed,.packages_tours_childwbed,.packages_transfer_childwbed,.packages_visa_childwbed,.packages_inc_childwbed,.packages_meals_childwbed,.packages_additionalservice_childwbed,.packages_discount_childwbed_plus,.packages_air_infant,.packages_cruise_infant,.packages_cruiseport_infant,.packages_cruisegratuity_infant,.packages_cruisegst_infant,.packages_hotel_infant,.packages_tours_infant,.packages_transfer_infant,.packages_visa_infant,.packages_inc_infant,.packages_meals_infant,.packages_additionalservice_infant,.packages_discount_infant_plus,.packages_air_single,.packages_cruise_single,.packages_cruiseport_single,.packages_cruisegratuity_single,.packages_cruisegst_single,.packages_hotel_single,.packages_tours_single,.packages_transfer_single,.packages_visa_single,.packages_inc_single,.packages_meals_single,.packages_additionalservice_single,.packages_discount_single_plus,.pricediscountpositive,.discountpositive_percentage,.pricediscountnegative,.discountnegative_percentage,.coupon_percentage,.aircurrency,.cruisecurrency,.portchargecurrency,.gratuitycurrency,.cruise_gstcurrency,.accommodationcurrency,.sightseeingcurrency,.transferscurrency,.visacurrency,.travelcurrency,.mealscurrency,.addon_servicecurrency,.markupcurrency,.discount_positive_currency,.discount_negative_currency,.gst_currency,.tcs_currency,.pgcharges_currency",function(){
	packages_price('packages_air_adult','packages_cruise_adult','packages_cruiseport_adult','packages_cruisegratuity_adult','packages_cruisegst_adult','packages_hotel_adult','packages_tours_adult','packages_transfer_adult','packages_visa_adult','packages_inc_adult','packages_meals_adult','packages_additionalservice_adult','packages_tourtotal_adult','packages_tourtotal_exadult','packages_tourtotal_childbed','packages_tourtotal_childwbed','packages_tourtotal_infant','packages_tourtotal_single','pricemarkup','markup_percentage','packages_markup_adult','packages_markup_exadult','packages_markup_childbed','packages_markup_childwbed','packages_markup_infant','packages_markup_single','packages_total_adult','packages_discount_adult_plus','packages_gross_total_adult','packages_gross_total_exadult','packages_gross_total_childbed','packages_gross_total_childwbed','packages_gross_total_infant','packages_gross_total_single','packages_gross_total_group','packages_discount_adult_minus','packages_discount_exadult_minus','packages_discount_childbed_minus','packages_discount_childwbed_minus','packages_discount_infant_minus','packages_discount_single_minus','pricegst','gst_percentage','packages_gst_adult','packages_gst_adult','packages_gst_exadult','packages_gst_childbed','packages_gst_childwbed','packages_gst_infant','packages_gst_single','packages_gst_group','packages_gsttotal_adult','pricetcs','tcs_percentage','packages_tcs_adult','packages_tcs_exadult','packages_tcs_childbed','packages_tcs_childwbed','packages_tcs_infant','packages_tcs_single','packages_tcs_group','packages_tcstotal_adult','pricepgcharges','pgcharges_percentage','packages_pgcharges_adult','packages_pgcharges_exadult','packages_pgcharges_childbed','packages_pgcharges_childwbed','packages_pgcharges_infant','packages_pgcharges_single','packages_pg_group','packages_grand_adult','packages_grand_adult_with_person','query_pricetopay','packages_number_of_adult','packages_number_of_extra_adult','packages_number_of_child_with_bed','packages_number_of_child_without_bed','packages_number_of_infant','packages_number_solo_traveller','packages_grand_exadult_with_person','packages_grand_childbed_with_person','packages_grand_childwbed_with_person','packages_grand_infant_with_person','packages_grand_single_with_person','packages_discount_group','packages_gsttotal_exadult','packages_gsttotal_childbed','packages_gsttotal_childwbed','packages_gsttotal_infant','packages_gsttotal_single','packages_tcstotal_exadult','packages_tcstotal_childbed','packages_tcstotal_childwbed','packages_tcstotal_infant','packages_tcstotal_single','packages_air_exadult','packages_cruise_exadult','packages_cruiseport_exadult','packages_cruisegratuity_exadult','packages_cruisegst_exadult','packages_hotel_exadult','packages_tours_exadult','packages_transfer_exadult','packages_visa_exadult','packages_inc_exadult','packages_meals_exadult','packages_additionalservice_exadult','packages_discount_exadult_plus','packages_grand_exadult','packages_grand_childbed','packages_grand_childwbed','packages_grand_infant','packages_grand_single','packages_air_childbed','packages_cruise_childbed','packages_cruiseport_childbed','packages_cruisegratuity_childbed','packages_cruisegst_childbed','packages_hotel_childbed','packages_tours_childbed','packages_transfer_childbed','packages_visa_childbed','packages_inc_childbed','packages_meals_childbed','packages_additionalservice_childbed','packages_discount_childbed_plus','packages_air_childwbed','packages_cruise_childwbed','packages_cruiseport_childwbed','packages_cruisegratuity_childwbed','packages_cruisegst_childwbed','packages_hotel_childwbed','packages_tours_childwbed','packages_transfer_childwbed','packages_visa_childwbed','packages_inc_childwbed','packages_meals_childwbed','packages_additionalservice_childwbed','packages_discount_childwbed_plus','packages_air_infant','packages_cruise_infant','packages_cruiseport_infant','packages_cruisegratuity_infant','packages_cruisegst_infant','packages_hotel_infant','packages_tours_infant','packages_transfer_infant','packages_visa_infant','packages_inc_infant','packages_meals_infant','packages_additionalservice_infant','packages_discount_infant_plus','packages_air_single','packages_cruise_single','packages_cruiseport_single','packages_cruisegratuity_single','packages_cruisegst_single','packages_hotel_single','packages_tours_single','packages_transfer_single','packages_visa_single','packages_inc_single','packages_meals_single','packages_additionalservice_single','packages_discount_single_plus','packages_pricetopay','pricediscountpositive','discountpositive_percentage','pricediscountnegative','discountnegative_percentage','aircurrency','cruisecurrency','portchargecurrency','gratuitycurrency','cruise_gstcurrency','accommodationcurrency','sightseeingcurrency','transferscurrency','visacurrency','travelcurrency','mealscurrency','addon_servicecurrency','markupcurrency','discount_positive_currency','discount_negative_currency','gst_currency','tcs_currency','pgcharges_currency','coupon_percentage')
});

// packages_price calculation
function packages_price(a1,a2,a3,a4,a5,a6,a7,a8,a9,a10,a11,a12,a13,a14,a15,a16,a17,a18,a19,a20,a21,a22,a23,a24,a25,a26,a27,a28,a29,a30,a31,a32,a33,a34,a35,a36,a37,a38,a39,a40,a41,a42,a43,a44,a45,a46,a47,a48,a49,a50,a51,a52,a53,a54,a55,a56,a57,a58,a59,a60,a61,a62,a63,a64,a65,a66,a67,a68,a69,a70,a71,a72,a73,a74,a75,a76,a77,a78,a79,a80,a81,a82,a83,a84,a85,a86,a87,a88,a89,a90,a91,a92,a93,a94,a95,a96,a97,a98,a99,a100,a101,a102,a103,a104,a105,a106,a107,a108,a109,a110,a111,a112,a113,a114,a115,a116,a117,a118,a119,a120,a121,a122,a123,a124,a125,a126,a127,a128,a129,a130,a131,a132,a133,a134,a135,a136,a137,a138,a139,a140,a141,a142,a143,a144,a145,a146,a147,a148,a149,a150,a151,a152,a153,a154,a155,a156,a157,a158,a159,a160,a161,a162,a163,a164,a165,a166,a167,a168,a169,a170,a171,a172,a173,a174,a175,a176,a177,a178,a179,a180,a181,a182,a183,a184,a185,a186,a187,a188,a189,a190) {
	var aircurrency= $("."+a172).find('option:selected').attr('c_val')
	if(aircurrency=='')
	{
	aircurrency=0;
	}
	var cruisecurrency= $("."+a173).find('option:selected').attr('c_val')
	if(cruisecurrency=='')
	{
	cruisecurrency=0;
	}
	var portchargecurrency= $("."+a174).find('option:selected').attr('c_val')
	if(portchargecurrency=='')
	{
	portchargecurrency=0;
	}
	var gratuitycurrency= $("."+a175).find('option:selected').attr('c_val')
	if(gratuitycurrency=='')
	{
	gratuitycurrency=0;
	}
	var cruise_gstcurrency= $("."+a176).find('option:selected').attr('c_val')
	if(cruise_gstcurrency=='')
	{
	cruise_gstcurrency=0;
	}
	var accommodationcurrency= $("."+a177).find('option:selected').attr('c_val')
	if(accommodationcurrency=='')
	{
	accommodationcurrency=0;
	}
	var sightseeingcurrency= $("."+a178).find('option:selected').attr('c_val')
	if(sightseeingcurrency=='')
	{
	sightseeingcurrency=0;
	}
	var transferscurrency= $("."+a179).find('option:selected').attr('c_val')
	if(transferscurrency=='')
	{
	transferscurrency=0;
	}
	var visacurrency =$("."+a180).find('option:selected').attr('c_val')
	if(visacurrency=='')
	{
	visacurrency=0;
	}
	var travelcurrency =$("."+a181).find('option:selected').attr('c_val')
	if(travelcurrency=='')
	{
	travelcurrency=0;
	}
	var mealscurrency=  $("."+a182).find('option:selected').attr('c_val')
	if(mealscurrency=='')
	{
	mealscurrency=0;
	}
	var addon_servicecurrency= $("."+a183).find('option:selected').attr('c_val')
	if(addon_servicecurrency=='')
	{
	addon_servicecurrency=0;
	}
	var markupcurrency= $("."+a184).find('option:selected').attr('c_val')
	if(markupcurrency=='')
	{
	markupcurrency=0;
	}
	var discount_positive_currency= $("."+a185).find('option:selected').attr('c_val')
	if(discount_positive_currency=='')
	{
	discount_positive_currency=0;
	}
	var discount_negative_currency= $("."+a186).find('option:selected').attr('c_val')
	if(discount_negative_currency=='')
	{
	discount_negative_currency=0;
	}
	var gst_currency =$("."+a187).find('option:selected').attr('c_val')
	if(gst_currency=='')
	{
	gst_currency=0;
	}
	var tcs_currency= $("."+a188).find('option:selected').attr('c_val')
	if(tcs_currency=='')
	{
	tcs_currency=0;
	}
	var pgcharges_currency= $("."+a189).find('option:selected').attr('c_val')
	if(pgcharges_currency=='')
	{
	pgcharges_currency=0;
	}
	var air=$("."+a1).val();
	if(air=='')
	{
	air=0;
	}
	air=air*aircurrency;
	var cruise =$("."+a2).val();
	if(cruise=='')
	{
	cruise=0;
	}
	cruise=cruise*cruisecurrency;
	var port=$("."+a3).val();
	if(port=='')
	{
	port=0;
	}
	port=port*portchargecurrency;
	var gratuity=$("."+a4).val();
	if(gratuity=='')
	{
	gratuity=0;
	}
	gratuity=gratuity*gratuitycurrency;
	var cruisegst=$("."+a5).val();
	if(cruisegst=='')
	{
	cruisegst=0;
	}
	cruisegst=cruisegst*cruise_gstcurrency;
	var accommodation=$("."+a6).val();
	if(accommodation=='')
	{
	accommodation=0;
	}
	accommodation=accommodation*accommodationcurrency;
	var sightseeing=$("."+a7).val();
	if(sightseeing=='')
	{
	sightseeing=0;
	}
	sightseeing=sightseeing*sightseeingcurrency;
	var transfer=$("."+a8).val();
	if(transfer=='')
	{
	transfer=0;
	}
	transfer=transfer*transferscurrency;
	var visa=$("."+a9).val();
	if(visa=='')
	{
	visa=0;
	}
	visa=visa*visacurrency;
	var inc=$("."+a10).val();
	if(inc=='')
	{
	inc=0;
	}
	inc=inc*travelcurrency;
	var meals=$("."+a11).val();
	if(meals=='')
	{
	meals=0;
	}
	meals=meals*mealscurrency;
	var additionalservice=$("."+a12).val();
	if(additionalservice=='')
	{
	additionalservice=0;
	}
	additionalservice=additionalservice*addon_servicecurrency;
	//total 13
	$("."+a13).val('').val(Math.round(air)+Math.round(cruise)+Math.round(port)+Math.round(gratuity)+Math.round(cruisegst)+Math.round(additionalservice)+Math.round(accommodation)+Math.round(sightseeing)+Math.round(transfer)+Math.round(visa)+Math.round(inc)+Math.round(meals))
	//
	var air_exadult=$("."+a97).val();
	if(air_exadult=='')
	{
	air_exadult=0;
	}
	air_exadult=air_exadult*aircurrency;
	var cruise_exadult =$("."+a98).val();
	if(cruise_exadult=='')
	{
	cruise_exadult=0;
	}
	cruise_exadult=cruise_exadult*cruisecurrency;
	var port_exadult=$("."+a99).val();
	if(port_exadult=='')
	{
	port_exadult=0;
	}
	port_exadult=port_exadult*portchargecurrency;
	var gratuity_exadult=$("."+a100).val();
	if(gratuity_exadult=='')
	{
	gratuity_exadult=0;
	}
	gratuity_exadult=gratuity_exadult*gratuitycurrency;
	var cruisegst_exadult=$("."+a101).val();
	if(cruisegst_exadult=='')
	{
	cruisegst_exadult=0;
	}
	cruisegst_exadult=cruisegst_exadult*cruise_gstcurrency;
	var accommodation_exadult=$("."+a102).val();
	if(accommodation_exadult=='')
	{
	accommodation_exadult=0;
	}
	accommodation_exadult=accommodation_exadult*accommodationcurrency;
	var sightseeing_exadult=$("."+a103).val();
	if(sightseeing_exadult=='')
	{
	sightseeing_exadult=0;
	}
	sightseeing_exadult=sightseeing_exadult*sightseeingcurrency;
	var transfer_exadult=$("."+a104).val();
	if(transfer_exadult=='')
	{
	transfer_exadult=0;
	}
	transfer_exadult=transfer_exadult*transferscurrency;
	var visa_exadult=$("."+a105).val();
	if(visa_exadult=='')
	{
	visa_exadult=0;
	}
	visa_exadult=visa_exadult*visacurrency;
	var inc_exadult=$("."+a106).val();
	if(inc_exadult=='')
	{
	inc_exadult=0;
	}
	inc_exadult=inc_exadult*travelcurrency;
	var meals_exadult=$("."+a107).val();
	if(meals_exadult=='')
	{
	meals_exadult=0;
	}
	meals_exadult=meals_exadult*mealscurrency;
	var additionalservice_exadult=$("."+a108).val();
	if(additionalservice_exadult=='')
	{
	additionalservice_exadult=0;
	}
	additionalservice_exadult=additionalservice_exadult*addon_servicecurrency;
	//total 14
	$("."+a14).val('').val(Math.round(air_exadult)+Math.round(cruise_exadult)+Math.round(port_exadult)+Math.round(gratuity_exadult)+Math.round(cruisegst_exadult)+Math.round(additionalservice_exadult)+Math.round(accommodation_exadult)+Math.round(sightseeing_exadult)+Math.round(transfer_exadult)+Math.round(visa_exadult)+Math.round(inc_exadult)+Math.round(meals_exadult))
	//
	var air_childbed=$("."+a115).val();
	if(air_childbed=='')
	{
	air_childbed=0;
	}
	air_childbed=air_childbed*aircurrency;
	var cruise_childbed =$("."+a116).val();
	if(cruise_childbed=='')
	{
	cruise_childbed=0;
	}
	cruise_childbed=cruise_childbed*cruisecurrency;
	var port_childbed=$("."+a117).val();
	if(port_childbed=='')
	{
	port_childbed=0;
	}
	port_childbed=port_childbed*portchargecurrency;
	var gratuity_childbed=$("."+a118).val();
	if(gratuity_childbed=='')
	{
	gratuity_childbed=0;
	}
	gratuity_childbed=gratuity_childbed*gratuitycurrency;
	var cruisegst_childbed=$("."+a119).val();
	if(cruisegst_childbed=='')
	{
	cruisegst_childbed=0;
	}
	cruisegst_childbed=cruisegst_childbed*cruise_gstcurrency;
	var accommodation_childbed=$("."+a120).val();
	if(accommodation_childbed=='')
	{
	accommodation_childbed=0;
	}
	accommodation_childbed=accommodation_childbed*accommodationcurrency;
	var sightseeing_childbed=$("."+a121).val();
	if(sightseeing_childbed=='')
	{
	sightseeing_childbed=0;
	}
	sightseeing_childbed=sightseeing_childbed*sightseeingcurrency;
	var transfer_childbed=$("."+a122).val();
	if(transfer_childbed=='')
	{
	transfer_childbed=0;
	}
	transfer_childbed=transfer_childbed*transferscurrency;
	var visa_childbed=$("."+a123).val();
	if(visa_childbed=='')
	{
	visa_childbed=0;
	}
	visa_childbed=visa_childbed*visacurrency;
	var inc_childbed=$("."+a124).val();
	if(inc_childbed=='')
	{
	inc_childbed=0;
	}
	inc_childbed=inc_childbed*travelcurrency;
	var meals_childbed=$("."+a125).val();
	if(meals_childbed=='')
	{
	meals_childbed=0;
	}
	meals_childbed=meals_childbed*mealscurrency;
	var additionalservice_childbed=$("."+a126).val();
	if(additionalservice_childbed=='')
	{
	additionalservice_childbed=0;
	}
	additionalservice_childbed=additionalservice_childbed*addon_servicecurrency;
	//total 15
	$("."+a15).val('').val(Math.round(air_childbed)+Math.round(cruise_childbed)+Math.round(port_childbed)+Math.round(gratuity_childbed)+Math.round(cruisegst_childbed)+Math.round(additionalservice_childbed)+Math.round(accommodation_childbed)+Math.round(sightseeing_childbed)+Math.round(transfer_childbed)+Math.round(visa_childbed)+Math.round(inc_childbed)+Math.round(meals_childbed))
	//
	var air_childwbed=$("."+a128).val();
	if(air_childwbed=='')
	{
	air_childwbed=0;
	}
	air_childwbed=air_childwbed*aircurrency;
	var cruise_childwbed =$("."+a129).val();
	if(cruise_childwbed=='')
	{
	cruise_childwbed=0;
	}
	cruise_childwbed=cruise_childwbed*cruisecurrency;
	var port_childwbed=$("."+a130).val();
	if(port_childwbed=='')
	{
	port_childwbed=0;
	}
	port_childwbed=port_childwbed*portchargecurrency;
	var gratuity_childwbed=$("."+a131).val();
	if(gratuity_childwbed=='')
	{
	gratuity_childwbed=0;
	}
	gratuity_childwbed=gratuity_childwbed*gratuitycurrency;
	var cruisegst_childwbed=$("."+a132).val();
	if(cruisegst_childwbed=='')
	{
	cruisegst_childwbed=0;
	}
	cruisegst_childwbed=cruisegst_childwbed*cruise_gstcurrency;
	var accommodation_childwbed=$("."+a133).val();
	if(accommodation_childwbed=='')
	{
	accommodation_childwbed=0;
	}
	accommodation_childwbed=accommodation_childwbed*accommodationcurrency;
	var sightseeing_childwbed=$("."+a134).val();
	if(sightseeing_childwbed=='')
	{
	sightseeing_childwbed=0;
	}
	sightseeing_childwbed=sightseeing_childwbed*sightseeingcurrency;
	var transfer_childwbed=$("."+a135).val();
	if(transfer_childwbed=='')
	{
	transfer_childwbed=0;
	}
	transfer_childwbed=transfer_childwbed*transferscurrency;
	var visa_childwbed=$("."+a136).val();
	if(visa_childwbed=='')
	{
	visa_childwbed=0;
	}
	visa_childwbed=visa_childwbed*visacurrency;
	var inc_childwbed=$("."+a137).val();
	if(inc_childwbed=='')
	{
	inc_childwbed=0;
	}
	inc_childwbed=inc_childwbed*travelcurrency;
	var meals_childwbed=$("."+a138).val();
	if(meals_childwbed=='')
	{
	meals_childwbed=0;
	}
	meals_childwbed=meals_childwbed*mealscurrency;
	var additionalservice_childwbed=$("."+a139).val();
	if(additionalservice_childwbed=='')
	{
	additionalservice_childwbed=0;
	}
	additionalservice_childwbed=additionalservice_childwbed*addon_servicecurrency;
	//total 16
	$("."+a16).val('').val(Math.round(air_childwbed)+Math.round(cruise_childwbed)+Math.round(port_childwbed)+Math.round(gratuity_childwbed)+Math.round(cruisegst_childwbed)+Math.round(additionalservice_childwbed)+Math.round(accommodation_childwbed)+Math.round(sightseeing_childwbed)+Math.round(transfer_childwbed)+Math.round(visa_childwbed)+Math.round(inc_childwbed)+Math.round(meals_childwbed))
	//
	var air_infant=$("."+a141).val();
	if(air_infant=='')
	{
	air_infant=0;
	}
	air_infant=air_infant*aircurrency;
	var cruise_infant =$("."+a142).val();
	if(cruise_infant=='')
	{
	cruise_infant=0;
	}
	cruise_infant=cruise_infant*cruisecurrency;
	var port_infant=$("."+a143).val();
	if(port_infant=='')
	{
	port_infant=0;
	}
	port_infant=port_infant*portchargecurrency;
	var gratuity_infant=$("."+a144).val();
	if(gratuity_infant=='')
	{
	gratuity_infant=0;
	}
	gratuity_infant=gratuity_infant*gratuitycurrency;
	var cruisegst_infant=$("."+a145).val();
	if(cruisegst_infant=='')
	{
	cruisegst_infant=0;
	}
	cruisegst_infant=cruisegst_infant*cruise_gstcurrency;
	var accommodation_infant=$("."+a146).val();
	if(accommodation_infant=='')
	{
	accommodation_infant=0;
	}
	accommodation_infant=accommodation_infant*accommodationcurrency;
	var sightseeing_infant=$("."+a147).val();
	if(sightseeing_infant=='')
	{
	sightseeing_infant=0;
	}
	sightseeing_infant=sightseeing_infant*sightseeingcurrency;
	var transfer_infant=$("."+a148).val();
	if(transfer_infant=='')
	{
	transfer_infant=0;
	}
	transfer_infant=transfer_infant*transferscurrency;
	var visa_infant=$("."+a149).val();
	if(visa_infant=='')
	{
	visa_infant=0;
	}
	visa_infant=visa_infant*visacurrency;
	var inc_infant=$("."+a150).val();
	if(inc_infant=='')
	{
	inc_infant=0;
	}
	inc_infant=inc_infant*travelcurrency;
	var meals_infant=$("."+a151).val();
	if(meals_infant=='')
	{
	meals_infant=0;
	}
	meals_infant=meals_infant*mealscurrency;
	var additionalservice_infant=$("."+a152).val();
	if(additionalservice_infant=='')
	{
	additionalservice_infant=0;
	}
	additionalservice_infant=additionalservice_infant*addon_servicecurrency;
	//total 17
	$("."+a17).val('').val(Math.round(air_infant)+Math.round(cruise_infant)+Math.round(port_infant)+Math.round(gratuity_infant)+Math.round(cruisegst_infant)+Math.round(additionalservice_infant)+Math.round(accommodation_infant)+Math.round(sightseeing_infant)+Math.round(transfer_infant)+Math.round(visa_infant)+Math.round(inc_infant)+Math.round(meals_infant))
	//
	var air_single=$("."+a154).val();
	if(air_single=='')
	{
	air_single=0;
	}
	air_single=air_single*aircurrency;
	var cruise_single =$("."+a155).val();
	if(cruise_single=='')
	{
	cruise_single=0;
	}
	cruise_single=cruise_single*cruisecurrency;
	var port_single=$("."+a156).val();
	if(port_single=='')
	{
	port_single=0;
	}
	port_single=port_single*portchargecurrency;
	var gratuity_single=$("."+a157).val();
	if(gratuity_single=='')
	{
	gratuity_single=0;
	}
	gratuity_single=gratuity_single*gratuitycurrency;
	var cruisegst_single=$("."+a158).val();
	if(cruisegst_single=='')
	{
	cruisegst_single=0;
	}
	cruisegst_single=cruisegst_single*cruise_gstcurrency;
	var accommodation_single=$("."+a159).val();
	if(accommodation_single=='')
	{
	accommodation_single=0;
	}
	accommodation_single=accommodation_single*accommodationcurrency;
	var sightseeing_single=$("."+a160).val();
	if(sightseeing_single=='')
	{
	sightseeing_single=0;
	}
	sightseeing_single=sightseeing_single*sightseeingcurrency;
	var transfer_single=$("."+a161).val();
	if(transfer_single=='')
	{
	transfer_single=0;
	}
	transfer_single=transfer_single*transferscurrency;
	var visa_single=$("."+a162).val();
	if(visa_single=='')
	{
	visa_single=0;
	}
	visa_single=visa_single*visacurrency;
	var inc_single=$("."+a163).val();
	if(inc_single=='')
	{
	inc_single=0;
	}
	inc_single=inc_single*travelcurrency;
	var meals_single=$("."+a164).val();
	if(meals_single=='')
	{
	meals_single=0;
	}
	meals_single=meals_single*mealscurrency;
	var additionalservice_single=$("."+a165).val();
	if(additionalservice_single=='')
	{
	additionalservice_single=0;
	}
	additionalservice_single=additionalservice_single*addon_servicecurrency;
	//total 17
	$("."+a18).val('').val(Math.round(air_single)+Math.round(cruise_single)+Math.round(port_single)+Math.round(gratuity_single)+Math.round(cruisegst_single)+Math.round(additionalservice_single)+Math.round(accommodation_single)+Math.round(sightseeing_single)+Math.round(transfer_single)+Math.round(visa_single)+Math.round(inc_single)+Math.round(meals_single))
	var markup=$("."+a19).val();
	if(markup==1)
	{
	}
	else if(markup==2)
	{
	var percentage_markup=$("."+a20).val();
	if(percentage_markup!='')
	{
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
	if(discountpositive_percentage!='')
	{
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
	}
	else if(pricediscountpositive==3)
	{
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
	if(tourtotal_adult!='')
	{
	var gross_total=Math.round(gross_total)+Math.round(tourtotal_adult)
	}
	var markup_profit_adult=$("."+a21).val();
	if(markup_profit_adult!='')
	{
	var markup=$("."+a19).val();
	if(markup==1)
	{
	var gross_total=Math.round(gross_total)+Math.round(markup_profit_adult*markupcurrency)
	}
	else
	{
	var gross_total=Math.round(gross_total)+Math.round(markup_profit_adult)
	}
	}
	var discount_adult_plus=$("."+a28).val();
	if(discount_adult_plus!='')
	{
	var pricediscountpositive=$("."+a168).val();
	if(pricediscountpositive==1)
	{
	var gross_total=Math.round(gross_total)+Math.round(discount_adult_plus*discount_positive_currency)
	}
	else
	{
	var gross_total=Math.round(gross_total)+Math.round(discount_adult_plus)
	}
	}
	$("."+a29).val('').val(Math.round(gross_total))
	var gross_total_exa=0;
	var tourtotal_exadult=$("."+a14).val();
	if(tourtotal_exadult!='')
	{
	var gross_total_exa=Math.round(gross_total_exa)+Math.round(tourtotal_exadult)
	}
	var markup_profit_exadult=$("."+a22).val();
	if(markup_profit_exadult!='')
	{
	var markup=$("."+a19).val();
	if(markup==1)
	{
	var gross_total_exa=Math.round(gross_total_exa)+Math.round(markup_profit_exadult*markupcurrency)
	}
	else
	{
	var gross_total_exa=Math.round(gross_total_exa)+Math.round(markup_profit_exadult)
	}
	}
	var discount_exadult_plus=$("."+a109).val();
	if(discount_exadult_plus!='')
	{
	var discount_adult_plus=$("."+a28).val();
	if(discount_adult_plus==1)
	{
	var gross_total_exa=Math.round(gross_total_exa)+Math.round(discount_exadult_plus*discount_positive_currency)
	}
	else
	{
	var gross_total_exa=Math.round(gross_total_exa)+Math.round(discount_exadult_plus)
	}
	}
	$("."+a30).val('').val(Math.round(gross_total_exa))
	var gross_total_childbed=0;
	var tourtotal_childbed=$("."+a15).val();
	if(tourtotal_childbed!='')
	{
	var gross_total_childbed=Math.round(gross_total_childbed)+Math.round(tourtotal_childbed)
	}
	var markup_profit_childbed=$("."+a23).val();
	if(markup_profit_childbed!='')
	{
	var markup=$("."+a19).val();
	if(markup==1)
	{
	var gross_total_childbed=Math.round(gross_total_childbed)+Math.round(markup_profit_childbed*markupcurrency)
	}
	else
	{
	var gross_total_childbed=Math.round(gross_total_childbed)+Math.round(markup_profit_childbed)
	}
	}
	var discount_childbed_plus=$("."+a127).val();
	if(discount_childbed_plus!='')
	{
	var discount_adult_plus=$("."+a28).val();
	if(discount_adult_plus==1)
	{
	var gross_total_childbed=Math.round(gross_total_childbed)+Math.round(discount_childbed_plus*discount_positive_currency)
	}
	else
	{
	var gross_total_childbed=Math.round(gross_total_childbed)+Math.round(discount_childbed_plus)
	}
	}
	$("."+a31).val('').val(Math.round(gross_total_childbed))
	var gross_total_childwbed=0;
	var tourtotal_childwbed=$("."+a16).val();
	if(tourtotal_childwbed!='')
	{
	var gross_total_childwbed=Math.round(gross_total_childwbed)+Math.round(tourtotal_childwbed)
	}
	var markup_profit_childwbed=$("."+a24).val();
	if(markup_profit_childwbed!='')
	{
	var markup=$("."+a19).val();
	if(markup==1)
	{
	var gross_total_childwbed=Math.round(gross_total_childwbed)+Math.round(markup_profit_childwbed*markupcurrency)
	}
	else
	{
	var gross_total_childwbed=Math.round(gross_total_childwbed)+Math.round(markup_profit_childwbed)
	}
	}
	var discount_childwbed_plus=$("."+a140).val();
	if(discount_childwbed_plus!='')
	{
	var discount_adult_plus=$("."+a28).val();
	if(discount_adult_plus==1)
	{
	var gross_total_childwbed=Math.round(gross_total_childwbed)+Math.round(discount_childwbed_plus*discount_positive_currency)
	}
	else
	{
	var gross_total_childwbed=Math.round(gross_total_childwbed)+Math.round(discount_childwbed_plus)
	}
	}
	$("."+a32).val('').val(Math.round(gross_total_childwbed))
	var gross_total_infant=0;
	var tourtotal_infant=$("."+a17).val();
	if(tourtotal_infant!='')
	{
	var gross_total_infant=Math.round(gross_total_infant)+Math.round(tourtotal_infant)
	}
	var markup_profit_infant=$("."+a25).val();
	if(markup_profit_infant!='')
	{
	var markup=$("."+a19).val();
	if(markup==1)
	{
	var gross_total_infant=Math.round(gross_total_infant)+Math.round(markup_profit_infant*markupcurrency)
	}
	else
	{
	var gross_total_infant=Math.round(gross_total_infant)+Math.round(markup_profit_infant)
	}
	}
	var discount_infant_plus=$("."+a153).val();
	if(discount_infant_plus!='')
	{
	var discount_adult_plus=$("."+a28).val();
	if(discount_adult_plus==1)
	{
	var gross_total_infant=Math.round(gross_total_infant)+Math.round(discount_infant_plus*discount_positive_currency)
	}
	else
	{
	var gross_total_infant=Math.round(gross_total_infant)+Math.round(discount_infant_plus)
	}
	}
	$("."+a33).val('').val(Math.round(gross_total_infant))
	var gross_total_single=0;
	var tourtotal_single=$("."+a18).val();
	if(tourtotal_single!='')
	{
	var gross_total_single=Math.round(gross_total_single)+Math.round(tourtotal_single)
	}
	var markup_profit_single=$("."+a26).val();
	if(markup_profit_single!='')
	{
	var markup=$("."+a19).val();
	if(markup==1)
	{
	var gross_total_single=Math.round(gross_total_single)+Math.round(markup_profit_single*markupcurrency)
	}
	else
	{
	var gross_total_single=Math.round(gross_total_single)+Math.round(markup_profit_single)
	}
	}
	var discount_single_plus=$("."+a166).val();
	if(discount_single_plus!='')
	{
	var discount_adult_plus=$("."+a28).val();
	if(discount_adult_plus==1)
	{
	var gross_total_single=Math.round(gross_total_single)+Math.round(discount_single_plus*discount_positive_currency)
	}
	else
	{
	var gross_total_single=Math.round(gross_total_single)+Math.round(discount_single_plus)
	}
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
	if(gross_total_adult!='' && number_of_adult!='')
	{
	var gross_group=Math.round(gross_group)+Math.round(gross_total_adult*number_of_adult)
	}
	if(gross_total_exadult!='' && number_of_extra_adult!='')
	{
	var gross_group=Math.round(gross_group)+Math.round(gross_total_exadult*number_of_extra_adult)
	}
	if(gross_total_childbed!='' && number_of_child_with_bed!='')
	{
	var gross_group=Math.round(gross_group)+Math.round(gross_total_childbed*number_of_child_with_bed)
	}
	if(gross_total_childwbed!='' && number_of_child_without_bed!='')
	{
	var gross_group=Math.round(gross_group)+Math.round(gross_total_childwbed*number_of_child_without_bed)
	}
	if(gross_total_infant!='' && number_of_infant!='')
	{
	var gross_group=Math.round(gross_group)+Math.round(gross_total_infant*number_of_infant)
	}
	if(gross_total_single!='' && number_solo_traveller!='')
	{
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
	if(discountnegative_percentage!='')
	{
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
	//
	}
	}
	// else if(pricediscountnegative==3)
	// 	{
	// $("."+a36).val('').val(0)
	// $("."+a37).val('').val(0)
	// $("."+a38).val('').val(0)
	// $("."+a39).val('').val(0)
	// $("."+a40).val('').val(0)
	// $("."+a41).val('').val(0)
	// 	}
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
	var pricediscountnegative=$("."+a170).val();
	if(pricediscountnegative==1)
	{
	var discount_group=Math.round(discount_group)+Math.round(discount_adult_minus*number_of_adult*discount_negative_currency)
	}
	else
	{
	var discount_group=Math.round(discount_group)+Math.round(discount_adult_minus*number_of_adult)
	}
	}
	if(discount_exadult_minus!='' && number_of_extra_adult!='')
	{
	if(pricediscountnegative==1)
	{
	var discount_group=Math.round(discount_group)+Math.round(discount_exadult_minus*number_of_extra_adult*discount_negative_currency)
	}
	else
	{
	var discount_group=Math.round(discount_group)+Math.round(discount_exadult_minus*number_of_extra_adult)
	}
	}
	if(discount_childbed_minus!='' && number_of_child_with_bed!='')
	{
	if(pricediscountnegative==1)
	{
	var discount_group=Math.round(discount_group)+Math.round(discount_childbed_minus*number_of_child_with_bed*discount_negative_currency)
	}
	else
	{
	var discount_group=Math.round(discount_group)+Math.round(discount_childbed_minus*number_of_child_with_bed)
	}
	}
	if(discount_childwbed_minus!='' && number_of_child_without_bed!='')
	{
	if(pricediscountnegative==1)
	{
	var discount_group=Math.round(discount_group)+Math.round(discount_childwbed_minus*number_of_child_without_bed*discount_negative_currency)
	}
	else
	{
	var discount_group=Math.round(discount_group)+Math.round(discount_childwbed_minus*number_of_child_without_bed)
	}
	}
	if(discount_infant_minus!='' && number_of_infant!='')
	{
	if(pricediscountnegative==1)
	{
	var discount_group=Math.round(discount_group)+Math.round(discount_infant_minus*number_of_infant*discount_negative_currency)
	}
	else
	{
	var discount_group=Math.round(discount_group)+Math.round(discount_infant_minus*number_of_infant)
	}
	}
	if(discount_single_minus!='' && number_solo_traveller!='')
	{
	if(pricediscountnegative==1)
	{
	var discount_group=Math.round(discount_group)+Math.round(discount_single_minus*number_solo_traveller*discount_negative_currency)
	}
	else
	{
	var discount_group=Math.round(discount_group)+Math.round(discount_single_minus*number_solo_traveller)
	}
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
	if(percentage_gst!='')
	{
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
	if(gst_adult!='' && number_of_adult!='')
	{
	var gst=$("."+a42).val();
	if(gst==1)
	{
	var gst_group=Math.round(gst_group)+Math.round(gst_adult*number_of_adult*gst_currency)
	}
	else
	{
	var gst_group=Math.round(gst_group)+Math.round(gst_adult*number_of_adult)
	}
	}
	if(gst_exadult!='' && number_of_extra_adult!='')
	{
	var gst=$("."+a42).val();
	if(gst==1)
	{
	var gst_group=Math.round(gst_group)+Math.round(gst_exadult*number_of_extra_adult*gst_currency)
	}
	else
	{
	var gst_group=Math.round(gst_group)+Math.round(gst_exadult*number_of_extra_adult)
	}
	}
	if(gst_childbed!='' && number_of_child_with_bed!='')
	{
	var gst=$("."+a42).val();
	if(gst==1)
	{
	var gst_group=Math.round(gst_group)+Math.round(gst_childbed*number_of_child_with_bed*gst_currency)
	}
	else
	{
	var gst_group=Math.round(gst_group)+Math.round(gst_childbed*number_of_child_with_bed)
	}
	}
	if(gst_childwbed!='' && number_of_child_without_bed!='')
	{
	var gst=$("."+a42).val();
	if(gst==1)
	{
	var gst_group=Math.round(gst_group)+Math.round(gst_childwbed*number_of_child_without_bed*gst_currency)
	}
	else
	{
	var gst_group=Math.round(gst_group)+Math.round(gst_childwbed*number_of_child_without_bed)
	}
	}
	if(gst_infant!='' && number_of_infant!='')
	{
	var gst=$("."+a42).val();
	if(gst==1)
	{
	var gst_group=Math.round(gst_group)+Math.round(gst_infant*number_of_infant*gst_currency)
	}
	else
	{
	var gst_group=Math.round(gst_group)+Math.round(gst_infant*number_of_infant)
	}
	}
	if(gst_single!='' && number_solo_traveller!='')
	{
	var gst=$("."+a42).val();
	if(gst==1)
	{
	var gst_group=Math.round(gst_group)+Math.round(gst_single*number_solo_traveller*gst_currency)
	}
	else
	{
	var gst_group=Math.round(gst_group)+Math.round(gst_single*number_solo_traveller)
	}
	}
	$("."+a51).val('').val(Math.round(gst_group))
	//for gst total
	var gst_total_adult=0;
	var gross_adult=$("."+a29).val();
	if(gross_adult!='')
	{
	var gst_total_adult=Math.round(gst_total_adult)+Math.round(gross_adult)
	}
	var discount_minius_adult=$("."+a36).val();
	if(discount_minius_adult!='')
	{
	if(pricediscountnegative==1)
	{
	var gst_total_adult=Math.round(gst_total_adult)-Math.round(discount_minius_adult*discount_negative_currency)
	}
	else
	{
	var gst_total_adult=Math.round(gst_total_adult)-Math.round(discount_minius_adult)
	}
	}
	var gst_adult=$("."+a44).val();
	if(gst_adult!='')
	{
	if(gst==1)
	{
	var gst_total_adult=Math.round(gst_total_adult)+Math.round(gst_adult*gst_currency)
	}
	else
	{
	var gst_total_adult=Math.round(gst_total_adult)+Math.round(gst_adult)
	}
	}
	$("."+a52).val('').val(Math.round(gst_total_adult))
	var gst_total_exadult=0;
	var gross_exadult=$("."+a30).val();
	if(gross_exadult!='')
	{
	var gst_total_exadult=Math.round(gst_total_exadult)+Math.round(gross_exadult)
	}
	var discount_minius_exadult=$("."+a37).val();
	if(discount_minius_exadult!='')
	{
	if(pricediscountnegative==1)
	{
	var gst_total_exadult=Math.round(gst_total_exadult)-Math.round(discount_minius_exadult*discount_negative_currency)
	}
	else
	{
	var gst_total_exadult=Math.round(gst_total_exadult)-Math.round(discount_minius_exadult)
	}
	}
	var gst_exadult=$("."+a46).val();
	if(gst_exadult!='')
	{
	if(gst==1)
	{
	var gst_total_exadult=Math.round(gst_total_exadult)+Math.round(gst_exadult*gst_currency)
	}
	else
	{
	var gst_total_exadult=Math.round(gst_total_exadult)+Math.round(gst_exadult)
	}
	}
	$("."+a87).val('').val(Math.round(gst_total_exadult))
	//
	var gst_total_childbed=0;
	var gross_childbed=$("."+a31).val();
	if(gross_childbed!='')
	{
	var gst_total_childbed=Math.round(gst_total_childbed)+Math.round(gross_childbed)
	}
	var discount_minius_childbed=$("."+a38).val();
	if(discount_minius_childbed!='')
	{
	if(pricediscountnegative==1)
	{
	var gst_total_childbed=Math.round(gst_total_childbed)-Math.round(discount_minius_childbed*discount_negative_currency)
	}
	else
	{
	var gst_total_childbed=Math.round(gst_total_childbed)-Math.round(discount_minius_childbed)
	}
	}
	var gst_childbed=$("."+a47).val();
	if(gst_childbed!='')
	{
	if(gst==1)
	{
	var gst_total_childbed=Math.round(gst_total_childbed)+Math.round(gst_childbed*gst_currency)
	}
	else
	{
	var gst_total_childbed=Math.round(gst_total_childbed)+Math.round(gst_childbed)
	}
	}
	$("."+a88).val('').val(Math.round(gst_total_childbed))
	var gst_total_childwbed=0;
	var gross_childwbed=$("."+a32).val();
	if(gross_childwbed!='')
	{
	var gst_total_childwbed=Math.round(gst_total_childwbed)+Math.round(gross_childwbed)
	}
	var discount_minius_childwbed=$("."+a39).val();
	if(discount_minius_childwbed!='')
	{
	if(pricediscountnegative==1)
	{
	var gst_total_childwbed=Math.round(gst_total_childwbed)-Math.round(discount_minius_childwbed*discount_negative_currency)
	}
	else
	{
	var gst_total_childwbed=Math.round(gst_total_childwbed)-Math.round(discount_minius_childwbed)
	}
	}
	var gst_childwbed=$("."+a48).val();
	if(gst_childwbed!='')
	{
	if(gst==1)
	{
	var gst_total_childwbed=Math.round(gst_total_childwbed)+Math.round(gst_childwbed*gst_currency)
	}
	else
	{
	var gst_total_childwbed=Math.round(gst_total_childwbed)+Math.round(gst_childwbed)
	}
	}
	$("."+a89).val('').val(Math.round(gst_total_childwbed))
	var gst_total_infant=0;
	var gross_infant=$("."+a33).val();
	if(gross_infant!='')
	{
	var gst_total_infant=Math.round(gst_total_infant)+Math.round(gross_infant)
	}
	var discount_minius_infant=$("."+a40).val();
	if(discount_minius_infant!='')
	{
	if(pricediscountnegative==1)
	{
	var gst_total_infant=Math.round(gst_total_infant)-Math.round(discount_minius_infant*discount_negative_currency)
	}
	else
	{
	var gst_total_infant=Math.round(gst_total_infant)-Math.round(discount_minius_infant)
	}
	}
	var gst_infant=$("."+a49).val();
	if(gst_infant!='')
	{
	if(gst==1)
	{
	var gst_total_infant=Math.round(gst_total_infant)+Math.round(gst_infant*gst_currency)
	}
	else
	{
	var gst_total_infant=Math.round(gst_total_infant)+Math.round(gst_infant)
	}
	}
	$("."+a90).val('').val(Math.round(gst_total_infant))
	var gst_total_single=0;
	var gross_single=$("."+a34).val();
	if(gross_single!='')
	{
	var gst_total_single=Math.round(gst_total_single)+Math.round(gross_single)
	}
	var discount_minius_single=$("."+a41).val();
	if(discount_minius_single!='')
	{
	if(pricediscountnegative==1)
	{
	var gst_total_single=Math.round(gst_total_single)-Math.round(discount_minius_single*discount_negative_currency)
	}
	else
	{
	var gst_total_single=Math.round(gst_total_single)-Math.round(discount_minius_single)
	}
	}
	var gst_single=$("."+a50).val();
	if(gst_single!='')
	{
	if(gst==1)
	{
	var gst_total_single=Math.round(gst_total_single)+Math.round(gst_single*gst_currency)
	}
	else
	{
	var gst_total_single=Math.round(gst_total_single)+Math.round(gst_single)
	}
	}
	$("."+a91).val('').val(Math.round(gst_total_single))
	//for tcs claculation
	var tcs=$("."+a53).val();
	if(tcs==1)
	{
	}
	else if(tcs==2)
	{
	var tcs_percentage=$("."+a54).val();
	if(tcs_percentage!='')
	{
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
	if(tcs_adult!='' && number_of_adult!='')
	{
	if(tcs==1)
	{
	var tcs_group=Math.round(tcs_group)+Math.round(tcs_adult*number_of_adult*tcs_currency)
	}
	else
	{
	var tcs_group=Math.round(tcs_group)+Math.round(tcs_adult*number_of_adult)
	}
	}
	if(tcs_exadult!='' && number_of_extra_adult!='')
	{
	if(tcs==1)
	{
	var tcs_group=Math.round(tcs_group)+Math.round(tcs_exadult*number_of_extra_adult*tcs_currency)
	}
	else
	{
	var tcs_group=Math.round(tcs_group)+Math.round(tcs_exadult*number_of_extra_adult)
	}
	}
	if(tcs_childbed!='' && number_of_child_with_bed!='')
	{
	if(tcs==1)
	{
	var tcs_group=Math.round(tcs_group)+Math.round(tcs_childbed*number_of_child_with_bed*tcs_currency)
	}
	else
	{
	var tcs_group=Math.round(tcs_group)+Math.round(tcs_childbed*number_of_child_with_bed)
	}
	}
	if(tcs_childwbed!='' && number_of_child_without_bed!='')
	{
	if(tcs==1)
	{
	var tcs_group=Math.round(tcs_group)+Math.round(tcs_childwbed*number_of_child_without_bed*tcs_currency)
	}
	else
	{
	var tcs_group=Math.round(tcs_group)+Math.round(tcs_childwbed*number_of_child_without_bed)
	}
	}
	if(tcs_infant!='' && number_of_infant!='')
	{
	if(tcs==1)
	{
	var tcs_group=Math.round(tcs_group)+Math.round(tcs_infant*number_of_infant*tcs_currency)
	}
	else
	{
	var tcs_group=Math.round(tcs_group)+Math.round(tcs_infant*number_of_infant)
	}
	}
	if(tcs_single!='' && number_solo_traveller!='')
	{
	if(tcs==1)
	{
	var tcs_group=Math.round(tcs_group)+Math.round(tcs_single*number_solo_traveller*tcs_currency)
	}
	else
	{
	var tcs_group=Math.round(tcs_group)+Math.round(tcs_single*number_solo_traveller)
	}
	}
	$("."+a61).val('').val(Math.round(tcs_group))
	//for tcs total
	var tcs_total_adult=0;
	var gst_adult=$("."+a52).val();
	if(gst_adult!='')
	{
	var tcs_total_adult=Math.round(tcs_total_adult)+Math.round(gst_adult)
	}
	var tcs_adult=$("."+a55).val();
	if(tcs_adult!='')
	{
	if(tcs==1)
	{
	var tcs_total_adult=Math.round(tcs_total_adult)+Math.round(tcs_adult*tcs_currency)
	}
	else
	{
	var tcs_total_adult=Math.round(tcs_total_adult)+Math.round(tcs_adult)
	}
	}
	$("."+a62).val('').val(Math.round(tcs_total_adult))
	var tcs_total_exadult=0;
	var gst_exadult=$("."+a87).val();
	if(gst_exadult!='')
	{
	var tcs_total_exadult=Math.round(tcs_total_exadult)+Math.round(gst_exadult)
	}
	var tcs_exadult=$("."+a56).val();
	if(tcs_exadult!='')
	{
	if(tcs==1)
	{
	var tcs_total_exadult=Math.round(tcs_total_exadult)+Math.round(tcs_exadult*tcs_currency)
	}
	else
	{
	var tcs_total_exadult=Math.round(tcs_total_exadult)+Math.round(tcs_exadult)
	}
	}
	$("."+a92).val('').val(Math.round(tcs_total_exadult))
	var tcs_total_childbed=0;
	var gst_childbed=$("."+a88).val();
	if(gst_childbed!='')
	{
	var tcs_total_childbed=Math.round(tcs_total_childbed)+Math.round(gst_childbed)
	}
	var tcs_childbed=$("."+a57).val();
	if(tcs_childbed!='')
	{
	if(tcs==1)
	{
	var tcs_total_childbed=Math.round(tcs_total_childbed)+Math.round(tcs_childbed*tcs_currency)
	}
	else
	{
	var tcs_total_childbed=Math.round(tcs_total_childbed)+Math.round(tcs_childbed)
	}
	}
	$("."+a93).val('').val(Math.round(tcs_total_childbed))
	var tcs_total_childwbed=0;
	var gst_childwbed=$("."+a89).val();
	if(gst_childwbed!='')
	{
	var tcs_total_childwbed=Math.round(tcs_total_childwbed)+Math.round(gst_childwbed)
	}
	var tcs_childwbed=$("."+a58).val();
	if(tcs_childwbed!='')
	{
	if(tcs==1)
	{
	var tcs_total_childwbed=Math.round(tcs_total_childwbed)+Math.round(tcs_childwbed*tcs_currency)
	}
	else
	{
	var tcs_total_childwbed=Math.round(tcs_total_childwbed)+Math.round(tcs_childwbed)
	}
	}
	$("."+a94).val('').val(Math.round(tcs_total_childwbed))
	var tcs_total_infant=0;
	var gst_infant=$("."+a90).val();
	if(gst_infant!='')
	{
	var tcs_total_infant=Math.round(tcs_total_infant)+Math.round(gst_infant)
	}
	var tcs_infant=$("."+a59).val();
	if(tcs_infant!='')
	{
	if(tcs==1)
	{
	var tcs_total_infant=Math.round(tcs_total_infant)+Math.round(tcs_infant*tcs_currency)
	}
	else
	{
	var tcs_total_infant=Math.round(tcs_total_infant)+Math.round(tcs_infant)
	}
	}
	$("."+a95).val('').val(Math.round(tcs_total_infant))
	var tcs_total_single=0;
	var gst_single=$("."+a91).val();
	if(gst_single!='')
	{
	var tcs_total_single=Math.round(tcs_total_single)+Math.round(gst_single)
	}
	var tcs_single=$("."+a60).val();
	if(tcs_single!='')
	{
	if(tcs==1)
	{
	var tcs_total_single=Math.round(tcs_total_single)+Math.round(tcs_single*tcs_currency)
	}
	else
	{
	var tcs_total_single=Math.round(tcs_total_single)+Math.round(tcs_single)
	}
	}
	$("."+a96).val('').val(Math.round(tcs_total_single))
	//for pg charge claculation
	var pricepgcharges=$("."+a63).val();
	if(pricepgcharges==1)
	{
	}
	else if(pricepgcharges==2)
	{
	var pg_percentage=$("."+a64).val();
	if(pg_percentage!='')
	{
	var tcs_total_adult=$("."+a62).val();
	var tcs_total_exadult=$("."+a92).val();
	var tcs_total_childbed=$("."+a93).val();
	var tcs_total_childwbed=$("."+a94).val();
	var tcs_total_infant=$("."+a95).val();
	var tcs_total_single=$("."+a96).val();
	if(tcs_total_adult!='')
	{
	var pg_percentage_into_total_adult=tcs_total_adult*pg_percentage/100;
	$("."+a65).val('').val(Math.round(pg_percentage_into_total_adult))
	}
	if(tcs_total_exadult!='')
	{
	var pg_percentage_into_total_exadult=tcs_total_exadult*pg_percentage/100;
	$("."+a66).val('').val(Math.round(pg_percentage_into_total_exadult))
	}
	if(tcs_total_childbed!='')
	{
	var pg_percentage_into_total_childbed=tcs_total_childbed*pg_percentage/100;
	$("."+a67).val('').val(Math.round(pg_percentage_into_total_childbed))
	}
	if(tcs_total_childwbed!='')
	{
	var pg_percentage_into_total_childwbed=tcs_total_childwbed*pg_percentage/100;
	$("."+a68).val('').val(Math.round(pg_percentage_into_total_childwbed))
	}
	if(tcs_total_infant!='')
	{
	var pg_percentage_into_total_infant=tcs_total_infant*pg_percentage/100;
	$("."+a69).val('').val(Math.round(pg_percentage_into_total_infant))
	}
	if(tcs_total_single!='')
	{
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
	if(pg_adult!='' && number_of_adult!='')
	{
	if(pricepgcharges==1)
	{
	var pg_group=Math.round(pg_group)+Math.round(pg_adult*number_of_adult*pgcharges_currency)
	}
	else
	{
	var pg_group=Math.round(pg_group)+Math.round(pg_adult*number_of_adult)
	}
	}
	if(pg_exadult!='' && number_of_extra_adult!='')
	{
	if(pricepgcharges==1)
	{
	var pg_group=Math.round(pg_group)+Math.round(pg_exadult*number_of_extra_adult*pgcharges_currency)
	}
	else
	{
	var pg_group=Math.round(pg_group)+Math.round(pg_exadult*number_of_extra_adult)
	}
	}
	if(pg_childbed!='' && number_of_child_with_bed!='')
	{
	if(pricepgcharges==1)
	{
	var pg_group=Math.round(pg_group)+Math.round(pg_childbed*number_of_child_with_bed*pgcharges_currency)
	}
	else
	{
	var pg_group=Math.round(pg_group)+Math.round(pg_childbed*number_of_child_with_bed)
	}
	}
	if(pg_childwbed!='' && number_of_child_without_bed!='')
	{
	if(pricepgcharges==1)
	{
	var pg_group=Math.round(pg_group)+Math.round(pg_childwbed*number_of_child_without_bed*pgcharges_currency)
	}
	else
	{
	var pg_group=Math.round(pg_group)+Math.round(pg_childwbed*number_of_child_without_bed)
	}
	}
	if(pg_infant!='' && number_of_infant!='')
	{
	if(pricepgcharges==1)
	{
	var pg_group=Math.round(pg_group)+Math.round(pg_infant*number_of_infant*pgcharges_currency)
	}
	else
	{
	var pg_group=Math.round(pg_group)+Math.round(pg_infant*number_of_infant)
	}
	}
	if(pg_single!='' && number_solo_traveller!='')
	{
	if(pricepgcharges==1)
	{
	var pg_group=Math.round(pg_group)+Math.round(pg_single*number_solo_traveller*pgcharges_currency)
	}
	else
	{
	var pg_group=Math.round(pg_group)+Math.round(pg_single*number_solo_traveller)
	}
	}
	$("."+a71).val('').val(Math.round(pg_group))
	//for grand total
	var grand_total_adult=0;
	var total_tcs_adult=$("."+a62).val();
	if(total_tcs_adult!='')
	{
	var grand_total_adult=Math.round(grand_total_adult)+Math.round(total_tcs_adult)
	}
	var pg_total_adult=$("."+a65).val();
	if(pg_total_adult!='')
	{
	if(pricepgcharges==1)
	{
	var grand_total_adult=Math.round(grand_total_adult)+Math.round(pg_total_adult*pgcharges_currency)
	}
	else
	{
	var grand_total_adult=Math.round(grand_total_adult)+Math.round(pg_total_adult)
	}
	}
	$("."+a72).val('').val(Math.round(grand_total_adult))
	var grand_total_exadult=0;
	var total_tcs_exadult=$("."+a92).val();
	if(total_tcs_exadult!='')
	{
	var grand_total_exadult=Math.round(grand_total_exadult)+Math.round(total_tcs_exadult)
	}
	var pg_total_exadult=$("."+a66).val();
	if(pg_total_exadult!='')
	{
	if(pricepgcharges==1)
	{
	var grand_total_exadult=Math.round(grand_total_exadult)+Math.round(pg_total_exadult*pgcharges_currency)
	}
	else
	{
	var grand_total_exadult=Math.round(grand_total_exadult)+Math.round(pg_total_exadult)
	}
	}
	$("."+a110).val('').val(Math.round(grand_total_exadult))
	var grand_total_childbed=0;
	var total_tcs_childbed=$("."+a93).val();
	if(total_tcs_childbed!='')
	{
	var grand_total_childbed=Math.round(grand_total_childbed)+Math.round(total_tcs_childbed)
	}
	var pg_total_childbed=$("."+a67).val();
	if(pg_total_childbed!='')
	{
	if(pricepgcharges==1)
	{
	var grand_total_childbed=Math.round(grand_total_childbed)+Math.round(pg_total_childbed*pgcharges_currency)
	}
	else
	{
	var grand_total_childbed=Math.round(grand_total_childbed)+Math.round(pg_total_childbed)
	}
	}
	$("."+a111).val('').val(Math.round(grand_total_childbed))
	var grand_total_childwbed=0;
	var total_tcs_childwbed=$("."+a94).val();
	if(total_tcs_childwbed!='')
	{
	var grand_total_childwbed=Math.round(grand_total_childwbed)+Math.round(total_tcs_childwbed)
	}
	var pg_total_childwbed=$("."+a68).val();
	if(pg_total_childwbed!='')
	{
	if(pricepgcharges==1)
	{
	var grand_total_childwbed=Math.round(grand_total_childwbed)+Math.round(pg_total_childwbed*pgcharges_currency)
	}
	else
	{
	var grand_total_childwbed=Math.round(grand_total_childwbed)+Math.round(pg_total_childwbed)
	}
	}
	$("."+a112).val('').val(Math.round(grand_total_childwbed))
	var grand_total_infant=0;
	var total_tcs_infant=$("."+a95).val();
	if(total_tcs_infant!='')
	{
	var grand_total_infant=Math.round(grand_total_infant)+Math.round(total_tcs_infant)
	}
	var pg_total_infant=$("."+a69).val();
	if(pg_total_infant!='')
	{
	if(pricepgcharges==1)
	{
	var grand_total_infant=Math.round(grand_total_infant)+Math.round(pg_total_infant*pgcharges_currency)
	}
	else
	{
	var grand_total_infant=Math.round(grand_total_infant)+Math.round(pg_total_infant)
	}
	}
	$("."+a113).val('').val(Math.round(grand_total_infant))
	var grand_total_single=0;
	var total_tcs_single=$("."+a96).val();
	if(total_tcs_single!='')
	{
	var grand_total_single=Math.round(grand_total_single)+Math.round(total_tcs_single)
	}
	var pg_total_single=$("."+a70).val();
	if(pg_total_single!='')
	{
	if(pricepgcharges==1)
	{
	var grand_total_single=Math.round(grand_total_single)+Math.round(pg_total_single*pgcharges_currency)
	}
	else
	{
	var grand_total_single=Math.round(grand_total_single)+Math.round(pg_total_single)
	}
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
	if(grand_total_adult!='' && number_of_adult!='')
	{
	var total_number_of_guest_according_adult=Math.round(total_number_of_guest_according_adult)+Math.round(grand_total_adult*number_of_adult)
	}
	$("."+a73).val('').val(Math.round(total_number_of_guest_according_adult))
	if(grand_total_exadult!='' && number_of_extra_adult!='')
	{
	var total_number_of_guest_according_exadult=Math.round(total_number_of_guest_according_exadult)+Math.round(grand_total_exadult*number_of_extra_adult)
	}
	$("."+a81).val('').val(Math.round(total_number_of_guest_according_exadult))
	if(grand_total_childbed!='' && number_of_child_with_bed!='')
	{
	var total_number_of_guest_according_childbed=Math.round(total_number_of_guest_according_childbed)+Math.round(grand_total_childbed*number_of_child_with_bed)
	}
	$("."+a82).val('').val(Math.round(total_number_of_guest_according_childbed))
	if(grand_total_childwbed!='' && number_of_child_without_bed!='')
	{
	var total_number_of_guest_according_childwbed=Math.round(total_number_of_guest_according_childwbed)+Math.round(grand_total_childwbed*number_of_child_without_bed)
	}
	$("."+a83).val('').val(Math.round(total_number_of_guest_according_childwbed))
	if(grand_total_infant!='' && number_of_infant!='')
	{
	var total_number_of_guest_according_infant=Math.round(total_number_of_guest_according_infant)+Math.round(grand_total_infant*number_of_infant)
	}
	$("."+a84).val('').val(Math.round(total_number_of_guest_according_infant))
	if(grand_total_single!='' && number_solo_traveller!='')
	{
	var total_number_of_guest_according_single=Math.round(total_number_of_guest_according_single)+Math.round(grand_total_single*number_solo_traveller)
	}
	$("."+a85).val('').val(Math.round(total_number_of_guest_according_single))
	//for price to pay
	var price_to_pay=0;
	if($("."+a73).val()!='')
	{
	var price_to_pay=Math.round(price_to_pay)+Math.round($("."+a73).val())
	}
	if($("."+a81).val()!='')
	{
	var price_to_pay=Math.round(price_to_pay)+Math.round($("."+a81).val())
	}
	if($("."+a82).val()!='')
	{
	var price_to_pay=Math.round(price_to_pay)+Math.round($("."+a82).val())
	}
	if($("."+a83).val()!='')
	{
	var price_to_pay=Math.round(price_to_pay)+Math.round($("."+a83).val())
	}
	if($("."+a84).val()!='')
	{
	var price_to_pay=Math.round(price_to_pay)+Math.round($("."+a84).val())
	}
	if($("."+a85).val()!='')
	{
	var price_to_pay=Math.round(price_to_pay)+Math.round($("."+a85).val())
	}
	$("."+a167).val('').val(Math.round(price_to_pay))
	// $("."+a189).val('').val(Math.round(price_to_pay))
	// }
}

/*----------*//*----------*/

// supplier
$(document).on("change click",".supplier",function(){
	var id=$(this).attr("id")
	var supplier_id=$(this).val()
	var inner_html=$('option:selected', this).attr('select_name')
	var input_val=$(this).siblings('input').val()
	// console.log(inner_html)
	if(supplier_id!='0')
	{
	var html = '<label for="">'+inner_html+' Remarks</label><input type="text" id="supplier_remarks'+id+'"  class="form-control" placeholder="Enter Remarks" value="'+input_val+'">';
	$(".supplier_remarks").attr('supplier_remarks_id','supplier_remarks'+id)
	$(".supplier_remarks").attr('supplier_attr',id)
	$("#supplier_body").html("").html(html)
	$('#supplier').modal('show');
	}
});

// supplier remarks
$(document).on("click",".supplier_remarks",function(){
	var supplier_remarks_id=$(this).attr('supplier_remarks_id')
	var supplier_attr=$(this).attr('supplier_attr')
	var remarks_value=$("#"+supplier_remarks_id).val()
	$("#remarks_"+supplier_attr).val("").val(remarks_value)
	$('#supplier').modal('hide');
});
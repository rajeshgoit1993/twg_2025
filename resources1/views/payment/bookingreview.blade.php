@extends('layouts.front.masternoindex')
@section("title", 'Booking Review')

@section('content')

<!-- payment review page css -->
<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/payme.css') }}" />

<!-- add traveller review page css -->
<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/addtraveller-bookingReview.css') }}" />

<section>
	<div id="loader"></div>
	<div class="reviewCont">
		<div class="reviewbox">
			<div class="pageContainer">
				<h3 class="fa-arrow-left reviewTitle">Review Package</h3>
			</div>
		</div>
		<!-- <form action="{{url('/save_booking_details')}}"  method="post"> -->
		<form  id="save_booking_details" name="save_booking_details" method="post">
		{{csrf_field()}}
		<div class="pageContainer">
			<div class="reviewTourDtlsCont">
				<div class="reviewTourBox">
					<h2>{{CustomHelpers::get_package_name($query->packageId)}}</h2>
					<h3>
						<?php 
							$day_night=(int)filter_var($query->duration, FILTER_SANITIZE_NUMBER_INT);
						?>
						<span>{{ $day_night-1 }} Nights / {{ $day_night }} Days</span>
					</h3>
					<h5>Included in this package</h5>
					<?php
						$package_service=unserialize($data->package_service);
					?>
						@if(empty($package_service))
						@else
						<div class="flexCenter">
						@foreach($package_service as $icon)
							<div class="serviceIcons appendTop10">
								<div class="serviceIconsImage">
									<img class="serviceImage" src="{{ url('/public/uploads/icons/'.CustomHelpers::getimagename($icon,'rt_icons','icon')) }}" title="{{ CustomHelpers::getimagename($icon,'rt_icons','icon_title') }}" >
								</div>
								<div class="serviceIconsTitle">{{ CustomHelpers::getimagename($icon,'rt_icons','icon_title') }}</div>
							</div>
							@endforeach
						</div>
						@endif
				</div>
				<div class="tourDepartureBox">
					<h4>DEPARTURE CITY</h4>
					<h5>{{ $data->sourcecity }}</h5>
				</div>
				<div class="tourTravelDateBox">
					<?php
							// $originalDate = CustomHelpers::get_query_field($data->query_reference,'date_arrival');
		                    $originalDate = $data->tour_date;
							if($originalDate=="N" || $originalDate==""):
								$originalDate=date("Y-m-d");
							endif;
							$datefrom = str_replace(' ', '', $originalDate);
							$datefrom=explode("-", $datefrom);
							$datefrom_year=$datefrom["2"];
							$datefrom_day=$datefrom["1"];
							$datefrom_month=$datefrom["0"];
							$datefrom=$datefrom_year."-".$datefrom_month."-".$datefrom_day;
							$datefrom = "$datefrom_year-$datefrom_day-$datefrom_month";
							$stop_date = $datefrom;
							$date_to=$datefrom;
							$datefrom_print = date("d M Y", strtotime($datefrom));
							$day_from = strtotime($datefrom);
							$day_from = date('D', $day_from);
							$to_days=$data->duration-1;
							$stop_date = date('Y-m-d', strtotime($stop_date . ' +'.$to_days.' days'));
							$stop_date_print= date("d M Y", strtotime($stop_date));
							$day_to = strtotime($stop_date);
							$day_to = date('D', $day_to);
						?>
					<h4>FROM</h4>
					<h5><?php echo "$day_from"; ?>, {{$datefrom_print}}</h5>
					<h4>TO</h4>
					<h5><?php echo "$day_to"; ?>, {{ $stop_date_print}}</h5>
				</div>
			</div>
			<div class="reviewTourSeparator"></div>
			<!--Traveller Information-->
			<div class="mtourContBox">
				<div class="leftContainer">

					<!--Traveller information starts-->
		            @include('payment.bookingre_traveller')
					<!--Traveller contact information ends-->

					<!-- TCS and Traveller Pan Card information starts-->
					<?php
						$package_id = $query->packageId;
						$package = DB::table('rt_packages')->where('id', (int)$package_id)->first();

						// Check if package is found
						// $country=unserialize($package->country);
						$country = $package ? unserialize($package->country) : [];
					?>
					@if($package && (in_array('India', $country) || in_array('Nepal', $country) || in_array('Bhutan', $country)))
						{{-- No TCS info for India, Nepal, or Bhutan --}}
					@else
						@include('payment.tcs-info')
					@endif

					<!--Traveller Pan Card information ends-->
					<div class="impInfoBox">
						<h5>Please make sure you read all the Terms & Conditions, Booking and Cancellation Policy for this booking.</h5>
					</div>
				</div>
				<!-- right container - sidebar starts -->
				<div class="rightContainer">
					@include('payment.right_payment')
				<!-- right container - sidebar ends -->

				<!-- </div></div></div> -->

				<!-- pay at hotel starts -->
				@include('payment.pay_at_hotel')
				<!-- pay at hotel ends -->
				</div>
		</div>
		<!-- </div> -->

		<!--Mobile Pricebar starts-->
		<div class="mReivewPriceBarCont">
			<div class="mReivewPriceBarBox">
				<div class="mReviewPriceBox">
					<p class="mPayblPrcVal"><span class="defaultCurencyPay">&nbsp;<span id="you_pay"><?php CustomHelpers::get_indian_currency($remaining_amount); ?></span></span></p>
					<p class="mPayblPrcValTag">Total Payable</p>
				</div>
				<div>
					<div class="mLineSeprtr">|</div>
					<button type="submit" class="btnMain btnProceedMob">Proceed</button>
				</div>
			</div>
		</div>
		<!--Mobile Pricebar ends-->
		</form>
	</div>
</section>

<!--Add Traveller Info Starts-->
@include('payment.travellerdetails.addtraveller')
<!--Add Traveller Info Ends-->

@endsection

@section("custom_js")

<script type="text/javascript">

// Handle click event on .passenger_select elements
$(document).on("click", ".passenger_select", function (e) {
    e.preventDefault(); // Prevent default click behavior
    
    // Get the selected value from the dropdown
    var select_item = $(this).find(":selected").val();
    var unique_code = $("#unique_code").val(); // Get unique code from hidden input
    console.log(select_item); // Log selected item to console

    // Update UI based on selected item presence
    if (select_item == '') {
        $(this).parent().siblings('.addNewGuest').html('').html('<span class="fa-user"> </span> &nbsp;&nbsp;Add New');
        select_item = 0; // Set select_item to 0 if empty
    } else {
        $(this).parent().siblings('.addNewGuest').html('').html('<span class="fa-user"> </span> &nbsp;&nbsp;Edit');
    }

    // Collect selected options' values into an array
    var options = $('.passenger_select option:selected');
    var values = $.map(options ,function(option) {
        return option.value;
    });

    var button = $(this); // Reference to the button clicked
    var APP_URL = jQuery("#base_url").val(); // Get base URL from hidden input

    var spinner = $('#loader'); // Spinner element
    spinner.show(); // Show spinner

    // AJAX request to fetch passenger select data
    $.ajax({
        url: APP_URL + '/get_passenger_select',
        data: { select_item: select_item, values: values, unique_code: unique_code },
        type: 'get',
        // contentType: false,
        // processData: false,
        success: function (data) {
            console.log(data); // Log response data
            spinner.hide(); // Hide spinner on success
            button.html('').html(data); // Update button HTML with received data
        },
        error: function (xhr, status, error) {
            // Handle error (optional)
        }
    });
});

/*****************/

/*booking-review foldable button script*/
document.addEventListener('DOMContentLoaded', function() {
    const collapsibleButtons = document.querySelectorAll('.reviewFoldable');

    collapsibleButtons.forEach(button => {
        button.addEventListener('click', function() {
            this.classList.toggle('active');

            const content = this.nextElementSibling;

            if (content.style.display === 'block') {
                content.style.display = 'none';
                content.style.maxHeight = '0';
            } else {
                content.style.display = 'block';
                content.style.maxHeight = 'inherit';

                // Scroll the content into view with an offset from the top
                content.scrollIntoView({ behavior: 'smooth', block: 'start', inline: 'nearest' });

                // Add an additional offset from the top (400px)
                window.scrollBy(0, 300); // Adjust as needed

                // Scroll the sub-content into view
                /*const subContent = content.querySelector('.sub-content');
                if (subContent) {
                    subContent.scrollIntoView({ behavior: 'smooth' });
                    }*/
            }
        });
    });
});

/*****************/

// GSTIN Validation
document.addEventListener('DOMContentLoaded', function() {
    // Initialize the fields on page load
    initializeFields();

    // Add event listeners to all relevant inputs
    var gstnumber = document.getElementById("guestGST_no");
    var gstname = document.getElementById("guestGST_name");
    var gstemail = document.getElementById("guestGST_email");
    var gstmobile = document.getElementById("guestGST_mobile");
    var gststate = document.getElementById('guestGST_state');
    var gstaddress = document.getElementById('guestGST_address');

    gstnumber.addEventListener('input', gstDetails);
    gstname.addEventListener('input', gstDetails);
    gstemail.addEventListener('input', gstDetails);
    gstmobile.addEventListener('input', gstDetails);
    gststate.addEventListener('input', gstDetails);
    gstaddress.addEventListener('input', gstDetails);
});

function initializeFields() {
    var gstname = document.getElementById("guestGST_name");
    var gstemail = document.getElementById("guestGST_email");
    var gstmobile = document.getElementById("guestGST_mobile");
    var gststate = document.getElementById('guestGST_state');
    var gstaddress = document.getElementById('guestGST_address');

    gstname.disabled = true;
    gstemail.disabled = true;
    gstmobile.disabled = true;
    gststate.disabled = true;
    gstaddress.disabled = true;
}

function gstDetails() {
    // Retrieve elements
    var gstnumber = document.getElementById("guestGST_no");
    var gstname = document.getElementById("guestGST_name");
    var gstemail = document.getElementById("guestGST_email");
    var gstmobile = document.getElementById("guestGST_mobile");
    var gststate = document.getElementById('guestGST_state');
    var gstaddress = document.getElementById('guestGST_address');
    var gstnumber_error = document.getElementById('guestGST_no_error');
    var gstname_error = document.getElementById('guestGST_name_error');
    var gstemail_error = document.getElementById('guestGST_email_error');
    var gstmobile_error = document.getElementById('guestGST_mobile_error');
    var gststate_error = document.getElementById('guestGST_state_error');
    var gstaddress_error = document.getElementById('guestGST_address_error');

    // Check if GST number is valid
    var isValidGST = /^[0-9]{2}[A-Za-z0-9]{10}$/.test(gstnumber.value.trim());

    // Validate other fields
    var isValidName = /^[A-Za-z\s]{2,50}$/.test(gstname.value.trim());
    var isValidEmail = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(gstemail.value.trim());
    var isValidMobile = /^[0-9]{10}$/.test(gstmobile.value.trim());
    var isValidState = /^[A-Za-z\s]{2,25}$/.test(gststate.value.trim());
    var isValidAddress = /^[A-Za-z0-9\s/*\-,@]{10,100}$/.test(gstaddress.value.trim());

    // Enable/disable fields based on GST number validity
    gstname.disabled = !isValidGST;
    gstemail.disabled = !isValidGST;
    gstmobile.disabled = !isValidGST;
    gststate.disabled = !isValidGST;
    gstaddress.disabled = !isValidGST;

    // Update border colors for invalid fields
    gstnumber.style.borderColor = isValidGST ? '' : 'red';
    gstname.style.borderColor = isValidName ? '' : 'red';
    gstemail.style.borderColor = isValidEmail ? '' : 'red';
    gstmobile.style.borderColor = isValidMobile ? '' : 'red';
    gststate.style.borderColor = isValidState ? '' : 'red';
    gstaddress.style.borderColor = isValidAddress ? '' : 'red';

    // Update error messages
    gstnumber_error.innerHTML = gstnumber.value.trim() === "" ? '' :
        isValidGST ? '' : 'Please enter a valid GST number';

    gstname_error.innerHTML = isValidName ? '' : 'Please enter a valid name.';
    gstemail_error.innerHTML = isValidEmail ? '' : 'Please enter a valid email.';
    gstmobile_error.innerHTML = isValidMobile ? '' : 'Please enter a valid mobile number.';
    gststate_error.innerHTML = isValidState ? '' : 'Please enter a valid state.';
    gstaddress_error.innerHTML = isValidAddress ? '' : 'Please enter a valid address.';

    // Reset all fields if GST number is removed
    if (gstnumber.value.trim() === "") {
        gstname.value = "";
        gstemail.value = "";
        gstmobile.value = "";
        gststate.value = "";
        gstaddress.value = "";

        gstname.disabled = true;
        gstemail.disabled = true;
        gstmobile.disabled = true;
        gststate.disabled = true;
        gstaddress.disabled = true;

        // Reset border colors to default
        gstnumber.style.borderColor = '';
        gstname.style.borderColor = '';
        gstemail.style.borderColor = '';
        gstmobile.style.borderColor = '';
        gststate.style.borderColor = '';
        gstaddress.style.borderColor = '';

        // Clear error messages
        gstnumber_error.innerHTML = '';
        gstname_error.innerHTML = '';
        gstemail_error.innerHTML = '';
        gstmobile_error.innerHTML = '';
        gststate_error.innerHTML = '';
        gstaddress_error.innerHTML = '';
    }
}

/*****************/

// Attach an event listener to the document for keyup and change events on the #custom_pay input element
$(document).on("keyup change", "#custom_pay", function() {
    // Remove any character that is not a digit (0-9) or a dot (.)
    this.value = this.value.replace(/[^0-9.]/g, '')
        // If there are multiple dots, retain only the first one and remove the rest
        .replace(/(\..*?)\..*/g, '$1');
});

/*****************/

// full pay or part payment selection to proceed
$(document).ready(function() {
    // Set base URL from a hidden input field
    var APP_URL = jQuery("#base_url").val();
    
    // URL to get country codes
    var url = APP_URL + '/country_code';
    
    // Data for the GET request (CSRF token)
    var data = {
    	_token: "{{ csrf_token() }}"
    };
    
    // AJAX GET request to fetch country codes
    $.get(url, data, function(rdata) {
        // Populate the #country_code element with the received data
        $("#country_code").html("").html(rdata);
    });

    $(document).ready(function() {
    	// Disable #btnProceed initially on page load
    	/*$("#btnProceed").prop("disabled", true);*/

	    // Change event handler for #acknowledgement checkbox
	    $('#acknowledgement').change(function() {
	        if ($(this).is(":checked")) {
	            // Change the background color of #btnProceed to green if checked
	            $("#btnProceed").css("background", "#08b2ed");
	            // Remove the 'disabled' attribute from #btnProceed
	            /*$("#btnProceed").removeAttr("disabled");*/
	        } else {
	            // Reset the background color of #btnProceed if unchecked
	            $("#btnProceed").css("background", "#CED0D4");
	            // Add the 'disabled' attribute to #btnProceed
	            /*$("#btnProceed").attr("disabled", "disabled");*/
	        }
	    });
	});

    // Disable #custom_pay input by default
    $("#custom_pay").prop('disabled', true);
    
    // Change event handler for radio buttons named 'amount'
    $('input[type=radio][name=amount]').change(function() {
        if (this.value == 'fullamt') {
            // If 'fullamt' is selected, disable #custom_pay and set its value to 0
            $("#custom_pay").val('').val(0).prop('disabled', true);
            
            // Get unique code from an input field
            var unique_code = $("#unique_code").val();   
            
            // URL to get full payment calculation
            var APP_URL = jQuery("#base_url").val();
            
            // AJAX GET request for full payment calculation
            $.ajax({
                url: APP_URL + '/get_full_pay_calculation',
                data: {amount: 'NA', unique_code: unique_code},
                type: 'get',
                success: function(data) {
                    // Update #you_pay and #due_amount with the received data
                    $("#you_pay").html('').html(Number(data).toString());
                    $("#due_amount").html('').html(0);
                },
                error: function(xhr, status, error) {
                    // Handle error (optional)
                }
            });
        } else if (this.value == 'part_amount') {
            // If 'part_amount' is selected, enable #custom_pay
            $("#custom_pay").prop('disabled', false);
        }
    });

    // Keyup event handler for #custom_pay input
    $(document).on("keyup", "#custom_pay", function() {
        var amount = $(this).val();
        
        // Get unique code from an input field
        var unique_code = $("#unique_code").val();   
        
        // URL to get custom payment calculation
        var APP_URL = jQuery("#base_url").val();
        
        // AJAX GET request for custom payment calculation
        $.ajax({
            url: APP_URL + '/get_custom_pay_calculation',
            data: {amount: amount, unique_code: unique_code},
            type: 'get',
            success: function(data) {
                if (data < 0) {
                    // Alert if the custom amount is greater than the total amount
                    alert('Please check, your amount cannot be greater than the total amount');
                    
                    // Update #you_pay and #due_amount with the received data
                    $("#you_pay").html('').html(Number(amount).toString());
                    $("#due_amount").html('').html(data);
                } else {
                    // Update #you_pay and #due_amount with the received data
                    $("#you_pay").html('').html(Number(amount).toString());
                    $("#due_amount").html('').html(data);
                }
            },
            error: function(xhr, status, error) {
                // Handle error (optional)
            }
        });
    });
});

/*****************/

// Change event handler for radio buttons named 'amount'
$('input[type=radio][name=amount]').change(function() {
    // Retrieve the unique code from an input field
    var unique_code = $("#unique_code").val();   
    
    // Retrieve the selected amount type from the radio button
    var amount_type = $(this).val();
    
    // Set base URL from a hidden input field
    var APP_URL = jQuery("#base_url").val();
    
    // Show the spinner element to indicate loading
    var spinner = $('#loader');
    spinner.show();
    
    // AJAX GET request to fetch part payment details
    $.ajax({
        url: APP_URL + '/part_payment_type',
        data: {amount_type: amount_type, unique_code: unique_code},
        type: 'get',
        success: function(data) {
            // Update the #you_pay and #due_amount elements with the received data
            $("#you_pay").html('').html(data.pay_now);
            $("#due_amount").html('').html(data.due_amount);
            
            // Hide the spinner after data is successfully received
            spinner.hide(); 
        },
        error: function(xhr, status, error) {
            // Handle error (optional)
        }
    });
});

/*****************/

// Displays an alert informing the user that coupon changes are not allowed./
$(document).on("click", ".not_allowed", function() {
    alert('You cannot change coupon once you applied');
});

// Apply custom coupon on button click
$(document).on("click", ".apply_custom_coupon", function() {
    // Retrieve the coupon code from the input field
    var code = $('.coupon_value').val();
    
    // Check if the coupon code is valid
    if (code == '' || code == 0) {
        alert('Enter a valid coupon code');
    } else {
        // Set base URL from a hidden input field
        var APP_URL = jQuery("#base_url").val();
        
        // Show the spinner element to indicate loading
        var spinner = $('#loader');
        spinner.show();
        
        // AJAX GET request to check the coupon code
        $.ajax({
            url: APP_URL + '/check_coupon_code',
            data: {code: code},
            type: 'get',
            success: function(data) {
                // Hide the spinner after data is successfully received
                spinner.hide();
                
                if (data == 'error') {
                    alert('Enter correct code');
                } else {
                    // Process the valid coupon code
                    var id = data;
                    var type = 'coupon';
                    var amount_type = $("input[name='amount']:checked").val();

                    // Call a function to apply the coupon
                    coupon_apply(id, type, amount_type);
                }
            },
            error: function(xhr, status, error) {
                // Handle error (optional)
            }
        });
    }
});

// Apply coupon on button click
$(document).on("click", ".coupon_apply", function() {
    // Retrieve the coupon ID from the clicked element's ID attribute
    var id = $(this).attr('id');
    
    // Define the type as 'coupon'
    var type = 'coupon';
    
    // Retrieve the selected amount type from the radio buttons
    var amount_type = $("input[name='amount']:checked").val();
    
    // Call a function to apply the coupon with the retrieved parameters
    coupon_apply(id, type, amount_type);
});

// Remove coupon on button click
$(document).on("click", ".coupon_remove", function() {
    // Retrieve the coupon ID from the clicked element's ID attribute
    var id = $(this).attr('id');
    
    // Define the type as 'coupon_remove'
    var type = 'coupon_remove';
    
    // Retrieve the selected amount type from the radio buttons
    var amount_type = $("input[name='amount']:checked").val();
    
    // Call a function to apply the coupon removal with the retrieved parameters
    coupon_apply(id, type, amount_type);
});

// Function to apply or remove a coupon
function coupon_apply(id, type, amount_type) {
    // Retrieve the unique code from an input field
    var unique_code = $("#unique_code").val();
    
    // Set base URL from a hidden input field
    var APP_URL = jQuery("#base_url").val();
    
    // Show the spinner element to indicate loading
    var spinner = $('#loader');
    spinner.show();
    
    // AJAX GET request to apply or remove the coupon
    $.ajax({
        url: APP_URL + '/coupon_apply',
        data: {
            id: id,
            type: type,
            amount_type: amount_type,
            unique_code: unique_code
        },
        type: 'get',
        success: function(data) {
            // Update various elements with the received data
            $(".coupon_class").html('').html(data.coupn_output);
            $(".custom_fee_taxes").html('').html(data.total_fee_taxes);
            $(".custom_gst").html('').html(data.gst_amount);
            $(".custom_tcs").html('').html(data.tcs_amount);
            $(".custom_pg").html('').html(data.booking_amount);
            $(".custom_grand_pay").html('').html(data.grand_total);
            $(".custom_grand_second").html('').html(data.grand_total);
            $(".custom_discount_coupn").html('').html(data.custom_discount_coupn);
            $(".custom_offer_show").html('').html(data.custom_offer_show);
            $(".custom_remaining").html('').html(data.custom_remaining);
            $(".custom_last").html('').html(data.custom_last);
            $(".custom_first_installment").html('').html(data.custom_first_installment);
            $(".custom_second_installment").html('').html(data.custom_second_installment);
            $(".custom_third_installment").html('').html(data.custom_third_installment);
            $("#you_pay").html('').html(data.pay_now);
            $("#due_amount").html('').html(data.due_amount);
            
            // Hide the spinner after data is successfully received
            spinner.hide();
        },
        error: function(xhr, status, error) {
            // Handle error (optional)
        }
    });
};

/*****************/

// Handle form submission for saving booking details (Proceed)
$(document).on("submit", "#save_booking_details", function (e) {
    // Prevent the default form submission behavior
    e.preventDefault();
    
    // Check if the acknowledgement checkbox is checked
    if ($('#acknowledgement').is(':checked')) {
        var passenger_value = [];
        
        // Check each passenger select dropdown
        $(".passenger_select").each(function() {
            var mystring = $(this).val();
            
            if (mystring == '') {
                passenger_value.push("error");
            }
        });

        // Function to check if a value exists in an array
        function checkValue(value, arr) {
            var status = 'Not exist';
            for (var i = 0; i < arr.length; i++) {
                var name = arr[i];
                if (name == value) {
                    status = 'Exist';
                    break;
                }
            }
            return status;
        }

        // Check if any passenger select dropdowns are empty
        if (checkValue('error', passenger_value) == 'Exist') {
            alert('Kindly Select All Passengers');
        } else {
            // Get the form data
            var form = $('#save_booking_details')[0];
            var data = new FormData(form);
            
            // Set the base URL from a hidden input field
            var APP_URL = jQuery("#base_url").val();
            
            // Show the spinner element to indicate loading
            var spinner = $('#loader');
            spinner.show();
            
            // AJAX POST request to save booking details
            $.ajax({
                url: APP_URL + '/save_booking_details',
                data: data,
                type: 'post',
                contentType: false,
                processData: false,
                success: function (data) {
                    console.log(data);
                    spinner.hide();
                    
                    var amount_type = $("input[name='amount']:checked").val();
                    var token = jQuery('input[name="_token"]').val();
                    
                    // Create a form for payment option
                    var content_action = APP_URL + '/payment-option';
                    var form = document.createElement("form");
                    form.setAttribute("method", "post");
                    form.setAttribute("action", content_action);
                    form.setAttribute("target", "");
                    
                    // Create hidden input fields
                    var hiddenField = document.createElement("input");
                    hiddenField.setAttribute("type", "hidden");
                    hiddenField.setAttribute("name", "_token");
                    hiddenField.setAttribute("value", token);
                    form.appendChild(hiddenField);
                    
                    var second_field = document.createElement("input");
                    second_field.setAttribute("type", "hidden");
                    second_field.setAttribute("name", "amount_type");
                    second_field.setAttribute("value", amount_type);
                    form.appendChild(second_field);
                    
                    var third_field = document.createElement("input");
                    third_field.setAttribute("type", "hidden");
                    third_field.setAttribute("name", "unique_code");
                    third_field.setAttribute("value", data);
                    form.appendChild(third_field);

                    // Append the form to the body and submit it
                    document.body.appendChild(form);
                    form.submit();
                },
                error: function (xhr, status, error) {
                    // Handle error (optional)
                }
            });
        }
    } else {
        alert('Please Check Acknowledgement');
    }
});

/*****************/

// Add traveller
$(document).on("click", ".addModal", function () {
    // Clear input fields and set default selections
    $(".traveller_firstname").val('');
    $(".traveller_lastname").val('');
    $('.traveller_gender option[value=""]').prop('selected', true);
    $(".traveller_pancard").val('');
    $(".traveller_passportnumber").val('');

    // Determine type and set birth year options dynamically
    var type = $(this).attr('type');
    const d = new Date();
    let year = d.getFullYear();
    if (type == 'adult') {
        var output = '';
        output += "<option value=''>YYYY</option>";
        for (let i = year - 19; i > year - 100; i--) {
            output += "<option value='" + i + "'>" + i + "</option>";
        }
        $(".byear").html('').html(output);
    } else if (type == 'child') {
        var output = '';
        output += "<option value=''>YYYY</option>";
        for (let i = year - 3; i > year - 13; i--) {
            output += "<option value='" + i + "'>" + i + "</option>";
        }
        $(".byear").html('').html(output);
    } else if (type == 'infant') {
        var output = '';
        output += "<option value=''>YYYY</option>";
        for (let i = year; i > year - 3; i--) {
            output += "<option value='" + i + "'>" + i + "</option>";
        }
        $(".byear").html('').html(output);
    }

    // Store the ID of the clicked element in sessionStorage
    sessionStorage.setItem("path", $(this).attr('id'));

    // Clear and set traveller ID from sibling element's select value
    $(".trav_id").val('');
    var selected_item = $(this).siblings('.guestNameBox').children('.passenger_select').val();
    if (selected_item != '') {
        $(".trav_id").val('').val(selected_item);
        var APP_URL = jQuery("#base_url").val();
        var button = $(this);
        var spinner = $('#loader');
        var unique_code = $("#unique_code").val();

        // Show spinner and fetch passenger details via AJAX
        spinner.show();
        $.ajax({
            url: APP_URL + '/get_passenger_detail',
            data: { selected_item: selected_item, type: type, unique_code: unique_code },
            type: 'get',
            // contentType: false,
            // processData: false,
            success: function (data) {
                console.log(data);
                spinner.hide();
                if (data.error == 'success') {
                    // Fill form fields with fetched data
                    $(".traveller_firstname").val('').val(data.firstname);
                    $(".traveller_lastname").val('').val(data.lastname);
                    $('.traveller_gender option[value="' + data.gender + '"]').prop('selected', true);
                    $('.byear option[value="' + data.byear + '"]').prop('selected', true);
                    $(".bmonth").html('').html(data.months);
                    $(".bday").html('').html(data.days);
                    $('.bmonth option[value="' + data.bmonth + '"]').prop('selected', true);
                    $('.bday option[value="' + data.bday + '"]').prop('selected', true);

                    $('.iyear option[value="' + data.piyear + '"]').prop('selected', true);
                    $(".imonth").html('').html(data.passport_issuemonths);
                    $(".iday").html('').html(data.passport_issue_days);
                    $('.imonth option[value="' + data.pimonth + '"]').prop('selected', true);
                    $('.iday option[value="' + data.piday + '"]').prop('selected', true);

                    $('.eyear option[value="' + data.peyear + '"]').prop('selected', true);
                    $(".emonth").html('').html(data.passport_expire_months);
                    $(".eday").html('').html(data.passport_expire_days);
                    $('.emonth option[value="' + data.pemonth + '"]').prop('selected', true);
                    $('.eday option[value="' + data.peday + '"]').prop('selected', true);

                    $('#passportcountry option[value="' + data.passportcountry + '"]').prop('selected', true);
                    $('.traveller_nationality option[value="' + data.nationality + '"]').prop('selected', true);

                    $(".traveller_pancard").val('').val(data.pancard);
                    $(".traveller_passportnumber").val('').val(data.passportnumber);

                    // Show modal after filling data
                    var modal = document.getElementById("myModal");
                    modal.style.display = "block";
                } else {
                    alert(data.error); // Alert if there's an error
                }
            },
            error: function (xhr, status, error) {
                // Handle error (optional)
            }
        });
    } else {
        // If no selected item, just show modal
        var modal = document.getElementById("myModal");
        modal.style.display = "block";
    }
});

/*****/

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
// var btn = document.getElementById("addModal");
var btn = document.getElementsByClassName("addModal");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("btnCloseModal")[0];
var span = document.getElementsByClassName("btnCancel")[0];

// When the user clicks the button, open the modal
btn.onclick = function() {
	modal.style.display = "block";
}
// When the user clicks on <span> (x), close the modal
span.onclick = function() {
	modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
	if (event.target == modal) {
		modal.style.display = "none";
	}
};

/*****************/

// Handle year selection for birth, issue, and expiry date of passport
$(document).on("change", ".byear", function () {
    var year_val = $(this).val();
    // Call function to update day options for birth date
    year(year_val, 'bmonth', 'bday');
});

$(document).on("change", ".iyear", function () {
    var year_val = $(this).val();
    // Call function to update day options for issue date
    year(year_val, 'imonth', 'iday');
});

$(document).on("change", ".eyear", function () {
    var year_val = $(this).val();
    // Call function to update day options for expiry date
    year(year_val, 'emonth', 'eday');
});

/*****/

// Handle month selection for birth, issue, and expiry date of passport
$(document).on("change", ".bmonth", function () {
    var month_val = $(this).val();
    var year_val = $(".byear").val();
    // Call function to update day options for birth date
    month(year_val, month_val, 'bday', 'a');
});

$(document).on("change", ".imonth", function () {
    var month_val = $(this).val();
    var year_val = $(".iyear").val();
    // Call function to update day options for issue date
    month(year_val, month_val, 'iday', 'a');
});

$(document).on("change", ".emonth", function () {
    var month_val = $(this).val();
    var year_val = $(".eyear").val();
    // Call function to update day options for expiry date
    month(year_val, month_val, 'eday', 'b');
});

// Function to fetch day options based on selected month and year
function month(year_val, month_val, day, type) {
    var APP_URL = jQuery("#base_url").val();
    var path = sessionStorage.getItem("path");
    var traveller_type = $("#" + path).attr('type');
    var spinner = $('#loader');
    spinner.show();
    
    // AJAX call to fetch day options dynamically
    $.ajax({
        url: APP_URL + '/get_day',
        data: { year_val: year_val, month_val: month_val, type: type, traveller_type: traveller_type },
        type: 'get',
        success: function (data) {
            spinner.hide();
            // Update the day options in the corresponding HTML element
            $("." + day).html('').html(data);
            console.log(data); // Log the fetched data (for debugging)
        },
        error: function (xhr, status, error) {
            // Handle errors if AJAX request fails
        }
    });
};

//Handles year change events for selecting months and updating day options.
function year(year_val, type, day) {
    // Retrieve path and traveller type from session storage
    var path = sessionStorage.getItem("path");
    var traveller_type = $("#" + path).attr('type');

    // Set variables for AJAX request
    var type = type;
    var year_val = year_val;
    var day = day;
    var APP_URL = jQuery("#base_url").val();

    // Show loading spinner
    var spinner = $('#loader');
    spinner.show();

    // AJAX request to fetch month options based on selected year
    $.ajax({
        url: APP_URL + '/get_month',
        data: { type: type, year_val: year_val, traveller_type: traveller_type },
        type: 'get',
        success: function (data) {
            // Hide spinner on successful data retrieval
            spinner.hide();

            // Update month select options with retrieved data
            $("." + type).html('').html(data);

            // Reset day select options
            $("." + day).html('').html('<option selected disabled>DD</option>');

            console.log(data); // Log retrieved data for debugging
        },
        error: function (xhr, status, error) {
            // Handle errors if AJAX request fails
        }
    });
}

/*****************/

//Enables or disables passport country and expiry date fields based on passport number input
document.addEventListener('DOMContentLoaded', function() {
    // Passport Fields Management Function
    function ManagePassportFields(passportnumber) {
        var psptnumber = passportnumber.value.trim();
        var iyear = document.getElementById("iyear");
        var imonth = document.getElementById("imonth");
        var iday = document.getElementById("iday");
        var eyear = document.getElementById("eyear");
        var emonth = document.getElementById("emonth");
        var eday = document.getElementById("eday");
        var psptcountry = document.getElementById("passportcountry");
        var validpsptmsg = document.getElementById('validpassport');

        // Regular expression to check for alphanumeric and length between 6 to 10 characters
        var passportRegex = /^[a-zA-Z0-9]{6,10}$/;

        if (passportRegex.test(psptnumber)) {
            // Enable fields when Passport Number is valid
            iyear.disabled = false;
            imonth.disabled = false;
            iday.disabled = false;
            eyear.disabled = false;
            emonth.disabled = false;
            eday.disabled = false;
            psptcountry.disabled = false;

            // Example border color change for visibility
            iyear.style.borderColor = 'red';
            imonth.style.borderColor = 'red';
            iday.style.borderColor = 'red';
            eyear.style.borderColor = 'red';
            emonth.style.borderColor = 'red';
            eday.style.borderColor = 'red';
            psptcountry.style.borderColor = 'red';

            // Reset validation message
            validpsptmsg.innerHTML = '';
        } else {
            // Disable all fields when Passport Number is invalid or too long
            iyear.disabled = true;
            imonth.disabled = true;
            iday.disabled = true;
            eyear.disabled = true;
            emonth.disabled = true;
            eday.disabled = true;
            psptcountry.disabled = true;

            // Reset border color
            iyear.style.borderColor = '#9b9b9b';
            imonth.style.borderColor = '#9b9b9b';
            iday.style.borderColor = '#9b9b9b';
            eyear.style.borderColor = '#9b9b9b';
            emonth.style.borderColor = '#9b9b9b';
            eday.style.borderColor = '#9b9b9b';
            psptcountry.style.borderColor = '#9b9b9b';

            // Show validation message for invalid passport number
            if (psptnumber.length > 0) {
                validpsptmsg.innerHTML = 'Please enter a valid passport number';
                validpsptmsg.style.color = 'red';
            } else {
                validpsptmsg.innerHTML = '';
            }
        }
    }

    // Attach event listener to passport number input
    var passportInput = document.getElementById('passportnumber');
    passportInput.addEventListener('keyup', function() {
        ManagePassportFields(this);
    });

    // Initial call to manage passport fields based on initial value
    ManagePassportFields(passportInput);
});

/*****************/

// Handle deletion of traveller information
$(document).on("click", ".deleteInfo", function (e) {
    e.preventDefault();

    // Retrieve necessary values
    var trav_id = $(".trav_id").val(); // Get traveller ID
    var unique_code = $("#unique_code").val(); // Get unique code for identification

    // Get base URL for AJAX request
    var APP_URL = jQuery("#base_url").val();

    // Show spinner to indicate loading
    var spinner = $('#loader');
    spinner.show();

    // AJAX request to delete traveller
    $.ajax({
        url: APP_URL + '/delete_traveller',
        data: { trav_id: trav_id, unique_code: unique_code },
        type: 'get',
        success: function (data) {
            console.log(data); // Log response data to console (for debugging)

            spinner.hide(); // Hide spinner after AJAX request completes

            // Close modal if deletion was successful
            var modal = document.getElementById("myModal");
            modal.style.display = "none";

            // Update passenger select options with updated data
            var path = sessionStorage.getItem("path");
            $("#" + path).siblings('.guestNameBox').children('.passenger_select').html('').html(data);

            // Reset text of the selected passenger element to indicate adding new traveller
            $("#" + path).html('').html('<span class="fa-user"> </span> &nbsp;&nbsp;Add New');
        },
        error: function (xhr, status, error) {
            // Handle errors if AJAX request fails
        }
    });
});

/*****************/

// Handle form submission for #save_traveller form
/*$(document).on("submit", "#save_traveller", function (e) {
    e.preventDefault(); // Prevent default form submission

    // Get form data and initialize FormData object
    var form = $('#save_traveller')[0];
    var data = new FormData(form);

    // Get base URL from hidden input field
    var APP_URL = jQuery("#base_url").val();

    // Show loading spinner
    var spinner = $('#loader');
    spinner.show();

    // AJAX request to save traveller details
    $.ajax({
        url: APP_URL + '/save_traveller',
        data: data,
        type: 'post',
        contentType: false,
        processData: false,
        success: function (data) {
            console.log(data); // Log response data for debugging

            // Hide loading spinner after successful AJAX request
            spinner.hide();

            // Close modal after saving traveller details
            var modal = document.getElementById("myModal");
            modal.style.display = "none";

            // Update passenger details in UI based on sessionStorage path
            var path = sessionStorage.getItem("path");
            $("#" + path).siblings('.guestNameBox').children('.passenger_select').html('').html(data);
            $("#" + path).html('').html('<span class="fa-user"> </span> &nbsp;&nbsp; Edit');
        },
        error: function (xhr, status, error) {
            // Handle errors if AJAX request fails
        }
    });
});*/

/*passport validation on form submission
$(document).ready(function() {
    // Function to validate passport number format and length
    function validatePassportNumber(passportNumber) {
        var regex = /^[A-Za-z0-9]{6,10}$/; // Regex to match alphanumeric characters, length between 6 to 10
        return regex.test(passportNumber);
    }

    // Add event listener for form submission
    $("#save_traveller").submit(function(event) {
        var passportNumber = $("#passportnumber").val().trim();

        // Check if passport number is not blank
        if (passportNumber !== '') {
            // Validate passport number
            if (!validatePassportNumber(passportNumber)) {
                $("#validpassport").html('Please enter a valid passport number'); // Display error message
                $("#validpassport").css('color', 'red');
                event.preventDefault(); // Prevent form submission
                return false;
            }
        }
        // If passport number is blank or valid, allow form submission
        return true;
    });
});*/

// Add Traveller form with passport validation
$(document).on("submit", "#save_traveller", function (e) {
    e.preventDefault(); // Prevent default form submission

    // Function to validate passport number format and length
    function validatePassportNumber(passportNumber) {
        var regex = /^[A-Za-z0-9]{6,10}$/; // Regex to match alphanumeric characters, length between 6 to 10
        return regex.test(passportNumber);
    }

    // Get passport number value
    var passportNumber = $("#passportnumber").val().trim();

    // Check if passport number is not blank
    if (passportNumber !== '') {
        // Validate passport number
        if (!validatePassportNumber(passportNumber)) {
            $("#validpassport").html('Please enter a valid passport number'); // Display error message
            $("#validpassport").css('color', 'red');
            return false; // Prevent form submission
        }
    }

    // Get form data and initialize FormData object
    var form = $('#save_traveller')[0];
    var data = new FormData(form);

    // Get base URL from hidden input field
    var APP_URL = jQuery("#base_url").val();

    // Show loading spinner
    var spinner = $('#loader');
    spinner.show();

    // AJAX request to save traveller details
    $.ajax({
        url: APP_URL + '/save_traveller',
        data: data,
        type: 'post',
        contentType: false,
        processData: false,
        success: function (data) {
            console.log(data); // Log response data for debugging

            // Hide loading spinner after successful AJAX request
            spinner.hide();

            // Close modal after saving traveller details
            var modal = document.getElementById("myModal");
            modal.style.display = "none";

            // Update passenger details in UI based on sessionStorage path
            var path = sessionStorage.getItem("path");
            $("#" + path).siblings('.guestNameBox').children('.passenger_select').html('').html(data);
            $("#" + path).html('').html('<span class="fa-user"> </span> &nbsp;&nbsp; Edit');
        },
        error: function (xhr, status, error) {
            // Handle errors if AJAX request fails
        }
    });
});


/*****************/

/*//Handles year change events for selecting months and updating day options.
function year(year_val, type, day) {
    // Retrieve path and traveller type from session storage
    var path = sessionStorage.getItem("path");
    var traveller_type = $("#" + path).attr('type');

    // Set variables for AJAX request
    var type = type;
    var year_val = year_val;
    var day = day;
    var APP_URL = jQuery("#base_url").val();

    // Show loading spinner
    var spinner = $('#loader');
    spinner.show();

    // AJAX request to fetch month options based on selected year
    $.ajax({
        url: APP_URL + '/get_month',
        data: { type: type, year_val: year_val, traveller_type: traveller_type },
        type: 'get',
        success: function (data) {
            // Hide spinner on successful data retrieval
            spinner.hide();

            // Update month select options with retrieved data
            $("." + type).html('').html(data);

            // Reset day select options
            $("." + day).html('').html('<option selected disabled>DD</option>');

            console.log(data); // Log retrieved data for debugging
        },
        error: function (xhr, status, error) {
            // Handle errors if AJAX request fails
        }
    });
}*/

/*****************/

// Handle form submission for #save_traveller form with passport validation
/*$(document).on("submit", "#save_traveller", function (e) {
    e.preventDefault(); // Prevent default form submission

    // Function to validate passport number format and length
    function validatePassportNumber(passportNumber) {
        var regex = /^[A-Za-z0-9]{6,10}$/; // Regex to match alphanumeric characters, length between 6 to 10
        return regex.test(passportNumber);
    }

    // Validate first name and gender fields
    var firstname = $('#firstname').val().trim();
    var gender = $('#gender').val();

    if (!firstname) {
        alert('Please enter First Name.');
        return false; // Prevent form submission if first name is empty
    }

    if (gender === null || gender === undefined || gender === '') {
        alert('Please select Gender.');
        return false; // Prevent form submission if gender is not selected
    }

    // Get passport number value
    var passportNumber = $("#passportnumber").val().trim();

    // Check if passport number is not blank
    if (passportNumber !== '') {
        // Validate passport number
        if (!validatePassportNumber(passportNumber)) {
            $("#validpassport").html('Please enter a valid passport number'); // Display error message
            $("#validpassport").css('color', 'red');
            return false; // Prevent form submission
        }
    }

    // Get form data and initialize FormData object
    var form = $('#save_traveller')[0];
    var data = new FormData(form);

    // Get base URL from hidden input field
    var APP_URL = jQuery("#base_url").val();

    // Show loading spinner
    var spinner = $('#loader');
    spinner.show();

    // AJAX request to save traveller details
    $.ajax({
        url: APP_URL + '/save_traveller',
        data: data,
        type: 'post',
        contentType: false,
        processData: false,
        success: function (data) {
            console.log(data); // Log response data for debugging

            // Hide loading spinner after successful AJAX request
            spinner.hide();

            // Close modal after saving traveller details
            var modal = document.getElementById("myModal");
            modal.style.display = "none";

            // Update passenger details in UI based on sessionStorage path
            var path = sessionStorage.getItem("path");
            $("#" + path).siblings('.guestNameBox').children('.passenger_select').html('').html(data);
            $("#" + path).html('').html('<span class="fa-user"> </span> &nbsp;&nbsp; Edit');
        },
        error: function (xhr, status, error) {
            // Handle errors if AJAX request fails
            console.error(error);
        }
    });
});*/

</script>
@endsection
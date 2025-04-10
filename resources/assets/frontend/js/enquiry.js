
//Enquiry form validation (desktop & mobile)
function attachEnquiryValidation(formId) {
    document[formId].onsubmit = function () {
        return enq(formId);
    };
}

// Apply to both desktop and mobile
attachEnquiryValidation("enquiry_form_mob");
attachEnquiryValidation("enquiry_form");


function enq(form_ids) {
	var name=$('#'+form_ids).find('input[name="name"]').val();
	var email=$('#'+form_ids).find('input[name="email"]').val();
	var mobile=$('#'+form_ids).find('input[name="mobile"]').val();
	var time_call=$('#'+form_ids).find('select[name="time_call"]').val();
	var city_of_residence=$('#'+form_ids).find('input[name="city_of_residence"]').val();
	var country=$('#'+form_ids).find('input[name="country_of_residence"]').val();
	var destinations=$('#'+form_ids).find('input[name="destinations"]').val();
	var date_arrival=$('#'+form_ids).find('input[name="date_arrival"]').val();
	var accept_value=$('#'+form_ids).find('input[name="accept_value"]').val();	
	var patt_name=/^[A-Za-z]{1,}[A-Za-z .]{2,}$/;
	var patt_mail=/^[A-Za-z0-9]{1}[A-Za-z0-9_.]{0,}\@[A-Za-z0-9]{1,}[A-Za-z0-9.-]{1,}\.[A-Za-z]{1,}[A-Za-z.]{1,}$/;
		
	if( name.trim()=="") {
		$('#'+form_ids).find("#name_error").html('').html('Enter full name')
		$('#'+form_ids).find('input[name="name"]').focus();
		return false;
	} else if(patt_name.test(name)==false) {
		$('#'+form_ids).find("#name_error").html('').html('Enter valid name')
		$('#'+form_ids).find('input[name="name"]').focus();
		return false;
	} else if(email.trim()=="" || patt_mail.test(email)==false) {
		$('#'+form_ids).find("#email_error").html('').html('Enter valid email id')
		$('#'+form_ids).find('input[name="email"]').focus();
		$('#'+form_ids).find("#name_error").html('')
		return false;
	} else if(mobile.trim()=="" || isNaN(mobile)) {
		$('#'+form_ids).find("#mobile_error").html('').html('Enter valid Contact Number')
		$('#'+form_ids).find('input[name="mobile"]').focus();
        $('#'+form_ids).find("#name_error").html('')
		$('#'+form_ids).find("#email_error").html('')
		return false;
	} else if(time_call=="0") {
		$('#'+form_ids).find("#time_call_error").html('').html('Choose best time to connect')
        $('#'+form_ids).find('select[name="time_call"]').focus();
        $('#'+form_ids).find("#name_error").html('')
		$('#'+form_ids).find("#email_error").html('')
		$('#'+form_ids).find("#mobile_error").html('')
        return false;
	} else if(city_of_residence.trim()=="" || patt_name.test(city_of_residence)==false) {
		$('#'+form_ids).find("#city_of_residence_error").html('').html('Enter departure city')
		$('#'+form_ids).find('input[name="city_of_residence"]').focus();
		$('#'+form_ids).find("#name_error").html('')
		$('#'+form_ids).find("#email_error").html('')
		$('#'+form_ids).find("#mobile_error").html('')
		$('#'+form_ids).find("#time_call_error").html('')
		return false;
	} else if(country=="0") {
		$('#'+form_ids).find("#country_of_residence_error").html('').html('Choose nationality')
		$('#'+form_ids).find('input[name="country_of_residence"]').focus();
		$('#'+form_ids).find("#name_error").html('')
		$('#'+form_ids).find("#email_error").html('')
		$('#'+form_ids).find("#mobile_error").html('')
		$('#'+form_ids).find("#time_call_error").html('')
		$('#'+form_ids).find("#city_of_residence_error").html('')
		return false;
	} else if(destinations.trim()=="" ) {
		$('#'+form_ids).find("#destinations_error").html('').html('Enter destination')
		$('#'+form_ids).find('input[name="destinations"]').focus();
		$('#'+form_ids).find("#name_error").html('')
		$('#'+form_ids).find("#email_error").html('')
		$('#'+form_ids).find("#mobile_error").html('')
		$('#'+form_ids).find("#time_call_error").html('')
		$('#'+form_ids).find("#city_of_residence_error").html('')
		$('#'+form_ids).find("#country_of_residence_error").html('')
		return false;
	} else if(date_arrival.trim()=="") {
		$('#'+form_ids).find("#date_arrival_error").html('').html('Choose travel date')
		$('#'+form_ids).find('input[name="date_arrival"]').focus();
		$('#'+form_ids).find("#name_error").html('')
		$('#'+form_ids).find("#email_error").html('')
		$('#'+form_ids).find("#mobile_error").html('')
		$('#'+form_ids).find("#time_call_error").html('')
		$('#'+form_ids).find("#city_of_residence_error").html('')
		$('#'+form_ids).find("#country_of_residence_error").html('')
		$('#'+form_ids).find("#destinations_error").html('')
		return false;
	} else if(accept_value=="0") {
		$('#'+form_ids).find("#accept_value_error").html('').html('Please accept Terms & Conditions')
		$('#'+form_ids).find('input[name="accept_value"]').focus();
		$('#'+form_ids).find("#name_error").html('')
		$('#'+form_ids).find("#email_error").html('')
		$('#'+form_ids).find("#mobile_error").html('')
		$('#'+form_ids).find("#time_call_error").html('')
		$('#'+form_ids).find("#city_of_residence_error").html('')
		$('#'+form_ids).find("#country_of_residence_error").html('')
		$('#'+form_ids).find("#destinations_error").html('')
		$('#'+form_ids).find("#date_arrival_error").html('')
		return false;
	}
	//New Starts
	else {
		var app_url_custom=$("#APP_URL").val();
		//else {
		$.ajax( {
			url:app_url_custom+'/save_enq_type',
			type:'get',
			success:function(data) {
				if(data=='otp') {
					var modal = document.getElementById("enquiryModal_mobile");
					var modal_destop = document.getElementById("enquiryModal_desktop");
					if (jQuery("#enquiryModal_mobile").css('display') == 'block') {
						modal.style.display = "none";
					}
					if (jQuery("#enquiryModal_desktop").css('display') == 'block') {
						modal_destop.style.display = "none";
					}
					$('#under_processing').modal('show');
					var form_data = new FormData($('#'+form_ids)[0]);
					$.ajax( {
						url:app_url_custom+'/save_otp_Query',
						data:form_data,
						type:'post',
						contentType: false,
						processData: false,
						success:function(data) {
							$("#overlay").fadeOut(300);
							if(data=='success') {
								$('#under_processing').modal('hide');
								$('#myModal_destop_otp').modal('show');
								// var myModal_destop_otp = document.getElementById("myModal_destop_otp");
								// myModal_destop_otp.style.display = "block";
								// swal("Done !", 'Thank you! Enquiry submitted successfully', "success");
							} else {
								$('#under_processing').modal('hide');
								swal("Error", data, "error");
							}
						},
						error:function(data) {
						}
					})
					return false;
				} else {
					var modal = document.getElementById("enquiryModal_mobile");
					var modal_destop = document.getElementById("enquiryModal_desktop");
					if (jQuery("#enquiryModal_mobile").css('display') == 'block') {
						modal.style.display = "none";
					}
					if (jQuery("#enquiryModal_desktop").css('display') == 'block') {
						modal_destop.style.display = "none";
					}

					$('#under_processing').modal('show');				
					var form_data = new FormData($('#'+form_ids)[0]);
					$.ajax( {
						url:app_url_custom+'/saveQuery',
						data:form_data,
						type:'post',
						contentType: false,
						processData: false,
						success:function(data) {
							$("#overlay").fadeOut(300);
							if(data=='success') {
								$('#under_processing').modal('hide');
								swal("Done !", 'Thank you! Enquiry submitted successfully', "success");
							} else {
								swal("Error", data, "error");
							}
						},
						error:function(data) {
						}
					})
					return false;
				}
			},
			error:function(data) {
			}
		})
		return false;
	}
}


/***********************************************/


//enquiry via OTP
$(document).on("click", ".submit_otp_enq", function() {
    var APP_URL = $("#APP_URL").val();
    var otp_value = $("#enq_otp_value").val();

    if (otp_value == '') {
        swal("Error", 'Enter OTP', "error");
    } else {
        $('#under_processing').modal('show');

        var modal = document.getElementById("enquiryModal_mobile");
        var modal_destop = document.getElementById("enquiryModal_desktop");
        var myModal_destop_otp = document.getElementById("myModal_destop_otp");

        if ($("#enquiryModal_mobile").css('display') == 'block') {
            modal.style.display = "none";
        }
        if ($("#enquiryModal_desktop").css('display') == 'block') {
            modal_destop.style.display = "none";
        }
        if ($("#myModal_destop_otp").css('display') == 'block') {
            myModal_destop_otp.style.display = "none";
        }

        var csrf_token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: APP_URL + '/enq_with_otp',
            type: 'GET',
            data: { 
            	_token: csrf_token, otp_value: otp_value 
            },
            success: function(rdata) {
                $('#under_processing').modal('hide');
                if (rdata == 'success') {
                    swal("Done!", 'Thank you! Enquiry submitted successfully', "success");
                } else {
                    myModal_destop_otp.style.display = "block";
                    swal("Error", rdata, "error");
                }
            },
            error: function(xhr, status, error) {
                $('#under_processing').modal('hide');
                swal("Error", "Something went wrong. Please try again.", "error");
            }
        });
    }
});

/*$(document).on("click", ".submit_otp_enq", function() {
    var APP_URL = $("#APP_URL").val();
    var otp_value = $("#enq_otp_value").val();

    if (otp_value == '') {
        swal("Error", 'Enter OTP', "error");
        return;
    }

    $('#under_processing').modal('show'); // Show loading modal

    var csrf_token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: APP_URL + '/enq_with_otp',
        type: 'GET',
        data: { _token: csrf_token, otp_value: otp_value },
        success: function(rdata) {
            $('#under_processing').modal('hide'); // Hide loading modal

            if (rdata == 'success') {
                swal("Done!", 'Thank you! Enquiry submitted successfully', "success");

                // Close OTP modal properly
                $('#enquiryModal_mobile').modal('hide');
                $('#enquiryModal_desktop').modal('hide');
                $('#myModal_destop_otp').modal('hide');
            } else {
                swal("Error", rdata, "error");

                // Show OTP modal again if incorrect OTP is entered
                if ($("#enquiryModal_mobile").is(':visible')) {
                    $('#enquiryModal_mobile').modal('show');
                } else if ($("#enquiryModal_desktop").is(':visible')) {
                    $('#enquiryModal_desktop').modal('show');
                } else {
                    $('#myModal_destop_otp').modal('show'); // Ensure OTP modal is shown properly
                }
            }
        },
        error: function(xhr, status, error) {
            $('#under_processing').modal('hide'); // Hide loading modal
            swal("Error", "Something went wrong. Please try again.", "error");
        }
    });
});*/

/***********************************************/

// resend OTP
/*$(document).ready(function () {
    startOTPTimer(); // Start the OTP timer on page load

    $("#btn_resendOTP").on("click", function () {
        $(this).prop("disabled", true); // Disable button
        startOTPTimer(); // Restart the timer
        resendOTP(); // Function to handle OTP resend
    });
});

function startOTPTimer() {
    var timerDuration = 120; // 2 minutes (in seconds)
    var timerDisplay = $("#timer");
    var btn_resendOTP = $("#btn_resendOTP");

    btn_resendOTP.prop("disabled", true); // Ensure resend is disabled at start

    var countdown = setInterval(function () {
        var minutes = Math.floor(timerDuration / 60);
        var seconds = timerDuration % 60;
        timerDisplay.text(`Resend in ${minutes}:${seconds < 10 ? "0" : ""}${seconds}`);

        if (timerDuration <= 0) {
            clearInterval(countdown);
            timerDisplay.text("You can resend OTP now!");
            btn_resendOTP.prop("disabled", false); // Enable the resend button
        }
        timerDuration--;
    }, 1000);
}

function resendOTP() {
    var APP_URL = $("#APP_URL").val(); // Ensure APP_URL is set
    $.ajax({
        url: APP_URL + "/resend_otp",
        type: "GET",
        data: { _token: $('meta[name="csrf-token"]').attr("content") },
        success: function (response) {
            if (response == "success") {
                swal("Success!", "OTP has been resent successfully!", "success");
            } else {
                swal("Error", "Failed to resend OTP. Try again later.", "error");
            }
        },
        error: function () {
            swal("Error", "Something went wrong. Please try again.", "error");
        }
    });
}*/


// resend OTP
document.addEventListener("DOMContentLoaded", function () {
    let timerElement = document.getElementById("timer");
    let resendButton = document.getElementById("btn_resendOTP");
    let otpInput = document.getElementById("enq_otp_value");
    let mobileInput = document.querySelector("input[name='mobile']");
    let submitButton = document.querySelector(".submit_otp_enq");
    let countdown = 30;
    let interval;

    function startTimer() {
        clearInterval(interval);
        countdown = 30;
        timerElement.style.display = "inline";
        resendButton.style.display = "none";

        interval = setInterval(() => {
            timerElement.textContent = `Resend in ${countdown}s`;
            countdown--;

            if (countdown < 0) {
                clearInterval(interval);
                timerElement.style.display = "none";
                resendButton.style.display = "inline";
            }
        }, 1000);
    }

    submitButton.addEventListener("click", function (event) {
        event.preventDefault();
        let otpValue = otpInput.value.trim();

        if (!otpValue) {
            swal("Error", "Please enter the OTP!", "error");
            return;
        }

        console.log("Entered OTP:", otpValue);
        startTimer();
    });

    resendButton.addEventListener("click", function () {
        let mobileNumber = mobileInput ? mobileInput.value.trim() : "";

        if (!mobileNumber) {
            swal("Error", "Mobile number is required to resend OTP!", "error");
            return;
        }

        resendButton.style.display = "none";
        timerElement.style.display = "inline";
        timerElement.textContent = "Resending...";

        // AJAX request to resend OTP
        /*fetch(APP_URL + `/resend_otp?mobile=${encodeURIComponent(mobileNumber)}`, { 
    		method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ mobile: mobileNumber })
        })
        .then(response => response.json())
        .then(data => {
            console.log("Resend Response:", data);

            if (data.status === "success") {
                swal("Success!", "OTP has been resent successfully!", "success");
                startTimer();
            } else {
                swal("Error", data.message || "Failed to resend OTP. Try again later.", "error");
                resendButton.style.display = "inline";
                timerElement.style.display = "none";
            }
        })
        .catch(error => {
            console.error("Fetch Error:", error);
            swal("Error", "Something went wrong. Try again later.", "error");
            resendButton.style.display = "inline";
            timerElement.style.display = "none";
        });*/

        fetch(APP_URL + `/resend_otp`, { 
		    method: 'GET'
		})
		.then(response => response.json())
		.then(data => {
		    if (data.status === "success") {
		        swal("Success!", data.message, "success");
		        startTimer(); // Restart countdown
		    } else {
		        swal("Error", data.message, "error");
		    }
		})
		.catch(error => {
		    swal("Error", "Something went wrong. Try again later.", "error");
		});

    });

    startTimer();
});


/***********************************************/

//Calendar enquiry form validation
document.enquiry_form_cal.onsubmit=function() {
	return enq1()
}

	function enq1() {
		var name=document.enquiry_form_cal.name.value;
		var email=document.enquiry_form_cal.email.value;
		var mobile=document.enquiry_form_cal.mobile.value;
		var time_call=document.enquiry_form_cal.time_call.value;
		var city_of_residence=document.enquiry_form_cal.city_of_residence.value;
		var country=document.enquiry_form_cal.country_of_residence.value;
		var destinations=document.enquiry_form_cal.destinations.value;
		var date_arrival=document.enquiry_form_cal.date_arrival.value;
		var accept_value=document.enquiry_form_cal.accept_value.value;
		
		var patt_name=/^[A-Za-z]{1,}[A-Za-z .]{2,}$/;
		var patt_mail=/^[A-Za-z0-9]{1}[A-Za-z0-9_.]{0,}\@[A-Za-z0-9]{1,}[A-Za-z0-9.-]{1,}\.[A-Za-z]{1,}[A-Za-z.]{1,}$/;

		if( name.trim()=="") {
			document.querySelector("#name_error_cal").innerHTML="Enter full name";
			document.enquiry_form_cal.name.focus();
			return false;
			}
		else if(patt_name.test(name)==false) {
			document.querySelector("#name_error_cal").innerHTML="Enter valid Name";
			document.enquiry_form_cal.name.focus();
			return false;
			}
		else if(email.trim()=="" || patt_mail.test(email)==false) {
			document.querySelector("#email_error_cal").innerHTML="Enter valid email id";
			document.enquiry_form_cal.email.focus();
			document.querySelector("#name_error_cal").innerHTML="";
			return false;
			}
		else if(mobile.trim()=="" || isNaN(mobile)) {
			document.querySelector("#mobile_error_cal").innerHTML="Enter valid contact number";
			document.enquiry_form_cal.mobile.focus();
			document.querySelector("#name_error_cal").innerHTML="";
			document.querySelector("#email").innerHTML="";
			return false;
			}
		else if(time_call=="0") {
			document.querySelector("#time_call_error_cal").innerHTML="Choose best time to connect";
			document.enquiry_form_cal.time_call.focus();
			document.querySelector("#name_error_cal").innerHTML="";
			document.querySelector("#email_error_cal").innerHTML="";
			document.querySelector("#mobile_error_cal").innerHTML="";
			return false;
			}
		else if(city_of_residence.trim()=="" || patt_name.test(city_of_residence)==false) {
			document.querySelector("#city_of_residence_error_cal").innerHTML="Enter departure city";
			document.enquiry_form_cal.city_of_residence.focus();
			document.querySelector("#name_error_cal").innerHTML="";
			document.querySelector("#email_error_cal").innerHTML="";
			document.querySelector("#mobile_error_cal").innerHTML="";
			document.querySelector("#time_call_error_cal").innerHTML="";
			return false;
			}
		else if(country=="0") {
			document.querySelector("#country_of_residence_error_cal").innerHTML="Choose nationality";
			document.enquiry_form_cal.country.focus();
			document.querySelector("#name_error_cal").innerHTML="";
			document.querySelector("#email_error_cal").innerHTML="";
			document.querySelector("#mobile_error_cal").innerHTML="";
			document.querySelector("#time_call_error_cal").innerHTML="";
			document.querySelector("#city_of_residence_error_cal").innerHTML="";
			return false;
			}
		else if(destinations.trim()=="" ) {
			document.querySelector("#destinations_error_cal").innerHTML="Enter destination";
			document.enquiry_form_cal.destinations.focus();
			document.querySelector("#name_error_cal").innerHTML="";
			document.querySelector("#email_error_cal").innerHTML="";
			document.querySelector("#mobile_error_cal").innerHTML="";
			document.querySelector("#time_call_error_cal").innerHTML="";
			document.querySelector("#city_of_residence_error_cal").innerHTML="";
			document.querySelector("#country_of_residence_error_cal").innerHTML="";
			return false;
			}
		else if(date_arrival.trim()=="") {
			document.querySelector("#date_arrival_error_cal").innerHTML="Choose travel date";
			document.enquiry_form.date_arrival_error_cal.focus();
			document.querySelector("#name_error_cal").innerHTML="";
			document.querySelector("#email_error_cal").innerHTML="";
			document.querySelector("#mobile_error_cal").innerHTML="";
			document.querySelector("#time_call_error_cal").innerHTML="";
			document.querySelector("#city_of_residence_error_cal").innerHTML="";
			document.querySelector("#country_of_residence_error_cal").innerHTML="";
			document.querySelector("#destinations_error_cal").innerHTML="";
			return false;
			}
		else if(accept_value=="0") {
			document.querySelector("#accept_value_error_cal").innerHTML="Please accept terms and conditions";
			document.enquiry_form_cal.accept_value.focus();
			document.querySelector("#name_error_cal").innerHTML="";
			document.querySelector("#email_error_cal").innerHTML="";
			document.querySelector("#mobile_error_cal").innerHTML="";
			document.querySelector("#time_call_error_cal").innerHTML="";
			document.querySelector("#city_of_residence_error_cal").innerHTML="";
			document.querySelector("#destinations_error_cal").innerHTML="";
			document.querySelector("#country_of_residence_error_cal").innerHTML="";
			document.querySelector("#date_arrival_error_cal").innerHTML="";
			return false;
			}
		else {
			var app_url_custom=$("#APP_URL").val();
			$.ajax( {
				url:app_url_custom+'/save_enq_type',
				type:'get',
				success:function(data) {
					if(data=='otp') {
						var modal = document.getElementById("enquiryModal_mobile");
						var modal_destop = document.getElementById("enquiryModal_desktop");
						if (jQuery("#enquiryModal_mobile").css('display') == 'block') {
							modal.style.display = "none";
							}
						if (jQuery("#enquiryModal_desktop").css('display') == 'block') {
							modal_destop.style.display = "none";
							}
						$('#under_processing').modal('show');
						var form_data = new FormData($('#'+form_ids)[0]);
						$.ajax( {
							url:app_url_custom+'/save_otp_Query',
							data:form_data,
							type:'post',
							contentType: false,
							processData: false,
							success:function(data) {
							$("#overlay").fadeOut(300);
							if(data=='success') {
								$('#under_processing').modal('hide');
								var myModal_destop_otp = document.getElementById("myModal_destop_otp");
								myModal_destop_otp.style.display = "block";
								// swal("Done !", 'Thank you! Enquiry submitted successfully', "success");
								}
							else {
								swal("Error", data, "error");
								}
							},
							error:function(data) {
							}
							})
						return false;
						}
					else {
						var form_data = new FormData($('#enquiry_form_cal')[0]);
						$.ajax( {
							url:app_url_custom+'/saveQuery',
							data:form_data,
							type:'post',
							contentType: false,
							processData: false,
							success:function(data) {
								$("#overlay").fadeOut(300);
								if(data=='success') {
									var modal = document.getElementById("enquiryModal_mobile");
									var modal_destop = document.getElementById("enquiryModal_desktop");
									if (jQuery("#enquiryModal_mobile").css('display') == 'block') {
										modal.style.display = "none";
										}
									if (jQuery("#enquiryModal_desktop").css('display') == 'block') {
										modal_destop.style.display = "none";
										}
										swal("Done !", 'Thank you! Enquiry submitted successfully', "success");
										}
								else {
								swal("Error", data, "error");
								}
								},
							error:function(data) {
							}
							})
						return false;
						}
					},
				error:function(data) {
				}
				})
			return false;
			}
	}


/***********************************************/


// Increment/Decrement of traveller Function (new working)
function updateCount(category, increment = true) {
  const valueElement = $(`.span_value_${category}`);
  const inputElement = $(`.span_value_${category}1`);
  
  // Get the current value, default to 0 if empty or invalid
  let currentValue = parseInt(valueElement.html()) || 0;

  // Update the value based on increment or decrement
  const newValue = increment ? currentValue + 1 : Math.max(0, currentValue - 1);

  // Update the HTML and input field
  valueElement.html(newValue);
  inputElement.val(newValue);
}

// Event Listeners for Increment and Decrement Buttons
$(document).ready(function () {
  const categories = ['adult', 'child', 'child_without_bed', 'infant'];

  categories.forEach((category) => {
    // Increment button
    $(`.span_inc_${category}`).click(function () {
      updateCount(category, true);
    });

    // Decrement button
    $(`.span_des_${category}`).click(function () {
      updateCount(category, false);
    });
  });
});


/***********************************************/


// country code + nationality + country code calendar
// Get APP_URL from hidden input
var APP_URL = document.querySelector("#APP_URL").value;

function fetchCountryData(endpoint, elementId) {
    var url = `${APP_URL}/${endpoint}`;
    console.log(`Fetching: ${url}`); // Debugging URL

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
        if (!element) {  // ✅ Check if element exists before updating
            console.warn(`Skipped: Element '${elementId}' not found.`);
            return;
        }
        element.innerHTML = rdata;
    })
    .catch(error => {
        console.error(`Error fetching data from ${endpoint}:`, error);
    });
}

// Fetch Country Data (Only if elements exist)
document.addEventListener("DOMContentLoaded", function () {
    let elementsToFetch = [
        { endpoint: 'country_code', elementId: '#country_code' },
        { endpoint: 'country_query_s', elementId: '#country_of_residence' },
        { endpoint: 'country_query_s', elementId: '#country_of_residence_cal' },
        { endpoint: 'country_code', elementId: '#country_code_mobile' },
        { endpoint: 'country_query_s', elementId: '#country_of_residence_mobile' }
    ];

    elementsToFetch.forEach(({ endpoint, elementId }) => {
        if (document.querySelector(elementId)) {  // ✅ Only fetch if element exists
            fetchCountryData(endpoint, elementId);
        } /*else {
            console.warn(`Skipped: '${elementId}' not found in the DOM.`);
        }*/
    });
});


/***********************************************/


// hotel preference selection
document.addEventListener("DOMContentLoaded", handleHotelCategorySelection);

// Function to handle hotel star category selection radio buttons
function handleHotelCategorySelection() {
  const radioButtons = document.querySelectorAll('.hotel-selection input[type="radio"]');
  const defaultHotelPreference = "4"; // Default hotel preference value

  // Function to handle change event for radio buttons
  function handleRadioChange() {
    // Remove the selected-item class from all labels
    document.querySelectorAll('.hotel-selection').forEach(label => label.classList.remove('selected-item'));

    // Add the selected-item class to the selected label
    if (this.checked) {
      this.parentElement.classList.add('selected-item');
    }
  }

  // Function to handle keypress event for radio buttons (for accessibility)
  function handleRadioKeypress(event) {
    if (event.key === "Enter" || event.key === " ") {
      this.click(); // Simulate click when Enter or Space key is pressed
    }
  }

  // Add event listeners for change and keypress events to each radio button
  radioButtons.forEach(radio => {
    radio.addEventListener('change', handleRadioChange);
    radio.addEventListener('keypress', handleRadioKeypress);
  });

  // Set default selection (4-star)
  const defaultRadioButton = document.querySelector(`.hotel-selection input[type="radio"][value="${defaultHotelPreference}"]`);
  if (defaultRadioButton) {
    defaultRadioButton.checked = true;
    defaultRadioButton.dispatchEvent(new Event('change'));
  }
}


/***********************************************/


// budget slider
document.addEventListener("DOMContentLoaded", budgetSlider);

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

/**********************/


// Handle changes for the additional details checkboxes (Desktop & Mobile)
$(document).on("change", ".additional_details", function() {
    updateAdditionalDetails();
});

// Handle changes for flight booking preference (Yes or No) (Desktop & Mobile)
$(document).on("change", "input[name='flight_booking']", function() {
    const radioButtons = $("input[name='flight_booking']");
    
    // Remove 'selected-item' from all labels first
    radioButtons.closest('label').removeClass('selected-item');

    // Add 'selected-item' to the selected label
    $(this).closest('label').addClass('selected-item');

    // Update the additional details textarea
    updateAdditionalDetails();
});

// Function to update the additional details textarea based on radio button and checkbox selections
function updateAdditionalDetails() {
    const radioButtons = document.querySelectorAll('input[name="flight_booking"]');
    const checkboxes = document.querySelectorAll('.additional_details');
    const additionalDetailsTextarea = document.getElementById("additionaldetails"); // Desktop
    const additionalDetailsMobileTextarea = document.getElementById("additionaldetails_mobile"); // Mobile
    let details = [];

    // Add flight booking preference to details array
    radioButtons.forEach(radio => {
        if (radio.checked) {
            details.push(`Flight ticket booked: ${radio.value === "0" ? "Yes" : "No"}`);
        }
    });

    // Add selected checkbox values (additional details) to the details array
    checkboxes.forEach(checkbox => {
        if (checkbox.checked) {
            details.push(checkbox.value);
        }
    });

    // Update both textareas (desktop & mobile) with the gathered details
    if (additionalDetailsTextarea) {
        additionalDetailsTextarea.value = details.join(', ');
    }
    if (additionalDetailsMobileTextarea) {
        additionalDetailsMobileTextarea.value = details.join(', ');
    }
}

// Reset additional details textareas if needed (Desktop & Mobile)
function resetAdditionalDetails() {
    $("#additionaldetails").val('');
    $("#additionaldetails_mobile").val('');
}


/***********************************************/


//Accept Terms & Conditions (desktop & mobile and calendar)
function toggleAcceptValue(selector) {
    $(selector).click(function() {
        $(this).val($(this).val() === "0" ? "1" : "0");
    });
}

// Apply to both desktop and mobile
toggleAcceptValue("#accept_value");
toggleAcceptValue("#accept_value_cal");
toggleAcceptValue("#accept_value_mob");

/***********************************************/
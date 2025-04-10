/*user-profile*/

/*sidebar smooth scroll into view*/
document.addEventListener('DOMContentLoaded', function() {
    // Get all sidebar links
    const sidebarLinks = document.querySelectorAll('.sidebarLink');
    const sidebarItems = document.querySelectorAll('.sideBarItem');

    // Add click event listener to each sidebar link
    sidebarLinks.forEach(function(link, index) {
        link.addEventListener('click', function(event) {
            // Prevent default link behavior
            event.preventDefault();

            // Remove active class from all sidebar items
            sidebarItems.forEach(function(item) {
                item.classList.remove('active');
            });

            // Add active class to the clicked sidebar item
            sidebarItems[index].classList.add('active');

            // Get the target section ID from href attribute
            const targetId = this.getAttribute('href').substring(1); // Remove the '#' from href

            // Get the target element by ID
            const targetElement = document.getElementById(targetId);

            // Check if the target element exists
            if (targetElement) {
                // Calculate the scroll position with an offset of 20px
                const offset = targetElement.getBoundingClientRect().top - 10;

                // Scroll to the target position with smooth behavior
                window.scrollTo({
                    top: window.pageYOffset + offset,
                    behavior: 'smooth'
                });
            }
        });
    });
});

/********************/

/*profile-image-upload*/
$(document).ready(() => {
    // File validation function
    function Filevalidation() {
        const fi = document.getElementById('file');
        const fileSize = Math.round(fi.files[0].size / 1024); // File size in KB
        const validExtensions = ["jpg", "jpeg", "bmp", "gif", "png"];
        const validMIMETypes = ["image/jpeg", "image/png", "image/gif", "image/bmp"];

        // Check file size
        if (fileSize >= 100) {
            alert("File too Big, please select a file less than 100kb");
            return false; // Stop further execution
        } else if (fileSize < 2) {
            alert("File too small, please select a file greater than 2kb");
            return false; // Stop further execution
        }

        // Check file format by extension
        const fileName = fi.files[0].name;
        const fileExtension = fileName.split('.').pop().toLowerCase();

        if ($.inArray(fileExtension, validExtensions) === -1) {
            alert("Invalid file format. Please upload a valid image file.");
            return false; // Stop further execution
        }

        // Check file format by MIME type
        const fileMIMEType = fi.files[0].type;

        if ($.inArray(fileMIMEType, validMIMETypes) === -1) {
            alert("Invalid file format. Please upload a valid image file.");
            return false; // Stop further execution
        }

        document.getElementById('size').innerHTML = '<b>' + fileSize + '</b> KB';
        return true; // Proceed with upload
    }

    $('#file').change(function() {
        const file = this.files[0];

        // Call Filevalidation function
        if (!Filevalidation()) {
            return; // Stop further execution
        }

        if (file) {
            let reader = new FileReader();
            reader.onload = function(event) {
                $('#imgPreview').attr('src', event.target.result);

                const APP_URL = $("#APP_URL").val();
                const url = APP_URL + '/upload_profile_image';

                const form_data = new FormData();
                form_data.append('file', file);

                $.ajax({
                    url: url,
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'post',
                    success: function(response) {
                        console.log('Uploaded');
                    },
                    error: function(response) {
                        alert('Upload failed');
                    }
                });
            }
            reader.readAsDataURL(file);
        }
    });
});

/********************/

/*birthday datepicker*/
$(document).ready(function() {
    $("#datepicker_dob").datepicker ({
        dateFormat: 'dd-mm-yy', // Display format
        onSelect: function(dateText, inst) {
            // Convert date to international format (yyyy-mm-dd) and set as input value
            var selectedDate = $.datepicker.parseDate('dd-mm-yy', dateText);
            var isoDate = selectedDate.toISOString().slice(0,10); // Database format
            $(this).val(dateText); // Set the input field value to display format
        }
    });
    $("#datepicker_anniversary").datepicker({
        dateFormat: 'dd-mm-yy', // You can customize the format
        // Add any specific options or event handling for the anniversary datepicker
    });
});

/********************/

/*anniversary date in profile*/

// Add event listener for the "load" event on the document
document.addEventListener("load", onLoad);

// Function to execute when the document is loaded
function onLoad() {
  // Call ShowHideAnniversary function when the document is loaded
  ShowHideAnniversary();
	}

// Function to show/hide anniversary date based on marital status
function ShowHideAnniversary() {
  var maritalstatus = document.getElementById("maritalstatus");
  var anniversarydate = document.getElementById("anniversarydate");

  // Check if the marital status is "married", display the anniversary date; otherwise, hide it
  anniversarydate.style.display = maritalstatus.value == "married" ? "block" : "none";
  }

/********************/

/*delete mobile tooltip*/
document.addEventListener('DOMContentLoaded', function() {
    // Get references to the elements
    const clickDelMobile = document.getElementById('clickDelete');
    const tooltip_delMob = document.getElementById('tooltip');
    const cancelBtn = document.getElementById('cancelBtn');

    // Function to show the tooltip
    clickDelMobile.addEventListener('click', function() {
        tooltip_delMob.style.display = 'block';
        });

    // Function to hide the tooltip when "Cancel" is clicked
    cancelBtn.addEventListener('click', function() {
        tooltip_delMob.style.display = 'none';
        });
});

//delete mobile no
$(document).on("click", ".delete_mobile_no", function() {
    var APP_URL = $("#APP_URL").val();
    if (confirm("Are you sure you want to delete this mobile number?")) {
        $('#under_processing').modal('toggle');
        var url = APP_URL + '/user_mobile_verify';
        var data = {
            _token: "{{ csrf_token() }}"
        };
        $.get(url, data, function(rdata) {
            if (rdata === 'success') {
                $('#under_processing').modal('hide');
                $('#mobile_verify_delete_modal').modal('toggle');
            } else {
                alert(rdata);
            }
        });
    }
});

/********************/

//mobile_delete_otp_value
$(document).on("click", ".mobile_delete_verify_button", function() {
    var APP_URL = $("#APP_URL").val();
    var otp_value = $(".mobile_delete_otp_value").val();

    if (otp_value === '') {
        alert("Enter OTP");
    } else {
        var url = APP_URL + '/delete_user_mobile';
        var data = {
            _token: "{{ csrf_token() }}",
            otp_value: otp_value
        };

        $.post(url, data, function(rdata) {
            if (rdata === 'success') {
                alert("Mobile no deleted");
                location.reload("/");
            } else {
                alert(rdata);
            }
        });
    }
});

/********************/

//resendOTP (email verification)
$(document).on("click", ".resendOTP", function() {
    var APP_URL = $("#APP_URL").val();
    var url = APP_URL + '/user_email_verify';
    var data = {
        _token: "{{ csrf_token() }}"
    };

    $.get(url, data, function(rdata) {
        if (rdata === 'success') {
            alert('Successfully sent');
        }
    });
});

/********************/

//email_verify
$(document).on("click", ".email_verify", function() {
    var APP_URL = $("#APP_URL").val();
    $('#under_processing').modal('toggle');
    var url = APP_URL + '/user_email_verify';
    var data = {
        _token: "{{ csrf_token() }}"
    };

    $.get(url, data, function(rdata) {
        if (rdata === 'success') {
            $('#under_processing').modal('hide');
            $('#email_verify_modal').modal('toggle');
        }
    });
});

/********************/

//email_verify_button
$(document).on("click", ".email_verify_button", function() {
    var APP_URL = $("#APP_URL").val();
    var otp_value = $(".otp_value").val();

    if (otp_value === '') {
        alert("Enter OTP");
    } else {
        var url = APP_URL + '/email_verify';
        var data = {
            _token: "{{ csrf_token() }}",
            otp_value: otp_value
        };

        $.post(url, data, function(rdata) {
            if (rdata === 'success') {
                alert("Email Verified");
                location.reload("/");
            } else {
                alert(rdata);
            }
        });
    }
});

/********************/

//mobile-no_verification
$(document).on("click", ".mobile_verify", function() {
    var APP_URL = $("#APP_URL").val();
    $('#under_processing').modal('toggle');
    var url = APP_URL + '/user_mobile_verify';
    var data = {
        _token: "{{ csrf_token() }}"
    };

    $.get(url, data, function(rdata) {
        if (rdata === 'success') {
            $('#under_processing').modal('hide');
            $('#mobile_verify_modal').modal('toggle');
        } else {
            alert(rdata);
        }
    });
});

/********************/

//mobile-no_verification button
$(document).on("click", ".mobile_verify_button", function() {
    var APP_URL = $("#APP_URL").val();
    var otp_value = $(".mobile_otp_value").val();

    if (otp_value === '') {
        alert("Enter OTP");
    } else {
        var url = APP_URL + '/mobile_verify';
        var data = {
            _token: "{{ csrf_token() }}",
            otp_value: otp_value
        };

        $.post(url, data, function(rdata) {
            if (rdata === 'success') {
                alert("Mobile Verified");
                location.reload("/");
            } else {
                alert(rdata);
            }
        });
    }
});

/********************/

/*resend mobile otp*/
$(document).ready(function() {
    $(".resendmobileOTP").hide(); // Hide the Resend OTP button on page load
    var timer = 30; // Initial timer value in seconds

    function updateTimer() {
        $(".resendmobileOTP").text("Resend OTP (" + timer + " secs)");
        timer--;

        if (timer < 0) {
            $(".resendmobileOTP").removeClass("disabled").text("Resend OTP");
            return;
        }

        setTimeout(updateTimer, 1000); // Update timer every second (1000 milliseconds)
    }

    // Show the Resend OTP button after 1 second (old-30000 milliseconds)
    setTimeout(function() {
        $(".resendmobileOTP").show();
        updateTimer();
    }, 1); // 1 seconds in milliseconds
});

/********************/

$(document).on("click", ".resendmobileOTP", function() {
    var APP_URL = $("#APP_URL").val();
    var url = APP_URL + '/user_mobile_verify';
    var data = {
        _token: "{{ csrf_token() }}"
    };

    // Disable the button initially
    $(".resendmobileOTP").addClass("disabled");

    var timer = 30; // Reset timer value in seconds

    function updateTimer() {
        $(".resendmobileOTP").text("Resend OTP (" + timer + " secs)");
        timer--;

        if (timer < 0) {
            $(".resendmobileOTP").removeClass("disabled").text("Resend OTP");
            return;
        }

        setTimeout(updateTimer, 1000); // Update timer every second (1000 milliseconds)
    }

    // Enable the button after 30 seconds
    setTimeout(updateTimer, 1000); // Start timer immediately

    // Make the AJAX request
    $.get(url, data, function(rdata) {
        if (rdata == 'success') {
            /*alert('Successfully sent successfully');*/
            console.log('sent');
        } else {
            alert(rdata);
        }
    });
});

/********************/

/*country-list*/
$(document).ready(function() {
    var APP_URL=$("#APP_URL").val()

    // Fetch country list
    var url=APP_URL+'/country_query_s';
    var data={
        _token:"{{ csrf_token() }}"
        };

    // Populate country dropdown in add new traveller
    $.post(url,data,function(rdata) {
        $("#passportcountry").html("").html(rdata);
        })

    //Country Code
    var url=APP_URL+'/country_code';
    var data={
        _token:"{{ csrf_token() }}"
        };

    $.post(url,data,function(rdata) {
        $("#country_code").html("").html(rdata);
        })
    });

/*$(document).ready(function() {
    var APP_URL=$("#APP_URL").val();

    // Logging APP_URL to check if it's correctly obtained
    console.log("APP_URL:", APP_URL);

    var url = APP_URL + '/country_query_s';
    var data = {_token: "{{ csrf_token() }}"};

    // Logging data to check its contents before sending the POST request
    console.log("POST data for country_query_s:", data);

    $.post(url, data, function(rdata) {
        // Logging response from the server
        console.log("Response from country_query_s:", rdata);
        $("#passportcountry").html("").html(rdata);
    });

    // Logging URL for country_code
    console.log("URL for country_code:", url);

    var url2 = APP_URL + '/country_code';
    var data2 = {_token: "{{ csrf_token() }}"};

    // Logging data for country_code
    console.log("POST data for country_code:", data2);

    $.post(url2, data2, function(rdata) {
        // Logging response from the server
        console.log("Response from country_code:", rdata);
        $("#country_code").html("").html(rdata);
    });
});*/

/********************/

/*edit traveller*/
$(document).on("click",".view_traveller_details",function() {
    var APP_URL=$("#APP_URL").val()
    var id=$(this).attr('id')
    var url=APP_URL+'/view_traveller_details';
    var data={_token:"{{ csrf_token() }}",id:id};
    $.get(url,data,function(rdata) {
      $(".edit_traveller_body").html("").html(rdata)
      $('#edittraveller').modal('toggle');
    })
});

/********************/

/*delete_traveller*/
$(document).on("click",".delete_traveller",function() {
    var APP_URL=$("#APP_URL").val()
    if(confirm("Are you sure?")) {
        var id=$(this).attr('id')
        var url=APP_URL+'/delete_user_traveller';
        var data={_token:"{{ csrf_token() }}",id:id};
        $.post(url,data,function(rdata) {
          alert('Successfully Deleted')
          location.reload('/')
        })
    }
});

/********************/

/*change password*/
document.addEventListener("DOMContentLoaded", function () {

    // Call EnableDisable() on page load
    EnableDisableChngPwd();

    // Add event listeners for input events on relevant fields
    document.getElementById("old_password").addEventListener("input", function () {
        EnableDisableChngPwd();
        });

    document.getElementById("changePswrdNew").addEventListener("input", function () {
        ValidateNewPwd();
        EnableDisableChngPwd();
        });

    document.getElementById("changePswrdConfirm").addEventListener("input", function () {
        ValidateRecnfmNewPwd();
        EnableDisableChngPwd();
        });

    // Add onclick attribute to toggleChangePswrdNew button
    var toggleChangePswrdNewButton = document.getElementById("toggleChangePswrdNew");
    if (toggleChangePswrdNewButton) {
        toggleChangePswrdNewButton.addEventListener("click", toggleChangePswrdNewVisibility);
        }

    // Add onclick attribute to togglechangePswrdConfirm button
    var togglechangePswrdConfirmButton = document.getElementById("togglechangePswrdConfirm");
    if (togglechangePswrdConfirmButton) {
        togglechangePswrdConfirmButton.addEventListener("click", togglechangePswrdConfirmVisibility);
        }

    // Add onclick attribute to submit button
    var submitButton = document.getElementById("btn-change-pwd");
    if (submitButton) {
        submitButton.addEventListener("click", function () {
            submitChngPwdForm();
            });
        }
});
    
  function ValidateNewPwd() {
    var passwordNew = document.getElementById("changePswrdNew");
    var passwordErrMsg = document.getElementById("changePswrdNewErrorMessage");
    var trimmedPasswordNew = passwordNew.value.trim();
    var oldPassword = document.getElementById("old_password").value.trim();

    if (trimmedPasswordNew === "") {
      passwordErrMsg.textContent = "";
      return false;
    } else if (trimmedPasswordNew === oldPassword) {
      passwordErrMsg.textContent = "New password should not be the same as the old password";
      passwordErrMsg.style.color = "red";
      passwordNew.style.borderColor = "red";
      return false;
    } else if (trimmedPasswordNew.length >= 6) {
      passwordErrMsg.textContent = "";
      passwordErrMsg.style.color = "green";
      passwordNew.style.borderColor = "green";
      return true;
    } else {
      passwordErrMsg.textContent = "Password should be at least 6 characters long";
      passwordErrMsg.style.color = "red";
      passwordNew.style.borderColor = "red";
      return false;
    }
  }

  // Validate reconfirmed password
  function ValidateRecnfmNewPwd() {
    var passwordNew = document.getElementById("changePswrdNew");
    var pwdNewReConfm = document.getElementById("changePswrdConfirm");
    var pwdNewReConfmErrMsg = document.getElementById("changePswrdConfirmErrorMessage");

    if (pwdNewReConfm.value.trim() === "") {
      pwdNewReConfmErrMsg.textContent = "";
      return false;
    } else if (pwdNewReConfm.value.trim() === passwordNew.value.trim()) {
      pwdNewReConfmErrMsg.textContent = "Password matched";
      pwdNewReConfmErrMsg.style.color = "green";
      passwordNew.style.borderColor = "green";
      pwdNewReConfm.style.borderColor = "green";
      return true;
    } else {
      pwdNewReConfmErrMsg.textContent = "Password does not match";
      pwdNewReConfmErrMsg.style.color = "red";
      passwordNew.style.borderColor = "red";
      pwdNewReConfm.style.borderColor = "red";
      return false;
    }
  }

  // Toggle visibility of changePswrdNew field
  function toggleChangePswrdNewVisibility() {
    var changePswrdNewInput = document.getElementById("changePswrdNew");
    var eyeIcon = document.getElementById("eyeIconNewPwd");

    if (changePswrdNewInput.type === "password") {
      changePswrdNewInput.type = "text";
      eyeIcon.classList.remove("fa-eye");
      eyeIcon.classList.add("fa-eye-slash");
    } else {
      changePswrdNewInput.type = "password";
      eyeIcon.classList.remove("fa-eye-slash");
      eyeIcon.classList.add("fa-eye");
    }
  }

  // Toggle visibility of changePswrdConfirm field
  function togglechangePswrdConfirmVisibility() {
    var passwordConfirmInput = document.getElementById("changePswrdConfirm");
    var eyeIconReconfirm = document.getElementById("eyeIconReconfmPwd");

    if (passwordConfirmInput.type === "password") {
      passwordConfirmInput.type = "text";
      eyeIconReconfirm.classList.remove("fa-eye");
      eyeIconReconfirm.classList.add("fa-eye-slash");
    } else {
      passwordConfirmInput.type = "password";
      eyeIconReconfirm.classList.remove("fa-eye-slash");
      eyeIconReconfirm.classList.add("fa-eye");
    }
  }

  // Enable or disable submit button based on input field validity
  function EnableDisableChngPwd() {
    var oldPasswordNotEmpty = document.getElementById("old_password").value.trim() !== "";
    var passwordNotEmpty = document.getElementById("changePswrdNew").value.trim() !== "";
    var passwordValid = ValidateNewPwd();
    var reconfirmPasswordValid = ValidateRecnfmNewPwd();

    var submitButton = document.getElementById("btn-change-pwd");

    if (oldPasswordNotEmpty && passwordNotEmpty && passwordValid && reconfirmPasswordValid) {
      submitButton.disabled = false;
      submitButton.classList.remove("disabled");
    } else {
      submitButton.disabled = true;
      submitButton.classList.add("disabled");
    }
  }

  // Function to submit form
  function submitChngPwdForm() {
    // Reference the form by its ID
    var chngPwdForm = document.getElementById("passwordChangeForm");

    // Your existing validation logic here
    var oldPasswordNotEmpty = document.getElementById("old_password").value.trim() !== "";
    var passwordNotEmpty = document.getElementById("changePswrdNew").value.trim() !== "";
    var passwordValid = ValidateNewPwd();
    var reconfirmPasswordValid = ValidateRecnfmNewPwd();

    if (oldPasswordNotEmpty && passwordNotEmpty && passwordValid && reconfirmPasswordValid) {
      // Trigger Swal message for successful password change
      Swal.fire ({
        icon: 'success',
        title: 'You have successfully changed a new password.',
        showConfirmButton: false,
      }).then((result) => {
        if (result.isConfirmed) {
          // Reset the form
          chngPwdForm.reset();
        }
        });
    } else {
      // Trigger Swal message for incorrect old password or invalid inputs
      Swal.fire ({
        icon: 'error',
        title: 'Password change failed',
        text: 'Please check old password and try again.',
        showConfirmButton: false,
        });
    }
  }

/********************/

// add new traveller
$(document).ready(function() {
  $('#addtraveller').on('shown.bs.modal', function () {

    // Get all sidebar links
    const scrollLinks = document.querySelectorAll('#addtraveller .scrollLink');
    const scrollItems = document.querySelectorAll('#addtraveller .scrollItem');

    // Add click event listener to each sidebar link
    scrollLinks.forEach(function(link, index) {
      link.addEventListener('click', function(event) {
        // Prevent default link behavior
        event.preventDefault();

        // Remove active class from all sidebar items
        scrollItems.forEach(function(item) {
          item.classList.remove('active');
        });

        // Add active class to the clicked sidebar item
        scrollItems[index].classList.add('active');

        // Get the target section ID from href attribute
        const targetId = this.getAttribute('href').substring(1); // Remove the '#' from href

        // Get the target element by ID
        const targetElement = document.getElementById(targetId);

        /*// Check if the target element exists
        if (targetElement) {
          // Calculate the scroll position with an offset of 20px
          const offset = targetElement.getBoundingClientRect().top - 10;

          // Scroll to the target position with smooth behavior
          window.scrollTo({
            top: window.pageYOffset + offset,
            behavior: 'smooth'
          });
        }*/
        // Use jQuery's animate function to smoothly scroll to the target element
          $('html, body').animate({
            scrollTop: $("#" + targetId).offset().top
          }, 1000);
      });
    });

    // Get reference to the date of birth input field
    var dobInput = document.querySelector("input[name='dob']");

    // Add event listener to the date of birth input field
    dobInput.addEventListener("change", function() {
      var selectedDate = new Date(dobInput.value);
      var currentDate = new Date();

      // Set the time of currentDate to the start of the day
      currentDate.setHours(0, 0, 0, 0);

      if (selectedDate > currentDate) {
        alert("Birthday cannot be greater than today's date");
        dobInput.value = "";
      }
    });

    // Get reference to the passport number input field
    var psptnumber = document.getElementById("passportnumber");

    // Get references to other input fields
    var psptcountry = document.getElementById("passportcountry");
    var psptexpirydate = document.getElementById("passportexpirydate");
    var validpsptmsg = document.getElementById("validpassport");

    // Define the regex for passport number validation
    var regex = /^[a-zA-Z0-9]{6,9}$/; // accepts 6-9 alphanumeric characters

    // Add event listener to the passport number input field
    psptnumber.addEventListener("keyup", function() {
      if (psptnumber.value.trim() !== "" && regex.test(psptnumber.value)) {
        enableFields();
      } else {
        disableFields();
        if (psptnumber.value.trim() !== "") {
          validpsptmsg.innerHTML = 'Please enter a valid passport number';
          validpsptmsg.style.color = 'red';
          psptnumber.style.borderColor = 'red';
        }
      }
    });

    // Function to enable fields
    function enableFields() {
      psptcountry.disabled = false;
      psptexpirydate.disabled = false;

      // Style the input fields and validation message for visual indication
      psptnumber.style.borderColor = 'green';
      psptcountry.style.borderColor = 'green';
      psptexpirydate.style.borderColor = 'green';
      validpsptmsg.innerHTML = '';
    }

    // Function to disable fields
    function disableFields() {
      psptcountry.disabled = true;
      psptexpirydate.disabled = true;

      // Reset styling
      psptcountry.style.borderColor = '';
      psptexpirydate.style.borderColor = '';
    }

    // Add event listener to the passport expiry date input field
    psptexpirydate.addEventListener("change", function() {
      var selectedDate = new Date(psptexpirydate.value);
      var currentDate = new Date();
      currentDate.setFullYear(currentDate.getFullYear() + 10);

      if (selectedDate > currentDate) {
        alert("Expiry date cannot be greater than 10 years from the current date");
        psptexpirydate.value = "";
      }
    });
  });
});


/*----------------------------*/

//edit traveller
$('#edittraveller').on('shown.bs.modal', function () {

  // Get reference to the date of birth input field
  var dobInput = document.getElementById("dob");

  // Add event listener to the date of birth input field
  dobInput.addEventListener("change", function() {
    var selectedDate = new Date(dobInput.value);
    var currentDate = new Date();

    // Set the time of currentDate to the start of the day
    currentDate.setHours(0, 0, 0, 0);

    if (selectedDate > currentDate) {
      alert("Birthday cannot be greater than today's date");
      dobInput.value = "";
    }
  });

  // Get reference to the passport number input field
  var psptnumber = document.getElementById("passportnumberedit");

  // Get references to other input fields
  var psptcountry = document.getElementById("passportcountryedit");
  var psptexpirydate = document.getElementById("passportexpirydateedit");
  var validpsptmsg = document.getElementById("validpassportedit");

  // Define the regex for passport number validation
  var regex = /^[a-zA-Z0-9]{6,9}$/; // accepts 6-9 alphanumeric characters

  // Add event listener to the passport number input field
  psptnumber.addEventListener("input", function() {
    if (psptnumber.value.trim() !== "" && regex.test(psptnumber.value)) {
      enableFields();
    } else {
      disableFields();
    }
  });

  // Function to enable fields
  function enableFields() {
    psptcountry.disabled = false;
    psptexpirydate.disabled = false;

    // Style the input fields and validation message for visual indication
    psptnumber.style.borderColor = 'green';
    psptcountry.style.borderColor = 'green';
    psptexpirydate.style.borderColor = 'green';
    validpsptmsg.innerHTML = '';
  }

  // Function to disable fields
  function disableFields() {
    psptcountry.disabled = true;
    psptexpirydate.disabled = true;

    // Reset styling and validation message
    validpsptmsg.innerHTML = 'Please enter a valid passport number';
    validpsptmsg.style.color = 'red';
    psptnumber.style.borderColor = 'red';
    psptcountry.style.borderColor = '';
    psptexpirydate.style.borderColor = '';
  }

  // Add event listener to the passport expiry date input field
  psptexpirydate.addEventListener("change", function() {
    var selectedDate = new Date(psptexpirydate.value);
    var currentDate = new Date();
    currentDate.setFullYear(currentDate.getFullYear() + 10);

    if (selectedDate > currentDate) {
      alert("Expiry date cannot be greater than 10 years from the current date");
      psptexpirydate.value = "";
    }
  });

  // Initial check
  if (psptnumber.value.trim() === "" || !regex.test(psptnumber.value)) {
    disableFields();
  }
});

/*******************************/
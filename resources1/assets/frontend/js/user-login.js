/*user login and signup*/

/*<!-- ------------------------------------------------------------------- -->*/

/*<!-- Guest Email Login Validation Script-->*/

    /*<!-- Option-II -->*/
    // Combined function
    document.addEventListener("DOMContentLoaded", function () {
        // Initial call to set the button state based on the input values
        userLoginValidation();

        // Add event listeners for input events
        document.getElementById("login_email").addEventListener("input", userLoginValidation);
        document.getElementById("password").addEventListener("keyup", userLoginValidation);

        // Add onclick attribute to togglePassword button
        var toggleLoginPasswordButton = document.getElementById("toggleLoginPassword");
        if (toggleLoginPasswordButton) {
            toggleLoginPasswordButton.addEventListener("click", toggleLoginPasswordVisibility);
            }
        });

        function toggleLoginPasswordVisibility() {
            var loginPasswordInput = document.getElementById("password");
            var showEyeIcon = document.getElementById("showEyeIcon");

            if (loginPasswordInput.type === "password") {
                loginPasswordInput.type = "text";
                showEyeIcon.classList.remove("fa-eye");
                showEyeIcon.classList.add("fa-eye-slash");
                } else {
                loginPasswordInput.type = "password";
                showEyeIcon.classList.remove("fa-eye-slash");
                showEyeIcon.classList.add("fa-eye");
                }
        }

        function userLoginValidation() {
            var registeredEmail = document.getElementById("login_email");
            var loginPassword = document.getElementById("password");
            var btnUserLogin = document.getElementById("btnSubmit");
            var emailErrorMessage = document.getElementById("emailErrorMessage");
            var inputEmailField = document.querySelector('.innerField');
            var inputEmailErrorIcon = document.querySelector("#error-icon");

            var loginPasswordErrorMessage = document.getElementById("loginPasswordErrorMessage");
            var loginPasswordField = document.querySelector('.innerField-login-password');

            // Email validation using a simple regex pattern
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (registeredEmail.value.trim() === "") {
                // Clear error message and remove error class if the field is empty
                emailErrorMessage.textContent = "";
                inputEmailField.classList.remove("error");
                inputEmailErrorIcon.classList.remove("error-icon");
                } else if (emailRegex.test(registeredEmail.value.trim())) {
                // Clear error message and remove error class if email is valid
                emailErrorMessage.textContent = "";
                inputEmailField.classList.remove("error");
                inputEmailErrorIcon.classList.remove("error-icon");
                } else {
                // Display error message and add error class for invalid email
                emailErrorMessage.textContent = "Please enter a valid Email id";
                inputEmailField.classList.add("error");
                inputEmailErrorIcon.classList.add("error-icon");
                }

            // Login Password Check
            var trimmedPassword = loginPassword.value.trim();

            if (trimmedPassword === "") {
                loginPasswordErrorMessage.textContent = "";
                loginPasswordField.classList.remove("error");
                } else if (trimmedPassword.length >= 6) {
                loginPasswordErrorMessage.textContent = "";
                loginPasswordField.classList.remove("error");
                } else {
                loginPasswordErrorMessage.textContent = "Password should be at least 6 characters long";
                loginPasswordField.classList.add("error");
                }

            // Check if email and loginPassword are non-empty
            var isEmailValid = registeredEmail.value.trim() !== "" && emailRegex.test(registeredEmail.value.trim());
            var isPasswordValid = trimmedPassword.length >= 6;

            // Enable or disable the submit button based on input states
            btnUserLogin.disabled = !(isEmailValid && isPasswordValid);
            btnUserLogin.classList.toggle("disabled", !isEmailValid || !isPasswordValid);
        }

    // user login form submission
    document.getElementById("btnSubmit").addEventListener("click", function () {
        // added for processing
        var btnUserLogin = document.getElementById("btnSubmit");
                
        // Change button text to "Processing..."
        btnUserLogin.innerHTML = "Processing...";

        // Disable the reset password button to prevent multiple submissions
        btnUserLogin.disabled = true;

        // Simulate asynchronous operation (replace with actual form submission logic)
         // alert('dd')

        setTimeout(function () {
            var form_data = new FormData($("#login_customer")[0]);
            var APP_URL=$("#APP_URL").val();
            $.ajax ({
                url:APP_URL+'/login-customer',
                data:form_data,
                type:'post',
                contentType: false,
                processData: false,
                success:function(data) {
                    btnUserLogin.innerHTML = 'Submit';
                    if(data=='admin') {
                        swal ({
                            title: "Welcome !",
                            text: "Please wait... you will auto redirect to dashboard",
                            type: "success",
                            timer: 3000
                            });
                            setTimeout(function() {
                            window.location.href = APP_URL+'/dashboard';
                            }, 3000);
                        } else if(data=='user') {
                            swal({
                            title: "Welcome !",
                            text: "Login successful",
                            type: "success",
                            timer: 3000
                            });
                            setTimeout(function() {
                                window.location.reload(1);
                                }, 3000);
                            } else {
                                const list = document.getElementById("btnSubmit").classList;
                                list.add("disabled");
                                swal({
                                title: "Oops!",
                                text: data,
                                type: 'error',
                                timer: 1000
                                });
                                // location.reload()
                                }
                    },
                    error:function(data)
                    {
                    }
                })
            }, 2000); // Adjust the time delay (in milliseconds) as needed
        });

/*<!-- ------------------------------------------------------------------- -->*/

/*<!-- login with OTP Script -->*/

    //login with OTP - Combined function
    document.addEventListener("DOMContentLoaded", function () {
        // Initial call to set the button state based on the input values
        loginViaOTPValidation();

        // Add event listeners for input events
        document.getElementById("login_email").addEventListener("input", loginViaOTPValidation);

        //login with OTP
        $(document).on("click","#login_with_otp", function(e) {

            e.preventDefault();

            var login_email=$("#login_email").val()
            
            if(login_email=='') {
                swal("", 'Enter valid email id', "error");
                } else {
                    $('#user-login').modal('hide');
                    var APP_URL=$("#APP_URL").val()
                    // $('#under_processing').modal('toggle');
                    $('#otp_login_modal').modal('toggle');
                    timer(120);
                    var url=APP_URL+'/send_login_otp';
                    var data={_token:"{{ csrf_token() }}",login_email:login_email};
                    $.get(url,data,function(rdata) {
                        if(rdata=='success') {
                            // $('#under_processing').modal('hide');
                            // swal("Done !", 'OTP successfully sent to your Email & Mobile No.', "success");
                            } else {
                                swal("Error", rdata, "error");
                                }
                        })
                    }
            });
        });

        function loginViaOTPValidation() {
            var registeredEmail = document.getElementById("login_email");
            var btnlogin_with_otp = document.getElementById("login_with_otp");
            var emailErrorMessage = document.getElementById("emailErrorMessage");
            var inputEmailField = document.querySelector('.innerField');
            var inputEmailErrorIcon = document.querySelector("#error-icon");

            // Email validation using a simple regex pattern
            var emailRegex = /^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/;

            if (registeredEmail.value.trim() === "") {
                // Clear error message and remove error class if the field is empty
                emailErrorMessage.textContent = "";
                inputEmailField.classList.remove("error");
                inputEmailErrorIcon.classList.remove("error-icon");
                } 
                else if (emailRegex.test(registeredEmail.value.trim())) {
                // Clear error message and remove error class if email is valid
                emailErrorMessage.textContent = "";
                inputEmailField.classList.remove("error");
                inputEmailErrorIcon.classList.remove("error-icon");
                } else {
                // Display error message and add error class for invalid email
                emailErrorMessage.textContent = "Please enter a valid Email id";
                inputEmailField.classList.add("error");
                inputEmailErrorIcon.classList.add("error-icon");
                }

            // Check if email is non-empty
            var isEmailValid = registeredEmail.value.trim() !== "" && emailRegex.test(registeredEmail.value.trim());

            // Enable or disable the login via OTP button based on input states
            btnlogin_with_otp.disabled = !(isEmailValid);
            btnlogin_with_otp.classList.toggle("disabled", !isEmailValid);
            }

/*<!-- ------------------------------------------------------------------- -->*/

/*<!-- Enter OTP Validation Script (Login with OTP) -->*/

    //Combined function
    document.addEventListener("DOMContentLoaded", function () {
        // Initial call to set the button state based on the input values
        enterOTPValidation();

        // Add event listeners for input events
        document.getElementById("login_otp_value").addEventListener("input", enterOTPValidation);

        // Clear the input field when the page loads (check, not working here)
        document.getElementById("login_otp_value").value = '';

        // Event listener for OTP login form submission
        $(document).on("click", "#otp_login", function () {

            // added for processing
            var btn_otp_login = $("#otp_login");
            
            // Change button text to "Processing..."
            btn_otp_login.html("Processing...");

            // Disable the login button to prevent multiple submissions
            btn_otp_login.prop("disabled", true);

            var APP_URL = $("#APP_URL").val()
            var otp_value = $("#login_otp_value").val()

            if (otp_value == '') {
                swal("Oops", 'Enter OTP', "error");
                // Restore button text after submission
                btn_otp_login.html('Submit');
                // Re-enable the login button
                btn_otp_login.prop("disabled", false);
                } else {
                    var url = APP_URL + '/login_with_otp';
                    var data = {
                        _token: "{{ csrf_token() }}",
                        otp_value: otp_value
                        };
                    $.get(url, data, function (rdata) {
                        if (rdata == 'success') {
                            swal("Done !", 'successfully login', "success");
                            location.reload("/")
                            } else {
                                swal("Error", rdata, "error");
                                }

                        // Restore button text after submission
                        btn_otp_login.html('Submit');
                        // Re-enable the login button
                        btn_otp_login.prop("disabled", false);
                    })
                }
            });
        });

        // OTP Validation
        function enterOTPValidation() {
            var enterOTP = document.getElementById("login_otp_value");
            var btn_otp_login = document.getElementById("otp_login");
            var otpErrorMessage = document.getElementById("otpErrorMessage");
            var inputOTPField = document.querySelector('.innerField-enter-otp');
            var otpLength = enterOTP.value.trim();
            
            if (otpLength === "") {
                otpErrorMessage.textContent = "";
                inputOTPField.classList.remove("error");
                btn_otp_login.disabled = true;
                btn_otp_login.classList.add("disabled");
                return false;
                } else if (otpLength.length === 5) {
                    otpErrorMessage.textContent = "";
                    inputOTPField.classList.remove("error");
                    btn_otp_login.disabled = false;
                    btn_otp_login.classList.remove("disabled");
                    return true;
                } else {
                    otpErrorMessage.textContent = "Please enter a valid OTP";
                    inputOTPField.classList.add("error");
                    btn_otp_login.disabled = true;
                    btn_otp_login.classList.add("disabled");
                    return false;
                }

            // Check if email and loginPassword are non-empty
            var isOTPValid = enterOTP.value.trim() !== "";

            // Enable or disable the submit button based on input states
            btn_otp_login.disabled = !(isOTPValid);
            btn_otp_login.classList.toggle("disabled", !isOTPValid);
        }

/*<!-- ------------------------------------------------------------------- -->*/

/*<!-- Reset Password Validation Script-->*/

    // Combined function
    document.addEventListener("DOMContentLoaded", function () {
        // Initial call to set the button state based on the input values
        emailPasswordReset();

        // Add event listeners for input events
        document.getElementById("email-pwd-reset").addEventListener("input", emailPasswordReset);

        // Event listener for email password reset form submission
        document.getElementById("btn-email-pwd-reset").addEventListener("click", function () {
            // added for processing
            var btnResetPwd = document.getElementById("btn-email-pwd-reset");

            // Change button text to "Processing..."
            btnResetPwd.innerHTML = "Processing...";

            // Disable the reset password button to prevent multiple submissions
            btnResetPwd.disabled = true;

            // Simulate asynchronous operation (replace with actual form submission logic)
            setTimeout(function () {
                var form_data = new FormData($("#forget_password_form")[0]);
                var APP_URL=$("#APP_URL").val();
                $.ajax ({
                    url:APP_URL+'/Password-Forget',
                    data:form_data,
                    type:'post',
                    contentType: false,
                    processData: false,
                    success:function(data) {
                    btnResetPwd.innerHTMLL = 'Submit';
                    if(data=='success') {
                        swal ({
                            title: "Welcome!",
                            text: "Password reset instructions sent successfully, please check you email",
                            type: "success",
                            timer: 3000
                            });
                            setTimeout(function(){
                            window.location.reload(1);
                            }, 3000);
                        } else {
                            const list = document.getElementById("btn-email-pwd-reset").classList;
                            list.add("disabled");
                            swal ({
                                title: "Oops!",
                                text: data,
                                type: 'error',
                                timer: 1000
                                });
                            // location.reload()
                            }
                    },
                    error:function(data)
                    {
                    }
                    })
                //
                }, 2000); // Adjust the time delay (in milliseconds) as needed
            });
        });

    function emailPasswordReset() {
        var registeredEmailPwdReset = document.getElementById("email-pwd-reset");
        var btnResetPwd = document.getElementById("btn-email-pwd-reset");
        var resetEmailPwdErrorMessage = document.getElementById("reset-email-pwd-error-message");
        var emailFieldPwdReset = document.querySelector('.innerField-pwd-reset');
        
        // Email validation using a simple regex pattern
        var emailRegex = /^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/;

        if (registeredEmailPwdReset.value.trim() === "") {
            // Clear error message and remove error class if the field is empty
            resetEmailPwdErrorMessage.textContent = "";
            emailFieldPwdReset.classList.remove("error");
            }
            else if (emailRegex.test(registeredEmailPwdReset.value.trim())) {
            // Clear error message and remove error class if email is valid
            resetEmailPwdErrorMessage.textContent = "";
            emailFieldPwdReset.classList.remove("error");
            }
            else {
            // Display error message and add error class for invalid email
            resetEmailPwdErrorMessage.textContent = "Enter a valid email id";
            emailFieldPwdReset.classList.add("error");
            }

        // Check if email and password are non-empty
        var isEmailValid = registeredEmailPwdReset.value.trim() !== "" && emailRegex.test(registeredEmailPwdReset.value.trim());

        // Enable or disable the submit button based on input states
        btnResetPwd.disabled = !(isEmailValid);
        btnResetPwd.classList.toggle("disabled", !isEmailValid);
        }

/*<!-- ------------------------------------------------------------------- -->*/

/*<!-- Email Signup Validation Script -->*/

    //Separate Functions
    document.addEventListener("DOMContentLoaded", function () {
        // Add the event listeners for the oninput events
        document.getElementById("firstName").addEventListener("input", function () {
            ValidateFirstName();
            checkLastNameDifferent();
            EnableDisable();
            });

        document.getElementById("last_name").addEventListener("input", function () {
            ValidateLastName();
            checkLastNameDifferent();
            EnableDisable();
            });

        document.getElementById("signupEmail").addEventListener("input", function () {
            ValidateEmail();
            EnableDisable();
            });

        document.getElementById("signupPassword").addEventListener("keyup", function () {
            ValidatePassword();
            EnableDisable();
            });

        document.getElementById("password2").addEventListener("input", function () {
            ValidateReconfirmPassword();
            EnableDisable();
            });

        // Add onclick attribute to togglePassword button
        var togglePasswordButton = document.getElementById("togglePassword");
            if (togglePasswordButton) {
                togglePasswordButton.addEventListener("click", togglePasswordVisibility);
                }

        // Add onclick attribute to togglePassword2 button
        var togglePassword2Button = document.getElementById("togglePassword2");
            if (togglePassword2Button) {
                togglePassword2Button.addEventListener("click", togglePassword2Visibility);
                }
            
        document.getElementById("signupAcceptance").addEventListener("change", function () {
            EnableDisable();
            });
        
        // user registration
        $(document).on("submit", "#register-customer", function (event) {
            
            event.preventDefault();

            // Show processing modal
            $('#under_processing').modal('show'); // under processing modal

                // Change submit button text to "Processing"
                var btnEmailSignup = document.getElementById("btnEmailSignup");
                btnEmailSignup.innerHTML = 'Processing...';

                // Disable the reset password button to prevent multiple submissions
                btnEmailSignup.disabled = true;

                var form_data = new FormData($("#register-customer")[0]);
                var APP_URL = $("#APP_URL").val();
                $.ajax({
                    url: APP_URL + '/register-customer',
                    data: form_data,
                    type: 'post',
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        if (data == 'success') {
                            $('#under_processing').modal('hide'); // under processing modal
                            $('#user-signup').modal('hide');
                            $('#otp_signup_modal').modal('show');
                            } else {
                                swal("Oops!", data, "error");
                                }
                        },
                        error: function (data) {
                            swal("Oops!", "Something went wrong!", "error");
                            },
                        complete: function () {
                            // Reset button text to "Sign Up" after a delay
                            setTimeout(function () {
                                btnEmailSignup.innerHTML = 'Sign Up';
                                btnEmailSignup.disabled = false;
                                }, 1000); // Change the delay as needed (in milliseconds)
                            }
                    })
            });
            
        });

        function ValidateFirstName() {
            var firstName = document.getElementById("firstName");
            var firstNameErrorMessage = document.getElementById("firstNameErrorMessage");
            var firstNameField = document.querySelector('.innerField-signup-firstName');

            var trimmedFirstName = firstName.value.trim();

            // First name validation using a simple regex pattern
            /*var nameRegex = /^[A-Za-z]+(?:\s[A-Za-z]+)?$/;*/
            var firstNameRegex = /^[A-Za-z]+(?:\s[A-Za-z]+)?$/;

            if (trimmedFirstName === "") {
                firstNameErrorMessage.textContent = "";
                firstNameField.classList.remove("error");
                return false;
                } else if (firstNameRegex.test(trimmedFirstName) && trimmedFirstName.length >= 3) {
                firstNameErrorMessage.textContent = "";
                firstNameField.classList.remove("error");
                return true;
                } else {
                firstNameErrorMessage.textContent = "Enter a valid name";
                firstNameField.classList.add("error");
                return false;
                }
            }

        function ValidateLastName() {
            var lastName = document.getElementById("last_name");
            var lastNameErrorMessage = document.getElementById("lastNameErrorMessage");
            var lastNameField = document.querySelector('.innerField-signup-lastName');

            var trimmedLastName = lastName.value.trim();

            // Last name validation using a simple regex pattern
            var lastNameRegex = /^[A-Za-z]+$/;

            if (trimmedLastName === "") {
                lastNameErrorMessage.textContent = "";
                lastNameField.classList.remove("error");
                return false;
                } else if (lastNameRegex.test(trimmedLastName) && trimmedLastName.length >= 3) {
                lastNameErrorMessage.textContent = "";
                lastNameField.classList.remove("error");
                return true;
                } else {
                lastNameErrorMessage.textContent = "Enter a valid last name";
                lastNameField.classList.add("error");
                return false;
                }
            }

        // check if first name and last name are different
        function checkLastNameDifferent() {
            var firstName = document.getElementById("firstName").value.trim();
            var lastName = document.getElementById("last_name").value.trim();
            var sameNameErrorMessage = document.getElementById("sameNameErrorMessage");
            var lastNameField = document.querySelector('.innerField-signup-lastName');

            // Check for spaces in the last name
            if (/\s/.test(lastName)) {
                sameNameErrorMessage.textContent = "";
                lastNameField.classList.add("error");
                return false;
                }

            if (firstName === "" || lastName === "") {
                // Clear error message and remove error class if either field is blank
                sameNameErrorMessage.textContent = "";
                lastNameField.classList.remove("error");
                return false;
                } else if (firstName === lastName) {
                // Display error message and add error class for identical first and last names
                sameNameErrorMessage.textContent = "First Name and Last Name should be different";
                lastNameField.classList.add("error");
                return false;
                } else {
                // Clear error message and remove error class if names are different
                sameNameErrorMessage.textContent = "";
                lastNameField.classList.remove("error");
                return true;
                }
            }

        // Separate email validation function
        function ValidateEmail() {
            var signupEmail = document.getElementById("signupEmail");
            var emailErrorMessage = document.getElementById("signupEmailErrorMessage");
            var emailField = document.querySelector('.innerField-signup');

            // Email validation using a simple regex pattern
            var emailRegex = /^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/;
            /*var emailRegex = /^[^\s@,:;{}/*<>?$%&()=+!`~^#]+@[^\s@,:;{}/*<>?$%&()=+!`~^#]+\.[^\s@,:;{}/*<>?$%&()=+!`~.^#]+$/;*/
            /*var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;*/

            if (signupEmail.value.trim() === "") {
                // Clear error message and remove error class if the field is empty
                emailErrorMessage.textContent = "";
                emailField.classList.remove("error");
                return false;
                } else if (emailRegex.test(signupEmail.value.trim())) {
                // Clear error message and remove error class if email is valid
                emailErrorMessage.textContent = "";
                emailField.classList.remove("error");
                return true;
                } else {
                // Display error message and add error class for invalid email
                emailErrorMessage.textContent = "Enter valid email id";
                emailField.classList.add("error");
                return false;
                }
            }

        // Password
        function ValidatePassword() {
            var password = document.getElementById("signupPassword");
            var signupPasswordErrorMessage = document.getElementById("signupPasswordErrorMessage");
            var signupPasswordField = document.querySelector('.innerField-signup-password');

            var trimmedPassword = password.value.trim();

            if (trimmedPassword === "") {
                signupPasswordErrorMessage.textContent = "";
                signupPasswordField.classList.remove("error");
                return false;
                } else if (trimmedPassword.length >= 6) {
                signupPasswordErrorMessage.textContent = "";
                signupPasswordField.classList.remove("error");
                return true;
                } else {
                signupPasswordErrorMessage.textContent = "Password should be at least 6 characters long";
                signupPasswordField.classList.add("error");
                return false;
                }
            }

        //Reconfirm Password
        function ValidateReconfirmPassword() {
            var signupPassword = document.getElementById("signupPassword");
            var reconfirmPassword = document.getElementById("password2");
            var password2ErrorMessage = document.getElementById("password2ErrorMessage");
            var signupReconfirmPasswordField = document.querySelector('.innerField-signup-password2');

            if (reconfirmPassword.value.trim() === "") {
                password2ErrorMessage.textContent = "";
                /*signupReconfirmPasswordField.classList.remove("error");*/
                return false;
                } else if (reconfirmPassword.value.trim() === signupPassword.value.trim()) {
                password2ErrorMessage.textContent = "";
                signupReconfirmPasswordField.classList.remove("error");
                return true;
                } else {
                password2ErrorMessage.textContent = "Password does not match";
                signupReconfirmPasswordField.classList.add("error");
                return false;
                }
            }

        // show password
        function togglePasswordVisibility() {
            var signupPasswordInput = document.getElementById("signupPassword");
            var eyeIcon = document.getElementById("eyeIcon");

            if (signupPasswordInput.type === "password") {
                signupPasswordInput.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
                } else {
                signupPasswordInput.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
                }
            }

        // show password2
        function togglePassword2Visibility() {
            var passwordConfirmInput = document.getElementById("password2");
            var eyeIconReconfirm = document.getElementById("eyeIconReconfirm");

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

        function EnableDisable() {
            var isFirstNameValidSignup = ValidateFirstName();
            var isLastNameValidSignup = ValidateLastName();
            var isLastNameDifferentSignup = checkLastNameDifferent();
            var isEmailValidSignup = ValidateEmail();
            var isPasswordNotEmptySignup = document.getElementById("signupPassword").value.trim() !== "";
            var isPasswordValidSignup = ValidatePassword();
            var isReconfirmPasswordValidSignup = ValidateReconfirmPassword();
            var isAgreeCheckedSignup = document.getElementById("signupAcceptance").checked;

            var btnEmailSignup = document.getElementById("btnEmailSignup");

            if (isFirstNameValidSignup && isLastNameValidSignup && isLastNameDifferentSignup && isEmailValidSignup && isPasswordNotEmptySignup && isPasswordValidSignup && isReconfirmPasswordValidSignup && isAgreeCheckedSignup) {
                btnEmailSignup.disabled = false;
                btnEmailSignup.classList.remove("disabled");
                } else {
                    btnEmailSignup.disabled = true;
                    btnEmailSignup.classList.add("disabled");
                    }
            }

        /*function submitForm() {
            // Reference the form by its ID
            var form = document.getElementById("register-customer");

            // Your existing validation logic here
            var isFirstNameValid = ValidateFirstName();
            var isLastNameValid = ValidateLastName();
            var isLastNameDifferent = checkLastNameDifferent();
            var isEmailValid = ValidateEmail();
            var isPasswordNotEmpty = document.getElementById("password").value.trim() !== "";
            var isReconfirmPasswordValid = ValidateReconfirmPassword();
            var isAgreeChecked = document.getElementById("signupAcceptance").checked;

            if (isFirstNameValid && isLastNameValid && isLastNameDifferent && isEmailValid && isPasswordNotEmpty && isPasswordValid && isReconfirmPasswordValid && isAgreeChecked) {
                // Trigger Swal message
                Swal.fire({
                    icon: 'success',
                    title: 'Form Submitted Successfully!',
                    //showConfirmButton: false,
                    //timer: 1500
                    showConfirmButton: true, // Display the "OK" button
                    confirmButtonText: 'OK', // Text for the "OK" button
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Reset the form
                            form.reset();
                            }
                        });

                // You can optionally add logic here to submit the form to the server or take other actions
                } else {
                // You can optionally add logic here for handling unsuccessful form submission
                }
            }*/

/*<!-- ------------------------------------------------------------------- -->*/

// Email Signup OTP verification process
$(document).on("click","#otp_signup", function() {

    var APP_URL=$("#APP_URL").val()
    var otp_value=$("#signup_otp_value").val()

    if(otp_value=='') {
        swal("Error", 'Enter OTP', "error");
        } else {
            var url=APP_URL+'/signup_with_otp';
            var data={_token:"{{ csrf_token() }}",otp_value:otp_value};
            $.post(url,data,function(rdata) {
                if(rdata=='success') {
                    swal("Welcome!", 'You have been Successfully registered', "success");
                    location.reload("/")
                    } else {
                        swal("Error", rdata, "error");
                        }
                })
            }
    })

/*<!-- ------------------------------------------------------------------- -->*/

// OTP Timer
let timerOn = true;
function timer(remaining) {
    var m = Math.floor(remaining / 60);
    var s = remaining % 60;

    m = m < 10 ? '0' + m : m;
    s = s < 10 ? '0' + s : s;
    document.getElementById('timer').innerHTML = m + ':' + s;
    remaining -= 1;

    if(remaining >= 0 && timerOn) {
        setTimeout(function() {
        timer(remaining);
        }, 1000);
        return;
        }

    if(!timerOn) {
        // Do validate stuff here
        return;
        }

    // Do timeout stuff here
    // alert('Timeout for otp');
    document.getElementById('timer').innerHTML = '<span class="resendOTP">Resend OTP</span>';
    }

// resend OTP
$(document).on("click",".resendOTP", function(e) {
    
    e.preventDefault();

    var login_email=$("#login_email").val()

    if(login_email=='') {
        swal("Error", 'Enter valid email-id', "error");
        } else {
            var APP_URL=$("#APP_URL").val()
            // $('#under_processing').modal('toggle');
            // $('#otp_login_modal').modal('toggle');
            timer(120);
            var url=APP_URL+'/send_login_otp';
            var data={_token:"{{ csrf_token() }}",login_email:login_email};
            $.get(url,data,function(rdata) {
                if(rdata=='success') {
                    // $('#under_processing').modal('hide');
                    // $('#otp_login_modal').modal('toggle');
                    // swal("Done !", 'OTP successfully sent on your Email Id & Mobile No.', "success");
                    } else {
                        swal("Error", rdata, "error");
                        }
                })
            }
    })

/*<!-- ------------------------------------------------------------------- -->*/

/*<!-- Enter Email Signup OTP Validation Script-->*/

// Combined function
document.addEventListener("DOMContentLoaded", function () {
    // Initial call to set the button state based on the input values
    enterOTPValidation();

    // Add event listeners for input events
    document.getElementById("signup_otp_value").addEventListener("input", enterSignupOTPValidation);

    // Clear the input field when the page loads (check, not working here)
    document.getElementById("signup_otp_value").value = '';

    // otp_signup
    $(document).on("click", "#otp_signup", function () {

        var APP_URL = $("#APP_URL").val()
        var otp_value = $("#signup_otp_value").val()

        if (otp_value == '') {
            swal("Oops!", 'Enter OTP', "error");
            } else {
                // Show processing
                $('#under_processing').modal('show');

                var btnOTPSignup = document.getElementById("otp_signup");
                btnOTPSignup.innerHTML = 'Processing...';

                // Disable the reset password button to prevent multiple submissions
                btnOTPSignup.disabled = true;

                var url = APP_URL + '/login_with_otp';
                var data = { _token: "{{ csrf_token() }}", otp_value: otp_value };

                $.get(url, data, function (rdata) {
                    if (rdata == 'success') {
                        swal("Done !", 'successfully login', "success");
                        location.reload("/")
                        } else {
                            swal("Error", rdata, "error");
                            }
                    }).fail(function () {
                        swal("Oops!", "Please enter a valid OTP", "error");
                        }).always(function () {
                            // Hide processing after 2 seconds
                            setTimeout(function () {
                                $('#under_processing').modal('hide'); // Hide processing modal

                                // Reset button text
                                btnOTPSignup.innerHTML = 'Continue';
                                btnOTPSignup.disabled = false;
                                }, 2000);
                        });
                }
        });

    });
    // OTP Validation
    function enterSignupOTPValidation() {
        var enterSignupOTP = document.getElementById("signup_otp_value");
        var btn_otp_signup_login = document.getElementById("otp_signup");
        var signupOtpErrorMessage = document.getElementById("signupOtpErrorMessage");
        var inputSignupOTPField = document.querySelector('.innerField-enter-signup-otp');
        var otpLength = enterSignupOTP.value.trim();
        
        if (otpLength === "") {
            signupOtpErrorMessage.textContent = "";
            inputSignupOTPField.classList.remove("error");
            btn_otp_signup_login.disabled = true;
            btn_otp_signup_login.classList.add("disabled");
            return false;
            } else if (otpLength.length === 5) {
            signupOtpErrorMessage.textContent = "";
            inputSignupOTPField.classList.remove("error");
            btn_otp_signup_login.disabled = false;
            btn_otp_signup_login.classList.remove("disabled");
            return true;
            } else {
            signupOtpErrorMessage.textContent = "Please enter a valid OTP";
            inputSignupOTPField.classList.add("error");
            btn_otp_signup_login.disabled = true;
            btn_otp_signup_login.classList.add("disabled");
            return false;
            }

    // Check if email and loginPassword are non-empty
    var isSignupOTPValid = enterSignupOTP.value.trim() !== "";

    // Enable or disable the submit button based on input states
    btn_otp_signup_login.disabled = !(isSignupOTPValid);
    btn_otp_signup_login.classList.toggle("disabled", !isSignupOTPValid);
    }

/*<!-- ------------------------------------------------------------------- -->*/
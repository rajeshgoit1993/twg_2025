$(document).ready(function () {

    // profie pic upload validation
    /*// JavaScript Validation for Image Dimensions and Preview
    function profilepicValidation() {
        var fileInput = document.getElementById('profilepic');
        var filePath = fileInput.value;
        var imagePreview = document.getElementById('imagePreview');
        var validExtensions = /(\.jpg|\.jpeg)$/i; // Allowed file extensions

        // Validate file type
        if (!validExtensions.test(filePath.toLowerCase())) {
            alert("Please select a valid image file (.jpg, .jpeg).");
            return false;
        }

        // Check if File API is supported
        if (typeof (fileInput.files) === "undefined" || fileInput.files.length === 0) {
            alert("This browser does not support HTML5, or no file was selected.");
            return false;
        }

        var file = fileInput.files[0];
        var reader = new FileReader();

        // Load the image file
        reader.onload = function (e) {
            var image = new Image();
            image.src = e.target.result;

            // Validate image dimensions
            image.onload = function () {
                var height = this.height;
                var width = this.width;
                if (height > 225 || width > 200) {
                    alert("Image dimensions must not exceed 225px in height and 200px in width.");
                    fileInput.value = ""; // Clear the file input
                    imagePreview.innerHTML = '<img src="https://d30y9cdsu7xlg0.cloudfront.net/png/138926-200.png" alt="Profile Pic" class="borderE9 borderRadius3" width="225" height="200">';
                    return false;
                } else {
                    // Display the image preview
                    imagePreview.innerHTML = '<img src="' + e.target.result + '" alt="Profile Pic" class="borderE9 borderRadius3" width="225" height="200">';
                }
            };

            // Handle image loading errors
            image.onerror = function () {
                alert("Invalid image file.");
                fileInput.value = ""; // Clear the file input
                return false;
            };
        };

        reader.readAsDataURL(file);
        return true; // Allow form submission if everything is valid
    }*/

    function profilepicValidation() {
        var fileInput = document.getElementById('profilepic');
        var filePath = fileInput.value;
        var imagePreview = document.getElementById('imagePreview');
        var validExtensions = /(\.jpg|\.jpeg|\.png|\.webp)$/i; // Allowed file extensions

        // If no file is selected, allow form submission (when editing an existing user)
        if (!fileInput.files.length) {
            return true; // Skip validation
        }

        // Validate file type
        if (!validExtensions.test(filePath.toLowerCase())) {
            alert("Please select a valid image file (.jpg, .jpeg, .png, .webp).");
            return false;
        }

        // Check if File API is supported
        if (typeof (fileInput.files) === "undefined" || fileInput.files.length === 0) {
            alert("This browser does not support HTML5, or no file was selected.");
            return false;
        }

        var file = fileInput.files[0];
        var reader = new FileReader();

        // Load the image file
        reader.onload = function (e) {
            var image = new Image();
            image.src = e.target.result;

            // Validate image dimensions
            image.onload = function () {
                var height = this.height;
                var width = this.width;
                if (height > 225 || width > 200) {
                    alert("Image dimensions must not exceed 225px in height and 200px in width.");
                    fileInput.value = ""; // Clear the file input
                    imagePreview.innerHTML = '<img src="https://d30y9cdsu7xlg0.cloudfront.net/png/138926-200.png" alt="user-img">';
                    return false;
                } else {
                    // Display the image preview
                    imagePreview.innerHTML = '<img src="' + e.target.result + '" alt="user-img">';
                }
            };

            // Handle image loading errors
            image.onerror = function () {
                alert("Invalid image file.");
                fileInput.value = ""; // Clear the file input
                return false;
            };
        };

        reader.readAsDataURL(file);
        return true; // Allow form submission if everything is valid
    }


    // Attach the validation function to the form submission event
    $('#customform').on('submit', function () {
        return profilepicValidation();
    });

    // Alternatively, if you want to trigger the validation on file input change
    $('#profilepic').on('change', function () {
        profilepicValidation();
    });


    //*********************************************

    // profile pic upload error message
    const form = document.querySelector('.customform');

    function insertAfter(newNode, referenceNode) {
        referenceNode.parentNode.insertBefore(newNode, referenceNode.nextElementSibling);
        return newNode;
    }

    class FieldValidator {
        constructor(field) {
            this._field = field;
            this._error = null;

            this._onInvalid = this._onInvalid.bind(this);
            this._onInput = this._onInput.bind(this);
            this._onBlur = this._onBlur.bind(this);
            this.bindEventListeners();
        }

        bindEventListeners() {
            this._field.addEventListener('invalid', this._onInvalid);
            this._field.addEventListener('input', this._onInput);
            this._field.addEventListener('blur', this._onBlur);
        }

        showError() {
            if (this._error !== null) {
                return this.updateError();
            }

            this._error = document.createElement('div');
            this._error.className = 'help-block';
            this._error.innerHTML = this._field.validationMessage;

            this._field.setAttribute('aria-invalid', 'true');

            // Insert error after .profile-img-cont
            const profileImgCont = this._field.closest('.profile-img-cont');
            if (profileImgCont) {
                insertAfter(this._error, profileImgCont);
            } else {
                // Fallback to inserting after the field itself
                insertAfter(this._error, this._field);
            }
        }

        updateError() {
            if (this._error === null) return;

            this._error.innerHTML = this._field.validationMessage;
        }

        hideError() {
            if (this._error !== null) {
                this._error.parentNode.removeChild(this._error);
                this._error = null;
            }

            this._field.removeAttribute('aria-invalid');
        }

        _onInvalid(event) {
            event.preventDefault();
        }

        _onInput(event) {
            if (this._field.validity.valid) {
                this.hideError();
            } else {
                this.updateError();
            }
        }

        _onBlur(event) {
            if (!this._field.validity.valid) {
                this.showError();
            }
        }
    }

    Array.prototype.slice.call(form.elements).forEach((element) => {
        element._validator = new FieldValidator(element);
    });

    form.setAttribute('novalidate', true);

    form.addEventListener('invalid', (event) => {
        event.preventDefault();
        event.target._validator.showError();
    }, true);

    form.addEventListener('submit', (event) => {
        if (!form.checkValidity()) {
            event.preventDefault();
            form.querySelectorAll(':invalid')[0].focus();
            return;
        }

        event.preventDefault();
        var form_data = new FormData($("#customform")[0]);

        $.ajax({
            url: APP_URL + '/user_data_check',
            data: form_data,
            type: 'post',
            contentType: false,
            processData: false,

            success: function(data) {
                if (data == 'success') {
                    $("#customform").unbind('submit').submit();
                } else {
                    alert(data);
                }
            },
            error: function(xhr, status, error) {
                alert('An error occurred: ' + error);
            }
        });
    });

    //*********************************************

    // subscription service
    // Update subscription options based on the number of selected services
    $(document).on('click', ".subscription_service", function () {
        const checkedValues = $('.subscription_service:checkbox:checked').map(function () {
            return $(this).val();
        }).get();

        const count = checkedValues.length;

        let optionsHtml = '<option value="" disabled>Select</option>';
        optionsHtml += `<option value="subscribed" ${count === 3 ? 'selected' : ''}>Subscribed</option>`;
        optionsHtml += `<option value="partialsubscribed" ${count === 2 || count === 1 ? 'selected' : ''} ${count === 0 || count === 3 ? 'disabled' : ''}>Partial Subscribed</option>`;
        optionsHtml += `<option value="unsubscribed" ${count === 0 ? 'selected' : ''}>Unsubscribed</option>`;

        $('.subscription').html(optionsHtml);
    });

    // Handle changes to the subscription dropdown
    $(document).on('change', '.subscription', function () {
        const isSubscribed = $(this).val() === 'subscribed';
        $('.subscription_service').prop('checked', isSubscribed);
    });

    //*********************************************

    // service type fuction
    // Add event listeners to the checkboxes
    const tourPackageCheckbox = $("#tourpackage");
    const visaCheckbox = $("#visa");

    if (tourPackageCheckbox.length) {
        tourPackageCheckbox.on("change", toggleServiceType);
    }

    if (visaCheckbox.length) {
        visaCheckbox.on("change", toggleServiceType);
    }

    // Function to toggle service type visibility and requirements
    function toggleServiceType() {
        // Get destination elements
        const tourDestination = $("#tourdestination");
        const holidayDestination = $("#holidaydestination");
        const visaDestination = $("#visadestination");
        const visaDestinations = $("#visadestinations");

        // Toggle display and required attribute for tour package
        if (tourDestination.length && holidayDestination.length && tourPackageCheckbox.length) {
            const isTourSelected = tourPackageCheckbox.is(":checked");
            tourDestination.css("display", isTourSelected ? "block" : "none");
            isTourSelected ? holidayDestination.attr("required", "") : holidayDestination.removeAttr("required");
        }

        // Toggle display and required attribute for visa
        if (visaDestination.length && visaDestinations.length && visaCheckbox.length) {
            const isVisaSelected = visaCheckbox.is(":checked");
            visaDestination.css("display", isVisaSelected ? "block" : "none");
            isVisaSelected ? visaDestinations.attr("required", "") : visaDestinations.removeAttr("required");
        }
    }

    //*********************************************

    // header and footer lock
    // Helper function to toggle lock state
    function toggleLockState(element, valueSelector, boxSelector, isEditor, editorInstance) {
        const currentValue = $(valueSelector).val();
        const isLocked = currentValue == 1;
        const newValue = isLocked ? 0 : 1;
        const iconClassToRemove = isLocked ? 'fa-lock' : 'fa-unlock';
        const iconClassToAdd = isLocked ? 'fa-unlock' : 'fa-lock';

        // Update the value before toggling icon classes and states
        $(valueSelector).val(newValue);

        // Toggle icon classes
        element.removeClass(iconClassToRemove).addClass(iconClassToAdd);

        if (isEditor) {
            // Set read-only state for CKEditor
            CKEDITOR.instances[editorInstance].setReadOnly(newValue === 1);
        } else {
            // Enable or disable the box based on the new lock state
            $(boxSelector).prop('disabled', newValue === 1);
        }
    }

    // Event handlers for locking and unlocking elements
    $(document).on("click", ".lock_header_icon", function () {
        toggleLockState($(this), ".lock_header", ".lock_header_box", false);
    });

    $(document).on("click", ".lock_header_email_icon", function () {
        toggleLockState($(this), ".lock_header_email", null, true, 'signature_header');
    });

    $(document).on("click", ".lock_footer_icon", function () {
        toggleLockState($(this), ".lock_footer", ".lock_footer_box", false);
    });

    $(document).on("click", ".lock_footer_email_icon", function () {
        toggleLockState($(this), ".lock_footer_email", null, true, 'signature');
    });

    // Synchronize header and footer lock box values
    $(document).on("change", ".lock_header_box", function () {
        $(".quotation_header").val($(this).val());
    });

    $(document).on("change", ".lock_footer_box", function () {
        $(".quotation_footer").val($(this).val());
    });

    //*********************************************

    // show & hide password
    // Attach event listener for password toggle
    $('#togglePasswordBtn1').on('click', function() {
        togglePasswordVisibility('password');
    });

    // Attach event listener for confirm password toggle
    $('#togglePasswordBtn2').on('click', function() {
        togglePasswordVisibility('password_confirmation');
    });
});

function togglePasswordVisibility(fieldId) {
    const passwordField = $('#' + fieldId);
    const passwordIcon = fieldId === 'password' ? $('#togglePasswordIcon1') : $('#togglePasswordIcon2');

    if (passwordField.attr('type') === "password") {
        passwordField.attr('type', 'text'); // Show password
        passwordIcon.removeClass('fa-eye').addClass('fa-eye-slash'); // Change icon to closed eye
    } else {
        passwordField.attr('type', 'password'); // Hide password
        passwordIcon.removeClass('fa-eye-slash').addClass('fa-eye'); // Change icon to open eye
    }
}
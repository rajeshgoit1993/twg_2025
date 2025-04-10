/*quotation*/

// extend validity
$(document).ready(function() {
    // Extend validity modal open/close logic
    const openModalBtns = document.getElementsByClassName('open-extendValidityModal');
    const closeModalBtn = document.querySelector('.btn-close-extendValidityModal');  // Use the cancel button for closing
    const modal = document.getElementById('extendValidityModal');

    // Loop through all the buttons and add click event listener
    Array.from(openModalBtns).forEach(button => {
        button.addEventListener('click', function () {
            modal.style.display = 'block'; // Show the modal
        });
    });

    // Function to close the modal
    closeModalBtn.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    // Close the modal if the user clicks outside of it
    /*window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });*/
});

$(document).ready(function() {

    // Datepicker logic for trip validity
    var today = new Date();
    
    // Calculate yesterday's date
    var yesterday = new Date(today);
    yesterday.setDate(today.getDate() - 1);

    // Initialize the datepicker for trip validity
    $('.datepicker_trip_validity').datepicker({
        dateFormat: 'dd-mm-yy',  // Set the date format to 'day-month-year'
        minDate: yesterday,      // Set minimum selectable date to yesterday
        maxDate: new Date(today.getFullYear(), today.getMonth(), today.getDate() + 180), // Set max date 180 days from today
        changeMonth: true,       // Allow changing months via dropdown
        changeYear: true,        // Allow changing years via dropdown
        showButtonPanel: true,   // Show the button panel with 'Today' and 'Done' buttons
    });


    // Set default time
    //$('#quoteValidityTime').val('23:59');

    // Function to validate time input in HH:MM format
    function validateTime() {
        var quoteValidityTime = document.getElementById('quoteValidityTime');
        var pattern = /^(?:[01]\d|2[0-3]):[0-5]\d$/; // HH:MM format

        if (!pattern.test(quoteValidityTime.value)) {
            alert('Please enter a valid time in the format HH:MM (24-hour).');
            return false;
        }

        return true;
    }

    // Handle click event on reset button
    $(document).on("click", ".btn-time-reset", function() {
        // Reset the validity time to '23:59'
        $("#quoteValidityTime").val('23:59');

        // Clear the reset button container
        $(".btn-time-reset-cont").html('');
    });

    // Handle keyup or change event on validity_time input
    $(document).on("keyup change", "#quoteValidityTime", function() {
        var time = $(this).val();
        var resetButton = $(".btn-time-reset-cont").find(".btn-time-reset");

        // Show or hide the reset button based on the validity time value
        if (time !== '23:59' && resetButton.length === 0) {
            // If not default time and reset button is not present, add the reset button
            $(".btn-time-reset-cont").html('<button type="button" class="btn-time-reset">Reset</button>');
        } else if (time === '23:59' && resetButton.length > 0) {
            // If default time and reset button exists, remove it
            $(".btn-time-reset-cont").html('');
        }
    });

    // Validate time on form submission
    $('#extend_trip_validity').on('submit', function() {
        return validateTime();  // Only submit if time validation passes
    });
});


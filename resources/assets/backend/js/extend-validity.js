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
   const query_id = this.getAttribute('query_id'); // Get the value from the clicked button
   var APP_URL = $("#APP_URL").val();

   $.ajax({
                url: APP_URL + '/get_quote_validity_date',
                type: 'get',
                data: { quote_id: query_id},
                success: function(data) {
                    console.log(data.main_data)
            $(".extend_validity_data").html('').html(data.main_data)
            $(".enq_ref_no").html('').html(data.enquiry_ref_no)
            $(".quote_ref_no").html('').html(data.quote_ref_no)
                 modal.style.display = 'block'; 

                //
                  $('.datepicker_trip_validity').datepicker("destroy").datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            todayHighlight: true,
            startDate: '0d',
            endDate: "+" + data.diffDays + "d"
        });
                 //

                },
                error: function(data) {
                    // Handle error case here
                }
            });



           
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
    


    // Set default time
    //$('#quoteValidityTime').val('23:59');

    // Function to validate time input in HH:MM format
    function validateTime() {
        var quoteValidityTime = document.getElementById('quoteValidityTime');
        var pattern = /^(?:[01]\d|2[0-3]):[0-5]\d:[0-5]\d$/;

        if (!pattern.test(quoteValidityTime.value)) {
    alert('Please enter a valid time in the format HH:MM:SS (24-hour).');
    return false;
}

        return true;
    }

    // Handle click event on reset button
    $(document).on("click", ".btn-time-reset", function() {
        // Reset the validity time to '23:59'
        $("#quoteValidityTime").val('23:59:59');

        // Clear the reset button container
        $(".btn-time-reset-cont").html('');
    });

    // Handle keyup or change event on validity_time input
    $(document).on("keyup change", "#quoteValidityTime", function() {
        var time = $(this).val();
        var resetButton = $(".btn-time-reset-cont").find(".btn-time-reset");

        // Show or hide the reset button based on the validity time value
        if (time !== '23:59:59' && resetButton.length === 0) {
            // If not default time and reset button is not present, add the reset button
            $(".btn-time-reset-cont").html('<button type="button" class="btn-time-reset">Reset</button>');
        } else if (time === '23:59:59' && resetButton.length > 0) {
            // If default time and reset button exists, remove it
            $(".btn-time-reset-cont").html('');
        }
    });

    // Validate time on form submission
    $('#extend_trip_validity').on('submit', function(event) {
        event.preventDefault()
         if (!validateTime()) return false;
      
        var form_data = new FormData($("#extend_trip_validity")[0]);

        $.ajax({
        url: APP_URL + '/update_quote_validity', // URL to send the request
        data: form_data, // Data to be sent to the server
        type: 'post', // HTTP method
        contentType: false, // Disable content type header
        processData: false, // Prevent jQuery from automatically transforming the data into a query string

        success: function(data) {
            // Check if the server response is 'success'
            if (data == 'success') {
                // Hide the modal with id 'lead_follow_up_modal'
                var extendValidity_Modal = document.getElementById("extendValidityModal");
                extendValidity_Modal.style.display = "none";

                // Display a success message
                swal({
                    title: "Done !",
                    text: "Quote Validity Updated",
                    type: "success",
                    timer: 3000
                });

                // // Reload the page after 3 seconds
                // setTimeout(function() {
                //     window.location.reload(1);
                // }, 3000);
            } else {
                // Display an error message
                swal({
                    title: "Warning !",
                    text: "Error",
                    type: "error",
                    timer: 1000
                });

                // Uncomment this line to reload the page on error
                // location.reload();
            }
        },
        error: function(data) {
            // Handle errors here
        }
    });

    });
});


// Retrieve the base URL from the input field with id 'baseurl'
var APP_URL = $('#baseurl').val();
// Uncomment this line if you need to debug the URL
// alert(APP_URL);
let previousquerystatus;
let previousqueryclassname;
$(document).on('focus', '.query_status' , function() {
  // Store the current value before it changes
  previousquerystatus = $(this).val();
  previousqueryclassname = $(this).attr('dynamic_class_name');

});
// Handle the form submission for '#follow_ups' form
$(document).on("submit", "#follow_ups", function(event) {
    // Prevent the default form submission
    event.preventDefault();

    // Hide the modal with id 'add_item_modal'
    $('#add_item_modal').modal('hide');

    // Create a new FormData object from the '#follow_ups' form
    var form_data = new FormData($("#follow_ups")[0]);

    // Retrieve the APP_URL value from an input field with id 'APP_URL'
    var APP_URL = $("#APP_URL").val();

    // Make an AJAX request to update follow-ups
    $.ajax({
        url: APP_URL + '/update_follow_ups', // URL to send the request
        data: form_data, // Data to be sent to the server
        type: 'post', // HTTP method
        contentType: false, // Disable content type header
        processData: false, // Prevent jQuery from automatically transforming the data into a query string

        success: function(data) {
            // Check if the server response is 'success'
            if (data == 'success') {
                // Hide the modal with id 'lead_follow_up_modal'
                var lead_follow_up_modal = document.getElementById("lead_follow_up_modal");
                lead_follow_up_modal.style.display = "none";

                // Display a success message
                swal({
                    title: "Done !",
                    text: "This lead has moved into Lead Follow-up",
                    type: "success",
                    timer: 3000
                });

                // Reload the page after 3 seconds
                setTimeout(function() {
                    window.location.reload(1);
                }, 3000);
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

/************/

// Handle the form submission for '#follow_up' form
$(document).on("submit", "#follow_up", function(event) {
    // Prevent the default form submission
    event.preventDefault();

    // Hide the modal with id 'add_item_modal'
    $('#add_item_modal').modal('hide');

    // Create a new FormData object from the '#follow_up' form
    var form_data = new FormData($("#follow_up")[0]);

    // Retrieve the APP_URL value from an input field with id 'APP_URL'
    var APP_URL = $("#APP_URL").val();

    // Make an AJAX request to update follow-up
    $.ajax({
        url: APP_URL + '/update_follow_up', // URL to send the request
        data: form_data, // Data to be sent to the server
        type: 'post', // HTTP method
        contentType: false, // Disable content type header
        processData: false, // Prevent jQuery from automatically transforming the data into a query string

        success: function(data) {
            // Check if the server response is 'success'
            if (data == 'success') {
                // Hide the modal with id 'lead_follow_up_modal'
                var lead_follow_up_modal = document.getElementById("lead_follow_up_modal");
                lead_follow_up_modal.style.display = "none";

                // Display a success message
                swal({
                    title: "Done !",
                    text: "This lead has moved into Pending Verification",
                    type: "success",
                    timer: 2000
                });

                // Reload the page after 2 seconds
                setTimeout(function() {
                    window.location.reload(1);
                }, 2000);
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

/************/

// Handle the form submission for '#refund_under_process_form'
$(document).on("submit", "#refund_under_process_form", function(event) {
    // Prevent the default form submission
    event.preventDefault();

    // Hide the modal with id 'add_item_modal'
    $('#add_item_modal').modal('hide');

    // Create a new FormData object from the '#refund_under_process_form'
    var form_data = new FormData($("#refund_under_process_form")[0]);

    // Retrieve the APP_URL value from an input field with id 'APP_URL'
    var APP_URL = $("#APP_URL").val();

    // Make an AJAX request to handle the refund under process form
    $.ajax({
        url: APP_URL + '/refund_under_process_form', // URL to send the request
        data: form_data, // Data to be sent to the server
        type: 'post', // HTTP method
        contentType: false, // Disable content type header
        processData: false, // Prevent jQuery from automatically transforming the data into a query string

        success: function(data) {
            // Check if the server response is 'success'
            if (data == 'success') {
                // Hide the modal with id 'refund_under_process_modal'
                var refund_under_process_modal = document.getElementById("refund_under_process_modal");
                refund_under_process_modal.style.display = "none";

                // Display a success message
                swal({
                    title: "Done !",
                    text: "Refund updated successfully.",
                    type: "success",
                    timer: 1000
                });

                // Reload the page
                location.reload();
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

/************/

// Handle the form submission for '#enquiry_issue_voucher'
$(document).on("submit", "#enquiry_issue_voucher", function(event) {
    // Prevent the default form submission
    event.preventDefault();

    // Hide the modal with id 'add_item_modal'
    $('#add_item_modal').modal('hide');

    // Create a new FormData object from the '#enquiry_issue_voucher' form
    var form_data = new FormData($("#enquiry_issue_voucher")[0]);

    // Retrieve the APP_URL value from an input field with id 'APP_URL'
    var APP_URL = $("#APP_URL").val();

    // Make an AJAX request to handle the issue voucher form
    $.ajax({
        url: APP_URL + '/update_issue_voucher', // URL to send the request
        data: form_data, // Data to be sent to the server
        type: 'post', // HTTP method
        contentType: false, // Disable content type header
        processData: false, // Prevent jQuery from automatically transforming the data into a query string

        success: function(data) {
            // Check if the server response is 'success'
            if (data == 'success') {
                // Hide the modal with id 'issue_voucher_modal'
                var issue_voucher_modal = document.getElementById("issue_voucher_modal");
                issue_voucher_modal.style.display = "none";

                // Display a success message
                swal({
                    title: "Done !",
                    text: "This lead has moved into Tour Vouchered",
                    type: "success",
                    timer: 2000
                });

                // Reload the page after 2000ms
                setTimeout(function() {
                    window.location.reload(1);
                }, 2000);
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

/************/

// Handle the form submission for '#enquiry_tour_cancel'
$(document).on("submit", "#enquiry_tour_cancel", function(event) {
    // Prevent the default form submission
    event.preventDefault();

    // Hide the modal with id 'add_item_modal'
    $('#add_item_modal').modal('hide');

    // Create a new FormData object from the '#enquiry_tour_cancel' form
    var form_data = new FormData($("#enquiry_tour_cancel")[0]);

    // Retrieve the APP_URL value from an input field with id 'APP_URL'
    var APP_URL = $("#APP_URL").val();

    // Make an AJAX request to handle the tour cancel form
    $.ajax({
        url: APP_URL + '/update_tour_cancel', // URL to send the request
        data: form_data, // Data to be sent to the server
        type: 'post', // HTTP method
        contentType: false, // Disable content type header
        processData: false, // Prevent jQuery from automatically transforming the data into a query string

        success: function(data) {
            // Check if the server response is 'success'
            if (data == 'success') {
                // Hide the modal with id 'tour_cancelled_modal'
                var tour_cancelled_modal = document.getElementById("tour_cancelled_modal");
                tour_cancelled_modal.style.display = "none";

                // Display a success message
                swal({
                    title: "Done !",
                    text: "This lead has moved into Tour Cancelled.",
                    type: "success",
                    timer: 2000
                });

                // Reload the page after 2000ms
                setTimeout(function() {
                    window.location.reload(1);
                }, 2000);
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

/************/

// Handle the form submission for '#enquiry_lead_cancel'
$(document).on("submit", "#enquiry_lead_cancel", function(event) {
    // Prevent the default form submission
    event.preventDefault();

    // Hide the modal with id 'add_item_modal'
    $('#add_item_modal').modal('hide');

    // Create a new FormData object from the '#enquiry_lead_cancel' form
    var form_data = new FormData($("#enquiry_lead_cancel")[0]);

    // Retrieve the APP_URL value from an input field with id 'APP_URL'
    var APP_URL = $("#APP_URL").val();

    // Make an AJAX request to handle the lead cancel form
    $.ajax({
        url: APP_URL + '/update_lead_cancel', // URL to send the request
        data: form_data, // Data to be sent to the server
        type: 'post', // HTTP method
        contentType: false, // Disable content type header
        processData: false, // Prevent jQuery from automatically transforming the data into a query string

        success: function(data) {
            // Check if the server response is 'success'
            if (data == 'success') {
                // Hide the modal with id 'lead_follow_up_modal'
                var lead_follow_up_modal = document.getElementById("lead_follow_up_modal");
                lead_follow_up_modal.style.display = "none";

                // Display a success message
                swal({
                    title: "Done !",
                    text: "This lead has moved into Cancelled Leads",
                    type: "success",
                    timer: 2000
                });

                // Reload the page after 2000ms
                setTimeout(function() {
                    window.location.reload(1);
                }, 2000);
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

/************/
function selectpreviousstatus()
{
   
    $('.' + previousqueryclassname).val(previousquerystatus);
    
}
$(document).ready(function() {

    // Check if the 'lead_follow_up_modal' element exists in the DOM
    if (document.getElementById('lead_follow_up_modal')) {
        // Get the modal elements
        var lead_follow_up_modal = document.getElementById("lead_follow_up_modal");
        var lead_cancelled_modal = document.getElementById("lead_cancelled_modal");

        // Get the close button for the 'lead_follow_up_modal'
        var span = document.getElementsByClassName("btn_lead_modal_close")[0];
        span.onclick = function() {
         
            selectpreviousstatus()
            // Hide the 'lead_follow_up_modal' when the close button is clicked
            lead_follow_up_modal.style.display = "none";
        };

        // Get the close button for the 'lead_cancelled_modal'
        var span_cancelled = document.getElementsByClassName("btn_lead_modal_close_cancelled")[0];
        span_cancelled.onclick = function() {
           selectpreviousstatus()
            lead_cancelled_modal.style.display = "none";
        };

        // Close the modal if the user clicks anywhere outside of it
        window.onclick = function(event) {
            // Check if the click was on the 'lead_follow_up_modal'
            if (event.target == lead_follow_up_modal) {
                selectpreviousstatus()
                lead_follow_up_modal.style.display = "none";
            }
            // Check if the click was on the 'lead_cancelled_modal'
            else if (event.target == lead_cancelled_modal) {

         selectpreviousstatus()
                lead_cancelled_modal.style.display = "none";
            }
        };
    }

    // Check if the 'refund_under_process_modal' element exists in the DOM
    if (document.getElementById('refund_under_process_modal')) {
        // Get the modal element
        var refund_under_process_modal = document.getElementById("refund_under_process_modal");

        // Get the close button for the 'refund_under_process_modal'
        var span_refund_under_process = document.getElementsByClassName("btn_refund_under_process_modal_close_cancelled")[0];
        span_refund_under_process.onclick = function() {
            // Hide the 'refund_under_process_modal' when the close button is clicked
            refund_under_process_modal.style.display = "none";
        };

        // Close the modal if the user clicks anywhere outside of it
        window.onclick = function(event) {
            // Check if the click was on the 'refund_under_process_modal'
            if (event.target == refund_under_process_modal) {
                refund_under_process_modal.style.display = "none";
            }
        };
    }

    // Check if the 'tour_cancelled_modal' element exists in the DOM
    if (document.getElementById('tour_cancelled_modal')) {
        // Get the modal element
        var tour_cancelled_modal = document.getElementById("tour_cancelled_modal");

        // Get the close button for the 'tour_cancelled_modal'
        var span_tour_cancelled = document.getElementsByClassName("btn_tour_modal_close_cancelled")[0];
        span_tour_cancelled.onclick = function() {
            // Hide the 'tour_cancelled_modal' when the close button is clicked
            tour_cancelled_modal.style.display = "none";
        };

        // Close the modal if the user clicks anywhere outside of it
        window.onclick = function(event) {
            if (event.target == tour_cancelled_modal) {
                tour_cancelled_modal.style.display = "none";
            }
        };
    }

    // Check if the 'btn_tour_modal_issue_voucher' element exists in the DOM
    if (document.getElementById('btn_tour_modal_issue_voucher')) {
        // Get the modal element
        var issue_voucher_modal = document.getElementById("issue_voucher_modal");

        // Get the close button for the 'issue_voucher_modal'
        var span_issue_voucher = document.getElementsByClassName("btn_tour_modal_issue_voucher")[0];
        span_issue_voucher.onclick = function() {
            // Hide the 'issue_voucher_modal' when the close button is clicked
            issue_voucher_modal.style.display = "none";
        };

        // Close the modal if the user clicks anywhere outside of it
        window.onclick = function(event) {
            if (event.target == issue_voucher_modal) {
                issue_voucher_modal.style.display = "none";
            }
        };
    }

    // Check if the 'add_payment_modal' element exists in the DOM
    if (document.getElementById('add_payment_modal')) {
        // Get the modal element
        var add_payment_modal = document.getElementById("add_payment_modal");

        // Get the close button for the 'add_payment_modal'
        var span_add_payment = document.getElementsByClassName("btn_lead_modal_close_add_payment")[0];
        span_add_payment.onclick = function() {
            // Hide the 'add_payment_modal' when the close button is clicked
            add_payment_modal.style.display = "none";
        };

        // Close the modal if the user clicks anywhere outside of it
        window.onclick = function(event) {
            if (event.target == add_payment_modal) {
                add_payment_modal.style.display = "none";
            }
        };
    }

    // Check if the refund payment modal exists
    if (document.getElementById('refund_payment_modal')) {
        var refund_payment_modal = document.getElementById("refund_payment_modal");
        var span_refund_payment = document.getElementsByClassName("btn_lead_modal_close_refund_payment")[0];
        
        // Close modal when the close button is clicked
        span_refund_payment.onclick = function() {
            refund_payment_modal.style.display = "none";
        }

        // Close modal when clicking outside of it
        window.onclick = function(event) {
            if (event.target == refund_payment_modal) {
                refund_payment_modal.style.display = "none";
            }
        }
    }

    // Check if the refund create modal exists
    if (document.getElementById('refund_create_modal')) {
        var refund_create_modal = document.getElementById("refund_create_modal");
        var span_refund_create = document.getElementsByClassName("btn_lead_modal_close_refund_create")[0];
        
        // Close modal when the close button is clicked
        span_refund_create.onclick = function() {
            refund_create_modal.style.display = "none";
        }

        // Close modal when clicking outside of it
        window.onclick = function(event) {
            if (event.target == refund_create_modal) {
                refund_create_modal.style.display = "none";
            }
        }
    }

    // Check if the service type modal exists
    if (document.getElementById('service_type_modal')) {
        var service_type_modal = document.getElementById("service_type_modal");
        var span_service_type = document.getElementsByClassName("btn_service_type_close")[0];
        
        // Close modal when the close button is clicked
        span_service_type.onclick = function() {
            service_type_modal.style.display = "none";
        }

        // Close modal when clicking outside of it
        window.onclick = function(event) {
            if (event.target == service_type_modal) {
                service_type_modal.style.display = "none";
            }
        }
    }

    // Check if the payment follow-up modal exists
    if (document.getElementById('payment_follow_up_modal')) {
        var payment_follow_up_modal = document.getElementById("payment_follow_up_modal");
        var span_payment_follow_up = document.getElementsByClassName("btn_payment_follow_up_close")[0];
        
        // Close modal when the close button is clicked
        span_payment_follow_up.onclick = function() {
            payment_follow_up_modal.style.display = "none";
        }

        // Close modal when clicking outside of it
        window.onclick = function(event) {
            if (event.target == payment_follow_up_modal) {
                payment_follow_up_modal.style.display = "none";
            }
        }
    }

    // Handle click events on elements with the class 'submit_status'
    $(document).on('click', '.submit_status', function() {

        // Get the value of the status from a sibling input element
        var status_value = $(this).siblings().children('.query_status').val();
        var enquiry_ref_no =  $(this).parent().parent().attr('enquiry_ref_no');
var quote_ref_no =  $(this).parent().parent().attr('quote_ref_no');
previousquerystatus = status_value;

 previousqueryclassname = $(this).siblings().children('.query_status').attr('dynamic_class_name');
        // Get the ID of the parent element
        var id = $(this).parent().parent().attr('id');

        // Execute functions based on the status value
        if (status_value == 'lead_cancelled') {
            cancel_lead_follow_up_data(id,enquiry_ref_no,quote_ref_no);
        } else if (status_value == 'tour_cancelled') {
            cancel_tour_follow_up_data(id);
        } else if (status_value == 'refund_under_process') {
            refund_under_process_data(id);
        } else if (status_value == 'add_lead_follow_up' || status_value == 'lead_follow_up') {
            add_lead_follow_up_data(id,enquiry_ref_no,quote_ref_no);
        } else if (status_value == 'voucher_issued') {
            voucher_issued_remarks(id);
        } else if (status_value == 'payment_follow_up') {
            add_payment_follow_up(id);
        }
    });

    /*add or change payment status*/
    $(document).on('change','.payment_status',function() {
        
        /*var status_value=$(this).siblings('.payment_status').val()
        var id =$(this).parent().attr('id')
        var quote_no=$(this).siblings(".quote_no").find('option:selected').attr("quotation_no");
        var quote_id=$(this).siblings(".quote_no").find('option:selected').attr("id");
        var ref_no=$(this).siblings(".quote_no").find('option:selected').attr("ref_no");*/

        var status_value=$(this).val()
        var id = $(this).closest('.dashboard-inner-table').find('.submit_payment_status').data('id');
        var quote_no = $(this).closest('.dashboard-inner-table').find('.quote_no option:selected').attr('quotation_no');
        var quote_id = $(this).closest('.dashboard-inner-table').find('.quote_no option:selected').attr('id');
        var ref_no = $(this).closest('.dashboard-inner-table').find('.quote_no option:selected').attr('ref_no');

        if(status_value=='Partial Paid' || status_value=='Full Paid' || status_value=='Add Payment') {
            payment_status(status_value,id,quote_no,quote_id,ref_no)
        }

        if(status_value=='Refund Payment' || status_value=='Refund Partial Paid' || status_value=='Refund Full Paid') {
            refund_payment(status_value,id,quote_no,quote_id,ref_no)
        }

        else if(status_value=='Refund Create') {
            refund_create(status_value,id,quote_no,quote_id,ref_no)
        }
    })

    /* Handle click events on elements with the class 'submit_payment_status' */
    $(document).on('click', '.submit_payment_status', function() {

        // Retrieve values from the clicked element's closest .dashboard-inner-table
        var id = $(this).data('id');
        var status_value = $(this).closest('.dashboard-inner-table').find('.payment_status').val();
        var quote_no = $(this).closest('.dashboard-inner-table').find('.quote_no option:selected').attr('quotation_no');
        var quote_id = $(this).closest('.dashboard-inner-table').find('.quote_no option:selected').attr('id');
        var ref_no = $(this).closest('.dashboard-inner-table').find('.quote_no option:selected').attr('ref_no');

        // Perform different actions based on the payment status value
        if (status_value == 'Partial Paid' || status_value == 'Full Paid' || status_value == 'Add Payment') {
            payment_status(status_value, id, quote_no, quote_id, ref_no);
        } else if (status_value == 'Refund Create') {
            refund_create(status_value, id, quote_no, quote_id, ref_no);
        } else if (status_value == 'Refund Payment' || status_value == 'Refund Partial Paid' || status_value == 'Refund Full Paid') {
            refund_payment(status_value, id, quote_no, quote_id, ref_no);
        } else {
            // Default AJAX call for changing payment status
            $.ajax({
                url: APP_URL + '/change_payment_status',
                type: 'get',
                data: { id: id, status_value: status_value },
                success: function(data) {
                    swal({
                        title: "Done !",
                        text: "Successfully Changed Payment Status.",
                        type: "success",
                        timer: 1000
                    });
                },
                error: function(data) {
                    // Handle error case here
                }
            });
        }
    });

    /**Handles the refund payment process.*/
    function refund_payment(status_value, id, quote_no, quote_id, ref_no) {
        // Check if the quote number is 0
        if (quote_no == 0) {
            swal("Error !", 'Kindly Select Any Quote No.', "error");
        } else {
            // Set form field values
            $("#query_id_refund_payment").val('').val(id);
            $("#quote_no_refund_payment").val('').val(quote_no);
            $("#quote_id_refund_payment").val('').val(quote_id);

            // Get the application URL
            var APP_URL = $("#APP_URL").val();

            // Perform AJAX request to add refund payment
            $.ajax({
                url: APP_URL + '/add_refund_payment',
                type: 'get',
                data: { id: id, quote_id: quote_id, quote_no: quote_no, ref_no: ref_no },
                success: function(data) {
                    // Handle response from the server
                    if (data == 'error') {
                        swal("Error !", 'Kindly Add Passenger First', "error");
                    } else {
                        // Update form fields with the response data
                        $("#assigned_user_refund_payment").val('').val(data.assign);
                        $("#refund_booking_reference_no").val('').val(data.quote_ref_no);
                        $("#refund_booking_guest_name").val('').val(data.booking_guest_name);
                        $("#refund_booking_guest_mobile_no").val('').val(data.booking_guest_mobile_no);
                        $("#refund_booking_guest_email_id").val('').val(data.booking_guest_email_id);
                        $("#total_quote_amount").val('').val(data.amount);
                        $("#total_refundable_amount").val('').val(data.total_refundable_amount);
                        $("#refunded_amounts").val('').val(data.refunded_amounts);
                        $("#due_refund_amount").val('').val(data.due_refund_amount);
                        $("#cancellation_charge").val('').val(data.cancellation_charge);
                        
                        // Show the refund payment modal
                        var refund_payment_modal = document.getElementById("refund_payment_modal");
                        refund_payment_modal.style.display = "block";
                    }
                },
                error: function(data) {
                    // Handle error case here
                }
            });
        }
    }

    /************/

    /**
     * Updates the refunded amount based on the cancellation charge.
     */
    $(document).on("keyup", "#refund_cancellation_charge", function() {
        // Get the maximum refundable amount from the total quote
        var max_refundable_amount = $("#total_quote_refundable_amount").val();
        
        // Get the refund cancellation charge entered by the user
        var refund_cancellation_charge = $("#refund_cancellation_charge").val();
        
        // Calculate the remaining amount after deducting the cancellation charge
        var remaining = parseInt(max_refundable_amount) - parseInt(refund_cancellation_charge);
        
        // Update the refunded amount field with the remaining value
        $("#refunded_amount").val('').val(remaining);
    });

    /************/

    /**
     * Handles the creation of a refund.
     * 
     * @param {string} status_value - The status value for the refund.
     * @param {number} id - The ID of the item for which the refund is created.
     * @param {number} quote_no - The quote number associated with the refund.
     * @param {number} quote_id - The quote ID associated with the refund.
     * @param {string} ref_no - The reference number for the refund.
     */
    function refund_create(status_value, id, quote_no, quote_id, ref_no) {
        // Check if a quote number is selected
        if (quote_no == 0) {
            swal("Error !", 'Kindly Select Any Quote No.', "error");
        } else {
            // Set values for refund creation fields
            $("#query_id_refund_create").val('').val(id);
            $("#quote_no_refund_create").val('').val(quote_no);
            $("#quote_id_refund_create").val('').val(quote_id);

            // Get the application URL
            var APP_URL = $("#APP_URL").val();

            // Perform an AJAX request to create a refund
            $.ajax({
                url: APP_URL + '/create_refund_amound',
                type: 'get',
                data: {
                    id: id,
                    quote_id: quote_id,
                    quote_no: quote_no,
                    ref_no: ref_no
                },
                success: function(data) {
                    if (data == 'error') {
                        swal("Error !", 'Kindly update traveller details to proceed futher', "error");
                    } else if (data == 'already_paid') {
                        swal("Error !", 'Complete amount has been paid already', "error");
                    } else {
                        // Populate refund creation modal fields with data
                        $("#assigned_user_refund_create").val('').val(data.assign);
                        $("#refund_create_reference_no").val('').val(data.quote_ref_no);
                        $("#refund_create_guest_name").val('').val(data.booking_guest_name);
                        $("#refund_create_guest_mobile_no").val('').val(data.booking_guest_mobile_no);
                        $("#refund_create_guest_email_id").val('').val(data.booking_guest_email_id);
                        $("#total_create_quote_amount").val('').val(data.amount);
                        $("#total_quote_refundable_amount").val('').val(data.total_refundable);
                        $("#refunded_amount").val('').val(data.total_refundable);
                        $("#refund_cancellation_charge").val('').val(0);

                        // Display the refund creation modal
                        var refund_create_modal = document.getElementById("refund_create_modal");
                        refund_create_modal.style.display = "block";
                    }
                },
                error: function(data) {
                    // Handle any errors from the AJAX request
                }
            });
        }
    }


    /************/

    /**
     * Handles the form submission for updating a refund creation.
     * 
     * @param {Event} event - The form submission event.
     */
    $(document).on("submit", "#update_refund_create", function(event) {
        // Prevent the default form submission behavior
        event.preventDefault();

        // Retrieve form values
        var total_quote_refundable_amount = $("#total_quote_refundable_amount").val();
        var refund_cancellation_charge = $("#refund_cancellation_charge").val();
        var refund_amount = $("#refunded_amount").val();

        // Check if the sum of refund cancellation charge and refund amount is less than or equal to total refundable amount
        if (parseInt(total_quote_refundable_amount) >= (parseInt(refund_cancellation_charge) + parseInt(refund_amount))) {
            // Hide the modal
            $('#add_item_modal').modal('hide');
            
            // Prepare form data for submission
            var form_data = new FormData($("#update_refund_create")[0]);
            var APP_URL = $("#APP_URL").val();

            // Perform an AJAX request to update the refund creation
            $.ajax({
                url: APP_URL + '/update_refund_create',
                data: form_data,
                type: 'post',
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data == 'success') {
                        // Hide the refund creation modal
                        var refund_create_modal = document.getElementById("refund_create_modal");
                        refund_create_modal.style.display = "none";
                        
                        // Show success notification
                        swal({
                            title: "Done !",
                            text: "Refund created successfully.",
                            type: "success",
                            timer: 1000
                        });

                        // Reload the page
                        location.reload();
                    } else {
                        // Show error notification with server-provided message
                        swal({
                            title: "Warning !",
                            text: data,
                            type: "error",
                            timer: 1000
                        });

                        // Optional: Reload the page or handle further errors if needed
                        // location.reload();        
                    }
                },
                error: function(data) {
                    // Handle any AJAX request errors if needed
                }
            });
        } else {
            // Show warning if the amount exceeds the total refundable amount
            swal({
                title: "Warning !",
                text: 'Amount cannot be greater than total quote amount',
                type: "error",
                timer: 1000
            });
        }
    });

    /************/

    /**
     * Handles the payment status update and displays the payment modal.
     * 
     * @param {string} status_value - The status of the payment.
     * @param {number} id - The ID associated with the payment.
     * @param {string} quote_no - The quote number.
     * @param {string} quote_id - The quote ID.
     * @param {string} ref_no - The reference number.
     */
    function payment_status(status_value, id, quote_no, quote_id, ref_no) {
        // Check if the quote number is provided
        if (quote_no == 0) {
            swal("Error !", 'Kindly Select Any Quote No.', "error");
        } else {
            // Set form field values
            $("#query_id_add_payment").val('').val(id);
            $("#quote_no_add_payment").val('').val(quote_no);
            $("#quote_id_add_payment").val('').val(quote_id);

            var APP_URL = $("#APP_URL").val();

            // Perform an AJAX request to get payment details
            $.ajax({
                url: APP_URL + '/add_lead_payment',
                type: 'get',
                data: {
                    id: id,
                    quote_id: quote_id,
                    quote_no: quote_no,
                    ref_no: ref_no
                },
                success: function(data) {
                    // Check the response and display appropriate messages
                    if (data == 'error') {
                        swal("Error !", 'Kindly update traveller details to proceed futher', "error");
                    } else if (data == 'already_paid') {
                        swal("Error !", 'Complete amount has been paid already', "error");
                    } else {
                        // Populate fields with the returned data
                        $("#assigned_user_add_payment").val('').val(data.assign);
                        $("#booking_reference_no").val('').val(data.quote_ref_no);
                        $("#booking_guest_name").val('').val(data.booking_guest_name);
                        $("#booking_guest_mobile_no").val('').val(data.booking_guest_mobile_no);
                        $("#booking_guest_email_id").val('').val(data.booking_guest_email_id);
                        $("#total_amount").val('').val(data.amount);
                        $("#due_amount").val('').val(data.due_amount);
                        $("#select_payment_type").html('').html(data.payment_type_output);

                        // Show the payment modal
                        var add_payment_modal = document.getElementById("add_payment_modal");
                        add_payment_modal.style.display = "block";
                    }
                },
                error: function(data) {
                    // Handle any AJAX request errors if needed
                }
            });
        }
    }

    /************/

    /*Handles the submission of the refund payments form.*/
    $(document).on("submit", "#update_refund_payments", function (event) {
        // Prevent the default form submission behavior
        event.preventDefault();

        // Hide the add item modal
        $('#add_item_modal').modal('hide');

        // Create a FormData object from the form
        var form_data = new FormData($("#update_refund_payments")[0]);

        // Get the application URL
        var APP_URL = $("#APP_URL").val();

        // Perform an AJAX request to update refund payments
        $.ajax({
            url: APP_URL + '/update_refund_payments',
            data: form_data,
            type: 'post',
            contentType: false,
            processData: false,
            success: function(data) {
                // Handle the success response
                if (data === 'success') {
                    // Hide the refund payment modal
                    var refund_payment_modal = document.getElementById("refund_payment_modal");
                    refund_payment_modal.style.display = "none";

                    // Show a success message
                    swal({
                        title: "Done !",
                        text: "Refund updated successfully.",
                        type: "success",
                        timer: 1000
                    });

                    // Reload the page
                    location.reload();
                } else {
                    // Show a warning message with the error response
                    swal({
                        title: "Warning !",
                        text: data,
                        type: "error",
                        timer: 1000
                    });

                    // Optionally reload the page
                    // location.reload();
                }
            },
            error: function(data) {
                // Handle any AJAX request errors if needed
            }
        });
    });


    /************/

    /*Handles the submission of the offline payments form.*/
    $(document).on("submit", "#update_offline_payments", function (event) {
        // Prevent the default form submission behavior
        event.preventDefault();

        // Hide the add item modal
        $('#add_item_modal').modal('hide');

        // Create a FormData object from the form
        var form_data = new FormData($("#update_offline_payments")[0]);

        // Get the application URL
        var APP_URL = $("#APP_URL").val();

        // Perform an AJAX request to update offline payments
        $.ajax({
            url: APP_URL + '/update_offline_payments',
            data: form_data,
            type: 'post',
            contentType: false,
            processData: false,
            success: function(data) {
                // Handle the success response
                if (data === 'success') {
                    // Hide the add payment modal
                    var add_payment_modal = document.getElementById("add_payment_modal");
                    add_payment_modal.style.display = "none";

                    // Show a success message
                    swal({
                        title: "Done !",
                        text: "Payment updated successfully.",
                        type: "success",
                        timer: 1000
                    });

                    // Reload the page
                    location.reload();
                } else {
                    // Show a warning message with the error response
                    swal({
                        title: "Warning !",
                        text: data,
                        type: "error",
                        timer: 1000
                    });

                    // Optionally reload the page
                    // location.reload();
                }
            },
            error: function(data) {
                // Handle any AJAX request errors if needed
            }
        });
    });

    /************/

    /*Toggles the display of additional remarks and content when the button is clicked.*/
    $(document).on("click", ".btn_remarks_service", function(e) {
        // Prevent the default action of the event
        e.preventDefault();

        // Get references to the elements involved
        var addRemarks = $(this).siblings('.add_remarks');
        var btnText = $(this);
        var moreText = $(this).siblings('.add_content');

        // Toggle the display of the elements
        if (addRemarks.css('display') === "none") {
            // Show the remarks and update button text
            addRemarks.css('display', 'block');
            btnText.html('Add Remarks (+)');
            moreText.css('display', 'none');
        } else {
            // Hide the remarks and update button text
            addRemarks.css('display', 'none');
            btnText.html('Hide Remarks (-)');
            moreText.css('display', 'block');
        }
    });

    // Get all elements with the class name "accordion (collapsible)"
    //document.addEventListener("DOMContentLoaded", function() {
        // Get all elements with the class name "accordion (collapsible)"
        var coll = document.getElementsByClassName("collapsible");

        // Iterate over each accordion element
        for (var i = 0; i < coll.length; i++) {
            // Add a click event listener to each accordion element
            coll[i].addEventListener("click", function() {
                // Toggle the "active" class on the clicked accordion
                this.classList.toggle("active");

                // Get the next sibling element (the panel) of the clicked accordion
                var contents = this.nextElementSibling;

                // Check if the panel is currently open
                if (contents.style.maxHeight) {
                    // If open, close it by setting maxHeight to null
                    contents.style.maxHeight = null;
                } else {
                    // If closed, open it by setting maxHeight to its scroll height
                    contents.style.maxHeight = 'inherit';
                }
            });
        }
    //});

    /************/

    /**
     * Handles the click event on elements with the class 'service_sype'.
     * Fetches service type data based on the 'query_id' and displays it in a modal.
     */
    $(document).on("click", ".service_sype", function() {
        // Get the 'query_id' attribute from the clicked element
        var query_id = $(this).attr('query_id');

        // Get the application URL from a hidden input field
        var APP_URL = $("#APP_URL").val();

        // Make an AJAX request to fetch the service type data
        $.ajax({
            url: APP_URL + '/get_query_service_type_data',
            type: 'get',
            data: { query_id: query_id },
            success: function(data) {
                // Update the modal body with the fetched data
                $(".lead_modalbody_service_status").html('').html(data);

                // Display the service type modal
                var service_type_modal = document.getElementById("service_type_modal");
                service_type_modal.style.display = "block";

                // Initialize Select2 on elements with the 'select2' class
                $('.select2').select2();
            },
            error: function(data) {
                // Handle error (optional)
                console.error('Error fetching service type data:', data);
            }
        });
    });

    /************/

    /**
     * Handles the 'select2:select' event on the element with the ID 'service_type_select2'.
     * Fetches service type data based on the selected ID and appends it to the container.
     */
    $(document).on('select2:select', "#service_type_select2", function(e) {
        // Get the selected ID from the event parameters
        var id = e.params.data.id;
        
        // Get the application URL from a hidden input field
        var APP_URL = $("#APP_URL").val();

        // Make an AJAX request to fetch the service type data
        $.ajax({
            url: APP_URL + '/get_service_type_data',
            type: 'get',
            data: { id: id },
            success: function(data) {
                // Append the fetched data to the container with the class 'service_type_data'
                $(".service_type_data").append(data);

                // Reinitialize Select2 on any newly added elements
                $('.select2').select2();
            },
            error: function(data) {
                // Handle error (optional)
                console.error('Error fetching service type data:', data);
            }
        });
    });

    /************/

    /*Removes the corresponding service type elements when an option is unselected.*/
    $(document).on('select2:unselect', "#service_type_select2", function(e) {
        // Get the unselected ID from the event parameters
        var id = e.params.data.id;
        
        // Remove elements associated with the unselected ID
        $("#services_type_" + id).remove();
        $("#services_type_content_" + id).remove();
    });

    /************/

    /*Handles form submission for updating service status.*/
    $(document).on("submit", "#update_service_status", function (event) {

        // Prevent the default form submission behavior
        event.preventDefault();

        // Hide the add item modal
        $('#add_item_modal').modal('hide');
      
        // Create a FormData object from the form element
        var form_data = new FormData($("#update_service_status")[0]);
        var APP_URL = $("#APP_URL").val(); // Get the application URL

        // Perform an AJAX request to update the service status
        $.ajax({
            url: APP_URL + '/update_service_status', // URL for the AJAX request
            data: form_data, // Form data to send with the request
            type: 'post', // Request method
            contentType: false, // Do not set Content-Type header
            processData: false, // Do not process the data

            success: function(data) {
                // If the response indicates success
                if (data == 'success') {
                    var service_type_modal = document.getElementById("service_type_modal");
                    service_type_modal.style.display = "none"; // Hide the service type modal

                    // Display a success notification
                    swal({
                        title: "Done !",
                        text: "Service updated successfully.",
                        type: "success",
                        timer: 1000
                    });

                    // Reload the page to reflect the changes
                    location.reload();
                } else {
                    // Display a warning notification if there was an error
                    swal({
                        title: "Warning !",
                        text: "Error",
                        type: "error",
                        timer: 1000
                    });

                    // Optionally reload the page or take other actions
                    // location.reload();        
                }
            },
            error: function(data) {
                // Handle any errors here (currently empty)
            }
        });
    });

    /************/
    /************/

    /*$(document).on('change','.query_status',function(){
    // $(".query_status").bind( "click change", function() {

        var status_value=$(this).val()
        var id =$(this).parent().attr('id')    

        if(status_value=='lead_cancelled')
        {
            cancel_lead_follow_up_data(id)
        }
        else if(status_value=='tour_cancelled')
        {
       cancel_tour_follow_up_data(id)     
        }
         else if(status_value=='refund_under_process')
        {
       refund_under_process_data(id)     
        }
        else if(status_value=='add_lead_follow_up' || status_value=='lead_follow_up')
        {
            add_lead_follow_up_data(id)
        }
        else if(status_value=='payment_follow_up')
        {
            add_payment_follow_up(id)
        }
        else if(status_value=='voucher_issued')
        {
            voucher_issued_remarks(id)
        }
        else
        {
            $.ajax({
                url:APP_URL+'/query_status',
                type:'POST',
                data:{id:id,status_value:status_value},
                success:function(data)
                {
                if(data=='na')
                 {
                    swal({
             title: "Done !",
             text: "Status Successfully Changed",
             type: "success",
             timer: 2000
             });

                  setTimeout(function(){
           window.location.reload(1);
            }, 2000);

              }
             else if(data=='to_pending')
             {
             swal({
                 title: "Done !",
                 text: "Lead has moved into Pending Quote",
                 type: "success",
                 timer: 2000
                 });

                        setTimeout(function(){
               window.location.reload(1);
            }, 2000);
             }
             else if(data=='issue_voucher')
             {
             swal({
                 title: "Done !",
                 text: "The lead has moved into Issue Voucher",
                 type: "success",
                 timer: 2000
                 });

                        setTimeout(function(){
               window.location.reload(1);
            }, 2000);
            }
             else if(data=='voucher_issued')
             {
         swal({
             title: "Done !",
             text: "This lead has moved into Tour Vouchered",
             type: "success",
             timer: 2000
             });

                    setTimeout(function(){
           window.location.reload(1);
            }, 2000);
             }
             else if(data=='tour_cancelled')
             {
             swal({
                 title: "Done !",
                 text: "This lead has moved into Tour Cancelled",
                 type: "success",
                 timer: 2000
                 });

                        setTimeout(function(){
               window.location.reload(1);
            }, 2000);
             }
             else if(data=='under_cancellation')
             {
             swal({
                 title: "Done !",
                 text: "This lead has moved into Under Cancellation",
                 type: "success",
                 timer: 3000
                 });

                        setTimeout(function(){
               window.location.reload(1);
            }, 3000);
             }
             else if(data=='tour_completed')
             {
             swal({
                 title: "Done !",
                 text: "The Lead has moved into Tour Completed",
                 type: "success",
                 timer: 2000
                 });

                        setTimeout(function(){
               window.location.reload(1);
            }, 2000);
             }
            else if(data=='to_web_lead')
             {
             swal({
                 title: "Done !",
                 text: "Lead has moved into Web Leads",
                 type: "success",
                 timer: 2000
                 });

                        setTimeout(function(){
               window.location.reload(1);
            }, 2000);
             }},
             error:function(data)
                    {
                    }
                })   
        }
        // swal("Done !", 'Thank you! Enquiry submitted successfully', "success");
        // $.ajax({
        //     url:APP_URL+'/query_status',
        //     type:'POST',
        //     data:{id:id,status_value:status_value},
        //     success:function(data)
        //     {
        //      alert("Status Successfully Changed")
        //     },
        //     error:function(data)
        //     {

        //     }
        // })
        })*/


    /*Handles changes to the query status dropdown.*/
    /*$(document).on('change', '.query_status', function() {

        // Get the selected status value and the ID of the parent element
        var status_value = $(this).val();
        var id = $(this).parent().attr('id');
        
        // Execute different functions based on the selected status value
        switch (status_value) {
            case 'lead_cancelled':
                cancel_lead_follow_up_data(id);
                break;
            case 'tour_cancelled':
                cancel_tour_follow_up_data(id);
                break;
            case 'refund_under_process':
                refund_under_process_data(id);
                break;
            case 'add_lead_follow_up':
            case 'lead_follow_up':
                add_lead_follow_up_data(id);
                break;
            case 'payment_follow_up':
                add_payment_follow_up(id);
                break;
            case 'voucher_issued':
                voucher_issued_remarks(id);
                break;
            default:
                // Handle the default case by sending an AJAX request
                $.ajax({
                    url: APP_URL + '/query_status',
                    type: 'POST',
                    data: { id: id, status_value: status_value },
                    dataType: 'json',  // Ensure the response is treated as JSON
                    success: function(data) {
                        // Define success messages based on the response
                        var messages = {
                            'na': 'Status Successfully Changed',
                            'to_pending': 'This lead has moved into "Pending Quote"',
                            'issue_voucher': 'This lead has moved into "Issue Voucher"',
                            'voucher_issued': 'This lead has moved into "Tour Vouchered"',
                            'tour_cancelled': 'This lead has moved into "Tour Cancelled"',
                            'under_cancellation': 'This lead has moved into "Under Cancellation"',
                            'tour_completed': 'The lead has moved into "Tour Completed"',
                            'to_web_lead': 'This lead has moved into "Web Leads"'
                        };

                        // Check if the response is in the messages object
                        if (messages[data]) {
                            swal({
                                title: "Done !",
                                text: messages[data],
                                type: "success",
                                timer: data === 'under_cancellation' ? 3000 : 2000
                            });

                            // Reload the page after a delay
                            setTimeout(function() {
                                window.location.reload(1);
                            }, data === 'under_cancellation' ? 3000 : 2000);
                        }
                    },
                    error: function(data) {
                        // Handle any errors here (currently empty)
                    }
                });
                break;
        }
    });*/
    

    $(document).on('change', '.query_status', function() {
        var status_value = $(this).val();
        var id = $(this).parent().parent().parent().attr('id');
var enquiry_ref_no =  $(this).parent().parent().parent().attr('enquiry_ref_no');
var quote_ref_no =  $(this).parent().parent().parent().attr('quote_ref_no');

        switch (status_value) {
            case 'lead_cancelled':
                cancel_lead_follow_up_data(id,enquiry_ref_no,quote_ref_no);
                break;
            case 'tour_cancelled':
                cancel_tour_follow_up_data(id);
                break;
            case 'refund_under_process':
                refund_under_process_data(id);
                break;
            case 'add_lead_follow_up':
            case 'lead_follow_up':
                add_lead_follow_up_data(id,enquiry_ref_no,quote_ref_no);
                break;
            case 'payment_follow_up':
                add_payment_follow_up(id);
                break;
            case 'voucher_issued':
                voucher_issued_remarks(id);
                break;
            default:
                $.ajax({
                    url: APP_URL + '/lead_varified',
                    type: 'POST',
                    data: { id: id, status_value: status_value },
                    dataType: 'json', // Expect JSON response
                    success: function(response) {
                        // Define success messages based on response
                        var messages = {
                            'na': 'Status Successfully Changed',
                            'to_pending': 'This lead has moved into "Pending Quote"',
                            'issue_voucher': 'This lead has moved into "Issue Voucher"',
                            'voucher_issued': 'This lead has moved into "Tour Vouchered"',
                            'tour_cancelled': 'This lead has moved into "Tour Cancelled"',
                            'under_cancellation': 'This lead has moved into "Under Cancellation"',
                            'tour_completed': 'The lead has moved into "Tour Completed"',
                            'to_web_lead': 'This lead has moved into "Web Leads"'
                        };

                        // Check if the response is in the messages object
                        if (messages[response.status]) {
                            swal({
                                title: "Done!",
                                text: messages[response.status],
                                type: "success",
                                timer: 2000
                            });

                            setTimeout(function() {
                                window.location.reload();
                            }, 2000);
                        } else if (response.error) {
                            swal({
                                title: "Error!",
                                text: response.error,
                                type: "error",
                                timer: 2000
                            });
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = "Something went wrong. Please try again.";

    
    if (xhr.responseJSON && xhr.responseJSON.error) {
        errorMessage = xhr.responseJSON.error;
    }

    swal({
        title: "Error!",
        text: errorMessage,
        type: "error",
        timer: 2500,
        showConfirmButton: false
    });
    selectpreviousstatus(id)
    
                    }
                });
                break;
        }
    });


    /************/

    /*Handles refund under process data.*/
    function refund_under_process_data(id) {
        $("#query_id_refund_under_process").val(id); // Set the query ID in the hidden input field

        $.ajax({
            url: APP_URL + '/cancel_lead_follow_up_data',
            type: 'get',
            data: { id: 2 },
            success: function(data) {
                // Populate the modal with the response data
                $("#assign_person_refund_under_process").html(data.emp);

                // Display the modal
                var refund_under_process_modal = document.getElementById("refund_under_process_modal");
                refund_under_process_modal.style.display = "block";
            },
            error: function(data) {
                // Handle errors if necessary
            }
        });
    }

    /************/

    /*Handles cancellation of tour follow-up data.*/
    function cancel_tour_follow_up_data(id) {
        $("#query_id_tour_cancel").val(id); // Set the query ID in the hidden input field

        $.ajax({
            url: APP_URL + '/cancel_lead_follow_up_data',
            type: 'get',
            data: { id: 2 },
            success: function(data) {
                // Populate the modal with the response data
                $("#tour_cancel_reason").html(data.output);
                $("#assign_person_cancel_tour").html(data.emp);

                // Display the modal
                var tour_cancelled_modal = document.getElementById("tour_cancelled_modal");
                tour_cancelled_modal.style.display = "block";
            },
            error: function(data) {
                // Handle errors if necessary
            }
        });
    }

    /************/

    /*Handles cancellation of lead follow-up data.*/
    function cancel_lead_follow_up_data(id,enquiry_ref_no,quote_ref_no) {
        $("#query_id_lead_cancel").val(id); // Set the query ID in the hidden input field
$(".enq_ref_no").html(enquiry_ref_no);
$(".quote_ref_no").html(quote_ref_no);

        $.ajax({
            url: APP_URL + '/cancel_lead_follow_up_data',
            type: 'get',
            data: { id: 2 },
            success: function(data) {
                // Populate the modal with the response data
                $("#lead_cancel_reason").html(data.output);
                $("#assign_person_cancel_lead").html(data.emp);

                // Display the modal
                var lead_cancelled_modal = document.getElementById("lead_cancelled_modal");
                lead_cancelled_modal.style.display = "block";
            },
            error: function(data) {
                // Handle errors if necessary
            }
        });
    }

    /************/

    /*Fetches and displays voucher issued remarks based on the provided ID.*/
    function voucher_issued_remarks(id) {
        // Set the query ID in the form field
        $("#query_id_issue_voucher").val('').val(id);

        // Make an AJAX request to fetch the voucher issued remarks
        $.ajax({
            url: APP_URL + '/voucher_issued_remarks', // URL for the AJAX request
            type: 'get', // Request method
            data: { id: id }, // Data to send with the request
            success: function(data) {
                // Update the HTML of the assign person field with the response data
                $("#assign_person_issue_voucher").html('').html(data.emp);

                // Display the issue voucher modal
                var issue_voucher_modal = document.getElementById("issue_voucher_modal");
                issue_voucher_modal.style.display = "block";
            },
            error: function(data) {
                // Handle any errors here (currently empty)
            }
        });
    }

    /************/

    /*Handles adding payment follow-up data.*/
    function add_payment_follow_up(id) {
        $("#query_id_payment_follow_up").val(id); // Set the query ID in the hidden input field

        $.ajax({
            url: APP_URL + '/add_payment_follow_up',
            type: 'get',
            data: { id: id },
            success: function(data) {
                // Populate the modal with the response data
                $("#payment_follow_up_reason").html(data.output);

                // Display the modal
                var payment_follow_up_modal = document.getElementById("payment_follow_up_modal");
                payment_follow_up_modal.style.display = "block";
            },
            error: function(data) {
                // Handle errors if necessary
            }
        });
    }

    /************/

    $(document).on("submit", "#payment_follow_up", function(event) {
        event.preventDefault(); // Prevent default form submission

        $('#add_item_modal').modal('hide'); // Hide the modal

        var form_data = new FormData($("#payment_follow_up")[0]);
        var APP_URL = $("#APP_URL").val();

        $.ajax({
            url: APP_URL + '/update_payment_follow_up',
            data: form_data,
            type: 'post',
            contentType: false,
            processData: false,
            success: function(data) {
                if (data === 'success') {
                    var payment_follow_up_modal = document.getElementById("payment_follow_up_modal");
                    payment_follow_up_modal.style.display = "none";

                    swal({
                        title: "Done !",
                        text: "Successfully Added.",
                        type: "success",
                        timer: 1000
                    });

                    location.reload(); // Reload the page
                } else {
                    swal({
                        title: "Warning !",
                        text: data,
                        type: "error",
                        timer: 1000
                    });

                    // Optionally reload the page or handle the error
                }
            },
            error: function(data) {
                // Handle errors if necessary
            }
        });
    });

    /************/

    /*Handles adding lead follow-up data.*/
    function add_lead_follow_up_data(id,enquiry_ref_no,quote_ref_no) {
        $("#query_id_lead_follow_up").val(id); // Set the query ID in the hidden input field
$(".enq_ref_no").html(enquiry_ref_no);
$(".quote_ref_no").html(quote_ref_no);

        $.ajax({
            url: APP_URL + '/add_lead_follow_up_data',
            type: 'get',
            data: { id: id },
            success: function(data) {
                // Populate the modal with the response data
                $("#follow_up_reason").html(data.output);
                $("#assign_person").html(data.emp);
                console.log(data.output);

                // Display the modal
                var lead_follow_up_modal = document.getElementById("lead_follow_up_modal");
                lead_follow_up_modal.style.display = "block";
            },
            error: function(data) {
                // Handle errors if necessary
            }
        });
    }

    /************/

    /*// Event handler for change event on elements with class 'booking_label'
    $(document).on('change', '.booking_label', function() {

        // Get the value of the booking label
        var booking_label = $(this).val();
        
        // Get the ID of the parent element
        var id = $(this).parent().attr('id');
        
        // Confirm dialog to verify details with the guest
        var r = confirm("Have you confirmed all the details with the guest?");
        
        // Make an AJAX request to update the booking label
        $.ajax({
            url: APP_URL + '/update_booking_label', // URL to send the request to
            type: 'POST', // Request type
            data: { id: id, booking_label: booking_label }, // Data to send in the request
            success: function(data) {
                // Success handler: show a success message
                swal({
                    title: "Done!",
                    text: "Successfully updated.",
                    type: "success",
                    timer: 1000
                });
            },
            error: function(data) {
                // Error handler: currently empty
            }
        });
    });*/

    $(document).on('change', '.booking_label', function() {
        // Get the value of the booking label
        var booking_label = $(this).val();
        
        // Get the ID of the parent element
        var id = $(this).closest('div.dashboard-inner-table').parent().attr('id');
        
        // Confirm dialog to verify details with the guest
        var r = confirm("Have you confirmed all the details with the guest?");
        if (!r) return; // Exit if the user did not confirm

        // Make an AJAX request to update the booking label
        $.ajax({
            url: APP_URL + '/update_booking_label', // URL to send the request to
            type: 'POST', // Request type
            data: { id: id, booking_label: booking_label }, // Data to send in the request
            success: function(data) {
                // Success handler: show a success message
                swal({
                    title: "Done!",
                    text: "Successfully updated.",
                    icon: "success",
                    timer: 1000
                });
            },
            error: function(data) {
                // Error handler: currently empty
                console.log('Error:', data);
            }
        });
    });

    /************/

    /*// Event handler for change event on elements with class 'user_assign'
    $(document).on('change', '.user_assign', function() {

        // Get the value of the role assignment
        var assign_id = $(this).val();
        
        // Get the ID of the parent element
        var id = $(this).parent().attr('id');
        
        // Make an AJAX request to assign the role
        $.ajax({
            url: APP_URL + '/user_assign', // URL to send the request to
            type: 'POST', // Request type
            data: { id: id, assign_id: assign_id }, // Data to send in the request
            success: function(data) {
                // Success handler: show an alert message
                alert("User has been assigned successfully for this lead");
            },
            error: function(data) {
                // Error handler: currently empty
            }
        });
    });*/

    /*$(document).on('change', '.user_assign', function() {
        // Get the value of the user assignment
        var assign_id = $(this).val();
        
        // Get the ID of the parent element
        var id = $(this).closest('td').attr('id');
        console.log('Assign ID:', assign_id, 'Parent ID:', id); // Debugging
        
        // Make an AJAX request to assign the user
        $.ajax({
            url: APP_URL + '/user_assign', // URL to send the request to
            type: 'POST', // Request type
            data: { id: id, assign_id: assign_id }, // Data to send in the request
            success: function(data) {
                // Success handler: show an alert message
                alert("User has been assigned successfully for this lead");
            },
            error: function(data) {
                // Error handler: currently empty
            }
        });
    });*/

    $(document).on('change', '.user_assign', function() {
        // Get the value of the user assignment
        var assign_id = $(this).val();
        
        // Get the ID of the parent element
        var id = $(this).closest('td').attr('id');
        console.log('Assign ID:', assign_id, 'Parent ID:', id); // Debugging
        
        // Make an AJAX request to assign the user
        $.ajax({
            url: APP_URL + '/user_assign', // URL to send the request to
            type: 'POST', // Request type
            data: { id: id, assign_id: assign_id }, // Data to send in the request
            success: function(data) {
                // Success handler: show a success message using SweetAlert
                swal({
                    title: "Success!",
                    text: "User has been assigned successfully for this lead.",
                    icon: "success",
                    timer: 2000,
                    buttons: false
                });
            },
            error: function(data) {
                // Error handler: show an error message using SweetAlert
                swal({
                    title: "Error!",
                    text: "An error occurred while assigning the user.",
                    icon: "error",
                    timer: 2000,
                    buttons: false
                });
            }
        });
    });

    /************/

    // Event handler for change event on elements with class 'lead_varified'
    $(document).on('change', '.lead_varified', function() {

        // Get the value of the lead verification status
        var status_value = $(this).val();
        
        // Get the ID of the parent element
        var id = $(this).parent().parent().attr('id');
        var parent_html=$(this).parent().parent().parent()
        //var id = $(this).closest('.dashboard-inner-table').attr('id');
        //var id = $(this).parent().parent().attr('id');
        
        // Confirm dialog to verify details with the guest
        var r = confirm("Have you confirmed all the details with the guest?");
        
        if (r === true) {
            // If status value is "1", hide the parent element
            // if (status_value === "1") {
            //     parent_html.css("display", "none");
            // }

            // Make an AJAX request to update the lead verification status
            $.ajax({
                url: APP_URL + '/lead_varified', // URL to send the request to
                type: 'POST', // Request type
                data: { id: id, status_value: status_value }, // Data to send in the request
                success: function(data) {
                    console.log(data)
                     parent_html.css("display", "none");
                    // Success handler: show a success message
                    swal({
                        title: "Done!",
                        text: "This Lead has moved into Pending Quote",
                        type: "success",
                        timer: 2000
                    });
                },
                error: function(xhr, status, error) {
                   console.log("XHR Response:", xhr.responseText);
                   let jsonResponse = JSON.parse(xhr.responseText);
                
                    swal({
                        title: "Error !",
                        text: jsonResponse.error,
                        type: "error",
                        timer: 2000
                    });

                }
            });
        } else {
            // If the user cancels, reload the page
            location.reload();
        }
    });

    /************/

    // Event handler for click event on elements with class 'unverified'
    $(document).on('click', '.unverified', function() {

        // Get the ID of the clicked element
        var id = $(this).attr('id');
        
        // Confirm dialog to unverify details with the guest
        var r = confirm("Have you confirmed all the details with the guest?");
        
        if (r === true) {
            // Hide the parent element of the clicked element
            $(this).parent().parent().css("display", "none");
            
            // Make an AJAX request to mark the lead as unverified
            $.ajax({
                url: APP_URL + '/lead_unvarified', // URL to send the request to
                type: 'POST', // Request type
                data: { id: id }, // Data to send in the request
                success: function(data) {
                    // Success handler: currently empty
                },
                error: function(data) {
                    // Error handler: currently empty
                }
            });
        } else {
            // If the user cancels, reload the page
            location.reload();
        }
    });

    /************/

    // Event handler for keyup event on elements with class 'flight_name'
    $(document).on("keyup", ".flight_name", function() {
        // Get the value of the flight name input
        var flight_name = $(this).val();
        
        // Set the value of sibling input with class 'down_filght' to the flight name
        $(this).parent().siblings().children(".down_filght").val("").val(flight_name);
    });

    // Event handler for keyup event on elements with class 'flight_no'
    $(document).on("keyup", ".flight_no", function() {
        // Get the value of the flight number input
        var flight_no = $(this).val();
        
        // Set the value of sibling input with class 'down_no' to the flight number
        $(this).parent().siblings().children(".down_no").val("").val(flight_no);
    });

    // Event handler for keyup event on elements with class 'flight_origin'
    $(document).on("keyup", ".flight_origin", function() {
        // Get the value of the flight origin input
        var flight_origin = $(this).val();
        
        // Set the value of sibling input with class 'down_dest' to the flight origin
        $(this).parent().siblings().children(".down_dest").val("").val(flight_origin);
    });

    // Event handler for keyup event on elements with class 'flight_dest'
    $(document).on("keyup", ".flight_dest", function() {
        // Get the value of the flight destination input
        var flight_dest = $(this).val();
        
        // Set the value of sibling input with class 'down_origin' to the flight destination
        $(this).parent().siblings().children(".down_origin").val("").val(flight_dest);
    });

    /************/

    /*$(document).on("change",".price_type",function(){
        var price_type=$(this).val();

        if(price_type=="Group Price")
        {
          $(this).parent().siblings(".anything").css("visibility","visible")
        }
        else
        {
         $(this).parent().siblings(".anything").css("visibility","hidden")
        }
    })*/
    //
    $(document).on('keyup','.query_air_adult',function()
    {
        var query_air_adult=$(this).val();
        var query_hotel_adult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_adult").val()
        var query_tours_adult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_adult").val()
        var query_transfer_adult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_adult").val()
        var query_visa_adult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_adult").val()
        var query_inc_adult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_adult").val()
        var query_discount_adult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_adult").val()
        var query_gst_adult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_adult").val()
        //extra start
        var query_cruise_adult=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_adult").val()
        var query_meals_adult=$(this).parent().parent().parent().children("tr").children().children(".query_meals_adult").val()
        var query_markup_adult=$(this).parent().parent().parent().children("tr").children().children(".query_markup_adult").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_adult*query_air_curr)+parseFloat(query_hotel_adult*query_hotel_curr)+parseFloat(query_tours_adult*query_tours_curr)+parseFloat(query_transfer_adult*query_transfer_curr)+parseFloat(query_visa_adult*query_visa_curr)+parseFloat(query_inc_adult*query_inc_curr)+parseFloat(query_gst_adult*query_gst_curr)+parseFloat(query_cruise_adult*query_cruise_curr)+parseFloat(query_meals_adult*query_meals_curr)+parseFloat(query_markup_adult*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_adult/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_adult").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_adult
        
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_adult").val("").val(total_grand)
    });
    //
    $(document).on('keyup','.query_hotel_adult',function()
    {
        var query_hotel_adult=$(this).val();
        var query_air_adult=$(this).parent().parent().parent().children("tr").children().children(".query_air_adult").val()
        var query_tours_adult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_adult").val()
        var query_transfer_adult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_adult").val()
        var query_visa_adult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_adult").val()
        var query_inc_adult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_adult").val()
        var query_discount_adult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_adult").val()
        var query_gst_adult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_adult").val()
        //extra start
        var query_cruise_adult=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_adult").val()
        var query_meals_adult=$(this).parent().parent().parent().children("tr").children().children(".query_meals_adult").val()
        var query_markup_adult=$(this).parent().parent().parent().children("tr").children().children(".query_markup_adult").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_adult*query_air_curr)+parseFloat(query_hotel_adult*query_hotel_curr)+parseFloat(query_tours_adult*query_tours_curr)+parseFloat(query_transfer_adult*query_transfer_curr)+parseFloat(query_visa_adult*query_visa_curr)+parseFloat(query_inc_adult*query_inc_curr)+parseFloat(query_gst_adult*query_gst_curr)+parseFloat(query_cruise_adult*query_cruise_curr)+parseFloat(query_meals_adult*query_meals_curr)+parseFloat(query_markup_adult*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_adult/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_adult").val("").val(total)
       var total_grand=parseFloat(total)-query_discount_adult
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_adult").val("").val(total_grand)
    });
    //
    $(document).on('keyup','.query_tours_adult',function()
    {
        var query_tours_adult=$(this).val();
        var query_air_adult=$(this).parent().parent().parent().children("tr").children().children(".query_air_adult").val()
        var query_hotel_adult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_adult").val()
        var query_transfer_adult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_adult").val()
        var query_visa_adult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_adult").val()
        var query_inc_adult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_adult").val()
        var query_discount_adult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_adult").val()
        var query_gst_adult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_adult").val()
        //extra start
        var query_cruise_adult=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_adult").val()
        var query_meals_adult=$(this).parent().parent().parent().children("tr").children().children(".query_meals_adult").val()
        var query_markup_adult=$(this).parent().parent().parent().children("tr").children().children(".query_markup_adult").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_adult*query_air_curr)+parseFloat(query_hotel_adult*query_hotel_curr)+parseFloat(query_tours_adult*query_tours_curr)+parseFloat(query_transfer_adult*query_transfer_curr)+parseFloat(query_visa_adult*query_visa_curr)+parseFloat(query_inc_adult*query_inc_curr)+parseFloat(query_gst_adult*query_gst_curr)+parseFloat(query_cruise_adult*query_cruise_curr)+parseFloat(query_meals_adult*query_meals_curr)+parseFloat(query_markup_adult*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_adult/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_adult").val("").val(total)
       var total_grand=parseFloat(total)-query_discount_adult
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_adult").val("").val(total_grand)
    });
    //
    $(document).on('keyup','.query_transfer_adult',function()
    {
        var query_transfer_adult=$(this).val();
        var query_air_adult=$(this).parent().parent().parent().children("tr").children().children(".query_air_adult").val()
        var query_hotel_adult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_adult").val()
        var query_tours_adult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_adult").val()
        var query_visa_adult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_adult").val()
        var query_inc_adult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_adult").val()
        var query_discount_adult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_adult").val()
        var query_gst_adult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_adult").val()
        //extra start
        var query_cruise_adult=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_adult").val()
        var query_meals_adult=$(this).parent().parent().parent().children("tr").children().children(".query_meals_adult").val()
        var query_markup_adult=$(this).parent().parent().parent().children("tr").children().children(".query_markup_adult").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
         var total=parseFloat(query_air_adult*query_air_curr)+parseFloat(query_hotel_adult*query_hotel_curr)+parseFloat(query_tours_adult*query_tours_curr)+parseFloat(query_transfer_adult*query_transfer_curr)+parseFloat(query_visa_adult*query_visa_curr)+parseFloat(query_inc_adult*query_inc_curr)+parseFloat(query_gst_adult*query_gst_curr)+parseFloat(query_cruise_adult*query_cruise_curr)+parseFloat(query_meals_adult*query_meals_curr)+parseFloat(query_markup_adult*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_adult/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_adult").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_adult
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_adult").val("").val(total_grand)
    });
    //
    $(document).on('keyup','.query_visa_adult',function()
    {
        var query_visa_adult=$(this).val();
        var query_air_adult=$(this).parent().parent().parent().children("tr").children().children(".query_air_adult").val()
        var query_hotel_adult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_adult").val()
        var query_tours_adult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_adult").val()
        var query_transfer_adult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_adult").val()
        var query_inc_adult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_adult").val()
        var query_discount_adult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_adult").val()
        var query_gst_adult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_adult").val()
         //extra start
        var query_cruise_adult=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_adult").val()
        var query_meals_adult=$(this).parent().parent().parent().children("tr").children().children(".query_meals_adult").val()
        var query_markup_adult=$(this).parent().parent().parent().children("tr").children().children(".query_markup_adult").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_adult*query_air_curr)+parseFloat(query_hotel_adult*query_hotel_curr)+parseFloat(query_tours_adult*query_tours_curr)+parseFloat(query_transfer_adult*query_transfer_curr)+parseFloat(query_visa_adult*query_visa_curr)+parseFloat(query_inc_adult*query_inc_curr)+parseFloat(query_gst_adult*query_gst_curr)+parseFloat(query_cruise_adult*query_cruise_curr)+parseFloat(query_meals_adult*query_meals_curr)+parseFloat(query_markup_adult*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_adult/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_adult").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_adult
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_adult").val("").val(total_grand)
    });
    //
    $(document).on('keyup','.query_inc_adult',function()
    {
        var query_inc_adult=$(this).val();
        var query_air_adult=$(this).parent().parent().parent().children("tr").children().children(".query_air_adult").val()
        var query_hotel_adult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_adult").val()
        var query_tours_adult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_adult").val()
        var query_transfer_adult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_adult").val()
        var query_visa_adult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_adult").val()
        var query_discount_adult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_adult").val()
        var query_gst_adult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_adult").val()
        //extra start
        var query_cruise_adult=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_adult").val()
        var query_meals_adult=$(this).parent().parent().parent().children("tr").children().children(".query_meals_adult").val()
        var query_markup_adult=$(this).parent().parent().parent().children("tr").children().children(".query_markup_adult").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_adult*query_air_curr)+parseFloat(query_hotel_adult*query_hotel_curr)+parseFloat(query_tours_adult*query_tours_curr)+parseFloat(query_transfer_adult*query_transfer_curr)+parseFloat(query_visa_adult*query_visa_curr)+parseFloat(query_inc_adult*query_inc_curr)+parseFloat(query_gst_adult*query_gst_curr)+parseFloat(query_cruise_adult*query_cruise_curr)+parseFloat(query_meals_adult*query_meals_curr)+parseFloat(query_markup_adult*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_adult/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_adult").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_adult
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_adult").val("").val(total_grand)
    });
    //
    $(document).on('keyup','.query_discount_adult',function()
    {
        var query_discount_adult=$(this).val();
        var query_air_adult=$(this).parent().parent().parent().children("tr").children().children(".query_air_adult").val()
        var query_hotel_adult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_adult").val()
        var query_tours_adult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_adult").val()
        var query_transfer_adult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_adult").val()
        var query_visa_adult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_adult").val()
        var query_inc_adult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_adult").val()
        var query_gst_adult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_adult").val()
         //extra start
        var query_cruise_adult=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_adult").val()
        var query_meals_adult=$(this).parent().parent().parent().children("tr").children().children(".query_meals_adult").val()
        var query_markup_adult=$(this).parent().parent().parent().children("tr").children().children(".query_markup_adult").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
         //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
         var total=parseFloat(query_air_adult*query_air_curr)+parseFloat(query_hotel_adult*query_hotel_curr)+parseFloat(query_tours_adult*query_tours_curr)+parseFloat(query_transfer_adult*query_transfer_curr)+parseFloat(query_visa_adult*query_visa_curr)+parseFloat(query_inc_adult*query_inc_curr)+parseFloat(query_gst_adult*query_gst_curr)+parseFloat(query_cruise_adult*query_cruise_curr)+parseFloat(query_meals_adult*query_meals_curr)+parseFloat(query_markup_adult*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_adult/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_adult").val("").val(total)
       var total_grand=parseFloat(total)-query_discount_adult
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_adult").val("").val(total_grand)
    });
    //
    $(document).on('keyup','.query_gst_adult',function()
    {
        var query_gst_adult=$(this).val();
        var query_air_adult=$(this).parent().parent().parent().children("tr").children().children(".query_air_adult").val()
        var query_hotel_adult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_adult").val()
        var query_tours_adult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_adult").val()
        var query_transfer_adult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_adult").val()
        var query_visa_adult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_adult").val()
        var query_inc_adult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_adult").val()
        var query_discount_adult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_adult").val()
         //extra start
        var query_cruise_adult=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_adult").val()
        var query_meals_adult=$(this).parent().parent().parent().children("tr").children().children(".query_meals_adult").val()
        var query_markup_adult=$(this).parent().parent().parent().children("tr").children().children(".query_markup_adult").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_adult*query_air_curr)+parseFloat(query_hotel_adult*query_hotel_curr)+parseFloat(query_tours_adult*query_tours_curr)+parseFloat(query_transfer_adult*query_transfer_curr)+parseFloat(query_visa_adult*query_visa_curr)+parseFloat(query_inc_adult*query_inc_curr)+parseFloat(query_gst_adult*query_gst_curr)+parseFloat(query_cruise_adult*query_cruise_curr)+parseFloat(query_meals_adult*query_meals_curr)+parseFloat(query_markup_adult*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_adult/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_adult").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_adult
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_adult").val("").val(total_grand)
    });
    $(document).on('keyup','.query_cruise_adult',function()
    {  
        var query_gst_adult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_adult").val()
        var query_air_adult=$(this).parent().parent().parent().children("tr").children().children(".query_air_adult").val()
        var query_hotel_adult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_adult").val()
        var query_tours_adult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_adult").val()
        var query_transfer_adult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_adult").val()
        var query_visa_adult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_adult").val()
        var query_inc_adult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_adult").val()
        var query_discount_adult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_adult").val()
         //extra start
        var query_cruise_adult=$(this).val();
        var query_meals_adult=$(this).parent().parent().parent().children("tr").children().children(".query_meals_adult").val()
        var query_markup_adult=$(this).parent().parent().parent().children("tr").children().children(".query_markup_adult").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_adult*query_air_curr)+parseFloat(query_hotel_adult*query_hotel_curr)+parseFloat(query_tours_adult*query_tours_curr)+parseFloat(query_transfer_adult*query_transfer_curr)+parseFloat(query_visa_adult*query_visa_curr)+parseFloat(query_inc_adult*query_inc_curr)+parseFloat(query_gst_adult*query_gst_curr)+parseFloat(query_cruise_adult*query_cruise_curr)+parseFloat(query_meals_adult*query_meals_curr)+parseFloat(query_markup_adult*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_adult/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_adult").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_adult
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_adult").val("").val(total_grand)
        
    });
    $(document).on('keyup','.query_meals_adult',function()
    {
        var query_gst_adult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_adult").val()
        var query_air_adult=$(this).parent().parent().parent().children("tr").children().children(".query_air_adult").val()
        var query_hotel_adult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_adult").val()
        var query_tours_adult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_adult").val()
        var query_transfer_adult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_adult").val()
        var query_visa_adult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_adult").val()
        var query_inc_adult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_adult").val()
        var query_discount_adult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_adult").val()
         //extra start
        var query_cruise_adult=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_adult").val()
        var query_meals_adult=$(this).val();
        var query_markup_adult=$(this).parent().parent().parent().children("tr").children().children(".query_markup_adult").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_adult*query_air_curr)+parseFloat(query_hotel_adult*query_hotel_curr)+parseFloat(query_tours_adult*query_tours_curr)+parseFloat(query_transfer_adult*query_transfer_curr)+parseFloat(query_visa_adult*query_visa_curr)+parseFloat(query_inc_adult*query_inc_curr)+parseFloat(query_gst_adult*query_gst_curr)+parseFloat(query_cruise_adult*query_cruise_curr)+parseFloat(query_meals_adult*query_meals_curr)+parseFloat(query_markup_adult*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_adult/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_adult").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_adult
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_adult").val("").val(total_grand)
        
    });
    $(document).on('keyup','.query_markup_adult',function()
    {   
        var query_gst_adult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_adult").val()
        var query_air_adult=$(this).parent().parent().parent().children("tr").children().children(".query_air_adult").val()
        var query_hotel_adult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_adult").val()
        var query_tours_adult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_adult").val()
        var query_transfer_adult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_adult").val()
        var query_visa_adult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_adult").val()
        var query_inc_adult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_adult").val()
        var query_discount_adult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_adult").val()
         //extra start
        var query_cruise_adult=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_adult").val()
        var query_meals_adult=$(this).parent().parent().parent().children("tr").children().children(".query_meals_adult").val()
        var query_markup_adult=$(this).val();
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_adult*query_air_curr)+parseFloat(query_hotel_adult*query_hotel_curr)+parseFloat(query_tours_adult*query_tours_curr)+parseFloat(query_transfer_adult*query_transfer_curr)+parseFloat(query_visa_adult*query_visa_curr)+parseFloat(query_inc_adult*query_inc_curr)+parseFloat(query_gst_adult*query_gst_curr)+parseFloat(query_cruise_adult*query_cruise_curr)+parseFloat(query_meals_adult*query_meals_curr)+parseFloat(query_markup_adult*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_adult/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_adult").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_adult
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_adult").val("").val(total_grand)
        
    });
    //column 2 start
    $(document).on('keyup','.query_air_exadult',function()
    {
        var query_air_exadult=$(this).val();
        var query_hotel_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_exadult").val()
        var query_tours_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_exadult").val()
        var query_transfer_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_exadult").val()
        var query_visa_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_exadult").val()
        var query_inc_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_exadult").val()
        var query_discount_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_exadult").val()
        var query_gst_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_exadult").val()
        //extra start
        var query_cruise_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_exadult").val()
        var query_meals_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_meals_exadult").val()
        var query_markup_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_markup_exadult").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
         //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
      
        var total=parseFloat(query_air_exadult*query_air_curr)+parseFloat(query_hotel_exadult*query_hotel_curr)+parseFloat(query_tours_exadult*query_tours_curr)+parseFloat(query_transfer_exadult*query_transfer_curr)+parseFloat(query_visa_exadult*query_visa_curr)+parseFloat(query_inc_exadult*query_inc_curr)+parseFloat(query_gst_exadult*query_gst_curr)+parseFloat(query_cruise_exadult*query_cruise_curr)+parseFloat(query_meals_exadult*query_meals_curr)+parseFloat(query_markup_exadult*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_exadult/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_exadult").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_exadult
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_exadult").val("").val(total_grand)
    });
    //
    $(document).on('keyup','.query_hotel_exadult',function()
    {
        var query_hotel_exadult=$(this).val();
        var query_air_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_air_exadult").val()
        var query_tours_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_exadult").val()
        var query_transfer_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_exadult").val()
        var query_visa_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_exadult").val()
        var query_inc_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_exadult").val()
        var query_discount_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_exadult").val()
        var query_gst_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_exadult").val()
        //extra start
        var query_cruise_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_exadult").val()
        var query_meals_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_meals_exadult").val()
        var query_markup_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_markup_exadult").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_exadult*query_air_curr)+parseFloat(query_hotel_exadult*query_hotel_curr)+parseFloat(query_tours_exadult*query_tours_curr)+parseFloat(query_transfer_exadult*query_transfer_curr)+parseFloat(query_visa_exadult*query_visa_curr)+parseFloat(query_inc_exadult*query_inc_curr)+parseFloat(query_gst_exadult*query_gst_curr)+parseFloat(query_cruise_exadult*query_cruise_curr)+parseFloat(query_meals_exadult*query_meals_curr)+parseFloat(query_markup_exadult*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_exadult/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_exadult").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_exadult
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_exadult").val("").val(total_grand)
    });
    //
    $(document).on('keyup','.query_tours_exadult',function()
    {
        var query_tours_exadult=$(this).val();
        var query_air_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_air_exadult").val()
        var query_hotel_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_exadult").val()
        var query_transfer_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_exadult").val()
        var query_visa_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_exadult").val()
        var query_inc_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_exadult").val()
        var query_discount_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_exadult").val()
        var query_gst_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_exadult").val()
         //extra start
        var query_cruise_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_exadult").val()
        var query_meals_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_meals_exadult").val()
        var query_markup_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_markup_exadult").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_exadult*query_air_curr)+parseFloat(query_hotel_exadult*query_hotel_curr)+parseFloat(query_tours_exadult*query_tours_curr)+parseFloat(query_transfer_exadult*query_transfer_curr)+parseFloat(query_visa_exadult*query_visa_curr)+parseFloat(query_inc_exadult*query_inc_curr)+parseFloat(query_gst_exadult*query_gst_curr)+parseFloat(query_cruise_exadult*query_cruise_curr)+parseFloat(query_meals_exadult*query_meals_curr)+parseFloat(query_markup_exadult*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_exadult/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_exadult").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_exadult
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_exadult").val("").val(total_grand)
    });
    //
    $(document).on('keyup','.query_transfer_exadult',function()
    {
        var query_transfer_exadult=$(this).val();
        var query_air_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_air_exadult").val()
        var query_hotel_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_exadult").val()
        var query_tours_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_exadult").val()
        var query_visa_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_exadult").val()
        var query_inc_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_exadult").val()
        var query_discount_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_exadult").val()
        var query_gst_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_exadult").val()
         //extra start
        var query_cruise_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_exadult").val()
        var query_meals_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_meals_exadult").val()
        var query_markup_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_markup_exadult").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_exadult*query_air_curr)+parseFloat(query_hotel_exadult*query_hotel_curr)+parseFloat(query_tours_exadult*query_tours_curr)+parseFloat(query_transfer_exadult*query_transfer_curr)+parseFloat(query_visa_exadult*query_visa_curr)+parseFloat(query_inc_exadult*query_inc_curr)+parseFloat(query_gst_exadult*query_gst_curr)+parseFloat(query_cruise_exadult*query_cruise_curr)+parseFloat(query_meals_exadult*query_meals_curr)+parseFloat(query_markup_exadult*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_exadult/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_exadult").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_exadult
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_exadult").val("").val(total_grand)
    });
    //
    $(document).on('keyup','.query_visa_exadult',function()
    {
        var query_visa_exadult=$(this).val();
        var query_air_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_air_exadult").val()
        var query_hotel_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_exadult").val()
        var query_tours_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_exadult").val()
        var query_transfer_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_exadult").val()
        var query_inc_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_exadult").val()
        var query_discount_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_exadult").val()
        var query_gst_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_exadult").val()
         //extra start
        var query_cruise_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_exadult").val()
        var query_meals_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_meals_exadult").val()
        var query_markup_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_markup_exadult").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_exadult*query_air_curr)+parseFloat(query_hotel_exadult*query_hotel_curr)+parseFloat(query_tours_exadult*query_tours_curr)+parseFloat(query_transfer_exadult*query_transfer_curr)+parseFloat(query_visa_exadult*query_visa_curr)+parseFloat(query_inc_exadult*query_inc_curr)+parseFloat(query_gst_exadult*query_gst_curr)+parseFloat(query_cruise_exadult*query_cruise_curr)+parseFloat(query_meals_exadult*query_meals_curr)+parseFloat(query_markup_exadult*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_exadult/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_exadult").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_exadult
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_exadult").val("").val(total_grand)
    });
    //
    $(document).on('keyup','.query_inc_exadult',function()
    {
        var query_inc_exadult=$(this).val();
        var query_air_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_air_exadult").val()
        var query_hotel_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_exadult").val()
        var query_tours_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_exadult").val()
        var query_transfer_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_exadult").val()
        var query_visa_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_exadult").val()
        var query_discount_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_exadult").val()
        var query_gst_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_exadult").val()
         //extra start
        var query_cruise_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_exadult").val()
        var query_meals_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_meals_exadult").val()
        var query_markup_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_markup_exadult").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_exadult*query_air_curr)+parseFloat(query_hotel_exadult*query_hotel_curr)+parseFloat(query_tours_exadult*query_tours_curr)+parseFloat(query_transfer_exadult*query_transfer_curr)+parseFloat(query_visa_exadult*query_visa_curr)+parseFloat(query_inc_exadult*query_inc_curr)+parseFloat(query_gst_exadult*query_gst_curr)+parseFloat(query_cruise_exadult*query_cruise_curr)+parseFloat(query_meals_exadult*query_meals_curr)+parseFloat(query_markup_exadult*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_exadult/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_exadult").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_exadult
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_exadult").val("").val(total_grand)
    });
    //
    $(document).on('keyup','.query_discount_exadult',function()
    {
        var query_discount_exadult=$(this).val();
        var query_air_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_air_exadult").val()
        var query_hotel_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_exadult").val()
        var query_tours_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_exadult").val()
        var query_transfer_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_exadult").val()
        var query_visa_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_exadult").val()
        var query_inc_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_exadult").val()
        var query_gst_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_exadult").val()
        //extra start
        var query_cruise_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_exadult").val()
        var query_meals_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_meals_exadult").val()
        var query_markup_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_markup_exadult").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
         //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_exadult*query_air_curr)+parseFloat(query_hotel_exadult*query_hotel_curr)+parseFloat(query_tours_exadult*query_tours_curr)+parseFloat(query_transfer_exadult*query_transfer_curr)+parseFloat(query_visa_exadult*query_visa_curr)+parseFloat(query_inc_exadult*query_inc_curr)+parseFloat(query_gst_exadult*query_gst_curr)+parseFloat(query_cruise_exadult*query_cruise_curr)+parseFloat(query_meals_exadult*query_meals_curr)+parseFloat(query_markup_exadult*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_exadult/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_exadult").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_exadult
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_exadult").val("").val(total_grand)
    });
    //
    $(document).on('keyup','.query_gst_exadult',function()
    {
        var query_gst_exadult=$(this).val();
        var query_air_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_air_exadult").val()
        var query_hotel_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_exadult").val()
        var query_tours_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_exadult").val()
        var query_transfer_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_exadult").val()
        var query_visa_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_exadult").val()
        var query_inc_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_exadult").val()
        var query_discount_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_exadult").val()
         //extra start
        var query_cruise_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_exadult").val()
        var query_meals_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_meals_exadult").val()
        var query_markup_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_markup_exadult").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_exadult*query_air_curr)+parseFloat(query_hotel_exadult*query_hotel_curr)+parseFloat(query_tours_exadult*query_tours_curr)+parseFloat(query_transfer_exadult*query_transfer_curr)+parseFloat(query_visa_exadult*query_visa_curr)+parseFloat(query_inc_exadult*query_inc_curr)+parseFloat(query_gst_exadult*query_gst_curr)+parseFloat(query_cruise_exadult*query_cruise_curr)+parseFloat(query_meals_exadult*query_meals_curr)+parseFloat(query_markup_exadult*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_exadult/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_exadult").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_exadult
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_exadult").val("").val(total_grand)
    });
    $(document).on('keyup','.query_cruise_exadult',function()
    {
        var query_gst_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_exadult").val()
        var query_air_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_air_exadult").val()
        var query_hotel_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_exadult").val()
        var query_tours_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_exadult").val()
        var query_transfer_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_exadult").val()
        var query_visa_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_exadult").val()
        var query_inc_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_exadult").val()
        var query_discount_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_exadult").val()
         //extra start
        var query_cruise_exadult=$(this).val();
        var query_meals_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_meals_exadult").val()
        var query_markup_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_markup_exadult").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_exadult*query_air_curr)+parseFloat(query_hotel_exadult*query_hotel_curr)+parseFloat(query_tours_exadult*query_tours_curr)+parseFloat(query_transfer_exadult*query_transfer_curr)+parseFloat(query_visa_exadult*query_visa_curr)+parseFloat(query_inc_exadult*query_inc_curr)+parseFloat(query_gst_exadult*query_gst_curr)+parseFloat(query_cruise_exadult*query_cruise_curr)+parseFloat(query_meals_exadult*query_meals_curr)+parseFloat(query_markup_exadult*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_exadult/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_exadult").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_exadult
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_exadult").val("").val(total_grand)
    });
    $(document).on('keyup','.query_meals_exadult',function()
    {
        var query_gst_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_exadult").val()
        var query_air_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_air_exadult").val()
        var query_hotel_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_exadult").val()
        var query_tours_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_exadult").val()
        var query_transfer_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_exadult").val()
        var query_visa_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_exadult").val()
        var query_inc_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_exadult").val()
        var query_discount_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_exadult").val()
         //extra start
        var query_cruise_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_exadult").val()
        var query_meals_exadult=$(this).val();
        var query_markup_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_markup_exadult").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_exadult*query_air_curr)+parseFloat(query_hotel_exadult*query_hotel_curr)+parseFloat(query_tours_exadult*query_tours_curr)+parseFloat(query_transfer_exadult*query_transfer_curr)+parseFloat(query_visa_exadult*query_visa_curr)+parseFloat(query_inc_exadult*query_inc_curr)+parseFloat(query_gst_exadult*query_gst_curr)+parseFloat(query_cruise_exadult*query_cruise_curr)+parseFloat(query_meals_exadult*query_meals_curr)+parseFloat(query_markup_exadult*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_exadult/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_exadult").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_exadult
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_exadult").val("").val(total_grand)
    });
    $(document).on('keyup','.query_markup_exadult',function()
    {
        var query_gst_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_exadult").val()
        var query_air_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_air_exadult").val()
        var query_hotel_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_exadult").val()
        var query_tours_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_exadult").val()
        var query_transfer_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_exadult").val()
        var query_visa_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_exadult").val()
        var query_inc_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_exadult").val()
        var query_discount_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_exadult").val()
         //extra start
        var query_cruise_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_exadult").val()
        var query_meals_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_meals_exadult").val()
        var query_markup_exadult=$(this).val();
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_exadult*query_air_curr)+parseFloat(query_hotel_exadult*query_hotel_curr)+parseFloat(query_tours_exadult*query_tours_curr)+parseFloat(query_transfer_exadult*query_transfer_curr)+parseFloat(query_visa_exadult*query_visa_curr)+parseFloat(query_inc_exadult*query_inc_curr)+parseFloat(query_gst_exadult*query_gst_curr)+parseFloat(query_cruise_exadult*query_cruise_curr)+parseFloat(query_meals_exadult*query_meals_curr)+parseFloat(query_markup_exadult*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_exadult/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_exadult").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_exadult
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_exadult").val("").val(total_grand)
    });
    //column 3 childbed
    $(document).on('keyup','.query_air_childbed',function()
    {
        var query_air_childbed=$(this).val();
        var query_hotel_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childbed").val()
        var query_tours_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childbed").val()
        var query_transfer_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childbed").val()
        var query_visa_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childbed").val()
        var query_inc_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childbed").val()
        var query_discount_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childbed").val()
        var query_gst_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childbed").val()
        //extra start
        var query_cruise_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_childbed").val()
        var query_meals_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_meals_childbed").val()
        var query_markup_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_markup_childbed").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
         //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")

       
        var total=parseFloat(query_air_childbed*query_air_curr)+parseFloat(query_hotel_childbed*query_hotel_curr)+parseFloat(query_tours_childbed*query_tours_curr)+parseFloat(query_transfer_childbed*query_transfer_curr)+parseFloat(query_visa_childbed*query_visa_curr)+parseFloat(query_inc_childbed*query_inc_curr)+parseFloat(query_gst_childbed*query_gst_curr)+parseFloat(query_cruise_childbed*query_cruise_curr)+parseFloat(query_meals_childbed*query_meals_curr)+parseFloat(query_markup_childbed*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_childbed/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_childbed").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_childbed
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_childbed").val("").val(total_grand)
    });
    //
    $(document).on('keyup','.query_hotel_childbed',function()
    {
        var query_hotel_childbed=$(this).val();
        var query_air_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childbed").val()
        var query_tours_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childbed").val()
        var query_transfer_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childbed").val()
        var query_visa_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childbed").val()
        var query_inc_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childbed").val()
        var query_discount_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childbed").val()
        var query_gst_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childbed").val()
         //extra start
        var query_cruise_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_childbed").val()
        var query_meals_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_meals_childbed").val()
        var query_markup_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_markup_childbed").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end


        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_childbed*query_air_curr)+parseFloat(query_hotel_childbed*query_hotel_curr)+parseFloat(query_tours_childbed*query_tours_curr)+parseFloat(query_transfer_childbed*query_transfer_curr)+parseFloat(query_visa_childbed*query_visa_curr)+parseFloat(query_inc_childbed*query_inc_curr)+parseFloat(query_gst_childbed*query_gst_curr)+parseFloat(query_cruise_childbed*query_cruise_curr)+parseFloat(query_meals_childbed*query_meals_curr)+parseFloat(query_markup_childbed*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_childbed/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_childbed").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_childbed
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_childbed").val("").val(total_grand)
    });
    //
    $(document).on('keyup','.query_tours_childbed',function()
    {
        var query_tours_childbed=$(this).val();
        var query_air_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childbed").val()
        var query_hotel_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childbed").val()
        var query_transfer_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childbed").val()
        var query_visa_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childbed").val()
        var query_inc_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childbed").val()
        var query_discount_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childbed").val()
        var query_gst_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childbed").val()
          //extra start
        var query_cruise_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_childbed").val()
        var query_meals_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_meals_childbed").val()
        var query_markup_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_markup_childbed").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
         var total=parseFloat(query_air_childbed*query_air_curr)+parseFloat(query_hotel_childbed*query_hotel_curr)+parseFloat(query_tours_childbed*query_tours_curr)+parseFloat(query_transfer_childbed*query_transfer_curr)+parseFloat(query_visa_childbed*query_visa_curr)+parseFloat(query_inc_childbed*query_inc_curr)+parseFloat(query_gst_childbed*query_gst_curr)+parseFloat(query_cruise_childbed*query_cruise_curr)+parseFloat(query_meals_childbed*query_meals_curr)+parseFloat(query_markup_childbed*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_childbed/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_childbed").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_childbed
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_childbed").val("").val(total_grand)
    });
    //
    $(document).on('keyup','.query_transfer_childbed',function()
    {
        var query_transfer_childbed=$(this).val();
        var query_air_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childbed").val()
        var query_hotel_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childbed").val()
        var query_tours_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childbed").val()
        var query_visa_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childbed").val()
        var query_inc_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childbed").val()
        var query_discount_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childbed").val()
        var query_gst_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childbed").val()
         //extra start
        var query_cruise_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_childbed").val()
        var query_meals_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_meals_childbed").val()
        var query_markup_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_markup_childbed").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_childbed*query_air_curr)+parseFloat(query_hotel_childbed*query_hotel_curr)+parseFloat(query_tours_childbed*query_tours_curr)+parseFloat(query_transfer_childbed*query_transfer_curr)+parseFloat(query_visa_childbed*query_visa_curr)+parseFloat(query_inc_childbed*query_inc_curr)+parseFloat(query_gst_childbed*query_gst_curr)+parseFloat(query_cruise_childbed*query_cruise_curr)+parseFloat(query_meals_childbed*query_meals_curr)+parseFloat(query_markup_childbed*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_childbed/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_childbed").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_childbed
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_childbed").val("").val(total_grand)
    });
    //
    $(document).on('keyup','.query_visa_childbed',function()
    {
        var query_visa_childbed=$(this).val();
        var query_air_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childbed").val()
        var query_hotel_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childbed").val()
        var query_tours_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childbed").val()
        var query_transfer_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childbed").val()
        var query_inc_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childbed").val()
        var query_discount_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childbed").val()
        var query_gst_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childbed").val()
          //extra start
        var query_cruise_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_childbed").val()
        var query_meals_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_meals_childbed").val()
        var query_markup_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_markup_childbed").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
         //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_childbed*query_air_curr)+parseFloat(query_hotel_childbed*query_hotel_curr)+parseFloat(query_tours_childbed*query_tours_curr)+parseFloat(query_transfer_childbed*query_transfer_curr)+parseFloat(query_visa_childbed*query_visa_curr)+parseFloat(query_inc_childbed*query_inc_curr)+parseFloat(query_gst_childbed*query_gst_curr)+parseFloat(query_cruise_childbed*query_cruise_curr)+parseFloat(query_meals_childbed*query_meals_curr)+parseFloat(query_markup_childbed*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_childbed/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_childbed").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_childbed
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_childbed").val("").val(total_grand)
    });
    //
    $(document).on('keyup','.query_inc_childbed',function()
    {
        var query_inc_childbed=$(this).val();
        var query_air_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childbed").val()
        var query_hotel_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childbed").val()
        var query_tours_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childbed").val()
        var query_transfer_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childbed").val()
        var query_visa_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childbed").val()
        var query_discount_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childbed").val()
        var query_gst_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childbed").val()
          //extra start
        var query_cruise_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_childbed").val()
        var query_meals_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_meals_childbed").val()
        var query_markup_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_markup_childbed").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_childbed*query_air_curr)+parseFloat(query_hotel_childbed*query_hotel_curr)+parseFloat(query_tours_childbed*query_tours_curr)+parseFloat(query_transfer_childbed*query_transfer_curr)+parseFloat(query_visa_childbed*query_visa_curr)+parseFloat(query_inc_childbed*query_inc_curr)+parseFloat(query_gst_childbed*query_gst_curr)+parseFloat(query_cruise_childbed*query_cruise_curr)+parseFloat(query_meals_childbed*query_meals_curr)+parseFloat(query_markup_childbed*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_childbed/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_childbed").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_childbed
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_childbed").val("").val(total_grand)
    });
    //
    $(document).on('keyup','.query_discount_childbed',function()
    {
        var query_discount_childbed=$(this).val();
        var query_air_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childbed").val()
        var query_hotel_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childbed").val()
        var query_tours_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childbed").val()
        var query_transfer_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childbed").val()
        var query_visa_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childbed").val()
        var query_inc_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childbed").val()
        var query_gst_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childbed").val()
         //extra start
        var query_cruise_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_childbed").val()
        var query_meals_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_meals_childbed").val()
        var query_markup_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_markup_childbed").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
         //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_childbed*query_air_curr)+parseFloat(query_hotel_childbed*query_hotel_curr)+parseFloat(query_tours_childbed*query_tours_curr)+parseFloat(query_transfer_childbed*query_transfer_curr)+parseFloat(query_visa_childbed*query_visa_curr)+parseFloat(query_inc_childbed*query_inc_curr)+parseFloat(query_gst_childbed*query_gst_curr)+parseFloat(query_cruise_childbed*query_cruise_curr)+parseFloat(query_meals_childbed*query_meals_curr)+parseFloat(query_markup_childbed*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_childbed/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_childbed").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_childbed
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_childbed").val("").val(total_grand)
    });
    //
    $(document).on('keyup','.query_gst_childbed',function()
    {
        var query_gst_childbed=$(this).val();
        var query_air_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childbed").val()
        var query_hotel_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childbed").val()
        var query_tours_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childbed").val()
        var query_transfer_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childbed").val()
        var query_visa_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childbed").val()
        var query_inc_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childbed").val()
        var query_discount_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childbed").val()
         //extra start
        var query_cruise_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_childbed").val()
        var query_meals_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_meals_childbed").val()
        var query_markup_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_markup_childbed").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_childbed*query_air_curr)+parseFloat(query_hotel_childbed*query_hotel_curr)+parseFloat(query_tours_childbed*query_tours_curr)+parseFloat(query_transfer_childbed*query_transfer_curr)+parseFloat(query_visa_childbed*query_visa_curr)+parseFloat(query_inc_childbed*query_inc_curr)+parseFloat(query_gst_childbed*query_gst_curr)+parseFloat(query_cruise_childbed*query_cruise_curr)+parseFloat(query_meals_childbed*query_meals_curr)+parseFloat(query_markup_childbed*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_childbed/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_childbed").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_childbed
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_childbed").val("").val(total_grand)
    });
    $(document).on('keyup','.query_cruise_childbed',function()
    {
        var query_gst_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childbed").val()
        var query_air_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childbed").val()
        var query_hotel_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childbed").val()
        var query_tours_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childbed").val()
        var query_transfer_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childbed").val()
        var query_visa_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childbed").val()
        var query_inc_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childbed").val()
        var query_discount_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childbed").val()
         //extra start
        var query_cruise_childbed=$(this).val();
        var query_meals_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_meals_childbed").val()
        var query_markup_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_markup_childbed").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_childbed*query_air_curr)+parseFloat(query_hotel_childbed*query_hotel_curr)+parseFloat(query_tours_childbed*query_tours_curr)+parseFloat(query_transfer_childbed*query_transfer_curr)+parseFloat(query_visa_childbed*query_visa_curr)+parseFloat(query_inc_childbed*query_inc_curr)+parseFloat(query_gst_childbed*query_gst_curr)+parseFloat(query_cruise_childbed*query_cruise_curr)+parseFloat(query_meals_childbed*query_meals_curr)+parseFloat(query_markup_childbed*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_childbed/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_childbed").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_childbed
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_childbed").val("").val(total_grand)
    });
    $(document).on('keyup','.query_meals_childbed',function()
    {
        var query_gst_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childbed").val()
        var query_air_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childbed").val()
        var query_hotel_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childbed").val()
        var query_tours_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childbed").val()
        var query_transfer_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childbed").val()
        var query_visa_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childbed").val()
        var query_inc_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childbed").val()
        var query_discount_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childbed").val()
         //extra start
        var query_cruise_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_childbed").val()
        var query_meals_childbed=$(this).val();
        var query_markup_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_markup_childbed").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_childbed*query_air_curr)+parseFloat(query_hotel_childbed*query_hotel_curr)+parseFloat(query_tours_childbed*query_tours_curr)+parseFloat(query_transfer_childbed*query_transfer_curr)+parseFloat(query_visa_childbed*query_visa_curr)+parseFloat(query_inc_childbed*query_inc_curr)+parseFloat(query_gst_childbed*query_gst_curr)+parseFloat(query_cruise_childbed*query_cruise_curr)+parseFloat(query_meals_childbed*query_meals_curr)+parseFloat(query_markup_childbed*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_childbed/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_childbed").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_childbed
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_childbed").val("").val(total_grand)
    });

    $(document).on('keyup','.query_markup_childbed',function()
    {
        var query_gst_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childbed").val()
        var query_air_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childbed").val()
        var query_hotel_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childbed").val()
        var query_tours_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childbed").val()
        var query_transfer_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childbed").val()
        var query_visa_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childbed").val()
        var query_inc_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childbed").val()
        var query_discount_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childbed").val()
         //extra start
        var query_cruise_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_childbed").val()
        var query_meals_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_meals_childbed").val()
        var query_markup_childbed=$(this).val();
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_childbed*query_air_curr)+parseFloat(query_hotel_childbed*query_hotel_curr)+parseFloat(query_tours_childbed*query_tours_curr)+parseFloat(query_transfer_childbed*query_transfer_curr)+parseFloat(query_visa_childbed*query_visa_curr)+parseFloat(query_inc_childbed*query_inc_curr)+parseFloat(query_gst_childbed*query_gst_curr)+parseFloat(query_cruise_childbed*query_cruise_curr)+parseFloat(query_meals_childbed*query_meals_curr)+parseFloat(query_markup_childbed*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_childbed/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_childbed").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_childbed
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_childbed").val("").val(total_grand)
    });

    //column 4 start
    $(document).on('keyup','.query_air_childwbed',function()
    {
        var query_air_childwbed=$(this).val();
        var query_hotel_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childwbed").val()
        var query_tours_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childwbed").val()
        var query_transfer_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childwbed").val()
        var query_visa_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childwbed").val()
        var query_inc_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childwbed").val()
        var query_discount_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childwbed").val()
        var query_gst_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childwbed").val()
         //extra start
        var query_cruise_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_childwbed").val()
        var query_meals_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_meals_childwbed").val()
        var query_markup_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_markup_childwbed").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_childwbed*query_air_curr)+parseFloat(query_hotel_childwbed*query_hotel_curr)+parseFloat(query_tours_childwbed*query_tours_curr)+parseFloat(query_transfer_childwbed*query_transfer_curr)+parseFloat(query_visa_childwbed*query_visa_curr)+parseFloat(query_inc_childwbed*query_inc_curr)+parseFloat(query_gst_childwbed*query_gst_curr)+parseFloat(query_cruise_childwbed*query_cruise_curr)+parseFloat(query_meals_childwbed*query_meals_curr)+parseFloat(query_markup_childwbed*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_childwbed/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_childwbed").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_childwbed
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_childwbed").val("").val(total_grand)
    });
    //
    $(document).on('keyup','.query_hotel_childwbed',function()
    {
        var query_hotel_childwbed=$(this).val();
        var query_air_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childwbed").val()
        var query_tours_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childwbed").val()
        var query_transfer_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childwbed").val()
        var query_visa_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childwbed").val()
        var query_inc_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childwbed").val()
        var query_discount_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childwbed").val()
        var query_gst_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childwbed").val()
         //extra start
        var query_cruise_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_childwbed").val()
        var query_meals_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_meals_childwbed").val()
        var query_markup_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_markup_childwbed").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
         //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_childwbed*query_air_curr)+parseFloat(query_hotel_childwbed*query_hotel_curr)+parseFloat(query_tours_childwbed*query_tours_curr)+parseFloat(query_transfer_childwbed*query_transfer_curr)+parseFloat(query_visa_childwbed*query_visa_curr)+parseFloat(query_inc_childwbed*query_inc_curr)+parseFloat(query_gst_childwbed*query_gst_curr)+parseFloat(query_cruise_childwbed*query_cruise_curr)+parseFloat(query_meals_childwbed*query_meals_curr)+parseFloat(query_markup_childwbed*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_childwbed/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_childwbed").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_childwbed
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_childwbed").val("").val(total_grand)
    });
    //
    $(document).on('keyup','.query_tours_childwbed',function()
    {
        var query_tours_childwbed=$(this).val();
        var query_air_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childwbed").val()
        var query_hotel_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childwbed").val()
        var query_transfer_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childwbed").val()
        var query_visa_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childwbed").val()
        var query_inc_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childwbed").val()
        var query_discount_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childwbed").val()
        var query_gst_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childwbed").val()
         //extra start
        var query_cruise_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_childwbed").val()
        var query_meals_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_meals_childwbed").val()
        var query_markup_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_markup_childwbed").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
         //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
       var total=parseFloat(query_air_childwbed*query_air_curr)+parseFloat(query_hotel_childwbed*query_hotel_curr)+parseFloat(query_tours_childwbed*query_tours_curr)+parseFloat(query_transfer_childwbed*query_transfer_curr)+parseFloat(query_visa_childwbed*query_visa_curr)+parseFloat(query_inc_childwbed*query_inc_curr)+parseFloat(query_gst_childwbed*query_gst_curr)+parseFloat(query_cruise_childwbed*query_cruise_curr)+parseFloat(query_meals_childwbed*query_meals_curr)+parseFloat(query_markup_childwbed*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_childwbed/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_childwbed").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_childwbed
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_childwbed").val("").val(total_grand)
    });
    //
    $(document).on('keyup','.query_transfer_childwbed',function()
    {
        var query_transfer_childwbed=$(this).val();
        var query_air_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childwbed").val()
        var query_hotel_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childwbed").val()
        var query_tours_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childwbed").val()
        var query_visa_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childwbed").val()
        var query_inc_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childwbed").val()
        var query_discount_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childwbed").val()
        var query_gst_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childwbed").val()
         //extra start
        var query_cruise_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_childwbed").val()
        var query_meals_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_meals_childwbed").val()
        var query_markup_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_markup_childwbed").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_childwbed*query_air_curr)+parseFloat(query_hotel_childwbed*query_hotel_curr)+parseFloat(query_tours_childwbed*query_tours_curr)+parseFloat(query_transfer_childwbed*query_transfer_curr)+parseFloat(query_visa_childwbed*query_visa_curr)+parseFloat(query_inc_childwbed*query_inc_curr)+parseFloat(query_gst_childwbed*query_gst_curr)+parseFloat(query_cruise_childwbed*query_cruise_curr)+parseFloat(query_meals_childwbed*query_meals_curr)+parseFloat(query_markup_childwbed*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_childwbed/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_childwbed").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_childwbed
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_childwbed").val("").val(total_grand)
    });
    //
    $(document).on('keyup','.query_visa_childwbed',function()
    {
        var query_visa_childwbed=$(this).val();
        var query_air_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childwbed").val()
        var query_hotel_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childwbed").val()
        var query_tours_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childwbed").val()
        var query_transfer_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childwbed").val()
        var query_inc_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childwbed").val()
        var query_discount_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childwbed").val()
        var query_gst_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childwbed").val()
         //extra start
        var query_cruise_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_childwbed").val()
        var query_meals_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_meals_childwbed").val()
        var query_markup_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_markup_childwbed").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_childwbed*query_air_curr)+parseFloat(query_hotel_childwbed*query_hotel_curr)+parseFloat(query_tours_childwbed*query_tours_curr)+parseFloat(query_transfer_childwbed*query_transfer_curr)+parseFloat(query_visa_childwbed*query_visa_curr)+parseFloat(query_inc_childwbed*query_inc_curr)+parseFloat(query_gst_childwbed*query_gst_curr)+parseFloat(query_cruise_childwbed*query_cruise_curr)+parseFloat(query_meals_childwbed*query_meals_curr)+parseFloat(query_markup_childwbed*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_childwbed/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_childwbed").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_childwbed
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_childwbed").val("").val(total_grand)
    });
    //
    $(document).on('keyup','.query_inc_childwbed',function()
    {
        var query_inc_childwbed=$(this).val();
        var query_air_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childwbed").val()
        var query_hotel_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childwbed").val()
        var query_tours_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childwbed").val()
        var query_transfer_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childwbed").val()
        var query_visa_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childwbed").val()
        var query_discount_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childwbed").val()
        var query_gst_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childwbed").val()
          //extra start
        var query_cruise_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_childwbed").val()
        var query_meals_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_meals_childwbed").val()
        var query_markup_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_markup_childwbed").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_childwbed*query_air_curr)+parseFloat(query_hotel_childwbed*query_hotel_curr)+parseFloat(query_tours_childwbed*query_tours_curr)+parseFloat(query_transfer_childwbed*query_transfer_curr)+parseFloat(query_visa_childwbed*query_visa_curr)+parseFloat(query_inc_childwbed*query_inc_curr)+parseFloat(query_gst_childwbed*query_gst_curr)+parseFloat(query_cruise_childwbed*query_cruise_curr)+parseFloat(query_meals_childwbed*query_meals_curr)+parseFloat(query_markup_childwbed*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_childwbed/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_childwbed").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_childwbed
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_childwbed").val("").val(total_grand)
    });
    //
    $(document).on('keyup','.query_discount_childwbed',function()
    {
        var query_discount_childwbed=$(this).val();
        var query_air_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childwbed").val()
        var query_hotel_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childwbed").val()
        var query_tours_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childwbed").val()
        var query_transfer_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childwbed").val()
        var query_visa_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childwbed").val()
        var query_inc_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childwbed").val()
        var query_gst_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childwbed").val()
         //extra start
        var query_cruise_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_childwbed").val()
        var query_meals_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_meals_childwbed").val()
        var query_markup_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_markup_childwbed").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_childwbed*query_air_curr)+parseFloat(query_hotel_childwbed*query_hotel_curr)+parseFloat(query_tours_childwbed*query_tours_curr)+parseFloat(query_transfer_childwbed*query_transfer_curr)+parseFloat(query_visa_childwbed*query_visa_curr)+parseFloat(query_inc_childwbed*query_inc_curr)+parseFloat(query_gst_childwbed*query_gst_curr)+parseFloat(query_cruise_childwbed*query_cruise_curr)+parseFloat(query_meals_childwbed*query_meals_curr)+parseFloat(query_markup_childwbed*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_childwbed/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_childwbed").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_childwbed
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_childwbed").val("").val(total_grand)
    });
    //
    $(document).on('keyup','.query_gst_childwbed',function()
    {
        var query_gst_childwbed=$(this).val();
        var query_air_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childwbed").val()
        var query_hotel_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childwbed").val()
        var query_tours_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childwbed").val()
        var query_transfer_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childwbed").val()
        var query_visa_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childwbed").val()
        var query_inc_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childwbed").val()
        var query_discount_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childwbed").val()
        //extra start
        var query_cruise_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_childwbed").val()
        var query_meals_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_meals_childwbed").val()
        var query_markup_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_markup_childwbed").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_childwbed*query_air_curr)+parseFloat(query_hotel_childwbed*query_hotel_curr)+parseFloat(query_tours_childwbed*query_tours_curr)+parseFloat(query_transfer_childwbed*query_transfer_curr)+parseFloat(query_visa_childwbed*query_visa_curr)+parseFloat(query_inc_childwbed*query_inc_curr)+parseFloat(query_gst_childwbed*query_gst_curr)+parseFloat(query_cruise_childwbed*query_cruise_curr)+parseFloat(query_meals_childwbed*query_meals_curr)+parseFloat(query_markup_childwbed*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_childwbed/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_childwbed").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_childwbed
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_childwbed").val("").val(total_grand)
    });
    $(document).on('keyup','.query_cruise_childwbed',function()
    {
        var query_gst_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childwbed").val()
        var query_air_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childwbed").val()
        var query_hotel_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childwbed").val()
        var query_tours_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childwbed").val()
        var query_transfer_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childwbed").val()
        var query_visa_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childwbed").val()
        var query_inc_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childwbed").val()
        var query_discount_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childwbed").val()
        //extra start
        var query_cruise_childwbed=$(this).val();
        var query_meals_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_meals_childwbed").val()
        var query_markup_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_markup_childwbed").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_childwbed*query_air_curr)+parseFloat(query_hotel_childwbed*query_hotel_curr)+parseFloat(query_tours_childwbed*query_tours_curr)+parseFloat(query_transfer_childwbed*query_transfer_curr)+parseFloat(query_visa_childwbed*query_visa_curr)+parseFloat(query_inc_childwbed*query_inc_curr)+parseFloat(query_gst_childwbed*query_gst_curr)+parseFloat(query_cruise_childwbed*query_cruise_curr)+parseFloat(query_meals_childwbed*query_meals_curr)+parseFloat(query_markup_childwbed*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_childwbed/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_childwbed").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_childwbed
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_childwbed").val("").val(total_grand)
    });
    $(document).on('keyup','.query_meals_childwbed',function()
    {
        var query_gst_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childwbed").val()
        var query_air_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childwbed").val()
        var query_hotel_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childwbed").val()
        var query_tours_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childwbed").val()
        var query_transfer_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childwbed").val()
        var query_visa_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childwbed").val()
        var query_inc_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childwbed").val()
        var query_discount_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childwbed").val()
        //extra start
        var query_cruise_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_childwbed").val()
        var query_meals_childwbed=$(this).val();
        var query_markup_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_markup_childwbed").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_childwbed*query_air_curr)+parseFloat(query_hotel_childwbed*query_hotel_curr)+parseFloat(query_tours_childwbed*query_tours_curr)+parseFloat(query_transfer_childwbed*query_transfer_curr)+parseFloat(query_visa_childwbed*query_visa_curr)+parseFloat(query_inc_childwbed*query_inc_curr)+parseFloat(query_gst_childwbed*query_gst_curr)+parseFloat(query_cruise_childwbed*query_cruise_curr)+parseFloat(query_meals_childwbed*query_meals_curr)+parseFloat(query_markup_childwbed*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_childwbed/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_childwbed").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_childwbed
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_childwbed").val("").val(total_grand)
    });
    $(document).on('keyup','.query_markup_childwbed',function()
    {
        var query_gst_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childwbed").val()
        var query_air_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childwbed").val()
        var query_hotel_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childwbed").val()
        var query_tours_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childwbed").val()
        var query_transfer_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childwbed").val()
        var query_visa_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childwbed").val()
        var query_inc_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childwbed").val()
        var query_discount_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childwbed").val()
        //extra start
        var query_cruise_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_childwbed").val()
        var query_meals_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_meals_childwbed").val()
        var query_markup_childwbed=$(this).val();
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_childwbed*query_air_curr)+parseFloat(query_hotel_childwbed*query_hotel_curr)+parseFloat(query_tours_childwbed*query_tours_curr)+parseFloat(query_transfer_childwbed*query_transfer_curr)+parseFloat(query_visa_childwbed*query_visa_curr)+parseFloat(query_inc_childwbed*query_inc_curr)+parseFloat(query_gst_childwbed*query_gst_curr)+parseFloat(query_cruise_childwbed*query_cruise_curr)+parseFloat(query_meals_childwbed*query_meals_curr)+parseFloat(query_markup_childwbed*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_childwbed/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_childwbed").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_childwbed
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_childwbed").val("").val(total_grand)
    });

    //column 5 start
    $(document).on('keyup','.query_air_infant',function()
    {
        var query_air_infant=$(this).val();
        var query_hotel_infant=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_infant").val()
        var query_tours_infant=$(this).parent().parent().parent().children("tr").children().children(".query_tours_infant").val()
        var query_transfer_infant=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_infant").val()
        var query_visa_infant=$(this).parent().parent().parent().children("tr").children().children(".query_visa_infant").val()
        var query_inc_infant=$(this).parent().parent().parent().children("tr").children().children(".query_inc_infant").val()
        var query_discount_infant=$(this).parent().parent().parent().children("tr").children().children(".query_discount_infant").val()
        var query_gst_infant=$(this).parent().parent().parent().children("tr").children().children(".query_gst_infant").val()
         //extra start
        var query_cruise_infant=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_infant").val()
        var query_meals_infant=$(this).parent().parent().parent().children("tr").children().children(".query_meals_infant").val()
        var query_markup_infant=$(this).parent().parent().parent().children("tr").children().children(".query_markup_infant").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_infant*query_air_curr)+parseFloat(query_hotel_infant*query_hotel_curr)+parseFloat(query_tours_infant*query_tours_curr)+parseFloat(query_transfer_infant*query_transfer_curr)+parseFloat(query_visa_infant*query_visa_curr)+parseFloat(query_inc_infant*query_inc_curr)+parseFloat(query_gst_infant*query_gst_curr)+parseFloat(query_cruise_infant*query_cruise_curr)+parseFloat(query_meals_infant*query_meals_curr)+parseFloat(query_markup_infant*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_infant/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_infant").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_infant
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_infant").val("").val(total_grand)
    });
    //
    $(document).on('keyup','.query_hotel_infant',function()
    {
        var query_hotel_infant=$(this).val();
        var query_air_infant=$(this).parent().parent().parent().children("tr").children().children(".query_air_infant").val()
        var query_tours_infant=$(this).parent().parent().parent().children("tr").children().children(".query_tours_infant").val()
        var query_transfer_infant=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_infant").val()
        var query_visa_infant=$(this).parent().parent().parent().children("tr").children().children(".query_visa_infant").val()
        var query_inc_infant=$(this).parent().parent().parent().children("tr").children().children(".query_inc_infant").val()
        var query_discount_infant=$(this).parent().parent().parent().children("tr").children().children(".query_discount_infant").val()
        var query_gst_infant=$(this).parent().parent().parent().children("tr").children().children(".query_gst_infant").val()
        //extra start
         var query_cruise_infant=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_infant").val()
        var query_meals_infant=$(this).parent().parent().parent().children("tr").children().children(".query_meals_infant").val()
        var query_markup_infant=$(this).parent().parent().parent().children("tr").children().children(".query_markup_infant").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_infant*query_air_curr)+parseFloat(query_hotel_infant*query_hotel_curr)+parseFloat(query_tours_infant*query_tours_curr)+parseFloat(query_transfer_infant*query_transfer_curr)+parseFloat(query_visa_infant*query_visa_curr)+parseFloat(query_inc_infant*query_inc_curr)+parseFloat(query_gst_infant*query_gst_curr)+parseFloat(query_cruise_infant*query_cruise_curr)+parseFloat(query_meals_infant*query_meals_curr)+parseFloat(query_markup_infant*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_infant/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_infant").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_infant
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_infant").val("").val(total_grand)
    });
    //
    $(document).on('keyup','.query_tours_infant',function()
    {
        var query_tours_infant=$(this).val();
        var query_air_infant=$(this).parent().parent().parent().children("tr").children().children(".query_air_infant").val()
        var query_hotel_infant=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_infant").val()
        var query_transfer_infant=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_infant").val()
        var query_visa_infant=$(this).parent().parent().parent().children("tr").children().children(".query_visa_infant").val()
        var query_inc_infant=$(this).parent().parent().parent().children("tr").children().children(".query_inc_infant").val()
        var query_discount_infant=$(this).parent().parent().parent().children("tr").children().children(".query_discount_infant").val()
        var query_gst_infant=$(this).parent().parent().parent().children("tr").children().children(".query_gst_infant").val()
         //extra start
         var query_cruise_infant=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_infant").val()
        var query_meals_infant=$(this).parent().parent().parent().children("tr").children().children(".query_meals_infant").val()
        var query_markup_infant=$(this).parent().parent().parent().children("tr").children().children(".query_markup_infant").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
         //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_infant*query_air_curr)+parseFloat(query_hotel_infant*query_hotel_curr)+parseFloat(query_tours_infant*query_tours_curr)+parseFloat(query_transfer_infant*query_transfer_curr)+parseFloat(query_visa_infant*query_visa_curr)+parseFloat(query_inc_infant*query_inc_curr)+parseFloat(query_gst_infant*query_gst_curr)+parseFloat(query_cruise_infant*query_cruise_curr)+parseFloat(query_meals_infant*query_meals_curr)+parseFloat(query_markup_infant*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_infant/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_infant").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_infant
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_infant").val("").val(total_grand)
    });
    //
    $(document).on('keyup','.query_transfer_infant',function()
    {
        var query_transfer_infant=$(this).val();
        var query_air_infant=$(this).parent().parent().parent().children("tr").children().children(".query_air_infant").val()
        var query_hotel_infant=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_infant").val()
        var query_tours_infant=$(this).parent().parent().parent().children("tr").children().children(".query_tours_infant").val()
        var query_visa_infant=$(this).parent().parent().parent().children("tr").children().children(".query_visa_infant").val()
        var query_inc_infant=$(this).parent().parent().parent().children("tr").children().children(".query_inc_infant").val()
        var query_discount_infant=$(this).parent().parent().parent().children("tr").children().children(".query_discount_infant").val()
        var query_gst_infant=$(this).parent().parent().parent().children("tr").children().children(".query_gst_infant").val()
          //extra start
         var query_cruise_infant=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_infant").val()
        var query_meals_infant=$(this).parent().parent().parent().children("tr").children().children(".query_meals_infant").val()
        var query_markup_infant=$(this).parent().parent().parent().children("tr").children().children(".query_markup_infant").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
         //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_infant*query_air_curr)+parseFloat(query_hotel_infant*query_hotel_curr)+parseFloat(query_tours_infant*query_tours_curr)+parseFloat(query_transfer_infant*query_transfer_curr)+parseFloat(query_visa_infant*query_visa_curr)+parseFloat(query_inc_infant*query_inc_curr)+parseFloat(query_gst_infant*query_gst_curr)+parseFloat(query_cruise_infant*query_cruise_curr)+parseFloat(query_meals_infant*query_meals_curr)+parseFloat(query_markup_infant*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_infant/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_infant").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_infant
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_infant").val("").val(total_grand)
    });
    //
    $(document).on('keyup','.query_visa_infant',function()
    {
        var query_visa_infant=$(this).val();
        var query_air_infant=$(this).parent().parent().parent().children("tr").children().children(".query_air_infant").val()
        var query_hotel_infant=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_infant").val()
        var query_tours_infant=$(this).parent().parent().parent().children("tr").children().children(".query_tours_infant").val()
        var query_transfer_infant=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_infant").val()
        var query_inc_infant=$(this).parent().parent().parent().children("tr").children().children(".query_inc_infant").val()
        var query_discount_infant=$(this).parent().parent().parent().children("tr").children().children(".query_discount_infant").val()
        var query_gst_infant=$(this).parent().parent().parent().children("tr").children().children(".query_gst_infant").val()
         //extra start
         var query_cruise_infant=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_infant").val()
        var query_meals_infant=$(this).parent().parent().parent().children("tr").children().children(".query_meals_infant").val()
        var query_markup_infant=$(this).parent().parent().parent().children("tr").children().children(".query_markup_infant").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_infant*query_air_curr)+parseFloat(query_hotel_infant*query_hotel_curr)+parseFloat(query_tours_infant*query_tours_curr)+parseFloat(query_transfer_infant*query_transfer_curr)+parseFloat(query_visa_infant*query_visa_curr)+parseFloat(query_inc_infant*query_inc_curr)+parseFloat(query_gst_infant*query_gst_curr)+parseFloat(query_cruise_infant*query_cruise_curr)+parseFloat(query_meals_infant*query_meals_curr)+parseFloat(query_markup_infant*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_infant/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_infant").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_infant
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_infant").val("").val(total_grand)
    });
    //
    $(document).on('keyup','.query_inc_infant',function()
    {
        var query_inc_infant=$(this).val();
        var query_air_infant=$(this).parent().parent().parent().children("tr").children().children(".query_air_infant").val()
        var query_hotel_infant=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_infant").val()
        var query_tours_infant=$(this).parent().parent().parent().children("tr").children().children(".query_tours_infant").val()
        var query_transfer_infant=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_infant").val()
        var query_visa_infant=$(this).parent().parent().parent().children("tr").children().children(".query_visa_infant").val()
        var query_discount_infant=$(this).parent().parent().parent().children("tr").children().children(".query_discount_infant").val()
        var query_gst_infant=$(this).parent().parent().parent().children("tr").children().children(".query_gst_infant").val()
         //extra start
         var query_cruise_infant=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_infant").val()
        var query_meals_infant=$(this).parent().parent().parent().children("tr").children().children(".query_meals_infant").val()
        var query_markup_infant=$(this).parent().parent().parent().children("tr").children().children(".query_markup_infant").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_infant*query_air_curr)+parseFloat(query_hotel_infant*query_hotel_curr)+parseFloat(query_tours_infant*query_tours_curr)+parseFloat(query_transfer_infant*query_transfer_curr)+parseFloat(query_visa_infant*query_visa_curr)+parseFloat(query_inc_infant*query_inc_curr)+parseFloat(query_gst_infant*query_gst_curr)+parseFloat(query_cruise_infant*query_cruise_curr)+parseFloat(query_meals_infant*query_meals_curr)+parseFloat(query_markup_infant*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_infant/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_infant").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_infant
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_infant").val("").val(total_grand)
    });
    //
    $(document).on('keyup','.query_discount_infant',function()
    {
        var query_discount_infant=$(this).val();
        var query_air_infant=$(this).parent().parent().parent().children("tr").children().children(".query_air_infant").val()
        var query_hotel_infant=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_infant").val()
        var query_tours_infant=$(this).parent().parent().parent().children("tr").children().children(".query_tours_infant").val()
        var query_transfer_infant=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_infant").val()
        var query_visa_infant=$(this).parent().parent().parent().children("tr").children().children(".query_visa_infant").val()
        var query_inc_infant=$(this).parent().parent().parent().children("tr").children().children(".query_inc_infant").val()
        var query_gst_infant=$(this).parent().parent().parent().children("tr").children().children(".query_gst_infant").val()
         //extra start
         var query_cruise_infant=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_infant").val()
        var query_meals_infant=$(this).parent().parent().parent().children("tr").children().children(".query_meals_infant").val()
        var query_markup_infant=$(this).parent().parent().parent().children("tr").children().children(".query_markup_infant").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_infant*query_air_curr)+parseFloat(query_hotel_infant*query_hotel_curr)+parseFloat(query_tours_infant*query_tours_curr)+parseFloat(query_transfer_infant*query_transfer_curr)+parseFloat(query_visa_infant*query_visa_curr)+parseFloat(query_inc_infant*query_inc_curr)+parseFloat(query_gst_infant*query_gst_curr)+parseFloat(query_cruise_infant*query_cruise_curr)+parseFloat(query_meals_infant*query_meals_curr)+parseFloat(query_markup_infant*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_infant/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_infant").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_infant
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_infant").val("").val(total_grand)
    });
    //
    $(document).on('keyup','.query_gst_infant',function()
    {
        var query_gst_infant=$(this).val();
        var query_air_infant=$(this).parent().parent().parent().children("tr").children().children(".query_air_infant").val()
        var query_hotel_infant=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_infant").val()
        var query_tours_infant=$(this).parent().parent().parent().children("tr").children().children(".query_tours_infant").val()
        var query_transfer_infant=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_infant").val()
        var query_visa_infant=$(this).parent().parent().parent().children("tr").children().children(".query_visa_infant").val()
        var query_inc_infant=$(this).parent().parent().parent().children("tr").children().children(".query_inc_infant").val()
        var query_discount_infant=$(this).parent().parent().parent().children("tr").children().children(".query_discount_infant").val()
        //extra start
         var query_cruise_infant=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_infant").val()
        var query_meals_infant=$(this).parent().parent().parent().children("tr").children().children(".query_meals_infant").val()
        var query_markup_infant=$(this).parent().parent().parent().children("tr").children().children(".query_markup_infant").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
         //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_infant*query_air_curr)+parseFloat(query_hotel_infant*query_hotel_curr)+parseFloat(query_tours_infant*query_tours_curr)+parseFloat(query_transfer_infant*query_transfer_curr)+parseFloat(query_visa_infant*query_visa_curr)+parseFloat(query_inc_infant*query_inc_curr)+parseFloat(query_gst_infant*query_gst_curr)+parseFloat(query_cruise_infant*query_cruise_curr)+parseFloat(query_meals_infant*query_meals_curr)+parseFloat(query_markup_infant*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_infant/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_infant").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_infant
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_infant").val("").val(total_grand)
    });
    $(document).on('keyup','.query_cruise_infant',function()
    {
        var query_gst_infant=$(this).parent().parent().parent().children("tr").children().children(".query_gst_infant").val()
        var query_air_infant=$(this).parent().parent().parent().children("tr").children().children(".query_air_infant").val()
        var query_hotel_infant=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_infant").val()
        var query_tours_infant=$(this).parent().parent().parent().children("tr").children().children(".query_tours_infant").val()
        var query_transfer_infant=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_infant").val()
        var query_visa_infant=$(this).parent().parent().parent().children("tr").children().children(".query_visa_infant").val()
        var query_inc_infant=$(this).parent().parent().parent().children("tr").children().children(".query_inc_infant").val()
        var query_discount_infant=$(this).parent().parent().parent().children("tr").children().children(".query_discount_infant").val()
        //extra start
         var query_cruise_infant=$(this).val();
        var query_meals_infant=$(this).parent().parent().parent().children("tr").children().children(".query_meals_infant").val()
        var query_markup_infant=$(this).parent().parent().parent().children("tr").children().children(".query_markup_infant").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
         //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_infant*query_air_curr)+parseFloat(query_hotel_infant*query_hotel_curr)+parseFloat(query_tours_infant*query_tours_curr)+parseFloat(query_transfer_infant*query_transfer_curr)+parseFloat(query_visa_infant*query_visa_curr)+parseFloat(query_inc_infant*query_inc_curr)+parseFloat(query_gst_infant*query_gst_curr)+parseFloat(query_cruise_infant*query_cruise_curr)+parseFloat(query_meals_infant*query_meals_curr)+parseFloat(query_markup_infant*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_infant/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_infant").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_infant
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_infant").val("").val(total_grand)
    });
    $(document).on('keyup','.query_meals_infant',function()
    {
        var query_gst_infant=$(this).parent().parent().parent().children("tr").children().children(".query_gst_infant").val()
        var query_air_infant=$(this).parent().parent().parent().children("tr").children().children(".query_air_infant").val()
        var query_hotel_infant=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_infant").val()
        var query_tours_infant=$(this).parent().parent().parent().children("tr").children().children(".query_tours_infant").val()
        var query_transfer_infant=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_infant").val()
        var query_visa_infant=$(this).parent().parent().parent().children("tr").children().children(".query_visa_infant").val()
        var query_inc_infant=$(this).parent().parent().parent().children("tr").children().children(".query_inc_infant").val()
        var query_discount_infant=$(this).parent().parent().parent().children("tr").children().children(".query_discount_infant").val()
        //extra start
         var query_cruise_infant=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_infant").val()
        var query_meals_infant=$(this).val();
        var query_markup_infant=$(this).parent().parent().parent().children("tr").children().children(".query_markup_infant").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
         //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_infant*query_air_curr)+parseFloat(query_hotel_infant*query_hotel_curr)+parseFloat(query_tours_infant*query_tours_curr)+parseFloat(query_transfer_infant*query_transfer_curr)+parseFloat(query_visa_infant*query_visa_curr)+parseFloat(query_inc_infant*query_inc_curr)+parseFloat(query_gst_infant*query_gst_curr)+parseFloat(query_cruise_infant*query_cruise_curr)+parseFloat(query_meals_infant*query_meals_curr)+parseFloat(query_markup_infant*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_infant/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_infant").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_infant
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_infant").val("").val(total_grand)
    });
    $(document).on('keyup','.query_markup_infant',function()
    {
        var query_gst_infant=$(this).parent().parent().parent().children("tr").children().children(".query_gst_infant").val()
        var query_air_infant=$(this).parent().parent().parent().children("tr").children().children(".query_air_infant").val()
        var query_hotel_infant=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_infant").val()
        var query_tours_infant=$(this).parent().parent().parent().children("tr").children().children(".query_tours_infant").val()
        var query_transfer_infant=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_infant").val()
        var query_visa_infant=$(this).parent().parent().parent().children("tr").children().children(".query_visa_infant").val()
        var query_inc_infant=$(this).parent().parent().parent().children("tr").children().children(".query_inc_infant").val()
        var query_discount_infant=$(this).parent().parent().parent().children("tr").children().children(".query_discount_infant").val()
        //extra start
         var query_cruise_infant=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_infant").val()
        var query_meals_infant=$(this).parent().parent().parent().children("tr").children().children(".query_meals_infant").val()
        var query_markup_infant=$(this).val();
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
         //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_infant*query_air_curr)+parseFloat(query_hotel_infant*query_hotel_curr)+parseFloat(query_tours_infant*query_tours_curr)+parseFloat(query_transfer_infant*query_transfer_curr)+parseFloat(query_visa_infant*query_visa_curr)+parseFloat(query_inc_infant*query_inc_curr)+parseFloat(query_gst_infant*query_gst_curr)+parseFloat(query_cruise_infant*query_cruise_curr)+parseFloat(query_meals_infant*query_meals_curr)+parseFloat(query_markup_infant*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_infant/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_infant").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_infant
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_infant").val("").val(total_grand)
    });
    //column 6 start
    $(document).on('keyup','.query_air_single',function()
    {
        var query_air_single=$(this).val();
        var query_hotel_single=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_single").val()
        var query_tours_single=$(this).parent().parent().parent().children("tr").children().children(".query_tours_single").val()
        var query_transfer_single=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_single").val()
        var query_visa_single=$(this).parent().parent().parent().children("tr").children().children(".query_visa_single").val()
        var query_inc_single=$(this).parent().parent().parent().children("tr").children().children(".query_inc_single").val()
        var query_discount_single=$(this).parent().parent().parent().children("tr").children().children(".query_discount_single").val()
        var query_gst_single=$(this).parent().parent().parent().children("tr").children().children(".query_gst_single").val()
         //extra start
         var query_cruise_single=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_single").val()
        var query_meals_single=$(this).parent().parent().parent().children("tr").children().children(".query_meals_single").val()
        var query_markup_single=$(this).parent().parent().parent().children("tr").children().children(".query_markup_single").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_single*query_air_curr)+parseFloat(query_hotel_single*query_hotel_curr)+parseFloat(query_tours_single*query_tours_curr)+parseFloat(query_transfer_single*query_transfer_curr)+parseFloat(query_visa_single*query_visa_curr)+parseFloat(query_inc_single*query_inc_curr)+parseFloat(query_gst_single*query_gst_curr)+parseFloat(query_cruise_single*query_cruise_curr)+parseFloat(query_meals_single*query_meals_curr)+parseFloat(query_markup_single*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_single/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_single").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_single
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_single").val("").val(total_grand)
    });
    //
    $(document).on('keyup','.query_hotel_single',function()
    {
        var query_hotel_single=$(this).val();
        var query_air_single=$(this).parent().parent().parent().children("tr").children().children(".query_air_single").val()
        var query_tours_single=$(this).parent().parent().parent().children("tr").children().children(".query_tours_single").val()
        var query_transfer_single=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_single").val()
        var query_visa_single=$(this).parent().parent().parent().children("tr").children().children(".query_visa_single").val()
        var query_inc_single=$(this).parent().parent().parent().children("tr").children().children(".query_inc_single").val()
        var query_discount_single=$(this).parent().parent().parent().children("tr").children().children(".query_discount_single").val()
        var query_gst_single=$(this).parent().parent().parent().children("tr").children().children(".query_gst_single").val()
         //extra start
         var query_cruise_single=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_single").val()
        var query_meals_single=$(this).parent().parent().parent().children("tr").children().children(".query_meals_single").val()
        var query_markup_single=$(this).parent().parent().parent().children("tr").children().children(".query_markup_single").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_single*query_air_curr)+parseFloat(query_hotel_single*query_hotel_curr)+parseFloat(query_tours_single*query_tours_curr)+parseFloat(query_transfer_single*query_transfer_curr)+parseFloat(query_visa_single*query_visa_curr)+parseFloat(query_inc_single*query_inc_curr)+parseFloat(query_gst_single*query_gst_curr)+parseFloat(query_cruise_single*query_cruise_curr)+parseFloat(query_meals_single*query_meals_curr)+parseFloat(query_markup_single*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_single/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_single").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_single
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_single").val("").val(total_grand)
    });
    //
    $(document).on('keyup','.query_tours_single',function()
    {
        var query_tours_single=$(this).val();
        var query_air_single=$(this).parent().parent().parent().children("tr").children().children(".query_air_single").val()
        var query_hotel_single=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_single").val()
        var query_transfer_single=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_single").val()
        var query_visa_single=$(this).parent().parent().parent().children("tr").children().children(".query_visa_single").val()
        var query_inc_single=$(this).parent().parent().parent().children("tr").children().children(".query_inc_single").val()
        var query_discount_single=$(this).parent().parent().parent().children("tr").children().children(".query_discount_single").val()
        var query_gst_single=$(this).parent().parent().parent().children("tr").children().children(".query_gst_single").val()
         //extra start
         var query_cruise_single=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_single").val()
        var query_meals_single=$(this).parent().parent().parent().children("tr").children().children(".query_meals_single").val()
        var query_markup_single=$(this).parent().parent().parent().children("tr").children().children(".query_markup_single").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
         var total=parseFloat(query_air_single*query_air_curr)+parseFloat(query_hotel_single*query_hotel_curr)+parseFloat(query_tours_single*query_tours_curr)+parseFloat(query_transfer_single*query_transfer_curr)+parseFloat(query_visa_single*query_visa_curr)+parseFloat(query_inc_single*query_inc_curr)+parseFloat(query_gst_single*query_gst_curr)+parseFloat(query_cruise_single*query_cruise_curr)+parseFloat(query_meals_single*query_meals_curr)+parseFloat(query_markup_single*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_single/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_single").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_single
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_single").val("").val(total_grand)
    });
    //
    $(document).on('keyup','.query_transfer_single',function()
    {
        var query_transfer_single=$(this).val();
        var query_air_single=$(this).parent().parent().parent().children("tr").children().children(".query_air_single").val()
        var query_hotel_single=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_single").val()
        var query_tours_single=$(this).parent().parent().parent().children("tr").children().children(".query_tours_single").val()
        var query_visa_single=$(this).parent().parent().parent().children("tr").children().children(".query_visa_single").val()
        var query_inc_single=$(this).parent().parent().parent().children("tr").children().children(".query_inc_single").val()
        var query_discount_single=$(this).parent().parent().parent().children("tr").children().children(".query_discount_single").val()
        var query_gst_single=$(this).parent().parent().parent().children("tr").children().children(".query_gst_single").val()
        //extra start
         var query_cruise_single=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_single").val()
        var query_meals_single=$(this).parent().parent().parent().children("tr").children().children(".query_meals_single").val()
        var query_markup_single=$(this).parent().parent().parent().children("tr").children().children(".query_markup_single").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
         //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_single*query_air_curr)+parseFloat(query_hotel_single*query_hotel_curr)+parseFloat(query_tours_single*query_tours_curr)+parseFloat(query_transfer_single*query_transfer_curr)+parseFloat(query_visa_single*query_visa_curr)+parseFloat(query_inc_single*query_inc_curr)+parseFloat(query_gst_single*query_gst_curr)+parseFloat(query_cruise_single*query_cruise_curr)+parseFloat(query_meals_single*query_meals_curr)+parseFloat(query_markup_single*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_single/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_single").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_single
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_single").val("").val(total_grand)
    });
    //
    $(document).on('keyup','.query_visa_single',function()
    {
        var query_visa_single=$(this).val();
        var query_air_single=$(this).parent().parent().parent().children("tr").children().children(".query_air_single").val()
        var query_hotel_single=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_single").val()
        var query_tours_single=$(this).parent().parent().parent().children("tr").children().children(".query_tours_single").val()
        var query_transfer_single=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_single").val()
        var query_inc_single=$(this).parent().parent().parent().children("tr").children().children(".query_inc_single").val()
        var query_discount_single=$(this).parent().parent().parent().children("tr").children().children(".query_discount_single").val()
        var query_gst_single=$(this).parent().parent().parent().children("tr").children().children(".query_gst_single").val()
         //extra start
         var query_cruise_single=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_single").val()
        var query_meals_single=$(this).parent().parent().parent().children("tr").children().children(".query_meals_single").val()
        var query_markup_single=$(this).parent().parent().parent().children("tr").children().children(".query_markup_single").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_single*query_air_curr)+parseFloat(query_hotel_single*query_hotel_curr)+parseFloat(query_tours_single*query_tours_curr)+parseFloat(query_transfer_single*query_transfer_curr)+parseFloat(query_visa_single*query_visa_curr)+parseFloat(query_inc_single*query_inc_curr)+parseFloat(query_gst_single*query_gst_curr)+parseFloat(query_cruise_single*query_cruise_curr)+parseFloat(query_meals_single*query_meals_curr)+parseFloat(query_markup_single*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_single/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_single").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_single
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_single").val("").val(total_grand)
    });
    //
    $(document).on('keyup','.query_inc_single',function()
    {
        var query_inc_single=$(this).val();
        var query_air_single=$(this).parent().parent().parent().children("tr").children().children(".query_air_single").val()
        var query_hotel_single=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_single").val()
        var query_tours_single=$(this).parent().parent().parent().children("tr").children().children(".query_tours_single").val()
        var query_transfer_single=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_single").val()
        var query_visa_single=$(this).parent().parent().parent().children("tr").children().children(".query_visa_single").val()
        var query_discount_single=$(this).parent().parent().parent().children("tr").children().children(".query_discount_single").val()
        var query_gst_single=$(this).parent().parent().parent().children("tr").children().children(".query_gst_single").val()
        //extra start
         var query_cruise_single=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_single").val()
        var query_meals_single=$(this).parent().parent().parent().children("tr").children().children(".query_meals_single").val()
        var query_markup_single=$(this).parent().parent().parent().children("tr").children().children(".query_markup_single").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_single*query_air_curr)+parseFloat(query_hotel_single*query_hotel_curr)+parseFloat(query_tours_single*query_tours_curr)+parseFloat(query_transfer_single*query_transfer_curr)+parseFloat(query_visa_single*query_visa_curr)+parseFloat(query_inc_single*query_inc_curr)+parseFloat(query_gst_single*query_gst_curr)+parseFloat(query_cruise_single*query_cruise_curr)+parseFloat(query_meals_single*query_meals_curr)+parseFloat(query_markup_single*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_single/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_single").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_single
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_single").val("").val(total_grand)
    });
    //
    $(document).on('keyup','.query_discount_single',function()
    {
        var query_discount_single=$(this).val();
        var query_air_single=$(this).parent().parent().parent().children("tr").children().children(".query_air_single").val()
        var query_hotel_single=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_single").val()
        var query_tours_single=$(this).parent().parent().parent().children("tr").children().children(".query_tours_single").val()
        var query_transfer_single=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_single").val()
        var query_visa_single=$(this).parent().parent().parent().children("tr").children().children(".query_visa_single").val()
        var query_inc_single=$(this).parent().parent().parent().children("tr").children().children(".query_inc_single").val()
        var query_gst_single=$(this).parent().parent().parent().children("tr").children().children(".query_gst_single").val()
        //extra start
         var query_cruise_single=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_single").val()
        var query_meals_single=$(this).parent().parent().parent().children("tr").children().children(".query_meals_single").val()
        var query_markup_single=$(this).parent().parent().parent().children("tr").children().children(".query_markup_single").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_single*query_air_curr)+parseFloat(query_hotel_single*query_hotel_curr)+parseFloat(query_tours_single*query_tours_curr)+parseFloat(query_transfer_single*query_transfer_curr)+parseFloat(query_visa_single*query_visa_curr)+parseFloat(query_inc_single*query_inc_curr)+parseFloat(query_gst_single*query_gst_curr)+parseFloat(query_cruise_single*query_cruise_curr)+parseFloat(query_meals_single*query_meals_curr)+parseFloat(query_markup_single*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_single/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_single").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_single
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_single").val("").val(total_grand)
    });
    //
    $(document).on('keyup','.query_gst_single',function()
    {
        var query_gst_single=$(this).val();
        var query_air_single=$(this).parent().parent().parent().children("tr").children().children(".query_air_single").val()
        var query_hotel_single=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_single").val()
        var query_tours_single=$(this).parent().parent().parent().children("tr").children().children(".query_tours_single").val()
        var query_transfer_single=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_single").val()
        var query_visa_single=$(this).parent().parent().parent().children("tr").children().children(".query_visa_single").val()
        var query_inc_single=$(this).parent().parent().parent().children("tr").children().children(".query_inc_single").val()
        var query_discount_single=$(this).parent().parent().parent().children("tr").children().children(".query_discount_single").val()
        //extra start
         var query_cruise_single=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_single").val()
        var query_meals_single=$(this).parent().parent().parent().children("tr").children().children(".query_meals_single").val()
        var query_markup_single=$(this).parent().parent().parent().children("tr").children().children(".query_markup_single").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_single*query_air_curr)+parseFloat(query_hotel_single*query_hotel_curr)+parseFloat(query_tours_single*query_tours_curr)+parseFloat(query_transfer_single*query_transfer_curr)+parseFloat(query_visa_single*query_visa_curr)+parseFloat(query_inc_single*query_inc_curr)+parseFloat(query_gst_single*query_gst_curr)+parseFloat(query_cruise_single*query_cruise_curr)+parseFloat(query_meals_single*query_meals_curr)+parseFloat(query_markup_single*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_single/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_single").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_single
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_single").val("").val(total_grand)
    });
    $(document).on('keyup','.query_cruise_single',function()
    {
        var query_gst_single=$(this).parent().parent().parent().children("tr").children().children(".query_gst_single").val()
        var query_air_single=$(this).parent().parent().parent().children("tr").children().children(".query_air_single").val()
        var query_hotel_single=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_single").val()
        var query_tours_single=$(this).parent().parent().parent().children("tr").children().children(".query_tours_single").val()
        var query_transfer_single=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_single").val()
        var query_visa_single=$(this).parent().parent().parent().children("tr").children().children(".query_visa_single").val()
        var query_inc_single=$(this).parent().parent().parent().children("tr").children().children(".query_inc_single").val()
        var query_discount_single=$(this).parent().parent().parent().children("tr").children().children(".query_discount_single").val()
        //extra start
         var query_cruise_single=$(this).val();
        var query_meals_single=$(this).parent().parent().parent().children("tr").children().children(".query_meals_single").val()
        var query_markup_single=$(this).parent().parent().parent().children("tr").children().children(".query_markup_single").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_single*query_air_curr)+parseFloat(query_hotel_single*query_hotel_curr)+parseFloat(query_tours_single*query_tours_curr)+parseFloat(query_transfer_single*query_transfer_curr)+parseFloat(query_visa_single*query_visa_curr)+parseFloat(query_inc_single*query_inc_curr)+parseFloat(query_gst_single*query_gst_curr)+parseFloat(query_cruise_single*query_cruise_curr)+parseFloat(query_meals_single*query_meals_curr)+parseFloat(query_markup_single*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_single/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_single").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_single
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_single").val("").val(total_grand)
    });
    $(document).on('keyup','.query_meals_single',function()
    {
        var query_gst_single=$(this).parent().parent().parent().children("tr").children().children(".query_gst_single").val()
        var query_air_single=$(this).parent().parent().parent().children("tr").children().children(".query_air_single").val()
        var query_hotel_single=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_single").val()
        var query_tours_single=$(this).parent().parent().parent().children("tr").children().children(".query_tours_single").val()
        var query_transfer_single=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_single").val()
        var query_visa_single=$(this).parent().parent().parent().children("tr").children().children(".query_visa_single").val()
        var query_inc_single=$(this).parent().parent().parent().children("tr").children().children(".query_inc_single").val()
        var query_discount_single=$(this).parent().parent().parent().children("tr").children().children(".query_discount_single").val()
        //extra start
         var query_cruise_single=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_single").val()
        var query_meals_single=$(this).val();
        var query_markup_single=$(this).parent().parent().parent().children("tr").children().children(".query_markup_single").val()
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_single*query_air_curr)+parseFloat(query_hotel_single*query_hotel_curr)+parseFloat(query_tours_single*query_tours_curr)+parseFloat(query_transfer_single*query_transfer_curr)+parseFloat(query_visa_single*query_visa_curr)+parseFloat(query_inc_single*query_inc_curr)+parseFloat(query_gst_single*query_gst_curr)+parseFloat(query_cruise_single*query_cruise_curr)+parseFloat(query_meals_single*query_meals_curr)+parseFloat(query_markup_single*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_single/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_single").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_single
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_single").val("").val(total_grand)
    });
    $(document).on('keyup','.query_markup_single',function()
    {
        var query_gst_single=$(this).parent().parent().parent().children("tr").children().children(".query_gst_single").val()
        var query_air_single=$(this).parent().parent().parent().children("tr").children().children(".query_air_single").val()
        var query_hotel_single=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_single").val()
        var query_tours_single=$(this).parent().parent().parent().children("tr").children().children(".query_tours_single").val()
        var query_transfer_single=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_single").val()
        var query_visa_single=$(this).parent().parent().parent().children("tr").children().children(".query_visa_single").val()
        var query_inc_single=$(this).parent().parent().parent().children("tr").children().children(".query_inc_single").val()
        var query_discount_single=$(this).parent().parent().parent().children("tr").children().children(".query_discount_single").val()
        //extra start
         var query_cruise_single=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_single").val()
        var query_meals_single=$(this).parent().parent().parent().children("tr").children().children(".query_meals_single").val()
        var query_markup_single=$(this).val();
      
        //extra end
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        
        var total=parseFloat(query_air_single*query_air_curr)+parseFloat(query_hotel_single*query_hotel_curr)+parseFloat(query_tours_single*query_tours_curr)+parseFloat(query_transfer_single*query_transfer_curr)+parseFloat(query_visa_single*query_visa_curr)+parseFloat(query_inc_single*query_inc_curr)+parseFloat(query_gst_single*query_gst_curr)+parseFloat(query_cruise_single*query_cruise_curr)+parseFloat(query_meals_single*query_meals_curr)+parseFloat(query_markup_single*query_markup_curr)
        
        //var total=parseFloat(total)-parseFloat(total*query_discount_single/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_single").val("").val(total)
        var total_grand=parseFloat(total)-query_discount_single
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_single").val("").val(total_grand)
    });

    //currency change part 1
    $(document).on('change','.query_air_curr',function()
    {
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
       
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")
        

        var query_air_adult=$(this).parent().parent().parent().children("tr").children().children(".query_air_adult").val()
        var query_hotel_adult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_adult").val()
        var query_tours_adult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_adult").val()
        var query_transfer_adult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_adult").val()
        var query_visa_adult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_adult").val()
        var query_inc_adult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_adult").val()
        var query_discount_adult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_adult").val()
        var query_gst_adult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_adult").val()
        //
        var query_cruise_adult=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_adult").val()
        var query_meals_adult=$(this).parent().parent().parent().children("tr").children().children(".query_meals_adult").val()
        var query_markup_adult=$(this).parent().parent().parent().children("tr").children().children(".query_markup_adult").val()
        
        //
       
        
        var total1=parseFloat(query_air_adult*query_air_curr)+parseFloat(query_hotel_adult*query_hotel_curr)+parseFloat(query_tours_adult*query_tours_curr)+parseFloat(query_transfer_adult*query_transfer_curr)+parseFloat(query_visa_adult*query_visa_curr)+parseFloat(query_inc_adult*query_inc_curr)+parseFloat(query_gst_adult*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_adult)+parseFloat(query_meals_adult*query_meals_curr)+parseFloat(query_markup_adult*query_markup_curr)
        
        //var total1=parseFloat(total1)-parseFloat(total1*query_discount_adult/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_adult").val("").val(total1)
        var total_grand1=parseFloat(total1)-query_discount_adult
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_adult").val("").val(total_grand1)
       //line 2 end 

        var query_air_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_air_exadult").val()
        var query_hotel_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_exadult").val()
        var query_tours_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_exadult").val()
        var query_transfer_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_exadult").val()
        var query_visa_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_exadult").val()
        var query_inc_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_exadult").val()
        var query_discount_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_exadult").val()
        var query_gst_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_exadult").val()
        
        //
        var query_cruise_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_exadult").val()
        var query_meals_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_meals_exadult").val()
        var query_markup_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_markup_exadult").val()
        
        //
        
        var total2=parseFloat(query_air_exadult*query_air_curr)+parseFloat(query_hotel_exadult*query_hotel_curr)+parseFloat(query_tours_exadult*query_tours_curr)+parseFloat(query_transfer_exadult*query_transfer_curr)+parseFloat(query_visa_exadult*query_visa_curr)+parseFloat(query_inc_exadult*query_inc_curr)+parseFloat(query_gst_exadult*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_exadult)+parseFloat(query_meals_exadult*query_meals_curr)+parseFloat(query_markup_exadult*query_markup_curr)
        
        //var total2=parseFloat(total2)-parseFloat(total2*query_discount_exadult/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_exadult").val("").val(total2)
        var total_grand2=parseFloat(total2)-query_discount_exadult
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_exadult").val("").val(total_grand2)
        
        //line 3 start
        var query_air_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childbed").val()
        var query_hotel_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childbed").val()
        var query_tours_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childbed").val()
        var query_transfer_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childbed").val()
        var query_visa_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childbed").val()
        var query_inc_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childbed").val()
        var query_discount_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childbed").val()
        var query_gst_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childbed").val()
        //
        var query_cruise_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_childbed").val()
        var query_meals_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_meals_childbed").val()
        var query_markup_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_markup_childbed").val()
        
        //
     
        var total3=parseFloat(query_air_childbed*query_air_curr)+parseFloat(query_hotel_childbed*query_hotel_curr)+parseFloat(query_tours_childbed*query_tours_curr)+parseFloat(query_transfer_childbed*query_transfer_curr)+parseFloat(query_visa_childbed*query_visa_curr)+parseFloat(query_inc_childbed*query_inc_curr)+parseFloat(query_gst_childbed*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_childbed)+parseFloat(query_meals_childbed*query_meals_curr)+parseFloat(query_markup_childbed*query_markup_curr)
        
        //var total3=parseFloat(total3)-parseFloat(total3*query_discount_childbed/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_childbed").val("").val(total3)
        var total_grand3=parseFloat(total3)-query_discount_childbed
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_childbed").val("").val(total_grand3)
        //line 4
        var query_air_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childwbed").val()
        var query_hotel_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childwbed").val()
        var query_tours_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childwbed").val()
        var query_transfer_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childwbed").val()
        var query_visa_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childwbed").val()
        var query_inc_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childwbed").val()
        var query_discount_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childwbed").val()
        var query_gst_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childwbed").val()
        //
        var query_cruise_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_childwbed").val()
        var query_meals_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_meals_childwbed").val()
        var query_markup_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_markup_childwbed").val()
        
        //
      
        var total4=parseFloat(query_air_childwbed*query_air_curr)+parseFloat(query_hotel_childwbed*query_hotel_curr)+parseFloat(query_tours_childwbed*query_tours_curr)+parseFloat(query_transfer_childwbed*query_transfer_curr)+parseFloat(query_visa_childwbed*query_visa_curr)+parseFloat(query_inc_childwbed*query_inc_curr)+parseFloat(query_gst_childwbed*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_childwbed)+parseFloat(query_meals_childwbed*query_meals_curr)+parseFloat(query_markup_childwbed*query_markup_curr)
        
        //var total4=parseFloat(total4)-parseFloat(total4*query_discount_childwbed/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_childwbed").val("").val(total4)
        var total_grand4=parseFloat(total4)-query_discount_childwbed
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_childwbed").val("").val(total_grand4)
        
        //line 5
        var query_air_infant=$(this).parent().parent().parent().children("tr").children().children(".query_air_infant").val()
        var query_hotel_infant=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_infant").val()
        var query_tours_infant=$(this).parent().parent().parent().children("tr").children().children(".query_tours_infant").val()
        var query_transfer_infant=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_infant").val()
        var query_visa_infant=$(this).parent().parent().parent().children("tr").children().children(".query_visa_infant").val()
        var query_inc_infant=$(this).parent().parent().parent().children("tr").children().children(".query_inc_infant").val()
        var query_discount_infant=$(this).parent().parent().parent().children("tr").children().children(".query_discount_infant").val()
        var query_gst_infant=$(this).parent().parent().parent().children("tr").children().children(".query_gst_infant").val()
        //
        var query_cruise_infant=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_infant").val()
        var query_meals_infant=$(this).parent().parent().parent().children("tr").children().children(".query_meals_infant").val()
        var query_markup_infant=$(this).parent().parent().parent().children("tr").children().children(".query_markup_infant").val()
        
        //
     
        var total5=parseFloat(query_air_infant*query_air_curr)+parseFloat(query_hotel_infant*query_hotel_curr)+parseFloat(query_tours_infant*query_tours_curr)+parseFloat(query_transfer_infant*query_transfer_curr)+parseFloat(query_visa_infant*query_visa_curr)+parseFloat(query_inc_infant*query_inc_curr)+parseFloat(query_gst_infant*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_infant)+parseFloat(query_meals_infant*query_meals_curr)+parseFloat(query_markup_infant*query_markup_curr)
        
        //var total5=parseFloat(total5)-parseFloat(total5*query_discount_infant/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_infant").val("").val(total5)
        var total_grand5=parseFloat(total5)-query_discount_infant
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_infant").val("").val(total_grand5)
        
        //line6
        var query_air_single=$(this).parent().parent().parent().children("tr").children().children(".query_air_single").val()
        var query_hotel_single=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_single").val()
        var query_tours_single=$(this).parent().parent().parent().children("tr").children().children(".query_tours_single").val()
        var query_transfer_single=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_single").val()
        var query_visa_single=$(this).parent().parent().parent().children("tr").children().children(".query_visa_single").val()
        var query_inc_single=$(this).parent().parent().parent().children("tr").children().children(".query_inc_single").val()
        var query_discount_single=$(this).parent().parent().parent().children("tr").children().children(".query_discount_single").val()
        var query_gst_single=$(this).parent().parent().parent().children("tr").children().children(".query_gst_single").val()
        //
        var query_cruise_single=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_single").val()
        var query_meals_single=$(this).parent().parent().parent().children("tr").children().children(".query_meals_single").val()
        var query_markup_single=$(this).parent().parent().parent().children("tr").children().children(".query_markup_single").val()
        //
        var total6=parseFloat(query_air_single*query_air_curr)+parseFloat(query_hotel_single*query_hotel_curr)+parseFloat(query_tours_single*query_tours_curr)+parseFloat(query_transfer_single*query_transfer_curr)+parseFloat(query_visa_single*query_visa_curr)+parseFloat(query_inc_single*query_inc_curr)+parseFloat(query_gst_single*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_single)+parseFloat(query_meals_single*query_meals_curr)+parseFloat(query_markup_single*query_markup_curr)
        
        //var total6=parseFloat(total6)-parseFloat(total6*query_discount_single/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_single").val("").val(total6)
        var total_grand6=parseFloat(total6)-query_discount_single
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_single").val("").val(total_grand6)
    });
    //2
    $(document).on('change','.query_hotel_curr',function()
    {
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
       
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")


        var query_air_adult=$(this).parent().parent().parent().children("tr").children().children(".query_air_adult").val()
        var query_hotel_adult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_adult").val()
        var query_tours_adult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_adult").val()
        var query_transfer_adult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_adult").val()
        var query_visa_adult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_adult").val()
        var query_inc_adult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_adult").val()
        var query_discount_adult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_adult").val()
        var query_gst_adult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_adult").val()
        //
        var query_cruise_adult=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_adult").val()
        var query_meals_adult=$(this).parent().parent().parent().children("tr").children().children(".query_meals_adult").val()
        var query_markup_adult=$(this).parent().parent().parent().children("tr").children().children(".query_markup_adult").val()
        
        //
       
        
        var total1=parseFloat(query_air_adult*query_air_curr)+parseFloat(query_hotel_adult*query_hotel_curr)+parseFloat(query_tours_adult*query_tours_curr)+parseFloat(query_transfer_adult*query_transfer_curr)+parseFloat(query_visa_adult*query_visa_curr)+parseFloat(query_inc_adult*query_inc_curr)+parseFloat(query_gst_adult*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_adult)+parseFloat(query_meals_adult*query_meals_curr)+parseFloat(query_markup_adult*query_markup_curr)
        
        //var total1=parseFloat(total1)-parseFloat(total1*query_discount_adult/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_adult").val("").val(total1)
        var total_grand1=parseFloat(total1)-query_discount_adult
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_adult").val("").val(total_grand1)
       //line 2 end 

        var query_air_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_air_exadult").val()
        var query_hotel_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_exadult").val()
        var query_tours_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_exadult").val()
        var query_transfer_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_exadult").val()
        var query_visa_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_exadult").val()
        var query_inc_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_exadult").val()
        var query_discount_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_exadult").val()
        var query_gst_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_exadult").val()
        //
        var query_cruise_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_exadult").val()
        var query_meals_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_meals_exadult").val()
        var query_markup_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_markup_exadult").val()
        
        //
        
        var total2=parseFloat(query_air_exadult*query_air_curr)+parseFloat(query_hotel_exadult*query_hotel_curr)+parseFloat(query_tours_exadult*query_tours_curr)+parseFloat(query_transfer_exadult*query_transfer_curr)+parseFloat(query_visa_exadult*query_visa_curr)+parseFloat(query_inc_exadult*query_inc_curr)+parseFloat(query_gst_exadult*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_exadult)+parseFloat(query_meals_exadult*query_meals_curr)+parseFloat(query_markup_exadult*query_markup_curr)
        
        //var total2=parseFloat(total2)-parseFloat(total2*query_discount_exadult/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_exadult").val("").val(total2)
        var total_grand2=parseFloat(total2)-query_discount_exadult
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_exadult").val("").val(total_grand2)
        
        //line 3 start
        var query_air_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childbed").val()
        var query_hotel_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childbed").val()
        var query_tours_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childbed").val()
        var query_transfer_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childbed").val()
        var query_visa_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childbed").val()
        var query_inc_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childbed").val()
        var query_discount_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childbed").val()
        var query_gst_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childbed").val()
        //
        var query_cruise_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_childbed").val()
        var query_meals_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_meals_childbed").val()
        var query_markup_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_markup_childbed").val()
        
        //
     
        var total3=parseFloat(query_air_childbed*query_air_curr)+parseFloat(query_hotel_childbed*query_hotel_curr)+parseFloat(query_tours_childbed*query_tours_curr)+parseFloat(query_transfer_childbed*query_transfer_curr)+parseFloat(query_visa_childbed*query_visa_curr)+parseFloat(query_inc_childbed*query_inc_curr)+parseFloat(query_gst_childbed*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_childbed)+parseFloat(query_meals_childbed*query_meals_curr)+parseFloat(query_markup_childbed*query_markup_curr)
        
        //var total3=parseFloat(total3)-parseFloat(total3*query_discount_childbed/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_childbed").val("").val(total3)
        var total_grand3=parseFloat(total3)-query_gst_childbed
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_childbed").val("").val(total_grand3)
        //line 4
        var query_air_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childwbed").val()
        var query_hotel_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childwbed").val()
        var query_tours_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childwbed").val()
        var query_transfer_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childwbed").val()
        var query_visa_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childwbed").val()
        var query_inc_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childwbed").val()
        var query_discount_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childwbed").val()
        var query_gst_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childwbed").val()
        //
        var query_cruise_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_childwbed").val()
        var query_meals_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_meals_childwbed").val()
        var query_markup_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_markup_childwbed").val()
        
        //
      
        var total4=parseFloat(query_air_childwbed*query_air_curr)+parseFloat(query_hotel_childwbed*query_hotel_curr)+parseFloat(query_tours_childwbed*query_tours_curr)+parseFloat(query_transfer_childwbed*query_transfer_curr)+parseFloat(query_visa_childwbed*query_visa_curr)+parseFloat(query_inc_childwbed*query_inc_curr)+parseFloat(query_gst_childwbed*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_childwbed)+parseFloat(query_meals_childwbed*query_meals_curr)+parseFloat(query_markup_childwbed*query_markup_curr)
        
        //var total4=parseFloat(total4)-parseFloat(total4*query_discount_childwbed/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_childwbed").val("").val(total4)
        var total_grand4=parseFloat(total4)-query_discount_childwbed
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_childwbed").val("").val(total_grand4)
        
        //line 5
        var query_air_infant=$(this).parent().parent().parent().children("tr").children().children(".query_air_infant").val()
        var query_hotel_infant=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_infant").val()
        var query_tours_infant=$(this).parent().parent().parent().children("tr").children().children(".query_tours_infant").val()
        var query_transfer_infant=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_infant").val()
        var query_visa_infant=$(this).parent().parent().parent().children("tr").children().children(".query_visa_infant").val()
        var query_inc_infant=$(this).parent().parent().parent().children("tr").children().children(".query_inc_infant").val()
        var query_discount_infant=$(this).parent().parent().parent().children("tr").children().children(".query_discount_infant").val()
        var query_gst_infant=$(this).parent().parent().parent().children("tr").children().children(".query_gst_infant").val()
        //
        var query_cruise_infant=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_infant").val()
        var query_meals_infant=$(this).parent().parent().parent().children("tr").children().children(".query_meals_infant").val()
        var query_markup_infant=$(this).parent().parent().parent().children("tr").children().children(".query_markup_infant").val()
        
        //
     
        var total5=parseFloat(query_air_infant*query_air_curr)+parseFloat(query_hotel_infant*query_hotel_curr)+parseFloat(query_tours_infant*query_tours_curr)+parseFloat(query_transfer_infant*query_transfer_curr)+parseFloat(query_visa_infant*query_visa_curr)+parseFloat(query_inc_infant*query_inc_curr)+parseFloat(query_gst_infant*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_infant)+parseFloat(query_meals_infant*query_meals_curr)+parseFloat(query_markup_infant*query_markup_curr)
        
        //var total5=parseFloat(total5)-parseFloat(total5*query_discount_infant/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_infant").val("").val(total5)
        var total_grand5=parseFloat(total5)-query_discount_infant
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_infant").val("").val(total_grand5)
        
        //line6
        var query_air_single=$(this).parent().parent().parent().children("tr").children().children(".query_air_single").val()
        var query_hotel_single=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_single").val()
        var query_tours_single=$(this).parent().parent().parent().children("tr").children().children(".query_tours_single").val()
        var query_transfer_single=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_single").val()
        var query_visa_single=$(this).parent().parent().parent().children("tr").children().children(".query_visa_single").val()
        var query_inc_single=$(this).parent().parent().parent().children("tr").children().children(".query_inc_single").val()
        var query_discount_single=$(this).parent().parent().parent().children("tr").children().children(".query_discount_single").val()
        var query_gst_single=$(this).parent().parent().parent().children("tr").children().children(".query_gst_single").val()
        //
        var query_cruise_single=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_single").val()
        var query_meals_single=$(this).parent().parent().parent().children("tr").children().children(".query_meals_single").val()
        var query_markup_single=$(this).parent().parent().parent().children("tr").children().children(".query_markup_single").val()
        //
        var total6=parseFloat(query_air_single*query_air_curr)+parseFloat(query_hotel_single*query_hotel_curr)+parseFloat(query_tours_single*query_tours_curr)+parseFloat(query_transfer_single*query_transfer_curr)+parseFloat(query_visa_single*query_visa_curr)+parseFloat(query_inc_single*query_inc_curr)+parseFloat(query_gst_single*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_single)+parseFloat(query_meals_single*query_meals_curr)+parseFloat(query_markup_single*query_markup_curr)
        
        //var total6=parseFloat(total6)-parseFloat(total6*query_discount_single/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_single").val("").val(total6)
        var total_grand6=parseFloat(total6)-query_discount_single
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_single").val("").val(total_grand6)
    });
    //3
    $(document).on('change','.query_tours_curr',function()
    {
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        
        //extra selected currency start
       
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end
        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")


        var query_air_adult=$(this).parent().parent().parent().children("tr").children().children(".query_air_adult").val()
        var query_hotel_adult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_adult").val()
        var query_tours_adult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_adult").val()
        var query_transfer_adult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_adult").val()
        var query_visa_adult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_adult").val()
        var query_inc_adult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_adult").val()
        var query_discount_adult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_adult").val()
        var query_gst_adult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_adult").val()
        //
        var query_cruise_adult=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_adult").val()
        var query_meals_adult=$(this).parent().parent().parent().children("tr").children().children(".query_meals_adult").val()
        var query_markup_adult=$(this).parent().parent().parent().children("tr").children().children(".query_markup_adult").val()
        
        //
       
        
        var total1=parseFloat(query_air_adult*query_air_curr)+parseFloat(query_hotel_adult*query_hotel_curr)+parseFloat(query_tours_adult*query_tours_curr)+parseFloat(query_transfer_adult*query_transfer_curr)+parseFloat(query_visa_adult*query_visa_curr)+parseFloat(query_inc_adult*query_inc_curr)+parseFloat(query_gst_adult*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_adult)+parseFloat(query_meals_adult*query_meals_curr)+parseFloat(query_markup_adult*query_markup_curr)
        
        //var total1=parseFloat(total1)-parseFloat(total1*query_discount_adult/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_adult").val("").val(total1)
        var total_grand1=parseFloat(total1)-query_discount_adult
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_adult").val("").val(total_grand1)
       //line 2 end 

        var query_air_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_air_exadult").val()
        var query_hotel_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_exadult").val()
        var query_tours_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_exadult").val()
        var query_transfer_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_exadult").val()
        var query_visa_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_exadult").val()
        var query_inc_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_exadult").val()
        var query_discount_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_exadult").val()
        var query_gst_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_exadult").val()
        
        //
        var query_cruise_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_exadult").val()
        var query_meals_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_meals_exadult").val()
        var query_markup_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_markup_exadult").val()
        
        //
        
        var total2=parseFloat(query_air_exadult*query_air_curr)+parseFloat(query_hotel_exadult*query_hotel_curr)+parseFloat(query_tours_exadult*query_tours_curr)+parseFloat(query_transfer_exadult*query_transfer_curr)+parseFloat(query_visa_exadult*query_visa_curr)+parseFloat(query_inc_exadult*query_inc_curr)+parseFloat(query_gst_exadult*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_exadult)+parseFloat(query_meals_exadult*query_meals_curr)+parseFloat(query_markup_exadult*query_markup_curr)
        
        //var total2=parseFloat(total2)-parseFloat(total2*query_discount_exadult/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_exadult").val("").val(total2)
        var total_grand2=parseFloat(total2)-query_discount_exadult
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_exadult").val("").val(total_grand2)
        
        //line 3 start
        var query_air_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childbed").val()
        var query_hotel_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childbed").val()
        var query_tours_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childbed").val()
        var query_transfer_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childbed").val()
        var query_visa_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childbed").val()
        var query_inc_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childbed").val()
        var query_discount_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childbed").val()
        var query_gst_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childbed").val()
        //
        var query_cruise_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_childbed").val()
        var query_meals_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_meals_childbed").val()
        var query_markup_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_markup_childbed").val()
        
        //
     
        var total3=parseFloat(query_air_childbed*query_air_curr)+parseFloat(query_hotel_childbed*query_hotel_curr)+parseFloat(query_tours_childbed*query_tours_curr)+parseFloat(query_transfer_childbed*query_transfer_curr)+parseFloat(query_visa_childbed*query_visa_curr)+parseFloat(query_inc_childbed*query_inc_curr)+parseFloat(query_gst_childbed*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_childbed)+parseFloat(query_meals_childbed*query_meals_curr)+parseFloat(query_markup_childbed*query_markup_curr)
        
        //var total3=parseFloat(total3)-parseFloat(total3*query_discount_childbed/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_childbed").val("").val(total3)
        var total_grand3=parseFloat(total3)-query_discount_childbed
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_childbed").val("").val(total_grand3)
        //line 4
        var query_air_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childwbed").val()
        var query_hotel_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childwbed").val()
        var query_tours_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childwbed").val()
        var query_transfer_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childwbed").val()
        var query_visa_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childwbed").val()
        var query_inc_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childwbed").val()
        var query_discount_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childwbed").val()
        var query_gst_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childwbed").val()
        //
        var query_cruise_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_childwbed").val()
        var query_meals_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_meals_childwbed").val()
        var query_markup_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_markup_childwbed").val()
        
        //
      
        var total4=parseFloat(query_air_childwbed*query_air_curr)+parseFloat(query_hotel_childwbed*query_hotel_curr)+parseFloat(query_tours_childwbed*query_tours_curr)+parseFloat(query_transfer_childwbed*query_transfer_curr)+parseFloat(query_visa_childwbed*query_visa_curr)+parseFloat(query_inc_childwbed*query_inc_curr)+parseFloat(query_gst_childwbed*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_childwbed)+parseFloat(query_meals_childwbed*query_meals_curr)+parseFloat(query_markup_childwbed*query_markup_curr)
        
        //var total4=parseFloat(total4)-parseFloat(total4*query_discount_childwbed/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_childwbed").val("").val(total4)
        var total_grand4=parseFloat(total4)-query_discount_childwbed
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_childwbed").val("").val(total_grand4)
        
        //line 5
        var query_air_infant=$(this).parent().parent().parent().children("tr").children().children(".query_air_infant").val()
        var query_hotel_infant=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_infant").val()
        var query_tours_infant=$(this).parent().parent().parent().children("tr").children().children(".query_tours_infant").val()
        var query_transfer_infant=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_infant").val()
        var query_visa_infant=$(this).parent().parent().parent().children("tr").children().children(".query_visa_infant").val()
        var query_inc_infant=$(this).parent().parent().parent().children("tr").children().children(".query_inc_infant").val()
        var query_discount_infant=$(this).parent().parent().parent().children("tr").children().children(".query_discount_infant").val()
        var query_gst_infant=$(this).parent().parent().parent().children("tr").children().children(".query_gst_infant").val()
        //
        var query_cruise_infant=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_infant").val()
        var query_meals_infant=$(this).parent().parent().parent().children("tr").children().children(".query_meals_infant").val()
        var query_markup_infant=$(this).parent().parent().parent().children("tr").children().children(".query_markup_infant").val()
        
        //
     
        var total5=parseFloat(query_air_infant*query_air_curr)+parseFloat(query_hotel_infant*query_hotel_curr)+parseFloat(query_tours_infant*query_tours_curr)+parseFloat(query_transfer_infant*query_transfer_curr)+parseFloat(query_visa_infant*query_visa_curr)+parseFloat(query_inc_infant*query_inc_curr)+parseFloat(query_gst_infant*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_infant)+parseFloat(query_meals_infant*query_meals_curr)+parseFloat(query_markup_infant*query_markup_curr)
        
        //var total5=parseFloat(total5)-parseFloat(total5*query_discount_infant/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_infant").val("").val(total5)
        var total_grand5=parseFloat(total5)-query_discount_infant
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_infant").val("").val(total_grand5)
        
        //line6
        var query_air_single=$(this).parent().parent().parent().children("tr").children().children(".query_air_single").val()
        var query_hotel_single=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_single").val()
        var query_tours_single=$(this).parent().parent().parent().children("tr").children().children(".query_tours_single").val()
        var query_transfer_single=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_single").val()
        var query_visa_single=$(this).parent().parent().parent().children("tr").children().children(".query_visa_single").val()
        var query_inc_single=$(this).parent().parent().parent().children("tr").children().children(".query_inc_single").val()
        var query_discount_single=$(this).parent().parent().parent().children("tr").children().children(".query_discount_single").val()
        var query_gst_single=$(this).parent().parent().parent().children("tr").children().children(".query_gst_single").val()
        //
        var query_cruise_single=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_single").val()
        var query_meals_single=$(this).parent().parent().parent().children("tr").children().children(".query_meals_single").val()
        var query_markup_single=$(this).parent().parent().parent().children("tr").children().children(".query_markup_single").val()
        //
        var total6=parseFloat(query_air_single*query_air_curr)+parseFloat(query_hotel_single*query_hotel_curr)+parseFloat(query_tours_single*query_tours_curr)+parseFloat(query_transfer_single*query_transfer_curr)+parseFloat(query_visa_single*query_visa_curr)+parseFloat(query_inc_single*query_inc_curr)+parseFloat(query_gst_single*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_single)+parseFloat(query_meals_single*query_meals_curr)+parseFloat(query_markup_single*query_markup_curr)
        
        //var total6=parseFloat(total6)-parseFloat(total6*query_discount_single/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_single").val("").val(total6)
        var total_grand6=parseFloat(total6)-query_discount_single
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_single").val("").val(total_grand6)
    });
    //4
    $(document).on('change','.query_transfer_curr',function()
    {
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
       
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")


        var query_air_adult=$(this).parent().parent().parent().children("tr").children().children(".query_air_adult").val()
        var query_hotel_adult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_adult").val()
        var query_tours_adult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_adult").val()
        var query_transfer_adult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_adult").val()
        var query_visa_adult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_adult").val()
        var query_inc_adult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_adult").val()
        var query_discount_adult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_adult").val()
        var query_gst_adult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_adult").val()
        //
        var query_cruise_adult=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_adult").val()
        var query_meals_adult=$(this).parent().parent().parent().children("tr").children().children(".query_meals_adult").val()
        var query_markup_adult=$(this).parent().parent().parent().children("tr").children().children(".query_markup_adult").val()
        
        //
       
        
        var total1=parseFloat(query_air_adult*query_air_curr)+parseFloat(query_hotel_adult*query_hotel_curr)+parseFloat(query_tours_adult*query_tours_curr)+parseFloat(query_transfer_adult*query_transfer_curr)+parseFloat(query_visa_adult*query_visa_curr)+parseFloat(query_inc_adult*query_inc_curr)+parseFloat(query_gst_adult*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_adult)+parseFloat(query_meals_adult*query_meals_curr)+parseFloat(query_markup_adult*query_markup_curr)
        
        //var total1=parseFloat(total1)-parseFloat(total1*query_discount_adult/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_adult").val("").val(total1)
        var total_grand1=parseFloat(total1)-query_discount_adult
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_adult").val("").val(total_grand1)
       //line 2 end 

        var query_air_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_air_exadult").val()
        var query_hotel_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_exadult").val()
        var query_tours_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_exadult").val()
        var query_transfer_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_exadult").val()
        var query_visa_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_exadult").val()
        var query_inc_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_exadult").val()
        var query_discount_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_exadult").val()
        var query_gst_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_exadult").val()
        
        //
        var query_cruise_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_exadult").val()
        var query_meals_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_meals_exadult").val()
        var query_markup_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_markup_exadult").val()
        
        //
        
        var total2=parseFloat(query_air_exadult*query_air_curr)+parseFloat(query_hotel_exadult*query_hotel_curr)+parseFloat(query_tours_exadult*query_tours_curr)+parseFloat(query_transfer_exadult*query_transfer_curr)+parseFloat(query_visa_exadult*query_visa_curr)+parseFloat(query_inc_exadult*query_inc_curr)+parseFloat(query_gst_exadult*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_exadult)+parseFloat(query_meals_exadult*query_meals_curr)+parseFloat(query_markup_exadult*query_markup_curr)
        
        //var total2=parseFloat(total2)-parseFloat(total2*query_discount_exadult/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_exadult").val("").val(total2)
        var total_grand2=parseFloat(total2)-query_discount_exadult
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_exadult").val("").val(total_grand2)
        
        //line 3 start
        var query_air_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childbed").val()
        var query_hotel_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childbed").val()
        var query_tours_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childbed").val()
        var query_transfer_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childbed").val()
        var query_visa_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childbed").val()
        var query_inc_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childbed").val()
        var query_discount_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childbed").val()
        var query_gst_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childbed").val()
        //
        var query_cruise_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_childbed").val()
        var query_meals_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_meals_childbed").val()
        var query_markup_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_markup_childbed").val()
        
        //
     
        var total3=parseFloat(query_air_childbed*query_air_curr)+parseFloat(query_hotel_childbed*query_hotel_curr)+parseFloat(query_tours_childbed*query_tours_curr)+parseFloat(query_transfer_childbed*query_transfer_curr)+parseFloat(query_visa_childbed*query_visa_curr)+parseFloat(query_inc_childbed*query_inc_curr)+parseFloat(query_gst_childbed*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_childbed)+parseFloat(query_meals_childbed*query_meals_curr)+parseFloat(query_markup_childbed*query_markup_curr)
        
        //var total3=parseFloat(total3)-parseFloat(total3*query_discount_childbed/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_childbed").val("").val(total3)
        var total_grand3=parseFloat(total3)-query_discount_childbed
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_childbed").val("").val(total_grand3)
        //line 4
        var query_air_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childwbed").val()
        var query_hotel_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childwbed").val()
        var query_tours_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childwbed").val()
        var query_transfer_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childwbed").val()
        var query_visa_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childwbed").val()
        var query_inc_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childwbed").val()
        var query_discount_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childwbed").val()
        var query_gst_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childwbed").val()
        //
        var query_cruise_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_childwbed").val()
        var query_meals_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_meals_childwbed").val()
        var query_markup_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_markup_childwbed").val()
        
        //
      
        var total4=parseFloat(query_air_childwbed*query_air_curr)+parseFloat(query_hotel_childwbed*query_hotel_curr)+parseFloat(query_tours_childwbed*query_tours_curr)+parseFloat(query_transfer_childwbed*query_transfer_curr)+parseFloat(query_visa_childwbed*query_visa_curr)+parseFloat(query_inc_childwbed*query_inc_curr)+parseFloat(query_gst_childwbed*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_childwbed)+parseFloat(query_meals_childwbed*query_meals_curr)+parseFloat(query_markup_childwbed*query_markup_curr)
        
        //var total4=parseFloat(total4)-parseFloat(total4*query_discount_childwbed/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_childwbed").val("").val(total4)
        var total_grand4=parseFloat(total4)-query_discount_childwbed
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_childwbed").val("").val(total_grand4)
        
        //line 5
        var query_air_infant=$(this).parent().parent().parent().children("tr").children().children(".query_air_infant").val()
        var query_hotel_infant=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_infant").val()
        var query_tours_infant=$(this).parent().parent().parent().children("tr").children().children(".query_tours_infant").val()
        var query_transfer_infant=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_infant").val()
        var query_visa_infant=$(this).parent().parent().parent().children("tr").children().children(".query_visa_infant").val()
        var query_inc_infant=$(this).parent().parent().parent().children("tr").children().children(".query_inc_infant").val()
        var query_discount_infant=$(this).parent().parent().parent().children("tr").children().children(".query_discount_infant").val()
        var query_gst_infant=$(this).parent().parent().parent().children("tr").children().children(".query_gst_infant").val()
        //
        var query_cruise_infant=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_infant").val()
        var query_meals_infant=$(this).parent().parent().parent().children("tr").children().children(".query_meals_infant").val()
        var query_markup_infant=$(this).parent().parent().parent().children("tr").children().children(".query_markup_infant").val()
        
        //
     
        var total5=parseFloat(query_air_infant*query_air_curr)+parseFloat(query_hotel_infant*query_hotel_curr)+parseFloat(query_tours_infant*query_tours_curr)+parseFloat(query_transfer_infant*query_transfer_curr)+parseFloat(query_visa_infant*query_visa_curr)+parseFloat(query_inc_infant*query_inc_curr)+parseFloat(query_gst_infant*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_infant)+parseFloat(query_meals_infant*query_meals_curr)+parseFloat(query_markup_infant*query_markup_curr)
        
        //var total5=parseFloat(total5)-parseFloat(total5*query_discount_infant/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_infant").val("").val(total5)
        var total_grand5=parseFloat(total5)-query_discount_infant
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_infant").val("").val(total_grand5)
        
        //line6
        var query_air_single=$(this).parent().parent().parent().children("tr").children().children(".query_air_single").val()
        var query_hotel_single=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_single").val()
        var query_tours_single=$(this).parent().parent().parent().children("tr").children().children(".query_tours_single").val()
        var query_transfer_single=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_single").val()
        var query_visa_single=$(this).parent().parent().parent().children("tr").children().children(".query_visa_single").val()
        var query_inc_single=$(this).parent().parent().parent().children("tr").children().children(".query_inc_single").val()
        var query_discount_single=$(this).parent().parent().parent().children("tr").children().children(".query_discount_single").val()
        var query_gst_single=$(this).parent().parent().parent().children("tr").children().children(".query_gst_single").val()
        //
        var query_cruise_single=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_single").val()
        var query_meals_single=$(this).parent().parent().parent().children("tr").children().children(".query_meals_single").val()
        var query_markup_single=$(this).parent().parent().parent().children("tr").children().children(".query_markup_single").val()
        //
        var total6=parseFloat(query_air_single*query_air_curr)+parseFloat(query_hotel_single*query_hotel_curr)+parseFloat(query_tours_single*query_tours_curr)+parseFloat(query_transfer_single*query_transfer_curr)+parseFloat(query_visa_single*query_visa_curr)+parseFloat(query_inc_single*query_inc_curr)+parseFloat(query_gst_single*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_single)+parseFloat(query_meals_single*query_meals_curr)+parseFloat(query_markup_single*query_markup_curr)
        
        //var total6=parseFloat(total6)-parseFloat(total6*query_discount_single/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_single").val("").val(total6)
        var total_grand6=parseFloat(total6)-query_discount_single
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_single").val("").val(total_grand6)
    });
    //6
    $(document).on('change','.query_inc_curr',function()
    {
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
       
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")


        var query_air_adult=$(this).parent().parent().parent().children("tr").children().children(".query_air_adult").val()
        var query_hotel_adult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_adult").val()
        var query_tours_adult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_adult").val()
        var query_transfer_adult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_adult").val()
        var query_visa_adult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_adult").val()
        var query_inc_adult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_adult").val()
        var query_discount_adult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_adult").val()
        var query_gst_adult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_adult").val()
        //
        var query_cruise_adult=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_adult").val()
        var query_meals_adult=$(this).parent().parent().parent().children("tr").children().children(".query_meals_adult").val()
        var query_markup_adult=$(this).parent().parent().parent().children("tr").children().children(".query_markup_adult").val()
        
        //
       
        
        var total1=parseFloat(query_air_adult*query_air_curr)+parseFloat(query_hotel_adult*query_hotel_curr)+parseFloat(query_tours_adult*query_tours_curr)+parseFloat(query_transfer_adult*query_transfer_curr)+parseFloat(query_visa_adult*query_visa_curr)+parseFloat(query_inc_adult*query_inc_curr)+parseFloat(query_gst_adult*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_adult)+parseFloat(query_meals_adult*query_meals_curr)+parseFloat(query_markup_adult*query_markup_curr)
        
        //var total1=parseFloat(total1)-parseFloat(total1*query_discount_adult/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_adult").val("").val(total1)
        var total_grand1=parseFloat(total1)-query_discount_adult
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_adult").val("").val(total_grand1)
       //line 2 end 

        var query_air_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_air_exadult").val()
        var query_hotel_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_exadult").val()
        var query_tours_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_exadult").val()
        var query_transfer_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_exadult").val()
        var query_visa_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_exadult").val()
        var query_inc_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_exadult").val()
        var query_discount_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_exadult").val()
        var query_gst_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_exadult").val()
         
        //
        var query_cruise_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_exadult").val()
        var query_meals_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_meals_exadult").val()
        var query_markup_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_markup_exadult").val()
        
        //
        
        var total2=parseFloat(query_air_exadult*query_air_curr)+parseFloat(query_hotel_exadult*query_hotel_curr)+parseFloat(query_tours_exadult*query_tours_curr)+parseFloat(query_transfer_exadult*query_transfer_curr)+parseFloat(query_visa_exadult*query_visa_curr)+parseFloat(query_inc_exadult*query_inc_curr)+parseFloat(query_gst_exadult*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_exadult)+parseFloat(query_meals_exadult*query_meals_curr)+parseFloat(query_markup_exadult*query_markup_curr)
        
        //ar total2=parseFloat(total2)-parseFloat(total2*query_discount_exadult/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_exadult").val("").val(total2)
        var total_grand2=parseFloat(total2)-query_discount_exadult
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_exadult").val("").val(total_grand2)
        
        //line 3 start
        var query_air_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childbed").val()
        var query_hotel_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childbed").val()
        var query_tours_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childbed").val()
        var query_transfer_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childbed").val()
        var query_visa_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childbed").val()
        var query_inc_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childbed").val()
        var query_discount_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childbed").val()
        var query_gst_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childbed").val()
        //
        var query_cruise_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_childbed").val()
        var query_meals_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_meals_childbed").val()
        var query_markup_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_markup_childbed").val()
        
        //
     
        var total3=parseFloat(query_air_childbed*query_air_curr)+parseFloat(query_hotel_childbed*query_hotel_curr)+parseFloat(query_tours_childbed*query_tours_curr)+parseFloat(query_transfer_childbed*query_transfer_curr)+parseFloat(query_visa_childbed*query_visa_curr)+parseFloat(query_inc_childbed*query_inc_curr)+parseFloat(query_gst_childbed*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_childbed)+parseFloat(query_meals_childbed*query_meals_curr)+parseFloat(query_markup_childbed*query_markup_curr)
        
        //var total3=parseFloat(total3)-parseFloat(total3*query_discount_childbed/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_childbed").val("").val(total3)
        var total_grand3=parseFloat(total3)-query_discount_childbed
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_childbed").val("").val(total_grand3)
        //line 4
        var query_air_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childwbed").val()
        var query_hotel_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childwbed").val()
        var query_tours_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childwbed").val()
        var query_transfer_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childwbed").val()
        var query_visa_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childwbed").val()
        var query_inc_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childwbed").val()
        var query_discount_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childwbed").val()
        var query_gst_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childwbed").val()
        //
        var query_cruise_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_childwbed").val()
        var query_meals_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_meals_childwbed").val()
        var query_markup_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_markup_childwbed").val()
        
        //
      
        var total4=parseFloat(query_air_childwbed*query_air_curr)+parseFloat(query_hotel_childwbed*query_hotel_curr)+parseFloat(query_tours_childwbed*query_tours_curr)+parseFloat(query_transfer_childwbed*query_transfer_curr)+parseFloat(query_visa_childwbed*query_visa_curr)+parseFloat(query_inc_childwbed*query_inc_curr)+parseFloat(query_gst_childwbed*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_childwbed)+parseFloat(query_meals_childwbed*query_meals_curr)+parseFloat(query_markup_childwbed*query_markup_curr)
        
        //var total4=parseFloat(total4)-parseFloat(total4*query_discount_childwbed/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_childwbed").val("").val(total4)
        var total_grand4=parseFloat(total4)-query_discount_childwbed
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_childwbed").val("").val(total_grand4)
        
        //line 5
        var query_air_infant=$(this).parent().parent().parent().children("tr").children().children(".query_air_infant").val()
        var query_hotel_infant=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_infant").val()
        var query_tours_infant=$(this).parent().parent().parent().children("tr").children().children(".query_tours_infant").val()
        var query_transfer_infant=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_infant").val()
        var query_visa_infant=$(this).parent().parent().parent().children("tr").children().children(".query_visa_infant").val()
        var query_inc_infant=$(this).parent().parent().parent().children("tr").children().children(".query_inc_infant").val()
        var query_discount_infant=$(this).parent().parent().parent().children("tr").children().children(".query_discount_infant").val()
        var query_gst_infant=$(this).parent().parent().parent().children("tr").children().children(".query_gst_infant").val()
         //
        var query_cruise_infant=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_infant").val()
        var query_meals_infant=$(this).parent().parent().parent().children("tr").children().children(".query_meals_infant").val()
        var query_markup_infant=$(this).parent().parent().parent().children("tr").children().children(".query_markup_infant").val()
        
        //
     
        var total5=parseFloat(query_air_infant*query_air_curr)+parseFloat(query_hotel_infant*query_hotel_curr)+parseFloat(query_tours_infant*query_tours_curr)+parseFloat(query_transfer_infant*query_transfer_curr)+parseFloat(query_visa_infant*query_visa_curr)+parseFloat(query_inc_infant*query_inc_curr)+parseFloat(query_gst_infant*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_infant)+parseFloat(query_meals_infant*query_meals_curr)+parseFloat(query_markup_infant*query_markup_curr)
        
        //var total5=parseFloat(total5)-parseFloat(total5*query_discount_infant/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_infant").val("").val(total5)
        var total_grand5=parseFloat(total5)-query_discount_infant
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_infant").val("").val(total_grand5)
        
        //line6
        var query_air_single=$(this).parent().parent().parent().children("tr").children().children(".query_air_single").val()
        var query_hotel_single=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_single").val()
        var query_tours_single=$(this).parent().parent().parent().children("tr").children().children(".query_tours_single").val()
        var query_transfer_single=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_single").val()
        var query_visa_single=$(this).parent().parent().parent().children("tr").children().children(".query_visa_single").val()
        var query_inc_single=$(this).parent().parent().parent().children("tr").children().children(".query_inc_single").val()
        var query_discount_single=$(this).parent().parent().parent().children("tr").children().children(".query_discount_single").val()
        var query_gst_single=$(this).parent().parent().parent().children("tr").children().children(".query_gst_single").val()
         //
        var query_cruise_single=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_single").val()
        var query_meals_single=$(this).parent().parent().parent().children("tr").children().children(".query_meals_single").val()
        var query_markup_single=$(this).parent().parent().parent().children("tr").children().children(".query_markup_single").val()
        //
        var total6=parseFloat(query_air_single*query_air_curr)+parseFloat(query_hotel_single*query_hotel_curr)+parseFloat(query_tours_single*query_tours_curr)+parseFloat(query_transfer_single*query_transfer_curr)+parseFloat(query_visa_single*query_visa_curr)+parseFloat(query_inc_single*query_inc_curr)+parseFloat(query_gst_single*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_single)+parseFloat(query_meals_single*query_meals_curr)+parseFloat(query_markup_single*query_markup_curr)
        
        //var total6=parseFloat(total6)-parseFloat(total6*query_discount_single/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_single").val("").val(total6)
        var total_grand6=parseFloat(total6)-query_discount_single
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_single").val("").val(total_grand6)
    });
    //7
    $(document).on('change','.query_visa_curr',function()
    {
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
       
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")


        var query_air_adult=$(this).parent().parent().parent().children("tr").children().children(".query_air_adult").val()
        var query_hotel_adult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_adult").val()
        var query_tours_adult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_adult").val()
        var query_transfer_adult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_adult").val()
        var query_visa_adult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_adult").val()
        var query_inc_adult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_adult").val()
        var query_discount_adult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_adult").val()
        var query_gst_adult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_adult").val()
        //
        var query_cruise_adult=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_adult").val()
        var query_meals_adult=$(this).parent().parent().parent().children("tr").children().children(".query_meals_adult").val()
        var query_markup_adult=$(this).parent().parent().parent().children("tr").children().children(".query_markup_adult").val()
        
        //
       
        
        var total1=parseFloat(query_air_adult*query_air_curr)+parseFloat(query_hotel_adult*query_hotel_curr)+parseFloat(query_tours_adult*query_tours_curr)+parseFloat(query_transfer_adult*query_transfer_curr)+parseFloat(query_visa_adult*query_visa_curr)+parseFloat(query_inc_adult*query_inc_curr)+parseFloat(query_gst_adult*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_adult)+parseFloat(query_meals_adult*query_meals_curr)+parseFloat(query_markup_adult*query_markup_curr)
        
        //var total1=parseFloat(total1)-parseFloat(total1*query_discount_adult/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_adult").val("").val(total1)
        var total_grand1=parseFloat(total1)-query_discount_adult
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_adult").val("").val(total_grand1)
       //line 2 end 

        var query_air_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_air_exadult").val()
        var query_hotel_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_exadult").val()
        var query_tours_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_exadult").val()
        var query_transfer_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_exadult").val()
        var query_visa_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_exadult").val()
        var query_inc_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_exadult").val()
        var query_discount_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_exadult").val()
        var query_gst_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_exadult").val()
        
        //
        var query_cruise_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_exadult").val()
        var query_meals_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_meals_exadult").val()
        var query_markup_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_markup_exadult").val()
        
        //
        
        var total2=parseFloat(query_air_exadult*query_air_curr)+parseFloat(query_hotel_exadult*query_hotel_curr)+parseFloat(query_tours_exadult*query_tours_curr)+parseFloat(query_transfer_exadult*query_transfer_curr)+parseFloat(query_visa_exadult*query_visa_curr)+parseFloat(query_inc_exadult*query_inc_curr)+parseFloat(query_gst_exadult*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_exadult)+parseFloat(query_meals_exadult*query_meals_curr)+parseFloat(query_markup_exadult*query_markup_curr)
        
        //var total2=parseFloat(total2)-parseFloat(total2*query_discount_exadult/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_exadult").val("").val(total2)
        var total_grand2=parseFloat(total2)-query_discount_exadult
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_exadult").val("").val(total_grand2)
        
        //line 3 start
        var query_air_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childbed").val()
        var query_hotel_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childbed").val()
        var query_tours_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childbed").val()
        var query_transfer_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childbed").val()
        var query_visa_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childbed").val()
        var query_inc_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childbed").val()
        var query_discount_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childbed").val()
        var query_gst_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childbed").val()
        //
        var query_cruise_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_childbed").val()
        var query_meals_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_meals_childbed").val()
        var query_markup_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_markup_childbed").val()
        
        //
     
        var total3=parseFloat(query_air_childbed*query_air_curr)+parseFloat(query_hotel_childbed*query_hotel_curr)+parseFloat(query_tours_childbed*query_tours_curr)+parseFloat(query_transfer_childbed*query_transfer_curr)+parseFloat(query_visa_childbed*query_visa_curr)+parseFloat(query_inc_childbed*query_inc_curr)+parseFloat(query_gst_childbed*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_childbed)+parseFloat(query_meals_childbed*query_meals_curr)+parseFloat(query_markup_childbed*query_markup_curr)
        
        //var total3=parseFloat(total3)-parseFloat(total3*query_discount_childbed/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_childbed").val("").val(total3)
        var total_grand3=parseFloat(total3)-query_discount_childbed
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_childbed").val("").val(total_grand3)
        //line 4
        var query_air_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childwbed").val()
        var query_hotel_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childwbed").val()
        var query_tours_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childwbed").val()
        var query_transfer_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childwbed").val()
        var query_visa_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childwbed").val()
        var query_inc_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childwbed").val()
        var query_discount_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childwbed").val()
        var query_gst_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childwbed").val()
        //
        var query_cruise_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_childwbed").val()
        var query_meals_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_meals_childwbed").val()
        var query_markup_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_markup_childwbed").val()
        
        //
      
        var total4=parseFloat(query_air_childwbed*query_air_curr)+parseFloat(query_hotel_childwbed*query_hotel_curr)+parseFloat(query_tours_childwbed*query_tours_curr)+parseFloat(query_transfer_childwbed*query_transfer_curr)+parseFloat(query_visa_childwbed*query_visa_curr)+parseFloat(query_inc_childwbed*query_inc_curr)+parseFloat(query_gst_childwbed*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_childwbed)+parseFloat(query_meals_childwbed*query_meals_curr)+parseFloat(query_markup_childwbed*query_markup_curr)
        
        //var total4=parseFloat(total4)-parseFloat(total4*query_discount_childwbed/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_childwbed").val("").val(total4)
        var total_grand4=parseFloat(total4)-query_discount_childwbed
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_childwbed").val("").val(total_grand4)
        
        //line 5
        var query_air_infant=$(this).parent().parent().parent().children("tr").children().children(".query_air_infant").val()
        var query_hotel_infant=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_infant").val()
        var query_tours_infant=$(this).parent().parent().parent().children("tr").children().children(".query_tours_infant").val()
        var query_transfer_infant=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_infant").val()
        var query_visa_infant=$(this).parent().parent().parent().children("tr").children().children(".query_visa_infant").val()
        var query_inc_infant=$(this).parent().parent().parent().children("tr").children().children(".query_inc_infant").val()
        var query_discount_infant=$(this).parent().parent().parent().children("tr").children().children(".query_discount_infant").val()
        var query_gst_infant=$(this).parent().parent().parent().children("tr").children().children(".query_gst_infant").val()
        //
        var query_cruise_infant=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_infant").val()
        var query_meals_infant=$(this).parent().parent().parent().children("tr").children().children(".query_meals_infant").val()
        var query_markup_infant=$(this).parent().parent().parent().children("tr").children().children(".query_markup_infant").val()
        
        //
     
        var total5=parseFloat(query_air_infant*query_air_curr)+parseFloat(query_hotel_infant*query_hotel_curr)+parseFloat(query_tours_infant*query_tours_curr)+parseFloat(query_transfer_infant*query_transfer_curr)+parseFloat(query_visa_infant*query_visa_curr)+parseFloat(query_inc_infant*query_inc_curr)+parseFloat(query_gst_infant*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_infant)+parseFloat(query_meals_infant*query_meals_curr)+parseFloat(query_markup_infant*query_markup_curr)
        
        //var total5=parseFloat(total5)-parseFloat(total5*query_discount_infant/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_infant").val("").val(total5)
        var total_grand5=parseFloat(total5)-query_discount_infant
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_infant").val("").val(total_grand5)
        
        //line6
        var query_air_single=$(this).parent().parent().parent().children("tr").children().children(".query_air_single").val()
        var query_hotel_single=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_single").val()
        var query_tours_single=$(this).parent().parent().parent().children("tr").children().children(".query_tours_single").val()
        var query_transfer_single=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_single").val()
        var query_visa_single=$(this).parent().parent().parent().children("tr").children().children(".query_visa_single").val()
        var query_inc_single=$(this).parent().parent().parent().children("tr").children().children(".query_inc_single").val()
        var query_discount_single=$(this).parent().parent().parent().children("tr").children().children(".query_discount_single").val()
        var query_gst_single=$(this).parent().parent().parent().children("tr").children().children(".query_gst_single").val()
        //
        var query_cruise_single=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_single").val()
        var query_meals_single=$(this).parent().parent().parent().children("tr").children().children(".query_meals_single").val()
        var query_markup_single=$(this).parent().parent().parent().children("tr").children().children(".query_markup_single").val()
        //
        var total6=parseFloat(query_air_single*query_air_curr)+parseFloat(query_hotel_single*query_hotel_curr)+parseFloat(query_tours_single*query_tours_curr)+parseFloat(query_transfer_single*query_transfer_curr)+parseFloat(query_visa_single*query_visa_curr)+parseFloat(query_inc_single*query_inc_curr)+parseFloat(query_gst_single*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_single)+parseFloat(query_meals_single*query_meals_curr)+parseFloat(query_markup_single*query_markup_curr)
        
        //var total6=parseFloat(total6)-parseFloat(total6*query_discount_single/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_single").val("").val(total6)
        var total_grand6=parseFloat(total6)-query_discount_single
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_single").val("").val(total_grand6)
    });
    //8
    $(document).on('change','.query_gst_curr',function()
    {
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
       
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")


        var query_air_adult=$(this).parent().parent().parent().children("tr").children().children(".query_air_adult").val()
        var query_hotel_adult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_adult").val()
        var query_tours_adult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_adult").val()
        var query_transfer_adult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_adult").val()
        var query_visa_adult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_adult").val()
        var query_inc_adult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_adult").val()
        var query_discount_adult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_adult").val()
        var query_gst_adult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_adult").val()
        //
        var query_cruise_adult=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_adult").val()
        var query_meals_adult=$(this).parent().parent().parent().children("tr").children().children(".query_meals_adult").val()
        var query_markup_adult=$(this).parent().parent().parent().children("tr").children().children(".query_markup_adult").val()
        
        //
       
        
        var total1=parseFloat(query_air_adult*query_air_curr)+parseFloat(query_hotel_adult*query_hotel_curr)+parseFloat(query_tours_adult*query_tours_curr)+parseFloat(query_transfer_adult*query_transfer_curr)+parseFloat(query_visa_adult*query_visa_curr)+parseFloat(query_inc_adult*query_inc_curr)+parseFloat(query_gst_adult*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_adult)+parseFloat(query_meals_adult*query_meals_curr)+parseFloat(query_markup_adult*query_markup_curr)
        
        //var total1=parseFloat(total1)-parseFloat(total1*query_discount_adult/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_adult").val("").val(total1)
        var total_grand1=parseFloat(total1)-query_discount_adult
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_adult").val("").val(total_grand1)
       //line 2 end 

        var query_air_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_air_exadult").val()
        var query_hotel_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_exadult").val()
        var query_tours_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_exadult").val()
        var query_transfer_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_exadult").val()
        var query_visa_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_exadult").val()
        var query_inc_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_exadult").val()
        var query_discount_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_exadult").val()
        var query_gst_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_exadult").val()
        //
        var query_cruise_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_exadult").val()
        var query_meals_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_meals_exadult").val()
        var query_markup_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_markup_exadult").val()
        
        //
        
        var total2=parseFloat(query_air_exadult*query_air_curr)+parseFloat(query_hotel_exadult*query_hotel_curr)+parseFloat(query_tours_exadult*query_tours_curr)+parseFloat(query_transfer_exadult*query_transfer_curr)+parseFloat(query_visa_exadult*query_visa_curr)+parseFloat(query_inc_exadult*query_inc_curr)+parseFloat(query_gst_exadult*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_exadult)+parseFloat(query_meals_exadult*query_meals_curr)+parseFloat(query_markup_exadult*query_markup_curr)
        
        //var total2=parseFloat(total2)-parseFloat(total2*query_discount_exadult/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_exadult").val("").val(total2)
        var total_grand2=parseFloat(total2)-query_discount_exadult
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_exadult").val("").val(total_grand2)
        
        //line 3 start
        var query_air_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childbed").val()
        var query_hotel_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childbed").val()
        var query_tours_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childbed").val()
        var query_transfer_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childbed").val()
        var query_visa_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childbed").val()
        var query_inc_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childbed").val()
        var query_discount_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childbed").val()
        var query_gst_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childbed").val()
        //
        var query_cruise_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_childbed").val()
        var query_meals_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_meals_childbed").val()
        var query_markup_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_markup_childbed").val()
        
        //
     
        var total3=parseFloat(query_air_childbed*query_air_curr)+parseFloat(query_hotel_childbed*query_hotel_curr)+parseFloat(query_tours_childbed*query_tours_curr)+parseFloat(query_transfer_childbed*query_transfer_curr)+parseFloat(query_visa_childbed*query_visa_curr)+parseFloat(query_inc_childbed*query_inc_curr)+parseFloat(query_gst_childbed*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_childbed)+parseFloat(query_meals_childbed*query_meals_curr)+parseFloat(query_markup_childbed*query_markup_curr)
        
        //var total3=parseFloat(total3)-parseFloat(total3*query_discount_childbed/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_childbed").val("").val(total3)
        var total_grand3=parseFloat(total3)-query_discount_childbed
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_childbed").val("").val(total_grand3)
        //line 4
        var query_air_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childwbed").val()
        var query_hotel_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childwbed").val()
        var query_tours_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childwbed").val()
        var query_transfer_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childwbed").val()
        var query_visa_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childwbed").val()
        var query_inc_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childwbed").val()
        var query_discount_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childwbed").val()
        var query_gst_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childwbed").val()
        //
        var query_cruise_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_childwbed").val()
        var query_meals_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_meals_childwbed").val()
        var query_markup_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_markup_childwbed").val()
        
        //
      
        var total4=parseFloat(query_air_childwbed*query_air_curr)+parseFloat(query_hotel_childwbed*query_hotel_curr)+parseFloat(query_tours_childwbed*query_tours_curr)+parseFloat(query_transfer_childwbed*query_transfer_curr)+parseFloat(query_visa_childwbed*query_visa_curr)+parseFloat(query_inc_childwbed*query_inc_curr)+parseFloat(query_gst_childwbed*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_childwbed)+parseFloat(query_meals_childwbed*query_meals_curr)+parseFloat(query_markup_childwbed*query_markup_curr)
        
        //var total4=parseFloat(total4)-parseFloat(total4*query_discount_childwbed/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_childwbed").val("").val(total4)
        var total_grand4=parseFloat(total4)-query_discount_childwbed
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_childwbed").val("").val(total_grand4)
        
        //line 5
        var query_air_infant=$(this).parent().parent().parent().children("tr").children().children(".query_air_infant").val()
        var query_hotel_infant=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_infant").val()
        var query_tours_infant=$(this).parent().parent().parent().children("tr").children().children(".query_tours_infant").val()
        var query_transfer_infant=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_infant").val()
        var query_visa_infant=$(this).parent().parent().parent().children("tr").children().children(".query_visa_infant").val()
        var query_inc_infant=$(this).parent().parent().parent().children("tr").children().children(".query_inc_infant").val()
        var query_discount_infant=$(this).parent().parent().parent().children("tr").children().children(".query_discount_infant").val()
        var query_gst_infant=$(this).parent().parent().parent().children("tr").children().children(".query_gst_infant").val()
        //
        var query_cruise_infant=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_infant").val()
        var query_meals_infant=$(this).parent().parent().parent().children("tr").children().children(".query_meals_infant").val()
        var query_markup_infant=$(this).parent().parent().parent().children("tr").children().children(".query_markup_infant").val()
        
        //
     
        var total5=parseFloat(query_air_infant*query_air_curr)+parseFloat(query_hotel_infant*query_hotel_curr)+parseFloat(query_tours_infant*query_tours_curr)+parseFloat(query_transfer_infant*query_transfer_curr)+parseFloat(query_visa_infant*query_visa_curr)+parseFloat(query_inc_infant*query_inc_curr)+parseFloat(query_gst_infant*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_infant)+parseFloat(query_meals_infant*query_meals_curr)+parseFloat(query_markup_infant*query_markup_curr)
        
        //var total5=parseFloat(total5)-parseFloat(total5*query_discount_infant/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_infant").val("").val(total5)
        var total_grand5=parseFloat(total5)-query_discount_infant
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_infant").val("").val(total_grand5)
        
        //line6
        var query_air_single=$(this).parent().parent().parent().children("tr").children().children(".query_air_single").val()
        var query_hotel_single=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_single").val()
        var query_tours_single=$(this).parent().parent().parent().children("tr").children().children(".query_tours_single").val()
        var query_transfer_single=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_single").val()
        var query_visa_single=$(this).parent().parent().parent().children("tr").children().children(".query_visa_single").val()
        var query_inc_single=$(this).parent().parent().parent().children("tr").children().children(".query_inc_single").val()
        var query_discount_single=$(this).parent().parent().parent().children("tr").children().children(".query_discount_single").val()
        var query_gst_single=$(this).parent().parent().parent().children("tr").children().children(".query_gst_single").val()
        //
        var query_cruise_single=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_single").val()
        var query_meals_single=$(this).parent().parent().parent().children("tr").children().children(".query_meals_single").val()
        var query_markup_single=$(this).parent().parent().parent().children("tr").children().children(".query_markup_single").val()
        //
        var total6=parseFloat(query_air_single*query_air_curr)+parseFloat(query_hotel_single*query_hotel_curr)+parseFloat(query_tours_single*query_tours_curr)+parseFloat(query_transfer_single*query_transfer_curr)+parseFloat(query_visa_single*query_visa_curr)+parseFloat(query_inc_single*query_inc_curr)+parseFloat(query_gst_single*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_single)+parseFloat(query_meals_single*query_meals_curr)+parseFloat(query_markup_single*query_markup_curr)
        
        //var total6=parseFloat(total6)-parseFloat(total6*query_discount_single/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_single").val("").val(total6)
        var total_grand6=parseFloat(total6)-query_discount_single
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_single").val("").val(total_grand6)
    });

    //9
    $(document).on('change','.query_cruise_curr',function()
    {
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
       
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")


        var query_air_adult=$(this).parent().parent().parent().children("tr").children().children(".query_air_adult").val()
        var query_hotel_adult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_adult").val()
        var query_tours_adult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_adult").val()
        var query_transfer_adult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_adult").val()
        var query_visa_adult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_adult").val()
        var query_inc_adult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_adult").val()
        var query_discount_adult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_adult").val()
        var query_gst_adult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_adult").val()
        //
        var query_cruise_adult=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_adult").val()
        var query_meals_adult=$(this).parent().parent().parent().children("tr").children().children(".query_meals_adult").val()
        var query_markup_adult=$(this).parent().parent().parent().children("tr").children().children(".query_markup_adult").val()
        
        //
       
        
        var total1=parseFloat(query_air_adult*query_air_curr)+parseFloat(query_hotel_adult*query_hotel_curr)+parseFloat(query_tours_adult*query_tours_curr)+parseFloat(query_transfer_adult*query_transfer_curr)+parseFloat(query_visa_adult*query_visa_curr)+parseFloat(query_inc_adult*query_inc_curr)+parseFloat(query_gst_adult*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_adult)+parseFloat(query_meals_adult*query_meals_curr)+parseFloat(query_markup_adult*query_markup_curr)
        
        //var total1=parseFloat(total1)-parseFloat(total1*query_discount_adult/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_adult").val("").val(total1)
        var total_grand1=parseFloat(total1)-query_discount_adult
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_adult").val("").val(total_grand1)
       //line 2 end 

        var query_air_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_air_exadult").val()
        var query_hotel_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_exadult").val()
        var query_tours_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_exadult").val()
        var query_transfer_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_exadult").val()
        var query_visa_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_exadult").val()
        var query_inc_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_exadult").val()
        var query_discount_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_exadult").val()
        var query_gst_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_exadult").val()
        //
        var query_cruise_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_exadult").val()
        var query_meals_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_meals_exadult").val()
        var query_markup_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_markup_exadult").val()
        
        //
        
        var total2=parseFloat(query_air_exadult*query_air_curr)+parseFloat(query_hotel_exadult*query_hotel_curr)+parseFloat(query_tours_exadult*query_tours_curr)+parseFloat(query_transfer_exadult*query_transfer_curr)+parseFloat(query_visa_exadult*query_visa_curr)+parseFloat(query_inc_exadult*query_inc_curr)+parseFloat(query_gst_exadult*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_exadult)+parseFloat(query_meals_exadult*query_meals_curr)+parseFloat(query_markup_exadult*query_markup_curr)
        
        //var total2=parseFloat(total2)-parseFloat(total2*query_discount_exadult/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_exadult").val("").val(total2)
        var total_grand2=parseFloat(total2)-query_discount_exadult
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_exadult").val("").val(total_grand2)
        
        //line 3 start
        var query_air_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childbed").val()
        var query_hotel_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childbed").val()
        var query_tours_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childbed").val()
        var query_transfer_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childbed").val()
        var query_visa_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childbed").val()
        var query_inc_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childbed").val()
        var query_discount_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childbed").val()
        var query_gst_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childbed").val()
        //
        var query_cruise_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_childbed").val()
        var query_meals_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_meals_childbed").val()
        var query_markup_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_markup_childbed").val()
        
        //
     
        var total3=parseFloat(query_air_childbed*query_air_curr)+parseFloat(query_hotel_childbed*query_hotel_curr)+parseFloat(query_tours_childbed*query_tours_curr)+parseFloat(query_transfer_childbed*query_transfer_curr)+parseFloat(query_visa_childbed*query_visa_curr)+parseFloat(query_inc_childbed*query_inc_curr)+parseFloat(query_gst_childbed*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_childbed)+parseFloat(query_meals_childbed*query_meals_curr)+parseFloat(query_markup_childbed*query_markup_curr)
        
        //var total3=parseFloat(total3)-parseFloat(total3*query_discount_childbed/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_childbed").val("").val(total3)
        var total_grand3=parseFloat(total3)-query_discount_childbed
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_childbed").val("").val(total_grand3)
        //line 4
        var query_air_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childwbed").val()
        var query_hotel_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childwbed").val()
        var query_tours_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childwbed").val()
        var query_transfer_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childwbed").val()
        var query_visa_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childwbed").val()
        var query_inc_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childwbed").val()
        var query_discount_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childwbed").val()
        var query_gst_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childwbed").val()
        //
        var query_cruise_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_childwbed").val()
        var query_meals_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_meals_childwbed").val()
        var query_markup_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_markup_childwbed").val()
        
        //
      
        var total4=parseFloat(query_air_childwbed*query_air_curr)+parseFloat(query_hotel_childwbed*query_hotel_curr)+parseFloat(query_tours_childwbed*query_tours_curr)+parseFloat(query_transfer_childwbed*query_transfer_curr)+parseFloat(query_visa_childwbed*query_visa_curr)+parseFloat(query_inc_childwbed*query_inc_curr)+parseFloat(query_gst_childwbed*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_childwbed)+parseFloat(query_meals_childwbed*query_meals_curr)+parseFloat(query_markup_childwbed*query_markup_curr)
        
        //var total4=parseFloat(total4)-parseFloat(total4*query_discount_childwbed/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_childwbed").val("").val(total4)
        var total_grand4=parseFloat(total4)-query_discount_childwbed
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_childwbed").val("").val(total_grand4)
        
        //line 5
        var query_air_infant=$(this).parent().parent().parent().children("tr").children().children(".query_air_infant").val()
        var query_hotel_infant=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_infant").val()
        var query_tours_infant=$(this).parent().parent().parent().children("tr").children().children(".query_tours_infant").val()
        var query_transfer_infant=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_infant").val()
        var query_visa_infant=$(this).parent().parent().parent().children("tr").children().children(".query_visa_infant").val()
        var query_inc_infant=$(this).parent().parent().parent().children("tr").children().children(".query_inc_infant").val()
        var query_discount_infant=$(this).parent().parent().parent().children("tr").children().children(".query_discount_infant").val()
        var query_gst_infant=$(this).parent().parent().parent().children("tr").children().children(".query_gst_infant").val()
        //
        var query_cruise_infant=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_infant").val()
        var query_meals_infant=$(this).parent().parent().parent().children("tr").children().children(".query_meals_infant").val()
        var query_markup_infant=$(this).parent().parent().parent().children("tr").children().children(".query_markup_infant").val()
        
        //
     
        var total5=parseFloat(query_air_infant*query_air_curr)+parseFloat(query_hotel_infant*query_hotel_curr)+parseFloat(query_tours_infant*query_tours_curr)+parseFloat(query_transfer_infant*query_transfer_curr)+parseFloat(query_visa_infant*query_visa_curr)+parseFloat(query_inc_infant*query_inc_curr)+parseFloat(query_gst_infant*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_infant)+parseFloat(query_meals_infant*query_meals_curr)+parseFloat(query_markup_infant*query_markup_curr)
        
        //var total5=parseFloat(total5)-parseFloat(total5*query_discount_infant/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_infant").val("").val(total5)
        var total_grand5=parseFloat(total5)-query_discount_infant
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_infant").val("").val(total_grand5)
        
        //line6
        var query_air_single=$(this).parent().parent().parent().children("tr").children().children(".query_air_single").val()
        var query_hotel_single=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_single").val()
        var query_tours_single=$(this).parent().parent().parent().children("tr").children().children(".query_tours_single").val()
        var query_transfer_single=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_single").val()
        var query_visa_single=$(this).parent().parent().parent().children("tr").children().children(".query_visa_single").val()
        var query_inc_single=$(this).parent().parent().parent().children("tr").children().children(".query_inc_single").val()
        var query_discount_single=$(this).parent().parent().parent().children("tr").children().children(".query_discount_single").val()
        var query_gst_single=$(this).parent().parent().parent().children("tr").children().children(".query_gst_single").val()
        //
        var query_cruise_single=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_single").val()
        var query_meals_single=$(this).parent().parent().parent().children("tr").children().children(".query_meals_single").val()
        var query_markup_single=$(this).parent().parent().parent().children("tr").children().children(".query_markup_single").val()
        //
        var total6=parseFloat(query_air_single*query_air_curr)+parseFloat(query_hotel_single*query_hotel_curr)+parseFloat(query_tours_single*query_tours_curr)+parseFloat(query_transfer_single*query_transfer_curr)+parseFloat(query_visa_single*query_visa_curr)+parseFloat(query_inc_single*query_inc_curr)+parseFloat(query_gst_single*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_single)+parseFloat(query_meals_single*query_meals_curr)+parseFloat(query_markup_single*query_markup_curr)
        
        //var total6=parseFloat(total6)-parseFloat(total6*query_discount_single/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_single").val("").val(total6)
        var total_grand6=parseFloat(total6)-query_discount_single
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_single").val("").val(total_grand6)
    });
    //10
    $(document).on('change','.query_meals_curr',function()
    {
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
       
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")


        var query_air_adult=$(this).parent().parent().parent().children("tr").children().children(".query_air_adult").val()
        var query_hotel_adult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_adult").val()
        var query_tours_adult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_adult").val()
        var query_transfer_adult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_adult").val()
        var query_visa_adult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_adult").val()
        var query_inc_adult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_adult").val()
        var query_discount_adult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_adult").val()
        var query_gst_adult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_adult").val()
        //
        var query_cruise_adult=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_adult").val()
        var query_meals_adult=$(this).parent().parent().parent().children("tr").children().children(".query_meals_adult").val()
        var query_markup_adult=$(this).parent().parent().parent().children("tr").children().children(".query_markup_adult").val()
        
        //
       
        
        var total1=parseFloat(query_air_adult*query_air_curr)+parseFloat(query_hotel_adult*query_hotel_curr)+parseFloat(query_tours_adult*query_tours_curr)+parseFloat(query_transfer_adult*query_transfer_curr)+parseFloat(query_visa_adult*query_visa_curr)+parseFloat(query_inc_adult*query_inc_curr)+parseFloat(query_gst_adult*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_adult)+parseFloat(query_meals_adult*query_meals_curr)+parseFloat(query_markup_adult*query_markup_curr)
        
        //var total1=parseFloat(total1)-parseFloat(total1*query_discount_adult/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_adult").val("").val(total1)
        var total_grand1=parseFloat(total1)-query_discount_adult
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_adult").val("").val(total_grand1)
       //line 2 end 

        var query_air_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_air_exadult").val()
        var query_hotel_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_exadult").val()
        var query_tours_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_exadult").val()
        var query_transfer_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_exadult").val()
        var query_visa_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_exadult").val()
        var query_inc_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_exadult").val()
        var query_discount_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_exadult").val()
        var query_gst_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_exadult").val()
        //
        var query_cruise_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_exadult").val()
        var query_meals_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_meals_exadult").val()
        var query_markup_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_markup_exadult").val()
        
        //
        
        var total2=parseFloat(query_air_exadult*query_air_curr)+parseFloat(query_hotel_exadult*query_hotel_curr)+parseFloat(query_tours_exadult*query_tours_curr)+parseFloat(query_transfer_exadult*query_transfer_curr)+parseFloat(query_visa_exadult*query_visa_curr)+parseFloat(query_inc_exadult*query_inc_curr)+parseFloat(query_gst_exadult*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_exadult)+parseFloat(query_meals_exadult*query_meals_curr)+parseFloat(query_markup_exadult*query_markup_curr)
        
        //var total2=parseFloat(total2)-parseFloat(total2*query_discount_exadult/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_exadult").val("").val(total2)
        var total_grand2=parseFloat(total2)-query_discount_exadult
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_exadult").val("").val(total_grand2)
        
        //line 3 start
        var query_air_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childbed").val()
        var query_hotel_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childbed").val()
        var query_tours_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childbed").val()
        var query_transfer_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childbed").val()
        var query_visa_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childbed").val()
        var query_inc_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childbed").val()
        var query_discount_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childbed").val()
        var query_gst_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childbed").val()
        //
        var query_cruise_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_childbed").val()
        var query_meals_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_meals_childbed").val()
        var query_markup_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_markup_childbed").val()
        
        //
     
        var total3=parseFloat(query_air_childbed*query_air_curr)+parseFloat(query_hotel_childbed*query_hotel_curr)+parseFloat(query_tours_childbed*query_tours_curr)+parseFloat(query_transfer_childbed*query_transfer_curr)+parseFloat(query_visa_childbed*query_visa_curr)+parseFloat(query_inc_childbed*query_inc_curr)+parseFloat(query_gst_childbed*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_childbed)+parseFloat(query_meals_childbed*query_meals_curr)+parseFloat(query_markup_childbed*query_markup_curr)
        
        //var total3=parseFloat(total3)-parseFloat(total3*query_discount_childbed/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_childbed").val("").val(total3)
        var total_grand3=parseFloat(total3)-query_discount_childbed
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_childbed").val("").val(total_grand3)
        //line 4
        var query_air_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childwbed").val()
        var query_hotel_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childwbed").val()
        var query_tours_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childwbed").val()
        var query_transfer_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childwbed").val()
        var query_visa_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childwbed").val()
        var query_inc_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childwbed").val()
        var query_discount_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childwbed").val()
        var query_gst_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childwbed").val()
        //
        var query_cruise_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_childwbed").val()
        var query_meals_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_meals_childwbed").val()
        var query_markup_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_markup_childwbed").val()
        
        //
      
        var total4=parseFloat(query_air_childwbed*query_air_curr)+parseFloat(query_hotel_childwbed*query_hotel_curr)+parseFloat(query_tours_childwbed*query_tours_curr)+parseFloat(query_transfer_childwbed*query_transfer_curr)+parseFloat(query_visa_childwbed*query_visa_curr)+parseFloat(query_inc_childwbed*query_inc_curr)+parseFloat(query_gst_childwbed*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_childwbed)+parseFloat(query_meals_childwbed*query_meals_curr)+parseFloat(query_markup_childwbed*query_markup_curr)
        
        //var total4=parseFloat(total4)-parseFloat(total4*query_discount_childwbed/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_childwbed").val("").val(total4)
        var total_grand4=parseFloat(total4)-query_discount_childwbed
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_childwbed").val("").val(total_grand4)
        
        //line 5
        var query_air_infant=$(this).parent().parent().parent().children("tr").children().children(".query_air_infant").val()
        var query_hotel_infant=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_infant").val()
        var query_tours_infant=$(this).parent().parent().parent().children("tr").children().children(".query_tours_infant").val()
        var query_transfer_infant=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_infant").val()
        var query_visa_infant=$(this).parent().parent().parent().children("tr").children().children(".query_visa_infant").val()
        var query_inc_infant=$(this).parent().parent().parent().children("tr").children().children(".query_inc_infant").val()
        var query_discount_infant=$(this).parent().parent().parent().children("tr").children().children(".query_discount_infant").val()
        var query_gst_infant=$(this).parent().parent().parent().children("tr").children().children(".query_gst_infant").val()
        //
        var query_cruise_infant=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_infant").val()
        var query_meals_infant=$(this).parent().parent().parent().children("tr").children().children(".query_meals_infant").val()
        var query_markup_infant=$(this).parent().parent().parent().children("tr").children().children(".query_markup_infant").val()
        
        //
     
        var total5=parseFloat(query_air_infant*query_air_curr)+parseFloat(query_hotel_infant*query_hotel_curr)+parseFloat(query_tours_infant*query_tours_curr)+parseFloat(query_transfer_infant*query_transfer_curr)+parseFloat(query_visa_infant*query_visa_curr)+parseFloat(query_inc_infant*query_inc_curr)+parseFloat(query_gst_infant*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_infant)+parseFloat(query_meals_infant*query_meals_curr)+parseFloat(query_markup_infant*query_markup_curr)
        
        //var total5=parseFloat(total5)-parseFloat(total5*query_discount_infant/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_infant").val("").val(total5)
        var total_grand5=parseFloat(total5)-query_discount_infant
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_infant").val("").val(total_grand5)
        
        //line6
        var query_air_single=$(this).parent().parent().parent().children("tr").children().children(".query_air_single").val()
        var query_hotel_single=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_single").val()
        var query_tours_single=$(this).parent().parent().parent().children("tr").children().children(".query_tours_single").val()
        var query_transfer_single=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_single").val()
        var query_visa_single=$(this).parent().parent().parent().children("tr").children().children(".query_visa_single").val()
        var query_inc_single=$(this).parent().parent().parent().children("tr").children().children(".query_inc_single").val()
        var query_discount_single=$(this).parent().parent().parent().children("tr").children().children(".query_discount_single").val()
        var query_gst_single=$(this).parent().parent().parent().children("tr").children().children(".query_gst_single").val()
        //
        var query_cruise_single=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_single").val()
        var query_meals_single=$(this).parent().parent().parent().children("tr").children().children(".query_meals_single").val()
        var query_markup_single=$(this).parent().parent().parent().children("tr").children().children(".query_markup_single").val()
        //
        var total6=parseFloat(query_air_single*query_air_curr)+parseFloat(query_hotel_single*query_hotel_curr)+parseFloat(query_tours_single*query_tours_curr)+parseFloat(query_transfer_single*query_transfer_curr)+parseFloat(query_visa_single*query_visa_curr)+parseFloat(query_inc_single*query_inc_curr)+parseFloat(query_gst_single*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_single)+parseFloat(query_meals_single*query_meals_curr)+parseFloat(query_markup_single*query_markup_curr)
        
        //var total6=parseFloat(total6)-parseFloat(total6*query_discount_single/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_single").val("").val(total6)
        var total_grand6=parseFloat(total6)-query_discount_single
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_single").val("").val(total_grand6)
    });
    //11
    $(document).on('change','.query_markup_curr',function()
    {
        var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
        var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
        var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
        var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
        var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
        var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
        var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
        //extra selected currency start
       
        var query_cruise_curr=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_curr").find('option:selected'); 
        var query_meals_curr=$(this).parent().parent().parent().children("tr").children().children(".query_meals_curr").find('option:selected'); 
        var query_markup_curr=$(this).parent().parent().parent().children("tr").children().children(".query_markup_curr").find('option:selected'); 
        
        var query_cruise_curr=query_cruise_curr.attr("c_val")
        var query_meals_curr=query_meals_curr.attr("c_val")
        var query_markup_curr=query_markup_curr.attr("c_val")
        //extra selected currency end

        var query_air_curr=query_air_curr.attr("c_val")
        var query_hotel_curr=query_hotel_curr.attr("c_val")
        var query_tours_curr=query_tours_curr.attr("c_val")
        var query_transfer_curr=query_transfer_curr.attr("c_val")
        var query_visa_curr=query_visa_curr.attr("c_val")
        var query_inc_curr=query_inc_curr.attr("c_val")
       
        var query_gst_curr=query_gst_curr.attr("c_val")


        var query_air_adult=$(this).parent().parent().parent().children("tr").children().children(".query_air_adult").val()
        var query_hotel_adult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_adult").val()
        var query_tours_adult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_adult").val()
        var query_transfer_adult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_adult").val()
        var query_visa_adult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_adult").val()
        var query_inc_adult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_adult").val()
        var query_discount_adult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_adult").val()
        var query_gst_adult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_adult").val()
        //
        var query_cruise_adult=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_adult").val()
        var query_meals_adult=$(this).parent().parent().parent().children("tr").children().children(".query_meals_adult").val()
        var query_markup_adult=$(this).parent().parent().parent().children("tr").children().children(".query_markup_adult").val()
        
        //
       
        
        var total1=parseFloat(query_air_adult*query_air_curr)+parseFloat(query_hotel_adult*query_hotel_curr)+parseFloat(query_tours_adult*query_tours_curr)+parseFloat(query_transfer_adult*query_transfer_curr)+parseFloat(query_visa_adult*query_visa_curr)+parseFloat(query_inc_adult*query_inc_curr)+parseFloat(query_gst_adult*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_adult)+parseFloat(query_meals_adult*query_meals_curr)+parseFloat(query_markup_adult*query_markup_curr)
        
        //var total1=parseFloat(total1)-parseFloat(total1*query_discount_adult/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_adult").val("").val(total1)
        var total_grand1=parseFloat(total1)-query_discount_adult
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_adult").val("").val(total_grand1)
       //line 2 end 

        var query_air_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_air_exadult").val()
        var query_hotel_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_exadult").val()
        var query_tours_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_exadult").val()
        var query_transfer_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_exadult").val()
        var query_visa_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_exadult").val()
        var query_inc_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_exadult").val()
        var query_discount_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_exadult").val()
        var query_gst_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_exadult").val()
        //
        var query_cruise_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_exadult").val()
        var query_meals_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_meals_exadult").val()
        var query_markup_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_markup_exadult").val()
        
        //
        
        var total2=parseFloat(query_air_exadult*query_air_curr)+parseFloat(query_hotel_exadult*query_hotel_curr)+parseFloat(query_tours_exadult*query_tours_curr)+parseFloat(query_transfer_exadult*query_transfer_curr)+parseFloat(query_visa_exadult*query_visa_curr)+parseFloat(query_inc_exadult*query_inc_curr)+parseFloat(query_gst_exadult*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_exadult)+parseFloat(query_meals_exadult*query_meals_curr)+parseFloat(query_markup_exadult*query_markup_curr)
        
        //var total2=parseFloat(total2)-parseFloat(total2*query_discount_exadult/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_exadult").val("").val(total2)
        var total_grand2=parseFloat(total2)-query_discount_exadult
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_exadult").val("").val(total_grand2)
        
        //line 3 start
        var query_air_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childbed").val()
        var query_hotel_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childbed").val()
        var query_tours_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childbed").val()
        var query_transfer_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childbed").val()
        var query_visa_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childbed").val()
        var query_inc_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childbed").val()
        var query_discount_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childbed").val()
        var query_gst_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childbed").val()
        //
        var query_cruise_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_childbed").val()
        var query_meals_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_meals_childbed").val()
        var query_markup_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_markup_childbed").val()
        
        //
     
        var total3=parseFloat(query_air_childbed*query_air_curr)+parseFloat(query_hotel_childbed*query_hotel_curr)+parseFloat(query_tours_childbed*query_tours_curr)+parseFloat(query_transfer_childbed*query_transfer_curr)+parseFloat(query_visa_childbed*query_visa_curr)+parseFloat(query_inc_childbed*query_inc_curr)+parseFloat(query_gst_childbed*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_childbed)+parseFloat(query_meals_childbed*query_meals_curr)+parseFloat(query_markup_childbed*query_markup_curr)
        
        //var total3=parseFloat(total3)-parseFloat(total3*query_discount_childbed/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_childbed").val("").val(total3)
        var total_grand3=parseFloat(total3)-query_discount_childbed
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_childbed").val("").val(total_grand3)
        //line 4
        var query_air_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childwbed").val()
        var query_hotel_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childwbed").val()
        var query_tours_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childwbed").val()
        var query_transfer_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childwbed").val()
        var query_visa_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childwbed").val()
        var query_inc_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childwbed").val()
        var query_discount_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childwbed").val()
        var query_gst_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childwbed").val()
        //
        var query_cruise_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_childwbed").val()
        var query_meals_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_meals_childwbed").val()
        var query_markup_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_markup_childwbed").val()
        
        //
      
        var total4=parseFloat(query_air_childwbed*query_air_curr)+parseFloat(query_hotel_childwbed*query_hotel_curr)+parseFloat(query_tours_childwbed*query_tours_curr)+parseFloat(query_transfer_childwbed*query_transfer_curr)+parseFloat(query_visa_childwbed*query_visa_curr)+parseFloat(query_inc_childwbed*query_inc_curr)+parseFloat(query_gst_childwbed*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_childwbed)+parseFloat(query_meals_childwbed*query_meals_curr)+parseFloat(query_markup_childwbed*query_markup_curr)
        
        //var total4=parseFloat(total4)-parseFloat(total4*query_discount_childwbed/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_childwbed").val("").val(total4)
        var total_grand4=parseFloat(total4)-query_discount_childwbed
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_childwbed").val("").val(total_grand4)
        
        //line 5
        var query_air_infant=$(this).parent().parent().parent().children("tr").children().children(".query_air_infant").val()
        var query_hotel_infant=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_infant").val()
        var query_tours_infant=$(this).parent().parent().parent().children("tr").children().children(".query_tours_infant").val()
        var query_transfer_infant=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_infant").val()
        var query_visa_infant=$(this).parent().parent().parent().children("tr").children().children(".query_visa_infant").val()
        var query_inc_infant=$(this).parent().parent().parent().children("tr").children().children(".query_inc_infant").val()
        var query_discount_infant=$(this).parent().parent().parent().children("tr").children().children(".query_discount_infant").val()
        var query_gst_infant=$(this).parent().parent().parent().children("tr").children().children(".query_gst_infant").val()
        //
        var query_cruise_infant=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_infant").val()
        var query_meals_infant=$(this).parent().parent().parent().children("tr").children().children(".query_meals_infant").val()
        var query_markup_infant=$(this).parent().parent().parent().children("tr").children().children(".query_markup_infant").val()
        
        //
     
        var total5=parseFloat(query_air_infant*query_air_curr)+parseFloat(query_hotel_infant*query_hotel_curr)+parseFloat(query_tours_infant*query_tours_curr)+parseFloat(query_transfer_infant*query_transfer_curr)+parseFloat(query_visa_infant*query_visa_curr)+parseFloat(query_inc_infant*query_inc_curr)+parseFloat(query_gst_infant*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_infant)+parseFloat(query_meals_infant*query_meals_curr)+parseFloat(query_markup_infant*query_markup_curr)
        
        //var total5=parseFloat(total5)-parseFloat(total5*query_discount_infant/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_infant").val("").val(total5)
        var total_grand5=parseFloat(total5)-query_discount_infant
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_infant").val("").val(total_grand5)
        
        //line6
        var query_air_single=$(this).parent().parent().parent().children("tr").children().children(".query_air_single").val()
        var query_hotel_single=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_single").val()
        var query_tours_single=$(this).parent().parent().parent().children("tr").children().children(".query_tours_single").val()
        var query_transfer_single=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_single").val()
        var query_visa_single=$(this).parent().parent().parent().children("tr").children().children(".query_visa_single").val()
        var query_inc_single=$(this).parent().parent().parent().children("tr").children().children(".query_inc_single").val()
        var query_discount_single=$(this).parent().parent().parent().children("tr").children().children(".query_discount_single").val()
        var query_gst_single=$(this).parent().parent().parent().children("tr").children().children(".query_gst_single").val()
        //
        var query_cruise_single=$(this).parent().parent().parent().children("tr").children().children(".query_cruise_single").val()
        var query_meals_single=$(this).parent().parent().parent().children("tr").children().children(".query_meals_single").val()
        var query_markup_single=$(this).parent().parent().parent().children("tr").children().children(".query_markup_single").val()
        //
        var total6=parseFloat(query_air_single*query_air_curr)+parseFloat(query_hotel_single*query_hotel_curr)+parseFloat(query_tours_single*query_tours_curr)+parseFloat(query_transfer_single*query_transfer_curr)+parseFloat(query_visa_single*query_visa_curr)+parseFloat(query_inc_single*query_inc_curr)+parseFloat(query_gst_single*query_gst_curr)+parseFloat(query_cruise_curr*query_cruise_single)+parseFloat(query_meals_single*query_meals_curr)+parseFloat(query_markup_single*query_markup_curr)
        
        //var total6=parseFloat(total6)-parseFloat(total6*query_discount_single/100)
        $(this).parent().parent().parent().children("tr").children().children(".query_total_single").val("").val(total6)
        var total_grand6=parseFloat(total6)-query_discount_single
        $(this).parent().parent().parent().children("tr").children().children(".query_grand_single").val("").val(total_grand6)
    });
});

/************/

document.quo1.onsubmit=function() {
  return quotation_submit("#option1_mandate")
};
document.quo2.onsubmit=function() {
  return quotation_submit("#option2_mandate")
};
document.quo3.onsubmit=function() {
  return quotation_submit("#option3_mandate")
};
document.quo4.onsubmit=function() {
  return quotation_submit("#option4_mandate")
};
function quotation_submit(id) {
    var name=$(id).val()
    if( name.trim()=="") {
        alert("Please enter Lead traveller price to proceed further")
        return false;
    }
};
$(document).ready(function () {
	// Show the send voucher modal when the send voucher button is clicked
	$(document).on('click', '.send_voucher', function() {

		// Get the data-id attribute value
	    var id = $(this).data('id');

	    // Set the lead ID in the hidden input field
	    $("#lead_id").val("").val(id);

	    // Show the send voucher modal
	    $('#send_voucher').modal('show');
	});

	/***********************************************/

	// Handle the resend voucher action
	$(document).on('click', '.resend', function() {
	    var id = $(this).data('id'); // Get the data-id attribute value
	    $(".resend").css("display", "none"); // Hide the resend button
	    
	    // Make an AJAX GET request to resend the voucher
	    $.ajax({
	        type: 'get', // HTTP method
	        url: APP_URL + '/resend', // URL to send the request to
	        // dataType: 'json', // Uncomment if expecting JSON response
	        data: { id: id }, // Data to be sent to the server (ID)
	        
	        // Function to execute on successful response
	        success: function(data) {
	            alert(data); // Show alert with the response message
	            setTimeout(function() {
	                location.reload(); // Reload the page after 300ms
	            }, 300);
	        },
	        
	        // Function to execute if there's an error in the request
	        error: function(data) {
	            // Handle error if AJAX request fails
	        }
	    });
	});


	/***********************************************/

	// Handle click event on the voucher list button
	$(document).on('click', '.voucher_list', function() {
	    
	    // Retrieve the data-id attribute from the clicked element
	    var id = $(this).data('id');
	    
	    // Make an AJAX POST request to fetch the voucher list
	    $.ajax({
	        type: 'post', // HTTP method
	        url: APP_URL + '/voucherlist', // URL to send the request to
	        // dataType: 'json', // Uncomment if expecting JSON response
	        data: { id: id }, // Data to be sent to the server (ID)
	        
	        // Function to execute on successful response
	        success: function(data) {
	            // Clear existing content in the voucher list body
	            $("#voucher_list_body").empty();
	            // Append the new voucher list data to the modal body
	            $("#voucher_list_body").append(data);
	            // Show the voucher list modal
	            $('#voucher_lists').modal('show');
	        },
	        
	        // Function to execute if there's an error in the request
	        error: function(data) {
	            // Uncomment to log the error for debugging
	            // console.log('Error : ' + data);
	        }
	    });
	});
});
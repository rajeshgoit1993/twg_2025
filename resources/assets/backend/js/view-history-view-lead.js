// view-history-view-lead
$(document).ready(function() {
	// View lead history timeline
	$(document).on("click", ".view_history", function(e) {
	    e.preventDefault(); // Prevent the default action of the link

	    // Get the data-id attribute value from the clicked element
	    var id = $(this).data('id');

	    // Make an AJAX request to fetch the enquiry history
	    $.ajax({
	        type: 'POST', // HTTP method
	        url: APP_URL + '/get_enquiry_history', // URL to send the request to
	        // dataType: 'json', // Uncomment if expecting a JSON response
	        data: { id: id }, // Data to send with the request (enquiry ID)
	        success: function(data) {
	            // Update HTML elements with data received from the server
	            $(".enq_ref_no").html(data.enq_ref_no); // Update enquiry reference number
	            $(".quote_ref_no").html(data.quote_ref_no); // Update quote reference number
	            $(".view_history_body").html(data.output); // Update history content

	            // Show the modal with the enquiry history
	            $('#view_history_modal').modal('toggle');
	        },
	        error: function(data) {
	            // Handle error if the AJAX request fails (optional)
	            // console.log('Error: ' + data);
	        }
	    });
	});

	/***********************************************/

	// View lead (enquiry details)
	$(document).on('click', '.open-enquiryModal', function() {
	    // Set the value of the hidden input field with the ID from the clicked element
	    $('#bookId').val($(this).data('id'));

	    // Retrieve the ID from the clicked element
	    var id = $(this).data('id');

	    // Make an AJAX request to fetch enquiry details
	    $.ajax({
	        type: 'post', // HTTP method
	        url: APP_URL + '/enq_data', // URL to send the request to
	        // dataType: 'json', // Uncomment if expecting a JSON response
	        data: { id: id }, // Data to send with the request
	        success: function(data) {
	            // Log the success response (for debugging)
	            console.log('Success: ' + data);

	            // Clear the current modal body content
	            $("#modal-body").empty();

	            // Append the new data to the modal body
	            $("#modal-body").append(data);

	            // Show the modal with the enquiry details
	            $('#enquiryModal').modal('show');
	        },
	        error: function(data) {
	            // Handle error if the AJAX request fails (optional)
	            // console.log('Error: ' + data);
	        }
	    });
	});
});
/*quotation*/

$(document).ready(function() {

	// add more vouchers
	$('#fileInput').change(function() {

		// Clear previous file names
		$('#fileNames').empty();

		// Get the files
		var files = $(this)[0].files;

		// Iterate through each file and display its name
		for(var i = 0; i < files.length; i++) {
			$('#fileNames').append('<div>' + files[i].name + '</div>');
		}
	});

	/***********************************************/

	// resend_voucher
	// Handle the click event for resending a voucher
	$(document).on('click', '.resend', function() {
	    var id = $(this).data('id'); // Get the data-id attribute value
	    $("#resend_lead_id").val('').val(id); // Set the lead ID in the hidden input field

	    // Make an AJAX request to resend the voucher
	    $.ajax({
	        type: 'get', // Use GET method
	        url: APP_URL + '/resend', // URL to send the request to
	        // dataType: 'json', // Uncomment if expecting a JSON response
	        data: { id: id }, // Send the lead ID as data
	        success: function(data) {
	            // On success, update the file type dropdown with the received data
	            $(".file_type").empty().append(data);

	            // Show the resend voucher modal
	            $('#resend_voucher').modal('show');
	            
	            // Uncomment below if you want to alert the user and reload the page
	            // alert(data);
	            // setTimeout(function () {
	            //     location.reload();
	            // }, 300);
	        },
	        error: function(data) {
	            // Handle errors (optional)
	        }
	    });
	});

	/***********************************************/

	// Handle the click event to display the voucher list
	$(document).on('click', '.voucher_list', function() {
	    var id = $(this).data('id'); // Get the data-id attribute value

	    // Make an AJAX request to fetch the voucher list
	    $.ajax({
	        type: 'post', // Use POST method
	        url: APP_URL + '/voucherlist', // URL to send the request to
	        // dataType: 'json', // Uncomment if expecting a JSON response
	        data: { id: id }, // Send the ID as data
	        success: function(data) {
	            // On success, update the voucher list modal body with the received data
	            $("#voucher_list_body").empty().append(data);

	            // Show the voucher list modal
	            $('#voucher_lists').modal('show');
	        },
	        error: function(data) {
	            // Handle errors (optional)
	            // console.log('Error : ' + data);
	        }
	    });
	});

	/***********************************************/

	// Handle the click event to initiate sending a voucher
	$(document).on('click', '.send_voucher', function() {
	    var id = $(this).data('id'); // Get the data-id attribute value

	    // Set the lead ID in the hidden input field of the modal
	    $("#lead_id").val("").val(id);

	    // Show the 'Send Voucher' modal
	    $('#send_voucher').modal('show');
	});
});
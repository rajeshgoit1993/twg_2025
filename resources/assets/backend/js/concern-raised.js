// raised concern (guest requests)
$(document).ready(function() {
    // Disable the unique_code field
    $(".unique_code").attr("disabled", true);

	// Close raise concern form submission handler
	$(document).on("submit", "#close_raise_concern", function(event) {
	    event.preventDefault(); // Prevent default form submission

	    var form_data = new FormData($("#close_raise_concern")[0]); // Get form data
	    var APP_URL = $("#APP_URL").val(); // Get the application URL from a hidden input

	    // Make an AJAX POST request to update the raise concern status
	    $.ajax({
	        url: APP_URL + '/update_raise_concern', // URL to send the request to
	        data: form_data, // Data to be sent to the server
	        type: 'post', // HTTP method
	        contentType: false, // Don't set content type
	        processData: false, // Don't process the data
	        
	        // Function to execute on successful response
	        success: function(data) {
	        	// If the request is successful
	            if (data.output === 'success') {
	                $('#view_raise_modal').modal('toggle'); // Close the modal

	                // Update the button class based on the response
	                var class_name = 'raise_btn_class' + data.id; // Generate class name
	                $("." + class_name)
	                	.removeClass('btn-danger btn-warning btn-success')
	                	.addClass(data.btn_class); // Update button class

	                // Show success message using SweetAlert
	                swal({
	                    title: "Done!",
	                    text: "Successfully Updated.",
	                    type: "success",
	                    timer: 2000
	                });
	            } else {
	                // Show error message using SweetAlert
	                swal({
	                    title: "Warning!",
	                    text: "Error",
	                    type: "error",
	                    timer: 1000
	                });
	            }
	        },
	        
	        // Function to execute if there's an error in the request
	        error: function(data) {
	            // Handle error here (e.g., log the error, show a message)
	        }
	    });
	});

	/***********************************************/

	// View raise event handler
	$(document).on("click", ".view_raise", function(e) {
	    e.preventDefault(); // Prevent default action of the link

	    var id = $(this).data('id'); // Get the data-id attribute value

	    // Make an AJAX POST request to get enquiry raise details
	    $.ajax({
	        type: 'post', // HTTP method
	        url: APP_URL + '/get_enquiry_raise', // URL to send the request to
	        data: { id: id }, // Data to be sent to the server (ID)
	        
	        // Function to execute on successful response
	        success: function(data) {
	            $(".enq_ref_noo").html('').html(data.enq_ref_no); // Update enquiry reference number
	            $(".quote_ref_noo").html('').html(data.quote_ref_no); // Update quote reference number
	            $(".view_raise_body").html('').html(data.output); // Update modal body content
	            $('#view_raise_modal').modal('toggle'); // Show the modal
	        },
	        
	        // Function to execute if there's an error in the request
	        error: function(data) {
	            // Handle error here (e.g., log the error, show a message)
	        }
	    });
	});

	$(document).on("click",".view_raise_remarks", function(e)
    {
e.preventDefault(); 
        var id = $(this).attr('raise_id'); // Get the data-id attribute value

        // Make an AJAX POST request to get enquiry raise details
        $.ajax({
            type: 'post', // HTTP method
            url: APP_URL + '/view_raise_remarks', // URL to send the request to
            data: { id: id }, // Data to be sent to the server (ID)
            
            // Function to execute on successful response
            success: function(data) {
                
                $(".view_raise_remarks_body").html('').html(data.output); // Update modal body content
               $("#view_raise_remarks_modal").modal('toggle');  // Show the modal
            },
            
            // Function to execute if there's an error in the request
            error: function(data) {
                // Handle error here (e.g., log the error, show a message)
            }
        });


    })
});

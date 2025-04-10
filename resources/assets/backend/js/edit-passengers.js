/*quotation*/

//Edit Passenger
$(document).ready(function() {
	// Initially disable elements with the class 'unique_code'
	$(".unique_code").attr("disabled", true);

	// Handle click event for adding or editing a passenger
	$(document).on("click", ".add_edit_passenger", function() {
	    var unique_code = $(this).closest('.btnContainer').find(".unique_code").val(); // Find the unique_code within the same container
	    /*console.log("Unique Code:", unique_code); // Add this line to see the unique code in the console*/

	    if (unique_code === undefined) {
            console.log("Error: .unique_code not found in the expected location.");
            return; // Stop execution if not found
        }

	    var token = jQuery('input[name="_token"]').val(); // Retrieve the CSRF token value
	    var content_action = jQuery(this).attr("content_action"); // Get the 'content_action' attribute value

	    // Create a form element
	    var form = document.createElement("form");
	    form.setAttribute("method", "post"); // Set form method to POST
	    form.setAttribute("action", content_action); // Set the action to the content_action value
	    form.setAttribute("target", "formresult"); // Target the form submission to a new window/tab

	    // Create and append a hidden input for the CSRF token
	    var hiddenField = document.createElement("input");
	    hiddenField.setAttribute("type", "hidden");
	    hiddenField.setAttribute("name", "_token");
	    hiddenField.setAttribute("value", token);
	    form.appendChild(hiddenField);

	    // Create and append a hidden input for the unique code
	    var third_field = document.createElement("input");
	    third_field.setAttribute("type", "hidden");
	    third_field.setAttribute("name", "unique_code");
	    third_field.setAttribute("value", unique_code);
	    form.appendChild(third_field);

	    // Append the form to the document body
	    document.body.appendChild(form);

	    // Open a new window to display the form result
	    let myWindow = window.open('', 'formresult', 'scrollbars=no,menubar=no,height=600,width=800,resizable=yes,toolbar=no,status=no');

	    // Submit the form
	    form.submit();
	});
});
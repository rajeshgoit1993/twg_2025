/*quotation*/

//send quotation
$(document).ready(function() {
	$(document).on("click", ".quotation_send", function() {
	    // Get the selected quotation's ID, quotation number, and reference number
	    var quo_id = $(this).siblings().find('option:selected').attr("id");
	    var quo_no = $(this).siblings().find('option:selected').attr("quotation_no");
	    var ref_no = $(this).siblings().find('option:selected').attr("ref_no");

	    // Check if the quotation ID or number is "0" (indicating an invalid selection)
	    if (quo_id == "0" || quo_no == "0") {
	        return false; // Stop the function if an invalid selection is made
	    } else {
	        // Set the hidden input values for the selected quotation details
	        $("#quote_id").val("").val(quo_id);
	        $("#quote_no").val("").val(quo_no);
	        $("#ref_no").val("").val(ref_no);

	        // Confirm action with the user
	        var r = confirm("Are you sure?");
	        if (r == true) {
	            // If the user confirms, submit the form
	            $('#send_custom_quote').submit();
	        } else {
	            // If the user cancels, do nothing
	            return false;
	        }
	    }
	});
});
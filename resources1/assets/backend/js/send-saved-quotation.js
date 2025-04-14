/*saved quote-quotation*/

// send saved quote
$(document).on("click", ".send_quote", function(e) {
    e.preventDefault(); // Prevent default action of the link

    // Ask for confirmation
    var r = confirm("Are you sure, you want to send this quote ?");
    if (r == true) {
        // If confirmed, proceed with AJAX request
        var id = $(this).data('id');
        var APP_URL = $("#APP_URL").val(); // Assuming you have an input field with id="APP_URL"

        $.ajax({
            url: APP_URL + '/send_saved_quote',
            data: { id: id },
            type: 'GET',
            // contentType: false, // Not needed for GET request
            // processData: false, // Not needed for GET request
            success: function(data) {
                if (data == 'success') {
                    // Show success message
                    swal({
                        title: "Done !",
                        text: "This lead has moved into Quote Sent",
                        type: "success",
                        timer: 3000
                    });

                    // Reload the page after 3 seconds
                    setTimeout(function() {
                        window.location.reload(1);
                    }, 3000);
                } else {
                    // Show error message
                    swal({
                        title: "Warning !",
                        text: 'Error',
                        type: "error",
                        timer: 1000
                    });
                }
            },
            error: function(data) {
                // Handle error if AJAX request fails
            }
        });
    }
});
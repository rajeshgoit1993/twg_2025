// holiday destination search box and theme selection
$(document).ready(function() {
    // Initialize Select2 on elements with class 'select2'
    jQuery('.select2').select2();

    var searchDestinationUrl = $('#SEARCH_DESTINATION_URL').val(); // Retrieve the route URL

    // Initialize Select2 on .select3
    jQuery('.select3').select2({
        placeholder: "To",  // Set the placeholder text for Select2
        allowClear: true,  // Allow clearing the selected option
        ajax: {
            // url: jQuery("#APP_URL").val() + '/search-destination',  // AJAX URL to fetch destinations
            url: searchDestinationUrl,  // Use the hidden input value for the AJAX URL
            type: "GET",  // HTTP method
            dataType: 'json',  // Expected response data type 
            delay: 250,  // Delay before sending request to the server
            data: function(params) {
                return {
                    searchTerm: params.term  // Send search term to the server
                };
            },
            processResults: function(response) {
                return {
                    results: response  // Process the server response to return the results
                };
            },
            cache: true,  // Cache the results for performance
            beforeSend: function(xhr) {
                xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
            }
        },
        templateResult: function(data) {
            // Format the dropdown display text
            return data.text || data.id; // dropdown shows full label, like "Goa, India"
        },

        // display only destination (working)
        // templateSelection: function(data) {
        //     if (!data.id) {
        //         return "To";  // Placeholder if nothing is selected
        //     }

        //     // If 'data.text' is like "Goa, India (13 Packages)", extract just "Goa"
        //     const label = data.text || '';
        //     const shortName = label.split(',')[0].trim();  // Take only the first part before comma

        //     return shortName;
        // }

        // display only destination (working)
        templateSelection: function(data) {
            if (!data.id || !data.text) {
                return "To";  // Default placeholder
            }

            // Example: data.text = "Goa, India (13 Packages)"
            let label = data.text;

            // Remove anything in parentheses (like package count)
            label = label.replace(/\s*\(.*?\)/, '');

            // Then take the first part before the first comma
            const shortName = label.split(',')[0].trim();

            return shortName || "To";
        }
    });
    
    // Ensure the placeholder appears in the search input of the dropdown
    jQuery('.select3').on('select2:open', function () {
        var searchField = jQuery('.select2-search__field');
        if (searchField.val() === '') {
            searchField.attr('placeholder', 'Enter city name');
        }
    });

    // ********************

    // Holiday destination search by theme
    $(document).on('change.select2', '.package_service', function (e) {
        var data_value = jQuery(this).val(); // Get selected value
        $("#destination_search").val(data_value); // Set the selected value to the hidden input
        $("#response").html(""); // Clear the response area

        // var APP_URL = $("#APP_URL").val(); // Get the base URL
        // var url = APP_URL + '/search_theme'; // Construct the URL for theme search
        var SEARCH_THEME_URL = $("#SEARCH_THEME_URL").val(); // Retrieve the route URL
        var data = {
            search_theme: data_value, // Send the selected theme
            _token: $('meta[name="csrf-token"]').attr('content') // Use CSRF token from meta tag
        };

        // Make an AJAX POST request to search themes
        // $.post(url, data, function (rdata) {
        $.get(SEARCH_THEME_URL, data, function (rdata) {
            $("#select_theme").html(rdata); // Update the theme select dropdown with the response
        });
    });
});


/*$(document).ready(function() {
    // Initialize Select2 on elements with class 'select2'
    jQuery('.select2').select2();

    // Holiday search box results
    jQuery('.select3').select2 ({
        placeholder: "To", // Placeholder for the search box
        allowClear: true, // Allow clearing the selected option
        ajax: {
            url: jQuery("#APP_URL").val() + '/search-destination', // AJAX URL for fetching destinations
            type: "GET", // HTTP method
            dataType: 'json', // Expected data type from server
            delay: 250, // Delay in ms before sending request
            data: function(params) {
                return {
                    searchTerm: params.term // Send search term to server
                };
            },
            processResults: function(response) {
                return {
                    results: response // Process and return the response as results
                };
            },
            cache: true // Enable caching of AJAX results
        }
    });

    // Holiday destination search by theme
    jQuery(document).on('change.select2', '.package_service', function(e) {
        var data_value = jQuery(this).val(); // Get selected value
        $("#destination_search").val(data_value); // Set the selected value to the hidden input
        $("#response").html(""); // Clear the response area

        var APP_URL = $("#APP_URL").val(); // Get the base URL
        var url = APP_URL + '/search_theme'; // Construct the URL for theme search
        var data = {
            search_theme: data_value, // Send the selected theme
            _token: "{{ csrf_token() }}" // Include CSRF token for security
        };

        // Make an AJAX POST request to search themes
        $.post(url, data, function(rdata) {
            //console.log(rdata); // Log the response data
            $("#select_theme").html(rdata); // Update the theme select dropdown with the response
        });
    });
});*/
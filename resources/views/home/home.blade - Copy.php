@extends('layouts.front.master')
    
    <!-- websitenamehelpers -->
    @section("title", getWebsiteData('metaTitle_Home'))
    @section("title", getWebsiteData('metaKeywords_Home'))
    @section("title", getWebsiteData('metaDescription_Home'))

@section("custom_css")

<style type="text/css">
/* Ensure the placeholder text color is visible */
.select2-search__field::placeholder {
    color: #aaa;  /* Adjust to your desired color */
    font-style: italic;
    text-transform: none;
}

</style>

<!--holidays -->
<!-- <link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/holidays.css') }}" /> -->

<!-- mobile search panel -->
<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/mobile-search-panel.css') }}" />

<!-- search panel -->
<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/desktop-search-panel.css') }}" />

<!-- mobile subscription box -->
<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/mobile-subscription.css') }}" />

<!-- search subscription box -->
<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/desktop-subscription.css') }}" />

<!-- mobile home packages -->
<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/mobile-home-packages.css') }}" />

<!-- desktop home packages -->
<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/desktop-home-packages.css') }}" />

<!-- mobile promotion-goa -->
<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/mobile-promotion.css') }}" />

<!-- desktop promotion-goa -->
<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/desktop-promotion.css') }}" />

<!-- travel-insurance -->
<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/travel-insurance.css') }}" />

<!-- carousel for testimonials -->
<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/carousel.css') }}" />

@endsection

@section('header_datepicker_js')

<!-- placed in header tag -->
<!-- <script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/date-picker-search-panel.js") }}'></script> -->

@endsection

@section('content')

<section>
	<!-- Home Page Content Starts (home.home desktop & mobile) -->
	<div>
		@include('home.desktop.desktopSearchPanel')
		@include('home.desktop.desktopSubscription')
		@include('home.desktop.desktopMidimage')
		@include('home.desktop.desktopPackages')
		@include('home.desktop.trendingHoneymoon')
		@include('home.desktop.desktopSectionGoa')
		@include('home.desktop.desktopTestimonials')
		<!--<div class="mid_img"></div>-->
	</div>
	<!-- Home Page Content Ends (desktop & mobile) -->

	<div class="testing">
		<!-- <input type="hidden" value="{{ url('/') }}" name="" id="testvalue"> -->
		<!-- <input type="hidden" id="APP_URL" value="{{ url('/') }}"> -->
		<input type="hidden" id="SEARCH_DESTINATION_URL" value="{{ route('searchDestination') }}">
		<input type="hidden" id="SEARCH_THEME_URL" value="{{ route('searchTheme') }}">
	</div>
</section>

<!-- section('home-page-js') -->

<!-- jquery( placed in head tag) -->
<!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->

@endsection

@section("custom_js")
<!-- home page js starts -->

<!-- sticky web header -->
<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/web-header.js") }}'></script>

<!-- search panel date picker -->
<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/date-picker-search-panel.js") }}'></script>

<!--page one script -->
<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/pageone.js") }}'></script>

<!-- destination search -->
<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/destination-search.js") }}'></script>

<!-- insurance guest box -->
<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/insurance-guest-input.js") }}'></script>

<script>
// holiday destination search box (working from here) (search panel) - pageone.js(79L)
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
            cache: true, // Enable caching of AJAX results
            beforeSend: function(xhr) {
                xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
            }
        },
        templateResult: function(data) {
	        // This will display the full text in the dropdown (e.g., "Goa (Goa, India) (12 Packages)")
	        // return data.text;
	        return data.text || data.id;
	    },
	    templateSelection: function(data) {
	        // This will set only the destination name (e.g., "Goa") in the input field after selection
	        // return data.value; // Use the value (simple destination name) for the input field
	        return data.id;  // This will only display the destination name (e.g., "Goa")
	    }
    });
});*/

/*jQuery(document).ready(function() {
    // Ensure the select element is empty before initializing
    // jQuery('.select3').empty();
    jQuery('.select2').select2();

    // Initialize Select2
    jQuery('.select3').select2({
        placeholder: "To City / Country",  // Set placeholder text
        allowClear: true,  // Allow clearing the selected option
        ajax: {
            url: jQuery("#APP_URL").val() + '/search-destination',  // AJAX URL for fetching destinations
            type: "GET",  // HTTP method
            dataType: 'json',  // Expected data type from server
            delay: 250,  // Delay before sending request
            data: function(params) {
                return {
                    searchTerm: params.term  // Send search term to the server
                };
            },
            processResults: function(response) {
                // Process the server response and return the results in Select2 format
                return {
                    results: response  // Response should be an array of objects with 'id' and 'text' properties
                };
            },
            cache: true,  // Enable caching of AJAX results
            beforeSend: function(xhr) {
                xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
            }
        },
        templateResult: function(data) {
            // Format the dropdown display text
            return data.text || data.id;
        },
        templateSelection: function(data) {
            // Set what gets displayed in the input box after selection
            return data.id;  // This will only display the destination name (e.g., "Goa")
        }
    }).on('select2:open', function() {
        // Apply the placeholder to the search input inside Select2 when dropdown is opened
        var placeholder = jQuery('.select3').attr('placeholder');
        if (placeholder) {
            jQuery('.select2-search__field').attr('placeholder', placeholder);
        }
    }).on('select2:close', function() {
        // Ensure that the placeholder is reset when closing the dropdown
        var placeholder = jQuery('.select3').attr('placeholder');
        if (placeholder) {
            jQuery('.select2-search__field').attr('placeholder', placeholder);
        }
    });
});*/

/*$(document).ready(function() {
	// Initialize Select2 on elements with class 'select2'
	jQuery('.select2').select2();

    // Initialize Select2 on .select3
    jQuery('.select3').select2({
        placeholder: "To",  // Set the placeholder text for Select2
        allowClear: true,  // Allow clearing the selected option
        ajax: {
            url: jQuery("#APP_URL").val() + '/search-destination',  // AJAX URL to fetch destinations
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
            return data.text || data.id;
        },
        templateSelection: function(data) {
            // Set what gets displayed in the input box after selection
            // return data.id;  // This will only display the destination name (e.g., "Goa")
            // Check if a selection is made, if not, return null to keep placeholder
            if (data.id === '') {
                return "To";  // Placeholder text
            }
            return data.id;  // Return the selected destination name
        },
        // language: {
        //     noResults: function() {
        //         return "No results found"; // Message when no results match the search
        //     },
        //     inputTooShort: function () {
        //         return "Select or enter city name"; // Placeholder for the input field in the dropdown
        //     }
        // }
    });
    // Ensure the placeholder appears in the search input of the dropdown
    jQuery('.select3').on('select2:open', function () {
        var searchField = jQuery('.select2-search__field');
        if (searchField.val() === '') {
            searchField.attr('placeholder', 'Select or enter city name');
        }
    });
});*/

/*$(document).ready(function() {
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
</script>

<!-- <script type="text/javascript">

// datepicker (jquery)
$(function() {
  $("#datepicker_enddate_insurance" ).datepicker({ dateFormat: "d M y", })
});

$(document).ready(function () {
    // Function to update date components
    function updateDateComponents(date) {
        // Convert the date to a Date object
        var dateObject = new Date(date);

        // Extract components: day, month, year, and day name
        var day = dateObject.getDate();
        var month = dateObject.toLocaleString("default", { month: "short" });
        var year = dateObject.toLocaleString("default", { year: "2-digit" });
        var dayName = dateObject.toLocaleString("default", { weekday: "long" });

        // Update the UI with the extracted values
        $(".day").text(day);
        $(".month").text(month);
        $(".year").text(year);
        $(".day-name").text(dayName);
    }

    // Function to initialize and apply datepicker based on screen width
    function applyDatepicker() {
        $("#datepicker_enddate_insurance").datepicker("destroy"); // Destroy any existing instance

        // Set default date to 10 days from today
        var defaultDate = new Date();
        defaultDate.setDate(defaultDate.getDate() + 10);

        const options = {
            dateFormat: "D, d M yy", // Includes day name
            defaultDate: defaultDate,
            minDate: 0, // Prevents selecting past dates
            maxDate: "+6M", // Prevents selecting more than 6 months ahead
            onSelect: function (selectedDate) {
                updateDateComponents(selectedDate); // Update UI on date select
            }
        };

        // Adjust the number of months displayed based on screen width
        if (window.innerWidth >= 992) {
            options.numberOfMonths = 2; // Two months side by side
        } else {
            options.numberOfMonths = 1; // Single month
        }

        // Initialize the datepicker with the options
        $("#datepicker_enddate_insurance").datepicker(options);

        // Set the default date and trigger the UI update
        $("#datepicker_enddate_insurance").datepicker("setDate", defaultDate);
        updateDateComponents(defaultDate);
    }

    // Apply the datepicker on page load
    applyDatepicker();

    // Reapply datepicker on window resize
    $(window).on("resize", function () {
        applyDatepicker();
    });
});
</script> -->


<!-- home page js ends -->

@endsection
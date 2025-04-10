// forces the page to scroll to the top (position 0, 0) whenever the user attempts to refresh the page
/*window.onbeforeunload = function () {
    window.scrollTo(0, 0);
}*/
window.onload = function () {
    window.scrollTo(0, 0);
};


/**********************/


// pagetwo.js
// mobile page (filter modal)
document.addEventListener('DOMContentLoaded', () => {

    // mFilter Modal
    const open_mFilterModal = document.getElementById('btn_get_mFilterModal');
    const close_mFilterModal = document.getElementById('btn_close_mFilterModal');
    const m_FilterModal = document.getElementById('mFilterModal');

    // if element exist before attaching event listeners
    if (open_mFilterModal && close_mFilterModal && m_FilterModal) {

        // Function to open the m_FilterModal
        open_mFilterModal.addEventListener('click', () => {
            m_FilterModal.style.display = 'block';
        });

        // Function to close the m_FilterModal
        close_mFilterModal.addEventListener('click', () => {
            m_FilterModal.style.display = 'none';
        });

        // Close the modal if the user clicks outside of it
        window.addEventListener('click', (event) => {
            if (event.target === m_FilterModal) {
                m_FilterModal.style.display = 'none';
            }
        });
    }

    // **************************

    // mModify Search Modal
    // Edit Search
    const open_mSearchModal = document.getElementById('btn_get_mSearchModal');
    const close_mSearchModal = document.getElementById('btn_close_mSearchModal');
    const m_SearchModal = document.getElementById('mSearchModal');

    // if element exist before attaching event listeners
    if (open_mSearchModal && close_mSearchModal && m_SearchModal) {

        // Function to open the m_SearchModal
        open_mSearchModal.addEventListener('click', () => {
            m_SearchModal.style.display = 'block';
        });

        // Function to close the m_SearchModal
        close_mSearchModal.addEventListener('click', () => {
            m_SearchModal.style.display = 'none';
        });

        // Close the m_SearchModal if the user clicks outside of it
        window.addEventListener('click', (event) => {
            if (event.target === m_SearchModal) {
                m_SearchModal.style.display = 'none';
            }
        });
    }


    // **************************

    // City Modal Starts (enable when using starting city in mModifySearchModal)
    // search-inputs-city-modal.js
    /*const getModal_searchInputs_city = document.getElementById('btn_getModal_searchInputs_city');
    const closeModal_searchInputs_city = document.getElementById('btn_closeModal_searchInputs_city');
    const openModal_searchInputs_city = document.getElementById('modal_searchInputs_city');
    
    // if element exist before attaching event listeners
    if (getModal_searchInputs_city && closeModal_searchInputs_city && openModal_searchInputs_city) {

        Function to open the modal
        getModal_searchInputs_city.addEventListener('click', () => {
            openModal_searchInputs_city.style.display = 'block';
        });

        Function to close the modal
        closeModal_searchInputs_city.addEventListener('click', () => {
            openModal_searchInputs_city.style.display = 'none';
        });

        Close the modal if the user clicks outside of it
        window.addEventListener('click', (event) => {
            if (event.target === openModal_searchInputs_city) {
                openModal_searchInputs_city.style.display = 'none';
            }
        });
    }*/

    // **************************

    // mDestination Modal
    // search-inputs-city-modal
    const getModal_searchInputs_destination = document.getElementById('btn_getModal_searchInputs_destination');
    const closeModal_searchInputs_destination = document.getElementById('btn_closeModal_searchInputs_destination');
    const openModal_searchInputs_destination = document.getElementById('modal_searchInputs_destination');

    // if element exist before attaching event listeners
    if (getModal_searchInputs_destination && closeModal_searchInputs_destination && openModal_searchInputs_destination) {

        // Function to open the modal
        getModal_searchInputs_destination.addEventListener('click', () => {
            openModal_searchInputs_destination.style.display = 'block';
        });

        // Function to close the modal
        closeModal_searchInputs_destination.addEventListener('click', () => {
            openModal_searchInputs_destination.style.display = 'none';
        });

        // Close the modal if the user clicks outside of it
        window.addEventListener('click', (event) => {
            if (event.target === openModal_searchInputs_destination) {
                openModal_searchInputs_destination.style.display = 'none';
            }
        });
    }


    // **************************

    // mDate Modal Starts
    // search-inputs-date-modal
    const getModal_searchInputs_date = document.getElementById('btn_getModal_searchInputs_date');
    const closeModal_searchInputs_date = document.getElementById('btn_closeModal_searchInputs_date');
    const openModal_searchInputs_date = document.getElementById('modal_searchInputs_date');

    // if element exist before attaching event listeners
    if (getModal_searchInputs_date && closeModal_searchInputs_date && openModal_searchInputs_date) {

        // Function to open the modal
        getModal_searchInputs_date.addEventListener('click', () => {
            openModal_searchInputs_date.style.display = 'block';

            // Initialize the datepicker when the modal opens
            jQuery( "#mobiledatepicker" ).datepicker({
                dateFormat: "d M y",
            });
        });

        // Function to close the modal
        closeModal_searchInputs_date.addEventListener('click', () => {
            openModal_searchInputs_date.style.display = 'none';
        });

        // Close the modal if the user clicks outside of it
        window.addEventListener('click', (event) => {
            if (event.target === openModal_searchInputs_date) {
                openModal_searchInputs_date.style.display = 'none';
            }
        });
    }

    // **************************

    // mTheme Modal Starts
    // search-inputs-theme-modal
    const getModal_searchInputs_theme = document.getElementById('btn_getModal_searchInputs_theme');
    const closeModal_searchInputs_theme = document.getElementById('btn_closeModal_searchInputs_theme');
    const openModal_searchInputs_theme = document.getElementById('modal_searchInputs_theme');

    // if element exist before attaching event listeners
    if (getModal_searchInputs_theme && closeModal_searchInputs_theme && openModal_searchInputs_theme) {

        // Function to open the modal
        getModal_searchInputs_theme.addEventListener('click', () => {
            openModal_searchInputs_theme.style.display = 'block';
        });

        // Function to close the modal
        closeModal_searchInputs_theme.addEventListener('click', () => {
            openModal_searchInputs_theme.style.display = 'none';
        });

        // Close the modal if the user clicks outside of it
        window.addEventListener('click', (event) => {
            if (event.target === openModal_searchInputs_theme) {
                openModal_searchInputs_theme.style.display = 'none';
            }
        });
    }
});

/**********************/

/*Mobile Tour Image Animation-script*/
// Select all images with class "fade-in"
/*document.addEventListener('DOMContentLoaded', function() {
  const images = document.querySelectorAll('.fade-in');

  // Loop through each image and add event listener to execute when each image is loaded
  images.forEach(function(image) {
    // Check if the image is already loaded
    if (image.complete) {
      image.classList.add('loaded');
    } else {
      image.addEventListener('load', function() {
        // Add the "loaded" class to apply the fade-in transition
        image.classList.add('loaded');
      });
      
      // Optionally, handle error for images that fail to load
      image.addEventListener('error', function() {
        console.error('Failed to load image:', image.src);
      });
    }
  });
});*/

/*Mobile Tour Image Animation-script*/
function handleImageFadeIn() {
  const images = document.querySelectorAll('.fade-in:not(.loaded)');

  images.forEach(function (image) {
    if (image.complete) {
      image.classList.add('loaded');
    } else {
      image.addEventListener('load', function () {
        image.classList.add('loaded');
      });

      image.addEventListener('error', function () {
        // Set fallback image
        console.error('Failed to load image:', image.src);
        //image.src = "{{ url('/frontend/images/default-image.png') }}";
      });
    }
  });
}

// Initial application for images present on page load
document.addEventListener('DOMContentLoaded', handleImageFadeIn);

// Reapply after loading more images
document.addEventListener('scroll', function () {
  clearTimeout(this.scrollTimer);
  this.scrollTimer = setTimeout(function () {
    handleImageFadeIn();
  }, 300);
});


/**********************/

/*// modify search pangel datepicker (desktop)
$(function() {
    $("#datepicker_modify").datepicker({
        // dateFormat: "d M yy", // Use "yy" for a four-digit year, if needed.
        dateFormat: "D, d M yy", // Includes day name
        // changeMonth: true,    // Allows month selection from a dropdown.
        // changeYear: true,     // Allows year selection from a dropdown.
        minDate: 0,           // Prevents selecting dates before today.
        maxDate: "+6M",       // Limits selection to 6 months ahead.
        numberOfMonths: 2, // Show two months simultaneously
        // numberOfMonths: [2, 1], // To display the months vertically
        // stepMonths: 2, // Moves two months at a time when navigating.
        // showButtonPanel: true // Optional: Adds "Today" and "Done" buttons
    });
});

// modify search pangel datepicker (Mobile)
$(function() {
    $("#m_datepicker").datepicker({
        // dateFormat: "d M yy", // Use "yy" for a four-digit year, if needed.
        dateFormat: "D, d M yy", // Includes day name
        // changeMonth: true,    // Allows month selection from a dropdown.
        // changeYear: true,     // Allows year selection from a dropdown.
        minDate: 0,           // Prevents selecting dates before today.
        maxDate: "+6M",       // Limits selection to 6 months ahead.
        numberOfMonths: 2, // Show two months simultaneously
        // numberOfMonths: [2, 1], // To display the months vertically
        // stepMonths: 2, // Moves two months at a time when navigating.
        // showButtonPanel: true // Optional: Adds "Today" and "Done" buttons
    });
});*/

/*------------*/

// modify search panel datepicker (desktop & mobile)
$(document).ready(function() {
    function applyDatepicker() {
        if (window.innerWidth >= 992) {
            // Destroy mobile datepicker if it exists
            if ($("#m_datepicker").data("datepicker")) {
                $("#m_datepicker").datepicker("destroy");
            }

            // Initialize desktop datepicker
            if (!$("#datepicker_modify").data("datepicker")) {
                $("#datepicker_modify").datepicker({
                    // dateFormat: "d M yy", // Use "yy" for a four-digit year, if needed.
                    dateFormat: "D, d M yy", // Includes day name
                    // changeMonth: true,    // Allows month selection from a dropdown.
                    // changeYear: true,     // Allows year selection from a dropdown.
                    minDate: 0,             // Prevents selecting dates before today
                    maxDate: "+12M",        // Limits selection to 6 months ahead
                    numberOfMonths: 2       // Show two months simultaneously
                    // stepMonths: 2, // Moves two months at a time when navigating.
                    // showButtonPanel: true // Optional: Adds "Today" and "Done" buttons
                });
            }
        } else {
            // Destroy desktop datepicker if it exists
            if ($("#datepicker_modify").data("datepicker")) {
                $("#datepicker_modify").datepicker("destroy");
            }

            // Initialize mobile datepicker
            if (!$("#m_datepicker").data("datepicker")) {
                $("#m_datepicker").datepicker({
                    // dateFormat: "d M yy", // Use "yy" for a four-digit year, if needed.
                    dateFormat: "D, d M yy", // Includes day name
                    // changeMonth: true,    // Allows month selection from a dropdown.
                    // changeYear: true,     // Allows year selection from a dropdown.
                    minDate: 0,             // Prevents selecting dates before today
                    maxDate: "+12M",        // Limits selection to 6 months ahead
                    numberOfMonths: [12, 1]  // Display the months vertically
                    // stepMonths: 2, // Moves two months at a time when navigating.
                    // showButtonPanel: true // Optional: Adds "Today" and "Done" buttons
                });
            }
        }
    }

    // Apply datepicker on page load
    applyDatepicker();

    // Reapply datepicker on window resize
    $(window).on("resize", function () {
        applyDatepicker();
    });
});


/**********************/


// modify search panel destination and datepicker focus with required field (desktop)
$(document).ready(function () {
    $('#search3').on('submit', function (event) {
        const $datepicker = $('#datepicker_modify');
        const $destination = $('#destination_search');

        // Check for travel date
        if (!$datepicker.val().trim()) {
            //alert('Please select a travel date.');
            $datepicker.focus(); // Focus to trigger the calendar popup
            event.preventDefault();
            return;
        }

        // Check for destination
        if (!$destination.val().trim()) {
            //alert('Please select a destination.');
            $destination.focus(); // Focus on the destination field
            event.preventDefault();
        }
    });
});


/**********************/


$(document).ready(function() {
    function mobile_destination_search() {
        var mobile_destination_search=jQuery(".mobile_destination_search").val()
        $.ajax( {
            url: jQuery("#APP_URL").val()+'/mobile_destination_search',
            data:{mobile_destination_search:mobile_destination_search},
            type:'get',
            // contentType: false,
            // processData: false,
            success:function(data) {
                jQuery(".des_data").html('').html(data)
            },
            error:function(data) {
            }
        });
    }

    jQuery(".mobile_destination_search").keyup(function() {
        mobile_destination_search()
     });

    // mobile_destination_search()
    jQuery(document).on("click",".des_data .item-name",function() {
        var item_name=jQuery(this).attr('des_value')
        jQuery("#destination_search_mobile").val('').val(item_name)
        const openModal_searchInputs_destination = document.getElementById('modal_searchInputs_destination');
        openModal_searchInputs_destination.style.display = 'none';
        const m_SearchModal = document.getElementById('mSearchModal');
        m_SearchModal.style.display = 'block';

        var data_value=item_name;
        $("#traveltheme").val("");
        var APP_URL=$("#APP_URL").val();
        var url=APP_URL+'/search_theme_mobile';
        var data={search_theme:data_value,_token:"{{ csrf_token() }}"};
        $.get(url,data,function(rdata) {
            // console.log(rdata)
            jQuery(".theme_data").html('').html(rdata)
        });
    });

 
    jQuery(document).on("click",".date_apply",function() {  
        var select_date=jQuery("#mobiledatepicker").val()
        jQuery("#date_mobile").val('').val(select_date)
        const openModal_searchInputs_date = document.getElementById('modal_searchInputs_date');

        openModal_searchInputs_date.style.display = 'none';
        const m_SearchModal = document.getElementById('mSearchModal');
        m_SearchModal.style.display = 'block';
    });

    jQuery(document).on("click",".theme_data .item-name",function() {
        var item_name=jQuery(this).attr('theme_value')
        jQuery("#traveltheme_mobile").val('').val(item_name)
        const openModal_searchInputs_destination = document.getElementById('modal_searchInputs_theme');
        openModal_searchInputs_destination.style.display = 'none';
        const m_SearchModal = document.getElementById('mSearchModal');
        m_SearchModal.style.display = 'block';
    });

    mobile_destination_search()

    // added through destination-search.js in pagetwo.blade (can remove this)
    jQuery('.select2').select2();

    //
    jQuery('.select3').select2({
        placeholder: "To",
        allowClear: true,
        ajax:{
            url: jQuery("#APP_URL").val()+'/search-destination',
            type: "get",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    searchTerm: params.term //search term
                };
            },
            processResults: function (response) {
                return {
                    results: response
                };
            },
            cache: true
            },
            templateSelection: formatSelection,
    });

    // Function to format the selected option
    function formatSelection(selection) {
        if (!selection.id) {
            return selection.text;
        }

        return $('<span>' + selection.id + '</span>');
    }    
    
    jQuery(document).on('change.select2','.package_service', function(e) {
        var data_value=jQuery(this).val();
        $("#destination_search").val(data_value);
        $("#response").html("");
        var APP_URL=$("#APP_URL").val();
        var url=APP_URL+'/search_theme';
        var data={search_theme:data_value,_token:"{{ csrf_token() }}"};
        $.get(url,data,function(rdata) {
            console.log(rdata)
            $("#select_theme").html(rdata);
            })
    });
});

$(document).ready(function() {
    //Desktop & Mobile View
    if($(window).width()>=992) {
        $(".mobile_test_exp").each(function( index ) {
            $(this).remove()
        });
    }
    else {
        $(".destop_test_exp").each(function( index ) {
            $(this).remove()
        });
    }

    //Old Modify button for search panel
    /*$("#modify").show();
    $("#modify_search").click(function(){
        $("#modify").toggle();
    });*/

    //
    $(".mobile_filter").click(function() {
        $(".sorting_content").toggle();
    });
});

$(document).ready(function () {
    // Close the dropdown menu if the user clicks outside of it
    $(window).on("click", function (event) {
        // Define all dropdown button class names and their corresponding dropdowns
        const dropdownMappings = {
            '.dropbtn1': 'dropdown1', // covered places
            '.dropbtn2': 'dropdown2', // price range
            '.dropbtn3': 'dropdown3', // duration
            '.dropbtn4': 'dropdown4', // travel type
            '.dropbtn5': 'dropdown5', // theme
            '.dropbtn6': 'dropdown6', // service included
            '.dropbtn7': 'dropdown7', // suitable for
            '.dropbtn8': 'dropdown8', // general tags
            '.dropbtn9': 'dropdown9', // star rating
        };

        // Iterate over each mapping
        $.each(dropdownMappings, function (buttonClass, dropdownClass) {
            if (!$(event.target).is(buttonClass)) {
                $(`.${dropdownClass}`).removeClass('show');
            }
        });
    });
});


/**********************/


// Event Delegation for Dropdown Actions
function bindDropdownEvents() {
    // Handle sort filter change
    $(".sort_filter, #sort_filter").on("change", drop_function);

    // Stop event propagation for dropdown items
    $(document).on("click", ".dropdown-content .drop", function (e) {
        e.stopPropagation();
    });

    // Apply filter action
    $(document).on("click", ".btnFilterApply", drop_function);

    // Handle checkbox changes
    $(document).on("change", ".dropCheckBox", function (e) {
        e.stopPropagation();
        drop_function();
    });

    // Conditional handling for window width
    if ($(window).width() >= 992) {
        $(document).on("click", ".dropdown-content .drop", function (e) {
            e.stopPropagation();
            drop_function();
        });
    } else {
        $(document).on("click", ".mobile_apply", function (e) {
            e.stopPropagation();
            drop_function();
        });
    }
}

// Initialize Dropdown Events on Document Ready
$(document).ready(function () {
    bindDropdownEvents();
});


/**********************/


// Utility Function: Collect filter data
function collectFilterData() {
    return {
        destination: $("#destination").val(),
        places: getCheckedValues("chk_value"),
        duration: getCheckedValues("duration"),
        travel_type: getCheckedValues("chk_travel"),
        theme_type: getCheckedValues("chk_more"),
        guest_rating: getCheckedValues("chk_gest"),
        services_includes: getCheckedValues("services_includes"),
        sut_for: getCheckedValues("sut_for"),
        gen_tags: getCheckedValues("gen_tags"),
        search_date: $("#search_date").val(),
        sort_filter: $("#sort_filter").val(),
        min_price: $(".min-price-label").html(),
        max_price: $(".max-price-label").html(),
        packages_id: $("input[name='pack_id_list[]']").map(function () {
            return $(this).val();
        }).get(),
        window_width: $(window).width(),
        limit: "3",
        event_type: "0",
        _token: "{{ csrf_token() }}"
    };
}

// Core Functionality: Fetch and Update Filtered Data
function drop_function() {
    // Reset filters
    $("#refine_search").html("<a href='' id='reset' style=''>Clear filter</a>");
    $("#refine_mobsearch").html("<a href='' id='mobreset'><button type='button' class='btnFilterReset'>Reset</button></a>");

    // Prepare data for the request
    const data = collectFilterData();
    const ROOT_URL = $("#ROOT_URL").val();
    const LOAD_MORE_ITEM_URL = $("#LOAD_MORE_ITEM_URL").val();
    const img_href = `${ROOT_URL}/public/uploads/loder.gif`;

    // Display loading animation
    $(".dynamic_data").html("").append(`<div class='loaderCont'><span>Loading packages... <img src='${img_href}'></span></div>`);
    document.getElementById("overlay").style.display = "none";

    // Send AJAX request
    $.get(LOAD_MORE_ITEM_URL, data, function (rdata) {
        $(".dynamic_data").html(rdata);
        document.getElementById("overlay").style.display = "none";
    });
}

/*// Core Functionality: Fetch and Update Filtered Data
function drop_function() {
    // Reset filters (if you want to show reset link before applying filters)
    $("#refine_search").html("<a href='' id='reset' style=''>Clear filter</a>");
    $("#refine_mobsearch").html("<a href='' id='mobreset' style='color: #008cff;'>Reset</a>");

    // Prepare data for the request
    const data = collectFilterData();
    const ROOT_URL = $("#ROOT_URL").val();
    const LOAD_MORE_ITEM_URL = $("#LOAD_MORE_ITEM_URL").val();
    const img_href = `${ROOT_URL}/public/uploads/loder.gif`;

    // Display loading animation
    $(".dynamic_data").html("").append(`<div class='loaderCont'><span>Loading packages... <img src='${img_href}'></span></div>`);
    document.getElementById("overlay").style.display = "none";

    // Send AJAX request
    $.get(LOAD_MORE_ITEM_URL, data, function (rdata) {
        $(".dynamic_data").html(rdata);
        document.getElementById("overlay").style.display = "none";

        // Check if Reset button already exists before appending
        if ($("#refine_mobsearch").length === 0) {
            $(".mFilter_Footer div").append('<button type="button" class="btnFilterReset" id="refine_mobsearch" style="color: #008cff;">Reset</button>');
        }
    });
}

// Reset functionality for filters
$(document).on("click", "#refine_mobsearch", function() {
    // Reset the filters to their initial state
    resetFilters();

    // Remove the Reset button after reset
    $("#refine_mobsearch").remove();

    // Optionally, re-enable and reset the "Apply" button if needed
    $(".btnFilterApply").text('Apply').prop('disabled', false);

    // Optionally, you can trigger the drop_function to re-fetch the data with default values
    drop_function(); // Re-run the filter function to re-apply default filters and fetch data
});

// Function to reset filters to default
function resetFilters() {
    // Implement your logic to reset form fields or filters
    console.log("Filters have been reset.");

    // Example: You can reset specific form inputs here
    $("input[type='checkbox'], input[type='radio']").prop('checked', false);
    $("select").val('');  // Reset all select options if needed
}*/



// Utility Function: Get Checked Values
function getCheckedValues(name) {
    return $(`input[name="${name}"]:checked`).map(function () {
        return $(this).val();
    }).get();
}


/**********************/


// General function to toggle dropdown visibility
function toggleDropdown(dropdownId) {
    document.getElementById(dropdownId).classList.toggle("show");
}

// each dropdown function
function coverd_places() {
    toggleDropdown("coverd_places");
}

function travel_type() {
    toggleDropdown("travel_type");
}

function theme() {
    toggleDropdown("theme");
}

function guest_rate() {
    toggleDropdown("guest_rate");
}

function duration() {
    toggleDropdown("duration");
}

function price() {
    toggleDropdown("price");
}

function service_included() {
    toggleDropdown("service_included");
}

function sutible_for() {
    toggleDropdown("sutible_for");
}

function general_tags() {
    toggleDropdown("general_tags");
}


/**********************/


// Function to update the URL path to lowercase (it is working, but check to convert in lowercase, before apply)
function convertUrlToLowercase() {
    var currentUrl = window.location.href; // Get the current URL
    var newUrl = currentUrl.toLowerCase(); // Convert it to lowercase

    // If the current URL is different from the lowercase version, update it
    if (currentUrl !== newUrl) {
        window.history.replaceState(null, null, newUrl); // Replace the URL in the browser's address bar without reloading the page
    }
}

// Run the function when the page loads
window.onload = function() {
    convertUrlToLowercase();
};


var slug = function(str) {
    str = str.replace(/^\s+|\s+$/g, ''); // trim
    str = str.toLowerCase();  // convert to lowercase
    // console.log('After lowercasing:', str); // Log after lowercase conversion

    // remove accents, swap ñ for n, etc
    var from = "ãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;";
    var to   = "aaaaaeeeeeiiiiooooouuuunc------";
    for (var i=0, l=from.length ; i<l ; i++) {
        str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
    }
    // console.log('After removing accents:', str); // Log after accent removal

    str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
             .replace(/\s+/g, '-') // collapse whitespace and replace by -
             .replace(/-+/g, '-'); // collapse dashes

    // console.log('Final slug:', str); // Log final slug
    return str;
};


//---------------------------

/*function convertUrlToLowercase() {
    var currentUrl = window.location.href; 
    var urlObj = new URL(currentUrl);

    // Convert only the pathname to lowercase
    var newPath = urlObj.pathname.toLowerCase() + urlObj.search + urlObj.hash;
    var newUrl = urlObj.origin + newPath;

    // Only update if different
    if (currentUrl !== newUrl) {
        window.history.replaceState(null, null, newUrl);
    }
}

// Run when the page loads
window.onload = function() {
    convertUrlToLowercase();
};


var slug = function(str) {
    str = str.trim().toLowerCase(); // Trim and convert to lowercase

    // Remove accents using normalize()
    str = str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");

    // Replace special characters and collapse whitespace/dashes
    str = str.replace(/ñ/g, 'n')  // Replace ñ
             .replace(/ç/g, 'c')  // Replace ç
             .replace(/[^a-z0-9 -]/g, '') // Remove invalid characters
             .replace(/\s+/g, '-') // Replace spaces with dashes
             .replace(/-+/g, '-'); // Remove multiple dashes

    return str;
};*/


/**********************/

// destination search (Desktop)
$("#search3").submit(function(event) {
    var destination_search = slug($("#destination_search").val());
    var select_theme = slug($("#select_theme").val());

    // console.log('Destination Search (slugged):', destination_search); // Log slugged destination
    // console.log('Select Theme (slugged):', select_theme); // Log slugged theme

    // Check if both fields are empty
    // if (!destination_search || (!select_theme && !$("#select_theme").val())) {
    //     alert("Please fill out the required fields.");
    //     event.preventDefault(); // Prevent form submission if validation fails
    //     return;
    // }

    var ROOT_URL = $("#ROOT_URL").val();

    if (destination_search && !select_theme) {
        document.search3.action = ROOT_URL + '/holidays' + "/" + destination_search + '-tour-packages';
        // window.location.href = ROOT_URL + '/holidays' + "/" + destination_search + '-tour-packages';
    } else {
        document.search3.action = ROOT_URL + '/holidays' + "/" + destination_search + "/theme" + "/" + select_theme;
        // window.location.href = ROOT_URL + '/Holidays' + "/" + destination_search + "/theme" + "/" + select_theme;
    }
});

// destination search (mobile)
$(document).on("submit","#search4",function() {
    var destination_search=slug($("#destination_search_mobile").val());
    var select_theme=slug($("#traveltheme_mobile").val());

    var ROOT_URL = $("#ROOT_URL").val();

    // if(destination_search!="" && select_theme=="") {
    if (destination_search && !select_theme) {
        //$(APP_URL).attr('href', ''+destination_search)
        document.search4.action = ROOT_URL + '/holidays' + "/" + destination_search + '-tour-packages';
        // window.location.href = ROOT_URL + '/holidays' + "/" + destination_search + '-tour-packages';
    } else {
        //$(location).attr('href', 'Packages/'+destination_search+'/Theme/'+select_theme)
        document.search4.action = ROOT_URL + '/holidays' + "/" + destination_search + "/theme" + "/" + select_theme;
        // window.location.href = ROOT_URL + '/holidays' + "/" + destination_search + "/theme" + "/" + select_theme;
    }
});


/**********************/




// dropdown color
/*$(document).ready(function() {
    $(".dropdown").click(function() {
        $(".caret").css({"color": "#333"})
        $(this).children().first().children().css({"color": "#b51319"});
    });
});*/


/**********************/


// can also be fetched using search-destination.js
// holiday destination search box and theme selection
/*$(document).ready(function() {
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
        }
    });
    // Ensure the placeholder appears in the search input of the dropdown
    jQuery('.select3').on('select2:open', function () {
        var searchField = jQuery('.select2-search__field');
        if (searchField.val() === '') {
            searchField.attr('placeholder', 'Select or enter city name');
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
        $.post(SEARCH_THEME_URL, data, function (rdata) {
            $("#select_theme").html(rdata); // Update the theme select dropdown with the response
        });
    });
});*/


// ****************


// load data (item) on scroll (working)
/*$(document).scroll(function () {
    // const APP_URL = $("#testvalue").val(); // OLD URL
    // const loader_src = `${APP_URL}/public/uploads/loder.gif`;
    const LOAD_MORE_ITEM_URL = $("#LOAD_MORE_ITEM_URL").val(); // Fetch the route URL
    const loader_src = `${LOAD_MORE_ITEM_URL}/../public/uploads/loder.gif`; // Adjusted loader path

    clearTimeout($.data(this, "scrollCheck"));

    $.data(this, "scrollCheck", setTimeout(function () {
        const isFooterVisible = $(window).scrollTop() + $(window).height() >= $('footer').offset().top;

        if (isFooterVisible) {
            $(".loader_scroll").html("<span>Loading more packages... <img src='" + loader_src + "'></span>");

            const getCheckedValues = (selector) => $(selector).map(function () { return $(this).val(); }).get();

            const data = {
                window_width: $(window).width(),
                event_type: "1",
                limit: "3",
                packages_id: $("input[name='pack_id_list[]']").map(function () { return $(this).val(); }).get(),
                destination: $("#destination").val(),
                places: getCheckedValues('input[name="chk_value"]:checked'),
                duration: getCheckedValues('input[name="duration"]:checked'),
                travel_type: getCheckedValues('input[name="chk_travel"]:checked'),
                theme_type: getCheckedValues('input[name="chk_more"]:checked'),
                guest_rating: getCheckedValues('input[name="chk_gest"]:checked'),
                services_includes: getCheckedValues('input[name="services_includes"]:checked'),
                sut_for: getCheckedValues('input[name="sut_for"]:checked'),
                gen_tags: getCheckedValues('input[name="gen_tags"]:checked'),
                search_date: $("#datepicker_modify").val(),
                sort_filter: $("#sort_filter").val(),
                min_price: $(".min-price-label").html(),
                max_price: $(".max-price-label").html(),
                _token: $('meta[name="csrf-token"]').attr('content'),
            };
            $.get(LOAD_MORE_ITEM_URL, data, function (rdata) {
                if (rdata === "<br>") {
                    // Display the message when no more data is available
                    $(".loader_scroll").html("<p>That's all the options that we have</p>");
                } else if (rdata) {
                    // Append data if available
                    $(".dynamic_data").append(rdata);
                    $(".loader_scroll").html(""); // Clear loader only after appending data
                    // $(".dynamic_data").append(rdata);
                } else {
                    // If there's an unexpected empty response
                    $(".loader_scroll").html("<p>Unexpected error occurred, try again later</p>");
                }
            }).fail(function (jqXHR, textStatus, errorThrown) {
                console.error("Error loading data:", textStatus, errorThrown);
                $(".loader_scroll").html("<p>Change the filter criteria and try again</p>");
            });
        }
    }, 750)); // timeout delay in milliseconds (0.75 seconds)
});*/

//------------

// refined above code (working with ajax)
$(document).ready(function () {
    let isLoading = false; // Prevents multiple AJAX requests
    const LOAD_MORE_ITEM_URL = $("#LOAD_MORE_ITEM_URL").val(); // Fetch route URL
    const loader_src = `${LOAD_MORE_ITEM_URL}/../public/uploads/loder.gif`; // Adjusted loader path

    $(document).scroll(function () {
        // Throttle event to avoid excessive AJAX requests
        clearTimeout($.data(this, "scrollCheck"));

        $.data(this, "scrollCheck", setTimeout(function () {
            const isFooterVisible = $(window).scrollTop() + $(window).height() >= $("footer").offset().top;

            if (isFooterVisible && !isLoading) {
                isLoading = true; // Prevent multiple calls while loading

                $(".loader_scroll").html(`<span>Loading more packages... <img src="${loader_src}"></span>`);

                const getCheckedValues = (selector) =>
                    $(selector)
                        .map((_, el) => $(el).val())
                        .get();

                const data = {
                    window_width: $(window).width(),
                    event_type: "1",
                    limit: "3",
                    packages_id: $("input[name='pack_id_list[]']")
                        .map((_, el) => $(el).val())
                        .get(),
                    destination: $("#destination").val(),
                    places: getCheckedValues('input[name="chk_value"]:checked'),
                    duration: getCheckedValues('input[name="duration"]:checked'),
                    travel_type: getCheckedValues('input[name="chk_travel"]:checked'),
                    theme_type: getCheckedValues('input[name="chk_more"]:checked'),
                    guest_rating: getCheckedValues('input[name="chk_gest"]:checked'),
                    services_includes: getCheckedValues('input[name="services_includes"]:checked'),
                    sut_for: getCheckedValues('input[name="sut_for"]:checked'),
                    gen_tags: getCheckedValues('input[name="gen_tags"]:checked'),
                    search_date: $("#datepicker_modify").val(),
                    sort_filter: $("#sort_filter").val(),
                    min_price: $(".min-price-label").text().trim(),
                    max_price: $(".max-price-label").text().trim(),
                    _token: $('meta[name="csrf-token"]').attr("content"),
                };

                $.ajax({
                    url: LOAD_MORE_ITEM_URL,
                    type: "GET",
                    data: data,
                    dataType: "html",
                    success: function (response) {
                        if (response.trim() === "<br>") {
                            $(".loader_scroll").html("<p>That's all the options that we have</p>");
                        } else if (response) {
                            $(".dynamic_data").append(response);
                            $(".loader_scroll").html(""); // Clear loader after appending
                        } else {
                            $(".loader_scroll").html("<p>Unexpected error occurred, try again later</p>");
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error("Error loading data:", textStatus, errorThrown);
                        $(".loader_scroll").html("<p>Change the filter criteria and try again</p>");
                    },
                    complete: function () {
                        isLoading = false; // Reset flag after request completes
                    },
                });
            }
        }, 750)); // Timeout delay for scroll event throttling
    });
});

//------------

// load data (item) on scroll - optimized (tried to optimize with function mid_package_data in Frontcontroller, but not working ----to check)
/*$(document).ready(function () {
    let isLoading = false; // Prevent multiple AJAX requests
    const LOAD_MORE_ITEM_URL = $("#LOAD_MORE_ITEM_URL").val(); // Fetch route URL
    const loader_src = `${LOAD_MORE_ITEM_URL}/../public/uploads/loder.gif`; // Adjusted loader path

    $(document).scroll(function () {
        clearTimeout($.data(this, "scrollCheck")); // Throttle scrolling event

        $.data(this, "scrollCheck", setTimeout(function () {
            const isFooterVisible = $(window).scrollTop() + $(window).height() >= $("footer").offset().top;

            if (isFooterVisible && !isLoading) {
                isLoading = true; // Prevent multiple calls while loading
                $(".loader_scroll").html(`<span>Loading more packages... <img src="${loader_src}"></span>`);

                const getCheckedValues = (selector) =>
                    $(selector)
                        .map((_, el) => $(el).val())
                        .get();

                const data = {
                    window_width: $(window).width(),
                    event_type: "1",
                    limit: "4", // Ensure correct limit
                    packages_id: $("input[name='pack_id_list[]']")
                        .map((_, el) => $(el).val())
                        .get(),
                    destination: $("#destination").val(),
                    places: getCheckedValues('input[name="chk_value"]:checked'),
                    duration: getCheckedValues('input[name="duration"]:checked'),
                    travel_type: getCheckedValues('input[name="chk_travel"]:checked'),
                    theme_type: getCheckedValues('input[name="chk_more"]:checked'),
                    guest_rating: getCheckedValues('input[name="chk_gest"]:checked'),
                    services_includes: getCheckedValues('input[name="services_includes"]:checked'),
                    sut_for: getCheckedValues('input[name="sut_for"]:checked'),
                    gen_tags: getCheckedValues('input[name="gen_tags"]:checked'),
                    search_date: $("#datepicker_modify").val(),
                    sort_filter: $("#sort_filter").val(),
                    min_price: $(".min-price-label").text().trim(),
                    max_price: $(".max-price-label").text().trim(),
                    _token: $('meta[name="csrf-token"]').attr("content"),
                };

                $.ajax({
                    url: LOAD_MORE_ITEM_URL,
                    type: "GET",
                    data: data,
                    dataType: "json", // Expecting JSON response
                    success: function (response) {
                        if (response.no_more_data) {
                            $(".loader_scroll").html("<p>That's all the options that we have</p>");
                            $(window).off("scroll"); // Disable further scroll loading
                        } else if (response.html) {
                            $(".dynamic_data").append(response.html);
                            $(".loader_scroll").html(""); // Clear loader only after appending data
                        } else {
                            $(".loader_scroll").html("<p>Unexpected error occurred, try again later</p>");
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error("Error loading data:", textStatus, errorThrown);
                        $(".loader_scroll").html("<p>Change the filter criteria and try again</p>");
                    },
                    complete: function () {
                        isLoading = false; // Reset flag after request completes
                    },
                });
            }
        }, 750)); // Timeout delay for scroll event throttling
    });
});*/

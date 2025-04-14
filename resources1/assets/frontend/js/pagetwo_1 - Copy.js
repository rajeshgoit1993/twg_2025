/*Mobile Tour Image Animation-script*/
// Select all images with class "fade-in"
document.addEventListener('DOMContentLoaded', function() {
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
});

// ********************

// search pangel datepicker
/*$(function() {
	$( "#datepicker" ).datepicker({
		dateFormat: "d M y",
	});
});*/

// modify search pangel datepicker (desktop)
$(function() {
    $("#datepicker").datepicker({
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

// ********************

// jQuery(function() {
//     jQuery("body").delegate("#mobiledatepicker", "focusin", function(){
//     	alert('dd')
//         jQuery(this).datepicker();
//     });
// });

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

	mobile_destination_search()

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


	// mobile_destination_search()

	// added through destination-search.js in pagetwo.blade (can remove this)
	/*jQuery('.select2').select2();

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
	});*/
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
	$("#modify").show();
	$("#modify_search").click(function(){
		$("#modify").toggle();
		})

	//
	$(".mobile_filter").click(function() {
		$(".sorting_content").toggle();
		})
});

// Close the dropdown menu if the user clicks outside of it (old - working)
/*window.onclick = function(event) {
	if (!event.target.matches('.dropbtn1')) {
		var dropdowns = document.getElementsByClassName("dropdown1");
		var i;
		for (i = 0; i < dropdowns.length; i++) {
			var openDropdown = dropdowns[i];
			if (openDropdown.classList.contains('show')) {
				openDropdown.classList.remove('show');
				}
			}
	}
	if (!event.target.matches('.dropbtn2')) {
		var dropdowns = document.getElementsByClassName("dropdown2");
		var i;
		for (i = 0; i < dropdowns.length; i++) {
			var openDropdown = dropdowns[i];
			if (openDropdown.classList.contains('show')) {
				openDropdown.classList.remove('show');
				}
			}
	}
	if (!event.target.matches('.dropbtn3')) {
		var dropdowns = document.getElementsByClassName("dropdown3");
		var i;
		for (i = 0; i < dropdowns.length; i++) {
			var openDropdown = dropdowns[i];
			if (openDropdown.classList.contains('show')) {
				openDropdown.classList.remove('show');
				}
			}
	}
	if (!event.target.matches('.dropbtn4')) {
		var dropdowns = document.getElementsByClassName("dropdown4");
		var i;
		for (i = 0; i < dropdowns.length; i++) {
			var openDropdown = dropdowns[i];
			if (openDropdown.classList.contains('show')) {
				openDropdown.classList.remove('show');
				}
			}
	}
	if (!event.target.matches('.dropbtn5')) {
		var dropdowns = document.getElementsByClassName("dropdown5");
		var i;
		for (i = 0; i < dropdowns.length; i++) {
			var openDropdown = dropdowns[i];
			if (openDropdown.classList.contains('show')) {
				openDropdown.classList.remove('show');
				}
			}
	}
	if (!event.target.matches('.dropbtn6')) {
		var dropdowns = document.getElementsByClassName("dropdown6");
		var i;
		for (i = 0; i < dropdowns.length; i++) {
			var openDropdown = dropdowns[i];
			if (openDropdown.classList.contains('show')) {
				openDropdown.classList.remove('show');
				}
			}
	}
	//
	if (!event.target.matches('.dropbtn_1')) {
		var dropdowns = document.getElementsByClassName("dropdown_1");
		var i;
		for (i = 0; i < dropdowns.length; i++) {
			var openDropdown = dropdowns[i];
			if (openDropdown.classList.contains('show')) {
				openDropdown.classList.remove('show');
				}
			}
	}
	//
	if (!event.target.matches('.dropbtn_2')) {
		var dropdowns = document.getElementsByClassName("dropdown_2");
		var i;
		for (i = 0; i < dropdowns.length; i++) {
			var openDropdown = dropdowns[i];
			if (openDropdown.classList.contains('show')) {
				openDropdown.classList.remove('show');
				}
			}
	}
	//
	if (!event.target.matches('.dropbtn_3')) {
		var dropdowns = document.getElementsByClassName("dropdown_3");
		var i;
		for (i = 0; i < dropdowns.length; i++) {
			var openDropdown = dropdowns[i];
			if (openDropdown.classList.contains('show')) {
				openDropdown.classList.remove('show');
				}
			}
	}
}*/

$(document).ready(function () {
    // Close the dropdown menu if the user clicks outside of it
    $(window).on("click", function (event) {
        // Define all dropdown button class names and their corresponding dropdowns
        const dropdownMappings = {
            '.dropbtn1': 'dropdown1',
            '.dropbtn2': 'dropdown2',
            '.dropbtn3': 'dropdown3',
            '.dropbtn4': 'dropdown4',
            '.dropbtn5': 'dropdown5',
            '.dropbtn6': 'dropdown6',
            '.dropbtn_1': 'dropdown_1',
            '.dropbtn_2': 'dropdown_2',
            '.dropbtn_3': 'dropdown_3',
        };

        // Iterate over each mapping
        $.each(dropdownMappings, function (buttonClass, dropdownClass) {
            if (!$(event.target).is(buttonClass)) {
                $(`.${dropdownClass}`).removeClass('show');
            }
        });
    });
});

// ****************

/*//chk_value
$(".sort_filter").change(function() {
	return drop_function();
});

$("#sort_filter").change(function() {
	return drop_function();
});

//
$(document).on('click', '.dropdown-content .drop ', function(e) {
	e.stopPropagation();
});

$(document).on('click', '.btnFilterApply', function() {
	return drop_function();
});

$(document).on('change', '.dropCheckBox', function(e) {
	e.stopPropagation();
	return drop_function();
});

if($(window).width()>=992) {
	$(document).on('click', '.dropdown-content .drop ', function(e) {
		e.stopPropagation();
		return drop_function();
	});
} else {
	$(document).on("click",".mobile_apply",function(e) {
		e.stopPropagation();
		return drop_function();
	});
}

$(document).on('click', '.dropdown-content .drop', function (e) {
    e.stopPropagation();
    if ($(window).width() < 992 && $(this).hasClass('mobile_apply')) {
        return drop_function();
    }
});


function drop_function() {
	$("#refine_search").html("").html("<a href='' id='reset' style=''>Clear filter</a>")
	$("#refine_mobsearch").html("").html("<a href='' id='mobreset' style='color: #008cff;'>Reset</a>")
	var destination=$("#destination").val();
	var places=[];
	$('input[name="chk_value"]:checked').each(function() {
		places.push($(this).val());
		});
	var duration=new Array();
	$('input[name="duration"]:checked').each(function() {
		duration.push($(this).val());
		});
	var travel_type=new Array();
	$('input[name="chk_travel"]:checked').each(function() {
		travel_type.push($(this).val());
		});
	var theme_type=new Array();
	$('input[name="chk_more"]:checked').each(function() {
		theme_type.push($(this).val());
		});
	var guest_rating=new Array();
	$('input[name="chk_gest"]:checked').each(function() {
		guest_rating.push($(this).val());
		});
	//
	var services_includes=new Array();
	$('input[name="services_includes"]:checked').each(function() {
		services_includes.push($(this).val());
		});
	//
	var sut_for=new Array();
	$('input[name="sut_for"]:checked').each(function() {
		sut_for.push($(this).val());
		});
	//
	var gen_tags=new Array();
	$('input[name="gen_tags"]:checked').each(function() {
		gen_tags.push($(this).val());
		});
	//
	var search_date=$("#search_date").val()

	//Filter
	var window_width= $(window).width();
	var sort_filter=$("#sort_filter").val()
	var min_price=$(".min-price-label").html();
	var max_price=$(".max-price-label").html();
	var APP_URL=$("#testvalue").val();
	var url=APP_URL+'/mid_package_data';
	var packages_id =$("input[name='pack_id_list[]']")
	.map(function(){return $(this).val();}).get();
	var limit="3";
	var event_type="0";
	var img_href=APP_URL+'/public/uploads/loder.gif';
	$(".dynamic_data").html("").append("<div class='loaderCont'><span>Loading packages... <img style='' src='"+img_href+"'>")

	document.getElementById("overlay").style.display = "none";
	var data={window_width:window_width,event_type:event_type,limit:limit,packages_id:packages_id,destination:destination, places:places,duration:duration,travel_type:travel_type,theme_type:theme_type,guest_rating:guest_rating,min_price:min_price,max_price:max_price,services_includes:services_includes,sut_for:sut_for,gen_tags:gen_tags,search_date:search_date,sort_filter:sort_filter,_token:"{{ csrf_token() }}"};
	$.get(url,data,function(rdata) {
		$(".dynamic_data").html("").html(rdata)
		document.getElementById("overlay").style.display = "none";
		//console.log(rdata)
		//alert(places)
		//$("#select_theme").html(rdata);
		})
};*/

/*function drop_function() {
    $("#refine_search").html("<a href='' id='reset'>Clear filter</a>");
    $("#refine_mobsearch").html("<a href='' id='mobreset' style='color: #008cff;'>Reset</a>");
    
    const data = {
        window_width: $(window).width(),
        event_type: "0",
        limit: "3",
        packages_id: $("input[name='pack_id_list[]']").map(function () { return $(this).val(); }).get(),
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
        _token: "{{ csrf_token() }}",
    };

    const APP_URL = $("#testvalue").val();
    const url = `${APP_URL}/mid_package_data`;
    const loaderImg = `${APP_URL}/public/uploads/loder.gif`;

    $(".dynamic_data").html(`<div class='loaderCont'><span>Loading packages... <img src='${loaderImg}'></span></div>`);
    document.getElementById("overlay").style.display = "none";

    $.get(url, data, function (response) {
        $(".dynamic_data").html(response);
        document.getElementById("overlay").style.display = "none";
    });
}*/

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

// ****************

// Core Functionality: Fetch and Update Filtered Data
// function drop_function() {
//     // Reset filters
//     $("#refine_search").html("<a href='' id='reset' style=''>Clear filter</a>");
//     $("#refine_mobsearch").html("<a href='' id='mobreset' style='color: #008cff;'>Reset</a>");

//     // Gather filter values
//     const destination = $("#destination").val();
//     const places = getCheckedValues("chk_value");
//     const duration = getCheckedValues("duration");
//     const travel_type = getCheckedValues("chk_travel");
//     const theme_type = getCheckedValues("chk_more");
//     const guest_rating = getCheckedValues("chk_gest");
//     const services_includes = getCheckedValues("services_includes");
//     const sut_for = getCheckedValues("sut_for");
//     const gen_tags = getCheckedValues("gen_tags");
//     const search_date = $("#search_date").val();

//     // Additional filter options
//     const window_width = $(window).width();
//     const sort_filter = $("#sort_filter").val();
//     const min_price = $(".min-price-label").html();
//     const max_price = $(".max-price-label").html();
//     const ROOT_URL = $("#ROOT_URL").val();
//     /*const url = `${APP_URL}/mid_package_data`;*/
//     const LOAD_MORE_ITEM_URL = $("#LOAD_MORE_ITEM_URL").val();  // Fetch the route URL
//     const packages_id = $("input[name='pack_id_list[]']").map(function () {
//         return $(this).val();
//     }).get();
//     const limit = "3";
//     const event_type = "0";
//     const img_href = `${ROOT_URL}/public/uploads/loder.gif`;

//     // Display loading animation
//     $(".dynamic_data").html("").append(`<div class='loaderCont'><span>Loading packages... <img src='${img_href}'></span></div>`);
//     document.getElementById("overlay").style.display = "none";

//     // Prepare data for the request
//     const data = {
//         window_width,
//         event_type,
//         limit,
//         packages_id,
//         destination,
//         places,
//         duration,
//         travel_type,
//         theme_type,
//         guest_rating,
//         min_price,
//         max_price,
//         services_includes,
//         sut_for,
//         gen_tags,
//         search_date,
//         sort_filter,
//         _token: "{{ csrf_token() }}",
//     };

//     // Send AJAX request
//     /*$.get(url, data, function (rdata) {*/
//     $.get(LOAD_MORE_ITEM_URL, data, function (rdata) {
//         $(".dynamic_data").html(rdata);
//         document.getElementById("overlay").style.display = "none";
//     });
// }

// ----------------

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
    });
}


// Utility Function: Get Checked Values
function getCheckedValues(name) {
    return $(`input[name="${name}"]:checked`).map(function () {
        return $(this).val();
    }).get();
}

// ****************

/* When the user clicks on the button,toggle between hiding and showing the dropdown content */
// function myFunction() {
// 	document.getElementById("myDropdown").classList.toggle("show");
// }

// //travel type
// /* When the user clicks on the button,toggle between hiding and showing the dropdown content */
// function travel_type() {
// 	document.getElementById("travel_type").classList.toggle("show");
// }

// //more
// function more() {
// 	document.getElementById("more").classList.toggle("show");
// }

// //guest_rate
// function guest_rate() {
// 	document.getElementById("guest_rate").classList.toggle("show");
// }

// //duration
// function duration() {
// 	document.getElementById("duration").classList.toggle("show");
// }

// //price
// function price() {
// 	document.getElementById("price").classList.toggle("show");
// }

// //service_included
// function service_included() {
// 	document.getElementById("service_included").classList.toggle("show");
// }

// //sutible_for
// function sutible_for() {
// 	document.getElementById("sutible_for").classList.toggle("show");
// }

// //general_tags
// function general_tags() {
// 	document.getElementById("general_tags").classList.toggle("show");
// }

// General function to toggle dropdown visibility
function toggleDropdown(dropdownId) {
    document.getElementById(dropdownId).classList.toggle("show");
}

// Example usage for each dropdown
function myFunction() {
    toggleDropdown("myDropdown");
}

function travel_type() {
    toggleDropdown("travel_type");
}

function more() {
    toggleDropdown("more");
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

// ****************

/*// Function to update the URL path to lowercase (it is working, but check to convert in lowercase, before apply)
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
};*/

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
        document.search3.action = ROOT_URL + '/Holidays' + "/" + destination_search + '-tour-packages';
        // window.location.href = ROOT_URL + '/Holidays' + "/" + destination_search + '-tour-packages';
    } else {
        document.search3.action = ROOT_URL + '/Holidays' + "/" + destination_search + "/Theme" + "/" + select_theme;
        // window.location.href = ROOT_URL + '/Holidays' + "/" + destination_search + "/Theme" + "/" + select_theme;
    }
});

// mobile
$(document).on("submit","#search4",function() {
	var destination_search=slug($("#destination_search_mobile").val());
	var select_theme=slug($("#traveltheme_mobile").val());

	var ROOT_URL = $("#ROOT_URL").val();

	// if(destination_search!="" && select_theme=="") {
	if (destination_search && !select_theme) {
		//$(APP_URL).attr('href', ''+destination_search)
		document.search4.action = ROOT_URL + '/Holidays' + "/" + destination_search + '-tour-packages';
		// window.location.href = ROOT_URL + '/Holidays' + "/" + destination_search + '-tour-packages';
	} else {
		//$(location).attr('href', 'Packages/'+destination_search+'/Theme/'+select_theme)
		document.search4.action = ROOT_URL + '/Holidays' + "/" + destination_search + "/Theme" + "/" + select_theme;
		// window.location.href = ROOT_URL + '/Holidays' + "/" + destination_search + "/Theme" + "/" + select_theme;
	}
});

// ****************

// forces the page to scroll to the top (position 0, 0) whenever the user attempts to refresh the page
window.onbeforeunload = function () {
	window.scrollTo(0, 0);
}

// ****************

$(document).ready(function() {
	$(".dropdown").click(function() {
		$(".caret").css({"color": "#333"})
		$(this).children().first().children().css({"color": "#b51319"});
	});
});

// ****************

// can also be fetched using search-destination.js
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
    /*$(document).on('change.select2', '.package_service', function (e) {
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
    });*/
});

// ****************

// load data on scroll (old-working)
/*jQuery(document).scroll(function() {
	var height=window.pageYOffset;
	var window_height=jQuery(window).height();
	var position = jQuery(window).scrollTop();
	var action="active";
	var bottom = jQuery(document).height() - jQuery(window).height() -$("footer").height();

	//
	function Utils() {
	}

	Utils.prototype = {
		constructor: Utils,
		isElementInView: function (element, fullyInView) {
			var pageTop = $(window).scrollTop();
			var pageBottom = pageTop + $(window).height();
			var elementTop = $(element).offset().top;
			var elementBottom = elementTop + $(element).height();
			if (fullyInView === true) {
				return ((pageTop < elementTop) && (pageBottom > elementBottom));
				}
			else {
			return ((elementTop <= pageBottom) && (elementBottom >= pageTop));
			}
			}
	};

	var Utils = new Utils();
	var isElementInView = Utils.isElementInView($('footer'), false);
	clearTimeout( $.data(this, "scrollCheck" ) );

	$.data( this, "scrollCheck", setTimeout(function() {
		if (isElementInView) {
			var APP_URL=$("#testvalue").val();
			var loader_src= APP_URL+'/public/uploads/loder.gif';
			if($(".loader_scroll").is(':empty')) {
			$(".loader_scroll").html("").html("<span style=''>Loading more packages... <img style='' src='"+loader_src+"'>")
			}
			var destination=$("#destination").val();
			var action="inactive";
			var places=[];
			$('input[name="chk_value"]:checked').each(function() {
				places.push($(this).val());
				});
			var duration=new Array();
			$('input[name="duration"]:checked').each(function() {
				duration.push($(this).val());
				});
			var travel_type=new Array();
			$('input[name="chk_travel"]:checked').each(function() {
				travel_type.push($(this).val());
				});
			var theme_type=new Array();
			$('input[name="chk_more"]:checked').each(function() {
				theme_type.push($(this).val());
				});
			var guest_rating=new Array();
			$('input[name="chk_gest"]:checked').each(function() {
				guest_rating.push($(this).val());
				});
			//
			var services_includes=new Array();
			$('input[name="services_includes"]:checked').each(function() {
				services_includes.push($(this).val());
				});
			//
			var sut_for=new Array();
			$('input[name="sut_for"]:checked').each(function() {
				sut_for.push($(this).val());
				});
			//
			var gen_tags=new Array();
			$('input[name="gen_tags"]:checked').each(function() {
				gen_tags.push($(this).val());
				});
			//

			var search_date=$("#datepicker").val()

			var window_width= $(window).width();
			var sort_filter=$("#sort_filter").val()
			var min_price=$(".min-price-label").html();
			var max_price=$(".max-price-label").html();
			var APP_URL=$("#testvalue").val();
			var url=APP_URL+'/mid_package_data';
			var packages_id =$("input[name='pack_id_list[]']")
			.map(function(){return $(this).val();}).get();
			var limit="3";
			var event_type="1";
			var data={window_width:window_width,event_type:event_type,limit:limit,packages_id:packages_id,destination:destination, places:places,duration:duration,travel_type:travel_type,theme_type:theme_type,guest_rating:guest_rating,min_price:min_price,max_price:max_price,services_includes:services_includes,sut_for:sut_for,gen_tags:gen_tags,search_date:search_date,sort_filter:sort_filter,_token:"{{ csrf_token() }}"};
			$.get(url,data,function(rdata) {
				if(rdata!="<br>") {
					$(".loader_scroll").html("")
					$(".dynamic_data").append(rdata)
				} else {
					$(".loader_scroll").html("").html("<p style=''>That's all the option that we have</p>")
				}
			});
		}
	}, 350))
});*/

// load data on scroll
$(document).scroll(function () {
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
                search_date: $("#datepicker").val(),
                sort_filter: $("#sort_filter").val(),
                min_price: $(".min-price-label").html(),
                max_price: $(".max-price-label").html(),
                _token: $('meta[name="csrf-token"]').attr('content'),
            };

            /*$.get(LOAD_MORE_ITEM_URL, data, function (rdata) {
                if (rdata !== "<br>") {
                    $(".loader_scroll").html("");
                    $(".dynamic_data").append(rdata);
                } else {
                    $(".loader_scroll").html("<p>That's all the options that we have</p>");
                }
            }).fail(function (jqXHR, textStatus, errorThrown) {
                console.error("Error loading data:", textStatus, errorThrown);
                $(".loader_scroll").html("<p>Change the filter criteria and try again</p>");
            });*/

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
});
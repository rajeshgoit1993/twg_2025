

//Desktop & Mobile width
$(document).ready(function() {
	//Desktop & Mobile View
	if($(window).width()>=992) {
		// $(".mobile_test_exp").html("")
		$(".mobile_test_exp").each(function( index ) {
			$(this).remove()
		});
	} else {
		// $(".destop_test_exp").html("")
		$(".destop_test_exp").each(function( index ) {
			$(this).remove()
		});
	}
});

/***********************************************/

// datepicker (old)
/*$(function() {
	$( "#datepicker" ).datepicker( { 
		dateFormat: 'd M yy',
		minDate: new Date($("#given_year").val(), $("#given_month").val()-1, $("#given_date").val()),
		maxDate: new Date($("#given_end_year").val(), $("#given_end_month").val()-1, $("#given_end_date").val()),
		onSelect: function(dateText) {
			get_data()
			}
		}).datepicker("setDate", "0");
});*/

// datepicker
$(function () {
    function applyDatepicker() {
        const desktopDatepicker = $("#datepicker");
        const mobileDatepicker = $("#m_datepicker");
        const defaultDate = new Date(
    $("#given_year").val(), 
    $("#given_month").val() - 1, 
    $("#given_date").val()
);
        if (window.innerWidth >= 992) {
            // Destroy mobile datepicker if it exists
            if (mobileDatepicker.data("datepicker")) {
                mobileDatepicker.datepicker("destroy");
            }

            // Initialize desktop datepicker
            if (!desktopDatepicker.data("datepicker")) {
            	var today = new Date();
                desktopDatepicker.datepicker({
                    dateFormat: "D, d M yy", // Includes day name
                    // minDate: new Date($("#given_year").val(), $("#given_month").val() - 1, $("#given_date").val()),
                    minDate: new Date(today.getFullYear(), today.getMonth(), today.getDate()),
                    maxDate: new Date($("#given_end_year").val(), $("#given_end_month").val() - 1, $("#given_end_date").val()),
                    numberOfMonths: 2,       // Show two months simultaneously
                    onSelect: function (dateText) {
                    	get_price_type();   
                          // Call get_data() on date selection
                    }
                }).datepicker("setDate", defaultDate); // Set default date to today
            }
        } else {
            // Destroy desktop datepicker if it exists
            if (desktopDatepicker.data("datepicker")) {
                desktopDatepicker.datepicker("destroy");
            }

            // Initialize mobile datepicker
            if (!mobileDatepicker.data("datepicker")) {
            	var today = new Date();
                mobileDatepicker.datepicker({
                    dateFormat: "D, d M yy", // Includes day name
                    minDate: new Date(today.getFullYear(), today.getMonth(), today.getDate()),
                    maxDate: new Date($("#given_end_year").val(), $("#given_end_month").val() - 1, $("#given_end_date").val()),
                    numberOfMonths: [12, 1] // Display the months vertically
                }).datepicker("setDate", defaultDate);
            }

            // Prevent calendar from opening when input is clicked
            mobileDatepicker.off("focus").on("focus", function (e) {
                e.preventDefault();
                $(this).blur(); // Prevent focus behavior
            });

            // Add "Change" button functionality for mobile datepicker
            $("#btnChangeDateMobile").off("click").on("click", function () {

                mobileDatepicker.datepicker("show");
            });
        }
    }

    // Apply datepicker on page load
    applyDatepicker();

    // Reapply datepicker on window resize
    $(window).on("resize", function () {
        applyDatepicker();
    });
});



/***********************************************/

/*$(document).on("change",".pkg_type_two",function() {
	get_data()
});

//
function get_data() {
	var selected_date=$("#datepicker").val()
    alert(selected_date)
	// var date=this.value
	var date=$("#datepicker").val();
	var APP_URL=$("#test").val();
	var url=APP_URL+'/date_wise_price';
	var package_id=$("#package_value").val();
	var type_value=$(".type_value").val();
	var pkg_type=$(".pkg_type_two").val();
	var data={date:date,package_id:package_id,pkg_type:pkg_type,type_value:type_value,_token:"{{ csrf_token() }}"};
	$.get(url,data,function(rdata) {
		$(".get_update_price").html("").html(rdata.return_price)
		$(".type").html("").html(rdata.type)
	})
}

function openModal() {
	$('#queryHandler').modal('toggle');
}*/

// update price as per date
$(document).on("change", ".pkg_type_two", function () {
    get_data();
});

// Function to fetch data based on selected inputs
function get_price_type()
{
var date = $("#datepicker").val();
    var package_id = $("#package_value").val();
    var pkg_type = $(".pkg_type_two").val();
    var type_value = $(".type_value").val();
    var APP_URL = $("#test").val();
    var url = APP_URL + "/get_price_type";

    // Validate required fields
    if (!date || !package_id || !pkg_type || !type_value) {
        //alert("Please ensure all fields are filled out before proceeding.");
        return;
    }
var data = {
        date: date,
        package_id: package_id,
        pkg_type: pkg_type,
        type_value: type_value,
        _token: $('meta[name="csrf-token"]').attr("content"), // CSRF token from meta tag
    };

    // Perform AJAX GET request
    $.get(url, data)
        .done(function (rdata) {
            // Update the DOM with the returned data
           
            $(".type").html(rdata.type || "No type available");
             get_data();
        })
        .fail(function (xhr, status, error) {
            // Handle errors (e.g., network issues or server errors)
            console.error("Error fetching data:", error);
            alert("Failed to fetch data. Please try again later.");
        });


}
function get_data() {
    // Retrieve necessary input values
    var date = $("#datepicker").val();
    var package_id = $("#package_value").val();
    var pkg_type = $(".pkg_type_two").val();
    var type_value = $(".type_value").val();
    var APP_URL = $("#test").val();
    var url = APP_URL + "/date_wise_price";

    // Validate required fields
    if (!date || !package_id || !pkg_type || !type_value) {
        //alert("Please ensure all fields are filled out before proceeding.");
        return;
    }

    // Prepare data object for the request
    var data = {
        date: date,
        package_id: package_id,
        pkg_type: pkg_type,
        type_value: type_value,
        _token: $('meta[name="csrf-token"]').attr("content"), // CSRF token from meta tag
    };

    // Perform AJAX GET request
    $.get(url, data)
        .done(function (rdata) { 
            // Update the DOM with the returned data
            $(".get_update_price").html(rdata.return_price || "No price available");
            $(".mtype").html(rdata.type || "No type available");
            $(".dDateRange").html(rdata.date_range || "No type available");
         var startDate = new Date(rdata.first_day);
        var endDate = new Date(rdata.last_day);
       const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                            "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

        var count = 1;
        while (startDate <= endDate) {
            let current = new Date(startDate);

            let dd = String(current.getDate()).padStart(2, '0');
            let mmm = monthNames[current.getMonth()];
            let yyyy = current.getFullYear();

            let formattedDate = `${dd} ${mmm} ${yyyy}`;

            $(".dynamic_day_"+count).html('').html(formattedDate)

count = count + 1;
            startDate.setDate(startDate.getDate() + 1);
        }

            
        })
        .fail(function (xhr, status, error) {
            // Handle errors (e.g., network issues or server errors)
            console.error("Error fetching data:", error);
            alert("Failed to fetch data. Please try again later.");
        });
}

// Function to toggle the modal
function openModal() {
    $("#queryHandler").modal("toggle");
}



/***********************************************/

//Calendar
$(document).ready(function() {
	$('#event_stricky ul li').first().children().children().addClass('active');
	var tab_id=$(".custom_table tr:first-child a").attr("href")
	$(tab_id).addClass("active in")
	var APP_URL=$("#test").val();
	var package_type=$("#package_type").val();
	var hidden_value=$("#hidden_value").val();
	var package_id=$("#package_value").val();
	var pkg_type=$(".pkg_type").val();

	// var url=APP_URL+'/calendar-data/'+package_id+"/"+hidden_value+"/"+package_type+"/"+pkg_type;
	var url=APP_URL+'/calendar-new-price/'+package_id+"/"+package_type;
	var sdate=$("#package_type").find('option:selected').attr("pkg_date");
  
	$('#calendar').fullCalendar({
		// defaultDate: new Date(2023, 4, 20),
		// validRange: {
		// 	start: sdate
		// },
		header: {
			left: 'prev, today',
			center: 'title',
			right: 'next'
		},
		eventRender: function( event, element, view ) {
			element.find('.fc-title').prepend('<span class="price_s">&#8377</span> ');
			// element.attr('data-toggle', "modal");
			// element.attr('data-target', "#queryHandler_cal");
			//$(element).css("margin-left", "10px");
			var eventDate = event.start;
			var calendarDate = $('#calendar').fullCalendar('getDate');
			if (eventDate.get('month') !== calendarDate.get('month')) {
				return false;
				}
		},
       
		displayEventTime: false,
		events:url,
		eventClick: function(calEvent,event, jsEvent, view) {


var today = new Date();
var date = calEvent.start.format('YYYY-MM-DD'); // Ensure proper format if using moment.js

// Convert to JavaScript Date object
var defaultDateObj = new Date(date); // Assuming 'YYYY-MM-DD'

			 var enquiryModalDesktop = document.getElementById("enquiryModal_desktop");
			 if(enquiryModalDesktop==null)
			 {
			 	var enquiryModalMobile = document.getElementById("enquiryModal_mobile");
		enquiryModalMobile.style.display = "block";
$("#travel_date_modal_mobile_enquiry").datepicker({
    dateFormat: "d M yy",                     // Display format
    minDate: today,                           // Today as minimum selectable date
    maxDate: "+12M",                          // Up to 12 months ahead
    numberOfMonths: [12, 1]                   // 12 months in one column
}).datepicker("setDate", defaultDateObj); 

			 }
			 else
			 {
			 enquiryModalDesktop.style.display = "block";

			

// Initialize datepicker
$("#travel_date_modal_desktop_enquiry").datepicker({
    dateFormat: "d M yy",                     // Display format
    minDate: today,                           // Today as minimum selectable date
    maxDate: "+12M",                          // Up to 12 months ahead
    numberOfMonths: [12, 1]                   // 12 months in one column
}).datepicker("setDate", defaultDateObj);	
			 }
			     // Set default selected date

var hotel_name=$("#package_type").find(":selected").text();
			$("#hotel_pre").val("").val(hotel_name)
			var event_title=calEvent.title;

			if(event_title!="Send Query") {
				$("#exp_budget").val('').val(event_title)
				
			} else {
				$("#exp_budget").val('').val(event_title)
			}


			// opens events in a popup window
			// window.open(event.url, 'gcalevent', 'width=700,height=600');
			
			
		},

		viewRender: function(currentView) {
	        var minDate = moment();
	        console.log(minDate)
	        // Past
	        if (minDate >= currentView.start && minDate <= currentView.end) {
				$(".fc-prev-button").prop('disabled', true);
	            $(".fc-prev-button").addClass('fc-state-disabled');
				} else {
					$(".fc-prev-button").removeClass('fc-state-disabled');
		            $(".fc-prev-button").prop('disabled', false);
				}
			},
		});

	if($(window).width()>="320") {
		$('#calendar').fullCalendar('option', 'height', 430);
	}
	if($(window).width()>="992") {
		$('#calendar').fullCalendar('option', 'height', 450);
	}

	var i=1;
	$("#package_type").change(function() {
		$("#calendar_parrent").empty();
		var package_type=$(this).val();
		// var url=APP_URL+'/calendar-data/'+package_id+"/"+hidden_value+"/"+package_type+"/"+pkg_type;
		var url=APP_URL+'/calendar-new-price/'+package_id+"/"+package_type;
		var sdate=$(this).find('option:selected').attr("pkg_date");
		$("#calendar_parrent").append('<div id="calendar'+i+'"></div>');

		// full calendar
		$('#calendar' + i + '').fullCalendar({
			// validRange:  {
			// 	start: sdate
			// },
			header: {
				left: 'prev, today',
				center: 'title',
				right: 'next'
			},
			eventRender: function( event, element, view ) {
				element.find('.fc-title').prepend('<span class="price_s">&#8377</span> ');
				// element.attr('data-toggle', "modal");
				// element.attr('data-target', "#queryHandler_cal");
				//$(element).css("margin-left", "10px");
				var j=i-"1";
				var eventDate = event.start;
				var calendarDate = $('#calendar' + j + '').fullCalendar('getDate');
				if (eventDate.get('month') !== calendarDate.get('month')) {
					return false;
				}
			},
			
			displayEventTime: false,
			events:url,
			
			eventClick: function(calEvent,event, jsEvent, view) {
				
var today = new Date();
var date = calEvent.start.format('YYYY-MM-DD'); // Ensure proper format if using moment.js

// Convert to JavaScript Date object
var defaultDateObj = new Date(date); // Assuming 'YYYY-MM-DD'

			 var enquiryModalDesktop = document.getElementById("enquiryModal_desktop");
			 if(enquiryModalDesktop==null)
			 {
			 	var enquiryModalMobile = document.getElementById("enquiryModal_mobile");
		enquiryModalMobile.style.display = "block";
$("#travel_date_modal_mobile_enquiry").datepicker({
    dateFormat: "d M yy",                     // Display format
    minDate: today,                           // Today as minimum selectable date
    maxDate: "+12M",                          // Up to 12 months ahead
    numberOfMonths: [12, 1]                   // 12 months in one column
}).datepicker("setDate", defaultDateObj); 

			 }
			 else
			 {
			 enquiryModalDesktop.style.display = "block";

			

// Initialize datepicker
$("#travel_date_modal_desktop_enquiry").datepicker({
    dateFormat: "d M yy",                     // Display format
    minDate: today,                           // Today as minimum selectable date
    maxDate: "+12M",                          // Up to 12 months ahead
    numberOfMonths: [12, 1]                   // 12 months in one column
}).datepicker("setDate", defaultDateObj);	
			 }
			     // Set default selected date

var hotel_name=$("#package_type").find(":selected").text();
			$("#hotel_pre").val("").val(hotel_name)
			var event_title=calEvent.title;

			if(event_title!="Send Query") {
				$("#exp_budget").val('').val(event_title)
				
			} else {
				$("#exp_budget").val('').val(event_title)
			}


			},

			viewRender: function(currentView) {
				var minDate = moment();
				// Past
				if (minDate >= currentView.start && minDate <= currentView.end) {
					$(".fc-prev-button").prop('disabled', true);
					$(".fc-prev-button").addClass('fc-state-disabled');
					} else {
						$(".fc-prev-button").removeClass('fc-state-disabled');
						$(".fc-prev-button").prop('disabled', false);
					}
				},

			/*viewRender: function(currentView) {
				var minDate = moment();
				// Past
				if (minDate >= currentView.start && minDate <= currentView.end) {
					$(".fc-prev-button").prop('disabled', true);
					$(".fc-prev-button").addClass('fc-state-disabled');
					} else {
						$(".fc-prev-button").removeClass('fc-state-disabled');
						$(".fc-prev-button").prop('disabled', false);
						}
				},*/
			});

			if($(window).width()>="320" && $(window).width()<"992") {
				$('#calendar' + i + '').fullCalendar('option', 'height', 430);
				$(".fc-left").css({"float":"none","position":"relative","left":"-50%","top":"30px"})
				$(".fc-center").css({"margin-left":"30%"})
				//$(".fc-right").css({"float":"none","position":"relative","top":"0px","left":"87%"})
			}

			if($(window).width()>="992") {
				$('#calendar' + i + '').fullCalendar('option', 'height', 450);
			}
			i++
		})
});

/***********************************************/

//Nationality - enquiry form (added in enquiry.js)
/*var APP_URL=$("#test").val();
var url=APP_URL+'/country_query_s';
var data={_token:"{{ csrf_token() }}"};
$.get(url,data,function(rdata) {
	$("#country_of_residence").html("").html(rdata);
	$("#country_of_residence_mobile").html("").html(rdata);
});

//Nationality - Calendar enquiry form
var url=APP_URL+'/country_query_s';
var data={_token:"{{ csrf_token() }}"};
$.get(url,data,function(rdata) {
	$("#country_of_residence_cal").html("").html(rdata);
	})
//Country Code
var url=APP_URL+'/country_code';
var data={_token:"{{ csrf_token() }}"};
$.get(url,data,function(rdata) {
	$("#country_code").html("").html(rdata);
	$("#country_code_mobile").html("").html(rdata);
	$("#country_code_cal").html("").html(rdata);
	})*/

/***********************************************/
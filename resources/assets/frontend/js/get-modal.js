
// Modal Script-Image Gallery-Enquiry-pagethree
// // Get the modal
// var enquiryModalMobile = document.getElementById("enquiryModal_mobile");
// var enquiryModalDesktop = document.getElementById("enquiryModal_desktop");
// var modal_d_gallery = document.getElementById("myModal_d_gallery");
// var modal_m_gallery = document.getElementById("myModal_m_gallery");
// var queryHandler_cals = document.getElementById("queryHandler_cal");

// // Get the button that opens the modal
// var btn_addEnquiryModal_mobile = document.getElementById("addEnquiryModal_mobile");
// var btn_addEnquiryModal_desktop = document.getElementById("addEnquiryModal_desktop");
// var btn_addModal_d_gallery = document.getElementById("addModal_d_gallery");
// var btn_addModal_m_gallery = document.getElementById("addModal_m_gallery");
// // var cal missing

// // Get the <span> element that closes the modal
// var closeModal = document.getElementsByClassName("btnCloseModal")[0];
// var closeModal_desktop = document.getElementsByClassName("btnCloseModal_desktop")[0];
// var closeModal_desktop_gallery = document.getElementsByClassName("btnCloseModal_d_gallery")[0];
// var closeModal_mobile_gallery = document.getElementsByClassName("btnCloseModal_m_gallery")[0];
// var closeModal_desktop_cal = document.getElementsByClassName("btnCloseModal_desktop_cal")[0];

// // When the user clicks the button, open the modal
// btn_addEnquiryModal_mobile.onclick = function() {
// 	enquiryModalMobile.style.display = "block";
// }

// // modal datepicker
// btn_addEnquiryModal_desktop.onclick = function() {	
// 	enquiryModalDesktop.style.display = "block";
// 	$( ".date_arrival_destop" ).datepicker({
// 		dateFormat: "d M y",
// 		minDate: new Date($("#given_year").val(), $("#given_month").val()-1, $("#given_date").val()),
// 	} ).datepicker("setDate", "0");
// }

// btn_addModal_d_gallery.onclick = function() {
//   modal_d_gallery.style.display = "block";
// }

// btn_addModal_m_gallery.onclick = function() {
//   modal_m_gallery.style.display = "block";
// }


// // When the user clicks on <span> (x), close the modal
// closeModal.onclick = function() {
// 	enquiryModalMobile.style.display = "none";
// }

// closeModal_desktop.onclick = function() {
// 	enquiryModalDesktop.style.display = "none";
// }

// closeModal_desktop_gallery.onclick = function() {
//   modal_d_gallery.style.display = "none";
// }

// closeModal_mobile_gallery.onclick = function() {
//   modal_m_gallery.style.display = "none";
// }

// // When the user clicks anywhere outside of the modal, close it
// window.onclick = function(event) {
// 	if (event.target == enquiryModalMobile || event.target == modal_d_gallery || event.target == modal_m_gallery || event.target == enquiryModalDesktop || event.target == queryHandler_cals) {
// 		enquiryModalMobile.style.display = "none";
// 		enquiryModalDesktop.style.display = "none";
// 		modal_d_gallery.style.display = "none";
// 		modal_m_gallery.style.display = "none";
// 		queryHandler_cals.style.display = "none";
// 	}
// }


document.addEventListener('DOMContentLoaded', function() {
    // Get the modal elements
    var enquiryModalMobile = document.getElementById("enquiryModal_mobile");
    var enquiryModalDesktop = document.getElementById("enquiryModal_desktop");
    var modal_d_gallery = document.getElementById("myModal_d_gallery");
    var modal_m_gallery = document.getElementById("myModal_m_gallery");
    var queryHandler_cals = document.getElementById("queryHandler_cal");

    // Get the button elements
    var btn_addEnquiryModal_mobile = document.getElementById("addEnquiryModal_mobile");
    var btn_addEnquiryModal_desktop = document.getElementById("addEnquiryModal_desktop");
    var btn_addModal_d_gallery = document.getElementById("addModal_d_gallery");
    var btn_addModal_m_gallery = document.getElementById("addModal_m_gallery");

    // Get the <span> elements that close the modals
    var closeModal = document.getElementsByClassName("btnCloseModal")[0];
    var closeModal_desktop = document.getElementsByClassName("btnCloseModal_desktop")[0];
    var closeModal_desktop_gallery = document.getElementsByClassName("btnCloseModal_d_gallery")[0];
    var closeModal_mobile_gallery = document.getElementsByClassName("btnCloseModal_m_gallery")[0];
    var closeModal_desktop_cal = document.getElementsByClassName("btnCloseModal_desktop_cal")[0];
   var today = new Date();

    // Only add event listeners if the modal and button elements exist
    if (btn_addEnquiryModal_mobile) {
        btn_addEnquiryModal_mobile.onclick = function() {
            if (enquiryModalMobile) {

  const defaultDate = new Date($(".selected_date").html());
var dActualPrice = $(".mActualPrice").html()
$("#exp_budget").val('').val(dActualPrice)
             enquiryModalMobile.style.display = "block";
                $("#travel_date_modal_mobile_enquiry").datepicker({
                    dateFormat: "d M yy",        // Date format
                    // changeMonth: true,    // Allows month selection from a dropdown.
                    // changeYear: true,     // Allows year selection from a dropdown.
                    //minDate: 0,             // Prevents selecting dates before today
                    minDate:  new Date(today.getFullYear(), today.getMonth(), today.getDate()),
                    maxDate: "+12M",        // Limits selection to 6 months ahead
                    numberOfMonths: [12, 1]  // Display the months vertically
                    // stepMonths: 2, // Moves two months at a time when navigating.
                    // showButtonPanel: true // Optional: Adds "Today" and "Done" buttons                    
                }).datepicker("setDate", defaultDate);
            }
        };
    }

    if (btn_addEnquiryModal_desktop) {
        btn_addEnquiryModal_desktop.onclick = function() {
            if (enquiryModalDesktop) {
                const defaultDate = new Date($("#datepicker").val());
var dActualPrice = $(".dActualPrice").html()
$("#exp_budget").val('').val(dActualPrice)

                enquiryModalDesktop.style.display = "block";
                $("#travel_date_modal_desktop_enquiry").datepicker({
                    dateFormat: "d M yy",        // Date format
                    // changeMonth: true,    // Allows month selection from a dropdown.
                    // changeYear: true,     // Allows year selection from a dropdown.
                    //minDate: 0,             // Prevents selecting dates before today
                    minDate:  new Date(today.getFullYear(), today.getMonth(), today.getDate()),
                    maxDate: "+12M",        // Limits selection to 6 months ahead
                    numberOfMonths: 2       // Show two months simultaneously
                    // stepMonths: 2, // Moves two months at a time when navigating.
                    // showButtonPanel: true // Optional: Adds "Today" and "Done" buttons                    
                }).datepicker("setDate", defaultDate);
            }
        };
    }

    if (btn_addModal_d_gallery) {
        btn_addModal_d_gallery.onclick = function() {
            if (modal_d_gallery) {
                modal_d_gallery.style.display = "block";
            }
        };
    }

    if (btn_addModal_m_gallery) {
        btn_addModal_m_gallery.onclick = function() {
            if (modal_m_gallery) {
                modal_m_gallery.style.display = "block";
            }
        };
    }

    // Close modals when the user clicks on <span> (x)
    if (closeModal) {
        closeModal.onclick = function() {
            if (enquiryModalMobile) {
                enquiryModalMobile.style.display = "none";
            }
        };
    }

    if (closeModal_desktop) {
        closeModal_desktop.onclick = function() {
            if (enquiryModalDesktop) {
                enquiryModalDesktop.style.display = "none";
            }
        };
    }

    if (closeModal_desktop_gallery) {
        closeModal_desktop_gallery.onclick = function() {
            if (modal_d_gallery) {
                modal_d_gallery.style.display = "none";
            }
        };
    }

    if (closeModal_mobile_gallery) {
        closeModal_mobile_gallery.onclick = function() {
            if (modal_m_gallery) {
                modal_m_gallery.style.display = "none";
            }
        };
    }

    // Close modals when clicking anywhere outside the modal content
    window.onclick = function(event) {
        if (
            (event.target == enquiryModalMobile && enquiryModalMobile) ||
            (event.target == modal_d_gallery && modal_d_gallery) ||
            (event.target == modal_m_gallery && modal_m_gallery) ||
            (event.target == enquiryModalDesktop && enquiryModalDesktop) ||
            (event.target == queryHandler_cals && queryHandler_cals)
        ) {
            if (enquiryModalMobile) {
                enquiryModalMobile.style.display = "none";
            }
            if (enquiryModalDesktop) {
                enquiryModalDesktop.style.display = "none";
            }
            if (modal_d_gallery) {
                modal_d_gallery.style.display = "none";
            }
            if (modal_m_gallery) {
                modal_m_gallery.style.display = "none";
            }
            if (queryHandler_cals) {
                queryHandler_cals.style.display = "none";
            }
        }
    };
});

function get_mprice_type()
{
    var date = $("#m_datepicker").val();
    var package_id = $("#package_value").val();
    var pkg_type = $(".pkg_type_two").val();
    var type_value = $(".type_value").val();
    var APP_URL = $("#test").val();

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
var url = APP_URL + "/get_price_type";
    // Perform AJAX GET request
    $.get(url, data)
        .done(function (rdata) {
            // Update the DOM with the returned data
           
            $(".mtype").html(rdata.type || "No type available");
             // get_mdata();
        })
        .fail(function (xhr, status, error) {
            // Handle errors (e.g., network issues or server errors)
            console.error("Error fetching data:", error);
            alert("Failed to fetch data. Please try again later.");
        });
}

function get_mdata() {

    // Retrieve necessary input values
    var date = $("#m_datepicker").val();
    var package_id = $("#package_value").val();
    var pkg_type = $(".pkg_type_two").val();
    var type_value = $(".type_value").val();
    var APP_URL = $("#test").val();

    var url = APP_URL + "/date_wise_price_mobile";

    // Validate required fields
    if (!date || !package_id || !pkg_type || !type_value) {
        //alert("Please ensure all fields are filled out before proceeding.");
        return;
    }
   // alert('dd')
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
var price_type_data = $('.searchPanelUpdate_selectBox.pkg_type_two.type_value option:selected').text();
$(".mSearchInput_price_type").html('').html(price_type_data)
            $(".mSearchInput_date").html(rdata.date_range || "No type available");
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

// mobile-modal-pop-up-script
document.addEventListener('DOMContentLoaded', function () {
    // Helper function to handle modal opening and closing
    function handleModal(modalButton, modal, closeButton) {
        // Open the modal
        modalButton.addEventListener('click', () => {
            modal.classList.add("show");



        });

        // Close the modal
        closeButton.addEventListener('click', () => {
            modal.classList.remove("show");
        });

        // Close the modal when clicking outside of it
        window.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.classList.remove("show");
            }
        });

         

    }

    // Search Inputs Modal (General)
    const getModal_searchInputs = document.getElementById('btn_getModal_searchInputs');
    const closeModal_searchInputs = document.getElementById('closeModal_searchInputs');
    const openModal_searchInputs = document.getElementById('modal_searchInputs');
    if (getModal_searchInputs && closeModal_searchInputs && openModal_searchInputs) {
        handleModal(getModal_searchInputs, openModal_searchInputs, closeModal_searchInputs);
    }

    // Search Inputs City Modal
    const getModal_searchInputs_city = document.getElementById('btn_getModal_searchInputs_city');
    const closeModal_searchInputs_city = document.getElementById('btn_closeModal_searchInputs_city');
    const openModal_searchInputs_city = document.getElementById('modal_searchInputs_city');
    if (getModal_searchInputs_city && closeModal_searchInputs_city && openModal_searchInputs_city) {
        handleModal(getModal_searchInputs_city, openModal_searchInputs_city, closeModal_searchInputs_city);
    }

    // Search Inputs Date Modal
    const getModal_searchInputs_date = document.getElementById('btn_getModal_searchInputs_date');
    const closeModal_searchInputs_date = document.getElementById('btn_closeModal_searchInputs_date');
    const openModal_searchInputs_date = document.getElementById('modal_searchInputs_date');
    if (getModal_searchInputs_date && closeModal_searchInputs_date && openModal_searchInputs_date) {
        handleModal(getModal_searchInputs_date, openModal_searchInputs_date, closeModal_searchInputs_date);
    }

    // Search Inputs Travellers Modal
    const getModal_searchInputs_travellers = document.getElementById('btn_getModal_searchInputs_travellers');
    const closeModal_searchInputs_travellers = document.getElementById('btn_closeModal_searchInputs_travellers');
    const openModal_searchInputs_travellers = document.getElementById('modal_searchInputs_travellers');
    if (getModal_searchInputs_travellers && closeModal_searchInputs_travellers && openModal_searchInputs_travellers) {
        handleModal(getModal_searchInputs_travellers, openModal_searchInputs_travellers, closeModal_searchInputs_travellers);
    }
//
$(document).on("click",".apply_mobile_filter",function(){

    get_mdata()
    const modal_searchInputs = document.getElementById('modal_searchInputs');
  
    $(modal_searchInputs).removeClass("show");
})

$(document).on("click",".apply_changed_date",function(){
    var m_datepicker = $("#m_datepicker").val()


    const modal_searchInputs_date = document.getElementById('modal_searchInputs_date');
   
    $(".selected_date").html('').html(m_datepicker)
    $(modal_searchInputs_date).removeClass("show");
   get_mprice_type(); 
    
})

    // Modal for Add New Container (Rooms)
    const addButton = document.getElementById('addContainerButton');
    const existingContainer = document.getElementById('guest_container');
    const appendContainer = document.getElementById('add_new_guest_container');
    let containerCount = 1;

    if (addButton && existingContainer && appendContainer) {
        addButton.addEventListener('click', function () {
            // Increment the container counter
            containerCount++;

            // Create a new container element
            const newContainer = document.createElement('div');

            // Add content/container and a "Remove Container" button within the new container
            newContainer.innerHTML = existingContainer.innerHTML + `${containerCount}`;

            // Append the new container to the document
            appendContainer.appendChild(newContainer);

            // Scroll the new container into view
            newContainer.scrollIntoView({ behavior: 'smooth', block: 'end' });

            // "Remove Container" button
            const removeButton = newContainer.querySelector('#removeContainerButton');

            if (removeButton) {
                removeButton.addEventListener('click', function () {
                    // Remove the clicked container
                    appendContainer.removeChild(newContainer);
                });
            }
        });
    }
});
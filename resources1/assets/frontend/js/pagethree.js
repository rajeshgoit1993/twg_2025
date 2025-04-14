/*Mobile Tour Image Animation-script-pagethree.js*/
window.addEventListener('load', function () {
    // Check if user is on a mobile device
    if (window.innerWidth <= 992) { // Adjust width as needed for your mobile breakpoint
        const container = document.querySelector('.mTourImg-animation-container');
        if (container) {
            container.classList.add('loaded');
        } else {
            console.warn("⚠️ Warning: Element with class 'mTourImg-animation-container' is missing on mobile.");
        }
    } /*else {
        console.log("ℹ️ Not a mobile device, skipping animation container check.");
    }*/
});
/*Animation-script Ends*/


// /**********************/

// // hotel preference selection
// document.addEventListener("DOMContentLoaded", handleHotelCategorySelection);

// // Function to handle hotel star category selection radio buttons
// function handleHotelCategorySelection() {
//   const radioButtons = document.querySelectorAll('.hotel-selection input[type="radio"]');
//   const defaultHotelPreference = "4"; // Default hotel preference value

//   // Function to handle change event for radio buttons
//   function handleRadioChange() {
//     // Remove the selected-item class from all labels
//     document.querySelectorAll('.hotel-selection').forEach(label => label.classList.remove('selected-item'));

//     // Add the selected-item class to the selected label
//     if (this.checked) {
//       this.parentElement.classList.add('selected-item');
//     }
//   }

//   // Function to handle keypress event for radio buttons (for accessibility)
//   function handleRadioKeypress(event) {
//     if (event.key === "Enter" || event.key === " ") {
//       this.click(); // Simulate click when Enter or Space key is pressed
//     }
//   }

//   // Add event listeners for change and keypress events to each radio button
//   radioButtons.forEach(radio => {
//     radio.addEventListener('change', handleRadioChange);
//     radio.addEventListener('keypress', handleRadioKeypress);
//   });

//   // Set default selection (4-star)
//   const defaultRadioButton = document.querySelector(`.hotel-selection input[type="radio"][value="${defaultHotelPreference}"]`);
//   if (defaultRadioButton) {
//     defaultRadioButton.checked = true;
//     defaultRadioButton.dispatchEvent(new Event('change'));
//   }
// }


// /**********************/


// // Handle changes for the additional details checkboxes
// $(document).on("change", ".additional_details", function() {
//     // Update the textarea whenever a checkbox is checked/unchecked
//     updateAdditionalDetails();
// });

// // Handle changes for flight booking preference (Yes or No)
// $(document).on("change", "input[name='flight_booking']", function() {
//     // Add the 'selected-item' class to the corresponding label
//     const radioButtons = $("input[name='flight_booking']");
    
//     // Remove 'selected-item' from all labels first
//     radioButtons.closest('label').removeClass('selected-item');

//     // Add 'selected-item' to the selected label
//     $(this).closest('label').addClass('selected-item');
    
//     // Update the textarea with flight booking status
//     updateAdditionalDetails();
// });

// // Function to update the additional requests textarea based on radio button and checkbox selections
// function updateAdditionalDetails() {
//     const radioButtons = document.querySelectorAll('input[name="flight_booking"]');
//     const checkboxes = document.querySelectorAll('.additional_details');
//     const additionalDetailsTextarea = document.getElementById("additionaldetails");
//     let details = [];

//     // Add flight booking preference to details array
//     radioButtons.forEach(radio => {
//         if (radio.checked) {
//             details.push(`Flight ticket booked: ${radio.value === "0" ? "Yes" : "No"}`);
//         }
//     });

//     // Add selected checkbox values (additional details) to the details array
//     checkboxes.forEach(checkbox => {
//         if (checkbox.checked) {
//             details.push(checkbox.value);
//         }
//     });

//     // Update the textarea with the gathered details
//     additionalDetailsTextarea.value = details.join(', ');
// }

// // Reset additional details textareas if needed
// function resetAdditionalDetails() {
//     $("#additionaldetails").val('');
//     $("#additionaletails_mobile").val('');
//     $("#additionaletails_cal").val('');
// }


// /**********************/


// // budget slider
// document.addEventListener("DOMContentLoaded", budgetSlider);

// function budgetSlider() {
//   var budgetInput = document.getElementById("exp_budget");
//   var budgetSliderContainer = document.getElementById("budgetSliderContainer");
//   var budgetSlider = document.getElementById("budgetSlider");
//   var budgetError = document.getElementById("budget_error");

//   // Function to round the budget value to the nearest 2500
//   function roundToNearestValue(x) {
//     return Math.round(x / 2500) * 2500;
//   }

//   // Function to add commas to the budget value for better readability
//   function numberWithCommas(x) {
//     return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
//   }

//   // Function to update slider track color dynamically based on thumb position
//   function updateSliderTrackColor() {
//     var percentage = (budgetSlider.value - budgetSlider.min) / (budgetSlider.max - budgetSlider.min);
//     var color = 'linear-gradient(90deg, #08B2ED ' + percentage * 100 + '%, #d3d3d3 ' + percentage * 100 + '%)';
//     budgetSlider.style.background = color;
//   }

//   // Hide the budget slider container initially
//   budgetSliderContainer.style.display = "none";

//   // Add click event listener to the budget input
//   budgetInput.addEventListener("click", function(event) {
//     budgetSliderContainer.style.display = budgetSliderContainer.style.display === "none" ? "block" : "none";
//     event.stopPropagation(); // Prevent the click event from propagating to the document body
//   });

//   // Add input event listener to the budget slider
//   budgetSlider.addEventListener("input", function() {
//     // Round the slider value to the nearest 50
//     var roundedValue = roundToNearestValue(budgetSlider.value);
//     // Update the slider value
//     budgetSlider.value = roundedValue;
//     // Update the input value with commas
//     budgetInput.value = numberWithCommas(roundedValue);
//     // Update slider track color
//     updateSliderTrackColor();

//     // Clear budget error message
//     budgetError.innerHTML = "";
//   });

//   // Add click event listener to the document body
//   document.body.addEventListener("click", function() {
//     budgetSliderContainer.style.display = "none";
//   });

//   // Prevent the budget slider container from closing when clicking inside of it
//   budgetSliderContainer.addEventListener("click", function(event) {
//     event.stopPropagation(); // Prevent the click event from propagating to the document body
//   });

//   // Update slider track color initially
//   updateSliderTrackColor();
// }


// /**********************/


/*Mobile Tour Tabs Starts*/
// // Get references to the tab buttons and tab content
// const tabButtons = document.querySelectorAll('.tab-button');
// const tabs = document.querySelectorAll('.tab');

// // Get references to the sub-tab buttons and sub-tab content within Tab 1
// const subTabButtons = document.querySelectorAll('.sub-tab-button');
// const subTabs = document.querySelectorAll('.sub-tab');

// // Set the first tab and sub-tab as active by default
// $(document).ready(function() {
//   $(".dMainTabButton").children(":first-child").addClass('active')
//   $(".dSubTabButton").children(":first-child").addClass('active')

//   $(".mMainTabButton").children(":first-child").addClass('active')
//   $(".mSubTabButton").children(":first-child").addClass('active')

//   $(".tab-content" ).each(function( index ) {
//     $(".tab-content").children(":first-child").addClass('active')
//   });

//   $(".sub-tab-content" ).each(function( index ) {
//     $(".sub-tab-content").children(":first-child").addClass('active')
//   });
// });

// //tabs[0].classList.add('active');
// // tabButtons[0].classList.add('active');
// // subTabs[0].classList.add('active');
// // subTabButtons[0].classList.add('active');

// // Function to scroll tab content into view (not working, to check)
// function scrollTabContentIntoView(tabContent) {
//   tabContent.scrollIntoView({
//     behavior: 'smooth', // You can adjust the scrolling behavior
//     block: 'start',    // Scroll to the top of the tab content
//   });
// }

// // Add click event listeners to each tab button
// tabButtons.forEach((button, index) => {
//   button.addEventListener('click', () => {
//     // Hide all tabs
//     tabs.forEach(tab => {
//       tab.classList.remove('active');
//     });

//     // Show the selected tab
//     tabs[index].classList.add('active');

//     // Remove the 'active' class from all buttons
//     tabButtons.forEach(btn => {
//       btn.classList.remove('active');
//     });

//     // Add the 'active' class to the clicked button
//     button.classList.add('active');

//      // Scroll the tab content into view (not working, to check)
//     if (tabContent) {
//       scrollTabContentIntoView(tabContent);
//     }
//   });
// });

// // Add click event listeners to sub-tab buttons within Tab 1
// subTabButtons.forEach((button, index) => {
//   button.addEventListener('click', () => {
//     // Hide all sub-tabs within Tab 1
//     subTabs.forEach(subTab => {
//       subTab.classList.remove('active');
//     });

//     // Show the selected sub-tab within Tab 1
//     subTabs[index].classList.add('active');

//     // Remove the 'active' class from all sub-tab buttons
//     subTabButtons.forEach(subBtn => {
//       subBtn.classList.remove('active');
//     });

//     // Add the 'active' class to the clicked sub-tab button
//     button.classList.add('active');
//   });
// });

// // Scroll the new container into view
//     //tabs.scrollIntoView({ behavior: 'smooth', block: 'start' });


// ***************************

// /*Mobile Tour Tabs*/
// // Get references to the tab buttons and tab content
// const tabButtons = document.querySelectorAll('.tab-button');
// const tabs = document.querySelectorAll('.tab');

// // Get references to the sub-tab buttons and sub-tab content within Tab 1
// const subTabButtons = document.querySelectorAll('.sub-tab-button');
// const subTabs = document.querySelectorAll('.sub-tab');

// // Set the first tab and sub-tab as active by default
// $(document).ready(function () {
//   $(".dMainTabButton").children(":first-child").addClass('active');
//   $(".dSubTabButton").children(":first-child").addClass('active');

//   $(".mMainTabButton").children(":first-child").addClass('active');
//   $(".mSubTabButton").children(":first-child").addClass('active');

//   $(".tab-content").each(function (index) {
//     $(this).children(":first-child").addClass('active');
//   });

//   $(".sub-tab-content").each(function (index) {
//     $(this).children(":first-child").addClass('active');
//   });
// });

// // Function to scroll tab content into view
// function scrollTabContentIntoView(tab) {
//   if (tab) {
//     tab.scrollIntoView({
//       behavior: 'smooth', // Smooth scrolling animation
//       block: 'start', // Scroll to the top of the tab content
//     });
//   }
// }

// // Add click event listeners to each tab button
// tabButtons.forEach((button, index) => {
//   button.addEventListener('click', () => {
//     // Hide all tabs
//     tabs.forEach((tab) => {
//       tab.classList.remove('active');
//     });

//     // Show the selected tab
//     const tabContent = tabs[index];
//     tabContent.classList.add('active');

//     // Remove the 'active' class from all buttons
//     tabButtons.forEach((btn) => {
//       btn.classList.remove('active');
//     });

//     // Add the 'active' class to the clicked button
//     button.classList.add('active');

//     // Scroll the tab content into view
//     scrollTabContentIntoView(tabContent);
//   });
// });

// // Add click event listeners to sub-tab buttons within Tab 1
// subTabButtons.forEach((button, index) => {
//   button.addEventListener('click', () => {
//     // Hide all sub-tabs within Tab 1
//     subTabs.forEach((subTab) => {
//       subTab.classList.remove('active');
//     });

//     // Show the selected sub-tab within Tab 1
//     const subTabContent = subTabs[index];
//     subTabContent.classList.add('active');

//     // Remove the 'active' class from all sub-tab buttons
//     subTabButtons.forEach((subBtn) => {
//       subBtn.classList.remove('active');
//     });

//     // Add the 'active' class to the clicked sub-tab button
//     button.classList.add('active');

//     // Scroll the sub-tab content into view (optional)
//     scrollTabContentIntoView(subTabContent);
//   });
// });

/*Mobile Tour Tabs*/
document.addEventListener("DOMContentLoaded", function () {
  const tabButtons = document.querySelectorAll(".tab-button");
  const tabs = document.querySelectorAll(".tab");
  const subTabButtons = document.querySelectorAll(".sub-tab-button");
  const subTabs = document.querySelectorAll(".sub-tab");

  // ✅ Ensure the first tab & sub-tab are active by default
  if (tabButtons.length && tabs.length) {
    tabButtons[0].classList.add("active"); // First tab button active
    tabs[0].classList.add("active"); // First tab content active
  }

  if (subTabButtons.length && subTabs.length) {
    subTabButtons[0].classList.add("active"); // First sub-tab button active
    subTabs[0].classList.add("active"); // First sub-tab content active
  }

  // ✅ Add click event listeners to tab buttons
  tabButtons.forEach((button, index) => {
    button.addEventListener("click", () => {
      tabs.forEach((tab) => tab.classList.remove("active"));
      tabButtons.forEach((btn) => btn.classList.remove("active"));

      tabs[index].classList.add("active");
      button.classList.add("active");

      scrollTabContentIntoView(tabs[index]);
    });
  });

  // ✅ Add click event listeners to sub-tab buttons
  subTabButtons.forEach((button, index) => {
    button.addEventListener("click", () => {
      subTabs.forEach((subTab) => subTab.classList.remove("active"));
      subTabButtons.forEach((subBtn) => subBtn.classList.remove("active"));

      subTabs[index].classList.add("active");
      button.classList.add("active");

      scrollTabContentIntoView(subTabs[index]);
    });
  });
});

// ✅ Function to smoothly scroll to the active tab content
function scrollTabContentIntoView(tab) {
  if (tab) {
    tab.scrollIntoView({
      behavior: "smooth",
      block: "start",
    });
  }
}


/**********************/


/*Mobile-Tour-Tab-Collapsible-item-script-pagethree.js (Hotel-Destination)*/
document.addEventListener('DOMContentLoaded', function () {
  const collapsibleButtons = document.querySelectorAll('.collapsible-item');

  collapsibleButtons.forEach(button => {
    button.addEventListener('click', function () {
      this.classList.toggle('active'); // Toggle the "active" class for the clicked button

      const content = this.nextElementSibling; // Get the next sibling element (the collapsible content)

      // Toggle the display of the content
      if (content.style.display === 'block') {
        content.style.display = 'none';
      } else {
        content.style.display = 'block';
        content.style.maxHeight = 'inherit';
        // Scroll the sub-content into view
        // const subContent = content.querySelector('.collapsible-item-content');
        // if (subContent) {
          //subContent.scrollIntoView({ behavior: 'smooth', block: 'start' });
          //}

        // Scroll the new content into view
        content.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });
});


/*------------------------------------------------------------------*/
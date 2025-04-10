// Modal Script
// search-inputs-modal.js
const getModal_searchInputs = document.getElementById('btn_getModal_searchInputs');
const closeModal_searchInputs = document.getElementById('closeModal_searchInputs');
const openModal_searchInputs = document.getElementById('modal_searchInputs');

// Function to open the modal
getModal_searchInputs.addEventListener('click', () => {
	openModal_searchInputs.classList.add("show");
});

// Function to close the modal
closeModal_searchInputs.addEventListener('click', () => {
    openModal_searchInputs.classList.remove("show");
});

// Close the modal if the user clicks outside of it
window.addEventListener('click', (event) => {
	if (event.target === openModal_searchInputs) {
		openModal_searchInputs.classList.remove("show");
	}
});


// *********************************


// search-inputs-city-modal.js
const getModal_searchInputs_city = document.getElementById('btn_getModal_searchInputs_city');
const closeModal_searchInputs_city = document.getElementById('btn_closeModal_searchInputs_city');
const openModal_searchInputs_city = document.getElementById('modal_searchInputs_city');

// Function to open the modal
getModal_searchInputs_city.addEventListener('click', () => {
    openModal_searchInputs_city.classList.add("show");
});

// Function to close the modal
closeModal_searchInputs_city.addEventListener('click', () => {
    openModal_searchInputs_city.classList.remove("show");
});

// Close the modal if the user clicks outside of it
window.addEventListener('click', (event) => {
	if (event.target === openModal_searchInputs_city) {
		openModal_searchInputs_city.classList.remove("show");
	}
});


// *********************************

// search-inputs-date-modal.js
const getModal_searchInputs_date = document.getElementById('btn_getModal_searchInputs_date');
const closeModal_searchInputs_date = document.getElementById('btn_closeModal_searchInputs_date');
const openModal_searchInputs_date = document.getElementById('modal_searchInputs_date');

// Function to open the modal
getModal_searchInputs_date.addEventListener('click', () => {
	openModal_searchInputs_date.classList.add("show");
});

// Function to close the modal
closeModal_searchInputs_date.addEventListener('click', () => {
	openModal_searchInputs_date.classList.remove("show");
});

// Close the modal if the user clicks outside of it
window.addEventListener('click', (event) => {
	if (event.target === openModal_searchInputs_date) {
		openModal_searchInputs_date.classList.remove("show");
	}
});


// *********************************


// search-inputs-travellers-modal.js
const getModal_searchInputs_travellers = document.getElementById('btn_getModal_searchInputs_travellers');
const closeModal_searchInputs_travellers = document.getElementById('btn_closeModal_searchInputs_travellers');
const openModal_searchInputs_travellers = document.getElementById('modal_searchInputs_travellers');

// Function to open the modal
getModal_searchInputs_travellers.addEventListener('click', () => {
	openModal_searchInputs_travellers.classList.add("show");
});

// Function to close the modal
closeModal_searchInputs_travellers.addEventListener('click', () => {
	openModal_searchInputs_travellers.classList.remove("show");
});

// Close the modal if the user clicks outside of it
window.addEventListener('click', (event) => {
	if (event.target === openModal_searchInputs_travellers) {
		openModal_searchInputs_travellers.classList.remove("show");
	}
});


// *********************************


// add-new-room-container-Modal.js
// Get a reference to the "Add Container" button
const addButton = document.getElementById('addContainerButton');

// Select the container which you want to copy
const existingContainer = document.getElementById('guest_container');

// Select the existing container to which you want to append
const appendContainer = document.getElementById('add_new_guest_container');

// Initialize a container counter
let containerCount = 1;

// Add a click event listener to the "Add Container" button
addButton.addEventListener('click', function() {

	// Increment the container counter
      containerCount++;

      // Create a new container element
      const newContainer = document.createElement('div');
      //newContainer.className = 'container_box'; // Add a class for styling (optional)

      // Add content/container and a "Remove Container" button within the new container
      newContainer.innerHTML = existingContainer.innerHTML + `${containerCount}`;

      // Append the new container to the document
      appendContainer.appendChild(newContainer);

      // Scroll the new container into view
      newContainer.scrollIntoView({ behavior: 'smooth', block: 'end' });

      // "Remove Container" button
      const removeButton = newContainer.querySelector('#removeContainerButton');

      removeButton.addEventListener('click', function() {
      // Remove the clicked container
      	appendContainer.removeChild(newContainer);
      });
});
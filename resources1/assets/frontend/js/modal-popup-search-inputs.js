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
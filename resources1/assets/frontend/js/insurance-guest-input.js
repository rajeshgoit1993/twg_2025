// Show Guest Selection Box (Insurance)
document.addEventListener('DOMContentLoaded', function() {
    const guestsBox = document.getElementById('guests-box');
    const guestDetails = document.getElementById('guest-details');
    const guestsInput = document.getElementById('guests-input-box');
    const guestCountDisplay = document.getElementById('guest-count-display');

    document.addEventListener('click', function(event) {
        if (!guestDetails.contains(event.target) && event.target !== guestsBox) {
            guestDetails.classList.add('hidden');
            }
        });

    guestsBox.addEventListener('click', function(event) {
        // Prevent the click event if the guestsBox is intended to be non-interactive (readonly)
        event.preventDefault();
        // Show guest details
        showGuestDetails();
        });

    guestsInput.addEventListener('input', function(event) {
        updateGuestDetailsPreserveAge();
        });

    // Add event listeners for the plus and minus icons
    document.getElementById('increase-guests').addEventListener('click', function() {
        increaseGuestCount();
        });

    document.getElementById('decrease-guests').addEventListener('click', function() {
        decreaseGuestCount();
        });

    function updateGuestDetailsPreserveAge() {
        const guestCount = parseInt(guestsInput.value);
        const ageSelection = document.getElementById('age-selection');
        const selectedAges = [];

        for (let i = 1; i <= guestCount; i++) {
            const selectElement = document.getElementById(`adult-${i}-age`);
            if (i === 1) {
              selectedAges.push(18); // Set the default age for the first guest to 18 years
            } else {
              selectedAges.push(selectElement ? selectElement.value : 18); // Default to 18 if no age is selected
            }
          }

        // Clear any existing age selection items
        ageSelection.innerHTML = '';

        for (let i = 1; i <= guestCount; i++) {
            const ageSelectionItem = document.createElement('div');
            //ageSelectionItem.type = 'text';
            //ageSelectionItem.placeholder = `Age of Guest ${i}`;

            ageSelectionItem.classList.add('age-selection-item');
            ageSelectionItem.innerHTML = `
            <label for="adult-${i}-age" class="ageHeading">GUEST-${i} (Age)</label>
            <div class="age-select-wrapper">
                <select id="adult-${i}-age" name="adult-${i}-age">
                ${generateAgeOptions(1, 80, selectedAges[i - 1])}
                </select>
            <!--<span>years</span>-->
            </div>
            `;
            ageSelection.appendChild(ageSelectionItem);
            }
        }

    function generateAgeOptions(minAge, maxAge, defaultAge) {
        let options = '';
        for (let age = minAge; age <= maxAge; age++) {
            options += `<option value="${age}" ${age === parseInt(defaultAge) ? 'selected' : ''}>${displayAge(age)}</option>`;
            }
        return options;
        }

    function displayAge(age) {
        if (age === 1) {
            return age + " Year";
            } else {
                return age + " Years";
                }
        }

    function increaseGuestCount() {
        if (guestsInput.value < 10) {
            guestsInput.value = parseInt(guestsInput.value) + 1;
            guestCountDisplay.textContent = guestsInput.value; // Update guest count display
            updateGuestDetailsPreserveAge();
            }
        }

    function decreaseGuestCount() {
        if (guestsInput.value > 1) {
            guestsInput.value = parseInt(guestsInput.value) - 1;
            guestCountDisplay.textContent = guestsInput.value; // Update guest count display
            updateGuestDetailsPreserveAge();
            }
        }

    // Initial update when the page loads
    updateGuestDetailsPreserveAge();

    function showGuestDetails() {
        guestDetails.classList.remove('hidden');
        }
});
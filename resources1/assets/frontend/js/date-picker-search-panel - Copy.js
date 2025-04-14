// home search panel datepicker (desktop)
/*$(function() {
    $("#datepicker_holiday").datepicker({
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

//**********************************************************************

/*$(function() {
    $("#datepicker_holiday").datepicker({
        // dateFormat: "d M yy", // Use "yy" for a four-digit year, if needed.
        // dateFormat: "D, d M yy", // Includes day name
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

//**********************************************************************

/*$(function () {
    function applyDatepicker() {
        $("#datepicker_holiday").datepicker("destroy"); // Destroy any existing datepicker instance

        if (window.innerWidth >= 992) {
            // For screens with a min-width of 992px
            $("#datepicker").datepicker({
                dateFormat: "D, d M yy", // Includes day name
                minDate: 0,             // Prevents selecting dates before today
                maxDate: "+6M",         // Limits selection to 6 months ahead
                numberOfMonths: 2       // Show two months simultaneously
            });
        } else {
            // For screens with a max-width less than 992px
            $("#datepicker").datepicker({
                dateFormat: "D, d M yy", // Includes day name
                minDate: 0,             // Prevents selecting dates before today
                maxDate: "+6M",         // Limits selection to 6 months ahead
                numberOfMonths: [6, 1]  // Display the months vertically
            });
        }
    }

    // Apply datepicker on page load
    applyDatepicker();

    // Reapply datepicker on window resize
    $(window).on("resize", function () {
        applyDatepicker();
    });
});*/

//**********************************************************************

// Holiday Calendar Date Style (separate working function) (old-working)
/*$(document).ready(function() {
    // Set the default value to one month from the current date
    var defaultDate = new Date();
    defaultDate.setMonth(defaultDate.getMonth() + 2);

    // Initialize datepicker with default value
    $("#datepicker_holiday").datepicker({
        dateFormat: 'dd M yy',
        defaultDate: defaultDate,
        onSelect: function(selectedDate) {
            // Convert the selected date to a Date object
            var dateObject = new Date(selectedDate);

            // Split the date into day, month, and year
            var day = dateObject.getDate();
            var month = dateObject.toLocaleString('default', { month: 'short' });
            var year = dateObject.toLocaleString('default', { year: '2-digit' });
            var dayName = dateObject.toLocaleString('default', { weekday: 'long' });

            // Update the classes with the corresponding values
            $(".day").text(day);
            $(".month").text(month);
            $(".year").text(year);
            $(".day-name").text(dayName);
            }
        });

    // Extract components from the default date and update styled classes
    var defaultDay = defaultDate.getDate();
    var defaultMonth = defaultDate.toLocaleString('default', { month: 'short' });
    var defaultYear = defaultDate.toLocaleString('default', { year: '2-digit' });
    var defaultDayName = defaultDate.toLocaleString('default', { weekday: 'long' });

    $(".day").text(defaultDay);
    $(".month").text(defaultMonth);
    $(".year").text(defaultYear);
    $(".day-name").text(defaultDayName);

    // Trigger the onSelect event with the default date
    $("#datepicker_holiday").datepicker('setDate', defaultDate);
});*/

//**********************************************************************

// Holiday Calendar Date Style (new-working)
// if not using document ready, js is placed in script tag at the end after dom loaded (important)
/*$(function () {
    // Function to update date components
    function updateDateComponents(date) {
        // Convert the date to a Date object
        var dateObject = new Date(date);

        // Extract components: day, month, year, and day name
        var day = dateObject.getDate();
        var month = dateObject.toLocaleString("default", { month: "short" });
        // var year = dateObject.toLocaleString("default", { year: "2-digit" });
        var year = dateObject.getFullYear();
        var dayName = dateObject.toLocaleString("default", { weekday: "long" });

        // Update the UI with the extracted values
        $("#day-holiday").text(day);
        $("#month-holiday").text(month);
        $("#year-holiday").text(year);
        $("#day-name-holiday").text(dayName);
    }

    // Function to initialize and apply datepicker based on screen width
    function applyHolidayDatepicker() {
        $("#datepicker_holiday").datepicker("destroy"); // Destroy any existing instance

        // Set default date to one month from now
        var defaultDate = new Date();
        defaultDate.setMonth(defaultDate.getMonth() + 2);

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
            options.numberOfMonths = [6, 1]; // Six months vertically
        }

        // Initialize the datepicker with the options
        $("#datepicker_holiday").datepicker(options);

        // Set the default date and trigger the UI update
        $("#datepicker_holiday").datepicker("setDate", defaultDate);
        updateDateComponents(defaultDate);
    }

    // Apply the datepicker on page load
    applyHolidayDatepicker();

    // Reapply datepicker on window resize
    $(window).on("resize", function () {
        applyHolidayDatepicker();
    });
});*/

//*********************

// Insurance-startdate Calendar Date Style (new-working)
/*$(function () {
    // Function to update date components
    function updateDateComponents(date) {
        // Convert the date to a Date object
        var dateObject = new Date(date);

        // Extract components: day, month, year, and day name
        var day = dateObject.getDate();
        var month = dateObject.toLocaleString("default", { month: "short" });
        //var year = dateObject.toLocaleString("default", { year: "2-digit" });
        var year = dateObject.getFullYear();
        var dayName = dateObject.toLocaleString("default", { weekday: "long" });

        // Update the UI with the extracted values
        $("#day-insurance-startdate").text(day);
        $("#month-insurance-startdate").text(month);
        $("#year-insurance-startdate").text(year);
        $("#day-name-insurance-startdate").text(dayName);
    }

    // Function to initialize and apply datepicker based on screen width
    function applyInsuranceStartdateDatepicker() {
        $("#datepicker_insurance_startdate").datepicker("destroy"); // Destroy any existing instance

        // Set default date to 10 days from now
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
            options.numberOfMonths = [6, 1]; // Six months vertically
        }

        // Initialize the datepicker with the options
        $("#datepicker_insurance_startdate").datepicker(options);

        // Set the default date and trigger the UI update
        $("#datepicker_insurance_startdate").datepicker("setDate", defaultDate);
        updateDateComponents(defaultDate);
    }

    // Apply the datepicker on page load
    applyInsuranceStartdateDatepicker();

    // Reapply datepicker on window resize
    $(window).on("resize", function () {
        applyInsuranceStartdateDatepicker();
    });
});*/

//*********************

// Insurance-enddate Calendar Date Style (new-working)
/*$(function () {
    // Function to update date components
    function updateDateComponents(date) {
        // Convert the date to a Date object
        var dateObject = new Date(date);

        // Extract components: day, month, year, and day name
        var day = dateObject.getDate();
        var month = dateObject.toLocaleString("default", { month: "short" });
        //var year = dateObject.toLocaleString("default", { year: "2-digit" });
        var year = dateObject.getFullYear();
        var dayName = dateObject.toLocaleString("default", { weekday: "long" });

        // Update the UI with the extracted values
        $("#day-insurance-enddate").text(day);
        $("#month-insurance-enddate").text(month);
        $("#year-insurance-enddate").text(year);
        $("#day-name-insurance-enddate").text(dayName);
    }

    // Function to initialize and apply datepicker based on screen width
    function applyInsuranceEndateDatepicker() {
        $("#datepicker_insurance_enddate").datepicker("destroy"); // Destroy any existing instance

        // Set default date to 15 days from now
        var defaultDate = new Date();
        defaultDate.setDate(defaultDate.getDate() + 15);

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
            options.numberOfMonths = [6, 1]; // Six months vertically
        }

        // Initialize the datepicker with the options
        $("#datepicker_insurance_enddate").datepicker(options);

        // Set the default date and trigger the UI update
        $("#datepicker_insurance_enddate").datepicker("setDate", defaultDate);
        updateDateComponents(defaultDate);
    }

    // Apply the datepicker on page load
    applyInsuranceEndateDatepicker();

    // Reapply datepicker on window resize
    $(window).on("resize", function () {
        applyInsuranceEndateDatepicker();
    });
});*/

//**********************************************************************

// combined function of holiday + insurance datepicker
$(function () {
    // Function to update date components
    function updateDateComponents(date, prefix) {
        var dateObject = new Date(date);
        $("#day-" + prefix).text(dateObject.getDate());
        $("#month-" + prefix).text(dateObject.toLocaleString("default", { month: "short" }));
        $("#year-" + prefix).text(dateObject.getFullYear());
        $("#day-name-" + prefix).text(dateObject.toLocaleString("default", { weekday: "long" }));
    }

    // Function to initialize and apply datepicker
    function applyDatepicker(selector, prefix, defaultOffset) {
        $(selector).datepicker("destroy"); // Destroy previous datepicker instance

        var defaultDate = new Date();
        defaultDate.setDate(defaultDate.getDate() + defaultOffset); // Add specific days

        const options = {
            dateFormat: "D, d M yy",
            defaultDate: defaultDate,
            minDate: 0,
            maxDate: "+6M",
            onSelect: function (selectedDate) {
                updateDateComponents(selectedDate, prefix);
            }
        };

        options.numberOfMonths = window.innerWidth >= 992 ? 2 : [6, 1]; // Adjust months view
        $(selector).datepicker(options);
        $(selector).datepicker("setDate", defaultDate);
        updateDateComponents(defaultDate, prefix);
    }

    // Initialize all datepickers with correct offsets
    applyDatepicker("#datepicker_holiday", "holiday", 60); // Holiday in 60 days
    applyDatepicker("#datepicker_insurance_startdate", "insurance-startdate", 10); // Insurance start in 10 days
    applyDatepicker("#datepicker_insurance_enddate", "insurance-enddate", 15); // Insurance end in 15 days

    // Reapply on window resize
    $(window).on("resize", function () {
        applyDatepicker("#datepicker_holiday", "holiday", 60);
        applyDatepicker("#datepicker_insurance_startdate", "insurance-startdate", 10);
        applyDatepicker("#datepicker_insurance_enddate", "insurance-enddate", 15);
    });
});

//**********************************************************************

// datepicker (jquery)
// $(function() {
//   $("#datepicker" ).datepicker({ dateFormat: "d M y", })
// });

// if using document ready, js is placed in Head tag (important)
/*$(document).ready(function () {
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
        $("#datepicker").datepicker("destroy"); // Destroy any existing instance

        // Set default date to one month from now
        var defaultDate = new Date();
        defaultDate.setMonth(defaultDate.getMonth() + 1);

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
            options.numberOfMonths = [6, 1]; // Six months vertically
        }

        // Initialize the datepicker with the options
        $("#datepicker").datepicker(options);

        // Set the default date and trigger the UI update
        $("#datepicker").datepicker("setDate", defaultDate);
        updateDateComponents(defaultDate);
    }

    // Apply the datepicker on page load
    applyDatepicker();

    // Reapply datepicker on window resize
    $(window).on("resize", function () {
        applyDatepicker();
    });
});*/

/*$(document).ready(function () {
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
        // Start Date Picker
        $("#datepicker_startdate_insurance").datepicker("destroy"); // Destroy any existing instance
        var startDate = new Date();
        startDate.setDate(startDate.getDate() + 2); // Default start date (2 days from now)

        const startOptions = {
            dateFormat: "D, d M yy", // Includes day name
            defaultDate: startDate,
            minDate: 0, // Prevents selecting past dates
            maxDate: "+6M", // Prevents selecting more than 6 months ahead
            onSelect: function (selectedDate) {
                updateDateComponents(selectedDate); // Update UI on date select
            }
        };

        // Adjust the number of months displayed based on screen width
        if (window.innerWidth >= 992) {
            startOptions.numberOfMonths = 2; // Two months side by side
        } else {
            startOptions.numberOfMonths = [6, 1]; // Six months vertically
        }

        // Initialize the start datepicker with the options
        $("#datepicker_startdate_insurance").datepicker(startOptions);
        $("#datepicker_startdate_insurance").datepicker("setDate", startDate);
        updateDateComponents(startDate);

        // End Date Picker
        $("#datepicker_enddate_insurance").datepicker("destroy"); // Destroy any existing instance
        var endDate = new Date();
        endDate.setDate(endDate.getDate() + 10); // Default end date (10 days from now)

        const endOptions = {
            dateFormat: "D, d M yy", // Includes day name
            defaultDate: endDate,
            minDate: 0, // Prevents selecting past dates
            maxDate: "+6M", // Prevents selecting more than 6 months ahead
            onSelect: function (selectedDate) {
                updateDateComponents(selectedDate); // Update UI on date select
            }
        };

        // Adjust the number of months displayed based on screen width
        if (window.innerWidth >= 992) {
            endOptions.numberOfMonths = 2; // Two months side by side
        } else {
            endOptions.numberOfMonths = [6, 1]; // Six months vertically
        }

        // Initialize the end datepicker with the options
        $("#datepicker_enddate_insurance").datepicker(endOptions);
        $("#datepicker_enddate_insurance").datepicker("setDate", endDate);
        updateDateComponents(endDate);
    }

    // Apply the datepicker on page load
    applyDatepicker();

    // Reapply datepicker on window resize
    $(window).on("resize", function () {
        applyDatepicker();
    });
});*/

//**********************************************************************

/*holiday and insurance datpicker*/
/*$(document).ready(function () {
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
        // Common options for all datepickers
        var commonOptions = {
            // dateFormat: "d M yy", // Use "yy" for a four-digit year, if needed.
            dateFormat: "D, d M yy", // Includes day name
            // changeMonth: true,    // Allows month selection from a dropdown.
            // changeYear: true,     // Allows year selection from a dropdown.
            minDate: 0,           // Prevents selecting dates before today.
            maxDate: "+12M",       // Limits selection to 6 months ahead.
            // numberOfMonths: [2, 1], // To display the months vertically
            // stepMonths: 2, // Moves two months at a time when navigating.
            // showButtonPanel: true // Optional: Adds "Today" and "Done" buttons

            onSelect: function (selectedDate) {
                updateDateComponents(selectedDate); // Update UI on date select
            }
        };

        // Adjust the number of months displayed based on screen width
        if (window.innerWidth >= 992) {
            commonOptions.numberOfMonths = 2; // Two months side by side
        } else {
            commonOptions.numberOfMonths = [6, 1]; // Six months vertically
        }

        // Holiday Date Picker (#datepicker_holiday)
        $("#datepicker_holiday").datepicker("destroy"); // Destroy any existing instance
        var holidayDate = new Date();
        holidayDate.setMonth(holidayDate.getMonth() + 1); // Default holiday date (1 month from now)
        commonOptions.defaultDate = holidayDate;

        // Initialize the holiday datepicker
        $("#datepicker_holiday").datepicker(commonOptions);
        $("#datepicker_holiday").datepicker("setDate", holidayDate);
        updateDateComponents(holidayDate);

        // Start Date Picker (#datepicker_startdate_insurance)
        $("#datepicker_startdate_insurance").datepicker("destroy"); // Destroy any existing instance
        var startDate = new Date();
        startDate.setDate(startDate.getDate() + 2); // Default start date (2 days from now)
        commonOptions.defaultDate = startDate;

        // Initialize the start datepicker
        $("#datepicker_startdate_insurance").datepicker(commonOptions);
        $("#datepicker_startdate_insurance").datepicker("setDate", startDate);
        updateDateComponents(startDate);

        // End Date Picker (#datepicker_enddate_insurance)
        $("#datepicker_enddate_insurance").datepicker("destroy"); // Destroy any existing instance
        var endDate = new Date();
        endDate.setDate(endDate.getDate() + 10); // Default end date (10 days from now)
        commonOptions.defaultDate = endDate;

        // Initialize the end datepicker
        $("#datepicker_enddate_insurance").datepicker(commonOptions);
        $("#datepicker_enddate_insurance").datepicker("setDate", endDate);
        updateDateComponents(endDate);
    }

    // Apply the datepicker on page load
    applyDatepicker();

    // Reapply datepicker on window resize
    $(window).on("resize", function () {
        applyDatepicker();
    });
});*/

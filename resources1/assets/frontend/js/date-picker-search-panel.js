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
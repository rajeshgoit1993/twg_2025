/*// Calendar Date Style
$(document).ready(function() {
    // Set the default value to one month from the current date
    var defaultDate = new Date();
    defaultDate.setMonth(defaultDate.getMonth() + 2);

    // Initialize datepicker with default value
    $("#datepicker").datepicker({
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
    $("#datepicker").datepicker('setDate', defaultDate);
    });*/
/*quotation*/

/*combined date and time capture script*/
document.addEventListener('DOMContentLoaded', function() {
    function updateCurrentDateTime() {
        var now = new Date();
        var year = now.getFullYear();
        var month = String(now.getMonth() + 1).padStart(2, '0');
        var date = String(now.getDate()).padStart(2, '0');
        var hours = String(now.getHours()).padStart(2, '0');
        var minutes = String(now.getMinutes()).padStart(2, '0');
        var seconds = String(now.getSeconds()).padStart(2, '0');

        var currentDate = year + '-' + month + '-' + date;
        var formattedDate = date + ' ' + now.toLocaleString('default', { month: 'short' }) + ' ' + year;
        var currentTime = hours + ':' + minutes + ':' + seconds;

        // Update all visible, disabled inputs for date
        var dateDisplayInputs = document.querySelectorAll('.date_display');
        dateDisplayInputs.forEach(function(input) {
            input.value = formattedDate;
        });

        // Update all visible, disabled inputs for time
        var timeDisplayInputs = document.querySelectorAll('.time_display');
        timeDisplayInputs.forEach(function(input) {
            input.value = currentTime;
        });

        // Update all hidden inputs for date and time
        var hiddenInputs = document.querySelectorAll('.datetimestamp');
        hiddenInputs.forEach(function(input) {
            input.value = currentDate + ' ' + currentTime;
        });
    }

    // Update the date and time initially
    updateCurrentDateTime();

    // Update the date and time every second to show a live clock
    setInterval(updateCurrentDateTime, 1000);

    // Update the date and time right before any form is submitted
    var forms = document.querySelectorAll('form');
    forms.forEach(function(form) {
        form.addEventListener('submit', function() {
            updateCurrentDateTime();
        });
    });
});

/***********************************************/

/*separate date and time capture script*/
/*document.addEventListener('DOMContentLoaded', function() {
    function updateCurrentDateTime() {
        var now = new Date();
        var year = now.getFullYear();
        var month = String(now.getMonth() + 1).padStart(2, '0');
        var date = String(now.getDate()).padStart(2, '0');
        var hours = String(now.getHours()).padStart(2, '0');
        var minutes = String(now.getMinutes()).padStart(2, '0');
        var seconds = String(now.getSeconds()).padStart(2, '0');

        var currentDate = year + '-' + month + '-' + date;
        var formattedDate = date + ' ' + now.toLocaleString('default', { month: 'short' }) + ' ' + year;
        var currentTime = hours + ':' + minutes + ':' + seconds;

        // Update all visible, disabled inputs for date
        var dateDisplayInputs = document.querySelectorAll('.date_display');
        dateDisplayInputs.forEach(function(input) {
            input.value = formattedDate;
        });

        // Update all visible, disabled inputs for time
        var timeDisplayInputs = document.querySelectorAll('.time_display');
        timeDisplayInputs.forEach(function(input) {
            input.value = currentTime;
        });

        // Update all hidden inputs for date
        var dateHiddenInputs = document.querySelectorAll('.date_hidden');
        dateHiddenInputs.forEach(function(input) {
            input.value = currentDate;
        });

        // Update all hidden inputs for time
        var timeHiddenInputs = document.querySelectorAll('.time_hidden');
        timeHiddenInputs.forEach(function(input) {
            input.value = currentTime;
        });
    }

    // Update the date and time initially
    updateCurrentDateTime();

    // Update the date and time every second to show a live clock
    setInterval(updateCurrentDateTime, 1000);

    // Update the date and time right before any form is submitted
    var forms = document.querySelectorAll('form');
    forms.forEach(function(form) {
        form.addEventListener('submit', function() {
            updateCurrentDateTime();
        });
    });
});*/
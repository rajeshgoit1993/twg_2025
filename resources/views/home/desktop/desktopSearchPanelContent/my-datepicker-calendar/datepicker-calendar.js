/*!
 * datepicker-calendar
 */
  /*Two Months Display*/
    document.addEventListener('DOMContentLoaded', function() {
      var calendarContainer = document.getElementById('calendar');
      var calendarContainerWrapper = document.getElementById('calendar-container');
      var prevButton = document.getElementById('prevButton');
      var todayButton = document.getElementById('todayButton');
      var nextButton = document.getElementById('nextButton');
      var currentDate = new Date();
      var currentMonth = currentDate.getMonth();
      var currentYear = currentDate.getFullYear();

      // Two Months Display Starts
      function renderCalendar() {
        calendarContainer.innerHTML = ''; // Clear the container
        for (var monthOffset = 0; monthOffset < 2; monthOffset++) {
          var displayMonth = (currentMonth + monthOffset) % 12;
          var displayYear = currentYear + Math.floor((currentMonth + monthOffset) / 12);
          var firstDay = new Date(displayYear, displayMonth, 1);
          var lastDay = new Date(displayYear, displayMonth + 1, 0);
          var daysInMonth = lastDay.getDate();

          var calendarHTML = '<table class="dayPicker-Month">';
          calendarHTML += '<thead><tr><th class="monthHeading" colspan="7">' + getMonthName(displayMonth) + ' ' + displayYear + '</th></tr></thead>';
          calendarHTML += '<thead><tr><th class="weekDay">Sun</th><th class="weekDay">Mon</th><th class="weekDay">Tue</th><th class="weekDay">Wed</th><th class="weekDay">Thu</th><th class="weekDay">Fri</th><th class="weekDay">Sat</th></tr></thead>';
          calendarHTML += '<tbody class="DayPicker-Body">';

          var dayCounter = 1;
          var dayOfWeek = firstDay.getDay();

          for (var i = 0; i < 6; i++) {
            calendarHTML += '<tr>';
            for (var j = 0; j < 7; j++) {
              if ((i === 0 && j < dayOfWeek) || dayCounter > daysInMonth) {
                calendarHTML += '<td class="DayPicker-Day"></td>';
                } else {
                  var date = new Date(displayYear, displayMonth, dayCounter);
                  var isSelected = date.toDateString() === currentDate.toDateString() ? 'class="DayPicker-Day DayPicker-Day-selected"' : '';
                  var isNonSelectedNonEmpty = isSelected === '' ? 'class="DayPicker-Day"' : '';
                  calendarHTML += '<td ' + isSelected + isNonSelectedNonEmpty + ' data-date="' + date.toISOString() + '">' + dayCounter + '</td>';

                  dayCounter++;
                }
              }
            calendarHTML += '</tr>';
            if (dayCounter > daysInMonth) {
              break;
            }
          }

          calendarHTML += '</tbody></table>';
          calendarContainer.innerHTML += calendarHTML;
        }

        var days = calendarContainer.querySelectorAll('td');
        days.forEach(function(day) {
          day.addEventListener('click', function() {
            var selectedDate = new Date(this.getAttribute('data-date'));
            currentDate = selectedDate;
            renderCalendar();
          });
        });
      }

      function getMonthName(month) {
        var months = [
          'January', 'February', 'March', 'April', 'May', 'June',
          'July', 'August', 'September', 'October', 'November', 'December'
        ];
        return months[month];
      }

      function updateCalendar(direction) {
        if (direction === 'prev') {
          currentMonth--;
          if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;

          /*currentMonth -= 2;
          if (currentMonth < 0) {
            currentMonth += 12;
            currentYear--;*/
          }
        } else if (direction === 'next') {
          currentMonth++;
          if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
          /*currentMonth += 2;
          if (currentMonth > 11) {
            currentMonth -= 12;
            currentYear++;*/
          }
        }
        renderCalendar();
      }

      prevButton.addEventListener('click', function() {
        updateCalendar('prev');
      });

      todayButton.addEventListener('click', function() {
        currentDate = new Date();  // Set current date to today
        currentMonth = currentDate.getMonth();
        currentYear = currentDate.getFullYear();
        renderCalendar();
      });

      nextButton.addEventListener('click', function() {
        updateCalendar('next');
      });

      // Load additional months on scroll Starts
      /*calendarContainerWrapper.addEventListener('scroll', function () {
        if (calendarContainerWrapper.scrollTop + calendarContainerWrapper.clientHeight >= calendarContainer.offsetHeight - 50) {
            // Load additional months when reaching near the bottom
            updateCalendar('next');
            }
          });*/
      // Load additional months on scroll Ends

      renderCalendar();
    });
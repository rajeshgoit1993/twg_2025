  /*my trips*/
  // document.addEventListener('DOMContentLoaded', function() {
  //   var defaultTab = document.querySelector('.tablinks[data-tab="upcoming"]');
  //   console.log("Default Tab:", defaultTab);
  //   if (defaultTab) {
  //     var contentName = defaultTab.getAttribute('data-tab');
  //     console.log("Content Name:", contentName);
  //     openTab(null, contentName);
  //     } else {
  //       // If the default tab is not available, find the next available tab
  //       var tabs = document.querySelectorAll('.tablinks[data-tab]');
  //       for (var i = 0; i < tabs.length; i++) {
  //         var tab = tabs[i];
  //         var contentName = tab.getAttribute('data-tab');
  //         var content = document.getElementById(contentName);
  //         if (content) {
  //           openTab(null, contentName);
  //           break;
  //           }
  //         }
  //       }
  //   });

  // function openTab(evt, contentName) {
  //   console.log("Opening tab:", contentName);
  //   var i, tabcontent, tablinks;
  //   tabcontent = document.getElementsByClassName("tripTabContent");
  //   for (i = 0; i < tabcontent.length; i++) {
  //     tabcontent[i].style.display = "none";
  //     }
  //   tablinks = document.getElementsByClassName("tablinks");
  //   for (i = 0; i < tablinks.length; i++) {
  //     tablinks[i].classList.remove("active");
  //     }
  //   document.getElementById(contentName).style.display = "block";
  //   if (evt) {
  //     evt.currentTarget.classList.add("active");
  //     } else {
  //       var defaultTab = document.querySelector('.tablinks[data-tab="' + contentName + '"]');
  //       if (defaultTab) {
  //       defaultTab.classList.add("active");
  //       }
  //     }
  //   }

  document.addEventListener('DOMContentLoaded', function() {

    // tabs button script
    // Get all tablinks and add event listeners
    var tablinks = document.getElementsByClassName("tablinks");

    for (var i = 0; i < tablinks.length; i++) {
        tablinks[i].addEventListener('click', function (event) {
            var contentName = this.getAttribute('data-target');  // Use data-target to find content
            openTab(event, contentName);
        });
    }

    // Automatically click the default tab on load
    var defaultTab = document.getElementById('defaultOpen');
    // var mdefaultTab = document.getElementById('mdefaultOpen');

    if (defaultTab) {
        defaultTab.click(); // Trigger click on the default tab (Desktop)
    }

    // if (mdefaultTab) {
    //     mdefaultTab.click(); // Trigger click on the default tab (Mobile)
    // }
  });

  function openTab(evt, contentName) {
    var i, tabcontent, tablinks;
    
    // Hide all tab content
    tabcontent = document.getElementsByClassName("tripTabContent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Remove "active" class from all tab links
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the clicked tab's content and add the "active" class to the tab
    document.getElementById(contentName).style.display = "block";
    evt.currentTarget.className += " active";
  }

  /******************************************************/

  $(document).ready(function() {
    // $(".quote_no").prop( "disabled", true );
    $(".quote_no").attr("disabled",true);
    $(".unique_code").attr("disabled",true);

    $(document).on("click",".pay_now",function() {
      var unique_code=$(this).siblings(".unique_code").val();
      var quote_no=$(this).siblings(".quote_no").val();
      var token =  jQuery('input[name="_token"]').val()

      var content_action=jQuery(this).attr("content_action");
      var form = document.createElement("form");
      form.setAttribute("method", "post");
      form.setAttribute("action", content_action);
      form.setAttribute("target", "");

      var hiddenField = document.createElement("input");
      hiddenField.setAttribute("type", "hidden");
      hiddenField.setAttribute("name", "_token");
      hiddenField.setAttribute("value", token);
      form.appendChild(hiddenField);

      var second_field = document.createElement("input");
      second_field.setAttribute("type", "hidden");
      second_field.setAttribute("name", "quote_no");
      second_field.setAttribute("value", quote_no);
      form.appendChild(second_field);
      document.body.appendChild(form);

      var third_field = document.createElement("input");
      third_field.setAttribute("type", "hidden");
      third_field.setAttribute("name", "unique_code");
      third_field.setAttribute("value", unique_code);
      form.appendChild(third_field);
      document.body.appendChild(form);
      //window.open('', 'view');
      //window.open('','view' ); 

      form.submit();
      })
  });
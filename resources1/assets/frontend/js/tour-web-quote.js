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

    /*--------------------------------------------------------------------------------*/

// desktop and mobile page based on width
if (jQuery(window).width() >= 992) {
    jQuery(".mobile_test_exp").html("");
} else {
    jQuery(".destop_test_exp").html("");
}

// ****************************

$(document).ready(function() {
    $(".flightTiming").each(function() {
        var mystring = $(this).html();
        var new_string = mystring.replaceAll(' ', '');
        $(this).html('').html(new_string);
    });

    $(".mflightTiming").each(function() {
        var mystring = $(this).html();
        var new_string = mystring.replaceAll(' ', '');
        $(this).html('').html(new_string);
    });

  $(document).on("click", ".previous_raise", function() {
    var quotation_ref_no = $(this).attr('id');
    var APP_URL = $("#APP_URL").val();
      
    $.ajax({
          url: APP_URL + '/get_previous_raise',
          data: { quotation_ref_no: quotation_ref_no },
          type: 'get',
          // contentType: false,
          // processData: false,

          success: function(data) {
              $(".previous_raise_data").html('').html(data);
              $('#previous_raise').modal('toggle');
          },
          error: function(data) {
              // Handle the error here
          }
    });
  });

  // *******

  $(document).on("submit", "#store_raise", function(event) {
    event.preventDefault();

    $('#myModal').modal('hide');

    var form_data = new FormData($("#store_raise")[0]);
    var APP_URL = $("#APP_URL").val();

    $.ajax({
      url: APP_URL + '/store_raise',
      data: form_data,
      type: 'post',
      contentType: false,
      processData: false,

      success: function(data) {
        $('#add_item_modal').modal('hide');
              
        if (data.message == 'success') {
          swal({
            title: "Done !",
            text: "Successfully Submitted.",
            type: "success",
            timer: 2000
          });

          $(".btnRaiseConcern_button").html('').html(
            '<button type="button" class="btnMain btnRaiseConcern previous_raise" id="' + data.ref_no + '">&#x1F6C8;</button>'
          );
          // alert(data)
          // location.reload()
        } else {
          swal({
            title: "Error !",
            text: data.message,
            type: "error",
            timer: 2000
          });
        }
      },
      error: function(data) {
        // Handle the error here
        }
    });
  });

  // *******

  // Disable quote_no input
  $(".quote_no").attr("disabled", true);

  $(document).on("click", ".pay_now", function() {
        var unique_code = $(this).siblings(".unique_code").val();
        var quote_no = $(this).siblings(".quote_no").val();
        var token = jQuery('input[name="_token"]').val();
        var content_action = jQuery(this).attr("content_action");

        // Create form element
        var form = document.createElement("form");
        form.setAttribute("method", "post");
        form.setAttribute("action", content_action);
        form.setAttribute("target", "");

        // Create and append token input
        var hiddenField = document.createElement("input");
        hiddenField.setAttribute("type", "hidden");
        hiddenField.setAttribute("name", "_token");
        hiddenField.setAttribute("value", token);
        form.appendChild(hiddenField);

        // Create and append quote_no input
        var second_field = document.createElement("input");
        second_field.setAttribute("type", "hidden");
        second_field.setAttribute("name", "quote_no");
        second_field.setAttribute("value", quote_no);
        form.appendChild(second_field);

        // Create and append unique_code input
        var third_field = document.createElement("input");
        third_field.setAttribute("type", "hidden");
        third_field.setAttribute("name", "unique_code");
        third_field.setAttribute("value", unique_code);
        form.appendChild(third_field);

        // Append form to body and submit
        document.body.appendChild(form);
        form.submit();
  });
});

// ****************************

jQuery(document).ready(function() {
    jQuery(document).on("click", ".user_quote_accept", function(e) {
        e.preventDefault();

        var token = jQuery('input[name="_token"]').val();
        var content_id = jQuery(this).attr("content_id");
        var content_action = jQuery(this).attr("content_action");

        // Create form element
        var form = document.createElement("form");
        form.setAttribute("method", "post");
        form.setAttribute("action", content_action);
        form.setAttribute("target", "");

        // Create and append token input
        var hiddenField = document.createElement("input");
        hiddenField.setAttribute("type", "hidden");
        hiddenField.setAttribute("name", "_token");
        hiddenField.setAttribute("value", token);
        form.appendChild(hiddenField);

        // Create and append quote_id input
        var second_field = document.createElement("input");
        second_field.setAttribute("type", "hidden");
        second_field.setAttribute("name", "quote_id");
        second_field.setAttribute("value", content_id);
        form.appendChild(second_field);

        // Append form to body and submit
        document.body.appendChild(form);
        // window.open('', 'view');
        // window.open('','view');
        form.submit();
    });

    // rejection reason
    jQuery(".rejectionReasonCont").css('display', "none");
});

// ****************************

document.addEventListener('DOMContentLoaded', function() {
  // foldable script
    const collapsibleButtons = document.querySelectorAll('.foldable');

    collapsibleButtons.forEach(button => {
        button.addEventListener('click', function() {
            this.classList.toggle('active');
            const content = this.nextElementSibling;
            if (content.style.display === 'block') {
                content.style.display = 'none';
                content.style.maxHeight = '0';
            } else {
                content.style.display = 'block';
                content.style.maxHeight = 'inherit';
                // Scroll the sub-content into view
                // const subContent = content.querySelector('.sub-content');
                // if (subContent) {
                //  subContent.scrollIntoView({ behavior: 'smooth' });
                // }
            }
        });
    });


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
    var mdefaultTab = document.getElementById('mdefaultOpen');

    if (defaultTab) {
        defaultTab.click(); // Trigger click on the default tab (Desktop)
    }

    if (mdefaultTab) {
        mdefaultTab.click(); // Trigger click on the default tab (Mobile)
    }
});

function openTab(evt, contentName) {
    var i, tabcontent, tablinks;
    
    // Hide all tab content
    tabcontent = document.getElementsByClassName("tabcontent");
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
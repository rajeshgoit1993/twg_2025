/*Search Panel Header Starts (desktop & mobile)*/
// Get references to the tab buttons and tab content
document.addEventListener('DOMContentLoaded', function() {
  const tabButtons = document.querySelectorAll('.nav-item');
   const tabs = document.querySelectorAll('.tab');

  // Get references to the sub-tab buttons and sub-tab content within Tab 1
  const subTabButtons = document.querySelectorAll('.sub-nav-item');
  const subTabs = document.querySelectorAll('.sub-tab');

  // Set the first tab and its first sub-tab as active by default
  tabs[0].classList.add('active');
  tabButtons[0].classList.add('active');
  subTabs[0].classList.add('active');
  subTabButtons[0].classList.add('active');

  // Add click event listeners to each tab button
  tabButtons.forEach((button, index) => {
    button.addEventListener('click', () => {
      // Hide all tabs
      tabs.forEach(tab => {
        tab.classList.remove('active');
        });

      // Show the selected tab
      tabs[index].classList.add('active');

      // Remove the 'active' class from all buttons
      tabButtons.forEach(btn => {
        btn.classList.remove('active');
        });

      // Add the 'active' class to the clicked button
      button.classList.add('active');
      });

    });

  // Add click event listeners to sub-tab buttons within Tab 1
  subTabButtons.forEach((button, index) => {
    button.addEventListener('click', () => {
      // Hide all sub-tabs within Tab 1
      subTabs.forEach(subTab => {
        subTab.classList.remove('active');
        });

      // Show the selected sub-tab within Tab 1
      subTabs[index].classList.add('active');

      // Remove the 'active' class from all sub-tab buttons
      subTabButtons.forEach(subBtn => {
        subBtn.classList.remove('active');
        });

      // Add the 'active' class to the clicked sub-tab button
      button.classList.add('active');
      });
    });
  });

/***********************************************/

// holiday destination search box (search panel)
/*$(document).ready(function() {
  jQuery('.select2').select2();
  // holiday search box results
  jQuery('.select3').select2({
      placeholder: "To",
      allowClear: true,
      ajax:{
        url: jQuery("#APP_URL").val()+'/search-destination',
        type: "get",
        dataType: 'json',
        delay: 250,
        data: function (params) {
          return {
            searchTerm: params.term //search term
            };
          },
        processResults: function (response) {
          return {
            results: response
            };
          },
        cache: true
        }
      });

  // holiday destination search by theme (search panel)
  jQuery(document).on('change.select2','.package_service', function(e) {
      var data_value=jQuery(this).val();
      $("#destination_search").val(data_value);
      $("#response").html("");
      var APP_URL=$("#APP_URL").val();
      var url=APP_URL+'/search_theme';
      var data={search_theme:data_value,_token:"{{ csrf_token() }}"};
      $.post(url,data,function(rdata) {
        console.log(rdata)
        $("#select_theme").html(rdata);
        })
      });
  })*/

/***********************************************/

// more tour packages (working with echo in controller)
/*$(document).ready(function() {
  // double click removal
  $(document).on("click", ".add_more_pkg", function(e) {
    var $this = $(this);
    var content_type = $this.attr("content_type");
    if ($this.hasClass('clicked')) {
      $this.removeClass('clicked');
      add_packages(content_type);
      // Your code for double click
      } else {
        $this.addClass('clicked');
        setTimeout(function() {
          if ($this.hasClass('clicked')) {
            $this.removeClass('clicked');
            add_packages(content_type);
            // Your code for single click
            }
          }, 500);
        }
    });

  // load-more-packages
  function add_packages(content_type) {
    var custom_length, id, dynamic_pkg_add, load_more_packages;
    if (content_type == 'demostic' || content_type == 'demostic_mobile') {
      custom_length = $(".custom_length_demostic").length;
      id = $("input[name='pack_id_list_demostic[]']").map(function() { return $(this).val(); }).get();
      dynamic_pkg_add = "dynamic_pkg_add_domestic";
      load_more_packages = 'india-packages';
      } else if (content_type == 'international' || content_type == 'international_mobile') {
        custom_length = $(".custom_length").length;
        id = $("input[name='pack_id_list[]']").map(function() { return $(this).val(); }).get();
        dynamic_pkg_add = "dynamic_pkg_add";
        load_more_packages = 'international-packages';
        }
    var APP_URL = $("#APP_URL").val();
    var url = APP_URL + '/add_package';
    var data = { id: id, custom_length: custom_length, content_type: content_type, _token: "{{ csrf_token() }}" };

    $.get(url, data, function(rdata) {
      if (rdata != "0" && rdata != "" && custom_length < "12") {
        $("." + load_more_packages).css("display", "none");
        }
      $("#" + dynamic_pkg_add).append(rdata);
        LazyLoad.update();
        });
  }  
});*/

// add more packages
/*$(document).ready(function() {
  // Event listener for the 'add_more_pkg' button click
  $(document).on("click", ".add_more_pkg", function(e) {
    var $this = $(this); // Store the clicked element
    var content_type = $this.attr("content_type"); // Get the content type from the element's attribute

    // Check if the button has already been clicked (to prevent double-click)
    if ($this.hasClass('clicked')) {
      $this.removeClass('clicked'); // Remove the clicked class
      add_packages(content_type); // Call the function to load more packages
      // Handle double-click scenario
    } else {
      $this.addClass('clicked'); // Add the clicked class
      // Wait for 500ms to detect single click
      setTimeout(function() {
        if ($this.hasClass('clicked')) {
          $this.removeClass('clicked'); // Remove the clicked class after timeout
          add_packages(content_type); // Call the function to load more packages
          // Handle single-click scenario
        }
      }, 500); // Single click timeout duration
    }
  });

  // Function to add more packages based on content type
  function add_packages(content_type) {
    var custom_length, id, dynamic_pkg_add, load_more_packages;

    // Handle different content types (domestic or international)
    if (content_type == 'domestic' || content_type == 'domestic_mobile') {
      custom_length = $(".custom_length_demostic").length; // Get the length of domestic custom packages
      id = $("input[name='pack_id_list_demostic[]']").map(function() {
        return $(this).val(); // Get all domestic package IDs
      }).get();
      dynamic_pkg_add = "dynamic_pkg_add_domestic"; // Dynamic element ID for domestic
      load_more_packages = 'india-packages'; // Load more button class for domestic
    } else if (content_type == 'international' || content_type == 'international_mobile') {
      custom_length = $(".custom_length").length; // Get the length of international custom packages
      id = $("input[name='pack_id_list[]']").map(function() {
        return $(this).val(); // Get all international package IDs
      }).get();
      dynamic_pkg_add = "dynamic_pkg_add"; // Dynamic element ID for international
      load_more_packages = 'international-packages'; // Load more button class for international
    }

    // Get the application URL and CSRF token
    var APP_URL = $("#APP_URL").val();
    var csrfToken = $("#csrf_token").val(); // Get the CSRF token from hidden input
    var url = APP_URL + '/add_package'; // URL to send the request
    var data = {
      id: id,
      custom_length: custom_length,
      content_type: content_type,
      _token: csrfToken // Include CSRF token in the data
    };

    // Perform the AJAX request to load more packages
    $.ajax({
      url: url, // URL for the AJAX request
      method: 'GET', // Use GET request to fetch data
      data: data, // Send the necessary data with the request
      success: function(rdata) {
        // On success, check if the response is not empty and update the page
        if (rdata !== "0" && rdata !== "" && custom_length < 12) {
          $("." + load_more_packages).css("display", "none"); // Hide the load more button if packages are loaded
        }
        $("#" + dynamic_pkg_add).append(rdata); // Append the new packages to the dynamic section
        
        // Trigger lazy loading for newly loaded elements (lazy-loading.js, not working here)
        // if (typeof lazyload === "function") {
        //     lazyload(); // ✅ Call global function
        // } else {
        //     console.error("lazyload function is still not defined!");
        // }
      },
      error: function(jqXHR, textStatus, errorThrown) {
        // Handle any AJAX errors
        console.error("Request failed: " + textStatus, errorThrown); // Log error in the console
        alert("Failed to load packages. Please try again."); // Alert user about the failure
      }
    });
  }
});*/


//working
/*$(document).ready(function () {
  // Event listener for the 'add_more_pkg' button click
  $(document).on("click", ".add_more_pkg", function () {
    var $this = $(this);
    if ($this.hasClass("clicked")) return; // Prevent double clicks

    $this.addClass("clicked"); // Mark as clicked
    add_packages($this.attr("content_type")); // Load packages
  });

  function add_packages(content_type) {
    var custom_length, id, dynamic_pkg_add, load_more_packages;

    if (content_type === "domestic" || content_type === "domestic_mobile") {
        custom_length = $(".custom_length_demostic").length;
        id = $("input[name='pack_id_list_demostic[]']").map(function () {
            return $(this).val();
        }).get();
        dynamic_pkg_add = "dynamic_pkg_add_domestic";
        load_more_packages = "india-packages";
    } else if (content_type === "international" || content_type === "international_mobile") {
        custom_length = $(".custom_length").length;
        id = $("input[name='pack_id_list[]']").map(function () {
            return $(this).val();
        }).get();
        dynamic_pkg_add = "dynamic_pkg_add";
        load_more_packages = "international-packages";
    }

    var APP_URL = $("#APP_URL").val();
    var csrfToken = $("#csrf_token").val();
    var url = APP_URL + "/add_package";

    $.ajax({
        url: url,
        method: "POST", // Use POST for CSRF protection
        data: { id, custom_length, content_type, _token: csrfToken },
        dataType: "json", // Expecting JSON response
        success: function (response) {
            console.log("AJAX Success:", response); // Debugging

            if (!response || response.html === "0" || response.html.trim() === "") {
                alert("No more packages available!");
                return;
            }

            $("#" + dynamic_pkg_add).append(response.html);

            if (custom_length >= 12) {
                $("." + load_more_packages).hide();
            }

            // Ensure lazy loading works
            if (typeof lazyload === "function") {
                lazyload();
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error("Request failed:", textStatus, errorThrown);
            alert("Failed to load packages. Please try again.");
        },
        complete: function () {
            $(".add_more_pkg").removeClass("clicked"); // Allow clicks again
        },
    });
  }
});*/


// more tour packages (working)
$(document).ready(function () {
    var totalPackagesLoaded = 0; // Track total loaded packages

    $(document).on("click", ".add_more_pkg", function () {
        var $this = $(this);
        if ($this.hasClass("clicked")) return; // Prevent double clicks

        $this.addClass("clicked"); // Mark as clicked
        add_packages($this.attr("content_type"), $this); // Pass button reference
    });

    function add_packages(content_type, $button) {
        var custom_length, id, dynamic_pkg_add, load_more_packages;

        if (content_type === "domestic" || content_type === "domestic_mobile") {
            custom_length = $(".custom_length_demostic").length;
            id = $("input[name='pack_id_list_demostic[]']").map(function () {
                return $(this).val();
            }).get();
            dynamic_pkg_add = "dynamic_pkg_add_domestic";
            load_more_packages = "india-packages";
        } else if (content_type === "international" || content_type === "international_mobile") {
            custom_length = $(".custom_length").length;
            id = $("input[name='pack_id_list[]']").map(function () {
                return $(this).val();
            }).get();
            dynamic_pkg_add = "dynamic_pkg_add";
            load_more_packages = "international-packages";
        }

        var APP_URL = $("#APP_URL").val();
        var csrfToken = $("#csrf_token").val();
        var url = APP_URL + "/add_package";

        $.ajax({
            url: url,
            method: "POST", // Use POST for CSRF protection
            data: { id, custom_length, content_type, _token: csrfToken, limit: 4 }, // Load only 4 at a time
            dataType: "json", // Expecting JSON response
            success: function (response) {
                console.log("AJAX Success:", response); // Debugging

                if (!response || response.html === "0" || response.html.trim() === "") {
                    alert("No more packages available!");
                    $button.hide(); // Hide button when no more packages
                    return;
                }

                $("#" + dynamic_pkg_add).append(response.html);
                totalPackagesLoaded += 4; // Increment count by 4

                // Hide button if 8 packages (4+4) are loaded
                if (totalPackagesLoaded >= 4) {
                    $button.hide();
                }

                // Ensure lazy loading works
                if (typeof lazyload === "function") {
                    lazyload();
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                //console.error("Request failed:", textStatus, errorThrown);
                alert("Failed to load packages. Please try again.");
            },
            complete: function () {
                $(".add_more_pkg").removeClass("clicked"); // Allow clicks again
            },
        });
    }
});


/***********************************************/

document.addEventListener('DOMContentLoaded', function() {
  // convert url into lower case
  // Get the current URL
  var currentURL = window.location.href;
    
  // Convert the URL to lowercase
  var lowerCaseURL = currentURL.toLowerCase();
    
  // Check if the current URL has been converted to lowercase
  if (currentURL !== lowerCaseURL) {
    // Redirect to the lowercase URL
    window.location.href = lowerCaseURL;
    }

  // url-lowercase
  var slug = function (str) {
    str = str.replace(/^\s+|\s+$/g, ''); // trim
    str = str.toLowerCase();
    // remove accents, swap ñ for n, etc
    var from = "ãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;";
    var to = "aaaaaeeeeeiiiiooooouuuunc------";
    for (var i = 0, l = from.length; i < l; i++) {
      str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
      }
      str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
      .replace(/\s+/g, '-') // collapse whitespace and replace by -
      .replace(/-+/g, '-'); // collapse dashes
      return str;
    };

  // tour search by destination name
  $("#search_mobile").submit(function () {
    var destination_search = slug($(".destination_search_mobile").val());
    document.search_mobile.action = 'Holidays/' + destination_search + '-tour-packages'
    })

  // tour search by theme name
  $("#search2").submit(function () {
    var destination_search = slug($("#destination_search").val());

    if (jQuery(window).width() >= 992) {
      var select_theme = slug($("#select_theme").val());
      if (destination_search != "" && select_theme == "") {
        document.search2.action = 'holidays/' + destination_search + '-tour-packages'
        } else {
          document.search2.action = 'holidays/' + destination_search + '/theme/' + select_theme
          }
        } else {
          if (destination_search != "") {
            document.search2.action = 'holidays/' + destination_search + '-tour-packages'
            }
          }
    })
});

/***********************************************/
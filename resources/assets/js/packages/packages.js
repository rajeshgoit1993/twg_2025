var APP_URL = $('#baseurl').val();
//alert(APP_URL);
//Timepicker
$('.timepicker').timepicker({
    showInputs: false
});
$('.datepicker').datepicker({
    autoclose: true,
});
$(document).on("keyup", ".packages_rate, .packages_value", function () {
    var packages_rate = parseFloat($(".packages_rate").val()) || 0;
    var packages_value = parseFloat($(".packages_value").val()) || 0;
    var packages_total = packages_rate * packages_value;
    
    $(".packages_total").val(packages_total.toFixed(2)); 
});

$(document).ready(function() {


            //     $('.destinations').select2({  placeholder: "To",
            //     allowClear: true,
            //     ajax:{
            //         url: $("#APP_URL").val()+'/search_tour_destination',
            //         type: "get",
            //         dataType: 'json',
            //         delay: 250,
            //         data: function (params) {
            //             return {
            //                 searchTerm: params.term // search term
            //             };
            //         },
            //         processResults: function (response) {
            //             return {
            //                 results: response
            //             };
            //         },
            //         cache: true
            //     }
            // });
        
 
});


// $(document).ready(function() {
//   // Initialize Select2
//   $('#destinations').select2({
//     placeholder: "Select destinations",
//     allowClear: true,
//     ajax: {
//       url: '/search_tour_destination',
//       type: 'get',
//       dataType: 'json',
//       delay: 250,
//       data: function (params) {
//         return {
//           searchTerm: params.term // search term
//         };
//       },
//       processResults: function (response) {
//         return {
//           results: response.results
//         };
//       }
//     }
//   });

//   // Clear any previously selected values after initializing Select2
//   $('#destinations').val([]).trigger('change');
// });


/*//
function new_price_discount_validation() {
    $(".new_price_category").each(function() {
        var new_price_category=$(this).val();
        if(!new_price_category) {
            $(this).parent().siblings().find(".date_start").datepicker("destroy")
            $(this).parent().siblings().find(".date_start").attr("readonly",'')
            $(this).parent().siblings().find(".date_end").datepicker("destroy")
            $(this).parent().siblings().find(".date_end").attr("readonly",'')
            $(this).parent().siblings().find(".price_applicable_for").attr("readonly",'')
            $(this).parent().siblings().find(".price_applicable_for").attr("disabled",'')
            $(this).parent().siblings().find(".over_all_discount_type").attr("readonly",'')
            $(this).parent().siblings().find(".over_all_discount_type").attr("disabled",'')
            $(this).parent().siblings().find(".cuttoffpoint").attr("readonly",'')
            $(this).parent().siblings().find(".cuttoffpoint").attr("disabled",'')
            $(this).parent().siblings().find(".add_new_price_range").attr("disabled",'')
        } else {
            if($(this).parent().siblings().find(".date_start").data("datepicker") == null) {
                $(this).parent().siblings().find(".date_start").datepicker({
                    format: 'dd/mm/yyyy',
                    autoclose: true,
                    todayHighlight: true,
                });
                $(this).parent().siblings().find(".date_start").removeAttr("readonly",'')
                $(this).parent().siblings().find(".price_applicable_for").removeAttr("readonly",'')
                $(this).parent().siblings().find(".price_applicable_for").removeAttr("disabled",'')
                $(this).parent().siblings().find(".over_all_discount_type").removeAttr("readonly",'')
                $(this).parent().siblings().find(".over_all_discount_type").removeAttr("disabled",'')
                $(this).parent().siblings().find(".cuttoffpoint").removeAttr("readonly",'')
                $(this).parent().siblings().find(".cuttoffpoint").removeAttr("disabled",'')
                $(this).parent().siblings().find(".add_new_price_range").removeAttr("disabled",'')
            }
        }
    });
}

// price date
function new_price_date_validation() {
    $(".date_start").each(function() {
        var start_val=$(this).val();
        var start_split=start_val.split("/");
        var start_year=start_split['2']
        var start_month=start_split['1']
        var start_day=start_split['0']
        var start_val=start_split['2']+'-'+start_month+'-'+start_day;
        if(start_val!= 'undefined-undefined-' && start_val!='') {
            $(this).parent().parent().siblings().find(".date_end").removeAttr("readonly",'')
        } else {
            $(this).parent().parent().siblings().find(".date_end").attr("readonly",'')
            $(this).parent().parent().siblings().find(".date_end").datepicker("destroy")
        }
        var end_date=$(this).parent().parent().siblings().find(".date_end").val()
        if(start_val!= 'undefined-undefined-' && start_val!='' && end_date!= 'undefined-undefined-' && end_date=='') {
            $(this).parent().parent().siblings().find(".date_end").datepicker("destroy")
            const today = new Date();
            const yyyy = today.getFullYear();
            let mm = today.getMonth() + 1; // Months start at 0!
            let dd = today.getDate();
            if (dd < 10) dd = '0' + dd;
            if (mm < 10) mm = '0' + mm;
            const formattedToday = yyyy + '-' + mm + '-' + dd;
            var date1 = new Date(formattedToday);
            var date2 = new Date(start_val);
            if(date2 >= date1) {
            var diffTime = Math.abs(date2 - date1);
            var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            var start_date=parseInt(diffDays);
            //
            $(this).parent().parent().siblings().find(".date_end").datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true,
                todayHighlight: true,
                startDate: "+"+start_date+"d",
            });
            } else {
                var diffTime = Math.abs(date1 - date2);
                var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                var start_date=parseInt(diffDays);
                //
                $(this).parent().parent().siblings().find(".date_end").datepicker({
                    format: 'dd/mm/yyyy',
                    autoclose: true,
                    todayHighlight: true,
                    startDate: "-"+start_date+"d",
                });
            }
        } else if(start_val!= 'undefined-undefined-' && start_val!='' && end_date!= 'undefined-undefined-' && end_date!='') {
            var end_val=$(this).parent().parent().siblings().find(".date_end").val()
            var end_split=end_val.split("/");
            var end_year=end_split['2']
            var end_month=end_split['1']
            var end_day=end_split['0']
            var end_val=end_year+'-'+end_month+'-'+end_day;
            var end_date=new Date(end_val);
            var date2 = new Date(start_val);
            if(end_date<date2) {
                $(this).parent().parent().siblings().find(".date_end").datepicker('setDate', null)
            }
            $(this).parent().parent().siblings().find(".date_end").datepicker("destroy")
            const today = new Date();
            const yyyy = today.getFullYear();
            let mm = today.getMonth() + 1; // Months start at 0!
            let dd = today.getDate();
            if (dd < 10) dd = '0' + dd;
            if (mm < 10) mm = '0' + mm;
            const formattedToday = yyyy + '-' + mm + '-' + dd;
            var date1 = new Date(formattedToday);
            var date2 = new Date(start_val);
            if(date2 >= date1) {
                var diffTime = Math.abs(date2 - date1);
                var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                var start_date=parseInt(diffDays);
                //
                $(this).parent().parent().siblings().find(".date_end").datepicker({
                    format: 'dd/mm/yyyy',
                    autoclose: true,
                    todayHighlight: true,
                    startDate: "+"+start_date+"d",
                });
            } else {
                var diffTime = Math.abs(date1 - date2);
                var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                var start_date=parseInt(diffDays);
                //
                $(this).parent().parent().siblings().find(".date_end").datepicker({
                    format: 'dd/mm/yyyy',
                    autoclose: true,
                    todayHighlight: true,
                    startDate: "-"+start_date+"d",
                });
            }
        }
    });
}

//
$(document).on("change",".date_start",function() {
    new_price_date_validation()
});

//
$(document).ready(function() {
    new_price_discount_validation()
    new_price_date_validation()
});*/

/******************************************/

/*// Function to validate and initialize the price discount fields
function new_price_discount_validation() {
    $(".new_price_category").each(function() {
        var new_price_category = $(this).val();
        var siblings = $(this).parent().siblings();

        if (!new_price_category) {
            siblings.find(".date_start, .date_end").datepicker("destroy").attr("readonly", true);
            siblings.find(".price_applicable_for, .over_all_discount_type, .cuttoffpoint, .add_new_price_range")
                    .attr("readonly", true).attr("disabled", true);
        } else {
            if (!siblings.find(".date_start").data("datepicker")) {
                siblings.find(".date_start").datepicker({
                    format: 'dd/mm/yyyy',
                    autoclose: true,
                    todayHighlight: true,
                }).removeAttr("readonly");
                
                siblings.find(".price_applicable_for, .over_all_discount_type, .cuttoffpoint, .add_new_price_range")
                        .removeAttr("readonly").removeAttr("disabled");
            }
        }
    });
}

// Function to validate the date ranges
function new_price_date_validation() {
    $(".date_start").each(function() {
        var startVal = $(this).val();
        var startDate = parseDate(startVal);

        var endDateInput = $(this).parent().parent().siblings().find(".date_end");
        var endDate = parseDate(endDateInput.val());

        if (startDate) {
            endDateInput.removeAttr("readonly");

            if (!endDateInput.data("datepicker")) {
                endDateInput.datepicker({
                    format: 'dd/mm/yyyy',
                    autoclose: true,
                    todayHighlight: true,
                    startDate: startDate > new Date() ? "+" + getDateDifference(new Date(), startDate) + "d" : "-" + getDateDifference(startDate, new Date()) + "d",
                });
            }
        } else {
            endDateInput.attr("readonly", true).datepicker("destroy");
        }

        if (endDate && endDate < startDate) {
            endDateInput.datepicker('setDate', null);
        }
    });
}

// Helper function to parse a date from 'dd/mm/yyyy' format
function parseDate(dateStr) {
    if (!dateStr) return null;
    var [day, month, year] = dateStr.split('/');
    return new Date(year, month - 1, day);
}

// Helper function to get the difference in days between two dates
function getDateDifference(date1, date2) {
    return Math.ceil(Math.abs(date2 - date1) / (1000 * 60 * 60 * 24));
}

$(document).ready(function() {
    // Initial call to setup date validation
    new_price_discount_validation();
    new_price_date_validation();

    // Initialize datepicker for .date_start directly if not already done
    $(".date_start").datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true,
    });

    

    // Reinitialize date validation when date_start changes
    $(document).on("change", ".date_start", function() {
        new_price_date_validation();
    });
});*/

/*// Event listeners
$(document).on("change", ".date_start", function() {
    new_price_date_validation();
});*/

/*// Initialize the functions when the document is ready
$(document).ready(function() {
    new_price_discount_validation();
    new_price_date_validation();

    // Initialize datepicker for .date_start directly if not already done
    $(".date_start").datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true,
    });
});*/

/******************************************/

/*// Function to validate and initialize the price discount fields
function new_price_discount_validation() {
    $(".new_price_category").each(function () {
        var new_price_category = $(this).val();
        var siblings = $(this).parent().siblings();

        if (!new_price_category) {
            siblings.find(".date_start, .date_end").datepicker("destroy").attr("readonly", true);
            siblings.find(".price_applicable_for, .over_all_discount_type, .cuttoffpoint, .add_new_price_range")
                .attr("readonly", true).attr("disabled", true);
        } else {
            // Initialize .date_start datepicker if not already done
            if (!siblings.find(".date_start").data("datepicker")) {
                siblings.find(".date_start").datepicker({
                    format: 'dd/mm/yyyy',
                    autoclose: true,
                    todayHighlight: true,
                }).removeAttr("readonly");

                // Enable other fields
                siblings.find(".price_applicable_for, .over_all_discount_type, .cuttoffpoint, .add_new_price_range")
                    .removeAttr("readonly").removeAttr("disabled");
            }
        }
    });
}

// Function to validate the date ranges
function new_price_date_validation() {
    $(".date_start").each(function () {
        var startVal = $(this).val();
        var startDate = parseDate(startVal);

        var endDateInput = $(this).parent().parent().siblings().find(".date_end");
        var endDate = parseDate(endDateInput.val());

        if (startDate) {
            endDateInput.removeAttr("readonly");

            // Initialize .date_end datepicker with start date constraints
            if (!endDateInput.data("datepicker")) {
                endDateInput.datepicker({
                    format: 'dd/mm/yyyy',
                    autoclose: true,
                    todayHighlight: true,
                    startDate: startDate > new Date() ? "+" + getDateDifference(new Date(), startDate) + "d" : "-" + getDateDifference(startDate, new Date()) + "d",
                });
            }

            // Update startDate constraint for the datepicker dynamically
            endDateInput.datepicker('setStartDate', startDate);
        } else {
            endDateInput.attr("readonly", true).datepicker("destroy");
        }

        // Clear .date_end if it's before .date_start
        if (endDate && endDate < startDate) {
            endDateInput.datepicker('setDate', null);
        }
    });
}

// Function to validate the date ranges when .date_end changes
function validateEndDate() {
    $(".date_end").each(function () {
        var endVal = $(this).val();
        var endDate = parseDate(endVal);

        var startDateInput = $(this).parent().parent().siblings().find(".date_start");
        var startDate = parseDate(startDateInput.val());

        // Clear the end date if it's before the start date
        if (endDate && startDate && endDate < startDate) {
            $(this).datepicker('setDate', null);
        }
    });
}

// Helper function to parse a date from 'dd/mm/yyyy' format
function parseDate(dateStr) {
    if (!dateStr) return null;
    var [day, month, year] = dateStr.split('/');
    return new Date(year, month - 1, day);
}

// Helper function to get the difference in days between two dates
function getDateDifference(date1, date2) {
    return Math.ceil(Math.abs(date2 - date1) / (1000 * 60 * 60 * 24));
}

$(document).ready(function () {
    // Initial setup for date validation and discount fields
    new_price_discount_validation();
    new_price_date_validation();

    // Initialize datepicker for .date_start directly if not already done
    $(".date_start").datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true,
    });

    // Reinitialize date validation when .date_start changes
    $(document).on("change", ".date_start", function () {
        new_price_date_validation();
    });

    // Validate .date_end when it changes
    $(document).on("change", ".date_end", function () {
        validateEndDate();
    });
});*/

/******************************************/

/*// Function to validate and initialize the price discount fields
function new_price_discount_validation() {
    $(".new_price_category").each(function () {
        var new_price_category = $(this).val();
        var siblings = $(this).parent().siblings();

        if (!new_price_category) {
            siblings.find(".date_start, .date_end").datepicker("destroy").attr("readonly", true);
            siblings.find(".price_applicable_for, .over_all_discount_type, .cuttoffpoint, .add_new_price_range")
                .attr("readonly", true).attr("disabled", true);
        } else {
            if (!siblings.find(".date_start").data("datepicker")) {
                siblings.find(".date_start").datepicker({
                    format: 'dd/mm/yyyy',
                    autoclose: true,
                    todayHighlight: true,
                }).removeAttr("readonly");

                siblings.find(".price_applicable_for, .over_all_discount_type, .cuttoffpoint, .add_new_price_range")
                    .removeAttr("readonly").removeAttr("disabled");
            }
        }
    });
}

// Function to validate the date ranges
function new_price_date_validation() {
    $(".date_start").each(function () {
        var startVal = $(this).val();
        var startDate = parseDate(startVal);

        var endDateInput = $(this).parent().parent().siblings().find(".date_end");
        var endDate = parseDate(endDateInput.val());

        if (startDate) {
            endDateInput.removeAttr("readonly");

            if (!endDateInput.data("datepicker")) {
                endDateInput.datepicker({
                    format: 'dd/mm/yyyy',
                    autoclose: true,
                    todayHighlight: true,
                    startDate: startDate,
                });
            }

            endDateInput.datepicker('setStartDate', startDate);
        } else {
            endDateInput.attr("readonly", true).datepicker("destroy");
        }

        if (endDate && endDate < startDate) {
            endDateInput.datepicker('setDate', null);
        }

        // Ensure .date_end is marked as required if .date_start is selected
        toggleEndDateRequired($(this), endDateInput);
    });
}

// Function to ensure .date_end is marked as required when .date_start is selected
function toggleEndDateRequired(startDateInput, endDateInput) {
    var startVal = startDateInput.val();

    if (startVal) {
        endDateInput.attr("required", true);
    } else {
        endDateInput.removeAttr("required");
    }
}

// Helper function to parse a date from 'dd/mm/yyyy' format
function parseDate(dateStr) {
    if (!dateStr) return null;
    var [day, month, year] = dateStr.split('/');
    return new Date(year, month - 1, day);
}

$(document).ready(function () {
    // Initial setup for date validation and discount fields
    new_price_discount_validation();
    new_price_date_validation();

    // Initialize datepicker for .date_start directly if not already done
    $(".date_start").datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true,
    });

    // Reinitialize date validation when .date_start changes
    $(document).on("change", ".date_start", function () {
        new_price_date_validation();
    });

    // Validate .date_end when it changes
    $(document).on("change", ".date_end", function () {
        toggleEndDateRequired($(this).parent().parent().siblings().find(".date_start"), $(this));
    });
});*/


/******************************************/

// tour price date selection and date range validation
// Function to validate and initialize the price discount fields
/*function new_price_discount_validation() {
    $(".new_price_category").each(function () {
        var new_price_category = $(this).val();
        var siblings = $(this).parent().siblings();

        if (!new_price_category) {
            siblings.find(".date_start, .date_end").datepicker("destroy").attr("readonly", true);
            siblings.find(".price_applicable_for, .over_all_discount_type, .cuttoffpoint, .add_new_price_range")
                .attr("readonly", true).attr("disabled", true);
        } else {
            if (!siblings.find(".date_start").data("datepicker")) {
                siblings.find(".date_start").datepicker({
                    format: 'dd/mm/yyyy',
                    autoclose: true,
                    todayHighlight: true,
                }).removeAttr("readonly");

                siblings.find(".price_applicable_for, .over_all_discount_type, .cuttoffpoint, .add_new_price_range")
                    .removeAttr("readonly").removeAttr("disabled");
            }
        }
    });
}*/

/*// Function to validate and initialize the price discount fields
function new_price_discount_validation() {
    $(".new_price_category").each(function () {
        var new_price_category = $(this).val();
        var siblings = $(this).parent().siblings();

        // Find input fields related to price discount
        var dateStartInput = siblings.find(".date_start");
        var dateEndInput = siblings.find(".date_end");
        var priceApplicableInput = siblings.find(".price_applicable_for");
        var overallDiscountTypeInput = siblings.find(".over_all_discount_type");
        var cutoffPointInput = siblings.find(".cuttoffpoint");
        var addNewPriceRangeInput = siblings.find(".add_new_price_range");

        // Check if the new price category is selected
        if (!new_price_category) {
            // Disable and clear related fields if no category is selected
            dateStartInput.datepicker("destroy").attr("readonly", true).val('');
            dateEndInput.datepicker("destroy").attr("readonly", true).val('');
            priceApplicableInput.attr("readonly", true).attr("disabled", true).val('');
            overallDiscountTypeInput.attr("readonly", true).attr("disabled", true).val('');
            cutoffPointInput.attr("readonly", true).attr("disabled", true).val('');
            addNewPriceRangeInput.attr("readonly", true).attr("disabled", true).val('');
        } else {
            // If a category is selected and datepicker not initialized
            if (!dateStartInput.data("datepicker")) {
                dateStartInput.datepicker({
                    format: 'dd/mm/yyyy',
                    autoclose: true,
                    todayHighlight: true,
                }).removeAttr("readonly");
            }

            // Enable related fields
            dateStartInput.removeAttr("readonly");
            priceApplicableInput.removeAttr("readonly").removeAttr("disabled");
            overallDiscountTypeInput.removeAttr("readonly").removeAttr("disabled");
            cutoffPointInput.removeAttr("readonly").removeAttr("disabled");
            addNewPriceRangeInput.removeAttr("readonly").removeAttr("disabled");
        }
    });
    // Ensure .date_end is marked as required if .date_start is selected
        toggleEndDateRequired($(this), endDateInput);
}


// Function to validate the date ranges
function new_price_date_validation() {
    $(".date_start").each(function () {
        var startVal = $(this).val();
        var startDate = parseDate(startVal);

        var endDateInput = $(this).parent().parent().siblings().find(".date_end");
        var endDate = parseDate(endDateInput.val());

        if (startDate) {
            endDateInput.removeAttr("readonly");

            if (!endDateInput.data("datepicker")) {
                endDateInput.datepicker({
                    format: 'dd/mm/yyyy',
                    autoclose: true,
                    todayHighlight: true,
                    startDate: startDate,
                });
            }

            endDateInput.datepicker('setStartDate', startDate);
        } else {
            endDateInput.val('').attr("readonly", true).datepicker("destroy");
        }

        if (endDate && endDate < startDate) {
            endDateInput.datepicker('setDate', null);
        }

        // Ensure .date_end is marked as required if .date_start is selected
        toggleEndDateRequired($(this), endDateInput);
    });
}

// Function to ensure .date_end is marked as required when .date_start is selected
function toggleEndDateRequired(startDateInput, endDateInput) {
    var startVal = startDateInput.val();

    if (startVal) {
        endDateInput.attr("required", true);
    } else {
        endDateInput.removeAttr("required");
    }
}

// Helper function to parse a date from 'dd/mm/yyyy' format
function parseDate(dateStr) {
    if (!dateStr) return null;
    var [day, month, year] = dateStr.split('/');
    return new Date(year, month - 1, day);
}

$(document).ready(function () {
    // Initial setup for date validation and discount fields
    new_price_discount_validation();
    new_price_date_validation();

    // Initialize datepicker for .date_start directly if not already done
    $(".date_start").datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true,
    });

    // Reinitialize date validation when .date_start changes
    $(document).on("change", ".date_start", function () {
        new_price_discount_validation();
        new_price_date_validation();
    });

    // Validate .date_end when it changes
    $(document).on("change", ".date_end", function () {
        toggleEndDateRequired($(this).parent().parent().siblings().find(".date_start"), $(this));
    });
});*/


/******************************************/

// Function to validate and initialize the price discount fields
function new_price_discount_validation() {
    $(".new_price_category").each(function () {
        var new_price_category = $(this).val();
        var siblings = $(this).parent().siblings();

        // Find input fields related to price discount
        var dateStartInput = siblings.find(".date_start");
        var dateEndInput = siblings.find(".date_end");
        var priceApplicableInput = siblings.find(".price_applicable_for");
        var overallDiscountTypeInput = siblings.find(".over_all_discount_type");
        var cutoffPointInput = siblings.find(".cuttoffpoint");
        var addNewPriceRangeInput = siblings.find(".add_new_price_range");

        // Check if the new price category is selected
        if (!new_price_category) {
            // Disable and clear related fields if no category is selected
            resetFields(dateStartInput, dateEndInput, priceApplicableInput, overallDiscountTypeInput, cutoffPointInput, addNewPriceRangeInput);
        } else {
            // If a category is selected and datepicker not initialized
            initializeDatepicker(dateStartInput);
            initializeDatepicker(dateEndInput);

            // Enable related fields
            dateStartInput.removeAttr("readonly");
            priceApplicableInput.removeAttr("readonly").removeAttr("disabled");
            overallDiscountTypeInput.removeAttr("readonly").removeAttr("disabled");
            cutoffPointInput.removeAttr("readonly").removeAttr("disabled");
            addNewPriceRangeInput.removeAttr("readonly").removeAttr("disabled");
        }

        // Ensure .date_end is marked as required if .date_start is selected
        toggleEndDateRequired(dateStartInput, dateEndInput);
    });
}

// Helper function to reset input fields
function resetFields(dateStartInput, dateEndInput, priceApplicableInput, overallDiscountTypeInput, cutoffPointInput, addNewPriceRangeInput) {
    dateStartInput.datepicker("destroy").attr("readonly", true).val('');
    dateEndInput.datepicker("destroy").attr("readonly", true).val('');
    priceApplicableInput.attr("readonly", true).attr("disabled", true).val('');
    overallDiscountTypeInput.attr("readonly", true).attr("disabled", true).val('');
    cutoffPointInput.attr("readonly", true).attr("disabled", true).val('');
    addNewPriceRangeInput.attr("readonly", true).attr("disabled", true).val('');
}

// Helper function to initialize datepicker
function initializeDatepicker(inputElement) {
    if (!inputElement.data("datepicker")) {
        inputElement.datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            todayHighlight: true,
        }).removeAttr("readonly");
    }
}

// Function to validate the date ranges
function new_price_date_validation() {
    $(".date_start").each(function () {
        var startVal = $(this).val();
        var startDate = parseDate(startVal);

        var endDateInput = $(this).parent().parent().siblings().find(".date_end");
        var endDate = parseDate(endDateInput.val());

        if (startDate) {
            endDateInput.removeAttr("readonly");

            if (!endDateInput.data("datepicker")) {
                endDateInput.datepicker({
                    format: 'dd/mm/yyyy',
                    autoclose: true,
                    todayHighlight: true,
                    startDate: startDate,
                });
            }

            endDateInput.datepicker('setStartDate', startDate);
        } else {
            endDateInput.val('').attr("readonly", true).datepicker("destroy");
        }

        if (endDate && endDate < startDate) {
            endDateInput.datepicker('setDate', null);
        }

        // Ensure .date_end is marked as required if .date_start is selected
        toggleEndDateRequired($(this), endDateInput);
    });
}

// Function to ensure .date_end is marked as required when .date_start is selected
function toggleEndDateRequired(startDateInput, endDateInput) {
    var startVal = startDateInput.val();

    if (startVal) {
        endDateInput.attr("required", true);
    } else {
        endDateInput.removeAttr("required");
    }
}

// Helper function to parse a date from 'dd/mm/yyyy' format
function parseDate(dateStr) {
    if (!dateStr) return null;
    var [day, month, year] = dateStr.split('/');
    return new Date(year, month - 1, day);
}

$(document).ready(function () {
    // Initial setup for date validation and discount fields
    new_price_discount_validation();
    new_price_date_validation();

    // Initialize datepicker for .date_start directly if not already done
    $(".date_start").datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true,
    });

    // Reinitialize validation when .date_start changes
    $(document).on("change", ".date_start", function () {
        new_price_discount_validation();
        new_price_date_validation();
    });

    // Validate .date_end when it changes
    $(document).on("change", ".date_end", function () {
        toggleEndDateRequired($(this).parent().parent().siblings().find(".date_start"), $(this));
    });
});


/******************************************/

/*// Function to validate and initialize the price discount fields
function new_price_discount_validation() {
    $(".new_price_category").each(function () {
        var new_price_category = $(this).val();
        var siblings = $(this).parent().siblings();

        // Find input fields related to price discount
        var dateStartInput = siblings.find(".date_start");
        var dateEndInput = siblings.find(".date_end");
        var priceApplicableInput = siblings.find(".price_applicable_for");
        var overallDiscountTypeInput = siblings.find(".over_all_discount_type");
        var cutoffPointInput = siblings.find(".cuttoffpoint");
        var addNewPriceRangeInput = siblings.find(".add_new_price_range");

        // Check if the new price category is selected
        if (!new_price_category) {
            // Disable and clear related fields if no category is selected
            resetFields(dateStartInput, dateEndInput, priceApplicableInput, overallDiscountTypeInput, cutoffPointInput, addNewPriceRangeInput);
        } else {
            // Initialize datepicker for .date_start
            initializeDatepicker(dateStartInput);
            // Initialize datepicker for .date_end
            initializeDatepicker(dateEndInput);

            // Enable related fields
            dateStartInput.removeAttr("readonly");
            priceApplicableInput.removeAttr("readonly").removeAttr("disabled");
            overallDiscountTypeInput.removeAttr("readonly").removeAttr("disabled");
            cutoffPointInput.removeAttr("readonly").removeAttr("disabled");
            addNewPriceRangeInput.removeAttr("readonly").removeAttr("disabled");
        }

        // Ensure .date_end is marked as required if .date_start is selected
        toggleEndDateRequired(dateStartInput, dateEndInput);
    });
}

// Helper function to reset input fields
function resetFields(dateStartInput, dateEndInput, priceApplicableInput, overallDiscountTypeInput, cutoffPointInput, addNewPriceRangeInput) {
    dateStartInput.datepicker("destroy").attr("readonly", true).val('');
    dateEndInput.datepicker("destroy").attr("readonly", true).val('');
    priceApplicableInput.attr("readonly", true).attr("disabled", true).val('');
    overallDiscountTypeInput.attr("readonly", true).attr("disabled", true).val('');
    cutoffPointInput.attr("readonly", true).attr("disabled", true).val('');
    addNewPriceRangeInput.attr("readonly", true).attr("disabled", true).val('');
}

// Helper function to initialize datepicker
function initializeDatepicker(inputElement) {
    if (!inputElement.data("datepicker")) {
        inputElement.datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            todayHighlight: true,
        }).removeAttr("readonly"); // Make sure it's editable
    }
}

// Function to validate the date ranges
function new_price_date_validation() {
    $(".date_start").each(function () {
        var startVal = $(this).val();
        var startDate = parseDate(startVal);

        var endDateInput = $(this).parent().parent().siblings().find(".date_end");
        var endDate = parseDate(endDateInput.val());

        if (startDate) {
            endDateInput.removeAttr("readonly");

            // Initialize datepicker for end date
            initializeDatepicker(endDateInput);

            endDateInput.datepicker('setStartDate', startDate);
        } else {
            endDateInput.val('').attr("readonly", true).datepicker("destroy");
        }

        if (endDate && endDate < startDate) {
            endDateInput.datepicker('setDate', null);
        }

        // Ensure .date_end is marked as required if .date_start is selected
        toggleEndDateRequired($(this), endDateInput);
    });
}

// Function to ensure .date_end is marked as required when .date_start is selected
function toggleEndDateRequired(startDateInput, endDateInput) {
    var startVal = startDateInput.val();

    if (startVal) {
        endDateInput.attr("required", true);
    } else {
        endDateInput.removeAttr("required");
    }
}

// Helper function to parse a date from 'dd/mm/yyyy' format
function parseDate(dateStr) {
    if (!dateStr) return null;
    var [day, month, year] = dateStr.split('/');
    return new Date(year, month - 1, day);
}

$(document).ready(function () {
    // Initial setup for date validation and discount fields
    new_price_discount_validation();
    new_price_date_validation();

    // Initialize datepicker for existing .date_start directly
    $(".date_start").each(function() {
        initializeDatepicker($(this));
    });

    // Reinitialize validation when .date_start changes
    $(document).on("change", ".date_start", function () {
        new_price_discount_validation();
        new_price_date_validation();
    });

    // Validate .date_end when it changes
    $(document).on("change", ".date_end", function () {
        toggleEndDateRequired($(this).parent().parent().siblings().find(".date_start"), $(this));
    });

    // Example of dynamically adding a new price category
    $("#add_new_price_category").on("click", function() {
        // Code to add new price category
        // For example, let's say you append new inputs
        const newCategoryHTML = `
            <div>
                <input type="text" class="new_price_category" />
                <input type="text" class="date_start" />
                <input type="text" class="date_end" readonly />
                <input type="text" class="price_applicable_for" />
                <input type="text" class="over_all_discount_type" />
                <input type="text" class="cuttoffpoint" />
                <input type="text" class="add_new_price_range" />
            </div>`;
        $(".price_categories_container").append(newCategoryHTML); // Append new fields

        // Initialize the new fields
        new_price_discount_validation(); // Call validation to initialize new elements
    });
});*/


/******************************************/








//
$(document).on("change click",".new_price_category",function() {
    var options = $('.new_price_category option:selected');
    var values = $.map(options ,function(option) {
        return option.value;
    })
    var select_item = $(this).find(":selected").val();
    console.log(values)
    console.log(select_item)
    var button=$(this)
    var APP_URL=$("#APP_URL").val();
    $.ajax({
        url: APP_URL+'/packagerating_url_new',
        data: {select_item:select_item,values:values},
        type: 'get',
        // contentType: false,
        // processData: false,
        success: function (data) {
            button.html('').html(data)
        },
        error: function (xhr, status, error) {
        }
    });
    new_price_discount_validation()
});

// add visa policy
$(document).on("click", ".visa", function () {
    if ($(this).is(":checked")) {
        $(this).parent().siblings(".visa_pol").show()
    }
    else {
        $(this).parent().siblings(".visa_pol").hide()
    }
});


/******** Select all check boxes  *****************/

$(".selectall").click(function () {
    $(".individual").prop("checked", $(this).prop("checked"));
});

// show more/hide (packages.js)
$(document).on("click", ".show_hide", function () {
    var inner_data = $(this).html()
    if (inner_data == "More+") {
        $(this).html("").html("Less-")
        $(this).siblings(".cke_chrome").css('display','block')
    }
    else {
        $(this).html("").html("More+")
        $(this).siblings(".cke_chrome").css('display','none')
    }
});

// show more/hides
$(document).on("click", ".show_hides", function () {
    var inner_data = $(this).html()
    if (inner_data == "More+") {
        $(this).html("").html("Less-")
        $(this).siblings(".hide_text").show()
    }
    else {
        $(this).html("").html("More+")
        $(this).siblings(".hide_text").hide()
    }
});

// tour link copied
$(document).on("click", ".link", function () {

    var link = $(this).attr("link");
    var copyText = document.getElementById(link);
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val(copyText.value).select();
    document.execCommand("copy");
    $temp.remove();
    alert("Tour link copied: " + copyText.value);
});

$(document).on("click", ".btn-whatsapp", function () {

    var link = $(this).attr("link");
    var copyText = document.getElementById(link);
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val(copyText.value).select();
    document.execCommand("copy");
    $temp.remove();
    alert("whatsapp link copied: " + copyText.value);
});

// For Add Package Types
$('#savePackageTypes').click(function () {
    var packageTypeformData = {
        pkgTypeName: $('#addPackageType .pkgTypeName').val(),
        pkgTypeStatus: $('#addPackageType .pkgTypeStatus').val(),
        showsfooter: $('#addPackageType .showsfooter').val(),
    }
    //console.log(packageTypeformData);
    $.ajax({
        type: 'post',
        url: APP_URL + '/add-package-type',
        data: packageTypeformData,
        //contentType: "application/json; charset=utf-8",
        dataType: 'json',
        success: function (data) {
            //console.log('Success : '+data);
            if (data == 'added') {
                $('#error-contaier-parent').hide();
                $('#success-contaier-parent').show();
                setTimeout(function () {
                    location.reload();
                }, 300)
            }
        },
        error: function (data) {
            //console.log('Error : '+data);
            var html = '';
            $.each(JSON.parse(data.responseText), function (index, value) {
                html += '<li>' + value + '</li>';
            });
            //console.log(html);
            $('#addPackageType #error-contaier').html(' ').html(html);
            $('#addPackageType #error-contaier-parent').show();
        }
    });
});

// Append data for Edit Type Modal
$(".edit_pkgType").on("click", function () {
    var typeId = $(this).attr('data-id');
    var typeParentId = $(this).closest("tr").attr('id');
    var typeName = $('#' + typeParentId + ' .typename').text();
    var status = $('#' + typeParentId + ' .typestatus input').val();
    var showsfooter = $('#' + typeParentId + ' .showsfooter input').val();
    $('.editPkgType .edittypeid').attr('value', typeId);
    $('.editPkgType .pkgTypeName').attr('value', typeName);
    $('.editPkgType select').val(status);
    $('.editPkgType .showsfooter select').val(showsfooter);
});

// Edit PkgType Modal
$("#updatePkgTypes").on("click", function () {
    //  alert($('#editHotelTypeModal .edittypeid').val());
    var pkgTypeformData = {
        id: $('#editPkgTypeModal .edittypeid').val(),
        pkgTypeName: $('#editPkgTypeModal .pkgTypeName').val(),
        pkgTypeStatus: $('#editPkgTypeModal .pkgTypeStatus').val(),
        showsfooter: $('#editPkgTypeModal .showsfooters').val(),
    }
    //console.log(pkgTypeformData);
    $.ajax({
        type: 'POST',
        url: APP_URL + '/edit-package-type',
        dataType: 'json',
        data: pkgTypeformData,
        success: function (data) {
            //console.log('Sucess : '+data);
            $('#error-contaier-parent1').hide();
            $('#success-contaier-parent1').show();
            setTimeout(function () {
                location.reload();
            }, 400)
        },
        error: function (data) {
            //console.log('Error : '+data);
            var html = '';
            $.each(JSON.parse(data.responseText), function (index, value) {
                html += '<li>' + value + '</li>';
            });
            //console.log(html);
            $('#editPkgTypeModal #error-contaier1').html(' ').html(html);
            $('#editPkgTypeModal #error-contaier-parent1').show();
        }
    });
});

//delete Pkg Type
$('.deletePkgType').on('click', function () {
    var TypeId = $(this).attr('data-id');
    if (confirm('Are you sure to delete Package Type?')) {
        $('#deletePkgType' + TypeId).submit();
    }
});

// For Add Package Types
$('#addInclusions').click(function () {
    var packageInclusions = {
        Name: $('#packageInclusion .name').val(),
        Status: $('#packageInclusion .status').val(),
    }
    //console.log(packageInclusions);
    $.ajax({
        type: 'post',
        url: APP_URL + '/add-inclusion',
        data: packageInclusions,
        //contentType: "application/json; charset=utf-8",
        dataType: 'json',
        success: function (data) {
            //console.log('Success : '+data);
            if (data == 'added') {
                $('#packageInclusion #error-contaier-parent').hide();
                $('#packageInclusion #success-contaier-parent').show();
                setTimeout(function () {
                    location.reload();
                }, 300)
            }
        },
        error: function (data) {
            //console.log('Error : '+data);
            var html = '';
            $.each(JSON.parse(data.responseText), function (index, value) {
                html += '<li>' + value + '</li>';
            });
            //console.log(html);
            $('#packageInclusion #error-contaier').html(' ').html(html);
            $('#packageInclusion #error-contaier-parent').show();
        }
    });
});

$(".editTransfer").on("click", function () {
    var typeId = $(this).attr('data-id');
    var typeParentId = $(this).closest("tr").attr('id');
    var typeTransport = $('#' + typeParentId + ' .typeTransport').text();
    var img_src = $('#' + typeParentId + ' .typeImage img').attr("src");
    var edit_img_value = $('#' + typeParentId + ' .edit_img_value').val();
    var typeTransfer = $('#' + typeParentId + ' .typeTransfer').text();
    var typeTitle = $('#' + typeParentId + ' .typeTitle').text();
    var typeVehicle = $('#' + typeParentId + ' .typeVehicle').text();
    var typeDuration = $('#' + typeParentId + ' .typeDuration').text();
    var typeIncludes = $('#' + typeParentId + ' .typeIncludes').text();
    var typeCity = $('#' + typeParentId + ' .typeCity').text();
    var typeTransport = $('#' + typeParentId + ' .typeTransport').text();
    var TransportStatus = $('#' + typeParentId + ' .typestatus input').val();
    $('#editTransferModel .edittransferid').attr('value', typeId);
    $('#editTransferModel #transport_type').val(typeTransport);
    $('#editTransferModel #transfer_type').val(typeTransfer);
    $('#editTransferModel .transfer_img img').attr('src', img_src);
    $('#editTransferModel .transfer_image_value').attr('value', edit_img_value);
    $('#editTransferModel .name').attr('value', typeTitle);
    $('#editTransferModel .vehicle_type').attr('value', typeVehicle);
    $('#editTransferModel .duration').attr('value', typeDuration);
    $('#editTransferModel .includes').attr('value', typeIncludes);
    $('#editTransferModel .city').attr('value', typeCity);
    $('#editTransferModel .status').val(TransportStatus);
});

//
$('.deleteTransfer').on('click', function () {
    var TypeId = $(this).attr('data-id');
    if (confirm('Are you sure to delete Transfer?')) {
        $('#delete-transfers' + TypeId).submit();
    }
});

//
$(".editAirline").on("click", function () {
    var typeId = $(this).attr('data-id');
    var typeParentId = $(this).closest("tr").attr('id');
    var typeName = $('#' + typeParentId + ' .typeAirline').text();
    var img_src = $('#' + typeParentId + ' .typeImage img').attr("src");
    var edit_img_value = $('#' + typeParentId + ' .edit_air_value').val();
    var typeCode = $('#' + typeParentId + ' .typeCode').text();
    var AirlineStatus = $('#' + typeParentId + ' .typestatus input').val();
    $('#editAirlinesModel .editairlineid').attr('value', typeId);
    $('#editAirlinesModel .name').val(typeName);
    $('#editAirlinesModel .code').val(typeCode);
    $('#editAirlinesModel .airline_img img').attr('src', img_src);
    $('#editAirlinesModel .airline_logo_value').attr('value', edit_img_value);
    $('#editAirlinesModel .status').val(AirlineStatus);
});

//
$('.deleteAirline').on('click', function () {
    var TypeId = $(this).attr('data-id');
    if (confirm('Are you sure to delete Airline?')) {
        $('#delete-airlines' + TypeId).submit();
    }
});

//
$(".editGtags").on("click", function () {
    var typeId = $(this).attr('data-id');
    var typeParentId = $(this).closest("tr").attr('id');
    var typeGtTitle = $('#' + typeParentId + ' .typeGtTitle').text();
    var img_src = $('#' + typeParentId + ' .typeImage img').attr("src");
    var edit_img_value = $('#' + typeParentId + ' .edit_gtag_value').val();
    var typestatus = $('#' + typeParentId + ' .typestatus input').val();
    $('#editGtagsModel .editgtagsid').attr('value', typeId);
    $('#editGtagsModel .name').val(typeGtTitle);
    $('#editGtagsModel .gtag_icon img').attr('src', img_src);
    $('#editGtagsModel .icon_value').attr('value', edit_img_value);
    $('#editGtagsModel .status').val(typestatus);
});

//
$('.deleteGtags').on('click', function () {
    var TypeId = $(this).attr('data-id');
    if (confirm('Are you sure to delete Tag?')) {
        $('#delete-generals' + TypeId).submit();
    }
});

//
$(".editSuitable").on("click", function () {
    var typeId = $(this).attr('data-id');
    var typeParentId = $(this).closest("tr").attr('id');
    var typeStblTitle = $('#' + typeParentId + ' .typeStblTitle').text();
    var img_src = $('#' + typeParentId + ' .typeImage img').attr("src");
    var edit_img_value = $('#' + typeParentId + ' .edit_suitable_value').val();
    var typestatus = $('#' + typeParentId + ' .typestatus input').val();
    $('#editStblModel .editstblsid').attr('value', typeId);
    $('#editStblModel .name').val(typeStblTitle);
    $('#editStblModel .stbl_icon img').attr('src', img_src);
    $('#editStblModel .icon_value').attr('value', edit_img_value);
    $('#editStblModel .status').val(typestatus);
});

//
$('.deleteSuitable').on('click', function () {
    var TypeId = $(this).attr('data-id');
    if (confirm('Are you sure to delete Suitables?')) {
        $('#delete-suitable' + TypeId).submit();
    }
});

//
$(".editHoliday").on("click", function () {
    var typeId = $(this).attr('data-id');
    var typeParentId = $(this).closest("tr").attr('id');
    var typeHldTitle = $('#' + typeParentId + ' .typeHldTitle').text();
    var img_src = $('#' + typeParentId + ' .typeImage img').attr("src");
    var edit_img_value = $('#' + typeParentId + ' .edit_holiday_value').val();
    var typestatus = $('#' + typeParentId + ' .typestatus input').val();
    $('#editHldModel .edithldid').attr('value', typeId);
    $('#editHldModel .name').val(typeHldTitle);
    $('#editHldModel .holiday_icon img').attr('src', img_src);
    $('#editHldModel .icon_value').attr('value', edit_img_value);
    $('#editHldModel .status').val(typestatus);
});

//
$('.deleteHoliday').on('click', function () {
    var TypeId = $(this).attr('data-id');
    if (confirm('Are you sure to delete Holiday?')) {
        $('#delete-holiday' + TypeId).submit();
    }
});

//
$(".editIata").on("click", function () {
    var typeId = $(this).attr('data-id');
    var typeParentId = $(this).closest("tr").attr('id');
    var typeIATA = $('#' + typeParentId + ' .typeIATA').text();
    var typeCode = $('#' + typeParentId + ' .typeIATACode').text();
    var iataStatus = $('#' + typeParentId + ' .typestatus input').val();
    $('#editIataModel .editiataid').attr('value', typeId);
    $('#editIataModel .iataname').val(typeIATA);
    $('#editIataModel .iatacode').val(typeCode);
    $('#editIataModel .status').val(iataStatus);
});

//
$('.deleteIATA').on('click', function () {
    var TypeId = $(this).attr('data-id');
    if (confirm('Are you sure to delete IATA?')) {
        $('#delete-iata' + TypeId).submit();
    }
});

//  Append data for Edit Type Modal
$(".editInclusionType").on("click", function () {
    var typeId = $(this).attr('data-id');
    // alert(typeId);
    var typeParentId = $(this).closest("tr").attr('id');
    // alert(typeParentId);
    var typeName = $('#' + typeParentId + ' .typename').text();
    var status = $('#' + typeParentId + ' .typestatus input').val();
    //alert(typeName+'/'+status);
    $('#editInclusionsModel .edittypeid').attr('value', typeId);
    $('#editInclusionsModel .incName').attr('value', typeName);
    $('#editInclusionsModel select').val(status);
});

//  Edit Inclusions Modal
$("#updateInclusionbtn").on("click", function () {
    //  alert($('#editHotelTypeModal .edittypeid').val());
    var pkgInclusions = {
        id: $('#editInclusionsModel .edittypeid').val(),
        Name: $('#editInclusionsModel .incName').val(),
        Status: $('#editInclusionsModel .incStatus').val(),
    }
    //console.log(pkgInclusions);
    $.ajax({
        type: 'POST',
        url: APP_URL + '/edit-inclusion',
        dataType: 'json',
        data: pkgInclusions,
        success: function (data) {
            //console.log('Sucess : '+data);
            $('#editInclusionsModel #error-contaier-parent1').hide();
            $('#editInclusionsModel #success-contaier-parent1').show();
            setTimeout(function () {
                location.reload();
            }, 400)
        },
        error: function (data) {
            //console.log('Error : '+data);
            var html = '';
            $.each(JSON.parse(data.responseText), function (index, value) {
                html += '<li>' + value + '</li>';
            });
            //console.log(html);
            $('#editInclusionsModel #error-contaier1').html(' ').html(html);
            $('#editInclusionsModel #error-contaier-parent1').show();
        }
    });
});

//delete Hotel Type
$('.deleteIncType').on('click', function () {
    var TypeId = $(this).attr('data-id');
    if (confirm('Are you sure to delete Inclusion?')) {
        $('#deleteIncType' + TypeId).submit();
    }
});

//For Package Exclusions
$("#add_packages_seo").click(function () {
    var destination = $("#package_seo .destination").val()
    var title = $("#package_seo .title").val()
    var keywords = $("#package_seo .keywords").val()
    var description = $("#package_seo .description").val()
    var packages_seo =
    {
        destination: $("#package_seo .destination").val(),
        title: $("#package_seo .title").val(),
        keywords: $("#package_seo .keywords").val(),
        description: $("#package_seo .description").val(),
    }
    $.ajax({
        type: 'post',
        url: APP_URL + '/add_packages_seo',
        data: packages_seo,
        //contentType: "application/json; charset=utf-8",
        dataType: 'json',
        success: function (data) {
            //console.log('Success : '+data);
            if (data == 'added') {
                $('#package_seo #error-pacseo-contaier-parent').hide();
                $('#package_seo #success-pacseo-contaier-parent').show();
                setTimeout(function () {
                    location.reload();
                }, 300)
            }
        },
        error: function (data) {
            //console.log('Error : '+data);
            var html = '';
            $.each(JSON.parse(data.responseText), function (index, value) {
                html += '<li>' + value + '</li>';
            });
            //console.log(html);
            $('#package_seo #error-pacseo-contaier').html(' ').html(html);
            $('#package_seo #error-pacseo-contaier-parent').show();
        }
    });
});

//
$(".edit_packages_seo").click(function () {
    var seo_id = $(this).siblings(".seo_id").val()
    var destination = $(this).siblings(".seo_destination").val()
    var title = $(this).siblings(".seo_title").val()
    var keywords = $(this).siblings(".seo_keywords").val()
    var description = $(this).siblings(".seo_desc").val()
    $(".edit_pack_seo .seo_id").val(seo_id);
    $(".edit_pack_seo .destination").val(destination);
    $(".edit_pack_seo .title").val(title);
    $(".edit_pack_seo .keywords").val(keywords);
    $(".edit_pack_seo .description").val(description);
});

//
$("#update_packageseo").click(function () {
    var packages_seo =
    {
        seo_id: $("#edit_packages_seo .seo_id").val(),
        destination: $("#edit_packages_seo .destination").val(),
        title: $("#edit_packages_seo .title").val(),
        keywords: $("#edit_packages_seo .keywords").val(),
        description: $("#edit_packages_seo .description").val(),
    }
    $.ajax({
        type: 'post',
        url: APP_URL + '/edit_packages_seo',
        data: packages_seo,
        //contentType: "application/json; charset=utf-8",
        dataType: 'json',
        success: function (data) {
            //console.log('Success : '+data);
            if (data == 'added') {
                $('#edit_packages_seo #error-pacseo-contaier-parent').hide();
                $('#edit_packages_seo #success-pacseo-contaier-parent').show();
                setTimeout(function () {
                    location.reload();
                }, 300)
            }
        },
        error: function (data) {
            //console.log('Error : '+data);
            var html = '';
            $.each(JSON.parse(data.responseText), function (index, value) {
                html += '<li>' + value + '</li>';
            });
            //console.log(html);
            $('#edit_packages_seo #error-pacseo-contaier').html(' ').html(html);
            $('#edit_packages_seo #error-pacseo-contaier-parent').show();
        }
    });
});

//
$(document).on("change", "#change_package", function () {
    var value = $(this).val();
    if (value == "manual") {
        $("#change_packages").html("").html("<input type='text' class='form-control' name='packageId' placeholder='Enter Manual Package'>")
    }
    else {
        $.ajax({
            type: 'post',
            url: APP_URL + '/change_package',
            data: { value: value },
            success: function (data) {
                $("#change_packages").html("").html("<select class='form-control' name='packageId'>" + data + "</select>")
            },
            error: function (data) {
            }
        });
    }
});

//
$('#addExclusions').click(function () {
    var packageExclusions = {
        Name: $('#packageExclusion .name').val(),
        Status: $('#packageExclusion .status').val(),
    }
    //console.log(packageExclusions);
    $.ajax({
        type: 'post',
        url: APP_URL + '/add-exclusion',
        data: packageExclusions,
        //contentType: "application/json; charset=utf-8",
        dataType: 'json',
        success: function (data) {
            //console.log('Success : '+data);
            if (data == 'added') {
                $('#packageExclusion #error-contaier-parent').hide();
                $('#packageExclusion #success-contaier-parent').show();
                setTimeout(function () {
                    location.reload();
                }, 300)
            }
        },
        error: function (data) {
            //console.log('Error : '+data);
            var html = '';
            $.each(JSON.parse(data.responseText), function (index, value) {
                html += '<li>' + value + '</li>';
            });
            //console.log(html);
            $('#packageExclusion #error-contaier').html(' ').html(html);
            $('#packageExclusion #error-contaier-parent').show();
        }
    });
});
//add pay at hotel
$('#addPayAtHotel').click(function () {
    var addPayAtHotelPaymentTypes = {
        Name: $('#payathotelpaymenttype .name').val(),
        Status: $('#payathotelpaymenttype .status').val(),
    }

    console.log(addPayAtHotelPaymentTypes);
    $.ajax({
        type: 'post',
        url: APP_URL + '/add-pay-at-hotel-payment-type',
        data: addPayAtHotelPaymentTypes,
        //contentType: "application/json; charset=utf-8",
        dataType: 'json',
        success: function (data) {
            //console.log('Success : '+data);
            if (data == 'added') {
                $('#payathotelpaymenttype #error-contaier-parent').hide();
                $('#payathotelpaymenttype #success-contaier-parent').show();
                setTimeout(function () {
                    location.reload();
                }, 300)
            }
        },
        error: function (data) {
            //console.log('Error : '+data);
            var html = '';
            $.each(JSON.parse(data.responseText), function (index, value) {
                html += '<li>' + value + '</li>';
            });
            //console.log(html);
            $('#payathotelpaymenttype #error-contaier').html(' ').html(html);
            $('#payathotelpaymenttype #error-contaier-parent').show();
        }
    });
});
// Append data for Edit Type Modal
$(".editExclusionType").on("click", function () {
    var typeId = $(this).attr('data-id');
    // alert(typeId);
    var typeParentId = $(this).closest("tr").attr('id');
    // alert(typeParentId);
    var typeName = $('#' + typeParentId + ' .typename').text();
    var status = $('#' + typeParentId + ' .typestatus input').val();
    //alert(typeName+'/'+status);
    $('#editExclusionsModel .edittypeid').attr('value', typeId);
    $('#editExclusionsModel .incName').attr('value', typeName);
    $('#editExclusionsModel select').val(status);
});
// Append data for Pay At Hotel Payment Type Type Modal
$(".editPaymentTypeModel").on("click", function () {
    var typeId = $(this).attr('data-id');
    // alert(typeId);
    var typeParentId = $(this).closest("tr").attr('id');
    // alert(typeParentId);
    var typeName = $('#' + typeParentId + ' .typename').text();
    var status = $('#' + typeParentId + ' .typestatus input').val();
    //alert(typeName+'/'+status);
    $('#editPaymentTypeModel .edittypeid').attr('value', typeId);
    $('#editPaymentTypeModel .PaymentName').attr('value', typeName);
    $('#editPaymentTypeModel select').val(status);
});
// Edit Exclusions Modal
$("#updateExclusionbtn").on("click", function () {
    //  alert($('#editHotelTypeModal .edittypeid').val());
    var pkgExclusions = {
        id: $('#editExclusionsModel .edittypeid').val(),
        Name: $('#editExclusionsModel .incName').val(),
        Status: $('#editExclusionsModel .incStatus').val(),
    }
    //console.log(pkgExclusions);
    $.ajax({
        type: 'POST',
        url: APP_URL + '/edit-exclusion',
        dataType: 'json',
        data: pkgExclusions,
        success: function (data) {
            //console.log('Sucess : '+data);
            $('#editExclusionsModel #error-contaier-parent1').hide();
            $('#editExclusionsModel #success-contaier-parent1').show();
            setTimeout(function () {
                location.reload();
            }, 400)
        },
        error: function (data) {
            console.log('Error : ' + data);
            var html = '';
            $.each(JSON.parse(data.responseText), function (index, value) {
                html += '<li>' + value + '</li>';
            });
            //console.log(html);
            $('#editExclusionsModel #error-contaier1').html(' ').html(html);
            $('#editExclusionsModel #error-contaier-parent1').show();
        }
    });
});
//
$("#updatePayHotelPaymentType").on("click", function () {
    //  alert($('#editHotelTypeModal .edittypeid').val());
    var pkgExclusions = {
        id: $('#editPaymentTypeModel .edittypeid').val(),
        Name: $('#editPaymentTypeModel .PaymentName').val(),
        Status: $('#editPaymentTypeModel .incStatus').val(),
    }

    //console.log(pkgExclusions);
    $.ajax({
        type: 'POST',
        url: APP_URL + '/edit-pay-at-hotel-payment-type',
        dataType: 'json',
        data: pkgExclusions,
        success: function (data) {
            //console.log('Sucess : '+data);
            $('#editPaymentTypeModel #error-contaier-parent1').hide();
            $('#editPaymentTypeModel #success-contaier-parent1').show();
            setTimeout(function () {
                location.reload();
            }, 400)
        },
        error: function (data) {
            console.log('Error : ' + data);
            var html = '';
            $.each(JSON.parse(data.responseText), function (index, value) {
                html += '<li>' + value + '</li>';
            });
            //console.log(html);
            $('#editPaymentTypeModel #error-contaier1').html(' ').html(html);
            $('#editPaymentTypeModel #error-contaier-parent1').show();
        }
    });
});
//delete Hotel Type
$('.deleteExcType').on('click', function () {
    var TypeId = $(this).attr('data-id');
    if (confirm('Are you sure to delete Exclusion?')) {
        $('#deleteExcType' + TypeId).submit();
    }
});
//
$('.deletePaymentType').on('click', function () {
    var TypeId = $(this).attr('data-id');
    if (confirm('Are you sure to delete Pay AT Hotel Payment Type?')) {
        $('#deletePayHotelPayment' + TypeId).submit();
    }
});
//Add package Tours
$(".custom_tour").click(function (e) {
    e.preventDefault()
});

// Append data for Edit Tours
$(".editTourType").on("click", function () {
    var typeId = $(this).attr('data-id');
    // alert(typeId);
    var typeParentId = $(this).closest("tr").attr('id');
    // alert(typeParentId);
    var typeName = $('#' + typeParentId + ' .typename').text();
    var typedesc = $('#' + typeParentId + ' .typedesc input').val();
    var typelocation_id = $('#' + typeParentId + ' .typelocation .typelocation_id').val();
    var typelocation_name = $('#' + typeParentId + ' .typelocation .typelocation_name').val();


    var typeduration = $('#' + typeParentId + ' .typeduration').text();
    var typeinclusions = $('#' + typeParentId + ' .typeinclusions').text();
    var typeexclusions = $('#' + typeParentId + ' .typeexclusions').text();
    var status = $('#' + typeParentId + ' .typestatus input').val();
    var img_src = $('#' + typeParentId + ' .sightseeing_img img').attr("src");

    var edit_img_value = $('#' + typeParentId + ' .edit_img_value').val();
    //alert(typeName+'/'+status);
    CKEDITOR.instances['edit_description1'].setData(typedesc);
    $('#editToursModel .edittypeid').attr('value', typeId);
    $('#editToursModel .name').attr('value', typeName);
    //$('.edit_description').insertText('<p>This is a new paragraph.</p>');
    // $('#editToursModel .location').attr('value', typelocation);
    $('#editToursModel .location').html('').html('<option value="'+typelocation_id+'" selected>'+typelocation_name+'</option>');
    $('#editToursModel .duration').attr('value', typeduration);
    $('#editToursModel .inclusions').attr('value', typeinclusions);
    $('#editToursModel .exclusions').attr('value', typeexclusions);
    $('#editToursModel .incStatus').val(status);
    $('#editToursModel img').attr('src', img_src);
    $('#editToursModel .tour_image').attr('value', edit_img_value);
});

//delete Package Tours
$('.deleteTour').on('click', function () {
    var TypeId = $(this).attr('data-id');
    if (confirm('Are you sure to delete Tour?')) {
        $('#deleteTour' + TypeId).submit();
    }
});

//
$(".editActivityType").on("click", function () {
    var typeId = $(this).attr('data-id');
    var typeParentId = $(this).closest("tr").attr('id');
    var typeName = $('#' + typeParentId + ' .typename').text();
    var typedesc = $('#' + typeParentId + ' .typedesc input').val();

    var typelocation_id = $('#' + typeParentId + ' .typelocation .typelocation_id').val();
    var typelocation_name = $('#' + typeParentId + ' .typelocation .typelocation_name').val();

     var typeduration = $('#' + typeParentId + ' .typeduration').text();
    var typeinclusions = $('#' + typeParentId + ' .typeinclusions').text();
    var typeexclusions = $('#' + typeParentId + ' .typeexclusions').text();
    var status = $('#' + typeParentId + ' .typestatus input').val();
    var img_src = $('#' + typeParentId + ' .sightseeing_img img').attr("src");
    var activity_img_value = $('#' + typeParentId + ' .activity_img_value').val();
    CKEDITOR.instances['edit_description'].setData(typedesc);
    $('#editActivityModel .editactivityid').attr('value', typeId);
    $('#editActivityModel .name').attr('value', typeName);
    // $('#editActivityModel .location').attr('value', typelocation);
    $('#editActivityModel .location').html('').html('<option value="'+typelocation_id+'" selected>'+typelocation_name+'</option>');
    $('#editActivityModel .duration').attr('value', typeduration);
    $('#editActivityModel .inclusions').attr('value', typeinclusions);
    $('#editActivityModel .exclusions').attr('value', typeexclusions);
    $('#editActivityModel .incStatus').val(status);
    $('#editActivityModel img').attr('src', img_src);
    $('#editActivityModel .activity_image_value').attr('value', activity_img_value);
});

//
$(".editTourType").on("click", function () {
    var typeId = $(this).attr('data-id');
    var typeParentId = $(this).closest("tr").attr('id');
    var typeName = $('#' + typeParentId + ' .typename').text();
    var img_src = $('#' + typeParentId + ' .sightseeing_img img').attr("src");
    var tour_type_img_value = $('#' + typeParentId + ' .tour_type_img_value').val();
    var typedesc = $('#' + typeParentId + ' .typedesc input').val();
    var status = $('#' + typeParentId + ' .typestatus input').val();
    CKEDITOR.instances['edit_tour_type_description'].setData(typedesc);
    $('#edittourtypeModel .edittourtypeid').attr('value', typeId);
    $('#edittourtypeModel .tour_type').attr('value', typeName);
    $('#edittourtypeModel .incStatus').val(status);
    $('#edittourtypeModel img').attr('src', img_src);
    $('#edittourtypeModel .tour_type_image_value').attr('value', tour_type_img_value);
});

//
$('.deletetourtype').on('click', function () {
    var TypeId = $(this).attr('data-id');
    if (confirm('Are you sure to delete Tour Type ?')) {
        $('#deletetourtype' + TypeId).submit();
    }
});

//
$(".editTourCategory").on("click", function () {
    var typeId = $(this).attr('data-id');
    var typeParentId = $(this).closest("tr").attr('id');
    var typeName = $('#' + typeParentId + ' .typename').text();
    var img_src = $('#' + typeParentId + ' .sightseeing_img img').attr("src");
    var tour_category_img_value = $('#' + typeParentId + ' .tour_category_img_value').val();
    var typedesc = $('#' + typeParentId + ' .typedesc input').val();
    var status = $('#' + typeParentId + ' .typestatus input').val();
    CKEDITOR.instances['edit_tour_category_description'].setData(typedesc);
    $('#edittourcategoryModel .edittourcategoryid').attr('value', typeId);
    $('#edittourcategoryModel .tour_category').attr('value', typeName);
    $('#edittourcategoryModel .incStatus').val(status);
    $('#edittourcategoryModel img').attr('src', img_src);
    $('#edittourcategoryModel .tour_category_image_value').attr('value', tour_category_img_value);
});

//
$('.deletetourcategory').on('click', function () {
    var TypeId = $(this).attr('data-id');
    if (confirm('Are you sure to delete Tour Type ?')) {
        $('#deletetourcategory' + TypeId).submit();
    }
});

//
$(document).on("click", ".img_gall", function () {
    var cou_name = $(this).siblings(".cou_name").val()
    var cou_id = $(this).siblings(".cou_name").attr("c_id")
    var sta_name = $(this).siblings(".sta_name").val()
    var cit_name = $(this).siblings(".cit_name").val()
    var name_name = $(this).siblings(".name_name").val()
    var img_name = $(this).siblings(".img_name").val()
    var pac_id = $(this).siblings(".pac_id").val()
    var img_val = $(this).siblings(".img_value").val()
    var gallery_country = $(".gallery_country").val();
    var gallery_state = $(".gallery_state").val();
    var gallery_city = $(".gallery_city").val();
    var search_by_name = $(".search_by_name").val();
    $('.img_gallery_edit_value .country_val select').val(cou_name);
    $('.img_gallery_edit_value .img_name ').val(name_name);
    $('.img_gallery_edit_value .img_up img').attr("src", img_name);
    $('.img_gallery_edit_value .img_pac_id').val(pac_id);
    $('.img_gallery_edit_value .im_value').val(img_val);
    $('.img_gallery_edit_value .c_val').val(gallery_country);
    $('.img_gallery_edit_value .s_val').val(gallery_state);
    $('.img_gallery_edit_value .ct_val').val(gallery_city);
    $('.img_gallery_edit_value .search_val').val(search_by_name);
    //
    $.ajax({
        type: 'POST',
        url: APP_URL + '/get_gall_state',
        // dataType: 'json',
        data: { country: cou_name, sta_name: sta_name },
        success: function (data) {
            //console.log('Sucess : '+data);
            $('.img_gallery_edit_value .state_val').html('').html(data);
        },
        error: function (data) {
            //console.log('Error : '+data);
        }
    });
    $.ajax({
        type: 'POST',
        url: APP_URL + '/get_gall_city',
        // dataType: 'json',
        data: { sta_name: sta_name, cit_name: cit_name },
        success: function (data) {
            //console.log('Sucess : '+data);
            $('.img_gallery_edit_value .city_val').html('').html(data);
        },
        error: function (data) {
            //console.log('Error : '+data);
        }
    });
});

//
$(document).on("click", "#update_gallery", function (event) {
    event.preventDefault();
    var form_data = new FormData($("#gallery_form")[0]);
    var page = $(".img_gal_pag").children().children(".active").children().html()
    $.ajax({
        url: APP_URL + '/edit_gallery_form?page=' + page,
        data: form_data,
        type: 'post',
        contentType: false,
        processData: false,
        success: function (data) {
            console.log('Sucess : ' + data);
            $("#gallery_sorting").html('').html(data);
        },
        error: function (xhr, status, error) {
            //alert(xhr.responseText);
            //console.log('Error : '+data);
            //console.log('Error : '+data);
            var html = '';
            $.each(JSON.parse(data.responseText), function (index, value) {
                html += '<li>' + value + '</li>';
            });
            //console.log(html);
        }
    });
});

//
$(document).on("click", ".delete_gall", function (event) {
    var gallery_country = $(".gallery_country").val();
    var gallery_state = $(".gallery_state").val();
    var page = $(".img_gal_pag").children().children(".active").children().html()
    var gallery_city = $(".gallery_city").val();
    var search_by_name = $(".search_by_name").val();
    var pac_id = $(this).data("id");
    var r = confirm("Are you sure Delete This Image?")
    if (r == true) {
        $.ajax({
            type: 'POST',
            url: APP_URL + '/delete_image_ingall?page=' + page,
            // dataType: 'json',
            data: { id: pac_id, country: gallery_country, state: gallery_state, city: gallery_city, search_by_city: search_by_name },
            success: function (data) {
                //console.log('Sucess : '+data);
                $("#gallery_sorting").html('').html(data);
            },
            error: function (data) {
                //console.log('Error : '+data);
            }
        });
    }  else {
        //nothing to do here
    }
});

// image gallery fetch pagination data
$(document).on('click', '.img_gal_pag .pagination a', function (e) {
    e.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    fetch_data(page);
    //alert(page)
});

// image gallery pagination data
function fetch_data(page) {
    var gallery_country = $(".gallery_country").val();
    var gallery_state = $(".gallery_state").val();
    var gallery_city = $(".gallery_city").val();
    var search_by_name = $(".search_by_name").val()
    $.ajax({
        url: APP_URL + '/img_gallery/fetch_data?page=' + page,
        data: { search_by_name: search_by_name, gallery_country: gallery_country, gallery_state: gallery_state, gallery_city: gallery_city },
        success: function (data) {
            console.log(data)
            $("#gallery_sorting").html('').html(data);
        }
    });
}
function get_gallery_data()
{
  var gallery_country = $(".gallery_country").val();
    var gallery_state = $(".gallery_state").val();
    var gallery_city = $(".gallery_city").val();
    var search_by_name = $(".search_by_name").val()
    $.ajax({
        type: 'POST',
        url: APP_URL + '/search_name_gallery',
        // dataType: 'json',
        data: { country: gallery_country, state: gallery_state, city: gallery_city, search_by_city: search_by_name },
        success: function (data) {
            console.log('Sucess : ' + data);
            $("#gallery_sorting").html('').html(data);
        },
        error: function (data) {
            //console.log('Error : '+data);
        }
    });   
}
$(document).on("click",".find_images", function(event)
{
event.preventDefault()
get_gallery_data()
})
// image gallery search by name
$(document).on("keyup", ".search_by_name", function (event) {
    get_gallery_data()
   
});

// Payment Method
$('.paymentMethods').click(function () {
    var condition = '';
    var id = '';
    $(".paymentMethods").each(function () {
        if ($(this).is(':checked')) {
            condition += $(this).val();
            condition += '\n';
            id += $(this).attr('lang');
            id += ',';
        }
    });
    $('#payment_policies').val(condition);
    $('#payment_policies_input').val(id);
});

// Visa Policies
$('.visaMethods').click(function () {
    var condition = '';
    var id = '';
    $(".visaMethods").each(function () {
        if ($(this).is(':checked')) {
            condition += $(this).val();
            condition += '\n';
            id += $(this).attr('lang');
            id += ',';
        }
    });
    $('#visa_policies').val(condition);
    $('#visa_policies_input').val(id);
});

// Cancelation Policy
$('.cancellation').click(function () {
    var conditionC = '';
    var idC = '';
    $(".cancellation").each(function () {
        if ($(this).is(':checked')) {
            conditionC += $(this).val();
            conditionC += '\n';
            idC += $(this).attr('lang');
            idC += ',';
        }
    });
    $('#cancle_policy').val(conditionC);
    $('#cancellation_input_field').val(idC);
});

//
$('#package_dest_country').on('change', function () {
    $.ajax({
        type: 'POST',
        url: APP_URL + '/get-cities',
        // dataType: 'json',
        data: { state: $(this).val(), cotegory: $('#category').val() },
        success: function (data) {
            //console.log('Sucess : '+data);
            $('#package_dest_city').html('').html(data);
        },
        error: function (data) {
            //console.log('Error : '+data);
        }
    });
    $.ajax({
        type: 'POST',
        url: APP_URL + '/get-locations',
        // dataType: 'json',
        data: { state: $(this).val(), cotegory: $('#category').val() },
        success: function (data) {
            //console.log('Sucess : '+data);
            $('#package_location_city').html('').html(data);
        },
        error: function (data) {
            //console.log('Error : '+data);
        }
    });
});

//
$('#category').on('change', function () {
    if ($(this).val() == 'international') {
        $.ajax({
            type: 'POST',
            url: APP_URL + '/get-country',
            // dataType: 'json',
            data: { state: $(this).val(), type: 'international' },
            success: function (data) {
                //console.log('Sucess : '+data);
                $('#package_dest_country').html('').html(data);
            },
            error: function (data) {
                //console.log('Error : '+data);
            }
        });
    } else {
        $.ajax({
            type: 'POST',
            url: APP_URL + '/get-country',
            // dataType: 'json',
            data: { state: $(this).val(), type: 'domestic' },
            success: function (data) {
                //console.log('Sucess : '+data);
                $('#package_dest_country').html('').html(data);
            },
            error: function (data) {
                //console.log('Error : '+data);
            }
        });
    }
});

// price on request
$('#onrequest').click(function () {
    if ($(this).is(':checked')) {
        $('.pricelistpackage').hide();
    } else {
        $('.pricelistpackage').show();
        $('#upcoming').prop('checked', $(this).is(':checked') ? false : true);
        $('.pricelistpackage_upcoming').hide();
    }
});

// price upcoming
$('#upcoming').click(function () {
    if ($(this).is(':checked')) {
        $('.pricelistpackage_upcoming').hide();
    } else {
        $('.pricelistpackage_upcoming').show();
        $('#onrequest').prop('checked', $(this).is(':checked') ? false : true);
        $('.pricelistpackage').hide();
    }
});

//append payment policy in model
$(".edit_pkgPayPolicy").on("click", function () {
    var typeId = $(this).attr('data-id');
    // alert(typeId);
    var typeParentId = $(this).closest("tr").attr('id');
    var typeName = $('#' + typeParentId + ' .packagePayPolicy').text();
    var typedesc = $('#' + typeParentId + ' .packagePayDesc input').val();
    var status = $('#' + typeParentId + ' .poltypestatus input').val();
    CKEDITOR.instances['pkgPayDesc'].setData(typedesc);
    $('.editPkgPayPolicy .edittypeid').val(typeId);
    $('.editPkgPayPolicy #pkgPolicyName').val(typeName);
    $('.editPkgPayPolicy select').val(status);
});

//append payment policy in model
$(".edit_pkgCanPolicy").on("click", function () {
    var typeId = $(this).attr('data-id');
    // alert(typeId);
    var typeParentId = $(this).closest("tr").attr('id');
    var typeName = $('#' + typeParentId + ' .canPolicy').text();
    var typedesc = $('#' + typeParentId + ' .canPolicydesc input').val();
    var status = $('#' + typeParentId + ' .canPolicystatus input').val();
    CKEDITOR.instances['canPolicyDesc'].setData(typedesc);
    $('.editPkgCanPolicy .edittypeid').val(typeId);
    $('.editPkgCanPolicy #pkgPolicyName').val(typeName);
    $('.editPkgCanPolicy select').val(status);
});

// edit important notes
$(".edit_impnotes").on("click", function () {
    var typeId = $(this).attr('data-id');
    //alert(typeId);
    var typeParentId = $(this).closest("tr").attr('id');
    var typeName = $('#' + typeParentId + ' .imp_notes').text();
    var typedesc = $('#' + typeParentId + ' .imp_desc input').val();
    var status = $('#' + typeParentId + ' .imp_status input').val();
    CKEDITOR.instances['notes_desc'].setData(typedesc);
    $('.editimpnotes .edittypeid').val(typeId);
    $('.editimpnotes #notes_name').val(typeName);
    $('.editimpnotes select').val(status);
});

//
$(".editquotationheader").on("click", function () {
    var typeId = $(this).attr('data-id');
    var typeParentId = $(this).closest("tr").attr('id');
    var typeName = $('#' + typeParentId + ' .quo_header').text();
    var typedesc = $('#' + typeParentId + ' .quo_desc input').val();
    var status = $('#' + typeParentId + ' .quo_status input').val();
    CKEDITOR.instances['header_desc'].setData(typedesc);
    $('.edit_quotationheader .edittypeid').val(typeId);
    $('.edit_quotationheader #quotationheader').val(typeName);
    $('.edit_quotationheader select').val(status);
});

//
$(".editquotationfooter").on("click", function () {
    var typeId = $(this).attr('data-id');
    var typeParentId = $(this).closest("tr").attr('id');
    var typeName = $('#' + typeParentId + ' .quo_footer').text();
    var typedesc = $('#' + typeParentId + ' .quo_desc input').val();
    var status = $('#' + typeParentId + ' .quo_status input').val();
    CKEDITOR.instances['footer_desc'].setData(typedesc);
    $('.edit_quotationfooter .edittypeid').val(typeId);
    $('.edit_quotationfooter #quotationfooter').val(typeName);
    $('.edit_quotationfooter select').val(status);
});

//
$(".edit_pkgvisaPolicy").on("click", function () {
    var typeId = $(this).attr('data-id');
    // alert(typeId);
    var typeParentId = $(this).closest("tr").attr('id');
    var typeName = $('#' + typeParentId + ' .visaPolicy').text();
    var typeDesc = $('#' + typeParentId + ' .visaPolicyDesc input').val();
    var status = $('#' + typeParentId + ' .visaPolicystatus input').val();
    CKEDITOR.instances['pkgPolicyDesc'].setData(typeDesc);
    $('.editPkgVisaPolicy .edittypeid').val(typeId);
    $('.editPkgVisaPolicy #pkgPolicyName').val(typeName);
    $('.editPkgVisaPolicy select').val(status);
});

//append traveller type in model
$(".edit_pkgTravellerType").on("click", function () {
    var typeId = $(this).attr('data-id');
    // alert(typeId);
    var typeParentId = $(this).closest("tr").attr('id');
    var typeName = $('#' + typeParentId + ' .travellername').text();
    var status = $('#' + typeParentId + ' .travellerstatus input').val();
    $('.editPkgTravellerType .edittypeid').val(typeId);
    $('.editPkgTravellerType .travellerTypeName').val(typeName);
    $('.editPkgTravellerType select').val(status);
});

//append rating type in model
$(".edit_pkgRatingType").on("click", function () {
    var typeId = $(this).attr('data-id');
    // alert(typeId);
    var typeParentId = $(this).closest("tr").attr('id');
    var typeName = $('#' + typeParentId + ' .ratingname').text();
    var status = $('#' + typeParentId + ' .ratingstatus input').val();
    $('.editPkgRatingType .edittypeid').val(typeId);
    $('.editPkgRatingType .ratingTypeName').val(typeName);
    $('.editPkgRatingType select').val(status);
});

//
jQuery(document).ready(function () {
    $('.wrap_small').find('a[href=""]').on('click', function (e) {
        e.preventDefault();
        var class_name = $(this).siblings().attr("class")
        if (class_name == "small_class") {
            $(this).closest('.wrap_small').find('.small_class').toggleClass('small_class big_class');
            $(this).html("Hide")
        }
        else {
            $(this).closest('.wrap_small').find('.big_class').toggleClass('big_class small_class');
            $(this).html("Show More")
        }
    });
});
function show_itinerary()
{
var add_itinerary = $("#add_itinerary").is(':checked')
if(add_itinerary)
{
$(".c_body").css('display', 'block')
}
else
{
 $(".c_body").css('display', 'none')
}
}
$(document).ready(function(){
    show_itinerary()
})
jQuery("#add_itinerary").change(function () {
     show_itinerary()
});
//
jQuery("#show_flight_options").change(function () {
    var ischecked = $(this).is(':checked');
    if (ischecked) {
        jQuery('.flight').css('display', 'block');
        jQuery('#onward_required').prop('checked',true);
        jQuery('.onwardflight').css('display', 'block');
        jQuery('#return_required').prop('checked',true);
        jQuery('.returnflight').css('display', 'block');
        // jQuery('#onward_required').attr('checked', true);
        // jQuery('#return_required').attr('checked', true);
    } else {
        jQuery('.flight').css('display', 'none');
    }
});

//
jQuery(document).ready(function () {
    var ischecked = $("#show_flight_options").is(':checked');
    if (ischecked) {
        jQuery('.flight').css('display', 'block');
    } else {
        jQuery('.flight').css('display', 'none');
    }
});

//
jQuery("#onward_required").change(function () {
    var ischecked = $(this).is(':checked');
    if (ischecked) {
        jQuery('.onwardflight').css('display', 'block');
    } else {
        jQuery('.onwardflight').css('display', 'none');
    }
    var onward_check = $('input[name="flight[onward_required]"]:checked').length;
    var down_check = $('input[name="flight[return_required]"]:checked').length;
    if (!onward_check && !down_check) {
      jQuery('#show_flight_options').attr('checked', false);
    } else {
        jQuery('#show_flight_options').prop('checked',true);
    }
});

//
jQuery("#return_required").change(function () {
    var ischecked = $(this).is(':checked');
    if (ischecked) {
        jQuery('.returnflight').css('display', 'block');
    } else {
        jQuery('.returnflight').css('display', 'none');
    }
    //
    var onward_check = $('input[name="flight[onward_required]"]:checked').length;
    var down_check = $('input[name="flight[return_required]"]:checked').length;
    if (!onward_check && !down_check) {
      $('#show_flight_options').attr('checked', false);
    } else {
        jQuery('#show_flight_options').prop('checked',true);
    }
});

//
jQuery(document).ready(function () {
    $("#packages_search").keyup(function () {
        var value = $(this).val()
        $.ajax({
            type: 'POST',
            url: APP_URL + '/list_data',
            data: { value: value },
            success: function (data) {
                $("#list_dynamic_data").html("").html(data)
                console.log(data);
            },
            error: function (data) {
            }
        })
    })
});

//
jQuery(document).ready(function () {
    jQuery('#package_durations').change(function () {
        jQuery('.daylog').hide();
        var daycount = jQuery($(this)).val();
        for (i = 1; i <= daycount; i++) {
            jQuery('.day' + i).show();
        }
    });
    jQuery('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
        localStorage.setItem('activeTab', jQuery(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if (activeTab) {
        jQuery('a[href="' + activeTab + '"]').tab('show');
    }
});

//
$('#package_arrival_country').change(function () {
    alert($(this).val());
    $.ajax({
        type: 'POST',
        url: APP_URL + '/get-states',
        dataType: 'json',
        data: pkgExclusions,
        success: function (data) {
            //console.log('Sucess : '+data);
            $('#editExclusionsModel #error-contaier-parent1').hide();
            $('#editExclusionsModel #success-contaier-parent1').show();
            setTimeout(function () {
                location.reload();
            }, 400)
        },
        error: function (data) {
            //console.log('Error : '+data);
            var html = '';
            $.each(JSON.parse(data.responseText), function (index, value) {
                html += '<li>' + value + '</li>';
            });
            //console.log(html);
            $('#editExclusionsModel #error-contaier1').html(' ').html(html);
            $('#editExclusionsModel #error-contaier-parent1').show();
        }
    });
});

//
$("#transport").change(function () {
    var t_value = $(this).val();
    if (t_value == "Flight") {
        $(".oflight").css("display", "none")
        $(".flight").css("display", "block")
    }
    else {
        $(".oflight").css("display", "block")
        $(".flight").css("display", "none")
    }
});

//
$("#transport1").change(function () {
    var t_value = $(this).val();
    if (t_value == "Flight") {
        $(".oflight1").css("display", "none")
        $(".flight1").css("display", "block")
    }
    else {
        $(".oflight1").css("display", "block")
        $(".flight1").css("display", "none")
    }
});

$("#transport2").change(function () {
    var t_value = $(this).val();
    if (t_value == "Flight") {
        $(".oflight2").css("display", "none")
        $(".flight2").css("display", "block")
    }
    else {
        $(".oflight2").css("display", "block")
        $(".flight2").css("display", "none")
    }
});

$("#transport3").change(function () {
    var t_value = $(this).val();
    if (t_value == "Flight") {
        $(".oflight3").css("display", "none")
        $(".flight3").css("display", "block")
    }
    else {
        $(".oflight3").css("display", "block")
        $(".flight3").css("display", "none")
    }
});

// flight show/hide
$(document).on('change', '.transport', function () {
    var t_value = $(this).val();
    if (t_value == "Flight") {
        $(this).parents().siblings(".oflight").css("display", "none")
        $(this).parents().parents().siblings(".flight").css("display", "block")
    }
    else {
        $(this).parents().siblings(".oflight").css("display", "block")
        $(this).parents().parents().siblings(".flight").css("display", "none")
    }
});

// second page enable/disable package status
/*$(document).on("click", ".btn_enable", function () {
    var variable = $(this).html();
    var pak_id = $(this).val();
    if (variable == "Disable") {
        $(this).removeClass("btn-success");
        $(this).addClass("btn-danger");
        $(this).html("Enable")
        $.ajax({
            type: 'POST',
            url: APP_URL + '/enable',
            // dataType: 'json',
            data: { status: '0', pak_id: pak_id },
            success: function (data) {
                console.log('Sucess : ' + data,);
            },
            error: function (data) {
                //console.log('Error : '+data);
            }
        });
    }
    else if (variable == "Enable") {
        $(this).removeClass("btn-danger");
        $(this).addClass("btn-success");
        $(this).html("Disable")
        $.ajax({
            type: 'POST',
            url: APP_URL + '/disable',
            // dataType: 'json',
            data: { status: '1', pak_id: pak_id },
            success: function (data) {
                console.log('Sucess : ' + data,);
            },
            error: function (data) {
                //console.log('Error : '+data);
            }
        });
    }
});*/

// Enable/Disable package status when the button is clicked
$(document).on("click", ".btn_enable", function () {
    var button = $(this);
    var currentText = button.html();   // Get the current button text
    var pak_id = button.val();         // Get the package ID from the button value
    var status = (currentText === "Enabled") ? '0' : '1';   // Determine the status to set (Enabled/Disabled)

    // Toggle the button style and text based on the current status
    if (status === '0') {
        button.removeClass("btn-success").addClass("btn-danger").html("Disabled");
    } else {
        button.removeClass("btn-danger").addClass("btn-success").html("Enabled");
    }

    // AJAX request to update the package status
    $.ajax({
        type: 'POST',
        url: APP_URL + '/package_status',  // Updated URL
        data: { status: status, pak_id: pak_id },  // Send the new status and package ID
        success: function (data) {
            console.log('Success: ' + data.message);  // Log the success message
        },
        error: function (data) {
            console.log('Error: ' + data);  // Handle errors if needed
        }
    });
});


/*// home page enable/disable package status
$(document).on("click", ".btn_front_enable", function () {
    var variable = $(this).html();
    var pak_id = $(this).val();
    if (variable == "Disable") {
        $(this).removeClass("btn-success");
        $(this).addClass("btn-danger");
        $(this).html("Enable")
        $.ajax({
            type: 'POST',
            url: APP_URL + '/front_enable',
            // dataType: 'json',
            data: { status: '0', pak_id: pak_id },
            success: function (data) {
                console.log('Sucess : ' + data,);
            },
            error: function (data) {
                //console.log('Error : '+data);
            }
        });
    } else if (variable == "Enable") {
        $(this).removeClass("btn-danger");
        $(this).addClass("btn-success");
        $(this).html("Disable")
        $.ajax({
            type: 'POST',
            url: APP_URL + '/front_disable',
            // dataType: 'json',
            data: { status: '1', pak_id: pak_id },
            success: function (data) {
                console.log('Sucess : ' + data,);
            },
            error: function (data) {
                //console.log('Error : '+data);
            }
        });
    }
});*/

// Enable/Disable front show status when the button is clicked
$(document).on("click", ".btn_front_enable", function () {
    var button = $(this);
    var currentText = button.html();  // Get current button text (Enabled/Disabled)
    var pak_id = button.val();        // Get package ID from the button value
    var status = (currentText === "Enabled") ? '0' : '1';   // Determine the status to set

    // Toggle button style and text based on the current status
    if (status === '0') {
        button.removeClass("btn-success").addClass("btn-danger").html("Disabled");
    } else {
        button.removeClass("btn-danger").addClass("btn-success").html("Enabled");
    }

    // AJAX request to update front_show status
    $.ajax({
        type: 'POST',
        url: APP_URL + '/home_page_package_status',  // Updated URL for front show status toggle
        data: { status: status, pak_id: pak_id },  // Send new status and package ID
        success: function (data) {
            console.log('Success: ' + data.message);  // Log success message
        },
        error: function (data) {
            console.log('Error: ' + data);  // Log error if occurs
        }
    });
});


// Enable/Disable search status when the button is clicked
$(document).on("click", ".btn_search_enable", function () {
    var variable = $(this).html();   // Get the current button text
    var pak_id = $(this).val();      // Get the package ID from the button value
    var status = (variable === "Enabled") ? '0' : '1';   // Determine the status to set (Enabled/Disabled)
        
    // Toggle the button style and text based on the status
    if (status === '0') {
        $(this).removeClass("btn-success").addClass("btn-danger").html("Disabled");
    } else {
        $(this).removeClass("btn-danger").addClass("btn-success").html("Enabled");
    }
        
    // AJAX request to toggle the search status
    $.ajax({
        type: 'POST',
        url: APP_URL + '/search_status',  // The endpoint for toggling the search status
        data: { status: status, pak_id: pak_id },  // Sending the status and package ID
        success: function (data) {
            console.log('Success: ' + data.message);  // Log success message
        },
        error: function (data) {
            console.log('Error: ' + data);  // Log error if the request fails
        }
    });
});


// delete package
$(document).on("click", ".deletePackage", function(e) {
    e.preventDefault(); // Prevent the default action of the link/button

    // Confirm with the user if they want to continue with the deletion
    var user_choice = window.confirm('Are you sure you want to delete this item??');

    // Get the ID of the package to be deleted
    var delete_id = $(this).attr("id");

    // If the user confirms, submit the form with the delete ID
    if (user_choice == true) {
        document.getElementById(delete_id).submit();
    } else {
        // If the user cancels, do nothing
        return false;
    }
});

// add country
$(document).on("change", ".addcountry", function () {
    // Get the selected country value
    var addcountry = $(this).val();

    // AJAX request to fetch states based on the selected country
    $.ajax({
        type: 'get',
        url: APP_URL + '/addcountry',
        data: { addcountry: addcountry },

        success: function (data) {
            // Populate the state dropdown with the received data
            $(".addstate").html('').html(data);
            // Clear the city dropdown
            $(".addcity").html('');
        },

        error: function (data) {
            // Handle error if needed
            // console.log('Error: ' + data);
        }
    });
});

// add state
$(document).on("change", ".addstate", function () {
    // Get the selected country value
    var addcountry = $(".addcountry").val();
    // Get the selected state value
    var addstate = $(this).val();

    // AJAX request to fetch cities based on the selected country and state
    $.ajax({
        type: 'get',
        url: APP_URL + '/addstate',
        data: { addcountry: addcountry, addstate: addstate },

        success: function (data) {
            // Populate the city dropdown with the received data
            $(".addcity").html('').html(data);
        },

        error: function (data) {
            // Handle error if needed
            // console.log('Error: ' + data);
        }
    });
});


// push tour package UP in order
$(document).on("click", ".up", function () {
    // Get the package ID from the clicked button
    var pak_id = $(this).val();

    // AJAX request to update the package
    $.ajax({
        type: 'get',
        url: APP_URL + '/up_package',
        data: { pak_id: pak_id },

        success: function (data) {
            // Fetch updated data after successful AJAX call
            fetch_datas('nochange');
        },

        error: function (data) {
            // Handle error if needed
            // console.log('Error: ' + data);
        }
    });
});

/*// Enable/Disable location status when the button is clicked
$(document).on("click", ".location_btn_enable", function () {
    var variable = $(this).html();
    var pak_id = $(this).val();
    if (variable == "Disable") {
        $(this).removeClass("btn-success");
        $(this).addClass("btn-danger");
        $(this).html("Enable")
        $.ajax({
            type: 'POST',
            url: APP_URL + '/location_enable',
            // dataType: 'json',
            data: { status: '0', pak_id: pak_id },
            success: function (data) {
                console.log('Sucess : ' + data,);
            },
            error: function (data) {
                //console.log('Error : '+data);
            }
        });
    }
    else if (variable == "Enable") {
        $(this).removeClass("btn-danger");
        $(this).addClass("btn-success");
        $(this).html("Disable")
        $.ajax({
            type: 'POST',
            url: APP_URL + '/location_disable',
            // dataType: 'json',
            data: { status: '1', pak_id: pak_id },
            success: function (data) {
                console.log('Sucess : ' + data,);
            },
            error: function (data) {
                //console.log('Error : '+data);
            }
        });
    }
});*/

/*// Enable/Disable location status when the button is clicked
$(document).on("click", ".location_btn_enable", function () {
    var currentStatus = $(this).html().trim();   // Get the current button text and trim any whitespace
    var pak_id = $(this).val();                  // Get the location ID from the button value
    var newStatus = (currentStatus === "Enabled") ? '0' : '1';   // Determine the new status to set (Enabled/Disabled)
        
    // Toggle the button style and text based on the new status
    if (newStatus === '0') {
        $(this).removeClass("btn-success").addClass("btn-danger").html("Disabled");
    } else {
        $(this).removeClass("btn-danger").addClass("btn-success").html("Enabled");
    }
        
    // AJAX request to toggle the location status
    $.ajax({
        type: 'POST',
        url: APP_URL + '/location_toggle_status',  // The endpoint for toggling the location status
        data: { status: newStatus, pak_id: pak_id },  // Sending the new status and location ID
        success: function (data) {
            console.log('Success: ' + data.message);  // Log success message
        },
        error: function (data) {
            console.log('Error: ' + data);  // Log error if the request fails
        }
    });
});*/

// Enable/Disable location status when the button is clicked
$(document).on("click", ".location_btn_enable", function () {
    var button = $(this);
    var currentStatus = button.html().trim();
    var pak_id = button.val();
    var newStatus, newClass, newText;

    if (currentStatus === "Enabled") {
        newStatus = '0';  // Disable the location
        newClass = "btn-danger";
        newText = "Disabled";
    } else {
        newStatus = '1';  // Enable the location
        newClass = "btn-success";
        newText = "Enabled";
    }

    $.ajax({
        type: 'POST',
        url: APP_URL + '/location_status',
        data: { status: newStatus, pak_id: pak_id },
        success: function (data) {
            if (data.success) {
                button.removeClass("btn-success btn-danger")
                      .addClass(newClass)
                      .html(newText);
                console.log('Updated status: ' + data.status); // Log the updated status
            }
        },
        error: function (data) {
            //console.log('Error:', data);
            console.log('Update failed.');
        }
    });
});

//
$(document).on("change keyup",".aircurrency, .airfareadult, .airfareexadult, .airfarechildbed, .airfarechildwbed, .airfareinfant, .airfaresingle, .hotelcurrency, .hotelfareadult, .hotelfareexadult, .hotelfarechildbed, .hotelfarechildwbed, .hotelfareinfant, .hotelfaresingle, .tourcurrency, .tourfareadult, .tourfareexadult, .tourfarechildbed, .tourfarechildwbed, .tourfareinfant, .tourfaresingle, .transferscurrency, .transferfareadult, .transferfareexadult, .transferfarechildbed, .transferfarechildwbed, .transferfareinfant, .transferfaresingle, .visacurrency, .visafareadult, .visafareexadult, .visafarechildbed, .visafarechildwbed, .visafareinfant, .visafaresingle",function(){
    new_price_calculations()
});

//
function new_price_calculations() {
    var aircurrency=$(".aircurrency").find('option:selected').attr('c_val')
    if(aircurrency=='')
        {
            aircurrency=0;
        }
    var hotelcurrency=$(".hotelcurrency").find('option:selected').attr('c_val')
     if(hotelcurrency=='')
        {
            hotelcurrency=0;
        }
    var tourcurrency=$(".tourcurrency").find('option:selected').attr('c_val')
     if(tourcurrency=='')
        {
            tourcurrency=0;
        }
    var transferscurrency=$(".transferscurrency").find('option:selected').attr('c_val')
     if(transferscurrency=='')
        {
            transferscurrency=0;
        }
    var visacurrency=$(".visacurrency").find('option:selected').attr('c_val')
     if(visacurrency=='')
        {
            visacurrency=0;
        }
    var airfareadult=$(".airfareadult").val()
     if(airfareadult=='')
        {
            airfareadult=0;
        }
    var airfareexadult=$(".airfareexadult").val()
     if(airfareexadult=='')
        {
            airfareexadult=0;
        }
    var airfarechildbed=$(".airfarechildbed").val()
     if(airfarechildbed=='')
        {
            airfarechildbed=0;
        }
    var airfarechildwbed=$(".airfarechildwbed").val()
     if(airfarechildwbed=='')
        {
            airfarechildwbed=0;
        }
    var airfareinfant=$(".airfareinfant").val()
     if(airfareinfant=='')
        {
            airfareinfant=0;
        }
    var airfaresingle=$(".airfaresingle").val()
     if(airfaresingle=='')
        {
            airfaresingle=0;
        }
    var hotelfareadult=$(".hotelfareadult").val()
     if(hotelfareadult=='')
        {
            hotelfareadult=0;
        }
    var hotelfareexadult=$(".hotelfareexadult").val()
     if(hotelfareexadult=='')
        {
            hotelfareexadult=0;
        }
    var hotelfarechildbed=$(".hotelfarechildbed").val()
     if(hotelfarechildbed=='')
        {
            hotelfarechildbed=0;
        }
    var hotelfarechildwbed=$(".hotelfarechildwbed").val()
     if(hotelfarechildwbed=='')
        {
            hotelfarechildwbed=0;
        }
    var hotelfareinfant=$(".hotelfareinfant").val()
     if(hotelfareinfant=='')
        {
            hotelfareinfant=0;
        }
    var hotelfaresingle=$(".hotelfaresingle").val()
     if(hotelfaresingle=='')
        {
            hotelfaresingle=0;
        }
    var tourfareadult=$(".tourfareadult").val()
     if(tourfareadult=='')
        {
            tourfareadult=0;
        }
    var tourfareexadult=$(".tourfareexadult").val()
     if(tourfareexadult=='')
        {
            tourfareexadult=0;
        }
    var tourfarechildbed=$(".tourfarechildbed").val()
     if(tourfarechildbed=='')
        {
            tourfarechildbed=0;
        }
    var tourfarechildwbed=$(".tourfarechildwbed").val()
     if(tourfarechildwbed=='')
        {
            tourfarechildwbed=0;
        }
    var tourfareinfant=$(".tourfareinfant").val()
     if(tourfareinfant=='')
        {
            tourfareinfant=0;
        }
    var tourfaresingle=$(".tourfaresingle").val()
     if(tourfaresingle=='')
        {
            tourfaresingle=0;
        }
    var transferfareadult=$(".transferfareadult").val()
     if(transferfareadult=='')
        {
            transferfareadult=0;
        }
    var transferfareexadult=$(".transferfareexadult").val()
     if(transferfareexadult=='')
        {
            transferfareexadult=0;
        }
    var transferfarechildbed=$(".transferfarechildbed").val()
     if(transferfarechildbed=='')
        {
            transferfarechildbed=0;
        }
    var transferfarechildwbed=$(".transferfarechildwbed").val()
     if(transferfarechildwbed=='')
        {
            transferfarechildwbed=0;
        }
    var transferfareinfant=$(".transferfareinfant").val()
     if(transferfareinfant=='')
        {
            transferfareinfant=0;
        }
    var transferfaresingle=$(".transferfaresingle").val()
     if(transferfaresingle=='')
        {
            transferfaresingle=0;
        }
    var visafareadult=$(".visafareadult").val()
    if(visafareadult=='')
        {
            visafareadult=0;
        }
    var visafareexadult=$(".visafareexadult").val()
    if(visafareexadult=='')
        {
            visafareexadult=0;
        }
    var visafarechildbed=$(".visafarechildbed").val()
    if(visafarechildbed=='')
        {
            visafarechildbed=0;
        }
    var visafarechildwbed=$(".visafarechildwbed").val()
    if(visafarechildwbed=='')
        {
            visafarechildwbed=0;
        }
    var visafareinfant=$(".visafareinfant").val()
    if(visafareinfant=='')
        {
            visafareinfant=0;
        }
    var visafaresingle=$(".visafaresingle").val()
    if(visafaresingle=='')
        {
            visafaresingle=0;
        }
    var adulttotal=0;
    var adulttotal=Math.round(aircurrency*airfareadult)+Math.round(hotelcurrency*hotelfareadult)+Math.round(tourcurrency*tourfareadult)+Math.round(transferscurrency*transferfareadult)+Math.round(visacurrency*visafareadult)
    $(".adulttotal").val(adulttotal)
    var extraadulttotal=0;
    var extraadulttotal=Math.round(aircurrency*airfareexadult)+Math.round(hotelcurrency*hotelfareexadult)+Math.round(tourcurrency*tourfareexadult)+Math.round(transferscurrency*transferfareexadult)+Math.round(visacurrency*visafareexadult)
    $(".extraadulttotal").val(extraadulttotal)
    var childwithbedtotal=0;
    var childwithbedtotal=Math.round(aircurrency*airfarechildbed)+Math.round(hotelcurrency*hotelfarechildbed)+Math.round(tourcurrency*tourfarechildbed)+Math.round(transferscurrency*transferfarechildbed)+Math.round(visacurrency*visafarechildbed)
    $(".childwithbedtotal").val(childwithbedtotal)
    var childwithoutbedtotal=0;
    var childwithoutbedtotal=Math.round(aircurrency*airfarechildwbed)+Math.round(hotelcurrency*hotelfarechildwbed)+Math.round(tourcurrency*tourfarechildwbed)+Math.round(transferscurrency*transferfarechildwbed)+Math.round(visacurrency*visafarechildwbed)
    $(".childwithoutbedtotal").val(childwithoutbedtotal)
    var infanttotal=0;
    var infanttotal=Math.round(aircurrency*airfareinfant)+Math.round(hotelcurrency*hotelfareinfant)+Math.round(tourcurrency*tourfareinfant)+Math.round(transferscurrency*transferfareinfant)+Math.round(visacurrency*visafareinfant)
    $(".infanttotal").val(infanttotal)
    var singletotal=0;
    var singletotal=Math.round(aircurrency*airfaresingle)+Math.round(hotelcurrency*hotelfaresingle)+Math.round(tourcurrency*tourfaresingle)+Math.round(transferscurrency*transferfaresingle)+Math.round(visacurrency*visafaresingle)
    $(".singletotal").val(singletotal)
}

//
$(document).on('click', '.price_daywise', function () {
    var id = $(this).data('id');
    var sunday_discount_type = $('.' + id).children(".sunday_discount_type").val()
    var sunday_normal_discount = $('.' + id).children(".sunday_normal_discount").val()
    var sunday_coupon_discount = $('.' + id).children(".sunday_coupon_discount").val()
    var monday_discount_type = $('.' + id).children(".monday_discount_type").val()
    var monday_normal_discount = $('.' + id).children(".monday_normal_discount").val()
    var monday_coupon_discount = $('.' + id).children(".monday_coupon_discount").val()
    var tuesday_discount_type = $('.' + id).children(".tuesday_discount_type").val()
    var tuesday_normal_discount = $('.' + id).children(".tuesday_normal_discount").val()
    var tuesday_coupon_discount = $('.' + id).children(".tuesday_coupon_discount").val()
    var wednesday_discount_type = $('.' + id).children(".wednesday_discount_type").val()
    var wednesday_normal_discount = $('.' + id).children(".wednesday_normal_discount").val()
    var wednesday_coupon_discount = $('.' + id).children(".wednesday_coupon_discount").val()
    var thursday_discount_type = $('.' + id).children(".thursday_discount_type").val()
    var thursday_normal_discount = $('.' + id).children(".thursday_normal_discount").val()
    var thursday_coupon_discount = $('.' + id).children(".thursday_coupon_discount").val()
    var friday_discount_type = $('.' + id).children(".friday_discount_type").val()
    var friday_normal_discount = $('.' + id).children(".friday_normal_discount").val()
    var friday_coupon_discount = $('.' + id).children(".friday_coupon_discount").val()
    var saturday_discount_type = $('.' + id).children(".saturday_discount_type").val()
    var saturday_normal_discount = $('.' + id).children(".saturday_normal_discount").val()
    var saturday_coupon_discount = $('.' + id).children(".saturday_coupon_discount").val()
    var monday_price = $('.' + id).children(".new_price_monday").val()
    var tuesday_price = $('.' + id).children(".new_price_tuesday").val()
    var wednesday_price = $('.' + id).children(".new_price_wednesday").val()
    var thursday_price = $('.' + id).children(".new_price_thursday").val()
    var friday_price = $('.' + id).children(".new_price_friday").val()
    var saturday_price = $('.' + id).children(".new_price_saturday").val()
    $('#price_add_daywise').modal('show');
    $('#price_add_daywise .price_class').val("").val(id);
    $('#price_add_daywise .modal-body').attr('id', id);
    if(sunday_discount_type==0)
    {
    var sunday_data='<select class="form-control over_all_discount_type sunday_data_discount_type" name="sunday_data_discount_type"><option value="0" selected>No Discount</option><option value="2">Percentage</option><option value="3">Coupon</option></select><select class="normal_discount form-control number_test sunday_data_normal_discount" name="sunday_data_normal_discount" style="display: none;"><option value="0">0</option></select><select class="coupon_discount sunday_data_coupon_discount number_test form-control" name="sunday_data_coupon_discount" style="display: none;"><option coupon_id="0" value="0">Select Coupon</option></select>';
    }
    else if(sunday_discount_type==2)
    {
    var sunday_data='<select class="form-control over_all_discount_type sunday_data_discount_type" name="sunday_data_discount_type"><option value="0">No Discount</option><option value="2" selected>Percentage</option><option value="3">Coupon</option></select><select class="normal_discount form-control number_test sunday_data_normal_discount" name="sunday_data_normal_discount"><option value="0">0</option></select><select class="coupon_discount sunday_data_coupon_discount number_test form-control" name="sunday_data_coupon_discount" style="display: none;"><option coupon_id="0" value="0">Select Coupon</option></select>';
    }
    else
    {
    var sunday_data='<select class="form-control over_all_discount_type sunday_data_discount_type" name="sunday_data_discount_type"><option value="0">No Discount</option><option value="2">Percentage</option><option value="3" selected>Coupon</option></select><select class="normal_discount form-control number_test sunday_data_normal_discount" name="sunday_data_normal_discount" style="display: none;"><option value="0">0</option></select><select class="coupon_discount sunday_data_coupon_discount number_test form-control" name="sunday_data_coupon_discount"><option coupon_id="0" value="0">Select Coupon</option></select>';
    }
    //
    if(monday_discount_type==0)
    {
    var monday_data='<select class="form-control over_all_discount_type monday_data_discount_type" name="monday_data_discount_type"><option value="0" selected>No Discount</option><option value="2">Percentage</option><option value="3">Coupon</option></select><select class="normal_discount form-control number_test monday_data_normal_discount" name="monday_data_normal_discount" style="display: none;"><option value="0">0</option></select><select class="coupon_discount monday_data_coupon_discount number_test form-control" name="monday_data_coupon_discount" style="display: none;"><option coupon_id="0" value="0">Select Coupon</option></select>';
    }
    else if(monday_discount_type==2)
    {
    var monday_data='<select class="form-control over_all_discount_type monday_data_discount_type" name="monday_data_discount_type"><option value="0">No Discount</option><option value="2" selected>Percentage</option><option value="3">Coupon</option></select><select class="normal_discount form-control number_test monday_data_normal_discount" name="monday_data_normal_discount"><option value="0">0</option></select><select class="coupon_discount monday_data_coupon_discount number_test form-control" name="monday_data_coupon_discount" style="display: none;"><option coupon_id="0" value="0">Select Coupon</option></select>';
    }
    else
    {
    var monday_data='<select class="form-control over_all_discount_type monday_data_discount_type" name="monday_data_discount_type"><option value="0">No Discount</option><option value="2">Percentage</option><option value="3" selected>Coupon</option></select><select class="normal_discount form-control number_test monday_data_normal_discount" name="monday_data_normal_discount" style="display: none;"><option value="0">0</option></select><select class="coupon_discount monday_data_coupon_discount number_test form-control" name="monday_data_coupon_discount"><option coupon_id="0" value="0">Select Coupon</option></select>';
    }
    //
    if(tuesday_discount_type==0)
    {
    var tuesday_data='<select class="form-control over_all_discount_type tuesday_data_discount_type" name="tuesday_data_discount_type"><option value="0" selected>No Discount</option><option value="2">Percentage</option><option value="3">Coupon</option></select><select class="normal_discount form-control number_test tuesday_data_normal_discount" name="tuesday_data_normal_discount" style="display: none;"><option value="0">0</option></select><select class="coupon_discount tuesday_data_coupon_discount number_test form-control" name="tuesday_data_coupon_discount" style="display: none;"><option coupon_id="0" value="0">Select Coupon</option></select>';
    }
    else if(tuesday_discount_type==2)
    {
    var tuesday_data='<select class="form-control over_all_discount_type tuesday_data_discount_type" name="tuesday_data_discount_type"><option value="0">No Discount</option><option value="2" selected>Percentage</option><option value="3">Coupon</option></select><select class="normal_discount form-control number_test tuesday_data_normal_discount" name="tuesday_data_normal_discount"><option value="0">0</option></select><select class="coupon_discount tuesday_data_coupon_discount number_test form-control" name="tuesday_data_coupon_discount" style="display: none;"><option coupon_id="0" value="0">Select Coupon</option></select>';
    }
    else
    {
    var tuesday_data='<select class="form-control over_all_discount_type tuesday_data_discount_type" name="tuesday_data_discount_type"><option value="0">No Discount</option><option value="2">Percentage</option><option value="3" selected>Coupon</option></select><select class="normal_discount form-control number_test tuesday_data_normal_discount" name="tuesday_data_normal_discount" style="display: none;"><option value="0">0</option></select><select class="coupon_discount tuesday_data_coupon_discount number_test form-control" name="tuesday_data_coupon_discount"><option coupon_id="0" value="0">Select Coupon</option></select>';
    }
    //
    if(wednesday_discount_type==0)
    {
    var wednesday_data='<select class="form-control over_all_discount_type wednesday_data_discount_type" name="wednesday_data_discount_type"><option value="0" selected>No Discount</option><option value="2">Percentage</option><option value="3">Coupon</option></select><select class="normal_discount form-control number_test wednesday_data_normal_discount" name="wednesday_data_normal_discount" style="display: none;"><option value="0">0</option></select><select class="coupon_discount wednesday_data_coupon_discount number_test form-control" name="wednesday_data_coupon_discount" style="display: none;"><option coupon_id="0" value="0">Select Coupon</option></select>';
    }
    else if(wednesday_discount_type==2)
    {
    var wednesday_data='<select class="form-control over_all_discount_type wednesday_data_discount_type" name="wednesday_data_discount_type"><option value="0">No Discount</option><option value="2" selected>Percentage</option><option value="3">Coupon</option></select><select class="normal_discount form-control number_test wednesday_data_normal_discount" name="wednesday_data_normal_discount"><option value="0">0</option></select><select class="coupon_discount wednesday_data_coupon_discount number_test form-control" name="wednesday_data_coupon_discount" style="display: none;"><option coupon_id="0" value="0">Select Coupon</option></select>';
    }
    else
    {
    var wednesday_data='<select class="form-control over_all_discount_type wednesday_data_discount_type" name="wednesday_data_discount_type"><option value="0">No Discount</option><option value="2">Percentage</option><option value="3" selected>Coupon</option></select><select class="normal_discount form-control number_test wednesday_data_normal_discount" name="wednesday_data_normal_discount" style="display: none;"><option value="0">0</option></select><select class="coupon_discount wednesday_data_coupon_discount number_test form-control" name="wednesday_data_coupon_discount"><option coupon_id="0" value="0">Select Coupon</option></select>';
    }
    //
    if(thursday_discount_type==0)
    {
    var thursday_data='<select class="form-control over_all_discount_type thursday_data_discount_type" name="thursday_data_discount_type"><option value="0" selected>No Discount</option><option value="2">Percentage</option><option value="3">Coupon</option></select><select class="normal_discount form-control number_test thursday_data_normal_discount" name="thursday_data_normal_discount" style="display: none;"><option value="0">0</option></select><select class="coupon_discount thursday_data_coupon_discount number_test form-control" name="thursday_data_coupon_discount" style="display: none;"><option coupon_id="0" value="0">Select Coupon</option></select>';
    }
    else if(thursday_discount_type==2)
    {
    var thursday_data='<select class="form-control over_all_discount_type thursday_data_discount_type" name="thursday_data_discount_type"><option value="0">No Discount</option><option value="2" selected>Percentage</option><option value="3">Coupon</option></select><select class="normal_discount form-control number_test thursday_data_normal_discount" name="thursday_data_normal_discount"><option value="0">0</option></select><select class="coupon_discount thursday_data_coupon_discount number_test form-control" name="thursday_data_coupon_discount" style="display: none;"><option coupon_id="0" value="0">Select Coupon</option></select>';
    }
    else
    {
    var thursday_data='<select class="form-control over_all_discount_type thursday_data_discount_type" name="thursday_data_discount_type"><option value="0">No Discount</option><option value="2">Percentage</option><option value="3" selected>Coupon</option></select><select class="normal_discount form-control number_test thursday_data_normal_discount" name="thursday_data_normal_discount" style="display: none;"><option value="0">0</option></select><select class="coupon_discount thursday_data_coupon_discount number_test form-control" name="thursday_data_coupon_discount"><option coupon_id="0" value="0">Select Coupon</option></select>';
    }
    //
    if(friday_discount_type==0)
    {
    var friday_data='<select class="form-control over_all_discount_type friday_data_discount_type" name="friday_data_discount_type"><option value="0" selected>No Discount</option><option value="2">Percentage</option><option value="3">Coupon</option></select><select class="normal_discount form-control number_test friday_data_normal_discount" name="friday_data_normal_discount" style="display: none;"><option value="0">0</option></select><select class="coupon_discount friday_data_coupon_discount number_test form-control" name="friday_data_coupon_discount" style="display: none;"><option coupon_id="0" value="0">Select Coupon</option></select>';
    }
    else if(friday_discount_type==2)
    {
    var friday_data='<select class="form-control over_all_discount_type friday_data_discount_type" name="friday_data_discount_type"><option value="0">No Discount</option><option value="2" selected>Percentage</option><option value="3">Coupon</option></select><select class="normal_discount form-control number_test friday_data_normal_discount" name="friday_data_normal_discount"><option value="0">0</option></select><select class="coupon_discount friday_data_coupon_discount number_test form-control" name="friday_data_coupon_discount" style="display: none;"><option coupon_id="0" value="0">Select Coupon</option></select>';
    }
    else
    {
    var friday_data='<select class="form-control over_all_discount_type friday_data_discount_type" name="friday_data_discount_type"><option value="0">No Discount</option><option value="2">Percentage</option><option value="3" selected>Coupon</option></select><select class="normal_discount form-control number_test friday_data_normal_discount" name="friday_data_normal_discount" style="display: none;"><option value="0">0</option></select><select class="coupon_discount friday_data_coupon_discount number_test form-control" name="friday_data_coupon_discount"><option coupon_id="0" value="0">Select Coupon</option></select>';
    }
    //
    if(friday_discount_type==0)
    {
    var friday_data='<select class="form-control over_all_discount_type friday_data_discount_type" name="friday_data_discount_type"><option value="0" selected>No Discount</option><option value="2">Percentage</option><option value="3">Coupon</option></select><select class="normal_discount form-control number_test friday_data_normal_discount" name="friday_data_normal_discount" style="display: none;"><option value="0">0</option></select><select class="coupon_discount friday_data_coupon_discount number_test form-control" name="friday_data_coupon_discount" style="display: none;"><option coupon_id="0" value="0">Select Coupon</option></select>';
    }
    else if(friday_discount_type==2)
    {
    var friday_data='<select class="form-control over_all_discount_type friday_data_discount_type" name="friday_data_discount_type"><option value="0">No Discount</option><option value="2" selected>Percentage</option><option value="3">Coupon</option></select><select class="normal_discount form-control number_test friday_data_normal_discount" name="friday_data_normal_discount"><option value="0">0</option></select><select class="coupon_discount friday_data_coupon_discount number_test form-control" name="friday_data_coupon_discount" style="display: none;"><option coupon_id="0" value="0">Select Coupon</option></select>';
    }
    else
    {
    var friday_data='<select class="form-control over_all_discount_type friday_data_discount_type" name="friday_data_discount_type"><option value="0">No Discount</option><option value="2">Percentage</option><option value="3" selected>Coupon</option></select><select class="normal_discount form-control number_test friday_data_normal_discount" name="friday_data_normal_discount" style="display: none;"><option value="0">0</option></select><select class="coupon_discount friday_data_coupon_discount number_test form-control" name="friday_data_coupon_discount"><option coupon_id="0" value="0">Select Coupon</option></select>';
    }
    //
    if(saturday_discount_type==0)
    {
    var saturday_data='<select class="form-control over_all_discount_type saturday_data_discount_type" name="saturday_data_discount_type"><option value="0" selected>No Discount</option><option value="2">Percentage</option><option value="3">Coupon</option></select><select class="normal_discount form-control number_test saturday_data_normal_discount" name="saturday_data_normal_discount" style="display: none;"><option value="0">0</option></select><select class="coupon_discount saturday_data_coupon_discount number_test form-control" name="saturday_data_coupon_discount" style="display: none;"><option coupon_id="0" value="0">Select Coupon</option></select>';
    }
    else if(saturday_discount_type==2)
    {
    var saturday_data='<select class="form-control over_all_discount_type saturday_data_discount_type" name="saturday_data_discount_type"><option value="0">No Discount</option><option value="2" selected>Percentage</option><option value="3">Coupon</option></select><select class="normal_discount form-control number_test saturday_data_normal_discount" name="saturday_data_normal_discount"><option value="0">0</option></select><select class="coupon_discount saturday_data_coupon_discount number_test form-control" name="saturday_data_coupon_discount" style="display: none;"><option coupon_id="0" value="0">Select Coupon</option></select>';
    }
    else
    {
    var saturday_data='<select class="form-control over_all_discount_type saturday_data_discount_type" name="saturday_data_discount_type"><option value="0">No Discount</option><option value="2">Percentage</option><option value="3" selected>Coupon</option></select><select class="normal_discount form-control number_test saturday_data_normal_discount" name="saturday_data_normal_discount" style="display: none;"><option value="0">0</option></select><select class="coupon_discount saturday_data_coupon_discount number_test form-control" name="saturday_data_coupon_discount"><option coupon_id="0" value="0">Select Coupon</option></select>';
    }
    $(".sunday_data").html('').html(sunday_data)
    $(".monday_data").html('').html(monday_data)
    $(".tuesday_data").html('').html(tuesday_data)
    $(".wednesday_data").html('').html(wednesday_data)
    $(".thursday_data").html('').html(thursday_data)
    $(".friday_data").html('').html(friday_data)
    $(".saturday_data").html('').html(saturday_data)
    // saturday_normal_discount: saturday_normal_discount,saturday_coupon_discount:saturday_coupon_discount
    var APP_URL=$("#APP_URL").val()
     $.ajax({
            type: 'get',
            url: APP_URL + "/get_sunday_data",
            data: { sunday_normal_discount: sunday_normal_discount,sunday_coupon_discount:sunday_coupon_discount,monday_normal_discount: monday_normal_discount,monday_coupon_discount:monday_coupon_discount,tuesday_normal_discount: tuesday_normal_discount,tuesday_coupon_discount:tuesday_coupon_discount,wednesday_normal_discount: wednesday_normal_discount,wednesday_coupon_discount:wednesday_coupon_discount,thursday_normal_discount: thursday_normal_discount,thursday_coupon_discount:thursday_coupon_discount,friday_normal_discount: friday_normal_discount,friday_coupon_discount:friday_coupon_discount,saturday_normal_discount: saturday_normal_discount,saturday_coupon_discount:saturday_coupon_discount },
            success: function (data) {
            $(".sunday_data_normal_discount").html('').html(data.sunday_normal_discount_val)
            $(".sunday_data_coupon_discount").html('').html(data.sunday_coupon_discount_val)
            $(".monday_data_normal_discount").html('').html(data.monday_normal_discount_val)
            $(".monday_data_coupon_discount").html('').html(data.monday_coupon_discount_val)
            $(".tuesday_data_normal_discount").html('').html(data.tuesday_normal_discount_val)
            $(".tuesday_data_coupon_discount").html('').html(data.tuesday_coupon_discount_val)
            $(".wednesday_data_normal_discount").html('').html(data.wednesday_normal_discount_val)
            $(".wednesday_data_coupon_discount").html('').html(data.wednesday_coupon_discount_val)
            $(".thursday_data_normal_discount").html('').html(data.thursday_normal_discount_val)
            $(".thursday_data_coupon_discount").html('').html(data.thursday_coupon_discount_val)
            $(".friday_data_normal_discount").html('').html(data.friday_normal_discount_val)
            $(".friday_data_coupon_discount").html('').html(data.friday_coupon_discount_val)
            $(".saturday_data_normal_discount").html('').html(data.saturday_normal_discount_val)
            $(".saturday_data_coupon_discount").html('').html(data.saturday_coupon_discount_val)
                // console.log(data.sunday_normal_discount_val);
                // $('#price_add .a_curr').html("").html(data);
            },
            error: function (data) {
                //console.log('Error : '+data);
            }
        });
    // $('#price_add_daywise .sunday_price').val("").val(sunday_price);
    // $('#price_add_daywise .monday_price').val("").val(monday_price);
    // $('#price_add_daywise .tuesday_price').val("").val(tuesday_price);
    // $('#price_add_daywise .wednesday_price').val("").val(wednesday_price);
    // $('#price_add_daywise .thursday_price').val("").val(thursday_price);
    // $('#price_add_daywise .friday_price').val("").val(friday_price);
    // $('#price_add_daywise .saturday_price').val("").val(saturday_price);
});

//
$(document).on("change",".price_applicable_for",function(){
    var price_applicable_for=$(this).val()

    if(price_applicable_for=='all') {
        $(this).parent().siblings(".price_td").children().children(".price_daywise").css("display","none")
        $(this).parent().siblings(".price_td").children().children(".over_all_discount_type").css("display","block")
    } else {
         alert(price_applicable_for)
        $(this).parent().siblings(".price_td").children().children(".price_daywise").css("display","block")
        $(this).parent().siblings(".price_td").children().children(".over_all_discount_type").css("display","none")
    }
});

//
$(document).on("change",".over_all_discount_type",function(){
    var over_all_discount_type=$(this).val()
    if(over_all_discount_type==0) {
        $(this).siblings('.normal_discount').css("display","none")
        $(this).siblings('.coupon_discount').css("display","none")
    } else if(over_all_discount_type==2) {
        $(this).siblings('.normal_discount').css("display","block")
        $(this).siblings('.coupon_discount').css("display","none")
    } else if(over_all_discount_type==3) {
        $(this).siblings('.normal_discount').css("display","none")
        $(this).siblings('.coupon_discount').css("display","block")
    }
});

//
$("#submit_day_wise_price").click(function () {
    var class_value = $(this).parent().siblings(".modal-body").children(".price_class").val()
    // var sunday_price = $('#' + class_value + '  .sunday_price').val();
    // var monday_price = $('#' + class_value + '  .monday_price').val();
    // var tuesday_price = $('#' + class_value + '  .tuesday_price').val();
    // var wednesday_price = $('#' + class_value + '  .wednesday_price').val();
    // var thursday_price = $('#' + class_value + '  .thursday_price').val();
    // var friday_price = $('#' + class_value + '  .friday_price').val();
    // var saturday_price = $('#' + class_value + '  .saturday_price').val();
    var sunday_discount_type =$('#' + class_value + '  .sunday_data_discount_type').val();
    var sunday_normal_discount =$('#' + class_value + '  .sunday_data_normal_discount').val();
    var sunday_coupon_discount = $('#' + class_value + '  .sunday_data_coupon_discount').val();
    var monday_discount_type = $('#' + class_value + '  .monday_data_discount_type').val();
    var monday_normal_discount = $('#' + class_value + '  .monday_data_normal_discount').val();
    var monday_coupon_discount = $('#' + class_value + '  .monday_data_coupon_discount').val();
    var tuesday_discount_type =$('#' + class_value + '  .tuesday_data_discount_type').val();
    var tuesday_normal_discount =$('#' + class_value + '  .tuesday_data_normal_discount').val();
    var tuesday_coupon_discount =$('#' + class_value + '  .tuesday_data_coupon_discount').val();
    var wednesday_discount_type =$('#' + class_value + '  .wednesday_data_discount_type').val();
    var wednesday_normal_discount =$('#' + class_value + '  .wednesday_data_normal_discount').val();
    var wednesday_coupon_discount =$('#' + class_value + '  .wednesday_data_coupon_discount').val();
    var thursday_discount_type =$('#' + class_value + '  .thursday_data_discount_type').val();
    var thursday_normal_discount =$('#' + class_value + '  .thursday_data_normal_discount').val();
    var thursday_coupon_discount =$('#' + class_value + '  .thursday_data_coupon_discount').val();
    var friday_discount_type =$('#' + class_value + '  .friday_data_discount_type').val();
    var friday_normal_discount =$('#' + class_value + '  .friday_data_normal_discount').val();
    var friday_coupon_discount =$('#' + class_value + '  .friday_data_coupon_discount').val();
    var saturday_discount_type =$('#' + class_value + '  .saturday_data_discount_type').val();
    var saturday_normal_discount =$('#' + class_value + '  .saturday_data_normal_discount').val();
    var saturday_coupon_discount =$('#' + class_value + '  .saturday_data_coupon_discount').val();
    $('#' + class_value).children(".sunday_discount_type").val("").val(sunday_discount_type)
    $('#' + class_value).children(".sunday_normal_discount").val("").val(sunday_normal_discount)
    $('#' + class_value).children(".sunday_coupon_discount").val("").val(sunday_coupon_discount)
    $('#' + class_value).children(".monday_discount_type").val("").val(monday_discount_type)
    $('#' + class_value).children(".monday_normal_discount").val("").val(monday_normal_discount)
    $('#' + class_value).children(".monday_coupon_discount").val("").val(monday_coupon_discount)
    $('#' + class_value).children(".tuesday_discount_type").val("").val(tuesday_discount_type)
    $('#' + class_value).children(".tuesday_normal_discount").val("").val(tuesday_normal_discount)
    $('#' + class_value).children(".tuesday_coupon_discount").val("").val(tuesday_coupon_discount)
    $('#' + class_value).children(".wednesday_discount_type").val("").val(wednesday_discount_type)
    $('#' + class_value).children(".wednesday_normal_discount").val("").val(wednesday_normal_discount)
    $('#' + class_value).children(".wednesday_coupon_discount").val("").val(wednesday_coupon_discount)
    $('#' + class_value).children(".thursday_discount_type").val("").val(thursday_discount_type)
    $('#' + class_value).children(".thursday_normal_discount").val("").val(thursday_normal_discount)
    $('#' + class_value).children(".thursday_coupon_discount").val("").val(thursday_coupon_discount)
    $('#' + class_value).children(".friday_discount_type").val("").val(friday_discount_type)
    $('#' + class_value).children(".friday_normal_discount").val("").val(friday_normal_discount)
    $('#' + class_value).children(".friday_coupon_discount").val("").val(friday_coupon_discount)
    $('#' + class_value).children(".saturday_discount_type").val("").val(saturday_discount_type)
    $('#' + class_value).children(".saturday_normal_discount").val("").val(saturday_normal_discount)
    $('#' + class_value).children(".saturday_coupon_discount").val("").val(saturday_coupon_discount)
    // $('#' + class_value).children(".new_price_sunday").val("").val(sunday_price)
    // $('#' + class_value).children(".new_price_monday").val("").val(monday_price)
    // $('#' + class_value).children(".new_price_tuesday").val("").val(tuesday_price)
    // $('#' + class_value).children(".new_price_wednesday").val("").val(wednesday_price)
    // $('#' + class_value).children(".new_price_thursday").val("").val(thursday_price)
    // $('#' + class_value).children(".new_price_friday").val("").val(friday_price)
    // $('#' + class_value).children(".new_price_saturday").val("").val(saturday_price)
});

/******************************************/

// add new price range (row)
$(document).on("click",".add_new_price_range",function(){
    var current_rows=$(this).attr('id')
    var current_rows_myArray = current_rows.split("_");
    var current_row_num=current_rows_myArray[2];
    let rows= $('.dynamic_price_range_'+current_row_num+' table:last').attr("id")
    const myArray = rows.split("_");
    // var row_num=myArray[3];
    var row_num=current_row_num;
    var sub_row_num=myArray[4];
    sub_row_num++
    console.log(rows)
    var normal_discount_first=$(".normal_discount_first").html()
    var coupon_discount_first=$(".coupon_discount_first").html()
    //$('.dynamic_price_range_'+ row_num +'').append('<table class="table" id="dynamic_price_range_'+row_num+'_'+sub_row_num+'"><tr><th>Price from</th><th>Price to</th><th>Cut Off Point</th><th>Applicable For</th></tr><tr><td><div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input name="NewPrice['+row_num+'][datefrom]['+sub_row_num+']" class="form-control pull-right datepicker_package date_start" type="text"></div></td><td><div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input name="NewPrice['+row_num+'][dateto]['+sub_row_num+']" class="form-control pull-right datepicker_package date_end" type="text"></div></td><td><input type="number" value="0" name="NewPrice['+row_num+'][cuttoffpoint]['+sub_row_num+']" class="form-control" placeholder="Cutt Off Days"></td><td><select class="form-control price_applicable_for" name="NewPrice['+row_num+'][applicable_for]['+sub_row_num+']"><option value="all" >All Days</option><option value="day_wise">Day Wise</option></select></td><td class="price_td"><select class="form-control over_all_discount_type" name="NewPrice['+row_num+'][over_all_discount_type]['+sub_row_num+']"><option value="0">No Discount</option><option value="2">Percentage</option><option value="3">Coupon</option></select><select class="form-control number_test normal_discount" name="NewPrice['+row_num+'][normal_discount]['+sub_row_num+']" style="display: none;">'+normal_discount_first+'</select><select class="coupon_discount number_test form-control" name="NewPrice['+row_num+'][coupon_discount]['+sub_row_num+']" style="display: none;">'+coupon_discount_first+'</select><div class="d_price'+row_num+''+sub_row_num+'" id="d_price'+row_num+''+sub_row_num+'" ><input type="hidden" name="NewPrice['+row_num+'][sunday_discount_type]['+sub_row_num+']" value="0" class="sunday_discount_type"><input type="hidden" name="NewPrice['+row_num+'][sunday_normal_discount]['+sub_row_num+']" value="0" class="sunday_normal_discount"> <input type="hidden" name="NewPrice['+row_num+'][sunday_coupon_discount]['+sub_row_num+']" value="0" class="sunday_coupon_discount"><input type="hidden" name="NewPrice['+row_num+'][monday_discount_type]['+sub_row_num+']" value="0" class="monday_discount_type"><input type="hidden" name="NewPrice['+row_num+'][monday_normal_discount]['+sub_row_num+']" value="0" class="monday_normal_discount"><input type="hidden" name="NewPrice['+row_num+'][monday_coupon_discount]['+sub_row_num+']" value="0" class="monday_coupon_discount"><input type="hidden" name="NewPrice['+row_num+'][tuesday_discount_type]['+sub_row_num+']" value="0" class="tuesday_discount_type"><input type="hidden" name="NewPrice['+row_num+'][tuesday_normal_discount]['+sub_row_num+']" value="0" class="tuesday_normal_discount"><input type="hidden" name="NewPrice['+sub_row_num+'][tuesday_coupon_discount]['+sub_row_num+']" value="0" class="tuesday_coupon_discount"><input type="hidden" name="NewPrice['+row_num+'][wednesday_discount_type]['+sub_row_num+']" value="0" class="wednesday_discount_type"><input type="hidden" name="NewPrice['+row_num+'][wednesday_normal_discount]['+sub_row_num+']" value="0" class="wednesday_normal_discount"><input type="hidden" name="NewPrice['+row_num+'][wednesday_coupon_discount]['+sub_row_num+']" value="0" class="wednesday_coupon_discount"><input type="hidden" name="NewPrice['+row_num+'][thursday_discount_type]['+sub_row_num+']" value="0" class="thursday_discount_type"><input type="hidden" name="NewPrice['+row_num+'][thursday_normal_discount]['+sub_row_num+']" value="0" class="thursday_normal_discount"><input type="hidden" name="NewPrice['+row_num+'][thursday_coupon_discount]['+sub_row_num+']" value="0" class="thursday_coupon_discount"><input type="hidden" name="NewPrice['+row_num+'][friday_discount_type]['+sub_row_num+']" value="0" class="friday_discount_type"><input type="hidden" name="NewPrice['+row_num+'][friday_normal_discount]['+sub_row_num+']" value="0" class="friday_normal_discount"><input type="hidden" name="NewPrice['+row_num+'][friday_coupon_discount]['+sub_row_num+']" value="0" class="friday_coupon_discount"><input type="hidden" name="NewPrice['+row_num+'][saturday_discount_type]['+sub_row_num+']" value="0" class="saturday_discount_type"><input type="hidden" name="NewPrice['+row_num+'][saturday_normal_discount]['+sub_row_num+']" value="0" class="saturday_normal_discount"><input type="hidden" name="NewPrice['+row_num+'][saturday_coupon_discount]['+sub_row_num+']" value="0" class="saturday_coupon_discount"></div><button style="display:none;" type="button" class="btn btn-info btn-lg price_daywise" data-toggle="modal" data-id="d_price'+row_num+''+sub_row_num+'">Add Price</button></td><td><button type="button" name="remove_price_range" id="'+row_num+'_'+sub_row_num+'" class="remove_price_range btn btn-danger">X</button></td>')
    
    // Append a new price range (row) for the dynamic price range
    $('.dynamic_price_range_' + row_num + '').append(`
        <table class="table" id="dynamic_price_range_${row_num}_${sub_row_num}">
            <tr>
                <th>Price starting date</th>
                <th>Price end date</th>
                <th>Price applicable date (cut-off point</th>
                <th>Discount applicable on</th>
                <th>Action</th>
            </tr>
            <tr>
                <!-- Price from date input -->
                <td>
                    <div class="input-group date">
                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                        <input name="NewPrice[${row_num}][datefrom][${sub_row_num}]" class="form-control pull-right datepicker_package date_start" type="text">
                    </div>
                </td>

                <!-- Price to date input -->
                <td>
                    <div class="input-group date">
                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                        <input name="NewPrice[${row_num}][dateto][${sub_row_num}]" class="form-control pull-right datepicker_package date_end" type="text" readonly="readonly">
                    </div>
                </td>

                <!-- Cut Off Point input -->
                <td>
                    <input type="number" value="0" name="NewPrice[${row_num}][cuttoffpoint][${sub_row_num}]" class="form-control" placeholder="Cutt Off Days">
                </td>

                <!-- Applicable For dropdown -->
                <td>
                    <select class="form-control price_applicable_for" name="NewPrice[${row_num}][applicable_for][${sub_row_num}]">
                        <option value="all">All Days</option>
                        <option value="day_wise">Day Wise</option>
                    </select>
                </td>

                <!-- Discount options -->
                <td class="price_td">

                    <div class="makeflex" style="column-gap: 10px;"

                        <!-- Overall discount type dropdown -->
                        <select class="form-control over_all_discount_type" name="NewPrice[${row_num}][over_all_discount_type][${sub_row_num}]">
                            <option value="0">No Discount</option>
                            <option value="2">Percentage</option>
                            <option value="3">Coupon</option>
                        </select>

                        <!-- Normal discount dropdown, initially hidden -->
                        <select class="form-control number_test normal_discount" name="NewPrice[${row_num}][normal_discount][${sub_row_num}]" style="display: none;max-width: 150px;">
                            ${normal_discount_first}
                        </select>

                        <!-- Coupon discount dropdown, initially hidden -->
                        <select class="coupon_discount number_test form-control" name="NewPrice[${row_num}][coupon_discount][${sub_row_num}]" style="display: none;">
                            ${coupon_discount_first}
                        </select>

                        <!-- Hidden inputs for daily discount types and values -->
                        <div class="d_price${row_num}${sub_row_num}" id="d_price${row_num}${sub_row_num}">
                            <input type="hidden" name="NewPrice[${row_num}][sunday_discount_type][${sub_row_num}]" value="0" class="sunday_discount_type">
                            <input type="hidden" name="NewPrice[${row_num}][sunday_normal_discount][${sub_row_num}]" value="0" class="sunday_normal_discount">
                            <input type="hidden" name="NewPrice[${row_num}][sunday_coupon_discount][${sub_row_num}]" value="0" class="sunday_coupon_discount">
                            <input type="hidden" name="NewPrice[${row_num}][monday_discount_type][${sub_row_num}]" value="0" class="monday_discount_type">
                            <input type="hidden" name="NewPrice[${row_num}][monday_normal_discount][${sub_row_num}]" value="0" class="monday_normal_discount">
                            <input type="hidden" name="NewPrice[${row_num}][monday_coupon_discount][${sub_row_num}]" value="0" class="monday_coupon_discount">
                            <input type="hidden" name="NewPrice[${row_num}][tuesday_discount_type][${sub_row_num}]" value="0" class="tuesday_discount_type">
                            <input type="hidden" name="NewPrice[${sub_row_num}][tuesday_coupon_discount][${sub_row_num}]" value="0" class="tuesday_coupon_discount">
                            <input type="hidden" name="NewPrice[${row_num}][wednesday_discount_type][${sub_row_num}]" value="0" class="wednesday_discount_type">
                            <input type="hidden" name="NewPrice[${row_num}][wednesday_normal_discount][${sub_row_num}]" value="0" class="wednesday_normal_discount">
                            <input type="hidden" name="NewPrice[${row_num}][wednesday_coupon_discount][${sub_row_num}]" value="0" class="wednesday_coupon_discount">
                            <input type="hidden" name="NewPrice[${row_num}][thursday_discount_type][${sub_row_num}]" value="0" class="thursday_discount_type">
                            <input type="hidden" name="NewPrice[${row_num}][thursday_normal_discount][${sub_row_num}]" value="0" class="thursday_normal_discount">
                            <input type="hidden" name="NewPrice[${row_num}][thursday_coupon_discount][${sub_row_num}]" value="0" class="thursday_coupon_discount">
                            <input type="hidden" name="NewPrice[${row_num}][friday_discount_type][${sub_row_num}]" value="0" class="friday_discount_type">
                            <input type="hidden" name="NewPrice[${row_num}][friday_normal_discount][${sub_row_num}]" value="0" class="friday_normal_discount">
                            <input type="hidden" name="NewPrice[${row_num}][friday_coupon_discount][${sub_row_num}]" value="0" class="friday_coupon_discount">
                            <input type="hidden" name="NewPrice[${row_num}][saturday_discount_type][${sub_row_num}]" value="0" class="saturday_discount_type">
                            <input type="hidden" name="NewPrice[${row_num}][saturday_normal_discount][${sub_row_num}]" value="0" class="saturday_normal_discount">
                            <input type="hidden" name="NewPrice[${row_num}][saturday_coupon_discount][${sub_row_num}]" value="0" class="saturday_coupon_discount">
                        </div>

                        <!-- Add Price button, initially hidden -->
                        <button style="display:none;" type="button" class="btn btn-info btn-lg price_daywise" data-toggle="modal" data-id="d_price${row_num}${sub_row_num}">Add Price</button>
                    
                    </div>
                </td>

                <!-- Remove row button -->
                <td>
                    <button type="button" name="remove_price_range" id="${row_num}_${sub_row_num}" class="remove_price_range btn btn-danger">Remove row</button>
                </td>
            </tr>
        </table>
    `);


    $(".date_start").datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true,
    });
});

// remove price range (row)
$(document).on('click', '.remove_price_range', function () {
    var button_id = $(this).attr("id");
    $('#dynamic_price_range_' + button_id + '').remove();
});

/******************************************/

/*// add tour price category
$('#add-new-price-row').click(function () {
    var name_count1 = $("#new_price_dynamic_field").children().children(':last').attr('id').slice(13)
    var name_count = parseInt(name_count1) - "1";
    name_count1++
    name_count++
    var normal_discount_first=$(".normal_discount_first").html()
    var coupon_discount_first=$(".coupon_discount_first").html()
    //$('#new_price_dynamic_field').append('<tr id="new_price_row' + name_count1 + '"><td><select name="NewPrice[' + name_count + '][package_rating]" id="newrating' + name_count + '" class="form-control rating-field new_price_category" style="width: 100%;"> </select><input name="NewPrice[' + name_count + '][package_rating_other]" id="otherrating' + name_count + '" class="form-control other-rating" style="width: 100%;display:none"></td><td class="dynamic_price_range_' + name_count + '"><table class="table" id="dynamic_price_range_' + name_count + '_0"><tr><th>Price from</th><th>Price to</th><th>Cut Off Point</th><th>Applicable For</th></tr><tr><td><div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input name="NewPrice[' + name_count + '][datefrom][0]" class="form-control pull-right datepicker_package date_start" type="text"> </div></td><td><div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i> </div><input name="NewPrice[' + name_count + '][dateto][0]" class="form-control pull-right datepicker_package date_end" type="text"></div></td><td><input type="number" value="0" name="NewPrice[' + name_count + '][cuttoffpoint][0]" class="form-control cuttoffpoint" placeholder="Cutt Off Days"></td><td> <select class="form-control price_applicable_for" name="NewPrice[' + name_count + '][applicable_for][0]"><option value="all" >All Days</option><option value="day_wise">Day Wise</option></select></td><td class="price_td"><select class="form-control over_all_discount_type" name="NewPrice[' + name_count + '][over_all_discount_type][0]"><option value="0">No Discount</option><option value="2">Percentage</option><option value="3">Coupon</option></select><select class="form-control number_test normal_discount" name="NewPrice[' + name_count + '][normal_discount][0]" style="display: none;">'+normal_discount_first+'</select><select class="coupon_discount number_test form-control" name="NewPrice[' + name_count + '][coupon_discount][0]" style="display: none;">'+coupon_discount_first+'</select><div class="d_price'+name_count+'0" id="d_price'+name_count+'0" ><input type="hidden" name="NewPrice[' + name_count + '][sunday_discount_type][0]" value="0" class="sunday_discount_type"><input type="hidden" name="NewPrice[' + name_count + '][sunday_normal_discount][0]" value="0" class="sunday_normal_discount"><input type="hidden" name="NewPrice[' + name_count + '][sunday_coupon_discount][0]" value="0" class="sunday_coupon_discount"><input type="hidden" name="NewPrice[' + name_count + '][monday_discount_type][0]" value="0" class="monday_discount_type"><input type="hidden" name="NewPrice[' + name_count + '][monday_normal_discount][0]" value="0" class="monday_normal_discount"><input type="hidden" name="NewPrice[' + name_count + '][monday_coupon_discount][0]" value="0" class="monday_coupon_discount"><input type="hidden" name="NewPrice[' + name_count + '][tuesday_discount_type][0]" value="0" class="tuesday_discount_type"><input type="hidden" name="NewPrice[' + name_count + '][tuesday_normal_discount][0]" value="0" class="tuesday_normal_discount"><input type="hidden" name="NewPrice[' + name_count + '][tuesday_coupon_discount][0]" value="0" class="tuesday_coupon_discount"><input type="hidden" name="NewPrice[' + name_count + '][wednesday_discount_type][0]" value="0" class="wednesday_discount_type"><input type="hidden" name="NewPrice[' + name_count + '][wednesday_normal_discount][0]" value="0" class="wednesday_normal_discount"><input type="hidden" name="NewPrice[' + name_count + '][wednesday_coupon_discount][0]" value="0" class="wednesday_coupon_discount"><input type="hidden" name="NewPrice[' + name_count + '][thursday_discount_type][0]" value="0" class="thursday_discount_type"><input type="hidden" name="NewPrice[' + name_count + '][thursday_normal_discount][0]" value="0" class="thursday_normal_discount"><input type="hidden" name="NewPrice[' + name_count + '][thursday_coupon_discount][0]" value="0" class="thursday_coupon_discount"><input type="hidden" name="NewPrice[' + name_count + '][friday_discount_type][0]" value="0" class="friday_discount_type"><input type="hidden" name="NewPrice[' + name_count + '][friday_normal_discount][0]" value="0" class="friday_normal_discount"><input type="hidden" name="NewPrice[' + name_count + '][friday_coupon_discount][0]" value="0" class="friday_coupon_discount"><input type="hidden" name="NewPrice[' + name_count + '][saturday_discount_type][0]" value="0" class="saturday_discount_type"><input type="hidden" name="NewPrice[' + name_count + '][saturday_normal_discount][0]" value="0" class="saturday_normal_discount"><input type="hidden" name="NewPrice[' + name_count + '][saturday_coupon_discount][0]" value="0" class="saturday_coupon_discount"> </div><button style="display:none;" type="button" class="btn btn-info btn-lg price_daywise" data-toggle="modal" data-id="d_price' + name_count + '">Add Price</button></td><td><button type="button" name="add" id="row_id_' + name_count + '"  class="add_new_price_range btn btn-success" style="margin-left: 10px">Add Row</button></td></table>  <td><button type="button" name="remove" id="' + name_count1 + '" class="btn btn-danger btn_remove_new_price">X</button></td></tr>');

    // Append a new row for the dynamic price field
    $('#new_price_dynamic_field').append(
        '<tr id="new_price_row' + name_count1 + '">' +
            '<td>' +
                // Package rating dropdown
                '<select name="NewPrice[' + name_count + '][package_rating]" ' +
                        'id="newrating' + name_count + '" ' +
                        'class="form-control rating-field new_price_category" ' +
                        'style="width: 100%;">' +
                '</select>' +
                // Other rating input, hidden by default
                '<input name="NewPrice[' + name_count + '][package_rating_other]" ' +
                        'id="otherrating' + name_count + '" ' +
                        'class="form-control other-rating" ' +
                        'style="width: 100%; display:none">' +
            '</td>' +
            '<td class="dynamic_price_range_' + name_count + '">' +
                '<table class="table" id="dynamic_price_range_' + name_count + '_0">' +
                    '<tr>' +
                        '<th>Price from</th>' +
                        '<th>Price to</th>' +
                        '<th>Cut Off Point</th>' +
                        '<th>Applicable For</th>' +
                    '</tr>' +
                    '<tr>' +
                        // Date from input with datepicker
                        '<td>' +
                            '<div class="input-group date">' +
                                '<div class="input-group-addon">' +
                                    '<i class="fa fa-calendar"></i>' +
                                '</div>' +
                                '<input name="NewPrice[' + name_count + '][datefrom][0]" ' +
                                       'class="form-control pull-right datepicker_package date_start" ' +
                                       'type="text">' +
                            '</div>' +
                        '</td>' +
                        // Date to input with datepicker
                        '<td>' +
                            '<div class="input-group date">' +
                                '<div class="input-group-addon">' +
                                    '<i class="fa fa-calendar"></i>' +
                                '</div>' +
                                '<input name="NewPrice[' + name_count + '][dateto][0]" ' +
                                       'class="form-control pull-right datepicker_package date_end" ' +
                                       'type="text">' +
                            '</div>' +
                        '</td>' +
                        // Cut off point input
                        '<td>' +
                            '<input type="number" value="0" ' +
                                   'name="NewPrice[' + name_count + '][cuttoffpoint][0]" ' +
                                   'class="form-control cuttoffpoint" ' +
                                   'placeholder="Cut Off Days">' +
                        '</td>' +
                        // Applicable for dropdown
                        '<td>' +
                            '<select class="form-control price_applicable_for" ' +
                                    'name="NewPrice[' + name_count + '][applicable_for][0]">' +
                                '<option value="all">All Days</option>' +
                                '<option value="day_wise">Day Wise</option>' +
                            '</select>' +
                        '</td>' +
                        '<td class="price_td">' +
                            // Overall discount type dropdown
                            '<select class="form-control over_all_discount_type" ' +
                                    'name="NewPrice[' + name_count + '][over_all_discount_type][0]">' +
                                '<option value="0">No Discount</option>' +
                                '<option value="2">Percentage</option>' +
                                '<option value="3">Coupon</option>' +
                            '</select>' +
                            // Normal discount dropdown, hidden by default
                            '<select class="form-control number_test normal_discount" ' +
                                    'name="NewPrice[' + name_count + '][normal_discount][0]" ' +
                                    'style="display: none;">' +
                                normal_discount_first +
                            '</select>' +
                            // Coupon discount dropdown, hidden by default
                            '<select class="coupon_discount number_test form-control" ' +
                                    'name="NewPrice[' + name_count + '][coupon_discount][0]" ' +
                                    'style="display: none;">' +
                                coupon_discount_first +
                            '</select>' +
                            // Hidden inputs for daily discount types and values
                            '<div class="d_price' + name_count + '0" id="d_price' + name_count + '0">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][sunday_discount_type][0]" value="0" class="sunday_discount_type">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][sunday_normal_discount][0]" value="0" class="sunday_normal_discount">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][sunday_coupon_discount][0]" value="0" class="sunday_coupon_discount">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][monday_discount_type][0]" value="0" class="monday_discount_type">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][monday_normal_discount][0]" value="0" class="monday_normal_discount">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][monday_coupon_discount][0]" value="0" class="monday_coupon_discount">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][tuesday_discount_type][0]" value="0" class="tuesday_discount_type">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][tuesday_normal_discount][0]" value="0" class="tuesday_normal_discount">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][tuesday_coupon_discount][0]" value="0" class="tuesday_coupon_discount">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][wednesday_discount_type][0]" value="0" class="wednesday_discount_type">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][wednesday_normal_discount][0]" value="0" class="wednesday_normal_discount">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][wednesday_coupon_discount][0]" value="0" class="wednesday_coupon_discount">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][thursday_discount_type][0]" value="0" class="thursday_discount_type">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][thursday_normal_discount][0]" value="0" class="thursday_normal_discount">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][thursday_coupon_discount][0]" value="0" class="thursday_coupon_discount">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][friday_discount_type][0]" value="0" class="friday_discount_type">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][friday_normal_discount][0]" value="0" class="friday_normal_discount">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][friday_coupon_discount][0]" value="0" class="friday_coupon_discount">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][saturday_discount_type][0]" value="0" class="saturday_discount_type">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][saturday_normal_discount][0]" value="0" class="saturday_normal_discount">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][saturday_coupon_discount][0]" value="0" class="saturday_coupon_discount">' +
                            '</div>' +
                            // Button for adding price details, hidden by default
                            '<button style="display:none;" type="button" ' +
                                    'class="btn btn-info btn-lg price_daywise" ' +
                                    'data-toggle="modal" data-id="d_price' + name_count + '">' +
                                'Add Price' +
                            '</button>' +
                        '</td>' +
                        // Button to add a new price range row
                        '<td>' +
                            '<button type="button" name="add" ' +
                                    'id="row_id_' + name_count + '" ' +
                                    'class="add_new_price_range btn btn-success" ' +
                                    'style="margin-left: 10px">' +
                                'Add Row' +
                            '</button>' +
                        '</td>' +
                    '</tr>' +
                '</table>' +
            '</td>' +
            // Button to remove the row
            '<td>' +
                '<button type="button" name="remove" ' +
                        'id="' + name_count1 + '" ' +
                        'class="btn btn-danger btn_remove_new_price">' +
                    'X' +
                '</button>' +
            '</td>' +
        '</tr>'
    );

    new_price_discount_validation()
    i++;
});*/

// add tour price category
$('#add-new-price-row').click(function () {
    var name_count1 = $("#new_price_dynamic_field").children().children(':last').attr('id').slice(13)
    var name_count = parseInt(name_count1) - "1";
    name_count1++
    name_count++
    var normal_discount_first=$(".normal_discount_first").html()
    var coupon_discount_first=$(".coupon_discount_first").html()
    //$('#new_price_dynamic_field').append('<tr id="new_price_row' + name_count1 + '"><td><select name="NewPrice[' + name_count + '][package_rating]" id="newrating' + name_count + '" class="form-control rating-field new_price_category" style="width: 100%;"> </select><input name="NewPrice[' + name_count + '][package_rating_other]" id="otherrating' + name_count + '" class="form-control other-rating" style="width: 100%;display:none"></td><td class="dynamic_price_range_' + name_count + '"><table class="table" id="dynamic_price_range_' + name_count + '_0"><tr><th>Price from</th><th>Price to</th><th>Cut Off Point</th><th>Applicable For</th></tr><tr><td><div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input name="NewPrice[' + name_count + '][datefrom][0]" class="form-control pull-right datepicker_package date_start" type="text"> </div></td><td><div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i> </div><input name="NewPrice[' + name_count + '][dateto][0]" class="form-control pull-right datepicker_package date_end" type="text"></div></td><td><input type="number" value="0" name="NewPrice[' + name_count + '][cuttoffpoint][0]" class="form-control cuttoffpoint" placeholder="Cutt Off Days"></td><td> <select class="form-control price_applicable_for" name="NewPrice[' + name_count + '][applicable_for][0]"><option value="all" >All Days</option><option value="day_wise">Day Wise</option></select></td><td class="price_td"><select class="form-control over_all_discount_type" name="NewPrice[' + name_count + '][over_all_discount_type][0]"><option value="0">No Discount</option><option value="2">Percentage</option><option value="3">Coupon</option></select><select class="form-control number_test normal_discount" name="NewPrice[' + name_count + '][normal_discount][0]" style="display: none;">'+normal_discount_first+'</select><select class="coupon_discount number_test form-control" name="NewPrice[' + name_count + '][coupon_discount][0]" style="display: none;">'+coupon_discount_first+'</select><div class="d_price'+name_count+'0" id="d_price'+name_count+'0" ><input type="hidden" name="NewPrice[' + name_count + '][sunday_discount_type][0]" value="0" class="sunday_discount_type"><input type="hidden" name="NewPrice[' + name_count + '][sunday_normal_discount][0]" value="0" class="sunday_normal_discount"><input type="hidden" name="NewPrice[' + name_count + '][sunday_coupon_discount][0]" value="0" class="sunday_coupon_discount"><input type="hidden" name="NewPrice[' + name_count + '][monday_discount_type][0]" value="0" class="monday_discount_type"><input type="hidden" name="NewPrice[' + name_count + '][monday_normal_discount][0]" value="0" class="monday_normal_discount"><input type="hidden" name="NewPrice[' + name_count + '][monday_coupon_discount][0]" value="0" class="monday_coupon_discount"><input type="hidden" name="NewPrice[' + name_count + '][tuesday_discount_type][0]" value="0" class="tuesday_discount_type"><input type="hidden" name="NewPrice[' + name_count + '][tuesday_normal_discount][0]" value="0" class="tuesday_normal_discount"><input type="hidden" name="NewPrice[' + name_count + '][tuesday_coupon_discount][0]" value="0" class="tuesday_coupon_discount"><input type="hidden" name="NewPrice[' + name_count + '][wednesday_discount_type][0]" value="0" class="wednesday_discount_type"><input type="hidden" name="NewPrice[' + name_count + '][wednesday_normal_discount][0]" value="0" class="wednesday_normal_discount"><input type="hidden" name="NewPrice[' + name_count + '][wednesday_coupon_discount][0]" value="0" class="wednesday_coupon_discount"><input type="hidden" name="NewPrice[' + name_count + '][thursday_discount_type][0]" value="0" class="thursday_discount_type"><input type="hidden" name="NewPrice[' + name_count + '][thursday_normal_discount][0]" value="0" class="thursday_normal_discount"><input type="hidden" name="NewPrice[' + name_count + '][thursday_coupon_discount][0]" value="0" class="thursday_coupon_discount"><input type="hidden" name="NewPrice[' + name_count + '][friday_discount_type][0]" value="0" class="friday_discount_type"><input type="hidden" name="NewPrice[' + name_count + '][friday_normal_discount][0]" value="0" class="friday_normal_discount"><input type="hidden" name="NewPrice[' + name_count + '][friday_coupon_discount][0]" value="0" class="friday_coupon_discount"><input type="hidden" name="NewPrice[' + name_count + '][saturday_discount_type][0]" value="0" class="saturday_discount_type"><input type="hidden" name="NewPrice[' + name_count + '][saturday_normal_discount][0]" value="0" class="saturday_normal_discount"><input type="hidden" name="NewPrice[' + name_count + '][saturday_coupon_discount][0]" value="0" class="saturday_coupon_discount"> </div><button style="display:none;" type="button" class="btn btn-info btn-lg price_daywise" data-toggle="modal" data-id="d_price' + name_count + '">Add Price</button></td><td><button type="button" name="add" id="row_id_' + name_count + '"  class="add_new_price_range btn btn-success" style="margin-left: 10px">Add Row</button></td></table>  <td><button type="button" name="remove" id="' + name_count1 + '" class="btn btn-danger btn_remove_new_price">X</button></td></tr>');
    
    /*// Append a new row to the #new_price_dynamic_field table with dynamic content
    $('#new_price_dynamic_field').append(
        '<tr id="new_price_row' + name_count1 + '">' +
            // Package rating dropdown and other rating input
            '<td>' +
                '<select name="NewPrice[' + name_count + '][package_rating]" id="newrating' + name_count + '" class="form-control rating-field new_price_category" style="width: 100%;">' +
                '</select>' +
                '<input name="NewPrice[' + name_count + '][package_rating_other]" id="otherrating' + name_count + '" class="form-control other-rating" style="width: 100%; display:none">' +
            '</td>' +

            // Price range table structure
            '<td class="dynamic_price_range_' + name_count + '">' +
                '<table class="table" id="dynamic_price_range_' + name_count + '_0">' +
                    '<tr>' +
                        '<th>Price from</th>' +
                        '<th>Price to</th>' +
                        '<th>Cut Off Point</th>' +
                        '<th>Applicable For</th>' +
                    '</tr>' +
                    '<tr>' +
                        // Price from date input
                        '<td>' +
                            '<div class="input-group date">' +
                                '<div class="input-group-addon"><i class="fa fa-calendar"></i></div>' +
                                '<input name="NewPrice[' + name_count + '][datefrom][0]" class="form-control pull-right datepicker_package date_start" type="text">' +
                            '</div>' +
                        '</td>' +
                        // Price to date input
                        '<td>' +
                            '<div class="input-group date">' +
                                '<div class="input-group-addon"><i class="fa fa-calendar"></i></div>' +
                                '<input name="NewPrice[' + name_count + '][dateto][0]" class="form-control pull-right datepicker_package date_end" type="text">' +
                            '</div>' +
                        '</td>' +
                        // Cut Off Point input
                        '<td>' +
                            '<input type="number" value="0" name="NewPrice[' + name_count + '][cuttoffpoint][0]" class="form-control cuttoffpoint" placeholder="Cut Off Days">' +
                        '</td>' +
                        // Applicable For dropdown
                        '<td>' +
                            '<select class="form-control price_applicable_for" name="NewPrice[' + name_count + '][applicable_for][0]">' +
                                '<option value="all">All Days</option>' +
                                '<option value="day_wise">Day Wise</option>' +
                            '</select>' +
                        '</td>' +
                        // Price details and discount selections
                        '<td class="price_td">' +
                            '<select class="form-control over_all_discount_type" name="NewPrice[' + name_count + '][over_all_discount_type][0]">' +
                                '<option value="0">No Discount</option>' +
                                '<option value="2">Percentage</option>' +
                                '<option value="3">Coupon</option>' +
                            '</select>' +
                            '<select class="form-control number_test normal_discount" name="NewPrice[' + name_count + '][normal_discount][0]" style="display: none;">' +
                                normal_discount_first +
                            '</select>' +
                            '<select class="coupon_discount number_test form-control" name="NewPrice[' + name_count + '][coupon_discount][0]" style="display: none;">' +
                                coupon_discount_first +
                            '</select>' +

                            // Hidden inputs for day-wise discount types
                            '<div class="d_price' + name_count + '0" id="d_price' + name_count + '0">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][sunday_discount_type][0]" value="0" class="sunday_discount_type">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][sunday_normal_discount][0]" value="0" class="sunday_normal_discount">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][sunday_coupon_discount][0]" value="0" class="sunday_coupon_discount">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][monday_discount_type][0]" value="0" class="monday_discount_type">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][monday_normal_discount][0]" value="0" class="monday_normal_discount">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][monday_coupon_discount][0]" value="0" class="monday_coupon_discount">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][tuesday_discount_type][0]" value="0" class="tuesday_discount_type">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][tuesday_normal_discount][0]" value="0" class="tuesday_normal_discount">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][tuesday_coupon_discount][0]" value="0" class="tuesday_coupon_discount">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][wednesday_discount_type][0]" value="0" class="wednesday_discount_type">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][wednesday_normal_discount][0]" value="0" class="wednesday_normal_discount">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][wednesday_coupon_discount][0]" value="0" class="wednesday_coupon_discount">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][thursday_discount_type][0]" value="0" class="thursday_discount_type">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][thursday_normal_discount][0]" value="0" class="thursday_normal_discount">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][thursday_coupon_discount][0]" value="0" class="thursday_coupon_discount">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][friday_discount_type][0]" value="0" class="friday_discount_type">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][friday_normal_discount][0]" value="0" class="friday_normal_discount">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][friday_coupon_discount][0]" value="0" class="friday_coupon_discount">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][saturday_discount_type][0]" value="0" class="saturday_discount_type">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][saturday_normal_discount][0]" value="0" class="saturday_normal_discount">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][saturday_coupon_discount][0]" value="0" class="saturday_coupon_discount">' +
                            '</div>' +

                            // Button to add more price details
                            '<button style="display:none;" type="button" class="btn btn-info btn-lg price_daywise" data-toggle="modal" data-id="d_price' + name_count + '">Add Price</button>' +
                        '</td>' +

                        // Button to add a new price range row
                        '<td>' +
                            '<button type="button" name="add" id="row_id_' + name_count + '" class="add_new_price_range btn btn-success" style="margin-left: 10px">Add Row</button>' +
                        '</td>' +
                    '</tr>' +
                '</table>' +
            '</td>' +

            // Button to remove the current row
            '<td>' +
                '<button type="button" name="remove" id="' + name_count1 + '" class="btn btn-danger btn_remove_new_price">Remove tour category</button>' +
            '</td>' +
        '</tr>'
    );*/

    // Append a new row to the #new_price_dynamic_field table with dynamic content
    $('#new_price_dynamic_field').append(
        '<tr class="price-range-container" id="new_price_row' + name_count1 + '">' +
            //<!-- Select Category -->
            // Package rating dropdown and other rating input
            '<td>' +
                '<table class="table">' +
                    '<thead>' +
                        '<tr>' +
                            '<th>Tour Category</th>' +
                        '</tr>' +
                    '</thead>' +
                    '<tbody>' +
                        '<tr>' +
                            // Package rating dropdown and other rating input
                            '<td>' +
                                '<select name="NewPrice[' + name_count + '][package_rating]" id="newrating' + name_count + '" class="form-control rating-field new_price_category" style="width: 100%;">' +
                                '</select>' +
                                '<input name="NewPrice[' + name_count + '][package_rating_other]" id="otherrating' + name_count + '" class="form-control other-rating" style="width: 100%; display:none">' +
                            '</td>' +
                        '</tr>' +
                    '</tbody>' +
                '</table>' +
            '</td>' +


            // Price range table structure
            '<td class="dynamic_price_range_' + name_count + '">' +
                '<table class="table" id="dynamic_price_range_' + name_count + '_0">' +
                    '<tr>' +
                        '<th>Price starting date</th>' +
                        '<th>Price end date</th>' +
                        '<th>Price applicable date (cut-off point</th>' +
                        '<th>Discount applicable on</th>' +
                        '<th>Action</th>' +
                    '</tr>' +
                    '<tr>' +

                        // Price from date input
                        '<td>' +
                            '<div class="input-group date">' +
                                '<div class="input-group-addon"><i class="fa fa-calendar"></i></div>' +
                                '<input name="NewPrice[' + name_count + '][datefrom][0]" class="form-control pull-right datepicker_package date_start" type="text">' +
                            '</div>' +
                        '</td>' +

                        // Price to date input
                        '<td>' +
                            '<div class="input-group date">' +
                                '<div class="input-group-addon"><i class="fa fa-calendar"></i></div>' +
                                '<input name="NewPrice[' + name_count + '][dateto][0]" class="form-control pull-right datepicker_package date_end" type="text" readonly="readonly">' +
                            '</div>' +
                        '</td>' +

                        // Cut Off Point input
                        '<td>' +
                            '<input type="number" value="0" name="NewPrice[' + name_count + '][cuttoffpoint][0]" class="form-control cuttoffpoint" placeholder="Cut Off Days">' +
                        '</td>' +

                        // Applicable For dropdown
                        '<td>' +
                            '<select class="form-control price_applicable_for" name="NewPrice[' + name_count + '][applicable_for][0]">' +
                                '<option value="all">All Days</option>' +
                                '<option value="day_wise">Day Wise</option>' +
                            '</select>' +
                        '</td>' +

                        // Price details and discount selections
                        '<td class="price_td">' +
                            '<div class="price_td makeflex" style="column-gap: 10px;">' +
                            '<select class="form-control over_all_discount_type" name="NewPrice[' + name_count + '][over_all_discount_type][0]">' +
                                '<option value="0">No Discount</option>' +
                                '<option value="2">Percentage</option>' +
                                '<option value="3">Coupon</option>' +
                            '</select>' +
                            '<select class="form-control number_test normal_discount" name="NewPrice[' + name_count + '][normal_discount][0]" style="display: none;">' +
                                normal_discount_first +
                            '</select>' +
                            '<select class="coupon_discount number_test form-control" name="NewPrice[' + name_count + '][coupon_discount][0]" style="display: none;">' +
                                coupon_discount_first +
                            '</select>' +

                            // Hidden inputs for day-wise discount types
                            '<div class="d_price' + name_count + '0" id="d_price' + name_count + '0">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][sunday_discount_type][0]" value="0" class="sunday_discount_type">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][sunday_normal_discount][0]" value="0" class="sunday_normal_discount">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][sunday_coupon_discount][0]" value="0" class="sunday_coupon_discount">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][monday_discount_type][0]" value="0" class="monday_discount_type">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][monday_normal_discount][0]" value="0" class="monday_normal_discount">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][monday_coupon_discount][0]" value="0" class="monday_coupon_discount">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][tuesday_discount_type][0]" value="0" class="tuesday_discount_type">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][tuesday_normal_discount][0]" value="0" class="tuesday_normal_discount">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][tuesday_coupon_discount][0]" value="0" class="tuesday_coupon_discount">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][wednesday_discount_type][0]" value="0" class="wednesday_discount_type">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][wednesday_normal_discount][0]" value="0" class="wednesday_normal_discount">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][wednesday_coupon_discount][0]" value="0" class="wednesday_coupon_discount">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][thursday_discount_type][0]" value="0" class="thursday_discount_type">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][thursday_normal_discount][0]" value="0" class="thursday_normal_discount">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][thursday_coupon_discount][0]" value="0" class="thursday_coupon_discount">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][friday_discount_type][0]" value="0" class="friday_discount_type">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][friday_normal_discount][0]" value="0" class="friday_normal_discount">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][friday_coupon_discount][0]" value="0" class="friday_coupon_discount">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][saturday_discount_type][0]" value="0" class="saturday_discount_type">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][saturday_normal_discount][0]" value="0" class="saturday_normal_discount">' +
                                '<input type="hidden" name="NewPrice[' + name_count + '][saturday_coupon_discount][0]" value="0" class="saturday_coupon_discount">' +
                            '</div>' +

                            // Button to add more price details
                            '<button style="display:none;" type="button" class="btn btn-info btn-lg price_daywise" data-toggle="modal" data-id="d_price' + name_count + '">Add Price</button>' +
                            '</div>' +
                        '</td>' +

                        // Button to add a new price range row
                        '<td>' +
                            '<button type="button" name="add" id="row_id_' + name_count + '" class="add_new_price_range btn btn-success" style="margin-left: 10px">Add Price Row</button>' +
                        '</td>' +
                    '</tr>' +
                '</table>' +
            '</td>' +

            // Button to remove the current row
            '<td>' +
                '<button type="button" name="remove" id="' + name_count1 + '" class="btn btn-danger btn_remove_new_price">Remove</button>' +
            '</td>' +
        '</tr>'
    );

    $(".date_start").datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true,
    });

    new_price_discount_validation()
    i++;
});

// remove price category
$(document).on('click', '.btn_remove_new_price', function () {
    var button_id = $(this).attr("id");
    $('#new_price_row' + button_id + '').remove();
});

/******************************************/

//
$(document).on('click', '.price_add', function () {
    var id = $(this).data('id');
    var air_fare_adult = $('.' + id).children(".air_fare_adult").val()
    var air_fare_exadult = $('.' + id).children(".air_fare_exadult").val()
    var air_fare_childbed = $('.' + id).children(".air_fare_childbed").val()
    var air_fare_childwbed = $('.' + id).children(".air_fare_childwbed").val()
    var air_fare_infant = $('.' + id).children(".air_fare_infant").val()
    var air_fare_single = $('.' + id).children(".air_fare_single").val()
    var air_currency = $('.' + id).children(".air_currency").val()
    //
    var hotel_fare_adult = $('.' + id).children(".hotel_fare_adult").val()
    var hotel_fare_exadult = $('.' + id).children(".hotel_fare_exadult").val()
    var hotel_fare_childbed = $('.' + id).children(".hotel_fare_childbed").val()
    var hotel_fare_childwbed = $('.' + id).children(".hotel_fare_childwbed").val()
    var hotel_fare_infant = $('.' + id).children(".hotel_fare_infant").val()
    var hotel_fare_single = $('.' + id).children(".hotel_fare_single").val()
    var hotel_currency = $('.' + id).children(".hotel_currency").val()
    //
    var tour_fare_adult = $('.' + id).children(".tour_fare_adult").val()
    var tour_fare_exadult = $('.' + id).children(".tour_fare_exadult").val()
    var tour_fare_childbed = $('.' + id).children(".tour_fare_childbed").val()
    var tour_fare_childwbed = $('.' + id).children(".tour_fare_childwbed").val()
    var tour_fare_infant = $('.' + id).children(".tour_fare_infant").val()
    var tour_fare_single = $('.' + id).children(".tour_fare_single").val()
    var tour_currency = $('.' + id).children(".tour_currency").val()
    //
    var transfer_fare_adult = $('.' + id).children(".transfer_fare_adult").val()
    var transfer_fare_exadult = $('.' + id).children(".transfer_fare_exadult").val()
    var transfer_fare_childbed = $('.' + id).children(".transfer_fare_childbed").val()
    var transfer_fare_childwbed = $('.' + id).children(".transfer_fare_childwbed").val()
    var transfer_fare_infant = $('.' + id).children(".transfer_fare_infant").val()
    var transfer_fare_single = $('.' + id).children(".transfer_fare_single").val()
    var transfer_currency = $('.' + id).children(".transfer_currency").val()
    //
    var visa_fare_adult = $('.' + id).children(".visa_fare_adult").val()
    var visa_fare_exadult = $('.' + id).children(".visa_fare_exadult").val()
    var visa_fare_childbed = $('.' + id).children(".visa_fare_childbed").val()
    var visa_fare_childwbed = $('.' + id).children(".visa_fare_childwbed").val()
    var visa_fare_infant = $('.' + id).children(".visa_fare_infant").val()
    var visa_fare_single = $('.' + id).children(".visa_fare_single").val()
    var visa_currency = $('.' + id).children(".visa_currency").val()
    //
    var adult_fare = $('.' + id).children(".adult_fare").val()
    var adult_currency = $('.' + id).children(".adult_currency").val()
    var chiildbed_fare = $('.' + id).children(".chiildbed_fare").val()
    var chiildbed_currency = $('.' + id).children(".air_fare").val()
    var chiildwbed_fare = $('.' + id).children(".chiildwbed_fare").val()
    var chiildwbed_currency = $('.' + id).children(".chiildwbed_currency").val()
    var infant_fare = $('.' + id).children(".infant_fare").val()
    var infant_currency = $('.' + id).children(".infant_currency").val()
    var single_fare = $('.' + id).children(".single_fare").val()
    var single_currency = $('.' + id).children(".single_currency").val()
    //
    var adult_fare_total = $('.' + id).children(".adult_fare_total").val()
    var exadult_fare_total = $('.' + id).children(".exadult_fare_total").val()
    var childwithbed_fare_total = $('.' + id).children(".childwithbed_fare_total").val()
    var childwithoutbed_fare_total = $('.' + id).children(".childwithoutbed_fare_total").val()
    var infant_fare_total = $('.' + id).children(".infant_fare_total").val()
    var single_fare_total = $('.' + id).children(".single_fare_total").val()
    $('#price_add').modal('show');
    $('#price_add .price_class').val("").val(id);
    $('#price_add .modal-body').attr('id', id);
    if (air_currency > 0) {
        $.ajax({
            type: 'POST',
            url: APP_URL + "/air_curr",
            data: { air_currency: air_currency },
            success: function (data) {
                //console.log('success : '+data);
                $('#price_add .a_curr').html("").html(data);
            },
            error: function (data) {
                //console.log('Error : '+data);
            }
        });
    }
    if (air_currency == "") {
        $.ajax({
            type: 'POST',
            url: APP_URL + "/all_curr",
            //data:{duration_value:duration_value},
            success: function (data) {
                //console.log('success : '+data);
                $('#price_add .a_curr').html("").html(data);
            },
            error: function (data) {
                //console.log('Error : '+data);
            }
        });
    }
    if (hotel_currency == "") {
        $.ajax({
            type: 'POST',
            url: APP_URL + "/all_curr",
            //data:{duration_value:duration_value},
            success: function (data) {
                //console.log('success : '+data);
                $('#price_add .h_curr').html("").html(data);
            },
            error: function (data) {
                //console.log('Error : '+data);
            }
        });
    }
    if (hotel_currency > 0) {
        $.ajax({
            type: 'POST',
            url: APP_URL + "/hot_curr",
            data: { air_currency: hotel_currency },
            success: function (data) {
                //console.log('success : '+data);
                $('#price_add .h_curr').html("").html(data);
            },
            error: function (data) {
                //console.log('Error : '+data);
            }
        });
    }
    if (tour_currency > 0) {
        $.ajax({
            type: 'POST',
            url: APP_URL + "/tour_curr",
            data: { air_currency: tour_currency },
            success: function (data) {
                //console.log('success : '+data);
                $('#price_add .t_curr').html("").html(data);
            },
            error: function (data) {
                //console.log('Error : '+data);
            }
        });
    }
    if (tour_currency == "") {
        $.ajax({
            type: 'POST',
            url: APP_URL + "/all_curr",
            //data:{duration_value:duration_value},
            success: function (data) {
                //console.log('success : '+data);
                $('#price_add .t_curr').html("").html(data);
            },
            error: function (data) {
                //console.log('Error : '+data);
            }
        });
    }
    if (transfer_currency > 0) {
        $.ajax({
            type: 'POST',
            url: APP_URL + "/transfer_curr",
            data: { air_currency: transfer_currency },
            success: function (data) {
                //console.log('success : '+data);
                $('#price_add .to_curr').html("").html(data);
            },
            error: function (data) {
                //console.log('Error : '+data);
            }
        });
    }
    if (transfer_currency == "") {
        $.ajax({
            type: 'POST',
            url: APP_URL + "/all_curr",
            //data:{duration_value:duration_value},
            success: function (data) {
                //console.log('success : '+data);
                $('#price_add .to_curr').html("").html(data);
            },
            error: function (data) {
                //console.log('Error : '+data);
            }
        });
    }
    if (visa_currency > 0) {
        $.ajax({
            type: 'POST',
            url: APP_URL + "/visa_curr",
            data: { air_currency: visa_currency },
            success: function (data) {
                //console.log('success : '+data);
                $('#price_add .v_curr').html("").html(data);
            },
            error: function (data) {
                //console.log('Error : '+data);
            }
        });
    }
    //total_fare_adult
    $.ajax({
        type: 'POST',
        url: APP_URL + '/total_adult',
        data: { air_currency: air_currency, air_fare_adult: air_fare_adult, hotel_fare_adult: hotel_fare_adult, hotel_currency: hotel_currency, tour_currency: tour_currency, tour_fare_adult: tour_fare_adult, transfer_currency: transfer_currency, transfer_fare_adult: transfer_fare_adult, visa_currency: visa_currency, visa_fare_adult: visa_fare_adult },
        success: function (data) {
            if (data != "NA") {
                $('#price_add .adult_total').val("").val(data);
            }
        },
        error: function (data) {
        }
    })
    //total_fare_extra_adult
    $.ajax({
        type: 'POST',
        url: APP_URL + '/total_extra_adult',
        data: { air_currency: air_currency, air_fare_exadult: air_fare_exadult, hotel_currency: hotel_currency, hotel_fare_exadult: hotel_fare_exadult, tour_currency: tour_currency, tour_fare_exadult: tour_fare_exadult, transfer_currency: transfer_currency, transfer_fare_exadult: transfer_fare_exadult, visa_currency: visa_currency, visa_fare_exadult: visa_fare_exadult },
        success: function (data) {
            $('#price_add .extraadult_total').val("").val(data)
        },
        error: function (data) {
        }
    })
    //total_child_with_bed
    $.ajax({
        type: 'POST',
        url: APP_URL + '/total_child_with_bed',
        data: { air_currency: air_currency, air_fare_childbed: air_fare_childbed, hotel_currency: hotel_currency, hotel_fare_childbed: hotel_fare_childbed, tour_currency: tour_currency, tour_fare_childbed: tour_fare_childbed, transfer_currency: transfer_currency, transfer_fare_childbed: transfer_fare_childbed },
        success: function (data) {
            $('#price_add .childwithbed_total').val("").val(data);
        },
        error: function (data) { }
    })
    //total_child_without_bed
    $.ajax({
        type: 'POST',
        url: APP_URL + '/total_child_without_bed',
        data: { air_currency: air_currency, air_fare_childwbed: air_fare_childwbed, hotel_currency: hotel_currency, hotel_fare_childwbed: hotel_fare_childwbed, tour_currency: tour_currency, tour_fare_childwbed: tour_fare_childwbed, transfer_currency: transfer_currency, transfer_fare_childwbed: transfer_fare_childwbed, visa_currency: visa_currency, visa_fare_childwbed: visa_fare_childwbed },
        success: function (data) {
            $('#price_add .childwithoutbed_total').val("").val(data);
        },
        error: function (data) { }
    })
    //total_infant
    $.ajax({
        type: 'POST',
        url: APP_URL + '/total_infant',
        data: { air_currency: air_currency, air_fare_infant: air_fare_infant, hotel_currency: hotel_currency, hotel_fare_infant: hotel_fare_infant, tour_currency: tour_currency, tour_fare_infant: tour_fare_infant, transfer_currency: transfer_currency, transfer_fare_infant: transfer_fare_infant, visa_currency: visa_currency, visa_fare_infant: visa_fare_infant },
        success: function (data) {
            $('#price_add .infant_total').val("").val(data);
        },
        error: function (data) { }
    })
    //total_single
    $.ajax({
        type: 'POST',
        url: APP_URL + '/total_single',
        data: { air_currency: air_currency, air_fare_single: air_fare_single, hotel_currency: hotel_currency, hotel_fare_single: hotel_fare_single, tour_currency: tour_currency, tour_fare_single: tour_fare_single, transfer_currency: transfer_currency, transfer_fare_single: transfer_fare_single, visa_currency: visa_currency, visa_fare_single: visa_fare_single },
        success: function (data) {
            $('#price_add .single_total').val("").val(data);
        },
        error: function (data) { }
    })
    //
    if (visa_currency == "") {
        $.ajax({
            type: 'POST',
            url: APP_URL + "/all_curr",
            //data:{duration_value:duration_value},
            success: function (data) {
                //console.log('success : '+data);
                $('#price_add .v_curr').html("").html(data);
            },
            error: function (data) {
                //console.log('Error : '+data);
            }
        });
    }
    if (air_fare_adult == "") {
        $('#price_add .airfare_adult').val("");
    }
    if (air_fare_adult > 0) {
        $('#price_add .airfare_adult').val("").val(air_fare_adult);
    }
    if (air_fare_exadult == "") {
        $('#price_add .airfare_exadult').val("");
    }
    if (air_fare_exadult > 0) {
        $('#price_add .airfare_exadult').val("").val(air_fare_exadult);
    }
    if (air_fare_childbed == "") {
        $('#price_add .airfare_childbed').val("");
    }
    if (air_fare_childbed > 0) {
        $('#price_add .airfare_childbed').val("").val(air_fare_childbed);
    }
    if (air_fare_childwbed == "") {
        $('#price_add .airfare_childwbed').val("");
    }
    if (air_fare_childwbed > 0) {
        $('#price_add .airfare_childwbed').val("").val(air_fare_childwbed);
    }
    if (air_fare_infant == "") {
        $('#price_add .airfare_infant').val("");
    }
    if (air_fare_infant > 0) {
        $('#price_add .airfare_infant').val("").val(air_fare_infant);
    }
    if (air_fare_single == "") {
        $('#price_add .airfare_single').val("");
    }
    if (air_fare_single > 0) {
        $('#price_add .airfare_single').val("").val(air_fare_single);
    }
    //
    if (hotel_fare_adult > 0) {
        $('#price_add .hotelfare_adult').val("").val(hotel_fare_adult);
    }
    if (hotel_fare_adult == "") {
        $('#price_add .hotelfare_adult').val("");
    }
    if (hotel_fare_exadult > 0) {
        $('#price_add .hotelfare_exadult').val("").val(hotel_fare_exadult);
    }
    if (hotel_fare_exadult == "") {
        $('#price_add .hotelfare_exadult').val("");
    }
    if (hotel_fare_childbed > 0) {
        $('#price_add .hotelfare_childbed').val("").val(hotel_fare_childbed);
    }
    if (hotel_fare_childbed == "") {
        $('#price_add .hotelfare_childbed').val("");
    }
    if (hotel_fare_childwbed > 0) {
        $('#price_add .hotelfare_childwbed').val("").val(hotel_fare_childwbed);
    }
    if (hotel_fare_childwbed == "") {
        $('#price_add .hotelfare_childwbed').val("");
    }
    if (hotel_fare_infant > 0) {
        $('#price_add .hotelfare_infant').val("").val(hotel_fare_infant);
    }
    if (hotel_fare_infant == "") {
        $('#price_add .hotelfare_infant').val("");
    }
    if (hotel_fare_single > 0) {
        $('#price_add .hotelfare_single').val("").val(hotel_fare_single);
    }
    if (hotel_fare_single == "") {
        $('#price_add .hotelfare_single').val("");
    }
    //
    if (tour_fare_adult > 0) {
        $('#price_add .tourfare_adult').val("").val(tour_fare_adult);
    }
    if (tour_fare_adult == "") {
        $('#price_add .tourfare_adult').val("");
    }
    if (tour_fare_exadult > 0) {
        $('#price_add .tourfare_exadult').val("").val(tour_fare_exadult);
    }
    if (tour_fare_exadult == "") {
        $('#price_add .tourfare_exadult').val("");
    }
    if (tour_fare_childbed > 0) {
        $('#price_add .tourfare_childbed').val("").val(tour_fare_childbed);
    }
    if (tour_fare_childbed == "") {
        $('#price_add .tourfare_childbed').val("");
    }
    if (tour_fare_childwbed > 0) {
        $('#price_add .tourfare_childwbed').val("").val(tour_fare_childwbed);
    }
    if (tour_fare_childwbed == "") {
        $('#price_add .tourfare_childwbed').val("");
    }
    if (tour_fare_infant > 0) {
        $('#price_add .tourfare_infant').val("").val(tour_fare_infant);
    }
    if (tour_fare_infant == "") {
        $('#price_add .tourfare_infant').val("");
    }
    if (tour_fare_single > 0) {
        $('#price_add .tourfare_single').val("").val(tour_fare_single);
    }
    if (tour_fare_single == "") {
        $('#price_add .tourfare_single').val("");
    }
    //
    if (transfer_fare_adult > 0) {
        $('#price_add .transferfare_adult').val("").val(transfer_fare_adult);
    }
    if (transfer_fare_adult == "") {
        $('#price_add .transferfare_adult').val("");
    }
    if (transfer_fare_exadult > 0) {
        $('#price_add .transferfare_exadult').val("").val(transfer_fare_exadult);
    }
    if (transfer_fare_exadult == "") {
        $('#price_add .transferfare_exadult').val("");
    }
    if (transfer_fare_childbed > 0) {
        $('#price_add .transferfare_childbed').val("").val(transfer_fare_childbed);
    }
    if (transfer_fare_childbed == "") {
        $('#price_add .transferfare_childbed').val("");
    }
    if (transfer_fare_childwbed > 0) {
        $('#price_add .transferfare_childwbed').val("").val(transfer_fare_childwbed);
    }
    if (transfer_fare_childwbed == "") {
        $('#price_add .transferfare_childwbed').val("");
    }
    if (transfer_fare_infant > 0) {
        $('#price_add .transferfare_infant').val("").val(transfer_fare_infant);
    }
    if (transfer_fare_infant == "") {
        $('#price_add .transferfare_infant').val("");
    }
    if (transfer_fare_single > 0) {
        $('#price_add .transferfare_single').val("").val(transfer_fare_single);
    }
    if (transfer_fare_single == "") {
        $('#price_add .transferfare_single').val("");
    }
    //
    if (visa_fare_adult > 0) {
        $('#price_add .visafare_adult').val("").val(visa_fare_adult);
    }
    if (visa_fare_adult == "") {
        $('#price_add .visafare_adult').val("");
    }
    if (visa_fare_exadult > 0) {
        $('#price_add .visafare_exadult').val("").val(visa_fare_exadult);
    }
    if (visa_fare_exadult == "") {
        $('#price_add .visafare_exadult').val("");
    }
    if (visa_fare_childbed > 0) {
        $('#price_add .visafare_childbed').val("").val(visa_fare_childbed);
    }
    if (visa_fare_childbed == "") {
        $('#price_add .visafare_childbed').val("");
    }
    if (visa_fare_childwbed > 0) {
        $('#price_add .visafare_childwbed').val("").val(visa_fare_childwbed);
    }
    if (visa_fare_childwbed == "") {
        $('#price_add .visafare_childwbed').val("");
    }
    if (visa_fare_infant > 0) {
        $('#price_add .visafare_infant').val("").val(visa_fare_infant);
    }
    if (visa_fare_infant == "") {
        $('#price_add .visafare_infant').val("");
    }
    if (visa_fare_single > 0) {
        $('#price_add .visafare_single').val("").val(visa_fare_single);
    }
    if (visa_fare_single == "") {
        $('#price_add .visafare_single').val("");
    }
});

//
$(document).on('keyup', '.airfare_adult', function () {
    var airfare_adult = $(this).val();
    var hotelfare_adult = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_adult").val()
    var tourfare_adult = $(this).parent().parent().parent().children("tr").children().children(".tourfare_adult").val()
    var transferfare_adult = $(this).parent().parent().parent().children("tr").children().children(".transferfare_adult").val()
    var visafare_adult = $(this).parent().parent().parent().children("tr").children().children(".visafare_adult").val()
    var air_currency = $(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected');
    var h_curr = $(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
    var t_curr = $(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
    var to_curr = $(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
    var v_curr = $(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')
    var air_currency = air_currency.attr("c_val")
    var h_curr = h_curr.attr("c_val")
    var t_curr = t_curr.attr("c_val")
    var to_curr = to_curr.attr("c_val")
    var v_curr = v_curr.attr("c_val")
    var total = parseInt(airfare_adult * air_currency) + parseInt(hotelfare_adult * h_curr) + parseInt(tourfare_adult * t_curr) + parseInt(transferfare_adult * to_curr) + parseInt(visafare_adult * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".adult_total").val("").val(total)
});

$(document).on('keyup', '.hotelfare_adult', function () {
    var hotelfare_adult = $(this).val();
    var airfare_adult = $(this).parent().parent().parent().children("tr").children().children(".airfare_adult").val()
    var tourfare_adult = $(this).parent().parent().parent().children("tr").children().children(".tourfare_adult").val()
    var transferfare_adult = $(this).parent().parent().parent().children("tr").children().children(".transferfare_adult").val()
    var visafare_adult = $(this).parent().parent().parent().children("tr").children().children(".visafare_adult").val()
    var air_currency = $(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
    var h_curr = $(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
    var t_curr = $(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
    var to_curr = $(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
    var v_curr = $(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')
    var air_currency = air_currency.attr("c_val")
    var h_curr = h_curr.attr("c_val")
    var t_curr = t_curr.attr("c_val")
    var to_curr = to_curr.attr("c_val")
    var v_curr = v_curr.attr("c_val")
    var total = parseInt(airfare_adult * air_currency) + parseInt(hotelfare_adult * h_curr) + parseInt(tourfare_adult * t_curr) + parseInt(transferfare_adult * to_curr) + parseInt(visafare_adult * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".adult_total").val("").val(total)
});

$(document).on('keyup', '.tourfare_adult', function () {
    var tourfare_adult = $(this).val();
    var hotelfare_adult = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_adult").val()
    var airfare_adult = $(this).parent().parent().parent().children("tr").children().children(".airfare_adult").val()
    var transferfare_adult = $(this).parent().parent().parent().children("tr").children().children(".transferfare_adult").val()
    var visafare_adult = $(this).parent().parent().parent().children("tr").children().children(".visafare_adult").val()
    var air_currency = $(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
    var h_curr = $(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
    var t_curr = $(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
    var to_curr = $(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
    var v_curr = $(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')
    var air_currency = air_currency.attr("c_val")
    var h_curr = h_curr.attr("c_val")
    var t_curr = t_curr.attr("c_val")
    var to_curr = to_curr.attr("c_val")
    var v_curr = v_curr.attr("c_val")
    var total = parseInt(airfare_adult * air_currency) + parseInt(hotelfare_adult * h_curr) + parseInt(tourfare_adult * t_curr) + parseInt(transferfare_adult * to_curr) + parseInt(visafare_adult * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".adult_total").val("").val(total)
});

$(document).on('keyup', '.transferfare_adult', function () {
    var transferfare_adult = $(this).val();
    var hotelfare_adult = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_adult").val()
    var tourfare_adult = $(this).parent().parent().parent().children("tr").children().children(".tourfare_adult").val()
    var airfare_adult = $(this).parent().parent().parent().children("tr").children().children(".airfare_adult").val()
    var visafare_adult = $(this).parent().parent().parent().children("tr").children().children(".visafare_adult").val()
    var air_currency = $(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
    var h_curr = $(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
    var t_curr = $(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
    var to_curr = $(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
    var v_curr = $(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')
    var air_currency = air_currency.attr("c_val")
    var h_curr = h_curr.attr("c_val")
    var t_curr = t_curr.attr("c_val")
    var to_curr = to_curr.attr("c_val")
    var v_curr = v_curr.attr("c_val")
    var total = parseInt(airfare_adult * air_currency) + parseInt(hotelfare_adult * h_curr) + parseInt(tourfare_adult * t_curr) + parseInt(transferfare_adult * to_curr) + parseInt(visafare_adult * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".adult_total").val("").val(total)
});

$(document).on('keyup', '.visafare_adult', function () {
    var visafare_adult = $(this).val();
    var hotelfare_adult = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_adult").val()
    var tourfare_adult = $(this).parent().parent().parent().children("tr").children().children(".tourfare_adult").val()
    var transferfare_adult = $(this).parent().parent().parent().children("tr").children().children(".transferfare_adult").val()
    var airfare_adult = $(this).parent().parent().parent().children("tr").children().children(".airfare_adult").val()
    var air_currency = $(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
    var h_curr = $(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
    var t_curr = $(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
    var to_curr = $(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
    var v_curr = $(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')
    var air_currency = air_currency.attr("c_val")
    var h_curr = h_curr.attr("c_val")
    var t_curr = t_curr.attr("c_val")
    var to_curr = to_curr.attr("c_val")
    var v_curr = v_curr.attr("c_val")
    var total = parseInt(airfare_adult * air_currency) + parseInt(hotelfare_adult * h_curr) + parseInt(tourfare_adult * t_curr) + parseInt(transferfare_adult * to_curr) + parseInt(visafare_adult * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".adult_total").val("").val(total)
});

//adult end
$(document).on('keyup', '.airfare_exadult', function () {
    var airfare_exadult = $(this).val();
    var hotelfare_exadult = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_exadult").val()
    var tourfare_exadult = $(this).parent().parent().parent().children("tr").children().children(".tourfare_exadult").val()
    var transferfare_exadult = $(this).parent().parent().parent().children("tr").children().children(".transferfare_exadult").val()
    var visafare_exadult = $(this).parent().parent().parent().children("tr").children().children(".visafare_exadult").val()
    var air_currency = $(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
    var h_curr = $(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
    var t_curr = $(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
    var to_curr = $(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
    var v_curr = $(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')
    var air_currency = air_currency.attr("c_val")
    var h_curr = h_curr.attr("c_val")
    var t_curr = t_curr.attr("c_val")
    var to_curr = to_curr.attr("c_val")
    var v_curr = v_curr.attr("c_val")
    var total = parseInt(airfare_exadult * air_currency) + parseInt(hotelfare_exadult * h_curr) + parseInt(tourfare_exadult * t_curr) + parseInt(transferfare_exadult * to_curr) + parseInt(visafare_exadult * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".extraadult_total").val("").val(total)
});

$(document).on('keyup', '.hotelfare_exadult', function () {
    var hotelfare_exadult = $(this).val();
    var airfare_exadult = $(this).parent().parent().parent().children("tr").children().children(".airfare_exadult").val()
    var tourfare_exadult = $(this).parent().parent().parent().children("tr").children().children(".tourfare_exadult").val()
    var transferfare_exadult = $(this).parent().parent().parent().children("tr").children().children(".transferfare_exadult").val()
    var visafare_exadult = $(this).parent().parent().parent().children("tr").children().children(".visafare_exadult").val()
    var air_currency = $(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
    var h_curr = $(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
    var t_curr = $(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
    var to_curr = $(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
    var v_curr = $(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')
    var air_currency = air_currency.attr("c_val")
    var h_curr = h_curr.attr("c_val")
    var t_curr = t_curr.attr("c_val")
    var to_curr = to_curr.attr("c_val")
    var v_curr = v_curr.attr("c_val")
    var total = parseInt(airfare_exadult * air_currency) + parseInt(hotelfare_exadult * h_curr) + parseInt(tourfare_exadult * t_curr) + parseInt(transferfare_exadult * to_curr) + parseInt(visafare_exadult * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".extraadult_total").val("").val(total)
});

$(document).on('keyup', '.tourfare_exadult', function () {
    var tourfare_exadult = $(this).val();
    var hotelfare_exadult = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_exadult").val()
    var airfare_exadult = $(this).parent().parent().parent().children("tr").children().children(".airfare_exadult").val()
    var transferfare_exadult = $(this).parent().parent().parent().children("tr").children().children(".transferfare_exadult").val()
    var visafare_exadult = $(this).parent().parent().parent().children("tr").children().children(".visafare_exadult").val()
    var air_currency = $(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
    var h_curr = $(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
    var t_curr = $(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
    var to_curr = $(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
    var v_curr = $(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')
    var air_currency = air_currency.attr("c_val")
    var h_curr = h_curr.attr("c_val")
    var t_curr = t_curr.attr("c_val")
    var to_curr = to_curr.attr("c_val")
    var v_curr = v_curr.attr("c_val")
    var total = parseInt(airfare_exadult * air_currency) + parseInt(hotelfare_exadult * h_curr) + parseInt(tourfare_exadult * t_curr) + parseInt(transferfare_exadult * to_curr) + parseInt(visafare_exadult * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".extraadult_total").val("").val(total)
});

$(document).on('keyup', '.transferfare_exadult', function () {
    var transferfare_exadult = $(this).val();
    var hotelfare_exadult = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_exadult").val()
    var tourfare_exadult = $(this).parent().parent().parent().children("tr").children().children(".tourfare_exadult").val()
    var airfare_exadult = $(this).parent().parent().parent().children("tr").children().children(".airfare_exadult").val()
    var visafare_exadult = $(this).parent().parent().parent().children("tr").children().children(".visafare_exadult").val()
    var air_currency = $(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
    var h_curr = $(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
    var t_curr = $(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
    var to_curr = $(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
    var v_curr = $(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')
    var air_currency = air_currency.attr("c_val")
    var h_curr = h_curr.attr("c_val")
    var t_curr = t_curr.attr("c_val")
    var to_curr = to_curr.attr("c_val")
    var v_curr = v_curr.attr("c_val")
    var total = parseInt(airfare_exadult * air_currency) + parseInt(hotelfare_exadult * h_curr) + parseInt(tourfare_exadult * t_curr) + parseInt(transferfare_exadult * to_curr) + parseInt(visafare_exadult * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".extraadult_total").val("").val(total)
});

$(document).on('keyup', '.visafare_exadult', function () {
    var visafare_exadult = $(this).val();
    var hotelfare_exadult = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_exadult").val()
    var tourfare_exadult = $(this).parent().parent().parent().children("tr").children().children(".tourfare_exadult").val()
    var transferfare_exadult = $(this).parent().parent().parent().children("tr").children().children(".transferfare_exadult").val()
    var airfare_exadult = $(this).parent().parent().parent().children("tr").children().children(".airfare_exadult").val()
    var air_currency = $(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
    var h_curr = $(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
    var t_curr = $(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
    var to_curr = $(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
    var v_curr = $(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')
    var air_currency = air_currency.attr("c_val")
    var h_curr = h_curr.attr("c_val")
    var t_curr = t_curr.attr("c_val")
    var to_curr = to_curr.attr("c_val")
    var v_curr = v_curr.attr("c_val")
    var total = parseInt(airfare_exadult * air_currency) + parseInt(hotelfare_exadult * h_curr) + parseInt(tourfare_exadult * t_curr) + parseInt(transferfare_exadult * to_curr) + parseInt(visafare_exadult * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".extraadult_total").val("").val(total)
});

//extra adult end
$(document).on('keyup', '.airfare_childbed', function () {
    var airfare_childbed = $(this).val();
    var hotelfare_childbed = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_childbed").val()
    var tourfare_childbed = $(this).parent().parent().parent().children("tr").children().children(".tourfare_childbed").val()
    var transferfare_childbed = $(this).parent().parent().parent().children("tr").children().children(".transferfare_childbed").val()
    var visafare_childbed = $(this).parent().parent().parent().children("tr").children().children(".visafare_childbed").val()
    var air_currency = $(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
    var h_curr = $(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
    var t_curr = $(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
    var to_curr = $(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
    var v_curr = $(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')
    var air_currency = air_currency.attr("c_val")
    var h_curr = h_curr.attr("c_val")
    var t_curr = t_curr.attr("c_val")
    var to_curr = to_curr.attr("c_val")
    var v_curr = v_curr.attr("c_val")
    var total = parseInt(airfare_childbed * air_currency) + parseInt(hotelfare_childbed * h_curr) + parseInt(tourfare_childbed * t_curr) + parseInt(transferfare_childbed * to_curr) + parseInt(visafare_childbed * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".childwithbed_total").val("").val(total)
});

$(document).on('keyup', '.hotelfare_childbed', function () {
    var hotelfare_childbed = $(this).val();
    var airfare_childbed = $(this).parent().parent().parent().children("tr").children().children(".airfare_childbed").val()
    var tourfare_childbed = $(this).parent().parent().parent().children("tr").children().children(".tourfare_childbed").val()
    var transferfare_childbed = $(this).parent().parent().parent().children("tr").children().children(".transferfare_childbed").val()
    var visafare_childbed = $(this).parent().parent().parent().children("tr").children().children(".visafare_childbed").val()
    var air_currency = $(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
    var h_curr = $(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
    var t_curr = $(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
    var to_curr = $(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
    var v_curr = $(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')
    var air_currency = air_currency.attr("c_val")
    var h_curr = h_curr.attr("c_val")
    var t_curr = t_curr.attr("c_val")
    var to_curr = to_curr.attr("c_val")
    var v_curr = v_curr.attr("c_val")
    var total = parseInt(airfare_childbed * air_currency) + parseInt(hotelfare_childbed * h_curr) + parseInt(tourfare_childbed * t_curr) + parseInt(transferfare_childbed * to_curr) + parseInt(visafare_childbed * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".childwithbed_total").val("").val(total)
});

$(document).on('keyup', '.tourfare_childbed', function () {
    var tourfare_childbed = $(this).val();
    var hotelfare_childbed = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_childbed").val()
    var airfare_childbed = $(this).parent().parent().parent().children("tr").children().children(".airfare_childbed").val()
    var transferfare_childbed = $(this).parent().parent().parent().children("tr").children().children(".transferfare_childbed").val()
    var visafare_childbed = $(this).parent().parent().parent().children("tr").children().children(".visafare_childbed").val()
    var air_currency = $(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
    var h_curr = $(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
    var t_curr = $(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
    var to_curr = $(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
    var v_curr = $(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')
    var air_currency = air_currency.attr("c_val")
    var h_curr = h_curr.attr("c_val")
    var t_curr = t_curr.attr("c_val")
    var to_curr = to_curr.attr("c_val")
    var v_curr = v_curr.attr("c_val")
    var total = parseInt(airfare_childbed * air_currency) + parseInt(hotelfare_childbed * h_curr) + parseInt(tourfare_childbed * t_curr) + parseInt(transferfare_childbed * to_curr) + parseInt(visafare_childbed * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".childwithbed_total").val("").val(total)
});

$(document).on('keyup', '.transferfare_childbed', function () {
    var transferfare_childbed = $(this).val();
    var hotelfare_childbed = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_childbed").val()
    var tourfare_childbed = $(this).parent().parent().parent().children("tr").children().children(".tourfare_childbed").val()
    var airfare_childbed = $(this).parent().parent().parent().children("tr").children().children(".airfare_childbed").val()
    var visafare_childbed = $(this).parent().parent().parent().children("tr").children().children(".visafare_childbed").val()
    var air_currency = $(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
    var h_curr = $(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
    var t_curr = $(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
    var to_curr = $(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
    var v_curr = $(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')
    var air_currency = air_currency.attr("c_val")
    var h_curr = h_curr.attr("c_val")
    var t_curr = t_curr.attr("c_val")
    var to_curr = to_curr.attr("c_val")
    var v_curr = v_curr.attr("c_val")
    var total = parseInt(airfare_childbed * air_currency) + parseInt(hotelfare_childbed * h_curr) + parseInt(tourfare_childbed * t_curr) + parseInt(transferfare_childbed * to_curr) + parseInt(visafare_childbed * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".childwithbed_total").val("").val(total)
});

$(document).on('keyup', '.visafare_childbed', function () {
    var visafare_childbed = $(this).val();
    var hotelfare_childbed = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_childbed").val()
    var tourfare_childbed = $(this).parent().parent().parent().children("tr").children().children(".tourfare_childbed").val()
    var transferfare_childbed = $(this).parent().parent().parent().children("tr").children().children(".transferfare_childbed").val()
    var airfare_childbed = $(this).parent().parent().parent().children("tr").children().children(".airfare_childbed").val()
    var air_currency = $(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
    var h_curr = $(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
    var t_curr = $(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
    var to_curr = $(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
    var v_curr = $(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')
    var air_currency = air_currency.attr("c_val")
    var h_curr = h_curr.attr("c_val")
    var t_curr = t_curr.attr("c_val")
    var to_curr = to_curr.attr("c_val")
    var v_curr = v_curr.attr("c_val")
    var total = parseInt(airfare_childbed * air_currency) + parseInt(hotelfare_childbed * h_curr) + parseInt(tourfare_childbed * t_curr) + parseInt(transferfare_childbed * to_curr) + parseInt(visafare_childbed * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".childwithbed_total").val("").val(total)
});

// child with bed end
$(document).on('keyup', '.airfare_childwbed', function () {
    var airfare_childwbed = $(this).val();
    var hotelfare_childwbed = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_childwbed").val()
    var tourfare_childwbed = $(this).parent().parent().parent().children("tr").children().children(".tourfare_childwbed").val()
    var transferfare_childwbed = $(this).parent().parent().parent().children("tr").children().children(".transferfare_childwbed").val()
    var visafare_childwbed = $(this).parent().parent().parent().children("tr").children().children(".visafare_childwbed").val()
    var air_currency = $(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
    var h_curr = $(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
    var t_curr = $(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
    var to_curr = $(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
    var v_curr = $(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')
    var air_currency = air_currency.attr("c_val")
    var h_curr = h_curr.attr("c_val")
    var t_curr = t_curr.attr("c_val")
    var to_curr = to_curr.attr("c_val")
    var v_curr = v_curr.attr("c_val")
    var total = parseInt(airfare_childwbed * air_currency) + parseInt(hotelfare_childwbed * h_curr) + parseInt(tourfare_childwbed * t_curr) + parseInt(transferfare_childwbed * to_curr) + parseInt(visafare_childwbed * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".childwithoutbed_total").val("").val(total)
});

$(document).on('keyup', '.hotelfare_childwbed', function () {
    var hotelfare_childwbed = $(this).val();
    var airfare_childwbed = $(this).parent().parent().parent().children("tr").children().children(".airfare_childwbed").val()
    var tourfare_childwbed = $(this).parent().parent().parent().children("tr").children().children(".tourfare_childwbed").val()
    var transferfare_childwbed = $(this).parent().parent().parent().children("tr").children().children(".transferfare_childwbed").val()
    var visafare_childwbed = $(this).parent().parent().parent().children("tr").children().children(".visafare_childwbed").val()
    var air_currency = $(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
    var h_curr = $(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
    var t_curr = $(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
    var to_curr = $(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
    var v_curr = $(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')
    var air_currency = air_currency.attr("c_val")
    var h_curr = h_curr.attr("c_val")
    var t_curr = t_curr.attr("c_val")
    var to_curr = to_curr.attr("c_val")
    var v_curr = v_curr.attr("c_val")
    var total = parseInt(airfare_childwbed * air_currency) + parseInt(hotelfare_childwbed * h_curr) + parseInt(tourfare_childwbed * t_curr) + parseInt(transferfare_childwbed * to_curr) + parseInt(visafare_childwbed * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".childwithoutbed_total").val("").val(total)
});

$(document).on('keyup', '.tourfare_childwbed', function () {
    var tourfare_childwbed = $(this).val();
    var hotelfare_childwbed = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_childwbed").val()
    var airfare_childwbed = $(this).parent().parent().parent().children("tr").children().children(".airfare_childwbed").val()
    var transferfare_childwbed = $(this).parent().parent().parent().children("tr").children().children(".transferfare_childwbed").val()
    var visafare_childwbed = $(this).parent().parent().parent().children("tr").children().children(".visafare_childwbed").val()
    var air_currency = $(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
    var h_curr = $(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
    var t_curr = $(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
    var to_curr = $(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
    var v_curr = $(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')
    var air_currency = air_currency.attr("c_val")
    var h_curr = h_curr.attr("c_val")
    var t_curr = t_curr.attr("c_val")
    var to_curr = to_curr.attr("c_val")
    var v_curr = v_curr.attr("c_val")
    var total = parseInt(airfare_childwbed * air_currency) + parseInt(hotelfare_childwbed * h_curr) + parseInt(tourfare_childwbed * t_curr) + parseInt(transferfare_childwbed * to_curr) + parseInt(visafare_childwbed * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".childwithoutbed_total").val("").val(total)
});

$(document).on('keyup', '.transferfare_childwbed', function () {
    var transferfare_childwbed = $(this).val();
    var hotelfare_childwbed = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_childwbed").val()
    var tourfare_childwbed = $(this).parent().parent().parent().children("tr").children().children(".tourfare_childwbed").val()
    var airfare_childwbed = $(this).parent().parent().parent().children("tr").children().children(".airfare_childwbed").val()
    var visafare_childwbed = $(this).parent().parent().parent().children("tr").children().children(".visafare_childwbed").val()
    var air_currency = $(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
    var h_curr = $(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
    var t_curr = $(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
    var to_curr = $(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
    var v_curr = $(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')
    var air_currency = air_currency.attr("c_val")
    var h_curr = h_curr.attr("c_val")
    var t_curr = t_curr.attr("c_val")
    var to_curr = to_curr.attr("c_val")
    var v_curr = v_curr.attr("c_val")
    var total = parseInt(airfare_childwbed * air_currency) + parseInt(hotelfare_childwbed * h_curr) + parseInt(tourfare_childwbed * t_curr) + parseInt(transferfare_childwbed * to_curr) + parseInt(visafare_childwbed * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".childwithoutbed_total").val("").val(total)
});

$(document).on('keyup', '.visafare_childwbed', function () {
    var visafare_childwbed = $(this).val();
    var hotelfare_childwbed = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_childwbed").val()
    var tourfare_childwbed = $(this).parent().parent().parent().children("tr").children().children(".tourfare_childwbed").val()
    var transferfare_childwbed = $(this).parent().parent().parent().children("tr").children().children(".transferfare_childwbed").val()
    var airfare_childwbed = $(this).parent().parent().parent().children("tr").children().children(".airfare_childwbed").val()
    var air_currency = $(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
    var h_curr = $(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
    var t_curr = $(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
    var to_curr = $(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
    var v_curr = $(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')
    var air_currency = air_currency.attr("c_val")
    var h_curr = h_curr.attr("c_val")
    var t_curr = t_curr.attr("c_val")
    var to_curr = to_curr.attr("c_val")
    var v_curr = v_curr.attr("c_val")
    var total = parseInt(airfare_childwbed * air_currency) + parseInt(hotelfare_childwbed * h_curr) + parseInt(tourfare_childwbed * t_curr) + parseInt(transferfare_childwbed * to_curr) + parseInt(visafare_childwbed * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".childwithoutbed_total").val("").val(total)
});

//child without bed end
$(document).on('keyup', '.airfare_infant', function () {
    var airfare_infant = $(this).val();
    var hotelfare_infant = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_infant").val()
    var tourfare_infant = $(this).parent().parent().parent().children("tr").children().children(".tourfare_infant").val()
    var transferfare_infant = $(this).parent().parent().parent().children("tr").children().children(".transferfare_infant").val()
    var visafare_infant = $(this).parent().parent().parent().children("tr").children().children(".visafare_infant").val()
    var air_currency = $(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
    var h_curr = $(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
    var t_curr = $(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
    var to_curr = $(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
    var v_curr = $(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')
    var air_currency = air_currency.attr("c_val")
    var h_curr = h_curr.attr("c_val")
    var t_curr = t_curr.attr("c_val")
    var to_curr = to_curr.attr("c_val")
    var v_curr = v_curr.attr("c_val")
    var total = parseInt(airfare_infant * air_currency) + parseInt(hotelfare_infant * h_curr) + parseInt(tourfare_infant * t_curr) + parseInt(transferfare_infant * to_curr) + parseInt(visafare_infant * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".infant_total").val("").val(total)
});

$(document).on('keyup', '.hotelfare_infant', function () {
    var hotelfare_infant = $(this).val();
    var airfare_infant = $(this).parent().parent().parent().children("tr").children().children(".airfare_infant").val()
    var tourfare_infant = $(this).parent().parent().parent().children("tr").children().children(".tourfare_infant").val()
    var transferfare_infant = $(this).parent().parent().parent().children("tr").children().children(".transferfare_infant").val()
    var visafare_infant = $(this).parent().parent().parent().children("tr").children().children(".visafare_infant").val()
    var air_currency = $(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
    var h_curr = $(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
    var t_curr = $(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
    var to_curr = $(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
    var v_curr = $(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')
    var air_currency = air_currency.attr("c_val")
    var h_curr = h_curr.attr("c_val")
    var t_curr = t_curr.attr("c_val")
    var to_curr = to_curr.attr("c_val")
    var v_curr = v_curr.attr("c_val")
    var total = parseInt(airfare_infant * air_currency) + parseInt(hotelfare_infant * h_curr) + parseInt(tourfare_infant * t_curr) + parseInt(transferfare_infant * to_curr) + parseInt(visafare_infant * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".infant_total").val("").val(total)
});

$(document).on('keyup', '.tourfare_infant', function () {
    var tourfare_infant = $(this).val();
    var hotelfare_infant = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_infant").val()
    var airfare_infant = $(this).parent().parent().parent().children("tr").children().children(".airfare_infant").val()
    var transferfare_infant = $(this).parent().parent().parent().children("tr").children().children(".transferfare_infant").val()
    var visafare_infant = $(this).parent().parent().parent().children("tr").children().children(".visafare_infant").val()
    var air_currency = $(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
    var h_curr = $(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
    var t_curr = $(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
    var to_curr = $(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
    var v_curr = $(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')
    var air_currency = air_currency.attr("c_val")
    var h_curr = h_curr.attr("c_val")
    var t_curr = t_curr.attr("c_val")
    var to_curr = to_curr.attr("c_val")
    var v_curr = v_curr.attr("c_val")
    var total = parseInt(airfare_infant * air_currency) + parseInt(hotelfare_infant * h_curr) + parseInt(tourfare_infant * t_curr) + parseInt(transferfare_infant * to_curr) + parseInt(visafare_infant * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".infant_total").val("").val(total)
});

$(document).on('keyup', '.transferfare_infant', function () {
    var transferfare_infant = $(this).val();
    var hotelfare_infant = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_infant").val()
    var tourfare_infant = $(this).parent().parent().parent().children("tr").children().children(".tourfare_infant").val()
    var airfare_infant = $(this).parent().parent().parent().children("tr").children().children(".airfare_infant").val()
    var visafare_infant = $(this).parent().parent().parent().children("tr").children().children(".visafare_infant").val()
    var air_currency = $(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
    var h_curr = $(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
    var t_curr = $(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
    var to_curr = $(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
    var v_curr = $(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')
    var air_currency = air_currency.attr("c_val")
    var h_curr = h_curr.attr("c_val")
    var t_curr = t_curr.attr("c_val")
    var to_curr = to_curr.attr("c_val")
    var v_curr = v_curr.attr("c_val")
    var total = parseInt(airfare_infant * air_currency) + parseInt(hotelfare_infant * h_curr) + parseInt(tourfare_infant * t_curr) + parseInt(transferfare_infant * to_curr) + parseInt(visafare_infant * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".infant_total").val("").val(total)
});

$(document).on('keyup', '.visafare_infant', function () {
    var visafare_infant = $(this).val();
    var hotelfare_infant = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_infant").val()
    var tourfare_infant = $(this).parent().parent().parent().children("tr").children().children(".tourfare_infant").val()
    var transferfare_infant = $(this).parent().parent().parent().children("tr").children().children(".transferfare_infant").val()
    var airfare_infant = $(this).parent().parent().parent().children("tr").children().children(".airfare_infant").val()
    var air_currency = $(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
    var h_curr = $(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
    var t_curr = $(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
    var to_curr = $(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
    var v_curr = $(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')
    var air_currency = air_currency.attr("c_val")
    var h_curr = h_curr.attr("c_val")
    var t_curr = t_curr.attr("c_val")
    var to_curr = to_curr.attr("c_val")
    var v_curr = v_curr.attr("c_val")
    var total = parseInt(airfare_infant * air_currency) + parseInt(hotelfare_infant * h_curr) + parseInt(tourfare_infant * t_curr) + parseInt(transferfare_infant * to_curr) + parseInt(visafare_infant * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".infant_total").val("").val(total)
});

//infant end

$(document).on('keyup', '.airfare_single', function () {
    var airfare_single = $(this).val();
    var hotelfare_single = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_single").val()
    var tourfare_single = $(this).parent().parent().parent().children("tr").children().children(".tourfare_single").val()
    var transferfare_single = $(this).parent().parent().parent().children("tr").children().children(".transferfare_single").val()
    var visafare_single = $(this).parent().parent().parent().children("tr").children().children(".visafare_single").val()
    var air_currency = $(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
    var h_curr = $(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
    var t_curr = $(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
    var to_curr = $(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
    var v_curr = $(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')
    var air_currency = air_currency.attr("c_val")
    var h_curr = h_curr.attr("c_val")
    var t_curr = t_curr.attr("c_val")
    var to_curr = to_curr.attr("c_val")
    var v_curr = v_curr.attr("c_val")
    var total = parseInt(airfare_single * air_currency) + parseInt(hotelfare_single * h_curr) + parseInt(tourfare_single * t_curr) + parseInt(transferfare_single * to_curr) + parseInt(visafare_single * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".single_total").val("").val(total)
});

$(document).on('keyup', '.hotelfare_single', function () {
    var hotelfare_single = $(this).val();
    var airfare_single = $(this).parent().parent().parent().children("tr").children().children(".airfare_single").val()
    var tourfare_single = $(this).parent().parent().parent().children("tr").children().children(".tourfare_single").val()
    var transferfare_single = $(this).parent().parent().parent().children("tr").children().children(".transferfare_single").val()
    var visafare_single = $(this).parent().parent().parent().children("tr").children().children(".visafare_single").val()
    var air_currency = $(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
    var h_curr = $(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
    var t_curr = $(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
    var to_curr = $(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
    var v_curr = $(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')
    var air_currency = air_currency.attr("c_val")
    var h_curr = h_curr.attr("c_val")
    var t_curr = t_curr.attr("c_val")
    var to_curr = to_curr.attr("c_val")
    var v_curr = v_curr.attr("c_val")
    var total = parseInt(airfare_single * air_currency) + parseInt(hotelfare_single * h_curr) + parseInt(tourfare_single * t_curr) + parseInt(transferfare_single * to_curr) + parseInt(visafare_single * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".single_total").val("").val(total)
});

$(document).on('keyup', '.tourfare_single', function () {
    var tourfare_single = $(this).val();
    var hotelfare_single = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_single").val()
    var airfare_single = $(this).parent().parent().parent().children("tr").children().children(".airfare_single").val()
    var transferfare_single = $(this).parent().parent().parent().children("tr").children().children(".transferfare_single").val()
    var visafare_single = $(this).parent().parent().parent().children("tr").children().children(".visafare_single").val()
    var air_currency = $(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
    var h_curr = $(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
    var t_curr = $(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
    var to_curr = $(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
    var v_curr = $(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')
    var air_currency = air_currency.attr("c_val")
    var h_curr = h_curr.attr("c_val")
    var t_curr = t_curr.attr("c_val")
    var to_curr = to_curr.attr("c_val")
    var v_curr = v_curr.attr("c_val")
    var total = parseInt(airfare_single * air_currency) + parseInt(hotelfare_single * h_curr) + parseInt(tourfare_single * t_curr) + parseInt(transferfare_single * to_curr) + parseInt(visafare_single * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".single_total").val("").val(total)
});

$(document).on('keyup', '.transferfare_single', function () {
    var transferfare_single = $(this).val();
    var hotelfare_single = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_single").val()
    var tourfare_single = $(this).parent().parent().parent().children("tr").children().children(".tourfare_single").val()
    var airfare_single = $(this).parent().parent().parent().children("tr").children().children(".airfare_single").val()
    var visafare_single = $(this).parent().parent().parent().children("tr").children().children(".visafare_single").val()
    var air_currency = $(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
    var h_curr = $(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
    var t_curr = $(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
    var to_curr = $(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
    var v_curr = $(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')
    var air_currency = air_currency.attr("c_val")
    var h_curr = h_curr.attr("c_val")
    var t_curr = t_curr.attr("c_val")
    var to_curr = to_curr.attr("c_val")
    var v_curr = v_curr.attr("c_val")
    var total = parseInt(airfare_single * air_currency) + parseInt(hotelfare_single * h_curr) + parseInt(tourfare_single * t_curr) + parseInt(transferfare_single * to_curr) + parseInt(visafare_single * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".single_total").val("").val(total)
});

$(document).on('keyup', '.visafare_single', function () {
    var visafare_single = $(this).val();
    var hotelfare_single = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_single").val()
    var tourfare_single = $(this).parent().parent().parent().children("tr").children().children(".tourfare_single").val()
    var transferfare_single = $(this).parent().parent().parent().children("tr").children().children(".transferfare_single").val()
    var airfare_single = $(this).parent().parent().parent().children("tr").children().children(".airfare_single").val()
    var air_currency = $(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
    var h_curr = $(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
    var t_curr = $(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
    var to_curr = $(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
    var v_curr = $(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')
    var air_currency = air_currency.attr("c_val")
    var h_curr = h_curr.attr("c_val")
    var t_curr = t_curr.attr("c_val")
    var to_curr = to_curr.attr("c_val")
    var v_curr = v_curr.attr("c_val")
    var total = parseInt(airfare_single * air_currency) + parseInt(hotelfare_single * h_curr) + parseInt(tourfare_single * t_curr) + parseInt(transferfare_single * to_curr) + parseInt(visafare_single * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".single_total").val("").val(total)
});

//
$(document).on('change', '.a_curr', function () {
    var a_curr = $(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
    var h_curr = $(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
    var t_curr = $(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
    var to_curr = $(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
    var v_curr = $(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')
    var a_curr = a_curr.attr("c_val")
    var h_curr = h_curr.attr("c_val")
    var t_curr = t_curr.attr("c_val")
    var to_curr = to_curr.attr("c_val")
    var v_curr = v_curr.attr("c_val")
    var airfare_adult = $(this).parent().parent().parent().children("tr").children().children(".airfare_adult").val()
    var hotelfare_adult = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_adult").val()
    var tourfare_adult = $(this).parent().parent().parent().children("tr").children().children(".tourfare_adult").val()
    var transferfare_adult = $(this).parent().parent().parent().children("tr").children().children(".transferfare_adult").val()
    var visafare_adult = $(this).parent().parent().parent().children("tr").children().children(".visafare_adult").val()
    var total1 = parseInt(airfare_adult * a_curr) + parseInt(hotelfare_adult * h_curr) + parseInt(tourfare_adult * t_curr) + parseInt(transferfare_adult * to_curr) + parseInt(visafare_adult * v_curr);
    $(this).parent().parent().parent().children("tr").children().children(".adult_total").val("").val(total1)
    var airfare_exadult = $(this).parent().parent().parent().children("tr").children().children(".airfare_exadult").val()
    var hotelfare_exadult = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_exadult").val()
    var tourfare_exadult = $(this).parent().parent().parent().children("tr").children().children(".tourfare_exadult").val()
    var transferfare_exadult = $(this).parent().parent().parent().children("tr").children().children(".transferfare_exadult").val()
    var visafare_exadult = $(this).parent().parent().parent().children("tr").children().children(".visafare_exadult").val()
    var total2 = parseInt(airfare_exadult * a_curr) + parseInt(hotelfare_exadult * h_curr) + parseInt(tourfare_exadult * t_curr) + parseInt(transferfare_exadult * to_curr) + parseInt(visafare_exadult * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".extraadult_total").val("").val(total2)
    var airfare_childbed = $(this).parent().parent().parent().children("tr").children().children(".airfare_childbed").val()
    var hotelfare_childbed = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_childbed").val()
    var tourfare_childbed = $(this).parent().parent().parent().children("tr").children().children(".tourfare_childbed").val()
    var transferfare_childbed = $(this).parent().parent().parent().children("tr").children().children(".transferfare_childbed").val()
    var visafare_childbed = $(this).parent().parent().parent().children("tr").children().children(".visafare_childbed").val()
    var total3 = parseInt(airfare_childbed * a_curr) + parseInt(hotelfare_childbed * h_curr) + parseInt(tourfare_childbed * t_curr) + parseInt(transferfare_childbed * to_curr) + parseInt(visafare_childbed * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".childwithbed_total").val("").val(total3)
    var airfare_childwbed = $(this).parent().parent().parent().children("tr").children().children(".airfare_childwbed").val()
    var hotelfare_childwbed = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_childwbed").val()
    var tourfare_childwbed = $(this).parent().parent().parent().children("tr").children().children(".tourfare_childwbed").val()
    var transferfare_childwbed = $(this).parent().parent().parent().children("tr").children().children(".transferfare_childwbed").val()
    var visafare_childwbed = $(this).parent().parent().parent().children("tr").children().children(".visafare_childwbed").val()
    var total4 = parseInt(airfare_childwbed * a_curr) + parseInt(hotelfare_childwbed * h_curr) + parseInt(tourfare_childwbed * t_curr) + parseInt(transferfare_childwbed * to_curr) + parseInt(visafare_childwbed * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".childwithoutbed_total").val("").val(total4)
    var airfare_infant = $(this).parent().parent().parent().children("tr").children().children(".airfare_infant").val()
    var hotelfare_infant = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_infant").val()
    var tourfare_infant = $(this).parent().parent().parent().children("tr").children().children(".tourfare_infant").val()
    var transferfare_infant = $(this).parent().parent().parent().children("tr").children().children(".transferfare_infant").val()
    var visafare_infant = $(this).parent().parent().parent().children("tr").children().children(".visafare_infant").val()
    var total5 = parseInt(airfare_infant * a_curr) + parseInt(hotelfare_infant * a_curr) + parseInt(tourfare_infant * t_curr) + parseInt(transferfare_infant * to_curr) + parseInt(visafare_infant * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".infant_total").val("").val(total5)
    var airfare_single = $(this).parent().parent().parent().children("tr").children().children(".airfare_single").val()
    var hotelfare_single = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_single").val()
    var tourfare_single = $(this).parent().parent().parent().children("tr").children().children(".tourfare_single").val()
    var transferfare_single = $(this).parent().parent().parent().children("tr").children().children(".transferfare_single").val()
    var visafare_single = $(this).parent().parent().parent().children("tr").children().children(".visafare_single").val()
    var total6 = parseInt(airfare_single * a_curr) + parseInt(hotelfare_single * h_curr) + parseInt(tourfare_single * t_curr) + parseInt(transferfare_single * to_curr) + parseInt(visafare_single * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".single_total").val("").val(total6)
});

//air currency end
$(document).on('change', '.h_curr', function () {
    var a_curr = $(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
    var h_curr = $(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
    var t_curr = $(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
    var to_curr = $(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
    var v_curr = $(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')
    var a_curr = a_curr.attr("c_val")
    var h_curr = h_curr.attr("c_val")
    var t_curr = t_curr.attr("c_val")
    var to_curr = to_curr.attr("c_val")
    var v_curr = v_curr.attr("c_val")
    var airfare_adult = $(this).parent().parent().parent().children("tr").children().children(".airfare_adult").val()
    var hotelfare_adult = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_adult").val()
    var tourfare_adult = $(this).parent().parent().parent().children("tr").children().children(".tourfare_adult").val()
    var transferfare_adult = $(this).parent().parent().parent().children("tr").children().children(".transferfare_adult").val()
    var visafare_adult = $(this).parent().parent().parent().children("tr").children().children(".visafare_adult").val()
    var total1 = parseInt(airfare_adult * a_curr) + parseInt(hotelfare_adult * h_curr) + parseInt(tourfare_adult * t_curr) + parseInt(transferfare_adult * to_curr) + parseInt(visafare_adult * v_curr);
    $(this).parent().parent().parent().children("tr").children().children(".adult_total").val("").val(total1)
    var airfare_exadult = $(this).parent().parent().parent().children("tr").children().children(".airfare_exadult").val()
    var hotelfare_exadult = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_exadult").val()
    var tourfare_exadult = $(this).parent().parent().parent().children("tr").children().children(".tourfare_exadult").val()
    var transferfare_exadult = $(this).parent().parent().parent().children("tr").children().children(".transferfare_exadult").val()
    var visafare_exadult = $(this).parent().parent().parent().children("tr").children().children(".visafare_exadult").val()
    var total2 = parseInt(airfare_exadult * a_curr) + parseInt(hotelfare_exadult * h_curr) + parseInt(tourfare_exadult * t_curr) + parseInt(transferfare_exadult * to_curr) + parseInt(visafare_exadult * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".extraadult_total").val("").val(total2)
    var airfare_childbed = $(this).parent().parent().parent().children("tr").children().children(".airfare_childbed").val()
    var hotelfare_childbed = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_childbed").val()
    var tourfare_childbed = $(this).parent().parent().parent().children("tr").children().children(".tourfare_childbed").val()
    var transferfare_childbed = $(this).parent().parent().parent().children("tr").children().children(".transferfare_childbed").val()
    var visafare_childbed = $(this).parent().parent().parent().children("tr").children().children(".visafare_childbed").val()
    var total3 = parseInt(airfare_childbed * a_curr) + parseInt(hotelfare_childbed * h_curr) + parseInt(tourfare_childbed * t_curr) + parseInt(transferfare_childbed * to_curr) + parseInt(visafare_childbed * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".childwithbed_total").val("").val(total3)
    var airfare_childwbed = $(this).parent().parent().parent().children("tr").children().children(".airfare_childwbed").val()
    var hotelfare_childwbed = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_childwbed").val()
    var tourfare_childwbed = $(this).parent().parent().parent().children("tr").children().children(".tourfare_childwbed").val()
    var transferfare_childwbed = $(this).parent().parent().parent().children("tr").children().children(".transferfare_childwbed").val()
    var visafare_childwbed = $(this).parent().parent().parent().children("tr").children().children(".visafare_childwbed").val()
    var total4 = parseInt(airfare_childwbed * a_curr) + parseInt(hotelfare_childwbed * h_curr) + parseInt(tourfare_childwbed * t_curr) + parseInt(transferfare_childwbed * to_curr) + parseInt(visafare_childwbed * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".childwithoutbed_total").val("").val(total4)
    var airfare_infant = $(this).parent().parent().parent().children("tr").children().children(".airfare_infant").val()
    var hotelfare_infant = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_infant").val()
    var tourfare_infant = $(this).parent().parent().parent().children("tr").children().children(".tourfare_infant").val()
    var transferfare_infant = $(this).parent().parent().parent().children("tr").children().children(".transferfare_infant").val()
    var visafare_infant = $(this).parent().parent().parent().children("tr").children().children(".visafare_infant").val()
    var total5 = parseInt(airfare_infant * a_curr) + parseInt(hotelfare_infant * a_curr) + parseInt(tourfare_infant * t_curr) + parseInt(transferfare_infant * to_curr) + parseInt(visafare_infant * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".infant_total").val("").val(total5)
    var airfare_single = $(this).parent().parent().parent().children("tr").children().children(".airfare_single").val()
    var hotelfare_single = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_single").val()
    var tourfare_single = $(this).parent().parent().parent().children("tr").children().children(".tourfare_single").val()
    var transferfare_single = $(this).parent().parent().parent().children("tr").children().children(".transferfare_single").val()
    var visafare_single = $(this).parent().parent().parent().children("tr").children().children(".visafare_single").val()
    var total6 = parseInt(airfare_single * a_curr) + parseInt(hotelfare_single * h_curr) + parseInt(tourfare_single * t_curr) + parseInt(transferfare_single * to_curr) + parseInt(visafare_single * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".single_total").val("").val(total6)
});

//hotel currency end
$(document).on('change', '.t_curr', function () {
    var a_curr = $(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
    var h_curr = $(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
    var t_curr = $(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
    var to_curr = $(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
    var v_curr = $(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')
    var a_curr = a_curr.attr("c_val")
    var h_curr = h_curr.attr("c_val")
    var t_curr = t_curr.attr("c_val")
    var to_curr = to_curr.attr("c_val")
    var v_curr = v_curr.attr("c_val")
    var airfare_adult = $(this).parent().parent().parent().children("tr").children().children(".airfare_adult").val()
    var hotelfare_adult = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_adult").val()
    var tourfare_adult = $(this).parent().parent().parent().children("tr").children().children(".tourfare_adult").val()
    var transferfare_adult = $(this).parent().parent().parent().children("tr").children().children(".transferfare_adult").val()
    var visafare_adult = $(this).parent().parent().parent().children("tr").children().children(".visafare_adult").val()
    var total1 = parseInt(airfare_adult * a_curr) + parseInt(hotelfare_adult * h_curr) + parseInt(tourfare_adult * t_curr) + parseInt(transferfare_adult * to_curr) + parseInt(visafare_adult * v_curr);
    $(this).parent().parent().parent().children("tr").children().children(".adult_total").val("").val(total1)
    var airfare_exadult = $(this).parent().parent().parent().children("tr").children().children(".airfare_exadult").val()
    var hotelfare_exadult = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_exadult").val()
    var tourfare_exadult = $(this).parent().parent().parent().children("tr").children().children(".tourfare_exadult").val()
    var transferfare_exadult = $(this).parent().parent().parent().children("tr").children().children(".transferfare_exadult").val()
    var visafare_exadult = $(this).parent().parent().parent().children("tr").children().children(".visafare_exadult").val()
    var total2 = parseInt(airfare_exadult * a_curr) + parseInt(hotelfare_exadult * h_curr) + parseInt(tourfare_exadult * t_curr) + parseInt(transferfare_exadult * to_curr) + parseInt(visafare_exadult * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".extraadult_total").val("").val(total2)
    var airfare_childbed = $(this).parent().parent().parent().children("tr").children().children(".airfare_childbed").val()
    var hotelfare_childbed = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_childbed").val()
    var tourfare_childbed = $(this).parent().parent().parent().children("tr").children().children(".tourfare_childbed").val()
    var transferfare_childbed = $(this).parent().parent().parent().children("tr").children().children(".transferfare_childbed").val()
    var visafare_childbed = $(this).parent().parent().parent().children("tr").children().children(".visafare_childbed").val()
    var total3 = parseInt(airfare_childbed * a_curr) + parseInt(hotelfare_childbed * h_curr) + parseInt(tourfare_childbed * t_curr) + parseInt(transferfare_childbed * to_curr) + parseInt(visafare_childbed * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".childwithbed_total").val("").val(total3)
    var airfare_childwbed = $(this).parent().parent().parent().children("tr").children().children(".airfare_childwbed").val()
    var hotelfare_childwbed = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_childwbed").val()
    var tourfare_childwbed = $(this).parent().parent().parent().children("tr").children().children(".tourfare_childwbed").val()
    var transferfare_childwbed = $(this).parent().parent().parent().children("tr").children().children(".transferfare_childwbed").val()
    var visafare_childwbed = $(this).parent().parent().parent().children("tr").children().children(".visafare_childwbed").val()
    var total4 = parseInt(airfare_childwbed * a_curr) + parseInt(hotelfare_childwbed * h_curr) + parseInt(tourfare_childwbed * t_curr) + parseInt(transferfare_childwbed * to_curr) + parseInt(visafare_childwbed * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".childwithoutbed_total").val("").val(total4)
    var airfare_infant = $(this).parent().parent().parent().children("tr").children().children(".airfare_infant").val()
    var hotelfare_infant = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_infant").val()
    var tourfare_infant = $(this).parent().parent().parent().children("tr").children().children(".tourfare_infant").val()
    var transferfare_infant = $(this).parent().parent().parent().children("tr").children().children(".transferfare_infant").val()
    var visafare_infant = $(this).parent().parent().parent().children("tr").children().children(".visafare_infant").val()
    var total5 = parseInt(airfare_infant * a_curr) + parseInt(hotelfare_infant * a_curr) + parseInt(tourfare_infant * t_curr) + parseInt(transferfare_infant * to_curr) + parseInt(visafare_infant * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".infant_total").val("").val(total5)
    var airfare_single = $(this).parent().parent().parent().children("tr").children().children(".airfare_single").val()
    var hotelfare_single = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_single").val()
    var tourfare_single = $(this).parent().parent().parent().children("tr").children().children(".tourfare_single").val()
    var transferfare_single = $(this).parent().parent().parent().children("tr").children().children(".transferfare_single").val()
    var visafare_single = $(this).parent().parent().parent().children("tr").children().children(".visafare_single").val()
    var total6 = parseInt(airfare_single * a_curr) + parseInt(hotelfare_single * h_curr) + parseInt(tourfare_single * t_curr) + parseInt(transferfare_single * to_curr) + parseInt(visafare_single * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".single_total").val("").val(total6)
});

//tour currency end
$(document).on('change', '.to_curr', function () {
    var a_curr = $(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
    var h_curr = $(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
    var t_curr = $(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
    var to_curr = $(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
    var v_curr = $(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')
    var a_curr = a_curr.attr("c_val")
    var h_curr = h_curr.attr("c_val")
    var t_curr = t_curr.attr("c_val")
    var to_curr = to_curr.attr("c_val")
    var v_curr = v_curr.attr("c_val")
    var airfare_adult = $(this).parent().parent().parent().children("tr").children().children(".airfare_adult").val()
    var hotelfare_adult = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_adult").val()
    var tourfare_adult = $(this).parent().parent().parent().children("tr").children().children(".tourfare_adult").val()
    var transferfare_adult = $(this).parent().parent().parent().children("tr").children().children(".transferfare_adult").val()
    var visafare_adult = $(this).parent().parent().parent().children("tr").children().children(".visafare_adult").val()
    var total1 = parseInt(airfare_adult * a_curr) + parseInt(hotelfare_adult * h_curr) + parseInt(tourfare_adult * t_curr) + parseInt(transferfare_adult * to_curr) + parseInt(visafare_adult * v_curr);
    $(this).parent().parent().parent().children("tr").children().children(".adult_total").val("").val(total1)
    var airfare_exadult = $(this).parent().parent().parent().children("tr").children().children(".airfare_exadult").val()
    var hotelfare_exadult = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_exadult").val()
    var tourfare_exadult = $(this).parent().parent().parent().children("tr").children().children(".tourfare_exadult").val()
    var transferfare_exadult = $(this).parent().parent().parent().children("tr").children().children(".transferfare_exadult").val()
    var visafare_exadult = $(this).parent().parent().parent().children("tr").children().children(".visafare_exadult").val()
    var total2 = parseInt(airfare_exadult * a_curr) + parseInt(hotelfare_exadult * h_curr) + parseInt(tourfare_exadult * t_curr) + parseInt(transferfare_exadult * to_curr) + parseInt(visafare_exadult * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".extraadult_total").val("").val(total2)
    var airfare_childbed = $(this).parent().parent().parent().children("tr").children().children(".airfare_childbed").val()
    var hotelfare_childbed = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_childbed").val()
    var tourfare_childbed = $(this).parent().parent().parent().children("tr").children().children(".tourfare_childbed").val()
    var transferfare_childbed = $(this).parent().parent().parent().children("tr").children().children(".transferfare_childbed").val()
    var visafare_childbed = $(this).parent().parent().parent().children("tr").children().children(".visafare_childbed").val()
    var total3 = parseInt(airfare_childbed * a_curr) + parseInt(hotelfare_childbed * h_curr) + parseInt(tourfare_childbed * t_curr) + parseInt(transferfare_childbed * to_curr) + parseInt(visafare_childbed * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".childwithbed_total").val("").val(total3)
    var airfare_childwbed = $(this).parent().parent().parent().children("tr").children().children(".airfare_childwbed").val()
    var hotelfare_childwbed = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_childwbed").val()
    var tourfare_childwbed = $(this).parent().parent().parent().children("tr").children().children(".tourfare_childwbed").val()
    var transferfare_childwbed = $(this).parent().parent().parent().children("tr").children().children(".transferfare_childwbed").val()
    var visafare_childwbed = $(this).parent().parent().parent().children("tr").children().children(".visafare_childwbed").val()
    var total4 = parseInt(airfare_childwbed * a_curr) + parseInt(hotelfare_childwbed * h_curr) + parseInt(tourfare_childwbed * t_curr) + parseInt(transferfare_childwbed * to_curr) + parseInt(visafare_childwbed * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".childwithoutbed_total").val("").val(total4)
    var airfare_infant = $(this).parent().parent().parent().children("tr").children().children(".airfare_infant").val()
    var hotelfare_infant = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_infant").val()
    var tourfare_infant = $(this).parent().parent().parent().children("tr").children().children(".tourfare_infant").val()
    var transferfare_infant = $(this).parent().parent().parent().children("tr").children().children(".transferfare_infant").val()
    var visafare_infant = $(this).parent().parent().parent().children("tr").children().children(".visafare_infant").val()
    var total5 = parseInt(airfare_infant * a_curr) + parseInt(hotelfare_infant * a_curr) + parseInt(tourfare_infant * t_curr) + parseInt(transferfare_infant * to_curr) + parseInt(visafare_infant * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".infant_total").val("").val(total5)
    var airfare_single = $(this).parent().parent().parent().children("tr").children().children(".airfare_single").val()
    var hotelfare_single = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_single").val()
    var tourfare_single = $(this).parent().parent().parent().children("tr").children().children(".tourfare_single").val()
    var transferfare_single = $(this).parent().parent().parent().children("tr").children().children(".transferfare_single").val()
    var visafare_single = $(this).parent().parent().parent().children("tr").children().children(".visafare_single").val()
    var total6 = parseInt(airfare_single * a_curr) + parseInt(hotelfare_single * h_curr) + parseInt(tourfare_single * t_curr) + parseInt(transferfare_single * to_curr) + parseInt(visafare_single * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".single_total").val("").val(total6)
});

//transfer currency end
$(document).on('change', '.v_curr', function () {
    var a_curr = $(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
    var h_curr = $(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
    var t_curr = $(this).parent().parent().parent().children("tr").children().children(".t_curr").val()
    var to_curr = $(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
    var v_curr = $(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')
    var a_curr = a_curr.attr("c_val")
    var h_curr = h_curr.attr("c_val")
    var t_curr = t_curr.attr("c_val")
    var to_curr = to_curr.attr("c_val")
    var v_curr = v_curr.attr("c_val")
    var airfare_adult = $(this).parent().parent().parent().children("tr").children().children(".airfare_adult").val()
    var hotelfare_adult = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_adult").val()
    var tourfare_adult = $(this).parent().parent().parent().children("tr").children().children(".tourfare_adult").val()
    var transferfare_adult = $(this).parent().parent().parent().children("tr").children().children(".transferfare_adult").val()
    var visafare_adult = $(this).parent().parent().parent().children("tr").children().children(".visafare_adult").val()
    var total1 = parseInt(airfare_adult * a_curr) + parseInt(hotelfare_adult * h_curr) + parseInt(tourfare_adult * t_curr) + parseInt(transferfare_adult * to_curr) + parseInt(visafare_adult * v_curr);
    $(this).parent().parent().parent().children("tr").children().children(".adult_total").val("").val(total1)
    var airfare_exadult = $(this).parent().parent().parent().children("tr").children().children(".airfare_exadult").val()
    var hotelfare_exadult = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_exadult").val()
    var tourfare_exadult = $(this).parent().parent().parent().children("tr").children().children(".tourfare_exadult").val()
    var transferfare_exadult = $(this).parent().parent().parent().children("tr").children().children(".transferfare_exadult").val()
    var visafare_exadult = $(this).parent().parent().parent().children("tr").children().children(".visafare_exadult").val()
    var total2 = parseInt(airfare_exadult * a_curr) + parseInt(hotelfare_exadult * h_curr) + parseInt(tourfare_exadult * t_curr) + parseInt(transferfare_exadult * to_curr) + parseInt(visafare_exadult * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".extraadult_total").val("").val(total2)
    var airfare_childbed = $(this).parent().parent().parent().children("tr").children().children(".airfare_childbed").val()
    var hotelfare_childbed = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_childbed").val()
    var tourfare_childbed = $(this).parent().parent().parent().children("tr").children().children(".tourfare_childbed").val()
    var transferfare_childbed = $(this).parent().parent().parent().children("tr").children().children(".transferfare_childbed").val()
    var visafare_childbed = $(this).parent().parent().parent().children("tr").children().children(".visafare_childbed").val()
    var total3 = parseInt(airfare_childbed * a_curr) + parseInt(hotelfare_childbed * h_curr) + parseInt(tourfare_childbed * t_curr) + parseInt(transferfare_childbed * to_curr) + parseInt(visafare_childbed * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".childwithbed_total").val("").val(total3)
    var airfare_childwbed = $(this).parent().parent().parent().children("tr").children().children(".airfare_childwbed").val()
    var hotelfare_childwbed = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_childwbed").val()
    var tourfare_childwbed = $(this).parent().parent().parent().children("tr").children().children(".tourfare_childwbed").val()
    var transferfare_childwbed = $(this).parent().parent().parent().children("tr").children().children(".transferfare_childwbed").val()
    var visafare_childwbed = $(this).parent().parent().parent().children("tr").children().children(".visafare_childwbed").val()
    var total4 = parseInt(airfare_childwbed * a_curr) + parseInt(hotelfare_childwbed * h_curr) + parseInt(tourfare_childwbed * t_curr) + parseInt(transferfare_childwbed * to_curr) + parseInt(visafare_childwbed * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".childwithoutbed_total").val("").val(total4)
    var airfare_infant = $(this).parent().parent().parent().children("tr").children().children(".airfare_infant").val()
    var hotelfare_infant = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_infant").val()
    var tourfare_infant = $(this).parent().parent().parent().children("tr").children().children(".tourfare_infant").val()
    var transferfare_infant = $(this).parent().parent().parent().children("tr").children().children(".transferfare_infant").val()
    var visafare_infant = $(this).parent().parent().parent().children("tr").children().children(".visafare_infant").val()
    var total5 = parseInt(airfare_infant * a_curr) + parseInt(hotelfare_infant * a_curr) + parseInt(tourfare_infant * t_curr) + parseInt(transferfare_infant * to_curr) + parseInt(visafare_infant * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".infant_total").val("").val(total5)
    var airfare_single = $(this).parent().parent().parent().children("tr").children().children(".airfare_single").val()
    var hotelfare_single = $(this).parent().parent().parent().children("tr").children().children(".hotelfare_single").val()
    var tourfare_single = $(this).parent().parent().parent().children("tr").children().children(".tourfare_single").val()
    var transferfare_single = $(this).parent().parent().parent().children("tr").children().children(".transferfare_single").val()
    var visafare_single = $(this).parent().parent().parent().children("tr").children().children(".visafare_single").val()
    var total6 = parseInt(airfare_single * a_curr) + parseInt(hotelfare_single * h_curr) + parseInt(tourfare_single * t_curr) + parseInt(transferfare_single * to_curr) + parseInt(visafare_single * v_curr)
    $(this).parent().parent().parent().children("tr").children().children(".single_total").val("").val(total6)
});
//

$("#submit_price").click(function () {
    var class_value = $(this).parent().siblings(".modal-body").children(".price_class").val()
    var airfare_adult = $('#' + class_value + '  .airfare_adult').val();
    var airfare_exadult = $('#' + class_value + '  .airfare_exadult').val();
    var airfare_childbed = $('#' + class_value + '  .airfare_childbed').val();
    var airfare_childwbed = $('#' + class_value + '  .airfare_childwbed').val();
    var airfare_infant = $('#' + class_value + '  .airfare_infant').val();
    var airfare_single = $('#' + class_value + '  .airfare_single').val();
    var aircurrency = $('#' + class_value + '  .a_curr').val();
    var aircurrency_value = $('#' + class_value + '  .a_curr').find('option:selected');
    var aircurrency_value = aircurrency_value.attr('c_val');
    //
    var hotelcurrency = $('#' + class_value + '  .h_curr').val();
    var hotelfare_adult = $('#' + class_value + '  .hotelfare_adult').val();
    var hotelfare_exadult = $('#' + class_value + '  .hotelfare_exadult').val();
    var hotelfare_childbed = $('#' + class_value + '  .hotelfare_childbed').val();
    var hotelfare_childwbed = $('#' + class_value + '  .hotelfare_childwbed').val();
    var hotelfare_infant = $('#' + class_value + '  .hotelfare_infant').val();
    var hotelfare_single = $('#' + class_value + '  .hotelfare_single').val();
    var hotel_value = $('#' + class_value + '  .h_curr').find('option:selected');
    var hotel_value = hotel_value.attr('c_val');
    //
    var tourcurrency = $('#' + class_value + '  .t_curr').val();
    var tourfare_adult = $('#' + class_value + '  .tourfare_adult').val();
    var tourfare_exadult = $('#' + class_value + '  .tourfare_exadult').val();
    var tourfare_childbed = $('#' + class_value + '  .tourfare_childbed').val();
    var tourfare_childwbed = $('#' + class_value + '  .tourfare_childwbed').val();
    var tourfare_infant = $('#' + class_value + '  .tourfare_infant').val();
    var tourfare_single = $('#' + class_value + '  .tourfare_single').val();
    var tourcurrency_value = $('#' + class_value + '  .t_curr').find('option:selected');
    var tourcurrency_value = tourcurrency_value.attr('c_val');
    //
    var transfercurrency = $('#' + class_value + '  .to_curr').val();
    var transferfare_adult = $('#' + class_value + '  .transferfare_adult').val();
    var transferfare_exadult = $('#' + class_value + '  .transferfare_exadult').val();
    var transferfare_childbed = $('#' + class_value + '  .transferfare_childbed').val();
    var transferfare_childwbed = $('#' + class_value + '  .transferfare_childwbed').val();
    var transferfare_infant = $('#' + class_value + '  .transferfare_infant').val();
    var transferfare_single = $('#' + class_value + '  .transferfare_single').val();
    var transfercurrency_value = $('#' + class_value + '  .to_curr').find('option:selected');
    var transfercurrency_value = transfercurrency_value.attr('c_val');
    //
    var visacurrency = $('#' + class_value + '  .v_curr').val();
    var visafare_adult = $('#' + class_value + '  .visafare_adult').val();
    var visafare_exadult = $('#' + class_value + '  .visafare_exadult').val();
    var visafare_childbed = $('#' + class_value + '  .visafare_childbed').val();
    var visafare_childwbed = $('#' + class_value + '  .visafare_childwbed').val();
    var visafare_infant = $('#' + class_value + '  .visafare_infant').val();
    var visafare_single = $('#' + class_value + '  .visafare_single').val();
    var visacurrency_value = $('#' + class_value + '  .v_curr').find('option:selected');
    var visacurrency_value = visacurrency_value.attr('c_val');
    //
    var adult_total = $('#' + class_value + '  .adult_total').val();
    var extraadult_total = $('#' + class_value + '  .extraadult_total').val();
    var childwithbed_total = $('#' + class_value + '  .childwithbed_total').val();
    var childwithoutbed_total = $('#' + class_value + '  .childwithoutbed_total').val();
    var infant_total = $('#' + class_value + '  .infant_total').val();
    var single_total = $('#' + class_value + '  .single_total').val();
    $('#' + class_value).children(".air_fare_adult").val("").val(airfare_adult)
    $('#' + class_value).children(".air_fare_exadult").val("").val(airfare_exadult)
    $('#' + class_value).children(".air_fare_childbed").val("").val(airfare_childbed)
    $('#' + class_value).children(".air_fare_childwbed").val("").val(airfare_childwbed)
    $('#' + class_value).children(".air_fare_infant").val("").val(airfare_infant)
    $('#' + class_value).children(".air_fare_single").val("").val(airfare_single)
    $('#' + class_value).children(".air_currency").val("").val(aircurrency)
    //
    $('#' + class_value).children(".hotel_currency").val("").val(hotelcurrency)
    $('#' + class_value).children(".hotel_fare_adult").val("").val(hotelfare_adult)
    $('#' + class_value).children(".hotel_fare_exadult").val("").val(hotelfare_exadult)
    $('#' + class_value).children(".hotel_fare_childbed").val("").val(hotelfare_childbed)
    $('#' + class_value).children(".hotel_fare_childwbed").val("").val(hotelfare_childwbed)
    $('#' + class_value).children(".hotel_fare_infant").val("").val(hotelfare_infant)
    $('#' + class_value).children(".hotel_fare_single").val("").val(hotelfare_single)
    //
    $('#' + class_value).children(".tour_currency").val("").val(tourcurrency)
    $('#' + class_value).children(".tour_fare_adult").val("").val(tourfare_adult)
    $('#' + class_value).children(".tour_fare_exadult").val("").val(tourfare_exadult)
    $('#' + class_value).children(".tour_fare_childbed").val("").val(tourfare_childbed)
    $('#' + class_value).children(".tour_fare_childwbed").val("").val(tourfare_childwbed)
    $('#' + class_value).children(".tour_fare_infant").val("").val(tourfare_infant)
    $('#' + class_value).children(".tour_fare_single").val("").val(tourfare_single)
    //
    $('#' + class_value).children(".transfer_currency").val("").val(transfercurrency)
    $('#' + class_value).children(".transfer_fare_adult").val("").val(transferfare_adult)
    $('#' + class_value).children(".transfer_fare_exadult").val("").val(transferfare_exadult)
    $('#' + class_value).children(".transfer_fare_childbed").val("").val(transferfare_childbed)
    $('#' + class_value).children(".transfer_fare_childwbed").val("").val(transferfare_childwbed)
    $('#' + class_value).children(".transfer_fare_infant").val("").val(transferfare_infant)
    $('#' + class_value).children(".transfer_fare_single").val("").val(transferfare_single)
    //
    $('#' + class_value).children(".visa_currency").val("").val(visacurrency)
    $('#' + class_value).children(".visa_fare_adult").val("").val(visafare_adult)
    $('#' + class_value).children(".visa_fare_exadult").val("").val(visafare_exadult)
    $('#' + class_value).children(".visa_fare_childbed").val("").val(visafare_childbed)
    $('#' + class_value).children(".visa_fare_childwbed").val("").val(visafare_childwbed)
    $('#' + class_value).children(".visa_fare_infant").val("").val(visafare_infant)
    $('#' + class_value).children(".visa_fare_single").val("").val(visafare_single)
    //
    $('#' + class_value).children(".adult_fare_total").val("").val(adult_total)
    $('#' + class_value).children(".exadult_fare_total").val("").val(extraadult_total)
    $('#' + class_value).children(".childwithbed_fare_total").val("").val(childwithbed_total)
    $('#' + class_value).children(".childwithoutbed_fare_total").val("").val(childwithoutbed_total)
    $('#' + class_value).children(".infant_fare_total").val("").val(infant_total)
    $('#' + class_value).children(".single_fare_total").val("").val(single_total)
});

/*$('[data-dismiss=modal]').on('click', function (e) {
   var $t = $(this),
       target = $t[0].href || $t.data("target") || $t.parents('.modal') || [];
 $(target)
   .find("input,textarea,select")
      .val('')
      .end()
   .find("input[type=checkbox], input[type=radio]")
      .prop("checked", "")
      .end();
})*/


        
//***************************

// Handle select all duration or deselect all duration functionality (for tour package)
function toggleSelectCompleteDurationButton() {
    var totalDays = $(".select_day option").length;
    var totalSelectedDays = 0;

    // Count selected options
    $(".select_day").each(function () {
        totalSelectedDays += $(this).find("option:selected").length;
    });

    // Show/hide the "Add More Hotel" button
    if (totalSelectedDays > 0 && totalSelectedDays < totalDays) {
        $("#add_acco").prop("disabled", false).removeClass("d-none");
    } else {
        $("#add_acco").prop("disabled", true).addClass("d-none");
    }

    // Update "Select All" checkbox state
    $(".appendBottom10").each(function () {
        var selectElement = $(this).find(".select_day");
        var allSelected = selectElement.find("option").length === selectElement.find("option:selected").length;
        $(this).find(".select_complete_duration").prop("checked", allSelected);
    });
}

// Handle "Select All" functionality
$(document).on("click", ".select_complete_duration", function () {
    var selectElement = $(this).closest(".appendBottom10").find(".select_day");

    if ($(this).is(":checked")) {
        // Select all options
        selectElement.find("option").prop("selected", true);
    } else {
        // Deselect all options
        selectElement.find("option").prop("selected", false);
    }

    selectElement.trigger("change"); // Update select2 UI
    toggleSelectCompleteDurationButton();
});

// Handle manual selection changes
$(document).on("change", ".select_day", function () {
    var totalDays = $(this).find("option").length;
    var selectedDays = $(this).find("option:selected").length;

    // Update "Select All" checkbox state
    $(this).closest(".appendBottom10").find(".select_complete_duration").prop("checked", selectedDays === totalDays);

    toggleSelectCompleteDurationButton();
});

// Initialize the state on page load
$(document).ready(function () {
    toggleSelectCompleteDurationButton();
    $(".select_complete_duration").prop("checked", false);
});

//***************************

$(document).ready(function () {

    activity_and_sightseeing();

    $('.rating-field').each(function() {
        if($(this).val() == 'other'){
            $(this).parent().find('.other-rating').css('display', 'inline-block');
        } else {
            $(this).parent().find('.other-rating').css('display', 'none');
        }
    });

    var i = 1;
    var rowCount = $('.packagePricing tr').length;
    if (rowCount > 2) {
        i = rowCount - 1;
    } else {
        i = 1;
    }

    $('#add-price-row').click(function () {
        //var name_count=$("#dynamic_field .form-control:last").attr("name").slice(6,7)
        var name_count1 = $("#dynamic_field tr:last").attr("id").slice(3)
        var name_count = parseInt(name_count1) - "1";
        name_count1++
        name_count++
        //alert(name_count)
        // $('#dynamic_field').append('<tr id="row' + i + '"><td><select name="Price['+ name_count +'][package_rating]" id="rating' + name_count + '" class="form-control" style="width: 90px"> </select></td><td> <div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input name="Price['+ name_count +'][datefrom]" class="form-control pull-right datepicker" type="text"> </div></td><td><div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i> </div><input name="Price['+ name_count +'][dateto]" class="form-control pull-right datepicker" type="text"></div></td><td> <div class="input-group" style="margin-bottom:5px;"> <span class="input-group-addon"> <select name="Price['+ name_count +'][currency]" id="currency' + name_count + '">  </select> </span> <input name="Price['+ name_count +'][airfare]" class="form-control" placeholder="Enter Airfare"> </div></td><td><div class="input-group" style="margin-bottom:5px;"><input name="Price['+ name_count +'][hotel]" class="form-control" placeholder="Enter Hotel Fare"></div></td><td><div class="input-group" style="margin-bottom:5px;"><input name="Price['+ name_count +'][tour_transfer]" class="form-control" placeholder="Enter Tour & Transfer Fare"></div></td><td><div class="input-group" style="margin-bottom:5px;"><input name="Price['+ name_count +'][total]" class="form-control" placeholder="Total Fare"></div></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
        $('#dynamic_field').append('<tr id="row' + name_count1 + '"><td><select name="Price[' + name_count + '][package_rating]" id="rating' + name_count + '" class="form-control rating-field" style="width: 40%;display:inline-block"> </select><input name="Price[' + name_count + '][package_rating_other]" id="otherrating' + name_count + '" class="form-control other-rating" style="width: 50%;display:none"></td><td> <div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input name="Price[' + name_count + '][datefrom]" class="form-control pull-right datepicker" type="text"> </div></td><td><div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i> </div><input name="Price[' + name_count + '][dateto]" class="form-control pull-right datepicker" type="text"></div></td><td><input type="number" value="0" name="Price[' + name_count + '][cuttoffpoint]" class="form-control" placeholder="Cutt Off Days"></td><td><div class="c_price' + name_count + '" id="c_price' + name_count + '"><input type="hidden" name="Price[' + name_count + '][airfare_adult]" value="" class="air_fare_adult"><input type="hidden" name="Price[' + name_count + '][airfare_exadult]" value="" class="air_fare_exadult"><input type="hidden" name="Price[' + name_count + '][airfare_childbed]" value="" class="air_fare_childbed"><input type="hidden" name="Price[' + name_count + '][airfare_childwbed]" value="" class="air_fare_childwbed"><input type="hidden" name="Price[' + name_count + '][airfare_infant]" value="" class="air_fare_infant"><input type="hidden" name="Price[' + name_count + '][airfare_single]" value="" class="air_fare_single"><input type="hidden" name="Price[' + name_count + '][aircurrency]" value="" class="air_currency"><input type="hidden" name="Price[' + name_count + '][hotelfare_adult]" value="" class="hotel_fare_adult"><input type="hidden" name="Price[' + name_count + '][hotelfare_exadult]" value="" class="hotel_fare_exadult"><input type="hidden" name="Price[' + name_count + '][hotelfare_childbed]" value="" class="hotel_fare_childbed"><input type="hidden" name="Price[' + name_count + '][hotelfare_childwbed]" value="" class="hotel_fare_childwbed"><input type="hidden" name="Price[' + name_count + '][hotelfare_infant]" value="" class="hotel_fare_infant"><input type="hidden" name="Price[' + name_count + '][hotelfare_single]" value="" class="hotel_fare_single"><input type="hidden" name="Price[' + name_count + '][hotelcurrency]" value="" class="hotel_currency"><input type="hidden" name="Price[' + name_count + '][tourfare_adult]" value="" class="tour_fare_adult"><input type="hidden" name="Price[' + name_count + '][tourfare_exadult]" value="" class="tour_fare_exadult"><input type="hidden" name="Price[' + name_count + '][tourfare_childbed]" value="" class="tour_fare_childbed"><input type="hidden" name="Price[' + name_count + '][tourfare_childwbed]" value="" class="tour_fare_childwbed"><input type="hidden" name="Price[' + name_count + '][tourfare_infant]" value="" class="tour_fare_infant"><input type="hidden" name="Price[' + name_count + '][tourfare_single]" value="" class="tour_fare_single"><input type="hidden" name="Price[' + name_count + '][tourcurrency]" value="" class="tour_currency"><input type="hidden" name="Price[' + name_count + '][transferfare_adult]" value="" class="transfer_fare_adult"><input type="hidden" name="Price[' + name_count + '][transferfare_exadult]" value="" class="transfer_fare_exadult"><input type="hidden" name="Price[' + name_count + '][transferfare_childbed]" value="" class="transfer_fare_childbed"><input type="hidden" name="Price[' + name_count + '][transferfare_childwbed]" value="" class="transfer_fare_childwbed"><input type="hidden" name="Price[' + name_count + '][transferfare_infant]" value="" class="transfer_fare_infant"><input type="hidden" name="Price[' + name_count + '][transferfare_single]" value="" class="transfer_fare_single"><input type="hidden" name="Price[' + name_count + '][transfercurrency]" value="" class="transfer_currency"><input type="hidden" name="Price[' + name_count + '][visafare_adult]" value="" class="visa_fare_adult"><input type="hidden" name="Price[' + name_count + '][visafare_exadult]" value="" class="visa_fare_exadult"><input type="hidden" name="Price[' + name_count + '][visafare_childbed]" value="" class="visa_fare_childbed"><input type="hidden" name="Price[' + name_count + '][visafare_childwbed]" value="" class="visa_fare_childwbed"><input type="hidden" name="Price[' + name_count + '][visafare_infant]" value="" class="visa_fare_infant"><input type="hidden" name="Price[' + name_count + '][visafare_single]" value="" class="visa_fare_single"><input type="hidden" name="Price[' + name_count + '][visacurrency]" value="" class="visa_currency"><input type="hidden" name="Price[' + name_count + '][adult_fare_total]" value="" class="adult_fare_total"><input type="hidden" name="Price[' + name_count + '][exadult_fare_total]" value="" class="exadult_fare_total"><input type="hidden" name="Price[' + name_count + '][childwithbed_fare_total]" value="" class="childwithbed_fare_total"><input type="hidden" name="Price[' + name_count + '][childwithoutbed_fare_total]" value="" class="childwithoutbed_fare_total"><input type="hidden" name="Price[' + name_count + '][infant_fare_total]" value="" class="infant_fare_total"><input type="hidden" name="Price[' + name_count + '][single_fare_total]" value="" class="single_fare_total"></div><button type="button" class="btn btn-info btn-lg price_add" data-toggle="modal" data-id="c_price' + name_count + '">Add Price</button></td><td><button type="button" name="remove" id="' + name_count1 + '" class="btn btn-danger btn_remove">X</button></td></tr>');
        $(".datepicker").datepicker();
        var id = name_count;
        $.ajax({
            type: 'POST',
            url: APP_URL + '/packagerating_url',
            // dataType: 'json',
            //data: {type:'domestic',selected:country},
            success: function (data) {
                //console.log('Sucess : '+data,);
                //alert(class_country);
                $('#rating' + id + '').html('').html(data);
                $('#rating' + id + '').append('<option value="other">Other</option>');
            },
            error: function (data) {
                //console.log('Error : '+data);
            }
        });
        $.ajax({
            type: 'POST',
            url: APP_URL + '/currency_url',
            // dataType: 'json',
            //data: {type:'domestic',selected:country},
            success: function (data) {
                //console.log('Sucess : '+data,);
                //alert(class_country);
                $('#currency' + id + '').html('').html(data);
            },
            error: function (data) {
                //console.log('Error : '+data);
            }
        });
        i++;
    });

    $('body').on('change', '.rating-field', function(){
        if($(this).val() == 'other'){
            $(this).parent().find('.other-rating').css('display', 'inline-block');
        } else {
            $(this).parent().find('.other-rating').css('display', 'none');
        }
    });

    //
    $("#add_upcoming_price_row").click(function () {
        var name_count1 = $("#dynamic_field_upcoming tr:last").attr("id").slice(6)
        var name_count = parseInt(name_count1) - "1";
        name_count1++
        name_count++
        $('#dynamic_field_upcoming').append('<tr id="up_row' + name_count1 + '"><td><select name="Price_upcoming[' + name_count + '][package_rating]" id="rating_upcoming' + name_count + '" class="form-control rating-field" style="width: 40%;display:inline-block"> </select><input name="Price_upcoming[' + name_count + '][package_rating_other]" id="otherrating' + name_count + '" class="form-control other-rating" style="width: 50%;display:none"></td><td> <div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input name="Price_upcoming[' + name_count + '][datefrom]" class="form-control pull-right datepicker" type="text"> </div></td><td><div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i> </div><input name="Price_upcoming[' + name_count + '][dateto]" class="form-control pull-right datepicker" type="text"></div></td><td><input type="number" value="0" name="Price_upcoming[' + name_count + '][cuttoffpoint]" class="form-control" placeholder="Cutt Off Days"></td><td><div class="cup_price' + name_count + '" id="cup_price' + name_count + '"><input type="hidden" name="Price_upcoming[' + name_count + '][airfare_adult]" value="" class="air_fare_adult"><input type="hidden" name="Price_upcoming[' + name_count + '][airfare_exadult]" value="" class="air_fare_exadult"><input type="hidden" name="Price_upcoming[' + name_count + '][airfare_childbed]" value="" class="air_fare_childbed"><input type="hidden" name="Price_upcoming[' + name_count + '][airfare_childwbed]" value="" class="air_fare_childwbed"><input type="hidden" name="Price_upcoming[' + name_count + '][airfare_infant]" value="" class="air_fare_infant"><input type="hidden" name="Price_upcoming[' + name_count + '][airfare_single]" value="" class="air_fare_single"><input type="hidden" name="Price_upcoming[' + name_count + '][aircurrency]" value="" class="air_currency"><input type="hidden" name="Price_upcoming[' + name_count + '][hotelfare_adult]" value="" class="hotel_fare_adult"><input type="hidden" name="Price_upcoming[' + name_count + '][hotelfare_exadult]" value="" class="hotel_fare_exadult"><input type="hidden" name="Price_upcoming[' + name_count + '][hotelfare_childbed]" value="" class="hotel_fare_childbed"><input type="hidden" name="Price_upcoming[' + name_count + '][hotelfare_childwbed]" value="" class="hotel_fare_childwbed"><input type="hidden" name="Price_upcoming[' + name_count + '][hotelfare_infant]" value="" class="hotel_fare_infant"><input type="hidden" name="Price_upcoming[' + name_count + '][hotelfare_single]" value="" class="hotel_fare_single"><input type="hidden" name="Price_upcoming[' + name_count + '][hotelcurrency]" value="" class="hotel_currency"><input type="hidden" name="Price_upcoming[' + name_count + '][tourfare_adult]" value="" class="tour_fare_adult"><input type="hidden" name="Price_upcoming[' + name_count + '][tourfare_exadult]" value="" class="tour_fare_exadult"><input type="hidden" name="Price_upcoming[' + name_count + '][tourfare_childbed]" value="" class="tour_fare_childbed"><input type="hidden" name="Price_upcoming[' + name_count + '][tourfare_childwbed]" value="" class="tour_fare_childwbed"><input type="hidden" name="Price_upcoming[' + name_count + '][tourfare_infant]" value="" class="tour_fare_infant"><input type="hidden" name="Price_upcoming[' + name_count + '][tourfare_single]" value="" class="tour_fare_single"><input type="hidden" name="Price_upcoming[' + name_count + '][tourcurrency]" value="" class="tour_currency"><input type="hidden" name="Price_upcoming[' + name_count + '][transferfare_adult]" value="" class="transfer_fare_adult"><input type="hidden" name="Price_upcoming[' + name_count + '][transferfare_exadult]" value="" class="transfer_fare_exadult"><input type="hidden" name="Price_upcoming[' + name_count + '][transferfare_childbed]" value="" class="transfer_fare_childbed"><input type="hidden" name="Price_upcoming[' + name_count + '][transferfare_childwbed]" value="" class="transfer_fare_childwbed"><input type="hidden" name="Price_upcoming[' + name_count + '][transferfare_infant]" value="" class="transfer_fare_infant"><input type="hidden" name="Price_upcoming[' + name_count + '][transferfare_single]" value="" class="transfer_fare_single"><input type="hidden" name="Price_upcoming[' + name_count + '][transfercurrency]" value="" class="transfer_currency"><input type="hidden" name="Price_upcoming[' + name_count + '][visafare_adult]" value="" class="visa_fare_adult"><input type="hidden" name="Price_upcoming[' + name_count + '][visafare_exadult]" value="" class="visa_fare_exadult"><input type="hidden" name="Price_upcoming[' + name_count + '][visafare_childbed]" value="" class="visa_fare_childbed"><input type="hidden" name="Price_upcoming[' + name_count + '][visafare_childwbed]" value="" class="visa_fare_childwbed"><input type="hidden" name="Price_upcoming[' + name_count + '][visafare_infant]" value="" class="visa_fare_infant"><input type="hidden" name="Price_upcoming[' + name_count + '][visafare_single]" value="" class="visa_fare_single"><input type="hidden" name="Price_upcoming[' + name_count + '][visacurrency]" value="" class="visa_currency"><input type="hidden" name="Price_upcoming[' + name_count + '][adult_fare_total]" value="" class="adult_fare_total"><input type="hidden" name="Price_upcoming[' + name_count + '][exadult_fare_total]" value="" class="exadult_fare_total"><input type="hidden" name="Price_upcoming[' + name_count + '][childwithbed_fare_total]" value="" class="childwithbed_fare_total"><input type="hidden" name="Price_upcoming[' + name_count + '][childwithoutbed_fare_total]" value="" class="childwithoutbed_fare_total"><input type="hidden" name="Price_upcoming[' + name_count + '][infant_fare_total]" value="" class="infant_fare_total"><input type="hidden" name="Price_upcoming[' + name_count + '][single_fare_total]" value="" class="single_fare_total"></div><button type="button" class="btn btn-info btn-lg price_add" data-toggle="modal" data-id="cup_price' + name_count + '">Add Price</button></td><td><button type="button" name="remove" id="' + name_count1 + '" class="btn btn-danger btn_remove_up">X</button></td></tr>');
        $(".datepicker").datepicker();
        var id = name_count;
        $.ajax({
            type: 'POST',
            url: APP_URL + '/packagerating_url',
            // dataType: 'json',
            //data: {type:'domestic',selected:country},
            success: function (data) {
                //console.log('Sucess : '+data,);
                //alert(class_country);
                $('#rating_upcoming' + id + '').html('').html(data);
                $('#rating_upcoming' + id + '').append('<option value="other">Other</option>');
            },
            error: function (data) {
                //console.log('Error : '+data);
            }
        });
    });

    //
    $(document).on('click', '.btn_remove_up', function () {
        var button_id = $(this).attr("id");
        $('#up_row' + button_id + '').remove();
    });

    //
    $(document).on('click', '.btn_remove', function () {
        var button_id = $(this).attr("id");
        $('#row' + button_id + '').remove();
    });

    //
    $(document).on('change', '.quo_hotel', function () {
        var hotel_val = $(this).val();
        if (hotel_val == "other") {
            $(this).parents().siblings(".other_hotel").css("display", "block")
            $(this).parents().siblings(".other_hotel").children("input").focus()
            var sel_option = $(this).parents().siblings(".add_star").children("select")
            sel_option.html('').html('<option selected=' + "true" + '>select</option><option value=' + "other" + '>Other</option>');
        }
        else {
            $(this).parents().siblings(".other_hotel").css("display", "none")
            $(this).parents().siblings(".other_star").css("display", "none")
            var sel_option = $(this).parents().siblings(".add_star").children("select")
            $.ajax({
                type: 'POST',
                url: APP_URL + '/add_hotel_star',
                // dataType: 'json',
                data: { id: hotel_val },
                success: function (data) {
                    //console.log('Sucess : '+data);
                    sel_option.html('').html('<option value=' + "other" + '>Other</option><option selected>' + data + '</option>')
                },
                error: function (data) {
                    //console.log('Error : '+data);
                }
            });
        }
    });
    
    //
    $(document).on('change', '.quo_star', function () {
        var star_val = $(this).val();
        if (star_val == "other") {
            $(this).parents().siblings(".other_star").css("display", "block")
            $(this).parents().siblings(".other_star").children("input").focus()
        }
        else {
            $(this).parents().siblings(".other_star").css("display", "none")
        }
    });

    /******************************************/
    
    // Call the function on page load (listed, unlisted and Hide accommodation)
    setAccommodationContent();

    // Set content when accommodation type is changed
    $(".extra_acc").click(function () {
        setAccommodationContent();
    });

    /*----------*/

    // option-1, add more hotel (when listed accommodation is selected)
    $("#add_acco").click(function () {
        var days = $("#package_durations").val();
        // var days = parseInt(days) + parseInt(1);
        var days = parseInt(days);
        var id = $(".dynamic_acc").children(":last").attr("id");
        var id1 = $(".dynamic_acc").children(":last").attr("id");
        id++
        
        // Append a new accommodation field set to the .dynamic_acc container
        $(".dynamic_acc").append(
            "<div class='item-container field" + id + "' id='" + id + "'>" +
                "<div class='row'>" +
                    // Night selection
                    "<div class='col-md-6'>" +
                        "<label>Select Duration <span class='requiredcolor'>*</span></label>" +
                        "<select class='form-control select_day select_2 days_select" + id + "' multiple name='accommodation[" + id + "][night][]'></select>" +
                    "</div>" +

                    // City selection
                    "<div class='col-md-3 quote_city_class'>" +
                        "<label>City <span class='requiredcolor'>*</span></label>" +
                        "<select class='quote_city form-control' name='accommodation[" + id + "][city]'></select>" +
                    "</div>" +

                    // Accommodation Type selection
                    "<div class='col-md-3 propertytype_class'>" +
                        "<div class='form-group'>" +
                            "<label for='propertytype'>Hotel Type <span class='requiredcolor'>*</span></label>" +
                            "<select class='form-control propertytype' name='accommodation[" + id + "][propertytype]' id='propertytype'>" +
                                "<option selected disabled>Select</option>" +
                                "<option value='hotel'>Hotel</option>" +
                                "<option value='resort'>Resort</option>" +
                                "<option value='villa'>Villa</option>" +
                                "<option value='home'>Home</option>" +
                                "<option value='camp'>Camp</option>" +
                                "<option value='cruise'>Cruise</option>" +
                            "</select>" +
                        "</div>" +
                    "</div>" +

                    // Accommodation Source selection
                    "<div class='col-md-4 appendBottom10 propertysource_class'>" +
                        "<label>Hotel Source <span class='requiredcolor'>*</span></label>" +
                        "<select class='form-control propertysource' name='accommodation[" + id + "][trip]' id='propertysource'>" +
                            "<option selected disabled>Select</option>" +
                            "<option value='packagehoteldatabase'>Package Hotel Database</option>" +
                            "<option value='hoteldatabase'>Hotel Database</option>" +
                            "<option value='tripadvisor'>TripAdvisor</option>" +
                            "<option value='manual'>Manual</option>" +
                        "</select>" +
                    "</div>" +

                    // Property Name selection (hidden initially)
                    "<div class='col-md-4 appendBottom10 selectproperty' id='selectproperty' style='display: none'>" +
                        "<label>Hotel Name <span class='requiredcolor'>*</span></label>" +
                        "<select class='form-control text-capitalize quote_hotel' name='accommodation[" + id + "][hotel]'>" +
                            "<option value='0' selected='true' disabled='disabled'>Select</option>" +
                        "</select>" +
                    "</div>" +
                   //Other Hotel
                    "<div class='col-md-4 form-group similar_more' style='display: none'>"+
                    "<label >Similar/More</label>"+
                    "<select class='form-control text-capitalize ' name='accommodation[" + id + "][similar_more]'>"+
                    "<option value='0' selected='true' disabled='disabled'>Select</option>"+
                    "<option value='Similar Hotels'>Similar Hotels</option>"+
                    "<option value='More Options'>More Options</option>"+
                    "</select></div>"+
                    // Star Rating selection (hidden initially)
                    "<div class='col-md-4 appendBottom10 selectpropertystar' id='selectpropertystar' style='display: none'>" +
                        "<label>Hotel Star Rating <span class='requiredcolor'>*</span></label>" +
                        "<select class='form-control selectpropertystar_value' name='accommodation[" + id + "][star]'>" +
                            "<option selected disabled>Select</option>" +
                            "<option value='1'>1 star</option>" +
                            "<option value='2'>2 star</option>" +
                            "<option value='3'>3 star</option>" +
                            "<option value='4'>4 star</option>" +
                            "<option value='5'>5 star</option>" +
                        "</select>" +
                    "</div>" +

                    "<div class='col-md-12'></div>" +

                    // Enter Property Name field (hidden initially)
                    "<div class='col-md-4 appendBottom10 propertyname' id='propertyname' style='display: none'>" +
                        "<label>Enter Property</label>" +
                        "<input type='text' class='form-control text-capitalize' name='accommodation[" + id + "][other_hotel]' placeholder='Enter property name'>" +
                    "</div>" +

                    // Enter Star Rating field (hidden initially)
                    "<div class='col-md-4 appendBottom10 selectpropertynamestar' id='selectpropertynamestar' style='display: none;'>" +
                        "<label>Enter Star Rating</label>" +
                        "<select class='form-control' name='accommodation[" + id + "][star_other]'>" +
                            "<option selected disabled>Select</option>" +
                            "<option value='1'>1 star</option>" +
                            "<option value='2'>2 star</option>" +
                            "<option value='3'>3 star</option>" +
                            "<option value='4'>4 star</option>" +
                            "<option value='5'>5 star</option>" +
                        "</select>" +
                    "</div>" +

                    // Room Type input
                    "<div class='col-md-4 appendBottom10'>" +
                        "<label>Room Type <span class='requiredcolor'>*</span></label>" +
                        "<input type='text' class='form-control text-capitalize' name='accommodation[" + id + "][category]' placeholder='Enter room type'>" +
                    "</div>" +

                    // Hotel Website input
                    "<div class='col-md-4 appendBottom10 hotel_link_class'>" +
                        "<label>Hotel Website</label>" +
                        "<input type='text' class='form-control text-lowercase hotel_link' name='accommodation[" + id + "][hotel_link]' placeholder='Enter hotel website'>" +
                    "</div>" +

                    // Hotel Contact input
                    "<div class='col-md-4 appendBottom10 hotel_contact_class'>" +
                        "<label>Hotel Contact No</label>" +
                        "<input type='text' class='form-control text-capitalize hotel_contact' name='accommodation[" + id + "][contact]' placeholder='Enter hotel contact no'>" +
                    "</div>" +

                    // Meals selection
                    "<div class='col-md-4'>" +
                        "<label>Meals</label>" +
                        "<select class='form-control accommodationMeals' name='accommodation[" + id + "][meals]'>" +
                            "<option selected disabled>Select</option>" +
                            "<option value='Room Only'>Room Only</option>" +
                            "<option value='Breakfast'>Breakfast</option>" +
                            "<option value='Half Board'>Half Board</option>" +
                            "<option value='Full Board'>Full Board</option>" +
                        "</select>" +
                    "</div>" +

                    // Fare Type selection
                    "<div class='col-md-4'>" +
                        "<label>Hotel Price Type</label>" +
                        "<select class='form-control accommodationFareType' name='accommodation[" + id + "][faretype]'>" +
                            "<option selected disabled>Select</option>" +
                            "<option value='Refundable'>Refundable</option>" +
                            "<option value='Non-refundable'>Non-refundable</option>" +
                        "</select>" +
                    "</div>" +

                    // Remove button
                    "<div class='col-md-4'>" +
                        "<button type='button' name='add' id='" + id + "' class='remove_acco btn btn-danger' style='margin-top: 17px'>Remove</button>" +
                    "</div>" +
                "</div>" +
            "</div>"
        );

        $('.select_2').select2();
        var select_day = [];

        $('.select_day').each(function () {
            // select_day.push($(this).val());
            var data=$(this).val()
            if(data!=null) {
                var i;
                for (i = 0; i < data.length; ++i) {
                    select_day.push(data[i]);
                }
            }
        });

        $('.quote_city').each(function (i, obj) {
            if (!$(obj).data('select2')) {
                $(obj).select2({  placeholder: "To",
                allowClear: true,
                ajax:{
                    url: $("#APP_URL").val()+'/search_quote_destination',
                    type: "get",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            searchTerm: params.term // search term
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
            }
        });

        $.ajax({
            type: 'POST',
            url: APP_URL + '/querys_days',
            data: { days: days, select_day: select_day },
            success: function (data) {
               console.log(data)
                $('.dynamic_acc .days_select' + id + '').html("").html(data)
            },
            error: function (data) {
            }
        });
    });
    
    /******************************************/

    /*// Handle select all duration or deselect all duration functionality (for tour quote)--OLD
    $(document).on("click", ".all_days", function() {
        if ($(this).is(':checked')) { // If the checkbox is checked
            // Select all options in the corresponding select element
            $(this).closest('.label-duration').siblings('.select_day').find('option').prop("selected", true);
            // Trigger change event on the select element
            $(this).closest('.label-duration').siblings('.select_day').trigger('change');
            // Disable the "Add Accommodation" button and hide it by adding 'd-none' class
            $("#add_acco").prop('disabled', true).addClass('d-none');

        } else { // If the checkbox is unchecked
            // Deselect all options in the corresponding select element
            $(this).closest('.label-duration').siblings('.select_day').find('option').prop("selected", false);
            // Trigger change event on the select element
            $(this).closest('.label-duration').siblings('.select_day').trigger('change');
            // Enable the "Add Accommodation" button and show it by removing 'd-none' class
            $("#add_acco").prop('disabled', false).removeClass('d-none');
        }
    });*/
    
    // Handle select all duration or deselect all duration functionality (for tour quote)--NEW to check
    // Function to toggle "Add More Hotel" button based on the total selected options
    function toggleAddHotelButton() {
        var totalDays = $(".select_day option").length;
        var totalSelectedDays = 0;

        // Count the total number of selected options across all .select_day elements
        $(".select_day").each(function() {
            totalSelectedDays += $(this).find("option:selected").length;
        });

        // Display the "Add More Hotel" button only if there are remaining unselected days
        if (totalSelectedDays > 0 && totalSelectedDays < totalDays) {
            $("#add_acco").prop('disabled', false).removeClass('d-none');
        } else {
            // Disable the "Add More Hotel" button if all days are selected or none are selected
            $("#add_acco").prop('disabled', true).addClass('d-none');
        }
        
        // Update the "Select All" checkbox state for each set of select_day elements
        $(".daysel").each(function() {
            var selectElement = $(this).find('.select_day');
            var allSelected = selectElement.find('option').length === selectElement.find('option:selected').length;
            $(this).find(".all_days").prop("checked", allSelected); // Check the "Select All" checkbox if all options are selected
        });
    }

    // Handle select all functionality with the checkbox
    $(document).on("click", ".all_days", function() {
        var selectElement = $(this).closest('.daysel').find('.select_day');

        if ($(this).is(':checked')) {
            // Select all options
            selectElement.find('option').prop("selected", true);
            selectElement.trigger('change');
        } else {
            // Deselect all options
            selectElement.find('option').prop("selected", false);
            selectElement.trigger('change');
        }

        // Update the visibility of the "Add More Hotel" button
        toggleAddHotelButton();
    });

    // When any option in the .select_day dropdown changes
    $(document).on("change", ".select_day", function() {
        var totalDays = $(this).find("option").length;
        var selectedDays = $(this).find("option:selected").length;

        // If not all options are selected, uncheck the "Select All" checkbox
        if (selectedDays < totalDays) {
            $(this).closest('.daysel').find(".all_days").prop("checked", false);
        } else {
            // If all options are selected, check the "Select All" checkbox
            $(this).closest('.daysel').find(".all_days").prop("checked", true);
        }

        // Update the visibility of the "Add More Hotel" button
        toggleAddHotelButton();
    });

    // Initial check to set the state of the "Add More Hotel" button on page load
    toggleAddHotelButton();

    // Uncheck the "Select All" checkbox on page load
    $(".all_days").prop("checked", false);

    /******************************************/

    /*$(document).on('select2:open','.select_day', function() {
        //$('.select2').on('select2:opening', function (e) { debugger;
        var selectVal = $('.select_day option:selected');
           console.log(selectVal)
        $(selectVal).each(function() {
            let val = $(this).text().trim();
            setTimeout(() => {
                $('.select2-results__option').each(function() {
                    if($(this).text().includes(val)){
                        $(this).hide();
                    }
                });
            }, 20);
        });
    });*/

    // Hide already selected options in the Select2 dropdown
    $(document).on('select2:open', '.select_day', function() {
        var selectedValues = [];
        $('.select_day option:selected').each(function() {
            selectedValues.push($(this).text().trim());
        });

        setTimeout(() => {
            $('.select2-results__option').each(function() {
                if (selectedValues.includes($(this).text().trim())) {
                    $(this).hide();
                } else {
                    $(this).show(); // Make sure other options remain visible
                }
            });
        }, 20);
    });

    /******************************************/
    
    //
    $(document).on('select2:open','.package_service', function() {
        //$('.select2').on('select2:opening', function (e) { debugger;
        var selectVal = $('.package_service option:selected');
        $(selectVal).each(function() {
            let val = $(this).text().trim();
            setTimeout(() => {
                $('.select2-results__option').each(function() {
                    if($(this).text().includes(val)){
                        $(this).hide();
                    }
                });
            }, 20);
        });
    });
    
    //
    $(document).on('select2:open','.quote_inc', function() {
        //$('.select2').on('select2:opening', function (e) { debugger;
        var selectVal = $('.quote_inc option:selected');
        $(selectVal).each(function() {
            let val = $(this).text().trim();
            setTimeout(() => {
                $('.select2-results__option').each(function() {
                    if($(this).text().includes(val)){
                        $(this).hide();
                    }
                });
            }, 20);
        });
    });
    
    //
    $(document).on('select2:open','.quote_exc', function() {
        //$('.select2').on('select2:opening', function (e) { debugger;
        var selectVal = $('.quote_exc option:selected');
        $(selectVal).each(function() {
            let val = $(this).text().trim();
            setTimeout(() => {
                $('.select2-results__option').each(function() {
                    if($(this).text().includes(val)){
                        $(this).hide();
                    }
                });
            }, 20);
        });
    });
    
    //
    $(document).on('select2:open','.package_visa', function() {
        //$('.select2').on('select2:opening', function (e) { debugger;
        var selectVal = $('.package_visa option:selected');
        $(selectVal).each(function() {
            let val = $(this).text().trim();
            setTimeout(() => {
                $('.select2-results__option').each(function() {
                    if($(this).text().includes(val)){
                        $(this).hide();
                    }
                });
            }, 20);
        });
    });
    
    //
    $(document).on('select2:open','.package_payment', function() {
        //$('.select2').on('select2:opening', function (e) { debugger;
        var selectVal = $('.package_payment option:selected');
        $(selectVal).each(function() {
            let val = $(this).text().trim();
            setTimeout(() => {
                $('.select2-results__option').each(function() {
                    if($(this).text().includes(val)){
                        $(this).hide();
                    }
                });
            }, 20);
        });
    });
    
    //
    $(document).on('select2:open','.package_can', function() {
        //$('.select2').on('select2:opening', function (e) { debugger;
        var selectVal = $('.package_can option:selected');
        $(selectVal).each(function() {
            let val = $(this).text().trim();
            setTimeout(() => {
                $('.select2-results__option').each(function() {
                    if($(this).text().includes(val)){
                        $(this).hide();
                    }
                });
            }, 20);
        });
    });
    
    //
    $(document).on('select2:open','.package_impnotes', function() {
        //$('.select2').on('select2:opening', function (e) { debugger;
        var selectVal = $('.package_impnotes option:selected');
        $(selectVal).each(function() {
            let val = $(this).text().trim();
            setTimeout(() => {
                $('.select2-results__option').each(function() {
                    if($(this).text().includes(val)){
                        $(this).hide();
                    }
                });
            }, 20);
        });
    });

    /******************************************/
    
    // Add more transfer functionality
    $("#add_transfers").click(function () {
        // Get the data-id attribute of the last transfer input to determine the next id
        var id = $(".transfers_input_wrapper").children(":last").data("id");
        id++; // Increment the id for the new transfer input

        //var clone = $("#transfers_input-1").clone();
        //clone.attr({"id":"transfers_input-" + id}).appendTo(".transfers_input_wrapper").append('<div class="col-md-2"><button type="button" name="remove_transfer" data-remove="transfers_input-' + id + '" class="remove_transfer btn btn-danger" style="margin-top:23px">x Remove</button> </div></div>');

        // Create a new row with the specified id for the new transfer input
        $(".transfers_input_wrapper").append(            
            '<div class="item-container transfers_input" id="transfers_input-' + id + '" data-id="' + id + '">' +
                '<div class="row">' +
                    // Title input field
                    '<div class="form-group col-sm-3">' +
                        '<label class="field-required">Title</label>' +
                        '<input type="text" name="transfers[' + id + '][mode_title]" class="form-control mode_title" placeholder="Title">' +
                    '</div>' +

                    // Transfer type dropdown
                    '<div class="col-md-3">' +
                        '<div class="form-group">' +
                            '<label class="field-required">Transfers</label>' +
                            '<select name="transfers[' + id + '][transport_type]" id="transfers_type" class="form-control transfer_mode">' +
                                '<option value="">Select Transport</option>' +
                                '<option value="Car">Car</option>' +
                                '<option value="Bus">Bus</option>' +
                                '<option value="Train">Train</option>' +
                            '</select>' +
                        '</div>' +
                    '</div>' +

                    // Transfers type dropdown
                    '<div class="form-group col-sm-3">' +
                        '<label class="field-required">Select Transfers</label>' +
                        '<select name="transfers[' + id + '][transfers_type]" id="transfers_type' + id + '" class="form-control transfers_type">' +
                            '<option value="0">Select Transfers</option>' +
                        '</select>' +
                    '</div>' +

                    // Remove button
                    '<div class="col-md-2">' +
                        '<button type="button" name="remove_transfer" data-remove="transfers_input-' + id + '" class="remove_transfer btn btn-danger" style="margin-top:17px">Remove</button>' +
                    '</div>' +
                '</div>' +
            '</div>'
        );
    });
    
    //
    $('.transfers_input_wrapper').on('change', '.transfer_mode', function() {
        let cele = $(this);
        let tmode = $(this).val();
        $.get( APP_URL + "/get_transfertype", function( data ) {
            cele.parents('.transfers_input').find('.transfers_type').html('').append('<option value="0">--Select Transfers--</option>');
            for(let options of data){
                if(options.transport_type == tmode){
                    //console.log(options);
                    cele.parents('.transfers_input').find('.transfers_type').append('<option value="'+ options.title +'">'+ options.title +'</option>');
                }
            }
        });
    });
    
    /******************************************/

    // Run the toggle function on page load to apply the initial state
    toggleVisaPolicySection();

    // Toggle visibility on checkbox click
    $(document).on("click", "#customize_onrequestvisa", function() {
      toggleVisaPolicySection();
    });

    /******************************************/

    //
    let cityName = [];
    $('#dynamic_field_package').on('change', '.package_dest_cities', function() {
        $('#dynamic_field_package .row').each(function(){
            let pdcVal = $(this).find('.package_dest_cities').val();
            if(!cityName.includes(pdcVal)){
                cityName.push(pdcVal);
            }
        });
        $.get( APP_URL + "/get_similarseing", function( data ) {
            $('#tour_add').html('');
            $('.custom_days').html('');
            for(let i = 0; i < data.length; i++) {
                if(cityName.includes(data[i].location)){
                    if ( $(".custom_days option[value="+data[i].id+"]").length == 0 ) {
                        $('.custom_days').append(`<option value="${data[i].id}">${data[i].activity}</option>`);
                        }
                        if ( $("#tour_add option[value="+data[i].id+"]").length == 0 ) {
                        $('#tour_add').append(`<option value="${data[i].id}">${data[i].activity}</option>`);
                        }
                    }
            }
        });
    });
    
    //
    $('#dynamic_field_package .row').each(function() {
        let pdcVal = $(this).find('.package_dest_cities').val();
        if(!cityName.includes(pdcVal)){
            cityName.push(pdcVal);
        }
    });
    
    //
    $.get( APP_URL + "/get_similarseing", function( data ) {
        //$('#tour_add').html('');
        for(let i = 0; i < data.length; i++) {
            if(cityName.includes(data[i].location)){
                if ( $(".custom_days option[value="+data[i].id+"]").length == 0 ) {
                    $('.custom_days').append(`<option value="${data[i].id}">${data[i].activity}</option>`);
                }
                if ( $("#tour_add option[value="+data[i].id+"]").length == 0 ){
                    $('#tour_add').append(`<option value="${data[i].id}">${data[i].activity}</option>`);
                }
            }
        }
    });

    //    
    $('#openPkg').on('change', function() {
        let pkgName = $(this).val();
        window.location.href = APP_URL + '/add-package#' + pkgName;
    });

    if(window.location.pathname == APP_URL + '/add-package') {
        var hash = location.hash.replace(/^#/, '');
        $('.nav-tabs a[href="#' + hash + '"]').tab('show');
    }

    /******************************************/

    /*// get similar tour package
    $('#sp_city').change(function() {
        let cityName = $(this).val();

        $('.spkgs-error').css('display', 'none');
        $('.spkgs-box').css('display', 'block');

        $.get( APP_URL + "/get_similarpkgs", function( data ) {
            //$('#similar_packages').html('');
            for(let i = 0; i < data.length; i++) {
                cityName.forEach(el => {
                    //console.log(data[i].city)
                    if(data[i].city.includes(el)) {
                    //if($.inArray(cityName, data[i].city)){
                        $('#similar_packages').append(`<option value="${data[i].id}" city="${el}">${data[i].title}</option>`);
                    }
                });
            }
        });
    });
    
    $(document).on('select2:unselect',"#sp_city",function(e) {
        var city_name = e.params.data.id;
        $("option[city='"+city_name+"']").remove();
        console.log(city_name)
        //  $("#services_type_"+id).remove();
        // $("#services_type_content_"+id).remove();
    });
    
    if($('#sp_city').length >0 ) {
        let cityName = $('#sp_city').val();

        if(cityName === '' || cityName === null){
            $('.spkgs-box').css('display', 'none');
        } else {
            $('.spkgs-box').css('display', 'block');
            $.get( APP_URL + "/get_similarpkgs", function( data ) {
                //$('#similar_packages').html('');
                for(let i = 0; i < data.length; i++) {
                    cityName.forEach(el => {
                        if(data[i].city.includes(el)){
                        //if($.inArray(cityName, data[i].city)){
                            $('#similar_packages').append(`<option value="${data[i].id}" city="${el}">${data[i].title}</option>`);
                        }
                    });
                }
            });
        }
    }*/

    /*----------*/

    // get similar tour package
    $('#sp_city').change(function() {
        let cityName = $(this).val();
        var lastValueJQ = $(cityName).last().get(0);
        var last_cityName = cityName.splice(0, cityName.length - 1);
        // console.log(cityName)

// console.log(lastValueJQ)
        // Check if cityName is not null or empty
        if (!cityName || cityName.length === 0) {
            console.error("City name is null or empty");
            $('.spkgs-error').css('display', 'block'); // Optionally display an error message
            $('.spkgs-box').css('display', 'none');
            return; // Exit the function to avoid making the AJAX call
        }

        $('.spkgs-error').css('display', 'none');
        $('.spkgs-box').css('display', 'block');

        $.get(APP_URL + "/get_similarpkgs", function(data) {
            // Clear previous options
            // $('#similar_packages').html('');

            for (let i = 0; i < data.length; i++) {
                cityName.forEach(el => {
                    //console.log(data[i].city)
                    if (data[i].city.includes(el)) {
                        $('#similar_packages').append(`<option value="${data[i].id}" city="${el}">${data[i].title}</option>`);
                    }
                });
            }
        });
    });

    // Handle unselecting a city in the select2 element
    $(document).on('select2:unselect', "#sp_city", function(e) {
        var city_name = e.params.data.id;
        $("option[city='" + city_name + "']").remove();
        console.log(city_name);
    });

    // Initial setup for similar packages
    if ($('#sp_city').length > 0) {
        let cityName = $('#sp_city').val();

        if (!cityName || cityName.length === 0) {
            $('.spkgs-box').css('display', 'none');
        } else {
            $('.spkgs-box').css('display', 'block');

            $.get(APP_URL + "/get_similarpkgs", function(data) {

                // Clear previous options
                // $('#similar_packages').html('');

                for (let i = 0; i < data.length; i++) {
                    cityName.forEach(el => {
                        if (data[i].city.includes(el)) {
                            $('#similar_packages').append(`<option value="${data[i].id}" city="${el}">${data[i].title}</option>`);
                        }
                    });
                }
            });
        }
    }

    /******************************************/
    
    // remove tranfers
    $(document).on('click', '.remove_transfer', function () {
        var button_id = $(this).data("remove");
        $('#' + button_id).remove();
    });

    // add accommodation (on line 4048 - this is duplicate, check and remove)
    /*$("#add_acco").click(function () {
        var days = $(this).attr("days")
        // var id = $(".dynamic_acc").children(":last").attr("id");
        // var id1 = $(".dynamic_acc").children(":last").attr("id");
        var id = $(this).parent().parent().siblings(".dynamic_acc").children(":last").attr("id");
        var id1 = $(this).parent().parent().siblings(".dynamic_acc").children(":last").attr("id");
        id++
        // Append dynamic accommodation fields to the .dynamic_acc container
        $(".dynamic_acc").append(
            "<div class='field" + id + "' id='" + id + "'>" +
                //"<hr>" + // Horizontal line to separate entries
                "<div class='hotel-container makeflex'>" +
                    "<div class='row'>" +
                        // Column for selecting nights
                        "<div class='col-md-6 appendBottom10'>" +
                            "<label>Duration</label>" +
                            "<select class='select_day select_2 form-control days_select" + id + "' multiple name='accommodation[" + id + "][night][]'></select>" +
                        "</div>" +

                        // Column for selecting city
                        "<div class='col-md-3 appendBottom10 quote_city_class'>" +
                            "<label>City</label>" +
                            "<select class='quote_city form-control' name='accommodation[" + id + "][city]' required></select>" +
                        "</div>" +

                        // Column for selecting accommodation type
                        "<div class='col-md-3 appendBottom10 propertytype_class'>" +
                            "<div class='form-group'>" +
                                "<label for='propertytype'>Accommodation Type <span class='requiredcolor'>*</span></label>" +
                                "<select class='form-control propertytype' name='accommodation[" + id + "][propertytype]' id='propertytype'>" +
                                    "<option selected disabled>Select</option>" +
                                    "<option value='hotel'>Hotel</option>" +
                                    "<option value='resort'>Resort</option>" +
                                    "<option value='villa'>Villa</option>" +
                                    "<option value='home'>Home</option>" +
                                    "<option value='camp'>Camp</option>" +
                                    "<option value='cruise'>Cruise</option>" +
                                "</select>" +
                            "</div>" +
                        "</div>" +

                        // Column for selecting accommodation source
                        "<div class='col-md-4 appendBottom10 propertysource_class'>" +
                            "<label>Accommodation Source</label>" +
                            "<select class='form-control propertysource' name='accommodation[" + id + "][trip]' id='propertysource'>" +
                                "<option selected disabled>Select</option>" +
                                "<option value='packagehoteldatabase'>Package Hotel Database</option>" +
                                "<option value='hoteldatabase'>Hotel Database</option>" +
                                "<option value='tripadvisor'>TripAdvisor</option>" +
                                "<option value='manual'>Manual</option>" +
                            "</select>" +
                        "</div>" +

                        // Column for selecting property name (conditionally displayed)
                        "<div class='col-md-4 appendBottom10 selectproperty' id='selectproperty' style='display: none'>" +
                            "<label>Property Name</label>" +
                            "<select class='form-control text-capitalize quote_hotel' name='accommodation[" + id + "][hotel]'>" +
                                "<option value='0' selected='true' disabled='disabled'>Select</option>" +
                            "</select>" +
                        "</div>" +

                        // Column for selecting star rating of the property (conditionally displayed)
                        "<div class='col-md-4 appendBottom10 selectpropertystar' id='selectpropertystar' style='display: none'>" +
                            "<label>Star Rating</label>" +
                            "<select class='form-control selectpropertystar_value' name='accommodation[" + id + "][star]'>" +
                                "<option selected disabled>Select</option>" +
                                "<option value='1'>1 star</option>" +
                                "<option value='2'>2 star</option>" +
                                "<option value='3'>3 star</option>" +
                                "<option value='4'>4 star</option>" +
                                "<option value='5'>5 star</option>" +
                            "</select>" +
                        "</div>" +

                        // Column for entering property name manually (conditionally displayed)
                        "<div class='col-md-4 appendBottom10 propertyname' id='propertyname' style='display: none'>" +
                            "<label>Enter Property</label>" +
                            "<input type='text' class='form-control text-capitalize' name='accommodation[" + id + "][other_hotel]' placeholder='Enter property name'>" +
                        "</div>" +

                        // Column for entering star rating manually (conditionally displayed)
                        "<div class='col-md-4 appendBottom10 selectpropertynamestar' id='selectpropertynamestar' style='display: none;'>" +
                            "<label>Enter Star Rating</label>" +
                            "<select class='form-control' name='accommodation[" + id + "][star_other]'>" +
                                "<option selected disabled>Select</option>" +
                                "<option value='1'>1 star</option>" +
                                "<option value='2'>2 star</option>" +
                                "<option value='3'>3 star</option>" +
                                "<option value='4'>4 star</option>" +
                                "<option value='5'>5 star</option>" +
                            "</select>" +
                        "</div>" +

                        "<div class='col-md-12'></div>" + // Empty column for spacing

                        // Column for entering room type
                        "<div class='col-md-4 appendBottom10'>" +
                            "<label>Room Type</label>" +
                            "<input type='text' class='form-control text-capitalize' name='accommodation[" + id + "][category]' placeholder='Enter room type'>" +
                        "</div>" +

                        // Column for entering hotel website link
                        "<div class='col-md-4 appendBottom10 hotel_link_class'>" +
                            "<label>Hotel Website</label>" +
                            "<input type='text' class='form-control text-lowercase hotel_link' name='accommodation[" + id + "][hotel_link]' placeholder='Enter hotel website'>" +
                        "</div>" +

                        // Column for entering hotel contact number
                        "<div class='col-md-4 appendBottom10 hotel_contact_class'>" +
                            "<label>Hotel Contact No</label>" +
                            "<input type='text' class='form-control text-capitalize hotel_contact' name='accommodation[" + id + "][contact]' placeholder='Enter hotel contact no'>" +
                        "</div>" +

                        // Column for selecting meal type
                        "<div class='col-md-4 appendBottom10'>" +
                            "<label>Meals</label>" +
                            "<select class='form-control accommodationMeals' name='accommodation[" + id + "][meals]'>" +
                                "<option selected disabled>Select</option>" +
                                "<option value='Room Only'>Room Only</option>" +
                                "<option value='Breakfast'>Breakfast</option>" +
                                "<option value='Half Board'>Half Board</option>" +
                                "<option value='Full Board'>Full Board</option>" +
                            "</select>" +
                        "</div>" +

                        // Column for selecting fare type
                        "<div class='col-md-4 appendBottom10'>" +
                            "<label>Fare Type</label>" +
                            "<select class='form-control accommodationFareType' name='accommodation[" + id + "][faretype]'>" +
                                "<option selected disabled>Select</option>" +
                                "<option value='Refundable'>Refundable</option>" +
                                "<option value='Non-refundable'>Non-refundable</option>" +
                            "</select>" +
                        "</div>" +

                        // Column for the remove button
                        "<div class='col-md-4'>" +
                            "<button type='button' name='add' id='" + id + "' class='remove_acco btn btn-danger' style='margin-top: 18px'>(-) Remove</button>" +
                        "</div>" +
                    "</div>" + // End of .row
                "</div>" + // End of .row
            "</div>" // End of .field
        );
        $('.select_2').select2();
        var select_day = [];
        
        $('.select_day').each(function () {
                // select_day.push($(this).val());
                var data=$(this).val()
                if(data!=null)
                {
               var i;
              for (i = 0; i < data.length; ++i) {
              select_day.push(data[i]);
                }
                }
        });

        $('.quote_city').each(function (i, obj) {
            if (!$(obj).data('select2')) {
                $(obj).select2({  placeholder: "To",
                allowClear: true,
                ajax:{
                    url: $("#APP_URL").val()+'/search_quote_destination',
                    type: "get",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            searchTerm: params.term // search term
                            };
                        },
                    processResults: function (response) {
                        return {
                            results: response
                            };
                    },
                    cache: true
                } });
            }
        });

        $.ajax({
            type: 'POST',
            url: APP_URL + '/querys_days',
            data: { days: days, select_day: select_day },
            success: function (data) {
               console.log(data)
                $('.dynamic_acc .days_select' + id + '').html("").html(data)
            },
            error: function (data) {
            }
        });
    });*/

    // option-2
    $("#option2_add_acco").click(function () {
        var days = $(this).attr("days")
        var id = $(".option2_dynamic_acc").children(":last").attr("id");
        var id1 = $(".option2_dynamic_acc").children(":last").attr("id");
        id++
        
        // Append dynamic accommodation fields to the container with the class "option2_dynamic_acc"
        $(".option2_dynamic_acc").append(
            "<div class='field" + id + "' id='" + id + "'>" +
                "<hr>" +
                "<div class='row'>" +
                    // Select Days field
                    "<div class='col-md-4'>" +
                        "<label>Select Days</label>" +
                        "<select class='select_day select2 form-control days_select" + id + "' multiple name='accommodation[" + id + "][day][]'></select>" +
                    "</div>" +

                    // City input field
                    "<div class='col-md-4'>" +
                        "<label>City</label>" +
                        "<input type='text' name='accommodation[" + id + "][city]' class='query_city form-control' placeholder='City'>" +
                    "</div>" +

                    // Choose Hotel Manually or from TripAdvisor dropdown
                    "<div class='col-md-4'>" +
                        "<label>Choose Hotel Manually or from TripAdvisor</label>" +
                        "<select class='form-control' name='accommodation[" + id + "][trip]'>" +
                            "<option>--Select--</option>" +
                            "<option>Manually</option>" +
                            "<option>TripAdvisor</option>" +
                        "</select>" +
                    "</div>" +

                    // Choose Hotel dropdown
                    "<div class='col-md-4'>" +
                        "<label>Choose Hotel</label>" +
                        "<select class='form-control quo_hotel add_hotel_query" + id + "' name='accommodation[" + id + "][hotel]'></select>" +
                    "</div>" +

                    // Other Hotel input field (initially hidden)
                    "<div class='col-md-4 other_hotel' style='display: none;'>" +
                        "<label>Enter Hotel</label>" +
                        "<input type='text' class='form-control' name='accommodation[" + id + "][other_hotel]' placeholder='Hotel Name'>" +
                    "</div>" +

                    // Star Rating dropdown
                    "<div class='col-md-4 add_star'>" +
                        "<label>Choose Star Rating</label>" +
                        "<select class='form-control quo_star' name='accommodation[" + id + "][star]'></select>" +
                    "</div>" +

                    // Other Star Rating input field (initially hidden)
                    "<div class='col-md-4 other_star' style='display: none;'>" +
                        "<label>Enter Star Rating</label>" +
                        "<input type='text' class='form-control' name='accommodation[" + id + "][star_other]' placeholder='Hotel Star Rating'>" +
                    "</div>" +

                    // Room Category input field
                    "<div class='col-md-4'>" +
                        "<label>Room Category</label>" +
                        "<input type='text' placeholder='Room Category' class='form-control' name='accommodation[" + id + "][category]'>" +
                    "</div>" +

                    // Hotel Website Link input field
                    "<div class='col-md-4'>" +
                        "<label>Hotel Website Link</label>" +
                        "<input type='text' placeholder='Hotel Website Link' class='form-control' name='accommodation[" + id + "][hotel_link]'>" +
                    "</div>" +

                    // Remove button to delete the accommodation entry
                    "<div class='col-md-2'>" +
                        "<button type='button' name='add' id='" + id + "' class='remove_acco btn btn-danger' style='margin-top:23px'>x Remove</button>" +
                    "</div>" +
                "</div>" +
            "</div>"
        );

        $('.select2').select2();
        var select_day = [];
        $('.select_day').each(function () {
            select_day.push($(this).val());
        });
        $.ajax({
            type: 'POST',
            url: APP_URL + '/querys_days',
            data: { days: days, select_day: select_day },
            success: function (data) {
                $('.option2_dynamic_acc .days_select' + id + '').html("").html(data)
            },
            error: function (data) {
            }
        });
    });

    // option-3
    $("#option3_add_acco").click(function () {
        var days = $(this).attr("days")
        var id = $(".option3_dynamic_acc").children(":last").attr("id");
        var id1 = $(".option3_dynamic_acc").children(":last").attr("id");
        id++
        
        // Append dynamic accommodation fields to the container with the class "option3_dynamic_acc"
        $(".option3_dynamic_acc").append(
            "<div class='field" + id + "' id='" + id + "'>" +
                "<hr>" +
                "<div class='row'>" +
                    // Select Days field
                    "<div class='col-md-4'>" +
                        "<label>Select Days</label>" +
                        "<select class='select_day select2 form-control days_select" + id + "' multiple name='accommodation[" + id + "][day][]'></select>" +
                    "</div>" +

                    // City input field
                    "<div class='col-md-4'>" +
                        "<label>City</label>" +
                        "<input type='text' name='accommodation[" + id + "][city]' class='query_city form-control' placeholder='City'>" +
                    "</div>" +

                    // Choose Hotel Manually or from TripAdvisor dropdown
                    "<div class='col-md-4'>" +
                        "<label>Choose Hotel Manually or from TripAdvisor</label>" +
                        "<select class='form-control' name='accommodation[" + id + "][trip]'>" +
                            "<option>--Select--</option>" +
                            "<option>Manually</option>" +
                            "<option>TripAdvisor</option>" +
                        "</select>" +
                    "</div>" +

                    // Choose Hotel dropdown
                    "<div class='col-md-4'>" +
                        "<label>Choose Hotel</label>" +
                        "<select class='form-control quo_hotel add_hotel_query" + id + "' name='accommodation[" + id + "][hotel]'></select>" +
                    "</div>" +

                    // Other Hotel input field (initially hidden)
                    "<div class='col-md-4 other_hotel' style='display: none;'>" +
                        "<label>Enter Hotel</label>" +
                        "<input type='text' class='form-control' name='accommodation[" + id + "][other_hotel]' placeholder='Hotel Name'>" +
                    "</div>" +

                    // Star Rating dropdown
                    "<div class='col-md-4 add_star'>" +
                        "<label>Choose Star Rating</label>" +
                        "<select class='form-control quo_star' name='accommodation[" + id + "][star]'></select>" +
                    "</div>" +

                    // Other Star Rating input field (initially hidden)
                    "<div class='col-md-4 other_star' style='display: none;'>" +
                        "<label>Enter Star Rating</label>" +
                        "<input type='text' class='form-control' name='accommodation[" + id + "][star_other]' placeholder='Hotel Star Rating'>" +
                    "</div>" +

                    // Room Category input field
                    "<div class='col-md-4'>" +
                        "<label>Room Category</label>" +
                        "<input type='text' placeholder='Room Category' class='form-control' name='accommodation[" + id + "][category]'>" +
                    "</div>" +

                    // Hotel Website Link input field
                    "<div class='col-md-4'>" +
                        "<label>Hotel Website Link</label>" +
                        "<input type='text' placeholder='Hotel Website Link' class='form-control' name='accommodation[" + id + "][hotel_link]'>" +
                    "</div>" +

                    // Remove button to delete the accommodation entry
                    "<div class='col-md-2'>" +
                        "<button type='button' name='add' id='" + id + "' class='remove_acco btn btn-danger' style='margin-top:23px'>x Remove</button>" +
                    "</div>" +
                "</div>" +
            "</div>"
        );

        $('.select2').select2();
        var select_day = [];
        $('.select_day').each(function () {
            select_day.push($(this).val());
        });
        $.ajax({
            type: 'POST',
            url: APP_URL + '/querys_days',
            data: { days: days, select_day: select_day },
            success: function (data) {
                $('.option3_dynamic_acc .days_select' + id + '').html("").html(data)
            },
            error: function (data) {
            }
        })
    });

    // option-4
    $("#option4_add_acco").click(function () {
        var days = $(this).attr("days")
        var id = $(".option4_dynamic_acc").children(":last").attr("id");
        var id1 = $(".option4_dynamic_acc").children(":last").attr("id");
        id++
        
        // Append dynamic accommodation fields to the container with the class "option4_dynamic_acc"
        $(".option4_dynamic_acc").append(
            "<div class='field" + id + "' id='" + id + "'>" +
                "<hr>" +
                "<div class='row'>" +
                    // Select Days field
                    "<div class='col-md-4'>" +
                        "<label>Select Days</label>" +
                        "<select class='select_day select2 form-control days_select" + id + "' multiple name='accommodation[" + id + "][day][]'></select>" +
                    "</div>" +

                    // City input field
                    "<div class='col-md-4'>" +
                        "<label>City</label>" +
                        "<input type='text' name='accommodation[" + id + "][city]' class='query_city form-control' placeholder='City'>" +
                    "</div>" +

                    // Choose Hotel Manually or from TripAdvisor dropdown
                    "<div class='col-md-4'>" +
                        "<label>Choose Hotel Manually or from TripAdvisor</label>" +
                        "<select class='form-control' name='accommodation[" + id + "][trip]'>" +
                            "<option>--Select--</option>" +
                            "<option>Manually</option>" +
                            "<option>TripAdvisor</option>" +
                        "</select>" +
                    "</div>" +

                    // Choose Hotel dropdown
                    "<div class='col-md-4'>" +
                        "<label>Choose Hotel</label>" +
                        "<select class='form-control quo_hotel add_hotel_query" + id + "' name='accommodation[" + id + "][hotel]'></select>" +
                    "</div>" +

                    // Other Hotel input field (initially hidden)
                    "<div class='col-md-4 other_hotel' style='display: none;'>" +
                        "<label>Enter Hotel</label>" +
                        "<input type='text' class='form-control' name='accommodation[" + id + "][other_hotel]' placeholder='Hotel Name'>" +
                    "</div>" +

                    // Star Rating dropdown
                    "<div class='col-md-4 add_star'>" +
                        "<label>Choose Star Rating</label>" +
                        "<select class='form-control quo_star' name='accommodation[" + id + "][star]'></select>" +
                    "</div>" +

                    // Other Star Rating input field (initially hidden)
                    "<div class='col-md-4 other_star' style='display: none;'>" +
                        "<label>Enter Star Rating</label>" +
                        "<input type='text' class='form-control' name='accommodation[" + id + "][star_other]' placeholder='Hotel Star Rating'>" +
                    "</div>" +

                    // Room Category input field
                    "<div class='col-md-4'>" +
                        "<label>Room Category</label>" +
                        "<input type='text' placeholder='Room Category' class='form-control' name='accommodation[" + id + "][category]'>" +
                    "</div>" +

                    // Hotel Website Link input field
                    "<div class='col-md-4'>" +
                        "<label>Hotel Website Link</label>" +
                        "<input type='text' placeholder='Hotel Website Link' class='form-control' name='accommodation[" + id + "][hotel_link]'>" +
                    "</div>" +

                    // Remove button to delete the accommodation entry
                    "<div class='col-md-2'>" +
                        "<button type='button' name='add' id='" + id + "' class='remove_acco btn btn-danger' style='margin-top:23px'>x Remove</button>" +
                    "</div>" +
                "</div>" +
            "</div>"
        );

        $('.select2').select2();
        var select_day = [];
        $('.select_day').each(function () {
            select_day.push($(this).val());
        });
        $.ajax({
            type: 'POST',
            url: APP_URL + '/querys_days',
            data: { days: days, select_day: select_day },
            success: function (data) {
                $('.option4_dynamic_acc .days_select' + id + '').html("").html(data)
            },
            error: function (data) {
            }
        });
    });

    //
    $(document).on('keyup', '.query_city', function () {
        var city_name = $(this).val()
        var hotel_class = $(this).parent().siblings().children(".quo_hotel")
        var city_value = $(".query_city").map(function () {
            return $(this).val();
        }).get();
        $(this).typeahead({
            source: function (city_name, process) {
                return $.get(APP_URL + "/autocomplete", { city_name: city_name }, function (data) {
                    return process(data);
                });
            }
        });
        $.ajax({
            type: 'POST',
            data: { city_value: city_value },
            url: APP_URL + "/sort_tour_bycity",
            success: function (data) {
                $(".custom_days").html("").html(data)
            },
            error: function (data) {
            }
        });
        //
        $.ajax({
            type: 'POST',
            data: { city_name: city_name },
            url: APP_URL + "/query_hotel_name",
            success: function (data) {
                hotel_class.html("").html("<option value='0' selected='true' disabled='disabled'>--Choose Hotel--</option>" + data + "<option value='other'>Other</option>")
            },
            error: function (data) {
            }
        });
    });

    //
    $(document).on('click', '.remove_acco', function () {
        var button_id = $(this).attr("id");
        $('.field' + button_id + '').remove();
    });

    /*----------------------------------------*/

    /*// tour itinerary (day wise) based on package duration
    $("#package_durations").change(function () {
        var count_ite = ($('.dayItinerary').length + 1);
        var row_count = $('.remove').length;
        var dd_value = $(this).val();
        $(".select_day").html("")
        var m;
        var select_day_data = "";
        for (m = 1; m <= parseInt(dd_value); m++) {
            $(".select_day").append(`<option value="${m}">Night ${m} </option>`);
        }
        if (dd_value < row_count) {
            alert("not allowed")
        }
        var d_value = $(this).val();
        var i;
        if (d_value >= count_ite) {
            var d_value1 = parseInt(dd_value) + parseInt("1");
            for (i = count_ite; i <= d_value1; i++) {
                $('#Itinerary').append('<div class="panel-body c_body"> <div class="row"><div class="col-md-12"><div class="table-responsive"><div class="col-md-12 dayItinerary day1" ><div class="row"><label class="col-md-12">Day ' + i + ' :<input type="text" name="dayItinerary[day' + i + '][title]" placeholder="Day Title" style="height: 35px;width: 93%;margin-left: 1%;margin-bottom: 10px;padding: 0 10px;"></label></div><div class="col-md-4"><div class="form-group"><label>Activity</label><select class="select_3 form-control dayItineraryactivity" name="dayItinerary[day' + i + '][activities][]" multiple><option value=""></option></select></div></div><div class="col-md-4"><div class="form-group"> <label >Meal Plan</label><select name="dayItinerary[day' + i + '][meal_plan]" class="form-control"><option value="N">NO Select</option><option value="EP">Room Only</option><option value="CP">Breakfast</option><option value="lu">Lunch</option><option value="di">Dinner</option><option value="bd">Breakfast & Dinner </option><option value="bl">Breakfast & Lunch </option><option value="ld">Lunch & Dinner</option><option value="bld">Breakfast & Lunch/Dinner </option><option value="bldall">Breakfast, Lunch & Dinner</option><option value="MAP"> All Inclusive </option></select></div></div><div class="col-md-4"><div class=" form-group "><label >Sightseeing Included</label><select class="select_3 form-control custom_days dayItinerarytour' + i + '" name="dayItinerary[day' + i + '][tours][]" multiple> </option> </select></div></div><div class="col-md-12"><div class="form-group"><label for="">Description</label><textarea class="form-control ckeditor" rows="3" name="dayItinerary[day' + i + '][desc]" ></textarea></div></div></div></div></div></div>  </div>');
                CKEDITOR.replace('dayItinerary[day' + i + '][desc]');
            }
            activity_and_sightseeing();
        }
        else {
            $(".c_body").remove();
            var d_value1 = parseInt(d_value) + parseInt("1");
            for (i = 1; i <= d_value1; i++) {
                $('#Itinerary').append('<div class="panel-body c_body"> <div class="row"><div class="col-md-12"><div class="table-responsive"><div class="col-md-12 dayItinerary day1" ><div class="row"><label class="col-md-12">Day ' + i + ' :<input type="text" name="dayItinerary[day' + i + '][title]" placeholder="Day Title" style="height: 35px;width: 93%;margin-left: 1%;margin-bottom: 10px;padding: 0 10px;"></label></div><div class="col-md-4"><div class="form-group"><label>Activity</label><select class="select_3 form-control dayItineraryactivity" name="dayItinerary[day' + i + '][activities][]" multiple><option value=""></option></select></div></div><div class="col-md-4"><div class="form-group"> <label >Meal Plan</label><select name="dayItinerary[day' + i + '][meal_plan]" class="form-control"><option value="N">NO Select</option><option value="EP">Room Only</option><option value="CP">Breakfast</option><option value="lu">Lunch</option><option value="di">Dinner</option><option value="bd">Breakfast & Dinner </option><option value="bl">Breakfast & Lunch </option><option value="ld">Lunch & Dinner</option><option value="bld">Breakfast & Lunch/Dinner </option><option value="bldall">Breakfast, Lunch & Dinner</option><option value="MAP"> All Inclusive </option></select></div></div><div class="col-md-4"><div class=" form-group "><label >Sightseeing Included</label><select class="select_3 form-control custom_days dayItinerarytour' + i + '" name="dayItinerary[day' + i + '][tours][]" multiple> </option> </select></div></div><div class="col-md-12"><div class="form-group"><label for="">Description</label><textarea class="form-control ckeditor" rows="3" name="dayItinerary[day' + i + '][desc]" ></textarea></div></div></div></div></div></div>  </div>');
                CKEDITOR.replace('dayItinerary[day' + i + '][desc]');
            }
            $.ajax({
                type: 'POST',
                data: { city_value: city_value },
                url: APP_URL + "/sort_tour_bycity",
                success: function (data) {
                    $(".custom_days").html("").html(data)
                },
                error: function (data) {
                }
            });
        }
        $('.select_3').select2();
    });*/
$(document).on("change","#package_dest_city0",function()
{
  var package_dest_city0_val =  $(this).val();
  var package_dest_city0_name =  $("#package_dest_city0 option:selected").html();

 $('select[name="accommodation[0][city]"]').html('<option value="'+package_dest_city0_val+'" selected>'+package_dest_city0_name+'</option>')
})
    // tour itinerary (day wise) based on package duration
    $("#package_durations").change(function () {
        var totalDuration = parseInt($(this).val(), 10);
        var count_ite = $('.dayItinerary').length + 1; // Current number of itineraries
        var row_count = $('.remove').length; // Number of rows to remove
        var dd_value = totalDuration; // This is your selected duration value
        
        // Clear existing day options
        $(".select_day").html("");

        // Populate the select options for the number of nights
        for (var m = 1; m <= dd_value; m++) {
            $(".select_day").append(`<option value="${m}">Night ${m}</option>`);
        }

        if (dd_value < row_count) {
            alert("Not allowed");
        } else {
            var i;

            // Adjust itinerary based on the selected duration
            if (dd_value >= count_ite) {

                var d_value1 = dd_value + 1; // Next day to add
                for (i = count_ite; i <= d_value1; i++) {
                    $('#Itinerary').append(`
                        <div class="panel-body c_body"> 
                            <div class="item-container">
                                <div class="row">
                                    <div class="table-responsive">
                                        <div class="col-md-12 dayItinerary day1">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                      <label class="field-required">DAY ${i}</label>
                                                      <input type="text" class="form-control" name="dayItinerary[day${i}][title]" placeholder="Enter day title">
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                      <label>Tour Activity</label>
                                                      <select class='select_3 form-control dayItineraryactivity' name="dayItinerary[day${i}][activities][]" multiple>
                                                        <option value=""></option>
                                                      </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Meal Plan</label>
                                                        <select name="dayItinerary[day${i}][meal_plan]" class="form-control">
                                                            <option value="N">No Meal</option>
                                                            <option value="EP">Room Only</option>
                                                            <option value="CP">Breakfast</option>
                                                            <option value="lu">Lunch</option>
                                                            <option value="di">Dinner</option>
                                                            <option value="bd">Breakfast & Dinner</option>
                                                            <option value="bl">Breakfast & Lunch</option>
                                                            <option value="ld">Lunch & Dinner</option>
                                                            <option value="bld">Breakfast & Lunch/Dinner</option>
                                                            <option value="bldall">Breakfast, Lunch & Dinner</option>
                                                            <option value="apai">All Inclusive</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Sightseeing Included</label>
                                                        <select class="select_3 form-control custom_days dayItinerarytour${i}" name="dayItinerary[day${i}][tours][]" multiple></select>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 custom_inc_exc">
                                                    <div class="form-group">
                                                        <label>Day Plan</label>
                                                        <br>
                                                        <span class="show_hide morePlus">More+</span>
                                                        <textarea class="form-control ckeditor" rows="3" name="dayItinerary[day${i}][desc]"></textarea>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);
                    CKEDITOR.replace(`dayItinerary[day${i}][desc]`);
                }
                activity_and_sightseeing();
            } else {
                // Remove itineraries if the new duration is less
                $(".c_body").remove();
                var d_value1 = dd_value + 1;
                for (i = 1; i <= d_value1; i++) {
                    $('#Itinerary').append(`
                        <div class="panel-body c_body"> 
                            <div class="item-container">
                                <div class="row">
                                    <div class="table-responsive">
                                        <div class="col-md-12 dayItinerary day1">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                      <label class="field-required">DAY ${i}</label>
                                                      <input type="text" class="form-control" name="dayItinerary[day${i}][title]" placeholder="Enter day title">
                                                    </div>
                                                </div>                                        

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                      <label>Tour Activity</label>
                                                      <select class='select_3 form-control dayItineraryactivity' name="dayItinerary[day${i}][activities][]" multiple>
                                                        <option value=""></option>
                                                      </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Meal Plan</label>
                                                        <select name="dayItinerary[day${i}][meal_plan]" class="form-control">
                                                            <option value="N">No Meal</option>
                                                            <option value="EP">Room Only</option>
                                                            <option value="CP">Breakfast</option>
                                                            <option value="lu">Lunch</option>
                                                            <option value="di">Dinner</option>
                                                            <option value="bd">Breakfast & Dinner</option>
                                                            <option value="bl">Breakfast & Lunch</option>
                                                            <option value="ld">Lunch & Dinner</option>
                                                            <option value="bld">Breakfast & Lunch/Dinner</option>
                                                            <option value="bldall">Breakfast, Lunch & Dinner</option>
                                                            <option value="apai">All Inclusive</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Sightseeing Included</label>
                                                        <select class="select_3 form-control custom_days dayItinerarytour${i}" name="dayItinerary[day${i}][tours][]" multiple></select>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 custom_inc_exc">
                                                    <div class="form-group">
                                                        <label>Day Plan</label>
                                                        <br>
                                                        <span class="show_hide morePlus">More+</span>
                                                        <textarea class="form-control ckeditor" rows="3" name="dayItinerary[day${i}][desc]"></textarea>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);

                    CKEDITOR.replace(`dayItinerary[day${i}][desc]`);
                }

                // AJAX call for city-wise duration
                //var city_value = totalDuration; // Replace this with actual logic to get the city value
                //var city_value = $('#city_select').val(); // Get the selected city value

                // Retrieve the selected city value
                var city_value = $('#package_dest_city').val(); // Get the selected city value
                console.log('City Value:', city_value); // Log the city value for debugging

                $.ajax({
                    type: 'POST',
                    data: { city_value: city_value },
                    url: APP_URL + "/sort_tour_bycity",
                    success: function (data) {
                        $(".custom_days").html("").html(data);
                    },
                    error: function (data) {
                        console.error('Error fetching city-wise durations:', data);
                    }
                });
            }

            // Populate the city-wise duration dropdown
            var options = '';
            for (var j = 1; j <= totalDuration; j++) {
                var nightText = (j === 1) ? 'Night' : 'Nights'; // "Night" for 1, "Nights" for others
                var dayText = (j + 1 === 1) ? 'Day' : 'Days'; // "Day" for 1 day, "Days" for more than 1
                options += `<option value="${j}">${j} ${nightText} / ${j + 1} ${dayText}</option>`;
            }

            // Update the options for the package_dest_days dropdown
            $('.package_dest_days').html(options);
            $('.package_dest_days').val(totalDuration); // Optional: set the default value to total duration

            // Optional: Log values for debugging
            console.log('Selected Duration:', totalDuration);
            console.log('Generated Options:', options);
        }

        $('.select_3').select2(); // Initialize Select2 for the newly added selects
      show_itinerary()

    });

    /******************************************/

    // package duration
    /*$('#package_durations').on('change', function () {
        var options = '';
        for (var i = 1; i <= $(this).val(); i++) {
            options += '<option value="' + i + '">' + i + ' Nights</option>';
        }
        //alert(options);
        $('.package_multi_sechdule_days').html(' ').html(options);
    });*/

    $('#package_durations').on('change', function () {
        var options = '';
        var totalDuration = parseInt($(this).val(), 10);

        for (var i = 1; i <= totalDuration; i++) {
            var nightText = (i === 1) ? 'Night' : 'Nights'; // Use "Night" for 1, "Nights" for more than 1

            options += '<option value="' + i + '">' + i + ' ' + nightText + '</option>';
        }

        // Update the options for the .package_multi_sechdule_days dropdown
        $('.package_multi_sechdule_days').html(options);
    });

    /******************************************/

    // package duration
    /*$('#package_durations').on('change', function () {
        var options = '';
        for (var i = 1; i <= $(this).val(); i++) {
            options += '<option value="' + i + '">' + i + ' Nights /' + (i + 1) + ' Days </option>';
        }
        //alert(options);
        $('.package_dest_days').html(' ').html(options);
        $('#package_dest_days').val($(this).val());
    });*/

    /*$('#package_durations').on('change', function () {
        var options = '';
        var totalDuration = parseInt($(this).val(), 10);

        console.log('Selected Duration:', totalDuration); // Log selected duration

        // Clear existing options in the city-wise duration dropdown
        $('.package_dest_days').empty();

        for (var i = 1; i <= totalDuration; i++) {
            var nightText = (i === 1) ? 'Night' : 'Nights'; // Use "Night" for 1, "Nights" for others
            var dayText = (i + 1 === 1) ? 'Day' : 'Days';   // Use "Day" for 1 day, "Days" for more than 1

            options += '<option value="' + i + '">' + i + ' ' + nightText + ' / ' + (i + 1) + ' ' + dayText + '</option>';
        }

        console.log('Generated Options:', options); // Log generated options

        // Update the options for the package_dest_days dropdown
        $('.package_dest_days').html(options);

        // Optional: Set the default selected value to the total duration
        $('.package_dest_days').val(totalDuration); // If you want to set the default value to the last option, comment this line out.

        city_value = totalDuration; // This is just an example; adjust it as needed

        // Now you can safely use city_value without causing a ReferenceError
        console.log('City Value:', city_value);    
    });*/

    /******************************************/

    //
    $(document).on("click", ".customn_package_hotel", function (e) {
        e.preventDefault()
        $("#pk_aadhotel #success-add_pkhotel").css("display", "none");
        $("#pk_aadhotel #error-add_pkhotel").css("display", "none");
        $("#pk_aadhotel #hotelname").val("");
        $("#pk_aadhotel #location").val("");
    });

    // add package hotel
    $(document).on("click", "#add_package_hotel", function (e) {
        e.preventDefault()
        var hotelname = $("#hotelname").val();
        var location = $("#location").val();
        var star_rating = $("#star_rating").val();
        $.ajax({
            type: 'POST',
            url: APP_URL + '/add_package_hotel',
            // dataType: 'json',
            data: { hotelname: hotelname, location: location, star_rating: star_rating },
            success: function (data) {
                console.log('Sucess : ' + data);
                $("#success-add_pkhotel").css("display", "block");
                $('.package_hot_add').append(data);
            },
            error: function (data) {
                //console.log('Error : '+data);
                $("#error-add_pkhotel").css("display", "block");
            }
        });
    });

    //
    $('.collapsable-form .collapse-toggle').click(function(){
        $(this).parent().find('.cke_inner').toggle();
    });

    // hotel star category
    $(document).on("change", ".package_hot_add", function () {
        var hotel_id = $(this).val();
        var add_star = $(this).parent().parent().siblings(".h_star").children().children(".add_star");
        $.ajax({
            type: 'POST',
            url: APP_URL + '/add_hotel_star',
            // dataType: 'json',
            data: { id: hotel_id },
            success: function (data) {
                console.log('Sucess : ' + data);
                $(add_star).val(data)
            },
            error: function (data) {
                //console.log('Error : '+data);
            }
        });
    });
    
    /******************************************/

    //continent-add (old)
    /*var j = 1;
    let rowId = 1;

    $("#add-continent-row").click(function () {
        rowId++;
        var continent_name = $("#dynamic_field_package .remove:last .form-control").attr("name").slice(10, 11);
        continent_name++
        var row_count = $('.remove').length;
        var limit = $('#package_durations').val();
        let duration_days = '';
        let duration_days_count = 0;
        $('#dynamic_field_package .dfp').each(function(){
            duration_days = parseInt($(this).find('.package_dest_days').val());
            duration_days_count += duration_days;
        });
        if (row_count < limit && duration_days_count >= limit) {
            alert("Please decrease duration to add more rows")
        }
        else if (row_count < limit) {
            $("#dynamic_field_package").append
                ("<div class='row remove dfp dfp-" + rowId +"'><div class='col-md-12'><div class='col-md-2 form-group'><label for='continent'>Continent</label><select name='continent[" + continent_name + "]' id='continent' class='form-control continent' ><option value='Asia'>Asia</option><option value='Africa'>Africa</option><option value='Antarctica'>Antarctica</option><option value='Australia'>Australia</option><option value='Europe'>Europe</option><option value='North America'>North America</option><option value='South America'>South America</option></select></div><div class='col-md-2 form-group'><label for='country'>Country</label><select name='country[" + continent_name + "]' id='package_dest_countries" + continent_name + "' class='form-control  package_dest_country' onchange='myFunction(this)'><option value='0'></option></select></div><div class='col-md-2 form-group'><label for='state'>State</label><select name='state[" + continent_name + "]' id='package_dest_state" + continent_name + "' class='form-control package_dest_countries" + continent_name + "' onchange='sateFunction(this)'></select></div><div class='col-md-2 form-group'><label for='city'>City</label><select name='city[" + continent_name + "]' id='package_dest_city' class='form-control package_dest_state" + continent_name +" package_dest_cities city_package_dest_countries" + continent_name + "  min-select' onchange='cityFunction(this)'></select></div><div class='col-md-2 form-group'><label for='No. Of Night'>No. Of Days/Nights</label><select name='days[" + continent_name + "]' id='package_dest_days" + rowId +"' class='form-control select2 package_dest_days'></select></div><div class='col-md-2 form-group'><button type='button' name='add-continent' id='remove-continent-row' class='btn btn-danger remove-continent-row' style='margin: 18px 10px 0px 0px'>Remove</button></div></div></div>");
            var days_option = $(".val").val();
            // var class_length=$(".remove").length;
            //var val_count=(days_option/class_length);
            var options = '';
            for (var i = 1; i <= days_option - duration_days_count; i++) {
                options += '<option value="' + i + '">' + i + ' Nights /' + (i + 1) + ' Days </option>';
            }
            $('.dfp-' + rowId).find('.package_dest_days').html(' ').html(options);
            // var class_country=".package_dest_country"+j;
            //alert(class_country)
            var id = continent_name;
            //alert(id)
            //let prevRowPkgs = $('.dfp-' + rowId).prev('.dfp').find('.package_dest_days');
            //let prevRowPkgsVal = prevRowPkgs.val();
            $('.dfp:not(.dfp-' + rowId + ')').each(function(){
                pkgVal = $(this).find('.package_dest_days').val();
                $(this).find('.package_dest_days option').each(function(){
                    if($(this).val() > pkgVal){
                        $(this).remove();
                    }
                });
            });
            $.ajax({
                type: 'POST',
                url: APP_URL + '/country_url',
                // dataType: 'json',
                //data: {type:'domestic',selected:country},
                success: function (data) {
                    //console.log('Sucess : '+data,);
                    //alert(class_country);
                    $('#package_dest_countries' + id + '').html('').html(data);
                },
                error: function (data) {
                    //console.log('Error : '+data);
                }
            });
            j++;
        } else {
            alert("Number of Rows cannot be Greater than Night")
        }
    });*/

    //continent-add (new-working)
    // Initialize row counter
    var j = 1; 
    let rowId = 1;

    // Event listener for adding a continent row
    $("#add-continent-row").click(function () {
        rowId++; // Increment row ID for new continent row
        
        // Extract the current continent name index from the last added row
        var continent_name = $("#dynamic_field_package .remove:last .form-control").attr("name").slice(10, 11);
        continent_name++; // Increment to get the next index for the new continent
  
        // Count the current number of rows and get the duration limit
        var row_count = $('.remove').length;
        var limit = $('#package_durations').val();
        let duration_days = '';
        let duration_days_count = 0;

        // Calculate the total number of days from existing rows
        $('#dynamic_field_package .dfp').each(function(){
            duration_days = parseInt($(this).find('.package_dest_days').val()) || 0;
            duration_days_count += duration_days; // Sum the durations
        });

        // Check if more rows can be added based on the duration limit
        if (row_count < limit && duration_days_count >= limit) {
            alert("To add more city, you need to decrease the 'Duration By City'");
        }  else if (row_count < limit) {
            // Append a new row for continent selection
            $("#dynamic_field_package").append(`
                <div class='row'>
                <div class='col-md-12'>
                    <div class='item-container remove dfp dfp-${rowId}'>
                        <div class='col-md-2 form-group'>
                            <label for='continent'>Continent</label>
                            <select name='continent[${continent_name}]' id='package_continent${continent_name}' class='form-control package_continent'>
                               
                            </select>
                        </div>
                        <div class='col-md-2 form-group'>
                            <label for='package_dest_countries'>Country</label>
                            <select name='country[${continent_name}]' id='package_dest_countries${continent_name}' class='form-control package_dest_country' onchange='selectCountry(this)'>
                                <option value='0'></option>
                            </select>
                        </div>
                        <div class='col-md-2 form-group'>
                            <label for='package_dest_state'>State</label>
                            <select name='state[${continent_name}]' id='package_dest_state${continent_name}' class='form-control package_dest_state' '></select>
                        </div>
                        <div class='col-md-2 form-group'>
                            <label for='package_dest_city'>City</label>
                            <select name='city[${continent_name}]' id='package_dest_city${continent_name}' class='form-control  package_dest_cities city_package_dest_countries min-select'></select>
                        </div>
                        <div class='col-md-2 form-group'>
                            <label for='package_dest_days'>Duration</label>
                            <select name='days[${continent_name}]' id='package_dest_days${rowId}' class='form-control select2 package_dest_days'></select>
                        </div>
                        <div class='col-md-2 form-group'>
                            <button type='button' name='add-continent' id='remove-continent-row' class='btn btn-danger remove-continent-row' style='margin: 18px 10px 0px 0px'>Remove</button>
                        </div>
                    </div>
                </div>
                </div>
            `);

            // Get the limit of days
            var remaining_days = limit - duration_days_count;
            var options = '';

            // Generate options for days based on the remaining available days
            for (var i = 1; i <= remaining_days; i++) {
                var nightText = (i === 1) ? 'Night' : 'Nights'; // Use "Night" for 1, "Nights" for others
                var dayText = ((i + 1) === 1) ? 'Day' : 'Days'; // Use "Day" for 2 days (i + 1), "Days" for others
                options += '<option value="' + i + '">' + i + ' ' + nightText + ' / ' + (i + 1) + ' ' + dayText + '</option>';
            }
            
            // Populate the new select element with the generated options
            $('.dfp-' + rowId).find('.package_dest_days').html(' ').html(options);

            // Remove options in previous rows that exceed the current selection
            $('.dfp:not(.dfp-' + rowId + ')').each(function() {
                var pkgVal = $(this).find('.package_dest_days').val();

                $(this).find('.package_dest_days option').each(function() {
                    
                     
                    if (parseInt($(this).val()) > pkgVal) {
                        
                        $(this).remove(); // Remove options greater than the selected value
                    }
                });
            });

var continentSelect =$("#package_continent"+continent_name)
continentSelect.empty()
            // Fetch countries based on selected continent
            $.ajax({
                type: 'get',
                url: APP_URL + '/get_continent_list',
                success: function(data) {
                   if(data.length>0)
    {
    continentSelect.append('<option value="">Select Continent</option>');
    $.each(data, function(index, con){
   continentSelect.append('<option value="' + con.id + '">' + con.continent_name + '</option>');
    })

    }

                },
                error: function(data) {
                    // Handle AJAX error if needed
                    console.log('Error : ', data);
                }
            });
            j++; // Increment row count
        } else {
            alert("Select 'Total Duration' to add more city"); // Alert if row limit is exceeded
        }
    });
    
    /******************************************/

    //
    /*$(document).on('click', '.remove-continent-row', function () {
        var x = $(this).parent().parent().parent();
        $(x).remove();
        let rowNos = $('.dfp').length;
        if(rowNos == 1){
            var days_option = $(".val").val();
            var options = '';
            for (var i = 1; i <= days_option; i++) {
                options += '<option value="' + i + '">' + i + ' Nights /' + (i + 1) + ' Days </option>';
            }
            $('.dfp-1').find('.package_dest_days').html(' ').html(options);
            $('.dfp-1').find('.package_dest_days').val(days_option);
        }
        let currentPdcVal = x.find('.package_dest_cities').val();
        cityName.splice(cityName.indexOf(currentPdcVal), 1);
        $.get( APP_URL + "/get_similarseing", function( data ) {
            $('#tour_add').html('');
            for(let i = 0; i < data.length; i++) {
                if(cityName.includes(data[i].location)){
                    $('#tour_add').append(`<option value="${data[i].activity}">${data[i].activity}</option>`);
                }
            }
        });
    });*/

    // Event listener for removing a continent row
    $(document).on('click', '.remove-continent-row', function () {
      
        var previous_lst = $(".package_dest_days").last().find("option").clone();
        var x = $(this).parent().parent().parent();
        console.log("Previous Options:", previous_lst);
        // Remove the selected continent row from the DOM
        $(x).remove();
        var now_lst = $(".package_dest_days").last(); 

     
var maxNights = 0, maxDays = 0;
now_lst.find("option").each(function () {
    var text = $(this).text();
    var match = text.match(/(\d+)\s+Night/);
    if (match) {
        maxNights = Math.max(maxNights, parseInt(match[1]));
    }
    match = text.match(/(\d+)\s+Day/);
    if (match) {
        maxDays = Math.max(maxDays, parseInt(match[1]));
    }
});


previous_lst.each(function () {
    var optionText = $(this).text();
    var optionValue = $(this).val();
    
    var nightMatch = optionText.match(/(\d+)\s+Night/);
    var dayMatch = optionText.match(/(\d+)\s+Day/);

    if (nightMatch) {
        maxNights += 1; // Increment night count
        now_lst.append(`<option value="${optionValue}">${maxNights} Night / ${maxDays + 1} Days</option>`);
    } else if (dayMatch) {
        maxDays += 1; // Increment day count
        now_lst.append(`<option value="${optionValue}">${maxNights + 1} Night / ${maxDays} Days</option>`);
    }
});

        // Get the current number of continent rows
        let rowNos = $('.dfp').length;
        
        // If only one row remains, reset the options for the days dropdown
        if (rowNos == 1) {
            var days_option = $(".val").val(); // Get the total days option value
            var options = '';

            // Generate options for the days dropdown
            for (var i = 1; i <= days_option; i++) {
                //options += `<option value="${i}">${i} Nights / ${i + 1} Days</option>`;
                var nightText = (i === 1) ? 'Night' : 'Nights'; // Use "Night" for 1, "Nights" for others
                var dayText = 'Days'; // Always use "Days" for 2 or more days (since i + 1 >= 2)
                options += `<option value="${i}">${i} ${nightText} / ${i + 1} ${dayText}</option>`; // Append the option to the options string using template literals
            }

            // Populate the days dropdown in the first continent row
            $('.dfp-1').find('.package_dest_days').html(' ').html(options);
            $('.dfp-1').find('.package_dest_days').val(days_option); // Set the default value
        }

        // Get the currently selected city from the removed row
        let currentPdcVal = x.find('.package_dest_cities').val();
        
        // Remove the current city from the cityName array
        cityName.splice(cityName.indexOf(currentPdcVal), 1);
        
        // Fetch similar activities based on the remaining city names
        $.get(APP_URL + "/get_similarseing", function(data) {
            $('#tour_add').html(''); // Clear the existing options
            
            // Append new options to the tour dropdown based on cityName
            for (let i = 0; i < data.length; i++) {
                if (cityName.includes(data[i].location)) {
                    $('#tour_add').append(`<option value="${data[i].activity}">${data[i].activity}</option>`);
                }
            }
        });
    });

    /******************************************/

    //
    $("#package-form").on("keypress", function (event) {
        var keyPressed = event.keyCode || event.which;
        if (keyPressed === 13) {
            event.preventDefault();
            return false;
        }
    });
    
    //
    $(".location_add").click(function () {
        $.ajax({
            type: 'post',
            url: APP_URL + '/location_data',
            // dataType: 'json',
            // data: {location_name:"country_id"},
            success: function (data) {
                console.log('Sucess : ' + data,);
                //alert(class_country);
            },
            error: function (data) {
                console.log('Error : ' + data);
            }
        });
    });

    //
    $(".addcountry").change(function () {
        var country_id = $(this).val();
        $.ajax({
            type: 'POST',
            url: APP_URL + '/state_url1',
            // dataType: 'json',
            data: { country_id: country_id },
            success: function (data) {
                console.log('Sucess : ' + data,);
                //alert(class_country);
                $('#addstate').html('').html(data);
            },
            error: function (data) {
                console.log('Error : ' + data);
            }
        });
    });

    //country status handling
    $('.countryStatus').click(function () {
        var id = $(this).attr('data-id');
        var status = $(this).attr('lang');
        // alert($(this).attr('data-id'));
        $.ajax({
            type: 'POST',
            url: APP_URL + '/set-country-status',
            // dataType: 'json',
            data: { status: status, id: id },
            success: function (data) {
                if (data == 'TRUE') {
                    location.reload();
                }
                //console.log('Sucess : '+data);
            },
            error: function (data) {
                //console.log('Error : '+data);
            }
        });
    });

    //Multi City Location Day Schedule
    $('#package_location_city').on('change', function () {
        var count = 0;
        var options = '';
        $("#package_location_city option:selected").each(function () {
            var $this = $(this);
            count++;
            if ($this.length) {
                var selText = $this.text();
                var selVal = $this.val();
                options += '<option value="' + selVal + '">' + selText + '</option>';
            }
        });
        // alert(count);
        // HTML string for schedule options containing location and duration fields
        var scheduleOptions = 
            '<div class="col-md-6 form-group">' +
                // Label and select for "Location" field
                '<label for="duration">Location</label>' +
                '<select name="locationSed[]" id="" class="form-control package_multi_sechdule_city"></select>' +
            '</div>' +
            '<div class="col-md-6 form-group">' +
                // Label and select for "Duration" field
                '<label for="duration">Duration</label>' +
                '<select name="durationSed[]" id="" class="form-control package_multi_sechdule_days"></select>' +
            '</div>';

        var scheduleOptionsList = '';
        for (var j = 0; j < count; j++) {
            scheduleOptionsList += scheduleOptions;
        }
        $('#dayscheduleDiv').html(' ').html(scheduleOptionsList);
        $('.package_multi_sechdule_city').html(' ').html(options);
        $('.dayItineraryCity').html(' ').html(options);
    });

    // add tour sightseeing
    $("#add-tour").click(function (e) {
        e.preventDefault();
        var tourname = $("#tour_name").val();
        var tourimage = $("#tour_image").val();
        var tourdescription = $("#tour_description").val();
        var tourdescription = CKEDITOR.instances['tour_description'].getData();
        var tourlocation = $("#tour_location").val();
        var tourduration = $("#tour_duration").val();
        var tourinclusion = $("#tour_inclusion").val();
        var tourexclusion = $("#tour_exclusion").val();
        var tourstatus = $("#tour_status").val();
        $.ajax({
            type: 'POST',
            url: APP_URL + '/add-tour-custom',
            // dataType: 'json',
            //data: { name: tour_name, description: tour_description, location: tour_location, status: tour_status },
            data: { name: tourname, tour_image: tourimage, description: tourdescription, location: tourlocation, duration: tourduration, inclusions: tourinclusion, exclusions: tourexclusion, status: tourstatus },
            success: function (data) {
                debugger;
                //console.log('Sucess : '+data);
                $("#success-add").css("display", "block");
                //$('#tour_add').html('').html(data);
                let cname = [];
                $('#dynamic_field_package .row').each(function(){
                    let pdcVal = $(this).find('.package_dest_cities').val();
                    if(!cname.includes(pdcVal)){
                        cname.push(pdcVal);
                    }
                    $('#tour_add').html('');
                    for(let i = 0; i < data.length; i++) {
                        if(cityName.includes(data[i].location)){
                            $('#tour_add').append(`<option value="${data[i].activity}">${data[i].activity}</option>`);
                        }
                    }
                });
                $('#packagetour_custom form')[0].reset();
                CKEDITOR.instances['tour_description'].setData('');
                $("#success-add").css("display", "none");
                $('#packagetour_custom').modal('hide');
            },
            error: function (data) {
                console.log('Error : '+data);
            }
        });
    });
});

/*$(document).ready(function() {
    // Function to toggle "Add More Hotel" button based on the selected options
    function toggleAddHotelButton() {
        var totalDays = $(".select_day option").length;
        var selectedDays = $(".select_day").find("option:selected").length;

        // Display the "Add More Hotel" button only if at least one day is selected but not all
        if (selectedDays > 0 && selectedDays < totalDays) {
            $("#add_acco").prop('disabled', false).removeClass('d-none');
        } else {
            $("#add_acco").prop('disabled', true).addClass('d-none');
        }
    }

    // Handle select all functionality with the checkbox
    $(document).on("click", ".all_days", function() {
        var selectElement = $(this).closest('.label-duration').siblings('.select_day');

        if ($(this).is(':checked')) {
            // Select all options
            selectElement.find('option').prop("selected", true);
            selectElement.trigger('change');
            // Disable the "Add Accommodation" button as all days are selected
            $("#add_acco").prop('disabled', true).addClass('d-none');
        } else {
            // Deselect all options
            selectElement.find('option').prop("selected", false);
            selectElement.trigger('change');
            // Enable the "Add Accommodation" button if no days are selected
            $("#add_acco").prop('disabled', false).removeClass('d-none');
        }
    });

    // When any option in the .select_day dropdown changes
    $(document).on("change", ".select_day", function() {
        var totalDays = $(this).find("option").length;
        var selectedDays = $(this).find("option:selected").length;

        // If not all options are selected, uncheck the "Select All" checkbox
        if (selectedDays < totalDays) {
            $(this).closest('.daysel').find(".all_days").prop("checked", false);
        } else {
            // If all options are selected, check the "Select All" checkbox
            $(this).closest('.daysel').find(".all_days").prop("checked", true);
        }

        // Update the visibility of the "Add More Hotel" button
        toggleAddHotelButton();
    });

    // Initial check to set the state of the "Add More Hotel" button on page load
    toggleAddHotelButton();
});
*/

/*$(document).ready(function() {
    // Function to toggle "Add More Hotel" button based on the selected options
    function toggleAddHotelButton() {
        var totalDays = $(".select_day option").length;
        var selectedDays = $(".select_day").find("option:selected").length;

        // Display the "Add More Hotel" button only if at least one day is selected but not all
        if (selectedDays > 0 && selectedDays < totalDays) {
            $("#add_acco").prop('disabled', false).removeClass('d-none');
        } else {
            // Disable the "Add More Hotel" button if all days are selected
            $("#add_acco").prop('disabled', true).addClass('d-none');
        }
    }

    // Handle select all functionality with the checkbox
    $(document).on("click", ".all_days", function() {
        var selectElement = $(this).closest('.label-duration').siblings('.select_day');

        if ($(this).is(':checked')) {
            // Select all options
            selectElement.find('option').prop("selected", true);
            selectElement.trigger('change');
            // Disable the "Add Accommodation" button as all days are selected
            $("#add_acco").prop('disabled', true).addClass('d-none');
        } else {
            // Deselect all options
            selectElement.find('option').prop("selected", false);
            selectElement.trigger('change');
            // Enable the "Add Accommodation" button if no days are selected
            $("#add_acco").prop('disabled', false).removeClass('d-none');
        }
    });

    // When any option in the .select_day dropdown changes
    $(document).on("change", ".select_day", function() {
        var totalDays = $(this).find("option").length;
        var selectedDays = $(this).find("option:selected").length;

        // If not all options are selected, uncheck the "Select All" checkbox
        if (selectedDays < totalDays) {
            $(this).closest('.daysel').find(".all_days").prop("checked", false);
        } else {
            // If all options are selected, check the "Select All" checkbox
            $(this).closest('.daysel').find(".all_days").prop("checked", true);
        }

        // Update the visibility of the "Add More Hotel" button
        toggleAddHotelButton();
    });

    // Initial check to set the state of the "Add More Hotel" button on page load
    toggleAddHotelButton();
});*/

/*$(document).ready(function() {
    // Function to toggle "Add More Hotel" button based on the total selected options
    function toggleAddHotelButton() {
        var totalDays = $(".select_day option").length;
        var totalSelectedDays = 0;

        // Count the total number of selected options across all .select_day elements
        $(".select_day").each(function() {
            totalSelectedDays += $(this).find("option:selected").length;
        });

        // Display the "Add More Hotel" button only if the total selected days are less than the total days
        if (totalSelectedDays < totalDays) {
            $("#add_acco").prop('disabled', false).removeClass('d-none');
        } else {
            // Disable the "Add More Hotel" button if all days are selected across all boxes
            $("#add_acco").prop('disabled', true).addClass('d-none');
        }
    }

    // Handle select all functionality with the checkbox
    $(document).on("click", ".all_days", function() {
        var selectElement = $(this).closest('.label-duration').siblings('.select_day');

        if ($(this).is(':checked')) {
            // Select all options
            selectElement.find('option').prop("selected", true);
            selectElement.trigger('change');
        } else {
            // Deselect all options
            selectElement.find('option').prop("selected", false);
            selectElement.trigger('change');
        }

        // Update the visibility of the "Add More Hotel" button
        toggleAddHotelButton();
    });

    // When any option in the .select_day dropdown changes
    $(document).on("change", ".select_day", function() {
        var totalDays = $(this).find("option").length;
        var selectedDays = $(this).find("option:selected").length;

        // If not all options are selected, uncheck the "Select All" checkbox
        if (selectedDays < totalDays) {
            $(this).closest('.daysel').find(".all_days").prop("checked", false);
        } else {
            // If all options are selected, check the "Select All" checkbox
            $(this).closest('.daysel').find(".all_days").prop("checked", true);
        }

        // Update the visibility of the "Add More Hotel" button
        toggleAddHotelButton();
    });

    // Initial check to set the state of the "Add More Hotel" button on page load
    toggleAddHotelButton();
});*/


/*$(document).ready(function() {
    // Function to toggle "Add More Hotel" button based on the total selected options
    function toggleAddHotelButton() {
        var totalDays = $(".select_day option").length;
        var totalSelectedDays = 0;

        // Count the total number of selected options across all .select_day elements
        $(".select_day").each(function() {
            totalSelectedDays += $(this).find("option:selected").length;
        });

        // Display the "Add More Hotel" button only if there are remaining unselected days
        if (totalSelectedDays > 0 && totalSelectedDays < totalDays) {
            $("#add_acco").prop('disabled', false).removeClass('d-none');
        } else {
            // Disable the "Add More Hotel" button if all days are selected or none are selected
            $("#add_acco").prop('disabled', true).addClass('d-none');
        }
    }

    // Handle select all functionality with the checkbox
    $(document).on("click", ".all_days", function() {
        var selectElement = $(this).closest('.label-duration').siblings('.select_day');

        if ($(this).is(':checked')) {
            // Select all options
            selectElement.find('option').prop("selected", true);
            selectElement.trigger('change');
        } else {
            // Deselect all options
            selectElement.find('option').prop("selected", false);
            selectElement.trigger('change');
        }

        // Update the visibility of the "Add More Hotel" button
        toggleAddHotelButton();
    });

    // When any option in the .select_day dropdown changes
    $(document).on("change", ".select_day", function() {
        var totalDays = $(this).find("option").length;
        var selectedDays = $(this).find("option:selected").length;

        // If not all options are selected, uncheck the "Select All" checkbox
        if (selectedDays < totalDays) {
            $(this).closest('.daysel').find(".all_days").prop("checked", false);
        } else {
            // If all options are selected, check the "Select All" checkbox
            $(this).closest('.daysel').find(".all_days").prop("checked", true);
        }

        // Update the visibility of the "Add More Hotel" button
        toggleAddHotelButton();
    });

    // Initial check to set the state of the "Add More Hotel" button on page load
    toggleAddHotelButton();
});*/


/*$(document).ready(function() {
    // Function to toggle "Add More Hotel" button based on the total selected options
    function toggleAddHotelButton() {
        var totalDays = $(".select_day option").length;
        var totalSelectedDays = 0;

        // Count the total number of selected options across all .select_day elements
        $(".select_day").each(function() {
            totalSelectedDays += $(this).find("option:selected").length;
        });

        // Display the "Add More Hotel" button only if the total selected days are less than the total days
        if (totalSelectedDays < totalDays) {
            $("#add_acco").prop('disabled', false).removeClass('d-none');
        } else {
            // Disable the "Add More Hotel" button if all days are selected across all boxes
            $("#add_acco").prop('disabled', true).addClass('d-none');
        }
    }

    // Handle select all functionality with the checkbox
    $(document).on("click", ".all_days", function() {
        var selectElement = $(this).closest('.label-duration').siblings('.select_day');

        if ($(this).is(':checked')) {
            // Select all options
            selectElement.find('option').prop("selected", true);
            selectElement.trigger('change');
        } else {
            // Deselect all options
            selectElement.find('option').prop("selected", false);
            selectElement.trigger('change');
        }

        // Update the visibility of the "Add More Hotel" button
        toggleAddHotelButton();
    });

    // When any option in the .select_day dropdown changes
    $(document).on("change", ".select_day", function() {
        var totalDays = $(this).find("option").length;
        var selectedDays = $(this).find("option:selected").length;

        // If not all options are selected, uncheck the "Select All" checkbox
        if (selectedDays < totalDays) {
            $(this).closest('.daysel').find(".all_days").prop("checked", false);
        } else {
            // If all options are selected, check the "Select All" checkbox
            $(this).closest('.daysel').find(".all_days").prop("checked", true);
        }

        // Update the visibility of the "Add More Hotel" button
        toggleAddHotelButton();
    });

    // Initial check to set the state of the "Add More Hotel" button on page load
    toggleAddHotelButton();
});*/


// Function to set accommodation content based on the checked option
function setAccommodationContent() {
    var checkedValue = $(".extra_acc:checked").val();
    if (checkedValue === "normal_acc") {
        $(".accommodation_main").css("display", "block");
        $(".accommodation_extra").css("display", "none");
    } else if (checkedValue === "extra_acc") {
        $(".accommodation_main").css("display", "none");
        $(".accommodation_extra").css("display", "block");
    } else if (checkedValue === "hide_acc") {
        $(".accommodation_main").css("display", "none");
        $(".accommodation_extra").css("display", "none");
    }
}

// Toggle visa policy section visibility based on checkbox state
function toggleVisaPolicySection() {
  var checkbox = $("#customize_onrequestvisa");
  if (checkbox.is(":checked")) {
    // Hide the content if the checkbox is checked
    checkbox.parent().siblings(".costomize_tour_visa").show();
  } else {
    // Show the content if the checkbox is unchecked
    checkbox.parent().siblings(".costomize_tour_visa").hide();
  }
}

/*--------------------------------------------------------------------------*/

//ckeditor start
$(document).ready(function () {
    $('.custom_border input[type="text"]').keyup(function () {
        var name = $(this).attr("name");
        var value = $(this).val();
        //var file_name =e.target.files[0].name;
        $.ajax({
            type: 'POST',
            url: APP_URL + '/dest_add',
            // dataType: 'json',
            data: { value: value, name: name },
            success: function (data) {
                console.log('Sucess : ' + data);
            },
            error: function (data) {
                //console.log('Error : '+data);
            }
        });
    });
});
    //Initialize on document ready
    init_package_category();
    init_package_dist_city();
    init_paymentpolicy();
    init_cancelpolicy();
    init_visapolicy();


/*--------old function-------------*/

function init_package_category() {
    var category = $('#category').val();
    var country = $('#package_country').val().split(',');

    if (category == 'international') {
        $.ajax({
            type: 'POST',
            url: APP_URL + '/get-country',
            // dataType: 'json',
            data: { type: 'international', selected: country },
            success: function (data) {
                //console.log('Sucess : '+data);
                $('#package_dest_country').html('').html(data);
            },
            error: function (data) {
                //console.log('Error : '+data);
            }
        });
    } else {
        $.ajax({
            type: 'POST',
            url: APP_URL + '/get-country',
            // dataType: 'json',
            data: { type: 'domestic', selected: country },
            success: function (data) {
                //console.log('Sucess : '+data,);
                $('#package_dest_country').html('').html(data);
            },
            error: function (data) {
                //console.log('Error : '+data);
            }
        });
    }
}

function init_package_dist_city() {
    var country = $('#package_country').val().split(',');
    var city = $('#package_country_city').val().split(',');
    $.ajax({
        type: 'POST',
        url: APP_URL + '/get-locations',
        // dataType: 'json',
        data: { state: country, selected: city, cotegory: $('#category').val() },
        success: function (data) {
            console.log('Sucess : '+data);
            $('#package_location_city').html('').html(data);
        },
        error: function (data) {
            console.log('Error : '+data);
        }
    });
}

/*---------new function starts (not working with document ready)------------*/

/*function init_package_category() {
    // Get the selected country value
    var country = $('#country').val(); 
    
    // Handle case where country is not selected
    if (!country) {
        console.error('No country selected.');
        return;
    }

    var countryArray = country.split(','); // Split if expecting multiple countries

    // Determine if it's international or domestic based on some condition
    var requestData = {
        type: (country === 'international') ? 'international' : 'domestic', 
        selected: countryArray
    };

    // Make the AJAX request to fetch the country or state based on the selection
    $.ajax({
        type: 'POST',
        url: APP_URL + '/get-country',  // Assuming this route handles both cases
        data: requestData,
        success: function (data) {
            // Update the package destination country dropdown or state
            $('#state').html('').html(data); // Assuming the response contains the states
        },
        error: function (data) {
            console.error('Error fetching states:', data);
        }
    });
}

$(document).ready(function() {
    // Initialize the package category on document ready
    init_package_category();

    // Attach an event handler for when the country selection changes
    $('#country').on('change', function() {
        init_package_category(); // Re-run the function when the country changes
    });
});*/


/*function init_package_dist_city() {
    // Get the value of the selected country
    var country = $('#package_country').val();
    console.log('Selected country:', country);

    var city = $('#package_country_city').val();

    // Check if a country is selected
    if (!country) {
        console.error('No country selected.');
        return;  // Exit the function if no country is selected
    }

    // Proceed with AJAX if a country is selected
    $.ajax({
        type: 'POST',
        url: APP_URL + '/get-locations',
        data: { 
            state: country.split(','), // Split the country values if multiple are selected
            selected: city ? city.split(',') : [],  // Handle multiple cities, or default to an empty array
            category: $('#category').val() // Pass the category value
        },
        success: function (data) {
            $('#package_location_city').html('').html(data);
        },
        error: function (data) {
            console.error('Error:', data);
        }
    });
}

$(document).ready(function() {
    $('#package_country').change(function() {
        init_package_dist_city();
    });
});*/

/*---------new function ends------------*/



function init_paymentpolicy() {
    var condition = '';
    var id = '';
    $(".paymentMethods").each(function () {
        if ($(this).is(':checked')) {
            condition += $(this).val();
            condition += '\n';
            id += $(this).attr('lang');
            id += ',';
        }
    });
    $('#payment_policies').val(condition);
    $('#payment_policies_input').val(id);
}

function init_visapolicy() {
    var condition = '';
    var id = '';
    $(".visaMethods").each(function () {
        if ($(this).is(':checked')) {
            condition += $(this).val();
            condition += '\n';
            id += $(this).attr('lang');
            id += ',';
        }
    });
    $('#visa_policies').val(condition);
    $('#visa_policies_input').val(id);
}

function init_cancelpolicy() {
    var conditionC = '';
    var idC = '';
    $(".cancellation").each(function () {
        if ($(this).is(':checked')) {
            conditionC += $(this).val();
            conditionC += '\n';
            idC += $(this).attr('lang');
            idC += ',';
        }
    });
    $('#cancle_policy').val(conditionC);
    $('#cancellation_input_field').val(idC);
}

//**********************

// package info (selection of country, state and city)--old, can remove if not working in quote
// country selection
function myFunction(selectObject) {
    var c_id = $('option:selected', selectObject).attr('c_id');
    var country_id = c_id;
    var id = selectObject.id;
    var city_blank = "city_" + id;
    $.ajax({
        type: 'POST',
        url: APP_URL + '/state_url',
        // dataType: 'json',
        data: { country_id: country_id },
        success: function (data) {
            console.log('Sucess : ' + data,);
            //alert(class_country);
            $('.' + city_blank + '').html('<option>Select City</option>');
            $('.' + id + '').html('').html(data);
        },
        error: function (data) {
            console.log('Error : ' + data);
        }
    });
}

// state selection
function sateFunction(selectValue) {
    var s_id = $('option:selected', selectValue).val()
    var state_id = s_id;
    var id = selectValue.id;
    $.ajax({
        type: 'POST',
        url: APP_URL + '/city_url',
        // dataType: 'json',
        data: { state_id: state_id },
        success: function (data) {
            console.log('Sucess : ' + data,);
            //alert(class_country);
            $('.' + id + '').html('').html(data);
        },
        error: function (data) {
            console.log('Error : ' + data);
        }
    });
}

// city selection
function cityFunction() {
    var values = [];
    $("select.min-select").each(function (i, sel) {
        var selectedVal = $(sel).val();
        values.push(selectedVal);
    });
    var length = values.length;
    var i;
    var data = ""
    for (i = 0; i < length; i++) {
        data += "<option value=" + values[i] + ">" + values[i] + "</option>"
    }
    activity_and_sightseeing()
    $(".dayItineraryCity").html(data);
}

//**********************

// package info (selection of country, state and city)
function selectCountry(selectObject) {
    var c_id = $('option:selected', selectObject).attr('c_id');
    var country_id = c_id;
    var id = selectObject.id;
    var city_blank = "city_" + id;
    $.ajax({
        type: 'POST',
        url: APP_URL + '/state_url',
        // dataType: 'json',
        data: { country_id: country_id },
        success: function (data) {
            console.log('Sucess : ' + data,);
            //alert(class_country);
            $('.' + city_blank + '').html('<option>Select City</option>');
            $('.' + id + '').html('').html(data);
        },
        error: function (data) {
            console.log('Error : ' + data);
        }
    });
}


function selectState(selectValue) {
    var s_id = $('option:selected', selectValue).val()
    var state_id = s_id;
    var id = selectValue.id;
    $.ajax({
        type: 'POST',
        url: APP_URL + '/city_url',
        // dataType: 'json',
        data: { state_id: state_id },
        success: function (data) {
            console.log('Sucess : ' + data,);
            //alert(class_country);
            $('.' + id + '').html('').html(data);
        },
        error: function (data) {
            console.log('Error : ' + data);
        }
    });
}

//
function selectCity() {
    var values = [];
    $("select.min-select").each(function (i, sel) {
        var selectedVal = $(sel).val();
        values.push(selectedVal);
    });
    var length = values.length;
    var i;
    var data = ""
    for (i = 0; i < length; i++) {
        data += "<option value=" + values[i] + ">" + values[i] + "</option>"
    }
    activity_and_sightseeing()
    $(".dayItineraryCity").html(data);
}

//**********************

//gallery part
function getstate(selectObject) {
    var country_value = $(".gallery_country").val();
    //var state_value=$(".gallery_state").val();
    //var city_value=$(".gallery_city").val();
    var search_by_name = $(".search_by_name").val();
    $.ajax({
        type: 'POST',
        url: APP_URL + '/country_sorting',
        // dataType: 'json',
        data: { country: country_value, search_by_name: search_by_name },
        success: function (data) {
            console.log('Sucess : ' + data,);
            //alert(class_country);
            $("#gallery_sorting").html('').html(data);
        },
        error: function (data) {
            console.log('Error : ' + data);
        }
    });
    
    //
    var c_id = $('option:selected', selectObject).attr('c_id');
    var country_id = c_id;
    var id = selectObject.id;
    var city_blank = "city_" + id;
    $.ajax({
        type: 'POST',
        url: APP_URL + '/state_url',
        // dataType: 'json',
        data: { country_id: country_id },
        success: function (data) {
            //console.log('Sucess : '+data,);
            //alert(class_country);
            $('.gallery_city').html('<option>Select City</option>');
            $(".gallery_state").html('').html(data);
        },
        error: function (data) {
            console.log('Error : ' + data);
        }
    });
}

function getcity(selectValue) {
    var country_value = $(".gallery_country").val();
    var state_value = $(".gallery_state").val();
    //var city_value=$(".gallery_city").val();
    var search_by_name = $(".search_by_name").val();
    $.ajax({
        type: 'POST',
        url: APP_URL + '/state_sorting',
        // dataType: 'json',
        data: { country: country_value, state: state_value, search_by_name: search_by_name },
        success: function (data) {
            console.log('Sucess : ' + data,);
            //alert(class_country);
            $("#gallery_sorting").html('').html(data);
        },
        error: function (data) {
            console.log('Error : ' + data);
        }
    })
    //
    var s_id = $('option:selected', selectValue).val()
    var state_id = s_id;
    var id = selectValue.id;
    $.ajax({
        type: 'POST',
        url: APP_URL + '/city_url',
        // dataType: 'json',
        data: { state_id: state_id },
        success: function (data) {
            console.log('Sucess : ' + data,);
            //alert(class_country);
            $(".gallery_city").html('').html(data);
        },
        error: function (data) {
            console.log('Error : ' + data);
        }
    });
}

//
function getcity_value(selectValue) {
    var country_value = $(".gallery_country").val();
    var state_value = $(".gallery_state").val();
    var city_value = $(".gallery_city").val();
    var search_by_name = $(".search_by_name").val();
    $.ajax({
        type: 'POST',
        url: APP_URL + '/city_sorting',
        // dataType: 'json',
        data: { country: country_value, state: state_value, city: city_value, search_by_name: search_by_name },
        success: function (data) {
            console.log('Sucess : ' + data,);
            //alert(class_country);
            $("#gallery_sorting").html('').html(data);
        },
        error: function (data) {
            console.log('Error : ' + data);
        }
    });
}

//
function get_states(selectObject) {
    var c_id = $('option:selected', selectObject).attr('c_id');
    var country_id = c_id;
    $.ajax({
        type: 'POST',
        url: APP_URL + '/state_url',
        // dataType: 'json',
        data: { country_id: country_id },
        success: function (data) {
            //console.log('Sucess : '+data,);
            //alert(class_country);
            $('.ct_values').html('<option>Select City</option>');
            $(".st_values").html('').html(data);
        },
        error: function (data) {
            console.log('Error : ' + data);
        }
    });
}

function getcitys(selectValue) {
    //
    var s_id = $('option:selected', selectValue).val()
    var state_id = s_id;
    var id = selectValue.id;
    $.ajax({
        type: 'POST',
        url: APP_URL + '/city_url',
        // dataType: 'json',
        data: { state_id: state_id },
        success: function (data) {
            console.log('Sucess : ' + data,);
            //alert(class_country);
            $(".ct_values").html('').html(data);
        },
        error: function (data) {
            console.log('Error : ' + data);
        }
    });
}

//
function get_state(selectObject) {
    var c_id = $('option:selected', selectObject).attr('c_id');
    var country_id = c_id;
    var id = selectObject.id;
    var city_blank = "city_" + id;
    $.ajax({
        type: 'POST',
        url: APP_URL + '/state_url',
        // dataType: 'json',
        data: { country_id: country_id },
        success: function (data) {
            //console.log('Sucess : '+data,);
            //alert(class_country);
            $('.city_val').html('<option>Select City</option>');
            $(".state_val").html('').html(data);
        },
        error: function (data) {
            console.log('Error : ' + data);
        }
    });
}

function get_city(selectValue) {
    var s_id = $('option:selected', selectValue).val()
    var state_id = s_id;
    var id = selectValue.id;
    $.ajax({
        type: 'POST',
        url: APP_URL + '/city_url',
        // dataType: 'json',
        data: { state_id: state_id },
        success: function (data) {
            console.log('Sucess : ' + data,);
            //alert(class_country);
            $(".city_val").html('').html(data);
        },
        error: function (data) {
            console.log('Error : ' + data);
        }
    });
}

//
function activity_and_sightseeing() {
    var cities_list = new Array();
    $('.package_dest_cities').each(function (i) {
        cities_list.push($(this).val());
    });
    // console.log(cities_list)
    $.ajax({
        type: 'get',
        url: APP_URL + '/get_activitieslist',
        // dataType: 'json',
        data: { cities_list: cities_list },
        success: function (data) {
            console.log('Sucess : ' + data,);
            //alert(class_country);
            $(".dayItineraryactivity").html("").html(data)
        },
        error: function (data) {
            console.log('Error : ' + data);
        }
    });
}









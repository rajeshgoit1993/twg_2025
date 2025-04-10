    <!-- Javascript -->

    <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.js" crossorigin="anonymous"></script> -->

    <!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" crossorigin="anonymous"></script> -->

    <!-- jQuery 2.1.3 -->
    <!-- <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/admin-lte/plugins/jQuery/jquery-2.2.3.min.js")); ?>'></script> -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap 3.3.2 JS -->
    <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/admin-lte/bootstrap/js/bootstrap.min.js")); ?>'></script>

    <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/admin-lte/dist/js/select2.js")); ?>'></script>

    <!-- AdminLTE App -->
    <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/admin-lte/dist/js/app.min.js")); ?>'></script>

    <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/admin-lte/plugins/datatables/jquery.dataTables.min.js")); ?>'></script>

    <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/admin-lte/plugins/datatables/dataTables.bootstrap.min.js")); ?>'></script>
    
    <!-- SlimScroll -->
    <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js")); ?>'></script>
    
    <!-- FastClick -->
    <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/admin-lte/plugins/fastclick/fastclick.js")); ?>'></script>
    
    <!-- AdminLTE for demo purposes -->
    <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/admin-lte/dist/js/demo.js")); ?>'></script>
   
    <script type="text/javascript" src='https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js' crossorigin="anonymous"></script>
    
    <script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js' crossorigin="anonymous"></script>
    
    <script type="text/javascript" src='https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js' crossorigin="anonymous"></script>
    
    <script type="text/javascript" src='https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js' crossorigin="anonymous"></script>
    
    <script type="text/javascript" src='https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js' crossorigin="anonymous"></script>
    
    <script type="text/javascript" src='https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js' crossorigin="anonymous"></script>
    
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnT6ewhJpccffkJRlbAPyCQeQKJxJfLQ8&libraries=places" crossorigin="anonymous"></script>
    
    <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/frontend/js/bootstrap-formhelpers.min.js")); ?>'></script>
    
    <script type="text/javascript" src='https://adminlte.io/themes/AdminLTE/plugins/timepicker/bootstrap-timepicker.min.js' crossorigin="anonymous"></script>
 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.js" crossorigin="anonymous"></script>
    
    <script type="text/javascript" src="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.js" crossorigin="anonymous"></script>
    
    <script type="text/javascript" src="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js" crossorigin="anonymous"></script>

    <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/js/hotel/hotel.js")); ?>'></script>
    
    <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/js/room/room.js")); ?>'></script>
    
    <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/admin-lte/ckeditor/ckeditor.js")); ?>'></script>
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.js" crossorigin="anonymous"></script>


    
    <!-- tour package and tour quote -->
    <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/js/packages/packages.js")); ?>'></script>

    
    
    <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/js/packages/query.js")); ?>'></script>
    <!--<script type="text/javascript" src='<?php echo e(asset ("/resources/assets/admin-lte/dist/js/select2.js")); ?>'></script> -->
    <!-- Optionally, you can add Slimscroll and FastClick plugins.Both of these plugins are recommended to enhance the user experience -->

    <!-- swal -->
    <script type="text/javascript" src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <?php echo $__env->yieldContent('custom_js_code'); ?>

    <script type="text/javascript">
    jQuery(document).ready(function() {

        // Initial function to fetch notifications
        get_notification();

        // Set an interval to fetch notifications every 5 seconds
        var refreshId = setInterval(get_notification, 5000);

        function get_notification() {
            var APP_URL = $("#APP_URL").val() || $('meta[name="app_url"]').attr('content'); // Fallback if input doesn't exist

            if (!APP_URL) {
                console.error('APP_URL is not defined');
                return;
            }

            $.ajax({
                url: APP_URL + '/get_notification',
                type: 'GET',
                data: { id: 'na' },
                success: function (data) {
                    if (data && typeof data === 'object') {
                        $(".total_notification").html(data.notification_count || '0');
                        $(".notification_data").html(data.notification_link || '');
                    } else {
                        console.error('Invalid response format', data);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching notifications:', xhr.responseText || status, error);
                }
            });
        }

        //**********************

        // Initialize DataTable with export buttons
        var table = jQuery('.example1').DataTable({
            dom: 'Bfrtip',
            buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5', 'print'],
            "bPaginate": true // Enable pagination
        });

        // Initialize select2 for select elements
        jQuery('.select2').select2(); // Simple select2 initialization

        // Initialize select3 with AJAX for fetching cities
        $('.select3').select2({
            ajax: {
                url: $("#APP_URL").val() + '/get_cities', // Endpoint to fetch cities
                type: "post",
                dataType: 'json',
                delay: 250, // Delay for AJAX request
                data: function(params) {
                    return {
                        searchTerm: params.term // Search term to send with the request
                    };
                },
                processResults: function(response) {
                    return {
                        results: response // Process and return the results
                    };
                },
                cache: true // Cache the results for future requests
            }
        });

        //**********************

        // Initialize select4 with AJAX for fetching countries
        $('.select4').select2({
            ajax: {
                url: $("#APP_URL").val() + '/get_country', // Endpoint to fetch countries
                type: "post",
                dataType: 'json',
                delay: 250, // Delay for AJAX request
                data: function(params) {
                    return {
                        searchTerm: params.term // Search term to send with the request
                    };
                },
                processResults: function(response) {
                    return {
                        results: response // Process and return the results
                    };
                },
                cache: true // Cache the results for future requests
            }
        });

        // Initialize datepicker with autoclose and custom date format
        jQuery('.datepicker').datepicker({
            autoclose: true, // Close the datepicker automatically after selection
            dateFormat: 'dd-mm-yy' // Set the date format to 'dd-mm-yy'
        });
    });
    </script>   

    <?php echo $__env->yieldContent("custom_js_code_second"); ?>



    <!-- dashboard menu bar -->
    <script>
        // Function to start the clock
        function startTime() {
            var today = new Date(); // Get the current date and time
            var h = today.getHours(); // Get current hours
            var m = today.getMinutes(); // Get current minutes
            var s = today.getSeconds(); // Get current seconds
            
            m = checkTime(m); // Format minutes to ensure two digits
            s = checkTime(s); // Format seconds to ensure two digits
            
            // Display the time in the element with id 'txt'
            document.getElementById('txt').innerHTML = h + ":" + m + ":" + s;
            
            // Set a timeout to update the time every 500 milliseconds
            t = setTimeout(function() { startTime() }, 500);
        }

        // Function to add a leading zero to numbers less than 10
        function checkTime(i) {
            if (i < 10) {
                i = "0" + i;
            }
            return i;
        }
    </script>

    <!-- important (view history) -->
    <script type="text/javascript">
        // Set up AJAX to include the CSRF token in the header of all requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name=_token]').attr('content')
            }
        });
    </script>

    <!-- where this script is used, pls check -->
    <script type="text/javascript">
        jQuery(document).ready(function() {
            // Store the active tab in local storage when a tab is clicked
            jQuery('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
                localStorage.setItem('activeTab', jQuery(e.target).attr('href'));
            });

            // Retrieve the active tab from local storage and show it
            var activeTab = localStorage.getItem('activeTab');
            if (activeTab) {
                jQuery('a[href="' + activeTab + '"]').tab('show');
            }
        });
    </script>

    <script type="text/javascript">
        jQuery(document).ready(function() {
            // Bind keypress and keyup events to update commission values
            jQuery('.default_commission').bind('keypress keyup', function() {
                jQuery(".sellCommissionSingle").val(jQuery(this).val());
                jQuery(".sellCommissionDouble").val(jQuery(this).val());
                jQuery(".sellCommissionTriple").val(jQuery(this).val());
                jQuery(".extraCommissionAdult").val(jQuery(this).val());
                jQuery(".extraCommissionChild").val(jQuery(this).val());
                jQuery(".extraCommissionInfrant").val(jQuery(this).val());
            });

            // Calculate and update discounted prices based on commission rates
            jQuery('.Calculate').click(function() {
                var default_commission = jQuery(".default_commission").val();
                var sellCommissionSingle = jQuery(".sellCommissionSingle").val();
                var sellCommissionDouble = jQuery(".sellCommissionDouble").val();
                var sellCommissionTriple = jQuery(".sellCommissionTriple").val();
                var extraCommissionAdult = jQuery(".extraCommissionAdult").val();
                var extraCommissionChild = jQuery(".extraCommissionChild").val();
                var extraCommissionInfrant = jQuery(".extraCommissionInfrant").val();

                var Singleprice = jQuery(".Single").val();
                var Doubleprice = jQuery(".Double").val();
                var Tripleprice = jQuery(".Triple").val();
                var Extra_Adult = jQuery(".Extra_Adult").val();
                var Extra_Child = jQuery(".Extra_Child").val();
                var Extra_Infant = jQuery(".Extra_Infant").val();

                var calcSinglePrice = (Singleprice - (Singleprice * sellCommissionSingle / 100)).toFixed(2);
                var calcDoublePrice = (Doubleprice - (Doubleprice * sellCommissionDouble / 100)).toFixed(2);
                var calcTriplePrice = (Tripleprice - (Tripleprice * sellCommissionTriple / 100)).toFixed(2);
                var calcExtra_Adult = (Extra_Adult - (Extra_Adult * extraCommissionAdult / 100)).toFixed(2);
                var calcExtra_Child = (Extra_Child - (Extra_Child * extraCommissionChild / 100)).toFixed(2);
                var calcExtra_Infant = (Extra_Infant - (Extra_Infant * extraCommissionInfrant / 100)).toFixed(2);

                jQuery(".discountSingle").val(calcSinglePrice);
                jQuery(".discountDouble").val(calcDoublePrice);
                jQuery(".discountTriple").val(calcTriplePrice);
                jQuery(".Nett_Extra_Adult").val(calcExtra_Adult);
                jQuery(".Nett_Extra_Child").val(calcExtra_Child);
                jQuery(".Nett_Extra_Infant").val(calcExtra_Infant);
            });
        });
    </script>

    <!-- where this script is used, pls check -->
    <script type="text/javascript">
        $(document).ready(function() {
            //moment.locale('tr'); // Set moment.js locale to Turkish

            var date = new Date();
            var bugun = moment(date).format("DD/MM/YYYY"); // Format current date to DD/MM/YYYY

            var date_input = $('input[name="date"]'); // Get the date input field
            var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body"; // Determine container

            // Datepicker options
            var options = {
                // startDate: '+1d', // Uncomment to set a start date
                // endDate: '+0d', // Uncomment to set an end date
                container: container,
                todayHighlight: true,
                autoclose: true,
                format: 'dd/mm/yyyy' // Set date format
                // defaultDate: moment().subtract(15, 'days') // Uncomment to set a default date
                // setStartDate : "<DATETIME STRING HERE>" // Uncomment to set a specific start date
            };

            // Set the input value to today's date and initialize datepicker
            date_input.val(bugun);
            date_input.datepicker(options);
        });
    </script>
<?php $__env->startSection('content'); ?>

    <!-- Linking the fullcalendar stylesheet -->
    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/resources/assets/frontend/css/fullcalendar.min.css" />

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">

            <!-- Row containing the main content -->
            <div class="row">

                <!-- Column for the content box -->
                <div class="col-md-12">
                    <div class="box">

                        <!-- Box header -->
                        <div class="box-header">
                            <!-- Optional header content can be added here -->
                        </div>
                        <!-- /.box-header -->

                        <!-- Box body -->
                        <div class="box-body">

                            <!-- Success message container, hidden by default -->
                            <div class="alert alert-success success-contaier-parent-hotel" id="success-contaier-parent-hotel" style="display:none">
                                <p>Gateway deleted successfully.</p>
                            </div>

                            <!-- Error message container, hidden by default -->
                            <div class="alert alert-danger error-contaier-parent-hotel" style="display:none">
                                <ul class="error-contaier-hotel" id="error-contaier-hotel"> </ul>
                            </div>

                            <!-- Row with flexbox for alignment -->
                            <div class="row makeflex aligncenter form-group">
                                
                                <!-- Column for the title -->
                                <div class="col-md-6">
                                    <h4 class="box-title">Booking Calendar</h4>
                                </div>

                                <!-- Search bar (commented out) -->
                                <!-- 
                                <div class="col-md-6">
                                    <input type="text" id="searchsupplier" class="form-control" placeholder="Search... By Name, City or Country">
                                </div> 
                                -->

                            </div>

                            <!-- Custom styles for calendar events -->
                            <style type="text/css">
                                .fc-event {
                                    font-size: 1em !important;
                                    color: blue;
                                }
                                .fc-title {
                                    cursor: pointer;
                                }
                            </style>

                            <!-- Calendar container -->
                            <div class="col-md-12">
                                <div id="calendar">
                                    <!-- Calendar will be loaded here -->
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->

                    </div>
                </div>

            </div>
            <!-- /.row -->

            <!-- Modal can be added here if necessary -->

        </section>
        <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->

    <!-- Hidden input for testing URL -->
    <div class="testing">
        <input type="hidden" value="<?php echo e(url('/')); ?>" id="test">
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom_js_code'); ?>

<script src="https://code.jquery.com/jquery-2.2.4.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript" src='http://localhost:8585/twg_old_01_11/resources/assets/frontend/js/moment.min.js'></script>

<script type="text/javascript" src="<?php echo e(url('/')); ?>/resources/assets/frontend/js/fullcalendar.js"></script>

<script type="text/javascript">

$(document).ready(function() {
    // Initialize a new date object and set it to one day in the past
    var date = new Date();
    date.setDate(date.getDate() - 1);

    // Define the URL to fetch booking calendar data
    var url = APP_URL + '/get_booking_cal_data';

    // Initialize the FullCalendar with custom settings
    $('#calendar').fullCalendar({
        // Restrict the calendar to display only dates from today onwards
        validRange: {
            start: date
        },

        // Customize the header layout with navigation buttons
        header: {
            left: 'prev, today',
            center: 'title',
            right: 'next'
        },

        // Disable the display of event times
        displayEventTime: false,

        // Set the source for events
        events: url,

        // Customize the event rendering process
        eventRender: function(event, element, view) {
            // Prepend an anchor link to the event title
            element.find('.fc-title').prepend('<a href="' + event.unique_code + '" target="_blank"></a>');
        }
    });
});

// Handle click event on calendar titles
$(document).on("click", ".fc-title", function() {
    // Get the href attribute of the anchor inside the clicked title
    var link = $(this).children('a').attr("href");

    // Construct the URL for quotes and open it in a new tab
    var url = APP_URL + '/quotes/' + link;
    window.open(url, '_blank');
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('content'); ?>

<style>
.coupon-container {
  box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.2);
  border: 1px solid #e9e9e9;
  border-radius: 10px;
  padding: 30px;
  margin-bottom: 20px;
  display: block;
  margin-top: 10px;
}
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">                
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">Add New Coupon</h3>
                  </div>
                  <div class="box-body">
                    <!-- Success and Error Messages -->
                    <?php if(session('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo e(session('success')); ?>

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <?php if(session('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo e(session('error')); ?>

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <!-- Back Button -->
                    <a href="<?php echo e(URL::to('/Coupon')); ?>" class="btn btn-success">
                      <i class="glyphicon glyphicon-arrow-left"></i> Back to Coupon List
                    </a>
                      <div class="coupon-container">
                        <!-- Form to Add a New Coupon -->
                        <form action="<?php echo e(URL::to('/store_coupon')); ?>" method="post" enctype="multipart/form-data">
                            <!-- Hidden Fields and CSRF Token -->
                            <input type="hidden" name="type" />
                            <?php echo e(csrf_field()); ?>

                            <br>

                            <div class="row">
                                <!-- Coupon Name Field -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="coupon_name" class="control-label">Coupon Name</label>
                                        <input type="text" name="coupon_name" class="form-control" placeholder="Enter the Coupon Name" required>
                                        <span class="error"><?php echo e($errors->first("coupon_name")); ?></span>
                                    </div>
                                </div>

                                <!-- Coupon Description Field -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="coupon_desc" class="control-label">Coupon Short Description</label>
                                        <input type="text" name="coupon_desc" class="form-control" placeholder="Enter the Coupon Description" required>
                                        <span class="error"><?php echo e($errors->first("coupon_desc")); ?></span>
                                    </div>
                                </div>

                                <div class="col-md-12"></div>

                                <!-- Coupon Code Field -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="coupon_code" class="control-label">Coupon Code</label>
                                        <input type="text" name="coupon_code" class="form-control" placeholder="Enter Unique Coupon Code" required>
                                        <span class="error"><?php echo e($errors->first("coupon_code")); ?></span>
                                    </div>
                                </div>

                                 <div class="col-md-12"></div>

                                <!-- Coupon Type Field -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="type" class="control-label">Coupon Value Type</label>
                                        <select name="type" class="form-control" required>
                                            <option value="" disabled>Select</option>
                                            <option value="Percentage" selected>Percentage</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Discount Value Field -->
                                <!-- <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="value" class="control-label">Discount Value</label>
                                        <input type="text" name="value" class="form-control" placeholder="Enter Discount Value">
                                        <span class="error"><?php echo e($errors->first("value")); ?></span>
                                    </div>
                                </div> -->

                                <!-- Discount Value Field -->
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <label for="value" class="control-label">Coupon Value</label>
                                    <select name="value" class="form-control">
                                      <option value="" disabled>Select</option>
                                      <?php for($i = 1; $i <= 15; $i++): ?>
                                        <option value="<?php echo e($i); ?>" <?php echo e(old('value') == $i ? 'selected' : ''); ?>><?php echo e($i); ?> %</option>
                                      <?php endfor; ?>
                                    </select>
                                    <span class="error"><?php echo e($errors->first("value")); ?></span>
                                  </div>
                                </div>

                                <div class="col-md-12"></div>

                                <!-- Start Date Field -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="start_date" class="control-label">Coupon Start Date</label>
                                        <input type="text" name="start_date" class="form-control coupon_datepicker" placeholder="Select Start Date">
                                        <span class="error"><?php echo e($errors->first("start_date")); ?></span>
                                    </div>
                                </div>

                                <!-- End Date Field -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="end_date" class="control-label">Coupon End Date</label>
                                        <input type="text" name="end_date" class="form-control coupon_datepicker" placeholder="Select End Date">
                                        <span class="error"><?php echo e($errors->first("end_date")); ?></span>
                                    </div>
                                </div>

                                <div class="col-md-12"></div>

                                <!-- Status Field -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="status" class="control-label">Coupon Status</label>
                                        <select name="status" class="form-control">
                                            <option value="1">Enabled</option>
                                            <option value="0">Disabled</option>
                                        </select>
                                        <span class="error"><?php echo e($errors->first("status")); ?></span>
                                    </div>
                                </div>

                                <!-- Applicable For Field -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="applicable_for" class="control-label">Coupon applicable on</label>
                                        <select name="applicable_for" class="form-control applicable_for" required>
                                            <option value="" selected disabled>Select</option>
                                            <option value="1">All</option>
                                            <option value="2">All Tour Quotes</option>
                                            <option value="3">All Tour Packages</option>
                                            <option value="4">Specific Tour Quotes</option>
                                            <option value="5">Specific Tour Packages</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12"></div>

                                <!-- Dynamic Data Placeholder -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="dynamic_data">
                                            <!-- Placeholder for dynamic content from couponcontroller -->
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                  <!-- Submit Button -->
                                  <div class="form-group">
                                    <button type="submit" name="add" id="remove" class="btn btn-primary">Save Coupon <i class="fa fa-arrow-right"></i></button>
                                  </div>
                                </div>
                            </div>
                        </form>
                      </div>
                  </div>
                  <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<script src="https://code.jquery.com/jquery-2.2.4.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript" src='<?php echo e(url("resources/assets/js/packages/quote1.js")); ?>'></script>

<script type="text/javascript">
$(document).ready(function() {
  // Initialize datepickers with common options
  $('.coupon_datepicker').datepicker({
    format: 'dd-mm-yyyy',
    autoclose: true,
    todayHighlight: true,
    startDate: '0d' // Prevents past dates
  });

  // Set initial minimum date for the end date if start date is already set
  var initialStartDate = $('input[name="start_date"]').datepicker('getDate');
  if (initialStartDate) {
    $('input[name="end_date"]').datepicker('setStartDate', initialStartDate);
  }

  // Add event listener for start date change
  $('input[name="start_date"]').on('changeDate', function(selected) {
    var startDate = $(this).datepicker('getDate'); // Get selected start date
    $('input[name="end_date"]').datepicker('setStartDate', startDate); // Set as minimum date for end date
  });

  // Optional: Reset end date if start date is cleared
  $('input[name="start_date"]').on('clearDate', function() {
    $('input[name="end_date"]').datepicker('setStartDate', '0d'); // Reset to today's date as minimum
  });
});
</script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom_js_code'); ?>

<script type="text/javascript">
// Listen for change events on the .applicable_for select element
$(document).on("change", ".applicable_for", function() {
    // Get the selected value of the applicable_for field
    var applicable_for = $(this).val();
    // Retrieve the base URL stored in the APP_URL hidden input
    var APP_URL = $("#APP_URL").val();

    // Make an AJAX GET request to fetch applicable coupon data based on selection
    $.ajax({
        url: APP_URL + '/get_coupon_applicable_for',  // Endpoint to retrieve coupon applicability data
        data: { applicable_for: applicable_for },      // Data to send: selected applicable_for value
        type: 'get',                                   // HTTP method

        success: function(data) {
            // Populate .dynamic_data div with the received data and reinitialize select2 elements
            $(".dynamic_data").html('').html(data);
            $(".select2").select2();  // Initialize select2 for enhanced UI
            console.log(data);        // Log the received data for debugging
        },
        
        error: function(data) {
            // Optional: handle error response here
            console.error("Error fetching coupon applicable data");
        }
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
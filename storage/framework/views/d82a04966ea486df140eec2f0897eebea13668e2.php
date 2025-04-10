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

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Main Content -->
  <section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- Edit Coupon Box -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Edit Coupon</h3>
                </div>
                <!-- Box Body -->
                <div class="box-body">
                    <!-- Back Button -->
                    <a href="<?php echo e(URL::to('/Coupon')); ?>" class="btn btn-success">
                        <i class="glyphicon glyphicon-arrow-left"></i> Back to Coupon List
                    </a>
                    <!-- <?php if(Session::has('success')): ?>
                    <div class="alert alert-warning alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                      <?php echo e(Session::get('success')); ?>

                    </div>
                    <?php endif; ?> -->

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
                    
                    <div class="coupon-container">
                        <!-- Form to Update Coupon -->
                        <form action="<?php echo e(URL::to('/Update-Coupon/' . $coupon->id)); ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="type" />
                            <?php echo e(csrf_field()); ?>


                            <br>
                            <div class="row">
                                <!-- Coupon Name Input -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label" for="coupon_name">Coupon Name</label>
                                        <input type="text" name="coupon_name" value="<?php echo e($coupon->coupon_name); ?>" class="form-control" placeholder="Enter Coupon Name" required>
                                        <span class="error"><?php echo e($errors->first("coupon_name")); ?></span>
                                    </div>
                                </div>

                                <!-- Coupon Description Input -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label" for="coupon_desc">Coupon Short Description</label>
                                        <input type="text" name="coupon_desc" value="<?php echo e($coupon->coupon_desc); ?>" class="form-control" placeholder="Enter Coupon Desc" required>
                                        <span class="error"><?php echo e($errors->first("coupon_desc")); ?></span>
                                    </div>
                                </div>

                                <div class="col-md-12"></div>

                                <!-- Coupon Code Input -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label" for="coupon_code">Coupon Code</label>
                                        <input type="text" name="coupon_code" value="<?php echo e($coupon->coupon_code); ?>" class="form-control" placeholder="Enter Coupon Code" required>
                                        <span class="error"><?php echo e($errors->first("coupon_code")); ?></span>
                                    </div>
                                </div>

                                <div class="col-md-12"></div>

                                <!-- Coupon Type Dropdown -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label" for="type">Value Type</label>
                                        <select name="type" class="form-control" required>
                                            <option value="" disabled>Select</option>
                                            <option value="Percentage" <?php if($coupon->type == 'Percentage'): ?> selected <?php endif; ?>>Percentage</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Value Input -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label" for="value">Coupon Value</label>
                                        <select name="value" class="form-control">
                                            <option value="" disabled>Select</option>
                                            <?php for($i = 1; $i <= 15; $i++): ?>
                                                <option value="<?php echo e($i); ?>" <?php echo e($coupon->value == $i ? 'selected' : ''); ?>><?php echo e($i); ?> %</option>
                                            <?php endfor; ?>
                                        </select>
                                        <span class="error"><?php echo e($errors->first("value")); ?></span>
                                    </div>
                                </div>

                                <div class="col-md-12"></div>

                                <!-- Start Date Input -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label" for="start_date">Coupon Start Date</label>
                                        <input type="text" name="start_date" value="<?php echo e(date('d-m-Y', strtotime($coupon->start_date))); ?>" class="form-control coupon_datepicker" placeholder="Enter Start Date">
                                        <span class="error"><?php echo e($errors->first("start_date")); ?></span>
                                    </div>
                                </div>

                                <!-- End Date Input -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label" for="end_date">Coupon End Date</label>
                                        <input type="text" name="end_date" value="<?php echo e(date('d-m-Y', strtotime($coupon->end_date))); ?>" class="form-control coupon_datepicker" placeholder="Enter End Date">
                                        <span class="error"><?php echo e($errors->first("end_date")); ?></span>
                                    </div>
                                </div>

                                <div class="col-md-12"></div>

                                <!-- Status Dropdown -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label" for="status">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="1" <?php if($coupon->status == '1'): ?> selected <?php endif; ?>>Enable</option>
                                            <option value="0" <?php if($coupon->status == '0'): ?> selected <?php endif; ?>>Disable</option>
                                        </select>
                                        <span class="error"><?php echo e($errors->first("status")); ?></span>
                                    </div>
                                </div>

                                <!-- Applicable For Dropdown -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label" for="applicable_for">Coupon applicable on</label>
                                        <select name="applicable_for" class="form-control applicable_for" required>
                                            <option value="" disabled>Select</option>
                                            <option value="1" <?php if($coupon->applicable_for == 1): ?> selected <?php endif; ?>>All</option>
                                            <option value="2" <?php if($coupon->applicable_for == 2): ?> selected <?php endif; ?>>All Tour Quote</option>
                                            <option value="3" <?php if($coupon->applicable_for == 3): ?> selected <?php endif; ?>>All Tour Packages</option>
                                            <option value="4" <?php if($coupon->applicable_for == 4): ?> selected <?php endif; ?>>Special Tour Quote</option>
                                            <option value="5" <?php if($coupon->applicable_for == 5): ?> selected <?php endif; ?>>Special Tour Packages</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Dynamic Data Section -->
                                <div class="col-md-12">
                                    <div class="form-group dynamic_data">
                                        <!-- Dynamic content populated based on applicable_for selection -->
                                        <div class="dynamic_data">
                                            <?php
                                            $output = ''; // Initialize $output as an empty string to avoid undefined variable error
                                            $applicable_for = $coupon->applicable_for;
                                            $all_packages = DB::table('rt_packages')->get();
                                            $quotes = DB::table('option1_quotation')
                                                ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                                                ->where([
                                                    ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                                                    ['option1_quotation.del_status', '=', 1],
                                                    ['option1_quotation.send_option', '=', 1]
                                                ])
                                                ->select('option1_quotation.*', 'rt_package_query.destinations', 'rt_package_query.booking_label')
                                                ->orderBy('created_at', 'desc')
                                                ->get();

                                            // Check applicable_for value and build the output accordingly
                                            if ($applicable_for == 1) {
                                                $output .= '<label class="control-label" for="exclude">Coupon not applicable on</label>
                                                            <select name="exclude[]" class="form-control select2" multiple>
                                                            <option value="">--Choose--</option>';
                                                foreach ($quotes as $quote) {
                                                    $check = DB::table('coupon_include_exclude')->where([['coupon_id', $coupon->id], ['ref_id', "quote_" . $quote->quo_ref]])->first();
                                                    $output .= '<option value="quote_' . $quote->quo_ref . '"' . ($check ? ' selected' : '') . '>' . $quote->package_name . ' (Quote)</option>';
                                                }
                                                foreach ($all_packages as $package) {
                                                    $check = DB::table('coupon_include_exclude')->where([['coupon_id', $coupon->id], ['ref_id', "package_" . $package->id]])->first();
                                                    $output .= '<option value="package_' . $package->id . '"' . ($check ? ' selected' : '') . '>' . $package->title . ' (Package)</option>';
                                                }
                                                $output .= '</select>';
                                            } elseif ($applicable_for == 2) {
                                                // Similar structure for other conditions
                                                $output .= '<label class="control-label" for="exclude">Coupon not applicable on Tour Quotes</label>
                                                            <select name="exclude[]" class="form-control select2" multiple>
                                                            <option value="">--Choose--</option>';
                                                foreach ($quotes as $quote) {
                                                    $check = DB::table('coupon_include_exclude')->where([['coupon_id', $coupon->id], ['ref_id', "quote_" . $quote->quo_ref]])->first();
                                                    $output .= '<option value="quote_' . $quote->quo_ref . '"' . ($check ? ' selected' : '') . '>' . $quote->package_name . ' (Quote)</option>';
                                                }
                                                $output .= '</select>';
                                            } elseif ($applicable_for == 3) {
                                                // Similar structure for other conditions
                                                $output .= '<label class="control-label" for="exclude">Coupon not applicable on Tour Packages</label>
                                                            <select name="exclude[]" class="form-control select2" multiple>
                                                            <option value="">--Choose--</option>';
                                                foreach ($all_packages as $package) {
                                                    $check = DB::table('coupon_include_exclude')->where([['coupon_id', $coupon->id], ['ref_id', "package_" . $package->id]])->first();
                                                    $output .= '<option value="package_' . $package->id . '"' . ($check ? ' selected' : '') . '>' . $package->title . ' (Package)</option>';
                                                }
                                                $output .= '</select>';
                                            }
                                            // More conditions as needed...

                                            // Echo the output for dynamic data
                                            echo $output;
                                            ?>
                                        </div>
                                    </div>
                                </div>                            

                                <div class="col-md-12">
                                  <!-- Submit Button -->
                                  <div class="form-group">
                                    <button type="submit" name="add" id="remove" class="btn btn-primary">Update Coupon <i class="fa fa-arrow-right"></i></button>
                                  </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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
$(document).on("change",".applicable_for",function() {
  var applicable_for=$(this).val()
  var APP_URL=$("#APP_URL").val()
  $.ajax({
    url:APP_URL+'/get_coupon_applicable_for',
    data:{applicable_for:applicable_for},
    type:'get',
    // contentType: false,
    // processData: false,
    success:function(data)
    {
    $(".dynamic_data").html('').html(data)
    $(".select2").select2()
    console.log(data)
    },
    error:function(data)
    {
    }
  });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
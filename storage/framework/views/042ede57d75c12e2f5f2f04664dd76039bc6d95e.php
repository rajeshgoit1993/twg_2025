<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    
    <!-- Main content -->
    <section class="content">
        
        <div class="row">
            <div class="col-md-12">                
                <div class="box">                    
                    <!-- Box Header with Title -->
                    <div class="box-header">
                        <h3 class="box-title">Tour Destination</h3>
                    </div>
                    <!-- /.box-header -->
                    
                    <div class="box-body">                        
                        <!-- Success Alert for Session Messages -->
                        <?php if(Session::has('success')): ?>
                            <div class="alert alert-warning alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <?php echo e(Session::get('success')); ?>

                            </div>
                        <?php endif; ?>
                        
                        <!-- Destination Table -->
                        <table class="table table-bordered table-striped">
                            
                            <!-- Row for Add New Destination Button and Search Field -->
                            <div class="row">                                
                                <!-- Add New Destination Button -->
                                <div class="col-md-8">
                                    <?php if(Sentinel::check()): ?>
                                        <?php if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')): ?>
                                            <div class="add">
                                                <a href="<?php echo e(URL::to('/package-locations-create')); ?>" class="btn btn-success">
                                                    <i class="glyphicon glyphicon-plus-sign"></i> Add New Destination
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                
                                <!-- Search Field -->
                                <div class="col-md-4">
                                    <input type="text" id="location_searchs" class="form-control" placeholder="Search... By City or Country">
                                </div>                                
                            </div>
                            
                            <!-- Table Head -->
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <!-- <th>#</th> -->
                                    <th>Country</th>
                                    <th>State</th>
                                    <th>City</th>
                                    <th>Currency</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            
                            <!-- PHP Counter for Serial Numbers -->
                            <?php $count = "1"; ?>
                            
                            <!-- Table Body -->
                            <tbody id="location_dynamic_data">
                              <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $loc): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                <tr>
                                  <td><?php echo e($count++); ?></td>
                                 <td><?php echo e($loc->country_list->name ?? $loc->country . '(old)'); ?></td>
<td><?php echo e($loc->state_list->name ?? $loc->state . '(old)'); ?></td>
<td><?php echo e($loc->city_list->name ?? $loc->location . '(old)'); ?></td>
                                  <td><?php echo e($loc->currency); ?></td>
                                        
                                  <!-- Status Toggle Button -->
                                  <!-- <td>
                                    <?php if($loc->status == 1): ?>
                                      <button type="button" class="btn btn-success location_btn_enable" value="<?php echo e($loc->id); ?>">Disable</button>
                                    <?php else: ?>
                                      <button type="button" class="btn btn-danger location_btn_enable" value="<?php echo e($loc->id); ?>">Enable</button>
                                    <?php endif; ?>
                                    </td> -->

                                    <td>
                                      <?php if($loc->status == 1): ?>
                                        <button type="button" class="btn btn-sm btn-success location_btn_enable" value="<?php echo e($loc->id); ?>">Enabled</button>
                                      <?php else: ?>
                                        <button type="button" class="btn btn-sm btn-danger location_btn_enable" value="<?php echo e($loc->id); ?>">Disabled</button>
                                      <?php endif; ?>
                                    </td>
                                        
                                    <!-- Action Buttons (Edit/Delete) -->
                                    <td>
                                      <?php if(Sentinel::check()): ?>
                                      <?php if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin')): ?>
                                        <!-- Delete Form -->
                                        <form action="<?php echo e(URL::to('/location-delete')); ?>" id="packagedel<?php echo e($loc->id); ?>" method="POST">
                                          <?php echo e(csrf_field()); ?>

                                          <input type="hidden" name="id" value="<?php echo e($loc->id); ?>"/>
                                        </form>
                                      <?php endif; ?>
                                      <?php endif; ?>
                                            
                                      <!-- Button Group for Edit/Delete -->
                                      <span>
                                        <!-- Edit Button -->
                                        <a href="<?php echo e(URL::to('/package-locations-edit/' . $loc->id)); ?>">
                                            <button class="btn btn-sm btn-warning">Edit</button>
                                        </a>

                                        <!-- Delete Button -->
                                        <?php if(Sentinel::check()): ?>
                                        <?php if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin')): ?>
                                          <button id="packagedel<?php echo e($loc->id); ?>" class="btn btn-sm btn-danger deletePackage">Delete</button>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                      </span>
                                    </td>
                                  </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                
                                <!-- Pagination Row -->
                                <tr>
                                    <td colspan="7">
                                        <div class="location_list_paginate text-center">
                                            <?php echo e($locations->links()); ?>

                                        </div>
                                    </td>
                                </tr>                                
                            </tbody>                            
                        </table>
                        <!-- /.table -->                        
                    </div>
                    <!-- /.box-body -->
                    
                </div>                
            </div>
        </div>
        
    </section>
    <!-- /.content -->
    
</div>
<!-- /.content-wrapper -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection("custom_js_code"); ?>

<script type="text/javascript">

// Handle delete button click event
$(document).on("click", ".deletePackage", function(e) {
  e.preventDefault(); // Prevent default action

  // Confirm the user's choice
  var user_choice = window.confirm('Would you like to continue?');
  var delete_id = $(this).attr("id"); // Get the ID of the button

  // If the user confirms, submit the delete form
  if (user_choice == true) {
    document.getElementById(delete_id).submit();
  } else {
    return false; // If not, do nothing
  }
});

// Handle pagination click event
$(document).on("click", ".location_list_paginate .pagination a", function(e) {
  e.preventDefault(); // Prevent default pagination behavior

  // Extract the page number from the URL
  var page = $(this).attr('href').split('page=')[1];
  fetch_datas(page); // Fetch data for the clicked page
});

// Fetch paginated data function
function fetch_datas(page) {
  // Show loading animation
  $("#location_dynamic_data").html("").html('<div class="loading"></div>');
       
  var APP_URL = $('#baseurl').val(); // Get the base URL
  var key = $("#location_searchs").val(); // Get the search input value
     
  // Send AJAX request to fetch filtered data
  $.ajax({
    type: 'get',
    url: APP_URL + "/location_list_filter_data?page=" + page,
    data: { key: key },
    cache: false,          
    success: function(data) {
      $("#location_dynamic_data").html("").html(data); // Update the table data with the result
    },
    error: function() {
      // Handle error case (optional)
    }
  });
}

// Handle search field input event
$(document).on("keyup", "#location_searchs", function() {
  fetch_data(); // Call fetch_data when a key is pressed in the search field
});

// Fetch data function (for search input)
function fetch_data() {
  // Show loading animation
  $("#location_dynamic_data").html("").html('<div class="loading"></div>');
       
  var APP_URL = $('#baseurl').val(); // Get the base URL
  var key = $("#location_searchs").val(); // Get the search input value

  // Send AJAX request to fetch filtered data
  $.ajax({
    type: 'get',
    url: APP_URL + "/location_list_filter_data",
    data: { key: key },
    cache: false,       
    success: function(data) {
      $("#location_dynamic_data").html("").html(data); // Update the table data with the result
    },
    error: function() {
      // Handle error case (optional)
    }
  });
}

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
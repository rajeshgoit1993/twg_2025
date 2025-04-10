<?php $__env->startSection("custom_css_code"); ?>

<!-- user-profile-backend -->
<link rel="stylesheet" type="text/css" as="style" href="<?php echo e(asset('/resources/assets/backend/css/user-profile-backend.css')); ?>" />

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<!-- Main content -->
	<section class="content" id="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<?php if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin') ): ?>
					<div class="box-header">
						<h3 class="box-title">Manage Users</h3>
					</div>
					<?php endif; ?>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="add">
							<a href="<?php echo e(URL::to('/user-create')); ?>" class="btn btn-success appendRight20"><i class="glyphicon glyphicon-plus-sign"></i> Add New User</a>
						</div>
						<?php if(Session::has('success')): ?>
						<div class="alert alert-warning alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
							<?php echo e(Session::get('success')); ?>

						</div>
						<?php endif; ?>
						<div class="dashboard-outer-table">
						<table id="example1" class="table table-bordered table-striped example1">
							<thead>
								<tr>
									<th width="200" style="max-width: 200px;">User Name</th>
									<th width="200" style="max-width: 200px;">User Contact Details</th>
									<th width="200">Assigned Role</th>
									<th width="200">Category</th>
									<th width="200">Subscription</th>
									<th width="200">Activation Status</th>
									<th width="200">Online Status</th>
									<th width="100">Actions</th>
								</tr>
							</thead>

							<tbody>
								<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
								<tr id="role_<?php echo e($user->id); ?>">

									<!-- user name -->
									<td class="first_name">
										<div class="dashboard-inner-table">
											<h5>User Name</h5>
											<p class="q-dtls"><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?></p>
										</div>
									</td>

									<!-- user contact details -->
									<td>
										<div class="dashboard-inner-table">
											<p class="q-dtls"><?php echo e($user->email); ?></p>
											<p class="q-dtls"><?php echo e($user->mobile); ?></</p>
										</div>
									</td>

									<!-- user assigned role -->
									<td class="user_role">
										<div class="dashboard-inner-table">
											<!--<span><label for="" class="label label-success"><?php echo e(CustomHelpers::get_user_role($user->id)); ?></label></span>-->
											<p class="q-dtls textCapitalize"><?php echo e(CustomHelpers::get_user_role($user->id)); ?></p>
										</div>
									</td>

									<!-- user category -->
									<td>
										<div class="dashboard-inner-table">
											<p class="q-dtls textCapitalize"><?php echo e($user->usercategory); ?></p>
										</div>
									</td>

									<!-- user subscription -->
									<td>
										<div class="dashboard-inner-table textCenter">
											<h5>Status</h5>
											<select class="q-select subscription" id="<?php echo e($user->id); ?>">
												<option value="subscribed" <?php if($user->subscription=='subscribed'): ?> selected <?php endif; ?>>Subscribed</option>
												<option value="partialsubscribed" <?php if($user->subscription=='partialsubscribed'): ?> selected <?php endif; ?> disabled>Partial Subscribed</option>
												<option value="unsubscribed" <?php if($user->subscription=='unsubscribed'): ?> selected <?php endif; ?>>Unsubscribed</option>
											</select>
										</div>
									</td>

									<!-- user status -->
									<!-- <td>
										<div class="dashboard-inner-table textCenter">
											<h5>Status</h5>
											<select class="q-select textCapitalize" readonly>
												<option value="enabled">Enabled</option>
												<option value="disabled">Disabled</option>
											</select>
											<div class="apndTop5">
												<?php
													// Define $sevtinel_activated before using it in the Blade conditions
													$sevtinel_activated = Sentinel::findById($user->id);

													if ($activation = Activation::completed($sevtinel_activated)) {
														echo "<p class='btn btn-sm btn-success fullWidth no-event'>Activated</p>";
													} else {
														echo "<p class='btn btn-sm btn-danger fullWidth no-event'>De-activated</p>";
													}
												?>
											</div>
										</div>
									</td> -->

									<!-- user status -->
									<td>
										<div class="dashboard-inner-table textCenter">
											<h5>Status</h5>
											<?php if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin')): ?>
											<select class="q-select textCapitalize user-status" data-user-id="<?php echo e($user->id); ?>">
												<option value="enabled" <?php echo e($user->status === 'enabled' ? 'selected' : ''); ?>>Enabled</option>
												<option value="disabled" <?php echo e($user->status === 'disabled' ? 'selected' : ''); ?>>Disabled</option>
											</select>
											<div class="apndTop5">
												<?php
													$sevtinel_activated = Sentinel::findById($user->id);
													if ($activation = Activation::completed($sevtinel_activated)) {
														echo "<p class='btn btn-sm btn-success fullWidth no-event status-text'>Activated</p>";
													} else {
														echo "<p class='btn btn-sm btn-danger fullWidth no-event status-text'>De-activated</p>";
													}
												?>
											</div>
										</div>
										<?php else: ?>
											<p class="text-danger">You do not have permission to change the status</p>
										<?php endif; ?>
									</td>

									<!-- user online status -->
									<td>
										<div class="dashboard-inner-table textCenter">
											<h5>Current Status</h5>
											<?php if($user->login_status=="1"): ?>
											<span class="btn btn-sm btn-success fullWidth apndTop5 no-event">Online</span>
											<?php else: ?>
											<span class="btn btn-sm btn-danger fullWidth apndTop5 no-event">Offline</span>
											<?php endif; ?>
										</div>

										<!-- last login -->
										<div class="dashboard-inner-table textCenter">
										    <h5>Last Login</h5>
										    <?php if (!empty($user->last_login)) : ?>
										        <?php
										            $date = date_create($user->last_login);
										            $formattedDate = date_format($date, "d M Y");
										            $formattedTime = date_format($date, "H:i:s");
										        ?>
										        <p class="q-dtls"><?php echo $formattedDate; ?></p>
										        <p class="q-dtls"><?php echo $formattedTime; ?></p>
										    <?php else : ?>
										        <p class="q-dtls">Never Logged In</p>
										    <?php endif; ?>
										</div>
									</td>

									<!-- action -->
									<td>
								    <form action="<?php echo e(URL::to('/deleteuser')); ?>" method="post" id="deleteUserForm-<?php echo e($user->id); ?>" onsubmit="return confirm('Are you sure, you want to delete this user?');">
								        <?php echo e(csrf_field()); ?>

								        <input type="hidden" name="id" value="<?php echo e($user->id); ?>" />

								        <?php if(
								            (Sentinel::getUser()->inRole('supervisor') ||
								            Sentinel::getUser()->inRole('agent') ||
								            Sentinel::getUser()->inRole('employee') ||
								            Sentinel::getUser()->inRole('customer')) &&
								            (CustomHelpers::get_user_role($user->id) == 'administrator' ||
								            CustomHelpers::get_user_role($user->id) == 'super_admin')
								        ): ?>
								            
								        <?php elseif(
								            Sentinel::getUser()->inRole('employee') &&
								            (CustomHelpers::get_user_role($user->id) == 'administrator' ||
								            CustomHelpers::get_user_role($user->id) == 'super_admin' ||
								            CustomHelpers::get_user_role($user->id) == 'supervisor')
								        ): ?>
								            
								        <?php elseif(
								            Sentinel::getUser()->inRole('agent') &&
								            (CustomHelpers::get_user_role($user->id) == 'administrator' ||
								            CustomHelpers::get_user_role($user->id) == 'super_admin' ||
								            CustomHelpers::get_user_role($user->id) == 'supervisor' ||
								            CustomHelpers::get_user_role($user->id) == 'employee')
								        ): ?>
								            
								        <?php else: ?>
								            <a href="<?php echo e(URL::to('/edit-user/' . $user->id)); ?>">
								                <button type="button" class="btn btn-sm btn-warning">Edit</button>
								            </a>
								        <?php endif; ?>

								        <?php if(Sentinel::getUser()->id == $user->id): ?>
								            <button type="button" class="btn btn-sm btn-success no-event">Logged In</button>
								        <?php else: ?>
								            <?php if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin')): ?>
								                <button type="submit" class="btn btn-sm btn-danger deleteUser" data-form-id="deleteUserForm-<?php echo e($user->id); ?>">Delete</button>
								            <?php endif; ?>
								        <?php endif; ?>
								    </form>
									</td>
								</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
							</tbody>
						</table>
					</div>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom_js_code'); ?>

<script type="text/javascript">
$(document).ready(function() {

	// Change Subscription
	$(document).on('change', '.subscription', function() {
		var value = $(this).val();
		var id = $(this).attr('id');

		$.ajax({
			type: 'get',
			url: APP_URL + '/change_subscription',
			data: { id: id, value: value },
			success: function(data) {
				// Handle success, e.g., show a success message
				console.log('Subscription updated successfully.');
			},
			error: function(xhr, status, error) {
				// Provide better error handling
				console.error('Error:', error);
				console.log('Response:', xhr.responseText);
			}
		});
	});

	// Delete user
	$(document).on("click", ".deleteUser", function(e) {
	  e.preventDefault(); // Prevent the default action

	  // Confirm with the user if they want to continue with the deletion
	  var user_choice = window.confirm('Are you sure you want to delete this item?');

	  // If the user confirms, submit the form with the specified ID
	  if (user_choice) {
	    var formId = $(this).data("form-id");
	  		document.getElementById(formId).submit();
	    } else {
	      // If the user cancels, do nothing
	      return false;
	    }
	});
});

/*-----------------------------*/

/*$(document).ready(function() {
	$('.user-status').on('change', function() {
		var userId = $(this).data('user-id');
		var status = $(this).val();

        $.ajax({
            url: '/update-user-status',
            method: 'POST',
            data: {
                _token: '<?php echo e(csrf_token()); ?>', // CSRF token for security
                id: userId,
                status: status
            },
            success: function(response) {
                // Update the status text based on the response
                if (response.activation === 'activated') {
                    $('.status-text').text('Activated').removeClass('btn-danger').addClass('btn-success');
                } else {
                    $('.status-text').text('De-activated').removeClass('btn-success').addClass('btn-danger');
                }
            },
            error: function() {
                alert('Failed to update the status. Please try again.');
            }
        });
    });
});*/

// Change User Status on ajax (not working)
$(document).ready(function() {
	$(document).on('change', '.user-status', function() {
	    var value = $(this).val();
	    var id = $(this).data('user-id'); // Using data attribute for user ID

	    $.ajax({
	        type: 'get',
	        url: APP_URL + '/change_user_status',
	        data: { id: id, value: value },
	        success: function(data) {
	            if (data.success) {
	                // Update the status text based on the response
	                var statusTextElement = $(this).closest('.dashboard-inner-table').find('.status-text');
	                if (data.activation === 'activated') {
	                    statusTextElement.text('Activated').removeClass('btn-danger').addClass('btn-success');
	                } else {
	                    statusTextElement.text('De-activated').removeClass('btn-success').addClass('btn-danger');
	                }
	            } else {
	                console.error('Failed to update the user status.');
	            }
	        }.bind(this), // Bind 'this' to ensure the context is correct
	        error: function(xhr, status, error) {
	            console.error('Error:', error);
	            //console.log('Response:', xhr.responseText);
	        }
	    });
	});
});

// update user login status on ajax (not working)
$(document).ready(function() {
	setInterval(function() {
    $.ajax({
    	url: '/user-login-status', // Updated route to check user status
    	type: 'GET',
    	data: { user_id: <?php echo e($user->id); ?> }, // Pass user ID if needed
    	success: function(response) {
    		console.log(response); // Debug the response

    		// Update the login status
    		if (response.login_status == "1") {
    			$('.dashboard-inner-table .btn-success').text('Online').show();
    			$('.dashboard-inner-table .btn-danger').hide();
    		} else {
    			$('.dashboard-inner-table .btn-danger').text('Offline').show();
    			$('.dashboard-inner-table .btn-success').hide();
    		}

    		// Update the last login time
    		if (response.last_login) {
    			const date = new Date(response.last_login);
    			const formattedDate = date.toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' });
    			const formattedTime = date.toLocaleTimeString('en-GB', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
    			$('.dashboard-inner-table .q-dtls').eq(0).text(formattedDate);
    			$('.dashboard-inner-table .q-dtls').eq(1).text(formattedTime);
    		} else {
    			$('.dashboard-inner-table .q-dtls').text('Never Logged In');
    		}
    	}
    	error: function(xhr, status, error) {
    		console.error('AJAX Error:', status, error);
    	}
    });
    }, 5000); // Poll every 5 seconds
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
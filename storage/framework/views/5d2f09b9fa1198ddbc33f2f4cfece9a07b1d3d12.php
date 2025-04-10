			<!--Assigned User-->
			<div class="form-group">
				<label for="assigned_user" class="detailsInput">Assigned User Name </label>
				<input type="text" class="lead-input-text fullWidth" id="assigned_user" name="assigned_user" placeholder="Assigned User" value="<?php echo e(CustomHelpers::get_user_name($query->assign_id)); ?>" disabled/>
				<input type="hidden" name="query_id" value="<?php echo e($query->id); ?>">
			</div>

			<!--Services-->
			<div class="form-group">
				<label for="service_type" class="detailsInput">Services Included</label>
				<select class="lead-input-text fullWidth select2 service_type" multiple id="service_type_select2" name="service_type[]">
				   <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $services): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					<option value="<?php echo e($services->id); ?>" <?php if($service_s!='' && in_array($services->id,unserialize($service_s->services))): ?> selected <?php endif; ?>><?php echo e($services->field_name); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?> 
				</select>
			</div>

			<!--Service Details-->
			<div class="apndBtm5 service_type_data">
				<?php if($service_s!=''): ?> 
					<?php
						$services_status=unserialize($service_s->services_status);
					?>
					<?php $__currentLoopData = $services_status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row=>$col): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
						<?php 
							$service_type_data=DB::table('lead_dynamic_field')->where('id',$row)->first();
						?>
						<div class="service_category detailsInput collapsible" id="services_type_<?php echo e($service_type_data->id); ?>"><?php echo e($service_type_data->field_name); ?></div>
						<div class="contents" id="services_type_content_<?php echo e($service_type_data->id); ?>">
							<div class="service_category_dtls">
								<!--Current Status-->
								<div class="service_category_dtls_part form-group fullWidth">
									<label for="lead_current_status" class="detailsInput">Current Status</label>
									<div>
										<select class="lead-input-text fullWidth" id="lead_current_status" name="services_status[<?php echo e($service_type_data->id); ?>][status]">
											<?php $__currentLoopData = $data_s; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $services): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<option value="<?php echo e($services->id); ?>" <?php if($services->id==$col['status']): ?> selected <?php endif; ?>><?php echo e($services->field_name); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?> 
										</select>
									</div>
								</div>
								<!--Supplier Name-->
								<div class="service_category_dtls_part form-group fullWidth">
									<label for="supplier_name" class="detailsInput">Supplier Name</label>
									<div>
										<select class="lead-input-text fullWidth select2" id="supplier_name" name="services_status[<?php echo e($service_type_data->id); ?>][supplier_name]">
											<option selected disabled>Select</option>
											<?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suppliers): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<option value="<?php echo e($suppliers->id); ?>" <?php if(array_key_exists('supplier_name',$col) && $suppliers->id==$col['supplier_name']): ?> selected <?php endif; ?> select_name="<?php echo e($suppliers->suppliercompanyname); ?>"><?php echo e($suppliers->suppliercompanyname); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
										</select>
									</div>
								</div>
								<!--Supplier Reference No-->
								<div class="service_category_dtls_part form-group fullWidth">
									<label for="supplier_reference_no" class="detailsInput">Reference No</label>
									<div>
										<input type="text" <?php if(array_key_exists('supplier_reference_no',$col)): ?> value="<?php echo e($col['supplier_reference_no']); ?>" <?php endif; ?>  class="lead-input-text fullWidth" id="supplier_reference_no" name="services_status[<?php echo e($service_type_data->id); ?>][supplier_reference_no]" placeholder="Enter Supplier Reference No" />
									</div>
								</div>
								<!--Cancellation Deadline-->
								<div class="service_category_dtls_part form-group fullWidth">
									<label for="service_cancellation_deadline" class="detailsInput">Cancellation Deadline</label>
									<div class="makeflex">
										<input type="date" <?php if(array_key_exists('supplier_reference_no',$col)): ?> value="<?php echo e($col['date']); ?>" <?php endif; ?>  name="services_status[<?php echo e($service_type_data->id); ?>][date]" class="lead-input-text fullWidth" id="service_cancellation_deadline"  style="border-radius: 4px 0px 0px 4px; border-right: none;" />
										<input type="time" <?php if(array_key_exists('supplier_reference_no',$col)): ?> value="<?php echo e($col['time']); ?>" <?php endif; ?>   name="services_status[<?php echo e($service_type_data->id); ?>][time]" class="lead-input-text fullWidth" id="service_cancellation_deadline"  style="border-radius: 0px 4px 4px 0px;flex-basis: 70%;" />
									</div>
								</div>
							</div>
							<!--User Remarks-->
							<div class="form-group">
								<button type="button" id="btn_remarks" class="btn_add_remarks btn_remarks_service">
									<?php if(array_key_exists('user_remarks',$col) && $col['user_remarks']!=''): ?> 
										Hide Remarks(-)
										<?php else: ?>
										Add Remarks(+)
									<?php endif; ?>
								</button>
								<span class="add_remarks"></span>
								<span class="add_content" 
									<?php if(array_key_exists('user_remarks',$col) && $col['user_remarks']!=''): ?> style="display: block;"
										<?php else: ?>
											style="display: none;"
									<?php endif; ?>
									>
									<textarea class="lead-input-text-area fullWidth" type="text" name="services_status[<?php echo e($service_type_data->id); ?>][user_remarks]" style="" placeholder="Remarks"><?php if(array_key_exists('user_remarks',$col) && $col['user_remarks']!=''): ?><?php echo e($col['user_remarks']); ?> <?php endif; ?></textarea>
								</span>
							</div>
						</div>
	           		<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
           		<?php endif; ?>
			</div>
			
			<!--Current Date & Time-->
			<div class="form-group">
				<label for="datetimestamp" class="detailsInput">Current Date & Time </label>
				<div class="makeflex">
					<!-- <input type="date" value="<?php echo e(date('Y-m-d')); ?>" class="lead-input-text disabled fullWidth" id="datetimestamp" name="datetimestamp" style="border-radius: 4px 0px 0px 4px; border-right: none;" disabled/> -->
					<input type="text" class="lead-input-text disabled fullWidth date_display" style="border-radius: 4px 0px 0px 4px; border-right: none;" disabled />
					<!-- <input type="time" value="<?php echo e(date('H:i')); ?>" class="current_time lead-input-text disabled fullWidth" id="datetimestamp" name="datetimestamp" style="border-radius: 0px 4px 4px 0px" disabled/> -->
					<input type="text" class="lead-input-text disabled fullWidth time_display" style="border-radius: 0px 4px 4px 0px" disabled />
					<input type="hidden" id="datetimestamp" name="datetimestamp" />
				</div>
			</div>

<script type="text/javascript">
// Get all elements with the class name "accordion (collapsible)"
//document.addEventListener("DOMContentLoaded", function() {
    // Get all elements with the class name "accordion (collapsible)"
    var coll = document.getElementsByClassName("collapsible");

    // Iterate over each accordion element
    for (var i = 0; i < coll.length; i++) {
        // Add a click event listener to each accordion element
        coll[i].addEventListener("click", function() {
            // Toggle the "active" class on the clicked accordion
            this.classList.toggle("active");

            // Get the next sibling element (the panel) of the clicked accordion
            var contents = this.nextElementSibling;

            // Check if the panel is currently open
            if (contents.style.maxHeight) {
                // If open, close it by setting maxHeight to null
                contents.style.maxHeight = null;
            } else {
                // If closed, open it by setting maxHeight to its scroll height
                contents.style.maxHeight = 'inherit';
            }
        });
    }
//});
</script>
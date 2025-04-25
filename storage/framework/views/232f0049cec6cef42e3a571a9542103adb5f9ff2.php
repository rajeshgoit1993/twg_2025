<?php $__env->startSection('custom_css_code'); ?>

	<!-- lead manager css -->
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/resources/assets/backend/css/lead-manager.css')); ?>" />

	<!-- enquity timeline CSS -->
	<link type="text/css" rel="stylesheet" href="<?php echo e(asset('/resources/assets/backend/css/enquiry-timeline.css')); ?>" />

	<!-- lead modal CSS -->
	<link type="text/css" rel="stylesheet" href="<?php echo e(asset('/resources/assets/backend/css/lead-validation.css')); ?>" />

	<!-- JS modal pop-up -->
	<link type="text/css" rel="stylesheet" href="<?php echo e(asset('/resources/assets/backend/css/modal-popup.css')); ?>" />

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box autoScroll">
					<div class="box-header">
						<!-- query-enquiry page -->
						<?php if($val==1): ?>
							<h3 class="box-title">Web Leads</h3>
						<?php elseif($val==2): ?>
							<h3 class="box-title">Lead Verification</h3>
						<?php endif; ?>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<?php if(\Session::has('message')): ?>
						<div class="alert alert-success">
							<ul>
								<li><?php echo \Session::get('message'); ?></li>
							</ul>
						</div>
						<?php endif; ?>

						<div class="alert alert-success success-contaier-parent-hotel" id="success-contaier-parent-hotel" style="display:none">
							<p>Query Deleted Successfully.</p>
						</div>

						<div class="alert alert-danger error-contaier-parent-hotel" id="error-contaier-parent-hotel" style="display:none">
							<ul class="error-contaier-hotel" id="error-contaier-hotel"></ul>
						</div>

						<div class="dashboard-outer-table">
						<table id="example1" class="table table-bordered table-striped example1">
							<thead>
								<tr>
									<!-- s.no. -->
									<th style="display: none">S.No.</th>

									<!-- reference no -->
									<th width="175" style="min-width: 125px;">Reference No</th>

									<!-- guest details -->
									<th>Guest Name,<br>Mobile No & Email id</th>

									<!-- travel date & nationality -->
									<th width="200" style="min-width: 150px;">Travel Date,<br>Guests & Nationality</th>

									<!-- travel destination -->
									<th width="200">Destination & <br>Package Name</th>

									<!-- lead status -->
									<th width="200">Lead Status</th>

									<!-- quote status -->
									<!-- <th style="width: 180px">Quote status</th> -->

									<!-- lead label -->
									<th width="200">Lead Verify</th>

									<!-- action -->
									<th width="100">Action</th>
								</tr>
							</thead>
							<tbody><?php $count="1"; ?>
								<?php $__currentLoopData = $queries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$query): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
								<tr>
									<!-- s.no. -->
									<td style="display: none"><?php echo e($count++); ?></td>

									<!-- enquiry & quote reference no -->
									<td>
										<div class="dashboard-inner-table">
										    <div><u><h5>Enquiry Reference No</h5></u></div>

										    <?php if(isset($query->enquiry_ref_no)): ?>
										        <p class="q-dtls">#<?php echo e($query->enquiry_ref_no); ?></p>
										    <?php else: ?>
										        <p class="q-dtls">No enquiry id available.</p>
										    <?php endif; ?>

										    <p class="q-dtls"><?php echo e($query->service_type ?? 'No service type available.'); ?></p>
										    <p class="q-dtls"><?php echo e($query->channel_type ?? 'No channel type available.'); ?></p>
										</div>

										<!-- --------- -->

										<!-- quote reference no -->
										<?php if(!empty($query->quo_ref)): ?>
											<div class="dashboard-inner-table">
											    <div><u><h5>Quote Reference No</h5></u></div>
											    <p class="q-dtls">#<?php echo e($query->quo_ref); ?></p>
											</div>
										<?php endif; ?>							
									</td>

									<!-- ********************** -->

									<!-- guest details -->
									<td>
										<div class="dashboard-inner-table">
											<div>
												<u><h5>Guest Details</h5></u>
											</div>

											<!-- guest name -->
											<p class="q-dtls"><?php echo e($query->name); ?></p>

											<!-- guest mobile & email -->
											<?php $loged_user=Sentinel::getUser(); ?>
											<?php if($loged_user->lock_before_quote_send==''): ?>
												<?php if($query->mobile!=""): ?>
													<p class="q-dtls"><?php echo e($query->mobile); ?></p>
												<?php endif; ?>
												<p class="q-dtls"><?php echo e($query->email); ?></p>
											<?php else: ?>
												<?php if($query->mobile!=""): ?>
												<p class="q-dtls"><?php echo e(CustomHelpers::mask_mobile_no($query->mobile)); ?></p>
												<?php endif; ?>

												<p class="q-dtls"><?php echo e(CustomHelpers::partiallyHideEmail($query->email)); ?></p>
											<?php endif; ?>
										</div>
									</td>

									<!-- ********************** -->

									<!-- travel date, no of guest & nationality -->
									<td>
										<div class="dashboard-inner-table">
											<div><u><h5>Travel Details</h5></u></div>

											<!-- travel date -->
											<!-- <p class="q-dtls">
												<?php if($query->date_arrival!=""): ?>
												<?php
													$date_arrival = $query->date_arrival;
													$date_arrival = str_replace('/', '-', $date_arrival);
													//Explode the string into an array.
													$exploded = explode("-", $date_arrival);
													//Reverse the order.
													$exploded = array_reverse($exploded);
													$newFormat = array_map('trim', $exploded);
													//Convert it back into a string.
													$newFormat = implode("-", $newFormat);
													$newFormat = date("d M Y", strtotime($newFormat));
													//Print it out.
													echo $newFormat;
												?>
												<?php endif; ?>
											</p> -->

											<!-- travel date -->
											<p class="q-dtls">
											    <?php if($query->date_arrival): ?>
											        <?php 
											            // Replace slashes with dashes and convert to YYYY-MM-DD format
											            $date_arrival = str_replace('/', '-', $query->date_arrival);

											            // Convert to DateTime object and format to "d M Y"
											            $formattedDate = \Carbon\Carbon::createFromFormat('Y-m-d', $date_arrival)->format('d M Y');
											         ?>
											        <?php echo e($formattedDate); ?>

											    <?php endif; ?>
											</p>

											<!-- --------- -->

											<!-- no of guests -->
											<?php if($query->span_value_adult != "" && $query->span_value_adult != "0"): ?>
											    <?php 
											        $adultCount = (int) $query->span_value_adult;
											        $adultText = $adultCount == 1 ? 'Adult' : 'Adults';
											     ?>
											    <p class="q-dtls"><?php echo e($adultCount); ?> <?php echo e($adultText); ?>

											<?php endif; ?>

											<?php if($query->span_value_child != "" && $query->span_value_child != "0"): ?>
											    <?php 
											        $childCount = (int) $query->span_value_child;
											        $childText = $childCount == 1 ? 'Child (with bed)' : 'Children (with bed)';
											     ?>
											    + <?php echo e($childCount); ?> <?php echo e($childText); ?>

											<?php endif; ?>

											<?php if($query->span_value_child_without_bed != "" && $query->span_value_child_without_bed != "0"): ?>
											    <?php 
											        $childWithoutBedCount = (int) $query->span_value_child_without_bed;
											        $childWithoutBedText = $childWithoutBedCount == 1 ? 'Child (without bed)' : 'Children (without bed)';
											     ?>
											    + <?php echo e($childWithoutBedCount); ?> <?php echo e($childWithoutBedText); ?>

											<?php endif; ?>

											<?php if($query->span_value_infant != "" && $query->span_value_infant != "0"): ?>
											    <?php 
											        $infantCount = (int) $query->span_value_infant;
											        $infantText = $infantCount == 1 ? 'Infant' : 'Infants';
											     ?>
											    + <?php echo e($infantCount); ?> <?php echo e($infantText); ?></p>
											<?php endif; ?>

											<!-- starting city -->
											<?php if($query->country_of_residence != ""): ?>
											    <p class="q-dtls"><?php echo e($query->country_of_residence); ?></p>
											<?php endif; ?>

											<!-- --------- -->

											<!-- nationality -->
											<?php if($query->nationality!=""): ?>
												<p class="q-dtls"><?php echo e($query->nationality); ?></p>
											<?php endif; ?>
										</div>
									</td>

									<!-- ********************** -->

									<!-- destination & package name -->
									<td>
										<!-- destination name -->
										<div class="dashboard-inner-table">

											<!-- destination -->
											<?php if(is_numeric((int)$query->packageId)): ?>
											    <div><u><h5>Destination</h5></u></div>
											    <?php
											        // Fetch cities from the database using the helper function
											        $cities = CustomHelpers::get_master_table_data('rt_packages', 'id', (int)$query->packageId, 'city');

											        // If the result is null or not an array, default to an empty array
											        if ($cities === null || !is_array($cities)) {
											            $cities = []; // Default to an empty array if no valid data
											        }
											    ?>

											    <?php if(!empty($cities)): ?>
											        <ul class="q-dtls">
											            <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tour_city): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
											                <li><?php echo e($tour_city); ?></li>
											            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											        </ul>
											    <?php elseif(!empty($query->destinations)): ?>
											        <ul class="q-dtls">
											            <li><?php echo e($query->destinations); ?></li>
											        </ul>
											    <?php else: ?>
											        <p class="q-dtls">No destination available</p>
											    <?php endif; ?>

											<?php else: ?>
											    <?php if(!empty($query->destinations)): ?>
											        <p class="q-dtls"><?php echo e($query->destinations); ?></p>
											    <?php else: ?>
											        <p class="q-dtls">No destinations available.</p>
											    <?php endif; ?>
											<?php endif; ?>



											<!-- ************* -->

											<!-- package name -->
											<?php if(is_numeric((int)$query->packageId)): ?>
											    <?php
											        $href_id1 = CustomHelpers::custom_encrypt((int)$query->packageId);
											        $packageName = CustomHelpers::get_package_name((int)$query->packageId);
											        $form_action = url("/holidays/" . str_slug($packageName)) . '?package_id=' . $href_id1;
											    ?>
											    
											    <?php if(!empty($packageName)): ?>
											        <div class="pdngTop7"><u><h5>Tour Name</h5></u></div>
											        <p class="q-dtls">
											            <a href="<?php echo e($form_action); ?>" target="_blank">
											                <?php echo e($packageName); ?>

											            </a>
											        </p>
											    <?php else: ?>
											        <div class="pdngTop7"><u><h5>Source</h5></u></div>
											        <p class="q-dtls">
											            Quick enquiry
											        </p>
											    <?php endif; ?>

											<?php else: ?>
											    <p class="q-dtls"><?php echo e($query->packageId); ?></p>
											<?php endif; ?>
										</div>
									</td>								

	
									<!-- ********************** -->
									 

									

									<!-- lead status -->
									<td id="<?php echo e($query->id); ?>" enquiry_ref_no="<?php echo e($query->enquiry_ref_no); ?>"  quote_ref_no="NA" >
										<div class="dashboard-inner-table textCenter">
											<div><u><h5>Update status</h5></u></div>
											<div>
										    <select class="query_status q-select previous_class_<?php echo e($query->enquiry_ref_no); ?>_<?php echo e($count); ?>" dynamic_class_name="previous_class_<?php echo e($query->enquiry_ref_no); ?>_<?php echo e($count); ?>">
										        <!-- 
										        <option value="0" <?php if($query->status=="0"): ?> selected <?php endif; ?>>Select Status</option>
										        -->
										        <?php if($val == 1): ?>
										            <option value="interested" <?php if($query->status == "interested"): ?> selected <?php endif; ?>>Interested</option>
										            <option value="add_lead_follow_up" <?php if($query->status == "add_lead_follow_up"): ?> selected <?php endif; ?>>Add Lead Follow-up</option>
										            <option value="lead_cancelled" <?php if($query->status == "lead_cancelled"): ?> selected <?php endif; ?>>Lead Cancelled</option>
										        <?php else: ?>
										            <option value="add_lead_follow_up" <?php if($query->status == "add_lead_follow_up"): ?> selected <?php endif; ?>>Add Lead Follow-up</option>
										            <option value="lead_verify_pending" <?php if($query->status == "lead_verify_pending"): ?> selected <?php endif; ?>>Lead Verify Pending</option>
										            <option value="lead_cancelled" <?php if($query->status == "lead_cancelled"): ?> selected <?php endif; ?>>Lead Cancelled</option>
										        <?php endif; ?>
										    </select>
										    </div>
										    <!-- add lead remarks -->
										    <!-- <button class="btn-backend-main btnInfo submit_status" data-id="<?php echo e($query->id); ?>">Add Lead Remarks</button> -->
										    <?php if(isset($query->id)): ?>
											    <button class="btn-backend-main btnInfo submit_status" data-id="<?php echo e($query->id); ?>">Add Lead Remarks</button>
											<?php else: ?>
											    <p>ID not found</p>
											<?php endif; ?>

										</div>

										<!-- --------- -->
										
									    <!-- lead follow-up -->
										<?php if($query->status == 'add_lead_follow_up'): ?>
											<?php 
												$lead_follow_up_data = DB::table('enquiry_lead_follow_up')
									                ->where('enquiry_id', $query->id)
									                ->latest()
									                ->first();
									            $reason = DB::table('lead_dynamic_field')
									                ->where('id', $lead_follow_up_data->reason)
									                ->first();
											?>
											<div class="dashboard-inner-table apndTop7">
												<div><u><h5>Lead follow-up detail</h5></u></div>
												<p class="q-dtls">Next follow-up date: <b><?php echo e(date('d-m-Y', strtotime($lead_follow_up_data->follow_up_date))); ?></b></p>
												<p class="q-dtls">Next follow-up time: <b><?php echo e($lead_follow_up_data->follow_up_time); ?> hrs.</b></p>
												<p class="q-dtls">Reason: <?php echo e($reason->field_name); ?></p>
											</div>
										<?php endif; ?>

										<!-- --------- -->

										<!-- enquiry timeline -->
										<div class="dashboard-inner-table">
											<div><u><h5>Enquiry Timeline</h5></u></div>
											<button type="button" class="btn-backend-main btnInfo view_history" data-id="<?php echo e($query->id); ?>">View History</button>
										</div>
									</td>

									<!-- ********************** -->

									<!-- <td id=<?php echo e($query->id); ?>>
										<select class="lead_varified" style="width: 100%;border-color: #ccc;border-radius: 3px;height: 34px;padding: 4px">
											<option value="0" <?php if($query->lead_verified=="0"): ?> selected <?php endif; ?>>No</option>
											<option value="1" <?php if($query->lead_verified=="1"): ?> selected <?php endif; ?>>Yes</option>
										</select>
										<?php if($query->otp_verified==1): ?>
										<p style="color: green;">OTP verified</p>
										<?php else: ?>
										<p style="color: lightgray;">OTP Non-verified</p>
										<?php endif; ?>

										<?php if($val==2): ?>
										<h5> Booking Label	</h5>
										<select class="booking_label" style="width: 100%;border-color: #ccc;border-radius: 3px;height: 34px;padding: 4px">
												<option value="">--Select--</option>
											<?php $__currentLoopData = $booking_lavel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b_label): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
										
											<option value="<?php echo e($b_label->id); ?>" <?php if($query->booking_label==$b_label->id): ?> selected <?php endif; ?>><?php echo e($b_label->field_name); ?></option>

											<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
										</select>
										<?php endif; ?>
									</td> -->

									<!-- lead verification & booking label -->
									<td id="<?php echo e($query->id); ?>">
									<?php if(Sentinel::check()): ?>
										<?php if(Sentinel::getUser()->inRole('super_admin') ||
											Sentinel::getUser()->inRole('administrator') ||
											Sentinel::getUser()->inRole('supervisor')): ?>								
											<!-- phone verification -->
											<div class="dashboard-inner-table textCenter">
												<div><u><h5>Phone Verification</h5></u></div>
											    <select class="q-select lead_varified">
											        <option value="0" <?php if($query->lead_verified == "0"): ?> selected <?php endif; ?>>No</option>
											        <option value="1" <?php if($query->lead_verified == "1"): ?> selected <?php endif; ?>>Yes</option>
											    </select>
										    </div>

										    <div class="dashboard-inner-table textCenter">
												<div><u><h5>Assign Consultant</h5></u></div>
											    <select class="user_assign q-select">
													<option <?php if($query->assign_id=="0"): ?> selected <?php endif; ?> value="0">Unassigned</option>
													<?php $__currentLoopData = $employee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employees): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
													   <option value="<?php echo e($employees->id); ?>" <?php if($query->assign_id==$employees->id): ?> selected <?php endif; ?> ><?php echo e($employees->first_name); ?> <?php echo e($employees->last_name); ?></option>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
												</select>
											</div>

										    <?php if($val == 2): ?>
												<div class="dashboard-inner-table textCenter">
													<div><u><h5>Lead Label</h5></u></div>
											    	<select class="booking_label q-select">
											    		<option disabled>Select</option>
														<?php $__currentLoopData = $booking_lavel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b_label): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
															<option value="<?php echo e($b_label->id); ?>" <?php if($query->booking_label==$b_label->id): ?> selected <?php endif; ?>><?php echo e($b_label->field_name); ?></option>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
													</select>
												</div>
											<?php endif; ?>

											<!-- online otp verification -->
										    <?php if($query->otp_verified == 1): ?>
										        <p class="online-otp-verify">OTP verified</p>
										    <?php else: ?>
										        <p class="online-otp-verify disabled">OTP not verified</p>
										    <?php endif; ?>
										<?php endif; ?>
									<?php endif; ?>
									</td>

									<!-- *************************** -->

									<!-- lead action -->
									<td>
										<!-- view lead -->
										<div class="btnContainer">
											<button type="submit" class="btn-q <?php if($query->view_status == 0): ?> btn-view-quote <?php else: ?> btn-viewed-lead <?php endif; ?> open-editEnquiryModal" data-id="<?php echo e($query->id); ?>" data-toggle="modal">View Lead</button>
										</div>

										<!-- delete lead -->
										<?php if(Sentinel::check()): ?>
									        <?php if(Sentinel::getUser()->inRole('administrator') || 
									            Sentinel::getUser()->inRole('super_admin')): ?>
												<form style="float: unset !important" action="<?php echo e(URL::to('/detele_query/'.$query->id)); ?>" onsubmit="return confirm('Are you sure, you want to remove this lead?');" method="POST">
													<?php echo e(csrf_field()); ?>

													<div class="btnContainer">
														<button type="submit" class="btn-q btn-delete deletePackage">Delete</button>
													</div>
												</form>
											<?php endif; ?>
										<?php endif; ?>

										<!-- --------- -->

									    <!-- lead date & time -->
									    <div class="dashboard-inner-table">
											<u><h5>Lead Generated</h5></u>
											<?php
												$lead_date_time = date("d M Y, H:i:s", strtotime($query->created_at));
											?>
											<p class="q-dtls textCenter"><?php echo e($lead_date_time); ?>, (<?php echo e(date('D',strtotime($query->created_at))); ?>)</p>
										</div>

										<!-- --------- -->

										<!-- lead last update date & time -->
										<div class="dashboard-inner-table">
											<u><h5>Lead Last updated</h5></u>
											<?php
												$last_updated_at = date("d M Y, H:i:s", strtotime($query->updated_at));
											?>
											<p class="q-dtls textCenter"><?php echo e($last_updated_at); ?>, (<?php echo e(date('D',strtotime($query->created_at))); ?>)</p>
										</div>
									</td>
							</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
						</tbody>
						</table>
						</div>
					</div>
					<!-- /.box-body -->
				</div>
			</div>
		</div>
	</section>
	<!-- /.content -->
	</div>

	<div class="testing">
		<input type="hidden" value="<?php echo e(url('/')); ?>" name="" id="test">
	</div>

	<!--Lead Status starts-->
	<?php echo $__env->make('query.query_modal.modal-popup.lead-follow-up', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('query.query_modal.modal-popup.lead-cancelled', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<!-- edit enquiry details modal -->
	<?php echo $__env->make('query.query_modal.modal-popup.action-modal.edit-enquiry-details', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<!-- view lead history modal -->
	<?php echo $__env->make('query.query_modal.modal-popup.action-modal.view-enquiry-timeline', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom_js_code'); ?>

	<!-- page script -->
	<script type="text/javascript" src='<?php echo e(asset ("/resources/assets/backend/js/edit-lead.js")); ?>'></script>

	<script type="text/javascript" src='<?php echo e(asset ("/resources/assets/backend/js/view-history-view-lead.js")); ?>'></script>

	<script type="text/javascript" src='<?php echo e(asset ("/resources/assets/backend/js/capture-date-time.js")); ?>'></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
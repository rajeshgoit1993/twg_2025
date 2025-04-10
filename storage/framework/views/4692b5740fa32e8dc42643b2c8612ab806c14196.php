<?php $__env->startSection('custom_css_code'); ?>

	<!-- lead manager css -->
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/resources/assets/backend/css/lead-manager.css')); ?>" />

	<!-- enquiry timeline CSS -->
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
						<h3 class="box-title">Lead Cancelled</h3>
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
							<p>Query Deleted Successfully</p>
						</div>

						<div class="alert alert-danger error-contaier-parent-hotel" id="error-contaier-parent-hotel" style="display:none">
							<ul class="error-contaier-hotel" id="error-contaier-hotel"></ul>
						</div>

						<div class="dashboard-outer-table">
						<table id="example1" class="table table-bordered table-striped example1">
						<thead>
								<tr>
									<!-- s.no. -->
									<!-- <th style="display: ">S.No.</th> -->

									<!-- quote reference no -->
									<th width="175" style="min-width: 125px;">Reference No</th>

									<!-- guest details -->
									<th>Guest Name,<br>Mobile No & Email id</th>

									<!-- travel date & nationality -->
									<th width="200" style="min-width: 150px;">Travel Date,<br>Guests & Nationality</th>

									<!-- travel destination -->
									<th width="200">Destination & <br>Package Name</th>

									<!-- lead status -->
									<th width="200">Lead Status</th>

									<!-- lead label -->
									<!-- <th width="200">Lead Verify</th> -->

									<!-- quote status -->
									<th width="100">Quote status</th>

									<!-- action -->
									<th width="100">Action</th>
								</tr>
							</thead>
						<tbody>
							<?php $count="1"; ?>
							<?php $__currentLoopData = $queries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$query): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
							<tr>
								<!-- s.no. -->
									<!-- <td style="display: "><?php echo e($count++); ?></td> -->

									<!-- enquiry & quote reference no -->
									<td>
										<!-- enquiry reference no -->
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
										<div class="dashboard-inner-table">
											<div><u><h5>Quote Reference No</h5></u></div>
											<?php if(isset($query->quo_ref)): ?>
										        <p class="q-dtls">#<?php echo e($query->quo_ref); ?></p>
										    <?php else: ?>
										        <p class="q-dtls">No quote id available.</p>
										    <?php endif; ?>
										</div>						
									</td>

									<!-- ********************** -->

									<!-- guest details -->
									<td>
										<div class="dashboard-inner-table">
											<div>
												<u><h5>Guest Details</h5></u>
											</div>
											<p class="q-dtls"><?php echo e($query->name); ?></p>
											<?php 
												$loged_user=Sentinel::getUser();
											?>
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

									<!-- travel date, guest & nationality -->
									<td>
										<div class="dashboard-inner-table">
											<div><u><h5>Travel Date</h5></u></div>

											<!-- travel date -->
											<p class="q-dtls">
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
											        $childText = $childCount == 1 ? 'Child(with bed)' : 'Children(with bed)';
											     ?>
											    + <?php echo e($childCount); ?> <?php echo e($childText); ?>

											<?php endif; ?>

											<?php if($query->span_value_child_without_bed != "" && $query->span_value_child_without_bed != "0"): ?>
											    <?php 
											        $childWithoutBedCount = (int) $query->span_value_child_without_bed;
											        $childWithoutBedText = $childWithoutBedCount == 1 ? 'Child(without bed)' : 'Children(without bed)';
											     ?>
											    <i>+ <?php echo e($childWithoutBedCount); ?> <?php echo e($childWithoutBedText); ?></i>
											<?php endif; ?>

											<?php if($query->span_value_infant != "" && $query->span_value_infant != "0"): ?>
											    <?php 
											        $infantCount = (int) $query->span_value_infant;
											        $infantText = $infantCount == 1 ? 'Infant' : 'Infants';
											     ?>
											    + <?php echo e($infantCount); ?> <?php echo e($infantText); ?></p>
											<?php endif; ?>

											<!-- --------- -->

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
										<div class="dashboard-inner-table">
											<!-- destination -->
											<?php if(is_numeric((int)$query->packageId)): ?>
											    <div><u><h5>Destination</h5></u></div>
											    <?php
											        $cities = CustomHelpers::get_master_table_data('rt_packages', 'id', (int)$query->packageId, 'city');
											        Log::info('Cities from helper:', ['cities' => $cities]);

											        if ($cities === false || $cities === null || !is_string($cities)) {
											            Log::error('Invalid serialized data from helper function.');
											            $cities = [];
											        } else {
											            try {
											                $cities = unserialize($cities);
											                if ($cities === false && $cities !== 'b:0;') {
											                    Log::error('Unserialize returned false for non-empty data.');
											                    $cities = [];
											                }
											            } catch (Exception $e) {
											                Log::error('Unserialize error: ' . $e->getMessage());
											                $cities = [];
											            }
											        }
											        if (!is_array($cities)) {
											            Log::error('Unserialized data is not an array.');
											            $cities = [];
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

											<!-- --------- -->

											<!-- package name -->
											<?php if(is_numeric((int)$query->packageId)): ?>
											    <?php
											        $href_id1 = CustomHelpers::custom_encrypt((int)$query->packageId);
											        $packageName = CustomHelpers::get_package_name((int)$query->packageId);
											        $form_action = url("/Holidays/" . str_slug($packageName)) . '?package_id=' . $href_id1;
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
								
									<!-- lead status, enquiry timeline & booking label -->
									<td id="<?php echo e($query->id); ?>">
										<div class="dashboard-inner-table textCenter">
											<div><u><h5>Update status</h5></u></div>

											<select class="query_status q-select">
												<option value="0" <?php if($query->status=="0"): ?> selected <?php endif; ?> disabled>Select Status</option>
												<option value="lead_cancelled" <?php if($query->status=="lead_cancelled"): ?> selected <?php endif; ?>>Lead Cancelled</option>
												<!-- <option value="quote_rejected" <?php if($query->status=="quote_rejected"): ?> selected <?php endif; ?>>Quote rejected</option>
												<option value="booked_with_other" <?php if($query->status=="booked_with_other"): ?> selected <?php endif; ?>>Booked with other</option>
												<option value="tour_cancelled" <?php if($query->status=="tour_cancelled"): ?> selected <?php endif; ?>>Tour cancelled</option>
												<option value="interested" <?php if($query->status=="interested"): ?> selected <?php endif; ?>>Interested</option>
												<option value="no_response" <?php if($query->status=="no_response"): ?> selected <?php endif; ?>>No Response</option> -->
											</select>

											<!-- --- -->

											<!-- add lead remarks -->
										    <button class="btn-backend-main btnInfo submit_status" data-id="<?php echo e($query->id); ?>" disabled>Add Lead Remarks</button>
										</div>

										<!-- --------- -->

										<!-- enquiry timeline -->
										<div class="dashboard-inner-table">
											<div><u><h5>Enquiry Timeline</h5></u></div>
											<table>
												<tr>
													<td>
													  <div class="btnContainer">
														<button  class="btn-backend-main btnInfo view_history" data-id="<?php echo e($query->id); ?>">View History</button>
													  </div>
													</td>
												</tr>
											</table>
										</div>
									</td>

									<!-- ********************** -->

									<!-- assign user & booking label -->
									<td>
										<!-- assign consultant -->
										<?php if(Sentinel::check()): ?>
										<?php if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin') || Sentinel::getUser()->inRole('supervisor')): ?>
											<div class="dashboard-inner-table textCenter">
												<div><u><h5>Assign Consultant</h5></u></div>
											    <select class="user_assign q-select" disabled>
													<option <?php if($query->assign_id=="0"): ?> selected <?php endif; ?> value="0">Unassigned</option>
													<?php $__currentLoopData = $employee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employees): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
													   <option value="<?php echo e($employees->id); ?>" <?php if($query->assign_id==$employees->id): ?> selected <?php endif; ?> ><?php echo e($employees->first_name); ?> <?php echo e($employees->last_name); ?></option>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
												</select>
											</div>								    
										<?php endif; ?>
										<?php endif; ?>
									</td>

									<!-- ********************** -->

									<!-- lead action -->
									<td>
										<!-- view quote -->
										<input type="hidden" class="unique_code" value="<?php echo e(CustomHelpers::custom_encrypt($query->unique_code)); ?>">
										<?php if(!empty($query->unique_code)): ?>
										    <!-- view quote -->
										    <a href="<?php echo e(url('/quotes/' . $query->unique_code)); ?>" target="_blank">
										        <div class="btnContainer">
										            <button type="submit" class="btn-q btn-view-quote" data-id="<?php echo e($query->id); ?>">View Quote</button>
										        </div>
										    </a>
										<?php endif; ?>

										<!-- view lead -->
										<div class="btnContainer">
											<button type="submit" class="btn-q open-enquiryModal btn-viewed-lead" data-id="<?php echo e($query->id); ?>" data-toggle="modal">View Lead</button>
										</div>

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

								<!-- <td>
									<?php if(CustomHelpers::check_quote_exist($query->id)!="0"): ?>
									<a href="<?php echo e(url('/quotes/'.CustomHelpers::check_quote_exist($query->id))); ?>" target="_blank"><button type="submit" class="btn btn-info lineHeight14" style="width: 100%;padding: 4px 10px;border-radius: 3px">View Quote</button></a>
									<input type="hidden"  value="<?php echo e(url('/quotes/'.CustomHelpers::check_quote_exist($query->id))); ?>" id="copy<?php echo e($query->id); ?>">
									<button type="submit" class="btn btn-success link lineHeight14" link="copy<?php echo e($query->id); ?>" style="width: 100%;padding: 4px 10px;border-radius: 3px">Copy Link</button>
									<?php endif; ?>
									<span class="btn-group makeflex" style="justify-content: space-between">
										<button type="submit" class="btn btn-default btn-xcrud btn btn-warning open-AddBookDialog" data-id="<?php echo e($query->id); ?>" data-toggle="modal" style="border-radius: 3px;margin-right: 10px"><i class="fa fa-eye"></i></button>
										<?php if(Sentinel::check()): ?>
											<?php if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin')): ?>
											<form action="<?php echo e(URL::to('/detele_query/'.$query->id)); ?>" onsubmit="return confirm('Are you sure you want to delete this lead?');" method="POST">
												<span class="btn-group">
												<?php echo e(csrf_field()); ?>

												<button type="submit" class="btn btn-danger deletePackage" style="border-radius: 3px;"><i class="fa fa-times"></i></button>
												</span>
											</form>
											<?php endif; ?>
										<?php endif; ?>
									</span>
									<div style="border: 1px solid #ccc;border-radius: 3px;">
										<?php $newDate_flight = date("d M Y H:i", strtotime($query->created_at)); ?>
										<p class="pfwmt font-weight500 text-center"><?php echo e($newDate_flight); ?></p>
									</div>
								</td> -->
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

		<!--Lead Action starts-->
		<!-- enquiry details modal -->
		<?php echo $__env->make('query.query_modal.modal-popup.action-modal.view-enquiry-details', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<!-- view lead history modal -->
		<?php echo $__env->make('query.query_modal.modal-popup.action-modal.view-enquiry-timeline', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


		<!--Lead Details starts-->
		<!-- Modal -->
	</section>
	</div>

	<div class="testing">
		<input type="hidden" value="<?php echo e(url('/')); ?>" name="" id="test">
	</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom_js_code'); ?>
	
	<!-- page script -->
	<script type="text/javascript" src='<?php echo e(asset ("/resources/assets/backend/js/view-history-view-lead.js")); ?>'></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
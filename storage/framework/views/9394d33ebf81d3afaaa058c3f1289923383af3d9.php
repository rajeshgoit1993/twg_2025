<?php $__env->startSection('content'); ?>

<!-- lead manager css -->
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/resources/assets/backend/css/lead-manager.css')); ?>" />

<!-- Lead Modal CSS -->
<link type="text/css" rel="stylesheet" href="<?php echo e(asset('/resources/assets/backend/css/enquiry-timeline.css')); ?>" />

<!-- Lead Modal CSS -->
<link type="text/css" rel="stylesheet" href="<?php echo e(asset('/resources/assets/backend/css/lead-validation.css')); ?>" />

<!-- js modal pop-up -->
<link type="text/css" rel="stylesheet" href="<?php echo e(asset('/resources/assets/backend/css/modal-popup.css')); ?>" />

<!-- search lead -->
<link type="text/css" rel="stylesheet" href="<?php echo e(asset('/resources/assets/backend/css/search-lead.css')); ?>" />

<!-- *********************************************** -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box autoScroll">
				<div class="box-header">
					<!-- query-list page -->
					<h3 class="box-title">Trip Review</h3>
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
						<table id="example1" class="table table-bordered table-striped ">
							<thead>
								<tr>
									<!-- s.no. -->
									<!-- <th style="display: none">S.No.</th> -->

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

										<!-- ************* -->

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

								<!-- lead status, vouchers list & enquiry timeline -->
								<td id=<?php echo e($query->id); ?>>
									<div class="dashboard-inner-table textCenter">
										<select class="query_status q-select">
											<option value="0" <?php if($query->status=="0"): ?> selected <?php endif; ?> disabled>Select Status</option>
											<option value="vouchers_issued" <?php if($query->status=="vouchers_issued"): ?> selected <?php endif; ?>>Tour Vouchers</option>
											<option value="tour_completed" <?php if($query->status=="tour_completed"): ?> selected <?php endif; ?>>Tour Completed</option>
											<option value="reviews" <?php if($query->status=="reviews"): ?> selected <?php endif; ?> disabled>Reviews</option>
											<!--<option value="issue_vouchers" <?php if($query->status=="issue_vouchers"): ?> selected <?php endif; ?>>Issue vouchers</option>-->
										</select>
									</div>

									<!-- --------- -->

									<!-- vochers list -->
									<div class="dashboard-inner-table textCenter">
										<div><u><h5>Issued Vouchers</h5></u></div>
										<button class="btn-backend-main btnInfo voucher_list" data-id="<?php echo e($query->id); ?>" data-toggle="modal">Voucher List</button>
										<!--<button class="btn btn-success resend" data-id="<?php echo e($query->id); ?>" data-toggle="modal">Resend</button>-->
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

								<!-- quote status -->
								<td id=<?php echo e($query->id); ?>>
									<!-- assign user -->
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
									<!-- <?php if(CustomHelpers::check_quote_exist($query->id)!="0"): ?>
										<a href="<?php echo e(url('/quotes/'.CustomHelpers::check_quote_exist($query->id))); ?>" target="_blank">
											<button type="submit" class="btn btn-info lineHeight14" style="width: 100%;padding: 4px 10px;border-radius: 3px">View Quote</button>
										</a>
										<input type="hidden"  value="<?php echo e(url('/quotes/'.CustomHelpers::check_quote_exist($query->id))); ?>" id="copy<?php echo e($query->id); ?>">
									<?php endif; ?> -->

									<!-- view quote -->
									<input type="hidden" class="unique_code" value="<?php echo e(CustomHelpers::custom_encrypt($query->unique_code)); ?>">
									<?php if(!empty($query->unique_code)): ?>
									    <a href="<?php echo e(url('/quotes/' . $query->unique_code)); ?>" target="_blank">
									        <div class="btnContainer">
									            <button type="submit" class="btn-q btn-view-quote" data-id="<?php echo e($query->id); ?>">View Quote</button>
									        </div>
									    </a>
									<?php endif; ?>

									<!-- --------- -->

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

<!--Lead Action starts-->
<!-- enquiry details modal -->
<?php echo $__env->make('query.query_modal.modal-popup.action-modal.view-enquiry-details', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<!-- view lead history modal -->
<?php echo $__env->make('query.query_modal.modal-popup.action-modal.view-enquiry-timeline', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<!-- voucher list modal -->
<?php echo $__env->make('query.query_modal.modal-popup.action-modal.voucher-list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<!-- send voucher modal -->
<?php echo $__env->make('query.query_modal.modal-popup.action-modal.send-voucher', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<!-- *********************************************** -->

<!-- page script -->

<script src="https://code.jquery.com/jquery-2.2.4.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript" src='<?php echo e(asset ("/resources/assets/backend/js/view-history-view-lead.js")); ?>'></script>

<script type="text/javascript" src='<?php echo e(asset ("/resources/assets/backend/js/trip-vouchers.js")); ?>'></script>

<!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
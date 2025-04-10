<?php $__env->startSection('custom_css_code'); ?>

	<!-- lead manager css -->
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/resources/assets/backend/css/lead-manager.css')); ?>" />

	<!-- enquiry timeline CSS -->
	<link type="text/css" rel="stylesheet" href="<?php echo e(asset('/resources/assets/backend/css/enquiry-timeline.css')); ?>" />

	<!-- lead modal CSS -->
	<link type="text/css" rel="stylesheet" href="<?php echo e(asset('/resources/assets/backend/css/lead-validation.css')); ?>" />

	<!-- JS modal pop-up -->
	<link type="text/css" rel="stylesheet" href="<?php echo e(asset('/resources/assets/backend/css/modal-popup.css')); ?>" />

	<!-- search lead -->
	<link type="text/css" rel="stylesheet" href="<?php echo e(asset('/resources/assets/backend/css/search-form.css')); ?>" />

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
						<!-- query-list page -->
						<h3 class="box-title">Active Guest Requests</h3>
					</div>
				<!-- /.box-header -->
					<div class="box-body">
						<!-- add lead -->
						<?php if(Sentinel::check()): ?>
						<?php if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin') || Sentinel::getUser()->inRole('employee') ): ?>
						<div class="add">
							<a href="<?php echo e(URL::to('/add-lead')); ?>">
								<button type="button" class="btn-q btn-addlead"><i class="glyphicon glyphicon-plus-sign"></i> Add New Lead</button>
							</a>
						</div>
						<?php endif; ?>
						<?php endif; ?>

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
						<!-- <thead>
							<tr>
								<th style="display: none">S.No.</th>
								<th>Reference No</th>
								<th style="min-width:150px">Name, Email & Mobile No</th>
								<th width="150px">No of Guests</th>
								!--<th>Package Name</th>--
								<th>Destination & Package</th>
								<th style="min-width:60px">Travel Date</th>
								<th style="min-width:120px">Lead Status</th>
							
								<th style="min-width:80px">Action</th>
							</tr>
						</thead> -->
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

									<!-- lead label -->
									<!-- <th width="200" style="display: none">Lead Verify</th> -->

									<!-- quote status -->
									<th width="100">Quote status</th>

									<!-- action -->
									<th width="100">Action</th>
								</tr>
							</thead>
						<tbody>
							<?php $count="1"; ?>
							<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$query): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
								<?php if(CustomHelpers::get_query_field($query->query_reference,'status')=='' || CustomHelpers::get_query_field($query->query_reference,'status')=="quote_sent" || CustomHelpers::get_query_field($query->query_reference,'status')=="lead_follow_up" || CustomHelpers::get_query_field($query->query_reference,'status')=="process_booking" || CustomHelpers::get_query_field($query->query_reference,'status')=="payment_follow_up" || CustomHelpers::get_query_field($query->query_reference,'status')=="under_cancellation" || CustomHelpers::get_query_field($query->query_reference,'status')=="voucher_issue" || CustomHelpers::get_query_field($query->query_reference,'status')=="voucher_issued" || CustomHelpers::get_query_field($query->query_reference,'status')=="issue_voucher" || CustomHelpers::get_query_field($query->query_reference,'status')=="tour_cancelled" || CustomHelpers::get_query_field($query->query_reference,'status')=="process_refund" || CustomHelpers::get_query_field($query->query_reference,'status')=="refund_processed" || CustomHelpers::get_query_field($query->query_reference,'status')=="refund_under_process"): ?>
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
										
										<!-- travel date, no of guests & nationality -->
										<td>
											<div class="dashboard-inner-table">
												<div><u><h5>Travel Details</h5></u></div>

												<!-- travel date -->
												<p class="q-dtls">
													<!-- <?php if(CustomHelpers::get_query_field($query->query_reference,'date_arrival')!="N" && CustomHelpers::get_query_field($query->query_reference,'date_arrival')!=""): ?>
														<?php
														$date_arrival = CustomHelpers::get_query_field($query->query_reference,'date_arrival');
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
													<?php endif; ?> -->

													<?php if($query->date_arrival!=""): ?>
													<?php
														$date_arrival = CustomHelpers::get_query_field($query->query_reference,'date_arrival');
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
												<p class="q-dtls">
													<?php
													    $adult = 0;
													    $child_with_bed = 0;
													    $child_without_bed = 0;
													    $infant = 0;

													    if ($query->quote1_number_of_adult != '' && $query->quote1_number_of_adult != 0) {
													        $adult += (int) $query->quote1_number_of_adult;
													    }

													    if ($query->extra_adult != '' && $query->extra_adult != 0) {
													        $adult += (int) $query->extra_adult;
													    }

													    if ($query->solo_traveller != '' && $query->solo_traveller != 0) {
													        $adult += (int) $query->solo_traveller;
													    }

													    if ($query->child_with_bed != '' && $query->child_with_bed != 0) {
													        $child_with_bed += (int) $query->child_with_bed;
													    }

													    if ($query->child_without_bed != '' && $query->child_without_bed != 0) {
													        $child_without_bed += (int) $query->child_without_bed;
													    }

													    if ($query->infant != '' && $query->infant != 0) {
													        $infant += (int) $query->infant;
													    }
													?>

													<?php if($adult != "" && $adult != "0"): ?>
													    <?php 
													        $adultText = $adult == 1 ? 'Adult' : 'Adults';
													     ?>
													    <?php echo e($adult); ?> <?php echo e($adultText); ?>

													<?php endif; ?>

													<?php if($child_with_bed != "" && $child_with_bed != "0"): ?>
													    <?php 
													        $childWithBedText = $child_with_bed == 1 ? 'Child (with bed)' : 'Children (with bed)';
													     ?>
													    + <?php echo e($child_with_bed); ?> <?php echo e($childWithBedText); ?>

													<?php endif; ?>

													<?php if($child_without_bed != "" && $child_without_bed != "0"): ?>
													    <?php 
													        $childWithoutBedText = $child_without_bed == 1 ? 'Child (without bed)' : 'Children (without bed)';
													     ?>
													    + <?php echo e($child_without_bed); ?> <?php echo e($childWithoutBedText); ?>

													<?php endif; ?>

													<?php if($infant != "" && $infant != "0"): ?>
													    <?php 
													        $infantText = $infant == 1 ? 'Infant' : 'Infants';
													     ?>
													    + <?php echo e($infant); ?> <?php echo e($infantText); ?>

													<?php endif; ?>
												</p>

												<!-- --------- -->

												<!-- nationality -->
												<?php if($query->nationality!=""): ?>
													<p class="q-dtls"><?php echo e($query->nationality); ?></p>
												<?php endif; ?>
											</div>
										</td>

										<!-- ********************** -->
										
										<!-- travel destination -->
										<td>
											<div class="dashboard-inner-table">

												<!-- destination -->
												<?php if(is_numeric((int) $query->query_reference)): ?>
												    <div><u><h5>Destination</h5></u></div>
												    <?php   
												        $packageId = (int) CustomHelpers::get_query_field((int)$query->query_reference, 'packageId');
												        $cities = CustomHelpers::get_master_table_data('rt_packages', 'id', $packageId, 'city');

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
												            <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												                <li><?php echo e($c); ?></li>
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

												<!-- tour name & link -->
												<!-- <?php if(CustomHelpers::get_query_field((int)$query->query_reference, 'packageId') != "N" && 
												    CustomHelpers::get_query_field((int)$query->query_reference, 'packageId') != "" && 
												    is_numeric((int)CustomHelpers::get_query_field((int)$query->query_reference, 'packageId')) &&
												    !empty($query->package_name)): ?> !-- Check if package name is not empty --
												    <div class="pdngTop7"><u><h5>Tour Name</h5></u></div>
												    <p class="q-dtls">
												        <a href="<?php echo e(url('/Holidays/'.str_slug($query->package_name).'?package_id='.CustomHelpers::custom_encrypt((int)CustomHelpers::get_query_field((int)$query->query_reference, 'packageId')))); ?>" target="_blank">
												        <?php echo e($query->package_name); ?></a>
												    </p>
												<?php endif; ?> -->

												<!-- tour name & link -->
												<!-- <?php if(is_numeric((int) CustomHelpers::get_query_field((int)$query->query_reference, 'packageId')) && 
												    !empty($query->package_name)): ?> !-- Check if package name is not empty --
												    <?php 
												        $packageId = (int) CustomHelpers::get_query_field((int)$query->query_reference, 'packageId');
												        $href_id = CustomHelpers::custom_encrypt($packageId);
												        $form_action = url('/Holidays/' . str_slug($query->package_name)) . '?package_id=' . $href_id;
												     ?>
												    <div class="pdngTop7"><u><h5>Tour Name</h5></u></div>
												    <p class="q-dtls">
												        <a href="<?php echo e($form_action); ?>" target="_blank">
												            <?php echo e($query->package_name); ?>

												        </a>
												    </p>
												<?php endif; ?> -->

												<!-- tour name & link -->
												<?php if(is_numeric((int) CustomHelpers::get_query_field((int)$query->query_reference, 'packageId'))): ?>
												    <?php 
												        $packageId = (int) CustomHelpers::get_query_field((int)$query->query_reference, 'packageId');
												        $packageName = $query->package_name;
												        $href_id = CustomHelpers::custom_encrypt($packageId);
												        $form_action = url('/Holidays/' . str_slug($packageName)) . '?package_id=' . $href_id;
												     ?>

												    <?php if(!empty($packageName)): ?> <!-- Check if package name is not empty -->
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
										<td id=<?php echo e($query->query_reference); ?>>
											<!-- lead current status -->
											<div class="dashboard-inner-table">
												<u><h5>Current Status</h5></u>
												<table>
													<tbody>
														<tr>
															<td>
																<p class="q-user-name" value="<?php echo e(CustomHelpers::get_query_field($query->query_reference,'status')); ?>" selected><?php echo e(CustomHelpers::get_query_field($query->query_reference,'status')); ?></p>
															</td>
														</tr>
													</tbody>
												</table>
											</div>

											<!-- --------- -->

											<!-- assigned user -->
											<?php
												$user_data = DB::table('users')
													->where('id', $query->assign_id)
													->first();
											?>
											<?php if($user_data): ?>
												<div class="dashboard-inner-table textCenter">
													<div><u><h5>Assigned User</h5></u></div>
													<p class="q-user-name"><?php echo e($user_data->first_name); ?> <?php echo e($user_data->last_name); ?></p>
												</div>
											<?php endif; ?>
										</td>

										<!-- ********************** -->

										<!-- quote status -->
										<td id=<?php echo e($query->query_reference); ?>>
											<!-- quote view -->
											<div class="dashboard-inner-table">
												<u><h5>Quote Viewed</h5></u>
												<table>
													<tbody>
													<tr class="makeflex">
														<td class="flexOne">
															<?php if($query->send_option=='0' && $query->accept_status=='0'): ?>
															<p class="q-sendbox">Not Sent</p>
															<?php elseif($query->send_option=='1' && $query->accept_status=='0'): ?>
															<p class="q-noresponsebox">No Response</p>
															<?php elseif($query->send_option=='1' && $query->accept_status=='1'): ?>
															<p class="q-acceptancebox">Quote Accepted</p>
															<?php elseif($query->send_option=='0' && $query->accept_status=='1'): ?>
															<p class="q-acceptancebox">Quote Accepted</p>
															<?php elseif($query->send_option=='1' && $query->accept_status=='2'): ?>
															<p class="q-rejectionbox">Quote Rejected</p>
															<?php elseif($query->send_option=='0' && $query->accept_status=='2'): ?>
															<p class="q-rejectionbox">Quote Rejected</p>
															<?php endif; ?>
														</td>
														<td class="flexOne">
															<?php if($query->quote_view=='0'): ?>
															<p class="q-responsebox">Not Viewed</p>
															<?php else: ?>
															<p class="q-responsebox">Viewed</p>
															<?php endif; ?>
														</td>
													</tr>
													</tbody>
												</table>
											</div>

											<!-- --------- -->

											<!-- guest requests -->
											<!-- <?php 
												$check_raise_concern=DB::table('quote_raise_concern')->where('query_reference',(int)$query->query_reference)->get();
												$pending=DB::table('quote_raise_concern')->where([['query_reference',(int)$query->query_reference],['status',0]])->get();
												$open=DB::table('quote_raise_concern')->where([['query_reference',(int)$query->query_reference],['status',1]])->get();
											?>
											<?php if(count($pending)>0): ?>
											<?php 
												$btn_class='btn-danger';
											?>

											<?php elseif(count($pending)==0 && count($open)>0): ?>
											<?php 
												$btn_class='btn-warning';
											?>

											<?php else: ?>

											<?php 
												$btn_class='btn-success';
											?>
											<?php endif; ?>

											<?php if(count($check_raise_concern)>0): ?>
											<div class="dashboard-inner-table textCenter">
												<u><h5>Guest Concern</h5></u>
												<button class="btn-backend-main btnInfo view_raise raise_btn_class<?php echo e((int)$query->query_reference); ?>" data-id="<?php echo e((int)$query->query_reference); ?>">Guest Requests</button>
											</div>
											<?php endif; ?> -->

											<!-- --------- -->

											<!-- enquiry timeline -->
											<div class="dashboard-inner-table textCenter">
												<div><u><h5>Enquiry Timeline</h5></u></div>
												<button class="btn-backend-main btnInfo view_history" data-id="<?php echo e($query->query_reference); ?>">View History</button>
											</div>

											<!-- --------- -->

											<!-- last update & user -->

											<!-- Quote last update date & time -->
											<!-- <div class="dashboard-inner-table">
												<u><h5>Last updated at</h5></u>
											<div class="q-box">
												<?php $last_updated_at = date("d M Y, H:i:s", strtotime($query->updated_at)); ?>
												<p class="q-dtls textCenter"><?php echo e(date('D',strtotime($query->created_at))); ?>, <?php echo e($last_updated_at); ?></p>
											</div>
											</div> -->
										</td>

										<!-- *************************** -->

										<!-- lead action -->
										<td>
											<?php 
											    // Retrieve all concerns related to the current query reference
											    $check_raise_concern = DB::table('quote_raise_concern')
											        ->where('query_reference', (int)$query->query_reference)
											        ->get();

											    // Retrieve pending concerns (status = 0) for the current query reference
											    $pending = DB::table('quote_raise_concern')
											        ->where([
											            ['query_reference', (int)$query->query_reference],
											            ['status', 0]
											        ])->get();

											    // Retrieve open concerns (status = 1) for the current query reference
											    $open = DB::table('quote_raise_concern')
											        ->where([
											            ['query_reference', (int)$query->query_reference],
											            ['status', 1]
											        ])->get();

											        if (count($pending) > 0) {
												        $btn_class = 'btn-request-pending';
												        $btn_name = 'Pending Requests';
												    } elseif (count($pending) == 0 && count($open) > 0) {
												        $btn_class = 'btn-request-open';
												        $btn_name = 'Active Requests';
												    } else {
												        $btn_class = 'btn-request-closed';
												        $btn_name = 'View Requests';
												    }
											?>

											<!-- Display the button if there are any concerns related to the query reference -->
											<?php if(count($check_raise_concern) > 0): ?>
											    <div class="dashboard-inner-table textCenter">
													<div><u><h5>Guest Requests</h5></u></div>
												    <button class="btn-backend-main <?php echo e($btn_class); ?> view_raise raise_btn_class<?php echo e((int)$query->query_reference); ?>" data-id="<?php echo e((int)$query->query_reference); ?>">
												        <?php echo e($btn_name); ?>

												    </button>
												</div>
											<?php endif; ?>

											<!-- --------- -->

											<!-- view quote -->
											<input type="hidden" class="unique_code" value="<?php echo e(CustomHelpers::custom_encrypt($query->unique_code)); ?>">
											<a href="<?php echo e(url('/quotes/'.$query->unique_code)); ?>" target="_blank">
												<div class="btnContainer">
													<button type="submit" class="btn-q btn-view-quote" data-id="<?php echo e($query->id); ?>">View Quote</button>
												</div>
											</a>

											<!-- --------- -->

											<!-- view lead -->
											<div class="btnContainer">
												<button class="btn-q btn-viewlead open-enquiryModal" data-id="<?php echo e($query->query_reference); ?>" data-toggle="modal">View Lead</button>
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
							<?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
						</tbody>
					</table>
					</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- /.content -->
	</div>

	<div class="testing">
		<input type="hidden" value="<?php echo e(url('/')); ?>" name="" id="test">
	</div>

	<!--Lead Action starts-->
	<!-- enquiry details modal -->
	<?php echo $__env->make('query.query_modal.modal-popup.action-modal.view-enquiry-details', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<!-- view lead history modal -->
	<?php echo $__env->make('query.query_modal.modal-popup.action-modal.view-enquiry-timeline', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<!-- view raised concern modal -->
	<?php echo $__env->make('query.query_modal.modal-popup.action-modal.edit-raised-concern', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('custom_js_code'); ?>

	<!-- page script -->
	<script type="text/javascript" src='<?php echo e(asset ("/resources/assets/backend/js/concern-raised.js")); ?>'></script>

	<script type="text/javascript" src='<?php echo e(asset ("/resources/assets/backend/js/view-history-view-lead.js")); ?>'></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
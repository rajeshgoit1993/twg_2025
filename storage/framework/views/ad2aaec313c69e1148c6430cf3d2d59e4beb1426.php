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
						<h3 class="box-title">
						<!-- query-quotation page -->
						<?php if($val=='quote_sent'): ?>
							Quote Sent
							<?php elseif($val=='lead_follow_ups'): ?>
								Lead Follow-up 
							<?php elseif($val=='process_booking'): ?>
								Process Booking <span class="font16">(proceed to confirm services)</span>
							<?php elseif($val=='payment_follow_up'): ?>
								Payment Follow-up
							<?php elseif($val=='under_cancellation'): ?>
								Trip Under Cancellation
							<?php elseif($val=='confirmation'): ?>
								Issue Voucher <span class="font16">(Tour Confirmation)</span>
							<?php elseif($val=='voucher_issued'): ?>
								Trip Vouchers
							<?php elseif($val=='tour_cancelled'): ?>
								Trip Cancelled
							<?php elseif($val=='refund_issued'): ?>
								Process Refund <span class="font16">(Refund Issued)</span>
							<?php else: ?>
								Quotation List
						<?php endif; ?>
						</h3>
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
									<th style="display: none">S.No.</th>

									<!-- quote reference no -->
									<th style="width: 135px">Reference No</th>

									<!-- guest details -->
									<th style="min-width: 180px">Guest Name,<br>Mobile No & Email id</th>

									<!-- travel date & nationality -->
									<th style="width: 150px">Travel Date,<br>Guests & Nationality</th>

									<!-- travel destination -->
									<th style="min-width: 180px">Destination & <br>Package Name</th>

									<!-- lead status -->
									<th style="width: 180px">Lead Status</th>

									<!-- quote status -->
									<th style="width: 180px">Quote status</th>

									<!-- last update & user -->
									<!-- <th style="min-width:80px">
									<?php if($val==='process_booking' || $val==='payment_follow_up' || $val==='under_cancellation' || $val==='confirmation' || $val==='voucher_issued' || $val==='tour_cancelled' ): ?> 
										Payment
									<?php else: ?>
										Updated
									<?php endif; ?> 
									<br>Date & Time 
									</th> -->

									<!-- payment status -->
									<th style="width: 240px">Payment Status</th>
									
									<!-- action -->
									<th width="70px">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $count="1"; ?>
								<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$query): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
									<?php if(CustomHelpers::get_query_field($query->query_reference,'status')=='' || 
									CustomHelpers::get_query_field($query->query_reference,'status')=="quote_sent" || CustomHelpers::get_query_field($query->query_reference,'status')=="lead_follow_up" || CustomHelpers::get_query_field($query->query_reference,'status')=="process_booking" || CustomHelpers::get_query_field($query->query_reference,'status')=="payment_follow_up" || CustomHelpers::get_query_field($query->query_reference,'status')=="under_cancellation" || CustomHelpers::get_query_field($query->query_reference,'status')=="voucher_issue" || CustomHelpers::get_query_field($query->query_reference,'status')=="voucher_issued" || CustomHelpers::get_query_field($query->query_reference,'status')=="issue_voucher" || CustomHelpers::get_query_field($query->query_reference,'status')=="tour_cancelled" || CustomHelpers::get_query_field($query->query_reference,'status')=="process_refund" || CustomHelpers::get_query_field($query->query_reference,'status')=="refund_processed" || CustomHelpers::get_query_field($query->query_reference,'status')=="refund_under_process"): ?>
								<tr>
									<!-- s.no. -->
									<td style="display: none"><?php echo e($count++); ?></td>

									<!-- quote reference no -->
									<td id=<?php echo e($query->query_reference); ?>>
										<!-- enquiry reference no -->
										<div class="dashboard-inner-table">
										    <div><u><h5>Enquiry Reference No</h5></u></div>

										    
										    
										    <!-- enquiry reference no -->
										    <?php if(isset($query->enquiry_ref_no)): ?>
										        <p class="q-dtls">#<?php echo e($query->enquiry_ref_no); ?></p>
										    <?php else: ?>
										        <p class="q-dtls">No enquiry id available.</p>
										    <?php endif; ?>

										    <!-- service type -->
										    <p class="q-dtls">
										    	<?php echo e($query->service_type ?? 'No service type available.'); ?>

										    </p>

										    <!-- channel type -->
										    <p class="q-dtls">
										    	<?php echo e($query->channel_type ?? 'No channel type available.'); ?>

										    </p>
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

										<!-- --------- -->

										<div class="dashboard-inner-table">
											<u><h5>Payment Last updated</h5></u>
											<?php if($val==='process_booking' || $val==='payment_follow_up' || $val==='under_cancellation' || $val==='confirmation' || $val==='voucher_issued' || $val==='tour_cancelled' ): ?>
												<?php
													$latest_payment=DB::table('rt_payments')->where([['quote_ref_no','=',$query->quo_ref],['status','=',1],['transaction_type','=',0]])->latest()->first();
												?>
												<p class="q-dtls textCenter"><?php echo e(date('D',strtotime($latest_payment->created_at))); ?>, <?php echo e(date("d M Y, H:i:s", strtotime($latest_payment->updated_at))); ?></p>
											<?php else: ?>
											<?php
												$newDate_flight = date("d M Y, H:i:s", strtotime($query->updated_at)); ?>
											<p class="q-dtls textCenter"><?php echo e(date('D',strtotime($query->created_at))); ?>, <?php echo e($newDate_flight); ?></p>
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
											<?php if($query->mobile!=""): ?>
												<p class="q-dtls"><?php echo e($query->mobile); ?></p>
											<?php endif; ?>
											<p class="q-dtls"><?php echo e($query->email); ?></p>
										</div>
									</td>

									<!-- ********************** -->

									<!-- travel date, no of guests & nationality -->
									<td>
										<div class="dashboard-inner-table">
											<div><u><h5>Travel Details</h5></u></div>

										<!-- travel date -->

										<!-- <?php if(CustomHelpers::get_query_field($query->query_reference,'date_arrival')!="N" && CustomHelpers::get_query_field($query->query_reference,'date_arrival')!=""): ?>
										<p class="q-dtls">
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
										</p>
										<?php endif; ?> -->

										<!-- -- -->

										<!-- <p class="q-dtls"><?php echo e(CustomHelpers::get_tour_date($query->tour_date)); ?></p> -->

										<!-- -- -->

										<!-- travel date -->
										
											<p class="q-dtls">
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

											    if ($query->adult != '' && $query->adult != 0) {
											        $adult += (int) $query->adult;
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
										<?php if($query->country_of_residence!=""): ?>
											<p class="q-dtls"><?php echo e($query->country_of_residence); ?></p>
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
									<td id="<?php echo e($query->query_reference); ?>" enquiry_ref_no="<?php echo e($query->enquiry_ref_no); ?>"  quote_ref_no="<?php echo e($query->quo_ref); ?>">
										<div class="dashboard-inner-table textCenter">

											<div><u><h5>Update status</h5></u></div>
<div>
											<select class="query_status q-select previous_class_<?php echo e($query->enquiry_ref_no); ?>_<?php echo e($count); ?>" dynamic_class_name="previous_class_<?php echo e($query->enquiry_ref_no); ?>_<?php echo e($count); ?>">
												<?php if($val=='process_booking' || $val=='payment_follow_up' || $val=='under_cancellation' || $val=='confirmation' || $val=='voucher_issued' || $val=='tour_cancelled' || $val=='refund_issued'): ?>
												<?php
													$quote_no=CustomHelpers::get_query_field($query->query_reference,'accept_quote_no');
													$quote_id=CustomHelpers::get_query_field($query->query_reference,'accept_quote_id');

													if($quote_no==1) {
												        $data=DB::table('option1_quotation')->where('id',(int)$quote_id)->first();
												        $quote_ref_no=$data->quo_ref;
												        $price=$data->option1_price;
												        $price_data=CustomHelpers::get_price_part_seperate($data->option1_price,$data->quote1_number_of_adult,$data->extra_adult,$data->child_with_bed,$data->child_without_bed,$data->infant,$data->solo_traveller);
												        } elseif($quote_no==2) {
													        $data=DB::table('option2_quotation')->where('id',(int)$quote_id)->first();
													        $quote_ref_no=$data->quotation_ref_no;
													        $price=$data->option2_price;
												        } elseif($quote_no==3) {
												        	$data=DB::table('option3_quotation')->where('id',(int)$quote_id)->first();
												        	$quote_ref_no=$data->quotation_ref_no;
												        	$price=$data->option3_price;
												        } elseif($quote_no==4) {
												        	$data=DB::table('option4_quotation')->where('id',(int)$quote_id)->first();
												        	$quote_ref_no=$data->quotation_ref_no;
												        	$price=$data->option4_price;
												        }
														$amount=$price_data['query_pricetopay_adult'];
														$due_amount=CustomHelpers::get_remaining_due($quote_ref_no,$amount);
														$pg_charge=CustomHelpers::get_pg_charge($quote_ref_no);
												?>
												<?php endif; ?>
				                             
				                              	<?php if($val=='quote_sent'): ?>

													<option value="quote_sent" <?php if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="quote_sent"): ?> selected <?php endif; ?>>Quote Sent</option>

													<option value="lead_follow_up" <?php if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="lead_follow_up"): ?> selected <?php endif; ?>>Lead Follow-up</option>

													<option value="lead_cancelled" <?php if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="lead_cancelled"): ?> selected <?php endif; ?>>Lead Cancelled</option>

												<?php elseif($val=='lead_follow_ups'): ?>

													<option value="lead_follow_up" <?php if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="lead_follow_up"): ?> selected <?php endif; ?>>Lead Follow-up</option>

													<option value="lead_cancelled" <?php if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="lead_cancelled"): ?> selected <?php endif; ?>>Lead Cancelled</option>

												<?php elseif($val=='process_booking'): ?>

													<option value="process_booking" <?php if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="process_booking"): ?> selected <?php endif; ?>>Process Booking</option>

													<option value="payment_follow_up" <?php if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="payment_follow_up"): ?> selected <?php endif; ?>>Payment Follow-up</option>

													<option value="issue_voucher" <?php if($due_amount>0): ?> disabled <?php endif; ?>>Issue Voucher</option>

													<option value="under_cancellation" <?php if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="under_cancellation"): ?> selected <?php endif; ?>>Under Cancellation</option>

													<option value="tour_cancelled" <?php if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="tour_cancelled"): ?> selected <?php endif; ?>>Tour Cancelled</option>

												<?php elseif($val=='payment_follow_up'): ?>

													<option value="payment_follow_up" <?php if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="payment_follow_up"): ?> selected <?php endif; ?>>Payment Pending</option>

													<option value="payment_follow_up">Add Payment Follow-up</option>

													<option value="issue_voucher" <?php if($due_amount>0): ?> disabled <?php endif; ?>>Issue Voucher</option>

													<option value="under_cancellation" <?php if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="under_cancellation"): ?> selected <?php endif; ?>>Under Cancellation</option>

													<option value="tour_cancelled" <?php if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="tour_cancelled"): ?> selected <?php endif; ?>>Tour Cancelled</option>

												<?php elseif($val=='under_cancellation'): ?>

													<option value="under_cancellation" <?php if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="under_cancellation"): ?> selected <?php endif; ?>>Under Cancellation</option>
													<option value="issue_voucher" <?php if($due_amount>0): ?> disabled <?php endif; ?>>Issue Voucher</option>

													<option value="tour_cancelled" <?php if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="tour_cancelled"): ?> selected <?php endif; ?>>Tour Cancelled</option>

												<?php elseif($val=='confirmation'): ?>

													<option value="issue_voucher" disabled <?php if($due_amount>0): ?> disabled <?php else: ?> <?php if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="issue_voucher"): ?> selected <?php endif; ?> <?php endif; ?>>Voucher Pending</option>

													<option value="voucher_issued" <?php if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="voucher_issued"): ?> selected <?php endif; ?>>Tour Vouchers Issued</option>

													<option value="under_cancellation" disabled <?php if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="under_cancellation"): ?> selected <?php endif; ?>>Under Cancellation</option>

													<option value="tour_cancelled" <?php if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="tour_cancelled"): ?> selected <?php endif; ?>>Tour Cancelled</option>

												<?php elseif($val=='voucher_issued'): ?>

													<option value="voucher_issued" <?php if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="voucher_issued"): ?> selected <?php endif; ?>>Vouchered</option>

													<option value="tour_completed" <?php if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="tour_completed"): ?> selected <?php endif; ?>>Tour Completed</option>

													<option disabled value="under_cancellation" <?php if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="under_cancellation"): ?> selected <?php endif; ?>>Under Cancellation</option>

													<option value="tour_cancelled" <?php if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="tour_cancelled"): ?> selected <?php endif; ?>>Tour Cancelled</option>

												<?php elseif($val=='tour_cancelled'): ?>

													<option value="tour_cancelled" <?php if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="tour_cancelled"): ?> selected <?php endif; ?>>Tour Cancelled</option>
													<!-- <option value="process_refund" <?php if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="process_refund"): ?> selected <?php endif; ?>>Process Refund</option> -->

													<option value="refund_under_process" <?php if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="refund_under_process"): ?> selected <?php endif; ?>>Refund Under Process</option>

												<?php elseif($val=='refund_issued'): ?>

													<!-- <option value="process_refund" <?php if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="process_refund"): ?> selected <?php endif; ?>>Process Refund</option> -->
													<?php 
														$refunded_amounts=CustomHelpers::get_refunded_amount($query->quo_ref);
													?>
													<option value="refund_processed" <?php if($refunded_amounts==0): ?> disabled <?php endif; ?>  <?php if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="refund_processed"): ?> selected <?php endif; ?>>Refund Processed</option>

													<option value="refund_under_process" <?php if($refunded_amounts>0): ?> disabled <?php endif; ?> <?php if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="refund_under_process"): ?> selected <?php endif; ?>>Refund Under Process</option>

												<?php else: ?>
													<option value="quote_sent" <?php if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="quote_sent"): ?> selected <?php endif; ?>>Quote Sent</option>

					                                <option value="lead_follow_up" <?php if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="lead_follow_up"): ?> selected <?php endif; ?>>Lead Follow-up</option>

					                                <!-- <option value="follow_up_pending" <?php if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="follow_up_pending"): ?> selected <?php endif; ?>>Follow-up Pending</option> -->

					                                <option value="process_booking" <?php if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="process_booking"): ?> selected <?php endif; ?>>Process Booking</option>

					                                <!-- <option value="booking_confirmed" <?php if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="booking_confirmed"): ?> selected <?php endif; ?>>Booking Confirmed</option> -->

					                                <option value="payment_follow_up" <?php if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="payment_follow_up"): ?> selected <?php endif; ?>>Payment Follow-up</option>   

													<option value="under_cancellation" <?php if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="under_cancellation"): ?> selected <?php endif; ?>>Under Cancellation</option>

													<option value="issue_voucher" <?php if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="issue_voucher"): ?> selected <?php endif; ?>>Issue Voucher</option>

													<option value="voucher_issued" <?php if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="voucher_issued"): ?> selected <?php endif; ?>>Voucher Issued</option>

													<option value="tour_completed" <?php if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="tour_completed"): ?> selected <?php endif; ?>>Tour Completed</option>

													<option value="send_review_form" <?php if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="send_review_form"): ?> selected <?php endif; ?>>Send Review Form</option>

													<option value="tour_cancelled" <?php if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="tour_cancelled"): ?> selected <?php endif; ?>>Tour Cancelled</option>

													<option value="process_refund" <?php if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="process_refund"): ?> selected <?php endif; ?>>Process Refund</option>

													<option value="refund_processed" <?php if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="refund_processed"): ?> selected <?php endif; ?>>Refund Processed</option>

													<option value="lead_cancelled" <?php if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="lead_cancelled"): ?> selected <?php endif; ?>>Lead Cancelled</option>

													<option value="na" <?php if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="na"): ?> selected <?php endif; ?>>Not Applicable</option>
												<?php endif; ?>
											</select>
<div>
											<!-- --------- -->

											<!-- add remarks -->
											<?php if($val!='refund_issued'): ?>
												<!-- add remarks into lead -->
												<button class="btn-backend-main btnInfo submit_status" data-id="<?php echo e($query->id); ?>">Add Lead Remarks</button>
											<?php endif; ?>
										</div>

										<!-- --------- -->

										<!-- resend quote -->
										<!-- refund issued -->
										<?php if($val!='refund_issued'): ?>
											<div class="dashboard-inner-table textCenter">
				               					<div><u><h5>Resend Quote</h5></u></div>
												<!-- <div class="q-box textCenter"> -->
												<select class="q-select">
													<option id="0" quotation_no='0' ref_no='0'>Select Quote</option>
													<?php echo e(CustomHelpers::get_quotation_option($query->quo_ref)); ?>

												</select>
												<button class="btn-backend-main btnInfo quotation_send">Email Quote</button>
											</div>
										<?php endif; ?>

										<!-- --------- -->

										<!-- lead follow-up -->
										<?php if($val=='lead_follow_ups'): ?>
											<?php 
												$lead_follow_up_data=DB::table('enquiry_lead_follow_up')->where('enquiry_id',$query->query_reference)->latest()->first();
												$reason=DB::table('lead_dynamic_field')->where('id',$lead_follow_up_data->reason)->first();
											?>
											<div class="dashboard-inner-table apndTop7">
												<div><u><h5>Lead follow-up details</h5></u></div>
												<p class="q-dtls">Follow-up date: <?php echo e(date('d-m-Y', strtotime($lead_follow_up_data->follow_up_date))); ?></p>
												<p class="q-dtls">Follow-up time: <?php echo e($lead_follow_up_data->follow_up_time); ?> hrs.</p>
												<p class="q-dtls">Reason: <?php echo e($reason->field_name); ?></p>
											</div>
										<?php endif; ?>

										<!-- *************************** -->

										<!-- assigned user -->
										<?php
											$user_data = DB::table('users')
												->where('id', $query->assign_id)
												->first();
										?>
										<?php if($user_data): ?>
											<div class="dashboard-inner-table textCenter">
												<div><u><h5>Assigned Consultant</h5></u></div>
												<p class="q-user-name"><?php echo e($user_data->first_name); ?> <?php echo e($user_data->last_name); ?></p>
											</div>
										<?php endif; ?>

										<!-- --------- -->

										<!-- payment follow-up -->
										<?php if($val=='payment_follow_up'): ?>
											<?php
												$lead_follow_up_data=DB::table('payment_follow_up')->where('enquiry_id',$query->query_reference)->latest()->first();
											?>
											<p>Follow up Date: <?php echo e(date('d-m-Y', strtotime($lead_follow_up_data->follow_up_date))); ?></p>
											<p>Follow up Time: <?php echo e($lead_follow_up_data->follow_up_time); ?></p>
											<p>Remarks: <?php echo e($lead_follow_up_data->remarks); ?></p>
										<?php endif; ?>
									</td>

									<!-- ********************** -->

									<!-- quote status -->
									<td id=<?php echo e($query->query_reference); ?>>
										<!-- booking label -->
<?php if(Sentinel::check()): ?>
										<?php if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin') || Sentinel::getUser()->inRole('supervisor')): ?>

										<div class="dashboard-inner-table textCenter">
												<div><u><h5>Assign Consultant</h5></u></div>
											    <select class="user_assign q-select">
													<option <?php if($query->assign_id=="0"): ?> selected <?php endif; ?> value="0">Unassigned</option>
													<?php $__currentLoopData = $employee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employees): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
													   <option value="<?php echo e($employees->id); ?>" <?php if($query->assign_id==$employees->id): ?> selected <?php endif; ?> ><?php echo e($employees->first_name); ?> <?php echo e($employees->last_name); ?></option>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
												</select>
											</div>
											<?php endif; ?>
										<?php endif; ?>


										<div class="dashboard-inner-table">
											<table>
												<tr>
													<td><label>Lead Label</label></td>
													<td>
													  <div>
														<select class="q-select booking_label">
															<?php $__currentLoopData = $booking_lavel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b_label): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
																<option value="<?php echo e($b_label->id); ?>" <?php if($query->booking_label==$b_label->id): ?> selected <?php endif; ?>><?php echo e($b_label->field_name); ?></option>
															<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
														</select>
													  </div>
													</td>
												</tr>
											</table>
										</div>

										<!-- --------- -->

										<!-- quote view -->
										<div class="dashboard-inner-table">
											<u><h5>Quote Viewed</h5></u>
											<table>
												<!--<thead>
													<tr>
														<th><u>Description</u></th>
														<th><u>Amount</u></th>
													</tr>
												</thead>-->
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

										<!-- quote raise concern -->
										<?php 
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

										<!-- --------- -->

										<!-- update guest concern -->
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

									<!-- ********************** -->

									<!-- payment status -->
									<td id=<?php echo e($query->query_reference); ?>>
										<!-- payment details starts -->
										<?php if($val=='process_booking' || $val=='payment_follow_up' || $val=='under_cancellation' || $val=='confirmation' || $val=='voucher_issued' || $val=='tour_cancelled' || $val=='refund_issued'): ?>
											<?php
												$main_paid=(int)$amount-(int)$due_amount;
											?>
											<div class="dashboard-inner-table">
												<u><h5>Payment Details</h5></u>
												<table>
													<thead>
														<tr>
															<th><u>Description</u></th>
															<th><u>Amount</u></th>
														</tr>
													</thead>
													<tbody>
													<tr>
														<td>Service total</td>
														<td><span class="defaultCurencyPay"></span> <?php echo e($amount); ?></td>
													</tr>
													<tr>
														<td style="color: green;">Amt received (-)</td>
														<td style="color: green;"><span class="defaultCurencyPay"></span> <b><?php echo e($main_paid); ?></b></td>
													</tr>
													<tr>
														<td style="color: red;">Amt pending</td>
														<td style="color: red;"><span class="defaultCurencyPay"></span> <b><?php echo e($due_amount); ?></b></td>
													</tr>
													<tr>
														<td style="color: grey;">MDR fees (+)</td>
														<td style="color: grey;"><span class="defaultCurencyPay"></span> <?php echo e($pg_charge); ?></td>
													</tr>
													<tr>
														<td>Total received</td>
														<td><span class="defaultCurencyPay"></span> <?php echo e((int)$main_paid+(int)$pg_charge); ?></td>
													</tr>
													</tbody>
												</table>
											</div>
										<?php endif; ?>

										<!-- --------- -->

										<!-- refund details -->
										<?php if($val=='refund_issued'): ?>
										<?php  
											$total_refundable_amount = DB::table('refund_create')
									       		->where('quote_ref_no','=',$query->quo_ref)
									       		->sum('refund_amount');

											$refunded_amounts=CustomHelpers::get_refunded_amount($query->quo_ref);
											$cancellation_charge=DB::table('refund_create')
									       		->where('quote_ref_no','=',$query->quo_ref)
									       		->sum('cancellation_charge');
											$due_refund_amount=(int)$total_refundable_amount-(int)$refunded_amounts;
										?>
										<div class="dashboard-inner-table">
											<u><h5>Refund Details</h5></u>
											<table>
												<thead>
													<tr>
														<th><u>Description</u></th>
														<th><u>Amount</u></th>
													</tr>
												</thead>
												<tbody>
												<tr>
													<td>Service total</td>
													<td><span class="defaultCurencyPay"></span> <?php echo e($amount); ?></td>
												</tr>
												<tr>
													<td style="color: green;">Cancellation charges (-)</td>
													<td style="color: green;"><span class="defaultCurencyPay"></span> <b><?php echo e($cancellation_charge); ?></b></td>
												</tr>
												<tr>
													<td>Refundable Amount</td>
													<td><span class="defaultCurencyPay"></span> <?php echo e($total_refundable_amount); ?></td>
												</tr>
												<tr>
													<td style="color: grey;">Amt refunded (-)</td>
													<td style="color: grey;"><span class="defaultCurencyPay"></span> <b><?php echo e($refunded_amounts); ?></b></td>
												</tr>
												<!-- <tr>
													<td style="color: grey;">MDR fees (NRF)</td>
													<td style="color: grey;"><span class="defaultCurencyPay"></span> <?php echo e($pg_charge); ?></td>
												</tr> -->
												<tr>
													<td style="color: red;">Refund pending</td>
													<td style="color: red;"><span class="defaultCurencyPay"></span> <?php echo e($due_refund_amount); ?></td>
												</tr>
												</tbody>
											</table>
										</div>
										<?php endif; ?>

										<!-- --------- -->

										<!-- Add payment/refund -->
										<div class="dashboard-inner-table">
											<div><u><h5>Add Payment</h5></u></div>
											<table>
												<tr>
													<!-- <td><h5>Payment status</h5></td> -->
													<td>
														<select class="q-select quote_no" <?php if($val==='refund_issued'): ?> style="display:none;" <?php endif; ?>>
															<option id="0" quotation_no='0' ref_no='0'>Select Quote</option>
															<?php if($val==='process_booking' || $val==='payment_follow_up' || $val==='under_cancellation' || $val==='confirmation' || $val==='voucher_issued' || $val==='tour_cancelled'  || $val==='refund_issued'): ?>
																<option id="<?php echo e(CustomHelpers::get_query_field($query->query_reference,'accept_quote_id')); ?>" selected quotation_no="<?php echo e(CustomHelpers::get_query_field($query->query_reference,'accept_quote_no')); ?>" ref_no="<?php echo e($query->query_reference); ?>">Quote<?php echo e(CustomHelpers::get_query_field($query->query_reference,'accept_quote_no')); ?></option>
															<?php else: ?>
																<?php echo e(CustomHelpers::get_quotation_option($query->quo_ref)); ?>

															<?php endif; ?>
														</select>
													</td>
													<td>
													  <div>
														<select class="payment_status q-select">
															<?php if($val=='quote_sent' || $val=='lead_follow_ups'): ?>
																<option value="Unpaid" <?php if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')==""): ?> selected <?php endif; ?>> Unpaid</option>

																<option value="Add Payment">Add Payment</option>

															<?php elseif($val=='process_booking'): ?>
																<option value="Partial Paid" <?php if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')=="Partial Paid"): ?> selected <?php endif; ?>> Partial Paid</option>

																<option value="Full Paid" <?php if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')=="Full Paid"): ?> selected <?php endif; ?>> Full Paid</option>

																<option value="Add Payment"> Add Payment</option>

															<?php elseif($val=='payment_follow_up'): ?>
																<option value="Partial Paid" <?php if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')=="Partial Paid"): ?> selected <?php endif; ?>> Partial Paid</option>

																<option value="Full Paid" <?php if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')=="Full Paid"): ?> selected <?php endif; ?>> Full Paid</option>
															
																<option value="Add Payment"> Add Payment</option>

															<?php elseif($val=='under_cancellation'): ?>

																<option value="Partial Paid" <?php if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')=="Partial Paid"): ?> selected <?php endif; ?>> Partial Paid</option>

																<option value="Full Paid" <?php if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')=="Full Paid"): ?> selected <?php endif; ?>> Full Paid</option>

																<option value="Refund Partial Paid" <?php if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')=="Refund Partial Paid"): ?> selected <?php endif; ?>> Refund Partial Paid</option>

																<option value="Refund Paid" <?php if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')=="Refund Paid"): ?> selected <?php endif; ?>> Refund Paid</option>

																<option value="Not Applicable" <?php if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')=="Not Applicable"): ?> selected <?php endif; ?>> Not Applicable</option>

															<?php elseif($val=='confirmation'): ?>

																<option value="Full Paid" <?php if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')=="Full Paid"): ?> selected <?php endif; ?>> Full Paid</option>

															<?php elseif($val=='voucher_issued'): ?>

																<option value="Full Paid" <?php if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')=="Full Paid"): ?> selected <?php endif; ?>> Full Paid</option>

															<?php elseif($val=='tour_cancelled'): ?>

																<option value="Refund Unpaid" <?php if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')=="Refund Unpaid"): ?> selected <?php endif; ?>> Refund Unpaid</option>

															<?php elseif($val=='refund_issued'): ?>
																<?php
																	$refund_status=CustomHelpers::check_refund_status($query->quo_ref,$amount);
																?>
																<option value="Refund Payment" <?php if($refund_status==0): ?> disabled <?php endif; ?> > Refund Payment</option>
															
																<option value="Refund Partial Paid" <?php if($refund_status==0): ?> disabled <?php else: ?> <?php if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')=="Refund Partial Paid"): ?> selected <?php endif; ?> <?php endif; ?>> Refund Partial Paid</option>

																<option value="Refund Full Paid" <?php if($refund_status==0): ?> disabled <?php else: ?> <?php if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')=="Refund Full Paid"): ?> selected <?php endif; ?> <?php endif; ?>> Refund Full Paid</option>
															
																<option value="Refund Create" <?php if($refund_status==0): ?> selected <?php endif; ?> > Refund Create</option>
															
															<?php else: ?>
																<option value="Unpaid" <?php if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')==""): ?> selected <?php endif; ?>> Unpaid</option>

																<option value="Partial Paid" <?php if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')=="Partial Paid"): ?> selected <?php endif; ?>> Partial Paid</option>

																<option value="Full Paid" <?php if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')=="Full Paid"): ?> selected <?php endif; ?>> Full Paid</option>

																<option value="Refund Unpaid" <?php if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')=="Refund Unpaid"): ?> selected <?php endif; ?>> Refund Unpaid</option>

																<option value="Refund Partial Paid" <?php if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')=="Refund Partial Paid"): ?> selected <?php endif; ?>> Refund Partial Paid</option>

																<option value="Refund Paid" <?php if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')=="Refund Paid"): ?> selected <?php endif; ?>> Refund Paid</option>

																<option value="Not Applicable" <?php if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')=="Not Applicable"): ?> selected <?php endif; ?>> Not Applicable</option>

																<option value="Payment Failed" <?php if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')=="Payment Failed"): ?> selected <?php endif; ?>> Payment Failed</option>
															
															<?php endif; ?>
														</select>
													  </div>
													</td>
												</tr>
												<tr>
												</tr>
											</table>

											<!-- add payment -->
											<button type="button" class="btn-backend-main btnInfo submit_payment_status" data-id="<?php echo e($query->id); ?>">Add Payment</button>
										</div>
									</td>

									<!-- *************************** -->

									<!-- lead action -->
									<td>
										<!-- view quote -->
										<!-- <input type="hidden" class="unique_code" value="<?php echo e(CustomHelpers::custom_encrypt($query->unique_code)); ?>"> -->
										<a href="<?php echo e(url('/quotes/'.$query->unique_code)); ?>" target="_blank">
											<div class="btnContainer">
												<button type="submit" class="btn-q btn-view-quote" data-id="<?php echo e($query->id); ?>">View Quote</button>
											</div>
										</a>

										<!-- --------- -->

										<!-- WhatsApp copy -->
										<div class="btnContainer">
											<?php 
$ref=url('/quotes/' . $query->unique_code);
											?>
											<input type="hidden" value="We have sent the Tour quote on your email-id. Click on the link to check your quote: <?php echo e($ref); ?>" id="copy_whatsup<?php echo e($query->id); ?>">

											<button type="button" class="btn-q btn-whatsapp" link="copy_whatsup<?php echo e($query->id); ?>">WhatsApp</button>
										</div>


										<!-- --------- -->

										<!-- copy quote link -->
										<div class="btnContainer">
											<input type="hidden" value="<?php echo e(url('/quotes/'.$query->unique_code)); ?>" id="copy<?php echo e($query->id); ?>">
											<button type="submit" class="btn-q btn-copylink link" link="copy<?php echo e($query->id); ?>">Copy Quote Link</button>
										</div>

										<!-- --------- -->

										<!-- extend validity -->
										<div class="btnContainer">
											<!-- <button type="button" class="btn-q btn-validity open-extendValidityModal" data-id="<?php echo e($query->query_reference); ?>" data-toggle="modal">Extend Validity</button> -->
											<!-- <button type="button" class="btn-q btn-validity open-extendValidityModal" data-id="" data-toggle="modal" data-target="#extendValidityModal"> -->
											<button type="button" class="btn-q btn-validity open-extendValidityModal" query_id="<?php echo e($query->quo_ref); ?>">Extend Validity</button>
										</div>

										<!-- --------- -->

										<!-- email to supplier -->
										<a href="<?php echo e(url('send_supplier_email/'.$query->quo_ref)); ?>" target="_blank">
											<div class="btnContainer">
												<button type="button" class="btn-q btn-viewlead" query_id="<?php echo e($query->query_reference); ?>">Email to Supplier</button>
											</div>
										</a>

										<!-- --------- -->

										<!-- voucher upload -->
										<?php if($val=='voucher_issued'): ?>
											<?php 
												$check_uploaded_files=DB::table('lead_voucher')->where('lead_id',$query->query_reference)->get();
											?>
											<?php if(count($check_uploaded_files)>0): ?>
											<div class="btnContainer">
												<button type="submit" class="btn-q btnSuccess send_voucher" data-id="<?php echo e($query->query_reference); ?>" data-toggle="modal">Upload Voucher</button>
											</div>
											<?php endif; ?>
										<?php endif; ?>

										<!-- --------- -->

										<!-- add trip service -->
										<?php if($val=='process_booking' || $val=='payment_follow_up' || $val=='under_cancellation'  || $val=='voucher_issue' || $val=='confirmation'  || $val=='voucher_issued'|| $val=='tour_cancelled' || $val=='refund_issued' ): ?>

											 <!-- Service Type Button -->
											<div class="btnContainer">
												<button type="button" class="btn-q btn-editquote service_sype" query_id="<?php echo e($query->query_reference); ?>">Service Type</button>
											</div>

											<!-- --------- -->

											<!-- Payment History Button -->
											<div class="btnContainer">
												<button type="button" class="btn-q btn-payment-ledger payment_history" query_id="<?php echo e($query->quo_ref); ?>">Payment Ledger</button>
											</div>

										<?php else: ?>

											<!-- Edit Quote Button -->
											<?php
											    $travel_date = $query->tour_date;
											    $today = date('Y-m-d');
											?>

											<?php if($travel_date >= $today): ?>
												<!-- Edit Quote Button (Active) -->
											    <a href="<?php echo e(URL::to('/edit_quation/' . $query->quo_ref . '/' . $query->query_reference)); ?>">
											        <div class="btnContainer">
											            <button type="button" class="btn-q btn-editquote">Edit Quote</button>
											        </div>
											    </a>
											<?php else: ?>
												<!-- Edit Quote Button (Expired and Disabled) -->
											    <a href="#">
											    	<div class="btnContainer">
											        	<button type="button" class="btn-q btn-trip-expired" disabled>Edit Quote (expired)</button>
											        </div>
											    </a>
											<?php endif; ?>
										<?php endif; ?>

										<!-- --------- -->

										<!-- Add/Edit Guests -->
										<div class="btnContainer">
											<input type="hidden" class="unique_code" value="<?php echo e(CustomHelpers::custom_encrypt($query->unique_code)); ?>">
											<button type="button" class="btn-q btn-viewlead add_edit_passenger" content_action="<?php echo e(route('add_edit_passenger')); ?>">Traveller</button>
										</div>

										<!-- --------- -->

										<!-- view lead -->
										<div class="btnContainer">
											<button type="button" class="btn-q btn-viewlead open-enquiryModal" data-id="<?php echo e($query->query_reference); ?>" data-toggle="modal">View Lead</button>
										</div>

										<!-- --------- -->

										<!-- delete lead -->
										<?php if(Sentinel::check()): ?>
										<?php if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin')): ?>
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

	<form action="<?php echo e(URL::to('/send_custom_quote')); ?>" method="POST" id="send_custom_quote">
		<?php echo e(csrf_field()); ?>

		<input type="hidden" name="quote_id" id="quote_id" value="0">
		<input type="hidden" name="quote_no" id="quote_no" value="0">
		<input type="hidden" name="ref_no" id="ref_no" value="0">
	</form>

	<div class="testing">
		<input type="hidden" value="<?php echo e(url('/')); ?>" name="" id="test">
	</div>

	<!-- Update Lead Status Modal -->
	<?php echo $__env->make('query.query_modal.modal-popup.lead_follow_up', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('query.query_modal.modal-popup.lead-cancelled', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('query.query_modal.modal-popup.add-payment', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('query.query_modal.modal-popup.service-status', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('query.query_modal.modal-popup.payment_follow_up', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('query.query_modal.modal-popup.refund-payment', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('query.query_modal.modal-popup.tour-cancelled', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('query.query_modal.modal-popup.refund-process', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('query.query_modal.modal-popup.issue-voucher', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('query.query_modal.modal-popup.refund_create', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('query.query_modal.modal-popup.under_cancellation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


	<!-- ******************** -->

	<!-- Lead Action Modal -->

	<!-- open enquiry modal -->
	<?php echo $__env->make('query.query_modal.modal-popup.action-modal.view-enquiry-details', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<!-- view lead history modal -->
	<?php echo $__env->make('query.query_modal.modal-popup.action-modal.view-enquiry-timeline', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<!-- extend validity modal -->
	<?php echo $__env->make('query.query_modal.modal-popup.action-modal.extend-validity', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<!-- view raised concern modal -->
	<?php echo $__env->make('query.query_modal.modal-popup.action-modal.edit-raised-concern', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<!-- payment history (ledger) modal -->
	<?php echo $__env->make('query.query_modal.modal-popup.action-modal.view-payment-history', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<!-- upload & send voucher modal -->
	<?php echo $__env->make('query.query_modal.modal-popup.action-modal.upload-send-voucher', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<!-- voucher list modal -->
	<?php echo $__env->make('query.query_modal.modal-popup.action-modal.voucher-list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<!-- send voucher modal -->
	<?php echo $__env->make('query.query_modal.modal-popup.action-modal.send-voucher', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<!-- resend voucher modal -->
	<?php echo $__env->make('query.query_modal.modal-popup.action-modal.resend-voucher', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom_js_code'); ?>

	<!-- page script -->
	<script type="text/javascript" src='<?php echo e(asset ("/resources/assets/backend/js/view-history-view-lead.js")); ?>'></script>

	<script type="text/javascript" src='<?php echo e(asset ("/resources/assets/backend/js/concern-raised.js")); ?>'></script>

	<script type="text/javascript" src='<?php echo e(asset ("/resources/assets/backend/js/extend-validity.js")); ?>'></script>

	<script type="text/javascript" src='<?php echo e(asset ("/resources/assets/backend/js/capture-date-time.js")); ?>'></script>

	<script type="text/javascript" src='<?php echo e(asset ("/resources/assets/backend/js/send-vouchers.js")); ?>'></script>

	<script type="text/javascript" src='<?php echo e(asset ("/resources/assets/backend/js/edit-passengers.js")); ?>'></script>

	<script type="text/javascript" src='<?php echo e(asset ("/resources/assets/backend/js/view-payment-history.js")); ?>'></script>

	<script type="text/javascript" src='<?php echo e(asset ("/resources/assets/backend/js/send-quotation.js")); ?>'></script>

	<script type="text/javascript" src='<?php echo e(asset ("/resources/assets/backend/js/collapsible.js")); ?>'></script>

	<!-- *********************************************** -->

	<script type="text/javascript">
	$(document).ready(function () {
		$(document).on("click",".details",function() {
			$(this).siblings("form").attr('target', '_blank')
			$(this).siblings("form").submit()
			});
	});
	</script>

	<!-- collapsible script (not working for service type) -->
	<!-- <script type="text/javascript">
	//collapsible button script
		var coll = document.getElementsByClassName("collapsible");
		var i;

		for (i = 0; i < coll.length; i++) {
			coll[i].addEventListener("click", function() {
				this.classList.toggle("active");
				var contents = this.nextElementSibling;
				if (contents.style.maxHeight){
					contents.style.maxHeight = null;
					}
				else {
					contents.style.maxHeight = contents.scrollHeight + "px";
					}
				});
			}
	</script> -->

<!-- <script type="text/javascript">
	/* Collapsible Button Script for Bootstrap Modal */
	$(document).ready(function () {
	    // Get all elements with the class "collapsible"
	    var coll = document.getElementsByClassName("collapsible");
	    var i;

	    // Loop through each collapsible element
	    for (i = 0; i < coll.length; i++) {
	        coll[i].addEventListener("click", function() {
	            // Toggle the "active" class to change button appearance
	            this.classList.toggle("active");

	            // Get the next sibling element which should be the content to show/hide
	            var contents = this.nextElementSibling;

	            // If the content is already expanded, collapse it by setting maxHeight to null
	            if (contents.style.maxHeight) {
	                contents.style.maxHeight = null;
	            } 
	            // Otherwise, expand the content by setting its maxHeight to its scrollHeight
	            else {
	                contents.style.maxHeight = contents.scrollHeight + "px";
	            }
	        });
	    }
	    
	    // Ensure collapsible elements work correctly within Bootstrap modals
	    $('#update_service_status').on('shown.bs.modal', function () {
	        var coll = document.getElementsByClassName("collapsible");
	        for (i = 0; i < coll.length; i++) {
	            var contents = coll[i].nextElementSibling;
	            if (coll[i].classList.contains("active")) {
	                contents.style.maxHeight = contents.scrollHeight + "px";
	            }
	        }
	    });
	});
</script> -->

<!-- <script type="text/javascript">
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
</script> -->

	<!-- *********************************************** -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
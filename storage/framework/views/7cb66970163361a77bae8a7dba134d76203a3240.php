							<div class="row">
								<!--Service & Channel Type-->
								<div class="col-md-12 appendBottom10">
									<label>Service Type</label>
									<input type="text" class="form-control" name="" value="<?php echo e($data->service_type); ?>" placeholder="Service Type" readonly />
								</div>

								<div class="col-md-12 appendBottom10">
									<label>Channel Type</label>
									<input type="text" class="form-control" name="" value="<?php echo e($data->channel_type); ?>" placeholder="Channel Type" readonly /> 
								</div>

								<div class="col-md-12 appendBottom10"></div>

								<!--Name, Email & Mobile No-->
								<div class="col-md-12 appendBottom10">
									<label for="guest_name">Primary Guest Name</label>
									<input type="text" class="form-control textCapitalize" name="guest_name" placeholder="Primary Guest Name" value="<?php echo e($data->name); ?>" readonly>
								</div>

								<?php $loged_user=Sentinel::getUser(); ?>
								<?php if($loged_user->lock_before_quote_send==''): ?>
									<div class="col-md-12 appendBottom10">
										<label>Guest Email Address</label>
										<input type="text" class="form-control text-lowercase" name="guest_email" value="<?php echo e($data->email); ?>" readonly="" placeholder="Email Address"> 
									</div>
									<div class="col-md-12 appendBottom10">
										<label>Guest Contact No</label>
										<input type="tel" class="form-control" name="guest_no" readonly="" value="<?php echo e($data->mobile); ?>" placeholder="Contact No"> 
									</div>
								<?php else: ?>
									 <div class="col-md-12 appendBottom10">
										<label>Guest Email Address</label>
										<input type="text" class="form-control text-lowercase" name="guest_email" value="<?php echo e(CustomHelpers::partiallyHideEmail($data->email)); ?>" readonly="" placeholder="Email Address"> 
									</div>
									<div class="col-md-12 appendBottom10">
										<label>Guest Contact No</label>
										<input type="tel" class="form-control" name="guest_no" readonly="" value="<?php echo e(CustomHelpers::mask_mobile_no($data->mobile)); ?>" placeholder="Contact No">
									</div>
								<?php endif; ?>

								<!--Tour Name, Destination & Duration-->
								<div class="col-md-12 appendBottom10">
									<label>Tour Name</label>
									<?php if(is_numeric((int)$data->packageId)): ?>
										<input type="text" class="form-control" name="package_name" value="<?php echo e(CustomHelpers::get_package_name($data->packageId)); ?>" placeholder="Package Name" readonly>
										<?php else: ?>
										<input type="text" class="form-control textCapitalize" name="package_name" value="<?php echo e($data->packageId); ?>" placeholder="Package Name" readonly>
									<?php endif; ?>
								</div>

								<?php
									$package_name = CustomHelpers::get_package_name($data->packageId);
									$day_s = (int)filter_var($data->duration, FILTER_SANITIZE_NUMBER_INT);

									if (is_numeric((int)$data->packageId)) {
									    $cities = CustomHelpers::get_master_table_data('rt_packages', 'id', (int)$data->packageId, 'city');
									    $cities = @unserialize($cities);

									    // Ensure $cities is an array
									    if ($cities === false || !is_array($cities)) {
									        $cities = [];
									    }

									    $output = '';
									    $a = 1;
									    foreach ($cities as $c) {
									        if ($a > 1) {
									            $output .= ',';
									        }
									        $output .= $c;
									        $a++;
									    }
									} else {
									    $output = $data->destinations;
									}
								?>
								<div class="col-md-12 appendBottom10">
									<label>Tour Destination</label>
									<input type="text" class="form-control textCapitalize" value="<?php echo e($data->destinations); ?>" name="destination" placeholder="Package Destination" readonly>
								</div>

								<div class="col-md-12 appendBottom10">
									<?php $day_night=(int)filter_var($data->duration,FILTER_SANITIZE_NUMBER_INT); ?>
									<label>Tour Duration</label>
									<input type="hidden" name="duration" value="<?php echo e((int)filter_var($data->duration,FILTER_SANITIZE_NUMBER_INT)); ?>">
									<input type="text" class="form-control" value="<?php echo e($day_night-1); ?> Nights / <?php echo e($day_night); ?> Days" name="duration" placeholder="Package Destination" readonly>
								</div>

								<!--No of Travellers-->
								<div class="col-md-3 appendBottom10">
									<label>Adult (+12 yrs)</label>
									<input type="text" class="form-control" name="adult" value="<?php echo e($data->span_value_adult); ?>" placeholder="No of Adults (+12 yrs)" readonly>
								</div>

								<div class="col-md-3 appendBottom10">
									<label>Child with bed (2-12 yrs)</label>
									<input type="text" class="form-control" name="child" value="<?php echo e($data->span_value_child); ?>" placeholder="No of Child (5-12 yrs)" readonly>
								</div>

								<div class="col-md-3 appendBottom10">
									<label>Child without bed (2-12 yrs)</label>
									<input type="text" class="form-control" name="child" value="<?php echo e($data->span_value_child_without_bed); ?>" placeholder="No of Children Without Bed" readonly>
								</div>

								<div class="col-md-3 appendBottom10">
									<label>Infant (0-2 yrs)</label>
									<input type="text" class="form-control" name="infant" value="<?php echo e($data->span_value_infant); ?>" placeholder="No of Child (0-5 yrs)" readonly>
								</div>

								<!--Nationality, Departure City & Best Time-->
								<div class="col-md-12 appendBottom10">
									<label>Guest Nationality</label>
									<input type="text" class="form-control text-capitalize" value="<?php echo e($data->country_of_residence); ?>" name="nationality" placeholder="Nationality" readonly>
								</div>

								<div class="col-md-12 appendBottom10">
									<label>Departure City</label>
									<input type="text" class="form-control text-capitalize" value="<?php echo e($data->city_of_residence); ?>" name="departure_city" placeholder="Departure City" readonly>
								</div>

								<div class="col-md-12 appendBottom10">
									<label>Best time to Call</label>
									<input type="text" class="form-control" value="<?php echo e($data->time_call); ?>" name="best_time_call" placeholder="Best time to Call" readonly>
								</div>

								<div class="col-md-12 appendBottom10">
									<label>Hotel Preference</label>
									<input type="text" class="form-control" value="<?php echo e($data->hotel_pre); ?> Star" name="hotel_pre" placeholder="Hotel Preferenc" readonly>
								</div>

								<div class="col-md-12 appendBottom10">
									<label>Expected Budget</label>
									<input type="text" class="form-control" value="<?php echo e($data->exp_budget); ?>" name="exp_budget" placeholder="Expected Budget" readonly>
								</div>

								<!--Departure Date-->
								<div class="col-md-12 appendBottom10">
									<label>Departure Date</label>
									<input type="text" name="date_arrival" class="form-control date_arrival" value="<?php echo e(date('d-m-Y',strtotime($data->date_arrival))); ?>" placeholder="Arrival Date" readonly>
								</div>

								<!--Cruise Line-->
								<div class="col-md-12 appendBottom10">
									<label>Cruise Line</label>
									<input type="text" class="form-control text-capitalize" name="cruiseline" value="<?php echo e($data->cruiseline); ?>" placeholder="Enter Cruise Line" readonly />
								</div>

								<!--Cabin Type-->
								 <div class="col-md-12 appendBottom10">
									<label>Cruise Cabin</label>
									<input type="text" class="form-control text-capitalize" name="cruisecabin" value="<?php echo e($data->cruisecabin); ?>" placeholder="Enter Cruise Cabin Type" readonly />
								</div>

								<!--Visa Type-->
								<div class="col-md-12 appendBottom10">
									<label>Visa Type</label>
									<input type="text" class="form-control text-capitalize" value="<?php echo e($data->visatype); ?>" name="visatype" placeholder="Enter Visa Type" readonly>
								</div>

								<!--Visa Validity-->
								<div class="col-md-12 appendBottom10">
									<label>Visa Validity</label>
									<input type="text" class="form-control" value="<?php echo e($data->visavalidity); ?>" name="visavalidity" placeholder="Enter Visa Validity" readonly>
								</div>

								<!--Visa Entry-->
								<div class="col-md-12 appendBottom10">
									<label>Visa Entry</label>
									<input type="text" class="form-control" value="<?php echo e($data->visaentry); ?>" name="visaentry" placeholder="Enter Visa Entry Type" readonly>
								</div>

								<!--Visa Service-->
								<div class="col-md-12 appendBottom10">
									<label>Visa Service</label>
									<input type="text" class="form-control text-capitalize" value="<?php echo e($data->visaservice); ?>" name="visaservice" placeholder="Enter Visa Service" readonly>
								</div>

								<!--Additional Details-->
								<div class="col-md-12">
									<label>Additional Information</label>
									<input type="text" name="message" class="form-control text-capitalize" value="<?php echo e($data->message); ?>" placeholder="Additional Information" readonly>
								</div>
						</div>
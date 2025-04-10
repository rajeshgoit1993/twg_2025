            <div>
                <input type="hidden" name="unique_code" id="unique_code" value="<?php echo e($unique_code); ?>">
				<h3>Traveller Information</h3>
				<div class="travellerGuestDtls">
					<div class="appendRight30">
						<h5><?php echo e(CustomHelpers::get_seperate_pass_payment_view($data->id, 1, 'na')); ?></h5>
					</div>
					<div>
                        <?php 
                            $roomCount = CustomHelpers::get_seperate_pass_payment_view($data->id, 1, 'room');
                         ?>

                        <h5><?php echo e($roomCount); ?>&nbsp;<?php echo e($roomCount > 1 ? 'Rooms' : 'Room'); ?></h5>

					</div>
				</div>
				<!-- Rooming Starts -->
                <?php
                    $rooms=unserialize($data->room);
                ?>
                <?php if($rooms!=''): ?>
                    <?php
                        $m=1;
                    ?>
                    <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row=>$col): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <?php 
                            $twin_adult_room=$col['twin_adult_room'];
                            $extra_adult_room=$col['extra_adult_room'];
                            $child_with_bed_room=$col['child_with_bed_room'];
                            $child_without_bed_room=$col['child_without_bed_room'];
                            $infant_room=$col['infant_room'];
                            $single_room=$col['single_room'];
                            $x=1;
                            $y=1;
                            $z=1;
                        ?>
                        <div>
                        <div class="roomCountCont">
                            <span class="roomCount">Room - <?php echo e($m); ?></span>
                            <span class="flexOne line"></span>
                        </div>
                        <?php if($twin_adult_room > 0): ?>
                            <?php for($a = 0; $a < $twin_adult_room; $a++): ?>
                                <?php $pass = 0; ?>
                                <div class="guestDtlsCont">
                                    <div class="guestCountBox">
                                        <h4>Adult - <?php echo e($x++); ?></h4>
                                        <h5>(Twin Sharing +12yrs)</h5>
                                    </div>
                                    <div class="guestNameBox selectArrow down relativeCont">
                                        <select class="passenger_select" name="passenger[<?php echo e($m); ?>][twin_adult][<?php echo e($a); ?>]" required>
                                            <option value="">select passenger</option>
                                            <?php if(count($room_passenger) > 0): ?>
                                                <?php $__currentLoopData = $passengers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $passenger): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                                    <?php
                                                        $passenger_id = CustomHelpers::custom_encrypt($passenger->id);
                                                    ?>
                                                    <option value="<?php echo e($passenger_id); ?>" 
                                                    <?php if(is_array($room_passenger)
                                                        && array_key_exists($m, $room_passenger) 
                                                        && is_array($room_passenger[$m]) 
                                                        && array_key_exists('twin_adult', $room_passenger[$m]) 
                                                        && array_key_exists($a, $room_passenger[$m]['twin_adult']) 
                                                        && $room_passenger[$m]['twin_adult'][$a] == $passenger_id): ?> 
                                                        selected 
                                                    <?php endif; ?>>
                                                    <?php echo e($passenger->firstname); ?> <?php echo e($passenger->lastname); ?>

                                                    </option>
                                                    <?php if(is_array($room_passenger) 
                                                        && array_key_exists($m, $room_passenger) 
                                                        && is_array($room_passenger[$m]) 
                                                        && array_key_exists('twin_adult', $room_passenger[$m]) 
                                                        && array_key_exists($a, $room_passenger[$m]['twin_adult']) 
                                                        && $room_passenger[$m]['twin_adult'][$a] == $passenger_id): ?>
                                                        <?php $pass = 1; ?>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <?php if($pass == 1): ?>
                                        <div class="addNewGuest addModal" id="<?php echo e(uniqid()); ?>" type="adult">
                                            <span class="fa-user"></span><span class="appendLeft10">Edit</span>
                                        </div>
                                    <?php else: ?>
                                        <div class="addNewGuest addModal" id="<?php echo e(uniqid()); ?>" type="adult">
                                            <span class="fa-user"></span><span class="appendLeft10">Add New</span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endfor; ?>
                        <?php endif; ?>

                        <?php if($extra_adult_room>0): ?>
                            <?php for($b=0;$b<$extra_adult_room;$b++): ?>
                                <?php
                                    $pass=0;
                                ?>
                                <div class="guestDtlsCont">
                                    <div class="guestCountBox">
                                        <h4>Adult - <?php echo e($x++); ?></h4>
                                        <h5>(Extra +12yrs)</h5>
                                    </div>
                                    <div class="guestNameBox selectArrow down relativeCont">
                                        <select class="passenger_select" name="passenger[<?php echo e($m); ?>][extra_adult][<?php echo e($b); ?>]" required>
                                            <option value="">select passenger</option>
                                            <?php if(count($room_passenger) > 0): ?>
                                                <?php $__currentLoopData = $passengers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $passenger): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                                    <?php
                                                        $passenger_id = CustomHelpers::custom_encrypt($passenger->id);
                                                    ?>
                                                    <option value="<?php echo e($passenger_id); ?>" 
                                                        <?php if(is_array($room_passenger) 
                                                            && array_key_exists($m, $room_passenger) 
                                                            && is_array($room_passenger[$m]) 
                                                            && array_key_exists('extra_adult', $room_passenger[$m]) 
                                                            && array_key_exists($b, $room_passenger[$m]['extra_adult']) 
                                                            && $room_passenger[$m]['extra_adult'][$b] == $passenger_id): ?> 
                                                            selected 
                                                        <?php endif; ?>>
                                                        <?php echo e($passenger->firstname); ?> <?php echo e($passenger->lastname); ?>

                                                    </option>
                                                    <?php if(is_array($room_passenger) 
                                                        && array_key_exists($m, $room_passenger) 
                                                        && is_array($room_passenger[$m]) 
                                                        && array_key_exists('extra_adult', $room_passenger[$m]) 
                                                        && array_key_exists($b, $room_passenger[$m]['extra_adult']) 
                                                        && $room_passenger[$m]['extra_adult'][$b] == $passenger_id): ?>
                                                        <?php $pass = 1; ?>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <?php if($pass == 1): ?>
                                        <div class="addNewGuest addModal" id="<?php echo e(uniqid()); ?>" type="adult">
                                            <span class="fa-user"></span><span class="appendLeft10">Edit</span>
                                        </div>
                                    <?php else: ?>
                                        <div class="addNewGuest addModal" id="<?php echo e(uniqid()); ?>" type="adult">
                                            <span class="fa-user"></span><span class="appendLeft10">Add New</span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endfor; ?>
                        <?php endif; ?>

                        <?php if($single_room>0): ?>
                            <?php for($c=0;$c<$single_room;$c++): ?>
                                <?php
                                    $pass=0;
                                ?>
                                <div class="guestDtlsCont">
                                    <div class="guestCountBox">
                                        <h4>Adult - <?php echo e($x++); ?></h4>
                                        <h5>(Single +12yrs)</h5>
                                    </div>
                                    <div class="guestNameBox selectArrow down relativeCont">
                                        <select class="passenger_select" name="passenger[<?php echo e($m); ?>][single][<?php echo e($c); ?>]" required>
                                            <option value="">select passenger</option>
                                            <?php if(count($room_passenger) > 0): ?>
                                                <?php $__currentLoopData = $passengers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $passenger): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                                    <?php
                                                        $passenger_id = CustomHelpers::custom_encrypt($passenger->id);
                                                    ?>
                                                    <option value="<?php echo e($passenger_id); ?>" 
                                                        <?php if(is_array($room_passenger) 
                                                            && array_key_exists($m, $room_passenger) 
                                                            && is_array($room_passenger[$m]) 
                                                            && array_key_exists('single', $room_passenger[$m]) 
                                                            && array_key_exists($c, $room_passenger[$m]['single']) 
                                                            && $room_passenger[$m]['single'][$c] == $passenger_id): ?> 
                                                            selected 
                                                        <?php endif; ?>>
                                                        <?php echo e($passenger->firstname); ?> <?php echo e($passenger->lastname); ?>

                                                    </option>
                                                    <?php if(is_array($room_passenger) 
                                                        && array_key_exists($m, $room_passenger) 
                                                        && is_array($room_passenger[$m]) 
                                                        && array_key_exists('single', $room_passenger[$m]) 
                                                        && array_key_exists($c, $room_passenger[$m]['single']) 
                                                        && $room_passenger[$m]['single'][$c] == $passenger_id): ?>
                                                        <?php $pass = 1; ?>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>

                                    <?php if($pass == 1): ?>
                                        <div class="addNewGuest addModal" id="<?php echo e(uniqid()); ?>" type="adult">
                                            <span class="fa-user"></span><span class="appendLeft10">Edit</span>
                                        </div>
                                    <?php else: ?>
                                        <div class="addNewGuest addModal" id="<?php echo e(uniqid()); ?>" type="adult">
                                            <span class="fa-user"></span><span class="appendLeft10">Add New</span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endfor; ?>
                        <?php endif; ?>

                        <?php if($child_with_bed_room > 0): ?>
                            <?php for($e = 0; $e < $child_with_bed_room; $e++): ?>
                                <?php $pass = 0; ?>
                                <div class="guestDtlsCont">
                                    <div class="guestCountBox">
                                        <h4>Child - <?php echo e($y++); ?></h4>
                                        <h5>(With Bed 2-12yrs)</h5>
                                    </div>
                                    <div class="guestNameBox selectArrow down relativeCont">
                                        <select class="passenger_select" name="passenger[<?php echo e($m); ?>][child_with_bed][<?php echo e($e); ?>]" required>
                                            <option value="">select passenger</option>
                                            <?php if(count($room_passenger) > 0): ?>
                                                <?php $__currentLoopData = $passengers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $passenger): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                                    <?php
                                                        $passenger_id = CustomHelpers::custom_encrypt($passenger->id);
                                                    ?>
                                                    <option value="<?php echo e($passenger_id); ?>" 
                                                        <?php if(is_array($room_passenger) 
                                                            && array_key_exists($m, $room_passenger) 
                                                            && is_array($room_passenger[$m]) && array_key_exists('child_with_bed', $room_passenger[$m]) 
                                                            && array_key_exists($e, $room_passenger[$m]['child_with_bed']) 
                                                            && $room_passenger[$m]['child_with_bed'][$e] == $passenger_id): ?> 
                                                            selected 
                                                        <?php endif; ?>>
                                                    <?php echo e($passenger->firstname); ?> <?php echo e($passenger->lastname); ?>

                                                    </option>
                                                    <?php if(is_array($room_passenger) 
                                                        && array_key_exists($m, $room_passenger) 
                                                        && is_array($room_passenger[$m]) 
                                                        && array_key_exists('child_with_bed', $room_passenger[$m]) 
                                                        && array_key_exists($e, $room_passenger[$m]['child_with_bed']) 
                                                        && $room_passenger[$m]['child_with_bed'][$e] == $passenger_id): ?>
                                                        <?php $pass = 1; ?>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>

                                    <?php if($pass == 1): ?>
                                        <div class="addNewGuest addModal" id="<?php echo e(uniqid()); ?>" type="child">
                                            <span class="fa-user"></span><span class="appendLeft10">Edit</span>
                                        </div>
                                    <?php else: ?>
                                        <div class="addNewGuest addModal" id="<?php echo e(uniqid()); ?>" type="child">
                                            <span class="fa-user"></span><span class="appendLeft10">Add New</span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endfor; ?>
                        <?php endif; ?>

                        <?php if($child_without_bed_room > 0): ?>
                            <?php for($f = 0; $f < $child_without_bed_room; $f++): ?>
                                <?php $pass = 0; ?>
                                <div class="guestDtlsCont">
                                    <div class="guestCountBox">
                                        <h4>Child - <?php echo e($y++); ?></h4>
                                        <h5>(Without Bed 2-12yrs)</h5>
                                    </div>
                                    <div class="guestNameBox selectArrow down relativeCont">
                                        <select class="passenger_select" name="passenger[<?php echo e($m); ?>][child_without_bed][<?php echo e($f); ?>]" required>
                                            <option value="">select passenger</option>
                                            <?php if(count($room_passenger) > 0): ?>
                                                <?php $__currentLoopData = $passengers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $passenger): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                                    <?php
                                                        $passenger_id = CustomHelpers::custom_encrypt($passenger->id);
                                                    ?>
                                                    <option value="<?php echo e($passenger_id); ?>" 
                                                        <?php if(is_array($room_passenger) 
                                                            && array_key_exists($m, $room_passenger) 
                                                            && is_array($room_passenger[$m]) 
                                                            && array_key_exists('child_without_bed', $room_passenger[$m]) 
                                                            && array_key_exists($f, $room_passenger[$m]['child_without_bed']) 
                                                            && $room_passenger[$m]['child_without_bed'][$f] == $passenger_id): ?> 
                                                            selected 
                                                        <?php endif; ?>>
                                                        <?php echo e($passenger->firstname); ?> <?php echo e($passenger->lastname); ?>

                                                    </option>
                                                    <?php if(is_array($room_passenger) 
                                                        && array_key_exists($m, $room_passenger) 
                                                        && is_array($room_passenger[$m]) 
                                                        && array_key_exists('child_without_bed', $room_passenger[$m]) 
                                                        && array_key_exists($f, $room_passenger[$m]['child_without_bed']) 
                                                        && $room_passenger[$m]['child_without_bed'][$f] == $passenger_id): ?>
                                                        <?php $pass = 1; ?>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>

                                    <?php if($pass == 1): ?>
                                        <div class="addNewGuest addModal" id="<?php echo e(uniqid()); ?>" type="child">
                                            <span class="fa-user"></span><span class="appendLeft10">Edit</span>
                                        </div>
                                    <?php else: ?>
                                        <div class="addNewGuest addModal" id="<?php echo e(uniqid()); ?>" type="child">
                                            <span class="fa-user"></span><span class="appendLeft10">Add New</span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endfor; ?>
                        <?php endif; ?>

                        <?php if($infant_room > 0): ?>
                            <?php for($g = 0; $g < $infant_room; $g++): ?>
                                <?php $pass = 0; ?>
                                <div class="guestDtlsCont">
                                    <div class="guestCountBox">
                                        <h4>Infant - <?php echo e($z++); ?></h4>
                                        <h5>(0-2yrs)</h5>
                                    </div>
                                    <div class="guestNameBox selectArrow down relativeCont">
                                        <select class="passenger_select" name="passenger[<?php echo e($m); ?>][infant][<?php echo e($g); ?>]" required>
                                            <option value="">select passenger</option>
                                            <?php if(count($room_passenger) > 0): ?>
                                                <?php $__currentLoopData = $passengers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $passenger): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                                    <?php
                                                        $passenger_id = CustomHelpers::custom_encrypt($passenger->id);
                                                    ?>
                                                    <option value="<?php echo e($passenger_id); ?>" 
                                                        <?php if(is_array($room_passenger) 
                                                            && array_key_exists($m, $room_passenger) 
                                                            && is_array($room_passenger[$m]) 
                                                            && array_key_exists('infant', $room_passenger[$m]) 
                                                            && array_key_exists($g, $room_passenger[$m]['infant']) 
                                                            && $room_passenger[$m]['infant'][$g] == $passenger_id): ?> 
                                                            selected 
                                                        <?php endif; ?>>
                                                        <?php echo e($passenger->firstname); ?> <?php echo e($passenger->lastname); ?>

                                                    </option>
                                                    <?php if(is_array($room_passenger) 
                                                        && array_key_exists($m, $room_passenger) 
                                                        && is_array($room_passenger[$m]) 
                                                        && array_key_exists('infant', $room_passenger[$m]) 
                                                        && array_key_exists($g, $room_passenger[$m]['infant']) 
                                                        && $room_passenger[$m]['infant'][$g] == $passenger_id): ?>
                                                        <?php $pass = 1; ?>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>

                                    <?php if($pass == 1): ?>
                                        <div class="addNewGuest addModal" id="<?php echo e(uniqid()); ?>" type="infant">
                                            <span class="fa-user"></span><span class="appendLeft10">Edit</span>
                                        </div>
                                    <?php else: ?>
                                        <div class="addNewGuest addModal" id="<?php echo e(uniqid()); ?>" type="infant">
                                            <span class="fa-user"></span><span class="appendLeft10">Add New</span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endfor; ?>
                        <?php endif; ?>
                        </div>
                        <?php
                            $m++;
                        ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                <?php endif; ?>
                <!-- Rooming Ends -->
			</div>

			<!-- Traveller contact information starts -->
			<div class="guestContactDtlsBox">
				<!--<h2>Contact Details</h2>
				<div class="flex-col-md-12">
					<div class="formGroup">
						<div class="font16 fontWeight600 blackText">Please enter details</div>
					</div>
				</div>-->
				<!--Email Id, Mobile No, City, State, Address, Spl Requests-->
				<div class="flex-row-multicolum appendTop10">
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="guestcontact_name">Leading Guest Name</label>
							<input type="text" id="guestcontact_name" name="name" placeholder="Enter full name as per id card" required
                            value="<?php echo e($lead_passenger_info->guest_name); ?>"
							/>
							<span class="error" id="guestcontact_name_error"></span>
						</div>
					</div>
					<div class="flex-col-md-6"></div>
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="guestcontact_email">Email ID</label>
							<input type="text" id="guestcontact_email" name="guestcontact_email" placeholder="Enter Your Email Id" value="<?php echo e($lead_passenger->email); ?>" required />
							<span class="error" id="guestcontact_email_error"></span>
						</div>
					</div>
					<div class="flex-col-md-6">
                        <div class="guestInputCont">
                            <label for="guestcontact_mobile">Mobile No</label>

                            <!-- <div class="selectArrow down relativeCont flexOne">
                                    <select name="year" class="byear" style="border-radius: 4px 0 0 4px;border-right: 0;display: inline-block;">
                                        <option selected disabled>YYYY</option>
                                        <?php for($i=date('Y');$i>=1923;$i--): ?>
                                            <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                                        <?php endfor; ?>;
                                    </select>
                                </div> -->
                            <div class="makeflex">
                                <!-- country code -->
                                <?php 
                                    $data = DB::table('countries')->get();
                                ?>
                                <div class="selectArrow down relativeCont" style="width: 35%;margin-right: 5px;">
                                <select name="country_code">
                                    <?php 
                                        foreach($data as $single):
                                            if($single->phonecode == $lead_passenger_info->country_code):
                                                echo "<option value='".$single->phonecode."' selected>".$single->name." (+".$single->phonecode.")</option>";
                                            else:
                                                echo "<option value='".$single->phonecode."'>".$single->name." (+".$single->phonecode.")</option>";
                                            endif;
                                        endforeach;
                                    ?>
                                </select>
                            </div>
                                <!-- enter mobile no -->
                                <div class="flexOne">
                                <input type="text" name="guestcontact_mobile" id="guestcontact_mobile" placeholder="Enter Your Mobile No" maxlength="10" required value="<?php echo e($lead_passenger_info->mobile_no); ?>" />
                            </div>
                            </div>
                            <span class="error" id="guestcontact_mobile_error"></span>
                        </div>
                    </div>
                    <div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="guestcontact_city">City</label>
							<input type="text" id="guestcontact_city" name="guestcontact_city" placeholder="Enter Your City" required value="<?php echo e($lead_passenger_info->city); ?>" />
							<span class="error" id="guestcontact_city_error"></span>
						</div>
					</div>
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="guestcontact_state">State</label>
							<input type="text" name="guestcontact_state" id="guestcontact_state" placeholder="Enter Your State" required value="<?php echo e($lead_passenger_info->state); ?>" />
							<span class="error" id="guestcontact_state_error"></span>
						</div>
					</div>
					<div class="flex-col-md-12">
						<div class="guestInputCont">
							<label for="guestcontact_address">Address</label>
							<input type="text" name="guestcontact_address" id="guestcontact_address" placeholder="Enter your address" value="<?php echo e($lead_passenger_info->address); ?>" required />
							<span class="error" id="guestcontact_address_error"></span>
						</div>
					</div>
					<div class="flex-col-md-12">
                        <div class="guestInputCont appendTop5">
                            <label for="guest_additionaletails">Special Request&nbsp;<span class="colorA1">(subject to availability)</span></label>
                            <?php
                                $special_request = CustomHelpers::get_run_time_passenger_details($quote_ref_no, 'special_request');
                            ?>
                            <?php if($special_request != '' && $special_request != 'N;'): ?>
                                <?php
                                    $special_request = unserialize($special_request);
                                ?>
                                <div class="addOnDtlsCont mobscroll">
                                    <label class="checkmarkCont">
                                        <input type="checkbox" id="earlycheckin" name="special_request[]" value="Early Check-in" <?php if(in_array('Early Check-in', $special_request)): ?> checked <?php endif; ?>>
                                        <span class="checkmark addOn-services"></span>
                                        <span class="addOn-services-text">Early Check-in</span>
                                    </label>
                                    <label class="checkmarkCont">
                                        <input type="checkbox" id="latecheckout" name="special_request[]" value="Late Checkout" <?php if(in_array('Late Checkout', $special_request)): ?> checked <?php endif; ?>>
                                        <span class="checkmark addOn-services"></span>
                                        <span class="addOn-services-text">Late Checkout</span>
                                    </label>
                                    <label class="checkmarkCont">
                                        <input type="checkbox" id="honeymoonfreebies" name="special_request[]" value="Honeymoon Freebies" <?php if(in_array('Honeymoon Freebies', $special_request)): ?> checked <?php endif; ?>>
                                        <span class="checkmark addOn-services"></span>
                                        <span class="addOn-services-text">Honeymoon Freebies</span>
                                    </label>
                                </div>
                            <?php else: ?>
                                <div class="addOnDtlsCont mobscroll">
                                    <label class="checkmarkCont">
                                        <input type="checkbox" id="earlycheckin" name="special_request[]" value="Early Check-in">
                                        <span class="checkmark addOn-services"></span>
                                        <span class="addOn-services-text">Early Check-in</span>
                                    </label>
                                    <label class="checkmarkCont">
                                        <input type="checkbox" id="latecheckout" name="special_request[]" value="Late Checkout">
                                        <span class="checkmark addOn-services"></span>
                                        <span class="addOn-services-text">Late Checkout</span>
                                    </label>
                                    <label class="checkmarkCont">
                                        <input type="checkbox" id="honeymoonfreebies" name="special_request[]" value="Honeymoon Freebies">
                                        <span class="checkmark addOn-services"></span>
                                        <span class="addOn-services-text">Honeymoon Freebies</span>
                                    </label>
                                </div>
                            <?php endif; ?>
                            <textarea class="formTextarea" type="text" id="guest_additionaletails" name="guest_additionaletails" placeholder="Enter additional requests (if any)"><?php echo e(CustomHelpers::get_run_time_passenger_details($quote_ref_no, 'guest_additionaletails')); ?></textarea>
                        </div>
                    </div>
				</div>
			</div>
			<!-- Traveller contact information ends -->

			<!-- Business Traveller GST information starts -->
            <div class="guestGSTDtlsBox">
    			<div class="reviewFoldable selectArrowHeader down relativeCont">
    				<div class="flex-col-md-12">
    					<div class="guestDtlsHeader">
    						<h2>Enter GST details (optional)</h2>
    					</div>
                    </div>
                </div>
    			<!--GSTIN Details-->
                <div class="mfoldableContent d-none">
    				<div class="flex-row-multicolum">
    					<div class="flex-col-md-6">
    						<div class="guestInputCont">
    							<label for="guestGST_no">GSTIN</label>
    							<input type="text" id="guestGST_no" name="guestGST_no" placeholder="Enter GST Number" maxlength="12" oninput="this.value = this.value.toUpperCase()" <?php if($passengers_infos!=''): ?> value="<?php echo e($passengers_infos->guestGST_no); ?>"  <?php endif; ?>  />
    							<span class="error" id="guestGST_no_error"></span>
    						</div>
    					</div>
    					<div class="flex-col-md-6">
    						<div class="guestInputCont">
    							<label for="guestGST_name">GST Name</label>
    							<input type="text" name="guestGST_name" id="guestGST_name" placeholder="Enter GST Name" oninput="this.value = capitalizeWords(this.value)" <?php if($passengers_infos!=''): ?> value="<?php echo e($passengers_infos->guestGST_name); ?>"  <?php endif; ?> />
    							<span class="error" id="guestGST_name_error"></span>
    						</div>
    					</div>
    					<div class="flex-col-md-6">
    						<div class="guestInputCont">
    							<label for="guestGST_email">GST Email ID</label>
    							<input type="text" id="guestGST_email" name="guestGST_email" placeholder="Enter GST Email" oninput="this.value = this.value.toLowerCase()" <?php if($passengers_infos!=''): ?> value="<?php echo e($passengers_infos->guestGST_email); ?>"  <?php endif; ?> />
    							<span class="error" id="guestGST_email_error"></span>
    						</div>
    					</div>
    					<div class="flex-col-md-6">
    						<div class="guestInputCont">
    							<label for="guestGST_mobile">GST Mobile</label>
    							<input type="text" name="guestGST_mobile" id="guestGST_mobile" placeholder="Enter GST Mobile No" maxlength="10" <?php if($passengers_infos!=''): ?> value="<?php echo e($passengers_infos->guestGST_mobile); ?>"  <?php endif; ?> />
    							<span class="error" id="guestGST_mobile_error"></span>
    						</div>
    					</div>
    					<div class="flex-col-md-6">
    						<div class="guestInputCont">
    							<label for="guestGST_state">GST State</label>
    							<input type="text" name="guestGST_state" id="guestGST_state" placeholder="Enter GST State" <?php if($passengers_infos!=''): ?> value="<?php echo e($passengers_infos->guestGST_state); ?>"  <?php endif; ?> />
    							<span class="error" id="guestGST_state_error"></span>
    						</div>
    					</div>
    					<div class="flex-col-md-6"></div>
    					<div class="flex-col-md-12">
    						<div class="guestInputCont">
    							<label for="guestGST_address">GST Address</label>
    							<input type="text" name="guestGST_address" id="guestGST_address" placeholder="Enter GST address" <?php if($passengers_infos!=''): ?> value="<?php echo e($passengers_infos->guestGST_address); ?>"  <?php endif; ?>/>
    							<span class="error" id="guestGST_address_error"></span>
    						</div>
    					</div>
    				</div>
                </div>
			</div>
            <!--Business Traveller GST information ends-->
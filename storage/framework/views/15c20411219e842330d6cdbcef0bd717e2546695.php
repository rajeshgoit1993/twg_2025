		<!--Desktop Tour Update Panel Starts-->
		<div class="dDatePanelCont">
			<div class="mobscroll scrollX">
				<div class="dPageContainer">
					<div class="flexCenter">

					<!--Tour Starting City-->
					<div class="dSearchInputBox tourCityBox_update" onclick="document.getElementById('fromCity').focus();">
					    <label for="fromCity">Starting City</label>
					    <!-- <input type="text" id="fromCity" name="fromCity" value="<?php echo e($details->sourcecity ?? 'JoiningDirect'); ?>" placeholder="Select City" readonly /> -->
					    <input type="text" id="fromCity" name="fromCity" value="<?php echo e($details->sourcecity == null ? 'JoiningDirect' : $details->sourcecity); ?>" placeholder="Select City" readonly />
					</div>


					<!--Package Name-->
					<!-- <div class="dSearchInputBox tourCityBox_update">
						<label for="tourname">Package Name</label>
						<input type="text" id="tourName" name="tourName" value="<?php echo e($details->title); ?>" placeholder="Enter city e.g. Goa, Singapore.." readonly />
					</div> -->

					<!--Travel Date-->
					<!-- <div class="dSearchInputBox tourDateBox_update">
						<label for="tourDate">Travel Date</label>
						<input type="text" id="datepicker" name="tourDate" placeholder="Select Date" readonly />
					</div> -->
					<div class="dSearchInputBox tourDateBox_update" onclick="document.getElementById('datepicker').focus();">
					    <label for="datepicker">Travel Date</label>
					    <input type="text" id="datepicker" name="tourDate" placeholder="Select Date" readonly 

					    />
					</div>

					<!--Package Type-->
					<div class="dSearchInputBox themeBox_update dSearchInputArrow" onclick="document.querySelector('.type_value').focus();">
						<label for="tourType">Price</label>
						<div class="type">
						<?php if($new_price!='na'): ?>
							<?php  
								$overall_package_rating=$new_second_price['overall_package_rating'];
								$package_rating=$new_second_price['package_rating'];
							?>
							<select id="tourtype" name="tourType" class="pkg_type_two type_value type_value">
								<?php $__currentLoopData = $overall_package_rating; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row=>$col): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
									<?php $rate=DB::table('rt_pkg_rating_type')->where('id',$row)->first(); ?>
									<option value="<?php echo e($row); ?>" <?php if($row==$package_rating): ?> selected <?php endif; ?>><?php echo e($rate->name); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
							</select>
						<?php else: ?>
							<input type="text" value="On Request" class="type_value" readonly />
						<?php endif; ?>
						</div>
					</div>

					<!--Update-->
					<div type="button" class="dSearchInputBox btnSearchUpdate">Update</div>
					</div>
					
				</div>
			</div>
		</div>
		<!--Desktop Tour Update Panel Ends-->
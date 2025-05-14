<!--Modal Search Inputs-->
<div id="modal_searchInputs" class="search-inputs-modal">
	<div class="search-inputs-modal-content">
		<div class="mStickyBar">
			<div class="mSearchInputsModalHeader">
				<div class="close-searchInputs-modal" id="closeModal_searchInputs"></div>
				<div>
					<h4 class="mModalTitle">Select Booking Details</h4>
				</div>
			</div>
		</div>
		<div class="search-inputs-modal-body">
		<div class="item-container">
			<div class="item-container-box">
				<div class="search-input-item-cont">
					<div class="search-input-sub-item">
						<div class="head">Starting City</div>
						<div class="item-name"><?php echo e($details->sourcecity == null ? 'JoiningDirect' : $details->sourcecity); ?></div>
					</div>
					<!-- <div class="btn-edit" id="btn_getModal_searchInputs_city">Change</div> -->
				</div>
			</div>
		</div>
		<div class="item-container">
			<div class="item-container-box">
				<div class="search-input-item-cont">
					<div class="search-input-sub-item">
						<div class="head">Starting On</div>
						<div class="item-name selected_date"><?php echo e(date('D, d M Y', strtotime($input_date))); ?></div>
						<!-- <div class="item-name">
							<input type="text" id="datepicker" name="datepicker" value="<?php echo e(date('d M y', strtotime('+2 months'))); ?>" placeholder="Select Date" />
								<div class="dateValueCont">
									<div class="dateValue makeflex">
										<span class="dayStyle day"></span>
										<span class="monthStyle comma month"></span>
										<span class="yearStyle year"></span>
									</div>
									<div class="dayName day-name"></div>
								</div>
						</div> -->
					</div>
					<div class="btn-edit" id="btn_getModal_searchInputs_date">Change</div>
				</div>
			</div>
		</div>
		<!-- <div class="item-container">
			<div class="item-container-box">
				<div class="search-input-item-cont">
					<div class="search-input-sub-item">
						<div class="head">Rooms & Guests</div>
						<div class="item-name">2 Adults in 1 Room</div>
					</div>
					<div class="btn-edit" id="btn_getModal_searchInputs_travellers">Change</div>
				</div>
			</div>
		</div> -->

		<div class="item-container">
			<div class="item-container-box">

				<div class="search-input-item-cont themeBox_update dSearchInputArrow" onclick="document.querySelector('.mtype_value').focus();">
						<label for="tourType">Price</label>
						<div class="mtype">
						<?php if($new_price!='na'): ?>
							<?php  
								$overall_package_rating=$new_second_price['overall_package_rating'];
								$package_rating=$new_second_price['package_rating'];
							?>
							<select id="tourtype" name="tourType" class="pkg_type_two type_value ">
								<?php $__currentLoopData = $overall_package_rating; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row=>$col): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
									<?php $rate=DB::table('rt_pkg_rating_type')->where('id',$row)->first(); ?>
									<option value="<?php echo e($row); ?>" <?php if($row==$package_rating): ?> selected <?php endif; ?>><?php echo e($rate->name); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
							</select>
						<?php else: ?>
							<input type="text" value="On Request" class="mtype_value" readonly />
						<?php endif; ?>
						</div>
					</div>
</div>
		
		</div>

		<div class="item-container" style="display: none;">
			<div class="item-container-box">
				<div class="search-input-item-cont">
					<div class="search-input-sub-item">
						<div class="head">From</div>
						<div class="item-name">New Delhi</div>
					</div>
					<div class="btn-edit" id="">Change</div>
				</div>
			</div>
		</div>
		</div>
		<div class="footer-cont">
			<div class="traveller-modal-footer">
				<button class="btn-search-input-apply apply_mobile_filter">Apply</button>
			</div>
		</div>
	</div>
</div>

<!-- ******************** -->

<!--Modal Search Inputs-City-->
<div id="modal_searchInputs_city" class="search-inputs-modal">
	<div class="search-inputs-modal-content">
		<div class="mStickyBar">
			<div class="mSearchInputsModalHeader">
				<div class="close-searchInputs-modal" id="btn_closeModal_searchInputs_city"></div>
				<div>
					<h4 class="mModalTitle">Select Starting City</h4>
				</div>
			</div>
		</div>
		<div class="search-inputs-modal-body">
			<div class="item-container">
				<div class="item-container-box">
					<div class="search-input-item-cont">
						<div class="search-input-sub-item">
							<div class="head">Search City</div>
							<div class="item-name">City</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- ******************** -->

<!--Modal Search Inputs-Date-->
<div id="modal_searchInputs_date" class="search-inputs-modal">
	<div class="search-inputs-modal-content">
		<div class="mStickyBar">
			<div class="mSearchInputsModalHeader">
				<div class="close-searchInputs-modal" id="btn_closeModal_searchInputs_date"></div>
				<div>
					<h4 class="mModalTitle">Select Tour Date</h4>
				</div>
			</div>
		</div>
		<div class="search-inputs-modal-body">
			<div class="item-container">
				<div class="item-container-box">
					<div class="search-input-item-cont">
						<div class="search-input-sub-item">
							<div class="head">Select Date</div>
							<!-- <div class="item-name">Date</div> -->
							
							<!-- <label for="tourDate">Travel Date</label> -->
							<input type="text" class="item-name noBorder noOutline" id="m_datepicker" name="tourDate" placeholder="Select Date" readonly />
						</div>
						<div class="btn-edit" id="btnChangeDateMobile">Change</div>
					</div>
				</div>
			</div>
		</div>
		<div class="footer-cont">
			<div class="traveller-modal-footer">
				<button class="btn-search-input-apply apply_changed_date" id="apply_changed_date">Done</button>
			</div>
		</div>
	</div>
</div>

<!-- ******************** -->

<!--Modal Search Inputs-Travellers-->
<div id="modal_searchInputs_travellers" class="search-inputs-modal">
	<div class="search-inputs-modal-content">
		<div class="mStickyBar">
			<div class="mSearchInputsModalHeader">
				<div class="close-searchInputs-modal" id="btn_closeModal_searchInputs_travellers"></div>
				<div>
					<h4 class="mModalTitle">Select Tour Date</h4>
				</div>
			</div>
		</div>
		<div class="search-inputs-modal-body" style="padding: 0 15px;">
			<div id="travellers_room_summary">
				<div class="item-container item-container-traveller">
					<div class="item-container-box">
						<div class="search-input-item-cont">
							<div class="search-input-sub-item">
								<div class="head">Room 1</div>
								<div class="flexCenter">
									<div class="item-name fontWeight600">2 Adults</div>
									<div class="edit-traveller">Edit</div>
								</div>
							</div>
							<div class="btn-edit" id="">Remove</div>
						</div>
					</div>
				</div>
			</div>
			<div id="travellers_room_summary">
				<div class="item-container item-container-traveller">
					<div class="item-container-box">
						<div class="search-input-item-cont">
							<div class="search-input-sub-item">
								<div class="head">Room 2</div>
								<div class="flexCenter">
									<div class="item-name fontWeight600">2 Adults, 2 Children</div>
									<div class="edit-traveller">Edit</div>
								</div>
							</div>
							<div class="btn-edit" id="">Remove</div>
						</div>
					</div>
				</div>
			</div>
			<!--Add More rooms and Guests-->
			<div id="add_new_guest_container">
				<div id="guest_container">
				<div class="item-container item-container-traveller">
					<div class="item-container-box">
						<div class="search-input-item-room-alert">Maximum 4 Guests allowed in this room </div>
						<div class="search-input-item-cont">
							<div class="search-input-sub-item">
								<div class="head" style="margin-bottom: 0;">Room 3</div>
							</div>
							<div class="btn-edit removeButton" id="removeContainerButton">Remove</div>
						</div>
						<div class="add-travellers-box">
							<div class="d-flex-between">
								<div>
									<div class="traveller-item-name">Adults</div>
									<div class="traveller-item-name-tag">Above 12 Years</div>
								</div>
								<div class="mTravellerBox flexCenter">
									<div class="flex-column">
										<input type="hidden" id="travellers" name="span_value_adult" class="span_value_adult1" value="2" />
										<div class="flexCenter">
											<div class="mTravellerMinus span_des_adult">&#8722;</div>
											<div class="mTravellerValue span_value_adult">2</div>
											<div class="mTravellerMinus span_inc_adult">&#43;</div>
										</div>
										<!--<div class="guestType">Adult (+12yrs)</div>-->
									</div>
								</div>
								<!--<div class="edit-traveller">Edit</div>-->
							</div>
							<div class="d-flex-between">
								<div>
									<div class="traveller-item-name">Child with Bed</div>
									<div class="traveller-item-name-tag">2 - 12 Years</div>
								</div>
								<div class="mTravellerBox flexCenter">
									<div class="flex-column">
										<input type="hidden" id="travellers" name="span_value_adult" class="span_value_adult1" value="2" />
										<div class="flexCenter">
											<div class="mTravellerMinus span_des_adult">&#8722;</div>
											<div class="mTravellerValue span_value_adult">0</div>
											<div class="mTravellerMinus span_inc_adult">&#43;</div>
										</div>
										<!--<div class="guestType">Adult (+12yrs)</div>-->
									</div>
								</div>
								<!--<div class="edit-traveller">Edit</div>-->
							</div>
							<div class="d-flex-between">
								<div>
									<div class="traveller-item-name">Child without Bed</div>
									<div class="traveller-item-name-tag">2 - 12 Years</div>
								</div>
								<div class="mTravellerBox flexCenter">
									<div class="flex-column">
										<input type="hidden" id="travellers" name="span_value_adult" class="span_value_adult1" value="2" />
										<div class="flexCenter">
											<div class="mTravellerMinus span_des_adult">&#8722;</div>
											<div class="mTravellerValue span_value_adult">0</div>
											<div class="mTravellerMinus span_inc_adult">&#43;</div>
										</div>
										<!--<div class="guestType">Adult (+12yrs)</div>-->
									</div>
								</div>
								<!--<div class="edit-traveller">Edit</div>-->
							</div>
							<div class="d-flex-between">
								<div>
									<div class="traveller-item-name">Infant</div>
									<div class="traveller-item-name-tag">upto 2 Years</div>
								</div>
								<div class="mTravellerBox flexCenter">
									<div class="flex-column">
										<input type="hidden" id="travellers" name="span_value_adult" class="span_value_adult1" value="2" />
										<div class="flexCenter">
											<div class="mTravellerMinus span_des_adult">&#8722;</div>
											<div class="mTravellerValue span_value_adult">0</div>
											<div class="mTravellerMinus span_inc_adult">&#43;</div>
										</div>
										<!--<div class="guestType">Adult (+12yrs)</div>-->
									</div>
								</div>
								<!--<div class="edit-traveller">Edit</div>-->
							</div>
						</div>
					</div>
				</div>
				</div>
			</div>
		</div>
		<div class="footer-cont">
			<div class="traveller-modal-footer">
				<button class="btn-add-room" id="addContainerButton">+ Add another room</button>
			</div>
		
			<div class="traveller-modal-footer">
				<button class="btn-search-input-apply">Apply</button>
			</div>
		</div>
	</div>
</div>

<!-- **********REFERENCE JS********** -->

<!-- Mobile Search Inputs Modal Popup JS -->
<!--modal-popup-search-inputs.js-->
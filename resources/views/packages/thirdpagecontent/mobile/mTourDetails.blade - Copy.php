					<style type="text/css">
						.mSelectDateCont {
							border: 1px solid #e9e9e9;
							border-radius: 15px;
							background-color: #eaf5ff;
							padding: 7px 15px;
							margin: 10px 0;
							display: inline-flex;
							align-items: center;
							justify-content: space-between;
							width: 100%;
							}
						.mSearchInputs {
							display: flex;
							align-items: center;
							}
						.mSearchInputGuests {
							font-size: 12px;
							line-height: 14px;
							color: #000;
							font-weight: 500;
							text-align: center;
							}
						.mSearchInputDate {
							font-size: 12px;
							line-height: 14px;
							color: #000;
							font-weight: 500;
							text-align: center;
							text-transform: uppercase;
							}
						.mSearchInputs.item:last-child {
							margin-right: 0;
							}
						.mdot:before {
							content: "•";
							color: #008cff;
							/*text-shadow: #b83b3b 0 0 5px;*/
							margin:0 15px;
							}
						.mSearchInputsEdit {
							font-size: 12px;
							line-height: 14px;
							color: #008cff;
							font-weight: 900;
							text-align: center;
							text-transform: uppercase;
							}

	/* Modal Search Inputs */
	.search-inputs-modal {
		display: none;
		position: fixed;
		z-index: 1111;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background-color: rgba(0,0,0,0.7);
		}
	/*Modal-Content Starts*/
	.search-inputs-modal-content {
	    	background-color: #f2f2f2;
	    	padding: 0;
	    	border-radius: 5px;
	    	position: absolute;
	    	top: 50%;
	    	left: 50%;
	    	transform: translate(-50%, -50%);
	    	box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
	    	/*max-width: 80%;*/
	    	width: 100%;
	    	height: 100%;
	    	display: flex;
	    	flex-direction: column;
		}
	/*Modal-Header Starts*/
	.mStickyBar {
		position: sticky;
		top: 0;
		z-index: 11;
		background: #fff;
		}
	.mSearchInputsModalHeader {
		padding: 15px 10px;
		border-bottom: 1px solid #e5e5e5;
		display: flex;
		align-items: center;
		}
	.close-searchInputs-modal {
		display: inline-block;
		background: transparent;
		border-radius: 50%;
		padding: 12px;
		cursor: default;
		box-shadow: 0 0px 4px 0 rgb(255 255 255 / 90%);
		/*border: 1px solid #ffff00;*/
		width: 30px;
		height: 35px;
		}
	.close-searchInputs-modal:before {
		border: solid #000;
		border-width: 0 2px 2px 0;
		display: inline-block;
		padding: 5px;
		transform: rotate(-225deg);
		-webkit-transform: rotate(-225deg);
		position: relative;
		left: 0;
		top: 0;
		content: '';
		}
	/*Modal-Header Ends*/
	/*Modal-Body Starts*/
	.search-inputs-modal-body {
		height: 100%;
		overflow-y: auto;
		}
	.item-container {
		background-color: #fff;
		margin-top: 15px;
		border: 1px solid #d7d7d7;
		}
	.item-container-box {
		max-width: 540px;
		margin: auto;
		}
	.item-container-traveller {
		border-color: #eee;
		box-shadow: rgba(51, 0, 0, 0.1) 1px 1px 5px;
		border-radius: 5px;
		overflow: hidden;
		}
	.search-input-item-room-alert {
		font-size: 12px;
		line-height: 14px;
		color: #cf8102;
		text-align: center;
		padding: 5px;
		background-color: #ffedd1;
		}
	.edit-traveller {
		font-size: 14px;
		line-height: 14px;
		color: #01b7f2;
		text-align: left;
		font-weight: 600;
		text-transform: capitalize;
		margin-left: 10px;
		}
	.search-input-item-cont {
		background-color: #fff;
		padding: 20px 15px;
		display: flex;
		align-items: center;
		justify-content: space-between;
		}
	.search-input-sub-item {
		display: flex;
		align-items: flex-start;
		flex-direction: column;
		}
	.search-input-sub-item > .head {
		font-size: 12px;
		line-height: 12px;
		color: #a1a1a1;
		font-weight: 500;
		text-align: left;
		text-transform: uppercase;
		margin-bottom: 15px;
		}
	.item-name {
		font-size: 15px;
		line-height: 17px;
		color: #000;
		font-weight: 600;
		text-align: left;
		text-transform: capitalize;
		}
	.btn-edit {
		font-size: 12px;
		line-height: 12px;
		color: #01b7f2;
		font-weight: 600;
		text-align: center;
		text-transform: uppercase;
		}
	.add-travellers-box {
		padding-right: 15px;
		padding-left: 15px;
		}
	.traveller-item-name {
		font-size: 15px;
		line-height: 17px;
		color: #000;
		font-weight: 600;
		text-align: left;
		text-transform: none;
		}
	.traveller-item-name-tag {
		font-size: 12px;
		line-height: 14px;
		color: #a1a1a1;
		font-weight: 500;
		text-align: left;
		text-transform: capitalize;
		margin-top: 3px;
		}
	.mTravellerBox {
		border: 1px solid #eee;
		border-radius: 4px;
		}
	.mTravellerMinus, .mTravellerPlus {
		font-size: 20px;
		line-height: 20px;
		color: #9B9B9B;
		padding: 12px;
		font-weight: 900;
		cursor: default;
		}
	.mTravellerValue {
		font-size: 20px;
		line-height: 20px;
		color: #000001;
		padding: 10px 12px;
		font-weight: 900;
		}
	/*Modal-Body Ends*/
	/*Modal Footer Starts*/
	.footer-cont {
		width: 100%;
		height: auto;
		background-color: transparent;
		/*position: sticky;*/
		bottom: 0px;
		z-index: 1111;
		position: relative;
		}
	.traveller-modal-footer {
		padding: 15px;
		text-align: center;
		border-top: unset;
		outline: 0;
		}
	.btn-search-input-apply {
		outline: 0;
		text-transform: uppercase;
		font-size: 16px;
		line-height: 16px;
		color: #fff;
		font-weight: 900;
		cursor: default;
		padding: 8px 20px;
		border: none;
		border-radius: 5px;
		background-color: #01b7f2;
		height: 43px;
		white-space: nowrap;
		vertical-align: middle;
		-ms-touch-action: manipulation;
		touch-action: manipulation;
		-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
		background-image: none;
		letter-spacing: 0.64px;
		margin-bottom: 0;
		width: 100%;
		}
	.btn-search-input-apply:hover {
		background-color: #01b7f2;
		color: #fff;
		}
	.btn-add-room {
		outline: 0;
		text-transform: uppercase;
		font-size: 16px;
		line-height: 16px;
		color: #01b7f2;
		font-weight: 900;
		cursor: default;
		padding: 8px 20px;
		border: none;
		border-radius: 0;
		background-color: transparent;
		height: auto;
		white-space: nowrap;
		vertical-align: middle;
		-ms-touch-action: manipulation;
		touch-action: manipulation;
		-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
		background-image: none;
		letter-spacing: 0.64px;
		margin-bottom: 0;
		}
	.btn-add-room:hover {
		background-color: transparent;
		color: #01b7f2;
		}
	/*Modal Footer Ends*/
	/*Modal-Content Ends*/
</style>
					<!--Mobile Tour Details-->
					<div class="mTourHeadCont">
						<h3>{{$details->title}}</h3>
						@if($details->select_star_rating!='')
						<?php
							$select_star_rating=(float)$details->select_star_rating;
						?>
						<div class="hotel-star-rating">
							@for($i=1;$i<=$select_star_rating;$i++)
								<div class="fa fa-star star_checked"></div>
							@endfor
							</div>
							@endif
						<div class="mTourPlaceWrapper">
							<?php
								$city1=unserialize($details->city);
								$days=unserialize($details->days);
								$city1_count=count($city1);
								$i=0;
								foreach($city1 as $row=>$col) {
								echo "<span class='mTourPlaceDuration'>$days[$row]N&nbsp;</span><div class='mTourCityName'>$city1[$row]</div>";
								if($i<($city1_count-1)):
								echo "<span>&nbsp;&rarr;&nbsp;</span>";
								endif;
								$a=$i+1;
								if($a%3=="0"):
								echo "";
								endif;
								$i++;
								}
							?>
						</div>
						<div class="mTourDuration">{{$details->duration}}N&nbsp;/&nbsp;{{$details->duration + 1}}D</div>
						<!--Holiday Type-->
						<div class="holiday-type">{{$details->tour_type}}</div>

						<!--Edit Date-->
						<div class="mSelectDateCont">
							<div class="mSearchInputs">
								<div class="mSearchInputGuests">2 Travellers</div>
								<div class="mSearchInputDate mdot">15 - 19 Nov</div>
							</div>
							<div class="mSearchInputsEdit" id="btn_getModal_searchInputs">Edit</div>
						</div>
						<!--Edit Date ends-->

						<!--Included in Package-->
						<div class="mTourSvcIcon">
							<h5>Included in this package</h5>
						</div>
						<div id="mobscroll" class="mServiceScroll mobscroll">
						@php
							$package_service=unserialize($details->package_service);
						@endphp
						@if(empty($package_service))
						@else
						<?php $count_package_service=count($package_service); ?>
						<?php
							$ico="";
							foreach ($icon_data as $icon_data1) {
							$ico.=$icon_data1->icon_title.",";
							}
							$ico1=array_unique(explode(",",$ico));
							?>
							@for($i=0;$i<$count_package_service;$i++)
							@if(in_array($package_service[$i], $ico1))
							<div class="mServiceItemIcons">
								<div class="mServiceItemIconsImage">
									<img class="mServiceItemImage" src="{{ url('/public/uploads/icons/'.CustomHelpers::getimagename($package_service[$i],'rt_icons','icon')) }}" title="{{ CustomHelpers::getimagename($package_service[$i],'rt_icons','icon_title') }}">
								</div>
								<div class="mServiceItemIconsTitle">{{ CustomHelpers::getimagename($package_service[$i],'rt_icons','icon_title') }}</div>
							</div>
							@else
							@endif
							@endfor
						@endif
						</div>
					</div>

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
						<div class="head">From</div>
						<div class="item-name">New Delhi</div>
					</div>
					<div class="btn-edit" id="btn_getModal_searchInputs_city">Change</div>
				</div>
			</div>
		</div>
		<div class="item-container">
			<div class="item-container-box">
				<div class="search-input-item-cont">
					<div class="search-input-sub-item">
						<div class="head">Starting On</div>
						<div class="item-name">15 Nov 2023 Wednesday</div>
					</div>
					<div class="btn-edit" id="btn_getModal_searchInputs_date">Change</div>
				</div>
			</div>
		</div>
		<div class="item-container">
			<div class="item-container-box">
				<div class="search-input-item-cont">
					<div class="search-input-sub-item">
						<div class="head">Rooms & Guests</div>
						<div class="item-name">2 Adults in 1 Room</div>
					</div>
					<div class="btn-edit" id="btn_getModal_searchInputs_travellers">Change</div>
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
				<button class="btn-search-input-apply">Apply</button>
			</div>
		</div>
	</div>
</div>

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
							<div class="item-name">Date</div>
						</div>
						<div class="btn-edit" id="">Change</div>
					</div>
				</div>
			</div>
		</div>
		<div class="footer-cont">
			<div class="traveller-modal-footer">
				<button class="btn-search-input-apply">Done</button>
			</div>
		</div>
	</div>
</div>

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
						<div class="d-flexCenterBetween" style="margin: 15px 0">
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
						<div class="d-flexCenterBetween" style="margin: 15px 0">
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
						<div class="d-flexCenterBetween" style="margin: 15px 0">
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
						<div class="d-flexCenterBetween" style="margin: 15px 0">
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
		<div class="footer-cont" style="background-color: #;">
			<div class="traveller-modal-footer">
				<button class="btn-add-room" id="addContainerButton">+ Add another room</button>
			</div>
		</div>
		<div class="footer-cont">
			<div class="traveller-modal-footer">
				<button class="btn-search-input-apply">Apply</button>
			</div>
		</div>
	</div>

</div>

<script type="text/javascript">
// search-inputs-modal.js
const getModal_searchInputs = document.getElementById('btn_getModal_searchInputs');
const closeModal_searchInputs = document.getElementById('closeModal_searchInputs');
const openModal_searchInputs = document.getElementById('modal_searchInputs');

// Function to open the modal
getModal_searchInputs.addEventListener('click', () => {
	openModal_searchInputs.style.display = 'block';
	});

// Function to close the modal
closeModal_searchInputs.addEventListener('click', () => {
    openModal_searchInputs.style.display = 'none';
	});

// Close the modal if the user clicks outside of it
window.addEventListener('click', (event) => {
	if (event.target === openModal_searchInputs) {
		openModal_searchInputs.style.display = 'none';
		}
	});

//
// search-inputs-city-modal.js
const getModal_searchInputs_city = document.getElementById('btn_getModal_searchInputs_city');
const closeModal_searchInputs_city = document.getElementById('btn_closeModal_searchInputs_city');
const openModal_searchInputs_city = document.getElementById('modal_searchInputs_city');

// Function to open the modal
getModal_searchInputs_city.addEventListener('click', () => {
    openModal_searchInputs_city.style.display = 'block';
	});

// Function to close the modal
closeModal_searchInputs_city.addEventListener('click', () => {
    openModal_searchInputs_city.style.display = 'none';
	});

// Close the modal if the user clicks outside of it
window.addEventListener('click', (event) => {
	if (event.target === modal) {
		openModal_searchInputs_city.style.display = 'none';
    		}
	});

//
// search-inputs-date-modal.js
const getModal_searchInputs_date = document.getElementById('btn_getModal_searchInputs_date');
const closeModal_searchInputs_date = document.getElementById('btn_closeModal_searchInputs_date');
const openModal_searchInputs_date = document.getElementById('modal_searchInputs_date');

// Function to open the modal
getModal_searchInputs_date.addEventListener('click', () => {
	openModal_searchInputs_date.style.display = 'block';
	});

// Function to close the modal
closeModal_searchInputs_date.addEventListener('click', () => {
	openModal_searchInputs_date.style.display = 'none';
	});

// Close the modal if the user clicks outside of it
window.addEventListener('click', (event) => {
	if (event.target === openModal_searchInputs_date) {
		openModal_searchInputs_date.style.display = 'none';
		}
	});

//
// search-inputs-travellers-modal.js
const getModal_searchInputs_travellers = document.getElementById('btn_getModal_searchInputs_travellers');
const closeModal_searchInputs_travellers = document.getElementById('btn_closeModal_searchInputs_travellers');
const openModal_searchInputs_travellers = document.getElementById('modal_searchInputs_travellers');

// Function to open the modal
getModal_searchInputs_travellers.addEventListener('click', () => {
	openModal_searchInputs_travellers.style.display = 'block';
	});

// Function to close the modal
closeModal_searchInputs_travellers.addEventListener('click', () => {
	openModal_searchInputs_travellers.style.display = 'none';
	});

// Close the modal if the user clicks outside of it
window.addEventListener('click', (event) => {
	if (event.target === openModal_searchInputs_travellers) {
		openModal_searchInputs_travellers.style.display = 'none';
		}
	});

//
// add-duplicate-container-Modal.js
	
// Get a reference to the "Add Container" button
const addButton = document.getElementById('addContainerButton');

// Select the container which you want to copy
const existingContainer = document.getElementById('guest_container');

// Select the existing container to which you want to append
const appendContainer = document.getElementById('add_new_guest_container');

// Initialize a container counter
let containerCount = 1;

// Add a click event listener to the "Add Container" button
addButton.addEventListener('click', function() {

	// Increment the container counter
      containerCount++;

      // Create a new container element
      const newContainer = document.createElement('div');
      //newContainer.className = 'container_box'; // Add a class for styling (optional)

      // Add content/container and a "Remove Container" button within the new container
      newContainer.innerHTML = existingContainer.innerHTML + `${containerCount}`;

      // Append the new container to the document
      appendContainer.appendChild(newContainer);

      // Scroll the new container into view
      newContainer.scrollIntoView({ behavior: 'smooth', block: 'end' });

      // "Remove Container" button
      const removeButton = newContainer.querySelector('#removeContainerButton');

      removeButton.addEventListener('click', function() {
      // Remove the clicked container
      	appendContainer.removeChild(newContainer);
      });
    });
</script>
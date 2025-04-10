	<!--Mobile Tour Search Edit Modal Starts-->
	<div id="mSearchModal" class="mSearch_modal">
		<div class="mSearch_modalContent">
			<!-- mModifySearchModal -->
			
			<div class="mSearch_Header">
				<h2>Edit your search</h2>
				<!--<button type="button" class="mSearch_Close" data-dismiss="modal">Close &#10006;</button>-->
				<span class="mSearch_Close" id="btn_close_mSearchModal">Close &#10006;</span>
				<!--<span class="close" id="btn_close_mSearchModal">&times;</span>-->
			</div>

			<!--Search Modal body-->
			<div class="mSearch_ModalBody">
				<div class="mSearchInputCont">
					<!-- Starting City -->
					<!-- <div class="mSearchBox" id="btn_getModal_searchInputs_city">
						<label for="source_city">
							<div>STARTING CITY</div>
							<input type="text" id="source_city" name="source_city" value="" placeholder="Enter Departure City" required readonly />
						</label>
					</div> -->

					<!-- City Name -->
					<div class="mSearchBox">
						<label for="tourplace" id="btn_getModal_searchInputs_destination">
							<div>TO CITY / COUNTRY</div>
							<input type="text" id="destination_search" name="tourplace" value="" placeholder="Enter Destination" required readonly />
						</label>
					</div>

					<!-- Travel Date -->
					<div class="mSearchBox">
						<label for="traveldate" id="btn_getModal_searchInputs_date">
							<div>TRAVEL DATE</div>
							<input type="text" id="date" name="traveldate" value="<?php echo e($date); ?>" placeholder="Select Travel Date" required readonly />
						</label>
					</div>

					<!-- Theme -->
					<div class="mSearchBox" id="btn_getModal_searchInputs_theme">
						<label for="traveltheme">
							<div>THEME</div>
							<input type="text" id="traveltheme" name="traveltheme" value="" placeholder="Select Theme" required readonly />
						</label>
					</div>

					<!-- search -->
					<div class="appendTop20">
						<button class="btn_mSearch">Search</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--Mobile Tour Search Edit Modal Ends-->

	<!----------------------------->

	<!--City Modal Starts (enable when using starting city above)-->
	<!-- <div id="modal_searchInputs_city" class="search-inputs-modal">
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
	</div> -->
	<!--City Modal Ends-->
	
	<!----------------------------->

	<!--Destination Modal Starts-->
	<div id="modal_searchInputs_destination" class="search-inputs-modal">
		<div class="search-inputs-modal-content">
			<div class="mStickyBar">
				<div class="mSearchInputsModalHeader">
					<div class="close-searchInputs-modal" id="btn_closeModal_searchInputs_destination"></div>
					<div>
						<h4 class="mModalTitle">Select Destination</h4>
					</div>
				</div>
			</div>

			<div class="search-inputs-modal-body">
				<div class="item-container">
					<div class="item-container-box">
						<div class="search-input-item-cont">
							<div class="search-input-sub-item">
								<div class="head">Search Destination</div>
								<div class="item-name">Goa</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--Destination Modal Ends-->

	<!----------------------------->

	<!--Travel Date Modal Starts-->
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
								<!-- <div class="item-name">15 Nov 2023 Wednesday</div> -->
								<div class="item-name">
									<input type="text" id="m_datepicker" name="datepicker" value="" placeholder="Select Date" />
										<!-- <div class="dateValueCont">
											<div class="dateValue makeflex">
												<span class="dayStyle day"></span>
												<span class="monthStyle comma month"></span>
												<span class="yearStyle year"></span>
											</div>
											<div class="dayName day-name"></div>
										</div> -->
								</div>
							</div>
							<!--<div class="btn-edit" id="">Change</div>-->
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
	<!--Travel Date Modal Ends-->

	<!----------------------------->

	<!--Theme Modal Starts-->
	<div id="modal_searchInputs_theme" class="search-inputs-modal">
		<div class="search-inputs-modal-content">
			<div class="mStickyBar">
				<div class="mSearchInputsModalHeader">
					<div class="close-searchInputs-modal" id="btn_closeModal_searchInputs_theme"></div>
					<div>
						<h4 class="mModalTitle">Select Theme</h4>
					</div>
				</div>
			</div>
			
			<div class="search-inputs-modal-body">
				<div class="item-container">
					<div class="item-container-box">
						<div class="search-input-item-cont">
							<div class="search-input-sub-item">
								<div class="head">Search Theme</div>
								<div class="item-name">Family</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--Theme Modal Ends-->
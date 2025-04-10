	<!--Mobile Edit Search Modal Starts-->
	<div id="mSearchModal" class="mSearch_modal">
		<form action="{{ URL::to('/packages_list') }}" method="post" autocomplete="off" id="search4" name="search4">
				<input type="hidden" name="_token"  value="{{ Session::token() }}"/>
		<div class="mSearch_modalContent">
			<div class="mSearch_Header">
				<h2>Edit your search</h2>
				<!--<button type="button" class="mSearch_Close" data-dismiss="modal">Close &#10006;</button>-->
				<span class="mSearch_Close" id="btn_close_mSearchModal">Close &#10006;</span>
				<!--<span class="close" id="btn_close_mSearchModal">&times;</span>-->
			</div>
			<!--Search Modal body-->
			<div class="mSearch_ModalBody">
				<div class="mSearchInputCont">
					<!--Starting City-->
					<!--<div class="mSearchBox" id="btn_getModal_searchInputs_city">
						<label for="source_city">
							<div>STARTING CITY</div>
							<input type="text" id="source_city" name="source_city" value="" placeholder="Enter Departure City" required readonly />
						</label>
					</div>-->
					<!--City Name-->
					<div class="mSearchBox">
						<label for="tourplace" id="btn_getModal_searchInputs_destination">
							<div>TO CITY / COUNTRY</div>
							<input type="text" id="destination_search_mobile" name="destination_search" value="" placeholder="Enter Destination" required readonly />
						</label>
					</div>
					<!--Travel Date-->
					<div class="mSearchBox">
						<label for="traveldate" id="btn_getModal_searchInputs_date">
							<div>TRAVEL DATE</div>
							
							<input type="text" id="date_mobile" name="datepicker" value="{{ $date }}" placeholder="Select Travel Date" required readonly />
						</label>
					</div>
					<!--Modal Search Inputs-Date-->
					<!--Theme-->
					<div class="mSearchBox" id="btn_getModal_searchInputs_theme">
						<label for="traveltheme">
							<div>THEME</div>
							<input type="text" id="traveltheme_mobile" name="select_theme" value="" placeholder="Select Theme" required readonly />
						</label>
					</div>
					<div class="appendTop20">
						<button type="submit" class="btn_mSearch">Search</button>
					</div>
				</div>
			</div>
		</div>
		</form>
	</div>
	<!--Mobile Edit Search Modal Ends-->

	<!----------------------------->
	<!--City Modal Starts-->
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
								<div class="head">Search Destination
<input type="text" value="" name="mobile_destination_search" class="mobile_destination_search form-control" style="margin-top: 5px;">
								</div>
								<span class="des_data">
									
								</span>
								
                                 

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
								<div class="item-name"><input type="text" id="mobiledatepicker" name="datepicker" value="{{ $date }}" placeholder="Select Date" readonly /></div>
							</div>
							<!--<div class="btn-edit" id="">Change</div>-->
						</div>
					</div>
				</div>
			</div>
			<div class="footer-cont">
				<div class="traveller-modal-footer">
					<button class="btn-search-input-apply date_apply">Done</button>
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
								<span class="theme_data">
									
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--Theme Modal Ends-->
	<!----------------------------->

<!----------------------------->

<script type="text/javascript">
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
	
</script>

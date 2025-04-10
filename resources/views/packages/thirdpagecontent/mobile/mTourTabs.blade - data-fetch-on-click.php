<style type="text/css">
.tab-container {
display: flex;
  justify-content: space-between;
  background-color: #f0f0f0;
  padding: 10px;
}

.tab-button {
  background-color: #e0e0e0;
  border: none;
  padding: 10px 20px;
  cursor: pointer;
  outline: none;
}

.tab-button.active {
  background-color: #007bff;
  color: #fff;
}

.tab-content {
  padding: 20px;
}

.tab {
  display: none;
}

.tab.active {
  display: block;
}

.sub-tab-button {
  background-color: #e0e0e0;
  border: none;
  padding: 10px 20px;
  cursor: pointer;
  outline: none;
}

.sub-tab-button.active {
  background-color: #007bff;
  color: #fff;
}

.sub-tab-content {
  padding: 10px;
}

.sub-tab {
  display: none;
}

.sub-tab.active {
  display: block;
}
</style>
<div class="tab-container mTabCont">
	<div class="overflowX mobscroll" id="mobscroll">
	<div class="">
		<button class="tab-button">Itinerary</button>
		<button class="tab-button">Inclusions</button>
		<button class="tab-button">Visa</button>
		<button class="tab-button">Destination</button>
		<button class="tab-button">Similar Tour</button>
	</div>
	</div>
</div>

	<div class="tab-content">
		<div class="tab ">
			<div class="sub-tab-container">
				<button class="sub-tab-button">Day Plan</button>
				<button class="sub-tab-button">Highlights</button>
				<button class="sub-tab-button">Flights</button>
				<button class="sub-tab-button">Hotel</button>
				<button class="sub-tab-button">Transfers</button>
				<button class="sub-tab-button">Activities</button>
			</div>
			<div class="sub-tab-content">
				<!-- Content for Sub-Tab 1 will be fetched dynamically -->
				<div class="sub-tab" data-content-url="subtab1.html">Content for Sub-Tab 1</div>
				<div class="sub-tab" data-content-url="subtab2.html">Content for Sub-Tab 2</div>
				<div class="sub-tab" data-content-url="subtab3.html">Content for Sub-Tab 3</div>
				<div class="sub-tab" data-content-url="subtab4.html">Content for Sub-Tab 4</div>
				<div class="sub-tab" data-content-url="subtab5.html">Content for Sub-Tab 5</div>
				<div class="sub-tab" data-content-url="subtab6.html">Content for Sub-Tab 6</div>
			</div>
		</div>
		<div class="tab" data-content-url="tab2.html">Content for Tab 2</div>
		<div class="tab" data-content-url="tab3.html">Content for Tab 3</div>
		<div class="tab" data-content-url="tab4.html">Content for Tab 4</div>
		<div class="tab" data-content-url="tab5.html">Content for Tab 5</div>
	</div>

<!--Mobile Tour Tabs-->
<div class="mTabCont">
<div class="overflowX mobscroll" id="mobscroll">
	 <ul class="mTabButton flexCenter">
		@if($details->description=="" && $details->highlights=="")
		@else
		<li href="#mTourOverview" data-toggle="tab">Overview</li>
		@endif
		
		@if($daywise["day1"]["title"]!="")
		<li href="#mTourItinerary" data-toggle="tab">Tour&nbsp;Itinerary</li>
		@endif
		
		@if($details->flight!='')
		<?php
			$flight_data=unserialize($details->flight);
		?>
		
	   	@if(array_key_exists('flightOption',$flight_data) && $flight_data['flightOption']==1)  
		<li href="#mTourFlights" data-toggle="tab">Flights</li>
			@endif
		@endif

		@if($details->transfers!='')
		<?php
		$transfers=unserialize($details->transfers);
		$first_key = key($transfers);
		?>
		
		@if($transfers[$first_key]['mode_title']!='')
		<li href="#mTourTRANSFERS" data-toggle="tab">Transfers</li>
		@endif
        @endif
	
		@if($details->accommodation=="")
		@else
		<li href="#mTourAccommodation" data-toggle="tab">Accommodation</li>
		@endif
							
		@if($details->inclusions=="")
		@else
		<li href="#mTourInclusions" data-toggle="tab">Inclusions</li>
		@endif
		
		@if($details->tours=="N;")
		@else
		<li href="#mTourActivity" data-toggle="tab">Activities</li>
		@endif
		
		<?php
			$pri=CustomHelpers::get_price($details->id);
			$price_upcoming=CustomHelpers::get_up_price($details->id);
		?>
		@if(($pri!="On Request" && $details->onrequest!="1") || ($price_upcoming!="On Request" && $details->upcoming!="1"))
		<li href="#mTourPriceCalendar" data-toggle="tab">Tour&nbsp;Price</li>
		@endif
		
		@if($details->payment_policy!="")
		@endif
		@if((empty($details->visa_p) || $details->visa_p=="N;") && (empty($details->payment_p) || $details->payment_p=="N;") && (empty($details->can_p) || $details->can_p=="N;") && (empty($details->imp_notes) || $details->imp_notes=="N;"))
		@else
		<li href="#mTourPolicies" data-toggle="tab">Policies</li>
		@endif
		
		<li href="#mTourDestinations" data-toggle="tab">Tour&nbsp;Destinations</li>

		@if($details->similar_packages!='' && $details->similar_packages!='N;')
		<li href="#mTourExtra" data-toggle="tab">Extra</li>
         @endif
	 </ul>
</div>
</div>
<!--Mobile Tour Tabs ends-->

<script type="text/javascript">
// Get references to the tab buttons and tab content
const tabButtons = document.querySelectorAll('.tab-button');
const tabs = document.querySelectorAll('.tab');

// Get references to the sub-tab buttons and sub-tab content within Tab 1
const subTabButtons = document.querySelectorAll('.sub-tab-button');
const subTabs = document.querySelectorAll('.sub-tab');

// Function to fetch and load content for a tab
function loadTabContent(tab, url) {
  if (tab.dataset.loaded !== 'true') {
    fetch(url)
      .then(response => response.text())
      .then(data => {
        tab.innerHTML = data;
        tab.dataset.loaded = 'true';
      })
      .catch(error => {
        console.error(`Error fetching content: ${error}`);
      });
  }
}

// Set the first tab and its first sub-tab as active by default
tabs[0].classList.add('active');
tabButtons[0].classList.add('active');
subTabs[0].classList.add('active');
subTabButtons[0].classList.add('active');

// Add click event listeners to each tab button
tabButtons.forEach((button, index) => {
  button.addEventListener('click', () => {
    // Hide all tabs
    tabs.forEach(tab => {
      tab.classList.remove('active');
    });

    // Show the selected tab
    tabs[index].classList.add('active');

    // Remove the 'active' class from all buttons
    tabButtons.forEach(btn => {
      btn.classList.remove('active');
    });

    // Add the 'active' class to the clicked button
    button.classList.add('active');

    // Fetch and load content for the selected tab
    const tabContent = tabs[index];
    const contentUrl = tabContent.dataset.contentUrl;
    loadTabContent(tabContent, contentUrl);
  });
});

// Add click event listeners to sub-tab buttons within Tab 1
subTabButtons.forEach((button, index) => {
  button.addEventListener('click', () => {
    // Hide all sub-tabs within Tab 1
    subTabs.forEach(subTab => {
      subTab.classList.remove('active');
    });

    // Show the selected sub-tab within Tab 1
    subTabs[index].classList.add('active');

    // Remove the 'active' class from all sub-tab buttons
    subTabButtons.forEach(subBtn => {
      subBtn.classList.remove('active');
    });

    // Add the 'active' class to the clicked sub-tab button
    button.classList.add('active');
  });
});
</script>
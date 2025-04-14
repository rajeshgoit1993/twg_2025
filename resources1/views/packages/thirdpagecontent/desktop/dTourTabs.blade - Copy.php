<div id="event_stricky" class="dTourTabCont">
	<ul>
		@if($details->description=="" && $details->highlights=="")
		@else
		<li href="#dTourDescription" data-toggle="tab">Overview</li>
		@endif
		
		@if($daywise["day1"]["title"]!="")
		<li href="#dTourItinerary" data-toggle="tab">Tour&nbsp;Itinerary</li>
		@endif
		
		@if($details->flight!='')
		<?php 
 $flight_data=unserialize($details->flight); 

		?>
		
	   @if(array_key_exists('flightOption',$flight_data) && $flight_data['flightOption']==1)  
		<li href="#dTourFlights" data-toggle="tab">Flights</li>
		@endif
		@endif
       @if($details->transfers!='')
       <?php 
       $transfers=unserialize($details->transfers);
       $first_key = key($transfers);
       ?>
       @if($transfers[$first_key]['mode_title']!='')
       <li href="#dTourTRANSFERS" data-toggle="tab">Transfers</li>
       @endif
           @endif
		@if($details->accommodation=="")
		@else
		<li href="#dTourAccommodation" data-toggle="tab">Accommodation</li>
		@endif
							
		@if($details->inclusions=="")
		@else
		<li href="#dTourInclusions" data-toggle="tab">Inclusions</li>
		@endif
		
		@if($details->tours=="N;")
		@else
		<li href="#dTourActivity" data-toggle="tab">Activity</li>
		@endif
		
		<?php
			$pri=CustomHelpers::get_price($details->id);
			$price_upcoming=CustomHelpers::get_up_price($details->id);
		?>
		<!-- @if(($pri!="On Request" && $details->onrequest!="1") || ($price_upcoming!="On Request" && $details->upcoming!="1"))
		<li href="#dTourPriceCalendar" data-toggle="tab">Tour&nbsp;Pricing</li>
		@endif -->
		<li href="#dTourPriceCalendar" data-toggle="tab">Tour&nbsp;Pricing</li>
		
		@if($details->payment_policy!="")
		@endif
		@if((empty($details->visa_p) || $details->visa_p=="N;") && (empty($details->payment_p) || $details->payment_p=="N;") && (empty($details->can_p) || $details->can_p=="N;") && (empty($details->imp_notes) || $details->imp_notes=="N;"))
		@else
		<li href="#dTourPolicies" data-toggle="tab">Policies</li>
		@endif
		
		<li href="#dTourDestinations" data-toggle="tab">Tour&nbsp;Destinations</li>
@if($details->similar_packages!='' && $details->similar_packages!='N;')
		<li href="#dTourExtra" data-toggle="tab">Extra</li>
@endif
	</ul>
</div>
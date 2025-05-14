						<!--Main Tab-->
						<div class="tab-container dMainTabCont">
							<div class="overflowX mobscroll">
								<ul class="dMainTabButton">
									<!--Itinerary Tab-->
									<li class="tab-button" data-id="dItinerary">Itinerary</li>

									<!--Inclusion Tab-->
									@if($details->inclusions=="")
									@else
									<li class="tab-button" data-id="dTourInclusions">Inclusions</li>
									@endif

									<!--Visa Tab-->
									@if($details->payment_policy!="")
									@endif
									@if((empty($details->visa_p) || $details->visa_p=="N;"))
									@else
									<li class="tab-button" data-id="dTourVisa">Visa</li>
									@endif

									<!--Policy Tab-->
									@if($details->payment_policy!="")
									@endif
									@if((empty($details->visa_p) || $details->visa_p=="N;") && (empty($details->payment_p) || $details->payment_p=="N;") && (empty($details->can_p) || $details->can_p=="N;") && (empty($details->imp_notes) || $details->imp_notes=="N;"))
									@else
									<li class="tab-button" data-id="dTourPolicies">Terms&nbsp;&#38;&nbsp;Conditions</li>
									@endif

									<!--Destination Tab-->
									<li class="tab-button" data-id="dTourDestinations">Destination</li>

									<!--Similar Tour Tab-->
									@if($details->similar_packages!='' && $details->similar_packages!='N;')
									<li class="tab-button" data-id="dTourExtra">Similar&nbsp;Packages</li>
									@endif

									<!--Tour Pricing Tab-->
									<?php

									
									
									?>
									
									<li class="tab-button" data-id="dTourPriceCalendar">Tour&nbsp;Pricing</li>
									
								</ul>
							</div>
						</div>
						<!--Main & Sub Tab-Content-->
						<div class="tab-content">
							<div class="tab" data-id="dItinerary">
								<!--Sub Tab-->
								<div class="sub-tab-container dSubTabCont">
									<div class="overflowX mobscroll">
										<ul class="dSubTabButton flexCenter">
											<!--Itinerary Tab-content-->
											<!--Tour Itinerary Tab-->
											@if($daywise["day1"]["title"]!="")
											<li class="sub-tab-button" data-id="dDayWisePlan">Day&nbsp;Plan</li>
											@endif

											<!--Description & Highlights Tab-->
											@if($details->highlights=="")
											@else
											<li class="sub-tab-button" data-id="dTourOverview">Highlights</li>
											@endif

											<!--Flights Tab-->
											@if($details->flight!='')
											<?php
											$flight_data=unserialize($details->flight);
											?>
											@if(array_key_exists('flightOption',$flight_data) && $flight_data['flightOption']==1)
											<li class="sub-tab-button" data-id="dTourFlights">Flights</li>
											@endif
											@endif

											<!--Accommodation Tab-->
											@if($details->accommodation=="")
											@else
											<li class="sub-tab-button" data-id="dTourAccommodation">Hotel</li>
											@endif

											<!--Transfers Tab-->
											@if($details->transfers!='')
											<?php
											$transfers=unserialize($details->transfers);
											$first_key = key($transfers);
											?>
											@if($transfers[$first_key]['mode_title']!='')
											<li class="sub-tab-button" data-id="dTourTransfers">Transfers</li>
											@endif
											@endif

											<!--Activities Tab-->
											@if($details->tours=="N;")
											@else
											<li class="sub-tab-button" data-id="dTourActivity">Activities</li>
											@endif
										</ul>
									</div>
								</div>
								<!--Sub Tab Content-->
								<div class="sub-tab-content">
								<!--Tour Itinerary Tab-content-->
								@if($daywise["day1"]["title"]!="")
								<div class="sub-tab" data-id="dDayWisePlan">
									@include('packages.thirdpagecontent.desktop.dtour-tab-content.dTourItinerary')
								</div>
								@endif

								<!--Description & Highlights Tab-content-->
								@if($details->highlights=="")
								@else
								<div class="sub-tab" data-id="dTourOverview">
									@include('packages.thirdpagecontent.desktop.dtour-tab-content.dTourOverview')
								</div>
								@endif

								<!--Flights Tab-content-->
								@if($details->flight!='')
								<?php
								$flight_data=unserialize($details->flight);
								?>
								@if(array_key_exists('flightOption',$flight_data) && $flight_data['flightOption']==1)
								<div class="sub-tab" data-id="dTourFlights">
									@include('packages.thirdpagecontent.desktop.dtour-tab-content.dTourFlights')
								</div>
								@endif
								@endif

								<!--Accommodation Tab-content-->
								@if($details->accommodation=="")
								@else
								<div class="sub-tab" data-id="dTourAccommodation">
									@include('packages.thirdpagecontent.desktop.dtour-tab-content.dTourAccommodation')
								</div>
								@endif

								<!--Transfers Tab-content-->
								@if($details->transfers!='')
								<?php
								$transfers=unserialize($details->transfers);
								$first_key = key($transfers);
								?>
								@if($transfers[$first_key]['mode_title']!='')
								<div class="sub-tab" data-id="dTourTransfers">
									@include('packages.thirdpagecontent.desktop.dtour-tab-content.dTourTransfers')
								</div>
								@endif
								@endif

								<!--Activities Tab-content-->
								@if($details->tours=="N;")
								@else
								<div class="sub-tab" data-id="dTourActivity">
									@include('packages.thirdpagecontent.desktop.dtour-tab-content.dTourActivity')
								</div>
								@endif
								</div>
							</div>
							<!--Main Tab Content-->
							<!--Inclusion Tab-content-->
							@if($details->inclusions=="")
							@else
							<div class="tab" data-id="dTourInclusions">
								@include('packages.thirdpagecontent.desktop.dtour-tab-content.dTourInclusions')
							</div>
							@endif

							<!--Visa Tab-content-->
							@if($details->payment_policy!="")
							@endif
							@if((empty($details->visa_p) || $details->visa_p=="N;"))
							@else
							<div class="tab" data-id="dTourVisa">
								@include('packages.thirdpagecontent.desktop.dtour-tab-content.dTourVisa')
							</div>
							@endif

							<!--Policy Tab-content-->
							@if($details->payment_policy!="")
							@endif
							@if((empty($details->visa_p) || $details->visa_p=="N;") && (empty($details->payment_p) || $details->payment_p=="N;") && (empty($details->can_p) || $details->can_p=="N;") && (empty($details->imp_notes) || $details->imp_notes=="N;"))
							@else
							<div class="tab" data-id="dTourPolicies">
								@include('packages.thirdpagecontent.desktop.dtour-tab-content.dTourPolicies')
							</div>
							@endif

							<!--Destination Tab-content-->
							<div class="tab" data-id="dTourDestinations">
								@include('packages.thirdpagecontent.desktop.dtour-tab-content.dTourDestinations')
							</div>

							<!--Similar Tour Tab-content-->
							@if($details->similar_packages!='' && $details->similar_packages!='N;')
							<div class="tab" data-id="dTourExtra">
								@include('packages.thirdpagecontent.desktop.dtour-tab-content.dTourExtra')
							</div>
							@endif

							<!--Tour Pricing Tab-content-->
							<?php
							$pri=CustomHelpers::get_price($details->id);
							$price_upcoming=CustomHelpers::get_up_price($details->id);
							?>
							@if(($pri!="On Request" && $details->onrequest!="1") || ($price_upcoming!="On Request" && $details->upcoming!="1"))
							<div class="tab" data-id="dTourPriceCalendar">
								@include('packages.thirdpagecontent.desktop.dtour-tab-content.dTourPriceCalendar')
							</div>
							@endif
						</div>
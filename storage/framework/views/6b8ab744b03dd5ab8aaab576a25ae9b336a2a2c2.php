						<!--Main Tab-->
						<div class="tab-container dMainTabCont">
							<div class="overflowX mobscroll">
								<ul class="dMainTabButton">
									<!--Itinerary Tab-->
									<li class="tab-button" data-id="dItinerary">Itinerary</li>

									<!--Inclusion Tab-->
									<?php if($details->inclusions==""): ?>
									<?php else: ?>
									<li class="tab-button" data-id="dTourInclusions">Inclusions</li>
									<?php endif; ?>

									<!--Visa Tab-->
									<?php if($details->payment_policy!=""): ?>
									<?php endif; ?>
									<?php if((empty($details->visa_p) || $details->visa_p=="N;")): ?>
									<?php else: ?>
									<li class="tab-button" data-id="dTourVisa">Visa</li>
									<?php endif; ?>

									<!--Policy Tab-->
									<?php if($details->payment_policy!=""): ?>
									<?php endif; ?>
									<?php if((empty($details->visa_p) || $details->visa_p=="N;") && (empty($details->payment_p) || $details->payment_p=="N;") && (empty($details->can_p) || $details->can_p=="N;") && (empty($details->imp_notes) || $details->imp_notes=="N;")): ?>
									<?php else: ?>
									<li class="tab-button" data-id="dTourPolicies">Terms&nbsp;&#38;&nbsp;Conditions</li>
									<?php endif; ?>

									<!--Destination Tab-->
									<li class="tab-button" data-id="dTourDestinations">Destination</li>

									<!--Similar Tour Tab-->
									<?php if($details->similar_packages!='' && $details->similar_packages!='N;'): ?>
									<li class="tab-button" data-id="dTourExtra">Similar&nbsp;Packages</li>
									<?php endif; ?>

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
											<?php if($daywise["day1"]["title"]!=""): ?>
											<li class="sub-tab-button" data-id="dDayWisePlan">Day&nbsp;Plan</li>
											<?php endif; ?>

											<!--Description & Highlights Tab-->
											<?php if($details->highlights==""): ?>
											<?php else: ?>
											<li class="sub-tab-button" data-id="dTourOverview">Highlights</li>
											<?php endif; ?>

											<!--Flights Tab-->
											<?php if($details->flight!=''): ?>
											<?php
											$flight_data=unserialize($details->flight);
											?>
											<?php if(array_key_exists('flightOption',$flight_data) && $flight_data['flightOption']==1): ?>
											<li class="sub-tab-button" data-id="dTourFlights">Flights</li>
											<?php endif; ?>
											<?php endif; ?>

											<!--Accommodation Tab-->
											<?php if($details->accommodation==""): ?>
											<?php else: ?>
											<li class="sub-tab-button" data-id="dTourAccommodation">Hotel</li>
											<?php endif; ?>

											<!--Transfers Tab-->
											<?php if($details->transfers!=''): ?>
											<?php
											$transfers=unserialize($details->transfers);
											$first_key = key($transfers);
											?>
											<?php if($transfers[$first_key]['mode_title']!=''): ?>
											<li class="sub-tab-button" data-id="dTourTransfers">Transfers</li>
											<?php endif; ?>
											<?php endif; ?>

											<!--Activities Tab-->
											<?php if($details->tours=="N;"): ?>
											<?php else: ?>
											<li class="sub-tab-button" data-id="dTourActivity">Activities</li>
											<?php endif; ?>
										</ul>
									</div>
								</div>
								<!--Sub Tab Content-->
								<div class="sub-tab-content">
								<!--Tour Itinerary Tab-content-->
								<?php if($daywise["day1"]["title"]!=""): ?>
								<div class="sub-tab" data-id="dDayWisePlan">
									<?php echo $__env->make('packages.thirdpagecontent.desktop.dtour-tab-content.dTourItinerary', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
								</div>
								<?php endif; ?>

								<!--Description & Highlights Tab-content-->
								<?php if($details->highlights==""): ?>
								<?php else: ?>
								<div class="sub-tab" data-id="dTourOverview">
									<?php echo $__env->make('packages.thirdpagecontent.desktop.dtour-tab-content.dTourOverview', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
								</div>
								<?php endif; ?>

								<!--Flights Tab-content-->
								<?php if($details->flight!=''): ?>
								<?php
								$flight_data=unserialize($details->flight);
								?>
								<?php if(array_key_exists('flightOption',$flight_data) && $flight_data['flightOption']==1): ?>
								<div class="sub-tab" data-id="dTourFlights">
									<?php echo $__env->make('packages.thirdpagecontent.desktop.dtour-tab-content.dTourFlights', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
								</div>
								<?php endif; ?>
								<?php endif; ?>

								<!--Accommodation Tab-content-->
								<?php if($details->accommodation==""): ?>
								<?php else: ?>
								<div class="sub-tab" data-id="dTourAccommodation">
									<?php echo $__env->make('packages.thirdpagecontent.desktop.dtour-tab-content.dTourAccommodation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
								</div>
								<?php endif; ?>

								<!--Transfers Tab-content-->
								<?php if($details->transfers!=''): ?>
								<?php
								$transfers=unserialize($details->transfers);
								$first_key = key($transfers);
								?>
								<?php if($transfers[$first_key]['mode_title']!=''): ?>
								<div class="sub-tab" data-id="dTourTransfers">
									<?php echo $__env->make('packages.thirdpagecontent.desktop.dtour-tab-content.dTourTransfers', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
								</div>
								<?php endif; ?>
								<?php endif; ?>

								<!--Activities Tab-content-->
								<?php if($details->tours=="N;"): ?>
								<?php else: ?>
								<div class="sub-tab" data-id="dTourActivity">
									<?php echo $__env->make('packages.thirdpagecontent.desktop.dtour-tab-content.dTourActivity', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
								</div>
								<?php endif; ?>
								</div>
							</div>
							<!--Main Tab Content-->
							<!--Inclusion Tab-content-->
							<?php if($details->inclusions==""): ?>
							<?php else: ?>
							<div class="tab" data-id="dTourInclusions">
								<?php echo $__env->make('packages.thirdpagecontent.desktop.dtour-tab-content.dTourInclusions', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
							</div>
							<?php endif; ?>

							<!--Visa Tab-content-->
							<?php if($details->payment_policy!=""): ?>
							<?php endif; ?>
							<?php if((empty($details->visa_p) || $details->visa_p=="N;")): ?>
							<?php else: ?>
							<div class="tab" data-id="dTourVisa">
								<?php echo $__env->make('packages.thirdpagecontent.desktop.dtour-tab-content.dTourVisa', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
							</div>
							<?php endif; ?>

							<!--Policy Tab-content-->
							<?php if($details->payment_policy!=""): ?>
							<?php endif; ?>
							<?php if((empty($details->visa_p) || $details->visa_p=="N;") && (empty($details->payment_p) || $details->payment_p=="N;") && (empty($details->can_p) || $details->can_p=="N;") && (empty($details->imp_notes) || $details->imp_notes=="N;")): ?>
							<?php else: ?>
							<div class="tab" data-id="dTourPolicies">
								<?php echo $__env->make('packages.thirdpagecontent.desktop.dtour-tab-content.dTourPolicies', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
							</div>
							<?php endif; ?>

							<!--Destination Tab-content-->
							<div class="tab" data-id="dTourDestinations">
								<?php echo $__env->make('packages.thirdpagecontent.desktop.dtour-tab-content.dTourDestinations', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
							</div>

							<!--Similar Tour Tab-content-->
							<?php if($details->similar_packages!='' && $details->similar_packages!='N;'): ?>
							<div class="tab" data-id="dTourExtra">
								<?php echo $__env->make('packages.thirdpagecontent.desktop.dtour-tab-content.dTourExtra', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
							</div>
							<?php endif; ?>

							<!--Tour Pricing Tab-content-->
							<?php
							$pri=CustomHelpers::get_price($details->id);
							$price_upcoming=CustomHelpers::get_up_price($details->id);
							?>
							<?php if(($pri!="On Request" && $details->onrequest!="1") || ($price_upcoming!="On Request" && $details->upcoming!="1")): ?>
							<div class="tab" data-id="dTourPriceCalendar">
								<?php echo $__env->make('packages.thirdpagecontent.desktop.dtour-tab-content.dTourPriceCalendar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
							</div>
							<?php endif; ?>
						</div>